<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	    
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	public function planbuser(){
		$this->load->view(ADMIN_FOLDER.'/users/planbuser',$data);
	}
	public function sellHistory()
	{
	    $model = new OperationModel();
              $status = $this->uri->segment(4);
              $id     = _d($this->uri->segment(5));
              $row    = $this->SqlModel->runQuery("select * from tbl_p2p_sale where  id = '$id'" , true);
    
    if(is_array($row) and !empty($row))
    {
      
                if($status == 'A')
                {
                        // $trans_no = $row['trans_id'];
                        // $trns_remark = "Recieved From P2P";
                        // $model->wallet_transaction('1',"Cr",$row['member_id'],$row['amount'],$trns_remark,date('Y-m-d'),$trans_no,1,"P2P");   
                        $this->SqlModel->updateRecord("tbl_p2p_sale" ,array("status" =>"Y") ,array("id" => $id));
                }
                else
                {
                        $this->SqlModel->updateRecord("tbl_p2p_sale" ,array("status" =>"R") ,array("id" => $id));
                }
                
            set_message("success","Successfully updated Status");
            redirect_page("users","sellHistory",array());
                
         
    }
    
   
	   $this->load->view(ADMIN_FOLDER.'/users/saleHistory',$data); 
	}
	
	public function buyHistory()
	{
             	$model = new OperationModel();
              $status = $this->uri->segment(4);
              $id     = _d($this->uri->segment(5));
              $row    = $this->SqlModel->runQuery("select * from tbl_p2p where  id = '$id'" , true);
    
    if(is_array($row) and !empty($row))
    {
      
                if($status == 'A')
                {
                        $trans_no = $row['trans_id'];
                        $trns_remark = "Recieved From P2P";
                        $model->wallet_transaction('1',"Cr",$row['member_id'],$row['amount'],$trns_remark,date('Y-m-d'),$trans_no,1,"P2P");   
                        
                        $this->SqlModel->updateRecord("tbl_p2p" ,array("status" =>"Y") ,array("id" => $id));
                }
                else
                {
                       
                         $amount = $row['amount'];
                         $to_id  = $row['to_id']; 
                         $this->db->query(" UPDATE tbl_p2p_sale SET adjust_amt = adjust_amt  -  $amount  WHERE id ='$to_id'");
                         $this->SqlModel->updateRecord("tbl_p2p" ,array("status" =>"R") ,array("id" => $id));
                        //$this->SqlModel->updateRecord("tbl_p2p_sale" ,array("status" =>"R") ,array("id" => $id));
                }
                
            set_message("success","Successfully updated Status");
            redirect_page("users","buyHistory",array());
                
         
    }
	   $this->load->view(ADMIN_FOLDER.'/users/buyHistory',$data); 
	}
	
	
	  	public function pkgcollectionList(){
		 
		 
		 	$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$member_id = ($form_data['member_id'])? $form_data['member_id']:$segment['member_id'];
		$member_id = _d($member_id);
// 		if($member_id > 0 and $action_request =='DEACTIVATE')
// 		{
 
//                 $subData = $model->getsubsriptionId($member_id);
//                 $deactivedata = array("member_id"=>$member_id,"subcription_id"=>$subData['subcription_id'] ,"type_id"=>$subData['type_id'],"date_time"=>date('Y-m-d H:i:s'));      
//                 $this->SqlModel->insertRecord(prefix."tbl_deactivate",$deactivedata);
                
//                 $data = array("member_id"=>$member_id);
//                 $data1 = array("subcription_id"=>'0',"turbosale" =>'0','prod_pv' => '0');
//                 $this->SqlModel->deleteRecord(prefix."tbl_subscription",$data);
//                 $this->SqlModel->updateRecord(prefix."tbl_members",$data1,array("member_id"=>$member_id));
//                 set_message("success","Deactivated a/c successfully");
//                 redirect_page("users","collectionList",array()); exit;
// 		}
	$this->load->view(ADMIN_FOLDER.'/users/bypackagecollectionlist',$data);
	}
		public function collectionList(){
		 
		 
		 	$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$member_id = ($form_data['member_id'])? $form_data['member_id']:$segment['member_id'];
		$member_id = _d($member_id);
		if($member_id > 0 and $action_request =='DEACTIVATE')
		{
 
                $subData = $model->getsubsriptionId($member_id);
                $deactivedata = array("member_id"=>$member_id,"subcription_id"=>$subData['subcription_id'] ,"type_id"=>$subData['type_id'],"date_time"=>date('Y-m-d H:i:s'));      
                $this->SqlModel->insertRecord(prefix."tbl_deactivate",$deactivedata);
                
                $data = array("member_id"=>$member_id);
                $data1 = array("subcription_id"=>'0',"turbosale" =>'0','prod_pv' => '0');
                $this->SqlModel->deleteRecord(prefix."tbl_subscription",$data);
                $this->SqlModel->updateRecord(prefix."tbl_members",$data1,array("member_id"=>$member_id));
                set_message("success","Deactivated a/c successfully");
                redirect_page("users","collectionList",array()); exit;
		}
	$this->load->view(ADMIN_FOLDER.'/users/collectionlist',$data);
	}
	public function profilelist(){
		$this->load->view(ADMIN_FOLDER.'/users/profilelist',$data);
	}
	public function kyc_list(){
		$this->load->view(ADMIN_FOLDER.'/users/kyc_list',$data);
	}
		
	public function grievance_cell(){
		$this->load->view(ADMIN_FOLDER.'/users/grievance_cell',$data);
	}
		public function invoice(){
		$this->load->view(ADMIN_FOLDER.'/users/invoice',$data);
	}
		public function newinvoice(){
		$this->load->view(ADMIN_FOLDER.'/users/invoice2',$data);
	}
	public function courier(){
		$this->load->view(ADMIN_FOLDER.'/users/courier',$data);
	}
	public function bankdetail(){
		$this->load->view(ADMIN_FOLDER.'/users/bankdetail',$data);
	}
	
		public function subscription_sequence(){
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
					redirect_page("users","subscription",array()); exit;
				}
			break;
		endswitch;
		
		$this->load->view(ADMIN_FOLDER.'/users/subscription_seq',$data);
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
				
				  $member_id   = $model->getMemberdetailbysubscriptionid($subcription_id);
              		  $getSecondLastsubscription   = $model->getSecondLastsubscription($member_id,$subcription_id);
              		
              		$subcription_id1 =  ($getSecondLastsubscription['subcription_id'])? $getSecondLastsubscription['subcription_id']:0;
              		 $package_price1=   ($getSecondLastsubscription['prod_pv'])? $getSecondLastsubscription['prod_pv']:0;   
              		 	 $type_id=   ($getSecondLastsubscription['type_id'])? $getSecondLastsubscription['type_id']:0;   
              		   
              		   
              		   
					$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id1,"prod_pv"=>$package_price1);
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
    		  		      
						$this->SqlModel->deleteRecord(prefix."tbl_subscription",array("subcription_id"=>$subcription_id));
						  $getTotalMemberShipValue = $model->getTotalMemberShipValueT($member_id);
              		  
			             $this->db->query("UPDATE `tbl_members` SET `self_bv` =  '$getTotalMemberShipValue'     WHERE member_id ='$member_id';");  
					set_message("success","Status change successfully");
					redirect_page("users","subscription",array()); exit;
				}
			break;
		endswitch;
		
		$this->load->view(ADMIN_FOLDER.'/users/subscription',$data);
	}
	
	
	public function profilelistpaid(){
		$this->load->view(ADMIN_FOLDER.'/users/profilelistpaid',$data);
	}
	
	public function profilelistunpaid(){
		$this->load->view(ADMIN_FOLDER.'/users/profilelistunpaid',$data);
	}
	
