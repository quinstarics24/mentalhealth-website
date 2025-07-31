<?php
require_once 'includes/notifications.php';
session_start();

if (!isset($_SESSION['professional_id'])) {
    echo "You need to log in.";
    exit;
}

$professional_id = $_SESSION['professional_id'];
$notifications = getProfessionalNotifications($professional_id);
?>

<h2>Your Notifications</h2>
<ul>
    <?php foreach ($notifications as $notification): ?>
        <li>
            <?= htmlspecialchars($notification['message']) ?> - 
            <small><?= $notification['created_at'] ?></small>
        </li>
    <?php endforeach; ?>
</ul>
