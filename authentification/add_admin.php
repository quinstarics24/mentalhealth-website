<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require_once "config.php"; // Ensure config.php contains the correct database connection

// Define admin credentials
$username = "admin";
$password = "admin123"; // Change to a secure password
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

// Prepare the SQL statement
$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";

if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        echo "Admin inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error preparing statement: " . $mysqli->error;
}

// Close the connection
$mysqli->close();
?>
