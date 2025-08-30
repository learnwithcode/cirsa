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
	
  $QR_PAGES="SELECT * FROM `tbl_reward` ";
  $PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
	
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
                <h4 class="card-title">Reward Income Report	</h4>
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
                          <th>Sn.</th>
                          
                          <th>Name</th>
                            <th>Matching PV</th>
                         <th>Reward</th>
                          <th>Status</th>
                        </tr>
                    </thead>
                           
                                  <tbody>
						        <?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=$PageVal['RecordStart']+1;
							//	echo "<pre>";print_r($PageVal['ResultSet']);die;
									foreach($PageVal['ResultSet'] as $AR_DT):
									    
									    $getstatus = $model->getrewardachivers($member_id,$AR_DT['reward_id']);
									    $getstatus = $getstatus > 0 ? $getstatus:0;
								?>
								
                         <tr class="odd" role="row">
                                     <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                                    <td><span class="label label-lg label-pink arrowed-right">Reward - <?php echo $AR_DT['reward_id']; ?></span></td> 
                      <td><?php   echo $AR_DT['pv'];?>    </td>
                    <td><?php   echo $AR_DT['description'];?>    </td>
                   <td><?php if($getstatus > 0 ) {?> <span class="label label-lg label-success arrowed-in arrowed-in-right">Achived</span> <?php }else{?><span class="label label-lg label-yellow arrowed-in arrowed-in-right">Pending</span><?php } ?></td>
                                  </tr>
							 
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="4" align="center">No transaction found</td>
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

