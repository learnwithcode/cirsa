<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$userId = $model->generateUserId();
$form_data = $this->input->post();

$segment = $this->uri->uri_to_assoc(1);
 

$spr_user_id  = $this->uri->segment(2);         
$side  = $this->uri->segment(3);    

$QR_SPR = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE (tm.user_id LIKE '".$spr_user_id."' OR tm.user_name LIKE '".$spr_user_id."')";
$AR_SPR = $this->SqlModel->runQuery($QR_SPR,true);
 
   $companyname =$model->getValue("CONFIG_COMPANY_NAME");
 
header('Access-Control-Allow-Origin: *'); 
?> 
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Title -->
	<title><?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>">
  <link href="<?php echo BASE_PATH; ?>userassets/css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"  />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="index.html"><img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" width="100" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Create an Account</h4>
                                     <?php echo get_message(); ?>
                                      <p id="error-msg"></p>
                           <div  class="alert alert-block alert-danger error-login-t" id="ajax_message" style="display:none;"></div>
                        
                           
                     <div class="form-group"> <div id="ajax_loading" align="center"></div> </div>
                  <form  action="<?php echo generateSeoUrl("user","registerajax",array()); ?>"  method="post" accept-charset="utf-8">   
                  
                  
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Enter Sponsor Id</strong></label>
                                            <input type="text" name="spr_user_id" id="spr_user_id"  class="form-control" value="<?php echo $AR_SPR['user_name']; ?>" placeholder="Enter Sponsor Id" <?php echo ($AR_SPR['user_name']!='')? "readonly='true'":""; ?>>
                     
                                        </div>
                                         <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Sponsor Name</strong></label>
                                           <input id="spr_full_name" type="text" name="spr_full_name" class="form-control " readonly value="<?php echo $AR_SPR['first_name']; ?>"
                            placeholder="Sponsor Name">
                                        </div>
                                        	 <div class="form-group"  style="display:none;">
                                 <div class="floating-label form-group"> 
                                 <br>
                                    <select id="ddlsideofmember" name="plan" class="form-control  validate[required]"  required  >
                <option value="" >Select Plan</option>
                <option value="A"   selected="selected" >Plan A</option>
                <option value="B"    >Plan B</option> 
                </select>
                
                
                                    
                                 </div>
                              </div>
                          <div class="mb-3" style="display:none;" >
                                 <div class="floating-label form-group">
                                    <select id="ddlsideofmember" name="left_right" class="form-control  validate[required]"   >
                <option value="" >Select Side</option>
                <option value="L"  <?php if($side =='L'){ ?> selected="selected" <?php } ?> selected="selected" >Left</option>
                <option value="R"  <?php if($side =='R'){ ?> selected="selected" <?php } ?>  >Right</option> 
                </select>
                                    
                                 </div>
                              </div>
                               <div class="mb-3" style="display:none;">
                                 <div class="floating-label form-group">
                                   <input type="text" class="form-control  bg-inverse bg-opacity-5" name="spil_user_id" id="spil_user_id"  value="1" placeholder="Spill User Id"  >
               
                                  
                                 </div>
                              </div>
                              
                     
                     
                     
                     
                                         <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Member Id</strong></label>
                                              <input type="text"  name="user_id" id="user_id"readonly value="<?php echo $userId; ?>" class="form-control " placeholder="User Id" onKeyUp="validate1();" onChange="checkUserId(this.value);"    minlength="6"  maxlength="10" >
            
                                        </div>
                                         <div class="form-group">
                                            <label class="mb-1 text-white"><strong>User Name</strong></label>
                                         <input type="text" onKeyPress="return IsAlphaNumeric(event)" class="form-control " name="first_name" id="first_name"  value="<?php echo $_GET['first_name']; ?>"  placeholder="User Name" required>  
                         
                                        </div>
                                         <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Mobile No</strong></label> <br>
                                         	   <input class="form-control "   id="phone" type="tel" name="phone" onKeyPress="return isNumber(event)"  required >
					
                                        </div>
                                         <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Email Id</strong></label>
                                           		     <input type="email" name="member_email" id="member_email" class="form-control "   value="<?php echo $_GET['member_email']; ?>" placeholder="Enter Email ID"  required> 
				
                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                         	  <input  type="password"  name="user_password" class="form-control "  id="user_password" value="<?php echo $_REQUEST['user_password']; ?>" placeholder="Password"  minlength="6" >
					</div>
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                 <div class="custom-control custom-checkbox mb-3">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                    <label class="custom-control-label" for="customCheck1">I Agree Your <a href="#">Terms and Conditions</a></label>
                                 </div>
                              </div>
                                            </div>
                                            
                                        </div>
                                        <div class="text-center">
                                             <button type="submit" class="btn bg-white text-primary btn-block">Sign Up</button>
                                         </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">Already have an account? <a class="text-white" href="<?php echo BASE_PATH;?>login">Sign In</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

  var input = document.querySelector("#phone"),
      errorMsg = document.querySelector("#error-msg");

  var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
  var iti = window.intlTelInput(input, {
    preferredCountries: ["uz"],
    separateDialCode: true,
    hiddenInput: "full",
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
  });

  var reset = function() {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
  };

  // Function to show alert on country change and enforce length validation
  function showCountryAlert() {
    var countryData = iti.getSelectedCountryData();
    if (countryData.iso2 === 'in') {
      
    }
  }

  // Validate length for Indian numbers
  function validateLengthForIndia() {
    var countryData = iti.getSelectedCountryData();
    if (countryData.iso2 === 'in') {
      var numericValue = input.value.replace(/\D/g, ""); // Get numeric part only
      if (numericValue.length > 10) {
        // Trim the input value to 10 digits
        input.value = numericValue.slice(0, 10);
      }
    }
  }
 function validateLengthForUAE() {
    var countryData = iti.getSelectedCountryData();
    if (countryData.iso2 === 'ae') {
      var numericValue = input.value.replace(/\D/g, ""); // Get numeric part only
      if (numericValue.length > 9) {
        // Trim the input value to 10 digits
        input.value = numericValue.slice(0, 9);
      }
    }
  }
  // Trigger alert and length validation when the country changes
  input.addEventListener('countrychange', function() {
  
    validateLengthForIndia();
     validateLengthForUAE();
  });

  // Validate on input events
  input.addEventListener('input', function() {
    validateLengthForIndia();
     validateLengthForUAE();
  });


  input.addEventListener('change', reset);
  input.addEventListener('keyup', reset);