public function kyc(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$kyc_id = ($form_data['kyc_id'])? $form_data['kyc_id']:_d($segment['kyc_id']);
	//	$member_idd = ($form_data['member_id'])? $form_data['member_id']:_d($segment['member_id']);
		$member_id =  _d($segment['member_id']);
		
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		switch($action_request){
			case "KYC":
				if($kyc_id>0){
					$approved_date = getLocalTime();
					$approved_sts = ($segment['approved_sts']>0)? 1:$segment['approved_sts'];
					
					if($approved_sts=='1'){
					$this->SqlModel->updateRecord(prefix."tbl_mem_kyc",array("approved_sts"=>$approved_sts,"approved_date"=>$approved_date),array("kyc_id"=>$kyc_id));
					 
					$member_id = $model->getMemberIdKYC($kyc_id);
					$model->updatekyc($member_id);
				}/*else{
				  $this->SqlModel->updateRecord(prefix."tbl_mem_kyc",array("approved_sts"=>$approved_sts,"approved_date"=>$approved_date),array("kyc_id"=>$kyc_id));
					 
					$member_id = $model->getMemberIdKYC($kyc_id);
					$model->updatekycdelete($member_id);  
				    
				    
				}*/
					set_message("success","Successfully updated  member kyc status");
					redirect_page("users","kyc",array("member_id"=>_e($member_id)));
				}
			break;
				case "KYCALL":
				if($member_id>0){
			
			
			        $approved_date = getLocalTime();
					$approved_sts = ($segment['approved_sts']>0)? 1:$segment['approved_sts'];
					if($approved_sts =='1'){
					$this->SqlModel->updateRecord(prefix."tbl_mem_kyc",array("approved_sts"=>$approved_sts,"approved_date"=>$approved_date),array("member_id"=>$member_id));
					$member_id = $model->getMemberIdKYC($kyc_id);
					$model->updatekyc($member_id);
					}else{ 
					 $QR_OLD = "SELECT tmk.* FROM ".prefix."tbl_mem_kyc AS tmk WHERE tmk.member_id='".$member_id."'";
				$AR_OLD = $this->SqlModel->runQuery($QR_OLD,true);
				
				$final_location = $fldvPath."upload/kyc/".$AR_OLD['file_name'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
		
				$this->SqlModel->deleteRecord(prefix."tbl_mem_kyc",array("member_id"=>$member_id));
					   
					    
					}
					set_message("success","Successfully updated  member kyc status");
					redirect_page("users","kyc",array("member_id"=>_e($member_id)));
				}
			break;
			case "DELETE":
				$QR_OLD = "SELECT tmk.* FROM ".prefix."tbl_mem_kyc AS tmk WHERE tmk.kyc_id='".$kyc_id."'";
				$AR_OLD = $this->SqlModel->runQuery($QR_OLD,true);
				
				$final_location = $fldvPath."upload/kyc/".$AR_OLD['file_name'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				$member_id = $model->getMemberIdKYC($kyc_id);
					$model->updatekyc($member_id);
				$this->SqlModel->deleteRecord(prefix."tbl_mem_kyc",array("kyc_id"=>$kyc_id));
				
				
				set_message("success","Successfully delete  member kyc");
				redirect_page("users","kyc",array("member_id"=>_e($member_id)));
			break;
		}
		
		$this->load->view(ADMIN_FOLDER.'/users/kyc',$data);
	}
	
	
	
public function updatemember(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = ($form_data['member_id'])? $form_data['member_id']:_d($segment['member_id']);
		
		if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
		//PrintR($form_data);
		    $user_id = FCrtRplc($form_data['user_id']);
			$user_name = FCrtRplc($form_data['user_name']);
			$user_password = FCrtRplc($form_data['user_password']);
		    $first_name = FCrtRplc($form_data['first_name']);
		    $midle_name = FCrtRplc($form_data['midle_name']);
		    $last_name = FCrtRplc($form_data['last_name']);
			$father_name = FCrtRplc($form_data['father_name']);
			$date_of_birth = FCrtRplc($form_data['date_of_birth']);
			$gender = FCrtRplc($form_data['gender']);
			  $country_name = FCrtRplc($form_data['country_name']);
		    $state_name = FCrtRplc($form_data['state_name']);
			$city_name = FCrtRplc($form_data['city']);
			$rank_id = FCrtRplc($form_data['rank_id']);
			$break_sts = FCrtRplc($form_data['break_sts']);
			$current_address = FCrtRplc($form_data['current_address']);
			$pin_code = FCrtRplc($form_data['pin_code']);
			$member_mobile = FCrtRplc($form_data['member_phone']);
		    $member_email = FCrtRplc($form_data['member_email']);
	        $pan_no = FCrtRplc($form_data['pan_no']);
	        $nominal_name = FCrtRplc($form_data['nominal_name']);
     	    $nominal_relation = FCrtRplc($form_data['nominal_relation']);
		  $bank_name = FCrtRplc($form_data['bank_name']);
		  $bank_acct_holder = FCrtRplc($form_data['bank_acct_holder']);
		  $account_number = FCrtRplc($form_data['account_number']);
	      $ifc_code = FCrtRplc($form_data['ifc_code']);
		  $branch = FCrtRplc($form_data['branch']);
		  $pan_no = FCrtRplc($form_data['pan_no']);
		  $adhar = FCrtRplc($form_data['adhar']);
		   $trx_address = FCrtRplc($form_data['trx_address']);
		   	   $ownaddress = FCrtRplc($form_data['ownaddress']);
		   	      $block_sts = FCrtRplc($form_data['block_sts']);
		   $product = FCrtRplc($form_data['product']);
		   $activation_sts =  FCrtRplc($form_data['activation_sts']);
		    $Withdrawal_status = FCrtRplc($form_data['Withdrawal_status']);
		     $emailverify      =  FCrtRplc($form_data['emailverify']);
		      $phonepay      =  FCrtRplc($form_data['phonepay']);
		       $offroi      =  FCrtRplc($form_data['offroi']);
		     
		     $Withdrawal_status_C  =   FCrtRplc($form_data['Withdrawal_status_C']);
		  $fname = $first_name.' '. $midle_name.' '. $last_name;
			$data = array(
			         "user_id" =>$user_id,
					"first_name" =>$first_name,
					"father_name" =>$father_name,
					"activation_sts" => $activation_sts,
				    "user_name"=>$user_id,
				    "rank_id" =>$rank_id,
					"user_password"=>$user_password,
					"gender"=>$gender,
					"date_of_birth"=>$date_of_birth,
					"current_address"=>$current_address,
					"state_name"=>$state_name,		
						"country_name"=>$country_name,	
					"city_name"=>$city_name,
					"break_sts" =>$break_sts , 
					"member_email" =>$member_email,
					"pin_code"=>$pin_code,
					"pan_no"=>$pan_no,
					"Withdrawal_status" =>$Withdrawal_status,
				    "Withdrawal_status_C" =>$Withdrawal_status_C,
				 	"emailverify" => $emailverify,
				 		"block_sts" => $block_sts,
					"bank_name" => $bank_name,
					"bank_acct_holder" => $bank_acct_holder,
					"account_number" => $account_number,
					"ifc_code" => $ifc_code,
					"member_phone"=>$member_mobile,
					"branch" => $branch,
					"pan_no" => $pan_no,
					"adhar" => $adhar,
						"trx_address" => $trx_address,
							"ownaddress" => $ownaddress,
								"phonepay" => $phonepay,
									"offroi" => $offroi,
				 
				
			);	

			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
				set_message("success","Successfully updated member  detail");
				redirect_page("users","updatemember",array("member_id"=>_e($member_id)));
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_page("users","profilelist",array("member_id"=>_e($member_id)));
			}		
		}
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		$this->load->view(ADMIN_FOLDER.'/users/updatemember',$data);
	}
		public function getcities()
	{
	$model = new OperationModel();
	$name = $this->input->post('name');
	$get_cities = $model->get_cities($name);
	echo "<select name='city' id='city' class='form-control'onblur='checkcity(this.value);'>";


	foreach($get_cities as $k=>$v)
	{
	echo "<option value=".$v['city_name'].">".$v['city_name']."</option>";
	}

echo "</select>";
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
						redirect_page("users","addmembertwo",array("member_id"=>_e($member_id)));
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
							redirect_page("users","addmembertwo",array("member_id"=>_e($member_id)));
						}else{
							set_message("warning","Failed , unable to process your request , please try again");
							redirect_page("users","addmember",array());
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
		
		$this->load->view(ADMIN_FOLDER.'/users/addmember',$data);
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
				redirect_page("users","addmembertwo",array("member_id"=>_e($member_id)));
			}else{
				set_message("warning","This username is already register with us, please try another");
				redirect_page("users","addmembertwo",array("member_id"=>_e($member_id)));
			}
		}
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);

		$data['ROW']=$fetchRow;
		$this->load->view(ADMIN_FOLDER.'/users/addmember-two',$data);
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
			redirect_page("users","addmemberthree",array("member_id"=>_e($member_id)));
			
		}
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		$this->load->view(ADMIN_FOLDER.'/users/addmember-three',$data);
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
			redirect_page("users","addmemberfour",array("member_id"=>_e($member_id)));
			
		}
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		$this->load->view(ADMIN_FOLDER.'/users/addmember-four',$data);
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
					redirect_page("users","profile",array("member_id"=>_e($member_id))); 
				}else{
					set_message("warning","Invalid old password");
					redirect_page("users","profile",array("member_id"=>_e($member_id))); 
				}
			}else{
				set_message("warning","New password must be different form old-password");
				redirect_page("users","profile",array("member_id"=>_e($member_id))); 
			}
		}
		
		switch($action_request){
			case "BLOCK_UNBLOCK":
				if($member_id>0){
					$block_sts = ($segment['block_sts']=="N")? "Y":"N";
					$data = array("block_sts"=>$block_sts);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Status change successfully");
					redirect_page("users","profilelist",array()); exit;
				}
			break;
			case "ACTIVATION_BLOCK_UNBLOCK": 
				if($member_id>0){
					$block_sts = ($segment['activation_sts']=="N")? "Y":"N";
					$data = array("activation_sts"=>$block_sts);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Status change successfully");
					redirect_page("users","profilelist",array()); exit;
				}
			break;
			
			case "BLOCK_UNBLOCK_ROI":
				if($member_id>0){
					$roi_sts = ($segment['roi_sts']=="N")? "Y":"N";
					$data = array("roi_sts"=>$roi_sts);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Status change successfully");
					redirect_page("users","profilelistpaid",array()); exit;
				}
			break;
			case "STATUS":
				if($member_id>0){
					$status = ($segment['status']=="N")? "Y":"N";
					$data = array("status"=>$status);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Status change successfully");
					redirect_page("users","profilelist",array()); exit;
				}
			break;
			case "DEACTIVATE":
				if($member_id>0){
					
					$today_date = date('Y-m-d');
				//	active_by
					$sub = $model->getSubcriptionsdata($member_id);
					if(is_array($sub) and !empty($sub))
					{
					$json = json_encode($sub); 
					$this->SqlModel->insertRecord(prefix."tbl_deactive",array("data" => $json));  
					}
					 
					if($sub['active_by'] > 0 )
					{
					$trns_remark = "OPT De-activation ". $model->getMemberUserId($member_id);
                    $model->wallet_transaction('3',"Cr",$sub['active_by'],100,$trns_remark,$today_date,rand(11111,777777),1,"OPT_DEACTIVE");  
					}
                    
                    
                    
 
					
					$data = array("member_id"=>$member_id);
		            $data1 = array("subcription_id"=>'0',"prod_pv" =>'0','type_id' =>'0'  );
					$this->SqlModel->deleteRecord(prefix."tbl_subscription",$data);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data1,array("member_id"=>$member_id));
					set_message("success","Deactivated a/c successfully");
					redirect_page("users","profilelistpaid",array()); exit;
				}
			break;
		}
		
		$this->load->view(ADMIN_FOLDER.'/users/profile',$data);
	}
	
	public function tree(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/users/tree',$data);
	}
	
	public function treeauto(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/users/treeauto',$data);
	}
	
	public function treegenealogy(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/users/treegenealogy',$data);
	}
	
	public function genealogy(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/users/genealogy',$data);
	}
	
	public function level(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/users/level',$data);
	}
	
	public function direct(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/users/direct',$data);
	}
	public function directlist(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/users/directlist',$data);
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
					redirect_page("users","accesspanel",array()); 
				}
			}else{
				set_message("warning","Please enter valid member id");
				redirect_page("users","accesspanel",array()); 
			}
		}
		$this->load->view(ADMIN_FOLDER.'/users/accesspanel',$data);
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
				redirect_page("users","accesspanel",array()); 
			}
		}else{
			set_message("warning","Please enter valid member id");
			redirect_page("users","accesspanel",array()); 
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
			redirect_page("users","profilelist",array()); 
		}else{
			set_message("warning","Unable to delete member");
			redirect_page("users","profilelist",array()); 
		}
	}
	
	public function membersupport(){
	$model = new OperationModel();
	$form_data = $this->input->post();
	$segment = $this->uri->uri_to_assoc(2);
	$enquiry_id = ($form_data['enquiry_id'])? $form_data['enquiry_id']:_d($segment['enquiry_id']);
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		if($action_request=="CLOSE"){
			if($enquiry_id>0){
				$data = array("enquiry_sts"=>"C");
				$this->SqlModel->updateRecord(prefix."tbl_support",$data,array("enquiry_id"=>$enquiry_id));
				set_message("success","You have  successfully closed a ticket");
				if($segment['page'] > 0 )
				{
				$method = 'membersupport?page='.$segment['page'];
				redirect_page("users",$method,"");
				}
				else
				{
				redirect_page("users","membersupport","");
				}
			}
		}
		$this->load->view(ADMIN_FOLDER.'/users/membersupport',$data);
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
					redirect_page("users","membermessage",""); 			
				}
			break;
			case "DELETE":
				if($message_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_message",array("message_id"=>$message_id));
					set_message("success","Message deleted successfully");
					redirect_page("users","membermessage",""); 
				}
			break;
		}
		
		$this->load->view(ADMIN_FOLDER.'/users/membermessage',$data);
	}
	
	public function conversation(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$enquiry_id = ($form_data['enquiry_id'])? $form_data['enquiry_id']:_d($segment['enquiry_id']);
		$member_id = 0;
		if($form_data['chatSubmit']=='1' && $this->input->post()!=''){
			$enquiry_reply = FCrtRplc($form_data['enquiry_reply']);
				$enquiry_replyfff = FCrtRplc(strip_tags($enquiry_reply));
			$reply_date = $enquiry_date = getLocalTime();
			$data = array("member_id"=>$member_id,
				"enquiry_id"=>$enquiry_id,
				"enquiry_reply"=>$enquiry_replyfff,
				"enquiry_date"=>$enquiry_date,
				"reply_date"=>$reply_date
			);
			if($enquiry_id>0){
				$this->SqlModel->insertRecord(prefix."tbl_support_rply",$data);
				$this->SqlModel->updateRecord(prefix."tbl_support",array("enquiry_sts"=>"R","reply_date"=>$reply_date),array("enquiry_id"=>$enquiry_id));
				redirect_page("users","conversation",array("enquiry_id"=>_e($enquiry_id)));
			}
			
		}
		$this->load->view(ADMIN_FOLDER.'/users/conversation',$data);
	}
