<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cryptogateway extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   $this->load->library('CoinpaymentsAPI'); 
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
		
         
	 
	}
	
	
	function index()
	{
	     $this->load->view(MEMBER_FOLDER.'/crypto/index',$data);   
	}
		function status()
	{
	     $this->load->view(MEMBER_FOLDER.'/crypto/status',$data);   
	}
	function addFunds()
	{
  
 
	$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(1);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);  
		if($form_data['mode']!='' && $form_data['Amount'] > 0  ){
 
/** Scenario: Create a simple transaction. **/
// Create a new API wrapper instance
$cps_api = new   CoinpaymentsAPI(API_PRIVATE_KEY, API_PUBLIC_KEY, 'json'); 
// Enter amount for the transaction
$amount = $form_data['Amount'];
// Litecoin Testnet is a no value currency for testing
$currency = $form_data['mode'];
// Enter buyer email below
$buyer_email = $AR_MEM['member_email'];



// $transaction_response = $cps_api->GetFullTransactionList();
//  $transaction_response = $cps_api->GetTxInfoSingle('CPFD0U2MS5HUDUDP5W5BSQHHOR');
// echo "<pre>";print_r($transaction_response);die('ssss');
// Make call to API to create the transaction
// $transaction_response = $cps_api->GetRates();

// echo "<pre>";print_r($transaction_response);die('ssss');



try {
    $transaction_response = $cps_api->CreateSimpleTransaction($amount, $currency, $buyer_email);
} catch (Exception $e) {
                    $output =  'Error: ' . $e->getMessage();
                    set_message("danger",$output);
                    redirect_member("cryptogateway","index" ); 
                    exit();
}
 
if ($transaction_response['error'] == 'ok') {
   							 
            $member_id = $this->session->userdata('mem_id');
            $data = array(
            "member_id"=>$member_id,
            "mode"=>$currency, "amount"=>$amount,
            "txn_id"=>$transaction_response['result']['txn_id'],
            "address"=>$transaction_response['result']['address'],
            "confirms_needed"=>$transaction_response['result']['confirms_needed'],
            "timeout"=>$transaction_response['result']['timeout'],
            "checkout_url"=>$transaction_response['result']['checkout_url'],
            "status_url"=>$transaction_response['result']['status_url'],
            "qrcode_url"=>$transaction_response['result']['qrcode_url'],
            "date_time"=> date('Y-m-d H:i:s'),
            "status_url"=>$transaction_response['result']['status_url'],
            );
                    $request_id = $this->SqlModel->insertRecord(prefix."tbl_crypto_trns",$data);
                    set_message("success","Successfully generated Link !");
                    redirect_member("account","addfund" ); 
                    
                    
} else {
    // Something went wrong!
    $output = 'Error: ' . $transaction_response['error'];
    
            set_message("danger",$output);
            redirect_member("cryptogateway","index" ); 
}

		}
		else
		{
		      set_message("danger","Invalid access !");
            redirect_member("cryptogateway","index" ); 
		}

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//Result  
	
// 	[time_created] => 1617788575
//             [time_expires] => 1617795775
//             [status] => 0
//             [status_text] => Waiting for buyer funds...
//             [type] => coins
//             [coin] => TRX
//             [amount] => 100000000000
//             [amountf] => 1000.00000000
//             [received] => 0
//             [receivedf] => 0.00000000
//             [recv_confirms] => 0
//             [payment_address] => TS19P4hvMUXAvkDM95eauL49cvCso86vJP





// [error] => ok
//     [result] => Array
//         (
//             [amount] => 1000.00000000
//             [txn_id] => CPFD6BIYJKHBBKFOEVBDXYZDYB
//             [address] => TTYpBGoK74bFqY54Fben34MXp47WCA8sNC
//             [confirms_needed] => 10
//             [timeout] => 7200
//             [checkout_url] => https://www.coinpayments.net/index.php?cmd=checkout&id=CPFD6BIYJKHBBKFOEVBDXYZDYB&key=8706695eb78b29e827e9a8ce4e2c4c6f
//             [status_url] => https://www.coinpayments.net/index.php?cmd=status&id=CPFD6BIYJKHBBKFOEVBDXYZDYB&key=8706695eb78b29e827e9a8ce4e2c4c6f
//             [qrcode_url] => https://www.coinpayments.net/qrgen.php?id=CPFD6BIYJKHBBKFOEVBDXYZDYB&key=8706695eb78b29e827e9a8ce4e2c4c6f
//         )
	
}
