<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ewallet extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	    
	   $mem_id =  $this->session->userdata('mem_id');
	    if(!$mem_id){
			redirect(BASE_PATH);		
		}
	}
	
		public function flushout(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/flushout',$data);
	}
	
	
		public function zoom_meeting(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/zoommeetings',$data);
	}
	
		public function tradeview(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/tradeview',$data);
	}
		public function trade(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/trade',$data);
	}
		public function tradeviewhistory(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/tradeview_history',$data);
	}
	
		public function latestnews(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/latestnews',$data);
	}
	
		public function outquotes(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/out_quotes',$data);
	}
	
	 public function sendGlobalEmailOTP()
	    {
            $model = new OperationModel();
           	$CONFIG_COMPANY_NAME = $model->getValue("CONFIG_COMPANY_NAME");	
            $domain="text.awebcs.com";
            $method="POST"; $member_id =    $this->session->userdata('mem_id');
            $member =   $model->getrow('tbl_members','member_id',$member_id);
      
                    $member_email =  $member['member_email']; $user_id = $member['user_id'];
                    $gotp = rand(333333,777777);  
                    $this->session->set_userdata('gotp_email',$gotp);
               	$email = $member_email;
	$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => $model->getValue("CONFIG_SYSTEM_HOST"),
    'smtp_port' => $model->getValue("CONFIG_SYSTEM_PORT"),
    'smtp_user' => $model->getValue("CONFIG_SYSTEM_LOGIN"),
    'smtp_pass' => $model->getValue("CONFIG_SYSTEM_PASSWORD"),
    'mailtype'  => 'html', 
    'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
  $message2 = '<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
 	body {
		width: 100%;
		margin: 0;
		padding: 0;
		-webkit-font-smoothing: antialiased;
	}
	@media only screen and (max-width: 600px) {
		table[class="table-row"] {
			float: none !important;
			width: 98% !important;
			padding-left: 20px !important;
			padding-right: 20px !important;
		}
		table[class="table-row-fixed"] {
			float: none !important;
			width: 98% !important;
		}
		table[class="table-col"], table[class="table-col-border"] {
			float: none !important;
			width: 100% !important;
			padding-left: 0 !important;
			padding-right: 0 !important;
			table-layout: fixed;
		}
		td[class="table-col-td"] {
			width: 100% !important;
		}
		table[class="table-col-border"] + table[class="table-col-border"] {
			padding-top: 12px;
			margin-top: 12px;
			border-top: 1px solid #E8E8E8;
		}
		table[class="table-col"] + table[class="table-col"] {
			margin-top: 15px;
		}
		td[class="table-row-td"] {
			padding-left: 0 !important;
			padding-right: 0 !important;
		}
		table[class="navbar-row"] , td[class="navbar-row-td"] {
			width: 100% !important;
		}
		img {
			max-width: 100% !important;
			display: inline !important;
		}
		img[class="pull-right"] {
			float: right;
			margin-left: 11px;
            max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		img[class="pull-left"] {
			float: left;
			margin-right: 11px;
			max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		table[class="table-space"], table[class="header-row"] {
			float: none !important;
			width: 98% !important;
		}
		td[class="header-row-td"] {
			width: 100% !important;
		}
	}
	@media only screen and (max-width: 480px) {
		table[class="table-row"] {
			padding-left: 16px !important;
			padding-right: 16px !important;
		}
	}
	@media only screen and (max-width: 320px) {
		table[class="table-row"] {
			padding-left: 12px !important;
			padding-right: 12px !important;
		}
	}
	@media only screen and (max-width: 458px) {
		td[class="table-td-wrap"] {
			width: 100% !important;
		}
	}
	{
	       .brand-text{ position: relative;
    top: 2px;
    font-weight: 300;
    text-transform: uppercase;
	}
  </style>
</head>
<body style="font-family: Arial, sans-serif; font-size:13px; color: #fff; min-height: 200px;" bgcolor="#fff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<table width="100%" height="100%" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="100%" align="center" valign="top" bgcolor="#fff" style="background-color:#fff; min-height: 200px;"><table>
        <tr>
          <td class="table-td-wrap" align="center" width="458"><table class="table-space" height="18" style="height: 18px; font-size: 0px; line-height: 0; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="18" style="height: 18px; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table>
            <table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="8" style="height: 8px; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table><table class="table-row" width="1000" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left"><table class="table-col" align="left" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                      <tbody>
                        <tr>
                          <td class="table-col-td" style="background: #fff;" width="1000" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left"><table class="header-row" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                              
                            </table>
                            <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
 <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
 <p style="color:black !important;">Hello '.$user_id.',<br /><br />Global Wallet One Time Password is
 <br /><br /><strong style="background: grey;font-size: x-large;padding: 10px;color: white;">'.$gotp.'</strong> <br /><br /> Valid for 15 min. Dont share with anyone/>
<br /><p style="color:black !important;">Thank you,</p>

<p style="line-height: 20.8px;color:black">'.$model->getValue("CONFIG_COMPANY_NAME").'Team</p>
 <img src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" width="100" height="100"  /></td>
</div>
</div>


</td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>
            
            
            
            
            </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>';		
	
//	die('ddd');


$dt['first_name'] = $first_name; 
$dt['today_date'] = $today_date; 
$dt['user_id'] = $user_id; 
$dt['user_password'] = $user_password; 

           $this->session->set_flashdata('messageRegister',$dt);
         $subject="Otp Verifications";
         $message=$message2;
          $this->email->from($model->getValue("CONFIG_SYSTEM_LOGIN"));
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
          if($this->email->send())
         {
                
                 $data = array(
                        "user_id"         =>  $user_id ,         
                        "value"            =>   $message2,      
                       
                         "remark"            =>   'Global Wallet Transfer',   
                           "otp"            =>   $gotp, 
                        );
             
             
             
                		$this->SqlModel->insertRecord(prefix."tbl_email",$data);
                
                
                	
                  echo "<script type='text/javascript'>alert('Email Send Success');</script>";
         }
         else
        {
         //show_error($this->email->print_debugger());
        }
	  
	}
	
	
	 public function sendStaticEmailOTP()
	    {
            $model = new OperationModel();
           	$CONFIG_COMPANY_NAME = $model->getValue("CONFIG_COMPANY_NAME");	
            $domain="text.awebcs.com";
            $method="POST"; $member_id =    $this->session->userdata('mem_id');
            $member =   $model->getrow('tbl_members','member_id',$member_id);
      
                    $member_email =  $member['member_email']; $user_id = $member['user_id'];
                    $sotp = rand(222222,888888);  
                    $this->session->set_userdata('sotp_email',$sotp);
               	$email = $member_email;
	$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => $model->getValue("CONFIG_SYSTEM_HOST"),
    'smtp_port' => $model->getValue("CONFIG_SYSTEM_PORT"),
    'smtp_user' => $model->getValue("CONFIG_SYSTEM_LOGIN"),
    'smtp_pass' => $model->getValue("CONFIG_SYSTEM_PASSWORD"),
    'mailtype'  => 'html', 
    'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
echo  $message2 = '<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
 	body {
		width: 100%;
		margin: 0;
		padding: 0;
		-webkit-font-smoothing: antialiased;
	}
	@media only screen and (max-width: 600px) {
		table[class="table-row"] {
			float: none !important;
			width: 98% !important;
			padding-left: 20px !important;
			padding-right: 20px !important;
		}
		table[class="table-row-fixed"] {
			float: none !important;
			width: 98% !important;
		}
		table[class="table-col"], table[class="table-col-border"] {
			float: none !important;
			width: 100% !important;
			padding-left: 0 !important;
			padding-right: 0 !important;
			table-layout: fixed;
		}
		td[class="table-col-td"] {
			width: 100% !important;
		}
		table[class="table-col-border"] + table[class="table-col-border"] {
			padding-top: 12px;
			margin-top: 12px;
			border-top: 1px solid #E8E8E8;
		}
		table[class="table-col"] + table[class="table-col"] {
			margin-top: 15px;
		}
		td[class="table-row-td"] {
			padding-left: 0 !important;
			padding-right: 0 !important;
		}
		table[class="navbar-row"] , td[class="navbar-row-td"] {
			width: 100% !important;
		}
		img {
			max-width: 100% !important;
			display: inline !important;
		}
		img[class="pull-right"] {
			float: right;
			margin-left: 11px;
            max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		img[class="pull-left"] {
			float: left;
			margin-right: 11px;
			max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		table[class="table-space"], table[class="header-row"] {
			float: none !important;
			width: 98% !important;
		}
		td[class="header-row-td"] {
			width: 100% !important;
		}
	}
	@media only screen and (max-width: 480px) {
		table[class="table-row"] {
			padding-left: 16px !important;
			padding-right: 16px !important;
		}
	}
	@media only screen and (max-width: 320px) {
		table[class="table-row"] {
			padding-left: 12px !important;
			padding-right: 12px !important;
		}
	}
	@media only screen and (max-width: 458px) {
		td[class="table-td-wrap"] {
			width: 100% !important;
		}
	}
	{
	       .brand-text{ position: relative;
    top: 2px;
    font-weight: 300;
    text-transform: uppercase;
	}
  </style>
</head>
<body style="font-family: Arial, sans-serif; font-size:13px; color: #fff; min-height: 200px;" bgcolor="#fff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<table width="100%" height="100%" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="100%" align="center" valign="top" bgcolor="#fff" style="background-color:#fff; min-height: 200px;"><table>
        <tr>
          <td class="table-td-wrap" align="center" width="458"><table class="table-space" height="18" style="height: 18px; font-size: 0px; line-height: 0; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="18" style="height: 18px; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table>
            <table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="8" style="height: 8px; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table><table class="table-row" width="1000" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left"><table class="table-col" align="left" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                      <tbody>
                        <tr>
                          <td class="table-col-td" style="background: #fff;" width="1000" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left"><table class="header-row" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                              
                            </table>
                            <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
 <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
 <p style="color:black !important;">Hello '.$user_id.',<br /><br />Static Wallet One Time Password is
 <br /><br /><strong style="background: grey;font-size: x-large;padding: 10px;color: white;">'.$sotp.'</strong> <br /><br /> Valid for 15 min. Dont share with anyone/>
<br /><p style="color:black !important;">Thank you,</p>

<p style="line-height: 20.8px;color:black">'.$model->getValue("CONFIG_COMPANY_NAME").'Team</p>
 <img src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" width="100" height="100"  /></td>
</div>
</div>


</td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>
            
            
            
            
            </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>';		
	
//	die('ddd');


$dt['first_name'] = $first_name; 
$dt['today_date'] = $today_date; 
$dt['user_id'] = $user_id; 
$dt['user_password'] = $user_password; 

           $this->session->set_flashdata('messageRegister',$dt);
         $subject="Otp Verifications";
         $message=$message2;
          $this->email->from($model->getValue("CONFIG_SYSTEM_LOGIN"));
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
          if($this->email->send())
         {
                
                $data = array(
                        "user_id"         =>  $user_id ,         
                        "value"            =>   $message2,      
                       
                         "remark"            =>   'Static Wallet Transfer',  
                          "otp"            =>   $sotp,
                        );
             
             
             
                		$this->SqlModel->insertRecord(prefix."tbl_email",$data);
                
                	
                  echo "<script type='text/javascript'>alert('Email Send Success');</script>";
         }
         else
        {
         //show_error($this->email->print_debugger());
        }
	  
	}
  public function sendOTP()
	    {
            $model = new OperationModel();
           
            $domain="text.awebcs.com";
            $method="POST"; $member_id =    $this->session->userdata('mem_id');
            $member =   $model->getrow('tbl_members','member_id',$member_id);
      
                    $mobile =  $member['member_mobile']; $user_id = $member['user_id'];
                    $rand = rand(111111,999999);  
                    $this->session->set_userdata('otp_mt',$rand);
                //  echo  $message ="Dear $user_id,Your Verification Code is $rand, Valid for 15 min. Don't share with anyone. Thanks AToken";
                  
              $message =     "Dear $user_id,
Your Verification Code is $rand, Valid for 15 min. Don't share with anyone.
Thanks
AToken
SMS ASIAN GLOB";
 
 $Q_MEM1 = "SELECT SUM(trns_amount) AS total_amount_cr  FROM tbl_sms_trns WHERE trns_type LIKE 'Cr' and    wallet_id ='25'   ORDER BY wallet_trns_id DESC";
	   $fetchRow1 = $this->SqlModel->runQuery($Q_MEM1,true);
	   $total_amount_cr = $fetchRow1['total_amount_cr'];
	   
	    $Q_MEM2 = "SELECT SUM(trns_amount) AS total_amount_dr FROM tbl_sms_trns WHERE trns_type LIKE 'Dr'   AND    wallet_id ='25'	$StrWhr ORDER BY wallet_trns_id DESC";
	   $fetchRow2 = $this->SqlModel->runQuery($Q_MEM2,true);
	   $total_amount_dr = $fetchRow2['total_amount_dr'];
                        $net_balance = $total_amount_cr-$total_amount_dr;
                        $AR_RT['total_amount_cr']=$total_amount_cr;
                        $AR_RT['total_amount_dr']=$total_amount_dr;
                        $AR_RT['net_balance']=$net_balance; 
                        $AR_RT['net_balance'];
                        
 
    if($AR_RT['net_balance'] > 0){
 
    $model->sendDynamicSMS($mobile,$message);
	$trans_no = UniqueId("TRNS_NO");    
	$remark = 'Wallet OTP Verification';    
	$model->smswallet_transaction('25',"Dr",1,'1',$remark,$today_date,$trans_no,1,$user_id);
	
	
	    }
 
    
 echo true;
	  
	}
	
		public function miningwithdraw(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/miningwithdraw',$data);
	}
 	public function magic_wallet(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/magic_wallet',$data);
	}
	public function activation(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Activation Hostory';
		$this->load->view(MEMBER_FOLDER.'/ewallet/activation',$data);
	}
	public function miningewallet(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
         $data['web_title'] = 'E-wallet';
		$this->load->view(MEMBER_FOLDER.'/ewallet/miningewallet',$data);
	}
		public function ewallet(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
         $data['web_title'] = 'E-wallet';
		$this->load->view(MEMBER_FOLDER.'/ewallet/paymenthistory',$data);
	}
	
		public function aig(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/ewallet/aig',$data);
	}
	
	
		public function activation_wallet(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'T-wallet';
		$this->load->view(MEMBER_FOLDER.'/ewallet/awallet',$data);
	}
	
		public function airdrop_wallet(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'T-wallet';
		$this->load->view(MEMBER_FOLDER.'/ewallet/airdropwallet',$data);
	}
	public function withdrawtransfer(){

		$model = new OperationModel();
		$form_data = $this->input->post();
	//	PrintR($form_data);die('ddddddddddddd');
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);
		$draw_amount = FCrtRplc($form_data['draw_amount']);
		$wallet_id = FCrtRplc($form_data['wallet_id']);
		$cryptoname = FCrtRplc($form_data['cryptoname']);
		$trns_password = FCrtRplc($form_data['trns_password']);
		$processor_id = FCrtRplc($form_data['processor_id']);
 $CONFIG_MIN_WITHDRAWL =  $model->getValue("CONFIG_MIN_WITHDRAWL"); 
	    $CONFIG_MAX_WITHDRAWL =    $model->getValue("CONFIG_MAX_WITHDRAWL"); 

		
    $t=date('d-m-Y');
   $day = date("D",strtotime($t));  
	
  if($model->getValue("wallelttransfer_status")=='Y'){
		if($form_data['submitform']!='' && $this->input->post()!=''){
		    //	if($day == 'Sun') {
		   
			$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
			if($member_id>0 && is_numeric($draw_amount) ){
				if($draw_amount>=$CONFIG_MIN_WITHDRAWL){
					if($model->checkOldPassword($member_id,$trns_password)>0){
						if($draw_amount<=$LDGR['net_balance']){
					
						$cryptoname = FCrtRplc($cryptoname);
						$btc_address = FCrtRplc($btc_address);
						$pm_account = FCrtRplc($pm_account);
						$pm_account_type = FCrtRplc($pm_account_type);
						$bank_name = FCrtRplc($bank_name);
						$bank_branch = FCrtRplc($bank_branch);
						$bank_city = FCrtRplc($bank_city);
						$bank_state = FCrtRplc($bank_state);
						$bank_country = FCrtRplc($bank_country);
						
						$account_no = FCrtRplc($account_no);
						$swift_code = FCrtRplc($swift_code);
						$bank_zip_code = FCrtRplc($bank_zip_code);
						
						$trans_no = UniqueId("TRNS_NO");
						$wallet_id = FCrtRplc($wallet_id);
						$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
						
						$AR_PRC = $model->getProcessor($processor_id);
						$withdraw_fee_percent = 2;//($AR_PRC['withdraw_fee']>0)? $AR_PRC['withdraw_fee']:10;
						$withdraw_fee = ($draw_amount*$withdraw_fee_percent/100); 
						$process_fee =  "0";
						$total_charge = $withdraw_fee+$process_fee;
						$trns_amount = ($draw_amount-$total_charge);
						$trns_date = getLocalTime();
						$pending = $model->countpendingwithstatus($member_id);
						if($pending <= 0)
						{
					
								$data = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$wallet_id,
									"initial_amount"=>$draw_amount,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>($withdraw_fee)? $withdraw_fee:0,
									"process_fee"=>$process_fee,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"CRYPTO",
									"processor_id"=>$processor_id,
									"cryptoname"=>$cryptoname,
								/*	"btc_address"=>($btc_address)? $btc_address:" ",
									"pm_account"=>($pm_account)? $pm_account:" ",
									"pm_account_type"=>($pm_account)? $pm_account_type:" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>($swift_code)? $swift_code:" ",
									"bank_zip_code"=>($bank_zip_code)? $bank_zip_code:" ",*/
									"trns_remark"=>"Withdrawal  Request from ".$AR_MEM['user_id'],
								);
								$userid =$AR_MEM['user_id'];
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
								$trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
								$model->wallet_transaction($wallet_id,"Dr",$member_id,$draw_amount,$trns_remark,$trns_date,$trans_no,"1","CW");
								set_message("success","You have successfully request for withdrawal $StrMsg");
								redirect_member("ewallet","withdrawtransfer",array("error"=>"success"));
						
						}
						else{
							set_message("warning","You have already send your withdrowal request please wait for approval !...");
							redirect_member("ewallet","withdrawtransfer","");	
						}
							
						}else{
							set_message("warning","Invalid amount, please check your  balance");
							redirect_member("ewallet","withdrawtransfer","");	
						}
					}else{
						set_message("warning","Invalid User password");
						redirect_member("ewallet","withdrawtransfer","");	
					}
				}else{
					set_message("warning","Enter the amount over and above  ".$CONFIG_MIN_WITHDRAWL."   ");
					redirect_member("ewallet","withdrawtransfer","");				
				}
			}else{
				set_message("warning","Invalid amount");
				redirect_member("ewallet","withdrawtransfer","");		
			}
		    	
		    	    
		    	/*}else{
	    set_message("warning","Withdrawal only Open on Sunday");
			
	}*/

		}
		
		
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		
	}
else{
		      
		    set_message("warning","Crypto Withdrawal unavailable");
		  }

		$this->load->view(MEMBER_FOLDER.'/ewallet/withdrawtransfer',$data);
	






					
		
		
	}
	public function miningwithdrawal(){

		$model = new OperationModel();
		$form_data = $this->input->post();
	//	PrintR($form_data);die('ddddddddddddd');
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);
		
//	PrintR($AR_MEM);die;
	
            $initital_amount = FCrtRplc($form_data['amount']);
            $drawamount = FCrtRplc($form_data['drawamount']);
            $stacking = FCrtRplc($form_data['stacking']);
            $liquidity = FCrtRplc($form_data['liquidity']);
		$wallet_id = 2;//FCrtRplc($form_data['wallet_id']);
		$cryptoname = FCrtRplc($form_data['cryptoname']);
		$trns_password = FCrtRplc($form_data['trns_password']);
		$processor_id = FCrtRplc($form_data['processor_id']);
	    $CONFIG_MIN_WITHDRAWL =  10;//$model->getValue("CONFIG_MIN_WITHDRAWL"); 
	    $CONFIG_MAX_WITHDRAWL =   900000000; $model->getValue("CONFIG_MAX_WITHDRAWL"); 

	
		
		
		$crypto = FCrtRplc($form_data['crypto']);
		
		
		
    $t=date('d-m-Y');
   $day = date("D",strtotime($t));  
                    // [randcheck] => 2087521108
                    // [amount] => 100
                    // [trns_password] => Basu12345
                    // [submitform] => 1
                    
                  
  if($model->getValue("CONFIG_WITHDRAWAL_MANUAL")=='Y'){
		if($form_data['submitform']!='' && $this->input->post()!=''){
		    
		    
		     $gotp =$form_data['gemail_otp']; 
                $gotp_email  = $this->session->userdata('gotp_email'); 
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($gotp_email  !=$gotp)   
	 {	
	    
	       redirect_member("dashboard","index",set_message("danger","You have Enter Invalid OTP."));  
	 } else{
	     
	    $this->session->unset_userdata('gotp_email');    
	     
	 }
		  		   
		    
		    
		    //	if($day == 'Sun') {
		    
		    
		  //  $countManual = $model->checkManualSubscriber($member_id);
		  //  if($countManual > 0 )
		  //  {
		  //      if($model->getValue("CONFIG_MANUAL_USERS")=='N'){
		  //        	set_message("warning","You can`t withdraw today please contact to admin.");
				// 	redirect_member("dashboard","index","");  
		  //      }
		        
		         
		  //  }
		    
		    
		    
		  //  $checkParents = $model->checkPrentsIdorNot($member_id);
		  //  if($checkParents > 0 )
		  //  {
    //                 set_message("warning","You can`t withdraw this is Child  ID you withdraw from parent ID.");
    //                 redirect_member("dashboard","index","");   
		  //  }
		    
		     if($cryptoname=='USDT'){
		         
		        $cryptoaddress= $AR_MEM['trx_address'];
		         	$admin_charge = 5;
		     }elseif($cryptoname=='Awallet'){
		         
		          $cryptoaddress= $AR_MEM['trx_address'];
		          	$admin_charge = 5;
		         
		     }
		     else{
		         
		        $cryptoaddress= $AR_MEM['ownaddress'];  
		         	$admin_charge = 0;
		     }
		        
		      if($cryptoaddress !=''){
                $randcheckS =    $this->session->userdata('rand');
                $randcheckF =    $form_data['randcheck'] ;  
                if(true) { 
                // $this->session->unset_userdata('rand');
                 
		   
			$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		//	$LDGR1 = $model->getCurrentBalance($member_id,4,"","");
			
				$Lastpkg = $model->getLastMemberpackage($member_id);
				//	$lasttypeid = $model->getLastMemberpackagetypeid($member_id);
			//die;

			if($member_id>0 && is_numeric($initital_amount) ){
			     
                 if($initital_amount %10 =='0' )
                { 
			    	if($initital_amount <= $CONFIG_MAX_WITHDRAWL)
			    	{
			    	     
				if($initital_amount>=$CONFIG_MIN_WITHDRAWL){
				//	if($model->checkOldPassword($member_id,$trns_password)>0){
					    
					    
					if(true){	    
					    
					    
					    
						if($initital_amount<=$LDGR['net_balance']){
						    
							$date = getLocalTime();
							$todayTrns = $model->getTotdayTransfers($member_id,$date);	
						  $CONFIG_WITHDRAWL_LIMIT = $model->getValue("CONFIG_WITHDRAWL_LIMIT");    
						 if($todayTrns < $CONFIG_WITHDRAWL_LIMIT  ){ }else{  redirect_member("dashboard","index",set_message("danger","You have already withdrawal Today please try next day"));     }
						
		
                        $UPTO_WITH = $model->totalGlobalPackage($member_id);
                        $total_withdrawal   = $model->getMemberWithdrawal($member_id);
                        // $checkParents       = $model->checkPrentsIdorNot($member_id);
                        
                       
    //                     $REM_WITH  = $UPTO_WITH -  $total_withdrawal;
				// 		if($draw_amount > $REM_WITH)  
				// 		{
    //                         set_message("warning","Your Withdraw Limit has been exceed please Retopup Your Id.");
    //                         redirect_member("dashboard","index","");   
				// 		}
						   
						   
				// 		$CryptoSts = $model->getWithdrawStsCrypto($member_id);
				// 		if($CryptoSts <= '0')
				// 		{
    //                             set_message("warning","Your Withdraw is disabled please contact your Leader or Admin.");
    //                             redirect_member("dashboard","index","");  
				// 		}
						    
					
						$cryptoname = FCrtRplc($cryptoname);
						$btc_address = FCrtRplc($btc_address);
						$pm_account = FCrtRplc($pm_account);
						$pm_account_type = FCrtRplc($pm_account_type);
						$bank_name = FCrtRplc($bank_name);
						$bank_branch = FCrtRplc($bank_branch);
						$bank_city = FCrtRplc($bank_city);
							$bank_branch = FCrtRplc($bank_branch);
						$stacking = FCrtRplc($stacking);
						$liquidity = FCrtRplc($liquidity);
						$bank_country = FCrtRplc($bank_country);
						
						$account_no = FCrtRplc($account_no);
						$swift_code = FCrtRplc($swift_code);
						$bank_zip_code = FCrtRplc($bank_zip_code);
						
						$trans_no = UniqueId("TRNS_NO");
						$wallet_id = FCrtRplc($wallet_id);
						$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
						
				// 		$AR_PRC = $model->getProcessor($processor_id);
					
						$admin_charges = ($drawamount*$admin_charge/100); 
						$process_fee =  "0";
						$total_charge = $admin_charges+$process_fee;
						$trns_amount = ($drawamount-$total_charge);
						$trns_date = getLocalTime();
						$pending = $model->countpendingwithstatus($member_id);
						if($pending <= 0)
						{
				
								$data = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$wallet_id,
									"initial_amount"=>$initital_amount,
									
											"stacking"=>$stacking,
												"liquidity"=>$liquidity,
										"cryptoname"=>$cryptoname,
											"trxaddress"=>$cryptoaddress,
									"admin_charge"=>($admin_charges)? $admin_charges:0,
									"withdraw_fee"=>($withdraw_fee)? $withdraw_fee:0,
									"process_fee"=>$process_fee,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"MININGWITHDRAW",
									"draw_type"=>"MANUAL",
									"processor_id"=>$processor_id,
								
									"trns_remark"=>"MINING Withdrawal  Request from ".$AR_MEM['user_id'],
								);
								$userid =$AR_MEM['user_id'];
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
								$trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
								$model->wallet_transaction($wallet_id,"Dr",$member_id,$initital_amount,$trns_remark,$trns_date,$trans_no,"1","Mning Withdrawal");
									//$model->wallet_transaction(4,"Dr",$member_id,$draw_amount*20/100,$trns_remark,$trns_date,$trans_no,"1","MW");
								set_message("success","You have successfully request for withdrawal $StrMsg");
							redirect_member("dashboard","index","");	
						
						}
						else{
							set_message("warning","You have already send your withdrawal request please wait for approval !...");
						redirect_member("dashboard","index","");	
						}
						
						
						
						
						
							
						}else{
							set_message("warning","Invalid amount, please check your  balance");
						redirect_member("dashboard","index","");	
						}
					}else{
						set_message("warning","Invalid User password");
					redirect_member("dashboard","index","");	
					}
				}else{
					set_message("warning","Minimum withdraw is  ".$CONFIG_MIN_WITHDRAWL."  $ ");
				redirect_member("dashboard","index","");					
				}
				
			    	}else{
					set_message("warning","Maximum withdraw is  ".$CONFIG_MAX_WITHDRAWL." $  ");
				redirect_member("dashboard","index","");					
				}
				
			}else{
					set_message("warning","Amount Should Be Multiply by 10");
				redirect_member("dashboard","index","");					
				}
			}else{
				set_message("warning","Invalid amount");
			redirect_member("dashboard","index","");	
			}
			
                }
                else{  
						set_message("warning","Invalid security error please try again!");
						redirect_member("dashboard","index","");	
					}
		    	
		      }else{
    
     set_message("warning","Kindly fill $cryptoname Address"); 
    
    
}	    
		    	/*}else{
	    set_message("warning","Withdrawal only Open on Sunday");
			
	}*/

		
		    
		    
		    

		}
		
		
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		
	}
else{
		      
		    set_message("warning","Crypto Withdrawal unavailable");
		  }

	redirect_member("dashboard","index","");	
	






					
		
		
	}	
public function maindrawalManual(){

		$model = new OperationModel();
		$form_data = $this->input->post();
	//	PrintR($form_data);die('ddddddddddddd');
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);
		
//	redirect_member("dashboard","index","");
	
            $initital_amount = FCrtRplc($form_data['amount1']);
            $drawamount = FCrtRplc($initital_amount);
            $stacking = FCrtRplc($form_data['stacking1']);
            $liquidity = FCrtRplc($form_data['liquidity1']);
		$wallet_id = FCrtRplc($form_data['wallettype']);
		$cryptoname = FCrtRplc($form_data['cryptoname']);
		$trns_password = FCrtRplc($form_data['trns_password']);
		$processor_id = FCrtRplc($form_data['processor_id']);
	    $CONFIG_MIN_WITHDRAWL =  $model->getValue("CONFIG_MIN_WITHDRAWL"); 
	    $CONFIG_MAX_WITHDRAWL =  $model->getValue("CONFIG_MAX_WITHDRAWL"); 
 $memberdetail   = $model->getMemberdetail($member_id);
	 $member_email      = $memberdetail['member_email']; 
              $user_id      = $memberdetail['user_id']; 
               $first_name     = $memberdetail['first_name']; 
	
		
		$crypto = FCrtRplc($form_data['crypto']);
		
		
		
    $t=date('d-m-Y');
   $day = date("D",strtotime($t));  
                    // [randcheck] => 2087521108
                    // [amount] => 100
                    // [trns_password] => Basu12345
                    // [submitform] => 1
                    
                  
  if($model->getValue("CONFIG_WITHDRAWAL_MANUAL")=='Y'){
		if($form_data['submitform']!='' && $this->input->post()!=''){
		    
		
		    
		     if($cryptoname=='USDT'){
		         
		        $cryptoaddress= $AR_MEM['trx_address'];
		         	$admin_charge = 5;
		     }
		     else{
		         
		        $cryptoaddress= $AR_MEM['ownaddress'];  
		         	$admin_charge = 0;
		     }
		        
		      if($cryptoaddress !=''){
                $randcheckS =    $this->session->userdata('rand');
                $randcheckF =    $form_data['randcheck'] ;  
                if(true) { 
                // $this->session->unset_userdata('rand');
                 
		   
			$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		//	$LDGR1 = $model->getCurrentBalance($member_id,4,"","");
			
				$Lastpkg = $model->getLastMemberpackage($member_id);
				//	$lasttypeid = $model->getLastMemberpackagetypeid($member_id);
			//die;

			if($member_id>0 && is_numeric($initital_amount) ){ 
			       if(true){ 
               //  if($initital_amount %10 =='0' ){ 
			    	if($initital_amount <= $CONFIG_MAX_WITHDRAWL)
			    	{
			    	     
				if($initital_amount>=$CONFIG_MIN_WITHDRAWL){
			
					    
						if($initital_amount<=$LDGR['net_balance']){
						    
							$date = getLocalTime();
							$todayTrns = $model->getTotdayTransfers($member_id,$date);	
						  $CONFIG_WITHDRAWL_LIMIT = $model->getValue("CONFIG_WITHDRAWL_LIMIT");    
						 if($todayTrns < $CONFIG_WITHDRAWL_LIMIT  ){ }else{  redirect_member("dashboard","index",set_message("danger","You have already withdrawal Today please try next day"));     }
						
		
                        $UPTO_WITH = $model->totalGlobalPackage($member_id);
                        $total_withdrawal   = $model->getMemberWithdrawal($member_id);
                       
						    
					
						$cryptoname = FCrtRplc($cryptoname);
						$btc_address = FCrtRplc($btc_address);
						$pm_account = FCrtRplc($pm_account);
						$pm_account_type = FCrtRplc($pm_account_type);
						$bank_name = FCrtRplc($bank_name);
						$bank_branch = FCrtRplc($bank_branch);
						$bank_city = FCrtRplc($bank_city);
							$bank_branch = FCrtRplc($bank_branch);
						$stacking = FCrtRplc($stacking);
						$liquidity = FCrtRplc($liquidity);
						$bank_country = FCrtRplc($bank_country);
						
						$account_no = FCrtRplc($account_no);
						$swift_code = FCrtRplc($swift_code);
						$bank_zip_code = FCrtRplc($bank_zip_code);
						
						$trans_no = UniqueId("TRNS_NO");
						$wallet_id = FCrtRplc($wallet_id);
						$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
						
				// 		$AR_PRC = $model->getProcessor($processor_id);
					
						$admin_charges = ($drawamount*$admin_charge/100); 
						$process_fee =  "0";
						$total_charge = $admin_charges+$process_fee;
						$trns_amount = ($drawamount-$total_charge);
						$trns_date = getLocalTime();
						$pending = $model->countpendingwithstatus($member_id);
						if($pending <= 0)
						{ 
				 //	PRintR($form_data);die;
								$data = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$wallet_id,
									"initial_amount"=>$initital_amount,
									
											"stacking"=> FCrtRplc($form_data['stacking1']),
												"liquidity"=>FCrtRplc($form_data['liquidity1']),
										"cryptoname"=>$cryptoname,
											"trxaddress"=>$cryptoaddress,
									"admin_charge"=>($admin_charges)? $admin_charges:0,
									"withdraw_fee"=>($withdraw_fee)? $withdraw_fee:0,
									"process_fee"=>$process_fee,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"MANUAL",
									"processor_id"=>$processor_id,
								
									"trns_remark"=>"Withdrawal  Request from ".$AR_MEM['user_id'],
								);
								$userid =$AR_MEM['user_id'];
								
								
							//		PrintR($data);die;
								
								
								if($wallet_id==1){
								    $ttt='Income';
								}else{
								    
								    $ttt='Direct';
								}
								
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
								$trns_remark = "$ttt WITHDRAWAL REQUEST FROM [".$userid."]";
								$model->wallet_transaction($wallet_id,"Dr",$member_id,$initital_amount,$trns_remark,$trns_date,$trans_no,"1","MW");
									//$model->wallet_transaction(4,"Dr",$member_id,$draw_amount*20/100,$trns_remark,$trns_date,$trans_no,"1","MW");
								set_message("success","You have successfully request for withdrawal $StrMsg");
					if (false) {			
						$message2 = '
<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
    <title> Welcome to Coded Mails </title>
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
    #outlook a {
    padding: 0;
    }
    
    body {
    margin: 0;
    padding: 0;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
    }
    
    table,
    td {
    border-collapse: collapse;
    mso-table-lspace: 0pt;
    mso-table-rspace: 0pt;
    }
    
    img {
    border: 0;
    height: auto;
    line-height: 100%;
    outline: none;
    text-decoration: none;
    -ms-interpolation-mode: bicubic;
    }
    
    p {
    display: block;
    margin: 13px 0;
    }
    </style>
    
    <link href="https://fonts.googleapis.com/css2?family=Quattrocento:wght@400;700&amp;display=swap" rel="stylesheet" type="text/css" />
    <style type="text/css">
    @import url(https://fonts.googleapis.com/css2?family=Quattrocento:wght@400;700&amp;display=swap);
    </style>
    <!--<![endif]-->
    <style type="text/css">
    @media only screen and (min-width:480px) {
    .mj-column-per-100 {
    width: 100% !important;
    max-width: 100%;
    }
    }
    </style>
    <style type="text/css">
    @media only screen and (max-width:480px) {
    table.mj-full-width-mobile {
    width: 100% !important;
    }
    
    td.mj-full-width-mobile {
    width: auto !important;
    }
    }
    </style>
    <style type="text/css">
    a,
    span,
    td,
    th {
    -webkit-font-smoothing: antialiased !important;
    -moz-osx-font-smoothing: grayscale !important;
    }
    </style>
    </head>
    
    <body style="background-color: #ffffff;">
    
    
    
    <div style="background-color: #ffffff;">
    
    <div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
    <tbody>
    <tr>
    <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:left;">
    
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    
    <div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
    <tbody>
    <tr>
    <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:left;">
    
    <div style="background:#ffffff;background-color:#ffffff;margin:0px auto;border-radius:8px 8px 0 0;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;border-radius:8px 8px 0 0;">
    <tbody>
    <tr>
    <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:left;">
    
    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:middle;width:100%;">
    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:middle;" width="100%">
    <tbody><tr>
    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
    <tbody>
    <tr >
    <td style="width:150px;">
    <img align="center" border="0" src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 208px;" width="208" class="v-src-width v-src-max-width"/>
    
    </td>
    </tr>
    </tbody>
    </table>
    </td>
    </tr>
    <tr>
    <td style="font-size:0px;padding:10px 25px;word-break:break-word;">
    <p style="border-top:solid 4px #f9f9f9;font-size:1px;margin:0px auto;width:100%;">
    </p>
    
    </td>
    </tr>
    </tbody></table>
    </div>
    
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    
    <div style="background:#ffffff;background-color:#ffffff;margin:0px auto;border-radius:0 0 8px 8px;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;border-radius:0 0 8px 8px;">
    <tbody>
    <tr>
    <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0px;text-align:left;">
    
    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
    <tbody>
    
    
    <tr>
    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
    <div style="font-family:Quattrocento;font-size:18px;font-weight:400;line-height:24px;text-align:left;color:#000000;">
    
       
       <h4>  Dear '.$first_name.',</h4>
    <p>
    
        We have received withdrawal request for  $ '.$amount.'. from your withdrawal wallet of account '.$user_id.'. 
        
        After successful verification, amount after deduction of 10% admin charges, will be credited in your registered withdrawal wallet.
    
    </p>
       <p>If it’ll be not credited in next 72 hrs., then please write to us.</p>
    <p>
        With warm regards,<br>
        Team Forex One
    </p>  
       
        <br></div>
    </td>
    </tr>
    
    
    
    </tbody></table>
    </div>
    
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    
    <div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
    <tbody>
    <tr>
    <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:left;">
    
    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
    <tbody>
    
    <tr>
    
    </tr>
    
    
    </tbody></table>
    </div>
    
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <div style="margin:0px auto;max-width:600px;">
    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
    <tbody>
    <tr>
    <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:left;">
    
    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
    <tbody><tr>
    <td style="font-size:0px;word-break:break-word;">
    
    <div style="height:1px;">   </div>
    
    </td>
    </tr>
    </tbody></table>
    </div>
    
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    
    </div>
    
    
    </body>
    </html>
';

        $subject="Deposit Successful";
 $apiKey = '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';
$fromEmail = 'noreply@forexonefx.com';
 //$subject="Welcome Letter";

$url = 'https://api.sendinblue.com/v3/smtp/email';

$data = array(
    'sender' => array(
        'name' => 'Forexonefx',
        'email' => $fromEmail
    ),
    'to' => array(
        array(
            'email' => $member_email
        )
    ),
    'subject' => $subject,
    'htmlContent' => $message2
);

$headers = array(
    'Content-Type: application/json',
    'api-key: ' . $apiKey
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);
curl_close($ch);

if ($result) {
  //  echo 'Email sent successfully.';
}	
				
						}				
							redirect_member("dashboard","index","");	
						
						}
						else{
							set_message("warning","You have already send your withdrawal request please wait for approval !...");
						redirect_member("dashboard","index","");	
						}
						
						
						
						
						
							
						}else{
							set_message("warning","Invalid amount, please check your  balance");
						redirect_member("dashboard","index","");	
						}
				
				}else{
					set_message("warning","Minimum withdraw is  ".$CONFIG_MIN_WITHDRAWL."  $ ");
				redirect_member("dashboard","index","");					
				}
				
			    	}else{
					set_message("warning","Maximum withdraw is  ".$CONFIG_MAX_WITHDRAWL." $  ");
				redirect_member("dashboard","index","");					
				}
				
			}else{
					set_message("warning","Amount Should Be Multiply by 10");
				redirect_member("dashboard","index","");					
				}
			}else{
				set_message("warning","Invalid amount");
			redirect_member("dashboard","index","");	
			}
			
                }
                else{  
						set_message("warning","Invalid security error please try again!");
						redirect_member("dashboard","index","");	
					}
		    	
		      }else{
    
     set_message("warning","Kindly fill $cryptoname Address"); 
    
    	redirect_member("dashboard","index","");
}	    
		    	/*}else{
	    set_message("warning","Withdrawal only Open on Sunday");
			
	}*/

		
		    
		    
		    

		}
		
		
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		
	}
else{
		      
		    set_message("warning","Crypto Withdrawal unavailable");
		  }

//$this->load->view(ADMIN_FOLDER.'/financial/loadingpage',$data);
	






					
		
		
	}		
