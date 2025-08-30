<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$model = new OperationModel();
$get_state = $model->getState();

$spil_id = $this->uri->segment(4);
$sprilId =  _d($spil_id);


$placement = $this->uri->segment(5);
$placementSide =  _d($placement);

$parent_id = $model->getMemberUserId($sprilId);
$placedSide = $model->checkMemberIdexist($parent_id);
if($sprilId > 0 )
{

}
//echo "<pre>";print_r($ROW);die;

$user_id = $model->generateUserId();
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
       		
		
<div class="content-body" id="savecon"><!-- Basic Tables start -->
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">New Distributor Registration	</h4>
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
             
				
 
		
		<form class="form-horizontal" id="form">
		<input type="hidden" id="vermob" />
			<div class="form-body">
 
		   <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Sponcer Id <span class="red">*</span></label>
									<div class="col-md-9">
	<input class="form-control" name="sponsorId" onchange="checksposor(this.value);" id="sponsor_Id" type="text" value="<?php echo $ROW['user_id'];?>" placeholder="Sponsor Id" disabled="disabled">
		<input type="hidden" id="sponsorIdV" value="1" />
					  
	                            	</div>
		                        </div>
	       <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Sponcer Name <span class="red">*</span></label>
									<div class="col-md-9">
		<input class="form-control " name="sname" id="sname" type="text" value="<?php echo $ROW['first_name'];?>" disabled="disabled" placeholder="Sponsor Name">
					  
	                            	</div>
		                        </div>
		   <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Parent Id <span class="red">*</span></label>
									<div class="col-md-9">
	<input class="form-control" name="parentId" onchange="checksposor(this.value);" id="parentId" type="text" value="<?php echo $parent_id;?>" placeholder="Parent Id" disabled="disabled">
		<input type="hidden" id="sprill" value="<?php echo $sprilId;?>" />
	                            	</div>
		                        </div>
				
				   <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Parent Name <span class="red">*</span></label>
									<div class="col-md-9">
			<input class="form-control" name="parentname" id="parentName" type="text" value="<?php echo $placedSide;?>" disabled="disabled" placeholder="Parent Name" >
	                            	</div>
		                        </div>
					 
				
				  <input type="hidden" id="side" name="side" value="<?php echo $placementSide;?>" />	
				  
				    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">User Id <span class="red">*</span></label>
									<div class="col-md-9">
		<input class="form-control ucase" name="userId" id="userId" onkeypress="return isAlphaNumeric(event)" type="text" placeholder="User Id" value="<?php //echo $user_id;?>" maxlength="15" onchange="checkUserId(this.value);"   >
		<input type="hidden" id="userIdV" value="0" /> 
	                            	</div>
		                        </div>
				  
				 
				
			    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Name <span class="red">*</span></label>
									<div class="col-md-9">
		<input class="form-control ucase" name="first_name" id="first_name" onkeyup ="checkfirst_name(this.value);"  maxlength="30"  type="text" onkeypress="return isAlphaNumeric(event)" placeholder=" Name">
<input type="hidden" id="first_nameV" value="0" />
	                            	</div>
		                        </div>
				  
				
				
			    <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Mobile No. <span class="red">*</span></label>
									<div class="col-md-9">
		<input class="form-control" name="mobileNo" id="mobileNo" onKeyPress="return isNumberKey(event);" onchange="return IsMobileNumber(this.value);"  placeholder="99999 99999" maxlength="10" type="text">
<input type="hidden" id="mobileNoV" value="0" />
	                            	</div>
		                        </div>	
			 
	    	 
	           <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Email Id</label>
									<div class="col-md-9">
<input class="form-control" name="email" id="email" onblur="validateEmail(this);" placeholder="xyz@gmail.com" type="text">
<input type="hidden" id="emailV" value="0" />
	                            	</div>
		                        </div>	
	 

			        <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Password <span class="red">*</span></label>
									<div class="col-md-9">
<input class="form-control" name="password" id="password" onkeyup ="checkpass(this.value);" type="password" placeholder="Password">
		<input type="hidden" id="passwordV" value="0" />
	                            	</div>
		                        </div>	
	 
		
		           <div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Transaction Password <span class="red">*</span></label>
									<div class="col-md-9">
<input class="form-control" name="cpassword" id="cpassword" onkeyup ="checkcpass(this.value);" type="password" placeholder="Transaction Password">
		<input type="hidden" id="cpasswordV" value="0" />
	                            	</div>
		                        </div>	
		
			 
		
				 
  
		</div>
		</form>
		
	
		
	 
		
		
	
		
		 
	 
		
		
		<div class="wizard-actions" id="saveform">
		<button class="btn btn-success" id="savedata" onclick="submitdata();" ><i class="ace-icon fa fa-floppy-o"></i> Save   <i class="ace-icon fa fa-spinner fa-spin" id="spins" style="visibility:hidden;"></i></button>

	
		
		
		</div>
	 
		
	    </div>
    </div>
