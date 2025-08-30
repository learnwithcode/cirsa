<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$wallet_id = 3;
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(twt.trns_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	$member = $model->getmemberContact($member_id);
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
	$QR_PAGES="SELECT * FROM `tbl_coinpayment` WHERE `member_id` = '$member_id' ORDER BY `id` DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
	 
	
?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	<style>
	    .centerimg {
  display: block;
  margin-left: auto;
  margin-right: auto; 
  width: 60%;
}
	</style>
<div class="content-page rtl-page">
      <div class="container-fluid">
          
           <?php if($PageVal['TotalRecords'] > 0){
                $Ctrl=1;
                $i=1;
                foreach($PageVal['ResultSet'] as $AR_DT) { 
                 if($AR_DT['status'] == 'N'){ 
              
                ?>
 
                     
                    
	         
          <div class="modal fade" id="exampleModal<?php echo $AR_DT['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel"> Scan & Pay Now</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              
                                 <div class="modal-body">
                                    <div class="mb-3">
                                    <?php  if($AR_DT['coin'] =='MKC') { ?>    
                                    <img class="centerimg" src="https://chart.googleapis.com/chart?chs=280x280&amp;cht=qr&amp;chl=<?php echo $AR_DT['address'];?>&amp;choe=UTF-8" title="EGC Coin Address">
                                    <?php } else { ?>
                                    <img src="<?php echo $AR_DT['qrcode_url'];?>" width="221" style="     display: block;    margin-left: auto;    margin-right: auto;    width: 50%;"> 
                                    <?php } ?>
                                    <b style="     display: block;  text-align: center;"><?php echo $AR_DT['address'];?></b>
                                    </div> 
                                    
                                    <div class="mb-3">
                                       
                                      <input class="form-control"  value="<?php echo $AR_DT['amount'];?>  <?php echo $AR_DT['coin'];?>" readonly type="text">
                                    
                                    </div> 
                                    </div> 
                                 <div class="modal-footer"> 
                                      <b>Time to  Expire Link</b>
				                        <button type="submit" class="btn btn-primary" id="demo<?php echo $AR_DT['id'];?>">10:90</button>
				                         <script>
        var d = new Date();
        var month = d.getMonth() + 1;
        var day = d.getDate() + 1;
        var output = d.getFullYear() + '/' +
            (month < 10 ? '0' : '') + month + '/' +
            (day < 10 ? '0' : '') + day + ' 24:00:00';  
            
           //
           <?php 
           
                 $NewaddDate =    date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s", strtotime($AR_DT['date_time'])) . " +30 minutes"));  
                 $addDates = date("Y/m/d H:i:s",strtotime($NewaddDate));
        
        ?>  
        
        var countDownDate =  new Date('<?php echo $addDates;?>').getTime();
        var x = setInterval(function () {
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            document.getElementById("demo<?php echo $AR_DT['id'];?>").innerHTML = "  <span class='btn-sm btn-primary mr-1'>"
            + minutes + " M</span><span class='btn-sm btn-primary'>" + seconds + " S</span>";
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo<?php echo $AR_DT['id'];?>").innerHTML = "Expired";
            }
        }, 1000);
        
  
    </script>
  </div>
  
        	           <div>
          
                           </div>
                        </div>
                     </div></div>
               <?php }}}  ?>       
                     
          <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Make Request for add Fund</h4>
                     </div>
                  </div>
                  <div class="card-body">
                    <form    method="post">
        <div class="modal-body">

                  <div class="col-lg-12">
                	<?php echo get_message(); ?>
                	</div>      
	                       	
	                  <!-- <code>eG Coin Comming Soon on exchanger you  can Buy & Sell</code>   
                      -->      
                            
                            <div class="mb-3">
                            <label class="mb-1"><strong>Select Coin</strong></label>
                              <select name="coins"  class="form-control" >
                                  <option value="TRX" >TRX COIN</option>
                                  <option value="USDT.TRC20" >USDT TRC-20</option>
                                  <option value="BTC" >BITCOIN</option>
                                  <option value="ETH" >Ethereum</option>
                               
                                <!-- <option value="EGC" >EGC COIN</option>-->
                              </select>
                            </div>  
                            
                            
						    <div class="mb-3">
                            <label class="mb-1"><strong>Amount In USD</strong></label>
                                <input  placeholder="Amount In USD" id="amount" name="amount" autocomplete="off"  class="form-control" type="number" value="" required>
                            </div>  
	 	 	 
						   <!-- <div class="mb-3">
                            <label class="mb-1"><strong>Email Id</strong></label>
                                <input  placeholder="Email Id" id="email_id" name="email_id"     class="form-control" type="email" value="<?php echo $member['member_email'];?>">
                            </div> 
						   
                            <div class="mb-3">
                            <label class="mb-1"><strong>Login Password</strong></label>
                            <input class="form-control" name="trns_password" id="" type="password" placeholder="Login Password" required>
                            </div> 
     -->
      
     
 </div>
    <div class="modal-footer"> 
 
		
	        	<input type="hidden" name="makeRequest" value="1" />
		
	                             
	                            <button type="submit" name="buttonRequest" class="btn btn-primary">
	                              	<i class="ace-icon fa fa-cloud-upload icon-on-right"></i>Submit
	                            </button>
	                       
	                     
  </div>

          </form>
 
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Request History</h4>
                     </div>
                  </div>
                  <div class="card-body">
                      A-Wallet : $ <?php echo number_format($LDGR['net_balance'],2); ?>
                     <div class="table-responsive">
                        <table id="datatable" class="table  table-striped table-bordered" >
 
		  
   <thead>
                       <tr>
                            <th>S.No.</th>
                            <th>Txn Id</th>
                            <th>Type</th>
                             <th>  Price</th>
                            
                           
                            <th>USD</th>
                            <th>Total Coin</th>
                            <!--<th>Status</th>-->
                            <th>Details</th>        
                            <th>Date</th>
                            <th>Action</th>
                        </tr>

                            
