<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: ../authentification/login.php");
    exit();
}

$userName = htmlspecialchars($_SESSION['username']);
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #818CF8;
            --accent-color:rgb(99, 51, 19);
            --background-color:rgb(234, 237, 241);
            --text-primary: #1F2937;
            --text-secondary:rgb(64, 68, 78);
        }

        body {
            background-color: var(--background-color);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
        }

        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .welcome-card {
            background: white;
            border-radius: 1rem;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }

        .welcome-content {
            position: relative;
            text-align: center;
            padding: 2rem;
            background: rgba(26, 76, 124, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            margin-bottom: 3rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .welcome-text h1 {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            line-height: 1.2;
        }

        .welcome-text p {
            color: var(--text-secondary);
            font-size: 1.1rem;
            margin-bottom: 0;
        }
        .cosmic-container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            padding: 2rem;
        }
        
        .ambient-stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }
        
        .star {
            position: absolute;
            background-color: #ffffff;
            border-radius: 50%;
            opacity: 0.7;
            animation: twinkle 4s infinite ease-in-out;
        }
        
        .journey-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        
        .support-module {
            background: linear-gradient(to right, rgb(82, 147, 226), rgb(231, 220, 213));
            border-radius: 15px;
            padding: 2rem;
            width: 100%;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .support-module:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }
        
        .module-icon {
            font-size: 3rem;
            color:rgb(73, 142, 196);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }
        
        .support-module:hover .module-icon {
            transform: scale(1.2);
            color: #ffffff;
        }
        
        .module-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #ffffff;
        }
        
        .module-content {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            color: #f0f0f0;
            flex-grow: 1;
        }
        
        .cosmic-button {
            background: linear-gradient(to right, rgb(28, 116, 224), rgb(236, 228, 223));
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .cosmic-button:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .journey-cards {
                flex-direction: column;
                align-items: center;
            }
            
            .support-module {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
      <!-- header-->
<?php include '../includes/header.php'; ?>

    <div class="main-container">
        <div class="welcome-card">
            <div class="welcome-content">
                <div class="welcome-text">
                <h1>Welcome <?php echo $userName; ?>!</h1>
                  <p>We're so glad you're here. At SafeSpace, we’re here to support you, guide you, and help you take the next step toward a brighter, healthier future.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="cosmic-container">
        <div class="ambient-stars">
            <?php for($i = 0; $i < 100; $i++): ?>
                <div class="star" style="
                    left: <?php echo rand(0, 100); ?>vw;
                    top: <?php echo rand(0, 100); ?>vh;
                    width: <?php echo rand(1, 3); ?>px;
                    height: <?php echo rand(1, 3); ?>px;
                    animation-delay: -<?php echo rand(0, 4); ?>s;
                "></div>
            <?php endfor; ?>
        </div>

        <div class="journey-cards">
            <div class="support-module">
                <div class="module-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h2 class="module-title">Therapeutic Space</h2>
                <p class="module-content">
                    A private sanctuary where licensed therapists help guide you through life's challenges with understanding and expertise.
                </p>
                <a href="../includes/therapist.php" class="cosmic-button">Connect</a>
            </div>

            <div class="support-module">
                <div class="module-icon">
                    <i class="fas fa-hands-holding-circle"></i>
                </div>
                <h2 class="module-title">Community Circle</h2>
                <p class="module-content">
                    Find strength in shared experiences. Our support groups offer a space for connection and mutual understanding.
                </p>
                <a href="https://chat.whatsapp.com/D3rCNYxlMjh8TRNoFfblxj" class="cosmic-button">Join</a>
            </div>

            <div class="support-module">
                <div class="module-icon">
                    <i class="fas fa-shield-heart"></i>
                </div>
                <h2 class="module-title">Resource Center</h2>  
<p class="module-content">  
    Discover valuable resources to support your well-being. Browse videos, articles, guides, and expert advice tailored to your needs.  
</p>  
<a href="../includes/resource.php" class="cosmic-button">Explore Resources</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>