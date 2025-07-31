<?php
// Include database configuration
require_once "config.php";

// Admin credentials
$admin_username = "admin";
$plain_password = "admin123";

// Hash the password
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

// Directly update the password in the database
$sql = "UPDATE admins SET password = ? WHERE username = ?";

if ($stmt = $mysqli->prepare($sql)) {
    $stmt->bind_param("ss", $hashed_password, $admin_username);

    if ($stmt->execute()) {
        echo "✅ Admin password has been successfully hashed and updated!";
    } else {
        echo "❌ Error updating password: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Error preparing query: " . $mysqli->error;
}

$mysqli->close();
?>
