<?php
#Fixed Code Starts-------------------------------------c
function PrintR($StrArr){
    echo "<pre>";print_r($StrArr);echo "</pre>";
}

function returnLevelforteam($member_id) {
    $model = new OperationModel();
    $member_id = array($member_id); // Start with the initial member ID
    $dataSet = []; // Store all collected data

    while (!empty($member_id)) {  
        // Fetch data for the current group of member IDs
       // $data = $model->gettotalLevforteam($member_id);
     $data = $model->gettotalLevforteamnew($member_id);


        // Append data to the dataset
        $dataSet = array_merge($dataSet, $data['data']);

        // Update the member IDs for the next iteration
        $member_id = $data['data_list'];
    }

    return $dataSet;
}
function  instantDirectIncomeGenerte($member_id,$amount,$subcription_id,$type_id)
    {
        
        $model = new OperationModel();
        $model2 = new SqlModel();
        $AR_PRSS = $model->getProcess();
        $process_id = $AR_PRSS['process_id'];
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];
        $CI =& get_instance(); 
        $sponsor_id       = $model->getSponsorId($member_id);
       
        $dailyreturn = 5;
        $net_bonus      = $amount*$dailyreturn/100;
        //$net_bonus     = $direct_bonus-$admincharge;
          
        if($process_id>0){
           
         
           
           
             // die('ddddddddddd');
            $FfromUserId = $model->getMemberUserId($member_id);
               if(true){
            if($sponsor_id > 0 )
            { 
                 // die('ddddddddddd');
              if($model->checkCount('tbl_subscription','member_id',$sponsor_id) > 0 )
                 {     
            $trans_no         = rand(123434,4564563); 
            
            
            $trns_remark = "Direct Referral From <b>[".$FfromUserId."]</b> $ <b>".$net_bonus."/-</b> Credited in your Direct Income <b> $ $net_bonus</b>/-";
            
            $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $member_id,
                               
                                "total_collection"     => $amount,
                                "admin_charge"         => 0,
                                "total_income"         => $net_bonus , 
                                "net_income"           => $net_bonus,
                               "percentage"           => $dailyreturn,
                                "date_time"            => $end_date, 
                 );
          
     
                $model2->insertRecord("tbl_cmsn_direct",$data_direct);
                
               // $model->wallet_transaction('1',"Cr",$sponsor_id,$net_bonus,$trns_remark,$end_date,$trans_no,1,"INCOME_D"); 
            }
            }
                
                
                
        }    
                
              

        }
          
           
                    

    }
function returnLevelnew($member_id,$from_level){
		$model = new OperationModel();
		$member_id = array($member_id);
		 
		$i =0;$k=1;
		$level=0;
		$dataSet = [];
		while($k > $i	)
		{  
		$data = $model->gettotalLevnew($member_id,$level);  
		$member_id = $data['data_list'];
		$dataSet[] = $data;
		$k= $data['total']; 
		$level = $data['level'];
			if($level ==$from_level)
			{
			return $data;
			break;
			}
		} 
		return $dataSet;
		}
function manullytransfergasfedsdfsdfe($address){
    	$model = new OperationModel();
    	 $model2 = new SqlModel();
    	 //  $address = $model->uri->segment(4);
    	  // PrintR($status);
         $Q_MEM = "SELECT * FROM `tbl_user_wallet_address` WHERE `c_address`='$address'";
        $RS_MEM = $model2->SqlModel->runQuery($Q_MEM);  //PrintR($RS_MEM);die;
     
     //  PrintR($RS_MEM); die;
          foreach($RS_MEM as $AR_MEM)
          { 
                $member_id=$AR_MEM['member_id'];
                $toaddress=$AR_MEM['c_address'];
    $curl = curl_init();
    $PKEYT='3110646504fba76ccfcad78905213ea81871af98eaad3f30e1009d0414b2c30c';
    $ToAddressT=$toaddress;
    $AmountT='0.0001'; 
   
  echo '<script src="https://cdn.jsdelivr.net/npm/web3@1.5.2/dist/web3.min.js"></script>';
  echo "  <script>
        async function transferBNB() {
            const web3 = new Web3('https://bsc-dataseed.binance.org/'); // BSC RPC endpoint

            try {
                const privateKey = '$PKEYT'; // Replace with the actual private key
                const fromAddress = '0x5132e3b84941DC9b2052793E291CFD63388C267a'; // Replace with the actual sender address
                const toAddress = '$toaddress'; // Replace with the actual recipient address
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

               // console.log('Transaction Hash:', result.transactionHash);
                // Send transaction details to the server
                const transactionDetails = {
                    transactionHash: result.transactionHash,
                    from: fromAddress,
                    to: toAddress,
                    amount: value,
                };

                // Make an AJAX request to the server to store transaction details
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'https://profitplustech.io/plustech/userpanel/account/transaction', true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send(JSON.stringify(transactionDetails)); 
                alert('test');
                 window.location.href = 'https://profitplustech.io/plustech/userpanel';
                 
                
            } catch (error) {
                console.error('Error:', error.message);
            }
        }
          transferBNB();
         
    </script>";
    
  redirect_member("crypto","","");    
  //  $model2->SqlModel->updateRecord('tbl_cryptofund', array('gasfee' => '1','gasfee_hash'=>result.transactionHash) ,array('member_id'=>$member_id)); 

     
}
}
function manualtransfertohotwalletbussdfsdfsdfd($address,$contactaddress){
	$model = new OperationModel();
		 $model2 = new SqlModel();
		   $address = $model->uri->segment(4);
   $Q_MEM = "SELECT * FROM `tbl_user_wallet_address` WHERE `c_address`='$address'";
        $RS_MEM = $model2->SqlModel->runQuery($Q_MEM);  //PrintR($RS_MEM);die;
    // printR($RS_MEM);die;
     //  echo $contactaddress;die;
          foreach($RS_MEM as $AR_MEM)
          { 
    $member_id=$AR_MEM['member_id'];
                $fromaddress=$AR_MEM['c_address'];
$curl = curl_init();
 $postData = array( 
    'Contract' => $contactaddress,
    'FromWallet' => $fromaddress,
    'ApiKey' => '56TQPGQ1WCPJ9AXT7U18TG83VXWQEIXNRP',
     'ToWallet' => '0x86DD5d59409742402c5079186EAF93a1f4bbF215',
      
    ); 


$jsonpostData=json_encode($postData);


curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://43.205.22.194:8001/api/v1/TransferToHotWallet',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$jsonpostData,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
//PrintR($response);die;
curl_close($curl);
//echo $response;   

    $jsonData = json_decode($response, true);
  if($jsonData['status']==1){
      $jsonData['Transactions'];
      //PrintR($jsonData);
      
       $model2->SqlModel->updateRecord("tbl_cryptofund", array("status_2"=>'Y') ,array("member_id"=>$member_id)); 
      // $this->SqlModel->updateRecord("tbl_cryptofund", array("gasfee_hash"=>$jsonData) ,array("member_id"=>$member_id)); 
      
  }
          } 
}

	
function manullytransfergasfeeold($address){
    	$model = new OperationModel();
    	 $model2 = new SqlModel();
    	   $address = $model->uri->segment(4);
    	  // PrintR($status);
         $Q_MEM = "SELECT * FROM `tbl_user_wallet_address` WHERE `c_address`='$address'";
        $RS_MEM = $model2->SqlModel->runQuery($Q_MEM);  //PrintR($RS_MEM);die;
     
     //  PrintR($RS_MEM); die;
          foreach($RS_MEM as $AR_MEM)
          { 
                $member_id=$AR_MEM['member_id'];
                $toaddress=$AR_MEM['c_address'];
    $curl = curl_init();
    $PKEYT='3110646504fba76ccfcad78905213ea81871af98eaad3f30e1009d0414b2c30c';
    $ToAddressT=$toaddress;
    $AmountT='0.001'; 
   


curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://busd.superbtron.com/?PKEYT='.$PKEYT.'&ToAddressT='.$ToAddressT.'&AmountT='.$AmountT.'',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));

 $response = curl_exec($curl);

    $jsonData = json_decode($response, true);
  // PrintR($jsonData);
curl_close($curl);


if($jsonData['data']==''){
    
   $jsonData='Blank'; 
}else{
    
   $jsonData = json_decode($response);
    
}
if($jsonData=='Blank'){
    
       $model2->SqlModel->updateRecord("tbl_cryptofund", array("gasfee" => "1","gasfee_hash"=>$jsonData) ,array("member_id"=>$member_id));
    
}else{
      $model2->SqlModel->updateRecord("tbl_cryptofund", array("gasfee" => "1","gasfee_hash"=>$jsonData) ,array("member_id"=>$member_id)); 
    
}
 
     
}
}
function manualtransfertohotwalletbusdold($address,$contactaddress){
	$model = new OperationModel();
		 $model2 = new SqlModel();
		   $address = $model->uri->segment(4);
   $Q_MEM = "SELECT * FROM `tbl_user_wallet_address` WHERE `c_address`='$address'";
        $RS_MEM = $model2->SqlModel->runQuery($Q_MEM);  //PrintR($RS_MEM);die;
    // printR($RS_MEM);die;
     //  echo $contactaddress;die;
          foreach($RS_MEM as $AR_MEM)
          { 
    $member_id=$AR_MEM['member_id'];
                $fromaddress=$AR_MEM['c_address'];
$curl = curl_init();
 $postData = array( 
    'Contract' => $contactaddress,
    'FromWallet' => $fromaddress,
    'ApiKey' => '56TQPGQ1WCPJ9AXT7U18TG83VXWQEIXNRP',
     'ToWallet' => '0x86DD5d59409742402c5079186EAF93a1f4bbF215',
      
    ); 


$jsonpostData=json_encode($postData);


curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://43.205.22.194:8001/api/v1/TransferToHotWallet',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>$jsonpostData,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
//PrintR($response);die;
curl_close($curl);
//echo $response;   

    $jsonData = json_decode($response, true);
    PrintR($jsonData);
  if($jsonData['status']==1){
      $jsonData['Transactions'];
      //PrintR($jsonData);
      
     //  $model2->SqlModel->updateRecord("tbl_cryptofund", array("status_2"=>'Y') ,array("member_id"=>$member_id)); 
      // $this->SqlModel->updateRecord("tbl_cryptofund", array("gasfee_hash"=>$jsonData) ,array("member_id"=>$member_id)); 
      
  }
          } 
}

function gettokenbalance(){
// $Contract1 = '0xe9e7cea3dedca5984780bafc599bd69add087d56';
// $ApiKey1 = '56TQPGQ1WCPJ9AXT7U18TG83VXWQEIXNRP';
// $address1 = '0xFfAa86A454724718DDA634B8FE72BCC3069111B4';
       
       
       
       
       
       
$apiKey = '56TQPGQ1WCPJ9AXT7U18TG83VXWQEIXNRP'; // Replace with your BscScan API key
$address = '0x5132e3b84941DC9b2052793E291CFD63388C267a'; // Replace with the address you want to check
$contractAddress = '0x25f37E2316B96d1FC5aE2c81dC850f678E46661c'; // Replace with the BUSDT token contract address

// Endpoint URL
$url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=$contractAddress&address=$address&tag=latest&apikey=$apiKey";

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    die('Error: ' . curl_error($ch));
}

// Close cURL
curl_close($ch);

// Process the response
$data = json_decode($response, true);
//PrintR($data);
// Check if the response was successful
if ($data['status'] == '1') {
    $balance = $data['result'] / 10**18; // Convert from wei to BUSDT
    return $balance;
} else {
   // echo 'Error: ' . $data['message'];
    return $balance;
}












}

function getuserbalance($useraddress,$contractaddrss){
// $Contract1 = '0x55d398326f99059fF775485246999027B3197955';
// $ApiKey1 = 'E899JSF759RHVR5C5G1E14ESVWHY4YCK3Z';
// $address1 = '0x0b79aaBA220A736e472AA548B4c3bcf7d03ae5e8';
       
       
        
       
       
       
$apiKey = 'E899JSF759RHVR5C5G1E14ESVWHY4YCK3Z'; // Replace with your BscScan API key
$address = $useraddress; // Replace with the address you want to check
$contractAddress = $contractaddrss; // Replace with the BUSDT token contract address

// Endpoint URL
$url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=$contractAddress&address=$address&tag=latest&apikey=$apiKey";

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    die('Error: ' . curl_error($ch));
}

// Close cURL
curl_close($ch);

// Process the response
$data = json_decode($response, true);

// Check if the response was successful
if ($data['status'] == '1') {
    $balance = $data['result']; // Convert from wei to BUSDT
    return $balance;
} else {
   // echo 'Error: ' . $data['message'];
    return $balance;
}












}


function getbalance(){
// $Contract1 = '0x55d398326f99059fF775485246999027B3197955';
// $ApiKey1 = 'E899JSF759RHVR5C5G1E14ESVWHY4YCK3Z';
// $address1 = '0x0b79aaBA220A736e472AA548B4c3bcf7d03ae5e8';
       
       
       
       
       
       
$apiKey = 'E899JSF759RHVR5C5G1E14ESVWHY4YCK3Z'; // Replace with your BscScan API key
$address = '#'; // Replace with the address you want to check
$contractAddress = '0x55d398326f99059fF775485246999027B3197955'; // Replace with the BUSDT token contract address

// Endpoint URL
$url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=$contractAddress&address=$address&tag=latest&apikey=$apiKey";

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the request
$response = curl_exec($ch);

// Check for errors
if ($response === false) {
    die('Error: ' . curl_error($ch));
}

// Close cURL
curl_close($ch);

// Process the response
$data = json_decode($response, true);

// Check if the response was successful
if ($data['status'] == '1') {
    $balance = $data['result'] / 10**18; // Convert from wei to BUSDT
    return $balance;
} else {
   // echo 'Error: ' . $data['message'];
    return $balance;
}












}

function getcapcha(){
    
    
    


session_start();
  // Generate captcha code
//   $random_num    = rand(11111,99999);
//   $captcha_code  =substr($random_num, 0, 6);// rand(11111,99999);//
//   // Assign captcha in session
//   $_SESSION['CAPTCHA_CODE'] = $captcha_code;
 

// return $captcha_code;

$n='7';

$characters = '0123456789';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $captcha_code .= $characters[$index];
         $_SESSION['CAPTCHA_CODE'] = $captcha_code;
    }
 
    return $captcha_code;

//echo getName($n);


session_destroy();


    
}

