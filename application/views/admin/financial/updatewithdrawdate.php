<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$today_date = getLocalTime();
	$segment = $this->uri->uri_to_assoc(2);
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
	$transfer_id = ($form_data['transfer_id'])? $form_data['transfer_id']:_d($segment['transfer_id']);
$request_id = _d($segment['request_id']);
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	
	
	
	$wallet_id = $model->getWallet(WALLET1);
    $trns_status  ='C';
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
          <h1> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Update Date   </small> </h1>
            <div class="pull-right tableTools-container">
                    
                    </div>
        </div>

        
        <div class="clearfix">&nbsp;</div>
                <div class="table-responsive-row">
                  <table  class="table table-striped table-bordered table-hover" id="no-more-tables">
                    <thead>
                      <tr>
                       
                        <th>Srl # </th>
                       
                        <th>User Name </th>
                        <th>Type</th>
                        <th> Request Amount </th>
                        <th> Trns No </th>
                        <th>Amount</th>
                    <!--    <th>BTC AC. </th>-->
                        <th>Status</th>
                        <th>Update Date </th>
                        <th>Bank</th>
                      </tr>
                    </thead>
                    <form method="post" name="form-valid" id="form-valid" onSubmit="return confirm('Make sure , want to changes transaction status?')" action="<?php echo generateAdminForm("financial","withdrawals",""); ?>">
                      <tbody>
                        <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=$PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
                        <tr>
                         
                          <td data-title="Srl No" class=""><?php echo $Ctrl; ?></td>
                       
                          <td  data-title="Username"><?php echo $AR_DT['user_name']; ?></td>
                          <td  data-title="Type"><?php echo $AR_DT['type']; ?></td>
                          <td  data-title="Request Amount"><?php echo number_format($AR_DT['initial_amount'],2); ?> </td>
                          <td  data-title="Fee"><?php echo $AR_DT['trans_no']; ?></td>
                          <td  data-title="Amount"><input type="text" class="form-control enableText updateWithdraw" name="trns_amount" id="trns_amount<?php echo $AR_DT['transfer_id']; ?>" value="<?php echo number_format($AR_DT['trns_amount'],2); ?>" readonly="true" ref="<?php echo $AR_DT['transfer_id']; ?>"></td>
                        
                          <td  data-title="Status">
                  
                          <a  href="javascript:void(0);" class="label label-success">Success</a>
                           
                          </td>
                          <td data-title="Update Date"><input type="date" onchange="handler(event,<?php echo $AR_DT['transfer_id'];?>);" id="up_date" value="<?php echo $AR_DT['trns_date']; ?>"></td>
                          <td  data-title="Bank" align="center"><a href="javascript:void(0)" transfer_id="<?php echo _e($AR_DT['transfer_id']); ?>" class="label label-info "data-toggle="modal" data-target="#bank-details<?php echo $AR_DT['transfer_id'];?>" >Bank Detail</a></td>
                        </tr>
                        <?php $Ctrl++; endforeach; ?>
                       
                        <?php  }else{ ?>
                        <tr>
                          <td colspan="9" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No withdrawals requests found</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </form>
                  </table>
                </div>
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
                </div>
                
                
                
      </div>
      <!-- /.page-content -->
    </div>
  </div>
    <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  	
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
			       
  <div id="bank-details<?php echo $AR_DT['transfer_id'];?>"  class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="smaller lighter blue no-margin">Bank Transaction Detail [ <?php echo $AR_DT['user_id'];?> ]</h3>
        </div>
        <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","withdrawals","");  ?>" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Bank Name  :</label>
              <div class="col-sm-7">
                <input id="bank_name" placeholder="Bank Name" name="bank_name"  class="col-xs-10 col-sm-12" type="text" readonly value="<?php echo $AR_DT['bank_name']; ?>">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Bank Account No  :</label>
              <div class="col-sm-7">
                <input id="bank_account_no" placeholder="Bank Account No" name="bank_account_no"  class="col-xs-10 col-sm-12" type="text" readonly value="<?php echo $AR_DT['account_number']; ?>">
              </div>
            </div>
                        <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> IFSC Code  :</label>
              <div class="col-sm-7">
                <input id="bank_name" placeholder="Bank Name" name="bank_name"  class="col-xs-10 col-sm-12" type="text" readonly value="<?php echo $AR_DT['ifc_code']; ?>">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date  :</label>
              <div class="col-sm-7">
                <div class="input-group">
                  <input class="form-control col-xs-4 col-sm-3 validate[required]  date-picker" name="date_time" id="date_time" value="<?php echo date('d-m-Y',strtotime($AR_DT['trns_date']));?>" readonly type="text"  />
                  <span class="input-group-addon"> <i class="fa fa-calendar"></i></span></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Transaction No  :</label>
              <div class="col-sm-7">
                <input id="bank_trans_no" placeholder="Transaction No" name="bank_trans_no"  class="col-xs-10 col-sm-12 validate[required]" type="text" readonly value="<?php echo $AR_DT['trans_no']; ?>">
              </div>
            </div>
                        <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">  Transaction Type :</label>
              <div class="col-sm-7">
                <input id="bank_trans_no" placeholder="Transaction No" name="bank_trans_no"  class="col-xs-10 col-sm-12 validate[required]" type="text" readonly value="<?php echo $AR_DT['type']; ?>">
              </div>
            </div>
           
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Transaction Detail   :</label>
              <div class="col-sm-7">
                <textarea name="bank_trans_detail" class="col-xs-10 col-sm-12 validate[required]" id="bank_trans_detail" readonly placeholder="Transaction Detail"><?php echo $AR_DT['trns_remark']; ?></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="transfer_id"  id="transfer_id" value="">
            <input type="hidden" name="bank_tid"  id="bank_tid" value="">
          <!--  <button type="submit" name="submitBankTransaction" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check"></i> Submit </button>
            <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>-->
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
    <?php endforeach; }?>
  
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
	
function handler(e,id){
  var cdate = e.target.value;
jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "superadmin/financial/updatewithdrawaldateAjax",
data: {dates:cdate,id: id},
success: function(res) {


}
});
}
</script>
</body>
</html>
