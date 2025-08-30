<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
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
        <h1> Member <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  New Member </small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
        <div class="col-xs-12"> <?php echo get_message(); ?>
          <div class="widget-box">
            <div class="widget-header widget-header-blue widget-header-flat">
              <h4 class="widget-title lighter"><?php echo ($ROW['member_id'])? "Update Profile":"Add Member"; ?></h4>
              <div class="widget-toolbar">&nbsp;</div>
            </div>
            <div class="widget-body">
              <div class="widget-main">
                <div class="no-steps-container" id="fuelux-wizard-container">
                  <div>
                    <ul style="margin-left: 0" class="steps">
                      <li data-step="1" class="active"> <span class="step">1</span> <span class="title">Main Settings</span> </li>
                      <li data-step="2" class="active"> <span class="step">2</span> <span class="title">Login Info</span> </li>
                      <li data-step="3" class="active"> <span class="step">3</span> <span class="title">Address Settings</span> </li>
                      <li data-step="4" class="active"> <span class="step">4</span> <span class="title">Payment settings</span> </li>
                    </ul>
                  </div>
                  <hr>
                  <form  name="form-valid" id="form-valid" method="post" class="form-horizontal" action="<?php echo ADMIN_PATH."member/addmemberfour"; ?>">
                    <div class="step-content pos-rel">
                      <div class="step-pane active" data-step="1">
                        <h3 class="lighter block green">Payment settings</h3>
                        <div class="space-2"></div>
                        <div class="form-group">
                          <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Bitcoin Address:</label>
                          <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                              <input name="bitcoin_address" id="bitcoin_address"  class="col-xs-12 col-sm-4" type="text" placeholder="Bitcoin Address" value="<?php echo $ROW['bitcoin_address']; ?>">
                            </div>
                          </div>
                        </div>
                        <div class="space-2"></div>
                      </div>
                    </div>
                    <hr>
                    <div class="wizard-actions">
                      <input type="hidden" name="member_id" id="member_id" value="<?php echo $ROW['member_id'];  ?>">
                      <button name="submitMemberSave" type="submit"  value="1" class="btn btn-success"> <i class="ace-icon fa fa-floppy-o"></i> Save </button>
                      <button type="button" 
				  onClick="window.location.href='<?php echo generateSeoUrlAdmin("member","profile",array("member_id"=>_e($ROW['member_id']))); ?>'"   
				  name="submitMemberNext" class="btn btn-info"> Finish <i class="ace-icon fa fa-indent icon-on-right"></i> </button>
                    </div>
                  </form>
                </div>
                <!-- /.widget-main -->
              </div>
              <!-- /.widget-body -->
            </div>
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
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>
</body>
</html>
