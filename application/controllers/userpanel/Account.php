<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
	}
	public function airdrop()    	    {
	 	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');	
    	$this->load->view(MEMBER_FOLDER.'/account/airdrop',$data);
	
}
	public function transaction(){
	 
	   if(true){
// Replace with your database credentials
$host = 'localhost';
$user = 'trade4money_plustech';
$password = 'OHVsI&nl65@v';
$database = 'trade4money_plustech';

// Retrieve JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

//PrintR($data);

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(true){

// Store transaction details in the database
$stmt = $conn->prepare("INSERT INTO transactions (transaction_hash, from_address, to_address, amount) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $data['transactionHash'], $data['from'], $data['to'], $data['amount']);
$stmt->execute();
$stmt->close();
redirect_member("crypto","",""); 
}
if(false){
// Store transaction details in the database
$stmt = $conn->prepare("INSERT INTO gassss (transaction_hash) VALUES (?)");
$stmt->bind_param("ssss", $data['transactionHash']);
$stmt->execute();
$stmt->close();
}
echo 'Transaction details stored successfully!';

// Close the connection
$conn->close();

} 
	    
	    
	}

	  public function updateDirectCounts($member_id)     {
    
     $model = new OperationModel(); 
    
     $QR_MEM = "SELECT member_id FROM `tbl_members` WHERE member_id = '$member_id'  ";
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
    public function maindailyminingreturndfsdfsdfsfsdf(){
	    	$model = new OperationModel();
	    //	echo "sdasda";
 $member_id =  $this->input->post('id');
	 // $member_id = $this->session->userdata('mem_id'); 
	      
	       $memberdetail   = $model->getMemberdetail($member_id);
	      
	 
 
 
	  	$AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		$today_date = $end_date;//InsertDate(getLocalTime());
		$cmsn_date =   InsertDate(AddToDate($today_date,"0 Day")); #InsertDate($today_date); 
		
	  $day = getDateFormat($end_date,"D"); 
	$QR_CMSN = "SELECT package_price,retopup,type,member_id FROM tbl_subscription AS ts where ts.offroi='N'  and member_id = '".$member_id."' ORDER BY `ts`.`subcription_id` ";
	
	//	$QR_CMSN = "SELECT sum(package_price) as  package_price,retopup,type,member_id FROM tbl_subscription AS ts where  pool='N'  and member_id = '".$member_id."' group by member_id";
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN); 
 // PrintR($RS_CMSN);
	  //  PrintR($RS_CMSN); die;
	    $this->updateDirectCounts($member_id);
	    
	    	$date = getLocalTime();
					
					 
					 
					foreach($RS_CMSN as $AR_CMSN):
					    
					      $sponsor_id       = $model->getSponsorId($member_id);
					      
					      $package_price=$AR_CMSN['package_price'];
					      
				 $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$member_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE package_price >= $package_price)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);    
//$total = $PAID_DIR['total'];
				
					$trans_no = rand(111111,9999999);
					
					  $memberdetail   = $model->getMemberdetail($member_id);
				//	PrintR($memberdetail['count_directs']);
				$count_directs=	$PAID_DIR['total'];//$memberdetail['count_directs'];
				
   $date_from = InsertDate($AR_CMSN['type']);				

//$today_date =$today_date = date('Y-m-d');

$date1 = new DateTime($date_from);
$date2 = new DateTime($today_date);
$days  = $date2->diff($date1)->format('%a');


//echo "<br>";

	$sub = $model->checkCounttopupmining('tbl_subscription','member_id',$member_id,'N','A');  