public function withdrawalManualold(){

		$model = new OperationModel();
		$form_data = $this->input->post();
	//	PrintR($form_data);die('ddddddddddddd');
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);
		
//	PrintR($AR_MEM);die;
		$draw_amount = FCrtRplc($form_data['amount']);
			$initital_amount = FCrtRplc($form_data['amount']);
		$wallet_id = 1;//FCrtRplc($form_data['wallet_id']);
		$cryptoname = 'BUSD';//FCrtRplc($form_data['cryptoname']);
		$trns_password = FCrtRplc($form_data['trns_password']);
		$processor_id = FCrtRplc($form_data['processor_id']);
	    $CONFIG_MIN_WITHDRAWL =  10;//$model->getValue("CONFIG_MIN_WITHDRAWL"); 
	    $CONFIG_MAX_WITHDRAWL =   900000000; $model->getValue("CONFIG_MAX_WITHDRAWL"); 
	       
		// 
		
		
		
		$crypto = FCrtRplc($form_data['crypto']);
		
		
		
    $t=date('d-m-Y');
   $day = date("D",strtotime($t));  
                    // [randcheck] => 2087521108
                    // [amount] => 100
                    // [trns_password] => Basu12345
                    // [submitform] => 1
                    
                  
  if($model->getValue("CONFIG_WITHDRAWAL_MANUAL")=='Y'){
		if($form_data['submitform']!='' && $this->input->post()!=''){
		    
		    
		     $gotp =$form_data['gemail_otp']; 
                $gotp_email  = $this->session->userdata('gotp_email'); 
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($gotp_email  !=$gotp)   
	 {	
	    
	       redirect_member("dashboard","index",set_message("danger","You have Enter Invalid OTP."));  
	 } else{
	     
	    $this->session->unset_userdata('gotp_email');    
	     
	 }
		  		   
		    
		    
		    //	if($day == 'Sun') {
		    
		    
		  //  $countManual = $model->checkManualSubscriber($member_id);
		  //  if($countManual > 0 )
		  //  {
		  //      if($model->getValue("CONFIG_MANUAL_USERS")=='N'){
		  //        	set_message("warning","You can`t withdraw today please contact to admin.");
				// 	redirect_member("dashboard","index","");  
		  //      }
		        
		         
		  //  }
		    
		    
		    
		  //  $checkParents = $model->checkPrentsIdorNot($member_id);
		  //  if($checkParents > 0 )
		  //  {
    //                 set_message("warning","You can`t withdraw this is Child  ID you withdraw from parent ID.");
    //                 redirect_member("dashboard","index","");   
		  //  }
		    
		     if($cryptoname=='BUSD'){
		         
		        $cryptoaddress= $AR_MEM['trx_address'];
		         
		     }
		        
		      if($cryptoaddress !=''){
                $randcheckS =    $this->session->userdata('rand');
                $randcheckF =    $form_data['randcheck'] ;  
                if($randcheckS == $randcheckF) { 
                // $this->session->unset_userdata('rand');
                 
		   
			$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		//	$LDGR1 = $model->getCurrentBalance($member_id,4,"","");
			
				$Lastpkg = $model->getLastMemberpackage($member_id);
		//	die;
			if($Lastpkg==10){
			    
			    $per=40;
			    	$initital_amount = FCrtRplc($form_data['amount']);
			  //  $draw_amount*$per/100;
			}elseif($Lastpkg==20){
			    
			    $per=30;
			    	$initital_amount = FCrtRplc($form_data['amount']);
			   // $draw_amount*$per/100;
			}elseif($Lastpkg==40){
			    
			    $per=20;
			    	$initital_amount = FCrtRplc($form_data['amount']);
			    //$draw_amount*$per/100;
			}elseif($Lastpkg==80){
			    
			    $per=10;
			    	$initital_amount = FCrtRplc($form_data['amount']);
			    //$draw_amount*$per/100;
			}elseif($Lastpkg==160){
			    
			    $per=0;
			    	$initital_amount = FCrtRplc($form_data['amount']);
			    //$draw_amount*$per/100;
			}
		
			if($member_id>0 && is_numeric($draw_amount) ){
			     
                 if($draw_amount %10 =='0' )
                { 
			    	if($draw_amount <= $CONFIG_MAX_WITHDRAWL)
			    	{
			    	     
				if($draw_amount>=$CONFIG_MIN_WITHDRAWL){
					if($model->checkOldPassword($member_id,$trns_password)>0){
					    
					    
					    
					    
					    
					    
						if($draw_amount<=$LDGR['net_balance']){
						    
							$date = getLocalTime();
							$todayTrns = $model->getTotdayTransfers($member_id,$date);	
						  $CONFIG_WITHDRAWL_LIMIT = $model->getValue("CONFIG_WITHDRAWL_LIMIT");    
						 if($todayTrns < $CONFIG_WITHDRAWL_LIMIT  ){ }else{  redirect_member("dashboard","index",set_message("danger","You have already withdrawal Today please try next day"));     }
						
		
                        $UPTO_WITH = $model->totalGlobalPackage($member_id);
                        $total_withdrawal   = $model->getMemberWithdrawal($member_id);
                        // $checkParents       = $model->checkPrentsIdorNot($member_id);
                        
                       
    //                     $REM_WITH  = $UPTO_WITH -  $total_withdrawal;
				// 		if($draw_amount > $REM_WITH)  
				// 		{
    //                         set_message("warning","Your Withdraw Limit has been exceed please Retopup Your Id.");
    //                         redirect_member("dashboard","index","");   
				// 		}
						   
						   
				// 		$CryptoSts = $model->getWithdrawStsCrypto($member_id);
				// 		if($CryptoSts <= '0')
				// 		{
    //                             set_message("warning","Your Withdraw is disabled please contact your Leader or Admin.");
    //                             redirect_member("dashboard","index","");  
				// 		}
						    
					
						$cryptoname = FCrtRplc($cryptoname);
						$btc_address = FCrtRplc($btc_address);
						$pm_account = FCrtRplc($pm_account);
						$pm_account_type = FCrtRplc($pm_account_type);
						$bank_name = FCrtRplc($bank_name);
						$bank_branch = FCrtRplc($bank_branch);
						$bank_city = FCrtRplc($bank_city);
						$bank_state = FCrtRplc($bank_state);
						$bank_country = FCrtRplc($bank_country);
						
						$account_no = FCrtRplc($account_no);
						$swift_code = FCrtRplc($swift_code);
						$bank_zip_code = FCrtRplc($bank_zip_code);
						
						$trans_no = UniqueId("TRNS_NO");
						$wallet_id = FCrtRplc($wallet_id);
						$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
						
				// 		$AR_PRC = $model->getProcessor($processor_id);
						$admin_charge = $per;//($AR_PRC['withdraw_fee']>0)? $AR_PRC['withdraw_fee']:10;
						$admin_charges = ($draw_amount*$admin_charge/100); 
						$process_fee =  "0";
						$total_charge = $admin_charges+$process_fee;
						$trns_amount = ($draw_amount-$total_charge);
						$trns_date = getLocalTime();
						$pending = $model->countpendingwithstatus($member_id);
						if($pending <= 0)
						{
				
								$data = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$wallet_id,
									"initial_amount"=>$draw_amount,
										"cryptoname"=>$cryptoname,
											"trxaddress"=>$cryptoaddress,
									"admin_charge"=>($admin_charges)? $admin_charges:0,
									"withdraw_fee"=>($withdraw_fee)? $withdraw_fee:0,
									"process_fee"=>$process_fee,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"MANUAL",
									"processor_id"=>$processor_id,
								
									"trns_remark"=>"Withdrawal  Request from ".$AR_MEM['user_id'],
								);
								$userid =$AR_MEM['user_id'];
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
								$trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
								$model->wallet_transaction($wallet_id,"Dr",$member_id,$draw_amount,$trns_remark,$trns_date,$trans_no,"1","MW");
									//$model->wallet_transaction(4,"Dr",$member_id,$draw_amount*20/100,$trns_remark,$trns_date,$trans_no,"1","MW");
								set_message("success","You have successfully request for withdrawal $StrMsg");
							redirect_member("dashboard","index","");	
						
						}
						else{
							set_message("warning","You have already send your withdrawal request please wait for approval !...");
						redirect_member("dashboard","index","");	
						}
						
						
						
						
						
							
						}else{
							set_message("warning","Invalid amount, please check your  balance");
						redirect_member("dashboard","index","");	
						}
					}else{
						set_message("warning","Invalid User password");
					redirect_member("dashboard","index","");	
					}
				}else{
					set_message("warning","Minimum withdraw is  ".$CONFIG_MIN_WITHDRAWL."  $ ");
				redirect_member("dashboard","index","");					
				}
				
			    	}else{
					set_message("warning","Maximum withdraw is  ".$CONFIG_MAX_WITHDRAWL." $  ");
				redirect_member("dashboard","index","");					
				}
				
			}else{
					set_message("warning","Amount Should Be Multiply by 10");
				redirect_member("dashboard","index","");					
				}
			}else{
				set_message("warning","Invalid amount");
			redirect_member("dashboard","index","");	
			}
			
                }
                else{  
						set_message("warning","Invalid security error please try again!");
						redirect_member("dashboard","index","");	
					}
		    	
		      }else{
    
     set_message("warning","Kindly fill $cryptoname Address"); 
    
    
}	    
		    	/*}else{
	    set_message("warning","Withdrawal only Open on Sunday");
			
	}*/

		
		    
		    
		    

		}
		
		
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		
	}
