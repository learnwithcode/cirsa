<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
<div class="clearfix"> </div>
<div class="page-container">
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
  <div class="page-content-wrapper">
    <div class="page-content">
     <ul class="page-breadcrumb breadcrumb">
			<li><a href="javascript:void(0)">My Account </a><i class="fa fa-circle"></i></li>
			<li><span class="active">Change Password</span></li>
		</ul>
      <div class="row">
        <div class="col-md-12">
		<?php echo get_message(); ?>
          <div class="portlet light bordered">
            <h3 class="lighter block green">Change Password</h3>
            <div class="portlet-body form">
              <form  name="form-valid" id="form-valid" method="post" class="form-horizontal" action="<?php echo MEMBER_PATH."account/changepassword"; ?>">
						<div class="space-2"></div>
                        <div class="form-group">
                          <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">User-Id:</label>
                          <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
							 
                              <input name="user_id" id="user_id"  class="form-control input-xlarge validate[required,minSize[6]]" type="text" readonly="true" placeholder="" value="<?php echo $ROW['user_id']; ?>"> 
                            </div>
                          </div>
                        </div>
                        <div class="space-2"></div>
                        <div class="form-group">
                          <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">New - Password:</label>
                          <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
							 <input name="old_password" id="old_password" class="form-control input-xlarge validate[required]" type="hidden" placeholder="current password" 
							 value="<?php echo $ROW['user_password']; ?>">
                              <input name="user_password" id="user_password"  class="form-control input-xlarge validate[required,minSize[6]]" type="password" placeholder="new password" value=""> 
                            </div>
                          </div>
                        </div>
                        <div class="space-2"></div>
						 <div class="form-group">
                          <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Confirm - Password:</label>
                          <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                              <input name="confirm_user_password" id="confirm_user_password"  class="form-control input-xlarge validate[required,equals[user_password]]" type="password" placeholder="confirm password" value=""> 
                            </div>
                          </div>
                        </div>
                        <div class="space-2"></div>
						<hr>
						<div class="wizard-actions">
						<input type="hidden" name="member_id" id="member_id" value="<?php echo $ROW['member_id'];  ?>">
						<button name="submitMemberSavePassword" type="submit"  value="1" class="btn btn-success"> <i class="ace-icon fa fa-lock"></i> Update Password </button>
						</div>
                        </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
</body>
</html>
