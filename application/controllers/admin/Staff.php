<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	
	public function stafflist()
	{
	$this->load->view(ADMIN_FOLDER.'/staff/stafflist',$data);
	}
	public function staffdetails()
	{
	$this->load->view(ADMIN_FOLDER.'/staff/staffdetail',$data);
	}
	
    public function addstaff()
    {
        $model = new OperationModel();
		$form_data = $this->input->post();
		if($form_data['submitstaff']==1 && $this->input->post()!=''){
		    
		     if($_FILES['pic']['error']=="0"){
		 
		 $ext = explode(".",$_FILES['pic']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/staff/".$photo;	
				move_uploaded_file($_FILES['pic']['tmp_name'], $target_path);
		 }
		  $posted_data = array(
		      'first_name'=>$form_data['fname'],
		      'midle_name'=>$form_data['mname'],
		      'last_name'=>$form_data['lname'],
		      'dob'=>$form_data['dob'],
		      'pname'=>$form_data['pname'],
		      'mobile'=>$form_data['mob'],	
		      'email'=>$form_data['emailid'],
		      'gender'=>$form_data['gender'],
		      'martial_staus'=>$form_data['mstatus'],
		      'present_address'=>$form_data['presentAdd'],
		      'permanent_address'=>$form_data['permanentAdd'],
		      'designation'=>$form_data['cdesignation'],
		      'join_date'=>$form_data['jdate'],
		      'salary'=>$form_data['salary'],
		      'bank_name'=>$form_data['bank_name'],
		      'accountno'=>$form_data['accountno'],
		      'ifsccode'=>$form_data['ifsccode'],
		      'pan'=>$form_data['pan'],
		      'adharno'=>$form_data['adhar'],
		      'profile_pic'=>$photo,
		      'status'=>'Y',
		      'created_date'=>date('Y-m-d H:i:s')
		                      );  
		    	
		    	$this->SqlModel->insertRecord(prefix."tbl_staff",$posted_data);
		    		set_message("success","You have successfully added  a new  staff");
							redirect_page("staff","stafflist",array("error"=>"success"));	
		}
		
		$this->load->view(ADMIN_FOLDER.'/staff/addstaff',$data);
    }

}
?>