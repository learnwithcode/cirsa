<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bonus extends MY_Controller {
	
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
	 

	
	public function binaryincome(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/bonus/binaryincome',$data);
	}
	
	public function binaryincomedetail(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/bonus/binaryincomedetail',$data);
	}
	
	
	public function dailyreturn(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/bonus/dailyreturn',$data);
	}
	
	public function directincome(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/bonus/directincome',$data);
	}
	
	public function allincome(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(MEMBER_FOLDER.'/bonus/allincome',$data);
	}
	
	
}
