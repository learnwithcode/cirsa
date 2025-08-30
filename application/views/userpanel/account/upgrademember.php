<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
$today_date = getLocalTime();
$segment = $this->uri->uri_to_assoc(2);

$request_id = _d($segment['request_id']);
$member_id = $this->session->userdata('mem_id');
$wallet_id = $this->OperationModel->getWallet(WALLET1); 
$AR_MEM = $model->getMember($member_id);
 
$LDGR = $model->getCurrentBalancewal($member_id,3,$_REQUEST['from_date'],$_REQUEST['to_date']);
$LDGR1 = $model->getCurrentBalancewal($member_id,'2',$_REQUEST['from_date'],$_REQUEST['to_date']);


	$wallet_id = $model->getWallet(WALLET1);
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	 

	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tft.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
 

if($_GET['from_date']!='' && $_GET['to_date']!=''){
	$from_date = InsertDate($_GET['from_date']);
	$to_date = InsertDate($_GET['to_date']);
	$StrWhr .=" AND DATE(tpd.date_time) BETWEEN '".$from_date."' AND '".$to_date."'";
	$SrchQ .="&from_date=$from_date&to_date=$to_date";
}
if($_GET['type_id']>0){
	$type_id = FCrtRplc($_GET['type_id']);
	$StrWhr .=" AND tpd.type_id='".$type_id."'";
	$SrchQ .="&type_id=$type_id";
}
if($_GET['pin_no']>0){
	$pin_no = FCrtRplc($_GET['pin_no']);
	$StrWhr .=" AND ( tpd.pin_no LIKE '%$pin_no%' OR tpd.pin_key LIKE '%$pin_no%' )";
	$SrchQ .="&pin_no=$pin_no";
}
$QR_PAGES= "SELECT tpd.*, tm.user_id, tm.first_name, tm.last_name, tpy.pin_name, SUM(tpd.pin_price+tpm.pin_activation) AS net_pin_price
			FROM ".prefix."tbl_pinsdetails AS tpd 
			LEFT JOIN ".prefix."tbl_pinsmaster AS tpm ON tpd.mstr_id=tpm.mstr_id
			LEFT JOIN ".prefix."tbl_members AS tm ON tpd.member_id=tm.member_id
			LEFT JOIN ".prefix."tbl_pintype AS tpy ON tpd.type_id=tpy.type_id WHERE tpy.type_id > '1' and tpd.pin_sts='N' 
			AND tpd.member_id>0 AND tpd.member_id='".$member_id."' $StrWhr 
			GROUP BY tpd.pin_id
			ORDER BY tpd.pin_id ASC	";
$PageVal = DisplayPages($QR_PAGES, 25, $Page, $SrchQ);  /// PrintR($PageVal);die;


