<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$wallet_id = 2;//($_REQUEST['wallet_id']>0)? $_REQUEST['wallet_id']:$model->getWallet(WALLET1);
	
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
Mining Wallet </h1>

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
                            <!--<th>Trns No</th>-->
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Details</th>                     
                        </tr>

                            
</thead>
   <tbody id="myTable">  <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=$PageVal['RecordStart']+1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									   // PrintR($AR_DT);
								$net_income_sum1	  += $AR_DT['trns_amount'];
								?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $i;$i++;?></td>
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['trns_date']); ?></td>
                                      <!--<td class="sorting_1"><?php echo $AR_DT['trans_ref_no']; ?></td>-->
                                      <td class="sorting_1"><?php echo ( $AR_DT['trns_type'] =='Cr')?'Cr':'Dr'; ?></td>
                                      <td class="sorting_1"><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['trns_amount'],2); ?></td>
                                     
                                      <td>   
                                      <?php  if($AR_DT['trns_for']=='Baord'){?>
                                      
                                      
                                      <?php if($AR_DT['trns_amount']=='30'){ echo $slot = 'Slot 1 '. $AR_DT['trns_remark'];}
                                       if($AR_DT['trns_amount']=='60'){ echo $slot = 'Slot 2 '. $AR_DT['trns_remark'];}
                                        if($AR_DT['trns_amount']=='120'){ echo $slot = 'Slot 3 '. $AR_DT['trns_remark'];}
                                         if($AR_DT['trns_amount']=='240'){ echo $slot = 'Slot 4 '. $AR_DT['trns_remark'];}
                                          if($AR_DT['trns_amount']=='480'){ echo $slot = 'Slot 5 '. $AR_DT['trns_remark'];}
                                         ?>
                                           
                                           <?php }elseif($AR_DT['trns_for']=='DCA'){
                                           echo $AR_DT['trns_remark'];
                                           
                                           }else{ 
                                           
                                            echo $AR_DT['trns_remark'];
                                           }
                                           ?>
                                      </td>
                                    </tr>
                                    
                                    <?php endforeach; ?>
                                           <tr style="font-size: large;font-weight: 800;color: #ebe1e1;background: green;">
                        
                       <td colspan="2">Total</td>
                      
                        <td class="sorting_1">&nbsp;</td>
                      
                     
                    
                    
                    
                      <td colspan="2"><strong><?php echo CURRENCY; ?> <?php echo number_format($net_income_sum1,2); ?></strong></td>
                              
                                
                    </tr>
								<?php	}else{
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
          <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>