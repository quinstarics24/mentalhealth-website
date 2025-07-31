<?php
require_once "../pages/config.php";

$id = $_GET['id'];
$mysqli->query("DELETE FROM movers WHERE id = $id");

header("Location: ../pages/movers.php");
exit();
?>
