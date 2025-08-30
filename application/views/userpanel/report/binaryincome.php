<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcb.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT tcb.* , tpt.prod_pv, tpt.pin_name, tp.start_date, tp.end_date
			   FROM ".prefix."tbl_cmsn_binary AS tcb 
			   LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcb.member_id
			   LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
			   LEFT JOIN ".prefix."tbl_process AS tp ON tp.process_id=tcb.process_id
			   WHERE tcb.net_cmsn > 0 and tcb.member_id='".$member_id."' $StrWhr ORDER BY tcb.binary_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	
<div class="content-page rtl-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Binary Matching Report</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table  table-striped table-bordered" >
                        							 

 <thead>
                         <tr>
                  
                          <th rowspan='2' >S.No.</th>
                            <th rowspan='2'>Process Week </th>
                              <th rowspan='2'>Trans ID</th> 
                                  <th colspan='2'>Carry Forword </th>
                                  <th colspan='2'>Current  </th>
                                 
                                  <th colspan='2'>Total </th>
                                  <th rowspan='2'>Matching  </th>
                         <th rowspan='2'>Capping</th>
                        <!-- <th rowspan='2'>Reserved USD</th>
                        --> 
                         <th rowspan='2'>Net Amount </th>
                        </tr>
                        <tr>
                  
                         
                           
                                 
                                  <th>Left</th>
                                  <th>Right</th>
                                    <th>Left</th>
                                  <th>Right</th>
                                    <th>Left</th>
                                  <th>Right</th>
                                   
                                 
                 
                        </tr>
                    </thead>
                           
                                    <tbody>
								<?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=1; $i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									$package_ceiling = ($AR_DT['prod_pv']*7);
									$ceiling_max_limit = 35000;
									$binary_ceiling = ($package_ceiling<=$ceiling_max_limit)? $package_ceiling:$ceiling_max_limit;
								?>
                                <tr class="odd" role="row">
                                    <td><?php echo $i;$i++;?></td>
                                  <td class="sorting_1"><?php $s_date = DisplayDate($AR_DT['start_date']);
                                  $e_date = DisplayDate($AR_DT['end_date']);
                                  echo date('d-M', strtotime($s_date))."<br>".date('d-M-y', strtotime($e_date)); ?></td>
                                 <td>#003022<?php echo $AR_DT['binary_id']; ?></td>
                                   <td><?php echo CURRENCY; ?><?php echo $AR_DT['leftCrf']; ?></td>
                                  <td><?php echo CURRENCY; ?><?php echo $AR_DT['rightCrf']; ?></td>
                                          <td><?php echo CURRENCY; ?><?php echo $AR_DT['newLft']; ?></td>
                                  <td><?php echo CURRENCY; ?><?php echo $AR_DT['newRgt']; ?></td>
                                   <td><?php echo CURRENCY; ?><?php echo $AR_DT['totalLft']; ?></td>
                                  <td><?php echo CURRENCY; ?><?php echo $AR_DT['totalRgt']; ?></td>
                                     <td><?php echo CURRENCY; ?><?php echo $AR_DT['pair_match']; ?></td>
                             <td><?php echo CURRENCY; ?> <?php echo $AR_DT['binary_ceiling']; ?></td>
                           <!--  <td><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['cash_account'],2); ?></td>-->
                              <td><?php echo CURRENCY; ?><?php echo $AR_DT['net_cmsn']; ?></td>
                                  </tr>
                             
                        
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="13"  align="center">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
                                  </tbody>
                          
                        </table>
                            
     <div class="row">
<div class="col-md-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
</div></div>

<div class="col-md-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul> </nav>
								  
								   </div></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
	
	
 
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>