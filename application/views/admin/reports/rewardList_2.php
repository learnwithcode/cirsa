<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

	
 	$rewardId = _d($_GET['reward_id']);
//	$QR_PAGES= "SELECT rd.matching_pv,rd.net_income, tm.user_name AS username,r.description, tm.first_name,tm.midle_name,tm.last_name,tm.city_name FROM tbl_cmsn_reward AS rd LEFT JOIN tbl_members AS tm ON rd.member_id=tm.member_id  LEFT JOIN tbl_reward AS r ON rd.reward_id=r.reward_id WHERE rd.reward_id='$rewardId'";

	$QR_PAGES= "SELECT  r.*,tm.user_name AS username, tm.first_name,tm.midle_name,tm.last_name,tm.city_name FROM  tbl_members AS tm  LEFT JOIN tbl_reward_2 AS r ON tm.rank_id=r.reward_id WHERE tm.rank_id='$rewardId'";


	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
//	$QR_SUM = "SELECT SUM(tcd.net_income) AS net_income FROM tbl_cmsn_direct AS tcd WHERE 1 $StrWhr ORDER BY tcd.direct_id DESC";
//	$AR_SUM = $this->SqlModel->runQuery($QR_SUM,true);
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
                      <th  class="sorting">User Id</th>
                      <th  class="sorting">Name </th>
                     
                      
                      
                      <th  class="sorting">Rank Name </th>
                    
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
                      <td data-title="User Id"><?php echo strtoupper($AR_DT['username']); ?></td>
                      <td data-title="Name"><?php echo strtoupper($AR_DT['first_name'].' '.$AR_DT['midle_name'].' '.$AR_DT['last_name']); ?></td>
                      
                      <td data-title="Net Income"><?php echo  $AR_DT['eligibility']; ?></td>
                     
                      
                    </tr>
                    <?php $Ctrl++; endforeach;
						}
						else{
						 ?>
						 <tr><td colspan="7" align="center">No data found <a href="<?php echo generateSeoUrlAdmin("bonus","leadershipincome",""); ?>">Click here </a> go to back.</td></tr>
						 <?php } ?>
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