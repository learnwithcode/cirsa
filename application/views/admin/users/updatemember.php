<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$getCountryName = $model->getCountryName1();
//PrintR($getCountryName);
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
                        <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Users <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Edit </small>  </h4>
                        </div>
                        <div class="clearfix">
            
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                 <div class="row">
         
          <div class="col-md-12"  > 
          
        <form   name="form-page" id="form-page" action="<?php echo generateAdminForm("users","updatemember",""); ?>" method="post">
 
          <style>
          .card{padding: 0px 30px 10px 20px;}
      </style>      
    <h4 class="header blue bolder smaller">Personal Detail</h4>
  
        <div class="row">
            
     <div class="col-md-3">   
<div class="form-group">
      <label for="usr">Username/userId:</label>
      <input class="form-control" name="user_id" type="text" readonly id="spr_user_id" placeholder="Name" value="<?php echo $ROW['user_id'];?>" >
       <div   id="ajax_loading"  align="center"></div>
    </div>
    </div>  


     <div class="col-md-3">  
     <div class="form-group">
      <label for="pwd">Full Name :</label>
      <input name="first_name" type="text" id="form-field-username" placeholder="First Name" value="<?php echo $ROW['first_name'];?>" class="form-control" >

    </div>
    </div>
    <div class="col-md-3">   
     <div class="form-group">
      <label for="pwd">Member Email :</label>
      <input name="member_email" type="text" id="form-field-username" placeholder="E mail" value="<?php echo $ROW['member_email'];?>"  class="form-control" >

    </div>
     </div>
    <div class="col-md-3">   
     <div class="form-group">
      <label for="pwd">Mobile No:</label>
      <input class="form-control" type="text" value="<?php echo $ROW['member_phone'];?>"   maxlength="15" name="member_phone" >
    </div>
    </div>
 
    <div class="col-md-3">   
       <div class="form-group">
      <label for="pwd">Date Of Birth:</label>
      <input class="form-control" id="form-field-date"   name="date_of_birth"value="<?php echo $ROW['date_of_birth'];?>" type="date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" autocomplete="off">
      
    </div>
    </div>
    <div class="col-md-3">   
    <div class="form-group">
      <label for="pwd">Gender:</label>
     <select id="gender" name="gender" class=" form-control" >
                                                  <option value="" >--Select Gender--</option>
                                                  <option value="M" <?php if($ROW['gender']=='M'){echo 'selected';}?> >Male</option>
                                                  <option value="F" <?php if($ROW['gender']=='F'){echo 'selected';}?>>Female</option> 
                                                  
                      
                          
                                    </select>
    </div>
    </div>
     <div class="col-md-3">   
    <div class="form-group">
      <label for="pwd">Block Sts:</label>
     <select id="block_sts" name="block_sts" class=" form-control" >
                                                  <option value="" >--Select Block/Un-Block--</option>
                                                  <option value="Y" <?php if($ROW['block_sts']=='Y'){echo 'selected';}?> >Block</option>
                                                  <option value="N" <?php if($ROW['block_sts']=='N'){echo 'selected';}?>>Un-Block</option> 
                                                  
                      
                          
                                    </select>
    </div>
    </div>
  
    <div class="col-md-3">    
    <div class="form-group">
      <label for="pwd">Country :</label>
     <select  name="country_name" class="form-control" id="country_name" >
