<?php
include '../includes/connect.php';

$status = isset($_GET['status']) ? $_GET['status'] : '%';

$query = "SELECT o.id, o.date, o.payment_type, o.status, o.deleted, o.address, o.total, 
                 u.username AS customer_name, u.contact AS customer_contact, u.email AS customer_email 
          FROM orders o 
          LEFT JOIN users u ON o.customer_id = u.id
          WHERE o.status LIKE ?";
$stmt = $con->prepare($query);
$stmt->bind_param('s', $status);
$stmt->execute();
$result = $stmt->get_result();

$orders = array();

while ($row = $result->fetch_assoc()) {
    $order = array(
        'id' => $row['id'],
        'date' => $row['date'],
        'payment_type' => $row['payment_type'],
        'status' => $row['status'],
        'deleted' => $row['deleted'],
        'address' => $row['address'],
        'total' => $row['total'],
        'customer_name' => $row['customer_name'],
        'customer_contact' => $row['customer_contact'],
        'customer_email' => $row['customer_email'],
        'details' => array()
    );

    $order_id = $row['id'];
    $details_query = "SELECT od.item_id, od.quantity, od.price, i.name AS item_name 
                      FROM order_details od 
                      LEFT JOIN items i ON od.item_id = i.it_id 
                      WHERE od.order_id = ?";
    $details_stmt = $con->prepare($details_query);
    $details_stmt->bind_param('i', $order_id);
    $details_stmt->execute();
    $details_result = $details_stmt->get_result();

    while ($details_row = $details_result->fetch_assoc()) {
        $item = array(
            'id' => $details_row['item_id'],
            'name' => $details_row['item_name'],
            'quantity' => $details_row['quantity'],
            'price' => $details_row['price']
        );
        $order['details'][] = $item;
    }

    $orders[] = $order;
}

echo json_encode($orders);
?>
