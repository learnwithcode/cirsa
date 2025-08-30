<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET['page']; if($Page=="" || $Page <=0 ){$Page=1;}
$segment = $this->uri->uri_to_assoc(2);
		

 $member_id = ($form_data['member_id']>0)? $form_data['member_id']:_d($segment['member_id']);
$QR_PAGES="SELECT mem.*,sub.subcription_id as sub_id , sub.order_no as orderId , sub.date_from as subdate , pin.mrp as price ,pin.product as product_name , pin.unit as unit ,pin.product_id as productId ,pin.prod_pv as pv from tbl_members as mem left join tbl_subscription as sub on mem.member_id = sub.member_id left join tbl_pintype as pin on sub.type_id = pin.type_id WHERE mem.member_id='".$member_id."'";
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
<style media="print">
 @page {
  size: auto;
  margin: 0;
       }
</style>
</head>
<body class="skin-2">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
  <div class="main-content">
    <div class="main-content-inner" style="padding: 20px 20px 20px 20px;">
      <?php  $this->load->view(ADMIN_FOLDER.'/layout/breadcumb'); ?>
      <div class="page-content">
        <div class="page-header">
          <!--<h1> User <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Invoice </small> </h1>-->
        </div>
       
      </div>
	  	<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/invoice/style.css" />
					
		<?php // for($i=1;$i<3;$i++){?>	
      <section class="card">
          <div id="invoice-template" class="card-body  page-content">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
              <div class="col-md-6 col-sm-6 col-xs-6 ">
                <div class="media">
                  <img src="<?php echo BASE_PATH;?>assets/images/ran.png" alt="company logo" class="">
				  </div>
                  <div class="media-body">
                    <ul class="mt-20 px-0 list-unstyled" style="font-size: 16px;">
					 <li class="text-bold-800">iRendezvous Online Marketing Pvt. Ltd.</li>
                      <li >Reg.Off. - 270-A, patparganj,Mayur Vihar Phase-1,</li>
                      <li> Near Aster Public School</li>
                     
                      <li>New Delhi-110091</li>
                          <li>Delhi ,India.</li>
						  <li><i class="fa fa-phone" aria-hidden="true"></i>   011-45017866</li>
						  <li><i class="fa fa-envelope" aria-hidden="true"></i> : Info@rendezvousindia.com</li>
						     	<li><strong>Place Of Delivery : </strong>   Gwalior Madhya Pradesh</li>
					    <li>GSTIN:-23AAECI8493C1ZL</li>
					  
				

                    </ul>
                  </div>
                
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6 ">
			  <div  class="invoiceid">
                <h2>TAX INVOICE</h2>
                <p class="pb-3"></p>
                </div>
              </div>
            </div>
            <!--/ Invoice Company Details -->
            <!-- Invoice Customer Details -->
            <div id="invoice-customer-details" class="row pt-2">
             
              <div class="col-md-4 col-sm-4 col-xs-4 ">
              <strong>  <ul class="px-0 list-unstyled" style="font-size: 18px;">
				<li class="text-bold-800">Bill To :</li>
                  <li ><?php echo $Mem['title'];?>. <?php echo $Mem['first_name'].' '.$Mem['midle_name'].' '.$Mem['last_name'];?> </li>
                  <li><?php echo $Mem['current_address'];?></li>
				<!-- <li> In Front Of Centarl Bank of india</li>-->
                  <li><?php echo $Mem['city_name'];?>-<?php echo $Mem['pin_code'];?></li>
                  <li><?php echo $Mem['state_name']; if($Mem['state_name'] !='' && $Mem['country_name'] !=''){?>, <?php } echo $Mem['country_name'];?>.</li>
                   <li><i class="fa fa-phone" aria-hidden="true"></i> : <?php echo $Mem['member_mobile'];?></li>
                </ul></strong>
				
				
				
				<!--<div class="supplyto">-->
				<!--<p>Place Of Supply : Gwalior Madhya Pradesh</p>-->
				
				
				
				<!--</div>-->
				
				
              </div>
			  
			  <div class="col-md-4 col-sm-4 col-xs-4 ">
               <strong> <ul class="px-0 list-unstyled" style="font-size: 18px;">
				<li class="text-bold-800">Ship To :</li>
                   <li ><?php echo $Mem['title'];?>. <?php echo $Mem['first_name'].' '.$Mem['midle_name'].' '.$Mem['last_name'];?> </li>
                  <li><?php echo $Mem['current_address'];?></li>
				 <!--<li> In Front Of Centarl Bank of india</li>-->
                  <li><?php echo $Mem['city_name'];?>-<?php echo $Mem['pin_code'];?></li>
                  <li><?php echo $Mem['state_name']; if($Mem['state_name'] !='' && $Mem['country_name'] !=''){?>, <?php } echo $Mem['country_name'];?>.</li>
                   <li><i class="fa fa-phone" aria-hidden="true"></i> : <?php echo $Mem['member_mobile'];?></li>
                </ul></strong></strong>
              </div>
			  
              <div class="col-md-4 col-sm-4 col-xs-4 ">
			  
			 <strong> <div class="invoiceid" style="font-size: 16px;">
			   <p> <span class="text-muted">Invoice ID : </span> <?php echo $Mem['user_id'];?>-<?php echo $Mem['pv'];?>-<?php echo $Mem['sub_id'];?></p>
                <p> <span class="text-muted">Invoice Date :</span> <?php echo getDateFormat($Mem['subdate'],"d M Y "); ?></p>
				  
                  <p><span class="text-muted">Oder ID :</span> <?php echo $Mem['orderId'];?></p>
                <p> <span class="text-muted">Reference :</span></p>
                <p> <span class="text-muted">Credit Terms :</span>) Online Payment</p>
				</div></strong>
              </div>
            </div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
            <!--/ Invoice Customer Details -->
            <!-- Invoice Items Details -->
            <div id="invoice-items-details" class="pt-2">
              <div class="row">
                <div class="table-responsive ">
                  <table class="table table-bordered" style="font-size: 16px;">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Product Name/ID </th>
						 <th>HSN Code </th>
					<!--	<th >Description</th>  -->
						
                        <th class="text-right">Unit</th>
						
						<th class="text-right"> Amount</th>
						<!--<th class="text-right">IGST</th>
						<th class="text-right">SGST</th>
						<th class="text-right">CGST</th>-->
                       <th class="text-right">Tax</th>
                        <th class="text-right"> Total Amount</th>
						
                      </tr>
                    </thead>
                    <tbody>
                      <!--<tr>
                        <th scope="row">1</th>
                        <td ><?php echo $Mem['product_name'];?></td>

						<td > 5408</td>
                     
						 <td class="text-right"><?php echo $Mem['unit'];?></td>
						
						   <td class="text-right">&#8377;&nbsp; 3800</td>
						   <td class="text-right"> nill</td>
						   <td class="text-right"> 2.5%</td>
						   <td class="text-right" > 2.5%</td>
						   <td class="text-right" > &#8377;&nbsp;<?php echo $Mem['price'];?></td>
                      </tr>-->
                       
                       
					                      <?php     
                    $sn =1;
                        $productexplode = explode(',',$Mem['productId']);