<option value="">Select Country</option>
<?php foreach($getCountryName as $val){ ?>
<option value="<?php echo $val['phonecode'];?>" <?php if($ROW['country_name']==$val['phonecode']) {echo "selected";} ?> ><?php echo $val['country_name'];?>[ +<?php echo $val['phonecode'];?> ]</option>
<?php } ?>
</select>
    </div>
     </div>
      <div class="col-md-4">   
    <div class="form-group">
      <label for="pwd">ROI Status:</label>
     <select id="offroi" name="offroi" class=" form-control" >
                                                  <option value="" >--Select OFF/ON--</option>
                                                  <option value="Y" <?php if($ROW['offroi']=='Y'){echo 'selected';}?> >OFF</option>
                                                  <option value="N" <?php if($ROW['offroi']=='N'){echo 'selected';}?>>ON</option> 
                                                  
                      
                          
                                    </select>
    </div>
    </div>
      <div class="col-md-4">   
    <div class="form-group">
      <label for="pwd">All-Income Status:</label>
     <select id="allincome" name="allincome" class=" form-control" >
                                                  <option value="" >--Select OFF/ON--</option>
                                                  <option value="Y" <?php if($ROW['allincome']=='Y'){echo 'selected';}?> >OFF</option>
                                                  <option value="N" <?php if($ROW['allincome']=='N'){echo 'selected';}?>>ON</option> 
                                                  
                      
                          
                                    </select>
    </div>
    </div>
   <div class="col-md-3" style="display:none;">
    <div class="form-group">
      <label for="pwd">Withdrawals INR Status:</label>
     <select id="Withdrawal_status" name="Withdrawal_status" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="1" <?php if($ROW['Withdrawal_status']=='1'){echo 'selected';}?> >Enable</option>
                                                  <option value="0" <?php if($ROW['Withdrawal_status']=='0'){echo 'selected';}?>>Disable</option> 
                                                  
                      
                          
                                    </select>
    </div>
     </div>
  
     <div class="col-md-4">
    <div class="form-group">
      <label for="pwd">Activation :</label>
     <select id="activation_sts" name="activation_sts" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="N" <?php if($ROW['activation_sts']=='N'){echo 'selected';}?> >Enable</option>
                                                  <option value="Y" <?php if($ROW['activation_sts']=='Y'){echo 'selected';}?>>Disable</option> 
                                                  
                      
                          
                                    </select>
    </div>
      </div>
     <div class="col-md-4">
    <div class="form-group">
      <label for="pwd">Email Verify :</label>
     <select id="emailverify" name="emailverify" class=" form-control" >
                                                  <option value="" >--Select Status--</option>
                                                  <option value="N" <?php if($ROW['emailverify']=='N'){echo 'selected';}?> >Verify Pending</option>
                                                  <option value="Y" <?php if($ROW['emailverify']=='Y'){echo 'selected';}?>>Verify Done</option> 
                                                  
                      
                          
                                    </select>
    </div>
     </div>
 </div>
        <h4   class="header blue">Banking Details</h4>   
    <div class="row"  >
   
          
      <div class="col-md-4">            
    <div class="form-group">
      <label for="usr">Bank Name:</label>
      <input class="form-control" name="bank_name" value="<?php echo $ROW['bank_name'];?>"  id="bankName" type="text" placeholder="Bank Name" >
    </div>
    </div>
     <div class="col-md-4">  
    <div class="form-group">
      <label for="pwd">Bank Account Holder Name :</label>
      <input name="bank_acct_holder" value="<?php echo $ROW['bank_acct_holder'];?>"  id="accountName" type="text" placeholder="Account Holder Name" class="form-control"  >

    </div>
     </div>
     <div class="col-md-4">
    <div class="form-group">
      <label for="pwd">Bank Account No:</label>
      <input class="form-control" name="account_number" value="<?php echo $ROW['account_number'];?>"  id="accountNo" placeholder="Account No." type="text" >
    </div>
     </div>
     <div class="col-md-4">
    <div class="form-group">
      <label for="pwd">Bank IFSC Code:</label>
      <input name="ifc_code" id="ifscCode" value="<?php echo $ROW['ifc_code'];?>"   placeholder="IFSC Code" type="text"  class="form-control" >
    </div>
     </div>
     <div class="col-md-4">
     <div class="form-group">
      <label for="pwd">Bank Branch Name:</label>
      <input name="branch" value="<?php echo $ROW['branch'];?>" id="branchName"  placeholder="Branch Name" type="text"  class="form-control" >
    </div>
    </div>
     <div class="col-md-4">
    <div class="form-group">
      <label for="pwd">Pan No:</label>
      <input name="pan_no" value="<?php echo $ROW['pan_no'];?>"  id="panno" placeholder="Pan No" type="text" class="form-control" >
    </div>
    </div>
     <div class="col-md-4">
    <div class="form-group">
      <label for="pwd">Adhar No:</label>
      <input name="adhar" id="adhar"  value="<?php echo $ROW['adhar'];?>" placeholder="Adhar Number" type="text"  class="form-control" >
    </div>
 </div>
 
  <div class="col-md-4">
    <div class="form-group">
      <label for="pwd">UPI//VPA ID:</label>
      <input name="phonepay" id="phonepay"  value="<?php echo $ROW['phonepay'];?>" placeholder="UPI//VPA ID" type="text"  class="form-control" >
    </div>
 </div>
   
    
        </div>  
        
       <h4 class="header blue">Login Info</h4>  
    <div class="row">
    
  <div class="col-md-6">
    <div class="form-group">
      <label for="pwd">Username:</label>
      <input name="user_name" value="<?php echo $ROW['user_name'];?>"  readonly  id="panno" placeholder="Username" type="text" class="form-control" >
    </div>
   </div>
    <div class="col-md-6">
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input name="user_password" id="user_password"  value="<?php echo $ROW['user_password'];?>" placeholder="Password" type="text"  class="form-control" >
    </div>
      </div>
    <div class="col-md-12">
     <div class="form-group">
      <label for="pwd">USDT (BEP20) Withdrawal Address:</label>
      <input name="trx_address" id="trx_address"  value="<?php echo $ROW['trx_address'];?>" placeholder="BUSD Address" type="text"  class="form-control" >
    </div>
      </div>
        <div class="col-md-6" style="display:none;">
     <div class="form-group">
      <label for="pwd">Own Token Address:</label>
      <input name="ownaddress" id="ownaddress"  value="<?php echo $ROW['ownaddress'];?>" placeholder="Own Token Address" type="text"  class="form-control" >
    </div>
      </div>
    <div class="col-md-12">
     <div class="form-group">
                
                  <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                  <input type="hidden" name="member_id" id="member_id" value="<?php echo $ROW['member_id']; ?>">
                  <button type="submit" name="submitMemberSave" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Update </button>

               
              </div>
      
        </div>
       
              
              
            </form>

         
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
<?php jquery_validation(); auto_complete(); ?>
<script type="text/javascript">
  $(function(){
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
  
  function getcities(state)
      {
    
    //alert(state);
jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "admin/users/getcities",

data: {name: state},
success: function(res) {
$("#cities").html(res);
}
});

      }
      
      
      $( document ).ready(function() {
         var state = document.getElementById("state_name").value;
         var city =  document.getElementById("cities").value;
         if(state !='' && city=='')
         {
          
   jQuery.ajax({
        type: "POST",
        url: "<?php echo BASE_PATH; ?>" + "admin/users/getcities",
        
        data: {name: state},
        success: function(res) {
        $("#cities").html(res);
        }
        });

              }
});

  $("#spr_user_id").on('blur',function(){  
      var URL_SPR = "<?php echo BASE_PATH; ?>json/jsonhandler";
      var spr_user_id = $("#spr_user_id").val();
      $.getJSON(URL_SPR,{switch_type:"CHECKUSERID",spr_user_id:spr_user_id},function(JsonEval){
        if(JsonEval){
          if(JsonEval.member_id>0){
            $("#spr_full_name").val(JsonEval.full_name);
            $("#ajax_loading").html('<div class="alert alert-success"> ALLREADY TAKEN !</div>');
          }else{
            $("#spr_full_name").val('');
            $("#ajax_loading").html('<div class="alert alert-warning"> NOT TAKEN ! </div>');
            return  false;
          }
        }else{
          $("#spr_full_name").val('');
          $("#ajax_loading").html('<div class="alert alert-warning">NOT TAKEN ! </div>');
          return false;
        }
      });
  });
</script>