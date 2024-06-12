<?php
include '../includes/connect.php';

// 使用预处理语句以防止 SQL 注入
$stmt = $con->prepare("INSERT INTO items (name, price, type) VALUES (?, ?, ?)");
$stmt->bind_param("sds", $name, $price, $type);

$name = $_POST['name'];
$price = $_POST['price'];
$type = $_POST['type'];

// 执行插入操作
if ($stmt->execute() === TRUE) {
    // 获取最后插入的ID
    $last_id = $stmt->insert_id;

    // 根据类型插入到相应的表中
    if($type == 'N') {
        $stmt_noodles = $con->prepare("INSERT INTO noodles (noodle_id) VALUES (?)");
        $stmt_noodles->bind_param("i", $last_id);
        $stmt_noodles->execute();
        $stmt_noodles->close();
    } elseif($type == 'D') {
        $stmt_drinks = $con->prepare("INSERT INTO drinks (drinks_id) VALUES (?)");
        $stmt_drinks->bind_param("i", $last_id);
        $stmt_drinks->execute();
        $stmt_drinks->close();
    }
}

// 关闭预处理语句
$stmt->close();

// 重定向到 admin-page.php
header("location: ../admin-page.php");
?>
