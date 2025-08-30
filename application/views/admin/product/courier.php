<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET['page']; if($Page=="" || $Page <=0 ){$Page=1;}
 
if($_GET['user_id']!=''){
	$user_id = FCrtRplc($_GET['user_id']);
	$StrWhr .=" AND ( tm.user_id = '$user_id' )";
	$SrchQ .="&user_id=$user_id";
}
 
   if($_GET['status']!=''){
	$status = FCrtRplc($_GET['status']);
	$StrWhr .=" AND ( O.courierstatus = '$status' )";
	$SrchQ .="&status=$status";
}


 
      	$QR_PAGES= "SELECT O.* ,M.user_id FROM `tbl_sale` as O   LEFT JOIN tbl_members as M on M.member_id = O.member_id    WHERE O.status='Y' and O.delivery_type='C'   $StrWhr  GROUP BY O.sale_id order by O.sale_id desc";
      
 

 
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
        
        <div class="row">
          <?php get_message(); ?>
          <div class="col-xs-12">
          <div class="row">
<div class="col-xs-12">
<h3 class="header smaller lighter blue">Product - Courier  History</h3>

       <div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
      <?php  get_message(); ?>
			 
   <div class="row">
              <div class="col-xs-12">
			   <h4 class="widget-title sm"> <?php get_message(); ?> </h4>
                <div class="clearfix">
                  <div class="row">
                    <form id="form-search" name="form-search" method="get" action="<?php echo generateAdminForm("product","courier",""); ?>">
                    
                    
                    
                     <div class="col-md-2"> 
                      
                     <h4>Delivery Status </h4>
                      </div>
                    
                       
                      <div class="col-md-3"> 
                    
                      <div class="form-group">
        
                        
                       <select class="form-control col-xs-12 col-md-12 col-sm-6 validate[required]" name="status">
            <option value="">Select</option>
            <option value="P" <?php if( $_GET['status']=='P'){echo "selected";}?>>In Process</option>
            
            <option value="H"<?php if( $_GET['status']=='H'){echo "selected";}?>>Hold/Pending</option>
             <option value="S" <?php if( $_GET['status']=='S'){echo "selected";}?>>Shiping</option>
            <option value="D" <?php if( $_GET['status']=='D'){echo "selected";}?>>Delivered </option>
        </select>
                      </div>
                      
                       </div>
                      
                       <div class="col-md-3"> 
                     <b></b>
                      <div class="form-group">
                        <div class="clearfix">
                         <input class="btn btn-primary m-t-n-xs" value=" Search " type="submit">
                        </div>
                      </div>
                        </div>
                      
                      
                    </form>
                  </div>
                  
                </div>
                <div class="clearfix">&nbsp;</div>
                <div class="table-responsive">
                  <table id="" class="table">
                    <thead>
                       
                        <th>Sn</th>
                      
                        <th>User Id</th>
                        <th>Name</th>
                        <th>Courier Date</th>
                        <th>Price</th>
                        <th>Courier Company</th>
                        <th>Courier Detail</th>
						<th>Remark</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                      <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  							    if($Page > 1)
						    {
						        $Page = ($Page -1)* 50 +1;
						    }
						    
						$Ctrl=$Page;
						foreach($PageVal['ResultSet'] as $AR_DT):
						if($AR_DT['courierstatus']=='P')
						{ $class="btn-yellow hover";}
						elseif($AR_DT['courierstatus'] =='H')
						{$class="btn-red hover";} 
							elseif($AR_DT['courierstatus'] =='S')
						{$class="btn-purple hover";} 
						else{ $class="btn-success hover";}
						
						//$AR_BAL = $model->getCurrentBalance($AR_DT['member_id'],$wallet_id,"","");
			       ?>
			       <tr class="<?php echo $class;?>" style="font-size: 18px;">
			             
			       <td><?php echo $Ctrl; ?></td>
			        
			       <td><?php echo strtoupper($AR_DT['user_id']); ?></td>
			       <td><a href="javascript:void(0)"><?php echo strtoupper($AR_DT['name']); ?></a></td>
			       <td><?php echo date('d-M-Y',strtotime($AR_DT['courierdate'])); ?></td>
			       <td><?php  echo  number_format(($AR_DT['total_price']),2); ?></td>
			        <td><?php echo $AR_DT['couriercompany']; ?></td>
			       <td><?php echo $AR_DT['courierno'];?></td>
			        <td><?php echo $AR_DT['courierremark'];?></td>
			       <td><?php if($AR_DT['courierstatus']=='P'){ echo 'In Process';}elseif($AR_DT['courierstatus'] =='H'){echo 'Pending / Hold';}elseif($AR_DT['courierstatus'] =='S'){echo 'Shipping';} else{ echo 'Delivered';}?></td>
			       <td>
			       
			       
			       <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>
                            <ul class="dropdown-menu dropdown-default">
                            			  
			                <li><a href="javascript:void(0);" data-toggle="modal" data-target="#update-modal<?php echo $AR_DT['sale_id']; ?>">Update</a></li>
					 	
                       
                              <li> <a   href="<?php echo generateAdminForm("product","view_sale_product",array("sale_id"=>_e($AR_DT['sale_id']))); ?>" target="_blank" >View</a> </li> 
                      
                              <li> <a   href="<?php echo generateAdminForm("product","invoice",array("sale_id"=>_e($AR_DT['sale_id']))); ?>" target="_blank" >Invoice</a> </li>
                            
                            
                           
 </ul>
                          </div>
			       
			       
			       </td>
			        </tr>
			        <div class="clearfix"></div>
    
  
   <div class="modal fade" id="update-modal<?php echo $AR_DT['sale_id']; ?>" role="dialog">
    <div class="modal-dialog modal-sm">
        <form action="<?php echo generateAdminForm("product","updateCourier","");  ?>" method="post">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #438EB9; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Courier Details</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="page" value="<?php echo $_GET['page'];?>">
                        <input type="hidden" name="sale_id"value="<?php echo $AR_DT['sale_id'];?>">
						
	        <label>Courier Company</label><input type="text" class="form-control" value="<?php echo $AR_DT['couriercompany'];?>"name="couriercompany"id="couriercompany" placeholder="Blue Dart">
								
        <label>Courier No .</label><input type="text" class="form-control" value="<?php echo $AR_DT['courierno'];?>"name="courierno"id="courierno" placeholder="0000001">
        <label>Courier Status</label><select class="form-control" name="courierstatus">
            <option value="">Select</option>
            <option value="P" <?php if($AR_DT['courierstatus']=='P'){echo 'selected';}?>>In Process</option>
            <option value="H" <?php if($AR_DT['courierstatus']=='H'){echo 'selected';}?>>Hold/Pending</option>
              <option value="S" <?php if($AR_DT['courierstatus']=='S'){echo 'selected';}?>>Shipping</option>
            <option value="D" <?php if($AR_DT['courierstatus']=='D'){echo 'selected';}?>>Delivered </option>
        </select>
		
		<label>Courier Date</label><input type="date" class="form-control" value="<?php echo date('Y-m-d',strtotime($AR_DT['courierdate']));?>"name="courierdate"id="courierdate" >
		<label>Remark</label><textarea class="form-control" name="courierremark"id="courierremark" ><?php echo $AR_DT['courierremark'];?></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" value="1" name="submitdata">Update</button>
        </div>
      </div>
    
    </form>
    </div>
  </div>
                
                      <?php $Ctrl++; endforeach; }else{ ?>
                      <tr>
                        <td colspan="7" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-xs-6">
                  <?php if($this->session->userdata('oprt_id') =='2'){?>
                   <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries </div> 
                    <?php } ?>
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
</div>
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



