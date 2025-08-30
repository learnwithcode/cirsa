<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
	if($_GET['from_date']!='' && $_GET['to_date']!=''){
		$from_date = InsertDate($_GET['from_date']);
		$to_date = InsertDate($_GET['to_date']);
		$StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT tcd.*, tm.user_id FROM ".prefix."tbl_cmsn_level AS tcd 
			  LEFT JOIN tbl_members AS tm ON tcd.from_member_id	=tm.member_id
			  WHERE 1 ORDER BY tcd.id DESC";
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Level Bonus </small>  </h4>
                        </div>
                             <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                    <a  href="<?php echo generateSeoUrlAdmin("excel","level_income",""); ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                    
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
                          <th>Level</th>
                          <th>Member Id </th>
                          <th>From Member Id </th>
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
                                         <td><span class="btn btn-success arrowed">Level - <?php echo $AR_DT['level']; ?></span> </td>
                                          <td><?php echo $memuserid; ?></td>
                                      <td><?php echo $AR_DT['user_id']; ?></td>
                                      <!--<td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['net_income'],2); ?></td>-->
                                      <!--<td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['admin_charge'],2); ?></td>
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['tds'],2); ?></td>
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['repurchase_detection'],2); ?></td>-->
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['net_income'],4); ?></td>
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