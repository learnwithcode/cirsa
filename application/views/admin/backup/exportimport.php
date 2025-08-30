<?php defined('BASEPATH') OR exit('No direct script access allowed');

//echo "<pre>";print_r($this->session->all_userdata());die;
$model = new OperationModel();

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
		<a href="<?php echo generateSeoUrlAdmin("backup","export",""); ?>"><div class="col-md-3  btn btn-success" style="border-radius: 20px; margin-left:120px;">
		<div class="col-sm-4">
		<i class="fa fa-database fa-5x" aria-hidden="true"></i>
		</div>
		<div class="col-sm-8">
		<h3>Export</h3>
		<br>
		<h7>Database Export</h7>
		</div>
		</div> </a>
		
	<a href="<?php echo generateSeoUrlAdmin("backup","import",""); ?>">	<div class="col-md-3  btn btn-primary" style="border-radius: 20px; margin-left:20px;">
		<div class="col-sm-4">
		<i class="fa fa-tasks  fa-5x"></i>
		</div>
		<div class="col-sm-8">
		<h3>Import</h3>
		<br>
		<h7>Database Import</h7>
		</div>		
		</div> </a>
		<a href="<?php echo generateSeoUrlAdmin("backup","excel",""); ?>">
		<div class="col-md-3  btn btn-warning" style="border-radius: 20px; margin-left:20px;">
		<div class="col-sm-4">
		<i class="fa fa-file-excel-o fa-5x" aria-hidden="true"></i>
		</div>
		<div class="col-sm-8">
		<h3>Excel</h3>
		<br>
		<h7>Database Excel</h7>
		</div>		
		</div>
		</a>
		</div>
		
		</div>
		</div>
		<div class="row">
		<img src="<?php echo BASE_PATH;?>assets/images/giphy.gif" style="margin-left: 10%;width: 80%;  height: 500px;">
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
