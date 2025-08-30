<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

// $QR_SPR = "SELECT tm.id ,tm.status FROM ".prefix."tbl_withdrawl_on_off AS tm WHERE tm.Req_name = 'Withdrwal'";
// $AR_SPR = $this->SqlModel->runQuery($QR_SPR,true);
// foreach($AR_SPR as $rr ){
// $r11 = $rr['id'];
// $r11status = $rr['status'];
// }

$QR_CHECK = "SELECT Withdrawal_status from tbl_members WHERE member_id='1'";
        $fR = $this->SqlModel->runQuery($QR_CHECK,true); 
    
        //$this->load->view(MEMBER_FOLDER.'/dashboard2',$data);
$fR['Withdrawal_status'];

 echo $group_id  = $this->session->userdata('group_id');
 ?>


     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>  

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

                                    
                                     <!-- tile body -->
                              <div class="row">

          <div class="col-lg-12">
            <div class="row">
                
                          <?php get_message(); ?>
              <div class="col-lg-12">
                  <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Website <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp;Site Configuration </small>  </h4>
                        </div>
                       
                     </div>
          <?php if($group_id =='6'){?>
        <form class="form-horizontal"  name="form-valid" id="form-valid" action="<?php echo generateAdminForm("setting","site_setting"); ?>" method="post" enctype="multipart/form-data">
             <fieldset class="scheduler-border">
<div class="row">
  <div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_NAME">Company Name *</label>
<input type="text" name="CONFIG_COMPANY_NAME"  value="<?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?>" class="form-control tip" id="CONFIG_COMPANY_NAME"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>  

<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_WEBSITE">Site URL *</label>
<input type="text" name="CONFIG_WEBSITE" value="<?php echo $model->getValue("CONFIG_WEBSITE"); ?>" class="form-control tip" id="CONFIG_WEBSITE"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
 <div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_CMP_EMAIL">Support Email *</label>
<input type="text" name="CONFIG_CMP_EMAIL" value="<?php echo $model->getValue("CONFIG_CMP_EMAIL"); ?>" class="form-control tip" id="CONFIG_CMP_EMAIL"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div> 





<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MOBILE_NO">Mobile No *</label>
<input type="text" name="CONFIG_MOBILE_NO" value="<?php echo $model->getValue("CONFIG_MOBILE_NO"); ?>" class="form-control tip" id="CONFIG_MOBILE_NO"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COMPANY_ADDRESS">Address *</label>
<input type="text" name="CONFIG_COMPANY_ADDRESS" value="<?php echo $model->getValue("CONFIG_COMPANY_ADDRESS"); ?>" class="form-control tip" id="CONFIG_COMPANY_ADDRESS"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_ADMIN_CHARGE">Admin Charge *%</label>
<input type="text" name="CONFIG_ADMIN_CHARGE" value="<?php echo $model->getValue("CONFIG_ADMIN_CHARGE"); ?>" class="form-control tip" id="CONFIG_ADMIN_CHARGE"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_TDS">Admin Tds *%</label>
<input type="text" name="CONFIG_TDS" value="<?php echo $model->getValue("CONFIG_TDS"); ?>" class="form-control tip" id="CONFIG_TDS"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MIN_WITHDRAWL">Minimum withdrawl *FLAT</label>
<input type="text" name="CONFIG_MIN_WITHDRAWL" value="<?php echo $model->getValue("CONFIG_MIN_WITHDRAWL"); ?> " class="form-control tip" id="CONFIG_MIN_WITHDRAWL"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MAX_WITHDRAWL">Maximum withdrawl(FLAT) *</label>
<input type="text" name="CONFIG_MAX_WITHDRAWL" value="<?php echo $model->getValue("CONFIG_MAX_WITHDRAWL");?>" class="form-control tip" id="CONFIG_MAX_WITHDRAWL"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_WITHDRAWL_LIMIT">Perday Withdrawl Transaction</label>
<input type="text" name="CONFIG_WITHDRAWL_LIMIT" value="<?php echo $model->getValue("CONFIG_WITHDRAWL_LIMIT");?>" class="form-control tip" id="CONFIG_WITHDRAWL_LIMIT"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>


<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MARQUE">MARQUE</label>
<input type="text" name="CONFIG_MARQUE" value="<?php echo $model->getValue("CONFIG_MARQUE"); ?> " class="form-control tip" id="CONFIG_MARQUE"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="USD_Rate">USDT Price</label>
<input type="text" name="USD_Rate" value="<?php echo $model->getValue("USD_Rate"); ?> " class="form-control tip" id="USD_Rate"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4" style="margin-right:0px;display:none;">
<div class="form-group" style="margin-right:0px;display:none;">
<label class="lab" for="CONFIG_MARQUE">Wallet to Wallet Tranfer </label>
<select id="wallelt_to_wallelt" name="wallelt_to_wallelt" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("wallelt_to_wallelt")=='Y'){echo 'selected';}?> >Enable</option>
                                                  <option value="N" <?php if($model->getValue("wallelt_to_wallelt")=='N'){echo 'selected';}?>>Disable</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MARQUE">Withdrawl Status(All Member)</label>
