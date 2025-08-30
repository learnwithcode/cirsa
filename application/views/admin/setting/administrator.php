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
          <h1> Business <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Settings Menu </small> </h1>
        </div>
        <!-- /.page-header -->
        <div class="row">
          <?php  get_message(); ?>
          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal"  name="form-valid" id="form-valid" action="<?php echo generateAdminForm("setting","administrator"); ?>" method="post">
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Withdrawal   : </label>
                <div class="col-sm-9">
                  <input type="radio" name="CONFIG_WITHDRAWL" id="CONFIG_WITHDRAWL" <?php if($model->getValue("CONFIG_WITHDRAWL")=='AUTO'){ echo 'checked="checked"';} ?> value="AUTO">
                  Auto &nbsp;&nbsp;
                  <input type="radio" name="CONFIG_WITHDRAWL" id="CONFIG_WITHDRAWL" <?php if($model->getValue("CONFIG_WITHDRAWL")=='MANUAL'){ echo 'checked="checked"';} ?> value="MANUAL">
                  Manual &nbsp;&nbsp; </div>
              </div>
          
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email Address  : </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="CONFIG_CMP_EMAIL" id="CONFIG_CMP_EMAIL" placeholder="Email Address" value="<?php echo $model->getValue("CONFIG_CMP_EMAIL"); ?>">
                </div>
              </div>
			   <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Enquiries Address  : </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="CONFIG_ENQUIRY_EMAIL" id="CONFIG_ENQUIRY_EMAIL" placeholder="Enquiries Address" value="<?php echo $model->getValue("CONFIG_ENQUIRY_EMAIL"); ?>">
                </div>
              </div>
			   <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Technical support Address  : </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="CONFIG_TECH_EMAIL" id="CONFIG_TECH_EMAIL" placeholder="Technical support address" value="<?php echo $model->getValue("CONFIG_TECH_EMAIL"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Company Address  : </label>
                <div class="col-sm-6">
                  <textarea name="CONFIG_COMPANY_ADDRESS" class="form-control" id="CONFIG_COMPANY_ADDRESS" placeholder="Company Address"><?php echo $model->getValue("CONFIG_COMPANY_ADDRESS"); ?></textarea>
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mobile No  : </label>
                <div class="col-sm-6">
                  <input name="CONFIG_MOBILE_NO" type="text" class="form-control" id="CONFIG_MOBILE_NO" value="<?php echo $model->getValue("CONFIG_MOBILE_NO"); ?>" placeholder="Mobile No">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Facebook URL  : </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="CONFIG_FB_URL" id="CONFIG_FB_URL" placeholder="Facebook url" value="<?php echo $model->getValue("CONFIG_FB_URL"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Twitter URL  : </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="CONFIG_TW_URL" id="CONFIG_TW_URL" placeholder="Twitter url" value="<?php echo $model->getValue("CONFIG_TW_URL"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Youtube URL  : </label>
                <div class="col-sm-6">
                  <input class="form-control" type="text" name="CONFIG_YT_URL" id="CONFIG_YT_URL" placeholder="Youtube url" value="<?php echo $model->getValue("CONFIG_YT_URL"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Google Plus URL  : </label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="CONFIG_GO_URL" id="CONFIG_GO_URL" placeholder="Google url" value="<?php echo $model->getValue("CONFIG_GOOGLE_URL"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Minimum Fund Transfer  : </label>
                <div class="col-sm-9">
                  <input type="text" name="CONFIG_MIN_FUND_TRANSFER" id="CONFIG_MIN_FUND_TRANSFER" placeholder="<?php echo CURRENCY; ?>" value="<?php echo $model->getValue("CONFIG_MIN_FUND_TRANSFER"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Minimum Withdrawal Bitcoin  : </label>
                <div class="col-sm-9">
                  <input type="text" name="CONFIG_MIN_WITHDRAWL_BITCOIN" id="CONFIG_MIN_WITHDRAWL_BITCOIN" placeholder="<?php echo CURRENCY; ?>" value="<?php echo $model->getValue("CONFIG_MIN_WITHDRAWL_BITCOIN"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Minimum Withdrawal Bank Wire  : </label>
                <div class="col-sm-9">
                  <input type="text" name="CONFIG_MIN_WITHDRAWL_BANKWIRE" id="CONFIG_MIN_WITHDRAWL_BANKWIRE" placeholder="<?php echo CURRENCY; ?>" value="<?php echo $model->getValue("CONFIG_MIN_WITHDRAWL_BANKWIRE"); ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Direct Referral Income (%)  : </label>
                <div class="col-sm-9">
                  <input type="text" class="col-md-5 validate[required]" name="CONFIG_DIRECT_REFFERAL" id="CONFIG_DIRECT_REFFERAL" value="<?php echo $model->getValue("CONFIG_DIRECT_REFFERAL"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Binary Income (%)  : </label>
                <div class="col-sm-9">
                  <input type="text" class="col-md-5 validate[required]" name="CONFIG_BINARY_INCOME" id="CONFIG_BINARY_INCOME" value="<?php echo $model->getValue("CONFIG_BINARY_INCOME"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Binary Ceiling  : </label>
                <div class="col-sm-9">
                  <input type="text" class="col-md-4 validate[required]" name="CONFIG_BINARY_CEILING" id="CONFIG_BINARY_CEILING" value="<?php echo $model->getValue("CONFIG_BINARY_CEILING"); ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Admin Charges  : </label>
                <div class="col-sm-9">
                  <input type="text"  name="CONFIG_ADMIN_CHARGE" id="CONFIG_ADMIN_CHARGE" placeholder="In (%)" value="<?php echo $model->getValue("CONFIG_ADMIN_CHARGE"); ?>">
                  (%) </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Service Charges  : </label>
                <div class="col-sm-9">
                  <input type="text"  name="CONFIG_SERVICE_CHARGE" id="CONFIG_SERVICE_CHARGE" placeholder="In (%)" value="<?php echo $model->getValue("CONFIG_SERVICE_CHARGE"); ?>">
                  (%) </div>
              </div>
              <div class="space-4"></div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-6">
                  <button type="submit" name="submitAdministrator" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check bigger-110"></i> Save Changes </button>
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
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>
</body>
</html>
