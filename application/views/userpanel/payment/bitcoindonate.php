<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$this->load->view('coinbase/vendor/autoload.php');		
	use Coinbase\Wallet\Client;
	use Coinbase\Wallet\Configuration;
	
	$trns_type = "DONATE";
	$deposit_amount = $POST['deposit_amount'];
	$AR_PROC = $this->OperationModel->getProcessor("1");
	$processor_id = FCrtRplc($AR_PROC['processor_id']);
	
	
	
	$apiKey = ($AR_PROC['api_key'])? $AR_PROC['api_key']:'SAgONni29QpHlnWf';
	$apiSecret = ($AR_PROC['api_screat'])? $AR_PROC['api_screat']:'f71NbaXLrdJBrgkTxPJOgOKHYC2P6xGm';
	$configuration = Configuration::apiKey($apiKey, $apiSecret);
	//$configuration->setApiUrl(Configuration::SANDBOX_API_URL); // remove this line to not use the sandbox
	$client = Client::create($configuration);	
	
	$member_id = $this->session->userdata('mem_id');
	
	if(!is_numeric($deposit_amount) && !isset($member_id)){
		echo "Unable to generate address, invalid amount"; exit; 
	}

	use Coinbase\Wallet\Resource\Account;
	use Coinbase\Wallet\Resource\Address;
	
	$account = new Account();
	$AR_COIN = $this->OperationModel->getMemberCoinBase($member_id,$trns_type);
	$coinbase_name = ($AR_COIN['coinbase_name'])? $AR_COIN['coinbase_name']:$this->OperationModel->getMemberUserId($member_id);
	
	$primaryAccount = $client->getPrimaryAccount();
	if($AR_COIN['coinbase_id']=='' || $AR_COIN['coinbase_id']=='0' || !isset($AR_COIN['coinbase_id'])){	
		$address = new Address();
		$client->createAccountAddress($primaryAccount,$address);
		$coinbase_id = $this->OperationModel->setMemberCoinBase($member_id,$coinbase_name,$address->getAddress(),$deposit_amount,$processor_id,$trns_type);
		if($coinbase_id=="" && $coinbase_id==0){ echo "Unable to generate address"; exit; }
	}
	

	$qr = new qrcode();
	$coinbase_address =  ($AR_COIN['coinbase_address']!='')? $AR_COIN['coinbase_address']:$address->getAddress();
	$coinbase_id_val = ($coinbase_id>0)? $coinbase_id:$AR_COIN['coinbase_id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Bitcoin Payment </title>
<link href="<?php echo BASE_PATH; ?>memassets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>theme/bitcoin/style.css" type="text/css" />
<link href="<?php echo BASE_PATH; ?>memassets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BASE_PATH; ?>jquery/jquery-1.11.1.js"></script>
</head>

<body>
	<div class="container">
    	<div class="row">
        	<div class="col-md-6 col-md-offset-3">
            	<div class="main">
                	<div class="row top">
                    	<div class="col-xs-6">
                        	<p class="total"> Total:  <span class="sm"><?php echo $POST['deposit_amount']; ?></span> BTC </p>
                        </div>
                        <div class="col-xs-6" style="padding-right:0px;">
                        	<img src="<?php echo BASE_PATH; ?>theme/bitcoin/images/payment.png" class="img-responsive" />
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-xs-3">
							<?php 
								$param = array();
								$param[] = array("amount" =>$POST['deposit_amount']);
								$qr->iappli("https://blockchain.info/address/".$coinbase_address."","",$param);
								echo "<img src='".$qr->get_link()."' class='img-responsive'/>";
						?>
                        </div>
                        <div class="col-xs-9" style="padding-left:0px; padding-right:0px;">
							<div class="intro"><strong>Note :</strong> Please use this address for only one time	</div>
                       		<div class="intro-send">
                        		<p> Send EXACTLY <?php echo ($POST['deposit_amount']); ?> BTC : </p>
                            </div>
                            <div class="add">
                              <a href="#" data-toggle="tooltip" id="addresscopy" title="Bitcoin Wallet Address is unique identifier which allows users to receive and send Bitcoins."><?php  echo $coinbase_address; ?></a>
                            </div>
                             <button class="sub-btn"   onclick="copyToClipboard(document.getElementById('addresscopy').innerHTML)"> Copy Address </button>
							 <input type="hidden" name="coinbase_id" id="coinbase_id" value="<?php echo _e($coinbase_id_val); ?>" />
                        </div>
                    </div>
                    <div class="row">
                    	<div class="col-md-12">
                        	<button class="btn-wait" data-toggle="tooltip" 
                            title="Please send the exact Bitcoin sum as shown - <?php echo ($POST['deposit_amount']); ?> BTC (in one payment)! If you send any other sum, payment system will ignore the transaction and you will need to send the correct sum again, or contact the site owner for assistance. If you have already sent Bitcoins to the address above, please wait 1-2 min to receive them by Bitcoin payment system"> 
                            <span id="paymentLoader"><i class="fa fa-spinner fa-spin animated"></i> Waiting Payment From You </span>
                            </button>
							
                        </div>
                    </div>
                </div> 
                <div class="btm" id="button_div"> 
                	<a href="javascript:void(0)" id="payment_sts_button" class="get_payment_sts"> Click Here if you have already sent Bitcoins » </a>  
                </div>
				
            </div>
        </div>
    </div> 
    <script>	
		function copyToClipboard(text) {
  			window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
		}
		$(function(){
			$(".get_payment_sts").on( "click",check_payment_status);
			interval = setInterval(check_payment_status,30000);
			function check_payment_status(){
				var coinbase_id = $("#coinbase_id").val();
				$("#payment_sts_button").html('<i class="fa fa-spinner fa-spin animated"></i>')
				var URL_LOAD= "<?php echo BASE_PATH; ?>json/jsonhandler?switch_type=BITCOIN_PAYMENT_DONATE";
				//alert(URL_LOAD);
				var data = {
					coinbase_id: coinbase_id,
					trns_type: "<?php echo $trns_type; ?>",
					trns_remark: "<?php echo $POST['trns_remark']; ?>";
				};
				$.getJSON(URL_LOAD,data,function(jsonVal){
					if(jsonVal.error_msg!=''){
						switch(jsonVal.error_msg){
							case "success":
								$("#paymentLoader").html('<i class="fa fa-check"></i> We have successfully recievd a  payment ');
								$(".get_payment_sts").hide();
								clearInterval(interval);
							break;
							case "invalidamount":
								$("#paymentLoader").html('<i class="fa fa-spinner fa-spin animated"></i> It seem you have deposited less amount, please deposit rest amount on <br />same address');
								$("#payment_sts_button").html('Check your payment status')
								$("#button_div").html('<a target="_blank" href="'+jsonVal.link_check+'"> Check your payment status </a>');
							break;
							case "pending":
								$("#paymentLoader").html('<i class="fa fa-spinner fa-spin animated"></i> You have successfully deposited BTC , but it is in unconfirmed stage');
								$("#payment_sts_button").html('Check your payment status')
								$("#button_div").html('<a target="_blank" href="'+jsonVal.link_check+'"> Check your payment status </a>');
							break;
							default:
								$("#paymentLoader").html('<i class="fa fa-spinner fa-spin animated"></i> Still waiting payment from you ');
								$("#payment_sts_button").html('Click Here if you have already sent Bitcoins »')
							break;
						}
					}
				});
			}
		});
	</script>
</body>
</html>
