<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	$wallet_id=1;
	$QR_PAGES="SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			   WHERE 1 AND twt.wallet_id='".$wallet_id."' and trns_for ='Pool'
			   $StrWhr 
			   ORDER BY twt.wallet_trns_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
 
	
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Pool Bonus </small>  </h4>
                        </div>
                           <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                    <a  href="<?php echo generateSeoUrlAdmin("excel","timer_pool",""); ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

              <table class="table table-striped">
<thead>
                      <tr>
                          <th>Sn.</th>
                          <th>Date</th>
                          <th>Slot</th>
                          <th>Member Id </th>
                           <th>Package</th>
                          <!--<th>Amount</th>-->
                         <!-- <th>Admin Charge</th>
                          <th>TDS</th>
                          <th>Repurchase Detection</th>-->
                          <th>Net Income</th>
                        </tr>
                    </thead>
                           
                                  <tbody>
						           <?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=$PageVal['RecordStart']+1;
							//	echo "<pre>";print_r($PageVal['ResultSet']);die;
									foreach($PageVal['ResultSet'] as $AR_DT):
									    $memberList = $model->getMemberdetail($AR_DT['member_id']);
									   $memuserid= $memberList['user_id'];
								?>
                                <tr class="odd" role="row">
                                    <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                                      <td class=""><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                         <td><span class="btn btn-success arrowed"><?php echo $AR_DT['trns_remark']; ?></span> </td>
                                          <td><?php echo $memuserid; ?></td>
                                     
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['trns_amount'],2); ?></td>
                                      <!--<td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['admin_charge'],2); ?></td>
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['tds'],2); ?></td>
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['repurchase_detection'],2); ?></td>-->
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['net_income'],2); ?></td>
                                  </tr>
                             
                        
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="5" align="center">No transaction found</td>
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