<select id="Withdrawal_status" name="Withdrawal_status" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="1" <?php if($fR['Withdrawal_status']=='1'){echo 'selected';}?> >Enable</option>
                                                  <option value="0" <?php if($fR['Withdrawal_status']=='0'){echo 'selected';}?>>Disable</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>

<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="member_activation_on_off">All Member Activation On/Off </label>
<select id="member_activation_on_off" name="member_activation_on_off" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("member_activation_on_off")=='Y'){echo 'selected';}?> >On</option>
                                                  <option value="N" <?php if($model->getValue("member_activation_on_off")=='N'){echo 'selected';}?>>Off</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-3">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="member_Registration_on_off">Member Registration On/Off </label>
<select id="member_Registration_on_off" name="member_Registration_on_off" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("member_Registration_on_off")=='Y'){echo 'selected';}?> >On</option>
                                                  <option value="N" <?php if($model->getValue("member_Registration_on_off")=='N'){echo 'selected';}?>>Off</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>


<?php if(false){ ?>
<div class="col-md-3" >
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_ELITE_RATE"> Coin Rate  <a href="<?php echo BASE_PATH;?>admin/setting/viewCoinRates" target="_blank" style="color:blue;" >View All Changes</a></label>
<input type="text" name="CONFIG_ELITE_RATE" value="<?php echo $model->getValue("CONFIG_ELITE_RATE"); ?> " class="form-control tip" id="CONFIG_ELITE_RATE"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<?php $cType =  $model->getValue("CONFIG_WITHDRAWL_TYPE");?>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_WITHDRAWL_CHARGE">Withdrawl Charge Type *</label>
 <select class ="form-control" name="CONFIG_WITHDRAWL_TYPE">
 <option value="Flat" <?php echo ($cType=='Flat')?'selected':'';?>>Flat</option>   
 <option value="Percent" <?php echo ($cType=='Percent')?'selected':'';?>>Percent</option>   
</select>


</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_ENQUIRY_EMAIL">Enquiry Email *</label>
<input type="text" name="CONFIG_ENQUIRY_EMAIL" value="<?php echo $model->getValue("CONFIG_ENQUIRY_EMAIL"); ?>" class="form-control tip" id="CONFIG_ENQUIRY_EMAIL"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>



<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_PHONE">Phone No *</label>
<input type="text" name="CONFIG_PHONE" value="<?php echo $model->getValue("CONFIG_PHONE"); ?>" class="form-control tip" id="CONFIG_PHONE"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>


<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_WITHDRAWL_CHARGE">Withdrawl Charge *</label>
<input type="text" name="CONFIG_WITHDRAWL_CHARGE" value="<?php echo $model->getValue("CONFIG_WITHDRAWL_CHARGE");?>" class="form-control tip" id="CONFIG_WITHDRAWL_CHARGE"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="member_Registration_on_off">Instant OTP On/Off </label>
<select id="instant_otp" name="instant_otp" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="true" <?php if($model->getValue("instant_otp")=='true'){echo 'selected';}?> >On</option>
                                                  <option value="false" <?php if($model->getValue("instant_otp")=='false'){echo 'selected';}?>>Off</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="Email_otp">Email OTP On/Off </label>
<select id="Email_otp" name="Email_otp" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="true" <?php if($model->getValue("Email_otp")=='true'){echo 'selected';}?> >On</option>
                                                  <option value="false" <?php if($model->getValue("Email_otp")=='false'){echo 'selected';}?>>Off</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>

<div class="col-md-4" style="display:none">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_EGC_ADDRESS">EGC Address *</label>
<input type="text" name="CONFIG_EGC_ADDRESS" value="<?php echo $model->getValue("CONFIG_EGC_ADDRESS"); ?>" class="form-control tip" id="CONFIG_EGC_ADDRESS"     >
</div>
</div>
<div class="col-md-4" style="display:none">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MANUAL_USERS">Manual Users Withdrawal </label>
<select id="CONFIG_MANUAL_USERS" name="CONFIG_MANUAL_USERS" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("CONFIG_MANUAL_USERS")=='Y'){echo 'selected';}?> >On</option>
                                                  <option value="N" <?php if($model->getValue("CONFIG_MANUAL_USERS")=='N'){echo 'selected';}?>>Off</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>


 

