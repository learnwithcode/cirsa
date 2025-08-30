<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$segment = $this->uri->uri_to_assoc(2);
 

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
 
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-skins.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-rtl.min.css" />
 
<script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-extra.min.js"></script>
 
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
          <h1> Package<small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Add / Update</small> </h1>
        </div>
        <!-- /.page-header -->
        <div class="row">
          <?php  get_message(); ?>
          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("package","addpackage",array('type'=>_e($packageType))); ?>" method="post">
            
			  <div class="form-group none">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Plan Name :</label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Plan Name" name="pin_name"  class="col-xs-9 col-sm-9 validate[required]" type="text" value="<?php echo $ROW['pin_name']; ?>">
                </div>
              </div>			  
              <div class="space-4"></div>			  
			  <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Product Name :</label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Product Name" name="product"  class="col-xs-9 col-sm-9 validate[required]" type="text" value="<?php echo $ROW['product']; ?>">
                </div>
              </div>             
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">  Amount (<?php echo CURRENCY; ?>) :</label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Purchasing  Amount" name="pin_mrp"  class="col-xs-9 col-sm-9 validate[required]" type="text" value="<?php echo $ROW['mrp']; ?>">
                </div>
              </div>			  
			 
			   <div class="space-4"></div>
			  <div class="form-group none">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Package BV :</label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Package BV" name="package_pv"  class="col-xs-9 col-sm-9 validate[required,custom[integer]]" type="text" value="<?php echo $ROW['prod_pv']; ?>">
                </div>
              </div>		
			  
			 
			  <div class="space-4"></div>
			   
              
              <div class="form-group none">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Plan Details :</label>
                <div class="col-sm-9">
                  <textarea name="description" class="col-xs-9 col-sm-9 validate[required,custom[integer]]" id="form-field-1" placeholder="Plan details"><?php echo $ROW['description']; ?></textarea>
                </div>
              </div>
              <div class="clearfix space-4"></div>
			  
			  
			  
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                  <input type="hidden" name="advert_sts" id="advert_sts" value="C" >
                  <input type="hidden" name="type_id" id="type_id" value="<?php echo $ROW['type_id']; ?>">
                  <button type="submit" name="submitpackage" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
     
                  <button  class="btn btn-danger" type="button" onClick="window.location.href='<?php echo generateSeoUrlAdmin("package","packagelist",array("type"=>_e($packageType))); ?>'"> <i class="ace-icon fa fa-arrow-left bigger-110"></i> Cancel </button>
                 
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
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
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
