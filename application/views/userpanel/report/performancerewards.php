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
	
	$QR_PAGES="SELECT tcd.*, tm.user_id FROM ".prefix."tbl_cmsn_quick_performance AS tcd 
			  LEFT JOIN tbl_members AS tm ON tcd.member_id = tm.member_id
				  WHERE tcd.member_id='".$member_id."' $StrWhr ORDER BY tcd.daily_cmsn_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
 
// 	PrintR($PageVal);die;
?>


	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu');?>
	
<div id="content" class="app-content">

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-xl-12">

<div class="row">

<div class="col-xl-12">

<h1 class="page-header">
Performance Bonus</h1>

<hr class="mb-4">



<div id="responsiveTables" class="mb-5">
<div class="card">
<div class="card-body">
<div class="table-responsive  table-bordered mb-0">
<table class="table mb-0">
   

<thead>
                      <tr>
                          <th>S.No.</th>
                          <th>Date</th>
                          <th>Member Id </th>
                            <th>Performance Id </th>
                           <th>Total Turnover</th>
                          <th>Total Returns</th>
                         <!-- <th>Admin Charge</th>
                          <th>TDS</th>
                          <th>Repurchase Detection</th>-->
                          <th>Net Bonus</th>
                        </tr>
                    </thead>
                           
                                  <tbody>
                                    
						           <?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=$PageVal['RecordStart']+1;
							//	echo "<pre>";print_r($PageVal['ResultSet']);die;
									foreach($PageVal['ResultSet'] as $AR_DT):
									    $net_income_sum1 +=$AR_DT['net_income'];
									    
								?>
                                <tr class="odd" role="row">
                                    <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                                      <td class=""><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                          <td> Club id - <?php echo $AR_DT['rank_id']; ?> </td>
                                      <td><?php echo $AR_DT['user_id']; ?></td>
                                        <td> <?php echo CURRENCY; ?> <?php echo number_format($AR_DT['trans_amount']); ?> </td>
                                      <td> <?php echo CURRENCY; ?> <?php echo number_format($AR_DT['daily_return'],2); ?> %</td>
                                      <!--<td><?php echo number_format($AR_DT['admin_charge'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['tds'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['repurchase_detection']); ?></td>-->
                                      <td><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['net_income'],2); ?></td>
                                  </tr>
                             
                        
                                    
                                    <?php endforeach;  ?>
                                    
                                      <tr style="font-size: large;font-weight: 800;color: #ebe1e1;background: #764e02;">
                        
                       <td colspan="4">Total</td>
                      
                        <td class="sorting_1">&nbsp;</td>
                      
                     
                    
                    
                    
                      <td ><strong><?php echo number_format($net_income_sum1,2); ?></strong></td>
                              
                                
                    </tr>
								<?php	}else{
									?>
									<tr class="odd" role="row">
										<td colspan="5" align="center">No transaction found</td>
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

</div>

</div>

</div>
      
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>