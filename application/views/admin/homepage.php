<?php defined('BASEPATH') OR exit('No direct script access allowed');

 
$model = new OperationModel();
$today_date = getLocalTime();
$yester_date = AddToDate($today_date,"-1 Day");
$last_month_date = AddToDate($today_date,"-1 Month");
$C_MONTH = getMonthDates($today_date);
$X_MONTH = getMonthDates($last_month_date);
	$today_dateee =   InsertDate(AddToDate($today_date,"0 Day")); #InsertDate($today_date); #
$total_visitor = $model->getVisitorCount();  //11111111111
$today_visitor = $model->getVisitorCount($today_date,$today_date);  //1111111111111
$yester_visitor = $model->getVisitorCount($yester_date,$yester_date); //111111111111111
$month_visitor = $model->getVisitorCount($C_MONTH['flddFDate'],$C_MONTH['flddTDate']);  //111111111111111111
$last_month_visitor = $model->getVisitorCount($X_MONTH['flddFDate'],$X_MONTH['flddTDate']);  //1111111111


$total_register = $model->getMemberCount();  //1111111111111
$today_register = $model->getMemberCount($today_date,$today_date); //1111111111
//$yester_register = $model->getMemberCount($yester_date,$yester_date);
//$month_register = $model->getMemberCount($C_MONTH['flddFDate'],$C_MONTH['flddTDate']);
//$last_month_register = $model->getMemberCount($X_MONTH['flddFDate'],$X_MONTH['flddTDate']);
$curr_date = date('Y-m-d');
$total_paid_member = $model->getMemberPaidCount();  //11111111111
$today_paid_member = $model->gettodaypaidusers($curr_date); //11111111111111
//$yester_paid_member = $model->getMemberPaidCountYester($yester_date,$yester_date);
//$month_paid_member = $model->getMemberPaidCountYester($C_MONTH['flddFDate'],$C_MONTH['flddTDate']);
//$last_paid_member = $model->getMemberPaidCount($X_MONTH['flddFDate'],$X_MONTH['flddTDate']);
$month_paid_member = $model->getMemberPaidCountLast($C_MONTH['flddFDate'],$C_MONTH['flddTDate']); //1111111111
$last_paid_member = $model->getMemberPaidCountLast($X_MONTH['flddFDate'],$X_MONTH['flddTDate']); //111111111

// $courier_delivered = $model->countcourierstatus('D'); //11111111111
// $courier_process = $model->countcourierstatus('P');  //11111111111
//$net_deposite = $model->getWalletTrns("Cr",$StrWhr);
//$net_payout = $model->getWalletTrns("Dr",$StrWhr);
//$net_balance = $net_deposite-$net_payout;


//$QR_LEADERSHIP = "SELECT COUNT(`id`) as total ,`leadership_id` FROM `tbl_cmsn_leadership` WHERE 1 GROUP BY `leadership_id`";
//$AR_LEADERSHIP = $this->SqlModel->runQuery($QR_LEADERSHIP,false);
 
//$QR_BRONZE = "SELECT COUNT(`id`) as total  FROM `tbl_bronze`";
//$AR_BRONZE = $this->SqlModel->runQuery($QR_BRONZE,true);
 
 
 $getlastprocessId = $model->getlastprocessId();
 $lastpayout = $model->lastpayoutdetail();//111111111111
//  $Totalpayoutdetail = $model->Totalpayoutdetail();
 

