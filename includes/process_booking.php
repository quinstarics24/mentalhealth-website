<?php
session_start();
include '../authentification/config.php'; // Database connection

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id']; // Assuming user is logged in
    $professional_id = $_POST['professional_id'];
    $session_type = $_POST['sessionType'];
    $session_date = $_POST['sessionDate'];
    $session_time = $_POST['sessionTime'];
    $user_message = $_POST['userMessage'];
    $payment_method = $_POST['paymentMethod'];

    // Insert into session_requests table
    $stmt = $conn->prepare("INSERT INTO session_requests (user_id, professional_id, session_type, session_date, session_time, user_message, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssss", $user_id, $professional_id, $session_type, $session_date, $session_time, $user_message, $payment_method);
    
    if ($stmt->execute()) {
        // Insert notification for user
        $message = "Your session request with Professional ID $professional_id is pending approval.";
        $notif_stmt = $conn->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
        $notif_stmt->bind_param("is", $user_id, $message);
        $notif_stmt->execute();

        echo json_encode(["status" => "success", "message" => "Session request submitted successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to submit session request."]);
    }

    $stmt->close();
    $notif_stmt->close();
    $conn->close();
}
?>

