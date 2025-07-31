<?php
require_once 'db.php'; 
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You need to log in.";
    exit;
}

$user_id = $_SESSION['user_id'];
$notifications = getUserNotifications($user_id);

// Track notifications that the user "deleted" (hidden from view)
if (!isset($_SESSION['deleted_notifications'])) {
    $_SESSION['deleted_notifications'] = [];
}

// Handle request cancellation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_id'])) {
    $cancel_id = $_POST['cancel_id'];
    cancelUserRequest($cancel_id);
}

// Handle notification deletion (hide from user's view only)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $_SESSION['deleted_notifications'][] = $delete_id;
}

/**
 * Fetch notifications for the user
 */
function getUserNotifications($user_id) {
    global $conn;  
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC");
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Cancel a user's request by updating the notification status
 */
function cancelUserRequest($notification_id) {
    global $conn;
    $stmt = $conn->prepare("UPDATE notifications SET status = 'Cancelled', professional_response = 'The user has canceled the request.' WHERE id = :notification_id AND user_id = :user_id");
    $stmt->execute([
        ':notification_id' => $notification_id,
        ':user_id' => $_SESSION['user_id']
    ]);
}

// Filter out "deleted" notifications
$deleted_notifications = $_SESSION['deleted_notifications'];
$notifications = array_filter($notifications, function ($notification) use ($deleted_notifications) {
    return !in_array($notification['id'], $deleted_notifications);
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .notification-card { border-left: 4px solid #0d6efd; margin-bottom: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); transition: transform 0.2s; }
        .notification-card:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .notification-header { display: flex; justify-content: space-between; align-items: center; }
        .notification-timestamp { font-size: 0.8rem; color: #6c757d; }
        .cancelled-status { background-color: #ffebee; border-left: 3px solid #dc3545; padding: 15px; border-radius: 0.25rem; margin-top: 15px; color: #dc3545; font-weight: bold; }
        .btn-small { padding: 5px 10px; font-size: 0.9rem; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h2 class="mb-0"><i class="fas fa-bell me-2 text-primary"></i>Your Notifications</h2>
                <span class="badge bg-primary rounded-pill"><?= count($notifications) ?></span>
            </div>

            <?php if (empty($notifications)): ?>
                <div class="no-notifications text-center p-4 bg-white shadow rounded">
                    <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                    <h4>No Notifications</h4>
                    <p class="text-muted">You don't have any notifications at the moment.</p>
                </div>
            <?php else: ?>
                <?php foreach ($notifications as $notification): ?>
                    <div class="card notification-card">
                        <div class="card-body">
                            <div class="notification-header">
                                <h5 class="card-title mb-1"> <?= htmlspecialchars($notification['message']) ?> </h5>
                                <div class="notification-timestamp">
                                    <i class="far fa-clock me-1"></i><?= date('M d, Y \a\t g:i a', strtotime($notification['created_at'])) ?>
                                </div>
                            </div>
                            <?php if ($notification['status'] === 'Cancelled'): ?>
                                <div class="cancelled-status mt-3">
                                    <i class="fas fa-times-circle me-2"></i>Request Cancelled
                                </div>
                            <?php elseif (!empty($notification['professional_response'])): ?>
                                <div class="notification-response mt-3">
                                    <h6 class="text-success"><i class="fas fa-reply me-2"></i>Response from Professional</h6>
                                    <p class="mb-0"> <?= htmlspecialchars($notification['professional_response']) ?> </p>
                                </div>
                            <?php else: ?>
                                <div class="mt-3">
                                    <span class="badge bg-warning"><i class="fas fa-hourglass-half me-1"></i> Awaiting Response</span>
                                </div>
                            <?php endif; ?>

                            <form method="POST" class="mt-2">
                                <input type="hidden" name="delete_id" value="<?= $notification['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-small"><i class="fas fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
