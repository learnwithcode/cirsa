<?php defined('BASEPATH') OR exit('No direct script access allowed');
$segment = $this->uri->uri_to_assoc(2);
$request_id = _d($segment['request_id']);
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
       
        </div>     
        <h1> Withdrawal     Manual  </h1><hr>
        <!-- /.page-header -->
        <div class="row">
        
          <div class="col-xs-12"  >  
          <?php  get_message(); ?>
           
            <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("transaction","make_withdrawal",""); ?>" method="post">
              
               <?php
   $rand=rand();
  $this->session->set_userdata("rand",$rand);
  ?>
  <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    
    
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User Id : </label>
                <div class="col-sm-9">
                 <input class="form-control" required="" placeholder="Please enter Beneficiary User Id" id="user_id"  onchange="getUserdata(this.value);"     name="user_id" type="text">
                </div>
              </div>
               <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Income Wallet : </label>
                <div class="col-sm-9">
                 <input class="form-control" required="" placeholder="Wallet Amount"   id="wallet"   readonly type="text">
                </div>
              </div>
             <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Beneficiary Name : </label>
                <div class="col-sm-9">
                 <input class="form-control"  placeholder="Beneficiary Name"   id="name"   readonly type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bank Account Number : </label>
                <div class="col-sm-9">
                 <input class="form-control"  placeholder="Bank Account Number" id="account_number"   readonly type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> IFSC Code : </label>
                <div class="col-sm-9">
                 <input class="form-control"  placeholder="IFSC Code"     id="ifsc" readonly type="text">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> USD : </label>
                <div class="col-sm-9">
                 <input class="form-control" required="" placeholder="Please enter withdrawal USD"  onkeyup="setusd(this.value);"      id="amount" name="amount"  type="number">
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Amount in INR : </label>
                <div class="col-sm-9">
                 <input class="form-control" required="" id="inr"  readonly  placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer Amount" type="number">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">  </label>
                <div class="col-sm-9">
                   <input type="hidden" name="submitform" id="submitform" value="1">
				<button type="submit" class="btn btn-primary">Submit</button>
				<a    href="<?php  echo generateSeoUrlAdmin("transaction","home",''); ?>"  >	<button type="button" class="btn btn-danger">Back</button></a>
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
		$("#form-page").validationEngine();
	});
 function setusd(usd)
         {
              var amt = parseFloat(usd*75);
              var charge =0;// parseFloat(amt*2.5/100);
              var gst = 0;//parseFloat(charge*18/100);
              var total = parseFloat(amt+charge+gst);
             document.getElementById("inr").value= total;
         }
         
         function getUserdata(id)
         {
            jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "superadmin/transaction/getUserdetails",
data: {userId: id},
success: function(res) {
 var data = JSON.parse(res);
if(data.status)
{




  document.getElementById("name").value=data.name;
  document.getElementById("account_number").value=data.account_number;
  document.getElementById("ifsc").value=data.ifc_code;
  document.getElementById("wallet").value=data.wallet; 
}
else
{
 
alert('Not Available User Id...');
document.getElementById("user_id").value='';
document.getElementById("user_id").focus();
}
 

} });
         }
         
     </script>
</body>
</html>
