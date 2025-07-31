<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "safespace";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["notification_id"]) && isset($_POST["response"])) {
    $notification_id = $_POST["notification_id"];
    $response = trim($_POST["response"]);

    if (!empty($response)) {
        $sql = "UPDATE notifications SET response = ?, status = 'Read' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $response, $notification_id);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "error";
        }
        $stmt->close();
    } else {
        echo "error";
    }
}
$conn->close();
?>
