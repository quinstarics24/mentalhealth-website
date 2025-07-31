<?php
// Include database connection
include '../includes/config.php';
session_start();

// Ensure professional is logged in
if (!isset($_SESSION['professional_id'])) {
    echo "Error: Professional ID not set in session.";
    exit;
}

$professional_id = $_SESSION['professional_id'];

// Fetch professional's name
$queryName = "SELECT username FROM professionals WHERE id = ?";
$stmt = $conn->prepare($queryName);
$stmt->bind_param("i", $professional_id);
$stmt->execute();
$resultName = $stmt->get_result();
$professional = $resultName->fetch_assoc();
$professionalName = $professional['username'] ?? "Unknown";  // Default if not found

// Fetch total number of session requests for this professional
$queryRequests = "SELECT COUNT(*) AS totalRequests FROM session_requests WHERE professional_id = ?";
$stmt = $conn->prepare($queryRequests);
$stmt->bind_param("i", $professional_id);
$stmt->execute();
$resultRequests = $stmt->get_result();
$totalRequests = $resultRequests->fetch_assoc()['totalRequests'] ?? 0;

// Fetch total number of successful sessions for this professional
$querySuccess = "SELECT COUNT(*) AS totalSuccessful FROM session_requests WHERE professional_id = ? AND status = 'Completed'";
$stmt = $conn->prepare($querySuccess);
$stmt->bind_param("i", $professional_id);
$stmt->execute();
$resultSuccess = $stmt->get_result();
$totalSuccessful = $resultSuccess->fetch_assoc()['totalSuccessful'] ?? 0;

// Fetch total number of pending sessions for this professional
$queryPending = "SELECT COUNT(*) AS totalPending FROM session_requests WHERE professional_id = ? AND status = 'Pending'";
$stmt = $conn->prepare($queryPending);
$stmt->bind_param("i", $professional_id);
$stmt->execute();
$resultPending = $stmt->get_result();
$totalPending = $resultPending->fetch_assoc()['totalPending'] ?? 0;

// Avoid division by zero error
$pendingRate = $totalRequests > 0 ? round(($totalPending / $totalRequests) * 100, 1) : 0;

// Close prepared statements
$stmt->close();

// Fetch all professionals' statistics
$queryProfessionals = "SELECT p.username, 
                              COUNT(sr.id) AS totalRequests,
                              SUM(CASE WHEN sr.status = 'Completed' THEN 1 ELSE 0 END) AS successfulSessions,
                              SUM(CASE WHEN sr.status = 'Rejected' THEN 1 ELSE 0 END) AS rejectedSessions
                       FROM professionals p
                       LEFT JOIN session_requests sr ON p.id = sr.professional_id
                       GROUP BY p.id";

$resultProfessionals = $conn->query($queryProfessionals);
$professionals = [];

if ($resultProfessionals->num_rows > 0) {
    while ($row = $resultProfessionals->fetch_assoc()) {
        $professionals[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeSpace Professional Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        /* Sidebar */
        .col-md-2 {
            padding-left: 10px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            z-index: 100;
        }

        .col-md-10.main-content {
            margin-left: 22%;
            padding-top: 10px;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .stat-card {
            text-align: center;
            padding: 50px;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .success-rate {
            color: #28a745;
        }

        .rejected-rate {
            color: #dc3545;
        }

        .progress {
            height: 10px;
            margin-top: 10px;
        }

        header {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2">
                <?php include 'sidebar.php'; ?>
            </div>

            <!-- Main content -->
            <div class="col-md-10 main-content">
                <div class="container py-4">
                    <header class="pb-3 mb-4 border-bottom">
                        <div class="d-flex align-items-center">
                            <h1 class="h2">Welcome, <?= htmlspecialchars($professionalName) ?>!</h1>
                        </div>
                        <p class="text-muted">Monitor session requests and outcomes for all professionals</p>
                    </header>

                    <!-- Summary Stats -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card stat-card">
                                <div class="stat-value"><?= $totalRequests ?></div>
                                <div class="stat-label">Total Requests</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card stat-card">
                                <div class="stat-value success-rate"><?= $totalSuccessful ?></div>
                                <div class="stat-label">Successful Sessions</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card stat-card">
                                <div class="stat-value"><?= $pendingRate ?>%</div>
                                <div class="stat-label">Pending Sessions</div>
                            </div>
                        </div>
                    </div>

                    <!-- Professionals Overview -->
                    <div class="card mt-4 p-3">
                        <h5 class="card-title">Professionals Overview</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Total Requests</th>
                                        <th>Successful</th>
                                        <th>Rejected</th>
                                        <th>Success Rate</th>
                                        <th>Performance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($professionals as $prof): ?>
                                        <?php 
                                            $profSuccessRate = $prof['totalRequests'] > 0 ? round(($prof['successfulSessions'] / $prof['totalRequests']) * 100, 1) : 0; 
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($prof['username']) ?></td>
                                            <td><?= $prof['totalRequests'] ?></td>
                                            <td class="success-rate"><?= $prof['successfulSessions'] ?></td>
                                            <td class="rejected-rate"><?= $prof['rejectedSessions'] ?></td>
                                            <td><?= $profSuccessRate ?>%</td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" 
                                                         role="progressbar" 
                                                         style="width: <?= $profSuccessRate ?>%" 
                                                         aria-valuenow="<?= $profSuccessRate ?>" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
