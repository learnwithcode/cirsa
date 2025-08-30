<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
$today_date = getLocalTime();
$segment = $this->uri->uri_to_assoc(2);

$request_id = _d($segment['request_id']);
$member_id = $this->session->userdata('mem_id');
$wallet_id = $this->OperationModel->getWallet(WALLET1);
$AR_MEM = $model->getMember($member_id);

$LDGR = $model->getCurrentBalancewal($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);



	$wallet_id = $model->getWallet(WALLET1);
 


	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tft.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES= "SELECT tpd.*, tm.user_id, tm.first_name, tm.last_name, tpy.pin_name, SUM(tpy.pin_price ) AS net_pin_price
			FROM ".prefix."tbl_pin_transfer AS tpd 
		 
			LEFT JOIN ".prefix."tbl_members AS tm ON tpd.to_member_id=tm.member_id
			LEFT JOIN ".prefix."tbl_pintype AS tpy ON tpd.type_id=tpy.type_id WHERE tpd.from_member_id='".$member_id."' $StrWhr 
			GROUP BY tpd.transfer_id
			ORDER BY tpd.transfer_id DESC	";
	$PageVal = DisplayPages($QR_PAGES, 25, $Page, $SrchQ);	  
  $available =      $model->countunusedPin($member_id,1);
 ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>								


		 <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
       		
		
<div class="content-body"><!-- Basic Tables start -->
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">E-pin Transfer 	</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                 <div class="card-body">
				 
                 <div class="card-text">
					 
						  	<?php echo get_message(); ?>
						
						</div>
            

   <hr>		
		        <form action="<?php  echo  generateMemberForm("epin","transferEpin"); ?>" id="form-valid" name="form-valid" method="post">			
	    	<div class="form-body">
	          
						
		<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Pin Type :</label>
									<div class="col-md-9">
	                     <select  name="pin_type" id="pin_type" onchange="getpinno(this.value);" class="form-control" required >
					<option value="">Select Package </option>
					<?php echo DisplayCombo($_GET['type_id'],"PIN_TYPE"); ?>
					</select>
	                            	</div>
		                        </div>				 
				 <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">User Id	 :</label>
									<div class="col-md-9">
	             <input class="form-control" name="user_id" id="user_id" type="text" placeholder="User Id" required>
	                            	</div>
		                        </div>			
						
	 	 
		
		 <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">No of Epins	 :</label>
									<div class="col-md-9">
	           	<select name="no_pin" class="form-control " id="no_pin" required >
					    <option value="">Select Pin</option>
						<?php   for($i=1;$i<=$available;$i++)
						{ ?>
						    <option value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php }
						?>
						
						</select>
	                            	</div>
		                        </div>
		              		 <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Remark	 :</label>
									<div class="col-md-9">
	            <textarea name="trns_remark" class="form-control " placeholder="Your Remark" id="form-field-1"></textarea>
	                            	</div>
		                        </div>          
		                        
		                        
		                        
<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Login Password:</label>
									<div class="col-md-9">
	             <input class="form-control" name="trns_password" id="trns_password" type="password" placeholder="Login Password" required>
	                            	</div>
		                        </div>
		
		
		
		
		
		
		 
		
		
			</div>
		 
		
		<div class="form-actions">
		
		 <input type="hidden" name="submitFundRequest" id="submitFundRequest" value="1" />
		
	                          
	                            <button type="submit" name="buttonRequest" class="btn btn-primary">
	                              	Transfer  <i class="ace-icon fa fa-send-o  icon-on-right"></i>
	                            </button>
	                        </div>
		</form>
		</div>
		 	
       
	 
    
     <div class="clear"></div>
     
        </div>
    </div>
</div>


    </div>					
	 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Referral Income</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                  		
                <div class="table-responsive">
                    <table class="table table-bordered table-inverse mb-0 .table-inverse">
  <thead>
                      
                        <tr>
                        <th>Srl # </th>
                        <th>Transfer Date </th>
						 <th>User Id </th>
                        <th>E-Pin Type </th>
                        <th>Old E-Pin Number </th>
                        <th>Old E-Pin Key </th>
                        <th>E-Pin Value </th>
                      </tr>
                      </thead>
                      <tbody>
                     <?php   if($PageVal['TotalRecords'] > 0){
					$Ctrl=$PageVal['RecordStart']+1;
					foreach($PageVal['ResultSet'] as $AR_DT):
					?>   
                     <tr>
                        <td><?php echo $Ctrl; ?></td>
                        <td><?php echo DisplayDate($AR_DT['transfer_date']); ?></td>
						   <td><?php echo ($AR_DT['user_id']); ?></td>
                        <td><?php echo ($AR_DT['pin_name']); ?></td>
                        <td><?php echo highlightWords($AR_DT['old_pin_no'],$_GET['old_pin_no']); ?></td>
                        <td><?php echo highlightWords($AR_DT['old_pin_key'],$_GET['old_pin_key']); ?></td>
                        <td><?php echo $AR_DT['net_pin_price']; ?></td>
                      </tr>
                      <?php $Ctrl++; endforeach; }else{ ?>
                    <tr>
                      <td colspan="7" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                    </tr>
                    <?php } ?>
                      </tbody>
    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
</div></div>

<div class="col-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul>
								  
								   </div></div>	 
        </div>
      </div>
    </div>
    <!-- END: Content-->	
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>


		<script type="text/javascript">
 
	function getpinno(id)
			{
		
	
jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/epin/getEpinNo",

data: {id: id},
success: function(res) {   
 $("#no_pin").html(res);
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
   