<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}


if($_GET['status']!=''){
	$status = FCrtRplc($_GET['status']);
	$StrWhr .=" AND R.status='$status'";
	$SrchQ .="&status=$status";
}
else
{  
$status ='Success';
	$StrWhr .="and R.status ='Success'";
	$SrchQ .="&status=Success";
}

if($_GET['Beneficiary']!=''){
	$Beneficiary = FCrtRplc($_GET['Beneficiary']);
	$StrWhr .=" AND R.ben_id='$Beneficiary'";
	$SrchQ .="&Beneficiary=$Beneficiary";
}

if($_GET['user_id']!=''){
	$member_id = $model->getMemberId($_GET['user_id']);
	$StrWhr .=" AND R.member_id='$member_id'";
	$SrchQ .="&user_id=$user_id";
}
// SELECT SUM(`amount`) as total   FROM `tbl_recharge` WHERE   `status` =;
// SELECT SUM(`amount`) as total   FROM `tbl_recharge` WHERE   `status` ='FAILED';
// SELECT SUM(`amount`) as total   FROM `tbl_recharge` WHERE   `status` ='NULL';
 
 $success = $model->getDMTStatus('Success');
  $failed  = $model->getDMTStatus('Failure');
  $null = $model->getRechargeStatusNull();
  
  $charge = $model->getDMTStatuscharge('Success');
 
   $Rsuccess = $model->getRechargeStatus('SUCCESS');
   
$wallet_id=20;
  $LDGR = $model->getCurrentBalance(1,$wallet_id);
  $QR_PAGES= "SELECT R.*,M.first_name as name , M.user_id as uid   FROM `tbl_money_transfer` as R LEFT JOIN tbl_members as M on M.member_id = R.member_id WHERE  R.sender_id > 0 $StrWhr   order by  R.sender_id desc";
$PageVal = DisplayPages($QR_PAGES,50,$Page,$SrchQ); 

 
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
<script type="text/javascript">
	$(function(){
		$(".open_modal").on('click',function(){
			$('#search-modal').modal('show');
			return false;
		});
	});
</script>
<style type="text/css">
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
          <h1> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; View   DMT  Transaction </small> </h1>
          
          <div class="pull-right tableTools-container">
                      <div class="dt-buttons btn-overlap btn-group">
                          
                           <a  class="dt-button buttons-copy buttons-html5 btn btn-white btn-danger btn-bold  " href="<?php echo generateSeoUrlAdmin("financial","refunddmt",""); ?>" ><span><i class="fa fa-exchange bigger-110 pink"></i> <span class=" ">Refund</span></span></a>
                           <a  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold open_modal"><span><i class="fa fa-search bigger-110 pink"></i> <span class="hidden">Search</span></span></a>
                                               <a  href="<?php echo generateSeoUrlAdmin("excel","DmtStatus",""); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold">
