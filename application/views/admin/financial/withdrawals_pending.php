<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$cryptoname='tusdusdt';
// echo $cryptonameprice = $model->getlivecryptoprice($cryptoname);
      
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

        $price =getlivecryptoprice($cryptoname);// getCoinMarketCap();  
        $addcharge = $price *5/100;
        $price = $price + $addcharge;
        
        
        
        
    $CONFIG_ELITE_RATE = $model->getValue("CONFIG_ELITE_RATE");
    
  $form_data = $this->input->post(); 
  $today_date = getLocalTime();
  $segment = $this->uri->uri_to_assoc(2);
  $action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
  $transfer_id = ($form_data['transfer_id'])? $form_data['transfer_id']:_d($segment['transfer_id']);
  $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
  
  $wallet_id = $model->getWallet(WALLET1);


  if($_GET['crypto_address']!=''){
      $crypto_address = FCrtRplc($_GET['crypto_address']);
    $StrWhr .=" AND tm.trx_address='$crypto_address'";
    $SrchQ .="&crypto_address=$crypto_address";
  }
  
  if($_GET['user_id']!=''){
    $member_id = $model->getMemberId($_GET['user_id']);
    $StrWhr .=" AND tm.member_id='$member_id'";
    $SrchQ .="&user_id=$user_id";
  }
  if($_GET['processor_id']>0){
    $processor_id = FCrtRplc($_GET['processor_id']);
    $StrWhr .=" AND tft.processor_id='$processor_id'";
    $SrchQ .="&processor_id=$processor_id";
  }

  if($_GET['from_date']!='' && $_GET['to_date']!=''){
    $from_date = InsertDate($_GET['from_date']);
    $to_date = InsertDate($_GET['to_date']);
    $StrWhr .=" AND DATE(tft.date_time) BETWEEN '$from_date' AND '$to_date'";
    $SrchQ .="&from_date=$from_date&to_date=$to_date";
  }
  
  if($_GET['trns_status']!=''){
    $trns_status = FCrtRplc($_GET['trns_status']);
    $StrWhr .=" AND tft.trns_status='".$trns_status."'";
    $SrchQ .="&trns_status=$trns_status";
  }
  else
  {
      
   $trns_status  ='P';
    $StrWhr .=" AND tft.trns_status='".$trns_status."'";
  }
  if($action_request!='') {
    $trns_status = _d($segment['trns_status']);
    switch($action_request){
      case "STS":
        switch($trns_status):
          case "C":
          $trns_date = InsertDate($today_date);
            $AR_TRF = $model->getFundTransfer($transfer_id);
            $AR_MEM = $model->getMember($AR_TRF['to_member_id']);
           
            if($AR_TRF['trns_status']=='P'){
                
                     
              if($AR_TRF['trns_amount']>0){
                  
                  
               if($model->getValue("CONFIG_COINPAY_NO_OFF") == 'Y')   
               {
              
                                  //  $DT            = $data->data; 
                                    $res_data      = json_encode($res2); //json_encode($data->data);
                                    $txid          = rand();//$DT->txid; 
                      
                  $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array( 'txid' => $txid, 'res_data' =>$res_data  ,'coin_rate' => $price,  'coins_total' =>0 , 'coins_charge' => 0,    'coins_trns' => 0,  "trns_status"=>$trns_status,"status_up_date"=>$today_date), array("transfer_id"=>$transfer_id));
                //  $model->wallet_transaction($AR_TRF['wallet_id'],"Dr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request from Admin",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");
                        
                        
                       
                    $trns_remark = "USDT Transfer FROM [".$AR_MEM['user_id']."]" ;
                    $trans_no = rand(11111,999999);
                   
                  //  $model->wallet_transaction(50,"Dr",1,$tt1,$trns_remark,$today_date,$trans_no,"1","TRX");
                  //  $model->setWalletTRX($tt1,'Dr');
                    //  coins_trns
                    
                
                    
                    
                  set_message("success","Fund transfer successfull");   
                  redirect_page("financial","withdrawals",array());
                  
                    
                 
                 if(false)
                 {
                              
                                $result  = $this->coinpayments->masswithdraw($tt3,$AR_TRF['trxaddress']);
                                
                    
                 if($result['error'] =='ok')
                  {  //$data->sts == 'Y'
                      
                      
                      $res1 = $result['result'];  
                      $res2 = $res1['wd1'];
                  if($res2['error'] =='ok')
                  {     
                                  //  $DT            = $data->data; 
                                    $res_data      = json_encode($res2); //json_encode($data->data);
                                    $txid          = $res2['id'];//$DT->txid; 
                      
                  $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array( 'txid' => $txid, 'res_data' =>$res_data , 'coins_total' =>$tt1 , 'coins_charge' => $tt2,    'coins_trns' => $tt3,  "trns_status"=>$trns_status,"status_up_date"=>$today_date), array("transfer_id"=>$transfer_id));
                //  $model->wallet_transaction($AR_TRF['wallet_id'],"Dr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request from Admin",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");
                        
                        
                       
                    $trns_remark = "TRX Transfer FROM [".$AR_MEM['user_id']."]" ;
                    $trans_no = rand(11111,999999);
                   
                    $model->wallet_transaction(50,"Dr",1,$tt1,$trns_remark,$today_date,$trans_no,"1","TRX");
                  //  $model->setWalletTRX($tt1,'Dr');
                    //  coins_trns
                    
                
                    
                    
                  set_message("success","Fund transfer successfull");   
                  redirect_page("financial","withdrawals",array());
                  }else{
                  set_message("warning",$res2['error']);    
                  redirect_page("financial","withdrawals",array());
                } 
                  }else{
                  set_message("warning",$data->data);   
                  redirect_page("financial","withdrawals",array());
                } 
                
                 }
                  
                            
                
               }
               else
               {
                 
                      $tt1  = round(($AR_TRF['initial_amount']/$CONFIG_ELITE_RATE));
                      $tt2  = round(($AR_TRF['withdraw_fee']/$CONFIG_ELITE_RATE));
                      $tt3  = round(($AR_TRF['trns_amount']/$CONFIG_ELITE_RATE));
                
                                    $res_data      = 'N/A';
                                    $txid          = 'N/A'; 
                      
                  $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array( 'txid' => $txid, 'res_data' =>$res_data ,'coin_rate' => $CONFIG_ELITE_RATE,  'coins_total' =>$tt1 , 'coins_charge' => $tt2,    'coins_trns' => $tt3,  "trns_status"=>$trns_status,"status_up_date"=>$today_date), array("transfer_id"=>$transfer_id));
               
                       
                    $trns_remark = "TRX Transfer FROM [".$AR_MEM['user_id']."]" ;
                    $trans_no = rand(11111,999999);
                   
                    // $model->wallet_transaction(50,"Dr",1,$tt1,$trns_remark,$today_date,$trans_no,"1","TRX");
                    // $model->setWalletTRX($tt1,'Dr');
                    //  coins_trns
                    
                
                    
                    
                  set_message("success","Fund transfer successfull");   
                  redirect_page("financial","withdrawals",array()); } 
           
                  
                  
                 
                
                }else{
                  set_message("warning","Inavlid process, please check withdrawal request");    
                  redirect_page("financial","withdrawals",array());
                }
                
               
                
                
            }else{
              set_message("warning","Unable to process your request");    
              redirect_page("financial","withdrawals",array());
            }
          break;
          case "R":
            $trns_date = InsertDate($today_date);
            $AR_TRF = $model->getFundTransfer($transfer_id);
            $AR_MEM = $model->getMember($AR_TRF['to_member_id']);
            if($AR_TRF['initial_amount']>0){
              if($AR_TRF['transfer_id']>0 && $AR_MEM['member_id']>0){
                $this->SqlModel->updateRecord(prefix."tbl_fund_transfer",array("trns_status"=>$trns_status,"status_up_date"=>$today_date),array("transfer_id"=>$transfer_id));
                $model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");             
                set_message("success","Fund transfer rejected succesfully");    
                redirect_page("financial","withdrawals",array());
              }else{
                set_message("warning","Tranaction failed , please try again");    
                redirect_page("financial","withdrawals",array()); 
              }
            }else{
              set_message("warning","Unable to process your request");    
              redirect_page("financial","withdrawals",array());
            }
          break;
        endswitch;        
      break;
    }
  }
  
  
   

  $QR_PAGES="SELECT tft.*, tm.first_name, tm.last_name, tm.user_id , tm.user_name  
      ,tm.account_number,tm.bank_name,tm.ifc_code,tm.bank_acct_holder  , tm.btc_address , tm.trx_address , tm.usdt_address , tm.eth_address  FROM tbl_fund_transfer AS tft 
       LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 
       
       WHERE  (tft.trns_for = 'WITHDRAW' OR  tft.trns_for =  'MININGWITHDRAW') AND  ( tft.wallet_id='1' or  tft.wallet_id='2')
       $StrWhr ORDER BY tft.transfer_id DESC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);





 
