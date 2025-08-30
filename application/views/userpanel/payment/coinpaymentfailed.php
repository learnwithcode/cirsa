<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
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
            <li class="active"> Coin Payment Failed </li>
          </ul>
        </div>
      </div>
      <div class="price-list row">
        <!-- Accordians -->
        <div class="row">
        <div class="col-md-12">
		<?php echo get_message(); ?>
          <div class="portlet light bordered">
            <div class="panel-body"> 
            <div class="main pagesize">
              <!-- *** mainpage layout *** -->
              <div class="main-wrap">
                <div class="content-box">
                  <div class="box-body">
                    <div class="box-wrap clear">
						<div class="row">
						 	<div class="col-md-8">
						  <h2>Transaction Failed</h2>
						  <p>It seem one may be the reason</p>
						  <br>
							<div class="alert alert-danger">
								<ul type="disc">
									<li>You have double click on payment button</li>
									<li>Your session <strong>or</strong> cookies  has beeen expired.</li>
									<li>Invalid payment details.</li>
									<li>You have selected a payment cancel option.</li>
									<li>For any support , you can  write us 24*7 <a style="text-decoration:none; color:#0080FF;" href="mailto:<?php echo $SUPPOT_MAIL; ?>"><?php echo $SUPPOT_MAIL; ?></a>.</li>
								</ul>
							</div>
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
      <!-- /.content -->
    </div>
  </div>
</div>
</body>
</html>
