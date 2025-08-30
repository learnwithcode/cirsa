<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
 $userId = $model->generateUserId();
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
<div class="col-md-12">
<h3 class="header smaller lighter blue">	 
									<i class="ace-icon fa fa-sign-in green"></i>
									<span class="red">Sign-Up New Distributor</span>
									
								 </h3>

<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<div class="signin-container">
							

							<div class="space-6"></div>

							<div class="position-relative">
<div id="signup-box" class="signup-box visiblewidget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
										 
								
								         
											<h4 class="header green lighter bigger">
												<i class="ace-icon fa fa-users blue"></i>
												Please Enter Your Information
											</h4>

											<div class="space-6"></div>
										 

	<form class="form-signin" method="post" name="form-signin" id="form-signin" accept-charset="utf-8">
	<label class="block clearfix">
	<span class="block input-icon input-icon-right">
		
	 <div id="ajax_loading" align="center"></div>
	 <div id="register_message" align="center"></div>
	</span>
	</label>
	
	 
	<fieldset>

			    			
							
							
	<label class="block clearfix">
	<span class="block input-icon input-icon-right">
		 <input type="text" class="form-control  validate[required,minSize[3]]" name="spr_user_id" id="spr_user_id" value="<?php echo $AR_SPR['user_name']; ?>" placeholder="Enter Sponsor Id" <?php echo ($AR_SPR['user_name']!='')? "readonly='true'":""; ?>>
	<i class="ace-icon fa fa-info"></i>
	</span>
	</label>

	
									
	<label class="block clearfix">
	<span class="block input-icon input-icon-right">
<input type="text"  class="form-control input-sm" id="spr_full_name" name="spr_full_name" placeholder="Sponsor Name" readonly value="<?php echo $AR_SPR['first_name']; ?>" >
	<i class="ace-icon fa fa-user"></i>
	</span>
	</label>
	<label class="block clearfix" >
	<span class="block input-icon input-icon-right">
 	<select id="ddlsideofmember" name="left_right" class="form-control  validate[required]"   >
                                                  <option value="" >Select Side</option>
                                                  <option value="L" selected="selected">Left</option>
                                                  <option value="R">Right</option> 
                                    </select>
	
	</span>
	</label>
	
	
<!--		<label class="block clearfix" style="display:none">-->
<!--	<span class="block input-icon input-icon-right"> -->
<!--<input type="text" class="form-control  validate[required" required  name="activePin"  id="activePin"  placeholder="Activation Pin"  maxlength="25" >-->
<!--	<i class="ace-icon fa fa-lock"></i>-->
<!--	</span>-->
<!--	</label>-->
	
<!--			<label class="block clearfix" style="display:none">-->
<!--	<span class="block input-icon input-icon-right"> -->
<!--<input type="text" class="form-control  validate[required"  required  name="activeKey"  id="activeKey"  placeholder="Activation Key"  maxlength="25" >-->
<!--	<i class="ace-icon fa fa-key"></i>-->
<!--	</span>-->
<!--	</label>-->
	 
	
	<label class="block clearfix">
	<span class="block input-icon input-icon-right"><!--onkeypress="return IsAlphaNumeric(event);"  onkeypress="return isValidCharacter(event)"-->
