<?php

include 'connect.php'; // 确保包含数据库连接文件

// 检查是否已设置 user_id
if (!isset($_SESSION['user_id'])) {
    die("User ID is not set.");
}

$user_id = $_SESSION['user_id'];

// 使用预处理语句以防止 SQL 注入
$stmt = $con->prepare("SELECT balance FROM wallet_details WHERE customer_id = ?");
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    while ($row1 = $result->fetch_assoc()) {
        $balance = $row1['balance'];
    }
} else {
    echo "Error: " . $stmt->error;
}

// 关闭预处理语句
$stmt->close();
?>
