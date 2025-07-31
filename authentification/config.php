<?php
// Database configuration
$host = 'localhost'; // Replace with your host (usually localhost)
$username = 'root'; // Replace with your username (typically 'root' for local)
$password = ''; // Replace with your password (leave empty for local setups)
$dbname = 'safespace'; // Replace with your actual database name

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
