<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

	
  $targetId = $this->uri->segment(4);
  $tid = _d($targetId);
	
	$QR_SUM = "SELECT * FROM tbl_target WHERE target_id='$tid'";
	$AR_SUM = $this->SqlModel->runQuery($QR_SUM,true);
	
 
 
 
	$QR_PAGES= "SELECT * FROM tbl_target_type where target_id = '$tid'";
	$PageVal = DisplayPages($QR_PAGES, 100, $Page, $SrchQ);	
	///echo "<pre>";print_r($PageVal);die('testing');
	//$QR_SUM = "SELECT SUM(tcd.net_income) AS net_income FROM tbl_cmsn_direct AS tcd WHERE 1 $StrWhr ORDER BY tcd.direct_id DESC";
	//$AR_SUM = $this->SqlModel->runQuery($QR_SUM,true);
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
        <h1> Reward <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;Target View </small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
        <?php get_message(); ?>
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-12" style="min-height:500px;">
              <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
<a  href="<?php echo generateSeoUrlAdmin("reward","targetview/".$targetId,""); ?>" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-print btn btn-white btn-danger btn-bold"><span><i class="fa fa-arrow-circle-o-left bigger-110 grey"></i> Back  </span></a>	

<?php $curr_date = date('Y-m-d');
      $fd = $AR_SUM['fdate'];
	  $ed = $AR_SUM['edate'];
	  if($curr_date >= $fd && $curr_date <= $ed){ ?>		  
<a  href="<?php echo generateSeoUrlAdmin("reward","updatetype/".$targetId,""); ?>" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-print btn btn-white btn-primary btn-bold"><span> Add New  <i class="fa fa-plus bigger-110 grey"></i></span></a>
<?php } ?>
				   </div>
                </div>
              </div>
              
             <div class="clearfix"></div>
			  </br>
			  </br>
              <!-- div.table-responsive -->
              <!-- div.dataTables_borderWrap -->
              <div>
                <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr role="row">
                      <th  class="sorting">Sr. No </th>
                     
                      <th  class="sorting">Type Name</th>
					  <th  class="sorting">Designation</th>
					  <th  class="sorting">Type </th>
					  <th  class="sorting">Point</th>
                      <th  class="sorting">From Date </th>
					  <th  class="sorting">End Date </th>
                      <th  class="sorting">Created Date  </th>
                      <th  class="sorting">Status</th>
                      <th  class="sorting">Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
					$curr_date = date('Y-m-d');
						if($PageVal['TotalRecords'] > 0){
						    if($Page > 1)
						    {
						        $Page = ($Page -1)* 50 +1;
						    }
						    
						$Ctrl=$Page;
							foreach($PageVal['ResultSet'] as $AR_DT):
						
					$deg = $AR_DT['designation'];
					if($deg =='0'){$designation ='Fresher';}
					elseif($deg =='1'){$designation ='Silver';}
					elseif($deg =='2'){$designation ='Gold';}
					elseif($deg =='3'){$designation ='Pearl';}
					elseif($deg =='4'){$designation ='Topaz';}		  
					elseif($deg =='5'){$designation ='Emerald';}
					elseif($deg =='6'){$designation ='Ruby';}
					elseif($deg =='7'){$designation ='Diamond';}	  
							 
							
						?>
                    <tr class="odd" role="row">
                      <td data-title="Sr. No"><?php echo $Ctrl; ?></td>
					  <td data-title="Type Name"><?php echo $AR_DT['type_name']; ?></td>
					   <td data-title="Designation"><?php echo $designation; ?></td>
					  <td data-title="Type"><?php echo ($AR_DT['type']=='D')?'Direct':'Pair'; ?></td>
					   <td data-title="Point"><?php echo $AR_DT['point']; ?></td>
					  <td data-title="From Date"><?php echo date('d-m-Y',strtotime($AR_DT['fdate'])); ?></td>
					  <td data-title="To Date"><?php echo date('d-m-Y',strtotime($AR_DT['edate'])); ?></td>
					  <td data-title="Created Date"><?php echo date('d-m-Y',strtotime($AR_DT['cdate'])); ?></td>
					  <td data-title="Status"> <?php if($curr_date > $AR_DT['fdate'] && $curr_date > $AR_DT['edate']){ ?>
					  <span class="label label-danger arrowed-in">Closed</span>
					  <?php } elseif($curr_date >= $AR_DT['fdate'] and $curr_date <= $AR_DT['edate']) {  ?>
					   <span class="label label-success arrowed-in">Open</span>
					  <?php }  ?></td>
                      <td data-title="Action">
					  <?php if($curr_date > $AR_DT['fdate'] && $curr_date > $AR_DT['edate']){ ?>
					 <a href="<?php echo generateSeoUrlAdmin("reward","achivers?type_id=".$AR_DT['type_id'],""); ?>">View</a>
					  <?php } elseif($curr_date >= $AR_DT['fdate'] and $curr_date <= $AR_DT['edate']) {  ?>
					 <a href="javascript:void(0);" onClick="alert('You can not open between target dates !');">View</a>
					  <?php }  ?>
					  
					  
					  </td>
                     
                  
                    </tr>
                    <?php $Ctrl++; endforeach;
						}
						else{
						 ?>
						 <tr>
						 <td colspan='7' align="center">No data found ...</td>
						 </tr>
						 <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="clearfix">&nbsp;</div>
          <div class="row">
            <div class="col-xs-6">
              <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries </div>
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
