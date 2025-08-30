<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Razorpay extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
	}
 
	

		public function index()
		{
		    
		  
		  $model = new OperationModel();
		  $order_idd  =time().rand('1111111',999999);
		  $form_data = $this->input->post();
		  $member_id =    $this->session->userdata('mem_id');
	 

		$this->load->view(MEMBER_FOLDER.'/razorpay/razorpay',$data);
	    }
	    
	    public function response()
		{
		    
		  $model = new OperationModel();
		  $member_id =    $this->session->userdata('mem_id');
		  $post = $this->input->post();
		  if($post['STATUS'] == true) { 
        $trns_date = date("Y-m-d H:i:s");
        $posted_data = array(
    	"member_id"=>$member_id,
    	"ORDERID"=> $post['ORDERID'] , 
    	"razorpay_payment_id"=> $post['razorpay_payment_id'] , 
    	"razorpay_order_id"=> $post['razorpay_order_id'] , 
    	"TXNAMOUNT"=> $post['TXNAMOUNT']/75 , 
    	"razorpay_signature"=> $post['razorpay_signature'] , 
    	"STATUS"=> $post['STATUS'] , 
    	"date_time"=>$trns_date
    	);
        $this->SqlModel->insertRecord(prefix."tbl_razorpay",$posted_data);
    
  if ($post['STATUS'] == true) {
                $fund_data = array("uid"=>$uid,"wallet"=>$post['TXNAMOUNT']/75);
                 
       

	                            $trans_no = UniqueId("TRNS_NO");
								$trns_remark = "Wallet added by Razorpay Order Id- ".$post['ORDERID'] ;
								$model->wallet_transaction(3,"Cr",$member_id,$post['TXNAMOUNT']/75,$trns_remark,$trns_date,$trans_no,"1","MT");         
                
                
               
                 redirect_member("razorpay","index",set_message("success","Transaction status is success "));     
                }
                else {
                
                 redirect_member("razorpay","index",set_message("danger","Transaction status is failure."));     
                
                }   
     
}
            else
            {
                
                redirect_member("razorpay","index",set_message("danger","Payment adding Failed ! please try again. "));     
             
            }  
		}

 
	
}
