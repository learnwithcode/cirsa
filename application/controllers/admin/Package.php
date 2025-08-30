<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
    	
	public function package_type()      {	
	$this->load->view(ADMIN_FOLDER.'/package/packagetype',$data);
	}
	public function packagelist()      {	
	$this->load->view(ADMIN_FOLDER.'/package/packagelist',$data);
	}
	public function productlist()
	{
	$this->load->view(ADMIN_FOLDER.'/package/productlist',$data);
	}
	public function packageproduct()
	{
	
	$this->load->view(ADMIN_FOLDER.'/package/packageproduct',$data);
	}
	public function addpacageproduct() {
	    $model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$type_id = _d($segment['type_id']);
		$type = $segment['type'];
		if($form_data['submitForm']==1 && $this->input->post()!=''){
		$productId = implode(',',$form_data['productid']);
		
		$data = array(
					    "product_id"=>$productId
						
					);
					if($model->checkCount(prefix."tbl_pintype","type_id",$type_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_pintype",$data,array("type_id"=>$type_id));
						set_message("success","You have successfully updated a  package detail");
						redirect_page("package","packageproduct",array("type_id"=>_e($type_id),"type"=>$type));
						}	
		}
		redirect_page("package","packagelist",array("type"=>$type));	
	}

	public function addpackage()       {
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$type = $segment['type'];
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$type_id = ($form_data['type_id'])? $form_data['type_id']:_d($segment['type_id']);
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitpackage']==1 && $this->input->post()!=''){
					$pin_name = FCrtRplc($form_data['pin_name']);
					$pin_price = FCrtRplc($form_data['pin_price']);
					$pin_mrp = FCrtRplc($form_data['pin_mrp']);
					$product = FCrtRplc($form_data['product']);
					$description = FCrtRplc($form_data['description']);
					 
					$prod_pv = FCrtRplc($form_data['package_pv']);
					 
					$featured_sts = FCrtRplc($form_data['featured_sts']);
					
					$data = array(
					    "pin_name"=>$pin_name,
						"pin_price"=>$pin_mrp,
						"prod_pv"=>$prod_pv,
						"mrp"=>$pin_mrp,
						"pin_price_limit"=>0,
						"product" =>$product,
						"direct_bonus"=>($direct_bonus>0)? $direct_bonus:0,
 						"daily_return"=>0,
						 
						"no_day"=>0,
						"daily_binary_limit"=>0,
						"monthly_binary_limit"=>0,
						"featured_sts"=>($featured_sts>0)? 1:0,
						"description"=>$description
					);
					if($model->checkCount(prefix."tbl_pintype","type_id",$type_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_pintype",$data,array("type_id"=>$type_id));
						set_message("success","You have successfully updated a  package detail");
						redirect_page("package","packagelist",array("type"=>$type));					
					}else{
						$type_id = $this->SqlModel->insertRecord(prefix."tbl_pintype",$data);
						set_message("success","You have successfully added  a new  Package type");
						redirect_page("package","packagelist",array("type"=>$type));				
					}
				}
			break;
			case "DELETE":
				if($type_id>0){
					$data = array("isDelete"=>0);
					$this->SqlModel->updateRecord(prefix."tbl_pintype",$data,array("type_id"=>$type_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("package","packagelist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_pintype WHERE type_id='$type_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
				//PrintR($data['ROW']);die;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/package/addpackage',$data);
	}
	
	public function packageadd()       {
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$package_id = ($form_data['package_id'])? $form_data['package_id']:_d($segment['package_id']);
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitpackage']==1 && $this->input->post()!=''){
					$package_name = FCrtRplc($form_data['package_name']);
					$package_pv = FCrtRplc($form_data['package_pv']);
					$turbo_sale = FCrtRplc($form_data['turbo_sale']);
					$turbo_bonus = FCrtRplc($form_data['turbo_bonus']);
					$description = FCrtRplc($form_data['description']);
					
					$data = array(
					    "package_name"=>$package_name,
						"package_pv"=>$package_pv,
						"turbo_sale"=>$turbo_sale,
						"turbo_bonus"=>$turbo_bonus,
						"description"=>$description,
						"created_date_time"=>date('Y-m-d H:i:s'),
						"status" =>'1',
						
					);
					if($model->checkCount(prefix."tbl_package_type","package_id",$package_id)>0){
				$this->SqlModel->updateRecord(prefix."tbl_package_type",$data,array("package_id"=>$package_id));
						set_message("success","You have successfully updated a  package detail");
						redirect_page("package","package_type","");					
					}else{
						$type_id = $this->SqlModel->insertRecord(prefix."tbl_package_type",$data);
						set_message("success","You have successfully added  a new  Package ");
						redirect_page("package","package_type","");				
					}
				}
			break;
			case "DELETE":
				if($type_id>0){
					$data = array("isDelete"=>0);
					$this->SqlModel->updateRecord(prefix."tbl_package_type",$data,array("package_id"=>$package_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("package","packagelist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_package_type WHERE package_id='$package_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		
		$this->load->view(ADMIN_FOLDER.'/package/packageadd',$data);
	}
	
	public function addproduct()       {
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$date_time = date('y-m-d H:i:s');
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$product_id = ($form_data['product_id'])? $form_data['product_id']:_d($segment['product_id']);
		switch($action_request){

			case "ADD_UPDATE":
				if($form_data['submitproduct']==1 && $this->input->post()!=''){
					$product_name = FCrtRplc($form_data['product_name']);
					$product_mrp = FCrtRplc($form_data['product_mrp']);
					$tax = FCrtRplc($form_data['tax']);
					$unit = FCrtRplc($form_data['unit']);
					$hsn_code = FCrtRplc($form_data['hsn_code']);
					
					
					$data = array(
					    "product_name"=>$product_name,
						"product_desc"=>$product_name,
						"product_mrp"=>$product_mrp,
						"product_dmrp"=>0,
						"offer_price"=>$product_mrp,
						"unit" =>$unit,
						"tax"=>$tax,
						"hsn_code"=>$hsn_code,
						"other"=>0,
						"display_order"=>0,
						"created_date"=>$date_time,
						"updated_date"=>$date_time,
						"status"=>1
						
					);

					if($model->checkCount(prefix."tbl_product","product_id",$product_id)>0){
					$this->SqlModel->updateRecord(prefix."tbl_product",$data,array("product_id"=>$product_id));
						set_message("success","You have successfully updated a  product detail");
						redirect_page("package","productlist","");					
					}else{
						$type_id = $this->SqlModel->insertRecord(prefix."tbl_product",$data);
						set_message("success","You have successfully added  a new  product type");
						redirect_page("package","productlist","");				
					}
				}
			break;
			case "DELETE":
				if($type_id>0){
					$data = array("isDelete"=>0);
					$this->SqlModel->updateRecord(prefix."tbl_product",$data,array("product_id"=>$product_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("package","productlist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_product WHERE product_id='$product_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/package/addproduct',$data);
	}
	
	
	
	
}
?>