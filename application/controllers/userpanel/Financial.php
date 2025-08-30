<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Financial extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	    
	   $mem_id =  $this->session->userdata('mem_id');
	    if(!$mem_id){
			redirect(BASE_PATH);		
		}
	}

	 
	public function depositwallet(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
	
		$this->load->view(MEMBER_FOLDER.'/financial/depositwallet',$data);
	}
	
	public function wallet(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
	
		$this->load->view(MEMBER_FOLDER.'/financial/wallet',$data);
	}
	
		public function commission(){
		    
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$this->load->view(MEMBER_FOLDER.'/financial/commission',$data);
	}
	
	public function withdraw(){



		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);
		$draw_amount = FCrtRplc($form_data['draw_amount']);
		$wallet_id = FCrtRplc($form_data['wallet_id']);
		
		$trns_password = FCrtRplc($form_data['trns_password']);
		$processor_id = FCrtRplc($form_data['processor_id']);
		
		

		
		if($processor_id==1){
			$btc_address = FCrtRplc($AR_MEM['bitcoin_address']);
			$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_WITHDRAWL_BITCOIN");
		}elseif($processor_id==2){
			$pm_account_type = FCrtRplc($AR_MEM['prft_account_type']);
			$pm_account = FCrtRplc($AR_MEM['prft_acc_number']);
			$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_WITHDRAWL_PERFECT");
		}else{
			$bank_name = FCrtRplc($AR_MEM['bank_name']);
			$bank_branch = FCrtRplc($AR_MEM['bank_address']);
			$bank_city = FCrtRplc($AR_MEM['bank_city']);
			$bank_state = FCrtRplc($AR_MEM['bank_state']);
			$bank_country = FCrtRplc($AR_MEM['bank_country']);
			
			$account_no = FCrtRplc($AR_MEM['account_number']);
			$swift_code = FCrtRplc($AR_MEM['swift_code']);
			$bank_zip_code = FCrtRplc($AR_MEM['bank_zipcode']);
			$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_WITHDRAWL_BANKWIRE");
		}
		
		if($form_data['requestWithdraw']!='' && $this->input->post()!=''){
		   
			$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
			if($member_id>0 && is_numeric($draw_amount) && $processor_id>=0){
				if($draw_amount>=$CONFIG_MIN_WITHDRAWL){
					if($model->checkOldPassword($member_id,$trns_password)>0){
						if($draw_amount<=$LDGR['net_balance']){
					
						
						$btc_address = FCrtRplc($btc_address);
						$pm_account = FCrtRplc($pm_account);
						$pm_account_type = FCrtRplc($pm_account_type);
						$bank_name = FCrtRplc($bank_name);
						$bank_branch = FCrtRplc($bank_branch);
						$bank_city = FCrtRplc($bank_city);
						$bank_state = FCrtRplc($bank_state);
						$bank_country = FCrtRplc($bank_country);
						
						$account_no = FCrtRplc($account_no);
						$swift_code = FCrtRplc($swift_code);
						$bank_zip_code = FCrtRplc($bank_zip_code);
						
						$trans_no = UniqueId("TRNS_NO");
						$wallet_id = FCrtRplc($wallet_id);
						$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
						
						$AR_PRC = $model->getProcessor($processor_id);
						$withdraw_fee_percent = 15;//($AR_PRC['withdraw_fee']>0)? $AR_PRC['withdraw_fee']:10;
						$withdraw_fee = ($draw_amount*$withdraw_fee_percent/100); 
						$process_fee = ($processor_id==0)? "0":"0";
						$total_charge = $withdraw_fee+$process_fee;
						$trns_amount = ($draw_amount-$total_charge);
						$trns_date = InsertDate(getLocalTime());
						
					
								$data = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$wallet_id,
									"initial_amount"=>$draw_amount,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>($withdraw_fee)? $withdraw_fee:0,
									"process_fee"=>$process_fee,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"MANUAL",
									"processor_id"=>$processor_id,
									"btc_address"=>($btc_address)? $btc_address:" ",
									"pm_account"=>($pm_account)? $pm_account:" ",
									"pm_account_type"=>($pm_account)? $pm_account_type:" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>($swift_code)? $swift_code:" ",
									"bank_zip_code"=>($bank_zip_code)? $bank_zip_code:" ",
									"trns_remark"=>"Withdrawal  Request from ".$AR_MEM['user_id'],
								);
								$userid =$AR_MEM['user_id'];
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
								$trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
							//	$model->wallet_transaction($wallet_id,"Dr",$member_id,$draw_amount,$trns_remark,$trns_date,$trans_no,"1","WITHDRAW");
								set_message("success","You have successfully request for withdrawal $StrMsg");
								redirect_member("financial","withdraw",array("error"=>"success"));
						
					
							
						}else{
							set_message("warning","Invalid amount, please check your  balance");
							redirect_member("financial","withdraw","");	
						}
					}else{
						set_message("warning","Invalid User password");
						redirect_member("financial","withdraw","");	
					}
				}else{
					set_message("warning","Enter the amount over and above  ".$CONFIG_MIN_WITHDRAWL." Rs ");
					redirect_member("financial","withdraw","");				
				}
			}else{
				set_message("warning","Invalid amount");
				redirect_member("financial","withdraw","");		
			}
		}
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/financial/withdraw',$data);
	






					
		
		
	}
	
	public function viewtransaction(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
	
		$this->load->view(MEMBER_FOLDER.'/financial/viewtransaction',$data);
	}
	
	public function payouttwallet(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');	
		
		$this->load->view(MEMBER_FOLDER.'/financial/payouttwallet',$data);
	}
	
	
	public function investincome(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/financial/investincome',$data);
	}
	
	
	
	
	
	public function cashaccount(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/financial/cashaccount',$data);
	}
	
	public function tradingaccount(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/financial/tradingaccount',$data);
	}
	
	public function inestmentaccount(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/financial/inestmentaccount',$data);
	}
	
	public function upgrademembership(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$LDGR = $model->getCurrentBalance($member_id,'','','');
		$AR_AD = $model->getAvailableAds($member_id);
		
		$AR_MEM = $model->getMember($member_id);

		$package_id = FCrtRplc($form_data['package_id']);
		$OLD_PACK = $model->getPackageDetail($AR_MEM['package_id']); 
		$AR_PACK = $model->getPackageDetail($package_id);
		$validity_day = $AR_PACK['validity_day'];
		$package_active_before = $AR_PACK['package_active_before'];
		$today = getLocalTime();
		$date_from = InsertDate($today);
		$date_expire = InsertDate(AddToDate($date_from,"+$validity_day Day"));
		$bonus_active_from = InsertDate(AddToDate($date_from,"+$package_active_before Day"));
		$order_no = UniqueId("ORDER_NO");
		$package_price = abs($AR_PACK['package_price']-$OLD_PACK['package_price']);
		if($form_data['upgradeMembership']==1 && $this->input->post()!=''){
			if($package_id>$AR_MEM['package_id']){
				if($LDGR['net_balance']>=$package_price && $LDGR['net_balance']>0){
					$data = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"package_id"=>$AR_PACK['package_id'],
						"package_price"=>$AR_PACK['package_price'],
						"date_from"=>$date_from,
						"date_expire"=>$date_expire,
						"click_per_day"=>$AR_PACK['user_credit'],
						"bonus_click_per_day"=>0,
						"total_click_per_day"=>$AR_PACK['package_credit']
					);
					$trns_amount = $package_price+$AR_PACK['state_tax'];
					$ads_credit = $AR_PACK['package_credit']-$AR_AD['ad_credit_bal'];
					$this->SqlModel->insertRecord(prefix."tbl_subscription",$data);
					$this->SqlModel->updateRecord(prefix."tbl_members",array("package_id"=>$package_id),array("member_id"=>$member_id));
					$model->wallet_transaction(0,"Dr",$member_id,$trns_amount,'Package Upgrade',$today,$order_no,"1");
					$model->ads_transaction($member_id,"Cr",$ads_credit,$trns_amount,'Package Upgrade',$today);
					$model->setMemberDirectIncome($AR_MEM['sponsor_id']);
					set_message("success","You have successfully upgraded your package");
					redirect_member("financial","upgrademembership",'');
				}else{
					set_message("warning","You don't have enough credit to upgrade this package");
					redirect_member("financial","upgrademembership",'');
				}
			}else{
				set_message("warning","Invalid , package selection");
				redirect_member("financial","upgrademembership",array("member_id"=>$member_id));
			}
		}
		
		$this->load->view(MEMBER_FOLDER.'/financial/upgrademembership',$data);
	}
	
	
	
	
	public function pendingreferrers(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		
		$this->load->view(MEMBER_FOLDER.'/financial/pendingreferrers',$data);
	}
	
		public function requestfund(){		
		$model = new OperationModel();
	
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = $this->OperationModel->getWallet(WALLET1);

		$CONFIG_MIN_FUND_TRANSFER = $model->getValue("CONFIG_MIN_FUND_TRANSFER");
		$today_date = getLocalTime();
		$AR_MEM = $model->getMember($member_id);
	
		
		if($form_data['submitFundRequest']==1 && $this->input->post()!=''){
		        $trns_password = FCrtRplc($form_data['trns_password']);
				$initial_amount = FCrtRplc($form_data['initial_amount']);
				$trns_remark = FCrtRplc($form_data['trns_remark']);
			//	$trns_date = InsertDate($today_date);
				

				if($initial_amount>=$CONFIG_MIN_FUND_TRANSFER){
				
						if($model->checkOldPassword($member_id,$trns_password)>0){
					
							$photo ='';
						if($_FILES['uploadfile']['error']=="0"){
				$ext = explode(".",$_FILES['uploadfile']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/requestfile/".$photo;
				
				

			
				move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target_path);
						}
			
					
								$data = array(
								    "member_id"=>$member_id,
								    "user_id"=>$AR_MEM['user_id'],
									"request_amount"=>$initial_amount,
									"remark"=>$trns_remark,
									"files"=>$photo,
									"date_time"=>$trns_date
									
								);
													
							
						
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_request",$data);
								set_message("success","You request has been send successfully please wait...");
								
								
								//set_message("success","Please verify OTP from your registered email address");
								redirect_member("financial","requestfund"); 
						
						}else{
							set_message("warning","Invalid transaction password, please try again");
							redirect_member("financial","requestfund","");
						}
				
				}else{
					set_message("warning","Enter the amount over and above  ".$CONFIG_MIN_FUND_TRANSFER." USD ");
					redirect_member("financial","requestfund","");
				}
		
		}
	
		
		$this->load->view(MEMBER_FOLDER.'/financial/fundrequest',$data);
	}
	public function transferfund(){		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = $this->OperationModel->getWallet(WALLET1);

		$CONFIG_MIN_FUND_TRANSFER = $model->getValue("CONFIG_MIN_FUND_TRANSFER");
		$today_date = getLocalTime();
		$AR_MEM = $model->getMember($member_id);
		$trns_password = FCrtRplc($form_data['trns_password']);
		$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
		
		
		if($form_data['submitFundRequest']==1 && $this->input->post()!=''){
				$to_member_id = $model->getMemberId($form_data['user_id']);
				$processor_id = $model->getDefaultProcessor();
				$AR_PRC = $model->getProcessor($processor_id);
				$deposit_fee_percent = $AR_PRC['deposit_fee'];

				
				$initial_amount = FCrtRplc($form_data['initial_amount']);
				$trns_remark = FCrtRplc($form_data['trns_remark']);
				$trns_type = FCrtRplc($form_data['trns_type']);
				$trns_date = InsertDate($today_date);
				
				$WITDRAW_FEE = 0;
				
				$PROCESS_FEE = ($initial_amount*$process_fee_percent/100);
				
				$admin_charge = 0;
				$total_charge = ($admin_charge+$WITDRAW_FEE+$DEPOSITE_FEE+$PROCESS_FEE);
				$trns_amount = ($initial_amount-$total_charge);
				if($to_member_id>0){
				if($initial_amount>=$CONFIG_MIN_FUND_TRANSFER){
					if($LDGR['net_balance']>=$trns_amount && $LDGR['net_balance']>0 && $trns_amount>0){
						if($model->checkOldPassword($member_id,$trns_password)>0){
							if($to_member_id!=$member_id){
							
							
			
						$trans_no = UniqueId("TRNS_NO");
				
						
						
					
								$data = array(
								    "to_member_id"=>$to_member_id,
									"from_member_id"=>$member_id,
									"trans_no"=>$trans_no,
									"wallet_id"=>'1',
									"initial_amount"=>$initial_amount,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>($WITDRAW_FEE)? $WITDRAW_FEE:0,
									"process_fee"=>$PROCESS_FEE,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"C",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"Transfer",
									"draw_type"=>"TRANSFER",
									"processor_id"=>'0',
									"trns_remark"=>$trns_remark,
								);
								
							
								$userid =$form_data['user_id'];
								$trns_remark = "E-Wallet Transfer FROM [".$userid."]";
								
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer_wallet",$data);
								$model->ewallet_transaction('1',"Dr",$member_id,$trns_amount,$trns_remark,$trns_date,$trans_no,"1","TRANSFER");
								$userid = $AR_MEM['user_id'];
								$trns_remark = "E-Wallet Recieve FROM [".$userid."]";
								//$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer_wallet",$data1);
								$model->ewallet_transaction('1',"Cr",$to_member_id,$trns_amount,$trns_remark,$trns_date,$trans_no,"1","TRANSFER");
								
								set_message("success","You have successfully Transfer in  E-wallet $to_member_id");
								
								
								//set_message("success","Please verify OTP from your registered email address");
								redirect_member("financial","transferfund",array("request_id"=>_e($request_id))); 
							}else{
								set_message("warning","You cannot send fund to your own id");
								redirect_member("financial","transferfund","");
							}
						}else{
							set_message("warning","Invalid transaction password, please try again");
							redirect_member("financial","transferfund","");
						}
					}else{
						set_message("warning","It seem  you have low balance to transfer fund");
						redirect_member("financial","transferfund","");
					}
				}else{
					set_message("warning","Enter the amount over and above  ".$CONFIG_MIN_FUND_TRANSFER." USD ");
					redirect_member("financial","transferfund","");
				}
			}else{
				set_message("warning","Invalid member id , please enter valid");
				redirect_member("financial","transferfund","");
			}
		}
		if($form_data['verifyOTP']!='' && $this->input->post()!=''){
				$request_id = _d($form_data['request_id']);
				$sms_otp = FCrtRplc($form_data['sms_otp']);
				$AR_TYPE = $model->verifySMSOTP($request_id,$sms_otp);
			
				$NEW_VAL = json_decode($AR_TYPE['new_value'],true);
				$trns_amount = FCrtRplc($NEW_VAL['trns_amount']);
				$from_member_id = FCrtRplc($NEW_VAL['from_member_id']);
				$from_user_id = $model->getMemberUserId($from_member_id);
				
				$to_member_id = FCrtRplc($NEW_VAL['to_member_id']);
				$to_user_id = $model->getMemberUserId($to_member_id);
				
				$initial_amount = FCrtRplc($NEW_VAL['initial_amount']);
				
				$withdraw_fee = FCrtRplc($NEW_VAL['withdraw_fee']);
				$process_fee = FCrtRplc($NEW_VAL['process_fee']);
				$admin_charge = FCrtRplc($NEW_VAL['admin_charge']);
				
				$trns_remark_to = $trns_remark = "FUND TRANSFER TO[".$to_user_id."]&nbsp;". strtoupper($NEW_VAL['trns_remark']);
				$trns_remark_from = "FUND RECEIVED FROM[".$from_user_id."]&nbsp;". strtoupper($NEW_VAL['trns_remark']);
				$trns_status = FCrtRplc($NEW_VAL['trns_status']);
				$status_up_date = ($NEW_VAL['status_up_date']);
				
				$trns_for = ($NEW_VAL['trns_for']);
				$draw_type = ($NEW_VAL['draw_type']);
				
				
				$trans_no = UniqueId("TRNS_NO");
				$trans_no_to = UniqueId("TRNS_NO");
				if($AR_TYPE['request_id']>0){
					if($LDGR['net_balance']>=$trns_amount && $LDGR['net_balance']>0 && $trns_amount>0){
						
						$data = array("wallet_id"=>($wallet_id>0)? $wallet_id:0,
							"trans_no"=>$trans_no,
							"from_member_id"=>$from_member_id,
							"to_member_id"=>$to_member_id,
							"initial_amount"=>$initial_amount,
							"withdraw_fee"=>($withdraw_fee)? $withdraw_fee:0,
							"deposit_fee"=>($deposite_fee)? $deposite_fee:0,
							"process_fee"=>($process_fee)? $process_fee:0,
							"admin_charge"=>$admin_charge,
							"trns_amount"=>$trns_amount,
							"trns_remark"=>$trns_remark,
							"trns_type"=>"Tr",
							"trns_for"=>$trns_for,
							"trns_status"=>"C",
							"draw_type"=>$draw_type,
							"trns_date"=>$today_date
						);
						
						if(is_numeric($trns_amount) && $trns_amount>0){
							if($member_id>0){
									$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
									$model->wallet_transaction($wallet_id,"Dr",$from_member_id,$trns_amount,$trns_remark_to,$today_date,$trans_no);
									$model->wallet_transaction($trade_wallet_id,"Cr",$to_member_id,$trns_amount,$trns_remark_from,$today_date,$trans_no_to);
									$this->SqlModel->updateRecord(prefix."tbl_sms_otp",array("otp_sts"=>"1"),array("request_id"=>$AR_TYPE['request_id']));
									Send_Mail(array("member_id"=>$from_member_id,"amount"=>$trns_amount),"FUND_SENDER");
									Send_Mail(array("member_id"=>$to_member_id,"amount"=>$trns_amount),"FUND_RECIVER");
									set_message("success","Your transaction processed successfull");
									
									redirect_member("financial","viewtransaction",array("error"=>"success"));		
							}else{
								set_message("warning","Invalid member id");		
								redirect_member("financial","transferfund",array("request_id"=>_e($request_id)));
							}
						}else{
							set_message("warning","Invalid  amount");		
							redirect_member("financial","transferfund",array("request_id"=>_e($request_id)));
						}
					}else{
						set_message("warning","It seem  you have low balance to transfer your fund");
						redirect_member("financial","transferfund",array("request_id"=>_e($request_id)));
					}
			}else{
				set_message("warning","Invalid OTP, please enter valid OTP");
				redirect_member("financial","transferfund",array("request_id"=>_e($request_id)));
			}
		}
		
		$this->load->view(MEMBER_FOLDER.'/financial/transferfund',$data);
	}
	
	public function receivefund(){
		$today_date = getLocalTime();
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$this->load->view(MEMBER_FOLDER.'/financial/receivefund',$data);
	}
	
	public function subscription(){
		$today_date = getLocalTime();
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->session->unset_userdata('order_no');
		$member_id = $this->session->userdata('mem_id');
		$this->load->view(MEMBER_FOLDER.'/financial/subscription',$data);
	}
	
	public function paymenthistory(){
		$today_date = getLocalTime();
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$this->load->view(MEMBER_FOLDER.'/financial/paymenthistory',$data);
	}
	
	
	
	
	
	
}
