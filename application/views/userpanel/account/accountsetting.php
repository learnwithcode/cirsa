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
			<li><span class="active">Account Setting</span></li>
		</ul>
      <div class="row">
        <div class="col-md-12">
		<?php echo get_message(); ?>
          <div class="portlet light bordered">
            <h3 class="lighter block green">Edit your account settings</h3>
            <div class="portlet-body form">
              <form role="form" id="form-page" name="form-page" method="post" action="<?php echo MEMBER_PATH."account/accountsetting"; ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email From Administrator</label>
                  <input class="form-control" name="EMAIL_FROM_COMPANY" id="EMAIL_FROM_COMPANY" value="1" <?php if($model->getValueConfig("EMAIL_FROM_COMPANY")>0){ echo 'checked="checked"'; } ?> type="checkbox">
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email From Members</label>
                  <input class="form-control" name="EMAIL_FROM_UPLINE" id="EMAIL_FROM_UPLINE" value="1" <?php if($model->getValueConfig("EMAIL_FROM_UPLINE")>0){ echo 'checked="checked"'; } ?> type="checkbox">
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Log Ip Access</label>
                  <input class="form-control" name="LOG_IP" value="1" id="LOG_IP" <?php if($model->getValueConfig("LOG_IP")>0){ echo 'checked="checked"'; } ?> type="checkbox">
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Notify Account Changes</label>
                  <input class="form-control" name="NOTIFY_CHANGES" id="NOTIFY_CHANGES" value="1"  <?php if($model->getValueConfig("NOTIFY_CHANGES")>0){ echo 'checked="checked"'; } ?> type="checkbox">
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Display Name on Website</label>
                  <input class="form-control" name="DISPLAY_NAME" id="DISPLAY_NAME" value="1" <?php if($model->getValueConfig("DISPLAY_NAME")>0){ echo 'checked="checked"'; } ?>  type="checkbox">
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Display Email on Website</label>
                  <input class="form-control" name="DISPLAY_EMAIL" id="DISPLAY_EMAIL" value="1" <?php if($model->getValueConfig("DISPLAY_EMAIL")>0){ echo 'checked="checked"'; } ?>  type="checkbox">
                </div>
                <div class="form-group">
                  <button name="saveConfig" value="1" type="submit" class="btn btn-sm btn-primary m-t-n-xs">Save</button>
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
