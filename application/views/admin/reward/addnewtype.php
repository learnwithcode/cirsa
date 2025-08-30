<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$targetId = $this->uri->segment(4);
$typeId= $this->uri->segment(5);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title><?php echo title_name(); ?></title>
<meta name="description" content="Static &amp; Dynamic Tables" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
<!-- page specific plugin styles -->
<!-- text fonts -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datetimepicker.min.css" />

<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/fonts.googleapis.com.css" />
<!-- ace styles -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-skins.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-rtl.min.css" />
<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
<!-- inline styles related to this page -->
<!-- ace settings handler -->
<script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-extra.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_PATH;  ?>ckeditor/ckeditor.js"></script>
<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>
<body class="skin-2">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
<div class="main-content">
  <div class="main-content-inner">
    <?php  $this->load->view(ADMIN_FOLDER.'/layout/breadcumb'); ?>
    <div class="page-content">
      <div class="page-header">
        <h1> Target <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Add / Update </small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
        <?php  get_message(); ?>
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."reward/updatetype/".$targetId; ?>" method="post">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Type Name </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="Type name" name="type_name"  class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $ROW['type_name']; ?>">
              </div>
            </div>
			
			<div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Type </label>
              <div class="col-sm-9">
      <select name="type" class="col-xs-10 col-sm-5 validate[required]">
	  
	  <option value="">--Select--</option>
	  <option value="P">Pair</option>
	  <option value="D">Direct</option>
	         </select>        
              </div>
            </div>
			<div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Designation </label>
              <div class="col-sm-9">
      <select name="designation" class="col-xs-10 col-sm-5 validate[required]">
	  
	  <option value="0">Fresher</option>
	  <option value="1">Silver</option>
	  <option value="2">Gold</option>
	  <option value="3">Pearl</option>
	  <option value="4">Topaz</option>
	  <option value="5">Emerald</option>
	  <option value="6">Ruby</option>
	  <option value="7">Diamond</option>
	  
	         </select>        
              </div>
            </div>
			
			  <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Point </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="Enter Target Point..." name="point"  class="col-xs-10 col-sm-5 validate[required]" type="number"  value="<?php echo $ROW['point']; ?>">
              </div>
            </div>
			<div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> From Date :</label>
              <div class="col-sm-3">
                <div class="input-group">
                  <input class="form-control col-xs-10 col-sm-5  validate[required] date-picker" name="fdate" id="id-date-picker-1" value="<?php echo $ROW['fdate']; ?>" type="text"  />
                  <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
              </div>
            </div>
            <div class="space-4"></div>
			
			<div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> End Date :</label>
              <div class="col-sm-3">
                <div class="input-group">
                  <input class="form-control col-xs-6 col-sm-3  validate[required] date-picker" name="edate" id="id-date-picker-1" value="<?php echo $ROW['edate']; ?>" type="text"  />
                  <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
              </div>
            </div>
            <div class="space-4"></div>
                      <div class="clearfix form-action">
              <div class="col-md-offset-3 col-md-9">
                <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                <input type="hidden" name="typeId" id="typeId" value="<?php echo _d($typeId); ?>">
				 <input type="hidden" name="targetId" id="targetId" value="<?php echo _d($targetId); ?>">
                <button type="submit" name="submittarget" value="1" class="btn btn-info" > <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>

                <button onClick="window.location.href='<?php echo ADMIN_PATH."reward/targettype/".$targetId; ?>'"  class="btn" type="button"> <i class="ace-icon fa fa-undo bigger-110"></i> Cancel </button>
              </div>
            </div>
          </form>
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.page-content -->
  </div>
</div>
 <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> 
 </div>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
</body>
</html>