public function jhsdfghygvbnbmanualupgrademember(){
		$model = new OperationModel();
		
	 
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date =$today_date =date('Y-m-d');// getLocalTime();
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		
		$order_no = UniqueId('ORDER_NO');
		if($form_data['submitUpgradeee']=='1' && $this->input->post()!=''){
			$member_id = _d($form_data['member_id']);
			$type_id = FCrtRplc($form_data['type_id']);
			$package_price = FCrtRplc($form_data['package_price']);
			$AR_PLAN =  $model->getCurrentMemberShip($member_id);
			$AR_PACK = $model->getPackage($type_id);
			$old_type_id = ($AR_PLAN['type_id']>0)? $AR_PLAN['type_id']:0;
				$manual_p = $form_data['manual_p'];
			$invest_bonus = $AR_PACK['invest_bonus'];
			$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
			$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
					if($package_price>0){
					    
					    		
			if($member_id>0 ){	
				$sub = $model->checkCount('tbl_subscription','member_id',$member_id);
				if($sub <= '0')
				{
					if($type_id > 1 and $type_id <= 7 )
                                        {
                                        $countSpill =   $model->getSpillcounts($member_id);
                                        if($countSpill > 0)
                                        {
                                        set_message("warning","This User Id already register Spill ...");
                                      	redirect_page("users","manualupgrademember",array());	
                                        }
                                        
                                        }
					$data_sub = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"type_id"=>8,
						"active_type_id" =>8 , 
						"package_price"=>$package_price,
						"net_amount"=>$package_price,
						"reinvest_amt"=>$package_price,
						"total_amt"=>$package_price,
						"prod_pv"=>0,
						"manual_p"=>$manual_p,
						"date_from"=>$today_date,
						"date_expire"=>$date_expire
					);
					
					$sponsorId = $model->getSponsorId($member_id);
				    $flagId = $member_id;
					$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
					$update_data =array("type_id"=>$AR_PACK['type_id'],"upgrade_date"=>$today_date,"prod_pv"=>0,"subcription_id"=>$subcription_id );
				    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
        //             $trns_remark = "CROWN COIN";
			     //   $model->wallet_transaction('2',"Cr",$member_id,300,$trns_remark,$today_date,$trans_no,1,"CC_ACTIVE");
		     $memberdetail   = $model->getmemberContact($member_id);	
			$sponsor_id = $member_id;
			$today_date = $today_date;
			//*******Check Condition if Package grator than 100      
			     if($type_id > 1 and $type_id <= 7 )
			     {
			         
			         $number = $AR_PACK['pin_price'] /150;
			         $total = $number -1;
			         
			       //******* Run Loop Number of Time  
			        for($i =1;$i<=$total;$i++)
			        {
			            if($i % 2 ==  '1')
			            {
			              $left_right ='L';  
			            }
			            else
			            {
			              $left_right ='R';     
			            }
			            
			      //********** Insert User        
			        $user_id = $model->generateUserId();
					//$AR_GET = $model->getSponsorSpill($sponsor_id,$left_right);
					$AR_GET = $model->getOpenPlace($sponsor_id);
						$left_right = $AR_GET['left_right'];
				 	$spil_id =  FCrtRplc($AR_GET['spil_id']);
									$data = array(
									    "first_name"=>$memberdetail['first_name'].$i,
										"full_name"=>$memberdetail['first_name'].$i,
										"user_id"=>$user_id,
										"user_name"=>$user_id,
										"user_password"=>$memberdetail['user_password'],
										"trns_password"=>'123456',
										"sponsor_id"=>$sponsor_id,
										"spil_id"=>$spil_id,
										"left_right"=>$left_right,
									 
										"member_mobile"=>$memberdetail['member_mobile'],
										"date_join"=>$today_date,
									 
										"last_login"=>$today_date,
										"block_sts"=>"N",
										"sms_sts"=>"N",
									 
										"type_id"=>0,
										"upgrade_date"=>$today_date
									);	

								 
											$member_id = $this->SqlModel->insertRecord(prefix."tbl_members",$data);
											$tree_data = array(
											    
											    "member_id"=>$member_id,
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
											 
			
			
			
			// Make Activate
			
				$data_sub = array("order_no"=>$order_no,
										"member_id"=>$member_id,
										"type_id"=>1,
										"active_type_id" =>$type_id , 
										"package_price"=>150,
										"prod_pv"=>100,
										"net_amount"=>150,
										"reinvest_amt"=>150,
										"total_amt"=>150,
										"date_from"=>$today_date,
										"date_expire"=>$date_expire,
										"bulk_by" =>$flagId,
										"active_by"=>'0'
									);
								
									
									
			$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
			$update_data =array(
								"type_id"=>$AR_PACK['type_id'],
								"prod_pv"=>$AR_PACK['prod_pv'],
								"subcription_id"=>$subcription_id,
							 );
									
			$this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
			
			
			//************ Insert AIG Coin
			
                    // $trans_no = UniqueId("TRNS_NO");
                    // $trns_remark = "CROWN COIN";
                    // $model->wallet_transaction('2',"Cr",$member_id,300,$trns_remark,$today_date,$trans_no,1,"CC_ACTIVE");
			
			
			        }
			        
			        $bulk = $model->getbulkUser($flagId);
            $i =1;
            foreach($bulk as $b)
            {
            
            //PrintR($b);die;
            if($i%2==0)
            {
            $k =0;
            }
            else
            {
            $k =1;
            }
            
            $member_id = $b['member_id'];
            $getSpill = $model->getSpillId($member_id); 
            $this->SqlModel->updateRecord(prefix."tbl_members",array("sponsor_id"=>$getSpill),array("member_id"=>$member_id)); 
            $this->SqlModel->updateRecord(prefix."tbl_mem_tree",array("sponsor_id"=>$getSpill),array("member_id"=>$member_id)); 
              
            
            
            $i++; 
            }
			        
			        
			
			     }
			
			
                    
                    
                    
      
					//$model->setReferralIncome($member_id,$subcription_id);
					set_message("success","You have successfully upgrade an membership package");
					redirect_page("users","manualupgrademember",array()); exit;
				
				
		}
		else
		{
				set_message("warning","This id already activated...");
				redirect_page("users","manualupgrademember",array());		
		}
				
			
			}else{
				set_message("warning","Member not found , please select valid member");
				redirect_page("users","manualupgrademember",array());
			}
					    
					}else{
		    
		   	set_message("warning","Package Price Should Be Graterthan Zero");
				redirect_page("users","manualupgrademember",array()); 
		    
		}
			
		
		}
		
		$this->load->view(ADMIN_FOLDER.'/users/upgrademember',$data);
	}	
	public function upgradepower(){
    	$model = new OperationModel();
		 $AR_PRSS = $model->getProcess();
            $process_id = $AR_PRSS['process_id'];
            $end_date=$AR_PRSS['end_date'];
	 
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date =$today_date =date('Y-m-d');// getLocalTime();
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
			$ip =$_SERVER['REMOTE_ADDR'];
			
			 $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
           $city =  $details->city;
			
			
			
			
			
			
			
		$order_no = UniqueId('ORDER_NO');
		if($form_data['submitUpgrade']=='1' && $this->input->post()!=''){
		    
		    
		  //   set_message("warning","-");
    //                     redirect_page("users","upgrademember","");
		    
			$member_id = _d($form_data['member_id']);
			$type_id = FCrtRplc($form_data['type_id']);
			$AR_PLAN =  $model->getCurrentMemberShip($member_id);
			$AR_PACK = $model->getPackage($type_id);
			$old_type_id = ($AR_PLAN['type_id']>0)? $AR_PLAN['type_id']:0;
			//	$package_price = FCrtRplc($AR_PACK['pin_price']);
				$package_price = FCrtRplc($form_data['package_price']);
			$invest_bonus = $AR_PACK['invest_bonus'];
			$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
			$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
			 $roi_stacking = $form_data['roi_stacking'];
			
				
				if($member_id>0 ){	
			if($model->checkCount(prefix."tbl_subscription","member_id",$member_id) >0){
				$sub = $model->checkCount('tbl_powerbusiness','member_id',$member_id);
	if($sub <= '0' )
				{
				$type = 'A';
				} 
				else
				{
				 $type = 'U';  
				}
				
			
                        $data_sub = array("order_no"=>$order_no,
                        "member_id"=>$member_id,
                        "package_price"=>$package_price,
                        "prod_pv"=>$package_price,
                        "date_from"=>$today_date,
                        "type" => $type,
                        	"ip"=>$_SERVER['REMOTE_ADDR'],
			                    "city" => $city,
                        
                        );
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_powerbusiness",$data_sub); 
			        
		
		     $this->db->query("UPDATE `tbl_members` SET `powerbusiness` =  powerbusiness+$package_price     WHERE member_id ='$member_id';");  
		      
		   
$message ="You have successfully upgrade an membership package.";
  

set_message("success","You have successfully Add Power Business");
					 redirect_page("users","upgradepower",""); exit;
 
	
					 
					
				
				
		
				}else{
				    
				set_message("warning","Please Activate Your Package First");
				 redirect_page("users","upgradepower","");    
				    
				}	
			
			}else{
				set_message("warning","Member not found , please select valid member");
				 redirect_page("users","upgradepower","");
			}
		}

		$this->load->view(ADMIN_FOLDER.'/users/upgradepower',$data);
	}
	

