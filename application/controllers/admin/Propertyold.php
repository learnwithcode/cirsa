<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	    $this->load->library('form_validation');
	   $this->load->database();
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	


	public function addproperty() {
    $model = new OperationModel();
    $form_data = $this->input->post();
    // Load the property add view
    $this->load->view(ADMIN_FOLDER."/property/propertyadd");
     }


	public function indexproperty() {
    $model = new OperationModel();
    $form_data = $this->input->post();
    
       $this->load->helper('url'); // Load URL helper
    $this->load->library('upload'); // Load Upload library
    
    
    // Debugging output for incoming files and form data
    // PrintR($_FILES);
    // PrintR($form_data);die;
    
        // Get the property ID and action request from URI or POST data
        $segment = $this->uri->uri_to_assoc(2);


        // Sanitize and retrieve form data
        $propertyname = FCrtRplc($form_data['propertyname']);	
        $propertycat = FCrtRplc($form_data['propertycat']);
        $propertyprice = FCrtRplc($form_data['propertyprice']);
        $propertypricetype = FCrtRplc($form_data['propertypricetype']);
        
        $beds = FCrtRplc($form_data['beds']);
        $bath = FCrtRplc($form_data['bath']);
        
        
        $hall = FCrtRplc($form_data['hall']);
        $kitchen = FCrtRplc($form_data['kitchen']);
        $builderarea = FCrtRplc($form_data['builderarea']);
        $carpetarea = FCrtRplc($form_data['carpetarea']);
        $propertynearby = FCrtRplc($form_data['propertynearby']);
        
        
        
        
        $flore = FCrtRplc($form_data['flore']);
        $propertyfor = FCrtRplc($form_data['propertyfor']);	
        $area = FCrtRplc($form_data['area']);
        $areatype = FCrtRplc($form_data['areatype']);
        $arrayfeature = $this->input->post('accessiblefeatures');
        $accessiblefeatures =  implode(",",$arrayfeature);
        // print_r($accessiblefeatures);die;
        $propertyaddress = FCrtRplc($form_data['propertyaddress']);
        $propertyzipcode = FCrtRplc($form_data['propertyzipcode']);	
        $propertycity = FCrtRplc($form_data['propertycity']);
        $propertycountry = FCrtRplc($form_data['propertycountry']);
        $property_count = FCrtRplc($form_data['property_count']);
        
        
        $blockno = FCrtRplc($form_data['blockno']);
        $plotno = FCrtRplc($form_data['plotno']);
        $areanorth = FCrtRplc($form_data['areanorth']);
        $areasouth = FCrtRplc($form_data['areasouth']);
        $areaeast = FCrtRplc($form_data['areaeast']);
        $areawest = FCrtRplc($form_data['areawest']);
        $propertydescription = FCrtRplc($form_data['propertydescription']);
        $propertyuploadLinkMap = $form_data['propertyuploadLinkMap'];
     
                
             
			
                // print_r($target_path);die;

            $data = $this->prepareDataArray($propertyname, $propertycat, $propertyprice, $propertypricetype, $beds, $bath, $flore, $propertyfor, $area,$areatype, $accessiblefeatures, $propertyaddress, $propertyzipcode, $propertycity, $propertycountry , $property_count);
                        // print_r($data);die;
              $photopdf_pdf = null;
                // Check if the PDF is uploaded
                if(isset($_FILES['uploadpdf'])) {
                 	$ext_pdf = explode(".",$_FILES['uploadpdf']["name"]);
            				$fExtn_pdf = strtolower(end($ext_pdf));
            				$fldvUniqueNo_pdf = UniqueId("UNIQUE_NO");
            				$photopdf_pdf = $fldvUniqueNo_pdf.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn_pdf);
            				$target_path_pdf = $fldvPath_pdf."upload/property/".$photopdf_pdf;
            				move_uploaded_file($_FILES['uploadpdf']['tmp_name'], $target_path_pdf);
                }
          
                $image = null; // Initialize $image
            	if($_FILES['image']['error']=="0"){
				$ext = explode(".",$_FILES['image']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/property/".$photo;
				move_uploaded_file($_FILES['image']['tmp_name'], $target_path);
            	}
            	
            	
            	
            
                
                
            	
                $data['blockno'] = $blockno;
                $data['plotno'] = $plotno;
                $data['areanorth'] = $areanorth;
                $data['areasouth'] = $areasouth;
                $data['areaeast'] = $areaeast;
                $data['areawest'] = $areawest;
                $data['propertydescription'] = $propertydescription;
                $data['propertyuploadLinkMap'] = $propertyuploadLinkMap;
                
                
                $data['hall'] = $hall;
                $data['kitchen'] = $kitchen;
                $data['builderarea'] = $builderarea;
                $data['carpetarea'] = $carpetarea;
                $data['propertynearby'] = $propertynearby;
            
                
                $data['uploadpdf'] = $photopdf_pdf;
                $data['image'] = $photo;
                
                // print_r($data);die;
                $property_id = $this->SqlModel->insertRecord(prefix."tbl_property", $data);
                set_message("success", "You have successfully added a property");

    // Load the property add view
    // $this->load->view(ADMIN_FOLDER."/property/propertyadd");
       redirect($_SERVER['HTTP_REFERER']);
}


    public function update() {
        $model = new OperationModel();
        $form_data = $this->input->post();
    
        // Get the property ID from form data
        $id = FCrtRplc($form_data['id']);	
        $propertyname = FCrtRplc($form_data['propertyname']);	
        $propertycat = FCrtRplc($form_data['propertycat']);
        $propertyprice = FCrtRplc($form_data['propertyprice']);
        $propertypricetype = FCrtRplc($form_data['propertypricetype']);
        
        $beds = FCrtRplc($form_data['beds']);
        $bath = FCrtRplc($form_data['bath']);
        $flore = FCrtRplc($form_data['flore']);
        $propertyfor = FCrtRplc($form_data['propertyfor']);	
        $area = FCrtRplc($form_data['area']);
        $areatype = FCrtRplc($form_data['areatype']);
        
        // Handling the features array
       $arrayfeature = $this->input->post('accessiblefeatures');
       
     
        $accessiblefeatures =  implode(",",$arrayfeature);
    //   print_r($accessiblefeatures);die;
        $propertyaddress = FCrtRplc($form_data['propertyaddress']);
        $propertyzipcode = FCrtRplc($form_data['propertyzipcode']);	
        $propertycity = FCrtRplc($form_data['propertycity']);
        $propertycountry = FCrtRplc($form_data['propertycountry']);
        
        $property_count = FCrtRplc($form_data['property_count']);
        
        $hall = FCrtRplc($form_data['hall']);
        $kitchen = FCrtRplc($form_data['kitchen']);
        $builderarea = FCrtRplc($form_data['builderarea']);
        $carpetarea = FCrtRplc($form_data['carpetarea']);
        $propertynearby = FCrtRplc($form_data['propertynearby']);
   
        $blockno = FCrtRplc($form_data['blockno']);
        $plotno = FCrtRplc($form_data['plotno']);
        $areanorth = FCrtRplc($form_data['areanorth']);
        $areasouth = FCrtRplc($form_data['areasouth']);
        $areaeast = FCrtRplc($form_data['areaeast']);
        $areawest = FCrtRplc($form_data['areawest']);
        $propertydescription = FCrtRplc($form_data['propertydescription']);
        $propertyuploadLinkMap = $form_data['propertyuploadLinkMap'];
     
        // File upload handling
      
    // print_r($_FILES);die;
      
        // Prepare the data array for updating
        $data = $this->prepareDataArray($propertyname, $propertycat, $propertyprice, $propertypricetype, $beds, $bath, $flore, $propertyfor, $area,$areatype, $accessiblefeatures, $propertyaddress, $propertyzipcode, $propertycity, $propertycountry , $property_count);
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0 && $_FILES['image']['size'] != 0 ) {
              $photo = null; // Initialize photo
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $fldvUniqueNo = UniqueId("UNIQUE_NO");
                $photo = $fldvUniqueNo . rand(100,999) . "_" . str_replace(" ", "", rand(100,999)) . "." . strtolower($ext);
                
                // Define the target path
                $target_path = "upload/property/" . $photo;
        
                // Move the uploaded file
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                    // Handle error if file upload fails
                    set_message("error", "Image upload failed.");
                    redirect($_SERVER['HTTP_REFERER']);
                }
                if($photo != null){
                 $data['image'] = $photo;
                }
               
            }
    
                // Check if the PDF is uploaded
            if(isset($_FILES['uploadpdf']) && $_FILES['uploadpdf']['error'] == 0 && $_FILES['uploadpdf']['size'] != 0 ) {  
                    
                        $photopdf_pdf == null;
                     	$ext_pdf = explode(".",$_FILES['uploadpdf']["name"]);
        				$fExtn_pdf = strtolower(end($ext_pdf));
        				$fldvUniqueNo_pdf = UniqueId("UNIQUE_NO");
        				$photopdf_pdf = $fldvUniqueNo_pdf.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn_pdf);
        				$target_path_pdf = $fldvPath_pdf."upload/property/".$photopdf_pdf;
        				move_uploaded_file($_FILES['uploadpdf']['tmp_name'], $target_path_pdf);
        				
        				 if($photopdf_pdf != null){
                           $data['uploadpdf'] = $photopdf_pdf;
                          }
            }    
            	
            $data['blockno'] = $blockno;
            $data['plotno'] = $plotno;
            $data['areanorth'] = $areanorth;
            $data['areasouth'] = $areasouth;
            $data['areaeast'] = $areaeast;
            $data['areawest'] = $areawest;
            
            
            $data['propertydescription'] = $propertydescription;
            $data['propertyuploadLinkMap'] = $propertyuploadLinkMap;
            $data['propertynearby'] = $propertynearby;
            
            $data['hall'] = $hall;
            $data['kitchen'] = $kitchen;
            $data['builderarea'] = $builderarea;
            $data['carpetarea'] = $carpetarea;
          
    
        // Update the record
        $condition = ['id' => $id]; // Condition to match the record
        if ($this->SqlModel->updateRecord('tbl_property', $data, $condition)) {
            set_message("success", "You have successfully updated the property.");
        } else {
            set_message("error", "Property update failed.");
        }
    
        // Redirect back to the previous page
        redirect($_SERVER['HTTP_REFERER']);
    }




