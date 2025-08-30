<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$CONFIG_WEBSITE = $model->getValue("CONFIG_WEBSITE");
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
<script type="text/javascript">
	function copyToClipboard(text) {
  			window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
		}
</script>
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
      <input name="username" value="LADDU" type="hidden">
      <input id="c_id" value="10781846" type="hidden">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>">Home</a></li>
            <li class="active">Profile</li>
          </ul>
          <h3 class="page-header"><i class="fa fa-user"></i> Profile and Settings</h3>
        </div>
      </div>
      
	  
	  <div class="row hidden"> </div>
     
	 
<script>
		
		     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
		
		
		
		
		
		</script>
		  

	 

	 <div class="row"  style="background: #eee;">
	
	 <?php echo get_message(); ?>
	 
        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-lock"></i> Change Mobile </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="pass-message"></div>
              <div class="row passwordForm">
                <div class="col-md-12">
                  <form action="<?php  echo  generateMemberForm("account","security"); ?>" id="backPassForm" name="backPassForm" method="post" accept-charset="utf-8">
                    <div class="form-group">
                      <label for="current_password" class="col-md-12 control-label">Current Number</label>
                      <div class="clear">&nbsp;</div>
                    <input name="member_mobile" id="member_mobile" value="<?php echo $ROW['member_mobile']; ?>" readonly class="form-control" type="text">
                    </div>
                    <div class="form-group">
                      <label for="new_password" class="col-md-12 control-label">Update Number</label>
                      <div class="clear">&nbsp;</div>
                      <input name="new_mobile" value="" class="form-control validate[required,custom[integer]]" type="text" >
                    </div>
                    <div class="form-group">
                      <label for="new_again_password" class="col-md-12 control-label ">Enter password </label>
                      <div class="clear">&nbsp;</div>
                      <input name="password" value="" class="form-control validate[required]" id="confirm_user_password" type="password">
                    </div>
                    <div class="form-group">
						<input type="hidden" name="submitMemberSaveMobile" id="submitMemberSaveMobile" value="1" />
                      <input name="" value="Change Mobile" class="btn  btn-primary" id="backPass" type="submit">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
       <!--validate[required,custom[email]]-->

	   </div> 
	  
	  
	  
	    <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-lock"></i> Change password </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="pass-message"></div>
              <div class="row passwordForm">
                <div class="col-md-12">
         <form action="<?php  echo  generateMemberForm("account","security"); ?>" id="backPassForm" name="backPassForm" method="post" accept-charset="utf-8">
                    <div class="form-group">
                      <label for="current_password" class="col-md-12 control-label">Current password</label>
                      <div class="clear">&nbsp;</div>
                     <input name="old_password"  value="<?php echo $ROW['user_password']; ?>" class="form-control validate[required]" id="old_password" type="password">
                    </div>
                    <div class="form-group">
                      <label for="new_password" class="col-md-12 control-label">New password</label>
                      <div class="clear">&nbsp;</div>
                          <input name="user_password" value="" class="form-control validate[required]" id="user_password" type="password">
                    </div>
                    <div class="form-group">
                      <label for="new_again_password" class="col-md-12 control-label">New password again</label>
                      <div class="clear">&nbsp;</div>
                    <input name="confirm_user_password" value="" class="form-control validate[required,equals[user_password]]" id="confirm_user_password" type="password">
                    </div>
                    <div class="form-group">
                     
						<input type="hidden" name="submitMemberSavePassword" id="submitMemberSavePassword" value="1" />
                      <input name="" value="Change password" class="btn  btn-primary" id="backPass" type="submit">
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
       

	   </div>
	  
	  
        <div class="col-md-4">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-lock"></i> Change Email </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="pass-message"></div>
              <div class="row passwordForm">
                <div class="col-md-12">
                  <form action="<?php  echo  generateMemberForm("account","security"); ?>" id="backPassForm" name="backPassForm" method="post" accept-charset="utf-8">
                    <div class="form-group">
                      <label for="current_password" class="col-md-12 control-label">Current Email</label>
                      <div class="clear">&nbsp;</div>
                      <input name="old_email"  value="<?php echo $ROW['member_email'];?>" readonly class="form-control validate[required]" id="old_email" type="email">
                    </div>
                    <div class="form-group">
                      <label for="new_password" class="col-md-12 control-label">New Email</label>
                      <div class="clear">&nbsp;</div>
                      <input name="user_email" value="" class="form-control validate[required,custom[email]]" id="user_email" type="email">
                    </div>
                    <div class="form-group">
                      <label for="new_again_password" class="col-md-12 control-label">Enter password</label>
                      <div class="clear">&nbsp;</div>
                      <input name="password" value="" class="form-control validate[required,equals[user_password]]" id="confirm_user_password" type="password">
                    </div>
                    <div class="form-group">
						<input type="hidden" name="submitMemberSaveEmail" id="submitMemberSaveEmail" value="1" />
                      <input name="" value="Change Email" class="btn  btn-primary" id="backPass" type="submit">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
       

	   </div> 
	  
	  
	  
	  
	 
	  </div>
      
	





	
	 
   <!--<div class="row">
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-user"></i> Support PIN </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="support_pin_message"><span class="error"></span><span class="success"></span></div>
              <div class="row supportPinForm">
                <div class="col-md-3">
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" id="supportPinForm" method="post" accept-charset="utf-8">
                    <div class="form-group">
                      <label for="supportPinBtn">Generate Support PIN</label>
                      <input name="" value="Generate" class="btn btn-primary" id="supportPinBtn" type="submit">
                      </div>
                  </form>
                </div>
                <div class="col-md-3">
                  <h3><span id="supportPin"></span></h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>-->
      <div class="clearExtended">&nbsp;</div>
     
      <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
    </div>
  </div>