</div>

 </div>	
    </div>		
		     </div>
			 
			 
			 <div class="content-body" id="backform" style="display:none"><!-- Basic Tables start -->
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Congrats! 	</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a href="<?php echo BASE_PATH;?>member/"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                 <div class="card-body">
               
                <div class="card-text">
					<code> 		New Member has been registered successfully! Click back to go tree view!</code>	 
						
						
						</div> 
				
			 

	                        <div class="form-actions pull-right mb10">
	                        	<a href="<?php echo BASE_PATH;?>member/network/tree"   >    <button type="reset" class="btn btn-warning mr-1">
	                            	<i class="ft-reset"></i> Go to Tree
	                            </button> </a>
	                      
	                        </div>
	                
					
   </div> 	
    
        </div>
    </div>
</div>


    </div>					
		 
        </div>
      </div>
    </div>	
	
	
	 
  
 
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
 
	
	<input type="hidden" id="timertime" value="90" />
		 
	     <script>
$(document).ready(function(){

document.getElementById("package").value='0';


$("#type_id").children('option').hide();
$("#type_id").children("option[value=0]").show();
$('#type_id').val('0');


	
	
});

function submitdata()
{
  	var sponsorId = document.getElementById("sponsor_Id").value;
		var sprill      = document.getElementById("sprill").value;		
		var side      = document.getElementById("side").value;
		var userId    = document.getElementById("userId").value;
		var password  = document.getElementById("password").value;
		var cpassword  = document.getElementById("cpassword").value;
	
		var first_name = document.getElementById("first_name").value;
	
		var mobileNo    = document.getElementById("mobileNo").value;
		var email       = document.getElementById("email").value;
		

	var userIdV      =  document.getElementById("userIdV").value;
	var passwordV    = document.getElementById("passwordV").value;
	var cpasswordV   = document.getElementById("cpasswordV").value;
	

	var first_nameV  = document.getElementById("first_nameV").value;

	var mobileNoV    = document.getElementById("mobileNoV").value;
	var emailV       = document.getElementById("emailV").value;

if(email !='')
{

}
else
{
emailV='1';
}
   	
	var submitdata ='0';
	var packType ='0';
	

	if(userIdV =='1')
		{
		
	  if(passwordV == '1')
	  {
	      if(cpasswordV == '1')
	      { 

			 if(first_nameV =='1')
			 {			 
	
			 if(mobileNoV == '1')
			 {
			  if(emailV == '1')
			  {
			  
$("#spins").css("visibility", "visible");
				jQuery.ajax({
				type: "POST",
				url: "<?php echo BASE_PATH; ?>" + "member/account/addNewUser",
				data: {sponsorId:sponsorId,sprill:sprill,side:side,userId:userId,password:password,tpassword:cpassword,first_name:first_name,mobileNo:mobileNo,email:email},
				success: function(res) {
			//	alert(res);
				 //document.getElementById("term").value='2';
				 $("#spins").css("visibility", "hidden");
				 $("form")[0].reset();
				 
		
		$("#saveform").css("display", "none");
			$("#savecon").css("display", "none");
		$("#backform").css("display", "block");
		
			 
			
				$("#regis").css("display", "none");
		$("#successform").css("display", "block");

			}});
			  
			  
			   ////open model here
			   $(document).ready(function () {
 $('#optmodel').modal('hide');

});

			    
			  }
			else{
				 $("#emailDiv").removeClass("has-success");
 $("#emailDiv").addClass("has-error");
 $("#emailMsg").html('Please Enter a valid Email Address...');
  document.getElementById("emailV").value='0';
  alert('Please Enter a valid Email Address...');
				}
			  }
		     else{
				 $("#mobileNoDiv").removeClass("has-success");
 $("#mobileNoDiv").addClass("has-error");
 $("#mobileNoMsg").html('Please enter  valid mobile number...');
  document.getElementById("mobileNoV").value='0';
  alert('Please enter  valid mobile number...');
			      }
			
				
				
				}
				else
				{
 $("#first_nameDiv").removeClass("has-success");
 $("#first_nameDiv").addClass("has-error");
 $("#first_nameMsg").html(' Name Min 3 Char ...');
  document.getElementById("first_nameV").value='0';
  
  alert(' Name Min 3 Char ...');
  
				}
				

 		   
		 
		  
	     	
		
	      }
	       else
	  {
	  
	  $("#divcpass").removeClass("has-success");
 $("#divcpass").addClass("has-error");
 $("#cpassmsg").html('Transaction  Password should be 6 char / digit ...');
  document.getElementById("cpasswordV").value='0';
  alert('Transaction  Password should be 6 char / digit ...');
	  
	  }
	      
	  }
	  else
	  {
	  
	  $("#divpass").removeClass("has-success");
 $("#divpass").addClass("has-error");
 $("#passmsg").html('Password should be 6 char /digit ...');
  document.getElementById("passwordV").value='0';
  alert('Password should be 6 char /digit ...');
	  
	  }
	
	
	}
	    else
	    {
	     $("#useriddiv").removeClass("has-success");
         $("#useriddiv").addClass("has-error");
         $("#useriddivmsg").html('UserId Minimum 6 Digit / Char ...');

         document.getElementById("userIdV").value='0'
		 alert('Please Enter valid user Id');

     	}
}
function getproductname(id)
{
	  jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/getproductname",
data: {id: id},
success: function(res) {
//var data = jQuery.parseJSON(res);
//$("#type_id").html(data.type);
$("#productdesc").html(res);


}
});
}

 function checkPackage(id)
  {
     /* if(id==0){
        $("#type_id").children('option').hide();
        $("#type_id").children("option[value=0]").show();
        $('#type_id').val('0');
      }
      else if(id==1){
        $("#type_id").children('option').hide();
        $("#type_id").children("option[value=1]").show();
        $("#type_id").children("option[value=2]").show();
		$("#type_id").children("option[value^=3]").show();
        $("#type_id").children("option[value^=4]").show();
        $('#type_id').val('1');
      }
      else if(id==2){
        $("#type_id").children('option').hide();

        $("#type_id").children("option[value^=5]").show();
        $("#type_id").children("option[value^=6]").show();
        $("#type_id").children("option[value^=7]").show();
       
        $('#type_id').val('5');
      }
      else if(id==3){
        $("#type_id").children('option').hide();
		 $("#type_id").children("option[value^=8]").show();
        $("#type_id").children("option[value^=9]").show();
       
        $('#type_id').val('8');
      }  */
      	  jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/getselectedpackage",
data: {id: id},
success: function(res) {
var data = jQuery.parseJSON(res);
$("#type_id").html(data.type);
$("#productdesc").html(data.product);


}
});
if(id > 2 ){
document.getElementById("lft").style.display = "block";
document.getElementById("rth").style.display = "block";

}

