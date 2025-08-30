<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET['page']; if($Page=="" || $Page <=0 ){$Page=1;}
$segment = $this->uri->uri_to_assoc(2);
		

 $member_id = ($form_data['member_id']>0)? $form_data['member_id']:_d($segment['member_id']);
$QR_PAGES="SELECT mem.*,sub.subcription_id as sub_id , sub.order_no as orderId , sub.date_from as subdate , pin.mrp as price from tbl_members as mem left join tbl_subscription as sub on mem.member_id = sub.member_id left join tbl_pintype as pin on sub.type_id = pin.type_id WHERE mem.member_id='".$member_id."'";
$Res = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
$Mem = $Res['ResultSet'][0];

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
          <h1> User <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Courier </small> </h1>
        </div>
       
      </div>
	  	<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/invoice/style.css" />
					
			
      <section class ="mt-xl-4">

<div class="container">
    <div class="row boderclassaman1">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Delivery Slip</h2><h3 class="pull-right">Order Id : <?php echo $Mem['orderId'];?></h3>
    		</div>
    		<hr>
    		<div class="row boderclassaman1">
    			<div class="col-xs-6">
    				<address>
    				<strong>Delivered To:</strong><br>
    					<?php echo $Mem['title'];?>. <?php echo $Mem['first_name'].' '.$Mem['last_name'];?><br>
    					<?php echo $Mem['current_address'];?><br>
    					<?php echo $Mem['city_name'];?>-<?php echo $Mem['pin_code'];?><br>
						<?php echo $Mem['state_name']; if($Mem['state_name'] !='' && $Mem['country_name'] !=''){?>, <?php } echo $Mem['country_name'];?>.
    				</address>
    					<strong>Contact No :</strong><?php echo $Mem['member_mobile'];?>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped By:</strong><br>
    				<?php echo $Mem['title'];?>. <?php echo $Mem['first_name'].' '.$Mem['last_name'];?><br>
    					<?php echo $Mem['current_address'];?><br>
    					<?php echo $Mem['city_name'];?>-<?php echo $Mem['pin_code'];?><br>
						<?php echo $Mem['state_name']; if($Mem['state_name'] !='' && $Mem['country_name'] !=''){?>, <?php } echo $Mem['country_name'];?>.
    				</address>
    					<strong>Contact No :</strong><?php echo $Mem['member_mobile'];?>
    			</div>
    		</div>
    		<!--<div class="row boderclassaman1  ">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					Visa ending **** 4242<br>
    					jsmith@email.com
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					March 7, 2014<br><br>
    				</address>
    			</div>
    		</div>  -->
    	</div>
    </div>
    
  <!--  <div class="row  boderclassaman1">
    	<div class="col-md-12">
    		
    			
    			
    				<div class="table-responsive mt-xl-3">
    					<table class="table table-bordered">
    						<thead>
                                <tr>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    						
    						
                             
                                <tr>
            						<td>BS-1000</td>
    								<td class="text-center">&#8377;&nbsp; <?php echo $Mem['price'];?></td>
    								<td class="text-center">1</td>
    								<td class="text-right">&#8377;&nbsp; <?php echo $Mem['price'];?></td>
    							</tr>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">&#8377;&nbsp; <?php echo $Mem['price'];?></td>
    							</tr>
    						
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right">&#8377;&nbsp;<?php echo $Mem['price'];?></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			
    		
    	</div>
    </div>  -->
    
      <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <br>
                  <h3><u>Note : If address is not found . Than product return </u></h3>
                 
				  <ul class="mt-20 px-0 list-unstyled">
					 <li class="text-bold-800">iRendezvous Online Marketing Pvt. Ltd.</li>
				   <li > 270-A, patparganj,Mayur Vihar Phase-1,</li>
                      <li> Near Aster Public School</li>
                     
                      <li>New Delhi-110091</li>
                          <li>Delhi ,India.</li>
				  </ul>
				  
			 <ol>	  </ol>
                </div>
				
				
			
				
				
				
                
              </div>
</div>
</section>
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
	$('.action-buttons').hide();
</script>
</body>
</html>
