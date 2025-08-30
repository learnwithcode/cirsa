<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$member_id = $this->session->userdata('mem_id');
	
	$CONFIG_PLAN_UPGRADE_FROM_DAY=$model->getValue("CONFIG_PLAN_UPGRADE_FROM_DAY");
	$CONFIG_PLAN_UPGRADE_TO_DAY=$model->getValue("CONFIG_PLAN_UPGRADE_TO_DAY");
	
	$AR_DT = $model->getMember($member_id);
	$AR_PACK = $model->getPackageDetail($AR_DT['package_id']);
	
	$AR_PLAN = $model->getCurrentMemberShip($member_id);

	
	$today_date = InsertDate(getLocalTime());
	$plan_active_date = InsertDate($AR_PLAN['date_from']);
	
	$active_day = $CONFIG_PLAN_UPGRADE_FROM_DAY-1;
	$start_day = $CONFIG_PLAN_UPGRADE_FROM_DAY;
	$end_day = $CONFIG_PLAN_UPGRADE_TO_DAY;
	
	$plan_upgrade_date = InsertDate(AddToDate($plan_active_date,"+$active_day Day"));
	$start_active_date = InsertDate(AddToDate($plan_active_date,"+$start_day Day"));
	$last_active_date = InsertDate(AddToDate($plan_active_date,"+$end_day Day"));

	$LDGR = $model->getCurrentBalance($member_id,'','','');
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
			<li><a href="javascript:void(0)">Financial </a><i class="fa fa-circle"></i></li>
			<li><span class="active">Upgrade Membership</span></li>
		</ul>
      <div class="row">
        <div class="col-md-12"> <?php echo get_message(); ?>
          <div class="portlet light bordered">
            <div class="panel-body">
              <div class="main pagesize">
                <!-- *** mainpage layout *** -->
                <div class="main-wrap">
                  <div class="content-box">
                    <div class="box-body">
                      <div class="box-wrap clear">
                        <h2>Upgrade Membership </h2>
                        <br>
                        <div class="actions">
							<?php if( ( strtotime($today_date)>strtotime($plan_upgrade_date) && strtotime($today_date)>=strtotime($start_active_date) && strtotime($today_date)<=strtotime($last_active_date) ) || ($AR_PLAN['package_id']=='') ){ ?>
                          <form id="form-page" name="form-page" method="post" action="<?php echo generateMemberForm("financial","upgrademembership",""); ?>" >
                            <h5>Membership: <strong><?php echo $AR_PACK['package_name']; ?></strong></h5>
                            <?php if($AR_PLAN['package_id']!=''){ ?><h5>Membership Expiration: <strong><?php echo getDateFormat($AR_PLAN['date_expire'],"d D M Y"); ?></strong></h5><?php  } ?>
                            <br>
                            <p>Upgrade to this Membership : </p>
                            <select class="form-control input-xlarge form-half validate[required]" name="package_id" id="package_id">
								<option value="" selected="selected">---select----</option>
                             	<?php echo $model->getPackageList($member_id); ?>
                            </select>
                            <br>
                            <div class="loadPackage">
								
							</div>
							
							<button type="submit" name="upgradeMembership" value="1" class="btn btn-sm btn-primary m-t-n-xs" <?php if($LDGR['net_balance']<=0){ echo 'disabled="disabled"'; } ?>>Pay</button>
							
                          </form>
						  <?php }else{ ?>
						  	<div class='alert alert-block alert-danger'><i class='ace-icon fa fa-times red'></i>You can only upgrade after <?php echo  $CONFIG_PLAN_UPGRADE_FROM_DAY; ?> days  of last activation. </div>
						 <?php } ?>
                        </div>
                      </div>
                    </div>
                    <!-- end of box-wrap -->
                  </div>
                  <!-- end of box-body -->
                </div>
              </div>
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
		$("#form-page").validationEngine(
			{onValidationComplete: function(form, valid){
				if (valid) {
					return confirm('Are you sure you want to submit?');
				}
			}}
		);
		$("#package_id").on('blur',function(){
			var package_id = $("#package_id").val();
			if(package_id>0){
				var URL_LOAD = "<?php echo BASE_PATH; ?>json/jsonhandler?switch_type=PACKAGE_DETAIL&package_id="+package_id;
				$(".loadPackage").load(URL_LOAD);
			}else{
				$(".loadPackage").text("");
			}
		});
		
	});
</script>
</html>
