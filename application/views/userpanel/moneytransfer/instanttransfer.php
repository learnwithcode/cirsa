<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 $a = $this->uri->segment(3);
//echo $b = $this->uri->segment(3);
$segment1 = $this->uri->uri_to_assoc(2);



	$model = new OperationModel();
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	$bankDetail = $model->getBankDetailMember($member_id);
    $account_number =   $bankDetail['account_number'];
    $ifc_code =   $bankDetail['ifc_code'];
    $bank_acct_holder =   $bankDetail['bank_acct_holder'];
    $withdrwal = $model->getmembersdetails($member_id);
    
	$LDGR = $model->getCurrentBalance($member_id,1,$_REQUEST['from_date'],$_REQUEST['to_date']);	
	
	 
  $QR_PAGES= "SELECT R.*,M.first_name as name , M.user_id as uid   FROM `tbl_money_transfer` as R LEFT JOIN tbl_members as M on M.member_id = R.member_id WHERE  R.sender_id > 0  and R.member_id ='$member_id'   order by  R.sender_id desc";
$PageVal = DisplayPages($QR_PAGES,50,$Page,$SrchQ); 
?>  

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead' ); ?>
    <?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    
    	 <?php

$AR_ID = $model->memberKycDoucment($member_id,"PAN CARD");
$id_document_src = $model->kycDocument($AR_ID['kyc_id']);

$AR_ADD = $model->memberKycDoucment($member_id,"ADHAR CARD FRONT");
$add_document_src1 = $model->kycDocument($AR_ADD['kyc_id']);


$AR_ADD1 = $model->memberKycDoucment($member_id,"ADHAR CARD BACK");
$add_document_src2 = $model->kycDocument($AR_ADD1['kyc_id']);

