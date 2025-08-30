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

$AR_ADD4 = $model->memberKycDoucment($member_id,"NOMINEE ID");
$add_document_src4 = $model->kycDocument($AR_ADD3['kyc_id']);
//PrintR($ROW['prod_pv']);

$segment = $this->uri->segment(3, 0);
$memberdetailssss = $model->getMemberdetail($member_id);

?>
 
<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

 

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php
        
        $this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
        
        ?>
        
       
        <!--**********************************
            Nav header end
        ***********************************-->
		
		
	

        <!--**********************************
            Sidebar start
        ***********************************-->
     <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu');  ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
	     <!--**********************************
            Content body start
        ***********************************-->
       <div class="content-body">
			<div class="container-fluid">
                 <div class="page-titles">
					<h4>My Profile</h4>
				
                </div>
                <!-- row -->

                
                <div class="row">
                     <div class="col-xl-12">
                        <div class="card h-auto">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#Personal-Information" data-bs-toggle="tab" class="nav-link active show">Personal Information</a>
                                            </li>
                                            <li class="nav-item"><a href="#Change-Password" data-bs-toggle="tab" class="nav-link">Change Password</a>
                                            </li>
                                            <?php if(false){ ?>
                                            <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab" class="nav-link">Bank Details</a>
                                            </li>
                                              <li class="nav-item"><a href="#kyc-settings" data-bs-toggle="tab" class="nav-link">Kyc Details</a>
                                            </li>
                                            
                                            <?php } ?>
                                             <li class="nav-item"><a href="#crypto-settings" data-bs-toggle="tab" class="nav-link">Crypto Details</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="Personal-Information" class="tab-pane fade active show">
                                                 <br>
                                                
                                                 <form action="<?php  echo  generateMemberForm("account","myprofile"); ?>" enctype="multipart/form-data" method="post" class="needs-validation">
                                        <?php get_message();?>

                                    <div class="crm-p-image ">
                                        <i class="las la-pen upload-button"></i>
                                        <input class="file-upload" type="file" name="avatar_name"
                                            accept="<?php echo BASE_PATH; ?>assetsuser/image/x-png,image/gif,image/jpeg,image/jpg">
                                    </div>

                                    <div class="crm-p-image ">
                                        <label for="">User Id</label>
                                        <input  type="text"   class="form-control"   value="<?php echo $ROW['user_id'];?>" readonly />
                                    </div>
                                    
                                    <?php if($memberdetailssss['subcription_id']>0){ ?>
                                     <div class="crm-p-image ">
                                        <label for="">Name:</label>
                                       <input name="first_name" class="form-control" type="text" id="form-field-username" placeholder=" Name" value="<?php echo $ROW['first_name'];?>"  <?php echo ($ROW['first_name']!='')?'readonly':'';?>  />
                            
                                    </div>

                                    
                                    
                                    <?php }else{ ?>
                                     <div class="crm-p-image ">
                                        <label for="">Name:</label>
                                       <input name="first_name" class="form-control" type="text" id="form-field-username" placeholder=" Name" value="<?php echo $ROW['first_name'];?>"  />
                            
                                    </div>

                                    
                                    <?php } ?>
                                   
                                    
                                    <div class="crm-p-image " style="display:none;">
                                        <label for="">Date of Birth:</label>
                                     <input id="" name="date_of_birth" class="form-control" value="<?php echo $ROW['date_of_birth'];?>" type="date" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy" />
           
                                    </div>
                                    <div class="crm-p-image " style="display:none;">
                                        <p>Gender:
                                        </p>
                                        <div><input type="radio" value="M" name="gender" <?php if($ROW['gender']=='M'){ ?> checked="checked" <?php }?> ><label for="male">Male</label>
                                        <input type="radio"  value="F" name="gender"  <?php if($ROW['gender']=='F'){ ?> checked="checked" <?php }?>><label for="Female">Female</label>
                                        </div>
                                      
                                    </div>


 <?php if($memberdetailssss['subcription_id']>0){ ?>
                                    
                                 
                                    <div class="crm-p-image ">
                                        <label for="">Whatsapp No:</label>
                                        <input type="text" class="form-control" value="<?php echo $ROW['member_phone'];?>" maxlength="10"   name="member_mobile"  <?php echo ($ROW['member_phone']!='')?'readonly':'';?>>
                                    </div>

                                    <div class="crm-p-image ">
                                        <label for="">Email Id:</label>
                                       <input value="<?php echo $ROW['member_email'];?>"  class="form-control" type="text" id="member_email"  name="member_email"   placeholder="example@gmail.com" <?php echo ($ROW['member_email']!='')?'readonly':'';?> />
                                
                                    </div>
   
                                    
                                    <?php }else{ ?>
                                    
                                    
                                    <div class="crm-p-image ">
                                        <label for="">Whatsapp No:</label>
                                        <input type="text" class="form-control" value="<?php echo $ROW['member_phone'];?>" maxlength="10"   name="member_mobile"  >
                                    </div>

                                    <div class="crm-p-image ">
                                        <label for="">Email Id:</label>
                                       <input value="<?php echo $ROW['member_email'];?>"  class="form-control" type="text" id="member_email"  name="member_email"   placeholder="example@gmail.com" />
                                
                                    </div>

                                    <?php } ?>







                                    <div class="crm-p-image ">
                                        <label for="">Country:</label>
                                        <?php  $member_mobile = strlen($memberdetailssss['member_mobile']); 
                                                 $member_phone =strlen($memberdetailssss['member_phone']);
                                        
                                       $ttppp = $member_phone-$member_mobile;
                                        if($memberdetailssss['country_name']==''){
                                        $countrycode = substr($memberdetailssss['member_phone'],1,$ttppp-1);
                                        }else{
                                           $countrycode = $memberdetailssss['country_name'];
                                           
                                        }    
                                      $countryname =  $model->getMobileCodebyname($countrycode);
                                        
                                        
                                        ?>
                                        
                                        
                                        <input type="text" class="form-control" value="<?php echo $countryname;?>" maxlength="10"   name="country_name"  <?php echo ($countryname!='')?'readonly':'';?>>
                                    </div>
                                
                               
                                    <div class="col-md-12 ">
                                        <input type="hidden" name="submitMemberSave1" value="1" />
                                
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    </div>
                                    
                                 <br>
                                
                                </form>
                  
                                            </div>
                                            <div id="Change-Password" class="tab-pane fade">
                                                 <br>
                                                   <?php get_message();?>
                                                   <form action="<?php  echo  generateMemberForm("account","myprofile"); ?>" enctype="multipart/form-data" method="post" class="needs-validation">
                               

                                    <div class="crm-p-image ">
                                        <label for="">Current Password:</label>
                                        <input class="form-control" name="old_password" id="old_password" placeholder="Current Password" minlength="6" maxlength="16" type="password" required>
                     
                                    </div>

                                    <div class="crm-p-image ">
                                        <label for="">New Password:</label>
                                        <input class="form-control" name="user_password" id="user_password"  placeholder="New Password" minlength="6" maxlength="16" type="password" required>
                        
                                    </div>
                                    <div class="crm-p-image ">
                                        <label for="">Verify Password:</label>
                                        <input class="form-control" name="confirm_user_password" id="confirm_user_password"  placeholder="Confirm Password" minlength="6" maxlength="16" type="password" required>
                        
                                    </div>

                                    <div class="crm-p-image ">
                                          <input type="hidden" name="submitMemberSavePassword" value="1" />
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    </div>

                               
                                </form>
               
                                            </div>
                                            <div id="profile-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                       <br>
                                                         <?php get_message();?>
                                                        <form action="<?php  echo  generateMemberForm("account","banking"); ?>" enctype="multipart/form-data" method="post" class="needs-validation">
                   
                                    
                                     <div class=" row align-items-center">
                                    <div class="col-md-6">
                                       <label for="fname">Holder Name:</label>
                                        <input class="form-control" name="bank_acct_holder" required value="<?php echo $ROW['bank_acct_holder'];?>" id="accountName" type="text" placeholder="  Holder Name"  <?php echo ($ROW['bank_acct_holder']!='')?'readonly':'';?>>
  
                                    </div>
                                    <div class="col-md-6">
                                       <label for="lname">Bank Name:</label>
                                     <input class="form-control" name="bank_name" required value="<?php echo $ROW['bank_name'];?>" id="bankName" type="text" placeholder="Bank Name" <?php echo ($ROW['bank_name']!='')?'readonly':'';?>>
                              </div>
                                    <div class="col-md-6">
                                       <label for="uname">Account No:</label>
                                       <input class="form-control" name="account_number" required value="<?php echo $ROW['account_number'];?>" id="accountNo" placeholder="Account No." type="text" <?php echo ($ROW['account_number']!='')?'readonly':'';?>>
                           
                              
                                    </div>
                                    <div class="col-md-6">
                                       <label for="uname"> SWIFT/IFSC Code:</label>
                                          <input class="form-control" name="ifc_code" required id="ifscCode" value="<?php echo $ROW['ifc_code'];?>" placeholder="SWIFT/IFSC Code" type="text" <?php echo ($ROW['ifc_code']!='')?'readonly':'';?>>
             
                                    </div>
                                  
                                    <div class="col-md-6">
                                       <label for="uname"> Branch Name:</label>
                                         <input class="form-control" name="branch" required value="<?php echo $ROW['branch'];?>" id="branchName" placeholder="Branch Name" type="text" <?php echo ($ROW['branch']!='')?'readonly':'';?>>
                         
                                    </div>
                                     <div class="col-md-6">
                                       <label for="uname">Pan Card No:</label>
                                       <div id="message" class="message"></div>
                                    <input style="text-transform:uppercase" required class="form-control" name="pan_no" id="PanNum" minlength="10" maxlength="10" onKeyUp="checkPanFormat()"  value="<?php echo $ROW['pan_no'];?>" placeholder="Pan Card No" type="text" <?php echo ($ROW['pan_no']!='')?'readonly':'';?>>
                   
                                   
                   
                                </div>
                                   
                                    <div class="col-md-6">
                                       <label for="uname">Aadhaar No:</label>
                                        <input minlength="12" maxlength="12" required class="form-control" name="adhar" id="adhar" value="<?php echo $ROW['adhar'];?>" onKeyPress="return isNumber(event)" placeholder="Aadhaar Number" type="number" <?php echo ($ROW['adhar']!='')?'readonly':'';?>>
                 
                                    </div>
                                    
                                       <div class="col-md-6">
                                       <label for="uname"> UPI//VPA ID :</label>
                                        <input style="text-transform:uppercase" required type="text" value="<?php echo $ROW['phonepay'];?>"  class="form-control"   name="phonepay" <?php echo ($ROW['phonepay']!='')?'readonly':'';?> >
       
                                    </div>
                                   
                                 </div>
                                    <input type="hidden" name="submitMemberSave2" value="1" />
                                
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                 
                                    
                                    
                                
                   </form>
                   
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="kyc-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                <br>
                                                  <?php get_message();?>
                                                   <form action="<?php  echo  generateMemberForm("account","updatekyc"); ?>" enctype="multipart/form-data" method="post"   >
                        
                        <div class="col-md-6">
                            
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
                            
                            
                        </div>
                
                    <div class="col-md-6">
                        
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
                    
                    
                        
                        </div>
                       
                      <div class="col-md-6">
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
                         
                    
                          
                        </div>  
              <div class="col-md-6">
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
                     
                     
                        <div style="display:none;" >
                         <p>Nominee Kyc:</p>
                         <?php if($AR_ADD4['kyc_id']==""){ 
                                            echo "<div class='alert text-white bg-info' style='margin-top: 23px;'>  Upload Again <i class='fa fa-upload' aria-hidden='true' style='margin-top: 3px;margin-left: 10px;'></i></div>"; 
                                        }elseif($AR_ADD4['kyc_id']>0 && $AR_ADD4['approved_sts']>0){
                                            echo "<div class='alert text-white bg-success' style='margin-top: 23px;'> Verified <i class='fa fa-check-circle' aria-hidden='true'></i></div>"; 
                                        }elseif($AR_ADD4['kyc_id']>0 && $AR_ADD4['approved_sts']==0){
                                            echo "<div class='alert text-white bg-warning' style='margin-top: 23px;'>  Pending <i class='fa fa-clock-o' aria-hidden='true ' style='margin-top: 5px;margin-left: 6px;'></i> </div>"; 
                                        }elseif($AR_ADD4['kyc_id']>0 && $AR_ADD4['approved_sts']<0){
                                            echo "<div class='alert text-white bg-danger' style='margin-top: 23px;'>Rejected <i class='fa fa-times-circle'></i></div>"; 
                                        }
                                     ?> 
                        <div class="custom-file mb-3" >
                                <?php if($AR_ADD4['kyc_id']==""){ ?>
                           <input class="" name="internationid" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="internationid"    type="file">
                            <?php }elseif($AR_ADD4['kyc_id']>0 && $AR_ADD4['approved_sts']>0){ ?> 
                                <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src4;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                <?php }elseif($AR_ADD4['kyc_id']>0 && $AR_ADD4['approved_sts']==0){ ?>
                                    <p class="mr-2" style="margin: :100px;margin-top: -14px;"><a href="<?php echo $add_document_src4;?>" target="_blank">View File <i class="fa fa-eye"></i> </a> </p>
                                    <?php   }elseif($AR_ADD4['kyc_id']>0 && $AR_ADD4['approved_sts']<0){ ?>
                                    
                                      <input class="form-control" name="internationid" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="internationid"    type="file">
                                      <label class="form-control"   for="customFile">Choose file</label>
                           
                                        <?php } ?>
                         
                        </div>
                        </div>
                          <?php if(($AR_ID['approved_sts'] =='1') &&( $AR_ADD['approved_sts'] =='1')  &&( $AR_ADD1['approved_sts'] =='1') &&( $AR_ADD3['approved_sts'] =='1')   ){ }else{ ?>
          
             <div class="clearfix ">
            <div class="col-md-offset-3" >
               <input type="hidden" name="submitkycupadation" value="1" />  
               <br>
               <button  class="btn btn-primary" type="submit">
                                    <i class="icon-plus4"></i> Update 
                                </button>
           
            
            </div>
            </div>
          
        
            <?php } ?> 
                    
                        </form>                   
                 
                                                </div>
                                            </div>
                                              <div id="crypto-settings" class="tab-pane fade">
                                                <div class="pt-3">
                                                    <div class="settings-form">
                                                       <br>
                                                         <?php get_message();?>
                                                      <form action="<?php  echo  generateMemberForm("account","crypto"); ?>" enctype="multipart/form-data" method="post" class="needs-validation">

                                   <?php if(true){ ?>
                                    <div class="crm-p-image ">
                                        <label for="">USDT (BEP20) Withdrawal Wallet Address:</label>
                                        <input class="form-control" name="trx_address"  id="trx_address" placeholder="USDT (BEP20) Address" type="text"  value="<?php echo $ROW['trx_address'];?>" <?php echo ($ROW['trx_address']!='')?'readonly':'';?>>
                   
                                    </div>
                                    
                                    <?php } ?>
                                     <?php if(false){ ?>
                            <div class="crm-p-image ">
                                        <label for="">USDT (BEP20) Deposit Wallet Address:</label>
                                        <input class="form-control" name="ownaddress" required id="ownaddress" placeholder="USDT (BEP20) Address" type="text" required value="<?php echo $ROW['ownaddress'];?>" <?php echo ($ROW['ownaddress']!='')?'readonly':'';?>>
                   
                                    </div>
                                      <?php } ?>
                                    <code style="color:red; display:none">
                                        Note: These wallets should be registered to make deposit (add fund) and withdrawal 
