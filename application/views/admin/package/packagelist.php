<?php defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$segment = $this->uri->uri_to_assoc(2);
$packageType = _d($segment['type']);

$QR_PAGES="SELECT * FROM tbl_pintype WHERE 1 ORDER BY mrp asc ";
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
          <h1> Package <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Type </small> </h1>
        </div>
        <!-- /.page-header -->
        <div class="row">
          <?php get_message(); ?>
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-12">
                <div class="clearfix">
                  <div class="pull-right tableTools-container">
                    <div class="dt-buttons btn-overlap btn-group">
					<!--<a href="<?php echo generateSeoUrlAdmin("package","package_type",""); ?>" title="" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-collection buttons-colvis btn btn-white btn-danger btn-bold"><span><i class="fa fa-arrow-left bigger-110 blue"></i> <span class="">Back</span></span></a> 
					
					-->
					
					 <a href="<?php echo generateSeoUrlAdmin("package","addpackage",array("type"=>_e($packageType))); ?>" title="" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold"><span><i class="fa fa-plus bigger-110 blue"></i> <span class="hidden">Show/hide columns</span></span></a> 
					           <!--         <a  onClick="window.print()" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-print btn btn-white btn-primary btn-bold"><span><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></span></a>--> </div>
                  </div>
                </div>
                <!-- div.table-responsive -->
                <!-- div.dataTables_borderWrap -->
                <div>
                  <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th   class="center"> <label class="pos-rel"> ID <span class="lbl"></span> </label>                        </th>
                        <th  >Plan  Name</th>
						<th>Product</th>
                      
						  <th  >Total Price </th>
						   <th  >Description </th>
                        <th  >Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
                      <tr>
                        <td class="center"><label class="pos-rel"> <?php echo $Ctrl; ?> <span class="lbl"></span> </label>                        </td>
                        <td><?php echo $AR_DT['pin_name']; ?>  [ <?php echo $AR_DT['prod_pv']; ?>  BV ] </td>
                        <td><?php echo $AR_DT['product']; ?></td>
                        
                         
						  <td> &nbsp;&#8377; <?php echo $AR_DT['mrp']; ?> /-</td>
				 <td><?php echo $AR_DT['description']; ?></td>
                        <td><div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>
                            <ul class="dropdown-menu dropdown-default">
                              <li> <a href="<?php echo generateSeoUrlAdmin("package","addpackage",array("type_id"=>_e($AR_DT['type_id']),"action_request"=>"EDIT","type"=>_e($packageType))); ?>">Edit</a> </li>
							  
							 <!-- <li> <a href="<?php echo generateSeoUrlAdmin("package","packageproduct",array("type_id"=>_e($AR_DT['type_id']),"type"=>_e($packageType))); ?>">Manage Product</a> </li>-->
							  
							  
                             <!-- <li> <a href="<?php echo generateSeoUrlAdmin("package","addpackage",array("type_id"=>_e($AR_DT['type_id']),"action_request"=>"DELETE","type"=>_e($packageType))); ?>">Delete</a> </li>-->
                            </ul>
                          </div></td>
                      </tr>
                      <?php $Ctrl++; endforeach; }else{ ?>
                      <tr>
                        <td colspan="6" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
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
  <div id="search-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="smaller lighter blue no-margin">Search</h3>
        </div>
        <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."advert/viewadvrt"; ?>" method="post">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Advert Title  :</label>
              <div class="col-sm-7">
                <input id="form-field-1" placeholder="Advert Title" name="advert_title"  class="col-xs-10 col-sm-12 validate[required]" type="text" value="<?php echo $_REQUEST['advert_title']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Date  :</label>
              <div class="col-sm-7">
                <div class="input-group">
                  <input class="form-control col-xs-6 col-sm-3  validate[required] date-picker" name="from_date" id="id-date-picker-1" value="<?php echo $ROW['from_date']; ?>" type="text"  placeholder="From Date" />
                  <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
                <br>
                <div class="input-group">
                  <input class="form-control col-xs-6 col-sm-3  validate[required] date-picker" name="to_date" id="id-date-picker-1" value="<?php echo $ROW['to_date']; ?>" type="text" 	 placeholder="To Date"  />
                  <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
            <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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
		$("#form-valid").validationEngine();
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		
	});
</script>
</body>
</html>
