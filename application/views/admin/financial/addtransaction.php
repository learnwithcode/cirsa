<?php defined('BASEPATH') OR exit('No direct script access allowed');
$segment = $this->uri->uri_to_assoc(2);
$request_id = _d($segment['request_id']);

// $QR_PAGES="SELECT tft.*, tm.first_name, tm.last_name, tm.user_id , tm.user_name
// 		   FROM tbl_fund_transfer AS tft 
// 		   LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 
		  
// 		   WHERE  tft.trns_for ='Deposit' ORDER BY tft.transfer_id DESC";
$QR_PAGES="SELECT tft.*, tm.first_name, tm.last_name, tm.user_id , tm.user_name
		   FROM tbl_wallet_trns AS tft 
		   LEFT JOIN tbl_members AS tm ON tft.member_id=tm.member_id 
		  
		      WHERE tft.`trns_for`='AM'  ORDER BY tft.wallet_trns_id DESC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
?>     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

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

                                    <div class="table-responsive">
                        <div class="col-sm-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Add Transaction</small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
                <div class="tile-body table-custom">
  <?php  get_message(); ?>
                              <?php if($request_id=='' || $request_id==0){ ?>
            <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","addtransaction",""); ?>" method="post">
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Wallet Type : </label>
                <div class="col-sm-9">
                  <select name="wallet_id" class="form-control  validate[required]" id="wallet_id">
                    <option value="">select wallet</option>
                  
                    <option value="1">I-wallet</option>
                    
                  <option value="3">A-Wallet</option> 
                 
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Transaction Type : </label>
                <div class="col-sm-9">
                  <input type="radio" name="trns_type" id="trns_type"  value="Cr" checked="true">
                  Credit &nbsp;&nbsp;
                  <input type="radio" name="trns_type" id="trns_type"  value="Dr">
                  Debit </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Member ID : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Member ID" name="user_id"  class="form-control  validate[required]" type="text" value="<?php echo $ROW['user_id']; ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Amount : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Amount" name="initial_amount"  class="form-control  validate[required]" type="text" 
                value="<?php echo $ROW['initial_amount']; ?>">
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Description : </label>
                <div class="col-sm-9">
                  <textarea name="trns_remark" class="form-control  validate[required]" id="form-field-1" placeholder="Remarks"><?php echo $ROW['trns_remark']; ?></textarea>
                </div>
              </div>
              <div class="space-4"></div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                  <input type="hidden" name="wallet_trns_id" id="wallet_trns_id" value="<?php echo $ROW['wallet_trns_id']; ?>">
                  <button type="submit" name="submitTransaction" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
     
                 
                </div>
              </div>
            </form>
            <?php }else{ ?>
            <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","addtransaction",array("request_id"=>$segment['request_id'])); ?>" method="post">
              <h3 class="panel-title text-white"> <i class="fa fa-adjust"></i> Verfiy Otp </h3>
              <div class="clear">&nbsp;</div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">OTP : </label>
                <div class="col-sm-4">
                  <input type="password" name="sms_otp" id="sms_otp" placeholder="Check your registered email address" value="" class="form-control validate[required,minSize[6],custom[integer]]" maxlength="7"/>
                </div>
              </div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                  <input type="hidden" name="request_id" id="request_id" value="<?php echo $segment['request_id']; ?>" />
                  <input type="submit" name="verifyOTPAdmin" value="Verify OTP" class="btn btn-primary btn-submit" id="updateOTP"/>
                </div>
              </div>
            </form>
            <?php } ?>
 <div class="clearfix">&nbsp;</div>
                <div class="table-responsive-row">
                 <table  class="table table-striped table-bordered table-hover" id="no-more-tables">
                    <thead>
                      <tr>
                        <!--<th>Action</th>-->
                        <th>Sr No</th>
                        <th> Date</th>
                        <th>User Name </th>
                        <th>Wallet</th>
                         <th>Type</th>
                        <th>Transfer Amount</th>
                       <th>Remarks</th>
                        <!--<th>Update Date </th>-->
                        <!--<th>Bank</th>-->
                      </tr>
                    </thead>
                    <form method="post" name="form-valid" id="form-valid" onSubmit="return confirm('Make sure , want to changes transaction status?')" action="<?php echo generateAdminForm("financial","withdrawals",""); ?>">
                      <tbody>
                        <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=$PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
                        <tr>
                          <!--<td data-title="Action" class=""><?php if($AR_DT['status']=="P"){ ?>-->
                          <!--  <input type="checkbox"  name="trns_status[]" id="" value="<?php echo $AR_DT['request_id']; ?>">-->
                          <!--  <?php } ?>-->
                          <!--</td>-->
                          <td data-title="Srl No" class=""><?php echo $Ctrl; ?></td>
                          <td  data-title="Date"><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                          <td  data-title="Username"><?php echo $AR_DT['user_name']; ?></td>
                          <td  data-title="Wallet Type">
                              
                              <?php if($AR_DT['wallet_id']==1){ echo "I-Wallet"; }elseif($AR_DT['wallet_id']==3){echo "A-Wallet";}else{ echo "Infinity Vault Bonus"; } ?>
                              
                              
                              
                              
                              </td>
                           <td  data-title="Wallet Type"><?php echo ($AR_DT['trns_type']=='Cr')?'Cr':'Dr'; ?></td>
                           <td  data-title="Username"><?php echo CURRENCY; ?> <?php echo $AR_DT['trns_amount']; ?></td>
                            <td  data-title="Username"> <?php echo $AR_DT['trns_remark']; ?></td>
                          
                        </tr>
                        <?php $Ctrl++; endforeach; ?>
                        <!--<tr>-->
                        <!--  <td colspan="11"><button type="submit" class="btn btn-success" name="confirmWithdraw" value="1" >Confirm</button>-->

                        <!--    <button type="submit" class="btn btn-danger" name="rejectWithdraw" value="1" >Reject</button></td>-->
                        <!--</tr>-->
                        <?php  }else{ ?>
                        <tr>
                          <td colspan="11" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No withdrawals requests found</td>
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

         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
 <?php jquery_validation(); ?>
<script type="text/javascript">
    $(function(){
        $("#form-page").validationEngine();
    });
</script>