<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$model = new OperationModel();
$form_data = $this->input->post();
$segment = $this->uri->uri_to_assoc(2);
$binary_rate = $model->getValue("CONFIG_BINARY_INCOME");
$member_id = $this->session->userdata('mem_id');
$request_id = _d($segment['request_id']);
$AR_PRSS = $model->getProcess();
$process_id = $AR_PRSS['process_id'];


$LD_CSH = $model->getCurrentBalance($member_id,$model->getWallet(WALLET1),"","");

$rate_of_interest = $model->getSumDailyReturn($member_id,"","");

$total_withdrawal = $model->getMemberWithdrawal($member_id);
$left_collection = $model->BinaryCount($member_id,"LeftPoint");
$right_collection = $model->BinaryCount($member_id,"RightPoint");
$total_collection = $left_collection+$right_collection;



$AR_OLD = $model->getOldBinary($process_id,$member_id);		

$start_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['start_date']:"";
$end_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['end_date']:"";

$preLcrf = $AR_OLD['leftCrf'];
$preRcrf = $AR_OLD['rightCrf'];
	
$newLft = $model->getMemberCollection($member_id,"L",$start_date,$end_date);
$newRgt = $model->getMemberCollection($member_id,"R",$start_date,$end_date);



$totalLft = $preLcrf+$newLft;
$totalRgt = $preRcrf+$newRgt;
$pair_match = min($totalLft,$totalRgt);


$last_week_cmsn = $model->getLastBinaryCmsn($member_id);
$current_cmsn = ($pair_match*$binary_rate/100);
$old_cmsn = $model->getTotalBinaryCmsn($member_id);


$direct_cmsn = $model->getTotalDirectCmsn($member_id);

$left_count = $model->BinaryCount($member_id,"LeftCount");
$right_count = $model->BinaryCount($member_id,"RightCount");
$total_count = ($left_count+$right_count);
$direct_count = $model->BinaryCount($member_id,"DirectCount");

$today_date = InsertDate(getLocalTime());
$AR_DATE = $model->getCycleNo();
$end_date = $AR_PRSS['end_date'];
$week_date = InsertDate(AddToDate($end_date,"+1 Week"));
$today_joining = $model->getMemberJoining($member_id,$today_date,$today_date);
$week_joining = $model->getMemberJoining($member_id,$today_date,$week_date);

$AR_SHIP = $model->getCurrentMemberShip($member_id);


