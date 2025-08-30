<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$r1 = "1";
$r2 = "2";
$r3 = "3";

$QR_SPR = "SELECT * FROM ".prefix."tbl_set_api AS tm WHERE tm.id = '$r1'";
$AR_SPR = $this->SqlModel->runQuery($QR_SPR);
foreach($AR_SPR as $rr ){

}
$QR_SPR1 = "SELECT * FROM ".prefix."tbl_set_api AS tm WHERE tm.id = '$r2'";
$AR_SPR1 = $this->SqlModel->runQuery($QR_SPR1);
foreach($AR_SPR1 as $rr1 ){

}
$QR_SPR2 = "SELECT * FROM ".prefix."tbl_set_api AS tm WHERE tm.id = '$r3'";
$AR_SPR2 = $this->SqlModel->runQuery($QR_SPR2);
foreach($AR_SPR2 as $rr2 ){

}
//echo $r11status = $AR_SPR['status'];
//print_r($AR_SPR);
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

<fieldset class="scheduler-border">
     <form class="form-horizontal"  name="form-valid" id="form-valid" action="<?php echo generateAdminForm("website","sms_api"); ?>" method="post" enctype="multipart/form-data">

<legend class="scheduler-border">SMS API 1</legend>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="user">Username *</label>
<input type="text" name="user" placeholder="username"  value="<?php echo $rr['user']; ?>" class="form-control tip" id="user"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="authkey">Authkey/Password*</label>
<input type="password" name="authkey" placeholder="password" value="<?php echo $rr['authkey']; ?>" class="form-control tip" id="authkey"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="senderid">Sender Name *</label>
<input type="text" name="senderid" placeholder="Example :- VINDIA" value="<?php echo $rr['senderid']; ?>" class="form-control tip" id="senderid"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>

<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="url">API URL *</label>
<input type="text" name="url" placeholder="API URL" value="<?php echo $rr['url']; ?>" class="form-control tip" id="url"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
    <label class="lab" for="CONFIG_API_URL">Status *</label>
<div class="form-group" style="margin-top: 4px;">
    	<select name="status" class="form-control">
				
				<option value="Y" <?php if($rr['status'] == 'Y'){echo 'selected';} ?>>Active</option>
					<option value="N" <?php if($rr['status'] == 'N'){echo 'selected';} ?>>In Active</option>
			
				</select>

</div>
</div>
<div class="col-md-4">
      <label class="lab" for="CONFIG_API_URL"> </label>
<div class="form-group" style="margin-top: 5px;">
<div class="col-md-4">
   <input type="hidden" name="apiid"  value="<?php echo $rr['id']; ?>" class="form-control tip" id="url"  data-original-title="" title="" data-bv-field="site_name">

                  <button type="submit" name="submitsms1" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check bigger-110"></i> Save Changes </button>
                  </div>
</div>
</div>

              
            </form>
</fieldset>
<fieldset class="scheduler-border">
     <form class="form-horizontal"  name="form-valid" id="form-valid" action="<?php echo generateAdminForm("website","sms_api"); ?>" method="post" enctype="multipart/form-data">

<legend class="scheduler-border">SMS API 2</legend>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="user">Username *</label>
<input type="text" name="user" placeholder="username"  value="<?php echo $rr1['user']; ?>" class="form-control tip" id="user"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="authkey">Authkey/Password*</label>
<input type="password" name="authkey" placeholder="password" value="<?php echo $rr1['authkey']; ?>" class="form-control tip" id="authkey"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="senderid">Sender Name *</label>
<input type="text" name="senderid" placeholder="Example :- VINDIA" value="<?php echo $rr1['senderid']; ?>" class="form-control tip" id="senderid"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>

<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="url">API URL *</label>
<input type="text" name="url" placeholder="API URL" value="<?php echo $rr1['url']; ?>" class="form-control tip" id="url"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
    <label class="lab" for="CONFIG_API_URL">Status *</label>
