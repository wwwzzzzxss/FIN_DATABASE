<?php
include 'includes/connect.php';
include 'includes/wallet.php';


$total = 0;
	if($_SESSION['customer_sid']==session_id())
	{
$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){
$name = $row['username'];	
$address = $row['address'];
$verified = $row['verified'];
}
		?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Provide Order Details</title>
  <script src="js/updateDays.js"></script>

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

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
       <style type="text/css">
  .input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
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
  .left-alert textarea.materialize-textarea + label:after{
      left:0px;
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
  .right-alert textarea.materialize-textarea + label:after{
      right:70px;
  }
  </style>
</head>


<body>
  <?php include 'aside.php'; ?>
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


<div class="container">
  <div class="row">
        <div class="row">
          <form class="formValidate col s12 m12 l6" id="formValidate" method="post" action="confirm-order.php" novalidate="novalidate">
          <input type="hidden" name="order_type" value="<?php echo isset($_POST['order_type']) ? htmlspecialchars($_POST['order_type']) : ''; ?>">

          <div>
      <div class="card-panel">
        <div class="form-group">
          <!-- 月份選擇 -->
          <label for="month">選擇月份：</label>
          
          <select id="month" name="month">
            <?php
            for ($m = 1; $m <= 12; $m++) {
              $month = str_pad($m, 2, '0', STR_PAD_LEFT);
              echo "<option value=\"$month\">{$m}月</option>";
            }
            ?>
          </select>

          <!-- 日期選擇 -->     
            <label for="day">選擇日期：</label>
            <label for="hour">選擇日期：</label>
            <select id="day" name="day">
              <!-- 日期選項將由JavaScript動態生成 -->
            </select>
        

          <!-- 小時選擇 -->
          <label for="hour">選擇小時：</label>
          <label for="hour">選擇小時：</label>
          <select id="hour" name="hour">
            <?php
            for ($h = 0; $h <= 23; $h++) {
              $hour = str_pad($h, 2, '0', STR_PAD_LEFT);
              echo "<option value=\"$hour\">$hour</option>";
            }
            ?>
          </select>

          <!-- 分鐘選擇，每15分鐘 -->
          <label for="minute">選擇分鐘：</label>
          <label for="minute">選擇分鐘：</label>
          <select id="minute" name="minute">
            <?php
            for ($m = 0; $m < 60; $m += 15) {
              $minute = str_pad($m, 2, '0', STR_PAD_LEFT);
              echo "<option value=\"$minute\">$minute</option>";
            }
            ?>
          </select>
        </div>
          
          <div class="row">
              <div class="input-field col s12">
               
                <select id="payment_type" name="payment_type">
                  <option value="Wallet" selected>Wallet</option>
                  <option value="Cash On Delivery">Cash on Delivery</option>
                </select>
              </div>
            </div>
            <?php
                // 获取 POST 请求中的 order_type
                $order_type = isset($_POST['order_type']) ? $_POST['order_type'] : '';

                // 根据 order_type 的值决定是否禁用 textarea
                $shouldDisable = ($order_type == 'pickup');
                ?>
            <div class="row">
              <div class="input-field col s12">
                <img src="images/address.png" class="prefix" alt="Description of image">
                <input type="hidden" id="address" name="address" value="none">
                <textarea name="address" id="address" class="materialize-textarea validate" data-error=".errorTxt1" <?php if ($shouldDisable) echo 'disabled'; ?>><?php echo $address; ?></textarea>
                <label for="address" class="">Address</label>
                <div class="errorTxt1"></div>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
              <img src="images/edit.png" class="prefix" alt="Description of image">
                <textarea name="description" id="description" class="materialize-textarea" ><?php echo $address; ?></textarea>
                <label for="description" class="">note</label>        
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <img src="images/card.png" class="prefix" alt="Description of image">
                <input name="cc_number" id="cc_number" type="text"  data-error=".errorTxt4" required>
                <label for="cc_number" class="">Card Number</label>
                <div class="errorTxt4"></div>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12">
              <img src="images/key.png" class="prefix" alt="Description of image">
                <input name="cvv_number" id="cvv_number" type="text" data-error=".errorTxt3" required>
                <label for="cvv_number" class="">CVV Number</label>
                <div class="errorTxt3"></div>
              </div>
            </div> 

            
<?php
  $sql = mysqli_query($con, "SELECT * FROM wallet_details where customer_id = $user_id");
  while($row1 = mysqli_fetch_array($sql)){
  $cvv = $row1['cvv'];
  $number = $row1['number'];
  }
  /*
  unset($cvv, $number);*/
?>
            <div class="row">
              <div class="input-field col s12">
              <img src="images/phone.png" class="prefix" alt="Description of image">
                <input name="contact" id="contact" type="text" data-error=".errorTxt5" required>
                <label for="contact" class="">Phone</label>
                <div class="errorTxt5"></div>
              </div>
            </div> 
            <div class="row">
              <div class="row">
                <div class="input-field col s12">
                  <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                    <i class="mdi-content-send right"></i>
                  </button>
                </div>
              </div>
            </div>
            
            <?php
            foreach ($_POST['items'] as $key => $value) {        
                // 确保 $value 是数组且包含 'quantity' 键
                if (!isset($value['quantity']) || $value['quantity'] == 0) {
                    continue; // 如果没有数量，跳过该项而不是中断整个循环
                }
                $quantity = $value['quantity'];
                $sweet = isset($value['sweet']) ? $value['sweet'] : '';
                $ice = isset($value['ice']) ? $value['ice'] : '';
                $ice = isset($value['ice']) ? $value['ice'] : '';
                $nood_type = isset($value['nood_type']) ? $value['nood_type'] : '';
                
                echo '<input type="hidden" name="items[' . $key . '][quantity]" id="item' . $key . '" value="' . $quantity . '">';
                echo '<input type="hidden" name="items[' . $key . '][ice]" id="item' . $key . '" value="' . $ice . '">';
                echo '<input type="hidden" name="items[' . $key . '][sweet]" id="item' . $key . '" value="' . $sweet . '">';
                echo '<input type="hidden" name="items[' . $key . '][nood_type]" id="item' . $key . '" value="' . $nood_type . '">';    
              }
            ?>
          </form>
        </div>
      </div>
    </div>
    <div class="divider"></div>
  </div>
</div>
        <!--end container-->
      </div>
        <div class="container">
          <p class="caption">Estimated Receipt</p>
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
        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>';

        $total = 0; // 初始化 total
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
              if (!empty($nood_type)) {
                echo '<div class="col s6"><span>冰塊:' . $nood_type . '</span></div>';
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
		if(!empty($_POST['description']))
		echo '<li class="collection-item avatar"><p><strong>Note: </strong>'.htmlspecialchars($_POST['description']).'</p></li>';
?>
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
    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>	
	<script type="text/javascript" src="js/plugins/formatter/jquery.formatter.min.js"></script>   
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script type="text/javascript">
        $("#formValidate").validate({
            rules: {
                address: {
                    required: true,
                    minlength: 5
                },
                cc_number: {
                    required: true,
                    
                },
                cvv_number: {
                    required: true,
                    minlength: 3,
                },
                contact: {
                    required: true,
                    digits: true,
                    minlength: 9,
                    maxlength: 10
                }
            },
            messages: {
                address: {
                    required: "Enter an address",
                    minlength: "Enter at least 5 characters"
                },
                cc_number: {
                    required: "Please provide a card number",
                    minlength: "Enter at least 16 digits",
                },
                cvv_number: {
                    required: "Please provide a CVV number",
                    minlength: "Enter at least 3 digits",
                },
                contact: {
                    required: "Please provide a phone number",
                    digits: "Please enter only digits",
                    minlength: "Phone number must be at least 9 digits",
                    maxlength: "Phone number cannot be more than 10 digits"
                },
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error);
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $('#cc_number').formatter({
            'pattern': '{{9999}}-{{9999}}-{{9999}}-{{9999}}',
            'persistent': true
        });
        $('#cvv_number').formatter({
            'pattern': '{{9}}-{{9}}-{{9}}',
            'persistent': true
        });
        $('#payment_type').change(function() {
            if ($(this).val() === 'Cash On Delivery') {
                $("#cc_number").prop('disabled', true);
                $("#cvv_number").prop('disabled', true);		  
            }
            if ($(this).val() === 'Wallet'){
                $("#cc_number").prop('disabled', false);
                $("#cvv_number").prop('disabled', false);	
            }
        });
    </script>
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