<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

	
	$QR_PAGES="SELECT tf.* FROM ".prefix."tbl_faq AS tf   WHERE tf.faq_delete>0 $StrWhr ORDER BY tf.faq_id ASC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
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
        <div class="col-md-12"> <?php echo get_message(); ?>
          <div class="portlet light bordered">
            <h3 class="lighter block green">FAQ</h3>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<?php 
			if($PageVal['TotalRecords'] > 0){
			$Ctrl=1;
			foreach($PageVal['ResultSet'] as $AR_DT):
			?>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading<?php echo $Ctrl; ?>">
                  <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $Ctrl; ?>" aria-expanded="false" aria-controls="collapse<?php echo $Ctrl; ?>"><i class="fa fa-arrow-right"></i> <?php echo $AR_DT['faq_question']; ?>  </a> </h4>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapse<?php echo $Ctrl; ?>" class="panel-collapse collapse" role="tabpane<?php echo $Ctrl; ?>" aria-labelledby="heading<?php echo $Ctrl; ?>">
                  <div class="panel-body"> <?php echo $AR_DT['faq_answer']; ?> </div>
                </div>
              </div>
		   <?php $Ctrl++; endforeach; } ?>
			  
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
