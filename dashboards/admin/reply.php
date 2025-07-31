<?php
include '../../includes/config.php';

if (isset($_GET['message_id'])) {
    $messageId = (int)$_GET['message_id'];

    // Fetch the message details
    $sql = "SELECT * FROM contact_messages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $messageId);
    $stmt->execute();
    $result = $stmt->get_result();
    $message = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reply = $_POST['reply'];

        // Send reply via email or store it in the database (implement as needed)
        // For simplicity, just show the reply here
        echo "<p>Reply sent: " . htmlspecialchars($reply) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Message</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Reply to Message</h2>
        <form method="POST">
            <div class="form-group mb-3">
                <label for="reply">Your Reply</label>
                <textarea name="reply" id="reply" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Reply</button>
        </form>
    </div>
</body>
</html>
