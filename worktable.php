<?php

session_start();

?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>班表</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>班表</h2>

<table>
    <thead>
        <tr>
            <th>時間</th>
            <th>星期一</th>
            <th>星期二</th>
            <th>星期三</th>
            <th>星期四</th>
            <th>星期五</th>
            <th>星期六</th>
            <th>星期日</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>早班</td>
            <?php $daysOfWeek = array("Monday", "Tuesday", "Wednesday", 
                "Thursday", "Friday", "Saturday", "Sunday");
            ?>
            <?php for ($i = 0; $i < 7; $i++): ?>
                <td>
                    <?php
                    if (isset($_SESSION['workname'][$daysOfWeek[$i]]['Morning'])) {
                        echo implode('<br>', $_SESSION['workname'][$daysOfWeek[$i]]['Morning']);
                    }
                    ?>
                </td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td>中班</td>
            <?php for ($i = 0; $i < 7; $i++): ?>
                <td>
                    <?php
                    if (isset($_SESSION['workname'][$daysOfWeek[$i]]['Afternoon'])) {
                        echo implode('<br>', $_SESSION['workname'][$daysOfWeek[$i]]['Afternoon']);
                    }
                    ?>
                </td>
            <?php endfor; ?>
        </tr>
        <tr>
            <td>晚班</td>
            <?php for ($i = 0; $i < 7; $i++): ?>
                <td>
                    <?php
                    if (isset($_SESSION['workname'][$daysOfWeek[$i]]['Evening'])) {
                        echo implode('<br>', $_SESSION['workname'][$daysOfWeek[$i]]['Evening']);
                    }
                    ?>
                </td>
            <?php endfor; ?>
        </tr>
    </tbody>
</table>
        
</body>
</html>

