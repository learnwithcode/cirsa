<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	
	public function jsonhandler(){	
		$model = new OperationModel();
		$switch_type  = $this->input->get('switch_type');
		switch($switch_type){
			case "CMS":
				$id_cms = $this->input->get('id_cms');
				$AR_SET = $this->SqlModel->runQuery("SELECT active FROM ".prefix."tbl_cms WHERE id_cms='$id_cms'",true);
				$active = $AR_SET['active'];
				$new_active = ($active>0)? 0:1;
				$data_up = array("active"=>$new_active);
				$this->SqlModel->updateRecord(prefix."tbl_cms",$data_up,array("id_cms"=>$id_cms));
				$AR_RT['ErrorMsg']="success";
				echo json_encode($AR_RT);
			break;
				case "POPUP":
				$popup_id = $this->input->get('popup_id');
				$AR_SET = $this->SqlModel->runQuery("SELECT soft_status FROM ".prefix."tbl_popup_data WHERE popup_id='$popup_id'",true);
				$active = $AR_SET['soft_status'];
				$new_active = ($active=='Y')? "N":"Y";
				$data_up = array("soft_status"=>$new_active);
				$this->SqlModel->updateRecord(prefix."tbl_popup_data",$data_up,array("popup_id"=>$popup_id));
				$AR_RT['ErrorMsg']="success";
				echo json_encode($AR_RT);
			break;
			case "FAQ":
				$faq_id = $this->input->get('faq_id');
				$AR_SET = $this->SqlModel->runQuery("SELECT faq_active FROM ".prefix."tbl_faq WHERE faq_id='$faq_id'",true);
				$faq_active = $AR_SET['faq_active'];
				$new_active = ($faq_active>0)? 0:1;
				$data_up = array("faq_active"=>$new_active);
				$this->SqlModel->updateRecord(prefix."tbl_faq",$data_up,array("faq_id"=>$faq_id));
				$AR_RT['ErrorMsg']="success";
				echo json_encode($AR_RT);
			break;
			case "CHECK_SPR":
				$sponsor_user_id = $this->input->get('sponsor_user_id');
				$left_right = $this->input->get('left_right');
				$Q_SPR = "SELECT tm.member_id FROM ".prefix."tbl_members AS tm WHERE tm.user_id='".$sponsor_user_id."'";
				$A_SPR = $this->SqlModel->runQuery($Q_SPR,true);
				if($A_SPR['member_id']>0 && ($left_right=='L' || $left_right=="R")){
					$spil_id = $model->ExtrmLftRgt($A_SPR['member_id'],$left_right);
					$AR_RT['spil_id'] = $spil_id;
					$AR_RT['sponsor_id'] = $A_SPR['member_id'];
					
				}
				echo json_encode($AR_RT);
			break;
			case "ADVRT_CONTENT":
				$advert_id = FCrtRplc($_REQUEST['advert_id']);
				if($advert_id>0){
					$QR_ADVRT = "SELECT ta.* FROM tbl_advert AS ta WHERE ta.advert_id='$advert_id'";
					$AR_ADVERT = $this->SqlModel->runQuery($QR_ADVRT,true);
					if($AR_ADVERT['advert_link']!=''){
						echo '<iframe src="'.$AR_ADVERT['advert_link'].'" style="min-height:500px;" width="100%" height="auto"  scrolling="auto"  frameborder="0"></iframe>';
					}else{
						echo '<div class="alert alert-block alert-danger">Link not found </div>';
					}
				}
			break;
			case "STATE_LIST":
				$country_code = FCrtRplc($_REQUEST['country_code']);
				$Q_SPR = "SELECT DISTINCT  tc.state_name FROM ".prefix."tbl_city AS tc WHERE tc.country_code='".$country_code."'";
				$A_SPRS = $this->SqlModel->runQuery($Q_SPR);
				echo "<option value=''>----select----</option>";
				foreach($A_SPRS as $A_SPR):
					echo "<option value='".$A_SPR['state_name']."'>".$A_SPR['state_name']."</option>";
				endforeach;
				echo "<option value='Other'>Other</option>";
			break;
			case "CITY_LIST":
				$state_name = FCrtRplc($_REQUEST['state_name']);
				$Q_SPR = "SELECT DISTINCT  tc.city_name FROM ".prefix."tbl_city AS tc WHERE tc.state_name LIKE '".$state_name."'";
				$A_SPRS = $this->SqlModel->runQuery($Q_SPR);
				echo "<option value=''>----select----</option>";
				foreach($A_SPRS as $A_SPR):
					echo "<option value='".$A_SPR['city_name']."'>".$A_SPR['city_name']."</option>";
				endforeach;
				echo "<option value='Other'>Other</option>";
			break;
			case "PIN_TYPE":
				$type_id = $this->input->get('type_id');
				$QR_GET = "SELECT * FROM ".prefix."tbl_pintype WHERE type_id='$type_id'";
				$AR_SET = $this->SqlModel->runQuery($QR_GET,true);
				echo json_encode($AR_SET);
			break;
			case "WITHDRAW_AMOUNT":
				$transfer_id = $this->input->get('transfer_id');
				$trns_amount = $this->input->get('trns_amount');
				$AR_TRF = $model->getFundTransfer($transfer_id);
				if($transfer_id>0 && $trns_amount>0 && $trns_amount<=$AR_TRF['initial_amount']){
					if($AR_TRF['trns_status']=="P"){
						$withdraw_fee = $AR_TRF['initial_amount']-$trns_amount;
						$data = array("withdraw_fee"=>$withdraw_fee,
							"trns_amount"=>$trns_amount
						);
						$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",$data,array("transfer_id"=>$transfer_id));
						$AR_RT['ErrorMsg']="success";
					}else{
						$AR_RT['ErrorMsg']="already";
					}
				}else{
					$AR_RT['ErrorMsg']="failed";
				}
				echo json_encode($AR_RT);
			break;
			case "REFERESH_CHAIN":
				$Q_MEM = "SELECT member_id, sponsor_id, spil_id, spor_user_id, spil_user_id, left_right, date_join FROM tbl_members AS A 
				WHERE member_id NOT IN (SELECT member_id FROM tbl_mem_tree AS B) 
				ORDER BY A.member_id ASC LIMIT 500";
				$RS_MEM = $this->SqlModel->runQuery($Q_MEM);
				$AR_RT['ErrorMsg']="PENDING";
				if(count($RS_MEM)>0){
					foreach($RS_MEM as $AR_MEM):
					
						$sponsor_id = ($AR_MEM['sponsor_id']>0)? $AR_MEM['sponsor_id']:$model->getMemberId($AR_MEM['spor_user_id']);
						$spil_id = ($AR_MEM['spil_id']>0)? $AR_MEM['spil_id']:$model->getMemberId($AR_MEM['spil_user_id']);
						$member_id = $AR_MEM['member_id'];
						if($model->checkCount(prefix."tbl_mem_tree","member_id",$sponsor_id)>0){
							$model->UpdateMemberTree($sponsor_id, $spil_id, $member_id, $AR_MEM['left_right'], $AR_MEM['date_join']);
						}
						
					endforeach;
				}else{
					$AR_RT['ErrorMsg']="DONE";
				}
				echo json_encode($AR_RT);
			break;
			case "BIG_COINS":	
				$subcription_id = $this->input->get('subcription_id');
				$big_coins = $this->input->get('big_coins');
				if($big_coins!='' && $subcription_id!=''){
					$this->SqlModel->updateRecord(prefix."tbl_subscription",array("big_coins"=>$big_coins),array("subcription_id"=>$subcription_id));
					$AR_RT['ErrorMsg']="success";
				}else{
					$AR_RT['ErrorMsg']="failed";
				}
				echo json_encode($AR_RT);
			break;
		}
		
		
	}
	
	

	
	
}
