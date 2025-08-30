<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$CONFIG_WEBSITE = $model->getValue("CONFIG_WEBSITE");
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
<script type="text/javascript">
	function copyToClipboard(text) {
  			window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
		}
</script>
</head>
<body>
<div class="site-holder">
  <!-- .navbar -->
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
  <!-- /.navbar -->
  <div class="box-holder">
    <!-- .left-sidebar -->
    <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    <!-- /.left-sidebar -->
    <!-- .content -->
    <div class="content">
      <input name="username" value="LADDU" type="hidden">
      <input id="c_id" value="10781846" type="hidden">
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>">Home</a></li>
            <li class="active">Profile</li>
          </ul>
          <h3 class="page-header"><i class="fa fa-user"></i> Profile and Settings</h3>
        </div>
      </div>
      
	  
	  <div class="row hidden"> </div>
     
	 
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
		
		
		
		
		
		</script>
		  

	 

	 <div class="row"  style="
    background: #eee;
">
	 <div class="col-md-2"></div>
	 
        <div class="col-md-8 inner">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-adjust"></i> Change user info </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="row userInfoForm">
                <div class="col-md-12">
                     <?php echo get_message(); ?>
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" id="changeUserInfoForm" name="changeUserInfoForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
				  
				  <div class="form-group">
				      
				      <?php 
				      
				// $path =BASE_PATH.'upload/member/'.$ROW['photo'];
                 $path = $_SERVER['DOCUMENT_ROOT'] . 'upload/member/'.$ROW['photo'];

				   
				      if ($ROW['photo'] !='') {?>
				 	<img id="blah" src="<?php echo BASE_PATH;?>upload/member/<?php echo $ROW['photo'];?>" alt="your image" style="width:118px;height:134px;padding:13px;"/>	
 <?php }else{?>
    
<img id="blah" src="<?php echo BASE_PATH;?>memassets/images/mal.jpg" alt="your image" style="width:118px;height:134px;padding:13px;"/>
<?php 
 }?>
                      <!--<img id="blah" src="<?php echo BASE_PATH;?>memassets/images/mal.jpg" alt="your image" style="width:118px;height:134px;padding:13px;"/>-->		

	
			<input type='file'name="avatar_name" onchange="readURL(this);" />		
                    </div>
					
					
				    <div class="row">
				    <div class="col-md-6">
					
				  
                    <div class="form-group">
                      <label for="first_name">Distributor Name</label>
                      
                      <input name="first_name" value="<?php echo $ROW['first_name'] ?>" class="form-control validate[required]"readonly type="text">
                    </div>
                   </div>
                   
                   <div class="col-md-6">
					
				  
                    <div class="form-group">
                      <label for="father_name">Father`s Name</label>
                      
                      <input name="father_name" value="<?php echo $ROW['father_name'] ?>" class="form-control validate[required]" type="text">
                    </div>
                   </div>
                   

				  
					</div>
					
					<?php // echo $ROW['gender'];die;
					if($ROW['gender']=='M')
					{ 
					$m='selected="selected"';$s='';$f='';$c='';
					}
					elseif($ROW['gender']=='F')
					{
					$f='selected="selected"';$m='';$s='';$c='';
					}
					elseif($ROW['gender']=='C')
					{
					$c='selected="selected"';$m='';$f='';$s='';
					}
					else {
					    
					$s='selected="selected"';$m='';$f='';$c='';
					} 
					?>
				    <div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6">
			    					 <div class="form-group">
									 <label class="text-left" id="Side">Gender</label>
                                      
                                         <select id="ddlsideofmember" name="gender" class="form-control input-log-cls">
                                                  <option value="" <?php echo $s;?>>--Gender--</option>
                                                  <option value="M"<?php echo $m;?>>Male</option>
                                                  <option value="F"<?php echo $f;?>>Female</option> 
												  <option value="C"<?php echo $c;?>>Other</option>
                                    </select>

			    					</div>
			    				
	
	
			    				</div>	
                   
                <div class="col-xs-12 col-sm-12 col-md-6">
			    					  <div class="form-group">
                      <label for="dateOfBirth">Date of birth</label>
                      
                      <input name="date_of_birth" max="1999-12-31" value="<?php echo $ROW['date_of_birth']; ?>" class="form-control" type="date">
                    </div>
			    				
	
	
			    				</div>
				  
					</div>
					
					<div class="row">
				  			

					<div class="col-md-6">
					
					 <div class="form-group">
                      <label for="mobile">Mobile phone</label>
                      
                      <input name="member_mobile" id="member_mobile" value="<?php echo $ROW['member_mobile']; ?>" class="form-control" type="text" readonly>
                    </div>
					
					
					</div>

				  <div class="col-md-6">
					<div class="form-group">
                      <label for="member_email">Email</label>
                     
                      <input name="member_email" id="member_email" value="<?php echo $ROW['member_email']; ?>"  class="form-control" type="email" <?php if(!empty($ROW['member_email'])){echo "readonly";}?>>
                    </div>
					 </div>
					  
		
					
					
					</div>
					
					<div class="form-group">
                      <label for="current_address">Address</label>
                      
                      <input name="current_address" id="current_address" value="<?php echo $ROW['current_address']; ?>" class="form-control" type="text">
                    </div>
                    
					<div class="row">
				  

				 
				  <div class="col-md-6">
					<div class="form-group">
                      <label for="pan_no">Pan No</label>
                      
                      <input name="pan_no" id="pan_no" value="<?php echo $ROW['pan_no']; ?>" class="form-control" type="text">
                    </div>
					</div>
				
					 
					  <div class="col-md-6">
					
					  <div class="form-group">
                      <label for="dateOfBirth">State </label>
                      
                      <input name="state_name" value="<?php echo $ROW['state_name'];?>" class="form-control" type="text">
                    </div>
					 
				  </div>
					 
					  </div>
					
					<div class="row">
				  

					
				  <div class="col-md-6">
                    <div class="form-group">
                      <label for="city">City</label>
                      
                      <input name="city_name" id="city_name" value="<?php echo $ROW['city_name']; ?>" class="form-control" type="text">
                    </div>
                        </div>
                        
                         <div class="col-md-6">
					<div class="form-group">
                      <label for="pin_code">ZIP Code</label>
                      
                      <input name="pin_code" id="pin_code" value="<?php echo $ROW['pin_code']; ?>" class="form-control" type="text">
                    </div>
					</div>
					
						    </div>
                
                   
                 <h3>Nominee Detail</h3>
					
				<div class="row">
				  

				
				  <div class="col-md-6">
					<div class="form-group">
                      <label for="zip">Nominee Name</label>
                      
                      <input name="nominal_name" id="nominal_name" value="<?php echo $ROW['nominal_name']; ?>" class="form-control" type="text">
                    </div>
					</div>
					 	<?php  if($ROW['nominal_relation']=='Father')
					{ 
					$f='selected="selected"';$s='';$m='';$d='';$son='';$sis='';$b='';$o='';
					}
					elseif($ROW['nominal_relation']=='Mother')
					{
					$m='selected="selected"';$s='';$f='';$d='';$son='';$sis='';$b='';$o='';
					}
					elseif($ROW['nominal_relation']=='Doughter')
					{
					$d='selected="selected"';$s='';$m='';$f='';$son='';$sis='';$b='';$o='';
					}
				    elseif($ROW['nominal_relation']=='Son')
					{
					$son='selected="selected"';$s='';$m='';$d='';$f='';$sis='';$b='';$o='';
					}
					elseif($ROW['nominal_relation']=='Sister')
					{
					$sis='selected="selected"';$s='';$m='';$d='';$son='';$f='';$b='';$o='';
					}
					elseif($ROW['nominal_relation']=='Brother')
					{
				    $b='selected="selected"';$s='';$m='';$d='';$son='';$sis='';$f='';$o='';
					}
					elseif($ROW['nominal_relation']=='Other')
					{
					$o='selected="selected"';$s='';$f='';$d='';$son='';$sis='';$b='';$f='';
					}
					else {
					    
					$s='selected="selected"';$f='';$m='';$d='';$son='';$sis='';$b='';$o='';
					} 
					?>
					  <div class="col-md-6">
					
					  <div class="form-group">
                      <label for="dateOfBirth">Relation </label>
                          <select id="nominal_relation" name="nominal_relation" class="form-control input-log-cls">
                                                  <option value="" <?php echo $s;?>>--Select Relation--</option>
                                                  <option value="Father"<?php echo $f;?>>Father</option>
                                                  <option value="Mother"<?php echo $m;?>>Mother</option> 
												  <option value="Doughter"<?php echo $d;?>>Doughter</option>
												  <option value="Son"<?php echo $son;?>>Son</option>
                                                  <option value="Sister"<?php echo $sis;?>>Sister</option> 
												  <option value="Brother"<?php echo $b;?>>Brother</option>
												  <option value="Other"<?php echo $o;?>>Other</option>
                                    </select>
                      
                    </div>
					 
				  </div>
					 
					  </div>
					  
			    <div class="row">
				  

					
				  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nominal_birth">Date of Birth </label>
                      
                      <input name="nominal_birth" id="nominal_birth" value="<?php echo $ROW['nominal_birth']; ?>" class="form-control" type="date">
                    </div>
                        </div>
                        
                        
				  <div class="col-md-6">
					<div class="form-group">
                      <label for="nominal_mobile">Mobile No</label>
                      
                      <input name="nominal_mobile" id="nominal_mobile" value="<?php echo $ROW['nominal_mobile']; ?>" class="form-control" type="text">
                    </div>
					</div>
					
						    </div>		
					
					
                    
					
                   
                  	  <div class="form-group">
					<input type="hidden" name="submitMemberSave" value="1" />
                      <input name="" value="Update" class="btn btn-primary saveUserInfo" type="submit">
                    </div>
                    <div class="user_info_message"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
       
	  <div class="col-md-2"></div>
	  </div>
      
	  
	 
   <!--<div class="row">
        <div class="col-md-6">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-user"></i> Support PIN </h3>
            </div>
            <div class="panel-body  panel-border">
              <div class="support_pin_message"><span class="error"></span><span class="success"></span></div>
              <div class="row supportPinForm">
                <div class="col-md-3">
                  <form action="<?php  echo  generateMemberForm("account","profile"); ?>" id="supportPinForm" method="post" accept-charset="utf-8">
                    <div class="form-group">
                      <label for="supportPinBtn">Generate Support PIN</label>
                      <input name="" value="Generate" class="btn btn-primary" id="supportPinBtn" type="submit">
                      </div>
                  </form>
                </div>
                <div class="col-md-3">
                  <h3><span id="supportPin"></span></h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>-->
      <div class="clearExtended">&nbsp;</div>
     
      <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
    </div>
  </div>
</div>
<div class="modal" id="load-personalized" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Send personalized invitation</h4>
      </div>
      <div class="modal-body">
        <div class="login-box">
          <div id="row">
            <div class="input-box frontForms">
              <div class="row">
			  <?php echo display_message(); ?>
                <div class="col-md-12 col-xs-12">
           			
                  <form action="<?php echo  generateMemberForm("account","profile",array("")); ?>" id="otpForm" name="otpForm" method="post">	
				  	
                    <div class="form-group">
                      <label for="transaction_password">Email Address:</label>
                      <input type="text" name="mail_email" id="mail_email" placeholder="Use comma for multiple email address" value="" class="form-control validate[required]"/>
                      <div class="clear">&nbsp;</div>
                    </div>
					<div class="form-group">
                      <label for="transaction_password">Text:</label>
                      <textarea name="email_body" class="form-control validate[required]" id="email_body" style="width:540px; height:200px;">Hi,<br /> i like to invite for free joining of <?php echo WEBSITE; ?>,<br /> you can register your-self with using my referral link: <br /> <?php echo BASE_PATH.$ROW['user_name'];  ?><br /><br /><br /><br /><br />Regards,<br /><?php echo $CONFIG_WEBSITE; ?></textarea>
                      <div class="clear">&nbsp;</div>
                    </div>
                    
                    <div class="form-group">
					<input type="hidden" name="email_subject" id="email_subject" value="<?php echo $ROW['first_name']." ".$ROW['first_name'];  ?> has invited to join <?php echo  $CONFIG_WEBSITE; ?>" />
                      <input type="submit" name="sendMessage" value="Send" class="btn btn-primary btn-submit" id="sendMessage"/>
					  &nbsp;&nbsp;
					  <input type="button" name="closeButton" value="Close" class="btn btn-danger btn-submit"  data-dismiss="modal" id="closeButton"/>
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
</div>
</body>
<script src="<?php echo BASE_PATH; ?>tiny/nicEdit.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	var jsUrlPath = "<?php echo BASE_PATH; ?>";
	
	$("#backPassForm").validationEngine();
	$("#backTrPassForm").validationEngine();
	$("#backChangeEmailForm").validationEngine();
	$("#changeUserInfoForm").validationEngine();
	$("#bankDetailsForm").validationEngine();
	$("#form_avatar").validationEngine();
	$("#send-personalized-invitation").on('click',function(){
		$("#load-personalized").modal('show');
	});
	
	
	bkLib.onDomLoaded(function() {
		new nicEditor({iconsPath : jsUrlPath+'tiny/nicEditorIcons.gif', maxHeight : 150}).panelInstance('email_body');
	});
	
	$("#resetTrPassword").on('click',function(){
		var confirm_message = confirm('Make sure you want to reset your transaction password?');
		if(confirm_message){
			var  URL_LOAD = "<?php echo BASE_PATH; ?>json/jsonhandler?switch_type=RESET_TRNS";
			$.getJSON(URL_LOAD,function(JsonEval){
				if(JsonEval.count_ctrl>0){
					$("#resetTrPassword").hide();
					$(".resetMsg").html('<div class="alert alert-success">Pasword reset, please check your mail</div>');
				}
			});
		}
	});
});
</script>
</html>
