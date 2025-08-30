<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
$model = new OperationModel();
$form_data = $this->input->post();
$segment = $this->uri->uri_to_assoc(2);
$binary_rate = $model->getValue("CONFIG_BINARY_INCOME");
$member_id = $this->session->userdata('mem_id');
$request_id = _d($segment['request_id']);
$AR_PRSS = $model->getProcess();
$process_id = $AR_PRSS['process_id'];

			$AR_TYPE  = $model->getCurrentMemberShip($member_id);
		//	$pain_name = ($AR_TYPE['pin_name'])? $AR_TYPE['pin_name']:"Free";
			$date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
		    $fldiInvestment = $model->getInvestment($member_id);		
			
$LD_CSH = $model->getCurrentBalance($member_id,$model->getWallet(WALLET1),"","");

$rate_of_interest = $model->getSumDailyReturn($member_id,"","");

$total_withdrawal = $model->getMemberWithdrawal($member_id);
$left_collection = $model->BinaryCount($member_id,"LeftPoint");
$right_collection = $model->BinaryCount($member_id,"RightPoint");
$total_collection = $left_collection+$right_collection;
$wallet_id = ($_REQUEST['wallet_id']>0)? $_REQUEST['wallet_id']:$model->getWallet(WALLET1);
$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);

$LDGR1 = $model->getCurrentBalancewal($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);

		                $AR_PRSS = $model->getProcess($process_id);
		                $process_id = $AR_PRSS['process_id'];

						$AR_OLD = $model->getOldBinary($process_id,$member_id);
						
						$from_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['start_date']:"";
						$end_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['end_date']:$AR_PRSS['end_date'];
						
						$preLcrf = $AR_OLD['leftCrf'];
						$preRcrf = $AR_OLD['rightCrf'];
						$e_date = date('Y-m-d');	
						//$newLft = $model->getMemberCollection($member_id,"L",$from_date,$e_date);
						//$newRgt = $model->getMemberCollection($member_id,"R",$from_date,$e_date);
						
						$newLft = $model->getCount1($member_id,"L");
						$newRgt = $model->getCount1($member_id,"R");
						
						$newLftT = $model->getCount1($member_id,"LT");
						$newRgtT = $model->getCount1($member_id,"RT");
						
						$newLfthalf = $model->getCount1($member_id,"Lhalf");
						$newRgthalf = $model->getCount1($member_id,"Rhalf");
						$newLftfull = $model->getCount1($member_id,"Lfull");
						$newRgtfull = $model->getCount1($member_id,"Rfull");
						$newLftdouble = $model->getCount1($member_id,"Ldouble");
						$newRgtdouble = $model->getCount1($member_id,"Rdouble");
						
						$newLfthalfT = $model->getCount1($member_id,"LhalfT");
						$newRgthalfT = $model->getCount1($member_id,"RhalfT");
						$newLftfullT = $model->getCount1($member_id,"LfullT");
						$newRgtfullT = $model->getCount1($member_id,"RfullT");
						$newLftdoubleT = $model->getCount1($member_id,"LdoubleT");
						$newRgtdoubleT = $model->getCount1($member_id,"RdoubleT");

						
						
						$totalLft = $preLcrf+$newLft;
						$totalRgt = $preRcrf+$newRgt;
						
						
						
						$pair_match =  min($totalLft,$totalRgt);
						
						$leftCrf = ( $totalLft - $pair_match );
						$rightCrf = ( $totalRgt - $pair_match );
					

/*
$AR_OLD = $model->getOldBinary($process_id,$member_id);		

$start_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['start_date']:"";
$end_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['end_date']:"";

$preLcrf = $AR_OLD['leftCrf'];
$preRcrf = $AR_OLD['rightCrf'];
	
$newLft = $model->getMemberCollection($member_id,"L",$start_date,$end_date);
$newRgt = $model->getMemberCollection($member_id,"R",$start_date,$end_date);



$totalLft = $preLcrf+$newLft;
$totalRgt = $preRcrf+$newRgt;
$pair_match = min($totalLft,$totalRgt);
*/

$last_week_cmsn = $model->getLastBinaryCmsn($member_id);
$current_cmsn = ($pair_match*$binary_rate/100);
$old_cmsn = $model->getTotalBinaryCmsn($member_id);


$direct_cmsn = $model->getTotalDirectCmsn($member_id);

$left_count = $model->BinaryCount($member_id,"LeftCount");
$right_count = $model->BinaryCount($member_id,"RightCount");

$left_paid = $model->BinaryCount($member_id,"LeftPaid");
$right_paid = $model->BinaryCount($member_id,"RightPaid");

$leftActive = $model->BinaryCount($member_id,"LeftActive");
$rightActive = $model->BinaryCount($member_id,"RightActive");


$left_count_dir_A = $model->BinaryCount($member_id,"LeftCountDirectActive");
$right_count_dir_A = $model->BinaryCount($member_id,"RightCountDirectActive");

$left_count_dir = $model->BinaryCount($member_id,"LeftCountDirect");
$right_count_dir = $model->BinaryCount($member_id,"RightCountDirect");

$total_count = ($left_count+$right_count);
$direct_count = $model->BinaryCount($member_id,"DirectCount");

