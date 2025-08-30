<?php $model = new OperationModel();
   session_start();
//PrintR($_SESSION['CAPTCHA_CODE']);
//echo $_SESSION['CAPTCHA_CODE'];
?> 
	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?></title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" />
    <!-- google_icon_font-awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- google_font_family -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- main_style.css -->
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>assetsuser/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_PATH; ?>assetsuser/css/responsive.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
<style>
        .signin-content .left-content form .form-group label {
    opacity: 0;
    visibility: visible;
    position: absolute;
    top: 20px;
    left: 0;
    transition: all linear 0.5s;
    background-color: #0662c9;
    color: #fff;
    padding: 2px 5px;
    border-radius: 4px;
    z-index: -1;
}

        .signin-content .left-content .custom-control.custom-checkbox {
            margin: 10px 0 15px 0;
        }

        .signin-content .left-content form .form-group input.active {
            border-color: #0662c9;
            outline-color: #0662c9;
            box-shadow: 0 0 4px #0662c9;
        }

        .signin-content .left-content form .form-group {
            position: relative;
            margin-bottom: 0 !important;
        }

        .signin-content .left-content .form-group input {
            margin-bottom: 0 !important;
            margin-top: 20px;
        }

        .signin-content .left-content form .form-group input.active + label {
    visibility: visible;
    opacity: 1;
    transition: all linear 0.5s;
    top: 5px;
    z-index: 1;
}
    </style>
    <style>
        button#loginshine {
            margin-top: 20px;
        }

       
    </style>
    <section id="signin-main" class="singIn-main">
        <div class="container">
            <div class="signin-content">
                <div class="left-content">
                    <div>
                        <div>
                              <center> <img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" class="img-fluid rounded" alt="" style="width: 100px;"></center>   
                            <h2>Forget Password</h2>
                          
                        </div>
                      
                    </div>
                       <?php echo get_message(); ?>
                                      <p id="error-msg"></p>
                    
                     <?php get_message(); ?>
                        <form  class="login-signup-form form-signin"   method="post" name="login" id="login" accept-charset="utf-8">
                         
                  
                           <div class="row">
                              <div class="col-lg-12">
                                 <div class="floating-label form-group">
                                    <input type="text" class="form-control form-control-lg bg-inverse bg-opacity-5" placeholder="User Id" name="user_name" required /> <br>
                                        <input type="hidden" name="submitMember" value="1">
                                 </div>
                              </div>
                             
                           </div>
                           <button  type="submit"  class="btn btn-outline-theme btn-lg d-block w-100 fw-500 mb-3">Submit </button>  
 
                           
                              <p class="mt-3">
                              Back to Login  <a href="<?php echo BASE_PATH;?>login" class="text-primary">Sign In</a>
                           </p>
                        </form>
                    
                     </div>
                <div class="right-content">
                    <div class="right-text">
                        <h2>Welcome Back</h2>
                        <p>Already signed up, enter your details and start the learning today</p>
                        <a href="<?php echo BASE_PATH;?>sign-up" class="btn-main singIn-main">Sing Up</a>
                    </div>
                </div>

                <div class="singup-poup-main">
                    <h3>Your Rasiregistration Has Been Successfully</h3>
                    <div>
                        <div>
                            <p><strong>Name: </strong><span>sonu</span></p>
                            <p><strong>Email: </strong><span>sonu12345@gmail.com</span></p>
                            <p><strong>Mobile Number: </strong><span>123456890</span></p>
                        </div>
                        <div>
                            <a href="#"><img src="images/Logo.png" alt=""></a>
                        </div>

                    </div>
                    <div>
                        <button class="btn-main">ok</button>
                      </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $(".signin-content .left-content form .form-group input").click(function () {
                $(".signin-content .left-content form .form-group input").removeClass("active");
                $(this).addClass("active");
            });
        });
    </script>
   
    <div class="overlayer-signInUp"></div>

    <script src="<?php echo BASE_PATH; ?>assetsuser/js/jquery.js"></script>
    <script src="j<?php echo BASE_PATH; ?>assetsuser/js/mycript.js"></script>
</body>

</html>