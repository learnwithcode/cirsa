<?php defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$model = new OperationModel();

$date_time = InsertDate($_REQUEST['date_time']);
$today_date = InsertDate(getLocalTime());

$load_date = ($date_time)? $date_time:$today_date;

$QR_PAGES="SELECT tcd.cmsn_date, SUM(tcd.trans_amount) AS trans_amount, tcd.daily_return, tpt.pin_name,
			SUM(tcd.net_income) AS net_income, tcd.type_id, tcd.cmsn_date, tcd.daily_cmsn_id
			FROM ".prefix."tbl_cmsn_daily AS tcd 
			LEFT JOIN tbl_pintype AS tpt ON  tpt.type_id=tcd.type_id
			WHERE 1
			GROUP BY tcd.type_id, DATE(tcd.cmsn_date)	
			ORDER BY tcd.daily_cmsn_id DESC";
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
          <h1>Bonus<small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Daily Return </small> </h1>
        </div>
        <div class="row">
          <?php  get_message(); ?>
          <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <form class="form-horizontal form-return"  name="form-return" id="form-return" action="<?php echo generateAdminForm("setting","dailyreturnprocess",""); ?>" method="post">
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Plan Name :</label>
                <div class="col-sm-9">
                  <select  name="type_id" id="type_id" class="col-xs-5 col-sm-5 validate[required] member_select">
                    <option value="">Select Pin</option>
                    <?php echo DisplayCombo($ROW['type_id'],"PIN_TYPE"); ?>
                  </select>
                  &nbsp;&nbsp;&nbsp; <a href="javascript:void(0)" id="member_grid"  style="display:none;">View</a> </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Daily Return (%)</label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Daily Return" name="daily_return"  class="col-xs-5 col-sm-5 validate[required,minSize[2],maxSize[2]]" type="text" value="<?php echo $ROW['daily_return']; ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date  :</label>
                <div class="col-sm-3">
                  <div class="input-group">
                    <input class="form-control col-xs-4 col-sm-3  date-picker" name="cmsn_date" id="cmsn_date" value="<?php echo $ROW['cmsn_date']; ?>" type="text"  />
                    <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span></div>
                </div>
              </div>
              <div class="clearfix space-4"></div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" name="submitReturn" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check bigger-110"></i> Process </button>
     
                  <button  class="btn btn-danger" type="button" onClick="window.location.href='<?php echo generateSeoUrlAdmin("setting","dailyreturn",array("")); ?>'"> <i class="ace-icon fa fa-times bigger-110"></i> Cancel </button>
                </div>
              </div>
            </form>
            <!-- PAGE CONTENT ENDS -->
          </div>
          <!-- /.col -->
        </div>
        <div class="clearfix">&nbsp;&nbsp;</div>
        <div class="row">
          <div class="col-md-12">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th width="95" class="center"> <label class="pos-rel"> Date <span class="lbl"></span> </label>
                  </th>
                  <th width="186">Plan Name </th>
                  <th width="149">Total Member </th>
                  <th width="111"> Amount </th>
                  <th width="111">Return  (%)</th>
                  <th width="111">Net Total </th>
                  <th width="111">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):
						$total_member = $model->checkCmsnDaily($AR_DT['type_id'],$AR_DT['cmsn_date']);
			       ?>
                <tr>
                  <td class="center"><label class="pos-rel"> <?php echo $AR_DT['cmsn_date']; ?> <span class="lbl"></span> </label>
                  </td>
                  <td><?php echo $AR_DT['pin_name']; ?></td>
                  <td><?php echo $total_member; ?></td>
                  <td><?php echo number_format($AR_DT['trans_amount'],2); ?></td>
                  <td><?php echo $AR_DT['daily_return']; ?></td>
                  <td><?php echo number_format($AR_DT['net_income'],2); ?></td>
                  <td><a href="<?php echo generateSeoUrlAdmin("bonus","dailyincome",""); ?>?daily_cmsn_id=<?php echo _e($AR_DT['daily_cmsn_id']); ?>">View</a></td>
                </tr>
                <?php $Ctrl++; endforeach; }else{ ?>
                <tr>
                  <td colspan="7" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="member-list-modal" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="member-list-modal-body-title">Member Grid</h4>
        </div>
        <div class="modal-body" id="member-list-modal-body"></div>
      </div>
    </div>
  </div>
  <div id="load-list-modal" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="load-list-modal-body-title">Processing please wait.......</h4>
        </div>
        <div class="modal-body" id="load-list-modal-body"></div>
      </div>
    </div>
  </div>
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true,
			daysOfWeekDisabled: "0,6"
			
		});
		
		$(".member_select").on('change',function(){
			var type_id = $("#type_id").val();
			if(type_id>0){
				$("#member_grid").show(600);
			}
		});
		
		$("#member_grid").on('click',function(){
			var type_id = $("#type_id").val();
			var title_name = $('#type_id').attr("selected", "selected");
			var URL_SEND = "<?php echo generateSeoUrl("json","jsonhandler",""); ?>";
			$('#member-list-modal-title').html(title_name);
			$.post(URL_SEND,{type_id:type_id,switch_type:"MEMBER_LIST"},function(JsonData){
				if(JsonData){
					$('#member-list-modal-body').html(JsonData);
					$('#member-list-modal').modal('show');
					return false;
				}	
			});
			return false;
		});
		
		$( ".form-return" ).on( "submit", function( event ) {
			event.preventDefault();
			$('#load-list-modal-body').html('<i class="fa fa-spinner fa-spin" style="font-size:24px"></i>');
			$('#load-list-modal').modal({
				backdrop: 'static',
				keyboard: false
			});		
			var URL_PROCESS = $(this).attr( 'action' );
			$.getJSON(URL_PROCESS,$(this).serialize(),function(JsonEval){
				if(JsonEval){
					if(JsonEval.ErrorMsg!=''){
						$('#load-list-modal-body-title').html(JsonEval.ErrorMsg);
						$('#load-list-modal-body').html(JsonEval.ErrorDtl);
						
					}
				}
			});
			
		});
		$("#load-list-modal").on("hidden.bs.modal", function () {
  			window.location.href='';
		});
		
	});
</script>
</body>
</html>
