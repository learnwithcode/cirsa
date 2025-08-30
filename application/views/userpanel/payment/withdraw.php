<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$this->load->view('coinbase/vendor/autoload');		
	
	use Coinbase\Wallet\Client;
	use Coinbase\Wallet\Configuration;
	
	$trns_amount = $POST['trns_amount'];
	$processor_id = ($POST['processor_id']>0)? $POST['processor_id']:$this->OperationModel->getDefaultProcessor();
	$AR_PROC = $this->OperationModel->getProcessor($processor_id);
	
	
	$apiKey = ($AR_PROC['api_key'])? $AR_PROC['api_key']:'SAgONni29QpHlnWf';
	$apiSecret = ($AR_PROC['api_screat'])? $AR_PROC['api_screat']:'f71NbaXLrdJBrgkTxPJOgOKHYC2P6xGm';
	$configuration = Configuration::apiKey($apiKey, $apiSecret);
	$client = Client::create($configuration);	
	
	$member_id = $this->session->userdata('mem_id');
	$primaryAccount = $client->getPrimaryAccount();
	$old_balance = $primaryAccount->getBalance();
	
	use Coinbase\Wallet\Resource\Address;
	use Coinbase\Wallet\Enum\CurrencyCode;
	use Coinbase\Wallet\Resource\Transaction;
	use Coinbase\Wallet\Value\Money;
	
	$bitcoin_amount = $model->dollar_to_btc($trns_amount);
	
	$transaction = Transaction::send();
	$transaction->setToBitcoinAddress($POST['bitcoin_address']);
	$transaction->setAmount(new Money($bitcoin_amount, CurrencyCode::BTC));
	$transaction->setDescription('Bitclicko Withdrawal');
	$client->createAccountTransaction($primaryAccount, $transaction);
	
	$client->refreshAccount($primaryAccount);
	
	$new_balance = $primaryAccount->getBalance();
	$trns_date = InsertDate(getLocalTime());
	if($old_balance!=$new_balance && $member_id>0){
		$draw_amount = $POST['draw_amount'];
		$admin_charge = $POST['admin_charge'];
		$deposit_fee = $POST['deposit_fee'];
		$withdraw_fee = $POST['withdraw_fee'];
		$process_fee = $POST['process_fee'];
		$trans_no = $POST['trans_no'];
			$data = array("to_member_id"=>$member_id,
				"from_member_id"=>0,
				"initial_amount"=>$draw_amount,
				"admin_charge"=>$admin_charge,
				"deposit_fee"=>$deposit_fee,
				"withdraw_fee"=>$withdraw_fee,
				"process_fee"=>$process_fee,
				"trns_amount"=>$trns_amount,
				"trans_no"=>$trans_no,
				"trns_status"=>"C",
				"draw_type"=>"AUTO",
				"trns_type"=>"Dr",
				"trns_for"=>"Withdrawal",
				"trns_date"=>$trns_date,
				"trns_remark"=>"Member Withdrawal"
				
			);
			$withdraw_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
			$trns_date = getLocalTime();
			$this->OperationModel->wallet_transaction($wallet_id,"Dr",$member_id,$draw_amount,"Withdrawal Auto",$trns_date,$trans_no,"1");
				set_message("success","Your withdraw  transaction has been processed successfully");
			redirect_member("financial","withdraw",array("error"=>"success"));	
	}else{
		set_message("warning","Unable to process your request, please try again");
		redirect_member("financial","withdraw",array("error"=>"success"));	
	}
	#echo $primaryAccount->getName() . ": " . $balance->getAmount() . $balance->getCurrency() .  "\r\n";
	#PrintR($transaction);
	
?>
