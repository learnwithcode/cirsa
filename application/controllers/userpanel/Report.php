<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
	}
		public function pool_income(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/report/boardincome',$data);
	}
	
 	public function CommunityIncome(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/report/CommunityIncome',$data);
	}
	
	public function booster_income(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/report/royaltyInc',$data);
	}
		public function club_income(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/report/clubInc',$data);
	}
		public function directROI(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/report/directROI',$data);
	}
	public function salaryincome(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/report/salaryincome',$data);
	}
	
	    public function matchingROI(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/report/matchingROI',$data);
	}
		public function binaryincome(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Binary Income';
		$this->load->view(MEMBER_FOLDER.'/report/binaryincome',$data);
	}
			public function binaryRoi(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/report/binaryRoi',$data);
	}
	
	
	public function levelRoi(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/report/levelRoi',$data);
	}
	public function stakingbonus(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Daily Return';
		$this->load->view(MEMBER_FOLDER.'/report/dailyreturn',$data);
	}
		public function poolIncomeaaaaaaaaaaaaaa(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Magic Pool';
		$this->load->view(MEMBER_FOLDER.'/report/poolincome',$data);
	}
	
		public function leadership(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Leadership Bonus';
		$this->load->view(MEMBER_FOLDER.'/report/leadership',$data);
	}	
	
	
	
		public function quickBonus(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/report/quick',$data);
	}
	public function direct_referral_bonus(){
	
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Referral Income';
		
		$this->load->view(MEMBER_FOLDER.'/report/directincome',$data);
	}
	
	public function cashback(){
	
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		
		$this->load->view(MEMBER_FOLDER.'/report/cashback',$data);
	}
	
		
	public function level_bonus(){
	
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		
		$this->load->view(MEMBER_FOLDER.'/report/LevelIncome',$data);
	}
		public function LevelIncomeList(){
	
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		
		$this->load->view(MEMBER_FOLDER.'/report/LevelIncomeList',$data);
	}
	  public function rank_rewards(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Rank Income';
		$this->load->view(MEMBER_FOLDER.'/report/rankViewsts',$data);
	}
	 public function rank_rewards_new(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Rank Income';
		$this->load->view(MEMBER_FOLDER.'/report/rankViewstsnew',$data);
	}
	 public function performance_rewards(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Rank Income';
		$this->load->view(MEMBER_FOLDER.'/report/performancerewards',$data);
	}
	  public function RoyaltyIncome(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Rank Income';
		$this->load->view(MEMBER_FOLDER.'/report/royaltyInc_2',$data);
	}
	
	
	    public function RewardIncome() {
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/report/RewardIncome',$data);  }
		
	   public function BonanzaIncome() {
	   $model = new OperationModel();
	   $this->load->view(MEMBER_FOLDER.'/report/BonanzaIncome',$data);  }	
		
	 	
		
	    public function totalincome(){
	    $model = new OperationModel();
	     $data['web_title'] = 'Total Income Report';
	    $this->load->view(MEMBER_FOLDER.'/report/totalincome',$data); }
	 
	    public function property() {
                $this->load->model('OperationModel'); // Load the model
                
                $data['web_title'] = 'Total Property';
                 $Page = $this->input->get('page');
                 
                 if($Page == "" or $Page <=0){$Page=1;}
                // Get the search query from the URL, default to an empty string if not set
                $SrchQ = $this->input->get('query') ? $this->input->get('query') : '';
            
                // Build the query for properties
               // $QR_PAGES = $this->OperationModel->getProperties($SrchQ, $Page); // Assume this method exists in the model
                
                if(isset($SrchQ) && $SrchQ != ""){
                     $QR_PAGES = "SELECT * FROM tbl_property WHERE address LIKE '%" . $this->db->escape_like_str($SrchQ) . "%' or name LIKE '%" . $this->db->escape_like_str($SrchQ) . "%' ";
                }else{
                     $QR_PAGES= "SELECT * FROM  tbl_property  WHERE 1  ";
                }
               
                // Prepare data for the view
                $data['QR_PAGES'] = $QR_PAGES;
                $data['SrchQ'] = $SrchQ;
                $data['Page'] = $Page;
            
                $this->load->view(MEMBER_FOLDER . '/report/property', $data);
            }

}
