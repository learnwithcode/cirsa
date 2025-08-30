 <?php
 
 
 $model = new OperationModel();
 
 $url = $this->uri->segment(1);
if($url == 'admin')
{
 $path =    ADMIN_PATH;
}
elseif($url =='courier')
{
    $path = COURIER_PATH;
}
else
{
    $path =    ADMIN_PATH; 
}

?>
<!doctype html>
<html lang="en">
 
<head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?></title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_FAVICON"); ?>" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/responsive.css">
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
       <style>
          li  a{
              
    padding: 10px;

          }
      </style>
   </head>
   <body>
