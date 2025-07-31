<?php
// Database connection
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $sessionId = $_POST['session_id'];
    $professionalReply = $_POST['response'];
    $userId = $_POST['user_id'];  // User ID to notify
    $professionalId = $_POST['professional_id']; // Professional ID to link the notification

    // Save the professional reply to the session request table
    $query = "UPDATE session_requests SET professional_reply = ?, status = 'Completed' WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $professionalReply, $sessionId);
    $stmt->execute();

    // Insert the notification into the notifications table
    $notificationQuery = "INSERT INTO notifications (user_id, message, status, professional_id) 
                          VALUES (?, ?, 'Pending', ?)";
    $notificationStmt = $conn->prepare($notificationQuery);
    $notificationMessage = "You have a new response from the professional: $professionalReply";
    $notificationStmt->bind_param("isi", $userId, $notificationMessage, $professionalId);
    $notificationStmt->execute();

    // Check if the query was successful
    if ($stmt->affected_rows > 0 && $notificationStmt->affected_rows > 0) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
