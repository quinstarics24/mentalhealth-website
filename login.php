<?php
    session_start();

    $fname ="admin";
    $password ="0000";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $input_username = $_POST["fname"];
    $input_password = $_POST["password"];

if($input_username === $fname && $input_password === $password){
    $_SESSION["loggedin"] = true;

header("Location: dashboards/admin.php");
    exit;
} else{
$error ="Invalid username or password";
}

}
?>