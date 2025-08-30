<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
		$LDGR1 = $model->getCurrentBalance($member_id,1,"","");
	$LDGR2 = $model->getCurrentBalance($member_id,2,"","");

// Broadband
// DATACARD
// DTH
// ELC
// GAS
// Insurance
// Landline
// Money Transfer
// PAN
// Postpaid
// Prepaid
// Water


$getCircleCode = $model->getCircleCode();
$Prepaid = $model->getOperatorCode('Prepaid');
$Postpaid = $model->getOperatorCode('Postpaid');
$DTH = $model->getOperatorCode('DTH');
$ELC = $model->getOperatorCode('ELC');
$GAS = $model->getOperatorCode('GAS');
$Landline = $model->getOperatorCode('Landline');
	 
?>
	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead' ); ?>
    <?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    
    
 <div class="content-page rtl-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12 col-lg-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Recharge now your Prepaid / Postpaid Number</h4>
                     </div>
                     
                  </div>
                  
                  <div class="card-body">
                      
                     <p> Available Income-wallet: $ <?php echo number_format($LDGR1['net_balance'],2); ?> 	<code> ( INR : <?php echo number_format($LDGR1['net_balance']*75); ?>) </code>
				
							 </p>
                     <ul class="nav nav-tabs" id="myTab-1" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">PREPAID</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">POSTPAID</a>
                        </li>
                      
                     </ul>
                     <div class="tab-content" id="myTabContent-2">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                          
                          <form  style="    padding: 10px 5px 5px 2px;"  method="post" accept-charset="utf-8" class="form-horizontal tab-pane active" role="tabpanel" id="Prepaid">		
	    	<div class="form-body">
	                    		 
		
	 	
	
 		<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2"> Enter Prepaid Mobile Number </label>
									<div class="col-md-9">
	                     <input type="text" class="form-control text18 text-black" minlength="10" maxlength="10"  onKeyPress="return isNumberKey(event);" name="number" placeholder="10 Digit Number" id="prepaid" required="">
	                            	</div>
		                        </div>
		  
		<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2"> Select Operator</label>
									<div class="col-md-9">
	             
<select class="form-control text18 text-black" name="operator" id="operator" required="">
			                    <option value="" selected="">Select Operator</option>
			                      
 
<?php foreach($Prepaid as $res){ ?> <option value="<?php echo $res['operator_id'];?>"  ><?php echo $res['operator_name'];?></option> <?php } ?>
			                     
			                    			                  </select>
	                            	</div>
		                        </div>	
						
	 			 
						
		<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Select Circle</label>
									<div class="col-md-9">
	                   
					
					<select class="form-control text18 text-black" name="circle" id="circle" required="">
			                    <option value="" selected="">Select Circle</option>
<?php foreach($getCircleCode as $res){ ?> <option value="<?php echo $res['circle_code'];?>"  ><?php echo $res['circle_name'];?></option> <?php } ?>
			                     
			                    			                  </select>
	                            	</div>
		                        </div>				 
		<div class="form-group row">
	                            	<label class="col-md-3 label-control" for="projectinput2">Enter Recharge Amount</label>
									<div class="col-md-9">
	               <input class="form-control text18 text-black" id="amount1"  onkeyup="setreward('amount1','redeem_p','userwd_p','btn_p')" maxlength="4"  onKeyPress="return isNumberKey(event);" name="amount" required="">
	                            	</div>
		                        </div>	
		                        
		     <!--                   	  <div class="form-group" style="display:block">-->
							<!--<label class="col-md-4 control-label" for="name">&nbsp;</label>-->
							<!--<div class="col-md-4">-->
							<!--  <input class="form-control input-sm" id="promo" name="promo" placeholder="Have you a promocode?"><br>-->
							<!--<span class="text-danger" id="rply"></span>							</div>-->
							<!--<div class="col-md-4">-->
							<!--<br class="hidden-lg hidden-md">-->
							<!--<span class="btn btn-info btn-sm" onClick="checkpromo()"><i class="fa fa-toggle-off"></i> Apply</span>							</div>-->
						 <!-- </div>-->
  <!--<div class="form-group row">-->
		<!--					<label class="col-md-4 control-label" for="name">Redeem AIG TOKEN  (2%)</label>-->
		<!--					<div class="col-md-4">-->
		<!--					  <input type="checkbox" id="redeem_p"  onclick="setreward('amount1','redeem_p','userwd_p','btn_p')"   name="redeem">   Reward Point Use: <span id="userwd_p" >0</span>-->
		<!--					</div>-->
						 
						   
	
		<!--				  </div>-->
		<!--<div class="form-group row">-->
    
	 <!--                           	<label class="col-md-3 label-control" for="projectinput2">Login Password:</label>-->
		<!--							<div class="col-md-9">-->
	 <!--            <input class="form-control" name="trns_password" id="" type="password" placeholder="Login Password" required>-->
	 <!--                           	</div>-->
		<!--                        </div>-->
		
		
		
		
		
		
		 
		
		
			</div>
		 
		
		<div class="form-actions">
		
	 <input type="hidden" name="type" value="Prepaid">
		
	                            <button type="reset" class="btn btn-warning mr-1">
	                            	<i class="ft-reset"></i> Reset
	                            </button>
	                            <button type="submit" name="buttonRequest" class="btn btn-primary">
	                              	<i class="ace-icon fa fa-cloud-upload icon-on-right"></i>Recharge Now <span id="btn_p"></span>
	                            </button>
	                        </div>
		</form>	  
                                   
                          
                             </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                         <form   style="    padding: 10px 5px 5px 2px;"   action="#" method="post" accept-charset="utf-8"   id="postpaid">	
										  
										  
						<div class="form-group row">
							<label class="col-md-4 control-label" for="name">Enter Postpaid Mobile Number</label>
							<div class="col-md-8">
							  <input class="form-control text18 text-black"  onKeyPress="return isNumberKey(event);" name="number" onchange="setreward(this.value,'redeem_p','userwd_p','btn_p')" maxlength="10" minlength="10" placeholder="10 Digit Number" id="postpaid" type="text">
							</div>
						  </div>
						  <div class="form-group  row">
							<label class="col-md-4 control-label" for="name">Select Operator</label>
							<div class="col-md-8">
							  <select name="operator" id="operator" class="form-control text18 text-black">
			                    <option value="" selected="">Select Operator</option>
			                     
			                     
 
