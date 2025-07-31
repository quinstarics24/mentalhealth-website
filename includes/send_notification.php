<?php
require_once 'notifications.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $professional_id = $_POST['professional_id'];
    $message = $_POST['message'];

    if (sendNotification($user_id, $professional_id, $message)) {
        echo "Notification sent successfully!";
    } else {
        echo "Failed to send notification.";
    }
}
?>
