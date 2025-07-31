<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "safespace"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch payments from the database
$sql = "SELECT payments.id, payments.amount, payments.payment_method, payments.payment_date, payments.status, users.username AS user_name 
        FROM payments
        INNER JOIN users ON payments.user_id = users.id";
$result = $conn->query($sql);

// Close the connection after fetching the data
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar */
.sidebar {
    width: 250px; /* Adjust width as needed */
    background-color: var(--primary-color);
    color: white;
    position: fixed; /* Fix it to the left */
    top: 0;
    left: 0;
    height: 100%;
    padding: 20px;
    overflow-y: auto;
}

/* Main Content */
.main-content {
    flex-grow: 1;
    padding: 30px;
    margin-left: 250px; /* Same as sidebar width */
    background-color: var(--background-light);
    transition: var(--transition);
}

        .table {
            margin-top: 20px;
        }

        .btn-custom {
            font-size: 14px;
            font-weight: 500;
        }

        .status {
            font-weight: bold;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            padding: 20px;
        }

        /* Adjust the main content to avoid overlap with the sidebar */
        .content-wrapper {
            margin-left: 250px; /* Adjust this value according to your sidebar width */
            padding: 30px;
        }

        .no-payments {
            margin-top: 20px;
            padding: 20px;
            background-color: #f8d7da;
            color: #721c24;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <?php include 'sidebar.php'; ?>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content content-wrapper">
                <h1 class="my-4">Payment Details</h1>

                <?php if ($result->num_rows > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Payment Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($payment = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $payment['id']; ?></td>
                            <td><?php echo $payment['user_name']; ?></td>
                            <td><?php echo "$" . number_format($payment['amount'], 2); ?></td>
                            <td><?php echo ucfirst($payment['payment_method']); ?></td>
                            <td><?php echo $payment['payment_date']; ?></td>
                            <td class="status"><?php echo ucfirst($payment['status']); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="no-payments">
                    <p>No payment records found.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
