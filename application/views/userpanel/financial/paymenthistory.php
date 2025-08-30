<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$wallet_id = $model->getWallet(WALLET1);
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcp.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT tcp.*
			FROM ".prefix."tbl_coin_payment AS tcp 
			LEFT JOIN tbl_members AS tm ON tm.member_id=tcp.member_id
			WHERE (tcp.member_id='".$member_id."')
			$StrWhr 
			ORDER BY tcp.coinpay_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<style type="text/css">
	span.title {
		display: block;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
		font-weight: 600;
		font-size: 12px;
		color: #fff;
		letter-spacing: 12px;
		padding-left: 10px;
	}
	.minheight{
		min-height:1200px;
	}
</style>
</head>
<body>
<div class="site-holder">
  <!-- .navbar -->
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
  <!-- /.navbar -->
  <div class="box-holder">
    <!-- .left-sidebar -->
    <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    <!-- /.left-sidebar -->
    <!-- .content -->
    <div class="content">
      <div class="row">
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>"> Home </a></li>
            <li class="active"> Payment </li>
          </ul>
        </div>
      </div>
      <div class="price-list row">
        <!-- Accordians -->
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
						
						
                      <h2>Payment History</h2>
                      <br>
                      <div class="actions">
					  	<div class="row">
							 <div class="col-md-4">
								<form id="form-search" name="form-search" method="get" action="<?php echo generateMemberForm("financial","viewtransaction",""); ?>">
								  <b>Date from </b>
								  <div class="input-group">
					 	<input class="form-control validate[required] date-picker" name="from_date" id="from_date" value="<?php echo $_REQUEST['from_date']; ?>" type="text"  />
									 <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
								  &nbsp;&nbsp; <b>To</b>
								  <div class="input-group">
	 		<input class="form-control  validate[required] date-picker" name="to_date" id="to_date" value="<?php echo $_REQUEST['to_date']; ?>" type="text"  />
									 <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
								 <div class="clearfix">&nbsp;</div>
								  <input class="btn btn-sm btn-primary m-t-n-xs" value=" Search " type="submit">
								  <a href="<?php  echo generateSeoUrlMember("financial","paymenthistory",array()); ?>" class="btn btn-sm btn-default m-t-n-xs" value=" Reset ">Reset</a>
								</form>
							</div>
						  </div>
                      </div>
                       <div class="clearfix">&nbsp;</div>
                      <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="wallet_deposit_wrapper">
                        
                        <div class="row">
                          <div class="col-sm-12">
                            <table  id="wallet_deposit" class="table table-striped table-bordered table-hover dataTable no-footer">
                              <thead>
                                <tr role="row">
                                  <th >Srl No </th>
                                  <th >Order</th>
                                  <th >Transaction No </th>
                                  <th>Date</th>
                                  <th>Amount</th>
                                  <th>Status</th>
                                </tr>
                              </thead>
                              <tbody>
								<?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=1;
								foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                <tr class="odd" role="row">
                                  <td class="sorting_1"><?php echo $Ctrl; ?></td>
                                  <td class="sorting_1"><?php echo $AR_DT['order_no']; ?></td>
                                  <td class="sorting_1"><?php echo $AR_DT['transaction']; ?></td>
                                  <td class="sorting_1"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                  <td><?php echo number_format($AR_DT['deposit_amount'],2); ?></td>
                                  <td><?php echo ($AR_DT['coinpay_sts']=="P")? "Pending":$AR_DT['coinpay_sts']; ?></td>
                                </tr>
                                <?php 
								endforeach;
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
        <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
      
    </div>
  </div>
</div>
 
</body>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
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
