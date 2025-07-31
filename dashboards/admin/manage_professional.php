<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "safespace"; // Change to your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle deletion of a professional
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    $deleteSql = "DELETE FROM professionals WHERE id = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $deleteId);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Professional deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error deleting professional: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Handle banning/unbanning a professional
if (isset($_GET['ban_id'])) {
    $banId = $_GET['ban_id'];
    $banSql = "UPDATE professionals SET status = 'banned' WHERE id = ?";
    $stmt = $conn->prepare($banSql);
    $stmt->bind_param("i", $banId);
    $stmt->execute();
    $stmt->close();
}

if (isset($_GET['unban_id'])) {
    $unbanId = $_GET['unban_id'];
    $unbanSql = "UPDATE professionals SET status = 'active' WHERE id = ?";
    $stmt = $conn->prepare($unbanSql);
    $stmt->bind_param("i", $unbanId);
    $stmt->execute();
    $stmt->close();
}

// Handle adding a new professional
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_professional'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    $insertSql = "INSERT INTO professionals (username, email, phone, role, status) VALUES (?, ?, ?, ?, 'active')";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("ssss", $username, $email, $phone, $role);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Professional added successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error adding professional: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Fetch professionals
$sql = "SELECT id, username, email, phone, role, created_at, status FROM professionals";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Professionals</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar styling */
        .sidebar {
            width: 250px;
            position: fixed;
            height: 100%;
            background: #343a40;
            color: white;
            padding: 20px;
            top: 0;
            left: 0;
        }

        /* Content wrapper styling */
        .content-wrapper {
            margin-left: 250px;
            padding: 30px;
        }

        .table {
            margin-top: 20px;
        }

        .btn-custom {
            font-size: 14px;
            font-weight: 500;
        }

        .status-active {
            color: green;
            font-weight: bold;
        }

        .status-banned {
            color: red;
            font-weight: bold;
        }

        /* Responsive styling for mobile devices */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
            }
            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <?php include 'sidebar.php'; ?>
    </div>

    <!-- Main Content -->
    <div class="content-wrapper">
        <h1 class="my-4">Manage Professionals</h1>

        <!-- Add Professional Form -->
        <form method="POST" class="mb-4">
            <h4>Add New Professional</h4>
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="col-md-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                </div>
                <div class="col-md-2">
                    <select name="role" class="form-control">
                        <option value="doctor">Doctor</option>
                        <option value="therapist">Therapist</option>
                        <option value="counselor">Counselor</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" name="add_professional" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>

        <!-- Display Professionals -->
        <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($professional = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $professional['id']; ?></td>
                    <td><?php echo htmlspecialchars($professional['username']); ?></td>
                    <td><?php echo htmlspecialchars($professional['email']); ?></td>
                    <td><?php echo htmlspecialchars($professional['phone']); ?></td>
                    <td><?php echo ucfirst(htmlspecialchars($professional['role'])); ?></td>
                    <td class="<?php echo $professional['status'] == 'active' ? 'status-active' : 'status-banned'; ?>">
                        <?php echo ucfirst($professional['status']); ?>
                    </td>
                    <td><?php echo $professional['created_at']; ?></td>
                    <td>
                        <a href="?delete_id=<?php echo $professional['id']; ?>" class="btn btn-danger btn-custom"
                            onclick="return confirm('Are you sure you want to delete this professional?')">Delete</a>
                        <?php if ($professional['status'] == 'active'): ?>
                            <a href="?ban_id=<?php echo $professional['id']; ?>" class="btn btn-warning btn-custom">Ban</a>
                        <?php else: ?>
                            <a href="?unban_id=<?php echo $professional['id']; ?>" class="btn btn-success btn-custom">Unban</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>No professionals found.</p>
        <?php endif; ?>
    </div>

</body>
</html>
