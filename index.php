<?php
include 'includes/connect.php';
include 'includes/wallet.php';
echo '';




// 設定時區，確保顯示的時間是正確的
date_default_timezone_set('Asia/Taipei');

if($_SESSION['customer_sid']==session_id()) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <title>Order Food</title>
   
    <!-- CORE CSS-->
    <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">

    <style type="text/css">
        .input-field div.error {
            position: relative;
            top: -1rem;
            left: 0rem;
            font-size: 0.8rem;
            color: #FF4081;
            transform: translateY(0%);
        }
        .input-field label.active {
            width: 100%;
        }
        .left-alert input[type=text] + label:after, 
        .left-alert input[type=password] + label:after, 
        .left-alert input[type=email] + label:after, 
        .left-alert input[type=url] + label:after, 
        .left-alert input[type=time] + label:after,
        .left-alert input[type=date] + label:after, 
        .left-alert input[type=datetime-local] + label:after, 
        .left-alert input[type=tel] + label:after, 
        .left-alert input[type=number] + label:after, 
        .left-alert input[type=search] + label:after, 
        .left-alert textarea.materialize-textarea + label:after {
            left: 0px;
        }
        .right-alert input[type=text] + label:after, 
        .right-alert input[type=password] + label:after, 
        .right-alert input[type=email] + label:after, 
        .right-alert input[type=url] + label:after, 
        .right-alert input[type=time] + label:after,
        .right-alert input[type=date] + label:after, 
        .right-alert input[type=datetime-local] + label:after, 
        .right-alert input[type=tel] + label:after, 
        .right-alert input[type=number] + label:after, 
        .right-alert input[type=search] + label:after, 
        .right-alert textarea.materialize-textarea + label:after {
            right: 70px;
        }
    
        .side-nav {
            transition: transform 0.3s ease-in-out;
        }
        .side-nav.collapsed {
            transform: translateX(-100%);
        }
    </style> 
</head>

<body>
    <!-- Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    
    <!-- Header -->
    <header id="header" class="page-topbar">
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                        <li><h1 class="logo-wrapper"><a href="index.php" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="logo"></a> <span class="logo-text">Logo</span></h1></li>
                    </ul>
                    <ul class="right hide-on-med-and-down">                        
                        <li><a href="#" class="waves-effect waves-block waves-light"><i class="mdi-editor-attach-money"><?php echo $balance;?></i></a></li>
                    </ul>  
                </div>
            </nav>
           
        </div>
    </header>

    <!-- Main -->
    <?php include 'aside.php'; ?>


    <!-- -->

    <form action="order_food.php" method="post">
        <label for="order_type">選擇服務方式：</label>
        <select id="order_type" name="order_type" required>
            <option value="" disabled selected>請選擇</option>
            <option value="pickup">外帶</option>
            <option value="delivery">外送</option>
        </select>
        <br><br>
        <input type="submit" value="提交">
    </form>
    <?php
        $result = mysqli_query($con, "SELECT SUM(total) AS total_sum FROM orders WHERE customer_id= $user_id ");
        $row = mysqli_fetch_array($result);
        $sum_consumption = $row['total_sum'];
        echo '<br><span style="font-size: 20px;">本店消費累積: ' . $sum_consumption . '元' . '</span>';
    
        $result = mysqli_query($con, "SELECT MAX(total) AS highest_total FROM orders WHERE customer_id= $user_id ");
        $row = mysqli_fetch_array($result);
        $sum_consumption = $row['highest_total'];
        echo '<br><span style="font-size: 20px;">最高消費: ' . $sum_consumption . '元' . '</span>';
    
        $result = mysqli_query($con, "SELECT AVG(total) AS highest_total FROM orders WHERE customer_id= $user_id ");
        $row = mysqli_fetch_array($result);
        $sum_consumption = $row['highest_total'];
        $sum_consumption = number_format($sum_consumption, 2);
        echo '<br><span style="font-size: 20px;">平均消費: ' . $sum_consumption . '元' . '</span>';
    
    ?>
    <?php
        if (isset($_GET['error'])) {
            $error = $_GET['error'];
            if ($error == 'invalid_card') {
                echo '<p>卡號或 CVV 不正確，請重新輸入。</p>';
            }
            // 其他錯誤訊息處理
        }
    ?>
          

    <!-- Content -->
   

    <!-- Scripts -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="js/plugins/data-tables/data-tables-script.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            <?php
            $result = mysqli_query($con, "SELECT * FROM items where not deleted;");
            while($row = mysqli_fetch_array($result)) {
                echo $row["id"].':{
                    min: 0,
                    max: 10
                },';
            }
            echo '},';
            ?>
        messages: {
            <?php
            $result = mysqli_query($con, "SELECT * FROM items where not deleted;");
            while($row = mysqli_fetch_array($result)) {
                echo $row["id"].':{
                    min: "Minimum 0",
                    max: "Maximum 10"
                },';
            }
            echo '},';
            ?>
        errorElement : 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    </script>
</body>
</html>
<?php
} else {
    if($_SESSION['admin_sid']==session_id()) {
        header("location:admin-page.php");      
    } else {
        header("location:login.php");
    }
}
?>