$stock_market = get_web_page("https://bitpay.com/api/rates");
$AR_STOCK = json_decode($stock_market,true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<style type="text/css">
	span.title {
		display: block;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
		font-weight: 600;
		font-size: 12px;
		color: #fff;
		letter-spacing: 12px;
		padding-left: 10px;
	}
</style>
<link href="<?php echo BASE_PATH;?>memassets/css/kyc.css" rel="stylesheet" type="text/css">


</head>
<body>
<div class="site-holder">
  <!-- .navbar -->
  <?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
  <!-- /.navbar -->
  <div class="box-holder">
    <!-- .left-sidebar -->
    <?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    <!-- /.left-sidebar -->
    <!-- .content -->
    <div class="content">
      <div class="row">
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>">Home</a></li>
            <li class="active">DashBoard</li>
          </ul>
        </div>
      </div>
     
	  <div class="row">
	  <div class="panel-body">

                <div class="callout callout-warning">
                    <h4>Dear Customer, Please submit your Bank Details</h4>
                </div>

    <div class="kyc-documentation">

        
	   <div id="addressproof-box">
            <h3 class="kyc-heading">Your Bank <span class="text-aqua">Details</span></h3>
            <div class="kyc-icon">
                <img src="<?php echo BASE_PATH;?>memassets/images/kyc-passbook-cion.png" />
            </div>
            <div class="kycstrip clearfix">

                <div class="alertmassagebox">
                    <div class="row">
                        <div class="col-md-12">
                                                    </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="imgarea">
                      <?php     if ($ROW['bank_file'] !='') {?>
				 	<img id="readURLbank" src="<?php echo BASE_PATH;?>upload/member_id/<?php echo $ROW['bank_file'];?>" alt="your image" style="width:118px;height:134px;padding:13px;"/>	
 <?php }else{?>
    
  <img src="<?php echo BASE_PATH;?>memassets/images/uploadkyc.png" id="readURLbank" class="img-kyc" />
 <h2>Image Not Uploaded</h2>
<?php 
 }?>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <form class="hor">
                                <div class="row">
                               <div class="col-sm-6"> <div class="form-group">
                                    <label>Account Holder Name<span class="required">*</span></label>
                                    <input type="text" id="txt_holdername"value="<?php echo $ROW['bank_acct_holder'];?>" readonly class="lettersOnly form-control" />
                                </div> </div>

                              <div class="col-sm-6">   <div class="form-group">
                                    <label>Account No. <span class="required">*</span></label>
                                    <input type="text" id="txt_acountno"readonly  value="<?php echo $ROW['account_number'];?>"  class="cssOnlyNumeric form-control" maxlength="30" />
                                </div> </div>

                               <div class="col-sm-6">  <div class="form-group">
                                    <label>IFSC Code <span class="required">*</span></label>
                                    <input type="text" id="txt_ifsccode" readonly  value="<?php echo $ROW['ifc_code'];?>"   class="cssOnlyForName form-control" />
                                    
                                </div> </div>

                               <div class="col-sm-6"> 

							   <div class="form-group">
                                    <label>Bank Name <span class="required">*</span></label>
                                    <input type="text" readonlyid="txt_bankname" maxlength="15" readonly  value="<?php echo $ROW['bank_name'];?>" class="addressvarification form-control" />
                                </div> </div>
                            <div class="col-sm-6">    <div class="form-group">
                                    <label>Branch Name <span class="required">*</span></label>
                                    <input type="text" id="txt_branchname"  value="<?php echo $ROW['branch'];?>" readonly class="addressvarification form-control" />
                                </div> </div>
								
								 <div class="col-sm-6">    <div class="form-group">
                                    <label>Paytm Number<span class="required">*</span></label>
                                    <input type="text" id="txt_branchname" readonly class="addressvarification form-control" />
                                </div> </div>
                             
                           </div>
                                     </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


	  
	  
	  </div>
	  
	  
	  
	  
	  
		
		
		
		
		
		
      
      
      <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
      <!-- /.content -->
    </div>
  
  </div>
</div>

</body>
<script src="<?php echo BASE_PATH; ?>graph/jquery.flot.js"></script>
<script src="<?php echo BASE_PATH; ?>graph/jquery.flot.init.js"></script>

<script type="text/javascript">
	$(function(){
		<?php if($request_id>0){ ?>
			$('#verifyOTP').modal({
				backdrop: 'static',
				keyboard: false
			});
		<?php } ?>
		
		$("#backTrPassForm").validationEngine();
		$("#otpForm").validationEngine();
		
		$("#sendSmsCode").on('click',function(){
			var URL_CODE = "<?php echo generateSeoUrl("json","jsonhandler",""); ?>";
			var mobile_code = $("#mobile_code").val();
			var member_mobile = $("#member_mobile").val();
			var data = {
				switch_type : "SEND_SMS_CODE",
				mobile_code : mobile_code,
				member_mobile : member_mobile,
			};
			$.getJSON(URL_CODE,data,function(JsonEval){
				if(JsonEval){
					switch(JsonEval.ErrorMsg){
						case "SUCCESS":
							$(".ajaxMessage").html('<div class="alert alert-success">Please check your mobile or email address</div>');
						break;
						default:
							$(".ajaxMessage").html('<div class="alert alert-warning">Unable to send message , please try after again</div>');
						break;
					}
				}
			});
		});
	});
</script>

</html>
