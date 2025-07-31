<?php
// Database Connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "safespace"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total users
$userQuery = "SELECT COUNT(*) AS total_users FROM users";
$userResult = $conn->query($userQuery);
$userCount = $userResult->fetch_assoc()['total_users'] ?? 0;

// Fetch total professionals
$professionalQuery = "SELECT COUNT(*) AS total_professionals FROM professionals";
$professionalResult = $conn->query($professionalQuery);
$professionalCount = $professionalResult->fetch_assoc()['total_professionals'] ?? 0;

// Fetch total successful bookings
$successfulBookingsQuery = "SELECT COUNT(*) AS total_successful_bookings FROM session_requests WHERE status='Confirmed'";
$successfulBookingsResult = $conn->query($successfulBookingsQuery);
$totalSuccessfulBookings = $successfulBookingsResult->fetch_assoc()['total_successful_bookings'] ?? 0;

// Fetch pending bookings
$pendingBookingsQuery = "SELECT COUNT(*) AS total_pending_bookings FROM session_requests WHERE status='Pending'";
$pendingBookingsResult = $conn->query($pendingBookingsQuery);
$totalPendingBookings = $pendingBookingsResult->fetch_assoc()['total_pending_bookings'] ?? 0;

// Fetch rejected bookings
$rejectedBookingsQuery = "SELECT COUNT(*) AS total_rejected_bookings FROM session_requests WHERE status='Rejected'";
$rejectedBookingsResult = $conn->query($rejectedBookingsQuery);
$totalRejectedBookings = $rejectedBookingsResult->fetch_assoc()['total_rejected_bookings'] ?? 0;

// Fetch all payments
$paymentsQuery = "SELECT SUM(amount) AS total_payments FROM payments";
$paymentsResult = $conn->query($paymentsQuery);


// Check if the query was successful
if ($paymentsResult) {
    // Get the total payments or set it to 0 if no result is found
    $totalPayments = $paymentsResult->fetch_assoc()['total_payments'] ?? 0;
} else {
    // If the query failed, set $totalPayments to 0
    $totalPayments = 0;
}

// Convert the total payment to XAF if required (Optional)
$exchangeRate = 600; // Example exchange rate: 1 USD = 600 XAF
$totalPaymentsInXAF = $totalPayments * $exchangeRate;


// Fetch recent activities (last 5 session requests)
$recentActivitiesQuery = "SELECT sr.id, u.username AS user_name, p.username AS professional_name, 
                                 sr.session_date, sr.session_time, sr.status 
                          FROM session_requests sr 
                          JOIN users u ON sr.user_id = u.id 
                          JOIN professionals p ON sr.professional_id = p.id 
                          ORDER BY sr.session_date DESC, sr.session_time DESC 
                          LIMIT 5";
$recentActivitiesResult = $conn->query($recentActivitiesQuery);

// Fetch data for chart (sessions per month for the current year)
$currentYear = date('Y');
$monthlySessionsQuery = "SELECT MONTH(session_date) AS month, COUNT(*) AS session_count 
                         FROM session_requests 
                         WHERE YEAR(session_date) = $currentYear 
                         GROUP BY MONTH(session_date)";
$monthlySessionsResult = $conn->query($monthlySessionsQuery);

$monthlySessionsData = array_fill(1, 12, 0); // Initialize with zeros for all months
if ($monthlySessionsResult) {
    while ($row = $monthlySessionsResult->fetch_assoc()) {
        $monthlySessionsData[$row['month']] = (int)$row['session_count'];
    }
}
$monthlySessionsJSON = json_encode(array_values($monthlySessionsData));