else{
		      
		    set_message("warning","Crypto Withdrawal unavailable");
		  }

	redirect_member("dashboard","index","");	
	






					
		
		
	}
	
	
	
		public function withdraw(){



		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$draw_amount = FCrtRplc($form_data['draw_amount']);
		$wallet_id = FCrtRplc($form_data['wallet_id']);
		
		$trns_password = FCrtRplc($form_data['trns_password']);
		$processor_id = FCrtRplc($form_data['processor_id']);
		
		

		
	        
	 
		
		if($form_data['requestWithdraw']!='' && $this->input->post()!=''){
		    $AR_MEM = $model->getMember($member_id);
			$bank_name = FCrtRplc($AR_MEM['bank_name']);
			$bank_branch = FCrtRplc($AR_MEM['bank_address']);
			$bank_city = FCrtRplc($AR_MEM['bank_city']);
			$bank_state = FCrtRplc($AR_MEM['bank_state']);
			$bank_country = FCrtRplc($AR_MEM['bank_country']);
			
			$account_no = FCrtRplc($AR_MEM['account_number']);
			$swift_code = FCrtRplc($AR_MEM['swift_code']);
			$bank_zip_code = FCrtRplc($AR_MEM['bank_zipcode']);
			$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_WITHDRAWL_BANKWIRE");
			$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
			if($member_id>0 && is_numeric($draw_amount) && $processor_id>=0){
				if($draw_amount>=$CONFIG_MIN_WITHDRAWL){
					if($model->checkOldPassword($member_id,$trns_password)>0){
						if($draw_amount<=$LDGR['net_balance']){
					
						
						$btc_address = FCrtRplc($btc_address);
						$pm_account = FCrtRplc($pm_account);
						$pm_account_type = FCrtRplc($pm_account_type);
						$bank_name = FCrtRplc($bank_name);
						$bank_branch = FCrtRplc($bank_branch);
						$bank_city = FCrtRplc($bank_city);
						$bank_state = FCrtRplc($bank_state);
						$bank_country = FCrtRplc($bank_country);
						
						$account_no = FCrtRplc($account_no);
						$swift_code = FCrtRplc($swift_code);
						$bank_zip_code = FCrtRplc($bank_zip_code);
						
						$trans_no = UniqueId("TRNS_NO");
						$wallet_id = FCrtRplc($wallet_id);
						$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
						
						$AR_PRC = $model->getProcessor($processor_id);
						$withdraw_fee_percent = 0;//($AR_PRC['withdraw_fee']>0)? $AR_PRC['withdraw_fee']:10;
						$withdraw_fee = 0;//($draw_amount*$withdraw_fee_percent/100); 
						$process_fee = ($processor_id==0)? "30":"0";
						$total_charge = 0;//$withdraw_fee+$process_fee;
						$trns_amount =$draw_amount;// ($draw_amount-$total_charge);
						$trns_date = InsertDate(getLocalTime());
						$pending = $model->countpendingwithstatus($member_id);
						if($pending <= 0)
						{
					
								$data = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$wallet_id,
									"initial_amount"=>$draw_amount,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>($withdraw_fee)? $withdraw_fee:0,
									"process_fee"=>$process_fee,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"MANUAL",
									"processor_id"=>$processor_id,
									"btc_address"=>($btc_address)? $btc_address:" ",
									"pm_account"=>($pm_account)? $pm_account:" ",
									"pm_account_type"=>($pm_account)? $pm_account_type:" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>($swift_code)? $swift_code:" ",
									"bank_zip_code"=>($bank_zip_code)? $bank_zip_code:" ",
									"trns_remark"=>"Withdrawal  Request from ".$AR_MEM['user_id'],
								);
								$userid =$AR_MEM['user_id'];
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
								$trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
							//	$model->wallet_transaction($wallet_id,"Dr",$member_id,$draw_amount,$trns_remark,$trns_date,$trans_no,"1","WITHDRAW");
								set_message("success","You have successfully request for withdrawal $StrMsg");
								redirect_member("ewallet","withdraw",array("error"=>"success"));
						
						}
						else{
							set_message("warning","You have already send your withdrowal request please wait for approval !...");
							redirect_member("ewallet","withdraw","");	
						}
							
						}else{
							set_message("warning","Invalid amount, please check your  balance");
							redirect_member("ewallet","withdraw","");	
						}
					}else{
						set_message("warning","Invalid User password");
						redirect_member("ewallet","withdraw","");	
					}
				}else{
					set_message("warning","Enter the amount over and above  ".$CONFIG_MIN_WITHDRAWL." Rs ");
					redirect_member("ewallet","withdraw","");				
				}
			}else{
				set_message("warning","Invalid amount");
				redirect_member("ewallet","withdraw","");		
			}
		}
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
        $data['web_title'] = 'Withdraw History';
		$this->load->view(MEMBER_FOLDER.'/ewallet/withdraw',$data);
	






					
		
		
	}
	
	public function transfer(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);
		$draw_amount = FCrtRplc($form_data['draw_amount']);
		$wallet_id = FCrtRplc($form_data['wallet_id']);
		
		$trns_password = FCrtRplc($form_data['trns_password']);
		$processor_id = FCrtRplc($form_data['processor_id']);
		
		

		
		if($processor_id==1){
			$btc_address = FCrtRplc($AR_MEM['bitcoin_address']);
			$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_WITHDRAWL_BITCOIN");
		}elseif($processor_id==2){
			$pm_account_type = FCrtRplc($AR_MEM['prft_account_type']);
			$pm_account = FCrtRplc($AR_MEM['prft_acc_number']);
			$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_WITHDRAWL_PERFECT");
		}else{
			$bank_name = FCrtRplc($AR_MEM['bank_name']);
			$bank_branch = FCrtRplc($AR_MEM['bank_address']);
			$bank_city = FCrtRplc($AR_MEM['bank_city']);
			$bank_state = FCrtRplc($AR_MEM['bank_state']);
			$bank_country = FCrtRplc($AR_MEM['bank_country']);
			
			$account_no = FCrtRplc($AR_MEM['account_number']);
			$swift_code = FCrtRplc($AR_MEM['swift_code']);
			$bank_zip_code = FCrtRplc($AR_MEM['bank_zipcode']);
			$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_WITHDRAWL_BANKWIRE");
		}
		
	if($form_data['requestWithdraw']!='' && $this->input->post()!=''){
		   
			$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
			if($member_id>0 && is_numeric($draw_amount) && $processor_id>=0){
				if($draw_amount>=$CONFIG_MIN_WITHDRAWL){
					if($model->checkOldPassword($member_id,$trns_password)>0){
						if($draw_amount<=$LDGR['net_balance']){
					
						
						$btc_address = FCrtRplc($btc_address);
						$pm_account = FCrtRplc($pm_account);
						$pm_account_type = FCrtRplc($pm_account_type);
						$bank_name = FCrtRplc($bank_name);
						$bank_branch = FCrtRplc($bank_branch);
						$bank_city = FCrtRplc($bank_city);
						$bank_state = FCrtRplc($bank_state);
						$bank_country = FCrtRplc($bank_country);
						
						$account_no = FCrtRplc($account_no);
						$swift_code = FCrtRplc($swift_code);
						$bank_zip_code = FCrtRplc($bank_zip_code);
						
						$trans_no = UniqueId("TRNS_NO");
						$wallet_id = FCrtRplc($wallet_id);
						$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
						
						$AR_PRC = $model->getProcessor($processor_id);
						$withdraw_fee_percent = ($AR_PRC['withdraw_fee']>0)? $AR_PRC['withdraw_fee']:10;
						$withdraw_fee = ($draw_amount*$withdraw_fee_percent/100); 
						$process_fee = ($processor_id==0)? "30":"0";
						$total_charge = $withdraw_fee+$process_fee;
						$trns_amount = ($draw_amount-$total_charge);
						$trns_date = InsertDate(getLocalTime());
						
					
								$data = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$wallet_id,
									"initial_amount"=>$draw_amount,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>($withdraw_fee)? $withdraw_fee:0,
									"process_fee"=>$process_fee,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"C",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"EWALLET",
									"draw_type"=>"MANUAL",
									"processor_id"=>$processor_id,
									"btc_address"=>($btc_address)? $btc_address:" ",
									"pm_account"=>($pm_account)? $pm_account:" ",
									"pm_account_type"=>($pm_account)? $pm_account_type:" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>($swift_code)? $swift_code:" ",
									"bank_zip_code"=>($bank_zip_code)? $bank_zip_code:" ",
									"trns_remark"=>"Withdrawal  Request from ".$AR_MEM['user_id'],
								);
								
								$data1 = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$wallet_id,
									"initial_amount"=>$draw_amount,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>($withdraw_fee)? $withdraw_fee:0,
									"process_fee"=>$process_fee,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"C",
									"trns_type"=>"Cr",
									"trns_date"=>$trns_date,
									"trns_for"=>"EWALLET",
									"draw_type"=>"MANUAL",
									"processor_id"=>$processor_id,
									"btc_address"=>($btc_address)? $btc_address:" ",
									"pm_account"=>($pm_account)? $pm_account:" ",
									"pm_account_type"=>($pm_account)? $pm_account_type:" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>($swift_code)? $swift_code:" ",
									"bank_zip_code"=>($bank_zip_code)? $bank_zip_code:" ",
									"trns_remark"=>"Recieve from Commission Wallet",
								);
								$userid =$AR_MEM['user_id'];
								$trns_remark = "E-Wallet Transfer FROM [".$userid."]";
								
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
								$model->wallet_transaction($wallet_id,"Dr",$member_id,$draw_amount,$trns_remark,$trns_date,$trans_no,"1","EWALLET");
								$trns_remark = "E-Wallet Transfer FROM [".$userid."]";
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer_wallet",$data1);
								$model->ewallet_transaction($wallet_id,"Cr",$member_id,$draw_amount,$trns_remark,$trns_date,$trans_no,"1","EWALLET");
								
								set_message("success","You have successfully Transfer in your E-wallet $StrMsg");
								redirect_member("ewallet","transfer",array("error"=>"success"));
						
					
							
						}else{
							set_message("warning","Invalid amount, please check your  balance");
							redirect_member("ewallet","transfer","");	
						}
					}else{
						set_message("warning","Invalid User password");
						redirect_member("ewallet","transfer","");	
					}
				}else{
					set_message("warning","Enter the amount over and above  ".$CONFIG_MIN_WITHDRAWL." Rs ");
					redirect_member("ewallet","transfer","");			
				}
			}else{
				set_message("warning","Invalid amount");
				redirect_member("ewallet","transfer","");		
			}
		}
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
       
		$this->load->view(MEMBER_FOLDER.'/ewallet/ewallettransfer',$data);
	}
	

		public function transferfund(){		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = 3;//$this->OperationModel->getWallet(WALLET1);

		$QR_CHECK = "SELECT * FROM tbl_members WHERE member_id='".$member_id."'";
	$memdata = $this->SqlModel->runQuery($QR_CHECK,true);
// if($memdata['isFranchise'] !='Y'){
//       	set_message("warning","Invalid Access");
// 							redirect_member("ewallet","topupWallet","");
// }
	 $CONFIG_MIN_WITHDRAWL =  $model->getValue("CONFIG_MIN_WITHDRAWL"); 
	    $CONFIG_MAX_WITHDRAWL =    $model->getValue("CONFIG_MAX_WITHDRAWL"); 
		$today_date = getLocalTime();
		$AR_MEM = $model->getMember($member_id);
		$trns_password = FCrtRplc($form_data['trns_password']);
			$f_wallet_id = $form_data['f_wallet_id'];
		$LDGR = $model->getCurrentBalancewal($member_id,$f_wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
	//	PrintR($LDGR);die;
		 
		if($form_data['submitFundRequest']==1 && $this->input->post()!=''){
		    
		     if($model->getValue("wallelt_to_wallelt")=='Y'){
		     $sotp =$form_data['semail_otp']; 
                $sotp_email  = $this->session->userdata('sotp_email'); 
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($sotp_email  !=$sotp)   
	 {	
	    
	       redirect_member("dashboard","index",set_message("danger","You have Enter Invalid OTP."));  
	 }else{
	     
	    $this->session->unset_userdata('sotp_email');    
	     
	 }
	 
		    	$f_wallet_id = $form_data['f_wallet_id'];
		    	$t_wallet_id = 3;// $form_data['f_wallet_id'];
				$to_member_id = $model->getMemberId(FCrtRplc($form_data['user_id']));
				// $processor_id = $model->getDefaultProcessor();
				// $AR_PRC = $model->getProcessor($processor_id);
				$deposit_fee_percent = $AR_PRC['deposit_fee'];

				
			 	$initial_amount = FCrtRplc($form_data['initial_amount']);
				$trns_remark = FCrtRplc($form_data['trns_remark']);
				$trns_type = FCrtRplc($form_data['trns_type']);
				$trns_date = InsertDate($today_date);
			
				$WITDRAW_FEE = 0;
    		        	$admin_charge = ($initial_amount*5/100);
				
                $randcheckS =    $this->session->userdata('rand');
                $randcheckF =    $form_data['randcheck'] ;   
                if(true) {  // $randcheckS == $randcheckF 
                $this->session->unset_userdata('rand');
				$total_charge = ($admin_charge);
			 	$trns_amount = ($initial_amount-$total_charge); 
			 		if($member_id>0){
			//	if($to_member_id>0){
				if($initial_amount>=$CONFIG_MIN_WITHDRAWL){
					if($LDGR['net_balance']>=$initial_amount ){
					    
					 
						if($model->checkUserPassword($member_id,$trns_password)>0){
						    if(true){
						//	if($to_member_id!=$member_id){
 $otp =$form_data['otp']; 
                $otp_mt  = $this->session->userdata('otp_mt'); 
                $this->session->unset_userdata('otp_mt');   
 
		if($f_wallet_id=='1'){
			    
			    $fwallet ='I-Wallet';
			    
			}elseif($f_wallet_id=='2'){
			    
			      $fwallet ='D-Wallet';
			}else{
			    
			     $fwallet ='A-Wallet';
			}
			
			
						$trans_no = UniqueId("TRNS_NO");
				
							$userid1 =$form_data['user_id'];
							$AR_MEM1 = $model->getnamebyuserid($userid1);
						
								$trns_remark = "$fwallet Transfer to [".$userid1."][".$AR_MEM1."]";
						$to_member_id =$member_id;
					
								$data = array(
								    "to_member_id"=>$to_member_id,
									"from_member_id"=>$member_id,
									"trans_no"=>$trans_no,
									"wallet_id"=>'3',
									"initial_amount"=>$initial_amount,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>($WITDRAW_FEE)? $WITDRAW_FEE:0,
									"process_fee"=>0,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"C",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"Transfer",
									"draw_type"=>"TRANSFER",
									"processor_id"=>'0',
									"trns_remark"=>$trns_remark,
								);
								
							
							
								
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
								$model->wallet_transaction($f_wallet_id,"Dr",$member_id,$initial_amount,$trns_remark,$trns_date,$trans_no,"1","TRANSFER");
								$userid = $AR_MEM['user_id'];
								
			if($f_wallet_id=='1'){
			    
		   $twallet ='I-Wallet';
			    
			}else{
			    
			     $twallet ='D-Wallet';
			}
								
									$AR_MEM1 = $model->getnamebyuserid($userid);
							
								$trns_remark = "Recieve FROM $twallet [".$userid."][".$AR_MEM1."]";
								//$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer_wallet",$data1);
								$model->wallet_transaction($t_wallet_id,"Cr",$to_member_id,$trns_amount,$trns_remark,$trns_date,$trans_no,"1","TRANSFER");
								
								set_message("success","You have successfully Transfer in  A-wallet $userid1");
								
								
								//set_message("success","Please verify OTP from your registered email address");
							 redirect_member("dashboard","index",""); 
							}else{
								set_message("warning","You cannot send fund to your own id");
								redirect_member("dashboard","index","");
							}
						}else{
							set_message("warning","Invalid login password, please try again");
							redirect_member("dashboard","index","");
						}
					}else{
						set_message("warning","It seem  you have low balance to transfer fund");
						redirect_member("dashboard","index","");
					}
				}else{
					set_message("warning","Enter the amount over and above  ".$CONFIG_MIN_WITHDRAWL."");
					redirect_member("dashboard","index","");
				}
			}else{
				set_message("warning","Invalid member id , please enter valid");
				redirect_member("dashboard","index","");
			}
                }else{
                  //  sleep(5);
				set_message("warning","Invalid security error please try again!");
				redirect_member("dashboard","index","");
			}
		
}
else{ 
		      
		    set_message("warning","Unable to transfer now . Please try some time later.");
		    redirect_member("dashboard","index","");
		  }
		}
         $data['web_title'] = 'Wallet Transfer';
		$this->load->view(MEMBER_FOLDER.'/ewallet/ewallettransfer',$data);
	}

	
	public function requestfund(){		
		$model = new OperationModel();
	
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = $this->OperationModel->getWallet(WALLET1);

		$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_FUND_TRANSFER");
		$today_date = getLocalTime();
		$AR_MEM = $model->getMember($member_id);
	
		
		if($form_data['submitFundRequest']==1 && $this->input->post()!=''){

		    
		  //  PrintR($form_data);die;
		        $trns_password = FCrtRplc($form_data['trns_password']);
				$initial_amount = FCrtRplc($form_data['initial_amount']);
				$trns_remark = FCrtRplc($form_data['trns_remark']);
					$mode = FCrtRplc($form_data['mode']);
				$typeCoin   = FCrtRplc($form_data['typeCoin']);
			    	$trn_hascode   = FCrtRplc($form_data['trn_hascode']);	
			    		$deposit_date  = FCrtRplc($form_data['deposit_date']);	
			 	$trns_date = $today_date;
				$wallet_id = FCrtRplc($form_data['wallet_id']);	
                $url = "requestfund/".$typeCoin;
                 $checktrn_hascode=  $model->checksuccesshashcode($trn_hascode,$member_id);
                  $checktrn_hascode1=  $model->checkpendinghashcode($trn_hascode,$member_id);
                	if($checktrn_hascode<1){
                	    
                	 if($checktrn_hascode1<1){
                	    
                	    
                	    
                     
                     
                 }else{
                    	set_message("warning","This Hash No Already Verify with Other User Id");
					redirect_member("ewallet",$url);   
                     
                     
                 }   
                	    
                     
                     
                 }else{
                    	set_message("warning","This Hash No Already Verify with Other User Id");
					redirect_member("ewallet",$url);   
                     
                     
                 }
                
                
                
                
                
                
                
                
                
                
                
				if($initial_amount>=$CONFIG_MIN_WITHDRAWL){
				
						if($model->checkOldPassword($member_id,$trns_password)>0){
					
							$photo ='';
						if($_FILES['uploadfile']['error']=="0"){
				$ext = explode(".",$_FILES['uploadfile']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/requestfile/".$photo;
				move_uploaded_file($_FILES['uploadfile']['tmp_name'], $target_path);
					}
					else
					{
					 	set_message("warning","Invalid File Format Please Upload png || gif || jpeg || jpg");
						redirect_member("ewallet",$url);   
					}
						}
			
					
								$data = array(
								    "member_id"=>$member_id,
								    "user_id"=>$AR_MEM['user_id'],
									"request_amount"=>$initial_amount,
									"remark"=>$trns_remark,
									"files"=>$photo,
										"mode"=>$mode,
									"trn_hascode"=>$trn_hascode,
									"deposit_date"=>$deposit_date,
									"wallet_id" =>3,
									"cointype" =>$typeCoin,
									"date_time"=>$trns_date
									
								);
													
							
						
								$transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_request",$data);
								set_message("success","You request has been send successfully please wait...");
								redirect_member("ewallet",$url);  
						
						}else{
							set_message("warning","Invalid user password, please try again");
						redirect_member("ewallet",$url);  
						}
				
				}else{
					set_message("warning","Enter the amount over and above  ".$CONFIG_MIN_WITHDRAWL." Rs ");
					redirect_member("ewallet",$url);  
				}
		
		}
	
		
		$this->load->view(MEMBER_FOLDER.'/ewallet/fundrequest',$data);
	}


	
	
	
	
}
