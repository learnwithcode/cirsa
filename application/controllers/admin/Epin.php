<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Epin extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	
	
	public function pintype(){	
		$this->load->view(ADMIN_FOLDER.'/epin/pintype',$data);
	}
	
	public function addpin(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$type_id = ($form_data['type_id'])? $form_data['type_id']:_d($segment['type_id']);
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitEpin']==1 && $this->input->post()!=''){
					$pin_name = FCrtRplc($form_data['pin_name']);
					$pin_price = FCrtRplc($form_data['pin_price']);
						$pin_mrp = FCrtRplc($form_data['pin_mrp']);
					$pin_price_limit = FCrtRplc($form_data['pin_price_limit']);
					$description = FCrtRplc($form_data['description']);
					$pin_letter = strtoupper($form_data['pin_letter']);
					
					$direct_bonus = FCrtRplc($form_data['direct_bonus']);
					$binary_bonus = FCrtRplc($form_data['binary_bonus']);
					$daily_return = FCrtRplc($form_data['daily_return']);
					
					$no_day = FCrtRplc($form_data['no_day']);
					$daily_binary_limit = FCrtRplc($form_data['daily_binary_limit']);
					$monthly_binary_limit = FCrtRplc($form_data['monthly_binary_limit']);
					
					$featured_sts = FCrtRplc($form_data['featured_sts']);
					
					$data = array(
					    "pin_name"=>$pin_name,
						"pin_price"=>$pin_price,
						"mrp"=>$pin_mrp,
						"pin_price_limit"=>($pin_price_limit>0)? $pin_price_limit:0,
						"pin_letter"=>$pin_letter,
						"direct_bonus"=>($direct_bonus>0)? $direct_bonus:0,
						"binary_bonus"=>($binary_bonus>0)? $binary_bonus:0,
						"daily_return"=>($daily_return>0)? $daily_return:0,
						"no_day"=>($no_day>0)? $no_day:0,
						"daily_binary_limit"=>($daily_binary_limit>0)? $daily_binary_limit:0,
						"monthly_binary_limit"=>($monthly_binary_limit>0)? $monthly_binary_limit:0,
						"featured_sts"=>($featured_sts>0)? 1:0,
						"description"=>$description
					);
					if($model->checkCount(prefix."tbl_pintype","type_id",$type_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_pintype",$data,array("type_id"=>$type_id));
						set_message("success","You have successfully updated a  pin detail");
						redirect_page("epin","pintype",array(""));					
					}else{
						$type_id = $this->SqlModel->insertRecord(prefix."tbl_pintype",$data);
						set_message("success","You have successfully added  a new  pin type");
						redirect_page("epin","addpin",array("type_id"=>_e($type_id),"action_request"=>"EDIT"));				
					}
				}
			break;
			case "DELETE":
				if($type_id>0){
					$data = array("isDelete"=>0);
					$this->SqlModel->updateRecord(prefix."tbl_pintype",$data,array("type_id"=>$type_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("epin","pintype",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_pintype WHERE type_id='$type_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/epin/addpin',$data);
	}
	
	public function pingenerate(){	
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$mstr_id = ($form_data['mstr_id'])? $form_data['mstr_id']:_d($segment['mstr_id']);
		switch($action_request){
			case "ADD_UPDATE":
				
				if($form_data['generateEpin']==1 && $this->input->post()!=''){
					$type_id = FCrtRplc($form_data['type_id']);
					$no_pin = FCrtRplc($form_data['no_pin']);
					$member_id = _d($form_data['member_id']);
					$bank_id = FCrtRplc($form_data['bank_id']);
					$payment_date = InsertDate($form_data['payment_date']);
					$payment_sts = FCrtRplc($form_data['payment_sts']);
					$pin_price = FCrtRplc($form_data['pin_price']);
					$net_amount = FCrtRplc($form_data['net_amount']);
					
					$AR_PACK = $model->getPinType($type_id);
					
					$data = array("type_id"=>$type_id,
						"no_pin"=>$no_pin,
						"prod_pv"=>$AR_PACK['prod_pv'],
						"pin_price"=>$pin_price,
						"net_amount"=>$net_amount,
						"member_id"=>$member_id,
						"bank_id"=>$bank_id,
						"payment_date"=>$payment_date,
						"payment_sts"=>$payment_sts,
						"ip_address"=>$_SERVER['REMOTE_ADDR'],
						"generate_by"=>$this->session->userdata('oprt_name')
					);
					if($model->checkCount(prefix."tbl_pinsmaster","mstr_id",$mstr_id)==0){
						$mstr_id = $this->SqlModel->insertRecord(prefix."tbl_pinsmaster",$data);
						$model->generatePinDetail($mstr_id);
						set_message("success","You have successfully generated  a E-pin");
						redirect_page("epin","viewpin",array("mstr_id"=>_e($mstr_id)));			
					}
				}
			break;
			case "DELETE":
				if($type_id>0){
					$data = array("isDelete"=>0);
					$this->SqlModel->updateRecord(prefix."tbl_pintype",$data,array("type_id"=>$type_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("epin","pintype",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_pintype WHERE type_id='$type_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/epin/pingenerate',$data);
	}
	
	
	public function generate(){
		$this->load->view(ADMIN_FOLDER.'/epin/generate',$data);
	}
	
	
	public function viewpin(){
		$this->load->view(ADMIN_FOLDER.'/epin/viewpin',$data);
	}
	
	public function blockpin(){	
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$pin_id = ($form_data['pin_id'])? $form_data['pin_id']:_d($segment['pin_id']);
		switch($action_request){
			case "BLOCK":
				$block_sts = FCrtRplc($segment['block_sts']);
				if($pin_id>0){
					$this->SqlModel->updateRecord(prefix."tbl_pinsdetails",array("block_sts"=>$block_sts),array("pin_id"=>$pin_id));
					set_message("success","You have successfully updated pin status");	
					redirect_page("epin","blockpin",array()); exit;
				}
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/epin/blockpin',$data);
	}
	
	public function usedpin(){	
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$pin_id = ($form_data['pin_id'])? $form_data['pin_id']:_d($segment['pin_id']);
		switch($action_request){
			case "BLOCK":
				$block_sts = FCrtRplc($segment['block_sts']);
				if($pin_id>0){
					$this->SqlModel->updateRecord(prefix."tbl_pinsdetails",array("block_sts"=>$block_sts),array("pin_id"=>$pin_id));
					set_message("success","You have successfully updated pin status");	
					redirect_page("epin","blockpin",array()); exit;
				}
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/epin/usedpin',$data);
	}
	
	public function pinrequest(){
	$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$request_id = ($form_data['request_id'])? $form_data['request_id']:_d($segment['request_id']);
		switch($action_request){
			case "STS":
				$assign_sts = _d($segment['assign_sts']);
				if($request_id>0){
					$data = array("assign_sts"=>$assign_sts);
					$this->SqlModel->updateRecord(prefix."tbl_pin_request",$data,array("request_id"=>$request_id));
					$req_data = $model->getrow('tbl_pin_request','request_id',$request_id);
					$model->generatePinDetail($req_data['mstr_id']);
					set_message("success","You have successfully updated E-pin request status");	
					redirect_page("epin","pinrequest",array()); exit;
				}else{
					set_message("warning","Unable to update request , please try again");	
					redirect_page("epin","pinrequest",array()); exit;
				}
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/epin/pinrequest',$data);
	}
	
	public function unusedpin(){	
		$this->load->view(ADMIN_FOLDER.'/epin/unusedpin',$data);
	}
	
	
	
}
?>