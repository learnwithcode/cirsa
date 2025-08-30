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
	
		 public function GetPropertyPilotdimension() {
//     ini_set('display_errors', 1);
// error_reporting(E_ALL);

    $model = new OperationModel();

    // Get POST data
    $typeId = $this->input->post('id');
    if (empty($typeId)) {
        echo "Invalid Type ID";
        return;
    }

    // Fetch blocks for the selected type
    $blocks = $model->get_propertypilotsdimenstion($typeId);

    // Output options for the block dropdown
    if (!empty($blocks)) {
       foreach ($blocks as $block) {
         $dimension=   $block['dimension'];
            $size=   $block['size'];
             $sqft=   $block['sqft'];
           
    echo "Plot Dimension :- $dimension And Square Foot : - $sqft sft And Plot Size :- $size";
}
    } else {
        echo "Not Found";
    }
}
	 public function GetPropertyPilotData() {
//     ini_set('display_errors', 1);
// error_reporting(E_ALL);

    $model = new OperationModel();

    // Get POST data
    $typeId = $this->input->post('id');
    if (empty($typeId)) {
        echo "Invalid Type ID";
        return;
    }

    // Fetch blocks for the selected type
    $blocks = $model->get_propertypilots($typeId);

    // Output options for the block dropdown
    if (!empty($blocks)) {
        echo "<option value=''>--- Select Plots ---</option>";
       foreach ($blocks as $block) {
    echo "<option value='" . htmlspecialchars($block['block_name']) . "'>" . htmlspecialchars($block['block_name']) . "</option>";
}
    } else {
        echo "<option value=''>No blocks found</option>";
    }
}

	 public function GetPropertyData111() {
//     ini_set('display_errors', 1);
// error_reporting(E_ALL);

    $model = new OperationModel();

    // Get POST data
    $propertyId = $this->input->post('id');
    if (empty($propertyId)) {
        echo "Invalid Type ID";
        return;
    }

    // Fetch blocks for the selected type
    $blocks = $model->get_propertytypes($propertyId);

    // Output options for the block dropdown
    if (!empty($blocks)) {
        echo "<option value=''>--- Select Type ---</option>";
       foreach ($blocks as $block) {
    echo "<option value='" . htmlspecialchars($block['type_id']) . "'>" . htmlspecialchars($block['type_name']) . "</option>";
}
    } else {
        echo "<option value=''>No blocks found</option>";
    }
}
	
		 public function GetPropertyData() {
//     ini_set('display_errors', 1);
// error_reporting(E_ALL);

    $model = new OperationModel();

    // Get POST data
    $typeId = $this->input->post('id');
    if (empty($typeId)) {
        echo "Invalid Type ID";
        return;
    }

    // Fetch blocks for the selected type
    $blocks = $model->get_propertyblocks($typeId);

    // Output options for the block dropdown
    if (!empty($blocks)) {
        echo "<option value=''>--- Select Blocks ---</option>";
       foreach ($blocks as $block) {
    echo "<option value='" . htmlspecialchars($block['block']) . "'>" . htmlspecialchars($block['block']) . "</option>";
}
    } else {
        echo "<option value=''>No blocks found</option>";
    }
}
 public function GetPropertyDatabyBlock() {
header('Content-Type: application/json');
	     
	     	$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(1);
		$today_date = InsertDate(getLocalTime());
	
	$type =	$form_data['type'];
	$block =	$form_data['block'];
	//PrintR($form_data); die;
	//	die;
  $blocks = $model->get_propertyblocksnew($type,$block);
  
 // return $blocks;
  PrintR($blocks); 
	   return   $blocks =json_encode($blocks);
	     
// 	     $jo = json_decode($blocks);
// return $jo;
	     
    if (empty($typeId)) {
        echo "Invalid Type ID";
        return;
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
    
    
    if($form_data['submitMemberSave1']==1 && $this->input->post()!=''){
 
   
                $image = null; // Initialize $image
            	if($_FILES['propertyimage']['error']=="0"){
				$ext = explode(".",$_FILES['propertyimage']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$propertyimage = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/property/".$propertyimage;
				move_uploaded_file($_FILES['propertyimage']['tmp_name'], $target_path);
            	}
            	
            	
            		if($_FILES['aadharimage']['error']=="0"){
				$ext = explode(".",$_FILES['aadharimage']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$aadharimage = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/property/".$aadharimage;
				move_uploaded_file($_FILES['aadharimage']['tmp_name'], $target_path);
            	}
            	
            	
            		if($_FILES['pannoimage']['error']=="0"){
				$ext = explode(".",$_FILES['pannoimage']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$pannoimage = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/property/".$pannoimage;
				move_uploaded_file($_FILES['pannoimage']['tmp_name'], $target_path);
            	}
            	
            	
            	
               if(isset($_FILES['aggreementpdf'])) {
                 	$ext_pdf = explode(".",$_FILES['aggreementpdf']["name"]);
            				$fExtn_pdf = strtolower(end($ext_pdf));
            				$fldvUniqueNo_pdf = UniqueId("UNIQUE_NO");
            				$aggreementpdf = $fldvUniqueNo_pdf.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn_pdf);
            				$target_path_pdf = $fldvPath_pdf."upload/property/".$aggreementpdf;
            				move_uploaded_file($_FILES['aggreementpdf']['tmp_name'], $target_path_pdf);
                }
                
                 // Sanitize and retrieve form data
            $username = FCrtRplc($form_data['username']);	
            $mobileno = FCrtRplc($form_data['mobileno']);
            $emailid = FCrtRplc($form_data['emailid']);
            $pan_no = FCrtRplc($form_data['pan_no']);
            $useradhar = FCrtRplc($form_data['useradhar']);
            $pamount = FCrtRplc($form_data['pamount']);
            $propertyaddress = FCrtRplc($form_data['propertyaddress']);
            $propertycat = FCrtRplc($form_data['propertycat']);
            $propertytype = FCrtRplc($form_data['propertytype']);
            $propertypolotno = FCrtRplc($form_data['propertypolotno']);
            $propertystatus = FCrtRplc($form_data['propertystatus']);
            $propertyimage = FCrtRplc($propertyimage);
            $aadharimage = FCrtRplc($aadharimage);
            $pannoimage = FCrtRplc($pannoimage);
            $aggreementpdf = FCrtRplc($aggreementpdf);
                
                
                
                
                
        $postData = array( 
'username'  => $username ,
'mobileno'  => $mobileno ,
'emailid' => $emailid ,
'pan_no' => $pan_no ,
'useradhar'  => $useradhar ,
'pamount'  => $pamount ,
'propertyaddress'  => $propertyaddress ,
'propertycat'  => $propertycat ,
'propertytype'  => $propertytype ,
'propertypolotno'  => $propertypolotno ,
'propertystatus'  => $propertystatus ,
'propertyimage'  => $propertyimage ,
'aadharimage'  => $aadharimage ,
'pannoimage'  => $pannoimage ,
'aggreementpdf'  => $aggreementpdf ,
   
   
    ); 
  
//PrintR($postData);
$this->SqlModel->insertRecord(prefix."tbl_purchaseproperty",$postData); 
$this->SqlModel->insertRecord(prefix."tbl_purchaseproperty_all",$postData);  

  $data_sub = array(
                "status"=>$propertystatus
               
                );
           
				$this->SqlModel->updateRecord(prefix."tbl_propertynew_blocks",$data_sub,array("block_name"=>$propertypolotno));  
  set_message("success", "You have successfully added a property");
   redirect($_SERVER['HTTP_REFERER']);
       
    }
    
    
       
              

    // Load the property add view
    // $this->load->view(ADMIN_FOLDER."/property/propertyadd");
      
}


   

  public function update() {
        $model = new OperationModel();
        $form_data = $this->input->post();
    
   // PrintR($form_data); die;
        // Get the property ID from form data
        $id = FCrtRplc($form_data['propertyid']);	
        $propertyname = FCrtRplc($form_data['propertyname']);
        
        if($form_data['Updateuser']==1 && $this->input->post()!=''){
            
            
            
                $image = null; // Initialize $image
              if (isset($_FILES['propertyimage']) && $_FILES['propertyimage']['error'] == 0 && $_FILES['propertyimage']['size'] != 0 ) {
				$ext = explode(".",$_FILES['propertyimage']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$propertyimage = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/property/".$propertyimage;
				move_uploaded_file($_FILES['propertyimage']['tmp_name'], $target_path);
            	}
            	
            	
            	  if (isset($_FILES['aadharimage']) && $_FILES['aadharimage']['error'] == 0 && $_FILES['aadharimage']['size'] != 0 ) {
				$ext = explode(".",$_FILES['aadharimage']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$aadharimage = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/property/".$aadharimage;
				move_uploaded_file($_FILES['aadharimage']['tmp_name'], $target_path);
            	}
            	
            	
            	  if (isset($_FILES['pannoimage']) && $_FILES['pannoimage']['error'] == 0 && $_FILES['pannoimage']['size'] != 0 ) {
				$ext = explode(".",$_FILES['pannoimage']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$pannoimage = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/property/".$pannoimage;
				move_uploaded_file($_FILES['pannoimage']['tmp_name'], $target_path);
            	}
            	
            	
            	
              if (isset($_FILES['aggreementpdf']) && $_FILES['aggreementpdf']['error'] == 0 && $_FILES['aggreementpdf']['size'] != 0 ) {
                 	$ext_pdf = explode(".",$_FILES['aggreementpdf']["name"]);
            				$fExtn_pdf = strtolower(end($ext_pdf));
            				$fldvUniqueNo_pdf = UniqueId("UNIQUE_NO");
            				$aggreementpdf = $fldvUniqueNo_pdf.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn_pdf);
            				$target_path_pdf = $fldvPath_pdf."upload/property/".$aggreementpdf;
            				move_uploaded_file($_FILES['aggreementpdf']['tmp_name'], $target_path_pdf);
                }
                
                 // Sanitize and retrieve form data
            $username = FCrtRplc($form_data['username']);	
            $mobileno = FCrtRplc($form_data['mobileno']);
            $emailid = FCrtRplc($form_data['emailid']);
            $pan_no = FCrtRplc($form_data['pan_no']);
            $useradhar = FCrtRplc($form_data['useradhar']);
            $pamount = FCrtRplc($form_data['pamount']);
            $propertyaddress = FCrtRplc($form_data['propertyaddress']);
            
            $propertystatus = FCrtRplc($form_data['propertystatus']);
            
              $propertyhistory   = $model->getMemberpropertyhistorydetail($id);
	      
	// PrintR($propertyhistory);die;
            
            $propertyimage = FCrtRplc($propertyimage);
            $aadharimage = FCrtRplc($aadharimage);
            $pannoimage = FCrtRplc($pannoimage);
            $aggreementpdf = FCrtRplc($aggreementpdf);
                
            if($propertyimage =='' ){   $propertyimage =  $propertyhistory['propertyimage'] ;        }  else {$propertyimage;   }  
            
            if($aadharimage =='' ){     $aadharimage =  $propertyhistory['aadharimage'] ;         }      else {  $aadharimage; }  
            
            if($pannoimage =='' ){    $pannoimage =  $propertyhistory['pannoimage'] ;          }      else {$pannoimage;   }  
            
            if($aggreementpdf =='' ){    $aggreementpdf =  $propertyhistory['aggreementpdf'] ;          }      else {  $aggreementpdf; }  
                
             //   die;
                
                
                
        $postData = array( 
'username'  => $username ,
'mobileno'  => $mobileno ,
'emailid' => $emailid ,
'pan_no' => $pan_no ,
'useradhar'  => $useradhar ,
'pamount'  => $pamount ,
'propertyaddress'  => $propertyaddress ,

'propertystatus'  => $propertystatus ,
'propertyimage'  => $propertyimage ,
'aadharimage'  => $aadharimage ,
'pannoimage'  => $pannoimage ,
'aggreementpdf'  => $aggreementpdf ,
   
   
    ); 
  
//PrintR($postData);
 $condition = ['id' => $id]; // Condition to match the record
        if ($this->SqlModel->updateRecord('tbl_purchaseproperty', $postData, $condition)) {
           $propertypolotno =  $propertyhistory['propertypolotno'];
             $data_sub = array(
                "status"=>$propertystatus
               
                );
           
				$this->SqlModel->updateRecord(prefix."tbl_propertynew_blocks",$data_sub,array("block_name"=>$propertypolotno));  
            set_message("success", "You have successfully updated the property.");
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            set_message("error", "Property update failed.");
            redirect($_SERVER['HTTP_REFERER']);
        }
 
   
   
        }
        
        
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