//  $lastcolection = $model->lastcollectiondetail($getlastprocessId); //11111111111
 
        $AR_PRSS = $model->getProcess($getlastprocessId); //PrintR($AR_PRSS);die;
         
 
  $lastcolection = $model->getcurrentamount($AR_PRSS['start_date'],$AR_PRSS['end_date']);
 //$lastprocessdate = $model->getlastprocessdate();
 $lastprocessdate = $model->getlastprocessdate();
 
 $lastCollection = $model->getcurrentamount($lastprocessdate['start_date'],$lastprocessdate['end_date']);  //11111111111
 ///print_r($lastprocessdate);die;
 $TotalCollection = $model->getcurrentamount('2020-04-01',$lastprocessdate['end_date']);
  $Totalpayoutdetail = $model->Totalpayoutdetail1('2020-04-01',$lastprocessdate['end_date']);
  
  
   $netwithdrawal = $model->netwithdrawal();
   $pendingwithdrawal = $model->pendingwithdrawal($today_dateee);
      $openticket = $model->openticket();
  
  	$ewalletbal = $model->getallCurrentBalance(0,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
  	
  		$awalletbal = $model->getallCurrentBalance(0,'3',$_REQUEST['from_date'],$_REQUEST['to_date']);

  //PrintR($ewalletbal);
  
   $lastCollectionbypkg = $model->getcurrentamountbypkg($lastprocessdate['start_date'],$lastprocessdate['end_date']);  //11111111111
   $lastCollectionbypowerpkg = $model->getcurrentamountbypowerpkg($lastprocessdate['start_date'],$lastprocessdate['end_date']);  //11111111111
   $lastCollectionbymanualpkg = $model->getcurrentamountbymanualpkg($lastprocessdate['start_date'],$lastprocessdate['end_date']);  //11111111111
  
 ?>
    <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>              

 <!-- Page Content  -->
         <div id="content-page" class="content-page">
             <?php  get_message(); ?>
            <div class="container-fluid">
                
               <div class="row">
                  <div class="col-md-6 col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-primary rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-primary rounded shadow" data-wow-delay="0.2s">
                                 <i class="las la-users"></i>
                              </div>
                              <div class="iq-text">
                                 <h6 class="text-white">Current Collection</h6>
                                 <h3 class="text-white"><?php echo CURRENCY; ?> <?php echo number_format($lastCollection ); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-warning rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-warning rounded shadow" data-wow-delay="0.2s">
                                 <i class="lab la-product-hunt"></i>
                              </div>
                              <div class="iq-text">
                                 <h6 class="text-white">Last Collection</h6>
                                 <h3 class="text-white"><?php echo CURRENCY; ?><?php echo number_format($lastcolection ); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3" style="display:none;">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-success rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-success rounded shadow" data-wow-delay="0.2s">
                                 <i class="las la-user-tie"></i>
                              </div>
                              <div class="iq-text">
                                 <h6 class="text-white">Net Payout</h6>
                                 <h3 class="text-white"><?php echo CURRENCY; ?><?php echo number_format($lastpayout ,2); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-warning rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s">
                                 <i class="lab la-buffer"></i>
                              </div>
                              <div class="iq-text">
                                 <h6 class="text-white">Total Collection</h6>
                                 <h3 class="text-white"><?php echo CURRENCY; ?><?php echo number_format($TotalCollection ); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                   <div class="col-md-6 col-lg-3" style="display:none;">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-danger rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s">
                                 <i class="lab la-buffer"></i>
                              </div>
                              <div class="iq-text">
                                 <h6 class="text-white">Total Payout</h6>
                                 <h3 class="text-white"><?php echo number_format($Totalpayoutdetail ); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-info rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s">
                                 <i class="lab la-buffer"></i>
                              </div>
                              <div class="iq-text">
                                 <h6 class="text-white">Pending Withdrawal</h6>
                                 <h3 class="text-white"><?php echo CURRENCY; ?><?php echo number_format($pendingwithdrawal,2); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                   <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-info rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s">
                                 <i class="lab la-buffer"></i>
                              </div>
                              <div class="iq-text">
                                 <h6 class="text-white">Net Withdrawal</h6>
                                 <h3 class="text-white"><?php echo CURRENCY; ?><?php echo number_format($netwithdrawal,2); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                   <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-danger rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-success rounded shadow" data-wow-delay="0.2s">
                                 <i class="las la-user-tie"></i>
                              </div>
                              <div class="iq-text">
                                 <h6 class="text-white">E-wallet Balance</h6>
                                 <h3 class="text-white"><?php echo CURRENCY; ?><?php echo number_format($ewalletbal['net_balance'] ,2); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-success rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s">
                                 <i class="lab la-buffer"></i>
                              </div>
                              <div class="iq-text">
                                   <h6 class="text-white">A-wallet Balance</h6>
                                  <h3 class="text-white"><?php echo CURRENCY; ?><?php echo number_format($awalletbal['net_balance'] ,2); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                   <div class="col-md-6 col-lg-3">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height bg-warning rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center justify-content-between">
                              <div class="icon iq-icon-box rounded iq-bg-danger rounded shadow" data-wow-delay="0.2s">
                                 <i class="lab la-buffer"></i>
                              </div>
                              <div class="iq-text">
                                 <h6 class="text-white">Pending Ticket</h6>
                                 <h3 class="text-white"><?php //echo CURRENCY; ?><?php echo number_format($openticket); ?></h3>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 d-flex flex-wrap p-0">
                     <div class="col-md-4">
                        <div class="iq-card iq-card-block iq-card-stretch">
                           <div class="iq-card-body">
                              <div class="text-center">
                                 <h5>All Users</h5>
                                 <div class="progress-round income-progress mx-auto mt-3" data-value="100">
                                    <span class="progress-left">
                                    <span class="progress-bar border-primary"></span>
                                    </span>
                                    <span class="progress-right">
                                    <span class="progress-bar border-primary"></span>
                                    </span>
                                    <div class="progress-value w-100 h-100 rounded d-flex align-items-center justify-content-center text-center">
                                       <div class="h4 mb-0"><?php echo number_format($total_register ); ?></div>
                                    </div>
                                 </div>
                                
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="iq-card iq-card-block iq-card-stretch">
                           <div class="iq-card-body">
                              <div class="text-center">
                                 <h5>All Paid User</h5>
                                 <div class="progress-round income-progress mx-auto mt-3" data-value="100">
                                    <span class="progress-left">
                                    <span class="progress-bar border-success"></span>
                                    </span>
                                    <span class="progress-right">
                                    <span class="progress-bar border-success"></span>
                                    </span>
                                    <div class="progress-value w-100 h-100 rounded d-flex align-items-center justify-content-center text-center">
                                       <div class="h4 mb-0"><?php echo number_format($total_paid_member ); ?></div>
                                    </div>
                                 </div>
                                
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="iq-card iq-card-block iq-card-stretch">
                           <div class="iq-card-body">
                              <div class="text-center">
                                 <h5>Un Paid Users</h5>
                                 <div class="progress-round income-progress mx-auto mt-3" data-value="100">
                                    <span class="progress-left">
                                    <span class="progress-bar border-danger"></span>
                                    </span>
                                    <span class="progress-right">
                                    <span class="progress-bar border-danger"></span>
                                    </span>
                                    <div class="progress-value w-100 h-100 rounded d-flex align-items-center justify-content-center text-center">
                                       <div class="h4 mb-0"><?php echo number_format(($total_register-$total_paid_member) ); ?></div>
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


         
 <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>