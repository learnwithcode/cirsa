<?php

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();


$ORDER_ID = $_POST["ORDER_ID"];
$contact = $_POST["mob"]; 
$name = $_POST["name"]; 
$TXN_AMOUNT = $_POST["TXN_AMOUNT"] *75;
$UID = $_POST["uid"];
 
 
// echo "<pre>";print_r($_POST);die;
$_SESSION['uid'] = $UID;
$_SESSION['ORDER_ID'] = $ORDER_ID;
$_SESSION['mob'] = $contact;
$_SESSION['name'] = $name;
$_SESSION['TXN_AMOUNT'] = $TXN_AMOUNT ;
if($UID =='' or $TXN_AMOUNT =='')
{
    ?>
    <script>
         location.href='https://asianglob.com/soft/member/razorpay/response' ;
    </script>
    <?php 
}
// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//

$charge  = $TXN_AMOUNT*3.54/100;
$gst = $charge *0/100;
$pay = $charge+$gst+$TXN_AMOUNT;
$orderData = [
    'receipt'         => 3456,
      
    'amount'          => $pay * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'manual';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}



$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $name,
    "description"       => "Recharge Wallet",
    "image"             => "https://asianglob.com/soft/assets/images/green1.png",//"https://vertoindiapay.com/razorpay.png",
    "prefill"           => [
    "name"              => $name,
    "email"             => "customer@merchant.com",
    "contact"           => $contact,
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => $ORDER_ID,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/{$checkout}.php");
