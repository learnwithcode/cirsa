<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

$wallet_id = $model->getWallet(WALLET1);
if($_REQUEST['user_id']!=''){
	$member_id = $model->getMemberId($_REQUEST['user_id']);
	$StrWhr .=" AND tmt.member_id='$member_id'";
	$SrchQ .="&user_id=$user_id";
}

$QR_PAGES="SELECT tft.*, tmf.first_name AS from_first_name, tmf.last_name AS from_last_name, tmf.user_id  AS from_user_id, 
		                 tmt.first_name AS to_first_name, tmt.last_name AS to_last_name, tmt.user_id  AS to_user_id
						 FROM ".prefix."tbl_fund_transfer AS tft 
		 				 LEFT JOIN tbl_members AS tmf ON tmf.member_id=tft.from_member_id	
						 LEFT JOIN tbl_members AS tmt ON tmt.member_id=tft.to_member_id	
 		                 WHERE tft.transfer_id>0  AND tft.wallet_id='".$wallet_id."'
						 $StrWhr 
						 ORDER BY tft.transfer_id DESC";
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
          <h1> E-Wallet <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; HYIP Wallet </small> </h1>
        </div>
        <!-- /.page-header -->
        <div class="row">
          <?php get_message(); ?>
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-12" style="min-height:500px;">
                <form action="<?php echo ADMIN_PATH."financial/viewtransactions"; ?>" method="post" name="form-search" id="form-search">
                  <div class="form-group">
                    <div class="col-sm-3">
                      <input id="form-field-1" placeholder="Member ID" name="user_id"  class="col-xs-10 col-sm-12 validate[required]" type="text" value="<?php echo $_REQUEST['user_id']; ?>">
                    </div>
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-sm btn-success"> <i class="ace-icon fa fa-check"></i> Apply </button>
                      <button onClick="window.location.href=''" type="button" class="btn btn-sm btn-danger"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
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
                      <tr>
                        <th width="95" class="center"> <label class="pos-rel"> Date <span class="lbl"></span> </label>
                        </th>
                        <th width="186">Amount</th>
                        <th width="149">Trans Type </th>
                        <th width="100">Member </th>
                        <th width="111">Description</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
                      <tr>
                        <td class="center"><label class="pos-rel"> <?php echo $AR_DT['trns_date']; ?> <span class="lbl"></span> </label>
                        </td>
                        <td><?php echo $AR_DT['trns_amount']; ?> &nbsp;&nbsp;(<?php echo CURRENCY; ?>)</td>
                        <td><?php echo $AR_DT['trns_for']; ?></td>
                        <td><?php echo $AR_DT['to_first_name']; ?> &nbsp; [<?php echo $AR_DT['to_user_id']; ?>]</td>
                        <td><?php echo $AR_DT['trns_remark']; ?></td>
                      </tr>
                      <?php $Ctrl++; endforeach; }else{ ?>
                      <tr>
                        <td colspan="5" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No transaction found</td>
                      </tr>
                      <?php } ?>
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
