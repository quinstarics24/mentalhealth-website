<?php
session_start();
require_once "../pages/config.php";

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: ../auth/login.php");
    exit;
}

// Initialize variables
$name = $phone = $pickup_address = $delivery_address = $requested_date = "";
$status = "Pending"; // Default status
$created_at = date("Y-m-d H:i:s"); // Current timestamp

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $pickup_address = htmlspecialchars(trim($_POST["pickup_address"]));
    $delivery_address = htmlspecialchars(trim($_POST["delivery_address"]));
    $requested_date = htmlspecialchars(trim($_POST["requested_date"]));

    // Validate required fields
    if (!empty($name) && !empty($phone) && !empty($pickup_address) && !empty($delivery_address) && !empty($requested_date)) {
        // Prepare SQL query
        $sql = "INSERT INTO relocation_requests (user_id, name, phone, pickup_address, delivery_address, requested_date, status, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $mysqli->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param(
                "isssssss",
                $_SESSION['user_id'],  // User ID from session
                $name,                 // Full Name
                $phone,                // Phone Number
                $pickup_address,       // Pickup Address
                $delivery_address,     // Delivery Address
                $requested_date,       // Requested Date
                $status,               // Status
                $created_at            // Created At timestamp
            );

            // Execute the statement
            if ($stmt->execute()) {
                // Notify the user of success
                $_SESSION['message'] = "Your relocation request has been submitted successfully!";
                $_SESSION['message_type'] = "success";
                header("location: ../dashboards/user.php");
                exit;
            } else {
                // Notify the user of an error
                $_SESSION['message'] = "Error: Could not submit your request. Please try again.";
                $_SESSION['message_type'] = "danger";
                header("location: ../dashboards/user.php");
                exit;
            }

            // Close the statement
            $stmt->close();
        } else {
            // Notify the user of an error in query preparation
            $_SESSION['message'] = "Error: Could not prepare the SQL statement.";
            $_SESSION['message_type'] = "danger";
            header("location: ../dashboards/user.php");
            exit;
        }
    } else {
        // Notify the user of missing fields
        $_SESSION['message'] = "All fields are required. Please fill out the form completely.";
        $_SESSION['message_type'] = "warning";
        header("location: ../dashboards/user.php");
        exit;
    }
}

// Close the database connection
$mysqli->close();
?>
