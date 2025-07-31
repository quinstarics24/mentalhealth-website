<?php
// payment-confirmation.php

$service = $_GET['service'];
$name = $_GET['name'];
$email = $_GET['email'];
$phone = $_GET['phone'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation - Safe Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .confirmation-message {
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="confirmation-message">
            <h2>Payment Successful!</h2>
            <p>Your payment for the <strong><?php echo ucfirst(str_replace('_', ' ', $service)); ?></strong> service has been successfully processed.</p>
            <p>Thank you for your support, <?php echo $name; ?>. A confirmation email has been sent to <?php echo $email; ?>.</p>
        </div>

        <div class="text-center">
            <p>What would you like to do next?</p>
            <a href="dashboard.php" class="btn btn-success">Go to Dashboard</a>
            <p class="mt-3">Or</p>
            <a href="contact-support.php" class="btn btn-primary">Contact Support</a>
        </div>
    </div>

</body>
</html>
