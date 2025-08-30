<?php $model = new OperationModel();

$member_id = $this->session->userdata('mem_id');
$QR_CHECK = "SELECT * FROM tbl_members WHERE member_id='".$member_id."'";
$memdata = $this->SqlModel->runQuery($QR_CHECK,true); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="<?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?>">
	<meta name="author" content="<?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?>">
	<meta name="robots" content="<?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?>">
	<meta name="description" content="<?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?>">
	<meta property="og:title" content="<?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?>">
	<meta property="og:description" content="<?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?>">
	<meta property="og:image" content="social-image.png">
	<meta name="format-detection" content="telephone=no">

	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Title -->
	<title><?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?></title>
    <!-- Favicon icon -->
     <link rel="shortcut icon" href="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_FAVICON"); ?>" />
    <link href="<?php echo BASE_PATH; ?>userassets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo BASE_PATH; ?>userassets/vendor/chartist/css/chartist.min.css">
    <link href="<?php echo BASE_PATH; ?>userassets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
	<link href="<?php echo BASE_PATH; ?>userassets/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
  <link href="<?php echo BASE_PATH; ?>userassets/css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet">
</head>
<body>

       
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    
    
  