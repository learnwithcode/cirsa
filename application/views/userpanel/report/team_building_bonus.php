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
	

	$QR_PAGE = "SELECT * from tbl_reward_2  where 1 ";
	$PageVal = DisplayPages($QR_PAGE, 50, $Page, $SrchQ);	
	
	
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
                              <h4 class="card-title">Infinity Auto Fund</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <div class="table-responsive">
                               <table id="datatable" class="table  table-striped table-bordered" >
                                <thead>
                       <tr>
                           <th>  S.No.</th>
                         
                            <!--<th>Rank</th>-->
                              <th>Team Business</th>
                            <th> One Time Bonus </th>
                            
                            <th>  Status</th>
                            
                        </tr>

                            
</thead>
   <tbody>
				<?php   if($PageVal['TotalRecords'] > 0){
				$Ctrl=$PageVal['RecordStart']+1;
 
				foreach($PageVal['ResultSet'] as $AR_DT):
			    $status = $model->getrankstatus($member_id,$AR_DT['reward_id']);
			 
				
				?>
              <tr>
              <td class=""><?php echo $Ctrl; ?></td>
 
                <!--<td><?php echo $AR_DT['reward_name']; ?></td>-->
                 <td>$ <?php echo $AR_DT['matching_pv']; ?></td>
                <td>$ <?php echo $AR_DT['amount']; ?></td>
               
                
                <td>
                <?php if($status >  0 ) {?>
				<span class="badge badge badge-pill badge-success float-left mr-2">Achieved</span>
				<?php } else { ?>
				<span class="badge badge badge-pill badge-warning float-left mr-2">Pending</span>
				<?php }?>
                
                </td>
                
              </tr>
              <?php $Ctrl++;
			   endforeach;	}else{
									?>
									<tr class="odd" role="row">
										<td colspan="8" align="center">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
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