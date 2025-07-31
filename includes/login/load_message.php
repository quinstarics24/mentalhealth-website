<?php
session_start();
include '../../admin/db.php';  // Include your DB connection file


$receiver_id = 1;  // Replace with actual receiver ID logic

$sql = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY timestamp ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $_SESSION['user_id'], $receiver_id, $receiver_id, $_SESSION['user_id']);

if (!$stmt->execute()) {
    die("Error fetching messages: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No messages found.";
}

while ($row = $result->fetch_assoc()) {
    echo '<div class="message">';
    echo '<span class="sender">' . htmlspecialchars($row['sender_id']) . ':</span> ';
    echo '<span class="message-content">' . htmlspecialchars($row['message']) . '</span>';
    echo '<span class="timestamp">' . $row['timestamp'] . '</span>';
    echo '</div>';
}

$stmt->close();
?>