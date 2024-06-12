<?php
include 'includes/connect.php';
$user_id = $_SESSION['user_id'];

$result = mysqli_query($con, "SELECT * FROM users where id = $user_id");
while($row = mysqli_fetch_array($result)){

$address = $row['address'];
$contact = $row['contact'];
$email = $row['email'];
$username = $row['username'];
}

// 從數據庫中獲取用戶的當前密碼
$user_id = $_SESSION['user_id'];
$result = mysqli_query($con, "SELECT password FROM users WHERE id = $user_id");
$row = mysqli_fetch_array($result);
$stored_password = $row['password'];

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
  <title>Edit Details</title>

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
  <!-- Custom CSS-->    
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  
  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- 自定義側邊欄寬度和主內容區域的左側邊距 -->
  <style type="text/css">
    .side-nav.fixed {
        width: 250px; /* 調整側邊欄寬度為300px，您可以根據需要調整 */
    }

    .main-content {
        margin-left: 300px; /* 設置主內容區域的左側邊距，稍大於側邊欄寬度 */
    }

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
                <h5 class="breadcrumbs-title">個人資料</h5>
              </div>
            </div>
          </div>
        </div>
        <!--breadcrumbs end-->


        <!--start container-->
        <div class="container">
        <div class="divider"></div>
        <div class="row">
            
            <div class="col s12" id="myForm">
                <div class="card-panel">
                    <div class="row">
                        <form class="formValidate" id="formValidate" method="post" action="routers/details-router.php" novalidate="novalidate" class="col s12">
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="mdi-action-account-circle prefix"></i>
                                    <input name="username myInput" id="username" type="text" value="<?php echo $username; ?>" data-error=".errorTxt1" readonly>
                                    <label for="username" class="">Username</label>
                                    <div class="errorTxt1"></div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="mdi-communication-email prefix"></i>
                                    <input name="email myInput" id="email " type="email" value="<?php echo $email; ?>" data-error=".errorTxt3" readonly>
                                    <label for="email" class="">Email</label>
                                    <div class="errorTxt3"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="mdi mdi-phone prefix"></i>
                                    <input name="phone myInput" id="phone " type="number" value="<?php echo $contact; ?>" data-error=".errorTxt5" readonly>
                                    <label for="phone" class="">Contact</label>
                                    <div class="errorTxt5"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <i class="mdi-action-home prefix"></i>
                                    <textarea name="address myInput" id="address" class="materialize-textarea validate" data-error=".errorTxt6" readonly><?php echo $address; ?></textarea>
                                    <label for="address" class="">Address</label>
                                    <div class="errorTxt6"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
						  <div class="errorTxt6"></div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <button onclick="enableInputs()" class="btn cyan waves-effect waves-light right"  name="action" >edit
                              
                            <i class="mdi mdi-pen right"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <div class="divider"></div>
            
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
      <div class="container">
        </div>
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

    <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery-validation/additional-methods.min.js"></script>
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>
    <script>
      function enableInputs() {
              const inputs = document.querySelectorAll('#myForm input[readonly]');
              inputs.forEach(input => {
                  input.removeAttribute('readonly');
              });
          }
    </script>
    <!--
    <script type="text/javascript">
    $("#formValidate").validate({
        rules: {
            username: {
                required: true,
                minlength: 5,
				maxlength: 10
            },
            name: {
                required: true,
                minlength: 5,
				maxlength: 15
            },
            email: {
				required: true,
				maxlength: 35,
			},
			password: {
				required: true,
				minlength: 5,
				maxlength: 16,
			},
            phone: {
				required: true,
				minlength: 4,
				maxlength: 11
			},
			address: {
				required: true,
				minlength: 10,
				maxlength: 300
			},
        },
        messages: {
            username: {
                required: "Enter username",
                minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 10 characters are required."				
            },
            name: {
                required: "Enter name",
                minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 15 characters are required."
            },
            email: {
				required: "Enter email",
                maxlength: "Maximum 35 characters are required."				
			},
			password: {
				required: "Enter password",
				minlength: "Minimum 5 characters are required.",
                maxlength: "Maximum 16 characters are required."				
			},
            phone:{
				required: "Specify contact number.",
				minlength: "Minimum 4 characters are required.",
                maxlength: "Maximum 11 digits are accepted."				
			},	
            address:{
				required: "Specify address",
				minlength: "Minimum 10 characters are required.",
                maxlength: "Maximum 300 characters are accepted."				
			},			
        },
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
    </script>-->
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
		else{
			header("location:login.php");
		}
	}
?>