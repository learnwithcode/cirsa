<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

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
      <div class="row">
        <div class="col-md-8"> <?php echo get_message(); ?>
          <div class="portlet light bordered">
            <h3 class="lighter block green">Change Transaction Password</h3>
            <div class="portlet-body form">
              <form  name="form-valid" id="form-valid" method="post" class="form-horizontal" action="<?php echo MEMBER_PATH."/transactionpassword"; ?>">
                <div class="space-2"></div>
                <div class="form-group">
                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">New - Password:</label>
                  <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                      <input name="old_password" id="old_password" class="form-control input-xlarge validate[required]" type="hidden" placeholder="current password" 
							 value="<?php echo $ROW['trns_password']; ?>">
                      <input name="trns_password" id="trns_password"  class="form-control input-xlarge validate[required,minSize[6]]" type="password" 
							  placeholder="New transaction password" value="">
                    </div>
                  </div>
                </div>
                <div class="space-2"></div>
                <div class="form-group">
                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Confirm - Password:</label>
                  <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                      <input name="confirm_trns_password" id="confirm_trns_password"  class="form-control input-xlarge validate[required,equals[trns_password]]" type="password" placeholder="Confirm transaction password" value="">
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
      <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
      <!-- /.content -->
    </div>
  </div>
</div>
</body>
<script type="text/javascript">
	$(function(){
		$(".open_modal").on('click',function(){
			$('#setTrPasswordModal').modal('show');
			return false;
		});
		$("#backTrPassForm").validationEngine();
		<?php if($request_id>0){ ?>
			$('#verifyOTP').modal('show');
		<?php } ?>
		$("#otpForm").validationEngine();
	});
</script>
</html>
