<?php
// Include the database connection
include_once 'db_connection.php';

// Fetch donations from the database
$query = $pdo->query("SELECT * FROM donations");
$donations = $query->fetchAll(PDO::FETCH_ASSOC);

// Handle deleting a donation
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM donations WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$delete_id]);

    // Redirect back to the donations page
    header("Location: donation.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Donations - SafeSpace Admin Dashboard</title>
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
        <div class="container mt-5">
            <h2>Existing Donations</h2>

        
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Amount</th>
                        <th>Message</th>
                        <th>Created At</th>
                        <th>Payment Method</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($donations as $donation): ?>
                        <tr>
                            <td><?php echo $donation['id']; ?></td>
                            <td><?php echo $donation['amount']; ?></td>
                            <td><?php echo $donation['message']; ?></td>
                            <td><?php echo $donation['created_at']; ?></td>
                            <td><?php echo $donation['payment_method']; ?></td>
                            <td>
                                <!-- Delete Donation Button -->
                                <a href="donation.php?delete_id=<?php echo $donation['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
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
