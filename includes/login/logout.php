<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = [];

// If you want to destroy the session as well
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header("Location: ../../root/index.html"); // Change to your desired redirect page
exit;
?>