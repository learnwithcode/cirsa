<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
$today_date = getLocalTime();
$segment = $this->uri->uri_to_assoc(2);

$request_id = _d($segment['request_id']);
$CONFIG_PIN_ACTIVATION = $model->getValue("CONFIG_PIN_ACTIVATION");
$member_id = $this->session->userdata('mem_id');
$wallet_id = $this->OperationModel->getGroupWallet(array("Trading Wallet","Cash Account"));
$wallet_id_trade = $this->OperationModel->getGroupWallet(array("Trading Wallet"));
$wallet_id_cash = $this->OperationModel->getGroupWallet(array("Cash Account"));
$AR_MEM = $model->getMember($member_id);

$AR_TYPE = $model->getCurrentMemberShip($member_id);
$wallet_id = $this->OperationModel->getWallet(WALLET1);
$LDGR = $model->getCurrentBalancewal($member_id,$wallet_id,$_GET['from_date'],$_GET['to_date']);
//PrintR($LDGR);die;
//$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_GET['from_date'],$_GET['to_date']);//die('sunil');
//$LDGR_TRD = $model->getCurrentBalance($member_id,$wallet_id_trade,$_GET['from_date'],$_GET['to_date']);
//$LDGR_CSH = $model->getCurrentBalance($member_id,$wallet_id_cash,$_GET['from_date'],$_GET['to_date']);
 ?>
<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/select2.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/bootstrap-editable.min.css" />

<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	
<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
  <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
       		
		
<div class="content-body"><!-- Basic Tables start -->
 	<div class="row">
							<div class="col-lg-12">
						<h3 class="header smaller lighter blue">New E-Pin Request</h3>
<div class="widget-box">
		<div class="widget-header widget-header-blue widget-header-flat">
		<h4 class="widget-title blue">Available amount on your E-wallet: Rs. <?php //echo CURRENCY; ?> <?php echo $LDGR['net_balance']; ?></h4>
		
	<!--	<div class="widget-toolbar">
		<label>
		<small class="green">
		<b>Validation</b>												</small>
		
		<input id="skip-validation" type="checkbox" class="ace ace-switch ace-switch-4" />
		<span class="lbl middle"></span>											</label>
		</div> -->
		</div>
		
		<div class="widget-body">
		<div class="widget-main">
		
		<form id="form-search" name="form-search" method="post" action="<?php  echo  generateMemberForm("epin","newrequest"); ?>" enctype="multipart/form-data" class="form-horizontal">
		
			<div id="fuelux-wizard-container">
			<?php echo get_message(); ?>
			
			<hr />
			
			<div class="step-content pos-rel">
			<div class="step-pane active" data-step="1">
			<h3 class="lighter block green">Request Here...</h3>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Action Type</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		
	<!-- <input type="radio" name="wallet_type" class="validate[required]" id="wallet_type" value="1" onclick="userfeilds();" />-->
	<!--&nbsp;&nbsp;<label for="wallet_type">Generate From Wallet</label>-->
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="wallet_type" class="validate[required]" onclick="adminfeilds();"  id="wallet_type1" value="0" checked="true" />
	&nbsp;&nbsp;<label for="wallet_type1">Request To Admin</label>
																	</div>
																			</span>																</div>
			
			</div>
			
			<div class="form-group " style="display:none">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Activation Type  :</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		
	   <input type="radio" name="pin_activation" class="validate[required] getPinPackage" id="pin_activation" value="1" />
                    <label for="pin_activation">  With Activation Pin &nbsp;&nbsp;</label>
                      <input type="radio" name="pin_activation" class="validate[required] getPinPackage" id="pin_activation1" value="0" />  <label for="pin_activation1"> Without Activation Pin</label>
																	</div>
																			</span>																</div>
			
			</div>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Pin Type</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-hand-o-right bigger-110"></i>
																		</span>
	     <select  name="type_id" id="type_id" class="form-control validate[required] getPinPrice">
                        <option value="">Select Pin</option>
                        <?php echo DisplayCombo($ROW['type_id'],"PIN_TYPE"); ?>
                      </select>
																	</div>
																			</span>																</div>
			
			</div>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Pin Price/Unit :</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-inr bigger-110"></i>
																		</span>
	  <input id="pin_value" readonly="true" placeholder="Pin Price"  name="pin_value"  class="form-control validate[required]" type="text" value="<?php echo $ROW['pin_value']; ?>">
																	</div>
																			</span>																</div>
			<div class="help-block col-xs-12 col-sm-reset inline" id="sid" style="display:none"></div>
			</div>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">No Of Pin :</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-list bigger-110"></i>
																		</span>
<input id="no_pin" placeholder="" name="no_pin" maxlength="3"  class="form-control validate[required,custom[integer]] getCalculate" type="text" value="<?php echo $ROW['no_pin']; ?>">
																	</div>
																			</span>																</div>
			
			</div>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Net Amount :</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-inr bigger-110"></i>
																		</span>
