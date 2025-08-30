<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$today_date = getLocalTime();
  $segment = $this->uri->segment(4);
 
$request_id = _d($segment['request_id']);
$member_id = $this->session->userdata('mem_id');
$wallet_id = 1;
$AR_MEM = $model->getMember($member_id);

$LDGR = $model->getCurrentBalancewal($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);


	$wallet_id = $model->getWallet(WALLET1);
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	


	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tft.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT * FROM ".prefix."tbl_cryptofund  
						WHERE member_id='".$member_id."'	ORDER BY id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	

 

     

 ?>
 
 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); 
?>

         
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                           
                        </div>
                    </div>
                 
                </div>
                <!-- row -->

                <div class="row">
                 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Crypto Payment History</h4>
                            </div>
                            <div class="card-body">
                                  <?php get_message();?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                                <tr>
                  
                          <th>Sn.</th>
                            <th>Trns No</th>
                           <th>Date & Time</th>
                            <th>User ID</th>
                            <th >Currency</th>
                            <th >USDT </th>
                             <th >USDT IN INR </th>
                            <th>From</th>
                            <th>Hash</th>
                                  
                                 
                                  <th>Status</th>
                 
                        </tr>
                            </thead>
                           <tbody>
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								 	// date("d-m-Y H:i:s A",time($AR_DT['block_timestamp']))
								?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $i;$i++;?></td>
                                          <td class="sorting_1"><?php echo $AR_DT['txn_id']; ?></td>
                                         <td class="sorting_1"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i A"); ?></td>
                                          <td class="sorting_1"><?php echo $AR_DT['user_id']; ?></td>
                                          <td class="sorting_1"><?php echo $AR_DT['symbol']; ?></td>
                                          <td class="sorting_1">$ <?php echo $AR_DT['amount']; ?></td>
                                            <td class="sorting_1"><?php echo CURRENCY; ?> <?php echo $AR_DT['amount1']; ?></td>
                                           <td class="sorting_1"><?php echo $AR_DT['fromaddress']; ?></td>
                                             <td class="sorting_1"><?php echo $AR_DT['hash_no']; ?></td>
                                       
                                  <td><?php if($AR_DT['status'] =='N'){echo '<div class="badge badge-warning">Pending</div>';}elseif($AR_DT['status'] =='Y'){echo '<div class="badge badge-success">Success</div>';}else{ echo '<a   <div class="badge badge-danger">Rejected</div>';} ?></td>
                               
                             
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td col mb-3span="7" align="center">No transaction found</td>
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