$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SafeSpace Admin Dashboard</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        :root {
            --primary-color: #0A2342;
            --secondary-color: #2CA4A4;
            --accent-color: #F97068;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --danger-color: #dc3545;
            --background-light: #F5F5F5;
            --card-bg: #ffffff;
            --text-dark: #333333;
            --text-light: #6c757d;
            --border-radius: 10px;
            --box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--background-light);
            color: var(--text-dark);
            line-height: 1.5;
        }
        .admin-wrapper {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */
.sidebar {
    width: 250px; /* Adjust width as needed */
    background-color: var(--primary-color);
    color: white;
    position: fixed; /* Fix it to the left */
    top: 0;
    left: 0;
    height: 100%;
    padding: 20px;
    overflow-y: auto;
}

/* Main Content */
.main-content {
    flex-grow: 1;
    padding: 30px;
    margin-left: 250px; /* Same as sidebar width */
    background-color: var(--background-light);
    transition: var(--transition);
}

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0,0,0,0.08);
        }

        .dashboard-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: var(--primary-color);
            margin: 0;
        }

        .dashboard-header .welcome-text {
            font-size: 16px;
            color: var(--text-light);
            margin-top: 5px;
        }

        .date-display {
            font-size: 14px;
            color: var(--text-light);
            font-weight: 500;
        }

        .dashboard-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 22px;
            margin-bottom: 22px;
            transition: var(--transition);
            height: 100%;
            border: none;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.08);
        }

        .dashboard-card .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            border-bottom: 1px solid rgba(0,0,0,0.07);
            padding-bottom: 12px;
            background: transparent;
        }

        .dashboard-card .card-header h5 {
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
            font-size: 17px;
        }

        .dashboard-card .card-header .icon {
            font-size: 22px;
            color: var(--secondary-color);
            opacity: 0.9;
        }

        .stat-item {
            padding: 14px 0;
            border-bottom: 1px dashed rgba(0,0,0,0.06);
        }

        .stat-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 4px;
            font-weight: 500;
        }

        .stat-number {
            font-size: 22px;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .stat-number.success {
            color: var(--success-color);
        }

        .stat-number.warning {
            color: var(--warning-color);
        }

        .stat-number.danger {
            color: var(--danger-color);
        }

        .quick-action-btn {
            margin-bottom: 10px;
            padding: 12px;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
        }

        .quick-action-btn i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .recent-activity-table {
            width: 100%;
        }

        .recent-activity-table th {
            color: var(--text-light);
            font-weight: 600;
            padding: 10px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .recent-activity-table td {
            padding: 12px 10px;
            border-bottom: 1px solid rgba(0,0,0,0.04);
            font-size: 14px;
        }

        .recent-activity-table tr:last-child td {
            border-bottom: none;
        }

        .activity-status {
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
        }

        .status-approved {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .status-rejected {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        .custom-scrollbar {
            max-height: 320px;
            overflow-y: auto;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(0,0,0,0.15);
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background-color: rgba(0,0,0,0.03);
        }

        canvas {
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .dashboard-header .date-display {
                margin-top: 10px;
            }
            
            .dashboard-card {
                margin-bottom: 20px;
            }

            .stat-number {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    
<!-- Sidebar-->
    <?php include 'sidebar.php'; ?>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <div>
                <h1>Admin Dashboard</h1>
                <span class="welcome-text">Welcome back, Admin</span>
            </div>
            <div class="date-display">
                <i class="fas fa-calendar-alt me-2"></i> <?php echo date('l, F j, Y'); ?>
            </div>
        </div>

        <div class="row">
            <!-- Users Overview Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5>Users Overview</h5>
                        <div class="icon"><i class="fas fa-users"></i></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Total Users</div>
                        <div class="stat-number"><?php echo number_format($userCount); ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Total Professionals</div>
                        <div class="stat-number"><?php echo number_format($professionalCount); ?></div>
                    </div>
                    <div class="stat-item">
                    <div class="stat-label">Total Revenue</div>
                    <div class="stat-number">XAF <?php echo number_format($totalPaymentsInXAF, 2, ',', '.'); ?></div>
                    </div>
                </div>
            </div>

            <!-- Booking Statistics Card -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5>Booking Statistics</h5>
                        <div class="icon"><i class="fas fa-calendar-check"></i></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Successful Bookings</div>
                        <div class="stat-number success"><?php echo number_format($totalSuccessfulBookings); ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Pending Bookings</div>
                        <div class="stat-number warning"><?php echo number_format($totalPendingBookings); ?></div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-label">Rejected Bookings</div>
                        <div class="stat-number danger"><?php echo number_format($totalRejectedBookings); ?></div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions Card -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5>Quick Actions</h5>
                        <div class="icon"><i class="fas fa-bolt"></i></div>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="manage_users.php" class="btn btn-outline-primary quick-action-btn">
                            <i class="fas fa-user-edit"></i> Manage Users
                        </a>
                        <a href="manage_professional.php" class="btn btn-outline-secondary quick-action-btn">
                            <i class="fas fa-user-md"></i> Manage Professionals
                        </a>
                        <a href="view_session.php" class="btn btn-outline-success quick-action-btn">
                            <i class="fas fa-calendar-alt"></i> View Sessions
                        </a>
                        <a href="reports.php" class="btn btn-outline-info quick-action-btn">
                            <i class="fas fa-chart-line"></i> Generate Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Monthly Sessions Chart -->
            <div class="col-lg-8 mb-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5>Monthly Sessions (<?php echo date('Y'); ?>)</h5>
                        <div class="icon"><i class="fas fa-chart-bar"></i></div>
                    </div>
                    <canvas id="monthlySessions" height="250"></canvas>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="col-lg-4 mb-4">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h5>Recent Activities</h5>
                        <div class="icon"><i class="fas fa-history"></i></div>
                    </div>
                    <div class="custom-scrollbar">
                        <?php if ($recentActivitiesResult && $recentActivitiesResult->num_rows > 0): ?>
                            <table class="recent-activity-table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Professional</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($activity = $recentActivitiesResult->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($activity['user_name']); ?></td>
                                            <td><?php echo htmlspecialchars($activity['professional_name']); ?></td>
                                            <td>
                                                <?php 
                                                    $statusClass = '';
                                                    switch($activity['status']) {
                                                        case 'Confirmed':
                                                            $statusClass = 'status-approved';
                                                            break;
                                                        case 'Pending':
                                                            $statusClass = 'status-pending';
                                                            break;
                                                        case 'Rejected':
                                                            $statusClass = 'status-rejected';
                                                            break;
                                                    }
                                                ?>
                                                <span class="activity-status <?php echo $statusClass; ?>">
                                                    <?php echo $activity['status']; ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p class="text-center py-4">No recent activities found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
   
</body>
</html>