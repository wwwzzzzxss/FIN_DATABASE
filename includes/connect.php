<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$servername = "localhost";
$server_user = "root";
$server_pass = "qwe123zxcnmq";
$dbname = "food1";
$name = $_SESSION['name'];
$role = $_SESSION['role'];

$con = new mysqli($servername, $server_user, $server_pass, $dbname);
?>