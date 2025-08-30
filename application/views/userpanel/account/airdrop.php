<?php $model = new OperationModel();  
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$model = new OperationModel();
$get_state = $model->getState();

$member_id = $this->session->userdata('mem_id');
$AR_ID = $model->memberKycDoucment($member_id,"PAN CARD");
$id_document_src = $model->kycDocument($AR_ID['kyc_id']);

$AR_ADD = $model->memberKycDoucment($member_id,"ADHAR CARD FRONT");
$add_document_src1 = $model->kycDocument($AR_ADD['kyc_id']);
$AR_SUB = $model->getCurrentMemberShip($member_id);

$AR_ADD1 = $model->memberKycDoucment($member_id,"ADHAR CARD BACK");
$add_document_src2 = $model->kycDocument($AR_ADD1['kyc_id']);

$AR_ADD3 = $model->memberKycDoucment($member_id,"CHEQUE");
$add_document_src3 = $model->kycDocument($AR_ADD3['kyc_id']);

$AR_ADD4 = $model->memberKycDoucment($member_id,"INTERNATIONAL ID");
$add_document_src4 = $model->kycDocument($AR_ADD3['kyc_id']);
//PrintR($ROW['prod_pv']);

$segment = $this->uri->segment(3, 0);


?>

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu');?>
	
<div id="content" class="app-content">

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-xl-12">

<div class="row">

<div class="col-xl-12">

<h1 class="page-header">
My Profile</h1>