foreach($productexplode as $ProductId)
{
    $productdata = $model->returnproductdetail($ProductId);
    $gst = $productdata['product_mrp'] * $productdata['tax']/100;
  
    $tax = $gst; 
    $tax = $tax*$Mem['unit'];
    $totaltax += $tax;
    $amount =  $productdata['product_mrp']*$Mem['unit'] - $tax;
   // $amt += $productdata['product_mrp']*$Mem['unit']; 
   $tamt += ($productdata['product_mrp'] *$Mem['unit'])+(ceil($tax)); 
?>
                      <tr>
                        <th scope="row"><?php echo $sn;$sn++;?></th>
                        <td><strong><?php //echo $productdata['product_name'];?> 3 GiZa Cotton Fabric (Premium White Shirt)</strong></td>

						<td > <strong><?php echo $productdata['hsn_code'];?></strong></td>
                        <!--<td > <?php echo $Mem['product_name'];?></td>-->
						 <td class="text-right"><strong><?php //echo $productdata['unit'];?>3</strong></td>
						
						   <td class="text-right"> <strong><?php echo $productdata['product_mrp'];?>&nbsp;&#8377;</strong></td>
						 <!--  <td class="text-right"> <?php echo ($productdata['igst'] > 0)?$productdata['igst'] .'%':'nill';?>  </td>
						   <td class="text-right"> <?php echo ($productdata['sgst'] > 0)?$productdata['sgst'] .'%':'nill';?></td>
						   <td class="text-right" > <?php echo ($productdata['cgst'] > 0)?$productdata['cgst'] .'%':'nill';?></td>-->
						   <td class="text-right" ><strong> <?php echo ($productdata['tax'] > 0)?ceil($tax) .' ('.$productdata['tax'] .'%)':'nill';?></strong></td>
						   <td class="text-right" ><strong> <?php echo ($productdata['product_mrp'] *$Mem['unit'])+(ceil($tax));?>&nbsp;&#8377;</strong></td>
                      </tr>
                       
                       
			<?php }
			//$discount = $amt - $Mem['price'];
			
			?>		  
					  
					  
					  
	      <!-- <tr>
       
        <td colspan="6" class="text-right">
       Total  Amount
        </td>
        
        
        <td class="text-right"><?php  echo ceil($amt);?>&nbsp;&#8377;</td>
        </tr>				  
        
        <tr>
       
        <td colspan="6" class="text-right">
       Total  Tax
        </td>
        
        
        <td class="text-right"><?php  echo ceil($totaltax);?>&nbsp;&#8377;</td>
        </tr>  
        <?php if($tamt > $Mem['price']){ ?>
       <tr>
        
        <td colspan="6" class="text-right">
        Discount 
        </td>
        
        
        <td class="text-right"><?php echo $tamt - $Mem['price'];?>&nbsp;&#8377;</td>
        </tr>
        <?php } ?>-->
        <tr>
      
        <td colspan="6" class="text-right">
       <strong>
 Grand Total</strong>
        </td>
        
        
        <td class="text-right"><strong><?php  echo $Mem['price'];?>&nbsp;&#8377;</strong><strong></td>
        </tr>
					  
					  
					  
					  
					  
				<!--	  <tr>
                        <th scope="row">2</th>
                        <td colspan="7">
                          Grand Total
                        </td>
                        
						    
                        <td class="text-right">&#8377;&nbsp;<?php echo $Mem['price'];?></td>
                      </tr>-->
					  
					  
					  
					  
					  
					  
					  
					  
					  
					  
                    </tbody>
                  </table>
                </div>
              </div>
			  
			  
              <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <p class="lead" style="font-size: 16px;">Total Amount(In Words) :- <strong><?php echo  numtowords($Mem['price']);?>.</strong></p>
                  
                    
                    
                    
                  
                </div>
				
				
                <div class="col-md-12 col-sm-12">
                  <p class="lead"  style="font-size: 16px;">Comment :- This is Amazing experince to shopping with iRendezvous Online Marketing Pvt. Ltd. </p>
                  
				 
                </div>
              
			  
			  </div>
            </div>
            <!-- Invoice Footer -->
           
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <h3><u>Terms &amp; Condition</u></h3>
                  <ol style="font-size: 16px;">
				  <li>I hereby certify that I have attained 18 years of age, being major and am ordering this product on my own accord and free will without any duress, influence and coercion.</li>
				  <li>I understand that the amount paid through draft attached with this invoice is towards the purchase of the aforementioned products and is not towards any deposit, subscription or membership fee and 
therefore, I shall have no right to claim any interest or return on the same. I understand I can claim refund of the price of the product in terms of the User Agreement.</li>
			
			<li>Product free look period 30 days only.</li>
				  <li>I accept that all disputes shall be subject to jurisdiction of Courts at New Delhi only.</li>
				  	  
				  
				  
				  
				  </ol>
                </div>
				
				
				<div class="col-md-12 col-sm-12 col-xs-12" style="float:right;">
				
				
				<div class="invoiceid">
				    <br>
                    <p>Authorized signatory</p>
                   
                <!--    <h6>Nityananad Sharma</h6>
                    <p class="text-muted">Managing Director</p>-->
                  </div>
				
				
				</div>
				
				
				
                
              </div>
           
            <!--/ Invoice Footer -->
          </div>
        </section>
        <?php // } ?>
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
