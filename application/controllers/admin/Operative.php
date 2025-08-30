<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Operative extends MY_Controller {

	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	public function zoomeetings(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$news_id = ($form_data['news_id'])? $form_data['news_id']:$segment['news_id'];
		switch($action_request){ 
			case "ADD_UPDATE":
				if($form_data['submitNEWS']==1 && $this->input->post()!=''){
					$zoomtitle = FCrtRplc($form_data['zoomtitle']);
					$events_title = FCrtRplc($form_data['events_title']);
					$edate = InsertDate($form_data['edate']);
						$starttime = FCrtRplc($form_data['starttime']);
					$endtime = FCrtRplc($form_data['endtime']);
					$links = FCrtRplc($form_data['links']);
						$password = FCrtRplc($form_data['password']);
							$status = FCrtRplc($form_data['status']);
					$news_sts = ($form_data['news_sts']=="on")? 1:0;
				








				
					
			
			
					
					
		  if($news_id > 0)
		  {  
		  $news_id = $form_data['news_id'];
		  
		  //$AR_BAN = SelectTable("tbl_zoomeeting","news_img","news_id='$news_id'");
		  //$photo  = $AR_BAN['news_img']; 
	
		// $posted_data = array('news_img' => $photo);
		 
                        $data = array("zoomtitle"=>$zoomtitle,
                        "events_title"=>$events_title,
                        "edate"=>$edate,
                        "starttime"=>$starttime,
                        "endtime"=>$endtime,
                        "links"=>$links,
                        "password"=>$password,
                        "status"=>$status,
                        "news_sts"=>$news_sts,
                      
                        );
				 
				 
				 
				 
		 
		 
		 
		 
		 
		$this->SqlModel->updateRecord(prefix."tbl_zoomeeting",$data,array("news_id"=>$news_id));
	//	 set_message("success","Successfully updated Popup .");
				    redirect_page("operative","news",array()); 
		  }
		  else
		  {
	
	   $data = array("zoomtitle"=>$zoomtitle,
                        "events_title"=>$events_title,
                        "edate"=>$edate,
                        "starttime"=>$starttime,
                        "endtime"=>$endtime,
                        "links"=>$links,
                        "password"=>$password,
                        "status"=>$status,
                        "news_sts"=>$news_sts,
                     
                        );
				 
				 
	 $this->SqlModel->insertRecord(prefix."tbl_zoomeeting",$data);
				set_message("success","You have successfully updated a Zoom details");
						redirect_page("operative","zoomeetingslist",array());	
		  }
					
					
					
					
					
					
					
					if($model->checkCount(prefix."tbl_zoomeeting","news_id",$news_id)>0){
						$this->SqlModel->updateRecord(prefix."`tbl_zoomeeting",$data,array("news_id"=>$news_id));
						set_message("success","You have successfully updated a news details");
						redirect_page("operative","zoomeetingslist",array());					
					}
				}
			break;
			case "DELETE":
				if($news_id>0){
					$this->SqlModel->updateRecord(prefix."`tbl_zoomeeting",array("isDelete"=>0),array("news_id"=>$news_id));
					set_message("success","You have successfully deleted news details");
				}else{
					set_message("warning","Failed , unable to delete news");
				}
				redirect_page("operative","zoomeetingslist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_zoomeeting WHERE news_id='$news_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/zoomeetings',$data);	
	}
	
	public function zoomeetingslist(){
		$this->load->view(ADMIN_FOLDER.'/operative/zoomeetingslist',$data);	
	}
		
	public function blank(){
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
		$this->load->view(ADMIN_FOLDER.'/operative/blank',$data);
	}
	
	public function emptypage(){
		$this->load->view(ADMIN_FOLDER.'/operative/emptypage',$data);
	}
	
	
	public function configuration(){
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$model = new OperationModel();
		if($form_data['configSetting']==1 && $this->input->post()!=''){
			$CONFIG_COMPANY_NAME = FCrtRplc($form_data['CONFIG_COMPANY_NAME']);
			$CONFIG_WEBSITE = FCrtRplc($form_data['CONFIG_WEBSITE']);
			$CONFIG_TDS = FCrtRplc($form_data['CONFIG_TDS']);
			$CONFIG_SERVICE = FCrtRplc($form_data['CONFIG_SERVICE']);
			$CONFIG_MEM_LOGIN_STS = FCrtRplc($form_data['CONFIG_MEM_LOGIN_STS']);
			$CONFIG_SMS_STS = FCrtRplc($form_data['CONFIG_SMS_STS']);
			$model->setConfig("CONFIG_COMPANY_NAME",$CONFIG_COMPANY_NAME);
			$model->setConfig("CONFIG_WEBSITE",$CONFIG_WEBSITE);
			$model->setConfig("CONFIG_TDS",$CONFIG_TDS);
			$model->setConfig("CONFIG_SERVICE",$CONFIG_SERVICE);
			$model->setConfig("CONFIG_MEM_LOGIN_STS",getSwitch($CONFIG_MEM_LOGIN_STS));
			$model->setConfig("CONFIG_SMS_STS",getSwitch($CONFIG_SMS_STS));
			set_message("success","You have successfully updated a configuration setting");
			redirect_page("operative","configuration",array());
		}
		$this->load->view(ADMIN_FOLDER.'/operative/configuration',$data);
	}
	
	public function pagesadd(){
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$ptype_id = ($form_data['ptype_id'])? $form_data['ptype_id']:$segment['ptype_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitMenu']==1 && $this->input->post()!=''){
					$icon_id = FCrtRplc($form_data['icon_id']);
					$type_name = FCrtRplc($form_data['type_name']);
					$order_id = FCrtRplc($form_data['order_id']);
					$fldiCount = SelectTableWithOption("tbl_sys_menu_main","COUNT(*)","ptype_id='$ptype_id'");
					if($fldiCount>0){
						UpdateTable("tbl_sys_menu_main","type_name='$type_name', icon_id='$icon_id', order_id='$order_id'",
						"ptype_id='$ptype_id'");
						set_message("success","You have successfully updated a record");
						redirect_page("operative","pagesadd",array("ptype_id"=>$ptype_id,"action_request"=>"EDIT"));
					}else{
						$ptype_id = InsertTable("tbl_sys_menu_main","type_name='$type_name', icon_id='$icon_id', order_id='$order_id'");	
						set_message("success","You have successfully added a record");
						redirect_page("operative","pagestype",array());					
					}
					
					
				}
			break;
			case "DELETE":
				$fldiCount = SelectTableWithOption("tbl_sys_menu_sub","COUNT(*)","ptype_id='$ptype_id'");
				if($fldiCount==0){
					DeleteTableRow("tbl_sys_menu_main","ptype_id='$ptype_id'");
					set_message("success","You have successfully deleted record");
				}else{
					set_message("warning","Can't delete, menu asigned to submenus");
				}
				redirect_page("operative","pagestype",array()); exit;
			break;
			case "POSITION":
				$order_id = $form_data['order_id'];
				$ptype_id = $form_data['ptype_id'];
				foreach($ptype_id as $Key => $Val){
					$StrQ_Updt = "UPDATE ".prefix."tbl_sys_menu_main SET order_id='".$form_data['order_id'][$Key]."' WHERE 
					ptype_id='".$form_data['ptype_id'][$Key]."'";
					$this->db->query($StrQ_Updt);
				}
				set_message("success","You have successfully updated display order");
				redirect_page("operative","pagestype",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_sys_menu_main WHERE ptype_id='$ptype_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/pagesadd',$data);	
	}
	
	public function pagestype(){
		$this->load->view(ADMIN_FOLDER.'/operative/pagestype',$data);	
	}
	
	public function submenuadd(){
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$page_id = ($form_data['page_id'])? $form_data['page_id']:$segment['page_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitMenu']==1 && $this->input->post()!=''){
					$ptype_id = FCrtRplc($form_data['ptype_id']);
					$page_title = FCrtRplc($form_data['page_title']);
					$page_name = FCrtRplc($form_data['page_name']);
					$order_id = FCrtRplc($form_data['order_id']);
					
					$fldiCount = SelectTableWithOption("tbl_sys_menu_sub","COUNT(*)","page_id='$page_id'");
					if($fldiCount>0){
						UpdateTable("tbl_sys_menu_sub","ptype_id='$ptype_id', page_title='$page_title', page_name='$page_name', order_id='$order_id'",
						"page_id='$page_id'");
						set_message("success","You have successfully updated a record");
						redirect_page("operative","submenuadd",array("page_id"=>$page_id,"action_request"=>"EDIT"));					
					}else{
						$page_id = InsertTable("tbl_sys_menu_sub","ptype_id='$ptype_id', page_title='$page_title', page_name='$page_name', 
						order_id='$order_id'");	
						set_message("success","You have successfully added a record");
						redirect_page("operative","subpage",array());					
					}
				}
			break;
			case "DELETE":
				$fldiCount = SelectTableWithOption("tbl_sys_menu_acs","COUNT(*)","page_id='$page_id'");
				if($fldiCount){
					DeleteTableRow("tbl_sys_menu_sub","page_id='$page_id'");
					set_message("success","You have successfully deleted record");
				}else{
					set_message("warning","Can't delete, menu asigned to users");
				}
				redirect_page("operative","subpage",array()); exit;
			break;
			case "POSITION":
				$order_id = $form_data['order_id'];
				$page_id = $form_data['page_id'];
				foreach($page_id as $Key => $Val){
					$QR_UP = "UPDATE ".prefix."tbl_sys_menu_sub SET order_id='".$form_data['order_id'][$Key]."' WHERE 
					page_id='".$form_data['page_id'][$Key]."'";
					$this->db->query($QR_UP);
				}
				set_message("success","You have successfully updated display order");
				redirect_page("operative","subpage",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_sys_menu_sub WHERE page_id='$page_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/submenuadd',$data);	
	}
	
	public function subpage(){
		$this->load->view(ADMIN_FOLDER.'/operative/subpage',$data);	
	}
	
	
	public function cityadd(){
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$city_id = ($form_data['city_id'])? $form_data['city_id']:$segment['city_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitMenu']==1 && $this->input->post()!=''){
					$city_id = FCrtRplc($form_data['city_id']);
					$country_code = FCrtRplc($form_data['country_code']);
					$city_name = FCrtRplc($form_data['city_name']);
					$state_name = FCrtRplc($form_data['state_name']);
					
					$data = array("city_name"=>$city_name,
						"state_name"=>$state_name,
						"country_code"=>$country_code,
					);
					
					$fldiCount = SelectTableWithOption("tbl_city","COUNT(*)","city_id='$city_id'");
					if($fldiCount>0){
						$this->SqlModel->updateRecord(prefix."tbl_city",$data,array("city_id"=>$city_id));
						set_message("success","You have successfully updated a city details");
						redirect_page("operative","cityadd",array("city_id"=>$city_id,"action_request"=>"EDIT"));							
					}else{
						$this->SqlModel->insertRecord(prefix."tbl_city",$data,array("city_id"=>$city_id));
						set_message("success","You have successfully added a city");
						redirect_page("operative","citylist",array());					
					}
				}
			break;
			case "DELETE":
				if($city_id>0){
					$data = array("isDelete"=>0);
					$this->SqlModel->updateRecord(prefix."tbl_city",$data,array("city_id"=>$city_id));
					set_message("success","You have successfully deleted a city");
				}else{
					set_message("warning","Unable to delete city, please try again");
				}
				redirect_page("operative","citylist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_city WHERE city_id='$city_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/cityadd',$data);	
	}
	
	public function citylist(){
		$this->load->view(ADMIN_FOLDER.'/operative/citylist',$data);	
	}
	
	public function systempermission(){
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		if($form_data['submitForm']==1 && $this->input->post()!=''){
			$group_id = FCrtRplc($form_data['group_id']);
			$StrQ_Dlt = "DELETE FROM ".prefix."tbl_sys_menu_acs WHERE group_id='$group_id' AND page_id NOT IN(1,2);";
			$this->db->query($StrQ_Dlt);
			foreach($form_data['fldvTList'] as $Key => $Value){
				$StrPart .= "('$group_id','$Value'), ";
			}
			if($StrPart!=""){
				$StrPart = StripString($StrPart, ", ");
				$StrQ_Insert = "INSERT INTO ".prefix."tbl_sys_menu_acs(group_id, page_id) VALUES $StrPart;";
				$this->db->query($StrQ_Insert);
				set_message("success","Access Permission for the selected group has been updated.");
			}else{
				set_message("warning"," Unable to allow permission for selected group.");
			}
			redirect_page("operative","systempermission",array()); exit;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/systempermission',$data);	
	}
	
	
	
	public function operatoradd(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$oprt_id = ($form_data['oprt_id'])? $form_data['oprt_id']:$segment['oprt_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitOperator']==1 && $this->input->post()!=''){
					$name = FCrtRplc($form_data['name']);
					$user_name = FCrtRplc($form_data['user_name']);
					$password = FCrtRplc($form_data['password']);
					$email_address = FCrtRplc($form_data['email_address']);
					$mobile = FCrtRplc($form_data['mobile']);
					$group_id = FCrtRplc($form_data['group_id']);
					$type = $model->getGroupType($group_id);
					$data = array(
				// 	    "group_id"=>$group_id,
				// 		"branch_id"=>($branch_id)? $branch_id:0,
						"name"=>$name,
						"company_name"=>null_val($company_name),
						"user_name"=>$user_name,
						"password"=>$password,
						"email_address"=>$email_address,
						"mobile"=>$mobile,
						"department"=>null_val($department),
						"last_log"=>getLocalTime(),
				// 		"type"=>($type)? $type:"OA",
				// 		"temp_id"=>"01"
					);
					if($model->checkCount(prefix."tbl_operator","oprt_id",$oprt_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_operator",$data,array("oprt_id"=>$oprt_id));
						set_message("success","You have successfully updated a operator details");
						redirect_page("operative","operatoradd",array("oprt_id"=>$oprt_id,"action_request"=>"EDIT"));					
					}else{
						if($model->checkUserExist($user_name)==0){
							$this->SqlModel->insertRecord(prefix."tbl_operator",$data);
							set_message("success","You have successfully added a operator detail");
						}else{
							set_message("warning","This username is already exist");
						}
						redirect_page("operative","operator",array());					
					}
				}
			break;
			case "DELETE":
				if($oprt_id>0){
					$model->deleteTable(prefix."tbl_operator",array("oprt_id"=>$oprt_id));
					set_message("success","You have successfully deleted operator");
				}else{
					set_message("warning","Failed , unable to delete operator");
				}
				redirect_page("operative","operator",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/operatoradd',$data);
	}
	
	public function operator(){
		$this->load->view(ADMIN_FOLDER.'/operative/operator',$data);	
	}
	
	
	public function cms(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$id_cms = ($form_data['id_cms'])? $form_data['id_cms']:$segment['id_cms'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitCMS']==1 && $this->input->post()!=''){
					$cms_title = FCrtRplc($form_data['cms_title']);
					$meta_title = FCrtRplc($form_data['meta_title']);
					$meta_description = FCrtRplc($form_data['meta_description']);
					$meta_keywords = FCrtRplc($form_data['meta_keywords']);
					$content = FCrtRplc($form_data['content']);
					$link_rewrite = FCrtRplc($form_data['link_rewrite']);
					$index = ($form_data['index']=="on")? 1:0;
					$active = ($form_data['active']=="on")? 1:0;
					$id_parent = FCrtRplc($form_data['id_parent']);
					$data = array("cms_title"=>$cms_title,
						"id_parent"=>$id_parent,
						"meta_title"=>$meta_title,
						"meta_description"=>$meta_description,
						"meta_keywords"=>$meta_keywords,
						"content"=>$content,
						"link_rewrite"=>$link_rewrite,
						"index"=>$index,
						"active"=>$active,
						"date_time"=>getLocalTime()
					);
					if($model->checkCount(prefix."tbl_cms","id_cms",$id_cms)>0){
						$this->SqlModel->updateRecord(prefix."tbl_cms",$data,array("id_cms"=>$id_cms));
						set_message("success","You have successfully updated a cms details");
						redirect_page("operative","cms",array("id_cms"=>$id_cms,"action_request"=>"EDIT"));					
					}else{
						$this->SqlModel->insertRecord(prefix."tbl_cms",$data);
						set_message("success","You have successfully added a cms detail");
						redirect_page("operative","cmslist",array());					
					}
				}
			break;
			case "DELETE":
				if($id_cms>0){
					$model->deleteTable(prefix."tbl_cms",array("id_cms"=>$id_cms));
					set_message("success","You have successfully deleted cms details");
				}else{
					set_message("warning","Failed , unable to delete cms");
				}
				redirect_page("operative","cmslist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_cms WHERE id_cms='$id_cms'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/cms',$data);	
	}
	
	public function cmslist(){
		$this->load->view(ADMIN_FOLDER.'/operative/cmslist',$data);	
	}
	
	
	public function oprtlog(){
		$this->load->view(ADMIN_FOLDER.'/operative/oprtlog',$data);	
	}
	
	public function template(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$option_id = ($form_data['option_id'])? $form_data['option_id']:$segment['option_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitTemplate']==1 && $this->input->post()!=''){
					$option_value = FCrtRplc($form_data['option_value']);
					$data = array("option_value"=>$option_value);
					if($model->checkCount(prefix."tbl_mail_template","option_id",$option_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_mail_template",$data,array("option_id"=>$option_id));
						set_message("success","You have successfully updated a mail template details");
						redirect_page("operative","template",array("option_id"=>$option_id,"action_request"=>"EDIT"));					
					}else{
						set_message("warning","Unable to update, please try  again");
						redirect_page("operative","mailtemplate",array());					
					}
				}
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_mail_template WHERE option_id='$option_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/template',$data);	
	}
	public function mailtemplate(){
		$this->load->view(ADMIN_FOLDER.'/operative/mailtemplate',$data);	
	}
	
	public function news(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$news_id = ($form_data['news_id'])? $form_data['news_id']:$segment['news_id'];
		switch($action_request){ 
			case "ADD_UPDATE":
				if($form_data['submitNEWS']==1 && $this->input->post()!=''){
					$news_title = FCrtRplc($form_data['news_title']);
					$news_detail = FCrtRplc($form_data['news_detail']);
					$news_date = InsertDate($form_data['news_date']);
					$news_sts = ($form_data['news_sts']=="on")? 1:0;
				
					
					
					
			
			
					
					
		  if($news_id > 0)
		  {  
		  $news_id = $form_data['news_id'];
		  
		  $AR_BAN = SelectTable("tbl_news","news_img","news_id='$news_id'");
		  $photo  = $AR_BAN['news_img']; 
		 if($_FILES['news_img']['error']=="0"){
		 
		 $ext = explode(".",$_FILES['news_img']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/news/".$photo;	
			   
				$final_location = $fldvPath."upload/news/".$AR_BAN['file'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }		
				move_uploaded_file($_FILES['news_img']['tmp_name'], $target_path);
		 }
		// $posted_data = array('news_img' => $photo);
		 
		 	$data = array("news_title"=>$news_title,
						"news_detail"=>$news_detail,
						
						"news_sts"=>$news_sts,
							"news_img"=>$photo
					);
				 
				 
				 
				 
		 
		 
		 
		 
		 
		$this->SqlModel->updateRecord(prefix."tbl_news",$data,array("news_id"=>$news_id));
	//	 set_message("success","Successfully updated Popup .");
				    redirect_page("operative","news",array()); 
		  }
		  else
		  {
	
		  if($_FILES['news_img']['error']=="0"){
		  
		  
		 
		  
				$ext = explode(".",$_FILES['news_img']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/news/".$photo;
			
					if(move_uploaded_file($_FILES['news_img']['tmp_name'], $target_path)){
				 $posted_data = array('news_img' => $photo);
				 
				 
				 	$data = array("news_title"=>$news_title,
						"news_detail"=>$news_detail,
						
						"news_sts"=>$news_sts,
							"news_img"=>$photo
					);
				 
				 
				 
				 
				 
				 
				 
				 
				 
				 
		         $this->SqlModel->insertRecord(prefix."tbl_news",$data);
						
					}
					set_message("success","Successfully added new Popup .");
				    redirect_page("operative","news",array()); 
			}
			else
			{
			set_message("warning","Please Select a Image File.");
			redirect_page("operative","newlist",array()); 
			}
				
		  }
					
					
					
					
					
					
					
					if($model->checkCount(prefix."tbl_news","news_id",$news_id)>0){
						$this->SqlModel->updateRecord(prefix."`tbl_news",$data,array("news_id"=>$news_id));
						set_message("success","You have successfully updated a news details");
						redirect_page("operative","newlist",array());					
					}
				}
			break;
			case "DELETE":
				if($news_id>0){
					$this->SqlModel->updateRecord(prefix."`tbl_news",array("isDelete"=>0),array("news_id"=>$news_id));
					set_message("success","You have successfully deleted news details");
				}else{
					set_message("warning","Failed , unable to delete news");
				}
				redirect_page("operative","newlist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_news WHERE news_id='$news_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/news',$data);	
	}
	
	public function newlist(){
		$this->load->view(ADMIN_FOLDER.'/operative/newlist',$data);	
	}
	
	
	public function ppt(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$ppt_id = (_d($form_data['ppt_id']))? _d($form_data['ppt_id']):_d($segment['ppt_id']);
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitPPT']==1 && $this->input->post()!=''){
					$ppt_name = FCrtRplc($form_data['ppt_name']);
					$ppt_country = FCrtRplc($form_data['ppt_country']);
					$ppt_lang = FCrtRplc($form_data['ppt_lang']);
					$ppt_status = ($form_data['ppt_status']=="on")? 1:0;
					
					$data = array("ppt_name"=>$ppt_name,
						"ppt_country"=>$ppt_country,
						"ppt_lang"=>$ppt_lang,
						"ppt_status"=>$ppt_status
					);
					if($model->checkCount(prefix."tbl_ppt","ppt_id",$ppt_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_ppt",$data,array("ppt_id"=>$ppt_id));
						$model->uploadPptFile($_FILES,array("ppt_id"=>$ppt_id),"");
						set_message("success","You have successfully updated a ppt details");
						redirect_page("operative","pptlist",array());					
					}else{
						$ppt_id = $this->SqlModel->insertRecord(prefix."tbl_ppt",$data);
						$model->uploadPptFile($_FILES,array("ppt_id"=>$ppt_id),"");
						set_message("success","You have successfully added a ppt detail");
						redirect_page("operative","pptlist",array());					
					}
				}
			break;
			case "DELETE":
				if($ppt_id>0){
					$this->SqlModel->updateRecord(prefix."tbl_ppt",array("ppt_delete"=>0),array("ppt_id"=>$ppt_id));
					$model->uploadPptFile($_FILES,array("ppt_id"=>$ppt_id),"");
					set_message("success","You have successfully deleted ppt details");
				}else{
					set_message("warning","Failed , unable to delete ppt");
				}
				redirect_page("operative","pptlist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_ppt WHERE ppt_id='$ppt_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/ppt',$data);	
	}
	public function pptlist(){
		$this->load->view(ADMIN_FOLDER.'/operative/pptlist',$data);	
	}
	
	
	
	
	public function event(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$event_id = ($form_data['event_id'])? _d($form_data['event_id']):_d($segment['event_id']);
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitNEWS']==1 && $this->input->post()!=''){
					$event_title = FCrtRplc($form_data['event_title']);
					$e_day = FCrtRplc($form_data['e_day']);
					$e_month = FCrtRplc($form_data['e_month']);
					$e_year = FCrtRplc($form_data['e_year']);
					
					$event_detail = ($form_data['event_detail']);
		
					$data = array("event_title"=>$event_title,
						"e_day"=>$e_day,
						"e_month"=>$e_month,
						"e_year"=>$e_year,
						"event_detail"=>$event_detail
					);
					if($model->checkCount(prefix."tbl_event","event_id",$event_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_event",$data,array("event_id"=>$event_id));
						set_message("success","You have successfully updated a event details");
						redirect_page("operative","eventlist",array());					
					}else{
						$this->SqlModel->insertRecord(prefix."tbl_event",$data);
						set_message("success","You have successfully added a event detail");
						redirect_page("operative","eventlist",array());					
					}
				}
			break;
			case "DELETE":
				if($news_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_event",array("event_id"=>$event_id));
					set_message("success","You have successfully deleted event details");
				}else{
					set_message("warning","Failed , unable to delete news");
				}
				redirect_page("operative","newlist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_event WHERE event_id='$event_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/operative/event',$data);	
	}
	
	public function eventlist(){
		$this->load->view(ADMIN_FOLDER.'/operative/eventlist',$data);	
	}
	
}
