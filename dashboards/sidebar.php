<?php 
// Start session only if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../authentification/config.php'); // Ensure database connection

if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}

$professional_id = $_SESSION['user_id'];

// Check if the 'status' column exists
$result = $mysqli->query("SHOW COLUMNS FROM notifications LIKE 'status'");
if ($result->num_rows == 0) {
    die("Error: 'status' column does not exist in the 'notifications' table.");
}

// Fetch unread notifications count
$sql = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_id = ? AND status = 'Unread'";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $professional_id);
$stmt->execute();
$stmt->bind_result($unread_count);
$stmt->fetch();
$stmt->close();

// Fetch all notifications
$sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $professional_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            padding: 0;
            box-sizing: border-box;
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
            transition: var(--transition);
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
            color: #f1c40f; /* Yellow color */
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
            margin-left: 280px; /* Offset the content to the right of the sidebar */
            flex: 1;
            padding: 0px;
            transition: var(--transition);
            background: var(--light-color);
            min-height: 100vh;
        }

        .navbar {
            background: white;
            padding: 10px 20px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--dark-color);
            font-size: 18px;
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
    <div class="sidebar">
        <div class="sidebar-logo">
            <a href="../root/index.php" class="logo-text">
                SAFE<span class="highlight">SPACE</span>
            </a>
        </div>
        <div class="sidebar-nav">
            <a href="professional.php">
                <i class="fa fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="messages.php">
                <i class="fa fa-envelope"></i>
                <span>Session Requests</span>
            </a>
            <a href="notifications.php" class="active">
                <i class="fa fa-bell"></i>
                <span>Notifications</span>
                <?php if ($unread_count > 0): ?>
                    <span id="notification-badge" class="badge bg-danger"><?php echo $unread_count; ?></span>
                <?php endif; ?>
            </a>
            <a href="logout.php">
                <i class="fa fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>
</body>
</html>
