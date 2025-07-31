<?php
// Include the database configuration file
include 'config.php';

// Start the session (if not already started)
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: User not logged in.");
}

$userId = $_SESSION['user_id']; // Get logged-in user's ID

// Fetch all professionals
$sql = "SELECT id, username, profile_picture FROM professionals";
$result = $conn->query($sql);

$professionals = [];
while ($row = $result->fetch_assoc()) {
    $professionals[] = $row;
}

// Initialize message variables
$successMessage = "";
$errorMessage = "";

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $professionalId = trim($_POST['professional_id'] ?? '');
    $sessionType = trim($_POST['sessionType'] ?? '');
    $sessionDate = trim($_POST['sessionDate'] ?? '');
    $sessionTime = trim($_POST['sessionTime'] ?? '');
    $userMessage = trim($_POST['userMessage'] ?? '');
    $paymentMethod = trim($_POST['paymentMethod'] ?? '');

    // Validate required fields
    if (empty($professionalId) || empty($sessionType) || empty($sessionDate) || empty($sessionTime) || empty($paymentMethod)) {
        $errorMessage = "All fields are required.";
    } elseif (strtotime($sessionDate) < strtotime(date("Y-m-d"))) {
        $errorMessage = "Invalid session date. Please select a future date.";
    } else {
        // Check if the user ID exists in the users table
        $stmt_check_user = $conn->prepare("SELECT id FROM users WHERE id = ?");
        $stmt_check_user->bind_param("i", $userId);
        $stmt_check_user->execute();
        $result_check_user = $stmt_check_user->get_result();

        if ($result_check_user->num_rows === 0) {
            $errorMessage = "Error: User does not exist.";
        } else {
            // Check if the professional ID exists
            $stmt_check_pro = $conn->prepare("SELECT id FROM professionals WHERE id = ?");
            $stmt_check_pro->bind_param("i", $professionalId);
            $stmt_check_pro->execute();
            $result_check_pro = $stmt_check_pro->get_result();

            if ($result_check_pro->num_rows === 0) {
                $errorMessage = "Error: Selected professional does not exist.";
            } else {
                // Insert data into session_requests table
                $stmt = $conn->prepare("INSERT INTO session_requests (user_id, professional_id, session_type, session_date, session_time, user_message, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("iisssss", $userId, $professionalId, $sessionType, $sessionDate, $sessionTime, $userMessage, $paymentMethod);

                if ($stmt->execute()) {
                    // Insert notification for the professional
                    $message = "New session booking request from user ID {$userId}.";
                    $stmt_notify = $conn->prepare("INSERT INTO notifications (user_id, professional_id, message) VALUES (?, ?, ?)");
                    $stmt_notify->bind_param("iis", $userId, $professionalId, $message);
                    $stmt_notify->execute();

                    // Insert notification for the user
                    $message_user = "Your booking request has been sent to professional ID {$professionalId}.";
                    $stmt_notify_user = $conn->prepare("INSERT INTO notifications (user_id, professional_id, message) VALUES (?, ?, ?)");
                    $stmt_notify_user->bind_param("iis", $userId, $professionalId, $message_user);
                    $stmt_notify_user->execute();

                    $successMessage = "Booking request submitted successfully!";
                } else {
                    $errorMessage = "Error: " . $conn->error;
                }
            }
        }
    }
}

