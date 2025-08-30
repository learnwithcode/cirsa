<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
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
            <li class="active"> Message </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-sm">
            <div class="panel-body">
              <div class="panel panel-info news-wrap">
                <div class="panel-body">
			  	<a href="javascript:void(0)" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> &nbsp;Back</a>
                  <div class="row">
                    <div class="col-md-12">
						<?php get_message(); ?>
						
						<div class="col-md-12">
                      <h3> <?php echo $ROW['subject']; ?> </h3>
                      <span class="date"> <i class="fa fa-calendar"></i> <?php echo getDateFormat($ROW['date_time'],"d M Y"); ?> </span>
                      <p> <?php echo $ROW['message']; ?> </p>
                      </div>
						
						
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
