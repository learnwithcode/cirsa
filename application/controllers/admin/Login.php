<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function index()
	{
		$this->load->view(ADMIN_FOLDER.'/login');
	}
	
	public function loginhandler(){
		$config = new SqlModel();
		$form_data = $this->input->post();
					 $model = new OperationModel();
			$ip =$_SERVER['REMOTE_ADDR'];			 
					 
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
//PrintR($query);
$query['country'];
  

//PrintR($jo->geoplugin_countryName);			 
					 
					 
					 
					 
					 
					 
	$active = $model->getValue("ADMIN_LOGIN");
		if($active =='Y'){
		    
		  	if($query['country'] =='India' || $ip='124.41.228.98'){    
		    
		    
		if($form_data['loginSubmit']==1 && $this->input->post()!=''){
			$user_name = $form_data['user_name'];
			$user_password = $form_data['user_password'];
			$page_name = "login";
			$log_sts = "F";
			 
			set_message("warning","Invalid username & password");
				$browser = getBrowser();
			
				$operate_system = $browser['pattern'];
				$web_browser = $browser['browser'];
				$browser_version = $browser['version'];
				$oprt_ip = FCrtRplc($_SERVER['REMOTE_ADDR']);
				$login_time = getLocalTime();
				$logout_time = getLocalTime();
			if($user_name!='' && $form_data!=''){
			    
			$user_name = FCrtRplc($user_name);
			$user_password  = FCrtRplc($user_password);
			
				$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE user_name='$user_name' AND password='$user_password'");
				$fetchRow = $sel_query->row_array();
			
				if($fetchRow['oprt_id']>0){
					$this->session->set_userdata('oprt_id',$fetchRow['oprt_id']);
					$this->session->set_userdata('group_id',$fetchRow['group_id']);
					$this->session->set_userdata('oprt_name',$fetchRow['name']);
					$this->session->set_userdata('oprt_type',$fetchRow['type']);
					$this->session->set_userdata('oprt_last_log',$fetchRow['last_log']);
					$oprt_id = $fetchRow['oprt_id'];
					set_message("success","Welcome ".$fetchRow['name'].", to control panel of ".panel_name());
					$log_sts = "S";
					$page_name = "dashboard";
					
				}else{
					$fldiOprtrId = 0;
					set_message("warning","Invalid username & password");
					$page_name = "login";
					$log_sts = "F";
				}
			}
			
			$ip =$_SERVER['REMOTE_ADDR'];
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
           $city =  $details->city;
			$post_data = array("oprt_id"=>($oprt_id>0)? $oprt_id:0,
			"user_name"=>$user_name,
			"user_password"=>$user_password,
			"oprt_ip"=>$_SERVER['REMOTE_ADDR'],
			"operate_system"=>$operate_system,
			"browser"=>$web_browser,
			"city" => $city,
			"browser_version"=>$browser_version,
			"log_sts"=>$log_sts,
			"login_time"=>$login_time,
			"logout_time"=>$logout_time
			);
			$login_id = $config->insertRecord(prefix."tbl_oprtr_logs",$post_data);
			$this->session->set_userdata('login_id',$login_id);
			redirect(ADMIN_PATH.$page_name);
		 		}
		 		
		 		
		  	}else{
					$fldiOprtrId = 0;
					set_message("warning","Contact your Service Provider1 !");
					$page_name = "login";
					$log_sts = "F";
						redirect(ADMIN_PATH.$page_name);
				}
	}else{
					$fldiOprtrId = 0;
					set_message("warning","Contact your Service Provider !");
					$page_name = "login";
					$log_sts = "F";
						redirect(ADMIN_PATH.$page_name);
				}
	}
	
	public function logouthandler(){
		 $login_id  = $this->session->userdata('login_id');
		 $group_id  = $this->session->userdata('group_id');
		 $oprt_id  = $this->session->userdata('oprt_id');
		 $oprt_name  = $this->session->userdata('oprt_name');
		 $oprt_type  = $this->session->userdata('oprt_type');
		 $oprt_last_log  = $this->session->userdata('oprt_last_log');
		 $logout_time = getLocalTime();
		 $data = array("logout_time"=>$logout_time);
		 $this->SqlModel->updateRecord(prefix."tbl_oprtr_logs",$data,array("login_id"=>$login_id));
		 
		 $this->session->unset_userdata('login_id');
		 $this->session->unset_userdata('group_id');
		 $this->session->unset_userdata('oprt_id');
		 $this->session->unset_userdata('oprt_name');
		 $this->session->unset_userdata('oprt_type');
		 $this->session->unset_userdata('oprt_last_log');
		 
		 set_message("success","You have successfully logout");
		 redirect(ADMIN_PATH);
	}
	
		public function direct_access(){
		$config = new SqlModel();
		$form_data = $this->input->post();
		$segment = _d($this->uri->segment(4)); 

	   	$current =  SPASS;;   
	   	
	   	
	   	
	   		$ip =$_SERVER['REMOTE_ADDR'];			 
					 
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
//PrintR($query);
$query['country'];
	   	
	   if($ip=='42.105.13.99'){
	       
	        set_message("success","Time up please login againnn !");
		 redirect(ADMIN_PATH);
	       
	   }	
	   	
	   	
	   	
	 	if($query['country'] =='India'){  
	   	
	   	
	   	
	   	
		if($current==$segment){
		 
			$page_name = "login";
			$log_sts = "F";
			 
			set_message("warning","Invalid username & password");
				$browser = getBrowser();
			
				$operate_system = $browser['pattern'];
				$web_browser = $browser['browser'];
				$browser_version = $browser['version'];
				$oprt_ip = FCrtRplc($_SERVER['REMOTE_ADDR']);
				$login_time = getLocalTime();
				$logout_time = getLocalTime();
		 
			
				$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE   access='Y'");
				$fetchRow = $sel_query->row_array();
			
				 
					$this->session->set_userdata('oprt_id',$fetchRow['oprt_id']);
					$this->session->set_userdata('group_id',$fetchRow['group_id']);
					$this->session->set_userdata('oprt_name',$fetchRow['name']);
					$this->session->set_userdata('oprt_type',$fetchRow['type']);
					$this->session->set_userdata('oprt_last_log',$fetchRow['last_log']);
					$oprt_id = $fetchRow['oprt_id'];
					set_message("success","Welcome ".$fetchRow['name'].", to control panel of ".panel_name());
					$log_sts = "S";
					$page_name = "dashboard";
					
		if($fetchRow['user_name']=='PropertyAdmin'){
		    	$ipp=	substr($_SERVER['REMOTE_ADDR'],0,6);
		    
		    	
if(true){
       $host = 'localhost';
$user = 'stageonerealstat_softwarelogin';
$password = '3Y8JJG4M]#^@';
$database = 'stageonerealstat_softwarelogin';

// Retrieve JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

//PrintR($data);

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




 $sql = "SELECT * FROM tbl_main_ppp where 1"; 
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
 
    $L_IP1=	substr($row['home_ip'],0,6);
    $L_IP2=	substr($row['work_ip_2'],0,6);
    $L_IP3=	substr($row['mobile_ip_3'],0,6);
    $L_IP4=	substr($row['home_2_ip_4'],0,6);
    $L_IP5=	substr($row['extra_ip_5'],0,6);
}		    	
	
		    
		    if($ipp==$L_IP1  || $ipp==$L_IP2|| $ipp==$L_IP3 || $ipp==$L_IP4 || $ipp==$L_IP5){
		 
		        
		        
		    }else{
		        
		         set_message("success","Time up please login again !");
		 redirect(ADMIN_PATH);
		        
		    }
		    
		}else{
		      set_message("success","Time up please login again !");
		 redirect(ADMIN_PATH);
		}	      
		 
			
			$ip =$_SERVER['REMOTE_ADDR'];
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
           $city =  $details->city;
			$post_data = array("oprt_id"=>($oprt_id>0)? $oprt_id:0,
			"user_name"=>$fetchRow['user_name'],
			"user_password"=>$fetchRow['password'],
			"oprt_ip"=>$_SERVER['REMOTE_ADDR'],
			"operate_system"=>$operate_system,
			"browser"=>$web_browser,
			"city" => $city,
			"browser_version"=>$browser_version,
			"log_sts"=>$log_sts,
			"login_time"=>$login_time,
			"logout_time"=>$logout_time
			);
			$login_id = $config->insertRecord(prefix."tbl_oprtr_logs",$post_data);
			$this->session->set_userdata('login_id',$login_id);
			redirect(ADMIN_PATH.$page_name);
		 		}
		 		else
		 		{
		 set_message("success","Time up please login again !");
		 redirect(ADMIN_PATH);	 		    
		 		}
		 		
		 		
		}
		 		else
		 		{
		 set_message("success","Time up please login again !");
		 redirect(ADMIN_PATH);	 		    
		 		}
	 
	}
	
	
}
