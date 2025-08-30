<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$today_date = getLocalTime();
$segment = $this->uri->uri_to_assoc(2);
 
$request_id = _d($segment['request_id']);
$member_id = $this->session->userdata('mem_id');
$wallet_id = $this->OperationModel->getWallet(WALLET1);
$AR_MEM = $model->getMember($member_id);

$LDGR = $model->getCurrentBalancewal($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	 
 
$QR_PAGES= " SELECT * FROM `tbl_crypto_trns` where member_id ='$member_id' order by id DESC	";
$PageVal = DisplayPages($QR_PAGES, 25, $Page, $SrchQ); //PrintR($PageVal);die;





 ?>
	
	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Fund Request Option</h4>
                  </div>
                    <div class="card-body">
				 
                 <div class="card-text">
					 
						  	<?php echo get_message(); ?>
						
						<style>
						
						.color301a{background-color: #beeaea!important;}
						.color302a{background-color: #f7e6b9!important;}
						.color303a{background-color: #f3c893!important;}
						.color304a{background-color: #beeaea!important;}
						.color305a{background-color: #beeaea!important;}
						.color306a{background-color: #beeaea!important;}
						
					 
}


}
						</style>
						<section id="minimal-statistics-bg">
						<div class="row">
       	<a href="<?php echo BASE_PATH;?>member/ewallet/requestfund/TRX" >
       	 <div class="col-xl-3 col-lg-6 col-12">
            <div class="">
                <div class="card-content">
                    <div class="card-body">
                        <img src="<?php echo BASE_PATH;?>upload/icon/ico/trxx.png" style="width: 170px;">
                    </div>
                </div>
            </div>
        </div>
       </a>
        <a href="<?php echo BASE_PATH;?>member/ewallet/requestfund/BNB" >
		<div class="col-xl-3 col-lg-6 col-12">
            <div class="">
                <div class="card-content">
                    <div class="card-body">
                        <img src="<?php echo BASE_PATH;?>upload/icon/ico/binance.png" style="width: 170px;">
                    </div>
                </div>
            </div>
        </div>
        </a>
        <a href="<?php echo BASE_PATH;?>member/ewallet/requestfund/BTC" >
		<div class="col-xl-3 col-lg-6 col-12">
            <div class="">
                <div class="card-content">
                    <div class="card-body">
                        <img src="<?php echo BASE_PATH;?>upload/icon/ico/bitcoin.png" style="width: 170px;">
                    </div>
                </div>
            </div>
        </div>		
        </a>
        <a href="<?php echo BASE_PATH;?>member/ewallet/requestfund/ETH" >
		<div class="col-xl-3 col-lg-6 col-12">
            <div class="">
                <div class="card-content">
                    <div class="card-body">
                        <img src="<?php echo BASE_PATH;?>upload/icon/ico/etherss.png" style="width: 170px;">
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
	
	
	<div class="row">
       <a href="<?php echo BASE_PATH;?>member/ewallet/requestfund/USDT" >  
	 <div class="col-xl-3 col-lg-6 col-12">
            <div class="">
                <div class="card-content">
                    <div class="card-body">
                        <img src="<?php echo BASE_PATH;?>upload/icon/ico/tether.png" style="width: 170px;">
                    </div>
                </div>
            </div>
        </div>
        </a>
         <a href="<?php echo BASE_PATH;?>member/ewallet/requestfund/BTT" >  
		<div class="col-xl-3 col-lg-6 col-12">
            <div class="">
                <div class="card-content">
                    <div class="card-body">
                        <img src="<?php echo BASE_PATH;?>upload/icon/ico/bittorrent.png" style="width: 170px;">
                    </div>
                </div>
            </div>
        </div>	
        </a>
          <a href="<?php echo BASE_PATH;?>member/ewallet/requestfund/BITRON" >  
        
			<div class="col-xl-3 col-lg-6 col-12">
            <div class="">
                <div class="card-content">
                    <div class="card-body">
                        <img src="<?php echo BASE_PATH;?>upload/icon/ico/BITtrons.png" style="width: 170px;">
                    </div>
                </div>
            </div>
        </div>	
        </a>
         <a href="<?php echo BASE_PATH;?>member/ewallet/requestfund/QRCODE">
      
        	<div class="col-xl-3 col-lg-6 col-12">
            <div class="">
                <div class="card-content">
                    <div class="card-body">
                        <img src="<?php echo BASE_PATH;?>upload/icon/QRCODE.png" style="width: 170px;">
                    </div>
                </div>
            </div>
        </div></a>		
    <!-- <a href="<?php echo BASE_PATH;?>member/razorpay/">
        	<div class="col-xl-3 col-lg-6 col-12">
            <div class="">
                <div class="card-content">
                    <div class="card-body">
                        <img src="<?php echo BASE_PATH;?>upload/icon/rlogo.png" style="width: 170px;">
                    </div>
                </div>
            </div>
        </div></a>-->	
    </div>
						
						</section>
					<?php if(false){ ?>	
					<h4 class="card-title">Fund Request  History	</h4>	
						  <div class="card-content collapse show">
                 
                <div class="table-responsive">
                    <table class="display table table-striped table-hover dataTable" style="color:white;">
							 
 					
 

<thead>
                       <tr>
                            <th>S.No.</th>
                            
                            <th>Date</th>
                            <th>Mode </th>
                           
                            
                            <th>USD</th>
                            <th>Status</th>
                            
							<th>Remark</th>
                            <th>Attachment</th>                           
                        </tr>

                            
</thead>
   <tbody>
				<?php   if($PageVal['TotalRecords'] > 0){
				$Ctrl=$PageVal['RecordStart']+1;
                 $this->load->library('CoinpaymentsAPI'); 
				$cps_api = new   CoinpaymentsAPI(API_PRIVATE_KEY, API_PUBLIC_KEY, 'json'); 
 				foreach($PageVal['ResultSet'] as $AR_DT):
			    
               $transaction_response = $cps_api->GetTxInfoSingle($AR_DT['txn_id']);    
                 $transaction_response = $cps_api->GetRatesWithAccepted();   
               //   PrintR($transaction_response);die('dddd'); 
               $sts_text = $transaction_response['result']['status_text'];
               $sts = $transaction_response['result']['status'];
				?>
              <tr>
                <td class=""><?php echo $Ctrl; ?></td>
               <td><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                <td><?php echo $AR_DT['mode']; ?></td>
               
                 <td>$<?php echo number_format($AR_DT['amount']); ?></td>
               
                <td><?php    if($sts  =='2'){ echo "Complete" ; }
                             elseif($sts  =='1'){echo "Funds Sent" ;}
                             elseif($sts  =='0'){echo "Pending" ;}
                             elseif($sts  =='-1'){echo "Cancelled" ;}
                             elseif($sts  =='-2'){echo "Cancelled: Below ShapeShift Minimum" ;}
                             elseif($sts  =='-3'){echo "Cancelled: Above ShapeShift Maximum" ;}
                             elseif($sts  =='-4'){echo "Cancelled: No ETH available to use as gas." ;}
                             else{echo "Unknown" ;}
                ?></td>
              
                 <td><?php echo $sts_text; ?></td>
               <td><a     target="_blank" class="btn btn-danger">Pay Link</a></td> 
                 <!--href="<?php echo BASE_PATH;?>member/cryptogateway/status?txnId=<?php echo _e($AR_DT['txn_id'] );?>"-->
              </tr>
              <?php $Ctrl++;
			   endforeach;	}else{
									?>
									<tr class="odd" role="row">
										<td colspan="10" align="center">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
            </tbody>
 </table>
                </div>
            </div>
	
	<?php } ?>
	 
						 
						</div>
						
						</div>
                </div>
              </div>
            </div>
            
            
          </div>
        </section>
       
      </div>
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>