<span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span>
</a>
                    
                      </div>
                      
                      
                      
                      
                      
                      
                    </div>
        </div>
        <!-- /.page-header -->
        <div class="row">
       
          <div class="col-xs-12">
            <div class="row">
                     
              
              
              
              <div class="clearfix">&nbsp;</div>
              
              
              <div class="clearfix">&nbsp;</div>
              <div class="col-xs-12">
                     <?php get_message(); ?>
                    <div class="table-header">Credit  Amount : <strong><?php echo number_format($LDGR['total_amount_cr'],2); ?></strong>   
           
           <!--Debit  Amount : <strong><?php echo number_format($LDGR['total_amount_dr'],2); ?></strong> || -->
 
 
 || Total DMT Success : <strong><?php echo number_format($success,2); ?></strong> 
 || Total Recharge Success : <strong><?php echo number_format($Rsuccess,2); ?></strong> 
 || Available Balance : <strong><?php echo number_format($LDGR['net_balance'],2); ?></strong>
 || Total Charge : <strong><?php echo number_format($charge,2); ?></strong>
 <!--|| Total Failed : <strong><?php echo number_format(($failed+$null),2); ?></strong>-->
 
 
  

 
 </div>
                <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                        
                             <th  class="center"> S.no </th>
                            <th  class="center"> Date </th>
                            <th >User ID </th>
                            <th>Trns No</th>
                            <th>Name</th>
                            <th>Number/A/c</th>
                            <th>Beneficiary Id/IFSC</th>
                            
                            <th >Amount</th>
                             <th >Charge</th>
                              <th >Total</th>
                            <th >Status</th>  
                            <!--<th >Action</th>-->
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;//PrintR($PageVal['ResultSet'] );die;
						foreach($PageVal['ResultSet'] as $AR_DT):   //
						
			       ?>
                    <tr <?php if($AR_DT['status']=='Success'){echo 'class="success"';}else{ echo 'class="danger"';}?>>
                        <td data-title="Date"><?php echo $Ctrl; ?></td>
                      <td data-title="Date"><?php echo date('d-M-Y H:i:s',strtotime($AR_DT['date'])); ?></td>
                      <td data-title="User Id"><?php echo strtoupper($AR_DT['uid']); ?></td>
                        <td data-title="Trns Id"><?php echo strtoupper($AR_DT['orderid']); ?></td>
                      <td data-title="Name"><?php echo ($AR_DT['type'] =='1')?strtoupper($AR_DT['name']):strtoupper($AR_DT['ben_name']); ?> </td>
                       
                      
                      
                      
                        <td data-title="Number"><?php echo ($AR_DT['type'] =='1')? ($AR_DT['mobile']): ($AR_DT['account_number']);?> </td>
                    <td data-title="Beneficiary Id"><?php echo ($AR_DT['type'] =='1')? ($AR_DT['ben_id']):strtoupper($AR_DT['ifsc_code']); ?> </td>
                    
                       <td data-title="Amount"><?php echo number_format($AR_DT['amount'],2); ?></td>
                       <td data-title="Charge"><?php echo number_format($AR_DT['charge'],2); ?></td>
                       <td data-title="Total"><?php echo number_format($AR_DT['total'],2); ?></td>
                      
                      <td data-title="Status"> <?php echo strtoupper($AR_DT['status']); ?>  </td>
                    <!--   <td data-title="Action">
                        <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>
                           <ul class="dropdown-menu dropdown-default">
                             
                            <?php if($AR_DT['manage_status'] =='N'){ ?>
                             <li><a href="<?php echo BASE_PATH;?>superadmin/financial/manageDMT/<?php echo  $AR_DT['sender_id']; ?>" target="_blank">Manage DMT</a> </li>
                            <?php } ?>
                            
                           </ul>
                          </div>
                        
                         </td>-->
                    </tr>
                    <?php $Ctrl++; 
						endforeach; 
						}else{ ?>
                    <tr>
                      <td colspan="10" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No transaction found</td>
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
  <div id="search-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="smaller lighter blue no-margin">Search</h3>
        </div>
        <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."financial/DmtStatus"; ?>" autocomplete="off" method="get">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> User Id  :</label>
              <div class="col-sm-7">
                <input id="form-field-17" placeholder="User ID" name="user_id"   class="col-xs-10 col-sm-12  " type="text" value="<?php echo $_GET['user_id']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> A/c  No  :</label>
              <div class="col-sm-7">
                <input id="form-field-16" placeholder="A/c No" name="Beneficiary"  class="col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['Beneficiary']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Select Status :</label>
              <div class="col-sm-7">
               <select name="status" class="col-xs-12 col-sm-6   form-control" id="status">
                    <option value="">All </option>

                     <option value="Success" <?php if($_GET['status']=='Success'){ echo 'selected';}?>>Success</option>
                      <option value="Failure" <?php if($_GET['status']=='Failure'){ echo 'selected';}?>>Failed</option>
                       
                  </select>
              </div>
            </div>
           
             
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
            <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a>
</div>
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
	$(function(){
		$("#form-valid").validationEngine();
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		
	});
</script>
</body>
</html>
