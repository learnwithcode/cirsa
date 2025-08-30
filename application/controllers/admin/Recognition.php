<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recognition extends MY_Controller {
	
	public function __construct(){
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	 
	}

	
	public function recognitionlist(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(ADMIN_FOLDER.'/recognition/recognition',$data);
	}
	
	
	
}
