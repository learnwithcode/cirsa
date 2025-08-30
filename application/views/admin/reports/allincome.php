<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcm.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	if($_REQUEST['user_id']!=''){
		$member_id = $model->getMemberId($_REQUEST['user_id']);
		$StrWhr .=" AND tmt.member_id='$member_id'";
		$SrchQ .="&user_id=$user_id";
	}
	
	$QR_PAGES="SELECT tcm.*, tm.user_id FROM ".prefix."tbl_cmsn_mstr AS tcm
			LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcm.member_id
	    	WHERE 1 $StrWhr ORDER BY tcm.master_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
	$QR_SUM = "SELECT SUM(tcm.net_income) AS net_income FROM tbl_cmsn_mstr AS tcm WHERE tcm.member_id='".$member_id."' $StrWhr ORDER BY tcm.master_id DESC";
	$AR_SUM = $this->SqlModel->runQuery($QR_SUM,true);
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
        <h1> Bonus <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;All Income </small> </h1>
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
                    <a  href="<?php echo generateSeoUrlAdmin("excel","allincome",""); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> <a aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-pdf buttons-flash btn btn-white btn-primary btn-bold"><span><i class="fa fa-file-pdf-o bigger-110 red"></i> <span class="hidden">Export to PDF</span></span> </a> <a  onClick="window.print()" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-print btn btn-white btn-primary btn-bold"><span><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></span></a> </div>
                </div>
              </div>
              <form action="<?php echo ADMIN_PATH."bonus/allincome"; ?>" method="post" name="form-search" id="form-search">
                <div class="form-group">
                  <div class="col-sm-3">
                    <input id="form-field-1" placeholder="Member ID" name="user_id"  class="col-xs-10 col-sm-12 validate[required]" type="text" value="<?php echo $ROW['user_id']; ?>">
                  </div>
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-sm btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
                  </div>
                </div>
              </form>
              <br>
              <br>
              <!-- div.table-responsive -->
              <!-- div.dataTables_borderWrap -->
              <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr role="row">
                      <th  class="sorting_desc">Process</th>
                      <th  class="sorting">Member </th>
                      <th  class="sorting">Binary Income </th>
                      <th  class="sorting">Direct Income </th>
                      <th  class="sorting">Total Income </th>
                      <th  class="sorting">Admin Charge </th>
                      <th  class="sorting">Net Income </th>
                      <th  class="sorting">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                    <tr class="odd" role="row">
                      <td class="sorting_1"><?php echo $AR_DT['process_id']; ?></td>
                      <td><?php echo $AR_DT['user_id']; ?></td>
                      <td><?php echo $AR_DT['binary_income']; ?></td>
                      <td><?php echo $AR_DT['direct_income']; ?></td>
                      <td><?php echo $AR_DT['total_income']; ?></td>
                      <td><?php echo $AR_DT['admin_charge']; ?></td>
                      <td><?php echo $AR_DT['net_income']; ?></td>
                      <td><a onClick="return confirm('Make sure , you want to update this commission?')" href="<?php echo generateSeoUrlAdmin("bonus","allincome",array("master_id"=>_e($AR_DT['master_id']),"action_request"=>"PAY_STS","pay_sts"=>$AR_DT['pay_sts'])); ?>"><?php echo ($AR_DT['pay_sts']=="N")? "Un-Piad":"Paid"; ?></a> &nbsp; &nbsp;
					  <?php if($AR_DT['pay_sts']=="Y"){ ?>
					  [<?php echo getDateFormat($AR_DT['date_time'],"d-D M Y, G:i"); ?>]
					  <?php } ?>
					  </td>
                    </tr>
                    <?php endforeach;
								}
								 ?>
                  </tbody>
                </table>
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
<div id="advert-view" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="smaller lighter blue no-margin">Advrt Management</h3>
      </div>
      <div class="modal-body" id="load_content"> </div>
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