public function upgrademember(){
    	$model = new OperationModel();
		 $AR_PRSS = $model->getProcess();
            $process_id = $AR_PRSS['process_id'];
            $end_date=$AR_PRSS['end_date'];
	 
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date =$today_date =$end_date;//date('Y-m-d');// getLocalTime();
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
			$ip =$_SERVER['REMOTE_ADDR'];
			
			 $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
           $city =  $details->city;
			
			
			
			 //    set_message("warning","System is upgrading Please wait utill the updates");
                      //  redirect_page("dashboard","","");
			
			
			
		$order_no = UniqueId('ORDER_NO');
		if($form_data['submitUpgrade']=='1' && $this->input->post()!=''){
		    
		    

		    
			$member_id = _d($form_data['member_id']);
			$type_id = FCrtRplc($form_data['type_id']);
			$AR_PLAN =  $model->getCurrentMemberShip($member_id);
			$AR_PACK = $model->getPackage($type_id);
			$old_type_id = ($AR_PLAN['type_id']>0)? $AR_PLAN['type_id']:0;
			
			if($type_id==3){
					$package_price = FCrtRplc($form_data['package_price']);
			}else{
				$package_price = FCrtRplc($AR_PACK['pin_price']);
				
				
			}
				
				
		
			$invest_bonus = $AR_PACK['invest_bonus'];
			$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
			$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
			 $roi_stacking = $form_data['roi_stacking'];
			
				
				if($member_id>0 ){	
				$sub = $model->checkCount('tbl_subscription','member_id',$member_id);
			  $sub1   = $model->getLastMembertypeid($member_id,$type_id);
			
			
	$getMemberdetail   = $model->getMemberdetail($member_id);


     	 if($type_id =='1'){
            

            
        }
         elseif($type_id =='2'){

       
             
             
         }
          elseif($type_id =='3'){

       	if($package_price>=111){
				
			}else{
			    
			     set_message("warning","Package Amount Should be more than $ 111");
         redirect_page("users","upgrademember","");  
			}
             
             
         }
       
	
        // if($type_id =='1' and $package_price >= 50000 and $package_price <= 1900000){
            

            
        // }
        //  elseif($type_id =='2' and $package_price >= 2000000  and $package_price <= 4900000){

       
             
             
        //  }
        //   elseif($type_id =='3'  and $package_price >= 5000000 ){

       
             
             
        //  }
        //  elseif($type_id =='5'  and $package_price >= 5000000 ){

       
             
             
        //  }
        //   elseif($type_id =='6'  and $package_price >= 20000000 ){

       
             
             
        //  }
        // else{
        // set_message("warning","Please Check Your Package Amount");
        //  redirect_page("users","upgrademember","");   
        
        // }
        
        
        
			   	  if($package_price % 11 != 0)      {
			       
			     	  if($package_price==0){
			      
			        set_message("warning","Package Should be Multiple Of $ 11");
                          redirect_page("users","upgrademember","");  
			      
			  }
			    
			  
			      
			      
			  }else{
			      
			     set_message("warning","Package Should be Multiple Of $ 11");
                          redirect_page("users","upgrademember","");  
			      
			  }	 
        
        
        
	 
			      	
				
				
			 	if($sub <= '0' )
				{
				$type = 'A';
				} 
				else
				{
				 $type = 'U';  
				}
				
	 $getMemberdetail   = $model->getMemberdetail($member_id);
		
			
			
                        $data_sub = array("order_no"=>$order_no,
                        "member_id"=>$member_id,
                        "type_id"=>$type_id,
                        "package_price"=>$package_price,
                        "net_amount"=>$package_price,
                        "reinvest_amt"=>$package_price,
                        "total_amt"=>$package_price,
                        "prod_pv"=>$package_price,
                        "date_from"=>$today_date,
                        "type" => $type,
                        "pool"=>'N',
                        "x_rank"=>$package_price,
                        "x_income"=>$package_price*200/100,
                        "roi_stacking"=>0,
                        "date_expire"=>$date_expire,
                        	"ip"=>$_SERVER['REMOTE_ADDR'],
			                    "city" => $city,
                        
                        );
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub); 
			        
			  

				
						
				
					
					    if($sub == '0')
			    { 

					
					
					if($type == 'A')
					{
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}
					else
					{
					    $this->db->query("UPDATE `tbl_members` SET   `prod_pv` = prod_pv + $package_price WHERE  member_id ='$member_id';"); 
					    
					    
					    
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}
					
			    }else{
			        
			     	
					if($type == 'A')
					{
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}
					else
					{
					    $this->db->query("UPDATE `tbl_members` SET   `prod_pv` = prod_pv + $package_price WHERE  member_id ='$member_id';"); 
					    
					    
					    
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}   
			        
			        
			    }
			    
			    
			    
    	               
    	                
    	                 $toId = $model->getSponsorId($member_id);
                      //  instantDirectIncomeGenerte($member_id,$package_price,$subcription_id,$type_id);
		      

	  
set_message("success","You have successfully upgrade an membership package");
					 redirect_page("users","upgrademember",""); exit;
 
	
					 
					
				
				
		
				
			
			}else{
				set_message("warning","Member not found , please select valid member");
				 redirect_page("users","upgrademember","");
			}
		}
		
		$this->load->view(ADMIN_FOLDER.'/users/upgrademember',$data);
	}	
	
