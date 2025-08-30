<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Epin extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
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
	 

		public function generatePin(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$date = date('Y-m-d :H:i:s');
		 
		
		if($form_data['submitPinGenerate']==1 && $this->input->post()!=''){
				$trns_password = FCrtRplc($form_data['trns_password']);	
				$wallet_id =FCrtRplc($form_data['wallet_id']);
				$type_id = FCrtRplc($form_data['type_id']);
				$no_pin = FCrtRplc($form_data['no_pin']);
				    $AR_PACK = $model->getPackage($type_id);
					$LDGR = $model->getCurrentBalancewal($member_id,$wallet_id,"","");  
					$My_wallet = $LDGR['net_balance'];  
					 
					 if($My_wallet >= ($AR_PACK['mrp']*$no_pin)){
                           
                           if($model->checkUserPassword($member_id,$trns_password) > 0) {  
							 
					$AR_PACK = $model->getPinType($type_id);
					
					$data = array("type_id"=>$type_id,
						"no_pin"=>$no_pin,
						"prod_pv"=>$AR_PACK['prod_pv'],
						"pin_price"=>$AR_PACK['mrp'],
						"net_amount"=>$AR_PACK['mrp'],
						"member_id"=>$member_id,
						"bank_id"=>'0',
						"payment_date"=>$date,
						"payment_sts"=>'E-wallet',
						"ip_address"=>$_SERVER['REMOTE_ADDR'],
						"generate_by"=>$member_id
					);
					 
			            $mstr_id = $this->SqlModel->insertRecord(prefix."tbl_pinsmaster",$data);
						$model->generatePinDetail($mstr_id);
$trns_amount =  ($AR_PACK['mrp']*$no_pin);$trans_no = UniqueId("TRNS_NO");		
            $model->wallet_transaction($wallet_id,'Dr',$member_id,$trns_amount,'Epin Generate',$date,$trans_no,"1","EPIN");
						set_message("success","You have successfully generated  a E-pin");
						redirect_member("epin","generatePin","");
				 

 
    
                            }
                            else
								{
								set_message("warning","Invalid User Login Password...");
								redirect_member("epin","generatePin","");
								}
					 }
					 else
					 {
					 		set_message("warning","You Have Low Wallet Balence ...");
							redirect_member("epin","generatePin","");
					 }


    //     [wallet_id] => 1
    // [type_id] => 2
    // [trns_password] => safdsfdsfd
    // [submitPinGenerate] => 1

    }


		$this->load->view(MEMBER_FOLDER.'/epin/generatePin',$data);
	}
	public function usedpin(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/epin/usedpin',$data);
	}
	
	public function unusedpin(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/epin/unusedpin',$data);
	}
	
	public function pinrequest(){		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/epin/pinrequest',$data);
	}
	

	public function newrequest(){		
		$model = new OperationModel();
		
		
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$today_date = getLocalTime();
		
		$AR_MEM = $model->getMember($member_id);
		$net_amount = FCrtRplc($form_data['net_amount']);
		$trns_password = FCrtRplc($form_data['trns_password']);	
		
		
		if($form_data['submitPinRequest']==1 && $this->input->post()!=''){
		
			$wallet_type = FCrtRplc($form_data['wallet_type']);
			if($wallet_type=="1"){
				$wallet_id = $wallet_type;//$this->OperationModel->getGroupWallet(array("Cash Account"));	
				$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
			}
            /*			elseif($wallet_type=="3"){
				$wallet_id = $this->OperationModel->getGroupWallet(array("Trading Wallet"));	
				$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
			}
			else{
				$wallet_id = $model->getGroupWallet(array("Trading Wallet","Cash Account"));	
				$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
			}*/
			if($wallet_type =="1"){
			//Generate From Wallet
			if($LDGR['net_balance']>=$net_amount && $LDGR['net_balance']>0 && $net_amount>0){
				if($model->checkTrnsPassword($member_id,$trns_password)>0){
						     
						
						$paid_by = FCrtRplc($form_data['paid_by']);
						$type_id = FCrtRplc($form_data['type_id']);
						$no_pin = FCrtRplc($form_data['no_pin']);
						$bank_id = FCrtRplc($form_data['bank_id']);
						$payment_date = InsertDate($today_date);
						$payment_sts = FCrtRplc($form_data['payment_sts']);
						$pin_price = FCrtRplc($form_data['pin_price']);
						$pin_activation = FCrtRplc($form_data['pin_activation']);
						$activation_price = FCrtRplc($form_data['activation_price']);
						$request_date = $trns_date = InsertDate($today_date);
						$trans_ref_no = UniqueId("TRNS_NO");
						$AR_PACK =  $model->getPinType($type_id);
						
						
					
						$data = array("type_id"=>$type_id,
							"trans_no"=>$trans_ref_no,
							"no_pin"=>$no_pin,
							"net_amount"=>$net_amount,
							"member_id"=>$member_id,
							"activation_price"=>$activation_price,
							"pin_activation"=>$pin_activation,
							"bank_id"=>($bank_id>0)? $bank_id:0,
							"payment_date"=>InsertDate($today_date),
							"payment_sts"=>($narration)? $narration:" ",
							"ip_address"=>$_SERVER['REMOTE_ADDR'],
							"request_date"=>$today_date,
							"assign_sts"=>"Y"
						);
						$data_mstr = array("type_id"=>$type_id,
							"no_pin"=>$no_pin,
							"prod_pv"=>$AR_PACK['prod_pv'],
							"pin_price"=>$pin_price,
							"pin_activation"=>$activation_price,
							"net_amount"=>$net_amount,
							"member_id"=>$member_id,
							"bank_id"=>$bank_id,
							"payment_date"=>$payment_date,
							"payment_sts"=>($payment_sts)? $payment_sts:" ",
							"ip_address"=>$_SERVER['REMOTE_ADDR'],
							"generate_by"=>0
						);
						if($no_pin>0){
							$payment_sts = "PIN PURCHASE [".$AR_MEM['user_id']."]";
							$request_id = $this->SqlModel->insertRecord(prefix."tbl_pin_request",$data);
							$mstr_id = $this->SqlModel->insertRecord(prefix."tbl_pinsmaster",$data_mstr);
							$model->generatePinDetail($mstr_id);
							
							$debit_wallet_from = ($wallet_type==0)? $model->getWallet(WALLET1):$wallet_id;
							$this->OperationModel->wallet_transaction($debit_wallet_from,"Dr",$member_id,$net_amount,$payment_sts,$trns_date,$trans_ref_no,1,"PIP");
							
							set_message("success","You have successfully generated your e-pin");
							redirect_member("epin","pinrequest",array("request_id"=>_e($request_id)));
						}else{
							set_message("warning","Unable to send E-pin request");
							redirect_member("epin","newrequest","");
						}			
					  
				}else{
					set_message("warning","Invalid transaction password, please try again");
					redirect_member("epin","newrequest","");
				}
			}else{
				set_message("warning","It seem  you have low balance to send E-pin request");
				redirect_member("epin","newrequest","");
			}
			}
			else{
			//Request From Admin
			if($model->checkTrnsPassword($member_id,$trns_password)>0){
						     
						
						$paid_by = FCrtRplc($form_data['paid_by']);
						$type_id = FCrtRplc($form_data['type_id']);
						$no_pin = FCrtRplc($form_data['no_pin']);
						$bank_id = FCrtRplc($form_data['bank_id']);
						$bank_name = FCrtRplc($form_data['bank_name']);
						$trnsId = FCrtRplc($form_data['trnsId']);
						$payment_date = InsertDate($today_date);
						$payment_sts = FCrtRplc($form_data['payment_sts']);
						$pin_price = FCrtRplc($form_data['pin_price']);
						$pin_activation = FCrtRplc($form_data['pin_activation']);
						$activation_price = FCrtRplc($form_data['activation_price']);
						$request_date = $trns_date = InsertDate($today_date);
						$trans_ref_no = UniqueId("TRNS_NO");
						$AR_PACK =  $model->getPinType($type_id);
						
						
					

						$data_mstr = array("type_id"=>$type_id,
							"no_pin"=>$no_pin,
							"prod_pv"=>$AR_PACK['prod_pv'],
							"pin_price"=>$pin_price,
							"pin_activation"=>$activation_price,
							"net_amount"=>$net_amount,
							"member_id"=>$member_id,
							"request_memer_id"=>$member_id,
							"bank_id"=>$bank_id,
							"payment_date"=>$payment_date,
							"payment_sts"=>($payment_sts)? $payment_sts:" ",
							"ip_address"=>$_SERVER['REMOTE_ADDR'],
							"generate_by"=>0
						);
						if($no_pin>0){
						    
						    
						//	$payment_sts = "PIN PURCHASE [".$AR_MEM['user_id']."]";
							$mstr_id = $this->SqlModel->insertRecord(prefix."tbl_pinsmaster",$data_mstr);
							$data = array("type_id"=>$type_id,
							"mstr_id"=>$mstr_id,
							"trans_no"=>$trans_ref_no,
							"no_pin"=>$no_pin,
							"net_amount"=>$net_amount,
							"member_id"=>$member_id,
							"activation_price"=>$activation_price,
							"pin_activation"=>$pin_activation,
							"bank_id"=>($bank_id>0)? $bank_id:0,
							"bank_name"=>$bank_name,
							"trnsId"=>$trnsId,
						
							"payment_date"=>InsertDate($today_date),
							"payment_sts"=>($payment_sts)? $payment_sts:" ",
							"ip_address"=>$_SERVER['REMOTE_ADDR'],
							"request_date"=>$today_date,
							"assign_sts"=>"N"
						);
							$request_id = $this->SqlModel->insertRecord(prefix."tbl_pin_request",$data);
							
							if($_FILES['slip']['error']=="0"){
				$ext = explode(".",$_FILES['slip']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$slip_file = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/pin_slip/".$slip_file;
				
					if(move_uploaded_file($_FILES['slip']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_pin_request",array("slip_file"=>$slip_file),array("request_id"=>$request_id));
					
						
					}
			}
							
							
							
							
						//	$model->generatePinDetail($mstr_id);
							
							//$debit_wallet_from = ($wallet_type==0)? $model->getWallet(WALLET1):$wallet_id;
							//$this->OperationModel->wallet_transaction($debit_wallet_from,"Dr",$member_id,$net_amount,$payment_sts,$trns_date,$trans_ref_no,1,"PIP");
							
							set_message("success","You have successfully send request for new e-pin");
							redirect_member("epin","pinrequest",array("request_id"=>_e($request_id)));
						}else{
							set_message("warning","Unable to send E-pin request");
							redirect_member("epin","newrequest","");
						}			
					  
				}else{
					set_message("warning","Invalid transaction password, please try again");
					redirect_member("epin","newrequest","");
				}
			}
		}
	
		
		$this->load->view(MEMBER_FOLDER.'/epin/newrequest',$data);
	}
	
public function getEpinNo()
{
    $member_id = $this->session->userdata('mem_id');
    	$model = new OperationModel();
	$id =  $this->input->post('id');
  $available =      $model->countunusedPin($member_id,$id); 
	echo "<select name='no_pin' id='no_pin' class='form-control' required>";
	if($available > 0 )
	{
 echo "<option value=''  selected> Select Pin</option>";      
	}
	else
	{
	 echo "<option value=''  selected>No Pin Available</option>";      
	}
  
   for($i=1;$i<=$available;$i++)
						{
	     echo "<option value='".$i."'   >".$i."</option>";   
	    }
	   

echo "</select>";
}
	public function transferEpin(){		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
	  
		$today_date = getLocalTime();
		$AR_MEM = $model->getMember($member_id);
		
	  
		if($form_data['submitFundRequest']==1 && $this->input->post()!=''){
	 	$to_member_id = $model->getMemberId(FCrtRplc($form_data['user_id']));
		$no_pin  = FCrtRplc($form_data['no_pin']);
		$trns_password = FCrtRplc($form_data['trns_password']);
		
		$pin_type = FCrtRplc($form_data['pin_type']);
		$available =      $model->countunusedPin($member_id,$pin_type);
		$userId = FCrtRplc($form_data['user_id']);
		if($to_member_id>0){
			if($to_member_id!=$member_id){
				if($no_pin <= $available){
			
				if($model->checkOldPassword($member_id,$trns_password)>0){
				
				
				
 	 
        $QR_SELECT= "SELECT *  FROM ".prefix."tbl_pinsdetails AS tpd   WHERE tpd.pin_sts='N'  AND tpd.member_id>0 AND tpd.member_id='".$member_id."' AND tpd.type_id='".$pin_type."'   LIMIT  $no_pin";
        $RS_SELECT = $this->db->query($QR_SELECT);
	    $AR_SELECT = $RS_SELECT->result_array();
		foreach( $AR_SELECT as $AR_DT)
		{
		$pin_letter = "LP";
		$new_pin_key = $model->getPinKey($pin_letter);
		$new_pin_no =    $model->getPinNo();
		 	$this->SqlModel->updateRecord(prefix."tbl_pinsdetails",array("member_id"=>$to_member_id,"pin_no"=>$new_pin_no,"pin_key"=>$new_pin_key),array("pin_id"=>$AR_DT['pin_id']));
		$isertedData = array( 'pin_id'=>$AR_DT['pin_id'],	
		                      'type_id'=>$AR_DT['type_id'],	
		                      'old_pin_no'=>$AR_DT['pin_no'],
							  'new_pin_no'=>$new_pin_no,
							  'old_pin_key'=>$AR_DT['pin_key'],
							  'new_pin_key'=>$new_pin_key,
							  'from_member_id'=>$member_id,
							  'to_member_id'=>$to_member_id,
							  'transfer_date'=>  $today_date );
			  $this->SqlModel->insertRecord(prefix."tbl_pin_transfer",$isertedData);
		}
		set_message("success","You have successfully Transfer in  E-pin $userId");
		 redirect_member("epin","transferEpin","");
				
					}
					else{
							set_message("warning","Invalid login password, please try again");
							redirect_member("epin","transferEpin","");
						}
						
				}
					else{
							set_message("warning","Invalid pin selection, please try again");
							redirect_member("epin","transferEpin","");
						}		
			
			}
			else{
					set_message("warning","You cannot send Epin to your own id");
					redirect_member("epin","transferEpin","");
				 }
		}else{
				set_message("warning","Invalid member id , please enter valid");
				redirect_member("epin","transferEpin","");
			}
		
		}
		
		$this->load->view(MEMBER_FOLDER.'/epin/transferEpin',$data);
	}	
	
}
