<?php defined('BASEPATH') OR exit('No direct script access allowed');

//echo "<pre>";print_r($this->session->all_userdata());die;
$model = new OperationModel();
	$mysqlUserName      = ($_SERVER['HTTP_HOST']=="localhost")? LUSER:SUSER;
	$mysqlPassword      = ($_SERVER['HTTP_HOST']=="localhost")? LPASS:SPASS;
	$mysqlHostName      = "localhost";
	$DbName             = ($_SERVER['HTTP_HOST']=="localhost")? LDB:SDB;
 ?> 
<!doctype html>
<html>
<head>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/header'); ?>
</head>
<body class="skin-2">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
  <div class="main-content">
    <div class="main-content-inner">
      <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
          <li> <i class="ace-icon fa fa-home home-icon"></i> <a href="#">Home</a> </li>
          <li class="active">Backup</li>
        </ul>
        <!-- /.breadcrumb -->
        <div class="nav-search" id="nav-search">
          
        </div>
        <!-- /.nav-search -->
      </div>
    
      <div class="page-content">
        <div class="page-header">
          <h1> Backup <small> <i class="ace-icon fa fa-angle-double-right"></i> Export &amp; Import </small> </h1>
        </div>
        
        
        <div class="row" style="margin-top:50px">
		
		<div class="col-xs-12">
		 <!--action="http://localhost/newrend/rend/phpscript/import.php"-->
		<form method="post" enctype="multipart/form-data" >
		<div class="col-sm-6">
		<input type="file" name="file" class="form-control"accept=".zip,.sql" required>
		</div>
		<div class="col-sm-2">
		<input type="hidden" name="mysql_host" value="<?php echo $mysqlHostName;?>" >
		<input type="hidden" name="mysql_username" value="<?php echo $mysqlUserName;?>" >
		<input type="hidden" name="mysql_password" value="<?php echo $mysqlPassword;?>" >
		<input type="hidden" name="mysql_database" value="<?php echo $DbName;?>" >
		
		<input type="hidden" name="submitdata" value="1" >
		<input type="submit" name="excelsubmit" value="Import DataBase" onClick="confirm('Alert !!! This may break your database. Use at your own responsibility.');" class="btn btn-success"><br>
        
		</div>
		<div class="col-md-4">
		<a href="<?php echo generateSeoUrlAdmin("backup","exportimport",""); ?>"class="btn btn-danger"><i class="	fa fa-angle-double-left"></i> Back</a>
		</div>	
		</form>
		</div>
		
		</div>
		</div>
		<div class="row">
		<img src="<?php echo BASE_PATH;?>assets/images/upload.gif" style="margin-left: 36%;width: 25%;">
		</div>
       <div class="row">
			   
			   <?php get_message(); ?>
			   
			  
			   
		
	  
	  </div>
        
        
        
        
        
     
      </div>
       
    </div>
  </div>
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
</body>
</html>
