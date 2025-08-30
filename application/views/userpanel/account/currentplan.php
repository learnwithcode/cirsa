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
			<li><span class="active">Membership Type</span></li>
		</ul>
      <div class="row">
        <div class="col-md-12">
		<?php echo get_message(); ?>
          <div class="portlet light bordered">
            <h3 class="lighter block green">Plan Information</h3>
            <div class="portlet-body form">
				<div class="space-2"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Plan Type : </label>
	                  <div class="clearfix"><strong><?php echo ($PLAN['package_name'])? $PLAN['package_name']:"FREE PLAN"; ?></strong></div>
                </div>
				<div class="space-2"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Reg Date :</label>
                  <div class="clearfix"><strong><?php echo $ROW['date_join']; ?></strong></div>
                </div>
				<div class="space-2"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">My Sponsor: </label>
                   <div class="clearfix"><strong><?php echo ($ROW['spsr_user_id'])? $ROW['spsr_user_id']:"Admin"; ?></strong></div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Sponsor Name :</label>
                   <div class="clearfix"><strong><?php echo ($ROW['spsr_first_name'])? $ROW['spsr_first_name']:"Admin"; ?></strong></div>
                </div>
				
				<?php if($PLAN['date_from']!='0000-00-00 00:00:00' && $PLAN['date_from']!=''){ ?>
				<div class="space-2"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Plan Active From :</label>
                   <div class="clearfix"><strong><?php echo $PLAN['date_from']; ?></strong></div>
                </div>
				<?php } ?>
				<?php if($PLAN['date_expire']!='0000-00-00 00:00:00' && $PLAN['date_expire']!=''){ ?>
				<div class="space-2"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Plan Expire :</label>
                   <div class="clearfix"><strong><?php echo $PLAN['date_expire']; ?></strong></div>
                </div>
				<?php } ?>
				<?php if($PLAN['bonus_active_from']!='0000-00-00 00:00:00' && $PLAN['bonus_active_from']!=''){ ?>
				<div class="space-2"></div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Bonus Plan Active From :</label>
                   <div class="clearfix"><strong><?php echo $PLAN['bonus_active_from']; ?></strong></div>
                </div>
				<?php } ?>
				<div class="space-2"></div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Clicks Per day :</label>
                   <div class="clearfix"><strong><?php echo number_format($PLAN['click_per_day']); ?></strong></div>
                </div>
				<?php if($PLAN['bonus_click_per_day']>0){ ?>
				<div class="space-2"></div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Bonus Clicks Per day :</label>
                   <div class="clearfix"><strong><?php echo number_format($PLAN['bonus_click_per_day']); ?></strong></div>
                </div>
				<?php } ?>
				<?php if($PLAN['total_click_per_day']>0){ ?>
				<div class="space-2"></div>
				<div class="form-group">
                  <label class="col-sm-2 control-label">Total Clicks Per day :</label>
                   <div class="clearfix"><strong><?php echo number_format($PLAN['total_click_per_day']); ?></strong></div>
                </div>
				<?php } ?>
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
