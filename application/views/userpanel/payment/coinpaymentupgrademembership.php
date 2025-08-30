<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$member_id = $this->session->userdata('mem_id');
	$AR_MEM = $model->getMember($member_id);
	$trns_type = "DEPOSIT";
	$deposit_amount = $POST['deposit_amount'];
	$type_id = $POST['type_id'];
	$PAYEE_NAME = $model->getValue("CONFIG_COMPANY_NAME");

	if(!$this->session->userdata('order_no')){
		$order_no = UniqueId("ORDER_NO");
		$this->session->set_userdata('order_no',$order_no);
		$model->setMemberCoinPayment($member_id,$deposit_amount,$order_no,$trns_type,"");
	}else{
		$order_no = $this->session->userdata('order_no');
	}
		
	if(!is_numeric($deposit_amount) && !isset($member_id)){
		echo "Unable to load please enter valid  amount"; exit; 
	}
	$custom = $member_id."-".$order_no."-".$deposit_amount."-".$type_id;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> Coin Payment </title>
<link href="<?php echo BASE_PATH; ?>memassets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>theme/bitcoin/style.css" type="text/css" />
<link href="<?php echo BASE_PATH; ?>memassets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo BASE_PATH; ?>jquery/jquery-1.11.1.js"></script>
</head>
<body>
	<div class="container">
    	<div class="row">
        	<div class="col-md-12">
			<p>&nbsp;</p>
			<p class="errortxt" align="center">Please do not refresh this page, we are connecting to  payment gateway...., <br /></p>
			<div align="center"><img src="<?php echo BASE_PATH; ?>assets/setupimages/loading75.gif"/></div>

			<form action="https://www.coinpayments.net/index.php" id="coinPayment" name="coinPayment" method="POST">
					<input name="cmd" value="_pay" type="hidden">
					<input name="reset" value="1" type="hidden">
					<input name="merchant" value="01b2961361a5b5f9048e76fdea33d52a" type="hidden">
					
					<input name="currency" value="USD" type="hidden">
					<input name="custom" value="<?php echo $custom; ?>" type="hidden">
					<input name="amountf" value="<?php echo $deposit_amount; ?>" type="hidden">
					<input name="first_name" value="<?php echo $AR_MEM['first_name']; ?>" type="hidden">
					<input name="last_name" value="<?php echo $AR_MEM['last_name']; ?>" type="hidden">
					<input name="address1" value="<?php echo $AR_MEM['current_address']; ?>" type="hidden">
					<input name="address2" value="<?php echo $AR_MEM['city_name']; ?>" type="hidden">		<input name="city" value="Thane" type="hidden">
						<input name="state" value="<?php echo $AR_MEM['state_name']; ?>" type="hidden">
					<input name="zip" value="<?php echo $AR_MEM['pin_code']; ?>" type="hidden">
					<input name="email" value="<?php echo $AR_MEM['member_email']; ?>" type="hidden">
					<input name="item_name" value="deposite" type="hidden">
					<input name="ipn_url" value="<?php echo generateSeoUrl("cronjob","coinpaymentupgrade",""); ?>/coinpaymentupgrade.php" type="hidden">
					<input name="success_url" value="<?php echo generateSeoUrlMember("payment","coinpaymentupgrade",""); ?>" type="hidden">
					<input name="cancel_url" value="<?php echo generateSeoUrlMember("payment","coinpaymentfailed",""); ?>" type="hidden">
					<input name="want_shipping" value="0" type="hidden">
					<!--<input type="submit" name="submit" value="Go" />-->
			</form>	
				
            </div>
        </div>
    </div> 
</body>
<script language="javascript" type="text/javascript">
	window.onload=function() {
		//window.document.coinPayment.submit();
	}
</script>
</html>
