<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Support extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	  
	   parent::__construct();
	    #$this->load->library('parser');
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
	}

	
	public function contactsupport(){
		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$enquiry_id = ($form_data['enquiry_id'])? $form_data['enquiry_id']:_d($segment['enquiry_id']);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		if($form_data['logaTicket']!='' && $this->input->post()!=''){
		    
		    $enquiry_id = FCrtRplc($enquiry_id);
			$type = FCrtRplc($form_data['type']);
			$enquiry_from = 'M';
			$from_id = $this->session->userdata('mem_id');
			$subject = FCrtRplc($form_data['subject']);
			$enquiry_detail = FCrtRplc($form_data['enquiry_detail']);
			$enquiry_detailfff = FCrtRplc(strip_tags($enquiry_detail));
			$enquiry_sts = 'O';
			$enquiry_date =  $reply_date =  date('Y-m-d H:s:i');//getLocalTime();
			$ticket_no = UniqueId("TICKET_NO");
			$data = array("enquiry_from"=>$enquiry_from,
				"from_id"=>$from_id,
				"type"=>$type,
				"subject"=>$subject,
				"enquiry_detail"=>$enquiry_detailfff,
				"enquiry_sts"=>$enquiry_sts,
				"enquiry_date"=>$enquiry_date,
				"reply_date"=>$reply_date,
				"ticket_no"=>$ticket_no
			);
			if($enquiry_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_support",$data,array("enquiry_id"=>$enquiry_id));
			}else{
				$enquiry_id = $this->SqlModel->insertRecord(prefix."tbl_support",$data);
				$data_reply = array("member_id"=>$from_id,
					"enquiry_id"=>$enquiry_id,
					"enquiry_reply"=>$enquiry_detail,
					"enquiry_date"=>$enquiry_date,
					"reply_date"=>$reply_date
				);
				$this->SqlModel->insertRecord(prefix."tbl_support_rply",$data_reply);
			}			
			set_message("success","You have  successfully raised a ticket");
			redirect_member("support","contactsupport","");
		}
		if($action_request=="CLOSE"){
			if($enquiry_id>0){
				$data = array("enquiry_sts"=>"C");
				$this->SqlModel->updateRecord(prefix."tbl_support",$data,array("enquiry_id"=>$enquiry_id));
				set_message("success","You have  successfully closed a ticket");
				redirect_member("support","contactsupport","");
			}
		}
		
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		$this->load->view(MEMBER_FOLDER.'/support/contactsupport');
	}
	
	
	public function conversation(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$enquiry_id = ($form_data['enquiry_id'])? $form_data['enquiry_id']:_d($segment['enquiry_id']);
		$member_id = $this->session->userdata('mem_id');
		if($form_data['chatSubmit']=='1' && $this->input->post()!=''){
		    
		    $enquiry_id    = FCrtRplc($enquiry_id);
			$enquiry_reply = FCrtRplc($form_data['enquiry_reply']);
			$enquiry_replyfff = FCrtRplc(strip_tags($enquiry_reply));
			$reply_date = $enquiry_date = date('Y-m-d h:i:s');//getLocalTime();
			$data = array("member_id"=>$member_id,
				"enquiry_id"=>$enquiry_id,
				"enquiry_reply"=>$enquiry_replyfff,
				"enquiry_date"=>$enquiry_date,
				"reply_date"=>$reply_date
			);
			if($enquiry_id>0){
				$this->SqlModel->insertRecord(prefix."tbl_support_rply",$data);
				$this->SqlModel->updateRecord(prefix."tbl_support",array("enquiry_sts"=>"O","reply_date"=>$reply_date),array("enquiry_id"=>$enquiry_id));
				redirect_member("support","conversation",array("enquiry_id"=>_e($enquiry_id)));
			}
			
		}
		$member_id = $this->session->userdata('mem_id');
	  $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		
		$data['ROW']=$fetchRow;
		$this->load->view(MEMBER_FOLDER.'/support/conversation2');
	}
	
	
	public function faq(){
		$this->load->view(MEMBER_FOLDER.'/support/faq');
	}
	
}
