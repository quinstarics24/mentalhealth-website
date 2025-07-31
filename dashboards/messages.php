<?php
session_start();
require_once "../authentification/config.php"; // Database connection

// Check if the professional is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "professional") {
    header("location: login.php");
    exit();
}

// Get the logged-in professional's ID
$professional_id = $_SESSION["professional_id"];

// Initialize unread notifications count
$unread_count = 0;

// Fetch unread notifications count
$sql_unread = "SELECT COUNT(*) AS unread_count FROM notifications WHERE user_id = ? AND status = 'Unread'";
$stmt_unread = $mysqli->prepare($sql_unread);
if ($stmt_unread) {
    $stmt_unread->bind_param("i", $professional_id);
    $stmt_unread->execute();
    $stmt_unread->bind_result($unread_count);
    $stmt_unread->fetch();
    $stmt_unread->close();
}

// Fetch session requests assigned to this professional
$sql = "SELECT sr.id, u.username AS user_name, sr.session_type, sr.session_date, sr.session_time, sr.user_message, sr.payment_method, sr.status, sr.created_at 
        FROM session_requests sr
        JOIN users u ON sr.user_id = u.id
        WHERE sr.professional_id = ? 
        ORDER BY sr.created_at DESC";

$stmt = $mysqli->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $professional_id);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    die("Error fetching session requests: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>  :root {
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
        }</style>
</head>
<body class="bg-light">

<!-- Sidebar -->
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

<!-- Main Content -->
<div class="main-content">
    <div class="container mt-5">
        <h2 class="text-center mb-4">My Session Requests</h2>
        
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>User</th>
                            <th>Session Type</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Message</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row["user_name"]); ?></td>
                                <td><?php echo htmlspecialchars($row["session_type"]); ?></td>
                                <td><?php echo htmlspecialchars($row["session_date"]); ?></td>
                                <td><?php echo htmlspecialchars($row["session_time"]); ?></td>
                                <td><?php echo htmlspecialchars($row["user_message"]); ?></td>
                                <td><?php echo htmlspecialchars($row["payment_method"]); ?></td>
                                <td><span class="badge bg-primary"><?php echo htmlspecialchars($row["status"]); ?></span></td>
                                <td>
                                    <form method="POST" action="update_status.php" class="d-flex align-items-center">
                                        <input type="hidden" name="session_id" value="<?php echo $row["id"]; ?>">
                                        <select name="status" class="form-select me-2">
                                            <option value="Pending" <?php if ($row["status"] == "Pending") echo "selected"; ?>>Pending</option>
                                            <option value="Confirmed" <?php if ($row["status"] == "Confirmed") echo "selected"; ?>>Confirmed</option>
                                            <option value="Completed" <?php if ($row["status"] == "Completed") echo "selected"; ?>>Completed</option>
                                            <option value="Rejected" <?php if ($row["status"] == "Rejected") echo "selected"; ?>>Rejected</option>
                                        </select>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">No session requests found.</div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$mysqli->close();
?>