<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_COINPAY_NO_OFF">CoinPayment Withdrawal </label>
<select id="CONFIG_COINPAY_NO_OFF" name="CONFIG_COINPAY_NO_OFF" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("CONFIG_COINPAY_NO_OFF")=='Y'){echo 'selected';}?> >On</option>
                                                  <option value="N" <?php if($model->getValue("CONFIG_COINPAY_NO_OFF")=='N'){echo 'selected';}?>>Off</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_TRX_WITHDRAWAL">TRX/TRC20 </label>
<select id="CONFIG_TRX_WITHDRAWAL" name="CONFIG_TRX_WITHDRAWAL" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("CONFIG_TRX_WITHDRAWAL")=='Y'){echo 'selected';}?> >ON</option>
                                                  <option value="N" <?php if($model->getValue("CONFIG_TRX_WITHDRAWAL")=='N'){echo 'selected';}?>>OFF</option> 
                                                   
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-4" style="display:none">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_ELITE_WITHDRAWAL">Elite </label>
<select id="CONFIG_ELITE_WITHDRAWAL" name="CONFIG_ELITE_WITHDRAWAL" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("CONFIG_ELITE_WITHDRAWAL")=='Y'){echo 'selected';}?> >ON</option>
                                                  <option value="N" <?php if($model->getValue("CONFIG_ELITE_WITHDRAWAL")=='N'){echo 'selected';}?>>OFF</option> 
                                                   
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_INR_WITHDRAWAL">INR </label>
<select id="CONFIG_INR_WITHDRAWAL" name="CONFIG_INR_WITHDRAWAL" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("CONFIG_INR_WITHDRAWAL")=='Y'){echo 'selected';}?> >ON</option>
                                                  <option value="N" <?php if($model->getValue("CONFIG_INR_WITHDRAWAL")=='N'){echo 'selected';}?>>OFF</option> 
                                                   
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-4" style="display:none;">
    <label class="lab" for="CONFIG_API_URL">Withdrawl Status *</label>
<div class="form-group" style="margin-top: 5px;">
    
<td align="center">
                            <label>
                            <input name="switch-field-1" onclick="return updatestatus(<?php echo $r11['id'];?>);" class="ace ace-switch ace-switch-4 checkStatus" <?php if($r11status['status']>0){ echo 'checked="checked"';} ?>  type="checkbox" id="<?php echo $r11['id'];?>">
                            <span class="lbl"></span>                           </label></td>

</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="INR_Rate">INR Rate</label>
<input type="text" name="INR_Rate" value="<?php echo $model->getValue("INR_Rate"); ?> " class="form-control tip" id="INR_Rate"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>

