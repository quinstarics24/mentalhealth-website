<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: Unauthorized access.");
}

// Include database connection
include 'config.php'; // Adjust path if necessary

// Check if connection is successful
if (!isset($conn) || $conn == null) {
    die("Error: Database connection failed.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['notification_id'])) {
    $notification_id = $_POST['notification_id'];

    // Cancel request (delete from session_requests table)
    $sql = "DELETE FROM session_requests WHERE notification_id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $notification_id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        // Optionally update notification status to "Cancelled"
        $update_sql = "UPDATE notifications SET status = 'Cancelled' WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $notification_id);
        $update_stmt->execute();
        $update_stmt->close();

        // Redirect back to notifications page after cancellation
        header("Location: user_notification.php");
        exit();
    } else {
        echo "Error cancelling request: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
