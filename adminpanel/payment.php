<?php
// Include your database connection
include('../admin/db.php');

// Fetch payment records from the database
$query = "SELECT * FROM payments";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .card-header {
            font-size: 1.5rem;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>

    <!-- Sidebar (can be reused from your existing sidebar code) -->
    <?php include 'slidebar.php'; ?>

    <!-- Main Content Area -->
    <div class="main-content">
        <div class="container">
            <h3 class="mb-4"> Service Payments</h3>

            <!-- Payment Table -->
            <div class="card">
                <div class="card-header">
                    <h5>Payment Records</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Amount (FCFA)</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through each payment record
                            if (mysqli_num_rows($result) > 0) {
                                $counter = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td>" . $counter++ . "</td>
                                        <td>" . htmlspecialchars($row['service']) . "</td>
                                        <td>" . number_format($row['amount'], 2) . "</td>
                                        <td>" . htmlspecialchars($row['name']) . "</td>
                                        <td>" . htmlspecialchars($row['email']) . "</td>
                                        <td>" . htmlspecialchars($row['phone']) . "</td>
                                        <td>" . ucfirst($row['payment_status']) . "</td>
                                        <td>" . $row['payment_date'] . "</td>
                                        <td>
                                            <a href='view_payment.php?id=" . $row['payments_id'] . "' class='btn btn-info btn-sm'>View</a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9' class='text-center'>No payment records found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include necessary JS scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
