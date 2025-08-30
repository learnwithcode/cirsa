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
      <div class="row">
        <div class="col-md-12">
			<?php echo get_message(); ?>
          <div class="panel panel-primary">
            <div class="panel-heading"> <span data-original-title="The invite link is your personal sponsor link. If you send this link to a person and they click on the link and choose to signup,  they will be in your sales organization." id="invite_link_tooltip" class="tooltip-icon fa fa-question pull-right" title=""></span>
              <h3 class="panel-title text-white"> <i class="fa fa-link"></i> Invite link </h3>
            </div>
            <div class="panel-body">
              <div class="row inviteLink">
                <div class="col-md-2">
                  <label for="invititation-link"> Your invite link is: </label>
                </div>
                <div class="col-md-10">
                  <input id="invititation-link" onclick="copyToClipboard(document.getElementById('invititation-link').value)"  value="<?php echo BASE_PATH.$ROW['user_name'];  ?>" style="border: none; cursor: pointer; font-weight: bold;" class="col-xs-12 js-select" type="text" readonly="true">
                </div>
              </div>
              <div class="row signUpMember">
                <div class="col-md-6 col-xs-12"> <a target="_blank" class="btn btn-primary col-xs-12" href="<?php echo BASE_PATH.$ROW['user_name'];  ?>">Click here to sign up a new member with you as a sponsor</a> </div>
                <div class="col-md-6 col-xs-12">
                  <button type="button" class="btn btn-primary col-xs-12" id="send-personalized-invitation">Send personalized invitation</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-primary">
            <div class="panel-heading"> <span data-original-title="The placement setting are important for you to set according to how you intend to build your organization. Alternative will place every other team member on the left or the right side of your genealogy tree." id="placement_of_new_members_tooltip" class="tooltip-icon fa fa-question pull-right" title=""></span>
              <h3 class="panel-title text-white"> <i class="fa fa-sitemap"></i> Placement of new members </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="side-message"></div>
              <div class="row placementForm">
                <div class="col-md-12">
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" id="backPlacementForm" method="post" accept-charset="utf-8">
                    <div class="input-group">
                      <input name="MEM_PLACEMENT" value="AUTO" <?php if($model->getValueConfig("MEM_PLACEMENT")=="AUTO" || $model->getValueConfig("MEM_PLACEMENT")==""){ echo 'checked="checked"'; } ?> type="radio">
                      <label for="placement">Alternatively left/right</label>
                    </div>
                    <div class="input-group">
                      <input name="MEM_PLACEMENT" value="LEFT" <?php if($model->getValueConfig("MEM_PLACEMENT")=="LEFT" || $model->getValueConfig("MEM_PLACEMENT")==""){ echo 'checked="checked"'; } ?>  type="radio">
                      <label for="placement">Left</label>
                    </div>
                    <div class="input-group">
                      <input name="MEM_PLACEMENT" value="RIGHT" <?php if($model->getValueConfig("MEM_PLACEMENT")=="RIGHT"){ echo 'checked="checked"'; } ?> type="radio">
                      <label for="placement">Right</label>
                    </div>
                    <div class="input-group">
					<input type="hidden" name="savePlacement" value="1" />
                      <input name="backPlacement" value="Save settings" class="btn  btn-primary" id="backPlacement" type="submit">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
      <div class="row hidden"> </div>
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-lock"></i> Change password </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="pass-message"></div>
              <div class="row passwordForm">
                <div class="col-md-12">
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" id="backPassForm" name="backPassForm" method="post" accept-charset="utf-8">
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
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-lock"></i> Change transaction password </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="trans-message"></div>
              <div class="row passwordForm">
                <div class="col-md-12">
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" id="backTrPassForm" name="backTrPassForm" method="post" accept-charset="utf-8">
                    <div class="form-group">
                      <label for="current_tr_password" class="col-md-12 control-label">Current transaction password</label>
                      <div class="clear">&nbsp;</div>
                      <input name="current_tr_password"  class="form-control validate[required]" id="current_tr_password" type="text"  value="<?php echo $ROW['trns_password']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="new_tr_password" class="col-md-12 control-label">New transaction password</label>
                      <div class="clear">&nbsp;</div>
                      <input name="new_tr_password" value="" class="form-control validate[required]" id="new_tr_password" type="password">
                    </div>
                    <div class="form-group">
                      <label for="new_tr_password_again" class="col-md-12 control-label">New transaction password again</label>
                      <div class="clear">&nbsp;</div>
                      <input name="new_tr_password_again" value="" class="form-control validate[required,equals[new_tr_password]]" id="new_tr_password_again" type="password">
                    </div>
                    <div class="form-group">
						<input type="hidden" name="submitMemberSaveTrnsPassword" id="submitMemberSaveTrnsPassword" value="1" />
                      <input name="" value="Change  transaction password" class="btn  btn-primary" id="backTrPass" type="submit">
                      <div class="pull-right"><a id="resetTrPassword" class="btn btn-danger" href="javascript:void(0)">Reset transaction Password</a> </div>
					  <div class="resetMsg"></div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-envelope"></i> Change email </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="row changeEmailForm">
                <div class="col-md-8">
                  <div class="col-md-12">
                    <div class="email-message"></div>
                  </div>
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" id="backChangeEmailForm" name="backChangeEmailForm" method="post" accept-charset="utf-8">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Current e-mail address</label>
                        <div class="clear">&nbsp;</div>
                        <?php echo $ROW['member_email']; ?> </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="change_email" class="control-label">Email</label>
                        <div class="clear">&nbsp;</div>
                        <input name="change_email" value="" class="form-control validate[required,custom[email]]" id="change_email" type="text">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="transaction_password" class="control-label">Transaction password</label>
                        <div class="clear">&nbsp;</div>
                        <input name="transaction_password" value="" class="form-control validate[required]" id="transaction_password" type="password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
					  	<input type="hidden" name="changeEmail" id="changeEmail" value="1" />
                        <input name="" value="Change email" class="btn  btn-primary" id="backChangeEmail" type="submit">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
	  <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-mobile"></i> Change Mobile </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="row changeEmailForm">
                <div class="col-md-12">
                  <div class="col-md-12">
                    <div class="email-message"></div>
                  </div>
                  <form action="<?php  echo  generateMemberForm("account","profile",""); ?>" id="backChangeEmailForm" name="backChangeEmailForm" method="post" accept-charset="utf-8">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Current mobile number</label>
                        <div class="clear">&nbsp;</div>
                        <?php echo $ROW['mobile_number']; ?> </div>
                    </div>
					<div class="col-md-6">
                      <div class="form-group">
                        <label for="change_email" class="control-label">Country </label>
                        <div class="clear">&nbsp;</div>
                        <select name="country_code" id="country_code" class="form-control">
								<?php DisplayCombo($ROW['country_code'],"COUNTRY"); ?>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="change_email" class="control-label">Mobile number</label>
                        <div class="clear">&nbsp;</div>
                        <input name="member_mobile" id="member_mobile" value="<?php echo $ROW['member_mobile']; ?>" class="form-control" type="text">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="transaction_password" class="control-label">Transaction password</label>
                        <div class="clear">&nbsp;</div>
                        <input name="transaction_password" value="" class="form-control validate[required]" id="transaction_password" type="password">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
					  	<input type="hidden" name="changeMobile" id="changeMobile" value="1" />
                        <input name="" value="Update Number" class="btn  btn-primary" id="backChangeEmail" type="submit">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-adjust"></i> Change user info </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="row userInfoForm">
                <div class="col-md-12">
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" id="changeUserInfoForm" name="changeUserInfoForm" method="post" accept-charset="utf-8">
                    <div class="form-group">
                      <label for="first_name">First name</label>
                      <div class="clear">&nbsp;</div>
                      <input name="first_name" value="<?php echo $ROW['first_name'] ?>" class="form-control validate[required]" type="text">
                    </div>
                    <div class="form-group">
                      <label for="last_name">Last name</label>
                      <div class="clear">&nbsp;</div>
                      <input name="last_name" value="<?php echo $ROW['last_name'] ?>" class="form-control validate[required]" type="text">
                    </div>
                    <div class="form-group">
                      <label for="country">Country</label>
                      <div class="clear">&nbsp;</div>
                      <select name="country_code" id="country_code" class="form-control">
								<?php DisplayCombo($ROW['country_code'],"COUNTRY"); ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="mobile">Mobile phone</label>
                      <div class="clear">&nbsp;</div>
                      <input name="member_mobile" id="member_mobile" value="<?php echo $ROW['member_mobile']; ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                      <label for="city">City</label>
                      <div class="clear">&nbsp;</div>
                      <input name="city_name" id="city_name" value="<?php echo $ROW['city_name']; ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                      <label for="zip">ZIP Code</label>
                      <div class="clear">&nbsp;</div>
                      <input name="pin_code" id="pin_code" value="<?php echo $ROW['pin_code']; ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                      <label for="address1">address</label>
                      <div class="clear">&nbsp;</div>
                      <textarea name="current_address" class="form-control"><?php echo $ROW['current_address']; ?></textarea>
                    </div>
                   
                    <div class="form-group">
                      <label for="dateOfBirth">Date of birth (dd.mm.YYYY) </label>
                      <div class="clear">&nbsp;</div>
                      <input name="date_of_birth" value="<?php echo getDateFormat($ROW['date_of_birth'],"d"); ?>.<?php echo getDateFormat($ROW['date_of_birth'],"m"); ?>.<?php echo getDateFormat($ROW['date_of_birth'],"Y"); ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                      <label for="placeOfBirth">Place of birth</label>
                      <div class="clear">&nbsp;</div>
                      <input name="place_of_birth" value="<?php echo $ROW['place_of_birth']; ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                      <label for="idCountry">Country of birth</label>
                      <div class="clear">&nbsp;</div>
                      <select name="country_of_birth" id="country_of_birth" class="form-control">
                       		<?php DisplayCombo($ROW['country_of_birth'],"COUNTRY"); ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="passportId">Passport/ID Card Number</label>
                      <div class="clear">&nbsp;</div>
                      <input name="passport_no" value="<?php echo $ROW['passport_no']; ?>" class="form-control" type="text">
                    </div>
                    <div class="form-group">
                      <label for="passport-expiry-date">Passport/ID Card Expiry Date</label>
                      (dd.mm.YYYY)
                      <div class="clear">&nbsp;</div>
                      <input name="passport_valid_date" value="<?php echo $ROW['passport_valid_date']; ?>" class="form-control" type="text">
                    </div>
                  	  <div class="form-group">
					<input type="hidden" name="submitMemberSave" value="1" />
                      <input name="" value="Save" class="btn btn-primary saveUserInfo" type="submit">
                    </div>
                    <div class="user_info_message"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          		
		  <div class="clearfix"></div>
		  <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-btc"></i> ShineHerb </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="row BankDetails">
                <div class="col-md-12">
                  <div id="bankErrors" class="alert alert-danger hidden"></div>
                  <div id="bankSuccess" class="alert alert-success hidden"></div>
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" id="bankDetailsForm" name="bankDetailsForm" method="post" accept-charset="utf-8">
                    <div class="form-group">
                      <label for="bitcoin_address">ShineHerb </label>
                      <input name="bitcoin_address" id="bitcoin_address" value="<?php echo $ROW['bitcoin_address']; ?>" class="form-control validate[required]" type="text">
                    </div>
					<div class="form-group">
                      <label for="bitcoin_address">Transaction Password</label>
                      <input name="trns_password" id="trns_password" value="" class="form-control validate[required]" type="PASSWORD">
                    </div>
                    
                    
                    <div class="form-group">
                      <input name="bitCoinBtn" value="Save" class="btn btn-primary" id="bitCoinBtn" type="submit">
                       </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-user"></i> Upload your avatar </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="user_avatar_message"><span class="error"></span><span class="success"></span></div>
              <div class="row userInfoForm">
                <div class="col-md-4">
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" method="post"  class="form_avatar" id="form_avatar" 
				  enctype="multipart/form-data">
                    <div class="form-group">
                      <label>upload image</label>
                      <div class="clear">&nbsp;</div>
                      <input name="avatar_name" value="" class="form-control" id="avatar_name" type="file">
                    </div>
					<button type="submit" name="updateProfileAvatar" value="1" id="do-upload-avatar" class="btn btn-primary test">Upload</button>
                  </form>
                  
                </div>
                <div class="col-md-4">
                  <div class="form-group"> Current:
                    <div class="clear">&nbsp;</div>
                    <img src="<?php echo getMemberImage($ROW['member_id']); ?>" style="width: 50px;height: 50px;"> </div>
                </div>
                <div class="col-md-8"></div>
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
