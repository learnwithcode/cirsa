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
	$QR_PAGES="SELECT tcd.*, tm.user_id , CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name , tpt.pin_name,tm.count_directs
			   FROM ".prefix."tbl_cmsn_quick_performance AS tcd 
			   LEFT JOIN tbl_members AS tm ON tcd.member_id=tm.member_id
			   LEFT JOIN tbl_pintype AS tpt ON tpt.type_id=tcd.type_id
			   WHERE 1   $StrWhr ORDER BY tcd.daily_cmsn_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 200, $Page, $SrchQ);	
	
 ?>
     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>  
<script type="text/javascript">
    $(function(){
        $(".open_modal").on('click',function(){
            $('#search-modal').modal('show');
            return false;
        });
    });
</script>
<style>
   
.table td, .table th {
    padding: 5px;
}
</style>
 <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                  <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            <section class="tile">
 
                                <!-- tile body -->
                                <div class="tile-body table-custom">

                                    <div class="table-responsive">
                        <div class="col-sm-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Performance Bonus List</small>  </h4>
                        </div>
                             <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                    <a  href="<?php echo generateSeoUrlAdmin("excel","booster_list",""); ?>/<?php echo $process_id; ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

              <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr role="row">
                      <th  class="sorting">Date</th>
                      <th  class="sorting">Full Name</th>
                      <th  class="sorting">Username</th>
                    <!--  <th  class="sorting">Plan</th>
                      <th  class="sorting">Trns No </th>-->
                        <th>Total Turnover</th>
                      
                    
                     <th  class="sorting">Return (%) </th>
                      <th  class="sorting">Net Total</th>
                         <th>Total Direct</th>
                           <th>Self Business</th>
                              <th>Team Business</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
						if($PageVal['TotalRecords'] > 0){
						$Ctrl=1;
							foreach($PageVal['ResultSet'] as $AR_DT):
							$net_income_sum +=$AR_DT['net_income'];
						?>
                    <tr class="odd" role="row">
                      <td data-title="Date"><?php echo getDateFormat($AR_DT['cmsn_date'],"d M Y h:i"); ?></td>
                      <td data-title="Full Name"><?php echo $AR_DT['full_name']; ?></td>
                      <td data-title="Username"><?php echo $AR_DT['user_id']; ?></td>
                    <!--  <td data-title="Plan"><?php echo $AR_DT['pin_name']; ?></td>-->
                     <!-- <td data-title="Trns No"><?php echo $AR_DT['trans_no']; ?></td>-->
                     <td data-title="Amount"><?php echo CURRENCY; ?><?php echo $AR_DT['trans_amount']; ?></td>
                      <td data-title="Return (%)"><?php echo CURRENCY; ?><?php echo $AR_DT['daily_return']; ?> %</td>
                      <td data-title="Net Total"><?php echo CURRENCY; ?><?php echo $AR_DT['net_income']; ?></td>
                         <td data-title="Amount"><?php echo $AR_DT['count_directs']; ?></td>
                          <td data-title="Net Total"><?php echo CURRENCY; ?><?php echo $AR_DT['self']; ?></td>
                           <td data-title="Net Total"><?php echo CURRENCY; ?><?php echo $AR_DT['team']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr class="odd" role="row">
                      <td class="sorting_1">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <!--<td>&nbsp;</td>
                      <td>&nbsp;</td>-->
                      <td><strong>Sum Total </strong></td>
                      <td><strong><?php echo CURRENCY; ?><?php echo number_format($net_income_sum,2); ?></strong></td>
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
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
                        </div>
                        <!-- /col -->






                    </div>
                    <!-- /row -->
            </div>
         </div>

         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
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