<?php
include '../includes/connect.php';

if (!isset($_SESSION['user_id'])) {
    // 如果沒有設置 'id'，重定向到登入頁面或者其他處理
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$current_password = strval($_POST['current_password']);
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

$result = mysqli_query($con, "SELECT password FROM users WHERE id='$user_id';");
$row = mysqli_fetch_array($result);

$new_password = $con->real_escape_string($new_password);
if ($current_password == $row['password']) {
    if($new_password == $confirm_password){
        $sql = "UPDATE users SET password = '$new_password' WHERE id = $user_id;";
        if($con->query($sql)==true){
            $_SESSION['name'] = $name;
        }   
        $_SESSION['password_message'] = "更新成功";
    }
    else{
        $_SESSION['password_message'] = "新密碼舊密碼不同";
    }
}
else{
    $_SESSION['password_message'] = '密碼與先前不符';
}
header("location:../password_change.php");

?>
