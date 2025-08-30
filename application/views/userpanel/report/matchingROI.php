<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
	if($_GET['from_date']!='' && $_GET['to_date']!=''){
		$from_date = InsertDate($_GET['from_date']);
		$to_date = InsertDate($_GET['to_date']);
		$StrWhr .=" AND DATE(tcd.cmsn_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT tcd.*, tm.user_id FROM ".prefix."tbl_cmsn_binary_R AS tcd 
			  LEFT JOIN tbl_members AS tm ON tcd.member_id = tm.member_id
				  WHERE tcd.member_id='".$member_id."' $StrWhr ORDER BY tcd.id DESC";
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
                        <h4 class="card-title">Binary Matching Returns</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table  table-striped table-bordered" >
                         <thead>
                                    <tr>
                                      <th  class="sorting">S.No. </th>
                                      <th  class="sorting">Date</th>
                                      <th  class="sorting">Trans Id</th>
                                      <!--<th  class="sorting">Amount</th>-->
                                      <!--<th  class="sorting">Return</th>-->
                                      <th  class="sorting">Net USD </th>
                                      <th  class="sorting">Details</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl= $PageVal['RecordStart']+1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                    <tr class="odd" role="row">
                                      <td class="sorting_1"><?php echo $Ctrl; ?></td>
                                      <td class="sorting_1"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                     <td>#002022<?php echo $AR_DT['binary_id']; ?></td> 
                                      <td>$ <?php echo number_format($AR_DT['net_income'],2); ?></td>
                                      <td><?php echo $AR_DT['remarks']; ?></td>
                                    </tr>
                                    <?php $Ctrl++; endforeach;
									}else{
									?>
                                    <tr class="odd" role="row">
                                      <td colspan="7"   align="center">No transaction found</td>
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