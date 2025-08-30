<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	
	
	$QR_PAGES = "SELECT ts.*, tp.pin_name 
				FROM tbl_subscription AS ts 
				LEFT JOIN tbl_pintype AS tp ON tp.type_id=ts.type_id
				WHERE ts.member_id='".$member_id."' 
				ORDER BY ts.subcription_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 20, $Page, $SrchQ);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<style type="text/css">
	span.title {
		display: block;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
		font-weight: 600;
		font-size: 12px;
		color: #fff;
		letter-spacing: 12px;
		padding-left: 10px;
	}
	.minheight{
		min-height:1200px;
	}
</style>
<script type="text/javascript">
	function copyToClipboard(text) {
  			window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
		}
</script>
</head>
<body>
<div class="site-holder">
  <!-- .navbar -->
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
  <!-- /.navbar -->
  <div class="box-holder">
    <!-- .left-sidebar -->
    <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    <!-- /.left-sidebar -->
    <!-- .content -->
    <div class="content">
      <div class="row">
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>"> Home </a></li>
            <li class="active"> Refferal Banner</li>
          </ul>
        </div>
      </div>
      <div class="price-list row">
        <!-- Accordians -->
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
                        
                         
                         <div class="row">
        <div class="col-md-12">
			<?php echo get_message(); ?>
          <div class="panel panel-primary">
            <div class="panel-heading"> <span data-original-title="The invite link is your personal sponsor link. If you send this link to a person and they click on the link and choose to signup,  they will be in your sales organization." id="invite_link_tooltip" class="tooltip-icon fa fa-question pull-right" title=""></span>
              <h3 class="panel-title text-white"> <i class="fa fa-link"></i> Referral Banner </h3>
            </div>
            <div class="panel-body">
              <div class="row inviteLink">
			  	<div class="col-md-12" >
                  <label class="">  Banner Size 200px * 50px: </label>
				</div>
				<div class="clearfix">&nbsp;</div>
                <div class="col-md-12" >
                 	<textarea name="banner_500_400" id="banner_500_400" style="resize:none;" cols="50" rows="3" readonly="readonly"><a href="<?php echo BASE_PATH.$ROW['user_name'];  ?>"><img src="<?php echo LOGO; ?>" /></a></textarea>
                </div>
              </div>
			  <div class="clearfix">&nbsp;</div>
             <div class="col-md-12" >
			 	<a href="javascript:void(0)" onclick="copyToClipboard(document.getElementById('banner_500_400').value)"><i class="fa fa-copy"></i> Copy</a>
			 </div>
            </div>
          </div>
        </div>
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
      <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
      <!-- /.content -->
    </div>
  </div>
</div>
</body>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
</html>
