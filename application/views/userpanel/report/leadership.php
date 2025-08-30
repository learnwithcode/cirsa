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
	
	$QR_PAGES="SELECT tcd.*, tm.user_id FROM ".prefix."tbl_cmsn_quick AS tcd 
			  LEFT JOIN tbl_members AS tm ON tcd.member_id = tm.member_id
				  WHERE tcd.member_id='".$member_id."' $StrWhr ORDER BY tcd.daily_cmsn_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
 
// 	PrintR($PageVal);die;
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
                        <h4 class="card-title">LeaderShip Income Report</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table  table-striped table-bordered" >
 
							 


<thead>
                      <tr>
                          <th>S.No.</th>
                          <th>Date</th>
                          <th>Member Id </th>
                         <!-- <th>Total USD</th>-->
                         <!-- <th>Admin Charge</th>
                          <th>TDS</th>
                          <th>Repurchase Detection</th>-->
                          <th>Net USD</th>
                        </tr>
                    </thead>
                           
                                  <tbody>
						           <?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=$PageVal['RecordStart']+1;
							//	echo "<pre>";print_r($PageVal['ResultSet']);die;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                <tr class="odd" role="row">
                                    <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                                      <td class=""><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                      <td><?php echo $AR_DT['user_id']; ?></td>
                                     <!-- <td>$ <?php echo number_format($AR_DT['trans_amount']); ?></td>-->
                                      <!--<td><?php echo number_format($AR_DT['admin_charge'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['tds'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['repurchase_detection']); ?></td>-->
                                      <td>$ <?php echo number_format($AR_DT['net_income']); ?></td>
                                  </tr>
                             
                        
                                    
                                    <?php endforeach; 
									}else{
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
	
	
 
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>