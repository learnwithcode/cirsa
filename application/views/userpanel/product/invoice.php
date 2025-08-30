<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$model = new OperationModel();
$form_data = $this->input->post();
$segment = $this->uri->uri_to_assoc(2);
$binary_rate = $model->getValue("CONFIG_BINARY_INCOME");
$member_id = $this->session->userdata('mem_id');
$request_id = _d($segment['request_id']);
$AR_PRSS = $model->getProcess();
$process_id = $AR_PRSS['process_id'];
 
$QR_PAGES="SELECT mem.*,sub.subcription_id as sub_id , sub.order_no as orderId , sub.date_from as subdate , pin.mrp as price ,pin.product as product_name , pin.unit as unit ,pin.product_id as productId ,pin.prod_pv as pv,pin.tax as tax, pin.tax_amt as tamt,pin.amount as amt from tbl_members as mem left join tbl_subscription as sub on mem.member_id = sub.member_id left join tbl_pintype as pin on sub.type_id = pin.type_id WHERE mem.member_id='".$member_id."'";
$Res = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
$Mem = $Res['ResultSet'][0];



?>






		
			

		
			

		

<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	
<style media="print">
 @page {
  size: auto;
  margin: 0;
       }
</style>

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>























<div class="main-content">
				<div class="main-content-inner">
					

					<div class="page-content">
						
                         	<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>

							
								
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						
	<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/invoice/style.css" />
					
						
						
    <section class="card">
          <div id="invoice-template" class="card-body  page-content">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
              <div class="col-md-6 col-sm-6 col-xs-6 ">
                <div class="media">
                  <img src="<?php echo BASE_PATH;?>assets/logo.png" alt="company logo" class="" style="width: 30%;">
				  </div>
                  <div class="media-body">
                    <ul class="mt-20 px-0 list-unstyled" style="font-size: 16px;">
					 <li class="text-bold-800">Vaah Positive Life Style</li>
                      <li >WH-71, First Floor, Mayapuri Industrial Area,</li>
                      <li> Phase-I, New Delhi-110064.</li>
                        <li>Delhi ,India.</li>
						  <li><i class="fa fa-phone" aria-hidden="true"></i>  011-41112587</li>
						  <li><i class="fa fa-envelope" aria-hidden="true"></i> : positivelifestyle18@gmail.com </li>
						      
					  
				

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
                  <li >  <?php echo $Mem['first_name'].' '.$Mem['midle_name'].' '.$Mem['last_name'];?> </li>
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
                   <li >  <?php echo $Mem['first_name'].' '.$Mem['midle_name'].' '.$Mem['last_name'];?> </li>
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
                        <th>Package Name </th>
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
       
                       
                   
					                             
                
                      <tr>
                        <th scope="row"><?php echo $sn;$sn++;?></th>
                        <td><strong>Business Starter  Kit</strong></td>

						<td > <strong>N/A</strong></td>
                     
						 <td class="text-right"><strong><?php echo $Mem['unit'];?></strong></td>
						
						   <td class="text-right"> <strong><?php echo $Mem['amt'];?>&nbsp;&#8377;</strong></td>
					 
						   <td class="text-right" ><strong> <?php echo   $Mem['tamt']  .' ('.$Mem['tax'] .'%)';?></strong></td>
						   <td class="text-right" ><strong> <?php echo $Mem['price'];?>&nbsp;&#8377;</strong></td>
                      </tr>
                       
                       
	  		  
	 
        <tr>
      
        <td colspan="6" class="text-right">
       <strong>
 Grand Total</strong>
        </td>
        
        
        <td class="text-right"><strong><?php  echo $Mem['price'];?>&nbsp;&#8377;</strong><strong></td>
        </tr>
					  
			 
					  
					  
					  
					  
					  
                    </tbody>
                  </table>
                </div>
              </div>
			  
			  
              <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <p class="lead" style="font-size: 16px;">Total Amount(In Words) :- <strong><?php echo  numtowords($Mem['price']);?>.</strong></p>
                  
                    
                    
                    
                  
                </div>
				
				
                <div class="col-md-12 col-sm-12">
                  <p class="lead"  style="font-size: 16px;">Comment :- This is Amazing experince to shopping with Vaah Positive Life Style </p>
                  
				 
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
                   
            
                  </div>
				
				
				</div>
				
				
				
                
              </div>
           
        
          </div>
        </section>
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>

		<script src="<?php echo BASE_PATH;?>assets/js/jquery-ui.custom.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/jquery.gritter.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/bootbox.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/jquery.easypiechart.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/bootstrap-datepicker.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/jquery.hotkeys.index.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/bootstrap-wysiwyg.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/select2.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/spinbox.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/bootstrap-editable.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/ace-editable.min.js"></script>
		<script src="<?php echo BASE_PATH;?>assets/js/jquery.maskedinput.min.js"></script>

 