<input name="net_amount" type="text" class="form-control validate[required]" id="net_amount" value="<?php echo $ROW['net_amount']; ?>" readonly="true">
																	</div>
																			</span>																</div>
			
			</div>
			
		 <!--<div id="adminfeilds" style="display:none;">-->
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Bank Name :</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-home bigger-110"></i>
																		</span>
<input name="bank_name" type="text" class="form-control " id="net_amount" value="<?php echo $ROW['bank_name']; ?>" >
																	</div>
																			</span>																</div>
			
			</div>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Transaction Id :</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-pencil bigger-110"></i>
																		</span>
<input name="trnsId" type="text" class="form-control " id="net_amount" value="<?php echo $ROW['trnsId']; ?>" >
																	</div>
																			</span>																</div>
			
			</div>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Upload Slip :</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-upload bigger-110"></i>
																		</span>
<input name="slip" type="file" class="form-control " id="slip">
																	</div>
																			</span>																</div>
			
			</div>
		<!--</div>	-->
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Description :</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-pencil bigger-110"></i>
																		</span>
<textarea name="payment_sts" class="form-control validate[required]" id="form-field-1"><?php echo $ROW['payment_sts']; ?></textarea>
																	</div>
																			</span>																</div>
			
			</div>
			
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Transaction Password :</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-lock bigger-110"></i>
																		</span>
<input name="trns_password" type="password" class="form-control validate[required]" id="trns_password" 
						value="">
																	</div>
																			</span>																</div>
			
			</div>
			
				   
			
			
			
			
		
			
			</div>
			
			
			</div>
			</div>
		
		<hr />
		<div class="wizard-actions">
 <input type="hidden" name="pin_price" id="pin_price" value="" />
                      <input type="hidden" name="activation_price" id="activation_price" />
                      <input type="hidden" name="submitPinRequest" id="submitPinRequest" value="1" />
                      <input name="buttonRequest" value="Submit" class="btn  btn-primary" id="buttonRequest" type="submit">
                       <a href="<?php echo BASE_PATH; ?>member/epin/newrequest" class="btn  btn-primary">View Request Pin</a>
		</div>
	
		</form>
		</div>
		</div>
		</div>
								

								
								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div>
	<div class="row">
						<div class="col-xs-6">
						<div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries </div>
						</div>
						<div class="col-xs-6">
						<div id="dynamic-table_paginate" class="dataTables_paginate paging_simple_numbers">
						<ul class="pagination">
						<?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
						</ul>
						</div>
						</div>
						</div>

    </div>					
		
        </div>
      </div>
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<?php jquery_validation(); auto_complete(); ?>
<script type="text/javascript">
	$(function(){
		var CONFIG_PIN_ACTIVATION = "<?php echo ($CONFIG_PIN_ACTIVATION>0)? $CONFIG_PIN_ACTIVATION:0; ?>";
		$("#form-valid").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
		$(".getPinPackage").on('click',getPinPackage);
		$(".getPinPrice").on('blur',getPinPrice);
		$(".getCalculate").on('blur',getCalculate);
		function getPinPrice(){
			var type_id = $("#type_id").val();
			var pin_activation = $('input[name=pin_activation]:checked').val();
			var URL_LOAD = "<?php echo BASE_PATH; ?>json/jsonhandler?switch_type=PIN_TYPE&type_id="+type_id;
			
			$("#pin_value").val('');
			$("#net_amount").val('');
			$.getJSON(URL_LOAD,function(jsonReturn){
				
				if(jsonReturn && jsonReturn.type_id>0){
					if(pin_activation>0){
						var pin_value = parseInt(jsonReturn.pin_price)+parseInt(CONFIG_PIN_ACTIVATION);
						$("#pin_value").val(pin_value);
						$("#pin_price").val(jsonReturn.pin_price);
						$("#activation_price").val(CONFIG_PIN_ACTIVATION);
						
					}else{
						var pin_value = parseInt(jsonReturn.pin_price)
						$("#pin_value").val(pin_value);
						$("#pin_price").val(jsonReturn.pin_price);
						$("#activation_price").val(0);
					}
					$("#no_pin").val('');
				}
			});
		}
		
		function getPinPackage(){
			var pin_activation = $('input[name=pin_activation]:checked').val();
			var URL_PIN = "<?php echo BASE_PATH; ?>json/jsonhandler?switch_type=LOAD_PIN&pin_activation="+pin_activation;
			$("#type_id").load(URL_PIN);
			$("#pin_value").val('');
			$("#pin_price").val('');
			$("#no_pin").val('');
		}
		
		function getCalculate(){
			var no_pin = $("#no_pin").val();
			var pin_value = $("#pin_value").val();
			if(no_pin>0 && pin_value>0){
			 
				//var integer = parseInt(pin_value, 10);
				//var total = integer+100;
				var net_amount = pin_value*no_pin;
				$("#net_amount").val(net_amount);
			}
		}
		
		
	});
	
	function adminfeilds()
		{
		   document.getElementById("adminfeilds").style.display = "block";
		}
		function userfeilds()
		{
		    document.getElementById("adminfeilds").style.display = "none";
		}
</script>