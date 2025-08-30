<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$model = new OperationModel();
$form_data = $this->input->post();
$segment = $this->uri->uri_to_assoc(2);
$binary_rate = $model->getValue("CONFIG_BINARY_INCOME");
$member_id = $this->session->userdata('mem_id');
$request_id = _d($segment['request_id']);
$AR_PRSS = $model->getProcess();
$process_id = $AR_PRSS['process_id'];


$LD_CSH = $model->getCurrentBalance($member_id,$model->getWallet(WALLET1),"","");

$rate_of_interest = $model->getSumDailyReturn($member_id,"","");

$total_withdrawal = $model->getMemberWithdrawal($member_id);
$left_collection = $model->BinaryCount($member_id,"LeftPoint");
$right_collection = $model->BinaryCount($member_id,"RightPoint");
$total_collection = $left_collection+$right_collection;



$AR_OLD = $model->getOldBinary($process_id,$member_id);		

$start_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['start_date']:"";
$end_date = ($AR_OLD['binary_id']>0)? $AR_PRSS['end_date']:"";

$preLcrf = $AR_OLD['leftCrf'];
$preRcrf = $AR_OLD['rightCrf'];
	
$newLft = $model->getMemberCollection($member_id,"L",$start_date,$end_date);
$newRgt = $model->getMemberCollection($member_id,"R",$start_date,$end_date);



$totalLft = $preLcrf+$newLft;
$totalRgt = $preRcrf+$newRgt;
$pair_match = min($totalLft,$totalRgt);


$last_week_cmsn = $model->getLastBinaryCmsn($member_id);
$current_cmsn = ($pair_match*$binary_rate/100);
$old_cmsn = $model->getTotalBinaryCmsn($member_id);


$direct_cmsn = $model->getTotalDirectCmsn($member_id);

$left_count = $model->BinaryCount($member_id,"LeftCount");
$right_count = $model->BinaryCount($member_id,"RightCount");
$total_count = ($left_count+$right_count);
$direct_count = $model->BinaryCount($member_id,"DirectCount");

$today_date = InsertDate(getLocalTime());
$AR_DATE = $model->getCycleNo();
$end_date = $AR_PRSS['end_date'];
$week_date = InsertDate(AddToDate($end_date,"+1 Week"));
$today_joining = $model->getMemberJoining($member_id,$today_date,$today_date);
$week_joining = $model->getMemberJoining($member_id,$today_date,$week_date);

$AR_SHIP = $model->getCurrentMemberShip($member_id);


