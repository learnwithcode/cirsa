<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$segment = $this->uri->uri_to_assoc(2);
    $staff_id = ($form_data['staff_id']>0)? $form_data['staff_id']:_d($segment['staff_id']);
$QR_PAGES="SELECT * FROM tbl_staff   WHERE staff_id='$staff_id'";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
$data = $PageVal['ResultSet'][0];
if(!is_array($data) && empty($data))
{
    	set_message("danger","unauthorized access ...");
	redirect_page("staff","stafflist",array("error"=>"danger"));	    
}
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
          <h1> Staff <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Staff Detail   </small> </h1>
          <div class="pull-right tableTools-container">    <div class="dt-buttons btn-overlap btn-group"> 
            <a href="<?php echo generateSeoUrlAdmin("staff","stafflist",array("")); ?>" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-collection buttons-colvis btn btn-white btn-warning btn-bold"><span><i class="fa fa-arrow-left bigger-110 blue"></i> <span class="">Back  </span></span></a> 
                     </div>  </div>
        </div>
       
        
        <div class="clearfix">&nbsp;</div>
               <div class="">
									<div id="user-profile-2" class="user-profile">
										<div class="tabbable">
											<ul class="nav nav-tabs padding-18">
												<li class="active">
													<a data-toggle="tab" href="#home">
														<i class="green ace-icon fa fa-user bigger-120"></i>
														Profile													</a>												</li>

												<li>
													<a data-toggle="tab" href="#bank">
														<i class="orange ace-icon fa fa-rss bigger-120"></i>
														Banking Details													</a>												</li>

											
											</ul>

											<div class="tab-content no-border padding-24">
												<div id="home" class="tab-pane in active">
													<div class="row">
														<div class="col-xs-12 col-sm-3 center">
															<span class="profile-picture">
																<!--<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="assets/images/avatars/profile-pic.jpg" />															</span>-->
                                                               <img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="<?php echo BASE_PATH;?>upload/staff/<?php echo $data['profile_pic'];?>" />
															<div class="space space-4"></div>

															<a href="#" class="btn btn-sm btn-block btn-success">
																<i class="ace-icon fa fa-plus-circle bigger-120"></i>
																<span class="bigger-110"><?php echo $data['designation'];?></span>															</a>

															<a href="#" class="btn btn-sm btn-block btn-primary">
																<i class="ace-icon fa fa-envelope-o bigger-110"></i>
																<span class="bigger-110">Send a message</span>															</a>
													   </div><!-- /.col -->

														<div class="col-xs-12 col-sm-9">
															<h4 class="blue">
																<span class="middle"><?php echo $data['first_name'].' '.$data['midle_name'].' '.$data['last_name'];?></span>

																<span class="label label-purple arrowed-in-right">
																	<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
																	Active																</span>															</h4>

															<div class="profile-user-info">
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Father/Mother/husband Name </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo $data['pname'];?></span>																	</div>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> DOB </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo DisplayDate($data['dob']);?></span>																	</div>
                                                                    </div>
                                                                    
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Joined </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo DisplayDate($data['join_date']);?></span>																	</div>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Gender </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php if($data['gender']=='M'){echo 'Male';} else { echo 'Female';}?></span>																</div>
                                                                    </div>
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Martial Status </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php if($data['gender']=='M'){echo 'Married ';} else { echo 'Single';}?></span>																</div>
                                                                    </div>
                                                                    
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Mobile No </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo $data['mobile'];?></span>																</div>
                                                                    </div>
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Email Id </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo $data['email'];?></span>																	</div>
                                                                    </div>
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Present Address </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <?php echo $data['present_address'];?>																</div>
                                                                    </div>
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Permanent Address </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <?php echo $data['permanent_address'];?>																</div>
                                                                    </div>
                                                                  
															</div>
														</div><!-- /.col -->
													</div><!-- /.row -->

													<div class="space-20"></div>

												</div><!-- /#home -->

												<div id="bank" class="tab-pane">
													
															<div class="profile-feed  row">
														<div class="col-xs-12 col-sm-3 center">
																									
													   </div><!-- /.col -->

														<div class="col-xs-12 col-sm-9">
	

															<div class="profile-user-info">
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Bank Name </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo $data['bank_name'];?></span>																	</div>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> A/c No. </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo $data['accountno'];?></span>																	</div>
                                                                    </div>
                                                                    
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> IFSC Code </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo $data['ifsccode'];?></span>																	</div>
                                                                    </div>
                                                                    
                                                                    
                                                                      <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Salary </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <?php echo $data['salary'];?>																</div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Pan No </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo $data['pan'];?></span>																</div>
                                                                    </div>
                                                                    <div class="profile-info-row">
                                                                    <div class="profile-info-name"> Adhar No. </div>
                                                                    
                                                                    <div class="profile-info-value">
                                                                    <span><?php echo $data['adharno'];?></span>																</div>
                                                                    </div>
                                                                    
                                                                 
															</div>
														</div><!-- /.col -->
													</div><!-- /.row -->
													</div><!-- /.row -->

													<div class="space-12"></div>

													<div class="center">
														<!--<button type="button" class="btn btn-sm btn-primary btn-white btn-round">-->
														<!--	<i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>-->
														<!--	<span class="bigger-110">View more activities</span>-->

														<!--	<i class="icon-on-right ace-icon fa fa-arrow-right"></i>														</button>-->
													</div>
												</div><!-- /#feed -->

											</div>
										</div>
									</div>
								</div>   <!--------------------->

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
		$("#form-page").validationEngine();
	});
	
	function getbalance(elem)
	{
	var id = elem.value;
	 jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "superadmin/financial/getbalance",
data: {userId: id},
success: function(res) {
//alert(res);
document.getElementById("cur_bal").value=res;


}
});
	}
</script>
</body>
</html>
