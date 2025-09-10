<?php $model = new OperationModel();
   session_start();
//PrintR($_SESSION['CAPTCHA_CODE']);
//echo $_SESSION['CAPTCHA_CODE'];


?> 
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Title -->
	<title><?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>">
  <link href="<?php echo BASE_PATH; ?>userassets/css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" width="100" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                                   	<?php echo get_message(); ?>
                                      <p id="error-msg"></p>
					  <form name="form-login" id="form-login"  class="login-signup-form form-login" action="<?php echo generateSeoUrl("user","loginuser",array()); ?>" method="post">
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Member ID</strong></label>
                                            <input id="user_name_login"  name="user_name_login" class="form-control" type="text" placeholder="Enter Your Member ID" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input  name="user_password_login" id="user_password_login" class="form-control"  type="password" placeholder="Enter Password" required>
                                        </div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                               <div class="form-check custom-checkbox ms-1 text-white">
													<input type="checkbox" class="form-check-input" id="basic_checkbox_1">
													<label class="form-check-label" for="basic_checkbox_1">Remember my preference</label>
												</div>
                                            </div>
                                            <div class="form-group">
                                                <a class="text-white" href="<?php echo generateSeoUrl("user","forgotpassword",array()); ?>">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            
                                            	<button type="submit" value="1" id="loginshine"  name="submitRegisterMember"  class="btn bg-white text-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">Don't have an account? <a class="text-white" href="<?php echo BASE_PATH;?>sign-up">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $(".signin-content .left-content form .form-group input").click(function () {
                $(".signin-content .left-content form .form-group input").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$("#loginForm").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
        url: "https://navirahomes.appspot.com/user/loginuser",
        type: "GET",
        data: $(this).serialize(),
        success: function(res) {
            var data = JSON.parse(res);
            if (data.status === "success") {
                window.location.href = data.redirect;
            } else {
                alert(data.message);
            }
        }
    });
});
</script>

  <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
       <script src="<?php echo BASE_PATH; ?>userassets/vendor/global/global.min.js"></script>
	<script src="<?php echo BASE_PATH; ?>userassets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
     <script src="<?php echo BASE_PATH; ?>userassets/js/custom.min.js"></script>
    <script src="<?php echo BASE_PATH; ?>userassets/js/deznav-init.js"></script>

</body>

</html>


