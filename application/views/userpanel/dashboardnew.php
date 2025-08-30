<?php  
$model = new OperationModel();
 
    $dateToday = date('Y-m-d');
    $member_id = $this->session->userdata('mem_id');
    
    $AR_TYPE  = $model->getCurrentMemberShip($member_id);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
 		 $p2pwithdral = $model->p2pwithdral($member_id);
 	               	
    $paid_referral = $model->counttotalactivesponsor($member_id);
    
    $UPTO_WITH          = $model->totalGlobalPackage($member_id);
    $total_withdrawal   = $model->getMemberWithdrawal($member_id);
    $checkParents       = $model->checkPrentsIdorNot($member_id);
    
    // $UPTO_WITH = $totalGlobalPackage *200/100;
    $REM_WITH  = $UPTO_WITH -  $total_withdrawal;

$wallet_id = ($_REQUEST['wallet_id']>0)? $_REQUEST['wallet_id']:$model->getWallet(WALLET1);
$referral = $model->counttotalsponsor($member_id);

$left_count = $model->BinaryCount($member_id,"LeftCount");
$right_count = $model->BinaryCount($member_id,"RightCount");
$total_count = ($left_count+$right_count);
// $left_paid = $model->BinaryCount($member_id,"LeftPaid");
// $right_paid = $model->BinaryCount($member_id,"RightPaid");
$matching = $model->gettotalbinarymatchincome($member_id);
// $left_paidCount = $model->BinaryCount($member_id,"LeftPaidCount");
// $right_paidCount = $model->BinaryCount($member_id,"RightPaidCount");
$total = $model->getincomestotal($member_id);
$left_paidCount  = $model->getbussiness($member_id, 'L')	;
$right_paidCount = $model->getbussiness($member_id, 'R')	;
$left_paid =$left_paidCount*100;
$right_paid=$right_paidCount*100;

//*****************************************************

        $AR_PRSS = $model->getProcess(); 
		$process_id = $AR_PRSS['process_id'];
		$end_date =$AR_PRSS['end_date'];
        $AR_OLD = $model->getOldBinary($process_id,$member_id);
						$from_date = ($AR_OLD['binary_id']>0)? $AR_OLD['sdates']:"2019-02-09";
						$end_date =  $AR_PRSS['end_date'];
						$preLcrf = ($AR_OLD['leftCrf']>0)?$AR_OLD['leftCrf']:0;
						$preRcrf = ($AR_OLD['rightCrf']>0)?$AR_OLD['rightCrf']:0;
				          $newLft = $model->getMemberCollection2($member_id,"L",$from_date,$end_date);
				          $newRgt = $model->getMemberCollection2($member_id,"R",$from_date,$end_date);
					 	$newLft = $newLft>0? $newLft:0;
						$newRgt = $newRgt>0?$newRgt:0;
						$left_paid_c = $preLcrf+$newLft;
						$right_paid_c = $preRcrf+$newRgt;
//*****************************************************


$AR_SUB = $model->getCurrentMemberShip($member_id);

