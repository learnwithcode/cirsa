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
	
	public function categoryadd()
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

	public function categorylist()
	{
		$this->load->view(ADMIN_FOLDER.'/product/categorylist',$data);	
	}
	public function invoice()
	{
		$this->load->view(ADMIN_FOLDER.'/product/product_invoice',$data);	
	}
	public function productadd()
	{
		$model = new OperationModel();
	    $form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$product_id = ($form_data['product_id'])? $form_data['product_id']:$segment['product_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitcat']==1 && $this->input->post()!=''){
				    $category_id =  FCrtRplc($form_data['category_id']);	
			     	$product_name = FCrtRplc($form_data['product_name']);
			     	$hsn_code = FCrtRplc($form_data['hsn_code']);
			     	$tax =   FCrtRplc($form_data['tax']);
			     	$display_order =FCrtRplc($form_data['display_order']);
	                $product_desc = FCrtRplc($form_data['product_desc']);
	                
                   
                    $p_net =  FCrtRplc($form_data['p_net']);
	               	$p_gst = FCrtRplc($form_data['p_gst']);	
	               	$p_mrp =   FCrtRplc($form_data['p_mrp']);
	               	$p_bv =   FCrtRplc($form_data['p_bv']);
                     
                    $r_net =  FCrtRplc($form_data['r_net']);
	               	$r_gst = FCrtRplc($form_data['r_gst']);	
	               	$r_mrp =   FCrtRplc($form_data['r_mrp']);
	               	$r_bv =   FCrtRplc($form_data['r_bv']);
	                $qty =   FCrtRplc($form_data['qty']);
                    
	              
						
 
					if($model->checkCount(prefix."tbl_product","product_id",$product_id)>0){
					   	   $QR_PAGE ="SELECT * FROM ".prefix."tbl_product WHERE product_id='$product_id'";
				           $SEL_QUERY = $this->db->query($QR_PAGE);
				           $AR_PAGE = $SEL_QUERY->row_array();
				           $image  = $AR_PAGE['image'];
							 if ($_FILES['product_img']['error']=="0")
                              {   
				$ext = explode(".",$_FILES['product_img']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/product/".$photo;
				
					if(move_uploaded_file($_FILES['product_img']['tmp_name'], $target_path)){
			 $final_location = $fldvPath."upload/product/".$image;
			 $fldvImageArr= @getimagesize($final_location);
			 if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
                	$image =  $photo;
                	 
					 
					}
			} 
												   
					    $data = array(
						"category_id" =>$category_id,
					    "product_name"=>$product_name,
					    "hsn_code"=>$hsn_code,
					    "tax"=>$tax,
					    "display_order" =>$display_order,
					    "product_desc"=>$product_desc,
					    
					    "p_net"=>$p_net,
					    "p_gst"=>$p_gst,
					    "p_mrp"=>$p_mrp,
					    "p_bv" =>$p_bv,
					    "r_net"=>$r_net,
					    "r_gst"=>$r_gst,
					    "r_mrp"=>$r_mrp,
					    "r_bv" =>$r_bv,
					    "qty" =>$qty,				 
						"image"=>$image,
						
						"updated_date"=>dateandtime()
						
					);
						$this->SqlModel->updateRecord(prefix."tbl_product",$data,array("product_id"=>$product_id));
						set_message("success","You have successfully updated a category");
						redirect_page("product","productlist",array());				
					}else{
							
							 $image = '';
							 
					 
							 if ($_FILES['product_img']['error']=="0")
                              {     
				$ext = explode(".",$_FILES['product_img']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/product/".$photo;
				
					if(move_uploaded_file($_FILES['product_img']['tmp_name'], $target_path)){
                		$image =  $photo;
					 
					}
			}    
												   
					    $data = array(
					    "category_id" =>$category_id,
					    "product_name"=>$product_name,
					    "hsn_code"=>$hsn_code,
					    "tax"   =>$tax,
					    "display_order" =>$display_order,
					    "product_desc"=>$product_desc,
					    "p_net"=>$p_net,
					    "p_gst"=>$p_gst,
					    "p_mrp"=>$p_mrp,
					    "p_bv" =>$p_bv,
					    "r_net"=>$r_net,
					    "r_gst"=>$r_gst,
					    "r_mrp"=>$r_mrp,
					    "r_bv" =>$r_bv,			
					 	"qty" =>$qty,	 
						"image"=>$image,
						"created_date"=>dateandtime(),
						"updated_date"=>dateandtime()
						
					);
					
			 
					    
					    $exist =$model->checkvalueExist('tbl_product','product_name',$product_name);
					    if($exist <=0)
					    {
					       // if($product_mrp > $product_dmrp){
					        
				    	$product_id = $this->SqlModel->insertRecord(prefix."tbl_product",$data);
						
				 
   
			
			
			
						set_message("success","You have successfully added a Product");
						redirect_page("product","productlist",array());
					    
				// 	        }
				// 	        else  {
				// 	    set_message("danger","Discounted Price should be less than MRP Price ...");
				// 		redirect_page("product","productAdd",array());
				// 	    }
					        
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
				if($product_id>0){
					$this->SqlModel->updateRecord(prefix."tbl_product",array("status"=>'2'),array("product_id"=>$product_id));
					set_message("success","You have successfully deleted a Product");
				}else{
					set_message("warning","Failed , unable to delete Product");
				}
				redirect_page("product","productlist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_product WHERE product_id='$product_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
        $this->load->view(ADMIN_FOLDER."/product/productadd",$data);
	}
	public function productedit()
	{
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
        $this->load->view(ADMIN_FOLDER."/homepage", $data);
	}
	public function productlist()
	{ 
        $this->load->view(ADMIN_FOLDER."/product/productlist", $data);
	}
	
	public function productstatus()
	{
	$status = $this->input->post('status');
	$productId = $this->input->post('productId');
	if($status =='false')
	{
	$data = array('status'=>'0');
	$this->SqlModel->updateRecord(prefix."tbl_product",$data,array("product_id"=>$productId));
	echo "This banner are disabled on website";
	}
	elseif($status =='true')
	{
	$data = array('status'=>'1');
	$this->SqlModel->updateRecord(prefix."tbl_product",$data,array("product_id"=>$productId));
	echo "This banner are enabled on website";
	}
	else
	{
	echo "Unknown";
	}
	}
	
	public function courier()
	{
		$this->load->view(ADMIN_FOLDER.'/product/courier',$data);	
	}
	
	public function stock_manager()
	{
      $this->load->view(ADMIN_FOLDER."/product/stocklist", $data);
	}
	public function stock_add()
	{
		$model = new OperationModel();
	    $form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$product_id = ($form_data['product_id'])? $form_data['product_id']:$segment['product_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitcat']==1 && $this->input->post()!=''){
				 
			     	$mrp = FCrtRplc($form_data['mrp']);
	                $dp = FCrtRplc($form_data['dp']);
	               	$purchase_price =  FCrtRplc($form_data['purchase_price']);
	               	$quantity = FCrtRplc($form_data['quantity']);	
	               	$product_id =   FCrtRplc($form_data['product_id']);	
	               $stock_id =   FCrtRplc($form_data['stock_id']);	
 
					if($model->checkCount(prefix."tbl_product_stock","stock_id",$stock_id)>0){
/*				$QR_PAGE ="SELECT * FROM ".prefix."tbl_product WHERE product_id='$product_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$image  = $AR_PAGE['image'];
							 if ($_FILES['product_img']['error']=="0")
                              {   
				$ext = explode(".",$_FILES['product_img']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/product/".$photo;
				
					if(move_uploaded_file($_FILES['product_img']['tmp_name'], $target_path)){
			 $final_location = $fldvPath."upload/product/".$image;
			 $fldvImageArr= @getimagesize($final_location);
			 if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
                	$image =  $photo;
                	 
					 
					}
			} 
												   
					    $data = array(
						"category_id" =>$category_id,
					    "product_name"=>$product_name,
					    "product_desc"=>$product_desc,
					    "product_mrp"=>$product_mrp,
					    "product_dmrp"=>$product_dmrp,
					    "product_bv"=>$product_bv,					 
						"image"=>$image,
						"display_order" =>$display_order,
						"updated_date"=>dateandtime()
						
					);
						$this->SqlModel->updateRecord(prefix."tbl_product",$data,array("product_id"=>$product_id));
						set_message("success","You have successfully updated a category");*/
						redirect_page("product","productlist",array());				
					}else{
							 						   
					    $data = array(
						"product_id" =>$product_id,
						"mrp" =>$mrp,
					    "dp"=>$dp,
					    "purchase_price"=>$purchase_price,
					    "quantity"=>$quantity,
					    "added_date_time"=>dateandtime()
						 
						
					);
					 
					        if($mrp > $dp){
					        
				    	  $this->SqlModel->insertRecord(prefix."tbl_product_stock",$data);
						 $product = $model-> getrow('tbl_product','product_id',$product_id);
					     $total_quantity = $quantity + $product['quantity'];  
						 $data = array('quantity' => $total_quantity);
						 $this->SqlModel->updateRecord(prefix."tbl_product",$data,array("product_id"=>$product_id));
						set_message("success","You have successfully added a Product");
						redirect_page("product","stock_manager",array("product_id"=>$product_id,"action_request"=>"LIST"));
					    
					        }
					        else  {
					    set_message("danger","Discounted Price should be less than MRP Price ...");
						redirect_page("product","stock_add",array('product_id'=>$product_id,'action_request'=>'ADD_UPDATE'));
					    }
					        
					     
					}
				}
			break;
			case "DELETE":
				if($product_id>0){
					$this->SqlModel->updateRecord(prefix."tbl_product",array("status"=>'2'),array("product_id"=>$product_id));
					set_message("success","You have successfully deleted a Product");
				}else{
					set_message("warning","Failed , unable to delete Product");
				}
				redirect_page("product","productlist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_product WHERE product_id='$product_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
        $this->load->view(ADMIN_FOLDER."/product/stockadd",$data);
	}
	
	public function updatecourier()
	{
	  $formData = $this->input->post();
	  	if($formData['submitdata']==1 && $this->input->post()!=''){
	  	    $sale_id = $formData['sale_id'];
	  	    $data = array(
	  	        'courierno'      =>$formData['courierno'],
	  	        'courierstatus'  =>$formData['courierstatus'],
				'courierdate'    =>$formData['courierdate'],
				'couriercompany' =>$formData['couriercompany'],
	  	        'courierremark'=>$formData['courierremark']
	  	    
	  	    );
	  	    
	  	    $page = $formData['page'];
	  	    if($page > 1 )
	  	    {
	  	        $P = 'courier?page='.$page.'&';
	  	    }
	  	    else{
	  	        
	  	        $P='courier';
	  	    }
	  	     $this->SqlModel->updateRecord(prefix."tbl_sale",$data,array("sale_id"=>$sale_id));
	  	   	set_message("success","You have successfully updated a Courier detail");
			redirect_page("product",$P,array());				 
	  	}
	    set_message("danger","You con't access to direct panel !");
	  	redirect_page("product","courier",array());
	

	}
    public function order_request()
	{
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
        $this->load->view(ADMIN_FOLDER."/product/order_request", $data);
	}
	public function view_sale_product()
	{
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
        $this->load->view(ADMIN_FOLDER."/product/orderRequestList", $data);
	}
	
	 public function confirm_request()
		 {
		    $model = new OperationModel();
		   $today_date    = InsertDate(getLocalTime());	
		   $trans_no = UniqueId("TRNS_NO");
		  $segment = $this->uri->uri_to_assoc(2); 
		  $sale_id =  _d($segment['sale_id']);
		  $action_request = $segment['STS'];
	  
	 
		switch($action_request):
			case "C":
		 
			 
					$data = array("status"=>'Y');
			 	 	$this->SqlModel->updateRecord(prefix."tbl_sale",$data,array("sale_id"=>$sale_id));
			   
				 
					set_message("success","Order Request has been Approved.");
					redirect_page("product","order_request",array()); exit;
			 
			 
			break;
			case "R":
			        $order = $model->getorderDetail($sale_id);
			        $total_price =$order['total_price'];
					$member_id =$order['member_id'];
					if($order['payment_by']=='P') { $wallet_id ='2'; }	elseif($order['payment_by']=='R') { $wallet_id ='3'; }else{$wallet_id ='1';}
			        $model->wallet_transaction($wallet_id,"Cr",$member_id,$total_price,'Product Request Reject',$today_date,$trans_no,"1","SALE");
				    $data = array("status"=>'R');
					$this->SqlModel->updateRecord(prefix."tbl_sale",$data,array("sale_id"=>$sale_id));
					 
					set_message("success","Order Request has been Rejected.");
					redirect_page("product","order_request",array()); exit;
			 
			break;
			
		endswitch;
		 }
}
