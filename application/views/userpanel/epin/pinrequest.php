<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$member_id = $this->session->userdata('mem_id');
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
$wallet_id = $this->OperationModel->getWallet(WALLET1);
$LDGR = $model->getCurrentBalancewal($member_id,$wallet_id,$_GET['from_date'],$_GET['to_date']);




if($_GET['from_date']!='' && $_GET['to_date']!=''){
	$from_date = InsertDate($_GET['from_date']);
	$to_date = InsertDate($_GET['to_date']);
	$StrWhr .=" AND DATE(tpr.request_date) BETWEEN '".$from_date."' AND '".$to_date."'";
	$SrchQ .="&from_date=$from_date&to_date=$to_date";
}
if($_GET['type_id']>0){
	$type_id = FCrtRplc($_GET['type_id']);
	$StrWhr .=" AND tpr.type_id='".$type_id."'";
	$SrchQ .="&type_id=$type_id";
}
$QR_PAGES= "SELECT tpr.*, tm.user_id, tm.first_name, tm.last_name, tpy.pin_name
			FROM ".prefix."tbl_pin_request AS tpr 
			LEFT JOIN ".prefix."tbl_members AS tm ON tpr.member_id=tm.member_id
			LEFT JOIN ".prefix."tbl_pintype AS tpy ON tpr.type_id=tpy.type_id WHERE 1 
			AND tpr.member_id>0 AND tpr.member_id='".$member_id."' $StrWhr ORDER BY tpr.request_id ASC";
$PageVal = DisplayPages($QR_PAGES, 25, $Page, $SrchQ);
 ?>
<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/select2.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/bootstrap-editable.min.css" />

<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	
<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

  <div class="app-content content">
      <div class="content-wrapper">
					

					<div class="content-body>
						
                         	<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
							<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>

							
								
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						
						
						
						
						
						
										 

					<div class="row">
							<div class="col-xs-12">
						<h3 class="header smaller lighter blue">E-Pin Request</h3>
<div class="widget-box">
		<div class="widget-header widget-header-blue widget-header-flat">
		<h4 class="widget-title blue">Available amount on your E-wallet: Rs. <?php //echo CURRENCY; ?> <?php echo $LDGR['net_balance']; ?></h4>
		
	<!--	<div class="widget-toolbar">
		<label>
		<small class="green">
		<b>Validation</b>												</small>
		
		<input id="skip-validation" type="checkbox" class="ace ace-switch ace-switch-4" />
		<span class="lbl middle"></span>											</label>
		</div> -->
		</div>
		
		<div class="widget-body">
		<div class="widget-main">
		
		<form id="form-search" name="form-search" method="get" action="<?php echo generateMemberForm("epin","pinrequest",""); ?>" class="form-horizontal">
		
			<div id="fuelux-wizard-container">
			<?php echo get_message(); ?>
			
			<hr />
			
			<div class="step-content pos-rel">
			<div class="step-pane active" data-step="1">
			<h3 class="lighter block green">Search Here...</h3>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Pin Type</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-hand-o-right bigger-110"></i>
																		</span>
	<select  name="type_id" id="type_id" class="form-control validate[required] getPinPrice">
					<option value="">Select Pin</option>
					<?php echo DisplayCombo($_GET['type_id'],"PIN_TYPE"); ?>
					</select>
																	</div>
																			</span>																</div>
			
			</div>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Date from</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-calendar bigger-110"></i>
																		</span>
	  <input class="form-control validate[required] date-picker" name="from_date" id="from_date" value="<?php echo $_GET['from_date']; ?>" type="date"  />
																	</div>
																			</span>																</div>
			<div class="help-block col-xs-12 col-sm-reset inline" id="sid" style="display:none"></div>
			</div>
			
			<div class="form-group ">
			<label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">To</label>
			
			<div class="col-xs-12 col-sm-5">
			<span class="block input-icon input-icon-right">
			<div class="input-group">
																		<span class="input-group-addon">
																			<i class="fa fa-calendar bigger-110"></i>
																		</span>
	<input class="form-control  validate[required] date-picker" name="to_date" id="to_date" value="<?php echo $_GET['to_date']; ?>" type="date"  />
																	</div>
																			</span>																</div>
			
			</div>
			
				   
			
			
			
			
		
			
			</div>
			
			
			</div>
			</div>
		
		<hr />
		<div class="wizard-actions">
<input class="btn btn-primary m-t-n-xs" value=" Search " type="submit">
            <a href="<?php  echo generateSeoUrlMember("epin","pinrequest",array()); ?>" class="btn btn-danger m-t-n-xs" value=" Reset ">Reset</a>
			
            <button type="button" name="action_button"  onclick="window.location.href='<?php  echo generateSeoUrlMember("epin","newrequest",array()); ?>'" id="action_button" class="btn btn-success">Buy Pin</button>
		
		<!--<button class="btn btn-success " disabled>
		Upgrade
		<i class="ace-icon fa fa-cloud-upload icon-on-right"></i>												</button>-->
		</div>
		
		
		</form>
		</div>
		</div>
		</div>
								
<div class="widget-body">

                <div class="panel-body list">
                  <div class="table-responsive project-list">
                    <table class="table table-striped">
                     <thead>
                      <tr>
					    <th>Sn</th>
                        <th>Request Date </th>
                        <th>Pin Type </th>
                        <th>No of Pin </th>
                        <th>Net Price </th>
                        <th>Bank Name </th>
                        <th>Payment Details </th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
					if($PageVal['TotalRecords'] > 0){
					$Ctrl=1;
					foreach($PageVal['ResultSet'] as $AR_DT):
					?>
                      <tr>
					  <td><?php echo $Ctrl;?></td>
                        <td><?php echo DisplayDate($AR_DT['request_date']); ?></td>
                        <td><?php echo $AR_DT['pin_name']; ?></td>

                        <td><?php echo $AR_DT['no_pin']; ?></td>
                        <td><?php echo $AR_DT['net_amount']; ?></td>
                        <td><?php echo $AR_DT['pin_name']; ?></td>
                        <td><?php echo $AR_DT['payment_sts']; ?></td>
                        <td><?php echo DisplayText("PIN_".$AR_DT['assign_sts']); ?></td>
                      </tr>
                      <?php $Ctrl++; endforeach; }else{ ?>
                      <tr>
                        <td colspan="8" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    </table>
                  </div>
                </div>
              </div>
								
								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
						
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

