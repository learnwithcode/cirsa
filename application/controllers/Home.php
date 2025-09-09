<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	
	public function __construct(){
	   parent::__construct();
	   $this->OperationModel->addVisitor();
	   
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
	public function index() { $this->load->view('home'); }
	public function services() { $this->load->view('services'); }
	
		public function login()
	{ 
	    $this->load->view('login');
	}
	
		public function airdrop()
	{ 
	     redirect(BASE_PATH); 
	    		$model = new OperationModel();
	
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(1);
		$CONFIG_MIN_FUND_TRANSFER = $model->getValue("CONFIG_MIN_FUND_TRANSFER");
		$today_date = getLocalTime();
		$alreadyuser_id =_d($segment['Airdrop']);
             $memberdetail1   = $model->getMemberdetailbyuserid($alreadyuser_id);
            $member_id1      = $memberdetail1['member_id'];
            
            
           $count =  $model->checkCount('tbl_airdrop','member_id',$member_id1);   
//	PrintR($segment['Airdrop']);
	if($count==1){
	  	set_message("warning","Already Submited Please Referral More For More Eearn");
			 redirect(BASE_PATH);  
	    
	}
		if($form_data['submitRequest']==1 && $this->input->post()!=''){
		    
		  //  PRintR($form_data);die;
		      $user_id =	_d($form_data['memberid']);
		      $memberdetail   = $model->getMemberdetailbyuserid($user_id);
            $member_id      = $memberdetail['member_id'];
              $sponsor_id      = $memberdetail['sponsor_id'];
          //   PRintR($memberdetail);
           //   PRintR($form_data);die;
 // $emailveriy =	_d($segment['index']);
		    //	PrintR($form_data); die;
		        $telegramuserid = FCrtRplc($form_data['telegramuserid']);
				$Whatsppno = FCrtRplc($form_data['Whatsppno']);
				$copyinstagram = FCrtRplc($form_data['copyinstagram']);
			
			 	$trns_date = $today_date;
				$data = array(
								    "telegramuserid"=>$telegramuserid,
								    "Whatsppno"=>$Whatsppno,
									"copyinstagram"=>$copyinstagram,
									"member_id"=>$member_id,
										"user_id"=>$user_id,
											"sponsor_id"=>$sponsor_id,
												"amount"=>10,
									
								);
													
							
						//
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_airdrop",$data);
								set_message("success","Your Airdrop Request Successfully Submited Please Wait We Are Checking....");
							 redirect(BASE_PATH);  
		
		}
	
	    
	    
	    $this->load->view('airdrop');
	}
		public function sign()
	{
		
		$this->load->view('sign');
	}
	public function news()
	{
		
		$this->load->view('ind');
	}
	
	public function about()
	{
		
		$this->load->view('about');
	}
		public function brands()
	{
		
		$this->load->view('brands');
	}public function products()
	{
		
		$this->load->view('products');
	}public function ayurveda()
	{
		
		$this->load->view('ayurveda');
	}public function contact()
	{
		
		$this->load->view('contact');
	}
	public function faq()
	{
		
		$this->load->view('faq');
	}
	public function disclaimer()
	{
		
		$this->load->view('disclaimer');
	}public function term()
	{
		
		$this->load->view('term');
	}public function policy()
	{
		
		$this->load->view('policy');
	}
	
}
