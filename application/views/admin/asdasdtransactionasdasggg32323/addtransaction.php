<?php defined('BASEPATH') OR exit('No direct script access allowed');
$segment = $this->uri->uri_to_assoc(2);
$request_id = _d($segment['request_id']);
$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}



$QR_PAGES= "SELECT tft.*,tmt.first_name AS first_name, tmt.last_name AS last_name,tmt.midle_name as midle_name, tmt.user_id  AS user_id
			 FROM ".prefix."tbl_wallet_trns AS tft 
			
			 LEFT JOIN tbl_members AS tmt ON tmt.member_id=tft.member_id	
			 WHERE tft.wallet_trns_id>0 and tft.trns_for='AM'
			 $StrWhr ORDER BY tft.wallet_trns_id DESC ";
$PageVal = DisplayPages($QR_PAGES,25,$Page,$SrchQ);
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
          <h1> Transaction  <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Add / Deduct   </small> </h1>
        </div>
        <!-- /.page-header -->
        <div class="row">
        
          <div class="col-xs-12"  >  <?php  get_message(); ?>
 
            <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("transaction","addtransaction",""); ?>" method="post">
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Wallet Type : </label>
                <div class="col-sm-9">
                  <select name="wallet_id" class="col-xs-10 col-sm-5 validate[required]" id="wallet_id" style="height:4">
                    <option value="">select wallet</option>
                   <?php //DisplayCombo(1,"WALLET"); ?> 
                    <option value="1">Elite Global Pocket</option>
                   
                  <option value="3">Elite Static Pocket</option> 
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transaction Type : </label>
                <div class="col-sm-9">
                  <input type="radio" name="trns_type" id="trns_type"  value="Cr" checked="true">
                  Credit &nbsp;&nbsp;
                  <input type="radio" name="trns_type" id="trns_type"  value="Dr">
                  Debit </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="spr_user_id">Member ID : </label>
                <div class="col-sm-9">
                  <input id="spr_user_id" placeholder="Member ID" name="user_id"  class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $ROW['user_id']; ?>">
                </div>
              </div>
               <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="spr_user_id">Member Name : </label>
                <div class="col-sm-9">
                  <input id="spr_full_name" placeholder="Member Name"    class="col-xs-10 col-sm-5  " type="text" readonly>
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> USD : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="USD" name="initial_amount"  class="col-xs-10 col-sm-5 validate[required]" type="text" 
				value="<?php echo $ROW['initial_amount']; ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description : </label>
                <div class="col-sm-9">
                  <textarea name="trns_remark" class="col-xs-10 col-sm-5 validate[required]" id="form-field-1" placeholder="Remarks"><?php echo $ROW['trns_remark']; ?></textarea>
                </div>
              </div>
              <div class="space-4"></div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                  <input type="hidden" name="wallet_trns_id" id="wallet_trns_id" value="<?php echo $ROW['wallet_trns_id']; ?>">
                  <button type="submit" name="submitTransaction" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
     
                  <button onClick="window.location.href='<?php echo ADMIN_PATH."transaction/home"; ?>'"  class="btn" type="button"> <i class="ace-icon fa fa-undo bigger-110"></i> Cancel </button>
                </div>
              </div>
            </form>
           
           
           <div class="page-header">
          <h1>   Transactions History  </h1>
        </div>
           
           <div class="clearfix">&nbsp;</div>
              <div class="col-xs-12">
                <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                     <th  class="center"> Date </th>
                     <th >Member </th>
                     <th>Name</th>
                     <th >Description</th>
                     <th >Trans Type </th>
                     <th >Amount</th>
                     <th >Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
                    <tr <?php if($AR_DT['trns_type']=='Cr'){echo 'class="success"';}else{ echo 'class="warning"';}?>>
                      <td data-title="Date"><?php echo Displaydate($AR_DT['trns_date']); ?></td>
                      <td data-title="Member Id"><?php echo strtoupper($AR_DT['user_id']); ?></td>
                      
                      <td data-title="Name"><?php echo strtoupper($AR_DT['first_name'].' '.$AR_DT['midle_name'].' '.$AR_DT['last_name']); ?> </td>
                      <td data-title="Description"><?php echo strtoupper($AR_DT['trns_remark']); ?></td>
                      <td data-title="Trans Type"><!--<?php if($AR_DT['trns_for'] == 'BYC'){echo 'COMMISION';}else{ echo $AR_DT['trns_for'];} ?>--><?php echo $AR_DT['trns_type'];?></td>
                       <td data-title="Amount"><?php echo $AR_DT['trns_amount']; ?> &nbsp;&nbsp;$</td>
                      <td data-title="Status">
                        Confirmed
                       
                      </td>
                    </tr>
                    <?php $Ctrl++; 
						endforeach; 
						}else{ ?>
                    <tr>
                      <td colspan="6" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No transaction found</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <div class="clearfix">&nbsp;</div>
              <div class="row">
                <div class="col-xs-6">
                  <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries </div>
                </div>
                <div class="col-xs-6">
                  <div id="dynamic-table_paginate" class="dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                      <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                    </ul>
                  </div>
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
	
	
	
	
		$("#spr_user_id").on('blur',function(){
			var URL_SPR = "<?php echo BASE_PATH; ?>json/jsonhandler";
			var spr_user_id = $("#spr_user_id").val();
			$.getJSON(URL_SPR,{switch_type:"CHECKUSR",spr_user_id:spr_user_id},function(JsonEval){

				if(JsonEval){
					if(JsonEval.member_id>0){
						$("#spr_full_name").val(JsonEval.full_name);
				 
					}else{
						$("#spr_full_name").val('Invalid Member Id');
					 
					}
				}else{
					$("#spr_full_name").val('Invalid Member Id');
				   
				}
			});
	});
</script>
</body>
</html>
