<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
$model = new OperationModel();
$today_date = getLocalTime();
 
 $dmtsuccess = $model->dmtsuccess(); 
 $dmtFailed = $model->dmtFailed(); 
 $dmtPending =   $model->dmtPending(); 
 $cryptoPending =   $model->getcryptoPending();
  $this->session->set_userdata("process_refund",1);
 
        $RSuccess = $model->getRechargedata('SUCCESS'); 
        $RFailed =   $model->getRechargedata('FAILED'); 
        
        $getCreditAmount = $model->getCreditAmount();
        $getCreditCryptoAmount = $model->getCreditCryptoAmount();
 //transaction/addtransaction
 ?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/header'); ?>

<style>
    .infobox-small  {background-color: #F79263 !important; }
    
    .infobox   { width: 258px;}
    
    
    .infobox .infobox-content {
    color: #555;
    max-width: 140px;
    font-weight: 600;
}
.infobox-container a .infobox-content{color: blue!important;}
</style>
</head>
<body class="skin-2">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
  <div class="main-content">
    <div class="main-content-inner"> 
         <?php get_message(); ?>
      <?php if($this->session->userdata('oprt_id') =='2' || $this->session->userdata('oprt_id') =='9'){?>
      <div class="page-content">
        <div class="page-header">
          <h1> Transaction  <small> <i class="ace-icon fa fa-angle-double-right"></i> overview   </small> </h1>
        </div>
       <style>
           .infobox {
background-image: linear-gradient(to bottom,#050c6900 0,#a3aaaf 100%)!important;
    color: #242424;
    border-color: #2b2d6f!important;
}

.infobox .infobox-content {
    color: #242424;
   
}

.mb10{    margin-bottom: 10px;}
       </style> 
        
        <div class="space-12"></div>  <div class="space-12"></div>
         <div class="row">
			   
			
			   
			  
			   
                                    		<div class="center">
                                          <div class="col-sm-12 infobox-container mb10">
									
										<div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($getCreditAmount  ); ?>/-</span>
												<a href="<?php echo generateSeoUrlAdmin("transaction","dmtCredit",array()); ?>">
												<div class="infobox-content">Total Credit</div> </a> 
											</div>

										 
										</div>
									    <div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
 

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($model->getValue("VIRTUAL_WALLET")   ); ?>/-</span>
												<div class="infobox-content">Available Wallet</div>
											</div>

										 
										</div>
									    <div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
 

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($dmtPending  ); ?>/-</span>
												
												<a href="<?php echo generateSeoUrlAdmin("transaction","dmtPending",array()); ?>">
												<div class="infobox-content">DMT Request Pending</div>
												</a>
											</div>

										 
										</div>	
										
										</div></div>
											<div class="space-12"></div>
											<div class="center">
                                          <div class="col-sm-12 infobox-container mb10">
									    <div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
 

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($dmtsuccess['total']+$RSuccess  ); ?>/-</span>
												<div class="infobox-content">Total Success</div>
											</div>

										 
										</div>
									    <div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
 

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($dmtsuccess['total']   ); ?>/-</span>
												<a href="<?php echo generateSeoUrlAdmin("transaction","dmtSuccess",array()); ?>">
												<div class="infobox-content">DMT Success</div>
												</a>
											</div>

										 
										</div>	
										<div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
 


											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($RSuccess  ); ?> </span>
												<a href="<?php echo generateSeoUrlAdmin("transaction","rechargeSuccess",array()); ?>">
												<div class="infobox-content">Recharge Success</div>
												</a>
											</div>

										 

										</div>
							            
										
										</div></div>
											<div class="space-12"></div>
												<div class="center">
                                          <div class="col-sm-12 infobox-container mb10">
											
											
											
												 <!--     <div class="infobox infobox-orange2">-->
										<!--	<div class="infobox-icon">-->
										<!--		<i class="ace-icon fa fa-inr"></i>-->
										<!--	</div>-->
 

										<!--	<div class="infobox-data">-->
										<!--		<span class="infobox-data-number"><?php echo number_format($RFailed+$dmtFailed  ); ?> </span>-->
										<!--		<a href="<?php echo generateSeoUrlAdmin("transaction","rechargeFailed",array()); ?>">-->
										<!--		<div class="infobox-content">Recharge Reject/Failed</div>-->
										<!--		</a>-->
										<!--	</div>-->

										 

										<!--</div>-->
									    <div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
 

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($dmtFailed,2  ); ?>/-</span>
												<a href="<?php echo generateSeoUrlAdmin("transaction","dmtFailed",array()); ?>">
												<div class="infobox-content">DMT Reject/Failed</div>
												</a>
											</div>

										 
										</div>
										<!--   <div class="infobox infobox-orange2">-->
										<!--	<div class="infobox-icon">-->
										<!--		<i class="ace-icon fa fa-inr"></i>-->
										<!--	</div>-->
 

										<!--	<div class="infobox-data">-->
										<!--		<span class="infobox-data-number"><?php echo number_format($RFailed  ); ?> </span>-->
										<!--		<a href="<?php echo generateSeoUrlAdmin("transaction","rechargeFailed",array()); ?>">-->
										<!--		<div class="infobox-content">Recharge Reject/Failed</div>-->
										<!--		</a>-->
										<!--	</div>-->

										 

										<!--</div>-->
									    <div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
 

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($dmtsuccess['amount'],2  ); ?> </span>
												<a href="<?php echo generateSeoUrlAdmin("transaction","dmtSuccess",array()); ?>">
												<div class="infobox-content">DMT Amount Success </div>
												</a>
											</div>

										 

										</div>
										<div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
 

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($dmtsuccess['charge'],2  ); ?> </span>
												<a href="<?php echo generateSeoUrlAdmin("transaction","dmtSuccess",array()); ?>">
												<div class="infobox-content">DMT Charge </div>
												</a>
											</div>

										 

										</div>
										
										</div></div>
											<div class="space-12"></div>
											
												<div class="center">
                                          <div class="col-sm-12 infobox-container mb10">
									
										<div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($getCreditCryptoAmount  ); ?>/-</span>
												<a href="<?php echo generateSeoUrlAdmin("transaction","cryptoCredit",array()); ?>">
												<div class="infobox-content">Crypto Credit (TRX)</div> </a> 
											</div>

										 
										</div>
									    <div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
                                           

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($model->getValue("VIRTUAL_WALLET_CRYPTO")   ); ?>/-</span>
												<div class="infobox-content">Crypto Wallet (TRX)</div>
											</div>

										 
										</div>
									    <div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-inr"></i>
											</div>
 

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo number_format($cryptoPending/  getCoinMarketCap()	  ); ?>/-</span>
												
											 
												<div class="infobox-content">    Pending (TRX)</div>
											 
											</div>

										 
										</div>	
										
										</div></div>
											<div class="space-12"></div>
											
											
											
											
											<div class="center">
											    <div class="col-sm-12 infobox-container mb10">
								
									 
									  

		<div class="space-12"></div>
								<a   href="<?php  echo generateSeoUrlAdmin("transaction","addtransaction",''); ?>">
								 	<div class="infobox infobox-grey infobox-small infobox-dark" style="background-color: #C4CACE;width: 250px;">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-refresh"></i>
											</div>

											<div class="infobox-data" style="max-width: 160px;">
												<div class="infobox-content"  style="color:black;">Add/Deduct Wallet</div>
												<div class="infobox-content"  style="color:black;"></div>
											</div>
										</div></a>		
										
											<a   href="<?php  echo generateSeoUrlAdmin("transaction","withdrawals",''); ?>">
								 	<div class="infobox infobox-grey infobox-small infobox-dark" style="background-color: #C4CACE;width: 250px;">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-refresh"></i>
											</div>

											<div class="infobox-data" style="max-width: 160px;">
												<div class="infobox-content"  style="color:black;">Withdrawal Request</div>
												<div class="infobox-content"  style="color:black;"></div>
											</div>
										</div></a>			
										 
						 
						 	<a    href="<?php  echo generateSeoUrlAdmin("transaction","refunddmt",''); ?>"   onclick="disaledBtn();"  id="disabledBtn" >
								 	<div class="infobox infobox-grey infobox-small infobox-dark" style="background-color: #C4CACE;width: 250px;">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-refresh"></i>
											</div>

											<div class="infobox-data" style="max-width: 160px;">
												<div class="infobox-content"  style="color:black;">Refresh DMT</div>
												<div class="infobox-content"  style="color:black;"></div>
											</div>
										</div></a>
										
											<a    class="open_modal"  style="cursor:pointer;">
								 	<div class="infobox infobox-grey infobox-small infobox-dark" style="background-color: #C4CACE;width: 250px;">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-refresh"></i>
											</div>

											<div class="infobox-data" style="max-width: 160px;">
												<div class="infobox-content"  style="color:black;">Refund By Trns</div>
												<div class="infobox-content"  style="color:black;"></div>
											</div>
										</div></a>
										
									<a    href="<?php  echo generateSeoUrlAdmin("transaction","make_withdrawal",''); ?>"     >
								 	<div class="infobox infobox-grey infobox-small infobox-dark" style="background-color: #C4CACE;width: 250px;">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-dollar"></i>
											</div>

											<div class="infobox-data" style="max-width: 160px;">
												<div class="infobox-content"  style="color:black;">Withdrawal</div>
												<div class="infobox-content"  style="color:black;"></div>
											</div>
										</div></a>	
										
										<a   href="#.">
								 	<div class="infobox infobox-grey infobox-small infobox-dark" style="background-color: #C4CACE;width: 250px;">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-refresh"></i>
											</div>

											<div class="infobox-data" style="max-width: 160px;">
												<div class="infobox-content"  style="color:black;">Refund Recharge</div>
												<div class="infobox-content"  style="color:black;"></div>
											</div>
										</div></a>
						 
						 
	                            <a   href="#.<?php //echo generateSeoUrlAdmin("recognition","recognitionlist",''); ?>">
								 	<div class="infobox infobox-grey infobox-small infobox-dark" style="background-color: #C4CACE;width: 250px;">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-download"></i>
											</div>

											<div class="infobox-data" style="max-width: 160px;">
												<div class="infobox-content"  style="color:black;">Credit Amount Report</div>
												<div class="infobox-content"  style="color:black;"></div>
											</div>
										</div></a>
								 
   <a   href="#.<?php //echo generateSeoUrlAdmin("recognition","recognitionlist",''); ?>">
								 	<div class="infobox infobox-grey infobox-small infobox-dark" style="background-color: #C4CACE;width: 250px;">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-download"></i>
											</div>

											<div class="infobox-data" style="max-width: 160px;">
												<div class="infobox-content"  style="color:black;">DMT Report</div>
												<div class="infobox-content"  style="color:black;"></div>
											</div>
										</div></a>
										
										 <a   href="#.<?php //echo generateSeoUrlAdmin("recognition","recognitionlist",''); ?>">
								 	<div class="infobox infobox-grey infobox-small infobox-dark" style="background-color: #C4CACE;width: 250px;">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-download"></i>
											</div>

											<div class="infobox-data" style="max-width: 160px;">
												<div class="infobox-content"  style="color:black;">Recharge Report</div>
												<div class="infobox-content"  style="color:black;"></div>
											</div>
										</div></a>
													
													
													
													
													
													</div>
			   </div>
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
      </div>
        
        
         <div id="search-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="smaller lighter blue no-margin">Refund By Trasaction Id/ Order Id</h3>
        </div>
        <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("transaction","refundbyTrns","");  ?>" autocomplete="off" method="post">
          <div class="modal-body">
           
           
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Filter By  :</label>
              <div class="col-sm-7">
              <select name="filter_by" id="filter_by" class="form-control" onchange="getvalue();" >
                  <option value="order_id" >Order Id</option>
                  <option value="transaction_id" >Transaction Id</option>
              </select>
              </div>
            </div>
           
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Order  Id  :</label>
              <div class="col-sm-7">
                <input id="order_id" placeholder="Order/Transaction Id" name="order_id"  class="col-xs-10 col-sm-12 " type="text" onchange="getvalue();"  >
              </div>
            </div>
            
            
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> User  Id  :</label>
              <div class="col-sm-7">
                <input  placeholder="User Id" id="get_user_id" readonly  class="col-xs-10 col-sm-12 " type="text" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Name  :</label>
              <div class="col-sm-7">
                <input   placeholder="Name" id="get_name" readonly  class="col-xs-10 col-sm-12 " type="text" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Amount  :</label>
              <div class="col-sm-7">
                <input   placeholder="Amount"  id="get_amount" readonly   class="col-xs-10 col-sm-12 " type="text" >
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Status  :</label>
              <div class="col-sm-7">
                <input   placeholder="Status" id="get_status" readonly  class="col-xs-10 col-sm-12 " type="text" >
              </div>
            </div>
            
            
             
             
               
     
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="ace-icon fa fa-check"></i> Submit </button>
            <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
    <script type="text/javascript">
	$(function(){
		$(".open_modal").on('click',function(){
			$('#search-modal').modal('show');
			return false;
		});
	});
</script>
         
      
        <?php  } 
        if($this->session->userdata('oprt_id') =='6'){
        
        ?>
        <img src="<?php echo BASE_PATH;?>assets/images/account.gif" style="    width: 80%;
    margin-left: 10%;
    margin-top: 3%;
    height: 400px;">
        <?php } ?>
    </div>
  </div>
    </div>
  
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  
  
  
  <script>
    function   disaledBtn(){
  
   $("#disabledBtn").css("display", "none"); 
}

function getvalue()
{
    
    var order_id = document.getElementById("order_id").value;
    var filter = document.getElementById("filter_by").value;
    if(order_id !='')
    {
        		
                jQuery.ajax({
                type: "POST",
                url: "<?php echo BASE_PATH; ?>" + "superadmin/transaction/gettrnsDetails",
                data: {order_id: order_id,filter:filter},
                success: function(res) {
                 
                var data =   JSON.parse(res);
                document.getElementById("get_user_id").value      = data.user_id;
                document.getElementById("get_name").value         = data.name;
                document.getElementById("get_amount").value       = data.amount;
                document.getElementById("get_status").value       = data.status;
                
                            
                            
                      


      
                            
                
                } });
    }
     
}
  </script>
     </div>
 

  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> 
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
</body>
</html>
