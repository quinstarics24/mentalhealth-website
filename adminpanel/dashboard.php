<?php
// Include the database connection
include('db_connection.php');


// Query to get the number of users
$userQuery = "SELECT COUNT(*) AS user_count FROM users";  // Replace 'users' with your actual table name
$userStmt = $pdo->query($userQuery);
$userCount = $userStmt->fetch(PDO::FETCH_ASSOC)['user_count'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SafeSpace Admin Dashboard</title>
  <!-- Fonts and Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
  font-family: 'Inter', sans-serif;
  background-color: #f8f9fa;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
}

/
/* Main Content */
.main-content {
  margin-left: 260px;
  padding: 30px;
  transition: margin-left 0.3s ease-in-out;
}

.main-content h1 {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 20px;
}

/* Cards */
.card {
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 20px;
}

.card h5 {
  font-weight: 600;
  font-size: 18px;
}

.btn-custom {
  font-size: 14px;
  font-weight: 500;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .main-content {
    margin-left: 200px;
    padding: 20px;
  }
}

@media (max-width: 768px) {
 
  .main-content {
    margin-left: 0;
    padding: 15px;
  }
}

  </style>
</head>

<body>
  <!-- Sidebar -->
  <?php include 'slidebar.php'; ?>


  <!-- Main Content -->
<div class="main-content">
    <h1>Welcome to the SafeSpace Admin Dashboard</h1>
    
    <div class="row">
        <!-- Manage Users Card -->
        <div class="col-lg-4 mb-4">
            <div class="card p-4">
                <h5 class="card-title">Manage Users</h5>
                <p class="card-text">You have <?php echo $userCount; ?> registered users.</p>
                <a href="user.php" class="btn btn-info btn-custom text-white">Go to Users</a>
            </div>
        </div>

       <!-- Donations Card -->
<div class="col-lg-4 mb-4">
    <div class="card p-4">
        <h5 class="card-title">Donations</h5>
        <p class="card-text">Total donations: FCFA <?php echo number_format($totalDonations, 2); ?></p>
        <a href="donation.php" class="btn btn-danger btn-custom">View Donations</a>
    </div>
</div>
  <!-- Manage Payments Card -->
  <div class="col-lg-4 mb-4">
            <div class="card p-4">
                <h5 class="card-title">Manage Payments</h5>
                
                <a href="payment.php" class="btn btn-info btn-custom text-white">View Payments</a>
            </div>
      </div>
</div>
<div class="charts-activities-grid">
    <!-- Activity Chart -->
    <div class="dashboard-card">
        <div class="dashboard-card-header d-flex justify-content-between align-items-center">
            <h4 class="dashboard-card-title">Activity Overview</h4>
            <div class="dashboard-card-actions">
                <button class="btn btn-sm btn-outline-primary" onclick="updateChart('weekly')">Weekly</button>
                <button class="btn btn-sm btn-outline-secondary" onclick="updateChart('monthly')">Monthly</button>
            </div>
        </div>
        <div class="dashboard-card-body">
            <canvas id="activity-chart"></canvas>
        </div>
    </div>

    <!-- User Growth Chart -->
    <div class="dashboard-card">
        <div class="dashboard-card-header d-flex justify-content-between align-items-center">
            <h4 class="dashboard-card-title">User Growth</h4>
            <div class="dashboard-card-actions">
                <button class="btn btn-sm btn-outline-success" onclick="exportChart('user-growth-chart')">Export</button>
            </div>
        </div>
        <div class="dashboard-card-body">
            <canvas id="user-growth-chart"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let activityChart = new Chart(document.getElementById("activity-chart"), {
            type: "line",
            data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [{
                    label: "Activities",
                    data: [12, 19, 3, 5, 2, 3, 7],
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 2
                }]
            }
        });

        let userGrowthChart = new Chart(document.getElementById("user-growth-chart"), {
            type: "bar",
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                datasets: [{
                    label: "New Users",
                    data: [10, 15, 30, 25, 40, 35],
                    backgroundColor: "rgba(54, 162, 235, 0.5)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 2
                }]
            }
        });
    });

    function updateChart(period) {
        alert("Chart updated to " + period);
    }

    function exportChart(chartId) {
        alert("Exporting " + chartId);
    }
</script>


</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidenav");

    if (toggleButton) {
      toggleButton.addEventListener("click", function () {
        sidebar.classList.toggle("open");
      });
    }
  });
</script>

</body>

</html>
