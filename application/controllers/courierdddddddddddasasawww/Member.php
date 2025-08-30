<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	    
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	
	
	public function profilelist(){
		$this->load->view(ADMIN_FOLDER.'/member/profilelist',$data);
	}
		public function invoice(){
		$this->load->view(ADMIN_FOLDER.'/member/invoice',$data);
	}
	public function courier(){
		$this->load->view(ADMIN_FOLDER.'/member/courier',$data);
	}
	public function bankdetail(){
		$this->load->view(ADMIN_FOLDER.'/member/bankdetail',$data);
	}
	public function subscription(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$subcription_id =  _d($segment['subcription_id']);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		switch($action_request):
			case "STATUS":
				if($subcription_id>0){
					$status = ($segment['status']=="0")? "1":"0";
					$data = array("isActive"=>$status);
					$this->SqlModel->updateRecord(prefix."tbl_subscription",$data,array("subcription_id"=>$subcription_id));
					set_message("success","Status change successfully");
					redirect_page("member","subscription",array()); exit;
				}
			break;
		endswitch;
		
		$this->load->view(ADMIN_FOLDER.'/member/subscription',$data);
	}
	
	
	public function profilelistpaid(){
		$this->load->view(ADMIN_FOLDER.'/member/profilelistpaid',$data);
	}
	
	public function profilelistunpaid(){
		$this->load->view(ADMIN_FOLDER.'/member/profilelistunpaid',$data);
	}
	
	public function kyc(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$kyc_id = ($form_data['kyc_id'])? $form_data['kyc_id']:_d($segment['kyc_id']);
		$member_id =  _d($segment['member_id']);
		
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		switch($action_request){
			case "KYC":
				if($kyc_id>0){
					$approved_date = getLocalTime();
					$approved_sts = ($segment['approved_sts']>0)? 1:$segment['approved_sts'];
					$this->SqlModel->updateRecord(prefix."tbl_mem_kyc",array("approved_sts"=>$approved_sts,"approved_date"=>$approved_date),array("kyc_id"=>$kyc_id));
					set_message("success","Successfully updated  member kyc status");
					redirect_page("member","kyc",array("member_id"=>_e($member_id)));
				}
			break;
			case "DELETE":
				$QR_OLD = "SELECT tmk.* FROM ".prefix."tbl_mem_kyc AS tmk WHERE tmk.kyc_id='".$kyc_id."'";
				$AR_OLD = $this->SqlModel->runQuery($QR_OLD,true);
				
				$final_location = $fldvPath."upload/kyc/".$AR_OLD['file_name'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				$this->SqlModel->deleteRecord(prefix."tbl_mem_kyc",array("kyc_id"=>$kyc_id));
				set_message("success","Successfully delete  member kyc");
				redirect_page("member","kyc",array("member_id"=>_e($member_id)));
			break;
		}
		
		$this->load->view(ADMIN_FOLDER.'/member/kyc',$data);
	}
	
	
	
	public function updatemember(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = ($form_data['member_id'])? $form_data['member_id']:_d($segment['member_id']);
		
		if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
			$first_name = FCrtRplc($form_data['first_name']);
			$midle_name = FCrtRplc($form_data['midle_name']);
			$last_name = FCrtRplc($form_data['last_name']);
			$email_address = FCrtRplc($form_data['email_address']);
			$gender = FCrtRplc($form_data['gender']);
			
			$user_name = FCrtRplc($form_data['user_name']);
			$user_password = FCrtRplc($form_data['user_password']);
			$trns_password = FCrtRplc($form_data['trns_password']);
			
			$flddDOB_D = FCrtRplc($form_data['flddDOB_D']);
			$flddDOB_M = FCrtRplc($form_data['flddDOB_M']);
			$flddDOB_Y = FCrtRplc($form_data['flddDOB_Y']);
			
			$flddDOB = $flddDOB_Y."-".$flddDOB_M."-".$flddDOB_D;
			$date_of_birth = $flddDOB;
			
			$current_address = FCrtRplc($form_data['current_address']);
			$city_name = FCrtRplc($form_data['city_name']);
			$state_name = FCrtRplc($form_data['state_name']);
			$country_name = FCrtRplc($form_data['country_name']);
			$country_code = FCrtRplc($form_data['country_code']);
			$pin_code = FCrtRplc($form_data['pin_code']);
			$member_mobile = FCrtRplc($form_data['member_mobile']);
		
			$processor_id = FCrtRplc($form_data['processor_id']);
			$bitcoin_address = FCrtRplc($form_data['bitcoin_address']);
			$pif_amount = FCrtRplc($form_data['pif_amount']);
		 $bank_name = FCrtRplc($form_data['bank_name']);
		  $bank_acct_holder = FCrtRplc($form_data['bank_acct_holder']);
		  $account_number = FCrtRplc($form_data['account_number']);
	      $ifc_code = FCrtRplc($form_data['ifc_code']);
		  $branch = FCrtRplc($form_data['branch']);
		  $pan_no = FCrtRplc($form_data['pan_no']);
		  $adhar = FCrtRplc($form_data['adhar']);
			$data = array("first_name"=>$first_name,
			  "midle_name" =>$midle_name,
				"last_name"=>$last_name,
				"member_email"=>$email_address,
				"current_address"=>$current_address,
				"city_name"=>$city_name,
				"state_name"=>$state_name,
				"country_name"=>$model->getCountryName($country_code),
				"country_code"=>$country_code,
				"pin_code"=>$pin_code,
				"member_mobile"=>$member_mobile,
				"processor_id"=>$processor_id,
				"bitcoin_address"=>$bitcoin_address,
				"pif_amount"=>$pif_amount,
				"upgrade_date"=>InsertDate(getLocalTime()),
				"gender"=>$gender,
				"user_name"=>$user_name,
				"user_password"=>$user_password,
				"date_of_birth"=>$date_of_birth,
				"bank_name" => $bank_name,
					"bank_acct_holder" => $bank_acct_holder,
					"account_number" => $account_number,
					"ifc_code" => $ifc_code,
					"branch" => $branch,
					"pan_no" => $pan_no,
					"adhar" => $adhar
				
			);		
			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
				set_message("success","Successfully updated member  detail");
				redirect_page("member","updatemember",array("member_id"=>_e($member_id)));
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_page("member","profilelist",array("member_id"=>_e($member_id)));
			}		
		}
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		$this->load->view(ADMIN_FOLDER.'/member/updatemember',$data);
	}
	
	public function addmember(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $segment['member_id'];
		$today_date = InsertDate(getLocalTime());
		
		if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
			$first_name = FCrtRplc($form_data['first_name']);
			$last_name = FCrtRplc($form_data['last_name']);
			$full_name = $first_name." ".$last_name;
			$email_address = FCrtRplc($form_data['email_address']);
			
			$left_right = FCrtRplc($form_data['left_right']);
			$user_name = FCrtRplc($form_data['user_name']);
			$sponsor_user_name = FCrtRplc($form_data['sponsor_user_name']);
			$sponsor_mem_id = $model->getMemberId($sponsor_user_name);
			
			$AR_GET = $model->getSponsorSpill($sponsor_mem_id,$left_right);
			$sponsor_id = $AR_GET['sponsor_id'];
			$spil_id = $AR_GET['spil_id'];
			
			
			$flddDOB = $flddDOB_Y."-".$flddDOB_M."-".$flddDOB_D;
			$date_of_birth = InsertDate($flddDOB);
			$user_id = $model->generateUserId();
	
			if($model->checkCount(prefix."tbl_members","user_name",$sponsor_user_name)>0){
				if($model->checkCount(prefix."tbl_members","user_name",$user_name)==0){
					$Ctrl += ($left_right!='')? $model->CheckOpenPlace($spil_id,$left_right):0;
					$data = array(
					    "first_name"=>$first_name,
						"last_name"=>$last_name,
						"full_name"=>$full_name,
						"user_id"=>$user_id,
						"user_name"=>$user_id,
						"member_email"=>$email_address,
						"sponsor_id"=>$sponsor_id,
						"spil_id"=>$spil_id,
						"left_right"=>$left_right,
						"date_join"=>$today_date,
						"pan_status"=>"N",
						"status"=>"Y",
						"last_login"=>$today_date,
						"login_ip"=>$_SERVER['REMOTE_ADDR'],
						"block_sts"=>"N",
						"sms_sts"=>"N",
						"date_of_birth"=>date_of_birth,
						"upgrade_date"=>$today_date
					);		
					
					if($member_id>0){
						$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
						set_message("success","Successfully updated  detail");
						redirect_page("member","addmembertwo",array("member_id"=>_e($member_id)));
					}else{
						if($Ctrl==0){
							$member_id = $this->SqlModel->insertRecord(prefix."tbl_members",$data);
								$tree_data = array("member_id"=>$member_id,
									"sponsor_id"=>$sponsor_id,
									"spil_id"=>$spil_id,
									"nlevel"=>0,
									"left_right"=>$left_right,
									"nleft"=>0,
									"nright"=>0,
									"date_join"=>$today_date
								);
								$this->SqlModel->insertRecord(prefix."tbl_mem_tree",$tree_data);
								$model->updateTree($spil_id,$member_id);
							set_message("success","Successfully executed record, please proceed for login info");
							redirect_page("member","addmembertwo",array("member_id"=>_e($member_id)));
						}else{
							set_message("warning","Failed , unable to process your request , please try again");
							redirect_page("member","addmember",array());
						}
					}
				}else{
					set_message("warning","This user name is already exists, please try another user name");
				}
			}else{
				set_message("warning","Invalid sponsor ID");
			}
		}
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		$this->load->view(ADMIN_FOLDER.'/member/addmember',$data);
	}
	
	public  function addmembertwo(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);

		$member_id = ($form_data['member_id']>0)? $form_data['member_id']:_d($segment['member_id']);
		$model->checkMemberId($member_id);
		if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
			$user_name = FCrtRplc($form_data['user_name']);
			$user_password = FCrtRplc($form_data['user_password']);
			$member_id = FCrtRplc($form_data['member_id']);
			if($model->checkMemberUsernameExist($user_name,$member_id)==0){
				$data = array("user_password"=>$user_password);		
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
				set_message("success","Successfully executed record, please proceed for address setting");
				redirect_page("member","addmembertwo",array("member_id"=>_e($member_id)));
			}else{
				set_message("warning","This username is already register with us, please try another");
				redirect_page("member","addmembertwo",array("member_id"=>_e($member_id)));
			}
		}
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);

		$data['ROW']=$fetchRow;
		$this->load->view(ADMIN_FOLDER.'/member/addmember-two',$data);
	}
	
	
	public function addmemberthree(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);

		$member_id = ($form_data['member_id']>0)? $form_data['member_id']:_d($segment['member_id']);
		$model->checkMemberId($member_id);
		if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
			$current_address = FCrtRplc($form_data['current_address']);
			$country_code = FCrtRplc($form_data['country_code']);
			$city_name = FCrtRplc($form_data['city_name']);
			$state_name = FCrtRplc($form_data['state_name']);
			$country_name = FCrtRplc($form_data['country_name']);
			$pin_code = FCrtRplc($form_data['pin_code']);
			$member_mobile = FCrtRplc($form_data['member_mobile']);
			$member_id = FCrtRplc($form_data['member_id']);

			$data = array("current_address"=>$current_address,
				"country_code"=>$country_code,				
				"city_name"=>$city_name,				
				"state_name"=>$state_name,				
				"country_name"=>$country_name,				
				"pin_code"=>$pin_code,				
				"member_mobile"=>$member_mobile,							
			);				
			$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
			set_message("success","Successfully executed record, please proceed for payment setting");
			redirect_page("member","addmemberthree",array("member_id"=>_e($member_id)));
			
		}
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		$this->load->view(ADMIN_FOLDER.'/member/addmember-three',$data);
	}
	
	public function addmemberfour(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);

		$member_id = ($form_data['member_id']>0)? $form_data['member_id']:_d($segment['member_id']);
		$model->checkMemberId($member_id);
		if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
			$bitcoin_address = FCrtRplc($form_data['bitcoin_address']);
			$account_number = FCrtRplc($form_data['account_number']);
			$pif_amount = FCrtRplc($form_data['pif_amount']);
			

			$data = array("bitcoin_address"=>$bitcoin_address);				
			$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
			set_message("success","Successfully executed record, please proceed for address setting");
			redirect_page("member","addmemberfour",array("member_id"=>_e($member_id)));
			
		}
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		$this->load->view(ADMIN_FOLDER.'/member/addmember-four',$data);
	}
	
	public function profile(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];

		$member_id = ($form_data['member_id']>0)? $form_data['member_id']:_d($segment['member_id']);
		
		$model->checkMemberId($member_id);
		 $QR_CHECK = "SELECT tm.*, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		if($form_data['submitMemberSavePassword']==1 && $this->input->post()!=''){
			$old_password = FCrtRplc($form_data['old_password']);
			$user_password = FCrtRplc($form_data['user_password']);
			$confirm_user_password = FCrtRplc($form_data['confirm_user_password']);	
			if($old_password!=$user_password){
				if($model->checkOldPassword($member_id,$old_password)>0){
					
					$sms_otp = $model->sendPasswordSMS($AR_MEM['mobile_number']);
					$data = array("member_id"=>$member_id,
						"email_id"=>$fetchRow['member_email'],
						"new_value"=>$user_password,
						"email_type"=>"PWORD"
					);
					$email_rq_id = $this->SqlModel->insertRecord(prefix."tbl_email_otp",$data);
					Send_Mail(array("email_rq_id"=>$email_rq_id,"member_id"=>$member_id),"ADMIN_CHANGE_PASSWORD");
					set_message("success","Password changed request send successfully, ask member to verify it");
					redirect_page("member","profile",array("member_id"=>_e($member_id))); 
				}else{
					set_message("warning","Invalid old password");
					redirect_page("member","profile",array("member_id"=>_e($member_id))); 
				}
			}else{
				set_message("warning","New password must be different form old-password");
				redirect_page("member","profile",array("member_id"=>_e($member_id))); 
			}
		}
		
		switch($action_request){
			case "BLOCK_UNBLOCK":
				if($member_id>0){
					$block_sts = ($segment['block_sts']=="N")? "Y":"N";
					$data = array("block_sts"=>$block_sts);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Status change successfully");
					redirect_page("member","profilelist",array()); exit;
				}
			break;
			case "BLOCK_UNBLOCK_ROI":
				if($member_id>0){
					$roi_sts = ($segment['roi_sts']=="N")? "Y":"N";
					$data = array("roi_sts"=>$roi_sts);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Status change successfully");
					redirect_page("member","profilelistpaid",array()); exit;
				}
			break;
			case "STATUS":
				if($member_id>0){
					$status = ($segment['status']=="N")? "Y":"N";
					$data = array("status"=>$status);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Status change successfully");
					redirect_page("member","profilelist",array()); exit;
				}
			break;
		}
		
		$this->load->view(ADMIN_FOLDER.'/member/profile',$data);
	}
	
	public function tree(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/member/tree',$data);
	}
	
	public function treeauto(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/member/treeauto',$data);
	}
	
	public function treegenealogy(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/member/treegenealogy',$data);
	}
	
	public function genealogy(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/member/genealogy',$data);
	}
	
	public function level(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/member/level',$data);
	}
	
	public function direct(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/member/direct',$data);
	}
	
	public function accesspanel(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		
		if($form_data['submitLoginMember']==1 && $this->input->post()!=''){
			$member_user_id = FCrtRplc($form_data['member_user_id']);
			if($member_user_id!=''){
				$Q_MEM = "SELECT * FROM ".prefix."tbl_members WHERE user_id='$member_user_id' AND delete_sts>0";
				$fetchRow = $this->SqlModel->runQuery($Q_MEM,true);
				if($fetchRow['member_id']>0){
					$this->session->set_userdata('mem_id',$fetchRow['member_id']);
					$this->session->set_userdata('user_id',$fetchRow['user_id']);
					redirect(BASE_PATH."userpanel");
				}else{
					set_message("warning","Invalid member id");
					redirect_page("member","accesspanel",array()); 
				}
			}else{
				set_message("warning","Please enter valid member id");
				redirect_page("member","accesspanel",array()); 
			}
		}
		$this->load->view(ADMIN_FOLDER.'/member/accesspanel',$data);
	}
	
	public function directaccesspanel(){
		$model = new OperationModel();
		$segment = $this->uri->uri_to_assoc(2);
		$user_id = FCrtRplc($segment['user_id']);
		if($user_id!=''){
			$Q_MEM = "SELECT * FROM ".prefix."tbl_members WHERE user_id='$user_id' AND delete_sts>0";
			$fetchRow = $this->SqlModel->runQuery($Q_MEM,true);
			if($fetchRow['member_id']>0){
				$this->session->set_userdata('mem_id',$fetchRow['member_id']);
				$this->session->set_userdata('user_id',$fetchRow['user_id']);
				redirect(BASE_PATH."userpanel");
			}else{
				set_message("warning","Invalid member id");
				redirect_page("member","accesspanel",array()); 
			}
		}else{
			set_message("warning","Please enter valid member id");
			redirect_page("member","accesspanel",array()); 
		}
		
	}
	
	public function deletemember(){
		$model = new OperationModel();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$member_id = ($form_data['member_id']>0)? $form_data['member_id']:$segment['member_id'];
		if($member_id>0){
			$data = array("delete_sts"=>0);
			$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
			set_message("success","Member deleted successfully");
			redirect_page("member","profilelist",array()); 
		}else{
			set_message("warning","Unable to delete member");
			redirect_page("member","profilelist",array()); 
		}
	}
	
	public function membersupport(){
		$this->load->view(ADMIN_FOLDER.'/member/membersupport',$data);
	}
	
	public function membermessage(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);

		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$message_id = (_d($form_data['message_id'])>0)? _d($form_data['message_id']):_d($segment['message_id']);
		switch($action_request){
			case "REPLY":
				if($form_data['submitReply']!='' && $this->input->post()!=''){
					$QR_MSG = "SELECT tm.* FROM ".prefix."tbl_message AS tm WHERE tm.message_id='".$message_id."'";
					$AR_MSG = $this->SqlModel->runQuery($QR_MSG,true);		
					
					$subject = $AR_MSG['subject'];
					$member_id = $AR_MSG['from_member_id'];
					$message = FCrtRplc($form_data['message']);
					
					$data = array("parent_id"=>$message_id,
						"from_member_id"=>0,
						"to_member_id"=>$member_id,
						"message_to"=>"MEMBER",
						"subject"=>$subject,
						"message"=>$message
					);
					$this->SqlModel->insertRecord(prefix."tbl_message",$data);
					$this->SqlModel->updateRecord(prefix."tbl_message",array("reply_date"=>$today_date,"reply_sts"=>"Y"),array("message_id"=>$message_id));
					set_message("success","Successfully replied");
					redirect_page("member","membermessage",""); 			
				}
			break;
			case "DELETE":
				if($message_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_message",array("message_id"=>$message_id));
					set_message("success","Message deleted successfully");
					redirect_page("member","membermessage",""); 
				}
			break;
		}
		
		$this->load->view(ADMIN_FOLDER.'/member/membermessage',$data);
	}
	
	public function conversation(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$enquiry_id = ($form_data['enquiry_id'])? $form_data['enquiry_id']:_d($segment['enquiry_id']);
		$member_id = 0;
		if($form_data['chatSubmit']=='1' && $this->input->post()!=''){
			$enquiry_reply = FCrtRplc($form_data['enquiry_reply']);
			$reply_date = $enquiry_date = getLocalTime();
			$data = array("member_id"=>$member_id,
				"enquiry_id"=>$enquiry_id,
				"enquiry_reply"=>$enquiry_reply,
				"enquiry_date"=>$enquiry_date,
				"reply_date"=>$reply_date
			);
			if($enquiry_id>0){
				$this->SqlModel->insertRecord(prefix."tbl_support_rply",$data);
				$this->SqlModel->updateRecord(prefix."tbl_support",array("enquiry_sts"=>"R","reply_date"=>$reply_date),array("enquiry_id"=>$enquiry_id));
				redirect_page("member","conversation",array("enquiry_id"=>_e($enquiry_id)));
			}
			
		}
		$this->load->view(ADMIN_FOLDER.'/member/conversation',$data);
	}
	
	public function upgrademember(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date = InsertDate(getLocalTime());
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		
		$order_no = UniqueId('ORDER_NO');
		if($form_data['submitUpgrade']=='1' && $this->input->post()!=''){
			$member_id = _d($form_data['member_id']);
			$type_id = FCrtRplc($form_data['type_id']);
			$AR_PLAN =  $model->getCurrentMemberShip($member_id);
			$AR_PACK = $model->getPackage($type_id);
			$old_type_id = ($AR_PLAN['type_id']>0)? $AR_PLAN['type_id']:0;
			
			$invest_bonus = $AR_PACK['invest_bonus'];
			$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
			$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
			
			$memberDetail = $model->getMemberdetail($member_id);
			
			if($memberDetail['package_type'] == '1')
			{
			if($AR_PACK['pin_name'] =='Silver' )
			{
			$flag1 ='1';
			}
			elseif($AR_PACK['pin_name'] =='Gold')
			{
			$flag1 ='1';
			}
			elseif($AR_PACK['pin_name'] =='Diamond')
			{
			$flag1 ='1';
			}
			else
			{
			$flag1 ='0';
			}
			
			}
			elseif($memberDetail['package_type'] == '2')
			{
			if($AR_PACK['pin_name'] =='Gold')
			{
			$flag1 ='1';
			}
			elseif($AR_PACK['pin_name'] =='Diamond')
			{
			$flag1 ='1';
			}
			else
			{
			$flag1 ='0';
			}
			}
			elseif($memberDetail['package_type'] == '3')
			{
			if($AR_PACK['pin_name'] =='Diamond')
			{
			$flag1 ='1';
			
		
			}
			else
			{
			$flag1 ='0';
			}
			}
				
			if($member_id>0 && $type_id>0){	
				if($type_id>$old_type_id){
				
				if($flag1=='1')
				{
				
				
					$data_sub = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"type_id"=>$AR_PACK['type_id'],
						"package_price"=>$AR_PACK['pin_price'],
						"net_amount"=>$AR_PACK['pin_price'],
						"reinvest_amt"=>$reinvest_amt,
						"total_amt"=>$total_invest,
						"prod_pv"=>$AR_PACK['prod_pv'],
						"date_from"=>$today_date,
						"date_expire"=>$date_expire
					);
					
					$sponsorId = $model->getSponsorId($member_id);
				    $countActiveId = $model->countActiveId($sponsorId);
					if($countActiveId % 3 == 0 || $countActiveId == 0)
					{
					$flag =1;
					}
					else
					{
					$flag =0;
					}
					$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
					//echo $flag;die;
					if($flag ==1)
					{
	$update_data = array("type_id"=>$AR_PACK['type_id'],"subcription_id"=>$subcription_id,"turbosale" =>'1');
					
					$trans_no = UniqueId("TRNS_NO");
					$userId = $model->getMemberUserId($member_id);
					$remark = 'Turbo Income From ['.$userId.']';
					if($AR_PACK['pin_price'] =='1000')
					{
					$total_income = 1500;
					}
					elseif($AR_PACK['pin_price'] =='2000')
					{
					$total_income =3500;
					}
					elseif($AR_PACK['pin_price']=='4000'){
					
					$total_income = 7000;
					}
					
					
					
					
					
					
					
					
			        $mem_res = $model->getMemberdetail($sponsorId);
			        
			  	    $type_id = $mem_res['type_id'];
					$memId = $sponsorId;
					$end_date = date('Y-m-d');
				    $subcription_id =$mem_res['subcription_id'];
					$trans_no = UniqueId("TRNS_NO");
					$to_mem_id = $member_id;
					$trans_amount = $total_income;
					$cal_amount = $total_income;
					$admin_charge = 0;
					
						 $tds = 0;
						
						 $repurchase = 0;
						 $daily_return = $total_income;
					
				
						
							$remark = "DIRECT REFERRAL FROM [".$member_id."]";
                            //$model->setDailyReturnIncome($subcription_id,$member_id,$memId,$trans_no,$trans_amount,$cal_amount,$daily_return,$remark,$end_date,$admin_charge,$tds,$repurchase);
							
							
							
					
					
				//die;	
					
					
					
//$model->wallet_transaction('1',"Cr",$sponsorId,$total_income,$remark,$today_date,$trans_no,"1","TURBO");
					}
					else
					{
					$update_data =array("type_id"=>$AR_PACK['type_id'],"subcription_id"=>$subcription_id);
					}
		  $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					if($memberDetail['package_type'] == 3)
					{ 
		$get_sprilL = $model->getsprillId($member_id,'L');
		$get_sprilR = $model->getsprillId($member_id,'R');
			$order_no1 = UniqueId('ORDER_NO');
			$order_no2 = UniqueId('ORDER_NO');
			$data_sub1 = array("order_no"=>$order_no1,
						"member_id"=>$get_sprilL,
						"type_id"=>$AR_PACK['type_id'],
						"package_price"=>0,
						"net_amount"=>0,
						"reinvest_amt"=>0,
						"total_amt"=>0,
						"prod_pv"=>0,
						"date_from"=>$today_date,
						"date_expire"=>$date_expire
					);
						$data_sub2 = array("order_no"=>$order_no,
						"member_id"=>$get_sprilR,
						"type_id"=>$AR_PACK['type_id'],
						"package_price"=>0,
						"net_amount"=>0,
						"reinvest_amt"=>0,
						"total_amt"=>0,
						"prod_pv"=>0,
						"date_from"=>$today_date,
						"date_expire"=>$date_expire
					);
					$subcription_id1 = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub1);
					$subcription_id2 = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub2);
					
				
					
					$update_data1 =array("type_id"=>$AR_PACK['type_id'],"subcription_id"=>$subcription_id1);
					$update_data2 =array("type_id"=>$AR_PACK['type_id'],"subcription_id"=>$subcription_id2);

	    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data1,array("member_id"=>$get_sprilL));
		$this->SqlModel->updateRecord(prefix."tbl_members",$update_data2,array("member_id"=>$get_sprilR));

					}
					
	
					//$model->setReferralIncome($member_id,$subcription_id);
					set_message("success","You have successfully upgrade an membership package");
					redirect_page("member","upgrademember",array()); exit;
				
				
				}
				else
				{
				set_message("warning","Invalid package selection, Please select registered package ");
					redirect_page("member","upgrademember",array());
				}
				
				}else{
					set_message("warning","Invalid package selection, Please select higher package than  ".$AR_PLAN['pin_name']." package");
					redirect_page("member","upgrademember",array());
				}
			}else{
				set_message("warning","Member not found , please select valid member");
				redirect_page("member","upgrademember",array());
			}
		}
		
		$this->load->view(ADMIN_FOLDER.'/member/upgrademember',$data);
	}

	
	public function manualtree(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date = InsertDate(getLocalTime());
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		
		if($form_data['registerMember']=='1' && $this->input->post()!=''){
			$member_user_name = FCrtRplc($form_data['member_user_name']);
			$sponsor_user_name = FCrtRplc($form_data['sponsor_user_name']);
			$spill_user_name = FCrtRplc($form_data['spill_user_name']);
			$left_right = FCrtRplc($form_data['left_right']);
			
			$user_ctrl =$model->checkUserRecord($member_user_name);
			$sponsor_ctrl =$model->checkUserName($sponsor_user_name);
			$spill_ctrl = $model->checkUserName($spill_user_name);
			if($user_ctrl==0){ set_message("warning","Invalid member username"); redirect_page("member","manualtree",array());  }
			if($sponsor_ctrl==0){ set_message("warning","Invalid sponsor username"); redirect_page("member","manualtree",array());  }
			if($spill_ctrl==0){ set_message("warning","Invalid spill username"); redirect_page("member","manualtree",array());  }
			
			
			$QR_USER = "SELECT * FROM tbl_members WHERE user_name='".$member_user_name."'";
			$AR_USER = $this->SqlModel->runQuery($QR_USER,true);
			if($AR_USER['member_id']>0){
				$member_id = $AR_USER['member_id'];
			}else{
				$member_id = $model->InsertMemberData($member_user_name);
			}
			
			
			$QR_SPOR = "SELECT * FROM tbl_members WHERE user_name='".$sponsor_user_name."'";
			$AR_SPOR = $this->SqlModel->runQuery($QR_SPOR,true);
			if($AR_SPOR['member_id']>0){
				$sponsor_id = $AR_SPOR['member_id'];
			}else{
				$sponsor_id = $model->InsertMemberData($sponsor_user_name);
			}
			
		
			$QR_SPILL = "SELECT * FROM tbl_members WHERE user_name='".$spill_user_name."'";
			$AR_SPILL = $this->SqlModel->runQuery($QR_SPILL,true);
			if($AR_SPILL['member_id']>0){
				$spill_id = $AR_SPILL['member_id'];
			}else{
				$spill_id = $model->InsertMemberData($spill_user_name);
			}
			
			
			if($user_ctrl>0 && $sponsor_ctrl>0 && $spill_ctrl>0){
				
				$AR_MEM = $model->getMember($member_id);
				$model->UpdateMemberTree($sponsor_id,$spill_id,$member_id,$left_right,$AR_MEM['date_join']);
				
				set_message("success","Data process successfully");
				redirect_page("member","manualtree",array());
			}else{
				redirect_page("member","manualtree",array());
			}
		}
		
		
		$this->load->view(ADMIN_FOLDER.'/member/manualtree',$data);
		
	}
	
	public function contactus(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$contact_id = ($form_data['contact_id'])? $form_data['contact_id']:_d($segment['contact_id']);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		switch($action_request){
			case "DELETE":
				if($contact_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_contacts",array("contact_id"=>$contact_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("member","contactus",array()); exit;
			break;
			
			
		}
		
		$this->load->view(ADMIN_FOLDER.'/member/contactus',$data);
	}
	
	public function modifytree(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id =  _d($form_data['member_id']);
		$new_spill_id = FCrtRplc($form_data['new_spill_id']);
		if($form_data['submitSpillMember']==1 && $this->input->post()!=''){
			$spil_member_id = $model->getMemberId($new_spill_id);
			
			$leftCtrl = $model->CheckOpenPlace($spil_member_id,"L");
			
			$rightCtrl = $model->CheckOpenPlace($spil_member_id,"R");
			
			if($member_id>0){
				if($spor_member_id>0){
						if($leftCtrl==0 || $rightCtrl==0){
							if($leftCtrl==0){
								$left_right = "L";
							}elseif($rightCtrl==0){
								$left_right = "R";
							}
							if($left_right!=''){
								$data = array("spil_user_id"=>$new_spill_id,
									"spil_id"=>$spil_member_id,
									"left_right"=>$left_right
								);
								$this->SqlModel->updateRecord(prefix."tbl_members",array("spil_user_id"=>$new_spill_id,"spil_id"=>$spil_member_id),
								array("member_id"=>$member_id));
								set_message("success","Spill updated successfully");
								redirect_page("member","modifytree",array("member_id"=>_e($member_id)));
							}else{
								set_message("success","Unable to process request, please try again");
								redirect_page("member","modifytree",array("member_id"=>_e($member_id)));
							}
						}else{
							set_message("warning","Place is not avaiable, please try another spill");
							redirect_page("member","modifytree",array("member_id"=>_e($member_id)));
						}						
					}else{
						set_message("warning","Invalid spill Id");
						redirect_page("member","modifytree",array("member_id"=>_e($member_id)));
					}
			}else{
				set_message("success","Unable to process request, please try again");
				redirect_page("member","modifytree",array("member_id"=>_e($member_id)));
			}
		}
		if($form_data['submitValidMember']==1 && $this->input->post()!=''){
			$member_id = _d($form_data['member_id']);
			if($member_id>0){
				$QR_GET = "SELECT tm.*, CONCAT_WS('',tm.mobile_code,tm.member_mobile) AS mobile_number, 
				CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name, tmsp.first_name AS spsr_first_name,
				tmsp.last_name AS spsr_last_name, CONCAT_WS(' ',tmsp.first_name,tmsp.last_name) AS spsr_full_name, 
				tmsp.user_id AS spsr_user_id ,
				tree.nlevel, tree.left_right, tree.nleft, tree.nright , tpt.pin_name, tpt.avtar
				FROM ".prefix."tbl_members AS tm	
				LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
				LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
				LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
				WHERE tm.member_id='$member_id'";
				$AR_MEM = $this->SqlModel->runQuery($QR_GET,true);
				$data['ROW'] = $AR_MEM;
			}else{
				set_message("warning","Invalid member Id");
				redirect_page("member","modifytree","");
			}
		}
		$this->load->view(ADMIN_FOLDER.'/member/modifytree',$data);
	}
	
	
	public function changesponsor(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id =  _d($form_data['member_id']);
		$new_sponsor_id = FCrtRplc($form_data['new_sponsor_id']);
		if($form_data['submitSponsorMember']==1 && $this->input->post()!=''){
			$spor_member_id = $model->getMemberId($new_sponsor_id);
			if($member_id>0){
				if($spor_member_id>0){
							$this->SqlModel->updateRecord(prefix."tbl_members",array("spor_user_id"=>$new_sponsor_id,"sponsor_id"=>$new_sponsor_id)
							,array("member_id"=>$member_id));
							set_message("success","Sponsor updated successfully");
							redirect_page("member","changesponsor",array("member_id"=>_e($member_id)));
				}else{
					set_message("warning","Invalid sponsor Id");
					redirect_page("member","changesponsor",array("member_id"=>_e($member_id)));
				}
			}else{
				set_message("success","Unable to process request, please try again");
				redirect_page("member","changesponsor",array("member_id"=>_e($member_id)));
			}
		}
		if($form_data['submitValidMember']==1 && $this->input->post()!=''){
			$member_id = _d($form_data['member_id']);
			if($member_id>0){
				$QR_GET = "SELECT tm.*, CONCAT_WS('',tm.mobile_code,tm.member_mobile) AS mobile_number, 
				CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name, tmsp.first_name AS spsr_first_name,
				tmsp.last_name AS spsr_last_name, CONCAT_WS(' ',tmsp.first_name,tmsp.last_name) AS spsr_full_name, 
				tmsp.user_id AS spsr_user_id ,
				tree.nlevel, tree.left_right, tree.nleft, tree.nright , tpt.pin_name, tpt.avtar
				FROM ".prefix."tbl_members AS tm	
				LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
				LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
				LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
				WHERE tm.member_id='$member_id'";
				$AR_MEM = $this->SqlModel->runQuery($QR_GET,true);
				$data['ROW'] = $AR_MEM;
			}else{
				set_message("warning","Invalid member Id");
				redirect_page("member","changesponsor","");
			}
		}
		$this->load->view(ADMIN_FOLDER.'/member/changesponsor',$data);
	}
	
	
	public function changedate(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id =  _d($form_data['member_id']);
		$date_join = InsertDate($form_data['member_join_date']);
		if($form_data['submitJoinMember']==1 && $this->input->post()!=''){
			if($member_id>0){
				if($date_join!=''){
							$this->SqlModel->updateRecord(prefix."tbl_members",array("date_join"=>$date_join)
							,array("member_id"=>$member_id));
							set_message("success","Join date  updated successfully");
							redirect_page("member","changedate",array("member_id"=>_e($member_id)));
				}else{
					set_message("warning","Invalid date");
					redirect_page("member","changedate",array("member_id"=>_e($member_id)));
				}
			}else{
				set_message("success","Unable to process request, please try again");
				redirect_page("member","changedate",array("member_id"=>_e($member_id)));
			}
		}
		if($form_data['submitValidMember']==1 && $this->input->post()!=''){
			$member_id = _d($form_data['member_id']);
			if($member_id>0){
				$QR_GET = "SELECT tm.*, CONCAT_WS('',tm.mobile_code,tm.member_mobile) AS mobile_number, 
				CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name, tmsp.first_name AS spsr_first_name,
				tmsp.last_name AS spsr_last_name, CONCAT_WS(' ',tmsp.first_name,tmsp.last_name) AS spsr_full_name, 
				tmsp.user_id AS spsr_user_id ,
				tree.nlevel, tree.left_right, tree.nleft, tree.nright , tpt.pin_name, tpt.avtar
				FROM ".prefix."tbl_members AS tm	
				LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
				LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
				LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
				WHERE tm.member_id='$member_id'";
				$AR_MEM = $this->SqlModel->runQuery($QR_GET,true);
				
				$data['ROW'] = $AR_MEM;
			}else{
				set_message("warning","Invalid member Id");
				redirect_page("member","changedate","");
			}
		}
		$this->load->view(ADMIN_FOLDER.'/member/changedate',$data);
	}
	public function chainreferesh(){
		$this->load->view(ADMIN_FOLDER.'/member/chainreferesh',$data);
	}
	
	public function bigcoins(){
		$this->load->view(ADMIN_FOLDER.'/member/bigcoins',$data);
	}
	
}
?>