</thead>
   <tbody>  <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									    
									    
									    
								if($AR_DT['status'] =='N')
								{
								    
							
								?>
								
								 <script>
                                                        $(document).ready(function() {
                                                        $('#exampleModal<?php echo $AR_DT['id'];?>').modal('show');
                                                        });
	                            </script>
	                            <?php } ?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $i;$i++;?></td>
                                        <td><?php echo $AR_DT['txn_id']; ?></td>
                                      <td class="sorting_1">  <?php echo    $AR_DT['coin'] ; ?></td>
                                       <td class="sorting_1">$&nbsp;<?php echo number_format($AR_DT['usd_price'],4); ?></td>
                                     
                                     
                                      <td class="sorting_1">$&nbsp;<?php echo number_format($AR_DT['added_usd'],2); ?></td>
                                       <td class="sorting_1">  <?php echo number_format($AR_DT['amount'],2); ?></td>
                                      <!--<td><?php  if($AR_DT['status']=='N'){ echo 'Pending';}elseif($AR_DT['status']=='Y'){echo 'Done';}else{echo 'Reject/Cancel';} ?></td>-->
                                      <td><?php echo $AR_DT['status_text']; ?></td>
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                                      <td>
                                         
                                     
                                     <?php  if($AR_DT['status']=='N'){?>
                                     <button   class="btn btn-primary btn-sm mr-2" data-toggle="modal" data-target="#exampleModal<?php echo $AR_DT['id'];?>"  >Pay&nbsp;Now</button>
                                      <a href="<?php echo BASE_PATH;?>member/account/scan_and_pay/<?php echo _e($AR_DT['id']);?>" class="btn btn-danger btn-sm mr-2"  >Cancel</a>
                                     <?php } elseif($AR_DT['status']=='Y') {?>
                                      <button   class="btn btn-success btn-sm mr-2"    >Success</button>
                                     <?php }else {  ?>
                                     <button   class="btn btn-danger btn-sm mr-2"    >Rejected</button>
                                     
                                      <?php }  if(false) { ?>    
                                      <a href="<?php echo $AR_DT['checkout_url'];?>" class="btn btn-primary btn-sm mr-2" target='_blank'>Checkout</a>
                                      <a href="<?php echo $AR_DT['status_url'];?>" class="btn btn-success btn-sm mr-2" target='_blank'>Status</a>  <?php } ?>
                                      </td>
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="6" align="center">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
            </tbody>
    
                          
                        </table>
                            
     <div class="row">
<div class="col-md-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
</div></div>

<div class="col-md-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul> </nav>
								  
								   </div></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>

               
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>