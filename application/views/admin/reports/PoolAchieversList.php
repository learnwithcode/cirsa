<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

	
 	  $type = _d($_GET['type']); 
 	   $typeqq = $_GET['type']; 
 	  	if($type!=''){
		$member_id = $model->getMemberId($_REQUEST['user_id']);
		$StrWhr .=" AND tcd.member_id='$member_id'";
		$SrchQ .="type=$typeqq";
	}

 	  
 	 $QR_PAGES= "SELECT tm.user_name AS username, tm.first_name,tm.midle_name,tm.last_name,tm.city_name,pl.level,pl.net_income,pl.total_income,pl.upgrade,pl.type ,pl.topup, pl.date_time  from tbl_cmsn_pool as pl LEFT JOIN tbl_members AS tm ON pl.member_id=tm.member_id WHERE pl.type='$type' and pl.is_display ='Y' order by pl.id desc";
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Auto Pool Member  </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                            <table id="no-more-tables" class="table table-striped table-bordered table-hover">
            <thead>
                    <tr role="row">
                            <th  class="sorting">Sr. No </th>
                            <th  class="sorting">Pool Type </th>
                            <th  class="sorting">Level </th>
                            <th  class="sorting">User Id</th>
                            <th  class="sorting">Name </th>
                            <th  class="sorting">Total USD </th>
                            
                            <th  class="sorting">Return %</th>
                            <th>Re-invest</th> 
                            <th  class="sorting">Net USD </th>
                            <th  class="sorting">Date</th>
                      
                     
             
                    
                    
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
						if($PageVal['TotalRecords'] > 0){
						   
						    
						$Ctrl=$PageVal['RecordStart']+1; 
							foreach($PageVal['ResultSet'] as $AR_DT):
							      if($AR_DT['type'] == '1'){ $pool = "Auto Pool $ 30";       $upto = 8; }
                                if($AR_DT['type'] == '2'){ $pool = "Auto Pool $ 60";        $upto = 8;}
                                if($AR_DT['type'] == '3'){ $pool = "Auto Pool $ 120";        $upto = 8;}
                                if($AR_DT['type'] == '4'){ $pool = "Sponsor Pool $ 30";       $upto = 5; }
                                if($AR_DT['type'] == '5'){ $pool = "Sponsor Pool $ 60";       $upto = 5; }
                                // if($AR_DT['type'] == '6'){ $pool = "Sponsor Pool $ 120";       $upto = 5; }
                                // if($AR_DT['type'] == '7'){ $pool = "E- Pool $ 100";       $upto = 2; }
						?>
                    <tr class="odd" role="row" style="<?php echo ($AR_DT['topup'] =='Y') ?'background:#ff000036':''; ?>">
                        <td data-title="Sr. No"><?php echo $Ctrl; ?></td>
                        <td> <span class="label label-success arrowed"><?php echo $pool; ?></span></td>
                        
                        <td> <span class="label label-warning arrowed">Level - <?php echo $AR_DT['level']; ?></span></td>
                        <td data-title="User Id"><?php echo strtoupper($AR_DT['username']); ?></td>
                        <td data-title="Name"><?php echo strtoupper($AR_DT['first_name'].' '.$AR_DT['midle_name'].' '.$AR_DT['last_name']); ?></td>
                        <td data-title="Total USD">$ <?php echo number_format($AR_DT['total_income'],2); ?></td>
                        <td data-title="Return">$ <?php echo number_format($AR_DT['upgrade'],2); ?></td>
                        
                           <td data-title="City Name">$ <?php echo ($AR_DT['topup'] =='Y') ?number_format($AR_DT['net_income'],2):0.00; ?></td>                                           
                      <td data-title="City Name">$ <?php echo ($AR_DT['topup'] =='Y') ?0.00:number_format($AR_DT['net_income'],2); ?></td>
                        
                        <!--<td data-title="Net Income">$ <?php echo number_format($AR_DT['net_income'],2); ?></td>-->
                        <td data-title="Date">  <?php echo date('Y-m-d',strtotime($AR_DT['date_time'])); ?></td>
                        
                        
                      
                      
                      
                    </tr>
                    <?php $Ctrl++; endforeach;
						}
						else{
						 ?>
						 <tr><td colspan="7" align="center">No data found <a href="<?php echo generateSeoUrlAdmin("bonus","poolAchiever",""); ?>">Click here </a> go to back.</td></tr>
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