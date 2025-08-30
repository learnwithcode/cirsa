<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
  
    $member_id = $this->session->userdata('mem_id');
	 
	$QR_PAGES= "SELECT * FROM  `tbl_product`  WHERE status ='1'  ";
    $res = $this->SqlModel->runQuery($QR_PAGES);
   
	
	$QR_LINE="SELECT * FROM `tbl_sale`   WHERE order_by='U' and   member_id='$member_id' order by sale_id desc ";
    $PageVal = DisplayPages($QR_LINE, 10, $Page, $SrchQ);
 	$MEM_RES = $model-> getMemberdetail($member_id);
  
    
?>

		 		  
<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/bootstrap-datepicker3.min.css" />
	
<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
			<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/chosen.min.css" />

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

           <div class="main-content">
				<div class="main-content-inner">
					 <div class="page-content">
						
     <div class="row">
							<div class="col-xs-12">
							 
							<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>

							
								
							</div> 
						</div> 
	 <div class="row">
		<div class="col-xs-12">
		
	   
		
		<div class="widget-box">
		   <div class="widget-header widget-header-blue widget-header-flat">
		<h4 class="widget-title blue">Product Purchase Panel  </h4>
		
	 
		</div>
		
		<div class="widget-body">
		   <div class="widget-main">
		
		      <form action="<?php  echo  generateSeoUrlMember("sale","Confirm_order"); ?>" id="sample-form" enctype="multipart/form-data" class="form-horizontal" name="form-valid" autocomplete="off" method="post">
		
		
		<div id="fuelux-wizard-container">
		<?php echo get_message(); ?>
		
	
		
		<div class="step-content pos-rel">
		<div class="step-pane active" data-step="1">
		<h3 class="lighter block green"> Fill up your Personal Details</h3>
		
		<hr />		
		 <div class="alert alert-danger" id="alertBoxSale"  style="display:none"> 
											<button type="button" class="close" data-dismiss="alert" style="margin-right:10px">
												<i class="ace-icon fa fa-times"></i>
											</button>

											<strong>
												<i class="ace-icon fa fa-times"></i>
												Invalid !
											</strong>

											Please Select a valid user.
											<br>
		 </div>
		 
	 							
										
		 <div class="form-group ">
		<label for="E" class="col-xs-12 col-sm-3 control-label no-padding-right" style="cursor:pointer">User Id</label>
		
		<div class="col-xs-12 col-sm-5">
		<span class="block input-icon input-icon-right">
		<div class="input-group">
																	<span class="input-group-addon">
																		<i class="menu-icon flaticon-user bigger-110"></i>
																	</span>
 <input    id="user_id" name="user_id"  value="<?php echo $MEM_RES['user_id'];?>" class="form-control" type="text" placeholder='User Id' disabled='true'>
																</div>
																		</span>																</div>
</div>
		 
		 <div class="form-group ">
		<label for="E" class="col-xs-12 col-sm-3 control-label no-padding-right" style="cursor:pointer">Name</label>
		
		<div class="col-xs-12 col-sm-5">
		<span class="block input-icon input-icon-right">
		<div class="input-group">
																	<span class="input-group-addon">
																		<i class="menu-icon flaticon-user bigger-110"></i>
																	</span>
 <input    id="name" name="name"    value="<?php echo $MEM_RES['first_name'].' '.$MEM_RES['last_name'];?>" class="form-control" type="text" placeholder='Name' required>
																</div>
																		</span>																</div>
</div>
        
	     <div class="form-group ">
		<label for="E" class="col-xs-12 col-sm-3 control-label no-padding-right" style="cursor:pointer">Address</label>
		
		<div class="col-xs-12 col-sm-5">
		<span class="block input-icon input-icon-right">
		<div class="input-group">
																	<span class="input-group-addon">
																		<i class="menu-icon flaticon-location bigger-110"></i>
																	</span>
  <textarea name="address" id="address" class="form-control" > <?php echo $MEM_RES['current_address'];?></textarea>
																</div>
																		</span>																</div>
</div>

         <div class="form-group ">
		<label for="E" class="col-xs-12 col-sm-3 control-label no-padding-right" style="cursor:pointer">City</label>
		
		<div class="col-xs-12 col-sm-5">
		<span class="block input-icon input-icon-right">
		<div class="input-group">
																	<span class="input-group-addon">
																		<i class="menu-icon flaticon-location bigger-110"></i>
																	</span>
 <input    id="city" name="city"  value="<?php echo $MEM_RES['city_name'];?>" class="form-control" type="text" placeholder='City'>
																</div>
																		</span>																</div>
</div>

         <div class="form-group ">
		<label for="E" class="col-xs-12 col-sm-3 control-label no-padding-right" style="cursor:pointer">State</label>
		
		<div class="col-xs-12 col-sm-5">
		<span class="block input-icon input-icon-right">
		<div class="input-group">
																	<span class="input-group-addon">
																		<i class="menu-icon flaticon-location bigger-110"></i>
																	</span>
 <input    id="state" name="state"   value="<?php echo $MEM_RES['state_name'];?>" class="form-control" type="text" placeholder='State'>
																</div>
																		</span>																</div>
