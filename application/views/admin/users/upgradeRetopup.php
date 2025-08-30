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
          <br>
      <div class="page-content">
      
        <div class="page-header">
          <h1> Retopup Membership   </h1>
        </div>
        
        <hr>
        <div class="row">
         
          <div class="col-xs-12"  > <?php  get_message(); ?>
            <form class="form-horizontal"   name="form-page" id="form-page" action="<?php echo generateAdminForm("member","upgradeRetopup","");  ?>" method="post" onSubmit="return confirm('Make sure, want to upgrade this member')">
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User ID : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Users ID" name="member_user_id" style="width: 429px;"  class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $user_id; ?>">
                  <input type="hidden" name="member_id" id="member_id" >
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Package: </label>
                <div class="col-sm-9">
                    
                  <select class="col-xs-10 col-sm-5 validate[required]" style="width: 429px;" name="type_id" id="type_id">
                    <option value="" selected="selected">---select----</option>
                    <?php echo DisplayCombo($type_id,"REPIN_TYPE_VALUE"); ?>
                  </select>
                </div>
              </div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" name="submitUpgrade" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> UPGRADE MEMBER </button>
                </div>
              </div>
            </form>
      
          <table id="dynamic-table" class="table table-striped table-bordered table-hover" style='margin-top: 50px;'>
                  <thead>
                    <tr role="row">
                      <th  class="sorting_desc">User Id</th>
                      <th  class="sorting">Name </th>
                      <th  class="sorting">Package </th>
                      <th  class="sorting">Amount </th>
                      <th  class="sorting">Date & Time </th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    
                    
						$QR_PAID_MEM = "SELECT tm.*,sub.update_time as sdate,pin.amount as mrp,pin.package_name  FROM tbl_retopup  AS sub LEFT JOIN tbl_members AS tm ON sub.member_id=tm.member_id LEFT JOIN tbl_retopup_pin AS pin ON sub.type_id=pin.type_id WHERE sub.id >0 ORDER BY sub.id DESC LIMIT 15";
							$AR_PAID_MEMS = $this->SqlModel->runQuery($QR_PAID_MEM);
							foreach($AR_PAID_MEMS as $AR_PAID_MEM):
								?>
                    <tr class="odd" role="row">
                        <td><?php echo strtoupper($AR_PAID_MEM['user_id']);?> </td>
                        <td><?php echo strtoupper($AR_PAID_MEM['first_name'].' '.$AR_PAID_MEM['middle_name'].' '.$AR_PAID_MEM['last_name']);?> </td>
                        <td><?php echo strtoupper($AR_PAID_MEM['package_name']);?> </td>
                        <td><?php echo $AR_PAID_MEM['mrp'];?> </td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($AR_PAID_MEM['sdate']));?> </td>
                    </tr>
                    <?php  endforeach;
								
								 ?>
                  </tbody>
                </table>
         
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
new Autocomplete("member_user_id", function(){
	this.setValue = function( id ) {document.getElementsByName("member_id")[0].value = id;}
	if(this.isModified) this.setValue("");
	if(this.value.length < 1 && this.isNotClick ) return;
	return "<?php echo ADMIN_PATH; ?>autocomplete/listing?srch=" + this.value+"&switch_type=MEMBER";
});
</script>
</body>
</html>
