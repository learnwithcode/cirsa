<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcd.cmsn_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT tcd.*, tm.user_id FROM ".prefix."tbl_cmsn_singleline AS tcd 
			  LEFT JOIN tbl_members AS tm ON tcd.from_member_id = tm.member_id
				  WHERE tcd.member_id='".$member_id."' $StrWhr ORDER BY tcd.single_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
	
?>











<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

<div class="main-content">
<div class="main-content-inner">


<div class="page-content">

<div class="row">
<div class="col-xs-12">
<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>								

<div class="row">
<div class="col-xs-12">
<h3 class="header smaller lighter blue">Single Line Income</h3>

<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>


				 
<div class="table-header">
Referral ROI Income Report								</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
 
<div class="widget-body">
                <div class="panel-body list">
                  <div class="table-responsive project-list">
                    <table class="table table-striped">
                    <thead>
                                    <tr>
                                      <th  class="sorting">Sr. No </th>
                                      <th  class="sorting">Date</th>
                                      <th  class="sorting">From User Id</th>
                                      <th  class="sorting">Total Amount</th>
                                    
                                      <th  class="sorting">Net Income </th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl= $PageVal['RecordStart']+1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                    <tr class="odd" role="row">
                                      <td class="sorting_1"><?php echo $Ctrl; ?></td>
                                      <td class="sorting_1"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                      <td ><?php echo $AR_DT['user_id']; ?></td>
                                      <td><?php echo number_format($AR_DT['total_collection'],2); ?></td>
                                     
                                      <td><?php echo number_format($AR_DT['net_income'],2); ?></td>
                                     
                                    </tr>
                                    <?php $Ctrl++; endforeach;
									}else{
									?>
                                    <tr class="odd" role="row">
                                      <td colspan="5">No transaction found</td>
                                    </tr>
                                    <?php 
									}
								 ?>
                                  </tbody>
                    </table>
                  </div>
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
<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->
</div>
</div>
</div>
</div>
</div>
</div>
 
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
<script src="<?php echo BASE_PATH;?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.flash.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.html5.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.print.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.colVis.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/dataTables.select.min.js"></script>

<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>

<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<!-- inline scripts related to this page -->
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
</body>
</html>


