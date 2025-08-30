<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$today_date = getLocalTime();
	$segment = $this->uri->uri_to_assoc(2);
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
	$transfer_id = ($form_data['transfer_id'])? $form_data['transfer_id']:_d($segment['transfer_id']);
$request_id = _d($segment['request_id']);
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	
	
		if($action_request!='')	{
		$trns_status = _d($segment['trns_status']);
		switch($action_request){
			case "STS":
				switch($trns_status):
				
					case "R":
						$trns_date = InsertDate($today_date);
						$AR_TRF = $model->getFundTransfer($transfer_id);
						$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
						if($AR_TRF['initial_amount']>0){
							if($AR_TRF['transfer_id']>0 && $AR_MEM['member_id']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>$trns_status,"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
								 $model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");							
								set_message("success","Fund transfer rejected succesfully");		
								redirect_page("financial","makewithdrawal",array());
							}else{
								set_message("warning","Tranaction failed , please try again");		
								redirect_page("financial","makewithdrawal",array());	
							}
						}else{
							set_message("warning","Unable to process your request");		
							redirect_page("financial","makewithdrawal",array());
						}
					break;
				endswitch;				
			break;
		}
	}
	
	
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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

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
          <h1> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Make Withdrawal   </small> </h1>
          <div class="pull-right tableTools-container">    <div class="dt-buttons btn-overlap btn-group"> 
            <!--<a href="<?php echo generateSeoUrlAdmin("financial","updatewithdrawdate",array("")); ?>" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold"><span><i class="fa fa-plus bigger-110 blue"></i> <span class="">Change Date</span></span></a> -->
                     </div>  </div>
        </div>
        <!-- /.page-header -->
        <div class="row">
         
          <div class="col-xs-12" style="min-height:500px;"> <?php  get_message(); ?>
            <!-- PAGE CONTENT BEGINS -->
            <?php if($request_id=='' || $request_id==0){ ?>
            <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","makewithdrawal",""); ?>" method="post">
              <!--<div class="form-group" style="display:none;">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Wallet Type : </label>
                <div class="col-sm-9">
                  <select name="wallet_id" class="col-xs-10 col-sm-5 validate[required]" id="wallet_id" >
                    <option value="">select wallet</option>
                    <?php DisplayCombo(1,"WALLET"); ?>
                   <option value="1" selected>E-wallet</option>
                   <option value="2">Commission Wallet</option>
                  </select>
                </div>
              </div>
              <div class="form-group" style="display:none;">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transaction Type : </label>
                <div class="col-sm-9">
                  <input type="radio" name="trns_type" id="trns_type"  value="Cr">
                  Credit &nbsp;&nbsp;
                  <input type="radio" name="trns_type" id="trns_type" checked value="Dr">
                  Debit </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Member ID : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Member ID" name="user_id"  id="user_id" onChange="return getbalance(this);"class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $ROW['user_id']; ?>">
                </div>
              </div>
			  
			   <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Current Balance : </label>
                <div class="col-sm-9">
                <input   id="cur_bal"  class="col-xs-10 col-sm-5 " type="text" readonly>
                </div>
              </div>
			  

			  
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Amount : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Amount" name="initial_amount"  class="col-xs-10 col-sm-5 validate[required]" type="text" 
				value="<?php echo $ROW['initial_amount']; ?>">
                </div>
              </div>
                <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Bank Name : </label>
                <div class="col-sm-9">
                  <select  class="col-xs-10 col-sm-5 "name='bank_name'>
                  <option value=''>--Select--</option>   
                  <option value='STATE BANK OF INDIA'>STATE BANK OF INDIA</option>   
                  <option value='KOTAK MAHINDRA BANK'>KOTAK MAHINDRA BANK</option>   
                  <option value='YES BANK'>YES BANK</option>   
                  <option value='INDUSIND BANK'>INDUSIND BANK</option>  
                  <option value='FEDERAL BANK'>FEDERAL BANK</option>   
                  <option value='BANDHAN BANK'>BANDHAN BANK</option>  
                  </select>
                </div>
              </div>
             
              <div class="space-4"></div>
                <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transaction Date : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" name="trnsdate"  class="col-xs-10 col-sm-5 " type="date" 
			>
                </div>
              </div>
               <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transaction No/ Cheque No. : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Transaction No ..." name="trnsno"  class="col-xs-10 col-sm-5 " type="text" 
				value="<?php echo $ROW['initial_amount']; ?>">
                </div>
              </div>
               <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transaction Type : </label>
                <div class="col-sm-9">
                  <select  class="col-xs-10 col-sm-5 "name='type'>
                  <option value=''>--Select--</option>   
                  <option value='NEFT'>NEFT</option>   
                  <option value='IMPS'>IMPS</option>   
                  <option value='RTGS'>RTGS</option> 
                  <option value="CHEQUE">CHEQUE</option>
                  <option value='CASH'>CASH</option>   
                  </select>
                </div>
              </div>
              <div class="space-4"></div>
              
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description : </label>
                <div class="col-sm-9">
                  <textarea name="trns_remark" class="col-xs-10 col-sm-5 " id="form-field-1" placeholder="Remarks"></textarea>
                </div>
              </div>
              <div class="space-4"></div>
              
              -->
              <h3 class="header smaller lighter blue">Set mandatory Feilds  
              
              
                          <button type="submit" name="submitTransaction" value="1" class="btn btn-info pull-right"> <i class="ace-icon fa fa-check bigger-110"></i> Make Withdrawal </button>
              </h3>
                
                
                  <div class="row">
                       <div class="space-4"></div>
                   <div class="col-md-12">
                       <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Beneficiary Name :  <input  type="checkbox"   name="ben_name" value="1" ></label>
              
              </div>
   </div>
   </div>
              <div class="row">
                  <div class="col-md-6">
                   <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> Bank Name :  <input   type="checkbox"   name="bank_name" value="1"  ></label>
                 
              </div>    
                  </div>
                  
                   <div class="col-md-6">
                       <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-12 control-label no-padding-right" for="form-field-1"> A/c No. :  <input  type="checkbox"   name="ac_no" value="1" ></label>
              
              </div>
   </div>
                  
              </div>
       			  
                <div class="row">
                  <div class="col-md-6">   <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> IFSC Code :     <input   type="checkbox"   name="ifsc" value="1"  ></label>
                <div class="col-sm-9">
              
                </div>
              </div>
 </div>
                  
                   <div class="col-md-6"> <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pan Card :  <input   type="checkbox"   name="pan_no" value="1"  ></label>
                <div class="col-sm-9">
                 
                </div>
              </div>
  </div>
                  
              </div>
              
                       
               <div class="row">
                  <div class="col-md-6">     <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Adhaar Card : <input  type="checkbox"   name="adhaar" value="1"  ></label>
                <div class="col-sm-9">
                  
                </div>
              </div>
</div>
                  
                   <div class="col-md-6">  <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mobile No :  <input  type="checkbox"   name="mobile" value="1"  ></label>
                <div class="col-sm-9">
                 
                </div>
              </div>
 </div>
                  
              </div>
              
                    
              
              
              
                   
                      
                <div class="row">
                  <div class="col-md-4"> 
                  			  
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-8 control-label no-padding-right" for="form-field-1">Minimum Withdrawal  Amount : </label>
                <div class="col-sm-4">
                  <input id="form-field-1" placeholder="Amount" name="initial_amount" required  class="col-md-9 validate[required]" type="text" 
				value="<?php echo $ROW['initial_amount']; ?>">
                </div>
              </div>
               </div>
               <div class="col-md-4"> 
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-6 control-label no-padding-right" for="form-field-1"> Withdrawal  Date : </label>
                <div class="col-sm-6">
                  <input id="form-field-1"   name="with_date" required  class="col-md-12 validate[required]" type="date" >
                </div>
              </div>  
                </div>  
               
 <div class="col-md-4"> <div class="space-4"></div>
                  <div class="form-group">
                <label class="col-sm-5 control-label no-padding-right" for="form-field-1">Select Wallet : </label>
                <div class="col-sm-7">
                  <select  class="form-control "name='wallet_id'>
                  <option value=''>--Select--</option>   
                  <option value='1'>E-wallet</option>   
                  <!--<option value='3'>C-wallet</option>   -->
               
                  </select>
                </div>
              </div>  </div>
                 
                 
                 
                 
                 
                 
                 
                 
                
                  
              </div>
              
                 <div class="col-md-3">          <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                  <input type="hidden" name="wallet_trns_id" id="wallet_trns_id" value="<?php echo $ROW['wallet_trns_id']; ?>">
      

                  <!--<button onClick="window.location.href='<?php echo ADMIN_PATH."financial/addtransaction"; ?>'"  class="btn" type="button"> <i class="ace-icon fa fa-undo bigger-110"></i> Cancel </button>-->
                </div>
              </div>
 </div>
                   
                   
              
                         
              
              
                  <h3 class="header smaller lighter blue"> </h3>
              
    
            </form>
            <?php }else{ ?>
            <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","addtransaction",array("request_id"=>$segment['request_id'])); ?>" method="post">
              <h3 class="panel-title text-white"> <i class="fa fa-adjust"></i> Verfiy Otp </h3>
              <div class="clear">&nbsp;</div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">OTP : </label>
                <div class="col-sm-4">
                  <input type="password" name="sms_otp" id="sms_otp" placeholder="Check your registered email address" value="" class="form-control validate[required,minSize[6],custom[integer]]" maxlength="7"/>
                </div>
              </div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                  <input type="hidden" name="request_id" id="request_id" value="<?php echo $segment['request_id']; ?>" />
                  <input type="submit" name="verifyOTPAdmin" value="Verify OTP" class="btn btn-primary btn-submit" id="updateOTP"/>
                </div>
              </div>
            </form>
            <?php } ?>
            <!-- PAGE CONTENT ENDS -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        
        <div class="clearfix">&nbsp;</div>
                <div class="table-responsive-row">
                  <table  class="table table-striped table-bordered table-hover" id="no-more-tables">
                    <thead>
                      <tr>
                        <th> <input type="checkbox"  name="trns_status[]" id="select-all" ></th>
                        <th>Srl # </th>
                        <th> Date</th>
                        <th>User Name </th>
                        <th>Type</th>
                        <th> Request Amount </th>
                        <th> Fee </th>
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
                          <td data-title="Action" class=""><?php if($AR_DT['trns_status']=="P"){ ?>
                            <input type="checkbox"  name="trns_status[]" id="" value="<?php echo $AR_DT['transfer_id']; ?>">
                            <?php } ?>
                          </td>
                          <td data-title="Srl No" class=""><?php echo $Ctrl; ?></td>
                          <td  data-title="Date"><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                          <td  data-title="Username"><?php echo $AR_DT['user_name']; ?></td>
                          <td  data-title="Type"><?php echo ($AR_DT['processor_id']>0)? $AR_DT['processor_name']:"Bank "; ?></td>
                          <td  data-title="Request Amount"><?php echo number_format($AR_DT['initial_amount'],2); ?> </td>
                          <td  data-title="Fee"><?php echo number_format($AR_DT['withdraw_fee'],2); ?></td>
                          <td  data-title="Amount"><input type="text" class="form-control enableText updateWithdraw" name="trns_amount" id="trns_amount<?php echo $AR_DT['transfer_id']; ?>" value="<?php echo number_format($AR_DT['trns_amount'],2); ?>" readonly="true" ref="<?php echo $AR_DT['transfer_id']; ?>"></td>
                        
                          <td  data-title="Status">
                  
                          <a  href="<?php echo generateSeoUrlAdmin("financial","makewithdrawal",array("transfer_id"=>_e($AR_DT['transfer_id']),"trns_status"=>_e("R"),"action_request"=>"STS")); ?>"  onClick="return confirm('Make sure want to reject this withdrawal request')" class="label label-warning">Reject</a>
                           
                          </td>
                          <td data-title="Update Date"><?php echo DisplayDate($AR_DT['trns_date']); ?></td>
                          <td  data-title="Bank" align="center"><a href="javascript:void(0)" transfer_id="<?php echo _e($AR_DT['transfer_id']); ?>" class="label label-info "data-toggle="modal" data-target="#bank-details<?php echo $AR_DT['transfer_id'];?>" >Bank Detail</a></td>
                        </tr>
                        <?php $Ctrl++; endforeach; ?>
                       
                        <?php  }else{ ?>
                        <tr>
                          <td colspan="11" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No withdrawals requests found</td>
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
</script>
</body>
</html>
