<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$a = $this->uri->segment(3);
//echo $b = $this->uri->segment(3);
$segment1 = $this->uri->uri_to_assoc(2);



	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
//echo $Res->sender_details->name;

  
//PrintR($Res);
	
?>
 
<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
 
<div class="main-content">
<div class="main-content-inner">


					<div class="page-content">
						<div class="tabbable">
											<ul class="  nav nav-tabs  " id="myTab">
												<li style="margin: 0px 5px 0px 0px;">
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
													<li  class="active" style="margin: 0px 5px 0px 0px;">
													<a  href="<?php echo BASE_PATH;?>member/moneytransfer/search_beneficiary" >
											<i class="green ace-icon fa fa-search bigger-120"></i>
													Search Beneficiary
													 
													</a>
												</li>
											 
											</ul>

											<div class="tab-content">
   <div class="panel panel-primary">
      <div class="panel-heading">Search Beneficiary</div>
      <div class="panel-body">

     
       



            <form action="<?php echo BASE_PATH;?>member/moneytransfer/search_beneficiary" method="post">
     

     <div class="form-group">
     <label for="sender_mobile">Sender Mobile:</label>
     <input class="form-control" required="" id="sender_mobile" name="sender_mobile" placeholder="Please sender mobile " data-toggle="tooltip" title="Please Enter Mobile" type="number">
     </div>
   <input type="hidden" name="submitform" id="submitform" value="1">
				<button type="submit" class="btn btn-primary">Submit</button>
          </form>

          </div>
    </div>
  <div class="panel panel-primary">
      
      <div class="panel-heading">Name: <b><?php echo $Res->sender_details->name; ?></b>|Remaining Transfer Limit Rs <b> <?php echo $Res->sender_details->limit;?></b></div>
      
      <div class="panel-body">
    <table class="table table-hover">
<tbody>
    <tr>
        <th>Beneficiary Name</th>
        <th>Beneficiary Mobile Number</th>
        <th>Beneficiary A/CNumber</th>
        <th>IFSC Code</th>
        <th>Beneficiary ID</th>
 
 <?php foreach($Res->beneficiaryList as $beneficiary){ ?>   </tr>
<tr>
<td><?php echo $beneficiary->beneficiaryName; ?></td>
<td><?php echo $beneficiary->beneficiaryMobileNumber; ?></td>
<td><?php echo $beneficiary->beneficiaryAccountNumber; ?></td>
<td><?php echo $beneficiary->ifscCode; ?></td>
<td><?php echo $beneficiary->beneficiaryId; ?></td>
</tr>
<?php } ?>
 </tbody></table>

 

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