$sts = $model->getactivationSts($member_id);

 ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead' ); ?>
    <?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
 <div class="content-page rtl-page">
      <div class="container-fluid">
         <div class="row">
           
            <div class="col-sm-6 col-lg-6">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Upgrade Membership Plan From Activation Wallet </h4>
                     </div>
                  </div>
                  <div class="card-body">
                      <?php echo get_message(); ?>
                     <form class="form-horizontal" action="<?php  echo  generateMemberForm("account","upgradememberpackage"); ?>" id="sample-form" enctype="multipart/form-data">
                        <div class="form-group row">
                           <label class="control-label col-sm-3 align-self-center" for="email">Wallet Type:</label>
                           <div class="col-sm-9">
                               <select name="wallet_id" class="form-control " id="wallet_id" class="form-control form-control-sm mb-3">
                          
                           <option value="3">Activation-wallet</option>
                        </select>
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="control-label col-sm-3 align-self-center" for="pwd1">Activation-wallet:</label>
                           <div class="col-sm-9">
                              <input type="text" autocomplete="off" class="form-control" value="$ <?php echo   $LDGR['net_balance'];?>">
                           </div>
                        </div>
                         <div class="form-group row">
                           <label class="control-label col-sm-3 align-self-center" for="pwd1">Package:</label>
                           <div class="col-sm-9">
                               <select name="type_id" class="form-control " id="type_id" class="form-control form-control-sm mb-3">
                          
                           <option value="3">Activation-wallet</option>
                        </select>
                           </div>
                        </div>
                         <div class="form-group row">
                           <label class="control-label col-sm-3 align-self-center" for="pwd1">User Id:</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" name="member_id"  id="mem_id" autocomplete="off" onchange="check_member(this.value);" value="" required>
                           </div>
                        </div>
                         <div class="form-group row">
                           <label class="control-label col-sm-3 align-self-center" for="pwd1">Member Name:</label>
                           <div class="col-sm-9">
                              <input type="text" class="form-control" id="name" name="member_name"  placeholder="Member Name"   autocomplete="off" onchange="check_member(this.value);" value="" readonly>
                           </div>
                        </div>
                        
                         <div class="form-group row">
                           <label class="control-label col-sm-3 align-self-center" for="pwd1">Login Password:</label>
                           <div class="col-sm-9">
                              <input  class="form-control" name="trns_password" id="" type="password" placeholder="Login Password" required>
                           </div>
                        </div>
                        	 
		<?php if($model->getValue("member_activation_on_off")=='Y' or   $sts =='N'){ ?>
		<div class="form-actions">
		
		<input type="hidden" name="upgradeMemberShip" value="1" />
		
	                            <button type="reset" class="btn btn-warning mr-1">
	                            	<i class="ft-reset"></i> Reset
	                            </button>
	                            <button type="submit" name="buttonRequest" class="btn btn-primary">
	                              	<i class="ace-icon fa fa-cloud-upload icon-on-right"></i>Upgrade
	                            </button>
	                        </div>
	                        <?php }?>
                       <!-- <div class="form-group">
                           <button type="submit" class="btn btn-primary">Submit</button>
                           <button type="submit" class="btn bg-danger">Cancel</button>
                        </div>-->
                     </form>
                  </div>
               </div>
             
            </div>
         </div>
      </div>
      </div>
		     
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
			
			<script>
			   function  copypinkey(pin,key,id)
			   {
			      // alert('Pin ->' + pin+' Key -> '+key);
			      document.getElementById("pin_no").value=pin;
			      document.getElementById("pin_key").value=key;
			      $('#pin_key tr').removeClass("green");
			      $('#'+id).addClass("green");
			      
			   }
			    
			</script>
 
	   <script>
	   function check_member(id)
{

	  jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/check_user",
data: {mem: id},
success: function(res) {
document.getElementById("name").value=res;

}
});
}

	   </script>

		
		<script type="text/javascript">
			jQuery(function($) {
			
				$('[data-rel=tooltip]').tooltip();
			
				$('.select2').css('width','200px').select2({allowClear:true})
				.on('change', function(){
					$(this).closest('form').validate().element($(this));
				}); 
			
			
				var $validation = false;
				$('#fuelux-wizard-container')
				.ace_wizard({
					//step: 2 //optional argument. wizard will jump to step "2" at first
					//buttons: '.wizard-actions:eq(0)'
				})
				.on('actionclicked.fu.wizard' , function(e, info){
					if(info.step == 1 && $validation) {
						if(!$('#validation-form').valid()) e.preventDefault();
					}
				})
				//.on('changed.fu.wizard', function() {
				//})
				.on('finished.fu.wizard', function(e) {
					bootbox.dialog({
						message: "Thank you! Your information was successfully saved!", 
						buttons: {
							"success" : {
								"label" : "OK",
								"className" : "btn-sm btn-primary"
							}
						}
					});
				}).on('stepclick.fu.wizard', function(e){
					//e.preventDefault();//this will prevent clicking and selecting steps
				});
	$('#skip-validation').removeAttr('checked').on('click', function(){
					$validation = this.checked;
					if(this.checked) {
						$('#sample-form').hide();
						$('#validation-form').removeClass('hide');
					}
					else {
						$('#validation-form').addClass('hide');
						$('#sample-form').show();
					}
				})

				$.mask.definitions['~']='[+-]';
				$('#phone').mask('(999) 999-9999');
			
				jQuery.validator.addMethod("phone", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{4}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");
			
				$('#validation-form').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						email: {
							required: true,
							email:true
						},
						password: {
							required: true,
							minlength: 5
						},
						password2: {
							required: true,
							minlength: 5,
							equalTo: "#password"
						},
						name: {
							required: true
						},
						phone: {
							required: true,
							phone: 'required'
						},
						url: {
							required: true,
							url: true
						},
						comment: {
							required: true
						},
						state: {
							required: true
						},
						platform: {
							required: true
						},
						subscription: {
							required: true
						},
						gender: {
							required: true,
						},
						agree: {
							required: true,
						}
					},
			
					messages: {
						email: {
							required: "Please provide a valid email.",
							email: "Please provide a valid email."
						},
						password: {
							required: "Please specify a password.",
							minlength: "Please specify a secure password."
						},
						state: "Please choose state",
						subscription: "Please choose at least one option",
						gender: "Please choose gender",
						agree: "Please accept our policy"
					},
			
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
			
					submitHandler: function (form) {
					},
					invalidHandler: function (form) {
					}
				});
	
				$('#modal-wizard-container').ace_wizard();
				$('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');

				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					$('[class*=select2]').remove();
				});
			})
		</script>
		
		
		<script type="text/javascript">
			jQuery(function($) {
			
	
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				
		
			
				
			
			});
			
			function getcities(state)
			{
		
		
jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/getcities",

data: {name: state},
success: function(res) {
$("#cities").html(res);
}
});

			}
		</script>				  
   