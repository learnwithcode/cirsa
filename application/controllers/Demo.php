<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

    public function index()
    {
        $this->load->view('welcome_message');
    }

    public function sign()
    {
        $this->load->view('sign');
    }
 public function login()
    {
        $this->load->view('login');
    }

    public function loginuser(){
        SESSION_START();
        //$_SESSION['CAPTCHA_CODE'];
        $user_name_login = $this->input->get("user_name_login");
        $user_password_login = $this->input->get("user_password_login");
            $captcha = $this->input->get("captcha");
                $captcha1 = $this->input->get("captcha1");
//  $user_name_login =  mysql_real_escape_string($user_name_login);
//  $user_password_login =  mysql_real_escape_string($user_password_login);
         $model = new OperationModel();
    $active = $model->getValue("USER_LOGIN");
        if($active =='Y'){
          //   $img = new Securimage();
    //         $valid = $img->check($_GET["captcha_code"]);$valid == true
            if(true ) {
        $rank_id = $this->input->get("rank_id");
        if($user_name_login!='' && $user_password_login!=''){
            $user_name = $user_name_login;
            $user_password = $user_password_login;
            $page_name = "login";
            $log_sts = "F";
            $browser = getBrowser();
            $operate_system = $browser['name'];
            $web_browser = $browser['browser'];
            $browser_version = $browser['version'];
            $oprt_ip = FCrtRplc($_SERVER['REMOTE_ADDR']);
            $login_time = getLocalTime();
            $logout_time = getLocalTime();
            $AR_RT['ErrorDtl']="Invalid username & password";
            $AR_RT['ErrorMsg']="invalid";
            if($user_name!='' && $user_password!=''){
            $user_name = FCrtRplc($user_name);
            $user_password  = FCrtRplc($user_password);
                #$StrWhr .= ($rank_id>0)? " AND rank_id>0":" AND rank_id=0";
         
       
         
            $AR_RT['ErrorType']="software";
            $sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_members 
                WHERE ( user_name='".$user_name."' OR user_id = '".$user_name."' OR member_email ='".$user_name."' )  AND user_password='".$user_password."'  $StrWhr ");  
        
                $fetchRow = $sel_query->row_array();
                if($fetchRow['member_id']>0){
                    if($captcha==$captcha1){
                        if($fetchRow['block_sts'] =='N'){
                    //  if(true) {
                          if($fetchRow['emailverify']  =='Y') {
                 
                    set_message("success","Welcome to member pabel of ".WEBSITE."");
                    $this->session->set_userdata('mem_id',$fetchRow['member_id']);
                    $this->session->set_userdata('user_id',$fetchRow['user_name']);
                    $this->session->set_userdata('last_log',$fetchRow['last_login']);
                    
                    $this->session->unset_userdata('fldcType');
                    $this->session->unset_userdata('fldvMessage');
                    
                    $log_sts = "S";
                    $page_name = "dashboard";
                    
                    $member_id = $fetchRow['member_id'];
                    $post_data = array("member_id"=>($member_id>0)? $member_id:0,
                        "user_name"=>$user_name,
                        "user_password"=>$user_password,
                        "member_ip"=>$_SERVER['REMOTE_ADDR'],
                        "operate_system"=>$operate_system,
                        "browser"=>$web_browser,
                        "browser_version"=>$browser_version,
                        "log_sts"=>$log_sts,
                        "login_time"=>$login_time,
                        "logout_time"=>$logout_time
                    );
                    $login_id = $this->SqlModel->insertRecord(prefix."tbl_mem_logs",$post_data);
                    $this->session->set_userdata('login_id',$login_id);
                    $AR_RT['ErrorDtl']="You Have Successfully Log-in";
                    $AR_RT['ErrorMsg']="success";
                
                            } else{
                                $AR_RT['ErrorDtl']="Please Verify Your Email First";
                //  $AR_RT['ErrorDtl']="Please Verify Your Email ! <a href='javascript:void(0)' onclick='resendMails(`"._e($user_name)."`)' >click to resend... </a>";
                    $AR_RT['ErrorMsg']="invalid";
                }   
      
            
                } else{
                    $AR_RT['ErrorDtl']="Your Id has been blocked !";
                    $AR_RT['ErrorMsg']="invalid";
                }   
      }else{
                    $AR_RT['ErrorDtl']="You Have Entered Wrong Capcha Code";
                    $AR_RT['ErrorMsg']="invalid";
                }
                }else{
                    $AR_RT['ErrorDtl']="Invalid username & password ";
                    $AR_RT['ErrorMsg']="invalid";
                }
            }else{
                $AR_RT['ErrorDtl']="Invalid username & password ";
                $AR_RT['ErrorMsg']="invalid";
            }
        }else{
            $AR_RT['ErrorDtl']="Invalid username & passworsssd ";
            $AR_RT['ErrorMsg']="invalid";
        }
    
            
           
    
            
            }else{
                $AR_RT['ErrorDtl']="Invalid security code, please try again";
                $AR_RT['ErrorMsg']="invalid"; 
            
            }
        }
        else
        {
            $AR_RT['ErrorDtl']="System upgrading Now Please try after 1 Hours!";
            $AR_RT['ErrorMsg']="invalid"; 
        }
        echo json_encode($AR_RT);
    }
}
