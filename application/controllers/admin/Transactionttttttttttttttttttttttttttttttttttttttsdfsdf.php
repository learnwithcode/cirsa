<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	 	$opr_id = $this->session->userdata('oprt_id');
        if($opr_id == '8')
        {
        
        redirect_page("homepage","","");
        }
            
	}
	public function index() {
                $model = new OperationModel();
                //PrintR($this->session->all_userdata());die;
                $trns_date = date('Y-m-d H:i:s');
                $form_data = $this->input->post();
                $oprt_id = $this->session->userdata('oprt_id');
                $details  = $model->getOperator($oprt_id);
                
        
                if($details['initiat'] =='N')
                {
                    
                if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
                    
            		    $loginId      = FCrtRplc($form_data['loginId']);
            		    $key     = FCrtRplc($form_data['key']);
            		    $answer     = FCrtRplc($form_data['answer']);
            		    $password    = FCrtRplc($form_data['password']);
		    
		    $data = array(
                    "t_id"    =>_e($loginId),
                    "t_key"   =>_e($key),
                    "t_ans"   =>_e($answer),
                    "t_pass"  =>_e($password),
                    "initiat" =>'Y'
			);	

			if($oprt_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_operator",$data,array("oprt_id"=>$oprt_id));
				set_message("success","Successfully updated Transaction  details");
				redirect_page("transaction","index",array());
			} }
			    $this->load->view(ADMIN_FOLDER.'/transaction/auth',$data);
                }
                else 
                {
                $t_id = $this->session->userdata('t_id');
                $t_pass = $this->session->userdata('t_pass');
                
                if($details['t_id'] == $t_id and   $details['t_pass'] == $t_pass and($t_pass !='' and $t_id !='' ) )
                {
                    	redirect_page("transaction","home",array());  
                }
                else
                {
                 
                 if($form_data['submitMemberLogin']==1 && $this->input->post()!=''){ 
                 $status = $model->checkTransactionLogin($form_data['loginId'], $form_data['pass'] , $form_data['key'] , $form_data['answer']  );   
                   if($status)
                   {
                       
                         $this->session->set_userdata('t_id',_e($form_data['loginId']));
                         $this->session->set_userdata('t_pass',_e($form_data['pass']));
                      set_message("success","Successfully Log-in Transaction  Panel");
				      redirect_page("transaction","home",array()); 
                   }
                   else
                   {
                      set_message("danger","Enter invalid details !");
				      redirect_page("transaction","index",array()); 
                   }
                 }
                
                $this->load->view(ADMIN_FOLDER.'/transaction/login',$data);    
                }  
                
                    
                }
                
                	 
            
	  	    
		  			
	} 
	public function home() 	{ 
	    $model = new OperationModel();
	    // PrintR($this->session->all_userdata());die;
        $t_id = $this->session->userdata('t_id');
        $t_pass = $this->session->userdata('t_pass'); 
        if($t_id == '' or     $t_pass =='' )
                { 
                    	redirect_page("transaction","index",array());  
                }
                
                
                
                
	    $this->load->view(ADMIN_FOLDER.'/transaction/home',$data);     } 
	
	public function make_withdrawal() {
		  $model = new OperationModel();
		   $t_id = $this->session->userdata('t_id');
        $t_pass = $this->session->userdata('t_pass'); 
        if($t_id == '' or     $t_pass =='' )
                { 
                    	redirect_page("transaction","index",array());  
                }
                
		  $order_idd  =time().rand('1111',9999);
		  $substr = substr($order_idd, 4, 14);
	      $order_idd =    'CWCX'.$substr;
		  $form_data = $this->input->post();
		   
		  if($form_data['submitform'] > 0 && $this->input->post() !='')
	      { 
	      
	       
	        
	       $userId = $form_data['user_id'];
           $member_id = $model->getMemberId($userId);
	       $LDGR = $model->getCurrentBalance($member_id,1);
	       $wallet = 	$LDGR['net_balance'];
	       $amount = $form_data['amount'];
	       $amount1 = 0;
	       
	        $randcheckS =    $this->session->userdata('rand');
	        $randcheckF =    $form_data['randcheck'] ;  //
	       // PrintR($form_data);die;
	            
	            if($randcheckS == $randcheckF) { 
	            $this->session->unset_userdata('rand');
	              
            $charge =    $amount *3/100;
            $amount1 =   $amount -$charge;
            $date =date('Y-m-d');
            $todayTrns = $model->getTotdayTransfers($member_id,$date);
            
	       //$CONFIG_WITHDRAWL_LIMIT = $model->getValue("CONFIG_WITHDRAWL_LIMIT");    
        //   if($todayTrns < $CONFIG_WITHDRAWL_LIMIT  ){ }else{  redirect_page("transaction","make_withdrawal",set_message("danger","You have already withdrawal Today please try next day"));     } 
	       $CONFIG_MAX = $model->getValue("CONFIG_MAX_WITHDRAWL");       
           if($amount > $CONFIG_MAX) {   redirect_page("transaction","make_withdrawal",set_message("danger","Maximum amount should be $.".$CONFIG_MAX."/-"));      }
	       if(($amount) >   ($LDGR['net_balance']))  { redirect_page("transaction","make_withdrawal",set_message("dnager","You have Low wallet balence."));    }
	                
            $bankDetail = $model->getBankDetailMember($member_id);
            $account_number =   $bankDetail['account_number'];
            $ifc_code       =   $bankDetail['ifc_code'];
            $bank_acct_holder  =   $bankDetail['bank_acct_holder'];
             $member_mobile    =  $bankDetail['member_mobile'];        
		      
            //  $getcounts = $model->getDmtcountsbymobAc($account_number,$member_mobile,$date);
            //  if( $getcounts >= $CONFIG_WITHDRAWL_LIMIT)
            //  {
            //   redirect_member("moneytransfer","index",set_message("danger","This mobile no or A/c No already withdrawal done Today please try next day"));    
            //  }

           $moneytransfer_data = array(
		                            'member_id'=>$member_id,
					                'ben_name'=> $bank_acct_holder, 
			                        'account_number'=>$account_number,
			                        'ifsc_code' =>$ifc_code,
									'mode'=>'IMPS',
									 "mobile" =>$member_mobile,
									'amount'=>$amount1*75,
									'dmt_amt' =>$amount*75,
                                    'charge'=>($charge)*75,
                                    'total'=>$amount*75,
                                    'rate'=>0,
									'orderid'=>$order_idd,
									'type'=>'2',
									'txid' => '',
									'status' =>  'Pending',
									'message' =>  '',
									'operator_message' =>  '',
									'response' => '',
									'date'=>date('Y-m-d H:i:s')
									);
									
							 
                                $trns_id =     $this->SqlModel->insertRecord(prefix."tbl_money_transfer",$moneytransfer_data);
      
                                $trns_date = date('Y-m-d H:i:s');
                                $trans_no = UniqueId("TRNS_NO");
                                $userid = $this->session->userdata('user_id');
								$trns_remark = "Money Transfer FROM [".$userid."]  Name :".$bank_acct_holder.' A/c: '.$account_number.' IFSC :'.$ifc_code ;
								$model->wallet_transaction(1,"Dr",$member_id,$amount,$trns_remark,$trns_date,$trans_no,"1","MT");
                               	set_message("success","your request has been successfully submited !");
						        redirect_page("transaction","make_withdrawal","");
          
	        }  
	        else
	        {
	             redirect_page("transaction","make_withdrawal",set_message("dnager","Invalid security error please try again ! "));  
	        }

	  }	

		      
		  
	 
	    
		$this->load->view(ADMIN_FOLDER.'/transaction/make_withdrawal',$data);
		      
		  
		}
    public function getUserdetails()
    {
            $model = new OperationModel();
            
            $userId = $this->input->post("userId");
            $member_id = $model->getMemberId($userId);
            $LDGR  = $model->getCurrentBalance($member_id,1);
            $bankDetail     = $model->getBankDetailMember($member_id);
            if(is_array($bankDetail) and !empty($bankDetail))
            {

 
                $AR_RT['name']  = $bankDetail['bank_acct_holder'];  
                $AR_RT['account_number']  = $bankDetail['account_number'];  
                $AR_RT['ifc_code']  = $bankDetail['ifc_code'];  
                $AR_RT['wallet']  = number_format((float)$LDGR['net_balance'], 2, '.', '');  
                $AR_RT['status']  = true; 
            }
            else
            {
               $AR_RT['status']  = false;   
            }
            
            echo json_encode($AR_RT);
    }
	   
	    
    public function addtransaction(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = getLocalTime();
		$segment = $this->uri->uri_to_assoc(2);
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
	$wallet_trns_id = ($form_data['wallet_trns_id'])? $form_data['wallet_trns_id']:$segment['wallet_trns_id'];
		
	 
		
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitTransaction']==1 && $this->input->post()!=''){
				 $wallet_id = ($form_data['wallet_id']>0)? $form_data['wallet_id']:0;
				   
					$member_id = $model->getMemberId($form_data['user_id']);
					
				 
					
					$withdraw_fee_percent = 0;
					$deposit_fee_percent = 0;
					$process_fee_percent = 0;
					
					$initial_amount = FCrtRplc($form_data['initial_amount']);
						$trns_remark = FCrtRplc($form_data['trns_remark']);
					$trns_type = FCrtRplc($form_data['trns_type']);
					$trns_date = $today_date;
					$trans_no = UniqueId("TRNS_NO");
					
					if($trns_type=="Dr"){
						$WITDRAW_FEE = ($initial_amount*$withdraw_fee_percent/100); 
					}
					if($trns_type=="Cr"){
						$DEPOSITE_FEE = ($initial_amount*$deposit_fee_percent/100);
					}
					$PROCESS_FEE = ($initial_amount*$process_fee_percent/100);
					
					$CONFIG_ADMIN_CHARGE_PERCENT =  ($initial_amount*$CONFIG_ADMIN_CHARGE/100); 
					$admin_charge = 0;
					$total_charge = ($admin_charge+$WITDRAW_FEE+$DEPOSITE_FEE+$PROCESS_FEE);
					$trns_amount = ($initial_amount-$total_charge);
					 
					
					if(is_numeric($initial_amount) && $initial_amount>0){
					 
				     $to_member_id = FCrtRplc($member_id);
					 $to_user_id = $model->getMemberUserId($to_member_id);
					 $trns_status = "C";
				 
					$trans_no = UniqueId("TRNS_NO");
					
				
						if($to_member_id>0){
							$data = array(
							    "wallet_id"=> ($wallet_id>0)? $wallet_id:0,
								"trans_no"=>$trans_no,
								"from_member_id"=>0,
								"to_member_id"=>$to_member_id,
								"initial_amount"=>$initial_amount,
								"withdraw_fee"=> 0,
								"deposit_fee"=>0,
								"process_fee"=>0,
								"admin_charge"=>0,
								"trns_amount"=>$trns_amount,
								"trns_remark"=>$trns_remark,
								"trns_type"=>$trns_type,
								"trns_for"=>($trns_type=='Cr')? 'Deposit':'Withdrawal',
								"trns_status"=>"C",
								"draw_type"=>($trns_type=='Cr')? 'NA':'MANUAL',
								"trns_date"=>$today_date
							);
						 
							    
							$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
							$model->wallet_transaction($wallet_id,$trns_type,$to_member_id,$trns_amount,$trns_remark,$today_date,$trans_no,"1","AM");
						 
					 
							set_message("success","You have successfully added  a new  transaction");
							redirect_page("transaction","addtransaction",array("error"=>"success"));	
						}else{
							set_message("warning","Invalid member id");		
							redirect_page("transaction","addtransaction",array("request_id"=>_e($request_id)));
						}	
					    
					    
					    
					}else{
						set_message("warning","Invalid amount, please enter valid amount");
						redirect_page("transaction","addtransaction","");
					}					
				}
			 
			break;
		 
		}
		$this->load->view(ADMIN_FOLDER.'/transaction/addtransaction',$data);
	}
	public function dmtCredit() 	{
    $t_id = $this->session->userdata('t_id');
        $t_pass = $this->session->userdata('t_pass'); 
        if($t_id == '' or     $t_pass =='' )
                { 
                    	redirect_page("transaction","index",array());  
                }
	    $this->load->view(ADMIN_FOLDER.'/transaction/dmtCredit',$data);     } 
	    
	    public function cryptoCredit() 	{
    $t_id = $this->session->userdata('t_id');
        $t_pass = $this->session->userdata('t_pass'); 
        if($t_id == '' or     $t_pass =='' )
                { 
                    	redirect_page("transaction","index",array());  
                }
	    $this->load->view(ADMIN_FOLDER.'/transaction/cryptoCredit',$data);     } 
	    
	    
	public function dmtSuccess() 	{
	    	 $t_id = $this->session->userdata('t_id');
        $t_pass = $this->session->userdata('t_pass'); 
        if($t_id == '' or     $t_pass =='' )
                {
                    	redirect_page("transaction","index",array());  
                }
	    $this->load->view(ADMIN_FOLDER.'/transaction/dmtSuccess',$data);     } 
