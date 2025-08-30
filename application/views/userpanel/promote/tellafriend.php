<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();	
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

	$member_id = $this->session->userdata('mem_id');
	$AR_AD = $model->getAvailableAds($member_id);
	
	
	$StrWhr .=" AND tact.member_id='".$member_id."'";
	$QR_PAGES="SELECT tact.* FROM tbl_ad_credit_trns AS tact WHERE 1 $StrWhr ORDER BY tact.ad_trns_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
<div class="clearfix"> </div>
<div class="page-container">
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
  <div class="page-content-wrapper">
    <div class="page-content">
      <ul class="page-breadcrumb breadcrumb">
			<li><a href="javascript:void(0)">My Account </a><i class="fa fa-circle"></i></li>
			<li><span class="active">Tell a Friend</span></li>
		</ul>
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
                        <form action="<?php echo MEMBER_PATH."promote/tellafriend"; ?>" method="POST" name="form-page" id="form-page">
                          <table id="tell_friend" class="table table-striped table-bordered table-hover" style="width:50%">
                            <tbody>
                              <tr>
                                <td align="center"><strong>Friend Name</strong></td>
                                <td align="center"><strong>Friend Email</strong></td>
                              </tr>
                              <tr>
                                <td><input name="mail_name[]" class="form-control" size="30" type="text">
                                </td>
                                <td><input name="mail_email[]" class="form-control" size="30" type="text"></td>
                              </tr>
                              <tr>
                                <td><input name="mail_name[]" class="form-control" size="30" type="text">
                                </td>
                                <td><input name="mail_email[]" class="form-control" size="30" type="text"></td>
                              </tr>
                              <tr>
                                <td><input name="mail_name[]" class="form-control" size="30" type="text">
                                </td>
                                <td><input name="mail_email[]" class="form-control" size="30" type="text"></td>
                              </tr>
                              <tr>
                                <td><input name="mail_name[]" class="form-control" size="30" type="text">
                                </td>
                                <td><input name="mail_email[]" class="form-control" size="30" type="text"></td>
                              </tr>
                              <tr>
                                <td><input name="mail_name[]" class="form-control" size="30" type="text">
                                </td>
                                <td><input name="mail_email[]" class="form-control" size="30" type="text"></td>
                              </tr>
                            </tbody>
                          </table>
                          <br>
                          <label>Email Subject: </label>
                          <input name="email_subject" class="form-control form-half" size="50" value="" type="text">
                          <br>
                          <br>
                          <textarea name="email_body" class="form-control form-half" cols="65" rows="15">Hi,
							You can earn & learn of digital marketing over here<br>
							
							Regards,<br>
							Bitclicko
							</textarea>
                          <br>
                          <input name="sendToFriend" value=" Send " class="btn btn-sm btn-primary m-t-n-xs" type="submit">
                        </form>
                        <br>
                        <br>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
</body>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
		
	});
</script>
</html>
