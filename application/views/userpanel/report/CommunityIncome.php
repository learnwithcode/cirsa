<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
    $model = new OperationModel();
    $Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
    
    $member_id = $this->session->userdata('mem_id');
    
    if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
        $from_date = InsertDate($_REQUEST['from_date']);
        $to_date = InsertDate($_REQUEST['to_date']);
        $StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
        $SrchQ .="&from_date=$from_date&to_date=$to_date";
    }
    
    $QR_PAGES="SELECT tcd.*, tm.user_id FROM tbl_cmsn_community AS tcd 
			  LEFT JOIN tbl_members AS tm ON tcd.from_member_id	=tm.member_id
			  WHERE tcd.member_id='".$member_id."'  $StrWhr ORDER BY tcd.id ASC";
    $PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);  
    
 echo $ownersubid = $model->getsubsid($member_id); 
    
?>
 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
?>

               <div class="container">
                   <div class="row">
                        <div class="order-statement">
                        <div class="heading-main">
                            <h5>Community Bonus  </h5>
                           
                            </p>
                        </div>
                        <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;box-shadow: 0 0 4px #c0baba;">
                            <thead style="background-color: #15215a; color:#fff; text-align: left;">
                                <tr>
                                      <th>S.No. </th>
                                      <th>Date</th>
                                      <th>From User Id </th>
                                     
                                       <th> Code </th>
                                        
                                      <th>Level</th>
                                      <th>Total Amount</th>
                                       <th>Remarks</th>
                                      <th>Return(%)</th>
                                      <th>Net Amount </th>
                                      <!-- <th  class="sorting">Details</th> -->
                                    </tr>
                            </thead>
                           <tbody>
                                     
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl= $PageVal['RecordStart']+1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									    	$net_income_sum1 +=$AR_DT['net_income'];
                    
								?>
                                    <tr class="odd" role="row">
                                      <td class="sorting_1"><?php echo $Ctrl; ?></td>
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['date_time'],"d M Y h:i:a"); ?></td>
                                      <td ><?php echo $AR_DT['user_id']; ?></td>
                                      <td ><?php echo $AR_DT['subcription_id']; ?></td>
                                      
                                      <td data-title="Trns No"><span class="btn btn-success btn-sm"> <?php echo $AR_DT['level']; ?> </span></td>
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['total_income'],2); ?></td>
                                      <td><?php echo $AR_DT['remarks']; ?></td>
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['returns']); ?>%</td>
                                      <td> <?php echo CURRENCY; ?><?php echo number_format($AR_DT['net_income'],2); ?></td>
                                      <!-- <td><?php echo $AR_DT['trns_remark']; ?></td> -->
                                    </tr>
                                    <?php $Ctrl++; endforeach; ?>
                                     <tr style="font-size: large;font-weight: 800;color: #ebe1e1;background: #764e02;">
                        
                       <td colspan="6">Total</td>
                      
                        <td class="sorting_1">&nbsp;</td>
                      
                     
                    
                    
                    
                      <td ><strong><?php echo number_format($net_income_sum1,2); ?></strong></td>
                              
                                
                    </tr>
								<?php	}else{ 
									?>
                                    <tr class="odd" role="row">
                                      <td colspan="8"   align="center">No transaction found</td>
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
 <footer id="footer-main" >
                   
                    </footer>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>