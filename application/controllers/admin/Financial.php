<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Financial extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	
		public function withdrawlapibusdtdemolive($member_id){
	    $model = new OperationModel();
	    
	    	$segment = $this->uri->uri_to_assoc(2);
	    $member_idd= 	$segment['member_id'];
	    
	     $id= 	$segment['id'];
	    //	PRintR($member_id);
	//    die;
//die;

$Q_MEM = "SELECT * FROM tbl_fund_transfer WHERE trns_status='P' and trns_for='WITHDRAW' and from_member_id='$member_idd'   and  transfer_id='$id'   ORDER BY `tbl_fund_transfer`.`transfer_id` DESC limit 1"; 
$RS_MEM = $this->SqlModel->runQuery($Q_MEM);  //PrintR($RS_MEM);die;
$today_date = getLocalTime();
$trns_date = InsertDate($today_date);
$coinprice = $this->SqlModel->runQuery("SELECT * FROM `tbl_coin_rate` WHERE 1 ORDER BY `tbl_coin_rate`.`id` DESC limit 1"); 
// PrintR($coinprice);
foreach($RS_MEM as $AR_MEM)         {   
$transfer_id  =$AR_MEM['transfer_id'];
$member_id  =$AR_MEM['from_member_id'];
$trns_status   =$AR_MEM['trns_status'];
$addresss   =$AR_MEM['trxaddress'];
$trns_amount =  $AR_MEM['trns_amount'];
$initial_amount =  $AR_MEM['initial_amount'];
$cryptoname =  $AR_MEM['cryptoname'];
$stacking =  $AR_MEM['stacking'];
$trns_for=  $AR_MEM['trns_for'];
$liquidity =  $AR_MEM['liquidity'];
$memberdetail   = $model->getMemberdetail($member_id);
$member_email      = $memberdetail['member_email'];
$user_id      = $memberdetail['user_id'];



$ownerbalance=getbalance();    


if($trns_status=='P'){

//  echo   $ownerbalance;
//  echo "<br>";
//  echo $trns_amount;

if($trns_amount <=$ownerbalance) {  


$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
$curl = curl_init();


$PKEYTT = '#';
$contractaddrss='0x55d398326f99059fF775485246999027B3197955';
$ToAddressT=$addresss;
$_float = $trns_amount;
$_float = explode(".", $_float);
$_float1 = strlen($_float[1]);

if($_float1==1){

$_float2='00000000000000000';
}

elseif($_float1==2){

$_float2='0000000000000000';
}else{

$_float2='000000000000000000';

}




$AmountT=$trns_amount.$_float2;  

$AmountT=  str_replace(".", "", $AmountT);


// die;

echo '<script src="https://cdn.jsdelivr.net/npm/web3@1.5.2/dist/web3.min.js"></script>';
echo "<script>
async function transferUSDT() {
const web3 = new Web3('https://bsc-dataseed.binance.org/'); // BSC RPC endpoint

try {

const privateKey = '$PKEYTT'; // Replace with the actual private key
const fromAddress = '#'; // Replace with the actual sender address
const toAddress = '$ToAddressT'; // Replace with the actual recipient address
const usdtContractAddress = '$contractaddrss'; // Example: USDT on BSC mainnet



const transferFunction = 'transfer';
// const amount = '<?php echo $AmountT; ?>;'; // 1 USDT in Wei
const amount = '$AmountT'; // 1 USDT in Wei
// Build the raw transaction
const rawTransaction = {
from: fromAddress,
to: usdtContractAddress,
gas: '200000', // Replace with an appropriate gas value
gasPrice: '5000000000', // Replace with an appropriate gas price
data: web3.eth.abi.encodeFunctionCall({
name: transferFunction,
type: 'function',
inputs: [
{ type: 'address', name: '_to' },
{ type: 'uint256', name: '_value' }
],
}, [toAddress, amount]),
};

// Sign the transaction
const signedTransaction = await web3.eth.accounts.signTransaction(rawTransaction, privateKey);

// Send the signed transaction
const result = await web3.eth.sendSignedTransaction(signedTransaction.rawTransaction);

console.log('Transaction Hash:', result.transactionHash);

// Send transaction details to the server
const transactionDetails = {
transactionHash: result.transactionHash,
from: fromAddress,
to: toAddress,
amount: amount,
};

// Make an AJAX request to the server to store transaction details
const xhr = new XMLHttpRequest();
xhr.open('POST', 'https://forexonefx.com/transaction_ss.php', true);
xhr.setRequestHeader('Content-Type', 'application/json');
xhr.send(JSON.stringify(transactionDetails));
window.location.replace('https://forexonefx.com/panel/admin/financial/withdrawals_s');
} catch (error) {
console.error('Error:', error.message);
}
}
// Automatically call the transferUSDT function when the page loads
transferUSDT();
</script>";




// PRintR($response);die;

$res_data      = 'N/A';
$txid          = 'N/A'; 

$data = array(
"txid"=>$txid,
"res_data"=>$res_data,
"coin_rate"=>0,
"coins_total"=>0,
"coins_charge"=>0,
"coins_trns"=>0,
"trns_status"=>'C',
"hashcode"=>$response,
"status_up_date"=>$trns_date,

);			



$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",$data,array("transfer_id"=>$transfer_id));     









$amount=$trns_amount;
//$model->massagesend($mobile,$message); 							 	
//	$email = d';
$config = array(
'protocol'  => 'smtp',
'smtp_host' => $model->getValue("CONFIG_SYSTEM_HOST"),
'smtp_port' => $model->getValue("CONFIG_SYSTEM_PORT"),
'smtp_user' => $model->getValue("CONFIG_SYSTEM_LOGIN"),
'smtp_pass' => $model->getValue("CONFIG_SYSTEM_PASSWORD"),
'mailtype'  => 'html', 
'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
$message2 = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="x-apple-disable-message-reformatting">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>

<style type="text/css">
a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_2 .v-src-width { width: 350px !important; } #u_content_image_2 .v-src-max-width { max-width: 42% !important; } #u_content_heading_3 .v-font-size { font-size: 22px !important; } #u_content_text_7 .v-container-padding-padding { padding: 0px 120px 20px 15px !important; } #u_content_button_1 .v-container-padding-padding { padding: 10px 10px 30px !important; } #u_content_button_1 .v-padding { padding: 13px 40px !important; } #u_content_divider_1 .v-container-padding-padding { padding: 50px !important; } }
@media only screen and (min-width: 570px) {
.u-row {
width: 550px !important;
}
.u-row .u-col {
vertical-align: top;
}

.u-row .u-col-100 {
width: 550px !important;
}

}

@media (max-width: 570px) {
.u-row-container {
max-width: 100% !important;
padding-left: 0px !important;
padding-right: 0px !important;
}
.u-row .u-col {
min-width: 320px !important;
max-width: 100% !important;
display: block !important;
}
.u-row {
width: calc(100% - 40px) !important;
}
.u-col {
width: 100% !important;
}
.u-col > div {
margin: 0 auto;
}
}
body {
margin: 0;
padding: 0;
}

table,
tr,
td {
vertical-align: top;
border-collapse: collapse;
}

p {
margin: 0;
}

.ie-container table,
.mso-container table {
table-layout: fixed;
}

* {
line-height: inherit;
}

a[x-apple-data-detectors="true"] {
color: inherit !important;
text-decoration: none !important;
}

</style>

<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">

</head>

<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff">

<table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
<tbody>
<tr style="vertical-align: top">
<td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">



<div class="u-row-container" style="padding: 0px;background-color: transparent">
<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">

<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
<div style="width: 100% !important;">
<!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
<tbody>
<tr>
<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:"Cabin",sans-serif;" align="left">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding-right: 0px;padding-left: 0px;" align="center">

<img align="center" border="0" src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 208px;" width="208" class="v-src-width v-src-max-width"/>

</td>
</tr>
</table>

</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #d20039;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">

<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
<div style="width: 100% !important;">
<!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
<br>
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
<tbody>
<tr>
<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 15px;font-family:"Cabin",sans-serif;" align="left">



</td>
</tr>
</tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
<tbody>
<tr>
<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 15px;font-family:"Cabin",sans-serif;" align="left">

<div style="color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word;">
<p style="font-size: 14px; line-height: 160%;"><span style="font-size: 20px; line-height: 32px;"><strong>Withdrawal Successful</strong></span></p>
</div>

</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
</div>



<div class="u-row-container" style="padding: 0px;background-image: url("https://cdn.templates.unlayer.com/assets/1620123209967-Untitled1.gif");background-repeat: no-repeat;background-position: center top;background-color: transparent">
<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #d20039;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">

<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
<div style="width: 100% !important;">
<!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->

<table id="u_content_image_2" style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
<tbody>
<tr>
<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Cabin",sans-serif;" align="left">

<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
<td style="padding-right: 0px;padding-left: 0px;" align="center">

<img align="center" border="0" src="https://cdn.templates.unlayer.com/assets/1620123323348-cc.gif" alt="Check" title="Check" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 24%;max-width: 127.2px;" width="127.2" class="v-src-width v-src-max-width"/>

</td>
</tr>
</table>

</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #d20039;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">

<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
<div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
<tbody>
<tr>
<td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 15px 25px;font-family:"Cabin",sans-serif;" align="left">

<div style="color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word;">
<p style="font-size: 14px; line-height: 160%;">Dear '.$user_id.' Your withdrawal of $ '.$amount.' has been processed successfully<br>Please Check Your Wallet</p>
</div>

</td>
</tr>
</tbody>
</table>



</div>
</div>
</div>

</div>
</div>
</div>


<div class="u-row-container" style="padding: 0px;background-color: transparent">
<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">

<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
<div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">


</div>
</div>
</div>

</div>
</div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
<div style="border-collapse: collapse;display: table;width: 100%;background-image: url("https://cdn.templates.unlayer.com/assets/1620124623453-vv.png");background-repeat: no-repeat;background-position: center top;background-color: transparent;">

<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
<div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">




</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
<div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
<div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">



</td>
</tr>
</tbody>
</table>





</body>

</html>
';	


$subject="Withdrawal Successful";


$apiKey = '#';
$fromEmail = 'noreply@forexonefx.com';
$subject="Withdrawal Successfull";

$url = 'https://api.sendinblue.com/v3/smtp/email';

$data = array(
'sender' => array(
'name' => 'forexonefx.com',
'email' => $fromEmail
),
'to' => array(
array(
'email' => $member_email
)
),
'subject' => $subject,
'htmlContent' => $message2
);


$headers = array(
'Content-Type: application/json',
'api-key: ' . $apiKey
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);
curl_close($ch);

if ($result) {
//  echo 'Email sent successfully.';
} else {
// echo 'Email could not be sent.';
}






// die;


}  


}  
}   

$this->load->view(ADMIN_FOLDER.'/financial/loadingpage',$data);
}
	  public function tradememberpage()
	{
	       	$model = new OperationModel();
		 $AR_PRSS = $model->getProcess();
            $process_id = $AR_PRSS['process_id'];
            $end_date=$AR_PRSS['end_date'];
	 
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date =$today_date =date('Y-m-d');// getLocalTime();
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		
		$order_no = UniqueId('ORDER_NO');
		if($form_data['submitUpgrade']=='1'){
		  
		   
		  //   set_message("warning","-");
    //                     redirect_page("users","upgrademember","");
		    
			$Equity = FCrtRplc($form_data['Equity']);
			$Margin = FCrtRplc($form_data['Margin']);
				$FreeMargin = FCrtRplc($form_data['FreeMargin']);
			$MarginLevel = FCrtRplc($form_data['MarginLevel']);
			 $Balance = FCrtRplc($form_data['Balance']);
			 	
			
				
				if(true){	
			
			
		
			        
			       	$data_sub = array("Equity"=>$Equity,
						"Margin"=>$Margin,
						"FreeMargin"=>$FreeMargin,
						"MarginLevel"=>$MarginLevel,
						"Balance"=>$Balance,
						
						
                        
                       
					);
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_tradingview_trade_updation",$data_sub); 
			        
		
	// PrintR($form_data);
		 //     die;
set_message("success","You have successfully Add");
					 redirect_page("financial","tradememberpage",""); 
 
			}else{
				set_message("warning","Member not found , please select valid member");
				 redirect_page("financial","tradememberpage","");
			}
		}
		
	
	$this->load->view(ADMIN_FOLDER.'/financial/otherupdations_trade',$data);
	}
	 
	    public function otherupdations()
	{
	       	$model = new OperationModel();
		 $AR_PRSS = $model->getProcess();
            $process_id = $AR_PRSS['process_id'];
            $end_date=$AR_PRSS['end_date'];
	 
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date =$today_date =date('Y-m-d');// getLocalTime();
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		
		$order_no = UniqueId('ORDER_NO');
		if($form_data['submitUpgrade']=='1'){
		  
		   
		  //   set_message("warning","-");
    //                     redirect_page("users","upgrademember","");
		    
			$Deposit = FCrtRplc($form_data['Deposit']);
			$Profit = FCrtRplc($form_data['Profit']);
				$Swap = FCrtRplc($form_data['Swap']);
			$Commission = FCrtRplc($form_data['Commission']);
			 $Balance = FCrtRplc($form_data['Balance']);
			 	
			
				
				if(true){	
			
			
		
			        
			       	$data_sub = array("Deposit"=>$Deposit,
						"Profit"=>$Profit,
						"Swap"=>$Swap,
						"Commission"=>$Commission,
						"Balance"=>$Balance,
						
						
                        
                       
					);
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_tradingview_updation",$data_sub); 
			        
		
	// PrintR($form_data);
		 //     die;
set_message("success","You have successfully Add");
					 redirect_page("financial","otherupdations",""); 
 
			}else{
				set_message("warning","Member not found , please select valid member");
				 redirect_page("financial","otherupdations","");
			}
		}
		
	
	$this->load->view(ADMIN_FOLDER.'/financial/otherupdations',$data);
	}
		public function buy_sell_history(){
		    
    	$model = new OperationModel();
		 $AR_PRSS = $model->getProcess();
            $process_id = $AR_PRSS['process_id'];
            $end_date=$AR_PRSS['end_date'];
	 
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date =$today_date =date('Y-m-d');// getLocalTime();
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		
		$order_no = UniqueId('ORDER_NO');
		if($form_data['submitUpgrade']=='1'){
		  
		   
		  //   set_message("warning","-");
    //                     redirect_page("users","upgrademember","");
		    
			$buy_sell = FCrtRplc($form_data['buy_sell']);
			$timmer = FCrtRplc($form_data['timmer']);
				$pair = FCrtRplc($form_data['pair']);
			$qty = FCrtRplc($form_data['qty']);
			 $price = FCrtRplc($form_data['price']);
			 	 $p_price = FCrtRplc($form_data['p_price']);
			
				
				if(true){	
			
			
		
			        
			       	$data_sub = array("buy_sell"=>$buy_sell,
						"timmer"=>$timmer,
						"pair"=>$pair,
						"qty"=>$qty,
						"price"=>$price,
							"p_price"=>$p_price,
						
                        
                       
					);
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_tradingview",$data_sub); 
			        
		
	// PrintR($form_data);
		 //     die;
set_message("success","You have successfully Add");
					 redirect_page("financial","buy_sell_history",""); 
 
			}else{
				set_message("warning","Member not found , please select valid member");
				 redirect_page("financial","buy_sell_history","");
			}
		}
		
	
	
		$this->load->view(ADMIN_FOLDER.'/financial/buy_sell_history',$data);
	}
		public function miningstaking(){
		$this->load->view(ADMIN_FOLDER.'/financial/miningstaking',$data);
	}
		public function airdroprequest(){
		$this->load->view(ADMIN_FOLDER.'/financial/airdrop_request',$data);
	}
	
		public function sendairdrop(){
		    
	 
	    	$model = new OperationModel();
	  $member_id = $this->uri->segment(4); 
	  

	
	   if($member_id==''){
	     
	       $hhhh='Please Try Again';
   set_message("warning",$hhhh);
	redirect_page("financial","airdroprequest");
	     
	 }else{
	     
	        instantAirdropIncomeGenerte($member_id,$package_price,$subcription_id,$type_id);
	     
	       
	      $hhhh='Success';
   set_message("warning",$hhhh);
	redirect_page("financial","airdroprequest");
	     
	 }
	  
   
		    
		    
		$this->load->view(ADMIN_FOLDER.'/financial/airdrop_request',$data);
	}
		public function verifygasfee($address)
	{
	    
	    	$model = new OperationModel();
echo	  $address = $this->uri->segment(4); 
echo "<br>";
echo	   $token = $this->uri->segment(5); 
	   echo "<br>";
echo	   $blockNumber = $this->uri->segment(6); 
	   echo "<br>";
die;
	  
	   if($address==''){
	     
	       $hhhh='Please Try Again';
   set_message("warning",$hhhh);
	redirect_page("financial","crypto_payment_history");
	     
	 }else{
	    
	  if($token=='DGC'){
	        $contactaddress='0x25f37E2316B96d1FC5aE2c81dC850f678E46661c';   
	     $count =  $model->checkgasfeee('tbl_cryptofund','txn_id',$blockNumber,'0'); 
	  if($count==1){
	      
	       manullytransfergasfee($address);
  
	      
	      
	  }   
	   manualtransfertohotwalletbusd($address,$contactaddress);    
	      
	  }else{
	      $contactaddress='0x55d398326f99059fF775485246999027B3197955'; 
	     $count =  $model->checkgasfeee('tbl_cryptofund','txn_id',$blockNumber,'0'); 
	  if($count==1){
	      
	       manullytransfergasfee($address);
  
	      
	      
	  }   
	     manualtransfertohotwalletbusd($address,$contactaddress);  
	     
	     
	      
	      
	  }  
	    
	     
	     
	     
	     
	      $hhhh='Success';
   set_message("warning",$hhhh);
	redirect_page("financial","crypto_payment_history");
	     
	 }
	  
	  
	    
	    
	    
	$this->load->view(ADMIN_FOLDER.'/financial/crypto_payment_history',$data);
	}
	 public function addtransaction(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = getLocalTime();
		$segment = $this->uri->uri_to_assoc(2);
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
	$wallet_trns_id = ($form_data['wallet_trns_id'])? $form_data['wallet_trns_id']:$segment['wallet_trns_id'];
		
	 
		
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitTransaction']==1 && $this->input->post()!=''){
				 $wallet_id = ($form_data['wallet_id']>0)? $form_data['wallet_id']:0;
				   
					$member_id = $model->getMemberId($form_data['user_id']);
					
				 
					
					$withdraw_fee_percent = 0;
					$deposit_fee_percent = 0;
					$process_fee_percent = 0;
					
					$initial_amount = FCrtRplc($form_data['initial_amount']);
						$trns_remark = FCrtRplc($form_data['trns_remark']);
					$trns_type = FCrtRplc($form_data['trns_type']);
					$trns_date = $today_date;
					$trans_no = UniqueId("TRNS_NO");
					
					if($trns_type=="Dr"){
						$WITDRAW_FEE = ($initial_amount*$withdraw_fee_percent/100); 
					}
					if($trns_type=="Cr"){
						$DEPOSITE_FEE = ($initial_amount*$deposit_fee_percent/100);
					}
					$PROCESS_FEE = ($initial_amount*$process_fee_percent/100);
					
					$CONFIG_ADMIN_CHARGE_PERCENT =  ($initial_amount*$CONFIG_ADMIN_CHARGE/100); 
					$admin_charge = 0;
					$total_charge = ($admin_charge+$WITDRAW_FEE+$DEPOSITE_FEE+$PROCESS_FEE);
					$trns_amount = ($initial_amount-$total_charge);
					 
					
					if(is_numeric($initial_amount) && $initial_amount>0){
					 
				     $to_member_id = FCrtRplc($member_id);
					 $to_user_id = $model->getMemberUserId($to_member_id);
					 $trns_status = "C";
				 
					$trans_no = UniqueId("TRNS_NO");
					
				
						if($to_member_id>0){
							$data = array(
							    "wallet_id"=> ($wallet_id>0)? $wallet_id:0,
								"trans_no"=>$trans_no,
								"from_member_id"=>0,
								"to_member_id"=>$to_member_id,
								"initial_amount"=>$initial_amount,
								"withdraw_fee"=> 0,
								"deposit_fee"=>0,
								"process_fee"=>0,
								"admin_charge"=>0,
								"trns_amount"=>$trns_amount,
								"trns_remark"=>$trns_remark,
								"trns_type"=>$trns_type,
								"trns_for"=>($trns_type=='Cr')? 'Credit':'Debit',
								"trns_status"=>"C",
								"draw_type"=>($trns_type=='Cr')? 'Credit':'Debit',
								"trns_date"=>$today_date
							);
						 
							    
							$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
							$model->wallet_transaction($wallet_id,$trns_type,$to_member_id,$trns_amount,$trns_remark,$today_date,$trans_no,"1","AM");
						 
					 
							set_message("success","You have successfully added  a new  transaction");
							redirect_page("financial","addtransaction",array("error"=>"success"));	
						}else{
							set_message("warning","Invalid member id");		
							redirect_page("financial","addtransaction",array("request_id"=>_e($request_id)));
						}	
					    
					    
					    
					}else{
						set_message("warning","Invalid amount, please enter valid amount");
						redirect_page("financial","addtransaction","");
					}					
				}
			 
			break;
		 
		}
		$this->load->view(ADMIN_FOLDER.'/financial/addtransaction',$data);
	}
	 
	 public function updateDepositLink()
	{
      	$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = getLocalTime();
	    $ID = _d($this->uri->segment(4));
		$STS = _d($this->uri->segment(5));
		$row = $model->getrow("tbl_coinpayment","id",$ID);
		if(is_array($row) and !empty($row))
		{
                        
                        if($STS =='N')
                        {
                        $status_text = "Cancelled / Timed Out";
                        $this->SqlModel->updateRecord("tbl_coinpayment",array("status" => "R", "status_text" =>$status_text ),array("id" => $ID));
                        }
                        if($STS =='Y')
                        {
                            $status_text = "Complete";
                            $this->SqlModel->updateRecord("tbl_coinpayment",array("status" => "Y", "status_text" =>$status_text ),array("id" => $ID));  
                            $trans_no = rand(123434,4564563);
                            $trns_remark = "Fund added via EGC Coin";
                            $model->wallet_transaction('3',"Cr",$row['member_id'],$row['added_usd'],$trns_remark,date('Y-m-d'),$trans_no,1,"EGC");   
                            
                        }  
                set_message("success","Transaction successfully approved!");		
                redirect_page("financial","coinpaymentHistory", ""); 
		}
		else
		{
                set_message("warning","Invalid Transaction id");		
                redirect_page("financial","coinpaymentHistory", ""); 
		}
	}
	
		public function crypto_payment_history()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/crypto_payment_history',$data);
	}
		public function coinpaymentHistory()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/coinpaymentHistory',$data);
	}
 	public function refunddmtvvv()
	{
	    	$model = new OperationModel();
	  $trns_date = date('Y-m-d');
//   InsertWallet($servername, $username, $password, $dbname,20,"Cr",$amount,"Refunded");
//                             InsertWalletMember($servername, $username, $password, $dbname,1,$member_id,"Cr",$amount,"Refunded");
//                             $sql = "UPDATE `tbl_money_transfer` SET `manage_sts` = 'R', status='Failure' WHERE  `sender_id` = '$id';";
//                             $sql2 = "UPDATE `tbl_fund_transfer` SET  trns_status='R' WHERE   `mt_id` = '$id';";  
//                             $conn->query($sql2); 
	   
	  	    $QR_MEM = "SELECT * FROM `tbl_money_transfer` WHERE  `manage_sts` ='N' ";
		    $RS_MEM  = $this->SqlModel->runQuery($QR_MEM); 
		    if(is_array($RS_MEM) and !empty($RS_MEM))
		    { 
		        foreach($RS_MEM as $AR_MEM){
		  
	            $member_id =  $AR_MEM['member_id']  ;
                $total = $AR_MEM['total']/75 ;
                $dmt_amt = $AR_MEM['dmt_amt']; 
                $sender_id = $AR_MEM['sender_id'];  
  $key = 'ee3d77-afc3b3-0b2dc4-e1a463-a8470f';
  $order_idd = $AR_MEM['orderid'];
  $parameters="api_key=$key&order_id=$order_idd ";

	$url="https://www.kwikapi.com/api/v2/status.php";

	$ch = curl_init($url);
 
 
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
 
	
	
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
    $api_recharge = json_decode($return_val); 
    $data  = $api_recharge->response; // PrintR($data);die;
     
   
    if($data->status =='SUCCESS')
    {
      $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("manage_sts"=>'Y' , 'status' => 'Success'),array("sender_id"=>$sender_id));    
      $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'C' ),array("mt_id"=>$sender_id));    
    }
    elseif($data->status   =='FAILED')
    {
       
      $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("manage_sts"=>'Y' , 'status' => 'Failure'),array("sender_id"=>$sender_id));    
      $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'R'  ),array("mt_id"=>$sender_id)); 
        
            $trans_no = rand(11111,88888888);
            $trns_remark = "Refunded";
            $model->wallet_transaction(20,"Cr",1,$dmt_amt,$trns_remark,$trns_date,$trans_no,"1","VW");
            $model->wallet_transaction(1,"Cr",$member_id,$total,$trns_remark,$trns_date,$trans_no,"1","VW");
    }
    
    
		  	}
		  	
		  	 	set_message("success","You have successfully Refunded  ".count($RS_MEM)."  Transaction");
							redirect_page("financial","DmtStatus",array("error"=>"success"));	
		    }
		    else
		    {
		    
					 
							set_message("warning","Not found any pending Transaction");		
							redirect_page("financial","DmtStatus",array());   
		    }
		  		
	}
	
			public function DmtStatus()
	{
	    
	$this->load->view(ADMIN_FOLDER.'/financial/DmtStatus',$data);
	}
		public function api_wallet()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/apitrancation',$data);
	}
		public function RechargeStatus()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/RechargeStatus',$data);
	}
		public function dmttransaction()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/dmttransaction',$data);
	}
	public function turnover()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/turnover',$data);
	}
	public function incomereport()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/incomereport',$data);
	}	
	
		public function tdsdeduction()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/tdsdeductionreport',$data);
	}
		public function gstdeduction()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/gst',$data);
	}
	
		public function gstList()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/gstList',$data);
	}
		public function updatewithdrawdate()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/updatewithdrawdate',$data);
	}
	
	public function updatewithdrawaldateAjax()
	{
	    $dates = $this->input->post('dates');
	    $id = $this->input->post('id');
	    
	    $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_date"=>$dates),array("transfer_id"=>$id));
	}
			public function tdslist()
	{
	$this->load->view(ADMIN_FOLDER.'/financial/tdslist',$data);
	}
	public function addtransaction1v1(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = getLocalTime();
		$segment = $this->uri->uri_to_assoc(2);
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
	$wallet_trns_id = ($form_data['wallet_trns_id'])? $form_data['wallet_trns_id']:$segment['wallet_trns_id'];
		
		$CONFIG_ADMIN_CHARGE = $model->getValue("CONFIG_ADMIN_CHARGE");
		$CONFIG_ADMIN_MOBILE = $model->getValue("CONFIG_ADMIN_MOBILE");
		$CONFIG_ADMIN_EMAIL = $model->getValue("CONFIG_ADMIN_EMAIL");
		
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitTransaction']==1 && $this->input->post()!=''){
				 $wallet_id = ($form_data['wallet_id']>0)? $form_data['wallet_id']:0;
				   
					$member_id = $model->getMemberId($form_data['user_id']);
					
					$processor_id = $model->getDefaultProcessor();
					$AR_PRC = $model->getProcessor($processor_id);
					
					$withdraw_fee_percent = 0;
					$deposit_fee_percent = 0;
					$process_fee_percent = 0;
					
					$initial_amount = FCrtRplc($form_data['initial_amount']);
						$trns_remark = FCrtRplc($form_data['trns_remark']);
					$trns_type = FCrtRplc($form_data['trns_type']);
					$trns_date = InsertDate($today_date);
					$trans_no = UniqueId("TRNS_NO");
					
					if($trns_type=="Dr"){
						$WITDRAW_FEE = ($initial_amount*$withdraw_fee_percent/100); 
					}
					if($trns_type=="Cr"){
						$DEPOSITE_FEE = ($initial_amount*$deposit_fee_percent/100);
					}
					$PROCESS_FEE = ($initial_amount*$process_fee_percent/100);
					
					$CONFIG_ADMIN_CHARGE_PERCENT =  ($initial_amount*$CONFIG_ADMIN_CHARGE/100); 
					$admin_charge = 0;
					$total_charge = ($admin_charge+$WITDRAW_FEE+$DEPOSITE_FEE+$PROCESS_FEE);
					$trns_amount = ($initial_amount-$total_charge);
					
					$from_member_id = 0;
					$AR_MAP['wallet_id'] = $wallet_id;
					$AR_MAP['from_member_id'] = $from_member_id;
					$AR_MAP['to_member_id'] = $member_id;
					$AR_MAP['initial_amount'] = $initial_amount;
					$AR_MAP['deposit_fee'] = 0;
					$AR_MAP['withdraw_fee'] = 0;
					$AR_MAP['withdraw_fee'] = $WITDRAW_FEE;
					$AR_MAP['deposite_fee'] = $DEPOSITE_FEE;
					$AR_MAP['process_fee'] = $PROCESS_FEE;
					$AR_MAP['admin_charge'] = $admin_charge;
					$AR_MAP['trns_amount'] = $trns_amount;
					
					
					$AR_MAP['trns_remark'] = $trns_remark;
					$AR_MAP['trns_status'] = "C";
					$AR_MAP['status_up_date'] = $today_date;
					$AR_MAP['trns_type'] = $trns_type;
					$AR_MAP['trns_for'] = ($trns_type=='Cr')? 'Deposit':'Withdrawal';
					$AR_MAP['draw_type'] = ($trns_type=='Cr')? 'NA':'MANUAL';
					$new_value = json_encode($AR_MAP);
					
					if(is_numeric($initial_amount) && $initial_amount>0){
					    
					    	$NEW_VAL = json_decode($new_value,true);
					
					$wallet_id = FCrtRplc($NEW_VAL['wallet_id']);
					$trns_amount = FCrtRplc($NEW_VAL['trns_amount']);
					
					$to_member_id = FCrtRplc($NEW_VAL['to_member_id']);
					$to_user_id = $model->getMemberUserId($to_member_id);
					
					$initial_amount = FCrtRplc($NEW_VAL['initial_amount']);
					
					$withdraw_fee = FCrtRplc($NEW_VAL['withdraw_fee']);
					$deposite_fee = FCrtRplc($NEW_VAL['deposite_fee']);
					$process_fee = FCrtRplc($NEW_VAL['process_fee']);
					$admin_charge = FCrtRplc($NEW_VAL['admin_charge']);
					
					$trns_remark = strtoupper($NEW_VAL['trns_remark']);
					$trns_status = FCrtRplc($NEW_VAL['trns_status']);
					$status_up_date = ($NEW_VAL['status_up_date']);
					
					$trns_type = ($NEW_VAL['trns_type']);
					$trns_for = ($NEW_VAL['trns_for']);
					$draw_type = ($NEW_VAL['draw_type']);
					
					$trans_no = UniqueId("TRNS_NO");
					
				
						if($to_member_id>0){
							$data = array(
							    "wallet_id"=>1,//($wallet_id>0)? $wallet_id:0,
								"trans_no"=>$trans_no,
								"from_member_id"=>0,
								"to_member_id"=>$to_member_id,
								"initial_amount"=>$initial_amount,
								"withdraw_fee"=>($WITDRAW_FEE)? $WITDRAW_FEE:0,
								"deposit_fee"=>($DEPOSITE_FEE)? $DEPOSITE_FEE:0,
								"process_fee"=>($PROCESS_FEE)? $PROCESS_FEE:0,
								"admin_charge"=>$admin_charge,
								"trns_amount"=>$trns_amount,
								"trns_remark"=>$trns_remark,
								"trns_type"=>$trns_type,
								"trns_for"=>($trns_type=='Cr')? 'Deposit':'Withdrawal',
								"trns_status"=>"C",
								"draw_type"=>($trns_type=='Cr')? 'NA':'MANUAL',
								"trns_date"=>$today_date
							);
							if($wallet_id == '1')
							{
							    
							$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
							$model->wallet_transaction($wallet_id,$trns_type,$to_member_id,$trns_amount,$trns_remark,$today_date,$trans_no,"1","AM");
							
							}
							else
							{  
							$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
							$model->wallet_transaction($wallet_id,$trns_type,$to_member_id,$trns_amount,$trns_remark,$today_date,$trans_no,"1","AM");
							   
							}
							//$model->updateOTPSts($AR_TYPE['request_id']);
							set_message("success","You have successfully added  a new  transaction");
							redirect_page("financial","addtransaction",array("error"=>"success"));	
						}else{
							set_message("warning","Invalid member id");		
							redirect_page("financial","addtransaction",array("request_id"=>_e($request_id)));
						}	
					    
					    
					    
					    
					    
						/*if($member_id>0){
							$sms_otp = $model->sendFundtransferRequestSMSAdmin($CONFIG_ADMIN_MOBILE,$CONFIG_ADMIN_EMAIL,$initial_amount);
							$data = array("member_id"=>0,
								"new_value"=>$new_value,
								"sms_otp"=>$sms_otp,
								"sms_type"=>"ADMINTRANSFER",
								"mobile_number"=>$CONFIG_ADMIN_MOBILE
							);
							$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
							set_message("success","Please verify OTP from your registered email address");
							redirect_page("financial","addtransaction",array("request_id"=>_e($request_id)));
						}else{
							set_message("warning","Invalid member user, please enter valid username");
							redirect_page("financial","addtransaction","");
						}*/
					}else{
						set_message("warning","Invalid amount, please enter valid amount");
						redirect_page("financial","addtransaction","");
					}					
				}
				if($form_data['verifyOTPAdmin']!='' && $this->input->post()!=''){
				
					$request_id = _d($form_data['request_id']);
					$sms_otp = FCrtRplc($form_data['sms_otp']);
					$AR_TYPE = $model->verifySMSOTP($request_id,$sms_otp);
					
					$NEW_VAL = json_decode($AR_TYPE['new_value'],true);
					
					$wallet_id = FCrtRplc($NEW_VAL['wallet_id']);
					$trns_amount = FCrtRplc($NEW_VAL['trns_amount']);
					
					$to_member_id = FCrtRplc($NEW_VAL['to_member_id']);
					$to_user_id = $model->getMemberUserId($to_member_id);
					
					$initial_amount = FCrtRplc($NEW_VAL['initial_amount']);
					
					$withdraw_fee = FCrtRplc($NEW_VAL['withdraw_fee']);
					$deposite_fee = FCrtRplc($NEW_VAL['deposite_fee']);
					$process_fee = FCrtRplc($NEW_VAL['process_fee']);
					$admin_charge = FCrtRplc($NEW_VAL['admin_charge']);
					
					$trns_remark = strtoupper($NEW_VAL['trns_remark']);
					$trns_status = FCrtRplc($NEW_VAL['trns_status']);
					$status_up_date = ($NEW_VAL['status_up_date']);
					
					$trns_type = ($NEW_VAL['trns_type']);
					$trns_for = ($NEW_VAL['trns_for']);
					$draw_type = ($NEW_VAL['draw_type']);
					
					$trans_no = UniqueId("TRNS_NO");
					
					if($AR_TYPE['request_id']>0){
						if($to_member_id>0){
							$data = array("wallet_id"=>($wallet_id>0)? $wallet_id:0,
								"trans_no"=>$trans_no,
								"from_member_id"=>0,
								"to_member_id"=>$to_member_id,
								"initial_amount"=>$initial_amount,
								"withdraw_fee"=>($WITDRAW_FEE)? $WITDRAW_FEE:0,
								"deposit_fee"=>($DEPOSITE_FEE)? $DEPOSITE_FEE:0,
								"process_fee"=>($PROCESS_FEE)? $PROCESS_FEE:0,
								"admin_charge"=>$admin_charge,
								"trns_amount"=>$trns_amount,
								"trns_remark"=>$trns_remark,
								"trns_type"=>$trns_type,
								"trns_for"=>($trns_type=='Cr')? 'Deposit':'Withdrawal',
								"trns_status"=>"C",
								"draw_type"=>($trns_type=='Cr')? 'NA':'MANUAL',
								"trns_date"=>$today_date
							);
							$this->SqlModel->insertRecord(prefix."tbl_fund_transfer_wallet",$data);
							$model->ewallet_transaction($wallet_id,$trns_type,$to_member_id,$trns_amount,$trns_remark,$today_date,$trans_no,"1","AM");
							$model->updateOTPSts($AR_TYPE['request_id']);
							set_message("success","You have successfully added  a new  transaction");
							redirect_page("financial","addtransaction",array("error"=>"success"));	
						}else{
							set_message("warning","Invalid member id");		
							redirect_page("financial","addtransaction",array("request_id"=>_e($request_id)));
						}	
					}else{
						set_message("warning","Invalid OTP, please enter valid OTP");
						redirect_page("financial","addtransaction",array("request_id"=>_e($request_id)));
					}
				}
			break;
			case "DELETE":
				if($wallet_trns_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_fund_transfer",array("transfer_id"=>$transfer_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("financial","addtransaction",array()); exit;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/financial/addtransaction',$data);
	}
	
	
	public function viewtransactions(){
		$this->load->view(ADMIN_FOLDER.'/financial/viewtransactions',$data);
	}
	
		public function withdrawals_s(){
		$this->load->view(ADMIN_FOLDER.'/financial/withdrawals_success',$data);
	}
	
		public function withdrawals(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date = getLocalTime();

   $trns_date = InsertDate($today_date);
		if($form_data['confirmWithdraw']=='1'){
		      $coinprice = $this->SqlModel->runQuery("SELECT * FROM `tbl_coin_rate` WHERE 1 ORDER BY `tbl_coin_rate`.`id` DESC limit 1"); 
		   $transfer_id=  _d($form_data['transfer_id']);
		$remarks	=$form_data['remarks'];
		//	PrintR($form_data);die;
			if(count($transfer_id)>0){
			
					$AR_TRF = $model->getFundTransfer($transfer_id);
					
				
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
						    
						 //  die; 
						    
						  $member_id  =$AR_TRF['from_member_id'];
$trns_status   =$AR_TRF['trns_status'];
$addresss   =$AR_TRF['trxaddress'];
$trns_amount =  $AR_TRF['trns_amount'];
 $initial_amount =  $AR_TRF['initial_amount'];
       $cryptoname =  $AR_TRF['cryptoname'];
$stacking =  $AR_TRF['stacking'];
$trns_for=  $AR_TRF['trns_for'];
$liquidity =  $AR_TRF['liquidity'];
$memberdetail   = $model->getMemberdetail($member_id);
$member_email      = $memberdetail['member_email'];
$user_id      = $memberdetail['user_id'];
  
   //if($cryptoname=='Dizi Token'){
   $ownerbalance=1234567890; 
  // }
  
   
  
    if($trns_status=='P'){
        
    //  echo   $ownerbalance;
    //  echo "<br>";
    //  echo $trns_amount;
    
     if($trns_amount <=$ownerbalance) {  
         
        if(true){ 
           $trns_amount =  number_format($AR_MEM['trns_amount']/$coinprice[0]['new_rate'],2);    
             $date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
             
   
   $res_data      = 'N/A';
    $txid          = 'N/A'; 



    	$data = array(
					    "txid"=>$txid,
						"res_data"=>$res_data,
						"coin_rate"=>0,
						"coins_total"=>0,
						"coins_charge"=>0,
						"coins_trns"=>0,
						"trns_status"=>'C',
						"hashcode"=>$response,
						"status_up_date"=>$trns_date,
							"draw_type"=>"MANUAL_BY_OWNER",
								"remarks"=>$remarks,
					);			
    	
    	
    	
    	$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",$data,array("transfer_id"=>$transfer_id));     
    		
    	
    			    
				set_message("success","Fund request confirmed successfull");		
				redirect_page("financial","withdrawals_p",array());
						    
							
    		
  if(true){  		
    		
    		
    $amount=$trns_amount;
 	//$model->massagesend($mobile,$message); 							 	
//	$email = d';
	$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => $model->getValue("CONFIG_SYSTEM_HOST"),
    'smtp_port' => $model->getValue("CONFIG_SYSTEM_PORT"),
    'smtp_user' => $model->getValue("CONFIG_SYSTEM_LOGIN"),
    'smtp_pass' => $model->getValue("CONFIG_SYSTEM_PASSWORD"),
    'mailtype'  => 'html', 
    'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
    $message2 = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  
    <style type="text/css">
      a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_2 .v-src-width { width: 350px !important; } #u_content_image_2 .v-src-max-width { max-width: 42% !important; } #u_content_heading_3 .v-font-size { font-size: 22px !important; } #u_content_text_7 .v-container-padding-padding { padding: 0px 120px 20px 15px !important; } #u_content_button_1 .v-container-padding-padding { padding: 10px 10px 30px !important; } #u_content_button_1 .v-padding { padding: 13px 40px !important; } #u_content_divider_1 .v-container-padding-padding { padding: 50px !important; } }
@media only screen and (min-width: 570px) {
  .u-row {
    width: 550px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-100 {
    width: 550px !important;
  }

}

@media (max-width: 570px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: calc(100% - 40px) !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors="true"] {
  color: inherit !important;
  text-decoration: none !important;
}

</style>
  
<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">

</head>

<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff">

  <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
  <tbody>
  <tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">

    

<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
   
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:"Cabin",sans-serif;" align="left">
        
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
      <img align="center" border="0" src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 208px;" width="208" class="v-src-width v-src-max-width"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #d20039;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  <br>
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 15px;font-family:"Cabin",sans-serif;" align="left">
        
  

      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 15px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 20px; line-height: 32px;"><strong>Withdrawal Successful</strong></span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-image: url("https://cdn.templates.unlayer.com/assets/1620123209967-Untitled1.gif");background-repeat: no-repeat;background-position: center top;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #d20039;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
<table id="u_content_image_2" style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Cabin",sans-serif;" align="left">
        
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
      <img align="center" border="0" src="https://cdn.templates.unlayer.com/assets/1620123323348-cc.gif" alt="Check" title="Check" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 24%;max-width: 127.2px;" width="127.2" class="v-src-width v-src-max-width"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #d20039;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
  
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 15px 25px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 160%;">Dear '.$user_id.' Your withdrawal of $ '.$amount.' has been processed successfully<br>Please Check Your Wallet</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>



 </div>
  </div>
</div>

    </div>
  </div>
</div>


<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
     
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">


</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-image: url("https://cdn.templates.unlayer.com/assets/1620124623453-vv.png");background-repeat: no-repeat;background-position: center top;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">




      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">



      </td>
    </tr>
  </tbody>
</table>





</body>

</html>
';	
	

         $subject="Withdrawal Successful";
        
  
  
  $apiKey = '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';
$fromEmail = 'noreply@profitplustech.io';
 $subject="Withdrawal Successfull";

$url = 'https://api.sendinblue.com/v3/smtp/email';

$data = array(
    'sender' => array(
        'name' => 'profitplustech',
        'email' => $fromEmail
    ),
    'to' => array(
        array(
            'email' => $member_email
        )
    ),
    'subject' => $subject,
    'htmlContent' => $message2
);


$headers = array(
    'Content-Type: application/json',
    'api-key: ' . $apiKey
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);
curl_close($ch);

if ($result) {
  //  echo 'Email sent successfully.';
} else {
  // echo 'Email could not be sent.';
}


        } 
   
        }
 
   
    }  
   
    
}  
          }    
						    
							}
					}
					
					
			else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("financial","withdrawals_p",array());
			}		
			
			}else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("financial","withdrawals_p",array());
			}
		
	
		$this->load->view(ADMIN_FOLDER.'/financial/withdrawals_pending',$data);
	}
		public function withdrawals_p(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date = getLocalTime();
		$trns_date = $today_date; 
		
		if($form_data['submitBankTransaction']==1 && $this->input->post()!=''){
		
			$transfer_id = _d($form_data['transfer_id']);
			$bank_tid = FCrtRplc($form_data['bank_tid']);
			$date_time = InsertDate($form_data['date_time']);
			$bank_trans_no = FCrtRplc($form_data['bank_trans_no']);
			$bank_trans_detail = FCrtRplc($form_data['bank_trans_detail']);
			
			$bank_name = FCrtRplc($form_data['bank_name']);
			$bank_account_no = FCrtRplc($form_data['bank_account_no']);
			
			$data = array("transfer_id"=>$transfer_id,
				"date_time"=>$date_time,
				"bank_name"=>($bank_name!='')? $bank_name:" ",
				"bank_account_no"=>($bank_account_no!='')? $bank_account_no:" ",
				"bank_trans_no"=>($bank_trans_no!='')? $bank_trans_no:" ",
				"bank_trans_detail"=>($bank_trans_detail!='')? $bank_trans_detail:" "
			);
			if($bank_tid>0){
				$this->SqlModel->updateRecord(prefix."tbl_bank_transaction",$data,array("bank_tid"=>$bank_tid));
				set_message("success","You have successfully updated bank transaction detail");	
				redirect_page("financial","withdrawals_p",array()); exit;
			}else{
				$this->SqlModel->insertRecord(prefix."tbl_bank_transaction",$data);
				set_message("success","You have successfully added bank transaction detail");	
				redirect_page("financial","withdrawals_p",array()); exit;
			}
		}
		if($form_data['confirmWithdraw']==1 && $this->input->post()!=''){
			
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'C',"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
								
		//	$model->wallet_transaction($AR_TRF['wallet_id'],"Dr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request approved",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");
							}
					}
				endforeach;
				set_message("success","Fund request confirmed successfull");		
				redirect_page("financial","withdrawals_p",array());
			}else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("financial","withdrawals_p",array());
			}
		}
		if($form_data['rejectWithdraw']==1 && $this->input->post()!=''){
			
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'R',"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
									$model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");							
							}
					}
				endforeach;
				set_message("success","Fund request rejected successfull");		
				redirect_page("financial","withdrawals_p",array());
			}else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("financial","withdrawals_p",array());
			}
		}
		$this->load->view(ADMIN_FOLDER.'/financial/withdrawals_pending',$data);
	}
	public function withdrawalsffffffffff(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$today_date = getLocalTime();
		$trns_date = $today_date; 
	//	PrintR($segment['action_request']);
		if($form_data['submitBankTransaction']==1 && $this->input->post()!=''){
		
			$transfer_id = _d($form_data['transfer_id']);
			$bank_tid = FCrtRplc($form_data['bank_tid']);
			$date_time = InsertDate($form_data['date_time']);
			$bank_trans_no = FCrtRplc($form_data['bank_trans_no']);
			$bank_trans_detail = FCrtRplc($form_data['bank_trans_detail']);
			
			$bank_name = FCrtRplc($form_data['bank_name']);
			$bank_account_no = FCrtRplc($form_data['bank_account_no']);
			
			$data = array("transfer_id"=>$transfer_id,
				"date_time"=>$date_time,
				"bank_name"=>($bank_name!='')? $bank_name:" ",
				"bank_account_no"=>($bank_account_no!='')? $bank_account_no:" ",
				"bank_trans_no"=>($bank_trans_no!='')? $bank_trans_no:" ",
				"bank_trans_detail"=>($bank_trans_detail!='')? $bank_trans_detail:" "
			);
			if($bank_tid>0){
				$this->SqlModel->updateRecord(prefix."tbl_bank_transaction",$data,array("bank_tid"=>$bank_tid));
				set_message("success","You have successfully updated bank transaction detail");	
				redirect_page("financial","withdrawals_p",array()); exit;
			}else{
				$this->SqlModel->insertRecord(prefix."tbl_bank_transaction",$data);
				set_message("success","You have successfully added bank transaction detail");	
				redirect_page("financial","withdrawals_p",array()); exit;
			}
		}
		
			if($segment['action_request'] =='confirmWithdraw1'){
		    	$transfer_id = _d($segment['transfer_id']);
		//    PRintR($segment); die;
		     
		//	PrintR($form_data);die;
			if(count($transfer_id)>0){
			
					$AR_TRF = $model->getFundTransfer($transfer_id);
					
				
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
						    
						 //  die; 
						    
						  $member_id  =$AR_TRF['from_member_id'];
$trns_status   =$AR_TRF['trns_status'];
$addresss   =$AR_TRF['trxaddress'];
$trns_amount =  $AR_TRF['trns_amount'];
 $initial_amount =  $AR_TRF['initial_amount'];
       $cryptoname =  $AR_TRF['cryptoname'];
$stacking =  $AR_TRF['stacking'];
$trns_for=  $AR_TRF['trns_for'];
$liquidity =  $AR_TRF['liquidity'];
$memberdetail   = $model->getMemberdetail($member_id);
$member_email      = $memberdetail['member_email'];
$user_id      = $memberdetail['user_id'];
  
   //if($cryptoname=='Dizi Token'){
   $ownerbalance=1234567890; 
  // }
  
   
  
    if($trns_status=='P'){
        

        if(true){ 

    	$data = array(
					    "txid"=>$txid,
						"res_data"=>$res_data,
						"coin_rate"=>0,
						"coins_total"=>0,
						"coins_charge"=>0,
						"coins_trns"=>0,
						"trns_status"=>'C',
						"hashcode"=>$response,
						"status_up_date"=>$trns_date,
							"draw_type"=>"MANUAL_BY_OWNER",
								"remarks"=>$remarks,
					);			
    	
    	
    	
    	$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",$data,array("transfer_id"=>$transfer_id));     
    		
    	
    			    
				set_message("success","Fund request confirmed successfull");		
				redirect_page("financial","withdrawals_p",array());
						    
							
    		

   
        }
 
   
      
   
    
}  
          }    
						    
							}
					}
					
					
			else{
				set_message("warning","Invalid selection, please select transaction 1");		
				redirect_page("financial","withdrawals_p",array());
			}		
			}
		if($form_data['confirmWithdraw']==1 && $this->input->post()!=''){
		//	PrintR($form_data);die;
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'C',"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
								
		//	$model->wallet_transaction($AR_TRF['wallet_id'],"Dr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request approved",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");
							}
					}
				endforeach;
				set_message("success","Fund request confirmed successfull");		
				redirect_page("financial","withdrawals",array());
			}else{
				set_message("warning","Invalid selection, please select transaction 5");		
				redirect_page("financial","withdrawals_p",array());
			}
		}
		if($form_data['rejectWithdraw']==1 && $this->input->post()!=''){
			
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'R',"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
									$model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");							
							}
					}
				endforeach;
				set_message("success","Fund request rejected successfull");		
				redirect_page("financial","withdrawals_p",array());
			}else{
				set_message("warning","Invalid selection, please select transaction 6");		
				redirect_page("financial","withdrawals_p",array());
			}
		}
		$this->load->view(ADMIN_FOLDER.'/financial/withdrawals_pending',$data);
	}
	
	
	public function makewithdrawal()
	{
	
	$model = new OperationModel();
	$form_data = $this->input->post();
	$today_date = getLocalTime();
	$segment = $this->uri->uri_to_assoc(2);
	$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
	$wallet_trns_id = ($form_data['wallet_trns_id'])? $form_data['wallet_trns_id']:$segment['wallet_trns_id'];
		
		$CONFIG_ADMIN_CHARGE = $model->getValue("CONFIG_ADMIN_CHARGE");
		$CONFIG_ADMIN_MOBILE = $model->getValue("CONFIG_ADMIN_MOBILE");
		$CONFIG_ADMIN_EMAIL = $model->getValue("CONFIG_ADMIN_EMAIL");
		
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitTransaction']==1 && $this->input->post()!=''){
// 				 $wallet_id = ($form_data['wallet_id']>0)? $form_data['wallet_id']:0;
				   
// 					$member_id = $model->getMemberId($form_data['user_id']);
					
// 					$processor_id = $model->getDefaultProcessor();
// 					$AR_PRC = $model->getProcessor($processor_id);
					
// 					$withdraw_fee_percent = 0;
// 					$deposit_fee_percent = 0;
// 					$process_fee_percent = 0;
					
// 					$initial_amount = FCrtRplc($form_data['initial_amount']);
				
// 					$trns_type = FCrtRplc($form_data['trns_type']);
// 					$trns_remark = FCrtRplc($form_data['trns_remark']);
// 					$type = FCrtRplc($form_data['type']);
// 					$trns_date = FCrtRplc($form_data['trnsdate']);
// 					$trans_no = FCrtRplc($form_data['trnsno']);
// 					$bank_name  = FCrtRplc($form_data['bank_name']);
					
// 					if($trns_type=="Dr"){
// 						$WITDRAW_FEE = ($initial_amount*$withdraw_fee_percent/100); 
// 					}
// 					if($trns_type=="Cr"){
// 						$DEPOSITE_FEE = ($initial_amount*$deposit_fee_percent/100);
// 					}
// 					$PROCESS_FEE = ($initial_amount*$process_fee_percent/100);
					
// 					$CONFIG_ADMIN_CHARGE_PERCENT =  ($initial_amount*$CONFIG_ADMIN_CHARGE/100); 
// 					$admin_charge = 0;
// 					$total_charge = ($admin_charge+$WITDRAW_FEE+$DEPOSITE_FEE+$PROCESS_FEE);
// 					$trns_amount = ($initial_amount-$total_charge);
					
// 					$from_member_id = 0;
// 					$AR_MAP['wallet_id'] = $wallet_id;
// 					$AR_MAP['from_member_id'] = $from_member_id;
// 					$AR_MAP['to_member_id'] = $member_id;
// 					$AR_MAP['initial_amount'] = $initial_amount;
// 					$AR_MAP['deposit_fee'] = 0;
// 					$AR_MAP['withdraw_fee'] = 0;
// 					$AR_MAP['withdraw_fee'] = $WITDRAW_FEE;
// 					$AR_MAP['deposite_fee'] = $DEPOSITE_FEE;
// 					$AR_MAP['process_fee'] = $PROCESS_FEE;
// 					$AR_MAP['admin_charge'] = $admin_charge;
// 					$AR_MAP['trns_amount'] = $trns_amount;
					
					
// 					$AR_MAP['trns_remark'] = $trns_remark;
// 					$AR_MAP['trns_status'] = "C";
// 					$AR_MAP['status_up_date'] = $today_date;
// 					$AR_MAP['trns_type'] = $trns_type;
// 					$AR_MAP['trns_for'] = ($trns_type=='Cr')? 'Deposit':'Withdrawal';
// 					$AR_MAP['draw_type'] = ($trns_type=='Cr')? 'NA':'MANUAL';
// 					$new_value = json_encode($AR_MAP);
					
// 					if(is_numeric($initial_amount) && $initial_amount>0){
					    
// 					    	$NEW_VAL = json_decode($new_value,true);
					
// 					$wallet_id = FCrtRplc($NEW_VAL['wallet_id']);
// 					$trns_amount = FCrtRplc($NEW_VAL['trns_amount']);
					
// 					$to_member_id = FCrtRplc($NEW_VAL['to_member_id']);
// 					$to_user_id = $model->getMemberUserId($to_member_id);
					
// 					$initial_amount = FCrtRplc($NEW_VAL['initial_amount']);
					
// 					$withdraw_fee = FCrtRplc($NEW_VAL['withdraw_fee']);
// 					$deposite_fee = FCrtRplc($NEW_VAL['deposite_fee']);
// 					$process_fee = FCrtRplc($NEW_VAL['process_fee']);
// 					$admin_charge = FCrtRplc($NEW_VAL['admin_charge']);
					
// 					$trns_remark = strtoupper($NEW_VAL['trns_remark']);
// 					$trns_status = FCrtRplc($NEW_VAL['trns_status']);
// 					$status_up_date = ($NEW_VAL['status_up_date']);
					
// 					$trns_type = ($NEW_VAL['trns_type']);
// 					$trns_for = ($NEW_VAL['trns_for']);
// 					$draw_type = ($NEW_VAL['draw_type']);
					
// 				//	$trans_no = UniqueId("TRNS_NO");
					
// 		$LDGR = $model->getCurrentBalance($to_member_id,$wallet_id);
	
// 						if($to_member_id>0){
						
						
// 						if($trns_amount <= $LDGR['net_balance']){
						
// 							$data = array(
// 							    "wallet_id"=>1,//($wallet_id>0)? $wallet_id:0,
// 								"trans_no"=>$trans_no,
// 								"from_member_id"=>0,
// 								"to_member_id"=>$to_member_id,
// 								"initial_amount"=>$initial_amount,
// 								"withdraw_fee"=>($WITDRAW_FEE)? $WITDRAW_FEE:0,
//                                 "bank_name" =>$bank_name,
// 								"deposit_fee"=>($DEPOSITE_FEE)? $DEPOSITE_FEE:0,
// 								"process_fee"=>($PROCESS_FEE)? $PROCESS_FEE:0,
// 								"admin_charge"=>$admin_charge,
// 								"trns_amount"=>$trns_amount,
// 								"trns_remark"=>$trns_remark,
// 								"trns_type"=>$trns_type,
// 								"type"=>$type,
// 								"trns_for"=>($trns_type=='Cr')? 'Deposit':'WITHDRAW',
// 								"trns_status"=>"P",
// 								"draw_type"=>($trns_type=='Cr')? 'NA':'MANUAL',
// 								"trns_date"=>$trns_date
// 							);
// 							if($wallet_id == '1')
// 							{
// 							// die('ss');   
// 							$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
// 							//$model->wallet_transaction($wallet_id,$trns_type,$to_member_id,$trns_amount,$trns_remark,$today_date,$trans_no,"1","AM");
							
// 							}
// 							else
// 							{ // die('ssa');
// 							$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
// 							//$model->wallet_transaction(1,$trns_type,$to_member_id,$trns_amount,$trns_remark,$today_date,$trans_no,"1","AM");
							   
// 							}
// 							//$model->updateOTPSts($AR_TYPE['request_id']);
// 							set_message("success","You have successfully added  a new  transaction");
// 							redirect_page("financial","makewithdrawal",array("error"=>"success"));	
// 						}
						
// 						else{
// 							set_message("warning","Amount should be less than or equal to current balance !");		
// 							redirect_page("financial","makewithdrawal",array("request_id"=>_e($request_id)));
// 						}
						
// 						}else{
// 							set_message("warning","Invalid member id");		
// 							redirect_page("financial","makewithdrawal",array("request_id"=>_e($request_id)));
// 						}	
					    
					    
					    
					    
					    
						
// 					}else{
// 						set_message("warning","Invalid amount, please enter valid amount");
// 						redirect_page("financial","makewithdrawal","");
// 					}



//PrintR($form_data);die;

 
        $model = new OperationModel();
        //$trns_date = InsertDate(getLocalTime());
            $trns_date = getLocalTime();
        $trns_date =  InsertDate(AddToDate($trns_date,"0 Day")); 
     
        $QR_MEM = "SELECT tm.* FROM ".prefix."tbl_members AS tm   ORDER BY tm.member_id ASC";
		$RS_MSTR  = $this->SqlModel->runQuery($QR_MEM);
		foreach($RS_MSTR as $AR_RES):
		    $member_id = $AR_RES['member_id'];
		    	 
			$bank_name = FCrtRplc($AR_RES['bank_name']);
			$bank_branch = FCrtRplc($AR_RES['bank_address']);
			$bank_city = FCrtRplc($AR_RES['bank_city']);
			$bank_state = FCrtRplc($AR_RES['bank_state']);
			$bank_country = FCrtRplc($AR_RES['bank_country']);
			$ifc_code = FCrtRplc($AR_RES['ifc_code']);
			$pan_no = FCrtRplc($AR_RES['pan_no']);
			$adhar = FCrtRplc($AR_RES['adhar']);
			$account_no = FCrtRplc($AR_RES['account_number']);
		 
			 $ac_holder_name = FCrtRplc($AR_RES['ben_name']);
			$member_mobile = FCrtRplc($AR_RES['member_mobile']);
		  
			 
			   	  	           
		        $err =0;
                $initial_amount =   FCrtRplc($form_data['initial_amount']);  
                $bank_name1 = FCrtRplc($form_data['bank_name']);
                $ac_no = FCrtRplc($form_data['ac_no']);
                $ifsc = FCrtRplc($form_data['ifsc']);
                $pan_no1 = FCrtRplc($form_data['pan_no']);
                $adhaar = FCrtRplc($form_data['adhaar']);
                $mobile = FCrtRplc($form_data['mobile']);
                $wallet_id = FCrtRplc($form_data['wallet_id']);
                $with_date = FCrtRplc($form_data['with_date']);
			if($ac_no =='1') {  if($account_no ==''){ $err =1;}		}	
			if($ifsc =='1') {  if($ifc_code ==''){ $err =1;}		}	
			if($pan_no1 =='1') {  if($pan_no ==''){ $err =1;}		}	
			if($adhaar =='1') {  if($adhar ==''){ $err =1;}		}	
			if($mobile =='1') {  if($member_mobile ==''){ $err =1;}		}	
			if($bank_name1 =='1') {  if($bank_name ==''){ $err =1;}		}		
		    if($ac_holder_name =='1') {  if($ac_holder_name ==''){ $err =1;}		}	
		    	 
		    if($err =='0'){
		    $LDGR = $model->getCurrentBalance($member_id,$wallet_id,'2019-01-01',$with_date);
	    	if($LDGR['net_balance'] >= $initial_amount )
            {
		    $net_amt =   $LDGR['net_balance'];
		 	$trans_no = UniqueId("TRNS_NO");
            $admin_charge = 0;//$net_amt *0/100;
            $trns_amount = $net_amt - $admin_charge;
			
			        		 $data = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$wallet_id,
									"initial_amount"=>$net_amt,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>0,
									"process_fee"=>0,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"NEFT",
									"processor_id"=>0,
									"btc_address"=>" ",
									"pm_account"=>" ",
									"pm_account_type"=>" ",
								    "trns_date"=>	$with_date,
								    "date_time"=>$with_date,
								 
									
									
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>" ",
									"bank_zip_code"=>" ",
									"trns_remark"=>"Withdrawal  Request from ".$AR_MEM['user_id'],
								);
								
                    $userid =$AR_RES['user_id'];
                  $name = $AR_RES['first_name'];
                  $mobile = $AR_RES['member_mobile'];
                   // PrintR($data);
                   $transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
                    $trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
                 $model->wallet_transaction($wallet_id,"Dr",$member_id,$net_amt,$trns_remark,$with_date,$trans_no,"1","WITHDRAW");
                 //   $this->SqlModel->updateRecord(prefix."tbl_cmsn_mstr",array("with_sts"=>"Y"),array("member_id"=>$member_id));
                   // $model->SendOTP($member_id,'Dr',$net_amt);
                   
// $message ="Dear ".$name.", Welcome to http://thwcare.com/, Your Today Withdrawal Amount Is : ".$net_amt." Thank You, \n Regard \n THWCare & Team";
    
		  
// $username="MLMMLM";
// $api_password="12345";
// $sender="THWCRE";
// $domain="sms.vertoindia.com";
// $method="POST";
 

// 	$username=urlencode($username);
// 	$password=urlencode($api_password);
// 	$sender=urlencode($sender);
// 	$message=urlencode($message);

// $parameters="user=$username&pass=$password&sender=$sender&phone=$mobile&text=$message&priority=ndnd&stype=normal";

// 	$url="http://$domain/api/sendmsg.php?";

// 	$ch = curl_init($url);

// 	if($method=="POST")
// 	{
// 		curl_setopt($ch, CURLOPT_POST,1);
// 		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
// 	}
// 	else
// 	{
// 		$get_url=$url."?".$parameters;

// 		curl_setopt($ch, CURLOPT_POST,0);
// 		curl_setopt($ch, CURLOPT_URL, $get_url);
// 	}

// 	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
// 	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
// 	$return_val = curl_exec($ch);
            }
		    }
		endforeach;
		
			set_message("success","You have successfully added   ");
 			redirect_page("financial","makewithdrawal",array("error"=>"success"));	
        	
  
				}
				
			break;
			case "DELETE":
				if($wallet_trns_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_fund_transfer",array("transfer_id"=>$transfer_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("financial","makewithdrawal",array()); exit;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/financial/makewithdrawal',$data);
	
	}
	
	
	public function addtransactionprogress(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = getLocalTime();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$wallet_trns_id = ($form_data['wallet_trns_id'])? $form_data['wallet_trns_id']:$segment['wallet_trns_id'];
		
		$CONFIG_ADMIN_CHARGE = $model->getValue("CONFIG_ADMIN_CHARGE");
		$CONFIG_ADMIN_MOBILE = $model->getValue("CONFIG_ADMIN_MOBILE");
		$CONFIG_ADMIN_EMAIL = $model->getValue("CONFIG_ADMIN_EMAIL");
		
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitTransaction']==1 && $this->input->post()!=''){
					$wallet_id = ($form_data['wallet_id']>0)? $form_data['wallet_id']:0;
					$member_id = $model->getMemberId($form_data['user_id']);
					
					$processor_id = $model->getDefaultProcessor();
					$AR_PRC = $model->getProcessor($processor_id);
					
					$withdraw_fee_percent = 0;
					$deposit_fee_percent = 0;
					$process_fee_percent = 0;
					
					$initial_amount = FCrtRplc($form_data['initial_amount']);
					$trns_remark = FCrtRplc($form_data['trns_remark']);
					$trns_type = FCrtRplc($form_data['trns_type']);
					$trns_date = InsertDate($today_date);
					$trans_no = UniqueId("TRNS_NO");
					
					if($trns_type=="Dr"){
						$WITDRAW_FEE = ($initial_amount*$withdraw_fee_percent/100); 
					}
					if($trns_type=="Cr"){
						$DEPOSITE_FEE = ($initial_amount*$deposit_fee_percent/100);
					}
					$PROCESS_FEE = ($initial_amount*$process_fee_percent/100);
					
					$CONFIG_ADMIN_CHARGE_PERCENT =  ($initial_amount*$CONFIG_ADMIN_CHARGE/100); 
					$admin_charge = 0;
					$total_charge = ($admin_charge+$WITDRAW_FEE+$DEPOSITE_FEE+$PROCESS_FEE);
					$trns_amount = ($initial_amount-$total_charge);
					
					$from_member_id = 0;
					$AR_MAP['wallet_id'] = $wallet_id;
					$AR_MAP['from_member_id'] = $from_member_id;
					$AR_MAP['to_member_id'] = $member_id;
					$AR_MAP['initial_amount'] = $initial_amount;
					$AR_MAP['deposit_fee'] = 0;
					$AR_MAP['withdraw_fee'] = 0;
					$AR_MAP['withdraw_fee'] = $WITDRAW_FEE;
					$AR_MAP['deposite_fee'] = $DEPOSITE_FEE;
					$AR_MAP['process_fee'] = $PROCESS_FEE;
					$AR_MAP['admin_charge'] = $admin_charge;
					$AR_MAP['trns_amount'] = $trns_amount;
					
					
					$AR_MAP['trns_remark'] = $trns_remark;
					$AR_MAP['trns_status'] = "C";
					$AR_MAP['status_up_date'] = $today_date;
					$AR_MAP['trns_type'] = $trns_type;
					$AR_MAP['trns_for'] = ($trns_type=='Cr')? 'Deposit':'Withdrawal';
					$AR_MAP['draw_type'] = ($trns_type=='Cr')? 'NA':'MANUAL';
					$new_value = json_encode($AR_MAP);
					
					if(is_numeric($initial_amount) && $initial_amount>0){
						if($member_id>0){
							$sms_otp = $model->sendFundtransferRequestSMSAdmin($CONFIG_ADMIN_MOBILE,$CONFIG_ADMIN_EMAIL,$initial_amount);
							$data = array("member_id"=>0,
								"new_value"=>$new_value,
								"sms_otp"=>$sms_otp,
								"sms_type"=>"ADMINTRANSFER",
								"mobile_number"=>$CONFIG_ADMIN_MOBILE
							);
							$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
							set_message("success","Please verify OTP from your registered email address");
							redirect_page("financial","addtransactionprogress",array("request_id"=>_e($request_id)));
						}else{
							set_message("warning","Invalid member user, please enter valid username");
							redirect_page("financial","addtransactionprogress","");
						}
					}else{
						set_message("warning","Invalid amount, please enter valid amount");
						redirect_page("financial","addtransactionprogress","");
					}					
				}
				if($form_data['verifyOTPAdmin']!='' && $this->input->post()!=''){
				
					$request_id = _d($form_data['request_id']);
					$sms_otp = FCrtRplc($form_data['sms_otp']);
					$AR_TYPE = $model->verifySMSOTP($request_id,$sms_otp);
					
					$NEW_VAL = json_decode($AR_TYPE['new_value'],true);
					
					$wallet_id = FCrtRplc($NEW_VAL['wallet_id']);
					$trns_amount = FCrtRplc($NEW_VAL['trns_amount']);
					
					$to_member_id = FCrtRplc($NEW_VAL['to_member_id']);
					$to_user_id = $model->getMemberUserId($to_member_id);
					
					$initial_amount = FCrtRplc($NEW_VAL['initial_amount']);
					
					$withdraw_fee = FCrtRplc($NEW_VAL['withdraw_fee']);
					$deposite_fee = FCrtRplc($NEW_VAL['deposite_fee']);
					$process_fee = FCrtRplc($NEW_VAL['process_fee']);
					$admin_charge = FCrtRplc($NEW_VAL['admin_charge']);
					
					$trns_remark = strtoupper($NEW_VAL['trns_remark']);
					$trns_status = FCrtRplc($NEW_VAL['trns_status']);
					$status_up_date = ($NEW_VAL['status_up_date']);
					
					$trns_type = ($NEW_VAL['trns_type']);
					$trns_for = ($NEW_VAL['trns_for']);
					$draw_type = ($NEW_VAL['draw_type']);
					
					$trans_no = UniqueId("TRNS_NO");
					
					if($AR_TYPE['request_id']>0){
						if($to_member_id>0){
							$data = array("wallet_id"=>($wallet_id>0)? $wallet_id:0,
								"trans_no"=>$trans_no,
								"from_member_id"=>0,
								"to_member_id"=>$to_member_id,
								"initial_amount"=>$initial_amount,
								"withdraw_fee"=>($WITDRAW_FEE)? $WITDRAW_FEE:0,
								"deposit_fee"=>($DEPOSITE_FEE)? $DEPOSITE_FEE:0,
								"process_fee"=>($PROCESS_FEE)? $PROCESS_FEE:0,
								"admin_charge"=>$admin_charge,
								"trns_amount"=>$trns_amount,
								"trns_remark"=>$trns_remark,
								"trns_type"=>$trns_type,
								"trns_for"=>($trns_type=='Cr')? 'Deposit':'Withdrawal',
								"trns_status"=>"C",
								"draw_type"=>($trns_type=='Cr')? 'NA':'MANUAL',
								"trns_date"=>$today_date
							);
							$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
		$model->wallet_transaction($wallet_id,$trns_type,$to_member_id,$trns_amount,$trns_remark,$today_date,$trans_no,"1","AM");
							$model->updateOTPSts($AR_TYPE['request_id']);
							set_message("success","You have successfully added  a new  transaction");
							redirect_page("financial","addtransactionprogress",array("error"=>"success"));	
						}else{
							set_message("warning","Invalid member id");		
							redirect_page("financial","addtransactionprogress",array("request_id"=>_e($request_id)));
						}	
					}else{
						set_message("warning","Invalid OTP, please enter valid OTP");
						redirect_page("financial","addtransactionprogress",array("request_id"=>_e($request_id)));
					}
				}
			break;
			case "DELETE":
				if($wallet_trns_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_fund_transfer",array("transfer_id"=>$transfer_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("financial","addtransactionprogress",array()); exit;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/financial/addtransactionprogress',$data);
	}
	
	
	public function viewtransactionsprogress(){
		$this->load->view(ADMIN_FOLDER.'/financial/viewtransactionsprogress',$data);
	}
	
	public function withdrawalprogress(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		if($form_data['submitBankTransaction']==1 && $this->input->post()!=''){
			$transfer_id = _d($form_data['transfer_id']);
			$bank_tid = FCrtRplc($form_data['bank_tid']);
			$date_time = InsertDate($form_data['date_time']);
			$bank_trans_no = FCrtRplc($form_data['bank_trans_no']);
			$bank_trans_detail = FCrtRplc($form_data['bank_trans_detail']);
			
			$bank_name = FCrtRplc($form_data['bank_name']);
			$bank_account_no = FCrtRplc($form_data['bank_account_no']);
			
			$data = array("transfer_id"=>$transfer_id,
				"date_time"=>$date_time,
				"bank_name"=>($bank_name!='')? $bank_name:" ",
				"bank_account_no"=>($bank_account_no!='')? $bank_account_no:" ",
				"bank_trans_no"=>($bank_trans_no!='')? $bank_trans_no:" ",
				"bank_trans_detail"=>($bank_trans_detail!='')? $bank_trans_detail:" "
			);
			if($bank_tid>0){
				$this->SqlModel->updateRecord(prefix."tbl_bank_transaction",$data,array("bank_tid"=>$bank_tid));
				set_message("success","You have successfully updated bank transaction detail");	
				redirect_page("financial","withdrawalprogress",array()); exit;
			}else{
				$this->SqlModel->insertRecord(prefix."tbl_bank_transaction",$data);
				set_message("success","You have successfully added bank transaction detail");	
				redirect_page("financial","withdrawalprogress",array()); exit;
			}
		}
		
		if($form_data['confirmWithdraw']==1 && $this->input->post()!=''){
			
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'C',"status_up_date"=>$today_date),
								array("transfer_id"=>$transfer_id));
							}
					}
				endforeach;
				set_message("success","Fund transaction confirmed successfull");		
				redirect_page("financial","withdrawalprogress",array());
			}else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("financial","withdrawalprogress",array());
			}
		}
		if($form_data['rejectWithdraw']==1 && $this->input->post()!=''){
			
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'R',"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
									$model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");							
							}
					}
				endforeach;
				set_message("success","Fund transaction confirmed successfull");		
				redirect_page("financial","withdrawalprogress",array());
			}else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("financial","withdrawalprogress",array());
			}
		}
		
		$this->load->view(ADMIN_FOLDER.'/financial/withdrawalprogress',$data);
	}
	
	public function addtransactionsignup(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$today_date = getLocalTime();
		$segment = $this->uri->uri_to_assoc(2);
		$action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
		$wallet_trns_id = ($form_data['wallet_trns_id'])? $form_data['wallet_trns_id']:$segment['wallet_trns_id'];
		
		$CONFIG_ADMIN_CHARGE = $model->getValue("CONFIG_ADMIN_CHARGE");
		$CONFIG_ADMIN_MOBILE = $model->getValue("CONFIG_ADMIN_MOBILE");
		$CONFIG_ADMIN_EMAIL = $model->getValue("CONFIG_ADMIN_EMAIL");
		
		switch($action_request){
			case "ADD_UPDATE":
				if($form_data['submitTransaction']==1 && $this->input->post()!=''){
					$wallet_id = ($form_data['wallet_id']>0)? $form_data['wallet_id']:0;
					$member_id = $model->getMemberId($form_data['user_id']);
					
					$processor_id = $model->getDefaultProcessor();
					$AR_PRC = $model->getProcessor($processor_id);
					
					$withdraw_fee_percent = 0;
					$deposit_fee_percent = 0;
					$process_fee_percent = 0;
					
					$initial_amount = FCrtRplc($form_data['initial_amount']);
					$trns_remark = FCrtRplc($form_data['trns_remark']);
					$trns_type = FCrtRplc($form_data['trns_type']);
					$trns_date = InsertDate($today_date);
					$trans_no = UniqueId("TRNS_NO");
					
					if($trns_type=="Dr"){
						$WITDRAW_FEE = ($initial_amount*$withdraw_fee_percent/100); 
					}
					if($trns_type=="Cr"){
						$DEPOSITE_FEE = ($initial_amount*$deposit_fee_percent/100);
					}
					$PROCESS_FEE = ($initial_amount*$process_fee_percent/100);
					
					$CONFIG_ADMIN_CHARGE_PERCENT =  ($initial_amount*$CONFIG_ADMIN_CHARGE/100); 
					$admin_charge = 0;
					$total_charge = ($admin_charge+$WITDRAW_FEE+$DEPOSITE_FEE+$PROCESS_FEE);
					$trns_amount = ($initial_amount-$total_charge);
					
					$from_member_id = 0;
					$AR_MAP['wallet_id'] = $wallet_id;
					$AR_MAP['from_member_id'] = $from_member_id;
					$AR_MAP['to_member_id'] = $member_id;
					$AR_MAP['initial_amount'] = $initial_amount;
					$AR_MAP['deposit_fee'] = 0;
					$AR_MAP['withdraw_fee'] = 0;
					$AR_MAP['withdraw_fee'] = $WITDRAW_FEE;
					$AR_MAP['deposite_fee'] = $DEPOSITE_FEE;
					$AR_MAP['process_fee'] = $PROCESS_FEE;
					$AR_MAP['admin_charge'] = $admin_charge;
					$AR_MAP['trns_amount'] = $trns_amount;
					
					
					$AR_MAP['trns_remark'] = $trns_remark;
					$AR_MAP['trns_status'] = "C";
					$AR_MAP['status_up_date'] = $today_date;
					$AR_MAP['trns_type'] = $trns_type;
					$AR_MAP['trns_for'] = ($trns_type=='Cr')? 'Deposit':'Withdrawal';
					$AR_MAP['draw_type'] = ($trns_type=='Cr')? 'NA':'MANUAL';
					$new_value = json_encode($AR_MAP);
					
					if(is_numeric($initial_amount) && $initial_amount>0){
						if($member_id>0){
							$sms_otp = $model->sendFundtransferRequestSMSAdmin($CONFIG_ADMIN_MOBILE,$CONFIG_ADMIN_EMAIL,$initial_amount);
							$data = array("member_id"=>0,
								"new_value"=>$new_value,
								"sms_otp"=>$sms_otp,
								"sms_type"=>"ADMINTRANSFER",
								"mobile_number"=>$CONFIG_ADMIN_MOBILE
							);
							$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
							set_message("success","Please verify OTP from your registered email address");
							redirect_page("financial","addtransactionsignup",array("request_id"=>_e($request_id)));
						}else{
							set_message("warning","Invalid member user, please enter valid username");
							redirect_page("financial","addtransactionsignup","");
						}
					}else{
						set_message("warning","Invalid amount, please enter valid amount");
						redirect_page("financial","addtransactionsignup","");
					}					
				}
				if($form_data['verifyOTPAdmin']!='' && $this->input->post()!=''){
				
					$request_id = _d($form_data['request_id']);
					$sms_otp = FCrtRplc($form_data['sms_otp']);
					$AR_TYPE = $model->verifySMSOTP($request_id,$sms_otp);
					
					$NEW_VAL = json_decode($AR_TYPE['new_value'],true);
					
					$wallet_id = FCrtRplc($NEW_VAL['wallet_id']);
					$trns_amount = FCrtRplc($NEW_VAL['trns_amount']);
					
					$to_member_id = FCrtRplc($NEW_VAL['to_member_id']);
					$to_user_id = $model->getMemberUserId($to_member_id);
					
					$initial_amount = FCrtRplc($NEW_VAL['initial_amount']);
					
					$withdraw_fee = FCrtRplc($NEW_VAL['withdraw_fee']);
					$deposite_fee = FCrtRplc($NEW_VAL['deposite_fee']);
					$process_fee = FCrtRplc($NEW_VAL['process_fee']);
					$admin_charge = FCrtRplc($NEW_VAL['admin_charge']);
					
					$trns_remark = strtoupper($NEW_VAL['trns_remark']);
					$trns_status = FCrtRplc($NEW_VAL['trns_status']);
					$status_up_date = ($NEW_VAL['status_up_date']);
					
					$trns_type = ($NEW_VAL['trns_type']);
					$trns_for = ($NEW_VAL['trns_for']);
					$draw_type = ($NEW_VAL['draw_type']);
					
					$trans_no = UniqueId("TRNS_NO");
					
					if($AR_TYPE['request_id']>0){
						if($to_member_id>0){
							$data = array("wallet_id"=>($wallet_id>0)? $wallet_id:0,
								"trans_no"=>$trans_no,
								"from_member_id"=>0,
								"to_member_id"=>$to_member_id,
								"initial_amount"=>$initial_amount,
								"withdraw_fee"=>($WITDRAW_FEE)? $WITDRAW_FEE:0,
								"deposit_fee"=>($DEPOSITE_FEE)? $DEPOSITE_FEE:0,
								"process_fee"=>($PROCESS_FEE)? $PROCESS_FEE:0,
								"admin_charge"=>$admin_charge,
								"trns_amount"=>$trns_amount,
								"trns_remark"=>$trns_remark,
								"trns_type"=>$trns_type,
								"trns_for"=>($trns_type=='Cr')? 'Deposit':'Withdrawal',
								"trns_status"=>"C",
								"draw_type"=>($trns_type=='Cr')? 'NA':'MANUAL',
								"trns_date"=>$today_date
							);
							$this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
							$model->wallet_transaction($wallet_id,$trns_type,$to_member_id,$trns_amount,$trns_remark,$today_date,$trans_no,"1","AM");
							$model->updateOTPSts($AR_TYPE['request_id']);
							set_message("success","You have successfully added  a new  transaction");
							redirect_page("financial","addtransactionsignup",array("error"=>"success"));	
						}else{
							set_message("warning","Invalid member id");		
							redirect_page("financial","addtransactionsignup",array("request_id"=>_e($request_id)));
						}	
					}else{
						set_message("warning","Invalid OTP, please enter valid OTP");
						redirect_page("financial","addtransactionsignup",array("request_id"=>_e($request_id)));
					}
				}
			break;
			case "DELETE":
				if($wallet_trns_id>0){
					$this->SqlModel->deleteRecord(prefix."tbl_fund_transfer",array("transfer_id"=>$transfer_id));
					set_message("success","You have successfully deleted record");	
				}
				redirect_page("financial","addtransactionsignup",array()); exit;
			break;
		}
		$this->load->view(ADMIN_FOLDER.'/financial/addtransactionsignup',$data);
	}
	
	
	public function viewtransactionssignup(){
		$this->load->view(ADMIN_FOLDER.'/financial/viewtransactionssignup',$data);
	}
	
	public function withdrawalsignup(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		if($form_data['submitBankTransaction']==1 && $this->input->post()!=''){
			$transfer_id = _d($form_data['transfer_id']);
			$bank_tid = FCrtRplc($form_data['bank_tid']);
			$date_time = InsertDate($form_data['date_time']);
			$bank_trans_no = FCrtRplc($form_data['bank_trans_no']);
			$bank_trans_detail = FCrtRplc($form_data['bank_trans_detail']);
			
			$bank_name = FCrtRplc($form_data['bank_name']);
			$bank_account_no = FCrtRplc($form_data['bank_account_no']);
			
			$data = array("transfer_id"=>$transfer_id,
				"date_time"=>$date_time,
				"bank_name"=>($bank_name!='')? $bank_name:" ",
				"bank_account_no"=>($bank_account_no!='')? $bank_account_no:" ",
				"bank_trans_no"=>($bank_trans_no!='')? $bank_trans_no:" ",
				"bank_trans_detail"=>($bank_trans_detail!='')? $bank_trans_detail:" "
			);
			if($bank_tid>0){
				$this->SqlModel->updateRecord(prefix."tbl_bank_transaction",$data,array("bank_tid"=>$bank_tid));
				set_message("success","You have successfully updated bank transaction detail");	
				redirect_page("financial","withdrawalsignup",array()); exit;
			}else{
				$this->SqlModel->insertRecord(prefix."tbl_bank_transaction",$data);
				set_message("success","You have successfully added bank transaction detail");	
				redirect_page("financial","withdrawalsignup",array()); exit;
			}
		}
		
		if($form_data['confirmWithdraw']==1 && $this->input->post()!=''){
			
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'C',"status_up_date"=>$today_date),
								array("transfer_id"=>$transfer_id));
							}
					}
				endforeach;
				set_message("success","Fund transaction confirmed successfull");		
				redirect_page("financial","withdrawalsignup",array());
			}else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("financial","withdrawalsignup",array());
			}
		}
		if($form_data['rejectWithdraw']==1 && $this->input->post()!=''){
			
			$trns_status_array = array_unique(array_filter($form_data['trns_status']));
			if(count($trns_status_array)>0){
				foreach($trns_status_array as $key=>$transfer_id):
					$AR_TRF = $model->getFundTransfer($transfer_id);
					$AR_MEM = $model->getMember($AR_TRF['to_member_id']);
					if($AR_TRF['trns_status']=='P'){
						if($AR_TRF['trns_amount']>0){
								$this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>'R',"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
									$model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");							
							}
					}
				endforeach;
				set_message("success","Fund transaction confirmed successfull");		
				redirect_page("financial","withdrawalsignup",array());
			}else{
				set_message("warning","Invalid selection, please select transaction");		
				redirect_page("financial","withdrawalsignup",array());
			}
		}
		$this->load->view(ADMIN_FOLDER.'/financial/withdrawalsignup',$data);
	}
	
	
	
	
	public function transactions(){
		$this->load->view(ADMIN_FOLDER.'/financial/transactions',$data);
	}
	
	public function tradingtransactions(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(ADMIN_FOLDER.'/financial/tradingtransactions',$data);
	}
	
	public function investincome(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(ADMIN_FOLDER.'/financial/investincome',$data);
	}
	
	
	public function fundrequest(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		
	
		$today_date = getLocalTime();
		$request_id = (_d($form_data['request_id']))? _d($form_data['request_id']):0;
		  $trns_status = _d($form_data['status']);
		  
		  	  $rejectremarks = $form_data['rejectremarks'];
		$CONFIG_ADMIN_CHARGE = $model->getValue("CONFIG_ADMIN_CHARGE");
		$CONFIG_ADMIN_MOBILE = $model->getValue("CONFIG_ADMIN_MOBILE");
		$CONFIG_ADMIN_EMAIL = $model->getValue("CONFIG_ADMIN_EMAIL");
	//	 PrintR($form_data); die;
	
		
	if($form_data['submitTransaction']==1 && $this->input->post()!=''){
	  //  PrintR($form_data); die;
	    $trns_date = InsertDate($today_date);
            $AR_TRF = $model->getFundRequest($request_id);
          
            $AR_MEM = $model->getMember($AR_TRF['member_id']);
            if($AR_TRF['request_amount']>0){
              if($AR_TRF['request_id']>0 && $AR_MEM['member_id']>0){
                $this->SqlModel->updateRecord(prefix."tbl_fund_request",array("status"=>$trns_status,"rejectremarks"=>$rejectremarks),array("request_id"=>$request_id));
              //  $model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");             
                set_message("success","Fund transfer rejected succesfully");    
                redirect_page("financial","fundrequest",array());
              }else{
                set_message("warning","Tranaction failed , please try again");    
                redirect_page("financial","fundrequest",array()); 
              }
            }else{
              set_message("warning","Unable to process your request");    
              redirect_page("financial","fundrequest",array());
            } 
	    
	    
	}
		$this->load->view(ADMIN_FOLDER.'/financial/fundrequest',$data);
	}
	
	public function getbalance()
	{
	$model = new OperationModel();
	$userId = $this->input->post('userId');
	$member_id = $model->getMemberId($userId);
	if($member_id>0){
	$LDGR = $model->getCurrentBalance($member_id,'1');
	
						
						
						
						echo number_format($LDGR['net_balance'],2);
						
	}
	else
	{
	echo "Invalid User Id !";
	}
	}
}
?>