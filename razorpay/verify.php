<?php

require('config.php');

session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;
 
$error = "Payment Failed";
//echo "<pre>";print_r($_SESSION);
if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $STATUS =true;
    
  
}
else
{
     $STATUS =false;
}
 ?>
 
 
  	<form method="post" action="https://asianglob.com/soft/member/razorpay/response" name="f1">
		 <input type="hidden" name="ORDERID" value="<?php echo  $_SESSION['ORDER_ID'];?>"> 
		 <input type="hidden" name="razorpay_payment_id" value="<?php echo $_POST['razorpay_payment_id'];?>"> 
		 <input type="hidden" name="razorpay_signature" value="<?php echo $_POST['razorpay_signature'];?>"> 
		 <input type="hidden" name="TXNAMOUNT" value="<?php echo $_SESSION['TXN_AMOUNT'];?>"> 
		 
		 <input type="hidden" name="STATUS" value="<?php echo $STATUS;?>"> 
 
		 <input type="hidden" name="razorpay_order_id" value="<?php echo $_SESSION['razorpay_order_id'];?>"> 
		 
		 <input type="hidden" name="TYPE" value="RETURN"> 
		 
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>