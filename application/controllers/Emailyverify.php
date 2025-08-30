<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailyverify extends MY_Controller {

	public function __construct(){
	  //Call the Model constructor
	   parent::__construct();
	   $this->load->library('parser');
	   $this->load->view('captcha/securimage');
	   
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
 
	
	function index(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
  $emailveriy =	FCrtRplc(_d($segment['index']));
	$ddddd ="/".$segment['index'];
  			if($emailveriy) {
  			    
  
			$Q_MEM = "SELECT * FROM tbl_members WHERE user_id='$emailveriy'";
			$fetchRow = $this->SqlModel->runQuery($Q_MEM,true);
			
		        if($fetchRow['emailverify']=='N'){
				if($fetchRow['user_id']==$emailveriy){
				    
				    $data = array("emailverify"=>Y);
				    $this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$fetchRow['member_id']));
				   set_message("success","Email Successfully  Verify");
				   
				  // 	 redirect(BASE_PATH.Airdrop.$ddddd);
			 redirect_member("account","myAccount",array());
				}
				
  			}else{
			set_message("success","Already Verify Email");
			 redirect(BASE_PATH);
		//	 redirect(BASE_PATH.Airdrop.$ddddd);
		 //  redirect_member("account","myAccount",array());
			}
			
  			    
  			}
			
  		
		
	}
	

}
