<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
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
            <li class="active"> Bank Wire </li>
          </ul>
        </div>
      </div>
      <div class="price-list row">
        <div class="row">
          <div class="col-md-12">
            <!-- Invoice -->
            <div class="panel panel-cascade panel-invoice">
              <div class="panel-heading">
                <h3 class="panel-title"> BANK WIRE <span class="pull-right"> <a  href="<?php  echo generateSeoUrlMember("payment","bankwiredownload",array()); ?>" class=" btn btn-warning text-white hidden-print"> <i class="fa fa-pencil"></i> Download </a> <a  href="javascript:void(0)" id="print_button" class=" btn btn-success text-white hidden-print"> <i class="fa fa-print"></i> Print </a> </span> </h3>
              </div>
              <div class="panel-body inv-wrap">
                <div class="row block">
                  <div class="col-md-12">
                    <div class="table"></div>
                  </div>
                </div>
                <div class="row inv-wrap" id="print_area">
                  <div class="col-md-12 block">
                    <h4> <strong> Account Details: </strong> </h4>
                    <ul class="inv-lst">
                      <li> Account <span class="hg-txt"> ANX FOREX </span> </li>
                      <li> Address: One World Trade Center
                        Suite 8500 , New York, NY 10007
                        United States. </li>
                      <li> SWIFT CODE: <span class="hg-txt"> ABCNCTSSA </span> </li>
                      <li> RTGS/NEFT IFSC CODE: <span class="hg-txt"> ABC0000154 </span> </li>
                      <li> NAME OF BANK: <span class="hg-txt"> ABC BANK </span> </li>
                      <li> BANK ADDRESS: 9C Pulaski St.Des Moines, IA 50310. </li>
                      <li> ACCOUNT NUMBER: <span class="hg-txt"> 015405500642 </span> </li>
                      <li> BRANCH NUMBER/CODE: 0514 Moines Branch </li>
                      <li> Comments or Special Instructions: </li>
                      <li> PAYMENT DESCRIPTION: Invoice No.: 1043 </li>
                    </ul>
                  </div>
                  
                  <div class="col-md-12 text-center">
                    <h4> <strong> THANK YOU FOR YOUR BUSINESS!!! </strong> </h4>
                    <ul class="text-center comp-info">
                      <li> One World Trade Center
                        Suite 8500 , New York, NY 10007
                        United States </li>
                      <li> <i class="fa fa-envelope"></i> : support@anxebusiness.com, <i class="fa fa-phone"></i> : 1-646-583-1495 </li>
                    </ul>
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
<script type="text/javascript" language="javascript" src="<?php echo BASE_PATH; ?>theme/js/jquery.print.js"></script>
<script type="text/javascript">
	$(function(){
		$("#print_button").click(function(){$( "#print_area" ).print(); return( false );});
	});
</script>
</html>
