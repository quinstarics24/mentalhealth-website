<?php
session_start();
include('../includes/db.php'); // Ensure the correct path

if (!isset($_SESSION['professional_id'])) {
    die("Error: Professional ID not found. Please log in.");
}

$professional_id = $_SESSION['professional_id'];

try {
    // Fetch notifications
    $query = "SELECT * FROM notifications WHERE professional_id = ? ORDER BY created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute([$professional_id]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Count unread notifications
    $countQuery = "SELECT COUNT(*) FROM notifications WHERE professional_id = ? AND professional_response IS NULL";
    $countStmt = $conn->prepare($countQuery);
    $countStmt->execute([$professional_id]);
    $unread_count = $countStmt->fetchColumn();
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Handle reply submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply'], $_POST['notification_id'])) {
    $reply = trim($_POST['reply']);
    $notification_id = $_POST['notification_id'];

    try {
        $updateQuery = "UPDATE notifications SET professional_response = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->execute([$reply, $notification_id]);

        header("Location: notifications.php");
        exit;
    } catch (PDOException $e) {
        die("Error updating reply: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        :root {
            --primary-color: #3a7bd5;
            --secondary-color: #00d2ff;
            --dark-color: #2d3748;
            --light-color: #f8fafc;
            --success-color: #38b2ac;
            --warning-color: #ecc94b;
            --danger-color: #e53e3e;
            --border-radius: 10px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            display: flex;
            min-height: 100vh;
            background: var(--light-color);
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        /* Sidebar styling */
        .sidebar {
            width: 280px;
            height: 100vh;
            background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: var(--box-shadow);
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-text {
            font-size: 22px;
            font-weight: bold;
            color: white;
            text-decoration: none;
            display: inline-block;
            padding: 10px 0;
        }

        .logo-text .highlight {
            color: #f1c40f;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            color: white;
            padding: 12px 15px;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.2);
            transform: translateX(5px);
        }

        .sidebar-nav i {
            margin-right: 10px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        .badge {
            margin-left: auto;
            background-color: #e53e3e;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 14px;
        }

        /* Main content styling */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 20px;
            transition: var(--transition);
            background: var(--light-color);
            min-height: 100vh;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                margin-bottom: 15px;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-logo">
        <a href="../root/index.php" class="logo-text">
            SAFE<span class="highlight">SPACE</span>
        </a>
    </div>
    <div class="sidebar-nav">
        <a href="professional.php"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
        <a href="messages.php"><i class="fa fa-envelope"></i> Session Requests</a>
        <a href="notifications.php" class="active">
            <i class="fa fa-bell"></i> Notifications
            <?php if ($unread_count > 0): ?>
                <span class="badge bg-danger"><?php echo $unread_count; ?></span>
            <?php endif; ?>
        </a>
        <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <h2 class="mb-4">Notifications</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Message</th>
                <th>Date</th>
                <th>Response</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result): $count = 1; ?>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><?= htmlspecialchars($row['message']) ?></td>
                        <td><?= $row['created_at'] ?></td>
                        <td>
                            <?= $row['professional_response'] ? '<span class="badge bg-success">Replied</span>' : '<span class="badge bg-warning">No Reply</span>' ?>
                        </td>
                        <td>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#replyModal<?= $row['id'] ?>">Reply</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No notifications found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Reply Modals -->
    <?php foreach ($result as $row): ?>
        <div class="modal fade" id="replyModal<?= $row['id'] ?>" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="POST">
                        <input type="hidden" name="notification_id" value="<?= $row['id'] ?>">
                        <div class="modal-header"><h5>Reply to Notification</h5></div>
                        <div class="modal-body"><textarea name="reply" class="form-control" required></textarea></div>
                        <div class="modal-footer"><button type="submit" class="btn btn-primary">Send</button></div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
