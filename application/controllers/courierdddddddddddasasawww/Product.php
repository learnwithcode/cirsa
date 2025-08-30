<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	
	public function categoryAdd()
	{
	$model = new OperationModel();
	

		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$category_id = ($form_data['category_id'])? $form_data['category_id']:$segment['category_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitcat']==1 && $this->input->post()!=''){
					$cat_title = FCrtRplc($form_data['category_name']);
	
				//	$cat_sts = ($form_data['status']=="on")? 1:0;
				
					
					
					//	updated_date_time	
//echo $category_id;die;
					if($model->checkCount(prefix."tbl_category","category_id",$category_id)>0){
					     $data = array(
					    "category_name"=>$cat_title,
						"updated_date_time"=>dateandtime()
						
					);
						$this->SqlModel->updateRecord(prefix."tbl_category",$data,array("category_id"=>$category_id));
						set_message("success","You have successfully updated a category");
						redirect_page("product","categoryList",array());				
					}else{
					    $data = array(
					    "category_name"=>$cat_title,
						"created_date_time"=>dateandtime()
						
					);
					    
					    $exist =$model->checkvalueExist('tbl_category','category_name',$cat_title);
					    if($exist <=0)
					    {
						$this->SqlModel->insertRecord(prefix."tbl_category",$data);
						set_message("success","You have successfully added a category");
						redirect_page("product","categoryList",array());
					    }
					    else
					    {
					    set_message("danger","This category name already used ...");
						redirect_page("product","categoryAdd",array());
					    }
					}
				}
			break;
			case "DELETE":
				if($category_id>0){
					$this->SqlModel->updateRecord(prefix."tbl_category",array("status"=>'2'),array("category_id"=>$category_id));
					set_message("success","You have successfully deleted news details");
				}else{
					set_message("warning","Failed , unable to delete news");
				}
				redirect_page("product","categoryList",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_category WHERE category_id='$category_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
        $this->load->view(ADMIN_FOLDER."/product/categoryadd",$data);//$data
	}

	public function categoryList()
	{
		$this->load->view(ADMIN_FOLDER.'/product/categorylist',$data);	
	}
		public function productAdd()
	{
		$model = new OperationModel();
	

		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$product_id = ($form_data['product_id'])? $form_data['product_id']:$segment['product_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitcat']==1 && $this->input->post()!=''){
				    
				
				//********************8Remove Image8**********************	
			//$fldvPath = "";		
			//$final_location = $fldvPath."upload/product/kwq6OrwlhlZHcg0oqGl5wDIVC544_462.jpg";
			//$fldvImageArr= @getimagesize($final_location);
			//if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }

	               	$product_name = FCrtRplc($form_data['product_name']);
	               	$product_desc = FCrtRplc($form_data['product_desc']);
	               	$product_mrp = FCrtRplc($form_data['product_mrp']);
	               	$product_dmrp = FCrtRplc($form_data['product_dmrp']);	
	               	$product_bv = FCrtRplc($form_data['product_bv']);	
	               	$offer_price = FCrtRplc($form_data['offer_price']);
	               	$point_value = FCrtRplc($form_data['point_value']);
	               	$other = FCrtRplc($form_data['other']);

					if($model->checkCount(prefix."tbl_product","product_id",$product_id)>0){
					     $data = array(
					    "category_name"=>$cat_title,
						"updated_date_time"=>dateandtime()
						
					);
						$this->SqlModel->updateRecord(prefix."tbl_category",$data,array("category_id"=>$category_id));
						set_message("success","You have successfully updated a category");
						redirect_page("product","categoryList",array());				
					}else{
												   
					    $data = array(
					    "product_name"=>$product_name,
					    "product_desc"=>$product_desc,
					    "product_mrp"=>$product_mrp,
					    "product_dmrp"=>$product_dmrp,
					    "product_bv"=>$product_bv,
					    "offer_price"=>$offer_price,
					    "point_value"=>$point_value,
					    "other"=>$other,
						"created_date"=>dateandtime(),
						"updated_date"=>dateandtime()
						
					);
					
				//	echo "<pre>";print_r($data);print_r($form_data);die;
					    
					    $exist =$model->checkvalueExist('tbl_product','product_name',$product_name);
					    if($exist <=0)
					    {
					        if($product_mrp > $product_dmrp){
					        
				    	$product_id = $this->SqlModel->insertRecord(prefix."tbl_product",$data);
						
					$i = 0;
    foreach ($_FILES['product_img']['name'] as $file)
            {
				$ext = explode(".",$_FILES['product_img']["name"][$i]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/product/".$photo;
				
					if(move_uploaded_file($_FILES['product_img']['tmp_name'][$i], $target_path)){
                	$image_data = array('package_id'=>$product_id,'image'=>$photo);
                	$this->SqlModel->insertRecord(prefix."tbl_product_img",$image_data);
					$i++;	
					}
			}
			
			
			
						set_message("success","You have successfully added a Product");
						redirect_page("product","productAdd",array());
					    
					        }
					        else
					    {
					    set_message("danger","Discounted Price should be less than MRP Price ...");
						redirect_page("product","productAdd",array());
					    }
					        
					    }
					    else
					    {
					    set_message("danger","This product name already used ...");
						redirect_page("product","productAdd",array());
					    }
					}
				}
			break;
			case "DELETE":
				if($category_id>0){
					$this->SqlModel->updateRecord(prefix."tbl_category",array("status"=>'2'),array("category_id"=>$category_id));
					set_message("success","You have successfully deleted news details");
				}else{
					set_message("warning","Failed , unable to delete news");
				}
				redirect_page("product","categoryList",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_category WHERE category_id='$category_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
        $this->load->view(ADMIN_FOLDER."/product/productadd",$data);
	}
	public function productEdit()
	{
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
        $this->load->view(ADMIN_FOLDER."/homepage", $data);
	}
	public function productList()
	{
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
        $this->load->view(ADMIN_FOLDER."/homepage", $data);
	}
	
	
	public function courier()
	{
		$this->load->view(ADMIN_FOLDER.'/product/courier',$data);	
	}
		public function updatecourier()
	{
	  $formData = $this->input->post();
	  	if($formData['submitdata']==1 && $this->input->post()!=''){
	  	    $member_id = $formData['memid'];
	  	    $data = array(
	  	        'courierno'=>$formData['courierno'],
	  	        'courierstatus'=>$formData['courierstatus'],
				'courierdate' =>$formData['courierdate'],
				'couriercompany'=>$formData['couriercompany']
	  	        
	  	    
	  	    );
	  	    
	  	    $page = $formData['page'];
	  	    if($page > 1 )
	  	    {
	  	        $P = 'courier?page='.$page.'&';
	  	    }
	  	    else{
	  	        
	  	        $P='courier';
	  	    }
	  	     $this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
	  	   	set_message("success","You have successfully updated a Courier detail");
			redirect_page("product",$P,array());				 
	  	}
	    set_message("danger","You con't access to direct panel !");
	  	redirect_page("product","courier",array());
	

	}

	
	
}