$stock_market = get_web_page("https://bitpay.com/api/rates");
$AR_STOCK = json_decode($stock_market,true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<style type="text/css">
	span.title {
		display: block;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
		font-weight: 600;
		font-size: 12px;
		color: #fff;
		letter-spacing: 12px;
		padding-left: 10px;
	}
</style>
<link href="<?php echo BASE_PATH;?>memassets/css/kyc.css" rel="stylesheet" type="text/css">


</head>
<body>
<div class="site-holder">
  <!-- .navbar -->
  <?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
  <!-- /.navbar -->
  <div class="box-holder">
    <!-- .left-sidebar -->
    <?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    <!-- /.left-sidebar -->
    <!-- .content -->
    <div class="content">
      <div class="row">
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>">Home</a></li>
            <li class="active">DashBoard</li>
          </ul>
        </div>
      </div>
     
	  <div class="row">
	  <div class="panel-body">

                <div class="callout callout-warning">
                    <h4>Dear Customer, Please submit your KYC.</h4>
                </div>

    <div class="kyc-documentation">

        <div id="photographbox">
            <h3 class="kyc-heading">Upload Your <span class="text-warning">PhotoGraph</span></h3>
            <div class="kyc-icon">
                <img src="<?php echo BASE_PATH;?>memassets/images/kyc-user-cion.png"class="img-kyc" />
            </div>
            <div class="kycstrip clearfix">
                <div class="alertmassagebox">
                    <div class="row">
                        <div class="col-md-12">
                                                    </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="imgarea">
                    <?php     if ($ROW['photo'] !='') {?>
				 	<img id="blah" src="<?php echo BASE_PATH;?>upload/member/<?php echo $ROW['photo'];?>" alt="your image" style="width:118px;height:134px;padding:13px;"/>	
 <?php }else{?>
    
<img id="blah" src="<?php echo BASE_PATH;?>memassets/images/mal.jpg" alt="your image" style="width:118px;height:134px;padding:13px;"/>
 <h2>Image Not Uploaded</h2>
<?php 
 }?>
                       <!-- <img src="<?php echo BASE_PATH;?>memassets/images/uploadkyc.png" id="ImgPrevForPhoto" />-->
                       
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row">

                        <div class="col-md-5">

                          
 <form action="<?php  echo  generateMemberForm("account","kyc"); ?>" id="changeUserInfoForm" name="changeUserInfoForm" enctype="multipart/form-data" method="post" class="hor" accept-charset="utf-8">
                                
                                    <div class="form-group buttongroup">
                                        <div class="upload-btn btn btn-success">
                                            <span>Choose File</span>
                                            <input type="file" value="Update" accept="image/*" name="avatar_name" data-type='image'onchange="readURL(this);" >
                                        </div>
                                        	<input type="hidden" name="updateImage" value="1" />
                      <input name="" value="Update" class="btn btn-warning" type="submit" value="Update">
                                     
                                    </div>
                            </form>
                        </div>
                        <div class="col-md-7 description-cls-sty">
                            <h3>Guidelines for Photograph Upload</h3>
                            <ul>
                                <li>Image size should 200px width & 200px height for better view.</li>
                                <li>Uploaded image should be clearly visible.</li>
                                <li>Blur Image Can't be Accepted</li>
                                <li>Background of every image must be Black/white</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="identitycard-box">
            <h3 class="kyc-heading">Upload Your <span class="text-success">Identity Card</span></h3>
            <div class="kyc-icon">
                <img src="<?php echo BASE_PATH;?>memassets/images/kyc-id-icon.png"style="max-width: 50%;" class="img-kyc" />
            </div>
            <div class="kycstrip clearfix">

                <div class="alertmassagebox">
                    <div class="row">
                        <div class="col-md-12">
                                                    </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="imgarea">
                                           <?php     if ($ROW['id_file'] !='') {?>
				 	<img id="readURLId" src="<?php echo BASE_PATH;?>upload/member_id/<?php echo $ROW['id_file'];?>" alt="your image" style="width:118px;height:134px;padding:13px;"/>	
 <?php }else{?>
    
  <img src="<?php echo BASE_PATH;?>memassets/images/uploadkyc.png" id="readURLId" class="img-kyc" />
 <h2>Image Not Uploaded</h2>
<?php 
 }?>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-5">
<form action="<?php  echo  generateMemberForm("account","kyc"); ?>" id="changeUserInfoForm" name="changeUserInfoForm" enctype="multipart/form-data" method="post" class="hor" accept-charset="utf-8">
                         
                                <div class="form-group">
                                    <label>ID Proof Type<span class="required">*</span></label>
                                    <select id="ddlIdtype" class="form-control" name="type" required>
                                        <option value="">--Select One--</option>
                                        <option value="Voter ID" <?php if($ROW['id_type']=='Voter ID'){echo "selected";}?>>Voter ID card</option>
                                        <option value="Smart Card" <?php if($ROW['id_type']=='Smart Card'){echo "selected";}?>>Smart Card</option>
                                        <option value="Passport" <?php if($ROW['id_type']=='Passport'){echo "selected";}?>>Passport</option>
                                        <option value="PAN Card" <?php if($ROW['id_type']=='PAN Card'){echo "selected";}?>>PAN Card</option>
                                        <option value="Drivery Licence" <?php if($ROW['id_type']=='Drivery Licence'){echo "selected";}?>>Driving Licence</option>
                                        <option value="Adhar Card" <?php if($ROW['id_type']=='Adhar Card'){echo "selected";}?>>Aadhar Card</option>
                                    </select>
                                    <input type="hidden" value="" id="HfIdType" />
                                </div>

                                <div class="form-group">
                                    <label>ID Proof No.<span class="required">*</span></label>
                                    <input type="text" id="txtidcardno" class="form-control" value="<?php echo $ROW['id_no'];?>"name="id_no">
                                </div>

                                    <div class="form-group buttongroup">
                                        <div class="upload-btn btn btn-success">
                                            <span>Choose File</span>
                                            <input type="file" name="id_file"value="Update" accept="image/*" data-type='image' onchange="readURLId(this);"  />
                                        </div>
                                      	<input type="hidden" name="updateid" value="1" />
                      <input name="" value="Update" class="btn btn-warning" type="submit" value="Update">
                                    </div>
                            </form>
                        </div>
                        <div class="col-md-7 description-cls-sty">
                            <h3>Guidelines for Identity Card Upload</h3>
                            <ul>
                                <li>Image size should 200px width & 200px height for better view.</li>
                                <li>Uploaded image should be clearly visible.</li>
                                <li>Blur Image Can't be Accepted</li>
                                <li>Identification number of your Identity card must be clearly visible.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="pancard-box">
            <h3 class="kyc-heading">Upload Your <span class="text-green">PAN Card</span></h3>
            <div class="kyc-icon">
                <img src="<?php echo BASE_PATH;?>memassets/images/kyc-pan-icon.png"class="img-kyc" />
            </div>
            <div class="kycstrip clearfix">

                <div class="alertmassagebox">
                    <div class="row">
                        <div class="col-md-12">

                                                    </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="imgarea">
                        <?php     if ($ROW['pan_file'] !='') {?>
				 	<img id="readURLpan" src="<?php echo BASE_PATH;?>upload/member_id/<?php echo $ROW['pan_file'];?>" alt="your image" style="width:118px;height:134px;padding:13px;"/>	
 <?php }else{?>
    
  <img src="<?php echo BASE_PATH;?>memassets/images/uploadkyc.png" id="readURLpan" class="img-kyc" />
 <h2>Image Not Uploaded</h2>
<?php 
 }?>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-5">

<form action="<?php  echo  generateMemberForm("account","kyc"); ?>" id="changeUserInfoForm" name="changeUserInfoForm" enctype="multipart/form-data" method="post" class="hor" accept-charset="utf-8">


                                <div class="form-group">
                                    <label>Pan Card No.<span class="required">*</span></label>
                                    <input type="text" id="txt_pancard" name="pan_no" class="form-control" value="<?php echo $ROW['pan_no'];?>"required />
                                </div>
                                <div class="form-group">
                                    <label>Select D.O.B<span class="required">*</span></label>
                                    <input type="date" id="txtdob"name="pan_dob" class="form-control" value="<?php echo $ROW['pan_dob'];?>" onkeypress="return false;" required>
                                </div>
                                    <div class="form-group buttongroup">
                                        <div class="upload-btn btn btn-success">
                                            <span>Choose File</span>
             <input type="file" name="pan_file"value="Update" accept="image/*" data-type='image' onchange="readURLpan(this);" required />
                                        </div>
                                       	<input type="hidden" name="updatepan" value="1" />
                      <input name="" value="Update" class="btn btn-warning" type="submit" value="Update">
                                    </div>
                            </form>
                        </div>
                        <div class="col-md-7 description-cls-sty">
                            <h3>Guidelines for PAN Card Upload</h3>
                            <ul>
                                <li>Image size should 200px width & 200px height for better view.</li>
                                <li>Uploaded image should be clearly visible.</li>
                                <li>Blur Image Can't be Accepted</li>
                                <li>PAN card number must be clearly visible.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="addressproof-box">
            <h3 class="kyc-heading">Upload Your <span class="text-aqua">Cheque/Passbook</span></h3>
            <div class="kyc-icon">
                <img src="<?php echo BASE_PATH;?>memassets/images/kyc-passbook-cion.png" class="img-kyc" />
            </div>
            <div class="kycstrip clearfix">

                <div class="alertmassagebox">
                    <div class="row">
                        <div class="col-md-12">
                                                    </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="imgarea">
<?php     if ($ROW['bank_file'] !='') {?>
				 	<img id="readURLbank" src="<?php echo BASE_PATH;?>upload/member_id/<?php echo $ROW['bank_file'];?>" alt="your image" style="width:118px;height:134px;padding:13px;"/>	
 <?php }else{?>
    
  <img src="<?php echo BASE_PATH;?>memassets/images/uploadkyc.png" id="readURLbank" class="img-kyc" />
 <h2>Image Not Uploaded</h2>
<?php 
 }?>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
<form action="<?php  echo  generateMemberForm("account","kyc"); ?>" id="changeUserInfoForm" name="changeUserInfoForm" enctype="multipart/form-data" method="post" class="hor" accept-charset="utf-8">
                                <div class="row">
                               <div class="col-sm-6"> <div class="form-group">
                                    <label>Account Holder Name<span class="required">*</span></label>
                                    <input type="text" id="txt_holdername" name="bank_acct_holder" value="<?php echo $ROW['bank_acct_holder'];?>" required class="lettersOnly form-control" />
                                </div> </div>

                              <div class="col-sm-6">   <div class="form-group">
                                    <label>Account No. <span class="required">*</span></label>
                                    <input type="text" id="txt_acountno"name="account_number" value="<?php echo $ROW['account_number'];?>" class="cssOnlyNumeric form-control" maxlength="30" />
                                </div> </div>

                               <div class="col-sm-6">  <div class="form-group">
                                    <label>IFSC Code <span class="required">*</span></label>
                                    <input type="text" id="txt_ifsccode"name="ifc_code" value="<?php echo $ROW['ifc_code'];?>" class="cssOnlyForName form-control"required />
                                   <!-- <a class="check" id="checkIfsc" style="cursor: pointer;">Verify IFSC code</a>-->
                                </div> </div>

                               <div class="col-sm-6">  <div class="form-group">
                                    <label>Bank Name <span class="required">*</span></label>
                                    <input type="text" id="txt_bankname" maxlength="15"  required name="bank_name" value="<?php echo $ROW['bank_name'];?>" class="addressvarification form-control" />
                                </div> </div>
                            <div class="col-sm-6">    <div class="form-group">
                                    <label>Branch Name <span class="required">*</span></label>
                                    <input type="text" id="txt_branchname" name="branch" value="<?php echo $ROW['branch'];?>" class="addressvarification form-control"required />
                                </div> </div>
                             <div class="col-sm-6">     <div class="form-group buttongroup">
                                 <label>&nbsp;</label>
                                        <div class="upload-btn btn btn-success">
                                            <span>Choose File</span>
                                            <input type="file" value="Update" accept="image/*" name="bank_file" data-type='image' onchange="readURLbank(this);" required />
                                        </div>
                                                          
                                                    	<input type="hidden" name="updatebank" value="1" />       
                                                          
                                                            <input name="" value="Update" class="btn btn-warning" type="submit" value="Update">
        
  
                                        </div>
                                      
                    
                      
                      
                      
                                </div> </div>
                           </div>
                                     </form>
                        </div>
                        <div class="col-md-7 description-cls-sty">
                            <h3>Guidelines for Cheque/Passbook Upload</h3>

                            <ul>
                                <li>Image size should 200px width & 200px height for better view.</li>
                                <li>Uploaded image should be clearly visible.</li>
                                <li>Blur Image Can't be Accepted</li>
                                <li>Cheque number must be clearly visible.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


	  
	  
	  </div>
	  
	  
	  
	  
	  
		
		
		
		
		
		
      
      
      <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
      <!-- /.content -->
    </div>
  
  </div>
</div>

</body>
<script src="<?php echo BASE_PATH; ?>graph/jquery.flot.js"></script>
<script src="<?php echo BASE_PATH; ?>graph/jquery.flot.init.js"></script>
	 
<script>
		
		     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        
         function readURLId(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#readURLId')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function readURLpan(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#readURLpan')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
         function readURLbank(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#readURLbank')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
		
		
		
		
		
		</script>
<script type="text/javascript">
	$(function(){
		<?php if($request_id>0){ ?>
			$('#verifyOTP').modal({
				backdrop: 'static',
				keyboard: false
			});
		<?php } ?>
		
		$("#backTrPassForm").validationEngine();
		$("#otpForm").validationEngine();
		
		$("#sendSmsCode").on('click',function(){
			var URL_CODE = "<?php echo generateSeoUrl("json","jsonhandler",""); ?>";
			var mobile_code = $("#mobile_code").val();
			var member_mobile = $("#member_mobile").val();
			var data = {
				switch_type : "SEND_SMS_CODE",
				mobile_code : mobile_code,
				member_mobile : member_mobile,
			};
			$.getJSON(URL_CODE,data,function(JsonEval){
				if(JsonEval){
					switch(JsonEval.ErrorMsg){
						case "SUCCESS":
							$(".ajaxMessage").html('<div class="alert alert-success">Please check your mobile or email address</div>');
						break;
						default:
							$(".ajaxMessage").html('<div class="alert alert-warning">Unable to send message , please try after again</div>');
						break;
					}
				}
			});
		});
	});
</script>

</html>
