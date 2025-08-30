<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
  
    $member_id = $this->session->userdata('mem_id');
    $sale_id = _d($segment['sale_id']);
    $ord_detail = $model->getorderDetail($sale_id);
    
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
		<h4 class="widget-title blue">Courier Status</h4>
		
	 
		</div>
		
	 <div class="widget-box">
								 

									<div class="widget-body">
										<div class="widget-main">
											<div id="fuelux-wizard-container" class="no-steps-container">
												<div>
													<ul class="steps" style="margin-left: 0">
														<li data-step="1" <?php if($ord_detail['courierstatus']=='P' || $ord_detail['courierstatus']=='H' ||$ord_detail['courierstatus']=='S'|| $ord_detail['courierstatus']=='D'){?>class="active" <?php } ?>>
															<span class="step">1</span>
															<span class="title">In Process</span>														</li>

														<li data-step="2" <?php if($ord_detail['courierstatus']=='H'  ||$ord_detail['courierstatus']=='S'|| $ord_detail['courierstatus']=='D'){?>class="active" <?php } ?>>
															<span class="step">2</span>
															<span class="title">Hold / Pending</span>														</li>

														<li data-step="3" <?php if($ord_detail['courierstatus']=='S' || $ord_detail['courierstatus']=='D'){?>class="active" <?php } ?>>
															<span class="step">3</span>
															<span class="title">Shipping</span>														</li>

														<li data-step="4" <?php if($ord_detail['courierstatus']=='D'){?>class="active" <?php } ?>>
															<span class="step">4</span>
															<span class="title">Delivered</span>														</li>
													</ul>
												</div>

												<hr>

												<div class="step-content pos-rel">
													<div class="step-pane active" data-step="1">
														<h3 class="lighter block green">Your Ordr Information</h3>

														<form class="form-horizontal" id="sample-form">
															<div class="form-group has-warning">
																<label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Courier Company</label>

																<div class="col-xs-12 col-sm-5">
																	<span class="block input-icon input-icon-right">
																		<input type="text" id="inputWarning" class="width-100" value="<?php echo $ord_detail['couriercompany'];?>" readonly>
																		<i class="ace-icon fa fa-home"></i>																	</span>																</div>
															 
															</div>

															<div class="form-group has-error">
																<label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Courier Number</label>

																<div class="col-xs-12 col-sm-5">
																	<span class="block input-icon input-icon-right">
																		<input type="text" id="inputError" class="width-100"  value="<?php echo $ord_detail['courierno'];?>" readonly>
																		<i class="ace-icon fa fa-leaf"></i>																	</span>																</div>
														 
															</div>

															<div class="form-group has-success">
																<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Courier Date</label>

																<div class="col-xs-12 col-sm-5">
																	<span class="block input-icon input-icon-right">
																		<input type="text" id="inputSuccess" class="width-100"  value="<?php echo date('d-M-Y',strtotime($ord_detail['courierdate']));?>" readonly>
																		<i class="ace-icon fa fa-calendar"></i>																	</span>																</div>
															 
															</div>

															<div class="form-group has-info">
																<label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Courier Remark</label>

																<div class="col-xs-12 col-sm-5">
																	<span class="block input-icon input-icon-right">
																	    <textarea id="inputInfo" class="width-100" readonly><?php echo $ord_detail['courierremark'];?></textarea>
																 
																		<i class="ace-icon fa fa-info-circle"></i>																	</span>																</div>
															 
															</div>

														 
														</form>

													 
													</div>

												 
												</div>
											</div>

											<hr>
											<div class="wizard-actions">
											 

											 
											</div>
										</div><!-- /.widget-main -->
									</div><!-- /.widget-body -->
								</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			
			
         
 
		 	  
	 


<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>

  
	
	    
  
	    		
		
 