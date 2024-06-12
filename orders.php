<?php
include 'includes/connect.php';
include 'includes/wallet.php';

	if($_SESSION['customer_sid']==session_id())
	{
		?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Past Orders</title>

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
   <!-- icon -->
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" type="text/css" rel="stylesheet" media="screen,projection">

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
                        <li><a href="#"  class="waves-effect waves-block waves-light"><i class="mdi-editor-attach-money"><?php echo $balance;?></i></a>
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
      <?php include 'aside.php'; ?>
      <!-- END LEFT SIDEBAR NAV-->

      <!-- //////////////////////////////////////////////////////////////////////////// -->

      <!-- START CONTENT -->
      <section id="content">

        <!--breadcrumbs start-->
        <div id="breadcrumbs-wrapper">
          <div class="container">
            <div class="row">
              <div class="col s12 m12 l12">
                <h5 class="breadcrumbs-title">Past Orders</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
          <p class="caption">List of your past orders with details</p>
          <div class="divider"></div>
          <!--editableTable-->
<div id="work-collections" class="seaction"> 
    <?php
    if(isset($_GET['status'])){
        $status = $_GET['status'];
    } else {
        $status = '%';
    }

    $sql = mysqli_query($con, "
        SELECT orders.*, order_details.item_id, order_details.quantity, order_details.price, items.name as item_name 
        FROM orders 
        LEFT JOIN order_details ON orders.id = order_details.order_id 
        LEFT JOIN items ON order_details.item_id = items.it_id 
        WHERE orders.customer_id = $user_id AND orders.status LIKE '$status'
        ORDER BY orders.id;
    ");

    echo '<div class="row">
            <div>
                <h4 class="header">List</h4>
                <ul id="issues-collection" class="collection">';

    $current_order_id = null;

    while($row = mysqli_fetch_array($sql)) {
        if ($current_order_id != $row['id']) {
            if ($current_order_id !== null) {
                echo '</tbody></table>';
                echo '<li class="collection-item">
                        <div class="row">
                            <div class="col s7">
                                <p class="collections-title">Total</p>
                            </div>
                            <div class="col s2">
                                <span></span>
                            </div>
                            <div class="col s3">
                                <span><strong>Rs. '.$order_total.'</strong></span>
                            </div>';
                if(!preg_match('/^Cancelled/', $status)){
                    if($status != 'Delivered'){
                        echo '<form action="routers/cancel-order.php" method="post">
                                <input type="hidden" value="'.$current_order_id.'" name="id">
                                <input type="hidden" value="Cancelled by Customer" name="status">	
                                <input type="hidden" value="'.$payment_type.'" name="payment_type">											
                                <button class="btn waves-effect waves-light right submit" type="submit" name="action">Cancel Order
                                      <i class="mdi-content-clear right"></i> 
                                </button>
                              </form>';
                    }
                }
                echo '</div></li>';
            }

            $current_order_id = $row['id'];
            $order_total = $row['total'];
            $payment_type = $row['payment_type'];

            echo '<li class="collection-item avatar">
                    <i class="mdi-content-content-paste red circle"></i>
                    <span class="collection-header">Order No. '.$row['id'].'</span>
                    <p><strong>Date:</strong> '.$row['date'].'</p>
                    <p><strong>Payment Type:</strong> '.$row['payment_type'].'</p>
                    <p><strong>Address: </strong>'.$row['address'].'</p>							  
                    <p><strong>Status:</strong> '.($row['status']=='Paused' ? 'Paused <a data-position="bottom" data-delay="50" data-tooltip="Please contact administrator for further details." class="btn-floating waves-effect waves-light tooltipped cyan">?</a>' : $row['status']).'</p>							  
                    '.(!empty($row['description']) ? '<p><strong>Note: </strong>'.$row['description'].'</p>' : '').'						                               
                    <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                  </li>';

            echo '<table class="striped">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>';
        }

        echo '<tr>
                <td>'.$row['item_id'].'</td>
                <td>'.$row['item_name'].'</td>
                <td>'.$row['quantity'].' Pieces</td>
                <td>Rs. '.$row['price'].'</td>
              </tr>';
    }

    if ($current_order_id !== null) {
        echo '</tbody></table>';
        echo '<li class="collection-item">
                <div class="row">
                    <div class="col s7">
                        <p class="collections-title">Total</p>
                    </div>
                    <div class="col s2">
                        <span></span>
                    </div>
                    <div class="col s3">
                        <span><strong>Rs. '.$order_total.'</strong></span>
                    </div>';
        if(!preg_match('/^Cancelled/', $status)){
            if($status != 'Delivered'){
                echo '<form action="routers/cancel-order.php" method="post">
                        <input type="hidden" value="'.$current_order_id.'" name="id">
                        <input type="hidden" value="Cancelled by Customer" name="status">	
                        <input type="hidden" value="'.$payment_type.'" name="payment_type">											
                        <button class="btn waves-effect waves-light right submit" type="submit" name="action">Cancel Order
                              <i class="mdi-content-clear right"></i> 
                        </button>
                      </form>';
            }
        }
        echo '</div></li>';
    }

    echo '  </ul>
          </div>
          </div>';
    ?>

					 </ul>
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
    <script type="text/javascript" src="js/fetchOrders.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
			header("location:all-orders.php");		
		}
		else{
			header("location:login.php");
		}
	}
?>