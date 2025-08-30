<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
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
			<li><span class="active">Payment Setting</span></li>
		</ul>
      <div class="row">
        <div class="col-md-12">
			<?php echo get_message(); ?>
          <div class="portlet light bordered">
             <h3 class="lighter block green">Payment settings</h3>
            <div class="portlet-body form">
              <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo MEMBER_PATH."account/paymentsetting"; ?>" method="post">
               
                <div class="space-2"></div>
                <div class="form-group">
                  <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Bitcoin  Address:</label>
                  <div class="col-xs-12 col-sm-9">
                    <div class="clearfix">
                      <input name="bitcoin_address" id="bitcoin_address"  class="form-control input-xlarge col-xs-12 col-sm-4" type="text" placeholder="Bitcoin Address" value="<?php echo $ROW['bitcoin_address']; ?>">
                    </div>
                  </div>
                </div>
               
               
                
                <div class="clearfix form-action">
                  <div class="col-md-offset-3 col-md-9">
                    <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                    <input type="hidden" name="member_id" id="member_id" value="<?php echo $ROW['member_id']; ?>">
                    <button type="submit" name="submitPaymentSetting" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Update </button>
     
                    
                  </div>
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
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
	});
</script>
</html>
