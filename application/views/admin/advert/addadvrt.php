<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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

<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/chosen.min.css" />

<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datetimepicker.min.css" />
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
<style type="text/css">
.danger_alert {
    background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
}
.success_alert {
    background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #3c763d;
}
</style>
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
        <h1> Advrt Management <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Add Advt</small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
        <?php  get_message(); ?>
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."advert/addadvrt"; ?>" method="post">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Advert Title :</label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="" name="advert_title"  class="col-xs-9 col-sm-9 validate[required]" type="text" value="<?php echo $ROW['advert_title']; ?>">
              </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Advert Link :</label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="" name="advert_link"  class="col-xs-9 col-sm-9 validate[required]" type="text" value="<?php echo $ROW['advert_link']; ?>">
              </div>
            </div>
            
            <!--<div class="space-4"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Start Date :</label>
              <div class="col-sm-3">
                <div class="input-group">
                  <input class="form-control col-xs-6 col-sm-3  validate[required] date-picker" name="start_date" id="id-date-picker-1" value="<?php echo $ROW['start_date']; ?>" type="text"  />
                  <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
              </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Expiry Date  :</label>
              <div class="col-sm-3">
                <div class="input-group">
                  <input class="form-control col-xs-6 col-sm-3  validate[required] date-picker" name="expiry_date" id="id-date-picker-1" value="<?php echo $ROW['expiry_date']; ?>" type="text"  />
                  <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
              </div>
            </div>-->
			<div class="space-4"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Advert No Click :</label>
              <div class="col-sm-9">
                <input name="advert_click" type="text" class="col-xs-2 col-sm-2 validate[required,custom[integer]]" maxlength="3" id="form-field-1" value="<?php echo $ROW['advert_click']; ?>" placeholder="No of click">
              </div>
            </div>
            <div class="clearfix space-4"></div>
            <div class="clearfix form-action">
              <div class="col-md-offset-3 col-md-9">
                <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                <input type="hidden" name="advert_sts" id="advert_sts" value="C" >
				<input type="hidden" name="oprt_id" id="oprt_id" value="<?php echo $ROW['oprt_id']; ?>">
                <input type="hidden" name="advert_id" id="advert_id" value="<?php echo $ROW['advert_id']; ?>">
                <button type="submit" name="submitAdvertisment" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
     
                <button  class="btn" type="reset"> <i class="ace-icon fa fa-refresh bigger-110"></i> Reset </button>
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
		$("#form-valid").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD hh:mm'
		});
	});
</script>
</body>
</html>
