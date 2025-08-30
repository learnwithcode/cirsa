<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$segment = $this->uri->uri_to_assoc(2);
$member_id = $this->session->userdata('mem_id');
$AR_MEM = $model->getMember($member_id);

$AR_TMPL = $model->getMailTemplate("welcome_letter");
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
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>"> Home </a></li>
            <li class="active"> Welcome Letter </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-sm1">
            <div class="panel-body">
              <div class="panel panel-info news-wrap">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12 details">
                   
                      <div class="" id="welcomeLetter" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title"> <img src="<?php echo BASE_PATH; ?>theme/images/orange-dark.png" class="img-responsive" style="margin-left:auto; margin-right:auto;" /> </h4>
                            </div>
                            <div class="modal-body" style="margin-bottom:0px; padding-bottom:2px;">
                              <p class="cmntext" style="line-height:30px; text-align:justify"> Dear <b class="smalltxt" style="line-height:30px; text-align:justify"><?php echo $AR_MEM['user_name']; ?></b>,
							  
							  <?php echo $AR_TMPL['option_value']; ?>

Best Regards<br />
<strong><?php echo strtoupper(WEBSITE); ?> TEAM</strong>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default"  id="PrintNow" data-dismiss="modal">Print</button>
                            </div>
                          </div>
                        </div>
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
<script type="text/javascript" language="javascript" src="<?php echo BASE_PATH; ?>jquery/jquery.print.js"></script>
<script type="text/javascript">
$(function(){
	$("#backPassForm").validationEngine();
	$("#PrintNow").click(function(){$( ".modal-body" ).print(); return( false );});
	
});
</script>
</html>
