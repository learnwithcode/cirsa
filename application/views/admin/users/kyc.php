<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$form_data = $this->input->post();
$segment = $this->uri->uri_to_assoc(2);
$member_id = ($form_data['member_id'])? $form_data['member_id']:_d($segment['member_id']);


$AR_MEM = $model->getMember($member_id);

$QR_MEM = "SELECT kyc.*, tm.user_id, tm.first_name, tm.pan_no,tm.adhar,tm.last_name, tm.bank_acct_holder,tm.account_number,tm.bank_name,tm.ifc_code FROM ".prefix."tbl_mem_kyc AS kyc 
		   LEFT JOIN tbl_members AS tm ON kyc.member_id=tm.member_id
		   WHERE tm.member_id='$member_id' $StrWhr ORDER BY kyc.kyc_id ASC";
$PageVal = DisplayPages($QR_MEM, 200, $Page, $StrQuery);
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
                           <h1> Member <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; KYC Verification </small> </h1>
                        </div>
                        <div class="clearfix">

              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
                  <?php  get_message(); ?>
        <div class="col-xs-12">
          <!-- PAGE CONTENT BEGINS -->
          <table width="100%" border="0" cellpadding="5" cellspacing="1" class="table table-striped table-bordered table-hover">
			<tr class="">
              <td colspan="7" align="left" valign="bottom" class=""><?php echo $AR_MEM['first_name']." ".$AR_MEM['last_name']; ?> &nbsp; &nbsp;[&nbsp;<?php echo $AR_MEM['user_id']; ?>&nbsp;]</td>
          
          </tr>
            
            <tr class="">
             
              <td align="left">Srl N</td>
            <!--  <td align="center">Kyc Document </td>-->
              <td align="left">Document Type </td>
			  <td align="left">Document No </td>
              <td align="left">Date</td>
              <td align="left">Approved Status </td>
              <td  align="left">Approved Date </td>
              <td  align="left">Action</td>
            </tr>
            <?php 
			if($PageVal['TotalRecords'] > 0){
			$Ctrl = $PageVal['RecordStart']+1;
			foreach($PageVal['ResultSet'] as $AR_DT){ 
			$file_src = $model->kycDocument($AR_DT['kyc_id']);
		
			if(	$AR_DT['bank_name'] == '' or 	$AR_DT['bank_acct_holder'] == ''or 	$AR_DT['bank_acct_holder'] == ''or 	$AR_DT['account_number'] == ''or 	$AR_DT['ifc_code'] == ''or 	$AR_DT['adhar'] == ''or 	$AR_DT['pan_no'] == ''){
			    
			    
		
			
			?>
           
           
           <?php }else{ ?>
           
         <!--  <marquee behavior="scroll" direction="left" scrollamount="12"  style="font-size: 19px;">
										
										
										
	 <b style="color:#c764e8; font-size:1.35rem;">Tst</b> 		 
										
																	    
                      
           
           
                                   
                                      
												</marquee>-->
           <?php } ?>
            <tr class=""  style="cursor:pointer">
                 
               
              <td  align="center" valign="top" class="cmntext"><?php echo $Ctrl;?></td>
              
            <!--  <td align="center" valign="middle" class="cmntext"><a  target="_blank" href="<?php echo $file_src; ?>"><?php echo $AR_DT['file_name'];?></a></td>-->
			   <td align="left" valign="middle" class="cmntext"><?php if($AR_DT['file_type']=='CHEQUE'){ echo "CHEQUE/PASSBOOK";}else{ echo $AR_DT['file_type'];}?></td>
           <?php if($AR_DT['file_type'] != 'ADHAR CARD BACK') {?>   <td align="left" valign="middle" class="cmntext"  <?php if($AR_DT['file_type'] =='ADHAR CARD FRONT') {?> rowspan='2'<?php } ?>><?php if($AR_DT['file_type'] =='PAN CARD'){
                   echo '<strong>PAN No : </strong>';   
                  echo strtoupper($AR_DT['pan_no']);
                  
              }elseif($AR_DT['file_type']=='CHEQUE'){
              echo '<strong>Bank Name : </strong>';  
              echo strtoupper($AR_DT['bank_name'])."<br>";
               echo '<strong>Holder Name : </strong>';  
              echo strtoupper($AR_DT['bank_acct_holder'])."<br>";
              echo '<strong>A/c No : </strong>';  
              echo strtoupper($AR_DT['account_number'])."<br>";
              
              echo '<strong>IFSC : </strong>';  
              echo strtoupper($AR_DT['ifc_code'])."<br>";
              }elseif($AR_DT['file_type'] =='ADHAR CARD FRONT') { 
               echo '<strong>Aadhar No : </strong>';  
              echo $AR_DT['adhar'];}?></td> <?php } ?>
              <td align="left" valign="middle" class=""><?php echo $AR_DT['date_time'];?></td>
              <td align="left" valign="middle" class="cmntext">
			  <?php if($AR_DT['approved_sts']==0){ ?>
			  		<a onClick="return confirm('Make sure, want to change status of kyc')" href="<?php echo generateSeoUrlAdmin("users","kyc",array("kyc_id"=>_e($AR_DT['kyc_id']),"member_id"=>_e($AR_DT['member_id']),"action_request"=>"KYC","approved_sts"=>1)); ?>" class="btn btn-success">Approved</a>
					
					<a onClick="return confirm('Make sure, want to change status of kyc')" href="<?php echo generateSeoUrlAdmin("users","kyc",array("kyc_id"=>_e($AR_DT['kyc_id']),"member_id"=>_e($AR_DT['member_id']),"action_request"=>"DELETE","approved_sts"=>-1)); ?>" class="btn btn-danger">Delete</a>
			  <?php }elseif($AR_DT['approved_sts']>0){ ?>
			  		<a href="javascript:void(0)" class="label label-success">Approved</a>
			  <?php }else{ ?>			
			  		<a href="javascript:void(0)" class="label label-danger">Rejected</a>
			  <?php } ?>
			  </td>
              <td align="left" valign="middle" class="cmntext"><?php echo $AR_DT['approved_date'];?></td>
              <td align="left" valign="middle" class="cmntext"><a onClick="return confirm('Make sure, want to delete this kyc?')" href="<?php echo generateSeoUrlAdmin("users","kyc",array("kyc_id"=>_e($AR_DT['kyc_id']),"member_id"=>_e($AR_DT['member_id']),"action_request"=>"DELETE")); ?>"><i class="fa fa-trash"></i></a>
			  &nbsp;
			  <a  onclick="window.open('<?php echo $file_src; ?>','targetWindow', 'toolbar=no, location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1090px, height=550px, top=25px left=120px'); return false;" href="<?php echo $file_src; ?>"><i class="fa fa-eye"></i></a>
			  </td>
            </tr>
            <?php  $Ctrl++; }?>
            
             <tr>
                          <td align="left" valign="middle" class="cmntext">
			  <?php if($AR_DT['approved_sts']==0){ ?>
			  		<a onClick="return confirm('Make sure, want to change status of kyc')" href="<?php echo generateSeoUrlAdmin("users","kyc",array("kyc_id"=>_e($AR_DT['kyc_id']),"member_id"=>_e($AR_DT['member_id']),"action_request"=>"KYCALL","approved_sts"=>1)); ?>" class="btn btn-success">Approved All</a>
					
					<a onClick="return confirm('Make sure, want to change status of kyc')" href="<?php echo generateSeoUrlAdmin("users","kyc",array("kyc_id"=>_e($AR_DT['kyc_id']),"member_id"=>_e($AR_DT['member_id']),"action_request"=>"KYCALL","approved_sts"=>-1)); ?>" class="btn btn-danger">Delete All</a>
			  <?php }elseif($AR_DT['approved_sts']>0){ ?>
			  		<a href="javascript:void(0)" class="label label-success">Approved All</a>
			  <?php }else{ ?>			
			  		<a href="javascript:void(0)" class="label label-danger">Delete All</a>
			  <?php } ?>
			  </td>
                        </tr>
            <?php }else{?>
            <tr>
              <td colspan="7" align="center" class="errMsg">No kyc  found for this member  <a href="<?php echo generateSeoUrlAdmin("users","kyc_list",""); ?>">&lt; &lt; Back</a></td>
            </tr>
            <?php } ?>
          </table>
		   <ul class="pagination">
                  <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
          </ul>
          <!-- PAGE CONTENT ENDS -->
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
<!-- Modal -->
                           <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog " role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle">Search </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                   
                                         <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("users","profilelist","");  ?>" autocomplete="off" method="get">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-12 control-label  no-padding-right" for="form-field-1-1"> Name / Email Address  :</label>
              <div class="col-sm-12">
                <input id="form-field-17" placeholder="Name / Email" name="fullname"  class="form-control col-xs-12 col-sm-12  " type="text" value="<?php echo $_GET['fullname']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> User Id  :</label>
              <div class="col-sm-12">
                <input id="form-field-16" placeholder="User Id" name="user_id"  class=" form-control col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['user_id']; ?>">
              </div>
            </div>
            
            
                        <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> Mobile No  :</label>
              <div class="col-sm-12">
                <input id="form-field-15" placeholder="Mobile No" name="member_mobile"  class="form-control col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['member_mobile']; ?>">
              </div>
            </div>
            
            <!-- 
                        <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> Pan Card  :</label>
              <div class="col-sm-12">
                <input id="form-field-14" placeholder="Pan Card" name="pan_no"  class="form-control col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['pan_no']; ?>">
              </div>
            </div>
             -->
            
            
            
            
            
                       <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> From Date  :</label>
              <div class="col-sm-12">
 <input class="form-control col-xs-12 col-sm-12 col-md-12  " name="from_date" id="from_date" value="<?php echo $_GET['from_date']; ?>" type="date"  />
              </div>
            </div>
             
            
                     
            
            
            
            
                       <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> To Date  :</label>
              <div class="col-sm-12">
    <input class="form-control col-xs-12 col-sm-12 col-md-12 date-picker" name="to_date" id="to_date" value="<?php echo $_GET['to_date']; ?>" type="date"  />
              </div>
            </div>
             
               
            
            
            
            <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> Member Status   :</label>
              <div class="col-sm-12">
                <input type="radio" name="block_sts" id="block_sts" <?php if($_GET['block_sts']=="Y"){ echo 'checked="checked"'; } ?>  value="Y">
                Block &nbsp;&nbsp;
                <input type="radio" name="block_sts" id="block_sts" value="N" <?php if($_GET['block_sts']=="N"){ echo 'checked="checked"'; } ?> >
                Un-Block </div>
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
        $("#form-valid").validationEngine();
    });
</script>