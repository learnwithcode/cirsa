<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$member_id = $this->session->userdata('mem_id');
	$trns_type = "DONATE";
	$AR_PROC = $this->OperationModel->getProcessor("2");
	$deposit_amount = $POST['deposit_amount'];
	$TRNSTYPE = $POST['trns_remark'];
	$PAYEE_NAME = $model->getValue("CONFIG_COMPANY_NAME");

	if(!$this->session->userdata('order_no')){
		$order_no = UniqueId("ORDER_NO");
		$this->session->set_userdata('order_no',$order_no);
		$model->setMemberPerfectMoney($member_id,$deposit_amount,$order_no,$trns_type);
	}else{
		$order_no = $this->session->userdata('order_no');
	}
		
	if(!is_numeric($deposit_amount) && !isset($member_id)){
		echo "Unable to load please enter valid  amount"; exit; 
	}
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
        	<div class="col-md-12">
			<p>&nbsp;</p>
			<p class="errortxt" align="center">Please do not refresh this page, we are connecting to  payment gateway...., <br /></p>
			<div align="center"><img src="<?php echo BASE_PATH; ?>theme/img/loading75.gif"/></div>

			<form action="https://perfectmoney.is/api/step1.asp" id="perfectMoney" name="perfectMoney" method="POST">
			<input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $AR_PROC['account_id']; ?>">
			<input type="hidden" name="PAYEE_NAME" value="<?php echo $PAYEE_NAME; ?>">
			<input type="hidden" name="PAYMENT_ID" value="<?php echo $order_no; ?>">
			<input type="hidden" name="PAYMENT_AMOUNT" value="<?php echo $deposit_amount; ?>">
			<input type="hidden" name="PAYMENT_UNITS" value="USD">
			<input type="hidden" name="STATUS_URL" value="">
			<input type="hidden" name="PAYMENT_URL" value="<?php echo generateMemberForm("payment","perfectconfirmdonate",""); ?>">
			<input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
			<input type="hidden" name="NOPAYMENT_URL" value="<?php echo generateMemberForm("payment","perfectfailed",""); ?>">
			<input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
			<input type="hidden" name="SUGGESTED_MEMO" value="">
			
			<input type="hidden" name="MEMID" value="<?php echo _e($member_id); ?>">
			<input type="hidden" name="TRNSTYPE" value="<?php echo $TRNSTYPE; ?>">
			<input type="hidden" name="BAGGAGE_FIELDS" value="MEMID TRNSTYPE">
			<!--<input type="submit" name="PAYMENT_METHOD" value="Pay Now!">-->
			</form>
				
            </div>
        </div>
    </div> 
</body>
<script language="javascript" type="text/javascript">
	window.onload=function() {
		window.document.perfectMoney.submit();
	}
</script>
</html>