<div class="form-group" style="margin-top: 4px;">
    	<select name="status" class="form-control">
				
				<option value="Y" <?php if($rr1['status'] == 'Y'){echo 'selected';} ?>>Active</option>
					<option value="N" <?php if($rr1['status'] == 'N'){echo 'selected';} ?>>In Active</option>
			
				</select>

</div>
</div>
<div class="col-md-4">
      <label class="lab" for="CONFIG_API_URL"> </label>
<div class="form-group" style="margin-top: 5px;">
<div class="col-md-4">
     <input type="hidden" name="apiid"  value="<?php echo $rr1['id']; ?>" class="form-control tip" id="url"  data-original-title="" title="" data-bv-field="site_name">

                  <button type="submit" name="submitsms2" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check bigger-110"></i> Save Changes </button>
                  </div>
</div>
</div>

              
            </form>
</fieldset>
<fieldset class="scheduler-border">
     <form class="form-horizontal"  name="form-valid" id="form-valid" action="<?php echo generateAdminForm("website","sms_api"); ?>" method="post" enctype="multipart/form-data">

<legend class="scheduler-border">SMS API 3</legend>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="user">Username *</label>
<input type="text" name="user" placeholder="username"  value="<?php echo $rr2['user']; ?>" class="form-control tip" id="user"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="authkey">Authkey/Password*</label>
<input type="password" name="authkey" placeholder="password" value="<?php echo $rr2['authkey']; ?>" class="form-control tip" id="authkey"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="senderid">Sender Name *</label>
<input type="text" name="senderid" placeholder="Example :- VINDIA" value="<?php echo $rr2['senderid']; ?>" class="form-control tip" id="senderid"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>

<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="url">API URL *</label>
<input type="text" name="url" placeholder="API URL" value="<?php echo $rr2['url']; ?>" class="form-control tip" id="url"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
    <label class="lab" for="CONFIG_API_URL">Status *</label>
<div class="form-group" style="margin-top: 4px;">
    	<select name="status" class="form-control">
				
				<option value="Y" <?php if($rr2['status'] == 'Y'){echo 'selected';} ?>>Active</option>
					<option value="N" <?php if($rr2['status'] == 'N'){echo 'selected';} ?>>In Active</option>
			
				</select>

</div>
</div>
<div class="col-md-4">
      <label class="lab" for="CONFIG_API_URL"> </label>
<div class="form-group" style="margin-top: 5px;">
<div class="col-md-4">
     <input type="hidden" name="apiid"  value="<?php echo $rr2['id']; ?>" class="form-control tip" id="url"  data-original-title="" title="" data-bv-field="site_name">

    
                  <button type="submit" name="submitsms3" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check bigger-110"></i> Save Changes </button>
                  </div>
</div>
</div>

              
            </form>
</fieldset>

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
<style>
    fieldset.scheduler-border{
        border:1px solid #dbdee0!important;
        padding:1.4em!important;
        margin:0 0 1.5em!important;
        -webkit-box-shadow:0 0 0 0 #000;
        box-shadow:0 0 0 0 #000;
        
        }
        label.lab{
          font-weight:700;  
        }
        
</style>
<?php jquery_validation(); ?>
<script>

function updat1(id)
{

var status = document.getElementById(id).checked;
//alert('status');
jQuery.ajax({
type:"POST",
url :"<?php echo BASE_PATH;?>"+"superadmin/website/smsstatus",
data:{id_configuration:id,status:status},
success :function(res){
    if(res > 0 )
    {
       // alert('res');
window.location.reload();

    }
    }
});
 }
 
 function updat2(id)
{

var status = document.getElementById(id).checked;

jQuery.ajax({
type:"POST",
url :"<?php echo BASE_PATH;?>"+"superadmin/website/smsstatus",
data:{id_configuration:id,status:status},
success :function(res){
    if(res > 0 )
    {
window.location.reload();

    }
    }
});
 }
 
 function update3(id)
{

var status = document.getElementById(id).checked;

jQuery.ajax({
type:"POST",
url :"<?php echo BASE_PATH;?>"+"superadmin/website/smsstatus",
data:{id_configuration:id,status:status},
success :function(res){
    if(res > 0 )
    {
window.location.reload();

    }
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