public function dmtPending() 	{ 
	    
            $model = new OperationModel();
            $t_id = $this->session->userdata('t_id');
            $t_pass = $this->session->userdata('t_pass'); 
            if($t_id == '' or     $t_pass =='' )
            {
            redirect_page("transaction","index",array());  
            }
	    
	   
	    
	      
	     $form_data = $this->input->post();
	     $senderId = $this->uri->segment(4); 
	     $type = $this->uri->segment(5); 
	     $trns_date = date('Y-m-d H:i:s');
	 
	     
	   
 if($senderId > 0  && $type == 'APP'){
 
            
            $details = $model->getSenderDetail($senderId);//PrintR($details);die;
            if(is_array($details) and !empty($details))
            {
                
            $wallet = 	 $model->getValue("VIRTUAL_WALLET");
            if($details['total']  > $wallet )
            {
                set_message("dander","You have low DMT wallet balance ... ");
				redirect_page("transaction","dmtPending",array()); 
            } 
            
            
             
                 
            $account_number =   $details['account_number'];
            $ifc_code =   $details['ifsc_code'];
            $bank_acct_holder =   $details['ben_name'];
            $order_idd =   $details['orderid'];   
		    $amount = $details['amount'] ;    
		    $charge = $details['charge'] ;    
		    $total = $details['total'] ;    
            $member_id = $details['member_id'] ;    
            
  $Sname = $_SERVER['SERVER_NAME'];  
  $parameters="serverName=$Sname";
  $url="https://vertoindia.in/dmt/api/getAuth";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
 

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
	$return_val = curl_exec($ch);
    $api_res = json_decode($return_val);   // PrintR($return_val);    die('dddd');
     
    if($api_res->Status)
    {
        $authKey  = $api_res->authKey;
        
        $user_id = $model->getMemberUserId($member_id);
        $order_idd = $this->checkOrderID($senderId,$order_idd);
        $parameters="authKey=$authKey&account_no=$account_number&amount=$amount&order_id=$order_idd&ifsc_code=$ifc_code&bene_name=$bank_acct_holder&serverName=$Sname&member_id=$member_id&user_id=$user_id";
  $url="https://vertoindia.in/dmt/api/multidmttrxn";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
    $api_result = json_decode($return_val);
    $api_recharge = $api_result->API;
    if($api_result->Status)
    {
        
             if($api_result->status =='FAILED') {$manage_sts ='Y'; $payu_sts = 'Y';} elseif($api_result->status =='SUCCESS') {$manage_sts ='Y';$payu_sts = 'N';} else{$manage_sts ='N'; $payu_sts = 'N';}
        $moneytransfer_data = array(
		                            "sub_req" =>'Y',
									'txid'    =>($api_result->opr_id !='')?$api_result->opr_id:'N/A',
									'status'  =>  ($api_result->status =='FAILED')?'Failure':'Success',
									'message' =>  $api_result->message,
									'operator_message' =>  $api_result->operator_message,
									'manage_sts' =>$manage_sts,
									'response'   =>json_encode($api_recharge),
									 'payu_sts' => $payu_sts,
									 'date'  =>date("Y-m-d H:i:s")
									);
									
      $this->SqlModel->updateRecord(prefix."tbl_money_transfer",$moneytransfer_data,array("sender_id"=>$senderId));
      if($api_result->status =='FAILED') {
	    
	    
	        $trans_no = rand(11111,88888888);
            $trns_remark = "Refunded";
            $model->wallet_transaction(1,"Cr",$member_id,$total/75,$trns_remark,$trns_date,$trans_no,"1","VW");
	        $mm=$api_result->operator_message;
             redirect_page("transaction","dmtPending",set_message("danger",$api_result->message."[" .$mm."]" )); 
    
      }else{
        
     
 	                   $userid =$model->getMemberUserId($member_id);

                        $trns_remark = "Money Transfer FROM [".$userid."]  Name :".$bank_acct_holder.' A/c: '.$account_number.' IFSC :'.$ifc_code ;
                        $trans_no = UniqueId("TRNS_NO");
                        $draw_amount = $draw_amount*$rate;
                        $model->wallet_transaction(20,"Dr",1,$total,$trns_remark,$trns_date,$trans_no,"1","DMT");
               	        $model->setWallet($total,'Dr');
               	  		$data = array(
               	  		            "to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>1,
									"mt_id" =>$senderId,
									"initial_amount"=>$amount,
									"admin_charge"=> 0,
									"withdraw_fee"=>$charge,
									"process_fee"=>0,
									"trns_amount"=>$total,
									"trns_status"=>"C",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"DMT",
									"trns_remark"=>"Withdrawal  Request from ".$userid,
								);
                        $transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
                        redirect_page("transaction","dmtPending",set_message("success","Your Money has been successfully transfered")); 
          }	
    }
    else
    {
          set_message("dander",$api_result->Msg);
				redirect_page("transaction","dmtPending",array()); 
    }
    }
     else
    {
                set_message("dander","This request can`t Proceed. Contact to your Service Provider... ");
				redirect_page("transaction","dmtPending",array());
    }
    
    
   

            
           
           
            
            }
            else
            {
                set_message("dander","Invalid Transaction Details ... ");
				redirect_page("transaction","dmtPending",array());
            }
            
			
     
     
 }
			
 if($senderId > 0  && $type == 'REJ'){
     
     
     $details = $model->getSenderDetail($senderId);
        $total = $details['total'] ;    
        $member_id = $details['member_id'] ;   
     	        $trans_no = rand(11111,88888888);
            $trns_remark = "Refunded";
            $model->wallet_transaction(1,"Cr",$member_id,$total/75,$trns_remark,$trns_date,$trans_no,"1","VW");
            $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("status"=>'FAILED',"manage_sts" =>'Y', "sub_req" =>'Y'),array("sender_id"=>$senderId));
            
            redirect_page("transaction","dmtPending",set_message("success","Your Request has been successfully refunded")); 
 }
			
	    
	    $this->load->view(ADMIN_FOLDER.'/transaction/dmtPending',$data);     }  
	
	public function dmtFailed() 	    {
	    	    $model = new OperationModel();
	   $t_id = $this->session->userdata('t_id');
        $t_pass = $this->session->userdata('t_pass'); 
        if($t_id == '' or     $t_pass =='' )
                {
                    	redirect_page("transaction","index",array());  
                }
	    $this->load->view(ADMIN_FOLDER.'/transaction/dmtFailed',$data);     } 
	public function rechargeSuccess() 	{
	    	    $model = new OperationModel();
	    $t_id = $this->session->userdata('t_id');
        $t_pass = $this->session->userdata('t_pass'); 
        if($t_id == '' or     $t_pass =='' )
                {
                    	redirect_page("transaction","index",array());  
                }
	    $this->load->view(ADMIN_FOLDER.'/transaction/rechargeSuccess',$data);     } 
	public function rechargeFailed() 	{
	    	    $model = new OperationModel();
	    $t_id = $this->session->userdata('t_id');
        $t_pass = $this->session->userdata('t_pass'); 
        if($t_id == '' or     $t_pass =='' )
                {
                    	redirect_page("transaction","index",array());  
                }
	    $this->load->view(ADMIN_FOLDER.'/transaction/rechargeFailed',$data);     } 
     public function refunddmt()         {
	    	$model = new OperationModel();
	        $k=0;
	        $trns_date = date('Y-m-d H:i:s');
	         
	         
	         
	        $process = $this->session->userdata("process_refund");
	        if($process =='1')
	        {
	        $this->session->unset_userdata("process_refund");
	  	    // $QR_MEM = "SELECT * FROM `tbl_money_transfer` WHERE `manage_sts` ='N'  and `sub_req` ='Y'   "; //
	  	     $QR_MEM = "SELECT * FROM `tbl_money_transfer` WHERE `payu_sts`  ='N'  and `sub_req` ='Y'"; 
	  	    //   $QR_MEM = "SELECT * FROM `tbl_money_transfer` WHERE status='Success' AND date(date) ='2021-07-06'"; //date(`date`) >='2021-06-15'
		    $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
		    if(is_array($RS_MEM) and !empty($RS_MEM))
		    { 
		        
		      //  $refund_prcess = $this->session->set_userdata('refund_prcess');
		      //  if($refund_prcess )
		      //  $this->session->set_userdata('refund_prcess','1');
		         foreach($RS_MEM as $AR_MEM){
	            $member_id =  $AR_MEM['member_id']  ;
                $total = $AR_MEM['total'] ;
                $dmt_amt = $AR_MEM['dmt_amt']; 
                $sender_id = $AR_MEM['sender_id'];  
                 
                
   $Sname = $_SERVER['SERVER_NAME'];  
  $order_idd =    $AR_MEM['orderid'];
  $parameters="serverName=$Sname&order_id=$order_idd "; 
  $url="https://vertoindia.in/dmt/api/multidmtsts";//dmtsts
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
	$return_val = curl_exec($ch);
    $response = json_decode($return_val); 
    $status   = $response->API;   //PrintR($response);die;
    $msg_sts = $response->msg_sts;
   if($response->Status)
   { 
       
    //   $response  = $AR_MEM['response'];  
    //             $res = json_decode($response);
    if($status  =='SUCCESS')
    {
        if($response->API_DATA->merchantRefId  == $order_idd)    
        {
        $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("manage_sts"=>'Y' ,'message'=>$msg_sts , 'payu_sts' => 'Y' , 'status' => 'Success' ,'txid' => $response->API_DATA->txnId , 'response' => json_encode($response->API_DATA) ),array("sender_id"=>$sender_id));     
        }
        else
        {
        $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("manage_sts"=>'Y' ,'message'=>$msg_sts, 'status' => 'Success', 'payu_sts' => 'Y'),array("sender_id"=>$sender_id));    
        }
      $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'C' ),array("mt_id"=>$sender_id));    
    }
    elseif($status    =='FAILED' or $status  =='REVERSAL'  ) //or $data->error_code =='NA'
    {
       
      $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("manage_sts"=>'Y','message'=>$msg_sts , 'status' => 'Failure' , 'payu_sts' => 'Y'),array("sender_id"=>$sender_id));    
      $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'R'  ),array("mt_id"=>$sender_id)); 
        
            $trans_no = rand(11111,88888888);
            $trns_remark = "Refunded";
            $k++;
            $amount = $AR_MEM['total'] ;
             $model->setWallet($amount,'Cr');
            $model->wallet_transaction(1,"Cr",$member_id, $AR_MEM['total']/75 ,$trns_remark,$trns_date,$trans_no,"1","VW");
    }
   
    
   }
    
		  	}
		  	
		  	 	set_message("success","You have successfully Refunded  ".$k."  Transaction");
							
		    }
		    else
		    {
		    
					 
							set_message("warning","Not found any pending Transaction");		
						 
		    }
		    
	       
		    redirect_page("transaction","home",array("error"=>"success"));	
	        }	
	        else
	        {
	            $this->session->unset_userdata("process_refund");
	       	set_message("warning","You have hitting multiple time Please wait some time . ");		  
		    redirect_page("transaction","home",array("error"=>"success"));  
	        }
	}
	public function withdrawals()       {
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date = getLocalTime();
		$trns_date = $today_date; 
		$t_id = $this->session->userdata('t_id');
        $t_pass = $this->session->userdata('t_pass'); 
        if($t_id == '' or     $t_pass =='' )
                {
                    	redirect_page("transaction","index",array());  
                }
		if($form_data['submitBankTransaction']==1 && $this->input->post()!=''){
		
			$transfer_id = _d($form_data['transfer_id']);
			$bank_tid = FCrtRplc($form_data['bank_tid']);
			$date_time = InsertDate($form_data['date_time']);
			$bank_trans_no = FCrtRplc($form_data['bank_trans_no']);
			$bank_trans_detail = FCrtRplc($form_data['bank_trans_detail']);
			
			$bank_name = FCrtRplc($form_data['bank_name']);
			$bank_account_no = FCrtRplc($form_data['bank_account_no']);
			
			$data = array("transfer_id"=>$transfer_id,
				"date_time"=>$date_time,
				"bank_name"=>($bank_name!='')? $bank_name:" ",
				"bank_account_no"=>($bank_account_no!='')? $bank_account_no:" ",
				"bank_trans_no"=>($bank_trans_no!='')? $bank_trans_no:" ",
				"bank_trans_detail"=>($bank_trans_detail!='')? $bank_trans_detail:" "
			);
			if($bank_tid>0){
				$this->SqlModel->updateRecord(prefix."tbl_bank_transaction",$data,array("bank_tid"=>$bank_tid));
				set_message("success","You have successfully updated bank transaction detail");	
				redirect_page("transaction","withdrawals",array()); exit;
			}else{
				$this->SqlModel->insertRecord(prefix."tbl_bank_transaction",$data);
				set_message("success","You have successfully added bank transaction detail");	
				redirect_page("transaction","withdrawals",array()); exit;
			}
		}
		if($form_data['confirmWithdraw']==1 && $this->input->post()!=''){
			
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'C',"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
								
		//	$model->wallet_transaction($AR_TRF['wallet_id'],"Dr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request approved",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");
							}
					}
				endforeach;
				set_message("success","Fund request confirmed successfull");		
				redirect_page("transaction","withdrawals",array());
			}else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("transaction","withdrawals",array());
			}
		}
		if($form_data['rejectWithdraw']==1 && $this->input->post()!=''){
			
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'R',"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
									$model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");							
							}
					}
				endforeach;
				set_message("success","Fund request rejected successfull");		
				redirect_page("transaction","withdrawals",array());
			}else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("transaction","withdrawals",array());
			}
		}
		$this->load->view(ADMIN_FOLDER.'/transaction/withdrawals',$data);
	}
	
	public function checkOrderID($senderId,$order_idd) {
	   $model = new OperationModel(); 
	   
	   $count = $model->checkCount("tbl_money_transfer","orderid" ,$order_idd);
	   if($count =='1')
	   {
	       return $order_idd;
	   }
	   else
	   {
	       $order_id = $model->getOrderId($order_idd);
	       $this->SqlModel->updateRecord("tbl_money_transfer",array("orderid"=>$order_id ),array("sender_id"=>$senderId));
	       return $order_id;
	   }
	   
	}
	
	
	
	public function refundbyTrns()         {
	    	$model = new OperationModel();
	        $k=0;
	        $trns_date = date('Y-m-d H:i:s');
	        
	         $post = $this->input->post();
	    if(is_array($post) and !empty($post))
	    {
	        $txid = $post['order_id']; 

	        if($post['filter_by'] =='transaction_id')  { $QR_MEM = "SELECT * FROM `tbl_money_transfer` WHERE status='Success' AND txid ='$txid'";   }
	        else { $QR_MEM = "SELECT * FROM `tbl_money_transfer` WHERE status='Success' AND  orderid ='$txid' ";   }
		    $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);   
		    
		    
		    
		    if(is_array($RS_MEM) and !empty($RS_MEM))
		    { 
		        
		     
		        foreach($RS_MEM as $AR_MEM){
	            $member_id =  $AR_MEM['member_id']  ;
                $total = $AR_MEM['total']/75 ;
                $dmt_amt = $AR_MEM['dmt_amt']; 
                $sender_id = $AR_MEM['sender_id'];  
                
                
   $Sname = $_SERVER['SERVER_NAME'];  
  $order_idd =    $AR_MEM['orderid'];
  $parameters="serverName=$Sname&order_id=$order_idd "; 
  $url="https://vertoindia.in/dmt/api/multidmtsts";//dmtsts
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
	$return_val = curl_exec($ch);
    $response = json_decode($return_val); 
    $status   = $response->API;   //PrintR($data);die;
    $msg_sts = $response->msg_sts;
   if($response->Status)
   { 
    if($status  =='SUCCESS')
    {
      $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("manage_sts"=>'Y' ,'message'=>$msg_sts, 'status' => 'Success'),array("sender_id"=>$sender_id));    
      $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'C' ),array("mt_id"=>$sender_id));    
      set_message("success","Not Refund already  success   this  ".$txid."  Transaction");
      
    }
    elseif($status    =='FAILED' or $status  =='REVERSAL'  ) //or $data->error_code =='NA'
    {
       
      $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("manage_sts"=>'Y','message'=>$msg_sts , 'status' => 'Failure'),array("sender_id"=>$sender_id));    
      $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'R'  ),array("mt_id"=>$sender_id)); 
      
        
            $trans_no = rand(11111,88888888);
            $trns_remark = "Refunded"; 
            $amount = $AR_MEM['total'] ;
            $model->setWallet($amount,'Cr');
            $model->wallet_transaction(1,"Cr",$member_id, $AR_MEM['total']/75 ,$trns_remark,$trns_date,$trans_no,"1","VW");
            set_message("success","You have successfully Refunded  ".$txid."  Transaction");
            
    }
   
    
   }
    
		  	}
		  	
		  	 
							
		    }
		    else {  set_message("warning","Not found any pending Transaction");	 }
	    }
	    else
	    {
	     set_message("warning","Invalid Access ! ");		   
	    }
	       
	 redirect_page("transaction","home",array("error"=>"success"));	    
	}
	
	public function gettrnsDetails()
	{
	    $post = $this->input->post();
	    if(is_array($post) and !empty($post))
	    {
	         $txid = $post['order_id'];
	         if($post['filter'] =='transaction_id') 
	         {
                $sql = "SELECT m.user_id,m.bank_acct_holder , t.total,t.status FROM `tbl_money_transfer` as t LEFT JOIN tbl_members as m on m.member_id = t.member_id WHERE t.`txid` ='$txid'    ";
                $data = $this->SqlModel->runQuery($sql,true);
                if(is_array($data) and !empty($data)) { $return['user_id'] = $data['user_id']; $return['name'] = $data['bank_acct_holder']; $return['amount'] = $data['total']; $return['status'] = $data['status'];} 
                else {$return['user_id']  = 'Not found !'; $return['name']  = ''; $return['amount']  = '';  $return['status'] = '';}
	        
	         }
	         else
	         {
	            $sql = "SELECT m.user_id,m.bank_acct_holder , t.total,t.status FROM `tbl_money_transfer` as t LEFT JOIN tbl_members as m on m.member_id = t.member_id WHERE t.`orderid` ='$txid'"; 
	            $data = $this->SqlModel->runQuery($sql,true);
	            if(is_array($data) and !empty($data)) { $return['user_id'] = $data['user_id']; $return['name'] = $data['bank_acct_holder']; $return['amount'] = $data['total']; $return['status'] = $data['status'];} 
                else {$return['user_id']  = 'Not found !'; $return['name']  = ''; $return['amount']  = '';  $return['status'] = '';}
	         }
	         
	         echo  json_encode($return);
	         
	         
	       

	    }
	}
	
	
	   public function dddddd() {
	    	$model = new OperationModel();
	        $k=0;
	        $trns_date = date('Y-m-d H:i:s');
	         
	         
	        
	           
   $Sname = $_SERVER['SERVER_NAME'];  
  
  $order_idd =    'AIGX7667567508'	;
  $parameters="serverName=$Sname&order_id=$order_idd "; 
  $url="https://vertoindia.in/dmt/api/multidmtsts2"; 
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
	$return_val = curl_exec($ch);
    $response = json_decode($return_val); 
    $status   = $response->API;    PrintR($response);die;
    
	}
			
	
	   
	    public function checkpan() {
	    	$model = new OperationModel();
	        $k=0;
	        $trns_date = date('Y-m-d H:i:s');
	         
	         
	        
	           
   $Sname = $_SERVER['SERVER_NAME'];  
  $pan_no= "CTVPP8529F";
  $order_idd =   "AIG". rand(11111111,99999999)	;
  $parameters="serverName=$Sname&order_id=$order_idd&pan_no=$pan_no "; 
  $url="https://vertoindia.in/dmt/api/pansts"; 
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
	$return_val = curl_exec($ch);
    $response = json_decode($return_val); 
    $status   = $response->API;    
      
	} 
	   
	    
	  public function refundbyQuery()         {
	    	$model = new OperationModel();
	        $k=0;
	        $trns_date = date('Y-m-d H:i:s');
	        
	 

	        $QR_MEM = "SELECT m.member_id, m.user_id , m.first_name , e.eligibility,t.sender_id,t.dmt_amt , SUM(d.net_income) as totalIncome,t.total FROM `tbl_cmsn_daily` as  d LEFT JOIN tbl_members as m ON m.member_id = d.member_id LEFT JOIN tbl_eligibility as e on e.rank_id = m.rank_id  LEFT JOIN tbl_money_transfer as t on t.member_id = d.member_id and t.status ='Pending' AND date(t.date) ='2021-09-28' WHERE d.member_id IN (SELECT member_id FROM tbl_money_transfer WHERE status ='Pending' AND date(date) ='2021-09-28' ) GROUP BY d.member_id HAVING(totalIncome >= 150) ORDER BY `totalIncome` ASC";   
	       
		    $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);   
		    
		    //PrintR($RS_MEM);die;
		    
		    if(is_array($RS_MEM) and !empty($RS_MEM))
		    { 
		        
		     
		        foreach($RS_MEM as $AR_MEM){
	            $member_id =  $AR_MEM['member_id']  ;
                $total = $AR_MEM['total']/75 ;
                $dmt_amt = $AR_MEM['dmt_amt']; 
                $sender_id = $AR_MEM['sender_id'];  
                
          
       
      $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("manage_sts"=>'Y','message'=>"Bank Server Downtime" , 'status' => 'Failure'),array("sender_id"=>$sender_id));    
       
        
            $trans_no = rand(11111,88888888);
            $trns_remark = "Refunded"; 
            $amount = $AR_MEM['total'] ;
           
            $model->wallet_transaction(1,"Cr",$member_id, $AR_MEM['total']/75 ,$trns_remark,$trns_date,$trans_no,"1","VW");
           
   
     
		  	}
		  	
		  	 
							
		    }
		   
	}
}
?>