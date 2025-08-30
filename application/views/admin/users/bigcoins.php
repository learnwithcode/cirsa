<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$form_data = $this->input->post();
$segment = $this->uri->uri_to_assoc(2);
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
if($_REQUEST['user_id']!=''){
	$user_id = FCrtRplc($_REQUEST['user_id']);
	$StrWhr .=" AND ( tm.user_id = '$user_id' )";
	$SrchQ .="&user_id=$user_id";
}

$QR_PAGES = "SELECT ts.*, tp.pin_name , tp.daily_return, tp.no_day, tp.daily_return*tp.no_day AS total_return,
				tm.user_id,
				CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name, 
				tmsp.user_id AS spsr_user_id
				FROM ".prefix."tbl_subscription AS ts 
				LEFT JOIN ".prefix."tbl_pintype AS tp ON tp.type_id=ts.type_id
				LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=ts.member_id
				LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
				WHERE 1 $StrWhr
				GROUP BY ts.subcription_id
				ORDER BY ts.subcription_id ASC";
$PageVal = DisplayPages($QR_PAGES, 20, $Page, $SrchQ);
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
<script src="<?php echo BASE_PATH; ?>assets/javascript/genvalidator.js"></script>
<script type="text/javascript">
	$(function(){
		$(".open_modal").on('click',function(){
			$('#search-modal').modal('show');
			return false;
		});
		
	});
</script>
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
        <h1> Subscription <small> <i class="ace-icon fa fa-angle-double-right"></i> bigcoins  </small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
        <?php  get_message(); ?>
        <div class="col-xs-12">
         
          <div class="row">
            <div class="col-md-4">
              <form id="form-search" name="form-search" method="get" action="<?php echo generateAdminForm("member","bigcoins",""); ?>">
                
                
                <b>User </b>
                <div class="form-group">
                  <div class="clearfix">
                    <input id="user_id" placeholder="User Id" name="user_id"  class="col-xs-12 col-sm-6 validate[required]" type="text" value="<?php echo $_REQUEST['user_id']; ?>">
                  </div>
                </div>
                <input class="btn btn-primary m-t-n-xs" value=" Search " type="submit">
                <a href="javascript:void(0)" onClick="window.location.href='<?php echo generateSeoUrlAdmin("member","bicoins",""); ?>'" class="btn btn-danger m-t-n-xs" value=" Reset ">Reset</a>
              </form>
            </div>
          </div>
          <div class="clearfix">&nbsp;</div>
          <table width="100%" border="0" cellpadding="5" cellspacing="1" class="table table-striped table-bordered table-hover">
            <tr class="">
              <td align="center">Srl No </td>
              <td  align="center">User Id </td>
              <td  align="center"> Name </td>
              <td  align="center">Order No </td>
              <td  align="center">Plan</td>
              <td  align="center">Amount</td>
              <td  align="center">Date</td>
              <td  align="center">Bigcoins</td>
            </tr>
            <?php 
			if($PageVal['TotalRecords'] > 0){
			$Ctrl = $PageVal['RecordStart']+1;
			foreach($PageVal['ResultSet'] as $AR_DT){	
			?>
            <tr class=""  style="cursor:pointer">
              <td align="center" valign="middle" class="cmntext"><?php echo $Ctrl; ?></td>
              <td align="center" valign="middle" class="cmntext"><?php echo $AR_DT['user_id']; ?></td>
              <td align="left" valign="middle" class="cmntext"><?php echo $AR_DT['full_name']; ?></td>
              <td align="left" valign="middle" class="cmntext"><?php echo $AR_DT['order_no']; ?></td>
              <td align="center" valign="middle" class="cmntext"><?php echo $AR_DT['pin_name']; ?></td>
              <td align="center" valign="middle" class="cmntext"><?php echo number_format($AR_DT['total_amt']); ?></td>
              <td align="center" valign="middle" class="cmntext"><?php echo DisplayDate($AR_DT['date_from']); ?></td>
              <td align="center" valign="middle" class="cmntext">          
                <input type="text" class="enableText updateBigcoins" name="big_coins" id="big_coins<?php echo $AR_DT['subcription_id']; ?>" subcription_id="<?php echo $AR_DT['subcription_id']; ?>" value="<?php echo $AR_DT['big_coins']; ?>" readonly="true">			 	</td>
            </tr>
            <?php  $Ctrl++; }?>
            <?php }else{?>
            <tr>
              <td colspan="8" align="center" class="errMsg">No record  found for this member <a href="<?php echo generateSeoUrlAdmin("member","profilelist",""); ?>">&lt; &lt; Back</a></td>
            </tr>
            <?php } ?>
          </table>
          <ul class="pagination">
            <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
          </ul>
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.page-content -->
  </div>
</div>
</div>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
		$(".enableText").on('dblclick',function(){
			$(this).attr("readonly",false);
		});
		$(".enableText").on('blur',function(){
			$(this).attr("readonly",true);
		});
		$(".updateBigcoins").on('change',function(){
			var subcription_id = $(this).attr("subcription_id");
			var big_coins = $(this).val();
			var URL_LOAD = "<?php echo generateSeoUrlAdmin("json","jsonhandler",""); ?>";
			$.getJSON(URL_LOAD,{switch_type:"BIG_COINS",subcription_id:subcription_id,big_coins:big_coins},function(JsonEval){
				if(JsonEval){
					alert("Bigcoins updated successfully");
				}
			});
		});
		
		
	});
</script>
</body>
</html>
