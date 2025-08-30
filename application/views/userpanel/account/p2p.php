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
		$uuser_id = $model->getMemberUserId($member_id);
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
	$QR_PAGES="SELECT m.user_id ,m.date_join ,m.first_name,m.member_mobile ,m.bank_name ,m.bank_acct_holder ,m.account_number ,m.ifc_code ,m.phonepay ,m.googlepay ,m.paytm ,s.* FROM `tbl_p2p_sale` as s LEFT JOIN tbl_members as m on m.member_id = s.member_id WHERE   s.`status` = 'Y' AND s.`adjust_amt` < s.`amount`  ORDER BY s.id DESC";
	$res = $this->SqlModel->runQuery($QR_PAGES); 
	// s.member_id = '$member_id'  and
	
	$QR_PAGE="SELECT m.user_id ,m1.user_id as senderId , m1.first_name as senderName, p.* FROM `tbl_p2p` as p LEFT JOIN tbl_members as m on m.member_id = p.member_id LEFT JOIN tbl_members as m1 on m1.member_id = p.`to_member_id` WHERE p.member_id = '$member_id'   ORDER BY p.id DESC";
	$PageVal = DisplayPages($QR_PAGE, 50, $Page, $SrchQ);
 
 
 
 $QR_PAGES1="SELECT p.id, p.`trans_id` , p.`amount` ,p.`date_time` ,p.`status` ,p.`slips` ,m.user_id as byuerId , m.first_name as buyerName ,m1.user_id as senderId , m1.first_name as senderName FROM `tbl_p2p` as p LEFT JOIN tbl_members as m on m.member_id = p.`member_id` LEFT JOIN tbl_members as m1 on m1.member_id = p.`to_member_id` WHERE m1.user_id = '$uuser_id'  ORDER BY p.id DESC";
$PageVal1 = DisplayPages($QR_PAGES1, 50, $Page, $SrchQ);
	
