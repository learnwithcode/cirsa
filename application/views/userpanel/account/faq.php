<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$QR_PAGES="SELECT tf.* FROM ".prefix."tbl_faq AS tf   WHERE tf.faq_delete>0  AND tf.faq_active>0 $StrWhr ORDER BY tf.faq_id ASC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
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
            <li class="active"> Faq's </li>
          </ul>
        </div>
      </div>
      <div class="price-list row">
        <!-- Accordians -->
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-cascade">
              <div class="panel-heading">
                <h3 class="panel-title text-primary"> FAQ's </h3>
              </div>
              <div class="panel-body ">
                <div class="panel-group" id="accordion">
				 <?php $Ctrl=1;
				  foreach($PageVal['ResultSet'] as $AR_DT): ?>
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $Ctrl; ?>">
                        <h4 class="sm"><?php echo $AR_DT['faq_question']; ?>? </h4>
                        </a> </h4>
                    </div>
                    <div id="collapse<?php echo $Ctrl; ?>" class="panel-collapse collapse">
                      <div class="panel-body">
                        <p class="sm"><?php echo $AR_DT['faq_answer']; ?></p>
                      </div>
                    </div>
                  </div>
				  <?php $Ctrl++; endforeach; ?>
                   <?php if(count($PageVal['ResultSet'])==0){ echo  "<div class='alert alert-block alert-danger' id='jsCallId'><i class='ace-icon fa fa-times red'></i>&nbsp;No faq found.</div>";} ?>
                </div>
              </div>
              <!-- /panel body -->
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
