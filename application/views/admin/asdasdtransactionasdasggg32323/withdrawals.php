<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

$price = getCoinMarketCap();	

	$model = new OperationModel();
	$form_data = $this->input->post();
	$today_date = getLocalTime();
	$segment = $this->uri->uri_to_assoc(2);
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
	$transfer_id = ($form_data['transfer_id'])? $form_data['transfer_id']:_d($segment['transfer_id']);
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$wallet_id = $model->getWallet(WALLET1);


	if($_GET['user_id']!=''){
		$member_id = $model->getMemberId($_GET['user_id']);
		$StrWhr .=" AND tm.member_id='$member_id'";
		$SrchQ .="&user_id=$user_id";
	}
	
	if($_GET['processor_id']>0){
		$processor_id = FCrtRplc($_GET['processor_id']);
		$StrWhr .=" AND tft.processor_id='$processor_id'";
		$SrchQ .="&processor_id=$processor_id";
	}

	if($_GET['from_date']!='' && $_GET['to_date']!=''){
		$from_date = InsertDate($_GET['from_date']);
		$to_date = InsertDate($_GET['to_date']);
		$StrWhr .=" AND DATE(tft.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	if($_GET['trns_status']!=''){
		$trns_status = FCrtRplc($_GET['trns_status']);
	 	$StrWhr .=" AND tft.trns_status='".$trns_status."'";
		$SrchQ .="&trns_status=$trns_status";
	}
	else
	{
	    
	 $trns_status  ='P';
	 	$StrWhr .=" AND tft.trns_status='".$trns_status."'";
	}
	if($action_request!='')	{
		$trns_status = _d($segment['trns_status']);
		switch($action_request){
			case "STS":
				switch($trns_status):
					case "C":
					$trns_date = InsertDate($today_date);
						$AR_TRF = $model->getFundTransfer($transfer_id);
						$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					 
						if($AR_TRF['trns_status']=='P'){
						    
						    if($model->getValue("VIRTUAL_WALLET_CRYPTO") >= ($AR_TRF['initial_amount']/$price))
						    {
							if($AR_TRF['trns_amount']>0){
							    
							        $tt1  = round(($AR_TRF['initial_amount']/$price));
							        $tt2  = round(($AR_TRF['withdraw_fee']/$price));
							        $tt3  = round(($AR_TRF['trns_amount']/$price));
									$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array( 'coins_total' =>$tt1 , 'coins_charge' => $tt2,    'coins_trns' => $tt3,  "trns_status"=>$trns_status,"status_up_date"=>$today_date), array("transfer_id"=>$transfer_id));
								//	$model->wallet_transaction($AR_TRF['wallet_id'],"Dr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request from Admin",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");
                        
                        
                       
                    $trns_remark = "TRX Transfer FROM [".$AR_MEM['user_id']."]" ;
                    $trans_no = rand(11111,999999);
                   
                    $model->wallet_transaction(50,"Dr",1,$tt1,$trns_remark,$today_date,$trans_no,"1","TRX");
                    $model->setWalletTRX($tt1,'Dr');
								    //  coins_trns
								    
								
								    
								    
									set_message("success","Fund transfer successfull");		
									redirect_page("transaction","withdrawals",array());
								}else{
									set_message("warning","Inavlid process, please check withdrawal request");		
									redirect_page("transaction","withdrawals",array());
								}
								
						    }
						    else
						    {
                                    set_message("warning","You have low Crypto balance");		
                                    redirect_page("transaction","withdrawals",array());  
						    }
						    
						    
						}else{
							set_message("warning","Unable to process your request");		
							redirect_page("transaction","withdrawals",array());
						}
					break;
					case "R":
						$trns_date = InsertDate($today_date);
						$AR_TRF = $model->getFundTransfer($transfer_id);
						$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
						if($AR_TRF['initial_amount']>0){
							if($AR_TRF['transfer_id']>0 && $AR_MEM['member_id']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>$trns_status,"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
								$model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");							
								set_message("success","Fund transfer rejected succesfully");		
								redirect_page("transaction","withdrawals",array());
							}else{
								set_message("warning","Tranaction failed , please try again");		
								redirect_page("transaction","withdrawals",array());	
							}
						}else{
							set_message("warning","Unable to process your request");		
							redirect_page("transaction","withdrawals",array());
						}
					break;
				endswitch;				
			break;
		}
	}
	
