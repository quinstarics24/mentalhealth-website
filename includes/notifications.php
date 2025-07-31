<?php
require_once 'config.php'; // Database connection

// Function to send a notification
function sendNotification($user_id, $professional_id, $message) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO notifications (user_id, professional_id, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $user_id, $professional_id, $message);
    return $stmt->execute();
}

// Function to fetch notifications for a professional
function getProfessionalNotifications($professional_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE professional_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $professional_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Function to fetch notifications for a user
function getUserNotifications($user_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Function to mark notifications as read (optional)
function markAsRead($notification_id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM notifications WHERE id = ?");
    $stmt->bind_param("i", $notification_id);
    return $stmt->execute();
}
?>
