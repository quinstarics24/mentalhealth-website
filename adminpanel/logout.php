<?php
session_start(); // Start the session

// Destroy the session to log the admin out
session_unset(); 
session_destroy();

// Redirect admin to the homepage
header("Location: ../root/"); // Change this to your actual homepage file
exit();
?>
