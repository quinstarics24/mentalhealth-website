<?php
require_once "../includes/config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["reply"])) {
    $session_id = $_POST["id"];
    $reply = $_POST["reply"];
    $professional_id = $_SESSION["id"];

    // Fetch user_id from session_requests
    $query = "SELECT user_id FROM session_requests WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $session_id);
    $stmt->execute();
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $stmt->close();

    // Insert reply into notifications
    $query = "INSERT INTO notifications (user_id, message) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $user_id, $reply);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
