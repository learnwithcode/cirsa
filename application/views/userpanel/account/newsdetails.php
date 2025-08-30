<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$segment = $this->uri->uri_to_assoc(2);
$news_id = _d($segment['news_id']);
if($news_id>0){
	$StrWhr .=" AND tn.news_id='$news_id'";
}
$QR_NEWS = "SELECT tn.* FROM ".prefix."tbl_news  AS tn 
WHERE tn.isDelete>0	 AND tn.news_sts>0 $StrWhr ORDER BY  tn.news_date ASC";
$AR_NEWS = $this->SqlModel->runQuery($QR_NEWS,true); 
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
            <li class="active"> News </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 panel-cascade">
          <div class="stk-nws-body clearfix">
            <div class="simply-scroll simply-scroll-container">
              <div class="simply-scroll-clip">
                <div class="simply-scroll-list" style="width: 2982px;">
                  
                  <ul id="scroller1" class="simply-scroll-list" style="float: left; width: 1470px;">
						<?php 
						$stock_market = get_web_page("https://bitpay.com/api/rates");
						$AR_STOCK = json_decode($stock_market,true);
						?>
						<?php foreach($AR_STOCK as $key=>$AR_VALUE): ?>
						<li>
						<div> <span class="scroller_span"><?php echo $AR_VALUE['name']; ?> <span class="text-danger"> <i class="fa fa-caret-right"></i> </span> BTC-<?php echo $AR_VALUE['code']; ?> <span class="text-success"> <i class="fa fa-caret-right"></i> </span> <?php echo $AR_VALUE['rate']; ?> </span> </div>
						</li>
						<?php endforeach; ?>
						
                        </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-sm1">
            <div class="panel-body">
              <div class="panel panel-info news-wrap">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12 details">
                      <h3> <?php echo $AR_NEWS['news_title']; ?> </h3>
                      <span class="date"> <i class="fa fa-calendar"></i><?php echo getDateFormat($AR_NEWS['news_date'],"d M Y"); ?> </span>
                      <div class="img-big"> <img src="<?php echo BASE_PATH; ?>theme/img/news-details.png" class="img-responsive" /> </div>
                      <p> <?php echo $AR_NEWS['news_detail']; ?> </p>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /panel 1 -->
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
<script type="text/javascript">
$(function(){
	$("#backPassForm").validationEngine();
	
});
</script>
</html>
