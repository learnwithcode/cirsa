<?php 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cronsecure extends CI_Controller {
	 public function __construct() {
        parent::__construct();
    }
    
    
    //wget -O /dev/null 
    
    
    
    
    
    
    // UPDATE `tbl_members` SET `left_pv` = '0', `right_pv` = '0', `team_bv` = '0', `self_bv` = '0', `direct_bv` = '0' WHERE 1
// TRUNCATE `tbl_cmsn_daily`;
// TRUNCATE `tbl_cmsn_direct`;
// TRUNCATE `tbl_cmsn_level`;
// TRUNCATE `tbl_cmsn_mstr`;
// TRUNCATE `tbl_process`;
// TRUNCATE `tbl_process_master`;
// DELETE FROM `tbl_wallet_trns` WHERE `trns_for`='INCOME'
// INSERT INTO `tbl_process` (`process_id`, `start_date`, `end_date`, `pair_sts`, `date_time`) VALUES (NULL, '2022-11-19 00:00:00', '2022-11-19 00:00:00', 'N', '2022-11-19 20:30:02');
// INSERT INTO `tbl_process_master` (`process_id`, `start_date`, `end_date`, `pair_sts`, `date_time`) VALUES (NULL, '2022-11-19 00:00:00', '2022-11-19 00:00:00', 'N', '2022-11-19 20:30:02');
// https://profitplustech.io/plustechcronsecure/setuppayouts
// https://stageonerealstate.com/newplan/cronsecure/dailyreturncronsecure
// https://stageonerealstate.com/newplan/cronsecure/verifyhexaaddressbusdt
// https://stageonerealstate.com/newplan/cronsecure/transfergasfee
// https://stageonerealstate.com/newplan/cronsecure/transfertohotwalletbusdt
// https://stageonerealstate.com/newplan/cronsecure/transfergasfee
// https://stageonerealstate.com/newplan/cronsecure/updatedirectlevelbusines
// https://stageonerealstate.com/newplan/cronsecure/setuppayouts
// https://stageonerealstate.com/newplan/cronsecure/directcommissionsairdrop
// https://stageonerealstate.com/newplan/cronsecure/royaltyOnCTO
// https://stageonerealstate.com/newplan/cronsecure/lifetimerewards
// https://stageonerealstate.com/newplan/cronsecure/infinityvaultfund
// https://stageonerealstate.com/newplan/cronsecure/retopuppoolmanualllll
// https://stageonerealstate.com/newplan/cronsecure/subcriptionsss
// https://stageonerealstate.com/newplan/cronsecure/makewithdrawtest
// https://stageonerealstate.com/newplan/cronsecure/royaltyrank

// https://stageonerealstate.com/newplan/cronsecure/setMembersretopup



  public function getbalancecehck() {
	    
		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess(2);
		$process_id = $AR_PRSS['process_id'];
	
	 
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
        // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"directcommission"));   
		if(true){
	  	   //   $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,mem.sponsor_id,mem.member_id as from_member_id,mem.user_id  FROM `tbl_members` as mem LEFT JOIN tbl_subscription as tbl on mem.member_id=tbl.member_id   WHERE mem.member_id in (Select member_id from tbl_subscription where Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."' ) and tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)  and mem.sponsor_id in (Select member_id from tbl_subscription ) order by mem.member_id asc";
		
		
		  // $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,tbl.member_id as from_member_id   FROM  tbl_subscription as tbl   WHERE Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."'  and    tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)   order by tbl.subcription_id asc";
		   $QR_MEM = "SELECT member_id,sum(trns_amount) as total  FROM  tbl_wallet_trns    WHERE trns_for='DCA' group by member_id";
		
		
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
            $trns_date = date('Y-m-d H:i:s');
            $trans_no = UniqueId("TRNS_NO");
			foreach($RS_MEM as $AR_MEM){
			   
			     $member_id = $AR_MEM['member_id']; 
			      $total = $AR_MEM['total']; 
			      	$LDGR = $model->getCurrentBalance($member_id,1,"","");
			      
			      if($LDGR['net_balance']>0){
			       PrintR($AR_MEM);
			      
			    	$trns_remark = "Direct Referral to Airdop Fron Own ID";
			    		$trns_remark = "Received From Direct Referral";
				$model->wallet_transaction(1,"Dr",$member_id,$total,$trns_remark,$trns_date,$trans_no,"1","DCADEBIT");
             
                $model->wallet_transaction('4',"Cr",$member_id,$total,'Direct Referral to Airdop',date('Y-m-d'),rand(),1,"DCATOAIR");   
			      
			      
			      
			      }    
	
			}
		   
		 

		}
	    // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"directcommission"));  
	  //  echo " Done directcommission";	 
	 
	  
	} 

 public function setupLevelbusinessdaily()               {
       	$model = new OperationModel();
       	
       	
       for($k = 1;$k <= 116;$k++)  {  	
       	
       	
       	
       	
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess($k);
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
		  //$today_date = InsertDate(getLocalTime());
              //  $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
                $QR_MEM = "select subcription_id,member_id,prod_pv from tbl_subscription where date_from  ='$end_date'  and isSetPV_N ='N' ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
           //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			    
			    $subcription_id = $AR_MEM['subcription_id'];
			    $member_id      = $AR_MEM['member_id'];
			    $prod_pv        = $AR_MEM['prod_pv'];
			    $memberList = $model->memberParentLevelLists($member_id);
			    echo "<br>".$subcription_id.'-------'.date('H:i:s');
			    if(count($memberList) > 0 )
			    {
			      $i =0;
			      $open = 'Y';
			      foreach($memberList as $list)
			      {
                        $member_id       = $list['member_id'];
                       
                        $sponsor_id      = $list['sponsor_id'];
                            if($i > 0 )
                            {
                                
                         
                                
                                
                             
                                    $data_direct =array(
                	 
                	 "team_bv" => team_bv+$prod_pv,
                	 "self_bv" => 0,
                	 "direct_bv" => 0,
                	 "member_id" => $member_id,
                	  "date_time" => $end_date
                 );
	
	 
		  	$this->SqlModel->insertRecord(prefix."tbl_team_business_daily",$data_direct);   
                                
                            }
                            else
                            {
                             
                                    $data_direct =array(
                	
                	 "team_bv" => 0,
                	 "self_bv" => self_bv+$prod_pv,
                	 "direct_bv" => 0,
                	 "member_id" => $member_id,
                	  "date_time" => $end_date
                 );
	
	
	
	 
		  	$this->SqlModel->insertRecord(prefix."tbl_team_business_daily",$data_direct);   
                                 
                            }
                            
                            if($i ==1)
                            {
                                
                                    $data_direct =array(
                	
                	 "team_bv" => 0,
                	 "self_bv" => 0,
                	 "direct_bv" => direct_bv+$prod_pv,
                	 "member_id" => $member_id,
                	  "date_time" => $end_date
                 );
	
	
	
	 
		  	$this->SqlModel->insertRecord(prefix."tbl_team_business_daily",$data_direct);   
                                
                            }
                          
                     
                        
                       
                        $i++;
			      }
			    }
			    $this->SqlModel->updateRecord("tbl_subscription", array("isSetPV_N" => "Y") ,array("subcription_id"=>$subcription_id));
			    
            
			    
			    
			}
		  //$this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
		  
 }
    }








   public function testtttsfgdfgdgdetupLevelbusiness()               {
       	$model = new OperationModel();
       	
       for($k = 1;$k <= 110;$k++)  {	
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess($k);
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
              //  $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
                $QR_MEM = "select subcription_id,member_id,prod_pv from tbl_subscription where date_from  <='$end_date'  and isSetPV ='N'"; 
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
           //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			   
			    $subcription_id = $AR_MEM['subcription_id'];
			    $member_id      = $AR_MEM['member_id'];
			    $prod_pv        = $AR_MEM['prod_pv'];
			    
			      $memberdetail   = $model->getMemberdetail($member_id);
	$plan=	$memberdetail['plan'];
			    
	if($plan=='A'){
	    
	    	    $memberList = $model->memberParentLevelLists($member_id);
			    echo "<br>".$subcription_id.'-------'.date('H:i:s');
			    if(count($memberList) > 0 )
			    {
			      $i =0;
			      $open = 'Y';
			      foreach($memberList as $list)
			      {
                        $member_id       = $list['member_id'];
                        $sponsor_id      = $list['sponsor_id'];
                            if($i > 0 )
                            {
                              $this->db->query("UPDATE `tbl_members` SET `team_bv` = team_bv+$prod_pv  WHERE member_id ='$member_id';");
                            }
                            else
                            {
                              $this->db->query("UPDATE `tbl_members` SET `self_bv` = self_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                            
                            if($i ==1)
                            {
                                 $this->db->query("UPDATE `tbl_members` SET `direct_bv` = direct_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                          
                     
                        
                       
                        $i++;
			      }
			    }
			    $this->SqlModel->updateRecord("tbl_subscription", array("isSetPV" => "Y") ,array("subcription_id"=>$subcription_id));
			    
            
	    
	}	    
			    
			    
			    
			    
			    
			    
			    
			    
			    
			    
		
			    
			    
			}
			
      }
		  //$this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
    } 
    
    



 public function updateddirectcommissiondddddddd(){
	    
		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
	    
	     for($k = 1;$k <= 99;$k++) {
	    
		$AR_PRSS = $model->getProcess($k);
		$process_id = $AR_PRSS['process_id'];
	
	 
		$start_date=$AR_PRSS['start_date'];
	echo	$end_date=$AR_PRSS['end_date'];
         
		if($process_id>0){
	  	   //   $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,mem.sponsor_id,mem.member_id as from_member_id,mem.user_id  FROM `tbl_members` as mem LEFT JOIN tbl_subscription as tbl on mem.member_id=tbl.member_id   WHERE mem.member_id in (Select member_id from tbl_subscription where Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."' ) and tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)  and mem.sponsor_id in (Select member_id from tbl_subscription ) order by mem.member_id asc";
		
		
		  // $QR_MEM = "SELECT * FROM `tbl_cmsn_direct` as sb ORDER BY `sb`.`process_id` ASC; ";
		  //  $QR_MEM = "SELECT * FROM `tbl_cmsn_reward` as sb ORDER BY `sb`.`process_id` ASC; ";
		    $QR_MEM = "SELECT * FROM `tbl_cmsn_reward_2` as sb ORDER BY `sb`.`process_id` ASC; ";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	  
			foreach($RS_MEM as $AR_MEM):
			   
			  
	$data = array(
					  
						"process_id"=>$process_id,
						 
					
					);			
    	
    	// $this->SqlModel->insertRecord(prefix."tbl_cmsn_direct_test",$data);
    if($end_date==$AR_MEM['date_time']){
        
          PrintR($AR_MEM['date_time']);
        
//	$this->SqlModel->updateRecord(prefix."tbl_cmsn_direct",$data,array("date_time"=>$end_date)); 
	//	$this->SqlModel->updateRecord(prefix."tbl_cmsn_direct",$data,array("date_time"=>$end_date)); 
			$this->SqlModel->updateRecord(prefix."tbl_cmsn_reward_2",$data,array("date_time"=>$end_date)); 
    
    }
		    endforeach;
		   
		 

		}
	
	     } 	 
	 
	  
	}
public function updatedtotalincome()   {
$model = new OperationModel();
$AR_PRSS = $model->getProcessMaster();
$process_id = $AR_PRSS['process_id']; 
$start_date=$AR_PRSS['start_date'];
$end_date=$AR_PRSS['end_date'];   
// $QR_MEM = "SELECT tm.member_id, (b.net_cmsn) as binaryIncome ,  SUM(d.net_income) as directIncome, (d1.net_income) as rankIncome ,  (d2.net_income) as quickRank FROM tbl_members AS tm LEFT JOIN tbl_cmsn_binary as b on tm.member_id = b.member_id and b.process_id ='$process_id' LEFT JOIN tbl_cmsn_direct as d on tm.member_id = d.member_id and d.process_id ='$process_id' LEFT JOIN tbl_cmsn_daily as d1 on tm.member_id = d1.member_id and d1.process_id ='$process_id' LEFT JOIN tbl_cmsn_quick as d2 on tm.member_id = d2.member_id and d2.process_id ='$process_id' where   tm.subcription_id > 0 GROUP BY tm.member_id ORDER BY tm.member_id ASC";
echo  $QR_MEM = "SELECT tm.member_id ,sum(tm.trns_amount) as total FROM tbl_wallet_trns AS tm WHERE tm.trns_for ='INCOME' and `trns_date` <='2024-09-26 00:00:00'  GROUP BY tm.member_id ORDER BY tm.member_id ASC;";
$RS_MEM = $this->SqlModel->runQuery($QR_MEM);
$trns_remark = "Commission Credited";
ob_start(); 
//PrintR($RS_MEM);die;
foreach($RS_MEM as $AR_MEM){
PrintR($AR_MEM);
$member_id = $AR_MEM['member_id'];
$trns_amount= $AR_MEM['total'];
$total_withdrawal   = $model->getMemberWithdrawal($member_id); 

//$this->db->query("UPDATE `tbl_members` SET `total_income_new` =  total_income_new+$trns_amount     WHERE member_id ='$member_id';");  
$this->db->query("UPDATE `tbl_members` SET `total_income` =  total_income+$trns_amount     WHERE member_id ='$member_id';");         



} 







} 



   public function makewithdrawtesttttttttttttt() {
       
       
    //   die;
    
    $t=date('d-m-Y');
   $day = date("d",strtotime($t));  
//	PrintR($day);die;
//	if($day == 10 || $day == 20 || $day == 30) {
	 if(true) {   
        $model = new OperationModel();
        $trns_date = date('Y-m-d');//InsertDate(getLocalTime());
        
         $trns_date =  InsertDate(AddToDate($trns_date,"-1 Day"));  
 

      $QR_MEM = "SELECT tn.bank_name,tn.account_number,tn.ifc_code,tn.user_id,tn.member_id FROM `tbl_members` as tn  where 1";
		$RS_MSTR  = $this->SqlModel->runQuery($QR_MEM);
	 
		foreach($RS_MSTR as $AR_RES):
		    
		  //  PRintR($AR_RES); die;
		    $member_id = $AR_RES['member_id'];
		    //	$exist = $model->checkBanckDetail($member_id);
		     
                $bank_name      = $AR_RES['bank_name'];
                $account_number = $AR_RES['account_number'];
                $ifc_code       = $AR_RES['ifc_code'];
                //$bank_name !='' and $account_number !='' and $ifc_code !=''
			 if(true){ 	 
			$bank_name = FCrtRplc($AR_RES['bank_name']);
			$bank_branch = FCrtRplc($AR_RES['bank_address']);
			$bank_city = FCrtRplc($AR_RES['bank_city']);
			$bank_state = FCrtRplc($AR_RES['bank_state']);
			$bank_country = FCrtRplc($AR_RES['bank_country']);
			
			$account_no = FCrtRplc($AR_RES['account_number']);
		    $walletd_id  = 1;
		    $LDGR = $model->getCurrentBalance($member_id,$walletd_id,'2024-08-16','2024-08-31');
		    
		     $AR_SUB = $model->getCurrentMemberShip($AR_RES['member_id']);
		    
		    
		   // if($AR_SUB['roi_stacking']=='R') {
		    
	    	if($LDGR['net_balance']>=500)
            {
                if(true){
                //  if($AR_RES['total'] <=$LDGR['net_balance']){
                if($bank_name!=''){
                
		    $net_amt =   $AR_RES['total'];
		 	$trans_no = UniqueId("TRNS_NO");
            $admin_charge = $net_amt *10/100;
            $trns_amount = $net_amt - $admin_charge;
			$sdfsdfsdf=$LDGR['net_balance'];
			        		 $data[] = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$walletd_id,
									"initial_amount"=>$net_amt,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>0,
									"process_fee"=>$sdfsdfsdf,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"MANUAL",
									"processor_id"=>0,
									"btc_address"=>" ",
									"pm_account"=>" ",
									"pm_account_type"=>" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>" ",
									"bank_zip_code"=>" ",
									"trns_remark"=>"Withdrawal  Request from ".$AR_RES['user_id'],
								);
								
                    $userid =$AR_RES['user_id'];
                   // $transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
                    $trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
                  //  $model->wallet_transaction('1',"Dr",$member_id,$net_amt,$trns_remark,$trns_date,$trans_no,"1","WITHDRAW");
                  
                
                  	$data_with[] = array("wallet_id"=>$walletd_id,
			"trns_type"=>"Dr",
			"member_id"=>($member_id>0)? $member_id:0,
			"trns_amount"=>$net_amt,
			"trns_remark"=>($trns_remark)? $trns_remark:' ',
			"isActive"=> 1,
			"trans_ref_no"=>($trans_no)? $trans_no:$member_id,
			"trns_for"=>"WITHDRAW",
			"trns_date"=>$trns_date,
		//	"date_time"=>$trns_date
		);
	
	 
		//	$this->SqlModel->insertRecord(prefix."tbl_wallet_trns",$data);
		
                  }
            }
            }
			// }
			 }
		endforeach;
		PrintR($data);
        	  //$this->SqlModel->batchInsert(prefix."tbl_fund_transfer",$data);
        	 //	$this->SqlModel->batchInsert(prefix."tbl_wallet_trns",$data_with);
        	  
echo "Withdrawl has been Done..";

} 
else{echo "not done";}
							
    } 
   public function makewithdrawtessdfasdfasdft() {
       
       
    //   die;
    
    $t=date('d-m-Y');
   $day = date("d",strtotime($t));  
//	PrintR($day);die;
//	if($day == 10 || $day == 20 || $day == 30) {
	 if(true) {   
        $model = new OperationModel();
        $trns_date = date('Y-m-d');//InsertDate(getLocalTime());
        
         $trns_date =  InsertDate(AddToDate($trns_date,"-1 Day"));  
 
   //  $QR_MEM = "SELECT  tm.user_id , tm.member_id,tm.bank_name,tm.account_number,tm.ifc_code,tm.user_id,oldm.member_id FROM ".prefix."tbl_members AS tm   where     tm.user_id in (Select member_id from oldincome as oldm )  ORDER BY tm.member_id ASC";
	
	//$QR_MEM = "SELECT sum(tm.`payableamount`) as total,tn.bank_name,tn.account_number,tn.ifc_code,tn.user_id,tn.member_id FROM `oldincome` as tm left join tbl_members as tn on tn.user_id= tm.member_id where tn.subcription_id >0  GROUP by tm.member_id; ";
	
	// $QR_MEM = "SELECT sum(tm.`trns_amount`) as total,tn.bank_name,tn.account_number,tn.ifc_code,tn.user_id,tm.member_id FROM `tbl_wallet_trns` as tm left join tbl_members as tn on tn.member_id= tm.member_id where Date(`trns_date`) BETWEEN '2024-01-21' AND '2024-08-15' and tm.trns_type ='Cr' GROUP by tm.member_id; ";
	
	
      $QR_MEM = "SELECT sum(tm.`trns_amount`) as total,tn.bank_name,tn.account_number,tn.ifc_code,tn.user_id,tm.member_id FROM `tbl_wallet_trns` as tm left join tbl_members as tn on tn.member_id= tm.member_id where Date(tm.`trns_date`) BETWEEN '2024-08-16' AND '2024-08-31'  GROUP by tm.member_id; ";
		$RS_MSTR  = $this->SqlModel->runQuery($QR_MEM);
	 
		foreach($RS_MSTR as $AR_RES):
		    
		  //  PRintR($AR_RES); die;
		    $member_id = $AR_RES['member_id'];
		    //	$exist = $model->checkBanckDetail($member_id);
		     
                $bank_name      = $AR_RES['bank_name'];
                $account_number = $AR_RES['account_number'];
                $ifc_code       = $AR_RES['ifc_code'];
                //$bank_name !='' and $account_number !='' and $ifc_code !=''
			 if(true){ 	 
			$bank_name = FCrtRplc($AR_RES['bank_name']);
			$bank_branch = FCrtRplc($AR_RES['bank_address']);
			$bank_city = FCrtRplc($AR_RES['bank_city']);
			$bank_state = FCrtRplc($AR_RES['bank_state']);
			$bank_country = FCrtRplc($AR_RES['bank_country']);
			
			$account_no = FCrtRplc($AR_RES['account_number']);
		    $walletd_id  = 1;
		    $LDGR = $model->getCurrentBalance($member_id,$walletd_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
		    
		     $AR_SUB = $model->getCurrentMemberShip($AR_RES['member_id']);
		    
		    
		   // if($AR_SUB['roi_stacking']=='R') {
		    
	    	if($AR_RES['total']>=500)
            {
              //  if(true){
                 if($AR_RES['total'] <=$LDGR['net_balance']){
                if(true){
                
		    $net_amt =   $AR_RES['total'];
		 	$trans_no = UniqueId("TRNS_NO");
            $admin_charge = $net_amt *10/100;
            $trns_amount = $net_amt - $admin_charge;
			$sdfsdfsdf=$LDGR['net_balance'];
			        		 $data[] = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$walletd_id,
									"initial_amount"=>$net_amt,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>0,
									"process_fee"=>$sdfsdfsdf,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"MANUAL",
									"processor_id"=>0,
									"btc_address"=>" ",
									"pm_account"=>" ",
									"pm_account_type"=>" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>" ",
									"bank_zip_code"=>" ",
									"trns_remark"=>"Withdrawal  Request from ".$AR_RES['user_id'],
								);
								
                    $userid =$AR_RES['user_id'];
                   // $transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
                    $trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
                  //  $model->wallet_transaction('1',"Dr",$member_id,$net_amt,$trns_remark,$trns_date,$trans_no,"1","WITHDRAW");
                  
                
                  	$data_with[] = array("wallet_id"=>$walletd_id,
			"trns_type"=>"Dr",
			"member_id"=>($member_id>0)? $member_id:0,
			"trns_amount"=>$net_amt,
			"trns_remark"=>($trns_remark)? $trns_remark:' ',
			"isActive"=> 1,
			"trans_ref_no"=>($trans_no)? $trans_no:$member_id,
			"trns_for"=>"WITHDRAW",
			"trns_date"=>$trns_date,
		//	"date_time"=>$trns_date
		);
	
	 
		//	$this->SqlModel->insertRecord(prefix."tbl_wallet_trns",$data);
		
                  }
            }
            }
			// }
			 }
		endforeach;
		PrintR($data);
        	  //$this->SqlModel->batchInsert(prefix."tbl_fund_transfer",$data);
        	 //	$this->SqlModel->batchInsert(prefix."tbl_wallet_trns",$data_with);
        	  
echo "Withdrawl has been Done..";

} 
else{echo "not done";}
							
    } 
   public function makewithdrawtest() {
       
       
    //   die;
    
    $t=date('d-m-Y');
   $day = date("d",strtotime($t));  
//	PrintR($day);die;
//	if($day == 10 || $day == 20 || $day == 30) {
	 if(true) {   
        $model = new OperationModel();
        $trns_date = date('Y-m-d');//InsertDate(getLocalTime());
        
         $trns_date =  InsertDate(AddToDate($trns_date,"-1 Day"));  
 
   //  $QR_MEM = "SELECT  tm.user_id , tm.member_id,tm.bank_name,tm.account_number,tm.ifc_code,tm.user_id,oldm.member_id FROM ".prefix."tbl_members AS tm   where     tm.user_id in (Select member_id from oldincome as oldm )  ORDER BY tm.member_id ASC";
	
	//$QR_MEM = "SELECT sum(tm.`payableamount`) as total,tn.bank_name,tn.account_number,tn.ifc_code,tn.user_id,tn.member_id FROM `oldincome` as tm left join tbl_members as tn on tn.user_id= tm.member_id where tn.subcription_id >0  GROUP by tm.member_id; ";
	
	// $QR_MEM = "SELECT sum(tm.`trns_amount`) as total,tn.bank_name,tn.account_number,tn.ifc_code,tn.user_id,tm.member_id FROM `tbl_wallet_trns` as tm left join tbl_members as tn on tn.member_id= tm.member_id where Date(`trns_date`) BETWEEN '2024-01-21' AND '2024-08-15' and tm.trns_type ='Cr' GROUP by tm.member_id; ";
	
	
      $QR_MEM = "SELECT sum(tm.`trns_amount`) as total,tn.bank_name,tn.account_number,tn.ifc_code,tn.user_id,tm.member_id FROM `tbl_wallet_trns` as tm left join tbl_members as tn on tn.member_id= tm.member_id where Date(tm.`trns_date`) BETWEEN '2024-07-21' AND '2024-08-15'  GROUP by tm.member_id; ";
		$RS_MSTR  = $this->SqlModel->runQuery($QR_MEM);
	 
		foreach($RS_MSTR as $AR_RES):
		    
		  //  PRintR($AR_RES); die;
		    $member_id = $AR_RES['member_id'];
		    //	$exist = $model->checkBanckDetail($member_id);
		     
                $bank_name      = $AR_RES['bank_name'];
                $account_number = $AR_RES['account_number'];
                $ifc_code       = $AR_RES['ifc_code'];
                //$bank_name !='' and $account_number !='' and $ifc_code !=''
			 if(true){ 	 
			$bank_name = FCrtRplc($AR_RES['bank_name']);
			$bank_branch = FCrtRplc($AR_RES['bank_address']);
			$bank_city = FCrtRplc($AR_RES['bank_city']);
			$bank_state = FCrtRplc($AR_RES['bank_state']);
			$bank_country = FCrtRplc($AR_RES['bank_country']);
			
			$account_no = FCrtRplc($AR_RES['account_number']);
		    $walletd_id  = 1;
		    $LDGR = $model->getCurrentBalance($member_id,$walletd_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
		    
		     $AR_SUB = $model->getCurrentMemberShip($AR_RES['member_id']);
		    
		    
		   // if($AR_SUB['roi_stacking']=='R') {
		    
	    	if($AR_RES['total']>=500)
            {
                if(true){
                //  if($AR_RES['total'] <=$LDGR['net_balance']){
                if(true){
                
		    $net_amt =   $AR_RES['total'];
		 	$trans_no = UniqueId("TRNS_NO");
            $admin_charge = $net_amt *10/100;
            $trns_amount = $net_amt - $admin_charge;
			$sdfsdfsdf=$LDGR['net_balance'];
			        		 $data[] = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$walletd_id,
									"initial_amount"=>$net_amt,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>0,
									"process_fee"=>$sdfsdfsdf,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"MANUAL",
									"processor_id"=>0,
									"btc_address"=>" ",
									"pm_account"=>" ",
									"pm_account_type"=>" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>" ",
									"bank_zip_code"=>" ",
									"trns_remark"=>"Withdrawal  Request from ".$AR_RES['user_id'],
								);
								
                    $userid =$AR_RES['user_id'];
                   // $transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
                    $trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
                  //  $model->wallet_transaction('1',"Dr",$member_id,$net_amt,$trns_remark,$trns_date,$trans_no,"1","WITHDRAW");
                  
                
                  	$data_with[] = array("wallet_id"=>$walletd_id,
			"trns_type"=>"Dr",
			"member_id"=>($member_id>0)? $member_id:0,
			"trns_amount"=>$net_amt,
			"trns_remark"=>($trns_remark)? $trns_remark:' ',
			"isActive"=> 1,
			"trans_ref_no"=>($trans_no)? $trans_no:$member_id,
			"trns_for"=>"WITHDRAW",
			"trns_date"=>$trns_date,
		//	"date_time"=>$trns_date
		);
	
	 
		//	$this->SqlModel->insertRecord(prefix."tbl_wallet_trns",$data);
		
                  }
            }
            }
			// }
			 }
		endforeach;
		PrintR($data);
        	  //$this->SqlModel->batchInsert(prefix."tbl_fund_transfer",$data);
        	 //	$this->SqlModel->batchInsert(prefix."tbl_wallet_trns",$data_with);
        	  
echo "Withdrawl has been Done..";

} 
else{echo "not done";}
							
    } 
 public function updatepassword()
	{
	    		$model = new OperationModel();
	    			$time_stamp = getLocalTime();
		$today_date = InsertDate($time_stamp);
	    	

						
			//	die;					
            $today_date =$today_date = date('Y-m-d');//InsertDate(getLocalTime());
            $date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
            
             $QR_MEM = "SELECT * FROM `tbl_members` WHERE 1";
    $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
        
     	foreach($RS_MEM as $AR_MEM){
     	    
     	   $user_password = rand(12345,12345678);//$AR_MEM['user_password'];
     	    $member_id = $AR_MEM['member_id'];
     	    		 //   die;
		$update_data =array("user_password"=>$user_password);
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
    		  		    
    	
     	    
     	}			 
					 
	    		    
	    		
	    		
	    		    
	    		    
	    		
	    		
	}


	 public function setinsertdummydata()
	{
	    		$model = new OperationModel();
	    			$time_stamp = getLocalTime();
		$today_date = InsertDate($time_stamp);
	    	

						
			//	die;					
            $today_date =$today_date = date('Y-m-d');//InsertDate(getLocalTime());
            $date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
            
             $QR_MEM = "SELECT * FROM `dummydata` WHERE id>0 ORDER BY `dummydata`.`id` ASC ";
    $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
        
     	foreach($RS_MEM as $AR_MEM){    
            
     		//	PRintR($AR_MEM);die;			 
				
				
// [id] => 1
// [Join_Date] => 2020-07-24 11:44:00
// [Top_Up_Date] => 2020-07-24 11:44:00
// [Sponsor] => 
// [Member_Id] => SO100001
// [Member_Name] => COMPANY
// [Mobile] => 9897000001
// [Email] => INFO@COMPANY.COM
// [Country] => India
// [Investment] => 10000
// [Hold_Status] => UnHold
// [Rank] => 0			

				
				
				
				
									 
	//	$userId = $model->generateUserId();		
	$order_no = UniqueId('ORDER_NO');
		$userId =  FCrtRplc($AR_MEM['Member_Id']);
				$user_password =  123456;
				$trns_password = 123456;
			    $country_name = FCrtRplc($AR_MEM['country_name']);
			     $time_stamp = $AR_MEM['Join_Date'];
			       $time_stamp1 = $AR_MEM['Top_Up_Date'];
				$mobile_code = +91;
				$member_mobile =$AR_MEM['Mobile'];
				$user_id  =$userId;
				$user_name = $userId;
				$gender ='M';
				  $first_name =$AR_MEM['Member_Name'];
   $member_email =$AR_MEM['Email'];
				 $left_right =  'L';
				
				if($first_name!='' || $left_right!=''){
				    
				    
			
					$sponsor_id = $model->getMemberIdnew($AR_MEM['Sponsor']);
					
				//	die;
					$AR_GET = $model->getSponsorSpillnew($sponsor_id,$left_right);
 
					/*if($left_right=='AUTO'){
						$AR_GET = $model->getOpenPlace($sponsor_id);
						$left_right = $AR_GET['left_right'];	
					}*/
					 
					$spil_id =  FCrtRplc($AR_GET['spil_id']);
		 
					 if($model->checkCount(prefix."tbl_members","user_id",$user_id)=='0'){
					     
					   
					      
					     
					     
									$Ctrl += $model->CheckOpenPlace($spil_id,$left_right);
									$data = array(
									    "first_name"=>$first_name,
										"full_name"=>$first_name,
										"user_id"=>$user_id,
										"user_name"=>$user_id,
										"user_password"=>$user_password,
										"trns_password"=>$trns_password,
										"member_email"=>$member_email,
									    "country_name"=>$state_name,
									     "gender" =>$gender,
										"sponsor_id"=>$sponsor_id,
										"spil_id"=>$spil_id,
										"left_right"=>$left_right,
									
										"level_spil"=>0,
										"member_mobile"=>$member_mobile,
										"date_join"=>$time_stamp,
										"pan_status"=>"N",
										"status"=>"Y",
										"last_login"=>$time_stamp,
										"login_ip"=>$_SERVER['REMOTE_ADDR'],
										"block_sts"=>"N",
										"sms_sts"=>"N",
									
										"type_id"=>0,
										"upgrade_date"=>$time_stamp
									);	
									
//PrintR($data); 
									if($Ctrl=='0'){
									      PrintR($data);
											$member_id = $this->SqlModel->insertRecord(prefix."tbl_members",$data);
											$tree_data = array("member_id"=>$member_id,
												"sponsor_id"=>$sponsor_id,
												"spil_id"=>$spil_id,
												"nlevel"=>0,
												"left_right"=>$left_right,
												"nleft"=>0,
												"nright"=>0,
												"date_join"=>$time_stamp
											);
											$this->SqlModel->insertRecord(prefix."tbl_mem_tree",$tree_data);
											$model->updateTree($spil_id,$member_id);
											  
									
									
            $today_date =$today_date = date('Y-m-d');//InsertDate(getLocalTime());
            $date_expire = InsertDate(AddToDate($time_stamp1,"+ 1 Year"));
                   // $type_id =1; 
                     $package_price= $AR_MEM['Investment'];
                    if($package_price >0){
             // $package_price =10;
      
            if($package_price >= 10000 and $package_price <= 50000 ){ $type_id =1;  }
            elseif($package_price >= 60000 and $package_price <= 100000 ){  $type_id =2;   }
            elseif($package_price >= 110000 and $package_price <= 1000000000 ){   $type_id =3; }
            else{
                
                
            }
        
        
        
       
             	$sub = $model->checkCount('tbl_subscription','member_id',$member_id);
             	
             	if($sub <= '0' )
				{
				$type = 'A';
				} 
				else
				{
				 $type = 'U';  
				}

			        
			       	$data_sub = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"type_id"=>$type_id,
						"package_price"=>$package_price,
						"net_amount"=>$package_price,
						"reinvest_amt"=>$package_price,
						"total_amt"=>$package_price,
						"prod_pv"=>$package_price,
						"date_from"=>$time_stamp1,
						"type" => $type,
							"roi_stacking"=>0,
								"pool"=>'N',
						"date_expire"=>$date_expire,
                        
                       
					);
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub); 
			        
			    
			 //   die;
		$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
    		  		    
    		  		    
    		  		    	
    		  		    
									}		  		    	
								
  

										}
										
									 
									 
									 
				 
								
						 		 
								 
				 
					 }
	    		    
	    		}
	    		
	    		    		 
								
						 		 
								 
	}			 
					 
	    		    
	    		
	    		
	    		    
	    		    
	    		
	    		
	}
  public function updatexamoint()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
          
           $today_date = InsertDate(getLocalTime());
    
    
    
        $dates = date('d-m-Y',strtotime($today_date));  
        $first_day_this_month = date('Y-m-01',strtotime($end_date)); 
        
        $last_day_this_month  = date('Y-m-t',strtotime($end_date));
    
  
               $QR_MEM = "SELECT *  FROM `tbl_subscription` WHERE 1 ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
        PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
                $subcription_id      = $AR_MEM['subcription_id'];
                      $x_rank      = $AR_MEM['x_rank'];
                         
                          $package_price      = $AR_MEM['package_price'];
                           $x_income      = $package_price*$x_rank/100;
                              $type_id      = $AR_MEM['type_id'];
                      $subcription_id      = $AR_MEM['subcription_id'];
                         
                          $prod_pv      = $AR_MEM['prod_pv'];
                           
                      $data_sub = array(
                "x_income"=>$x_income
               
                );      
                          
      	$this->SqlModel->updateRecord(prefix."tbl_subscription",$data_sub,array("subcription_id"=>$subcription_id)); 
         	
         	
         	
         	
           $data_sub1 = array(
                "type_id"=>$type_id,
                  "subcription_id"=>$subcription_id,
               
                 "prod_pv"=>$prod_pv
               
               
                );      
                          
         //	$this->SqlModel->updateRecord(prefix."tbl_subscription",$data_sub,array("subcription_id"=>$subcription_id)); 
         //	$this->SqlModel->updateRecord(prefix."tbl_members",$data_sub1,array("member_id"=>$member_id)); 	
         	
         	
         	
         	
         	
         	
			
     }
		  
    }  
    public function testttapi()
    {
     
    $curl = curl_init();
    
    curl_setopt_array( $curl, array(
        CURLOPT_PORT => "443",
        CURLOPT_URL => "https://marketdata.tradermade.com/api/v1/live?currency=USDEUR,USDGBP,EURJPY,AUDUSD,NZDUSD,GBPEUR,XAUUSD,XAGUSD&api_key=5fL231yqKuk9Twd_kWYJ",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
     $response1 = json_decode($response, true);
    PrintR($response1[quotes]);
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
       // echo $response;
    }                           

    }
  public function updatedddddaddresss(){
	    
		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
	
	 
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
         
		if($process_id>0){
	  	   //   $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,mem.sponsor_id,mem.member_id as from_member_id,mem.user_id  FROM `tbl_members` as mem LEFT JOIN tbl_subscription as tbl on mem.member_id=tbl.member_id   WHERE mem.member_id in (Select member_id from tbl_subscription where Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."' ) and tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)  and mem.sponsor_id in (Select member_id from tbl_subscription ) order by mem.member_id asc";
		
		
		   $QR_MEM = "SELECT * FROM `tbl_user_wallet_address_demo` as sb  ORDER BY `sb`.`member_id` ASC; ";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	  
			foreach($RS_MEM as $AR_MEM):
			    $user_id = $AR_MEM['user_id'];
			      $memberId = $AR_MEM['member_id'];
			        $Website = $AR_MEM['Website'];
			         $status_code = $AR_MEM['status_code'];
			           $c_address = $AR_MEM['c_address'];
			              $message = $AR_MEM['message'];
			            $c_address_new = _e($AR_MEM['c_address_new']);
			   // PrintR($AR_MEM);
			
    	
    	$data = array("member_id" => $memberId,
    	"user_id" => $user_id,
"user_id" => $user_id ,
"Currency" =>'USDT',
"Website" =>$Website,
"status_code"=>$status_code,
"message"=>$message,
"c_address"=>$c_address,
"c_address_new"=>$c_address_new,

"date_time" => date('Y-m-d H:i:s')
    );
  $this->SqlModel->insertRecord("tbl_user_wallet_address",$data); 
  $this->SqlModel->insertRecord("tbl_alluser_wallet_address",$data); 
    	
  	//$this->SqlModel->updateRecord(prefix."tbl_user_wallet_address_demo",$data,array("member_id"=>$memberId));  
		    endforeach;
		   
		 

		}
	
	    	 
	 
	  
	}

  public function updatedaddresss(){
	    
		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
	
	 
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
         
		if($process_id>0){
	  	   //   $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,mem.sponsor_id,mem.member_id as from_member_id,mem.user_id  FROM `tbl_members` as mem LEFT JOIN tbl_subscription as tbl on mem.member_id=tbl.member_id   WHERE mem.member_id in (Select member_id from tbl_subscription where Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."' ) and tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)  and mem.sponsor_id in (Select member_id from tbl_subscription ) order by mem.member_id asc";
		
		
		   $QR_MEM = "SELECT member_id,user_id FROM `tbl_members` as sb  ORDER BY `sb`.`member_id` ASC; ";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	  
			foreach($RS_MEM as $AR_MEM):
			    $user_id = $AR_MEM['user_id'];
			      $memberId = $AR_MEM['member_id'];
			       
			    PrintR($AR_MEM);
	$data = array(
					   
						"user_id"=>$user_id,
					
					
					);			
    	
    	
    	
  	$this->SqlModel->updateRecord(prefix."tbl_user_wallet_address_demo",$data,array("member_id"=>$memberId));  
		    endforeach;
		   
		 

		}
	
	    	 
	 
	  
	}

  
	

  public function updateddirectcommission(){
	    
		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
	
	 
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
         
		if($process_id>0){
	  	   //   $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,mem.sponsor_id,mem.member_id as from_member_id,mem.user_id  FROM `tbl_members` as mem LEFT JOIN tbl_subscription as tbl on mem.member_id=tbl.member_id   WHERE mem.member_id in (Select member_id from tbl_subscription where Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."' ) and tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)  and mem.sponsor_id in (Select member_id from tbl_subscription ) order by mem.member_id asc";
		
		
		   $QR_MEM = "SELECT sum(sb.prod_pv) as total,sb.member_id,sb.subcription_id ,sb.date_from,sb.type,sb.retopup,tm.sponsor_id,sb.type_id FROM `tbl_subscription` as sb left JOIN tbl_members tm on tm.member_id = sb.member_id where sb.subcription_id >413 and sb.subcription_id < 447 group BY `sb`.`member_id` ORDER BY `sb`.`member_id` ASC; ";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	  
			foreach($RS_MEM as $AR_MEM):
			    $memberId = $AR_MEM['sponsor_id'];
			      $from_member_id = $AR_MEM['member_id'];
			        $prod_pv1 = $AR_MEM['total'];
			          $date_from = $AR_MEM['date_from'];
			       $prod_pv = $AR_MEM['total']*10/100;
			         $type_id = $AR_MEM['type_id'];
			        $subcription_id = $AR_MEM['subcription_id'];
			    $sponsor_id = $model->getSponsorId($from_member_id);
			     echo $sponsor_id."<br>";
			    PrintR($AR_MEM);
	$data = array(
					    "member_id"=>$memberId,
						"from_member_id"=>$from_member_id,
						"total_collection"=>$prod_pv1,
						"total_income"=>$prod_pv,
						"percentage"=>10,
						"subcription_id"=>$subcription_id,
						"type_id"=>$type_id,
						"totalcount"=>'0',
						"date_time"=>$date_from,
					
					);			
    	
    	 $this->SqlModel->insertRecord(prefix."tbl_cmsn_direct_test",$data);
    	
    //	$this->SqlModel->updateRecord(prefix."tbl_cmsn_direct_test",$data,array("member_id"=>$memberId));  
		    endforeach;
		   
		 

		}
	
	    	 
	 
	  
	}
	
	 public function updatetotalcommissionnewcapping()
    {  
        for($k = 1;$k <= 117;$k++) {
        
        
              //$this->totalcommissionnewcapping($k);
           
        }
  
    }
	 public function updateddirectcommissionddd()
    {  
        for($k = 1;$k <= 12;$k++) {
        
        
              $this->updateddirectcommission($k);
           
        
  
    }
    } 




    
    
   public function mainpayouts()
    {  
    // die('ss');
          $dateToday = date('Y-m-d');
           
           
              $model = new OperationModel();
        $AR_PRSS = $model->getProcessMaster();
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
            $Today   = getDateFormat($end_date,"D");
           
           
         if(true){
             
           
        $model = new OperationModel();
        $AR_PRSS = $model->getProcessMaster();
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];  
        
        
        $this->updateDirectCounts();
        $this->setupLevelbusiness();
        $this->newsetupLevelbusiness();
        $this->maindailyminingreturnnew();
        $this->directcommission(); // coupon income under this income
        $this->metalevelIncomesontopup();
        //$this->royaltyrank();
        // $this->royaltyOnCTO();
    //    $this->Noramllifetimerewards();
        $this->totalcommissionnewcapping();
       // $this->makewithdrawfornormal();
       // $this->makewithdrawforroi();
		
		
		
		

               
             }
             
 
    } 
public function directcommission() {
    $model = new OperationModel();
    $today_date = InsertDate(getLocalTime());
    $AR_PRSS = $model->getProcess();
    $process_id = $AR_PRSS['process_id'];

    $start_date = $AR_PRSS['start_date'];
    $end_date = $AR_PRSS['end_date'];

    if ($process_id > 0) {
        $QR_MEM = "
            SELECT tbl.subcription_id, tbl.prod_pv, tbl.member_id as from_member_id
            FROM tbl_subscription as tbl
            WHERE DATE(date_from) BETWEEN '2019-02-15' AND '$end_date'
              AND tbl.subcription_id NOT IN (SELECT subcription_id FROM tbl_cmsn_direct)
            ORDER BY tbl.subcription_id ASC
        ";

        $RS_MEM = $this->SqlModel->runQuery($QR_MEM);

        foreach ($RS_MEM as $AR_MEM):
            $from_member_id = $AR_MEM['from_member_id'];
            $sponsor_id = $model->getSponsorIdVVV($from_member_id);

            if ($sponsor_id > 0) {
                $subcription_id = $AR_MEM['subcription_id'];
                $prod_pv = $AR_MEM['prod_pv'];
                $date_from = $model->getfirstpackagedate($sponsor_id);

                // Step 1: Count directs on same day as sponsor's package date
              echo  $direct_1day_QR = "
                    SELECT member_id 
                    FROM tbl_members 
                    WHERE sponsor_id = '$sponsor_id' 
                      AND member_id IN (
                          SELECT member_id 
                          FROM tbl_subscription 
                          WHERE DATE(date_time) = '$date_from'
                      )
                ";
               // die;
                $direct_1day_RS = $this->SqlModel->runQuery($direct_1day_QR);
                $direct_1day_count = count($direct_1day_RS);

                // Step 2: Mark booster if eligible
                if ($direct_1day_count >= 4) {
                    $data_sub = array("is_booster" => 'Y');
                    $this->SqlModel->updateRecord(prefix . "tbl_members", $data_sub, array("member_id" => $sponsor_id));
                }

                // Step 3: Count previous direct commissions
                $directNumberQry = "
                    SELECT COUNT(*) as direct_count 
                    FROM tbl_cmsn_direct 
                    WHERE member_id = '$sponsor_id'
                ";
                $directResult = $this->SqlModel->runQuery($directNumberQry, true);
                $current_direct_count = $directResult['direct_count'] + 1;

                // Step 4: Decide percentage
                if ($direct_1day_count >= 4) {
                    // Qualified: Only first direct gets 10%
                    if ($current_direct_count <= 4) {
                        $dailyretruen = 10;
                    } else {
                        $dailyretruen = 5;
                    }
                } else {
                    // Not qualified
                    $dailyretruen = 5;
                }

                $direct_bonus = $prod_pv * $dailyretruen / 100;

                // Step 5: Save commission
                if ($direct_bonus > 0) {
                    $data_direct = array(
                        "process_id"       => $process_id,
                        "subcription_id"   => $subcription_id,
                        "member_id"        => $sponsor_id,
                        "from_member_id"   => $from_member_id,
                        "total_collection" => $prod_pv,
                        "admin_charge"     => 0,
                        "total_income"     => $direct_bonus,
                        "net_income"       => $direct_bonus,
                        "percentage"       => $dailyretruen,
                        "date_time"        => $end_date,
                    );

                    // Insert into commission table
                    $this->SqlModel->insertRecord(prefix . "tbl_cmsn_direct", $data_direct);
                    
                     $model->wallet_transaction('2',"Cr",$sponsor_id,$direct_bonus,$trns_remark,$end_date,$trans_no,1,"Direct_INCOME");
                    PrintR($data_direct); // For testing

                    
                }
            }
        endforeach;

        echo "Done directcommission";
    }
}



 public function directcommissionoldddddddddddd() {
	    
		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess(21);
		$process_id = $AR_PRSS['process_id'];
	
	 
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
         
		if($process_id>0){
	  	 
			   $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,tbl.member_id as from_member_id   FROM  tbl_subscription as tbl   WHERE Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."'  and    tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)   order by tbl.subcription_id asc";
		
		
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	       // PrintR($AR_MEM);die;
			foreach($RS_MEM as $AR_MEM):
			    
			   //  PrintR($AR_MEM);
			    $from_member_id = $AR_MEM['from_member_id'];
			    $sponsor_id = $model->getSponsorIdVVV($from_member_id);
			     echo $sponsor_id."<br>";
			     $count =  $model->checkCount('tbl_subscription','member_id',$sponsor_id);
			     if($count > '0'  and $sponsor_id > 0 ){
			    $subcription_id = $AR_MEM['subcription_id'];
			    
			   	$AR_SUB = $model->getCurrentMemberShip($sponsor_id);
			 
			    
		$QR_MEM_ALL = "SELECT * FROM `tbl_subscription` WHERE member_id ='$member_iddd'";
$RS_MEM_ALL = $this->SqlModel->runQuery($QR_MEM_ALL);


			 //   $dailyretruen =5;
			 //  $direct_bonus = $AR_MEM['prod_pv']*$dailyretruen/100;     
			    
			     $date_from   = $model->getfirstpackagedate($sponsor_id);
  $date_from = InsertDate($date_from);				
  $new_start_date = InsertDate(AddToDate($date_from,"+7 day"));			

  $memberdetail   = $model->getMemberdetail($sponsor_id);
				//	PrintR($memberdetail['count_directs']);
				$count_directs=	$memberdetail['count_directs'];
					$is_booster=	$memberdetail['is_booster'];

$date1 = new DateTime($date_from);
$date2 = new DateTime($end_date);
 $days  = $date2->diff($date1)->format('%a');
   $getTotalMemberShipValue = $model->getTotalMemberShipValueT($sponsor_id); 
       
    
if($days<=1){
   
    

$PAID_DIR = "SELECT count(*) as total FROM `tbl_members` as tm WHERE `sponsor_id` = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription as ts WHERE ts.subcription_id >0);"; 


//echo $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` as tm WHERE member_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription as ts WHERE tm.self_bv >='$getTotalMemberShipValue')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
 $total = $PAID_DIR['total']; 
    
   if($total<=4){
       
     //\die('ssssssss');
$data_sub = array(
"is_booster"=>'Y'

);

$this->SqlModel->updateRecord(prefix."tbl_members",$data_sub,array("member_id"=>$sponsor_id));       

    $dailyretruen =10;
			   $direct_bonus = $AR_MEM['prod_pv']*$dailyretruen/100;          
       
   } else{
       
       
       if($is_booster=='Y'){
           
           
        //  $dailyretruen =10;
		//	   $direct_bonus = $AR_MEM['prod_pv']*$dailyretruen/100;     
			       
           
       }else{
           
         $dailyretruen =5;
			   $direct_bonus = $AR_MEM['prod_pv']*$dailyretruen/100;     
			    
         
           
           
       }
       
       
       
       
        
        
        
        
       
       
   }
    
    
    
    
   
    
}else{
    
       
        
      
       if($is_booster=='Y'){
           
           // $dailyretruen =10;
			 //  $direct_bonus = $AR_MEM['prod_pv']*$dailyretruen/100;     
			    
         
           
       }else{
           
         
            $dailyretruen =5;
			   $direct_bonus = $AR_MEM['prod_pv']*$dailyretruen/100;     
			    
           
       }
       
        
        
        
        
        
        
        
}	
			 
			    
			  
	 
		    if($direct_bonus > '0' )
		    {
			 $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $from_member_id,
                               
                                "total_collection"     => $AR_MEM['prod_pv'],
                                "admin_charge"         => 0,
                                "total_income"         => $direct_bonus , 
                                "net_income"           => $direct_bonus,
                                  "percentage"           => $dailyretruen,
                              
                                "date_time"            => $end_date, 
                 );
	
	 PRintR($data_direct);
		  	$this->SqlModel->insertRecord(prefix."tbl_cmsn_direct",$data_direct);
	 
	 
        if( $AR_MEM['prod_pv'] >= 500000 and $AR_MEM['prod_pv'] <= 900000){
            
$coupon=25000;
            
        }
         elseif( $AR_MEM['prod_pv'] >= 1000000  and $AR_MEM['prod_pv'] <= 1900000){

       $coupon=50000;
             
             
         }
          elseif(  $AR_MEM['prod_pv'] >= 2000000 ){

       
             $coupon=100000;
             
         }else{
             
             $coupon=0;
         }
        
    if($coupon>0){
	 $trns_remark='Coupon_INCOME';
	    // $model->wallet_transaction('5',"Cr",$member_id,$netIncome,$trns_remark,$end_date,$trans_no,1,"Coupon_INCOME");
    }

		    }
			     
			    // }}
      }
		    endforeach;
		   
		 

		}
	    // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"directcommission"));  
	    echo " Done directcommission";	 
	 
	  
	} 

    // generate CTO ROyalty
    
    
     public function royaltyrank()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess(1);
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
          
          
           $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs FROM ".prefix."tbl_members AS tm where   tm.member_id in (Select member_id from tbl_subscription where   date(date_from) = '$end_date')       ORDER BY tm.member_id ASC";
		
          
              //  $QR_MEM = "SELECT member_id  FROM `tbl_members` WHERE subcription_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
      
			foreach($RS_MEM as $AR_MEM){
			    
			   //   PrintR($AR_MEM);
			    
                $member_id      = $AR_MEM['member_id'];
                 $user_id      = $AR_MEM['user_id'];
                    $count_direct      = $AR_MEM['count_directs'];
          
                  $REF_BUSINESS   = $this->SqlModel->runQuery("SELECT member_id,user_id, count_directs ,rank_id, SUM(self_bv+team_bv) as total FROM `tbl_members` WHERE sponsor_id =  '$member_id'  and subcription_id > 0 GROUP BY member_id ORDER BY `total` DESC  ");   
              //  PrintR($REF_BUSINESS);
       
               $A1 = 0;
               $A2 = 0;
               $B = 0;
          
                if($REF_BUSINESS)
                {
                   
                    foreach($REF_BUSINESS as $R)
                    {
                    
                     $totalbusines = $R['total'];
                     
                   
                    }
                }
   


                
                if($totalbusines >=100000000 and  $totalbusines < 250000000){
                     
                     $rank_id = 1;
                  //  PrintR($AR_MEM);
                    $this->db->query("UPDATE `tbl_members` SET  `royalty_id` =  $rank_id WHERE member_id ='$member_id';");	 
                    
                }
           
            
                  if($totalbusines >=250000000 and  $totalbusines < 500000000){
                    
                   
                     $rank_id = 2 ;
                    $this->db->query("UPDATE `tbl_members` SET  `royalty_id` =  $rank_id  WHERE member_id ='$member_id';");	 
                    
                }
             
               
                  if($totalbusines >=500000000 and  $totalbusines < 1000000000){
                    
                  
                     $rank_id = 3;
                     $this->db->query("UPDATE `tbl_members` SET  `royalty_id` =  $rank_id WHERE member_id ='$member_id';");	 
                    
                }
                
            
                
               
                 if($totalbusines >=1000000000){
                  
                     $rank_id = 4 ;
                    $this->db->query("UPDATE `tbl_members` SET  `royalty_id` =  $rank_id WHERE member_id ='$member_id';");	 
                    
                }
                
               
                 
                    
               
			    
			    
			}
		  
    } 
   public function royaltyOnCTO() {
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
            
            $firstDay = date('Y-m-01',strtotime($start_date));
        $lastDay = date('Y-m-t',strtotime($end_date));  
             $today_date = InsertDate(getLocalTime());
            $llastDay =InsertDate(AddToDate($today_date,"-1 Day")); 
            
      if($lastDay==$llastDay){      
            $QR_MEM1  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where  Date(date_from) BETWEEN '$firstDay' AND '".$lastDay."'"; 
            $RS_REW1  = $this->SqlModel->runQuery($QR_MEM1,true);
            $TOTAL1   = ($RS_REW1['total'] > 0 ) ? $RS_REW1['total'] : 0 ;
             $maxDays=date('t');  
           
           
            if($TOTAL > 0 )
            {
                $ROYALTY_1 =  number_format($TOTAL1 *0.5/100, 4, '.', '');
                $ROYALTY_2 =  number_format($TOTAL1 *1/100, 4, '.', '');
                $ROYALTY_3 =  number_format($TOTAL1 *1.5/100, 4, '.', '');
                $ROYALTY_4 =  number_format($TOTAL1 *2/100, 4, '.', '');
                
                
              $QR_MEM1  = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '1' and tm.member_id in (Select member_id from tbl_subscription)";
                 $RS_ROYAL_1  = $this->SqlModel->runQuery($QR_MEM1,true);   
                $ROYAL_1     = $RS_ROYAL_1['total'];
                
               $QR_MEM2     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '2' and tm.member_id in (Select member_id from tbl_subscription)";
                 $RS_ROYAL_2  = $this->SqlModel->runQuery($QR_MEM2,true);   
                 $ROYAL_2     = $RS_ROYAL_2['total'];
                
              $QR_MEM3  = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '3' and tm.member_id in (Select member_id from tbl_subscription)";
                $RS_ROYAL_3  = $this->SqlModel->runQuery($QR_MEM3,true);   
                $ROYAL_3     = $RS_ROYAL_3['total'];
                
               $QR_MEM4     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '4' and tm.member_id in (Select member_id from tbl_subscription)";
                $RS_ROYAL_4  = $this->SqlModel->runQuery($QR_MEM4,true);   
                $ROYAL_4     = $RS_ROYAL_4['total'];
                
                    
                  $ROYALTY_i   =  number_format($ROYALTY_1 / $ROYAL_1, 6, '.', '');
                $ROYALTY_ii  =  number_format($ROYALTY_2 / $ROYAL_2, 6, '.', '');
                $ROYALTY_iii =  number_format($ROYALTY_3 / $ROYAL_3, 6, '.', '');
                $ROYALTY_iv =  number_format($ROYALTY_4 / $ROYAL_4, 6, '.', '');
                 
 
       //    $QR_MEM = "SELECT  member_id,prod_pv from tbl_subscription  where  date_from    <= '$end_date'  ORDER BY member_id ASC ";      
        $QR_MEM = "SELECT tm.member_id,tm.royalty_id FROM tbl_members AS tm where tm.royalty_id  > '0' and tm.member_id in (Select member_id from tbl_subscription)    ORDER BY tm.member_id ASC ";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);

	    foreach($RS_MEM as $AR_MEM){  //PrintR($AR_MEM);
		 
				$member_id     = $AR_MEM['member_id'];
		        $royalty_id   = $AR_MEM['royalty_id'];
		         
                    if($royalty_id == 1)
                    {
                            $trans_amount  =  $ROYALTY_1; 
                            $daily_return  =  0.5;//$ROYAL_1; 
                            $net_income    =  $ROYALTY_i; 
                             $TOTAL         = $TOTAL1;
                    }
                    elseif($royalty_id ==2)
                    {
                            $trans_amount  =  $ROYALTY_2; 
                            $daily_return  =  1;//$ROYAL_2; 
                            $net_income    =  $ROYALTY_ii; 
                             $TOTAL         = $TOTAL1;
                    }
                    elseif($royalty_id ==3)
                    {
                            $trans_amount  =  $ROYALTY_2; 
                            $daily_return  =  1.5;//$ROYAL_2; 
                            $net_income    =  $ROYALTY_iii; 
                             $TOTAL         = $TOTAL1;
                    }
                    elseif($royalty_id ==4)
                    {
                            $trans_amount  =  $ROYALTY_2; 
                            $daily_return  =  2;//$ROYAL_2; 
                            $net_income    =  $ROYALTY_iv; 
                             $TOTAL         = $TOTAL1;
                    }
                    
                   
                    // else
                    // { 
                    //         $trans_amount  =  0; 
                    //         $daily_return  =  0; 
                    //         $net_income    =  0;
                    //         $TOTAL         = 0;     
                    // }
                          
                          $posted_data = array(
                          'process_id'    => $process_id,  
                          'member_id'     => $member_id,
                          'type_id'       => $royalty_id ,
                          'trans_amount'  => $TOTAL ,
                          'daily_return'  => $daily_return,
                          'net_income'    => $net_income,
                          'date_time'     => $end_date ,
                          'cmsn_date'     => $end_date ,
                      );
                      
                     PrintR($posted_data);
                      if($net_income > 0 )
                      {
                     $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick",$posted_data);
                           
                        	$trns_remark = "Royalty Income";
			
           //     $model->wallet_transaction('6',"Cr",$member_id,$net_income,$trns_remark,$end_date,rand(),1,$trns_remark);    
                           
                           
                      }
                   
                   	 		 		 	 		
	 
				
                    
                 }
                
                
                
                
			}  
               
   }
		 	
	 
	         } 


     public function testaallllCommunityincome(){
       
        
            
  	for($k = 1; $k<=14;$k++){  
      
       $this->Communityincomeup($k);
 $this->Communityincomedown($k);
 $this->Communityincomeretopup($k);
 $this->Communityincomeretopdown($k);
      
    }           
       
   } 
  
  public function testretopupperformance_all(){
       for($k = 1; $k<=117;$k++){  
         // $this->Noramllifetimerewards($k);
               
       }           
       
   }  
    
   
   public function NormalCommunityincome(){
       
       //  $this->Communityincomeup();
                 $this->Communityincomedown();
              
                
       
   }  
      public function RetopupCommunityincome(){
       
         $this->Communityincomeretopup();
                // $this->Communityincomeretopdown();
              
                
       
   }  
          public function Noramllifetimerewards(){
       //   $this->setupLevelbusiness();
        $this->onetimerewards();
        $this->onetimerewarddistribute1();
        //$this->monthlyrewarddistribute1new();    
                
       
   }  
   
     public function retopupperformance_all(){
       
         $this->retopupperformance();
        $this->retopuprewarddistribute1();
               
                
       
   }  
    
    
     public function directtoairdrop() {
	    
		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess(2);
		$process_id = $AR_PRSS['process_id'];
	
	 
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
        // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"directcommission"));   
		if(true){
	  	   //   $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,mem.sponsor_id,mem.member_id as from_member_id,mem.user_id  FROM `tbl_members` as mem LEFT JOIN tbl_subscription as tbl on mem.member_id=tbl.member_id   WHERE mem.member_id in (Select member_id from tbl_subscription where Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."' ) and tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)  and mem.sponsor_id in (Select member_id from tbl_subscription ) order by mem.member_id asc";
		
		
		  // $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,tbl.member_id as from_member_id   FROM  tbl_subscription as tbl   WHERE Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."'  and    tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)   order by tbl.subcription_id asc";
		   $QR_MEM = "SELECT member_id,sum(trns_amount) as total  FROM  tbl_wallet_trns    WHERE trns_for='DCA' group by member_id";
		
		
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
            $trns_date = date('Y-m-d H:i:s');
            $trans_no = UniqueId("TRNS_NO");
			foreach($RS_MEM as $AR_MEM){
			   
			     $member_id = $AR_MEM['member_id']; 
			      $total = $AR_MEM['total']; 
			      	$LDGR = $model->getCurrentBalance($member_id,1,"","");
			      
			      if($LDGR['net_balance']>0){
			       PrintR($AR_MEM);
			      
			    	$trns_remark = "Direct Referral to Airdop Fron Own ID";
			    		$trns_remark = "Received From Direct Referral";
				$model->wallet_transaction(1,"Dr",$member_id,$total,$trns_remark,$trns_date,$trans_no,"1","DCADEBIT");
             
                $model->wallet_transaction('4',"Cr",$member_id,$total,'Direct Referral to Airdop',date('Y-m-d'),rand(),1,"DCATOAIR");   
			      
			      
			      
			      }    
	
			}
		   
		 

		}
	    // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"directcommission"));  
	  //  echo " Done directcommission";	 
	 
	  
	} 
   public function updatedirectlevelbusines(){
       $this->updateDirectCounts();
            $this->setupLevelbusiness();
   }
  
  	/*Start Closing*/ 
    public function updateDirectCounts()     {
    
     $model = new OperationModel(); 
    
     $QR_MEM = "SELECT member_id FROM `tbl_members` WHERE 1  ";
    $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
    
            // $QR_MEM = "SELECT member_id FROM `tbl_members` WHERE 1  ";
            // $RS_MEM = $model->runQuery($QR_MEM);
 		 
			foreach($RS_MEM as $AR_MEM)
			{
			$member_id = $AR_MEM['member_id']; 
			
	//	echo	$PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$member_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE 1)";
            //// $PAID_DIR = $this->SqlModel->runQuery($PAID_DIR);
			
 		 //   $PAID_DIR = $this->SqlModel->runQuery("SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$member_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id != 5)",true); 
 			// $PAID_DIR = $PAID_DIR->total;
			
			
        $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$member_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE 1)"; 
        $PAID_DIR = $this->SqlModel->runQuery($PAID_DIR,true);
			
			 
            echo "<br>".$member_id .'=>'.$PAID_DIR['total']; 
            $total = $PAID_DIR['total'];
			if(  $member_id >  0 and $PAID_DIR > 0   )
			{
			    $this->db->query("UPDATE `tbl_members` SET `count_directs` =  $total    WHERE member_id ='$member_id';");  
			 // $model->updateRecord("tbl_members",array("count_directs" => $PAID_DIR), array("member_id" =>$member_id)); // $this->db->query("UPDATE `tbl_members` SET `count_directs` =  $total    WHERE member_id ='$member_id';");  
			    
			}
			
			  
			} 
 
    }   
    public function setupLevelbusiness()               {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
              //  $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
                $QR_MEM = "select subcription_id,member_id,prod_pv from tbl_subscription where date_from  <='$end_date'  and isSetPV ='N' and retopup='N'  "; 
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
           //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			   
			    $subcription_id = $AR_MEM['subcription_id'];
			    $member_id      = $AR_MEM['member_id'];
			    $prod_pv        = $AR_MEM['prod_pv'];
			    
			      $memberdetail   = $model->getMemberdetail($member_id);
	$plan=	$memberdetail['plan'];
			    
//	if($plan=='A'){
	    
	    	    $memberList = $model->memberParentLevelLists($member_id);
			    echo "<br>".$subcription_id.'-------'.date('H:i:s');
			    if(count($memberList) > 0 )
			    {
			      $i =0;
			      $open = 'Y';
			      foreach($memberList as $list)
			      {
                        $member_id       = $list['member_id'];
                        $sponsor_id      = $list['sponsor_id'];
                            if($i > 0 )
                            {
                             // $this->db->query("UPDATE `tbl_members` SET `team_bv` = team_bv+$prod_pv  WHERE member_id ='$member_id';");
                            }
                            else
                            {
                              $this->db->query("UPDATE `tbl_members` SET `self_bv` = self_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                            
                            if($i ==1)
                            {
                                 $this->db->query("UPDATE `tbl_members` SET `direct_bv` = direct_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                          
                     
                        
                       
                        $i++;
			      }
			    }
			    $this->SqlModel->updateRecord("tbl_subscription", array("isSetPV" => "Y") ,array("subcription_id"=>$subcription_id));
			    
            
	    
//	}	    
			    
			    
			    
			    
			    
			    
			    
			    
			    
			    
		
			    
			    
			}
		  //$this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
    }
    public function newsetupLevelbusiness(){
      $QR_MEM = "select subcription_id,member_id,prod_pv from tbl_members where subcription_id >0 "; 
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
           //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			   
			    $subcription_id = $AR_MEM['subcription_id'];
			    $member_id      = $AR_MEM['member_id'];
			    $prod_pv        = $AR_MEM['prod_pv'];
			    
			    
			      $result = returnLevelforteam($member_id); // Example call

// Output all collected data
echo "<pre>";
//echo "Total Records: " . count($result) . "\n";

$i=1;

foreach ($result as $record) {
   // PRintR($record);
     if($i> 0 and $record['type_id'] !=5){
      // if($i> 0){
    
    
        
         echo "Count: " . $i . "\n";
    echo "Member ID: " . $record['member_id'] . "\n";
    echo "User ID: " . $record['user_id'] . "\n";
    echo "First Name: " . $record['first_name'] . "\n";
    echo "Sponsor ID: " . $record['sponsor_id'] . "\n";
    echo "Date Joined: " . $record['date_join'] . "\n";
    echo "Subscription ID: " . $record['subcription_id'] . "\n";
    echo "Product PV: " . $record['prod_pv'] . "\n";
    echo "Date From: " . $record['date_from'] . "\n";
    echo "Date Time: " . $record['date_time'] . "\n";
    echo "----------------------------\n";
   $prod_pv +=$record['prod_pv'];
    
    }
    
    
    $i++;
}
 echo $prod_pv;
echo "</pre>";
		
		     $this->db->query("UPDATE `tbl_members` SET `team_bv` = $prod_pv  WHERE member_id ='$member_id';"); 
		 // $this->db->query("UPDATE `tbl_members` SET `curren_team_bv` = $prod_pv  WHERE member_id ='$member_id';");
			    
			}
    
  
}
     public function setupRetopupLevelbusiness()               {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
              //  $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
                $QR_MEM = "select subcription_id,member_id,prod_pv from tbl_subscription where date_from  <='$end_date'  and r_isSetPV ='N' and retopup='Y'";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
           //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			    
			    $subcription_id = $AR_MEM['subcription_id'];
			    $member_id      = $AR_MEM['member_id'];
			    $prod_pv        = $AR_MEM['prod_pv'];
			    $memberList = $model->memberParentLevelLists($member_id);
			    echo "<br>".$subcription_id.'-------'.date('H:i:s');
			    if(count($memberList) > 0 )
			    {
			      $i =0;
			      $open = 'Y';
			      foreach($memberList as $list)
			      {
                        $member_id       = $list['member_id'];
                        $sponsor_id      = $list['sponsor_id'];
                            if($i > 0 )
                            {
                              $this->db->query("UPDATE `tbl_members` SET `r_team_bv` = r_team_bv+$prod_pv  WHERE member_id ='$member_id';");
                            }
                            else
                            {
                              $this->db->query("UPDATE `tbl_members` SET `r_self_bv` = r_self_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                            
                            if($i ==1)
                            {
                                 $this->db->query("UPDATE `tbl_members` SET `r_direct_bv` = r_direct_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                          
                     
                        
                       
                        $i++;
			      }
			    }
			    $this->SqlModel->updateRecord("tbl_subscription", array("r_isSetPV" => "Y") ,array("subcription_id"=>$subcription_id));
			    
            
			    
			    
			}
		  //$this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
    }
      public function cuurentsetupLevelbusiness()               {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
              //  $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
                $QR_MEM = "select subcription_id,member_id,prod_pv from tbl_subscription where date_from  ='$end_date'";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
           //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			    
			    $subcription_id = $AR_MEM['subcription_id'];
			    $member_id      = $AR_MEM['member_id'];
			    $prod_pv        = $AR_MEM['prod_pv'];
			    $memberList = $model->memberParentLevelLists($member_id);
			    echo "<br>".$subcription_id.'-------'.date('H:i:s');
			    if(count($memberList) > 0 )
			    {
			      $i =0;
			      $open = 'Y';
			      foreach($memberList as $list)
			      {
                        $member_id       = $list['member_id'];
                        $sponsor_id      = $list['sponsor_id'];
                            if($i > 0 )
                            {
                              $this->db->query("UPDATE `tbl_members` SET `curren_team_bv` = curren_team_bv+$prod_pv  WHERE member_id ='$member_id';");
                            }
                            else
                            {
                              $this->db->query("UPDATE `tbl_members` SET `self_bv` = self_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                            
                            if($i ==1)
                            {
                                 $this->db->query("UPDATE `tbl_members` SET `direct_bv` = direct_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                          
                     
                        
                       
                        $i++;
			      }
			    }
			  //  $this->SqlModel->updateRecord("tbl_subscription", array("isSetPV" => "Y") ,array("subcription_id"=>$subcription_id));
			    
            
			    
			    
			}
		  //$this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
    }
    
    
    	 public function maindailyminingreturnnew()    {
		$model = new OperationModel();
 
	  	$AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		$today_date = $end_date;//InsertDate(getLocalTime());
		$cmsn_date =   InsertDate(AddToDate($end_date,"0 Day")); #InsertDate($today_date); 
		
	  $day = getDateFormat($end_date,"D"); 

		$QR_CMSN = "SELECT * FROM tbl_subscription AS ts where offroi='N' and  DATE(ts.date_from) <=  '".$cmsn_date."' ORDER BY ts.subcription_id ASC"; 
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN); 
 
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN): //PrintR($AR_CMSN);
				
					$type_id = $AR_CMSN['type_id'];
			
			$roi_stacking = $AR_CMSN['roi_stacking'];
				    $package_price = $AR_CMSN['package_price'];
	
					$member_id = $AR_CMSN['member_id'];
					$subcription_id = $AR_CMSN['subcription_id'];
					
					$trans_no = rand(111111,9999999);
					
					  $memberdetail   = $model->getMemberdetail($member_id);
				//	PrintR($memberdetail['count_directs']);
				$count_directs=	$memberdetail['count_directs'];
					$is_booster=	$memberdetail['is_booster'];
						$offroi=	$memberdetail['offroi'];
							$allincome=	$memberdetail['allincome'];
					$plan=	$memberdetail['plan'];	
 if($allincome=='N'){					

  $date_from   = $model->getfirstpackagedate($member_id);
  $date_from = InsertDate($date_from);				
  $new_start_date = InsertDate(AddToDate($date_from,"+7 day"));			



$date1 = new DateTime($date_from);
$date2 = new DateTime($end_date);
 $days  = $date2->diff($date1)->format('%a');
   $getTotalMemberShipValue = $model->getTotalMemberShipValueT($member_id); 
     $maxDays = date('t', strtotime($end_date)); 
      if($offroi=='N'){

   
        if($type_id==1){
          
         $dayss=50;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =3;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      } 
        if($type_id==2){
          
         $dayss=37;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =4;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      } 
        
       if($type_id==3){
          
         $dayss=30;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =5;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      } 
      
     
				 
				 
				     	
					if($member_id>0 ){
					

						$ctrl_count = $model->checkCmsnDaily($subcription_id,$member_id,$cmsn_date);
					    if($ctrl_count==0){
						
					    	$posting_no = $model->getPostingCount($subcription_id,$member_id,$cmsn_date);
				 	        $remark = "Mining Bonus - DAY NO[".$posting_no."]";
							if($posting_no  <= $dayss)
							{
					
                   if($cal_amount>0){
                 
                     //	$model->setDailyReturnIncome($subcription_id,$type_id,$member_id,$trans_no,$trans_amount,$daily_return,$cal_amount,$remark,$cmsn_date,$process_id);
                   
			 
			 	$data = array("member_id"=>$member_id,
				"subcription_id"=>$subcription_id,
				"type_id"=>$type_id,
				"trans_no"=>$trans_no,
				"trans_amount"=>$trans_amount,
				"daily_return"=>$daily_return,
				"net_income"=>$cal_amount,
				"trns_remark"=>$remark,
				"process_id"=>$process_id,
					"is_booster"=>$is_booster,
				"date_time"=>$cmsn_date
			);
	PrintR($data);  //die;
	
	$DailyIncome = $model->getincomesallnew("Daily",$member_id);   
	
	 $totalearning  = $DailyIncome;
	 
	   $PAID_DIReee1 = "SELECT x_income as x_income,subcription_id FROM `tbl_subscription` WHERE  `member_id`='$member_id'  ORDER BY `tbl_subscription`.`subcription_id` ASC Limit 1; "; 
$PAID_DIRee1 = $model->SqlModel->runQuery($PAID_DIReee1,true); 	

 $packageamount1 =$PAID_DIRee1['x_income'];
$subcription_id1=    $PAID_DIRee1['subcription_id'];
	  
	  
	                 if($totalearning >= $packageamount1){
                                   $data_sub = array(
                "offroi"=>'Y'
               
                );
            $flushout  = 0;
				$this->SqlModel->updateRecord(prefix."tbl_subscription",$data_sub,array("subcription_id"=>$subcription_id1));  
                             }  
	  $trns_remark='ROI_INCOME';
	 
	 
	// $model->wallet_transaction('4',"Cr",$member_id,$netIncome,$trns_remark,$end_date,$trans_no,1,"ROI_INCOME");
	 
	 
	
	$this->SqlModel->insertRecord(prefix."tbl_cmsn_daily",$data);
	
	
			 
                   }	    
							     
							    
							}
						 
						}
					}
					
					 
				unset($trans_amount,$cal_amount);
				
		 	}
    
    


	}
	
	endforeach;
			}   
			
	
	
		echo "ROI has been done <br>";
		
	}
    	 public function maindailyminingreturn()    {
		$model = new OperationModel();
 
	  	$AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		$today_date = $end_date;//InsertDate(getLocalTime());
		$cmsn_date =   InsertDate(AddToDate($end_date,"0 Day")); #InsertDate($today_date); 
		
	  $day = getDateFormat($end_date,"D"); 

		$QR_CMSN = "SELECT * FROM tbl_subscription AS ts where  DATE(ts.date_from) <=  '".$cmsn_date."' ORDER BY ts.subcription_id ASC"; 
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN); 
 
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN): //PrintR($AR_CMSN);
				
					$type_id = $AR_CMSN['type_id'];
			
			$roi_stacking = $AR_CMSN['roi_stacking'];
				    $package_price = $AR_CMSN['package_price'];
	
					$member_id = $AR_CMSN['member_id'];
					$subcription_id = $AR_CMSN['subcription_id'];
					
					$trans_no = rand(111111,9999999);
					
					  $memberdetail   = $model->getMemberdetail($member_id);
				//	PrintR($memberdetail['count_directs']);
				$count_directs=	$memberdetail['count_directs'];
					$is_booster=	$memberdetail['is_booster'];
						$offroi=	$memberdetail['offroi'];
							$allincome=	$memberdetail['allincome'];
					$plan=	$memberdetail['plan'];	
 if($allincome=='N'){					
if($plan=='A'){
    
  					
  $date_from   = $model->getfirstpackagedate($member_id);
  $date_from = InsertDate($date_from);				
  $new_start_date = InsertDate(AddToDate($date_from,"+7 day"));			



$date1 = new DateTime($date_from);
$date2 = new DateTime($end_date);
 $days  = $date2->diff($date1)->format('%a');
   $getTotalMemberShipValue = $model->getTotalMemberShipValueT($member_id); 
      $maxDays=22;//date('t');   
      if($offroi=='N'){
if($days<=7){
   
   
$PAID_DIR = "SELECT count(*) as total FROM `tbl_members` as tm WHERE sponsor_id = '$member_id' and member_id IN(SELECT member_id FROM tbl_subscription as ts WHERE tm.self_bv >='$getTotalMemberShipValue')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total']; 
    
   if($total>=3){
       
         if($type_id==1){
          
         $dayss=912;
        
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =12/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        
         if($type_id==2){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =15/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        if($type_id==3){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =18/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      } 
        
        
        
$data_sub = array(
"is_booster"=>'Y'

);

$this->SqlModel->updateRecord(prefix."tbl_members",$data_sub,array("member_id"=>$member_id));       

       
       
   } else{
       
       
       if($is_booster=='Y'){
           
           
         if($type_id==1){
          
         $dayss=912;
        
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =12/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        
         if($type_id==2){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =15/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        if($type_id==3){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =18/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }     
           
       }else{
           
            if($type_id==1){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =8/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        
         if($type_id==2){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =10/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        if($type_id==3){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =12/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      } 
         
           
           
       }
       
       
       
       
        
        
        
        
       
       
   }
    
    
    
    
   
    
}else{
    
       
        
      
       if($is_booster=='Y'){
           
           
         if($type_id==1){
          
         $dayss=912;
        
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =12/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        
         if($type_id==2){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =15/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        if($type_id==3){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =18/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }     
           
       }else{
           
            if($type_id==1){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =8/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        
         if($type_id==2){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =10/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      }
        
        if($type_id==3){
          
         $dayss=912;
        $trans_amount = $AR_CMSN['package_price'];
        $daily_return =12/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;    
          
          
      } 
         
           
           
       }
       
        
        
        
        
        
        
        
}				 
				 
				 
				     	
					if($member_id>0 ){
					

						$ctrl_count = $model->checkCmsnDaily($subcription_id,$member_id,$cmsn_date);
					    if($ctrl_count==0){
						
					    	$posting_no = $model->getPostingCount($subcription_id,$member_id,$cmsn_date);
				 	        $remark = "Mining Bonus - DAY NO[".$posting_no."]";
							if($posting_no  <= $dayss)
							{
					
                   if($cal_amount>0){
                 
                     //	$model->setDailyReturnIncome($subcription_id,$type_id,$member_id,$trans_no,$trans_amount,$daily_return,$cal_amount,$remark,$cmsn_date,$process_id);
                   
			 
			 	$data = array("member_id"=>$member_id,
				"subcription_id"=>$subcription_id,
				"type_id"=>$type_id,
				"trans_no"=>$trans_no,
				"trans_amount"=>$trans_amount,
				"daily_return"=>$daily_return,
				"net_income"=>$cal_amount,
				"trns_remark"=>$remark,
				"process_id"=>$process_id,
					"is_booster"=>$is_booster,
				"date_time"=>$cmsn_date
			);
	PrintR($data);  //die;
	$this->SqlModel->insertRecord(prefix."tbl_cmsn_daily",$data);
			 
                   }	    
							     
							    
							}
						 
						}
					}
					
					 
				unset($trans_amount,$cal_amount);
				
		 	}  
    
    
}else{
    
 

$date1 = new DateTime($date_from);
$date2 = new DateTime($end_date);
 $days  = $date2->diff($date1)->format('%a');
   $getTotalMemberShipValue = $model->getTotalMemberShipValueT($member_id); 
      $maxDays=22;//date('t');   
      if($offroi=='N'){

 $trans_amount = $AR_CMSN['package_price'];
        $daily_return =7/$maxDays;
        $cal_amount = $trans_amount*$daily_return/100;  				 
				 
				 
				     	
					if($member_id>0 ){
					

						$ctrl_count = $model->checkCmsnDaily($subcription_id,$member_id,$cmsn_date);
					    if($ctrl_count==0){
						
					    	$posting_no = $model->getPostingCount($subcription_id,$member_id,$cmsn_date);
				 	        $remark = "Mining Bonus - DAY NO[".$posting_no."]";
							if($posting_no  <= $dayss)
							{
					
                   if($cal_amount>0){
                 
                     //	$model->setDailyReturnIncome($subcription_id,$type_id,$member_id,$trans_no,$trans_amount,$daily_return,$cal_amount,$remark,$cmsn_date,$process_id);
                   
			 
			 	$data = array("member_id"=>$member_id,
				"subcription_id"=>$subcription_id,
				"type_id"=>$type_id,
				"trans_no"=>$trans_no,
				"trans_amount"=>$trans_amount,
				"daily_return"=>$daily_return,
				"net_income"=>$cal_amount,
				"trns_remark"=>$remark,
				"process_id"=>$process_id,
					"is_booster"=>$is_booster,
						"plan"=>$plan,
				"date_time"=>$cmsn_date
			);
	PrintR($data);  //die;
	$this->SqlModel->insertRecord(prefix."tbl_cmsn_daily",$data);
			 
                   }	    
							     
							    
							}
						 
						}
					}
					
					 
				unset($trans_amount,$cal_amount);
				
		 	}  
    
}					
					

	}
	
	endforeach;
			}   
			
	
	
		echo "ROI has been done <br>";
		
	}

        public function onetimerewards()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die
	    
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
          
            $QR_MEM1 = "SELECT * FROM tbl_reward";
            $RS_REW  = $this->SqlModel->runQuery($QR_MEM1);
           $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs FROM ".prefix."tbl_members AS tm where   tm.member_id in (Select member_id from tbl_subscription where date(date_from) <= '$end_date')       ORDER BY tm.member_id ASC";
		
          
              //  $QR_MEM = "SELECT member_id  FROM `tbl_members` WHERE subcription_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
       // PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
                 $user_id      = $AR_MEM['user_id'];
                    $count_direct      = $AR_MEM['count_directs'];
                     $memberdetail   = $model->getMemberdetail($member_id);
	$allincome=	$memberdetail['allincome'];
 if($allincome=='N'){ 
                    
                 foreach($RS_REW as $AR_REW){
                  $REF_BUSINESS   = $this->SqlModel->runQuery("SELECT member_id,user_id, count_directs ,rank_id, SUM(team_bv) as total FROM `tbl_members` WHERE sponsor_id =  '$member_id'  and subcription_id > 0 GROUP BY member_id ORDER BY `total` DESC  ");   
             //   PrintR($REF_BUSINESS);
       
               $A1 = 0;
               $A2 = 0;
               $B = 0;
           
                if($REF_BUSINESS)
                {
                    $k1 = 1;
                    foreach($REF_BUSINESS as $R)
                    {
                     if($k1 == 1)
                     {
                        $A1 =  $R['total'];
                     echo "<br>";
                     }
                    //  elseif($k1 == 2)
                    //  {
                    //     $A2 =  $R['total'];
                    //      echo "<br>";
                    //  }
                     else
                     {
                        $A2 +=  $R['total'];
                         echo "<br>";
                     }
                     
                     $k1++;
                    }
                }
                
// 1100000	1100000
// 3500000	4600000
// 10000000	14600000
// 30000000	44600000
// 900000000	944600000
// 270000000	1214600000
// 800000000	2014600000
// 2500000000	4514600000
// 7500000000	12014600000
// 21000000000	33014600000




                
        if($A1 >=1100000 and  $A2>= 1100000){
        echo $member_id;
        $A1_1 = 1100000;
        $A2_1  = 1100000;
        //$B_1   = 200;
        echo  "<br>";
        $rank_id = 1;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }if($A1 >=4600000 and  $A2>= 4600000){
        
        $A1_1 = 4600000;
        $A2_1  = 4600000;
        // $B_1   = 400; 
        $rank_id = 2 ;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }if($A1 >=14600000 and  $A2>= 14600000){
        
        $A1_1 = 14600000;
        $A2_1  = 14600000;
        //  $B_1   = 800; 
        $rank_id = 3;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }if($A1 >=44600000 and  $A2>= 44600000){
        
        $A1_1 = 44600000;
        $A2_1  = 44600000;
        // $B_1   = 1600; 
        $rank_id = 4 ;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }if($A1 >=944600000 and  $A2>= 944600000){
        
        $A1_1 = 944600000;
        $A2_1  = 944600000;
        //  $B_1   = 3200; 
        $rank_id = 5;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }if($A1 >=1214600000 and  $A2>= 1214600000){
        
        $A1_1 = 1214600000;
        $A2_1  = 1214600000;
        //  $B_1   = 6400; 
        $rank_id = 6;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }if($A1 >=2014600000 and  $A2>= 2014600000){
        
        $A1_1 = 2014600000;
        $A2_1  = 2014600000;
        // $B_1   = 12800; 
        $rank_id = 7 ;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }if($A1 >=4514600000 and  $A2>= 4514600000){
        
        $A1_1 = 4514600000;
        $A2_1  = 4514600000;
        //  $B_1   = 25600; 
        $rank_id = 8;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }if($A1 >=12014600000 and  $A2>= 12014600000){
        
        $A1_1 = 12014600000;
        $A2_1  = 12014600000;
        //  $B_1   = 51200; 
        $rank_id = 9;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }if($A1 >=33014600000 and  $A2>= 33014600000){
        
        $A1_1 = 33014600000;
        $A2_1  = 33014600000;
        // $B_1   = 102400; 
        $rank_id = 10 ;
        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
        
        }
            
            // if($A1 >=888750000 and  $A2>= 888750000){
            
            // $A1_1 = 444375000;
            // $A2_1  = 444375000;
            // //  $B_1   = 204800; 
            // $rank_id = 11 ;
            // $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
            
            // }if($A1 >=1888750000 and  $A2>= 1888750000){
            
            // $A1_1 = 944375000;
            // $A2_1  = 944375000;
            // //  $B_1   = 409600; 
            // $rank_id = 12 ;
            // $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
            
            // }
            
            // if($A1 >=3888750000 and  $A2>= 3888750000){
            
            // $A1_1 = 1944375000;
            // $A2_1  = 1944375000;
            // //  $B_1   = 409600; 
            // $rank_id = 13 ;
            // $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
            
            // }if($A1 >=8888750000 and  $A2>= 8888750000){
            
            // $A1_1 = 4444375000;
            // $A2_1  = 4444375000;
            // //  $B_1   = 409600; 
            // $rank_id = 14 ;
            // $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
            
            // }
            //if($A1 >=8192000 and  $A2>= 8192000){
            
            // $A1_1 = 8192000;
            // $A2_1  = 8192000;
            // //  $B_1   = 409600; 
            // $rank_id = 15 ;
            // $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
            
            // }
            
            else{
            
            $A1_1 = 0;
            $A2_1  = 0;
            $B_1   = 0;   
            
            }

                
                
                
                
                
                
                
                
                
                
                
             
                if($A1 >=$A1_1 and $A2 >=$A2_1  ){
                       
                       if(true){
                    //   if($B >=$B_1 ){
                       
                    $A_BUSS=   $A1_1+$A2_1;
                    
                    
                    //   if($B >= 200){ 
                       
                    //   $A_BUSS=   $A_BUSSA*2;
                      
                    //   }
                    
               
                 
		            if($A_BUSS >=  $AR_REW['pv'] ) 
                        {   
                          $posted_data = array(
                          'process_id'   => $process_id,  
                          'member_id'    => $member_id,
                          'reward_id'    => $rank_id ,
                          'matching_pv'  => $AR_REW['matching_pv'] ,
                          'net_income'   => $AR_REW['amount'],
                          'description'  => $AR_REW['description'],
                          'date_time'    => $end_date ,
                        //   'user_id'    => $user_id,
                        //     'A_BUSS'    => $A1 ,
                        //      'A_BUSS1'    => $A2 ,
                        //       'A_BUSS2'    => $B 
                      );
                     $dayss='30';
                     $posting_no = $model->getlifetimeCount($AR_REW['matching_pv'],$member_id);
				 	     
						//	if($posting_no  <= $dayss)							{
                     
                     // PrintR($posted_data);
                      if($rank_id>0){
                          
                           // $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");
                      }
                        
                      // $this->SqlModel->insertRecord("tbl_cmsn_reward",$posted_data); 
                    //     $rank_id = $AR_REW['reward_id'] ;
                    //  $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
                        
							//}
                        }
                    
                 }
			}
                    
                 }   
            
 }
			    
			}
		  
    } 
public function onetimerewarddistribute1()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
        
           $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs,tm.rank_id FROM ".prefix."tbl_members AS tm where   tm.rank_id >0       ORDER BY tm.member_id ASC";
		
          
              //  $QR_MEM = "SELECT member_id  FROM `tbl_members` WHERE subcription_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
      //  PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
                 $user_id      = $AR_MEM['user_id'];
                    $count_direct      = $AR_MEM['count_directs'];
                       $rank_id      = $AR_MEM['rank_id'];
                   
                    $memberdetail   = $model->getMemberdetail($member_id);
	$allincome=	$memberdetail['allincome'];
 if($allincome=='N'){ 
         
// 1100000
// 3500000
// 10000000
// 30000000
// 900000000
// 270000000
// 800000000
// 2500000000
// 7500000000
// 21000000000


                    if($rank_id==1){
                    
                    $getBussiness = 1100000;
                      $rank_id      = 1;
                      $dayss=1;
                    
                }elseif($rank_id==2){
                    
                    $getBussiness = 3500000;
                       $rank_id      = 2;
                       $dayss=1;
                    
                }elseif($rank_id==3){
                    
                   $getBussiness = 10000000;
                    $rank_id      = 3;
                    $dayss=1;
                    
                }elseif($rank_id==4){
                    
                    $getBussiness = 30000000;
                     $rank_id      = 4;
                     $dayss=1;
                    
                }elseif($rank_id==5){
                    
                    $getBussiness = 900000000;
                     $rank_id      = 5;
                     $dayss=1;
                    
                }elseif($rank_id==6){
                    
                     $getBussiness = 270000000;
                     $rank_id      = 6;
                     $dayss=1;
                    
                }elseif($rank_id==7){
                    
                   $getBussiness = 800000000;
                      $rank_id      = 7;
                      $dayss=1;
                }elseif($rank_id==8){
                    
                    $getBussiness = 2500000000;
                     $rank_id      = 8;
                     $dayss=1;
                    
                }elseif($rank_id==9){
                    
                     $getBussiness = 7500000000;
                     $rank_id      = 9;
                     $dayss=1;
                    
                }elseif($rank_id==10){
                    
                    $getBussiness = 21000000000;
                     $rank_id      = 10;
                     $dayss=1;
                    
                }
                
           
                      
                           $getreward = $model->getreward($rank_id);
                      
                        $counttt = $model->GtcountReward($member_id,$rank_id);
             
                         $exist = $model->GtExistReward($member_id,$getreward['reward_id'],$process_id);
                         
                        if($counttt < $dayss)
                      {    
                      if($exist==1)
                      {    
                            
                          $posted_data = array(
                          'process_id'   => $process_id,  
                          'member_id'    => $member_id,
                          'reward_id'    => $getreward['reward_id'] ,
                          'matching_pv'  => $getreward['matching_pv'] ,
                          'net_income'   => $getreward['amount'],
                          'description'  =>  $getreward['description'], 
                          'date_time'    => $end_date ,
                      );
                   //  PrintR($posted_data);
                        $this->SqlModel->insertRecord("tbl_cmsn_reward",$posted_data); 
                       	  
                        }
                  
			}
			    
			
			}
			
     }
		  
    } 
    public function monthlyrewarddistribute1new()    {
       		$model = new OperationModel();
       		
       	//   for($k = 31;$k <= 113;$k++)  {  		
       		
       		
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
        
           $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs,tm.rank_id FROM ".prefix."tbl_members AS tm where   tm.rank_id >0  ORDER BY tm.member_id ASC";
		
          
              //  $QR_MEM = "SELECT member_id  FROM `tbl_members` WHERE subcription_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
      //  PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
                 $user_id      = $AR_MEM['user_id'];
                    $count_direct      = $AR_MEM['count_directs'];
                       $rank_id      = $AR_MEM['rank_id'];
                   
                    $memberdetail   = $model->getMemberdetail($member_id);
	$allincome=	$memberdetail['allincome'];
 if($allincome=='N'){ 
// 110000	110000
// 350000	460000
// 10000000	10460000
// 30000000	40460000
// 100000000	140460000
// 300000000	440460000
// 900000000	1340460000
// 2600000000	3940460000
// 7200000000	11140460000
// 24000000000	35140460000

                    if($rank_id==1){
                    
                    $getBussiness = 110000;
                      $rank_id      = 1;
                      $dayss=15;
                    
                }elseif($rank_id==2){
                    
                    $getBussiness = 350000;
                       $rank_id      = 2;
                       $dayss=15;
                    
                }elseif($rank_id==3){
                    
                   $getBussiness = 10000000;
                    $rank_id      = 3;
                    $dayss=15;
                    
                }elseif($rank_id==4){
                    
                    $getBussiness = 30000000;
                     $rank_id      = 4;
                     $dayss=15;
                    
                }elseif($rank_id==5){
                    
                    $getBussiness = 100000000;
                     $rank_id      = 5;
                     $dayss=15;
                    
                }elseif($rank_id==6){
                    
                     $getBussiness = 300000000;
                     $rank_id      = 6;
                     $dayss=15;
                    
                }elseif($rank_id==7){
                    
                   $getBussiness = 900000000;
                      $rank_id      = 7;
                      $dayss=15;
                }elseif($rank_id==8){
                    
                    $getBussiness = 2600000000;
                     $rank_id      = 8;
                     $dayss=20;
                    
                }elseif($rank_id==9){
                    
                     $getBussiness = 7200000000;
                     $rank_id      = 9;
                     $dayss=20;
                    
                }elseif($rank_id==10){
                    
                    $getBussiness = 24000000000;
                     $rank_id      = 10;
                     $dayss=20;
                    
                }
          
                      
                           $getreward = $model->getreward($rank_id);
                      
                      



 $first_day_this_month   = $model->getfirstrewarddate($member_id,$rank_id);
 echo "<br>";
 
  $first_day_this_month = InsertDate($first_day_this_month);
  
   $last_day_this_month = InsertDate(AddToDate($first_day_this_month,"+30 days"));
    
  
			


                      
           $dates1 = date('d-m-Y',strtotime($today_date));  
           
           
           
$month = date("m",strtotime($dates1));  
$year = date("Y",strtotime($dates1));  
$days = date("d",strtotime($first_day_this_month));  
           
           
 echo $fdate = $model->getfirstrewarddate($member_id,$rank_id);
 
 if($fdate==''){
     
     $fdate=$end_date;
     
 }else{
     
   $fdate;  
     
 }
 
 
 
 
   $today_date = InsertDate(getLocalTime());
 
 
 
echo  $Fday = getDateFormat($fdate,"d"); 

echo "</br>";
echo  $Today = getDateFormat($end_date,"d");                




          
           
           
          $dates =$year.'-'.$month.'-'.$days; 
           
           
         $first_day_this_month1 = $dates;             
             $last_day_this_month1 = InsertDate(AddToDate($first_day_this_month1,"+30 days"));
            
                      
                      
                        $counttt = $model->GtcountRewardmonthly($member_id,$rank_id);
              echo "<br>";
              
              
                         $exist = $model->GtExistRewardmonthly($member_id,$getreward['reward_id'],$first_day_this_month1,$last_day_this_month1);
                          echo "<br>";
                       
                      if($exist ==0)
                      {    
                            if($counttt < $dayss)
                      {     
                          $posted_data = array(
                          'process_id'   => $process_id,  
                          'member_id'    => $member_id,
                          'reward_id'    => $getreward['reward_id'] ,
                          'matching_pv'  => $getreward['matching_pv'] ,
                          'net_income'   => $getreward['amount1'],
                          'description'  =>  $getreward['description'], 
                          'date_time'    => $end_date ,
                      );
                   //  PrintR($posted_data);
                   
                     if($Fday ==  $Today)
                      { 
                   
                        $this->SqlModel->insertRecord("tbl_cmsn_reward_2",$posted_data); 
                        
                      }
                       	  
                        }
                  
			}
			    
			
			}
			
     }
	
       	//   }	  
    }   
    
    
    
    
    
public function monthlyrewarddistribute1()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
        
           $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs,tm.rank_id FROM ".prefix."tbl_members AS tm where   tm.rank_id >0  ORDER BY tm.member_id ASC";
		
          
              //  $QR_MEM = "SELECT member_id  FROM `tbl_members` WHERE subcription_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
      //  PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
                 $user_id      = $AR_MEM['user_id'];
                    $count_direct      = $AR_MEM['count_directs'];
                       $rank_id      = $AR_MEM['rank_id'];
                   
                    $memberdetail   = $model->getMemberdetail($member_id);
	$allincome=	$memberdetail['allincome'];
 if($allincome=='N'){ 
         
// 250000	125000
// 500000	250000
// 1000000	500000
// 2000000	1000000
// 5000000	2500000
// 10000000	5000000
// 20000000	10000000
// 50000000	25000000
// 100000000	50000000
// 200000000	100000000
// 500000000	250000000
// 1000000000	500000000
// 2000000000	1000000000
// 5000000000	2500000000
                    if($rank_id==1){
                    
                    $getBussiness = 250000;
                      $rank_id      = 1;
                      $dayss=15;
                    
                }elseif($rank_id==2){
                    
                    $getBussiness = 500000;
                       $rank_id      = 2;
                       $dayss=15;
                    
                }elseif($rank_id==3){
                    
                   $getBussiness = 1000000;
                    $rank_id      = 3;
                    $dayss=15;
                    
                }elseif($rank_id==4){
                    
                    $getBussiness = 2000000;
                     $rank_id      = 4;
                     $dayss=15;
                    
                }elseif($rank_id==5){
                    
                    $getBussiness = 5000000;
                     $rank_id      = 5;
                     $dayss=15;
                    
                }elseif($rank_id==6){
                    
                     $getBussiness = 10000000;
                     $rank_id      = 6;
                     $dayss=15;
                    
                }elseif($rank_id==7){
                    
                   $getBussiness = 20000000;
                      $rank_id      = 7;
                      $dayss=15;
                }elseif($rank_id==8){
                    
                    $getBussiness = 50000000;
                     $rank_id      = 8;
                     $dayss=20;
                    
                }elseif($rank_id==9){
                    
                     $getBussiness = 100000000;
                     $rank_id      = 9;
                     $dayss=20;
                    
                }elseif($rank_id==10){
                    
                    $getBussiness = 200000000;
                     $rank_id      = 10;
                     $dayss=20;
                    
                }elseif($rank_id==11){
                    
                    $getBussiness = 500000000;
                     $rank_id      = 11;
                     $dayss=20;
                    
                }elseif($rank_id==12){
                    
                    $getBussiness = 1000000000;
                     $rank_id      = 12;
                     $dayss=20;
                    
                }elseif($rank_id==13){
                    
                    $getBussiness = 2000000000;
                     $rank_id      = 13;
                     $dayss=20;
                    
                }elseif($rank_id==14){
                    
                    $getBussiness = 5000000000;
                     $rank_id      = 14;
                     $dayss=20;
                    
                }
                
          
                      
                           $getreward = $model->getreward($rank_id);
                      
                      



 $first_day_this_month   = $model->getfirstrewarddate($member_id);
 echo "<br>";
 
  $first_day_this_month = InsertDate($first_day_this_month);
  
   $last_day_this_month = InsertDate(AddToDate($first_day_this_month,"+30 days"));
    
  
			


                      
           $dates1 = date('d-m-Y',strtotime($today_date));  
           
           
           
$month = date("m",strtotime($dates1));  
$year = date("Y",strtotime($dates1));  
$days = date("d",strtotime($first_day_this_month));  
           
           
           
           
           
          $dates =$year.'-'.$month.'-'.$days; 
           
           
         $first_day_this_month1 = $dates;             
             $last_day_this_month1 = InsertDate(AddToDate($first_day_this_month1,"+30 days"));
            
                      
                      
                        $counttt = $model->GtcountRewardmonthly($member_id,$rank_id);
              echo "<br>";
              
              
                         $exist = $model->GtExistRewardmonthly($member_id,$getreward['reward_id'],$first_day_this_month1,$last_day_this_month1);
                          echo "<br>";
                       
                      if($exist <1)
                      {    
                            if($counttt < $dayss)
                      {     
                          $posted_data = array(
                          'process_id'   => $process_id,  
                          'member_id'    => $member_id,
                          'reward_id'    => $getreward['reward_id'] ,
                          'matching_pv'  => $getreward['matching_pv'] ,
                          'net_income'   => $getreward['amount1'],
                          'description'  =>  $getreward['description'], 
                          'date_time'    => $end_date ,
                      );
                   //  PrintR($posted_data);
                        $this->SqlModel->insertRecord("tbl_cmsn_reward_2",$posted_data); 
                       	  
                        }
                  
			}
			    
			
			}
			
     }
		  
    } 
    
   public function metalevelIncomesontopup()              {
	    
		$model = new OperationModel();
 // for($k = 1;$k <= 105;$k++)  {
	    $AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
	    $start_date = $AR_PRSS['start_date'];
	    $end_date =$AR_PRSS['end_date'];
	    
		if($process_id>0)
		{
          $QR_MEM = "SELECT  daily_cmsn_id, subcription_id , member_id , net_income  as  prod_pv from tbl_cmsn_daily  where    process_id     = '$process_id'";
           // $QR_MEM = "select member_id,prod_pv from tbl_subscription where date_from  = '$end_date' and type='A'";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);   
			foreach($RS_MEM as $AR_MEM){
			       
				    $member_id   = $AR_MEM['member_id'];
				    $collection  = $AR_MEM['prod_pv'];
				      $memberdetail   = $model->getMemberdetail($member_id);
	$allincome=	$memberdetail['allincome'];
 if($allincome=='N'){
     
     
     
				 
                         //  $memberList = $model->memberParentLevelLists($member_id); //  memberParentLevelLists this function use direct not in first level
                      //  die;
                          $memberList = $model->memberParentLevelLists2($member_id);  //  memberParentLevelLists2 this function use direct in first level
                        echo "<br>".$member_id ;
                        if(count($memberList) > 0 )
                        {
                        $i =0;
                      
                        foreach($memberList as $list)
                        { 
                        $member_ids          = $list['member_id'];
                        $sponsor_id          = $list['sponsor_id'];
                        $count_directs       = $list['count_directs'];
                        $rank_id             = $list['rank_id'];
                        $subcription_id      = $list['subcription_id']; 
                        $team_bv             = $list['team_bv'];
                        $direct_bv           = $list['direct_bv']; 
                        
                         $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$member_ids' and member_id IN(SELECT member_id FROM tbl_subscription WHERE date(date_from) <='$end_date')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);    
$total = $PAID_DIR['total'];  
                        
                        
                        
                       $DC =   getDirectNumber($i);
                        if($i > 0 and  $i <= 20 and $subcription_id > 0 and $total >= $DC    ) // and $total >= $DC and  // direct count  $count_directs >= $i  and // levewise team business $team_bv >= $level_team and $direct_bv >=  $level_direct)
                        {
//PrintR($AR_MEM);
                          
                        $level_percentage =   returnLevelPercentagenew($i);
                         
                        $trans_amount = $collection * $level_percentage /100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                           
                           $postedData = array(   
				            "process_id"           => $process_id,
							"member_id"            => $member_ids,
							"from_member_id"       => $member_id,
							"level"                => $i,
							"type"                 => $subcription_id , 
							"returns"              => $level_percentage,
							"total_income"         => $collection,
							"net_income"           => ($trans_amount>0)? $trans_amount:0,
							"date_time"            => $end_date);
							
						//	PrintR($postedData);
			                 $this->SqlModel->insertRecord("tbl_cmsn_level",$postedData);
                        }
                        
                     
                       
                        $i++;
                        }
                        }
				    
				     
 }
				   }
				 
 
		//}
	 
  }	
	}
    
    	 public function totalcommissionnewcapping()   {
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcessMaster();
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
           // $QR_MEM = "SELECT tm.member_id, (b.net_cmsn) as binaryIncome ,  SUM(d.net_income) as directIncome, (d1.net_income) as rankIncome ,  (d2.net_income) as quickRank FROM tbl_members AS tm LEFT JOIN tbl_cmsn_binary as b on tm.member_id = b.member_id and b.process_id ='$process_id' LEFT JOIN tbl_cmsn_direct as d on tm.member_id = d.member_id and d.process_id ='$process_id' LEFT JOIN tbl_cmsn_daily as d1 on tm.member_id = d1.member_id and d1.process_id ='$process_id' LEFT JOIN tbl_cmsn_quick as d2 on tm.member_id = d2.member_id and d2.process_id ='$process_id' where   tm.subcription_id > 0 GROUP BY tm.member_id ORDER BY tm.member_id ASC";
            $QR_MEM = "SELECT tm.member_id ,tm.count_directs,tm.total_income,tm.type_id FROM tbl_members AS tm   where   tm.subcription_id > 0  GROUP BY tm.member_id ORDER BY tm.member_id ASC";
            $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
            $trns_remark = "Commission Credited";
	  	 ob_start(); 
 //PrintR($RS_MEM);die;
		foreach($RS_MEM as $AR_MEM){
		
				$member_id = $AR_MEM['member_id'];
			  $count_directs       = $AR_MEM['count_directs'];
			  $type_id      = $AR_MEM['type_id'];
			   
        $memberdetail   = $model->getMemberdetail($member_id);
        $allincome=	$memberdetail['allincome'];
 if($allincome=='N'){			   
			   
			  
              
                  $RetopupBoardincome = 0;//$model->getincomesallnewadmin1retopup($member_id,$end_date); 
               $Boardincome = 0;//$model->getincomesallnewadmin1($member_id,$end_date); 
            $binary       = 0;//$model->getbinaryamount($member_id,$process_id);
            $daily        = $model->getroiamount($member_id,$process_id);
             $commuinity        = 0;//$model->getcommunityamount($member_id,$process_id);
             $level        = $model->getLevelamount($member_id,$process_id);
            $royalty       = $model->getquickamount($member_id,$process_id);
             $club       = 0;//$model->getclubquickamount($member_id,$process_id);
             $retopperformance       = 0;//$model->getperformancequickamount($member_id,$process_id);
            $reward_1       = $model->getRewards($member_id,$process_id);  
            $reward_2        = 0;//$model->getRewards_2($member_id,$process_id);  
            $direct       = $model->getdirectamount($member_id,$process_id);
        
            
              $level  = ($level > 0 )?number_format((float)$level, 4, '.', ''):0;  
              $retopperformance  = ($retopperformance > 0 )?number_format((float)$retopperformance, 4, '.', ''):0; 
               $reward_1  = ($reward_1 > 0 )?number_format((float)$reward_1, 4, '.', ''):0; 
                  $reward_2  = ($reward_2 > 0 )?number_format((float)$reward_2, 4, '.', ''):0; 
                $commuinity  = ($commuinity > 0 )?number_format((float)$commuinity, 4, '.', ''):0;  
                $daily  = ($daily > 0 )?number_format((float)$daily, 4, '.', ''):0; 
                 $royalty  = ($royalty > 0 )?number_format((float)$royalty, 4, '.', ''):0; 
                $binary  = ($binary > 0 )?number_format((float)$binary, 4, '.', ''):0;
                 $Boardincome  = ($Boardincome > 0 )?number_format((float)$Boardincome, 4, '.', ''):0;
                    $RetopupBoardincome  = ($RetopupBoardincome > 0 )?number_format((float)$RetopupBoardincome, 4, '.', ''):0;
          $club  = ($club > 0 )?number_format((float)$club, 4, '.', ''):0;
                $direct  = ($direct > 0 )?number_format((float)$direct, 4, '.', ''):0;
        
               $AR_SUB = $model->getCurrentMemberShip($member_id);
               
           
                     echo "<br>".$member_id;
                     
                      $LDGR = $model->getCurrentBalance($member_id,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
                     
                  	 $total_withdrawal   = $model->getMemberWithdrawal($member_id);   
                $total_income       = $AR_MEM['total_income'];      
                     
            $total = number_format($daily+$level+$direct,2);  
               $total1 = number_format($level+$direct,2);  
            $getTotalMemberShipValue1 = $model->getTotalMemberShipValue($member_id); 
              // $getTotalMemberShipValue2 = $model->getTotalMemberShipValue1($member_id); 
               // $getTotalMemberShipValue3 = $model->getTotalMemberShipValue2($member_id); 
               $getTotalMemberShipValue=$getTotalMemberShipValue1+$getTotalMemberShipValue2+$getTotalMemberShipValue3;
    
    
    
    if($count_directs>=2){
             echo  $_5xincome =$getTotalMemberShipValue*200/100;
            $Income_Category='5 X';   
                
            }else{
                
              $_5xincome =$getTotalMemberShipValue*200/100;
            $Income_Category='2 X';
                
            }   
           
        
            
       $total= str_replace("," , "" , $total);
      
     if(($total>0)) {
                  
                  $flushout  = 0;
                  $netIncome = 0;
                  if(($total_income + $total1 ) <= $_5xincome) 
                  {
                      $netIncome = $total;
                      $remarks   = "Income successfully credit in your wallet.";  
                  }
                  else
                  {
                      if($total_income < $_5xincome)
                      {
                          $T1 = $_5xincome -  $total_income ;
                          if($T1 > $total1)
                          {
                            $netIncome = $level;  
                             //$netIncome = $total;  
                            $remarks   = "Income successfully credit in your wallet.";  
                          }
                          else
                          {
                            $netIncome = $T1;
                            $flushout  = $total1 - $T1;
                            $remarks   = "Income has been flushout $Income_Category limit completed.";  
                          }
                          
                            
                      }
                      else
                      {
                            $netIncome = 0;  
                             $total  = 0;
                            $flushout  = $total1;
                            $remarks   = "Your $Income_Category limit has been completed and your income has flushed out."; 
                      }
                      
                        
                  }
             
 

			  $total     = number_format((float)($total), 4, '.', '');  	 
			  $flushout  = number_format((float)($flushout), 4, '.', ''); 
             $netIncome = str_replace(",", "", $netIncome);
	          $charge = $total*0/100;

    // Prepare data for insertion
    $data_binary = [
        "member_id"      => $member_id,
        "process_id"     => $process_id,
        "level"          => $level,
        "direct"         => $direct,
        "residual"       => $daily,
        "binary"         => $binary,
        "commuinity"      => $commuinity,
        "pool"           => $Boardincome + $RetopupBoardincome,
        "bonus"          => $reward_1,
        "quick"          => $royalty,
        "bonus_2"        => $reward_2,
        "total_income"   => $total,
        "flushout"       => $flushout,
        "admin_charge"   => $charge,
        "tds"            => 0,
        "net_income"     => ($netIncome > 0) ? $netIncome : 0,
        "remarks"        => $remarks,
        "pay_sts_date"   => $end_date,
        "pay_sts"        => 'Y'
    ];

    // Print the prepared data
    PrintR($data_binary);

    // Insert income record and update wallet if netIncome is greater than 0
    $trns_remark1 = "Flush Out";

    if ($netIncome > 0) {
        // Insert record into database
        $this->SqlModel->insertRecord(prefix . "tbl_cmsn_mstr", $data_binary);

        // Add wallet transaction for income
       $model->wallet_transaction('1',"Cr",$member_id,$netIncome,$trns_remark,$end_date,$trans_no,1,"INCOME");

        // Update member's total income
      $this->db->query("UPDATE `tbl_members` SET `total_income` = total_income + $netIncome WHERE member_id = '$member_id';");
    }

    // Add wallet transaction for flushout if applicable
    if ($flushout > 0) {
       $model->wallet_transaction('7',"Cr",$member_id,$flushout,$trns_remark1,$end_date,$trans_no,1,"Flush Out");
    }
}
		  
		  
		}
		
		
			}  
			 
		
		        $new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
                $new_end_date = InsertDate(AddToDate($end_date,"+1 day"));
                $this->SqlModel->updateRecord(prefix."tbl_process_master",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
                $this->SqlModel->insertRecord(prefix."tbl_process_master",array("start_date"=>$new_start_date,"end_date"=>$new_end_date)); 
                $this->SqlModel->updateRecord(prefix."tbl_process",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
                $this->SqlModel->insertRecord(prefix."tbl_process",array("start_date"=>$new_start_date,"end_date"=>$new_end_date));    

		  
                    ob_flush();
                    flush();	 
               
			 
		
	ob_end_flush();
		return true;	
	 
	         } 

   
    	 public function totalcommissionnewcappingoldoldoldoldodlold()   {
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcessMaster();
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
           // $QR_MEM = "SELECT tm.member_id, (b.net_cmsn) as binaryIncome ,  SUM(d.net_income) as directIncome, (d1.net_income) as rankIncome ,  (d2.net_income) as quickRank FROM tbl_members AS tm LEFT JOIN tbl_cmsn_binary as b on tm.member_id = b.member_id and b.process_id ='$process_id' LEFT JOIN tbl_cmsn_direct as d on tm.member_id = d.member_id and d.process_id ='$process_id' LEFT JOIN tbl_cmsn_daily as d1 on tm.member_id = d1.member_id and d1.process_id ='$process_id' LEFT JOIN tbl_cmsn_quick as d2 on tm.member_id = d2.member_id and d2.process_id ='$process_id' where   tm.subcription_id > 0 GROUP BY tm.member_id ORDER BY tm.member_id ASC";
            $QR_MEM = "SELECT tm.member_id ,tm.count_directs,tm.total_income,tm.type_id FROM tbl_members AS tm   where   tm.subcription_id > 0  GROUP BY tm.member_id ORDER BY tm.member_id ASC";
            $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
            $trns_remark = "Commission Credited";
	  	 ob_start(); 
 //PrintR($RS_MEM);die;
		foreach($RS_MEM as $AR_MEM){
		
				$member_id = $AR_MEM['member_id'];
			  $count_directs       = $AR_MEM['count_directs'];
			  $type_id      = $AR_MEM['type_id'];
			   
        $memberdetail   = $model->getMemberdetail($member_id);
        $allincome=	$memberdetail['allincome'];
 if($allincome=='N'){			   
			   
			  
                // $binary   = $AR_MEM['binaryIncome'];
               //  $direct   = $AR_MEM['directIncome']; 
                  $RetopupBoardincome = 0;//$model->getincomesallnewadmin1retopup($member_id,$end_date); 
               $Boardincome = 0;//$model->getincomesallnewadmin1($member_id,$end_date); 
            $binary       = $model->getbinaryamount($member_id,$process_id);
            $daily        = $model->getroiamount($member_id,$process_id);
             $commuinity        = $model->getcommunityamount($member_id,$process_id);
             $level        = $model->getLevelamount($member_id,$process_id);
            $royalty       = $model->getquickamount($member_id,$process_id);
             $club       = 0;//$model->getclubquickamount($member_id,$process_id);
             $retopperformance       = 0;//$model->getperformancequickamount($member_id,$process_id);
            $reward_1        = $model->getRewards($member_id,$process_id);  
            $reward_2        = $model->getRewards_2($member_id,$process_id);  
            $direct       = $model->getdirectamount($member_id,$process_id);
        
            
              $level  = ($level > 0 )?number_format((float)$level, 2, '.', ''):0;  
              $retopperformance  = ($retopperformance > 0 )?number_format((float)$retopperformance, 2, '.', ''):0; 
               $reward_1  = ($reward_1 > 0 )?number_format((float)$reward_1, 2, '.', ''):0; 
                  $reward_2  = ($reward_2 > 0 )?number_format((float)$reward_2, 2, '.', ''):0; 
                $commuinity  = ($commuinity > 0 )?number_format((float)$commuinity, 2, '.', ''):0;  
                $daily  = ($daily > 0 )?number_format((float)$daily, 2, '.', ''):0; 
                 $royalty  = ($royalty > 0 )?number_format((float)$royalty, 2, '.', ''):0; 
                $binary  = ($binary > 0 )?number_format((float)$binary, 2, '.', ''):0;
                 $Boardincome  = ($Boardincome > 0 )?number_format((float)$Boardincome, 2, '.', ''):0;
                    $RetopupBoardincome  = ($RetopupBoardincome > 0 )?number_format((float)$RetopupBoardincome, 2, '.', ''):0;
          $club  = ($club > 0 )?number_format((float)$club, 2, '.', ''):0;
                $direct  = ($direct > 0 )?number_format((float)$direct, 2, '.', ''):0;
        
               $AR_SUB = $model->getCurrentMemberShip($member_id);
               
            //   if($AR_SUB['roi_stacking']=='S') {
                   
            //       $daily=0;
            //       $total = $level+$direct; 
                   
            //   }else{
                   
            //       $total = $level+$daily+$direct;  
            //   }
			        //$total = $direct+$level;  
                     echo "<br>".$member_id;
                     
                      $LDGR = $model->getCurrentBalance($member_id,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
                     
                  	 $total_withdrawal   = $model->getMemberWithdrawal($member_id);   
                $total_income       = $AR_MEM['total_income'];      
                     
            $total = number_format($daily+$level+$direct+$reward_1+$reward_2,2);  
            
            $getTotalMemberShipValue1 = $model->getTotalMemberShipValue($member_id); 
              // $getTotalMemberShipValue2 = $model->getTotalMemberShipValue1($member_id); 
               // $getTotalMemberShipValue3 = $model->getTotalMemberShipValue2($member_id); 
               $getTotalMemberShipValue=$getTotalMemberShipValue1+$getTotalMemberShipValue2+$getTotalMemberShipValue3;
               
           if($type_id=='4'){
               
               $_5xincome=60000;
               
               
           }elseif($type_id=='5'){
               
                  $_5xincome =$getTotalMemberShipValue*2000/100;
            $Income_Category='20 X';  
               
               
           }else{
               
               
            if($count_directs>=2){
             echo  $_5xincome =$getTotalMemberShipValue*600/100;
            $Income_Category='5 X';   
                
            }else{
                
               $_5xincome =$getTotalMemberShipValue*200/100;
            $Income_Category='2 X';
                
            }   
               
               
           }
           
           
            
            
       $total= str_replace("," , "" , $total);
      
        if(($total)) { 
            
             if(($total_income + $total ) <= $_5xincome) 
                  {
                      $netIncome = $total;
                      $remarks   = "Income successfully credit in your wallet.";  
                  }
                  else
                  {
                      if($total_income  < $_5xincome)
                      {
                          $T1 = $_5xincome -  $total_income ;
                          if($T1 > $total)
                          {
                            $netIncome = $total;  
                             $flushout  = 0;
                            $remarks   = "Income successfully credit in your wallet.";  
                          }
                          else
                          {
                            $netIncome = $T1;
                            $flushout  = $total - $T1;
                            $remarks   = "Income has been flushout $Income_Category limit completed.";  
                          }
                          
                            
                      }
                      else
                      {
                            $netIncome = 0;  
                             $total  = 0;
                             $flushout  = $total;
                            $remarks   = "Your $Income_Category limit has been completed and your income has flushed out."; 
                      }
                      
                        
                  }
             
 

			  $total     = number_format((float)($total), 4, '.', '');  	 
			  $flushout  = number_format((float)($flushout), 4, '.', ''); 
            
            
	          $charge = $total*0/100;
	       //   $echopocket = $total1*0/100;
	       //   $net = $total1 -$echopocket;
				 		       
                       $netIncome= str_replace("," , "" , $netIncome);
                   
						$data_binary =array(
                	 "member_id" => $member_id  ,
                	 "process_id" => $process_id,
                	 "level" =>$level,
                	 "direct" => $direct,
                	 "residual"=>$daily,
                	 "binary"=>$binary,
                	  "commuinity"=>$commuinity,
                	 "pool"=>$Boardincome+$RetopupBoardincome,
                	  "bonus"=>$reward_1,
                	 
                	 "quick"=>$royalty,
                	  "bonus_2"=>$reward_2,
                	
					 "total_income" => $total,
					 	 "flushout" => $flushout,
					 "admin_charge" => $charge,
				     "tds"=>  0,
                	 "net_income" => ($netIncome > 0 )?number_format($netIncome):0,
                	 
                	   "remarks"          =>  $remarks,               // Remarks
                     "pay_sts_date" =>$end_date,
                	 "pay_sts" => 'Y'
                 );
                  PrintR($data_binary); 
                  
              
               
                  
         
                            $trns_remark1 = "Flush Out";  
                             $this->SqlModel->insertRecord(prefix."tbl_cmsn_mstr",$data_binary);
                              if($netIncome > 0 )
                            {
                                
                           
                                
                                 
                      $model->wallet_transaction('1',"Cr",$member_id,$netIncome,$trns_remark,$end_date,$trans_no,1,"INCOME");   
                      
                      
                     
                      
                      
                      
                      $this->db->query("UPDATE `tbl_members` SET `total_income` =  total_income+$netIncome     WHERE member_id ='$member_id';");  
                             
                            }
                            if($flushout > 0 )
                            {
                            
               $model->wallet_transaction('7',"Cr",$member_id,$flushout,$trns_remark1,$end_date,$trans_no,1,"Flush Out");
                            }
                            
                    
        } 
		  
		  
		}
		
		
			}  
			 
		
		        $new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
                $new_end_date = InsertDate(AddToDate($end_date,"+1 day"));
                $this->SqlModel->updateRecord(prefix."tbl_process_master",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
                $this->SqlModel->insertRecord(prefix."tbl_process_master",array("start_date"=>$new_start_date,"end_date"=>$new_end_date)); 
                $this->SqlModel->updateRecord(prefix."tbl_process",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
                $this->SqlModel->insertRecord(prefix."tbl_process",array("start_date"=>$new_start_date,"end_date"=>$new_end_date));    

		  
                    ob_flush();
                    flush();	 
               
			 
		
	ob_end_flush();
		return true;	
	 
	         } 

   
     
    	 public function totalcommission()   {
    //	for($k = 1; $k<=39;$k++){	     
    	     
    	     
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcessMaster();
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
             $QR_MEM = "SELECT tm.member_id ,tm.count_directs,tm.total_income,tm.x_income  FROM tbl_members AS tm   where  tm.subcription_id > 0  GROUP BY tm.member_id ORDER BY tm.member_id ASC";
          
           // $QR_MEM = "SELECT * FROM tbl_subscription AS tm   where   tm.subcription_id > 0  and tm.`offroi` ='N'  ORDER BY tm.member_id ASC";
       
          
            $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
           
	  	 ob_start(); 
 //PrintR($RS_MEM);die;
		foreach($RS_MEM as $AR_MEM){
		
				$member_id = $AR_MEM['member_id'];
					$subcription_id = $AR_MEM['subcription_id'];
			 // $count_directs       = $AR_MEM['count_directs'];
			  	//  $x_income      = $AR_MEM['x_income'];
                // $binary   = $AR_MEM['binaryIncome'];
               //  $direct   = $AR_MEM['directIncome']; 
               
               $Boardincome = $model->getincomesallnew("Pool",$member_id); 
            $binary       = $model->getbinaryamount($member_id,$process_id);
            $daily        = $model->getroiamount($member_id,$process_id);
             $commuinity        = $model->getcommunityamount($member_id,$process_id);
             $level        = $model->getLevelamount($member_id,$process_id);
            $royalty       = $model->getquickamount($member_id,$process_id);
             $club       = $model->getclubquickamount($member_id,$process_id);
             $retopperformance       = $model->getperformancequickamount($member_id,$process_id);
            $reward_1        = $model->getRewards($member_id,$process_id);  
            $reward_2        = $model->getRewards_2($member_id,$process_id);  
            $direct       = $model->getdirectamount($member_id,$process_id);
        
            
              $level  = ($level > 0 )?number_format((float)$level, 4, '.', ''):0;  
              $retopperformance  = ($retopperformance > 0 )?number_format((float)$retopperformance, 4, '.', ''):0; 
               $reward_1  = ($reward_1 > 0 )?number_format((float)$reward_1, 4, '.', ''):0; 
                  $reward_2  = ($reward_2 > 0 )?number_format((float)$reward_2, 4, '.', ''):0; 
                $commuinity  = ($commuinity > 0 )?number_format((float)$commuinity, 4, '.', ''):0;  
                $daily  = ($daily > 0 )?number_format((float)$daily, 4, '.', ''):0; 
                 $royalty  = ($royalty > 0 )?number_format((float)$royalty, 4, '.', ''):0; 
                $binary  = ($binary > 0 )?number_format((float)$binary, 4, '.', ''):0;
                 $Boardincome  = ($Boardincome > 0 )?number_format((float)$Boardincome, 4, '.', ''):0;
          $club  = ($club > 0 )?number_format((float)$club, 4, '.', ''):0;
                $direct  = ($direct > 0 )?number_format((float)$direct, 4, '.', ''):0;
        
               $AR_SUB = $model->getCurrentMemberShip($member_id);
               
            //   if($AR_SUB['roi_stacking']=='S') {
                   
            //       $daily=0;
            //       $total = $level+$direct; 
                   
            //   }else{
                   
            //       $total = $level+$daily+$direct;  
            //   }
			        //$total = $direct+$level;  
                     echo "<br>".$member_id;
                     
                $total_income       =   $netIncome = str_replace(",", "", $AR_MEM['total_income']);      
                     
          //  $total = $commuinity+$level+$royalty+$reward_1+$club+$retopperformance+$direct+$daily;  
             $total111 = $level+$direct+$daily;  
                $total = $level+$direct; 
           $DailyIncome = $model->getincomesallnew("Daily",$member_id);   
$directIncome = $model->getincomesallnew("Direct",$member_id);
$Level = $model->getincomesallnew("Level",$member_id);
//echo $total  = $DailyIncome+$directIncome+$Level;
           
           
           
           
           
           
           
            
            $getTotalMemberShipValue = $model->getTotalMemberShipValue1($member_id); 
      	 
    
    $subcription_id =$PAID_DIRee['subcription_id'];	// die;
 
 $PAID_DIReee = "SELECT sum(x_income) as x_income,subcription_id FROM `tbl_subscription` WHERE  `member_id`='$member_id'  ORDER BY `tbl_subscription`.`subcription_id` ASC Limit 1; "; 
$PAID_DIRee = $model->SqlModel->runQuery($PAID_DIReee,true); 	

 $packageamount =$PAID_DIRee['x_income'];
$subcription_id=    $PAID_DIRee['subcription_id'];


 $PAID_DIRee22e = "SELECT sum(x_income) as x_income,subcription_id FROM `tbl_subscription` WHERE offroi='Y'  and `member_id`='$member_id'  ORDER BY `tbl_subscription`.`subcription_id` ASC; "; 
$PAID_DI333Ree = $model->SqlModel->runQuery($PAID_DIRee22e,true); 	

 $packageamount222 =0;//$PAID_DI333Ree['x_income'];

$finalpackage =  $packageamount+$packageamount222;

if($total <= $finalpackage){
 $_5xincome=   $finalpackage;
 $Income_Category= $x_income.'X'; 
}else{
    $_5xincome=   $finalpackage;
    if($total < $_5xincome){
        
     $_5xincome=   $finalpackage;
           $Income_Category= $x_income.'X';      
        
    }else{
        
        $_5xincome=   $finalpackage;
           $Income_Category= $x_income.'X';   
        
    } 
    
}
if($total<=$finalpackage){
 
 				
}else{
    
   $data_sub = array(
                "offroi"=>'Y'
               
                );

				$this->SqlModel->updateRecord(prefix."tbl_subscription",$data_sub,array("subcription_id"=>$subcription_id));   
    
}	


        
        
          
        if(($total111)) { 
            
           // $_5xincome=40000;
            $mainnn =$total_income + $total;
                 //echo $total_income; 
                //  $flushout  = 0;
                 // $netIncome = 0;
                  if($mainnn <= $_5xincome) 
                  {
                      $netIncome = $total;
                      $remarks   = "Income successfully credit in your wallet."; 
                      
                       $tempflusout =  0;//$mainnn-$_5xincome;
                        $tempincome    =  ($mainnn);
                      // $tempincome    =  ($total);
                  }
                  else
                  { 
                      $tempflusout =  $mainnn-$_5xincome;
                      
                      $netIncome =  $total-$tempflusout;
                      
                $tempincome    =  ($total);
                      
                  }
                  
                 

			  $total     = number_format((float)($total), 4, '.', '');   	 
			  $flushout  = number_format((float)($tempflusout), 4, '.', ''); 
            
	          $charge = $total*0/100;
	       //   $echopocket = $total1*0/100;
	       //   $net = $total1 -$echopocket;
				 		
					$data_binary =array(
                	 "member_id" => $member_id  ,
                	 "process_id" => $process_id,
                	 "level" =>number_format($level,4),
                	 "direct" => number_format($direct,4),
                	 "residual"=>number_format($daily,4),
                	 "binary"=>0,
                	  "commuinity"=>number_format($commuinity,4),
                	 "pool"=>0,
                	  "bonus"=>number_format($reward_1,4),
                	    "bonus_2"=>0,
                	 "quick"=>number_format($royalty,4),
                	 	 "club_income"=>number_format($club,4),
                      "performance_income"=>number_format($retopperformance,4),//$retopperformance,
                	
					 "total_income" => number_format($total,4),
					 	 "flushout" => number_format($tempflusout,4),
					 "admin_charge" => number_format($charge,4),
				     "tds"=>  0,
                	 "net_income" => number_format($netIncome,4),
                	   "remarks"          =>  $remarks,               // Remarks
                     "pay_sts_date" =>$end_date,
                	 "pay_sts" => 'Y'
                 );
                 // PrintR($data_binary); 
                  
              
                 $this->SqlModel->insertRecord(prefix."tbl_cmsn_mstr",$data_binary);
                  
         
                            $trns_remark1 = "Flush Out";  
                            
                            if($netIncome)
                            {     PrintR($data_binary);
                                 $trns_remark = "COMMISSION CREDITED'";
                $model->wallet_transaction('1',"Cr",$member_id,$netIncome-$Boardincome,$trns_remark,$end_date,$trans_no,1,"INCOME");  
                       
                       
                       
                       $netIncome=  str_replace(",", "", $netIncome);
                       
                       $this->db->query("UPDATE `tbl_members` SET `total_income` =  total_income+$netIncome     WHERE member_id ='$member_id';");  
                             
                            }
                            
                          
                            
                            if($flushout)
                            {
        
        if(false){            
                    
$PAID_DID = "SELECT x_income as x_income,subcription_id FROM `tbl_subscription` WHERE offroi='N'  and `member_id`='$member_id'  ORDER BY `tbl_subscription`.`subcription_id` ASC Limit 1; "; 
$PAID_DID = $model->SqlModel->runQuery($PAID_DID,true); 	

$subcription_id=    $PAID_DID['subcription_id'];   




$data_sub = array(
"offroi"=>'Y'

);

$this->SqlModel->updateRecord(prefix."tbl_subscription",$data_sub,array("subcription_id"=>$subcription_id));      
                    
                    
        }                 
                    
                            
                 $model->wallet_transaction('5',"Cr",$member_id,$flushout,$trns_remark1,$end_date,$trans_no,1,"INCOME");
                            }
                            
                    
        } 
                    
		 
		  
			}  
			 
		
		        $new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
                $new_end_date = InsertDate(AddToDate($end_date,"+1 day"));
                $this->SqlModel->updateRecord(prefix."tbl_process_master",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
                $this->SqlModel->insertRecord(prefix."tbl_process_master",array("start_date"=>$new_start_date,"end_date"=>$new_end_date)); 
                $this->SqlModel->updateRecord(prefix."tbl_process",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
                $this->SqlModel->insertRecord(prefix."tbl_process",array("start_date"=>$new_start_date,"end_date"=>$new_end_date));    

		  
                    ob_flush();
                    flush();	 
               
			 
    //	}
	ob_end_flush();
		return true;	
	 
	         }  
    	 public function totalcommissionold()   {
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcessMaster();
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
           // $QR_MEM = "SELECT tm.member_id, (b.net_cmsn) as binaryIncome ,  SUM(d.net_income) as directIncome, (d1.net_income) as rankIncome ,  (d2.net_income) as quickRank FROM tbl_members AS tm LEFT JOIN tbl_cmsn_binary as b on tm.member_id = b.member_id and b.process_id ='$process_id' LEFT JOIN tbl_cmsn_direct as d on tm.member_id = d.member_id and d.process_id ='$process_id' LEFT JOIN tbl_cmsn_daily as d1 on tm.member_id = d1.member_id and d1.process_id ='$process_id' LEFT JOIN tbl_cmsn_quick as d2 on tm.member_id = d2.member_id and d2.process_id ='$process_id' where   tm.subcription_id > 0 GROUP BY tm.member_id ORDER BY tm.member_id ASC";
            $QR_MEM = "SELECT tm.member_id   FROM tbl_members AS tm   where   tm.subcription_id > 0  GROUP BY tm.member_id ORDER BY tm.member_id ASC";
            $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
            $trns_remark = "Commission Credited";
	  	 ob_start(); 
 //PrintR($RS_MEM);die;
		foreach($RS_MEM as $AR_MEM){
		
				$member_id = $AR_MEM['member_id'];
			 
                // $binary   = $AR_MEM['binaryIncome'];
                 $direct   = $AR_MEM['directIncome']; 
               
                
            $binary       = $model->getbinaryamount($member_id,$process_id);
            $daily        = $model->getroiamount($member_id,$process_id);
             $commuinity        = $model->getcommunityamount($member_id,$process_id);
             $level        = $model->getLeveldailyamount($member_id,$process_id);
            $royalty       = $model->getquickamount($member_id,$process_id);
            $reward_1        = $model->getRewards($member_id,$process_id);  
            $reward_2        = $model->getRewards_2($member_id,$process_id);  
            $direct       = $model->getdirectamount($member_id,$process_id);
        
            
              $level  = ($level > 0 )?number_format((float)$level, 2, '.', ''):0;  
               $reward_1  = ($reward_1 > 0 )?number_format((float)$reward_1, 2, '.', ''):0; 
                  $reward_2  = ($reward_2 > 0 )?number_format((float)$reward_2, 2, '.', ''):0; 
                $commuinity  = ($commuinity > 0 )?number_format((float)$commuinity, 2, '.', ''):0;  
                $daily  = ($daily > 0 )?number_format((float)$daily, 2, '.', ''):0; 
                 $royalty  = ($royalty > 0 )?number_format((float)$royalty, 2, '.', ''):0; 
                $binary  = ($binary > 0 )?number_format((float)$binary, 2, '.', ''):0;
         
                $direct  = ($direct > 0 )?number_format((float)$direct, 2, '.', ''):0;
        
               $AR_SUB = $model->getCurrentMemberShip($member_id);
               
            //   if($AR_SUB['roi_stacking']=='S') {
                   
            //       $daily=0;
            //       $total = $level+$direct; 
                   
            //   }else{
                   
            //       $total = $level+$daily+$direct;  
            //   }
			        $total = $direct+$level;  
                     echo "<br>".$member_id;
            $total1 = $royalty+$reward_1+$reward_2;  
               if((true)) {
            
	          $charge = $total1*0/100;
	          $echopocket = $total1*0/100;
	          $net = $total1 -$echopocket;
				 		
					$data_binary =array(
                	 "member_id" => $member_id  ,
                	 "process_id" => $process_id,
                	 "level" =>0,
                	 "direct" => 0,
                	 "residual"=>0,
                	 "binary"=>0,
                	  "commuinity"=>0,
                	 "pool"=>0,
                	  "bonus"=>$reward_1,
                	 "quick"=>$royalty,
                	 "royalty_income" => 0,
					 "total_income" => $total1,
					 "admin_charge" => $charge,
				     "tds"=>  0,
                	 "net_income" => $net,
                     "pay_sts_date" =>$end_date,
                	 "pay_sts" => 'Y'
                 );
                 // PrintR($data_binary); 
                       $this->SqlModel->insertRecord(prefix."tbl_cmsn_mstr",$data_binary);
                            $trns_remark1 = "Echo Pocket";  
                            
                            if($net > 0 )
                            {
                               $model->wallet_transaction('1',"Cr",$member_id,$net,$trns_remark,$end_date,$trans_no,1,"INCOME");  
                               // $model->wallet_transaction('4',"Cr",$member_id,$echopocket,$trns_remark1,$end_date,$trans_no,1,"Echo Pocket");
                            }
                           
                            
                    
               
                    
		  }
		  
			}  
			 
		
		        $new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
                $new_end_date = InsertDate(AddToDate($end_date,"+1 day"));
                $this->SqlModel->updateRecord(prefix."tbl_process_master",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
                $this->SqlModel->insertRecord(prefix."tbl_process_master",array("start_date"=>$new_start_date,"end_date"=>$new_end_date)); 
                $this->SqlModel->updateRecord(prefix."tbl_process",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
                $this->SqlModel->insertRecord(prefix."tbl_process",array("start_date"=>$new_start_date,"end_date"=>$new_end_date));    

		  
                    ob_flush();
                    flush();	 
               
			 
		
	ob_end_flush();
		return true;	
	 
	         }  
	         
	/*End Closing*/    
	
	 
    
	 public function maindailyminingreturnolddddddddddddddddddddddddddddddddd()    {
		$model = new OperationModel();
 
	  	$AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		$today_date = $end_date;//InsertDate(getLocalTime());
		$cmsn_date =   InsertDate(AddToDate($today_date,"0 Day")); #InsertDate($today_date); 
		
	  $day = getDateFormat($end_date,"D"); 

		$QR_CMSN = "SELECT * FROM tbl_subscription AS ts where  DATE(ts.date_from) <=  '".$cmsn_date."' ORDER BY ts.subcription_id ASC";
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN); 
 
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN): //PrintR($AR_CMSN);
				
					$type_id = $AR_CMSN['type_id'];
			
			$stacking_days = $AR_CMSN['stacking_days'];
				    
	
					$member_id = $AR_CMSN['member_id'];
					$subcription_id = $AR_CMSN['subcription_id'];
					
					$trans_no = rand(111111,9999999);
					
					  $memberdetail   = $model->getMemberdetail($member_id);
				//	PrintR($memberdetail['count_directs']);
				$count_directs=	$memberdetail['count_directs'];
				
   $date_from = InsertDate($AR_CMSN['date_from']);				

$today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days < 72 ){

		
				if($count_directs ==1 ){
				   $dayss=300;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1;
					$cal_amount = $trans_amount*$daily_return/100;  
				}elseif($count_directs ==2){
				     $dayss=240;
				 	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.25;
					$cal_amount = $trans_amount*$daily_return/100;   
				}
				elseif($count_directs ==3){
				      $dayss=200;
				    	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.5;
					$cal_amount = $trans_amount*$daily_return/100;
				}elseif($count_directs ==4){
				      $dayss=171;
				    	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.75;
					$cal_amount = $trans_amount*$daily_return/100;
				}
				elseif($count_directs >=5){
				      $dayss=150;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =2;
					$cal_amount = $trans_amount*$daily_return/100; 
				}

}	else{
				     $dayss=912;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =0.8;
					$cal_amount = $trans_amount*$daily_return/100; 
				}
			
				 
				 
				     	
					if($member_id>0 ){
					

						$ctrl_count = $model->checkCmsnDaily($subcription_id,$member_id,$cmsn_date);
					    if($ctrl_count==0){
						
					    	$posting_no = $model->getPostingCount($subcription_id,$member_id,$cmsn_date);
				 	        $remark = "Mining Bonus - DAY NO[".$posting_no."]";
							if($posting_no  <= $dayss)
							{
					
                   if($cal_amount>0){
                 
                     //	$model->setDailyReturnIncome($subcription_id,$type_id,$member_id,$trans_no,$trans_amount,$daily_return,$cal_amount,$remark,$cmsn_date,$process_id);
                   
			 
			 	$data = array("member_id"=>$member_id,
				"subcription_id"=>$subcription_id,
				"type_id"=>$type_id,
				"trans_no"=>$trans_no,
				"trans_amount"=>$trans_amount,
				"daily_return"=>$daily_return,
				"net_income"=>$cal_amount,
				"trns_remark"=>$remark,
				"process_id"=>$process_id,
				"cmsn_date"=>$cmsn_date
			);
		//	PrintR($data);  //die;
		$this->SqlModel->insertRecord(prefix."tbl_cmsn_daily",$data);
			 
                   }	    
							     
							    
							}
						 
						}
					}
					
					 
				unset($trans_amount,$cal_amount);
				
		 
				endforeach;
			}   
			
	
	
		echo "ROI has been done <br>";
		
	}
	     public function directcommissionononearn(){
	    
		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
	    $process_idddd = $AR_PRSS['process_id'];
	 
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
         
		if($process_id>0){
	  	   //   $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,mem.sponsor_id,mem.member_id as from_member_id,mem.user_id  FROM `tbl_members` as mem LEFT JOIN tbl_subscription as tbl on mem.member_id=tbl.member_id   WHERE mem.member_id in (Select member_id from tbl_subscription where Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."' ) and tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)  and mem.sponsor_id in (Select member_id from tbl_subscription ) order by mem.member_id asc";
		
		 $QR_MEM = "SELECT member_id ,net_income as prod_pv  ,type_id ,daily_cmsn_id  from tbl_cmsn_daily  where    process_id    = '$process_idddd' group by member_id";
		  // $QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,tbl.member_id as from_member_id,tbl.type_id as type_id   FROM  tbl_subscription as tbl   WHERE Date(date_from) <= '".$end_date."'  and    tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)   order by tbl.subcription_id asc";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	 
			foreach($RS_MEM as $AR_MEM):
			    $from_member_id = $AR_MEM['member_id'];
			    $sponsor_id = $model->getSponsorId($from_member_id);
			     echo $sponsor_id."<br>";
			     $count =  $model->checkCount('tbl_subscription','member_id',$sponsor_id);
			     if($count > '0' ){
			    $subcription_id = $AR_MEM['daily_cmsn_id'];
			     $type_id = $AR_MEM['type_id'];
			    //$direct_bonus = $AR_MEM['prod_pv']*50/100;
			   // PrintR($AR_MEM);
		         $sponsortotalincome = $model->getsponsortotalroiincome($from_member_id,$process_idddd); 
		        // PrintR($sponsortotalincome);
		    if($sponsortotalincome > '0' )
		    {
				    
    	          instantIncomeGenertenonwithdarawl($from_member_id,$sponsortotalincome,$subcription_id,$type_id);
    	          
    	          
		    }
			     }
		    endforeach;
		   
		 

		}
	
	    	 
	 
	  
	}
		 public function Communityincomeup()       {
	$model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];

	 echo  $QR_CMSN = "SELECT member_id ,subcription_id,date_from,sum(prod_pv) as total ,type_id   from tbl_subscription  where type='A' and retopup='N'  and pool='N' and date_from    = '$end_date' group by member_id order by member_id  ASC";

	$RS_CMSN  = $this->SqlModel->runQuery($QR_CMSN); 
// PrintR($RS_CMSN);
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN):
			 
				 $member_id                = $AR_CMSN['member_id'];
				 $subcription_id           = $AR_CMSN['subcription_id'];
				 $date_from                = $AR_CMSN['date_from'];
				 $prod_pv                  = $AR_CMSN['total']; 
				 $type_id                  = $AR_CMSN['type_id']; 
                 
                 echo $member_id."<br>";
                				    
                $daily_return = 1;				    
                $trans_amount = $prod_pv;
                $cal_amount   = $trans_amount *$daily_return/100;   
                $cal_amount   = number_format($cal_amount, 4, '.', ''); 
				 
		   	echo "SELECT member_id FROM `tbl_subscription` WHERE `subcription_id` < '$subcription_id'  and retopup='N'  and pool='N'   LIMIT 5";
	echo "<br>";
			
				 //$GET_COMMUNITY	 	 	 		 	 			 	
	 $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id,subcription_id,prod_pv FROM `tbl_subscription` WHERE `subcription_id` < '$subcription_id'  and retopup='N' and pool='N'  ORDER BY `tbl_subscription`.`subcription_id` DESC LIMIT 5 ");   
    
                  // $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE `member_id` > '$member_id' and subcription_id    >0 group BY `member_id` LIMIT 5");   
                    
               // $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE type = 'A' AND `member_id` >  '$member_id' group by member_id  LIMIT 5");  
              
                if(count($GET_COMMUNITY)>0){   $level = 1;
                foreach($GET_COMMUNITY as $COM){
                
                  $daily_return = 1;				    
                $trans_amount = $COM['prod_pv'];
                $cal_amount   = $trans_amount *$daily_return/100;   
                $cal_amount   = number_format($cal_amount, 4, '.', ''); 
                $data = array(
                                                  "member_id"         =>  $member_id,
                                                "from_member_id"    =>  $COM['member_id'],
                                                "subcription_id"    =>  $COM['subcription_id'],
                                                "level"             =>  $level,
                                                "type"              =>  '0',
                                                 "remarks"              =>  'Joining Up',
                                                "date_time"         =>  $end_date,
                                                "total_income"            =>  $trans_amount,
                                                "returns"           =>  $daily_return,
                                                "net_income"        =>  $cal_amount,
                                                "process_id"        =>  $process_id,
                                                
                            );
                              PrintR($data);
                        $this->SqlModel->insertRecord("tbl_cmsn_community",$data);
                           $level++;
                          //  $model->insertRecord("tbl_cmsn_community",$data);
                            
                }
				  
                }
				endforeach;
			}   
			
 
		echo "Community";
		
	}
 public function Communityincomedown()       {
	$model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];

	echo $QR_CMSN = "SELECT member_id ,subcription_id,date_from,sum(prod_pv) as total ,type_id   from tbl_subscription  where type='A' and retopup='N'  and pool='N' and date_from    = '$end_date' group by member_id order by member_id  ASC";
	$RS_CMSN  = $this->SqlModel->runQuery($QR_CMSN); 
 //PrintR($RS_CMSN);
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN):
				   // PrintR($AR_CMSN);
			 
				 $member_id                = $AR_CMSN['member_id'];
				 $subcription_id           = $AR_CMSN['subcription_id'];
				 $date_from                = $AR_CMSN['date_from'];
				 $prod_pv                  = $AR_CMSN['total']; 
				 $type_id                  = $AR_CMSN['type_id']; 
                 
                 echo $member_id."<br>";
                				    
                $daily_return = 1;				    
                $trans_amount = $prod_pv;
                $cal_amount   = $trans_amount *$daily_return/100;   
                $cal_amount   = number_format($cal_amount, 4, '.', ''); 
				 
		   if($member_id <= 6){
		       
		       $flimit =0;
		        $tlimit =5;
		   }else{
		      $flimit =$member_id-6;
		        $tlimit =$member_id; 
		       
		   }
					
				 //$GET_COMMUNITY	 	 	 		 	 			 	
//	echo "SELECT member_id FROM `tbl_subscription` WHERE `member_id` < '$member_id' group BY `member_id` LIMIT $flimit,$tlimit";
	
	echo "SELECT member_id FROM `tbl_subscription` WHERE `subcription_id` > '$subcription_id'  and retopup='N'  and pool='N'   LIMIT 1,5";
	echo "<br>";
	
	 $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id,subcription_id,prod_pv FROM `tbl_subscription` WHERE `subcription_id` > '$subcription_id'  and retopup='N'  and pool='N' ORDER BY `tbl_subscription`.`subcription_id` ASC  LIMIT 10 ");   
                 
	
	
                 //  $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE `subcription_id` > '$member_id' and subcription_id >0 group BY `member_id` LIMIT $flimit,$tlimit ");   
                    
               // $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE type = 'A' AND `member_id` >  '$member_id' group by member_id  LIMIT 5");  
                $level = 1;
                if(count($GET_COMMUNITY)>0){
                foreach($GET_COMMUNITY as $COM){
                 
                  $daily_return = 1;				    
                $trans_amount = $COM['prod_pv'];
                $cal_amount   = $trans_amount *$daily_return/100;   
                $cal_amount   = number_format($cal_amount, 4, '.', ''); 
                $data = array(
                                                 "member_id"         =>  $member_id,
                                                "from_member_id"    =>  $COM['member_id'],
                                                "subcription_id"    =>  $COM['subcription_id'],
                                                "level"             =>  $level,
                                                 "type"              =>  '0',
                                                 "remarks"              =>  'Joining Down',
                                                "date_time"         =>  $end_date,
                                                "total_income"            =>  $trans_amount,
                                                "returns"           =>  $daily_return,
                                                "net_income"        =>  $cal_amount,
                                                "process_id"        =>  $process_id,
                                                
                            );
                              PrintR($data);
                       $this->SqlModel->insertRecord("tbl_cmsn_community",$data);
                          $level++;
                          //  $model->insertRecord("tbl_cmsn_community",$data);
                          
               
                            
                }
				 
                }
				endforeach;
			}   
			
 
		echo "Community";
		
	}

 public function Communityincomeretopup()       {
	$model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];

	   $QR_CMSN = "SELECT member_id ,subcription_id,date_from,sum(prod_pv) as total ,type_id   from tbl_subscription  where type='A' and retopup='N' and pool='N'  and date_from    = '$end_date' group by member_id order by member_id  ASC";

	$RS_CMSN  = $this->SqlModel->runQuery($QR_CMSN); 
// PrintR($RS_CMSN);
		 	if(count($RS_CMSN)>0){ 
				foreach($RS_CMSN as $AR_CMSN):
			 
				 $member_id                = $AR_CMSN['member_id'];
				 $subcription_id           = $AR_CMSN['subcription_id'];
				 $date_from                = $AR_CMSN['date_from'];
			//	 $prod_pv                  = $AR_CMSN['total']; 
				 $type_id                  = $AR_CMSN['type_id']; 
                 
                 echo $member_id."<br>";
               	 				    
                $daily_return = 2;				    
                $trans_amount = $prod_pv;
                $cal_amount   = $trans_amount *$daily_return/100;   
                $cal_amount   = number_format($cal_amount, 4, '.', ''); 
				 
		   
					
				 //$GET_COMMUNITY	 	 	 		 	 			 	
		 $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id,subcription_id,prod_pv FROM `tbl_subscription` WHERE `subcription_id` < '$subcription_id'  and retopup='N' and pool='N'  ORDER BY `tbl_subscription`.`subcription_id` DESC    LIMIT 10 ");   
   
                  // $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE   retopup='Y'  and pool='N' and subcription_id >0  group BY `member_id` LIMIT 5");   
                    
               // $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE type = 'A' AND `member_id` >  '$member_id' group by member_id  LIMIT 5");  
                $level = 1;
                if(count($GET_COMMUNITY)>0){
                foreach($GET_COMMUNITY as $COM){
                    $prod_pv = $model->getTotalWithdrawal($COM['member_id']);     
                    
                      if($prod_pv>0){ 
                    
                  $daily_return = 1;				    
                $trans_amount = $prod_pv;
                $cal_amount   = $trans_amount *$daily_return/100;   
                $cal_amount   = number_format($cal_amount, 4, '.', ''); 
                
                $data = array(
                                                 "member_id"         =>  $member_id,
                                                "from_member_id"    =>  $COM['member_id'],
                                                 "subcription_id"    =>  $COM['subcription_id'],
                                                "level"             =>  $level,
                                                "type"              =>  '0',
                                                 "remarks"              =>  'Withdrawal Up',
                                                "date_time"         =>  $end_date,
                                                "total_income"            =>  $trans_amount,
                                                "returns"           =>  $daily_return,
                                                "net_income"        =>  $cal_amount,
                                                "process_id"        =>  $process_id,
                                                
                            );
                              PrintR($data);
                            $this->SqlModel->insertRecord("tbl_cmsn_community",$data);
                            $level++;
                          //  $model->insertRecord("tbl_cmsn_community",$data);
                            
                }
				 
                }
		 	}
                
				endforeach;
			}   
			
 
		echo "Community";
		
	}
 public function Communityincomeretopdown()       {
	$model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];

	 $QR_CMSN = "SELECT member_id ,subcription_id,date_from,sum(prod_pv) as total ,type_id   from tbl_subscription  where type='A' and retopup='N' and pool='N' and date_from    = '$end_date' group by member_id order by member_id  ASC";
	$RS_CMSN  = $this->SqlModel->runQuery($QR_CMSN); 
 //PrintR($RS_CMSN);
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN):
				   // PrintR($AR_CMSN);
			 
				 $member_id                = $AR_CMSN['member_id'];
				 $subcription_id           = $AR_CMSN['subcription_id'];
				 $date_from                = $AR_CMSN['date_from'];
			//	 $prod_pv                  = $AR_CMSN['total']; 
				 $type_id                  = $AR_CMSN['type_id']; 
                  
                 echo $member_id."<br>";
              				    
              
				 
		   if($member_id <= 6){
		       
		       $flimit =0;
		        $tlimit =5;
		   }else{
		      $flimit =$member_id-6;
		        $tlimit =$member_id; 
		       
		   }
					
				 //$GET_COMMUNITY	 	 	 		 	 			 	
	echo "SELECT member_id FROM `tbl_subscription` WHERE `member_id` < '$member_id' group BY `member_id` LIMIT $flimit,$tlimit";
	echo "<br>";
	
		 $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id,subcription_id,prod_pv FROM `tbl_subscription` WHERE `subcription_id` > '$subcription_id'  and retopup='N'  and pool='N' ORDER BY `tbl_subscription`.`subcription_id` ASC LIMIT 5 ");   
   
	
	
	
                  // $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_members` WHERE `member_id` < '$member_id' and subcription_id >0 group BY `member_id` LIMIT $flimit,$tlimit ");   
                    
               // $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE type = 'A' AND `member_id` >  '$member_id' group by member_id  LIMIT 5");  
                $level = 1;
                if(count($GET_COMMUNITY)>0){
                foreach($GET_COMMUNITY as $COM){
                  $prod_pv = $model->getTotalMemberShipValueRTP($COM['member_id']);     
                    
                      if($prod_pv>0){
                   $daily_return = 1;				    
                $trans_amount = $prod_pv;
                $cal_amount   = $trans_amount *$daily_return/100;   
                $cal_amount   = number_format($cal_amount, 4, '.', ''); 
                
                $data = array(
                                                  "member_id"         =>  $member_id,
                                                "from_member_id"    =>  $COM['member_id'],
                                                "subcription_id"    =>  $COM['subcription_id'],
                                                "level"             =>  $level,
                                                 "type"              =>  '0',
                                                 "remarks"              =>  'Retop up Withdrawal Down',
                                                "date_time"         =>  $end_date,
                                                "total_income"            =>  $trans_amount,
                                                "returns"           =>  $daily_return,
                                                "net_income"        =>  $cal_amount,
                                                "process_id"        =>  $process_id,
                                                
                            );
                              PrintR($data);
                         $this->SqlModel->insertRecord("tbl_cmsn_community",$data);
                          $level++;
                          //  $model->insertRecord("tbl_cmsn_community",$data);
                          
               
                            
                }
				 
                }
                
		 	}
				endforeach;
			}   
			
 
		echo "Community";
		
	}

   	public function setupDirectleftRight() {
    
            $this->updateDirectSetPos('L');
            $this->updateDirectSetPos('R');
            echo " Done setupDirectleftRight"; 
    }
    
    
	 public function normalmainleveincomebypackage()                     {
	    
		$model = new OperationModel();
	    $AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
	    $start_date = $AR_PRSS['start_date'];
	    $end_date =$AR_PRSS['end_date'];
    $Admin = $model->getValue("CONFIG_ADMIN_CHARGE");
    $Tds   = $model->getValue("CONFIG_TDS");
		if($process_id>0)
		{   
		 // $QR_MEM = "select member_id,sum(prod_pv) as prod_pv from tbl_subscription where date_from  <= '$end_date' group by member_id";
		   //  $QR_MEM = "SELECT member_id ,type_id   from tbl_members  where    subcription_id >0 ";
     $QR_MEM = "SELECT member_id ,net_income as prod_pv  ,type_id   from tbl_cmsn_daily  where    process_id    = '$process_id' group by member_id";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    // PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			       $member_id   = $AR_MEM['member_id'];
			       
			       
			         
			         
	  $daily        = $model->getroiamount($member_id,$process_id);
	   // $net_income   = $AR_MEM['prod_pv'];
	      $net_income   = $daily;
		 $daily        = $net_income;//$model->getroiamount($member_id,$process_id);
			
				 
				    $collection  = $daily;
				    if($collection>0){
				    $fuSerId = $model->getMemberUserId($member_id);
                      //  $memberList = $model->memberParentLevelLists($member_id); //  memberParentLevelLists this function use direct not in first level
                        
                          $memberList = $model->memberParentLevelLists2($member_id);  //  memberParentLevelLists2 this function use direct in first level
                          
                       
                            
                           // die;
                        echo "<br>".$member_id ;
                      //  PrintR($memberList);
                        if(count($memberList) > 0 )
                        {
                        $i =0;
                      
                        foreach($memberList as $list)
                        {
                        $member_ids          = $list['member_id'];
                        $sponsor_id          = $list['sponsor_id'];
                        $count_directs       = $list['count_directs'];
                        $rank_id             = $list['rank_id'];
                        $subcription_id      = $list['subcription_id']; 
                       // PrintR($list);
                             $totalpackageamount = $model->getTotalMemberShipValue($member_id);  // Get Total Package Amount
                         


                        $bussiness       = $model->GetcurrentBussinessTotal($member_ids);
                        $self_bv = $bussiness['self_bv'];  
                        $team_bv = $bussiness['team_bv']; 
                        $direct_bv  = $bussiness['direct_bv']; 
                           PrintR($bussiness); 
                        
                            if($count_directs >= 1 and  $count_directs < 2 ){
                                $typeid=1;
                                $openlevel = 3;
                            }if($count_directs >= 2 or $count_directs >= 1000){
                             $typeid=2;
                              $openlevel = 5;
                            }if($count_directs >= 1000 or $count_directs >= 2000){
                              $openlevel = 10;
                             $typeid=2;
                            }if($count_directs >= 2000 or $count_directs  >=4000){
                              $openlevel = 15;
                             $typeid=4;
                            }if($count_directs >= 3000 or $count_directs  >= 6000 ){
                              $openlevel = 25;
                             $typeid=5;
                            }

                            
                    
                        if($i > 0 and  $i <= $openlevel and  $subcription_id > 0 )//and   $count_directs >= $T_Direct and
                        {
                        
                         
                        $level_percentage =   returnLevelPercentagenew($i);
                         // die;
                        $trans_amount = $collection * $level_percentage /100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                           
                           $postedData = array(   
				            "process_id"           => $process_id,
							"member_id"            => $member_ids,
							"from_member_id"       => $member_id,
							"level"                => $i,
							"returns"              => $level_percentage,
							"total_income"         => $collection,
							"net_income"           => ($trans_amount>0)? $trans_amount:0,
							"date_time"            => $end_date);
							
							PrintR($postedData);
							    $posting_no = $model->getlevelPostingCount1($member_id,$member_ids,$i,$collection);   
                            
                            
                            
                            
                            
                      //   if($posting_no < 1){
							
		  $this->SqlModel->insertRecord("tbl_cmsn_level",$postedData);
			          
                        // }
			                 
                        }
                        
                        
                        $i++;
                        }
                        }
				    
			}
				  
				   }
				 
 
		}
		
	}
	 public function withdrawalmainleveincomebypackage()                     {
	    
		$model = new OperationModel();
	    $AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
	    $start_date = $AR_PRSS['start_date'];
	    $end_date =$AR_PRSS['end_date'];
    $Admin = $model->getValue("CONFIG_ADMIN_CHARGE");
    $Tds   = $model->getValue("CONFIG_TDS");
		if($process_id>0)
		{   
		     $QR_MEM = "select member_id,sum(prod_pv) as prod_pv from tbl_subscription where date_from  = '$end_date' group by member_id";
           // $QR_MEM = "SELECT member_id ,net_income ,type_id   from tbl_cmsn_daily  where    process_id    = '$process_id'";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    // PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			
				    $member_id   = $AR_MEM['member_id'];
				    $prod_pv = $model->getTotalWithdrawal($member_id);     
				    
				    
				    
				    
				    
				    
				    
				    
				    
				    
				    $collection  = $prod_pv;
				    $fuSerId = $model->getMemberUserId($member_id);
                      //  $memberList = $model->memberParentLevelLists($member_id); //  memberParentLevelLists this function use direct not in first level
                        
                          $memberList = $model->memberParentLevelLists2($member_id);  //  memberParentLevelLists2 this function use direct in first level
                          
                       
                            
                           // die;
                        echo "<br>".$member_id ;
                      //  PrintR($memberList);
                        if(count($memberList) > 0 )
                        {
                        $i =0;
                      
                        foreach($memberList as $list)
                        {
                        $member_ids          = $list['member_id'];
                        $sponsor_id          = $list['sponsor_id'];
                        $count_directs       = $list['count_directs'];
                        $rank_id             = $list['rank_id'];
                        $subcription_id      = $list['subcription_id']; 
                             $totalpackageamount = $model->getTotalMemberShipValue($member_ids);  // Get Total Package Amount
                      
                            if($i <= 11)
                        {
                           
                            if($i ==1){
                                
                                 $T_Direct = 1;
                            }elseif($i==2){
                                
                               $T_Direct = 2;  
                                
                            }elseif($i==3){
                                
                               $T_Direct = 3;  
                                
                            }elseif($i==4){
                                
                               $T_Direct = 4;  
                                
                            }
                            elseif($i==5){
                                
                                 $T_Direct = 5;
                            }elseif($i==6){
                                
                                 $T_Direct = 6;
                            }elseif($i==7){
                                
                                 $T_Direct = 7;
                            }elseif($i==8){
                                
                                 $T_Direct = 8;
                            }elseif($i==9){
                                
                                  $T_Direct = 9;
                            }elseif($i==10){
                                
                                 $T_Direct = 10;
                            }else{
                                
                               $T_Direct = 10; 
                                
                            }
                            
                            // echo $i;die;
                            
                        }
                            
                       
                    
                        if($i > 0 and  $i <= 11 and  $subcription_id > 0 and   $count_directs >= $T_Direct)//and   $count_directs >= $T_Direct and
                        {
                        
                         if($collection>0){
                        $level_percentage =   returnLevelwithdrawalPercentage($i);
                         // die;
                        $trans_amount = $collection * $level_percentage /100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                           
                           $postedData = array(   
				            "process_id"           => $process_id,
							"member_id"            => $member_ids,
							"from_member_id"       => $member_id,
							"level"                => $i,
							"returns"              => $level_percentage,
							"total_income"         => $collection,
							"net_income"           => ($trans_amount>0)? $trans_amount:0,
							"date_time"            => $end_date);
							
							PrintR($postedData);
			                $this->SqlModel->insertRecord("tbl_cmsn_level",$postedData);
			                   //   $this->SqlModel->insertRecord("tbl_cmsn_level_2",$postedData);
                                // $trns_remark ="Level Income From Level $i <b> $fuSerId</b>";
                                // $total =     $trans_amount ;  
                                // $admin_charge = $total*$Admin/100;
                                // $tds_charge   = $total*$Tds/100;
                                // $net          = $total - ( $tds_charge + $admin_charge);
                                // $net          = ($net > 0 )?number_format((float)$net, 4, '.', ''):0;   
                                if($net > 0 )
                                {
                                // $model->wallet_transaction('1',"Cr",$member_ids,$net,$trns_remark,$end_date,$trans_no,1,"INCOME-LEVEL ROI");    
                                }
                        }
                        }
                        
                        
                        $i++;
                        }
                        }
				    
				     
				  
				   }
				 
 
		}
		
	}
	 public function retopupmainleveincomebypackage()                     {
	    
		$model = new OperationModel();
	    $AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
	    $start_date = $AR_PRSS['start_date'];
	    $end_date =$AR_PRSS['end_date'];
    $Admin = $model->getValue("CONFIG_ADMIN_CHARGE");
    $Tds   = $model->getValue("CONFIG_TDS");
		if($process_id>0)
		{   
		     $QR_MEM = "select member_id,sum(prod_pv) as prod_pv from tbl_subscription where retopup='Y' and date_from  = '$end_date' group by member_id";
           // $QR_MEM = "SELECT member_id ,net_income ,type_id   from tbl_cmsn_daily  where    process_id    = '$process_id'";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    // PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			
				    $member_id   = $AR_MEM['member_id'];
				    $collection  = $AR_MEM['prod_pv'];
				    $fuSerId = $model->getMemberUserId($member_id);
                      //  $memberList = $model->memberParentLevelLists($member_id); //  memberParentLevelLists this function use direct not in first level
                        
                          $memberList = $model->memberParentLevelLists2($member_id);  //  memberParentLevelLists2 this function use direct in first level
                          
                        
                         
                           // die;
                        echo "<br>".$member_id ;
                      //  PrintR($memberList);
                        if(count($memberList) > 0 )
                        {
                        $i =0;
                      
                        foreach($memberList as $list)
                        {
                        $member_ids          = $list['member_id'];
                        $sponsor_id          = $list['sponsor_id'];
                        $count_directs       = $list['count_directs'];
                        $rank_id             = $list['rank_id'];
                        $subcription_id      = $list['subcription_id']; 
                          $totalpackageamount1 = $model->getTotalMemberShipValueTLevelretopup($member_id);  // Get Total Package Amount
                                $totalpackageamount = $model->getTotalMemberShipValue($member_id);  // Get Total Package Amount
                        if($i <= 12)
                        {
                            
                            
                            if($totalpackageamount >= 20 and $totalpackageamount <= 100 ){
                                $typeid=1;
                                $openlevel = 2;
                            }elseif($totalpackageamount >= 120 and $totalpackageamount <= 500 ){
                             $typeid=2;
                              $openlevel = 4;
                            }elseif($totalpackageamount >= 520 and $totalpackageamount <= 1000 ){
                              $openlevel = 6;
                             $typeid=2;
                            }elseif($totalpackageamount >= 1020 and $totalpackageamount <= 2500 ){
                              $openlevel = 9;
                             $typeid=4;
                            }elseif($totalpackageamount >= 2520 and $totalpackageamount <= 5000 ){
                              $openlevel = 12;
                             $typeid=5;
                            }

                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            //   if($typeid ==1){echo $openlevel = 3;}
                            //   if($typeid ==2){echo $openlevel = 4; }
                            //   if($typeid ==2){$openlevel = 6; }
                            //   if($typeid ==4){ $openlevel = 9;}
                            //   if($typeid ==5){$openlevel = 12;}
                            
                           
                       // if($typeid >= $openlevel){
                              
                           //  echo $typeid."=>".$openlevel;
                             //echo "<br>";
                              
                              
                        //  }
                            
                        }
                    
                        if($i > 0 and  $i <= $openlevel and  $subcription_id > 0)//and   $count_directs >= $T_Direct and
                        {
                        
                         
                        $level_percentage =   returnLevelPercentage($i);
                         // die;
                        $trans_amount = $collection * $level_percentage /100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                           
                           $postedData = array(   
				            "process_id"           => $process_id,
							"member_id"            => $member_id,
							"from_member_id"       => $member_ids,
							"level"                => $i,
							"returns"              => $level_percentage,
							"total_income"         => $collection,
							"net_income"           => ($trans_amount>0)? $trans_amount:0,
							"date_time"            => $end_date);
							
							PrintR($postedData);
			                $this->SqlModel->insertRecord("tbl_cmsn_level",$postedData);
			                   //   $this->SqlModel->insertRecord("tbl_cmsn_level_2",$postedData);
                                // $trns_remark ="Level Income From Level $i <b> $fuSerId</b>";
                                // $total =     $trans_amount ;  
                                // $admin_charge = $total*$Admin/100;
                                // $tds_charge   = $total*$Tds/100;
                                // $net          = $total - ( $tds_charge + $admin_charge);
                                // $net          = ($net > 0 )?number_format((float)$net, 4, '.', ''):0;   
                                if($net > 0 )
                                {
                                // $model->wallet_transaction('1',"Cr",$member_ids,$net,$trns_remark,$end_date,$trans_no,1,"INCOME-LEVEL ROI");    
                                }
                        }
                        
                        
                        $i++;
                        }
                        }
				    
				     
				  
				   }
				 
 
		}
		
	}

      
         public function retopupperformance_1() {
$model = new OperationModel();
$AR_PRSS = $model->getProcess(1);
$process_id = $AR_PRSS['process_id']; 
  $start_date=$AR_PRSS['start_date'];
$end_date=$AR_PRSS['end_date'];   
    
    $today_date = InsertDate(getLocalTime());
    
    
    
        $dates = date('d-m-Y',strtotime($today_date));  
        $first_day_this_month = date('Y-m-01',strtotime($end_date)); 
        
        $last_day_this_month  = date('Y-m-t',strtotime($end_date));
    
    

    
    
    $QR_MEM  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where retopup ='Y' and type='U'  and Date(date_from) BETWEEN '".$first_day_this_month."' AND '".$last_day_this_month."'"; 
    
    $RS_REW  = $this->SqlModel->runQuery($QR_MEM,true);
  //  PrintR($RS_REW);
  echo  $TOTAL   = ($RS_REW['total'] > 0 ) ? $RS_REW['total'] : 0 ;
  echo "<br>";
    
    if($TOTAL > 0 )
    {
        $ROYALTY_1 =  number_format($TOTAL *0.5/100, 4, '.', '');
        
        $QR_MEM1  = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.retop_id = '1' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_1  = $this->SqlModel->runQuery($QR_MEM1,true);   
        $ROYAL_1     = $RS_ROYAL_1['total'];
                
       
        
        $ROYALTY_i   =  number_format($ROYALTY_1 / $ROYAL_1, 4, '.', '');
       

        
$QR_MEM = "SELECT tm.member_id,tm.retop_id FROM tbl_members AS tm where tm.retop_id  =1 and tm.member_id in (Select member_id from tbl_subscription)    ORDER BY tm.member_id ASC ";
$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);

foreach($RS_MEM as $AR_MEM){
 
		$member_id     = $AR_MEM['member_id'];
        $royalty_id    = $AR_MEM['retop_id'];
         
            if($royalty_id == 1)
            {
                    $trans_amount  =  $ROYALTY_1; 
                    $daily_return  =  0.5; 
                    $net_income    =  $ROYALTY_i; 
            }
            
            else
            { 
                    $trans_amount  =  0; 
                    $daily_return  =  0; 
                    $net_income    =  0; 
            }
                  
                  $posted_data = array(
                  'process_id'    => $process_id,  
                  'member_id'     => $member_id,
                  'type_id'       => 0 ,
                    'rank_id'       => $royalty_id ,
                  'trans_amount'  => $trans_amount ,
                  'daily_return'  => $daily_return,
                  'net_income'    => $net_income,
                  'date_time'     => $end_date ,
                  'cmsn_date'     => $end_date ,
              );
              
               PrintR($posted_data); 
              if($net_income > 0 )
              {
                  
               
        if($dates==$last_day_this_month){
        $posted_data1 = array(
        'total_turnover'    => $trans_amount,  
          'rank_id'       => $royalty_id ,
        'date_time'     => $today_date,
        );
        
        $this->SqlModel->insertRecord(prefix."tbl_cmsn_turnover_club",$posted_data1); 
        
        }     

                  
                  
                  
                    $t=date('d-m-Y');
$day = date("d",strtotime($t));  
//	PrintR($day);die;
//	if($day == 07) {  
                  
                  
                  
                  
                  
                  
                  
                  
                 $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick_performance",$posted_data); 
                   
                   
//	}
              }
           
           	 		 		 	 		

		
            
         }
        
        
        
        
	}  
       

 	

     }   
public function retopupperformance_2() {
$model = new OperationModel();
$AR_PRSS = $model->getProcess(1);
$process_id = $AR_PRSS['process_id']; 
  $start_date=$AR_PRSS['start_date'];
$end_date=$AR_PRSS['end_date'];   
    
    $today_date = InsertDate(getLocalTime());
    
    
    
        $dates = date('d-m-Y',strtotime($today_date));  
        $first_day_this_month = date('Y-m-01',strtotime($end_date)); 
        
        $last_day_this_month  = date('Y-m-t',strtotime($end_date));
    
    

    
    
    $QR_MEM  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where retopup ='Y' and type='U' and Date(date_from) BETWEEN '".$first_day_this_month."' AND '".$last_day_this_month."'"; 
    
    $RS_REW  = $this->SqlModel->runQuery($QR_MEM,true);
  //  PrintR($RS_REW);
  echo  $TOTAL   = ($RS_REW['total'] > 0 ) ? $RS_REW['total'] : 0 ;
  echo "<br>";
    
    if($TOTAL > 0 )
    {
        $ROYALTY_1 =  number_format($TOTAL *0.75/100, 4, '.', '');
        
                  
        $QR_MEM2     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.retop_id_2 = '2' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_2  = $this->SqlModel->runQuery($QR_MEM2,true);   
        $ROYAL_2     = $RS_ROYAL_2['total'];
        
      
        
       
        $ROYALTY_ii  =  number_format($ROYALTY_1 / $ROYAL_2, 4, '.', '');
        

        
$QR_MEM = "SELECT tm.member_id,tm.retop_id FROM tbl_members AS tm where tm.retop_id_2 = '2' and tm.member_id in (Select member_id from tbl_subscription)    ORDER BY tm.member_id ASC ";
$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);

foreach($RS_MEM as $AR_MEM){
 
		$member_id     = $AR_MEM['member_id'];
        $royalty_id    = $AR_MEM['retop_id_2'];
         
           if($royalty_id ==2)
            {
                    $trans_amount  =  $ROYALTY_1; 
                    $daily_return  =  1; 
                    $net_income    =  $ROYALTY_ii; 
            }
          
            else
            { 
                    $trans_amount  =  0; 
                    $daily_return  =  0; 
                    $net_income    =  0; 
            }
                  
                  $posted_data = array(
                  'process_id'    => $process_id,  
                  'member_id'     => $member_id,
                  'type_id'       => 0 ,
                    'rank_id'       => $royalty_id ,
                  'trans_amount'  => $trans_amount ,
                  'daily_return'  => $daily_return,
                  'net_income'    => $net_income,
                  'date_time'     => $end_date ,
                  'cmsn_date'     => $end_date ,
              );
              
               PrintR($posted_data); 
              if($net_income > 0 )
              {
                  
               
        if($dates==$last_day_this_month){
        $posted_data1 = array(
        'total_turnover'    => $trans_amount,  
          'rank_id'       => $royalty_id ,
        'date_time'     => $today_date,
        );
        
        $this->SqlModel->insertRecord(prefix."tbl_cmsn_turnover_club",$posted_data1); 
        
        }     

                  
                  
                  
                    $t=date('d-m-Y');
$day = date("d",strtotime($t));  
//	PrintR($day);die;
//	if($day == 07) {  
                  
                  
                  
                  
                  
                  
                  
                  
                   $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick_performance",$posted_data); 
                   
                   
//	}
              }
           
           	 		 		 	 		

		
            
         }
        
        
        
        
	}  
       

 	

     }   
public function retopupperformance_3() {
$model = new OperationModel();
$AR_PRSS = $model->getProcess(1);
$process_id = $AR_PRSS['process_id']; 
  $start_date=$AR_PRSS['start_date'];
$end_date=$AR_PRSS['end_date'];   
    
    $today_date = InsertDate(getLocalTime());
    
    
    
        $dates = date('d-m-Y',strtotime($today_date));  
        $first_day_this_month = date('Y-m-01',strtotime($end_date)); 
        
        $last_day_this_month  = date('Y-m-t',strtotime($end_date));
    
    

    
    
    $QR_MEM  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where retopup ='Y' and type='U' and Date(date_from) BETWEEN '".$first_day_this_month."' AND '".$last_day_this_month."'"; 
    
    $RS_REW  = $this->SqlModel->runQuery($QR_MEM,true);
  //  PrintR($RS_REW);
  echo  $TOTAL   = ($RS_REW['total'] > 0 ) ? $RS_REW['total'] : 0 ;
  echo "<br>";
    
    if($TOTAL > 0 )
    {
        $ROYALTY_1 =  number_format($TOTAL *1.5/100, 4, '.', '');
        
        
        $QR_MEM3     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.retop_id_3 = '3' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_3  = $this->SqlModel->runQuery($QR_MEM3,true);   
        $ROYAL_3     = $RS_ROYAL_3['total'];
        
      
        
        
       
        $ROYALTY_iii =  number_format($ROYALTY_1 / $ROYAL_3, 4, '.', '');
        
        
$QR_MEM = "SELECT tm.member_id,tm.retop_id_3 FROM tbl_members AS tm where  tm.retop_id = '3' and tm.member_id in (Select member_id from tbl_subscription)    ORDER BY tm.member_id ASC ";
$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);

foreach($RS_MEM as $AR_MEM){
 
		$member_id     = $AR_MEM['member_id'];
        $royalty_id    = $AR_MEM['retop_id_3'];
         
            if($royalty_id == 3)
            {
                    $trans_amount  =  $ROYALTY_1; 
                    $daily_return  =  1; 
                    $net_income    =  $ROYALTY_iii; 
            }
            
            else
            { 
                    $trans_amount  =  0; 
                    $daily_return  =  0; 
                    $net_income    =  0; 
            }
                  
                  $posted_data = array(
                  'process_id'    => $process_id,  
                  'member_id'     => $member_id,
                  'type_id'       => 0 ,
                    'rank_id'       => $royalty_id ,
                  'trans_amount'  => $trans_amount ,
                  'daily_return'  => $daily_return,
                  'net_income'    => $net_income,
                  'date_time'     => $end_date ,
                  'cmsn_date'     => $end_date ,
              );
              
               PrintR($posted_data); 
              if($net_income > 0 )
              {
                  
               
        if($dates==$last_day_this_month){
        $posted_data1 = array(
        'total_turnover'    => $trans_amount,  
          'rank_id'       => $royalty_id ,
        'date_time'     => $today_date,
        );
        
       $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick_performance",$posted_data1); 
        
        }     

                  
                  
                  
                    $t=date('d-m-Y');
$day = date("d",strtotime($t));  
//	PrintR($day);die;
//	if($day == 07) {  
                  
                  
                  
                  
                  
                  
                  
                  
                   $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick_club",$posted_data); 
                   
                   
//	}
              }
           
           	 		 		 	 		

		
            
         }
        
        
        
        
	}  
       

 	

     }   
public function retopupperformance_4() {
$model = new OperationModel();
$AR_PRSS = $model->getProcess(1);
$process_id = $AR_PRSS['process_id']; 
  $start_date=$AR_PRSS['start_date'];
$end_date=$AR_PRSS['end_date'];   
    
    $today_date = InsertDate(getLocalTime());
    
    
    
        $dates = date('d-m-Y',strtotime($today_date));  
        $first_day_this_month = date('Y-m-01',strtotime($end_date)); 
        
        $last_day_this_month  = date('Y-m-t',strtotime($end_date));
    
    

    
    
    $QR_MEM  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where retopup ='Y' and type='U' and Date(date_from) BETWEEN '".$first_day_this_month."' AND '".$last_day_this_month."'"; 
    
    $RS_REW  = $this->SqlModel->runQuery($QR_MEM,true);
  //  PrintR($RS_REW);
  echo  $TOTAL   = ($RS_REW['total'] > 0 ) ? $RS_REW['total'] : 0 ;
  echo "<br>";
    
    if($TOTAL > 0 )
    {
        $ROYALTY_1 =  number_format($TOTAL *1.25/100, 4, '.', '');
        
      
        
         $QR_MEM4     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.retop_id_4 = '4' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_4  = $this->SqlModel->runQuery($QR_MEM4,true);   
        $ROYAL_4     = $RS_ROYAL_4['total'];
        
       
        
       
        $ROYALTY_iv =  number_format($ROYALTY_1 / $ROYAL_4, 4, '.', '');
       

        
$QR_MEM = "SELECT tm.member_id,tm.retop_id_4 FROM tbl_members AS tm where tm.retop_id = '4' and tm.member_id in (Select member_id from tbl_subscription)    ORDER BY tm.member_id ASC ";
$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);

foreach($RS_MEM as $AR_MEM){
 
		$member_id     = $AR_MEM['member_id'];
        $royalty_id    = $AR_MEM['retop_id_4'];
         
            if($royalty_id == 4)
            {
                    $trans_amount  =  $ROYALTY_1; 
                    $daily_return  = 1; 
                    $net_income    =  $ROYALTY_iv; 
            }
            
            else
            { 
                    $trans_amount  =  0; 
                    $daily_return  =  0; 
                    $net_income    =  0; 
            }
                  
                  $posted_data = array(
                  'process_id'    => $process_id,  
                  'member_id'     => $member_id,
                  'type_id'       => 0 ,
                    'rank_id'       => $royalty_id ,
                  'trans_amount'  => $trans_amount ,
                  'daily_return'  => $daily_return,
                  'net_income'    => $net_income,
                  'date_time'     => $end_date ,
                  'cmsn_date'     => $end_date ,
              );
              
               PrintR($posted_data); 
              if($net_income > 0 )
              {
                  
               
        if($dates==$last_day_this_month){
        $posted_data1 = array(
        'total_turnover'    => $trans_amount,  
          'rank_id'       => $royalty_id ,
        'date_time'     => $today_date,
        );
        
       $this->SqlModel->insertRecord(prefix."tbl_cmsn_turnover_club",$posted_data1); 
        
        }     

                  
                  
                  
                    $t=date('d-m-Y');
$day = date("d",strtotime($t));  
//	PrintR($day);die;
//	if($day == 07) {  
                  
                  
                  
                  
                  
                  
                  
                  
                   $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick_performance",$posted_data); 
                   
                   
//	}
              }
           
           	 		 		 	 		

		
            
         }
        
        
        
        
	}  
       

 	

     } 
    
   public function retopupperformance()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
          
            $QR_MEM1 = "SELECT * FROM tbl_reward";
            $RS_REW  = $this->SqlModel->runQuery($QR_MEM1);
          echo $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs FROM ".prefix."tbl_members AS tm where   tm.member_id in (Select member_id from tbl_subscription where retopup ='N' and date(date_from) = '$end_date'   and tm.count_directs >= 3  and tm.self_bv >= 500  )       ORDER BY tm.member_id ASC";
		
          
              //  $QR_MEM = "SELECT member_id  FROM `tbl_members` WHERE subcription_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
       // PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
                 $user_id      = $AR_MEM['user_id'];
                    $count_direct      = $AR_MEM['count_directs'];
                 foreach($RS_REW as $AR_REW){
                  $REF_BUSINESS   = $this->SqlModel->runQuery("SELECT member_id,user_id, count_directs ,rank_id, SUM(self_bv+team_bv) as total FROM `tbl_members` WHERE sponsor_id =  '$member_id'  and subcription_id > 0 GROUP BY member_id ORDER BY `total` DESC  ");   
              //  PrintR($REF_BUSINESS);
       
               $A1 = 0;
               $A2 = 0;
               $B = 0;
           
                if($REF_BUSINESS)
                {
                    $k1 = 1;
                    foreach($REF_BUSINESS as $R)
                    {
                     if($k1 == 1)
                     {
                        $A1 =  $R['total'];
                   //  echo "<br>";
                     }elseif($k1 == 2)
                     {
                        $A2 =  $R['total'];
                         //echo "<br>";
                     }
                     else
                     {
                        $B +=  $R['total'];
                        // echo "<br>";
                     }
                     
                     $k1++;
                    }
                }
   
            if($count_direct >= 3 and $count_direct < 5){
                
                if($A1 >=200 and  $A2>= 150 and  $B >= 150){
                     echo $member_id;
                   $A1_1 = 200;
                   $A2_1  = 150;
                   $B_1   = 150;
                  // echo  "<br>";
                     $rank_id = 1;
                     
                    $this->db->query("UPDATE `tbl_members` SET  `retop_id` =  $rank_id WHERE member_id ='$member_id';");	 
                    
                }
            }   
            
             if($count_direct >= 5 and $count_direct < 8){
                if($A1 >=400 and  $A2>= 300 and  $B >= 300){
                    
                   $A1_1 = 400;
                   $A2_1  = 300;
                   $B_1   = 300; 
                     $rank_id = 2 ;
                    $this->db->query("UPDATE `tbl_members` SET  `retop_id` =  $rank_id  WHERE member_id ='$member_id';");	 
                    
                }
             }   
                if($count_direct >= 8 and $count_direct < 12){ 
                if($A1 >=1000 and  $A2>= 750 and  $B >= 750){
                    
                   $A1_1 = 1000;
                   $A2_1  = 750;
                   $B_1   = 750; 
                     $rank_id = 3;
                     $this->db->query("UPDATE `tbl_members` SET  `retop_id` =  $rank_id WHERE member_id ='$member_id';");	 
                    
                }
                
                }
                
                 if($count_direct >= 12){
                if($A1 >=2000 and  $A2>= 1500 and  $B >= 1500){
                    
                   $A1_1 = 2000;
                   $A2_1  = 1500;
                   $B_1   = 1500; 
                     $rank_id = 4 ;
                    $this->db->query("UPDATE `tbl_members` SET  `retop_id` =  $rank_id WHERE member_id ='$member_id';");	 
                    
                }
                
                 }
                
                
                
                
                
                
                
                
                
                
                
                
             
                if($A1 >=$A1_1 and $A2 >=$A2_1  ){
                       
                       if($B >=$B_1 ){
                       
                    $A_BUSS=   $A1_1+$A2_1+$B_1;
                    echo "<br>";
                    
                    //   if($B >= 200){ 
                       
                    //   $A_BUSS=   $A_BUSSA*2;
                      
                    //   }
                    
               
                 
		            if($A_BUSS >=  $AR_REW['pv'] ) 
                        {   
                          $posted_data = array(
                          'process_id'   => $process_id,  
                          'member_id'    => $member_id,
                          'reward_id'    => $rank_id ,
                          'matching_pv'  => $AR_REW['matching_pv'] ,
                          'net_income'   => $AR_REW['amount'],
                          'description'  => $AR_REW['description'],
                          'date_time'    => $end_date ,
                        //   'user_id'    => $user_id,
                        //     'A_BUSS'    => $A1 ,
                        //      'A_BUSS1'    => $A2 ,
                        //       'A_BUSS2'    => $B 
                      );
                     $dayss='30';
                    // $posting_no = $model->getlifetimeCount($AR_REW['matching_pv'],$member_id);
				 	     
						//	if($posting_no  <= $dayss)							{
                     
                      PrintR($posted_data);
                        
                      // $this->SqlModel->insertRecord("tbl_cmsn_reward",$posted_data); 
                    //     $rank_id = $AR_REW['reward_id'] ;
                    //  $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	 
                        
							//}
                        }
                    
                 }
			}
                    
                 }   
            
			    
			    
			}
		  
    } 
    
      public function retopuprewarddistribute1()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
          
           $today_date = InsertDate(getLocalTime());
    
    
    
        $dates = date('d-m-Y',strtotime($today_date));  
        $first_day_this_month = date('Y-m-01',strtotime($end_date)); 
        
        $last_day_this_month  = date('Y-m-t',strtotime($end_date));
    
          
            $QR_MEM1  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where retopup ='Y' and type='U' and  date(date_from) = date('$end_date')"; 
    
    $RS_REW  = $this->SqlModel->runQuery($QR_MEM1,true);
  //  PrintR($RS_REW);
    $TOTAL   = ($RS_REW['total'] > 0 ) ? $RS_REW['total'] : 0 ;
          
          $QR_MEM41     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.retop_id = '1' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_41  = $this->SqlModel->runQuery($QR_MEM41,true);   
        $ROYAL_41     = $RS_ROYAL_41['total'];
        
        
          $QR_MEM42     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.retop_id = '2' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_42  = $this->SqlModel->runQuery($QR_MEM42,true);   
        $ROYAL_42     = $RS_ROYAL_42['total'];
        
          $QR_MEM43     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.retop_id = '3' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_43  = $this->SqlModel->runQuery($QR_MEM43,true);   
        $ROYAL_43     = $RS_ROYAL_43['total'];
        
          $QR_MEM44     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.retop_id = '4' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_44  = $this->SqlModel->runQuery($QR_MEM44,true);   
        $ROYAL_44     = $RS_ROYAL_44['total'];
          
          
          
              
          
          
          
          
          
          
           $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs,tm.retop_id FROM ".prefix."tbl_members AS tm where   tm.retop_id >0       ORDER BY tm.member_id ASC";
		
          
               $QR_MEM = "SELECT member_id,retop_id  FROM `tbl_members` WHERE retop_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
       // PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
              
                      $rank_id      = $AR_MEM['retop_id'];
                  
         
// 1000
// 2000
// 4000
// 8000
// 16000
// 32000
// 64000
// 128000
// 256000
// 512000
// 1024000
// 2048000
// 4096000
// 8192000
// 16384000

         
                      
              if($rank_id==1){
                    
                    $getBussiness = 500;
                   $daily_return=0.5;
                   $ROYALTY_i =  number_format($TOTAL *0.5/100, 4, '.', '');
                    $ROYALTY_1   =  number_format($ROYALTY_i / $ROYAL_41, 4, '.', '');
                }elseif($rank_id==2){
                    
                    $getBussiness = 1000;
                    $daily_return=0.75;
                   $ROYALTY_ii =  number_format($TOTAL *0.75/100, 4, '.', '');
                      $ROYALTY_1  =  number_format($ROYALTY_ii / $ROYAL_42, 4, '.', '');
                }elseif($rank_id==3){
                    
                   $getBussiness = 2500;
                    $daily_return=1;
                   $ROYALTY_iii =  number_format($TOTAL *1/100, 4, '.', '');
                     $ROYALTY_1 =  number_format($ROYALTY_iii / $ROYAL_43, 4, '.', '');
                }elseif($rank_id==4){
                    
                    $getBussiness = 5000;
                    $daily_return=1.25;
                   $ROYALTY_iv =  number_format($TOTAL *1.25/100, 4, '.', '');
                   $ROYALTY_1 =  number_format($ROYALTY_iv / $ROYAL_44, 4, '.', '');
                    
                }else{
                    
                  $getBussiness = 0;
                   
                    
                }
                
                
                              
                      
                      
             if($ROYALTY_1>0){         
                    
                 $bussiness       = $model->GetcurrentBussinessTotal($member_id);
               
            //   PrintR($bussiness['self_bv']);die;
          
          
              
                      
                  $posted_data = array(
                  'process_id'    => $process_id,  
                  'member_id'     => $member_id,
                  'type_id'       => 0 ,
                    'rank_id'       => $rank_id ,
                     'self'     => $bussiness['self_bv'] ,
                      'team'     => $bussiness['team_bv'] ,
                  'trans_amount'  => $TOTAL ,
                  'daily_return'  => $daily_return,
                  'net_income'    => $ROYALTY_1,
                  'date_time'     => $end_date ,
                  'cmsn_date'     => $end_date ,
              );
                  
                 PrintR($posted_data);     
              $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick_performance",$posted_data);          
                      
             }           
                      
                      
    
			
			
     }
		  
    }  
  
    
    

  
      public function clubtopuplifetimerewards()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
          
     
     		$QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs,tm.club_id,tm.self_bv  FROM ".prefix."tbl_members AS tm where   tm.member_id in (Select member_id from tbl_subscription where date(date_from) = '$end_date'       group BY tm.member_id  )      ";
		
          
              //  $QR_MEM = "SELECT member_id  FROM `tbl_members` WHERE subcription_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
     //  PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
                 $user_id      = $AR_MEM['user_id'];
                    $count_direct      = $AR_MEM['count_directs'];
          $self_bv      = $AR_MEM['self_bv'];
			      if($self_bv >=500 and  $self_bv < 1000){
                     echo $member_id;
                  
                  // echo  "<br>";
                     $rank_id = 1;
                   $member_iddd=  $member_id;
                   $this->db->query("UPDATE `tbl_members` SET  `club_id` =  $rank_id WHERE member_id ='$member_id';");  
                    
                }
                   if($self_bv >=1000 and  $self_bv < 2500){
                     echo $member_id;
                  
                  // echo  "<br>";
                     $rank_id = 2;
                   $member_iddd=  $member_id;
                   $this->db->query("UPDATE `tbl_members` SET  `club_id` =  $rank_id WHERE member_id ='$member_id';");  
                    
                }
                   if($self_bv >=2500 and  $self_bv < 5000){
                     echo $member_id;
                  
                  // echo  "<br>";
                     $rank_id = 3;
                   $member_iddd=  $member_id;
                   $this->db->query("UPDATE `tbl_members` SET  `club_id` =  $rank_id WHERE member_id ='$member_id';");  
                    
                }
                   if($self_bv >=5000){
                     echo $member_id;
                  
                  // echo  "<br>";
                     $rank_id = 4;
                   $member_iddd=  $member_id;
                   $this->db->query("UPDATE `tbl_members` SET  `club_id` =  $rank_id WHERE member_id ='$member_id';");  
                    
                }
			}
		  
    }
      public function clubrewarddistribute1()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
          
           $today_date = InsertDate(getLocalTime());
    
    
    
        $dates = date('d-m-Y',strtotime($today_date));  
        $first_day_this_month = date('Y-m-01',strtotime($end_date)); 
        
        $last_day_this_month  = date('Y-m-t',strtotime($end_date));
    
          
            $QR_MEM1  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where retopup ='N'   and date(date_from) = '$end_date' "; 
    
    $RS_REW  = $this->SqlModel->runQuery($QR_MEM1,true);
  //  PrintR($RS_REW);
    $TOTAL   = ($RS_REW['total'] > 0 ) ? $RS_REW['total'] : 0 ;
          
          $QR_MEM41     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.club_id = '1' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_41  = $this->SqlModel->runQuery($QR_MEM41,true);   
        $ROYAL_41     = $RS_ROYAL_41['total'];
        
        
          $QR_MEM42     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.club_id = '2' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_42  = $this->SqlModel->runQuery($QR_MEM42,true);   
        $ROYAL_42     = $RS_ROYAL_42['total'];
        
          $QR_MEM43     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.club_id = '3' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_43  = $this->SqlModel->runQuery($QR_MEM43,true);   
        $ROYAL_43     = $RS_ROYAL_43['total'];
        
          $QR_MEM44     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.club_id = '4' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_44  = $this->SqlModel->runQuery($QR_MEM44,true);   
        $ROYAL_44     = $RS_ROYAL_44['total'];
          
          
          
              
          
          
          
          
          
          
          // $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs,tm.club_id FROM ".prefix."tbl_members AS tm where   tm.club_id >0       ORDER BY tm.member_id ASC";
		
          
               $QR_MEM = "SELECT member_id,club_id,club_id_2,club_id_3,club_id_4  FROM `tbl_members` WHERE club_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
        PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
              
                      $rank_id1      = $AR_MEM['club_id'];
                      $rank_id2      = $AR_MEM['club_id'];
             $rank_id3      = $AR_MEM['club_id'];
                 $rank_id4      = $AR_MEM['club_id'];
// 1000
// 2000
// 4000
// 8000
// 16000
// 32000
// 64000
// 128000
// 256000
// 512000
// 1024000
// 2048000
// 4096000
// 8192000
// 16384000

         
                      
              if($rank_id1==1){
                    $rank_id = $rank_id1;
                    $getBussiness = 500;
                   $daily_return=0.25;
                   $ROYALTY_i =  number_format($TOTAL *$daily_return/100, 4, '.', '');
                    $ROYALTY_1   =  number_format($ROYALTY_i / $ROYAL_41, 4, '.', '');
                }if($rank_id2==2){
                    $rank_id = $rank_id2;
                    $getBussiness = 1000;
                    $daily_return=0.50;
                   $ROYALTY_ii =  number_format($TOTAL *$daily_return/100, 4, '.', '');
                      $ROYALTY_1  =  number_format($ROYALTY_ii / $ROYAL_42, 4, '.', '');
                }if($rank_id3==3){
                    $rank_id = $rank_id3;
                   $getBussiness = 2500;
                    $daily_return=0.75;
                   $ROYALTY_iii =  number_format($TOTAL *$daily_return/100, 4, '.', '');
                     $ROYALTY_1 =  number_format($ROYALTY_iii / $ROYAL_43, 4, '.', '');
                }if($rank_id4==4){
                    $rank_id = $rank_id4;
                    $getBussiness = 5000;
                    $daily_return=1.5;
                   $ROYALTY_iv =  number_format($TOTAL *$daily_return/100, 4, '.', '');
                   $ROYALTY_1 =  number_format($ROYALTY_iv / $ROYAL_44, 4, '.', '');
                    
                }
                
                // else{
                    
                //   $getBussiness = 0;
                   
                    
                // }
                
                
                              
                      
                      
             if($TOTAL>0){         
                    
              
               
               
          
          
              
                      
                  $posted_data = array(
                  'process_id'    => $process_id,  
                  'member_id'     => $member_id,
                  'type_id'       => 0 ,
                    'rank_id'       => $rank_id ,
                  'trans_amount'  => $TOTAL ,
                  'daily_return'  => $daily_return,
                  'net_income'    => $ROYALTY_1,
                  'date_time'     => $end_date ,
                  'cmsn_date'     => $end_date ,
              );
                  
                 PrintR($posted_data);     
              $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick_club",$posted_data);          
                      
             }           
                      
                      
    
			
			
     }
		  
    }  

        public function royaltytopuplifetimerewards()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
          
     
     		$QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs,tm.club_id,tm.self_bv  FROM ".prefix."tbl_members AS tm where   tm.member_id in (Select member_id from tbl_subscription where date(date_from) = '$end_date'   and tm.count_directs >= 3     group BY tm.member_id  )      ";
		
          
              //  $QR_MEM = "SELECT member_id  FROM `tbl_members` WHERE subcription_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
     //  PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
                 $user_id      = $AR_MEM['user_id'];
                    $count_direct      = $AR_MEM['count_directs'];
          $self_bv      = $AR_MEM['self_bv'];
           $direct_bv      = $AR_MEM['direct_bv'];
			      if($self_bv >=500 and  $self_bv < 1000){
                     echo $member_id;
                  
                  // echo  "<br>";
                     $rank_id = 1;
                   $member_iddd=  $member_id;
                   $this->db->query("UPDATE `tbl_members` SET  `royalty_id` =  $rank_id WHERE member_id ='$member_id';");  
                    
                }
                   if($self_bv >=1000 and  $self_bv < 2000){
                     echo $member_id;
                  
                  // echo  "<br>";
                     $rank_id = 2;
                   $member_iddd=  $member_id;
                   $this->db->query("UPDATE `tbl_members` SET  `royalty_id` =  $rank_id WHERE member_id ='$member_id';");  
                    
                }
                   if($self_bv >=2000 and  $self_bv < 5000){
                     echo $member_id;
                  
                  // echo  "<br>";
                     $rank_id = 3;
                   $member_iddd=  $member_id;
                   $this->db->query("UPDATE `tbl_members` SET  `royalty_id` =  $rank_id WHERE member_id ='$member_id';");  
                    
                }
                   if($self_bv >=5000){
                     echo $member_id;
                  
                  // echo  "<br>";
                     $rank_id = 4;
                   $member_iddd=  $member_id;
                   $this->db->query("UPDATE `tbl_members` SET  `royalty_id` =  $rank_id WHERE member_id ='$member_id';");  
                    
                }
			}
		  
    }
      public function royaltyrewarddistribute1()    {
       		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime()); // PrintR($today_date);die;
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
          
           $today_date = InsertDate(getLocalTime());
    
    
    
        $dates = date('d-m-Y',strtotime($today_date));  
        $first_day_this_month = date('Y-m-01',strtotime($end_date)); 
        
        $last_day_this_month  = date('Y-m-t',strtotime($end_date));
    
          
            $QR_MEM1  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where retopup ='N'   and date(date_from) = '$end_date' "; 
    
    $RS_REW  = $this->SqlModel->runQuery($QR_MEM1,true);
  //  PrintR($RS_REW);
    $TOTAL   = ($RS_REW['total'] > 0 ) ? $RS_REW['total'] : 0 ;
          
          $QR_MEM41     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '1' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_41  = $this->SqlModel->runQuery($QR_MEM41,true);   
        $ROYAL_41     = $RS_ROYAL_41['total'];
        
        
          $QR_MEM42     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '2' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_42  = $this->SqlModel->runQuery($QR_MEM42,true);   
        $ROYAL_42     = $RS_ROYAL_42['total'];
        
          $QR_MEM43     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '3' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_43  = $this->SqlModel->runQuery($QR_MEM43,true);   
        $ROYAL_43     = $RS_ROYAL_43['total'];
        
          $QR_MEM44     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '4' and tm.member_id in (Select member_id from tbl_subscription)";
        $RS_ROYAL_44  = $this->SqlModel->runQuery($QR_MEM44,true);   
        $ROYAL_44     = $RS_ROYAL_44['total'];
          
          
          
              
          
          
          
          
          
          
          // $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id,tm.count_directs,tm.club_id FROM ".prefix."tbl_members AS tm where   tm.club_id >0       ORDER BY tm.member_id ASC";
		
          
               $QR_MEM = "SELECT member_id,royalty_id  FROM `tbl_members` WHERE royalty_id > 0  ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
        PrintR($RS_MEM);
			foreach($RS_MEM as $AR_MEM){
			    
                $member_id      = $AR_MEM['member_id'];
              
                      $rank_id1      = $AR_MEM['royalty_id'];
                      $rank_id2      = $AR_MEM['royalty_id'];
             $rank_id3      = $AR_MEM['royalty_id'];
                 $rank_id4      = $AR_MEM['royalty_id'];
// 1000
// 2000
// 4000
// 8000
// 16000
// 32000
// 64000
// 128000
// 256000
// 512000
// 1024000
// 2048000
// 4096000
// 8192000
// 16384000

         
                      
              if($rank_id1==1){
                    $rank_id = $rank_id1;
                    $getBussiness = 500;
                   $daily_return=0.50;
                   $ROYALTY_i =  number_format($TOTAL *$daily_return/100, 4, '.', '');
                    $ROYALTY_1   =  number_format($ROYALTY_i / $ROYAL_41, 4, '.', '');
                }if($rank_id2==2){
                    $rank_id = $rank_id2;
                    $getBussiness = 1000;
                    $daily_return=1;
                   $ROYALTY_ii =  number_format($TOTAL *$daily_return/100, 4, '.', '');
                      $ROYALTY_1  =  number_format($ROYALTY_ii / $ROYAL_42, 4, '.', '');
                }if($rank_id3==3){
                    $rank_id = $rank_id3;
                   $getBussiness = 2000;
                    $daily_return=1.5;
                   $ROYALTY_iii =  number_format($TOTAL *$daily_return/100, 4, '.', '');
                     $ROYALTY_1 =  number_format($ROYALTY_iii / $ROYAL_43, 4, '.', '');
                }if($rank_id4==4){
                    $rank_id = $rank_id4;
                    $getBussiness = 5000;
                    $daily_return=1.5;
                   $ROYALTY_iv =  number_format($TOTAL *$daily_return/100, 4, '.', '');
                   $ROYALTY_1 =  number_format($ROYALTY_iv / $ROYAL_44, 4, '.', '');
                    
                }
                
                // else{
                    
                //   $getBussiness = 0;
                   
                    
                // }
                
                
                              
                      
                      
             if($TOTAL>0){         
                    
              
               
               
          
          
              
                      
                  $posted_data = array(
                  'process_id'    => $process_id,  
                  'member_id'     => $member_id,
                  'type_id'       => 0 ,
                    'rank_id'       => $rank_id ,
                  'trans_amount'  => $TOTAL ,
                  'daily_return'  => $daily_return,
                  'net_income'    => $ROYALTY_1,
                  'date_time'     => $end_date ,
                  'cmsn_date'     => $end_date ,
              );
                  
                 PrintR($posted_data);     
              $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick",$posted_data);          
                      
             }           
                      
                      
    
			
			
     }
		  
    }  
     
     
		          
   // Setup Royalty Users 
  public function royaltyUsersSetup() {
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
            
          

	    $QR_MEM = "SELECT tm.member_id,tm.count_directs, royalty_id,direct_bv,prod_pv FROM tbl_members AS tm where  tm.member_id in (Select member_id from tbl_subscription  where  date_from    = '$end_date')   ORDER BY tm.member_id ASC ";
		$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);

	    foreach($RS_MEM as $AR_MEM){
		 
				$member_id      = $AR_MEM['member_id'];
				$royalty_id     = $AR_MEM['royalty_id'];
		        $count_directs  = $AR_MEM['count_directs'];
		         $direct_bv  = $AR_MEM['direct_bv'];
		          $prod_pv  = $AR_MEM['prod_pv'];
		        
		        if($prod_pv == 30)
		        {
		            $r_id = 1;
		        }
		        elseif($prod_pv == 60)
		        {
		            $r_id = 2;
		        }
                elseif($prod_pv == 120)
                {
                    $r_id = 3;
                }
		        elseif($prod_pv == 240)
		        {
		            $r_id = 4;
		        }
		         elseif($prod_pv == 480)
		        {
		            $r_id = 5;
		        }
		        else
		        {
		            $r_id = 0;
		        }
		        if($r_id > $royalty_id )
		        {
		           $this->db->query("UPDATE `tbl_members` SET `royalty_id` =  $r_id  WHERE member_id ='$member_id';");	    
		        }
		         
                
			}  
			 
			 
		 	
	 
	         } 
 	         
	         
  public function royaltyOnCTO_all() {
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
            
            $QR_MEM1  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where  date(date_from) = date('$end_date')";
            $RS_REW1  = $this->SqlModel->runQuery($QR_MEM1,true);
            $TOTAL1   = ($RS_REW1['total'] > 0 ) ? $RS_REW1['total'] : 0 ;
            
            
         
            if($TOTAL1 > 0 )
            {
                $ROYALTY_1 =  number_format($TOTAL1 *5/100, 0, '.', '');
               
                
              //  $QR_MEM1  = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '1' and tm.member_id in (Select member_id from tbl_subscription)";
                $QR_MEM1  = "SELECT count(tm.member_id) as total FROM tbl_members AS tm where tm.member_id in (Select member_id from tbl_subscription where `date_from`<= '$end_date') ORDER BY tm.member_id ASC; ";
                $RS_ROYAL_1  = $this->SqlModel->runQuery($QR_MEM1,true);   
                $ROYAL_1     = $RS_ROYAL_1['total'];
                
                
                 // $ROYALTY_i   =  number_format($ROYALTY_1 / $ROYAL_1, 4, '.', '');
               
                  
 
           $QR_MEM = "SELECT  member_id,prod_pv from tbl_subscription  where  date_from    <= '$end_date'  group by member_id ";      
       // $QR_MEM = "SELECT tm.member_id,tm.royalty_id FROM tbl_members AS tm where tm.royalty_id  > '0' and tm.member_id in (Select member_id from tbl_subscription)    ORDER BY tm.member_id ASC ";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);

	    foreach($RS_MEM as $AR_MEM){  //PrintR($AR_MEM);
		 
				$member_id     = $AR_MEM['member_id'];
		        $prod_pv    = $AR_MEM['prod_pv'];
		         
                    if($prod_pv >=10)
                    {
                            $trans_amount  =  $ROYALTY_1; 
                            $daily_return  =  5;//$ROYAL_1; 
                            $net_income    =  $ROYALTY_1; 
                             $TOTAL         = $ROYALTY_1;
                    }
                   
                   
                    // else
                    // { 
                    //         $trans_amount  =  0; 
                    //         $daily_return  =  0; 
                    //         $net_income    =  0;
                    //         $TOTAL         = 0;     
                    // }
                          
                          $posted_data = array(
                          'process_id'    => $process_id,  
                          'member_id'     => $member_id,
                          'type_id'       => $prod_pv ,
                          'trans_amount'  => $TOTAL ,
                          'daily_return'  => $daily_return,
                          'net_income'    => $net_income,
                          'date_time'     => $end_date ,
                          'cmsn_date'     => $end_date ,
                      );
                      
                     PrintR($posted_data);
                      if($net_income > 0 )
                      {
                    // $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick",$posted_data);
                           
                        	$trns_remark = "Infinity Vault";
			
         $model->wallet_transaction('5',"Cr",$member_id,$net_income,$trns_remark,$end_date,rand(),1,$trns_remark);     
                           
                           
                      }
                   
                   	 		 		 	 		
	 
				
                    
                 }
                
                
                
                
			}  
               
       
		 	
	 
	         } 	         
	    
 public function royaltyOnCTOoldddddddddd() {
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
            
            $QR_MEM1  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where  prod_pv='30' and  date(date_from) = date('$end_date')";
            $RS_REW1  = $this->SqlModel->runQuery($QR_MEM1,true);
            $TOTAL1   = ($RS_REW1['total'] > 0 ) ? $RS_REW1['total'] : 0 ;
            
            $QR_MEM2  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where    prod_pv='60' and date(date_from) = date('$end_date')";
            $RS_REW2  = $this->SqlModel->runQuery($QR_MEM2,true);
            $TOTAL2   = ($RS_REW2['total'] > 0 ) ? $RS_REW2['total'] : 0 ;
           
            $QR_MEM3  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where   prod_pv='120' and  date(date_from) = date('$end_date')";
            $RS_REW3  = $this->SqlModel->runQuery($QR_MEM3,true);
            $TOTAL3   = ($RS_REW3['total'] > 0 ) ? $RS_REW3['total'] : 0 ;
           
            $QR_MEM4  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where    prod_pv='240' and date(date_from) = date('$end_date')";
            $RS_REW4  = $this->SqlModel->runQuery($QR_MEM4,true);
            $TOTAL4   = ($RS_REW4['total'] > 0 ) ? $RS_REW4['total'] : 0 ;
           
            $QR_MEM5  = "SELECT SUM(prod_pv) as total  FROM tbl_subscription where   prod_pv='480' and  date(date_from) = date('$end_date')";
            $RS_REW5  = $this->SqlModel->runQuery($QR_MEM5,true);
            $TOTAL5   = ($RS_REW5['total'] > 0 ) ? $RS_REW5['total'] : 0 ;
            
            if($TOTAL > 0 )
            {
                $ROYALTY_1 =  number_format($TOTAL1 *5/100, 4, '.', '');
                $ROYALTY_2 =  number_format($TOTAL2 *4/100, 4, '.', '');
                $ROYALTY_3 =  number_format($TOTAL3 *3/100, 4, '.', '');
                $ROYALTY_4 =  number_format($TOTAL4 *2/100, 4, '.', '');
                $ROYALTY_5 =  number_format($TOTAL5 *1/100, 4, '.', '');
               
                
                $QR_MEM1  = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '1' and tm.member_id in (Select member_id from tbl_subscription)";
                $RS_ROYAL_1  = $this->SqlModel->runQuery($QR_MEM1,true);   
                $ROYAL_1     = $RS_ROYAL_1['total'];
                
                $QR_MEM2     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '2' and tm.member_id in (Select member_id from tbl_subscription)";
                $RS_ROYAL_2  = $this->SqlModel->runQuery($QR_MEM2,true);   
                $ROYAL_2     = $RS_ROYAL_2['total'];
                
               $QR_MEM3  = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '3' and tm.member_id in (Select member_id from tbl_subscription)";
                $RS_ROYAL_3  = $this->SqlModel->runQuery($QR_MEM3,true);   
                $ROYAL_3     = $RS_ROYAL_3['total'];
                
                $QR_MEM4     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '4' and tm.member_id in (Select member_id from tbl_subscription)";
                $RS_ROYAL_4  = $this->SqlModel->runQuery($QR_MEM4,true);   
                $ROYAL_4     = $RS_ROYAL_4['total'];
                
                $QR_MEM5     = "SELECT COUNT(tm.member_id) as total FROM tbl_members AS tm where tm.royalty_id = '5' and tm.member_id in (Select member_id from tbl_subscription)";
                $RS_ROYAL_5  = $this->SqlModel->runQuery($QR_MEM5,true);   
                $ROYAL_5     = $RS_ROYAL_5['total'];
                
                  $ROYALTY_i   =  number_format($ROYALTY_1 / $ROYAL_1, 4, '.', '');
                $ROYALTY_ii  =  number_format($ROYALTY_2 / $ROYAL_2, 4, '.', '');
                $ROYALTY_iii =  number_format($ROYALTY_3 / $ROYAL_3, 4, '.', '');
                $ROYALTY_iv =  number_format($ROYALTY_4 / $ROYAL_4, 4, '.', '');
                $ROYALTY_v =  number_format($ROYALTY_5 / $ROYAL_5, 4, '.', '');
                  
 
                
        $QR_MEM = "SELECT tm.member_id,tm.royalty_id FROM tbl_members AS tm where tm.royalty_id  > '0' and tm.member_id in (Select member_id from tbl_subscription)    ORDER BY tm.member_id ASC ";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);

	    foreach($RS_MEM as $AR_MEM){ 
		 
				$member_id     = $AR_MEM['member_id'];
		        $royalty_id    = $AR_MEM['royalty_id'];
		         
                    if($royalty_id == 1)
                    {
                            $trans_amount  =  $ROYALTY_1; 
                            $daily_return  =  5;//$ROYAL_1; 
                            $net_income    =  $ROYALTY_i; 
                             $TOTAL         = $TOTAL1;
                    }
                    elseif($royalty_id ==2)
                    {
                            $trans_amount  =  $ROYALTY_2; 
                            $daily_return  =  4;//$ROYAL_2; 
                            $net_income    =  $ROYALTY_ii; 
                             $TOTAL         = $TOTAL2;
                    }
                    elseif($royalty_id ==3)
                    {
                            $trans_amount  =  $ROYALTY_2; 
                            $daily_return  =  3;//$ROYAL_2; 
                            $net_income    =  $ROYALTY_iii; 
                             $TOTAL         = $TOTAL3;
                    }
                    elseif($royalty_id ==4)
                    {
                            $trans_amount  =  $ROYALTY_2; 
                            $daily_return  =  2;//$ROYAL_2; 
                            $net_income    =  $ROYALTY_iv; 
                             $TOTAL         = $TOTAL4;
                    }
                    elseif($royalty_id ==5)
                    {
                            $trans_amount  =  $ROYALTY_2; 
                            $daily_return  =  1;//$ROYAL_2; 
                            $net_income    =  $ROYALTY_v; 
                             $TOTAL         = $TOTAL5;
                    }
                   
                    else
                    { 
                            $trans_amount  =  0; 
                            $daily_return  =  0; 
                            $net_income    =  0;
                            $TOTAL         = 0;     
                    }
                          
                          $posted_data = array(
                          'process_id'    => $process_id,  
                          'member_id'     => $member_id,
                          'type_id'       => $royalty_id ,
                          'trans_amount'  => $TOTAL ,
                          'daily_return'  => $daily_return,
                          'net_income'    => $net_income,
                          'date_time'     => $end_date ,
                          'cmsn_date'     => $end_date ,
                      );
                      
                     // PrintR($posted_data);
                      if($net_income > 0 )
                      {
                           $this->SqlModel->insertRecord(prefix."tbl_cmsn_quick",$posted_data); 
                      }
                   
                   	 		 		 	 		
	 
				
                    
                 }
                
                
                
                
			}  
               
       
		 	
	 
	         } 	
	
	
public function poolincomeeee(){
$model = new OperationModel();
$today_date = InsertDate(getLocalTime());
$AR_PRSS = $model->getProcess();
$process_id = $AR_PRSS['process_id'];


$start_date=$AR_PRSS['start_date'];
$end_date=$AR_PRSS['end_date'];

if($process_id>0){


$QR_MEM = "SELECT tbl.subcription_id,tbl.prod_pv,tbl.member_id as from_member_id   FROM  tbl_subscription as tbl   WHERE Date(date_from) BETWEEN '2019-02-15' AND '".$end_date."'  and    tbl.subcription_id not in (Select subcription_id from tbl_cmsn_direct)   order by tbl.subcription_id asc";


$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
// PrintR($AR_MEM);die;
foreach($RS_MEM as $AR_MEM){

$package_price=$AR_MEM['prod_pv'];
$member_id=$AR_MEM['member_id'];








$Q = $this->SqlModel->runQuery("SELECT member_id,spill_id,position,t_count FROM `tbl_level_members` WHERE amount ='$package_price' ORDER BY id DESC LIMIT 1",true);      
$t_count    = $Q['t_count'];
$spill_id   = $Q['spill_id'];
$position   = $Q['position'];
$pos        = ($position >1)?1:2;

if($position >1)
{
$Q21 = $this->SqlModel->runQuery("SELECT id FROM `tbl_level_members` WHERE amount ='$package_price' and  id > '$spill_id' LIMIT 1",true);  
$spill_id   = $Q21['id'];

}




$pool = array(
"member_id"       =>$member_id,
"spill_id"        =>$spill_id,
"ref_id"          =>$subcription_id,
"position"        =>$pos,
"t_count"         =>"1",
"entry_type"      =>"A",
"amount"          =>$package_price,
"date_time"       =>date('Y-m-d H:i:s')
);
$this->SqlModel->insertRecord("tbl_level_members",$pool);   
if($pos == 2 )
{

if($package_price==30){ $bprice=1;	 }elseif($package_price==60){ $bprice=2;}elseif($package_price==120){ $bprice=4;
}elseif($package_price==240){ $bprice=8;}elseif($package_price==420){ $bprice=16;}
$trans_no = rand();
$trns_remark = "Board Income for [ $package_price ] ";




$SP = $this->SqlModel->runQuery("SELECT id,ref_id,member_id,spill_id,position,t_count FROM `tbl_level_members` WHERE id ='$spill_id' ORDER BY id DESC LIMIT 1",true);       

$slot = $SP['t_count'];
$Remark = "Pool Income ".$SP['t_count']." Income Credit";
$model->wallet_transaction(1,'Cr',$SP['member_id'],$bprice,$Remark,date('Y-m-d'),rand(),'1',"Pool");   
if($SP['t_count']+1 <= 4)
{
$Q22 = $this->SqlModel->runQuery("SELECT id FROM `tbl_level_members` WHERE amount ='$package_price' and  id > '$spill_id' LIMIT 1",true);  
$spill_id   = $Q22['id'];
$pool = array(
"member_id"       =>$SP['member_id'],
"spill_id"        =>$spill_id,
"position"        =>1,
"t_count"         =>$SP['t_count']+1,
"entry_type"      =>"U",
"ref_id"          =>$SP['ref_id'],
"amount"          =>$package_price,
"date_time"       =>date('Y-m-d')
);
$this->SqlModel->insertRecord("tbl_level_members",$pool);    
}


}  

}

}
}
    

	

public function bordreturnsallboard()
    {  
          
    $this->bordreturn1();
    $this->bordreturn2();
    $this->bordreturn3();
    $this->bordreturn4();
    $this->bordreturn5();
   // $this->bordreturn6();
  
    } 


    
       public function bordreturn1(){
          $model = new OperationModel();  
          $Q_MEM =  'SELECT member_id,subcription_id FROM `tbl_members` WHERE subcription_id >0';
        $RS_MEM = $this->SqlModel->runQuery($Q_MEM);   
      
          foreach($RS_MEM as $AR_MEM){
          
   $AR_TYPE  = $model->getCurrentMemberShip($AR_MEM['member_id']);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $AR_MEM['member_id'];
  $POOL = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members` WHERE `member_id` = '$memberid'  AND `amount` ='10' ORDER BY  id  ASC");    

                         
                           if($POOL) { 
                               $i=1;
                          foreach($POOL as $P) { 
                      //    PrintR($P);
                          $S1 = $model->getPoolUserId($P['id'] , 1);
                          $S2 = $model->getPoolUserId($P['id'] , 2);
                         // PrintR($P);
                         
                         
                         
         if($S2 !='') {
         
            
         
         }else{
         
if($P['member_id']>=1){ 
    
    
 if($i==1){
    $date_from;
   $days_30 =InsertDate(AddToDate($date_from,"+30 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 30 ){
    
    	$P_Count = $model->getPostingCountboard('1','1','10',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    
    
    
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'10',
                                                    "board_no"=>'1',
                                                    "slot_no"=>1,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
//	$Remark = "Board Income 1 Income Credit";
	 $Remark = "Pool $ 10 Slot 1 Credit";
$model->wallet_transaction(1,'Cr',$memberid,1,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

				 	        
    
				 	        }
    
    
}
     
 }if($i==2){
     
     $days_60 =InsertDate(AddToDate($date_from,"+60 Day")); 
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 60 ){
    	$P_Count = $model->getPostingCountboard('1','2','10',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'10',
                                                    "board_no"=>'1',
                                                    "slot_no"=>2,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
    	 $Remark = "Pool $ 10 Slot 2 Credit";
$model->wallet_transaction(1,'Cr',$memberid,2,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
				 	        }
    
    
    
    
}    
 }if($i==3){
     $days_90 =InsertDate(AddToDate($date_from,"+90 Day"));   
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 90 ){
    	$P_Count = $model->getPostingCountboard('1','3','10',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'10',
                                                    "board_no"=>'1',
                                                    "slot_no"=>3,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											
											 $Remark = "Pool $ 10 Slot 3 Credit";
$model->wallet_transaction(1,'Cr',$memberid,3,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
				 	        }
    
    
    
    
    
}   
     
 }if($i==4){
     
   $days_120 =InsertDate(AddToDate($date_from,"+120 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 120 ){
    	$P_Count = $model->getPostingCountboard('1','4','10',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'10',
                                                    "board_no"=>'1',
                                                    "slot_no"=>4,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											 $Remark = "Pool $ 10 Slot 4 Credit";
$model->wallet_transaction(1,'Cr',$memberid,4,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
    
				 	        }
    
    
} 

 }if($i==5){
     
   $days_150 =InsertDate(AddToDate($date_from,"+150 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 150 ){
    	$P_Count = $model->getPostingCountboard('1','5','10',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'10',
                                                    "board_no"=>'1',
                                                    "slot_no"=>5,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											 $Remark = "Pool $ 10 Slot 5 Credit";
$model->wallet_transaction(1,'Cr',$memberid,5,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
				 	        }
    
    
    
} 

 }if($i==6){
     
   $days_180 =InsertDate(AddToDate($date_from,"+180 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 180 ){
    	$P_Count = $model->getPostingCountboard('1','6','10',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'10',
                                                    "board_no"=>'1',
                                                    "slot_no"=>6,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
										 $Remark = "Pool $ 10 Slot 6 Credit";
$model->wallet_transaction(1,'Cr',$memberid,6,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
				 	        
    
				 	        }
    
    
    
} 

 } if($i==7){
     
   $days_210 =InsertDate(AddToDate($date_from,"+210 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 210 ){
    	$P_Count = $model->getPostingCountboard('1','7','10',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'10',
                                                    "board_no"=>'1',
                                                    "slot_no"=>7,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											 $Remark = "Pool $ 10 Slot 7 Credit";
$model->wallet_transaction(1,'Cr',$memberid,7,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
    
				 	        }
    
    
} 

 }  
?>                    


<?php }
}?>
                                    
                                     <?php   $i++;?>  
                                 
                                           
               
              
        
        
   <?php  }?>
    
 <?php   } ?>
 
 <?php 
        
        
    }
    }
    public function bordreturn2(){
          $model = new OperationModel();  
          $Q_MEM =  'SELECT member_id,subcription_id FROM `tbl_members` WHERE subcription_id >0';
        $RS_MEM = $this->SqlModel->runQuery($Q_MEM);   
      
          foreach($RS_MEM as $AR_MEM){
          
   $AR_TYPE  = $model->getCurrentMemberShip($AR_MEM['member_id']);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $AR_MEM['member_id'];
  $POOL = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members` WHERE `member_id` = '$memberid'  AND `amount` ='20' ORDER BY  id  ASC");    

                         
                           if($POOL) { 
                               $i=1;
                          foreach($POOL as $P) { 
                      //    PrintR($P);
                          $S1 = $model->getPoolUserId($P['id'] , 1);
                          $S2 = $model->getPoolUserId($P['id'] , 2);
                         // PrintR($P);
                         
                         
                         
         if($S2 !='') {
         
            
         
         }else{
         
if($P['member_id']>=1){ 
    
    
 if($i==1){
    $date_from;
   $days_30 =InsertDate(AddToDate($date_from,"+30 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 30 ){
    	$P_Count = $model->getPostingCountboard('2','1','20',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'20',
                                                    "board_no"=>'2',
                                                    "slot_no"=>1,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											 $Remark = "Pool $ 20 Slot 1 Credit";
$model->wallet_transaction(1,'Cr',$memberid,2,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
    
				 	        }
    
    
}
     
 }if($i==2){
     
     $days_60 =InsertDate(AddToDate($date_from,"+60 Day")); 
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 60 ){
    	$P_Count = $model->getPostingCountboard('2','2','20',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'20',
                                                    "board_no"=>'2',
                                                    "slot_no"=>2,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 20 Slot 2 Credit";
$model->wallet_transaction(1,'Cr',$memberid,4,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
				 	        }
    
    
    
    
    
}    
 }if($i==3){
     $days_90 =InsertDate(AddToDate($date_from,"+90 Day"));   
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 90 ){
    	$P_Count = $model->getPostingCountboard('2','3','20',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'20',
                                                    "board_no"=>'2',
                                                    "slot_no"=>3,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											 $Remark = "Pool $ 20 Slot 3 Credit";
$model->wallet_transaction(1,'Cr',$memberid,6,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
				 	        }
    
    
    
}   
     
 }if($i==4){
     
   $days_120 =InsertDate(AddToDate($date_from,"+120 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 120 ){
    
    	$P_Count = $model->getPostingCountboard('2','4','20',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'20',
                                                    "board_no"=>'2',
                                                    "slot_no"=>4,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 20 Slot 4 Credit";
$model->wallet_transaction(1,'Cr',$memberid,8,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
				 	        }
    
    
    
    
    
} 

 }if($i==5){
     
   $days_150 =InsertDate(AddToDate($date_from,"+150 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 150 ){
    
    	$P_Count = $model->getPostingCountboard('2','5','20',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'20',
                                                    "board_no"=>'2',
                                                    "slot_no"=>5,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 20 Slot 5 Credit";
$model->wallet_transaction(1,'Cr',$memberid,10,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
				 	        }
    
    
    
    
    
} 

 }if($i==6){
     
   $days_180 =InsertDate(AddToDate($date_from,"+180 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 180 ){
    
    	$P_Count = $model->getPostingCountboard('2','6','20',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'20',
                                                    "board_no"=>'2',
                                                    "slot_no"=>6,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 20 Slot 6 Credit";
$model->wallet_transaction(1,'Cr',$memberid,12,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
				 	        }
    
    
    
} 

 } if($i==7){
     
   $days_210 =InsertDate(AddToDate($date_from,"+210 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 210 ){
    
    	$P_Count = $model->getPostingCountboard('2','7','20',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'20',
                                                    "board_no"=>'2',
                                                    "slot_no"=>7,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 20 Slot 7 Credit";
$model->wallet_transaction(1,'Cr',$memberid,14,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
    
    
				 	        }
    
} 

 }   
   
?>                    


<?php }
}?>
                                    
                                     <?php   $i++;?>  
                                 
                                           
               
              
        
        
   <?php  }?>
    
 <?php   } ?>
 
 <?php 
        
        
    }
    }
       public function bordreturn3(){
          $model = new OperationModel();  
          $Q_MEM =  'SELECT member_id,subcription_id FROM `tbl_members` WHERE subcription_id >0';
        $RS_MEM = $this->SqlModel->runQuery($Q_MEM);   
      
          foreach($RS_MEM as $AR_MEM){
          
   $AR_TYPE  = $model->getCurrentMemberShip($AR_MEM['member_id']);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $AR_MEM['member_id'];
  $POOL = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members` WHERE `member_id` = '$memberid'  AND `amount` ='40' ORDER BY  id  ASC");    

                         
                           if($POOL) { 
                               $i=1;
                          foreach($POOL as $P) { 
                      //    PrintR($P);
                          $S1 = $model->getPoolUserId($P['id'] , 1);
                          $S2 = $model->getPoolUserId($P['id'] , 2);
                          PrintR($P);
                         
                         
                         
         if($S2 !='') {
         
            
         
         }else{
         
if($P['member_id']>=1){ 
    
    
 if($i==1){
    $date_from;
   $days_30 =InsertDate(AddToDate($date_from,"+30 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 30 ){
    	$P_Count = $model->getPostingCountboard('3','1','40',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'40',
                                                    "board_no"=>'3',
                                                    "slot_no"=>1,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 40 Slot 1 Credit";
$model->wallet_transaction(1,'Cr',$memberid,4,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
				 	        }
    
    
    
    
}
     
 }if($i==2){
     
     $days_60 =InsertDate(AddToDate($date_from,"+60 Day")); 
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 60 ){
    	$P_Count = $model->getPostingCountboard('3','2','40',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'40',
                                                    "board_no"=>'3',
                                                    "slot_no"=>2,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 40 Slot 2 Credit";
$model->wallet_transaction(1,'Cr',$memberid,8,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
				 	        }
    
    
    
}    
 }if($i==3){
     $days_90 =InsertDate(AddToDate($date_from,"+90 Day"));   
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 90 ){
    	$P_Count = $model->getPostingCountboard('3','3','40',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'40',
                                                    "board_no"=>'3',
                                                    "slot_no"=>3,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 40 Slot 3 Credit";
$model->wallet_transaction(1,'Cr',$memberid,12,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
				 	        }
    
    
    
}   
     
 }if($i==4){
     
   $days_120 =InsertDate(AddToDate($date_from,"+120 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 120 ){
    	$P_Count = $model->getPostingCountboard('3','4','40',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'40',
                                                    "board_no"=>'3',
                                                    "slot_no"=>4,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											 $Remark = "Pool $ 40 Slot 4 Credit";
$model->wallet_transaction(1,'Cr',$memberid,16,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
				 	        }
    
    
    
    
    
} 

 }if($i==5){
     
   $days_150 =InsertDate(AddToDate($date_from,"+150 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 150 ){
    	$P_Count = $model->getPostingCountboard('3','5','40',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'40',
                                                    "board_no"=>'3',
                                                    "slot_no"=>5,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 40 Slot 5 Credit";
$model->wallet_transaction(1,'Cr',$memberid,20,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
    
    
    
    
} }

 }if($i==6){
     
   $days_180 =InsertDate(AddToDate($date_from,"+180 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 180 ){
    	$P_Count = $model->getPostingCountboard('3','6','40',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'40',
                                                    "board_no"=>'3',
                                                    "slot_no"=>6,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 40 Slot 6 Credit";
$model->wallet_transaction(1,'Cr',$memberid,24,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
    
				 	        }
    
    
} 

 } if($i==7){
     
   $days_210 =InsertDate(AddToDate($date_from,"+210 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 210 ){
    	$P_Count = $model->getPostingCountboard('3','7','40',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'40',
                                                    "board_no"=>'3',
                                                    "slot_no"=>7,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											
												 $Remark = "Pool $ 40 Slot 7 Credit";
$model->wallet_transaction(1,'Cr',$memberid,28,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
    
				 	        }
    
    
    
} 

 } 
?>                    


<?php }
}?>
                                    
                                     <?php   $i++;?>  
                                 
                                           
               
              
        
        
   <?php  }?>
    
 <?php   } ?>
 
 <?php 
        
        
    }
    }
    public function bordreturn4(){
          $model = new OperationModel();  
          $Q_MEM =  'SELECT member_id,subcription_id FROM `tbl_members` WHERE subcription_id >0';
        $RS_MEM = $this->SqlModel->runQuery($Q_MEM);   
      
          foreach($RS_MEM as $AR_MEM){
          
   $AR_TYPE  = $model->getCurrentMemberShip($AR_MEM['member_id']);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $AR_MEM['member_id'];
  $POOL = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members` WHERE `member_id` = '$memberid'  AND `amount` ='80' ORDER BY  id  ASC");    

                         
                           if($POOL) { 
                               $i=1;
                          foreach($POOL as $P) { 
                      //    PrintR($P);
                          $S1 = $model->getPoolUserId($P['id'] , 1);
                          $S2 = $model->getPoolUserId($P['id'] , 2);
                         // PrintR($P);
                         
                         
                         
         if($S2 !='') {
         
            
         
         }else{
         
if($P['member_id']>=1){ 
    
    
 if($i==1){
    $date_from;
   $days_30 =InsertDate(AddToDate($date_from,"+30 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 30 ){
    	$P_Count = $model->getPostingCountboard('4','1','80',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'80',
                                                    "board_no"=>'4',
                                                    "slot_no"=>1,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											
												 $Remark = "Pool $ 80 Slot 1 Credit";
$model->wallet_transaction(1,'Cr',$memberid,8,$Remark,date('Y-m-d'),rand(),'1',"Pool"); 

    
    
				 	        }
    
    
    
    
}
     
 }if($i==2){
     
     $days_60 =InsertDate(AddToDate($date_from,"+60 Day")); 
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 60 ){
    
    	$P_Count = $model->getPostingCountboard('4','2','80',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'80',
                                                    "board_no"=>'4',
                                                    "slot_no"=>2,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 80 Slot 2 Credit";
$model->wallet_transaction(1,'Cr',$memberid,16,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
				 	        }
    
    
    
    
    
}    
 }if($i==3){
     $days_90 =InsertDate(AddToDate($date_from,"+90 Day"));   
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 90 ){
    
    	$P_Count = $model->getPostingCountboard('4','3','80',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'80',
                                                    "board_no"=>'4',
                                                    "slot_no"=>3,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 80 Slot 3 Credit";
$model->wallet_transaction(1,'Cr',$memberid,24,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
    
    
				 	        }
    
    
    
}   
     
 }if($i==4){
     
   $days_120 =InsertDate(AddToDate($date_from,"+120 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 120 ){
    
    	$P_Count = $model->getPostingCountboard('4','4','80',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'80',
                                                    "board_no"=>'4',
                                                    "slot_no"=>4,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 80 Slot 4 Credit";
$model->wallet_transaction(1,'Cr',$memberid,32,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
    
				 	        }
    
    
    
    
} 

 }if($i==5){
     
   $days_150 =InsertDate(AddToDate($date_from,"+150 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 150 ){
    
    	$P_Count = $model->getPostingCountboard('4','5','80',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'80',
                                                    "board_no"=>'4',
                                                    "slot_no"=>5,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 80 Slot 5 Credit";
$model->wallet_transaction(1,'Cr',$memberid,40,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
    
    
}
    
    
    
} 

 }if($i==6){
     
   $days_180 =InsertDate(AddToDate($date_from,"+180 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 180 ){
    
    	$P_Count = $model->getPostingCountboard('4','6','80',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'80',
                                                    "board_no"=>'4',
                                                    "slot_no"=>6,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 80 Slot 6 Credit";
$model->wallet_transaction(1,'Cr',$memberid,48,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
    
    
    
}
    
    
} 

 } if($i==7){
     
   $days_210 =InsertDate(AddToDate($date_from,"+210 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 210 ){
    
    	$P_Count = $model->getPostingCountboard('4','7','80',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'80',
                                                    "board_no"=>'4',
                                                    "slot_no"=>7,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											   $Remark = "Pool $ 80 Slot 7 Credit";
											
												//	$Remark = "Board Income 7 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,56,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
    
    
				 	        }
    
    
    
} 

 } 
?>                    


<?php }
}?>
                                    
                                     <?php   $i++;?>  
                                 
                                           
               
              
        
        
   <?php  }?>
    
 <?php   } ?>
 
 <?php 
        
        
    }
    }
    
     public function bordreturn5(){
          $model = new OperationModel();  
          $Q_MEM =  'SELECT member_id,subcription_id FROM `tbl_members` WHERE subcription_id >0';
        $RS_MEM = $this->SqlModel->runQuery($Q_MEM);   
      
          foreach($RS_MEM as $AR_MEM){
          
   $AR_TYPE  = $model->getCurrentMemberShip($AR_MEM['member_id']);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $AR_MEM['member_id'];
  $POOL = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members` WHERE `member_id` = '$memberid'  AND `amount` ='160' ORDER BY  id  ASC");    

                         
                           if($POOL) { 
                               $i=1;
                          foreach($POOL as $P) { 
                      //    PrintR($P);
                          $S1 = $model->getPoolUserId($P['id'] , 1);
                          $S2 = $model->getPoolUserId($P['id'] , 2);
                         // PrintR($P);
                         
                         
                         
         if($S2 !='') {
         
            
         
         }else{
         
if($P['member_id']>=1){ 
    
    
 if($i==1){
    $date_from;
   $days_30 =InsertDate(AddToDate($date_from,"+30 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 30 ){
    
    	$P_Count = $model->getPostingCountboard('5','1','160',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'160',
                                                    "board_no"=>'5',
                                                    "slot_no"=>1,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											
												 $Remark = "Pool $ 160 Slot 1 Credit";
$model->wallet_transaction(1,'Cr',$memberid,16,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
    
    
    
				 	        }
    
    
}
     
 }if($i==2){
     //echo $date_from;die;
     $days_60 =InsertDate(AddToDate($date_from,"+60 Day")); 
    $today_date =$today_date = date('Y-m-d');

 $date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
 $days  = $date2->diff($date1)->format('%a');// die;



if($days > 60  ){
    	$P_Count = $model->getPostingCountboard('5','2','160',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'160',
                                                    "board_no"=>'5',
                                                    "slot_no"=>2,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											 $Remark = "Pool $ 160 Slot 2 Credit";
$model->wallet_transaction(1,'Cr',$memberid,32,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
    
				 	        }
    
    
    
    
}    
 }if($i==3){
     $days_90 =InsertDate(AddToDate($date_from,"+90 Day"));   
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 90 ){
    	$P_Count = $model->getPostingCountboard('5','3','160',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'160',
                                                    "board_no"=>'5',
                                                    "slot_no"=>3,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
											 $Remark = "Pool $ 160 Slot 3 Credit";
$model->wallet_transaction(1,'Cr',$memberid,48,$Remark,date('Y-m-d'),rand(),'1',"Pool");
				 	        }
    
    
    
    
    
    
}   
     
 }if($i==4){
     
   $days_120 =InsertDate(AddToDate($date_from,"+120 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 120 ){
    	$P_Count = $model->getPostingCountboard('5','4','160',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'160',
                                                    "board_no"=>'5',
                                                    "slot_no"=>4,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 160 Slot 4 Credit";
$model->wallet_transaction(1,'Cr',$memberid,64,$Remark,date('Y-m-d'),rand(),'1',"Pool");
				 	        }
    
    
    
    
    
    
} 

 }if($i==5){
     
   $days_150 =InsertDate(AddToDate($date_from,"+150 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 150 ){
    	$P_Count = $model->getPostingCountboard('5','5','160',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'160',
                                                    "board_no"=>'5',
                                                    "slot_no"=>5,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 160 Slot 5 Credit";
$model->wallet_transaction(1,'Cr',$memberid,80,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
    
    
				 	        }
    
    
    
} 

 }if($i==6){
     
   $days_180 =InsertDate(AddToDate($date_from,"+180 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 180 ){
    	$P_Count = $model->getPostingCountboard('5','6','160',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'160',
                                                    "board_no"=>'5',
                                                    "slot_no"=>6,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 160 Slot 6 Credit";
$model->wallet_transaction(1,'Cr',$memberid,96,$Remark,date('Y-m-d'),rand(),'1',"Pool");
    
				 	        }
    
    
    
    
    
} 

 } if($i==7){
     
   $days_210 =InsertDate(AddToDate($date_from,"+210 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 210 ){
    	$P_Count = $model->getPostingCountboard('5','7','160',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'160',
                                                    "board_no"=>'5',
                                                    "slot_no"=>7,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												 $Remark = "Pool $ 160 Slot 7 Credit";
$model->wallet_transaction(1,'Cr',$memberid,112,$Remark,date('Y-m-d'),rand(),'1',"Pool");
				 	        }
    
    
    
    
    
    
} 

 } 
?>                    


<?php }
}?>
                                    
                                     <?php   $i++;?>  
                                 
                                           
               
              
        
        
   <?php  }?>
    
 <?php   } ?>
 
 <?php 
        
        
    }
    }
    public function bordreturn6(){
          $model = new OperationModel();  
          $Q_MEM =  'SELECT member_id,subcription_id FROM `tbl_members` WHERE subcription_id >0';
        $RS_MEM = $this->SqlModel->runQuery($Q_MEM);   
      
          foreach($RS_MEM as $AR_MEM){
          
   $AR_TYPE  = $model->getCurrentMemberShip($AR_MEM['member_id']);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $AR_MEM['member_id'];
  $POOL = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members` WHERE `member_id` = '$memberid'  AND `amount` ='32000' ORDER BY  id  ASC");    

                         
                           if($POOL) { 
                               $i=1;
                          foreach($POOL as $P) { 
                      //    PrintR($P);
                          $S1 = $model->getPoolUserId($P['id'] , 1);
                          $S2 = $model->getPoolUserId($P['id'] , 2);
                         // PrintR($P);
                         
                         
                         
         if($S2 !='') {
         
            
         
         }else{
         
if($P['member_id']>=1){ 
    
    
 if($i==1){
    $date_from;
   $days_30 =InsertDate(AddToDate($date_from,"+30 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 30 ){
    	$P_Count = $model->getPostingCountboard('6','1','32000',$memberid); 
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>1,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
													$Remark = "Board Income 1 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
    
    
				 	        }
    
    
    
}
     
 }if($i==2){
     
     $days_60 =InsertDate(AddToDate($date_from,"+60 Day")); 
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 60 ){
    	$P_Count = $model->getPostingCountboard('6','2','32000',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>2,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
													$Remark = "Board Income 2 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
    
				 	        }
    
    
    
    
}    
 }if($i==3){
     $days_90 =InsertDate(AddToDate($date_from,"+90 Day"));   
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 90 ){
    	$P_Count = $model->getPostingCountboard('6','3','32000',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>3,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
													$Remark = "Board Income 3 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
    
				 	        }
    
    
    
    
}   
     
 }if($i==4){
     
   $days_120 =InsertDate(AddToDate($date_from,"+120 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 120 ){
    	$P_Count = $model->getPostingCountboard('6','4','32000',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>4,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
													$Remark = "Board Income 4 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
				 	        }
    
    
    
    
    
} 

 }if($i==5){
     
   $days_150 =InsertDate(AddToDate($date_from,"+150 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 150 ){
    	$P_Count = $model->getPostingCountboard('6','5','32000',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>5,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												$Remark = "Board Income 5 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
    
    
    
				 	        }
    
    
} 

 }if($i==6){
     
   $days_180 =InsertDate(AddToDate($date_from,"+180 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 180 ){
    	$P_Count = $model->getPostingCountboard('6','6','32000',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>6,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
													$Remark = "Board Income 6 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
				 	        }
    
    
    
    
    
} 

 } if($i==7){
     
   $days_210 =InsertDate(AddToDate($date_from,"+210 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 210 ){
    	$P_Count = $model->getPostingCountboard('6','7','32000',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>7,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												$Remark = "Board Income 7 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
    
				 	        }
    
    
    
    
} 

 }  if($i==8){
     
   $days_240 =InsertDate(AddToDate($date_from,"+240 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 240 ){
    	$P_Count = $model->getPostingCountboard('6','8','32000',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>8,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												$Remark = "Board Income 8 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
				 	        }
    
    
    
    
    
} 

 }   if($i==9){
     
   $days_270 =InsertDate(AddToDate($date_from,"+270 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 270 ){
    	$P_Count = $model->getPostingCountboard('6','9','32000',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>9,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
													$Remark = "Board Income 9 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
				 	        }
    
    
    
    
    
} 

 }  if($i==10){
     
   $days_300 =InsertDate(AddToDate($date_from,"+300 Day"));  
    $today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');



if($days > 300 ){
    	$P_Count = $model->getPostingCountboard('6','10','32000',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
    	$user_id = $model->getMemberUserId($memberid);
    
    $tree_data = array("member_id"=>$memberid,
                                                    "user_id"=>$user_id,
                                                    "amount"=>'32000',
                                                    "board_no"=>'6',
                                                    "slot_no"=>10,"last_date"=>$date_from,"t_count"=>$P['t_count'],
                                                    );
											$this->SqlModel->insertRecord(prefix."tbl_board_return",$tree_data);
											
												$Remark = "Board Income 10 Income Credit";
$model->wallet_transaction(1,'Cr',$memberid,3200,$Remark,date('Y-m-d'),rand(),'1',"Baord");
    
    
				 	        }
    
    
    
    
}



    



 }   
   
?>                    


<?php }
}?>
                                    
                                     <?php   $i++;?>  
                                 
                                           
               
              
        
        
   <?php  }?>
    
 <?php   } ?>
 
 <?php 
        
        
    }
    }
 public function setMembersdirect()
	{
	    		$model = new OperationModel();
	    			$time_stamp = getLocalTime();
		$today_date = InsertDate($time_stamp);
	    	

						
									
            $today_date =$today_date = date('Y-m-d');//InsertDate(getLocalTime());
            $date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
            
             $QR_MEM = "SELECT * FROM `tbl_subscription` where 1 ORDER BY `tbl_subscription`.`subcription_id` ASC ";
    $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
        
     	foreach($RS_MEM as $AR_MEM){    
            
         $member_id=    $AR_MEM['member_id'];
  $package_price=    $AR_MEM['package_price'];
	 $subcription_id=    $AR_MEM['subcription_id'];	
	 	 $type_id=    $AR_MEM['type_id'];	
	 	 
	 	   updateDirectCounts(); 
   instantIncomeGenertenextg($member_id,$package_price,$subcription_id,$type_id);
	
 

										
										
									 
									 
									 
				 
								
						 		 
								 
	}			 
					 
	    		    
	    		
	    		
	    		    
	    		    
	    		
	    		
	}
	

   public function setMembersretopup()
	{
	    		$model = new OperationModel();
	    			$time_stamp = getLocalTime();
		$today_date = InsertDate($time_stamp);
	    	

						
									
            $today_date =$today_date = date('Y-m-d');//InsertDate(getLocalTime());
            $date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
            
             $QR_MEM = "SELECT * FROM `tbl_members` where member_id >0 ORDER BY `tbl_members`.`member_id` ASC ";
    $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
        
     	foreach($RS_MEM as $AR_MEM){    
            
         $member_id=    $AR_MEM['member_id'];
                    $type_id =1; 
             // $package_price =10;
          $randdd =1;//(rand(1,5));
            if($randdd==1){
              $type_id =5; 
              $package_price =2000000;
            }
            //   if($randdd==2){
            //   $type_id =2; 
            //   $package_price =500;
            // }
            //   if($randdd==3){
            //   $type_id =3; 
            //   $package_price =800;
            // }
            //   if($randdd==4){
            //   $type_id =4; 
            //   $package_price =2200;
            // }
            //   if($randdd==5){
            //   $type_id =5; 
            //   $package_price =4800;
            // }
            //   if($randdd==6){
            //   $type_id =6; 
            //   $package_price =32000;
            // }
             	$sub = $model->checkCount('tbl_subscription','member_id',$member_id);
             	
             	if($sub <= '0' )
				{
				$type = 'A';
				} 
				else
				{
				 $type = 'U';  
				}


	$order_no = UniqueId('ORDER_NO');
			       	$data_sub = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"type_id"=>$type_id,
						"package_price"=>$package_price,
						"net_amount"=>$package_price,
						"reinvest_amt"=>$package_price,
						"total_amt"=>$package_price,
						"prod_pv"=>$package_price,
						"date_from"=>$today_date,
						"type" => $type,
							"roi_stacking"=>0,
								"pool"=>'N',
						"date_expire"=>$date_expire,
                        
                       
					);
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub); 
						 
			 //   die;
		$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
    		  		    
    		  		    
    		  		    	
    		  		    
    		  		    	
								
  instantDirectIncomeGenerte($member_id,$package_price,$subcription_id,$type_id);
				
 
										
										
									 
									 
									 
				 
								
						 		 
								 
	}			 
					 
	    		    
	    		
	    		
	    		    
	    		    
	    		
	    		
	}
   public function setMembersnew()
	{
	    		$model = new OperationModel();
	    			$time_stamp = getLocalTime();
		$today_date = InsertDate($time_stamp);
	    	

						
									
            $today_date =$today_date = date('Y-m-d');//InsertDate(getLocalTime());
            $date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
            
             $QR_MEM = "SELECT * FROM `tbl_members` where member_id >1 ORDER BY `tbl_members`.`member_id` ASC ";
    $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
        
     	foreach($RS_MEM as $AR_MEM){    
            
         $member_id=    $AR_MEM['member_id'];
                    $type_id =1; 
             // $package_price =10;
          $randdd =1;//(rand(1,5));
            if($randdd==1){
              $type_id =1; 
              $package_price =90;
            }
              if($randdd==2){
              $type_id =2; 
              $package_price =500;
            }
              if($randdd==3){
              $type_id =3; 
              $package_price =800;
            }
              if($randdd==4){
              $type_id =4; 
              $package_price =2200;
            }
              if($randdd==5){
              $type_id =5; 
              $package_price =4800;
            }
            //   if($randdd==6){
            //   $type_id =6; 
            //   $package_price =32000;
            // }
             	$sub = $model->checkCount('tbl_subscription','member_id',$member_id);
             	
             	if($sub <= '0' )
				{
				$type = 'A';
				} 
				else
				{
				 $type = 'U';  
				}
  if($sub == '0')
			    { 
	$order_no = UniqueId('ORDER_NO');
				 	
				 		$data_sub = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"type_id"=>$type_id,
						"package_price"=>$package_price-10,
						"net_amount"=>$package_price-10,
						"reinvest_amt"=>$package_price-10,
						"total_amt"=>$package_price-10,
						"prod_pv"=>$package_price-10,
						"date_from"=>$today_date-10,
						"type" => $type,
							"roi_stacking"=>0,
								"pool"=>'N',
						"date_expire"=>$date_expire,
                        
                       
					);
				
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
						 
						 	$data_sub1 = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"type_id"=>$type_id,
						"package_price"=>10,
						"net_amount"=>10,
						"reinvest_amt"=>10,
						"total_amt"=>10,
						"prod_pv"=>10,
						"date_from"=>$today_date,
						"type" => 'A',
							"roi_stacking"=>0,
								"pool"=>'Y',
						"date_expire"=>$date_expire,
                        
                       
					);
					//	PrintR($data_sub1);
					$this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub1);
						 
						 
				    if(true)
			    { 
			       
			      	  $Q = $this->SqlModel->runQuery("SELECT member_id,spill_id,position,t_count FROM `tbl_level_members` WHERE amount ='10' ORDER BY id DESC LIMIT 1",true);      
                                $t_count    = $Q['t_count'];
                                $spill_id   = $Q['spill_id'];
                                $position   = $Q['position'];
                                $pos        = ($position >1)?1:2;
                                 
                                if($position >1)
                                {
                                 $Q21 = $this->SqlModel->runQuery("SELECT id FROM `tbl_level_members` WHERE amount ='10' and  id > '$spill_id' LIMIT 1",true);  
                                 $spill_id   = $Q21['id'];
                                 
                                }
                                
                                                   
                                              
                                            
                                            $pool = array(
                                                            "member_id"       =>$member_id,
                                                            "spill_id"        =>$spill_id,
                                                            "ref_id"          =>$subcription_id,
                                                            "position"        =>$pos,
                                                            "t_count"         =>"1",
                                                            "entry_type"      =>"A",
                                                            "amount"          =>10,
                                                            "date_time"       =>date('Y-m-d H:i:s')
                                                            );
                                            $this->SqlModel->insertRecord("tbl_level_members",$pool);   
                                            if($pos == 2 )
                                            {
                                                

                                                
                                                
                                               
                                               $SP = $this->SqlModel->runQuery("SELECT id,ref_id,member_id,spill_id,position,t_count FROM `tbl_level_members` WHERE id ='$spill_id' ORDER BY id DESC LIMIT 1",true);       
                                              
                                             $slot = $SP['t_count'];
                                             
          $package_price1=10;                        
                                             
if($package_price1==10){if($slot==1){$bprice=1;}if($slot==2){$bprice=2;} if($slot==3){$bprice=3;} if($slot==4){$bprice=4;}if($slot==5){$bprice=5;}if($slot==6){$bprice=6;}if($slot==7){$bprice=7;} }
if($package_price1==20){if($slot==1){$bprice=2;}if($slot==2){$bprice=4;} if($slot==3){$bprice=6;} if($slot==4){$bprice=8;}if($slot==5){$bprice=10;}if($slot==6){$bprice=12;}if($slot==7){$bprice=14;} }
if($package_price1==30){if($slot==1){$bprice=3;}if($slot==2){$bprice=6;} if($slot==3){$bprice=9;} if($slot==4){$bprice=12;}if($slot==5){$bprice=15;}if($slot==6){$bprice=18;}if($slot==7){$bprice=21;} }
if($package_price1==40){if($slot==1){$bprice=4;}if($slot==2){$bprice=8;} if($slot==3){$bprice=12;} if($slot==4){$bprice=16;}if($slot==5){$bprice=20;} if($slot==6){$bprice=24;}if($slot==7){$bprice=30;}}
if($package_price1==50){if($slot==1){$bprice=5;}if($slot==2){$bprice=10;} if($slot==3){$bprice=15;} if($slot==4){$bprice=20;}if($slot==5){$bprice=25;}if($slot==6){$bprice=30;}if($slot==7){$bprice=35;} }

                          
                                             
                                               $Remark = "Pool $ $package_price1 Slot ".$SP['t_count']." Credit";
                                               
                                               
                                               
                                               
                                               
                                               
                                          $model->wallet_transaction(1,'Cr',$SP['member_id'],$bprice,$Remark,date('Y-m-d'),rand(),'1',"Pool");   
                                          $memid =$SP['member_id'];
                                           $this->db->query("UPDATE `tbl_members` SET `total_income` = total_income+$bprice  WHERE member_id ='$memid';");  
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                          
                                               if($SP['t_count']+1 <= 7)
                                               {
                                                $Q22 = $this->SqlModel->runQuery("SELECT id FROM `tbl_level_members` WHERE amount ='10' and  id > '$spill_id' LIMIT 1",true);  
                                                $spill_id   = $Q22['id'];
                                                $pool = array(
                                                            "member_id"       =>$SP['member_id'],
                                                            "spill_id"        =>$spill_id,
                                                            "position"        =>1,
                                                            "t_count"         =>$SP['t_count']+1,
                                                            "entry_type"      =>"U",
                                                            "ref_id"          =>$SP['ref_id'],
                                                            "amount"          =>10,
                                                            "date_time"       =>date('Y-m-d')
                                                            );
                                                $this->SqlModel->insertRecord("tbl_level_members",$pool);    
                                               }
                                              
                                            }          
                                            
                                
					
					 
			       
			    }		 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
						 
					
			    }
			 //   die;
		$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
    		  		    
    		  		    
    		  		    	
    		  		    
    		  		    	
								

				
   instantIncomeGenertenextg($member_id,$package_price,$subcription_id,$type_id);
	
 

										
										
									 
									 
									 
				 
								
						 		 
								 
	}			 
					 
	    		    
	    		
	    		
	    		    
	    		    
	    		
	    		
	}
    public function setMembers()
	{
	    		$model = new OperationModel();
	    			$time_stamp = getLocalTime();
		$today_date = InsertDate($time_stamp);
	    		for($i = 1; $i<=50;$i++){
	    		     $randdd =(rand(1,2));
	    		    	  for($j = 1; $j<=$randdd;$j++){  
				    
				    if($j=='1'){
				        
				      echo   $left_right =  'L';
				        
				    }
				    
				       if($j=='2'){
				        
				       echo  $left_right =  'R';
				        
				    }
$userId = $model->generateUserId();		
	$order_no = UniqueId('ORDER_NO');
				$user_password =  123456;
				$trns_password = 123456;
			    $state_name = FCrtRplc($form_data['state_name']);
				$country_code = FCrtRplc($form_data['country_code']);
				$city_name = FCrtRplc($form_data['city_name']);
				$mobile_code = +91;
				$member_mobile =9876543221;
				$type_id = 1;
				$user_id  =$userId;
				$user_name = $userId;
			    $title = FCrtRplc($form_data['title']);
				$pin_code = FCrtRplc($form_data['pin_code']);
				$gender = FCrtRplc($form_data['gender']);
				$no_pin= FCrtRplc($form_data['activePin']);
		        $pin_key= FCrtRplc($form_data['activeKey']);
				  $first_name ='Test'; 
 
				 //$left_right =  'L';
				
				if($first_name!='' || $left_right!=''){
				    
				    
			
					$sponsor_id = $i;//   $model->getMemberId($form_data['spr_user_id']);
					$AR_GET = $model->getSponsorSpill($sponsor_id,$left_right);
 
					/*if($left_right=='AUTO'){
						$AR_GET = $model->getOpenPlace($sponsor_id);
						$left_right = $AR_GET['left_right'];	
					}*/
					 
					$spil_id =  FCrtRplc($AR_GET['spil_id']);
		 
					 if($model->checkCount(prefix."tbl_members","user_id",$user_id)=='0'){
					     
					     
					      
					     
					     
									$Ctrl += $model->CheckOpenPlace($spil_id,$left_right);
									$data = array(
									    "first_name"=>$first_name,
										"full_name"=>$first_name,
										"user_id"=>$user_id,
										"user_name"=>$user_id,
										"user_password"=>$user_password,
										"trns_password"=>$trns_password,
										"member_email"=>$member_email,
									    "title" => $title,
									    "state_name"=>$state_name,
									    "city_name"=>$city_name,
				                        "pin_code"  =>$pin_code,
				                        "gender" =>$gender,
										"sponsor_id"=>$sponsor_id,
										"spil_id"=>$spil_id,
										"left_right"=>$left_right,
									
										"level_spil"=>0,
										"member_mobile"=>$member_mobile,
										"date_join"=>$time_stamp,
										"pan_status"=>"N",
										"status"=>"Y",
										"last_login"=>$time_stamp,
										"login_ip"=>$_SERVER['REMOTE_ADDR'],
										"block_sts"=>"N",
										"sms_sts"=>"N",
									
										"type_id"=>0,
										"upgrade_date"=>$time_stamp
									);	
//PrintR($data);
									if($Ctrl=='0'){
											$member_id = $this->SqlModel->insertRecord(prefix."tbl_members",$data);
											$tree_data = array("member_id"=>$member_id,
												"sponsor_id"=>$sponsor_id,
												"spil_id"=>$spil_id,
												"nlevel"=>0,
												"left_right"=>$left_right,
												"nleft"=>0,
												"nright"=>0,
												"date_join"=>$today_date
											);
											$this->SqlModel->insertRecord(prefix."tbl_mem_tree",$tree_data);
											$model->updateTree($spil_id,$member_id);
											  
									
									
            $today_date =$today_date = date('Y-m-d');//InsertDate(getLocalTime());
            $date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
                    $type_id =1; 
                    
                    if(false){
             // $package_price =10;
          $randdd =(rand(1,5));
            if($randdd==1){
              $type_id =1; 
              $package_price =90;
            }
              if($randdd==2){
              $type_id =2; 
              $package_price =400;
            }
              if($randdd==3){
              $type_id =3; 
              $package_price =800;
            }
              if($randdd==4){
              $type_id =4; 
              $package_price =2200;
            }
              if($randdd==5){
              $type_id =5; 
              $package_price =4800;
            }
            //   if($randdd==6){
            //   $type_id =6; 
            //   $package_price =32000;
            // }
             	$sub = $model->checkCount('tbl_subscription','member_id',$member_id);
             	
             	if($sub <= '0' )
				{
				$type = 'A';
				} 
				else
				{
				 $type = 'U';  
				}

			        
			       	$data_sub = array("order_no"=>$order_no,
						"member_id"=>$member_id,
						"type_id"=>$type_id,
						"package_price"=>$package_price,
						"net_amount"=>$package_price,
						"reinvest_amt"=>$package_price,
						"total_amt"=>$package_price,
						"prod_pv"=>$package_price,
						"date_from"=>$today_date,
						"type" => $type,
							"roi_stacking"=>0,
								"pool"=>'N',
						"date_expire"=>$date_expire,
                        
                       
					);
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub); 
			        
			    
			 //   die;
		$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
    		  		    
    		  		    
    		  		    	
    		  		    
									}		  		    	
								
  //instantIncomeGenerte($member_id,$package_price,$subcription_id,$type_id);
				
  // instantIncomeGenertenextg($member_id,$package_price,$subcription_id,$type_id);
	
 

										}
										
									 
									 
									 
				 
								
						 		 
								 
				 
					 }
	    		    
	    		}
	    		
	    		    
	    		    
	    		}
	    		}
	}
    //https://trade4money.biz/demo/cronsecure/setuppayouts

     public function subcriptionsss()               {
    
    $model = new OperationModel();    
     
    $QR_MEM = "SELECT * FROM `tbl_subscription` where 1 ORDER BY `tbl_subscription`.`subcription_id` ASC ";
    $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
    
// [id] => 19
// [userId] => 164
// [amount] => 400000
// [screenshot] => uploads/1634814849.jpeg
// [user_count] => 1
// [is_verified] => 1
// [type] => 0
// [created_at] => 2021-10-21 16:44:09
// [status] => verified
// [paymet_type] => fdfc
// [emiproduct] => uploads/1635337260.jpeg   


     	foreach($RS_MEM as $AR_MEM)
			{
//  	 PrintR($AR_MEM);die;
            $member_id  = $AR_MEM['member_id'];
              $subcription_id = $AR_MEM['subcription_id'];
                $type_id = $AR_MEM['type_id'];
            
           
     
    	              		$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$AR_MEM['amount'],"block_sts"=>'N');
    	              		PrintR($update_data);
    		  		   // $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));


  
 
             
		
     
			}
 
    }    
  
      public function asdasdasd(){  
       
       
       
        
        
        
     
        
    
    
    
    $model = new OperationModel();
            $Q_MEM =  'SELECT * FROM `tbl_money_transfer` WHERE `response` LIKE "%SUCCESS%"';
        $RS_MEM = $this->SqlModel->runQuery($Q_MEM);   
      
          foreach($RS_MEM as $AR_MEM):
              $sender_id = $AR_MEM['sender_id'];
              $response  = $AR_MEM['response'];
              $res = json_decode($response);
             $date = $res->txnDate; //PrintR($res);die;
            
             
             
             
            $order_idd =  $AR_MEM['orderid'];
            $parameters="order_id=$order_idd";
            $url="https://vertoindia.in/dmt/api/gettransaction";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
            curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
            $return_val = curl_exec($ch);
            $api_result = json_decode($return_val);
             
             $date = $api_result->date_time;
           
           
              $this->SqlModel->updateRecord("tbl_money_transfer",array("date"=>$date),array("sender_id"=>$sender_id));
            
          endforeach;
          
        
    }
    
    // ****************************************************************Shifting Tree
    
       public function chreff(){  
    $model = new OperationModel();
            $Q_MEM = "SELECT member_id, sponsor_id, spil_id,  left_right, date_join FROM tbl_members AS A 
        WHERE member_id NOT IN (SELECT member_id FROM tbl_mem_tree AS B) 
        ORDER BY A.member_id ASC LIMIT 15000";
        $RS_MEM = $this->SqlModel->runQuery($Q_MEM);  //PrintR($RS_MEM);die;
        $AR_RT['ErrorMsg']="PENDING";
        if(count($RS_MEM)>0){
          foreach($RS_MEM as $AR_MEM):
          
            $sponsor_id = ($AR_MEM['sponsor_id']>0)? $AR_MEM['sponsor_id']:$model->getMemberId($AR_MEM['spor_user_id']);
            $spil_id = ($AR_MEM['spil_id']>0)? $AR_MEM['spil_id']:$model->getMemberId($AR_MEM['spil_user_id']);
            $member_id = $AR_MEM['member_id'];  echo  $member_id.'<br>';
            if($model->checkCount(prefix."tbl_mem_tree","member_id",$sponsor_id)>0){
              $model->UpdateMemberTree($sponsor_id, $spil_id, $member_id, $AR_MEM['left_right'], $AR_MEM['date_join']);
            }
            
          endforeach;
          
        } 
    }
    
       public function setupmemberIds(){  
    $model = new OperationModel();
            $Q_MEM = "SELECT  tm.member_id FROM tbl_members AS tm	
		 LEFT JOIN tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN tbl_mem_tree AS tree ON tm.member_id=tree.member_id
	
		  LEFT JOIN tbl_subscription AS ts ON ( ts.subcription_id=tm.subcription_id )
		  	 LEFT JOIN tbl_pintype AS tpt ON tpt.type_id=ts.type_id
		 WHERE  tm.delete_sts>0  
		  AND tree.nleft BETWEEN '4550' AND '6607'   
		 ORDER BY tm.member_id ASC";
        $RS_MEM = $this->SqlModel->runQuery($Q_MEM);   //PrintR($RS_MEM);die;
        $i =7025;
        if(count($RS_MEM)>0){
          foreach($RS_MEM as $AR_MEM):
             
             
             $member_id = $AR_MEM['member_id'];
              $this->SqlModel->updateRecord("tbl_cmsn_binary",array("member_id"=>$i),array("member_id"=>$member_id));
              $this->SqlModel->updateRecord("tbl_cmsn_binary_R",array("member_id"=>$i),array("member_id"=>$member_id));
              $this->SqlModel->updateRecord("tbl_cmsn_daily",array("member_id"=>$i),array("member_id"=>$member_id));
              
              $this->SqlModel->updateRecord("tbl_cmsn_mstr",array("member_id"=>$i),array("member_id"=>$member_id));
              $this->SqlModel->updateRecord("tbl_cmsn_pool",array("member_id"=>$i),array("member_id"=>$member_id));
              $this->SqlModel->updateRecord("tbl_cmsn_quick",array("member_id"=>$i),array("member_id"=>$member_id));
              $this->SqlModel->updateRecord("tbl_cmsn_royalty",array("member_id"=>$i),array("member_id"=>$member_id));
              $this->SqlModel->updateRecord("tbl_coinpayment",array("member_id"=>$i),array("member_id"=>$member_id));
              
              $this->SqlModel->updateRecord("tbl_level_members",array("member_id"=>$i),array("member_id"=>$member_id));
             
              $this->SqlModel->updateRecord("tbl_support",array("from_id"=>$i),array("from_id"=>$member_id));
              $this->SqlModel->updateRecord("tbl_support_rply",array("member_id"=>$i),array("member_id"=>$member_id));
              $this->SqlModel->updateRecord("tbl_wallet_trns",array("member_id"=>$i),array("member_id"=>$member_id));
              
              
              
                $this->SqlModel->updateRecord("tbl_cmsn_direct",array("member_id"=>$i),array("member_id"=>$member_id));
                $this->SqlModel->updateRecord("tbl_cmsn_direct",array("from_member_id"=>$i),array("from_member_id"=>$member_id));
                
                $this->SqlModel->updateRecord("tbl_cmsn_direct_R",array("member_id"=>$i),array("member_id"=>$member_id));
                $this->SqlModel->updateRecord("tbl_cmsn_direct_R",array("from_member_id"=>$i),array("from_member_id"=>$member_id));
                
                $this->SqlModel->updateRecord("tbl_fund_transfer",array("to_member_id"=>$i),array("to_member_id"=>$member_id));
                $this->SqlModel->updateRecord("tbl_fund_transfer",array("from_member_id"=>$i),array("from_member_id"=>$member_id));
                
                $this->SqlModel->updateRecord("tbl_members",array("member_id"=>$i),array("member_id"=>$member_id));
                $this->SqlModel->updateRecord("tbl_members",array("sponsor_id"=>$i),array("sponsor_id"=>$member_id));
                $this->SqlModel->updateRecord("tbl_members",array("spil_id"=>$i),array("spil_id"=>$member_id));
                
                $this->SqlModel->updateRecord("tbl_subscription",array("member_id"=>$i),array("member_id"=>$member_id));
                $this->SqlModel->updateRecord("tbl_subscription",array("bulk_by"=>$i),array("bulk_by"=>$member_id));
                $this->SqlModel->updateRecord("tbl_subscription",array("active_by"=>$i),array("active_by"=>$member_id));
                
                
              
              $i++;
            
          endforeach;
          
        } 
    }
     
	public function updatePool()  {
        $model = new OperationModel();
        $date_from = date('Y-m-d');
        
        
            $AR_PRSS = $model->getProcess();
            $start_date=$AR_PRSS['start_date'];
            $end_date=$AR_PRSS['end_date'];
            $process_id = $AR_PRSS['process_id'];
            
        
        
        $spilId = $model->getLastPoolSpillId();
         
        $position = $spilId['position'];
        $s_id = $spilId['spill_id'];
        $query = "SELECT member_id FROM `tbl_subscription` WHERE 1 and member_id not in (SELECT member_id FROM `tbl_level_members`) GROUP BY member_id ";
        $PageVal = 	  $this->SqlModel->runQuery($query,false);
        // PrintR($PageVal);die;
        foreach($PageVal as $V)
        {
            echo $V['member_id']."<br>";
              $level = $model->getLevelSpillId($s_id);
              $data = array(
                "member_id"       => $V['member_id'], 	
                "level"           => $level, 
                "spill_id"        => $s_id, 
                 "t_count"         => 1,
                "position"        => $position, 
                "date_time"       => $date_from  );
                $this->SqlModel->insertRecord("tbl_level_members",$data);
                
                if($position == 'R')
                {
                    $position = 'L';
                    $s_id = $s_id +1;   
                    $getParentspill = $model->getParentPoolSpill($s_id-1);
                    if($getParentspill > 0 )
                    {
                      $count = $model->countParentPoolSpill($getParentspill); 
                      if($count >= 4)
                      {
                          if($this->setPoolnext($getParentspill,$s_id,$position,$date_from,$end_date,$process_id))
                          {
                              $position = 'R';    
                          }
                          
                      }
                    }
                     
                    
                   
                    
                }
                else
                {
                   $position = 'R'; 
                }
                
                
          
 
 




 
  
        }
    }
    public function setPoolnext($getParentspill,$s_id,$position,$date_from,$end_date,$process_id)  {
        
        
     $model = new OperationModel();
     $memberId = $model->getPoolMemberId($getParentspill);
     
     $this->db->query("UPDATE `tbl_level_members` SET `status` =  'Y'  WHERE id ='$getParentspill';"); 
     $level = $model->getLevelSpillId($s_id);
            $counts = $model->checkCount("tbl_level_members",'member_id',$memberId);
            $counts = $counts +1;
     $data = array(
                "member_id"       => $memberId, 	
                "level"           => $level, 
                "spill_id"        => $s_id, 
                "t_count"         => $counts,
                "position"        => $position, 
                "date_time"       => $date_from  );
                $this->SqlModel->insertRecord("tbl_level_members",$data);
                $count = $model->checkCount("tbl_cmsn_pool",'member_id',$memberId);
                $count = $count +1;
                
                $pool = array("process_id" =>$process_id , 	"member_id" =>$memberId  ,  	"pool_no" =>$count,	"amount" =>70	,"upgrade" =>20	,"net_income" => 50	, "date_time" =>$end_date ); 
                $this->SqlModel->insertRecord("tbl_cmsn_pool",$pool);
                
                
                
    return true; 
    }
      public function updatepairMatch() {
        $model = new OperationModel();
        $this->db->query("UPDATE `tbl_members` SET `pair_match` = 0 WHERE 1;"); 
	        $QR_MEM = "SELECT SUM(pair_match) as total, member_id FROM `tbl_cmsn_binary` WHERE 1 GROUP BY `member_id` ";
            $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
			foreach($RS_MEM as $AR_MEM){
			    $match     = $AR_MEM['total'];
			    $member_id = $AR_MEM['member_id'];
			    if($match > 0 )
			    {
			        $this->db->query("UPDATE `tbl_members` SET `pair_match` = pair_match+$match WHERE member_id ='$member_id';"); 
			    }
			    
			}
    }
    
   
    public function updateDirectSetPos($left_right) {
    $model = new OperationModel();    
    $QR_MEM = "SELECT m.member_id , COUNT(m1.member_id) as total FROM `tbl_members` as m LEFT JOIN tbl_members as m1 ON m1.sponsor_id = m.member_id AND m1.subcription_id > 0 AND m1.left_right ='$left_right' WHERE 1 GROUP BY m.member_id";
    $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
			 $i = 1;
			foreach($RS_MEM as $AR_MEM)
			{
			$member_id = $AR_MEM['member_id']; 
			$total = $AR_MEM['total']; 
            echo "<br>".$member_id; 
			if($total > 0  )
			{
			   if($left_right =='L')
			   {
			     $this->db->query("UPDATE `tbl_members` SET `isDirectL` =  $total    WHERE member_id ='$member_id';");  
			   }
			   else
			   {
			     $this->db->query("UPDATE `tbl_members` SET `isDirectR` =  $total    WHERE member_id ='$member_id';");  
			   }
			    
			}
			
			  
			} 
    }   
   
    
     public function setupLevelbusinessold()               {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
              //  $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
                $QR_MEM = "select subcription_id,member_id,prod_pv from tbl_subscription where date_from  <='$end_date'  and isSetPV ='N' ";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
           //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			    
			    $subcription_id = $AR_MEM['subcription_id'];
			    $member_id      = $AR_MEM['member_id'];
			    $prod_pv        = $AR_MEM['prod_pv'];
			    $memberList = $model->memberParentLevelLists($member_id);
			    echo "<br>".$subcription_id.'-------'.date('H:i:s');
			    if(count($memberList) > 0 )
			    {
			      $i =0;
			      $open = 'Y';
			      foreach($memberList as $list)
			      {
                        $member_id       = $list['member_id'];
                        $sponsor_id      = $list['sponsor_id'];
                            if($i > 0 )
                            {
                              $this->db->query("UPDATE `tbl_members` SET `team_bv` = team_bv+$prod_pv  WHERE member_id ='$member_id';");
                            }
                            else
                            {
                              $this->db->query("UPDATE `tbl_members` SET `self_bv` = self_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                            
                            if($i ==1)
                            {
                                 $this->db->query("UPDATE `tbl_members` SET `direct_bv` = direct_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                          
                     
                        
                       
                        $i++;
			      }
			    }
			    $this->SqlModel->updateRecord("tbl_subscription", array("isSetPV" => "Y") ,array("subcription_id"=>$subcription_id));
			    
            
			    
			    
			}
		  //$this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
    } 
   
	
	public function metalevelIncomesold()                     {
	    
		$model = new OperationModel();
//  for($k = 1;$k <= 18;$k++)
//  {
	    $AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
	    $start_date = $AR_PRSS['start_date'];
	    $end_date =$AR_PRSS['end_date'];
	    
		if($process_id>0)
		{
             $QR_MEM = "SELECT member_id ,prod_pv   from tbl_members  where    subcription_id >0 ";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);   //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			        //$id          = $AR_MEM['daily_cmsn_id'];
				    $member_id   = $AR_MEM['member_id'];
				    $collection  = $AR_MEM['prod_pv'];
				    
				    
                        $memberList = $model->memberParentLevelLists($member_id);
                        echo "<br>".$member_id ;
                        if(count($memberList) > 0 )
                        {
                        $i =0;
                      
                        foreach($memberList as $list)
                        {
                        $member_ids          = $list['member_id'];
                        $sponsor_id          = $list['sponsor_id'];
                        $count_directs       = $list['count_directs'];
                        $rank_id             = $list['rank_id'];
                        $subcription_id      = $list['subcription_id']; 
                        $team_bv             = $list['team_bv'];
                        $direct_bv           = $list['direct_bv']; 
                      
                       //$level_team =   returnLevelTeamBV($i);
                      // $level_direct =   returnLevelDirectBV($i);
                         
                          if($i <= 10)
                        {
                           
                            if($i ==1){
                                
                                 $T_Direct = 2;
                            }elseif($i==2){
                                
                               $T_Direct = 3;  
                                
                            }elseif($i==3){
                                
                               $T_Direct = 3;  
                                
                            }elseif($i==4){
                                
                               $T_Direct = 3;  
                                
                            }
                            elseif($i==5){
                                
                                 $T_Direct = 5;
                            }elseif($i==6){
                                
                                 $T_Direct = 5;
                            }elseif($i==7){
                                
                                 $T_Direct = 5;
                            }elseif($i==8){
                                
                                 $T_Direct = 5;
                            }elseif($i==9){
                                
                                  $T_Direct = 5;
                            }elseif($i==10){
                                
                                 $T_Direct = 5;
                            }else{
                                
                               $T_Direct = 10; 
                                
                            }
                            
                            // echo $i;die;
                            
                        }
                        
                       // else{$T_Direct = 10;}
                        if($i > 0 and  $i <= 10 and  $subcription_id > 0  )//and   $count_directs >= $T_Direct
                        {
                         
                          
                          
                        $level_percentage =   returnLevelPercentage($i);
                         // die;
                        $trans_amount = $collection * $level_percentage /100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                           
                           $postedData = array(   
				            "process_id"           => $process_id,
							"member_id"            => $member_ids,
							"from_member_id"       => $member_id,
							"level"                => $i,
							 
							"returns"              => $level_percentage,
							"total_income"         => $collection,
							"net_income"           => ($trans_amount>0)? $trans_amount:0,
							"date_time"            => $end_date);
			                 $this->SqlModel->insertRecord("tbl_cmsn_level",$postedData);
                        }
                        
                        
                        $i++;
                        }
                        }
				    
				     
				  
				   }
				 
 
		}
	 
//  }	
	}
    public function metalevelIncomesroi()                     {
	    
		$model = new OperationModel();
	    $AR_PRSS = $model->getProcess(1);
		$process_id = $AR_PRSS['process_id'];
	    $start_date = $AR_PRSS['start_date'];
	    $end_date =$AR_PRSS['end_date'];
    $Admin = $model->getValue("CONFIG_ADMIN_CHARGE");
    $Tds   = $model->getValue("CONFIG_TDS");
		if($process_id>0)
		{
            $QR_MEM = "SELECT member_id ,net_income ,type_id   from tbl_cmsn_daily  where    process_id    = '$process_id'";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);     //PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			
				    $member_id   = $AR_MEM['member_id'];
				    $collection  = $AR_MEM['net_income'];
				    $fuSerId = $model->getMemberUserId($member_id);
                        $memberList = $model->memberParentLevelLists($member_id);
                        echo "<br>".$member_id ;
                      //  PrintR($memberList);
                        if(count($memberList) > 0 )
                        {
                        $i =0;
                      
                        foreach($memberList as $list)
                        {
                        $member_ids          = $list['member_id'];
                        $sponsor_id          = $list['sponsor_id'];
                        $count_directs       = $list['count_directs'];
                        $rank_id             = $list['rank_id'];
                        $subcription_id      = $list['subcription_id']; 
                        
                        if($i <= 10)
                        {
                           
                            if($i ==1){
                                
                                 $T_Direct = 2;
                            }elseif($i==2){
                                
                               $T_Direct = 3;  
                                
                            }elseif($i==3){
                                
                               $T_Direct = 3;  
                                
                            }elseif($i==4){
                                
                               $T_Direct = 3;  
                                
                            }
                            elseif($i==5){
                                
                                 $T_Direct = 5;
                            }elseif($i==6){
                                
                                 $T_Direct = 5;
                            }elseif($i==7){
                                
                                 $T_Direct = 5;
                            }elseif($i==8){
                                
                                 $T_Direct = 5;
                            }elseif($i==9){
                                
                                  $T_Direct = 5;
                            }elseif($i==10){
                                
                                 $T_Direct = 5;
                            }else{
                                
                               $T_Direct = 10; 
                                
                            }
                            
                            // echo $i;die;
                            
                        }
                        
                       // else{$T_Direct = 10;}
                        if($i > 0 and  $i <= 10 and  $subcription_id > 0 and   $count_directs >= $T_Direct )//and   $count_directs >= $T_Direct and
                        {
                         
                         
                        $level_percentage =   returnLevelPercentage($i);
                         // die;
                        $trans_amount = $collection * $level_percentage /100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                           
                           $postedData = array(   
				            "process_id"           => $process_id,
							"member_id"            => $member_ids,
							"from_member_id"       => $member_id,
							"level"                => $i,
							"returns"              => $level_percentage,
							"total_income"         => $collection,
							"net_income"           => ($trans_amount>0)? $trans_amount:0,
							"date_time"            => $end_date);
							
							PrintR($postedData);die;
			                 $this->SqlModel->insertRecord("tbl_cmsn_level",$postedData);
			                    
                                // $trns_remark ="Level Income From Level $i <b> $fuSerId</b>";
                                // $total =     $trans_amount ;  
                                // $admin_charge = $total*$Admin/100;
                                // $tds_charge   = $total*$Tds/100;
                                // $net          = $total - ( $tds_charge + $admin_charge);
                                // $net          = ($net > 0 )?number_format((float)$net, 4, '.', ''):0;   
                                if($net > 0 )
                                {
                                // $model->wallet_transaction('1',"Cr",$member_ids,$net,$trns_remark,$end_date,$trans_no,1,"INCOME-LEVEL ROI");    
                                }
                        }
                        
                        
                        $i++;
                        }
                        }
				    
				     
				  
				   }
				 
 
		}
		
	}	
      public function setupbusiness()     {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
	//	PrintR($AR_PRSS);die;
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
                // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
                $QR_MEM = "select subcription_id,member_id,prod_pv from tbl_subscription where date_from  <='$end_date'  and isSetPV ='N'";
                $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
            //   PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			    
			    $subcription_id = $AR_MEM['subcription_id'];
			    $member_id      = $AR_MEM['member_id'];
			    $prod_pv        = $AR_MEM['prod_pv'] ;
			     
			    $memberList = $model->memberParentList($member_id);
			    echo "<br>".$subcription_id.'-------'.date('H:i:s');
			    if(count($memberList) > 0 )
			    {
			      $i =0;
			      $open = 'Y';
			      foreach($memberList as $list)
			      {
                        $member_id    = $list['member_id'];
                        $spil_id      = $list['spil_id'];
                        $left_right   = $list['left_right'];
                        $breaks       = $list['break_sts'];
                        if($breaks == 'Y')
                        {
                            $open = 'N';
                        }
                        
                        if($open == 'Y')
                        {
                            if($i > 0 )
                            {
                             if($pos =='L')
                             {
                                 $this->db->query("UPDATE `tbl_members` SET `left_pv` = left_pv+$prod_pv  WHERE member_id ='$member_id';");
                             }
                             else
                             {
                                 $this->db->query("UPDATE `tbl_members` SET `right_pv` = right_pv+$prod_pv WHERE member_id ='$member_id';"); 
                             }
                             
                            }
                        }
                        
                        
                        $pos = $left_right;
                        $i++;
			      }
			    }
			    $this->SqlModel->updateRecord("tbl_subscription", array("isSetPV" => "Y") ,array("subcription_id"=>$subcription_id));
			    
            
			    
			    
			}
		  // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
    }
	  public function rewardsss()         {
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
            
            $QR_MEM = "SELECT * FROM tbl_reward";
            $RS_REW  = $this->SqlModel->runQuery($QR_MEM);
            
  $QR_MEM = "SELECT tm.member_id ,tm.left_pv, tm.right_pv,tm.leftCrf FROM tbl_members AS tm where tm.member_id in (Select member_id from tbl_subscription)    ORDER BY tm.member_id ASC ";
		$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	    foreach($RS_MEM as $AR_MEM){
		 
				$member_id = $AR_MEM['member_id'];
		        $left_pv   = $AR_MEM['left_pv'];
                $right_pv  = $AR_MEM['right_pv'];
                $getBussiness= min($left_pv , $right_pv);
                
                
           foreach($RS_REW as $AR_REW){
             //  SELECT COUNT(*) as total FROM `tbl_members` WHERE `sponsor_id` = '$member_id' AND `self_pv` >=  '10000' 
               
                // $LR_Points = $model->getLeftRight($member_id);
                // $newLft =$LR_Points['Left'];
                // $newRgt =$LR_Points['Right'];

                // $getBussiness =  min($newLft,$newRgt);
               
                //   $getBussiness = $model->GetBussinessTotal($member_id);
                 
                //   PrintR($AR_REW);die;
                      $exist = $model->GtExistReward($member_id,$AR_REW['reward_id']);
                      if($exist <='0')
                      {
                        if($getBussiness >=  $AR_REW['pv'] ) 
                        {
                          $posted_data = array(
                          'process_id'   => $process_id,  
                          'member_id'    => $member_id,
                          'reward_id'    => $AR_REW['reward_id'] ,
                          'matching_pv'  => $AR_REW['matching_pv'] ,
                          'net_income'   => $AR_REW['amount'],
                          'description'  => $AR_REW['description'], 
                          'date_time'    => $end_date ,
                      );
                     
                        $this->SqlModel->insertRecord("tbl_cmsn_reward ",$posted_data); 
                        $rank_id = $AR_REW['reward_id'] ;
                        $this->db->query("UPDATE `tbl_members` SET `rank_id` =  $rank_id  WHERE member_id ='$member_id';");	  
                        }
                    }
                  
                   
                     
                 }
                
                
                
                
			}  
			 
			 
		 	
	 
	         } 
      public function binaryincomes()     {
	// 1:1 Binary Income
		$model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess(); //PrintR($AR_PRSS);die;
		$process_id = $AR_PRSS['process_id'];
		$end_date =$AR_PRSS['end_date'];
        ob_start();  
		if($process_id>0)
		{     
		    $QR_MEM = "SELECT tm.member_id,tm.rank_id,tm.type_id , tm.subcription_id,tm.rank_id,tm.left_pv,tm.prod_pv  ,tm.right_pv,tm.leftCrf,tm.rightCrf,tm.pair_match,tm.isDirectL,tm.isDirectR,  tm.RSide , tm.LSide FROM ".prefix."tbl_members AS tm where tm.subcription_id > 0    and tm.block_sts ='N'   and  tm.member_id in (Select member_id from tbl_subscription where date(date_from) <='$end_date' )   ORDER BY tm.member_id ASC";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
			
		  $QR_MEM = "SELECT tm.member_id,tm.type_id,tm.subcription_id,tm.sponsor_id,tm.user_id FROM ".prefix."tbl_members AS tm where   tm.member_id in (Select member_id from tbl_subscription where date(date_from) <= '$end_date' )       ORDER BY tm.member_id ASC";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);	
              
			foreach($RS_MEM as $AR_MEM){
			
                $member_id = $AR_MEM['member_id']; 
                
                $subcription_id = $AR_MEM['subcription_id'];
                $rank_id = $AR_MEM['rank_id'];
                 $prod_pv = $AR_MEM['prod_pv'];
                $isDirectL = $AR_MEM['isDirectL'];
                $isDirectR = $AR_MEM['isDirectR'];
                $type_id = $AR_MEM['type_id'];
                
                
                $LSides = $AR_MEM['LSide'];
                $RSides = $AR_MEM['RSide'];
                 
                echo "<br>".$member_id;
				if($member_id>0){ 
				$errors = 0 ;
			  	if($isDirectL > 1 and $isDirectR > 1){$errors =1; } else 	{   $errors =0; 	}
			 	
					if($errors > 0  ) {
 
                            $preLcrf = ($AR_MEM['leftCrf']>0)?$AR_MEM['leftCrf']:0;
                            $preRcrf = ($AR_MEM['rightCrf']>0)?$AR_MEM['rightCrf']:0;
                            $pair_match_O = $AR_MEM['pair_match'];
                            
                            $left_pv  = $AR_MEM['left_pv'];
                            $right_pv = $AR_MEM['right_pv'];
                            
                            $newLft    = $left_pv - $pair_match_O - $LSides;
                            $newRgt   = $right_pv - $pair_match_O - $RSides;
                             
                            
                            $newLft = $newLft>0? $newLft:0;
                            $newRgt = $newRgt>0?$newRgt:0;
                            $totalLft = $newLft;
                            $totalRgt = $newRgt;
                            
                        $binary_inc =	$model->gettotalbinaryincome($member_id);
				 	    $pair_match =  min($totalLft,$totalRgt);
				 	    
				 	    $LSide = 0;$RSide = 0;

                    // if($rank_id=='0'){
                        
                    //   $caping=125;  
                    // }elseif($rank_id=='1'){
                    //       $caping=150;
                    // }  elseif($rank_id=='2'){
                    //       $caping=175;
                    // } 
                    // elseif($rank_id=='3'){
                    //       $caping=200;
                    // } 
                    // elseif($rank_id=='4'){
                    //      $caping=250; 
                    // } 
                    // elseif($rank_id=='5'){
                    //     $caping=300;  
                    // } 
                   
				        

				       $percent = 10;
				       $caping = 500;
		    			$amount =  ($pair_match*$percent/100);
						$binary_narration = '';
		    			if($amount > 0){
		    			    
		    			    
		    			    PrintR($RS_MEM);die;  
			        	$amount1= $amount;
        		
        			 
        			 		if($amount > $caping)
        						{
        						        $binary_ceiling = $amount-$caping;
        						    	$amount =$caping;
        						}
        						else
        						{
        						    $binary_ceiling=0;
        						}
        						$amount1= $amount;
						 
					   
					    $net     = $amount ;
        			 
        			 
        			 
        			 
        			 
        			 
        			 
        			 
        			 
        			 
					    //$Reserve = $amount *75/100;
						$data_binary =array(
						    "process_id"           =>$process_id,
							"member_id"            =>$member_id,
							"type_id"              =>$rank_id,
							"preRcrf"              =>($preRcrf>0)? $preRcrf:0,
							"preLcrf"              =>($preLcrf>0)? $preLcrf:0,
							"newLft"               =>($newLft>0)? $newLft:0,
							"newRgt"               =>($newRgt>0)? $newRgt:0,
							"totalLft"             =>($totalLft>0)? $totalLft:0,
							"totalRgt"             =>($totalRgt>0)? $totalRgt:0,
							"pair_match"           =>($pair_match>0)? $pair_match:0,
							"leftCrf"              =>($leftCrf>0)? $leftCrf:0,
							"rightCrf"             =>($rightCrf>0)? $rightCrf:0,
							"binary_rate"          =>($binary_rate>0)? $binary_rate:0,
							"binary_ceiling"       =>($binary_ceiling>0)? $binary_ceiling:0,
							"binary_narration"     =>$binary_narration,
							"amount"               =>($amount>0)? $amount:0,
							"cash_account"         => ($Reserve>0)? $Reserve:0,
						 
							"net_cmsn"             =>($net>0)? $net:0,
							"date_time"            =>$end_date
						);
						     
		 // PrintR($data_binary);  

			 $this->SqlModel->insertRecord(prefix."tbl_cmsn_binary",$data_binary);	
				
				  $this->db->query("UPDATE `tbl_members` SET `pair_match` = pair_match+$pair_match ,leftCrf ='$leftCrf' , rightCrf = '$rightCrf' ,RSide =RSide + $RSide, LSide = LSide + $LSide  WHERE member_id ='$member_id';");	  
				}
					$amount = 0;
                    $member_id= 0;
                    $rank_id= 0;
                    $preRcrf= 0;
                    $preLcrf= 0;
                    $newLft= 0;
                    $newRgt= 0;
                    $totalLft= 0;
                    $totalRgt= 0;
                    $pair_match= 0;
                    $leftCrf= 0;
                    $rightCrf= 0;
                    $binary_rate= 0;
                    $binary_ceiling= 0;
                    $binary_narration= 0;
                    $amount1= 0;
					 
					
			 	 }
			 	 
			 	  
				    
				}
                ob_flush();
                flush();
			}

			echo "done";
	 
		
		}
	 ob_end_flush();
	}
 

    
    
    
    public function checksts()
    {
            $model = new OperationModel();
          
            
                
                $data  = $this->SqlModel->runQuery("SELECT * FROM `tbl_coinpayment` WHERE `status` = 'N' and  ( coin ='TRX' or coin   = 'BUSD.BEP20' ||   coin = 'USDT.TRC20' ||   coin = 'BTC' || coin ='ETH')");  
                if(is_array($data) and !empty($data))
                {
                foreach($data as $d)
                {
                
                $txid  = $d['txn_id'];
                $coin  = $d['coin'];
                $res = getStatusofTransaction($txid);
                 
           if($res->status =='-1')
           {
           
             $status_text = $res->status_text;
             $this->SqlModel->updateRecord("tbl_coinpayment",array("status" => "R", "status_text" =>$status_text ),array("id" => $d['id']));
           }
           if($res->status =='100')
           {
                    $amt = $d['amount'];
                    $net_amt = number_format($amt, 4, '.', '');  ; // floor($amt*99.4/100);
                    $status_text = $res->status_text;
                    $this->SqlModel->updateRecord("tbl_coinpayment",array("status" => "Y", "status_text" =>$status_text ),array("id" => $d['id']));  
                    $trans_no = rand(123434,4564563);
                    $trns_remark = "Fund added via Crypto"; 
                     $model->wallet_transaction('1',"Cr",$d['member_id'],$d['added_usd'],$trns_remark,date('Y-m-d'),$trans_no,1,"TRX");   
                    
                    
                    $model->wallet_transaction('50',"Cr",1,$net_amt,"Add Payment via Coinpayments",date('Y-m-d'),$trans_no,1,"TRX");   
                     
                    
                    $model->setWalletTRX($net_amt,'Cr');
           }
           
                }
                }
      
         
    } 

 public function checksts222() {
   //  echo date('Y-m-d H:i:s','1639988941');
   
   $model = new OperationModel();
   $data  = $this->SqlModel->runQuery("SELECT * FROM `tbl_coinpayment` WHERE `status` = 'N' and coin ='TRX'");  
   if(is_array($data) and !empty($data))
   {
       foreach($data as $d)
       {
              
           $txid = $d['txn_id'];
           $result  = $this->coinpayments->getTransactionStatus($txid);
           
        //   PrintR($result);
           $res = $result['result'];  
           $amt = $d['amount'];
           $net_amt = floor($amt*98/100);
           if($res['status'] =='-1')
           {
             // status_text
             $status_text = $res['status_text'];
             $this->SqlModel->updateRecord("tbl_coinpayment",array("status" => "R", "status_text" =>$status_text ),array("id" => $d['id']));
           }
           if($res['status'] =='100')
           {
                    $status_text = $res['status_text'];
                    $this->SqlModel->updateRecord("tbl_coinpayment",array("status" => "Y", "status_text" =>$status_text ),array("id" => $d['id']));  
                    $trans_no = rand(123434,4564563);
                    $trns_remark = "Fund added via Tron";
                    $model->wallet_transaction('3',"Cr",$d['member_id'],$d['added_usd'],$trns_remark,date('Y-m-d'),$trans_no,1,"TRX");   
                    
                    
                    $model->wallet_transaction('50',"Cr",1,$net_amt,"Add Payment via Coinpayments",date('Y-m-d'),$trans_no,1,"TRX");   
                     
                    
                    $model->setWalletTRX($net_amt,'Cr');
                    
                    
                    
           } 

            
       }
   }
//   [result] => Array
//         (
//             [time_created] => 1640936504
//             [time_expires] => 1640943704
//             [status] => -1
//             [status_text] => Cancelled / Timed Out
//             [type] => coins
//             [coin] => TRX
//             [amount] => 196200000000
//             [amountf] => 1962.00000000
//             [received] => 0
//             [receivedf] => 0.00000000
//             [recv_confirms] => 0
//             [payment_address] => TU1Y25vCNhjcYh2ri5W9g6mhBf1Zb5HiPQ
//             [sender_ip] => 216.10.243.240
//         )

// )
// Array
// (
//     [error] => ok
//     [result] => Array
//         (
//             [time_created] => 1640952643
//             [time_expires] => 1640959843
//             [status] => 100
//             [status_text] => Complete
//             [type] => coins
//             [coin] => TRX
//             [amount] => 191800000000
//             [amountf] => 1918.00000000
//             [received] => 191800000000
//             [receivedf] => 1918.00000000
//             [recv_confirms] => 10
//             [payment_address] => TGLUMJBLPp9gLRKeqb9G1VJ73x3eCDiMoC
//             [time_completed] => 1640953080
//             [send_tx] => 7668ea78a2b978e4d1fc2ef4f3313b0642e0e151da9129e7c35660f47d713ed0
//             [sender_ip] => 216.10.243.240
//         )

    //  
    
    
    
            // [id] => 3
            // [member_id] => 1
            // [txn_id] => CPFL2AMSXQR2TAYRWBEZKMRRWU
            // [amount] => 1962
            // [usd_price] => 0.076455841451882
            // [added_usd] => 150
            // [address] => TU1Y25vCNhjcYh2ri5W9g6mhBf1Zb5HiPQ
            // [type] => coins
            // [coin] => TRX
            // [confirms_needed] => 10
            // [timeout] => 7200
            // [checkout_url] => https://www.coinpayments.net/index.php?cmd=checkout&id=CPFL2AMSXQR2TAYRWBEZKMRRWU&key=b83b362e1611374bbcaff89f48d1ad5a
            // [status_url] => https://www.coinpayments.net/index.php?cmd=status&id=CPFL2AMSXQR2TAYRWBEZKMRRWU&key=b83b362e1611374bbcaff89f48d1ad5a
            // [qrcode_url] => https://www.coinpayments.net/qrgen.php?id=CPFL2AMSXQR2TAYRWBEZKMRRWU&key=b83b362e1611374bbcaff89f48d1ad5a
            // [status] => N
            // [date_time] => 2021-12-31 13:11:44
            // [time_created] => 1640936504
            // [time_expires] => 1640943704
            // [status_text] => Waiting for buyer funds...
    
     
//      Array
// (
//     [error] => ok
//     [result] => Array
//         (
//             [time_created] => 1639029861
//             [time_expires] => 1639037061
//             [status] => 100
//             [status_text] => Complete
//             [type] => coins
//             [coin] => TRX
//             [amount] => 1000000000
//             [amountf] => 10.00000000
//             [received] => 1000000000
//             [receivedf] => 10.00000000
//             [recv_confirms] => 10
//             [payment_address] => TVn2AMvguEqwT1x4hZf4ep8Z81jcx974qC
//             [time_completed] => 1639033441
//             [send_tx] => 68a094cbd653d9ea8b2fef15988eb38c81d383679d103f4b8adf7138ea6c713b
//             [sender_ip] => 216.10.244.207
//         )

// )





// Array
// (
//     [error] => ok
//     [result] => Array
//         (
//             [time_created] => 1639981741
//             [time_expires] => 1639988941
//             [status] => 0
//             [status_text] => Waiting for buyer funds...
//             [type] => coins
//             [coin] => TRX
//             [amount] => 1000000000
//             [amountf] => 10.00000000
//             [received] => 0
//             [receivedf] => 0.00000000
//             [recv_confirms] => 0
//             [payment_address] => TYx3b79QXNqBNvHRBSs2GqgY1M2ydeKRDr
//             [sender_ip] => 216.10.243.240
//         )

// )
}    
    public function getreedeem()
    {
                $date = date('Y-m-d');
                $model = new OperationModel();
                $data  = $this->SqlModel->runQuery("SELECT member_id  FROM `tbl_subscription` WHERE `bulk_by` = '0'");  
                if(is_array($data) and !empty($data))
                {
                foreach($data as $d)
                {
        
        	   $getMemberId = $model->superreferal($d['member_id']);  
		       foreach($getMemberId as $AR_DT){
		   	   $LDGR = $model->getCurrentBalance($AR_DT['member_id'],'1',$_REQUEST['from_date'],$_REQUEST['to_date']);

          if($LDGR['net_balance']>= .01 )
          { 
              
                    $userId = $model->getMemberUserId($d['member_id']);
                    $trns_remark = "Redeem Wallet To [".$user_id."]";
                    $model->wallet_transaction(1,"Dr",$AR_DT['member_id'],$LDGR['net_balance'],$trns_remark,$date,rand('1111',777777),"1","RETRIEVE"); 
                    $trns_remark = "Redeem Wallet From [".$AR_DT['user_id']."]";
                    $model->wallet_transaction(1,"Cr",$d['member_id'],$LDGR['net_balance'],$trns_remark,$date,rand('1111',777777),"1","RETRIEVE");
          }  
		   	}   
		   
    }}}
    
    
    public function checkBalenceofAPI()
    {
        
  echo getBalanceByAddress("TEHw5NZtdDYE7b7MdZvsKHXwhWAPbKmaMT");die;
  $Sname = $_SERVER['SERVER_NAME'];  
  $parameters="serverName=$Sname";
  $url="https://vertoindia.in/dmt/api/getTronAuth";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
 

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
	$return_val = curl_exec($ch);
    $api_res = json_decode($return_val);   
     
        if($api_res->Status)
        {
                    $authKey  = $api_res->authKey;
                    $parameters="authKey=$authKey&&serverName=$Sname&address=TEHw5NZtdDYE7b7MdZvsKHXwhWAPbKmaMT";
                    $url="https://vertoindia.in/dmt/api/getbalance";
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_POST,1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                    curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                    $return_val = curl_exec($ch);
                    $api_result = json_decode($return_val);
                    $api_recharge = $api_result->API;
                    PrintR($api_result);die;
                    
        }
        else
        {
            echo "Inactive Your API";
        }
    }
    
    public function sendTronByAPI()
    {
                
     
     PrintR($dd);
     die;
  $Sname = $_SERVER['SERVER_NAME'];  
  $parameters="serverName=$Sname";
  $url="https://vertoindia.in/dmt/api/getTronAuth";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
 

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
	$return_val = curl_exec($ch);
    $api_res = json_decode($return_val);   
     
        if($api_res->Status)
        {
                    $authKey    = $api_res->authKey;
                    $member_id  = '1';  
                    $user_id    = 'Admin';
                    $parameters="authKey=$authKey&&serverName=$Sname&trx=1&to_address=TNacrKj34UqXwtfeF8wNjhGUMvpYHKaEYD&member_id=$member_id&user_id=$user_id";
                $url="https://vertoindia.in/dmt/api/sendTrons";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                $return_val = curl_exec($ch);
                $api_result = json_decode($return_val);
                $api_recharge = $api_result->API;
                PrintR($api_result);die;
    }
        else
        {
            echo "Inactive Your API";
        }
    }
public function vvv()
{
    echo _d("mrmqwMRcb3FoYGZ%2B");
}


           
public function makwithDR()
{
      $model = new OperationModel();
     
      $sql = "SELECT * FROM `tbl_fund_transfer` WHERE `trns_for` = 'WITHDRAW' AND `trns_status` = 'C' AND `trans_no` NOT in (SELECT trans_ref_no from tbl_wallet_trns)";
                $RS_MEM  = $this->SqlModel->runQuery($sql);
                // PrintR($RS_MEM);die;
                foreach($RS_MEM as $AR_MEM){
            
                $trans_no    =      $AR_MEM['trans_no'];
                $member_id   =      $AR_MEM['to_member_id'];
                $draw_amount =      $AR_MEM['initial_amount'];
                $trns_remark =      $AR_MEM['trns_remark'];
                $trns_date   =      $AR_MEM['date_time'];
            
     
								$trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
								$model->wallet_transaction(1,"Dr",$member_id,$draw_amount,$trns_remark,$trns_date,$trans_no,"1","MW");
}}

public function getsts()
{
    $result  = $this->coinpayments->CreateTransactionSimple(10, 'TRX', 'TRX', 'd');
//     [error] => ok
//     [result] => Array
//         (
//             [amount] => 10.00000000
//             [txn_id] => CPFL0CUMHNGV4NHZZOJTZOIQPZ
//             [address] => TYx3b79QXNqBNvHRBSs2GqgY1M2ydeKRDr
//             [confirms_needed] => 10
//             [timeout] => 7200
//             [checkout_url] => https://www.coinpayments.net/index.php?cmd=checkout&id=CPFL0CUMHNGV4NHZZOJTZOIQPZ&key=c572779f931674b400fa9631e363d56d
//             [status_url] => https://www.coinpayments.net/index.php?cmd=status&id=CPFL0CUMHNGV4NHZZOJTZOIQPZ&key=c572779f931674b400fa9631e363d56d
//             [qrcode_url] => https://www.coinpayments.net/qrgen.php?id=CPFL0CUMHNGV4NHZZOJTZOIQPZ&key=c572779f931674b400fa9631e363d56d
//         )

// )

if($result['error'] =='ok')
{
    $res = $result['result'];  
    
     //	id	member_id	txn_id	amount	address	confirms_needed	timeout	checkout_url	status_url	qrcode_url	status	date_time
      $status  = $this->coinpayments->getTransactionStatus($res['txn_id']);
      $sts = $status['result'];
     
     $member_id = 1;
      
     $data = array(
                        "member_id"         =>  $member_id ,         
                        "txn_id"            =>   $res['txn_id'],      
                        "amount"            =>   $res['amount'],      
                        "address"           =>   $res['address'],       
                        "confirms_needed"   =>   $res['confirms_needed'],               
                        "timeout"           =>   $res['timeout'],       
                        "checkout_url"      =>   $res['checkout_url'],            
                        "status_url"        =>   $res['status_url'],          
                        "qrcode_url"        =>   $res['qrcode_url'],          
                        "status"            =>   'N',      
                        "date_time"         =>   date('Y-m-d H:i:s'),    
                        
                        "time_created"      =>  $sts['time_created'],             
                        "time_expires"      =>  $sts['time_expires'],             
                        "status_text"       =>  $sts['status_text'],            
                        "type"              =>  $sts['type'],     
                        "coin"              =>  $sts['coin'],     
                        // "time_completed"    =>  $sts['time_completed'],               
                        // "send_tx"           =>  $sts['send_tx'],        
                        
                        
                        
                        );
     $this->SqlModel->insertRecord(prefix."tbl_coinpayment",$data);
}



    PrintR($res);
}

 public function reedemAll()         {
     
      $model = new OperationModel();
      $date = date('Y-m-d');
      
                $sql = "SELECT * FROM `tbl_subscription` WHERE bulk_by ='0'";
                $RS_MEM  = $this->SqlModel->runQuery($sql);
                // PrintR($RS_MEM);die;
                foreach($RS_MEM as $AR_MEM){
                  
                  $member_id = $AR_MEM['member_id'];  
                  $getMemberId = $model->superreferal($member_id); 
                        foreach($getMemberId as $AR_DT){
                        $LDGR = $model->getCurrentBalance($AR_DT['member_id'],'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
                        
                        if($LDGR['net_balance']>=  5 )
                        { 
                        
                        $userId = $model->getMemberUserId($member_id);
                        $trns_remark = "Redeem Wallet To [".$user_id."]";
                        $model->wallet_transaction(1,"Dr",$AR_DT['member_id'],$LDGR['net_balance'],$trns_remark,$date,rand('1111',777777),"1","REDEEM"); 
                        $trns_remark = "Redeem Wallet From [".$AR_DT['user_id']."]";
                        $model->wallet_transaction(1,"Cr",$member_id,$LDGR['net_balance'],$trns_remark,$date,rand('1111',777777),"1","REDEEM");
                        }  
                        }   
                }
       
		   
		 
 }
 public function setWithdraw()       {
     $model = new OperationModel();
     
      $sql = "SELECT * FROM `tbl_subscription` WHERE bulk_by ='0'";
                $RS_MEM  = $this->SqlModel->runQuery($sql);
               //  PrintR($RS_MEM);die;
                foreach($RS_MEM as $AR_MEM){
                    
                    
                            $order_idd  =time().rand('1111',9999);
                            $substr = substr($order_idd, 4, 14);
                            $order_idd =    'CWCX'.$substr;
                            
                    $member_id        =   $AR_MEM['member_id'];  
                    $bankDetail       =   $model->getBankDetailMember($member_id);
                    $account_number   =   $bankDetail['account_number'];
                    $ifc_code         =   $bankDetail['ifc_code'];
                    $bank_acct_holder =   $bankDetail['bank_acct_holder'];
                    $member_mobile    =   $bankDetail['member_mobile'];        
		            $userid           =   $bankDetail['user_id'];
	            	     
                $LDGR = $model->getCurrentBalance($member_id,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
                    $amount = $LDGR['net_balance'];
                    $charge =    $amount *3/100;
                    $amount1 =   $amount -$charge;
                if($amount >= 1 )
                { 
                   if($account_number !='' and  $ifc_code !='' and  $bank_acct_holder !='')
                   { 
              $moneytransfer_data = array(
        		                            'member_id'=>$member_id,
        					                'ben_name'=> $bank_acct_holder, 
        			                        'account_number'=>$account_number,
        			                        'ifsc_code' =>$ifc_code,
        									'mode'=>'IMPS',
        									 "mobile" =>$member_mobile,
        									'amount'=>floor($amount1*75),
        									'dmt_amt' =>floor($amount*75),
                                            'charge'=>floor(($charge)*75),
                                            'total'=>floor($amount*75),
                                            'rate'=>0,
        									'orderid'=>$order_idd,
        									'type'=>'2',
        									'txid' => '',
        									'status' =>  'Pending',
        									'message' =>  '',
        									'operator_message' =>  '',
        									'response' => '',
        									'date'=>date('Y-m-d H:i:s')
        									);
        									
        								//	PrintR($moneytransfer_data);die;
                                        $trns_id =     $this->SqlModel->insertRecord(prefix."tbl_money_transfer",$moneytransfer_data);
              
                                        $trns_date = date('Y-m-d H:i:s');
                                        $trans_no = UniqueId("TRNS_NO");
                                        
        								$trns_remark = "Money Transfer FROM [".$userid."]  Name :".$bank_acct_holder.' A/c: '.$account_number.' IFSC :'.$ifc_code ;
        								$model->wallet_transaction(1,"Dr",$member_id,$amount,$trns_remark,$trns_date,$trans_no,"1","MT");
                        }
                   else{ echo $userid.'  => '.$amount ."<br>";}    
                    
                }
                }
						        
             
 }
 public function setWithdrawsss()   {
     $model = new OperationModel();
     
      $sql = " SELECT * FROM `tbl_money_transfer` WHERE `status` = 'Pending'";
                $RS_MEM  = $this->SqlModel->runQuery($sql);
               //  PrintR($RS_MEM);die;
                foreach($RS_MEM as $AR_MEM){
                        $sender_id = $AR_MEM['sender_id'];$member_id = $AR_MEM['member_id'];
                        $this->SqlModel->deleteRecord("tbl_money_transfer",array("sender_id"=>$sender_id));  
                        $this->SqlModel->deleteRecord("tbl_wallet_trns",array("member_id"=>$member_id,'trns_for' => 'MT'  , 'trns_date' => '2021-12-06'));  
                    
                }
						        
             
 }
 

 
 
    public function setId() {
        
        $model = new OperationModel();
        $today_date = date('Y-m-d');	 
        $sponsor_id =  1;
        $left_right = 'L';
        for($i= 1; $i<=50 ; $i++) { 
        
        $AR_GET = $model->getSponsorSpill($sponsor_id,$left_right);
       
        $spil_id =  FCrtRplc($AR_GET['spil_id']);
       
       
		$user_id = $model->generateUserId();
		$trns_password = $user_password = 1234556;
									$data = array(
									    "first_name"=>'Admin',
										"full_name"=>'Admin',
										"user_id"=>$user_id,
										"user_name"=>$user_id,
										"user_password"=>$user_password,
										"trns_password"=>$trns_password,
										"member_email"=>'admin@gmail.com',
									    
										"sponsor_id"=>$sponsor_id,
										"spil_id"=>$spil_id,
										"left_right"=>$left_right,
									 
									 
									 
										"member_mobile"=> '9876543211',
										"date_join"=>$today_date,
										"pan_status"=>"N",
										"status"=>"Y",
										"last_login"=>$today_date ,
										"login_ip"=>$_SERVER['REMOTE_ADDR'],
										"block_sts"=>"N",
										"sms_sts"=>"N",
									 
										"type_id"=>0
										
									);	

									if($Ctrl==0){
										 	$member_id = $this->SqlModel->insertRecord(prefix."tbl_members",$data);
											$tree_data = array("member_id"=>$member_id,
												"sponsor_id"=>$sponsor_id,
												"spil_id"=>$spil_id,
												"nlevel"=>0,
												"left_right"=>$left_right,
												"nleft"=>0,
												"nright"=>0,
												"date_join"=>$today_date
											);
											$this->SqlModel->insertRecord(prefix."tbl_mem_tree",$tree_data);
											$model->updateTree($spil_id,$member_id);
								 
                                             $sponsor_id =  $member_id;
  
									} 

										}
        
    }
    public function runPayout() {
                    // $this->setDirectMembers();
                    
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupDirectleftRight 1"));  
                    $this->setupDirectleftRight();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupDirectleftRight 2"));  
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness 1"));  
                    $this->setupbusiness(); 
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness 2"));  
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"eligibilities 1"));  
                    $this->eligibilities();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"eligibilities 2"));  
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupEgles 1"));  
                    $this->setupEgles();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupEgles 2"));  
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setEgleRank 1"));  
                    $this->setEgleRank();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setEgleRank 2"));  
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"leaderShipBonus 1"));  
                    $this->leaderShipBonus();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"leaderShipBonus 2"));  
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"directcommissions 1"));  
                    $this->directcommissions();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"directcommissions 2")); 
                    
                    
                     
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"binaryincomes 1"));  
                    $this->binaryincomes();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"binaryincomes 2"));  
                   
                    
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"dailyReturns 1"));  
                    $this->dailyReturns();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"dailyReturns 2"));  
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"updatePool 1"));  
                    $this->updatePool();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"updatePool 2"));  
                    
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"directROI 1"));  
                    $this->directROI();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"directROI 2"));  
                    
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"matchingROI 1"));  
                    $this->matchingROI();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"matchingROI 2"));  
                    
                    
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupRoyaltyUsers 1"));  
                    $this->setupRoyaltyUsers();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupRoyaltyUsers 2"));  
                    
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupRoyaltyIncomes 1"));  
                    $this->setupRoyaltyIncomes();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupRoyaltyIncomes 2"));  





                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"totalcommission 1"));  
                    $this->totalcommission();
                    $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"totalcommission 2"));   
                    
                      
                  
                    
	         }
    public function setDirectMembers() {
            $model = new OperationModel();
            $AR_PRSS = $model->getProcess();
            $start_date=$AR_PRSS['start_date'];
            $end_date=$AR_PRSS['end_date'];
            $process_id = $AR_PRSS['process_id'];
        //  // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setDirectMembers"));   
	      $QR_MEM = "SELECT member_id,subcription_id  FROM  tbl_subscription   WHERE     date_from <='$end_date' and  isReferral ='Y'";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	       // PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
                $member_id = $AR_MEM['member_id']; 
                $subcription_id = $AR_MEM['subcription_id']; 
                echo "<br>".$subcription_id;
                $sponsor_id = $model->getsponsorId($member_id); 
                if($sponsor_id > 0 )
                {
                    $refList  = $model->getreferrals($sponsor_id);   
                    if(count($refList) > 0)
                    {
                        foreach($refList as $res)
                        {
                              $subcription_id = $res['subcription_id'];
                              $this->SqlModel->updateRecord("tbl_subscription", array("isReferral" => "N") ,array("subcription_id"=>$subcription_id));
                              
                              
                        } 
                    } 
                    
                }
                
                
			    
			}
// 		// $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setDirectMembers")); 	
			echo "Done setDirectMembers";
	  }

    public function eligibilities() {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
        ob_start();
 
    //   // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"eligibility")); 
		if($process_id>=0){
	  	    
	  	    $QR_MEM = "Select m.member_id,m.rank_id,m.isDirectL,m.isDirectR,s.date_from ,s.subcription_id,m.left_pv,m.right_pv  from tbl_members as m LEFT JOIN tbl_subscription as s ON m.member_id = s.member_id where m.block_sts ='N' and m.rank_id ='0' and  m.member_id IN (Select member_id from tbl_subscription where Date(date_from) <= '$end_date') ORDER BY   `m`.`member_id`  DESC ";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	        //PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			   
			      echo "<br>". $member_id = $AR_MEM['member_id'];
			      $rank_id   = $AR_MEM['rank_id'];
			      $isDirectL   = $AR_MEM['isDirectL'];
			      $isDirectR   = $AR_MEM['isDirectR'];
			      
                $left_pv   = $AR_MEM['left_pv'];  
                $right_pv  = $AR_MEM['right_pv'];
                   
			      if($rank_id =='0')
			      {
			         
                                if(( $left_pv >= 100 and  $right_pv >= 200)  or ( $left_pv >= 200 and  $right_pv >= 100)  )
                                { 
                                $this->SqlModel->updateRecord(prefix."tbl_members",array("rank_id"=>"1"),array("member_id"=>$member_id)); 
                                 
                                }
                               
                         
                     }
                     
                    
				  
			      }
			      
			        ob_flush();
                    flush();
               
		}  
// 		// $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"eligibility")); 
		ob_end_flush();
			    echo "Done eligibility";
      }
    public function setupEgles()   {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
	   //  // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupEgles")); 	
            $QR_MEM = "select  member_id  from tbl_members where  rank_id >='1' and isEgle ='N'";
            $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
             //PrintR($RS_MEM);die; 
			foreach($RS_MEM as $AR_MEM){
			    
			  
			    $member_id      = $AR_MEM['member_id'];
			    $mid = $member_id;
			    $memberList = $model->memberParentList($member_id);
			    echo "<br>".$member_id ;
			    if(count($memberList) > 0 )
			    {
			      $i =0;
			      foreach($memberList as $list)
			      {
                        $member_id    = $list['member_id'];
                        $spil_id      = $list['spil_id'];
                        $left_right   = $list['left_right'];
                        if($i > 0 )
                        {
                         if($pos =='L')
                         {
                             $this->db->query("UPDATE `tbl_members` SET `left_Egle` = left_Egle+1  WHERE member_id ='$member_id';");
                         }
                         else
                         {
                             $this->db->query("UPDATE `tbl_members` SET `right_Egle` = right_Egle+1 WHERE member_id ='$member_id';"); 
                         }
                         
                        }
                        $pos = $left_right;
                        $i++;
			      }
			    }
			    $this->SqlModel->updateRecord("tbl_members", array("isEgle" => "Y") ,array("member_id"=>$mid));
			    
            
			    
			    
			}
// 		 // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupEgles")); 
		echo " Done setupEgles";
    }
    public function setEgleRank() {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
        ob_start();
 
        // // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setEgleRank"));       
		if($process_id>=0){
	  	    
	  	    $QR_MEM = "Select m.member_id,m.rank_id,m.left_Egle,m.right_Egle   from tbl_members as m   where m.block_sts ='N' and m.member_id IN (Select member_id from tbl_subscription where Date(date_from) <= '$end_date') ORDER BY   `m`.`member_id`  DESC ";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	        //PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			   
			      echo "<br>". $member_id = $AR_MEM['member_id'];
			      $rank_id   = $AR_MEM['rank_id'];
			      
			      $L   = $AR_MEM['left_Egle'] ;
			      $R   = $AR_MEM['right_Egle'] ;
			      
			      $rank_id = ($rank_id > 0)?$rank_id:'1';
             
			     //  1 ,11 36 , 102 , 325 , 975 , 2600, 6200 , 13000 , 25000, 50000
                  
			      if(true)
			      {
			                $rnk_id =0;
                            $counts = min($L,$R);
                           
			          if($counts >= '103561' )
			          {
			               $rnk_id =12;
			          }
			          elseif($counts >=  '28561' and $counts <  '53561' )
			          {
			               $rnk_id =11; 
			          }
			          elseif($counts >=  '15561' and $counts <  '28561' )
			          {
			               $rnk_id =10; 
			          }
			          elseif($counts >=  '9361' and $counts <  '15561' )
			          {
			               $rnk_id =9; 
			          }
			          elseif($counts >=  '4050' and $counts <  '9361' )
			          {
			               $rnk_id =8;  
			          }
			          elseif($counts >=  '1450' and $counts <  '4050' )
			          {
			              $rnk_id =7; 
			          }
			          elseif($counts >=  '475' and $counts <  '1450' )
			          {
			              $rnk_id =6; 
			          }
			          elseif($counts >=  '150' and $counts <  '475' )
			          {
			              $rnk_id =5;  
			          }
			          elseif($counts >=  '48' and $counts <  '150' )
			          {
			             $rnk_id =4;  
			          }
			          elseif($counts >=  '12' and $counts <  '48' )
			          {
			             $rnk_id =3;  
			          }
			          elseif($counts >=  '1' and $counts <  '12' )
			          {
			             $rnk_id =2;   
			          }
			          else
			          {
			              $rnk_id =1; 
			          }
			      
			          if($rnk_id > $rank_id)
			          {  
			           $this->SqlModel->updateRecord(prefix."tbl_members",array("rank_id"=>$rnk_id),array("member_id"=>$member_id));    
			          }
 
			          
			      }
			     
			        ob_flush();
                    flush();
               
			}}   
		// $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setEgleRank"));  
	 echo "Done setEgleRank";
			        
 ob_end_flush();
			    
      }
    public function leaderShipBonus(){
	      
	      
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		$today_date = $end_date; 
		 		 
	 	ob_start();

	  	$QR_CMSN = "SELECT  member_id ,rank_id FROM tbl_members   where   rank_id > 1 ";
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN);
        // PrintR($RS_CMSN);die;
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN):
					$rank_id = $AR_CMSN['rank_id'];
					$member_id = $AR_CMSN['member_id'];
					echo "<br>".$member_id; 
                          
                  
					if( $member_id>0  ){
					
  
						
					    	$getlastrank  = $model->getlastrank($member_id);
					    	
			if($rank_id > $getlastrank )
			{
			     
			    for($i = $getlastrank ; $i <= $rank_id;$i++ )
			    {
			         if($i ==2)      { $amt = 5;     $RANK  = 'Elite Executive ';  }
			         elseif($i == 3) { $amt = 50;    $RANK  = 'Sr. Executive'; }
			         elseif($i == 4) { $amt = 100;   $RANK  = 'Team Leader'; }
			         elseif($i == 5) { $amt = 150;   $RANK  = 'Manager'; }
			         elseif($i == 6) { $amt = 250;   $RANK  = 'Sr. Manager'; }
			         elseif($i == 7) { $amt = 500;   $RANK  = 'Executive Manager';  }
			         elseif($i == 8) { $amt = 1000;  $RANK  = 'Sr. Executive Manager'; }
			         elseif($i == 9) { $amt = 2500;  $RANK  = 'Associate Director';  }
			         elseif($i == 10){ $amt = 5000;  $RANK  = 'Global Director';  }
			         elseif($i == 11){ $amt = 7500;  $RANK  = 'Elite Ambassador';  }
			         elseif($i == 12){ $amt = 10000; $RANK  = 'Elite Global Ambassador ';  }
			         else {  $amt = 0;       }
			         if($amt > 0 )
			         {
			              $remark = "LEADERSHIP BONUS  RANK $RANK";
			             $model->setDailyReturnIncomeQuick(1,$i,$member_id,rand(),$amt,$amt,$amt,$remark,$end_date,$process_id);
			         }
			    }
			}
			
		 	 	     
				 	        
					 
					}
				  
                   
                      
                       ob_flush();
                flush();

				endforeach;
			}   
			
  ob_end_flush(); 
		echo "Quick Rank Bonus INCOME has been done <br>";
	  }  


	
	public function directROI()
	{
	   $model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess(); //PrintR($AR_PRSS);die;
		$process_id = $AR_PRSS['process_id'];
		$end_date =$AR_PRSS['end_date'];
        ob_start();  
		if($process_id>0)
		{     
		    $QR_MEM = "SELECT `direct_id` ,`member_id`,`from_member_id`,`total_income`,`cash_account` FROM `tbl_cmsn_direct` WHERE `cash_account` > '0' AND process_id < '$process_id'";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
              //PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			
                $direct_id        = $AR_MEM['direct_id']; 
                $member_id        = $AR_MEM['member_id'];
                $from_member_id   = $AR_MEM['from_member_id'];
                $total_income     = $AR_MEM['total_income'];
                $cash_account     = $AR_MEM['cash_account'];
                
                
                $net = (($total_income*75/100)/30);
                
                
                $day         = $model->checkcountsTotalDReturns($direct_id);
                $remarks     = "Direct Referral Returns from <b>#002022".$direct_id."</b> Day No-<b>".$day."</b>";
                $postedData  = array(
                                        "process_id"     => $process_id,
                                        "direct_id"      => $direct_id , 
                                        "member_id"      => $member_id , 
                                        "from_member_id" => $from_member_id,
                                        "net_income"     => $net , 
                                        "remarks"        => $remarks , 
                                        "date_time"      => $end_date , 
                    );
                
                
                $this->SqlModel->insertRecord("tbl_cmsn_direct_R",$postedData);
                $this->db->query("UPDATE `tbl_cmsn_direct` SET `cash_account` =  cash_account -$net   WHERE direct_id ='$direct_id';"); 
                
			}
			
		}
	}
	
	public function matchingROI()
	{
	   $model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess(); //PrintR($AR_PRSS);die;
		$process_id = $AR_PRSS['process_id'];
		$end_date =$AR_PRSS['end_date'];
        ob_start();  
		if($process_id>0)
		{     
		    $QR_MEM = "SELECT `binary_id` , `member_id`, `amount`,`cash_account` FROM `tbl_cmsn_binary` WHERE `cash_account` > '0' AND   process_id < '$process_id'";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
              //PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			
                $binary_id        = $AR_MEM['binary_id']; 
                $member_id        = $AR_MEM['member_id']; 
                $total_income     = $AR_MEM['amount'];
                $cash_account     = $AR_MEM['cash_account'];
                
                
                $net = (($total_income*75/100)/30);
                
                
                $day         = $model->checkcountsTotalBReturns($binary_id);
                $remarks     = "Binary Income Returns from <b>#003022".$binary_id."</b> Day No-<b>".$day."</b>";
                $postedData  = array(
                                        "process_id"     => $process_id,
                                        "binary_id"      => $binary_id , 
                                        "member_id"      => $member_id ,  
                                        "net_income"     => $net , 
                                        "remarks"        => $remarks , 
                                        "date_time"      => $end_date , 
                    );
                
                
                $this->SqlModel->insertRecord("tbl_cmsn_binary_R",$postedData);
                $this->db->query("UPDATE `tbl_cmsn_binary` SET `cash_account` =  cash_account -$net   WHERE binary_id ='$binary_id';"); 
                
			}
			
		}
	}	
	

	
	
	//****************************************** End Binary
	
	
	
   
 
    public function setStructuredId() {
     $model = new OperationModel();
     $query = "SELECT s.member_id , p.pin_price,s.date_from FROM `tbl_subscription` as s LEFT JOIN tbl_pintype as p on p.type_id = s.`active_type_id` WHERE s.`bulk_by` = 0 and  s.date_from   > '2021-08-03'";
      $PageVal = 	  $this->SqlModel->runQuery($query,false);	 //    PrintR($PageVal);die;   
            foreach($PageVal as $V)
            {
                    $membersId = $V['member_id'];
                    $pin_price = $V['pin_price'];
                    $date_from = $V['date_from'];
                    if($pin_price == 100)
                    {
                        $TID = 1;
                    }
                    elseif($pin_price == 300)
                    {
                        $TID = 3;
                    }
                    elseif($pin_price == 700)
                    {
                        $TID = 7;
                    }
                    elseif($pin_price == 1500)
                    {
                        $TID = 15;
                    }
                    elseif($pin_price == 3100)
                    {
                        $TID = 31;
                    }
                    elseif($pin_price == 6300)
                    {
                        $TID = 63;
                    }
                    elseif($pin_price == 12700)
                    {
                        $TID = 127;
                    }
                    else
                    {
                        $TID = 0;
                    }
                    
                    $totalIncome = $this->setTotalIncome($membersId);
                $data = array(
                "member_id"       => $membersId, 	
                "package"         => $pin_price, 
                "totalId"         => $TID, 
                "total_income"    => ($totalIncome > 0) ? $totalIncome: 0, 
                "activation_date" => $date_from  );
                if($TID > 0 )
                {
                 $this->SqlModel->insertRecord("tbl_structure_user",$data);    
                }
                
                

                    
            }
     
 }
 
 
 
 
 public function setTotalIncome($member_id)
 {
     $model = new OperationModel();
        $inc = $model->gettotIncs($member_id);
        $query = "SELECT member_id FROM `tbl_subscription` WHERE `bulk_by` ='$member_id'";
        $PageVal = 	  $this->SqlModel->runQuery($query,false);	   //PrintR($PageVal);die;
            foreach($PageVal as $V)
            {
                
               $inc += $model->gettotIncs($V['member_id']); 
            }
            
            return $inc ;
 }
 
  
 
  
 public function updateEglessssssss()
 {
     $model = new OperationModel();  $i=0; $l=0;
            $QR_PAGE = " select member_id ,left_Egle,right_Egle,prft_acc_number as le ,prft_ifsc_code  as re from tbl_members where 1  order by member_id asc  ";
            $PageVal = 	  $this->SqlModel->runQuery($QR_PAGE,false);	  
            foreach($PageVal as $V)
            {
                    $membersId = $V['member_id'];
                    $left_Egle = $V['left_Egle'];
                    $right_Egle = $V['right_Egle'];
                    $le = $V['le'];
                    $re = $V['re'];
                    
                    if($left_Egle == $le and $right_Egle == $re )
                    {
                      //  $i++;  
                    }
                    else
                    {
                        $l++;
                       if($re >0 or $le > 0 )
                       {
                           $this->db->query("UPDATE `tbl_members` SET `left_Egle` =  $le ,`right_Egle` =  $re  WHERE member_id ='$membersId';"); 
                       }
                     
                     
                     echo  'Left - ' . $left_Egle .  ' =>'              .$le .' Right'.                         $right_Egle       .'=>'.                   $re;  
                     echo 'mmm->'. $membersId."<br>";
                     
                    }
                  
                 
                   
     
            }   echo "ddd".$i.'---'.$l;
 }
 public function updateEglessss()
 {
     $model = new OperationModel();
            $QR_PAGE = " select member_id from tbl_members where 1  order by member_id asc  ";
            $PageVal = 	  $this->SqlModel->runQuery($QR_PAGE,false);	  
            foreach($PageVal as $V)
            {
                    $membersId = $V['member_id'];
                    
                 
                    echo $membersId."<br>";
                        $EgleL = $model->getMemberDownCount($membersId,'L');
                    $EgleR = $model->getMemberDownCount($membersId,'R');
                    
                     $this->db->query("UPDATE `tbl_members` SET `prft_acc_number` =  $EgleL ,`prft_ifsc_code` =  $EgleR  WHERE member_id ='$membersId';"); 
                    
                   
     
            }
 }
 public function setRankStatic()
 {
        $model = new OperationModel();
        $QR_MEM = "SELECT member_id,processor_id,pif_amount FROM `tbl_members` WHERE 1 ";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //  PrintR($RS_MEM);die;
    foreach($RS_MEM as $AR_MEM){
        $member_id = $AR_MEM['member_id'];
        // $EgleL = $model->getMemberDownCount($member_id,'L');
        // $EgleR = $model->getMemberDownCount($member_id,'R');
            $EgleL = $AR_MEM['processor_id'];
            $EgleR = $AR_MEM['pif_amount'];
        $this->db->query("UPDATE `tbl_members` SET `left_Egle` = $EgleL ,  right_Egle = $EgleR  WHERE member_id ='$member_id';");
          
    
    
    }
        
        
 }
 public function updatespills() {
           $model = new OperationModel();
           	$QR_PAGE = " SELECT * FROM `tbl_mem_tree` WHERE member_id NOT IN (SELECT spil_id FROM tbl_members)";
        $PageVal = 	  $this->SqlModel->runQuery($QR_PAGE,false);	
        
        // PrintR($PageVal);die;
        
        foreach($PageVal as $V)
        {
        $membersId = $V['member_id'];
        // $nleft = $V['nleft']+1;
        
        $AR_GET   = $model->getOpenPlace($membersId);
        if($AR_GET['spil_id'] != $membersId) 
        {
             echo $membersId."<br>";
        }
        else
        {
            echo '----'.$AR_GET['spil_id'].'----'.$membersId."<br>"; 
        }
        
        //  $this->db->query("UPDATE `tbl_mem_tree` SET `nright` = $nleft  WHERE member_id ='$membersId';");
        
        }
           
        }
        
        
        
 public function setPayoutsSunil()
 {
        $this->setupbusiness();
        $this->setupDirectleftRight();
        $this->eligibilities();
        $this->setupEgles();
        $this->setEgleRank();
        $this->residualIncome();
        $this->makePayout1();
        $this->makePayout21();
        $this->makePayout22();
        $this->binaryincomes();
        $this->makePayout10();
        
        
 }
 
 
    public function setbinary22222222222() {
        $model = new OperationModel();
        
        
	        $QR_MEM = " SELECT * FROM `tbl_cmsn_binary` WHERE `process_id` >=142 GROUP BY member_id";
	         $QR_MEM = "SELECT * FROM `tbl_members` WHERE `right_pv` ='0' AND pair_match > 0 and rank_id = '0'";
            $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);     // PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			    $price     = $AR_MEM['price'];
			    $member_id = $AR_MEM['member_id'];
			     echo $AR_MEM['user_id']."<br>";
			    
			    $mm = $model->gettotInc($member_id);
			    $LDGR = $model->getCurrentBalance($member_id,1);  $price =$LDGR['net_balance'];
			     // $this->SqlModel->deleteRecord(prefix."tbl_cmsn_binary",array("member_id"=>$member_id));
			     //   $this->SqlModel->deleteRecord(prefix."tbl_cmsn_mstr",array("member_id"=>$member_id));
			     //   $this->SqlModel->deleteRecord(prefix."tbl_wallet_trns",array("member_id"=>$member_id ,"trns_for" => 'INCOME' ));
			     //   $this->db->query("UPDATE `tbl_members` SET `price` ='0',`pair_match` = 0 ,`leftCrf` =  '0' ,  `rightCrf` =  '0' WHERE  member_id ='$member_id';"); 
			    if($price < $mm)
			    {
			     // echo $member_id.'kkkkk' . $price .'!='. $mm. "<br>"; 
			    }
			    else
			    {   // echo $member_id.'jjj' . $price .'!='. $mm. "<br>"; 
			     //   $this->SqlModel->deleteRecord(prefix."tbl_cmsn_binary",array("member_id"=>$member_id));
			     //   $this->SqlModel->deleteRecord(prefix."tbl_cmsn_mstr",array("member_id"=>$member_id));
			     //   $this->SqlModel->deleteRecord(prefix."tbl_wallet_trns",array("member_id"=>$member_id ,"trns_for" => 'INCOME' ));
			     //   $this->db->query("UPDATE `tbl_members` SET `price` ='0',`pair_match` = 0 ,`leftCrf` =  '0' ,  `rightCrf` =  '0' WHERE  member_id ='$member_id';"); 
			        
			     //    echo $member_id.'jjj' . $price .'!='. $mm. "<br>"; 
			    }
                    // $this->db->query("UPDATE `tbl_members` SET `pair_match` ='0' WHERE  member_id ='$member_id';"); 
                    // $this->SqlModel->deleteRecord(prefix."tbl_cmsn_binary",array("member_id"=>$member_id));
			}
    }
    public function setbinary22222222() {
        $model = new OperationModel();
        //   $LDGR = $model->getCurrentBalance(8272,1);PrintR($LDGR);die;
        $member_id =8501;
          $this->SqlModel->deleteRecord(prefix."tbl_cmsn_mstr",array("member_id"=>$member_id));
			        $this->SqlModel->deleteRecord(prefix."tbl_wallet_trns",array("member_id"=>$member_id ,"trns_for" => 'INCOME' ));
			        $this->db->query("UPDATE `tbl_members` SET `price` ='0' WHERE  member_id ='$member_id';"); 
         die;
        
	        $QR_MEM = " SELECT * FROM `tbl_members` WHERE price > 0 ";
            $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);   //PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			    $price     = $AR_MEM['price'];
			    $member_id = $AR_MEM['member_id'];
			    //echo $AR_MEM['user_id']."<br>";
			    
			    $mm = $model->gettotInc($member_id);
			    $LDGR = $model->getCurrentBalance($member_id,1);  $price =$LDGR['net_balance'];
			    if($price < $mm)
			    {
			       echo $member_id.'jjj' . $price .'!='. $mm. "<br>"; 
			    }
			    else
			    {   // echo $member_id.'jjj' . $price .'!='. $mm. "<br>"; 
			        $this->SqlModel->deleteRecord(prefix."tbl_cmsn_mstr",array("member_id"=>$member_id));
			        $this->SqlModel->deleteRecord(prefix."tbl_wallet_trns",array("member_id"=>$member_id ,"trns_for" => 'INCOME' ));
			        $this->db->query("UPDATE `tbl_members` SET `price` ='0' WHERE  member_id ='$member_id';"); 
			        
			        echo $member_id.'jjj' . $price .'!='. $mm. "<br>"; 
			    }
                    // $this->db->query("UPDATE `tbl_members` SET `pair_match` ='0' WHERE  member_id ='$member_id';"); 
                    // $this->SqlModel->deleteRecord(prefix."tbl_cmsn_binary",array("member_id"=>$member_id));
			}
    }
    
    
     public function vvssddffffff() {
        $model = new OperationModel();
       
	        //$QR_MEM = "SELECT * FROM `tbl_cmsn_mstr` WHERE `binary` > 0 AND process_id >=142 AND member_id NOT IN (SELECT member_id from tbl_cmsn_binary WHERE process_id >=142) GROUP BY member_id";
            
            $QR_MEM = "SELECT * FROM `tbl_members` WHERE `left_pv` ='0' AND pair_match > 0";
            $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			     $LDGR = $model->getCurrentBalance($member_id,1);
                $wallet1 = 	$LDGR['net_balance'];
                $member_id = $AR_MEM['member_id'];
                
                    $this->db->query("UPDATE `tbl_members` SET `price` ='$wallet1' WHERE  member_id ='$member_id';"); 
                    
			}
    } 
 
 
 
     public function setbinary222() {
        $model = new OperationModel();
       
	        $QR_MEM = "SELECT  member_id ,pair_match , left_pv,right_pv FROM `tbl_members` WHERE pair_match > '0' and left_pv ='0' and right_pv = '0'  GROUP BY `member_id` ";
            $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			    $match     = $AR_MEM['total'];
			    $member_id = $AR_MEM['member_id'];
                    $this->db->query("UPDATE `tbl_members` SET `pair_match` ='0' WHERE  member_id ='$member_id';"); 
                    $this->SqlModel->deleteRecord(prefix."tbl_cmsn_binary",array("member_id"=>$member_id));
			}
    }
 
  
    public function updatepairCarry() {
        
         $this->db->query("UPDATE `tbl_members` SET `leftCrf` =  '0' ,  `rightCrf` =  '0'  WHERE 1;");
    $QR_MEM = "SELECT t1.* FROM tbl_cmsn_binary t1 INNER JOIN ( SELECT `member_id`, MAX(`binary_id`) AS max_age FROM tbl_cmsn_binary GROUP BY `member_id` ) t2 ON t1.`member_id` = t2.`member_id` AND t1.`binary_id` = t2.max_age where 1 ORDER BY `t1`.`process_id` DESC";
    $RS_MEM = $this->SqlModel->runQuery($QR_MEM);
			 $i = 1;
			foreach($RS_MEM as $AR_MEM)
			{
			$member_id = $AR_MEM['member_id']; 
			$leftCrf   = $AR_MEM['leftCrf']; 
			$rightCrf  = $AR_MEM['rightCrf']; 
			if($leftCrf > 0 or  $rightCrf > 0 )
			{
			  echo "<br>".$i;  $this->db->query("UPDATE `tbl_members` SET `leftCrf` =  '$leftCrf' ,  `rightCrf` =  '$rightCrf'  WHERE member_id ='$member_id';"); $i++;
			}
			
			  
			} 
    }
    
    
    
    
    
    
    
     
	  
      
      
     public function residualIncome(){
		$model = new OperationModel();
 
 
	  	$AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		$today_date = $end_date;//InsertDate(getLocalTime());
		$cmsn_date =   InsertDate(AddToDate($today_date,"0 Day")); #InsertDate($today_date); #
		 
	  	$QR_CMSN = "SELECT member_id ,rank_id,subcription_id,left_Egle,right_Egle  from tbl_members where rank_id > '0'";
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN);
        
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN):
				
					$type_id = $AR_CMSN['rank_id'];
					$member_id = $AR_CMSN['member_id'];
					$left_Egle   = $AR_CMSN['left_Egle'];
					$right_Egle  = $AR_CMSN['right_Egle'];
				// 	$subcription_id = $AR_CMSN['subcription_id'];
				//     if($subcription_id > 69477 )	
				//     {
				//         if($left_Egle > 0 and  $right_Egle > 0 )
				//         {
				//           $error = 1; 
				//         }
				//         else
				//         {
				//           $error = 0; 
				//         }
				//     }
				//     else
				//     {
				//         $error = 1;
				//     }
					
				// 	$error > 0 
				   if($left_Egle > 0 and  $right_Egle > 0 ) 
					{
					    
					    
					    
        // $day =   getDayDiff( $end_date  , $date_from );
        // if($day %10 =='0' )
        // { 
        
        
        
        // }
					echo $member_id."<br>";
					$subcription_id = $AR_CMSN['subcription_id'];
					$trans_no = rand(111111,888888888);
					if($type_id =='1'){$trans_amount = 10;}elseif($type_id =='2'){$trans_amount = 12;}elseif($type_id =='3'){$trans_amount = 15;}
					elseif($type_id =='4'){$trans_amount = 25;}elseif($type_id =='5'){$trans_amount = 35;}elseif($type_id =='6'){$trans_amount = 50;}
					elseif($type_id =='7'){$trans_amount = 100;}elseif($type_id =='8'){$trans_amount = 250;}elseif($type_id =='9'){$trans_amount = 350;}
					elseif($type_id =='10'){$trans_amount = 500;}elseif($type_id =='11'){$trans_amount = 750;}elseif($type_id =='12'){$trans_amount = 1500;}
					elseif($type_id =='13'){$trans_amount = 5000;}elseif($type_id =='14'){$trans_amount = 10000;}else {$trans_amount = 0;}
				 
					$cal_amount = $trans_amount;
					$daily_return = $trans_amount;
					 
				 
					  $fdate = $model->getdateFromActive($member_id);
					  $Fday = getDateFormat($fdate,"D"); 
					  $Today = getDateFormat($end_date,"D"); 
                      //$day != 'Sat' and $day != 'Sun'
                      
                      if($end_date != $fdate)
                      {
				 	if($Fday ==  $Today) { 	 //$day == 'Sat'
					if($member_id>0 && $trans_amount >0){
					
                        $totalIncomes = $model->getTotalResidualIncomes($member_id);
                        if($totalIncomes < 150)
                        {
                            
                         if(($totalIncomes + $trans_amount ) > 150 )
                         {
                           $daily_return  = 150 -   $totalIncomes;
                         }
                         
						$ctrl_count = $model->checkCmsnDaily($type_id,$member_id,$cmsn_date);
						if($ctrl_count==0){
						
					    	$posting_no = $model->getPostingCount($type_id,$member_id,$cmsn_date);
				 	        $remark = "RESIDUAL INCOME  RETURN [".$cmsn_date."]".",WEEK NO[".$posting_no."]";
				 	        //$totalDirect = $model->getdirectTotal($trans_amount,$member_id);
				 	         if($posting_no < 40)
				 	         {          $errors  =0;
                                        $left_direct_paid = $model->getMemberDirectCount($member_id,"L");
                                        $right_direct_paid = $model->getMemberDirectCount($member_id,"R");
                                        if($left_direct_paid > 0 and $right_direct_paid > 0){$errors =1; }
                                        else { $AtypeId = $model->superreferalType($member_id); if($AtypeId > 0 ) {$errors =1;}  }
                                        if($errors  >  0) {
                                       $model->setDailyReturnIncome($subcription_id,$type_id,$member_id,$trans_no,$trans_amount,$daily_return,$daily_return,$remark,$cmsn_date,$process_id);
				 	         }}
							
						}
						
                        }
						
						
						
						
					}
				 	}
                      }
					}
				endforeach;
			}   
			
 
		echo "RESIDUAL INCOME has been done <br>";
		
	}
    
    
    public function updatesss() {
   	$model = new OperationModel();
   	$trns_date = date("Y-m-d");
	$QR_PAGE = " SELECT * FROM `tbl_transaction` WHERE order_id NOT IN(SELECT orderid from tbl_money_transfer  )";
	$PageVal = 	  $this->SqlModel->runQuery($QR_PAGE,false);	
	
     PrintR($PageVal);die;
	
	foreach($PageVal as $V)
	{
	    $api_recharge  = json_decode($V['response']);
	    
	    $txid = $api_recharge->data;
	    $order_id = $V['order_id'];
	    $order = $model->getAccountdetailByOrderID($order_id);
	    
	    $member_id = $order['member_id'];
	    
	    
	    $userid = $model->getMemberUserId($member_id);
	   // PrintR($order);die;
        $bank_acct_holder= $order['ben_name'];
        $account_number= $order['account_number'];
        $ifc_code= $order['ifsc_code'];
	    $senderId =   $order['sender_id'];
	    
        $amount  =  $order['amount'];
        $charge  =  $order['charge'];
        $total  =  $order['total'];
        
	    
	    
        if($api_recharge->statuscode =='TXN')
        {
        $status =     "SUCCESS";    
        }
        elseif($api_recharge->statuscode =='TUP')
        {
        $status =     "PENDING";    
        }
        else
        {
        $status =     "FAILED";
        }
     if($status =='FAILED') {$manage_sts ='Y';} elseif($status =='SUCCESS') {$manage_sts ='Y';} else{$manage_sts ='N';}
        $moneytransfer_data = array(
		                            "sub_req" =>'Y',
									'txid'    =>($txid->ipay_id !='')?$txid->ipay_id:'N/A',
									'status'  =>  ($status =='FAILED')?'Failure':'Success',
									'message' =>  $api_recharge->status,
									'operator_message' =>  $api_recharge->status,
									'manage_sts' =>$manage_sts,
									'response'   =>json_encode($api_recharge),
									);
									
								// 	PrintR($moneytransfer_data);die;
      $this->SqlModel->updateRecord(prefix."tbl_money_transfer",$moneytransfer_data,array("sender_id"=>$senderId));
           
	if($api_result->status =='FAILED') {
	     
	    
	        $trans_no = rand(11111,88888888);
            $trns_remark = "Refunded";
            $model->wallet_transaction(1,"Cr",$member_id,$total/75,$trns_remark,$trns_date,$trans_no,"1","VW");
            $model->setMemberWallet($member_id,1, $total/75,"Cr");
	        $mm=$api_recharge->status;
            redirect_page("transaction","dmtPending",set_message("danger",$api_recharge->status."[" .$mm."]" )); 
    
    }else{
        
     
 	                   $userid =$model->getMemberUserId($member_id);

                        $trns_remark = "Money Transfer FROM [".$userid."]  Name :".$bank_acct_holder.' A/c: '.$account_number.' IFSC :'.$ifc_code ;
                        $trans_no = rand(111111,999999);
                        $draw_amount = $draw_amount*$rate;
                        $model->wallet_transaction(20,"Dr",1,$total,$trns_remark,$trns_date,$trans_no,"1","DMT");
                        
               	        $model->setWallet($total,'Dr');
               	  		$data = array(
               	  		            "to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>1,
									"mt_id" =>$senderId,
									"initial_amount"=>$amount/75,
									"admin_charge"=> 0,
									"withdraw_fee"=>$charge/75,
									"process_fee"=>0,
									"trns_amount"=>$total/75,
									"trns_status"=>"C",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"DMT",
									"trns_remark"=>"Withdrawal  Request from ".$userid,
								);
                        $transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
                         
          }	
    
	    
 
	    
	}
 
   	}
    public function dddd()
    {
        $QR_PAGE = " SELECT * FROM `tbl_mem_tree` WHERE member_id NOT IN (SELECT spil_id FROM tbl_members ) ORDER BY `tbl_mem_tree`.`member_id` DESC";
        $PageVal = 	  $this->SqlModel->runQuery($QR_PAGE,false);
        	foreach($RS_MEM as $AR_MEM){
			      $member_id = $AR_MEM['member_id'];
			      $nleft = $AR_MEM['nleft'];
			     $this->SqlModel->updateRecord(prefix."tbl_mem_tree",array("nleft" => $nleft ,"nright" =>$nleft+1),array("member_id"=>$member_id));   
		  }
      
    }
    public function kycupdate(){
    ob_start(); 
 
    $model = new OperationModel();
    // $model->updatekyc(1);die;
    
    for($i=1;$i<100000;$i++)
   {
      $start = $i;
      $end = $i+299;
      
      echo $start .'--'.$end;
      
    $QR_MEM = "SELECT m.member_id,m.user_id,m.first_name,m.midle_name,m.last_name,k1.approved_sts as pan,k2.approved_sts as AF,k3.approved_sts as AB,k4.approved_sts as C FROM tbl_members as m LEFT JOIN `tbl_mem_kyc` as k1 on m.member_id = k1.member_id and k1.file_type ='PAN CARD' and k1.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='PAN CARD') LEFT JOIN `tbl_mem_kyc` as k2 on m.member_id = k2.member_id and k2.file_type ='ADHAR CARD FRONT' and k2.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='ADHAR CARD FRONT') LEFT JOIN `tbl_mem_kyc` as k3 on m.member_id = k3.member_id and k3.file_type ='ADHAR CARD BACK' and k3.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='ADHAR CARD BACK' ) LEFT JOIN `tbl_mem_kyc` as k4 on m.member_id = k4.member_id and k4.file_type ='CHEQUE' and k4.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='CHEQUE')
where  m.member_id between '$start' and '$end' and  m.member_id IN (SELECT member_id FROM tbl_subscription)
 
GROUP by m.member_id";
	$RS_MEM = $this->SqlModel->runQuery($QR_MEM);
//	PrintR($RS_MEM);die;
 	foreach($RS_MEM as $AR_MEM)
 	{
     echo "<br>".	 $member_id = $AR_MEM['member_id'];
     $user_id = strtoupper($AR_MEM['user_id']);
     $name = strtoupper($AR_MEM['first_name'].' '.$AR_MEM['midle_name'].' '.$AR_MEM['last_name']);
     
 
 
             $pan_card =    ($AR_MEM['pan'] !='')? $AR_MEM['pan']:'2'; 
             $adhaar_front =    ($AR_MEM['AF'] !='')? $AR_MEM['AF']:'2'; 
             $adhaar_back =    ($AR_MEM['AB'] !='')? $AR_MEM['AB']:'2'; 
             $cheque =    ($AR_MEM['C'] !='')? $AR_MEM['C']:'2'; 
 	 
            if($model->checkCount(prefix."tbl_kyc_status","member_id",$member_id)>0){
                $updated_data = array(
                               
                                "user_id"  => $user_id , 
                                "name"  => $name , 
                                "pan_card"  => $pan_card , 
                                "adhaar_front"  =>  $adhaar_front, 
                                "adhaar_back"  => $adhaar_back , 
                                "cheque"  => $cheque , 
                    
                    );
                $this->SqlModel->updateRecord(prefix."tbl_kyc_status",$updated_data,array("member_id"=>$member_id));
            }
            else
            {
                  $updated_data = array(
                                "member_id"  =>  $member_id, 
                                "user_id"  => $user_id , 
                                "name"  => $name , 
                                "pan_card"  => $pan_card , 
                                "adhaar_front"  =>  $adhaar_front, 
                                "adhaar_back"  => $adhaar_back , 
                                "cheque"  => $cheque , 
                    
                    );
                  $this->SqlModel->insertRecord(prefix."tbl_kyc_status",$updated_data);    
            }
            ob_flush();
            flush();
					
						
 	}
 	
 	$i= $i +300;
 	$i--;
 	ob_end_flush();  
 	echo "<br>";
   }
}

   	public function updateMobileNo(){
		$model = new OperationModel();
	    $QR_CMSN = "SELECT * from tbl_money_transfer";
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN);
    		foreach($RS_CMSN as $AR_CMSN)
    		{
                        $sender_id = $AR_CMSN['sender_id'];
                        $member_id = $AR_CMSN['member_id'];
                        $member = $model->getmembersdetails($member_id);
                        $mobile = $member['member_mobile'];
                                  $this->SqlModel->updateRecord("tbl_money_transfer",array("mobile"=>$mobile ),array("sender_id"=>$sender_id));
    		}
		
		
       }
   	public function refunddmt()
	{
	    	$model = new OperationModel();
	        $QR_MEM = "SELECT * FROM `tbl_money_transfer` WHERE date(`date`)  ='2021-07-07' AND `status`  = 'Success'"; // 
		    $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    //PrintR($RS_MEM);die;
		    if(is_array($RS_MEM) and !empty($RS_MEM))
		    { 
		        foreach($RS_MEM as $AR_MEM){
	            $member_id =  $AR_MEM['member_id']  ;
                $total = $AR_MEM['total']/75 ;
                $dmt_amt = $AR_MEM['dmt_amt']; 
                $sender_id = $AR_MEM['sender_id'];  
   $Sname = $_SERVER['SERVER_NAME'];  
  
  $order_idd =   $AR_MEM['orderid'];
  $parameters="serverName=$Sname&order_id=$order_idd "; 
  $url="https://dmt.vertoindia.com/api/multidmtsts";
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);   
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  
	$return_val = curl_exec($ch);
    $response = json_decode($return_val); 
    $data   = $response->API;   // PrintR(json_encode($response));
  if($response->Status)
  { 
    if($response->API =='SUCCESS')
    {
      
    }
    elseif($response->API   =='FAILED')
    {
     echo $order_idd.'---'.$sender_id."<br>";
      
    }
    
  }
    
		  	}
		  	
		  	 
		    }
		  	 
		  		
	}
   	public function deleteUsers()
   	{
   	    $model = new OperationModel();
   	    $member_id = $model->getMemberId('AG8589861');
   	    $this->SqlModel->deleteRecord(prefix."tbl_subscription",array("member_id"=>$member_id));
    $left_right = 'L';   //Left=> L  : Right=> R 
	$StrPlace .= ($left_right!='')? " AND spil_id='".$member_id."' AND  left_right='".$left_right."'":"";
	$StrPlace .= ($left_right=='')? " AND member_id='".$member_id."'":"";

	$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE 1 $StrPlace ORDER BY member_id ASC LIMIT 1";
	$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
	
	$nleft = $AR_SELECT["nleft"];																																													
	$nright = $AR_SELECT["nright"];
	$StrWhr = " AND tree.nleft BETWEEN '$nleft' AND '$nright'";
	$QR_PAGE = "SELECT tm.member_id , tm.user_id  FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id WHERE tm.member_id!='".$member_id."'   AND tm.delete_sts>0  $StrWhr  GROUP BY tm.member_id ORDER BY tm.date_join DESC";
	$PageVal = 	  $this->SqlModel->runQuery($QR_PAGE,false);
	foreach($PageVal as $V)
	{
	    $membersId = $V['member_id'];
	    $this->SqlModel->deleteRecord(prefix."tbl_members",array("member_id"=>$membersId));
	    $this->SqlModel->deleteRecord(prefix."tbl_mem_tree",array("member_id"=>$membersId));
	    $this->SqlModel->deleteRecord(prefix."tbl_subscription",array("member_id"=>$membersId));
	}
	PrintR($PageVal);die;
   	}
   	
//   
    	public function deleteIncome()
   	{
   	    $model = new OperationModel();
   	     
	$QR_PAGE = " SELECT member_id  FROM `tbl_cmsn_quick` WHERE `process_id` =81 and member_id NOT IN (SELECT `member_id` FROM tbl_cmsn_mstr WHERE process_id ='81' and tbl_cmsn_mstr.quick > '0') ORDER BY `member_id` ASC	";
	$PageVal = 	  $this->SqlModel->runQuery($QR_PAGE,false);
	foreach($PageVal as $V)
	{
	    $membersId = $V['member_id'];
	    
	    
	    
	    
	    $this->SqlModel->deleteRecord(prefix."tbl_wallet_trns",array("member_id"=>$membersId,'trns_remark' => "DAILY CLOSING [ Day NO: 81]"));
	    $this->SqlModel->deleteRecord(prefix."tbl_cmsn_mstr",array("member_id"=>$membersId,"process_id" => '81'));
	    
	}
	PrintR($PageVal);die;
   	}
    public function setcharges() {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess($process_id);
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
       
                
		if($process_id>=0){
	  	    
	  	    $QR_MEM = " SELECT * FROM `tbl_fund_transfer` WHERE `draw_type` ='DMT' ";
		    $QR_MEM = " SELECT * FROM `tbl_money_transfer` WHERE 1 ";
		
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	      //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			   
			      $transfer_id = $AR_MEM['transfer_id'];
			      $sender_id = $AR_MEM['sender_id'];
			      $initial_amount = $AR_MEM['amount'];// $AR_MEM['initial_amount']; 
			      $ch = $initial_amount*3/100;
			      $charge =  number_format((float)$ch, 2, '.', '');
			   // $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("withdraw_fee"=>$charge,"trns_amount"=>$initial_amount + $charge),array("transfer_id"=>$transfer_id));     
			   
			   
			   $this->SqlModel->updateRecord(prefix."tbl_money_transfer",array("charge"=>$charge,"total"=>$initial_amount + $charge),array("sender_id"=>$sender_id)); 
			   
			   
			    
			}}   
			    
      }
      
// 0	0	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/eligibility1	 
// 7	0	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/eligibility2   
// 15	0	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/makePayout1	    
// 40	0	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/residualIncome	    
// 45	0	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/makePayout11	    
// 0	2	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/makePayout3	    
// 10	2	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/makePayout21	    
// 25	2	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/makePayout22	    
// 40	2	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/makePayout9	    
// 55	2	*	*	*	curl --silent https://asianglobs.com/aig/cronsecure/makePayout10	    

      public function eligibility1() { $this->eligibility(1 , 50000); }
    //   public function eligibility2() { $this->eligibility(1 , 19999); }
	  public function makePayout1() {
	      // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"makePayout1"));  
	            $this->aigtoken();	  
                $this->directcommission()  ;       
	             
            // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"makePayout1"));      
	  }
	   public function makePayout11() { $this->binaryinc(1,50000); }
	   //public function makePayout12() { $this->binaryinc(13001,50000); }
	   //public function makePayout13() { $this->binaryinc(19001,26000); } 
    //   public function makePayout14() { $this->binaryinc(26001,50000); } 
 
 
 
	  public function makePayout21() {
	             // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"makePayout21"));  	  
                $this->setquickRank();
                 // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"makePayout21")); 
	            
                	
	  }
	  public function makePayout22() {
	              // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"makePayout22")); 	  
                $this->quickBonusIncome();
                 // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"makePayout22")); 
	            
                	
	  }
	  
	 
	  //Pool Commented Un Comment here ...
	  public function makePayout3() {
	     $this->setpool();
	  } 
      public function makePayout9() { $this->totalcommission(1,20000,'N'); }
	  public function makePayout10() { 
	       // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"makePayout10"));  
	       $this->totalcommission(1,1,'Y');
	       // $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"makePayout10"));  
	      
	      
	  }
	   
	  
      public function eligibility($s,$e) {
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess($process_id);
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
       //AG263483
                ob_start(); 
        // $model->setConfig("CONFIG_DATE",date('Y-m-d :H:i:s'));           
		if($process_id>=0){
	  	    
	  	    $QR_MEM = "Select member_id,rank_id from tbl_members where  member_id between '$s' and '$e' and     member_id IN (Select member_id from tbl_subscription where Date(date_from)  <=  '".$end_date."') order by member_id desc ";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	        //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			   
			      $member_id = $AR_MEM['member_id']; echo "<br>".$member_id;
			      $rank_id   = $AR_MEM['rank_id'];
			      if($rank_id =='0')
			      {
			 //     $left_direct_paid = $model->getMemberDirectCount($member_id,"L");
				//   $right_direct_paid = $model->getMemberDirectCount($member_id,"R");
				
                        $newLft = $model->getMemberCollection2($member_id,"L","","");
                        $newRgt = $model->getMemberCollection2($member_id,"R","","");
				  if($newLft >0 and $newRgt > 0 )
				  {
				  $this->SqlModel->updateRecord(prefix."tbl_members",array("rank_id"=>"1"),array("member_id"=>$member_id)); 
				  $rank_id   = 1;
				  }
				  else
				  {
				   $rank_id   = 0;   
				  }
			      }
                   
			      if($rank_id > '0')
			      {
			                $rnk_id =0;
                            $L = $model->getMemberDownCount($member_id,'L');
                            $R = $model->getMemberDownCount($member_id,'R');
                              $counts = min($L,$R);
                           
			          if($counts >= '25000' )
			          {
			               $rnk_id =14;
			          }
			          elseif($counts >=  '10000' and $counts <  '25000' )
			          {
			               $rnk_id =13; 
			          }
			          elseif($counts >=  '5000' and $counts <  '10000' )
			          {
			               $rnk_id =12;  
			          }
			          elseif($counts >=  '2500' and $counts <  '5000' )
			          {
			              $rnk_id =11; 
			          }
			          elseif($counts >=  '1016' and $counts <  '2500' )
			          {
			              $rnk_id =10; 
			          }
			          elseif($counts >=  '508' and $counts <  '1016' )
			          {
			              $rnk_id =9;  
			          }
			          elseif($counts >=  '254' and $counts <  '508' )
			          {
			             $rnk_id =8;  
			          }
			          elseif($counts >=  '127' and $counts <  '254' )
			          {
			             $rnk_id =7;  
			          }
			          elseif($counts >=  '63' and $counts <  '127' )
			          {
			             $rnk_id =6;   
			          }
			          elseif($counts >=  '31' and $counts <  '63' )
			          {
			             $rnk_id =5; 
			          }
			          elseif($counts >=  '15' and $counts <  '31' )
			          {
			             $rnk_id =4;  
			          }
			          elseif($counts >=  '7' and $counts <  '15' )
			          {
			              $rnk_id =3; 
			          }
			          elseif($counts >=  '3' and $counts <  '7' )
			          {
			              $rnk_id =2;  
			          }
			          else
			          {
			              $rnk_id =1; 
			          }
			          
			           
			          if($rnk_id > $rank_id)
			          {  
			           $this->SqlModel->updateRecord(prefix."tbl_members",array("rank_id"=>$rnk_id),array("member_id"=>$member_id));    
			          }
 
			          
			      }
			     
			     
                // 1 EAGLE 2 ID’S
                // 2 LEADER 3 EAGLE
                // 3 TEAMLEADER 7 EAGLE
                // 4 MANAGER 15 EAGLE
                // 5 GENERALMANAGER 31 EAGLE
                // 6 ZONALMANAGER 63 EAGLE
                // 7 REGIONALMANAGER 127 EAGLE
                // 8 NATIONALMANAGER 254 EAGLE
                // 9 DIRECTOR 508 EAGLE
                
                
                // 10 ZONALDIRECTOR 1016 EAGLE
                // 11 REGIONALDIRECTOR 2500 EAGLE
                // 12 NATIONALDIRECTOR 5000 EAGLE
                // 13 GLOBAL DIRECTOR 10000 EAGLE
                // 14 FOUNDER 25000 EAGLE 
			     ob_flush();
                flush();
               
			    
			}} 
			
				//$model->setConfig("CONFIG_DATE",date('Y-m-d :H:i:s'));
			
			
			ob_end_flush();  
			    
      }
      public function aigtoken(){
	    
		$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess($process_id);
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
       
       
		if($process_id>=0){
	  	      $QR_MEM = "Select member_id,date_from from tbl_subscription where Date(date_from)  <  '".$end_date."'";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	 
			foreach($RS_MEM as $AR_MEM):
			   
			     
			    $member_id = $AR_MEM['member_id'];
			    $date_from = $AR_MEM['date_from'];
			     
                $day =   getDayDiff( $end_date  , $date_from );
                if($day %30 =='0' )
                {           
                            $count = $model->getCountsToken($member_id , 'AIG_ACTIVE');
                            if($count < 12)
                            {
                            $trans_no = rand(1111111,99999999);
                            $trns_remark = "AIG TOKEN ";
                            $model->wallet_transaction('2',"Cr",$member_id,200,$trns_remark,$end_date,$trans_no,1,"AIG_ACTIVE");
                            }
                }
		    endforeach;
		   
		 

		}
	
	    	 
	 
	  
	}
  
	
     
	
	  
	  public function setquickRank() {
	      
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		 
	 	ob_start();
  
		 
	  	$QR_CMSN = "SELECT member_id , `date_from` FROM `tbl_subscription` WHERE  date(`date_from`) <= '$end_date' and `date_from` >= ( CURDATE() - INTERVAL 53 DAY )";
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN);
      
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN){
				   $member_id =  $AR_CMSN['member_id']; echo "<br>".$member_id;
				   $date_from =  $AR_CMSN['date_from'];
				   $day =   getDayDiff( $end_date  , $date_from ); 
				    $Ranks  = $model->getRanks($member_id);
				    
				   if($day <= '1' and $Ranks >= '1')  {
				       $count = $model->getcountquick($member_id,1);
				       if($count <= '0' )
				       {
				              

				           	$data_rank =array(
						    "process_id"           =>$process_id,
							"member_id"            =>$member_id,
							"rank_id"              =>1,
							"bonus"                =>2,
							"date_time"            =>$end_date
						);
						 $this->SqlModel->insertRecord(prefix."tbl_quick_rank",$data_rank);	
				       }
				   }
				   if($day <= '2' and $Ranks >= '4')  {
				       $count = $model->getcountquick($member_id,2);
				       if($count <= '0')
				       {
				              

				           	$data_rank =array(
						    "process_id"           =>$process_id,
							"member_id"            =>$member_id,
							"rank_id"              =>2,
							"bonus"                =>5,
							"date_time"            =>$end_date
						);
						 $this->SqlModel->insertRecord(prefix."tbl_quick_rank",$data_rank);	
				       }
				   }
				   if($day <= '5' and $Ranks >= '8')  {
				       $count = $model->getcountquick($member_id,3);
				       if($count <= '0')
				       {
				              

				           	$data_rank =array(
						    "process_id"           =>$process_id,
							"member_id"            =>$member_id,
							"rank_id"              =>3,
							"bonus"                =>10,
							"date_time"            =>$end_date
						);
						 $this->SqlModel->insertRecord(prefix."tbl_quick_rank",$data_rank);	
				       }
				   }
				   if($day <= '10' and $Ranks >= '9') {
				       $count = $model->getcountquick($member_id,4);
				       if($count <= '0')
				       {
				              

				           	$data_rank =array(
						    "process_id"           =>$process_id,
							"member_id"            =>$member_id,
							"rank_id"              =>4,
							"bonus"                =>15,
							"date_time"            =>$end_date
						);
						 $this->SqlModel->insertRecord(prefix."tbl_quick_rank",$data_rank);	
				       }
				   }
				    
				     ob_flush();
                flush();

				} ob_end_flush(); 
	  }
	  }
	  public function quickBonusIncome(){
	      
	      
	      $model = new OperationModel();
 
	  	$AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		$today_date = $end_date; 
		 		 
	 	ob_start();

	  	$QR_CMSN = "SELECT t1.* FROM tbl_quick_rank t1 INNER JOIN ( SELECT `member_id`, MAX(`rank_id`) AS max_age FROM tbl_quick_rank GROUP BY `member_id` ) t2 ON t1.`member_id` = t2.`member_id` AND t1.`rank_id` = t2.max_age";
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN);
       
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN):
					$type_id = $AR_CMSN['rank_id'];
					$member_id = $AR_CMSN['member_id'];
					$trans_amount  = $AR_CMSN['bonus'] /5;
					$trans_no = rand(111111,888888888);
					$cal_amount = $trans_amount;
					$daily_return = $trans_amount;
					echo "<br>".$member_id; 
                        $fdate = $model->getdateFromActive($member_id);
                        // $new_date = InsertDate(AddToDate($end_date,"-1 day"));//comment
                        $Fday    = getDateFormat($fdate,"D"); 
                        $Today   = getDateFormat($end_date,"D"); 
                        // $backDay =   getDateFormat($new_date,"D"); //comment
                    $dates = date('Y-m-d',strtotime($end_date));    
                        
				//	 PrintR($RS_CMSN);die;
				  if($end_date != $fdate)
                      {  
                      //
				 	if( $day != 'Sat' and $day != 'Sun' ) {  	//  $Today == $Fday   
					if($member_id>0 && $trans_amount >0){
					
  
						
					    	$posting_no = $model->getPostingCountQuick2($type_id,$member_id,$dates);
					    	$posting_no2 = $model->getPostingCountQuick3($type_id,$member_id,$dates);
					    	
					    	$P_Count =  ($posting_no * 5) + $posting_no +1;
				 	        $remark = "QUICK RANK BONUS [".$dates."]".",DAY NO[".$P_Count."]";
				 	        if($P_Count <= 100 )
				 	        {               $errors  =0;
                                            $left_direct_paid = $model->getMemberDirectCount($member_id,"L");
                                            $right_direct_paid = $model->getMemberDirectCount($member_id,"R");
                                            if($left_direct_paid > 0 and $right_direct_paid > 0){$errors =1; }
                                            else { $AtypeId = $model->superreferalType($member_id); if($AtypeId > 0 ) {$errors =1;}  }
                                            if($errors  >  0) {
	$model->setDailyReturnIncomeQuick(1,$type_id,$member_id,$trans_no,$trans_amount,$daily_return,$daily_return,$remark,$dates,$process_id);
				 	        }}
				 	        
					 
					}
				 	}
                      }
                      
                       ob_flush();
                flush();

				endforeach;
			}   
			
  ob_end_flush(); 
		echo "Quick Rank Bonus INCOME has been done <br>";
	  }
	  public function setpool() {
                $this->SetLevelsStar();
                $this->poollevelIncomeStar();
                // $this->SetLevelsGold();
                // $this->poollevelIncomeGold();
                // $this->SetLevelsRuby();
                // $this->poollevelIncomeRuby();
                // $this->SetLevelsPearl();
                // $this->poollevelIncomePearl();
                // $this->SetLevelsCoral();
                // $this->poollevelIncomeCoral();
                // $this->SetLevelsOnyx();
                // $this->poollevelIncomeOnyx();
                // $this->SetLevelsTopaz();
                // $this->poollevelIncomeTopaz();
                // $this->SetLevelsFounder();
                // $this->poollevelIncomeFounder();
}
	  

	   
	         
	         
	         
	         
	         
	         
	         
	         public function checkwallets() {
            	     $model = new OperationModel();
            	    $QR_MEM = "SELECT tm.member_id,tm.user_id FROM tbl_members AS tm where tm.member_id between '25001' and '27000'   ORDER BY tm.member_id ASC ";
            		$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
            	    foreach($RS_MEM as $AR_MEM){
            		    
            		    
            		      $mem = $AR_MEM['member_id']; 
            		    $LDGR = $model->getCurrentBalance($mem,'1',"","");
            		    if( $LDGR['net_balance'] < 0 )
            		    {
            		          echo $mem .':::::::'.$AR_MEM['user_id'] .':::::'.number_format($LDGR['net_balance'],2)."AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA<br>";
            		    }
            		    else
            		    {
            		        //echo $mem .':::::::'. $AR_MEM['user_id'] .':::::'.number_format($LDGR['net_balance'],2).".............................<br>";
            		    }
            		    
            		}
		
	         }
	         
	         
	         
	         
	         
	         
	         
	         
	         
	         
	         
	         public function SetLevelsStar() {
	   
	     
	        $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		    $spill_id = $model->getSpillLevel("tbl_level_members");
		    $count = $model->checkCount("tbl_level_members","spill_id" ,$spill_id);
		    
		    if($count > 1 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    }
		     
		    
		    
		 	$QR_MEM = "SELECT member_id FROM `tbl_members` WHERE  rank_id > '0'  and member_id NOT IN (Select member_id from tbl_level_members )   GROUP BY member_id ORDER BY `subcription_id` ASC";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
             //$spill_id = returnMatrixLevel(1);
		     $L = $model->getMemberDownCount($member_id,'L');
             $R = $model->getMemberDownCount($member_id,'R');
             
             if($L >='2' and $R >='2')
             {
		    if($count > 1 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    } 
		     
		 $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members",$posted_data);
		 $count++;
             }
            }
	   
	}
             public function poollevelIncomeStar(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
         $QR_MEM = "SELECT member_id FROM `tbl_level_members` WHERE `member_id` NOT IN (SELECT member_id FROM tbl_cmsn_level WHERE type ='1')";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                $member_id = $AR_MEM['member_id'];			 	
				//$status  = returnMatrixLevelCount($member_id);
				    $ID = $model->getIDbyMemberLevel("tbl_level_members",$member_id);
				    $count = $model->checkCount("tbl_level_members","spill_id" ,$ID);
                    $amount =40 ;   $repurchase =0;$upgrade =30;
                    if($count > 1)
                    {                   $errors  =0;
                                        $left_direct_paid = $model->getMemberDirectCount($member_id,"L");
                                        $right_direct_paid = $model->getMemberDirectCount($member_id,"R");
                                        if($left_direct_paid > 0 and $right_direct_paid > 0){$errors =1; }
                                        else { $AtypeId = $model->superreferalType($member_id); if($AtypeId > 0 ) {$errors =1;}  }
                                        if($errors  >  0) {
                        $this->SetLevelIncomes($member_id,1,$process_id,$end_date,1,$amount,$repurchase,$upgrade);
                                        }
                    }
                    
                    
                    
                    
                    
                    
                    
				//  foreach($status as $level=>$val)
				//  {
				//   $count =  $model->getLevelIncomeCount($member_id,$level,1);
				//   if($val > 0 and $count <= 0 )
				//   {
				// 	if($level =='1') { $amount =40 ;   $repurchase =0;$upgrade =30;}  
				// 	elseif($level=='2') { $amount =120  ;  $repurchase =0;$upgrade =90;  } 
				// 	elseif($level=='3') { $amount =720   ; $repurchase =0;$upgrade =600; } 
				// 	elseif($level=='4') { $amount =9600 ;  $repurchase =0;$upgrade =8000; }  
				// 	elseif($level=='5') {  $amount =256000 ; $repurchase =200;$upgrade =200000;   } 
				// 	elseif($level=='6') {  $amount =12800000 ; $repurchase =200;$upgrade =800000;  }
				// 	elseif($level=='7') {  $amount =102400000 ; $repurchase =200;$upgrade =2400000;   } 
				// 	elseif($level=='8') {  $amount =614400000 ; $repurchase =200;$upgrade =0;   } 
				// 	else{	$amount =0;$repurchase =0;$upgrade =0;}
					   
				// 	 if($amount > 0 )
				// 	 {
				// 	     $this->SetLevelIncomes($member_id,$level,$process_id,$end_date,1,$amount,$repurchase,$upgrade);
				// 	 }
				    
				//   }
				//   }
	 }
	 
	 	    
	            
	 }
	         public function SetLevelsGold() {
	   
	     
	        $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		    $spill_id = $model->getSpillLevel("tbl_level_members2");
		    $count = $model->checkCount("tbl_level_members2","spill_id" ,$spill_id);
		    
		    if($count > 3 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    }
		     
		    
		    
		 	$QR_MEM = "SELECT member_id  FROM `tbl_cmsn_level` WHERE `type` = '1' AND member_id NOT IN(SELECT member_id FROM tbl_level_members2)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
               
		    if($count > 3 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    } 
		     
		 $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members2",$posted_data);
		    
         $count++;
		    
            }
	   
	}
             public function poollevelIncomeGold(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
         $QR_MEM = "SELECT member_id FROM `tbl_level_members2` WHERE `member_id` NOT IN (SELECT member_id FROM tbl_cmsn_level WHERE type ='2')";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                    $member_id = $AR_MEM['member_id'];			 	
			        $ID = $model->getIDbyMemberLevel("tbl_level_members2",$member_id);
				    $count = $model->checkCount("tbl_level_members2","spill_id" ,$ID);
                    $amount =120  ;  $repurchase =0;$upgrade =90; 
                    if($count > 3)
                    {
                        $this->SetLevelIncomes($member_id,1,$process_id,$end_date,2,$amount,$repurchase,$upgrade);
                    }
                    
                    
                    
	 }
	 
	 	    
	            
	 }
             public function SetLevelsRuby() {
	   
	     
	        $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		    $spill_id = $model->getSpillLevel("tbl_level_members3");
		    $count = $model->checkCount("tbl_level_members3","spill_id" ,$spill_id);
		    
		    if($count > 7 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    }
		     
		    
		    
		 	$QR_MEM = "SELECT member_id  FROM `tbl_cmsn_level` WHERE `type` = '2' AND member_id NOT IN(SELECT member_id FROM tbl_level_members3)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
               
		    if($count > 7 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    } 
		     
		 $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members3",$posted_data);
		    
         $count++;
		    
            }
	   
	}
             public function poollevelIncomeRuby(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
         $QR_MEM = "SELECT member_id FROM `tbl_level_members3` WHERE `member_id` NOT IN (SELECT member_id FROM tbl_cmsn_level WHERE type ='3')";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                    $member_id = $AR_MEM['member_id'];			 	
			        $ID = $model->getIDbyMemberLevel("tbl_level_members3",$member_id);
				    $count = $model->checkCount("tbl_level_members3","spill_id" ,$ID);
                     $amount =720   ; $repurchase =0;$upgrade =600;
                    if($count > 7)
                    {
                        $this->SetLevelIncomes($member_id,1,$process_id,$end_date,3,$amount,$repurchase,$upgrade);
                    }
                    
                    
                    
	 }
	 
	 	    
	            
	 }
	         public function SetLevelsPearl() {
	   
	     
	        $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		    $spill_id = $model->getSpillLevel("tbl_level_members4");
		    $count = $model->checkCount("tbl_level_members4","spill_id" ,$spill_id);
		    
		    if($count > 15 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    }
		     
		    
		    
		 	$QR_MEM = "SELECT member_id  FROM `tbl_cmsn_level` WHERE `type` = '3' AND member_id NOT IN(SELECT member_id FROM tbl_level_members4)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
               
		    if($count > 15 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    } 
		     
		 $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members4",$posted_data);
		    
         $count++;
		    
            }
	   
	}
             public function poollevelIncomePearl(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
         $QR_MEM = "SELECT member_id FROM `tbl_level_members4` WHERE `member_id` NOT IN (SELECT member_id FROM tbl_cmsn_level WHERE type ='4')";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                    $member_id = $AR_MEM['member_id'];			 	
			        $ID = $model->getIDbyMemberLevel("tbl_level_members4",$member_id);
				    $count = $model->checkCount("tbl_level_members4","spill_id" ,$ID);
                      $amount =9600 ;  $repurchase =0;$upgrade =8000;
                    if($count > 15)
                    {
                        $this->SetLevelIncomes($member_id,1,$process_id,$end_date,4,$amount,$repurchase,$upgrade);
                    }
                    
                    
                    
	 }
	 
	 	    
	            
	 }
	         public function SetLevelsCoral() {
	   
	     
	        $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		    $spill_id = $model->getSpillLevel("tbl_level_members5");
		    $count = $model->checkCount("tbl_level_members5","spill_id" ,$spill_id);
		    
		    if($count > 31 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    }
		     
		    
		    
		 	$QR_MEM = "SELECT member_id  FROM `tbl_cmsn_level` WHERE `type` = '4' AND member_id NOT IN(SELECT member_id FROM tbl_level_members5)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
               
		    if($count > 31 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    } 
		     
		 $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members5",$posted_data);
		    
         $count++;
		    
            }
	   
	}
             public function poollevelIncomeCoral(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
         $QR_MEM = "SELECT member_id FROM `tbl_level_members5` WHERE `member_id` NOT IN (SELECT member_id FROM tbl_cmsn_level WHERE type ='5')";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                    $member_id = $AR_MEM['member_id'];			 	
			        $ID = $model->getIDbyMemberLevel("tbl_level_members5",$member_id);
				    $count = $model->checkCount("tbl_level_members5","spill_id" ,$ID);
                      $amount =256000 ;  $repurchase =0;$upgrade =200000;
                    if($count > 31)
                    {
                        $this->SetLevelIncomes($member_id,1,$process_id,$end_date,5,$amount,$repurchase,$upgrade);
                    }
                    
                  

                    
	 }
	 
	 	    
	            
	 }
	         public function SetLevelsOnyx() {
	   
	     
	        $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		    $spill_id = $model->getSpillLevel("tbl_level_members6");
		    $count = $model->checkCount("tbl_level_members6","spill_id" ,$spill_id);
		    
		    if($count > 63 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    }
		     
		    
		    
		 	$QR_MEM = "SELECT member_id  FROM `tbl_cmsn_level` WHERE `type` = '5' AND member_id NOT IN(SELECT member_id FROM tbl_level_members6)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
               
		    if($count > 63 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    } 
		     
		 $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members6",$posted_data);
		    
         $count++;
		    
            }
	   
	}
             public function poollevelIncomeOnyx(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
         $QR_MEM = "SELECT member_id FROM `tbl_level_members6` WHERE `member_id` NOT IN (SELECT member_id FROM tbl_cmsn_level WHERE type ='6')";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                    $member_id = $AR_MEM['member_id'];			 	
			        $ID = $model->getIDbyMemberLevel("tbl_level_members6",$member_id);
				    $count = $model->checkCount("tbl_level_members6","spill_id" ,$ID);
                      $amount =12800000 ;  $repurchase =0;$upgrade =800000;
                    if($count > 63)
                    {
                        $this->SetLevelIncomes($member_id,1,$process_id,$end_date,6,$amount,$repurchase,$upgrade);
                    }
                    
                 

                    
	 }
	 
	 	    
	            
	 }
	         public function SetLevelsTopaz() {
	   
	     
	        $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		    $spill_id = $model->getSpillLevel("tbl_level_members7");
		    $count = $model->checkCount("tbl_level_members7","spill_id" ,$spill_id);
		    
		    if($count > 127 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    }
		     
		    
		    
		 	$QR_MEM = "SELECT member_id  FROM `tbl_cmsn_level` WHERE `type` = '6' AND member_id NOT IN(SELECT member_id FROM tbl_level_members7)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
               
		    if($count > 127 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    } 
		     
		 $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members7",$posted_data);
		    
         $count++;
		    
            }
	   
	}
             public function poollevelIncomeTopaz(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
         $QR_MEM = "SELECT member_id FROM `tbl_level_members7` WHERE `member_id` NOT IN (SELECT member_id FROM tbl_cmsn_level WHERE type ='7')";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                    $member_id = $AR_MEM['member_id'];			 	
			        $ID = $model->getIDbyMemberLevel("tbl_level_members7",$member_id);
				    $count = $model->checkCount("tbl_level_members7","spill_id" ,$ID);
                      $amount =102400000 ;  $repurchase =0;$upgrade =2400000;
                    if($count > 127)
                    {
                        $this->SetLevelIncomes($member_id,1,$process_id,$end_date,7,$amount,$repurchase,$upgrade);
                    }
                  
                 

                    
	 }
	 
	 	    
	            
	 }
	         public function SetLevelsFounder() {
	   
	     
	        $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		    $spill_id = $model->getSpillLevel("tbl_level_members8");
		    $count = $model->checkCount("tbl_level_members8","spill_id" ,$spill_id);
		    
		    if($count > 255 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    }
		     
		    
		    
		 	$QR_MEM = "SELECT member_id  FROM `tbl_cmsn_level` WHERE `type` = '7' AND member_id NOT IN(SELECT member_id FROM tbl_level_members8)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
               
		    if($count > 255 )
		    {
		        $spill_id = $spill_id+1;
		        $count = 0;
		    } 
		     
		 $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members8",$posted_data);
		    
         $count++;
		    
            }
	   
	}
             public function poollevelIncomeFounder(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
         $QR_MEM = "SELECT member_id FROM `tbl_level_members8` WHERE `member_id` NOT IN (SELECT member_id FROM tbl_cmsn_level WHERE type ='8')";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                    $member_id = $AR_MEM['member_id'];			 	
			        $ID = $model->getIDbyMemberLevel("tbl_level_members8",$member_id);
				    $count = $model->checkCount("tbl_level_members8","spill_id" ,$ID);
                      $amount =614400000 ;  $repurchase =0;$upgrade =0;
                    if($count > 255)
                    {
                        $this->SetLevelIncomes($member_id,1,$process_id,$end_date,8,$amount,$repurchase,$upgrade);
                    }
                  
               

                    
	 }
	 
	 	    
	            
	 }
	 
	 
	 
	 
	  

public function SetLevelIncomes($member_id,$level,$process_id,$date,$type,$amount,$repurchase,$upgrade) {
 			
			    $model = new OperationModel();
			 //   if($amount > 0 )
			 //   {
			         // $this->SqlModel->updateRecord(prefix."tbl_level_members",array("pay_sts"=>"Y"),array("id"=>$id));
			          $posted_data = array( 	'process_id'=>$process_id	,
			          'member_id'=>$member_id	,
			          'from_member_id'=>$member_id	,
			          'level'=>	$level,
					  'type'=>$type,
			          'total_income'=>$amount	,
			          'admin_charge'=>0	,
					  'repurchase' => $repurchase,
					  'upgrade' => $upgrade ,
			          'tds_charge'=>0	,
			          'net_income'=>$amount -$upgrade,	
			          'status'=>'Y'	,
			          'date_time'=>$date
			            );
			            $count = $model->checkCount21($member_id,$type );
			            if($count =='0')
			            {
			                $this->SqlModel->insertRecord(prefix."tbl_cmsn_level",$posted_data); 
			            }
			            
			            
			 //   }
				
				
	}
	         
	         
	         
	         
      
      public function reward() {
	    $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
		$process_id = $AR_PRSS['process_id']; 
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];   
            
            $QR_MEM = "SELECT * FROM tbl_reward   ";
            $RS_REW  = $this->SqlModel->runQuery($QR_MEM);
            

	    $QR_MEM = "SELECT tm.member_id FROM tbl_members AS tm where tm.member_id in (Select member_id from tbl_subscription)    ORDER BY tm.member_id ASC ";
		$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
	    foreach($RS_MEM as $AR_MEM){
		 
				$member_id = $AR_MEM['member_id'];
		 
                 foreach($RS_REW as $AR_REW){
                  $getBussiness = $model->GetBussinessTotal($member_id);
                  
                  if($getBussiness >=$AR_REW['pv'])
                  {
                      $exist = $model->GtExistReward($member_id,$AR_REW['reward_id']);
                      if($exist <='0')
                      {
                          
                          $posted_data = array('process_id'=> $process_id,  
                          'member_id'  => $member_id,
                          'reward_id'  =>$AR_REW['reward_id'] ,
                          'matching_pv'  =>$AR_REW['pv'] ,
                          'net_income'  => 0,
                          
                          'date_time'  =>$end_date ,
                           
                          
);
                    $this->SqlModel->insertRecord(prefix."tbl_cmsn_reward",$posted_data);      
                      }
                  }
                  
                  
                     
                 }
                
                
                
                
			}  
			 
			 
			$new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
			$new_end_date = InsertDate(AddToDate($end_date,"+1 day"));
		    $this->SqlModel->updateRecord(prefix."tbl_process",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
			$this->SqlModel->insertRecord(prefix."tbl_process",array("start_date"=>$new_start_date,"end_date"=>$new_end_date)); 
	            
		return true;	
	 
	         }  
    
     
    
        public function makewithdrawfornormal() {
    
    $t=date('d-m-Y');
   $day = date("d",strtotime($t));  
//	PrintR($day);die;
	if(true) {
//	if($day == 16 || $day == 01) {
	    
        $model = new OperationModel();
        $trns_date = date('Y-m-d');//InsertDate(getLocalTime());
        
         $trns_date =  InsertDate(AddToDate($trns_date,"0 Day"));  
 
       
        $QR_MEM = "SELECT tm.member_id,tm.bank_name,tm.account_number,tm.ifc_code,tm.user_id,tm.trx_address FROM ".prefix."tbl_members AS tm   where     tm.member_id in (Select member_id from tbl_subscription )  ORDER BY tm.member_id ASC";
		$RS_MSTR  = $this->SqlModel->runQuery($QR_MEM);
	 
		foreach($RS_MSTR as $AR_RES):
		    $member_id = $AR_RES['member_id'];
		    //	$exist = $model->checkBanckDetail($member_id);
		     
                $bank_name      = $AR_RES['bank_name'];
                $account_number = $AR_RES['account_number'];
                $ifc_code       = $AR_RES['ifc_code'];
                   $trx_address       = $AR_RES['trx_address'];
                //$bank_name !='' and $account_number !='' and $ifc_code !=''
			 if($bank_name !='' and $account_number !='' and $ifc_code !='' or $trx_address !=''){ 	 
			$bank_name = FCrtRplc($AR_RES['bank_name']);
			$bank_branch = FCrtRplc($AR_RES['bank_address']);
			$bank_city = FCrtRplc($AR_RES['bank_city']);
			$bank_state = FCrtRplc($AR_RES['bank_state']);
			$bank_country = FCrtRplc($AR_RES['bank_country']);
			
			$account_no = FCrtRplc($AR_RES['account_number']);
		    $walletd_id  = 1;
		    $LDGR = $model->getCurrentBalance($member_id,$walletd_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
		    
		     $AR_SUB = $model->getCurrentMemberShip($AR_RES['member_id']);
		    
		    
		   // if($AR_SUB['roi_stacking']=='R') {
		    
	    	if($LDGR['net_balance'] >= 500 )
            {
		    $net_amt =   $LDGR['net_balance'];
		     $net_amt = intval($net_amt);
		 	$trans_no = UniqueId("TRNS_NO");
            $admin_charge = $net_amt *5/100;
            $trns_amount = $net_amt - $admin_charge;
			
			        		 $data[] = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$walletd_id,
									"initial_amount"=>$net_amt,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>0,
									"process_fee"=>0,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW",
									"draw_type"=>"MANUAL",
									"processor_id"=>0,
									"btc_address"=>" ",
									"pm_account"=>" ",
									"pm_account_type"=>" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>" ",
									"bank_zip_code"=>" ",
									"trns_remark"=>"Withdrawal  Request from ".$AR_RES['user_id'],
								);
								
                    $userid =$AR_RES['user_id'];
                   // $transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
                    $trns_remark = "WITHDRAWAL REQUEST FROM [".$userid."]";
                  //  $model->wallet_transaction('1',"Dr",$member_id,$net_amt,$trns_remark,$trns_date,$trans_no,"1","WITHDRAW");
                  
                
                  	$data_with[] = array("wallet_id"=>$walletd_id,
			"trns_type"=>"Dr",
			"member_id"=>($member_id>0)? $member_id:0,
			"trns_amount"=>$net_amt,
			"trns_remark"=>($trns_remark)? $trns_remark:' ',
			"isActive"=> 1,
			"trans_ref_no"=>($trans_no)? $trans_no:$member_id,
			"trns_for"=>"WITHDRAW",
			"trns_date"=>$trns_date,
		//	"date_time"=>$trns_date
		);
	
	 
		//	$this->SqlModel->insertRecord(prefix."tbl_wallet_trns",$data);
	  
            }
			// }
			 }
		endforeach;
        	  	$this->SqlModel->batchInsert(prefix."tbl_fund_transfer",$data);
        	 	$this->SqlModel->batchInsert(prefix."tbl_wallet_trns",$data_with);
        	  
echo "Withdrawl has been Done..";

} else{echo "not done";}
							
    } 
 
      
      public function makewithdrawforroi() {
    
    $t=date('d-m-Y');
   $day = date("d",strtotime($t));  
//	PrintR($day);die;
	if($day == 16 || $day == 01) {
	    
        $model = new OperationModel();
        $trns_date = date('Y-m-d');//InsertDate(getLocalTime());
        
         $trns_date =  InsertDate(AddToDate($trns_date,"0 Day"));  
 
       
        $QR_MEM = "SELECT tm.member_id,tm.bank_name,tm.account_number,tm.ifc_code,tm.user_id,tm.trx_address FROM ".prefix."tbl_members AS tm   where     tm.member_id in (Select member_id from tbl_subscription )  ORDER BY tm.member_id ASC";
		$RS_MSTR  = $this->SqlModel->runQuery($QR_MEM);
	 
		foreach($RS_MSTR as $AR_RES):
		    $member_id = $AR_RES['member_id'];
		    //	$exist = $model->checkBanckDetail($member_id);
		     
                $bank_name      = $AR_RES['bank_name'];
                $account_number = $AR_RES['account_number'];
                $ifc_code       = $AR_RES['ifc_code'];
                   $trx_address       = $AR_RES['trx_address'];
                //$bank_name !='' and $account_number !='' and $ifc_code !=''
			 if($bank_name !='' and $account_number !='' and $ifc_code !='' or $trx_address !=''){ 	 
			$bank_name = FCrtRplc($AR_RES['bank_name']);
			$bank_branch = FCrtRplc($AR_RES['bank_address']);
			$bank_city = FCrtRplc($AR_RES['bank_city']);
			$bank_state = FCrtRplc($AR_RES['bank_state']);
			$bank_country = FCrtRplc($AR_RES['bank_country']);
			
			$account_no = FCrtRplc($AR_RES['account_number']);
		    $walletd_id  = 4;
		    $LDGR = $model->getCurrentBalance($member_id,$walletd_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
		    
		     $AR_SUB = $model->getCurrentMemberShip($AR_RES['member_id']);
		    
		    
		   // if($AR_SUB['roi_stacking']=='R') {
		    
	    	if($LDGR['net_balance'] >= 500 )
            {
		    $net_amt =   $LDGR['net_balance'];
		     $net_amt = intval($net_amt);
		 	$trans_no = UniqueId("TRNS_NO");
            $admin_charge = $net_amt *5/100;
            $trns_amount = $net_amt - $admin_charge;
			
			        		 $data[] = array("to_member_id"=>$member_id,
									"from_member_id"=>$member_id,//$model->getFirstId(),
									"trans_no"=>$trans_no,
									"wallet_id"=>$walletd_id,
									"initial_amount"=>$net_amt,
									"admin_charge"=>($admin_charge)? $admin_charge:0,
									"withdraw_fee"=>0,
									"process_fee"=>0,
									"trns_amount"=>$trns_amount,
									"trns_status"=>"P",
									"trns_type"=>"Dr",
									"trns_date"=>$trns_date,
									"trns_for"=>"WITHDRAW ROI",
									"draw_type"=>"MANUAL",
									"processor_id"=>0,
									"btc_address"=>" ",
									"pm_account"=>" ",
									"pm_account_type"=>" ",
									"bank_name"=>($bank_name)? $bank_name:" ",
									"bank_branch"=>($bank_branch)? $bank_branch:" ",
									"bank_city"=>($bank_city)? $bank_city:" ",
									"bank_state"=>($bank_state)? $bank_state:" ",
									"bank_country"=>($bank_country)? $bank_country:" ",
									"account_no"=>($account_no)? $account_no:" ",
									"swift_code"=>" ",
									"bank_zip_code"=>" ",
									"trns_remark"=>"Withdrawal  Request from ".$AR_RES['user_id'],
								);
								
                    $userid =$AR_RES['user_id'];
                   // $transfer_id = $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
                    $trns_remark = "ROI WITHDRAWAL REQUEST FROM [".$userid."]";
                  //  $model->wallet_transaction('1',"Dr",$member_id,$net_amt,$trns_remark,$trns_date,$trans_no,"1","WITHDRAW");
                  
                
                  	$data_with[] = array("wallet_id"=>$walletd_id,
			"trns_type"=>"Dr",
			"member_id"=>($member_id>0)? $member_id:0,
			"trns_amount"=>$net_amt,
			"trns_remark"=>($trns_remark)? $trns_remark:' ',
			"isActive"=> 1,
			"trans_ref_no"=>($trans_no)? $trans_no:$member_id,
			"trns_for"=>"WITHDRAW ROI",
			"trns_date"=>$trns_date,
		//	"date_time"=>$trns_date
		);
	
	 
		//	$this->SqlModel->insertRecord(prefix."tbl_wallet_trns",$data);
	  
            }
			// }
			 }
		endforeach;
        	  	$this->SqlModel->batchInsert(prefix."tbl_fund_transfer",$data);
        	 	$this->SqlModel->batchInsert(prefix."tbl_wallet_trns",$data_with);
        	  
echo "Withdrawl has been Done..";

} else{echo "not done";}
							
    } 
 
 
 
 
 /// Old Auto Pool Query 
 
 public function vvvvvvvvvSetLevelsGold() {
	   
	     
	    $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		 	$QR_MEM = "SELECT * FROM `tbl_cmsn_level` WHERE `type` = '1' AND member_id NOT IN(SELECT member_id FROM tbl_level_members2)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
             
		        $spill_id = returnMatrixLevel2(1);
		     $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members2",$posted_data);
		    
         
		    
            }
	   
	}
public function vvvvvvvvvpoollevelIncomeGold(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
        $QR_MEM = "SELECT  member_id FROM tbl_level_members2 where  member_id NOT IN (SELECT member_id from tbl_cmsn_level where type ='2')   ";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  // PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                $member_id = $AR_MEM['member_id'];			 	
				$status  = returnMatrixLevelCount2($member_id);
				 foreach($status as $level=>$val)
				 {
				   $count =  $model->getLevelIncomeCount($member_id,$level,2);
				  if($val > 0 and $count <= 0 )
				  {
				    if($level=='1') { $amount =120  ;  $repurchase =0;$upgrade =90;  }
					else{	$amount =0;$repurchase =0;$upgrade =0;}
					   
					 if($amount > 0 )
					 {
					     $this->SetLevelIncomes($member_id,$level,$process_id,$end_date,2,$amount,$repurchase,$upgrade);
					 }
				    
				  }
				  }
	 }
	 
	 	    
	            
	 }
public function vvvvvvvvvSetLevelsRuby() {
	   
	     
	    $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		 	$QR_MEM = "SELECT * FROM `tbl_cmsn_level` WHERE `type` = '2' AND member_id NOT IN(SELECT member_id FROM tbl_level_members3)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
             
		        $spill_id = returnMatrixLevel3(1);
		     $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members3",$posted_data);
		    
         
		    
            }
	   
	}
public function vvvvvvvvvpoollevelIncomeRuby(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
        $QR_MEM = "SELECT  member_id FROM tbl_level_members3 where  member_id NOT IN (SELECT member_id from tbl_cmsn_level where type ='3')   ";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                $member_id = $AR_MEM['member_id'];			 	
				$status  = returnMatrixLevelCount3($member_id);
				 foreach($status as $level=>$val)
				 {
				  $count =  $model->getLevelIncomeCount($member_id,$level,3);
				  if($val > 0 and $count <= 0 )
				  {
			        if($level=='1') { $amount =720   ; $repurchase =0;$upgrade =600; } 
				 
					else{	$amount =0;$repurchase =0;$upgrade =0;}
					   
					 if($amount > 0 )
					 {
					     $this->SetLevelIncomes($member_id,$level,$process_id,$end_date,3,$amount,$repurchase,$upgrade);
					 }
				    
				  }
				  }
	 }
	 
	 	    
	            
	 }
public function vvvvvvvvvSetLevelsPearl() {
	   
	     
	        $model = new OperationModel();
			$AR_PRSS = $model->getProcess($process_id);
			$process_id = $AR_PRSS['process_id']; 
			$start_date = $AR_PRSS['start_date'];
			$end_date =$AR_PRSS['end_date'];
		 	$QR_MEM = "SELECT * FROM `tbl_cmsn_level` WHERE `type` = '3' AND member_id NOT IN(SELECT member_id FROM tbl_level_members4)";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);    // PrintR($RS_MEM);die;
            foreach($RS_MEM as $AR_MEM){
            $member_id = $AR_MEM['member_id'];
             
		        $spill_id = returnMatrixLevel4(1);
		     $posted_data = array( 
         'member_id'=>  $member_id,
         'level'=>0  ,
         'spill_id'=> $spill_id ,
         'status'=> 'N' ,
         'pay_sts'=>'N'  ,
         'date_time'=> $end_date ,
         );
         $this->SqlModel->insertRecord(prefix."tbl_level_members4",$posted_data);
		    
         
		    
            }
	   
	}
public function vvvvvvvvvpoollevelIncomePearl(){
        
        $model = new OperationModel();
        $AR_PRSS = $model->getProcess($process_id);
        $process_id = $AR_PRSS['process_id']; 
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];   
        $date = date('Y-m-d') ;
        $QR_MEM = "SELECT  member_id FROM tbl_level_members4 where  member_id NOT IN (SELECT member_id from tbl_cmsn_level where type ='4')   ";
        $RS_MEM  = $this->SqlModel->runQuery($QR_MEM);  //PrintR($RS_MEM);die;
	    foreach($RS_MEM as $AR_MEM){
		 
                $member_id = $AR_MEM['member_id'];			 	
				$status  = returnMatrixLevelCount4($member_id);
				 foreach($status as $level=>$val)
				 {
				  $count =  $model->getLevelIncomeCount($member_id,$level,4);
				  if($val > 0 and $count <= 0 )
				  {
			        if($level=='1') {  $amount =9600 ;  $repurchase =0;$upgrade =8000; } 
				 
					else{	$amount =0;$repurchase =0;$upgrade =0;}
					   
					 if($amount > 0 )
					 {
					     $this->SetLevelIncomes($member_id,$level,$process_id,$end_date,4,$amount,$repurchase,$upgrade);
					 }
				    
				  }
				  }
	 }
	 
	 	    
	            
	 }
	
}
?>