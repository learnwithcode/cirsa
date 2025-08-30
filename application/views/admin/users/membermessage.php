<?php defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

if($_REQUEST['member_name']!=''){
	$member_name = FCrtRplc($_REQUEST['member_name']);
	$StrWhr .=" AND ( tm.first_name LIKE '%$member_name%' OR tm.last_name LIKE '%$member_name%' OR tm.user_id LIKE '%$member_name%')";
	$SrchQ .="&member_name=$member_name";
}
if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
	$from_date = InsertDate($_REQUEST['from_date']);
	$to_date = InsertDate($_REQUEST['to_date']);
	$StrWhr .=" AND DATE(msg.date_time) BETWEEN '$from_date' AND '$to_date'";
	$SrchQ .="&from_date=$from_date&to_date=$to_date";
}

$QR_PAGES="SELECT msg.*, tm.first_name, tm.last_name 
		   FROM ".prefix."tbl_message AS msg
		   LEFT JOIN tbl_members AS tm ON msg.from_member_id=tm.member_id 
		   WHERE msg.parent_id='0' $StrWhr ORDER BY msg.message_id DESC";
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
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datetimepicker.min.css" />
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
<script type="text/javascript">
	$(function(){
		$(".open_modal").on('click',function(){
			$('#search-modal').modal('show');
			return false;
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
        <h1> Member <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Message </small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
        <?php get_message(); ?>
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-12">
              <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">  <a  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold open_modal"><span><i class="fa fa-search bigger-110 pink"></i> <span class="hidden">Search</span></span></a>
                    
                    <a  href="<?php echo generateSeoUrlAdmin("excel","message",""); ?>" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> <a  onClick="window.print()" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-print btn btn-white btn-primary btn-bold"><span><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></span></a> </div>
                </div>
              </div>
              <!-- div.table-responsive -->
              <!-- div.dataTables_borderWrap -->
              <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr role="row">
                      <th   rowspan="1"  tabindex="0">Srl No </th>
                      <th   rowspan="1"  tabindex="0">Member</th>
                      <th   colspan="1" rowspan="1"  tabindex="0">Date</th>
                      <th  rowspan="1"  tabindex="0">Query Subject </th>
                      <th   rowspan="1"  tabindex="0">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php 
					if($PageVal['TotalRecords'] > 0){
					$Ctrl=1;
					foreach($PageVal['ResultSet'] as $AR_DT):
					
					?>
                    <tr class="odd" role="row">
                      <td><?php echo $Ctrl; ?></td>
                      <td><?php echo $AR_DT['first_name']." ".$AR_DT['last_name']; ?></td>
                      <td><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                      <td><?php echo $AR_DT['subject']; ?></td>
                      <td><a href="javascript:void(0)" class="open-message" title="<?php echo $AR_DT['subject']; ?>" message_id="<?php echo _e($AR_DT['message_id']); ?>" > <i class="fa fa-reply" aria-hidden="true"></i> Reply  </a>&nbsp;&nbsp;  <a onClick="return confirm('Make sure want to delete this message?')" href="<?php echo generateSeoUrlAdmin("member","membermessage",array("action_request"=>"DELETE","message_id"=>_e($AR_DT['message_id']))); ?>"> <i class="fa fa-trash" aria-hidden="true"></i> Delete  </a>                    </td>
                    </tr>
                    <tr class="odd" role="row">
                      <td><strong>Message</strong></td>
                      <td colspan="4"><?php echo $AR_DT['message']; ?></td>
                    </tr>
                    <?php endforeach;
						}	 ?>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-xs-6">
                    <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries </div>
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
<div id="advert-view" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="smaller lighter blue no-margin">Advrt Management</h3>
      </div>
      <div class="modal-body" id="load_content"> </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal" id="load-personalized" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Reply Message</h4>
      </div>
      <div class="modal-body">
        <div class="login-box">
          <div id="row">
            <div class="input-box frontForms">
              <div class="row">
			  <?php echo display_message(); ?>
                <div class="col-md-12 col-xs-12">
           			
                  <form action="<?php echo  generateAdminForm("member","membermessage",array("")); ?>" id="otpForm" name="otpForm" method="post">	
                    
					<div class="form-group">
                      <textarea name="message" class="form-control validate[required]" id="message" style="width:540px; height:200px;"></textarea>
                      <div class="clear">&nbsp;</div>
                    </div>
                    
                    <div class="form-group">
					  <input type="hidden"  name="message_id" id="message_id" value="">
					  <input type="hidden" name="action_request" id="action_request" value="REPLY">
                      <input type="submit" name="submitReply" value="Send" class="btn btn-primary btn-submit" id="submitReply"/>
					  &nbsp;&nbsp;
					  <input type="button" name="closeButton" value="Close" class="btn btn-danger btn-submit"  data-dismiss="modal" id="closeButton"/>
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
</div>
 <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a>
</div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
<script src="<?php echo BASE_PATH; ?>tiny/nicEdit.js" type="text/javascript"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		var jsUrlPath = "<?php echo BASE_PATH; ?>";
		$("#form-valid").validationEngine();
		$(".open-message").on('click',function(){
			var title = $(this).attr("title");
			var message_id = $(this).attr("message_id");
			$(".modal-title").html(title);
			$("#message_id").val(message_id);
			$("#load-personalized").modal('show');
		})

		bkLib.onDomLoaded(function() {
			new nicEditor({iconsPath : jsUrlPath+'tiny/nicEditorIcons.gif', maxHeight : 150}).panelInstance('message');
		});
		
	});
</script>
</body>
</html>
