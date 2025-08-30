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
<style type="text/css">
.danger_alert {
    background-color: #f2dede;
    border-color: #ebccd1;
    color: #a94442;
}
.success_alert {
    background-color: #dff0d8;
    border-color: #d6e9c6;
    color: #3c763d;
}




</style>

<style>
.container1 {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
      -ms-flex-align: center;
          align-items: center;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  min-height: 40vh;
  margin-top: 10%;
    margin-left: 42%;
	display:none;
<!--background-color: #ededed;-->
}

.loader {
  max-width: 15rem;
  width: 100%;
  height: auto;
  stroke-linecap: round;
}

circle {
  fill: none;
  stroke-width: 3.5;
  -webkit-animation-name: preloader;
          animation-name: preloader;
  -webkit-animation-duration: 3s;
          animation-duration: 3s;
  -webkit-animation-iteration-count: infinite;
          animation-iteration-count: infinite;
  -webkit-animation-timing-function: ease-in-out;
          animation-timing-function: ease-in-out;
  -webkit-transform-origin: 170px 170px;
          transform-origin: 170px 170px;
  will-change: transform;
}
circle:nth-of-type(1) {
  stroke-dasharray: 550;
}
circle:nth-of-type(2) {
  stroke-dasharray: 500;
}
circle:nth-of-type(3) {
  stroke-dasharray: 450;
}
circle:nth-of-type(4) {
  stroke-dasharray: 300;
}
circle:nth-of-type(1) {
  -webkit-animation-delay: -0.15s;
          animation-delay: -0.15s;
}
circle:nth-of-type(2) {
  -webkit-animation-delay: -0.3s;
          animation-delay: -0.3s;
}
circle:nth-of-type(3) {
  -webkit-animation-delay: -0.45s;
  -moz-animation-delay:  -0.45s;
          animation-delay: -0.45s;
}
circle:nth-of-type(4) {
  -webkit-animation-delay: -0.6s;
  -moz-animation-delay: -0.6s;
          animation-delay: -0.6s;
}

@-webkit-keyframes preloader {
  50% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}

@keyframes preloader {
  50% {
    -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
  }
}

