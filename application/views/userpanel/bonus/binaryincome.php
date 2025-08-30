<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcb.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT tcb.* , tpt.prod_pv, tpt.pin_name, tp.start_date, tp.end_date
			   FROM ".prefix."tbl_cmsn_binary AS tcb 
			   LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcb.member_id
			   LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
			   LEFT JOIN ".prefix."tbl_process AS tp ON tp.process_id=tcb.process_id
			   WHERE tcb.member_id='".$member_id."' $StrWhr ORDER BY tp.date_time DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
	$QR_SUM = "SELECT SUM(tcb.net_cmsn) AS net_sum_cmsn 
			 FROM ".prefix."tbl_cmsn_binary AS tcb 
			 WHERE tcb.member_id='".$member_id."' $StrWhr ORDER BY tcb.binary_id DESC";
	$AR_SUM = $this->SqlModel->runQuery($QR_SUM,true);
	
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
            <li class="active"> Binary Income </li>
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
						
						
                      <h2>Matching Income</h2>
                      <br>
                      <div class="actions">
					  	<div class="row">
							<div class="col-md-4">
								<form id="form-search" name="form-search" method="get" action="<?php echo generateMemberForm("bonus","binaryincome",""); ?>">
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
								  <a href="<?php  echo generateSeoUrlMember("bonus","binaryincome",array()); ?>" class="btn btn-sm btn-default m-t-n-xs" value=" Reset ">Reset</a>
								</form>
							</div>
						</div>
                      </div>
                      <br>
                      <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="wallet_deposit_wrapper">
                        
                        <div class="row">
							<div class="col-md-12">
							  	<div class="col-md-8">
									&nbsp;
								</div>
								<div class="col-md-4 pull-right">
									<h4>Binary Income : <strong><?php echo number_format($AR_SUM['net_sum_cmsn'],2); ?></strong></h4>
								</div>
							  </div>
                          <div class="col-sm-12">
                            <table aria-describedby="wallet_deposit_info" role="grid" id="wallet_deposit" class="table table-striped table-bordered table-hover dataTable no-footer">
                              <thead>
                                <tr role="row">
                                  <th  class="sorting_desc">Process Week</th>
                                  <th  class="sorting">Plan</th>
                                  <th  class="sorting">Ceiling</th>
                                  <th  class="sorting">Pre Left Carry </th>
                                  <th  class="sorting">Pre Right Carry </th>
                                  <th  class="sorting">Left<br /> 
                                    Collection </th>
                                  <th  class="sorting">Right <br />
                                    Collection </th>
                                  <th  class="sorting">Matching</th>
                                  <th class="sorting"><span class="sorting" style="width: 526px;">Left <br />
                                    Carry Forward </span></th>
                                  <th  class="sorting">Right <br />
                                    Carry Forward </th>
                                  <th  class="sorting">Binary %</th>
                                  <th  class="sorting">Net Income </th>
                                  <th  class="sorting">Status</th>
                                  <th  class="sorting">&nbsp;</th>
                                </tr>
                              </thead>
                              <tbody>
								<?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									$package_ceiling = ($AR_DT['prod_pv']*7);
									$ceiling_max_limit = 35000;
									$binary_ceiling = ($package_ceiling<=$ceiling_max_limit)? $package_ceiling:$ceiling_max_limit;
								?>
                                <tr class="odd" role="row" title="<?php echo $AR_DT['binary_narration']; ?>">
                                  <td class="sorting_1"><?php echo DisplayDate($AR_DT['start_date'])."&nbsp;To&nbsp;".DisplayDate($AR_DT['end_date']); ?></td>
                                  <td><?php echo $AR_DT['pin_name']; ?></td>
                                  <td><?php echo $binary_ceiling; ?></td>
                                  <td><?php echo $AR_DT['preLcrf']; ?></td>
                                  <td><?php echo $AR_DT['preRcrf']; ?></td>
                                  <td><?php echo $AR_DT['newLft']; ?></td>
                                  <td><?php echo $AR_DT['newRgt']; ?></td>
                                  <td><?php echo $AR_DT['pair_match']; ?></td>
                                  <td><?php echo $AR_DT['leftCrf']; ?></td>
                                  <td><?php echo $AR_DT['rightCrf']; ?></td>
                                  <td><?php echo $AR_DT['binary_rate']; ?></td>
                                  <td title="<?php echo $AR_DT['binary_narration']; ?>"><?php echo $AR_DT['amount']; ?></td>
                                  <td title="<?php echo $AR_DT['binary_narration']; ?>"><?php echo $AR_DT['binary_narration']; ?></td>
                                  <td ><a class="label label-danger" href="<?php echo generateSeoUrlMember("bonus","binaryincomedetail",array("process_id"=>_e($AR_DT['process_id']))); ?>">View</a></td>
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
        <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
      <!-- /.content -->
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
