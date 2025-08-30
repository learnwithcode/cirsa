<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	   
	}
	
	public function jsonhandler(){	
		$model = new OperationModel();
		$switch_type  = ($this->input->get('switch_type')!='')? $this->input->get('switch_type'):$this->input->post('switch_type');
		switch($switch_type){
			case "CHECKUSR":
				$spr_user_id = FCrtRplc($this->input->get('spr_user_id'));
				$QR_GET = "SELECT tm.member_id, tm.user_id, CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name
				FROM ".prefix."tbl_members AS tm	
				WHERE ( tm.user_id='".$spr_user_id."' OR tm.user_name='".$spr_user_id."' )";
				$AR_GET = $this->SqlModel->runQuery($QR_GET,true);
				echo json_encode($AR_GET);
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
				$type_id = FCrtRplc($this->input->get('type_id'));
				$QR_GET = "SELECT * FROM ".prefix."tbl_pintype WHERE type_id='".$type_id."'";
				$AR_SET = $this->SqlModel->runQuery($QR_GET,true);
				echo json_encode($AR_SET);
			break;
			case "BITCOIN_PAYMENT_WALLET":
				$coinbase_id = _d($_REQUEST['coinbase_id']);
				$wallet_id = $model->getWallet(WALLET1);
				$trns_type = ($_REQUEST['trns_type']);
				if($coinbase_id>0){
					$SQl_GET = "SELECT * FROM ".prefix."tbl_coinbase  WHERE coinbase_id='".$coinbase_id."'";
					$AR_GET = $this->SqlModel->runQuery($SQl_GET,true);
					$request_amount = btc_encode($AR_GET['deposit_amount']);
					
					
					$SQL_PRC = "SELECT * FROM ".prefix."tbl_payment_processor  WHERE processor_id='".$AR_GET['processor_id']."'";
					$AR_PRC = $this->SqlModel->runQuery($SQL_PRC,true);

					$url_get = "http://btc.blockr.io/api/v1/address/info/".$AR_GET['coinbase_address']."";
					$response = get_web_page($url_get);
					
					$trans_ref_no = $AR_GET['trsn_no'];
					$trns_date = getLocalTime();
					$AR_RES = json_decode($response,true);	
					
					$totalreceived = $AR_RES['data']['totalreceived'];
					$balance = $AR_RES['data']['balance'];
					$confirmation = $AR_RES['data']['first_tx']['confirmations'];
					
					$deposit_amount = btc_encode($totalreceived);
					$AR_RT['error_msg'] = "failed";
					if($AR_GET['coinbase_sts']=="P"){
						if($totalreceived>0 && $confirmation>0){
						
							if($deposit_amount>=$request_amount){
								$trans_no = UniqueId("TRNS_NO");

								$deposit_fee_percent = $AR_PRC['deposit_fee'];
								$fee_flat = btc_encode($AR_PRC['fee_flat']);
								$process_fee_percent = $AR_PRC['process_fee'];
								
								$deposit_fee = $request_amount*$deposit_fee_percent/100;
								$total_charge = $deposit_fee;
								
								$refund_amt_encode = (btc_encode($AR_RES['data']['totalreceived']) - btc_encode($AR_GET['deposit_amount']));
								$refund_amt = $model->btc_to_dollar(btc_decode($refund_amt_encode));
								
								$net_amount = $request_amount-$total_charge;
								$trns_amount = ($request_amount+$refund_amt_encode)-$total_charge;
								
								
								$initial_amount = $model->btc_to_dollar(btc_decode($trns_amount));
								$deposit_fee = $model->btc_to_dollar(btc_decode($deposit_fee));
								
								$data = array("coinbase_sts"=>"C",
									"sts_date_time"=>getLocalTime(),
									"fee_flat"=>btc_decode($fee_flat),
									"refund_amt"=>btc_decode($refund_amt_encode),
									"process_fee"=>btc_decode($PROCESS_FEE),
									"deposit_fee"=>btc_decode($deposit_fee),
									"trns_amount"=>btc_decode($trns_amount)
								);
								
								$initial_amount = $model->btc_to_dollar($AR_GET['deposit_amount']);
								$deposit_fee = $model->btc_to_dollar(btc_decode($deposit_fee));
								$fund_amount = $model->btc_to_dollar(btc_decode($trns_amount));

								$fund_data = array("wallet_id"=>($wallet_id>0)? $wallet_id:0,
									"trans_no"=>$trans_no,
									"from_member_id"=>0,
									"to_member_id"=>$AR_GET['member_id'],
									"initial_amount"=>$initial_amount,
									"deposit_fee"=>$deposit_fee,
									"refund_amt"=>$refund_amt,
									"trns_amount"=>$fund_amount,
									"trns_remark"=>"Member Deposit",
									"trns_type"=>"Cr",
									"trns_for"=>'Deposit',
									"trns_status"=>"C",
									"draw_type"=>'NA',
									"trns_date"=>InsertDate($trns_date)
								);
								if($trns_amount>0){
									$wallet_amount = $model->btc_to_dollar(btc_decode($net_amount));
									$this->SqlModel->updateRecord(prefix."tbl_coinbase",$data,array("coinbase_id"=>$coinbase_id));
									$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$fund_data);
									
									$this->OperationModel->wallet_transaction($wallet_id,"Cr",$AR_GET['member_id'],$wallet_amount,"Deposit",
									$trns_date,$trans_ref_no,"1");
									
									if($AR_RES['data']['totalreceived']>$AR_GET['deposit_amount']){	
										$this->OperationModel->wallet_transaction($wallet_id,"Cr",$AR_GET['member_id'],
										$refund_amt,"Additional Amount Credited Deposit",$trns_date,$trans_ref_no,"1","");
									}
									
									$this->session->unset_userdata('order_no');
									$AR_RT['error_msg'] = "success";
								}
							}else{
								$balance_amount = btc_val(btc_decode($request_amount-$deposit_amount),8);
								$AR_RT['error_msg'] = "partly";
								$AR_RT['error_dtl'] = "You have made a partly payment, please make payment of ".$balance_amount." 
								<br />to complete your deposite";
								$AR_RT['link_check'] = "https://blockchain.info/address/".$AR_GET['coinbase_address']."";
							}
						}elseif($balance>0){
							$AR_RT['error_msg'] = "pending";
							$AR_RT['link_check'] = "https://blockchain.info/address/".$AR_GET['coinbase_address']."";
						}
					}elseif($AR_GET['coinbase_sts']=="C"){
						$AR_RT['error_msg'] = "success";
						$AR_RT['error_dtl'] = "You have already  made a payment";
					}else{
						$AR_RT['error_msg'] = "failed";
						$AR_RT['error_dtl'] = "This transaction is declined";
					}
					echo json_encode($AR_RT);
				}
			break;
			case "BITCOIN_PAYMENT_UPGRADE":	
				$today_date = InsertDate(getLocalTime());
				$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
				$wallet_id = $model->getWallet(WALLET1);		
				$coinbase_id = _d($_REQUEST['coinbase_id']);
				$trns_type = ($_REQUEST['trns_type']);
				$type_id = ($_REQUEST['type_id']);
				if($coinbase_id>0){
					$SQl_GET = "SELECT * FROM ".prefix."tbl_coinbase  WHERE coinbase_id='".$coinbase_id."'";
					$AR_GET = $this->SqlModel->runQuery($SQl_GET,true);
					$member_id = $AR_GET['member_id'];
					$request_amount = btc_encode($AR_GET['deposit_amount']);
					
					
					
					$AR_PACK = $model->getPackage($type_id);
					
					$url_get = "http://btc.blockr.io/api/v1/address/info/".$AR_GET['coinbase_address']."";
					$response = get_web_page($url_get);
					$trans_ref_no = $AR_GET['trsn_no'];
					$trns_date = getLocalTime();
					$AR_RES = json_decode($response,true);
					
					$totalreceived = $AR_RES['data']['totalreceived'];
					$balance = $AR_RES['data']['balance'];
					$confirmation = $AR_RES['data']['first_tx']['confirmations'];
					
					
					$AR_RT['error_msg'] = "failed";
					if($AR_GET['coinbase_sts']=="P"){
						if($totalreceived>0  && $confirmation>0){
							$order_no = UniqueId("ORDER_NO");
							$deposit_amount = btc_encode($totalreceived);
							
							if($deposit_amount>=$request_amount && $deposit_amount>0){
								
								$refund_amt_encode = (btc_encode($AR_RES['data']['totalreceived']) - btc_encode($AR_GET['deposit_amount']));
								$refund_amt = $model->btc_to_dollar(btc_decode($refund_amt_encode));
								
								$trns_amount = $request_amount+$refund_amt_encode;
								
								$data = array("coinbase_sts"=>"C",
									"sts_date_time"=>getLocalTime(),
									"refund_amt"=>btc_decode($refund_amt_encode),
									"trns_amount"=>btc_decode($trns_amount)
								);
		
								$data_sub = array("order_no"=>$order_no,
									"member_id"=>$member_id,
									"type_id"=>$AR_PACK['type_id'],
									"package_price"=>$AR_PACK['pin_price'],
									"prod_pv"=>$AR_PACK['prod_pv'],
									"date_from"=>$today_date,
									"date_expire"=>$date_expire
								);
							
								$invest_bonus = $AR_PACK['invest_bonus'];
								$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
								$total_invest = $AR_PACK['pin_price']+$invest_bonus;
								
								
								$this->SqlModel->updateRecord(prefix."tbl_coinbase",$data,array("coinbase_id"=>$coinbase_id));				
	
								$this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
								$model->wallet_transaction($wallet_id,"Cr",$member_id,$total_invest,"Re-invest Amount",$today_date,$order_no,"1","");
								$this->SqlModel->updateRecord(prefix."tbl_members",array("type_id"=>$type_id),array("member_id"=>$member_id));
								
								if($AR_RES['data']['totalreceived']>$AR_GET['deposit_amount']){	
									$model->wallet_transaction($wallet_id,"Cr",$member_id,$refund_amt,"Additional 
									 Amount Credited Upgrade",$today_date,$order_no,"1","");
								}
								$AR_RT['error_msg'] = "success";
								$AR_RT['error_dtl'] = "You have successfully made and payment";
							}else{
								$balance_amount = btc_val(btc_decode($request_amount-$deposit_amount),8);
								$AR_RT['error_msg'] = "partly";
								$AR_RT['error_dtl'] = "You have made a partly payment, please make payment of ".$balance_amount." 
								<br />to complete your deposite";
								$AR_RT['link_check'] = "https://blockchain.info/address/".$AR_GET['coinbase_address']."";
							}
						}elseif($balance>0){
							$AR_RT['error_msg'] = "pending";
							$AR_RT['error_dtl'] = "You payment is waiting for confirmation";
							$AR_RT['link_check'] = "https://blockchain.info/address/".$AR_GET['coinbase_address']."";
						}
					}elseif($AR_GET['coinbase_sts']=="C"){
						$AR_RT['error_msg'] = "success";
						$AR_RT['error_dtl'] = "You have already  made a payment";
					}else{
						$AR_RT['error_msg'] = "failed";
						$AR_RT['error_dtl'] = "This transaction is declined";
					}
					echo json_encode($AR_RT);
				}
			break;
			case "BITCOIN_PAYMENT_DONATE":
				$today_date = InsertDate(getLocalTime());
				$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
				
				$wallet_id = $model->getWallet(WALLET1);
				$first_id = $model->getFirstId();
				
				$coinbase_id = _d($_REQUEST['coinbase_id']);
				$trns_type = ($_REQUEST['trns_type']);
				$trns_remark = ($_REQUEST['trns_remark']);
				if($coinbase_id>0){
					$SQl_GET = "SELECT * FROM ".prefix."tbl_coinbase  WHERE coinbase_id='".$coinbase_id."' AND coinbase_sts='P' 
					AND trns_type='".$trns_type."'";
					$AR_GET = $this->SqlModel->runQuery($SQl_GET,true);
					$member_id = $AR_GET['member_id'];
					
					$AR_PACK = $model->getPackage($type_id);
					
					$url_get = "http://btc.blockr.io/api/v1/address/info/".$AR_GET['coinbase_address']."";
					$response = get_web_page($url_get);
					$trans_ref_no = $AR_GET['trsn_no'];
					$trns_date = getLocalTime();
					$AR_RES = json_decode($response,true);
					
					
					$totalreceived = $AR_RES['data']['totalreceived'];
					$balance = $AR_RES['data']['balance'];
					
					
					$AR_RT['error_msg'] = "failed";
					if($totalreceived>0 ){
						$order_no = UniqueId("ORDER_NO");
						$deposit_amount = btc_decode($totalreceived);
						$match_number = match_number($totalreceived,$AR_GET['deposit_amount'],3);
						
						$trns_amount_usd = $model->btc_to_dollar($deposit_amount);
						if($match_number>0){
							$data = array("coinbase_sts"=>"C",
								"sts_date_time"=>getLocalTime(),
								"deposit_amount"=>$deposit_amount,
								"trns_amount"=>$deposit_amount
							);
							if($deposit_amount>0){
								$this->SqlModel->updateRecord(prefix."tbl_coinbase",$data,array("coinbase_id"=>$coinbase_id));
								$data_sub = array("order_no"=>$order_no,
									"member_id"=>$member_id,
									"trns_amount"=>$trns_amount_usd,
									"trns_remark"=>$trns_remark
								);
								$this->SqlModel->insertRecord(prefix."tbl_donation",$data_sub);
								$model->wallet_transaction($wallet_id,"Cr",$first_id,$trns_amount_usd,'Member Donated',$today_date,$order_no,"1","DONATE");
								$AR_RT['error_msg'] = "success";
							}
						}else{
							$AR_RT['error_msg'] = "invalidamount";
							$AR_RT['link_check'] = "https://blockchain.info/address/".$AR_GET['coinbase_address']."";
						}
					}elseif($balance>0){
						$AR_RT['error_msg'] = "pending";
						$AR_RT['link_check'] = "https://blockchain.info/address/".$AR_GET['coinbase_address']."";
					}
					echo json_encode($AR_RT);
				}
			break;
			case "EWALLET_BALANCE":
				$member_id = $this->session->userdata('mem_id');
				$wallet_id = $model->getGroupWallet(array("Trading Wallet","Cash Account"));
				$AR_LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
				echo json_encode($AR_LDGR);
			break;
			case "RESET_TRNS":
				$AR_RT['count_ctrl']=0;
				$member_id = $this->session->userdata('mem_id');
				if($member_id>0){
					Send_Mail(array("member_id"=>$member_id),"RESET_TRNS");
					$AR_RT['count_ctrl']=1;
				}
				echo json_encode($AR_RT);
			break;
			case "SEND_SMS_CODE":
				$mobile_code  = FCrtRplc($this->input->get('mobile_code'));
				$member_mobile  = FCrtRplc($this->input->get('member_mobile'));
				$member_id = $this->session->userdata('mem_id');
				if($member_id>0){
					$sms_number = $mobile_code.$member_mobile;
					$this->SqlModel->updateRecord(prefix."tbl_members",
						array("mobile_code"=>$mobile_code,"member_mobile"=>$member_mobile),
						array("member_id"=>$member_id)
					);
					
					$sms_otp = $model->sendMobileVerifySMS($sms_number);
					$data = array("member_id"=>$member_id,
						"new_value"=>"0",
						"sms_otp"=>$sms_otp,
						"sms_type"=>"MOBILE",
						"mobile_number"=>$sms_number
					);
					$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
					$AR_RT['ErrorMsg']="SUCCESS";
					
				}else{
					$AR_RT['ErrorMsg']="FAILED";
				}
				echo json_encode($AR_RT);
			break;
			case "LOAD_PIN":
				$pin_activation  = FCrtRplc($this->input->get('pin_activation'));
				if($pin_activation>0){
					$QR_SELECT = "SELECT tp.* FROM tbl_pintype AS tp WHERE tp.type_id>0";
				}else{
					$QR_SELECT = "SELECT tp.* FROM tbl_pintype AS tp WHERE tp.type_id>1";
				}
				$RS_SELECT = $this->SqlModel->runQuery($QR_SELECT);
				echo '<option value=""'; if($SlctVal == ""){echo 'selected';} echo '>Select Pin</option>';
				foreach($RS_SELECT as $AR_SELECT):
					echo "<option value='".$AR_SELECT['type_id']."'";if($SlctVal == $AR_SELECT['type_id']){echo "selected";}
					echo ">".$AR_SELECT['pin_name']."</option>";
				endforeach;
			break;
			case "MEMBER_LIST":
				$type_id  = $this->input->post('type_id');
				$QR_PAGES="SELECT tm.*, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
				tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join 
				FROM ".prefix."tbl_members AS tm	
				LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
				LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
				WHERE tm.delete_sts>0   AND tm.type_id='".$type_id."'
				$StrWhr
				ORDER BY tm.member_id ASC";
				$RS_PAGES = $this->SqlModel->runQuery($QR_PAGES);
			
				echo '<table style="border-collapse:collapse;" width="100%" border="1" cellpadding="4" cellspacing="0">
                  <tbody>			  
				  <tr class="lightbg">
                    <td class="cmntext" scope="col" align="center" width="8%"><strong>SLN</strong></td>
                    <td class="cmntext" scope="col" align="center" width="26%"><strong>Member     Id </strong></td>
                    <td class="cmntext" scope="col" align="center" width="43%"><strong> Name</strong></td>
                    <td class="cmntext" scope="col" align="center" width="23%"><strong>D.O.J</strong></td>
                  </tr>';
				  $i=1;
				  if(count($RS_PAGES)>0){
					  foreach($RS_PAGES as $AR_DT):
						echo '<tr>
							 <td class="cmntext" scope="col" align="center">'.$i.'</td>
							 <td class="" scope="col" align="center">'. $AR_DT['user_id'].'</td>
							 <td scope="col" class="cmntext" align="center">'. $AR_DT['first_name']." ".$AR_DT['last_name'].'</td>
							 <td scope="col" class="cmntext" align="center">'.DisplayDate($AR_DT['date_join']).'</td>
							</tr>';
					 $i++; endforeach;
				 }else{
				 	echo '<tr>
							 <td class="cmntext" colspan="4">No member found for this plan</td>
						</tr>';
				 }
				  	echo '</tbody></table>';
			break;
			case "BANK_TRANS":
				$transfer_id = _d($this->input->get('transfer_id'));
				if($transfer_id>0){
					$QR_GET = "SELECT tbt.bank_tid, tbt.transfer_id, tbt.bank_trans_no, 
					tbt.bank_trans_detail, DATE(tbt.date_time) AS date_time, tbt.bank_name, tbt.bank_account_no
					 FROM ".prefix."tbl_bank_transaction AS tbt WHERE tbt.transfer_id='".$transfer_id."'";
					$AR_GET = $this->SqlModel->runQuery($QR_GET,true);
					echo json_encode($AR_GET);
				}
			break;
		}
		
		
	}
	
	

	
	
}
