<?php
$servername = "localhost"; // Change if using a remote server
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$database = "safespace"; // Ensure this matches your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
