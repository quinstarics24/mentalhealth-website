<?php
session_start();
include '../authentification/config.php'; // Database connection

// Debugging: Check if the file was included
if (!defined('DB_CHECK')) {
    die("Error: config.php not included correctly.");
}

// Debugging: Check if $conn exists
if (!isset($conn) || $conn == null) {
    die("Error: Database connection not established.");
}

if (!isset($_SESSION['user_id'])) {
    die("Error: Unauthorized access.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['notification_id'], $_POST['action'])) {
    $notification_id = $_POST['notification_id'];
    $action = $_POST['action'];

    // Convert action to valid status
    $status = ($action == "Accept") ? "Accepted" : "Rejected";

    // Prepare update query
    $sql = "UPDATE notifications SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error: Failed to prepare SQL statement.");
    }

    $stmt->bind_param("si", $status, $notification_id);

    if ($stmt->execute()) {
        header("Location: notifications.php");
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
