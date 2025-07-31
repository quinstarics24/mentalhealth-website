<?php
$host = 'localhost';  // Database host
$dbname = 'safespace';  // Database name
$username = 'root';  // Database username
$password = '';  // Database password (change if necessary)

// Create connection
$mysqli = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