else
{
document.getElementById("lft").style.display = "none";
document.getElementById("rth").style.display = "none";

}}

 function checkUserId(id)
  { 
  var le = id.length;
   var check_id = document.getElementById("sponsor_Id").value;
  // var check_id2 =document.getElementById("userIdL").value;
   
 if(le >= 6)
 {
 if(id != check_id  ) {
 

		
jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/checkuserid",
data: {userId: id},
success: function(res) {
 
if(res == '1')
{
$("#useriddiv").removeClass("has-success");
$("#useriddiv").addClass("has-error");
$("#useriddivmsg").html('Not Available...');
document.getElementById("userIdV").value='0'
}
else{
$("#useriddiv").removeClass("has-error");
$("#useriddiv").addClass("has-success");
$("#useriddivmsg").html('Available...');
document.getElementById("userIdV").value= '1'
}

} });

 
 
 }
 else
 {
 
$("#useriddiv").removeClass("has-success");
$("#useriddiv").addClass("has-error");
$("#useriddivmsg").html('User Id Mismatch');
document.getElementById("userIdV").value='0';
 }
 }
 else{
$("#useriddiv").removeClass("has-success");
$("#useriddiv").addClass("has-error");
$("#useriddivmsg").html('UserId Minimum 6 Digit / Char ...');
document.getElementById("userIdV").value='0';
 }} 
 
 function checkUserIdL(id)
 {
var le = id.length;
var check_id = document.getElementById("userId").value;
var check_id2 =document.getElementById("userIdR").value;
 if(le >= 6)
 {
 if(id != check_id && id != check_id2) {
 


		
jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/checkuserid",

data: {userId: id},
success: function(res) {
if(res=='1')
{
$("#lft").removeClass("has-success");
$("#lft").addClass("has-error");
$("#lftmsg").html('Not Available...');
document.getElementById("userIdLV").value='0';
}
else{

$("#lft").removeClass("has-error");
$("#lft").addClass("has-success");
$("#lftmsg").html('Available...');
document.getElementById("userIdLV").value='1';
}

}
});
 
 
 }
 else
 {
$("#lft").removeClass("has-success");
$("#lft").addClass("has-error");
$("#lftmsg").html('UserId Mismatch ...');
document.getElementById("userIdLV").value='0'
 }
 }
 else
 {
$("#lft").removeClass("has-success");
$("#lft").addClass("has-error");
$("#lftmsg").html('UserId Minimum 6 Digit / Char ...');
document.getElementById("userIdLV").value='0'
 }
 }
 function checkUserIdR(id)
 { 
var le = id.length;
 var check_id = document.getElementById("sponsor_Id").value;
var check_id2 =document.getElementById("userIdL").value;
 if(le >= 6)
 {
 if(id != check_id && id != check_id2) {
 


		
jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/checkuserid",

data: {userId: id},
success: function(res) {
if(res=='1')
{
$("#rth").removeClass("has-success");
$("#rth").addClass("has-error");
$("#rthmsg").html('Not Available...');
document.getElementById("userIdRV").value='0';
}
else{

$("#rth").removeClass("has-error");
$("#rth").addClass("has-success");
$("#rthmsg").html('Available...');
document.getElementById("userIdRV").value='1';
}

}
});
  
  
  }
  else
  {
$("#rth").removeClass("has-success");
$("#rth").addClass("has-error");
$("#rthmsg").html('Mismatch Id...');
document.getElementById("userIdRV").value='0';
  }
  }else{
$("#rth").removeClass("has-success");
$("#rth").addClass("has-error");
$("#rthmsg").html('UserId Minimum 6 Digit / Char ...');
document.getElementById("userIdRV").value='0';
  }
  } 
 function checksposor(id)
 {
jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/checksponcerid",

data: {userId: id},
success: function(res) {
if(res !='')
{
$("#sponsorId").removeClass("has-error");
$("#sponsorId").addClass("has-success");
$("#sponsorName").removeClass("has-error");
$("#sponsorName").addClass("has-success");
document.getElementById("sponsorIdV").value='1';
$("#sname").val(res);

}
else
{

$("#sponsorId").removeClass("has-success");
$("#sponsorId").addClass("has-error");
$("#sponsorName").removeClass("has-success");
$("#sponsorName").addClass("has-error");
$("#sname").val('Invalid Sponsor Id...');
document.getElementById("sponsorIdV").value='0';
}

}
});



 }
 function checkside(id)
 {
if(id !='')
{
$("#divside").removeClass("has-error");
$("#divside").addClass("has-success");
document.getElementById("sideV").value='1';
}
else
{
$("#divside").removeClass("has-success");
$("#divside").addClass("has-error");
document.getElementById("sideV").value='0';
}
 }
 function checkpass(len)
 {
 var l = document.getElementById("password").value;
 var le = l.length;
 if(le >= 6)
 {
 $("#divpass").removeClass("has-error");
 $("#divpass").addClass("has-success");
 $("#passmsg").html('');
 document.getElementById("passwordV").value='1';
 }
 else
 {
 $("#divpass").removeClass("has-success");
 $("#divpass").addClass("has-error");
 $("#passmsg").html('Password Length Minimum 6 Digit / Char ...');
  document.getElementById("passwordV").value='0';
 }
 }
 
  function checkcpass(len)
 {
 var l = document.getElementById("cpassword").value;
 var le = l.length;

 
if(le >= 6){
 $("#divcpass").removeClass("has-error");
 $("#divcpass").addClass("has-success");
 $("#cpassmsg").html('');
 document.getElementById("cpasswordV").value='1';
 }
 else
 { 
 $("#divcpass").removeClass("has-success");
 $("#divcpass").addClass("has-error");
 $("#cpassmsg").html('Transaction Password Length Minimum 6 Digit / Char ...');
  document.getElementById("cpasswordV").value='0';

 }
 
 }
 
  function checkPackagevali(id)
 {
if(id !='')
{
$("#divpackage").removeClass("has-error");
$("#divpackage").addClass("has-success");
document.getElementById("packageV").value='1';
}
else
{
$("#divpackage").removeClass("has-success");
$("#divpackage").addClass("has-error");
document.getElementById("packageV").value='0';
}
 }
 
 //Personal Info Validation
  function checkfirst_name(len)
 {
 var l = document.getElementById("first_name").value;
 var le = l.length;
 if(le >= 3)
 {
 $("#first_nameDiv").removeClass("has-error");
 $("#first_nameDiv").addClass("has-success");
 $("#first_nameMsg").html('');
 document.getElementById("first_nameV").value='1';
 }
 else
 {
 $("#first_nameDiv").removeClass("has-success");
 $("#first_nameDiv").addClass("has-error");
 $("#first_nameMsg").html(' Name Min 3 Char ...');
  document.getElementById("first_nameV").value='0';
 }
 }
  function checklast_name(len)
 {
 var l = document.getElementById("last_name").value;
 var le = l.length;
 if(le >= 3)
 {
 $("#last_nameDiv").removeClass("has-error");
 $("#last_nameDiv").addClass("has-success");
 $("#last_nameMsg").html('');
 document.getElementById("last_nameV").value='1';
 }
 else
 {
 $("#last_nameDiv").removeClass("has-success");
 $("#last_nameDiv").addClass("has-error");
 $("#last_nameMsg").html('Last Name Min 3 Char ...');
  document.getElementById("last_nameV").value='0';
 }
 }
  function checkfatherName(len)
 {
 var l = document.getElementById("fatherName").value;
 var le = l.length;
 if(le >= 3)
 {
 $("#fatherNameDiv").removeClass("has-error");
 $("#fatherNameDiv").addClass("has-success");
 $("#fatherNameMsg").html('');
 document.getElementById("fatherNameV").value='1';
 }
 else
 {
 $("#fatherNameDiv").removeClass("has-success");
 $("#fatherNameDiv").addClass("has-error");
 $("#fatherNameMsg").html('Father`s Name Min 3 Char ...');
  document.getElementById("fatherNameV").value='0';
 }
 }
  function isNumberKey(evt)
 { // Numbers only
					var charCode = (evt.which) ? evt.which : event.keyCode;
					if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;
					return true;
				}
 function isAlphaNumeric(e)
 { // Alphanumeric only
					var k;
					document.all ? k=e.keycode : k=e.which;
					return((k>47 && k<58)||(k>64 && k<91)||(k>96 && k<123)||k==0);
				}
 function ValidateAlpha(evt)
 {
        var keyCode = (evt.which) ? evt.which : evt.keyCode
        if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
         
        return false;
            return true;
    }			
 function validateEmail(emailField)
 {
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        if (reg.test(emailField.value) == false) 
        {
 //$("#emailDiv").removeClass("has-success");
 //$("#emailDiv").addClass("has-error");
 //$("#emailMsg").html('Please Enter a valid Email Address...');
  document.getElementById("emailV").value='0';
        }
		else{

 $("#emailDiv").removeClass("has-error");
 $("#emailDiv").addClass("has-success");
 $("#emailMsg").html('');
 document.getElementById("emailV").value='1';
 }}	
 
 function checkpancard(panVal)
{

var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
if(regpan.test(panVal)){
 $("#panDiv").removeClass("has-error");
 $("#panDiv").addClass("has-success");
 
 document.getElementById("panV").value='1';
}else 
{
 $("#panDiv").removeClass("has-success");
 $("#panDiv").addClass("has-error");
 document.getElementById("panV").value='0';
}

}
 	
 function IsMobileNumber(txtMobId) {


     var Number = txtMobId;
     var IndNum = /^[0]?[6789]\d{9}$/;

     if(IndNum.test(Number)){
 $("#mobileNoDiv").removeClass("has-error");
 $("#mobileNoDiv").addClass("has-success");
 $("#mobileNoMsg").html('');
 document.getElementById("mobileNoV").value='1';
    }

    else{
 $("#mobileNoDiv").removeClass("has-success");
 $("#mobileNoDiv").addClass("has-error");
 $("#mobileNoMsg").html('Please enter  valid mobile number...');
  document.getElementById("mobileNoV").value='0';
      
    }}	
			
			
			
			
			
			
			
			
			
			
			
var upgradeTime = document.getElementById("timertime").value;
var seconds = upgradeTime;
function timer() {
    var days        = Math.floor(seconds/24/60/60);
    var hoursLeft   = Math.floor((seconds) - (days*86400));
    var hours       = Math.floor(hoursLeft/3600);
    var minutesLeft = Math.floor((hoursLeft) - (hours*3600));
    var minutes     = Math.floor(minutesLeft/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML =   minutes + ":" + remainingSeconds;
    if (seconds == 0) {   
		start_timer(1);
		    $("#resendotp").prop('disabled', false);
			
			 $("#countdown").css("visibility", "hidden");
			//clearInterval(countdownTimer);
			//seconds =90;
		//document.getElementById("examsub").click();       
    }
	else
	{
        seconds--;
    }}
function start_timer(id=0)
{
			if(id==1)
			{
				  clearInterval(countdownTimer);
			}	
	var countdownTimer = setInterval('timer()', 1000);

		
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
	