</script>
 






 



<?php jquery_validation(); ?> 
     <script>
   
   
 
   $("#spr_user_id").on('blur',function(){
         var URL_SPR = "<?php echo BASE_PATH; ?>json/jsonhandler";
         var spr_user_id = $("#spr_user_id").val();
         $.getJSON(URL_SPR,{switch_type:"CHECKUSR",spr_user_id:spr_user_id},function(JsonEval){

            if(JsonEval){
               if(JsonEval.member_id>0){
                  $("#spr_full_name").val(JsonEval.full_name);
                 $("#error-msg").html('<div class="alert alert-success solid alert-dismissible fade show"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg><strong> </strong> Sponsor Ok !<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button></div>');                                     
                  
                
                        
                  
}else{
                            $("#spr_full_name").val('');
                            
                            $("#error-msg").html('<div class="alert alert-danger solid alert-dismissible fade show"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg><strong> </strong> Please Check Sponsor Id<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button></div>');                                     
              
                            return  false;
               }
            }else{
               $("#spr_full_name").val('');
                  
                         $("#error-msg").html('<div class="alert alert-danger solid alert-dismissible fade show"><svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg><strong> </strong> Please Check Sponsor Id<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button></div>');                                     
              
                         return false;
            }
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
    
    
    
     function checkUserId(id)
  { 
   var le = id.length;
   var check_id = document.getElementById("spr_user_id").value;
    
 if(le >= 6)
 {
 if(id != check_id  ) {
 

      
jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "user/checkuserid",
data: {userId: id},
success: function(res) {
 
if(res == '1')
{
 
alert('Not Available...');
document.getElementById("user_id").value=''
document.getElementById("user_id").focus();
}
 

} });

 
 
 }
 else
 {
 
 
alert('User Id Mismatch');
document.getElementById("user_id").value='';
document.getElementById("user_id").focus();
 }
 }
 else{
 
alert('UserId Minimum 6 Digit / Char ...');
 document.getElementById("user_id").focus();
 }} 
 
 
 
 
</script>
  <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
       <script src="<?php echo BASE_PATH; ?>userassets/vendor/global/global.min.js"></script>
	<script src="<?php echo BASE_PATH; ?>userassets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
     <script src="<?php echo BASE_PATH; ?>userassets/js/custom.min.js"></script>
    <script src="<?php echo BASE_PATH; ?>userassets/js/deznav-init.js"></script>

</body>

</html>