<hr class="mb-4">
  <?php if($segment=='myprofile'){ ?>
          
         <div class="row">
             
             <!-- Nav tabs -->
<div class="custom-tab-1">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link active" data-bs-toggle="tab" href="#home1"><i class="la la-home me-2"></i>  Personal Information</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-bs-toggle="tab" href="#profile1"><i class="la la-user me-2"></i>  Change Password</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-bs-toggle="tab" href="#crypto"><i class="la la-user me-2"></i>Crypto Address</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="home1" role="tabpanel">
			<div class="pt-4">
			  <form action="<?php  echo  generateMemberForm("account","myprofile"); ?>" enctype="multipart/form-data" method="post" class="needs-validation">
                                <?php get_message();?>  <div class="form-group row align-items-center">
                                    <div class="col-md-12">
                                        <div class="profile-photo">



                                                     <?php  if($ROW['photo'] !=''){ $pic = $ROW['photo'];}else{ $pic='error';}
                                            if (file_exists(FCPATH.'upload/member/'.$pic)) { ?>
                                       <img class="profile-pic" src="<?php echo BASE_PATH;?>upload/member/<?php echo $ROW['photo'];?>" alt="profile-pic" style="    width: 100px;">
                                        
                                         <?php } else { ?>
<img class="profile-pic" src="<?php echo BASE_PATH;?>assetsss/images/profile/profile.png" alt="profile-pic" style="    width: 100px;">
                                           
<?php } ?>
 <div class="crm-p-image ">
                                                <i class="las la-pen upload-button"></i>
                                                <input class="file-upload" type="file"  name="avatar_name" accept="image/x-png,image/gif,image/jpeg,image/jpg" >
                                             </div>
                                    </div>
                                
                                    </div>
                                 </div>
                                 <div class=" row align-items-center">
                                    <div class="form-group col-sm-6">
                                       <label for="fname">User Id:</label>
                                        <input class="form-control"  type="text"     value="<?php echo $ROW['user_id'];?>" readonly />
                                
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="lname">Name:</label>
                                          <input class="form-control" name="first_name" type="text" id="form-field-username" placeholder=" Name" value="<?php echo $ROW['first_name'];?>"   />
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Date of Birth:</label>
                                        <input class=" form-control" id="" name="date_of_birth" value="<?php echo $ROW['date_of_birth'];?>" type="date" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" />
           
                              
                                    </div>
                                   <div class="form-group col-sm-6">
                                       <label class="d-block">Gender:</label>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="customRadio6" value="M" name="gender" class="custom-control-input" <?php if($ROW['gender']=='M'){ ?> checked="checked" <?php }?> >
                                          <label class="custom-control-label" for="customRadio6"> Male </label>
                                       </div>
                                       <div class="custom-control custom-radio custom-control-inline">
                                          <input type="radio" id="customRadio7" value="F" name="gender" class="custom-control-input" <?php if($ROW['gender']=='F'){ ?> checked="checked" <?php }?>>
                                          <label class="custom-control-label" for="customRadio7"> Female </label>
                                       </div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname"> Whatsapp No:</label>
                                        <input type="text" value="<?php echo $ROW['member_mobile'];?>" maxlength="10" class="form-control"   name="member_mobile"  >
       
                                    </div>
                                     
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Email Id:</label>
                                      <input value="<?php echo $ROW['member_email'];?>"   class="form-control"   type="text" id="member_email"  name="member_email"   placeholder="example@gmail.com" />
                                    </div>
                                   
                                    <div class="form-group col-sm-6" style="display:none;">
                                       <label for="uname">Country:</label>
                                       <select name="country" class="countries form-control" id="countryId">
    <option disabled>Select Country </option>
     <option value="<?php echo $ROW['country']; ?>" <?php if($ROW['country']){echo 'selected';}?>><?php echo $ROW['country_name']; ?></option>
</select>
                                    </div>
                                    <div class="form-group col-sm-6" style="display:none;">
                                       <label for="cname">State:</label>
                                       <select name="state" class="states form-control" id="stateId">
    <option  disabled>Select State</option>
     <option value="<?php echo $ROW['state']; ?>" <?php if($ROW['state']){echo 'selected';}?>><?php echo $ROW['state_name']; ?></option>
</select>
              
                                    </div>
                                    <div class="form-group col-sm-6" style="display:none;">
                                       <label for="cname">City:</label>
                                        <select name="city" class="cities form-control" id="cityId">
    <option  disabled>Select City</option>
     <option value="<?php echo $ROW['city']; ?>" <?php if($ROW['city']){echo 'selected';}?>><?php echo $ROW['city_name']; ?></option>
</select>
                                    </div>
                              <!--Email OTP-->
     <?php if($model->getValue("Email_otp")== 'true'){ ?> 
     
         <!--<div class="row">-->
       <!--                 <div class="col-sm-8">-->
       <!--                  <div class="form-group">-->
       <!--                 <label for="bankname">Verification Code</label>-->
                         
       <!--                 <input placeholder="Verification Code" name="email_otp" required="required" type="text" class="form-control">-->
       <!--             </div>-->
       <!--                 </div>-->
       <!--                 <div class="col-sm-4">-->
       <!--                   <div class="form-group">-->
                       
       <!--                <button style="margin-top:25px;padding:6px 20px 10px 20px;;" type="button" class="btn btn-info"  id="myBtn"><div class="v-btn__content" onclick="sendEmailOTP();">Send OTP-->
       <!-- </div></button>-->
       <!--             </div>-->
       <!--                 </div>-->
       <!--               </div>-->
     <?php } ?>
      <!--Email OTP-->  
                                   
                                 </div>
                                    <input type="hidden" name="submitMemberSave1" value="1" />
                                
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                 
                              </form>
                           
			</div>
		</div>
		<div class="tab-pane fade" id="profile1">
			<div class="pt-4">
			   <form action="<?php  echo  generateMemberForm("account","myprofile"); ?>" enctype="multipart/form-data" method="post" class="needs-validation">
                               <?php get_message();?>   <div class="form-group">
                                    <label for="cpass">Current Password:</label>
                                     <input class="form-control" name="old_password" id="old_password" placeholder="Current Password" minlength="6" maxlength="16" type="password" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="npass">New Password:</label>
                                    <input class="form-control" name="user_password" id="user_password"  placeholder="New Password" minlength="6" maxlength="16" type="password" required>
                                 </div>
                                 <div class="form-group">
                                    <label for="vpass">Verify Password:</label>
                                   <input class="form-control" name="confirm_user_password" id="confirm_user_password"  placeholder="Confirm Password" minlength="6" maxlength="16" type="password" required>
                                 </div>
                                  <input type="hidden" name="submitMemberSavePassword" value="1" />
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                               
                              </form>
                           
			</div>
		</div>
			<div class="tab-pane fade" id="crypto">
			<div class="pt-4">
			   <form action="<?php  echo  generateMemberForm("account","crypto"); ?>" enctype="multipart/form-data" method="post" class="needs-validation">
                               <?php get_message();?>   <div class="form-group">
                                    <label for="cpass">USDT (BEP20) Address:</label>
                                     <input class="form-control" name="trx_address" id="trx_address" placeholder="USDT (BEP20) Address" type="text" required value="<?php echo $ROW['trx_address'];?>" <?php echo ($ROW['trx_address']!='')?'readonly':'';?>>
                                 </div>
                                 
                                <br>
                                  <input type="hidden" name="submitMemberSaveCrypto" value="1" />
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                               
                              </form>
                           
			</div>
		</div>
	</div>
</div>
            
          
         </div>
         
         <?php } ?>
         
                <?php if($segment=='bankingasdasdasdasd'){ ?>
          
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body p-0">
                     <div class="iq-edit-list usr-edit">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                           <li class="col-md-3 p-0">
                              <a class="nav-link active" data-toggle="pill" href="#personal-information">
                             Banking Details
                              </a>
                           </li>
                          
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="iq-edit-list-data">
                  <div class="tab-content">
                     <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                              
                           </div>
                           <div class="card-body">
                             <form action="<?php  echo  generateMemberForm("account","banking"); ?>" enctype="multipart/form-data" method="post" class="needs-validation">
                           <?php get_message();?>      
                                 <div class=" row align-items-center">
                                    <div class="form-group col-sm-6">
                                       <label for="fname">Holder Name:</label>
                                        <input class="form-control" name="bank_acct_holder" value="<?php echo $ROW['bank_acct_holder'];?>" id="accountName" type="text" placeholder="  Holder Name"  <?php echo ($ROW['bank_acct_holder']!='')?'readonly':'';?>>
  
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="lname">Bank Name:</label>
                                     <input class="form-control" name="bank_name" value="<?php echo $ROW['bank_name'];?>" id="bankName" type="text" placeholder="Bank Name" <?php echo ($ROW['bank_name']!='')?'readonly':'';?>>
                              </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Account No:</label>
                                       <input class="form-control" name="account_number" value="<?php echo $ROW['account_number'];?>" id="accountNo" placeholder="Account No." type="text" <?php echo ($ROW['account_number']!='')?'readonly':'';?>>
                           
                              
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname"> SWIFT/IFSC Code:</label>
                                          <input class="form-control" name="ifc_code" id="ifscCode" value="<?php echo $ROW['ifc_code'];?>" placeholder="SWIFT/IFSC Code" type="text" <?php echo ($ROW['ifc_code']!='')?'readonly':'';?>>
             
                                    </div>
                                  
                                    <div class="form-group col-sm-6">
                                       <label for="uname"> Branch Name:</label>
                                         <input class="form-control" name="branch" value="<?php echo $ROW['branch'];?>" id="branchName" placeholder="Branch Name" type="text" <?php echo ($ROW['branch']!='')?'readonly':'';?>>
                         
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Pan Card No:</label>
                                    <input class="form-control" name="pan_no" value="<?php echo $ROW['pan_no'];?>" id="panno" placeholder="Pan Card No" type="text" <?php echo ($ROW['pan_no']!='')?'readonly':'';?>>
                   </div>
                                   
                                    <div class="form-group col-sm-6">
                                       <label for="uname">Aadhaar No:</label>
                                        <input class="form-control" name="adhar" id="adhar" value="<?php echo $ROW['adhar'];?>" placeholder="Aadhaar Number" type="text" <?php echo ($ROW['adhar']!='')?'readonly':'';?>>
                 
                                    </div>
                                     <div class="form-group col-sm-6">
                                       <label for="uname"> Phonepe No:</label>
                                        <input type="text" value="<?php echo $ROW['phonepay'];?>" maxlength="10" class="form-control"   name="phonepay" <?php echo ($ROW['phonepay']!='')?'readonly':'';?> >
       
                                    </div>
                                       <div class="form-group col-sm-6">
                                       <label for="uname"> Googlepay No:</label>
                                        <input type="text" value="<?php echo $ROW['googlepay'];?>" maxlength="10" class="form-control"   name="googlepay" <?php echo ($ROW['googlepay']!='')?'readonly':'';?> >
       
                                    </div>
                                       <div class="form-group col-sm-6">
                                       <label for="uname"> Paytm No:</label>
                                        <input type="text" value="<?php echo $ROW['paytm'];?>" maxlength="10" class="form-control"   name="paytm" <?php echo ($ROW['paytm']!='')?'readonly':'';?> >
       
                                    </div>
                                   
                                 </div>
                                    <input type="hidden" name="submitMemberSave2" value="1" />
                                
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                 
                              </form>
                           </div>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
         
         <?php } ?>
          <?php if($segment=='cryptosdfghjhgfdsasdfghjjhgfdsasdfghjkjhgfdsdfghjtrewertyuasdcvbnjhgfd'){ ?>
          
         <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body p-0">
                     <div class="iq-edit-list usr-edit">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                           <li class="col-md-3 p-0">
                              <a class="nav-link active" data-toggle="pill" href="#personal-information">
                            Crypto Details
                              </a>
                           </li>
                          
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="iq-edit-list-data">
                  <div class="tab-content">
                     <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                         
                           <div class="card-body">
                             <form action="<?php  echo  generateMemberForm("account","crypto"); ?>" enctype="multipart/form-data" method="post" class="needs-validation">
                               <?php get_message();?>  
                                 <div class=" row align-items-center">
                                    <div class="form-group col-sm-6" style="display:none;">
                                       <label>BTC Address</label>
                              <?php if($ROW['btc_address']){ ?>
                                      <p> <?php echo $ROW['btc_address'];?></p>
                                      <?php }else{ ?>
                       
                       <input class="form-control" name="btc_address" id="btc_address" placeholder="Enter BTC Address" <?php if($ROW['btc_address']){echo "readonly";} ?>  value="<?php echo $ROW['btc_address'];?>"  type="text"  >
       
                              
                        <?php } ?>     
                             
                             
                             
                                    </div>
                                    <div class="form-group col-sm-6" >
                                       <label>BUSD (BEP20) Address</label>
                            <?php if($ROW['trx_addressss']){ ?>
                                      <p> <?php echo $ROW['trx_address'];?></p>
                                      <?php }else{ ?>
                       
                      <input class="form-control" name="trx_address" id="trx_address"  placeholder="Enter BUSD (BEP20) Address"  <?php if($ROW['trx_address']){echo "readonlycccc";} ?> value="<?php echo $ROW['trx_address'];?>"  type="text"  >
       
                              
                        <?php } ?>            
                                       
                                    </div>
                                    <div class="form-group col-sm-6" style="display:none;">
                                        <label>ETH Address</label>
                              <?php if($ROW['eth_address']){ ?>
                                      <p> <?php echo $ROW['eth_address'];?></p>
                                      <?php }else{ ?>
                       
                         <input class="form-control" name="eth_address" id="eth_address"  placeholder="Enter ETH Address"  value="<?php echo $ROW['eth_address'];?>"  type="text"  >
                         
                              
                        <?php } ?> 
                                       
                              
                              
                              
                                    </div>
                                    <div class="form-group col-sm-6" style="display:none;">
                                       <label>USDT Address</label>
                                       
                                        
                                    <?php if($ROW['usdt_address']){ ?>
                                      <p> <?php echo $ROW['usdt_address'];?></p>
                                      <?php }else{ ?>
                       
                       
                         <input class="form-control" name="usdt_address" id="usdt_address"  placeholder="Enter USDT Address"   value="<?php echo $ROW['usdt_address'];?>"  type="text"  >
                  
                        <?php } ?> 
                                       
                           
                                    </div>
                                  
                                    <div class="form-group col-sm-6" style="display:none;">
                                     <label>Kings Coin Address</label>
                                     
                                    <?php if($ROW['Elite_address']){ ?>
                                      <p> <?php echo $ROW['Elite_address'];?></p>
                                      <?php }else{ ?>
                       
                       
                         <input class="form-control" name="Elite_address" id="Elite_address"  placeholder="Enter Kings Coin Address" value="<?php echo $ROW['Elite_address'];?>"  type="text"  >
                  
                        <?php } ?>
                                    </div>
                           <div class="form-group col-md-6 col-12">
                                   <br>
                                 <!--<span id="count">120</span> Seconds -->
                 
                              </div>    
                                 
                         <!--Email OTP-->
     <?php if($model->getValue("Email_otp")== 'false'){ ?> 
   
         <div class="row">
                        <div class="col-sm-7">
                         <div class="form-group">
                        <label for="bankname">Email Verification</label>
                         
                        <input placeholder="Verification Code" name="cemail_otp" required="required" type="text" class="form-control">
                    </div>
                        </div>
                        <div class="col-sm-5">
                          <div class="form-group">
                       
                       <button style="margin-top:33px;padding:6px 20px 10px 20px;;  white-space: nowrap ;" type="button" class="btn btn-info" id="myBtn"><div class="v-btn__content" onclick="CryptosendEmailOTP(); ">Send OTP   <span id="count" style="visibility:hidden;">00 S</span>
        </div></button>  
        
                    </div>
                        </div>
                      </div>
     <?php } ?>
      <!--Email OTP-->             
                                   
                                 </div>
                                     <input type="hidden" name="submitMemberSaveCrypto" value="1" />
                                
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                 
                              </form>
                           </div>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
         
         <?php } ?>
               <?php if($segment=='updatekycasdasdqweq'){ ?>
          
        <div class="row">
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-body p-0">
                     <div class="iq-edit-list usr-edit">
                        <ul class="iq-edit-profile d-flex nav nav-pills">
                           <li class="col-md-3 p-0">
                              <a class="nav-link active" data-toggle="pill" href="#personal-information">
                            Kyc Details
                              </a>
                           </li>
                          
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-12">
               <div class="iq-edit-list-data">
                  <div class="tab-content">
                     <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                             
                        <div class="card">
                           <div class="card-header d-flex justify-content-between">
                             <div class="iq-header-title">
                                 <h4 class="card-title"> <?php if($ROW['prod_pv'] > 0){ ?>
            <?php }else {?>
            
            <!--<h4 style="color:red;">Before Kyc Kindly Activate Your Id</h4>-->
            
            <?php } ?></h4>
                              </div>  
                           </div>
                           
                              <?php get_message();?> 
                           <div class="card-body">
                            <form action="<?php  echo  generateMemberForm("account","updatekyc"); ?>" enctype="multipart/form-data" method="post" class="form row"  >
                 <p>Pan Card:  </p> 
                  <?php if($AR_ID['kyc_id']==""){ 
                                            echo "<div class='alert text-white bg-info' style='margin-top: 23px;'>  Upload Again <i class='fa fa-upload' aria-hidden='true' style='margin-top: 3px;margin-left: 10px;'></i></div>"; 
                                        }elseif($AR_ID['kyc_id']>0 && $AR_ID['approved_sts']>0){
                                            echo "<div class='alert text-white bg-success' style='margin-top: 23px;'> Verified <i class='fa fa-check-circle' aria-hidden='true'></i></div>"; 
                                        }elseif($AR_ID['kyc_id']>0 && $AR_ID['approved_sts']==0){
                                            echo "<div class='alert text-white bg-warning' style='margin-top: 23px;'>  Pending <i class='fa fa-clock-o' aria-hidden='true' style='margin-top: 5px;margin-left: 6px;'></i> </div>"; 
                                        }elseif($AR_ID['kyc_id']>0 && $AR_ID['approved_sts']<0){
                                            echo "<div class='alert text-white bg-danger' style='margin-top: 23px;'>Rejected <i class='fa fa-times-circle'></i></div>"; 
                                        }
                                     ?> 
                        <div class="custom-file mb-3">
                                <?php if($AR_ID['kyc_id']==""){ ?>
                           <input class="custom-file-input" name="panfile" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="panfile" required  type="file">
                              <label class="custom-file-label" style="margin-top: 12px;"  for="customFile">Choose file</label>
                           
                            <?php }elseif($AR_ID['kyc_id']>0 && $AR_ID['approved_sts']>0){ ?> 
                                <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $id_document_src;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                <?php }elseif($AR_ID['kyc_id']>0 && $AR_ID['approved_sts']==0){ ?>
                                    <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $id_document_src;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                    <?php   }elseif($AR_ID['kyc_id']>0 && $AR_ID['approved_sts']<0){ ?>
                                    
                                      <input class="custom-file-input" name="panfile" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="panfile" required   type="file">
                                      <label class="custom-file-label" style="margin-top: 12px;"  for="customFile">Choose file</label>
                           
                                        <?php } ?>
                         
                        </div>
                         <p>Aadhaar Front:</p>
                         
                    <?php if($AR_ADD['kyc_id']==""){ 
                                            echo "<div class='alert text-white bg-info' style='margin-top: 23px;'>  Upload Again <i class='fa fa-upload' aria-hidden='true' style='margin-top: 3px;margin-left: 10px;'></i></div>"; 
                                        }elseif($AR_ADD['kyc_id']>0 && $AR_ADD['approved_sts']>0){
                                            echo "<div class='alert text-white bg-success' style='margin-top: 23px;'> Verified <i class='fa fa-check-circle' aria-hidden='true'></i></div>"; 
                                        }elseif($AR_ADD['kyc_id']>0 && $AR_ADD['approved_sts']==0){
                                            echo "<div class='alert text-white bg-warning' style='margin-top: 23px;'>  Pending <i class='fa fa-clock-o' aria-hidden='true' style='margin-top: 5px;margin-left: 6px;'></i> </div>"; 
                                        }elseif($AR_ADD['kyc_id']>0 && $AR_ADD['approved_sts']<0){
                                            echo "<div class='alert text-white bg-danger' style='margin-top: 23px;'>Rejected <i class='fa fa-times-circle'></i></div>"; 
                                        }
                                     ?> 
                        <div class="custom-file mb-3">
                                <?php if($AR_ADD['kyc_id']==""){ ?>
                           <input class="custom-file-input" name="adharfront" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="adharfront" required  type="file">
                              <label class="custom-file-label" style="margin-top: 12px;"  for="customFile">Choose file</label>
                           
                            <?php }elseif($AR_ADD['kyc_id']>0 && $AR_ADD['approved_sts']>0){ ?> 
                                <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src1;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                <?php }elseif($AR_ADD['kyc_id']>0 && $AR_ADD['approved_sts']==0){ ?>
                                    <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src1;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                    <?php   }elseif($AR_ADD['kyc_id']>0 && $AR_ADD['approved_sts']<0){ ?>
                                    
                                      <input class="custom-file-input" name="adharfront" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="adharfront" required   type="file">
                                      <label class="custom-file-label" style="margin-top: 12px;"  for="customFile">Choose file</label>
                           
                                        <?php } ?>
                         
                        </div>
                         <p>Aadhaar Back:</p>
                         <?php if($AR_ADD1['kyc_id']==""){ 
                                            echo "<div class='alert text-white bg-info' style='margin-top: 23px;'>  Upload Again <i class='fa fa-upload' aria-hidden='true' style='margin-top: 3px;margin-left: 10px;'></i></div>"; 
                                        }elseif($AR_ADD1['kyc_id']>0 && $AR_ADD1['approved_sts']>0){
                                            echo "<div class='alert text-white bg-success' style='margin-top: 23px;'> Verified <i class='fa fa-check-circle' aria-hidden='true'></i></div>"; 
                                        }elseif($AR_ADD1['kyc_id']>0 && $AR_ADD1['approved_sts']==0){
                                            echo "<div class='alert text-white bg-warning' style='margin-top: 23px;'>  Pending <i class='fa fa-clock-o' aria-hidden='true' style='margin-top: 5px;margin-left: 6px;'></i> </div>"; 
                                        }elseif($AR_ADD1['kyc_id']>0 && $AR_ADD1['approved_sts']<0){
                                            echo "<div class='alert text-white bg-danger' style='margin-top: 23px;'>Rejected <i class='fa fa-times-circle'></i></div>"; 
                                        }
                                     ?> 
                        <div class="custom-file mb-3">
                                <?php if($AR_ADD1['kyc_id']==""){ ?>
                           <input class="custom-file-input" name="adharback" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="adharback" required  type="file">
                              <label class="custom-file-label" style="margin-top: 12px;"  for="customFile">Choose file</label>
                           
                            <?php }elseif($AR_ADD1['kyc_id']>0 && $AR_ADD1['approved_sts']>0){ ?> 
                                <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src2;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                <?php }elseif($AR_ADD1['kyc_id']>0 && $AR_ADD1['approved_sts']==0){ ?>
                                    <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src2;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                    <?php   }elseif($AR_ADD1['kyc_id']>0 && $AR_ADD1['approved_sts']<0){ ?>
                                    
                                      <input class="custom-file-input" name="adharback" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="adharback" required   type="file">
                                      <label class="custom-file-label" style="margin-top: 12px;"  for="customFile">Choose file</label>
                           
                                        <?php } ?>
                         
                        </div>
                         
                         <p>Cheque/Passbook:</p>
                         <?php if($AR_ADD3['kyc_id']==""){ 
                                            echo "<div class='alert text-white bg-info' style='margin-top: 23px;'>  Upload Again <i class='fa fa-upload' aria-hidden='true' style='margin-top: 3px;margin-left: 10px;'></i></div>"; 
                                        }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']>0){
                                            echo "<div class='alert text-white bg-success' style='margin-top: 23px;'> Verified <i class='fa fa-check-circle' aria-hidden='true'></i></div>"; 
                                        }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']==0){
                                            echo "<div class='alert text-white bg-warning' style='margin-top: 23px;'>  Pending <i class='fa fa-clock-o' aria-hidden='true' style='margin-top: 5px;margin-left: 6px;' ></i> </div>"; 
                                        }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']<0){
                                            echo "<div class='alert text-white bg-danger' style='margin-top: 23px;'>Rejected <i class='fa fa-times-circle'></i></div>"; 
                                        }
                                     ?> 
                        <div class="custom-file mb-3">
                                <?php if($AR_ADD3['kyc_id']==""){ ?>
                           <input class="custom-file-input" name="cheque" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="cheque" required  type="file">
                              <label class="custom-file-label" style="margin-top: 12px;"  for="customFile">Choose file</label>
                           
                            <?php }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']>0){ ?> 
                                <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src3;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                <?php }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']==0){ ?>
                                    <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src3;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                    <?php   }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']<0){ ?>
                                    
                                      <input class="custom-file-input" name="cheque" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="cheque" required   type="file">
                                      <label class="custom-file-label" style="margin-top: 12px;"  for="customFile">Choose file</label>
                           
                                        <?php } ?>
                         
                        </div>
                        </div>
                        <div style="display:none;">
                         <p>International Id / Passport (optional):</p>
                         <?php if($AR_ADD3['kyc_id']==""){ 
                                            echo "<div class='alert text-white bg-info' style='margin-top: 23px;'>  Upload Again <i class='fa fa-upload' aria-hidden='true' style='margin-top: 3px;margin-left: 10px;'></i></div>"; 
                                        }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']>0){
                                            echo "<div class='alert text-white bg-success' style='margin-top: 23px;'> Verified <i class='fa fa-check-circle' aria-hidden='true'></i></div>"; 
                                        }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']==0){
                                            echo "<div class='alert text-white bg-warning' style='margin-top: 23px;'>  Pending <i class='fa fa-clock-o' aria-hidden='true ' style='margin-top: 5px;margin-left: 6px;'></i> </div>"; 
                                        }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']<0){
                                            echo "<div class='alert text-white bg-danger' style='margin-top: 23px;'>Rejected <i class='fa fa-times-circle'></i></div>"; 
                                        }
                                     ?> 
                        <div class="custom-file mb-3" >
                                <?php if($AR_ADD3['kyc_id']==""){ ?>
                           <input class="custom-file-input" name="internationid" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="internationid"    type="file">
                            <?php }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']>0){ ?> 
                                <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src4;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                <?php }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']==0){ ?>
                                    <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src4;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                    <?php   }elseif($AR_ADD3['kyc_id']>0 && $AR_ADD3['approved_sts']<0){ ?>
                                    
                                      <input class="custom-file-input" name="internationid" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="internationid"    type="file">
                                      <label class="custom-file-label" style="margin-top: 12px;"  for="customFile">Choose file</label>
                           
                                        <?php } ?>
                         
                        </div>
                        </div>
                          <?php if(($AR_ID['approved_sts'] =='1') &&( $AR_ADD['approved_sts'] =='1')  &&( $AR_ADD1['approved_sts'] =='1') &&( $AR_ADD3['approved_sts'] =='1')   ){ }else{ ?>
          
           
            <div class="clearfix ">
            <div class="col-md-offset-3" >
               <input type="hidden" name="submitkycupadation" value="1" />  
               <button   data-repeater-create class="btn btn-primary" type="submit">
                                    <i class="icon-plus4"></i> Update 
                                </button>
           
            
            </div>
            </div>
        
            <?php } ?> 
                    
                        </form>
                      
                           </div>
                        </div>
                     </div>
                     
                  </div>
               </div>
            </div>
         </div>
         
         <?php } ?>

</div>




</div>

</div>

</div>

</div>

</div>
      
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>