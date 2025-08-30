<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$today_date = getLocalTime();
	$segment = $this->uri->uri_to_assoc(2);
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
	$transfer_id = ($form_data['transfer_id'])? $form_data['transfer_id']:_d($segment['transfer_id']);
$request_id = _d($segment['request_id']);
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$wallet_id = $model->getWallet(WALLET1);
    $trns_status  ='P';
	$StrWhr .=" AND tft.trns_status='".$trns_status."'";
$QR_PAGES="SELECT tft.*, tm.first_name, tm.last_name, tm.user_id , tm.user_name , tpp.processor_name, tpp.processor_id
		  ,tm.account_number,tm.bank_name,tm.ifc_code  FROM tbl_fund_transfer AS tft 
		   LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 
		   LEFT JOIN ".prefix."tbl_payment_processor AS tpp ON  tpp.processor_id=tft.processor_id
		   WHERE  tft.trns_for LIKE 'WITHDRAW' AND  tft.wallet_id='".$wallet_id."'
		   $StrWhr ORDER BY tft.transfer_id DESC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
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
          <h1> Staff <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Add New Staff   </small> </h1>
         
        </div>
        <!-- /.page-header -->
        <div class="row">
          <?php  get_message(); ?>
          <div class="col-xs-12" style="min-height:500px;">
            <!-- PAGE CONTENT BEGINS -->
           <div class="col-sm-12 col-sm-offset-2"> 
            <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("staff","addstaff",""); ?>" enctype='multipart/form-data' method="post">

<h3 class="lighter block blue">Personal Information</h3>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">First Name : <span class="red">*</span></label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="First Name" name="fname" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['fname']; ?>">
                </div>
              </div>
              
               <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Midle  Name : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Midle Name" name="mname" class="col-xs-10 col-sm-5 " type="text" value="<?php //echo $ROW['mname']; ?>">
                </div>
              </div>
			    <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Last  Name : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Last Name" name="lname" class="col-xs-10 col-sm-5 " type="text" value="<?php //echo $ROW['lname']; ?>">
                </div>
              </div>
              
               <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Date Of Birth : <span class="red">*</span></label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="DOB" name="dob" class="col-xs-10 col-sm-5  validate[required]" type="date" value="<?php //echo $ROW['dob']; ?>">
                </div>
              </div>
              
              
               <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Father/Mother/husband Name : <span class="red">*</span></label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Father/Mother/husband Name " name="pname" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['pname']; ?>">
                </div>
              </div>
              
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Mobile No. : <span class="red">*</span></label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="9876543210" name="mob" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['pname']; ?>">
                </div>
              </div>
                         <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Email Id : <span class="red">*</span></label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="example@gmail.com " name="emailid" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['pname']; ?>">
                </div>
              </div>
              
               <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Gender : <span class="red">*</span></label>
                <div class="col-sm-9">
                   <select  class="col-xs-10 col-sm-5 validate[required]"name='gender'>
                  <option value=''>--Select--</option>   
                  <option value='M'>Male</option>   
                  <option value='F'>Female</option>   
                  
                  </select>
                </div>
              </div>
               <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Martial Status : <span class="red">*</span></label>
                <div class="col-sm-9">
                 
                  <select  class="col-xs-10 col-sm-5 validate[required]"name='mstatus'>
                  <option value=''>--Select--</option>   
                  <option value='M'>Married </option>   
                  <option value='S'>Single</option>   
                  
                  </select>
                 
                                 </div>
              </div>
              
              
			  
              <div class="space-4"></div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Present Address : </label>
                <div class="col-sm-9">
                  <textarea name="presentAdd" class="col-xs-10 col-sm-5 " id="form-field-1" placeholder="X-230 Street No.22 , New Delhi , Delhi "></textarea>
                </div>
              </div>
               <div class="space-4"></div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Permanent  Address : </label>
                <div class="col-sm-9">
                  <textarea name="permanentAdd" class="col-xs-10 col-sm-5 " id="form-field-1" placeholder="X-230 Street No.22 , New Delhi , Delhi   "></textarea>
                </div>
              </div>
                         <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Profile Picture : <span class="red">*</span></label>
                <div class="col-sm-9">
                  <input id="form-field-1"  name="pic" class="col-xs-10 col-sm-5 validate[required]" type="file" >
                </div>
              </div>
             
              
              <h3 class="lighter block blue">Joining Details</h3>
              
            <div class="space-4"></div>
            <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Current Designation : <span class="red">*</span></label>
            <div class="col-sm-9">
            <input id="form-field-1" placeholder="Accountant " name="cdesignation" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['pname']; ?>">
            </div>
            </div>
             <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Joining Date : <span class="red">*</span></label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="joining Date" name="jdate" class="col-xs-10 col-sm-5  validate[required]" type="date" value="<?php //echo $ROW['dob']; ?>">
                </div>
              </div>
            <div class="space-4"></div>
            <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Salary : <span class="red">*</span></label>
            <div class="col-sm-9">
            <input id="form-field-1" placeholder="15000 " name="salary" class="col-xs-10 col-sm-5 validate[required]" type="number" value="<?php //echo $ROW['pname']; ?>">
            </div>
            </div>
               <h3 class="lighter block blue">Banking Details</h3>
              <div class="space-4"></div>
            <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Bank Name : <span class="red">*</span></label>
            <div class="col-sm-9">
            <input id="form-field-1" placeholder="Bank Name " name="bank_name" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['pname']; ?>">
            </div>
            </div>
             <div class="space-4"></div>
            <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">A/c No. : <span class="red">*</span></label>
            <div class="col-sm-9">
            <input id="form-field-1" placeholder="A/c No. " name="accountno" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['pname']; ?>">
            </div>
            </div>
             <div class="space-4"></div>
            <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">IFSC Code : <span class="red">*</span></label>
            <div class="col-sm-9">
            <input id="form-field-1" placeholder="IFSC Code " name="ifsccode" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['pname']; ?>">
            </div>
            </div>
             <div class="space-4"></div>
            <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pan No : <span class="red">*</span></label>
            <div class="col-sm-9">
            <input id="form-field-1" placeholder="CTVPP9020F" name="pan" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['pname']; ?>">
            </div>
            </div>
             <div class="space-4"></div>
            <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Adhar No : <span class="red">*</span></label>
            <div class="col-sm-9">
            <input id="form-field-1" placeholder="3233 2323 3433" name="adhar" class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php //echo $ROW['pname']; ?>">
            </div>
           </div>
              <div class="space-4"></div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                  <input type="hidden" name="wallet_trns_id" id="wallet_trns_id" value="<?php echo $ROW['wallet_trns_id']; ?>">
                  <button type="submit" name="submitstaff" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>

                  <button onClick="window.location.href='<?php echo ADMIN_PATH."staff/stafflist"; ?>'"  class="btn" type="button"> <i class="ace-icon fa fa-undo bigger-110"></i> Cancel </button>
                </div>
              </div>
            </form>
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
		$("#form-page").validationEngine();
	});
	
	function getbalance(elem)
	{
	var id = elem.value;
	 jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "superadmin/financial/getbalance",
data: {userId: id},
success: function(res) {
//alert(res);
document.getElementById("cur_bal").value=res;


}
});
	}
</script>
</body>
</html>