//echo "<br>";
//die;
			    

			if($package_price >= 100 and $package_price <= 499 ){ 
			    
			    $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =0.50;
					$cal_amount = $trans_amount*$daily_return/100;   
			}
        elseif($package_price >= 500 and $package_price <= 1999 ){ 
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =0.75;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
        elseif($package_price >= 2000 and $package_price <= 4999 ){ 
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.00;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
        elseif($package_price >= 5000 and $package_price <= 9999 ){ 
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.25;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
        elseif($package_price >= 10000 and $package_price  <= 24999 ){
            
            
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.50;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
         elseif($package_price >= 25000){
            
            
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.75;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
        else{
                    $dayss=0;
				  	$trans_amount = 0;//$AR_CMSN['package_price'];
					$daily_return =0;//2;
					$cal_amount = 0;//$trans_amount*$daily_return/100;  
            
            }
		           
		
		if($member_id>0 ){
					

						
					    	$posting_no = $model->getPostingCount($subcription_id,$member_id,$cmsn_date);
				 	        $remark = "Mining Bonus - DAY NO[".$posting_no."]";
				 	        
				 	        
							if($posting_no  <= $dayss)
							{
					
                   if($cal_amount){
                 
                 						
                   
                   
                   
			 
		
			$getTotalMemberShipValue = $model->getTotalMemberShipValue($member_id,$today_date); 
			
	$x_income =		$memberdetail['x_income'];
$DailyIncome = $model->getincomesallnew("Daily",$member_id);   
$directIncome = $model->getincomesallnew("Direct",$member_id);
$Level = $model->getincomesallnew("Level",$member_id);
$totalearning  = $DailyIncome+$directIncome+$Level;
		 $PAID_DIReee = "SELECT x_income as x_income,subcription_id FROM `tbl_subscription` WHERE `member_id`='$member_id'  ORDER BY `tbl_subscription`.`subcription_id` ASC Limit 1; "; 
$PAID_DIRee = $model->SqlModel->runQuery($PAID_DIReee,true); 	

if($x_income==0){
    
   $x_income1 =300; 
    
}else{
    
    
   $x_income1 =$x_income;
    
}


 $packageamount =$PAID_DIRee['x_income'];
//$packageamount =$PAID_DIRee['package_price']*$x_income1/100;

  
         $subcription_id=    $PAID_DIRee['subcription_id'];
 $PAID_DIReee1 = "SELECT * FROM `tbl_subscription` WHERE `member_id`='$member_id' and `offroi` ='N' ORDER BY `tbl_subscription`.`subcription_id` DESC Limit 1; "; 
$PAID_DIRee1 = $model->SqlModel->runQuery($PAID_DIReee1,true); 	
$packageamount1 =$PAID_DIRee1['package_price']*$x_income1/100;
  $subcription_id1=    $PAID_DIRee1['subcription_id'];

if($totalearning <=$packageamount){
 $_5xincome=   $packageamount;
  $Income_Category= $x_income.'X';
 if(false){
 
			if($x_income==4){
                $x_income='400';
               $_5xincome =$getTotalMemberShipValue*$x_income/100;
            $Income_Category='4 X';   
                
            }elseif($x_income==5){
                
                $x_income='500';
               $_5xincome =$getTotalMemberShipValue*$x_income/100;
            $Income_Category='5 X';    
                
            }elseif($x_income==6){
                
                $x_income='600';
               $_5xincome =$getTotalMemberShipValue*$x_income/100;
            $Income_Category='6 X';    
                
            }elseif($x_income==7){
                
                $x_income='700';
               $_5xincome =$getTotalMemberShipValue*$x_income/100;
            $Income_Category='7 X';    
                
            }elseif($x_income==8){
                
                $x_income='800';
               $_5xincome =$getTotalMemberShipValue*$x_income/100;
            $Income_Category='8 X';    
                
            }elseif($x_income==9){
                
                $x_income='900';
               $_5xincome =$getTotalMemberShipValue*$x_income/100;
            $Income_Category='9 X';    
                
            }elseif($x_income==10){
                
                $x_income='1000';
               $_5xincome =$getTotalMemberShipValue*$x_income/100;
            $Income_Category='10 X';    
                
            }else{
                
                  $_5xincome =$getTotalMemberShipValue*300/100;
            $Income_Category='3 X';
                
            }
            
}
            
}else{
  $_5xincome=   $packageamount;
           $Income_Category= $x_income.'X';
    
}		
			
           // $_3xincome =$getTotalMemberShipValue*200/100;
           
			
			//	  $daily        = $model->gettotalminingamount($member_id);
				
				
			if($totalearning <= $_5xincome){
			    	$todaymining = $model->getTotdaymining($member_id,$today_date);
							$packagecount = $model->packagecount($member_id,$today_date);
							
					if($todaymining < 1 ){
					    
					   $todaymining=1; 
					    
					}else{
					     $todaymining=2;  
					}
					
				  if(($cal_amount>0)) {
                  
                  $flushout  = 0;
                  $netIncome = 0;
                  if(($totalearning + $cal_amount ) <= $_5xincome) 
                  {
                      $netIncome = $cal_amount;
                      $remarks   = "Income successfully credit in your wallet.";  
                  }
                  else
                  {
                      if($totalearning < $_5xincome)
                      {
                          $T1 = $_5xincome -  $totalearning ;
                          if($T1 > $cal_amount)
                          {
                            $netIncome = $cal_amount;  
                            $remarks   = "Income successfully credit in your wallet.";  
                          }
                          else
                          {
                            $netIncome = $T1;
                            $flushout  = $cal_amount - $T1;
                            $remarks   = "Income has been flushout $Income_Category limit completed.";  
                          }
                          
                            
                      }
                      else
                      {
                            $netIncome = 0;  
                             $total  = 0;
                            $flushout  = $cal_amount - $T1;;
                            $remarks   = "Your $Income_Category limit has been completed and your income has flushed out."; 
                      }
                      
                        
                  }
             
 

			  $netIncome     = number_format((float)($cal_amount), 4, '.', '');  	 
			  $flushout  = number_format((float)($flushout), 4, '.', ''); 
            
	          $charge = $total*0/100;
	       //   $echopocket = $total1*0/100;
	       //   $net = $total1 -$echopocket;
				$data = array("member_id"=>$member_id,
				"subcription_id"=>0,
				"type_id"=>0,
				"trans_no"=>$trans_no,
				"trans_amount"=>$trans_amount,
				"daily_return"=>$cal_amount,
				"net_income"=>$trans_amount*$daily_return/100-($flushout),
				"trns_remark"=>$remark,
				"process_id"=>$process_id,
				"date_time"=>$today_date
			);
		PrintR($data);  
		
            
                            $trns_remark1 = "Flush Out";  
                            
                          //  if($netIncome > 0 )                            {
                          $this->SqlModel->insertRecord(prefix."tbl_cmsn_daily",$data);
                          
                         
                             
                         //  }
                            if($flushout > 0 )
                            {
                     
    
       $data_sub = array(
                "offroi"=>'Y'
               
                );

				$this->SqlModel->updateRecord(prefix."tbl_subscription",$data_sub,array("subcription_id"=>$subcription_id)); 
    

                     $model->wallet_transaction('5',"Cr",$member_id,$flushout,$trns_remark1,$end_date,$trans_no,1,"Flush Out");
                            }
                            
                    
        } 		
							
							
					//	PrintR($todaymining);die;
						  $CONFIG_WITHDRAWL_LIMIT = 1;//$packagecount;  
						  	 if(true){
					// if($todaymining < $CONFIG_WITHDRAWL_LIMIT  ){  
					     
			 
            // $model->wallet_transaction('2',"Cr",$member_id,$cal_amount,'Mining Bonus',$end_date,$trans_no,1,"Mining"); 
                        // set_message("success","Successfully Get Mining Bonus");
                
                          
					     
					     
					     
					 }
					 
				
			}else{
			    $data_sub = array(
                "offroi"=>'Y'
               
                );
             //   echo $subcription_id;

			//	$this->SqlModel->updateRecord(prefix."tbl_subscription",$data_sub,array("subcription_id"=>$subcription_id)); 
				
				
			//	 $this->db->query("UPDATE `tbl_subscription` SET `offroi` =  'Y'  WHERE subcription_id ='$subcription_id'; limit 1");	
			    
			}	
				
		
                   }	    
							     
							    
							}else{
							  	//   $data= "Mining Days Completed"; 
			// set_message("warning","Mining Days Completed");
							}
						 
						
					}
					
					 
				unset($trans_amount,$cal_amount);
				
		 
				endforeach;
			//	 $data= "Successfully Get Mining Bonusdddd"; 
			 // set_message("success","Successfully Get Mining Bonus");	 
					 
					 
	      echo strtoupper("$data");
	   // echo json_encode($data);
	    
	}
		public function maindailyminingreturn(){
	    	$model = new OperationModel();
	    //	echo "sdasda";
	  // $member_id =  $this->input->post('id');
	 $member_id = $this->session->userdata('mem_id'); 
	      
	       $memberdetail   = $model->getMemberdetail($member_id);
	      
	for($i = 1; $i<=1;$i++){	 
 
 
	  	$AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		$today_date = $end_date;//InsertDate(getLocalTime());
		$cmsn_date =   InsertDate(AddToDate($today_date,"0 Day")); #InsertDate($today_date); 
		
	  $day = getDateFormat($end_date,"D"); 
	   $LDGR = $model->getCurrentBalance($member_id,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
	  $DailyIncome = $model->getincomesallnew("Daily",$member_id);   
$directIncome = $model->getincomesallnew("Direct",$member_id);
$Level = $model->getincomesallnew("Level",$member_id);
// $totalearning  = $DailyIncome+$directIncome+$Level;
 
 
 
 
  $totalearning  = $LDGR['total_amount_cr'];
	   $PAID_DIReee1 = "SELECT sum(x_income) as x_income,subcription_id FROM `tbl_subscription` WHERE  `member_id`='$member_id'  ORDER BY `tbl_subscription`.`subcription_id` ASC Limit 1; "; 
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
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	$QR_CMSN = "SELECT package_price,retopup,type,member_id FROM tbl_subscription AS ts where ts.offroi='N'  and member_id = '".$member_id."' ORDER BY `ts`.`subcription_id` ";
//die;	
	//	$QR_CMSN = "SELECT sum(package_price) as  package_price,retopup,type,member_id FROM tbl_subscription AS ts where  pool='N'  and member_id = '".$member_id."' group by member_id";
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN); 
 // PrintR($RS_CMSN);
	  //  PrintR($RS_CMSN); die;
	    $this->updateDirectCounts($member_id);
	    
	    	$date = getLocalTime();
					
					 
					 
					foreach($RS_CMSN as $AR_CMSN):
					    
					      $sponsor_id       = $model->getSponsorId($member_id);
					      
					      $package_price=$AR_CMSN['package_price'];
	
				
					$trans_no = rand(111111,9999999);
					
					  $memberdetail   = $model->getMemberdetail($member_id);
				//	PrintR($memberdetail['count_directs']);
			
				
   $date_from = InsertDate($AR_CMSN['type']);				
	
		if($member_id>0 ){
			
	if($package_price >= 100 and $package_price <= 499 ){ 
			    
			    $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =0.50;
					$cal_amount = $trans_amount*$daily_return/100;   
			}
        elseif($package_price >= 500 and $package_price <= 1999 ){ 
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =0.75;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
        elseif($package_price >= 2000 and $package_price <= 4999 ){ 
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.00;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
        elseif($package_price >= 5000 and $package_price <= 9999 ){ 
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.25;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
        elseif($package_price >= 10000 and $package_price  <= 24999 ){
            
            
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.50;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
         elseif($package_price >= 25000){
            
            
            
            $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =1.75;
					$cal_amount = $trans_amount*$daily_return/100;   
            
        }
        else{
                    $dayss=0;
				  	$trans_amount = 0;//$AR_CMSN['package_price'];
					$daily_return =0;//2;
					$cal_amount = 0;//$trans_amount*$daily_return/100;  
            
            }
	           

 $PAID_DIReee = "SELECT x_income as x_income,subcription_id FROM `tbl_subscription` WHERE offroi='N'  and `member_id`='$member_id'  ORDER BY `tbl_subscription`.`subcription_id` ASC Limit 1; "; 
$PAID_DIRee = $model->SqlModel->runQuery($PAID_DIReee,true); 	

 $packageamount =$PAID_DIRee['x_income'];
$subcription_id=    $PAID_DIRee['subcription_id'];


 $PAID_DIRee22e = "SELECT sum(x_income) as x_income,subcription_id FROM `tbl_subscription` WHERE offroi='Y'  and `member_id`='$member_id'  ORDER BY `tbl_subscription`.`subcription_id` ASC; "; 
$PAID_DI333Ree = $model->SqlModel->runQuery($PAID_DIRee22e,true); 	

 $packageamount222 =$PAID_DI333Ree['x_income'];

$finalpackage =  $packageamount+$packageamount222;

if($totalearning <= $finalpackage){
 $_5xincome=   $finalpackage;
 $Income_Category= $x_income.'X'; 
}else{
    $_5xincome=   $finalpackage;
    if($totalearning < $_5xincome){
        
     $_5xincome=   $finalpackage+$totalearning;
           $Income_Category= $x_income.'X';      
        
    }else{
        
        $_5xincome=   $finalpackage;
           $Income_Category= $x_income.'X';   
        
    }
    
    
    
 
    
}

// echo $totalearning;
//	 die;				
			  if(($cal_amount>0)) {
                  
                  $flushout  = 0;
                  $netIncome = 0;
                  if(($totalearning + $cal_amount ) <= $_5xincome) 
                  {
                    echo  $totalearning + $cal_amount;
                      
                    echo  $netIncome = $cal_amount;
                     echo $remarks   = "Income successfully credit in your wallet.";  //die; 
                  }
                  else
                  {
                      if($totalearning < $_5xincome)
                      {
                          $T1 = $_5xincome -  $totalearning ;
                          if($T1 > $cal_amount)
                          {
                            $netIncome = $cal_amount;  
                         echo   $remarks   = "Income successfully credit in your wallet @.";  
                          }
                          else
                          {
                            $netIncome = $cal_amount;
                            $flushout  = $cal_amount - $T1;
                        echo    $remarks   = "Income has been flushout $Income_Category limit completed.";  
                          }
                          
                            
                      }
                      else
                      {
                            $netIncome = 0;  
                             $total  = 0;
                            $flushout  = 0;
                        echo    $remarks   = "Your $Income_Category limit has been completed and your income has flushed out."; 
                         if($totalearning <= $finalpackage){   
                             
            
                             
                             
                       
                   //  $flushout  = 0;
                         }else{
                             
                          echo   $totalearning;
                          echo "<br>";
                          echo   $finalpackage;
                               $data_sub = array(
                "offroi"=>'Y'
               
                );
            $flushout  = 0;
				$this->SqlModel->updateRecord(prefix."tbl_subscription",$data_sub,array("subcription_id"=>$subcription_id));  
                             
                         }
                                
                            
                      }
                      
                        
                  }
          
 	$posting_no = $model->getPostingCount($subcription_id,$member_id,$cmsn_date);
				 	        $remark = "Mining Bonus - DAY NO[".$posting_no."]";

			  $netIncome     = number_format((float)($netIncome), 4, '.', '');  	 
			  $flushout  = number_format((float)($flushout), 4, '.', ''); 
            if($flushout>0){
              //echo "asdfasd";  die;
            echo   $cal_amount = $cal_amount- $flushout;
                
            }else{
            //   echo "eeeeasdfasd";  die;  
           echo  $cal_amount=$cal_amount;   
                
                
            }
            
           
	          $charge = $total*0/100;
	       //   $echopocket = $total1*0/100;
	       //   $net = $total1 -$echopocket;
				$data = array("member_id"=>$member_id,
				"subcription_id"=>0,
				"type_id"=>0,
				"trans_no"=>$trans_no,
				"trans_amount"=>$trans_amount,
				"daily_return"=>$daily_return,
				"net_income"=>$cal_amount,
				"trns_remark"=>$remark,
				"process_id"=>$process_id,
				"date_time"=>$today_date
			);
		PrintR($data);  
	//	 die;
            
                            $trns_remark1 = "Flush Out";  
                            
                            if($netIncome > 0 )                            {
                    $this->SqlModel->insertRecord(prefix."tbl_cmsn_daily",$data);
                       $trns_remark111 = "DAILY TRADING BONUS";  
                        $model->wallet_transaction('1',"Cr",$member_id,$cal_amount,$trns_remark111,$end_date,$trans_no,1,"ROI"); 
                    
                         $this->db->query("UPDATE `tbl_members` SET `total_income` =  total_income+$cal_amount     WHERE member_id ='$member_id';");  
                         
                          }
                            if($flushout > 0 )
                            {
                     
    
       $data_sub = array(
                "offroi"=>'Y'
               
                );

				$this->SqlModel->updateRecord(prefix."tbl_subscription",$data_sub,array("subcription_id"=>$subcription_id)); 
    

                  $model->wallet_transaction('5',"Cr",$member_id,$flushout,$trns_remark1,$end_date,$trans_no,1,"ROI");
                            }
                            
                    
        } 		
			
					 
				unset($trans_amount,$cal_amount);
				
		}
				endforeach;
			//	 $data= "Successfully Get Mining Bonusdddd"; 
			 // set_message("success","Successfully Get Mining Bonus");	 
					 
					 
	      echo strtoupper("$data");
	   // echo json_encode($data);
		}
	}
		public function maindailyminingreturnold(){
	    	$model = new OperationModel();
	 	$member_id = $this->session->userdata('mem_id');   
       	  $memberdetail   = $model->getMemberdetail($member_id);
 
 
	  	$AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];
		$today_date = $end_date;//InsertDate(getLocalTime());
		$cmsn_date =   InsertDate(AddToDate($today_date,"0 Day")); #InsertDate($today_date); 
		
	  $day = getDateFormat($end_date,"D"); 

		$QR_CMSN = "SELECT * FROM tbl_subscription AS ts where  member_id = '".$member_id."'  ORDER BY ts.subcription_id ASC";
		$RS_CMSN = $this->SqlModel->runQuery($QR_CMSN); 
 // PrintR($RS_CMSN);
		 	$date = getLocalTime();
						$todaymining = $model->getTotdaymining($member_id,$date);
							
						
						  $CONFIG_WITHDRAWL_LIMIT = 1;    
					 if($todaymining < $CONFIG_WITHDRAWL_LIMIT  ){ }
					 
					 
					 
					 else{
					     
					     
					      set_message("danger","You have already Mining Today please try next day");
				 	redirect_member("dashboard","index","");   
					     
					 
					     
					     
					 }
				
			
				
				
				
						
				foreach($RS_CMSN as $AR_CMSN):
				
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
				     $dayss=375;
				  	$trans_amount = $AR_CMSN['package_price'];
					$daily_return =0.8;
					$cal_amount = $trans_amount*$daily_return/100; 
				}
			
				 
				 
				     	
					if($member_id>0 ){
					

						
					    	$posting_no = $model->getPostingCount($subcription_id,$member_id,$cmsn_date);
				 	        $remark = "Mining Bonus - DAY NO[".$posting_no."]";
				 	        
				 	        
							if($posting_no  <= $dayss)
							{
					
                   if($cal_amount){
                 
                 						
                   
                   
                   
			 
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
		//	PrintR($data);  
		
		
			$getTotalMemberShipValue = $model->getTotalMemberShipValue($member_id,$start_date); 
            $_3xincome =$getTotalMemberShipValue*300/100;
            $Income_Category='2 X';
			
				  $daily        = $model->gettotalminingamount($member_id);
				
				
			if($daily <= $_3xincome){
			    
			    
			    
			    	$this->SqlModel->insertRecord(prefix."tbl_cmsn_daily",$data);
		$model->wallet_transaction('2',"Cr",$member_id,$cal_amount,'Mining Bonus',$end_date,$trans_no,1,"Mining"); 
		 set_message("success","Successfully Get Mining Bonus");
				// 	redirect_member("dashboard","index",""); 
			 
			    
			    
			}else{
			   
	 set_message("warning","Your $Income_Category limit has been completed and your income has flushed out.");
				// 	redirect_member("dashboard","index",""); 
			  
			    
			}	
				
		
		
		
		
		
		
		
		
	
                   }	    
							     
							    
							}else{
							  
			 set_message("warning","Mining Days Completed");
							}
						 
						
					}
					
					 
				unset($trans_amount,$cal_amount);
				
		 
				endforeach;
				
			  set_message("success","Successfully Get Mining Bonus");
			 	redirect_member("dashboard","index",""); 
			    
	}
		 public function updatedatestacking(){
		$model = new OperationModel();
            $AR_PRSS = $model->getProcess();
            $process_id = $AR_PRSS['process_id'];
            $end_date=$AR_PRSS['end_date'];
		
		$form_data = $this->input->post();
	//	PrintR($form_data);die;
		$segment = $this->uri->uri_to_assoc(2);
	  	$today_date =date('Y-m-d');// getLocalTime(); 
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
	//	$package_price = FCrtRplc($form_data['package_price']);
	  	$member_id = $this->session->userdata('mem_id'); $member_ids =  	$member_id ;
		$order_no = rand(111111,9999999); 
	    $sts = $model->getactivationSts($member_id);
		if($model->getValue("member_activation_on_off")=='Y' or   $sts =='N'){
		if($form_data['updatedatestacking']==1 && $this->input->post()!=''){
		   // PrintR($form_data);
		  //   die;
		          
			  // 	$memberId = $model->getMemberId($form_data['member_id']);
			
			
              	$stacking_days = $form_data['stacking_days'];
              	
									
                $data_sub = array(
                "stacking_days"=>$stacking_days
               
                );

				$this->SqlModel->updateRecord(prefix."tbl_members",$data_sub,array("member_id"=>$member_id));						
		
            
									set_message("success","You have successfully Stacking Days..");
							 	redirect_member("dashboard","index","");  
								
								
								
								
								
			  
		        
		  
			
		}
		
		
	   }
else{
		      
		    set_message("warning","Activation unavailable");
		   	redirect_member("dashboard","index","");   
		  }
        
// 		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
// 		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
// 		$data['first_name']=$fR;

// 		$data['web_title'] = 'Activataion';
 	//	$this->load->view(MEMBER_FOLDER.'/account/upgrademember',$data);
	}
		public function verifypayment(){
	
	 	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
	    	 $Wallet_addressffff= $Wallet_address = $model->getMemberwallet_adress($member_id);
	    	
	    
	    		$form_data = $this->input->post(); 
	    		$randcheck =$form_data['randcheck'];
	    		//PrintR($form_data['randcheck']);die;
	    	 $randcheck =  strtolower($randcheck);
 $address ='0x8C1D40C445510823308ef6dd208E06c541B0e74D';
 $statusaaa = $address= strtolower($address);

        //  echo "<br>";
       	$member_id = $this->session->userdata('mem_id');   
       	  $memberdetail   = $model->getMemberdetail($member_id);
            $member_email      = $memberdetail['member_email']; 
              $user_id      = $memberdetail['user_id']; 
	
	
$apikey = 'NJ8RBI3UPUBP9F4C4RW5RBVWW8HEJ7YT5Y';
$contractAddress = '0x55d398326f99059fF775485246999027B3197955';

$url = "https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=$contractAddress&address=$address&page=1&offset=200&sort=desc&apikey=$apikey";

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Execute cURL session and get the response
$response = curl_exec($ch);
curl_close($ch);

// Decode JSON response
$data = json_decode($response, true);

// Check if API call was successful
if ($data['status'] === '1' && $data['message'] === 'OK') {
    $transactions = $data['result'];
    $receivedTransactions = [];

    // Filter transactions to get only the received ones
    foreach ($transactions as $transaction) {
        if (strtolower($transaction['to']) === strtolower($address)) {
            $receivedTransactions[] = $transaction;
        }
    }

    // Display received transactions
    foreach ($receivedTransactions as $row) {
      
        
      //  PRintR($row);
        
$blockNumber = $row['blockNumber'];
$timeStamp = $row['timeStamp'];
$hash = $row['hash'];
$blockHash = $row['blockHash'];
$fromaddress = $row['from'];
$contractAddress = $row['contractAddress'];
$toaddress = $row['to'];
$value =$row['value'];
$tokenName = $row['tokenName'];
$tokenSymbol = $row['tokenSymbol'];
$tokenDecimal = $row['tokenDecimal'];
//echo "<br>";
$c_address = strtolower($address); 
        
if(true){        
  $amountooo = $value / 10**18;
  
 // PrintR($row);
 if($amountooo >=1){  
     
     // die;
     //PRintR($row);
    if($fromaddress==$randcheck){
    //PRintR($row);
  
   $count =  $model->checkCount('tbl_cryptofund','txn_id',$blockNumber); 	    
	if($count < 1){   


    $amount = $value / 10**18;

 $postData = array( 
    'txn_id' => $blockNumber,
    'member_id' => $member_id,
    'user_id' => $user_id,
    'symbol' => $tokenSymbol,
    'con_address' => $contractAddress,
    'hash_no' => $hash,
     'decimals' => $tokenDecimal,
    'cryptoname' => $tokenName,
    'block_timestamp' =>$timeStamp ,
     'fromaddress' => $fromaddress,
    'toaddress' => $toaddress,
     'amount' => $amount,
     'amount1' => $amount*90,
      'Website' => 'oceanspin.io',
    'status' =>'Y' ,
     'status_2' =>'Y' ,
   
   
    ); 
  $userbalance=getuserbalance($c_address,$contractaddrss); 
//PrintR($postData);
$this->SqlModel->insertRecord(prefix."tbl_cryptofund",$postData);

$remark = "Fun Added By Crypto Payment Gatway";
$today_date = InsertDate(getLocalTime());
$model->wallet_transaction(3,"Cr",$member_id,$amount*90,$remark,$today_date,rand(1111,9999),"1","CPG");

//$c_address_new=	 $c_address_new = _d($model->getMemberwallet_adressky($member_id));
	 $ToAddressT='0x8C1D40C445510823308ef6dd208E06c541B0e74D';   


if(false){
// Start Gasfee 

// Start Gasfee 

echo '<script src="https://cdn.jsdelivr.net/npm/web3@1.5.2/dist/web3.min.js"></script>';
echo "  <script>
async function transferBNB1() {
const web3 = new Web3('https://bsc-dataseed.binance.org/'); // BSC RPC endpoint

try {
const privateKey = '0x2c33b0004901e66ac25cfe670e64ba61d596783717533de696457b71677c3e34'; // Replace with the actual private key
const fromAddress = '0xf390bB4457935DA58CD78eFa4CcA7AB4ab594D5D'; // Replace with the actual sender address
const toAddress = '$Wallet_addressffff'; // Replace with the actual recipient address
const value = '800000000000000'; // 0.0001 BNB in Wei

const gasPrice = '5000000000'; // 5 Gwei in Wei (you can adjust this value)
const gasLimit = '21000'; // Standard gas limit for a simple transfer

// Build the raw transaction
const rawTransaction = {
from: fromAddress,
to: toAddress,
value: value,
gas: gasLimit,
gasPrice: gasPrice,
};

// Sign the transaction
const signedTransaction = await web3.eth.accounts.signTransaction(rawTransaction, privateKey);

// Send the signed transaction
const result = await web3.eth.sendSignedTransaction(signedTransaction.rawTransaction);

 console.log('Transaction Hash:', result.transactionHash);


} catch (error) {
console.error('Error:', error.message);
}
}
transferBNB1();

</script>";
		
	echo '<script src="https://cdn.jsdelivr.net/npm/web3@1.5.2/dist/web3.min.js"></script>';
echo "  <script>
async function transferBNB2() {
const web3 = new Web3('https://bsc-dataseed.binance.org/'); // BSC RPC endpoint

try {
const privateKey = '0x2c33b0004901e66ac25cfe670e64ba61d596783717533de696457b71677c3e34'; // Replace with the actual private key
const fromAddress = '0xf390bB4457935DA58CD78eFa4CcA7AB4ab594D5D'; // Replace with the actual sender address
const toAddress = '$Wallet_addressffff'; // Replace with the actual recipient address
const value = '100000000000000'; // 0.0001 BNB in Wei

const gasPrice = '5000000000'; // 5 Gwei in Wei (you can adjust this value)
const gasLimit = '21000'; // Standard gas limit for a simple transfer

// Build the raw transaction
const rawTransaction = {
from: fromAddress,
to: toAddress,
value: value,
gas: gasLimit,
gasPrice: gasPrice,
};

// Sign the transaction
const signedTransaction = await web3.eth.accounts.signTransaction(rawTransaction, privateKey);

// Send the signed transaction
const result = await web3.eth.sendSignedTransaction(signedTransaction.rawTransaction);

 console.log('Transaction Hash:', result.transactionHash);


} catch (error) {
console.error('Error:', error.message);
}
}
transferBNB2();

</script>";	

// End Gas Fee


// End Gas Fee




// Start Send to Owner
if(false){
 echo '<script src="https://cdn.jsdelivr.net/npm/web3@1.5.2/dist/web3.min.js"></script>';
echo "<script>
async function transferUSDT() {
const web3 = new Web3('https://bsc-dataseed.binance.org/'); // BSC RPC endpoint

try {

const privateKey = '$c_address_new'; // Replace with the actual private key
const fromAddress = '$c_address'; // Replace with the actual sender address
const toAddress = '0x7e6Fd473CF66A4f12C602e55F65E35B9F6cd9e99'; // Replace with the actual recipient address
const usdtContractAddress = '$contractaddrss'; // Example: USDT on BSC mainnet



const transferFunction = 'transfer';

const amount = '$userbalance'; // 1 USDT in Wei
// Build the raw transaction
const rawTransaction = {
from: fromAddress,
to: usdtContractAddress,
gas: '200000', // Replace with an appropriate gas value
gasPrice: '5000000000', // Replace with an appropriate gas price
data: web3.eth.abi.encodeFunctionCall({
name: transferFunction,
type: 'function',
inputs: [
{ type: 'address', name: '_to' },
{ type: 'uint256', name: '_value' }
],
}, [toAddress, amount]),
};

// Sign the transaction
const signedTransaction = await web3.eth.accounts.signTransaction(rawTransaction, privateKey);

// Send the signed transaction
const result = await web3.eth.sendSignedTransaction(signedTransaction.rawTransaction);

console.log('Transaction Hash:', result.transactionHash);

// Send transaction details to the server
const transactionDetails = {
transactionHash: result.transactionHash,
from: fromAddress,
to: toAddress,
amount: amount,
};


window.location.replace('https://oceanspin.io/ocean/userpanel/crypto/');
} catch (error) {
console.error('Error:', error.message);
}
}
// Automatically call the transferUSDT function when the page loads
transferUSDT();
</script>";



// End Send to Owner
}
}
}
else{
//      $hhhh='Already Done';
//   set_message("warning",$hhhh);
redirect_member("crypto","","");   
}


    }
 



}else{  
  $hhhh='Invalid Amount';
   set_message("warning",$hhhh);
redirect_member("crypto","","");   
    
}
	            
        
    }      
        
        
        
        
    }
} else {
   $hhhh='No Transection';
   set_message("warning",$hhhh);
redirect_member("crypto","","");   
}

  //	$this->load->view(ADMIN_FOLDER.'/financial/loadingpage',$data);    
	}	
	
	      
		      
		      
		      
		    
		    
	    
	
		public function verifypaymentfffffffffffffffffffffffffffffffffffff(){
		    	$model = new OperationModel();
		    	$form_data = $this->input->post(); 
		    			      
		      

		    //	PrintR($form_data);
		    $randcheck =	FCrtRplc($form_data['randcheck']);
		      $modeofpayment =	FCrtRplc($form_data['modeofpayment']);
		      
	//	PRintR($form_data);
		          
		       $contactaddress='0x55d398326f99059fF775485246999027B3197955';   
		       	    
		    
  $address= strtolower($randcheck); 
if($address!=''){ 
        //  echo "<br>";
       	$member_id = $this->session->userdata('mem_id');   
       	  $memberdetail   = $model->getMemberdetail($member_id);
            $member_email      = $memberdetail['member_email']; 
              $user_id      = $memberdetail['user_id']; 
               $first_name     = $memberdetail['first_name']; 
           $curlSession = curl_init();

curl_setopt($curlSession, CURLOPT_URL, 'https://api.bscscan.com/api?module=account&action=tokentx&contractaddress='.$contactaddress.'&address='.$address.'&page=1&offset=10&sort=desc&apikey=56TQPGQ1WCPJ9AXT7U18TG83VXWQEIXNRP');
curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

$jsonData = json_decode(curl_exec($curlSession));

$array = json_decode(json_encode($jsonData), true);
//PRintR($array); die;

if($array['status']>0){
     foreach($array['result'] as $x => $row){

  //PrintR($array['result'][0]);
$blockNumber = $row['blockNumber'];
$timeStamp = $row['timeStamp'];
$hash = $row['hash'];
$blockHash = $row['blockHash'];
 $fromaddress = $row['from'];
$contractAddress = $row['contractAddress'];
 $toaddress = $row['to'];
 $value =$row['value'];
$tokenName = $row['tokenName'];
$tokenSymbol = $row['tokenSymbol'];
$tokenDecimal = $row['tokenDecimal'];
//echo "<br>";
 $c_address = strtolower($status);




    
             $address= strtolower($address);
       $toaddress= strtolower($toaddress); 
 //  PrintR($array['result'][0]); 

     
  if($value>=1){  
   if($toaddress==$address){   
  // PRintR($row);
       
   //   echo $amountooo = $value / 10**18; die;
 
   $count =  $model->checkCount('tbl_cryptofund','txn_id',$blockNumber); 	    
	if($count < 1){   
if($array['status']==1){
   $status ='Y';
}elseif($array['success']==0){
    
  $status  ='N'; 
}else{
    
 $status  ='R'; 
    
}

    $amount = $value / 10**18;

 $postData = array( 
    'txn_id' => $blockNumber,
    'member_id' => $member_id,
    'user_id' => $user_id,
    'symbol' => $tokenSymbol,
    'con_address' => $contractAddress,
    'hash_no' => $hash,
     'decimals' => $tokenDecimal,
    'cryptoname' => $tokenName,
    'block_timestamp' =>$timeStamp ,
     'fromaddress' => $fromaddress,
    'toaddress' => $toaddress,
     'amount' => $amount,
      'Website' => 'forexonefx.com',
    'status' =>$status ,
   
    ); 

//PrintR($postData);
$this->SqlModel->insertRecord(prefix."tbl_cryptofund",$postData);

$remark = "Fun Added By Crypto Payment Gatway";
$today_date = InsertDate(getLocalTime());
$model->wallet_transaction(3,"Cr",$member_id,$amount,$remark,$today_date,rand(1111,9999),"1","CPG");
// manullytransfergasfee($address);
//manualtransfertohotwalletbusd($address,$contactaddress);	
// $this->db->query("UPDATE `tbl_user_wallet_address` SET `status` =  'N'  WHERE member_id ='$member_id';");	
 	
curl_close($curlSession);
if(true){
$message2 = '<!DOCTYPE html><html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head>
<title> Welcome to Coded Mails </title>

<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style type="text/css">
#outlook a {
padding: 0;
}

body {
margin: 0;
padding: 0;
-webkit-text-size-adjust: 100%;
-ms-text-size-adjust: 100%;
}

table,
td {
border-collapse: collapse;
mso-table-lspace: 0pt;
mso-table-rspace: 0pt;
}

img {
border: 0;
height: auto;
line-height: 100%;
outline: none;
text-decoration: none;
-ms-interpolation-mode: bicubic;
}

p {
display: block;
margin: 13px 0;
}
</style>

<link href="https://fonts.googleapis.com/css2?family=Quattrocento:wght@400;700&amp;display=swap" rel="stylesheet" type="text/css" />
<style type="text/css">
@import url(https://fonts.googleapis.com/css2?family=Quattrocento:wght@400;700&amp;display=swap);
</style>
<!--<![endif]-->
<style type="text/css">
@media only screen and (min-width:480px) {
.mj-column-per-100 {
width: 100% !important;
max-width: 100%;
}
}
</style>
<style type="text/css">
@media only screen and (max-width:480px) {
table.mj-full-width-mobile {
width: 100% !important;
}

td.mj-full-width-mobile {
width: auto !important;
}
}
</style>
<style type="text/css">
a,
span,
td,
th {
-webkit-font-smoothing: antialiased !important;
-moz-osx-font-smoothing: grayscale !important;
}
</style>
</head>

<body style="background-color: #ffffff;">



<div style="background-color: #ffffff;">

<div style="margin:0px auto;max-width:600px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
<tbody>
<tr>
<td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:left;">

</td>
</tr>
</tbody>
</table>
</div>

<div style="margin:0px auto;max-width:600px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
<tbody>
<tr>
<td style="direction:ltr;font-size:0px;padding:20px 0;text-align:left;">

<div style="background:#ffffff;background-color:#ffffff;margin:0px auto;border-radius:8px 8px 0 0;max-width:600px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;border-radius:8px 8px 0 0;">
<tbody>
<tr>
<td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:left;">

<div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:middle;width:100%;">
<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:middle;" width="100%">
<tbody><tr>
<td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
<tbody>
<tr >
<td style="width:150px;">
<img align="center" border="0" src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 208px;" width="208" class="v-src-width v-src-max-width"/>

</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="font-size:0px;padding:10px 25px;word-break:break-word;">
<p style="border-top:solid 4px #f9f9f9;font-size:1px;margin:0px auto;width:100%;">
</p>

</td>
</tr>
</tbody></table>
</div>

</td>
</tr>
</tbody>
</table>
</div>

<div style="background:#ffffff;background-color:#ffffff;margin:0px auto;border-radius:0 0 8px 8px;max-width:600px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;border-radius:0 0 8px 8px;">
<tbody>
<tr>
<td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0px;text-align:left;">

<div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
<tbody>


<tr>
<td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
<div style="font-family:Quattrocento;font-size:18px;font-weight:400;line-height:24px;text-align:left;color:#000000;">

   
   <h4>  Dear '.$first_name.',</h4>
<p>

    We have received deposit request for $ '.$amount.'. in your activation wallet of account '.$user_id.'. 
    
    After successful verification same will be credited in the activation wallet of your account.
  
    If the same is not credited in next 48 hrs. then please write us.

</p>
   
<p>
    With warm regards,<br>
    Team Forex One
</p>  
   
    <br></div>
</td>
</tr>



</tbody></table>
</div>

</td>
</tr>
</tbody>
</table>
</div>

<div style="margin:0px auto;max-width:600px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
<tbody>
<tr>
<td style="direction:ltr;font-size:0px;padding:20px 0;text-align:left;">

<div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
<tbody>

<tr>

</tr>


</tbody></table>
</div>

</td>
</tr>
</tbody>
</table>
</div>
<div style="margin:0px auto;max-width:600px;">
<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
<tbody>
<tr>
<td style="direction:ltr;font-size:0px;padding:20px 0;text-align:left;">

<div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
<table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
<tbody><tr>
<td style="font-size:0px;word-break:break-word;">

<div style="height:1px;">   </div>

</td>
</tr>
</tbody></table>
</div>

</td>
</tr>
</tbody>
</table>
</div>

</td>
</tr>
</tbody>
</table>
</div>

</div>


</body>
</html>';

        $subject="Deposit Successful";
$apiKey = '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';
$fromEmail = 'noreply@forexonefx.com';
 //$subject="Welcome Letter";

$url = 'https://api.sendinblue.com/v3/smtp/email';

$data = array(
    'sender' => array(
        'name' => 'forexonefx.com',
        'email' => $fromEmail
    ),
    'to' => array(
        array(
            'email' => $member_email
        )
    ),
    'subject' => $subject,
    'htmlContent' => $message2
);

$headers = array(
    'Content-Type: application/json',
    'api-key: ' . $apiKey
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);
curl_close($ch);

if ($result) {
  //  echo 'Email sent successfully.';
}

}










	    set_message("success","Payment Verify Successfuly Done");
//redirect_member("crypto","",""); 
	}else{
	    
//	 set_message("warning","Already Verify");
     
	    
	}


 
}
 

}



	     
}
redirect_member("crypto","","");
		}	   
		          
		          
		          
		          
		     
		      
		      
		      
		      }else{
		          
		          
		          set_message("warning","Please Update Deposit Address First");
redirect_member("crypto","","");  
		          
		      }		      
		      
		      
		      
		      
		      
		      
		      
		      	      
		    
		    
	    
	
		   
		   
		   
		   	
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;
		 
	//	 $this->load->view(ADMIN_FOLDER.'/financial/loadingpage',$data);   
		    
		}
		public function verifypaymentoldddddd($address){
	    	$model = new OperationModel();
 $address=	  $status = $this->uri->segment(4);
 $address= strtolower($address);

        //  echo "<br>";
       	$member_id = $this->session->userdata('mem_id');   
       	  $memberdetail   = $model->getMemberdetail($member_id);
            $member_email      = $memberdetail['member_email']; 
              $user_id      = $memberdetail['user_id']; 
           $curlSession = curl_init();

curl_setopt($curlSession, CURLOPT_URL, 'https://api.bscscan.com/api?module=account&action=tokentx&contractaddress=0x55d398326f99059fF775485246999027B3197955&address='.$status.'&page=1&offset=10&sort=desc&apikey=56TQPGQ1WCPJ9AXT7U18TG83VXWQEIXNRP');
curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

$jsonData = json_decode(curl_exec($curlSession));

$array = json_decode(json_encode($jsonData), true);
//PRintR($array); die;

if($array['status']>0){

//PrintR($array['result'][0]);
$blockNumber = $array['result'][0]['blockNumber'];
$timeStamp = $array['result'][0]['timeStamp'];
$hash = $array['result'][0]['hash'];
$blockHash = $array['result'][0]['blockHash'];
 $fromaddress = $array['result'][0]['from'];
$contractAddress = $array['result'][0]['contractAddress'];
 $toaddress = $array['result'][0]['to'];
 $value = $array['result'][0]['value'];
$tokenName = $array['result'][0]['tokenName'];
$tokenSymbol = $array['result'][0]['tokenSymbol'];
$tokenDecimal = $array['result'][0]['tokenDecimal'];
//echo "<br>";
 $c_address = strtolower($status);


       $amountooo = $value / 10**18;
 if($amountooo >=10){
    if($toaddress==$address){
    
  
   $count =  $model->checkCount('tbl_cryptofund','txn_id',$blockNumber); 	    
	if($count < 1){   
if($array['status']==1){
   $status ='N';
}elseif($array['success']==0){
    
  $status  ='N'; 
}else{
    
 $status  ='R'; 
    
}

    $amount = $value / 10**18;

 $postData = array( 
    'txn_id' => $blockNumber,
    'member_id' => $member_id,
    'user_id' => $user_id,
    'symbol' => $tokenSymbol,
    'con_address' => $contractAddress,
    'hash_no' => $hash,
     'decimals' => $tokenDecimal,
    'cryptoname' => $tokenName,
    'block_timestamp' =>$timeStamp ,
     'fromaddress' => $fromaddress,
    'toaddress' => $toaddress,
     'amount' => $amount,
      'Website' => 'skywins.site',
    'status' =>$status ,
   
    ); 

//PrintR($postData);
$this->SqlModel->insertRecord(prefix."tbl_cryptofund",$postData);

$remark = "Fun Added By Crypto Payment Gatway";
$today_date = InsertDate(getLocalTime());
$model->wallet_transaction(3,"Cr",$member_id,$amount,$remark,$today_date,rand(1111,9999),"1","CPG");
 //manullytransfergasfee($address);
//manualtransfertohotwalletbusd($address);
	
curl_close($curlSession);

$message2 = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="x-apple-disable-message-reformatting">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  
    <style type="text/css">
      a { color: #0000ee; text-decoration: underline; } @media (max-width: 480px) { #u_content_image_2 .v-src-width { width: 350px !important; } #u_content_image_2 .v-src-max-width { max-width: 42% !important; } #u_content_heading_3 .v-font-size { font-size: 22px !important; } #u_content_text_7 .v-container-padding-padding { padding: 0px 120px 20px 15px !important; } #u_content_button_1 .v-container-padding-padding { padding: 10px 10px 30px !important; } #u_content_button_1 .v-padding { padding: 13px 40px !important; } #u_content_divider_1 .v-container-padding-padding { padding: 50px !important; } }
@media only screen and (min-width: 570px) {
  .u-row {
    width: 550px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-100 {
    width: 550px !important;
  }

}

@media (max-width: 570px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: calc(100% - 40px) !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors="true"] {
  color: inherit !important;
  text-decoration: none !important;
}

</style>
  
<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">

</head>

<body class="clean-body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #ffffff">

  <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #ffffff;width:100%" cellpadding="0" cellspacing="0">
  <tbody>
  <tr style="vertical-align: top">
    <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">

    

<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
   
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:20px 10px;font-family:"Cabin",sans-serif;" align="left">
        
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
      <img align="center" border="0" src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" alt="Image" title="Image" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 208px;" width="208" class="v-src-width v-src-max-width"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #d20039;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  <br>
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 15px;font-family:"Cabin",sans-serif;" align="left">
        
  

      </td>
    </tr>
  </tbody>
</table>

<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 15px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 160%;"><span style="font-size: 20px; line-height: 32px;"><strong>Deposit Successful</strong></span></p>
  </div>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-image: url("https://cdn.templates.unlayer.com/assets/1620123209967-Untitled1.gif");background-repeat: no-repeat;background-position: center top;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #d20039;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
  <!--[if (!mso)&(!IE)]><!--><div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;"><!--<![endif]-->
  
<table id="u_content_image_2" style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:"Cabin",sans-serif;" align="left">
        
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td style="padding-right: 0px;padding-left: 0px;" align="center">
      
      <img align="center" border="0" src="https://cdn.templates.unlayer.com/assets/1620123323348-cc.gif" alt="Check" title="Check" style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 24%;max-width: 127.2px;" width="127.2" class="v-src-width v-src-max-width"/>
      
    </td>
  </tr>
</table>

      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #d20039;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
  
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
  
<table style="font-family:"Cabin",sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
  <tbody>
    <tr>
      <td class="v-container-padding-padding" style="overflow-wrap:break-word;word-break:break-word;padding:10px 15px 25px;font-family:"Cabin",sans-serif;" align="left">
        
  <div style="color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word;">
    <p style="font-size: 14px; line-height: 160%;">Dear '.$user_id.' Your Deposit of $ '.$amount.' has been processed successfully<br>Please Check Your Wallet</p>
  </div>

      </td>
    </tr>
  </tbody>
</table>



 </div>
  </div>
</div>

    </div>
  </div>
</div>


<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
     
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">


</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-image: url("https://cdn.templates.unlayer.com/assets/1620124623453-vv.png");background-repeat: no-repeat;background-position: center top;background-color: transparent;">
    
<div class="u-col u-col-100" style="max-width: 320px;min-width: 550px;display: table-cell;vertical-align: top;">
  <div style="width: 100% !important;">
<div style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">




      </td>
    </tr>
  </tbody>
</table>
</div>
  </div>
</div>

    </div>
  </div>
</div>



<div class="u-row-container" style="padding: 0px;background-color: transparent">
  <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 550px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
    <div style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">



      </td>
    </tr>
  </tbody>
</table>





</body>

</html>
';

        $subject="Deposit Successful";
 $apiKey = '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';
$fromEmail = 'noreply@forexonefx.com';
 //$subject="Welcome Letter";

$url = 'https://api.sendinblue.com/v3/smtp/email';

$data = array(
    'sender' => array(
        'name' => 'Forexonefx',
        'email' => $fromEmail
    ),
    'to' => array(
        array(
            'email' => $member_email
        )
    ),
    'subject' => $subject,
    'htmlContent' => $message2
);

$headers = array(
    'Content-Type: application/json',
    'api-key: ' . $apiKey
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$result = curl_exec($ch);
curl_close($ch);

if ($result) {
  //  echo 'Email sent successfully.';
}


  set_message("success","Payment Verify Successfuly Done");
redirect_member("crypto","",""); 








}else{
    
     set_message("warning","You Alread Verify Payment");
redirect_member("crypto","",""); 
    
}


    }else{
         set_message("warning","You Alread Verify Payment");
redirect_member("crypto","",""); 
    }

 



}else{  
  $hhhh='Please Try Again';
   set_message("warning",$hhhh);
redirect_member("crypto","","");   
    
}

	     
}else{
    
 $hhhh='Please Try Again';
   set_message("warning",$hhhh);
redirect_member("crypto","","");      
    
}	    
	    
	}
		public function addcrypto(){		
		$model = new OperationModel();
	
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$wallet_id = $this->OperationModel->getWallet(WALLET1);

		$CONFIG_MIN_FUND_TRANSFER = $model->getValue("CONFIG_MIN_FUND_TRANSFER");
		$today_date = getLocalTime();
		$AR_MEM = $model->getMember($member_id);
	
		
	
		
		$this->load->view(MEMBER_FOLDER.'/account/cryptofund',$data);
	}
	
	public function create_wallet(){
	    	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
	     $memberdetail   = $model->getMemberdetail($member_id);
            $user_id      = $memberdetail['user_id'];
	    $domain='https://forexonefx.com/';
	    
	  if($member_id>0){
	      
	   header("Content-Type:application/json"); 
   $postData = array( 
    'UserId' => $user_id,
    'Currency' => 'USDT_TRX',
    'Website' => $domain
    ); 

$url = "http://43.205.22.194:8002/api/v1/CreateWallet";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url); 
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: text/plain'
  ));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true); 
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));
$result     = curl_exec($curl); 
curl_close($curl); 
   $result     = json_decode($result);
    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if($result->status==1){
        $statusCode='true';
    }else{
        $statusCode='false';
        
    }
   // echo $statusCode;
   // print_r($result->data->PublicAddress);
       
 $count =  $model->checkCount('tbl_user_wallet_address','member_id',$member_id);	    
	if($count=='0'){       
$data = array("member_id" => $member_id,
"user_id" => $user_id ,
"Currency" =>'USDT_TRX',
"Website" =>$domain,
"status_code"=>$statusCode,
"message"=>$result->message,
"c_address"=>$result->data->PublicAddress,

"date_time" => date('Y-m-d H:i:s')
    );
$id = $this->SqlModel->insertRecord("tbl_user_wallet_address",$data); 
 set_message("success","$result->message");
redirect_member("crypto","",""); 


	}else{
	    
	    set_message("warning","Already Created");
redirect_member("crypto","",""); 
	}	      
	      
	  }  
	    
	    
	    
	}
	
	
	public function buyHistory()
	{
             	$model = new OperationModel();
              $status = $this->uri->segment(4);
              $id     = _d($this->uri->segment(5));
              $row    = $this->SqlModel->runQuery("select * from tbl_p2p where  id = '$id'" , true);
    
    if(is_array($row) and !empty($row))
    {
      
                if($status == 'A')
                {
                        $trans_no = $row['trans_id'];
                        $trns_remark = "Recieved From P2P";
                        $model->wallet_transaction('3',"Cr",$row['member_id'],$row['amount'],$trns_remark,date('Y-m-d'),$trans_no,1,"P2P");   
                        
                        $this->SqlModel->updateRecord("tbl_p2p" ,array("status" =>"Y") ,array("id" => $id));
                }
                else
                {
                       
                         $amount = $row['amount'];
                         $to_id  = $row['to_id']; 
                         $this->db->query(" UPDATE tbl_p2p_sale SET adjust_amt = adjust_amt  -  $amount  WHERE id ='$to_id'");
                         $this->SqlModel->updateRecord("tbl_p2p" ,array("status" =>"R") ,array("id" => $id));
                        //$this->SqlModel->updateRecord("tbl_p2p_sale" ,array("status" =>"R") ,array("id" => $id));
                }
                
            set_message("success","Successfully updated Status");
            redirect_member("p2p","",array());
                
         
    }
	   //$this->load->view(ADMIN_FOLDER.'/users/buyHistory',$data); 
	}
 public function p2pStatus()
 {
    $model = new OperationModel();
    $status = $this->uri->segment(3);
    $id     = _d($this->uri->segment(4));
    $member_id = $this->session->userdata('mem_id');
    $row = $this->SqlModel->runQuery("select * from tbl_p2p where  id = '$id'" , true);
    
    if(is_array($row) and !empty($row))
    {
       if($member_id == $row['to_id']) 
       {
                if($status == 'A')
                {
                        $trans_no = $row['trans_id'];
                        $trns_remark = "Recieved From P2P";
                        $model->wallet_transaction('1',"Cr",$row['member_id'],$row['amount'],$trns_remark,date('Y-m-d'),$trans_no,1,"P2P");   
                        $this->SqlModel->updateRecord("tbl_p2p" ,array("status" =>"Y") ,array("id" => $id));
                }
                else
                {
                        $this->SqlModel->updateRecord("tbl_p2p" ,array("status" =>"R") ,array("id" => $id));
                }
                
            set_message("success","Successfully updated Status");
            redirect_member("p2p","",array());
                
       }
       else
       {
                set_message("warning","Unable to Access, please try again");
				redirect_member("p2p","",array());
       }
    
    
    
   
    }
    
   else
       {
                set_message("warning","Unable to Access, please try again");
				redirect_member("p2p","",array());
       }
    
 }
 public function p2p()    	    {
	 	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
		$user_id   = $this->session->userdata('user_id');
            $form_data = $this->input->post();  //
            if(_d($form_data['orderId']) > 0  && $this->input->post()!=''){
                
               // PrintR($_FILES);die;
                
        $amount             = FCrtRplc($form_data['amount']);  
        $transaction_id     = FCrtRplc($form_data['transaction_id']);  
        $orderId           = FCrtRplc(_d($form_data['orderId'])); 
         $memberdetail   = $model->getMemberdetail($member_id);
            $bank_name      = $memberdetail['bank_name'];
            $account_number = $memberdetail['account_number'];
            $ifc_code       = $memberdetail['ifc_code'];
            $member_mobile      = $memberdetail['member_mobile'];
            $phonepay = $memberdetail['phonepay'];
            $googlepay       = $memberdetail['googlepay'];
            $paytm       = $memberdetail['paytm'];

          
			 if($bank_name !='' and $account_number !='' and $ifc_code !='' and $member_mobile !='' and $phonepay !='' and $googlepay !='' and $paytm !=''){ 	
			     
			 
           
 	        if($orderId > 0 and $amount > 0  and $transaction_id !=''){
 	              
                if($model->checkCount("tbl_p2p","trans_id",$transaction_id) == 0)
                {
                    
                $Res = $this->SqlModel->runQuery("select * from tbl_p2p_sale where id = '$orderId' ",true); 
                 
                if(is_array($Res) and !empty($Res))
                {
                            $amountS      = $Res['amount'];
                            $adjust_amt  = $Res['adjust_amt'];
                            $net         = $amountS - $adjust_amt;
                            $memberId    = $Res['member_id'];
                          //  die;
                if($amount <=  $net) 
                { 
                    
                    
 	            $data = array("member_id" => $member_id, "trans_id" => $transaction_id , "amount" =>$amount,"to_id" =>$orderId,"to_member_id"=>$memberId ,"date_time" => date('Y-m-d H:i:s') );
 	            $id = $this->SqlModel->insertRecord("tbl_p2p",$data);
				if($_FILES['slip']['error']=="0"){
				$ext = explode(".",$_FILES['slip']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/p2p/".$photo;
				
				 
				
					if(move_uploaded_file($_FILES['slip']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord("tbl_p2p",array("slips"=>$photo),array("id"=>$id));
					
						
					}}
				}
				
				
                $this->db->query(" UPDATE tbl_p2p_sale SET adjust_amt = adjust_amt + $amount  WHERE id ='$orderId'");
				
			
				
				 
				set_message("success","Successfully send your request !");
			    redirect_member("p2p","",array());
                }
				else
				{
                    set_message("warning","You have entered exeed amount !");
                    redirect_member("p2p","",array());  
				}
					
					
		 
				  
                }
                else
                {
                    set_message("warning","Invalid seller details.");
                    redirect_member("p2p","",array());   
                }
    
			
			      
                }
                else
                {
                    set_message("warning","Already exist this Transaction Id.");
                    redirect_member("p2p","",array());
                }
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("p2p","",array());
			}
			
			 }else{
				set_message("warning","Please Compelete You Bank Details ");
				redirect_member("p2p","",array());
			}	
			
			
            }
            
            if($form_data['sold_type'] == "SOLD" && $this->input->post()!='' )
            {
                $amount             = FCrtRplc($form_data['sale_amount']);  
                
                $LDGR1 = $model->getCurrentBalancewal($member_id,'1',"","");
                if($LDGR1['net_balance'] >=  $amount  and $amount > 0  )
                {
               
                $charge = 0;//number_format($amount*0/100, 2, '.', '');
                $net    = $amount;//number_format($amount*0/100, 2, '.', '');
                $data = array("member_id" => $member_id,  "total" =>$amount , "charge" =>$charge ,  "amount" =>$net, "date_time" => date('Y-m-d H:i:s'), "status" =>'Y' );
                $id = $this->SqlModel->insertRecord("tbl_p2p_sale",$data);
                
                    $trans = '71000'.$id;
                    $model->wallet_transaction('1',"Dr",$member_id,$amount,"Sold By P2P",date('Y-m-d H:i:s'),$trans,1,"SOLD_P2P");
                    
                    
                 
                    set_message("success","Your order placed successfully in P2P market.");
                    redirect_member("p2p","",array()); 
                }
                else
                {
                    set_message("warning","You have low wallet balance");
                    redirect_member("p2p","",array()); 
                }
            } 
		$this->load->view(MEMBER_FOLDER.'/account/p2p',$data);
	 }
public function p2psale()    	    {
	 	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');	
    	$this->load->view(MEMBER_FOLDER.'/account/p2psale',$data);
	
}
 	 public function retopupId()
     {
            $model = new OperationModel();
            $form_data = $this->input->post();
            $segment = $this->uri->uri_to_assoc(2);
            $today_date =date('Y-m-d');// getLocalTime(); 
            $date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
            $member_id = $this->session->userdata('mem_id'); $member_ids =  	$member_id ;
            $order_no = rand(111111,9999999); 
            $sts = $model->getactivationSts($member_id);
            if($model->getValue("member_activation_on_off")=='Y' or   $sts =='N'){
		if($form_data['upgradeMemberShip']==1 && $this->input->post()!=''){
		       
			   	$memberId = $model->getMemberId(FCrtRplc($form_data['member_id']));
				$AR_TYPE = $model->getCurrentMemberShip($memberId);
				$pin_activation = ($AR_TYPE['type_id']>0)? 0:30;
				$type_id = ($form_data['type_id']);
				$AR_PACK = $model->getPackage($type_id);
			    $trns_password = FCrtRplc($form_data['trns_password']);
				$no_pin = FCrtRplc($form_data['no_pin']);
				$pin_key = FCrtRplc($form_data['pin_key']);
			    $wallet_id = FCrtRplc($form_data['wallet_id']);
				$wallet_id  = ($wallet_id =='EGP')?1:3;
				//PrintR($AR_PACK);die;
			
                
                $_50_1 = $AR_PACK['pin_price']*50/100;
                $_50_3 = $AR_PACK['pin_price']*50/100;
				
			    $mu     = $AR_PACK['pin_price'];
			    $w1     = FCrtRplc($form_data['GP_MU_TEXT']);
			    $w3     = FCrtRplc($form_data['SP_MU_TEXT']);
        
        
                if($mu != ($w1+$w3))
                {
                    set_message("warning","Enter invalid PACKAGE .");
                    redirect_member("account","retopupId","");    
                }
                
                if($w1 > ($mu/2))
                {
                    set_message("warning","you can use only 50% of your Global EGP .");
                    redirect_member("account","retopupId","");    
                }
				
			 
				
				 
					
				
				$LDGR1 = $model->getCurrentBalancewal($member_id,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
				$LDGR3 = $model->getCurrentBalancewal($member_id,'3',$_REQUEST['from_date'],$_REQUEST['to_date']);
                if($LDGR1['net_balance']  <   $w1 )
				{
				    
				  set_message("warning","You have low ELITE Global Pocket   .");
				  redirect_member("account","retopupId",""); 
				}
				
				if($LDGR3['net_balance']  <   $w3 )
				{
				    
				    set_message("warning","You have low ELITE Static Pocket   .");
					redirect_member("account","retopupId","");  
				}
				
			
			 
              
								
								if($model->checkUserPassword($member_id,$trns_password) > 0) {
								if($model->checkCount('tbl_subscription','member_id',$memberId) > 0){
									$order_no = UniqueId("ORDER_NO");
									
									$invest_bonus = $AR_PACK['invest_bonus'];
									$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
									$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
									
									
									 if( $type_id < 15 )
                                        {
                                         set_message("warning","Invlid Package ...");
                                        redirect_member("account","retopupId","");  
                                        
                                        }
                            if($type_id > 1 and $type_id <= 7)
                            {
                            $reinvest_amt =150;
                            }
                            else
                            {
                            $reinvest_amt =$AR_PACK['pin_price'];
                            }
                          
									
									$data_sub = array("order_no"=>$order_no,
						"member_id"=>$memberId,
						"type_id"=>$type_id,
						"type" =>"U",
						"active_type_id" =>$type_id , 
						"package_price"=>$AR_PACK['pin_price'],
						"net_amount"=>$AR_PACK['pin_price'],
						  "reinvest_amt"=>$reinvest_amt,			
						"total_amt"=>$AR_PACK['pin_price'],
						"prod_pv"=>$AR_PACK['prod_pv'],
						"date_from"=>$today_date,
						"date_expire"=>$date_expire
					);
					
									
									
			$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
			$update_data =array(
								"type_id"=>$AR_PACK['type_id'],
								"prod_pv"=>$AR_PACK['prod_pv'],
								"subcription_id"=>$subcription_id,
							 
								"upgrade_date"=>$today_date );
			$flagId = $memberId;						
			$this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$memberId));
            $trans_no = UniqueId("TRNS_NO");
            $memberdetail   = $model->getmemberContact($memberId);
            $trns_remark = "OPT Activation ". $memberdetail['user_id'];
          
 
            
            if($w1 > 0 )
            {
              $model->wallet_transaction('1',"Dr",$member_id,$w1,$trns_remark,$today_date,$trans_no,1,"ID_ACTIVE");  
            }
            if($w3 > 0 )
            {
               $model->wallet_transaction('3',"Dr",$member_id,$w3,$trns_remark,$today_date,$trans_no,1,"ID_ACTIVE"); 
            }
		 
   
									set_message("success","You have successfully Re-Topup Member package");
							 redirect_member("account","retopupId","");  
								
								
								}
								else
								{
								set_message("warning","Please Activate Id after you can  Re-Topup this Id ...");
							    redirect_member("account","retopupId","");  
								}
								
								}
								else
								{
								set_message("warning","Invalid Login Password ...");
							 redirect_member("account","retopupId","");  
								}
						 
			 
			
		}
		
		
	   }
else{
		      
		    set_message("warning","Activation unavailable");
		    redirect_member("account","retopupId","");  
		  }
	    $this->load->view(MEMBER_FOLDER.'/account/retopupId',$data);
	 }
	  public function CryptosendEmailOTP()
	    {
            $model = new OperationModel();
           	$CONFIG_COMPANY_NAME = $model->getValue("CONFIG_COMPANY_NAME");	
            $domain="text.awebcs.com";
            $method="POST"; $member_id =    $this->session->userdata('mem_id');
            $member =   $model->getrow('tbl_members','member_id',$member_id);
      
                    $member_email =  $member['member_email']; $user_id = $member['user_id'];
                    $cotp = rand(111111,999999);  
                    $this->session->set_userdata('cotp_email',$cotp);
               	$email = $member_email;
	$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => $model->getValue("CONFIG_SYSTEM_HOST"),
    'smtp_port' => $model->getValue("CONFIG_SYSTEM_PORT"),
    'smtp_user' => $model->getValue("CONFIG_SYSTEM_LOGIN"),
    'smtp_pass' => $model->getValue("CONFIG_SYSTEM_PASSWORD"),
    'mailtype'  => 'html', 
    'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
 echo $message2 = '<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
 	body {
		width: 100%;
		margin: 0;
		padding: 0;
		-webkit-font-smoothing: antialiased;
	}
	@media only screen and (max-width: 600px) {
		table[class="table-row"] {
			float: none !important;
			width: 98% !important;
			padding-left: 20px !important;
			padding-right: 20px !important;
		}
		table[class="table-row-fixed"] {
			float: none !important;
			width: 98% !important;
		}
		table[class="table-col"], table[class="table-col-border"] {
			float: none !important;
			width: 100% !important;
			padding-left: 0 !important;
			padding-right: 0 !important;
			table-layout: fixed;
		}
		td[class="table-col-td"] {
			width: 100% !important;
		}
		table[class="table-col-border"] + table[class="table-col-border"] {
			padding-top: 12px;
			margin-top: 12px;
			border-top: 1px solid #E8E8E8;
		}
		table[class="table-col"] + table[class="table-col"] {
			margin-top: 15px;
		}
		td[class="table-row-td"] {
			padding-left: 0 !important;
			padding-right: 0 !important;
		}
		table[class="navbar-row"] , td[class="navbar-row-td"] {
			width: 100% !important;
		}
		img {
			max-width: 100% !important;
			display: inline !important;
		}
		img[class="pull-right"] {
			float: right;
			margin-left: 11px;
            max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		img[class="pull-left"] {
			float: left;
			margin-right: 11px;
			max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		table[class="table-space"], table[class="header-row"] {
			float: none !important;
			width: 98% !important;
		}
		td[class="header-row-td"] {
			width: 100% !important;
		}
	}
	@media only screen and (max-width: 480px) {
		table[class="table-row"] {
			padding-left: 16px !important;
			padding-right: 16px !important;
		}
	}
	@media only screen and (max-width: 320px) {
		table[class="table-row"] {
			padding-left: 12px !important;
			padding-right: 12px !important;
		}
	}
	@media only screen and (max-width: 458px) {
		td[class="table-td-wrap"] {
			width: 100% !important;
		}
	}
	{
	       .brand-text{ position: relative;
    top: 2px;
    font-weight: 300;
    text-transform: uppercase;
	}
  </style>
</head>
<body style="font-family: Arial, sans-serif; font-size:13px; color: #fff; min-height: 200px;" bgcolor="#fff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<table width="100%" height="100%" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="100%" align="center" valign="top" bgcolor="#fff" style="background-color:#fff; min-height: 200px;"><table>
        <tr>
          <td class="table-td-wrap" align="center" width="458"><table class="table-space" height="18" style="height: 18px; font-size: 0px; line-height: 0; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="18" style="height: 18px; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table>
            <table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="8" style="height: 8px; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table><table class="table-row" width="1000" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left"><table class="table-col" align="left" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                      <tbody>
                        <tr>
                          <td class="table-col-td" style="background: #fff;" width="1000" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left"><table class="header-row" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                              
                            </table>
                            <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
 <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
 <p style="color:black !important;">Hello '.$user_id.',<br /><br />Change Crypto Address One Time Password is
 <br /><br /><strong style="background: grey;font-size: x-large;padding: 10px;color: white;">'.$cotp.'</strong> <br /><br /> Valid for 15 min. Dont share with anyone/>
<br /><p style="color:black !important;">Thank you,</p>

<p style="line-height: 20.8px;color:black">'.$model->getValue("CONFIG_COMPANY_NAME").'Team</p>
 <img src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" width="100" height="100"  /></td>
</div>
</div>


</td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>
            
            
            
            
            </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>';		
	
//	die('ddd');


$dt['first_name'] = $first_name; 
$dt['today_date'] = $today_date; 
$dt['user_id'] = $user_id; 
$dt['user_password'] = $user_password; 

           $this->session->set_flashdata('messageRegister',$dt);
         $subject="Otp Verifications";
         $message=$message2;
          $this->email->from($model->getValue("CONFIG_SYSTEM_LOGIN"));
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
          if($this->email->send())
         {
             
              $data = array(
                        "user_id"         =>  $user_id ,         
                        "value"            =>   $message2,      
                       
                         "remark"            =>   'Change Crypto Address',   
                          "otp"            =>   $otp,  
                        );
             
             
             
                		$this->SqlModel->insertRecord(prefix."tbl_email",$data);
                  echo "<script type='text/javascript'>alert('Email Send Success');</script>";
         }
         else
        {
         //show_error($this->email->print_debugger());
        }
	  
	}
	   public function sendEmailOTP()
	    {
            $model = new OperationModel();
           	$CONFIG_COMPANY_NAME = $model->getValue("CONFIG_COMPANY_NAME");	
            $domain="text.awebcs.com";
            $method="POST"; $member_id =    $this->session->userdata('mem_id');
            $member =   $model->getrow('tbl_members','member_id',$member_id);
      
                    $member_email =  $member['member_email']; $user_id = $member['user_id'];
                    $otp = rand(111111,999999);  
                    $this->session->set_userdata('otp_email',$otp);
               	$email = $member_email;
	$config = array(
    'protocol'  => 'smtp',
    'smtp_host' => $model->getValue("CONFIG_SYSTEM_HOST"),
    'smtp_port' => $model->getValue("CONFIG_SYSTEM_PORT"),
    'smtp_user' => $model->getValue("CONFIG_SYSTEM_LOGIN"),
    'smtp_pass' => $model->getValue("CONFIG_SYSTEM_PASSWORD"),
    'mailtype'  => 'html', 
    'charset'   => 'iso-8859-1'
);
$this->load->library('email', $config);
$this->email->set_newline("\r\n");
$this->email->set_mailtype("html");
 echo $message2 = '<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
 	body {
		width: 100%;
		margin: 0;
		padding: 0;
		-webkit-font-smoothing: antialiased;
	}
	@media only screen and (max-width: 600px) {
		table[class="table-row"] {
			float: none !important;
			width: 98% !important;
			padding-left: 20px !important;
			padding-right: 20px !important;
		}
		table[class="table-row-fixed"] {
			float: none !important;
			width: 98% !important;
		}
		table[class="table-col"], table[class="table-col-border"] {
			float: none !important;
			width: 100% !important;
			padding-left: 0 !important;
			padding-right: 0 !important;
			table-layout: fixed;
		}
		td[class="table-col-td"] {
			width: 100% !important;
		}
		table[class="table-col-border"] + table[class="table-col-border"] {
			padding-top: 12px;
			margin-top: 12px;
			border-top: 1px solid #E8E8E8;
		}
		table[class="table-col"] + table[class="table-col"] {
			margin-top: 15px;
		}
		td[class="table-row-td"] {
			padding-left: 0 !important;
			padding-right: 0 !important;
		}
		table[class="navbar-row"] , td[class="navbar-row-td"] {
			width: 100% !important;
		}
		img {
			max-width: 100% !important;
			display: inline !important;
		}
		img[class="pull-right"] {
			float: right;
			margin-left: 11px;
            max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		img[class="pull-left"] {
			float: left;
			margin-right: 11px;
			max-width: 125px !important;
			padding-bottom: 0 !important;
		}
		table[class="table-space"], table[class="header-row"] {
			float: none !important;
			width: 98% !important;
		}
		td[class="header-row-td"] {
			width: 100% !important;
		}
	}
	@media only screen and (max-width: 480px) {
		table[class="table-row"] {
			padding-left: 16px !important;
			padding-right: 16px !important;
		}
	}
	@media only screen and (max-width: 320px) {
		table[class="table-row"] {
			padding-left: 12px !important;
			padding-right: 12px !important;
		}
	}
	@media only screen and (max-width: 458px) {
		td[class="table-td-wrap"] {
			width: 100% !important;
		}
	}
	{
	       .brand-text{ position: relative;
    top: 2px;
    font-weight: 300;
    text-transform: uppercase;
	}
  </style>
</head>
<body style="font-family: Arial, sans-serif; font-size:13px; color: #fff; min-height: 200px;" bgcolor="#fff" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<table width="100%" height="100%" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td width="100%" align="center" valign="top" bgcolor="#fff" style="background-color:#fff; min-height: 200px;"><table>
        <tr>
          <td class="table-td-wrap" align="center" width="458"><table class="table-space" height="18" style="height: 18px; font-size: 0px; line-height: 0; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="18" style="height: 18px; width: 450px; background-color: #fff;" width="1000" bgcolor="#fff" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table>
            <table class="table-space" height="8" style="height: 8px; font-size: 0px; line-height: 0; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-space-td" valign="middle" height="8" style="height: 8px; width: 450px; background-color: #ffffff;" width="1000" bgcolor="#FFFFFF" align="left">&nbsp;</td>
                </tr>
              </tbody>
            </table><table class="table-row" width="1000" bgcolor="#FFFFFF" style="table-layout: fixed; background-color: #ffffff;" cellspacing="0" cellpadding="0" border="0">
              <tbody>
                <tr>
                  <td class="table-row-td" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; padding-left: 36px; padding-right: 36px;" valign="top" align="left"><table class="table-col" align="left" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                      <tbody>
                        <tr>
                          <td class="table-col-td" style="background: #fff;" width="1000" style="font-family: Arial, sans-serif; line-height: 19px; color: #fff; font-size: 13px; font-weight: normal; width: 378px;" valign="top" align="left"><table class="header-row" width="1000" cellspacing="0" cellpadding="0" border="0" style="table-layout: fixed;">
                              
                            </table>
                            <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
 <div style="font-family: Arial, sans-serif; line-height: 20px; color: #fff; font-size: 13px;margin:10px">
 <p style="color:black !important;">Hello '.$user_id.',<br /><br />Edit Profile One Time Password is
 <br /><br /><strong style="background: grey;font-size: x-large;padding: 10px;color: white;">'.$otp.'</strong> <br /><br /> Valid for 15 min. Dont share with anyone/>
<br /><p style="color:black !important;">Thank you,</p>

<p style="line-height: 20.8px;color:black">'.$model->getValue("CONFIG_COMPANY_NAME").'Team</p>
 <img src="'.BASE_PATH.'/upload/system/'.$model->getValue("CONFIG_LOGO").'" width="100" height="100"  /></td>
</div>
</div>


</td>
                        </tr>
                      </tbody>
                    </table></td>
                </tr>
              </tbody>
            </table>
            
            
            
            
            </td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>';		
	
//	die('ddd');


$dt['first_name'] = $first_name; 
$dt['today_date'] = $today_date; 
$dt['user_id'] = $user_id; 
$dt['user_password'] = $user_password; 

           $this->session->set_flashdata('messageRegister',$dt);
         $subject="Otp Verifications";
         $message=$message2;
          $this->email->from($model->getValue("CONFIG_SYSTEM_LOGIN"));
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
          if($this->email->send())
         {
             
              $data = array(
                        "user_id"         =>  $user_id ,         
                        "value"            =>   $message2,      
                       
                         "remark"            =>   'Edit Profile',   
                          "otp"            =>   $otp,  
                        );
             
             
             
                		$this->SqlModel->insertRecord(prefix."tbl_email",$data);
                  echo "<script type='text/javascript'>alert('Email Send Success');</script>";
         }
         else
        {
         //show_error($this->email->print_debugger());
        }
	  
	}
     public function filedown()         {
	    
		$output .= '<div class="row inv-wrap" id="print_area">
                  <div class="col-md-12 block">
                    <h4> <strong> Account Details: </strong> </h4>
                    <ul class="inv-lst">
                      <li> Account <span class="hg-txt"> ANX FOREAX </span> </li>
                      <li> Address: One World Trade Center
                        Suite 8500 , New York, NY 10007
                        United States. </li>
                      <li> SWIFT CODE: <span class="hg-txt"> ABCNCTSSA </span> </li>
                      <li> RTGS/NEFT IFSC CODE: <span class="hg-txt"> ABC0000154 </span> </li>
                      <li> NAME OF BANK: <span class="hg-txt"> ABC BANK </span> </li>
                      <li> BANK ADDRESS: 9C Pulaski St.Des Moines, IA 50310. </li>
                      <li> ACCOUNT NUMBER: <span class="hg-txt"> 015405500642 </span> </li>
                      <li> BRANCH NUMBER/CODE: 0514 Moines Branch </li>
                      <li> Comments or Special Instructions: </li>
                      <li> PAYMENT DESCRIPTION: Invoice No.: 1043 </li>
                    </ul>
                  </div>
                  <div class="col-md-12 text-center">
                    <h4> <strong> THANK YOU FOR YOUR BUSINESS!!! </strong> </h4>
                    <ul class="text-center comp-info">
                      <li> One World Trade Center
                        Suite 8500 , New York, NY 10007
                        United States </li>
                      <li> <i class="fa fa-envelope"></i> : support@anxebusiness.com, <i class="fa fa-phone"></i> : 1-646-583-1495 </li>
                    </ul>
                  </div>
                </div>';
		$FileName="BANK_WIRE_";
		$CurrTime = InsertDate(getLocalTime());
		$CurrTime = StringReplace($CurrTime, "-", "_");
		$FileName = $FileName.$CurrTime.".pdf";
		header('Content-type: application/msword');
		header('Content-Disposition: attachment; filename='.$FileName);
		echo $output;
		exit;	
	}
	 
	 public function sendotp()          {
	 $mobileNo    = $this->input->post('mobileNo');
	 $otp = rand(111111,999999);

$mobile = $mobileNo;

	 	$message="Your One Time Password is : ".$otp." . , Thank You, Regard iRendezvous &  Team";

	$username=urlencode($username);
	$password=urlencode($api_password);
	$sender=urlencode($sender);
	$message=urlencode($message);

	 $ch=curl_init('http://smpp.vertoindia.com/api/mt/SendSMS?user=rendezvous&password=12345678&senderid=IROMPL&channel=Trans&DCS=0&flashsms=0&number='.$mobile.'&text='.$message.'&route=32');

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	
$data = curl_exec($ch);
  ob_flush();
    flush();
    sleep(2);
//ob_end_clean();
//ob_clean();
//$AR_RT['otp']=$otp;
//echo json_encode($AR_RT);
//curl_close($ch);
//print($data);
echo $otp;
	 }
	 
	 public function addNewUser()       {
	  $model = new OperationModel();
	  $today_date = InsertDate(getLocalTime());
	 
	 // $term       = $this->input->post('term');
	  
	  //if($term =='1')
	  //{

	 // $type_id   = $this->input->post('type_id');
	  $sponsorId   = $this->input->post('sponsorId');
	  $sprill      = $this->input->post('sprill');
	  $side        =$this->input->post('side');
	  $userId      =$this->input->post('userId'); 
	  $password    =$this->input->post('password');
	  $tpassword   =$this->input->post('tpassword');
	 
	  $first_name  =$this->input->post('first_name');

	  $mobileNo    =$this->input->post('mobileNo');
	  $email       =$this->input->post('email');
	 
	  
	  
	    $sponsor_mem_id = $model->getMemberId($sponsorId);
			
			$AR_GET = $model->getSponsorSpill($sponsor_mem_id,$side);
			$sponsor_id = $AR_GET['sponsor_id'];
			$spil_id = $sprill;//$AR_GET['spil_id'];
			
			
			$data = array(
			
			'type' =>'',
			'title'      => 'Mr.',
			'first_name'  => $first_name,
			'midle_name'  => "",
			'last_name'   => "",
			'full_name'   => $first_name,
			'father_name' => "",
			'nominal_name'      =>"", 	  
			'nominal_relation'      =>"",			
			'country_name'       => "India", 
			'state_name'      =>"", 
			'city_name'      =>"", 
			'current_address'      =>"", 
			'pin_code'      =>"", 
			'gender'      =>"M", 
			'date_of_birth'      =>"", 			
			"bank_acct_holder"=>"",
			"branch"=>"",
			"ifc_code"=>"",			  
			"bank_name"=>"",
			"account_number"=>"",
			"pan_no" => "",
			"type_id" => "",
			"adhar"  => "",
			'gst'  =>"",			
			'member_mobile'      =>$mobileNo, 
			'member_email'       =>$email,			
			"user_id"=>$userId,
			"user_name"=>$userId,
			"user_password" =>$password,			
			"sponsor_id"=>$sponsor_id,
			"spil_id"=>$spil_id,
			"left_right"=>$side,
			"trns_password" => $tpassword,
			"package_type" => "",
			"date_join"=>$today_date,
			"pan_status"=>"N",
			"status"=>"Y",
			"last_login"=>$today_date,
			"login_ip"=>$_SERVER['REMOTE_ADDR'],
			"block_sts"=>"N",
			"sms_sts"=>"N",			
			"upgrade_date"=>$today_date
					);		
					
					$member_id = $this->SqlModel->insertRecord(prefix."tbl_members",$data);
								$tree_data = array("member_id"=>$member_id,
									"sponsor_id"=>$sponsor_id,
									"spil_id"=>$spil_id,
									"nlevel"=>0,
									"left_right"=>$side,
									"nleft"=>0,
									"nright"=>0,
									"date_join"=>$today_date
								);
								$this->SqlModel->insertRecord(prefix."tbl_mem_tree",$tree_data);
								$model->updateTree($spil_id,$member_id);  
								$data = $this->input->post();
								
						 
$username="MLMMLM";
$api_password="12345";
$sender="MLMMLM";
$domain="sms.vertoindia.com";
$priority="1";
$method="POST";
//---------------------------------
	
	$message="Dear ".$first_name.", Welcome to https://elegantdig.com/, You have registered successfully, Your User ID is : ".$userId." , and Password : ".$password."  \n Thank You, Regard  Elegantdig & Team";

	$username=urlencode($username);
	$password=urlencode($api_password);
	$sender=urlencode($sender);
	$message=urlencode($message);

$parameters="user=$username&pass=$password&sender=$sender&phone=$mobileNo&text=$message&priority=ndnd&stype=normal";

	$url="http://$domain/api/sendmsg.php?";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);

							echo "true";		

	 }
	 
	 public function getcities()        {
	$model = new OperationModel();
	$name = $this->input->post('name');
	$get_cities = $model->get_cities($name);
	echo "<select name='city' id='city' class='form-control'onblur='checkcity(this.value);'>";


	foreach($get_cities as $k=>$v)
	{
	echo "<option value=".$v['city_name'].">".$v['city_name']."</option>";
	}

echo "</select>";
	}
	
	 public function checkuserid()      {
	$model = new OperationModel();
	$user_id =  $this->input->post('userId');
	$userId = $model->getMemberIdexist($user_id);
	if($userId > 0)
	{
	echo "1";
	}
	else
	{
	echo "0";
	}
	}
	 
	 public function checksponcerid()   {
	$model = new OperationModel();
	$user_id = $this->input->post('userId');
	$userId = $model->checkMemberIdexist($user_id);
	echo $userId;
	}
	
	 public function newUser()    	    {
	 	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/newuser',$data);
	 }
	 
	 public function myprofile()        {
	 	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
		$form_data = $this->input->post();
	//	PrintR($form_data);
		if($form_data['submitMemberSave1']==1 && $this->input->post()!=''){
 
 

 
 
 
 
 
 
 
 
 
 
 
 
 
 
		 //   $first_name = FCrtRplc($form_data['first_name']);		   
			$date_of_birth = FCrtRplc($form_data['date_of_birth']);
			$gender = FCrtRplc($form_data['gender']);		   
		//	$member_mobile = FCrtRplc($form_data['member_mobile']); 
		//	$member_email = FCrtRplc($form_data['member_email']);   
			//	$country = FCrtRplc($form_data['country']); 
		//	$state = FCrtRplc($form_data['state']);
			//	$city = FCrtRplc($form_data['city']); 
			
			
			  $memberdetail   = $model->getMemberdetail($member_id);	
				if($memberdetail['current_address']==''){
			    
			    	$current_address = FCrtRplc($form_data['address']); 
			    
			    
			}else{
			    
			    	$current_address = FCrtRplc($memberdetail['current_address']); 
			    
			}
					if($memberdetail['first_name']==''){
			    
			    	$first_name = FCrtRplc($form_data['first_name']); 
			    
			    
			}else{
			    
			    	$first_name = FCrtRplc($memberdetail['first_name']); 
			    
			}
			
			
			
				if($memberdetail['member_mobile']==''){
			    
			    	$member_mobile = FCrtRplc($form_data['member_mobile']); 
			    
			    
			}else{
			    
			    	$member_mobile = FCrtRplc($memberdetail['member_mobile']); 
			    
			}
			
				if($memberdetail['member_email']==''){
			    
			    	$member_email = FCrtRplc($form_data['member_email']); 
			    
			    
			}else{
			    
			    	$member_email = FCrtRplc($memberdetail['member_email']); 
			    
			}
			
			
			
			
			
			if($memberdetail['country_name']==''){
			    
			    	$country = FCrtRplc($form_data['country']); 
			    
			    
			}else{
			    
			    	$country = FCrtRplc($memberdetail['country_name']); 
			    
			}
			
			
			
				if($memberdetail['state_name']==''){
			    
			    	$state = FCrtRplc($form_data['state']); 
			    
			    
			}else{
			    
			    	$state = FCrtRplc($memberdetail['state_name']); 
			    
			}
			
				if($memberdetail['city_name']==''){
			    
			    	$city = FCrtRplc($form_data['city']); 
			    
			    
			}else{
			    
			    	$city = FCrtRplc($memberdetail['city_name']); 
			    
			}
			
				
			
			
			
			
			
			
			
			
			
			
			
			
			
	 
		  $fname = $first_name;
			$data = array(
				 	"first_name" =>$first_name,				 
				//	"full_name" => $fname,				 		
					"gender"=>$gender,
					"date_of_birth"=>$date_of_birth,				 
				 	"member_email" => $member_email,
				 	"member_mobile" =>$member_mobile,
					"country_name" =>$country,
					"state_name" =>$state,
					"city_name" =>$city,
					
					 
				
			);	
			
   
   
 	
			
			if($member_id>0){
			    
			    
  $otp =$form_data['email_otp']; 
                $otp_email  = $this->session->userdata('otp_email'); 
                
                
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($otp_email  !=$otp)   
	 {	
	       redirect_member("account","myprofile",set_message("danger","You have Enter Invalid OTP."));  
	 }else{
	     
	    $this->session->unset_userdata('otp_email');    
	     
	 }
		    
			    
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					if($_FILES['avatar_name']['error']=="0"){
				$ext = explode(".",$_FILES['avatar_name']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/".$photo;
				
				$AR_MEM = SelectTable("tbl_members","photo","member_id='$member_id'");

				$final_location = $fldvPath."upload/member/".$AR_MEM['photo'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['avatar_name']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("photo"=>$photo),array("member_id"=>$member_id));
					
						
					}}
			}
				set_message("success","Successfully updated Personal Information");
				redirect_member("account","myprofile",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","myprofile",array());
			}		
		} 

		
		if($form_data['submitMemberSavePassword']==1 && $this->input->post()!=''){
			   
			$old_password = FCrtRplc($form_data['old_password']);
			$user_password = FCrtRplc($form_data['user_password']);
			$confirm_user_password = FCrtRplc($form_data['confirm_user_password']);	
			if($old_password!=$user_password){
			    	if($confirm_user_password == $user_password){
				if($model->checkOldPassword($member_id,$old_password)>0){
				
					$this->SqlModel->updateRecord(prefix."tbl_members",array("user_password"=>$user_password),array("member_id"=>$member_id));
					set_message("success","Password has been changed successfully");
					redirect_member("account","myprofile",""); 
				}else{
					set_message("warning","Invalid old password");
					redirect_member("account","myprofile",""); 
				}
			    	}
			    	else{
					set_message("warning","New Password and Confirm Password should be same !");
					redirect_member("account","myprofile",""); 
				}
				
			}else{
				set_message("warning","New password must be different form old-password");
				redirect_member("account","myprofile",""); 
			}
		}
		
			$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/myaccount',$data);
	 }	 
	 
	 
	 
	 public function scan_and_pay()
	 {
	     
        $model = new OperationModel();
        $member_id = $this->session->userdata('mem_id');
        $form_data = $this->input->post();
   
           $uri = _d($this->uri->segment(4)); 
	 
		if($uri > 0 )
		{
                $this->SqlModel->updateRecord("tbl_coinpayment",array('status' => 'R'),array('id' => $uri , 'member_id' => $member_id));
                set_message("success","Successfully cancel  fund Request Link  .");
                redirect_member("account","scan_and_pay",array());
		}
		 
		if($form_data['makeRequest']==1 && $this->input->post()!=''){
 
                $amount        = FCrtRplc($form_data['amount']);		   
                $email_id      = FCrtRplc($form_data['email_id']);
                $trns_password = FCrtRplc($form_data['trns_password']);	 
                $coins         = FCrtRplc($form_data['coins']);	
                 $user_id = $this->session->userdata('user_id');
                // if($model->checkUserPassword($member_id,$trns_password) > 0) {
              
                  if(true) {
              
                if($model->checkPendingReqCoinPayment($member_id) == 0) {
                
               
                
                if($coins == 'TRX'   or $coins   == 'BUSD.BEP20'  or   $coins == 'USDT.TRC20'  or   $coins == 'BTC'  or $coins =='ETH')
                {
             
             
               if($coins == 'TRX'   )
                {     
                   $cryptoname='trxusdt'; 
                    $price = getlivecryptoprice($cryptoname);   //getCoinMarketCap();
     
        $addcharge = $price *.6/100;
        // $price = $price - $addcharge;
         $requestTRX    = round($amount/$price);
        
                }
                elseif(  $coins   == 'BUSD.BEP20'  )
                {
                     $cryptoname='busdusdt'; 
                      $price = getlivecryptoprice($cryptoname);   //getCoinMarketCap();
     
        $addcharge = $price *.6/100;
        // $price = $price - $addcharge;
        $price = 1;
         $requestTRX    =  ($amount/$price);
                }
                elseif(    $coins == 'USDT.TRC20')
                {
                    $cryptoname='busdusdt';  
                      $price = getlivecryptoprice($cryptoname);   //getCoinMarketCap();
     $price = 1;
        $addcharge = $price *.6/100;
        // $price = $price - $addcharge;
         $requestTRX    =  ($amount/$price);
                }
                elseif( $coins == 'BTC' )
                {
                     $cryptoname='btcusdt';  
                       $price = getlivecryptoprice($cryptoname);   //getCoinMarketCap();
     
        $addcharge = $price *.6/100;
        // $price = $price - $addcharge;
         $requestTRX    =  ($amount/$price);
                }
                elseif(  $coins =='ETH')
                {
                     $cryptoname='ethusdt';  
                       $price = getlivecryptoprice($cryptoname);   //getCoinMarketCap();
     
        $addcharge = $price *.6/100;
        // $price = $price - $addcharge;
         $requestTRX    =  ($amount/$price);
                }
                else
                {
                     $cryptoname='busdusdt'; 
                       $price = getlivecryptoprice($cryptoname);   //getCoinMarketCap();
     $price = 1;
        $addcharge = $price *.6/100;
        // $price = $price - $addcharge;
         $requestTRX    =  ($amount/$price);
                }
        
        
         
                if($price > 0 )
                {
                 
               $sts = generateQRofCoinPay($member_id,$user_id,$amount,$price,$requestTRX,$coins,$email_id);
                if($sts)
                {
                set_message("success","Successfully generated fund Request Link .Please make sure transfer now.");
				redirect_member("account","scan_and_pay",array()); }
				else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","scan_and_pay",array());
			    }
                
                
                
                if(false)
                { 
                $requestTRX    = round($amount/$price); 
		 
	             $result  = $this->coinpayments->CreateTransactionSimple($requestTRX, 'TRX', 'TRX', $email_id);
                if($result['error'] =='ok')
                {
                    $res = $result['result'];  
                    $status  = $this->coinpayments->getTransactionStatus($res['txn_id']);
                    $sts = $status['result'];
   
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
                        "added_usd"         =>  $amount,
                        "usd_price"         =>  $price,
                        "time_created"      =>  $sts['time_created'],             
                        "time_expires"      =>  $sts['time_expires'],             
                        "status_text"       =>  $sts['status_text'],            
                        "type"              =>  $sts['type'],     
                        "coin"              =>  $sts['coin'],     
                            
                        
                        );
                    $this->SqlModel->insertRecord(prefix."tbl_coinpayment",$data);
 
				 
				set_message("success","Successfully generated fund Request Link .Please make sure transfer now.");
				redirect_member("account","scan_and_pay",array());
			    }else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","scan_and_pay",array());
			}	
               }
               else
               {
                   	set_message("warning","Unable to update, please try again");
				redirect_member("account","scan_and_pay",array());
               }
                }
                else
                {
                set_message("warning","Unable to update, please try again");
                redirect_member("account","scan_and_pay","");   
                }
                }
                elseif($coins == 'EGC')
                {
                    $price = getEGCprice(); 
                    
                    if($price > 0 )
                    {
                    $res_amount  = round($amount / $price);
                    $res_address = $model->getValue("CONFIG_EGC_ADDRESS"); ; 
                    $data = array(
                        "member_id"         =>   $member_id ,         
                        "txn_id"            =>   "EGC".time().rand(111111,999999),      
                        "amount"            =>   $res_amount,  
                        "status"            =>   'N',      
                        "address"           =>   $res_address,     
                        "date_time"         =>   date('Y-m-d H:i:s'),    
                        "added_usd"         =>  $amount,
                        "usd_price"         =>  $price,
                        "status_text"       =>  "Waiting for buyer funds...",            
                        "type"              =>   'coins',     
                        "coin"              =>  'EGC',     
                            
                        
                        );
                    $this->SqlModel->insertRecord(prefix."tbl_coinpayment",$data);
                    
                    }
                    
                    else
                    {
                            set_message("warning","Something went wrong please try some time later...");
                            redirect_member("account","scan_and_pay","");     
                    }
                }
                else
                {
                    set_message("warning","Invalid coin selection...");
                    redirect_member("account","scan_and_pay","");     
                }
                
                
                }
                else
                {
                set_message("warning","You have already generate a Request.Please Paynow that link or Cancel...");
                redirect_member("account","scan_and_pay","");  
                }
                
                
                }
                else
                {
                set_message("warning","Invalid Login Password ...");
                redirect_member("account","scan_and_pay","");  
                }
		} 
	    $this->load->view(MEMBER_FOLDER.'/account/coinpayment',$data);
	 }
	   public function banking() {
	    	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
		$form_data = $this->input->post();   
	       
	     if($form_data['submitMemberSave2']==1 && $this->input->post()!=''){
 
          
		  $bank_name = FCrtRplc($form_data['bank_name']);
		  $bank_acct_holder = FCrtRplc($form_data['bank_acct_holder']);
		  $account_number = FCrtRplc($form_data['account_number']);
	      $ifc_code = FCrtRplc($form_data['ifc_code']);
		  $branch = FCrtRplc($form_data['branch']);
		  $pan_no = FCrtRplc($form_data['pan_no']);
		  $adhar = FCrtRplc($form_data['adhar']);
            $phonepay = FCrtRplc($form_data['phonepay']); 
            $googlepay = FCrtRplc($form_data['googlepay']);
            $paytm = FCrtRplc($form_data['paytm']);  
            
            $details = $model->BankDetails($member_id);
            
			$data = array(
	 
					"bank_name" => ($details['bank_name'] !='') ?$details['bank_name'] : $bank_name,
					"bank_acct_holder" => ($details['bank_acct_holder'] !='') ?$details['bank_acct_holder'] : $bank_acct_holder,
					"account_number" =>($details['account_number'] !='') ?$details['account_number'] :  $account_number,
					"ifc_code" => ($details['ifc_code'] !='') ?$details['ifc_code'] : $ifc_code,
					"branch" => ($details['branch'] !='') ?$details['branch'] : $branch,
					"pan_no" =>($details['pan_no'] !='') ?$details['pan_no'] :  $pan_no,
					"adhar" => ($details['adhar'] !='') ?$details['adhar'] : $adhar,
						"phonepay" =>$phonepay,
					"googlepay" =>$googlepay,
					"paytm" =>$paytm,
				
			);	
			
  // PrintR($data);die;
   
 	
			
			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					 
				set_message("success","Successfully updated Bank Detail");
				redirect_member("account","banking",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","banking",array());
			}		
		}
		
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/myaccount',$data);   
	       
	   }
	   
	      public function otherwallet() {
	    	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
		$form_data = $this->input->post();   
	       
	  	 if($form_data['submitMemberSaveotherwallet']==1 && $this->input->post()!=''){
 
 
  $cotp =$form_data['cemail_otp']; 
                $cotp_email  = $this->session->userdata('cotp_email'); 
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($cotp_email  !=$cotp)   
	 {	
	       redirect_member("account","myprofile",set_message("danger","You have Enter Invalid OTP."));  
	 }else{
	     
	    $this->session->unset_userdata('cotp_email');    
	     
	 }
	 
	 
	 
	 




$trc20address  =  FCrtRplc($form_data['trc20address']);
$polygonaddress  =  FCrtRplc($form_data['polygonaddress']);
$paypaladdress  =  FCrtRplc($form_data['paypaladdress']);
$skrilladdress  =  FCrtRplc($form_data['skrilladdress']);
$netSuiteaddress  =  FCrtRplc($form_data['netSuiteaddress']);
     $memberdetail   = $model->getMemberdetail($member_id);
  
        
        
                if($memberdetail['trc20address']==''){
                
                $trc20address = FCrtRplc($form_data['trc20address']);
                
                
                }else{
                
                $trc20address = FCrtRplc($memberdetail['trc20address']); 
                
                }
                if($memberdetail['polygonaddress']==''){
                
                $polygonaddress = FCrtRplc($form_data['polygonaddress']); 
                
                
                }else{
                
                $polygonaddress = FCrtRplc($memberdetail['polygonaddress']); 
                
                }
                
                
                
                if($memberdetail['paypaladdress']==''){
                
                $paypaladdress = FCrtRplc($form_data['paypaladdress']); 
                
                
                }else{
                
                $paypaladdress = FCrtRplc($memberdetail['paypaladdress']); 
                
                }
                
                if($memberdetail['skrilladdress']==''){
                
                $skrilladdress = FCrtRplc($form_data['skrilladdress']); 
                
                
                }else{
                
                $skrilladdress = FCrtRplc($memberdetail['skrilladdress']); 
                
                }
                
                if($memberdetail['netSuiteaddress']==''){
                
                $netSuiteaddress = FCrtRplc($form_data['netSuiteaddress']); 
                
                
                }else{
                
                $netSuiteaddress = FCrtRplc($memberdetail['netSuiteaddress']); 
                
                }

			
        
        
			$data = array(
	                "trc20address"  => $trc20address,
					"polygonaddress" => $polygonaddress,
					"paypaladdress" => $paypaladdress,
					"skrilladdress" => $skrilladdress,
				    "netSuiteaddress" =>$netSuiteaddress
				
			);	
			
   
   
 	
			
			if($member_id>0){
			    
			    if($memberdetail['trc20address']==''){
			        
			           $isaddressavailbe   = $model->checkotheraddress('trc20address',$trc20address);
			        
			        
			      if($isaddressavailbe==0){
			          
			          
			      }else{
			          
			         	set_message("warning","This Address Already Update with another User");
				redirect_member("account","myprofile",array()); 
			          
			      }
			    }  
			    
			     if($memberdetail['polygonaddress']==''){
			        
			           $isaddressavailbe   = $model->checkotheraddress('polygonaddress',$polygonaddress);
			        
			        
			      if($isaddressavailbe==0){
			          
			          
			      }else{
			          
			         	set_message("warning","This Address Already Update with another User");
				redirect_member("account","myprofile",array()); 
			          
			      }
			    }  
			    
			     if($memberdetail['paypaladdress']==''){
			        
			           $isaddressavailbe   = $model->checkotheraddress('paypaladdress',$paypaladdress);
			        
			        
			      if($isaddressavailbe==0){
			          
			          
			      }else{
			          
			         	set_message("warning","This Address Already Update with another User");
				redirect_member("account","myprofile",array()); 
			          
			      }
			    }  
			    
			     if($memberdetail['skrilladdress']==''){
			        
			           $isaddressavailbe   = $model->checkotheraddress('skrilladdress',$skrilladdress);
			        
			        
			      if($isaddressavailbe==0){
			          
			          
			      }else{
			          
			         	set_message("warning","This Address Already Update with another User");
				redirect_member("account","myprofile",array()); 
			          
			      }
			    }  
			    
			     if($memberdetail['netSuiteaddress']==''){
			        
			           $isaddressavailbe   = $model->checkotheraddress('netSuiteaddress',$netSuiteaddress);
			        
			        
			      if($isaddressavailbe==0){
			          
			          
			      }else{
			          
			         	set_message("warning","This Address Already Update with another User");
				redirect_member("account","myprofile",array()); 
			          
			      }
			    }  
			      $otp =$form_data['email_otp']; 
                $otp_email  = $this->session->userdata('otp_email'); 
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($otp_email  !=$otp)   
	 {	
	       redirect_member("account","myprofile",set_message("danger","You have Enter Invalid OTP."));  
	 }else{
	     
	    $this->session->unset_userdata('otp_email');    
	     
	 }
			    
			    
			    
			    
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					 
				set_message("success","Successfully updated crypto Detail");
				redirect_member("account","myprofile",array());
			      
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","myprofile",array());
			}		
		}
		
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/myaccount',$data);   
	       
	   }
	     public function crypto() {
	    	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
		$form_data = $this->input->post();   
	       
	  	 if($form_data['submitMemberSaveCrypto']==1 && $this->input->post()!=''){
 
 
  $cotp =$form_data['cemail_otp']; 
                $cotp_email  = $this->session->userdata('cotp_email'); 
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($cotp_email  !=$cotp)   
	 {	
	       redirect_member("account","myprofile",set_message("danger","You have Enter Invalid OTP."));  
	 }else{
	     
	    $this->session->unset_userdata('cotp_email');    
	     
	 }
   $ownaddress  =  FCrtRplc($form_data['ownaddress']);
     $memberdetail   = $model->getMemberdetail($member_id);
    $isaddressavailbe   = $model->checkdepositeaddress($ownaddress);
 //PrintR($isaddressavailbe);die;
   //PrintR($form_data);die;
		 
		
	
	   
        
        
        		if($memberdetail['btc_address']==''){
			    
			     $btc_address = FCrtRplc($form_data['btc_address']);
			    
			    
			}else{
			    
			    	$btc_address = FCrtRplc($memberdetail['btc_address']); 
			    
			}
					if($memberdetail['trx_address']==''){
			    
			    	$trx_address = FCrtRplc($form_data['trx_address']); 
			    
			    
			}else{
			    
			    	$trx_address = FCrtRplc($memberdetail['trx_address']); 
			    
			}
			
			
			
				if($memberdetail['eth_address']==''){
			    
			    	$eth_address = FCrtRplc($form_data['eth_address']); 
			    
			    
			}else{
			    
			    	$eth_address = FCrtRplc($memberdetail['eth_address']); 
			    
			}
			
				if($memberdetail['usdt_address']==''){
			    
			    	$usdt_address = FCrtRplc($form_data['usdt_address']); 
			    
			    
			}else{
			    
			    	$usdt_address = FCrtRplc($memberdetail['usdt_address']); 
			    
			}
			
			if($memberdetail['ownaddress']==''){
			    
			    	$ownaddress = FCrtRplc($form_data['ownaddress']); 
			    
			    
			}else{
			    
			    	$ownaddress = FCrtRplc($memberdetail['ownaddress']); 
			    
			}
			
			
        
        
			$data = array(
	                "ownaddress"  => $ownaddress,
					"btc_address" => $btc_address,
					"trx_address" => $trx_address,
					"eth_address" => $eth_address,
				    "usdt_address" =>$usdt_address
				
			);	
			
   
   
 	
			
			if($member_id>0){
			    
			    if($memberdetail['ownaddress']==''){
			      if($isaddressavailbe==0){
			          
			          
			      }else{
			          
			         	set_message("warning","This Deposit Address Already Update with another User");
				redirect_member("account","myprofile",array()); 
			          
			      }
			    }  
			      $otp =$form_data['email_otp']; 
                $otp_email  = $this->session->userdata('otp_email'); 
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($otp_email  !=$otp)   
	 {	
	       redirect_member("account","myprofile",set_message("danger","You have Enter Invalid OTP."));  
	 }else{
	     
	    $this->session->unset_userdata('otp_email');    
	     
	 }
			    
			    
			    
			    
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					 
				set_message("success","Successfully updated crypto Detail");
				redirect_member("account","myprofile",array());
			      
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","myprofile",array());
			}		
		}
		
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/myaccount',$data);   
	       
	   }
	   public function cryptodddddddddddddd() {
	    	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
		$form_data = $this->input->post();   
	       
	  	 if($form_data['submitMemberSaveCrypto']==1 && $this->input->post()!=''){
 
 
  $cotp =$form_data['cemail_otp']; 
                $cotp_email  = $this->session->userdata('cotp_email'); 
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($cotp_email  !=$cotp)   
	 {	
	       redirect_member("account","myprofile",set_message("danger","You have Enter Invalid OTP."));  
	 }else{
	     
	    $this->session->unset_userdata('cotp_email');    
	     
	 }
 
   //PrintR($form_data);die;
		  $btc_address = FCrtRplc($form_data['btc_address']);
		  $trx_address = FCrtRplc($form_data['trx_address']);
		  $eth_address = FCrtRplc($form_data['eth_address']);
	      $usdt_address  =  FCrtRplc($form_data['usdt_address']);
          $Elite_address  =  FCrtRplc($form_data['ownaddress']);
			$data = array(
	                "ownaddress"  => $Elite_address,
					"btc_address" => $btc_address,
					"trx_address" => $trx_address,
					"eth_address" => $eth_address,
				    "usdt_address" =>$usdt_address
				
			);	
			
   
   
 	
			
			if($member_id>0){
			      if($model->checkCount(prefix."tbl_members","ownaddress",$Elite_address)==0){
			    
			      $otp =$form_data['email_otp']; 
                $otp_email  = $this->session->userdata('otp_email'); 
               // PrintR($otp_mt);die;
               // $this->session->unset_userdata('otp_email');   
 
	 if($otp_email  !=$otp)   
	 {	
	       redirect_member("account","myprofile",set_message("danger","You have Enter Invalid OTP."));  
	 }else{
	     
	    $this->session->unset_userdata('otp_email');    
	     
	 }
			    
			    
			    
			    
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					 
				set_message("success","Successfully updated crypto Detail");
				redirect_member("account","myprofile",array());
			      }else{
			          
			         	set_message("warning","This Address Already Update with another User");
				redirect_member("account","myprofile",array()); 
			          
			      }
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","myprofile",array());
			}		
		}
		
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/myaccount',$data);   
	       
	   }
	  public function updatekyc()    	{
	
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		
		if($form_data['submitkycupadation']==1 && $this->input->post()!=''){
			$fldvPath = "";

		$QR_CHECK = "SELECT file_type  from tbl_mem_kyc  WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK); 
		foreach($fR as $ffffff) {
		    
		    
		     $ffffff['file_type'];
		    if($ffffff['file_type']== 'ADHAR CARD FRONT' || $ffffff['file_type']== 'ADHAR CARD BACK' || $ffffff['file_type']== 'PAN CARD' || $ffffff['file_type']== 'CHEQUE' || $ffffff['file_type']== 'INTERNATIONAL ID' ){ /* set_message("warning","Already Uploaded ADHAR CARD FRONT"); */ }else{ set_message("warning","Please Upload Your Document");  redirect_member("account","updatekyc",array()); }

		}
 
			if($_FILES['panfile']['error']=="0"){
			    
			    
			     $file_size = $_FILES['panfile']['size'];
                 if (($file_size <= 2097152)){ 
                     
				$ext = explode(".",$_FILES['panfile']["name"]);
				$fExtn = strtolower(end($ext));
				
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$file_name = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/kyc/".$file_name;
				$AR_MEM = SelectTable("tbl_mem_kyc","file_name","member_id='$member_id'  and file_type='PAN CARD'");

				$final_location = $fldvPath."upload/kyc/".$AR_MEM['file_name'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
					if(move_uploaded_file($_FILES['panfile']['tmp_name'], $target_path)){
						$data = array("member_id"=>$member_id,
							"file_name"=>$file_name,
							"file_type"=>"PAN CARD"
						);
						$this->SqlModel->insertRecord(prefix."tbl_mem_kyc",$data);
					}
					
                 }	
                    else
                    {
                    set_message("warning","Invalid File Format Please use Only PNG / JPG / jpeg .");
                    redirect_member("account","updatekyc",array());
                    }
			}
			else
			{
                    set_message("warning","Invalid File size of PAN Card max 2mb .");
                    redirect_member("account","updatekyc",array());
			}
			}
			
			
			
			if($_FILES['adharfront']['error']=="0"){
				$ext = explode(".",$_FILES['adharfront']["name"]);
				$fExtn = strtolower(end($ext));
				$file_size = $_FILES['adharfront']['size'];
                 if (($file_size <= 2097152)){ 
                   if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$file_name = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/kyc/".$file_name;
				$AR_MEM = SelectTable("tbl_mem_kyc","file_name","member_id='$member_id' and file_type='ADHAR CARD FRONT'");

				$final_location = $fldvPath."upload/kyc/".$AR_MEM['file_name'];
			//	PrintR($final_location);
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
					if(move_uploaded_file($_FILES['adharfront']['tmp_name'], $target_path)){
						$data = array("member_id"=>$member_id,
							"file_name"=>$file_name,
							"file_type"=>"ADHAR CARD FRONT"
						);
						$this->SqlModel->insertRecord(prefix."tbl_mem_kyc",$data);
					}
					
                   }	
                    else
                    {
                    set_message("warning","Invalid File Format Please use Only PNG / JPG / jpeg .");
                    redirect_member("account","updatekyc",array());
                    }
			}
			else
			{
                    set_message("warning","Invalid File size of PAN Card max 2mb .");
                    redirect_member("account","updatekyc",array());
			}		
			}
			
			
			 
			if($_FILES['adharback']['error']=="0"){
				$ext = explode(".",$_FILES['adharback']["name"]);
				$fExtn = strtolower(end($ext));
				
				$file_size = $_FILES['adharback']['size'];
                 if (($file_size <= 2097152)){ 
                 if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$file_name = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/kyc/".$file_name;
				$AR_MEM = SelectTable("tbl_mem_kyc","file_name","member_id='$member_id'  and file_type='ADHAR CARD BACK'");

				$final_location = $fldvPath."upload/kyc/".$AR_MEM['file_name'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
					if(move_uploaded_file($_FILES['adharback']['tmp_name'], $target_path)){
						$data = array("member_id"=>$member_id,
							"file_name"=>$file_name,
							"file_type"=>"ADHAR CARD BACK"
						);
						$this->SqlModel->insertRecord(prefix."tbl_mem_kyc",$data);
					}
                 }	
                    else
                    {
                    set_message("warning","Invalid File Format Please use Only PNG / JPG / jpeg .");
                    redirect_member("account","updatekyc",array());
                    }
			}
			else
			{
                    set_message("warning","Invalid File size of PAN Card max 2mb .");
                    redirect_member("account","updatekyc",array());
			}
			}
			
				if($_FILES['cheque']['error']=="0"){
				$ext = explode(".",$_FILES['cheque']["name"]);
				$fExtn = strtolower(end($ext));
					$file_size = $_FILES['cheque']['size'];
                 if (($file_size <= 2097152)){ 
                 if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$file_name = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/kyc/".$file_name;
				$AR_MEM = SelectTable("tbl_mem_kyc","file_name","member_id='$member_id'  and file_type='CHEQUE'");

				$final_location = $fldvPath."upload/kyc/".$AR_MEM['file_name'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
					if(move_uploaded_file($_FILES['cheque']['tmp_name'], $target_path)){
						$data = array("member_id"=>$member_id,
							"file_name"=>$file_name,
							"file_type"=>"CHEQUE"
						);
						$this->SqlModel->insertRecord(prefix."tbl_mem_kyc",$data);
					}
				}	
                    else
                    {
                    set_message("warning","Invalid File Format Please use Only PNG / JPG / jpeg .");
                    redirect_member("account","updatekyc",array());
                    }
			}
			else
			{
                    set_message("warning","Invalid File size of PAN Card max 2mb .");
                    redirect_member("account","updatekyc",array());
			}
			}
				if($_FILES['internationid']['error']=="0"){
				$ext = explode(".",$_FILES['internationid']["name"]);
				$fExtn = strtolower(end($ext));
					$file_size = $_FILES['internationid']['size'];
                 if (($file_size <= 2097152)){ 
                 if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$file_name = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/kyc/".$file_name;
				$AR_MEM = SelectTable("tbl_mem_kyc","file_name","member_id='$member_id'  and file_type='INTERNATIONAL ID'");

				$final_location = $fldvPath."upload/kyc/".$AR_MEM['file_name'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
					if(move_uploaded_file($_FILES['internationid']['tmp_name'], $target_path)){
						$data = array("member_id"=>$member_id,
							"file_name"=>$file_name,
							"file_type"=>"INTERNATIONAL ID"
						);
						$this->SqlModel->insertRecord(prefix."tbl_mem_kyc",$data);
					}
				}	
                    else
                    {
                    set_message("warning","Invalid File Format Please use Only PNG / JPG / jpeg .");
                    redirect_member("account","updatekyc",array());
                    }
			}
			else
			{
                    set_message("warning","Invalid File size of PAN Card max 2mb .");
                    redirect_member("account","updatekyc",array());
			}
			}
				$model->updatekyc($member_id);
		set_message("success","Thank you for updating your kyc details, we will verify your details soon..");
		redirect_member("account","updatekyc",array());
		}
		
		
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/myaccount',$data);   
	
	}
	

   public function myAccount()        {
	 	$model = new OperationModel();
		$member_id = $this->session->userdata('mem_id');
		$form_data = $this->input->post();
		if($form_data['submitMemberSave1']==1 && $this->input->post()!=''){
 
		    $first_name = FCrtRplc($form_data['first_name']);		   
			$date_of_birth = FCrtRplc($form_data['date_of_birth']);
			$gender = FCrtRplc($form_data['gender']);		   
			$member_mobile = FCrtRplc($form_data['member_mobile']); 
			$member_email = FCrtRplc($form_data['member_email']);   
				$country = FCrtRplc($form_data['country']); 
			$state = FCrtRplc($form_data['state']);
				$city = FCrtRplc($form_data['city']); 
			
	 
		  $fname = $first_name;
			$data = array(
				 	"first_name" =>$first_name,				 
				//	"full_name" => $fname,				 		
					"gender"=>$gender,
					"date_of_birth"=>$date_of_birth,				 
				 	"member_email" => $member_email,
				 	"member_mobile" =>$member_mobile,
					"country_name" =>$country,
					"state_name" =>$state,
					"city_name" =>$city,
					 
				
			);	
			
   
   
 	
			
			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					if($_FILES['avatar_name']['error']=="0"){
				$ext = explode(".",$_FILES['avatar_name']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/".$photo;
				
				$AR_MEM = SelectTable("tbl_members","photo","member_id='$member_id'");

				$final_location = $fldvPath."upload/member/".$AR_MEM['photo'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['avatar_name']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("photo"=>$photo),array("member_id"=>$member_id));
					
						
					}}
			}
				set_message("success","Successfully updated Personal Information");
				redirect_member("account","myAccount",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","myAccount",array());
			}		
		} 

	  
		
	
		
		if($form_data['submitMemberSave3']==1 && $this->input->post()!=''){
 
 
	        $nominal_name = FCrtRplc($form_data['nominal_name']);
     	    $nominal_relation = FCrtRplc($form_data['nominal_relation']);	
		    $nominal_birth = FCrtRplc($form_data['nominal_birth']);
		    $nominal_mobile = FCrtRplc($form_data['nominal_mobile']);         
		  
		      $nominal_ac_no = FCrtRplc($form_data['nominal_ac_no']);
     	    $nominal_bank_name = FCrtRplc($form_data['nominal_bank_name']);	
		    $nominal_ac_name = FCrtRplc($form_data['nominal_ac_name']);
		    $nominal_ifsc = FCrtRplc($form_data['nominal_ifsc']);         
 
	 
	    
		  $fname = $first_name.' '. $midle_name.' '. $last_name;
			$data = array(
					  
					"place_of_birth"=>$place_of_birth,
					"nominal_name"=>$nominal_name,
					"nominal_relation"=>$nominal_relation,
					"nominal_birth"=>$nominal_birth,
					"nominal_mobile"=>$nominal_mobile,
					"nominal_bank_name"=>$nominal_bank_name,
					"nominal_ac_name"=>$nominal_ac_name,
					"nominal_ifsc"=>$nominal_ifsc,
					"nominal_ac_no"=>$nominal_ac_no
				 
				
			);	
			
   
   
 	
			
			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
				 
				set_message("success","Successfully updated Nominee Detail");
				redirect_member("account","myAccount",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","myAccount",array());
			}		
		}
		
		if($form_data['submitMemberSave4']==1 && $this->input->post()!=''){
 
		 
		    $state_name = FCrtRplc($form_data['state_name']);
		    $district_name = FCrtRplc($form_data['district_name']);
			$city_name = FCrtRplc($form_data['city_name']);
			$current_address = FCrtRplc($form_data['current_address']);
			$pin_code = FCrtRplc($form_data['pin_code']);
		   
			$data = array(
				 
					"current_address"=>$current_address,
					"state_name"=>$state_name,	
					"district_name"=>$district_name,
					"city_name"=>$city_name,
					"pin_code"=>$pin_code,
				 
				
			);	
			
   
   
 	
			
			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
			 
				set_message("success","Successfully updated Address ");
				redirect_member("account","myAccount",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","myAccount",array());
			}		
		}
		
		if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
 
		    $first_name = FCrtRplc($form_data['first_name']);
		    $midle_name = FCrtRplc($form_data['midle_name']);
		    $last_name = FCrtRplc($form_data['last_name']);
			$father_name = FCrtRplc($form_data['father_name']);
			$date_of_birth = FCrtRplc($form_data['date_of_birth']);
			$gender = FCrtRplc($form_data['gender']);
		    $state_name = FCrtRplc($form_data['state_name']);
		    $district_name = FCrtRplc($form_data['district_name']);
			$city_name = FCrtRplc($form_data['city_name']);
			$current_address = FCrtRplc($form_data['current_address']);
			$pin_code = FCrtRplc($form_data['pin_code']);
			$member_mobile = FCrtRplc($form_data['member_mobile']);
	        $pan_no = FCrtRplc($form_data['pan_no']);
	        $nominal_name = FCrtRplc($form_data['nominal_name']);
     	    $nominal_relation = FCrtRplc($form_data['nominal_relation']);	
		    $nominal_birth = FCrtRplc($form_data['nominal_birth']);
		    $nominal_mobile = FCrtRplc($form_data['nominal_mobile']);         
		  
		      $nominal_ac_no = FCrtRplc($form_data['nominal_ac_no']);
     	    $nominal_bank_name = FCrtRplc($form_data['nominal_bank_name']);	
		    $nominal_ac_name = FCrtRplc($form_data['nominal_ac_name']);
		    $nominal_ifsc = FCrtRplc($form_data['nominal_ifsc']);         
 
		    $member_email = FCrtRplc($form_data['member_email']);    
		  
		  $bank_name = FCrtRplc($form_data['bank_name']);
		  $bank_acct_holder = FCrtRplc($form_data['bank_acct_holder']);
		  $account_number = FCrtRplc($form_data['account_number']);
	      $ifc_code = FCrtRplc($form_data['ifc_code']);
		  $branch = FCrtRplc($form_data['branch']);
		  $pan_no = FCrtRplc($form_data['pan_no']);
		  $adhar = FCrtRplc($form_data['adhar']);
		  $fname = $first_name.' '. $midle_name.' '. $last_name;
			$data = array(
				// 	"first_name" =>$first_name,
				// 	"last_name" =>$last_name,
				// 	"full_name" => $fname,
					"father_name"=>$father_name,					
					"gender"=>$gender,
					"date_of_birth"=>$date_of_birth,
					"current_address"=>$current_address,
					"state_name"=>$state_name,	
					"district_name"=>$district_name,
					"city_name"=>$city_name,
					"pin_code"=>$pin_code,
					"pan_no"=>$pan_no,
				// 	"member_email" => $member_email,
				// 	"member_mobile" =>$member_mobile,
					"place_of_birth"=>$place_of_birth,
					"nominal_name"=>$nominal_name,
					"nominal_relation"=>$nominal_relation,
					"nominal_birth"=>$nominal_birth,
					"nominal_mobile"=>$nominal_mobile,
					"nominal_bank_name"=>$nominal_bank_name,
					"nominal_ac_name"=>$nominal_ac_name,
					"nominal_ifsc"=>$nominal_ifsc,
					"nominal_ac_no"=>$nominal_ac_no,
					"bank_name" => $bank_name,
					"bank_acct_holder" => $bank_acct_holder,
					"account_number" => $account_number,
					"ifc_code" => $ifc_code,
					"branch" => $branch,
					"pan_no" => $pan_no,
					"adhar" => $adhar
				
			);	
			
   
   
 	
			
			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					if($_FILES['avatar_name']['error']=="0"){
				$ext = explode(".",$_FILES['avatar_name']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/".$photo;
				
				$AR_MEM = SelectTable("tbl_members","photo","member_id='$member_id'");

				$final_location = $fldvPath."upload/member/".$AR_MEM['photo'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['avatar_name']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("photo"=>$photo),array("member_id"=>$member_id));
					
						
					}}
			}
				set_message("success","Successfully updated member  detail");
				redirect_member("account","myAccount",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","myAccount",array());
			}		
		}
		
		if($form_data['submitMemberSavePassword']==1 && $this->input->post()!=''){
			   
			$old_password = FCrtRplc($form_data['old_password']);
			$user_password = FCrtRplc($form_data['user_password']);
			$confirm_user_password = FCrtRplc($form_data['confirm_user_password']);	
			if($old_password!=$user_password){
			    	if($confirm_user_password == $user_password){
				if($model->checkOldPassword($member_id,$old_password)>0){
				
					$this->SqlModel->updateRecord(prefix."tbl_members",array("user_password"=>$user_password),array("member_id"=>$member_id));
					set_message("success","Password has been changed successfully");
					redirect_member("account","myAccount",""); 
				}else{
					set_message("warning","Invalid old password");
					redirect_member("account","myAccount",""); 
				}
			    	}
			    	else{
					set_message("warning","New Password and Confirm Password should be same !");
					redirect_member("account","myAccount",""); 
				}
				
			}else{
				set_message("warning","New password must be different form old-password");
				redirect_member("account","myAccount",""); 
			}
		}
		
		if($form_data['submitkycupadation']==1 && $this->input->post()!=''){
 
		    $pan_no = FCrtRplc($form_data['pan_no']);
		    $adhar = FCrtRplc($form_data['adhar']);
		   
			$data = array(

					"pan_no" => $pan_no,
					"adhar" => $adhar
				
			);	
			
   

			
			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					if($_FILES['panfile']['error']=="0"){
				$ext = explode(".",$_FILES['panfile']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$panfile = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/pan/".$panfile;
				
				$AR_MEM = SelectTable("tbl_members","pan_file","member_id='$member_id'");

				$final_location = $fldvPath."upload/member/pan/".$AR_MEM['pan_file'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['panfile']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("pan_file"=>$panfile),array("member_id"=>$member_id));
					
						
					}}
			}
			
				    if($_FILES['adharfront']['error']=="0"){
				$ext = explode(".",$_FILES['adharfront']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$adhar_front = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/adhar/".$adhar_front;
				
				$AR_MEM = SelectTable("tbl_members","adhar_front","member_id='$member_id'");

				$final_location = $fldvPath."upload/member/adhar/".$AR_MEM['adhar_front'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['adharfront']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("adhar_front"=>$adhar_front),array("member_id"=>$member_id));
					
						
					}}
			}
			
				    if($_FILES['adharback']['error']=="0"){
				$ext = explode(".",$_FILES['adharback']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$adhar_back = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/adhar/".$adhar_back;
				
				$AR_MEM = SelectTable("tbl_members","adhar_back","member_id='$member_id'");

				$final_location = $fldvPath."upload/member/".$AR_MEM['adhar_back'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['adharback']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("adhar_back"=>$adhar_back),array("member_id"=>$member_id));
					
						
					}}
			}
			
			
				set_message("success","Successfully updated your KYC  detail");
				redirect_member("account","myAccount",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","myAccount",array());
			}		
		}
		
		
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/myaccount',$data);
	 }
	 	
	 public function profile()          {
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);

		if($form_data['savePlacement']==1 && $this->input->post()!=''){
			$model->setConfigMember("MEM_PLACEMENT",FCrtRplc($form_data['MEM_PLACEMENT']));
			set_message("success","Placement updated successfully");
			redirect_member("account","profile",""); 
		}
		
		if($form_data['submitMemberSavePassword']==1 && $this->input->post()!=''){
			$old_password = FCrtRplc($form_data['old_password']);
			$user_password = FCrtRplc($form_data['user_password']);
			$confirm_user_password = FCrtRplc($form_data['confirm_user_password']);	
			if($old_password!=$user_password){
				if($model->checkOldPassword($member_id,$old_password)>0){
					$sms_otp = $model->sendPasswordSMS($AR_MEM['mobile_number']);
					$data = array("member_id"=>$member_id,
						"new_value"=>$user_password,
						"sms_otp"=>$sms_otp,
						"sms_type"=>"PWORD",
						"mobile_number"=>$AR_MEM['mobile_number']
					);
					$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
					set_message("success","Please verify otp from your registered email address");
					redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id))); 
				}else{
					set_message("warning","Invalid old password");
					redirect_member("account","profile",""); 
				}
			}else{
				set_message("warning","New password must be different form old-password");
				redirect_member("account","profile",""); 
			}
		}
		
		
		
		if($form_data['submitMemberSaveTrnsPassword']==1 && $this->input->post()!=''){
			$old_password = FCrtRplc($form_data['current_tr_password']);
			$trns_password = FCrtRplc($form_data['new_tr_password']);
			$confirm_trns_password = FCrtRplc($form_data['new_tr_password_again']);	
			if($old_password!=$trns_password){
				if($model->checkTrnsPassword($member_id,$old_password)>0){
						
					$sms_otp = $model->sendPasswordSMS($AR_MEM['mobile_number']);
					$data = array("member_id"=>$member_id,
						"new_value"=>$trns_password,
						"sms_otp"=>$sms_otp,
						"sms_type"=>"TPWORD",
						"mobile_number"=>$AR_MEM['mobile_number']
					);
					$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
					set_message("success","Please verify OTP from your registered email address");
					redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id)));
				}else{
					set_message("warning","Invalid transaction password");
					redirect_member("account","profile",""); 
				}
			}else{
				set_message("warning","New password must be different form old-password");
				redirect_member("account","profile",""); 
			}
		}
		
		if($form_data['changeMobile']==1 && $this->input->post()!=''){
			$member_mobile = FCrtRplc($form_data['member_mobile']);
			$country_code = FCrtRplc($form_data['country_code']);
			$mobile_code = $model->getMobileCode($country_code);
			$transaction_password = FCrtRplc($form_data['transaction_password']);
			$new_number = $AR_MEM['mobile_number'];
			$new_value = json_encode(array("mobile_code"=>$mobile_code,
						"member_mobile"=>$member_mobile,
						"country_code"=>$country_code));
			if($model->checkTrnsPassword($member_id,$transaction_password)>0){
				$sms_otp = $model->sendEmailSMS($new_number);
				$data = array("member_id"=>$member_id,
					"new_value"=>$new_value,
					"sms_otp"=>$sms_otp,
					"sms_type"=>"MOBILE",
					"mobile_number"=>$new_number
				);
				$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
				set_message("success","Please verify OTP from your registered email address");
				redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id))); 
			}else{
				set_message("warning","Invalid transaction password");
				redirect_member("account","profile",""); 
			}
			
		}
		
		if($form_data['changeEmail']==1 && $this->input->post()!=''){
			$change_email = FCrtRplc($form_data['change_email']);
			$transaction_password = FCrtRplc($form_data['transaction_password']);
			if($model->checkEmailExist($change_email)==0){
				if($model->checkTrnsPassword($member_id,$transaction_password)>0){
					$sms_otp = $model->sendEmailSMS($AR_MEM['mobile_number']);
					$data = array("member_id"=>$member_id,
						"new_value"=>$change_email,
						"sms_otp"=>$sms_otp,
						"sms_type"=>"EMAIL",
						"mobile_number"=>$AR_MEM['mobile_number']
					);
					$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
					set_message("success","Please verify OTP from your registered email address");
					redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id))); 
				}else{
					set_message("warning","Invalid transaction password");
					redirect_member("account","profile",""); 
				}
			}else{
				set_message("warning","This email address is already used, please try another");
				redirect_member("account","profile",""); 
			}
		}
		
		if($form_data['submitMemberSave']==1 && $this->input->post()!=''){
		  
		  
		  
		  


		  
		  
		  
		  
		  
		  
		
			$father_name = FCrtRplc($form_data['father_name']);
			$date_of_birth = FCrtRplc($form_data['date_of_birth']);
		    $current_address = FCrtRplc($form_data['current_address']);
		    $state_name = FCrtRplc($form_data['state_name']);
			$city_name = FCrtRplc($form_data['city']);
	        $pin_code = FCrtRplc($form_data['pin_code']);
			$member_mobile = FCrtRplc($form_data['member_mobile']);
	    $pan_no = FCrtRplc($form_data['pan_no']);
	    $nominal_name = FCrtRplc($form_data['nominal_name']);
     	$nominal_relation = FCrtRplc($form_data['nominal_relation']);	
		$nominal_birth = FCrtRplc($form_data['nominal_birth']);
		$nominal_mobile = FCrtRplc($form_data['nominal_mobile']);
        $gender = FCrtRplc($form_data['gender']);
			$data = array(
			    "father_name"=>$father_name,
			    
			   "gender"=>$gender,
				"date_of_birth"=>$date_of_birth,
				"current_address"=>$current_address,
				"state_name"=>$state_name,
				"member_mobile"=>$member_mobile,
				"city_name"=>$city_name,
				"pin_code"=>$pin_code,
				"pan_no"=>$pan_no,
				"place_of_birth"=>$place_of_birth,
				"nominal_name"=>$nominal_name,
				"nominal_relation"=>$nominal_relation,
				"nominal_birth"=>$nominal_birth,
				"nominal_mobile"=>$nominal_mobile
				
			);	
			
			
			
			
			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					if($_FILES['avatar_name']['error']=="0"){
				$ext = explode(".",$_FILES['avatar_name']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/".$photo;
				
				$AR_MEM = SelectTable("tbl_members","photo","member_id='$member_id'");

				$final_location = $fldvPath."upload/member/".$AR_MEM['photo'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['avatar_name']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("photo"=>$photo),array("member_id"=>$member_id));
					
						
					}}
			}
				set_message("success","Successfully updated member  detail");
				redirect_member("account","profile",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","profile",array());
			}		
		}
		
		if($form_data['submitBankDetail']==1 && $this->input->post()!=''){
		
			$bank_acct_holder = FCrtRplc($form_data['bank_acct_holder']);
			$bank_name = FCrtRplc($form_data['bank_name']);
			$bank_country = FCrtRplc($form_data['bank_country']);
			$account_number = FCrtRplc($form_data['account_number']);
			$swift_code = FCrtRplc($form_data['swift_code']);
			
			$bank_address = FCrtRplc($form_data['bank_address']);
			$bank_city = FCrtRplc($form_data['bank_city']);
			$bank_state = FCrtRplc($form_data['bank_state']);
			$bank_zipcode = FCrtRplc($form_data['bank_zipcode']);
			
			$data = array("bank_acct_holder"=>$bank_acct_holder,
				"bank_name"=>$bank_name,
				"bank_country"=>$bank_country,
				"account_number"=>$account_number,
				"swift_code"=>$swift_code,
				"bank_address"=>($bank_address)? $bank_address:" ",
				"bank_city"=>($bank_city)? $bank_city:" ",
				"bank_state"=>($bank_state)? $bank_state:" ",
				"bank_zipcode"=>($bank_zipcode)? $bank_zipcode:" "
			);	
			if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
				set_message("success","Successfully updated banck  detail");
				redirect_member("account","profile",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","profile",array());
			}			

		}
		
		if($form_data['updateProfileAvatar']==1 && $this->input->post()!=''){
			$fldvPath = "";
			if($_FILES['avatar_name']['error']=="0"){
				$ext = explode(".",$_FILES['avatar_name']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/".$photo;
				
				$AR_MEM = SelectTable("tbl_members","photo","member_id='$member_id'");

				$final_location = $fldvPath."upload/member/".$AR_MEM['photo'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['avatar_name']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("photo"=>$photo),array("member_id"=>$member_id));
						set_message("success","Successfully updated profile avatar");
						redirect_member("account","profile",array());
						
					}}
			}
		}
		
		if($form_data['sendMessage']!='' && $this->input->post()!=''){
			$mail_email = $form_data['mail_email'];
			$email_body = $form_data['email_body'];
			$email_subject = $form_data['email_subject'];
			$AR_RT['mail_email'] = $mail_email;
			$AR_RT['email_subject'] = $email_subject;
			$AR_RT['email_body'] = $email_body;
			Send_Mail($AR_RT,"INVITATION");
			set_message("success","Your message send successfully");
			redirect_member("account","profile","");
		}
		
		if($form_data['perfectMoneyBtn']!='' && $this->input->post()!=''){	
			$prft_account_type = $form_data['prft_account_type'];
			$prft_acc_number = $form_data['prft_acc_number'];
			if($model->checkTrnsPassword($member_id,$form_data['trns_password'])>0){
				if($prft_acc_number!=''){
					$data_perfect = array("prft_account_type"=>$prft_account_type,
						"prft_acc_number"=>$prft_acc_number
					);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data_perfect,array("member_id"=>$member_id));
					set_message("success","Successfully updated perfect money account details");
					redirect_member("account","profile",array());
				}else{
					set_message("warning","Unbale to update perfect money account");
					redirect_member("account","profile",array());
				}
			}else{
				set_message("warning","Invalid transaction password");
				redirect_member("account","profile","");	
			}
		}
		
		if($form_data['bitCoinBtn']!='' && $this->input->post()!=''){	
			$bitcoin_address = $form_data['bitcoin_address'];
			if($bitcoin_address!='' && $member_id!=''){
				if($model->checkTrnsPassword($member_id,$form_data['trns_password'])>0){
					try{
						validate($bitcoin_address);
						$data_address = array("bitcoin_address"=>$bitcoin_address);
						$this->SqlModel->updateRecord(prefix."tbl_members",$data_address,array("member_id"=>$member_id));
						set_message("success","Successfully updated your bitcoin address");
						redirect_member("account","profile",array());
					 }catch(Exception $e) { 
						set_message("warning",$e->getMessage());
						redirect_member("account","profile",array());
					}
				}else{
					set_message("warning","Invalid transaction password");
					redirect_member("account","profile","");	
				}
			}else{
				set_message("warning","Invalid bitcoin addressss");
				redirect_member("account","profile",array());
			}
		}
		


		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
	    $QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;


		$this->load->view(MEMBER_FOLDER.'/account/profile',$data);
	}
	
	/*public function kyc(){$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		
		if($form_data['saveKycForm']==1 && $this->input->post()!=''){
			$fldvPath = "";
			
			if($_FILES['file_passport']['error']=="0"){
				$ext = explode(".",$_FILES['file_passport']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$file_name = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/kyc/".$file_name;
				$AR_MEM = SelectTable("tbl_mem_kyc","file_name","member_id='$member_id'");

				$final_location = $fldvPath."upload/kyc/".$AR_MEM['file_name'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
					if(move_uploaded_file($_FILES['file_passport']['tmp_name'], $target_path)){
						$data = array("member_id"=>$member_id,
							"file_name"=>$file_name,
							"file_type"=>"ID/PASSPORT"
						);
						$this->SqlModel->insertRecord(prefix."tbl_mem_kyc",$data);
					}
			}
			
			
			
			if($_FILES['file_address']['error']=="0"){
				$ext = explode(".",$_FILES['file_address']["name"]);
				$fExtn = strtolower(end($ext));
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$file_name = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/kyc/".$file_name;
				$AR_MEM = SelectTable("tbl_mem_kyc","file_name","member_id='$member_id'");

				$final_location = $fldvPath."upload/kyc/".$AR_MEM['file_name'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
					if(move_uploaded_file($_FILES['file_address']['tmp_name'], $target_path)){
						$data = array("member_id"=>$member_id,
							"file_name"=>$file_name,
							"file_type"=>"PROOF/ADDRESS"
						);
						$this->SqlModel->insertRecord(prefix."tbl_mem_kyc",$data);
					}
			}
			
			
			set_message("success","Thank you for updating your kyc details, we will verify your details soon..");
			redirect_member("account","kyc",array());
		}
		
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		$this->load->view(MEMBER_FOLDER.'/account/kyc',$data); 	} */
	
	 public function bank(){ 
	    $model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
			//$AR_MEM = $model->getMember($member_id);
			
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/bank',$data);
	}
	
	 public function security(){ 
	    
		$model = new OperationModel();
			$member_id = $this->session->userdata('mem_id');
			$form_data = $this->input->post();
		if($form_data['submitMemberSavePassword']==1 && $this->input->post()!=''){
		   ///echo "<pre>";print_r($form_data);die;
			$old_password = FCrtRplc($form_data['old_password']);
			$user_password = FCrtRplc($form_data['user_password']);
			$confirm_user_password = FCrtRplc($form_data['confirm_user_password']);	
			if($old_password!=$user_password){
			 	if($user_password == $confirm_user_password){   
				if($model->checkOldPassword($member_id,$old_password)>0){
				
					$data = array("user_password"=>$user_password
						
					);
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Your Password has been changed successfully !");
					redirect_member("account","security","");  }
				else{
					set_message("warning","Invalid old password");
					redirect_member("account","security",""); 
				}
			}
			else{
			    set_message("warning","New password and confirm-password does not match ");
				redirect_member("account","security",""); 
			}
			}
			else{
				set_message("warning","New password must be different form old-password");
				redirect_member("account","security",""); 
			}
		}
		
			if($form_data['submitMemberSaveMobile']==1 && $this->input->post()!=''){
		   //echo "<pre>";print_r($form_data);die;
			$password = FCrtRplc($form_data['password']);
			$mobile = FCrtRplc($form_data['new_mobile']);
			//$confirm_user_password = FCrtRplc($form_data['confirm_user_password']);	
			
			
				if($model->checkOldPassword($member_id,$password)>0){
				
					$data = array("member_mobile"=>$mobile
						
					);
				//	echo "<pre>";print_r($data);die;
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Your Mobile no has been changed successfully !");
					redirect_member("account","security","");  }
				else{
					set_message("warning","Invalid user password");
					redirect_member("account","security",""); 
				}
		
			
		
		}
		
			if($form_data['submitMemberSaveEmail']==1 && $this->input->post()!=''){
		   //echo "<pre>";print_r($form_data);die;
			$password = FCrtRplc($form_data['password']);
			$user_email = FCrtRplc($form_data['user_email']);
			//$confirm_user_password = FCrtRplc($form_data['confirm_user_password']);	
			
			
				if($model->checkOldPassword($member_id,$password)>0){
				
					$data = array("member_email"=>$user_email
						
					);
				//	echo "<pre>";print_r($data);die;
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Your Mobile no has been changed successfully !");
					redirect_member("account","security","");  }
				else{
					set_message("warning","Invalid user password");
					redirect_member("account","security",""); 
				}
		
			
		
		}
		
		
        	$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
	//	echo "<pre>";print_r($fetchRow);die;
    	$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/security',$data);
	}
	
	 public function kyc(){
		
	    $model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
			$AR_MEM = $model->getMember($member_id);
			if($form_data['updateImage']==1 && $this->input->post()!=''){
			$fldvPath = "";
			if($_FILES['avatar_name']['error']=="0"){
				$ext = explode(".",$_FILES['avatar_name']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member/".$photo;
				
				$AR_MEM = SelectTable("tbl_members","photo","member_id='$member_id'");

				$final_location = $fldvPath."upload/member/".$AR_MEM['photo'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['avatar_name']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("photo"=>$photo),array("member_id"=>$member_id));
						set_message("success","Successfully updated profile Image !");
						redirect_member("account","kyc",array());
						
					}
				}
			}
		}
		
	 
		
		if($form_data['updateid']==1 && $this->input->post()!=''){
			$type = FCrtRplc($form_data['type']);
			$no = FCrtRplc($form_data['id_no']);
			$data = array(
			    "id_type"=>$type,
				"id_no"=>$no
				
			);	
				if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
				$fldvPath = "";
			
			if($_FILES['id_file']['error']=="0"){
				$ext = explode(".",$_FILES['id_file']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member_id/".$photo;
				
				$AR_MEM = SelectTable("tbl_members","id_file","member_id='$member_id'");

				$final_location = $fldvPath."upload/member_id/".$AR_MEM['id_file'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['id_file']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("id_file"=>$photo),array("member_id"=>$member_id));
					
						
					}}
			}
				set_message("success","Successfully updated member  Identity");
				redirect_member("account","kyc",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","kyc",array());
			}		
		        

		}

       	if($form_data['updatepan']==1 && $this->input->post()!=''){ 
			$no = FCrtRplc($form_data['pan_no']);
			$dob = FCrtRplc($form_data['pan_dob']);
			$data = array(
			    "pan_no"=>$no,
				"pan_dob"=>$dob
				
			);	
				if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
				$fldvPath = "";
			
			if($_FILES['pan_file']['error']=="0"){
				$ext = explode(".",$_FILES['pan_file']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member_id/".$photo;
				
				$AR_MEM = SelectTable("tbl_members","pan_file","member_id='$member_id'");

				$final_location = $fldvPath."upload/member_id/".$AR_MEM['pan_file'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['pan_file']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("pan_file"=>$photo),array("member_id"=>$member_id));
					
						
					}}
			}
				set_message("success","Successfully updated member  Pan");
				redirect_member("account","kyc",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","kyc",array());
			}		
		        

		}
             


 	if($form_data['updatebank']==1 && $this->input->post()!=''){ 
			$bank_acct_holder = FCrtRplc($form_data['bank_acct_holder']);
			$branch = FCrtRplc($form_data['branch']);
			$ifc_code = FCrtRplc($form_data['ifc_code']);
			$bank_name= FCrtRplc($form_data['bank_name']);
			$account_number= FCrtRplc($form_data['account_number']);
			$data = array(
			    "bank_acct_holder"=>$bank_acct_holder,
			    "branch"=>$branch,
			    "ifc_code"=>$ifc_code,
			    "bank_acct_holder"=>$bank_acct_holder,
				"bank_name"=>$bank_name,
				"account_number"=>$account_number
				
			);	
				if($member_id>0){
				$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
				$fldvPath = "";
			
			if($_FILES['bank_file']['error']=="0"){
				$ext = explode(".",$_FILES['bank_file']["name"]);
				$fExtn = strtolower(end($ext));
				if($fExtn=='png' or $fExtn=='gif' or $fExtn=='jpeg' or $fExtn=='jpg'){
				$fldvUniqueNo = UniqueId("UNIQUE_NO");
				$photo = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
				$target_path = $fldvPath."upload/member_id/".$photo;
				
				$AR_MEM = SelectTable("tbl_members","bank_file","member_id='$member_id'");

				$final_location = $fldvPath."upload/member_id/".$AR_MEM['bank_file'];
				$fldvImageArr= @getimagesize($final_location);
				if ($fldvImageArr['mime']!="") { @chmod($final_location,0777);	@unlink($final_location); }
				
					if(move_uploaded_file($_FILES['bank_file']['tmp_name'], $target_path)){
					
						$this->SqlModel->updateRecord(prefix."tbl_members",array("bank_file"=>$photo),array("member_id"=>$member_id));
					
						
					}}
			}
				set_message("success","Successfully updated member  Pan");
				redirect_member("account","kyc",array());
			}else{
				set_message("warning","Unable to update, please try again");
				redirect_member("account","kyc",array());
			}		
		        

		}
		
		
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		//echo "<pre>";print_r($fetchRow);die;
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/mem_kyc',$data);
	}
	
	 public function copykyc(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		if($form_data['submitKycCopy']!='' && $this->input->post()!=''){
			$user_id_ref = FCrtRplc($form_data['user_id_ref']);
			$user_password_ref = FCrtRplc($form_data['user_password_ref']);
			$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE 
			( tm.user_id LIKE '$user_id_ref' OR tm.member_email LIKE '$user_id_ref' OR tm.user_name LIKE '$user_id_ref' ) 
			AND tm.user_password='$user_password_ref' AND tm.delete_sts>0";
			$AR_RT = $this->SqlModel->runQuery($QR_CHECK,true);
			
			
			$member_id_ref = $AR_RT['member_id'];
			if($member_id_ref>0){
				$QR_KYC = "SELECT COUNT(tmk.kyc_id) AS fldiCtrl FROM tbl_mem_kyc AS tmk WHERE tmk.member_id='".$member_id."' AND tmk.approved_sts=0";
				$AR_KYC = $this->SqlModel->runQuery($QR_KYC,true);
				if($AR_KYC['fldiCtrl']==0){
					$QR_NEW_KYC = "SELECT tmk.* FROM tbl_mem_kyc AS tmk WHERE tmk.member_id='".$member_id."'";
					$RS_OLD_KYC = $this->SqlModel->runQuery($QR_NEW_KYC);
					if(count($RS_OLD_KYC)>0){
						foreach($RS_OLD_KYC as $AR_NEW_KYC):
							$data = array("member_id"=>$member_id_ref,
								"file_name"=>$AR_NEW_KYC['file_name'],
								"file_type"=>$AR_NEW_KYC['file_type'],
								"file_name"=>$AR_NEW_KYC['file_name'],
								"approved_date"=>$AR_NEW_KYC['approved_date'],
								"approved_sts"=>$AR_NEW_KYC['approved_sts']
							);
							$this->SqlModel->insertRecord(prefix."tbl_mem_kyc",$data);
						endforeach;
						set_message("success","We have successfully add kyc to this user id : ".$user_id_ref."");
						redirect_member("account","kyc","");
					}else{
						set_message("warning","Unable to process your request, please try again");
						redirect_member("account","kyc","");	
					}	
				}else{
					set_message("warning","it seem , your KYC is in pending stage");
					redirect_member("account","kyc","");	
				}
			}else{
				set_message("warning","Invalid login credentials");
				redirect_member("account","kyc","");
			}
		}
	}
	
	 public function paymentsetting(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		if($form_data['submitPaymentSetting']==1 && $this->input->post()!=''){
			$account_number = FCrtRplc($form_data['account_number']);
			$bitcoin_address = FCrtRplc($form_data['bitcoin_address']);
			$data = array("account_number"=>$account_number,"bitcoin_address"=>$bitcoin_address);
			if($member_id>0){
				$message = "1";
				try{
					validate($bitcoin_address);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Your wallet successfully updated");
					redirect_member("account","paymentsetting",array("member_id"=>$member_id));
				}catch(\Exception $e){ 
					$message =  "Your Bitcoin address is invalid enter another address";
				}	
			}	
			set_message("warning",$message);
			redirect_member("account","paymentsetting",array("member_id"=>$member_id));
			
		}
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/paymentsetting',$data);
	}
	
	 public function currentplan(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$QR_CHECK = "SELECT tm.*, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 WHERE tm.member_id='".$member_id."'  ORDER BY tm.member_id ASC";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		$QR_PLAN = "SELECT tp.package_name, ts.* FROM ".prefix."tbl_package AS tp 
					LEFT JOIN  ".prefix."tbl_subscription AS ts ON tp.package_id=ts.package_id WHERE 
					tp.package_id='".$fetchRow['package_id']."' AND ts.member_id='".$fetchRow['member_id']."'";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		$data['PLAN']=$AR_PLAN;
		
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/currentplan',$data);
	}
	
	 public function accountsetting(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		if($form_data['saveConfig']==1 && $this->input->post()!=''){
			
			$model->setConfigMember("EMAIL_FROM_COMPANY",FCrtRplc($form_data['EMAIL_FROM_COMPANY']));
			$model->setConfigMember("EMAIL_FROM_UPLINE",FCrtRplc($form_data['EMAIL_FROM_UPLINE']));
			$model->setConfigMember("LOG_IP",FCrtRplc($form_data['LOG_IP']));
			$model->setConfigMember("NOTIFY_CHANGES",FCrtRplc($form_data['NOTIFY_CHANGES']));
			$model->setConfigMember("DISPLAY_NAME",FCrtRplc($form_data['DISPLAY_NAME']));
			$model->setConfigMember("DISPLAY_EMAIL",FCrtRplc($form_data['DISPLAY_EMAIL']));
			set_message("success","Successfully updated changes");
			redirect_member("account","accountsetting","");
		}
		
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/accountsetting',$data);
	}
	
	 public function changepassword(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		
		if($form_data['submitMemberSavePassword']==1 && $this->input->post()!=''){
			$old_password = FCrtRplc($form_data['old_password']);
			$user_password = FCrtRplc($form_data['user_password']);
			$confirm_user_password = FCrtRplc($form_data['confirm_user_password']);	
			if($old_password!=$user_password){
				if($model->checkOldPassword($member_id,$old_password)>0){
					$data = array("user_password"=>$user_password);
					$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
					set_message("success","Password changed successfully");
					redirect_member("account","changepassword",""); 
				}else{
					set_message("warning","Invalid old password");
					redirect_member("account","changepassword",""); 
				}
			}else{
				set_message("warning","New password must be different form old-password");
				redirect_member("account","changepassword",""); 
			}
		}
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/changepassword',$data);
	}
	
	 public function transactionpassword(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$AR_MEM = $model->getMember($member_id);
		
		if($form_data['submitMemberSavePassword']==1 && $this->input->post()!=''){
			$old_password = FCrtRplc($form_data['old_password']);
			$trns_password = FCrtRplc($form_data['trns_password']);
			$confirm_trns_password = FCrtRplc($form_data['confirm_trns_password']);	
			if($old_password!=$trns_password){
				if($model->checkTrnsPassword($member_id,$old_password)>0){
					$sms_otp = $model->sendTransactionSMS($AR_MEM['mobile_number']);
					$data = array("member_id"=>$member_id,
						"new_password"=>$trns_password,
						"sms_otp"=>$sms_otp,
						"sms_type"=>"TRNS",
						"mobile_number"=>$AR_MEM['mobile_number']
					);
					$request_id = $this->SqlModel->insertRecord(prefix."tbl_sms_otp",$data);
					set_message("success","Please verify OTP from your email address");
					redirect_member("dashboard","verifyotp",array("request_id"=>_e($request_id))); 
				}else{
					set_message("warning","Invalid old password");
					redirect_member("account","transactionpassword",""); 
				}
			}else{
				set_message("warning","New password must be different form old-password");
				redirect_member("account","transactionpassword",""); 
			}
		}
		
		$QR_CHECK = "SELECT tm.* FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true);
		$data['ROW']=$fetchRow;
		
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/transactionpassword',$data);
	}
	
	 public function userlogs(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/userlogs',$data);
	}
	
	 public function news(){
		$this->load->view(MEMBER_FOLDER.'/account/news',$data);
	}
	
	 public function newsdetails(){
		$this->load->view(MEMBER_FOLDER.'/account/newsdetails',$data);
	}
	
	 public function faq(){
		$this->load->view(MEMBER_FOLDER.'/account/faq',$data);
	}
	
	 public function ppt(){
		$this->load->view(MEMBER_FOLDER.'/account/ppt',$data);
	}
	
	 public function upgradepackage(){
		$this->load->view(MEMBER_FOLDER.'/account/upgradepackage',$data);
	}
	
	 public function paymentpackage(){
	    
	    	//$this->load->view(MEMBER_FOLDER.'/account/profile',$data);
		$this->load->view(MEMBER_FOLDER.'/account/paymentpackage',$data);
	}
	
	 public function welcomeletter(){
		$this->load->view(MEMBER_FOLDER.'/account/welcomeletter',$data);
	}
	
	 public function autopackage(){
		$model = new OperationModel();
		$today_date = InsertDate(getLocalTime());
		
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$AR_MEM = $model->getMember($member_id);
		$type_id = $this->session->userdata('type_id');
		$AR_PACK = $model->getPackage($type_id);
		if($type_id>0 && $AR_MEM['subcription_id']==0){
			$AR_SEND['deposit_amount'] = $AR_PACK['pin_price'];
			$AR_SEND['type_id'] = $AR_PACK['type_id'];
			
    		$data['POST'] = $AR_SEND;
    		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
    		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
    		$data['first_name']=$fR;

			$this->load->view(MEMBER_FOLDER.'/payment/coinpaymentupgrademembership',$data);
		}else{
			redirect(MEMBER_PATH);
		}
	}
	
	 public function referrallink(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/referrallink',$data);
	}
	
	 public function referralbanner(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/referralbanner',$data);
	}
	
	 public function facebookupdate(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/facebookupdate',$data);
	}
	
	 public function twitterupdate(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$fetchRow = $model->getMember($member_id);
		$data['ROW']=$fetchRow;
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		$this->load->view(MEMBER_FOLDER.'/account/twitterupdate',$data);
	}
	
   public function upgradememberpackageold(){
		$model = new OperationModel();
            $AR_PRSS = $model->getProcess();
            $process_id = $AR_PRSS['process_id'];
            $end_date=$AR_PRSS['end_date'];
		
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
	  	$today_date =date('Y-m-d');// getLocalTime(); 
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
	//	$package_price = FCrtRplc($form_data['package_price']);
	  	$member_id = $this->session->userdata('mem_id'); $member_ids =  	$member_id ;
		$order_no = rand(111111,9999999); 
	    $sts = $model->getactivationSts($member_id);
		if($model->getValue("member_activation_on_off")=='Y' or   $sts =='N'){
		if($form_data['upgradeMemberShip']==1 && $this->input->post()!=''){
		    
		  //  set_message("warning",".");
				//  	redirect_member("dashboard","index","");
		    
		       
			   	$memberId = $model->getMemberId($form_data['member_id']);
				$AR_TYPE = $model->getCurrentMemberShip($memberId);
				$pin_activation = ($AR_TYPE['type_id']>0)? 0:30;
				$type_id = ($form_data['type_id']);
				$AR_PACK = $model->getPackage($type_id);
				$package_price = FCrtRplc($AR_PACK['pin_price']);
			    $trns_password = $form_data['trns_password'];
			      $roi_stacking = $form_data['roi_stacking'];
				$no_pin = FCrtRplc($form_data['no_pin']);
				$pin_key = FCrtRplc($form_data['pin_key']);
			    //$wallet_id = FCrtRplc($form_data['wallet_id']);
				//$wallet_id  = 3;//($wallet_id =='EGP')?1:3;
			//	PrintR($AR_PACK);die;
			
              	$stacking_days = $form_data['stacking_days'];
				
				$LDGR1 = $model->getCurrentBalancewal($member_id,'3',$_REQUEST['from_date'],$_REQUEST['to_date']);
			    $LDGR2 = $model->getCurrentBalancewal($member_id,'4',$_REQUEST['from_date'],$_REQUEST['to_date']);
			    $mainwallet=$package_price*90/100;
			    $airdrop=$package_price*10/100;
                if($LDGR1['net_balance']  <   ($package_price*90/100) )
				{
				    
				  set_message("warning","You have low Balance.");
				 	redirect_member("dashboard","index","");   
				}
				
				if($airdrop < ($LDGR2['net_balance'])){
				 if($LDGR2['net_balance']  <   ($package_price*10/100) )
				{
				    
				  set_message("warning","You have low Balance $airdrop");
				 	redirect_member("dashboard","index","");   
				}
				}
	$sub = $model->checkCount('tbl_subscription','member_id',$member_id);
	 $sub1   = $model->getLastMembertypeid($member_id,$type_id);
				   if($sub == '0')
			    { 
			        if($type_id == '1')
			        { 
                        
			        }else{
			            set_message("warning","Please Activate First Package from $ 10/-");
                       	redirect_member("dashboard","index","");  
			        }
			    }
			    elseif($sub == '1')
			    {
			       if($type_id == '2')
			        { 
                        
			        }else{
			            set_message("warning","Please Activate First Package from $ 20/-");
                        	redirect_member("dashboard","index","");  
			        }
			    }
				elseif($sub == '2')
			    {
			        if($type_id == '3')
			        { 
                        
			        }else{
			            set_message("warning","Please Activate First Package from $ 40/-");
                     	redirect_member("dashboard","index","");  
			        }
			    }	elseif($sub == '3')
			    {
			        if($type_id == '4')
			        { 
                        
			        }else{
			            set_message("warning","Please Activate First Package from $ 80/-");
                       	redirect_member("dashboard","index","");  
			        }
			    }
			    	elseif($sub == '4')
			    {
			        if($type_id == '5')
			        { 
                        
			        }else{
			            set_message("warning","Please Activate First Package from $ 160/-");
                       	redirect_member("dashboard","index","");  
			        }
			    }
			   	elseif($sub == '5')
			    {
			        if($type_id >= '5')
			        { 
                        
			        }else{
			            set_message("warning","You Can Only upgrade with $ 160");
                        redirect_member("dashboard","index",""); 
			        }
			    }
			    	elseif($sub >= '5')
			    {
			        if($sub1 == '5')
			        { 
                        
			         }else{
			             set_message("warning","You Can Only upgrade with $ 160");
                        redirect_member("dashboard","index",""); 
			        }
			    }
			 	if($sub <= '0' )
				{
				$type = 'A';
				} 
				else
				{
				 $type = 'U';  
				}
			  					
								if($model->checkUserPassword($member_id,$trns_password) > 0) {
								    //	if(true){
							//	 if($model->checkCount('tbl_subscription','member_id',$memberId)==0){
							  	if(true){
									$order_no = UniqueId("ORDER_NO");
									
									$invest_bonus = $AR_PACK['invest_bonus'];
									$reinvest_amt = ($AR_PACK['pin_price']*$AR_PACK['invest_bonus']/100);
									$total_invest = $AR_PACK['pin_price']+$reinvest_amt;
									
								 
									
									
									$data_sub = array(
						"order_no"=>$order_no,
						"member_id"=>$memberId,
						"type_id"=>$type_id,
						"active_type_id" =>$type_id , 
						"package_price"=>$package_price,
						"net_amount"=>$package_price,
						"reinvest_amt"=>$package_price,
						"total_amt"=>$package_price,
						"prod_pv"=>$package_price,
						"date_from"=>$today_date,
							"type" => $type,
						"date_expire"=>$date_expire,
							"roi_stacking"=>0,
								"stacking_days"=>$stacking_days,
						"active_by"  => $member_ids
					);
					
									
									
			$subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub);
			
// TRUNCATE tbl_level_members;
// INSERT INTO `tbl_level_members` (`id`, `member_id`, `spill_id`, `ref_id`, `position`, `t_count`, `entry_type`, `amount`, `date_time`) VALUES (NULL, '1', '0', '1', '2', '1', 'A', '30', '2023-02-05 00:00:00'), (NULL, '1', '0', '2', '2', '1', 'A', '60', '2023-02-05 00:00:00'), (NULL, '1', '0', '3', '2', '1', 'A', '120', '2023-02-05 00:00:00'), (NULL, '1', '0', '4', '2', '1', 'A', '240', '2023-02-05 00:00:00'), (NULL, '1', '0', '5', '2', '1', 'A', '480', '2023-02-05 00:00:00');





// TRUNCATE tbl_subscription;
// INSERT INTO `tbl_subscription` (`subcription_id`, `order_no`, `member_id`, `type_id`, `roi_stacking`, `type`, `package_id`, `package_price`, `prod_pv`, `net_amount`, `reinvest_amt`, `total_amt`, `date_from`, `date_expire`, `date_time`, `isActive`, `isDirect`, `isReferral`, `isSetPV`, `single_id`, `active_by`, `active_type_id`, `bulk_by`, `b_sts`, `manual_p`) VALUES (NULL, '1234567', '1', '1', 'S', 'A', '1', '30', '30', '30', '30', '30', '2023-02-02 00:00:00', '2024-02-05 16:32:48', '2023-02-05 16:31:26', '1', '0', 'Y', 'N', '0', '0', '1', '0', 'N', '0'), (NULL, '1234567', '1', '2', 'S', 'A', '1', '60', '60', '60', '60', '60', '2023-02-02 00:00:00', '2024-02-05 16:32:48', '2023-02-05 16:31:26', '1', '0', 'Y', 'N', '0', '0', '1', '0', 'N', '0'), (NULL, '1234567', '1', '3', 'S', 'A', '1', '120', '120', '120', '120', '120', '2023-02-02 00:00:00', '2024-02-05 16:32:48', '2023-02-05 16:31:26', '1', '0', 'Y', 'N', '0', '0', '1', '0', 'N', '0'), (NULL, '1234567', '1', '4', 'S', 'A', '1', '240', '240', '240', '240', '240', '2023-02-02 00:00:00', '2024-02-05 16:32:48', '2023-02-05 16:31:26', '1', '0', 'Y', 'N', '0', '0', '1', '0', 'N', '0'), (NULL, '1234567', '1', '5', 'S', 'A', '1', '480', '480', '480', '480', '480', '2023-02-02 00:00:00', '2024-02-05 16:32:48', '2023-02-05 16:31:26', '1', '0', 'Y', 'N', '0', '0', '1', '0', 'N', '0')
if(true){

			
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
                                                            "member_id"       =>$memberId,
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
                                                

                                                
                                                
                                               
                                               $SP = $this->SqlModel->runQuery("SELECT id,ref_id,member_id,spill_id,position,t_count FROM `tbl_level_members` WHERE id ='$spill_id' ORDER BY id DESC LIMIT 1",true);       
                                              
                                             $slot = $SP['t_count'];
                                             
                                  
                                             
if($package_price==10){if($slot==1){$bprice=1;}if($slot==2){$bprice=2;} if($slot==3){$bprice=3;} if($slot==4){$bprice=4;}if($slot==5){$bprice=5;}if($slot==6){$bprice=6;}if($slot==7){$bprice=7;} }
if($package_price==20){if($slot==1){$bprice=2;}if($slot==2){$bprice=4;} if($slot==3){$bprice=6;} if($slot==4){$bprice=8;}if($slot==5){$bprice=10;}if($slot==6){$bprice=12;}if($slot==7){$bprice=14;} }
if($package_price==40){if($slot==1){$bprice=4;}if($slot==2){$bprice=8;} if($slot==3){$bprice=12;} if($slot==4){$bprice=16;}if($slot==5){$bprice=20;}if($slot==6){$bprice=24;}if($slot==7){$bprice=28;} }
if($package_price==80){if($slot==1){$bprice=8;}if($slot==2){$bprice=16;} if($slot==3){$bprice=24;} if($slot==4){$bprice=32;}if($slot==5){$bprice=40;} if($slot==6){$bprice=48;}if($slot==7){$bprice=56;}}
if($package_price==160){if($slot==1){$bprice=16;}if($slot==2){$bprice=32;} if($slot==3){$bprice=48;} if($slot==4){$bprice=64;}if($slot==5){$bprice=80;}if($slot==6){$bprice=96;}if($slot==7){$bprice=112;} }

                          
                                             
                                               $Remark = "Pool $ $package_price Slot ".$SP['t_count']." Credit";
                                               
                                               
                                               
                                               
                                               
                                               
                                          $model->wallet_transaction(1,'Cr',$SP['member_id'],$bprice,$Remark,date('Y-m-d'),rand(),'1',"Pool");  
                                          
                                          
                                               if($SP['t_count']+1 <= 7)
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
		
			  // $toId = $model->getSponsorId($memberId);
                      //  DirectReferralDistribution($subcription_id,$memberId,$toId,$package_price,$process_id,$end_date);
		$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$memberId));
    		  		        // updateDirectCounts(); 
			//  instantIncomeGenertenextg($memberId,$package_price,$subcription_id,$type_id);
		
			 instantIncomeGenerte($member_id,$package_price,$subcription_id,$type_id);
          //  $trans_no = UniqueId("TRNS_NO");
            //$memberdetail   = $model->getmemberContact($memberId);
            $trns_remark = "Activation ". $memberdetail['user_id'];
            
//             $mainwallet
// $airdrop
            
            
            
              $model->wallet_transaction('3',"Dr",$member_id,$package_price,$trns_remark,$today_date,$trans_no,1,"ID_ACTIVE"); 
            
            
           //	if($airdrop < ($LDGR2['net_balance'])){
           	    
           	  //  $model->wallet_transaction('3',"Dr",$member_id,$package_price*90/100,$trns_remark,$today_date,$trans_no,1,"ID_ACTIVE");  
           	    
           	// }else{
           	    
           	//      $model->wallet_transaction('3',"Dr",$member_id,$package_price,$trns_remark,$today_date,$trans_no,1,"ID_ACTIVE"); 
           	// }
            
            
            //   if($airdrop < ($LDGR2['net_balance'])){
           
            // //	if($LDGR2['net_balance']>0){
            //   $model->wallet_transaction('4',"Dr",$member_id,$package_price*10/100,$trns_remark,$today_date,$trans_no,1,"ID_ACTIVE"); 
              
            // 	}
          // setupBusiness($subcription_id,$memberId,$package_price);
           
  
// 										$remark = "Education Wallet";
// 			 $package_price =  $package_price*0.2;
// 			$model->wallet_transaction(4,"Cr",$member_iddd,$package_price,$remark,date('Y-m-d'),$order_no_dca,"1","Education Wallet"); 
									set_message("success","You have successfully Top Member package");
							 	redirect_member("dashboard","index","");  
								
								
								}
								else
								{
								set_message("warning","Allready Topup this account ...");
							 	redirect_member("dashboard","index","");  
								}
								
								}
								else
								{
								set_message("warning","Invalid Login Password ...");
							 	redirect_member("dashboard","index","");  
								}
						 
			 
			
		}
		
		
	   }
