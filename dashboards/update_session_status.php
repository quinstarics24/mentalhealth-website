<?php
require_once "../includes/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["status"])) {
    $id = $_POST["id"];
    $status = $_POST["status"];

    $query = "UPDATE session_requests SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
