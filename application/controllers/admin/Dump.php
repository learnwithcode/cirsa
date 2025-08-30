<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dump extends MY_Controller {

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
	 
	public function __construct() {
        parent::__construct();
		$this->load->view('excel/reader');
    }
	 
	public function index(){
		$this->load->view(ADMIN_FOLDER.'/login');
	}
	
	public function excelmember(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = InsertDate(getLocalTime());
		if($form_data['submitExcel']==1 && $this->input->post()!=''){
			$this->db->query("TRUNCATE member_list");
			if($_FILES['upload_member']['error']==0){
					$data = new Spreadsheet_Excel_Reader();
					$data->setOutputEncoding('CP1251');
					$data->read($_FILES['upload_member']['tmp_name']);
						for($i=2; $i <= $data->sheets[0]['numRows']; $i++):
							$username = (trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][2])));
							$full_name = (trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][3])));
							$sponsor_id = (trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][4])));
							$mobile = (trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][5])));
							$doj = InsertDate(trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][6])));
							$password = (trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][7])));
							$trns_password = (trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][8])));
							$amount = (trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][9])));
							$left_right = (trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][10])));
							$spill_id = (trim(str_replace("'","\'", $data->sheets[0]['cells'][$i][11])));
							
							$data_mem = array("full_name"=>$full_name,
								"username"=>$username,
								"password"=>$password,
								"trns_password"=>$trns_password,
								"doj"=>$doj,
								"mobile"=>$mobile,
								"topup_pack"=>$amount,
								"sponsor_id"=>$sponsor_id,
								"spill_id"=>$spill_id,
								"left_right"=>($left_right)? $left_right:''
							);
							$this->SqlModel->insertRecord(prefix."member_list",$data_mem);
						endfor;
						
			}
		}
		
		$this->load->view(ADMIN_FOLDER.'/dump/excelmember');
	}
	
	
	public function dumpmembersubscription(){
		$model = new OperationModel();
		$form_data = $this->input->get();
		$today_date = InsertDate(getLocalTime());
		$wallet_id = $model->getWallet(WALLET1);
		$this->db->query("TRUNCATE tbl_subscription");
		$this->db->query("TRUNCATE tbl_cmsn_daily");
		$this->db->query("TRUNCATE tbl_cmsn_direct");
		$this->db->query("TRUNCATE tbl_wallet_trns");
		#$this->db->query("DELETE FROM  tbl_wallet_trns WHERE trns_for='DRT' AND trns_type='Cr'");
		$this->db->query("UPDATE  tbl_members SET type_id='0', package_id='0', subcription_id='0', upgrade_date='0000-00-00' WHERE 1");

		$QR_FROM = "SELECT * FROM member_subscription WHERE 1 ORDER BY sub_id ASC";
		$RS_FROM = $this->SqlModel->runQuery($QR_FROM);
		foreach($RS_FROM as $AR_FROM):
			$member_id = $model->getMemberId($AR_FROM['user_id']);
			$date_time = $upgrade_date = InsertDate($AR_FROM['date_time']);
			
			$amount = str_replace(',', '', $AR_FROM['amount']);
			$bigcoins = $AR_FROM['bigcoins'];
			
			$QR_OLD = "SELECT * FROM member_list WHERE username='".$username."'";
			$AR_OLD = $this->SqlModel->runQuery($QR_OLD,true);
			
			
			if($amount>0){
					$AR_PACK = $model->getMemberPackage($amount);	
					$no_day = $AR_PACK['no_day'];
					$date_expire = InsertDate(AddToDate($upgrade_date,"+ $no_day Days"));
					
					$order_no = UniqueId("ORDER_NO");
					$daily_return = $AR_PACK['daily_return'];
					$data_sub = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"type_id"=>$AR_PACK['type_id'],
						"package_price"=>0,
						"net_amount"=>$amount,
						"prod_pv"=>0,
						"reinvest_amt"=>($reinvest_amt>0)? $reinvest_amt:0,
						"total_amt"=>$amount,
						"date_from"=>$date_time,
						"date_expire"=>$date_expire
					);
					
					$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);			
					
					$data_mem = array("type_id"=>$AR_PACK['type_id'],
						"subcription_id"=>$subcription_id,
						"upgrade_date"=>$upgrade_date
					);
					
					$this->SqlModel->updateRecord(prefix."tbl_members",$data_mem,array("member_id"=>$member_id));
					
					$till_date = InsertDate(AddToDate($today_date,"- 1 Days"));
					$no_of_days = getDayDiff($till_date,$upgrade_date);
					
					for($i=1; $i<=$no_of_days; $i++):
						$cmsn_date = InsertDate(AddToDate($upgrade_date,"+ $i Days"));
						$day = getDateFormat($cmsn_date,"D");
						
						$trans_no = UniqueId("TRNS_NO");
						$posting_no = $model->getPostingCount($AR_PACK['type_id'],$member_id,$cmsn_date);
						
						$AR_MNG = $model->getReturnMining($AR_PACK['type_id'],$posting_no);
						$mining_return = $AR_MNG['mining_return'];
						if($mining_return>0){
							$net_income = ($amount*$mining_return)/100;
							$trns_remark = "DAILY RETURN [".$cmsn_date."]".",DAY NO[".$posting_no."], R.O.I [ ".$mining_return." ]";
							$data_cmsn = array("member_id"=>$member_id,
								"subcription_id"=>$subcription_id,
								"type_id"=>$AR_PACK['type_id'],
								"trans_no"=>$trans_no,
								"trans_amount"=>$amount,
								"daily_return"=>$mining_return,
								"net_income"=>$net_income,
								"trns_remark"=>$trns_remark,
								"cmsn_date"=>$cmsn_date
							);
							
							$this->SqlModel->insertRecord(prefix."tbl_cmsn_daily",$data_cmsn);
							$model->wallet_transaction($wallet_id,"Cr",$member_id,$net_income,$trns_remark,$cmsn_date,$trans_no,1,"DRT");
						}
						unset($net_income,$mining_return);
					endfor;
					unset($data);
			}
		endforeach;
	}
	
	
}
?>
