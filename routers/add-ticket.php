<?php
include '../includes/connect.php';
$subject = htmlspecialchars($_POST['subject']);
$description =  htmlspecialchars($_POST['description']);
$type = $_POST['type'];
$user_id = $_POST['id'];
if($type != ''){
	$sql = "INSERT INTO tickets (poster_id, subject, description, type) VALUES ($user_id, '$subject', '$description', '$type')";
	$con->query($sql) === TRUE;
}
header("location: ../tickets.php");
?>