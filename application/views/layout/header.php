<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta description -->
    <meta name="description"  content="<?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?>">
    <meta name="author" content="">
 <title><?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?></title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" />


    <!--favicon icon-->
    <link rel="icon" href="<?php echo BASE_PATH;?>assets_web/img/favicon.png" type="image/png" sizes="16x16">

    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700%7COpen+Sans:400,600&amp;display=swap" rel="stylesheet">

    <!--Bootstrap css-->
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/bootstrap.min.css">
    <!--Magnific popup css-->
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/magnific-popup.css">
    <!--Themify icon css-->
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/themify-icons.css">
    <!--Fontawesome icon css-->
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/all.min.css">
    <!--animated css-->
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/animate.min.css">
    <!--ytplayer css-->
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/jquery.mb.YTPlayer.min.css">
    <!--Owl carousel css-->
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/owl.theme.default.min.css">
    <!--custom css-->
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/style.css">
    <!--responsive css-->
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>assets_web/css/responsive.css">
 <style>
  /* Make the image fully responsive */
  .carousel-inner img {
    width: 100%;
    height: 100%;
  }
</style>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <script src="<?php echo BASE_PATH;?>assetnewnew/js/countrystatecity.js"></script>
</head>

<body>
<!--loader start-->
<div id="preloader">
    <div class="loader1">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>
<!--loader end-->

<!--header section start-->
<header class="header">
    <!--topbar start-->
    <div id="header-top-bar" class="primary-bg py-2">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-md-7 col-lg-7 d-none d-md-block d-lg-block">
                    <div class="topbar-text text-white">
                        <ul class="list-inline">
                            <li class="list-inline-item"><span class="fas fa-envelope mr-1"></span> <a href="mailto:support@yourdomain.com">support@yourdomain.com</a></li>
                            <li class="list-inline-item"><span class="fas fa-map-marker mr-1"></span> Address CA-234/B New York, USA</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4">
                    <div class="topbar-text text-white">
                        <ul class="list-inline text-md-right text-lg-right text-left">
                            <li class="list-inline-item"><span class="ti-phone mr-2"></span> Call Now: <strong>883-4565-123456</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--topbar end-->
    <!--start navbar-->
    <nav class="navbar navbar-expand-lg fixed-top white-bg">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_PATH;?>">
                <img src="<?php echo BASE_PATH;?>assets_web/img/logo-color.png" alt="logo" class="img-fluid"/>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse h-auto" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto menu">
                    <li><a href="<?php echo BASE_PATH;?>"> Home</a></li>
                    <li><a  href="<?php echo BASE_PATH;?>about-us">About Us</a></li>
                    <li><a  href="<?php echo BASE_PATH;?>services">Services</a></li>
                    <li><a  href="<?php echo BASE_PATH;?>assets_web/plan.pdf">Business Plan</a></li>
                    <li><a  href="<?php echo BASE_PATH;?>contact-us">Contact Us</a></li>
                </ul>
            </div>
            <div class="action-btns"><a href="<?php echo BASE_PATH;?>login" class="btn secondary-solid-btn mr-2">Login</a></div>
            <div class="action-btns"><a href="<?php echo BASE_PATH;?>sign-up" class="btn secondary-solid-btn">Sign Up</a></div>
        </div>
    </nav>
</header>
<!--header section end-->