<input type="text" class="form-control  validate[required" name="user_id" id="user_id" value="<?php echo $userId; ?>" placeholder="User Id" onKeyUp="validate1();"   minlength="5"  maxlength="10" readonly>
	<i class="ace-icon fa fa-info"></i>
	</span>
	</label>
	<label class="block clearfix">
	<span class="block input-icon input-icon-right">
	 <input type="text" name="first_name" id="first_name"  value="<?php echo $_GET['first_name']; ?>" class="form-control input-log-cls validate[required,minSize[3]]" placeholder="Name" onKeyPress="return ValidateAlpha(event)" required>
	<i class="ace-icon fa fa-user"></i>
	</span>
	</label>
	<!--	<label class="block clearfix">-->
	<!--<span class="block input-icon input-icon-right">-->
	<!-- <input type="text" name="last_name" id="last_name" onKeyPress="return ValidateAlpha(event)"  value="<?php echo $_GET['last_name']; ?>" class="form-control input-log-cls  " placeholder="Last Name" required>-->
	<!--<i class="ace-icon fa fa-user"></i>-->
	<!--</span>-->
	<!--</label>-->
	<label class="block clearfix">
	<span class="block input-icon input-icon-right">
	<input type="text" name="member_mobile" id="member_mobile" class="form-control input-sm "    value="<?php echo $_GET['member_mobile']; ?>" placeholder="Enter mobile number" onKeyPress="return isNumber(event)" minlength="10" maxlength="10" onChange="return IsMobileNumber(this.value);">
	 <input type="hidden"class="form-control input-sm " name="member_email" id="member_email" value="xyz@gmail.com" placeholder="xyz@gmail.com">
	<i class="ace-icon fa fa-mobile"></i>
	</span>
	</label>
					 <select class="form-control input-sm " style="display:none"id="country_code" name="country_code" placeholder="Enter Country" >
			
			<option value="IND"selected="selected">INDIA</option>
            </select>
	<label class="block clearfix">
	<span class="block input-icon input-icon-right">
	<input  type="password"  class="form-control input-sm validate[required,minSzie[6]]"  name="user_password"  id="user_password" value="<?php echo $_REQUEST['user_password']; ?>" placeholder="Password"  minlength="6" >
	<i class="ace-icon fa fa-lock"></i>
	</span>
	</label>
	
	<label class="block clearfix">
	<span class="block input-icon input-icon-right">
	<input type="password"  class="form-control input-sm validate[required,equals[user_password]]"   name="confirm_password" id="confirm_password" value="<?php echo $_REQUEST['confirm_password']; ?>" placeholder="Confirm Password" min='6'>
	<i class="ace-icon fa fa-retweet"></i>
	</span>
	</label>
 
	<label class="block">
	<input  id="chkterm" type="checkbox" required name="accept"  value="add" class="ace" />
	<span class="lbl">
	I accept the
	<a href="#">User Agreement</a>
	</span>
	</label>
	
	<div class="space-24"></div>
	
	<div class="clearfix">
	<button type="reset" id="rset"class="width-30 pull-left btn btn-sm">
	<i class="ace-icon fa fa-refresh"></i>
	<span class="bigger-110">Reset</span>
	</button>
	
	<button type="submit" value="Register"class="width-65 pull-right btn btn-sm btn-success">
	<span class="bigger-110">Register</span>
	
	<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
	</button>
	</div>
	</fieldset>
	</form>
	 
										</div>

										 
									</div><!-- /.widget-body -->
								</div>
 
 </div></div></div></div>
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title" id="myModalLabel">Registration Information <?php echo WEBSITE;?></h4>
</div>
<div class="modal-body">
 

<center>
<p class="text-left"><h5>Dear <span id="UserName_model">THW User </span>,<br>You have successfully registered on <?php echo WEBSITE;?></h5><br>
 <hr>
 <p class="text-left"><h4>Login User ID :- <span id="UserID_model">UserID </span> </h4><br>
 <p class="text-left"><h4>Login Password :- <span id="UserPass_model">Password </span> </h4><br>
 
<hr>
<p class="text-left"><h5>Regards, <br><?php echo WEBSITE;?></h5><br>
<?php echo BASE_PATH;?>
</center>
</div>
<div class="modal-footer">
<center>
<button type="button" class="btn btn-default" data-dismiss="modal" onClick="window.location.href=window.location.href">Close</button>
</center>
</div>
</div>
</div>
</div>

 
 
 
 
 
 
 
 
 
 
  
 