$QR_PAGES="SELECT tft.*, tm.first_name, tm.last_name, tm.user_id , tm.user_name  
		  ,tm.account_number,tm.bank_name,tm.ifc_code  , tm.btc_address , tm.trx_address , tm.usdt_address , tm.eth_address  FROM tbl_fund_transfer AS tft 
		   LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 
		   
		   WHERE  tft.trns_for LIKE 'WITHDRAW' AND  ( tft.wallet_id='1' or  tft.wallet_id='2')
		   $StrWhr ORDER BY tft.transfer_id DESC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
 
if($_GET['trns_status'] =='C')
{
    $c ='checked';$p='';$r='';
}
elseif($_GET['trns_status'] =='R')
{
     $r = 'checked';$c='';$p='';
}
else
{
    $p='checked';$c='';$r='';
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
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datetimepicker.min.css" />
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
<style>
	.table-wrapper {
		background: #eeeded;
		border-radius: 10px;
		width: 100%;
		height: auto;
		padding: 10px;
		box-sizing: border-box;
		border: 1px solid #CCC;
		margin: 30px 0;
	}
	table {
		background-color: #f9f9f9;
		border-collapse: collapse;
		color: black;
		margin: 0px !important;
		width: 100%;
		text-align: left
	}
	table tr:nth-child(odd) {
		background-color: #fefbf0;
	}
	table tr th {
		/*background-color: #E0CEF2;
		border-color: #B1A3BF;*/
	}
	table tr, table tr td {
		/*line-height: 40px !important;*/
	}
	table tr th, table tr td {
		border: 1px solid #aaa;
	}
 @media only screen and (max-width:992px) {
	/* Force table to not be like tables anymore */
	#no-more-tables table, #no-more-tables thead, #no-more-tables tbody, #no-more-tables th, #no-more-tables td, #no-more-tables tr {
		display: block;
	}
	/* Hide table headers (but not display: none;, for accessibility)  */
	#no-more-tables thead tr {
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	/* Behave like a "row" */
	#no-more-tables td:not(:first-child) {
		position: relative;
		padding-left: 52%;
		text-align: left;
		border-collapse: collapse;
		border-bottom: 0px;
	}
	#no-more-tables td:first-child {
		text-align: center;
		border-collapse: collapse;
		border-bottom: 0px;
		/*background-color: #359AF2;
		color: white;
		font-weight: bold*/
	}
	#no-more-tables td:last-child {
		border: 1px solid #aaa;
	}
	#no-more-tables tr {
		margin-bottom: 10px;
	}
	/* Now like a table header */
	#no-more-tables td:not(:first-child):before {
		position: absolute;
		left: 0;
		top: 0;
		height: 100%;
		width: 48%;
		padding-left: 2%;
		/*background-color: #f2f7fc;*/
		border-right: 1px solid #aaa;
		white-space: wrap;
		text-align: left;
		font-weight: bold;
		content: attr(data-title);
	}
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
          <h1> Withdrawal <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;Request </small> </h1>
        </div>
        <!-- /.page-header -->
        
         <div class="pull-right tableTools-container">
                      <div class="dt-buttons btn-overlap btn-group"> 
                      
                      
                     
                      <a  href="<?php echo generateSeoUrlAdmin("excel","withdrawals",array('status'=>($_GET['trns_status'] !='')?$_GET['trns_status']:'P' , 'group'=>'all')); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i>  All Report</span></a> 
                      
                        
                      
                      <a  href="<?php echo generateSeoUrlAdmin("excel","withdrawals",array('status'=>($_GET['trns_status'] !='')?$_GET['trns_status']:'P', 'group'=>'same')); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> Same Account</span></a> 
                      
                      
                      
                      
                      <a onClick="window.print()"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-pdf buttons-flash btn btn-white btn-primary btn-bold"><span><i class="fa fa-file-pdf-o bigger-110 red"></i> <span class="hidden">Export to PDF</span></span> </a> 
                      
                      
                      <a  onClick="window.print()" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-print btn btn-white btn-primary btn-bold"><span><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></span></a> 
                      
                      
                      </div>
                      
                      
                      
                      
                      
                      
                    </div>
        <div class="row">

          <div class="col-xs-12">
            <div class="row">
                
                          <?php get_message(); ?>
              <div class="col-xs-12">
                  
                  <div class="header-title">
                        <h4 class="card-title">  <code> TRX Price : <?php echo $price;?>   || Available TRX <?php echo number_format($model->getValue("VIRTUAL_WALLET_CRYPTO")   ); ?>/-</code></h4>
                     </div>
                
                <div class="clearfix" style="background-color: beige;">
              
                    <form id="form-search" name="form-search" method="get"  action="<?php echo generateAdminForm("transaction","withdrawals",""); ?>">
                      <div class="col-md-2">
                      <b>User Name </b>
                      <div class="form-group">
                        <div class="clearfix">
                          <input id="form-field-1" placeholder="Member ID" name="user_id" class="col-xs-10 col-sm-12 validate[required]" value="<?php echo $_GET['user_id']; ?>" type="text">
                        </div>
                      </div>
                      </div> 
                      <div class="col-md-3">
                      <b>Status </b>
                      <div class="form-group">
                        <div class="clearfix">
                            <!--echo  checkRadio($_GET['trns_status'],"C");-->
                          <input type="radio" name="trns_status" id="trns_status" <?php echo $c;   ?> value="C">
                          Confirm 
                          &nbsp;&nbsp;
                          <input type="radio" name="trns_status" id="trns_status" <?php  echo $r;   ?> value="R">
                          Reject 
                          &nbsp;&nbsp;
                          <input type="radio" name="trns_status" id="trns_status" <?php  echo $p;   ?>    value="P">
                          Pending 
                          &nbsp;&nbsp; </div>
                      </div>
                      </div>
                      <div class="col-md-2">
                      <b>From Date</b>
                      <div class="form-group">
                        
                          <div class="input-group">
                            <input class="form-control col-xs-12 col-sm-12  date-picker" name="from_date" id="from_date" value="<?php echo $ROW['from_date']; ?>" type="text"  />
                            <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span></div>
                         </div>      </div>
                      <div class="col-md-2">
                          <div class="form-group"><b>To</b>
                          <div class="input-group">
                            <input class="form-control col-xs-12 col-sm-12  date-picker" name="to_date" id="to_date" value="<?php echo $ROW['to_date']; ?>" type="text"  />
                            <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
                        
                      </div>      </div>
                       <div class="col-md-3">
                           <div class="space-8"></div>
                      <input class="btn btn-primary m-t-n-xs" value=" Search " type="submit">
                      <a href="<?php echo generateSeoUrlAdmin("transaction","withdrawals",""); ?>"  class="btn btn-danger m-t-n-xs" value=" Reset ">Reset</a>
                     </div>
                    </form>
                  
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="table-responsive-row">
                  <table  class="table table-striped table-bordered table-hover" id="no-more-tables">
                    <thead>
                      <tr>
                        <!--<th> <input type="checkbox"  name="trns_status[]" id="select-all" ></th>-->
                        <th>Srl # </th>
                        <th> Date</th>
                        <th>User Id </th>
                        <th>User Name </th>
                        <!--<th>Type</th>-->
                        <!--<th>Wallet</th>-->
                         <th> USDT </th>
                        <!--<th> Admin Charge </th>-->
                        <!--<th>USD</th>-->
                        <th>Total TRX</th>
                        <th>Charge </th>
                        <th>Net TRX</th>
                        <th>Status</th>
                        <!--<th>Update Date </th>-->
                        <th>Crypto Name</th>
                         <th>Crypto Address</th>
                      </tr>
                    </thead>
                    <form method="post" name="form-valid" id="form-valid" onSubmit="return confirm('Make sure , want to changes transaction status?')" action="<?php echo generateAdminForm("transaction","withdrawals",""); ?>">
                      <tbody>
                        <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=$PageVal['RecordStart']+1;
				  		
				  		
				  		
						foreach($PageVal['ResultSet'] as $AR_DT):
                                    
                                    
                                    
                               if($AR_DT['trns_status']=="C"){
                                        $coins_total       = $AR_DT['coins_total'];
                                        $coins_charge      = $AR_DT['coins_charge'];
                                        $coins_trns        = $AR_DT['coins_trns'];
                               }
                               else
                               {
                                    $coins_total       = $AR_DT['initial_amount']/$price;
                                    $coins_charge      = $AR_DT['withdraw_fee']/$price;
                                    $coins_trns        = $AR_DT['trns_amount']/$price;
                               }
                                    
                            
                            
                            
						    
						    
			       ?>
                        <tr>
                          <!--<td data-title="Action" class="">-->
                              <?php if($AR_DT['trns_status']=="P"){ ?>
                            <!--<input type="checkbox"  name="trns_status[]" id="" value="<?php echo $AR_DT['transfer_id']; ?>">-->
                            <?php } ?>
                          <!--</td>-->
                          <td data-title="Srl No" class=""><?php echo $Ctrl; ?></td>
                          <td  data-title="Date"><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                          <td  data-title="Username"><?php echo $AR_DT['user_name']; ?></td>
                          <td  data-title="Name"><?php echo $AR_DT['first_name']; ?></td>
                           <!--<td> <?php echo $AR_DT['draw_type'];?></td>-->
                         <!-- <td  data-title="Type"><?php echo ($AR_DT['wallet_id']=='1')? "E-wallet":"W-wallet "; ?></td>-->
                          <td  data-title="Request Amount"><?php echo number_format($AR_DT['initial_amount']); ?> </td>
                          <!--<td  data-title="Admin Charge"><?php echo number_format($AR_DT['withdraw_fee']); ?></td>-->
                          <!--<td  data-title="Amount"><input type="text" class="form-control enableText updateWithdraw" name="trns_amount" id="trns_amount<?php echo $AR_DT['transfer_id']; ?>" value="<?php echo number_format($AR_DT['trns_amount'],2); ?>" readonly="true" ref="<?php echo $AR_DT['transfer_id']; ?>"></td>-->
                        <td  data-title="Request Amount"><?php echo number_format($coins_total); ?> </td>
                        <td  data-title="Admin Charge"><?php echo number_format($coins_charge); ?></td>
                        <td  data-title="Request Amount"><?php echo number_format($coins_trns); ?> </td>
                          <td  data-title="Status"><?php if($AR_DT['trns_status']=="C"){ ?>
                            <a href="javascript:void(0)" onClick="alert('Already confirmed')" class="label label-success arrowed-in arrowed-in-right">Confirmed</a>
                            <?php }elseif($AR_DT['trns_status']=="R"){ ?>
                            <a  href="javascript:void(0)" onClick="alert('Already rejected')"   class="label label-warning">Rejected</a>
                            <?php }else{ ?>
                            <a href="<?php echo generateSeoUrlAdmin("transaction","withdrawals",array("transfer_id"=>_e($AR_DT['transfer_id']),"trns_status"=>_e("C"),"action_request"=>"STS")); ?>" onClick="return confirm('Make sure want to approved this  withdrawal request')" class="label label-success arrowed-in arrowed-in-right">Confirm</a> &nbsp;&nbsp; <a  href="<?php echo generateSeoUrlAdmin("transaction","withdrawals",array("transfer_id"=>_e($AR_DT['transfer_id']),"trns_status"=>_e("R"),"action_request"=>"STS")); ?>"  onClick="return confirm('Make sure want to reject this withdrawal request')" class="label label-warning">Reject</a>
                            <?php } ?>
                          </td>
                          <!--<td data-title="Update Date"><?php echo DisplayDate($AR_DT['trns_date']); ?></td>-->
                           <td  data-title="Type"><?php echo $AR_DT['cryptoname'] ?></td>
                           <td  data-title="Type"><?php if($AR_DT['cryptoname']=='BTC'){ echo $AR_DT['btc_address']; }elseif($AR_DT['cryptoname']=='TRX'){ echo $AR_DT['trx_address']; }  elseif($AR_DT['cryptoname']=='USDT'){ echo $AR_DT['usdt_address']; }    else{ echo $AR_DT['eth_address']; } ?></td>
                         <!-- <td  data-title="Bank" align="center"><a href="javascript:void(0)" transfer_id="<?php echo _e($AR_DT['transfer_id']); ?>" class="label label-info "data-toggle="modal" data-target="#bank-details<?php echo $AR_DT['transfer_id'];?>" >Bank Detail</a></td>
                     -->   </tr>
                        <?php $Ctrl++; endforeach; ?>
                        <tr>
                          <!--<td colspan="13"><button type="submit" class="btn btn-success" name="confirmWithdraw" value="1" >Confirm</button>-->

                          <!--  <button type="submit" class="btn btn-danger" name="rejectWithdraw" value="1" >Reject</button></td>-->
                        </tr>
                        <?php  }else{ ?>
                        <tr>
                          <td colspan="12" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No withdrawals requests found</td>
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
        <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("transaction","withdrawals","");  ?>" method="post">
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
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">

	$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});

	$(function(){
		$("#form-page").validationEngine();
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		$(".enableText").on('dblclick',function(){
			$(this).attr("readonly",false);
		});
		$(".enableText").on('blur',function(){
			$(this).attr("readonly",true);
		});
		
		$(".updateWithdraw").on('change',function(){
			var transfer_id = $(this).attr("ref");
			var trns_amount = $(this).val();
			var URL_LOAD = "<?php echo generateSeoUrlAdmin("json","jsonhandler",""); ?>";
			$.getJSON(URL_LOAD,{switch_type:"WITHDRAW_AMOUNT",transfer_id:transfer_id,trns_amount:trns_amount},function(JsonEval){
				if(JsonEval){
					if(JsonEval.ErrorMsg){
						switch(JsonEval.ErrorMsg){
							case "success":
								alert("Withdraw amount updated successfully");
								return true;
							break;
							case "already":
								alert("Unable to update withdraw, this transaction is already completed");
								return true;
							break;
							default:
								alert("Failed ! unable to update withdraw amount");
								return false;
							break;
						}
					}
					
				}
			});
		});
		
		$(".open_bank_detail").on('click',function(){
			var transfer_id = $(this).attr("transfer_id");
			$("#transfer_id").val(transfer_id);
			if(transfer_id!=''){
				var URL_LOAD = "<?php echo generateSeoUrl("json","jsonhandler",""); ?>";
				$.getJSON(URL_LOAD,{switch_type:"BANK_TRANS",transfer_id:transfer_id},function(JsonEval){
					if(JsonEval){
						if(JsonEval.bank_tid>0){
							$("#bank_tid").val(JsonEval.bank_tid);
							$("#bank_trans_no").val(JsonEval.bank_trans_no);
							$("#bank_name").val(JsonEval.bank_name);
							$("#bank_account_no").val(JsonEval.bank_account_no);
							$("#bank_trans_detail").val(JsonEval.bank_trans_detail);
							$("#date_time").val(JsonEval.date_time);
							return true;
						}else{
							$("#bank_tid").val('');
							$("#bank_trans_no").val('');
							$("#bank_trans_detail").val('');
							$("#bank_name").val('');
							$("#bank_account_no").val('');
							$("#date_time").val('');
							return false;
						}
					}else{
						$("#bank_tid").val('');
						$("#bank_trans_no").val('');
						$("#bank_trans_detail").val('');
						$("#bank_name").val('');
						$("#bank_account_no").val('');
						$("#date_time").val('');
						return false;
					}
				});
			}
			$('#bank-modal').modal('show');
			 return false;
		});
		
	});
</script>
</body>
</html>
