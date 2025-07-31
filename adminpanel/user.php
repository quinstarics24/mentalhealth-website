<?php
// Include the database connection
include_once 'db_connection.php';

// Fetch users from the database
$query = $pdo->query("SELECT * FROM users");
$users = $query->fetchAll(PDO::FETCH_ASSOC);


// Handle deleting a user
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$delete_id]);

    // Redirect back to the users page
    header("Location: user.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Users - SafeSpace Admin Dashboard</title>
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
    }

    .sidenav {
      height: 100vh;
      position: fixed;
      width: 250px;
      background-color: #ffffff;
      border-right: 1px solid #e9ecef;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .sidenav .nav-link {
      display: flex;
      align-items: center;
      font-size: 16px;
      padding: 15px 20px;
      color: #333;
      transition: all 0.3s ease;
      border-radius: 8px;
      margin: 5px 15px;
    }

    .sidenav .nav-link.active {
      background-color:rgb(133, 174, 228);
      color: #fff !important;
      font-weight: 500;
    }

    .sidenav .nav-link:hover {
      background-color: #e9ecef;
      color:rgb(92, 135, 184) !important;
    }

    .sidenav .nav-link i {
      font-size: 18px;
      margin-right: 10px;
    }

    .main-content {
      margin-left: 260px;
      padding: 30px;
    }

    .main-content h1 {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .card {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }

    .card h5 {
      font-weight: 600;
      font-size: 18px;
    }

    .btn-custom {
      font-size: 14px;
      font-weight: 500;
    }

    .notification-section {
      margin-top: 30px;
    }

    .notification-card {
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 8px;
      background: #fff;
      margin-bottom: 20px;
    }

    .notification-card .notification-title {
      font-size: 16px;
      font-weight: bold;
    }

    .notification-card .notification-body {
      font-size: 14px;
      margin: 10px 0;
    }

    @media (max-width: 992px) {
      .sidenav {
        width: 100%;
        height: auto;
        position: relative;
      }

      .main-content {
        margin-left: 0;
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
            <h2>Existing Users</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td>
                                
                                <!-- Delete User Button -->
                                <a href="user.php?delete_id=<?php echo $user['id']; ?>" class="btn btn-danger">Delete</a>
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
