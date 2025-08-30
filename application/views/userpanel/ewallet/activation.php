<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$wallet_id = ($_REQUEST['wallet_id']>0)? $_REQUEST['wallet_id']:$model->getWallet(WALLET1);
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(twt.trns_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);

	$QR_PAGES="SELECT m.user_id , m.first_name , s.package_price,s.date_from  FROM `tbl_subscription` as s LEFT JOIN tbl_members as m on s.active_by = m.member_id WHERE s.active_by = '1' ORDER BY s.`subcription_id` DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
?>
 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
?>

               <div class="container">
                   <div class="row">
                        <div class="order-statement">
                        <div class="heading-main">
                            <h5>Activation History </h5>
                           
                            </p>
                        </div>
                        <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;box-shadow: 0 0 4px #c0baba;">
                            <thead style="background-color: #15215a; color:#fff; text-align: left;">
                                 <tr>
                            <th>S.No.</th>
                            <th>Date</th>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>USD</th>
                                         
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
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['date_from']); ?></td>
                                      <td class="sorting_1"><?php echo strtoupper($AR_DT['user_id']); ?></td>
                                      <td class="sorting_1"><?php echo strtoupper($AR_DT['first_name']); ?></td>
                                      <td class="sorting_1">$ <?php echo number_format($AR_DT['package_price']); ?></td>
                                  
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
 <footer id="footer-main" >
                   
                    </footer>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>