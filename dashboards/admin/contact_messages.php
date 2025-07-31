<?php
session_start();
include '../../includes/config.php'; // Ensure this file connects to your database

// Fetch paginated messages
$limit = 10;  // Number of messages per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch messages from the database
$sql = "SELECT * FROM contact_messages ORDER BY submitted_at DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Get total number of messages for pagination
$totalMessagesQuery = "SELECT COUNT(*) AS total FROM contact_messages";
$totalMessagesResult = $conn->query($totalMessagesQuery);
$totalMessages = $totalMessagesResult->fetch_assoc()['total'];
$totalPages = ceil($totalMessages / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        .container {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        .table-responsive {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 992px) {
            .container { margin-left: 0; }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <?php include 'sidebar.php'; ?>
        <div class="container">
            <h2 class="mb-4">Contact Messages</h2>
            <input type="text" id="search" class="form-control mb-3" placeholder="Search messages...">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="messageTable">
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['phone']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                            <td><?= $row['submitted_at'] ?></td>
                            <td>
                                <a href="reply.php?message_id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Reply</a>
                                <a href="delete.php?message_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="btn btn-link"><?= $i ?></a>
                <?php endfor; ?>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll('#messageTable tr');
            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(value) ? '' : 'none';
            });
        });
    </script>
</body>
</html>
