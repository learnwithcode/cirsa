<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
if($_REQUEST['member_id'] == ""){ $member_id=1; }
else{$member_id = _d($_REQUEST['member_id']);}

$fldiLeftCtrl = $model->BinaryCount($member_id, "LeftCountDirect");  
$fldiRightCtrl = $model->BinaryCount($member_id, "RightCountDirect");
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
<script src="<?php echo BASE_PATH; ?>assets/javascript/genvalidator.js"></script>
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
.pointer{
	cursor:pointer;
}
</style>
<style>
.tree { /*background-color:#2C3E50;*/ color:#4D6878;}
.tree li,
.tree li > a,
.tree li > span {
    padding: 4pt;
    border-radius: 4px;
}

.tree li a {
   color:#4D6878;
    text-decoration: none;
    line-height: 20pt;
    border-radius: 4px;
}

.tree li a:hover {
    background-color: #4D6878;
    color: #fff;
}

.active {
   /* background-color: #4D6878;*/
    color: white;
}

.active a {
    color: #fff;
}

.tree li a.active:hover {
    background-color: #4D6878;
}
#jquery-script-menu {
position: fixed;
height: 90px;
width: 100%;
top: 0;
left: 0;
border-top: 5px solid #316594;
background: #fff;
-moz-box-shadow: 0 2px 3px 0px rgba(0, 0, 0, 0.16);
-webkit-box-shadow: 0 2px 3px 0px rgba(0, 0, 0, 0.16);
box-shadow: 0 2px 3px 0px rgba(0, 0, 0, 0.16);
z-index: 999999;
padding: 10px 0;
-webkit-box-sizing:content-box;
-moz-box-sizing:content-box;
box-sizing:content-box;
}

.jquery-script-center {
width: 960px;
margin: 0 auto;
}
.jquery-script-center ul {
width: 212px;
float:left;
line-height:45px;
margin:0;
padding:0;
list-style:none;
}
.jquery-script-center a {
	text-decoration:none;
}
.jquery-script-ads {
width: 728px;
height:90px;
float:right;
}
.jquery-script-clear {
clear:both;
height:0;
}

.treemenu li { list-style: none; }

.treemenu .toggler {
    cursor: pointer;
}

.treemenu .toggler:before {
    display: inline-block;
    margin-right: 2pt;
}

li.tree-empty > .toggler { color: #aaa; }
li.tree-empty > .toggler:before { content: "\2212"; }
li.tree-closed > .toggler:before { content: "+"; }
li.tree-opened > .toggler:before { content: "\2212"; }

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
        <div class="page-header">
          <h1> Member <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;   Unilevel Tree </small> </h1>
        </div>
        <!-- /.page-header -->
        <div class="row">
          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="row">
              <div class="col-sm-12" style="min-height:500px;">
                <div class="jquery-script-clear"></div>
                <ul  class="tree" >
                  <li><a href="javascript:void(0)">Admin &nbsp;[L:&nbsp;<?php echo $fldiLeftCtrl; ?>&nbsp;,&nbsp;R:&nbsp;<?php echo $fldiRightCtrl; ?>]</a></li>
                  <?php echo $model->display_downline_direct_member("1","0",2); ?>
                </ul>
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
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/jquery/jquery.treemenu.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<script>
$(function(){
         $(".tree").treemenu({delay:300}).openActive();
    });
</script>
</html>