// Close the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Therapy Session - SafeSpace</title>
    <meta name="description" content="Book a therapy session with our experienced mental health professionals">
    <link rel="icon" href="/favicon.ico" sizes="any">
  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #5569d4;
            --primary-hover: #0077b6;
            --secondary: #35b88f;
            --secondary-hover: #2ca37c;
            --light-bg: #f5f7fd;
            --dark-text: #2d3748;
            --light-text: #718096;
            --card-shadow: 0 10px 25px rgba(85, 105, 212, 0.1);
            --hover-shadow: 0 15px 35px rgba(85, 105, 212, 0.15);
            --card-border-radius: 16px;
            --btn-border-radius: 8px;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Open Sans', sans-serif;
            color: var(--dark-text);
            line-height: 1.7;
        }

        .navbar {
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.75rem;
            letter-spacing: -0.025em;
        }

        .page-header {
            padding: 4rem 0 2rem;
            background: linear-gradient(to right,rgb(82, 147, 226),rgb(236, 228, 223));
            color: white;
            margin-bottom: 3rem;
            border-radius: 0 0 50px 50px;
            box-shadow: 0 5px 20px rgba(85, 105, 212, 0.2);
        }
        
        .page-header h1 {
            font-size: 2.8rem;
            margin-bottom: 0.5rem;
        }

        .payment-card {
            border-radius: var(--card-border-radius);
            box-shadow: var(--card-shadow);
            background-color: #fff;
            padding: 2rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary);
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            border-radius: var(--btn-border-radius);
            font-weight: 600;
            padding: 0.75rem 1.25rem;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        
        .therapist-preview {
            display: flex;
            align-items: center;
            background-color: rgba(85, 105, 212, 0.05);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .therapist-preview img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            margin-right: 1rem;
        }
        
        .therapist-details h5 {
            color: var(--primary);
            margin-bottom: 0.25rem;
        }
        
        .therapist-details p {
            margin-bottom: 0;
            color: var(--light-text);
        }
        
        .session-options {
            background-color: rgba(53, 184, 143, 0.1);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .payment-methods {
            background-color: rgba(85, 105, 212, 0.05);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .btn-request {
            background-color: var(--secondary);
            border-color: var(--secondary);
            color: white;
            width: 100%;
            padding: 1rem;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .btn-request:hover {
            background-color: var(--secondary-hover);
            transform: translateY(-2px);
            box-shadow: var(--hover-shadow);
        }
        
        .professional-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1rem;
            margin-bottom: 1.5rem;
            background-color: rgba(85, 105, 212, 0.05);
            border-radius: 12px;
        }
        
        .professional-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 1rem;
        }
        
        .alert {
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .therapist-preview, .professional-card {
                flex-direction: column;
                text-align: center;
            }
            
            .therapist-preview img {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
   <!-- header-->
<?php include 'header.php'; ?>

    <header class="page-header">
        <div class="container text-center">
            <h1>Book Your Therapy Session</h1>
            <p class="lead">Complete your booking and take the first step towards personal growth and healing.</p>
        </div>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if(isset($successMessage)): ?>
                    <div class="alert alert-success">
                        <?php echo $successMessage; ?>
                    </div>
                <?php endif; ?>
                
                <?php if(isset($errorMessage)): ?>
                    <div class="alert alert-danger">
                        <?php echo $errorMessage; ?>
                    </div>
                <?php endif; ?>

                <div class="payment-card">
                    <!-- Booking Form -->
                    <form id="sessionRequestForm" method="POST">
                        <!-- Professional Selection -->
                        <div class="mb-3">
                            <label for="professional_id" class="form-label">Choose a Professional</label>
                            <select name="professional_id" class="form-select" id="professional_id" required>
                                <option value="">Select Professional</option>
                                <?php foreach ($professionals as $professional) : ?>
                                    <option value="<?php echo $professional['id']; ?>">
                                        <?php echo $professional['username']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Session Options -->
                        <div class="session-options">
                            <h4 class="mb-3">Select Session Type</h4>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="sessionType" id="videoSession" value="Video Session" checked>
                                <label class="form-check-label" for="videoSession">
                                    Video Session - 3000XAF
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="sessionType" id="phoneSession" value="Phone Session">
                                <label class="form-check-label" for="phoneSession">
                                    Phone Session - 1000XAF
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sessionType" id="chatSession" value="Chat Session">
                                <label class="form-check-label" for="chatSession">
                                    Chat Session - 1500XAF
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="sessionDate" class="form-label">Choose Session Date</label>
                            <input type="date" class="form-control" id="sessionDate" name="sessionDate" required>
                        </div>

                        <div class="mb-3">
                            <label for="sessionTime" class="form-label">Choose Session Time</label>
                            <input type="time" class="form-control" id="sessionTime" name="sessionTime" required>
                        </div>

                        <div class="mb-3">
                            <label for="userMessage" class="form-label">Any message for the therapist?</label>
                            <textarea class="form-control" id="userMessage" name="userMessage" rows="4" placeholder="Write your message here (optional)"></textarea>
                        </div>

                        <!-- Payment Methods -->
                        <div class="payment-methods">
                            <h4 class="mb-3">Select Payment Method</h4>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="mtnMomo" value="MTN Mobile Money" checked>
                                <label class="form-check-label" for="mtnMomo">
                                    <i class="fas fa-mobile-alt me-2 text-warning"></i> MTN Mobile Money
                                </label>
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="Credit Card">
                                <label class="form-check-label" for="creditCard">
                                    <i class="fas fa-credit-card me-2 text-primary"></i> Credit Card
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-request">
                            <i class="fas fa-calendar-check me-2"></i> Request Session
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Footer Placeholder -->
     <div id="footer-placeholder"></div>

<!-- Scripts -->

<script>
   
    fetch('../static/footer.php')
        .then(response => response.text())
        .then(data => document.getElementById('footer-placeholder').innerHTML = data)
        .catch(err => console.log('Error loading footer:', err));
</script>


    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
