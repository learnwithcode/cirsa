<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends MY_Controller {

	public function binaryincome(){		
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT CONCAT_WS(' ',first_name,last_name) AS FULL_NAME,  tp.start_date AS START_DATE, tp.end_date AS END_DATE, 
		             tcb.preRcrf AS PRE_RIGHT_FORWARD, tcb.newLft AS NEW_LEFT,  tcb.newRgt AS NEW_RIGHT, tcb.totalLft AS TOTAL_LEFT, 
					 tcb.totalRgt AS  TOTAL_RIGHT, tcb.pair_match AS PAIR_MATCH, tcb.leftCrf AS LEFT_FORWARD, tcb.rightCrf AS RIGHT_FORWARD, 
					 tcb.net_cmsn AS AMOUNT,  tcb.date_time AS DATE_TIME  
					 FROM ".prefix."tbl_cmsn_binary AS tcb 
					  LEFT JOIN ".prefix."tbl_process AS tp ON tp.process_id=tcb.process_id
					 LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcb.member_id
					 WHERE tcb.member_id='".$member_id."' 
					 $StrWhr ORDER BY tcb.binary_id DESC";
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
	
	public function directincome(){		
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT CONCAT_WS(' ',first_name,last_name) AS FROM_MEMBER,   tcd.total_collection AS TOTAL_COLLECTION, 
		           tcd.total_income AS TOTAL_INCOME,  tcd.net_income AS NET_INCOME, 
					 tcd.cash_account AS CASH_ACCOUNT, 
					 tcd.trading_account AS TRADING_ACCOUNT, tcd.date_time AS DATE_TIME  
					 FROM ".prefix."tbl_cmsn_direct AS tcd 
					 LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcd.from_member_id
					 WHERE tcd.member_id='".$member_id."' $StrWhr ORDER BY tcd.direct_id DESC";
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
	
	
	public function allincome(){
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT CONCAT_WS(' ',first_name,last_name) AS MEMBER_NAME,  tcm.process_id AS PROCESS_NO, tcm.binary_income AS BINARY_INCOME, 
		             tcm.direct_income AS DIRECT_INCOME, tcm.total_income AS TOTAL_INCOME, tcm.admin_charge AS ADMIN_CHARGE,  
					 tcm.net_income AS NET_INCOME, tcm.date_time AS DATE_TIME 	 FROM ".prefix."tbl_cmsn_mstr AS tcm 
					 LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcm.member_id
					 WHERE tcm.member_id='".$member_id."' $StrWhr ORDER BY tcm.master_id DESC";
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
	
	public function dailyreturn(){
		$output = "";
		$member_id = $this->session->userdata('mem_id');
		$QR_SELECT = "SELECT  tcd.trans_no AS TRANS_NO, tcd.trans_amount AS AMOUNT, 
		             tcd.daily_return AS DAILY_RETURN , tcd.net_income AS DAILY_RETURN_AMOUNT ,
					 tcd.trns_remark AS REMARK, tcd.date_time AS DATE_TIME
					 FROM ".prefix."tbl_cmsn_daily AS tcd 
					 WHERE tcd.member_id='".$member_id."' 
					 $StrWhr 
					 ORDER BY tcd.daily_cmsn_id DESC";
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
		$FileName="DAILY_RETURN_INCOME_DOWNLOAD_";
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
		$QR_SELECT = "SELECT  tmi.trans_no AS TRANS_NO, tmi.trns_amount AS AMOUNT, 
		             tmi.trns_remark AS TRANS_REMARK, tmi.date_time AS DATE_TIME
					 FROM ".prefix."tbl_mem_invest AS tmi 
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
	
	
	
}
