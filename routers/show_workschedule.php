<?php
include '../includes/connect.php';

$employeeSql = "SELECT E.name, W.day, W.shift FROM employees AS E, workschedules AS W
WHERE E.employee_id = W.employee_id;";
$scheduleResult = $con->query($employeeSql);


$_SESSION['workname'] = [];
if ($scheduleResult->num_rows > 0) {
    while ($row = $scheduleResult->fetch_assoc()) {
        $_SESSION['workname'][$row['day']][$row['shift']][] = $row['name'];
    }
}

echo '<pre>';
print_r($_SESSION['workname']);
echo '</pre>';

?>