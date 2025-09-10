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
<form id="loginForm">
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$("#loginForm").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
        url: "https://navirahomes.appspot.com/user/loginuser",
        type: "POST",
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 

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


