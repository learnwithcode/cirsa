<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
	}


	public function inbox(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$message_id = (_d($form_data['message_id'])>0)? _d($form_data['message_id']):_d($segment['message_id']);
		switch($action_request){
			case "DELETE":
				if($message_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_message",array("message_id"=>$message_id));
					set_message("success","Message deleted successfully");
					redirect_member("message","inbox",""); 
				}
			break;
		}
		$this->load->view(MEMBER_FOLDER.'/message/inbox',$data);
	}
	
	public function outbox(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$message_id = (_d($form_data['message_id'])>0)? _d($form_data['message_id']):_d($segment['message_id']);
		switch($action_request){
			case "DELETE":
				if($message_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_message",array("message_id"=>$message_id));
					set_message("success","Message deleted successfully");
					redirect_member("message","outbox",""); 
				}
			break;
		}
		$this->load->view(MEMBER_FOLDER.'/message/outbox',$data);
	}
	public function compose(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		if($form_data['submitMessage']!='' && $this->input->post()!=''){
		
			$message_to = FCrtRplc($form_data['message_to']);
			$subject = FCrtRplc($form_data['subject']);
			$message = FCrtRplc($form_data['message']);
			$data = array(
				"from_member_id"=>$member_id,
				"to_member_id"=>0,
				"subject"=>$subject,
				"message"=>$message
			);
			$this->SqlModel->insertRecord(prefix."tbl_message",$data);
			set_message("success","Message sent successfully");
			redirect_member("message","compose",""); 
			
		}
				
		$this->load->view(MEMBER_FOLDER.'/message/compose',$data);
	}
	
	public function reply(){
		$model = new OperationModel();
		$today_date = getLocalTime();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$message_id = (_d($form_data['message_id'])>0)? _d($form_data['message_id']):_d($segment['message_id']);
		
		if($form_data['submitReply']!='' && $this->input->post()!=''){
			
			$QR_MSG = "SELECT tm.* FROM ".prefix."tbl_message AS tm WHERE tm.message_id='".$message_id."'";
			$AR_MSG = $this->SqlModel->runQuery($QR_MSG,true);
			
			$message_to = $AR_MSG['message_to'];
			$subject = $AR_MSG['subject'];
			$message = FCrtRplc($form_data['message']);
			
			$data = array("parent_id"=>$message_id,
				"from_member_id"=>$member_id,
				"to_member_id"=>0,
				"message_to"=>$message_to,
				"subject"=>$subject,
				"message"=>$message
			);
			$this->SqlModel->insertRecord(prefix."tbl_message",$data);
			$this->SqlModel->updateRecord(prefix."tbl_message",array("reply_date"=>$today_date,"reply_sts"=>"Y"),array("message_id"=>$message_id));
			set_message("success","Successfully replied");
			redirect_member("message","inbox",""); 
			
		}
				
		$this->load->view(MEMBER_FOLDER.'/message/reply',$data);
	}
	
	public function view(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$message_id = (_d($form_data['message_id'])>0)? _d($form_data['message_id']):_d($segment['message_id']);
		
				
		$this->SqlModel->updateRecord(prefix."tbl_message",array("read_sts"=>"Y"),array("message_id"=>$message_id,"to_member_id"=>$member_id));
		$QR_MSG = "SELECT tm.* FROM ".prefix."tbl_message AS tm WHERE tm.message_id='".$message_id."'";
		$AR_MSG = $this->SqlModel->runQuery($QR_MSG,true);
		
		$data['ROW'] = $AR_MSG;
		$this->load->view(MEMBER_FOLDER.'/message/view',$data);
	}
	
}
