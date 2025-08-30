<?php defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcd.cmsn_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	
	$QR_PAGES= "SELECT R.*,COUNT(CR.rank_id) as total FROM `tbl_reward_2` as R LEFT JOIN tbl_members as CR on CR.rank_id =R.reward_id group by R.reward_id ";
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Team Building  Bonus </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                            <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                 <thead>
                    <tr role="row">
                      <th  class="sorting">Sr. No </th>                      
                    
                      <th  class="sorting">Reward   </th>
                      <th  class="sorting">Status</th>
                      <th  class="sorting">Total Achiver</th>
					  <th  class="sorting">Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
						if($PageVal['TotalRecords'] > 0){
						    if($Page > 1)
						    {
						        $Page = ($Page -1)* 50 +1;
						    }
						    
						$Ctrl=$Page;
							foreach($PageVal['ResultSet'] as $AR_DT):
						?>
                    <tr class="odd" role="row">
                      <td data-title="Sr. No"><?php echo $Ctrl; ?></td>
                    
                     
                      <td data-title="Reward Amount"><?php echo $AR_DT['reward_name']; ?></td>
                     <td data-title="Status"><?php if(true){echo '<span class="label label-success arrowed">Success</span>';}else{ echo '<span class="label label-warning label-white middle">
												<i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
												Close
											</span>';} ?></td>
					  <td data-title="Total Achiver"><?php echo strtoupper($AR_DT['total']); ?></td>
                     
                     
                      <td data-title="View"><?php if($AR_DT['total'] > 0) { ?><a href="<?php echo generateSeoUrlAdmin("bonus","rewardList",""); ?>?rank_id=<?php echo _e($AR_DT['rank_id']); ?>">View</a><?php } else { ?> <a href="javascript:void(0);" onClick="alert('There is no Reward Achiver`s!');">View</a><?php } ?></td>
					   
                    </tr>
                    <?php $Ctrl++; endforeach;
						}
						 ?>
                  </tbody>
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