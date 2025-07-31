<?php
include '../../includes/config.php';

if (isset($_GET['message_id'])) {
    $messageId = (int)$_GET['message_id'];

    // Delete message from the database
    $sql = "DELETE FROM contact_messages WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $messageId);
    if ($stmt->execute()) {
        header('Location: contact_messages.php'); // Redirect to the message list after deletion
    } else {
        echo "Error deleting message.";
    }
}
?>
