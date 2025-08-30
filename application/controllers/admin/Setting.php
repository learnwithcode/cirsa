<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
		
		$opr_id = $this->session->userdata('oprt_id');
        if($opr_id == '8')
        {
        
        redirect_page("homepage","","");
        }
	}
	
	
//	cc0055128
	
	 public function deleteStructure()
	    {
	        $model = new OperationModel();
	      
 	$form_data = $this->input->post();
          $date = date('Y-m-d'); //PrintR($form_data);die;
	    if($form_data['submitDeleteStructure']==1 && $this->input->post()!=''){
	          
	    $user_id =      $form_data['user_id']; 
   	    $member_id = $model->getMemberId($user_id); 
   	    $date_from = $model->getdateFromActive($member_id);  
   	    if(true)
   	    {  //strtotime($date) == strtotime($date_from)
   	    $this->SqlModel->deleteRecord(prefix."tbl_subscription",array("member_id"=>$member_id));
   	 
   	 
   	 
   	 
        $QR_SELECT = "SELECT * FROM `tbl_subscription` WHERE `bulk_by` = '$member_id'";
        $AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,false); 
       	  foreach($AR_SELECT as $V)
                {
                $membersId = $V['member_id'];
                $this->SqlModel->deleteRecord(prefix."tbl_members",array("member_id"=>$membersId));
                $this->SqlModel->deleteRecord(prefix."tbl_mem_tree",array("member_id"=>$membersId));
                $this->SqlModel->deleteRecord(prefix."tbl_subscription",array("member_id"=>$membersId));
                }   //die; 
   	   
   	//Delete Left Side    
    $left_right = 'L';   
	$StrPlace = ($left_right!='')? " AND spil_id='".$member_id."' AND  left_right='".$left_right."'":"";
	$StrPlace .= ($left_right=='')? " AND member_id='".$member_id."'":"";

	$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE 1 $StrPlace ORDER BY member_id ASC LIMIT 1";
	$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
	
            $nleft = $AR_SELECT["nleft"];																																													
            $nright = $AR_SELECT["nright"];
            $StrWhr = " AND tree.nleft BETWEEN '$nleft' AND '$nright'";
            $QR_PAGE = "SELECT tm.member_id , tm.user_id  FROM ".prefix."tbl_members AS tm	
            LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
            LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id WHERE tm.member_id!='".$member_id."'   AND tm.delete_sts>0  $StrWhr  GROUP BY tm.member_id ORDER BY tm.date_join DESC";
            $PageVal = 	  $this->SqlModel->runQuery($QR_PAGE,false);
            foreach($PageVal as $V)
            {
            $membersId = $V['member_id'];
            $this->SqlModel->deleteRecord(prefix."tbl_members",array("member_id"=>$membersId));
            $this->SqlModel->deleteRecord(prefix."tbl_mem_tree",array("member_id"=>$membersId));
            $this->SqlModel->deleteRecord(prefix."tbl_subscription",array("member_id"=>$membersId));
            }  
	
	//Delete Right Side    
    $left_right = 'R';   
	$StrPlace = ($left_right!='')? " AND spil_id='".$member_id."' AND  left_right='".$left_right."'":"";
	$StrPlace .= ($left_right=='')? " AND member_id='".$member_id."'":"";

	$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE 1 $StrPlace ORDER BY member_id ASC LIMIT 1";
	$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
	
            $nleft = $AR_SELECT["nleft"];																																													
            $nright = $AR_SELECT["nright"];
            $StrWhr = " AND tree.nleft BETWEEN '$nleft' AND '$nright'";
            $QR_PAGE = "SELECT tm.member_id , tm.user_id  FROM ".prefix."tbl_members AS tm	
            LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
            LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id WHERE tm.member_id!='".$member_id."'   AND tm.delete_sts>0  $StrWhr  GROUP BY tm.member_id ORDER BY tm.date_join DESC";
            $PageVal = 	  $this->SqlModel->runQuery($QR_PAGE,false);// PrintR($PageVal);die;
            foreach($PageVal as $V)
            {
            $membersId = $V['member_id'];
            $this->SqlModel->deleteRecord(prefix."tbl_members",array("member_id"=>$membersId));
            $this->SqlModel->deleteRecord(prefix."tbl_mem_tree",array("member_id"=>$membersId));
            $this->SqlModel->deleteRecord(prefix."tbl_subscription",array("member_id"=>$membersId));
            }  
	        set_message("success","Successfully deleted Structure  ");
			redirect_page("setting","deleteStructure",array());
   	    }
   	    else
   	    {
   	      set_message("warning","This Id active from back date ");
			redirect_page("setting","deleteStructure",array());  
   	    }
	        }
	        
	        if($form_data['submitDeleteUser']==1 && $this->input->post()!=''){
	       
                $user_id =      $form_data['user_id']; 
                $member_id = $model->getMemberId($user_id);  
                
                $countSpill =   $model->getSpillcounts($member_id);
                                        if($countSpill <=  '0')
                                        {
                                           if($model->checkCount('tbl_subscription','member_id',$member_id) <= '0')
                                           {
                                                $this->SqlModel->deleteRecord(prefix."tbl_members",array("member_id"=>$member_id));
                                                $this->SqlModel->deleteRecord(prefix."tbl_mem_tree",array("member_id"=>$member_id));  
                                                
                                                
                                           }
                                              set_message("success","Successfully deleted Single Id  ");
			                                    redirect_page("setting","deleteStructure",array());
                                        }
                                        else
                                            {
                                            set_message("warning","Child/Spill Id already register inside this Id ...");
                                            redirect_page("setting","deleteStructure",array());  
                                            }
	            
	        }
	        
	        
	       	$this->load->view(ADMIN_FOLDER.'/setting/deleteStructure',$data); 
	        
	    }
	    
	    
	    
		public function crypto(){
		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		//	PrintR($_FILES); die;
		if($form_data['submitcrypto_setting']==1 && $this->input->post()!=''){
		   $model->setcryptoConfig("CRYPTO_BEP20",FCrtRplc($form_data['CRYPTO_BEP20']));
		    $model->setcryptoConfig("CRYPTO_TRC20",FCrtRplc($form_data['CRYPTO_TRC20']));
			$model->setcryptoConfig("CRYPTO_Polygon",FCrtRplc($form_data['CRYPTO_Polygon']));
			$model->setcryptoConfig("CRYPTO_Paypal",FCrtRplc($form_data['CRYPTO_Paypal']));
			$model->setcryptoConfig("CRYPTO_Skrill",FCrtRplc($form_data['CRYPTO_Skrill']));
			$model->setcryptoConfig("CRYPTO_NetSuite",FCrtRplc($form_data['CRYPTO_NetSuite']));
			
			
			if($_FILES['CRYPTO_BEP20_LOGO']['error']=="0"){
				$ext = explode(".",$_FILES['CRYPTO_BEP20_LOGO']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/icon/QRNEW/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CRYPTO_BEP20_LOGO']['tmp_name'], $target_path)){
					
					$model->setcryptoConfig("CRYPTO_BEP20_LOGO",$photo);		 
					
						
					}
			}
			if($_FILES['CRYPTO_TRC20_LOGO']['error']=="0"){
				$ext = explode(".",$_FILES['CRYPTO_TRC20_LOGO']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/icon/QRNEW/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CRYPTO_TRC20_LOGO']['tmp_name'], $target_path)){
					
					$model->setcryptoConfig("CRYPTO_TRC20_LOGO",$photo);		 
					
						
					}
			}
			if($_FILES['CRYPTO_Polygon_LOGO']['error']=="0"){
				$ext = explode(".",$_FILES['CRYPTO_Polygon_LOGO']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/icon/QRNEW/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CRYPTO_Polygon_LOGO']['tmp_name'], $target_path)){
					
					$model->setcryptoConfig("CRYPTO_Polygon_LOGO",$photo);		 
					
						
					}
			}
			if($_FILES['CRYPTO_Paypal_LOGO']['error']=="0"){
				$ext = explode(".",$_FILES['CRYPTO_Paypal_LOGO']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/icon/QRNEW/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CRYPTO_Paypal_LOGO']['tmp_name'], $target_path)){
					
					$model->setcryptoConfig("CRYPTO_Paypal_LOGO",$photo);		 
					
						
					}
			}
	
			if($_FILES['CRYPTO_Skrill_LOGO']['error']=="0"){
				$ext = explode(".",$_FILES['CRYPTO_Skrill_LOGO']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/icon/QRNEW/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CRYPTO_Skrill_LOGO']['tmp_name'], $target_path)){
					
					$model->setcryptoConfig("CRYPTO_Skrill_LOGO",$photo);		 
					
						
					}
			}
			if($_FILES['NetSuite_LOGO']['error']=="0"){
				$ext = explode(".",$_FILES['NetSuite_LOGO']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/icon/QRNEW/".$photo;
				
			 
					if(move_uploaded_file($_FILES['NetSuite_LOGO']['tmp_name'], $target_path)){
					
					$model->setcryptoConfig("NetSuite_LOGO",$photo);		 
					
						
					}
			}
		
		
		
			
			set_message("success","Successfully updated changes");
			redirect_page("setting","crypto",array());
		}
		
		$this->load->view(ADMIN_FOLDER.'/setting/cryptosetting',$data);
	
	}
		public function dashboard_setting(){
		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
			//PrintR($form_data);
		if($form_data['submitdashboard_setting']==1 && $this->input->post()!=''){
		    
			$model->setConfig("M_Logo_Header",FCrtRplc($form_data['M_Logo_Header']));
			
			$model->setConfig("M_Navbar",FCrtRplc($form_data['M_Navbar']));
			$model->setConfig("M_Sidebar",FCrtRplc($form_data['M_Sidebar']));
			$model->setConfig("M_Background",FCrtRplc($form_data['M_Background']));
		
		
			
			
			set_message("success","Successfully updated changes");
			redirect_page("setting","dashboard_setting",array());
		}
		
		$this->load->view(ADMIN_FOLDER.'/setting/dashboardsetting',$data);
	
	}
		public function site_setting(){
		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
			//PrintR($form_data);
		if($form_data['submitSite_setting']==1 && $this->input->post()!=''){
                $model->setConfig("instant_otp",FCrtRplc($form_data['instant_otp']));
                $model->setConfig("member_Registration_on_off",FCrtRplc($form_data['member_Registration_on_off']));
                $model->setConfig("CONFIG_COMPANY_NAME",FCrtRplc($form_data['CONFIG_COMPANY_NAME']));
                $model->setConfig("CONFIG_PIN_ACTIVATION",FCrtRplc($form_data['CONFIG_PIN_ACTIVATION']));
                $model->setConfig("CONFIG_CMP_EMAIL",FCrtRplc($form_data['CONFIG_CMP_EMAIL']));
                $model->setConfig("CONFIG_ENQUIRY_EMAIL",FCrtRplc($form_data['CONFIG_ENQUIRY_EMAIL']));
                $model->setConfig("CONFIG_TECH_EMAIL",FCrtRplc($form_data['CONFIG_TECH_EMAIL']));
                
                $model->setConfig("CONFIG_COMPANY_ADDRESS",FCrtRplc($form_data['CONFIG_COMPANY_ADDRESS']));
                $model->setConfig("CONFIG_MOBILE_NO",FCrtRplc($form_data['CONFIG_MOBILE_NO']));
                $model->setConfig("Email_otp",FCrtRplc($form_data['Email_otp']));
                $model->setConfig("CONFIG_EGC_ADDRESS",FCrtRplc($form_data['CONFIG_EGC_ADDRESS']));
                
                $model->setConfig("CONFIG_DIRECT_REFFERAL",FCrtRplc($form_data['CONFIG_DIRECT_REFFERAL']));
                $model->setConfig("CONFIG_BINARY_CEILING",FCrtRplc($form_data['CONFIG_BINARY_CEILING']));
                $model->setConfig("CONFIG_WEBSITE",FCrtRplc($form_data['CONFIG_WEBSITE']));
                $model->setConfig("CONFIG_MANUAL_USERS",FCrtRplc($form_data['CONFIG_MANUAL_USERS']));
			
    $model->setConfig("CONFIG_TRX_WITHDRAWAL",FCrtRplc($form_data['CONFIG_TRX_WITHDRAWAL']));
    $model->setConfig("CONFIG_ELITE_WITHDRAWAL",FCrtRplc($form_data['CONFIG_ELITE_WITHDRAWAL']));
    $model->setConfig("CONFIG_INR_WITHDRAWAL",FCrtRplc($form_data['CONFIG_INR_WITHDRAWAL']));
			
			
                
                
                
			
			
			$model->setConfig("CONFIG_COINPAY_NO_OFF",FCrtRplc($form_data['CONFIG_COINPAY_NO_OFF']));
			
			$model->setConfig("CONFIG_TDS",FCrtRplc($form_data['CONFIG_TDS']));
			$model->setConfig("CONFIG_SERVICE",FCrtRplc($form_data['CONFIG_SERVICE']));
			$model->setConfig("CONFIG_WITHDRAWL",FCrtRplc($form_data['CONFIG_WITHDRAWL']));
				$model->setConfig("Instant_status",FCrtRplc($form_data['Instant_status']));
			$model->setConfig("Recharge_status",FCrtRplc($form_data['Recharge_status']));
			$model->setConfig("wallelttransfer_status",FCrtRplc($form_data['wallelttransfer_status']));
				$model->setConfig("wallelt_to_wallelt",FCrtRplc($form_data['wallelt_to_wallelt']));
			$model->setConfig("CONFIG_MARQUE",FCrtRplc($form_data['CONFIG_MARQUE']));
				$model->setConfig("CONFIG_WITHDRAWL_LIMIT",FCrtRplc($form_data['CONFIG_WITHDRAWL_LIMIT']));
			
			$model->setConfig("CONFIG_WITHDRAWL_CHARGE",FCrtRplc($form_data['CONFIG_WITHDRAWL_CHARGE']));
			$model->setConfig("CONFIG_MIN_WITHDRAWL",FCrtRplc($form_data['CONFIG_MIN_WITHDRAWL']));
			$model->setConfig("CONFIG_MIN_WITHDRAWL_BITCOIN",FCrtRplc($form_data['CONFIG_MIN_WITHDRAWL_BITCOIN']));
			$model->setConfig("CONFIG_MIN_WITHDRAWL_BANKWIRE",FCrtRplc($form_data['CONFIG_MIN_WITHDRAWL_BANKWIRE']));
			$model->setConfig("CONFIG_WITHDRAWL_TYPE",FCrtRplc($form_data['CONFIG_WITHDRAWL_TYPE']));
			$model->setConfig("member_activation_on_off",FCrtRplc($form_data['member_activation_on_off']));
			$model->setConfig("CONFIG_RATE",FCrtRplc($form_data['CONFIG_RATE']));
			
			
			$model->setConfig("CONFIG_PHONE",FCrtRplc($form_data['CONFIG_PHONE']));
			$model->setConfig("CONFIG_MAX_WITHDRAWL",FCrtRplc($form_data['CONFIG_MAX_WITHDRAWL']));
			$model->setConfig("CONFIG_MIN_FUND_TRANSFER",FCrtRplc($form_data['CONFIG_MIN_FUND_TRANSFER']));
			
			$model->setConfig("CONFIG_ADMIN_CHARGE",FCrtRplc($form_data['CONFIG_ADMIN_CHARGE']));
			$model->setConfig("CONFIG_SERVICE_CHARGE",FCrtRplc($form_data['CONFIG_SERVICE_CHARGE']));
			
			$model->setConfig("CONFIG_TITLE",FCrtRplc($form_data['CONFIG_TITLE']));
			$model->setConfig("CONFIG_PREFIX",FCrtRplc($form_data['CONFIG_PREFIX']));
			$model->setConfig("CONFIG_PREFIX_DIGITNUMBER",FCrtRplc($form_data['CONFIG_PREFIX_DIGITNUMBER']));
			$model->setConfig("Reedeem_on_off",FCrtRplc($form_data['Reedeem_on_off']));
				
			$model->setConfig("CONFIG_CRYPTO_WITHDRAWAL",FCrtRplc($form_data['CONFIG_CRYPTO_WITHDRAWAL']));	
			
			
			
			$model->setConfig("INR_Rate",FCrtRplc($form_data['INR_Rate']));
			$model->setConfig("USD_Rate",FCrtRplc($form_data['USD_Rate']));
			$model->setConfig("JPY_Rate",FCrtRplc($form_data['JPY_Rate']));
			$model->setConfig("GBP_Rate",FCrtRplc($form_data['GBP_Rate']));	
			
			
			
			
			
			
			
			
			
				
			$NEW_RATE = FCrtRplc($form_data['CONFIG_ELITE_RATE']);
			$OLD_RATE = $model->getValue("CONFIG_ELITE_RATE");
			if($NEW_RATE != $OLD_RATE)
			{
			    $postData = array("new_rate" =>$NEW_RATE , "old_rate" => $OLD_RATE ,"added_date_time" => date("Y-m-d H:i:s"));
			    $this->SqlModel->insertRecord("tbl_coin_rate",$postData);
		    	$model->setConfig("CONFIG_ELITE_RATE",FCrtRplc($form_data['CONFIG_ELITE_RATE']));
			}	
			
					if($form_data['Withdrawal_status']=='1'){
			    
				$this->SqlModel->updateRecord(prefix."tbl_members",array("Withdrawal_status"=>'1'),array("Withdrawal_status"=>'0'));
			    //$model->setConfig("Withdrawl_Status_M",FCrtRplc($form_data['Withdrawl_Status_M']));
			
			    
			}elseif($form_data['Withdrawal_status']=='0'){
			   
	          $this->SqlModel->updateRecord(prefix."tbl_members",array("Withdrawal_status"=>'0'),array("Withdrawal_status"=>'1'));
			 // $model->setConfig("Withdrawl_Status_M",FCrtRplc($form_data['Withdrawl_Status_M']));  
			}
			
		// START DIRECTOR 1
			$model->setConfig("CONFIG_DNAME",FCrtRplc($form_data['CONFIG_DNAME']));
			$model->setConfig("CONFIG_DFNAME",FCrtRplc($form_data['CONFIG_DFNAME']));
			$model->setConfig("CONFIG_DMOBILE",FCrtRplc($form_data['CONFIG_DMOBILE']));
			$model->setConfig("CONFIG_DEMAIL",FCrtRplc($form_data['CONFIG_DEMAIL']));
			$model->setConfig("CONFIG_DADDRESS",FCrtRplc($form_data['CONFIG_DADDRESS']));
			$model->setConfig("CONFIG_DPAN",FCrtRplc($form_data['CONFIG_DPAN']));
			$model->setConfig("CONFIG_DADHARNO",FCrtRplc($form_data['CONFIG_DADHARNO']));
			
			if($_FILES['CONFIG_DPHOTO']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_DPHOTO']["name"]);
				$fExtn = strtolower(end($ext));
				
				 
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CONFIG_DPHOTO']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_DPHOTO",$photo);		 
					
						
					}
				}
			}
			if($_FILES['CONFIG_DPANPHOTO']['error']=="0"){
			    
				$ext = explode(".",$_FILES['CONFIG_DPANPHOTO']["name"]);
				
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CONFIG_DPANPHOTO']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_DPANPHOTO",$photo);		 
					
						
					}}
			}
			if($_FILES['CONFIG_DADHARPHOTOF']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_DADHARPHOTOF']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CONFIG_DADHARPHOTOF']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_DADHARPHOTOF",$photo);		 
					
						
					}
			}}
			if($_FILES['CONFIG_DADHARPHOTOB']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_DADHARPHOTOB']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CONFIG_DADHARPHOTOB']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_DADHARPHOTOB",$photo);		 
					
						
				}	}
			}
		// END DIRECTOR 1
		
		
		// START DIRECTOR 2
			$model->setConfig("CONFIG_DNAME1",FCrtRplc($form_data['CONFIG_DNAME1']));
			$model->setConfig("CONFIG_DFNAME1",FCrtRplc($form_data['CONFIG_DFNAME1']));
			$model->setConfig("CONFIG_DMOBILE1",FCrtRplc($form_data['CONFIG_DMOBILE1']));
			$model->setConfig("CONFIG_DEMAIL1",FCrtRplc($form_data['CONFIG_DEMAIL1']));
			$model->setConfig("CONFIG_DADDRESS1",FCrtRplc($form_data['CONFIG_DADDRESS1']));
			$model->setConfig("CONFIG_DPAN1",FCrtRplc($form_data['CONFIG_DPAN1']));
			$model->setConfig("CONFIG_DADHARNO1",FCrtRplc($form_data['CONFIG_DADHARNO1']));
			
			if($_FILES['CONFIG_DPHOTO1']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_DPHOTO1']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CONFIG_DPHOTO1']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_DPHOTO1",$photo);		 
					
						
					}}
			}
			if($_FILES['CONFIG_DPANPHOTO1']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_DPANPHOTO1']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CONFIG_DPANPHOTO1']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_DPANPHOTO1",$photo);		 
					
						
				}	}
			}
			if($_FILES['CONFIG_DADHARPHOTOF1']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_DADHARPHOTOF1']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CONFIG_DADHARPHOTOF1']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_DADHARPHOTOF1",$photo);		 
					
						
					}
			}}
			if($_FILES['CONFIG_DADHARPHOTOB1']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_DADHARPHOTOB1']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CONFIG_DADHARPHOTOB1']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_DADHARPHOTOB1",$photo);		 
					
						
					}
			}}
		// END DIRECTOR 2
		
		// START COMPANY DOCUMENT
		$model->setConfig("CONFIG_CADDRESS",FCrtRplc($form_data['CONFIG_CADDRESS']));
			
			if($_FILES['CONFIG_CSHOPACT']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_CSHOPACT']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CONFIG_CSHOPACT']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_CSHOPACT",$photo);		 
					
						
					}}
			}
			if($_FILES['CONFIG_CGST']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_CGST']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CONFIG_CGST']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_CGST",$photo);		 
					
						
					}
			}}
			if($_FILES['CONFIG_CPANCARD']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_CPANCARD']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CONFIG_CPANCARD']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_CPANCARD",$photo);		 
					
						
					}
			}}
			if($_FILES['CONFIG_CMSME']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_CMSME']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CONFIG_CMSME']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_CMSME",$photo);		 
					
						
					}
			}}
			if($_FILES['CONFIG_CISO']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_CISO']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CONFIG_CISO']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_CISO",$photo);		 
					
						
					}
			}}
			if($_FILES['CONFIG_COTHERDOC']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_COTHERDOC']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CONFIG_COTHERDOC']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_COTHERDOC",$photo);		 
					
					}
					}
			}
		// END COMPANY DOCUMENT
				
			if($_FILES['CONFIG_LOGO']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_LOGO']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
		if(move_uploaded_file($_FILES['CONFIG_LOGO']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_LOGO",$photo);		 
					
						
			}		}
			}
				if($_FILES['CONFIG_FAVICON']['error']=="0"){
				$ext = explode(".",$_FILES['CONFIG_FAVICON']["name"]);
				$fExtn = strtolower(end($ext));
			if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/system/".$photo;
				
			 
					if(move_uploaded_file($_FILES['CONFIG_FAVICON']['tmp_name'], $target_path)){
					
					$model->setConfig("CONFIG_FAVICON",$photo);		 
					
					}		
					}
			}
			
			
			set_message("success","Successfully updated changes");
			redirect_page("setting","site_setting",array());
		}
		
		$this->load->view(ADMIN_FOLDER.'/setting/sitesetting',$data);
	
	}
	
		public function viewCoinRates(){
		
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
	    $this->load->view(ADMIN_FOLDER.'/setting/viewCoinRates',$data);
	
	}
		public function smssetting() {
	    $model = new OperationModel();
		$form_data = $this->input->post();
		
		if($form_data['submitdata']=='1' && $this->input->post()!=''){
		   $total = count($form_data['arr_ids']);
		   $exp = implode(',',$form_data['arr_ids']);
		   
		  
		 
		 if($total =='100')
		 {
		     $sql_query = $this->db->query("SELECT member_mobile FROM tbl_members WHERE subcription_id > 0 and tripot !='1'");
		     $fetchData = $sql_query->result_array();
		     foreach($fetchData as $val)
		     {
		         $data[]= $val['member_mobile'];
		     }
		     $exp = implode(',',$data);
		     
		 }
		 
		 $mobile = $exp;

	 	$message=$form_data['textmsg'];


	$message=urlencode($message);
    $ch=curl_init('http://smpp.vertoindia.com/api/mt/SendSMS?user=rendezvous&password=12345678&senderid=IROMPL&channel=Trans&DCS=0&flashsms=0&number='.$mobile.'&text='.$message.'&route=32');

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
	
    $data = curl_exec($ch);


		 
		}
		$this->load->view(ADMIN_FOLDER.'/setting/smssetting',$data);	
	}
	
	
	
	public function addprocessor(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$processor_id = ($form_data['processor_id'])? $form_data['processor_id']:$segment['processor_id'];
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitProcessor']==1 && $this->input->post()!=''){
					$account_id = FCrtRplc($form_data['account_id']);
					$fee_flat = FCrtRplc($form_data['fee_flat']);
					$fee_percent = FCrtRplc($form_data['fee_percent']);
					$withdraw_fee = FCrtRplc($form_data['withdraw_fee']);
					$deposit_fee = FCrtRplc($form_data['deposit_fee']);
					$payment_active	 = FCrtRplc($form_data['payment_active']);
					$withdraw_active = FCrtRplc($form_data['withdraw_active']);
					$data = array("account_id"=>$account_id,
						"fee_flat"=>$fee_flat,
						"fee_percent"=>$fee_percent,
						"deposit_fee"=>$deposit_fee,
						"withdraw_fee"=>$withdraw_fee,
						"payment_active"=>$payment_active,
						"withdraw_active"=>$withdraw_active
					);
					if($model->checkCount(prefix."tbl_payment_processor","processor_id",$processor_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_payment_processor",$data,array("processor_id"=>$processor_id));
						set_message("success","You have successfully updated a  processor detail");
						redirect_page("setting","addprocessor",array("processor_id"=>$processor_id,"action_request"=>"EDIT"));					
					}else{
						$this->SqlModel->insertRecord(prefix."tbl_payment_processor",$data);
						set_message("success","You have successfully added  a new  processor");
						redirect_page("setting","addprocessor",array());					
					}
				}
			break;
			case "DELETE":
				if($processor_id>0){
					$data = array("isDelete"=>0);
					$this->SqlModel->updateRecord(prefix."tbl_payment_processor",$data,array("processor_id"=>$processor_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("setting","processors",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_payment_processor WHERE processor_id='$processor_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/setting/addprocessor',$data);
	}
	
	public function processors(){
		$this->load->view(ADMIN_FOLDER.'/setting/processors',$data);
	}	
	
	
	public function administrator(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
			
		if($form_data['submitAdministrator']==1 && $this->input->post()!=''){
			$model->setConfig("CONFIG_FB_URL",FCrtRplc($form_data['CONFIG_FB_URL']));
			$model->setConfig("CONFIG_TW_URL",FCrtRplc($form_data['CONFIG_TW_URL']));
			$model->setConfig("CONFIG_LK_URL",FCrtRplc($form_data['CONFIG_LK_URL']));
			$model->setConfig("CONFIG_GO_URL",FCrtRplc($form_data['CONFIG_GO_URL']));
			$model->setConfig("CONFIG_YT_URL",FCrtRplc($form_data['CONFIG_YT_URL']));
			
			$model->setConfig("CONFIG_PIN_ACTIVATION",FCrtRplc($form_data['CONFIG_PIN_ACTIVATION']));
			
			$model->setConfig("CONFIG_CMP_EMAIL",FCrtRplc($form_data['CONFIG_CMP_EMAIL']));
			$model->setConfig("CONFIG_ENQUIRY_EMAIL",FCrtRplc($form_data['CONFIG_ENQUIRY_EMAIL']));
			$model->setConfig("CONFIG_TECH_EMAIL",FCrtRplc($form_data['CONFIG_TECH_EMAIL']));
			
			$model->setConfig("CONFIG_COMPANY_ADDRESS",FCrtRplc($form_data['CONFIG_COMPANY_ADDRESS']));
			$model->setConfig("CONFIG_MOBILE_NO",FCrtRplc($form_data['CONFIG_MOBILE_NO']));
			
			
			$model->setConfig("CONFIG_DIRECT_REFFERAL",FCrtRplc($form_data['CONFIG_DIRECT_REFFERAL']));
			$model->setConfig("CONFIG_BINARY_CEILING",FCrtRplc($form_data['CONFIG_BINARY_CEILING']));
			$model->setConfig("CONFIG_BINARY_INCOME",FCrtRplc($form_data['CONFIG_BINARY_INCOME']));
			
			$model->setConfig("CONFIG_TDS",FCrtRplc($form_data['CONFIG_TDS']));
			$model->setConfig("CONFIG_SERVICE",FCrtRplc($form_data['CONFIG_SERVICE']));
			$model->setConfig("CONFIG_WITHDRAWL",FCrtRplc($form_data['CONFIG_WITHDRAWL']));
			
			
			$model->setConfig("CONFIG_MIN_WITHDRAWL_BITCOIN",FCrtRplc($form_data['CONFIG_MIN_WITHDRAWL_BITCOIN']));
			$model->setConfig("CONFIG_MIN_WITHDRAWL_BANKWIRE",FCrtRplc($form_data['CONFIG_MIN_WITHDRAWL_BANKWIRE']));
			
			$model->setConfig("CONFIG_MAX_WITHDRAWL",FCrtRplc($form_data['CONFIG_MAX_WITHDRAWL']));
			$model->setConfig("CONFIG_MIN_FUND_TRANSFER",FCrtRplc($form_data['CONFIG_MIN_FUND_TRANSFER']));
			
			$model->setConfig("CONFIG_ADMIN_CHARGE",FCrtRplc($form_data['CONFIG_ADMIN_CHARGE']));
			$model->setConfig("CONFIG_SERVICE_CHARGE",FCrtRplc($form_data['CONFIG_SERVICE_CHARGE']));
			
			
			
			set_message("success","Successfully updated changes");
			redirect_page("setting","administrator",array());
		}
		
		$this->load->view(ADMIN_FOLDER.'/setting/administrator',$data);
	}
	
	public function faq(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$faq_id = ($form_data['faq_id'])? $form_data['faq_id']:_d($segment['faq_id']);
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitFAQ']==1 && $this->input->post()!=''){
					$faq_question = FCrtRplc($form_data['faq_question']);
					$faq_answer = FCrtRplc($form_data['faq_answer']);
					
					$data = array("faq_question"=>$faq_question,
						"faq_answer"=>$faq_answer,
						"faq_active"=>1
					);
					if($model->checkCount(prefix."tbl_faq","faq_id",$faq_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_faq",$data,array("faq_id"=>$faq_id));
						set_message("success","You have successfully updated a FAQ details");
						redirect_page("setting","faq",array("faq_id"=>_e($faq_id),"action_request"=>"EDIT"));					
					}else{
						$this->SqlModel->insertRecord(prefix."tbl_faq",$data);
						set_message("success","You have successfully added a FAQ detail");
						redirect_page("setting","faqlist",array());					
					}
				}
			break;
			case "DELETE":
				if($faq_id>0){
					$model->deleteTable(prefix."tbl_faq",array("faq_id"=>$faq_id));
					set_message("success","You have successfully deleted FAQ details");
				}else{
					set_message("warning","Failed , unable to delete FAQ");
				}
				redirect_page("setting","faqlist",array()); exit;
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_faq WHERE faq_id='$faq_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/setting/faq',$data);	
	}
	
	public function faqlist(){
		$this->load->view(ADMIN_FOLDER.'/setting/faqlist',$data);	
	}
	
	public function dailyreturn(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
			
		if($form_data['submitDailyReturnForm']==1 && $this->input->post()!=''){
			$type_id_array = $form_data['type_id'];
			$daily_return_array = $form_data['daily_return'];
			$date_time = InsertDate($form_data['date_time']);
			foreach($type_id_array as $key=>$value):
				$type_id = $type_id_array[$key];
				$daily_return = $daily_return_array[$key];
				if($model->getDailyReturn($type_id,$date_time)>0){
					$this->SqlModel->updateRecord(prefix."tbl_daily_return",array("daily_return"=>$daily_return),
					array("type_id"=>$type_id,"date_time"=>$date_time));
				}else{
					$data = array("type_id"=>$type_id,
						"daily_return"=>$daily_return,
						"date_time"=>$date_time
					);
					$this->SqlModel->insertRecord(prefix."tbl_daily_return",$data);
				}
			endforeach;
			set_message("success","You have successfully set daily return of ".$date_time."");
			redirect_page("setting","dailyreturn",array());		
		}
		$this->load->view(ADMIN_FOLDER.'/setting/dailyreturn',$data);	
	}
	
	public function dailyreturnprocess(){
		$model = new OperationModel();
		$form_data = $this->input->get();
		$segment = $this->uri->uri_to_assoc(2);
		$type_id = FCrtRplc($form_data['type_id']);
		$daily_return = FCrtRplc($form_data['daily_return']);
		$cmsn_date = InsertDate($form_data['cmsn_date']);
		
		$AR_PIN = $model->getPinType($type_id);
		
		$AR_RT['ErrorMsg']="invalid";
		$AR_RT['ErrorDtl']="Unable to process commission, please check all fields";
		
		$ctrl_count = $model->checkCmsnDaily($type_id,$cmsn_date);
		if($ctrl_count==0){
			if($type_id>0 && $daily_return>0){
				   $QR_CMSN = "SELECT SUM(ts.total_amt) AS trans_amount, 
					round(( SUM(ts.total_amt)*$daily_return / 100 ),2) AS cal_amount,
					tm.member_id, COUNT(tcd.daily_cmsn_id) AS total_count , tpt.no_day, ts.subcription_id, ts.type_id
					FROM tbl_subscription AS ts 
					LEFT JOIN tbl_members AS tm ON tm.member_id=ts.member_id
					LEFT JOIN tbl_cmsn_daily AS tcd ON (tcd.member_id=tm.member_id AND tcd.type_id=ts.type_id)
					LEFT JOIN tbl_pintype AS tpt ON tpt.type_id=ts.type_id
					WHERE  ts.member_id NOT IN(SELECT member_id FROM tbl_cmsn_daily WHERE DATE(cmsn_date)='".$cmsn_date."' 
					AND ts.subcription_id = (SELECT MAX(subcription_id) FROM tbl_subscription WHERE member_id=tm.member_id)
					AND type_id=ts.type_id AND member_id=ts.member_id)
					AND ts.type_id='".$type_id."'
					GROUP BY ts.member_id
					HAVING total_count<=no_day
					ORDER BY ts.subcription_id ASC";
				$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN);
				if(count($RS_CMSN)>0){
					foreach($RS_CMSN as $AR_CMSN):
						$member_id = $AR_CMSN['member_id'];
						$subcription_id = $AR_CMSN['subcription_id'];
						$trans_no = UniqueId("TRNS_NO");
						$trans_amount = $AR_CMSN['trans_amount'];
						$cal_amount = $AR_CMSN['cal_amount'];
						if($member_id>0 && $cal_amount>0 && $daily_return>0){
							$posting_no = $model->getPostingCount($type_id,$member_id);
							$remark = "DAILY RETURN [".$cmsn_date."]".",DAY NO[".$posting_no."]";
							$model->setDailyReturnIncome($subcription_id,$type_id,$member_id,$trans_no,$trans_amount,$daily_return,$cal_amount,$remark,$cmsn_date);
						}
					unset($trans_amount,$cal_amount);
					endforeach;
					$AR_RT['ErrorMsg']="success";
					$AR_RT['ErrorDtl']="Member daily return process successfully";
				}else{
					$AR_RT['ErrorMsg']="notfound";
					$AR_RT['ErrorDtl']="Member not found for this plan";
				}
			}else{
				$AR_RT['ErrorMsg']="invalid";
				$AR_RT['ErrorDtl']="Unable to process commission, please check all fields";
			}
		}else{
				$AR_RT['ErrorMsg']="processed";
				$AR_RT['ErrorDtl']="".$AR_PIN['pin_name']." is already processed for ".$cmsn_date." ";
		}
		echo json_encode($AR_RT);
	}
	
	
	public function bigcoinvalue(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$bigcoin_id = (_d($form_data['bigcoin_id'])>0)? _d($form_data['bigcoin_id']):_d($segment['bigcoin_id']);
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitBigcoin']==1 && $this->input->post()!=''){
					$bigcoin_value = FCrtRplc($form_data['bigcoin_value']);
					
					$data = array("bigcoin_value"=>$bigcoin_value);
					
					if($model->checkCount(prefix."tbl_bigcoins","bigcoin_id",$bigcoin_id)>0){
						$this->SqlModel->updateRecord(prefix."tbl_bigcoins",$data,array("bigcoin_id"=>$bigcoin_id));
						set_message("success","You have successfully updated a  bigcoins value");
						redirect_page("setting","bigcoinvaluelist","");					
					}else{
						$this->SqlModel->insertRecord(prefix."tbl_bigcoins",$data);
						set_message("success","You have successfully added  a new  bigcoins value");
						redirect_page("setting","bigcoinvaluelist",array());					
					}
				}
			break;
			case "EDIT":
				$QR_PAGE ="SELECT * FROM ".prefix."tbl_bigcoins WHERE bigcoin_id='$bigcoin_id'";
				$SEL_QUERY = $this->db->query($QR_PAGE);
				$AR_PAGE = $SEL_QUERY->row_array();
				$data['ROW'] = $AR_PAGE;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/setting/bigcoinvalue',$data);
	}
	
	public function bigcoinvaluelist(){
		$model = new OperationModel();
		$form_data = $this->input->get();
		$segment = $this->uri->uri_to_assoc(2);
		$this->load->view(ADMIN_FOLDER.'/setting/bigcoinvaluelist',$data);	
	}
	
	
}
?>