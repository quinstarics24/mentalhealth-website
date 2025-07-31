<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: User ID not found in session. Please log in again.");
}

// Include database connection
include 'config.php';

// Check if connection is successful
if (!isset($conn) || $conn == null) {
    die("Error: Database connection failed.");
}

// Check if notification_id is provided
if (!isset($_POST['notification_id']) || empty($_POST['notification_id'])) {
    $_SESSION['error'] = "Invalid notification ID.";
    header("Location: notifications.php");
    exit;
}

$notification_id = $_POST['notification_id'];
$user_id = $_SESSION['user_id'];

// Verify that the notification belongs to the current user
$verify_query = "SELECT * FROM notifications WHERE id = ? AND user_id = ?";
$verify_stmt = $conn->prepare($verify_query);

if (!$verify_stmt) {
    $_SESSION['error'] = "Failed to prepare statement.";
    header("Location: notifications.php");
    exit;
}

$verify_stmt->bind_param("ii", $notification_id, $user_id);
$verify_stmt->execute();
$result = $verify_stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Notification not found or you don't have permission to delete it.";
    header("Location: notifications.php");
    exit;
}

// Delete the notification
$delete_query = "DELETE FROM notifications WHERE id = ? AND user_id = ?";
$delete_stmt = $conn->prepare($delete_query);

if (!$delete_stmt) {
    $_SESSION['error'] = "Failed to prepare delete statement.";
    header("Location: notifications.php");
    exit;
}

$delete_stmt->bind_param("ii", $notification_id, $user_id);
$success = $delete_stmt->execute();

if ($success) {
    $_SESSION['success'] = "Notification deleted successfully.";
} else {
    $_SESSION['error'] = "Failed to delete notification.";
}

$verify_stmt->close();
$delete_stmt->close();
$conn->close();

header("Location: notifications.php");
exit;
?>