<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$model = new OperationModel();
$form_data = $this->input->post();
$segment = $this->uri->uri_to_assoc(2);
 
$member_id = $this->session->userdata('mem_id');
 
 
$sale_id = _d($segment['sale_id']);
$QR_PAGES="SELECT *  FROM `tbl_sale` WHERE  sale_id='$sale_id' ";
$Invoice_data = $this->SqlModel->runQuery($QR_PAGES,1);

 




$QR_PAGES="SELECT P.*,S.product_price as pp, S.quantity as q ,S.total_price as tp  FROM   tbl_sale_product   as S left join tbl_product as P on S.products_id = P.product_id WHERE  sale_id='$sale_id' ";
$Res = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
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
            
            <div id="invoice-company-details" class="row">
              <div class="col-md-6 col-sm-6 col-xs-6 ">
                <div class="media">
                  <img src="<?php echo BASE_PATH;?>assets/logo.png" alt="company logo" class="" style="width: 30%;">
				  </div>
                  <div class="media-body">
                    <ul class="mt-20 px-0 list-unstyled" style="font-size: 16px;">
					 <li class="text-bold-800">VAAh Positive Life Style Pvt. Ltd.</li>
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
           
            <div id="invoice-customer-details" class="row pt-2">
             
              <div class="col-md-4 col-sm-4 col-xs-4 ">
              <strong>  <ul class="px-0 list-unstyled" style="font-size: 18px;">
				<li class="text-bold-800">Bill To :</li>
                  <li >  <?php echo $Invoice_data['name'];?> </li>
                  <li><?php echo $Invoice_data['address'];?></li>
			 
                  <li><?php echo $Invoice_data['city'];?>-<?php echo $Invoice_data['pin'];?></li>
                  <li><?php echo $Invoice_data['state']; if($Invoice_data['state'] !='' ){?>, <?php } echo 'India';?>.</li>
                   <li><i class="fa fa-phone" aria-hidden="true"></i> : <?php echo $Invoice_data['member_mobile'];?></li>
                </ul></strong>
				 
				
				
              </div>
			  
			  <div class="col-md-4 col-sm-4 col-xs-4 ">
               <strong> <ul class="px-0 list-unstyled" style="font-size: 18px;">
                  <li >  <?php echo $Invoice_data['name'];?> </li>
                  <li><?php echo $Invoice_data['address'];?></li>
			 
                  <li><?php echo $Invoice_data['city'];?>-<?php echo $Invoice_data['pin'];?></li>
                  <li><?php echo $Invoice_data['state']; if($Invoice_data['state'] !='' ){?>, <?php } echo 'India';?>.</li>
                   <li><i class="fa fa-phone" aria-hidden="true"></i> : <?php echo $Invoice_data['member_mobile'];?></li>
                </ul></strong></strong>
              </div>
			  
              <div class="col-md-4 col-sm-4 col-xs-4 ">
			  
			 <strong> <div class="invoiceid" style="font-size: 16px;">
			   <p> <span class="text-muted">Invoice ID : </span> VI/2018-19/00<?php echo $Invoice_data['sale_id'];?></p>
                <p> <span class="text-muted">Invoice Date :</span> <?php echo getDateFormat($Invoice_data['date_time'],"d M Y "); ?></p>
				  
                  <p><span class="text-muted">Oder ID :</span>  <?php echo $Invoice_data['user_id'];?></p>
                <p> <span class="text-muted">Reference :</span></p>
                <p> <span class="text-muted">Credit Terms :</span>) Online Payment</p>
				</div></strong>
              </div>
            </div>
			
			
			 
            <div id="invoice-items-details" class="pt-2">
              <div class="row">
                <div class="table-responsive ">
                  <table class="table table-bordered" style="font-size: 16px;">
                    <thead>
                      <tr>
                        <th class="text-center">Sn No</th>
                        <th class="text-center">Product Name </th>
						<th class="text-center">HSN Code </th>
			            <th class="text-center">UoM</th>
                         <th class="text-center">Qty</th>
						 <th class="text-center">MRP</th>
						<th class="text-center"> Amount</th>
					   
						<th class="text-center">GST (%)</th> 
                       
                        <th class="text-center"> Total Amount</th>
						
                      </tr>
                    </thead>
                    <tbody>
       <?php 
      
 

      
       if($Res['TotalRecords'] > 0){
						    $Ctrl=$Res['RecordStart']+1;
					        foreach($Res['ResultSet'] as $AR_DT):                
                   
                   if($Invoice_data['payment_by']=='R')
                   {
                      $gst =$AR_DT['r_gst']; 
                      $tgst +=$gst*$AR_DT['q'];  
                      
                     $tprice +=   $net =$AR_DT['r_net']; 
                          
                   }
                   else
                   {
                     $gst =$AR_DT['p_gst']; 
                     $tgst +=$gst*$AR_DT['q']; 
                  $tprice +=    $net =$AR_DT['p_net'];
                   }
                  $tmrp += $AR_DT['pp'];
		?>			                             
                
                      <tr>
                        <td scope="row" ><?php echo $Ctrl;?></td>
                       	<td ><?php echo $AR_DT['product_name'];?></td> 
			            <td class="text-center"><?php echo $AR_DT['hsn_code'];?></td> 
			            <td class="text-center"><?php echo $AR_DT['qty'];?></td> 
					     <td class="text-center"><?php echo $AR_DT['q'];?></td> 
						    <td class="text-center"><?php echo $AR_DT['pp'];?></td> 
						   <td class="text-center"> <strong><?php echo number_format($net,2);?>&nbsp;&#8377;</strong></td>
					      
						   <td class="text-center" ><strong> <?php echo  number_format( $gst*$AR_DT['q'],2)  .' ('.$AR_DT['tax'] .'%)';?></strong></td>
						   <td class="text-center"><strong> <?php echo number_format($AR_DT['tp'],2);?>&nbsp;&#8377;</strong></td>
                      </tr>
                       
                	  <?php $Ctrl++;
						   endforeach;	} ?>
	 
        <tr>
      
        <td colspan="4" class="text-right">
       <strong>
 Grand Total</strong>
        </td>
        
          <td class="text-center"><strong><?php  echo $Invoice_data['total_unit'];?> </strong> </td>
            <td class="text-center"><strong><?php  echo $tmrp;?>&nbsp;&#8377; </strong> </td>
            <td class="text-center"><strong><?php  echo number_format($tprice,2);?>&nbsp;&#8377;</strong> </td>
          
            <td class="text-center"><strong><?php  echo number_format($tgst,2);?>&nbsp;&#8377;</strong> </td>
            <td class="text-center"><strong><?php  echo number_format($Invoice_data['total_price'],2);?>&nbsp;&#8377;</strong> </td>
        </tr>
					  
			 
					  
					  
					  
					  
					  
                    </tbody>
                  </table>
                </div>
              </div>
			  
			  
              <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <p class="lead" style="font-size: 16px;">Total Amount(In Words) :- <strong><?php echo  ucfirst(numtowords($Invoice_data['total_price']));?>.</strong></p>
                  
                    
                    
                    
                  
                </div>
				
				
                <div class="col-md-12 col-sm-12">
                  <p class="lead"  style="font-size: 16px;">Comment :- This is Amazing experince to shopping with VAAH INDIA.  </p>
                  
				 
                </div>
              
			  
			  </div>
            </div>
          
           
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <h3><u>Terms &amp; Condition</u></h3>
                  <ol style="font-size: 16px;">
				  <li>I hereby certify that I have attained 18 years of age, being major and am ordering this product on my own accord and free will without any duress, influence and coercion.</li>
				  <li>I understand that the amount paid by me against this invoice is towards the purchase of the aforementioned products and is not towards any deposit, subscription or membership fee and 
therefore, I shall have no right to claim any interest or return on the same. I understand I can claim refund of the price of the product in terms of the User Agreement.</li>
			
			<li>Product free look period 30 days only.</li>
				  <li>I accept that all disputes shall be subject to jurisdiction of Courts at New Delhi only.</li>
				  	  
				  
				  
				  
				  </ol>
                </div>
				
				
				<div class="col-md-12 col-sm-12 col-xs-12" style="float:right;">
				
				
				<div class="invoiceid">
				    <br>
                    <p>for,VAAH INDIA</p>
            
            
                  </div>
				
				
				</div>
				    <p style="text-align: center;">This is computer generated invoice , Hence no signature required</p>    
				
				
                
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

 



