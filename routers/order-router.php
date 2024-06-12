<?php
include '../includes/connect.php';
include '../includes/wallet.php';
$total = 0;
$address = htmlspecialchars($_POST['address']);
$description =  'test';
$payment_type = $_POST['payment_type'];
$total = $_POST['total'];
$orderTime = $_POST['ordertime'];
$order_type = $_POST['order_type'];

	$sql = "INSERT INTO orders (customer_id, payment_type, address, total, description, date,status) VALUES ($user_id, '$payment_type', '$address', $total, '$description', '$orderTime','$order_type')";
	if ($con->query($sql) === TRUE){
		$order_id =  $con->insert_id;
		foreach ($_POST['items'] as $key => $value)
		{
			$quantity = $value['quantity'];
            $sweet = isset($value['sweet']) ? $value['sweet'] : '';
            $ice = isset($value['ice']) ? $value['ice'] : '';
			$order_type = isset($value['order_type']) ? $value['order_type'] : '';
		

			$result = mysqli_query($con, "SELECT * FROM items WHERE it_id = $key");
			while($row = mysqli_fetch_array($result))
			{
				$price = $row['price'];
			}
				$price = $quantity * $price;

				$sql = "INSERT INTO order_details (order_id, item_id, quantity, price, sweet, ice) VALUES ($order_id, $key, $quantity, $price, '$sweet', '$ice')";
				if ($con->query($sql) === TRUE) {
					// 插入成功
				} else {
					// 插入失败，记录错误信息
					error_log("Error inserting order details: " . $con->error);
				}	
			
		}
		if($_POST['payment_type'] == 'Wallet'){
		$balance = $balance - $total;
		$sql = "UPDATE wallet_details SET balance = $balance WHERE customer_id = $user_id;";
		$con->query($sql) === TRUE;
		}
			header("Location: ../orders.php?ice=" . urlencode($ice));
	}

?>