<?php
require_once 'includes/notifications.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notification_id = $_POST['notification_id'];

    if (markAsRead($notification_id)) {
        echo "Notification marked as read.";
    } else {
        echo "Failed to mark as read.";
    }
}
?>
