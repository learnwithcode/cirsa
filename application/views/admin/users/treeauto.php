<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

if(_d($_REQUEST['member_id'])!=''){
	$member_id = _d(FCrtRplc($_REQUEST['member_id']));
}else{
	$member_id = $model->getFirstId();
}
$AR_MEM  = $model->getMember($member_id);
if($member_id<=0 || $member_id==''){ set_message("warning","Unable to load tree, please enter valid member"); }

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
<script src="<?php echo BASE_PATH; ?>javascript/genvalidator.js"></script>
<script src="<?php echo BASE_PATH; ?>jquery/jquery.jOrgChart.js"></script>
<?php auto_complete(); ?>
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
	.text-green{
		color:#008000 !important;
	}
	.text-red{
		color:#FF0000 !important;
	}
	.text-orange{
		color:#FF8000 !important;
	}
	.pointer{
		cursor:pointer;
	}

	.jOrgChart .line {
	  height                : 20px;
	  width                 : 2px;
	}
	
	.jOrgChart .down {
	  background-color 		: #868686;	
	  margin 				: 0px auto;
	}
	
	.jOrgChart .top {
	  border-top          : 2px solid #868686;
	}
	
	.jOrgChart .left {
	  border-right          : 1px solid #868686;
	}
	
	.jOrgChart .right {
	  border-left           : 1px solid #868686;
	}
	
	/* node cell */
	.jOrgChart td {
	  text-align            : center;
	  vertical-align        : top;
	  padding               : 0;
	}
	
	/* Tree Box */
	.jOrgChart .node {
	  background-color 		: #FFFFFF;
	  display               : inline-block;
	  width                 : 120px;
	  height                : 50px;
	  z-index 				: 10;
	  margin                : 0 2px;
	  border-radius 		: 8px;
	  -moz-border-radius 	: 8px;
	  padding				: 3px;
	}
	.small_font{
			font-size:9px !important;
		}
		
	   
	</style>
<script>
    jQuery(document).ready(function() {
        $("#org").jOrgChart({
            chartElement : '#chart',
            dragAndDrop  : false
        });
    });
    </script>
</head>
<body class="skin-2" style="background-color:#fff;">
<script language="javascript" type="text/javascript" src="<?php echo BASE_PATH; ?>javascript/wz_tooltip.js"></script>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
<div class="main-content">
  <div class="main-content-inner">
    <?php  $this->load->view(ADMIN_FOLDER.'/layout/breadcumb'); ?>
    <div class="page-content">
      <div class="page-header">
        <h1> Member <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;  Binary Tree</small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
        <?php  get_message(); ?>
        <div class="col-xs-12">
         
          
            <ul id="org" style="display:none;">
              <li> <?php echo $model->getNameStatus($AR_MEM['member_id']); ?>
                <ul>
                  <?php
				$nlevel = FCrtRplc($_REQUEST['nlevel']);
				$Q_FLVL = "SELECT tm.*, CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name
				FROM tbl_members AS tm
				LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=tm.member_id
				WHERE  tree.member_id!='".$member_id."' 
				AND tree.spil_id='".$member_id."'";
				$RS_FLVL = $this->SqlModel->runQuery($Q_FLVL);
				foreach($RS_FLVL as $AR_FLVL):
					
					$Q_SLVL = "SELECT tm.*, CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name
					FROM tbl_members AS tm
					LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=tm.member_id
					WHERE  tree.member_id!='".$AR_FLVL['member_id']."' 
					AND tree.spil_id='".$AR_FLVL['member_id']."'";
	  		 ?>
                  <li> <?php echo $model->getNameStatus($AR_FLVL['member_id']); ?>
                    <ul>
                      <?php
					
					$RS_SLVL = $this->SqlModel->runQuery($Q_SLVL);
					foreach($RS_SLVL as $AR_SLVL):
					
					#$AR_IMG_SLVL = $model->getMemberTree($AR_SLVL['member_id']);
					?>
                      <li> <?php echo $model->getNameStatus($AR_SLVL['member_id']); ?>
                        <ul>
                          <?php 
									$Q_TLVL = "SELECT tm.*, CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name
									FROM tbl_members AS tm
									LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=tm.member_id
									WHERE  tree.member_id!='".$AR_SLVL['member_id']."' 
									AND tree.spil_id='".$AR_SLVL['member_id']."'";
									$RS_TLVL = $this->SqlModel->runQuery($Q_TLVL);
									foreach($RS_TLVL as $AR_TLVL):
									
							 ?>
                          <li><?php echo $model->getNameStatus($AR_TLVL['member_id']); ?></li>
                          <?php  endforeach; ?>
                        </ul>
                      </li>
                      <?php  endforeach; ?>
                    
                    </ul>
                  </li>
                  <?php  endforeach ?>
                  
                </ul>
              </li>
            </ul>
            <div id="chart" class="orgChart" align="center"></div>
         
          <br>
          
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
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>
</body>
<script language="javascript" type="text/javascript">
function GoBack(){
	<?php if($member_id != ""){?>window.history.go(-1);<?php } ?>
}
function ViewTop(){
	window.location="?#";
}
function SearchTree(){
	var member_id = document.getElementById("member_id").value;
	if(trim(member_id) != ""){moveTree(member_id);}
}
function moveTree(member_id){
	if(member_id != ""){
		document.frmtree.member_id.value=member_id;
		document.frmtree.submit();
	}else{
		return false;
	}
}
</script>
<form name="frmtree" method=get action="?">
  <input type=hidden name="temp" value="<?php echo base64_encode("temp");?>">
  <input type=hidden name="mytree" value="<?php echo base64_encode("mytree");?>">
  <input type=hidden name="member_id">
  <input type=hidden name="view" value="<?php echo base64_encode("myview");?>">
  <input type=hidden name="others" value="<?php echo base64_encode("others".$_REQUEST['member_id']);?>">
</form>
<script type="text/javascript" language="javascript">
new Autocomplete("user_id", function(){
	this.setValue = function( id ) {document.getElementsByName("member_id")[0].value = id;}
	if(this.isModified) this.setValue("");
	if(this.value.length < 1 && this.isNotClick ) return;
	return "<?php echo BASE_PATH; ?>autocomplete/listing?srch=" + this.value+"&switch_type=MEMBER";
});
</script>
</html>
