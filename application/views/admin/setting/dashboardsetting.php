<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$QR_SPR = "SELECT tm.id ,tm.status FROM ".prefix."tbl_withdrawl_on_off AS tm WHERE tm.Req_name = 'Withdrwal'";
$AR_SPR = $this->SqlModel->runQuery($QR_SPR,true);
foreach($AR_SPR as $rr ){
$r11 = $rr['id'];
$r11status = $rr['status'];
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
<body class="no-skin">
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
<form class="form-horizontal"  name="form-valid" id="form-valid" action="<?php echo generateAdminForm("setting","dashboard_setting"); ?>" method="post" enctype="multipart/form-data">
             <fieldset class="scheduler-border">
<legend class="scheduler-border">Member Dashboard Configuration</legend>

<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MARQUE">Logo Header</label>
<select id="M_Logo_Header" name="M_Logo_Header" class=" form-control" >
                                                  <option value="" >--Select Logo Header--</option>
                                                  <option value="dark" <?php if($model->getValue("M_Logo_Header")=='dark'){echo 'selected';}?> >dark</option>
                                                  <option value="blue" <?php if($model->getValue("M_Logo_Header")=='blue'){echo 'selected';}?>>blue</option> 
                                                   <option value="purple" <?php if($model->getValue("M_Logo_Header")=='purple'){echo 'selected';}?> >purple</option>
                                                  <option value="light-blue" <?php if($model->getValue("M_Logo_Header")=='light-blue'){echo 'selected';}?>>light-blue</option> 
                                                 <option value="green" <?php if($model->getValue("M_Logo_Header")=='green'){echo 'selected';}?> >green</option>
                                                  <option value="orange" <?php if($model->getValue("M_Logo_Header")=='orange'){echo 'selected';}?>>orange</option> 
                                                 <option value="red" <?php if($model->getValue("M_Logo_Header")=='red'){echo 'selected';}?> >red</option>
                                                  <option value="white" <?php if($model->getValue("M_Logo_Header")=='white'){echo 'selected';}?>>white</option> 
                                                   <option value="dark2" <?php if($model->getValue("M_Logo_Header")=='dark2'){echo 'selected';}?> >dark2 Default</option>
                                                  <option value="blue2" <?php if($model->getValue("M_Logo_Header")=='blue2'){echo 'selected';}?>>blue2</option> 
                                                   <option value="purple2" <?php if($model->getValue("M_Logo_Header")=='purple2'){echo 'selected';}?> >purple2</option>
                                                  <option value="green2" <?php if($model->getValue("M_Logo_Header")=='green2'){echo 'selected';}?>>green2</option> 
                                                   <option value="orange2" <?php if($model->getValue("M_Logo_Header")=='orange2'){echo 'selected';}?>>orange2</option> 
                                                    <option value="red2" <?php if($model->getValue("M_Logo_Header")=='red2'){echo 'selected';}?>>red2</option> 
                                    </select>
</div>
</div>
<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="M_Navbar">Navbar Header</label>
<select id="M_Navbar" name="M_Navbar" class=" form-control" >
                                                  <option value="" >--Select Navbar Header--</option>
                                                 
                                                  
                      	    <option value="dark" <?php if($model->getValue("M_Navbar")=='dark'){echo 'selected';}?>>dark</option>
							<option value="blue" <?php if($model->getValue("M_Navbar")=='blue'){echo 'selected';}?>>blue</option>
							<option value="purple" <?php if($model->getValue("M_Navbar")=='purple'){echo 'selected';}?>>purple</option>
							<option value="light-blue" <?php if($model->getValue("M_Navbar")=='light-blue'){echo 'selected';}?>>light-blue</option>
							<option value="green" <?php if($model->getValue("M_Navbar")=='green'){echo 'selected';}?>>green</option>
							<option value="orange" <?php if($model->getValue("M_Navbar")=='orange'){echo 'selected';}?>>orange</option>
							<option value="red" <?php if($model->getValue("M_Navbar")=='red'){echo 'selected';}?>>red</option>
							<option value="white" <?php if($model->getValue("M_Navbar")=='white'){echo 'selected';}?>>white</option>
							<option value="dark2" <?php if($model->getValue("M_Navbar")=='dark2'){echo 'selected';}?>>dark2</option>
							<option value="blue2" <?php if($model->getValue("M_Navbar")=='blue2'){echo 'selected';}?>>blue2</option>
							<option value="purple2" <?php if($model->getValue("M_Navbar")=='purple2'){echo 'selected';}?>>purple2</option>
							<option value="light-blue2" <?php if($model->getValue("M_Navbar")=='light-blue2'){echo 'selected';}?>>light-blue2</option>
							<option value="green2" <?php if($model->getValue("M_Navbar")=='green2'){echo 'selected';}?>>green2</option>
							<option value="orange2" <?php if($model->getValue("M_Navbar")=='orange2'){echo 'selected';}?>>orange2</option>
							<option value="red2" <?php if($model->getValue("M_Navbar")=='red2'){echo 'selected';}?>>red2</option>
                          
                                    </select>
</div>
</div>
<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="M_Sidebar">Sidebar </label>
<select id="M_Sidebar" name="M_Sidebar" class=" form-control" >
                                                  <option value="" >--Select Sidebar--</option>
                                                  <option value="white" <?php if($model->getValue("M_Sidebar")=='white'){echo 'selected';}?> >white</option>
                                                  <option value="dark" <?php if($model->getValue("M_Sidebar")=='dark'){echo 'selected';}?>>dark</option> 
                                                    <option value="dark2" <?php if($model->getValue("M_Sidebar")=='dark2'){echo 'selected';}?>>dark2</option> 
                      
                          
                                    </select>
</div>
</div>

<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="M_Background">Background </label>
<select id="M_Background" name="M_Background" class=" form-control" >
                                                  <option value="" >--Select Background--</option>
                                                  <option value="bg2" <?php if($model->getValue("M_Background")=='bg2'){echo 'selected';}?> >bg2</option>
                                                  <option value="bg1" <?php if($model->getValue("M_Background")=='bg1'){echo 'selected';}?>>bg1</option> 
                                                   <option value="bg3" <?php if($model->getValue("M_Background")=='bg3'){echo 'selected';}?> >bg3</option>
                                                  <option value="dark" <?php if($model->getValue("M_Background")=='dark'){echo 'selected';}?>>dark</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>
 <div class="clearfix form-action" style="float:right;">
                <div class="col-md-6">
                  <button type="submit" name="submitdashboard_setting" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check bigger-110"></i> Save Changes </button>
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
function updatestatus(id)
{

var status = document.getElementById(id).checked;
jQuery.ajax({
type:"POST",
url :"<?php echo BASE_PATH;?>"+"superadmin/setting/onofftatus",
data:{id:id,status:status},
success :function(res){
alert(res);
window.location.reload();
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