$today_date = InsertDate(getLocalTime());
$AR_DATE = $model->getCycleNo();
$end_date = $AR_PRSS['end_date'];
$week_date = InsertDate(AddToDate($end_date,"+1 Week"));
$today_joining = $model->getMemberJoining($member_id,$today_date,$today_date);
$week_joining = $model->getMemberJoining($member_id,$today_date,$week_date);

$AR_SHIP = $model->getCurrentMemberShip($member_id);


$stock_market = get_web_page("https://bitpay.com/api/rates");
$AR_STOCK = json_decode($stock_market,true);

$AR_SUB = $model->getCurrentMemberShip($member_id);






$Var1 = $member_id;
$Var2 = "";
$Var3 = "";

if($Var1!=""){
	$QR_TREE1 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var1' AND (nleft>0 AND nright>0) ";
	$RS_TREE1 = $this->SqlModel->runQuery($QR_TREE1);

//	echo "<pre>";print_r($RS_TREE1);die;
	foreach($RS_TREE1 as $AR_TREE1):
		if($AR_TREE1['left_right'] == "L"){
			$Var2 = $AR_TREE1['member_id'];
		}
		if($AR_TREE1['left_right'] == "R"){
			$Var3 = $AR_TREE1['member_id'];
		}
	endforeach;

}



?>






		
			

		
			

		


<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/select2.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/bootstrap-editable.min.css" />
			<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/new11.css" />

<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	
<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

























<div class="main-content">
				<div class="main-content-inner">
					

				
					<div class="page-content">
						
						
						
						
						
					


					
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								

								

								<div>
									<div id="user-profile-1" class="user-profile row">
									
									
									
									
							
									<div class="col-xs-12 col-sm-6">
											

											

											<div >
											
											
									
											
											
		<table class="table table-bordered ">
											
									<thead>
									<tr class="saledes">
									
									<th> SALES STATUS</th>
        <th>Left</th>
        <th>Right</th>
									
									</tr>
									
									
									</thead>		
											
    
    <tbody>
      <tr class="saledes">
        <td>TOTAL  PRODUCT SALES</td>
        <td><?php echo $newLft; ?></td>
        <td><?php echo $newRgt; ?></td>
      </tr>      
      <tr class="saledes">
        <td>TURBO SALE PRODUCT </td>
        <td><?php echo $newLftT; ?></td>
        <td><?php echo $newRgtT; ?></td>
      </tr>
      
      
    </tbody>
  </table>
  
  		<table class="table table-bordered ">
											
									<thead>
									<tr class="saledes">
									
									<th> P V STATUS</th>
        <th>Left</th>
        <th>Right</th>
									
									</tr>
									
									
									</thead>		
											
    
    <tbody>
      <tr class="saledes">
        <td>TOTAL  P V </td>
        <td><?php echo ($left_paid>0)? $left_paid:'0.00';?></td>
        <td><?php echo  ($right_paid>0)? $right_paid:'0.00';?></td>
      </tr>      
    
      
      
    </tbody>
  </table>
											
											
												
												
											</div>

											<div class="space-20"></div>

											
											

											<div class="space-6"></div>

											
										</div>
									
									
									
									
									<div class="col-xs-12 col-sm-6">
											

											

											<div >
											
											
									
											
											
											<table class="table table-bordered ">
											
									<thead>
									<tr class="saledes">
									
									<th>DETAILED SALES REPORT</th>
        <th>Left</th>
        <th>Right</th>
									
									</tr>
									
									
									</thead>		
											
    
    <tbody>
      <tr class="saledes">
        <td>TOTAL FULL SALES PRODUCT</td>
        <td><?php echo "$newLftfull"; ?></td>
        <td><?php echo "$newRgtfull"; ?></td>
      </tr>      
      <tr class="saledes">
        <td>TOTAL HALF   SALES PRODUCT</td>
        <td><?php echo "$newLfthalf"; ?></td>
        <td><?php echo "$newRgthalf"; ?></td>
      </tr>
      <tr class="saledes">
        <td>TOTAL DOUBLE  SALES PRODUCT</td>
        <td><?php echo "$newLftdouble"; ?></td>
        <td><?php echo "$newRgtdouble"; ?></td>
      </tr>
      <tr class="saledes">
        <td>TOTAL FULL TURBO SALE</td>
        <td><?php echo "$newLftfullT"; ?></td>
        <td><?php echo "$newRgtfullT"; ?></td>
      </tr>
	  
	  <tr class="saledes">
        <td>TOTAL HALF TURBO SALE</td>
        <td><?php echo "$newLfthalfT"; ?></td>
        <td><?php echo "$newRgthalfT"; ?></td>
      </tr>
	  
	  
	  <tr class="saledes">
        <td>TOTAL DOUBLE TURBO SALE</td>
        <td><?php echo "$newLftdoubleT"; ?></td>
        <td><?php echo "$newRgtdoubleT"; ?></td>
      </tr>
      
    </tbody>
  </table>
											
											
												
												
											</div>

											<div class="space-20"></div>

											
											

											<div class="space-6"></div>

											
										</div>
									
									
									
									</div>
								</div>

								
								<!-- PAGE CONTENT ENDS -->
								
								
								
								
								
								
								

							</div><!-- /.col -->
						</div><!-- /.row -->
				








<hr>



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

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
	



