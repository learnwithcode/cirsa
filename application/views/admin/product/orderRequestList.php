<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

	$segment = $this->uri->uri_to_assoc(2);
     $sale_id = _d($segment['sale_id']);
   
     
	$QR_PAGES= "SELECT O.*,P.image FROM `tbl_sale_product` as O LEFT JOIN tbl_product as P on P.product_id = O.products_id WHERE sale_id='$sale_id'";
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
<style type="text/css">
	.table-wrapper {
		background: #eeeded;
		border-radius: 10px;
		width: 100%;
		height: auto;
		padding: 10px;
		box-sizing: border-box;
		border: 1px solid #CCC;
		margin: 30px 0;
	}
	table {
		background-color: #f9f9f9;
		border-collapse: collapse;
		color: black;
		margin: 0px !important;
		width: 100%;
		text-align: left
	}
	table tr:nth-child(odd) {
		background-color: #fefbf0;
	}
	table tr th {
		/*background-color: #E0CEF2;
		border-color: #B1A3BF;*/
	}
	table tr, table tr td {
		/*line-height: 40px !important;*/
	}
	table tr th, table tr td {
		border: 1px solid #aaa;
	}
 @media only screen and (max-width:992px) {
	/* Force table to not be like tables anymore */
	#no-more-tables table, #no-more-tables thead, #no-more-tables tbody, #no-more-tables th, #no-more-tables td, #no-more-tables tr {
		display: block;
	}
	/* Hide table headers (but not display: none;, for accessibility)  */
	#no-more-tables thead tr {
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	/* Behave like a "row" */
	#no-more-tables td:not(:first-child) {
		position: relative;
		padding-left: 52%;
		text-align: left;
		border-collapse: collapse;
		border-bottom: 0px;
	}
	#no-more-tables td:first-child {
		text-align: center;
		border-collapse: collapse;
		border-bottom: 0px;
		/*background-color: #359AF2;
		color: white;
		font-weight: bold*/
	}
	#no-more-tables td:last-child {
		border: 1px solid #aaa;
	}
	#no-more-tables tr {
		margin-bottom: 10px;
	}
	/* Now like a table header */
	#no-more-tables td:not(:first-child):before {
		position: absolute;
		left: 0;
		top: 0;
		height: 100%;
		width: 48%;
		padding-left: 2%;
		/*background-color: #f2f7fc;*/
		border-right: 1px solid #aaa;
		white-space: wrap;
		text-align: left;
		font-weight: bold;
		content: attr(data-title);
	}
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
    
      <div class="row">
        <?php get_message(); ?>
        <div class="col-xs-12">
         <div class="row">
<div class="col-xs-12">
<h3 class="header smaller lighter blue">Product Detail</h3>

<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">
Product List							</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
 <div class="widget-body">
                <div class="panel-body list">
                  <div class="table-responsive project-list">
                    <table class="table table-striped">
  <thead>
                    <tr role="row">
                      <th  class="sorting" width="10%">Sr. No </th>
                    
                      <th  class="sorting" width="15%">Product Name</th>

                      <th  class="sorting" width="25%">Image </th>
                       <th  class="sorting" width="10%">Quantity </th>
                        <th  class="sorting" width="20%">Unit Price </th>
                         <th  class="sorting" width="20%">Total Price </th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
						if($PageVal['TotalRecords'] > 0){
						    
						        $Page = $PageVal['RecordStart']+1;
						   
						    
						$Ctrl=$Page;
							foreach($PageVal['ResultSet'] as $AR_DT):
						?>
                    <tr class="odd" role="row">
                      <td data-title="Sr. No"><?php echo $Ctrl; ?></td>
                    
                      <td data-title="Product Name"><?php echo $AR_DT['product_name']; ?></td>
                        <td data-title="Product Image" style="text-align: center;"><img src="<?php echo BASE_PATH;?>upload/product/<?php echo $AR_DT['image'];?>" width="50%"></td></td>
                         <td data-title="Net Income"><?php echo $AR_DT['quantity']; ?></td>
                          <td data-title="Net Income"><?php echo number_format($AR_DT['product_price'],2); ?></td>
                      <td data-title="Net Income"><?php echo number_format($AR_DT['total_price'],2); ?></td>
                     
                      
                    </tr>
                    <?php $Ctrl++; endforeach;
						}
						 ?>
                  </tbody>
</table>
</div>
</div>
</div>

<div class="row"><div class="col-xs-6"><div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries</div></div>

<div class="col-xs-6">
<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
  <ul class="pagination">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul>  
								  
								  </div></div>




</div>
<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->
</div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.page-content -->
  </div>
</div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a>
</div>
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
		$("#form-valid").validationEngine();
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		
	});
</script>
</body>
</html>
