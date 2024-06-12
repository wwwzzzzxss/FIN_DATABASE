<?php
include 'includes/connect.php';
include 'includes/wallet.php';
$continue=0;
$total = 0;
$contact = $_POST['contact'];

if($_SESSION['customer_sid']==session_id())
{
    /* 確認卡號是否正確 */
		if($_POST['payment_type'] == 'Wallet'){
		$_POST['cc_number'] = str_replace('-', '', $_POST['cc_number']);
		$_POST['cc_number'] = str_replace(' ', '', $_POST['cc_number']); 
		$_POST['cvv_number'] = (int)str_replace('-', '', $_POST['cvv_number']);
		$sql1 = mysqli_query($con, "SELECT * FROM wallet_details where customer_id = $user_id");
        while($row1 = mysqli_fetch_array($sql1)){
			$card = $row1['number'];
			$cvv = $row1['cvv'];
			if($card == $_POST['cc_number'] && $cvv==$_POST['cvv_number'])
			    $continue=1;
			else{
                header('Location: index.php?error=invalid_card');
                exit();
            }
		}
		}
		else
			$continue=1;
            
}

$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){
	$name = $row['username'];
}

if($continue){
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Provide Order Details</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <!-- Custome CSS-->    
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">

  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">

</head>

<body>
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START HEADER -->
  <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="index.php" class="brand-logo darken-1"><img src="images/materialize-logo.png" alt="logo"></a> <span class="logo-text">Logo</span></h1></li>
                    </ul>
                    <ul class="right hide-on-med-and-down">                        
                        <li><a href="#" class="waves-effect waves-block waves-light"><i class="mdi-editor-attach-money"><?php echo $balance;?></i></a>
                        </li>
                    </ul>					
                </div>
            </nav>
        </div>
        <!-- end header nav-->
  </header>
  <!-- END HEADER -->

  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START MAIN -->
  <div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">

      <!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="images/avatar.jpg" alt="" class="circle responsive-img valign profile-image">
                </div>
				<div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a href="routers/logout.php"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="col col s8 m8 l8">
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $name;?> <i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php echo $role;?></p>
                </div>
            </div>
            </li>
            <li class="bold"><a href="index.php" class="waves-effect waves-cyan"><i class="mdi-editor-border-color"></i> Order Food</a>
            </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Orders</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="orders.php">All Orders</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM orders WHERE customer_id = $user_id;");
									while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="orders.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-question-answer"></i> Tickets</a>
                            <div class="collapsible-body">
                                <ul>
								<li><a href="tickets.php">All Tickets</a>
                                </li>
								<?php
									$sql = mysqli_query($con, "SELECT DISTINCT status FROM tickets WHERE poster_id = $user_id AND not deleted;");
									while($row = mysqli_fetch_array($sql)){
                                    echo '<li><a href="tickets.php?status='.$row['status'].'">'.$row['status'].'</a>
                                    </li>';
									}
									?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>				
            <li class="bold"><a href="details.php" class="waves-effect waves-cyan"><i class="mdi-social-person"></i> Edit Details</a>
            </li>				
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Provide Order Details</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">Receipt</p>
          <div class="divider"></div>
          <!--editableTable-->
<div id="work-collections" class="seaction">
<div class="row">
<div>
<ul id="issues-collection" class="collection">
<?php
    echo '<li class="collection-item avatar">
        <i class="mdi-content-content-paste red circle"></i>
        <p><strong>Name:</strong>'.$name.'</p>
		<p><strong>Contact Number:</strong> '.$contact.'</p>
		<p><strong>Address:</strong> '.htmlspecialchars($_POST['address']).'</p>	
		<p><strong>Payment Type:</strong> '.$_POST['payment_type'].'</p>
        <p><strong>Note:</strong> '.$_POST['description'].'</p>
        		
        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>';
		

        foreach ($_POST['items'] as $key => $value) {        
            // 确保 $value 是数组且包含 'quantity' 键
            if (!isset($value['quantity']) || $value['quantity'] == 0) {
                continue; // 如果没有数量，跳过该项而不是中断整个循环
            }
            $quantity = $value['quantity'];
            $sweet = isset($value['sweet']) ? $value['sweet'] : '';
            $ice = isset($value['ice']) ? $value['ice'] : '';    
       }

       $total = 0; // 初始化 total
       foreach ($_POST['items'] as $key => $value) {
         
         
         // 确保 $value 是数组且包含 'quantity' 键
         if (!isset($value['quantity']) || $value['quantity'] == 0) {
             continue; // 如果没有数量，跳过该项而不是中断整个循环
         }
         

         $quantity = $value['quantity'];
         $sweet = isset($value['sweet']) ? $value['sweet'] : '';
         $ice = isset($value['ice']) ? $value['ice'] : '';
 

         echo '<input type="hidden" name="items[' . $key . '][quantity]" id="item' . $key . '" value="' . $quantity . '">';
         echo '<input type="hidden" name="items[' . $key . '][ice]" id="item' . $key . '" value="' . $ice . '">';
         echo '<input type="hidden" name="items[' . $key . '][sweet]" id="item' . $key . '" value="' . $sweet . '">';
         
       
         // 检查 $quantity 是否为数字
         if (is_numeric($quantity)) {
             $result = mysqli_query($con, "SELECT * FROM items WHERE it_id = $key");
     
             // 处理查询结果
             while ($row = mysqli_fetch_array($result)) {
                 $price = $row['price'];
                 $item_name = $row['name'];
                 $item_id = $row['it_id'];
             }
             // 计算价格
             $price = $quantity * $price;
             echo '<li class="collection-item">
                     <div class="row">
                         <div class="col s7">
                             <p class="collections-title"><strong>#' . $item_id . ' </strong>' . $item_name . '</p>
                         </div>
                         <div class="col s2">
                             <span>' . $quantity . ' 件</span>
                         </div>
                         <div class="col s3">
                             <span>Rs. ' . $price . '</span>
                         </div>';
     
             if (!empty($sweet)) {
                 echo '<div class="col s4"><span>甜度:'. $sweet . '</span></div>';
             }
     
             if (!empty($ice)) {
                 echo '<div class="col s5"><span>冰塊:' . $ice . '</span></div>';
             }
 
             echo '</div></li>';
     
             // 累加总价格
             $total += $price;
         }
     }

    echo '<li class="collection-item">
        <div class="row">
            <div class="col s7">
                <p class="collections-title"> Total</p>
            </div>
            <div class="col s2">
                <span>&nbsp;</span>
            </div>
            <div class="col s3">
                <span><strong>Rs. '.$total.'</strong></span>
            </div>
        </div>
    </li>';
	
	if($_POST['payment_type'] == 'Wallet')
	echo '<div id="basic-collections" class="section">
		<div class="row">
			<div class="collection">
				<a href="#" class="collection-item">
					<div class="row"><div class="col s7">Current Balance</div><div class="col s3">'.$balance.'</div></div>
				</a>
				<a href="#" class="collection-item active">
					<div class="row"><div class="col s7">Balance after purchase</div><div class="col s3">'.($balance-$total).'</div></div>
				</a>
			</div>
		</div>
	</div>';
?>
<form action="routers/order-router.php" method="post">
    <?php
        foreach ($_POST['items'] as $key => $value) {        
            // 确保 $value 是数组且包含 'quantity' 键
            if (!isset($value['quantity']) || $value['quantity'] == 0) {
                continue; // 如果没有数量，跳过该项而不是中断整个循环
            }
            $quantity = $value['quantity'];
            $sweet = isset($value['sweet']) ? $value['sweet'] : '';
            $ice = isset($value['ice']) ? $value['ice'] : '';
            $nood_type = isset($value['nood_type']) ? $value['nood_type'] : '';
    
            echo '<input type="hidden" name="items[' . $key . '][quantity]" id="item' . $key . '" value="' . $quantity . '">';
            echo '<input type="hidden" name="items[' . $key . '][ice]" id="item' . $key . '" value="' . $ice . '">';
            echo '<input type="hidden" name="items[' . $key . '][sweet]" id="item' . $key . '" value="' . $sweet . '">';
            echo '<input type="hidden" name="items[' . $key . '][nood_type]" id="item' . $key . '" value="' . $nood_type . '">';
 
        }
    ?>
    
<input type="hidden" name="order_type" value="<?php echo isset($_POST['order_type']) ? htmlspecialchars($_POST['order_type']) : ''; ?>">

<input type="hidden" name="payment_type" value="<?php echo $_POST['payment_type'];?>">
<input type="hidden" name="address" value="<?php echo htmlspecialchars($_POST['address']);?>">
<input type="hidden" name="day" value="<?php echo htmlspecialchars($_POST['day']);?>">
<input type="hidden" name="month" value="<?php echo htmlspecialchars($_POST['month']);?>">

<?php 
$year = strval(date('Y'));
$month = isset($_POST['month']) ? str_pad(intval($_POST['month']), 2, '0', STR_PAD_LEFT) : '00';
$day = isset($_POST['day']) ? str_pad(intval($_POST['day']), 2, '0', STR_PAD_LEFT) : '00';
$hour = isset($_POST['hour']) ? str_pad(intval($_POST['hour']), 2, '0', STR_PAD_LEFT) : '00';
$minute = isset($_POST['minute']) ? str_pad(intval($_POST['minute']), 2, '0', STR_PAD_LEFT) : '00';
$orderTime = $year . '-' . $month . '-' . $day . ' ' . $hour . ':' . $minute . ':00'; // 确保格式为 "YYYY-MM-DD HH:MM:00"
?>

<input type="hidden" name="ordertime" value="<?php echo $orderTime; ?>">

<?php if (isset($_POST['description'])) { echo'<input type="hidden" name="description" value="'.htmlspecialchars($_POST['description']).'">';}?>
<?php if($_POST['payment_type'] == 'Wallet') echo '<input type="hidden" name="balance" value="<?php echo ($balance-$total);?>">'; ?>
<input type="hidden" name="total" value="<?php echo $total;?>">
<div class="input-field col s12">
<button class="btn cyan waves-effect waves-light right" type="submit" name="action" <?php if($_POST['payment_type'] == 'Wallet') {if ($balance-$total < 0) {echo 'disabled'; }}?>>Confirm Order
<i class="mdi-content-send right"></i>
</button>
</div>
</form>
</ul>


                </div>
				</div>
                </div>
              </div>
            </div>
        </div>
        <!--end container-->

      </section>
      <!-- END CONTENT -->
    </div>
    <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->



  <!-- //////////////////////////////////////////////////////////////////////////// -->

  <!-- START FOOTER -->
  <footer class="page-footer">
    <div class="footer-copyright">
    
    </div>
  </footer>
    <!-- END FOOTER -->



    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>    
    <!--angularjs-->
    <script type="text/javascript" src="js/plugins/angular.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script> 
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
</body>

</html>
<?php
	}
	else
	{
		if($_SESSION['admin_sid']==session_id())
		{
			header("location:admin-page.php");		
		}
		
	}
?>
