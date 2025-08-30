<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
$member_id = $this->session->userdata('mem_id');

      $QR_MONEY = "SELECT * FROM tbl_money_transfer order by sender_id desc limit 5 ";
      $AR_MON = $this->SqlModel->runQuery($QR_MONEY);
      
      
    
      
      
   $LDGR = $model->getCurrentBalance($member_id,1);


	
?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
 
<div class="main-content">
<div class="main-content-inner">


					<div class="page-content">
						<div class="tabbable">
											<ul class="  nav nav-tabs  " id="myTab">
												<li class="active" style="margin: 0px 5px 0px 0px;">
													<a href="<?php echo BASE_PATH;?>member/moneytransfer" >
														<i class="green ace-icon fa fa-send bigger-120"></i>
														Money Transfer
													</a>
												</li>

												<li   style="margin: 0px 5px 0px 0px;">
													<a  href="<?php echo BASE_PATH;?>member/moneytransfer/sender_registration" >
														<i class="green ace-icon fa fa-sign-in bigger-120"></i>
														 Sender Registration
													 
													</a>
												</li>
                                                	<li  style="margin: 0px 5px 0px 0px;">
													<a  href="<?php echo BASE_PATH;?>member/moneytransfer/add_beneficiary" >
												<i class="green ace-icon fa fa-plus bigger-120"></i>
													Add Beneficiary
													 
													</a>
												</li>
													<li  style="margin: 0px 5px 0px 0px;">
													<a  href="<?php echo BASE_PATH;?>member/moneytransfer/verify_beneficiary" >
												
															<i class="green  ace-icon glyphicon glyphicon-check  bigger-120"></i>
													Verify Beneficiary
											 
													</a>
												</li>
													<li  style="margin: 0px 5px 0px 0px;">
													<a  href="<?php echo BASE_PATH;?>member/moneytransfer/search_beneficiary" >
											<i class="green ace-icon fa fa-search bigger-120"></i>
													Search Beneficiary
													 
													</a>
												</li>
											 
											</ul>

											<div class="tab-content">
										        <div class="panel panel-primary">
      <div class="panel-heading">Money Transfer    ||  Available Balance : Rs. <?php echo    $LDGR['net_balance'];  ?> /-</div>
      <div class="panel-body">

      
<?php  get_message(); ?>
            <form action="<?php echo BASE_PATH;?>member/moneytransfer/index" method="post">
     
           
    <input type="hidden" name="hidOperatorCode" id="hidOperatorCode"/>            
    <input type="hidden" name="hidProduct_name" id="hidProduct_name"/>            
    <input type="hidden" name="hidCircle" id="hidCircle"/> 
     <div class="form-group">
     <label for="sender_mobile">Sender Mobile:</label>
     <input class="form-control" required="" id="mobile" name="mobile" placeholder="Please sender mobile " data-toggle="tooltip" title="Please Enter Mobile" type="number"/>
     </div>
    
 
      <div class="form-group">
     <label for="ben_id">Beneficiary ID:</label>
     <input class="form-control" required="" id="ben_id" name="ben_id" placeholder="Please enter Beneficiary ID" data-toggle="tooltip" title="Please enter Beneficiary ID" type="text">
     </div>
     
          <div class="form-group">
     <label for="ddlOperator">Transfer Mode :</label>
       <select class="form-control" required="" id="mode" name="mode" tabindex="1" title="Select Operator.<br />Click on drop down"><option value="0">Select Provider*</option>
 <option path="" value="IMPS">IMPS</option>    </select>
     </div>
     
     <div class="form-group">
     <label for="amount">Amount:</label>
     <input class="form-control" required="" id="amount" name="amount" placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer Amount" type="number">
     </div>
<input type="hidden" name="submitform" id="submitform" value="1">
				<button type="submit" class="btn btn-primary">Submit</button>
				
          </form>

          </div>
    </div>
                                               	<div class="row">
						    
						    
						    <div  class="col-xs-12">
						        
						        
						        <div class="panel panel-primary">
      <div class="panel-heading">Last 5 Transaction</div>
      <div class="panel-body">
  <div class="table-responsive">
      <table class="table">
  <thead>
          <tr>
    </tr><tr>
    <th>TXID</th>
    <th>Mode</th>
    <th>Beneficiary ID</th>
    <th>Amount</th>
     <th>Status</th>
  <th>Bank Ref No</th> 
  <th>By</th>
    <th>Date Time</th>  

    </tr> </thead>
          <tbody><?php foreach($AR_MON as $res){
         // print_r($res);
           ?>
        <tr>
            <td><?php echo $res['txid']; ?></td>
            <td><?php echo $res['mode']; ?></td>
         <td><?php echo $res['ben_id']; ?></td>
         <td><?php echo $res['amount']; ?></td>
         <td><span style="color:green;"><?php echo $res['status']; ?></span></td>
         <td></td>
         <td>API</td>
         <td><?php  echo date('m/d/Y h:i:s a', strtotime($res['date']));
         //echo  $res['date']; ?></td>
         </tr>
         <?php } ?>
         </tbody>
         </table>
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
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
<script src="<?php echo BASE_PATH;?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.flash.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.html5.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.print.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.colVis.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/dataTables.select.min.js"></script>
 
</body>
</html>
