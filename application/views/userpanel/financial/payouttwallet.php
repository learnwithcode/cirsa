<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$wallet_id = $model->getDepositWallet("Payout Wallet");
	$member_id = $this->session->userdata('mem_id');
	
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
	
	$QR_PAGES="SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt WHERE twt.member_id='".$member_id."' AND  twt.wallet_id='".$wallet_id."' $StrWhr 
	ORDER BY twt.wallet_trns_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datetimepicker.min.css" />
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
<div class="clearfix"> </div>
<div class="page-container">
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
  <div class="page-content-wrapper">
    <div class="page-content">
      <ul class="page-breadcrumb breadcrumb">
			<li><a href="javascript:void(0)">Financial</a><i class="fa fa-circle"></i></li>
			<li><span class="active">Payout</span></li>
		</ul>
      <div class="row">
        <div class="col-md-12">
		<?php echo get_message(); ?>
          <div class="portlet light bordered">
            <div class="panel-body"> 
            <div class="main pagesize">
              <!-- *** mainpage layout *** -->
              <div class="main-wrap">
                <div class="content-box">
                  <div class="box-body">
                    <div class="box-wrap clear">
                    
                      <h2>Payout Wallet </h2>
                      <br>
                      <div class="actions">
                        <form id="form1" name="form1" method="post" action="">
                          <b>Date from </b>
                          <div class="input-group">
                  			<input class="form-control validate[required] date-picker" name="from_date" id="from_date" value="<?php echo $_REQUEST['from_date']; ?>" type="text"  />
                 			 <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
                          &nbsp;&nbsp; <b>To</b>
                          <div class="input-group">
                  			<input class="form-control  validate[required] date-picker" name="to_date" id="to_date" value="<?php echo $_REQUEST['to_date']; ?>" type="text"  />
                 			 <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
                          &nbsp;&nbsp;<br>
                          <input class="btn btn-sm btn-primary m-t-n-xs" value=" Search " type="submit">
                        </form>
                      </div>
                      <br>
                      <h4>Current Balance: <strong><?php echo number_format($LDGR['net_balance']); ?></strong></h4>
                      <br>
                      <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="wallet_deposit_wrapper">
                        
                        <div class="row">
                          <div class="col-sm-12">
                            <table aria-describedby="wallet_deposit_info" role="grid" id="wallet_deposit" class="table table-striped table-bordered table-hover dataTable no-footer">
                              <thead>
                                <tr role="row">
                                  <th aria-label="Date: activate to sort column ascending" aria-sort="descending" style="width: 255px;" colspan="1" rowspan="1" aria-controls="wallet_deposit" tabindex="0" class="sorting_desc">Date</th>
                                  <th aria-label="Amount: activate to sort column ascending" style="width: 180px;" colspan="1" rowspan="1" aria-controls="wallet_deposit" tabindex="0" class="sorting">Amount</th>
                                  <th aria-label="Description: activate to sort column ascending" style="width: 526px;" colspan="1" rowspan="1" aria-controls="wallet_deposit" tabindex="0" class="sorting">Description</th>
                                </tr>
                              </thead>
                              <tbody>
								<?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                <tr class="odd" role="row">
                                  <td class="sorting_1"><?php echo getDateFormat($AR_DT['trns_date'],"d M Y h:i"); ?></td>
                                  <td><?php echo $AR_DT['trns_amount']; ?></td>
                                  <td><?php echo $AR_DT['trns_remark']; ?></td>
                                </tr>
                                <?php endforeach;
								}
								 ?>
                              </tbody>
                            </table>
                          </div>
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
                  </div>
                  <!-- end of box-wrap -->
                </div>
                <!-- end of box-body -->
              </div>
            </div>
          </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
</body>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
</html>
