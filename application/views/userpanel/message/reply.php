<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$segment = $this->uri->uri_to_assoc(2);
$message_id = _d($segment['message_id']);
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
	.minheight{
		min-height:1200px;
	}
</style>
<script src="<?php echo BASE_PATH; ?>tiny/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
	var jsUrlPath = "<?php echo BASE_PATH; ?>";
	bkLib.onDomLoaded(function() {
		new nicEditor({iconsPath : jsUrlPath+'tiny/nicEditorIcons.gif', maxHeight : 150}).panelInstance('message');
	});
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
      <div class="row" style="margin-bottom:30px;">
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo BASE_PATH; ?>"> Home </a></li>
            <li class="active"> Reply </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-sm">
            <div class="panel-body">
              <div class="panel panel-info news-wrap">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12">
						<?php get_message(); ?>
                      <form action="<?php echo  generateMemberForm("message","reply",array("")); ?>" id="form-valid" name="form-valid" method="post">
					  	 
                        
                        <div class="form-group">
                          <label for="transaction_password">Message:</label>
                          <textarea name="message" class="form-control validate[required]" id="message" style="width:100%; height:300px; background-color:#fff;"></textarea>
                          <div class="clear">&nbsp;</div>
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="message_id" id="message_id" value="<?php echo _e($message_id); ?>" />
                          <input type="submit" name="submitReply" value="Send" class="btn btn-primary btn-submit" id="submitReply"/>
                          &nbsp;&nbsp;
                          <input type="button" name="closeButton" value="Close" class="btn btn-danger btn-submit"  data-dismiss="modal" id="closeButton"/>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /panel 1 -->
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
	$("#backPassForm").validationEngine();
	
});
</script>
</html>