?>


    <?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
    <?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
    <?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    
    <style>
        .modal-backdrop {
                position: inherit !important;
        }
    </style>
 <!--**********************************
            Content body start
        ***********************************-->
       <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                 <div class="row">
                  <div class="col-lg-12">
                     <div class="iq-card">
                        <div class="iq-card-body p-0">
                           <div class="iq-edit-list">
                              <ul class="iq-edit-profile d-flex nav nav-pills">
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link active " data-toggle="pill" href="#Buy">
                                    Give Help
                                    </a>
                                 </li>
                                 <li class="col-md-3 p-0">
                                    <a class="nav-link" data-toggle="pill" href="#Sell">
                                   Take Help
                                    </a>
                                 </li>
                                 <!--   <li class="col-md-3 p-0">-->
                                 <!--   <a class="nav-link " data-toggle="pill" href="#HeplHistory">-->
                                 <!--   Give Help History-->
                                 <!--   </a>-->
                                 <!--</li>-->
                                 
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="iq-edit-list-data">
                        <div class="tab-content">
                           <div class="tab-pane fade active show" id="Buy" role="tabpanel">
                               <?php echo get_message(); ?>
                              <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Give Help</h4>
                                    </div>
                                 </div>  
                                  <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                             <thead>
                                 <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                     <th>Whatsapp No</th>
                                    <th>Phonpe No</th>
                                    <th>Paytm No</th>
                                    <th>GooglePay No</th>
                                    <th>Amount</th>
                                  
                                    <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                   <?php 
                                        
                                        foreach($res as $r) {
                                      //  PrintR($r);
                                        $count = str_word_count($r['first_name']);
                                        $acronym = '';
                                        if($count > 1)
                                        {
                                            foreach(explode(' ', $r['first_name']) as $word) $acronym .= mb_substr($word, 0, 1, 'utf-8');
                                            
                                            
                                            $acronym  = substr($acronym,0,  2); 
                                        }
                                        else
                                        {
                                            $acronym  = substr($r['first_name'],0,  2); 
                                        }
                                        $amount      = $r['amount'];
                                        $adjust_amt  = $r['adjust_amt'];
                                        
                                        $net = $amount - $adjust_amt;
                                        if($net > 0 )
                                        {
                                         ?>
                                 <tr>
                                     <td><?php echo strtoupper($r['user_id']);?> </td>
                                    <td><?php echo strtoupper($r['first_name']);?> </td>
                                      <td><?php echo $r['member_mobile'];?></td>
                                    <td><?php echo $r['phonepay'];?></td>
                                    <td><?php echo $r['googlepay'];?></td>
                                    <td><?php echo $r['paytm'];?></td>
                                    <td><?php echo    '₹ '.$net;?></td>
                                   
                                    <td>
                                       <div class="flex align-items-center list-user-action">
                                           <?php if($r['bank_name'] != '' and $r['bank_acct_holder'] != '' and $r['account_number'] != '' and $r['ifc_code'] != '') { ?>
                                           <button class="btn btn-rounded btn-success"  data-toggle="modal" data-target="#basicModal<?php echo $r['id'];?>" >IMPS</button>
                                         
                                        	<?php } if($r['phonepay'] != '' ) { ?>
                                         
                                         
                                          <button class="btn btn-rounded btn-danger"  data-toggle="modal" data-target="#basicModal<?php echo $r['id'];?>" >Phone Pay</button>
                                          	<?php } if($r['googlepay'] != '' ) { ?>
                                         <button class="btn btn-rounded btn-warning"  data-toggle="modal" data-target="#basicModal<?php echo $r['id'];?>" >Google Pay</button>
                                         	<?php } if($r['paytm'] != '' ) { ?>
                                         <button class="btn btn-rounded btn-primary"  data-toggle="modal" data-target="#basicModal<?php echo $r['id'];?>" >Paytm</button>
                                   	<?php }   ?>
                                      
                                       </div>
                                    </td>
                                 </tr>
                                   <div class="modal fade bd-example-modal-lg" id="basicModal<?php echo $r['id'];?>" tabindex="-1" role="dialog"  aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">A/c Detail</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body">
                                   <form  enctype="multipart/form-data" method="post" class="needs-validation">
                              <div class="row">
                                  
                                  	<?php if($r['bank_name'] != '' and $r['bank_acct_holder'] != '' and $r['account_number'] != '' and $r['ifc_code'] != '') { ?>
                                 <div class="form-group col-md-3">
                                    <label for="fname">A/c Holder Name</label>
                                     <input type="text" readonly class="form-control" value="<?php echo  strtoupper($r['bank_name']);?>">
                                 
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label for="lname">Bank Name</label>
                                    <input type="text" readonly class="form-control" value="<?php echo  strtoupper($r['bank_acct_holder']);?>">
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label for="add1">A/c Number</label>
                                    <input type="text" readonly class="form-control" value="<?php echo  strtoupper($r['account_number']);?>">
                                 </div>
                                 <div class="form-group col-md-3">
                                    <label for="add2">IFSC Code</label>
                                   <input type="text" readonly class="form-control" value="<?php echo  strtoupper($r['ifc_code']);?>">
                                 </div>
                                 <?php } if($r['phonepay'] != '' ) { ?>
                                 
                                   <div class="form-group col-md-4">
                                    <label for="lname">PhonePe</label>
                                    <input type="text" readonly class="form-control" value="<?php echo  strtoupper($r['phonepay']);?>">
                                 </div>
  <?php } if($r['googlepay'] != '' ) { ?>
  
     <div class="form-group col-md-4">
                                    <label for="fname">Googlepay</label>
                                   <input type="text" readonly class="form-control" value="<?php echo  strtoupper($r['googlepay']);?>">
                                 </div>
  <?php } if($r['paytm'] != '' ) { ?>
  
    <div class="form-group col-md-4">
                                    <label for="add1">Paytm</label>
                                     <input type="text" readonly class="form-control" value="<?php echo  strtoupper($r['paytm']);?>">
                                 </div>
 <?php }   ?>
                                   
                               
                               
                                
                                 <div class="form-group col-md-6">
                                    <label for="mobno"><strong>Amount</strong></label>
                                    <input placeholder="Amount" id="Amount" name="amount" autocomplete="off" class="form-control" type="number" value="<?php echo  strtoupper($net);?>"  required="">
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="altconno"><strong>Transaction Id</strong></label>
                                   <input placeholder="Transaction Id" id="transaction_id" name="transaction_id" autocomplete="off"   class="form-control" type="text" value="" required="">
                      
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label for="email">Upload Slip</label>
                                     <input  name="slip"      type="file" accept="image/*"  required="">
                                 </div>
                                
                              </div>
                           
                               <input type="hidden" name="orderId" value="<?php echo _e($r['id']);?>">
								<button  class="btn btn-primary btn-lg btn-block"  type="submit" >Buy Now</button>	
                           </form>
                                    </div>
                                
                                 </div>
                              </div>
                           </div>
                                 
                                 
                                 
                            <?php }} ?>
                             </tbody>
                           </table>
                           </div>
                            <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Give Help  History</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <div class="table-responsive">
                              <table id="datatable" class="table table-striped table-bordered" style="display:none;" >
                              <thead>
                       <tr>
                            <th>Date</th>
                            <th>OrderId</th>
                            <th>Buyer  </th>
                            <th>Seller</th>   
                            <th>Amount</th>
                            <th>Slip</th>
                            <th>Status</th>                     
                        </tr>
 
                     </thead>
                      <tbody>  <?php 
									if($PageVal1['TotalRecords'] > 0){
									$Ctrl1=1;
									$i1=1;
									foreach($PageVal1['ResultSet'] as $AR_DT1):
									    
                                    
                                   
									    
								?>
							 
							 
                                      <tr  class="odd" role="row" >
                                        
                                      <td class="sorting_1"><?php echo date('d-F:Y h:i A',strtotime($AR_DT1['date_time'])); ?></td>
                                      <td>#21000<?php echo $AR_DT1['id'];?></td>
                                      <td class="sorting_1"><?php echo $AR_DT1['buyerName']; ?> [ <?php echo $AR_DT1['byuerId']; ?> ]</td>
                                      <td class="sorting_1"><?php echo $AR_DT1['senderName']; ?> [ <?php echo $AR_DT1['senderId']; ?> ]</td>
                                    
                                      <td class="sorting_1"> <?php echo CURRENCY.' '.  number_format($AR_DT1['amount'],2); ?></td>
                                      <td><a href="<?php echo BASE_PATH;?>upload/p2p/<?php echo $AR_DT1['slips'];?>" target="_blank" >View...</a></td>
                                      <td>
                                          <?php if($AR_DT1['status'] =='Y') { ?>
                                           <span class="btn btn-lg btn-success arrowed-in arrowed-in-right">Success</span>
                                          <?php } elseif($AR_DT1['status'] =='N') { ?>
                                         <a href="<?php echo BASE_PATH;?>admin/users/buyHistory/A/<?php echo _e($AR_DT1['id']);?>" class="btn btn-success btn-xxs"   >Approve</a>
                                           <a href="<?php echo BASE_PATH;?>admin/users/buyHistory/R/<?php echo _e($AR_DT1['id']);?>"  class="btn btn-danger btn-xxs">Reject</a>
                                          <?php  } else { ?>
                                           <span class="btn btn-lg btn-danger arrowed-in arrowed-in-right">Reject</span>
                                          <?php } ?>
                                      </td>
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
                        <table id="datatable" class="table table-striped table-bordered" >
                                <thead>
                       <tr>
                            <th>Date</th>
                            <th>OrderId</th>
                            <th>Transaction Id</th>
                            <th>Amount</th>
                              <th>Seller ID</th>
                             <th>Slip</th>   
                            <th>Status</th>   
                            <!--<th>Remark</th>   -->
                        </tr>

                            
                     </thead>
   <tbody>  <?php 
   
   
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									 //   PrintR($AR_DT);
								?>
						 
                                      <tr  class="odd" role="row" style="<?php if($AR_DT['member_id'] == $member_id) {?>     background: #70b96f;<?php }else{ ?> background: #ec6c72;  <?php } ?>">
                                        
                                      <td class="sorting_1"><?php echo date('d-F:Y h:i A',strtotime($AR_DT['date_time'])); ?></td>
                                      <td>#21000<?php echo $AR_DT['id'];?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['trans_id']; ?></td>
                                      <td class="sorting_1"><?php echo CURRENCY.' '.  number_format($AR_DT['amount'],2); ?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['senderName']; ?> [ <?php echo $AR_DT['senderId']; ?> ]</td>
                                      <td><a href="<?php echo BASE_PATH;?>upload/p2p/<?php echo $AR_DT['slips'];?>" target="_blank" >View...</a></td>
                                      <!--<td>-->
                                      <!--    <?php if($AR_DT['status'] =='Y') { ?>-->
                                      <!--     <span class="btn btn-primary btn-xxs">Success</span>-->
                                      <!--    <?php } elseif($AR_DT['status'] =='N') { ?>-->
                                      <!--    <?php if($AR_DT['member_id'] != $member_id) {?>-->
                                      <!--     <a href="<?php echo BASE_PATH;?>member/p2pStatus/A/<?php echo _e($AR_DT['id']);?>" class="btn btn-success btn-xxs"   >Approve</a>-->
                                      <!--     <a href="<?php echo BASE_PATH;?>member/p2pStatus/R/<?php echo _e($AR_DT['id']);?>" class="btn btn-danger btn-xxs"   >Reject</a>-->
                                           
                                      <!--      <?php } else { ?>-->
                                      <!--     <span class="btn btn-warning btn-xxs">Pending</span>-->
                                      <!--    <?php }} else { ?>-->
                                      <!--     <span class="btn btn-danger btn-xxs">Reject</span>-->
                                      <!--    <?php } ?>-->
                                      <!--</td>-->
                                      
                                       <td>
                                          <?php if($AR_DT['status']== 'Y' ) { ?>
                                           <span class="btn btn-primary btn-xxs">Success</span>
                                          <?php } elseif($AR_DT['status'] =='R') { ?>
                                          <span class="btn btn-danger btn-xxs">Reject</span>
                                          
                                          <?php }else { ?>
                                            <span class="btn btn-warning btn-xxs">Pending</span>
                                          <?php } ?>
                                      </td>
                                      
                                      
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
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal1['RecordStart']+1; ?> to <?php echo  count($PageVal1['ResultSet']); ?> of <?php echo $PageVal1['TotalRecords']; ?> entries
</div></div>

<div class="col-md-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal1['FirstPage'].$PageVal1['Prev10Page'].$PageVal1['PrevPage'].$PageVal1['NumString'].$PageVal1['NextPage'].$PageVal1['Next10Page'].$PageVal1['LastPage'];?>
                                  </ul> </nav>
                                  
                                   </div></div>
                           </div>
                        </div>
                     </div>
                          
                        </div>
                         <div class="tab-pane fade" id="Sell" role="tabpanel">
                              <div class="iq-card">
                                 <div class="iq-card-header d-flex justify-content-between">
                                    <div class="iq-header-title">
                                       <h4 class="card-title">Take Help</h4>
                                    </div>
                                 </div>
                                 <div class="iq-card-body">
                                   
                            
                              <form  enctype="multipart/form-data" method="post" class="needs-validation">
                            <div class="card-body">
								<div class="row text-center">
								   
									
									
								 
								 <div class="col-12 mb-3">
										<div class="bgl-primary rounded p-3">
										 <div class="mb-3">
                            <label class="mb-1"><strong>My Wallet</strong></label>
                                <input  readonly value="<?php echo $LDGR['net_balance'];?>" class="form-control"  >
                            </div>
                            
                             <div class="mb-3">
                            <label class="mb-1"><strong>Sale</strong></label>
                                <input placeholder="Sale Amount" id="sale_amount" name="sale_amount" autocomplete="off"   class="form-control" type="text" value="" required="">
                            </div>
                            <!--<a href="#" class="btn btn-outline-success btn-xxs"   onclick="document.getElementById('sale_amount').value='<?php echo number_format($LDGR['net_balance']*25/100, 2, ".", "") ;?>'" >25%</a>-->
                            <!--<a href="#" class="btn btn-outline-success btn-xxs"   onclick="document.getElementById('sale_amount').value='<?php echo number_format($LDGR['net_balance']*50/100, 2, ".", "") ;?>'" >50%</a>-->
                            <!--<a href="#" class="btn btn-outline-success btn-xxs"   onclick="document.getElementById('sale_amount').value='<?php echo number_format($LDGR['net_balance']*75/100, 2, ".", "") ;?>'" >75%</a>-->
                            <!--<a href="#" class="btn btn-outline-success btn-xxs"   onclick="document.getElementById('sale_amount').value='<?php echo number_format($LDGR['net_balance']*100/100, 2, ".", "") ;?>'" >100%</a>-->
									
									
									
										</div>
									</div>
								</div>
                            </div>
							<div class="card-footer mt-0">		
							    <input type="hidden" name="sold_type" value="SOLD">
							    <div class="card-body">
							    	<a  class="btn btn-rounded btn-info" href="<?php echo BASE_PATH;?>member/p2pSaleHistory"  >Sell History</a>		
								<button  class="btn btn-rounded btn-primary"  type="submit" >Sale Now</button>		
								</div>
                            </div>
                            
                            </form>
                        
                                 </div>
                              </div>
                                <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">P2P Take Help History</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <div class="table-responsive">
                              <table id="datatable" class="table table-striped table-bordered" style="display:none;">
                                <thead>
                       <tr>
                            <th>Date</th>
                            <th>OrderId</th>
                            <th>Transaction Id</th>
                            <th>Amount</th>
                             <th>Slip</th>   
                            <th>Status</th>                     
                        </tr>

                            
                     </thead>
   <tbody>  <?php 
   
   
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									 //   PrintR($AR_DT);
								?>
						 
                                      <tr  class="odd" role="row" style="<?php if($AR_DT['member_id'] == $member_id) {?>     background: #70b96f;<?php }else{ ?> background: #ec6c72;  <?php } ?>">
                                        
                                      <td class="sorting_1"><?php echo date('d-F:Y h:i A',strtotime($AR_DT['date_time'])); ?></td>
                                      <td>#21000<?php echo $AR_DT['id'];?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['trans_id']; ?></td>
                                      <td class="sorting_1"><?php echo CURRENCY.' '.  number_format($AR_DT['amount'],2); ?></td>
                                      <td><a href="<?php echo BASE_PATH;?>upload/p2p/<?php echo $AR_DT['slips'];?>" target="_blank" >View...</a></td>
                                      <!--<td>-->
                                      <!--    <?php if($AR_DT['status'] =='Y') { ?>-->
                                      <!--     <span class="btn btn-primary btn-xxs">Success</span>-->
                                      <!--    <?php } elseif($AR_DT['status'] =='N') { ?>-->
                                      <!--    <?php if($AR_DT['member_id'] != $member_id) {?>-->
                                      <!--     <a href="<?php echo BASE_PATH;?>member/p2pStatus/A/<?php echo _e($AR_DT['id']);?>" class="btn btn-success btn-xxs"   >Approve</a>-->
                                      <!--     <a href="<?php echo BASE_PATH;?>member/p2pStatus/R/<?php echo _e($AR_DT['id']);?>" class="btn btn-danger btn-xxs"   >Reject</a>-->
                                           
                                      <!--      <?php } else { ?>-->
                                      <!--     <span class="btn btn-warning btn-xxs">Pending</span>-->
                                      <!--    <?php }} else { ?>-->
                                      <!--     <span class="btn btn-danger btn-xxs">Reject</span>-->
                                      <!--    <?php } ?>-->
                                      <!--</td>-->
                                      
                                       <td>
                                          <?php if($AR_DT['adjust_amt'] >1 ) { ?>
                                           <span class="btn btn-primary btn-xxs">Success</span>
                                          <?php } elseif($AR_DT['status'] =='R') { ?>
                                          <span class="btn btn-danger btn-xxs">Reject</span>
                                          
                                          <?php }else { ?>
                                            <span class="btn btn-warning btn-xxs">Pending</span>
                                          <?php } ?>
                                      </td>
                                      
                                      
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
                            <table id="datatable" class="table table-striped table-bordered" >
                              <thead>
                       <tr>
                            <th>Date</th>
                            <th>OrderId</th>
                            <th>Buyer  </th>
                            <th>Seller</th>   
                            <th>Amount</th>
                            <th>Slip</th>
                             <th>Trans ID/Remark</th>
                            <th>Status</th>                     
                        </tr>
 
                     </thead>
                      <tbody>  <?php 
									if($PageVal1['TotalRecords'] > 0){
									$Ctrl1=1;
									$i1=1;
									foreach($PageVal1['ResultSet'] as $AR_DT1):
									    
                                    
                                   
									    
								?>
							 
							 
                                      <tr  class="odd" role="row" >
                                        
                                      <td class="sorting_1"><?php echo date('d-F:Y h:i A',strtotime($AR_DT1['date_time'])); ?></td>
                                      <td>#21000<?php echo $AR_DT1['id'];?></td>
                                      <td class="sorting_1"><?php echo $AR_DT1['buyerName']; ?> [ <?php echo $AR_DT1['byuerId']; ?> ]</td>
                                      <td class="sorting_1"><?php echo $AR_DT1['senderName']; ?> [ <?php echo $AR_DT1['senderId']; ?> ]</td>
                                    
                                      <td class="sorting_1"> <?php echo CURRENCY.' '.  number_format($AR_DT1['amount'],2); ?></td>
                                      <td><a href="<?php echo BASE_PATH;?>upload/p2p/<?php echo $AR_DT1['slips'];?>" target="_blank" >View...</a></td>
                                       <td class="sorting_1"> <?php echo $AR_DT1['trans_id']; ?></td>
                                      <td>
                                          <?php if($AR_DT1['status'] =='Y') { ?>
                                           <span class="btn btn-lg btn-success arrowed-in arrowed-in-right">Success</span>
                                          <?php } elseif($AR_DT1['status'] =='N') { ?>
                                         <a href="<?php echo BASE_PATH;?>member/account/buyHistory/A/<?php echo _e($AR_DT1['id']);?>" class="btn btn-success btn-xxs"   >Approve</a>
                                           <a href="<?php echo BASE_PATH;?>member/account/buyHistory/R/<?php echo _e($AR_DT1['id']);?>"  class="btn btn-danger btn-xxs">Reject</a>
                                          <?php  } else { ?>
                                           <span class="btn btn-lg btn-danger arrowed-in arrowed-in-right">Reject</span>
                                          <?php } ?>
                                      </td>
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
                           
                             <div class="tab-pane fade " id="HeplHistory" role="tabpanel">
                               <?php echo get_message(); ?>
                            
                            <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Give Help  History</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <div class="table-responsive">
                              <table id="datatable" class="table table-striped table-bordered" >
                              <thead>
                       <tr>
                            <th>Date</th>
                            <th>OrderId</th>
                            <th>Buyer  </th>
                            <th>Seller</th>   
                            <th>Amount</th>
                            <th>Slip</th>
                            <th>Status</th>                     
                        </tr>
 
                     </thead>
                      <tbody>  <?php 
									if($PageVal1['TotalRecords'] > 0){
									$Ctrl1=1;
									$i1=1;
									foreach($PageVal1['ResultSet'] as $AR_DT1):
									    
                                    
                                   
									    
								?>
							 
							 
                                      <tr  class="odd" role="row" >
                                        
                                      <td class="sorting_1"><?php echo date('d-F:Y h:i A',strtotime($AR_DT1['date_time'])); ?></td>
                                      <td>#21000<?php echo $AR_DT1['id'];?></td>
                                      <td class="sorting_1"><?php echo $AR_DT1['buyerName']; ?> [ <?php echo $AR_DT1['byuerId']; ?> ]</td>
                                      <td class="sorting_1"><?php echo $AR_DT1['senderName']; ?> [ <?php echo $AR_DT1['senderId']; ?> ]</td>
                                    
                                      <td class="sorting_1"> <?php echo CURRENCY.' '.  number_format($AR_DT1['amount'],2); ?></td>
                                      <td><a href="<?php echo BASE_PATH;?>upload/p2p/<?php echo $AR_DT1['slips'];?>" target="_blank" >View...</a></td>
                                      <td>
                                          <?php if($AR_DT1['status'] =='Y') { ?>
                                           <span class="btn btn-lg btn-success arrowed-in arrowed-in-right">Success</span>
                                          <?php } elseif($AR_DT1['status'] =='N') { ?>
                                         <a href="<?php echo BASE_PATH;?>admin/users/buyHistory/A/<?php echo _e($AR_DT1['id']);?>" class="btn btn-success btn-xxs"   >Approve</a>
                                           <a href="<?php echo BASE_PATH;?>admin/users/buyHistory/R/<?php echo _e($AR_DT1['id']);?>"  class="btn btn-danger btn-xxs">Reject</a>
                                          <?php  } else { ?>
                                           <span class="btn btn-lg btn-danger arrowed-in arrowed-in-right">Reject</span>
                                          <?php } ?>
                                      </td>
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
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal1['RecordStart']+1; ?> to <?php echo  count($PageVal1['ResultSet']); ?> of <?php echo $PageVal1['TotalRecords']; ?> entries
</div></div>

<div class="col-md-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal1['FirstPage'].$PageVal1['Prev10Page'].$PageVal1['PrevPage'].$PageVal1['NumString'].$PageVal1['NextPage'].$PageVal1['Next10Page'].$PageVal1['LastPage'];?>
                                  </ul> </nav>
                                  
                                   </div></div>
                           </div>
                        </div>
                     </div>
                          
                        </div>
                     </div>
                  </div>
               </div>
              
                  <div class="col-sm-12" style="z-index: -99999;">
                       
                   
                  </div>
               
            </div>
         </div>
        <!--**********************************
            Content body end
        ***********************************-->

    
            <?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>