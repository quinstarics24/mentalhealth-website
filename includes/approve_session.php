<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id']) && !isset($_SESSION['professional_id'])) {
    echo "Unauthorized access!";
    exit();
}

$session_id = $_POST['session_id'];
$status = $_POST['status']; // 'approved' or 'rejected'
$user_id = $_POST['user_id']; // Get user ID to notify

// Update session request status
$sql = "UPDATE session_requests SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $session_id);
if ($stmt->execute()) {
    // Insert notification
    $notif_message = ($status == "approved") ? "Your session request has been approved." : "Your session request was rejected.";
    $notif_sql = "INSERT INTO notifications (user_id, message, type) VALUES (?, ?, 'user')";
    $notif_stmt = $conn->prepare($notif_sql);
    $notif_stmt->bind_param("is", $user_id, $notif_message);
    $notif_stmt->execute();

    echo "success";
} else {
    echo "error";
}
?>
