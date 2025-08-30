<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$Page = $_GET['page']; if($Page=="" || $Page <=0 ){$Page=1;}
$wallet_id = $model->getWallet(WALLET1);
$segment = $this->uri->uri_to_assoc(2);
$processId = $model->getlastprocessId();

if($segment['type'] =='Pakage_COLLECTION')
{
  $QR_PAGES="SELECT tm.member_id,sub.date_from as active_date ,sub.prod_pv,tm.user_id,tm.date_join,CONCAT_WS(' ',tm.first_name,tm.midle_name,tm.last_name) as name,tm.user_id as suserId,tm.city_name,sub.package_price  FROM tbl_subscription AS sub LEFT JOIN tbl_members as tm on tm.member_id = sub.member_id  where sub.type_id < '7' and sub.package_price > 0 ORDER BY active_date DESC  ";

$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
}

if($segment['type'] =='Power_COLLECTION')
{
  $QR_PAGES="SELECT tm.member_id,sub.date_from as active_date ,sub.prod_pv,tm.user_id,tm.date_join,CONCAT_WS(' ',tm.first_name,tm.midle_name,tm.last_name) as name,tm.user_id as suserId,tm.city_name,sub.package_price  FROM tbl_subscription AS sub LEFT JOIN tbl_members as tm on tm.member_id = sub.member_id   where sub.type_id = '9' or sub.type_id = '10' and sub.package_price > 0 ORDER BY active_date DESC  ";

$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
}


if($segment['type'] =='Manual_COLLECTION')
{
 $QR_PAGES="SELECT tm.member_id,sub.date_from as active_date ,sub.prod_pv,tm.user_id,tm.date_join,CONCAT_WS(' ',tm.first_name,tm.midle_name,tm.last_name) as name,tm.user_id as suserId,tm.city_name,sub.package_price  FROM tbl_subscription AS sub LEFT JOIN tbl_members as tm on tm.member_id = sub.member_id  where sub.type_id = '8'  and sub.package_price > 0 ORDER BY active_date DESC   ";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
}


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
<body class="no-skin">
<?php $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
  <div class="main-content">
    <div class="main-content-inner">
      <?php $this->load->view(ADMIN_FOLDER.'/layout/breadcumb'); ?>
      <div class="page-content">
        <div class="page-header">
          <h1> User <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Paid List </small> </h1>
          
          
          
         
          
          
          
        </div>
        <!-- /.page-header -->
        <div class="row">
        
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-12">
                <?php get_message(); ?>
                <div class="clearfix">&nbsp;</div>
                <div>

			        <div class="row">
          <div class="col-xs-12 col-sm-12">
            <div class="widget-box">
              <div class="widget-header">
                <h4 class="widget-title sm"> Collection List </h4>
                <div class="widget-toolbar"> 
                  <a href="<?php echo generateSeoUrlAdmin("homepage","",""); ?>">
              <button class="btn btn-xs btn-danger">
               
												<i class="ace-icon fa fa-arrow-left bigger-110"></i>

												Back
												
											
											</button>	</a>
              
                </div>
              </div>
              <div class="widget-body">
                <div class="panel-body list">
                  <div class="table-responsive project-list">
                    <table class="table table-striped">
                      <thead>
                       
                        <tr>
                          <th>Sn#</th>
                          <th>User Id</th>
                         <th>Name</th>
                          <!--<th>Sponsor Id</th>-->
                         <!-- <th>City</th>-->
                          <th>Join</th>
                          <th>Active</th>
                          <th>Package</th>
                         <!-- <th>Action</th>-->
                        </tr>
                      </thead>
                      <tbody>
                                           <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=$PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):
					if(true){//$AR_DT['prod_pv'] > 0
			       ?>
                        <tr>
                          <td><?php echo $Ctrl;$Ctrl++; ?></td>
                          <td><?php echo strtoupper($AR_DT['user_id']); ?></td>
                          <td><?php echo strtoupper($AR_DT['name']);?></td>
                          <!--  <td><?php echo strtoupper($AR_DT['suserId']);?></td>-->
                        <!--  <td><?php echo $AR_DT['city_name']; ?></td>-->
                          <td><?php echo DisplayDate($AR_DT['date_join']); ?></td>
                          <td><?php echo DisplayDate($AR_DT['active_date']); ?></td>
                          <td><?php if($AR_DT['package_price'] > 0 ) { echo $AR_DT['package_price']; } else{ echo $model->getprodpack($AR_DT['member_id']);}?></td>
                          <!--<td><?php if($AR_DT['package_price'] > 0 ) { echo $AR_DT['package_price']; } else{ echo $model->getprodpack($AR_DT['member_id']);}?>[<?php echo $AR_DT['prod_pv']; ?>Pv ]</td>-->
                          <!--<td><a   onClick="return confirm('Make sure , you want to deactivate this member ?')" href="<?php echo generateSeoUrlAdmin("member","collectionList",array("member_id"=>_e($AR_DT['member_id']),"action_request"=>"DEACTIVATE")); ?>" >De-activate</a> </td>
                         --> 
                        </tr>
                        <?php  } endforeach; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.span -->
        </div>
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
 
  <?php $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
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
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		$("#form-valid").validationEngine();
		$("#form-valid").validationEngine();
		$(".getStateList").on('blur',getStateList);
		$(".getCityList").on('blur',getCityList);
		function getStateList(){
			var country_code = $("#country_code").val();
			var URL_STATE = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=STATE_LIST&country_code="+country_code;
			$("#state_name").load(URL_STATE);
		}
		function getCityList(){
			var state_name = $("#state_name").val();
			var URL_CITY = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=CITY_LIST&state_name="+state_name;
			$("#city_name").load(URL_CITY);
		}
	});
</script>
</body>
</html>
