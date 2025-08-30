<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$wallet_id = 2;
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(twt.trns_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);

	$QR_PAGES="SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			   WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."'
			   $StrWhr 
			   ORDER BY twt.wallet_trns_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
					    <div class="col-md-12">
							<div class="card">
							
								<div class="card-body">
					 
			
       
 	<h4 class="card-title">AIG Token History	</h4>	
Available TOKEN : <?php echo number_format($LDGR['net_balance']); ?>
   <div class="table-responsive">
                       
								    <table class="table table-striped" id="table-1">
<thead>
                       <tr>
                            <th>Sn.</th>
                            <th>Date</th>
                            <!--<th>Trns No</th>-->
                            <th>Type</th>
                            <th>TOKEN</th>
                            <th>Details</th>                     
                        </tr>

                            
</thead>
   <tbody>  <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $i;$i++;?></td>
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['trns_date']); ?></td>
                                      <!--<td class="sorting_1"><?php echo $AR_DT['trans_ref_no']; ?></td>-->
                                      <td class="sorting_1"><?php echo $AR_DT['trns_type']; ?></td>
                                      <td class="sorting_1"><?php echo number_format($AR_DT['trns_amount']); ?></td>
                                      <td><?php echo $AR_DT['trns_remark']; ?></td>
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="6" align="center">No transaction found</td>
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
								 </nav> 
								   </div></div>
            
          </div>
        </section>
       
      </div>
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>