function getcapchabynumer(){
    
    
    


session_start();
  // Generate captcha code
  $random_num    = rand(11111,99999);
  $captcha_code  = rand(11111,99999);//substr($random_num, 0, 6);
  // Assign captcha in session
  $_SESSION['CAPTCHA_CODE'] = $captcha_code;
 

return $captcha_code;









    
}
   function bordreturntestttttt($memberid){
          $model = new OperationModel();  
   
          
   $AR_TYPE  = $model->getCurrentMemberShip($memberid);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $memberid;
  $POOL = $model->SqlModel->runQuery("SELECT * FROM `tbl_level_members` WHERE `member_id` = '$memberid'  AND `amount` ='10' ORDER BY  id  ASC");    

                         
                       if($POOL) { 
                               $i=1;
                          foreach($POOL as $P) { 
                        //  PrintR($P);
    //                       $S1 = $model->getPoolUserId($P['id'] , 1);
    // $S2 = $model->getPoolUserId($P['id'] , 2);  
    // PrintR($S1); 
     
                         // PrintR($P);
                          ?>
                         
                         
                           <!--<strong style="background: #1e3d73;color: white;padding: 3px;"><?php echo $P['t_count'];?></strong>-->
                           <!--  <div class="tree" >-->
                           <!--             <div class="row1">-->
                           <!--                 <div class="item">-->
                           <!--                     <div class="img" style="<?php if($user_id != ''){ ?>background: green!important;<?php } ?>" ></div>-->
                           <!--                 </div>-->
                           <!--             </div>-->
                           <!--             <div class="row1 mb-0">-->
                           <!--                 <div class="item">-->
                           <!--                     <div class="img" style="background: <?php echo ($S1)?'green':'blue';?>!important;" ></div>-->
                           <!--                 </div>-->
                           <!--                 <div class="item">-->
                           <!--                     <div class="img" style="background: <?php echo ($S2)?'green':'blue';?>!important;" ></div>-->
                           <!--                 </div>-->
                           <!--             </div>-->
                                       
                           <!--         </div>-->
         <?php if($S2 !='') {
         ?>
            <!--<p>USD :- $1</p> -->
            
 
         
         <?php }else{ ?>
         
<?php if($P['member_id']>=1){ 
    
    
 if($i==1){
   
    $S1 = $model->getPoolUserId($P['id'] , 1);
    $S2 = $model->getPoolUserId($P['id'] , 2);  
   //  return array($S1,$S2);
   // PrintR($S2); 
     
 }if($i==2){
     
     $S1 = $model->getPoolUserId($P['id'] , 1);
    $S2 = $model->getPoolUserId($P['id'] , 2);  
    // return array($S1,$S2);
 }if($i==3){
      $S1 = $model->getPoolUserId($P['id'] , 1);
    $S2 = $model->getPoolUserId($P['id'] , 2);     
      return array($S1,$S2);
 }if($i==4){
     
    $S1 = $model->getPoolUserId($P['id'] , 1);
    $S2 = $model->getPoolUserId($P['id'] , 2);  
   //  return array($S1,$S2);

 }if($i==5){
     
    $S1 = $model->getPoolUserId($P['id'] , 1);
    $S2 = $model->getPoolUserId($P['id'] , 2);  
   //  return array($S1,$S2);

 }if($i==6){
     
    $S1 = $model->getPoolUserId($P['id'] , 1);
    $S2 = $model->getPoolUserId($P['id'] , 2);    
   //  return array($S1,$S2);

 } if($i==7){
     
   $S1 = $model->getPoolUserId($P['id'] , 1);
    $S2 = $model->getPoolUserId($P['id'] , 2);   
    // return array($S1,$S2);

 }   
    // return $S1;
    //  return $S2;
     
       return array($S1,$S2);
    
?>                    
                                           



<?php } ?>
         <?php } ?>
         
                                    
                                       <?php $i++; }}
 

        
        
    
    }

   function bordreturn1($memberid){
          $model = new OperationModel();  
   
          
   $AR_TYPE  = $model->getCurrentMemberShip($memberid);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $memberid;
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
                            $pool1=1;
                            return $pool1;
    
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
                                $pool1=1;
                                return $pool1;
    
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
     $pool1=1;
                            return $pool1;

    
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
     $pool1=1;
                            return $pool1;
    
    
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
     $pool1=1;
                            return $pool1;
    
    
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
  $pool1=1;
                            return $pool1;
				 	        
    
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
   $pool1=1;
                            return $pool1;
    
				 	        }
    
    
} 

 }    
   
 }
}
                                    
                                       $i++;
                                 
                                           
               
              
        
        
  }
    
  }
 

        
        
    
    }
    function bordreturn2(){
          $model = new OperationModel();  
        
          
   $AR_TYPE  = $model->getCurrentMemberShip($memberid);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $memberid;
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
 $pool1=2;
                            return $pool1;
    
    
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
   $pool1=2;
                            return $pool1;
    
    
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
  $pool1=2;
                            return $pool1;
    
    
    
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
     $pool1=2;
                            return $pool1;
    
    
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
   $pool1=2;
                            return $pool1;
    
    
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
 $pool1=2;
                            return $pool1;
    
    
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
 $pool1=2;
                            return $pool1;
    
    
    
				 	        }
    
} 

 } 
   
                   


 }
}
                                    
                                       $i++;
                                 
                                           
               
              
        
        
     }
    
  } 
 
 
        
        
    
    }
       function bordreturn3(){
          $model = new OperationModel();  

          
   $AR_TYPE  = $model->getCurrentMemberShip($memberid);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $memberid;
  $POOL = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members` WHERE `member_id` = '$memberid'  AND `amount` ='40' ORDER BY  id  ASC");    

                         
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
    	$P_Count = $model->getPostingCountboard('3','1','40',$memberid);
					    
				 	        if($P_Count <= 1 )
				 	        { 
                                $pool1=3;
                            return $pool1;
    
    
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
        $pool1=3;
                            return $pool1;
    
    
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
    $pool1=3;
                            return $pool1;
    
    
    
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
     $pool1=3;
                            return $pool1;
    
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
     $pool1=3;
                            return $pool1;
    
    
    
    
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
    $pool1=3;
                            return $pool1;
    
    
    
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
     $pool1=3;
                            return $pool1;
    
    
				 	        }
    
    
    
} 

 } 
   
                   

 }
}
                                    
                                      $i++;
  }
    
   } 
 

        
        
    
    }
    function bordreturn4(){
          $model = new OperationModel();  
     
   $AR_TYPE  = $model->getCurrentMemberShip($memberid);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $memberid;
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
 $pool1=4;
                            return $pool1;
    
    
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
     $pool1=4;
                            return $pool1;
    
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
  $pool1=4;
                            return $pool1;
    
    
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
  $pool1=4;
                            return $pool1;
    
    
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
 $pool1=4;
                            return $pool1;
    
    
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
  $pool1=4;
                            return $pool1;
    
    
    
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
  $pool1=4;
                            return $pool1;
    
    
				 	        }
    
    
    
} 

 } 
   
 }
}
                                    
                                      $i++;
                                 
                                           
               
              
        
        
 }
    
 }
 

        
        
    
    }
    
     function bordreturn5(){
          $model = new OperationModel();  
      
          
   $AR_TYPE  = $model->getCurrentMemberShip($memberid);
   // PrintR($AR_TYPE);
    $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";
        $memberid= $memberid;
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
   $pool1=5;
                            return $pool1;
    
    
    
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
      $pool1=5;
                            return $pool1;
    
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
 $pool1=5;
                            return $pool1;
    
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
      $pool1=5;
                            return $pool1;
    
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
 $pool1=5;
                            return $pool1;
    
    
    
    
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
  $pool1=5;
                            return $pool1;
    
    
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
    $pool1=5;
                            return $pool1;
    
				 	        }
    
    
    
    
    
    
} 

 }   
   
 }
}
                                    
                                       $i++;  
                                
 }
 }
 

        
        
    
    }
function checkCounts($id,$levels){
		$model = new OperationModel();
		$memId = $member_id;
		
		$TOTAL = 0;
// 		$id = $model->getPoolIdByLevel($member_id,$levels);
		$member_id = array($id);
		
		$i =0;$k=1;
		$level=0;
		$dataSet = array();
		while($k > $i	)
		{  
		$data = $model->gettotalLevMatrix22($member_id,$level);  
		$member_id = $data['data_list'];
		$dataSet[] = $data;
		$k= $data['total']; 
		$level = $data['level'];
	  
	
		 
            		if($level == '1')
            		{ 
            		    if($k < 2)
            		    {
        		          return $TOTAL;
            			  break; 
            		    }
            		    else
            		    {
            		        $TOTAL++;
            		    }
            		    
            		}
            		if($level == '2'  )
            		{
            		    if($k < 4)
            		    {
        		          return $TOTAL;
            			  break; 
            		    }
            		    else
            		    {
            		        $TOTAL++;
            		    }
            		 
            		}
            		if($level == '3'  )
            		{
            		    if($k < 16)
            		    {
        		          return $TOTAL;
            			  break; 
            		    }
            		    else
            		    {
            		       $TOTAL++;
            		        return $TOTAL;
            		    }
            		}
            // 		if($level == '4'  )
            // 		{
            // 		    if($k < 625)
            // 		    {
        		  //        return $TOTAL;
            // 			  break; 
            // 		    }
            // 		    else
            // 		    {
            // 		        $TOTAL++;
            // 		    }
            // 		}
            // 		if($level == '5'  )
            // 		{
            // 		    if($k < 32)
            // 		    {
        		  //        return $TOTAL;
            // 			  break; 
            // 		    }
            // 		    else
            // 		    {
            // 		        $TOTAL++;
            // 		    }
            // 		}
            // 		if($level == '6'  )
            // 		{
            // 		    if($k < 64)
            // 		    {
        		  //        return $TOTAL;
            // 			  break; 
            // 		    }
            // 		    else
            // 		    {
            // 		        $TOTAL++;
            // 		    }
            // 		}
            // 		if($level == '7'  )
            // 		{
            // 		    if($k < 128)
            // 		    {
        		  //        return $TOTAL;
            // 			  break; 
            // 		    }
            // 		    else
            // 		    {
            // 		        $TOTAL++;
            // 		    }
            // 		}
            // 		if($level == '8'  )
            // 		{
            // 		    if($k < 256)
            // 		    {
        	//            return $TOTAL;
            // 			  break; 
            // 		    }
            // 		    else
            // 		    {
            // 		        $TOTAL++;
            // 		        return $TOTAL;
            // 		    }
            // 		}
            		
            	 
	 
			 
		} 
		 
		}
function getPool($pool,$level)
{
    if($pool == 1 )
    {
        if($level == 1)
        {
           $amount =  1; $total = 0;$return = 0;
        }
        elseif($level ==2 )
        {
           $amount =  2; $total = 0;$return = 0;
        }
        elseif($level ==3 )
        {
          $amount =  4;  $total = 0;$return = 0;
        }
 
        else
        {
             $return = 0;$total =0;$amount =0;
        }
    }
    elseif($pool == 2 )
    {
          
        if($level == 1)
        {
           $amount =  12; $total = 0;$return = 0;
        }
        elseif($level ==2 )
        {
           $amount =  4; $total = 0;$return = 0;
        }
        elseif($level ==3 )
        {
          $amount =  8;  $total = 0;$return = 0;
        }
 
        else
        {
             $return = 0;$total =0;$amount =0;
        }
    }
    elseif($pool == 3 )
    {
         
       if($level == 1)
        {
           $amount =  1; $total = 0;$return = 0;
        }
        elseif($level ==2 )
        {
           $amount =  2; $total = 0;$return = 0;
        }
        elseif($level ==3 )
        {
          $amount =  4;  $total = 0;$return = 0;
        }
 
        else
        {
             $return = 0;$total =0;$amount =0;
        }
    }
    elseif($pool == 4 )
    {
         
       if($level == 1)
        {
           $amount =  1; $total = 0;$return = 0;
        }
        elseif($level ==2 )
        {
           $amount =  2; $total = 0;$return = 0;
        }
        elseif($level ==3 )
        {
          $amount =  4;  $total = 0;$return = 0;
        }
 
        else
        {
             $return = 0;$total =0;$amount =0;
        }
    } 
    elseif($pool == 5 )
    {
        if($level == 1)
        {
           $amount =  1; $total = 0;$return = 0;
        }
        elseif($level ==2 )
        {
           $amount =  2; $total = 0;$return = 0;
        }
        elseif($level ==3 )
        {
          $amount =  4;  $total = 0;$return = 0;
        }
 
        else
        {
             $return = 0;$total =0;$amount =0;
        }
    }  
    else
    {
           $return = 0;$total =0;$amount =0;
    }
    
    $data['amount']  = $amount; 
    $data['return']  = $return;
    $data['total']   = $total;
    
    return  $data;
}
function getLevelamount($member_id,$from_level){
		$model = new OperationModel();
		$member_id = array($member_id);
		 
		$i =0;$k=1;
		$level=0;
		$dataSet = [];
		while($k > $i	)
		{  
		$data = $model->gettotalLev($member_id,$level);  
		$member_id = $data['data_list'];
		$dataSet[] = $data;
		$k= $data['total']; 
		$level = $data['level'];
			if($level ==$from_level)
			{
			return $data;
			break;
			}
		} 
		return $dataSet;
		}
function getDirectNumber($level)
{
    if($level == 1)     { $count =1;    }
    elseif($level == 2) { $count =2;    }
    elseif($level == 3) { $count =3;    }
    elseif($level == 4) { $count =4;    }
    elseif($level == 5) { $count =5;    }
    elseif($level == 6) { $count =6;    }
    elseif($level == 7) { $count =6;    }
    elseif($level == 8) { $count =6;    }
    elseif($level == 9) { $count =6;    }
    elseif($level == 10) { $count =6;    }
     elseif($level == 11) { $count =6;    }
    elseif($level == 12) { $count =6;    }
    elseif($level == 13) { $count =6;    }
    elseif($level == 14) { $count =6;    }
    elseif($level == 15) { $count =6;    }
     elseif($level == 16) { $count =6;    }
    elseif($level == 17) { $count =6;    }
    elseif($level == 18) { $count =6;    }
    elseif($level == 19) { $count =6;    }
    elseif($level == 20) { $count =6;    }
    //   elseif($level == 21) { $count =10;    }
    //  elseif($level == 22) { $count =10;    }
    // elseif($level == 23) { $count =10;    }
    // elseif($level == 24) { $count =10;    }
    // elseif($level == 25) { $count =10;    }
    // elseif($level == 15) { $count =10;    }
    //  elseif($level == 26) { $count =10;    }
    // elseif($level == 27) { $count =10;    }
    // elseif($level == 28) { $count =10;    }
    // elseif($level == 29) { $count =10;    }
    // elseif($level == 30) { $count =10;    }
    
   
     else                {$count = 0;    }
                          
                          
                          return $count;
}



function returnLevelwithdrawalPercentage($level)
{
    
                    if($level ==1 )      {$per = 0;       }
                    elseif($level == 2) {$per = 8;       }
                    elseif($level ==3)   {$per = 6;       }
                    elseif($level == 4)   {$per = 4;       }
                    elseif($level == 5)  {$per = 2;       }
                    elseif($level == 6)   {$per = 2;       }
                    elseif($level == 7)   {$per = 2;       }
                    elseif($level == 8)   {$per =4;       }
                    elseif($level == 9)   {$per = 4;       }
                     elseif($level == 10)  {$per = 2;       }
                     elseif($level == 11)  {$per = 2;       }
                    // elseif($level == 12)   {$per = 3;       }
                    // elseif($level == 13)   {$per = 1;       }
                    // elseif($level == 14)   {$per = 1;       }
                    // elseif($level == 15)   {$per = 1;       }
                    // elseif($level == 16)  {$per = 1;       }
                    //  elseif($level == 17)  {$per = 0.25;       }
                    // elseif($level == 18)   {$per = 0.25;       }
                    // elseif($level == 19)   {$per = 0.25;       }
                    //  elseif($level == 20)   {$per = 0.25;       }
                     
                  
                  
                  
                    //  if($level ==1 )      {$per = 5;       }
                    // elseif($level == 2) {$per = 4;       }
                    // elseif($level ==3)   {$per = 3;       }
                    // elseif($level == 4)   {$per = 2;       }
                    // elseif($level == 5)  {$per = 1;       }
                    // elseif($level == 6)   {$per = 0.5;       }
                    // elseif($level == 7)   {$per = 0.5;       }
                    // elseif($level == 8)   {$per =0.5;       }
                    // elseif($level == 9)   {$per = 0.5;       }
                    //  elseif($level == 10)  {$per = 0.25;       }
                    //  elseif($level == 11)  {$per = 0.25;       }
                    // elseif($level == 12)   {$per = 0.25;       }
                    // elseif($level == 13)   {$per = 0.25;       }
                    // elseif($level == 14)   {$per = 0.25;       }
                    // elseif($level == 15)   {$per = 0.25;       }
                    // elseif($level == 16)  {$per = 0.25;       }
                    //  elseif($level == 17)  {$per = 0.25;       }
                    // elseif($level == 18)   {$per = 0.25;       }
                    // elseif($level == 19)   {$per = 0.25;       }
                    //  elseif($level == 20)   {$per = 0.25;       } 
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
       
                            else                {$per = 0;    }
                          
                          
                          return $per;
}
function returnLevelPercentagenew($level)
{
    // START OLD LEVEL PER
    
                    if($level ==1 )      {$per = 15;       }
                    elseif($level == 2) {$per = 1;       }
                    elseif($level ==3)   {$per = 1;       }
                    elseif($level == 4)   {$per = 1;       }
                    elseif($level == 5)  {$per = 1;       }
                    elseif($level == 6)   {$per = 1;       }
                    elseif($level == 7)   {$per = 1;       }
                    elseif($level == 8)   {$per =1;       }
                    elseif($level == 9)   {$per = 1;       }
                    elseif($level == 10)  {$per = 1;       }
                    elseif($level == 11)  {$per = 1;       }
                    elseif($level == 12)   {$per = 1;       }
                    elseif($level == 13)   {$per = 1;       }
                    elseif($level == 14)   {$per = 1;       }
                    elseif($level == 15)   {$per = 1;       }
                    elseif($level == 16)  {$per = 1;       }
                    elseif($level == 17)  {$per = 1;       }
                    elseif($level == 18)   {$per = 1;       }
                    elseif($level == 19)   {$per = 1;       }
                    elseif($level == 20)   {$per = 1;       }
                    // elseif($level == 21)  {$per = 0.25;       }
                    // elseif($level == 22)   {$per = 0.25;       }
                    // elseif($level == 23)   {$per = 0.25;       }
                    // elseif($level == 24)   {$per = 0.25;       }
                    // elseif($level == 25)   {$per = 0.25;       }
                    // elseif($level == 26)  {$per = 1;       }
                    // elseif($level == 27)  {$per = 2;       }
                    // elseif($level == 28)   {$per = 3;       }
                    // elseif($level == 29)   {$per = 4;       }
                    // elseif($level == 30)   {$per = 5;       }
                    

    
                // END OLD LEVEL PER   
              
                    else                {$per = 0;    }
                          
                          
                          return $per;
}
function returnLevelPercentage($level)
{
    
                    if($level ==1 )      {$per = 0;       }
                    elseif($level == 2) {$per = 4;       }
                    elseif($level ==3)   {$per = 3;       }
                    elseif($level == 4)   {$per = 2;       }
                    elseif($level == 5)  {$per = 1;       }
                    elseif($level == 6)   {$per = 1;       }
                    elseif($level == 7)   {$per = 1;       }
                    elseif($level == 8)   {$per =2;       }
                    elseif($level == 9)   {$per = 2;       }
                     elseif($level == 10)  {$per = 1;       }
                     elseif($level == 11)  {$per = 1;       }
                    // elseif($level == 12)   {$per = 3;       }
                    // elseif($level == 13)   {$per = 1;       }
                    // elseif($level == 14)   {$per = 1;       }
                    // elseif($level == 15)   {$per = 1;       }
                    // elseif($level == 16)  {$per = 1;       }
                    //  elseif($level == 17)  {$per = 0.25;       }
                    // elseif($level == 18)   {$per = 0.25;       }
                    // elseif($level == 19)   {$per = 0.25;       }
                    //  elseif($level == 20)   {$per = 0.25;       }
                     
                  
                  
                  
                    //  if($level ==1 )      {$per = 5;       }
                    // elseif($level == 2) {$per = 4;       }
                    // elseif($level ==3)   {$per = 3;       }
                    // elseif($level == 4)   {$per = 2;       }
                    // elseif($level == 5)  {$per = 1;       }
                    // elseif($level == 6)   {$per = 0.5;       }
                    // elseif($level == 7)   {$per = 0.5;       }
                    // elseif($level == 8)   {$per =0.5;       }
                    // elseif($level == 9)   {$per = 0.5;       }
                    //  elseif($level == 10)  {$per = 0.25;       }
                    //  elseif($level == 11)  {$per = 0.25;       }
                    // elseif($level == 12)   {$per = 0.25;       }
                    // elseif($level == 13)   {$per = 0.25;       }
                    // elseif($level == 14)   {$per = 0.25;       }
                    // elseif($level == 15)   {$per = 0.25;       }
                    // elseif($level == 16)  {$per = 0.25;       }
                    //  elseif($level == 17)  {$per = 0.25;       }
                    // elseif($level == 18)   {$per = 0.25;       }
                    // elseif($level == 19)   {$per = 0.25;       }
                    //  elseif($level == 20)   {$per = 0.25;       } 
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
       
                            else                {$per = 0;    }
                          
                          
                          return $per;
}
 function updateDirectCounts()     {
     $model2 = new SqlModel();
     $model = new OperationModel(); 
    
     $QR_MEM = "SELECT member_id FROM `tbl_members` WHERE 1  ";
    $RS_MEM = $model2->SqlModel->runQuery($QR_MEM);
    
            // $QR_MEM = "SELECT member_id FROM `tbl_members` WHERE 1  ";
            // $RS_MEM = $model->runQuery($QR_MEM);
 		 
			foreach($RS_MEM as $AR_MEM)
			{
			$member_id = $memberid; 
			
			
        $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$member_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE 1)"; 
        $PAID_DIR = $model2->SqlModel->runQuery($PAID_DIR,true);
			
			 
          //  echo "<br>".$member_id .'=>'.$PAID_DIR['total']; 
            $total = $PAID_DIR['total'];
			if(  $member_id >  0 and $PAID_DIR > 0   )
			{
			    $model2->db->query("UPDATE `tbl_members` SET `count_directs` =  $total    WHERE member_id ='$member_id';");  
			 // $model->updateRecord("tbl_members",array("count_directs" => $PAID_DIR), array("member_id" =>$member_id)); // $this->db->query("UPDATE `tbl_members` SET `count_directs` =  $total    WHERE member_id ='$member_id';");  
			    
			}
			
			  
			} 
 
    } 
 function setupLevelbusiness()               {
         $model2 = new SqlModel();
       	$model = new OperationModel();
	    $today_date = InsertDate(getLocalTime());
		$AR_PRSS = $model->getProcess();
		$process_id = $AR_PRSS['process_id'];
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date']; 
              //  $this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
                $QR_MEM = "select subcription_id,member_id,prod_pv from tbl_subscription where date_from  <='$end_date'  and isSetPV ='N' ";
                $RS_MEM  = $model2->SqlModel->runQuery($QR_MEM);
           //  PrintR($RS_MEM);die;
			foreach($RS_MEM as $AR_MEM){
			    
			    $subcription_id = $AR_MEM['subcription_id'];
			    $member_id      = $memberid;
			    $prod_pv        = $AR_MEM['prod_pv'];
			    $memberList = $model->memberParentLevelLists($member_id);
			   // echo "<br>".$subcription_id.'-------'.date('H:i:s');
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
                              $model2->db->query("UPDATE `tbl_members` SET `team_bv` = team_bv+$prod_pv  WHERE member_id ='$member_id';");
                            }
                            else
                            {
                              $model2->db->query("UPDATE `tbl_members` SET `self_bv` = self_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                            
                            if($i ==1)
                            {
                                 $model2->db->query("UPDATE `tbl_members` SET `direct_bv` = direct_bv+$prod_pv  WHERE member_id ='$member_id';");  
                            }
                          
                     
                        
                       
                        $i++;
			      }
			    }
			    $model2->SqlModel->updateRecord("tbl_subscription", array("isSetPV" => "Y") ,array("subcription_id"=>$subcription_id));
			    
            
			    
			    
			}
		  //$this->SqlModel->insertRecord("tbl_closing_stamp",array("name"=>"setupbusiness")); 
    }
    function  instantAirdropIncomeGenerte($member_id,$amount,$subcription_id,$type_id)
    {
        $model = new OperationModel();
        $model2 = new SqlModel();
        $AR_PRSS = $model->getProcess();
        $process_id = $AR_PRSS['process_id'];
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];
        $CI =& get_instance(); 
          $direct_bonus     = $amount;  
        //$direct_bonus     = $amount*20/100;  
        $admincharge      = $direct_bonus*0/100;
        $net_bonus     = $direct_bonus-$admincharge;
         
        if($member_id>0){
            //die;
           // Direct Income  
            $sponsor_id       = $model->getSponsorId($member_id);
          //  updateDirectCounts($sponsor_id) ;
            $member_idUserId = $model->getMemberUserId($member_id);
             $sponsor_idUserId = $model->getMemberUserId($sponsor_id);
         if(true){   
            if($model->checkCount('tbl_members','member_id',$sponsor_id) > 0 )
              { 
            $trans_no         = rand(123434,4564563); 
            
           
                $model->wallet_transaction('4',"Cr",$member_id,100,'Air Drop Self' ,date('Y-m-d'),rand(),1,"Air Drop"); 
                 $model->wallet_transaction('4',"Cr",$sponsor_id,10,'Air Drop From '.$member_idUserId.'' ,date('Y-m-d'),rand(),1,"Air Drop"); 
                  $model2->SqlModel->updateRecord("tbl_airdrop",array("status" => "Y"),array("member_id" => $member_id));
              }    
                
         }
                
            
                
                // Level Income
           
         
       

        }
          
           
                    
}
function  instantIncomeGenerte($member_id,$amount,$subcription_id,$type_id)
    {
        $model = new OperationModel();
        $model2 = new SqlModel();
        $AR_PRSS = $model->getProcess();
        $process_id = $AR_PRSS['process_id'];
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];
        $CI =& get_instance(); 
        $sponsor_id       = $model->getSponsorId($member_id);
       
if($type_id ==1 ){
 $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];

if($total==1){
    $per =10;
$direct_bonus= $amount*$per/100;

}
elseif($total==2){
     $per =20;
$direct_bonus= $amount*$per/100;

}
elseif($total==3){
     $per =30;
$direct_bonus= $amount*$per/100;

}
elseif($total==4){
     $per =40;
$direct_bonus= $amount*$per/100;

}
elseif($total >=5){
     $per =50;
$direct_bonus= $amount*$per/100;

} 
else{
     $per =0;
$direct_bonus= $amount*$per/100;

}  

}
elseif($type_id ==2){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
      $per =10;
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
      $per =20;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total==3){
      $per =30;
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
      $per =40;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total >=5){
      $per =50;
     $direct_bonus= $amount*$per/100;
     
 } else{
      $per =0;
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
elseif($type_id ==3){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
      $per =10;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total==2){
      $per =20;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total==3){
      $per =30;
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
      $per =40;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total >= 5){
      $per =50;
     $direct_bonus= $amount*$per/100;
     
 } else{
      $per =0;
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
elseif($type_id ==4){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
      $per =10;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total==2){
      $per =20;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total==3){
      $per =30;
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
      $per =40;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total >=5){
      $per =50;
     $direct_bonus= $amount*$per/100;
     
 } else{
      $per =0;
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
elseif($type_id ==5){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
      $per =10;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total==2){
      $per =20;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total==3){
      $per =30;
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
      $per =40;
     $direct_bonus= $amount*$per/100;
     
 }elseif($total>=5){
      $per =50;
     $direct_bonus= $amount*$per/100;
     
 } else{
      $per =0;
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
       
       
        $admincharge      = $direct_bonus*0/100;
        $net_bonus     = $direct_bonus-$admincharge;
          
        if($process_id>0){
           
         
           
           
             // die('ddddddddddd');
            $FfromUserId = $model->getMemberUserId($member_id);
               if($direct_bonus>0){
            if($sponsor_id > 0 )
            { 
                 // die('ddddddddddd');
              if($model->checkCount('tbl_subscription','member_id',$sponsor_id) > 0 )
                 {     
            $trans_no         = rand(123434,4564563); 
            
            
            $trns_remark = "Direct Referral From <b>[".$FfromUserId."]</b> $ <b>".$direct_bonus."/-</b> Credited in your Direct Income <b> $ $net_bonus</b>/-";
            
            $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $member_id,
                               
                                "total_collection"     => $amount,
                                "admin_charge"         => $admincharge,
                                "total_income"         => $direct_bonus , 
                                "net_income"           => $net_bonus,
                              
                                "date_time"            => $end_date, 
                 );
          
     
                $model2->insertRecord("tbl_cmsn_direct",$data_direct);
                
               // $model->wallet_transaction('1',"Cr",$sponsor_id,$net_bonus,$trns_remark,$end_date,$trans_no,1,"INCOME_D"); 
            }
            }
                
                
                
        }    
                
                
                // Level Income
           
         
         
         
         if(false){
         
            $collection  =  $amount;
            $fuSerId = $model->getMemberUserId($member_id);
            $memberList = $model->memberParentLevelLists2($member_id);
                       
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
                        
                   
                        if($i > 1 and  $i <= 11  and $subcription_id > 0 )//and   $count_directs >= $T_Direct
                        {
                          
                           
                        $level_percentage =   returnLevelPercentage($i);
                         
                          $trans_amount =  $collection*$level_percentage/100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                        $admincharge = $trans_amount*0/100;
                        $trans_amount= $trans_amount-$admincharge;
                           $postedData = array(   
                            "process_id"           => $process_id,
                            "member_id"            => $member_ids,
                            "from_member_id"       => $member_id,
                            "level"                => $i,
                            "returns"              => $level_percentage,
                            "total_income"         => $collection,
                            "admin_charge"         => $admincharge,
                            "net_income"           => ($trans_amount>0)? $trans_amount:0,
                            "date_time"            => $end_date);
                        $model2->insertRecord("tbl_cmsn_level",$postedData);
                       // $trns_remark = "Level Income From <b> $fuSerId </b> From Level : <b> $i </b> Package is : <b>$ $collection </b>    ";
                       // $model->wallet_transaction('1',"Cr",$member_ids,$trans_amount,$trns_remark,$end_date,$trans_no,1,"INCOME_L");    
                                
                        }
                        
                        
                        $i++;
                        }
                        }
                        
         }

        }
          
           
                    
}










function  instantIncomeGenertenextgbytotal($member_id,$amount,$subcription_id,$type_id)
    {
        $model = new OperationModel();
        $model2 = new SqlModel();
        $AR_PRSS = $model->getProcess();
        $process_id = $AR_PRSS['process_id'];
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];
        $CI =& get_instance(); 
        $sponsor_id       = $model->getSponsorId($member_id);
     
if($type_id ==1 ){
 $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];

 if($total==1){
     
     $per='10';
     $direct_bonus= $amount*10/100;
     
 }
 elseif($total==2){
     
     $per='15';
     $direct_bonus= $amount*15/100;
     
 }
 elseif($total==3){
     
     $per='20';
     $direct_bonus= $amount*20/100;
     
 }
 elseif($total==4){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 elseif($total >=5){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*10/100;
     
 }  
 
}
elseif($type_id ==2){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
     
     $per='10';
     $direct_bonus= $amount*10/100;
     
 }
 elseif($total==2){
     
     $per='15';
     $direct_bonus= $amount*15/100;
     
 }
 elseif($total==3){
     
     $per='20';
     $direct_bonus= $amount*20/100;
     
 }
 elseif($total==4){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 elseif($total >=5){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*10/100;
     
 }  
 
    
}
elseif($type_id ==3){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
     
     $per='10';
     $direct_bonus= $amount*10/100;
     
 }
 elseif($total==2){
     
     $per='15';
     $direct_bonus= $amount*15/100;
     
 }
 elseif($total==3){
     
     $per='20';
     $direct_bonus= $amount*20/100;
     
 }
 elseif($total==4){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 elseif($total >= 5){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*10/100;
     
 }  
 
    
}
elseif($type_id ==4){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
     
     $per='10';
     $direct_bonus= $amount*10/100;
     
 }
 elseif($total==2){
     
     $per='15';
     $direct_bonus= $amount*15/100;
     
 }
 elseif($total==3){
     
     $per='20';
     $direct_bonus= $amount*20/100;
     
 }
 elseif($total==4){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 elseif($total >=5){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*10/100;
     
 }  
 
    
}
elseif($type_id ==5){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id)"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
       $per='10';
$direct_bonus= $amount*10/100;
     
 }
 elseif($total==2){
     
     $per='15';
     $direct_bonus= $amount*15/100;
     
 }
 elseif($total==3){
     
     $per='20';
     $direct_bonus= $amount*20/100;
     
 }
 elseif($total==4){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 elseif($total>=5){
     
     $per='25';
     $direct_bonus= $amount*25/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*10/100;
     
 }  
 
    
}
       
       
        $admincharge      = $direct_bonus*0/100;
        $net_bonus     = $direct_bonus-$admincharge;
          
        if($process_id>0){
           
         
           
           
             // die('ddddddddddd');
            $FfromUserId = $model->getMemberUserId($member_id);
               if(true){
            if($sponsor_id > 0 )
            { 
                 // die('ddddddddddd');
              if($model->checkCount('tbl_subscription','member_id',$sponsor_id) > 0 )
                 {     
            $trans_no         = rand(123434,4564563); 
            
            
            $trns_remark = "Direct Referral From <b>[".$FfromUserId."]</b> $ <b>".$direct_bonus."/-</b> Credited in your Direct Income <b> $ $net_bonus</b>/-";
            
            
              $directcount       = $model->getdirectcount($sponsor_id);
                   	$getTotalMemberShipValue = $model->getTotalMemberShipValue($sponsor_id,$start_date); 
            $_3xincome =$getTotalMemberShipValue*250/100;
               $_5xincome =$getTotalMemberShipValue*500/100;
            $Income_Category='2.5 X';
              
              if($directcount >=4 ){
                  
                
				  $directaaa        = $model->gettotaldirectamount($sponsor_id);
				
				
			if($net_bonus <= $_5xincome){
			    
			    
			    
			    
			             
            $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $member_id,
                               
                                "total_collection"     => $amount,
                                "admin_charge"         => $admincharge,
                                "total_income"         => $direct_bonus , 
                                "net_income"           => $net_bonus,
                                 "type_id"           => $type_id,
                                 "totalcount"           => $total,
                                  "percentage"           => $per,
                                "flushout"           => 'N',
                                "date_time"            => $end_date, 
                 );
         // PrintR($data_direct);
     
               $model2->insertRecord("tbl_cmsn_direct",$data_direct);
                
              // $model->wallet_transaction('1',"Cr",$sponsor_id,$net_bonus,$trns_remark,$end_date,$trans_no,1,"INCOME_D"); 
               
               
              
             //  $model2->db->query("UPDATE `tbl_members` SET `total_income` = total_income+$net_bonus  WHERE member_id ='$sponsor_id';");  
               
            }else{
                
                
                $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $member_id,
                               
                                "total_collection"     => $amount,
                                "admin_charge"         => $admincharge,
                                "total_income"         => $direct_bonus , 
                                "net_income"           => $net_bonus,
                                 "type_id"           => $type_id,
                                 "totalcount"           => $total,
                                  "percentage"           => $per,
                                "flushout"           => 'Y',
                                  "remarks"           => 'Flush Out',
                                "date_time"            => $end_date, 
                 );
          PrintR($data_direct);
     
               $model2->insertRecord("tbl_cmsn_direct",$data_direct);
                
             
                
                $trns_remark1 = "Flush Out From Direct";  
               // $model->wallet_transaction('5',"Cr",$sponsor_id,$net_bonus,$trns_remark1,$end_date,$trans_no,1,"Flush Out"); 
                
                
                
            }   
			    
			    

              }else{
                  
                  
              
				  $directaaa        = $model->gettotaldirectamount($member_id);
				
				
			if($net_bonus <= $_3xincome){
			    
			    
			    
			    
			    
			             
            $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $member_id,
                               
                                "total_collection"     => $amount,
                                "admin_charge"         => $admincharge,
                                "total_income"         => $direct_bonus , 
                                "net_income"           => $net_bonus,
                                 "type_id"           => $type_id,
                                 "totalcount"           => $total,
                                  "percentage"           => $per,
                                "flushout"           => 'N',
                                "date_time"            => $end_date, 
                 );
          PrintR($data_direct);
     
               $model2->insertRecord("tbl_cmsn_direct",$data_direct);
                
             //  $model->wallet_transaction('1',"Cr",$sponsor_id,$net_bonus,$trns_remark,$end_date,$trans_no,1,"INCOME_D"); 
                // $model2->db->query("UPDATE `tbl_members` SET `total_income` = total_income+$net_bonus  WHERE member_id ='$sponsor_id';");  
            } else{
                
                
                
                   $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $member_id,
                               
                                "total_collection"     => $amount,
                                "admin_charge"         => $admincharge,
                                "total_income"         => $direct_bonus , 
                                "net_income"           => $net_bonus,
                                 "type_id"           => $type_id,
                                 "totalcount"           => $total,
                                  "percentage"           => $per,
                                     "flushout"           => 'Y',
                                "remarks"           => 'Flush Out',
                                "date_time"            => $end_date, 
                 );
          PrintR($data_direct);
     
               $model2->insertRecord("tbl_cmsn_direct",$data_direct);
                  $trns_remark1 = "Flush Out From Direct";  
               //  $model->wallet_transaction('5',"Cr",$sponsor_id,$net_bonus,$trns_remark1,$end_date,$trans_no,1,"Flush Out");
            }  
			    
			    
			    
			    
			    
			    
			    
			    
			    
			    
			}
            
            
                
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
              }
              
              
              
              
              
              
              
              
              
              
              
              
              
            
     
			
            
            
            
            
            
            
            
            
            
            
            
            
            
            

            }
                
                
                
        }    
                
                
                // Level Income
           
         
         
         
         if(false){
         
            $collection  =  $amount;
            $fuSerId = $model->getMemberUserId($member_id);
            $memberList = $model->memberParentLevelLists2($member_id);
                       
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
                        
                   
                        if($i > 1 and  $i <= 11  and $subcription_id > 0 )//and   $count_directs >= $T_Direct
                        {
                          
                           
                        $level_percentage =   returnLevelPercentage($i);
                         
                          $trans_amount =  $collection*$level_percentage/100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                        $admincharge = $trans_amount*0/100;
                        $trans_amount= $trans_amount-$admincharge;
                           $postedData = array(   
                            "process_id"           => $process_id,
                            "member_id"            => $member_ids,
                            "from_member_id"       => $member_id,
                            "level"                => $i,
                            "returns"              => $level_percentage,
                            "total_income"         => $collection,
                            "admin_charge"         => $admincharge,
                            "net_income"           => ($trans_amount>0)? $trans_amount:0,
                            "date_time"            => $end_date);
                        $model2->insertRecord("tbl_cmsn_level",$postedData);
                       // $trns_remark = "Level Income From <b> $fuSerId </b> From Level : <b> $i </b> Package is : <b>$ $collection </b>    ";
                       // $model->wallet_transaction('1',"Cr",$member_ids,$trans_amount,$trns_remark,$end_date,$trans_no,1,"INCOME_L");    
                                
                        }
                        
                        
                        $i++;
                        }
                        }
                        
         }

        }
          
           
                    
}

function  instantIncomeGenertenextg($member_id,$amount,$subcription_id,$type_id)
    {
        $model = new OperationModel();
        $model2 = new SqlModel();
        $AR_PRSS = $model->getProcess();
        $process_id = $AR_PRSS['process_id'];
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];
        $CI =& get_instance(); 
       
        $sponsor_id       = $model->getSponsorId($member_id);
        //	echo "<br>";
		 $sub = $model->checkCounttopup('tbl_subscription','member_id',$member_id,'N');   
	//	echo "<br>";
    //	echo $member_id; 
    
        
if($type_id ==1 ){
 $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total']; 

 if($total==1){
     	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';  
     	    
     	}
    
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	   $per='10'; 
     	    
     	}
    
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
     	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	   $per='10';
     	    
     	}
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	   $per='10';
     	    
     	}
   
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total >=5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	}
    
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
}
elseif($type_id ==2){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
 $total = $PAID_DIR['total']; 
 if($total==1){
     	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	}
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	}
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
   	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	}
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
    	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total >=5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
    
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
elseif($type_id ==3){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
     	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
     	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total >= 5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
elseif($type_id ==4){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
     	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
     	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total >=5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
elseif($type_id ==5){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
      
      	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
      
      
$direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
     	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total>=5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}else{
    $per=10;
    $total=1;
    $direct_bonus=$amount*$per/100;
    $rrrr='Pool';
}
       
    	
    	
    	
    	
        $admincharge      = $direct_bonus*0/100;
        $net_bonus     = $direct_bonus-$admincharge;
          
        if($process_id>0){
           
         
           
           
             // die('ddddddddddd');
            $FfromUserId = $model->getMemberUserId($member_id);
               if(true){
            if($sponsor_id > 0 )
            { 
                 // die('ddddddddddd');
              if($model->checkCount('tbl_subscription','member_id',$sponsor_id) > 0 )
                 {     
            $trans_no         = rand(123434,4564563); 
            
            if($rrrr=='Pool'){
            $trns_remark = "Pool Direct Referral From <b>[".$FfromUserId."]</b> $ <b>".$direct_bonus."/-</b> Credited in your Direct Income <b> $ $net_bonus</b>/-";
            }else{
                
                
             $trns_remark = "Direct Referral From <b>[".$FfromUserId."]</b> $ <b>".$direct_bonus."/-</b> Credited in your Direct Income <b> $ $net_bonus</b>/-";    
                
            }
            $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $member_id,
                               
                                "total_collection"     => $amount,
                                "admin_charge"         => $admincharge,
                                "total_income"         => $direct_bonus , 
                                "net_income"           => $net_bonus,
                                 "type_id"           => $type_id,
                                 "totalcount"           => $total,
                                  "percentage"           => $per,
                              
                                "date_time"            => $end_date, 
                 );
         // PrintR($data_direct);
     
               $model2->insertRecord("tbl_cmsn_direct",$data_direct);
                
            //   $model->wallet_transaction('1',"Cr",$sponsor_id,$net_bonus,$trns_remark,$end_date,$trans_no,1,"INCOME_D"); 
                // $this->db->query("UPDATE `tbl_members` SET `total_income` =  total_income+$netIncome     WHERE member_id ='$sponsor_id';"); 
            }
            }
                
                
                
        }    
                
                
                // Level Income
           
         
         
         
         if(false){
         
            $collection  =  $amount;
            $fuSerId = $model->getMemberUserId($member_id);
            $memberList = $model->memberParentLevelLists2($member_id);
                       
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
                        
                   
                        if($i > 1 and  $i <= 11  and $subcription_id > 0 )//and   $count_directs >= $T_Direct
                        {
                          
                           
                        $level_percentage =   returnLevelPercentage($i);
                         
                          $trans_amount =  $collection*$level_percentage/100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                        $admincharge = $trans_amount*0/100;
                        $trans_amount= $trans_amount-$admincharge;
                           $postedData = array(   
                            "process_id"           => $process_id,
                            "member_id"            => $member_ids,
                            "from_member_id"       => $member_id,
                            "level"                => $i,
                            "returns"              => $level_percentage,
                            "total_income"         => $collection,
                            "admin_charge"         => $admincharge,
                            "net_income"           => ($trans_amount>0)? $trans_amount:0,
                            "date_time"            => $end_date);
                        $model2->insertRecord("tbl_cmsn_level",$postedData);
                       // $trns_remark = "Level Income From <b> $fuSerId </b> From Level : <b> $i </b> Package is : <b>$ $collection </b>    ";
                       // $model->wallet_transaction('1',"Cr",$member_ids,$trans_amount,$trns_remark,$end_date,$trans_no,1,"INCOME_L");    
                                
                        }
                        
                        
                        $i++;
                        }
                        }
                        
         }

        }
          
           
                    
}
function  instantIncomeGenertenextgtesssssssssssssssst($member_id,$amount,$subcription_id,$type_id)
    {
        $model = new OperationModel();
        $model2 = new SqlModel();
        $AR_PRSS = $model->getProcess();
        $process_id = $AR_PRSS['process_id'];
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];
        $CI =& get_instance(); 
       
        $sponsor_id       = $model->getSponsorId($member_id);
        //	echo "<br>";
		 $sub = $model->checkCounttopup('tbl_subscription','member_id',$member_id,'N');   
	//	echo "<br>";
    //	echo $member_id; 
    
        
if($type_id ==1 ){
 $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total']; 

 if($total==1){
     	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';  
     	    
     	}
    
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	   $per='10'; 
     	    
     	}
    
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
     	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	   $per='10';
     	    
     	}
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	   $per='10';
     	    
     	}
   
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total >=5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	}
    
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
}
elseif($type_id ==2){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
 $total = $PAID_DIR['total']; 
 if($total==1){
     	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	}
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	}
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
   	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	}
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
    	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total >=5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
    
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
elseif($type_id ==3){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
     	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
     	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total >= 5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
elseif($type_id ==4){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
     	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
     	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total >=5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}
elseif($type_id ==5){
    $PAID_DIR = "SELECT count(*) as total FROM `tbl_members` WHERE sponsor_id = '$sponsor_id' and member_id IN(SELECT member_id FROM tbl_subscription WHERE type_id = $type_id and type='A')"; 
$PAID_DIR = $model->SqlModel->runQuery($PAID_DIR,true);   
$total = $PAID_DIR['total'];   
 if($total==1){
      
      	if($sub == 1){ 
     	    
     	   $per='10';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
      
      
$direct_bonus= $amount*$per/100;
     
 }
 elseif($total==2){
     	if($sub == 1){ 
     	    
     	   $per='15';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==3){
     	if($sub == 1){ 
     	    
     	   $per='20';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total==4){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
   
     $direct_bonus= $amount*$per/100;
     
 }
 elseif($total>=5){
     	if($sub == 1){ 
     	    
     	   $per='25';
     	    
     	    
     	}else{
     	  $per='10';
     	    
     	} 
    
     $direct_bonus= $amount*$per/100;
     
 }
 else{
     
     $per='10';
     $direct_bonus= $amount*$per/100;
     
 }  
 
    
}else{
    $per=10;
    $total=1;
    $direct_bonus=$amount*$per/100;
    $rrrr='Pool';
}
       
    	
    	
    	
    	
        $admincharge      = $direct_bonus*0/100;
        $net_bonus     = $direct_bonus-$admincharge;
          
        if($process_id>0){
           
         
           
           
             // die('ddddddddddd');
            $FfromUserId = $model->getMemberUserId($member_id);
               if(true){
            if($sponsor_id > 0 )
            { 
                 // die('ddddddddddd');
              if($model->checkCount('tbl_subscription','member_id',$sponsor_id) > 0 )
                 {     
            $trans_no         = rand(123434,4564563); 
            
            if($rrrr=='Pool'){
            $trns_remark = "Pool Direct Referral From <b>[".$FfromUserId."]</b> $ <b>".$direct_bonus."/-</b> Credited in your Direct Income <b> $ $net_bonus</b>/-";
            }else{
                
                
             $trns_remark = "Direct Referral From <b>[".$FfromUserId."]</b> $ <b>".$direct_bonus."/-</b> Credited in your Direct Income <b> $ $net_bonus</b>/-";    
                
            }
            $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $member_id,
                               
                                "total_collection"     => $amount,
                                "admin_charge"         => $admincharge,
                                "total_income"         => $direct_bonus , 
                                "net_income"           => $net_bonus,
                                 "type_id"           => $type_id,
                                 "totalcount"           => $total,
                                  "percentage"           => $per,
                              
                                "date_time"            => $end_date, 
                 );
         // PrintR($data_direct);
     
               $model2->insertRecord("tbl_cmsn_direct_test",$data_direct);
                
            //   $model->wallet_transaction('1',"Cr",$sponsor_id,$net_bonus,$trns_remark,$end_date,$trans_no,1,"INCOME_D"); 
                // $this->db->query("UPDATE `tbl_members` SET `total_income` =  total_income+$netIncome     WHERE member_id ='$sponsor_id';"); 
            }
            }
                
                
                
        }    
                
                
                // Level Income
           
         
         
         
         if(false){
         
            $collection  =  $amount;
            $fuSerId = $model->getMemberUserId($member_id);
            $memberList = $model->memberParentLevelLists2($member_id);
                       
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
                        
                   
                        if($i > 1 and  $i <= 11  and $subcription_id > 0 )//and   $count_directs >= $T_Direct
                        {
                          
                           
                        $level_percentage =   returnLevelPercentage($i);
                         
                          $trans_amount =  $collection*$level_percentage/100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                        $admincharge = $trans_amount*0/100;
                        $trans_amount= $trans_amount-$admincharge;
                           $postedData = array(   
                            "process_id"           => $process_id,
                            "member_id"            => $member_ids,
                            "from_member_id"       => $member_id,
                            "level"                => $i,
                            "returns"              => $level_percentage,
                            "total_income"         => $collection,
                            "admin_charge"         => $admincharge,
                            "net_income"           => ($trans_amount>0)? $trans_amount:0,
                            "date_time"            => $end_date);
                        $model2->insertRecord("tbl_cmsn_level",$postedData);
                       // $trns_remark = "Level Income From <b> $fuSerId </b> From Level : <b> $i </b> Package is : <b>$ $collection </b>    ";
                       // $model->wallet_transaction('1',"Cr",$member_ids,$trans_amount,$trns_remark,$end_date,$trans_no,1,"INCOME_L");    
                                
                        }
                        
                        
                        $i++;
                        }
                        }
                        
         }

        }
          
           
                    
}
function  instantIncomeGenertenonwithdarawl($member_id,$amount,$subcription_id,$type_id)
    {
        $model = new OperationModel();
        $model2 = new SqlModel();
        $AR_PRSS = $model->getProcess();
        $process_id = $AR_PRSS['process_id'];
        // $process_idddddd = $AR_PRSS['process_id']-1;
        $start_date=$AR_PRSS['start_date'];
        $end_date=$AR_PRSS['end_date'];
        $CI =& get_instance(); 
        $sponsor_id       = $model->getSponsorId($member_id);
       
        $per='25';
     $direct_bonus= $amount*25/100;
        $admincharge      = $direct_bonus*0/100;
        $net_bonus     = $direct_bonus-$admincharge;
          
        if($process_id>0){
           
         
           
           
             // die('ddddddddddd');
            $FfromUserId = $model->getMemberUserId($member_id);
               if(true){
            if($sponsor_id > 0 )
            { 
                 // die('ddddddddddd');
              if($model->checkCount('tbl_subscription','member_id',$sponsor_id) > 0 )
                 {     
            $trans_no         = rand(123434,4564563); 
            
            
            $trns_remark = "Withdrawal Direct Referral From <b>[".$FfromUserId."]</b> $ <b>".$direct_bonus."/-</b> Credited in your Wallet";
            
            $data_direct =array(
                                "process_id"           => $process_id,
                                "subcription_id"       => $subcription_id,
                                "member_id"            => $sponsor_id,
                                "from_member_id"       => $member_id,
                               
                                "total_collection"     => $amount,
                                "admin_charge"         => $admincharge,
                                "total_income"         => $direct_bonus , 
                                "net_income"           => $net_bonus,
                                 "type_id"           => $type_id,
                                 "totalcount"           =>  ($total>0)? $total:0,
                                  "percentage"           => $per,
                              
                                "date_time"            => $end_date, 
                 );
         PrintR($data_direct);
     
          $model2->insertRecord("tbl_cmsn_direct",$data_direct);
                
             //  $model->wallet_transaction('1',"Cr",$sponsor_id,$net_bonus,$trns_remark,$end_date,$trans_no,1,"INCOME_D"); 
                //$this->db->query("UPDATE `tbl_members` SET `total_income` =  total_income+$netIncome     WHERE member_id ='$sponsor_id';"); 
            }
            }
                
                
                
        }    
                
                
                // Level Income
           
         
         
         
         if(false){
         
            $collection  =  $amount;
            $fuSerId = $model->getMemberUserId($member_id);
            $memberList = $model->memberParentLevelLists2($member_id);
                       
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
                        
                   
                        if($i > 1 and  $i <= 11  and $subcription_id > 0 )//and   $count_directs >= $T_Direct
                        {
                          
                           
                        $level_percentage =   returnLevelPercentage($i);
                         
                          $trans_amount =  $collection*$level_percentage/100;
                        $trans_amount = number_format($trans_amount, 4, '.', '');
                        $admincharge = $trans_amount*0/100;
                        $trans_amount= $trans_amount-$admincharge;
                           $postedData = array(   
                            "process_id"           => $process_id,
                            "member_id"            => $member_ids,
                            "from_member_id"       => $member_id,
                            "level"                => $i,
                            "returns"              => $level_percentage,
                            "total_income"         => $collection,
                            "admin_charge"         => $admincharge,
                            "net_income"           => ($trans_amount>0)? $trans_amount:0,
                            "date_time"            => $end_date);
                        $model2->insertRecord("tbl_cmsn_level",$postedData);
                       // $trns_remark = "Level Income From <b> $fuSerId </b> From Level : <b> $i </b> Package is : <b>$ $collection </b>    ";
                       // $model->wallet_transaction('1',"Cr",$member_ids,$trans_amount,$trns_remark,$end_date,$trans_no,1,"INCOME_L");    
                                
                        }
                        
                        
                        $i++;
                        }
                        }
                        
         }

        }
          
           
                    
}

 function Communityincomeup($member_id)       {
	$model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];

	  	$QR_CMSN = "SELECT member_id ,subcription_id,date_from,prod_pv ,type_id   from tbl_subscription  where member_id='$member_id' and date_from    = '$end_date' ";
	$RS_CMSN  = $this->SqlModel->runQuery($QR_CMSN); 
 //PrintR($RS_CMSN);
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN):
			 
				 $member_id                = $AR_CMSN['member_id'];
				 $subcription_id           = $AR_CMSN['subcription_id'];
				 $date_from                = $AR_CMSN['date_from'];
				 $prod_pv                  = $AR_CMSN['prod_pv']; 
				 $type_id                  = $AR_CMSN['type_id']; 
                 
                 echo $member_id."<br>";
                				    
                $daily_return = 1;				    
                $trans_amount = $prod_pv;
                $cal_amount   = $trans_amount *$daily_return/100;   
                $cal_amount   = number_format($cal_amount, 4, '.', ''); 
				 
		   
					
				 //$GET_COMMUNITY	 	 	 		 	 			 	
	
                   $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE `member_id` < '$member_id' group BY `member_id` LIMIT 5");   
                    
               // $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE type = 'A' AND `member_id` >  '$member_id' group by member_id  LIMIT 5");  
                $level = 1;
                if(count($GET_COMMUNITY)>0){
                foreach($GET_COMMUNITY as $COM){
                
                
                $data = array(
                                                "member_id"         =>  $member_id,
                                                "from_member_id"    =>  $COM['member_id'],
                                                "subcription_id"    =>  $subcription_id,
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
                            $this->SqlModel->insertRecord("tbl_cmsn_community",$data);$level++;
                          //  $model->insertRecord("tbl_cmsn_community",$data);
                           $FfromUserId = $model->getMemberUserId($COM['member_id']);
                            $trans_no         = rand(123434,4564563); 
                          $trns_remark = " <b>[".$FfromUserId."]</b> Level - $level 'Joining Up' $ <b>".$trans_amount."/-</b> Credited in your Community Bonus <b> $ $cal_amount</b>/-";
                           $model->wallet_transaction('1',"Cr",$member_id,$cal_amount,$trns_remark,$end_date,$trans_no,1,"COMMUNITY"); 
                          
                            
                }
				 
                }
				endforeach;
			}   
			
 
		echo "Community";
		
	}	
function Communityincomedown($member_id)       {
	$model = new OperationModel();
        $AR_PRSS = $model->getProcess();
		$start_date=$AR_PRSS['start_date'];
		$end_date=$AR_PRSS['end_date'];
		$process_id = $AR_PRSS['process_id'];

	  	$QR_CMSN = "SELECT member_id ,subcription_id,date_from,prod_pv ,type_id   from tbl_subscription  where member_id='$member_id' and date_from    = '$end_date' ";
	$RS_CMSN  = $this->SqlModel->runQuery($QR_CMSN); 
// PrintR($RS_CMSN);
		 	if(count($RS_CMSN)>0){
				foreach($RS_CMSN as $AR_CMSN):
			 
				 $member_id                = $AR_CMSN['member_id'];
				 $subcription_id           = $AR_CMSN['subcription_id'];
				 $date_from                = $AR_CMSN['date_from'];
				 $prod_pv                  = $AR_CMSN['prod_pv']; 
				 $type_id                  = $AR_CMSN['type_id']; 
                 
                 echo $member_id."<br>";
                				    
                $daily_return = 1;				    
                $trans_amount = $prod_pv;
                $cal_amount   = $trans_amount *$daily_return/100;   
                $cal_amount   = number_format($cal_amount, 4, '.', ''); 
				 
		   
					
				 //$GET_COMMUNITY	 	 	 		 	 			 	
	
                   $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE `member_id` >'$member_id' group BY `member_id` LIMIT 5");   
                    
               // $GET_COMMUNITY   = $this->SqlModel->runQuery("SELECT member_id FROM `tbl_subscription` WHERE type = 'A' AND `member_id` >  '$member_id' group by member_id  LIMIT 5");  
                $level = 1;
                if(count($GET_COMMUNITY)>0){
                foreach($GET_COMMUNITY as $COM){
                
                
                $data = array(
                                                "member_id"         =>  $member_id,
                                                "from_member_id"    =>  $COM['member_id'],
                                                "subcription_id"    =>  $subcription_id,
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
                            $this->SqlModel->insertRecord("tbl_cmsn_community",$data);$level++;
                          //  $model->insertRecord("tbl_cmsn_community",$data);
                          
                            $FfromUserId = $model->getMemberUserId($COM['member_id']);
                            $trans_no         = rand(123434,4564563); 
                          $trns_remark = " <b>[".$FfromUserId."]</b> Level - $level 'Joining Down' $ <b>".$trans_amount."/-</b> Credited in your Community Bonus <b> $ $cal_amount</b>/-";
                           $model->wallet_transaction('1',"Cr",$member_id,$cal_amount,$trns_remark,$end_date,$trans_no,1,"COMMUNITY"); 
                            
                }
				 
                }
				endforeach;
			}   
			
 
		echo "Community";
		
	}









function getStatusofTransaction($txid)
{
            $model = new OperationModel();
            $Sname = $_SERVER['SERVER_NAME'];  
            $parameters="serverName=$Sname";
  $url="https://xyz.tnrcoin.io/api/getAuth";
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
                    $trnsId     = $txid;
                    $parameters="authKey=$authKey&&serverName=$Sname&trnsId=$trnsId";
                $url="https://xyz.tnrcoin.io/api/cryptoTrnsStatus";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                $return_val = curl_exec($ch);
                $api_result = json_decode($return_val);
                $result  = $api_result->API;
                
             
             return $res = $result->result;   
           
           
                
        }
}

function sendWithdrawCrypto($amount,$address,$user_id,$member_id,$coin)
{
    
        
        
        
        
        
        


    $model = new OperationModel();
            $Sname = $_SERVER['SERVER_NAME'];  
            $parameters="serverName=$Sname";
  $url="https://xyz.tnrcoin.io/api/getAuth";
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
                    
                    $parameters="authKey=$authKey&&serverName=$Sname&amount=$amount&address=$address&user_id=$user_id&member_id=$member_id&coin=$coin";
                $url="https://xyz.tnrcoin.io/api/cryptoWithdraw";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                $return_val = curl_exec($ch);
                $api_result = json_decode($return_val);
                return $result  = $api_result->API;
                
             
              
           
           
                
        }
}
function generateQRofCoinPay($member_id,$user_id,$amount,$price,$requestValue,$coins,$email_id)
{
    $model = new SqlModel();
            $Sname = $_SERVER['SERVER_NAME'];  
            $parameters="serverName=$Sname";
  $url="https://xyz.tnrcoin.io/api/getAuth";
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
                     $email_id = ($email_id!='')?$email_id:'fffffffffffffff@gmail.com';
                    $parameters="authKey=$authKey&&serverName=$Sname&requestValue=$requestValue&coins=$coins&price=$price&emailId=$email_id&member_id=$member_id&user_id=$user_id";
                $url="https://xyz.tnrcoin.io/api/cryptoGenerateQR";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                $return_val = curl_exec($ch);
                $api_result = json_decode($return_val);
                $result  = $api_result->API;
                
             
             $res = $result->result;  //  PrintR($api_result);die;
             if($result->error =='ok')
             {
                    $res = $result->result;   
                    $status  =  getStatusofTransaction($res->txn_id);  
                    
   
                    $data = array(
                        "member_id"         =>  $member_id ,         
                        "txn_id"            =>   $res->txn_id,      
                        "amount"            =>   $res->amount,      
                        "address"           =>   $res->address,       
                        "confirms_needed"   =>   $res->confirms_needed,               
                        "timeout"           =>   $res->timeout,       
                        "checkout_url"      =>   $res->checkout_url,            
                        "status_url"        =>   $res->status_url,          
                        "qrcode_url"        =>   $res->qrcode_url,          
                        "status"            =>   'N',      
                        "date_time"         =>   date('Y-m-d H:i:s'),    
                        "added_usd"         =>  $amount,
                        "usd_price"         =>  $price,
                        "time_created"      =>  $status->time_created,             
                        "time_expires"      =>  $status->time_expires,             
                        "status_text"       =>  $status->status_text,            
                        "type"              =>  $status->type,     
                        "coin"              =>  $status->coin,     
                            
                        
                        );
                    $model->insertRecord(prefix."tbl_coinpayment",$data);
                    return true;
                 
             }
             else
             {
                 return false; 
             }  
           
           
                
        }
        else
        {
            return false;
        }
}

function getRankName($rank_id)
{
   
 
  if($rank_id == 1)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Elite <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 2)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Elite Executive <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 3)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Sr. Executive <span class=' '><i class='fas fa-award' style='font-size: 16px;'></i></span></button>";  
  }
  elseif($rank_id == 4)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Team Leader <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 5)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Manager <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 6)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Sr. Manager <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 7)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Executive Manager <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 8)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Sr. Executive Manager <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 9)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Associate Director <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 10)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Global Director <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 11)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Elite Ambassador <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  elseif($rank_id == 12)
  {
    echo "<button type='button' class='btn mb-1 btn-info' style= 'width: 100%;'>Elite Global Ambassador <span class=' '><i class='fas fa-award'></i></span></button>";  
  }
  else
  {
    echo "<button type='button' class='btn mb-1 btn-warning' style= 'width: 100%;'>Pending</button>";  
  }
  
    
  

}


function getlivecryptoprice($cryptoname) {
        
 $url = "https://api.wazirx.com/sapi/v1/ticker/24hr?symbol=$cryptoname";
$json = file_get_contents($url);
$jo = json_decode($json);
$price= $jo->lastPrice;
 return $price;
        
    }
function getBalanceByAddress($address)
{
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
                    $parameters="authKey=$authKey&&serverName=$Sname&address=$address";
                    $url="https://vertoindia.in/dmt/api/getbalance";
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_POST,1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                    curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                    $return_val = curl_exec($ch);
                    $api_result = json_decode($return_val);
                    return $amount = $api_result->API;
                    
                    
        }
        else
        {
            return  "Inactive Your API";
        }
}
function sendTRXtoUserAddress($member_id,$user_id,$to_address,$trx)
{ 
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
                    $parameters="authKey=$authKey&&serverName=$Sname&trx=$trx&to_address=$to_address&member_id=$member_id&user_id=$user_id";
                $url="https://vertoindia.in/dmt/api/sendTrons";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST,1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
                curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
                $return_val = curl_exec($ch);
                $api_result = json_decode($return_val);
                return $api_return  = $api_result->API;
                
        }
        else
        {
               $api_return['data'] = 'In-active your API';
               $api_return['sts'] = 'N';
               return $api_return;
               
        }
}


function getEGCprice()
{
    $url = 'https://api.bankcex.com/api/v1/ticker/price';
    
$parameters = [ 'symbol' => 'EGCUSDT'  ];

$headers = [
  'Accepts: application/json',
//   'X-CMC_PRO_API_KEY: 3af7f45d-a4b1-423e-8212-d4051466460a'
];
$qs = http_build_query($parameters); // query string encode the parameters
$request = "{$url}?{$qs}"; // create the request URL


$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
  CURLOPT_URL => $request,            // set the request URL
  CURLOPT_HTTPHEADER => $headers,     // set the headers 
  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));

$response = curl_exec($curl); // Send the request, save the response
 
$price =  json_decode($response);
// PrintR($price);die;

return $price_data = $price->price;
    
}



function getCoinMarketCap()
{
    $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
    
$parameters = [
  'start' => '1',
  'limit' => '100',
  'convert' => 'USD',
//   'convert_id' => 1958
];

$headers = [
  'Accepts: application/json',
  'X-CMC_PRO_API_KEY: 3af7f45d-a4b1-423e-8212-d4051466460a'
];
$qs = http_build_query($parameters); // query string encode the parameters
$request = "{$url}?{$qs}"; // create the request URL


$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, array(
  CURLOPT_URL => $request,            // set the request URL
  CURLOPT_HTTPHEADER => $headers,     // set the headers 
  CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
));

$response = curl_exec($curl); // Send the request, save the response
 
$price =  json_decode($response);
//  PrintR($price);die;

$price_data = $price->data;
    foreach($price_data as $P)
    { 
       
        if($P->name =='TRON')
        {
              $quote     =  $P->quote ;
              $USD       = $quote->USD;
              $TRX_PRICE = $USD->price;
              if($TRX_PRICE > 0 )
              {
                  return $TRX_PRICE;
              }
              else
              {
                  return 0;
              }
            
        }
        
    }
     return 0;
}


function returnLevel111($member_id,$from_level){
		$model = new OperationModel();
		$member_id = array($member_id);
		 
		$i =0;$k=1;
		$level=0;
		$dataSet = [];
		while($k > $i	)
		{  
		$data = $model->gettotalLev123($member_id,$level);  
		$member_id = $data['data_list'];
		$dataSet[] = $data;
		$k= $data['total']; 
		$level = $data['level'];
			if($level ==$from_level)
			{
			return $data;
			break;
			}
		} 
		return $dataSet;
		}



function returnLeveltoday($member_id,$from_level,$today_datee){
		$model = new OperationModel();
		$member_id = array($member_id);
		 
		$i =0;$k=1;
		$level=0;
		$dataSet = [];
		while($k > $i	)
		{  
		$data = $model->gettotalLevtoday($member_id,$level,$today_datee);  
		$member_id = $data['data_list'];
		$dataSet[] = $data;
		$k= $data['total']; 
		$level = $data['level'];
			if($level ==$from_level)
			{
			return $data;
			break;
			}
		} 
		return $dataSet;
		}

function returnLevel($member_id,$from_level){
		$model = new OperationModel();
		$member_id = array($member_id);
		 
		$i =0;$k=1;
		$level=0;
		$dataSet = [];
		while($k > $i	)
		{  
		$data = $model->gettotalLev($member_id,$level);  
		$member_id = $data['data_list'];
		$dataSet[] = $data;
		$k= $data['total']; 
		$level = $data['level'];
			if($level ==$from_level)
			{
			return $data;
			break;
			}
		} 
		return $dataSet;
		}

		        
     
        
        function returnLevelTotal($member_id,$from_level){
        $model = new OperationModel();
        $member_id = array($member_id);
         
        $i =0;$k=1;
        $level=0;
        $dataSet = 0;
        while($k > $i   )
        {  
        $data = $model->gettotalLev($member_id,$level);  
        $member_id = $data['data_list'];
     
        $k= $data['total']; 
        $level = $data['level'];
         $dataSet +=$data['total']; 
        } 
        return $dataSet;
        }
        
        
        
        
function returnMatrixLevel($member_id){
        $model = new OperationModel();
        $memId = $member_id;
        $member_id = array($member_id);
        
        $i =0;$k=1;
        $level=0;
        $dataSet = array();
        while($k > $i   )
        {  
        $data = $model->gettotalLevMatrix($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
        
    
         
        if($level == '1' and $k < 2)
        { 
            return $memId;
            break;
        }
         
        if($level == '2' and $k < 4)
        {
         
           foreach($dataSet[0]['data_list'] as $key=> $value)
           {     
                $count =  $model->checkCount('tbl_level_members','spill_id',$value);
              if($count < 2)
            {
            return $value;
            break;
            }  
           }
        }
         
        
        
        if($level == '3' and $k < 8)
        {
        foreach($dataSet[1]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count <2)
            {
            return $value;
            break;
            }  
           }
        }
         
        
        
        
        if($level == '4' and $k < 16)
        {
        foreach($dataSet[2]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count <2)
            {
            return $value;
            break;
            }  
           }
        }
         
        
        
        
        if($level == '5' and $k < 32)
        {
        foreach($dataSet[3]['data_list'] as $key=> $value)
           {
              $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count < 2)
            {
            return $value;
            break;
            }  
           }
        }
         
        
        
        
        if($level == '6' and $k < 64 )
        {
        foreach($dataSet[4]['data_list'] as $key=> $value)
           {
              $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count < 2)
            {
            return $value;
            break;
            }  
           }
        }
         
        
        
        if($level == '7' and $k < 128)
        {
        foreach($dataSet[5]['data_list'] as $key=> $value)
           {
              $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count <2)
            {
            return $value;
            break;
            }  
           }
        }
         
        
        
        if($level == '8' and $k < 256)
        {
        foreach($dataSet[6]['data_list'] as $key=> $value)
           {
              $count =  $model->checkCount('tbl_level_members','spill_id',$value);
            if($count <2)
            {
            return $value;
            break;
            }  
           }
        }
         
        
        if($level == '9' and $k < 512)
        {
        foreach($dataSet[7]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count < 2)
            {
            return $value;
            break;
            }  
           }
        }
        
        if($level == '10' and $k < 1024)
        {
        foreach($dataSet[8]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count < 2)
            {
            return $value;
            break;
            }  
           }
        } 
        
        if($level == '11' and $k < 2048)
        {
        foreach($dataSet[9]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count < 2)
            {
            return $value;
            break;
            }  
           }
        } 
        
        
        if($level == '12' and $k < 4096)
        {
        foreach($dataSet[10]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count < 2)
            {
            return $value;
            break;
            }  
           }
        } 
        
        if($level == '13' and $k < 8192)
        {
        foreach($dataSet[11]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count < 2)
            {
            return $value;
            break;
            }  
           }
        } 
        
        if($level == '14' and $k < 16384)
        {
        foreach($dataSet[12]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count < 2)
            {
            return $value;
            break;
            }  
           }
        } 
        
        if($level == '15' and $k < 32768)
        {
        foreach($dataSet[13]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members','spill_id',$value);
            if($count < 2)
            {
            return $value;
            break;
            }  
           }
        } 
             
        } 
         
        }
function returnMatrixLevelCount($member_id){
        $model = new OperationModel();
        $memId = $member_id;
        $member_id = array($member_id);
        
        $i =0;$k=1;
        $level=0;
        $dataSet = array();
        while($k > $i   )
        {  
        $data = $model->gettotalLevMatrix($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
        
    
         
        if($level == '1' )
        { 
          if($k  >=  2)
          {
          $lvl[1] = '1';
          }
          else
          {
          $lvl[1] = '0';
          }
            
        }
         
        if($level == '2' )
        {
         if($k  >=  4)
          {
          $lvl[2] = '1';
          }
          else
          {
          $lvl[2] = '0';
          }
        }
         
        
        
        if($level == '3' )
        {
        if($k  >=  8)
          {
          $lvl[3] = '1';
          }
          else
          {
          $lvl[3] = '0';
          }
        }
         
        
        
        
        if($level == '4'  )
        {       
        if($k  >=  16)
          {
         $lvl[4] = '1';
          }
          else
          {
          $lvl[4] = '0';
          }
        }
         
        
        
        
        if($level == '5' )
        {
        if($k  >=  32)
          {
         $lvl[5] = '1';
          }
          else
          {
          $lvl[5] = '0';
          }
        }
         
        
        
        
        if($level == '6'  )
        {
         if($k  >=  64)
          {
         $lvl[6] = '1';
          }
          else
          {
          $lvl[6] = '0';
          }
        }
         
        
        
        if($level == '7')
        {
         if($k  >=  128)
          {
         $lvl[7] = '1';
          }
          else
          {
          $lvl[7] = '0';
          }
        }
         
        
        
        if($level == '8'  )
        {
        if($k  >=  256)
          {
         $lvl[8] = '1';
          }
          else
          {
          $lvl[8] = '0';
          }
        }
         
        
        if($level == '9'  )
        {
         if($k  >=  512)
          {
         $lvl[9] = '1';
          }
          else
          {
          $lvl[9] = '0';
          }
        }
        
        if($level == '10'  )
        {
         if($k  >=  1024)
          {
         $lvl[10] = '1';
          }
          else
          {
          $lvl[10] = '0';
          }
        }
        
        if($level == '11'  )
        {
         if($k  >=  2048)
          {
         $lvl[11] = '1';
          }
          else
          {
          $lvl[11] = '0';
          }
        }
        
        if($level == '12'  )
        {
         if($k  >=  4096)
          {
         $lvl[12] = '1';
          }
          else
          {
          $lvl[12] = '0';
          }
        }
        
        if($level == '13'  )
        {
         if($k  >=  8192)
          {
         $lvl[13] = '1';
          }
          else
          {
          $lvl[13] = '0';
          }
        }
        
        if($level == '14'  )
        {
         if($k  >=  16384)
          {
         $lvl[14] = '1';
          }
          else
          {
          $lvl[14] = '0';
          }
        }
        
        if($level == '15'  )
        {
         if($k  >=  32768)
          {
         $lvl[15] = '1';
          }
          else
          {
          $lvl[15] = '0';
          }
        }
         
             
        } 
         
         return $lvl;
        }       
function returnLevelPools($member_id,$from_level){
        $model = new OperationModel();
        $member_id = array($member_id);
         
        $i =0;$k=1;
        $level=0;
        $dataSet =  array();
        while($k > $i   )
        {   
        $data = $model->gettotalLevMatrix($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
            if($level ==$from_level)
            {
            return $data;
            break;
            }
        } 
        return $dataSet;
        }
function ReturnDownlineTotal($member_id,$from_level) {
$dd = returnLevelPools($member_id,'');
         
         foreach($dd as $val)
         {  
         $total += $val['total'];
         }return $total;}   
         
         
         
function returnMatrixLevel2($member_id){
        $model = new OperationModel();
        $memId = $member_id;
        $member_id = array($member_id);
        
        $i =0;$k=1;
        $level=0;
        $dataSet =  array();
        while($k > $i   )
        {  
        $data = $model->gettotalLevMatrix2($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
         
         
        if($level == '1' and $k < 4)
        { 
            return $memId;
            break;
        }
        if($level == '2' and $k < 16)
        {
         
           foreach($dataSet[0]['data_list'] as $key=> $value)
           {     
                $count =  $model->checkCount('tbl_level_members2','spill_id',$value);
              if($count < 4)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '3' and $k < 64)
        {
        foreach($dataSet[1]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members2','spill_id',$value);
            if($count < 4)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '4' and $k < 256)
        {
        foreach($dataSet[2]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members2','spill_id',$value);
            if($count < 4)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '5' and $k < 1024)
        {
        foreach($dataSet[3]['data_list'] as $key=> $value)
           {
              $count =   $model->checkCount('tbl_level_members2','spill_id',$value);
            if($count < 4)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '6' and $k < 4096 )
        {
        foreach($dataSet[4]['data_list'] as $key=> $value)
           {
              $count =   $model->checkCount('tbl_level_members2','spill_id',$value);
            if($count < 4)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '7' and $k < 16384)
        {
        foreach($dataSet[5]['data_list'] as $key=> $value)
           {
              $count =   $model->checkCount('tbl_level_members2','spill_id',$value);
            if($count < 4)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '8' and $k < 65536)
        {
        foreach($dataSet[6]['data_list'] as $key=> $value)
           {
              $count =  $model->checkCount('tbl_level_members2','spill_id',$value);
            if($count <4)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '9' and $k < 262144)
        {
        foreach($dataSet[7]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members2','spill_id',$value);
            if($count < 4)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '10' and $k < 1048576)
        {
        foreach($dataSet[8]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members2','spill_id',$value);
            if($count < 4)
            {
            return $value;
            break;
            }  
           }
        } 
        
     
             
        } 
         
        }
function returnMatrixLevelCount2($member_id){
        $model = new OperationModel();
        $memId = $member_id;
        $member_id = array($member_id);
        
        $i =0;$k=1;
        $level=0;
        $dataSet = array();
        while($k > $i   )
        {  
        $data = $model->gettotalLevMatrix2($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
        
    
         
        if($level == '1' )
        { 
          if($k  >=  4)
          {
          $lvl[1] = '1';
          }
          else
          {
          $lvl[1] = '0';
          }
            
        }
         
        if($level == '2' )
        {
         if($k  >=  16)
          {
          $lvl[2] = '1';
          }
          else
          {
          $lvl[2] = '0';
          }
        }
         
        
        
        if($level == '3' )
        {
        if($k  >=  64)
          {
          $lvl[3] = '1';
          }
          else
          {
          $lvl[3] = '0';
          }
        }
         
        
        
        
        if($level == '4'  )
        {       
        if($k  >=  256)
          {
         $lvl[4] = '1';
          }
          else
          {
          $lvl[4] = '0';
          }
        }
         
        
        
        
        if($level == '5' )
        {
        if($k  >=  1024)
          {
         $lvl[5] = '1';
          }
          else
          {
          $lvl[5] = '0';
          }
        }
         
        
        
        
        if($level == '6'  )
        {
         if($k  >=  4096)
          {
         $lvl[6] = '1';
          }
          else
          {
          $lvl[6] = '0';
          }
        }
         
        
        
        if($level == '7')
        {
         if($k  >=  16384)
          {
         $lvl[7] = '1';
          }
          else
          {
          $lvl[7] = '0';
          }
        }
         
        
        
        if($level == '8'  )
        {
        if($k  >=  65536)
          {
         $lvl[8] = '1';
          }
          else
          {
          $lvl[8] = '0';
          }
        }
         
        
        if($level == '9'  )
        {
         if($k  >=  262144)
          {
         $lvl[9] = '1';
          }
          else
          {
          $lvl[9] = '0';
          }
        }
        
        if($level == '10'  )
        {
         if($k  >=  1048576)
          {
         $lvl[10] = '1';
          }
          else
          {
          $lvl[10] = '0';
          }
        }
        
         
         
             
        } 
         
         return $lvl;
        }       
function returnLevelPools2($member_id,$from_level){
        $model = new OperationModel();
        $member_id = array($member_id);
         
        $i =0;$k=1;
        $level=0;
        $dataSet =  array();
        while($k > $i   )
        {   
        $data = $model->gettotalLevMatrix2($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
            if($level ==$from_level)
            {
            return $data;
            break;
            }
        } 
        return $dataSet;
        }
function ReturnDownlineTotal2($member_id,$from_level) {
$dd = returnLevelPools2($member_id,'');
         
         foreach($dd as $val)
         {  
         $total += $val['total'];
         }return $total;}   
         
         
function returnMatrixLevel3($member_id){
        $model = new OperationModel();
        $memId = $member_id;
        $member_id = array($member_id);
        
        $i =0;$k=1;
        $level=0;
        $dataSet =  array();
        while($k > $i   )
        {  
        $data = $model->gettotalLevMatrix3($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
         
         
        if($level == '1' and $k < 8)
        { 
            return $memId;
            break;
        }
        if($level == '2' and $k < 64)
        {
         
           foreach($dataSet[0]['data_list'] as $key=> $value)
           {     
                $count =  $model->checkCount('tbl_level_members3','spill_id',$value);
              if($count < 8)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '3' and $k < 512)
        {
        foreach($dataSet[1]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members3','spill_id',$value);
            if($count < 8)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '4' and $k < 4096)
        {
        foreach($dataSet[2]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members3','spill_id',$value);
            if($count < 8)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '5' and $k < 32768)
        {
        foreach($dataSet[3]['data_list'] as $key=> $value)
           {
              $count =   $model->checkCount('tbl_level_members3','spill_id',$value);
            if($count < 8)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '6' and $k < 262144 )
        {
        foreach($dataSet[4]['data_list'] as $key=> $value)
           {
              $count =   $model->checkCount('tbl_level_members3','spill_id',$value);
            if($count < 8)
            {
            return $value;
            break;
            }  
           }
        }
         
        
     
             
        } 
         
        }
function returnMatrixLevelCount3($member_id){
        $model = new OperationModel();
        $memId = $member_id;
        $member_id = array($member_id);
        
        $i =0;$k=1;
        $level=0;
        $dataSet =  array();
        while($k > $i   )
        {  
        $data = $model->gettotalLevMatrix3($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
        
    
         
        if($level == '1' )
        { 
          if($k  >=  8)
          {
          $lvl[1] = '1';
          }
          else
          {
          $lvl[1] = '0';
          }
            
        }
         
        if($level == '2' )
        {
         if($k  >=  64)
          {
          $lvl[2] = '1';
          }
          else
          {
          $lvl[2] = '0';
          }
        }
         
        
        
        if($level == '3' )
        {
        if($k  >=  512)
          {
          $lvl[3] = '1';
          }
          else
          {
          $lvl[3] = '0';
          }
        }
         
        
        
        
        if($level == '4'  )
        {       
        if($k  >=  4096)
          {
         $lvl[4] = '1';
          }
          else
          {
          $lvl[4] = '0';
          }
        }
         
        
        
        
        if($level == '5' )
        {
        if($k  >=  32768)
          {
         $lvl[5] = '1';
          }
          else
          {
          $lvl[5] = '0';
          }
        }
         
        
        
        
        if($level == '6'  )
        {
         if($k  >=  262144)
          {
         $lvl[6] = '1';
          }
          else
          {
          $lvl[6] = '0';
          }
        }
         
        
     
         
         
             
        } 
         
         return $lvl;
        }       
function returnLevelPools3($member_id,$from_level){
        $model = new OperationModel();
        $member_id = array($member_id);
         
        $i =0;$k=1;
        $level=0;
        $dataSet =  array();
        while($k > $i   )
        {   
        $data = $model->gettotalLevMatrix3($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
            if($level ==$from_level)
            {
            return $data;
            break;
            }
        } 
        return $dataSet;
        }
function ReturnDownlineTotal3($member_id,$from_level) {
$dd = returnLevelPools3($member_id,'');
         
         foreach($dd as $val)
         {  
         $total += $val['total'];
         }return $total;}            

         
function returnMatrixLevel4($member_id){
        $model = new OperationModel();
        $memId = $member_id;
        $member_id = array($member_id);
        
        $i =0;$k=1;
        $level=0;
        $dataSet = array();
        while($k > $i   )
        {  
        $data = $model->gettotalLevMatrix4($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
         
         
        if($level == '1' and $k < 16)
        { 
            return $memId;
            break;
        }
        if($level == '2' and $k < 256)
        {
         
           foreach($dataSet[0]['data_list'] as $key=> $value)
           {     
                $count =  $model->checkCount('tbl_level_members4','spill_id',$value);
              if($count < 16)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '3' and $k < 4096)
        {
        foreach($dataSet[1]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members4','spill_id',$value);
            if($count < 16)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '4' and $k < 65536)
        {
        foreach($dataSet[2]['data_list'] as $key=> $value)
           {
             $count =   $model->checkCount('tbl_level_members4','spill_id',$value);
            if($count < 16)
            {
            return $value;
            break;
            }  
           }
        }
        if($level == '5' and $k < 1048576)
        {
        foreach($dataSet[3]['data_list'] as $key=> $value)
           {
              $count =   $model->checkCount('tbl_level_members4','spill_id',$value);
            if($count < 16)
            {
            return $value;
            break;
            }  
           }
        }
     
         
        
     
             
        } 
         
        }
function returnMatrixLevelCount4($member_id){
        $model = new OperationModel();
        $memId = $member_id;
        $member_id = array($member_id);
        
        $i =0;$k=1;
        $level=0;
        $dataSet =  array();
        while($k > $i   )
        {  
        $data = $model->gettotalLevMatrix4($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
        
    
         
        if($level == '1' )
        { 
          if($k  >=  8)
          {
          $lvl[1] = '1';
          }
          else
          {
          $lvl[1] = '0';
          }
            
        }
         
        if($level == '2' )
        {
         if($k  >=  64)
          {
          $lvl[2] = '1';
          }
          else
          {
          $lvl[2] = '0';
          }
        }
         
        
        
        if($level == '3' )
        {
        if($k  >=  512)
          {
          $lvl[3] = '1';
          }
          else
          {
          $lvl[3] = '0';
          }
        }
         
        
        
        
        if($level == '4'  )
        {       
        if($k  >=  4096)
          {
         $lvl[4] = '1';
          }
          else
          {
          $lvl[4] = '0';
          }
        }
         
        
        
        
        if($level == '5' )
        {
        if($k  >=  32768)
          {
         $lvl[5] = '1';
          }
          else
          {
          $lvl[5] = '0';
          }
        }
         
        
        
        
        if($level == '6'  )
        {
         if($k  >=  262144)
          {
         $lvl[6] = '1';
          }
          else
          {
          $lvl[6] = '0';
          }
        }
         
        
     
         
         
             
        } 
         
         return $lvl;
        }       
function returnLevelPools4($member_id,$from_level){
        $model = new OperationModel();
        $member_id = array($member_id);
         
        $i =0;$k=1;
        $level=0;
        $dataSet =  array();
        while($k > $i   )
        {   
        $data = $model->gettotalLevMatrix4($member_id,$level);  
        $member_id = $data['data_list'];
        $dataSet[] = $data;
        $k= $data['total']; 
        $level = $data['level'];
            if($level ==$from_level)
            {
            return $data;
            break;
            }
        } 
        return $dataSet;
        }
function ReturnDownlineTotal4($member_id,$from_level) {
$dd = returnLevelPools4($member_id,'');
         
         foreach($dd as $val)
         {  
         $total += $val['total'];
         }return $total;}       
         
         
         
        
    function numtowords($num)
{ 
$ones = array( 
1 => "one", 
2 => "two", 
3 => "three", 
4 => "four", 
5 => "five", 
6 => "six", 
7 => "seven", 
8 => "eight", 
9 => "nine", 
10 => "ten", 
11 => "eleven", 
12 => "twelve", 
13 => "thirteen", 
14 => "fourteen", 
15 => "fifteen", 
16 => "sixteen", 
17 => "seventeen", 
18 => "eighteen", 
19 => "nineteen" 
); 
$tens = array( 
1 => "ten",
2 => "twenty", 
3 => "thirty", 
4 => "forty", 
5 => "fifty", 
6 => "sixty", 
7 => "seventy", 
8 => "eighty", 
9 => "ninety" 
); 
$hundreds = array( 
"hundred", 
"thousand", 
"million", 
"billion", 
"trillion", 
"quadrillion" 
); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
if($i < 20){ 
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
$rettxt .= $tens[substr($i,0,1)]; 
$rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
$rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
$rettxt .= " ".$tens[substr($i,1,1)]; 
$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
} 
} 
if($decnum > 0){ 
$rettxt .= " and "; 
if($decnum < 20){ 
$rettxt .= $ones[$decnum]; 
}elseif($decnum < 100){ 
$rettxt .= $tens[substr($decnum,0,1)]; 
$rettxt .= " ".$ones[substr($decnum,1,1)]; 
} 
} 
return $rettxt; 
return '333';} 


function FCrtRplc($StrVal){
    return str_replace("'","\"",trim($StrVal));
}
function FCrtAdd($StrVal){
    return str_replace("\"","'",trim($StrVal));
}
function StringReplace($StrVal, $RFrom, $RTo){
    return str_replace($RFrom,$RTo,$StrVal);
}
function StripString($strString, $StrType){
    if(strlen($strString)>1){
        return substr($strString,0,strlen($strString)-strlen($StrType));
    }else{
        return $strString;
    }
}
function null_val($variable){
    if(is_numeric($variable)){
        return ($variable>0)? $variable:0;
    }else{
        return ($variable!='')? $variable:"NULL";
    }
}
function getSwitch($variable){
    if(is_numeric($variable)){
        return ($variable>0)? 1:0;
    }else{
        return ($variable=="on")? 1:0;
    }
}
function match_number($from_number,$to_number,$till){
    if($from_number>=0 && $to_number>=0){
        $first_number_floor =  floor($from_number);
        $first_decimal_number = $from_number-$first_number_floor;
        $match_first_number = substr($first_decimal_number,0,$till);
        
        $second_number_floor =  floor($to_number);
        $second_decimal_number = $to_number-$second_number_floor;
        $match_second_number = substr($second_decimal_number,0,$till);
        if($first_number_floor>=$second_number_floor && $match_first_number==$match_second_number){
            return 1;
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}
function panel_name(){
    return WEBSITE;
}
function title_name(){
    return "Dashboard : ".panel_name();
}
function web_name(){
    return WEBSITE;
}
function word_cleanup ($str)
{
    $pattern = "/<(\w+)>(\s|&nbsp;)*<\/\1>/";
    $str = preg_replace($pattern, '', $str);
    return mb_convert_encoding($str, 'HTML-ENTITIES', 'UTF-8');
}
function currency_convert($from_Currency,$to_Currency,$amount) {
    $amount = urlencode($amount);
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);
    $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $regularExpression  = '#\<span class=bld\>(.+?)\<\/span\>#s';
    preg_match($regularExpression, $rawdata, $finalData);
    return $finalData[0];
}
function getSubString($strString, $IntLng){
    return substr($strString,0,$IntLng);
}
function ForEachArr($StrArr){
    foreach($StrArr as $Key => $Val){
        global $$Key;
        $$Key = FCrtRplc($Val);
    }
}


function DisplayDate($DateStr){
    if($DateStr<>"" and $DateStr <> "0000-00-00"){
        return date("d-m-Y", strtotime($DateStr));
    }
}
function DisplayTime($TimeStr){
    if($TimeStr<>"" and $TimeStr <> "0000-00-00"){
        return date("h:i A", strtotime($TimeStr));
    }
}
function InsertDateTime($DateStr){
    if($DateStr<>"" and $DateStr <> "0000-00-00 00:00:00"){
        return date("Y-m-d h:i:s", strtotime($DateStr));
    }
}
function InsertDate($DateStr){
    if($DateStr<>"" and $DateStr <> "0000-00-00"){
        return date("Y-m-d", strtotime($DateStr));
    }
}
function getDateFormat($StrDate, $StrFormat){
    if($StrDate<>"" and $StrDate<>"N/A" and $StrDate <> "0000-00-00"){
        return date($StrFormat,strtotime($StrDate));
    }elseif($StrDate=="N/A"){
        return "N/A" ;
    }
}
function AddTime($flddDate, $StrAdd){
    return date("Y-m-d G:i:s",strtotime(date("Y-m-d G:i:s", strtotime($flddDate)) . " $StrAdd"));
}
function getLocalTime(){
    $db = new SqlModel();
    $result = $db->runQuery("SELECT NOW() AS fldiTime;",true);
    return AddTime($result['fldiTime'],"+0 Hour");
    
}
function getDayDiff($from_date,$to_date){
    $db = new SqlModel();
    $result = $db->runQuery("SELECT DATEDIFF('".$from_date."','".$to_date."') AS  fldiTime;",true);
    return ($result['fldiTime']);
}
function getTime(){
    $AR_Time = mysql_fetch_assoc(mysql_query("SELECT CURTIME() AS fldiTime;"));
    $fldiTime = date('G:i:s');
    return AddTime($fldiTime,"+1 Hour");
}
function printDate($flddDate){
    return date("d F Y h:i:s A", $flddDate);
}
function dateandtime()
{
    return date('Y-m-d H:i:s');
}
function AddToDate($flddDate, $StrAdd){
    return date("Y-m-d",strtotime(date("Y-m-d", strtotime($flddDate)) . " $StrAdd"));
}
function AddToDateSQL($flddDate, $StrAdd){
    $Q_DATE = "SELECT DATE_ADD('$flddDate', INTERVAL $StrAdd) AS flddDate";
    $AR_DATE = ExecQ($Q_DATE,1);
    return $AR_DATE[flddDate];
}
function integerVal($fldiInteger){
    if(FCrtRplc($fldiInteger)>0){
        return FCrtRplc($fldiInteger);
    }else{
        return "0";
    }
}
function varcharVal($fldvVachar){
    if(FCrtRplc($fldvVachar)!=""){
        return FCrtRplc($fldvVachar);
    }else{
        return "Null";
    }
}
function dateDiff($dformat, $FromDate, $ToDate){
    $date_parts1=explode($dformat, $FromDate);
    $date_parts2=explode($dformat, $ToDate);
    $start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
    $end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
    return $end_date - $start_date;
}

function MonthDiff($flddFDate, $flddTDate){
    $flddDate1 = strtotime($flddFDate);
    $flddDate2 = strtotime($flddTDate);
    $fldiYear1 = date('Y', $flddDate1);
    $fldiYear2 = date('Y', $flddDate2);
    $fldiMonth1 = date('n', $flddDate1);
    $fldiMonth2 = date('n', $flddDate2);
    $fldiMonths = ($fldiYear2 - $fldiYear1) * 12 + ($fldiMonth2 - $fldiMonth1);
    return $fldiMonths;
}
function YearDiff($flddFDate, $flddTDate){
$diff = abs(strtotime($flddFDate) - strtotime($flddTDate));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
return $years;
}
function getMonthDays($flddDate){
    $db = new SqlModel();
    $Q_DTQRY = " SELECT DAY(LAST_DAY('$flddDate')) AS fldiDays";
    $AR_DTQRY = $db->runQuery($Q_DTQRY,true);
    return $AR_DTQRY['fldiDays'];
} 
function getMonth($Date){
    $db = new SqlModel();
    $strQ_Fetch = "SELECT MONTH('$Date') AS Month";
    $Arr_Fetch = $db->runQuery($strQ_Fetch,true);
    return $Arr_Fetch['Month']; 
}
function getYear($Date){
    $db = new SqlModel();
    $strQ_Fetch = "SELECT YEAR('$Date') AS Year";
    $Arr_Fetch = $db->runQuery($strQ_Fetch,true);
    return $Arr_Fetch['Year']; 
}
function getMonthDates($flddDate){
    $fldiMDays = getMonthDays($flddDate);
    $fldiMonth = getMonth($flddDate);
    $fldiYear = getYear($flddDate);
    $AR_MD['flddFDate'] = InsertDate("01"."-".$fldiMonth."-".$fldiYear);
    $AR_MD['flddTDate'] = InsertDate($fldiMDays."-".$fldiMonth."-".$fldiYear);
    return $AR_MD;
}
function WriteToFile($ErrorMsg){
    $myFile =  "MySqlErroFile.txt";
    $fh = fopen($myFile, 'a') or die("can't open file");
    fwrite($fh, $ErrorMsg);
    fclose($fh);
}
function ExecQ($Query, $ReturnType){
    $RS_Query = mysql_query($Query);
    if(mysql_errno()){
        WriteToFile(date('Y-m-d H:i:s')."   MySQL error ".mysql_errno().": ".mysql_error()." When executing: $Query\n".$_SERVER['PHP_SELF']."\n");
        echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$Query\n<br>";
        exit;
    }
    switch($ReturnType){
        case 0:
            return $ReturnType;
        break;
        case 1:
            return mysql_fetch_assoc($RS_Query);
        break;
        case 2:
            return $RS_Query;
        break;
    }
}


function NumberFormat($Number){
    if(($Number/10)%10 != 1){
        switch($Number% 10 ){
            case 1: return $Number.'<sup>st</sup>';break;
            case 2: return $Number.'<sup>nd</sup>';break;
            case 3: return $Number.'<sup>rd</sup>';break;
        }
    }
    return $Number.'<sup>th</sup>';
}
function NumberFormat_Txt($Number){
    if(($Number/10)%10 != 1){
        switch($Number% 10 ){
            case 1: return $Number.'st';break;
            case 2: return $Number.'nd';break;
            case 3: return $Number.'rd';break;
        }
    }
    return $Number.'th';
}


#Fixed Code Ends-----------------------------------
function DisplayCombo($SlctVal, $CmbType){
    $db = new SqlModel();
    switch($CmbType){
        case "EXPRNC":
            for($Ctrl=0; $Ctrl < 51; $Ctrl++){
                $CMBTXT = $Ctrl==0?"0": $Ctrl."";
                echo "<option value='".$Ctrl."'"; if($SlctVal == $Ctrl){echo 'selected="selected"';}
                echo ">".$CMBTXT."</option>";
            }
        break;
        case "DAY":
            for($Ctrl=1; $Ctrl < 32; $Ctrl++){
                echo "<option value='".$Ctrl."'"; if($SlctVal == $Ctrl){echo "selected";}
                echo ">".$Ctrl."</option>";
            }
        break;
        case "MONTH":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_months WHERE month_id>0 ORDER BY month_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['month_id']."'";if($SlctVal == $rowSet['month_id']){echo "selected";}
                echo ">".$rowSet['month']."</option>";
            endforeach;
        break;
        case "YEAR":
            $Curr_Yr = date("Y");
            for($Ctrl=$Curr_Yr; $Ctrl >= 1930; $Ctrl--){
                echo "<option value='".$Ctrl."'"; if($SlctVal == $Ctrl){echo "selected";}
                echo ">".$Ctrl."</option>";
            }
        break;
        case "PROCESSOR":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_payment_processor WHERE isDelete>0 ORDER BY processor_name ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['processor_id']."'";if($SlctVal == $rowSet['processor_id']){echo "selected";}
                echo ">".$rowSet['processor_name']."</option>";
            endforeach;
        break;
        case "PROCESS":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_process WHERE pair_sts='Y' ORDER BY process_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['process_id']."'";if($SlctVal == $rowSet['process_id']){echo "selected";}
                echo ">"."".$rowSet['process_id'].")&nbsp;".DisplayDate($rowSet['start_date'])."&nbsp;- to -&nbsp;".DisplayDate($rowSet['end_date'])."</option>";
            endforeach;
        break;
        case "PACKAGE":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_package WHERE delete_sts>0 AND package_id>1 ORDER BY package_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['package_id']."'";if($SlctVal == $rowSet['package_id']){echo "selected";}
                echo ">".$rowSet['package_name']."&nbsp;(".$rowSet['package_price'].")"."</option>";
            endforeach;
        break;
         case "PIN_TYPE":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_pintype WHERE status='N' and type_id < 8 ORDER BY type_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
            echo "<option  value='".$rowSet['type_id']."'";if($SlctVal == $rowSet['type_id']){echo "selected";}
               echo ">".$rowSet['product']." [ ".CURRENCY." ".$rowSet['pin_name']." ]</option>";
            endforeach;
        break;
         case "PIN_TYPEB":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_pintype WHERE status='N' and type_id =5 ORDER BY type_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
            echo "<option  value='".$rowSet['type_id']."'";if($SlctVal == $rowSet['type_id']){echo "selected";}
               echo ">".$rowSet['product']." [ ".CURRENCY." ".$rowSet['pin_name']." ]</option>";
            endforeach;
        break;
          case "POOLPIN_TYPE":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_pintype WHERE  type_id >= 6 ORDER BY type_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
            echo "<option style='background: #311898!important;' value='".$rowSet['type_id']."'";if($SlctVal == $rowSet['type_id']){echo "selected";}
                echo ">".$rowSet['pin_name']."&nbsp;(".$rowSet['pin_price'].")"."</option>";
            endforeach;
        break;
            case "RPIN_TYPE":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_pintype WHERE  type_id >= 15 and type_id <= 21 ORDER BY type_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
            echo "<option value='".$rowSet['type_id']."'";if($SlctVal == $rowSet['type_id']){echo "selected";}
                echo ">".$rowSet['pin_name']."   </option>";
            endforeach;
        break;
        
             case "PIN_TYPE_VALUE":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_pintype WHERE  type_id < 8 ORDER BY type_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
            echo "<option value='".$rowSet['type_id']."'";if($SlctVal == $rowSet['type_id']){echo "selected";}
                 echo ">".$rowSet['product']." [ ".CURRENCY." ".$rowSet['pin_name']." ]</option>";
            endforeach;
        break;
        
        
            case "REPIN_TYPE_VALUE":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_retopup_pin WHERE 1 ORDER BY type_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
            echo "<option value='".$rowSet['type_id']."'";if($SlctVal == $rowSet['type_id']){echo "selected";}
                echo ">".$rowSet['package_name']."   [ Rs ".($rowSet['amount'])." ]</option>";
            endforeach;
        break;
        
        
        case "BANK":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_banks WHERE 1 ORDER BY bank_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['bank_id']."'";if($SlctVal == $rowSet['bank_id']){echo "selected";}
                echo ">".$rowSet['bank_name']."</option>";
            endforeach;
        break;
        case "CITY":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_city WHERE 1 ORDER BY city_name ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['city_name']."'";if($SlctVal == $rowSet['city_name']){echo "selected";}
                echo ">".$rowSet['city_name']."</option>";
            endforeach;
        break;
        case "STATE":
            $QR_SELECT = "SELECT DISTINCT  state_name FROM ".prefix."tbl_city WHERE 1 ORDER BY state_name ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['state_name']."'";if($SlctVal == $rowSet['state_name']){echo "selected";}
                echo ">".$rowSet['state_name']."</option>";
            endforeach;
        break;
        case "COUNTRY":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE country_code!='' ORDER BY country_name ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['country_code']."'";if($SlctVal == $rowSet['country_code']){echo "selected";}
                echo ">".$rowSet['country_name']."</option>";
            endforeach;
        break;
        case "COUNTRY_ISO":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE country_code!='' ORDER BY country_name ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['country_iso']."'";if($SlctVal == $rowSet['country_iso']){echo "selected";}
                echo ">".$rowSet['country_name']."</option>";
            endforeach;
        break;
        case "COUNTRY_PPT":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE country_code!='' 
            AND country_iso IN (SELECT ppt_country FROM tbl_ppt) ORDER BY country_name ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['country_iso']."'";if($SlctVal == $rowSet['country_iso']){echo "selected";}
                echo ">".$rowSet['country_name']."</option>";
            endforeach;
        break;
        case "LANG_PPT":
            $QR_SELECT = "SELECT DISTINCT ppt_lang FROM ".prefix."tbl_ppt WHERE ppt_lang!='' 
            ORDER BY ppt_lang ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['ppt_lang']."'";if($SlctVal == $rowSet['ppt_lang']){echo "selected";}
                echo ">".$rowSet['ppt_lang']."</option>";
            endforeach;
        break;
        case "MOBILE_CODE":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE phonecode>0 GROUP BY phonecode ORDER BY phonecode ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['phonecode']."'";if($SlctVal == $rowSet['phonecode']){echo "selected";}
                echo ">+".$rowSet['phonecode']." (".$rowSet['country_code'].")</option>";
            endforeach;
        break;
        case "WALLET":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_wallet WHERE 1 ORDER BY wallet_name ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['wallet_id']."'";if($SlctVal == $rowSet['wallet_id']){echo "selected";}
                echo ">".$rowSet['wallet_name']."</option>";
            endforeach;
        break;
        case "CASH_TRADE":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_wallet WHERE wallet_id IN(1,3) ORDER BY wallet_name ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['wallet_id']."'";if($SlctVal == $rowSet['wallet_id']){echo "selected";}
                echo ">".$rowSet['wallet_name']."</option>";
            endforeach;
        break;
        case "WALLET_CASH":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_wallet WHERE wallet_id IN(1,2) ORDER BY wallet_name ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['wallet_id']."'";if($SlctVal == $rowSet['wallet_id']){echo "selected";}
                echo ">".$rowSet['wallet_name']."</option>";
            endforeach;
        break;
        case "FONT_AWSOME": 
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_font_awsome_icon ORDER BY icon_name ASC;";
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['icon_id']."'";if($SlctVal == $rowSet['icon_id']){echo "selected";}
                echo ">".$rowSet['icon_name']."</option>";
            endforeach;
        break;
        case "MAIN_MENU":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_sys_menu_main ORDER BY order_id ASC;";
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['ptype_id']."'";if($SlctVal == $rowSet['ptype_id']){echo "selected";}
                echo ">".$rowSet['type_name']."</option>";
            endforeach;
        break;
        case "USRGRP":
            $QR_SELECT = "SELECT * FROM ".prefix."tbl_oprtr_grp ORDER BY group_id ASC;";
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['group_id']."'";if($SlctVal == $rowSet['group_id']){echo "selected";}
                echo ">".$rowSet['group_name']."</option>";
            endforeach;
        break;
        case "EMAIL_TEMPLATE":
            $QR_SELECT = "SELECT DISTINCT type FROM tbl_mail_send WHERE 1 ORDER BY type ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['type']."'";if($SlctVal == $rowSet['type']){echo "selected";}
                echo ">".$rowSet['type']."</option>";
            endforeach;
        break;
        case "ACCOUNT_TYPE":
            echo "<option value='USD'"; if($SlctVal == 'USD'){echo "selected";} echo ">USD</option>";
            echo "<option value='EURO'"; if($SlctVal == 'EURO'){echo "selected";} echo ">EURO</option>";
            echo "<option value='GBP'"; if($SlctVal == 'GBP'){echo "selected";} echo ">GBP</option>";
        break;
        case "YN":
            echo "<option value='0'"; if($SlctVal == '0'){echo "selected";} echo ">Yes</option>";
            echo "<option value='1'"; if($SlctVal == '1'){echo "selected";} echo ">No</option>";
        break;
        case "YESNOFLAG":
            echo "<option value='N'"; if($SlctVal == 'N'){echo "selected";} echo ">SET NO</option>";
            echo "<option value='Y'"; if($SlctVal == 'Y'){echo "selected";} echo ">SET YES</option>";
        break;
        case "ACT_INACT":
            echo "<option value='N'"; if($SlctVal == 'N'){echo "selected";} echo ">In Active</option>";
            echo "<option value='Y'"; if($SlctVal == 'Y'){echo "selected";} echo ">Active</option>";
        break;
        case "NOTICE":
            echo "<option value='Na'"; if($SlctVal == 'Na'){echo "selected";} echo ">Any Time</option>";
            echo "<option value='7days'"; if($SlctVal == '7days'){echo "selected";} echo ">7 Days</option>";
            echo "<option value='15days'"; if($SlctVal == '15days'){echo "selected";} echo ">15 Days</option>";
            echo "<option value='1month'"; if($SlctVal == '1month'){echo "selected";} echo ">1 Month</option>";
            echo "<option value='3months'"; if($SlctVal == '3months'){echo "selected";} echo ">3 Months</option>";
        break;
        case "TMPLT":
            echo "<option value='01'"; if($SlctVal == '01'){echo "selected";} echo ">Menu on Left</option>";
            echo "<option value='02'"; if($SlctVal == '02'){echo "selected";} echo ">Menu on Top</option>";
        break;
        case "LOGSTS":
            echo "<option value='N'"; if($SlctVal == 'N'){echo "selected";} echo ">NOT TRACED</option>";
            echo "<option value='F'"; if($SlctVal == 'F'){echo "selected";} echo ">FAILED LOGIN</option>";
            echo "<option value='S'"; if($SlctVal == 'S'){echo "selected";} echo ">SUCCESS LOGIN</option>";
        break;
        case "METHOD":
            echo "<option value='BITCOIN'"; if($SlctVal == 'BITCOIN'){echo "selected";} echo ">Bitcoin</option>";
            echo "<option value='PERFECT'"; if($SlctVal == 'PERFECT'){echo "selected";} echo ">Perfect Money</option>";
            echo "<option value='BANKWIRE'"; if($SlctVal == 'BANKWIRE'){echo "selected";} echo "> Bank Wire</option>";
            echo "<option value='EWALLET'"; if($SlctVal == 'EWALLET'){echo "selected";} echo ">E-Wallet</option>";
        break;
        case "CAPPING_TYPE":
            echo "<option value='Y'"; if($SlctVal == 'Y'){echo "selected";} echo ">Year</option>";
            echo "<option value='M'"; if($SlctVal == 'M'){echo "selected";} echo ">Month</option>";
            echo "<option value='W'"; if($SlctVal == 'W'){echo "selected";} echo ">Week</option>";
            echo "<option value='D'"; if($SlctVal == 'D'){echo "selected";} echo ">Days</option>";
        break;
        case "DATE_TIME":
            $today_date = InsertDate(getLocalTime());
            $QR_SELECT = "SELECT DISTINCT date_time FROM tbl_daily_return WHERE  DATE(date_time)!='".$today_date."' ORDER BY date_time ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            echo '<option value="'.$today_date.'">Date : &nbsp; '.getDateFormat($today_date,"d D m Y").'</option>';
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['date_time']."'";if($SlctVal == $rowSet['date_time']){echo "selected";}
                echo ">Date : &nbsp; ".getDateFormat($rowSet['date_time'],"d D m Y")."</option>";
            endforeach;
        break;
        case "CATEGORY":
            $QR_SELECT = "SELECT * ".prefix."FROM tbl_category WHERE 1 ORDER BY category_id ASC"; 
            $rowSets = $db->runQuery($QR_SELECT);
            foreach($rowSets as $rowSet):
                echo "<option value='".$rowSet['category_id']."'";if($SlctVal == $rowSet['category_id']){echo "selected";}
                echo ">".$rowSet['category_name']."</option>";
            endforeach;
        break;
    }
}


function UniqueId($Type){
    $db =  new SqlModel();
    switch($Type){
        case "UNIQUE_NO":
            srand((double)microtime()*1000000);
            $data .= "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghigklmnopqrstuvwxyz";
            for($i = 0; $i < 25; $i++){
                $fldvNumber .= substr($data, (rand()%(strlen($data))), 1);
            }
            if($fldvNumber!=""){
                return $fldvNumber;
            }else{ return UniqueId("UNIQUE_NO"); }
        break;
        case "TICKET_NO":
            $data = "123456789";
            for($i = 0; $i < 7; $i++){
                $ticket_no .= substr($data, (rand()%(strlen($data))), 1);
            }
            $Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_support WHERE ticket_no='$ticket_no';";
            $AR_CHK = $db->runQuery($Q_CHK,true);
            if($AR_CHK['fldiCtrl']==0){
                return $ticket_no;
            }else{
                return UniqueId("TICKET_NO");
            }
        break;
        case "SMS_OTP":
            $data = "123456789";
            for($i = 0; $i <= 6; $i++){
                $sms_otp .= substr($data, (rand()%(strlen($data))), 1);
            }
            $Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_sms_otp WHERE sms_otp='$sms_otp';";
            $AR_CHK = $db->runQuery($Q_CHK,true);
            if($AR_CHK['fldiCtrl']==0){
                return $sms_otp;
            }else{
                return UniqueId("SMS_OTP");
            }
        break;
        case "TRNS_NO":
            $data = "123456789";
            for($i = 0; $i < 7; $i++){
                $unique_no .= substr($data, (rand()%(strlen($data))), 1);
            }
            $Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_wallet_trns WHERE trans_ref_no='$unique_no';";
            $AR_CHK = $db->runQuery($Q_CHK,true);
            if($AR_CHK['fldiCtrl']==0){
                return $unique_no;
            }else{
                return UniqueId("TRNS_NO");
            }
        break;
        case "TRNS_PASSWORD":
            $data = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghigklmnopqrstuvwxyz";
            for($i = 0; $i < 10; $i++){
                $trns_password .= substr($data, (rand()%(strlen($data))), 1);
            }
            $Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE trns_password='$trns_password';";
            $AR_CHK = $db->runQuery($Q_CHK,true);
            if($AR_CHK['fldiCtrl']==0){
                return $trns_password;
            }else{
                return UniqueId("TRNS_PASSWORD");
            }
        break;
        case "ORDER_NO":
            $data = "123456789";
//          for($i = 0; $i < 7; $i++){
//              $unique_no .= substr($data, (rand()%(strlen($data))), 1);
//          }
//          $Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_coin_payment WHERE order_no='$unique_no';";
//          $AR_CHK = $db->runQuery($Q_CHK,true);
//          if($AR_CHK['fldiCtrl']==0){
//              return $unique_no;
//          }else{
//              return UniqueId("ORDER_NO");
//          }

return rand(1111111,99999999);
        break;
    }
}

function just_clean($string){
    $specialCharacters = array('#' => '','$' => '','%' => '','&' => '','@' => '','.' => '','?' => '','+' => '','=' => '','?' => '','\'' => '','/' => '',);
    while (list($character, $replacement) = each($specialCharacters)) {
        $string = str_replace($character, '-' . $replacement . '-', $string);
    }
    $string = strtr($string,"??????? ??????????????????????????????????????????????","AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn");
    $string = preg_replace('/[^a-zA-Z0-9_]/', ' ', $string);
    $string = preg_replace('/^[-]+/', '', $string);
    $string = preg_replace('/[-]+$/', '', $string);
    $string = preg_replace('/[-]{2,}/', ' ', $string);
    return $string;
}
function RemoveEnter($StrString){
    return trim( preg_replace( '/\s+/', ' ', $StrString));  
    //return nl2br($StrString, false);
}

#Send SMS
function Send_Single_SMS($fldvMobile, $SMS){
    if($_SERVER['HTTP_HOST'] != "localhost:81" && $_SERVER['HTTP_HOST'] != "localhost"){
        /*$userid = "#"; 
        $pwd = "674c4"; 
        $msgtype = "s";
        $ctype=1;
        $sender="CTRADE";
        $pno = $fldvMobile; 
        $msgtxt = urlencode($SMS); 
        $alert=1;

        $url = "http://smsc.vianett.no/ActiveServer/MT/";
        $ch = curl_init(); 
        if (!$ch){die("Couldn't initialize a cURL handle");}
        $ret = curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=sssssss@gmail.com&password=674c4&destinationaddr=$pno&message=$msgtxt&refno=1&fromAlpha=$sender");
        $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $curlresponse = curl_exec($ch);
        curl_close($ch);*/
        
    }
}
function Send_Single_SMS_Admin($fldvMobile, $fldvEmail, $SMS){
    $CI =& get_instance();
    if($_SERVER['HTTP_HOST'] != "localhost:81" && $_SERVER['HTTP_HOST'] != "localhost"){
        /*$userid = "fffffffffffffffffff@gmail.com"; //your username
        $pwd = "674c4"; 
        $msgtype = "s";
        $ctype=1;
        $sender="CTRADE";
        $pno = $fldvMobile; 
        $msgtxt = urlencode($SMS); 
        $alert=1;

        $url = "http://smsc.vianett.no/ActiveServer/MT/";
        $ch = curl_init(); 
        if (!$ch){die("Couldn't initialize a cURL handle");}
        $ret = curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "username=fffffffffffffffffff@gmail.com&password=674c4&destinationaddr=$pno&message=$msgtxt&refno=1&fromAlpha=$sender");
        $ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $curlresponse = curl_exec($ch);
        curl_close($ch);*/
        
        $to = $fldvEmail;
        $subject = WEBSITE. " SMS OTP";
        $message = "Hi ".$to."<br />".$SMS."<br /> Best regards <br />, ".WEBSITE." Team";
        mail($to, $subject, $message);
    }
}



function convert_number($number){ 
    if(($number < 0) || ($number > 99999999999)){ throw new Exception("Number is out of range");}
    $Cn = floor($number / 10000000);  /* Millions (giga) */ 
    $number -= $Cn * 10000000; 
    $Gn = floor($number / 100000);  /* Millions (giga) */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 
    if ($Cn) 
    { 
        $res .= convert_number($Cn) . " Crore "; 
    } 
    
    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Lakh "; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand "; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 
function getHeightWidth($ImagesPath, $reqWidth, $reqHeight){
    $file=trim($ImagesPath);
    if(file_exists($file)) {
        $dimension=getimagesize($file);
        if($dimension){
            $width=$dimension[0];
            $height=$dimension[1];
            if($reqWidth!="" & $reqHeight!=""){
                if($width>$reqWidth) $newWidth=$reqWidth;                       
                else $newWidth=$width;
                $newHeight=floor(($newWidth/$width)*$height);
                if($newHeight>$reqHeight) {         
                    $newWidth=$newWidth*($reqHeight/$newHeight);
                    $newHeight=$reqHeight;
                }
            }else{
                $newWidth=$width;
                $newHeight=$height;
            }
            
            $ARHW["width"]=$newWidth;
            $ARHW["height"]=$newHeight;
            return $ARHW;
        }
    }
}


function DisplayMessage($fldvSwitch,$fldvMessage){
    echo '<script>$(function(){ setInterval(function(){$("#jsCallId").slideUp(600);}, 6000); });</script>';
    if($fldvSwitch){
        switch($fldvSwitch){
            case "success":
                $print="<div id='jsCallId' style='margin:3px;' class='success cmntext'>!! $fldvMessage !!</div>";
            break;
            case "warning":
                $print="<div id='jsCallId' style='margin:3px;' class='warning cmntext'>!! $fldvMessage !!</div>";
            break;
            case "failed":
                $print="<div id='jsCallId' style='margin:3px;' class='attention cmntext'>!! $fldvMessage !!</div>";
            break;
            
        }
        echo $print;
    }
}
function getWebPageName($PAGEURL){
    $this_page = basename($PAGEURL);
    if(strpos($this_page, "?") !== false) $this_page = reset(explode("?", $this_page));
    return $this_page;
}
function _e($string){
  $key = "MAL_979805"; //key to encrypt and decrypts.
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }

   return urlencode(base64_encode($result));
}
function _d($string){
     $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }
   return $result;
}
function SelectTableWithOption($tblname,$field,$strwhr){
    $config = new SqlModel();
    if($strwhr!=""){
        $QryWher="AND $strwhr";
    }
    $result = $config->runQuery("SELECT ".prefix."$field FROM $tblname WHERE 1 $QryWher;",true);
    return $result[$field];
}
function SelectTable($tblname,$field,$strwhr){
    $config = new SqlModel();
    if($strwhr!=""){
        $QryWher="AND $strwhr";
    }
    $QR_SELECT = "SELECT ".prefix."$field FROM $tblname WHERE 1 $QryWher;";
    $result = $config->runQuery($QR_SELECT,true);
    return $result;
}
function DeleteTableRow($tblname,$strwhr){
    $CI =& get_instance();
    if($strwhr!=""){
        $Del_Table="DELETE  FROM ".prefix."$tblname WHERE   $strwhr";
        $CI->db->query($Del_Table);
        return $CI->db->affected_rows();
    }
}
function UpdateTable($tblname,$field,$strwhr){
    $CI =& get_instance();
    if($strwhr!=""){
        $Up_Table="UPDATE ".prefix."$tblname SET $field WHERE $strwhr";
        $CI->db->query($Up_Table);
        return $CI->db->affected_rows();
    }
}
function InsertTable($tblname,$field){
    $CI =& get_instance();
    if($field!=""){
        $In_Table="INSERT INTO  ".prefix."$tblname SET $field";
        $CI->db->query($In_Table);
        return $CI->db->insert_id();
    }
}
function GetTableInArray($tableName,$fieldName,$strWhere){
     if($strWhere!=""){
        $queryWhere="AND $strWhere";
    }
    $QR_SELECT_TABLE="SELECT $fieldName FROM ".prefix."$tableName WHERE 1 $queryWhere";
    $QR_RESULT_TABLE =ExecQ($QR_SELECT_TABLE,2);
    $AR_RT = array();
    $i=0;
    while($QR_ARRAY_TABLE=mysql_fetch_array($QR_RESULT_TABLE)){
        $AR_RT[$i]=$QR_ARRAY_TABLE[$fieldName];
        $i++;
    }
    return $AR_RT;
}
function pop_loader($fldvPath){
    $fldvUrl = BASE_PATH;
    echo '<link rel="stylesheet" type="text/css" href="'.$fldvUrl.'popups/jquery_popupbox.css" />
    <script type="text/javascript" src="'.$fldvUrl.'popups/popups.js"></script>';
}
function javascript_alert($fldvMessage){
    echo '<script language="javascript" type="text/javascript">
    alert("'.$fldvMessage.'");
    </script>';
}

function jquery_validation(){
    echo '<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'validator/validationEngine.jquery.css" />
    <script type="text/javascript" src="'.BASE_PATH.'validator/jquery.validationEngine.js"></script>
    <script type="text/javascript" src="'.BASE_PATH.'validator/jquery.validationEngine-en.js"></script>';
}
function auto_complete(){
    echo '<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'autocomplete/autocomplete.css" />
    <script type="text/javascript" src="'.BASE_PATH.'/autocomplete/autocomplete.js"></script>';
}
function jquery_file($fldvFile){
    $fldvUrl = BASE_PATH;
    if($fldvFile!=""){
        $fldvFileArr = explode(",",$fldvFile);
        foreach($fldvFileArr as $key=>$fldvNewFile){
            echo '<script type="text/javascript" src="'.$fldvUrl.$fldvNewFile.'"></script>';
        }
        
    }
}
function web_css($fldvFile){
    $fldvUrl =GetMISCCharges("fldvURL");
    if($fldvFile!=""){
        $fldvFileArr = explode(",",$fldvFile);
        foreach($fldvFileArr as $key=>$fldvNewFile){
            echo '<link rel="stylesheet" type="text/css" href="'.$fldvUrl.$fldvNewFile.'" />';
        }
        
    }
}
function jquery_open(){
    echo '<script type="text/javascript">';
}
function jquery_close(){    
    echo '</script>';
}
function page_redirect($fldvPath){
    if($fldvPath!=""){
        header("Location: $fldvPath");
    }else{
        header("Location: ?");
    }
}
function Number($table){
    $Q_Ctrl = "SELECT COUNT(fldiNumber) AS fldiCtrl FROM $table";
    $AR_Ctrl = ExecQ($Q_Ctrl,1);
    $fldiNumber = (100000 + 100000*$AR_Ctrl[fldiCtrl]);
    return $fldiNumber;
}

function currency($from_Currency,$to_Currency,$amount) {
    $amount = urlencode($amount);
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);
    $url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $data = explode('"', $rawdata);
    $data = explode(' ', $data['3']);
    $var = $data['0'];
    return round($var,3);
}

function highlightWords($content, $search){
    if(is_array($search)){
        foreach ( $search as $word ){   
            if($word!="" and $word!="0" and $word!="on" and $word!="." and $word!=";" and $word!="name" and $word!="off" and $word!=$search[fldiJbSkrId] and $word!="IN"and $word!="yes" and $word!="AnyKey")
            { 
            if(!is_numeric($word)){
                $neword=explode(",",$word);
                foreach($neword as $key=>$values){
                     $content = str_ireplace(strtolower($values), '<span class="label label-success">'.$values.'</span>', strtolower($content));
                 }
             } 
            }
        }
    } else {
        if($search!="" and $search!="0"){
            $content = str_ireplace(strtolower($search), '<span class="abel label-success">'.$search.'</span>', strtolower($content));
        }        
    }
    return $content;
} 

function DisplayStar($fldiRating){
    $fldvURL = GetMISCCharges("fldvURL");
    $fldvLink = $fldvURL."setupimages/star.png";
    
    switch($fldiRating){
        case "1":
            echo '<span style="float:right;"><img  src="'.$fldvLink.'"></span>';
        break;
        case "2":
            echo '<span style="float:right;"><img src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"></span>';
        break;
        case "3":
            echo '<span style="float:right;"><img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"></span>';
        break;
        case "4":
            echo '<span style="float:right;"><img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img " src="'.$fldvLink.'"></span>';
        break;
        case "5":
            echo '<span style="float:right;"><img src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"></span>';
        break;
    }
}
function DsplyCurrPrice($fldiPrice){
    if($fldiPrice){
        return "$&nbsp;".number_format($fldiPrice,2);
    }   
}
function CountWord($fldvName){  
    if($fldvName!=""){
        $fldiWord = strlen($fldvName);
        if($fldiWord<=60){
            return $fldvName;
        }else{
            return substr($fldvName,0,60)."...";
        }
    }
}
function setWord($fldvName,$fldvNumber){    
    if($fldvName!=""){
        $fldiWord = strlen($fldvName);
        if($fldiWord<=$fldvNumber){
            return $fldvName;
        }else{
            return substr($fldvName,0,$fldvNumber)."...";
        }
    }
}

function checkRadio($fldvField,$fldvMatch,$fldvDefault){
    if( ($fldvField!="" && $fldvField==$fldvMatch) or ( $fldvDefault=="true" and $fldvField=="") ){
     echo 'checked="checked"';
    }
}

function javascript_close(){
    echo '<script language="javascript" type="text/javascript">
    window.opener.location.reload();
    window.opener.focus();
    window.close();
    </script>';
}
function garbage_param(){
    $fldvSSS=session_id();
    $fldvRemote = $_SERVER[REMOTE_ADDR];
    $flddTime = $_SERVER[REQUEST_TIME];
    return "&fldvRemote=$fldvRemote&flddTime=$flddTime&fldvSSS=$fldvSSS";
}
function javascript_redirect($fldvPageName){
  if($fldvPageName!=""){
    echo '<script language="javascript" type="text/javascript">
        window.location.href="'.$fldvPageName.'";
    </script>';
  } 
}

function echoo($fldvFiled){ 
    if(!is_numeric($fldvFiled)){
        echo ($fldvFiled!="")? $fldvFiled:"N/A";
    }else{
        echo ($fldvFiled>0)? $fldvFiled:"N/A";
    }   
}
function getSumOrder($fldvSwitch,$fldvFiled){
    switch($fldvSwitch){
        case "MEMBER":
            return SelectTableWithOption("tbl_order_food","SUM(fldiAmount)","fldiMemId='$fldvFiled' AND fldcAprSts='Y'");
        break;
    }
}
function DisplayCurrency($fldiPrice){
    return "$".number_format($fldiPrice,2);
}

function date_picker(){
    $fldvUrl =GetMISCCharges("fldvURL");
    echo '<link rel="stylesheet" type="text/css" href="'.$fldvUrl.'datepicker/date_input.css" />
    <script type="text/javascript" src="'.$fldvUrl.'datepicker/jquery.date_input.pack.js"></script>';
}

$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
function getOS() { 
    global $user_agent;
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function getBrowser(){
        $u_agent = isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT']:$_SERVER['HTTP_USER_AGENT'];
        $bname=$platform=$version=$ub="Unknown";
        $os_array = array('/windows nt 6.2/i'=>'Windows 8', '/windows nt 6.1/i'=>'Windows 7', '/windows nt 6.0/i'=>'Windows Vista', '/windows nt 5.2/i'=>'Windows Server 2003/XP x64',
                    '/windows nt 5.1/i'=>'Windows XP', '/windows xp/i'=>'Windows XP','/windows nt 5.0/i'=>'Windows 2000','/windows me/i'=>'Windows ME','/win98/i'=>'Windows 98',
                    '/win95/i'=>'Windows 95', '/win16/i'=>'Windows 3.11','/macintosh|mac os x/i'=>'Mac OS X','/mac_powerpc/i'=>'Mac OS 9','/linux/i'=>'Linux','/ubuntu/i'=>
                    'Ubuntu', '/iphone/i'=>'iPhone','/ipod/i'=>'iPod','/ipad/i'=>'iPad','/android/i'=>'Android','/blackberry/i'=>'BlackBerry','/webos/i'=>'Mobile');
        foreach ($os_array as $regex => $value) { 
            if(preg_match($regex, $u_agent)){$platform=$value;}
        }  
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }elseif(preg_match('/Firefox/i',$u_agent)){
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }elseif(preg_match('/Chrome/i',$u_agent)){
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }elseif(preg_match('/Safari/i',$u_agent)){
            $bname = 'Apple Safari';
            $ub = "Safari";
        }elseif(preg_match('/Opera/i',$u_agent)){
            $bname = 'Opera';
            $ub = "Opera";
        }elseif(preg_match('/Netscape/i',$u_agent)){
            $bname = 'Netscape';
            $ub = "Netscape";
        }
        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if(!preg_match_all($pattern, $u_agent, $matches)){
            // we have no matching number just continue
        }
        // see how many we have
        $i=count($matches['browser']);
        if ($i != 1){
            if(strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }else{
                $version= isset($matches['version'][1])?$matches['version'][1]:'';
            }
        }else{
            $version= $matches['version'][0];
        }
        // check if we have a number
        if($version==null || $version==""){
            $version="?";
        }
        return array(
                'userAgent' => $u_agent,
                'name'      => $bname,
                'browser'   => $ub,
                'version'   => $version,
                'platform'  => $platform,
                'pattern'    => $pattern
        );
}
function static_message($type,$message){
    $CI = & get_instance();
    if($type!="" and $message!=""){     
        $CI->session->unset_userdata('type');
        $CI->session->unset_userdata('message');

        $CI->session->set_userdata('type',$type);
        $CI->session->set_userdata('message',$message);
    }
}
function display_message(){
    $CI = & get_instance();
    echo '<script>$(function(){ setInterval(function(){$("#jsCallId").slideUp(600);}, 10000); });</script>';
    $message = $CI->session->userdata('message');
    $type = $CI->session->userdata('type');
    if($message!=''){
        switch($type){
            case "success":
                $print="<div class='alert alert-block alert-success' id='jsCallId'><i class='ace-icon fa fa-check green'></i>&nbsp;".$message."</div>";
            break;
            case "failed":
            case "warning":
            default:
                $print="<div class='alert alert-block alert-danger' id='jsCallId'><i class='ace-icon fa fa-times red'></i>&nbsp;".$message."</div>";
            break;  
            
        }
        $CI->session->unset_userdata('type');
        $CI->session->unset_userdata('message');
        echo $print;
    }
}
function set_message($fldcType,$fldvMessage){
    $CI = & get_instance();
    if($fldcType!="" and $fldvMessage!=""){     
        $CI->session->unset_userdata('fldcType');
        $CI->session->unset_userdata('fldvMessage');

        $CI->session->set_userdata('fldcType',$fldcType);
        $CI->session->set_userdata('fldvMessage',$fldvMessage);
    }
}
function get_message(){
    $CI = & get_instance();
    echo '<script>$(function(){ setInterval(function(){$("#jsCallId").slideUp(600);}, 10000); });</script>';
    $fldvMessage = $CI->session->userdata('fldvMessage');
    $fldcType = $CI->session->userdata('fldcType');
    if($fldvMessage!=''){
        switch($fldcType){
            case "success": 
               $print="<div class='alert alert-success solid alert-dismissible fade show'><svg viewBox='0 0 24 24' width='24' height='24' stroke='currentColor' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round' class='me-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11'></path></svg> ".$fldvMessage."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><span><i class='mdi mdi-close'></i></span></button></div>";
            break;
            case "failed":
            case "warning":
            default:
                  $print="<div class='alert alert-danger solid alert-dismissible fade show'><svg viewBox='0 0 24 24' width='24' height='24' stroke='currentColor' stroke-width='2' fill='none' stroke-linecap='round' stroke-linejoin='round' class='me-2'><polyline points='9 11 12 14 22 4'></polyline><path d='M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11'></path></svg> ".$fldvMessage."<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'><span><i class='mdi mdi-close'></i></span></button></div>";
         break;  
            
        }
        $CI->session->unset_userdata('fldcType');
        $CI->session->unset_userdata('fldvMessage');
        echo $print;
    }
}
function get_message_new(){
    $CI = & get_instance();
    echo '<script>$(function(){ setInterval(function(){$("#jsCallId").slideUp(600);}, 10000); });</script>';
    $fldvMessage = $CI->session->userdata('fldvMessage');
    $fldcType = $CI->session->userdata('fldcType');
    if($fldvMessage!=''){
        switch($fldcType){
            case "success":
                $print="<div id='main-poup'><div class='modalPopup1'><div class='modalContent'><button class='buttonStyle' id='button'><i class='fa fa-times' aria-hidden='true'></i></button><h3>Your Rasiregistration Has Been Successfully</h3><div><div><p><strong>Name:</strong><span>sonu</span></p><p><strong>Email:</strong><span>sonu12345@gmail.com</span></p><p><strong>Mobile Number:</strong><span>123456890</span></p></div><div><a href='#'><img src='images/Logo.png' alt=''></a></div></div><div></div></div></div></div>";
            break;
            case "failed":
            case "warning":
            default:
                $print="<div style='color:red;background:white;' class='alert alert-block alert-danger' id='jsCallId'><i class='ace-icon fa fa-times red'></i><strong>&nbsp;".$fldvMessage."</strong></div>";
            break;  
            
        }
        $CI->session->unset_userdata('fldcType');
        $CI->session->unset_userdata('fldvMessage');
        echo $print;
    }
}
function DisplayText($fldvField){
    switch($fldvField){
        case "MEM_L":
            return "Left";
        break;
        case "MEM_R":
            return "Right";
        break;
        case "ADVERT_P":
            return "Pending";
        break;
        case "ADVERT_C":
            return "Confirmed";
        break;
        case "ADVERT_R":
            return "Rejected";
        break;
        case "LOG_S":
            return "Success";
        break;
        case "LOG_F":
            return "Failed";
        break;
        case "TIME_Y":
            return "Year";
        break;
        case "TIME_M":
            return "Month";
        break;
        case "TIME_W":  
            return "Week";
        break;
        case "TIME_D":
            return "Days";
        break;
        case "GENDER_":
        case "GENDER_M":
            return "Male";
        break;
        case "GENDER_F":
            return "Female";
        break;
        case "TICKET_O":
            return "Customer Reply";
        break;
        case "TICKET_P":
            return "Ticket Open";
        break;
        case "TICKET_R":
            return "Admin Reply";
        break;
        case "TICKET_H":
            return "Admin Reply";
        break;
        case "TICKET_C":
            return "Close";
        break;
        case "LOG_N":
            return "N/A";
        break;
        case "WITHDRAW_P":
            return "Pending";
        break;
        case "WITHDRAW_C":
            return "Completed";
        break;
        case "WITHDRAW_R":
            return "Rejected";
        break;
        case "DEPOSIT_P":
            return "Pending";
        break;
        case "DEPOSIT_C":
            return "Approved";
        break;
        case "DEPOSIT_R":
            return "Rejected";
        break;
        case "INCOME_Y":
            return "Paid";
        break;
        case "PIN_N":
            return "Pending";
        break;
        case "PIN_Y":
            return "Approved";
        break;
        case "PIN_C":
            return "Rejected";
        break;
        case "N":
            return "Pending";
        break;
        
    }
}
function DisplayMonth($fldvValue){
    if($fldvValue!=""){
        $fldvValueArr = array_filter(explode(",",$fldvValue));
        echo '<ul class="holder" style="width:95%">';
        foreach($fldvValueArr as $key=>$value){
            $monthName = date('F', mktime(0, 0, 0, $value, 10));
            echo '<li  class="bit-box" rel="103">'.$monthName.'</li>';
        }
        echo '</ul>';
        
    }
}
function setSession($fldvField,$fldvValue){
    return $_SESSION[$fldvField]=$fldvValue;
}
function getSession($fldvFiled){
    return $_SESSION[$fldvFiled];
}
function generateSeoUrl($controller,$action='',$params='') {
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $baseUrl = base_url();
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = BASE_PATH.$controllerName . "/" . $actionName . $paramString;
    return $generatedUrl;
}
function generateSeoUrlCourier($controller,$action='',$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
        $generatedUrl = COURIER_PATH.$controllerName . "/" . $actionName . $paramString;
    return $generatedUrl;
}
function generateSeoUrlAdmin($controller,$action='',$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = ADMIN_PATH.$controllerName . "/" . $actionName . $paramString;
    return $generatedUrl;
}
function generateSeoUrlMember($controller,$action='',$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = MEMBER_PATH.$controllerName . "/" . $actionName . $paramString;
    return $generatedUrl;
}
function generateMemberForm($controller,$action='',$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = MEMBER_PATH.$controllerName . "/" . $actionName . $paramString;
    return $generatedUrl;   
}
function generateAdminForm($controller,$action='',$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = ADMIN_PATH.$controllerName . "/" . $actionName . $paramString;
    return $generatedUrl;   
}
function generateForm($controller,$action='',$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = BASE_PATH.$controllerName . "/" . $actionName . $paramString;
    return $generatedUrl;   
}
function redirect_page($controller,$action,$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = ADMIN_PATH.$controllerName . "/" . $actionName . $paramString;
    redirect($generatedUrl,'refresh'); exit;
}

function redirect_courier($controller,$action,$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = COURIER_PATH.$controllerName . "/" . $actionName . $paramString;
    redirect($generatedUrl); exit;
}

function redirect_member($controller,$action,$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = MEMBER_PATH.$controllerName . "/" . $actionName . $paramString;
    redirect($generatedUrl,'refresh'); exit;
}
function redirect_front($controller,$action,$params=''){
    $controllerName = ($controller!="")? $controller:"index";       
    $actionName = ($action == '') ? "": $action;
    $paramString = '';
    foreach ($params as $key => $para) {
        $paramString .= "/" . $key . "/" . $para;
    }
    $generatedUrl = BASE_PATH.$controllerName . "/" . $actionName . $paramString;
    redirect($generatedUrl); exit;
}
function getMemberImage($member_id){
    $db = new SqlModel();
    $QR_MEM = "SELECT tm.member_id, tm.photo, tm.gender FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
    $AR_MEM = $db->runQuery($QR_MEM,true);
    $image_path = BASE_PATH."upload/member/".$AR_MEM['photo'];
    $fldvImageArr= @getimagesize($image_path);
    switch($AR_MEM['gender']):
        case "F":
            if($fldvImageArr['mime']=="") { 
                $image_path = BASE_PATH."assets/images/avatars/avatar03.png";
            }           
        break;
        case "M":
        default:
            if($fldvImageArr['mime']=="") { 
                $image_path = BASE_PATH."assets/img/default_profile.png";
            }
        break;
    endswitch;
    return $image_path;
}
function Send_Mail($ARRAY,$fldvTemplate){
    $model = new OperationModel();
    if($_SERVER['HTTP_HOST']!=''){
        switch($fldvTemplate){
            case "INVITATION":
                $fldvEmail  = FCrtRplc($ARRAY['mail_email']);
                $fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
                $fldvSubject  = FCrtRplc($ARRAY['email_subject']);
                $fldvMessage  = FCrtRplc($ARRAY['email_body']);
            break;
            case "REGISTER":
                $member_id  = FCrtRplc($ARRAY['member_id']);
                $fldvSubject = WEBSITE." Registration";
                $fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
                $PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"option_name"=>"welcome_template"));
            break;
            case "EMAIL_VERIFY":
                $member_id  = FCrtRplc($ARRAY['member_id']);
                $fldvSubject =  WEBSITE." Email verifcation";
                $AR_MEM = $model->getMember($member_id);
                $fldvEmail = $AR_MEM['member_email'];
                $fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
                $PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"option_name"=>"email_verify"));
            break;
            case "FUND_SENDER":
                $member_id  = FCrtRplc($ARRAY['member_id']);
                $amount = FCrtRplc($ARRAY['amount']);
                $fldvSubject =  WEBSITE." Fund Transaction Notification";
                $AR_MEM = $model->getMember($member_id);
                $fldvEmail = $AR_MEM['member_email'];
                $fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
                $PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"amount"=>$amount,"option_name"=>"fund_sender"));
            break;
            case "FUND_RECIVER":
                $member_id  = FCrtRplc($ARRAY['member_id']);
                $amount = FCrtRplc($ARRAY['amount']);
                $fldvSubject =  WEBSITE." Fund Transaction Notification";
                $AR_MEM = $model->getMember($member_id);
                $fldvEmail = $AR_MEM['member_email'];
                $fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
                $PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"amount"=>$amount,"option_name"=>"fund_receiver"));
            break;
            case "RESET_TRNS":
                $member_id = FCrtRplc($ARRAY['member_id']);
                $AR_MEM = $model->getMember($member_id);
                $fldvEmail = $AR_MEM['member_email'];
                $trns_password = UniqueId("TRNS_PASSWORD");
                $model->updateTransactionPassword($member_id,$trns_password);
                $fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
                $fldvSubject  =  WEBSITE." Transaction  Password Reset";
                $PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"trns_password"=>$trns_password,"option_name"=>"reset_transaction_password"));
            break;
            case "FORGOT_PASSWORD":
                $member_id = FCrtRplc($ARRAY['member_id']);
                $AR_MEM = $model->getMember($member_id);
                $fldvEmail = $AR_MEM['member_email'];
                $fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
                $fldvSubject  =  WEBSITE." Password Recovery";
                $PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"option_name"=>"forgot_password"));
            break;
            case "ADMIN_CHANGE_PASSWORD":
                $email_rq_id = FCrtRplc($ARRAY['email_rq_id']);
                $member_id = FCrtRplc($ARRAY['member_id']);
                $AR_REQ = $model->getEMAILOTP($request_id);
                $fldvEmail = $AR_REQ['email_id'];
                $fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
                $fldvSubject  =  WEBSITE." Admin Password Reset";
                $PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"email_rq_id"=>$email_rq_id,"option_name"=>"admin_password_reset"));
            break;
        }
        if($fldvEmail!="" && $_SERVER['HTTP_HOST']!="localhost"){
            $fldvServerMail = $model->getValue("CONFIG_MASS_LOGIN");
            $fldvComName = $model->getValue("CONFIG_COMPANY_NAME");
            
            $mail   = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = $model->getValue("CONFIG_MASS_HOST");
            $mail->SMTPAuth = true;
            $mail->Username = $model->getValue("CONFIG_MASS_LOGIN");
            $mail->Password = $model->getValue("CONFIG_MASS_PASSWORD");
        
            $body   = ($PARAM)? getHttpContent($PARAM):$fldvMessage;
            
            $mail->AddReplyTo($fldvServerMail,$fldvComName);
            $mail->SetFrom($fldvServerMail, $fldvComName);
            $mail->AddReplyTo($fldvServerMail,$fldvComName);    
            if($fldvAttachment==true){
                $mail->AddAttachment($fldiLink,$fileName);
            }
            $fldvEmail = '';
            foreach($fldvEmailArr as $fldvEmail){
                $mail->AddAddress($fldvEmail,$fldvSubject);
                $mail->Subject    = $fldvSubject;
                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
                $mail->MsgHTML($body);
                $mail->Send();
                #if($_SERVER['REMOTE_ADDR']=="114.79.169.107"){if(!$mail->Send()) { echo 'Mailer Error: ' . $mail->ErrorInfo;exit;}}
                $mail->ClearAddresses();
            }
        }   
    }
}


function Send_Otp_Mail($member_id,$request_id){
    $model = new OperationModel();
    $fldvSubject =  WEBSITE." OTP verifcation";
    $AR_MEM = $model->getMember($member_id);
    $fldvEmail = $AR_MEM['member_email'];
    $fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
    $PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"request_id"=>$request_id,"option_name"=>"otp_mail"));
    
    if($fldvEmail!=""){
            $fldvServerMail = $model->getValue("CONFIG_MASS_LOGIN");
            $fldvComName = $model->getValue("CONFIG_COMPANY_NAME");
            
            $mail   = new PHPMailer();
            $mail->IsSMTP();
            $mail->Host = $model->getValue("CONFIG_MASS_HOST");
            $mail->SMTPAuth = true;
            $mail->Username = $model->getValue("CONFIG_MASS_LOGIN");
            $mail->Password = $model->getValue("CONFIG_MASS_PASSWORD");
        
            $body   = ($PARAM)? getHttpContent($PARAM):$fldvMessage;
            
            $mail->AddReplyTo($fldvServerMail,$fldvComName);
            $mail->SetFrom($fldvServerMail, $fldvComName);
            $mail->AddReplyTo($fldvServerMail,$fldvComName);    
            if($fldvAttachment==true){
                $mail->AddAttachment($fldiLink,$fileName);
            }
            $fldvEmail = '';
            foreach($fldvEmailArr as $fldvEmail):
                $mail->AddAddress($fldvEmail,$fldvSubject);
                $mail->Subject    = $fldvSubject;
                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
                $mail->MsgHTML($body);
                $mail->Send();
                #if($_SERVER['REMOTE_ADDR']=="114.79.169.107"){if(!$mail->Send()) { echo 'Mailer Error: ' . $mail->ErrorInfo;exit;}}
                $mail->ClearAddresses();
            endforeach;
    }       
}


function getHttpContent($url){                      
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);             
    $html .= curl_exec($curl);
    curl_close ($curl);
    return $html;
}
function DisplayICon($icon_id){
        return SelectTableWithOption("tbl_font_awsome_icon","icon_name","icon_id='$icon_id'");
}
function validate($address){
       $decoded = decodeBase58($address);
 
       $d1 = hash("sha256", substr($decoded,0,21), true);
       $d2 = hash("sha256", $d1, true);
 
       if(substr_compare($decoded, $d2, 21, 4)){
               throw new \Exception("bad digest");
       }
       return true;
}
function get_web_page($url) {
    $ch = curl_init();
    // Disable SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // Will return the response, if false it print the response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // Set the url
    curl_setopt($ch, CURLOPT_URL,$url);
    // Execute
    $result=curl_exec($ch);
    // Closing
    curl_close($ch);
    
    // Will dump a beauty json :3
    return $result;
}
function decodeBase58($input) {
       $alphabet = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
 
       $out = array_fill(0, 25, 0);
       for($i=0;$i<strlen($input);$i++){
               if(($p=strpos($alphabet, $input[$i]))===false){
                       throw new \Exception("invalid character found");
               }
               $c = $p;
               for ($j = 25; $j--; ) {
                       $c += (int)(58 * $out[$j]);
                       $out[$j] = (int)($c % 256);
                       $c /= 256;
                       $c = (int)$c;
               }
               if($c != 0){
                   throw new \Exception("address too long");
               }
       }
 
       $result = "";
       foreach($out as $val){
               $result .= chr($val);
       }
 
       return $result;
}
function btc_encode($amount){
    if(is_numeric($amount)){
        return  ($amount*100000000);
    }
}
function btc_decode($amount){
    if(is_numeric($amount)){
        return  ($amount/100000000);
    }
}

function btc_val($amount,$decimal=''){
    if(is_numeric($amount)){
        return number_format($amount,($decimal)? $decimal:BTC);
    }else{  
        return 0;
    }
}
function cal_btc($amount){
    if(is_numeric($amount)){
        return number_format($amount,BTC,".",""); 
    }else{  
        return 0;
    }
}
?>