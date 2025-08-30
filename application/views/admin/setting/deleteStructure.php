<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

// $QR_SPR = "SELECT tm.id ,tm.status FROM ".prefix."tbl_withdrawl_on_off AS tm WHERE tm.Req_name = 'Withdrwal'";
// $AR_SPR = $this->SqlModel->runQuery($QR_SPR,true);
// foreach($AR_SPR as $rr ){
// $r11 = $rr['id'];
// $r11status = $rr['status'];
// }

//$QR_CHECK = "SELECT Withdrawal_status from tbl_members WHERE member_id='1'";
	//	$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
 
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
          <!--<h1> Setting <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Delete Structure </small> </h1>-->
        </div>
        <!-- /.page-header -->
        <div class="row">
          <?php  get_message(); ?>
          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal"  name="form-valid" id="form-valid" action="<?php echo generateAdminForm("setting","deleteStructure"); ?>" onSubmit="return confirm('Make sure, want to Delete this member structure')" method="post" enctype="multipart/form-data">
             <fieldset class="scheduler-border">
<legend class="scheduler-border">Delete Structure</legend>
<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_NAME">User Id *</label>
<input type="text" name="user_id"    class="form-control tip" id="user_id"  onchange="check_members(this.value);"  >
</div>
</div>

<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_NAME">User Name </label>
<input type="text" name="user_name"    class="form-control tip" id="user_names"    readonly>
</div>
</div>
  
<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_NAME">Package</label>
<input type="text" name="package"    class="form-control tip" id="packages"    readonly>
</div>
</div>
  <div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_NAME">Activation Date</label>
<input type="text" name="date"    class="form-control tip" id="dates"    readonly>
</div>
</div>          
 <div class="clearfix form-action" style="float:right;">
                <div class="col-md-6">
                  <button type="submit" name="submitDeleteStructure" value="1" class="btn btn-danger"  style="     margin-top: 25px;"> <i class="ace-icon fa fa-trash bigger-110"></i> Delete Now </button>
                  </div>
              </div>

</fieldset>

 

            </form>
  
<form class="form-horizontal"  name="form-valid" id="form-valid" action="<?php echo generateAdminForm("setting","deleteStructure"); ?>" onSubmit="return confirm('Make sure, want to Delete this member  ')" method="post" enctype="multipart/form-data">
             <fieldset class="scheduler-border">
<legend class="scheduler-border">Delete Single User</legend>
<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_NAME">User Id *</label>
<input type="text" name="user_id"    class="form-control tip" id="user_id"  onchange="check_member(this.value);"  >
</div>
</div>

<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_NAME">User Name </label>
<input type="text" name="user_name"    class="form-control tip" id="user_name"    readonly>
</div>
</div>
  
 <div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_NAME">Package</label>
<input type="text" name="package"    class="form-control tip" id="package"    readonly>
</div>
</div>
  <div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_NAME">Activation Date</label>
<input type="text" name="date"    class="form-control tip" id="date"    readonly>
</div>
</div>     
 <div class="clearfix form-action" style="float:right;">
                <div class="col-md-6">
                  <button type="submit" name="submitDeleteUser" value="1" class="btn btn-danger"  style="     margin-top: 25px;"> <i class="ace-icon fa fa-trash bigger-110"></i> Delete Now </button>
                  </div>
              </div>

</fieldset>

 

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
<script>
function check_member(id)
{

	  jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "user/check_users",
data: {mem: id},
success: function(res) {
    let data = JSON.parse(res);
document.getElementById("user_name").value=data.name;
document.getElementById("package").value=data.name;
document.getElementById("date").value=data.date;
}
});
}

function check_members(id)
{

	  jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "user/check_users",
data: {mem: id},
success: function(res) {
    let data = JSON.parse(res);
document.getElementById("user_names").value=data.name;
document.getElementById("packages").value=data.price;
document.getElementById("dates").value=data.date;
}
});
}
</script>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>
</body>
</html>
