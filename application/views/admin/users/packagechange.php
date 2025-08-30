<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$segment = $this->uri->uri_to_assoc(2);
$user_id = $segment['user_id'];
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
<script src="<?php echo BASE_PATH; ?>assets/javascript/genvalidator.js"></script>
<?php auto_complete(); ?>
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
.pointer{
	cursor:pointer;
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
          <h1> Change <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Package	 </small> </h1>
        </div>
        <div class="row">
          <?php  get_message(); ?>
          <div class="col-xs-12" style="min-height:500px;">
            <form class="form-horizontal"   name="form-page" id="form-page" action="<?php echo generateAdminForm("member","packagechange","");  ?>" method="post" onSubmit="return confirm('Make sure, want to change package this member')">
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User ID : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Users ID" name="userid" style="width: 429px;"  class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $user_id; ?>" onChange="getpackage(this.value);">
                  <input type="hidden" name="member_id" id="member_id" >
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Package: </label>
                <div class="col-sm-9">
                    
    <select class="col-xs-10 col-sm-5 " required style="width: 429px;" name="type_id" id="type_id">
                    <option value="" selected="selected">---select----</option>
                    <?php //echo DisplayCombo($type_id,"PIN_TYPE_VALUE"); ?>
                  </select>
                </div>
              </div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" name="submitUpgrade" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> UPGRADE MEMBER </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
<script src="<?php echo BASE_PATH; ?>tiny/nicEdit.js" type="text/javascript"></script>
<?php jquery_validation(); auto_complete(); ?>
<script type="text/javascript">
	
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>
<script type="text/javascript" language="javascript">

function getpackage(userid)
{
jQuery.ajax({
type:"POST",
url:"<?php echo ADMIN_PATH; ?>" + "member/getpackagedetail",
data:{userId:userid},
success:function(res){
var data=JSON.parse(res);
if(data.status =='success')
{
$("#type_id").html(data.htmldata);
document.getElementById('member_id').value=data.id;
}
else if(data.status=='warning')
{
$("#type_id").html("<option value='' selected='selected'>---select----</option>");
alert(data.msg);
}


}
})
}
</script>
</body>
</html>