$AR_ADD3 = $model->memberKycDoucment($member_id,"CHEQUE");
$add_document_src3 = $model->kycDocument($AR_ADD3['kyc_id']);
//&& ($AR_ADD3['approved_sts'] =='1')

 if(($AR_ID['approved_sts'] =='1') &&( $AR_ADD['approved_sts'] =='1') && ($AR_ADD1['approved_sts'] =='1')  && $account_number !=''  && $ifc_code !=''  && $bank_acct_holder !='' ){   ?>
 <div class="content-page rtl-page">
      <div class="container-fluid">
         <div class="row">
           
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Bank Transfer </h4>
                          <code>Withdrawal price is  $1 =  ₹ 75 </code>
                     </div>
                     	
                  </div>
              <div class="card-head-row">
										<div class="card-title"></div>
								 <p class="card-text"> Available Balance : <code><?php echo number_format($LDGR['net_balance'],2); ?></code> </p>   
									</div>
								      	<?php echo get_message(); ?>
                  <div class="card-body">
                     
                        <form action="<?php echo BASE_PATH;?>member/moneytransfer/index" method="post">
     
  <?php
   $rand=rand();
  $this->session->set_userdata("rand",$rand);
  ?>
  <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    

   <div class="mb-3">
                    <label class="mb-1"><strong>Beneficiary Name</strong></label>
                    <input class="form-control" required="" placeholder="Please enter Beneficiary Name"   value="<?php echo $bank_acct_holder;?>" readonly type="text">     
                </div> 
   <div class="mb-3">
                    <label class="mb-1"><strong>Bank Account Number</strong></label>
                     <input class="form-control"  required=""  placeholder="Please enter account number"  value="<?php echo $account_number;?>" readonly  type="number">     
                </div>   
   <div class="mb-3">
                    <label class="mb-1"><strong>IFSC Code</strong></label>
                    <input class="form-control" required=""  placeholder="Please enter IFSC Code"  value="<?php echo $ifc_code;?>" readonly  type="text">
                </div>   
   <div class="mb-3">
                    <label class="mb-1"><strong>USD </strong></label>
                    <input class="form-control" required=""  onkeyup="setusd(this.value);" id="amount" name="amount" placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer USD" type="number">
                </div> 
   <div class="mb-3">
                    <label class="mb-1"><strong>Amount in INR </strong></label>
                    <input class="form-control" required="" id="inr"  readonly  placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer Amount" type="number">
                </div> 
   <div class="mb-3">
                    <label class="mb-1"><strong>Password </strong></label>
                    <input class="form-control" required="" id="trns_password" name="trns_password" placeholder="Transaction Password" data-toggle="tooltip" title="Please enter Transaction Password" type="password">
                </div>      
     
     
     
         
     <?php  if($model->getValue("Instant_status")=='Y'){
     if($model->getValue("instant_otp")=='true'){ ?> 
     
     <div class="mb-3">
                    <label class="mb-1"><strong>Verification Code </strong></label>
                     <div class="row">
                     <div class="col-md-8">
                      <input placeholder="Verification Code" name="otp" required="required" type="text" class="form-control">   
                     </div>
                     <div class="col-md-4">
                      <button style="margin-top:25px;padding:6px 20px 10px 20px;;" type="button" class="btn btn-info"><div class="v-btn__content" onclick="sendotp();">Send OTP
        </div></button>   
                     </div>
                      </div>
                      	
                    </div>
                       
     <?php }  }?>
     
<?php //if($withdrwal['Withdrawal_status']=='2'){ ?>
     
   <input type="hidden" name="submitform" id="submitform" value="1">
				<button type="submit" class="btn btn-primary">Submit</button>
<?php  // } 
//PrintR($withdrwal);
?>

          </form>
                   
                 
                  </div>
                  
                  
                    <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table  table-striped table-bordered" >
 
							 
							 

 <thead>
                    <tr>
                        
                             <th  class="center"> S.no </th>
                            <th  class="center"> Date </th>
                            <th >User ID </th>
                            <th>Trns No</th>
                            <th>Name</th>
                            <th>Number/A/c</th>
                            <th>Beneficiary Id/IFSC</th>
                            
                            <th >Amount</th>
                             <th >Charge</th>
                              <th >Total</th>
                            <th >Status</th>  
                            <!--<th >Action</th>-->
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=$PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):   //
						
			       ?>
                    <tr <?php if($AR_DT['status']=='Success'){echo 'class="success"';}else{ echo 'class="danger"';}?>>
                        <td data-title="Date"><?php echo $Ctrl; ?></td>
                      <td data-title="Date"><?php echo date('d-M-Y H:i:s',strtotime($AR_DT['date'])); ?></td>
                      <td data-title="User Id"><?php echo strtoupper($AR_DT['uid']); ?></td>
                        <td data-title="Trns Id"><?php echo strtoupper($AR_DT['orderid']); ?></td>
                      <td data-title="Name"><?php echo ($AR_DT['type'] =='1')?strtoupper($AR_DT['name']):strtoupper($AR_DT['ben_name']); ?> </td>
                       
                      
                      
                      
                        <td data-title="Number"><?php echo ($AR_DT['type'] =='1')? ($AR_DT['mobile']): ($AR_DT['account_number']);?> </td>
                    <td data-title="Beneficiary Id"><?php echo ($AR_DT['type'] =='1')? ($AR_DT['ben_id']):strtoupper($AR_DT['ifsc_code']); ?> </td>
                    
                       <td data-title="Amount"><?php echo number_format($AR_DT['amount']/75,2); ?></td>
                       <td data-title="Charge"><?php echo number_format($AR_DT['charge']/75,2); ?></td>
                       <td data-title="Total"><?php echo number_format($AR_DT['total']/75,2); ?></td>
                      
                      <td data-title="Status">
                          <?php if($AR_DT['manage_sts']=='N'){  ?>
                          <div class="badge badge-warning">Pending</div> 
                          <?php }else{  ?>
                           <?php if($AR_DT['status']=='Success'){  ?><div class="badge badge-success"><?php echo strtoupper($AR_DT['status']); ?></div> <?php }else{?> <div class="badge badge-danger"><?php echo strtoupper($AR_DT['status']); ?></div>  <?php }?>
                           
                           <?php } ?>
                           </td>
                    <!--   <td data-title="Action">
                        <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>
                           <ul class="dropdown-menu dropdown-default">
                             
                            <?php if($AR_DT['manage_status'] =='N'){ ?>
                             <li><a href="<?php echo BASE_PATH;?>superadmin/financial/manageDMT/<?php echo  $AR_DT['sender_id']; ?>" target="_blank">Manage DMT</a> </li>
                            <?php } ?>
                            
                           </ul>
                          </div>
                        
                         </td>-->
                    </tr>
                    <?php $Ctrl++; 
						endforeach; 
						}else{ ?>
                    <tr>
                      <td colspan="10" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No transaction found</td>
                    </tr>
                    <?php } ?>
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
		     
	   <script>
 
  
 function sendotp()
 {	var amount = document.getElementById("inr").value; 
    if(amount !='')
                {
                 jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/moneytransfer/sendOTP",
data: {amt: amount},
success: function(res) {
 
  alert('OTP send to your Register Mobile No.');

} });
		
			
                }   else
                {
                    alert('Please fill all feilds');
                }
 }
	    
	    
         function setusd(usd)
         {
              var amt = parseFloat(usd*75);
              var charge =0;// parseFloat(amt*2.5/100);
              var gst = 0;//parseFloat(charge*18/100);
              var total = parseFloat(amt+charge+gst);
             document.getElementById("inr").value= total;
         }
     </script>
	<?php   }else{ ?>
	<script>
alert('Please Update Your Full Kyc!');
window.location.href='<?php echo BASE_PATH;?>member/account/<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 $a = $this->uri->segment(3);
//echo $b = $this->uri->segment(3);
$segment1 = $this->uri->uri_to_assoc(2);



	$model = new OperationModel();
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	$bankDetail = $model->getBankDetailMember($member_id);
    $account_number =   $bankDetail['account_number'];
    $ifc_code =   $bankDetail['ifc_code'];
    $bank_acct_holder =   $bankDetail['bank_acct_holder'];
    $withdrwal = $model->getmembersdetails($member_id);
    
	$LDGR = $model->getCurrentBalance($member_id,1,$_REQUEST['from_date'],$_REQUEST['to_date']);	
	
	 
  $QR_PAGES= "SELECT R.*,M.first_name as name , M.user_id as uid   FROM `tbl_money_transfer` as R LEFT JOIN tbl_members as M on M.member_id = R.member_id WHERE  R.sender_id > 0  and R.member_id ='$member_id'   order by  R.sender_id desc";
$PageVal = DisplayPages($QR_PAGES,50,$Page,$SrchQ); 
?>  

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead' ); ?>
    <?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    
    	 <?php

$AR_ID = $model->memberKycDoucment($member_id,"PAN CARD");
$id_document_src = $model->kycDocument($AR_ID['kyc_id']);

$AR_ADD = $model->memberKycDoucment($member_id,"ADHAR CARD FRONT");
$add_document_src1 = $model->kycDocument($AR_ADD['kyc_id']);


$AR_ADD1 = $model->memberKycDoucment($member_id,"ADHAR CARD BACK");
$add_document_src2 = $model->kycDocument($AR_ADD1['kyc_id']);

$AR_ADD3 = $model->memberKycDoucment($member_id,"CHEQUE");
$add_document_src3 = $model->kycDocument($AR_ADD3['kyc_id']);
//&& ($AR_ADD3['approved_sts'] =='1')

 if(($AR_ID['approved_sts'] =='1') &&( $AR_ADD['approved_sts'] =='1') && ($AR_ADD1['approved_sts'] =='1')  && $account_number !=''  && $ifc_code !=''  && $bank_acct_holder !='' ){   ?>
 <div class="content-page rtl-page">
      <div class="container-fluid">
         <div class="row">
           
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Bank Transfer </h4>
                          <!--<code>Withdrawal price is  $1 =  ₹ 75 </code>-->
                     </div>
                     	
                  </div>
              <div class="card-head-row">
										<div class="card-title"></div>
								 <p class="card-text"> Available Balance : <code><?php echo number_format($LDGR['net_balance'],2); ?></code> </p>   
									</div>
								      	<?php echo get_message(); ?>
                  <div class="card-body">
                     
                        <form action="<?php echo BASE_PATH;?>member/moneytransfer/index" method="post">
     
  <?php
   $rand=rand();
  $this->session->set_userdata("rand",$rand);
  ?>
  <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    

   <div class="mb-3">
                    <label class="mb-1"><strong>Beneficiary Name</strong></label>
                    <input class="form-control" required="" placeholder="Please enter Beneficiary Name"   value="<?php echo $bank_acct_holder;?>" readonly type="text">     
                </div> 
   <div class="mb-3">
                    <label class="mb-1"><strong>Bank Account Number</strong></label>
                     <input class="form-control"  required=""  placeholder="Please enter account number"  value="<?php echo $account_number;?>" readonly  type="number">     
                </div>   
   <div class="mb-3">
                    <label class="mb-1"><strong>IFSC Code</strong></label>
                    <input class="form-control" required=""  placeholder="Please enter IFSC Code"  value="<?php echo $ifc_code;?>" readonly  type="text">
                </div>   
   <div class="mb-3">
                    <label class="mb-1"><strong>Amount </strong></label>
                    <input class="form-control" required=""   id="amount" name="amount" placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer USD" type="number">
                </div> 
   <!--<div class="mb-3">-->
   <!--                 <label class="mb-1"><strong>Amount in INR </strong></label>-->
   <!--                 <input class="form-control" required="" id="inr"  readonly  placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer Amount" type="number">-->
   <!--             </div> -->
   <div class="mb-3">
                    <label class="mb-1"><strong>Password </strong></label>
                    <input class="form-control" required="" id="trns_password" name="trns_password" placeholder="Transaction Password" data-toggle="tooltip" title="Please enter Transaction Password" type="password">
                </div>      
     
     
     
         
     <?php  if($model->getValue("Instant_status")=='Y'){
     if($model->getValue("instant_otp")=='true'){ ?> 
     
     <div class="mb-3">
                    <label class="mb-1"><strong>Verification Code </strong></label>
                     <div class="row">
                     <div class="col-md-8">
                      <input placeholder="Verification Code" name="otp" required="required" type="text" class="form-control">   
                     </div>
                     <div class="col-md-4">
                      <button style="margin-top:25px;padding:6px 20px 10px 20px;;" type="button" class="btn btn-info"><div class="v-btn__content" onclick="sendotp();">Send OTP
        </div></button>   
                     </div>
                      </div>
                      	
                    </div>
                       
     <?php }  }?>
     
<?php //if($withdrwal['Withdrawal_status']=='2'){ ?>
     
   <input type="hidden" name="submitform" id="submitform" value="1">
				<button type="submit" class="btn btn-primary">Submit</button>
<?php  // } 
//PrintR($withdrwal);
?>

          </form>
                   
                 
                  </div>
                  
                  
                    <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table  table-striped table-bordered" >
 
							 
							 

 <thead>
                    <tr>
                        
                             <th  class="center"> S.no </th>
                            <th  class="center"> Date </th>
                            <th >User ID </th>
                            <th>Trns No</th>
                            <th>Name</th>
                            <th>Number/A/c</th>
                            <th>Beneficiary Id/IFSC</th>
                            
                            <th >Amount</th>
                             <th >DMT Charge</th>
                              <th >Total</th>
                            <th >Status</th>  
                            <!--<th >Action</th>-->
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=$PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):   //
						
			       ?>
                    <tr <?php if($AR_DT['status']=='Success'){echo 'class="success"';}else{ echo 'class="danger"';}?>>
                        <td data-title="Date"><?php echo $Ctrl; ?></td>
                      <td data-title="Date"><?php echo date('d-M-Y H:i:s',strtotime($AR_DT['date'])); ?></td>
                      <td data-title="User Id"><?php echo strtoupper($AR_DT['uid']); ?></td>
                        <td data-title="Trns Id"><?php echo strtoupper($AR_DT['orderid']); ?></td>
                      <td data-title="Name"><?php echo ($AR_DT['type'] =='1')?strtoupper($AR_DT['name']):strtoupper($AR_DT['ben_name']); ?> </td>
                       
                      
                      
                      
                        <td data-title="Number"><?php echo ($AR_DT['type'] =='1')? ($AR_DT['mobile']): ($AR_DT['account_number']);?> </td>
                    <td data-title="Beneficiary Id"><?php echo ($AR_DT['type'] =='1')? ($AR_DT['ben_id']):strtoupper($AR_DT['ifsc_code']); ?> </td>
                    
                       <td data-title="Amount"><?php echo number_format($AR_DT['amount'],2); ?></td>
                       <td data-title="Charge"><?php echo number_format($AR_DT['charge'],2); ?></td>
                       <td data-title="Total"><?php echo number_format($AR_DT['total'],2); ?></td>
                      
                      <td data-title="Status">
                          <?php if($AR_DT['manage_sts']=='N'){  ?>
                          <div class="badge badge-warning">Pending</div> 
                          <?php }else{  ?>
                           <?php if($AR_DT['status']=='Success'){  ?><div class="badge badge-success"><?php echo strtoupper($AR_DT['status']); ?></div> <?php }else{?> <div class="badge badge-danger"><?php echo strtoupper($AR_DT['status']); ?></div>  <?php }?>
                           
                           <?php } ?>
                           </td>
                    <!--   <td data-title="Action">
                        <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>
                           <ul class="dropdown-menu dropdown-default">
                             
                            <?php if($AR_DT['manage_status'] =='N'){ ?>
                             <li><a href="<?php echo BASE_PATH;?>superadmin/financial/manageDMT/<?php echo  $AR_DT['sender_id']; ?>" target="_blank">Manage DMT</a> </li>
                            <?php } ?>
                            
                           </ul>
                          </div>
                        
                         </td>-->
                    </tr>
                    <?php $Ctrl++; 
						endforeach; 
						}else{ ?>
                    <tr>
                      <td colspan="10" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No transaction found</td>
                    </tr>
                    <?php } ?>
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
		     
	   <script>
 
  
 function sendotp()
 {	var amount = document.getElementById("inr").value; 
    if(amount !='')
                {
                 jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/moneytransfer/sendOTP",
data: {amt: amount},
success: function(res) {
 
  alert('OTP send to your Register Mobile No.');

} });
		
			
                }   else
                {
                    alert('Please fill all feilds');
                }
 }
	    
	    
         function setusd(usd)
         {
              var amt = parseFloat(usd*75);
              var charge =0;// parseFloat(amt*2.5/100);
              var gst = 0;//parseFloat(charge*18/100);
              var total = parseFloat(amt+charge+gst);
             document.getElementById("inr").value= total;
         }
     </script>
	<?php   }else{ ?>
	<script>
alert('Please Update Your Full Kyc!');
window.location.href='<?php echo BASE_PATH;?>member/account/updatekyc';
</script>
<?php  } ?>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
			
';
</script>
<?php  } ?>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
			