<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="USD_Rate">USD Rate</label>
<input type="text" name="USD_Rate" value="<?php echo $model->getValue("USD_Rate"); ?> " class="form-control tip" id="USD_Rate"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="JPY_Rate">JPY Rate</label>
<input type="text" name="JPY_Rate" value="<?php echo $model->getValue("JPY_Rate"); ?> " class="form-control tip" id="JPY_Rate"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>

<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="GBP_Rate">GBP Rate</label>
<input type="text" name="GBP_Rate" value="<?php echo $model->getValue("GBP_Rate"); ?> " class="form-control tip" id="GBP_Rate"  data-original-title="" title="" data-bv-field="site_name">
</div>
</div>

<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MARQUE">Instant Withdrawl</label>
<select id="Instant_status" name="Instant_status" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("Instant_status")=='Y'){echo 'selected';}?> >Enable</option>
                                                  <option value="N" <?php if($model->getValue("Instant_status")=='N'){echo 'selected';}?>>Disable</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MARQUE">Recharge</label>
<select id="Recharge_status" name="Recharge_status" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("Recharge_status")=='Y'){echo 'selected';}?> >Enable</option>
                                                  <option value="N" <?php if($model->getValue("Recharge_status")=='N'){echo 'selected';}?>>Disable</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MARQUE">Reedeem On/Off </label>
<select id="Reedeem_on_off" name="Reedeem_on_off" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("Reedeem_on_off")=='Y'){echo 'selected';}?> >On</option>
                                                  <option value="N" <?php if($model->getValue("Reedeem_on_off")=='N'){echo 'selected';}?>>Off</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>
<div class="col-md-4" style="display:none;">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_MARQUE">Crypto Tranfer </label>
<select id="wallelttransfer_status" name="wallelttransfer_status" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="Y" <?php if($model->getValue("wallelttransfer_status")=='Y'){echo 'selected';}?> >Enable</option>
                                                  <option value="N" <?php if($model->getValue("wallelttransfer_status")=='N'){echo 'selected';}?>>Disable</option> 
                                                  
                      
                          
                                    </select>
</div>
</div>
<?php } ?>


</fieldset>


<fieldset class="scheduler-border">

<div class="row">
  <div class="col-md-4">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CONFIG_FAVICON">Company Logo *</label>

<img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" style="width:102px;margin-top: -8px;" />

<input type="file" name="CONFIG_LOGO">
</div>
</div> 
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;" >
<label class="lab" for="CONFIG_FAVICON">Company Fevicon *</label>
<img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_FAVICON"); ?>" style="width:102px;margin-top: -8px;" />

<input type="file" name="CONFIG_FAVICON">
</div>
</div>   
<div class="col-md-4">
<div class="form-group" style="margin-right:0px;display:none;" >
<label class="lab" for="CONFIG_QRCode">QR Code *</label>
<img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_QRCode"); ?>" style="width:102px;margin-top: -8px;" />

<input type="file" name="CONFIG_QRCode">
</div>
</div> 
</div>





            <div class="clearfix form-action" style="float:right;">
                <div class="col-md-12">
                  <button type="submit" name="submitSite_setting" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check bigger-110"></i> Save Changes </button>
                  </div>
              </div>


</fieldset>


</div>





           
  
              </fieldset>  
               </form>
                <?php } ?>
             
             
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
 

 <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
<script type="text/javascript">
    $(function(){
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $("#form-valid").validationEngine();
        $("#form-valid").validationEngine();
        $(".getStateList").on('blur',getStateList);
        $(".getCityList").on('blur',getCityList);
        function getStateList(){
            var country_code = $("#country_code").val();
            var URL_STATE = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=STATE_LIST&country_code="+country_code;
            $("#state_name").load(URL_STATE);
        }
        function getCityList(){
            var state_name = $("#state_name").val();
            var URL_CITY = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=CITY_LIST&state_name="+state_name;
            $("#city_name").load(URL_CITY);
        }
    });
</script>