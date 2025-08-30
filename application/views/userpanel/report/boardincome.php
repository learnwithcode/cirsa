<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
    $model = new OperationModel();
    $Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
    
    $member_id = $this->session->userdata('mem_id');
    	$wallet_id = ($_REQUEST['wallet_id']>0)? $_REQUEST['wallet_id']:$model->getWallet(WALLET1);
    if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
        $from_date = InsertDate($_REQUEST['from_date']);
        $to_date = InsertDate($_REQUEST['to_date']);
        $StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
        $SrchQ .="&from_date=$from_date&to_date=$to_date";
    }
    
   	$QR_PAGES="SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			   WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Pool'
			   $StrWhr 
			   ORDER BY twt.wallet_trns_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
    
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
Pool Income Bonus</h1>

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
                          
                            <th>Pool Bonus</th>
                            <th>Details</th>                     
                        </tr>

                            
</thead>
   <tbody>  <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=$PageVal['RecordStart']+1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $i;$i++;?></td>
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['trns_date']); ?></td>
                                     
                                      <td class="sorting_1"><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['trns_amount'],2); ?></td>
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