</div>
<div class="modal" id="load-personalized" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Send personalized invitation</h4>
      </div>
      <div class="modal-body">
        <div class="login-box">
          <div id="row">
            <div class="input-box frontForms">
              <div class="row">
			  <?php echo display_message(); ?>
                <div class="col-md-12 col-xs-12">
           			
                  <form action="<?php echo  generateMemberForm("account","profile",array("")); ?>" id="otpForm" name="otpForm" method="post">	
				  	
                    <div class="form-group">
                      <label for="transaction_password">Email Address:</label>
                      <input type="text" name="mail_email" id="mail_email" placeholder="Use comma for multiple email address" value="" class="form-control validate[required]"/>
                      <div class="clear">&nbsp;</div>
                    </div>
					<div class="form-group">
                      <label for="transaction_password">Text:</label>
                      <textarea name="email_body" class="form-control validate[required]" id="email_body" style="width:540px; height:200px;">Hi,<br /> i like to invite for free joining of <?php echo WEBSITE; ?>,<br /> you can register your-self with using my referral link: <br /> <?php echo BASE_PATH.$ROW['user_name'];  ?><br /><br /><br /><br /><br />Regards,<br /><?php echo $CONFIG_WEBSITE; ?></textarea>
                      <div class="clear">&nbsp;</div>
                    </div>
                    
                    <div class="form-group">
					<input type="hidden" name="email_subject" id="email_subject" value="<?php echo $ROW['first_name']." ".$ROW['first_name'];  ?> has invited to join <?php echo  $CONFIG_WEBSITE; ?>" />
                      <input type="submit" name="sendMessage" value="Send" class="btn btn-primary btn-submit" id="sendMessage"/>
					  &nbsp;&nbsp;
					  <input type="button" name="closeButton" value="Close" class="btn btn-danger btn-submit"  data-dismiss="modal" id="closeButton"/>
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
</div>
</body>
<script src="<?php echo BASE_PATH; ?>tiny/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	var jsUrlPath = "<?php echo BASE_PATH; ?>";
	
	$("#backPassForm").validationEngine();
	$("#backTrPassForm").validationEngine();
	$("#backChangeEmailForm").validationEngine();
	$("#changeUserInfoForm").validationEngine();
	$("#bankDetailsForm").validationEngine();
	$("#form_avatar").validationEngine();
	$("#send-personalized-invitation").on('click',function(){
		$("#load-personalized").modal('show');
	});
	
	
	bkLib.onDomLoaded(function() {
		new nicEditor({iconsPath : jsUrlPath+'tiny/nicEditorIcons.gif', maxHeight : 150}).panelInstance('email_body');
	});
	
	$("#resetTrPassword").on('click',function(){
		var confirm_message = confirm('Make sure you want to reset your transaction password?');
		if(confirm_message){
			var  URL_LOAD = "<?php echo BASE_PATH; ?>json/jsonhandler?switch_type=RESET_TRNS";
			$.getJSON(URL_LOAD,function(JsonEval){
				if(JsonEval.count_ctrl>0){
					$("#resetTrPassword").hide();
					$(".resetMsg").html('<div class="alert alert-success">Pasword reset, please check your mail</div>');
				}
			});
		}
	});
});
</script>
</html>
