<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){
	  //Call the Model constructor
	   parent::__construct();
	   // $this->load->library('parser');
	   // $this->load->view('captcha/securimage');
	   
	}
	
	
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
	 
	 
	 function tessstemail(){
	     
	     $this->load->library('email');

$this->email->from('noreply@rndgroups.com', 'Ben');
$this->email->to('#','kingvrx6@gmail.com','kingvrx6@gmail.com');

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

$this->email->send(); 
	 }
	 
	 function getlivecryptoprice() {
        
        $url = 'https://api.wazirx.com/sapi/v1/ticker/24hr?symbol=trxusdt';
$json = file_get_contents($url);
$jo = json_decode($json);
echo $jo->openPrice;
        
    }
	 public function checkSMSSSSVCBT()
	 {
            $model = new OperationModel();
             $message ="Your Wallet has been credit Rs. Crypto Withdrawal successfully";
            $mobile  ="9310357623";
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
                      
                 
 
    if($AR_RT['net_balance'] > 0){
   
 	 $message=urlencode($message);
 	$parameters="AuthKey=ee3d77-afc3b3-0b2dc4-e1a463-a8470f&SenderId=TDCOIN&MobileNo=$mobile&Message=$message&route=1&type=text&tempid=1207161926229659032"; // ragistration
       
	$url="https://app.jetmsg.in/api/v1/sendsms.php";
    $ch = curl_init($url);
    $method ='POST';
	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
		
	$trans_no = UniqueId("TRNS_NO");    
	$remark = 'Ragistration';    
	$model->smswallet_transaction('25',"Dr",1,'1',$remark,$today_date,$trans_no,1,'Elite');
		
	}
	else
	{
		$get_url=$url."?".$parameters;
		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
  
  
									}
  
   
	 }
 	public function check_user()
	{
	    $model = new OperationModel();
	    $mem_id =  $this->input->post('mem');
	    $res = $model->checkMemberIdexists($mem_id); //
	    if(isset($res))
	    {
	        $data = $res['first_name'];
	   //   $data['name'] = $res['first_name'];
	      //$data['price'] = $res['prod_pv'];
	     // $data['date'] = $res['date_from'];
	    }
	    else
	    {
	        $data= "Invalid Member Id..."; 
           // $data['name'] = "Invalid Member Id..."; 
            //$data['price'] ='0';
           // $data['date'] = 'YYYY-MM-DD';
	       
	    }
	      echo strtoupper("$data");
	   // echo json_encode($data);
	    
	}
	 	 	public function check_users()
	{
	    $model = new OperationModel();
	    $mem_id =  $this->input->post('mem');
	    $res = $model->checkMemberIdexists($mem_id); //
	    if(isset($res))
	    {
	      $data['name'] = $res['first_name'];
	      $data['price'] = $res['prod_pv'];
	      $data['date'] = $res['date_from'];
	    }
	    else
	    {
	       
            $data['name'] = "Invalid Member Id..."; 
            $data['price'] ='0';
            $data['date'] = 'YYYY-MM-DD';
	       
	    }
	     
	    echo json_encode($data);
	    
	}
		function testemaillllllllllll(){
			$model = new OperationModel();
			$user_id='123456';
			$user_password='12987654321';
		$message ="Dear User, Welcome to ".$model->getValue("CONFIG_COMPANY_NAME")." Earn Unlimited money with us.\n Your User ID:".$user_id."and Password: ".$user_password."".$model->getValue("CONFIG_COMPANY_NAME")." & Team";
  
 	//$model->massagesend($mobile,$message); 							 	
//	$email = d';
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
 echo   $message2  =  '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
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
  <div style="display:none;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">  Welcome to '.$model->getValue("CONFIG_COMPANY_NAME").' </div>
  <div style="background-color: #ffffff;">
   
    <div style="margin:0px auto;max-width:600px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:center;">
        
            </td>
          </tr>
        </tbody>
      </table>
    </div>
   
    <div style="margin:0px auto;max-width:600px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
           
              <div style="background:#ffffff;background-color:#ffffff;margin:0px auto;border-radius:8px 8px 0 0;max-width:600px;">
                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;border-radius:8px 8px 0 0;">
                  <tbody>
                    <tr>
                      <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:center;">
          
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
                      <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0px;text-align:center;">
              
                        <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                          
                            <tr>
                              <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                <div style="font-family:Quattrocento;font-size:18px;font-weight:400;line-height:24px;text-align:left;color:#000000;">
                                  <h1 style="margin: 0; font-size: 32px; line-height: 40px; font-weight: 700;">Welcome to '.$model->getValue("CONFIG_COMPANY_NAME").'!</h1>
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                <div style="font-family:Quattrocento;font-size:18px;font-weight:400;line-height:24px;text-align:left;color:#000000;">I would like to welcome you to '.$model->getValue("CONFIG_COMPANY_NAME").' Company personally. It has been a pleasure to be able to talk to
you about our products and business plan.<br></div>
                              </td>
                            </tr>
                            <tr>
                              <td align="left" style="font-size:0px;padding:10px 25px;">
                                <div style="font-family:Quattrocento;font-size:18px;font-weight:400;line-height:24px;text-align:left;color:#000000;">It is a tremendous honor for us to be working with you.
We are looking forward to doing more business deals with you.we discussed during our meeting, it can be increased as per our need.
We are very happy to see you with us.<br />
your ragistraion detail is here</div>
                              </td>
                            </tr>
                          <tr>
                              <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                <div style="font-family:Quattrocento;font-size:16px;font-weight:400;line-height:24px;text-align:center;color:#333333;">
                                  
                                  Username :- '.$user_id.' <br>
                                  Passowrd :-  '.$user_password.'<br>
                                     Domain :- '.$model->getValue("CONFIG_WEBSITE").'<br>

                                </div>
                              </td>

                            </tr>
                                <tr>
                              <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                <div style="font-family:Quattrocento;font-size:16px;font-weight:400;line-height:24px;text-align:center;color:#333333;"> <a href="'.BASE_PATH.emailyverify.'/'.index.'/'._e($user_id).'" style="color: #428dfc; text-decoration: none; font-weight: bold;">Verify Your Account </a></div>
                              </td>
                            </tr>
                            
                            <tr>
                              <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                <div style="font-family:Quattrocento;font-size:16px;font-weight:400;line-height:24px;text-align:center;color:#333333;">Have questions or need help? Email us at <a href="#" style="color: #428dfc; text-decoration: none; font-weight: bold;"> '.$model->getValue("CONFIG_CMP_EMAIL").' </a></div>
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
                      <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
           
                        <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                          <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody><tr>
                              <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                <div style="font-family:Quattrocento;font-size:16px;font-weight:400;line-height:24px;text-align:center;color:#333333;">
                                  <a class="footer-link" href="#" style="text-decoration: none; color: #000; font-weight: 400;">Home</a>   |  
                                   <a class="footer-link" href="#" style="text-decoration: none; color: #000; font-weight: 400;">Our Identity</a>   |  
                                   <a class="footer-link" href="#" style="text-decoration: none; color: #000; font-weight: 400;">Contact</a>   |  
                                   <a class="footer-link" href="#" style="text-decoration: none; color: #000; font-weight: 400;">Log In</a>
                                 </div>
                              </td>
                            </tr>
                            <tr>
                             
                            </tr>
                            <tr>
                              <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
     
                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                                  <tbody><tr>
                                    <td style="padding:4px;">
                                      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-radius:3px;width:24px;">
                                        <tbody><tr>
                                          <td style="font-size:0;height:24px;vertical-align:middle;width:24px;">
                                            <a href="#" target="_blank" style="color: #428dfc; text-decoration: none; font-weight: bold;">
                                              <img alt="twitter-logo" height="24" src="https://codedmails.com/images/social/black/twitter-logo-transparent-black.png" style="border-radius:3px;display:block;" width="24" />
                                            </a>
                                          </td>
                                        </tr>
                                      </tbody></table>
                                    </td>
                                  </tr>
                                </tbody></table>
                       
                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                                  <tbody><tr>
                                    <td style="padding:4px;">
                                      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-radius:3px;width:24px;">
                                        <tbody><tr>
                                          <td style="font-size:0;height:24px;vertical-align:middle;width:24px;">
                                            <a href="#" target="_blank" style="color: #428dfc; text-decoration: none; font-weight: bold;">
                                              <img alt="facebook-logo" height="24" src="https://codedmails.com/images/social/black/facebook-logo-transparent-black.png" style="border-radius:3px;display:block;" width="24" />
                                            </a>
                                          </td>
                                        </tr>
                                      </tbody></table>
                                    </td>
                                  </tr>
                                </tbody></table>
            
                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                                  <tbody><tr>
                                    <td style="padding:4px;">
                                      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-radius:3px;width:24px;">
                                        <tbody><tr>
                                          <td style="font-size:0;height:24px;vertical-align:middle;width:24px;">
                                            <a href="#" target="_blank" style="color: #428dfc; text-decoration: none; font-weight: bold;">
                                              <img alt="instagram-logo" height="24" src="https://codedmails.com/images/social/black/instagram-logo-transparent-black.png" style="border-radius:3px;display:block;" width="24" />
                                            </a>
                                          </td>
                                        </tr>
                                      </tbody></table>
                                    </td>
                                  </tr>
                                </tbody></table>
               
                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;">
                                  <tbody><tr>
                                    <td style="padding:4px;">
                                      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-radius:3px;width:24px;">
                                        <tbody><tr>
                                          <td style="font-size:0;height:24px;vertical-align:middle;width:24px;">
                                            <a href="#" target="_blank" style="color: #428dfc; text-decoration: none; font-weight: bold;">
                                              <img alt="dribbble-logo" height="24" src="https://codedmails.com/images/social/black/linkedin-logo-transparent-black.png" style="border-radius:3px;display:block;" width="24" />
                                            </a>
                                          </td>
                                        </tr>
                                      </tbody></table>
                                    </td>
                                  </tr>
                                </tbody></table>
             
                              </td>
                            </tr>
                            <tr>
                              <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                <div style="font-family:Quattrocento;font-size:16px;font-weight:400;line-height:24px;text-align:center;color:#333333;">Update your <a class="footer-link" href="https://google.com" style="text-decoration: none; color: #000; font-weight: 400;">email preferences</a> to choose the types of emails you receive, or you can <a class="footer-link" href="https://google.com" style="text-decoration: none; color: #000; font-weight: 400;"> unsubscribe </a>from all future emails.</div>
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
                      <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                  
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
</html>';
	
//	die('ddd');


$dt['first_name'] = $first_name; 
$dt['today_date'] = $today_date; 
$dt['user_id'] = $user_id; 
$dt['user_password'] = $user_password; 

           $this->session->set_flashdata('messageRegister',$dt);
         $subject="Forgot Password";
         $message=$message2;
          $this->email->from($model->getValue("CONFIG_SYSTEM_LOGIN"));
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
          if($this->email->send())
         {
                	
                  echo "<script type='text/javascript'>alert('Email Send Success');</script>";
         }
         else
        {
         //show_error($this->email->print_debugger());
        }
 
  
	}
 	function testemail(){
			$model = new OperationModel();
			$user_id='123456';
			$user_password='12987654321';
		$message ="Dear User, Welcome to ".$model->getValue("CONFIG_COMPANY_NAME")." Earn Unlimited money with us.\n Your User ID:".$user_id."and Password: ".$user_password."".$model->getValue("CONFIG_COMPANY_NAME")." & Team";
  $amount=123456;
 	//$model->massagesend($mobile,$message); 							 	
//	$email = d';
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
 echo   $message2 = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  
    <style type="text/css">
      a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_2 .v-src-width { width: 350px !important; } #u_content_image_2 .v-src-max-width { max-width: 42% !important; } #u_content_heading_3 .v-font-size { font-size: 22px !important; } #u_content_text_7 .v-container-padding-padding { padding: 0px 120px 20px 15px !important; } #u_content_button_1 .v-container-padding-padding { padding: 10px 10px 30px !important; } #u_content_button_1 .v-padding { padding: 13px 40px !important; } #u_content_divider_1 .v-container-padding-padding { padding: 50px !important; } }
@media only screen and (min-width: 570px) {
  .u-row {
    width: 550px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-100 {
    width: 550px !important;
  }

}

@media (max-width: 570px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: calc(100% - 40px) !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors="true"] {
  color: inherit !important;
  text-decoration: none !important;
}

</style>
  
<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">

</head>

<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff">

  <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
  <tbody>
  <tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">

    

<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
   
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:"Cabin",sans-serif;" align="left">
        
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
      <img align="center" border="0" src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 208px;" width="208" class="v-src-width v-src-max-width"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #51a60d;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  <br>
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 15px;font-family:"Cabin",sans-serif;" align="left">
        
  

      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 15px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 20px; line-height: 32px;"><strong>Withdrawal Successful</strong></span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-image: url("https://cdn.templates.unlayer.com/assets/1620123209967-Untitled1.gif");background-repeat: no-repeat;background-position: center top;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #51a60d;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
<table id="u_content_image_2" style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Cabin",sans-serif;" align="left">
        
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
      <img align="center" border="0" src="https://cdn.templates.unlayer.com/assets/1620123323348-cc.gif" alt="Check" title="Check" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 24%;max-width: 127.2px;" width="127.2" class="v-src-width v-src-max-width"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #51a60d;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
  
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 15px 25px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 160%;">Your withdrawal of $ '.$amount.' has been processed successfully<br>Please Check Your Wallet</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>



 </div>
  </div>
</div>

    </div>
  </div>
</div>


<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
     
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">


</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-image: url("https://cdn.templates.unlayer.com/assets/1620124623453-vv.png");background-repeat: no-repeat;background-position: center top;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">




      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">



      </td>
    </tr>
  </tbody>
</table>





</body>

</html>
';	
	
	
//	die('ddd');


$dt['first_name'] = $first_name; 
$dt['today_date'] = $today_date; 
$dt['user_id'] = $user_id; 
$dt['user_password'] = $user_password; 

           $this->session->set_flashdata('messageRegister',$dt);
         $subject="Forgot Password";
         $message=$message2;
          $this->email->from($model->getValue("CONFIG_SYSTEM_LOGIN"));
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
        //   if($this->email->send())
        //  {
                	
        //           echo "<script type='text/javascript'>alert('Email Send Success');</script>";
        //  }
        //  else
        // {
        //  //show_error($this->email->print_debugger());
        // }
 
  
	}
 
	public function register(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(1);
		$today_date = InsertDate(getLocalTime());
		$spr_user_id  = FCrtRplc($segment['register']);

	//	$img = new Securimage();
					
		if($form_data['submitRegisterMember']==1 && $this->input->post()!=''){
			$valid = $img->check($_POST["captcha_code"]);
  			if($valid == true) {
				$first_name = FCrtRplc($form_data['first_name']);
				$last_name = FCrtRplc($form_data['last_name']);
				$member_email = FCrtRplc($form_data['member_email']);
				$user_password = FCrtRplc($form_data['user_password']);
				
				$country_code = FCrtRplc($form_data['country_code']);
				$mobile_code =  $model->getMobileCode($form_data['country_code']);
				$member_mobile = FCrtRplc($form_data['member_mobile']);
				$user_name  = $model->generateUserId();

				if($first_name!='' && $member_email!=''){
					$left_right = FCrtRplc($form_data['left_right']);
					$sponsor_id = $model->getMemberId($form_data['spr_user_id']);
					
					$AR_GET = $model->getSponsorSpill($sponsor_id,$left_right);
					if($left_right=='AUTO'){
						$AR_GET = $model->getOpenPlace($sponsor_id);
						$left_right = $AR_GET['left_right'];
					}
					$spil_id =  FCrtRplc($AR_GET['spil_id']);
					$user_id  = $model->generateUserId();
					
					if($sponsor_id>0 && $spil_id>0){
						if(strlen($first_name)>=3 && strlen($last_name)>=3){
							if($model->checkCount(prefix."tbl_members","member_email",$member_email)==0){
									$Ctrl += $model->CheckOpenPlace($spil_id,$left_right);
									$data = array("first_name"=>$first_name,
										"last_name"=>$last_name,
										"user_id"=>$user_id,
										"user_name"=>$user_id,
										"user_password"=>$user_password,
										"member_email"=>$member_email,
										"sponsor_id"=>$sponsor_id,
										"spil_id"=>$spil_id,
										"left_right"=>$left_right,
										"country_code"=>$country_code,
										"mobile_code"=>$mobile_code,
										"member_mobile"=>$member_mobile,
										"date_join"=>$today_date,
										"pan_status"=>"N",
										"status"=>"Y",
										"last_login"=>$today_date,
										"login_ip"=>$_SERVER['REMOTE_ADDR'],
										"block_sts"=>"N",
										"sms_sts"=>"N",
										"package_id"=>1,
										"upgrade_date"=>$today_date
									);		
									if($member_id>0){
										$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
										set_message("success","Successfully updated  detail");
										redirect_member("member","",array("member_id"=>_e($member_id)));
									}else{
										if($Ctrl==0){
											$member_id = $this->SqlModel->insertRecord(prefix."tbl_members",$data);
												$tree_data = array("member_id"=>$member_id,
												"sponsor_id"=>$sponsor_id,
												"spil_id"=>$spil_id,
												"nlevel"=>0,
												"left_right"=>$left_right,
												"nleft"=>0,
												"nright"=>0,
												"date_join"=>$today_date
												);
												$this->SqlModel->insertRecord(prefix."tbl_mem_tree",$tree_data);
												$model->updateTree($spil_id,$member_id);
												
												$this->session->set_userdata('mem_id',$member_id);
												$this->session->set_userdata('user_id',$user_name);
											$AR_MAIL['member_id']=$member_id;
											Send_Mail($AR_MAIL,"EMAIL_VERIFY");
											redirect(BASE_PATH."userpanel");
										}else{
											set_message("warning","Failed , unable to process your request , please try again");
										}
									}
							}else{
								set_message("warning","This email address is already used, please recover your password");
							}
						}else{
							set_message("warning","Invalid first name or last name, Minimum 3 character is required");
						}
					}else{ set_message("warning","Invalid sponsor id, please eneter valid id"); }
				}else{
					set_message("warning","Failed , unable to process your request , please try again");
				}
			}else{
				set_message("warning","Invalid security code, please try again");
			}
		}
		$AR_META['page_title']="Register an account";
		$data['META'] = $AR_META;
		$this->load->view('register',$data);
	}
	
	function login(){
		
		$this->load->view('login',$data);
	}
	
	function loginhandler(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
	//	$img = new Securimage();
		if($form_data['loginMember']!='' && $this->input->post()!=''){
			$user_name_login = FCrtRplc($form_data['user_name_login']);
			$user_password_login  = FCrtRplc($form_data['user_password_login']);
			
			$valid = $img->check($_POST["captcha_code"]);
  			if($valid == true) {
			$Q_MEM = "SELECT * FROM ".prefix."tbl_members WHERE (user_id='".$user_name_login."' OR user_name='".$user_name_login."' OR member_email='".$user_name_login."') AND 
			user_password='$user_password_login'	AND delete_sts>0";
			$fetchRow = $this->SqlModel->runQuery($Q_MEM,true);
				if($fetchRow['member_id']>0){
					$this->session->set_userdata('mem_id',$fetchRow['member_id']);
					$this->session->set_userdata('user_id',$fetchRow['user_id']);
					redirect(BASE_PATH."userpanel");
				}else{
					set_message("warning","Invalid username and password");
					redirect_front("user","login",array()); 
				}
			}else{
				set_message("warning","Invalid security code, please try again");
				redirect_front("user","login",array()); 
			}
		}
	}
	
		  public function checkuserid()      {
	$model = new OperationModel();
	$user_id =  $this->input->post('userId');
	$userId = $model->getMemberIdexist($user_id);
	if($userId > 0)
	{
	echo "1";
	}
	else
	{
	echo "0";
	}
	}
	public function forgotpassword(){
		$model = new OperationModel();
		//$img = new Securimage();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(1);
			$CONFIG_COMPANY_NAME = $model->getValue("CONFIG_COMPANY_NAME");	
		
		if($form_data['submitMember']==1 && $this->input->post()!=''){
			$user_name = FCrtRplc($form_data['user_name']);
// 			$valid = $img->check($form_data["captcha_code"]);
  			if(true) {
				$Q_MEM = "SELECT * FROM ".prefix."tbl_members WHERE ( member_email = '".$user_name."' OR user_id ='".$user_name."' 
				OR user_name ='".$user_name."'  )  AND user_password!=''  AND delete_sts>0";
				$fetchRow = $this->SqlModel->runQuery($Q_MEM,true);
				$member_id = $fetchRow['member_id'];
				$m_user_id = $fetchRow['user_id'];
				if($member_id>0){
				
		$mobile    = $fetchRow['member_mobile'];
	$email    = $fetchRow['member_email'];
	$username    = $fetchRow['user_name'];
	$password    = $fetchRow['user_password'];	
	
		$message_mobile="Password ! Your Password is : ".$password." . Thank You Regard $CONFIG_COMPANY_NAME  & Team";
	 
//	$email = $member_email;



             				  $first_name     = $fetchRow['first_name'];  
        				  $today_date     = $fetchRow['date_join'];  
        				  $user_id        = $fetchRow['user_id'];  
        				  $user_password  = $fetchRow['user_password'];  
        				  $email          =  $fetchRow['member_email'];  
			
	     
            

$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
  $message2 = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  
    <style type="text/css">
      a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_2 .v-src-width { width: 350px !important; } #u_content_image_2 .v-src-max-width { max-width: 42% !important; } #u_content_heading_3 .v-font-size { font-size: 22px !important; } #u_content_text_7 .v-container-padding-padding { padding: 0px 120px 20px 15px !important; } #u_content_button_1 .v-container-padding-padding { padding: 10px 10px 30px !important; } #u_content_button_1 .v-padding { padding: 13px 40px !important; } #u_content_divider_1 .v-container-padding-padding { padding: 50px !important; } }
@media only screen and (min-width: 570px) {
  .u-row {
    width: 550px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-100 {
    width: 550px !important;
  }

}

@media (max-width: 570px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: calc(100% - 40px) !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors="true"] {
  color: inherit !important;
  text-decoration: none !important;
}

</style>
  
<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">

</head>

<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff">

  <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
  <tbody>
  <tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">

    

<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
   
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:"Cabin",sans-serif;" align="left">
        
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
      <img align="center" border="0" src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 208px;" width="208" class="v-src-width v-src-max-width"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>


   



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #cbfaa6;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
     
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
 <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:25px 10px 10px;font-family:"Cabin",sans-serif;" align="left">
     <div style="color: #21a70a; line-height: 140%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 30px; line-height: 140%;"><span style="line-height: 22.4px;">  Your account detail is </span></p>
  </div>   
 
      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 5px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #6e7172; line-height: 140%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 16px; line-height: 22.4px;"> USERNAME : '.$user_id.'</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 25px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #6e7172; line-height: 140%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 16px; line-height: 22.4px;">PASSWORD : '.$user_password.'</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>
<div align="center">

    <a href="'.BASE_PATH.'" target="_blank" style="-webkit-box-shadow: none;  box-shadow: none; font-size: 14px; display: inline-block; font-family:  Poppins , sans-serif; font-weight: 400; color: #535f6b; text-align: center; vertical-align: middle; user-select: none; background-color: transparent; border: 1px solid transparent;   border-radius: 8px; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;  color: #fff; background-color: #05bbc9; border-color: #05bbc9; line-height: 16.8px;">
      <span class="v-padding" style="display:block;padding:13px 30px;line-height:120%;"><span style="font-size: 14px; line-height: 16.8px;">Login Link</span></span>
    </a>

</div>
 </div>
  </div>
</div>

    </div>
  </div>
</div>

<br>
<br>
<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
     
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Cabin",sans-serif;" align="left">
        
  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-image: url("https://cdn.templates.unlayer.com/assets/1620124623453-vv.png");background-repeat: no-repeat;background-position: center top;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:"Cabin",sans-serif;" align="left">
        
  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>



      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">

<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  


<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #d1e122; line-height: 140%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;">'.$model->getValue("CONFIG_WEBSITE").'</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px;font-family:"Cabin",sans-serif;" align="left">
        
  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #ced4d9;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #888888; line-height: 180%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 180%;">If you have questions regarding your data, please visit our Privacy Policy</p>
<p style="font-size: 14px; line-height: 180%;">Want to change how you receive these emails? You can update your preferences or unsubscribe from this list.</p>
<p style="font-size: 14px; line-height: 180%;"><span style="font-size: 12px; line-height: 21.6px;">&copy; '.date("Y").' Company. All Rights Reserved.</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>

    </td>
  </tr>
  </tbody>
  </table>

</body>

</html>
';	
	
//	die('ddd');
$member_email = $fetchRow['member_email'];

 
		$apiKey = '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';
$fromEmail = 'noreply@rndgroups.com';
 $subject="Forgot Password";

$url = 'https://api.sendinblue.com/v3/smtp/email';

$data = array(
    'sender' => array(
        'name' => 'rndgroups.com',
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
} else {
  // echo 'Email could not be sent.';
}
		
				
				$mobile= str_pad(substr($mobile, 6), strlen($mobile), "*", STR_PAD_LEFT);
$email= str_pad(substr($email, 3), strlen($email), "*", STR_PAD_LEFT);
                	set_message("success","Message sent successfully registered mail id :- $email");
					redirect_front("user","login",array());
					
				}else{
					set_message("warning","Email not found, please enter valid email address");
					redirect_front("user","forgotpassword",array()); 
				}
			}else{
				set_message("warning","Invalid security code, please try again");
				redirect_front("user","forgotpassword",array()); 
			}
		}
		$AR_META['page_title']="Recover your password";
		$data['META'] = $AR_META;
		$this->load->view('forgotpassword',$data);
	}
	
	public function loginuser(){
	    SESSION_START();
	    //$_SESSION['CAPTCHA_CODE'];
		$user_name_login = $this->input->get("user_name_login");
		$user_password_login = $this->input->get("user_password_login");
			$captcha = $this->input->get("captcha");
				$captcha1 = $this->input->get("captcha1");
//	$user_name_login = 	mysql_real_escape_string($user_name_login);
//	$user_password_login = 	mysql_real_escape_string($user_password_login);
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
				    //	if(true) {
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
				//	$AR_RT['ErrorDtl']="Please Verify Your Email ! <a href='javascript:void(0)' onclick='resendMails(`"._e($user_name)."`)' >click to resend... </a>";
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
	
	public function registerajaxold(){
		$model = new OperationModel();
		$form_data = $this->input->get();		
		$segment = $this->uri->uri_to_assoc(2);
		$time_stamp = getLocalTime();
		$today_date = InsertDate($time_stamp);
		$spr_user_id  = FCrtRplc($segment['register']);
					
      //$this->session->set_userdata('sss',$form_data);  die;
	// $form_data =  $this->session->userdata('sss'); PrintR($form_data);
	
	// die('dd');												
		if($form_data['user_id']!='' && $this->input->get()!=''){
			    $first_name = FCrtRplc($form_data['first_name']);
				//$last_name = FCrtRplc($form_data['last_name']);
				   $member_email = FCrtRplc($form_data['member_email']);
				$user_password = FCrtRplc($form_data['user_password']);
				$trns_password = FCrtRplc($form_data['trns_password']);
			    $state_name = FCrtRplc($form_data['state_name']);
				$country_code = FCrtRplc($form_data['country_code']);
				$city_name = FCrtRplc($form_data['city_name']);
				$mobile_code =  $model->getMobileCode($form_data['country_code']);
				$member_mobile = FCrtRplc($form_data['phone']);
				$member_phone = FCrtRplc($form_data['full']);
				$type_id = FCrtRplc($form_data['type_id']);
				$user_id  =  FCrtRplc($form_data['user_id']);
				$user_name = FCrtRplc($form_data['user_name']);
			    $title = FCrtRplc($form_data['title']);
				$pin_code = FCrtRplc($form_data['pin_code']);
				$gender = FCrtRplc($form_data['gender']);
		$type_id = FCrtRplc($form_data['type_id']);
		$no_pin= FCrtRplc($form_data['activePin']);
		$pin_key= FCrtRplc($form_data['activeKey']);
				   

				$left_right = FCrtRplc($form_data['left_right']);
				
				if($first_name!='' || $left_right!=''){
					$sponsor_id = $model->getMemberId($form_data['spr_user_id']);
					$AR_GET = $model->getSponsorSpill($sponsor_id,$left_right);
					
					if($left_right=='AUTO'){
						$AR_GET = $model->getOpenPlace($sponsor_id);
						$left_right = $AR_GET['left_right'];	
					}
					 
					$spil_id =  FCrtRplc($AR_GET['spil_id']);
					if($sponsor_id>0 && $spil_id>0){
						 
					 if($model->checkCount(prefix."tbl_members","user_id",$user_id)==0){

	     /*  if($model->checkCount(prefix."tbl_members","member_email",$member_email)==0){*/

				// 		if($no_pin!='' && $pin_key!=''){
				// 	$AR_PIN = $model->getPinDetail($no_pin,$pin_key);
				// 	if($model->checkPinActivation($AR_PIN['mstr_id'],$AR_PIN['type_id'])==0){
					 
				// 		if($AR_PIN['block_sts']=="N"){
				// 		if($AR_PIN['pin_sts']=="N" && $AR_PIN['use_member_id']==0){




									$Ctrl += $model->CheckOpenPlace($spil_id,$left_right);
									$data = array(
									    "first_name"=>$first_name,
										"full_name"=>$first_name,
										"user_id"=>$user_id,
										"user_name"=>$user_id,
										"user_password"=>$user_password,
										"trns_password"=>$trns_password,
										"member_email"=>$member_email,
									    "title" => $title,
									    "state_name"=>$state_name,
									    "city_name"=>$city_name,
				                        "pin_code"  =>$pin_code,
				                        "gender" =>$gender,
										"sponsor_id"=>$sponsor_id,
										"spil_id"=>$spil_id,
										"left_right"=>$left_right,
										"country_code"=>$country_code,
										"mobile_code"=>"+91",
										"member_phone" => $member_phone,
										"member_mobile"=>$member_mobile,
										"date_join"=>$time_stamp,
										"pan_status"=>"N",
										"status"=>"Y",
										"last_login"=>$time_stamp,
										"login_ip"=>$_SERVER['REMOTE_ADDR'],
										"block_sts"=>"N",
										"sms_sts"=>"N",
										"package_id"=>1,
										"type_id"=>0,
										"upgrade_date"=>$time_stamp
									);	

									if($Ctrl==0){
										 	$member_id = $this->SqlModel->insertRecord(prefix."tbl_members",$data);
											$tree_data = array("member_id"=>$member_id,
												"sponsor_id"=>$sponsor_id,
												"spil_id"=>$spil_id,
												"nlevel"=>0,
												"left_right"=>$left_right,
												"nleft"=>0,
												"nright"=>0,
												"date_join"=>$today_date
											);
											$this->SqlModel->insertRecord(prefix."tbl_mem_tree",$tree_data);
											$model->updateTree($spil_id,$member_id);
											
											
											
											//	$model->updatePinDetail($AR_PIN['pin_id'],$member_id);	
								 
									    $AR_RT['mem_id']=$user_id;
										$AR_RT['pass']=$user_password;
										$AR_RT['UserName_model']=$first_name;
										$AR_RT['UserID_model']=$user_id;
										$AR_RT['UserPass_model']=$user_password;
										$AR_MAIL['member_id']=$member_id;
										$AR_RT['newUserId'] = $model->generateUserId();
											/*$AR_RT['ErrorDtl']="You have successfully register !  ";*/
											$AR_RT['ErrorDtl']="Username:'.$user_id.' Password:'.$user_password.'";
											$AR_RT['ErrorMsg']="success";
											$mobile = $member_mobile;
											
		$message ="Dear User, Welcome to ".$model->getValue("CONFIG_COMPANY_NAME")." Earn Unlimited money with us.\n Your User ID:".$user_id."and Password: ".$user_password."".$model->getValue("CONFIG_COMPANY_NAME")." & Team";
  
 	//$model->massagesend($mobile,$message); 							 	
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
  echo $message2 = '<html xmlns="http://www.w3.org/1999/xhtml">
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
                              <tbody>
                                <tr>
                                  <td class="header-row-td" width="1000" style="font-family: Arial, sans-serif;font-weight: normal;line-height: 19px;color: #478fca;margin: 0px;font-size: 18px;padding-bottom: 10px;padding-top: 15px;background: #615d5d;">
								  <img src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" width="400" height="150"  /></td>
                                </tr>
                              </tbody>
                            </table>
                            <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
<p style="color: black !important;">Date: '.$today_date.'<br />To,

User Name:- ['.$first_name.']<br />
User Id:- ['.$user_id.']<br />

Subject: Welcome Letter & Ragistration Detail<br />

Dear '.$first_name.',<br />

I would like to welcome you to '.$model->getValue("CONFIG_COMPANY_NAME").' Company personally. It has been a pleasure to be able to talk to
you about our products and business plan.<br>It is a tremendous honor for us to be working with you.
We are looking forward to doing more business deals with you.
we discussed during our meeting,<br> it can be increased as per our need.
We are very happy to see you with us.<br />
your registration detail is here

<br />
<strong style="color:#fd6218;">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Username:&nbsp;'.$user_id.'<br /></strong>
<strong style="color:#fd6218;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; Password:&nbsp;'.$user_password.'<br /></strong>
<p style="color: black !important;">Login URL:- '.$model->getValue("CONFIG_WEBSITE").'</p>
<br />

<p style="color: black !important;">Looking forward to a continuous and a fruitful business partnership with us.<br />

Regards,<br />
'.$model->getValue("CONFIG_COMPANY_NAME").'<br /></p>
<p style="color: black !important;">'.$model->getValue("CONFIG_CMP_EMAIL").'<br /></p>
'.$model->getValue("CONFIG_MOBILE_NO").'
</div></td>
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
         $subject="Welcome Letter";
         $message=$message2;
          $this->email->from($model->getValue("CONFIG_SYSTEM_LOGIN"));
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
          if($this->email->send())
         {
                	
                 
         }
         else
        {
         //show_error($this->email->print_debugger());
        }
 
 
  
	

										}
										
										else{
											$AR_RT['ErrorDtl']="Failed , unable to process your request , please try again";
											$AR_RT['ErrorMsg']="warning";
									 }


// }////
// 						else{
// 						$AR_RT['ErrorDtl']="This pin is already used by other member";
// 							$AR_RT['ErrorMsg']="warning";
// 						}
								
// 							}
// 						else{
// 						$AR_RT['ErrorDtl']="Sorry this pin is blocked, please contact our support team";
// 							$AR_RT['ErrorMsg']="warning";
// 						}			 
									 
								 
							 
// 						}
// 						else{
// 						$AR_RT['ErrorDtl']="Invalid  pin no, use  activation pin ";
// 							$AR_RT['ErrorMsg']="warning";
// 						}
// 						}

 /*}else{
					 	$AR_RT['ErrorDtl']="This Email  Id is already used";
					 	$AR_RT['ErrorMsg']="warning";
					 }*/

				 }else{
					 	$AR_RT['ErrorDtl']="This User Id is already used";
					 	$AR_RT['ErrorMsg']="warning";
					 }
						
					}else{ 
						$AR_RT['ErrorDtl']="Invalid sponsor id, please eneter valid id";
						$AR_RT['ErrorMsg']="warning";
					}
				}else{
					$AR_RT['ErrorDtl']="Failed , unable to process your request , please try again";
					$AR_RT['ErrorMsg']="warning";
				}
		}

		echo json_encode($AR_RT);
	}
	public function resendMail()
	{
	     $model = new OperationModel();
	     
	        $user_name =  _d($this->input->post('value'));
	     	$sel_query = $this->db->query("SELECT * FROM  tbl_members  WHERE ( user_name='".$user_name."' OR user_id = '".$user_name."'  )    ");  
       	
				$fetchRow = $sel_query->row_array();
				if($fetchRow['member_id']>0){
				    
        				  $first_name     = $fetchRow['first_name'];  
        				  $today_date     = $fetchRow['date_join'];  
        				  $user_id        = $fetchRow['user_id'];  
        				  $user_password  = $fetchRow['user_password'];  
        				  $email          =  $fetchRow['member_email'];  
			
	     
            
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
  $message2 = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  
    <style type="text/css">
      a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_2 .v-src-width { width: 350px !important; } #u_content_image_2 .v-src-max-width { max-width: 42% !important; } #u_content_heading_3 .v-font-size { font-size: 22px !important; } #u_content_text_7 .v-container-padding-padding { padding: 0px 120px 20px 15px !important; } #u_content_button_1 .v-container-padding-padding { padding: 10px 10px 30px !important; } #u_content_button_1 .v-padding { padding: 13px 40px !important; } #u_content_divider_1 .v-container-padding-padding { padding: 50px !important; } }
@media only screen and (min-width: 570px) {
  .u-row {
    width: 550px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-100 {
    width: 550px !important;
  }

}

@media (max-width: 570px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: calc(100% - 40px) !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors="true"] {
  color: inherit !important;
  text-decoration: none !important;
}

</style>
  
<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">

</head>

<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff">

  <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
  <tbody>
  <tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">

    

<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
   
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:"Cabin",sans-serif;" align="left">
        
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
      <img align="center" border="0" src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 208px;" width="208" class="v-src-width v-src-max-width"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>


   



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #cbfaa6;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
     
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
 <div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:25px 10px 10px;font-family:"Cabin",sans-serif;" align="left">
     <div style="color: #21a70a; line-height: 140%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 30px; line-height: 140%;"><span style="line-height: 22.4px;">  Your account detail is </span></p>
  </div>   
 
      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 5px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #6e7172; line-height: 140%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 16px; line-height: 22.4px;"> USERNAME : '.$user_id.'</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 25px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #6e7172; line-height: 140%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 16px; line-height: 22.4px;">PASSWORD : '.$user_password.'</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>
<div align="center">

    <a href="'.BASE_PATH.emailyverify.'/'.index.'/'._e($user_id).'" target="_blank" style="cursor: not-allowed; pointer-events: none; -webkit-box-shadow: none;  box-shadow: none; font-size: 14px; display: inline-block; font-family:  Poppins , sans-serif; font-weight: 400; color: #535f6b; text-align: center; vertical-align: middle; user-select: none; background-color: transparent; border: 1px solid transparent;   border-radius: 8px; transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;  color: #fff; background-color: #05bbc9; border-color: #05bbc9; line-height: 16.8px;">
      <span class="v-padding" style="display:block;padding:13px 30px;line-height:120%;"><span style="font-size: 14px; line-height: 16.8px;">Verify Email Account</span></span>
    </a>

</div>
 </div>
  </div>
</div>

    </div>
  </div>
</div>

<br>
<br>
<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
     
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Cabin",sans-serif;" align="left">
        
  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-image: url("https://cdn.templates.unlayer.com/assets/1620124623453-vv.png");background-repeat: no-repeat;background-position: center top;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:"Cabin",sans-serif;" align="left">
        
  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>



      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">

<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  


<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #d1e122; line-height: 140%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 140%;"><span style="font-size: 18px; line-height: 25.2px;">'.$model->getValue("CONFIG_WEBSITE").'</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 15px;font-family:"Cabin",sans-serif;" align="left">
        
  <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #ced4d9;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
    <tbody>
      <tr style="vertical-align: top">
        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
          <span>&#160;</span>
        </td>
      </tr>
    </tbody>
  </table>

      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:0px 10px 10px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #888888; line-height: 180%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 180%;">If you have questions regarding your data, please visit our Privacy Policy</p>
<p style="font-size: 14px; line-height: 180%;">Want to change how you receive these emails? You can update your preferences or unsubscribe from this list.</p>
<p style="font-size: 14px; line-height: 180%;"><span style="font-size: 12px; line-height: 21.6px;">&copy; '.date("Y").' Company. All Rights Reserved.</span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>

    </td>
  </tr>
  </tbody>
  </table>

</body>

</html>
';	
	
//	die('ddd');


$dt['first_name'] = $first_name; 
$dt['today_date'] = $today_date; 
$dt['user_id']    = $user_id; 
$dt['user_password'] = $user_password; 

           $this->session->set_flashdata('messageRegister',$dt);
         $subject="Email Verification Link";
         $message=$message2;
          $this->email->from($model->getValue("CONFIG_SYSTEM_LOGIN"));
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
          if($this->email->send())
         {
        //   echo "<script type='text/javascript'>alert('Email Send Success');</script>";       	
              echo "1";     
         }
         else
        {
        //   show_error($this->email->print_debugger());
          echo "2";
        }
        
				}
				else
				{
				    echo "2";
				}
	}
	public function registerajax(){
		$model = new OperationModel();
		$form_data = $this->input->post();		
		$segment = $this->uri->uri_to_assoc(2);
		$time_stamp = getLocalTime();
		$today_date = InsertDate($time_stamp);
		$spr_user_id  = FCrtRplc($segment['register']);
		//	PRintR($form_data);die;		
      //$this->session->set_userdata('sss',$form_data);  die;
	// $form_data =  $this->session->userdata('sss'); PrintR($form_data);
	$phoneeee=  str_replace(" ", "", FCrtRplc($form_data['phone']));
	// die('dd');
		if($model->getValue("member_Registration_on_off")=='Y'){
		if($form_data['user_id']!='' && $this->input->post()!=''){
			    $first_name = FCrtRplc($form_data['first_name']);
			     $plan = FCrtRplc($form_data['plan']);
				//$last_name = FCrtRplc($form_data['last_name']);
				   $member_email = FCrtRplc($form_data['member_email']);
				      $spil_user_id = FCrtRplc($form_data['spil_user_id']);
				$user_password = FCrtRplc($form_data['user_password']);
				$trns_password = FCrtRplc($form_data['trns_password']);
			    $state_name = FCrtRplc($form_data['state_name']);
				$country_code = FCrtRplc($form_data['country_code']);
				$city_name = FCrtRplc($form_data['city_name']);
				$mobile_code =  $model->getMobileCode($form_data['country_code']);
					$mobile_code =  $model->getMobileCode($form_data['country_name']);
				$member_mobile = FCrtRplc($phoneeee);
				$member_phone = FCrtRplc($form_data['full']);
				$type_id = FCrtRplc($form_data['type_id']);
				$user_id  =  FCrtRplc($form_data['user_id']);
				$user_name = FCrtRplc($form_data['user_name']);
			    $title = FCrtRplc($form_data['title']);
				$pin_code = FCrtRplc($form_data['pin_code']);
				$gender = FCrtRplc($form_data['gender']);
		$type_id = FCrtRplc($form_data['type_id']);
		$no_pin= FCrtRplc($form_data['activePin']);
		$pin_key= FCrtRplc($form_data['activeKey']);
				   

				$left_right = FCrtRplc($form_data['left_right']);
				
				if($first_name!='' || $left_right!=''){
					$sponsor_id = $model->getMemberId(FCrtRplc($form_data['spr_user_id']));
						$spil_memberid = 1;//$model->getMemberId(FCrtRplc($form_data['spil_user_id']));
					$AR_GET = $model->getSponsorSpill($sponsor_id,$left_right);
					
					if($left_right=='AUTO'){
						$AR_GET = $model->getOpenPlace($sponsor_id);
						$left_right = $AR_GET['left_right'];	
					}
					 
					$spil_id =  FCrtRplc($AR_GET['spil_id']);
					if($sponsor_id>0 ){  
					   if($sponsor_id>0){
					    //	if($model->checkCountPlan(prefix."tbl_members","member_id",$sponsor_id)==$plan){ 
					    	  
					     	if(true){
					     	    //	if(true){
							if($model->checkCount(prefix."tbl_subscription","member_id",$sponsor_id) >0){
					 if($model->checkCount(prefix."tbl_members","user_id",$user_id)==0){
   if(true){
       if(true){

	  //  if($model->checkCount(prefix."tbl_members","member_mobile",$member_mobile)==0){
	     // if($model->checkCount(prefix."tbl_members","member_email",$member_email)==0){

				// 		if($no_pin!='' && $pin_key!=''){
				// 	$AR_PIN = $model->getPinDetail($no_pin,$pin_key);
				// 	if($model->checkPinActivation($AR_PIN['mstr_id'],$AR_PIN['type_id'])==0){
					 
				// 		if($AR_PIN['block_sts']=="N"){
				// 		if($AR_PIN['pin_sts']=="N" && $AR_PIN['use_member_id']==0){




									$Ctrl += $model->CheckOpenPlace($spil_id,$left_right);
									$data = array(
									    "first_name"=>$first_name,
										"full_name"=>$first_name,
										"user_id"=>$user_id,
										"user_name"=>$user_id,
										"user_password"=>$user_password,
										"trns_password"=>$trns_password,
										"member_email"=>$member_email,
									    "title" => $title,
									    "state_name"=>$state_name,
									    "city_name"=>$city_name,
				                        "pin_code"  =>$pin_code,
				                        "gender" =>$gender,
										"sponsor_id"=>$sponsor_id,
										"spil_id"=>$spil_id,
											"level_spil"=>$spil_memberid,
										"left_right"=>$left_right,
									 
									 
										"member_phone" => $member_phone,
										"member_mobile"=>$member_mobile,
										"date_join"=>$time_stamp,
										"pan_status"=>"N",
										"status"=>"Y",
										"last_login"=>$time_stamp,
											"plan"=>$plan,
										"login_ip"=>$_SERVER['REMOTE_ADDR'],
										"block_sts"=>"N",
										"sms_sts"=>"N",
											"emailverify"=>"Y",
									 
										"type_id"=>0
										
									);	

									if($Ctrl==0){
										 	$member_id = $this->SqlModel->insertRecord(prefix."tbl_members",$data);
											$tree_data = array("member_id"=>$member_id,
												"sponsor_id"=>$sponsor_id,
												"spil_id"=>$spil_id,
												"nlevel"=>0,
												"left_right"=>$left_right,
												"nleft"=>0,
												"nright"=>0,
												"date_join"=>$today_date
											);
    											$this->SqlModel->insertRecord(prefix."tbl_mem_tree",$tree_data);
											$model->updateTree($spil_id,$member_id);
											
											
											
											//	$model->updatePinDetail($AR_PIN['pin_id'],$member_id);	
								 
									    $AR_RT['mem_id']=$user_id;
										$AR_RT['pass']=$user_password;
										$AR_RT['UserName_model']=$first_name;
										$AR_RT['UserID_model']=$user_id;
										$AR_RT['UserPass_model']=$user_password;
										$AR_MAIL['member_id']=$member_id;
										$AR_RT['newUserId'] = $model->generateUserId();
$brrk = "<br>";
                                        $AR_RT['ErrorDtl']='Username:'.$user_id.' '.$brrk.' Password:'.$user_password.''.$brrk.' Name:'.$first_name.'';
                                         $AR_RT['ErrorDt2']= $first_name;
											$AR_RT['ErrorMsg']="success";
											$mobile = $member_mobile;
	$message ="Dear $first_name, Welcome to $CONFIG_COMPANY_NAME, Earn Unlimited money with us. Your User ID is : $user_id , & Password : $user_password Thank You, Regard $CONFIG_COMPANY_NAME & Team";
										

  
  
 	//$model->massagesend($mobile,$message); 							 	
	$email = $member_email;
	if(true){
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


    $message2  =  '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
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
<div style="font-family:Quattrocento;font-size:18px;font-weight:400;line-height:24px;text-align:left;color:#000000;">Dear '.$first_name.',
    Welcome to RND Groups! We are thrilled to have you on board and excited to embark on this journey together. Our 24x7 Whatsapp Support will guide you through the initial steps to get started and make the most out of our platform. Let’s dive in
    <br></div>
</td>
</tr>

<tr>
<td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
<div style="font-family:Quattrocento;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#333333;">
<h4>Your login credentials are:</h4>
Username :- '.$user_id.' <br>
Passowrd :-  '.$user_password.'
<p style="display:none;">Update your USDT (BEP 20) wallet address in profile once login to get daily stable bonus and withdrawals get active.

</p>


<p style="display:none;">
Before making deposits and start operations please read terms & conditions carefully: <a href="" >Terms&ConditionsLink  </a> 

</p>
<div style="font-family:Quattrocento;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#333333;"> <a href="'.BASE_PATH.emailyverify.'/'.index.'/'._e($user_id).'" style="color: #428dfc; text-decoration: none; font-weight: bold;">Verify Your Account </a></div>

<p>
    For further information and queries you may write us here. <a href="#" style="color: #428dfc; text-decoration: none; font-weight: bold;"> support@rndgroups.com </a>
</p>

<p>
    With warm regards,<br>
    Team RND Groups
</p>
</div>

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
</html>';
	

 $apiKey = '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';
$fromEmail = 'noreply@rndgroups.com';
 $subject="Welcome Letter";

$url = 'https://api.sendinblue.com/v3/smtp/email';

$data = array(
    'sender' => array(
        'name' => 'rndgroups.com',
        'email' => $fromEmail
    ),
    'to' => array(
        array(
            'email' => $email
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
} else {
  // echo 'Email could not be sent.';
}


 }
	  $memberdetail   = $model->getMemberdetail($member_id);
            $user_id      = $memberdetail['user_id'];
            
 
     
	set_message("success","Username=> $user_id | Password=> $user_password | <br> Name => $first_name;");
					redirect(BASE_PATH."sign-up");

										}
										
										else{
								// 			$AR_RT['ErrorDtl']="Failed , unable to process your request , please try again";
								// 			$AR_RT['ErrorMsg']="warning";
								
								
									set_message("warning","Failed , unable to process your request , please try again");
					redirect(BASE_PATH."sign-up");
									 }


// }////
// 						else{
// 						$AR_RT['ErrorDtl']="This pin is already used by other member";
// 							$AR_RT['ErrorMsg']="warning";
// 						}
								
// 							}
// 						else{
// 						$AR_RT['ErrorDtl']="Sorry this pin is blocked, please contact our support team";
// 							$AR_RT['ErrorMsg']="warning";
// 						}			 
									 
								 
							 
// 						}
// 						else{
// 						$AR_RT['ErrorDtl']="Invalid  pin no, use  activation pin ";
// 							$AR_RT['ErrorMsg']="warning";
// 						}
// 						}

 }else{
				// 	 	$AR_RT['ErrorDtl']="This Email  Id is already used";
				// 	 	$AR_RT['ErrorMsg']="warning";
				
					set_message("warning","This Email  Id is already used");
					redirect(BASE_PATH."sign-up");
				
				
					 }
 }else{
				// 	 	$AR_RT['ErrorDtl']="This Mobile No already used";
				// 	 	$AR_RT['ErrorMsg']="warning";
				
					set_message("warning","This Mobile No already used");
					redirect(BASE_PATH."sign-up");
				
				
					 }

				 }else{
				// 	 	$AR_RT['ErrorDtl']="This User Id is already used";
				// 	 	$AR_RT['ErrorMsg']="warning";
				
				
					set_message("warning","This User Id is already used");
					redirect(BASE_PATH."sign-up");
					 }
					}else{
				// 	 	$AR_RT['ErrorDtl']="Sponsor ID Should Be Activated";
				// 	 	$AR_RT['ErrorMsg']="warning";
				
					set_message("warning","Sponsor ID Should Be Activated");
					redirect(BASE_PATH."sign-up");
					 }	
					    	}else{
				
					set_message("warning","Please Select Correct Plan Sponsor");
					redirect(BASE_PATH."sign-up");
					 }	
						
					   }else{ 
				// 		$AR_RT['ErrorDtl']="Invalid spill id, please eneter valid id";
				// 		$AR_RT['ErrorMsg']="warning";
					set_message("warning","Invalid spill id, please eneter valid id");
					redirect(BASE_PATH."sign-up");
					}
					       
					       
					   }else{ 
				// 		$AR_RT['ErrorDtl']="Invalid sponsor id, please eneter valid id";
				// 		$AR_RT['ErrorMsg']="warning";
				
					set_message("warning","Invalid sponsor id, please eneter valid id");
					redirect(BASE_PATH."sign-up");
					}
				}else{
				// 	$AR_RT['ErrorDtl']="Failed , unable to process your request , please try again";
				// 	$AR_RT['ErrorMsg']="warning";
				
				
					set_message("warning","Failed , unable to process your request , please try again");
					redirect(BASE_PATH."sign-up");
				}
		}

		echo json_encode($AR_RT);
	
		}
else{
		      
		    set_message("warning","Payout is underprocessing please try after some for Registration");
		    
					redirect(BASE_PATH."sign-up");
		  }	
		  
		//  $this->load->view('sign',$data);
	}
 
	
	public function welcome(){
		$this->load->view('welcome',$data);
	}
	public function resetpassword(){
		$this->load->view('resetpassword',$data);
	}
	
	
	
	public function emailverify(){
		$this->load->view('emailverify',$data);
	}
	
	public function emailotpverify(){
		$this->load->view('emailotpverify',$data);
	}
	
	
	public function email(){
		$model = new OperationModel();
		$segment = $this->uri->uri_to_assoc(1);
		$member_id  = $segment['member_id'];
		$option_name = $segment['option_name'];
		$trns_password = $segment['trns_password'];
		$email_rq_id = $segment['email_rq_id'];
		$request_id = $segment['request_id'];
		$sms_otp_body = urldecode($segment['sms_otp_body']);
		
		$wallet_id = $model->getDepositWallet(WALLET1);
		$amount = $segment['amount'];
		$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		$cash_balance = $LDGR['net_balance'];

		$rowSingle = $model->getMember($member_id);
		
		if($request_id>0){
			$OTP = $model->getOptDetail($request_id);
			$OTP_VAL = json_decode($OTP,true);
			$sms_otp = $OTP['sms_otp'];
			$otp_amount = $OTP_VAL['otp_amount'];
		}
		
		if($rowSingle){
			$full_name = $rowSingle['first_name']." ".$rowSingle['last_name'];
			$email = $rowSingle['member_email'];
			$phone = $rowSingle['member_mobile'];
		}
		$email_verify = generateSeoUrl("user","emailverify",array("email"=>_e($rowSingle['member_id'])));

		
		$data['otp_amount'] = $otp_amount;
		$data['sms_otp'] = $sms_otp;
		$data['amount_receive'] = $amount;
		$data['amount_send'] = $amount;
		$data['cash_balance'] = $cash_balance;
		$data['trns_password'] = $trns_password;
		$data['option_name'] = $option_name;
        $data['company_name'] = $model->getValue("CONFIG_COMPANY_NAME");
		$data['name'] = $full_name;
		$data['phone'] = $phone;
		$data['email'] = ($email!='')? $email:"N/A";
		$data['website_url'] = base_url();
		$data['login_url'] = generateSeoUrl("user","login","");
		$data['password'] = $rowSingle['user_password'];
		$data['username'] = ($rowSingle['user_name']!='')? $rowSingle['user_name']:$rowSingle['user_id'];
		$data['email_verify'] = $email_verify;
		
		$this->parser->parse('template/email_template', $data);
	}
	
}