else{
		      
		    set_message("warning","Activation unavailable");
		   	redirect_member("dashboard","index","");   
		  }
        
// 		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
// 		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
// 		$data['first_name']=$fR;

// 		$data['web_title'] = 'Activataion';
 	//	$this->load->view(MEMBER_FOLDER.'/account/upgrademember',$data);
	}
			 public function upgradememberpackage(){
		$model = new OperationModel();
            $AR_PRSS = $model->getProcess();
            $process_id = $AR_PRSS['process_id'];
            $end_date=$AR_PRSS['end_date'];
		
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
	  	$today_date =date('Y-m-d');// getLocalTime(); 
		$date_expire = InsertDate(AddToDate($today_date,"+ 1 Year"));
 
	  	$member_id = $this->session->userdata('mem_id'); $member_ids =  	$member_id ;
		$order_no = rand(111111,9999999); 
		
	    $sts = $model->getactivationSts($member_id);
		if($model->getValue("member_activation_on_off")=='Y' or   $sts =='N'){
		if($form_data['upgradeMemberShip']==1 && $this->input->post()!=''){
		   // PrintR($form_data);
		  //   die;
		    
		    
			 //   set_message("warning","System is upgrading Please wait utill the updates");
				 //	redirect_member("dashboard","index",""); 
		    
		    
		    if($form_data['topup']=='topup'){
		          
			   	$memberId = $model->getMemberId($form_data['member_id']);
				$AR_TYPE = $model->getCurrentMemberShip($memberId);
				$pin_activation = ($AR_TYPE['type_id']>0)? 0:30;
				$type_id = ($form_data['type_id']);
    			$AR_PLAN =  $model->getCurrentMemberShip($member_id);
    			$old_type_id = ($AR_PLAN['type_id']>0)? $AR_PLAN['type_id']:0;
				$AR_PACK = $model->getPackage($type_id);
				$package_price = FCrtRplc($AR_PACK['pin_price']);
			if($type_id==3){
				$package_price1 =	$package_price = FCrtRplc($form_data['package_price']);
			}else{
				$package_price = FCrtRplc($AR_PACK['pin_price']);
				
				
			}
				
				
			    $trns_password = $form_data['trns_password'];
			      $roi_stacking = $form_data['roi_stacking'];
				$no_pin = FCrtRplc($form_data['no_pin']);
				$pin_key = FCrtRplc($form_data['pin_key']);
			    //$wallet_id = FCrtRplc($form_data['wallet_id']);
				//$wallet_id  = 3;//($wallet_id =='EGP')?1:3;
			//	PrintR($AR_PACK);die;
			
              	$stacking_days = $form_data['stacking_days'];
				
				$LDGR1 = $model->getCurrentBalancewal($member_id,'3',$_REQUEST['from_date'],$_REQUEST['to_date']);
			 $LDGR2 = $model->getCurrentBalancewal($member_id,'4',$_REQUEST['from_date'],$_REQUEST['to_date']);
			  
              if($LDGR1['net_balance']  <   ($package_price) )
				{
				    
				  set_message("warning","You have low Balance.");
				 	redirect_member("dashboard","index","");   
				}
			 if($type_id !=0)
				{	
			//	echo $old_type_id; die;
			if ($type_id >= $old_type_id) {
    // Valid upgrade
} else {
    set_message("warning", "Upgrade Only Same And Above");
    redirect_member("dashboard", "index", "");
}
				}
	$sub = $model->checkCounttopup('tbl_subscription','member_id',$member_id,'N');
	 $sub1   = $model->getLastMembertypeid($member_id,$type_id);
			
			if($type_id ==3){ 
			    
			    if($package_price1 >= 111  ){ 
			    
			    
			    
			    
			}
			    else{
                set_message("warning","Package Amount Should be more than $ 111");
          		redirect_member("dashboard","index","");  
            
            }  
			    
			}
         
      
			
				
            
        // if($type_id =='1' and $package_price >= 50000 and $package_price <= 1900000){}
        //  elseif($type_id =='2' and $package_price >= 2000000  and $package_price <= 4900000){}
        //   elseif($type_id =='3'  and $package_price >= 5000000 ){ }
        //   elseif($type_id =='5'  and $package_price >= 5000000 ){ }
        //     elseif($type_id =='6'  and $package_price >= 20000000 ){ }
        // else{
        //     set_message("warning","please select correct package");
        //   		redirect_member("dashboard","index","");  
            
        //     }
			
			
			
			
		 
			   	  if($package_price % 11 != 0)      {
			       
			     	  if($package_price==0){
			      
			        set_message("warning","Package Should be Multiple Of $ 11");
                         redirect_member("dashboard","index",""); 
			      
			  }
			    
			  
			      
			      
			  }else{
			      
			     set_message("warning","Package Should be Multiple Of $ 11");
                         redirect_member("dashboard","index",""); 
			      
			  }	 
			      	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			 	if($sub <= '0' )
				{
				$type = 'A';
				} 
				else
				{
				 $type = 'U';  
				}
			  					
							//	if($model->checkUserPassword($member_id,$trns_password) > 0) {
								   	if(true){
							//	 if($model->checkCount('tbl_subscription','member_id',$memberId)==0){
							  
		$getMemberdetail   = $model->getMemberdetail($member_id);
			$x_income =  $getMemberdetail['x_income'];    
			
			if($x_income==0){
			    
			    $x_income=200;
			}else{
			    
			   	$x_income =  $getMemberdetail['x_income'];   
			    
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
							"pool"=>'N',
							 "x_rank"=>$x_income,
                        "x_income"=>$package_price*$x_income/100,
							"roi_stacking"=>0,
						"date_expire"=>$date_expire,
                        
                       
					);
					
						 $subcription_id = $this->SqlModel->insertRecord(prefix."tbl_subscription",$data_sub); 
						 
				
				
					
					    if($sub == '0')
			    { 

					
					
					if($type == 'A')
					{
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price-10,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}
					else
					{
					    $this->db->query("UPDATE `tbl_members` SET   `prod_pv` = prod_pv + $package_price-10 WHERE  member_id ='$member_id';"); 
					    
					    
					    
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price-10,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}
					
			    }else{
			        
			     	
					if($type == 'A')
					{
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}
					else
					{
					    $this->db->query("UPDATE `tbl_members` SET   `prod_pv` = prod_pv + $package_price WHERE  member_id ='$member_id';"); 
					    
					    
					    
					    	$update_data =array("type_id"=>$type_id,"subcription_id"=>$subcription_id,"prod_pv"=>$package_price,"block_sts"=>'N');
    		  		    $this->SqlModel->updateRecord(prefix."tbl_members",$update_data,array("member_id"=>$member_id));
					}   
			        
			        
			    }
			     $trns_remark = "Activation ". $memberdetail['user_id'];
			  $model->wallet_transaction('3',"Dr",$member_id,$package_price,$trns_remark,$today_date,$trans_no,1,"ID_ACTIVE"); 	
			    
			  
           
			    
			    //   instantDirectIncomeGenerte($member_id,$package_price,$subcription_id,$type_id);
				  set_message("success","You have successfully Top Member package");
							 	redirect_member("dashboard","index","");  
			    
								
								}
								else
								{
								set_message("warning","Invalid Login Password ...");
							 	redirect_member("dashboard","index","");  
								}
						 
			  
		        
		    }
		    
		    
		    
		    
		    
		    
			
		}
		
		
	   }
else{
		      
		    set_message("warning","Activation unavailable");
		   	redirect_member("dashboard","index","");   
		  }
        
// 		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
// 		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
// 		$data['first_name']=$fR;

// 		$data['web_title'] = 'Activataion';
 	//	$this->load->view(MEMBER_FOLDER.'/account/upgrademember',$data);
	}
	  public function addfund()
	  {
	    $model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		
          //  set_message("warning","Please try some time later we upgrading software ! .");
          	redirect_member("dashboard","",""); 
		
		
		$this->load->view(MEMBER_FOLDER.'/account/addfund',$data);
	  
	  }
	

	 public function saledistribution(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);

        $member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		
		$this->load->view(MEMBER_FOLDER.'/account/saledistribution',$data);
	}	

	 public function check_user(){
	    $model = new OperationModel();
	    $mem_id = $this->input->post('mem');
	    $res = $model->checkMemberIdexist($mem_id);
	    if(isset($res))
	    {
	     echo $res;   
	    }
	    else
	    {
	       echo "Invalid Member Id..."; 
	    }
	    
	}
		
	 public function getselectedpackage(){
	    $model = new OperationModel();
	    $id = $this->input->post('id');
		if($id > 0)
		{
	if($id=='1'){$status = 'Silver';}elseif($id=='2'){$status = 'Gold';}elseif($id=='3'){$status = 'Diamond';}
	     $QR_CHECK = "SELECT * from tbl_pintype WHERE pin_name='".$status."' ORDER BY mrp ASC";
		$fR = $this->SqlModel->runQuery($QR_CHECK,false); 
		
          $i=1;
        		foreach($fR as $f){
				if($i =='1')
				{
				$data['product'] = $f['product'];
				}
				$i++;
        		   $data['type'] .= "<option value='" . $f['type_id'] ."'>" . $f['pin_name'] ." [" . $f['pin_price'] ." BV ] [ Rs. " . $f['mrp'] ." ]</option>";
        		}
				echo json_encode($data);
				
	    }
	    else
	    {
		   $data['product'] = ' Select Package';
	       $data['type'] =  "<option value='0'>---Select---</option>	"; 
		   echo json_encode($data);
	    }
	    
	}
		
	 public function getproductname() {
	   $model = new OperationModel();
	    $id = $this->input->post('id');

	
	     $QR_CHECK = "SELECT * from tbl_pintype WHERE type_id='".$id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		
         echo $fR['product'];
				
	   
	  }     
	
	
}
?>