</div> 
</div>
 

    </div>					
		
        </div>
      </div>
    </div>
    <!-- END: Content-->	
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
<?php jquery_validation(); ?> 
<script>
// When the user scrolls down 20px from the top of the document, show the button
/*window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}
*/
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
$(function(){
	$(".contact-form").validationEngine();
	$("#form-signin").validationEngine(
		{onValidationComplete: function(form, valid){
            if (valid) {
				$("#register_button").hide();
				$("#ajax_loading").html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i> Processing please wait....');
				
				var URL_EEGISTER = "<?php echo generateForm("user","registerajax",""); ?>";
				$.getJSON(URL_EEGISTER,$("#form-signin").serialize(),function(JsonEval){
					if(JsonEval){
					
						if(JsonEval.ErrorMsg!=''){
						
							switch(JsonEval.ErrorMsg){
								case "success":
								
								//	$("#register_message").html('processing...');
									 // $("#mem_id").html(JsonEval.mem_id);
									  //$("#pass").html(JsonEval.pass);
									  
										$("#register_message").show();
										$("#register_message").html(JsonEval.ErrorDtl);
											$("#ajax_loading").hide();
			                         window.location.href='<?php echo BASE_PATH; ?>member/network/addNewMember';
									//  $('#rset').trigger('click');
									//  $("#UserName_model").html(JsonEval.UserName_model);
//									  $("#UserID_model").html(JsonEval.UserID_model);
//									  $("#UserPass_model").html(JsonEval.UserPass_model);
//									  $('#myModal').modal({ backdrop: 'static',  keyboard: false});
//									  $('#myModal').modal('show'); 
                                     
								break;
								case "warning":
								
									$("#register_message").show();
										$("#register_message").show();
									$("#register_message").html(JsonEval.ErrorDtl);
									$("#ajax_loading").html('');
									$("#register_button").show();
								break;
							}
						}else{
						
							$("#register_message").show();
							$("#register_message").html('Please enter all valid fields');
							$("#ajax_loading").html('');
							$("#register_button").show();
						}
					}else{
					
						$("#register_message").show();
						$("#register_message").html('Please enter all valid fields');
						$("#ajax_loading").html('');
						$("#register_button").show();
					}
				});
            }
        }}
	);
	
	$( ".form-login" ).on( "submit", function( event ) {
			event.preventDefault();
			
			var URL_LOGIN = $(this).attr( 'action' );
			
			$.getJSON(URL_LOGIN,$(this).serialize(),function(JsonEval){
				if(JsonEval){
					if(JsonEval.ErrorMsg!=''){
						switch(JsonEval.ErrorMsg){
							case "success":
								window.location.href='<?php echo MEMBER_PATH; ?>';
							break;
							case "invalid":
							
								$("#ajax_message").show();
								$("#ajax_message").html(JsonEval.ErrorDtl);
							break;
						}
					}
				}
			});
			
	});
	
	$("#spr_user_id").on('blur',function(){
			var URL_SPR = "<?php echo BASE_PATH; ?>json/jsonhandler";
			var spr_user_id = $("#spr_user_id").val();
	 
			$.getJSON(URL_SPR,{switch_type:"CHECKUSR",spr_user_id:spr_user_id},function(JsonEval){
				if(JsonEval){
					if(JsonEval.member_id>0){
						$("#spr_full_name").val(JsonEval.full_name);
						$("#ajax_loading").html('<div class="alert alert-success"> Sponsor validated ! </div>');
					}else{
						$("#spr_full_name").val('');
						$("#ajax_loading").html('<div class="alert alert-warning"> Invalid sponsor ! </div>');
						return  false;
					}
				}else{
					$("#spr_full_name").val('');
					$("#ajax_loading").html('<div class="alert alert-warning"> Invalid sponsor ! </div>');
					return false;
				}
			});
	});

});
</script>
 
 
 <script>
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;}

function IsAlphaNumeric(e) {
            var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
            var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <= 122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            document.getElementById("error").style.display = ret ? "none" : "inline";
            return ret;
        }
		
function isValidCharacter(e) {  
var key;
document.all ? key = e.keyCode : key = e.which; 
var pressedCharacter = String.fromCharCode(e)   
var regExp = /^[a-zA-ZÁÉÍÓÚáéñíóú ]*$/; 
return regExp.test(pressedCharacter); }

function validate1() {
    var element = document.getElementById('user_id');
    element.value = element.value.replace(/[^a-zA-Z0-9]+/, ''); };
	
	 function ValidateAlpha(evt)
 {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }	
	  function IsMobileNumber(txtMobId) {


     var Number = txtMobId;
     var IndNum = /^[0]?[6789]\d{9}$/;

     if(IndNum.test(Number)){ }

    else{
 
alert('Please enter  valid mobile number...');
  document.getElementById("member_mobile").value='';
      
    }}
</script>








<script type="text/javascript">
	var BASE_PATH = "<?php echo BASE_PATH ?>";
</script>
