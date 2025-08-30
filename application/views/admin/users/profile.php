<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title><?php echo title_name(); ?></title>
<meta name="description" content="Static &amp; Dynamic Tables" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
<!-- page specific plugin styles -->
<!-- text fonts -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/fonts.googleapis.com.css" />
<!-- ace styles -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-skins.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-rtl.min.css" />
<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
<!-- inline styles related to this page -->
<!-- ace settings handler -->
<script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-extra.min.js"></script>
<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
</head>
<body class="skin-2">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
  <div class="main-content">
    <div class="main-content-inner">
      <?php  $this->load->view(ADMIN_FOLDER.'/layout/breadcumb'); ?>
      <div class="page-content">
        <div class="page-header">
          <h1> Member <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Profile</small> </h1>
        </div>
        <!-- /.page-header -->
        <div class="row">
          <div class="col-xs-12">
            <?php get_message(); ?>
            <!-- PAGE CONTENT BEGINS -->
            <div class="clearfix">
              <div class="pull-right"> <span class="green middle bolder">Choose profile: &nbsp;</span>
                <div class="btn-toolbar inline middle no-margin">
                  <div data-toggle="buttons" class="btn-group no-margin">
                    <?php
					$prev_member = $model->checkPrevMember($ROW['member_id']);
					$next_member = $model->checkNextMember($ROW['member_id']);
				 ?>
                    <?php if($prev_member>0){ ?>
                    <label class="btn btn-sm btn-yellow" onClick="window.location.href='<?php echo  generateSeoUrlAdmin("member","profile",array("member_id"=>_e($prev_member))); ?>'"> <span class="bigger-110"> <i class="ace-icon fa fa-arrow-left icon-on-left"></i>&nbsp;Prev</span> </label>
                    <?php } ?>
                    <?php if($next_member>0){ ?>
                    <label class="btn btn-sm btn-yellow" onClick="window.location.href='<?php echo  generateSeoUrlAdmin("member","profile",array("member_id"=>_e($next_member))); ?>'"> <span class="bigger-110">Next <i class="ace-icon fa fa-arrow-right icon-on-right"></i></span> </label>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="hr dotted"></div>
            <div id="user-profile-1" class="user-profile">
              <div class="tabbable">
                <ul class="nav nav-tabs padding-18">
                  <li class="active"> <a data-toggle="tab" href="#home"> <i class="green ace-icon fa fa-user bigger-120"></i> Profile </a> </li>
                  <li> <a data-toggle="tab" href="#feed"> <i class="orange ace-icon fa fa-user-secret bigger-120"></i> Direct Sponsor</a> </li>
                  <li> <a data-toggle="tab" href="#friends"> <i class="blue ace-icon fa fa-users bigger-120"></i> Downline Member </a> </li>
                  <li> <a data-toggle="tab" href="#pictures"> <i class="pink ace-icon fa fa-lock bigger-120"></i> Change Password </a> </li>
				   <li> <a data-toggle="tab" href="#banking-details"> <i class="pink ace-icon fa fa-bank bigger-120"></i> Banking Details </a> </li>
                </ul>
                <div class="tab-content no-border padding-24">
                  <div id="home" class="tab-pane in active">
                    <div class="row">
                      <div class="col-xs-12 col-sm-3 center"> <span class="profile-picture"> <img class="editable img-responsive" alt="<?php echo $ROW['first_name']; ?>" id="avatar2" src="<?php echo getMemberImage($ROW['member_id']); ?>"> </span>
                        <div class="space space-4"></div>
                        <a href="#" class="btn btn-sm btn-block btn-success"> <i class="ace-icon fa fa-plus-circle bigger-120"></i> <span class="bigger-110">Add as a friend</span> </a> <a href="#" class="btn btn-sm btn-block btn-primary"> <i class="ace-icon fa fa-envelope-o bigger-110"></i> <span class="bigger-110">Send a message</span> </a> </div>
                      <!-- /.col -->
                      <div class="col-xs-12 col-sm-9">
                        <h4 class="blue"> <span class="middle"><?php echo $ROW['first_name']." ".$ROW['last_name']; ?></span> <span class="label label-purple arrowed-in-right"> <i class="ace-icon fa fa-circle smaller-80 align-middle"></i> online </span> </h4>
                        <div class="profile-user-info">
                          <div class="profile-info-row">
                            <div class="profile-info-name"> Username </div>
                            <div class="profile-info-value"> <span><?php echo $ROW['user_name']; ?></span> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> Location </div>
                            <div class="profile-info-value"> <i class="fa fa-map-marker light-orange bigger-110"></i> <span><?php echo $ROW['current_address']; ?></span> <span><?php echo $ROW['city_name']; ?></span> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> Email Address </div>
                            <div class="profile-info-value"> <span><?php echo $ROW['member_email']; ?></span> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> Joined </div>
                            <div class="profile-info-value"> <span><?php echo getDateFormat($ROW['date_join'],"Y/M/d"); ?></span> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> Last Online </div>
                            <div class="profile-info-value"> <span><?php echo getDateFormat($ROW['last_login'],"Y , M d h:i"); ?></span> </div>
                          </div>
                        </div>
                        <div class="hr hr-8 dotted"></div>
                        <div class="profile-user-info">
                          <div class="profile-info-row">
                            <div class="profile-info-name"> Sponsor </div>
                            <div class="profile-info-value"> <a href="javascript:void(0)" target="_blank"><?php echo ($ROW['spsr_first_name'])? $ROW['spsr_first_name']." ".$ROW['spsr_last_name']:"N/A"; ?></a> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> <i class="middle ace-icon fa fa-user-secret bigger-150 blue"></i> </div>
                            <div class="profile-info-value"> <a href="javascript:void(0)"><?php echo ($ROW['spsr_user_id'])? $ROW['spsr_user_id']:"N/A"; ?></a> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> <i class="middle ace-icon fa fa-arrows bigger-150 blue"></i> </div>
                            <div class="profile-info-value"> <a href="javascript:void(0)"><?php echo DisplayText("MEM_".$ROW['left_right']); ?></a> </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="space-20"></div>
                    <!--<div class="row">
                      <div class="col-xs-12 col-sm-6">
                        <div class="widget-box transparent">
                          <div class="widget-header widget-header-small">
                            <h4 class="widget-title smaller"> <i class="ace-icon fa fa-check-square-o bigger-110"></i> Little About Me </h4>
                          </div>
                          <div class="widget-body">
                            <div class="widget-main">
                              <p> My job is mostly lorem ipsuming and dolor sit ameting as long as consectetur adipiscing elit. </p>
                              <p> Sometimes quisque commodo massa gets in the way and sed ipsum porttitor facilisis. </p>
                              <p> The best thing about my job is that vestibulum id ligula porta felis euismod and nullam quis risus eget urna mollis ornare. </p>
                              <p> Thanks for visiting my profile. </p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-12 col-sm-6">
                        <div class="widget-box transparent">
                          <div class="widget-header widget-header-small header-color-blue2">
                            <h4 class="widget-title smaller"> <i class="ace-icon fa fa-lightbulb-o bigger-120"></i> My Skills </h4>
                          </div>
                          <div class="widget-body">
                            <div class="widget-main padding-16">
                              <div class="clearfix">
                                <div class="grid3 center">
                                  <div style="height: 72px; width: 72px; line-height: 71px; color: rgb(202, 89, 82);" class="easy-pie-chart percentage" data-percent="45" data-color="#CA5952"> <span class="percent">45</span>%
                                    <canvas width="72" height="72"></canvas>
                                  </div>
                                  <div class="space-2"></div>
                                  Graphic Design </div>
                                <div class="grid3 center">
                                  <div style="height: 72px; width: 72px; line-height: 71px; color: rgb(89, 168, 75);" class="center easy-pie-chart percentage" data-percent="90" data-color="#59A84B"> <span class="percent">90</span>%
                                    <canvas width="72" height="72"></canvas>
                                  </div>
                                  <div class="space-2"></div>
                                  HTML5 &amp; CSS3 </div>
                                <div class="grid3 center">
                                  <div style="height: 72px; width: 72px; line-height: 71px; color: rgb(149, 133, 191);" class="center easy-pie-chart percentage" data-percent="80" data-color="#9585BF"> <span class="percent">80</span>%
                                    <canvas width="72" height="72"></canvas>
                                  </div>
                                  <div class="space-2"></div>
                                  Javascript/jQuery </div>
                              </div>
                              <div class="hr hr-16"></div>
                              <div class="profile-skills">
                                <div class="progress">
                                  <div class="progress-bar" style="width:80%"> <span class="pull-left">HTML5 &amp; CSS3</span> <span class="pull-right">80%</span> </div>
                                </div>
                                <div class="progress">
                                  <div class="progress-bar progress-bar-success" style="width:72%"> <span class="pull-left">Javascript &amp; jQuery</span> <span class="pull-right">72%</span> </div>
                                </div>
                                <div class="progress">
                                  <div class="progress-bar progress-bar-purple" style="width:70%"> <span class="pull-left">PHP &amp; MySQL</span> <span class="pull-right">70%</span> </div>
                                </div>
                                <div class="progress">
                                  <div class="progress-bar progress-bar-warning" style="width:50%"> <span class="pull-left">Wordpress</span> <span class="pull-right">50%</span> </div>
                                </div>
                                <div class="progress">
                                  <div class="progress-bar progress-bar-danger" style="width:38%"> <span class="pull-left">Photoshop</span> <span class="pull-right">38%</span> </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>-->
                  </div>
                  <!-- /#home -->
                  <div id="feed" class="tab-pane">
                    <div class="profile-feed row">
                      <?php 
						$QR_DIRECT =  "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.sponsor_id='".$ROW['member_id']."'";
						$RS_DIRECT = $this->SqlModel->getQuery($QR_DIRECT);
						$AR_ROW = $RS_DIRECT->result_array();
						$fldiCount = count($AR_ROW)/2;
					?>
                      <div class="col-sm-6">
                        <?php 
							$i=1;
							foreach($AR_ROW as $AR_DT): 
						?>
                        <div class="profile-activity clearfix">
                          <div> <img class="pull-left" alt="Alex Doe's avatar" src="<?php echo BASE_PATH; ?>assets/images/avatars/avatar.png"> <a class="user" href="<?php echo  generateSeoUrlAdmin("member","profile",array("member_id"=>$AR_DT['member_id'])); ?>"> <?php echo $AR_DT['first_name']." ".$AR_DT['last_name']; ?> </a> <?php echo $AR_DT['current_address']." ".$AR_DT['city_name']; ?> <a href="javascript:void(0)"><?php echo $AR_DT['state_name']." ".$AR_DT['country_name']; ?></a>
                            <div class="time"> <i class="ace-icon fa fa-clock-o bigger-110"></i> <?php echo getDateFormat($AR_DT['last_login'],"Y , M d h:i"); ?> </div>
                          </div>
                        </div>
                        <?php if($i>=$fldiCount){ echo '</div><div class="col-sm-6">'; $i=0; } $i++; endforeach; ?>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="space-12"></div>
                    <div class="center">
                      <button onClick="window.location.href='<?php echo  generateSeoUrlAdmin("member","direct",array()); ?>'" type="button" class="btn btn-sm btn-primary btn-white btn-round"> <i class="ace-icon fa fa-list bigger-150 middle orange2"></i> <span class="bigger-110">View All Sponsor</span> <i class="icon-on-right ace-icon fa fa-arrow-right"></i> </button>
                    </div>
                  </div>
                  <!-- /#feed -->
                  <div id="friends" class="tab-pane">
                    <div class="profile-users clearfix">
                      <?php 
						$QR_DOWN =  "SELECT tm.* FROM ".prefix."tbl_members AS tm
						 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
						 WHERE tree.nleft BETWEEN '".$ROW['nleft']."' AND '".$ROW['nright']."'";
						$RS_DOWN = $this->SqlModel->getQuery($QR_DOWN);
						$AR_DOWN = $RS_DOWN->result_array();
						foreach($AR_DOWN as $AR_DT):
					 ?>
                      <div class="itemdiv memberdiv">
                        <div class="inline pos-rel">
                          <div class="user"> <a href="<?php echo  generateSeoUrlAdmin("member","profile",array("member_id"=>$AR_DT['member_id'])); ?>"> <img src="<?php echo getMemberImage($AR_DT['member_id']); ?>" alt="<?php echo $AR_DT['first_name']." ".$AR_DT['last_name']; ?>"> </a> </div>
                          <div class="body">
                            <div class="name"> <a href="<?php echo  generateSeoUrlAdmin("member","profile",array("member_id"=>$AR_DT['member_id'])); ?>"> <span class="user-status status-online"></span> <?php echo $AR_DT['first_name']." ".$AR_DT['last_name']; ?> </a> </div>
                          </div>
                          <div class="popover">
                            <div class="arrow"></div>
                            <div class="popover-content">
                              <div class="bolder">Content Editor</div>
                              <div class="time"> <i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i> <span class="green"> 20 mins ago </span> </div>
                              <div class="hr dotted hr-8"></div>
                              <div class="tools action-buttons"> <a href="#"> <i class="ace-icon fa fa-facebook-square blue bigger-150"></i> </a> <a href="#"> <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i> </a> <a href="#"> <i class="ace-icon fa fa-google-plus-square red bigger-150"></i> </a> </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php  endforeach; ?>
                    </div>
                    <div class="space-12"></div>
                    <div class="center">
                      <button onClick="window.location.href='<?php echo  generateSeoUrlAdmin("member","level",array()); ?>'" type="button" class="btn btn-sm btn-primary btn-white btn-round"> <i class="ace-icon fa fa-list bigger-150 middle orange2"></i> <span class="bigger-110">View All Downline</span> <i class="icon-on-right ace-icon fa fa-arrow-right"></i> </button>
                    </div>
                    <!--<div class="hr hr10 hr-double"></div>
                    <ul class="pager pull-right">
                      <li class="previous disabled"> <a href="#">← Prev</a> </li>
                      <li class="next"> <a href="#">Next →</a> </li>
                    </ul>-->
                  </div>
                  <!-- /#friends -->
                  <div id="pictures" class="tab-pane">
                    <h3 class="lighter block green">Change Password</h3>
                    <form  name="form-valid" id="form-valid" method="post" class="form-horizontal" action="<?php echo generateAdminForm("member","profile",""); ?>">
                      <!--<div class="form-group">
                          <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Old - Password : </label>
                          <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                              
                            </div>
                          </div>
                        </div>-->
                      <div class="space-2"></div>
                      <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">New - Password:</label>
                        <div class="col-xs-12 col-sm-9">
                          <div class="clearfix">
                            <input name="old_password" id="old_password" class="col-xs-12 col-sm-4 validate[required]" type="hidden" placeholder="current password" 
							 value="<?php echo $ROW['user_password']; ?>">
                            <input name="user_password" id="user_password"  class="col-xs-12 col-sm-4 validate[required,minSize[6]]" type="password" placeholder="new password" value="">
                          </div>
                        </div>
                      </div>
                      <div class="space-2"></div>
                      <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password">Confirm - Password:</label>
                        <div class="col-xs-12 col-sm-9">
                          <div class="clearfix">
                            <input name="confirm_user_password" id="confirm_user_password"  class="col-xs-12 col-sm-4 validate[required,equals[user_password]]" type="password" placeholder="confirm password" value="">
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
                  <!-- /#pictures -->
				    <div id="banking-details" class="tab-pane">
                    <div class="row">
                      <div class="col-xs-12 col-sm-3 center"> <span class="profile-picture"> <img class="editable img-responsive" alt="<?php echo $ROW['first_name']; ?>" id="avatar2" src="<?php echo getMemberImage($ROW['member_id']); ?>"> </span>
                        <div class="space space-4"></div>
                        <a href="#" class="btn btn-sm btn-block btn-success"> <i class="ace-icon fa fa-plus-circle bigger-120"></i> <span class="bigger-110">Add as a friend</span> </a> <a href="#" class="btn btn-sm btn-block btn-primary"> <i class="ace-icon fa fa-envelope-o bigger-110"></i> <span class="bigger-110">Send a message</span> </a> </div>
                      <!-- /.col -->
                      <div class="col-xs-12 col-sm-9">
                       <?php //echo "<pre>";print_r($ROW);?>
                        <div class="profile-user-info">
                          <div class="profile-info-row">
								<div class="profile-info-name"> A/c holder Name </div>
                            <div class="profile-info-value"> <span><?php echo $ROW['bank_acct_holder']; ?></span> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> Bank Name </div>
                            <div class="profile-info-value">  <span><?php echo $ROW['bank_name']; ?></span> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> A/c number </div>
                            <div class="profile-info-value"> <span><?php echo $ROW['account_number']; ?></span> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> IFSC Code </div>
                            <div class="profile-info-value"> <span><?php echo $ROW['ifc_code']; ?></span> </div>
                          </div>
                          <div class="profile-info-row">
                            <div class="profile-info-name"> Branch </div>
                            <div class="profile-info-value"> <i class="fa fa-map-marker light-orange bigger-110"></i> <span><?php echo $ROW['branch']; ?></span> </div>
                          </div>
                        </div>
						 <div class="profile-info-row">
                            <div class="profile-info-name"> Pan No. </div>
                            <div class="profile-info-value"> <span><?php echo $ROW['pan_no']; ?></span> </div>
                          </div>
                        </div>
						
						
                        <div class="hr hr-8 dotted"></div>
                       
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    <div class="space-20"></div>
                 
                  </div>
				  <!-- /#Banking -->
                </div>
              </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.page-content -->
    </div>
  </div>
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>
</body>
</html>
