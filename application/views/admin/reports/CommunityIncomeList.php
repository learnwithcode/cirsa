<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $model = new OperationModel();
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

    
    
    if($_GET['from_date']!='' && $_GET['to_date']!=''){
        $from_date = InsertDate($_GET['from_date']);
        $to_date = InsertDate($_GET['to_date']);
        $StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
        $SrchQ .="&from_date=$from_date&to_date=$to_date";
    }
    
    if($_GET['user_id']!=''){
        $member_id = $model->getMemberId($_GET['user_id']);
        $StrWhr .=" AND tcd.member_id='$member_id'";
        $SrchQ .="&user_id=$user_id";
    }
    if($_GET['process_id'] !='')
    {
        $processId = $_GET['process_id'];
        $StrWhr .="  AND tcd.process_id='$processId'";
        
    }

    
    $QR_PAGES= "SELECT tcd.*, tm.user_id , CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name  FROM tbl_cmsn_community AS tcd 
			   LEFT JOIN tbl_members AS tm ON tcd.member_id=tm.member_id
			 
			   WHERE 1   $StrWhr ORDER BY tcd.id DESC";
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Community Income List </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                    <table class="table table-striped">
 <thead>
                    <tr role="row">
                      <th  class="sorting">Date</th>
                      <th  class="sorting">Full Name</th>
                      <th  class="sorting">Username</th>
                     
                      <th  class="sorting">From Member ID</th>
                      
                       <th  class="sorting">Level</th>
                      <th  class="sorting">Amount</th>
                      <th  class="sorting">Return (%) </th>
                      <th  class="sorting">Net Amount</th>
                    </tr>
                  </thead>
                        <tbody id="operatorData">
                         
						           <?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=$PageVal['RecordStart']+1;
						 
									foreach($PageVal['ResultSet'] as $AR_DT) { 
									$net_income_sum +=$AR_DT['net_income'];	
							$fromuserid	=	$model->getMemberUserId($AR_DT['from_member_id']);
								?>
                                 <tr class="odd" role="row">
                      <td data-title="Date"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                      <td data-title="Full Name"><?php echo $AR_DT['full_name']; ?></td>
                      <td data-title="Username"><?php echo $AR_DT['user_id']; ?></td>
                    <td data-title="From ID"><?php echo $fromuserid; ?></td>
                    
                      <td data-title="Trns No"><span class="btn btn-success btn-sm"> <?php echo $AR_DT['level']; ?> </span></td>
                       
                      <td data-title="USD"><?php echo CURRENCY; ?> <?php echo $AR_DT['total_income']; ?></td>
                      <td data-title="Return (%)"><?php echo CURRENCY; ?> <?php echo $AR_DT['returns']; ?> %</td>
                      <td data-title="Net Total"> <?php echo CURRENCY; ?> <?php echo $AR_DT['net_income']; ?></td>
                    </tr>
                                    
                                    <?php  }?>
                                    
                                     <tr class="odd" role="row">
                      <td class="sorting_1">&nbsp;</td>
                        
                         <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><strong>Sum Total </strong></td>
                      <td><strong><?php echo CURRENCY; ?><?php echo number_format($net_income_sum,2); ?></strong></td>
                    </tr>
                                    
								<?php	}else{
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
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $("#form-valid").validationEngine();
        $("#form-valid").validationEngine();
        $(".getStateList").on('blur',getStateList);
        $(".getCityList").on('blur',getCityList);
        function getStateList(){
            var country_code = $("#country_code").val();
            var URL_STATE = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=STATE_LIST&country_code="+country_code;
            $("#state_name").load(URL_STATE);
        }
        function getCityList(){
            var state_name = $("#state_name").val();
            var URL_CITY = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=CITY_LIST&state_name="+state_name;
            $("#city_name").load(URL_CITY);
        }
    });
</script>