</style>
</head>
<body class="skin-2">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
  <div class="main-content">
    <div class="main-content-inner">
      <?php  $this->load->view(ADMIN_FOLDER.'/layout/breadcumb'); ?>
      <div class="page-content">
      
        <!-- /.page-header -->
        <div class="row">
          <div class="col-xs-12">
            <?php get_message(); ?>
			
           <div class="widget-box">
              <div class="widget-header widget-header-blue ">
                <h4 class="widget-title lighter">Red Remuneration Closing</h4>
                <div class="widget-toolbar">&nbsp;</div>
              </div>
              <div class="widget-body">
                <div class="widget-main">
                  <form  name="form-valid" id="form-valid" method="post" class="form-horizontal" action="<?php echo generateAdminForm("closing","turbosale",""); ?>">
                    <div class="no-steps-container" id="fuelux-wizard-container">
                      <div>
                        <ul style="margin-left: 0" class="steps">
                          <li data-step="1" class="active"> <span class="step">1</span> <span class="title">Turbo Sale Income</span> </li>
                          <li data-step="2" class="active"> <span class="step">2</span> <span class="title">Matching Income</span> </li>
                          <li data-step="3" class="active"> <span class="step">3</span> <span class="title">Turbo Sale Bonus</span> </li>
                          <li data-step="4" class="active"> <span class="step">4</span> <span class="title">LeaderShip Level Bonus </span> </li>
						   <li data-step="5" class="active"> <span class="step">5</span> <span class="title">Red Remuneration </span> </li>
						   
						    <li data-step="6" class="active"> <span class="step">6</span> <span class="title">Finish </span> </li>
                        </ul>
                      </div>
                      <hr>
                      <div class="step-content pos-rel">
                        <div class="step-pane active" data-step="1" id="pagedata" >
                          <h3 class="lighter block green">Master Closing </h3>
                          <div class="hr hr-dotted"></div>
                        <?php 
						
				$sel_query = $this->db->query("SELECT  process_id as id  FROM `tbl_process` WHERE  `pair_sts` !='N' ORDER BY `process_id` DESC LIMIT 1");
		$fetchRow = $sel_query->row_array();
		$processId = $fetchRow['id'];
		
		
	$sel_query = $this->db->query("SELECT SUM(net_cmsn) as net  FROM `tbl_cmsn_binary` WHERE process_id='$processId'");
		$fetchBinary = $sel_query->row_array();
	    $MatchingIncome= $fetchBinary['net'];	
		$sel_query = $this->db->query("SELECT SUM(net_income) as net  FROM `tbl_cmsn_direct` WHERE process_id='$processId'");
		$fetchTurbosale = $sel_query->row_array();
	    $TurbosaleIncome= $fetchTurbosale['net'];
				
			$sel_query = $this->db->query("SELECT SUM(net_income) as net  FROM `tbl_cmsn_direct` WHERE process_id='$processId'");
		$fetchTurbosale = $sel_query->row_array();
	    $TurbosaleIncome= $fetchTurbosale['net'];
		
		$sel_query = $this->db->query("SELECT SUM(net_income) as net FROM tbl_cmsn_bonus WHERE status='0'");
		$fetchTurbobonus = $sel_query->row_array();
	    $TurbobonusIncome= $fetchTurbobonus['net'];
		
		$sel_query = $this->db->query("SELECT SUM(net_income) as net  FROM tbl_cmsn_leadership WHERE process_id='$processId'");
		$fetchLeadership = $sel_query->row_array();
	    $LeadershipIncome= $fetchLeadership['net'];
		
		$sel_query = $this->db->query("SELECT SUM(net_income) as net FROM `tbl_cmsn_red` WHERE status ='N'");
		$fetchRed = $sel_query->row_array();
	    $RedIncome= $fetchRed['net'];
		
		
				
				if($TurbosaleIncome > 0 ){
						?>
						 
						 
						  <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Turbo Sale Income : </label>
                            <div class="col-xs-12 col-sm-9">
                              <div class="clearfix">
                              
								                            <input class="col-xs-12 col-sm-5 validate[required]  date-picker" name="from_date" id="from_date1" value="<?php echo $TurbosaleIncome;?>" type="datetime" readonly>
                            <span class="input-group-addon" style="width: 21px;
    height: 40px;"> <i class="fa fa-inr bigger-110"></i></span>
                              </div>
                            </div>
                          </div>
						  
						  
						  <?php } if($MatchingIncome > 0) {  ?>
						  
						  <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Matching Income : </label>
                            <div class="col-xs-12 col-sm-9">
                              <div class="clearfix">
                              
								                            <input class="col-xs-12 col-sm-5 validate[required]  date-picker" name="from_date" id="from_date1" value="<?php echo $MatchingIncome;?>" type="datetime" readonly>
                            <span class="input-group-addon" style="width: 21px;
    height: 40px;"> <i class="fa fa-inr bigger-110"></i></span>
                              </div>
                            </div>
                          </div>
						  
						  <?php } if($TurbobonusIncome > 0 ){?>
						  
						  <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Turbo Bonus Income : </label>
                            <div class="col-xs-12 col-sm-9">
                              <div class="clearfix">
                              
								                            <input class="col-xs-12 col-sm-5 validate[required]  date-picker" name="from_date" id="from_date1" value="<?php echo $TurbobonusIncome;?>" type="datetime" readonly>
                            <span class="input-group-addon" style="width: 21px;
    height: 40px;"> <i class="fa fa-inr bigger-110"></i></span>
                              </div>
                            </div>
                          </div>
						  
						  <?php }  if($LeadershipIncome > 0){?>
						  <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Leadership Income : </label>
                            <div class="col-xs-12 col-sm-9">
                              <div class="clearfix">
                              
								                            <input class="col-xs-12 col-sm-5 validate[required]  date-picker" name="from_date" id="from_date1" value="<?php echo $LeadershipIncome;?>" type="datetime" readonly>
                            <span class="input-group-addon" style="width: 21px;
    height: 40px;"> <i class="fa fa-inr bigger-110"></i></span>
                              </div>
                            </div>
                          </div>
						  <?php } if($RedIncome > 0){?>
						  <div class="form-group">
                            <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Red Remuneration : </label>
                            <div class="col-xs-12 col-sm-9">
                              <div class="clearfix">
                              
								                            <input class="col-xs-12 col-sm-5 validate[required]  date-picker" name="from_date" id="from_date1" value="<?php echo $RedIncome;?>" type="datetime" readonly>
                            <span class="input-group-addon" style="width: 21px;
    height: 40px;"> <i class="fa fa-inr bigger-110"></i></span>
                              </div>
                            </div>
                          </div>
						  <?php } ?>
						  
						  
                        </div> 
						
						
						
			 <div class="container1" id="loaderspin"  >
	
	<svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
		 <circle cx="170" cy="170" r="160" stroke="#E2007C"/>
		 <circle cx="170" cy="170" r="135" stroke="#404041"/>
		 <circle cx="170" cy="170" r="110" stroke="#E2007C"/>
		 <circle cx="170" cy="170" r="85" stroke="#404041"/>
	</svg>
	
