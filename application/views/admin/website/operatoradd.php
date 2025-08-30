<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

$url = $this->uri->segment(1);
if($url == 'superadmin')
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
        <h1> Operator <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Add / Update </small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
	  	  <?php  get_message(); ?>
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo $path."operation/operatoradd"; ?>" method="post"> 
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Name </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="name" name="name"  class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $ROW['name']; ?>">
              </div>
            </div>
           <div class="space-4"></div>
			<div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="username" name="user_name"  class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $ROW['user_name']; ?>">
              </div>
            </div>
            <div class="space-4"></div>			
			<div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Password </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="password" name="password"  class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $ROW['password']; ?>">
              </div>
            </div>
            <div class="space-4"></div>			
			<div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email-ID </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="email address" name="email_address"  class="col-xs-10 col-sm-5 validate[required,custom[email]]" type="text" value="<?php echo $ROW['email_address']; ?>">
              </div>
            </div>
            <div class="space-4"></div>
			<div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mobile No </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="mobile no" name="mobile"  class="col-xs-10 col-sm-5 validate[required,custom[integer]]" type="text" value="<?php echo $ROW['mobile']; ?>">
              </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Operator Group </label>
              <div class="col-sm-3">
               <select class="form-control validate[required]" id="form-field-select-1 group_id" name="group_id" >
					<option value="">Select Group</option>
                  	<?php echo DisplayCombo($ROW['group_id'],"USRGRP"); ?>
                </select>
              </div>
            </div>
            <div class="space-4"></div>
            
            
            
            <div class="clearfix form-action">
              <div class="col-md-offset-3 col-md-9">
			  	<input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
				<input type="hidden" name="oprt_id" id="oprt_id" value="<?php echo $ROW['oprt_id']; ?>">
                <button type="submit" name="submitOperator" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
                     
                <button onClick="window.location.href='<?php echo ADMIN_PATH."operation/operator"; ?>'"  class="btn" type="button"> <i class="ace-icon fa fa-undo bigger-110"></i> Cancel </button>
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
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
	});
</script>
</body>
</html>
