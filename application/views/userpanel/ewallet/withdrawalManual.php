<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 $a = $this->uri->segment(3);
//echo $b = $this->uri->segment(3);
$segment1 = $this->uri->uri_to_assoc(2);



	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	$bankDetail = $model->getBankDetailMember($member_id);
    $account_number =   $bankDetail['account_number'];
    $ifc_code =   $bankDetail['ifc_code'];
    $bank_acct_holder =   $bankDetail['bank_acct_holder'];
    $withdrwal = $model->getmembersdetails($member_id);
    	$wallet_id = $model->getWallet(WALLET1);
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
	
?>  

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

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


if(($AR_ID['approved_sts'] =='1') &&( $AR_ADD['approved_sts'] =='1') && ($AR_ADD1['approved_sts'] =='1')){   ?>
	<div class="main-content">
        <section class="section">
          <div class="section-body">
            	<div class="row">
					    <div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Manual Withdrawal</div>
									<p class="card-text"> Available USD : $ <?php echo number_format($LDGR['net_balance']); ?> </p>
									</div>
									
								</div>
								<div class="card-body">
								      	 <?php  get_message(); ?>

            <form action="<?php echo BASE_PATH;?>member/ewallet/withdrawalManual" method="post" autocomplete="off">
     
  <?php
   $rand=rand();
  $this->session->set_userdata("rand",$rand);
  ?>
  <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
     <select name="wallet_id" id="wallet_id" class="validate[required]" style="display:none;">
								<option value="1" selected>E-wallet</option>
			 </select>
 
       
          <div class="form-group">
     <label for="amount">USD:</label>
     <input class="form-control" required="" id="draw_amount" name="draw_amount" placeholder="Please enter  Withdrawal Amount" data-toggle="tooltip" title="Please enter Transfer USD" type="number">
     </div>
           <div class="form-group">
     <label for="amount">Password:</label>
     <input class="form-control" required="" id="trns_password" name="trns_password" placeholder="Transaction Password" data-toggle="tooltip" title="Please enter Transaction Password" type="password">
     </div>
<?php if($withdrwal['Withdrawal_status']=='1'){ ?>
     
   <input type="hidden" name="submitform" id="submitform" value="1">
				<button type="submit" class="btn btn-primary">Submit</button>
<?php } 
//PrintR($withdrwal);
?>

          </form>
			
								</div>
							</div>
						</div>
						
					</div>
			
            
          </div>
        </section>
       
      </div>
		<?php }else{ ?>
	<script>
alert('Please Update Your Full Kyc!');
window.location.href='<?php echo BASE_PATH;?>member/account/myAccount';
</script>
<?php } ?>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