// Prepare data array for insert/update
private function prepareDataArray($propertyname, $propertycat, $propertyprice, $propertypricetype, $beds, $bath, $flore, $propertyfor, $area, $areatype, $accessiblefeatures, $propertyaddress, $propertyzipcode, $propertycity, $propertycountry , $property_count) {

     
    return [
        "name" => $propertyname,
        "property_type" => $propertycat,
        "price" => $propertyprice,
        "pricetype" => $propertypricetype,
        "bed" => $beds,
        "bath" => $bath,
        "flore" => $flore,
        "accessibility_features" => $propertyfor,
        "size" => $area,
        "size_type" => $areatype,
        "accessible_features" => $accessiblefeatures,
        "address" => $propertyaddress,
        "property_location_zipcode" => $propertyzipcode,
        "property_location_city" => $propertycity,
        "property_location_country" => $propertycountry,
        "property_count" => $property_count,
        "updated_at" => dateandtime()
    ];
}

	
	public function propertyedit()
	{
	    
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
        $this->load->view(ADMIN_FOLDER."/homepage", $data);
	}
	
	
	
		public function edit($id)
	{
	  
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
		$data['id']=$id;
		
       $this->load->view(ADMIN_FOLDER."/property/edit", $data);
	}
	
	
		public function delete($id)
	{
	 
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
		
		
	    	$this->db->where('id', $id);
            $this->db->delete('tbl_property');
            
            // Check if the delete was successful
            if ($this->db->affected_rows() > 0) {
                   set_message("success", "Row deleted successfully.");
            } else {
                  set_message("success", "No rows affected. Deletion failed or the row doesn't exist.");
            }

       redirect($_SERVER['HTTP_REFERER']);
	}
	
	
	public function propertyList()
	{ 
        $this->load->view(ADMIN_FOLDER."/property/propertylist", $data);
	}
	
	
	
  
	
	
	
	
	
}
