<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$AR_TYPE = $model->getCurrentMemberShip($member_id);
	$pin_activation = ($AR_TYPE['type_id']>0)? 0:30;
	$QR_PAGES = "SELECT tp.* FROM ".prefix."tbl_pintype AS tp   WHERE tp.isDelete>0 AND tp.type_id>(SELECT type_id FROM tbl_members 
				WHERE member_id='".$member_id."') $StrWhr ORDER BY tp.type_id ASC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
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
            <li><a href="<?php echo BASE_PATH; ?>"> Home </a></li>
            <li class="active"> Upgrade Package </li>
          </ul>
        </div>
      </div>
      <div class="price-list row">
	  <?php echo get_message(); ?>
	<?php 
	if($PageVal['TotalRecords'] > 0){
		$Ctrl=1;
		$j=1;
		foreach($PageVal['ResultSet'] as $AR_DT):
		$pin_price = $AR_DT['pin_price'];
		
		if($Ctrl==1){ $class="bg-info"; }elseif($Ctrl==2){ $class="bg-success"; }elseif($Ctrl==3){ $class="bg-danger"; }elseif($Ctrl==4){ $class="bg-primary"; }
		elseif($Ctrl==5){ $class="bg-info"; }
	
	?>
        <div class="price-box col-md-4 col-sm-6 col-xs-12 col-lg-4">
          <div class="price-header <?php echo $class; ?>">
            <h3 style="font-size:21px; padding-top:0px; padding-bottom:10px;"> <?php echo $AR_DT['pin_name']; ?></h3>
          </div>
          <ul class="list-group features">
            
            <li class="list-group-item" >
					<ul class="packages" style="list-style-type:none;">
						<li><i class="fa fa-check" aria-hidden="true"></i>Investment: <strong><?php echo $AR_DT['pin_price']; ?> to <?php echo ($AR_DT['pin_price_limit']==0)? "above":$AR_DT['pin_price_limit']; ?> USD</strong></li>
						<div class="clearfix">&nbsp;</div>
						<li><i class="fa fa-check" aria-hidden="true"></i>ROI: <strong><?php echo $AR_DT['daily_return']; ?> % Daily</strong></li>
						<div class="clearfix">&nbsp;</div>
						<li><i class="fa fa-check" aria-hidden="true"></i>DOUBLE: <strong><?php echo $AR_DT['no_day']; ?> %</strong></li>
						<div class="clearfix">&nbsp;</div>
						<li><i class="fa fa-check" aria-hidden="true"></i>CAPPING: <strong><?php echo $AR_DT['monthly_binary_limit']; ?> %</strong></li>
						<div class="clearfix">&nbsp;</div>
						
					</ul>
            </li>
            
            <li class="list-group-item select"> <a href="<?php  echo generateSeoUrlMember("account","paymentpackage",array("type_id"=>_e($AR_DT['type_id']))); ?>" class="btn btn-block <?php echo $class; ?> text-white btn-lg "> Upgrade </a> </li>
          </ul>
        </div>
	 <?php if($Ctrl>=3){ echo '</div><div class="price-list row">'; $Ctrl=0;  } $Ctrl++; $j++; endforeach;
	 	 } 
	  ?>
       
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
