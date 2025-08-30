<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
 
	$member_id = $this->session->userdata('mem_id');
 

	$QR_PAGE = "SELECT * FROM `tbl_single_leg` WHERE 1";
	$PageVal = DisplayPages($QR_PAGE, 50, $Page, $SrchQ);
	
?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>								


		 <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
       		
		
<div class="content-body"><!-- Basic Tables start -->
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Single Leg View			</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                 
                <div class="table-responsive">
                    <table class="table table-bordered table-inverse mb-0 .table-inverse">
							 
 
<thead>
                       <tr>
                            <th>S.No.</th>
                         
                            <th>Team</th>
                            <th>Direct</th>
                            
                            <th>My Downline</th>
                             <th>Net Income</th>
                              <th>Achieve Status</th>
                            
                        </tr>

                            
</thead>
   <tbody>
				<?php   if($PageVal['TotalRecords'] > 0){
				$Ctrl=$PageVal['RecordStart']+1;
				foreach($PageVal['ResultSet'] as $AR_DT):
				$getSingle = $model->getSingleLegAc($AR_DT['id'],$member_id);
				if(is_array($getSingle) and  !empty($getSingle))
				{
				$getdown = $AR_DT['team'];//$model->getInvestment($AR_DT['id']);
				$status ='<span class="badge badge badge-pill badge-success float-right mr-2">Achieve</span>';
				}
				else
				{
				    $getdown = 0;
				    	$status ='<span class="badge badge badge-pill badge-warning float-right mr-2">Pending</span>';
				}
				?>
              <tr>
                <td class=""><?php echo $Ctrl; ?></td>
             
                <td><?php echo $AR_DT['team']; ?></td>
                <td><?php echo $AR_DT['direct']; ?></td>
                <td><?php echo $getdown; ?></td>
                <td><?php echo $AR_DT['income']; ?></td>
                <td><?php echo $status;?></td>
                
              </tr>
              <?php $Ctrl++;
			   endforeach;	}else{
									?>
									<tr class="odd" role="row">
										<td colspan="10" align="center">No transaction found</td>
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
<div class="row">
<div class="col-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
</div></div>

<div class="col-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul>
								  
								   </div></div>

    </div>					
		
        </div>
      </div>
    </div>
    <!-- END: Content-->	
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
