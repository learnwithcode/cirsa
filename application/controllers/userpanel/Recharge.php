<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge extends MY_Controller {
	
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
	 

          
public function index(){
		$model = new OperationModel();
		 
		if($model->getValue("Recharge_status")=='Y'){
		
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = '1';
        $trns_date = date('Y-m-d H:i:s');
       
		if(!empty($form_data) && is_array($form_data))
		{
                   $userId = 	   $this->session->userdata('user_id');		   
                        
                $circle =  FCrtRplc($form_data['circle']);
                $amount =  FCrtRplc($form_data['amount']);
                $number =  FCrtRplc($form_data['number']);
                $operator =  FCrtRplc($form_data['operator']); 
                $redeem = FCrtRplc($form_data['redeem']);
                $type =  FCrtRplc($form_data['type']);
                
	            $LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		       // $rate= $model->getValue('CONFIG_RATE');
		        
		       //  $LDGR1 = $model->getCurrentBalance(1,20,"","");
                
                    
                 $wallet = 	 $model->getValue("VIRTUAL_WALLET");    
		        //if($amount <= $LDGR1['net_balance']){
		         if( $amount <=  $wallet )
               {
		    	if(($amount/75) <=  ($LDGR['net_balance'])){
		    	    
		    //	  	$RWAL = $model->getCurrentBalanceRecharge();
		    	    //	if($amount<=$RWAL['net_balance']){
		    	    	    
	    $recharge_number = $number;
        $amount = $amount;
        $reid = rand(1111111111,9999999999);
        $operator_code = $operator;
            
 
                
                $Sname = $_SERVER['SERVER_NAME'];  
               
                $parameters="serverName=$Sname&recharge_number=$recharge_number&amount=$amount&operator_code=$operator_code&circle=$circle&reid=$reid&type=$type"; 
                $url="https://vertoindia.in/dmt/api/rechargetxn"; 
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);   
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
                $return_val = curl_exec($ch);
                $response = json_decode($return_val); 
                $api_recharge    = $response->API;
              // PrintR($response);die;
             
             
                
               	
               	
               $posted_data = array(
                    "member_id" => $member_id,
                    "status"    =>   $api_recharge->status,
                    "order_id"  => $api_recharge->order_id ,
                    "opr_id"    => $operator,
                    "txn_id"    => $api_recharge->opr_id,
                    "balance"   => $api_recharge->balance ,
                    "number" => $number ,
                    "provider" => $api_recharge->provider ,
                    "amount" => $amount ,
                    "charged_amount" => $api_recharge->charged_amount ,
                    "message" => $api_recharge->message ,
                    "type" =>$type,
                    "response"=>json_encode($response->API)
                    );
                    
                    
 	 
                $this->SqlModel->insertRecord(prefix."tbl_recharge",$posted_data);
               	if($api_recharge->status == 'SUCCESS' or $api_recharge->status == 'PENDING')
               	{
               	
               	// $reward_amt = 0;
               	// if($redeem == 'on')
               	// {
               	//     $per = $amount*2/100;
               	//   	$LDGR1 = $model->getCurrentBalance($member_id,5,"","");
               	//   		if($LDGR1['net_balance'] > 0  ){
               	//   		    if($LDGR1['net_balance'] >= $per)
               	//   		    {
               	//   		      $reward_amt =   $per;
               	//   		    }
               	//   		    else
               	//   		    {
               	//   		          $reward_amt =   $LDGR1['net_balance'];
               	//   		    }
               	// //   	$trns_remark = 'Redeem Reward Point ['.$reward_amt.'] recharged on '.$recharge_number.' Rs.'.$amount;
               	// //   	$trans_no = UniqueId("TRNS_NO");
               	// //   	$model->wallet_transaction(5,"Dr",$member_id,$reward_amt,$trns_remark,$trns_date,$trans_no,"1","RECHARGE");
               	// }
               	 
               	   
               	  	
               	  	
               	  		    
               	//   		}
               	  		    
               	  	$trns_remark = 'Successfully recharged on '.$recharge_number.' Rs.'.$amount;
               	   	$trans_no = UniqueId("TRNS_NO");
               	   	$amt = $amount/75 ;
               	  	$model->wallet_transaction($wallet_id,"Dr",$member_id,$amt,$trns_remark,$trns_date,$trans_no,"1","UTILITY");	  
                    $model->setWallet($amount,'Dr');
              		
               	    
               	  	
                    set_message("success","Your Recharge has been success.");
                    redirect_member("recharge","index","");	  
               	}
               	elseif($api_recharge->error_code > 0 )
               	{
               	 	set_message("warning",$api_recharge->message);
				    redirect_member("recharge","index","");	    
               	}
               	else
               	{
               	 	set_message("warning","Something went wrong , please try again.");
				    redirect_member("recharge","index","");	   
               	}
         
    
                
              
		    	    //	}
		    	    	// else
		    	    	// {
		    	    	//     set_message("warning","Low Recharge Amount Please Contact to Admin.");
				        //     redirect_member("recharge","index","");	    
		    	    	// }
		     
		    	  	  
		    	}
		    	else
		    	{
		    	   	set_message("warning","Invalid amount, please check your  balance");
				    redirect_member("recharge","index","");	
					 
		    	}
		    
		        }
		         else
		    	{
		    	   	set_message("warning","Contact to your admin");
				    redirect_member("recharge","index","");	
					 
		    	}
                 
		    
	
		}

		  
 
		    
		}else{
		      
		    set_message("warning","Transection Faild Please Try Again");
		  }
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Recharge Now';  
		$this->load->view(MEMBER_FOLDER.'/recharge/recharge',$data);
	}
	
 	public function indeccccx(){
		$model = new OperationModel();
		 
		if($model->getValue("Recharge_status")=='Y'){
		
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = '1';
        $trns_date = date('Y-m-d H:i:s');
       
		if(!empty($form_data) && is_array($form_data))
		{
                   $userId = 	   $this->session->userdata('user_id');		   
                        
                $circle =  FCrtRplc($form_data['circle']);
                $amount =  FCrtRplc($form_data['amount']);
                $number =  FCrtRplc($form_data['number']);
                $operator =  FCrtRplc($form_data['operator']); 
                $redeem = FCrtRplc($form_data['redeem']);
                $type =  FCrtRplc($form_data['type']);
                
	            $LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		       // $rate= $model->getValue('CONFIG_RATE');
		        
		       //  $LDGR1 = $model->getCurrentBalance(1,20,"","");
                  	
                    
                 $wallet = 	 $model->getValue("VIRTUAL_WALLET");    
		        //if($amount <= $LDGR1['net_balance']){
		      
		        if( $amount <=  $wallet )
               {
		    	if(($amount/75) <=  ($LDGR['net_balance'])){
		    	    
		    //	  	$RWAL = $model->getCurrentBalanceRecharge();
		    	    //	if($amount<=$RWAL['net_balance']){
		    	    	    
	    $recharge_number = $number;
        $amount = $amount;
        $reid = rand(1111111111,9999999999);
        $operator_code = $operator;
            
 
                
                $Sname = $_SERVER['SERVER_NAME'];  
               
                $parameters="serverName=$Sname&recharge_number=$recharge_number&amount=$amount&operator_code=$operator_code&circle=$circle&reid=$reid&type=$type"; 
                $url="https://vertoindia.in/dmt/api/rechargetxn"; 
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);   
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
                $return_val = curl_exec($ch);
                $response = json_decode($return_val); 
                $api_recharge    = $response->API;
                 PrintR($response);die;
             
             
                
               	
               	
               $posted_data = array(
                    "member_id" => $member_id,
                    "status"    =>   $api_recharge->status,
                    "order_id"  => $api_recharge->order_id ,
                    "opr_id"    => $operator,
                    "txn_id"    => $api_recharge->opr_id,
                    "balance"   => $api_recharge->balance ,
                    "number" => $number ,
                    "provider" => $api_recharge->provider ,
                    "amount" => $amount ,
                    "charged_amount" => $api_recharge->charged_amount ,
                    "message" => $api_recharge->message ,
                    "type" =>$type,
                    "response"=>json_encode($response->API)
                    );
                    
                    
 	 
                $this->SqlModel->insertRecord(prefix."tbl_recharge",$posted_data);
               	if($api_recharge->status == 'SUCCESS' or $api_recharge->status == 'PENDING')
               	{
               	
               	// $reward_amt = 0;
               	// if($redeem == 'on')
               	// {
               	//     $per = $amount*2/100;
               	//   	$LDGR1 = $model->getCurrentBalance($member_id,5,"","");
               	//   		if($LDGR1['net_balance'] > 0  ){
               	//   		    if($LDGR1['net_balance'] >= $per)
               	//   		    {
               	//   		      $reward_amt =   $per;
               	//   		    }
               	//   		    else
               	//   		    {
               	//   		          $reward_amt =   $LDGR1['net_balance'];
               	//   		    }
               	// //   	$trns_remark = 'Redeem Reward Point ['.$reward_amt.'] recharged on '.$recharge_number.' Rs.'.$amount;
               	// //   	$trans_no = UniqueId("TRNS_NO");
               	// //   	$model->wallet_transaction(5,"Dr",$member_id,$reward_amt,$trns_remark,$trns_date,$trans_no,"1","RECHARGE");
               	// }
               	 
               	   
               	  	
               	  	
               	  		    
               	//   		}
               	  		    
               	  	$trns_remark = 'Successfully recharged on '.$recharge_number.' Rs.'.$amount;
               	   	$trans_no = UniqueId("TRNS_NO");
               	   	$amt = $amount/75 ;
               	  	$model->wallet_transaction($wallet_id,"Dr",$member_id,$amt,$trns_remark,$trns_date,$trans_no,"1","RECHARGE");	  
                    $model->setWallet($amount,'Dr');
              		
               	    
               	  	
                    set_message("success","Your Recharge has been success.");
                    redirect_member("recharge","index","");	  
               	}
               	elseif($api_recharge->error_code > 0 )
               	{
               	 	set_message("warning",$api_recharge->message);
				    redirect_member("recharge","index","");	    
               	}
               	else
               	{
               	 	set_message("warning","Something went wrong , please try again.");
				    redirect_member("recharge","index","");	   
               	}
         
    
                
              
		    	    //	}
		    	    	// else
		    	    	// {
		    	    	//     set_message("warning","Low Recharge Amount Please Contact to Admin.");
				        //     redirect_member("recharge","index","");	    
		    	    	// }
		     
		    	  	  
		    	}
		    	else
		    	{
		    	   	set_message("warning","Invalid amount, please check your  balance");
				    redirect_member("recharge","index","");	
					 
		    	}
		    
		        }
		         else
		    	{
		    	   	set_message("warning","Contact to your admin");
				    redirect_member("recharge","index","");	
					 
		    	}
                
                  
		    
	
		}

		  
 
		    
		}else{
		      
		    set_message("warning","Transection Faild Please Try Again");
		  }
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/recharge/recharge',$data);
	}
	
	
	    
	
		public function dth(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = '1';
        $trns_date = date('Y-m-d H:i:s');
	 
		if(!empty($form_data) && is_array($form_data))
		{
		    
// 		PrintR($form_data);die;
                $amount =  FCrtRplc($form_data['amount']);
                $number =  FCrtRplc($form_data['number']);
                $operator =  FCrtRplc($form_data['operator']);
                $type =  FCrtRplc($form_data['type']);
                $LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		    
		    	if($amount<=$LDGR['net_balance']){
		    	    
		  
		    	    	    
	    $recharge_number = $number;
        $amount = $amount;
        $reid = $member_id.'-'.strtotime(date('Y-m-d H:i:s'));
        $operator_code = $operator;
            
             $url ="http://vertoindia.online/recharge_api/recharge?member_id=9818791008&api_password=12345&api_pin=99138&number=".$recharge_number."&opcode=".$operator_code."&amount=".$amount."&request_id=".$reid."&field1=&field2=";
        
                            $curl = curl_init();
              
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url
                ));
              
                $resp = curl_exec($curl);
              
                curl_close($curl);

               $api_recharge = json_decode($resp);  
        
               
               	$this->session->set_userdata('recharge',$api_recharge);
               	if($api_recharge->STATUS == 'SUCCESS')
               	{
               	    $trns_remark = 'Successfully DTH recharged on '.$recharge_number.' Rs.'.$amount;
               	   	$trans_no = UniqueId("TRNS_NO");
               	  	$model->wallet_transaction($wallet_id,"Dr",$member_id,$amount,$trns_remark,$trns_date,$trans_no,"1","RECHARGE");
               	  	
             
                    set_message("success","Your Recharge has been success.");
                    redirect_member("recharge","index","");	  
               	}
               	else
               	{
               	 	set_message("warning","Something went wrong , please try again.");
				    redirect_member("recharge","index","");	   
               	}
         
     
		     
		    	  	  
		    	}
		    	else
		    	{
		    	   	set_message("warning","Invalid amount, please check your  balance");
				    redirect_member("recharge","index","");	
					 
		    	}
		    
		    
		   
		    
	
		  
		  
 
		    
		} 
	}
	
		public function electricity(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = '1';
        $trns_date = date('Y-m-d H:i:s');
	 
		if(!empty($form_data) && is_array($form_data))
		{
		    
// 		PrintR($form_data);die;
                $amount =  FCrtRplc($form_data['amount']);
                $number =  FCrtRplc($form_data['number']);
                $operator =  FCrtRplc($form_data['operator']);
                $type =  FCrtRplc($form_data['type']);
                $LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		    
		    	if($amount<=$LDGR['net_balance']){
		    	    
		  
		    	    	    
	    $recharge_number = $number;
        $amount = $amount;
        $reid = $member_id.'-'.strtotime(date('Y-m-d H:i:s'));
        $operator_code = $operator;
          
           $url ="http://vertoindia.online/recharge_api/recharge?member_id=9818791008&api_password=12345&api_pin=99138&number=".$recharge_number."&opcode=".$operator_code."&amount=".$amount."&request_id=".$reid."&field1=&field2=";
        
                    $curl = curl_init();
              
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url
                ));
              
                $resp = curl_exec($curl);
              
                curl_close($curl);

               $api_recharge = json_decode($resp);  
        
               
               	$this->session->set_userdata('recharge',$api_recharge);
               	if($api_recharge->STATUS == 'SUCCESS')
               	{
               	    $trns_remark = 'Successfully Electricity recharged on '.$recharge_number.' Rs.'.$amount;
               	   	$trans_no = UniqueId("TRNS_NO");
               	  	$model->wallet_transaction($wallet_id,"Dr",$member_id,$amount,$trns_remark,$trns_date,$trans_no,"1","RECHARGE");
               	  	
             
                    set_message("success","Your Recharge has been success.");
                    redirect_member("recharge","index","");	  
               	}
               	else
               	{
               	 	set_message("warning","Something went wrong , please try again.");
				    redirect_member("recharge","index","");	   
               	}
         
     
		     
		    	  	  
		    	}
		    	else
		    	{
		    	   	set_message("warning","Invalid amount, please check your  balance");
				    redirect_member("recharge","index","");	
					 
		    	}
		    
		    
		   
		    
	
		  
		  
 
		    
		} 
	}
	
		public function gas(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = '1';
        $trns_date = date('Y-m-d H:i:s');
	 
		if(!empty($form_data) && is_array($form_data))
		{
		    
// 		PrintR($form_data);die;
                $amount =  FCrtRplc($form_data['amount']);
                $number =  FCrtRplc($form_data['number']);
                $operator =  FCrtRplc($form_data['operator']);
                $type =  FCrtRplc($form_data['type']);
                $LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		    
		    	if($amount<=$LDGR['net_balance']){
		    	    
		  
		    	    	    
	    $recharge_number = $number;
        $amount = $amount;
        $reid = $member_id.'-'.strtotime(date('Y-m-d H:i:s'));
        $operator_code = $operator;
            $url ="http://vertoindia.online/recharge_api/recharge?member_id=9818791008&api_password=12345&api_pin=99138&number=".$recharge_number."&opcode=".$operator_code."&amount=".$amount."&request_id=".$reid."&field1=&field2=";
        
                 $curl = curl_init();
              
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url
                ));
              
                $resp = curl_exec($curl);
              
                curl_close($curl);

               $api_recharge = json_decode($resp);  
        
               
               	$this->session->set_userdata('recharge',$api_recharge);
               	if($api_recharge->STATUS == 'SUCCESS')
               	{
               	    $trns_remark = 'Successfully GAS recharged on '.$recharge_number.' Rs.'.$amount;
               	   	$trans_no = UniqueId("TRNS_NO");
               	  	$model->wallet_transaction($wallet_id,"Dr",$member_id,$amount,$trns_remark,$trns_date,$trans_no,"1","RECHARGE");
               	  	
             
                    set_message("success","Your Recharge has been success.");
                    redirect_member("recharge","index","");	  
               	}
               	else
               	{
               	 	set_message("warning","Something went wrong , please try again.");
				    redirect_member("recharge","index","");	   
               	}
         
     
		     
		    	  	  
		    	}
		    	else
		    	{
		    	   	set_message("warning","Invalid amount, please check your  balance");
				    redirect_member("recharge","index","");	
					 
		    	}
		    
		    
		   
		    
	
		  
		  
 
		    
		} 
	}
	
		public function landline(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = '1';
        $trns_date = date('Y-m-d H:i:s');
	 
		if(!empty($form_data) && is_array($form_data))
		{
		    
 	//	PrintR($form_data);die;
                $amount =  FCrtRplc($form_data['amount']);
                $number =  FCrtRplc($form_data['number']);
                $operator =  FCrtRplc($form_data['operator']);
                $type =  FCrtRplc($form_data['type']);
                $LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		     	//	PrintR($LDGR);die;
		    	if($amount<=$LDGR['net_balance']){
		    	    
		  
		    	    	    
	    $recharge_number = $number;
        $amount = $amount;
        $reid = $member_id.'-'.strtotime(date('Y-m-d H:i:s'));
        $operator_code = $operator;
             $url ="http://vertoindia.online/recharge_api/recharge?member_id=9818791008&api_password=12345&api_pin=99138&number=".$recharge_number."&opcode=".$operator_code."&amount=".$amount."&request_id=".$reid."&field1=&field2=";
        
            
                            $curl = curl_init();
              
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $url
                ));
              
                $resp = curl_exec($curl);
              
                curl_close($curl);

               $api_recharge = json_decode($resp);  
        
               
               	$this->session->set_userdata('recharge',$api_recharge);
               	if($api_recharge->STATUS == 'SUCCESS')
               	{
               	    $trns_remark = 'Successfully LandLine recharged on '.$recharge_number.' Rs.'.$amount;
               	   	$trans_no = UniqueId("TRNS_NO");
               	  	$model->wallet_transaction($wallet_id,"Dr",$member_id,$amount,$trns_remark,$trns_date,$trans_no,"1","RECHARGE");
               	  	
             
                    set_message("success","Your Recharge has been success.");
                    redirect_member("recharge","index","");	  
               	}
               	else
               	{
               	 	set_message("warning","Something went wrong , please try again.");
				    redirect_member("recharge","index","");	   
               	}
         
     
		     
		    	  	  
		    	}
		    	else
		    	{
		    	   	set_message("warning","Invalid amount, please check your  balance");
				    redirect_member("recharge","index","");	
					 
		    	}
		    
		    
		   
		    
	
		  
		  
 
		    
		} 
	}
	
}