public function upgradememberoldplan(){
    	$model = new OperationModel();
		 $AR_PRSS = $model->getProcess();
            $process_id = $AR_PRSS['process_id'];
            $end_date=$AR_PRSS['end_date'];
	 
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date =$today_date =$end_date;//date('Y-m-d');// getLocalTime();
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
			$ip =$_SERVER['REMOTE_ADDR'];
			
			 $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
           $city =  $details->city;
			
			
			
			 //    set_message("warning","System is upgrading Please wait utill the updates");
                      //  redirect_page("dashboard","","");
			
			
			
		$order_no = UniqueId('ORDER_NO');
		if($form_data['submitUpgrade']=='1' && $this->input->post()!=''){
		    
		    

		    
			$member_id = _d($form_data['member_id']);
			$type_id = FCrtRplc($form_data['type_id']);
			$AR_PLAN =  $model->getCurrentMemberShip($member_id);
			$AR_PACK = $model->getPackage($type_id);
			$old_type_id = ($AR_PLAN['type_id']>0)? $AR_PLAN['type_id']:0;
			//	$package_price = FCrtRplc($AR_PACK['pin_price']);
				$package_price = FCrtRplc($form_data['package_price']);
			$invest_bonus = $AR_PACK['invest_bonus'];
			$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
			$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
			 $roi_stacking = $form_data['roi_stacking'];
			
				
				if($member_id>0 ){	
				$sub = $model->checkCount('tbl_subscription','member_id',$member_id);
			  $sub1   = $model->getLastMembertypeid($member_id,$type_id);
			
			
	$getMemberdetail   = $model->getMemberdetail($member_id);


         if ($type_id =='4'  and $package_price ==0 ) {
			       
			       
			       
			        }else{
			            
			            
			        
			   	  if ($package_price % 10000 == 0) {
			       
			     	  if($package_price==0){
			          //echo "true";
			        set_message("warning","Package Should be Multiple Of Rs 10000");
                         redirect_page("users","upgrademember","");   
			      
			  }
			    
			  
			      
			      
			  }else{
			   
			     set_message("warning","Package Should be Multiple Of Rs 10000");
			       
                       redirect_page("users","upgrademember","");   
                       
                        //echo "false";
			      
			  }    
			            
			            
			        }



	 
			      	
			      	
	//	die;	      	

		if($type_id =='1'  and $package_price >= 10000 and $package_price <= 50000 ){
		    
		  if($getMemberdetail['plan']=='B')
{
     set_message("warning","This User is Plan B. Please Upgrade Only Plan B Package");
                         redirect_page("users","upgrademember",""); 
    
}  
		    
		}
        elseif($type_id =='2'  and $package_price >= 60000 and $package_price <= 100000 ){
            
          if($getMemberdetail['plan']=='B')
{
     set_message("warning","This User is Plan B. Please Upgrade Only Plan B Package");
                         redirect_page("users","upgrademember",""); 
    
}  
            
        }
        elseif($type_id =='3'  and $package_price >= 110000){
            
           if($getMemberdetail['plan']=='B')
{
     set_message("warning","This User is Plan B. Please Upgrade Only Plan B Package");
                         redirect_page("users","upgrademember",""); 
    
} 
            
        }
         elseif($type_id =='5'  and $package_price >= 10000){
              if($getMemberdetail['plan']=='A')
{
     set_message("warning","This User is Plan A. Please Upgrade Only Plan A Package");
                         redirect_page("users","upgrademember",""); 
    
} 
       
             
             
         }
         elseif($type_id =='4'  and $package_price == 0){ 
             
            if($getMemberdetail['plan']=='B')
{
     set_message("warning","This User is Plan B. Please Upgrade Only Plan B Package");
                         redirect_page("users","upgrademember",""); 
    
} 
             
             
         }
        else{
        set_message("warning","Please Check Your Package Amount");
         redirect_page("users","upgrademember","");   
        
        }
			
			
				
			 	if($sub <= '0' )
				{
				$type = 'A';
				} 
				else
				{
				 $type = 'U';  
				}
				
	 $getMemberdetail   = $model->getMemberdetail($member_id);
			$x_income =  $getMemberdetail['x_income'];    
			
			if($x_income==0){
			    
			    $x_income=600;
			}else{
			    
			   	$x_income =  $getMemberdetail['x_income']."00";   
			   	
			   	
			   	
			   	
			   	
			   	
			   	
			   	
			   	
			   	
			   	
			   	
			   	
			    
			}
			
			
			
                        $data_sub = array("order_no"=>$order_no,
                        "member_id"=>$member_id,
                        "type_id"=>$type_id,
                        "package_price"=>$package_price,
                        "net_amount"=>$package_price,
                        "reinvest_amt"=>$package_price,
                        "total_amt"=>$package_price,
                        "prod_pv"=>$package_price,
                        "date_from"=>$today_date,
                        "type" => $type,
                        "pool"=>'N',
                        "x_rank"=>$x_income,
                        "x_income"=>$package_price*$x_income/100,
                        "roi_stacking"=>0,
                        "date_expire"=>$date_expire,
                        	"ip"=>$_SERVER['REMOTE_ADDR'],
			                    "city" => $city,
                        
                        );
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub); 
			        
			  

				
						
				
					
					    if($sub == '0')
			    { 

					
					
					if($type == 'A')
					{
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}
					else
					{
					    $this->db->query("UPDATE `tbl_members` SET   `prod_pv` = prod_pv + $package_price WHERE  member_id ='$member_id';"); 
					    
					    
					    
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}
					
			    }else{
			        
			     	
					if($type == 'A')
					{
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}
					else
					{
					    $this->db->query("UPDATE `tbl_members` SET   `prod_pv` = prod_pv + $package_price WHERE  member_id ='$member_id';"); 
					    
					    
					    
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}   
			        
			        
			    }
			    
			    
			    
    	               
    	                
    	                 $toId = $model->getSponsorId($member_id);
                        instantDirectIncomeGenerte($member_id,$package_price,$subcription_id,$type_id);
		      
		    //  $mobile = $model->getMembermobile($member_id);
$message ="You have successfully upgrade an membership package.";
  
 //	$model->massagesend($mobile,$message);     
     // updateDirectCounts(); 
	//  instantIncomeGenerte($member_id,$package_price,$subcription_id,$type_id);
	 //  Communityincomeup($member_id);
//	 Communityincomedown($member_id);
        //    setupLevelbusiness(); 
	  
set_message("success","You have successfully upgrade an membership package");
					 redirect_page("users","upgrademember",""); exit;
 
	
					 
					
				
				
		
				
			
			}else{
				set_message("warning","Member not found , please select valid member");
				 redirect_page("users","upgrademember","");
			}
		}
		
		$this->load->view(ADMIN_FOLDER.'/users/upgrademember',$data);
	}
	
	
	
	
	
	public function upgradeRetopup(){
		$model = new OperationModel();
		
	 
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date =$today_date =date('Y-m-d'); 
	 
	 
		if($form_data['submitUpgrade']=='1' && $this->input->post()!=''){
			$member_id = _d($form_data['member_id']);
			$type_id = FCrtRplc($form_data['type_id']);
			 
			$AR_PACK = $model->getRePackage($type_id);
		 
			
			
				
			if($member_id>0 ){	
			 
				
				$sub = $model->checkCount('tbl_retopup','member_id',$member_id);
				if($sub <= '0')
				{
				 	 	 			 
					$data_sub = array( 
                						"member_id"=>$member_id,
                						"type_id"=> $type_id,
                					 
                						"amount"=>$AR_PACK['amount'],
                					    "date_time"=>$today_date 
					 
					);
			 
					$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_retopup",$data_sub);
				// 	$update_data =array("type_id"=>$AR_PACK['type_id'],"upgrade_date"=>$today_date,"prod_pv"=>$AR_PACK['prod_pv'],"subcription_id"=>$subcription_id,'pin_no'=>$model->getPinNo(),'pin_key'=>$model->getPinKey('UH'));
				//     $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
                    
			 
					set_message("success","You have successfully Retopup an membership package");
					redirect_page("users","upgradeRetopup",array()); exit;
				
				
		}
		else
		{
				set_message("warning","This id already Retopup...");
				redirect_page("users","upgradeRetopup",array());		
		}
				
			
			}else{
				set_message("warning","Member not found , please select valid member");
				redirect_page("users","upgradeRetopup",array());
			}
		}
		
		$this->load->view(ADMIN_FOLDER.'/users/upgradeRetopup',$data);
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
			if($user_ctrl==0){ set_message("warning","Invalid member username"); redirect_page("users","manualtree",array());  }
			if($sponsor_ctrl==0){ set_message("warning","Invalid sponsor username"); redirect_page("users","manualtree",array());  }
			if($spill_ctrl==0){ set_message("warning","Invalid spill username"); redirect_page("users","manualtree",array());  }
			
			
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
				redirect_page("users","manualtree",array());
			}else{
				redirect_page("users","manualtree",array());
			}
		}
		
		
		$this->load->view(ADMIN_FOLDER.'/users/manualtree',$data);
		
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
				redirect_page("users","contactus",array()); exit;
			break;
			
			
		}
		
		$this->load->view(ADMIN_FOLDER.'/users/contactus',$data);
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
				if($spil_member_id > 0){
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
								redirect_page("users","modifytree",array("member_id"=>_e($member_id)));
							}else{
								set_message("success","Unable to process request, please try again");
								redirect_page("users","modifytree",array("member_id"=>_e($member_id)));
							}
						}else{
							set_message("warning","Place is not avaiable, please try another spill");
							redirect_page("users","modifytree",array("member_id"=>_e($member_id)));
						}						
					}else{
						set_message("warning","Invalid spill Id");
						redirect_page("users","modifytree",array("member_id"=>_e($member_id)));
					}
			}else{
				set_message("success","Unable to process request, please try again");
				redirect_page("users","modifytree",array("member_id"=>_e($member_id)));
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
				redirect_page("users","modifytree","");
			}
		}
		$this->load->view(ADMIN_FOLDER.'/users/modifytree',$data);
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
				    
				    if($spor_member_id != $member_id)
				    {
							$this->SqlModel->updateRecord(prefix."tbl_members",array("spor_user_id"=>$new_sponsor_id,"sponsor_id"=>$spor_member_id) ,array("member_id"=>$member_id));
						    $this->SqlModel->updateRecord(prefix."tbl_mem_tree",array( "sponsor_id"=>$spor_member_id),array("member_id"=>$member_id));
							set_message("success","Sponsor updated successfully");
							redirect_page("users","changesponsor",array("member_id"=>_e($member_id)));
				
				    }else{
					set_message("warning","User Id and Sponsor Id will not be same ! ");
					redirect_page("users","changesponsor",array("member_id"=>_e($member_id)));
				}
				        
				    }else{
					set_message("warning","Invalid sponsor Id");
					redirect_page("users","changesponsor",array("member_id"=>_e($member_id)));
				}
			}else{
				set_message("success","Unable to process request, please try again");
				redirect_page("users","changesponsor",array("member_id"=>_e($member_id)));
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
				redirect_page("users","changesponsor","");
			}
		}
		$this->load->view(ADMIN_FOLDER.'/users/changesponsor',$data);
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
							redirect_page("users","changedate",array("member_id"=>_e($member_id)));
				}else{
					set_message("warning","Invalid date");
					redirect_page("users","changedate",array("member_id"=>_e($member_id)));
				}
			}else{
				set_message("success","Unable to process request, please try again");
				redirect_page("users","changedate",array("member_id"=>_e($member_id)));
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
				redirect_page("users","changedate","");
			}
		}
		$this->load->view(ADMIN_FOLDER.'/users/changedate',$data);
	}
	public function chainreferesh(){
		$this->load->view(ADMIN_FOLDER.'/users/chainreferesh',$data);
	}
	
	public function bigcoins(){
		$this->load->view(ADMIN_FOLDER.'/users/bigcoins',$data);
	}
	
		public function packagechange(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		
		
			
			
		if($form_data['submitUpgrade']=='1' && $this->input->post()!=''){
			

			$member_id = $form_data['member_id'];
			$memberDetail = $model->getMemberdetail($member_id);
			
			if(is_array($memberDetail) && !empty($memberDetail))
			{
			if($memberDetail['subcription_id'] > 0)
			{
			if($form_data['type_id']!= $memberDetail['type_id'])
			{
          $update_data =array("type_id"=>$form_data['type_id']);

	    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
		$this->SqlModel->updateRecord(prefix."tbl_subscription",$update_data,array("subcription_id"=>$memberDetail['subcription_id']));
			set_message("success","You have successfully changed package");
			 redirect_page("users","packagechange",array());
			}
			else
			{
			set_message("warning","Please Select different package !");
		    redirect_page("users","packagechange",array());
			}
			}else{
			
			set_message("warning","This is In-active Id !");
		    redirect_page("users","packagechange",array());
			}
			
			}else{
			
			set_message("warning","This is In-valid Id !");
				redirect_page("users","packagechange",array());
			}
			
				
			
		}
		//$this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
				//set_message("warning","Member not found , please select valid member");
				//redirect_page("users","upgrademember",array());
		$this->load->view(ADMIN_FOLDER.'/users/packagechange',$data);
	}
	public function getpackagedetail()
	{
	$userId = $this->input->post('userId');
	$sel_query = $this->db->query("SELECT * FROM tbl_members  where user_id='$userId'");
		$fetchRow = $sel_query->row_array();
		
		if(is_array($fetchRow) and !empty($fetchRow))
		{
		if($fetchRow['subcription_id'] > 0)
		{
				if($fetchRow['tripot'] < 1)
				{
					$data['status'] = 'success';
				$sql_query = $this->db->query("SELECT pin2.* FROM tbl_pintype as pin LEFT JOIN tbl_pintype  as pin2 on pin.prod_pv = pin2.prod_pv WHERE pin.type_id='$fetchRow[type_id]'");
		$fetchData = $sql_query->result_array();
			foreach($fetchData as $val)
		{
		if($fetchRow['type_id']==$val['type_id'])
		{
		$selected = "selected";
		}
		else
		{
		$selected='';
		}
		$data['htmldata'] .= "<option  ".$selected." value='".$val['type_id']."' >".$val['pin_name'].' ['.$val['prod_pv'].' PV ] [ Rs.'.$val['mrp']."</option>";
		}
		
		$data['id'] = $fetchRow['member_id'];
				}
				else
				{
				$data['msg']= "This is Tripot Id !";
				$data['status'] = 'warning';
				}
		
		}
		else
		{
		$data['msg']= "This is In-active Id !";
		$data['status'] = 'warning';
		}
		}
		else
		{
		$data['msg']= "Invalid User Id !";
		$data['status'] = 'warning';
		}
		
		echo json_encode($data);
	}
	
}
?>