//PrintR($AR_SUB);
$getTotalMemberShipValue = $model->getTotalMemberShipValue($member_id);  	
    $LDGR = $model->getCurrentBalance($member_id,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
	$LDGR2 = $model->getCurrentBalance($member_id,'2',$_REQUEST['from_date'],$_REQUEST['to_date']);
	$LDGR3 = $model->getCurrentBalance($member_id,'3',$_REQUEST['from_date'],$_REQUEST['to_date']);
 
     $EgleL = $model->getMemberDownCount($member_id,'L');
     $EgleR = $model->getMemberDownCount($member_id,'R');
      
if($ROW['rank_id'] > 0)
{
  $rank = $model->getRankName($ROW['rank_id']);  
}
else
{
    $rank = "Starter";
}


$club = $model->getClubRank($member_id);
                                        if($club =='1')  { $club =  "STAR";     }
                                         elseif($club =='2')  { $club =  "GOLD";     }
                                         elseif($club =='3')  { $club =  "RUBY";     }
                                         elseif($club =='4')  { $club =  "PEARL";     }
                                         elseif($club =='5')  { $club =  "CORAL";     }
                                         elseif($club =='6')  { $club =  "ONYX";     }
                                         elseif($club =='7')  { $club =  "TOPAZ";     }
                                         elseif($club =='8')  { $club =  "TOPAZ";     }
                                         else{$club =  "Pending" ; } 
                                         
                                         
                                         
                                         
                                       //  PrintR($ROW);die;
                                         
                                         
    if($ROW['subcription_id'] > 0 )
    {
        $addDate = 'april 25, 2020 23:59:59';
    }
    else
    {
        $addDate = InsertDate(AddToDate($ROW['date_join'],"30 Day"));
        $addDate = date("F d, Y H:i:s",strtotime($addDate));
    }
    
    $income  = $model->getincomesall($member_id);
     //   PrintR($income);                                  
                                         
            $binaryIncome           =    $income['binaryIncome'];
            // $roiIncome              =    $income['roiIncome'];
            $directIncome           =    $income['directIncome'];
            // $poolIncome             =    $income['poolIncome'];
            $commuinity             =    $income['commuinity'];
            $royaltyInc             =    $income['quick'];
            $totalPayout            =    $income['totalPayout'];
            
            
            if($totalPayout > 0 )
            {
              $_1_per = $totalPayout/100; 
              $binary_per = number_format((float)$binaryIncome/$_1_per, 2, '.', '');
              $cashbk_per = number_format((float)$roiIncome/$_1_per, 2, '.', '');
              $direct_per = number_format((float)$directIncome/$_1_per, 2, '.', '');
              $poolin_per = number_format((float)$poolIncome/$_1_per, 2, '.', '');
              $leader_per = number_format((float)$leaderShip/$_1_per, 2, '.', '');
              $royalt_per = number_format((float)$royaltyInc/$_1_per, 2, '.', '');
               
              
            }
            else
            {
                $binary_per  = 0 ; 
                $cashbk_per  = 0 ; 
                $direct_per  = 0 ; 
                $poolin_per  = 0 ; 
                $leader_per  = 0 ; 
                $royalt_per  = 0 ;   
            }
    $left_paid = $model->BinaryCount($member_id,"LeftPaid");
    $right_paid = $model->BinaryCount($member_id,"RightPaid");         
    
   $packageSet = $model->getSetofPackage($member_id);
   
   
   
      $totals = returnLevel($member_id ,'');  
                                         
                $P    = 0;
                $U    = 0;
                $TD    = 0;
                $DP = 0;
                                         foreach($totals as $t)
                                         {
                                           foreach($t['data'] as $t1)
                                         {
                                             //PrintR($t1);
                                             if($t1['subcription_id'] > 0 )
                                             {
                                                 $P++;
                                                 $DP += $t1['prod_pv'];
                                             }
                                             else
                                             {
                                                 $U++;
                                             }
                                             $TD++;
                                         }
                                         
                                         }
                                         
                                         
   
$this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu');

 $data = returnLevel($member_id,'');  


	foreach($data  as $AR_DT){
			 if($AR_DT['total'] > 0){
			     $bv =0;
			  
			     	foreach($AR_DT['data']  as $AR_DT1){
			     	$bv += ($AR_DT1['prod_pv'] !='')?$AR_DT1['prod_pv']:0;
			     	
			     	}    
			     	    	$teambusiness += $bv;
			 }
	}


?>

<?php 
echo $QR_PAGES="SELECT * FROM ".prefix."tbl_subscription WHERE member_id >= '$member_id' and prod_pv='1000'";
	$PageVal = DisplayPages($QR_PAGES, 10, $Page, $SrchQ);	
?>

<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/style.css">
        <!--**********************************
            Content body start
        ***********************************-->
        <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                 <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                           <div class="profile-header">
                              
                              <div class="user-detail text-center mb-3">
                                 <div class="profile-img">
                                       <?php  if($ROW['photo'] !=''){ $pic = $ROW['photo'];}else{ $pic='error';}
                      if (file_exists(FCPATH.'upload/member/'.$pic)) { ?>

<img src="<?php echo BASE_PATH;?>upload/member/<?php echo $ROW['photo'];?>" class="avatar-130 img-fluid" alt="user">

                      <?php }else{ ?>

 <img src="<?php echo BASE_PATH; ?>assets/images/user/11.png" alt="profile-img" class="avatar-130 img-fluid" />
                      <?php } ?>

                                     
                                     
                                   
                                 </div>
                                 <div class="profile-detail">
                                    <h3 class=""><?php echo $ROW['first_name'];?></h3>
                                  
                                 </div>
                              </div>
                              <div class="profile-info p-4 d-flex align-items-center justify-content-between position-relative">
                                 <div class="social-links">
                                    <strong>Referral Links Left</strong>
                                    <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                        <input id="cpr" type="hidden" class="form-control" style="cursor: no-drop; width: 100%" readonly value="<?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/L">
                                       <li class="text-center pr-3">
                                          <a href="https://www.facebook.com/sharer.php?u=<?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/L/&amp;t=Join and earn unlimited in <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?> Link is - <?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/L"><i class="zoom   lab la-facebook  text-primary  mr-3 rtl-mr-0 rtl-ml-3"  style="font-size: 25px !important;" ></i></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="https://twitter.com/intent/tweet/?text=Join and earn unlimited in <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?> Link is - <?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/L"><i class="zoom   lab la-twitter  text-primary  mr-3 rtl-mr-0 rtl-ml-3"  style="font-size: 25px !important;" ></i></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="https://api.whatsapp.com/send?text=Join and earn unlimited in <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?> Link is - <?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/L"><i class="zoom   lab la-whatsapp  text-primary  mr-3 rtl-mr-0 rtl-ml-3"  style="font-size: 25px !important;" ></i></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="https://telegram.me/share/url?url=<?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/R&amp;text=Join and earn unlimited in <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?> Link is - <?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/L"><i class="zoom   lab la-telegram-plane  text-primary   mr-3 rtl-mr-0 rtl-ml-3" style="font-size: 25px !important;"></i></a>
                                       </li>
                                       <li class="text-center pr-3">
                                            <a id="copyTargetL" onclick="copylinkL()" href="javascript:;"  class="  btn-social-icon mr-1 btn-instagram">
                           
                        <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3" style="color:green; font-size: 25px !important;"></i>
                      </a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="<?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/L" target="_blank"  class=" black btn-social-icon mr-1 btn-linkedin">
                           
                        <i class="zoom   fa fa-user-plus mr-3 rtl-mr-0 rtl-ml-3" style="color:#876cfe; font-size: 25px !important;"></i>
                      </a>
                                       </li>
                                    </ul>
                                    <br>
                                    <strong>Referral Links Right</strong>
                                    <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                       <li class="text-center pr-3">
                                        <input id="cpr" type="hidden" class="form-control" style="cursor: no-drop; width: 100%" readonly value="<?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/R">
                                          <a href="https://www.facebook.com/sharer.php?u=<?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/R/&amp;t=Join and earn unlimited in <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?> Link is - <?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/L"><i class="zoom   lab la-facebook  text-primary  mr-3 rtl-mr-0 rtl-ml-3"  style="font-size: 25px !important;" ></i></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="https://twitter.com/intent/tweet/?text=Join and earn unlimited in <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?> Link is - <?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/R"><i class="zoom   lab la-twitter  text-primary  mr-3 rtl-mr-0 rtl-ml-3"  style="font-size: 25px !important;" ></i></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="https://api.whatsapp.com/send?text=Join and earn unlimited in <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?> Link is - <?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/R"><i class="zoom   lab la-whatsapp  text-primary  mr-3 rtl-mr-0 rtl-ml-3"  style="font-size: 25px !important;" ></i></a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="https://telegram.me/share/url?url=<?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/R&amp;text=Join and earn unlimited in <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?> Link is - <?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/R"><i class="zoom   lab la-telegram-plane  text-primary   mr-3 rtl-mr-0 rtl-ml-3" style="font-size: 25px !important;"></i></a>
                                       </li>
                                       <li class="text-center pr-3">
                                            <a id="copyTargetR" onclick="copylinkR()" href="javascript:;"  class="  btn-social-icon mr-1 btn-instagram">
                           
                        <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3" style="color:green; font-size: 25px !important;"></i>
                      </a>
                                       </li>
                                       <li class="text-center pr-3">
                                          <a href="<?php echo BASE_PATH;?>sign-up/<?php echo $ROW['user_id'];?>/R" target="_blank"  class=" black btn-social-icon mr-1 btn-linkedin">
                           
                        <i class="zoom   fa fa-user-plus mr-3 rtl-mr-0 rtl-ml-3" style="color:#876cfe; font-size: 25px !important;"></i>
                      </a>
                                       </li>
                                    </ul>
                                 </div>

                                 <div class="social-info">
                                    <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                       <li class="text-center pl-3">
                                          <h6>USER ID</h6>
                                          <p class="mb-0"><?php echo $ROW['user_id'];?></p>
                                       </li>
                                      
                                       <li class="text-center pl-3">
                                          <h6>Email ID</h6>
                                          <p class="mb-0"><?php echo $ROW['member_email'];?></p>
                                       </li>
                                       <li class="text-center pl-3">
                                          <h6>Date Of Joining [ Date Of Activations ]</h6>
                                          <p class="mb-0"><?php echo DisplayDate($ROW['date_join']);?> [ <?php echo $date_from; ?> ]</p>
                                       </li>
                                       
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                 
                
               </div>
               <div class="row">
             
                 <div class="col-md-12">
                             <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-2 col-md-6 col-sm-12">
                   
                   <div class="iq-card-body" style="background: #e7ecee;">
                                
                                <strong>Current board I'd :- </strong>
                              </div>
                   
                   
                     <div class="iq-card">
                        <div class="iq-card-body border text-center rounded">
                          
                           <h6 style="font-size:20px;"><?php echo CURRENCY; ?>1000</h6>
                           <?php
                           
                           	if($PageVal['TotalRecords'] > 0){
								$Ctrl=$PageVal['RecordStart']+1;
				foreach($PageVal['ResultSet'] as $AR_DT) {
	   // PrintR($AR_DT['prod_pv']);
	   $oldid =$AR_DT['oldid'];
	    $newid1 =$AR_DT['new_id_1'];
	     $newid2 =$AR_DT['new_id'];
	      $oldid =  $model->getMember($oldid);
	     $newid1 =  $model->getMember($newid1);
	    // PrintR($newid1);
	    $newid2 = $model->getMember($newid2);
	
	?>
                           <strong style="background: #1e3d73;color: white;padding: 3px;"><?php echo $Ctrl; ?></strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="<?php if($oldid['prod_pv'] >1){ ?>background: green;!important<?php }else{ ?>background: #c4d0d9;!important <?php } ?>" ></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="<?php if($newid1['prod_pv']>1){ ?>background: green;!important<?php }else{ ?>background: #c4d0d9;!important <?php } ?>"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="<?php if($newid2['prod_pv']>1){ ?>background: green;!important<?php }else{ ?>background: #c4d0d9;!important <?php } ?>"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                    
                          <?php $Ctrl++;} } ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12"> 
                  <div class="iq-card-body" style="background: #e7ecee;">
                                
                                <strong>Current board I'd :- </strong>
                              </div>
                     <div class="iq-card">
                        <div class="iq-card-body border text-center rounded">
                          
                           <h6 style="font-size:20px;"><?php echo CURRENCY; ?>2000</h6>
                           
                           <strong style="background: #1e3d73;color: white;padding: 3px;">1</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                    
                           <strong style="background: #1e3d73;color: white;padding: 3px;">2</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>    
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">3</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">4</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">5</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">6</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">7</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">8</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">9</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">10</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12">
                          <div class="iq-card-body" style="background: #e7ecee;">
                                
                                <strong>Current board I'd :- </strong>
                              </div>
                     <div class="iq-card">
                        <div class="iq-card-body border text-center rounded">
                          
                           <h6 style="font-size:20px;"><?php echo CURRENCY; ?>4000</h6>
                           
                           <strong style="background: #1e3d73;color: white;padding: 3px;">1</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                    
                           <strong style="background: #1e3d73;color: white;padding: 3px;">2</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>    
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">3</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">4</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">5</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">6</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">7</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">8</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">9</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">10</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12">  
                  <div class="iq-card-body" style="background: #e7ecee;">
                                
                                <strong>Current board I'd :- </strong>
                              </div>
                     <div class="iq-card">
                        <div class="iq-card-body border text-center rounded">
                          
                           <h6 style="font-size:20px;"><?php echo CURRENCY; ?>8000</h6>
                           
                           <strong style="background: #1e3d73;color: white;padding: 3px;">1</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                    
                           <strong style="background: #1e3d73;color: white;padding: 3px;">2</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>    
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">3</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">4</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">5</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">6</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">7</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">8</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">9</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">10</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12">  
                  <div class="iq-card-body" style="background: #e7ecee;">
                                
                                <strong>Current board I'd :- </strong>
                              </div>
                     <div class="iq-card">
                        <div class="iq-card-body border text-center rounded">
                          
                           <h6 style="font-size:20px;"><?php echo CURRENCY; ?>16000</h6>
                           
                           <strong style="background: #1e3d73;color: white;padding: 3px;">1</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                    
                           <strong style="background: #1e3d73;color: white;padding: 3px;">2</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>    
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">3</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">4</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">5</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">6</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">7</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">8</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">9</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">10</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-6 col-sm-12"> 
                  <div class="iq-card-body" style="background: #e7ecee;">
                                
                                <strong>Current board I'd :- </strong>
                              </div>
                     <div class="iq-card">
                        <div class="iq-card-body border text-center rounded">
                          
                           <h6 style="font-size:20px;"><?php echo CURRENCY; ?>32000</h6>
                           
                           <strong style="background: #1e3d73;color: white;padding: 3px;">1</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                    
                           <strong style="background: #1e3d73;color: white;padding: 3px;">2</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>    
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">3</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">4</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">5</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">6</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">7</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">8</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">9</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                                         
                           <strong style="background: #1e3d73;color: white;padding: 3px;">10</strong>
                             <div class="tree" >
                                        <div class="row1">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                        <div class="row1 mb-0">
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                            <div class="item">
                                                <div class="img" style="background: #c4d0d9;!important"></div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                     <p>Amount :- 100</p>
                        </div>
                     </div>
                  </div>
                  
                 
               </div>
            </div> 
                        </div>
               </div>
            </div>
         </div>
      <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel"> Withdraw From  E-Wallet</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form action="<?php echo BASE_PATH;?>member/ewallet/withdrawalManual" method="post">
        <div class="modal-body">

  <?php
   $rand=rand();
  $this->session->set_userdata("rand",$rand);
  ?>
  <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    
    
                
   <div class="mb-3">
                    <label class="mb-1"><strong>Amount </strong></label>
                    <input class="form-control" required=""  onkeyup="setusd(this.value);" id="amount" name="amount" placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer USD" type="number">
                </div> 
   <div class="mb-3" style="display:none;">
                    <label class="mb-1"><strong>Amount in INR </strong></label>
                    <input class="form-control" required="" id="inr"  readonly  placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer Amount" type="number">
                </div> 
   <div class="mb-3">
                    <label class="mb-1"><strong>Password </strong></label>
                    <input class="form-control" required="" id="trns_password" name="trns_password" placeholder="Password" data-toggle="tooltip" title="Please enter Password" type="password">
                </div>      
 
      <!--Email OTP-->
      
     <?php if($model->getValue("Email_otp")== 'falsssssssssssssssssssssssssse'){ ?> 
     
     	 <div class="row">
                        <div class="col-sm-7">
                         <div class="form-group">
                        <label for="bankname">Email Verification</label>
                         
                      	<input placeholder="Verification Code" name="gemail_otp" required="required" type="text" class="form-control">
                    </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-group">
                       
                       <button style="margin-top:33px;padding:6px 20px 10px 20px;;" type="button" class="btn btn-info" id="myBtnG"><div class="v-btn__content" onclick="sendGlobalEmailOTP();">Send OTP  <span id="count" style="visibility:hidden;">00 S</span>
        </div></button>
                    </div>
                        </div>
                      </div>
                      <span style="color:red;"> Note : - Once You Click on OTP Button Please wait for 120 seconds and check your inbox </span>
     <?php } ?>
      <!--Email OTP-->         
     
         
     <?php  if($model->getValue("Instant_status")=='Y'){
     if($model->getValue("instant_otp")=='true'){ ?> 
     
     <div class="mb-3">
                    <label class="mb-1"><strong>Verification Code </strong></label>
                     <div class="row">
                     <div class="col-md-8">
                      <input placeholder="Verification Code" name="otp" required="required" type="text" class="form-control">   
                     </div>
                     <div class="col-md-4">
                      <button style="margin-top:25px;padding:6px 20px 10px 20px;;" type="button" class="btn btn-info"><div class="v-btn__content" onclick="sendotp();">Send OTP   <span id="count" style="visibility:hidden;">00 S</span>
        </div></button>   
                     </div>
                      </div>
                      	
                    </div>
                       
     <?php }  }?>
     
 </div>
    <div class="modal-footer"> 
    <?php 
    
    $checkParents = $model->checkPrentsIdorNot($member_id);
		    if($checkParents > 0 )
		    {
              echo "<code>You can`t withdraw this is Child  ID you withdraw from parent ID. </code>";    
		    }else
		    {?>
		       <input type="hidden" name="submitform" id="submitform" value="1">
				<button type="submit" class="btn btn-primary">Submit</button>  
		   <?php  }
		    
		    ?>
  
  </div>

          </form>
                           </div>
                        </div>
                     </div>  
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel"> Activate From Activation Wallet</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <form action="<?php  echo  generateMemberForm("account","upgradememberpackage"); ?>"   method="post">
        <div class="modal-body">

 <?php if(false) { ?> 
        
         <div class="mb-3">
                            <label class="mb-1"><strong>Activation-Pocket</strong></label>
                            <input  autocomplete="off"  class="form-control" type="text" readonly style=" border-color:#38383a!important;" value="$ <?php echo   $LDGR['net_balance'];?>" >
                            </div> 
                            
<?php } ?>                            
                             <!--<div class="mb-3">-->
                          <!--  <label class="mb-1"><strong>Pocket Type</strong></label>-->
                          <!--  <select name="wallet_id" class="form-control " id="wallet_id">-->
                          <!--  <option value="ESP">Kaizen Activation Wallet</option>-->
                          <!--  <option value="EGP">Kaizen Income Wallet</option>-->
                          <!--  </select>-->
                          <!--  </div>-->
                            <div class="mb-3">
                            <label class="mb-1"><strong>Package</strong></label>
                                <select  name="type_id" id="type_idEG" class="form-control" required  onchange="setPocketUse();" >
                                <option value="">Select Subscription </option>
                                <?php echo DisplayCombo($_GET['type_id'],"PIN_TYPE"); ?>
                                </select>
                            </div>     
                          
                            <!-- <div class="mb-3">-->
                            <!-- <label class="mb-1"><strong>Enter Value :</strong></label>-->
                            <!--     <input  placeholder="" id="package_price" name="package_price" autocomplete="off"   class="form-control" type="text" value="" required>-->
                            <!--</div>    -->
 
                            <div class="mb-3">
                            <label class="mb-1"><strong>Member Id</strong></label>
                                <input  placeholder="Member Id" id="mem_id" name="member_id" autocomplete="off" onchange="check_members(this.value);" class="form-control" type="text" value="" required>
                            </div>  
             
                            <div class="mb-3">
                            <label class="mb-1"><strong>Member Name</strong></label>
                                <input  placeholder="Member Name" id="user_name" name="member_name"   style=" border-color:#38383a!important;"  readonly class="form-control" type="text" value="">
                            </div> 
                           
                            <div class="mb-3">
                            <label class="mb-1"><strong>Login Password</strong></label>
                            <input class="form-control" name="trns_password" id="" type="password" placeholder="Login Password" required>
                            </div> 
     
      
     
 </div>
    <div class="modal-footer"> 
    
        <?php if($model->getValue("member_activation_on_off")=='Y' or   $sts =='N'){ ?>
     
        
                <input type="hidden" name="upgradeMemberShip" value="1" />
        
                                <button type="reset" class="btn btn-warning mr-1">
                                    <i class="ft-reset"></i> Reset
                                </button>
                                <button type="submit" name="buttonRequest" class="btn btn-primary">
                                    <i class="ace-icon fa fa-cloud-upload icon-on-right"></i>Upgrade
                                </button>
                           
                            <?php }?> 
  </div>

          </form>
                           </div>
                        </div>
                     </div> 
                      <script>
        function copylinkL()
        {
            var link = $("#cpl").val();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            console.log("Copied the text:", tempInput.value);
            alert('Left referral link copied.', 'success');
            document.body.removeChild(tempInput);
        }
        function copylinkR() {
            var link = $("#cpr").val();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            alert('Right referral link copied.', 'success');
            document.body.removeChild(tempInput);
        }
        
          function copylinkT() {
            var link = $("#tpr").val();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            tostalert('Trust Address copied.', 'success');
            document.body.removeChild(tempInput);
        }
    </script>
 <?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>