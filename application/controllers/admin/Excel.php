<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel extends MY_Controller {

	public function pagestype(){		
		$output = "";
		$QR_SELECT = "SELECT A.* FROM ".prefix."tbl_sys_menu_main AS A WHERE 1 ORDER BY A.ptype_id ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="PAGES_TYPE_EXCEL_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	public function submenu(){		
		$output = "";
		$QR_SELECT = "SELECT A.* FROM ".prefix."tbl_sys_menu_sub AS A WHERE 1 ORDER BY A.page_id ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="SUB_PAGES_EXCEL_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	public function operator(){		
		$output = "";
		$QR_SELECT = "SELECT top.*, tog.group_name FROM ".prefix."tbl_operator AS top 
		   LEFT JOIN tbl_oprtr_grp AS tog ON top.fldiGrpId=tog.group_id  
		   WHERE 1 $StrWhr ORDER BY top.fldiOprtrId ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="OPERATOR_EXCEL_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	public function cms(){
		$output = "";
		$QR_SELECT = "SELECT cms.* FROM ".prefix."tbl_cms AS cms   WHERE 1 $StrWhr ORDER BY cms.id_cms ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="CMS_EXCEL_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function member(){
		$output = "";
		$QR_SELECT = "SELECT tm.user_id as USERID,tm.first_name as USERNAME,tm.member_email as EMAIL_ID,tm.member_mobile as MOBILE,ts.prod_pv as Current_Package, tmsp.first_name AS Sponsor_Name,tmsp.user_id AS Sponsor_userID , tree.date_join as DATE_OF_Joining , ts.date_from as Date_of_Activations FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_subscription AS ts  ON ts.member_id=tm.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 WHERE 1 ORDER BY tm.member_id ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="MEMBER_LIST_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
		function withdrawals(){
		$output = "";
			$segment = $this->uri->uri_to_assoc(2);
		  if($segment['status'] !='')
			{
			   	$StrWhr .=" AND tft.trns_status='".$segment['status']."'";
			}
			else
			{
			    $StrWhr .=" AND tft.trns_status='P'";  
			}
			
	  if($segment['group']  =='all')
			{
			   	$group  = 'GROUP BY tft.transfer_id';
			}
			else
			{
			  	$group  = 'GROUP BY tm.account_number';
			}

	  	$QR_SELECT = "SELECT tm.user_id  as ID_No ,tm.bank_acct_holder as Acc_HolderName,concat('*',tm.account_number) as AccountNo,tm.bank_name as BankName ,   tm.ifc_code as IFSCCode, tm.member_mobile as MobileNumber ,   sum(tft.trns_amount) as PayoutAmount,tft.trns_date  as WithdrawalDate FROM tbl_fund_transfer AS tft 
		   LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id WHERE  tft.trns_for LIKE 'WITHDRAW' AND ( tft.wallet_id= '1' or  tft.wallet_id= '2' ) $StrWhr  $group
		  ORDER BY tft.transfer_id DESC   ";
	 $sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="WITHDRAWALS_LIST_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function advert(){
		$output = "";
		$QR_SELECT = "SELECT ta.* FROM ".prefix."tbl_advert AS ta WHERE ta.isDelete>0 $StrWhr ORDER BY ta.advert_id ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="ADVERT_LIST_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function oprtlog(){	
		$output = "";
		$QR_SELECT = "SELECT tol.* FROM ".prefix."tbl_oprtr_logs AS tol WHERE 1 $StrWhr ORDER BY tol.login_id ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="OPERATOR_LOG_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function processor(){
		$output = "";
		$QR_SELECT = "SELECT tpp.* FROM ".prefix."tbl_payment_processor AS tpp WHERE 1 $StrWhr ORDER BY tpp.processor_id ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="PAYMENT_PROCESSOR_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function plan(){
		$output = "";
		$QR_SELECT = "SELECT tp.* FROM ".prefix."tbl_package AS tp	 WHERE tp.delete_sts>0  AND tp.package_id>0 $StrWhr ORDER BY tp.package_id ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="PLAN_DETAIL_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function citylist(){
		$output = "";
		$QR_SELECT = "SELECT tc.* FROM ".prefix."tbl_city AS tc   WHERE tc.isDelete>0 $StrWhr ORDER BY tc.country_code ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="CITY_LIST_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function support(){
		$output = "";
		$QR_SELECT = "SELECT ts.*, tm.user_id,tm.first_name, tm.midle_name,tm.last_name FROM ".prefix."tbl_support AS ts 
			LEFT JOIN tbl_members AS tm ON ts.from_id=tm.member_id WHERE 1 $StrWhr ORDER BY ts.enquiry_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="CONTACT_SUPPORT_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function faq(){
		$output = "";
		$QR_SELECT = "SELECT tf.* FROM ".prefix."tbl_faq AS tf   WHERE tf.faq_delete>0 $StrWhr ORDER BY tf.faq_id ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="FAQ_LIST_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function pintype(){
		$output = "";
		$QR_SELECT = "SELECT tpy.* FROM ".prefix."tbl_pintype AS tpy WHERE tpy.isDelete>0 $StrWhr ORDER BY tpy.type_id ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="EPIN_TYPE_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	function pinmaster(){
		$output = "";
		$QR_SELECT = "SELECT tpm.*, tpy.pin_name, tpy.pin_letter, tm.user_id FROM ".prefix."tbl_pinsmaster AS tpm 
			LEFT  JOIN ".prefix."tbl_pintype AS tpy ON tpm.type_id=tpy.type_id
			LEFT JOIN ".prefix."tbl_members AS tm ON tpm.member_id=tm.member_id
			 WHERE 1 $StrWhr ORDER BY tpm.mstr_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="EPIN_MASTER_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
		public function funrequestconfirmed(){		
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$process_id = FCrtRplc($segment);
		$StrWhr .=($process_id>0)? " AND tcb.process_id='".$process_id."'":"";
		$QR_SELECT = "SELECT tm.user_id  as User_Name, tft.mode as MODE,tft.request_amount as AMOUNT,tft.deposit_date as DEPOSIT_DATE,tft.remark as REMARKS,tft.trn_hascode as HASH_CODE,tft.date_time as CONFIRM_DATE,tft.status as STATUS  FROM tbl_fund_request AS tft 
       LEFT JOIN tbl_members AS tm ON tft.member_id=tm.member_id 
      
       WHERE  tft.status IN('S') 
       $StrWhr ORDER BY tft.request_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="FUNDREQUEST_CONFIRM_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	public function binaryincome(){		
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$process_id = FCrtRplc($segment);
		$StrWhr .=($process_id>0)? " AND tcb.process_id='".$process_id."'":"";
		$QR_SELECT = "SELECT  tm.user_id as UserId, CONCAT_WS(' ',tm.first_name,tm.last_name) AS Name, tm.city_name as City,
					 tcb.net_cmsn AS AMOUNT,  tcb.date_time AS DATE_TIME  FROM ".prefix."tbl_cmsn_binary AS tcb 
					 LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcb.member_id
					 WHERE 1 $StrWhr ORDER BY tcb.binary_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="BINARY_INCOME_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
		public function totalincome(){		
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$process_id = FCrtRplc($segment);
		$StrWhr .=($process_id>0)? " AND tcm.process_id='".$process_id."'":"";
$QR_SELECT="SELECT  tm.user_id as UserId ,concat(tm.first_name,' ',tm.last_name) as Name,tm.city_name as City,tcm.binary_income AS BinaryIncome,tcm.direct_income as TurboIncome,tcm.turbobonus as TurboBonus,tcm.leadership as LeadershipIncome,tcm.total_income as TotalIncome,tcm.tds as TDS,tcm.net_income as NetIncome,concat(tp.start_date,' To ', tp.end_date) Date
		 FROM ".prefix."tbl_cmsn_mstr AS tcm
		 LEFT JOIN ".prefix."tbl_process AS tp ON tp.process_id=tcm.process_id
		 LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcm.member_id
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
		 WHERE 1 $StrWhr ORDER BY tcm.master_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="BINARY_INCOME_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
		public function cryptopaymenthistory(){		
		$output = "";



$QR_SELECT="SELECT tmt.user_id  AS MEMBER_ID ,tft.date_time as Date_,tft.symbol as Crypto_Symbol,tft.amount as BUSD,tft.hash_no as Hash_No FROM ".prefix."tbl_cryptofund AS tft 
			
			 LEFT JOIN tbl_members AS tmt ON tmt.member_id=tft.member_id	
			 WHERE  1  $StrWhr  ORDER BY tft.id DESC ";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="CRYPTO_ADDFUND_HISTORY_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
		public function payoutpendingmerze(){		
		$output = "";

// New Query Group by Account No
$QR_SELECT="SELECT tm.user_id  AS MEMBER_ID,tm.first_name as NAME ,date(tft.date_time) as Date_,sum(tft.initial_amount) as Total_INR,sum(tft.admin_charge) as Admin_Charge ,sum((tft.initial_amount)-(tft.admin_charge)) as Withdrawl_INR,concat('*',tm.account_number) as ACCOUNT_NO,tm.bank_name as BANK_NAME,tm.ifc_code as IFSC_CODE,tm.bank_acct_holder as HOLDER_NAME ,tm.trx_address as Crypto_Address FROM tbl_fund_transfer AS tft 
LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 

WHERE  (tft.trns_for = 'WITHDRAW' and  tft.trns_status =  'P') AND  ( tft.wallet_id='1' or  tft.wallet_id='2')
$StrWhr group by tm.account_number  ORDER BY tft.transfer_id DESC";
       
       
       
       
// Old Query Single
// $QR_SELECT="SELECT tm.user_id  AS MEMBER_ID,tm.first_name as NAME ,tft.date_time as Date_,tft.initial_amount as Total_INR,tft.admin_charge as Admin_Charge ,(tft.initial_amount)-(tft.admin_charge) as Withdrawl_INR,tm.account_number as ACCOUNT_NO,tm.bank_name as BANK_NAME,tm.ifc_code as IFSC_CODE,tm.bank_acct_holder as HOLDER_NAME  ,tft.cryptoname as Crypto_NAME,tft.trxaddresstrxaddress_Address,tft.hashcode as Hash_Code,tft.remarks as Remarks  FROM tbl_fund_transfer AS tft 
// LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 

// WHERE  (tft.trns_for = 'WITHDRAW' and  tft.trns_status =  'P') AND  ( tft.wallet_id='1' or  tft.wallet_id='2')
// $StrWhr ORDER BY tft.transfer_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="PENDING_PAYOUT_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	
		public function payoutpendingsingle(){		
		$output = "";

// New Query Group by Account No
// $QR_SELECT="SELECT tm.user_id  AS MEMBER_ID,tm.first_name as NAME ,date(tft.date_time) as Date_,sum(tft.initial_amount) as Total_INR,sum(tft.admin_charge) as Admin_Charge ,sum((tft.initial_amount)-(tft.admin_charge)) as Withdrawl_INR,tm.account_number as ACCOUNT_NO,tm.bank_name as BANK_NAME,tm.ifc_code as IFSC_CODE,tm.bank_acct_holder as HOLDER_NAME ,tm.trx_address as Crypto_Address FROM tbl_fund_transfer AS tft 
// LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 

// WHERE  (tft.trns_for = 'WITHDRAW' and  tft.trns_status =  'P') AND  ( tft.wallet_id='1' or  tft.wallet_id='2')
// $StrWhr group by tm.account_number  ORDER BY tft.transfer_id DESC";
       
       
       
       
// Old Query Single
$QR_SELECT="SELECT tm.user_id  AS MEMBER_ID,tm.first_name as NAME ,date(tft.date_time) as Date_,tft.initial_amount as Total_INR,tft.admin_charge as Admin_Charge ,(tft.initial_amount)-(tft.admin_charge) as Withdrawl_INR,concat('*',tm.account_number) as ACCOUNT_NO,tm.bank_name as BANK_NAME,tm.ifc_code as IFSC_CODE,tm.bank_acct_holder as HOLDER_NAME  ,tft.cryptoname as Crypto_NAME,tm.trx_address as _Address,tft.hashcode as Hash_Code,tft.remarks as Remarks  FROM tbl_fund_transfer AS tft 
LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 

WHERE  (tft.trns_for = 'WITHDRAW' and  tft.trns_status =  'P') AND  ( tft.wallet_id='1' or  tft.wallet_id='2')
$StrWhr ORDER BY tft.transfer_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="PENDING_PAYOUT_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	public function payoutconfirmed(){		
		$output = "";




$QR_SELECT="SELECT tmt.user_id  AS MEMBER_ID ,tft.date_time as Date_,tft.initial_amount as Total_BUSD,tft.admin_charge as Admin_Charge ,(tft.initial_amount)-(tft.admin_charge) as Withdrawl_BUSD,tft.cryptoname as Crypto_NAME,tft.trxaddress as Crypto_Address,tft.hashcode as Hash_Code,tft.remarks as Remarks FROM ".prefix."tbl_fund_transfer AS tft 
			
			 LEFT JOIN tbl_members AS tmt ON tmt.member_id=tft.to_member_id	
			  WHERE  tft.trns_for LIKE 'WITHDRAW' AND  ( tft.wallet_id='1' or  tft.wallet_id='2')
       $StrWhr ORDER BY tft.transfer_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="CONFIRM_PAYOUT_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	public function investincome(){
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT   CONCAT_WS(' ',tm.first_name,tm.last_name) AS FULL_NAME, tmi.trans_no AS TRANS_NO, tmi.trns_amount AS AMOUNT, 
		             tmi.trns_remark AS TRANS_REMARK, tmi.date_time AS DATE_TIME
					 FROM ".prefix."tbl_mem_invest AS tmi 
					 LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tmi.member_id
					 WHERE tmi.member_id='".$member_id."' $StrWhr ORDER BY tmi.invest_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="RE-INVESTMENT_INCOME_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
		public function timer_pool(){		
	    
	    $segment = $this->uri->uri_to_assoc(3);
	   $process_id = $segment['directincome'];
//	wallet_trns_id	trans_ref_no	member_id	wallet_id	trns_type	trns_amount	isActive	trns_remark	trns_for	trns_date	date_time

		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT twt.trns_date as Date ,tm.user_id as Member_ID, twt.trns_amount as Pool_Amount,twt.trns_remark as Pool_Remark FROM ".prefix."tbl_wallet_trns AS twt 
			 LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=twt.member_id
			   WHERE 1 AND twt.wallet_id='1' and trns_for ='Pool'
			   $StrWhr 
			   ORDER BY twt.wallet_trns_id DESC"; 
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="POOL_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
		public function level_income(){		
	    
	    $segment = $this->uri->uri_to_assoc(3);
	   $process_id = $segment['directincome'];
//	wallet_trns_id	trans_ref_no	member_id	wallet_id	trns_type	trns_amount	isActive	trns_remark	trns_for	trns_date	date_time

		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT tcd.date_time as Date,tcd.level as Level, tmm.user_id as Member_ID, tm.user_id as From_Member_ID,tcd.net_income as Net_Amount FROM ".prefix."tbl_cmsn_level AS tcd 
			  LEFT JOIN tbl_members AS tm ON tcd.from_member_id	=tm.member_id
			   LEFT JOIN tbl_members AS tmm ON tcd.member_id	=tmm.member_id
			  WHERE 1 ORDER BY tcd.id DESC"; 
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="Level_Income_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
		public function booster_list(){		
	    
	    $segment = $this->uri->uri_to_assoc(3);
	   $process_id = $segment['booster_list'];

		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT tcd.date_time as Date_, CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name, tm.user_id  as Member_ID ,tcd.trans_amount as Total_Turnover, CONCAT_WS(' ',tcd.daily_return ,'  % ') as Daily_Returns  ,tcd.net_income as Net_Income
                FROM ".prefix."tbl_cmsn_quick AS tcd 
               LEFT JOIN tbl_members AS tm ON tcd.member_id=tm.member_id
            
              WHERE tcd.process_id='$process_id'  ORDER BY tcd.member_id DESC";  
         
              
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="BOOSTER_INCOME_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
		public function topupfund_list(){		
	    
	    $segment = $this->uri->uri_to_assoc(3);
	   $process_id = $segment['topupfund_list'];

		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT tcd.date_time as Date_, CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name, tm.user_id  as Member_ID ,tcd.trans_amount as Total_Turnover, CONCAT_WS(' ',tcd.daily_return ,'  % ') as Daily_Returns ,tcd.net_income as Net_Income
                FROM ".prefix."tbl_cmsn_quick AS tcd 
               LEFT JOIN tbl_members AS tm ON tcd.member_id=tm.member_id
            
              WHERE tcd.process_id='$process_id'  ORDER BY tcd.member_id DESC";   
         
              
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="AUTO_FUND_INCOME_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
		public function reward_list(){		
	    
	    $segment = $this->uri->uri_to_assoc(3);
	   // PrintR($segment);
	   $rewardId = $segment['reward_list'];

		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT tm.user_name AS Member_ID, CONCAT_WS(' ',tm.first_name,tm.midle_name,tm.last_name) as Full_Name, r.net_income as Net_income FROM  tbl_members AS tm  LEFT JOIN tbl_cmsn_reward AS r ON tm.member_id=r.member_id WHERE r.reward_id='$rewardId'";  
         
      // die;       
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="REWARD_INCOME_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	public function directincome(){		
	    
	    $segment = $this->uri->uri_to_assoc(3);
	   $process_id = $segment['directincome'];
	 //   PRintR($segment);
// 	    date_time
// to_user_name
// to_name
// from_user_name
// total_collection
// net_income
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT tcd.date_time as Date_,tmt.user_name AS Distributor_Id,  tmt.full_name AS Name_, tmf.user_name AS From_Distributer_ID,tcd.total_collection as Total_Amount,tcd.net_income as Net_Income
                FROM ".prefix."tbl_cmsn_direct AS tcd 
               LEFT JOIN tbl_members AS tmf ON tcd.from_member_id=tmf.member_id
               LEFT JOIN tbl_members AS tmt ON tmt.member_id=tcd.member_id
              WHERE tcd.process_id='$process_id'  ORDER BY tcd.direct_id DESC"; 
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="DIRECT_INCOME_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	public function targetachive(){	
	$model = new OperationModel();	
		$output = "";
		$QR_PAGES= "SELECT mem.* FROM tbl_subscription AS sub LEFT JOIN tbl_members AS mem ON sub.member_id=mem.member_id";
	$PageVal = DisplayPages($QR_PAGES, 1000, $Page, $SrchQ);
		$Ctrl = 0;
		
		foreach($PageVal['ResultSet'] as $AR_DT):
							$member_id = $AR_DT['member_id'];
							$left = $model->targetcount($member_id,'LeftPaid');
							$right = $model->targetcount($member_id,'RightPaid');
							if($left >=5 and $right >= 5){
							
					     $columns_total[$Ctrl]['Sn']=$Ctrl+1; 
						 $columns_total[$Ctrl]['UserId'] = $AR_DT['user_name'];
						 $columns_total[$Ctrl]['Name'] = $AR_DT['first_name'].' '.$AR_DT['last_name'];
						 $columns_total[$Ctrl]['City'] = $AR_DT['city_name'];
						 $columns_total[$Ctrl]['Left'] = $left; 
						 $columns_total[$Ctrl]['Right'] = $right;
						  
						   
						    $Ctrl++;  
							
							}
							endforeach;
						
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="Reward";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	
	public function dailyincome(){
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT CONCAT_WS(' ',tm.first_name,tm.last_name) AS MEMBER_NAME , tpt.pin_name AS PLAN_NAME, tcd.cmsn_date AS CMSN_DATE,
			   tcd.trans_no AS TRANS_NO, tcd.trans_amount AS AMOUNT , tcd.daily_return AS DAILY_RETURN, tcd.net_income AS NET_INCOME
			   FROM ".prefix."tbl_cmsn_daily AS tcd 
			   LEFT JOIN tbl_members AS tm ON tcd.member_id=tm.member_id
			   LEFT JOIN tbl_pintype AS tpt ON tpt.type_id=tcd.type_id
			   WHERE 1 $StrWhr ORDER BY tcd.daily_cmsn_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="DAILY_INCOME_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	
	public function allincome(){
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT CONCAT_WS(' ',tm.first_name,tm.last_name) AS MEMBER_NAME,  tcm.process_id AS PROCESS_NO, tcm.binary_income AS BINARY_INCOME, 
		             tcm.direct_income AS DIRECT_INCOME, tcm.total_income AS TOTAL_INCOME, tcm.admin_charge AS ADMIN_CHARGE,  
					 tcm.net_income AS NET_INCOME, tcm.date_time AS DATE_TIME 	 FROM ".prefix."tbl_cmsn_mstr AS tcm 
					 LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcm.member_id
					 WHERE 1 $StrWhr ORDER BY tcm.master_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="DIRECT_INCOME_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	public function event(){
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT te.* FROM ".prefix."tbl_event AS te   WHERE event_id>0 $StrWhr ORDER BY te.date_time DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="EVENT_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	public function ppt(){
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT tp.* FROM ".prefix."tbl_ppt AS tp  
		   LEFT JOIN ".prefix."tbl_country AS tc on tp.ppt_country=tc.country_iso
		   WHERE tp.ppt_delete>0 $StrWhr ORDER BY tp.ppt_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="PPT_DOWNLOAD_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
		public function totolincome(){
		$output = "";
		$member_id = $this->session->userdata('mem_id');
			$segment = $this->uri->uri_to_assoc(3);
	//	PrintR($segment['totolincome']);
//	die;
	if($segment['totolincome']>0){
	$process_id  = $segment['totolincome'];
	$StrWhr .=" AND tcm.process_id='".$process_id."'";
	$SrchQ .="&process_id=$process_id";
}

 $QR_SELECT="SELECT tm.user_id as USERID,tm.first_name as NAME,tm.prod_pv as USER_Package,tcm.residual as ROI_income,tcm.level as Level_Income,tcm.net_income as Net_Amount, date(tp.start_date) as DAte FROM tbl_cmsn_mstr AS tcm LEFT JOIN tbl_process AS tp ON tp.process_id=tcm.process_id LEFT JOIN tbl_members AS tm ON tm.member_id=tcm.member_id LEFT JOIN tbl_pintype AS tpt ON tpt.type_id=tm.type_id WHERE 1 $StrWhr ORDER BY tm.first_name,tm.midle_name,tm.last_name ASC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="TOTALCOMMISIONLIST_DATEWISE";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	public function subscription(){
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT ="SELECT  IF(ts.roi_stacking='S', 'Plan B', 'Plan A') as Plan_NAME, tm.`prod_pv` as Package_amount ,tm.user_id as USERID,CONCAT_WS(' ',tm.first_name,tm.last_name) AS USER_NAME, tmsp.user_id AS Sponsor_USERID FROM tbl_subscription AS ts LEFT JOIN tbl_pintype AS tp ON tp.type_id=ts.type_id LEFT JOIN tbl_members AS tm ON tm.member_id=ts.member_id LEFT JOIN tbl_members AS tmsp ON tm.sponsor_id=tmsp.member_id WHERE 1 $StrWhr
				GROUP BY ts.subcription_id
				ORDER BY ts.subcription_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="SUBSCRIPTION_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
   public function bigcoinvalue(){
   		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT tb.* FROM ".prefix."tbl_bigcoins AS tb   WHERE tb.bigcoin_id>0 $StrWhr ORDER BY tb.bigcoin_id DESC";
		$sql = $this->db->query($QR_SELECT);
		$columns_total = $sql->list_fields();
		for ($i = 0; $i < count($columns_total); $i++) {
			$heading = $columns_total[$i];
			$output .= '"'.$heading.'",';
		}
			$output .="\n";
				
		$fetchRows = $sql->result_array();
		foreach($fetchRows as $row):
			for ($i = 0; $i < count($columns_total); $i++) {
				$output .='"'.$row[$columns_total[$i]].'",';
			}
			$output .="\n";
		endforeach;
		$FileName="BIGCOINS_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
   }
	
	
}
?>