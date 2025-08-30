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


   $trns_status  ='C';
    $StrWhr .=" AND tft.trns_status='".$trns_status."'";


   $QR_PAGES="SELECT tft.*, tm.first_name, tm.last_name, tm.user_id , tm.user_name  
      ,tm.account_number,tm.bank_name,tm.ifc_code ,tm.bank_acct_holder , tm.btc_address , tm.trx_address , tm.usdt_address , tm.eth_address  FROM tbl_fund_transfer AS tft 
       LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 
       
       WHERE  (tft.trns_for = 'WITHDRAW' OR  tft.trns_for =  'MININGWITHDRAW') AND  ( tft.wallet_id='1' or  tft.wallet_id='2')
       $StrWhr ORDER BY tft.transfer_id DESC";
$PageVal = DisplayPages($QR_PAGES, 200, $Page, $SrchQ);

 
 
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
                           <h4 class="card-title"> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Payout Confirmed</small>  </h4>
                        </div>
                            <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                    <a  href="<?php echo generateSeoUrlAdmin("excel","payoutconfirmed",""); ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                    
                     </div>
                </div>
              </div>
                     </div>
                       <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
                    <!--<a  style="color:white;"  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold" data-toggle="modal" data-target="#exampleModalLong " ><span><i class="fa fa-search "></i> <span >Search</span></span></a>-->
                  
                    
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
                         <th>Admin Charge </th>
                          <th> Withdrawl INR</th>
                            <th style="display:none;">Withdrawal Type</th>
                        <!--<th>USD</th>-->
                        <!--<th>Plan</th>-->
                       
                      
                        <th  style="display:none;">Confirm</th>
                          
                        <!--<th>Update Date </th>-->
                        <th style="display:none;">Crypto Name</th>
                         <th style="display:none;">Crypto Address</th>
                           <th>Bank Details</th>
                         <th style="padding: 4px;">Remarks </th>
                          <th>Status</th>
                          <!-- <th>Net TRX</th>-->
                      </tr>
                    </thead>
                    <form method="post" name="form-valid" id="form-valid" onSubmit="return confirm('Make sure , want to changes transaction status?')" action="<?php echo generateAdminForm("financial","withdrawals",""); ?>">
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
                               
                               
                                if($AR_DT['trns_for']=="WITHDRAW"){
                                     $Tyype='Normal Withdrawal';
                                     
                                 }else{
                                     
                                     $Tyype='Minging Withdrawal';
                                 }
                               
                               
                               
                               
                               
                               
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
                                
                                    <td class="sorting_1"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['admin_charge'],2); ?> </td>
                           <td  data-title="Admin Charge"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['trns_amount'],2); ?></td>
                              <td  style="display:none;" data-title="Admin Charge"><?php echo $Tyype; ?>
                          <!--<td  data-title="Amount"><input type="text" class="form-control enableText updateWithdraw" name="trns_amount" id="trns_amount<?php echo $AR_DT['transfer_id']; ?>" value="<?php echo number_format($AR_DT['trns_amount'],2); ?>" readonly="true" ref="<?php echo $AR_DT['transfer_id']; ?>"></td>-->
                           <!--<td  data-title="Request Amount"><?php if($AR_SUB['roi_stacking']=='S') {echo "Plan B";}else {echo "Plan A";} ?> </td>-->
                        <!--<td  data-title="Admin Charge"><?php echo number_format($coins_charge); ?></td>-->
                          
                          <td  style="display:none;" data-title="Status"><?php if($AR_DT['trns_status']=="C"){ ?>
                            <a href="javascript:void(0)" onClick="alert('Already confirmed')" class="btn btn-success arrowed-in arrowed-in-right">Confirmed</a>
                            <?php }elseif($AR_DT['trns_status']=="R"){ ?>
                            <a  href="javascript:void(0)" onClick="alert('Already rejected')"   class="btn btn-warning">Rejected</a>
                            <?php }else{ ?>
                            <a href="<?php echo generateSeoUrlAdmin("financial","withdrawals",array("transfer_id"=>_e($AR_DT['transfer_id']),"trns_status"=>_e("C"),"action_request"=>"STS")); ?>" onClick="return confirm('Make sure want to approved this  withdrawal request')" class="btn btn-success arrowed-in arrowed-in-right">Confirm</a> &nbsp;&nbsp; <a  href="<?php echo generateSeoUrlAdmin("financial","withdrawals",array("transfer_id"=>_e($AR_DT['transfer_id']),"trns_status"=>_e("R"),"action_request"=>"STS")); ?>"  onClick="return confirm('Make sure want to reject this withdrawal request')" class="btn btn-warning">Reject</a>
                            <?php } ?>
                          </td>
                          <!--<td data-title="Update Date"><?php echo DisplayDate($AR_DT['trns_date']); ?></td>-->
                          <td style="display:none;"  data-title="Type"><?php echo $AR_DT['cryptoname'] ?></td>
                          
                           <td  data-title="Admin Charge"><?php  echo '<strong>Bank Name : </strong>';  
              echo strtoupper($AR_DT['bank_name'])."<br>";
               echo '<strong>Holder Name : </strong>';  
              echo strtoupper($AR_DT['bank_acct_holder'])."<br>";
              echo '<strong>A/c No : </strong>';  
              echo strtoupper($AR_DT['account_number'])."<br>";
              
              echo '<strong>IFSC : </strong>';  
              echo strtoupper($AR_DT['ifc_code'])."<br>"; ?>
              </td>
                           <td style="display:none;" data-title="Type" id="copyAddress<?php echo $AR_DT['transfer_id'];?>" onclick="copyAddress('copyAddress<?php echo $AR_DT['transfer_id'];?>')"><?php if($AR_DT['cryptoname']=='BTC'){ echo $AR_DT['btc_address']; }elseif($AR_DT['cryptoname']=='BUSD'){ echo $AR_DT['trx_address']; }    else{ echo $AR_DT['trxaddress']; } ?></td>
                         <?php if($AR_DT['cryptoname']=='Other'){ ?>
                       <td><?php echo $AR_DT['remarks']; ?>
					  </td>
					  
					  <?php }else{ ?>
					   <td>  <p>Null</p>					  </td>
					  
					  <?php } ?>
                       <td   data-title="Status">
                               <?php if($AR_DT['trns_status']=="C"){ ?>
                            <a href="javascript:void(0)" class="btn btn-success arrowed-in arrowed-in-right">Confirmed</a>
                            <?php }elseif($AR_DT['trns_status']=="R"){ ?>
                            <a  href="javascript:void(0)"  class="btn btn-warning">Rejected</a>
                            <?php }else{ ?>
                            <a  href="javascript:void(0)"   class="btn btn-warning">Pending</a>
                            
                            <?php } ?>
                          </td>
                      
                      
                      
                      
                      
                      
                      
                       <!-- <td  data-title="Bank" align="center"><a href="javascript:void(0)" transfer_id="<?php echo _e($AR_DT['transfer_id']); ?>" class="label btn-info "data-toggle="modal" data-target="#bank-details<?php echo $AR_DT['transfer_id'];?>" >Bank Detail</a></td>
                     -->   
                     
                    <!-- <td  data-title="Request Amount"><?php echo number_format($coins_trns); ?> </td>-->
                     
                     </tr>
                        <?php $Ctrl++; endforeach; ?>
                        <?php if($_GET['trns_status']=='R' || $_GET['trns_status']=='C'){ ?>
                       
                        
                        <?php }else{ ?>
                        
                         <tr  style="display:none;"> 
                         <td colspan="13"><button type="submit" class="btn btn-success" name="confirmWithdraw" value="1" >Confirm</button>

                          <button type="submit" class="btn btn-danger" name="rejectWithdraw" value="1" >Reject</button></td>
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
                                   
                                          <form class="form-horizontal"  name="form-page" id="form-page"  autocomplete="off"  method="get"  action="<?php echo generateAdminForm("financial","withdrawals",""); ?>" >
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