<?php foreach($Postpaid as $res){ ?> <option value="<?php echo $res['operator_id'];?>"  ><?php echo $res['operator_name'];?></option> <?php } ?>

			                     
			                    			                  </select>
							</div>
						  </div>
						  <div class="form-group  row">
							<label class="col-md-4 control-label" for="name">Select Circle</label>
							<div class="col-md-8">
							  <select class="form-control text18 text-black" name="circle" id="circle" required="">
			                    <option value="" selected="">Select Circle</option>
			                      
 
<?php foreach($getCircleCode as $res){ ?> <option value="<?php echo $res['circle_code'];?>"  ><?php echo $res['circle_name'];?></option> <?php } ?>
			                     
			                    			                  </select>
							</div>
						  </div>
						  <div class="form-group  row">
							<label class="col-md-4 control-label" for="name">Enter Recharge Amount</label>
							<div class="col-md-8">
							  <input type="text" class="form-control text18 text-black" name="amount" id="amount2" maxlength="4"  onKeyPress="return isNumberKey(event);" onkeyup="setreward('amount2','redeem_pd','userwd_pd','btn_pp')">
							</div>							
						  </div>
					
		                  
		     <!--              <div class="form-group row">-->
							<!--<label class="col-md-4 control-label" for="name">Redeem AIG TOKEN (2%)</label>-->
							<!--<div class="col-md-4">-->
							<!--  <input type="checkbox" id="redeem_pd"  onclick="setreward('amount2','redeem_pd','userwd_pd','btn_pp')"    name="redeem">  Reward Point Use:  <span id="userwd_pd" >0</span>-->
							<!--</div>-->
						 
							
						 <!-- </div>-->
						  
						  	  <div class="form-group  row">
		                    <input type="hidden" name="type" value="Postpaid">
		                  </div>
						  <div class="form-group">
							<div class="col-md-8 col-md-offset-4"style="margin-top:-25px;">
							  <button type="submit" class="btn btn-primary">Proceed To Recharge <span id="btn_pp"></span></button>
							</div>
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
		     
	 	<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
			 <script>
    function setreward(amt1,checkedbox,spanbox,btnid)
    {
     
  var amt = document.getElementById(amt1).value;    
  var checkBox = document.getElementById(checkedbox);
  var  per1 = amt *2/100;
  var rdp = '<?php  echo $LDGR2['net_balance'];?>';
  var per = 0;
  
  
  if(rdp > 0)
  {
      per = amt *2/100;  
      if(rdp < per)
      {
        per =   rdp;
      }
      
  } 
  
   var span1 = document.getElementById(spanbox); 
    var span2 = document.getElementById(btnid);        

  if (checkBox.checked == true){
  
   span1.textContent = per; 
     span2.textContent = 'Rs.'+(amt-per)+'/-'; 
 
  } else {   
 
     span1.textContent = per; 
     span2.textContent = 'Rs.'+amt+'/-'; 
     
  }
    }
 function isNumberKey(evt)
 { // Numbers only
					var charCode = (evt.which) ? evt.which : event.keyCode;
					if (charCode > 31 && (charCode < 48 || charCode > 57))
					return false;
					return true;
				}
</script>

