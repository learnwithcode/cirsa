<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

if($_REQUEST['group_id']!=''){
	$group_id = FCrtRplc($_REQUEST['group_id']);
	$StrWhr .=" AND top.fldiGrpId='$group_id'";
	$SrchQ .="&group_id=$group_id";
}
if($_REQUEST['cms_title']!=''){
	$cms_title = FCrtRplc($_REQUEST['cms_title']);
	$StrWhr .=" AND top.cms_title LIKE '%$cms_title%'";
	$SrchQ .="&cms_title=$cms_title";
}

$QR_PAGES="SELECT cms.* FROM ".prefix."tbl_cms AS cms   WHERE 1 $StrWhr ORDER BY cms.id_cms ASC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
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
<script src="<?php echo BASE_PATH; ?>assets/js/ace-extra.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.1.4.min.js"></script>
<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
<script type="text/javascript">
	$(function(){
		$(".open_modal").on('click',function(){
			$('#search-modal').modal('show');
			return false;
		});
		
		$(".checkStatus").on('click',function(){
			var id_cms = $(this).attr("id_cms");
			var URL_LOAD = "<?php echo ADMIN_PATH."json/jsonhandler"; ?>?switch_type=CMS&id_cms="+id_cms;
			$.getJSON(URL_LOAD,function(JVal){});
		});
	});
</script>
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
        <h1> CMS <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; List </small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
        <?php get_message(); ?>
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-12">
              <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
                    <a  href="<?php echo generateSeoUrlAdmin("excel","cms",""); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> <a aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-pdf buttons-flash btn btn-white btn-primary btn-bold"><span><i class="fa fa-file-pdf-o bigger-110 red"></i> <span class="hidden">Export to PDF</span></span> </a> <a  onClick="window.print()" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-print btn btn-white btn-primary btn-bold"><span><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></span></a> </div>
                </div>
              </div>
              <!-- div.table-responsive -->
              <!-- div.dataTables_borderWrap -->
              <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="22" class="center"> <label class="pos-rel"> ID <span class="lbl"></span> </label>                      </th>
                      <th width="150" align="center">Title</th>
                      <th width="157" align="center">URL</th>
                      <th width="134" align="center">Position</th>
                      <th width="101" align="center">Displayed</th>
                      <th width="90" align="center">Action</th>
                    </tr>
                  </thead>
                  <form method="post" autocomplete="off" action="<?php echo ADMIN_PATH."operation/cms"; ?>">
                    <tbody>
                      <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
                      <tr>
                        <td class="center"><label class="pos-rel"> <?php echo $AR_DT['id_cms']; ?> <span class="lbl"></span> </label>                        </td>
                        <td align="left"><?php echo $AR_DT['cms_title']; ?></td>
                        <td align="left"><a href="javascript:void(0)"><?php echo $AR_DT['link_rewrite']; ?></a></td>
                        <td align="center"><input type="hidden" name="id_cms[]" value="<?php echo $AR_DT['id_cms'];?>" />
                          <input name="position[]" type="text" class="cmnfld" id="position[]" size="3" value="<?php echo $AR_DT['position'];?>" style="text-align:center; width:60px;" onBlur="extractNumber(this,0,true);" onKeyPress="return blockNonNumbers(this, event, true, false);" onKeyDown="javascript: EnterKey();" onKeyUp="extractNumber(this,0,true);" maxlength="2"  tabindex="<?php echo $Ctrl; ?>" /></td>
                        <td align="center">
							<label>
							<input name="switch-field-1" id_cms="<?php echo $AR_DT['id_cms']; ?>" class="ace ace-switch ace-switch-4 checkStatus" <?php if($AR_DT['active']>0){ echo 'checked="checked"';} ?>  type="checkbox">
							<span class="lbl"></span>							</label></td>
                        <td align="center"><div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>
                            <ul class="dropdown-menu dropdown-default">
                              <li> <a href="<?php echo generateSeoUrlAdmin("operation","cms",array("id_cms"=>$AR_DT['id_cms'],"action_request"=>"EDIT")); ?>">Edit</a> </li>
                              <li> <a onClick="return confirm('Make sure want to delete this record?')" href="<?php echo generateSeoUrlAdmin("operation","cms",array("id_cms"=>$AR_DT['id_cms'],"action_request"=>"DELETE")); ?>">Delete</a> </li>
                            </ul>
                          </div></td>
                      </tr>
                      <?php $Ctrl++; endforeach; ?>
                      <tr>
                        <td class="center">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align="center"><input type="hidden" name="action_request" id="action_request" value="POSITION">
                          <button type="submit" class="btn btn-white btn-info btn-bold"> <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i> Update</button></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php  }else{ ?>
                      <tr>
                        <td colspan="6" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </form>
                </table>
                <div class="row">
                  <div class="col-xs-6">
                    <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> operator </div>
                  </div>
                  <div class="col-xs-6">
                    <div id="dynamic-table_paginate" class="dataTables_paginate paging_simple_numbers">
                      <ul class="pagination">
                        <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                      </ul>
                    </div>
                  </div>
                </div>
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
<div id="search-modal" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="smaller lighter blue no-margin">Search</h3>
      </div>
      <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."operation/cmslist"; ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Title </label>
            <div class="col-sm-6">
              <input id="form-field-1" placeholder="Title" name="cms_title"  class="col-xs-10 col-sm-12 validate[required]" type="text" value="<?php echo $_REQUEST['cms_title']; ?>">
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
          <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
 <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
</body>
</html>
