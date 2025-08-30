<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Advert extends MY_Controller {	 
	 
	public function __construct(){
	   parent::__construct();
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	
	public function viewadvrt(){	
		$this->load->view(ADMIN_FOLDER.'/advert/viewadvrt',$data);
	}
	
	public function pendingadvrt(){	
		$this->load->view(ADMIN_FOLDER.'/advert/pendingadvrt',$data);
	}
	
	public function activeadvrt(){
		$this->load->view(ADMIN_FOLDER.'/advert/activeadvrt',$data);
	}
	
	public function inactiveadvrt(){
		$this->load->view(ADMIN_FOLDER.'/advert/inactiveadvrt',$data);
	}
	
	public function advrtstatus(){
		$this->load->view(ADMIN_FOLDER.'/advert/advrtstatus',$data);
	}
	
	public function addadvrt(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$advert_id = ($form_data['advert_id'])? $form_data['advert_id']:$segment['advert_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitAdvertisment']==1 && $this->input->post()!=''){
					$advert_title = FCrtRplc($form_data['advert_title']);
					$advert_link = FCrtRplc($form_data['advert_link']);
					$advert_desc = FCrtRplc($form_data['advert_desc']);
					$advert_click = FCrtRplc($form_data['advert_click']);
					$start_date = InsertDateTime($form_data['start_date']);
					$expiry_date = InsertDateTime($form_data['expiry_date']);
					$oprt_id = FCrtRplc($form_data['oprt_id']);
					$member_id = FCrtRplc($form_data['member_id']);
					$advert_sts = FCrtRplc($form_data['advert_sts']);
					$advert_add_by = FCrtRplc($form_data['advert_add_by']);
					$oprt_id = ($form_data['oprt_id']>0)? $form_data['oprt_id']:$this->session->userdata('oprt_id');
					$date_time = getLocalTime();
					$data = array("advert_title"=>$advert_title,
						"advert_link"=>$advert_link,
						"advert_click"=>$advert_click,
						"advert_desc"=>$advert_desc,
						"start_date"=>$start_date,
						"expiry_date"=>$expiry_date,
						"oprt_id"=>$oprt_id,
						"member_id"=>$member_id,
						"advert_sts"=>$advert_sts,
						"advert_add_by"=>$advert_add_by,
						"date_time"=>$date_time,
						"isDelete"=>1,
						"isActive"=>1,
					);
					if($model->checkCount(prefix."tbl_advert","advert_id",$advert_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_advert",$data,array("advert_id"=>$oprt_id));
						set_message("success","You have successfully updated a  advert detail");
						redirect_page("advert","addadvrt",array("advert_id"=>$advert_id,"action_request"=>"EDIT"));					
					}else{
						$this->SqlModel->insertRecord(prefix."tbl_advert",$data);
						set_message("success","You have successfully added  a new  advert");
						redirect_page("advert","addadvrt",array());					
					}
				}
			break;
			case "DELETE":
				if($advert_id>0){
					$data = array("isDelete"=>0);
					$this->SqlModel->updateRecord(prefix."tbl_advert",$data,array("advert_id"=>$advert_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("operation","viewadvrt",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_advert WHERE advert_id='$advert_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/advert/addadvrt',$data);
	}
		
	
	
}
