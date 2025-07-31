<?php
session_start();

if (!isset($_SESSION['user_name'])) {
    header("Location: ../authentification/login.php"); // Redirect to login if not logged in
    exit();
}

$userName = $_SESSION['user_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovEase - Request Submitted</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Your Relocation Request Has Been Submitted</h2>
        <p class="text-center">We will notify you once your request is approved or rejected.</p>
        <div class="text-center">
            <a href="dashboard.php" class="btn btn-primary">Go to Dashboard</a>
        </div>
    </div>
</body>
</html>
