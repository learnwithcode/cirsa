<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moneytransfer extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
	}

   public function sendOTP()
	    {
            $model = new OperationModel();
           
            $domain="text.awebcs.com";
            $method="POST"; $member_id =    $this->session->userdata('mem_id');
            $member =   $model->getrow('tbl_members','member_id',$member_id);
      
                    $mobile =  $member['member_mobile']; $user_id = $member['user_id'];
                    $rand = rand(111111,999999);  
                    $this->session->set_userdata('otp_mt',$rand);
                //  echo  $message ="Dear $user_id,Your Verification Code is $rand, Valid for 15 min. Don't share with anyone. Thanks AToken";
                  
              $message =     "Dear $user_id,
Your Verification Code is $rand, Valid for 15 min. Don't share with anyone.
Thanks
AToken
SMS ASIAN GLOB";
 
 $Q_MEM1 = "SELECT SUM(trns_amount) AS total_amount_cr  FROM tbl_sms_trns WHERE trns_type LIKE 'Cr' and    wallet_id ='25'   ORDER BY wallet_trns_id DESC";
	   $fetchRow1 = $this->SqlModel->runQuery($Q_MEM1,true);
	   $total_amount_cr = $fetchRow1['total_amount_cr'];
	   
	    $Q_MEM2 = "SELECT SUM(trns_amount) AS total_amount_dr FROM tbl_sms_trns WHERE trns_type LIKE 'Dr'   AND    wallet_id ='25'	$StrWhr ORDER BY wallet_trns_id DESC";
	   $fetchRow2 = $this->SqlModel->runQuery($Q_MEM2,true);
	   $total_amount_dr = $fetchRow2['total_amount_dr'];
                        $net_balance = $total_amount_cr-$total_amount_dr;
                        $AR_RT['total_amount_cr']=$total_amount_cr;
                        $AR_RT['total_amount_dr']=$total_amount_dr;
                        $AR_RT['net_balance']=$net_balance; 
                        $AR_RT['net_balance'];
                        
 
    if($AR_RT['net_balance'] > 0){
 
    $model->sendDynamicSMS($mobile,$message);
	$trans_no = UniqueId("TRNS_NO");    
	$remark = 'OTP Verification';    
	$model->smswallet_transaction('25',"Dr",1,'1',$remark,$today_date,$trans_no,1,$user_id);
	
	
	    }
 
    
 echo true;
	  
	}
	 
	 
				
	 
		
		public function index()
		{
		  $model = new OperationModel();
		  
		  
		  
		  if($model->getValue("Instant_status")=='Y'){
		  
		  $order_idd  =time().rand('1111',9999);
		  $substr = substr($order_idd, 4, 14);
	      $order_idd =    'ELTD'.$substr;
		  $form_data = $this->input->post();
		  $member_id =    $this->session->userdata('mem_id');
		  $day = date("D");
		  if($form_data['submitform'] > 0 && $this->input->post() !='')
	      { 
	          
	       //$RANK =   $model->getRanks($member_id);
	    
	       
            
	       $LDGR = $model->getCurrentBalance($member_id,1);
	       $wallet = 	$LDGR['net_balance'];
	       $amount = $form_data['amount'];
	       $trns_password = FCrtRplc($form_data['trns_password']);
	       $amount1 = 0;
	       
	          $randcheckS =    $this->session->userdata('rand');
	        $randcheckF =    $form_data['randcheck'] ;  //
	        if($model->checkOldPassword($member_id,$trns_password)>0){
	            
	            if($randcheckS == $randcheckF) { 
	            $this->session->unset_userdata('rand');
	             
	       $active = $model->getValue("DMT");
                if($active !='Y'){	
                	set_message("warning","Contact to your admin");
				   redirect_member("moneytransfer","index","");	    
                }
                
                  $CONFIG_INR_WITHDRAWAL =    $model->getValue("CONFIG_INR_WITHDRAWAL");
              
		      if( $CONFIG_CRYPTO_WITHDRAWAL =='N')
		      { 
		          	set_message("warning","You can`t withdraw please select ".$CONFIG_CRYPTO_WITHDRAWAL);
					redirect_member("moneytransfer","index","");
		      }
                	$CryptoSts = $model->getWithdrawStsCrypto($member_id);
						if($CryptoSts <= '0')
						{
                                set_message("warning","Your Withdraw is disabled please contact your Leader or Admin.");
                              	redirect_member("moneytransfer","index","");
						}
	 
	 
	  $checkParents = $model->checkPrentsIdorNot($member_id);
		    if($checkParents > 0 )
		    {
                    set_message("warning","You can`t withdraw this is Child  ID you withdraw from parent ID.");
                   	redirect_member("moneytransfer","index","");   
		    }
	 
            $charge =    $amount *5/100;
            $amount1 =   $amount -$charge;
     
	   
	   
	   
                $otp =$form_data['otp']; 
                $otp_mt  = $this->session->userdata('otp_mt'); 
                $this->session->unset_userdata('otp_mt');   
 
	 if($otp_mt  !=$otp)   
	 {
	       //redirect_member("dashboard","index",set_message("danger","You have Enter Invalid OTP."));  
	 }




	      
	     $CONFIG_MIN = $model->getValue("CONFIG_MIN_WITHDRAWL");       
         if($amount < $CONFIG_MIN)
	     { 
	         	
	       redirect_member("moneytransfer","index",set_message("danger","Minimum amount should be $ .".$CONFIG_MIN."/-"));     
	     }
	     $date =date('Y-m-d');
	     $todayTrns = $model->getTotdayTransfers($member_id,$date);
	   //  $todayTrns2 = $model->getTotdayTransfers($member_id,InsertDate(AddToDate($date,"-1 Day")));  
    //      $todayTrns = $todayTrns + $todayTrns2;
           
           
	       $CONFIG_WITHDRAWL_LIMIT = $model->getValue("CONFIG_WITHDRAWL_LIMIT");    
           if($todayTrns < $CONFIG_WITHDRAWL_LIMIT  ){ }else{  redirect_member("dashboard","index",set_message("danger","You have already withdrawal Today please try next day"));     } 
	       $CONFIG_MAX = $model->getValue("CONFIG_MAX_WITHDRAWL");       
           if($amount > $CONFIG_MAX) {   redirect_member("dashboard","index",set_message("danger","Maximum amount should be $.".$CONFIG_MAX."/-"));      }
	       if(($amount) >   ($LDGR['net_balance']))  { redirect_member("dashboard","index",set_message("dnager","You have Low wallet balence."));    }
	      /* $LDGR1 = $model->getCurrentBalance(1,20,"","");
		   if(($amount31*75)> $LDGR1['net_balance']){ set_message("warning","Contact to your admin"); redirect_member("moneytransfer","index","");	 }
            */          
            $bankDetail = $model->getBankDetailMember($member_id);
            $account_number =   $bankDetail['account_number'];
            $ifc_code =   $bankDetail['ifc_code'];
            $bank_acct_holder =   $bankDetail['bank_acct_holder'];
            
             $member_mobile    =  $bankDetail['member_mobile'];        
		          
	            	     
 
             
             $getcounts = $model->getDmtcountsbymobAc($account_number,$member_mobile,$date);
             if( $getcounts >= 2)
             {
              redirect_member("moneytransfer","index",set_message("danger","This mobile no or A/c No already withdrawal done Today please try next day"));    
             }
             
             if($model->getBulkByCount($member_id) > 0)
             {

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
									
								//	PrintR($moneytransfer_data);die;
                                $trns_id =     $this->SqlModel->insertRecord(prefix."tbl_money_transfer",$moneytransfer_data);
      
                                $trns_date = date('Y-m-d H:i:s');
                                $trans_no = UniqueId("TRNS_NO");
                                $userid = $this->session->userdata('user_id');
								$trns_remark = "Money Transfer FROM [".$userid."]  Name :".$bank_acct_holder.' A/c: '.$account_number.' IFSC :'.$ifc_code ;
								$model->wallet_transaction(1,"Dr",$member_id,$amount,$trns_remark,$trns_date,$trans_no,"1","MT");
                               	set_message("success","your request has been successfully submited !");
						      	redirect_member("moneytransfer","index","");
						        
             }
             else
             {
                        set_message("warning","This is Child Id Withdrawal available only Parent ID !");
                        	redirect_member("moneytransfer","index","");	
             }
          
	        } else{  
						set_message("warning","Invalid security error please try again!");
						redirect_member("moneytransfer","index","");	
					}

	        }else{
						set_message("warning","Invalid User password");
						redirect_member("moneytransfer","index","");	
					}

	  }	

		      
		  }
else{
		      
		    set_message("warning","Withdrawal request unavailable ! Please try after some time  .");
		    	redirect_member("dashboard","index","");
		  }
$data['web_title'] = 'Bank Transfer';  
 		$this->load->view(MEMBER_FOLDER.'/moneytransfer/instanttransfer',$data);
	    
		
		      
		  
		}
	

	 
	
	
}
