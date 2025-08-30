<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    $mem_id =  $this->session->userdata('mem_id');
	   	if(!$mem_id){
			redirect(BASE_PATH);		
		}
	}

	
	
	public function processpayment(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$processor_id = FCrtRplc($form_data['processor_id']);
		$deposit_amount = FCrtRplc($form_data['deposit_amount']);

		$AR_SEND['processor_id']=$processor_id;

		if($processor_id=="1"){
			$bitcoin_price = ($form_data['deposit_amount']);
			$AR_SEND['deposit_amount']=$bitcoin_price;
			$data['POST'] = $AR_SEND;
			$this->load->view(MEMBER_FOLDER.'/payment/coinpayment',$data);
		}elseif($processor_id=="2"){
			$AR_SEND['deposit_amount']=$deposit_amount;
			$data['POST'] = $AR_SEND;
			$this->load->view(MEMBER_FOLDER.'/payment/perfectmoney',$data);		
		}else{
			echo "<div class='alert alert-block alert-danger' id=''><i class='ace-icon fa fa-times red'></i>&nbsp;Invalid amount</div>";
		}
	}
	
	public function perfectconfirm(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = getLocalTime();
		$payee_account = FCrtRplc($form_data['PAYEE_ACCOUNT']);
		$MEMID = _d($form_data['MEMID']);
		$order_no = FCrtRplc($form_data['PAYMENT_ID']);
		$deposit_amount = FCrtRplc($form_data['PAYMENT_AMOUNT']);
		$payment_batch_num = FCrtRplc($form_data['PAYMENT_BATCH_NUM']);
		$suggested_memo  = FCrtRplc($form_data['SUGGESTED_MEMO']);
		$v2_hash = FCrtRplc($form_data['V2_HASH']);
		$timestampgmt = FCrtRplc($form_data['TIMESTAMPGMT']);
		$payer_account = FCrtRplc($form_data['PAYER_ACCOUNT']);
		$currency = $form_data['PAYMENT_UNITS'];
		$member_id = $this->session->userdata('mem_id');
		$pmoney_sts = "C";
		if($MEMID=$member_id && $order_no==$this->session->userdata('order_no')){
			if($deposit_amount>0){
				$AR_PRC = $model->getProcessor("2");
				
				$deposit_fee_percent = $AR_PRC['deposit_fee'];
				$process_fee_percent = $AR_PRC['process_fee'];
				
				$deposit_fee = $deposit_amount*$deposit_fee_percent/100;
				$process_fee = $deposit_amount*$process_fee_percent/100;
				
				$total_charge =($deposit_fee+$process_fee);
				$trns_amount = $deposit_amount-$total_charge;
				$wallet_id = $model->getWallet(WALLET1);
				$trns_date = InsertDate($today_date);
				$trns_remark = "Deposit From [".$payer_account."]";
				if($trns_amount>0){
					$data = array("member_id"=>$member_id,
						"order_no"=>$order_no,
						"transaction"=>$payment_batch_num,
						"deposit_amount"=>$deposit_amount,
						"process_fee"=>($process_fee>0)? $process_fee:0,
						"fee_flat"=>0,
						"deposit_fee"=>($deposit_fee>0)? $deposit_fee:0,
						"trns_amount"=>$trns_amount,
						"pmoney_sts"=>$pmoney_sts,
						"sts_date_time"=>$today_date,
						"trns_type"=>"ONLINE",
						"suggested_memo"=>$suggested_memo,
						"v2_hash"=>$v2_hash,
						"timestampgmt"=>$timestampgmt,
						"payee_account"=>$payee_account,
						"payer_account"=>$payer_account,
						"currency"=>$currency
					);
					$fund_data = array("wallet_id"=>($wallet_id>0)? $wallet_id:0,
							"trans_no"=>$order_no,
							"from_member_id"=>0,
							"to_member_id"=>$member_id,
							"initial_amount"=>$deposit_amount,
							"deposit_fee"=>($deposit_fee>0)? $deposit_fee:0,
							"process_fee"=>($process_fee>0)? $process_fee:0,
							"trns_amount"=>$trns_amount,
							"trns_remark"=>$trns_remark,
							"trns_type"=>"Cr",
							"trns_for"=>'Deposit',
							"trns_status"=>"C",
							"draw_type"=>'ONLINE',
							"trns_date"=>InsertDate($trns_date),
							"status_up_date"=>InsertDate($trns_date)
					);
					
					
					$this->SqlModel->updateRecord(prefix."tbl_perfect_money",$data,array("order_no"=>$order_no));
					$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$fund_data);
					$model->wallet_transaction($wallet_id,"Cr",$member_id,$trns_amount,$trns_remark,$trns_date,$order_no,"1","DEPOSIT");
					$this->session->unset_userdata('order_no');
					set_message("success","You have successfully deposit an amount to your wallet");
					redirect_member("financial","depositwallet",array()); exit;
				}
			}else{
				set_message("warning","Unable to process your request , please try again");
				redirect_member("payment","perfectfailed",array()); exit;
			}
		}else{
			set_message("warning","Unable to process your request , please try again");
			redirect_member("payment","perfectfailed",array()); exit;
		}
	}
	
	
	public function perfectconfirmupgrade(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = InsertDate(getLocalTime());
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		
		$payee_account = FCrtRplc($form_data['PAYEE_ACCOUNT']);
		$MEMID = _d($form_data['MEMID']);
		$order_no = FCrtRplc($form_data['PAYMENT_ID']);
		$deposit_amount = FCrtRplc($form_data['PAYMENT_AMOUNT']);
		$payment_batch_num = FCrtRplc($form_data['PAYMENT_BATCH_NUM']);
		$suggested_memo  = FCrtRplc($form_data['SUGGESTED_MEMO']);
		$v2_hash = FCrtRplc($form_data['V2_HASH']);
		$timestampgmt = FCrtRplc($form_data['TIMESTAMPGMT']);
		$payer_account = FCrtRplc($form_data['PAYER_ACCOUNT']);
		$currency = $form_data['PAYMENT_UNITS'];
		
		$member_id = $this->session->userdata('mem_id');
		$pmoney_sts = "C";
		$AR_ORDER = $model->getPerfectMoney($order_no);
		$AR_PACK = $model->getPackage($AR_ORDER['type_id']);
		
		if($MEMID=$member_id && $order_no==$this->session->userdata('order_no')){
			if($deposit_amount>0){
				$AR_PRC  = $this->OperationModel->getProcessor("2");
				$AR_PEFECT = $this->OperationModel->getPerfectMoney($order_no);
				$trns_amount = $deposit_amount;
				$trns_date = InsertDate($today_date);
				
				$wallet_id = $model->getWallet(WALLET1);
				
				$invest_bonus = $AR_PACK['invest_bonus'];
				$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
				$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
				
				if($trns_amount==$AR_PEFECT['deposit_amount']){
					$data = array("member_id"=>$member_id,
						"order_no"=>$order_no,
						"transaction"=>$payment_batch_num,
						"deposit_amount"=>$deposit_amount,
						"process_fee"=>($process_fee>0)? $process_fee:0,
						"fee_flat"=>0,
						"deposit_fee"=>($deposit_fee>0)? $deposit_fee:0,
						"trns_amount"=>$trns_amount,
						"pmoney_sts"=>$pmoney_sts,
						"sts_date_time"=>$today_date,
						"trns_type"=>"ONLINE",
						"suggested_memo"=>$suggested_memo,
						"v2_hash"=>$v2_hash,
						"timestampgmt"=>$timestampgmt,
						"payee_account"=>$payee_account,
						"payer_account"=>$payer_account,
						"currency"=>$currency
					);
					$data_sub = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"type_id"=>$AR_PACK['type_id'],
						"package_price"=>$AR_PACK['pin_price'],
						"prod_pv"=>$AR_PACK['prod_pv'],
						"net_amount"=>$AR_PACK['pin_price'],
						"reinvest_amt"=>$reinvest_amt,
						"total_amt"=>$total_invest,
						"date_from"=>$today_date,
						"date_expire"=>$date_expire
					);
					
					
					$model->wallet_transaction($wallet_id,"Cr",$member_id,$AR_PACK['pin_price'],"Re-invest Amount",$today_date,$order_no,"1","REINVEST");
					
					$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
					$this->SqlModel->updateRecord(prefix."tbl_members",array("type_id"=>$AR_PACK['type_id']),array("member_id"=>$member_id));
					$this->SqlModel->updateRecord(prefix."tbl_perfect_money",$data,array("order_no"=>$order_no));
					$model->setReferralIncome($member_id,$subcription_id);
					
					$this->session->unset_userdata('order_no');
					set_message("success","You have successfully upgrade your account");
					redirect_member("account","upgradepackage",array()); exit;
				}else{
					set_message("warning","Unable to process your request , please try again");
					redirect_member("payment","perfectfailed",array()); exit;
				}
			}else{
				set_message("warning","Unable to process your request , please try again");
				redirect_member("payment","perfectfailed",array()); exit;
			}
		}else{
			set_message("warning","Unable to process your request , please try again");
			redirect_member("payment","perfectfailed",array()); exit;
		}
	}
	
	public function perfectfailed(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		
		$PAYEE_ACCOUNT = $form_data['PAYEE_ACCOUNT'];
		$member_id = _d($form_data['MEMID']);
		$order_no = $form_data['PAYMENT_ID'];
		$deposit_amount = $form_data['PAYMENT_AMOUNT'];
		$currency = $form_data['PAYMENT_UNITS'];
		$this->session->unset_userdata('order_no');
		$this->load->view(MEMBER_FOLDER.'/payment/perfectfailed',$data);		
	}
	
	public function withdrawprocess(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);
		$draw_amount = FCrtRplc($form_data['draw_amount']);
		$wallet_id = $model->getWallet(WALLET1);
		$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
		
		$CONFIG_MAX_WITHDRAWL = $model->getValue("CONFIG_MAX_WITHDRAWL");
		$CONFIG_WITHDRAWL = "MANUAL";
		$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_WITHDRAWL");
		
		$processor_id = FCrtRplc($form_data['processor_id']);
		$AR_PRC = $model->getProcessor($processor_id);
		$withdraw_fee_percent = $AR_PRC['withdraw_fee'];
		$deposit_fee_percent = $AR_PRC['deposit_fee'];
		$process_fee_percent = $AR_PRC['process_fee'];
		
		$trns_password = FCrtRplc($form_data['trns_password']);
		
		$processor_id = $AR_PRC['processor_id'];
		if($form_data['requestWithdraw']!='' && $this->input->post()!=''){
			
			if($member_id>0 && is_numeric($draw_amount)){
				
				if($model->checkTrnsPassword($member_id,$trns_password)>0){
				
					if($draw_amount>=$CONFIG_MIN_WITHDRAWL){
						
						$WITDRAW_FEE = ($draw_amount*$withdraw_fee_percent/100); 
						$PROCESS_FEE = ($draw_amount*$process_fee_percent/100);
						
						
						$CONFIG_ADMIN_CHARGE_PERCENT =  ($draw_amount*$CONFIG_ADMIN_CHARGE/100); 
						$admin_charge = ($CONFIG_ADMIN_CHARGE_PERCENT+$CONFIG_ADMIN_CHARGE_AMOUNT);
						$total_charge = ($admin_charge+$WITDRAW_FEE+$PROCESS_FEE);
						
						$trns_amount = ($draw_amount-$total_charge);
						$trns_date = InsertDate(getLocalTime());
						$trans_no = UniqueId("TRNS_NO");
						$wallet_id = $model->getWallet(WALLET1);
						if($trns_amount>0){
						
							if($draw_amount<=$LDGR['net_balance']){
								if($CONFIG_WITHDRAWL=="MANUAL"){
									$data = array("to_member_id"=>$member_id,
										"from_member_id"=>$model->getFirstId(),
										"trans_no"=>$trans_no,
										"wallet_id"=>$wallet_id,
										"initial_amount"=>$draw_amount,
										"admin_charge"=>$admin_charge,
										"withdraw_fee"=>($WITDRAW_FEE)? $WITDRAW_FEE:0,
										"deposit_fee"=>($DEPOSITE_FEE)? $DEPOSITE_FEE:0,
										"process_fee"=>($PROCESS_FEE)? $PROCESS_FEE:0,
										"trns_amount"=>$trns_amount,
										"trns_status"=>"P",
										"trns_type"=>"Dr",
										"trns_date"=>$trns_date,
										"trns_for"=>"Withdrawal",
										"draw_type"=>"MANUAL",
										"processor_id"=>$processor_id,
										"trns_remark"=>"Withdrawal  Request from".$AR_MEM['user_id'],
									);
									$withdraw_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
									$model->wallet_transaction($wallet_id,"Dr",$member_id,$trns_amount,"Withdrawal request",$trns_date,$trans_no,"1");
									set_message("success","You have successfully request for withdrawal $StrMsg");
									redirect_member("financial","withdraw",array("error"=>"success"));
								}else{
									set_message("warning","Unable to process your request , please try again");
									redirect_member("financial","withdraw","");	
								}	
							}else{
								set_message("warning","Invalid amount, please check balance");
								redirect_member("financial","withdraw","");	
							}
						}else{
							set_message("warning","Invalid amount");
							redirect_member("financial","withdraw","");	
						}
					}else{
						set_message("warning","Minimum withdrawal is ".$CONFIG_MIN_WITHDRAWL."");
						redirect_member("financial","withdraw","");	
					}
			   }else{
			   		set_message("warning","Invalid transaction password");
					redirect_member("financial","withdraw","");	
			   }
			}else{
				set_message("warning","Invalid amount");
				redirect_member("financial","withdraw","");	
			}
		}
	}
	
	public function perfectconfirmdonate(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = InsertDate(getLocalTime());
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		
		$wallet_id = $model->getWallet(WALLET1);
		$first_id = $model->getFirstId();
		
		$PAYEE_ACCOUNT = $form_data['PAYEE_ACCOUNT'];
		$MEMID = _d($form_data['MEMID']);
		$TYPEID = _d($form_data['TYPEID']);
		$order_no = $form_data['PAYMENT_ID'];
		$deposit_amount = $form_data['PAYMENT_AMOUNT'];
		$currency = $form_data['PAYMENT_UNITS'];
		
		$member_id = $this->session->userdata('mem_id');
		$AR_PACK = $model->getPackage($TYPEID);
		if($MEMID=$member_id && $order_no==$this->session->userdata('order_no')){
			if($deposit_amount>0){
				$AR_PRC  = $this->OperationModel->getProcessor("2");
				$AR_PEFECT = $this->OperationModel->getPerfectMoney($order_no);
				$trns_amount = $deposit_amount;
				$trns_date = InsertDate($today_date);
				if($trns_amount==$AR_PEFECT['deposit_amount']){
					$data = array("trns_amount"=>$trns_amount,
						"pmoney_sts"=>"C",
						"sts_date_time"=>$today_date
					);
					$data_sub = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"trns_amount"=>$trns_amount,
					);
					$this->SqlModel->insertRecord(prefix."tbl_donation",$data_sub);
					$this->SqlModel->updateRecord(prefix."tbl_perfect_money",$data,array("order_no"=>$order_no));
					$model->wallet_transaction($wallet_id,"Cr",$first_id,$trns_amount_usd,'Member Donation',$today_date,$order_no,"1","DONATE");
					$this->session->unset_userdata('order_no');
					set_message("success","You have successfully donated  an amount");
					redirect(MEMBER_PATH);
				}else{
					set_message("warning","Unable to process your request , please try again");
					redirect_member("payment","perfectfailed",array()); exit;
				}
			}else{
				set_message("warning","Unable to process your request , please try again");
				redirect_member("payment","perfectfailed",array()); exit;
			}
		}else{
			set_message("warning","Unable to process your request , please try again");
			redirect_member("payment","perfectfailed",array()); exit;
		}
	}
	
	
	
	public function bankwiredownload(){
		$output .= '<div class="row inv-wrap" id="print_area">
                  <div class="col-md-12 block">
                    <h4> <strong> Account Details: </strong> </h4>
                    <ul class="inv-lst">
                      <li> Account <span class="hg-txt"> ANX FOREAX </span> </li>
                      <li> Address: One World Trade Center
                        Suite 8500 , New York, NY 10007
                        United States. </li>
                      <li> SWIFT CODE: <span class="hg-txt"> ABCNCTSSA </span> </li>
                      <li> RTGS/NEFT IFSC CODE: <span class="hg-txt"> ABC0000154 </span> </li>
                      <li> NAME OF BANK: <span class="hg-txt"> ABC BANK </span> </li>
                      <li> BANK ADDRESS: 9C Pulaski St.Des Moines, IA 50310. </li>
                      <li> ACCOUNT NUMBER: <span class="hg-txt"> 015405500642 </span> </li>
                      <li> BRANCH NUMBER/CODE: 0514 Moines Branch </li>
                      <li> Comments or Special Instructions: </li>
                      <li> PAYMENT DESCRIPTION: Invoice No.: 1043 </li>
                    </ul>
                  </div>
                  <div class="col-md-12 text-center">
                    <h4> <strong> THANK YOU FOR YOUR BUSINESS!!! </strong> </h4>
                    <ul class="text-center comp-info">
                      <li> One World Trade Center
                        Suite 8500 , New York, NY 10007
                        United States </li>
                      <li> <i class="fa fa-envelope"></i> : support@anxebusiness.com, <i class="fa fa-phone"></i> : 1-646-583-1495 </li>
                    </ul>
                  </div>
                </div>';
		$FileName="BANK_WIRE_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".docx";
		header('Content-type: application/msword');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	
	public function upgrademembership(){
		$model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$type_id = _d($form_data['type_id']);
		$fldvType = FCrtRplc($form_data['fldvType']);
		$AR_MEM = $model->getMember($member_id);
		$AR_PACK = $model->getPackage($type_id);
		
		$AR_TYPE = $model->getCurrentMemberShip($member_id);
		$pin_activation = $model->getValue("CONFIG_PIN_ACTIVATION");
		$pin_price = FCrtRplc($form_data['pin_price']);
		if( $pin_price>=$AR_PACK['pin_price'] && $pin_price<=$AR_PACK['pin_price_limit']){

			$AR_SEND['type_id']=$type_id;
			switch($fldvType){
				case "BITCOIN":
					
					$bitcoin_price = $pin_price;
					$AR_SEND['deposit_amount']=$bitcoin_price;
					$AR_SEND['type_id']=$type_id;
					$data['POST']=$AR_SEND;
					$this->load->view(MEMBER_FOLDER.'/payment/coinpaymentupgrademembership',$data);
				break;
				case "PERFECT":
					$AR_SEND['deposit_amount']=$pin_price;
					$data['POST']=$AR_SEND;
					$this->load->view(MEMBER_FOLDER.'/payment/perfectmoneyupgrademembership',$data);
				break;
				case "BANKWIRE":
					$this->load->view(MEMBER_FOLDER.'/payment/bankwire',$data);
				break;
				case "EWALLET":
					$wallet_id = $model->getGroupWallet(array("Trading Wallet","Cash Account"));
					$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
	
					$order_no = UniqueId("ORDER_NO");
					if($form_data['upgradeMemberShip']==1 && $this->input->post()!=''){
						if($type_id>0){
						
							$invest_bonus = $AR_PACK['invest_bonus'];
							$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
							$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
						
							if($LDGR['net_balance']>=$AR_PACK['pin_price'] && $LDGR['net_balance']>0){
								$data_sub = array("order_no"=>$order_no,
									"member_id"=>$member_id,
									"type_id"=>$AR_PACK['type_id'],
									"package_price"=>$AR_PACK['pin_price'],
									"net_amount"=>$AR_PACK['pin_price'],
									"reinvest_amt"=>$reinvest_amt,
									"total_amt"=>$total_invest,
									"prod_pv"=>$AR_PACK['prod_pv'],
									"date_from"=>$today_date,
									"date_expire"=>$date_expire
								);
								
								
								$model->wallet_transaction($model->getWallet(WALLET1),"Cr",$member_id,$AR_PACK['pin_price'],"Re-invest Amount",$today_date,$order_no,1,"REINVEST");
								
								$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
								$this->SqlModel->updateRecord(prefix."tbl_members",array("type_id"=>$type_id),array("member_id"=>$member_id));
								$model->wallet_transaction($model->getWallet(WALLET1),"Dr",$member_id,$pin_price,'Package Upgrade',$today_date,$order_no,"1");
								$model->setReferralIncome($member_id,$subcription_id);
								set_message("success","You have successfully upgraded your package");
								redirect_member("account","upgradepackage",'');
							}else{
								set_message("warning","You don't have enough credit to upgrade this package");
								redirect_member("account","paymentpackage",array("type_id"=>_e($type_id)));
							}
						}else{
							set_message("warning","Invalid , package selection");
							redirect_member("account","paymentpackage",array("type_id"=>_e($type_id)));
						}
					}
				break;
			}
		}else{
			set_message("warning","Invalid amount, Amount should be in between ".$AR_PACK['pin_price']." and ".$AR_PACK['pin_price_limit']." USD");
			redirect_member("account","paymentpackage",array("type_id"=>_e($type_id)));
		}
	}
	
	public function donation(){
		$model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$fldvType = FCrtRplc($form_data['fldvType']);
		$trns_password = FCrtRplc($form_data['trns_password']);
		$trns_amount = FCrtRplc($form_data['trns_amount']);
		$trns_remark = FCrtRplc($form_data['trns_remark']);
		$AR_MEM = $model->getMember($member_id);
		$first_id = $model->getFirstId();
		
		$AR_SEND['trns_remark']=$form_data['trns_remark'];
		if($model->checkTrnsPassword($member_id,$trns_password)>0){
			switch($fldvType){
				case "BITCOIN":
					$bitcoin_price = $model->dollar_to_btc($trns_amount);
					$AR_SEND['deposit_amount']=$bitcoin_price;
					$data['POST']=$AR_SEND;
					$this->load->view(MEMBER_FOLDER.'/payment/bitcoindonate',$data);
				break;
				case "PERFECT":
					$AR_SEND['deposit_amount']=$trns_amount;
					$data['POST']=$AR_SEND;
					$this->load->view(MEMBER_FOLDER.'/payment/perfectmoneydonate',$data);
				break;
				case "BANKWIRE":
					$this->load->view(MEMBER_FOLDER.'/payment/bankwire',$data);
				break;
				case "EWALLET":
					$wallet_id = $model->getWallet(WALLET1);
					$LDGR = $model->getCurrentBalance($member_id,$wallet_id,"","");
	
					$order_no = UniqueId("ORDER_NO");
					if($form_data['sendDonate']=="Send" && $this->input->post()!=''){
						if($wallet_id>0){
							if($LDGR['net_balance']>=$trns_amount && $LDGR['net_balance']>0){
								$data_sub = array("order_no"=>$order_no,
									"member_id"=>$member_id,
									"trns_amount"=>$trns_amount,
									"trns_remark"=>$trns_remark
								);
								$this->SqlModel->insertRecord(prefix."tbl_donation",$data_sub);
								$model->wallet_transaction($wallet_id,"Dr",$member_id,$trns_amount,'Donation',$today_date,$order_no,"1","NA");
								$model->wallet_transaction($wallet_id,"Cr",$first_id,$trns_amount,'Member Donated',$today_date,$order_no,"1","DONATE");
								set_message("success","You have successfully donated to our foundation");
								redirect(MEMBER_PATH);
							}else{
								set_message("warning","You don't have enough credit to upgrade this package");
								redirect(MEMBER_PATH);
							}
						}else{
							set_message("warning","Invalid , package selection");
							redirect(MEMBER_PATH);
						}
					}
				break;
			}
		}else{
			set_message("warning","Invalid , transaction password");
			 redirect(MEMBER_PATH);
		}
	}
	
	public function upgrademembershipepin(){
		$model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$AR_TYPE = $model->getCurrentMemberShip($member_id);
		$pin_activation = ($AR_TYPE['type_id']>0)? 0:30;
		
		if($form_data['upgradeMemberShip']==1 && $this->input->post()!=''){
			$type_id = _d($form_data['type_id']);
			$AR_PACK = $model->getPackage($type_id);
			if($type_id>0){
				$no_pin = FCrtRplc($form_data['no_pin']);
				$pin_key = FCrtRplc($form_data['pin_key']);
				if($no_pin!='' && $pin_key!=''){
					$AR_PIN = $model->getPinDetail($no_pin,$pin_key);
					if($model->checkPinActivation($AR_PIN['mstr_id'],$AR_TYPE['type_id'])==0){
						if($AR_PIN['type_id']==$type_id){
							if($AR_PIN['block_sts']=="N"){
								if($AR_PIN['pin_sts']=="N" && $AR_PIN['use_member_id']==0){
									$order_no = UniqueId("ORDER_NO");
									
									$invest_bonus = $AR_PACK['invest_bonus'];
									$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
									$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
									
									$data_sub = array("order_no"=>$order_no,
										"member_id"=>$member_id,
										"type_id"=>$type_id,
										"package_price"=>$AR_PACK['pin_price'],
										"prod_pv"=>$AR_PACK['prod_pv'],
										"net_amount"=>$AR_PACK['pin_price'],
										"reinvest_amt"=>$reinvest_amt,
										"total_amt"=>$total_invest,
										"date_from"=>$today_date,
										"date_expire"=>$date_expire
									);
									
									$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
									$model->wallet_transaction($model->getWallet(WALLET1),"Cr",$member_id,$AR_PIN['pin_price'],"Re-invest 
									Amount",$today_date,$order_no,"1","REINVEST");
									$this->SqlModel->updateRecord(prefix."tbl_members",array("type_id"=>$type_id),array("member_id"=>$member_id));
									$model->updatePinDetail($AR_PIN['pin_id'],$member_id);
									$model->setReferralIncome($member_id,$subcription_id);
									set_message("success","You have successfully upgraded your package");
									redirect_member("account","upgradepackage",'');
								}else{
									set_message("warning","This pin is already used by other member");
									redirect_member("account","paymentpackage",array("type_id"=>_e($type_id)));
								}
							}else{
								set_message("warning","Sorry this pin is blocked, please contact our support team");
								redirect_member("account","paymentpackage",array("type_id"=>_e($type_id)));
							}
						}else{
							set_message("warning","Invalid , pin details");
							redirect_member("account","paymentpackage",array("type_id"=>_e($type_id)));
						}
					}else{
						set_message("warning","Invalid  pin no, use  activation pin");
						redirect_member("account","paymentpackage",array("type_id"=>_e($type_id)));
					}
				}else{
					set_message("warning","Please enter pin-no & pin-key details");
					redirect_member("account","paymentpackage",array("type_id"=>_e($type_id)));
				}
			}else{
				set_message("warning","Invalid package selection , please try again");
				redirect_member("account","upgradepackage","");
			}
		}
	}
	
	
	
	public function coinpaymentconfirm(){
		$model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		$form_data = $this->input->post();	
		$this->session->unset_userdata('order_no');
		set_message("success","You have successfully deposit an amount, we will verify it  and  credit  within 4 to 5 hours");
		redirect_member("financial","depositwallet",array()); exit;
	}
	
	public function coinpaymentupgrade(){
		$model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		$form_data = $this->input->post();	
		$this->session->unset_userdata('order_no');
		set_message("success","You have successfully deposit an amount, we will verify it  and  upgrade your subscription  within 4 to 5 hours");
		redirect_member("financial","subscription",array()); exit;
	}
	
	
	public function coinpaymentfailed(){
		$model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		$form_data = $this->input->post();	
		$this->session->unset_userdata('order_no');
		$this->load->view(MEMBER_FOLDER.'/payment/coinpaymentfailed',$data);
	}
	
}
