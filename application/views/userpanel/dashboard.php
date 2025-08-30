<?php  
$model = new OperationModel();
 _d('');
    $dateToday = date('Y-m-d');
    $member_id = $this->session->userdata('mem_id');
    
    $AR_TYPE  = $model->getCurrentMemberShip($member_id);
   // PrintR($AR_TYPE['date_time']);
        $pkgprice1  = $model->getPackagebyid(1,$member_id);
        $pkgprice2  = $model->getPackagebyid(2,$member_id);
        $pkgprice3  = $model->getPackagebyid(3,$member_id);
        $pkgprice4  = $model->getPackagebyid(4,$member_id);
        $pkgprice5  = $model->getPackagebyid(5,$member_id);
        $totalpckg  = $model->getTotalMemberShipValue($member_id);
      $AR_TYPE1  = $model->getCurrentMemberShipRetopup($member_id);
      
    //  PrintR($AR_TYPE);
    //PrintR($pkgprice);
  //PrintR($ROW);
  // echo $ROW['type_id'];
     if($ROW['subcription_id'] > 0 )
    {
        $date_from =  (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";  
    }else{
        
        
         $date_from =  '000 : 00 : 00 : 00';//(InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending"; 
    }
    
    
    if($ROW['subcription_id'] > 0 )
    {
         $date_from1 = $AR_TYPE['date_time']; 
    }else{
        
        
         $new_start_date = '';//$today_date = getLocalTime();
    }
    
          
    
    
    //PrintR($pkgprice);
  //  $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
  // $AR_TYPE['date_from'];
 		 $p2pwithdral = $model->p2pwithdral($member_id);
 	               	
    $paid_referral = $model->counttotalactivesponsor($member_id);
    
    $UPTO_WITH          = $model->totalGlobalPackage($member_id);
    $total_withdrawal   = $model->getMemberWithdrawal($member_id);
     $total_miningwithdrawal   = $model->getMemberminingWithdrawal($member_id);
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
$getTotalMemberShipValuetotal = $model->getTotalMemberShipValue($member_id);  
$getTotalMemberShipValuere = $model->getTotalMemberShipValuere($member_id);  
    $LDGR = $model->getCurrentBalance($member_id,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
  //  PRintR($LDGR);
	$LDGR2 = $model->getCurrentBalance($member_id,'2',$_REQUEST['from_date'],$_REQUEST['to_date']);
	$LDGR3 = $model->getCurrentBalance($member_id,'3',$_REQUEST['from_date'],$_REQUEST['to_date']);
		$LDGR4 = $model->getCurrentBalance($member_id,'4',$_REQUEST['from_date'],$_REQUEST['to_date']);
			$LDGR5 = $model->getCurrentBalance($member_id,'5',$_REQUEST['from_date'],$_REQUEST['to_date']);
			$LDGR6 = $model->getCurrentBalance($member_id,'6',$_REQUEST['from_date'],$_REQUEST['to_date']);
				$LDGR7 = $model->getCurrentBalance($member_id,'7',$_REQUEST['from_date'],$_REQUEST['to_date']);
		$vaulttopupfund =	$LDGR6['net_balance'];
 
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
             $roiIncome              =    $income['roiIncome'];
            $directIncome           =    $income['directIncome'];
            $levelIncome             =    $income['level'];
            $commuinity             =    $income['commuinity'];
            $royaltyInc             =    $income['quick'];
            $totalPayout            =    $income['totalPayout'];
            
            
          
    $left_paid = $model->BinaryCount($member_id,"LeftPaid");
    $right_paid = $model->BinaryCount($member_id,"RightPaid");         
    
   $packageSet = $model->getSetofPackage($member_id);
   
  $totalpaid= $left_paid+$right_paid;
   
     $totalPayout = $directIncome+$reward_1+$commuinity+$Level+$DailyIncome;
   
 
   
   
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
                                            $popupdata = $this->SqlModel->runQuery("SELECT pop.* FROM ".prefix."tbl_popup_data AS pop   WHERE 1  ORDER BY pop.popup_id ASC limit 1"); 
                                          // PrintR($popupdata);
                                         
   $activation = $this->SqlModel->runQuery("SELECT * FROM `tbl_subscription` WHERE `member_id` = '$member_id' ORDER BY `tbl_subscription`.`subcription_id` ASC");                                         
   
  $latestwithdaral = $this->SqlModel->runQuery("SELECT tft.* FROM ".prefix."tbl_fund_transfer AS tft WHERE tft.trns_for LIKE 'WITHDRAW'  and tft.to_member_id = '$member_id' ORDER BY tft.transfer_id DESC");                                         
 

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



 $dat11 = returnLevel111($member_id,'');  
  $segment = 'ACTIVE';//$this->uri->segment(4);
 $segment1 = 'INACTIVE';
 
 
foreach($dat11  as $AR_DT2):
				    $totalteam += $AR_DT2['total'];
			  	foreach($AR_DT2['data'] as $AR_DT3):
			     $PV = ($AR_DT3['prod_pv'] !='')?$AR_DT3['prod_pv']:0;
			     if($segment == 'ACTIVE')
			     {
			        $show = ($PV > 0 )?1:0 ;
			         $totalteamactiv += $show;
			     }
			    
			     if($segment1 == 'INACTIVE')
			     {  
			       $show = ($PV <=  0 )?1:0 ;
			     $totalteaminactiv += $show;
			     }
			     else
			     {
			         $show = 1 ;   
			     }
			     	    


	   endforeach; endforeach;	









  $today_datee = date('Y-m-d');

 $todayteamvalue = returnLeveltoday($member_id,'',$today_datee);  


	foreach($todayteamvalue  as $todayAR_DT){
			 if($todayAR_DT['total'] > 0){
			     $bv =0;
			  
			     	foreach($todayAR_DT['data']  as $todayAR_DT1){
			     	    
			     	  
			     	   $ddddaate = InsertDate($todayAR_DT1['date_from']);
			     	  //  $ddddaate =date($todayAR_DT1['date_from'],'Y-m-d');
			     	  if($ddddaate==$ddddaate){
			     	      
			     	      //	$bvt = ($todayAR_DT1['prod_pv'] !='')?$todayAR_DT1['prod_pv']:0;
			     	      
			     	      	$bvt += ($todayAR_DT1['prod_pv'] !='')?$todayAR_DT1['prod_pv']:0;
			     	      	
			     	      
			     	      		  //	PrintR($todayAR_DT1); 
			     	      
			     	  }  
			     	    
			     	    
			     	    		$todayteambusiness1 = $bvt;
			     	    
			     	 
			     
			     	
	
			     	
			     	}    
			     	    
			 }
	}





?>
  <?php 
 $StakingPoint  = $model->getStakingFigur($member_id);
          if($StakingPoint > 0 )
         {
                $_seconds  =  $StakingPoint/86400;
                $_1_second =  number_format($_seconds, 10, '.', '');
                 $timeFirst  = strtotime(date($AR_TYPE['date_time']));
                //$timeFirst  = strtotime(date('Y-m-d').' 00:00:00');
                $timeSecond = strtotime(date('Y-m-d H:i:s'));
                $differenceInSeconds = $timeSecond - $timeFirst;
                
                $_pre_figur = $_1_second *$differenceInSeconds;
                $_pre_figur =  number_format($_pre_figur, 10, '.', '');
                $_1_second =  number_format($_seconds/10, 10, '.', '');
                 
         }
         else
         {
            $_pre_figur  = 0;
            $_1_second  = 0;
         }

$total1  = round($model->getpboardcount('10'));
$total2  =  round($model->getpboardcount('20'));
$total3  =  round($model->getpboardcount('40'));
$total4  =  round($model->getpboardcount('80'));
$total5  =  round($model->getpboardcount('160'));
//$total6  =  round($model->getpboardcount('3200'));

$user_id = $model->getMemberUserId($member_id);
 



  $DailyIncome = $model->getincomesallnew("Daily",$member_id);   
$directIncome = $model->getincomesallnew("Direct",$member_id);
$royaltyInc = $model->getincomesallnew("Booster",$member_id);
$clubInc = $model->getincomesallnew("Club",$member_id);
$reward_1 = $model->getincomesallnew("Reward_1",$member_id);
$reward_2 = $model->getincomesallnew("Reward_2",$member_id);
$commuinity = $model->getincomesallnew("Community",$member_id);
$Level = $model->getincomesallnew("Level",$member_id);
$Boardincome = $model->getincomesallnew("Pool",$member_id);
$Re_Poolincome = $model->getincomesallnew("Re_Pool",$member_id);
$Club = $model->getincomesallnew("Club",$member_id);
$Performance = $model->getincomesallnew("Performance",$member_id);

   $Wallet_addressffff= $Wallet_address = $model->getMemberwallet_adress($member_id);
   
     $workingincome = $reward_1+$Level+$royaltyInc+$clubInc+$reward_2;
   
     if($totalPayout > 0 )
            {
              $_1_per = $totalPayout/100; 
              $binary_per = number_format((float)$binaryIncome/$_1_per, 2, '.', '');
              $cashbk_per = number_format((float)$roiIncome/$reward_1, 2, '.', '');
              $direct_per = number_format((float)$directIncome/$_1_per, 2, '.', '');
              $levelin_per = number_format((float)$Level/$_1_per, 2, '.', '');
              $commuinity_per = number_format((float)$Boardincome/$_1_per, 2, '.', '');
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
   
   
 function cal_percentage($num_amount, $num_total) {
  $count1 = $num_amount / $num_total;
  $count2 = $count1 * 100;
  $count = $count2;
  return $count;
}

// calling function to calculate percentage
$getTotalMemberShipValue = $model->getTotalMemberShipValueT($member_id); 
$getTotalMembertimerpool = $model->getTotalMemberShipValueTP($member_id);  
$getTotalMembertimerretopup = $model->getTotalMemberShipValueRTP($member_id);  
//PrintR($ROW);

    	  $memberdetail   = $model->getMemberdetail($member_id); 
    	  
    	  
    	  
    	  
    	  $DirectCount = $model->BinaryCount($member_id,"DirectCount");
    	  
    	 // PRintR($dsfsdfsdfs);
    	  
    	  
    	    $airdropamount = $model->getairdropamount($member_id);
    	  
    	    $airdropcounttotal = $model->getairdropcount($member_id);
    	  
    	    $airdropcountverify = $model->getairdropcountverify($member_id);
    	     $airdropamountself = $model->getairdropamountself($member_id);




 




$TOTALDIRECT = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$member_id'"; 
$TOTALDIRECT = $this->SqlModel->runQuery($TOTALDIRECT,true);
$TOTALDIRECT1 = $TOTALDIRECT['total'];


$PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$member_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE 1)"; 
$PAID_DIR = $this->SqlModel->runQuery($PAID_DIR,true);
$PAID_total = $PAID_DIR['total'];


$DIRECTPAID = "SELECT sum(direct_bv) as total FROM `tbl_members` WHERE member_id = '$member_id'"; 
$DIRECTPAID = $this->SqlModel->runQuery($DIRECTPAID,true);
$DIRECTPAID_total = $DIRECTPAID['total'];

$today_datee = date('Y-m-d');
$TODAYDIRECTPAID = "SELECT sum(prod_pv) as total FROM `tbl_members` WHERE sponsor_id = '$member_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE 1)"; 
$TODAYDIRECTPAID = $this->SqlModel->runQuery($TODAYDIRECTPAID,true);
$TODAYDIRECTPAID_total = $TODAYDIRECTPAID['total'];
   	  
?>
<?php

 $this->load->view(MEMBER_FOLDER.'/layout/header'); 


 
 
 
$getSubcriptionsxincomedata = $model->getSubcriptionsxincomedata($member_id);
//echo $QR_SELECT = "SELECT member_id ,sponsor_id,rank_id,count_directs,subcription_id   FROM (SELECT member_id ,sponsor_id,rank_id,count_directs,subcription_id,  CASE WHEN member_id = '$member_id' THEN @id := sponsor_id WHEN member_id = @id THEN @id := sponsor_id END as checkId FROM tbl_members ORDER BY member_id DESC) as T WHERE checkId IS NOT NULL";
//die;
 $coinprice = $this->SqlModel->runQuery("SELECT * FROM `tbl_coin_rate` WHERE 1 ORDER BY `tbl_coin_rate`.`id` DESC limit 1"); 
 //PrintR($coinprice);
 	$QR_CHECK = "SELECT * FROM tbl_members WHERE member_id='".$member_id."'";
		$memdata = $this->SqlModel->runQuery($QR_CHECK,true); 
	//	PrintR($memdata)
			$ttbonus = $DailyIncome+$Boardincome+$directIncome+$Level+$royaltyInc+$commuinity+$reward_1+$Club+$Performance;
		
	
	
	     if($ROW['count_directs']>0){
                $x_income='600';
               $_5xincome =$x_income*$getTotalMemberShipValue/100;
            $Income_Category='6 X';  
            
           
           $netgrotth=  $ttbonus;
       $_10x  =  ($netgrotth/$getTotalMemberShipValue)*100; 
    
       $_10x=  str_replace(",", "", $_10x);
       
       
           
                
            }else{
                
                
             $x_income='200';
               $_5xincome =$x_income*$getTotalMemberShipValue/100;
            $Income_Category='2 X';  
            
           
          $netgrotth=  $ttbonus;
       $_2x  =  ($netgrotth/$getTotalMemberShipValue)*100; 
    
       $_2x=  str_replace(",", "", $_2x);    
                
                
                
                
            }
    	  
		
	 if($ROW['count_directs']>0){
		
		
$_3xxx	=	$getTotalMemberShipValue;
$_3xxxx	=	$getTotalMemberShipValue*600/100;		   
    
	 }else{
	     
	     
	   $_2xxx	=  	$getTotalMemberShipValue;
	       $_2xxxx	=  	$getTotalMemberShipValue*200/100;;
	 }
   
		
		
?>

 

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php
        
        $this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
        
        ?>
        
       
        <!--**********************************
            Nav header end
        ***********************************-->
		
		
	

        <!--**********************************
            Sidebar start
        ***********************************-->
     <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu');  ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex align-items-center mb-sm-4 mb-3">
					<div class="me-auto">
							<a href="javascript:void(0)" class="btn btn-outline-primary"><i class="las la-cog scale5 me-3"></i>Dashboard</a>
					</div>
				
				</div>
				<div class="row">
				    <div class="container-fluid">
			
			 <div class="row">
                    <div class="col-lg-12">
                        <div class="profile card card-body px-3 pt-3 pb-0">
                            <div class="profile-head">
                                <div class="photo-content">
                                  <div class="cover-photo" style="background: cadetblue !important;min-height: 172px!important"></div>
                                </div>
                                <div class="profile-info">
									<div class="profile-photo">
									  <?php  if($fetchRow['photo'] !=''){ $pic = $fetchRow['photo'];}else{ $pic='error';}
                                            if (file_exists(FCPATH.'upload/member/'.$pic)) { ?>
                                       <img class="profile-pic" src="<?php echo BASE_PATH;?>upload/member/<?php echo $fetchRow['photo'];?>" alt="profile-pic" style="    width: 50px;">
                                        
                                         <?php } else { ?>
 	<img src="<?php echo BASE_PATH; ?>newassets/images/profile/profile.png" class="img-fluid rounded-circle" alt="">
								
                                           
<?php } ?>   
                             
									</div>
									<div class="profile-details">
										<div class="profile-name px-3 pt-2">
											<h4 class="text-primary mb-0"><strong><?php echo     strtoupper($ROW['first_name']);?></strong></h4>
											<p><?php echo $ROW['user_id'];?></p>
										</div>
										<div class="profile-email px-2 pt-2">
											<h4 class="text-muted mb-0"><?php echo $ROW['member_email'];?></h4>
											<p>Email</p>
										</div>
										<div class="profile-email px-2 pt-2">
											<h4 class="text-muted mb-0"><?php echo $ROW['member_mobile'];?></h4>
											<p>Contact</p>
										</div>
										<div class="profile-email px-2 pt-2">
											<h4 class="text-muted mb-0"><?php echo DisplayDate($ROW['date_join']);?></h4>
											<p>D.O.R</p>
										</div>
										<div class="profile-email px-2 pt-2">
											<h4 class="text-muted mb-0"><?php   if($ROW['subcription_id'] > 0 )
    { ?>  <?php echo DisplayDate($date_from); ?>
    <?php }else{ ?>  
<div class="nav-value">Pending</div>
<?php } ?></h4>
											<p>D.O.A</p>
										</div>
										<div class="dropdown ms-auto">
											<a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
											<ul class="dropdown-menu dropdown-menu-end">
												<li class="dropdown-item"><i class="fa fa-user-circle text-primary me-2"></i> View profile</li>
											 
											</ul>
										</div>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
					 
				
				</div>
				 <?php get_message();?>
				
				<div class="row">
				    
<script>
// Get today's date
<?php //echo $date_from1; ?>
var startDate = new Date("<?php echo $date_from1; ?>");

// Add 7 days
var countDownDate = new Date(startDate.getTime() + 1 * 24 * 60 * 60 * 1000);

// Update countdown every second
var x = setInterval(function() {
  var now = new Date().getTime();
  var distance = countDownDate - now;

  // Time breakdown
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display
  document.getElementById("demo").innerHTML =
    days + "d " + hours + "h " + minutes + "m " + seconds + "s";

  // When expired
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>


				   <?php 
				   
				   	$is_booster=	$memberdetail['is_booster'];
				   if($is_booster=='N'){ ?> 
				    
				    <div class="col-xl-3 col-xxl-12 col-lg-12 col-sm-12">
						<div class="widget-stat card bg-danger">
							<div class="card-body  p-4">
								<div class="media">
								
									<div class="media-body text-white text-center">
										<p class="mb-1">Booster Pending</p>
										<h3 class="text-white" id="demo"> </h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
                    
                    <?php }else{ ?>
                    
					<div class="col-xl-3 col-xxl-12 col-lg-12 col-sm-12">
						<div class="widget-stat card bg-success">
							<div class="card-body p-4">
								<div class="media">
								
									<div class="media-body text-white text-center">
										<p class="mb-1">Booster Achieved</p>
										<h3 class="text-white">Success</h3>
									</div>
								</div>
							</div>
						</div>
                    </div>
				    
				    <?php } ?>
				    
						<div class="col-xl-3  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($getTotalMemberShipValue-$getTotalMembertimerpool,2); ?></h2>
										<span>My Deposit Value</span>
									</div>
								
								</div>
								  <a href="#"   data-bs-toggle="modal" data-bs-target="#exampleModal31" style="color:blue;"  >View All</a>
                                </a>
							</div>
							
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?>  <?php echo number_format($DailyIncome,2); ?></h2>
										<span>ROI Income</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.7 39.9993C15.8603 40.0123 18.0017 39.5921 20 38.763C21.9962 39.5991 24.139 40.0196 26.3 39.9993C32.861 39.9993 38 36.463 38 31.9467V24.4159C38 19.8996 32.861 16.3633 26.3 16.3633C25.9958 16.3633 25.697 16.3779 25.4 16.3943V7.87804C25.4 3.45448 20.261 0 13.7 0C7.139 0 2 3.45448 2 7.87804V32.1213C2 36.5448 7.139 39.9993 13.7 39.9993ZM34.4 31.9467C34.4 34.0358 31.0736 36.363 26.3 36.363C21.5264 36.363 18.2 34.0358 18.2 31.9467V30.2649C20.6376 31.7624 23.4476 32.5262 26.3 32.4667C29.1524 32.5262 31.9624 31.7624 34.4 30.2649V31.9467ZM26.3 19.9996C31.0736 19.9996 34.4 22.3269 34.4 24.4159C34.4 26.505 31.0736 28.8304 26.3 28.8304C21.5264 28.8304 18.2 26.5032 18.2 24.4159C18.2 22.3287 21.5264 19.9996 26.3 19.9996ZM13.7 3.6363C18.4736 3.6363 21.8 5.87262 21.8 7.87804C21.8 9.88346 18.4736 12.1216 13.7 12.1216C8.9264 12.1216 5.6 9.88528 5.6 7.87804C5.6 5.87081 8.9264 3.6363 13.7 3.6363ZM5.6 13.6034C8.04776 15.0717 10.8538 15.8181 13.7 15.7579C16.5462 15.8181 19.3522 15.0717 21.8 13.6034V16.9633C19.8383 17.4628 18.0392 18.4698 16.58 19.8851C15.6336 20.092 14.6683 20.198 13.7 20.2015C8.9264 20.2015 5.6 17.9651 5.6 15.9597V13.6034ZM5.6 21.6851C8.04828 23.1519 10.854 23.8976 13.7 23.8378C14.0204 23.8378 14.33 23.7978 14.645 23.7814C14.6182 23.9919 14.6032 24.2037 14.6 24.4159V28.2068C14.2976 28.225 14.006 28.2831 13.7 28.2831C8.9264 28.2831 5.6 26.0468 5.6 24.0396V21.6851ZM5.6 29.7649C8.04776 31.2332 10.8538 31.9796 13.7 31.9194C14.0024 31.9194 14.2994 31.8958 14.6 31.8813V31.9467C14.6258 33.4944 15.2146 34.9784 16.2542 36.1157C15.412 36.2763 14.5571 36.3591 13.7 36.363C8.9264 36.363 5.6 34.1267 5.6 32.1213V29.7649Z" fill="#007A64"/>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($directIncome,2); ?></h2>
										<span>Direct Income</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.7 39.9993C15.8603 40.0123 18.0017 39.5921 20 38.763C21.9962 39.5991 24.139 40.0196 26.3 39.9993C32.861 39.9993 38 36.463 38 31.9467V24.4159C38 19.8996 32.861 16.3633 26.3 16.3633C25.9958 16.3633 25.697 16.3779 25.4 16.3943V7.87804C25.4 3.45448 20.261 0 13.7 0C7.139 0 2 3.45448 2 7.87804V32.1213C2 36.5448 7.139 39.9993 13.7 39.9993ZM34.4 31.9467C34.4 34.0358 31.0736 36.363 26.3 36.363C21.5264 36.363 18.2 34.0358 18.2 31.9467V30.2649C20.6376 31.7624 23.4476 32.5262 26.3 32.4667C29.1524 32.5262 31.9624 31.7624 34.4 30.2649V31.9467ZM26.3 19.9996C31.0736 19.9996 34.4 22.3269 34.4 24.4159C34.4 26.505 31.0736 28.8304 26.3 28.8304C21.5264 28.8304 18.2 26.5032 18.2 24.4159C18.2 22.3287 21.5264 19.9996 26.3 19.9996ZM13.7 3.6363C18.4736 3.6363 21.8 5.87262 21.8 7.87804C21.8 9.88346 18.4736 12.1216 13.7 12.1216C8.9264 12.1216 5.6 9.88528 5.6 7.87804C5.6 5.87081 8.9264 3.6363 13.7 3.6363ZM5.6 13.6034C8.04776 15.0717 10.8538 15.8181 13.7 15.7579C16.5462 15.8181 19.3522 15.0717 21.8 13.6034V16.9633C19.8383 17.4628 18.0392 18.4698 16.58 19.8851C15.6336 20.092 14.6683 20.198 13.7 20.2015C8.9264 20.2015 5.6 17.9651 5.6 15.9597V13.6034ZM5.6 21.6851C8.04828 23.1519 10.854 23.8976 13.7 23.8378C14.0204 23.8378 14.33 23.7978 14.645 23.7814C14.6182 23.9919 14.6032 24.2037 14.6 24.4159V28.2068C14.2976 28.225 14.006 28.2831 13.7 28.2831C8.9264 28.2831 5.6 26.0468 5.6 24.0396V21.6851ZM5.6 29.7649C8.04776 31.2332 10.8538 31.9796 13.7 31.9194C14.0024 31.9194 14.2994 31.8958 14.6 31.8813V31.9467C14.6258 33.4944 15.2146 34.9784 16.2542 36.1157C15.412 36.2763 14.5571 36.3591 13.7 36.363C8.9264 36.363 5.6 34.1267 5.6 32.1213V29.7649Z" fill="#007A64"/>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($Level,2); ?></h2>
										<span>Level Income</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.7 39.9993C15.8603 40.0123 18.0017 39.5921 20 38.763C21.9962 39.5991 24.139 40.0196 26.3 39.9993C32.861 39.9993 38 36.463 38 31.9467V24.4159C38 19.8996 32.861 16.3633 26.3 16.3633C25.9958 16.3633 25.697 16.3779 25.4 16.3943V7.87804C25.4 3.45448 20.261 0 13.7 0C7.139 0 2 3.45448 2 7.87804V32.1213C2 36.5448 7.139 39.9993 13.7 39.9993ZM34.4 31.9467C34.4 34.0358 31.0736 36.363 26.3 36.363C21.5264 36.363 18.2 34.0358 18.2 31.9467V30.2649C20.6376 31.7624 23.4476 32.5262 26.3 32.4667C29.1524 32.5262 31.9624 31.7624 34.4 30.2649V31.9467ZM26.3 19.9996C31.0736 19.9996 34.4 22.3269 34.4 24.4159C34.4 26.505 31.0736 28.8304 26.3 28.8304C21.5264 28.8304 18.2 26.5032 18.2 24.4159C18.2 22.3287 21.5264 19.9996 26.3 19.9996ZM13.7 3.6363C18.4736 3.6363 21.8 5.87262 21.8 7.87804C21.8 9.88346 18.4736 12.1216 13.7 12.1216C8.9264 12.1216 5.6 9.88528 5.6 7.87804C5.6 5.87081 8.9264 3.6363 13.7 3.6363ZM5.6 13.6034C8.04776 15.0717 10.8538 15.8181 13.7 15.7579C16.5462 15.8181 19.3522 15.0717 21.8 13.6034V16.9633C19.8383 17.4628 18.0392 18.4698 16.58 19.8851C15.6336 20.092 14.6683 20.198 13.7 20.2015C8.9264 20.2015 5.6 17.9651 5.6 15.9597V13.6034ZM5.6 21.6851C8.04828 23.1519 10.854 23.8976 13.7 23.8378C14.0204 23.8378 14.33 23.7978 14.645 23.7814C14.6182 23.9919 14.6032 24.2037 14.6 24.4159V28.2068C14.2976 28.225 14.006 28.2831 13.7 28.2831C8.9264 28.2831 5.6 26.0468 5.6 24.0396V21.6851ZM5.6 29.7649C8.04776 31.2332 10.8538 31.9796 13.7 31.9194C14.0024 31.9194 14.2994 31.8958 14.6 31.8813V31.9467C14.6258 33.4944 15.2146 34.9784 16.2542 36.1157C15.412 36.2763 14.5571 36.3591 13.7 36.363C8.9264 36.363 5.6 34.1267 5.6 32.1213V29.7649Z" fill="#007A64"/>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
						<div class="col-xl-4  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($DIRECTPAID_total,2); ?></h2>
										<span>Direct Team Value</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.7 39.9993C15.8603 40.0123 18.0017 39.5921 20 38.763C21.9962 39.5991 24.139 40.0196 26.3 39.9993C32.861 39.9993 38 36.463 38 31.9467V24.4159C38 19.8996 32.861 16.3633 26.3 16.3633C25.9958 16.3633 25.697 16.3779 25.4 16.3943V7.87804C25.4 3.45448 20.261 0 13.7 0C7.139 0 2 3.45448 2 7.87804V32.1213C2 36.5448 7.139 39.9993 13.7 39.9993ZM34.4 31.9467C34.4 34.0358 31.0736 36.363 26.3 36.363C21.5264 36.363 18.2 34.0358 18.2 31.9467V30.2649C20.6376 31.7624 23.4476 32.5262 26.3 32.4667C29.1524 32.5262 31.9624 31.7624 34.4 30.2649V31.9467ZM26.3 19.9996C31.0736 19.9996 34.4 22.3269 34.4 24.4159C34.4 26.505 31.0736 28.8304 26.3 28.8304C21.5264 28.8304 18.2 26.5032 18.2 24.4159C18.2 22.3287 21.5264 19.9996 26.3 19.9996ZM13.7 3.6363C18.4736 3.6363 21.8 5.87262 21.8 7.87804C21.8 9.88346 18.4736 12.1216 13.7 12.1216C8.9264 12.1216 5.6 9.88528 5.6 7.87804C5.6 5.87081 8.9264 3.6363 13.7 3.6363ZM5.6 13.6034C8.04776 15.0717 10.8538 15.8181 13.7 15.7579C16.5462 15.8181 19.3522 15.0717 21.8 13.6034V16.9633C19.8383 17.4628 18.0392 18.4698 16.58 19.8851C15.6336 20.092 14.6683 20.198 13.7 20.2015C8.9264 20.2015 5.6 17.9651 5.6 15.9597V13.6034ZM5.6 21.6851C8.04828 23.1519 10.854 23.8976 13.7 23.8378C14.0204 23.8378 14.33 23.7978 14.645 23.7814C14.6182 23.9919 14.6032 24.2037 14.6 24.4159V28.2068C14.2976 28.225 14.006 28.2831 13.7 28.2831C8.9264 28.2831 5.6 26.0468 5.6 24.0396V21.6851ZM5.6 29.7649C8.04776 31.2332 10.8538 31.9796 13.7 31.9194C14.0024 31.9194 14.2994 31.8958 14.6 31.8813V31.9467C14.6258 33.4944 15.2146 34.9784 16.2542 36.1157C15.412 36.2763 14.5571 36.3591 13.7 36.363C8.9264 36.363 5.6 34.1267 5.6 32.1213V29.7649Z" fill="#007A64"/>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
						<div class="col-xl-4  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($todayteambusiness1,2); ?></h2>
										<span>Today Team Value</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.7 39.9993C15.8603 40.0123 18.0017 39.5921 20 38.763C21.9962 39.5991 24.139 40.0196 26.3 39.9993C32.861 39.9993 38 36.463 38 31.9467V24.4159C38 19.8996 32.861 16.3633 26.3 16.3633C25.9958 16.3633 25.697 16.3779 25.4 16.3943V7.87804C25.4 3.45448 20.261 0 13.7 0C7.139 0 2 3.45448 2 7.87804V32.1213C2 36.5448 7.139 39.9993 13.7 39.9993ZM34.4 31.9467C34.4 34.0358 31.0736 36.363 26.3 36.363C21.5264 36.363 18.2 34.0358 18.2 31.9467V30.2649C20.6376 31.7624 23.4476 32.5262 26.3 32.4667C29.1524 32.5262 31.9624 31.7624 34.4 30.2649V31.9467ZM26.3 19.9996C31.0736 19.9996 34.4 22.3269 34.4 24.4159C34.4 26.505 31.0736 28.8304 26.3 28.8304C21.5264 28.8304 18.2 26.5032 18.2 24.4159C18.2 22.3287 21.5264 19.9996 26.3 19.9996ZM13.7 3.6363C18.4736 3.6363 21.8 5.87262 21.8 7.87804C21.8 9.88346 18.4736 12.1216 13.7 12.1216C8.9264 12.1216 5.6 9.88528 5.6 7.87804C5.6 5.87081 8.9264 3.6363 13.7 3.6363ZM5.6 13.6034C8.04776 15.0717 10.8538 15.8181 13.7 15.7579C16.5462 15.8181 19.3522 15.0717 21.8 13.6034V16.9633C19.8383 17.4628 18.0392 18.4698 16.58 19.8851C15.6336 20.092 14.6683 20.198 13.7 20.2015C8.9264 20.2015 5.6 17.9651 5.6 15.9597V13.6034ZM5.6 21.6851C8.04828 23.1519 10.854 23.8976 13.7 23.8378C14.0204 23.8378 14.33 23.7978 14.645 23.7814C14.6182 23.9919 14.6032 24.2037 14.6 24.4159V28.2068C14.2976 28.225 14.006 28.2831 13.7 28.2831C8.9264 28.2831 5.6 26.0468 5.6 24.0396V21.6851ZM5.6 29.7649C8.04776 31.2332 10.8538 31.9796 13.7 31.9194C14.0024 31.9194 14.2994 31.8958 14.6 31.8813V31.9467C14.6258 33.4944 15.2146 34.9784 16.2542 36.1157C15.412 36.2763 14.5571 36.3591 13.7 36.363C8.9264 36.363 5.6 34.1267 5.6 32.1213V29.7649Z" fill="#007A64"/>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
					
						<div class="col-xl-4  col-sm-6">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($teambusiness,2); ?></h2>
										<span>Total Team Value</span>
									</div>
									<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M13.7 39.9993C15.8603 40.0123 18.0017 39.5921 20 38.763C21.9962 39.5991 24.139 40.0196 26.3 39.9993C32.861 39.9993 38 36.463 38 31.9467V24.4159C38 19.8996 32.861 16.3633 26.3 16.3633C25.9958 16.3633 25.697 16.3779 25.4 16.3943V7.87804C25.4 3.45448 20.261 0 13.7 0C7.139 0 2 3.45448 2 7.87804V32.1213C2 36.5448 7.139 39.9993 13.7 39.9993ZM34.4 31.9467C34.4 34.0358 31.0736 36.363 26.3 36.363C21.5264 36.363 18.2 34.0358 18.2 31.9467V30.2649C20.6376 31.7624 23.4476 32.5262 26.3 32.4667C29.1524 32.5262 31.9624 31.7624 34.4 30.2649V31.9467ZM26.3 19.9996C31.0736 19.9996 34.4 22.3269 34.4 24.4159C34.4 26.505 31.0736 28.8304 26.3 28.8304C21.5264 28.8304 18.2 26.5032 18.2 24.4159C18.2 22.3287 21.5264 19.9996 26.3 19.9996ZM13.7 3.6363C18.4736 3.6363 21.8 5.87262 21.8 7.87804C21.8 9.88346 18.4736 12.1216 13.7 12.1216C8.9264 12.1216 5.6 9.88528 5.6 7.87804C5.6 5.87081 8.9264 3.6363 13.7 3.6363ZM5.6 13.6034C8.04776 15.0717 10.8538 15.8181 13.7 15.7579C16.5462 15.8181 19.3522 15.0717 21.8 13.6034V16.9633C19.8383 17.4628 18.0392 18.4698 16.58 19.8851C15.6336 20.092 14.6683 20.198 13.7 20.2015C8.9264 20.2015 5.6 17.9651 5.6 15.9597V13.6034ZM5.6 21.6851C8.04828 23.1519 10.854 23.8976 13.7 23.8378C14.0204 23.8378 14.33 23.7978 14.645 23.7814C14.6182 23.9919 14.6032 24.2037 14.6 24.4159V28.2068C14.2976 28.225 14.006 28.2831 13.7 28.2831C8.9264 28.2831 5.6 26.0468 5.6 24.0396V21.6851ZM5.6 29.7649C8.04776 31.2332 10.8538 31.9796 13.7 31.9194C14.0024 31.9194 14.2994 31.8958 14.6 31.8813V31.9467C14.6258 33.4944 15.2146 34.9784 16.2542 36.1157C15.412 36.2763 14.5571 36.3591 13.7 36.363C8.9264 36.363 5.6 34.1267 5.6 32.1213V29.7649Z" fill="#007A64"/>
									</svg>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
					
					
						<div class="col-xl-4  col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($LDGR['net_balance'],2); ?></h2>
										<span>Income Wallet</span>
									</div>
									  <a href="#"   data-bs-toggle="modal" data-bs-target="#A2ATransfer" style="color:blue;"  >I to A Transfer </a>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
					 	<div class="col-xl-4  col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($LDGR2['net_balance'],2); ?></h2>
										<span>Direct inc Wallet</span>
									</div>
									  <a href="#"   data-bs-toggle="modal" data-bs-target="#A2ATransfer" style="color:blue;"  >D to A Transfer </a>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>	<div class="col-xl-4  col-sm-4">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($LDGR3['net_balance'],2); ?></h2>
										<span>A Wallet</span>
									</div>
								 <?php if(true){ ?>
                                    <span>
                                         <a href="#"   data-bs-toggle="modal" style="font-size: 16px;float: inline-end;color: darkblue;" data-bs-target="#Activate"   >Activate Here</a>
                                    </span>
                                <?php } ?>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
						 
						<div class="col-xl-12  col-sm-12">
						<div class="card">
							<div class="card-body">
								<div class="media align-items-center">
									<div class="media-body me-3">
										<h2 class="fs-34 text-black font-w600"><?php echo CURRENCY; ?> <?php echo number_format($total_withdrawal,2); ?></h2>
										<span>Total Withd.</span>
									</div>
									
								 
									<a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal2" style="color: white;font-size: 12px;" >Withdrawal Now </a>
										
                                </a>
								</div>
							</div>
							<div class="progress  rounded-0" style="height:4px;">
								<div class="progress-bar rounded-0 bg-secondary progress-animated" style="width: 94%; height:4px;" role="progressbar">
									<span class="sr-only">94% Complete</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
				<div class="col-xl-12">	
								<div class="card">
									<div class="card-header border-0 pb-0">
										<h3 class="fs-20 text-black mb-0 me-2">Revenue Summary</h3>
										<div class="dropdown mt-sm-0 mt-3">
											<button type="button" class="btn bg-light text-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
												2025
											</button>
											<div class="dropdown-menu dropdown-menu-end">
											
												<a class="dropdown-item" href="javascript:void(0);">2025</a>
											</div>
										</div>
									</div>
									<div class="card-body pt-0">
										<div id="chartBar"></div>
									</div>
								</div>
							</div>
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-12">	
								<div class="card appointment-schedule">
									<div class="card-header pb-0 border-0">
										<h3 class="fs-20 text-black mb-0">Calender Schedule</h3>
										<div class="dropdown ms-auto c-pointer">
											<div class="btn-link p-2 bg-light" data-bs-toggle="dropdown">
												<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
													<path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													<path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
													<path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
												</svg>
											</div>
											<div class="dropdown-menu dropdown-menu-end">
												<a class="dropdown-item text-black" href="javascript:;">Info</a>
												<a class="dropdown-item text-black" href="javascript:;">Details</a>
											</div>
										</div>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-xl-6 col-xxl-12 col-md-6">
												<div class="appointment-calender">
													<input type='text' class="form-control d-none" id='datetimepicker1' />
												</div>
											</div>
											<div class="col-xl-6 col-xxl-12 col-md-6">
												<div class="d-flex pb-3 border-bottom mb-3 align-items-end">
													
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
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        <div class="modal fade" id="A2ATransfer">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">  Transfer Activation Wallet</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="<?php  echo  generateMemberForm("ewallet","transferfund"); ?>" id="form-valid" name="form-valid" method="post">	
                              <div class="modal-body">
                                
				 
				  <?php  $rand=rand(); $this->session->set_userdata("rand",$rand); ?>
  <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
  
               <select name="f_wallet_id" id="f_wallet_id" class="  form-control wide" required="" onchange="getbenefits(this.value);">
                                
                                <option value="1">From Income Wallet</option>
                                <option value="2">From Direct Wallet</option>
                                
                                
                                </select>
				 
				 <?php if(false){ ?>
			    <div class="mb-3">
                    <label class="mb-1"><strong>Member Id</strong></label>
                    <input id="spr_user_id"  placeholder="Member Id"  onchange="check_member1(this.value);" name="user_id"  required class="form-control validate[required]" type="text" value="">
                </div> 
				 
				<div class="mb-3">
                    <label class="mb-1"><strong>Member Name</strong></label>
                    <input  id="name"  placeholder="Member Name" readonly  class="form-control validate[required]" type="text" value="">
                </div>
                
                <?php } ?>
				   	
				 <div class="mb-3">
                    <label class="mb-1"><strong>USDT</strong></label>
                    <input id="initial_amount"  placeholder="Enter Amount"  name="initial_amount"  class="form-control validate[required,custom[integer]]" type="text" required value="" maxlength="5">
                </div>  

 
			    <div class="mb-3">
                    <label class="mb-1"><strong>Login Password</strong></label>
                    <input name="trns_password" type="password" class="form-control validate[required]" required id="trns_password"  value="" placeholder="Login Password">
                </div>  
                   
                              </div>
                              <div class="modal-footer">
                                   
                                    <input type="hidden" name="submitFundRequest" id="submitFundRequest" value="1" />
                                    <input name="buttonRequest" value="Transfer Now" class="btn btn-primary mr-2  btn-primary" id="buttonRequest" type="submit">
                              </div>
                              
                              </form>
    

</div>
</div>
</div>   
<div class="modal fade" id="Activate">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"> Activate Your Account</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
   <form action="<?php  echo  generateMemberForm("account","upgradememberpackage"); ?>"   method="post">
        <div class="modal-body">

 <?php if(true) { ?> 
        
        <?php echo CURRENCY; ?> <?php echo number_format($LDGR3['net_balance'],2); ?>
                            
<?php } ?>         
	<?php if(true){ ?>
  <div class="mb-3" style="display:none;">
                           
                            
                             <label><strong  >Select Top / Re-Top Up</strong></label>
						   
                                <select  name="topup" id="topup" class=" default-select form-control form-control-lg wide mb-3" required   >
                                
                                   <option value="topup" style="background:blue;" selected>Top Up</option>
                                </select>
                            </div>     
                            
                          
                                        <?php if($memdata['plan']=='A')
{ ?>
                            <div class="mb-3">
                           
                            
                             <label><strong  >Package</strong></label>
						   
                                <select  name="type_id" class="  form-control wide" required  id="type_id" onchange="checkValue()">
                                
                                <?php echo DisplayCombo($_GET['type_id'],"PIN_TYPE"); ?>
                                </select>
                            </div>   
                            
                           <?php }  ?>
                           
                          
                            
                              <?php if(false){ ?>  
                             <div class="mb-3" id="ben1" style="display:none;">
                                <div>
                                    
                                 
                                  
                                   <div class="container">
                                       <div class="row">
                                           <div class="col-md-6">
                                               <div style="background: #CFCFCF;">
                                
                               <table border="1" cellpadding="1" cellspacing="1" style="width:100%;text-align: center;font-size: 14px;">
	<tbody>
		<tr>
			<td colspan="4" rowspan="1">
				<strong>Packages Benefits</strong> 
			</td>
		
		</tr>
		<tr>
			<td>
				<strong>Package Name</strong>
			</td>
			<td>
				<strong>Package Returns %</strong>
			</td>
			<td>
				<strong>Upto Months</strong>
			</td>
			
		</tr>
		<tr>
			<td>
				<strong>NOVOICE</strong>
			</td>
			<td>
				<strong>8 %</strong>
			</td>
			<td>
				<strong>30 Months</strong>
			</td>
		
		</tr>
	</tbody>
</table>

<p>
	&nbsp;
</p>

                            </div>
                                               
                                           </div>
                                           
                                       </div>
                                       
                                   </div> 
                                    
                                </div>
                              
                               
                               
                               
                            </div> 
                            
                              <div class="mb-3" id="ben2" style="display:none;">
                            
                                <div>
                                    
                                 
                                  
                                   <div class="container">
                                       <div class="row">
                                           <div class="col-md-6">
                                               <div style="background: gold;">
                                
                               <table border="1" cellpadding="1" cellspacing="1" style="width:100%;text-align: center;font-size: 14px;">
	<tbody>
		<tr>
			<td colspan="4" rowspan="1">
				<strong>Packages Benefits</strong> 
			</td>
		
		</tr>
		<tr>
			<td>
				<strong>Package Name</strong>
			</td>
			<td>
				<strong>Package Returns %</strong>
			</td>
			<td>
				<strong>Upto Months</strong>
			</td>
			
		</tr>
		<tr>
			<td>
				<strong>APPRENTICE</strong>
			</td>
			<td>
				<strong>10 %</strong>
			</td>
			<td>
				<strong>30 Months</strong>
			</td>
		
		</tr>
	</tbody>
</table>

<p>
	&nbsp;
</p>

                            </div>
                                               
                                           </div>
                                           
                                       </div>
                                       
                                   </div> 
                                    
                                </div>
                            </div> 
                            
                              <div class="mb-3" id="ben3" style="display:none;">
                            
                                <div>
                                    
                                 
                                  
                                   <div class="container">
                                       <div class="row">
                                         <div class="col-md-6">
                                               <div style="background: silver;">
                                
                               <table border="1" cellpadding="1" cellspacing="1" style="width:100%;text-align: center;font-size: 14px;">
	<tbody>
		<tr>
			<td colspan="4" rowspan="1">
				<strong>Packages Benefits</strong> 
			</td>
		
		</tr>
		<tr>
			<td>
				<strong>Package Name</strong>
			</td>
			<td>
				<strong>Package Returns %</strong>
			</td>
			<td>
				<strong>Upto Months</strong>
			</td>
			
		</tr>
		<tr>
			<td>
				<strong>VETERAN</strong>
			</td>
			<td>
				<strong>12 %</strong>
			</td>
			<td>
				<strong>30 Months</strong>
			</td>
		
		</tr>
	</tbody>
</table>

<p>
	&nbsp;
</p>

                            </div>
                                               
                                           </div>
                                           
                                       </div>
                                       
                                   </div> 
                                    
                                </div>
                            </div> 
                              <?php } ?>
                                 
   <?php } ?>
   
                <div class="mb-3" id="inputBox" style="display: none;">
                <label class="mb-1"><strong>Deposit USDT</strong></label>
                <input  placeholder="Deposit USDT" id="package_price" name="package_price"  class="form-control" type="number" >
                </div> 
                          
                             <?php if(false){ ?>  
             
                         
                            <div class="mb-3">
                            <label class="mb-1"><strong>Deposit Value</strong></label>
                                <input  placeholder="Deposit Value" id="package_price" name="package_price"  class="form-control" type="number" required>
                            </div> 
                         <?php } ?> 
      
     
 </div>
 
    <div class="modal-footer"> 
    
        <?php if($model->getValue("member_activation_on_off")=='Y' or   $sts =='N'){ ?>
     
        
                <input type="hidden" name="upgradeMemberShip" value="1" />
                
                 <input type="hidden" name="topup" value="topup" />
        
                               
                                <button type="submit" name="buttonRequest" class="btn btn-primary mr-2">
                                    <i class="ace-icon fa fa-cloud-upload icon-on-right"></i>Upgrade
                                </button>
                           
                            <?php }?> 
  </div>

          </form>
    

</div>
</div>
</div>
	
	                 <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel"> Withdrawal Now From  Income or Direct-wallet <br><br>
                                </h5> 
                                
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                
                              </div>
                              
                            <!--<form action="#" method="post">-->
                              <form action="<?php echo BASE_PATH;?>userpanel/ewallet/maindrawalManual" method="post">
        <div class="modal-body">

  <?php
   $rand=rand();
  $this->session->set_userdata("rand",$rand);
  ?>
  <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
     <select name="wallettype" id="wallettype" class="  form-control wide" required="" onchange="getbenefits(this.value);">
                                
                                <option value="1">From Income Wallet</option>
                                <option value="2">From Direct Wallet</option>
                                
                                
                                </select>
  
                	<?php if(true){ ?>
   <div class="mb-3" style="display:block;">
                    <label class="mb-1"><strong>USDT </strong></label>
                    <input class="form-control" required="" id="inr"  name="amount1"  placeholder="Please enter Amount" data-toggle="tooltip" title="Please enter  USDT" type="number">
                </div> 
                <?php } ?>
   <div class="mb-3">
                    <label class="mb-1"><strong>Password </strong></label>
                    <input class="form-control" required="" id="trns_password" name="trns_password" placeholder="Password" data-toggle="tooltip" title="Please enter Password" type="password">
                </div>      
  
            
  
     
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
                     <div class="modal fade" id="exampleModal31">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                   <h5 class="modal-title" id="exampleModalLabel"> All Activation Details</h5>
                                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                              <div class="modal-body">
 
    <div class="table-responsive" style="width: 100%;overflow: auto;">
          <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;box-shadow: 0 0 4px #c0baba;">
                            <thead >
                                 <tr>
                                    <th scope="col" style="width: 100px;">#Sn</th>
                                   
                                    <th scope="col" style="width: 100px;">Amount</th> 
                                      
                                    <th scope="col" style="width: 100px;">Date</th>
                                   
                                   </tr>
                            </thead>
                            <tbody style="overflow:scroll">
                          
                                <?php 
                              
                                if(count($activation) > 0 ){
                                    $i=1;$TotalPackages=0;
                                    foreach($activation as $r) { 
                                        $TotalPackages += $r['prod_pv'];
                                       if($r['retopup']=='Y'){
                                           
                                          $statusss='Retop-up';
                                       }
                                        elseif($r['pool']=='Y'){
                                           
                                          $statusss='Pool';
                                       }else{
                                           $statusss='Upgrade'; 
                                       }
                                       
                                       if($r['x_rank']==600){
                                           
                                           $x_rank='3 X';
                                       }
                                       
                                        if($r['x_rank']==400){
                                           
                                           $x_rank='4 X';
                                       }
                                        if($r['x_rank']==500){
                                           
                                           $x_rank='5 X';
                                       }
                                        if($r['x_rank']==600){
                                           
                                           $x_rank='6 X';
                                       }
                                        if($r['x_rank']==700){
                                           
                                           $x_rank='7 X';
                                       }
                                        if($r['x_rank']==800){
                                           
                                           $x_rank='8 X';
                                       }
                                        if($r['x_rank']==900){
                                           
                                           $x_rank='9 X';
                                       }
                                       
                                        if($r['x_rank']==1000){
                                           
                                           $x_rank='10 X';
                                       }
                                       
                                       
                                       
                                       
                                       
                                       
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                     <td><?php echo CURRENCY; ?> <?php echo number_format($r['prod_pv']);?></td> 
                                      
                                  
                                    <td><?php echo date('d-M-Y',strtotime($r['date_from']));?></td>
                                    
                                </tr>
                                <?php  $i++; } ?>
                                
                                 <tr>
                                    <th colspan="1" class="text-center text-info">Total  </th>
                                   <th  class="text-left text-info" style="text-align: left;font-size: 12px;"><?php echo CURRENCY; ?> <?php echo number_format($TotalPackages,2);?>  </th>
                                  
                                </tr>
                                
                                <?php } else{ ?>
                                <tr>
                                    <td colspan="2" class="text-center text-danger">No Data found !</td>
                                   
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
        
        
        
                      
                    </div>   
     
 </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    
 <script>
          
                var total = Number(<?php echo $StakingPoint +$_pre_figur;?>);
                // parseFloat(total.toFixed(6))
                var x = setInterval(function() {
                
                
                
                total = parseFloat((total + <?php echo $_1_second;?>).toFixed(8));
                //  alert(total);
               // document.getElementById("dayaa").innerHTML =" ₹  " +total ; 
                
                if ( total <= 0) {
                clearInterval(x);
                }
                }, 100 );
                
                
                
         
 
              </script>       

                  
    <?php    $totalpackageamount = $model->getTotalMemberShipValue($member_id);  // Get Total Package Amount 
            
            if($totalpackageamount >= 10 and $totalpackageamount <= 109 ){
                                $lasttypeid=1;
                              
                            }if($totalpackageamount >= 110 and $totalpackageamount <= 509 ){
                             $lasttypeid=2;
                            
                            }if($totalpackageamount >= 510 and $totalpackageamount <= 1009 ){
                           
                             $lasttypeid=3;
                            }if($totalpackageamount >= 1010 and $totalpackageamount <= 5009 ){
                             
                             $lasttypeid=4;
                            }if($totalpackageamount >= 5010  ){
                          
                             $lasttypeid=5;
                            }
            
            
            
            
            
            
            
            
            
            
            
            ?>                        
                    
      <script>
          
                var total = Number(<?php echo $StakingPoint +$_pre_figur;?>);
                // parseFloat(total.toFixed(6))
                var x = setInterval(function() {
                
                
                
                total = parseFloat((total + <?php echo $_1_second;?>).toFixed(8));
                //  alert(total);
              //  document.getElementById("dayaa").innerHTML =" ₹  " +total ; 
                
                if ( total <= 0) {
                clearInterval(x);
                }
                }, 100 );
                
                
                
         
 
              </script>                     
<script>
 function mainsetusd()
     {
       
           
            <?php  //$lasttypeid = $model->getLastMemberpackagetypeid($member_id); ?>
             var val1 = 1;
             
                var amount1 = document.getElementById("amount1").value;
              if(val1 == 1)
            {
        var drawamount1 = amount1*50/100;
        var stacking1 = amount1*30/100;
        var liquidity1 = amount1*20/100;
        
        document.getElementById("inr1").value =drawamount1;
        document.getElementById("stacking1").value =stacking1;
        document.getElementById("liquidity1").value =liquidity1;

             
             
            }
            if(val1 ==2)
            {
              var drawamount1 = amount1*55/100;
        var stacking1 = amount1*25/100;
        var liquidity1 = amount1*20/100;
        
        document.getElementById("inr1").value =drawamount1;
        document.getElementById("stacking1").value =stacking1;
        document.getElementById("liquidity1").value =liquidity1;
  
            }
            if(val1 ==3)
            {
             var drawamount1 = amount1*60/100;
        var stacking1 = amount1*20/100;
        var liquidity1 = amount1*20/100;
        
        document.getElementById("inr1").value =drawamount1;
        document.getElementById("stacking1").value =stacking1;
        document.getElementById("liquidity1").value =liquidity1;
  
            }
            if(val1 ==4)
            {
             var drawamount1 = amount1*65/100;
        var stacking1 = amount1*15/100;
        var liquidity1 = amount1*20/100;
        
        document.getElementById("inr1").value =drawamount1;
        document.getElementById("stacking1").value =stacking1;
        document.getElementById("liquidity1").value =liquidity1;

            }
            if(val1 ==5)
            {
              var drawamount1 = amount1*70/100;
        var stacking1 = amount1*10/100;
        var liquidity1 = amount1*20/100;
        
        document.getElementById("inr1").value =drawamount1;
        document.getElementById("stacking1").value =stacking1;
        document.getElementById("liquidity1").value =liquidity1;

            }
            
           
      
                          
     }
 function check_member(id)
{
//alert(id);
      jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "user/check_user",
data: {mem: id},
success: function(res) {
    //alert(res);
document.getElementById('user_name').value=res;

}
});
}
       function copylinkuserid()
        {
            var link = $("#cpluserid").val();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            console.log("Copied the text:", tempInput.value);
            alert('User ID Copied', 'success');
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
            console.log(" Referral Link Copied the text:", tempInput.value);
            alert(' Referral Link Copied', 'success');
            document.body.removeChild(tempInput); 
            
            
            
            
            
            
            
            
            
            
            
            
        }
</script>
            
   <script>
  function checkValue() {
    const selectedValue = document.getElementById("type_id").value;
    const inputBox = document.getElementById("inputBox");

    if (selectedValue === "3") {
      inputBox.style.display = "block";
    } else {
      inputBox.style.display = "none";
    }
  }
</script>                                 
 
<?php

   $this->load->view(MEMBER_FOLDER.'/layout/footer'); 


?>


