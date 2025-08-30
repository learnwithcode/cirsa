<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
		#$this->SqlModel->checkCronJob();
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 	public function site_setting(){
		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
			//PrintR($form_data);
		if($form_data['submitSite_setting']==1 && $this->input->post()!=''){
               	 $model->setConfig("theme_day_night",FCrtRplc($form_data['theme_day_night']));
			
         
		
			
			set_message("success","Successfully updated changes");
		redirect_member("dashboard","index","");  
		}
		
	//	$this->load->view(ADMIN_FOLDER.'/setting/sitesetting',$data);
	
	}
	 
	public function index(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$QR_CHECK = "SELECT tm.*,    tm.member_mobile  AS mobile_number, tmsp.first_name AS spsr_first_name, 
		tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,	tree.nlevel, tree.left_right, tree.nleft, tree.nright,
		tree.date_join, tp.pin_name ,ts.* FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_subscription AS ts ON (tm.member_id=ts.member_id)
		 LEFT JOIN ".prefix."tbl_pintype AS tp ON ts.type_id=tp.type_id
		 WHERE tm.member_id='".$member_id."' 
		 ORDER BY tm.member_id ASC";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true); 

		if($form_data['updateMemberMobile']==1 && $this->input->post()!=''){
			$verify_code = FCrtRplc($form_data['verify_code']);
			$count_row = $model->checkMemberSms($member_id,$verify_code);
			if($count_row>0){
				$data_update = array("sms_sts"=>"Y");
				$this->SqlModel->updateRecord(prefix."tbl_members",$data_update,array("member_id"=>$member_id));
				set_message("success","Your mobile is  successfully verified");
				redirect_member("dashboard","",""); 
			}else{
				set_message("warning","Invalid mobile verifcation code");
				redirect_member("dashboard","",""); 
			}
		}
		
		if($form_data['submitMemberSaveTrnsPassword']==1 && $this->input->post()!=''){
			$old_password = FCrtRplc($form_data['current_tr_password']);
			$trns_password = FCrtRplc($form_data['new_tr_password']);
			$confirm_trns_password = FCrtRplc($form_data['new_tr_password_again']);	
			if($old_password!=$trns_password){
				 if(is_numeric($fetchRow['mobile_number'])){
						if($model->checkTrnsPassword($member_id,$old_password)>0){
								$sms_otp = $model->sendTransactionSMS($fetchRow['mobile_number']);
								$data = array("member_id"=>$member_id,
									"new_value"=>$trns_password,
									"sms_otp"=>$sms_otp,
									"sms_type"=>"TRNS",
									"mobile_number"=>$fetchRow['mobile_number']
								);
							$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
							set_message("success","Please verify OTP from your registered email address");
							redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id))); 
						}else{
							set_message("warning","Invalid transaction password");
							redirect_member("dashboard","",""); 
						}
				}else{
					set_message("warning","Please check  your mobile number is invalid");
					redirect_member("dashboard","",""); 
				}
			}else{
				set_message("warning","New password must be different form old-password");
				redirect_member("dashboard","",""); 
			}
		}
		
	
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		
		$data['ROW']=$fetchRow;
		
			$data['web_title'] = 'Dashboard';
		$this->load->view(MEMBER_FOLDER.'/dashboard',$data);
	}
	
		public function t2(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$QR_CHECK = "SELECT tm.*, CONCAT_WS('',tm.mobile_code,tm.member_mobile) AS mobile_number, tmsp.first_name AS spsr_first_name, 
		tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,	tree.nlevel, tree.left_right, tree.nleft, tree.nright,
		tree.date_join, tp.pin_name ,ts.* FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_subscription AS ts ON (tm.member_id=ts.member_id)
		 LEFT JOIN ".prefix."tbl_pintype AS tp ON ts.type_id=tp.type_id
		 WHERE tm.member_id='".$member_id."' 
		 ORDER BY tm.member_id ASC";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true); 
		
 
	
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		
		$data['ROW']=$fetchRow;
		$this->load->view(MEMBER_FOLDER.'/t2',$data);
	}
		public function test(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
	 
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		
		$data['ROW']=$fetchRow;
		$this->load->view(MEMBER_FOLDER.'/test',$data);
	}
	public function verifyotp(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(1);
		$member_id = $this->session->userdata('mem_id');
		$request_id = ($form_data['request_id'])? _d($form_data['request_id']):_d($segment['request_id']);
		$AR_MEM = $model->getMember($member_id);
		if($form_data['updateOTP']!='' && $this->input->post()!=''){
			$sms_otp = FCrtRplc($form_data['sms_otp']);
			$AR_TYPE = $model->verifySMSOTP($request_id,$sms_otp);
			
			$new_value = $AR_TYPE['new_value'];
			switch($AR_TYPE['sms_type']){
				case "TRNS":
					if($AR_TYPE['request_id']>0 && $AR_TYPE['mobile_number']!=''){
						$data = array("trns_password"=>$new_value);
						$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
						$this->SqlModel->updateRecord(prefix."tbl_sms_otp",array("otp_sts"=>"1"),array("request_id"=>$AR_TYPE['request_id']));
						set_message("success","Transaction password updated successfully");
						redirect(MEMBER_PATH);
					}else{
						static_message("warning","Invalid OTP , please try again");
						redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id),"error"=>"failed"));
					}
				break;
				case "MOBILE":
					if($AR_TYPE['request_id']>0 && $AR_TYPE['mobile_number']!=''){
						$AR_VALUE = json_decode($AR_TYPE['new_value'],true);
						$data = array("member_mobile"=>$AR_VALUE['member_mobile'],
								"mobile_code"=>$AR_VALUE['mobile_code'],
								"country_code"=>$AR_VALUE['country_code']);
						$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
						$this->SqlModel->updateRecord(prefix."tbl_sms_otp",array("otp_sts"=>"1"),array("request_id"=>$AR_TYPE['request_id']));
						set_message("success","You have successfully updated your mobile number");
						redirect(MEMBER_PATH);
					}else{
						static_message("warning","Invalid OTP , please try again");
						redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id),"error"=>"failed"));
					}
				break;
				case "EMAIL":
					if($AR_TYPE['request_id']>0 && $AR_TYPE['mobile_number']!=''){
						$data = array("member_email"=>$new_value);
						$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
						$this->SqlModel->updateRecord(prefix."tbl_sms_otp",array("otp_sts"=>"1"),array("request_id"=>$AR_TYPE['request_id']));
						set_message("success","You have successfully changed email address");
						redirect(MEMBER_PATH);
					}else{
						static_message("warning","Invalid OTP , please try again");
						redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id),"error"=>"failed"));
					}
				break;
				case "PWORD":
					if($AR_TYPE['request_id']>0 && $AR_TYPE['mobile_number']!=''){
						$data = array("user_password"=>$new_value);
						$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
						$this->SqlModel->updateRecord(prefix."tbl_sms_otp",array("otp_sts"=>"1"),array("request_id"=>$AR_TYPE['request_id']));
						set_message("success","Your password changed successfully");
						redirect(MEMBER_PATH);
					}else{
						static_message("warning","Invalid OTP , please try again");
						redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id),"error"=>"failed"));
					}
				break;
				case "TPWORD":
					if($AR_TYPE['request_id']>0 && $AR_TYPE['mobile_number']!=''){
						$data = array("trns_password"=>$new_value);
						$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
						$this->SqlModel->updateRecord(prefix."tbl_sms_otp",array("otp_sts"=>"1"),array("request_id"=>$AR_TYPE['request_id']));
						set_message("success","Your transaction password changed successfully");
						redirect(MEMBER_PATH);
					}else{
						static_message("warning","Invalid OTP , please try again");
						redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id),"error"=>"failed"));
					}
				break;
				case "WITDRAW":
					if($AR_TYPE['request_id']>0 && $AR_TYPE['mobile_number']!=''){
						$AR_WITH = json_decode($AR_TYPE['new_value'],true);
						$processor_id = $AR_WITH['processor_id'];
						$draw_amount = $AR_WITH['draw_amount'];
						
						$btc_address = FCrtRplc($AR_WITH['btc_address']);
						$pm_account = FCrtRplc($AR_WITH['pm_account']);
						$pm_account_type = FCrtRplc($AR_WITH['pm_account_type']);
						$bank_name = FCrtRplc($AR_WITH['bank_name']);
						$bank_branch = FCrtRplc($AR_WITH['bank_branch']);
						$bank_city = FCrtRplc($AR_WITH['bank_city']);
						$bank_state = FCrtRplc($AR_WITH['bank_state']);
						$bank_country = FCrtRplc($AR_WITH['bank_country']);
						
						$account_no = FCrtRplc($AR_WITH['account_no']);
						$swift_code = FCrtRplc($AR_WITH['swift_code']);
						$bank_zip_code = FCrtRplc($AR_WITH['bank_zip_code']);
						
						$trans_no = UniqueId("TRNS_NO");
						$wallet_id = FCrtRplc($AR_WITH['wallet_id']);
						$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
						
						$AR_PRC = $model->getProcessor($processor_id);
						$withdraw_fee_percent = ($AR_PRC['withdraw_fee']>0)? $AR_PRC['withdraw_fee']:10;
						$withdraw_fee = ($draw_amount*$withdraw_fee_percent/100); 
						$process_fee = ($processor_id==0)? "30":"0";
						$total_charge = $withdraw_fee+$process_fee;
						$trns_amount = ($draw_amount-$total_charge);
						$trns_date = InsertDate(getLocalTime());
						
						if($draw_amount<=$LDGR['net_balance'] && $draw_amount>0){
							if($processor_id>=0 && $member_id>0){
								$data = array("to_member_id"=>$member_id,
									"from_member_id"=>$model->getFirstId(),
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
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
								$trns_remark = "WITHDRAWAL REQUEST FROM [".$AR_PRC['processor_name']."]";
								$model->wallet_transaction($wallet_id,"Dr",$member_id,$draw_amount,$trns_remark,$trns_date,$trans_no,"1","WITHDRAW");
								$this->SqlModel->updateRecord(prefix."tbl_sms_otp",array("otp_sts"=>"1"),array("request_id"=>$AR_TYPE['request_id']));
								set_message("success","You have successfully request for withdrawal $StrMsg");
								redirect_member("financial","withdraw",array("error"=>"success"));
							}else{
								static_message("warning","Unable to process your request , please try again");
								redirect_member("financial","withdraw",array("request_id"=>_e($request_id),"error"=>"failed"));
							}
						}else{
							set_message("warning","Invalid amount, please check balance");
							redirect_member("financial","withdraw",array("request_id"=>_e($request_id),"error"=>"failed"));	
						}
					}else{
						static_message("warning","Invalid OTP , please try again");
						redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id),"error"=>"failed"));
					}
				break;
				default:
					static_message("warning","Invalid OTP , please try again");
					redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id),"error"=>"failed"));
				break;
			}
		}
		$this->load->view(MEMBER_FOLDER.'/dashboard',$data);
	}
	
	public function notification()
	{
	  	$this->load->view(MEMBER_FOLDER.'/account/notification',$data);  
	}
	public function kyc(){ 
		$model = new OperationModel();

		$data['ROW']=$fetchRow;
		$this->load->view(MEMBER_FOLDER.'/kyc/kyc',$data);
	}
	public function logout(){
		
		$this->session->unset_userdata('mem_id');
		 $this->session->unset_userdata('user_id');
		 
		 set_message("success","You have successfully logout");
		 redirect(MEMBER_PATH);
	}
	
	
}
