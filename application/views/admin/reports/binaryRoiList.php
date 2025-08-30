<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$segment = $this->uri->uri_to_assoc(2);
	$process_id = $_GET['process_id'];
	$daily_cmsn_id = (_d($segment['daily_cmsn_id'])>0)? _d($segment['daily_cmsn_id']):_d($_REQUEST['daily_cmsn_id']);
	if($daily_cmsn_id>0){
	$AR_CMSN = $model->getCmsnDaily($daily_cmsn_id);
		$cmsn_date = InsertDate($AR_CMSN['cmsn_date']);
		$type_id = ($AR_CMSN['type_id']);
		$StrWhr .=" AND DATE(tcd.cmsn_date)='".$cmsn_date."' AND tcd.type_id='".$type_id."'";
		$SrchQ .="&daily_cmsn_id="._e($daily_cmsn_id)."";
	}
	
	if($_REQUEST['type_id']>0){
		$type_id = FCrtRplc($_REQUEST['type_id']);
		$StrWhr .=" AND tcd.type_id='".$type_id."'";
		$SrchQ .="&type_id=$type_id";
	}
	
	
	if($_REQUEST['cmsn_date']!=''){
		$cmsn_date = InsertDate($_REQUEST['cmsn_date']);
		$StrWhr .=" AND DATE(tcd.cmsn_date)='".$cmsn_date."'";
		$SrchQ .="&cmsn_date=$cmsn_date";
	}
	
	if($_REQUEST['user_id']!=''){
		$member_id = $model->getMemberId($_REQUEST['user_id']);
		$StrWhr .=" AND tcd.member_id='$member_id'";
		$SrchQ .="&user_id=$user_id";
	}
	
	if(_d($_REQUEST['member_id'])>0){
		$member_id = _d($_REQUEST['member_id']);
		$StrWhr .=" AND tcd.member_id='$member_id'";
		$SrchQ .="&member_id=$member_id";
	}
	
	if(_d($_REQUEST['subcription_id'])>0){
		$subcription_id = _d($_REQUEST['subcription_id']);
		$StrWhr .=" AND tcd.subcription_id='$subcription_id'";
		$SrchQ .="&subcription_id=$subcription_id";
	}
		if($_GET['process_id'] !='')
	{
	    $processId = $_GET['process_id'];
	 	$StrWhr .="  AND tcd.process_id='$processId'";
	    
	}
	$QR_PAGES="SELECT tcd.*, tm.user_id , CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name  
			   FROM ".prefix."tbl_cmsn_binary_R AS tcd 
			   LEFT JOIN tbl_members AS tm ON tcd.member_id=tm.member_id
		 
			   WHERE 1   $StrWhr ORDER BY tcd.id DESC";
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
        <h1> Bonus <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;Binary Return (ROI) </small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
        <?php get_message(); ?>
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-12" style="min-height:500px;">
             <!-- <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> <a  href="<?php echo generateSeoUrlAdmin("excel","dailyincome",""); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> <a aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-pdf buttons-flash btn btn-white btn-primary btn-bold"><span><i class="fa fa-file-pdf-o bigger-110 red"></i> <span class="hidden">Export to PDF</span></span> </a> <a  onClick="window.print()" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-print btn btn-white btn-primary btn-bold"><span><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></span></a> </div>
                </div>
              </div>
              <form action="<?php echo generateAdminForm("bonus","dailyincome","");  ?>" method="post" name="form-search" id="form-search">
                <div class="form-group">
                  <div class="col-sm-3">
                    <select  name="type_id" id="type_id" class="col-xs-12 col-sm-12 validate[required] member_select">
                      <option value="">Select Pin</option>
                      <?php echo DisplayCombo($_REQUEST['type_id'],"PIN_TYPE"); ?>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <div class="input-group">
                      <input class="form-control col-xs-3 col-sm-3  date-picker" name="cmsn_date" id="cmsn_date" value="<?php echo $_REQUEST['cmsn_date']; ?>" type="text"  />
                      <span class="input-group-addon"> <i class="fa fa-calendar"></i></span></div>
                  </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-sm btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
                    <button  class="btn btn-sm btn-danger" type="button" onClick="window.location.href='<?php echo generateSeoUrlAdmin("bonus","dailyincome",array("")); ?>'"> <i class="ace-icon fa fa-refresh"></i> Cancel </button>
                  </div>
                </div>
              </form> -->
              <br>
              <br>
              <!-- div.table-responsive -->
              <!-- div.dataTables_borderWrap -->
              <div>
                <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr role="row">
                      <th  class="sorting">#</th>   
                      <th  class="sorting">Date</th>
                      <th  class="sorting">Full Name</th>
                      <th  class="sorting">Username</th>
                  
                  
             
                      <th  class="sorting">Net USD</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
						if($PageVal['TotalRecords'] > 0){
						$Ctrl= $PageVal['RecordStart']+1;
							foreach($PageVal['ResultSet'] as $AR_DT):
							$net_income_sum +=$AR_DT['net_income'];
						?>
                    <tr class="odd" role="row">
                        
                         <td data-title="Net Total"><?php echo $Ctrl; $Ctrl++; ?></td>
                      <td data-title="Date"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                      <td data-title="Full Name"><?php echo $AR_DT['full_name']; ?></td>
                      <td data-title="Username"><?php echo $AR_DT['user_id']; ?></td> 
                      <td data-title="Net Total"><?php echo $AR_DT['net_income']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr class="odd" role="row">
                      <td class="sorting_1">&nbsp;</td>
                      <td>&nbsp;</td>
                    
                       <td>&nbsp;</td>
                    
                      <td><strong>Sum Total </strong></td>
                      <td><strong><?php echo number_format($net_income_sum,2); ?></strong></td>
                    </tr>
                    <?php }else{ ?>
                    <tr class="odd" role="row">
                      <td colspan="8" class="text-danger">No record found </td>
                    </tr>
                    <?php
						}
						 ?>
                  </tbody>
                </table>
              </div>
            </div>
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
