<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Network extends MY_Controller {
	
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
	 	   public function clubviewlist(){
		$model = new OperationModel();
	 

		
		$this->load->view(MEMBER_FOLDER.'/network/clubviewlist',$data);
	}
	 
	 
	   public function club_view(){
		$model = new OperationModel();
	 

		
		$this->load->view(MEMBER_FOLDER.'/network/club_view',$data);
	}
	   public function pool()    {  $this->load->view(MEMBER_FOLDER.'/network/board',$data);    }
	    public function poolView()    {  $this->load->view(MEMBER_FOLDER.'/network/boardView',$data);    }
	    
	      public function performance_view(){
		$model = new OperationModel();
	 

		
		$this->load->view(MEMBER_FOLDER.'/network/performance',$data);
	}
	     public function reward_view(){
		$model = new OperationModel();
	 

		
		$this->load->view(MEMBER_FOLDER.'/network/reward',$data);
	}
	    
	      public function retopup_pool()    {  $this->load->view(MEMBER_FOLDER.'/network/retopupboard',$data);    }
	    public function retopup_pool_View()    {  $this->load->view(MEMBER_FOLDER.'/network/retopupboardView',$data);    }
	 
	 public function level_view(){
		$model = new OperationModel();
	 

		
		$this->load->view(MEMBER_FOLDER.'/network/level_view',$data);
	}
	
		public function level_view_list(){
		$model = new OperationModel();
	 

		
		$this->load->view(MEMBER_FOLDER.'/network/level_view_list',$data);
	}
	

	
	public function redeemWallet()
	{
	    $model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');   		
		$user_id = $this->session->userdata('user_id');   
		$reedeem=$model->getValue("Reedeem_on_off");
		if(!empty($form_data) and is_array($form_data))
		{ 
		    
	     $date =date('Y-m-d');
	  	 $userId =   $form_data['userId']; 
		 $type   =   $form_data['type'];
		 if($reedeem =='Y'){
		     
		     
		 if($type =='Single')
		 {
		  // sleep(5); 
		  $getMemberId = $model->getMemberId($userId);
		  $LDGR = $model->getCurrentBalance($getMemberId,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);

          if($LDGR['net_balance']>=  .01 )
          { 
                                $trns_remark = "Redeem Wallet To [".$user_id."]";
								$model->wallet_transaction(1,"Dr",$getMemberId,$LDGR['net_balance'],$trns_remark,$date,rand('1111',777777),"1","RETRIEVE"); 
								$trns_remark = "Redeem Wallet From [".$userId."]";
								$model->wallet_transaction(1,"Cr",$member_id,$LDGR['net_balance'],$trns_remark,$date,rand('1111',777777),"1","RETRIEVE");
          }
                                
		 }
		 elseif($type =='All')
		 {
		     
		  //  sleep(5);  
		   $getMemberId = $model->superreferal($member_id);  
		   
		   if(!empty($form_data) and is_array($form_data))
		   {
		    foreach($getMemberId as $AR_DT){
		   	  $LDGR = $model->getCurrentBalance($AR_DT['member_id'],'1',$_REQUEST['from_date'],$_REQUEST['to_date']);

          if($LDGR['net_balance']>= .01 )
          { 
              
                    $userId = $model->getMemberUserId($member_id);
                    $trns_remark = "Redeem Wallet To [".$user_id."]";
                    $model->wallet_transaction(1,"Dr",$AR_DT['member_id'],$LDGR['net_balance'],$trns_remark,$date,rand('1111',777777),"1","RETRIEVE"); 
                    $trns_remark = "Redeem Wallet From [".$AR_DT['user_id']."]";
                    $model->wallet_transaction(1,"Cr",$member_id,$LDGR['net_balance'],$trns_remark,$date,rand('1111',777777),"1","RETRIEVE");
          }  
		   	}   
		   }
		   	
		 }
		  
		 echo true;
		
		}else{
		  
		}
		}
		else
		{
		    
		}
		
	}
	public function topology(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		
		$this->load->view(MEMBER_FOLDER.'/network/topology',$data);
	}
		public function redeem(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		
		$this->load->view(MEMBER_FOLDER.'/network/redeem',$data);
	}
	
	public function my_team(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$data['web_title'] = 'My Referral';
		$this->load->view(MEMBER_FOLDER.'/network/referrer',$data);
	}
	
	
	public function memberplacement(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $left_right = (_d($segment['left_right']))? _d($segment['left_right']):_d($_REQUEST['left_right']);
        $pos = ($left_right =='L') ? 'Left':'Right';
		$data['web_title'] = 'My Team '.$pos;
		$this->load->view(MEMBER_FOLDER.'/network/memberplacement',$data);
	}
	
	public function downline(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'My Downline';
		//echo "<pre>";print_r($data);die;
		$this->load->view(MEMBER_FOLDER.'/network/downline',$data);
	}
		public function listView(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		//echo "<pre>";print_r($data);die;
		$this->load->view(MEMBER_FOLDER.'/network/downline1',$data);
	}
	
	public function treegenealogy(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		
//	$this->load->view(MEMBER_FOLDER.'/network/treegenealogy',$data);
	$this->load->view(MEMBER_FOLDER.'/network/treegenealogyold',$data);
	}
	
		public function treegenealogynew(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		
	$this->load->view(MEMBER_FOLDER.'/network/treegenealogy',$data);
//	$this->load->view(MEMBER_FOLDER.'/network/treegenealogyold',$data);
	}
	
	public function tree(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Binary View';
		$this->load->view(MEMBER_FOLDER.'/network/tree',$data);
	}
	
	
		public function poolddddddddddd(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Magic Pool View';
		$this->load->view(MEMBER_FOLDER.'/network/pool',$data);
	}
	
	
}