if($_GET['trns_status'] =='C')
{
    $c ='checked';$p='';$r='';
}
elseif($_GET['trns_status'] =='R')
{
     $r = 'checked';$c='';$p='';
}
else
{
    $p='checked';$c='';$r='';
}


$QUERY = "SELECT SUM(tft.initial_amount) as total FROM tbl_fund_transfer AS tft WHERE tft.trns_for LIKE 'WITHDRAW' AND ( tft.wallet_id='1' or tft.wallet_id='2') AND tft.trns_status='P' and tft.transfer_id >  1731 ORDER BY tft.transfer_id DESC";
$PendingWith = $this->SqlModel->runQuery($QUERY,true);
 
 
 ?>

     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>  
<script type="text/javascript">
    $(function(){
        $(".open_modal").on('click',function(){
            $('#search-modal').modal('show');
            return false;
        });
    });
</script>
<style>
   
.table td, .table th {
    padding: 5px;
}
table {
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}
</style>
 <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                  <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            <section class="tile">
 
                                <!-- tile body -->
                                <div class="tile-body table-custom">

                                    
                                     <!-- tile body -->
                              <div class="row">

          <div class="col-lg-12">
            <div class="row">
                
                          <?php get_message(); ?>
              <div class="col-lg-12">
                  <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Payout Pending Request</small>  </h4>
                        </div>
                       
                     </div>
                     <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                    <a  href="<?php echo generateSeoUrlAdmin("excel","payoutpendingmerze",""); ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export Merge Record to CSV</span></span></a> 
                      <a  href="<?php echo generateSeoUrlAdmin("excel","payoutpendingsingle",""); ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export Single Record to CSV</span></span></a> 
                    
                   
                     </div>
                </div>
              </div>
                  <div class="header-title">
                        <!--<h4 class="card-title">  <code> TRX Price : <?php echo $price;?>   || Available TRX <?php echo number_format($model->getValue("VIRTUAL_WALLET_CRYPTO")   ); ?>/-</code></h4>-->
                     </div>
                
            
                
                <div class="clearfix">&nbsp;</div>
                <div class="table-responsive-row">
                  <table  class="table table-striped table-bordered table-hover" id="no-more-tables">
                    <thead>
                      <tr>
                        <th> <input type="checkbox"  name="trns_status[]" id="select-all" ></th>
                        <th>Srl # </th>
                        <th> Date</th>
                        <th>User Id </th>
                        <th>User Name </th>
                        <!--<th>Type</th>-->
                      <!--<th>Wallet</th>-->
                         <th> Total INR</th>
                        <th style=" width: 15%;display:none;">Utility Charge</th> 
                                   <th style=" width: 15%;display:none;">Staking Charge</th> 
                                       <th>Admin Charge </th>
                          <th> Withdrawal INR</th>
                        <th  style="display:none;">Withdrawal Type</th>
                        <!--<th>Plan</th>-->
                   
                      
                     
                          
                        <!--<th>Update Date </th>-->
                        <!--<th>Crypto Name</th>-->
                        <!-- <th>Crypto Address</th>-->
                          <th>Bank Details</th>
                         
                       
                           <th>Status</th>
                             <th>Confirm</th>
                             
                            
                      </tr>
                    </thead>
                    <form method="post" name="form-valid" id="form-valid" onSubmit="return confirm('Make sure , want to changes transaction status?')" action="<?php echo generateAdminForm("financial","withdrawalsffffffffff",""); ?>">
                      <tbody>
                        <?php 
          if($PageVal['TotalRecords'] > 0){
              $Ctrl=$PageVal['RecordStart']+1;
              
              
              
            foreach($PageVal['ResultSet'] as $AR_DT):
                
                
                
                  if($AR_DT['trns_status']=="C"){
                                        $coins_total       = $AR_DT['coins_total'];
                                        $coins_charge      = $AR_DT['coins_charge'];
                                        $coins_trns        = $AR_DT['coins_trns'];
                               }
                               else
                               {
                                   
                                    if($AR_DT['cryptoname'] =='ELITE')
                                    {
                                        $coins_total       = $AR_DT['initial_amount']/$CONFIG_ELITE_RATE;
                                        $coins_charge      = $AR_DT['withdraw_fee']/$CONFIG_ELITE_RATE;
                                        $coins_trns        = $AR_DT['trns_amount']/$CONFIG_ELITE_RATE;
                                    }
                                    else
                                    {
                                        $coins_total       = $AR_DT['initial_amount']/$price;
                                        $coins_charge      = $AR_DT['withdraw_fee']/$price;
                                        $coins_trns        = $AR_DT['trns_amount']/$price;
                                    }
                                    
                               }
                             //  PrintR($AR_DT);
                               $AR_SUB = $model->getCurrentMemberShip($AR_DT['from_member_id']);
             ?>
                        <tr>
                        <td data-title="Action" class="">
                              <?php if($AR_DT['trns_status']=="P"){ ?>
                            <input type="checkbox"  name="trns_status[]" id="" value="<?php echo $AR_DT['transfer_id']; ?>">
                            <?php } ?>
                         </td>
                          <td data-title="Srl No" class=""><?php echo $Ctrl; ?></td>
                          <td  data-title="Date"><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                          <td  data-title="Username"><?php echo $AR_DT['user_name']; ?></td>
                          <td  data-title="Name"><?php echo $AR_DT['first_name']; ?></td>
                           <!--<td> <?php echo $AR_DT['draw_type'];?></td>-->
                         <!-- <td  data-title="Type"><?php echo ($AR_DT['wallet_id']=='1')? "E-wallet":"W-wallet "; ?></td>-->
                          <td  data-title="Request Amount"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['initial_amount'],2); ?> </td>
                          <td  data-title="Admin Charge"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['admin_charge']); ?></td>
                           <td  data-title="Admin Charge"><?php //echo CURRENCY; ?><?php //echo number_format($AR_DT['initial_amount']-$AR_DT['admin_charge'],2); ?>
                           
                             <?php if($AR_DT['cryptoname']=='PWT Token'){ ?>
                                          
                                            <?php echo "PWT"; ?> <?php echo number_format($AR_DT['trns_amount']/$coinprice,2); ?> 
                                         
                                          <?php }else{ ?>
                                          
                                            <?php echo CURRENCY; ?><?php echo number_format($AR_DT['trns_amount'],2); ?> 
                                          <?php } ?>   
                                          
                           
                           
                           
                           
                           
                           
                           
                           
                           
                           </td>
                          <td  data-title="Admin Charge">
                          <?php  echo '<strong>Bank Name : </strong>';  
              echo strtoupper($AR_DT['bank_name'])."<br>";
               echo '<strong>Holder Name : </strong>';  
              echo strtoupper($AR_DT['bank_acct_holder'])."<br>";
              echo '<strong>A/c No : </strong>';  
              echo strtoupper($AR_DT['account_number'])."<br>";
              
              echo '<strong>IFSC : </strong>';  
              echo strtoupper($AR_DT['ifc_code'])."<br>"; 
              
               
              
              ?>
               <input type="hidden" id="cplcrpaddress<?php echo $Ctrl; ?>"  class="form-control" style="cursor: no-drop; width: 100%" readonly value="<?php echo $AR_DT['trx_address'];?>">
                <span  onclick="copylinkaddress('<?php echo $AR_DT['trx_address'];?>')" class="btn label-lg btn-danger arrowed-in arrowed-in-right"><?php echo strtoupper($AR_DT['trx_address']); ?> </span>
              
              </td>   
                     
                          
                          
                       <td   data-title="Status">
                               <?php if($AR_DT['trns_status']=="C"){ ?>
                            <a href="javascript:void(0)" class="btn btn-success arrowed-in arrowed-in-right">Confirmed</a>
                            <?php }elseif($AR_DT['trns_status']=="R"){ ?>
                            <a  href="javascript:void(0)"  class="btn btn-warning">Rejected</a>
                            <?php }else{ ?>
                            <a  href="javascript:void(0)"   class="btn btn-warning">Pending</a>
                            
                            <?php } ?>
                          </td>
                      
                      
                       <td  data-title="Status"><?php if($AR_DT['trns_status']=="C"){ ?>
                            <a href="javascript:void(0)" onClick="alert('Already confirmed')" class="btn btn-success arrowed-in arrowed-in-right">Confirmed</a>
                            <?php }elseif($AR_DT['trns_status']=="R"){ ?>
                            <a  href="javascript:void(0)" onClick="alert('Already rejected')"   class="btn btn-warning">Rejected</a>
                            <?php }else{ ?>
                            
                             <?php if(true){ ?>
                            
                            <a href="<?php echo generateSeoUrlAdmin("financial","withdrawalsffffffffff",array("transfer_id"=>_e($AR_DT['transfer_id']),"trns_status"=>_e("C"),"action_request"=>"confirmWithdraw1")); ?>" onClick="return confirm('Make sure want to approved this  withdrawal request')" class="btn btn-success arrowed-in arrowed-in-right">Confirm</a> &nbsp;&nbsp; 
                          <?php } ?>
                          
                       
                          
                       
                            <?php } ?>
                          </td>
                      
                      
                      
                      
                       <!-- <td  data-title="Bank" align="center"><a href="javascript:void(0)" transfer_id="<?php echo _e($AR_DT['transfer_id']); ?>" class="label btn-info "data-toggle="modal" data-target="#bank-details<?php echo $AR_DT['transfer_id'];?>" >Bank Detail</a></td>
                     -->   
                     
                    <!-- <td  data-title="Request Amount"><?php echo number_format($coins_trns); ?> </td>-->
                     
                     </tr>
                        <?php $Ctrl++; endforeach; ?>
                        <?php if($_GET['trns_status']=='R' || $_GET['trns_status']=='C'){ ?>
                       
                        
                        <?php }else{ ?>
                        
                         <tr   > 
                         <td colspan="13"><button type="submit" class="btn btn-success" name="confirmWithdraw" value="1" >Confirm All</button>

                        
                        </tr>
                        
                        <?php } ?>
                        <?php  }else{ ?>
                        <tr>
                          <td colspan="12" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No withdrawals requests found</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </form>
                  </table>
                </div>
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
              </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
          </div>
          <!-- /.col -->
        </div>
                                    </div>

                                </div>
                                <!-- /tile body -->

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
                        </div>
                        <!-- /col -->



   <script>
             function copylinkaddress(id)
        {
         //alert(id);
            var link = $("#cplcrpaddress").val(id);
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = id;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            console.log("Copied the text:", tempInput.value);
            alert('Crypto Address Copied', 'success');
            document.body.removeChild(tempInput);
        }
         </script>


                    </div>
                    <!-- /row -->
            </div>
         </div>
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog " role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle">Search </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                   
                                          <form class="form-horizontal"  name="form-page" id="form-page"  autocomplete="off"  method="get"  action="<?php echo generateAdminForm("financial","withdrawalsffffffffff",""); ?>" >
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> User Name  :</label>
              <div class="col-sm-7">
              
  <input id="form-field-1" placeholder="Member ID" name="user_id" class="form-control col-xs-10 col-sm-12  " value="<?php echo $_GET['user_id']; ?>" type="text">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="crypto_address"> Address  :</label>
              <div class="col-sm-7">
              
  <input id="crypto_address" placeholder="Crypto Address" name="crypto_address" class="form-control col-xs-10 col-sm-12  " value="<?php echo $_GET['crypto_address']; ?>" type="text">
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Status  :</label>
              <div class="col-sm-7">
                <div class="clearfix">
                            <!--echo  checkRadio($_GET['trns_status'],"C");-->
                          <input type="radio" name="trns_status" id="trns_status" <?php echo $c;   ?> value="C">
                          Confirm 
                          &nbsp;&nbsp;
                          <input type="radio" name="trns_status" id="trns_status" <?php  echo $r;   ?> value="R">
                          Reject 
                          &nbsp;&nbsp;
                          <input type="radio" name="trns_status" id="trns_status" <?php  echo $p;   ?>    value="P">
                          Pending 
                          &nbsp;&nbsp; </div>
              </div>
            </div>
            
            
                        <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">  From Date  :</label>
              <div class="col-sm-7">
            
 <input class="form-control col-xs-12 col-sm-12  date-picker" name="from_date" id="from_date" value="<?php echo $ROW['from_date']; ?>" type="date"  />
              </div>
            </div>
            
            
                        <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">To Date :</label>
              <div class="col-sm-7">
              
 <input class="form-control col-xs-12 col-sm-12  date-picker" name="to_date" id="to_date" value="<?php echo $ROW['to_date']; ?>" type="date"  />
              </div>
            </div>
            
            
            
            
            
             
             
               
            
            
            
        
            
            
        
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
            <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
          </div>
        </form>
                                    
                                 </div>
                              </div>
                           </div>

         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
 <?php jquery_validation(); ?>
<script type="text/javascript">
    $(function(){
        $("#form-page").validationEngine();
    });
</script>

<script type="text/javascript">

  $('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});

  $(function(){
    $("#form-page").validationEngine();
    $('.date-picker').datepicker({
      autoclose: true,
      todayHighlight: true
    });
    $(".enableText").on('dblclick',function(){
      $(this).attr("readonly",false);
    });
    $(".enableText").on('blur',function(){
      $(this).attr("readonly",true);
    });
    
    $(".updateWithdraw").on('change',function(){
      var transfer_id = $(this).attr("ref");
      var trns_amount = $(this).val();
      var URL_LOAD = "<?php echo generateSeoUrlAdmin("json","jsonhandler",""); ?>";
      $.getJSON(URL_LOAD,{switch_type:"WITHDRAW_AMOUNT",transfer_id:transfer_id,trns_amount:trns_amount},function(JsonEval){
        if(JsonEval){
          if(JsonEval.ErrorMsg){
            switch(JsonEval.ErrorMsg){
              case "success":
                alert("Withdraw amount updated successfully");
                return true;
              break;
              case "already":
                alert("Unable to update withdraw, this transaction is already completed");
                return true;
              break;
              default:
                alert("Failed ! unable to update withdraw amount");
                return false;
              break;
            }
          }
          
        }
      });
    });
    
    $(".open_bank_detail").on('click',function(){
      var transfer_id = $(this).attr("transfer_id");
      $("#transfer_id").val(transfer_id);
      if(transfer_id!=''){
        var URL_LOAD = "<?php echo generateSeoUrl("json","jsonhandler",""); ?>";
        $.getJSON(URL_LOAD,{switch_type:"BANK_TRANS",transfer_id:transfer_id},function(JsonEval){
          if(JsonEval){
            if(JsonEval.bank_tid>0){
              $("#bank_tid").val(JsonEval.bank_tid);
              $("#bank_trans_no").val(JsonEval.bank_trans_no);
              $("#bank_name").val(JsonEval.bank_name);
              $("#bank_account_no").val(JsonEval.bank_account_no);
              $("#bank_trans_detail").val(JsonEval.bank_trans_detail);
              $("#date_time").val(JsonEval.date_time);
              return true;
            }else{
              $("#bank_tid").val('');
              $("#bank_trans_no").val('');
              $("#bank_trans_detail").val('');
              $("#bank_name").val('');
              $("#bank_account_no").val('');
              $("#date_time").val('');
              return false;
            }
          }else{
            $("#bank_tid").val('');
            $("#bank_trans_no").val('');
            $("#bank_trans_detail").val('');
            $("#bank_name").val('');
            $("#bank_account_no").val('');
            $("#date_time").val('');
            return false;
          }
        });
      }
      $('#bank-modal').modal('show');
       return false;
    });
    
  });
</script>