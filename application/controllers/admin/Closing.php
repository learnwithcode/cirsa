<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Closing extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	
	public function index()
	{
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
        $this->load->view(ADMIN_FOLDER."/closing/closing", $data);
	}
	
	public function turbosale(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $segment['member_id'];
		$today_date = InsertDate(getLocalTime());
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		$this->load->view(ADMIN_FOLDER.'/closing/turbosale',$data);
	}
	
	public function matchingincome(){
	$model = new OperationModel();
	$form_data = $this->input->post();
	$segment = $this->uri->uri_to_assoc(2);
	$member_id = $segment['member_id'];
	$today_date = InsertDate(getLocalTime());
	$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
	$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
	$data['ROW']=$fetchRow;
	
	$this->load->view(ADMIN_FOLDER.'/closing/matchingincome',$data);}
	
	public function turbobonus(){
	$model = new OperationModel();
	$form_data = $this->input->post();
	$segment = $this->uri->uri_to_assoc(2);
	$member_id = $segment['member_id'];
	$today_date = InsertDate(getLocalTime());
	$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
	$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
	$data['ROW']=$fetchRow;
	
	$this->load->view(ADMIN_FOLDER.'/closing/turbobonus',$data);}
	
	public function leadership(){
	$model = new OperationModel();
	$form_data = $this->input->post();
	

	$segment = $this->uri->uri_to_assoc(2);
	$member_id = $segment['member_id'];
	$today_date = InsertDate(getLocalTime());
	$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
	$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
	$data['ROW']=$fetchRow;
	
	$this->load->view(ADMIN_FOLDER.'/closing/leadership',$data);}
	
	public function redremuneration(){
	$model = new OperationModel();
	$form_data = $this->input->post();
	$segment = $this->uri->uri_to_assoc(2);
	$member_id = $segment['member_id'];
	$today_date = InsertDate(getLocalTime());
	$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
	$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
	$data['ROW']=$fetchRow;
	
	$this->load->view(ADMIN_FOLDER.'/closing/redremuneration',$data);}
	
	public function totalcommission(){
	$model = new OperationModel();
	$form_data = $this->input->post();
	$segment = $this->uri->uri_to_assoc(2);
	$member_id = $segment['member_id'];
	$today_date = InsertDate(getLocalTime());
	$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
	$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
	$data['ROW']=$fetchRow;
	
	$this->load->view(ADMIN_FOLDER.'/closing/totalcommission',$data);}
			

	
	public function ajaxturbosale()
	{
	 $model = new OperationModel();
	 $form_data = $this->input->post();
	 if($form_data['submitdata']==1 && $this->input->post()!=''){
	 
	
		
		$today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcesssys($process_id);
		$process_id = $AR_PRSS['process_id'];
		$cash_wallet = $model->getWallet(WALLET1);
		$trns_remark = "TURBO COMMISSION [ WEEK NO: ".$process_id."]";
		
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
           
		$this->SqlModel->deleteRecord(prefix."tbl_cmsn_direct",array("process_id"=>$process_id));
		
		if($process_id>=0){
		    $QR_MEM = "SELECT tbl.subcription_id,mem.sponsor_id,mem.member_id as from_member_id,mem.user_id,mem.turbosale,pin.direct_bonus FROM `tbl_members` as mem 
                LEFT JOIN tbl_subscription as tbl on mem.sponsor_id=tbl.member_id 
                LEFT JOIN tbl_pintype as pin on mem.type_id=pin.type_id WHERE mem.turbosale = 2 and mem.tripot = 1 and mem.type_id>0 and mem.member_id in (Select member_id from tbl_subscription where Date(date_from) BETWEEN '2018-04-25 00:00:00' AND '".$end_date."' ) 
				and mem.member_id not in (Select from_member_id from tbl_cmsn_direct)
				and mem.sponsor_id in (Select member_id from tbl_subscription where  DATE(date_from) BETWEEN '2018-04-25 00:00:00' AND '".$end_date."' ) order by mem.member_id asc";
				
    
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
			foreach($RS_MEM as $AR_MEM):
			    
			    $subscription = $AR_MEM['subcription_id'];
			    $sponsor_id = $AR_MEM['sponsor_id'];
			    $from_member_id = $AR_MEM['from_member_id'];
			    $direct_bonus = $AR_MEM['direct_bonus'];
		    
		    
				$data_binary =array(
                	 "direct_id" => null,
                	 "process_id" => $process_id,
                	 "subcription_id" => $subscription,
                	 "member_id" => $sponsor_id,
                	 "from_member_id" => $from_member_id,
                	 "total_collection" => $direct_bonus,
                	 "total_income" => $direct_bonus,
                	 "admin_charge" => 0,
                	 "repurchase_detection" => 0,
                	 "tds" => 0,
                	 "net_income" => $direct_bonus,
                	 "cash_account" => $direct_bonus,
                	 "trading_account" => $direct_bonus,
                	 "pay_status" => Y,
                	 "date_time" => null,
                	 "status" => '0'
                 );
				
			$this->SqlModel->insertRecord(prefix."tbl_cmsn_direct",$data_binary);
		
		    endforeach;
		   
		  
		    
		$new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
		$new_end_date = InsertDate(AddToDate($end_date,"+1 Week"));
		$this->SqlModel->updateRecord(prefix."tbl_process_sys",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
		$this->SqlModel->insertRecord(prefix."tbl_process_sys",array("start_date"=>$new_start_date,"end_date"=>$new_end_date));
		
		echo TRUE;

		}
	
	 
	 } 
	}
	public function ajaxmatchingincome()
	{
	 $model = new OperationModel();
	 $form_data = $this->input->post();
	 if($form_data['submitdata']==1 && $this->input->post()!=''){

		$today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess($process_id);
		$process_id = $AR_PRSS['process_id'];
		$binary_rate = $model->getValue("CONFIG_BINARY_INCOME"); //50
		$cash_wallet = $model->getWallet(WALLET1); //1
        $CONFIG_ADMIN_CHARGE = $model->getValue("CONFIG_ADMIN_CHARGE"); //5
	    $CONFIG_TDS = $model->getValue("CONFIG_TDS"); //5
	    $REPURCHASE_DETECTION = $model->getValue("REPURCHASE_DETECTION"); //5
	    $trns_remark = "BINARY COMMISSION [ WEEK NO: ".$process_id."]";
		$this->SqlModel->deleteRecord(prefix."tbl_cmsn_binary",array("process_id"=>$process_id));
		$this->SqlModel->deleteRecord(prefix."tbl_wallet_trns",array("trns_remark"=>$trns_remark));
		if($process_id>0)
		{ 
		
		$sdate = $AR_PRSS['start_date'];
		$edate = $AR_PRSS['end_date']; 
            $QR_MEM = "SELECT tm.* FROM tbl_members AS tm where tm.member_id in (Select member_id from tbl_subscription WHERE date_from <= '$edate') and tm.type_id>0 and tm.tripot = 1 ORDER BY tm.member_id ASC ";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
			foreach($RS_MEM as $AR_MEM):
			
				$member_id = $AR_MEM['member_id'];
				$type_id = $AR_MEM['type_id'];
				$subcription_id = $AR_MEM['subcription_id'];
				$to_mem_id = $AR_MEM['sponsor_id'];
				$user_id = $AR_MEM['user_id'];
				$AR_SUB = $model->getCurrentMemberShip($member_id);
				if($member_id>0){
				    $preLcrf=0;$newLft=0;$totalLft=0;
				    $preRcrf=0;$newRgt=0;$totalRgt=0;
				    $pair_match=0;$getRef=0;
				    $amount=0;$amountt=0;$binary_Income=0;$tds=0;				
					$trans_no = UniqueId("TRNS_NO");
			        $binary_narration =  "You have no direct activated in your let or right side";
					$gettotalrefpaid = $model->gettotalrefpaid($member_id,$sdate,$edate);
					$AR_OLD = $model->getOldBinary($process_id,$member_id);
					$from_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['start_date']:"";
					$end_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['end_date']:$AR_PRSS['end_date'];
					$preLcrf = ($AR_OLD['leftCrf']>0)?$AR_OLD['leftCrf']:0;
					$preRcrf = ($AR_OLD['rightCrf']>0)?$AR_OLD['rightCrf']:0;
					if($gettotalrefpaid > 2){					
						$newLft = $model->getMemberCollection($member_id,"L",$from_date,$end_date);
						$newRgt = $model->getMemberCollection($member_id,"R",$from_date,$end_date);
						$newLft = $newLft>0? $newLft:0;
						$newRgt = $newRgt>0?$newRgt:0;
						$totalLft = $preLcrf+$newLft;
						$totalRgt = $preRcrf+$newRgt;
						$pair_match =  min($totalLft,$totalRgt);						
						$leftCrf = ( $totalLft - $pair_match );
						$rightCrf = ( $totalRgt - $pair_match );						
						$binary_narration = '';						
		    			$amount = ($pair_match*$binary_rate/100);
					}
					else
					{					
					 	$newLft = $model->getMemberCollection($member_id,"L",$from_date,$end_date);
						$newRgt = $model->getMemberCollection($member_id,"R",$from_date,$end_date);
						$newLft = $newLft>0? $newLft:0;
						$newRgt = $newRgt>0?$newRgt:0;
						$totalLft = $preLcrf+$newLft;
						$totalRgt = $preRcrf+$newRgt;						
						$leftCrf =  $totalLft;
						$rightCrf = $totalRgt;   
					    
					}
					
			
					
					
					$data_binary =array(
					    "process_id"           =>$process_id,
						"member_id"            =>$member_id,
						"type_id"              =>$type_id,
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
						"tds"                  =>($tds>0)? $tds:0,
						"admin_charge"         =>($admin_charge>0)? $admin_charge:0,
						"repurchase_detection" =>($repurchase>0)?$repurchase:0,
						"net_cmsn"             =>($amount>0)? $amount:0,
						"date_time"            =>$end_date
					);
				
    			
                		$this->SqlModel->insertRecord(prefix."tbl_cmsn_binary",$data_binary);
                   				
    				  
    					 
					unset($net_cmsn,$admin_charge,$amount,$leftCrf,$rightCrf,$pair_match,$totalLft,$totalRgt,$newLft,$newRgt,$preLcrf,$preRcrf,$AR_OLD,$left_direct_paid,$right_direct_paid,$member_id,$data_binary);
					
				}
			   
			endforeach;
		 
			
			$new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
			$new_end_date = InsertDate(AddToDate($end_date,"+1 Week"));
		    $this->SqlModel->updateRecord(prefix."tbl_process",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
			$this->SqlModel->insertRecord(prefix."tbl_process",array("start_date"=>$new_start_date,"end_date"=>$new_end_date));
			
			echo TRUE;
			}
		
	 } 
	}
	public function ajaxturbobonus()
	{
	     $model = new OperationModel();	
	     

		 $form_data = $this->input->post();
	     if($form_data['submitdata']==1 && $this->input->post()!=''){
	$sql_query = $this->db->query("SELECT COUNT(prs.process_id) as total FROM tbl_process as prs LEFT JOIN tbl_process_turbo as tur on tur.pair_sts='N' WHERE prs.process_id >= tur.process_id and prs.pair_sts !='N' ORDER BY prs.process_id ASC");
		$fetchRow = $sql_query->row_array();
	     $totalruntime = $fetchRow['total'];
		for($run=1;$run<=4;$run++){
		
		$today_date = InsertDate(getLocalTime());
		
		$AR_PRSS = $model->getProcessturbo();
		PrintR($AR_PRSS );
		$process_id = $AR_PRSS['process_id'];
		$cash_wallet = $model->getWallet(WALLET1);
		$trns_remark = "TURBO COMMISSION [ WEEK NO: ".$process_id."]";

		
	 	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
        
          
		if($process_id>=0){ 
		    
			$QR_MEM = "SELECT mem.member_id as member_id ,mem.sponsor_id as sid,mem.spil_id as parentId ,  mem.user_id as user_id, sub.date_from as date_from , sub.package_price as pv FROM `tbl_members` as mem left join tbl_subscription as sub on mem.member_id = sub.member_id WHERE `turbosale`='1' and sub.date_from BETWEEN '$start_date' and '$end_date'";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
			

  foreach($RS_MEM as $RES){
  if($RES['pv'] =='1000')
  {
      $price = 50;
  }
  elseif($RES['pv'] =='2000')
  {
      $price = 100;
  }
  elseif($RES['pv'] =='4000')
  {
      $price = 200;
  }
  
    $memId = $RES['member_id'];
    $pId = $RES['parentId'];
   for($i=1;$i<=5;$i)
   {
    $parentId = $pId;
    $val = $model->getparentId($parentId); 
   
    $pId = $val['spil_id'];
    //$turbo = $val['turbo'];
    
   if($pId ==0)
    {
        $i=6;
    }
    
    else
    {  
        $check_binary = $model->getbinaryexistornot($val['id'],$process_id); 
     
        if($check_binary > 0)
        {
        if($RES['sid'] != $val['id'])
        {

        	$data_binary =array(
                            	 "direct_id" => null,
                            	 "process_id" => $process_id,
                            	 "subcription_id" => 0,
                            	 "member_id" => $val['id'],
                            	 "from_member_id" => $memId,
                            	 "total_collection" => $price,
                            	 "total_income" => $price,
                            	 "admin_charge" => 0,
                            	 "repurchase_detection" => 0,
                            	 "tds" => 0,
                            	 "net_income" => $price,
                            	 "cash_account" => $price,
                            	 "trading_account" => $price,
                            	 "pay_status" => Y,
                            	 "date_time" => null,
                            	 "status" => '0'
                             );
    
                           $this->SqlModel->insertRecord(prefix."tbl_cmsn_bonus",$data_binary);
        
        
        $i++;
        }
        
        }
    }
    
   } 
   
   
   
   } 

		
		$new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
		$new_end_date = InsertDate(AddToDate($end_date,"+1 week"));    
		
		
		$this->SqlModel->updateRecord(prefix."tbl_process_turbo",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
		$this->SqlModel->insertRecord(prefix."tbl_process_turbo",array("start_date"=>$new_start_date,"end_date"=>$new_end_date));
	
	

		}  
		
		
		 
		 
   }
	
	echo TRUE;
	}
	}
	
	public function ajaxleadership()
	{
	
		$model = new OperationModel();
		$form_data = $this->input->post();
		if($form_data['submitdata']==1 && $this->input->post()!=''){
		$today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcessLship($process_id);
		$process_id = $AR_PRSS['process_id'];
		$binary_rate = $model->getValue("CONFIG_BINARY_INCOME"); //50
		$cash_wallet = $model->getWallet(WALLET1); //1
        $start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
	    $trns_remark = "LEADERSHIP COMMISSION [ WEEK NO: ".$process_id."]";
		
		if($process_id>0)
		{
            $QR_MEM = "SELECT tm.* FROM ".prefix."tbl_members AS tm  where tm.member_id in (Select member_id from tbl_subscription WHERE date_from <= '$end_date') and tm.type_id>0  ORDER BY tm.member_id ASC";
			$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
			foreach($RS_MEM as $AR_MEM):
    		  
    			$member_id = $AR_MEM['member_id'];
    			$type_id = $AR_MEM['type_id'];
    			$subcription_id = $AR_MEM['subcription_id'];
    			$to_mem_id = $AR_MEM['sponsor_id'];
    			$user_id = $AR_MEM['user_id'];
    			$AR_SUB = $model->getCurrentMemberShip($member_id);
    			if($member_id>0){
    			
    		        $trans_no = UniqueId("TRNS_NO");
                
    					
                	//$newLft = $model->BinaryCount($member_id,"LeftPaid");
        			//$newRgt = $model->BinaryCount($member_id,"RightPaid");
        		//	$newLft = $model->counttotalleftpv($member_id,$end_date);
				//	$newRgt = $model->counttotalrightpv($member_id,$end_date);
				
				$newLft = $model->getrightleftpv($member_id,'L',$end_date);
			 		$newRgt = $model->getrightleftpv($member_id,'R',$end_date);
					 $newLft = $newLft*1000;
					 $newRgt = $newRgt*1000;
					 
					 
					                  								
        			$newLft = ($newLft > 0 )?$newLft:0  ;
        			$newRgt = ($newRgt > 0 )? $newRgt:0  ;
        		  
        			if(	($newLft >= 30000 && $newRgt >=90000) || ($newLft >= 90000 && $newRgt >=30000) )
            		{
					$getSilver = $model->getleadership($member_id,'1');
					if($getSilver <=0){
					
            		    if($newLft >= 30000 && $newRgt >=90000)
            		    {
            		     $left = 30000;
            		     $right = 90000;
            		    }
            		    else
            		    {
            		     $right = 30000;
            		     $left = 90000;  
            		    }
						   $data = array(
            		    
            			    'process_id' =>$process_id,
            			    'subcription_id' =>$subcription_id,
            			    'member_id' =>$member_id,
            			    'leadership_id' =>'1',
            			    'left_pv' =>$left,
            			    'right_pv' => $right,
            			    'net_income' =>11000,
							'monthly_pay'=>2000
            		    );
            
                       $this->SqlModel->insertRecord(prefix."tbl_cmsn_leadership",$data);
            		}
					}
					$pv =  $model->getleadershipLR($member_id,1);
					if(	($newLft  >= 120000 && ($newRgt  >=360000) || ($newLft ) >= 360000 && ($newRgt ) >=120000) )
            		{
					$getSilver1 = $model->getleadership($member_id,'2');
					if($getSilver1 <=0){
					   if($newLft  >= 120000 && $newRgt  >= 360000)
            		    {
            		     $left = 120000;
            		     $right = 360000;
            		    }
            		    else
            		    {
            		     $right = 120000;
            		     $left = 360000;  
            		    }
						
						   $data = array(
            		    
            			    'process_id' =>$process_id,
            			    'subcription_id' =>$subcription_id,
            			    'member_id' =>$member_id,
            			    'leadership_id' =>'2',
            			    'left_pv' =>$left,
            			    'right_pv' => $right,
            			    'net_income' =>21000,
							'monthly_pay'=>3000
            		    );
             
                       $this->SqlModel->insertRecord(prefix."tbl_cmsn_leadership",$data);
					}
            			}
						
						
						
            		 
            			
            					
            					
            	}
    		 endforeach;
    		 
		 } 
		
		 
	    $new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
	 	$new_end_date = InsertDate(AddToDate($end_date,"+1 week"));
		$this->SqlModel->updateRecord(prefix."tbl_process_lship",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
		$this->SqlModel->insertRecord(prefix."tbl_process_lship",array("start_date"=>$new_start_date,"end_date"=>$new_end_date));
		
	echo TRUE;
	}
	
	}
	
	
	
	public function ajaxredremuneration()
	{
	$model = new OperationModel();
	
    $today_date = date('Y-m-d h:s:i');
	$year = date('Y');
	$month = date('m');
	$day = date('d');
	$form_data = $this->input->post();
	if($form_data['submitdata']==1 && $this->input->post()!=''){
	
	$date = date('Y-m-d');
	//$datestring=$date .'first day of last month';
    $dt=date_create($date);
    $yearMonth =  $dt->format('Y-m');

	$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_cmsn_leadership  WHERE id IN (SELECT MAX(id) FROM ".prefix."tbl_cmsn_leadership where date_time NOT LIKE '$yearMonth%' GROUP BY member_id ) ");
		$RS_MEM = $sel_query->result_array();
		if(is_array($RS_MEM) && !empty($RS_MEM))
		{
		  foreach($RS_MEM as $AR_MEM):
		  $member_id = $AR_MEM['member_id'];
		  $checkExist = $model->checkexistredremuneration($member_id);
		  if($checkExist <= 0)
		  {
		    $leaderShipId = $AR_MEM['leadership_id'];
		    $counttotalred = $model->counttotalred($member_id,$leaderShipId);  
			if($counttotalred < 6)
			{
			 $posted_data= array(			 
			 	'member_id'=>$AR_MEM['member_id'],
				'leadership_id'=>$AR_MEM['id'],	
				'leadership_type'=>$AR_MEM['leadership_id'],	
				'net_income'=>$AR_MEM['monthly_pay'],	
				'year'=>$year,	
				'month'	=>$month,
				'day'	=>$day,
				'date_time'=>$today_date
				
			 );
			 $this->SqlModel->insertRecord(prefix."tbl_cmsn_red",$posted_data);
			}
		  }
		  endforeach;
		}
	
	}
	
	echo TRUE;
	}
	
	public function ajaxtotalcommission()
	{
	$model = new OperationModel();
	$form_data = $this->input->post();
	if($form_data['submitdata']==1 && $this->input->post()!=''){
	
	
	    
	   
	  	$AR_PRSS = $model->getProcessMaster($process_id);
		$process_id = $AR_PRSS['process_id'];
	  	$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		
		
	    $CONFIG_TDS = $model->getValue("CONFIG_TDS"); 
	    $QR_MEM = "SELECT tm.* FROM tbl_members AS tm where tm.member_id in (Select member_id from tbl_subscription) and tm.type_id>0  ORDER BY tm.member_id ASC ";
		$RS_MEM  = $this->SqlModel->runQuery($QR_MEM);
		$trns_remark = "BINARY COMMISSION [ WEEK NO: ".$process_id."]";
		
		$sel_query = $this->db->query("SELECT SUM(net_income) as net FROM tbl_cmsn_bonus WHERE status='0'");
		$fetchTurbobonus = $sel_query->row_array();
	    $TurbobonusIncome= $fetchTurbobonus['net'];
		
			foreach($RS_MEM as $AR_MEM):
			
				$member_id = $AR_MEM['member_id'];
				$trans_no = UniqueId("TRNS_NO");
				$binary = $model->getbinaryamount($member_id,$process_id);
				$direct = $model->getdirectamount($member_id,$process_id);
			  	$leader = $model->getleaderamount($member_id,$process_id);
			  //	$red = $model->getredremamount($member_id);
			  $red = 0;
				if($TurbobonusIncome > 0 )
				{
			//	$bonus = $model->getbonusamount($member_id);
				}
				
				
			   $get_total = $model->gettotalamount($member_id);
			   $get_tds = $model->gettotaltdsamount($member_id);
			   $leader=($leader > 0)?$leader:0;
			   $bonus = ($bonus > 0)?$bonus:0;
			   $direct = ($direct >0)?$direct:0;
			   $binary = ($binary > 0)?$binary:0;
			   $red = ($red > 0)?$red:0;
		        $total = $binary+	$direct +$leader+$bonus+$red;    
         if( ($total+$get_total) > 15000){
						 $newtds = (($total+$get_total)*$CONFIG_TDS/100);
						 $tds = $newtds - $get_tds;
						 $net_income = $total - $tds;
					}
					else{
						$tds =0 ;
						$net_income = $total;
					}
				
				if($net_income > 0 )
				{
					$data_binary =array(
                	 "member_id" => $member_id  ,
                	 "process_id" => $process_id,
                	 "binary_income" => ($binary > 0)?$binary:0,
                	 "direct_income" => ($direct > 0)?$direct:0,
                	 "turbobonus" => ($bonus>0)?$bonus:0,
                	 "leadership" => ($leader > 0)?$leader:0,
                	 "red_remu"  =>($red > 0)?$red:0,
                	 "total_income" => $total,
                	 "tds" => $tds,
                	 "net_income" => $net_income,
                     "pay_sts_date" =>$end_date,
                	 "pay_sts" => Y
                 );

			$this->SqlModel->insertRecord(prefix."tbl_cmsn_mstr",$data_binary);
			$model->wallet_transaction('1',"Cr",$member_id,$net_income,$trns_remark,$end_date,$trans_no,1,"BYC");	
				}	
			endforeach;
				
		
	    	$new_start_date = InsertDate(AddToDate($end_date,"+1 day"));
			$new_end_date = InsertDate(AddToDate($end_date,"+1 Week"));
		    $this->SqlModel->updateRecord(prefix."tbl_process_master",array("pair_sts"=>"Y"),array("process_id"=>$process_id));
			$this->SqlModel->insertRecord(prefix."tbl_process_master",array("start_date"=>$new_start_date,"end_date"=>$new_end_date)); 
	  if($TurbobonusIncome > 0 )
				{
			 $this->SqlModel->updateRecord(prefix."tbl_cmsn_bonus",array("status"=>"1"),array("status"=>'0'));
				}  
				if($red > 0 )
				{
			 $this->SqlModel->updateRecord(prefix."tbl_cmsn_red",array("status"=>"Y"),array("status"=>'N'));
				}  
	    	
	
	}
		echo "TRUE";
		
	}
	//SELECT * FROM `tbl_cmsn_leadership` WHERE `date_time` LIKE '2018-05-%'
	
	/*if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
			$first_name = FCrtRplc($form_data['first_name']);
			$last_name = FCrtRplc($form_data['last_name']);
			$full_name = $first_name." ".$last_name;
			$email_address = FCrtRplc($form_data['email_address']);
			
			$left_right = FCrtRplc($form_data['left_right']);
			$user_name = FCrtRplc($form_data['user_name']);
			$sponsor_user_name = FCrtRplc($form_data['sponsor_user_name']);
			$sponsor_mem_id = $model->getMemberId($sponsor_user_name);
			
			$AR_GET = $model->getSponsorSpill($sponsor_mem_id,$left_right);
			$sponsor_id = $AR_GET['sponsor_id'];
			$spil_id = $AR_GET['spil_id'];
			
			
			$flddDOB = $flddDOB_Y."-".$flddDOB_M."-".$flddDOB_D;
			$date_of_birth = InsertDate($flddDOB);
			$user_id = $model->generateUserId();
	
			if($model->checkCount(prefix."tbl_members","user_name",$sponsor_user_name)>0){
				if($model->checkCount(prefix."tbl_members","user_name",$user_name)==0){
					$Ctrl += ($left_right!='')? $model->CheckOpenPlace($spil_id,$left_right):0;
					$data = array(
					    "first_name"=>$first_name,
						"last_name"=>$last_name,
						"full_name"=>$full_name,
						"user_id"=>$user_id,
						"user_name"=>$user_id,
						"member_email"=>$email_address,
						"sponsor_id"=>$sponsor_id,
						"spil_id"=>$spil_id,
						"left_right"=>$left_right,
						"date_join"=>$today_date,
						"pan_status"=>"N",
						"status"=>"Y",
						"last_login"=>$today_date,
						"login_ip"=>$_SERVER['REMOTE_ADDR'],
						"block_sts"=>"N",
						"sms_sts"=>"N",
						"date_of_birth"=>date_of_birth,
						"upgrade_date"=>$today_date
					);		
					
					if($member_id>0){
						$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
						set_message("success","Successfully updated  detail");
						redirect_page("member","addmembertwo",array("member_id"=>_e($member_id)));
					}else{
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
							set_message("success","Successfully executed record, please proceed for login info");
							redirect_page("member","addmembertwo",array("member_id"=>_e($member_id)));
						}else{
							set_message("warning","Failed , unable to process your request , please try again");
							redirect_page("member","addmember",array());
						}
					}
				}else{
					set_message("warning","This user name is already exists, please try another user name");
				}
			}else{
				set_message("warning","Invalid sponsor ID");
			}
		} */

	
	
}
