<?php
session_start();

// Check if the user is logged in and is a professional
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "professional") {
    header("Location: ../authentification/login.php");
    exit;
}

// Ensure user_id is set
if (!isset($_SESSION["user_id"])) {
    die("Error: User ID is not set in the session.");
}

require_once "../authentification/config.php"; // Database connection

$professional_id = $_SESSION['user_id'];  // Get the logged-in professional's ID

// Fetch session requests for the professional
$sql = "SELECT sr.id, sr.session_type, sr.session_date, sr.session_time, sr.user_message, sr.status, u.username 
        FROM session_requests sr
        JOIN users u ON sr.user_id = u.id
        WHERE sr.professional_id = ?";  // Fetch only requests for the logged-in professional

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $professional_id);  // Bind the professional ID
$stmt->execute();
$result = $stmt->get_result();  // Get the result
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Requests - SafeSpace</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Session Requests</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User Name</th>
                <th>Session Type</th>
                <th>Session Date</th>
                <th>Session Time</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Loop through all the session requests and display them
            while ($row = $result->fetch_assoc()) { 
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['session_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['session_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['session_time']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_message']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <!-- Approve and Reject buttons with the session ID -->
                        <a href="approve.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Approve</a>
                        <a href="reject.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Reject</a>
                    </td>
                </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
</div>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
