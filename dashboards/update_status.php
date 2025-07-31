<?php
session_start();
require_once "../authentification/config.php";

// Check if professional is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "professional") {
    header("location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["session_id"]) && isset($_POST["status"])) {
    $session_id = $_POST["session_id"];
    $new_status = $_POST["status"];

    // Update status in database
    $sql = "UPDATE session_requests SET status = ? WHERE id = ? AND professional_id = ?";
    
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sii", $new_status, $session_id, $_SESSION["professional_id"]);
        if ($stmt->execute()) {
            header("location: messages.php"); // Redirect back to message page
            exit();
        } else {
            echo "Error updating status.";
        }
        $stmt->close();
    }
}
$mysqli->close();
?>