</div>
                      </div>
                    </div>
                    <hr>
                    <div class="wizard-actions">
                      <input type="hidden" name="member_id" id="member_id" value="<?php echo $ROW['member_id'];  ?>">
	 		 
                      <button name="submitMemberSave" id="submitMemberSave" type="button" value="1" class="btn btn-success" onClick="return turbosale();"> <i class="ace-icon fa fa-floppy-o"></i> Save  <i class="ace-icon fa fa-spinner fa-spin" id="spin" style="visibility:hidden;"></i></button>
           
                    </div>
                  </form>
                </div>
               
              </div>
              
            </div> 
           
          </div>
        
        </div>
    
      </div>
     
    </div>
  </div>
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
		<?php if($ROW['member_id']==""){ ?>
			//$(".checkSponsor").on('blur click',checkSponsor);
			//$("#submitMemberSave").attr('disabled',true);
			function checkSponsor(){
				var sponsor_user_id = $("#sponsor_user_id").val();
				var left_right = $('input[name=left_right]:checked').val();
				if(sponsor_user_id!='' && (left_right=='L' || left_right=='R')){
					var url_check_spr = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=CHECK_SPR&sponsor_user_id="+sponsor_user_id+"&left_right="+left_right;
					$.getJSON(url_check_spr,function(jsonReturn){	
						if(jsonReturn.spil_id>0){
							$("#spil_id").val(jsonReturn.spil_id);
							$("#submitMemberSave").attr('disabled',false);
							$("#error_box").removeClass('danger_alert');
							$("#error_box").addClass('success_alert');
							$("#error_box").text("Sponsor validated , please proceed further"); 
						}else{
							$("#error_box").removeClass('success_alert');
							$("#error_box").addClass('danger_alert');
						}
					});
				}
			}
		<?php } ?>
	});
	
	function turbosale()
	{
	var submitdata = document.getElementById("submitMemberSave").value;
	    $("#pagedata").css("display", "none");
	    $("#loaderspin").css("display", "block");
	   $("#spin").css("visibility", "visible");
	   $("#submitMemberSave").prop('disabled', true);
			  jQuery.ajax({
				type: "POST",
				url: "<?php echo BASE_PATH; ?>" + "superadmin/closing/ajaxtotalcommission",
				data: {submitdata:submitdata},
				success: function(res) {
				window.location.href = "<?php echo BASE_PATH;?>superadmin/financial/turnover";

               
			}});
	}
</script>
</body>
</html>
