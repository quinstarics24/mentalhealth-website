<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "safespace"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the deletion of a user
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteSql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $deleteId);
    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>User deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error deleting user: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Fetch users from the database (including phone numbers)
$sql = "SELECT id, username, email, phone, role FROM users"; // Added phone field
$result = $conn->query($sql);

// Close the connection after fetching the data
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
        }

        .sidebar {
            background-color: #343a40;
            color: white;
            width: 250px;
            min-height: 100vh;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .main-content {
            margin-left: 270px;
            padding: 20px;
            width: calc(100% - 270px);
        }

        .card {
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            font-size: 14px;
            font-weight: 500;
        }

        .status {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <?php include 'sidebar.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="mb-4">Manage Users</h1>

            <?php if (isset($_GET['delete_id'])): ?>
            <div class="alert alert-info" role="alert">
                User has been deleted. Refreshing the page to reflect the change.
            </div>
            <?php endif; ?>

            <div class="card p-4">
                <?php if ($result->num_rows > 0): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th> <!-- Added Phone Column -->
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['phone']; ?></td> <!-- Displaying Phone -->
                            <td class="status"><?php echo ucfirst($user['role']); ?></td>
                            <td>
                                <a href="?delete_id=<?php echo $user['id']; ?>" class="btn btn-danger btn-custom"
                                    onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p>No users found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
