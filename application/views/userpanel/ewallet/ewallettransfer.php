<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$today_date = getLocalTime();
$segment = $this->uri->uri_to_assoc(2);
 
$request_id = _d($segment['request_id']);
$member_id = $this->session->userdata('mem_id');
$wallet_id = 2;//$this->OperationModel->getWallet(WALLET1);
$AR_MEM = $model->getMember($member_id);

$LDGR = $model->getCurrentBalancewal($member_id,1,$_REQUEST['from_date'],$_REQUEST['to_date']);
 
  
	$wallet_id = $model->getWallet(WALLET1);
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	


	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tft.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	  $QR_PAGES="SELECT tft.*, tmf.user_id AS from_user_id, tmt.user_id AS to_user_id
			FROM ".prefix."tbl_fund_transfer AS tft 
			LEFT JOIN tbl_members AS tmf ON tmf.member_id=tft.from_member_id
			LEFT JOIN tbl_members AS tmt ON tmt.member_id=tft.to_member_id
			WHERE (tft.from_member_id='".$member_id."'  OR tft.to_member_id='".$member_id."')
			AND trns_for LIKE 'TRANSFER'
			$StrWhr 
			ORDER BY tft.transfer_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	// PrintR($PageVal);die;

 ?> 


	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Transaction</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Transfer History</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="width:100%">
             

<thead>
                       <tr>
                            <th>S.No.</th>
                            <th>Date</th>
                            <th>Trns No</th>
                            <th>Type</th>
                            <th>USD</th>
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
                                      <td class="sorting_1"><?php echo $AR_DT['trans_no']; ?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['trns_type']; ?></td>
                                      <td class="sorting_1"><?php echo number_format($AR_DT['trns_amount'],2); ?></td>
                                      <td><?php echo $AR_DT['trns_remark']; ?></td>
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="5">No transaction found</td>
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
        <!--**********************************
            Content body end
        ***********************************-->

	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>