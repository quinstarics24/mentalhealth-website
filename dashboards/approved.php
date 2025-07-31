<?php
session_start();
require_once "../authentification/config.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["role"] !== "professional") {
    header("Location: ../authentification/login.php");
    exit;
}

if (isset($_GET["id"])) {
    $id = intval($_GET["id"]);
    $sql = "UPDATE session_requests SET status = 'Approved' WHERE id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    header("Location: messages.php");
    exit;
}
?>