</div>

         <div class="form-group ">
		<label for="E" class="col-xs-12 col-sm-3 control-label no-padding-right" style="cursor:pointer">Pin Code</label>
		
		<div class="col-xs-12 col-sm-5">
		<span class="block input-icon input-icon-right">
		<div class="input-group">
																	<span class="input-group-addon">
																		<i class="menu-icon flaticon-location bigger-110"></i>
																	</span>
 <input    id="pin" name="pin"  value="<?php echo $MEM_RES['pin_code'];?>" class="form-control" type="text" placeholder='Pin Code'>
																</div>
																		</span>																</div>
</div>
		 
 
		
 
		
		</div>
		
		
		</div>
		</div>
		
		<hr />
		<div class="wizard-actions">
<input type="hidden" name="confirm" value="1" />
		
		<button class="btn btn-success " type="button"  onclick="ShowSaleModel();"   id="showmodelbtn">
		Confirm
		<i class="ace-icon fa fa-cloud-upload icon-on-right"></i>												</button>
		</div>
		</form>
		      <div class="panel-body list">
<div class="table-responsive project-list">
<table class="table table-striped">

			<thead>
			<tr>
		    <th class="text-center">Date</th>
			<th class="text-center">User Id</th>
			<th class="text-center">User Name</th>
			<th class="text-center">Total Quantity</th>
			<th class="text-center">Total Price</th>
			<th class="text-center">Status</th>
		    <th class="text-center">Action</th>
			</tr>
	  						
			</thead>
			<tbody>
   <?php 					if($PageVal['TotalRecords'] > 0){
						    $Ctrl=$PageVal['RecordStart']+1;
					        foreach($PageVal['ResultSet'] as $AR_DT):  ?>
		<tr>
		<td class="text-center">  <?php echo DisplayDate($AR_DT['date_time']);?></td>
		<td class="text-center"><?php echo $AR_DT['user_id'];?></td>
		<td class="text-center"><?php echo $AR_DT['name'];?></td>
		<td class="text-center"><?php echo $AR_DT['total_unit'];?></td>
		<td class="text-center"><?php echo $AR_DT['total_price'];?></td>
		<td class="text-center">  <?php if($AR_DT['status'] =='Y'){?> <span class="label label-lg label-success arrowed-in arrowed-in-right">Success</span><?php }  elseif($AR_DT['status'] =='N'){ ?><span class="label label-lg label-warning arrowed-in arrowed-in-right">Pending</span> <?php } else{?><span class="label label-lg label-danger arrowed-in arrowed-in-right">Reject</span>  <?php }?>  </td>
		<td class="text-center"> <a  target="_blank" href="<?php echo generateMemberForm("product","view_purchase_product",array("sale_id"=>_e($AR_DT['sale_id']))); ?>"> <span class="label label-lg label-primary arrowed-in arrowed-in-right">View <i class="ace-icon fa fa-eye bigger-110"></i></span>  </a>   
<?php if($AR_DT['status'] =='Y'){?>	<a  target="_blank" href="<?php echo generateMemberForm("product","product_invoice",array("sale_id"=>_e($AR_DT['sale_id']))); ?>"> 	<span class="label label-lg label-info arrowed-in arrowed-in-right">Invoice <i class="ace-icon fa fa-file bigger-110"></i></span> </a> <?php } ?>  </td>
		</tr>
		
		  <?php $Ctrl++;
						   endforeach;	}else{
												?>
											<tr>	<td colspan="7" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No data found</td></tr>
											<?php 
												}?>
		</tbody>
		</table>
		
		</div>
	 
		
		
		</div>
		
		
		
		
		
		
		
		
		    </div>
	     	</div>
			</div>
			</div>
			</div>
			         </div>
			    </div>
			</div>
			
			
        <div id="myModal" class="modal fade in" tabindex="-1" style="display: none; padding-right: 17px;" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog  modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="location.reload();">X </button>
          <h3 class="smaller lighter blue no-margin"><div class="table-header"> Sale to : 
				<strong id="sale_to"> </strong>
        </div> </h3>
         
           

 
		  <div id="accordion" class="accordion-style1 panel-group accordion-style2">
	   
	                                        <div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle IN"  aria-expanded="false" data-toggle="collapse">  
															<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															&nbsp;Select Your Payment Type
														</a>
													</h4>
												</div>

												<div class="panel-collapse in" id="collapseTwo" aria-expanded="false">
													<div class="panel-body">
													 
		
		
		<div id="fuelux-wizard-container">
	    <div class="step-content pos-rel">
		   <div class="step-pane active" data-step="1">
			<!--	<h3 class="lighter block green">Complete Your Payment Process &#8377; <span id="PAID_TO"><?php echo number_format($TotalMrp,2);?></span> /-</h3>
			
				<hr />	-->	
					 	<div class="alert alert-danger" id="alertBoxPayment"  style="display:none"> 
					<button type="button" class="close" data-dismiss="alert" style="margin-right:10px">
						<i class="ace-icon fa fa-times"></i>
					</button>
					<i class="ace-icon fa fa-times"></i>	<strong id="alertBoxPaymentMsg"> Invalid ! </strong> <br>
				 </div>
					 
					 
				   <div class="row" style="    background-color: burlywood;" id="ERow">
					   <div class="col-xs-12 col-sm-3">
						   <span class="btn btn-app btn-sm btn-light no-hover"> <h2> <i class="menu-icon flaticon-wallet"></i> E-wallet</h2> </span>
						</div>
					   <div class="col-xs-12 col-sm-5">
							<span class="block input-icon input-icon-right">
							<div class="input-group">
							  <span class="btn btn-app btn-sm btn-light no-hover">
								 &#8377;	<span class="line-height-1 bigger-170 blue"  id="ewallet"> <?php echo number_format($LDGR['net_balance'],2); ?>/- </span>
											<input type='hidden' id='total_E_amt' value=''> <br>
										 <span class="line-height-1 smaller-90">  
											 <label>
												<input name="switch-field-1" id="Echeck" onclick="changeStatus(this.checked,'E');" class="ace ace-switch ace-switch-6" type="checkbox">
												<span class="lbl"></span>
											</label>
										</span>	 
								</span>
						  </div>
						  </span>																
					   </div>
					   <div class="col-xs-12 col-sm-4">
							 <div class="alert alert-info" style="margin-top: 22px;"> <strong id="Ewallet_msg"> </strong> <br> </div> 
					  </div>
				   </div>
			 
				   <div class="row" style="    background-color: burlywood;" id="PRow">
					<div class="col-xs-12 col-sm-3">
					  <span class="btn btn-app btn-sm btn-light no-hover"> <h2> <i class="menu-icon flaticon-wallet"></i> P-wallet</h2>	 </span>
					</div>
					<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<div class="input-group">
						<span class="btn btn-app btn-sm btn-light no-hover">
						 &#8377;	<span class="line-height-1 bigger-170 blue"   id="pwallet"> <?php echo number_format($LDGR1['net_balance'],2); ?>/- </span>
									<input type='hidden' id='total_P_amt' value=''>
																	<br>
															 <span class="line-height-1 smaller-90">  
																	<label>
																		<input name="switch-field-1" id="Pcheck" onclick="changeStatus(this.checked,'P');" class="ace ace-switch ace-switch-6" type="checkbox">
																		<span class="lbl"></span>
																	</label>
															 </span>												
									</span>
						</div>
					 </span>																
					</div>
					<div class="col-xs-12 col-sm-4">
					   <div class="alert alert-info" style="margin-top: 22px;"> <strong id="Pwallet_msg"></strong> <br> </div>
					</div>
				  </div>
				  
				   <div class="row" style="    background-color: burlywood;" id="RRow">
					<div class="col-xs-12 col-sm-3">
					  <span class="btn btn-app btn-sm btn-light no-hover"> <h2> <i class="menu-icon flaticon-wallet"></i> R-wallet</h2>	 </span>
					</div>
					<div class="col-xs-12 col-sm-5">
					<span class="block input-icon input-icon-right">
						<div class="input-group">
						<span class="btn btn-app btn-sm btn-light no-hover">
						 &#8377;	<span class="line-height-1 bigger-170 blue"   id="rwallet"> <?php echo number_format($LDGR2['net_balance'],2); ?>/- </span>
									<input type='hidden' id='total_R_amt' value=''>
																	<br>
															 <span class="line-height-1 smaller-90">  
																	<label>
																		<input name="switch-field-1" id="Rcheck" onclick="changeStatus(this.checked,'R');" class="ace ace-switch ace-switch-6" type="checkbox">
																		<span class="lbl"></span>
																	</label>
															 </span>												
									</span>
						</div>
					 </span>																
					</div>
					<div class="col-xs-12 col-sm-4">
					   <div class="alert alert-info" style="margin-top: 22px;"> <strong id="Rwallet_msg"></strong> <br> </div>
					</div>
				  </div>
	         </div>
		 </div>
	   </div>
		
	 
		<hr />
		<div class="wizard-actions">
