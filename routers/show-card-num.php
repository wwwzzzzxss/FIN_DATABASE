<?php
include '../includes/connect.php';

if (!isset($_SESSION['user_id'])) {
    // 如果沒有設置 'id'，重定向到登入頁面或者其他處理
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$current_password = strval($_POST['current_password']);

$result = mysqli_query($con, "SELECT password FROM users WHERE id='$user_id';");
$row = mysqli_fetch_array($result);


if ($current_password == $row['password']) {
    $result = mysqli_query($con, "SELECT cvv,number FROM wallet_details WHERE customer_id='$user_id';");
    $row = mysqli_fetch_array($result);
    $_SESSION['cvv'] = $row['cvv'];
    $_SESSION['number'] = $row['number'];
    $result = mysqli_query($con, "UPDATE users SET verified = 1 WHERE id='$user_id';");
}
else{
    $_SESSION['password_message'] = '密碼錯誤';
}
header("location:../verify.php");

?>
