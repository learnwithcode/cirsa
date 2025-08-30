<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	$from_date = InsertDate($segment['from_date']);
	$to_date = InsertDate($segment['to_date']);
	 
	$member_id = $this->session->userdata('mem_id');
    
  

?>



	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu');?>
	

		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
			
	
              <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">My Re-Top Up Pool View</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <div class="table-responsive">
                            <table class="table mb-0 table-borderless reporting_table">
                  <thead>
                                <tr>
                                    <th scope="col">#Sn</th>
                                    <th scope="col">Package</th> 
                                    <th>Date</th>
                                    <th scope="col">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                          
                                <?php 
                                  $activation = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members_2` WHERE `member_id` =  '$member_id' AND `entry_type` ='A' ORDER BY  id  ASC");       
                                if(count($activation) > 0 ){
                                    $i=1;$TotalPackages=0;
                                    foreach($activation as $r) { 
                                      
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                  
                                    <td><?php echo number_format($r['amount'],2);?></td> 
                                    <td><?php echo date('d-M-Y',strtotime($r['date_time']));?></td>
                                    <td><a href="<?php echo BASE_PATH;?>member/network/retopup_pool_View/<?php echo _e($r['ref_id']);?>"  target="_blank" class="btn btn-success mt-0">View</a></td>
                                </tr>
                                <?php  $i++; } ?>
                                
                                
                                
                                <?php } else{ ?>
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No Data found !</td>
                                   
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                       
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
        	</div>
		
		</div>		
        <!--**********************************
            Content body end
        ***********************************-->
		
	
	

</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>