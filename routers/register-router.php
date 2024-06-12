<?php
include '../includes/connect.php';

$password = htmlspecialchars($_POST['password']);
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$username = $_POST['username'];

function number($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

$sql = "INSERT INTO users (username, password, email, contact,role) VALUES ('$username', '$password', '$email', '$phone','Customer');";
if($con->query($sql)==true){
    $user_id =  $con->insert_id;
	$cc_number = number(16);
	$cvv_number = number(3);
	$sql = "INSERT INTO wallet_details(customer_id, number, cvv) VALUES ($user_id, $cc_number, $cvv_number)";
	$con->query($sql);
}
header("location: ../login.php");
?>