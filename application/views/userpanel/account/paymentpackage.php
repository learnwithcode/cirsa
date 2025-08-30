<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$form_data = $this->input->post();
$segment = $this->uri->uri_to_assoc(2);
$member_id = $this->session->userdata('mem_id');

$AR_TYPE = $model->getCurrentMemberShip($member_id);
$pin_activation = ($AR_TYPE['type_id']>0)? 0:30;

$type_id = FCrtRplc(_d($segment['type_id']));
$AR_MEM = $model->getMember($member_id);
$AR_PACK = $model->getPackage($type_id);

$pin_price = $AR_PACK['pin_price'];
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
	.minheight{
		min-height:1200px;
	}
</style>
</head>
<body>
<div class="site-holder">
  <!-- .navbar -->
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
  <!-- /.navbar -->
  <div class="box-holder">
    <!-- .left-sidebar -->
    <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    <!-- /.left-sidebar -->
    <!-- .content -->
    <div class="content">
      <div class="row">
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo BASE_PATH; ?>"> Home </a></li>
            <li class="active"> Pay Packages </li>
          </ul>
        </div>
      </div>
      <div class="price-list row">
        <!-- Nested Panels -->
        <div class="row">
          <div class="col-md-12"> <?php echo get_message(); ?>
            <div class="panel">
              <div class="panel-body">
                <div class="panel panel-pay">
                  <div class="panel-heading"> <i class="fa fa-shopping-cart"></i> Pay Package </div>
				  <form  name="form-payment" id="form-payment" method="post" action="<?php  echo  generateMemberForm("payment","upgrademembership"); ?>">
                  <div class="panel-body">
                    <h3 id="wallet_label"> </h3>
					
					<div class="col-md-6">
						<label>Package :</label>  <?php echo $AR_PACK['pin_name']; ?>
					</div>
					<div class="clearfix">&nbsp;</div>
					<div class="col-md-4">
                    <label>Amount :</label>  <input type="text" name="pin_price" id="pin_price" class="form-control validate[required,custom[integer]]" maxlength="6" placeholder="Enter amount" />
					</div>
					<div class="clearfix">&nbsp;</div>
					<div class="col-md-6">
                     <?php echo $AR_PACK['description']; ?> 
					</div>
					<div class="clearfix">&nbsp;</div>
                    
				  <div class="col-md-12">
					<input type="radio" name="fldvType" id="fldvType" class="validate[required]" value="BITCOIN" />
					&nbsp; Bitcoin  &nbsp;&nbsp;
					<input type="radio" name="fldvType" id="fldvType" class="validate[required] checkBalance" value="EWALLET" />
					&nbsp; Ewallet  &nbsp;&nbsp;
				  </div>
				  <div class="clearfix">&nbsp;</div>
				  <div class="col-md-12">
				    <input type="hidden" name="type_id" id="type_id" value="<?php echo _e($AR_PACK['type_id']); ?>" />
					<button type="submit" name="upgradeMemberShip" value="1" class="btn color1">Select Payment Method</button>
				  </div>
                  </div>
				  </div>
                </div>
                <hr />
                                
                
              </div>
            </div>
          </div>
        </div>
        <!-- /nested panels -->
      </div>
      <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
      <!-- /.content -->
    </div>
  </div>
</div>
</body>
<?php jquery_validation(); ?>
<script type="text/javascript">
$(function(){
	$("#form-payment").validationEngine();
	$("#form-pin").validationEngine();
	$(".checkBalance").on('click',function(){
		var fldvType = $(this).val();
		if(fldvType=="EWALLET"){
			var URL_LOAD = "<?php echo BASE_PATH; ?>json/jsonhandler?switch_type=EWALLET_BALANCE";
			$.getJSON(URL_LOAD,function(JsonEval){
				if(JsonEval.net_balance>0){
					$("#wallet_label").text('Available amount on your  wallet: <?php echo CURRENCY; ?> '+JsonEval.net_balance);
				}
			});
		}else{
			$("#wallet_label").text('');
		}
	});
});
</script>
</html>