<!--			 <button class="btn btn-danger " type="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"  > 
			   <i class="ace-icon fa fa-angle-double-left icon-on-right"></i>Back </button>-->
				 <a data-parent="#accordion" href="#collapseFour"  data-toggle="collapse" id="payNext"></a>
			 <button class="btn btn-success " type="button" data-toggle="collapse" onclick="getPayment();"  >
					Next <i class="ace-icon fa fa-angle-double-right icon-on-right"></i>											
			 </button>
		</div>
		 
													</div>
												</div>
											</div>
	                                        <div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle   collapsed"  aria-expanded="false" data-toggle="collapse">  
															<i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															Select Product for Sale
														</a>
													</h4>
												</div>

												<div class="panel-collapse collapse" id="collapseFour" aria-expanded="false">
													<div class="panel-body">
													
										<div class="alert alert-danger" id="alertBoxProduct"  style="display:none"> 
											<button type="button" class="close" data-dismiss="alert" style="margin-right:10px">
												<i class="ace-icon fa fa-times"></i>
											</button>

										<i class="ace-icon fa fa-times"></i>	<strong id="alertBoxProductMsg">
												
												Invalid !
											</strong>

											 
											<br>
		 </div>
		<hr />					
												
												<ul class="ace-thumbnails clearfix">
									 <?php  
	$k =1;						
	foreach($res as $val){
	?>  
	<input type="hidden" id="status<?php echo $k;?>" value="0" />
	<input type="hidden" id="productId<?php echo $k;?>" value="<?php echo $val['product_id'];?>" />
	<li style="cursor: pointer; " onclick="selectProduct('icon<?php echo $k;?>','text<?php echo $k;?>','<?php echo $val['product_id'];?>','status<?php echo $k;?>');">
											<div>
												<img width="150" height="150" alt="150x150" src="<?php echo BASE_PATH;?>upload/product/<?php echo $val['image'];?>">
												<div class="text" id="text<?php echo $k;?>" > 
													<div class="inner">
														<span><?php echo $val['product_name'];?></span>

														<br>
													 

  	<a href="javascript:void(0);" >
															<i class="ace-icon fa fa-shopping-cart green" style="font-size: 50px;" id="icon<?php echo $k;?>"></i>
														</a>

													 
													</div>
												</div>
											</div>
										</li>
	
	 
	<?php $k++;  } ?>	

										

									 
									</ul>
									
	     <hr />
		<div class="wizard-actions">
        <button class="btn btn-danger " type="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"  > 
			   <i class="ace-icon fa fa-angle-double-left icon-on-right"></i>Back </button>
		<a  data-toggle="collapse" data-parent="#accordion" href="#collapseOne"  id='b1' style="display:none;"></a>
		<button class="btn btn-success " type="button" onclick="getProductList();">
		Next
		<i class="ace-icon fa fa-angle-double-right icon-on-right"></i>												</button>
		</div>
												
												
												
													</div>
												</div>
											</div>
                                            <div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle collapsed IN"  aria-expanded="false" data-toggle="collapse"> <!--data-toggle="collapse" data-parent="#accordion" href="#collapseOne"-->
															<i class="bigger-110 ace-icon fa fa-angle-right" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															Arrenge your product
														</a>
													</h4>
												</div>

												<div class="panel-collapse collapse" id="collapseOne" aria-expanded="false" style="height: 0px;">
													<div class="panel-body" id="producthtml">
														  
													</div>
												</div>
											</div>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
				 <a class="accordion-toggle collapsed"  aria-expanded="false" > <!-- data-toggle="collapse"data-parent="#accordion" href="#collapseThree"-->
															<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
															&nbsp;Confirm
														</a>
													</h4>
												</div>

												<div class="panel-collapse collapse" id="collapseThree" aria-expanded="false">
													<div class="panel-body">
													 
											<div class="alert alert-danger" id="alertBoxSaleConfirm"  style="display:none"> 
											<button type="button" class="close" data-dismiss="alert" style="margin-right:10px">
												<i class="ace-icon fa fa-times"></i>
											</button>

										<i class="ace-icon fa fa-times"></i>	<strong id="alertBoxSaleConfirmMsg">
												
												Invalid !
											</strong>

											 
											<br>
		 </div>
												<div class="alert alert-block alert-success">
											 <p style="display:none;">
											
											<label>
												<input name="switch-field-1" id="del_type" onClick="return updatestatus();" class="ace ace-switch ace-switch-6" type="checkbox"> 
												 <!--checked="checked" -->
											<span class="lbl"> </span>	
											</label>
											 <strong  id="del_typeMsg">
													By Shop 
												</strong> 
											</p>

											<p>
												<strong>
													<i class="ace-icon fa fa-check"></i>
													Confirm !
												</strong>
											If you are sure to payment this entry click on confirm.
											</p>

											<p>
											<button class="btn btn-danger " type="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"  >
	<i class="ace-icon fa fa-angle-double-left icon-on-right"></i>			Back
												</button>
											<button class="btn btn-success " onclick="makeconfirm();">
		Confirm
		<i class="ace-icon fa fa-cloud-upload icon-on-right"></i>												</button>
											</p>
										</div>	 
													 
													  
	<hr />
		<div class="wizard-actions">
 
			<strong>
											if you want to cancel this entry click on cancel
												</strong>
													<button class="btn btn-danger  "  type="button"   data-dismiss="modal" aria-hidden="true"  onclick="location.reload();">
	<i class="ace-icon fa fa-times icon-on-right"></i>			Cancel
												</button>
		
		</div>
													</div>
												</div>
											</div>
											
										</div>
									 
          </div>
          <div class="modal-footer">
         
     
          </div>
       
      </div>
  
    </div>
  
  </div>
 
		<script>
		function updatestatus(){

var status = document.getElementById('del_type').checked;
  if(status == true)
  {
  $('#del_typeMsg').html('By Shop');
  }
  else
  {
  $('#del_typeMsg').html('By Courier');
  }}
	    function changeStatus(status,type)
		 {
		 if(type =='E')
		 {  if(status ==true){  
	      document.getElementById('Pcheck').checked=false;
	       document.getElementById('Rcheck').checked= false;
		 }	 }
		 else if(type =='R')
		 {  if(status ==true){  
	      document.getElementById('Pcheck').checked=false;
	       document.getElementById('Echeck').checked= false;
		 }	 }
		 else
		 {if(status ==true){ 
		  document.getElementById('Echeck').checked= false;
		   document.getElementById('Rcheck').checked= false;
		  }	 }
		   
		 
		}
		function makeconfirm()
		 {
		  
		   var user_id    = document.getElementById('user_id').value;
		   var Echeck     =	  document.getElementById('Echeck').checked;	
	       var Pcheck     =	  document.getElementById('Pcheck').checked;
	        var Rcheck     =	  document.getElementById('Rcheck').checked;
	           var del_type = document.getElementById('del_type').checked;
           var product_dmrp_Total = document.getElementById('product_dmrp_Total').value;	 
           var Ewal =      document.getElementById('total_E_amt').value;
	       var Pwal =	  document.getElementById('total_P_amt').value;	
	           var Rwal =      document.getElementById('total_R_amt').value;
		   var name =      document.getElementById('name').value;	
		   var address =   document.getElementById('address').value;	
		   var city =    document.getElementById('city').value;	
		   var state =  document.getElementById('state').value;	
		   var pin =  document.getElementById('pin').value;	
			var qty = $("input[name='qty[]']").map(function(){return $(this).val();}).get();
			var Prod_id = $("input[name='Product_Id[]']").map(function(){return $(this).val();}).get();  
			var Product_name  = $("input[name='Product_name[]']").map(function(){return $(this).val();}).get();  
			var prod_mrp  = $("input[name='prod_mrp[]']").map(function(){return $(this).val();}).get();  
			var product_bv = $("input[name='product_bv[]']").map(function(){return $(this).val();}).get();  
				var hsn_code = $("input[name='hsn_code[]']").map(function(){return $(this).val();}).get();    
				//var mrp = $("input[name='mrp[]']").map(function(){return $(this).val();}).get();    
				//var base_price = $("input[name='base_price[]']").map(function(){return $(this).val();}).get();    
			   //var tax = $("input[name='tax[]']").map(function(){return $(this).val();}).get();    
		      //var tax_amt = $("input[name='tax_amt[]']").map(function(){return $(this).val();}).get();    
			  var flag=0;
			   
			  if(Echeck == true )  { 
			      if(Number(Ewal) >= Number(product_dmrp_Total)){flag =1;  }  }
			  else if(Rcheck == true){ if(Number(Rwal) >= Number(product_dmrp_Total)){flag =1;  }  }
			  else  { if(Pwal >= Number(product_dmrp_Total)){flag =1;  }  }
			  if(flag > 0)
			  {
			  jQuery.ajax({
		   type: "POST",
           url: "<?php echo BASE_PATH; ?>" + "member/product/confirmSale",
           data: {user_id: user_id,Echeck:Echeck,Pcheck:Pcheck,Rcheck:Rcheck,Rwal:Rwal,qty:qty,Prod_id:Prod_id,Product_name:Product_name,prod_mrp:prod_mrp,product_bv:product_bv,product_dmrp_Total:product_dmrp_Total,Ewal:Ewal,Pwal:Pwal,name:name,address:address,city:city,state:state,pin:pin,submitSale:'1',hsn_code:hsn_code,del_type:del_type},
           success: function(res) {
            
			window.location.reload();
		 
              }
			});
			  }
			  else
			  {
	 $("#alertBoxSaleConfirm").show();
     $("#alertBoxSaleConfirmMsg").html('You low balance on your Wallet'); 
     setTimeout(function() {  $('#alertBoxSaleConfirm').fadeOut('fast');}, 5000);
			  }
		 
		   
		}
		function selectProduct(iconId,textId,ProductId,status)
		 {
	 
		var status_val = parseInt(document.getElementById(status).value);
		 
		 if(status_val == '0')
		{
		 $("#"+iconId).removeClass("fa-shopping-cart");
		 $("#"+iconId).addClass("fa-check");
		 $("#"+textId).css('opacity','1');
		 document.getElementById(status).value='1'; 
		 
		  
		}
		else
		{
	  
		 document.getElementById(status).value='0';
		 $("#"+iconId).removeClass("fa-check");
		 $("#"+iconId).addClass("fa-shopping-cart");
		 $("#"+textId).css('opacity' , '' );  
		} 
		
  
		}
		function getProductList()
		 {
		   var Echeck     =	  document.getElementById('Echeck').checked;	
	       var Pcheck     =	  document.getElementById('Pcheck').checked;
	       var Rcheck     =	  document.getElementById('Rcheck').checked;
		var i = parseInt('<?php echo $k;?>');
		var total = i-1;
		var j=1;
		var data='';
			for(j=1;j<=total;j++)
			{
			 var status_val = parseInt(document.getElementById("status"+j).value);//status productId
					if(status_val > 0)
					{
					      if(data !='')
						  {
						  data +=  ','+parseInt(document.getElementById("productId"+j).value);
						  }
						  else
						  {
						  data += parseInt(document.getElementById("productId"+j).value);
						  }
					}	  
			}
			if(data !='')
			{
		  jQuery.ajax({
		   type: "POST",
           url: "<?php echo BASE_PATH; ?>" + "member/product/getselectedProduct",
           data: {data: data,Echeck:Echeck,Pcheck:Pcheck,Rcheck:Rcheck,status:'1'},
           success: function(res) {
            $("#producthtml").html(res);
             $("#b1").click();
              }
			});
			}
			else
			{
		//	alert('Please select atleast one Product.');
		 $("#alertBoxProduct").show();
    $("#alertBoxProductMsg").html('Please select atleast one Product.'); 
       setTimeout(function() {  $('#alertBoxProduct').fadeOut('fast');}, 5000);
			}
		 
		}
		function getnum(id,type,mrp,subtotal,product_bv,bv_unit)
         {
var quantity = document.getElementById(id).value;
var num = parseInt(quantity);
var rate = parseFloat(mrp);
var bv_units = parseFloat(bv_unit);
var total_product = parseInt(document.getElementById('AR_PRODUCT').value);
var total_quantity = '';
var total_price ='';
var TBVV ='';
 if(type =='B')
 {
  
    
    $("#"+subtotal).html(  parseFloat(rate*(num+1)).toFixed(2));
    $("#"+product_bv).html(  parseFloat(bv_units*(num+1)).toFixed(2));
	  document.getElementById(id).value=num+1;
	  var QT1 = '';
	  for(var x = 1;x<= total_product;x++)
	  {
	  
	   var QT = parseInt(document.getElementById('qty'+x).value);
	   total_quantity = Number(QT)+Number(total_quantity); 
	   
	   var TP = parseFloat(document.getElementById('MRP_'+x).value).toFixed(2);
	   total_price = parseFloat((Number(TP)*Number(QT)) +Number(total_price)).toFixed(2);
	   
	   var TBV = parseFloat(document.getElementById('product_bv'+x).value).toFixed(2);
	   TBVV = parseFloat((Number(TBV)*Number(QT)) +Number(TBVV)).toFixed(2);
	   
	  }
	  
	    $("#items").html( total_quantity);
		$("#net_imt").html(total_price);
	 	$("#PAID_TO").html(total_price);
	 	$("#totalBVV").html(TBVV);
		
	   document.getElementById('product_dmrp_Total').value=total_price;
   
   
 }
 else
 {
  
   if(num > 1)
   {
      $("#"+subtotal).html(  parseFloat(rate*(num-1)).toFixed(2));
        $("#"+product_bv).html(  parseFloat(bv_units*(num-1)).toFixed(2));
	  document.getElementById(id).value=num-1;
	    var QT1 = '';
	  for(var x = 1;x<= total_product;x++)
	  {
	  
	   var QT = parseInt(document.getElementById('qty'+x).value);
	   total_quantity = Number(QT)+Number(total_quantity); 
	   
	   var TP = parseFloat(document.getElementById('MRP_'+x).value).toFixed(2);
	   total_price = parseFloat((Number(TP)*Number(QT)) +Number(total_price)).toFixed(2);
	   
	    var TBV = parseFloat(document.getElementById('product_bv'+x).value).toFixed(2);
	   TBVV = parseFloat((Number(TBV)*Number(QT)) +Number(TBVV)).toFixed(2);
	   
	  }
	  
	    $("#items").html( total_quantity);
		$("#net_imt").html(total_price);
		$("#PAID_TO").html(total_price);
	 	$("#totalBVV").html(TBVV);
		
	   document.getElementById('product_dmrp_Total').value=total_price;
   } 
   
 
 }
 
 }
	    function getWalletBal()
	     {
	
	var product_dmrp_Total = document.getElementById('product_dmrp_Total').value;
    var user_id = document.getElementById('user_id').value;
	
	$("#PAID_TO").html(product_dmrp_Total);
	 
			 
	  jQuery.ajax({
		   type: "POST",
           url: "<?php echo BASE_PATH; ?>" + "member/product/getwalletBalUser",
           data: {user_id: user_id},
           success: function(res) {
		  var data = jQuery.parseJSON(res);
            $("#ewallet").html(data.Ewallet);
            $("#pwallet").html(data.Pwallet);	
				 
          document.getElementById('total_E_amt').value=data.Ewal;
		  document.getElementById('total_P_amt').value=data.Pwal;
		  if(data.Ewal>= product_dmrp_Total && data.Pwal>= product_dmrp_Total)
		  {
		       
			   $("#Ewallet_msg").html('you have also available balance in your E-wallet');
			   $("#Pwallet_msg").html('you have also available balance in your P-wallet');
			   $("#ERow").css('opacity','');
			   $("#PRow").css('opacity','');
			   $("#Echeck").removeAttr('disabled');
			   $("#Pcheck").removeAttr('disabled');
			 
			 
		  }
		  else if(data.Ewal>= product_dmrp_Total && data.Pwal > '0')
		  {
		       $("#Ewallet_msg").html('you have also available balance in your E-wallet');
			   $("#Pwallet_msg").html('you have low balance in your P-wallet');
			   $("#ERow").css('opacity','');
			   $("#PRow").css('opacity','');
			   $("#Echeck").removeAttr('disabled');
			   $("#Pcheck").removeAttr('disabled');
			 
		  }
		  else if(data.Ewal>= product_dmrp_Total && data.Pwal == '0')
		  {
		       $("#Ewallet_msg").html('you have also available balance in your E-wallet');
			   $("#Pwallet_msg").html('you have insufficent balance in your P-wallet');
			   $("#PRow").css('opacity','0.5');
			   $("#Pcheck").prop('disabled','true');
			   $("#Echeck").removeAttr('disabled');
			   $("#ERow").css('opacity','');
			 
		  }
		   else if(data.Pwal>= product_dmrp_Total && data.Ewal > '0')
		  {
		       $("#Ewallet_msg").html('you have low balance in your E-wallet');
			   $("#Pwallet_msg").html('you have also available balance in your P-wallet');
			   $("#ERow").css('opacity','');
			   $("#PRow").css('opacity','');
			   $("#Echeck").removeAttr('disabled');
			   $("#Pcheck").removeAttr('disabled');
			 
		  }
		  else if(data.Pwal>= product_dmrp_Total && data.Ewal == '0')
		  {
		       $("#Ewallet_msg").html('you have insufficent balance in your E-wallet');
			   $("#Pwallet_msg").html('you have also available balance in your P-wallet');
			   $("#ERow").css('opacity','0.5');
			   $("#Echeck").prop('disabled','true');
			   $("#PRow").css('opacity','');
			   $("#Pcheck").removeAttr('disabled');
			 
		  }
		  
		  else if(Number(data.Ewal+data.Pwal) >=product_dmrp_Total )
		  {
		       $("#Ewallet_msg").html('you have low balance in your E-wallet');
			   $("#Pwallet_msg").html('you have low balance in your P-wallet');
			   $("#ERow").css('opacity','');
			   $("#PRow").css('opacity','');
			   $("#Echeck").removeAttr('disabled');
			   $("#Pcheck").removeAttr('disabled');
			 
		  }
		  
		  else
		  { 
		   $("#Ewallet_msg").html('you have insufficent balance in your E-wallet');
		   $("#Pwallet_msg").html('you have insufficent balance in your P-wallet');
		   $("#ERow").css('opacity','0.5');
		   $("#PRow").css('opacity','0.5');
		   $("#Echeck").prop('disabled','true');
		   $("#Pcheck").prop('disabled','true');
		  
		  }
		  
			
              }
			});
	
	}	 
        function ShowSaleModel()
	     {
	var userId = document.getElementById('user_id').value;
    var name = document.getElementById('name').value;
	if(userId !='')
	{
	 
	  jQuery.ajax({
		   type: "POST",
           url: "<?php echo BASE_PATH; ?>" + "member/product/getwalletBalUser",
           data: {user_id: userId},
           success: function(res) {
		  var data = jQuery.parseJSON(res);
            $("#ewallet").html(data.Ewallet);
            $("#pwallet").html(data.Pwallet);	
			$("#rwallet").html(data.Rwallet);		 
          document.getElementById('total_E_amt').value=data.Ewal;
		  document.getElementById('total_P_amt').value=data.Pwal;
	      document.getElementById('total_R_amt').value=data.Rwal;
	      
		  if(data.Ewal >'0' && data.Pwal > '0' &&  data.Rwal > '0')
		  {
		     
			   $("#Ewallet_msg").html('you have also available balance in your E-wallet');
			   $("#Pwallet_msg").html('you have also available balance in your P-wallet');
			   $("#Rwallet_msg").html('you have also available balance in your R-wallet');
			   $("#ERow").css('opacity','');
			   $("#PRow").css('opacity','');
			   $("#RRow").css('opacity','');
			   $("#Echeck").removeAttr('disabled');
			   $("#Pcheck").removeAttr('disabled');
			   $("#Rcheck").removeAttr('disabled');
			 
		  }
		 
		  else if(data.Ewal>'0' && data.Pwal == '0' && data.Rwal == '0')
		  {
		     
		       $("#Ewallet_msg").html('you have also available balance in your E-wallet');
			   $("#Pwallet_msg").html('you have insufficent balance in your P-wallet');
			   $("#Rwallet_msg").html('you have insufficent balance in your R-wallet');
			   $("#PRow").css('opacity','0.5');
			   $("#RRow").css('opacity','0.5');
			   $("#Pcheck").prop('disabled','true');
			   $("#Rcheck").prop('disabled','true');
			   $("#Echeck").removeAttr('disabled');
			   $("#ERow").css('opacity','');
			 
		  }
		  
		  else if(data.Pwal> '0' && data.Ewal == '0' && data.Rwal == '0')
		  {
		  
		      
		       $("#Ewallet_msg").html('you have insufficent balance in your E-wallet');
			   $("#Pwallet_msg").html('you have also available balance in your P-wallet');
			   $("#Rwallet_msg").html('you have insufficent balance in your R-wallet'); 
			   $("#ERow").css('opacity','0.5');
			   $("#RRow").css('opacity','0.5');
			   $("#Echeck").prop('disabled','true');
			   $("#Rcheck").prop('disabled','true');
			   $("#PRow").css('opacity','');
			   $("#Pcheck").removeAttr('disabled');
			 
		  }
		  
		 else if(data.Rwal> '0' && data.Ewal == '0' && data.Pwal == '0')
		  {
		  
		      
		       $("#Ewallet_msg").html('you have insufficent balance in your E-wallet');
			   $("#Rwallet_msg").html('you have also available balance in your R-wallet');
			   $("#Pwallet_msg").html('you have insufficent balance in your P-wallet'); 
			   $("#ERow").css('opacity','0.5');
			   $("#PRow").css('opacity','0.5');
			   $("#Echeck").prop('disabled','true');
			   $("#Pcheck").prop('disabled','true');
			   $("#RRow").css('opacity','');
			   $("#Rcheck").removeAttr('disabled');
			 
		  }
		  
	    else if(data.Rwal> '0' && data.Ewal > '0' && data.Pwal == '0')
		  {
		  
		      
		       $("#Ewallet_msg").html('you have also available balance in your E-wallet');
			   $("#Rwallet_msg").html('you have also available balance in your R-wallet');
			   $("#Pwallet_msg").html('you have insufficent balance in your P-wallet'); 
			    
			   $("#PRow").css('opacity','0.5');
			   $("#Pcheck").prop('disabled','true');
			   $("#RRow").css('opacity','');
			   $("#Rcheck").removeAttr('disabled');
			   $("#ERow").css('opacity','');
			   $("#Echeck").removeAttr('disabled');
		  }
		  
		   else if(data.Rwal> '0' && data.Pwal > '0' && data.Ewal == '0')
		  {
		  
		      
		       $("#Ewallet_msg").html('you have insufficent balance in your E-wallet');
			   $("#Rwallet_msg").html('you have also available balance in your R-wallet');
			   $("#Pwallet_msg").html('you have also available balance in your P-wallet'); 
			    
			   $("#ERow").css('opacity','0.5');
			   $("#Echeck").prop('disabled','true');
			   $("#RRow").css('opacity','');
			   $("#Rcheck").removeAttr('disabled');
			   $("#PRow").css('opacity','');
			   $("#Pcheck").removeAttr('disabled');
		  }
		  	   else if(data.Ewal> '0' && data.Pwal > '0' && data.Rwal == '0')
		  {
		  
		      
		       $("#Ewallet_msg").html('you have also available balance in your E-wallet');
			   $("#Rwallet_msg").html('you have insufficent balance in your R-wallet');
			   $("#Pwallet_msg").html('you have insufficent balance in your P-wallet'); 
			    
			   $("#RRow").css('opacity','0.5');
			   $("#Rcheck").prop('disabled','true');
			   $("#PRow").css('opacity','');
			   $("#Pcheck").removeAttr('disabled');
			   $("#ERow").css('opacity','');
			   $("#Echeck").removeAttr('disabled');
		  }
		  else
		  { 
		   
		   $("#Ewallet_msg").html('you have insufficent balance in your E-wallet');
		   $("#Pwallet_msg").html('you have insufficent balance in your P-wallet');
		    $("#Rwallet_msg").html('you have insufficent balance in your P-wallet');
		   $("#ERow").css('opacity','0.5');
		   $("#PRow").css('opacity','0.5');
		     $("#RRow").css('opacity','0.5');
		   $("#Echeck").prop('disabled','true');
		   $("#Pcheck").prop('disabled','true');
		   $("#Rcheck").prop('disabled','true');
		  }
		  
			
              }
			});
	
	
	 $('#myModal').modal('show');
	 
	 
	$('#sale_to').html(name+' [ '+userId+' ]');
	}
	else
	{
	$("#alertBoxSale").show();
       
       setTimeout(function() {
  $('#alertBoxSale').fadeOut('fast');
}, 5000);
	}
	
	
	}
        function getPayment()
         {
    /*  var product_dmrp_Total = document.getElementById('product_dmrp_Total').value;	 */ 
      var Ewal =      document.getElementById('total_E_amt').value;
	  var Pwal =	  document.getElementById('total_P_amt').value;
	  var Rwal =	  document.getElementById('total_R_amt').value;
	  var Echeck =	  document.getElementById('Echeck').checked;	
	  var Pcheck =	  document.getElementById('Pcheck').checked;	
	  var Rcheck =	  document.getElementById('Rcheck').checked;
 	     if(Echeck==true || Pcheck==true || Rcheck ==true)
		 {
	 
		  $("#payNext").click();
		   
		 }
		 
		 else
		 {
		
	  if(Number(Pwal+Ewal+Rwal) > 0 )
		   {  
	   $("#alertBoxPayment").show();
       $("#alertBoxPaymentMsg").html('Please select wallet'); 
       setTimeout(function() {  $('#alertBoxPayment').fadeOut('fast'); }, 5000);
		   }
		   else
		   {  
	   $("#alertBoxPayment").show();
       $("#alertBoxPaymentMsg").html('you have insufficent balance in your E-wallet'); 
       setTimeout(function() {  $('#alertBoxPayment').fadeOut('fast');}, 5000);
		   }
	
	
		 } 
		 
		 
//	 $("#payNext").click();
	 
  }
   
  
  		</script>	  
	 


<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>

  
	
	   <script>
	   function check_member(id)
       {

	  jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/check_user",
data: {mem: id},
success: function(res) {
document.getElementById("name").value=res;

}
});}

	   </script>
  
	   <script type="text/javascript">
			
		 document.getElementById("showmodelbtn").disabled = false;  
         

			}
		</script>		
		
 