automatically from and to your id. This is only for BEP-20 blockchain. So, make sure this is correct 
otherwise we’ll not responsible for any wrong transaction
                                    </code>
                                    <div class="crm-p-image ">
                                       <input type="hidden" name="submitMemberSaveCrypto" value="1" />
                                 <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    </div>

                                
                                   </form>
                   
                                                    </div>
                                                </div>
                                            </div>
											
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<!-- Modal -->
							<div class="modal fade" id="replyModal">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Post Reply</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
										</div>
										<div class="modal-body">
											<form>
												<textarea class="form-control" rows="4">Message</textarea>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
											<button type="button" class="btn btn-primary">Reply</button>
										</div>
									</div>
								</div>
							</div>
						</div>
                   
                    </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

  <script>
    function checkPanFormat()
    {
        const panNum = document.getElementById("PanNum");
        const panNumVal = panNum.value;
        const panPattern = new RegExp(/^[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}$/);
        if(panPattern.test(panNumVal)){
          panNum.style.color = 'green';
          message.style.color = 'green';
          document.getElementById('message').innerHTML = ('Your Pan is Valid Now');
         
        }else {
          panNum.style.color = 'red';
          message.style.color = 'red';
                   
         
            if (panNumVal.length === 10) {
                document.getElementById('message').innerHTML = ('Invalid PAN card number. Please enter a valid PAN card number.');
            panNum.value = '';
            }
        }
    }
</script> 
<?php

   $this->load->view(MEMBER_FOLDER.'/layout/footer'); 


?>


