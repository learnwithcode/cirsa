<?php 
        $a = $this->uri->segment(2);
        $b = $this->uri->segment(3); 
        $c = $this->uri->segment(4);
        $segment1 = $this->uri->uri_to_assoc(2);
        $left_right1 = (_d($segment1['left_right']))? _d($segment1['left_right']):_d($_GET['left_right']);
	
	
        // 	$this->session->unset_userdata('mem_id');
        // 	$this->session->unset_userdata('user_id');
        		 
        // 	set_message("success","You have successfully logout");
        // 	redirect(MEMBER_PATH);
		 
		 
	$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT * FROM tbl_members WHERE member_id='".$member_id."'";
		$memdata = $this->SqlModel->runQuery($QR_CHECK,true); 

		$model = new OperationModel();
   $Wallet_addressffff= $Wallet_address = '0x8C1D40C445510823308ef6dd208E06c541B0e74D';//$model->getMemberwallet_adress($member_id);
    $LDGR = $model->getCurrentBalance($member_id,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
	$LDGR2 = $model->getCurrentBalance($member_id,'2',$_REQUEST['from_date'],$_REQUEST['to_date']);
		$LDGR3 = $model->getCurrentBalance($member_id,'3',$_REQUEST['from_date'],$_REQUEST['to_date']);
?>	 

     <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
				<ul class="metismenu" id="menu">
                   
                     <li><a href="<?php echo BASE_PATH;?>userpanel" class="ai-icon" aria-expanded="false">
							<i class="flaticon-381-networking"></i>
							<span class="nav-text">Dashboard</span>
						</a>
					</li>
                    
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-381-internet"></i>
							<span class="nav-text">Network</span>
						</a>
                        <ul aria-expanded="false">
                             <li><a href="<?php  echo generateSeoUrlMember("network","my_team",array()); ?>">My Direct</a></li>
                            <li><a href="<?php  echo generateSeoUrlMember("network","treegenealogy",array()); ?>">Level Tree</a></li>
                              <li><a href="<?php  echo generateSeoUrlMember("network","level_view",array()); ?>">Level View</a></li>
                              

                        </ul>
                    </li>
                      <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
						<i class="fa-solid fa-wallet"></i>
							<span class="nav-text">Wallet System</span>
						</a>
                        <ul aria-expanded="false">
                                 <li><a href="<?php  echo generateSeoUrlMember("bonus-wallet","" ); ?>">Income Wallet</a></li>
                                 
                                 <?php if(true){ ?>
                            <li><a href="<?php  echo generateSeoUrlMember("activation-wallet","" ); ?>">Activation Wallet</a></li>
                            
                            <?php } ?>
                              <li><a href="<?php  echo generateSeoUrlMember("withdraw-history","",array()); ?>">Withdrawal History</a></li>
                              

                        </ul>
                    </li>
                     <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
						<i class="fa-solid fa-file"></i>
							<span class="nav-text">Report</span>
						</a>
                        <ul aria-expanded="false">
                              <li><a href="<?php  echo generateSeoUrlMember("report","stakingbonus" ); ?>">Roi Income</a></li>
                        <li><a href="<?php  echo generateSeoUrlMember("report","direct_referral_bonus" ); ?>"> Direct Income</a></li>
                        <li><a href="<?php  echo generateSeoUrlMember("report","level_bonus" ); ?>">Level Income</a></li>
                             
                         <?php if(false){ ?>

                        <li><a href="<?php  echo generateSeoUrlMember("report","RoyaltyIncome" ); ?>">Royalty Income</a></li>
                        <li><a href="<?php  echo generateSeoUrlMember("report","rank_rewards_new" ); ?>">Reward Income</a></li>
                        <?php } ?>
                       
                        <li><a href="<?php  echo generateSeoUrlMember("report","totalincome" ); ?>"> Total Income</a></li>
                        
                              

                        </ul>
                    </li>
                    
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
						<i class="fa-solid fa-user"></i>
							<span class="nav-text">My Profile</span>
						</a>
                        <ul aria-expanded="false">
                               <li><a href="<?php  echo generateSeoUrlMember("account","myprofile",array()); ?>"> Profile</a></li>
                        <li><a href="<?php  echo generateSeoUrlMember("support","contactsupport",array()); ?>">  Help Center</a></li>
                        <li><a href="<?php  echo generateSeoUrlMember("dashboard","logout",array()); ?>">  Log Out</a></li>
                              

                        </ul>
                    </li>
                    
                    
                  
                </ul>
				
				<div class="copyright">
					<p><strong><?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?></strong> © 2025 All Rights Reserved</p>
<p>Made with <span class="heart"></span> by <?php echo $model->getValue("CONFIG_COMPANY_NAME"); ?></p>
				</div>
			</div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
<div class="modal fade" id="Verify">
<div class="modal-dialog modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"> Verify Payment  From USDT </h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
   <form action="<?php echo BASE_PATH;?>userpanel/verifypayment" method="post">
        <div class="modal-body">


  <input type="hidden" value="<?php echo $memdata['ownaddress'];?>" name="randcheck" />
    
       <div class="mb-3">
                           
                                <select  name="modeofpayment" id="modeofpayment" class="form-control" required  >
                                <option value="" >Select Verify Option</option>
                               <option value="USDT" >USDT</option>
                               
                               <?php if(false){ ?>
                                 <option value="FOREXONE Token" >FOREXONE Token</option>
                                  <?php } ?> 
                                </select>
                            </div> 
                

 <br>
                    <p style="color:red;font-size:17px;">Note :-After Submit Please wait for 10 Seconds</p>
      
  
     
 </div>
    <div class="modal-footer"> 
   
    
 
		       <input type="hidden" name="submitform" id="submitform" value="1">
				<button type="submit" class="btn btn-primary mr-2">Submit</button>  
		
		    
		  
  
  </div>

          </form>
    

</div>
</div>
</div>

    <div class="modal fade" id="AddFund">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                   <h5 class="modal-title" id="exampleModalLabel"> Add Fund</h5>
                                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                              <div >
 
     <div class="col-xl-12">
                        <div class="card h-auto">
                            <div class="card-body">
                                <div class="profile-tab">
                                    <div class="custom-tab-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a href="#addfundusdt" data-bs-toggle="tab" class="nav-link active show">USDT</a>
                                            </li>
                                            <li class="nav-item"><a href="#addfundinr" data-bs-toggle="tab" class="nav-link">INR</a>
                                            </li>
                                         
                                        </ul>
                                        <div class="tab-content">
                                            <div id="addfundusdt" class="tab-pane fade active show">
                                                

                                    <div class="addfung-header-main">
                                        <h4 class="modal-title">Deposit Only USDT (Bep-20), Min 100 USDT via
                                            QR Code</h4>
                                    </div>
                                         
      <code>Please deposit USDT (BEP-20) only (Min. 100.00) and then choose verify option</code>
                                  <?php if(true){ ?>
                                                 <img  class="centerimg" src='https://quickchart.io/chart?cht=qr&chs=280x280&chl=<?php echo $Wallet_address; ?>'  alt="QR Code" title="Invitation Code" style="display: block;margin-left: auto;margin-right: auto;width: 50%;">
                   
                     <input type="hidden" id="myAddressInputs" value="<?php echo $Wallet_address; ?>">

                    <br>
                      <?php if($memdata['ownaddress']=='') { ?>
                    
                      <p style="color:red;font-size:17px;">Note :-Please <strong> Update Your Deposit Address </strong> Before Making any deposit otherwise your fund may lost <a style="color:blue;" href="<?php  echo generateSeoUrlMember("account","myprofile",array()); ?>" >Click Here</a></p>
                  
                  
                  <?php }else{ ?>
                  
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#Verify" style="float: inline-end;"> Very Payment</button>   
                         
                    
                  
                  <?php } ?>
                  
                    <?php } ?>
                  
                  
                  
                                    <input type="hidden" id="myAddressInputs"  value="<?php echo $Wallet_address; ?>">

                                    <br>

                                 

                                    <div class="col">
                                        <center>

                                            <button type="button" class="btn btn-outline-success  radius-30"
                                                style="font-size: 16px;background: aquamarine;padding: 6px;"
                                                onclick="copyldddddid()"><?php echo $Wallet_addressffff; ?>&nbsp;
                                                <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3"
                                                    style="font-size: 15px !important;color: white;"></i></button>


                                        </center>
                                    </div>
                                    <script>

                                        function copyldddddid() {
                                            var copyText = document.getElementById("myAddressInputs");
                                            copyText.type = 'text';
                                            copyText.select();
                                            document.execCommand("copy");
                                            copyText.type = 'hidden';
                                            alert('Wallet Address Copied', 'success');
                                            round_noti('success', 'Successfully copy your Deposite Address.');
                                        }


                                    </script>


                                
                                            </div>
                                            <div id="addfundinr" class="tab-pane fade">
                                    <div class="addfung-header-main">
                                        <h4 class="modal-title">Account Details</h4>
                                    </div>

                                  	<form action="<?php  echo  generateMemberForm("ewallet","requestfund"); ?>" id="form-valid" enctype="multipart/form-data" name="form-valid" autocomplete="off" method="post">	
	      


                                        <div class="field-wrap">
                                            <div>
                                                <strong>
                                                    A/C NAME
                                                </strong>
                                                  <input type="hidden" id="copyBank1"  value="<?php echo "SKSTAGE ONE INDIA PVT LTD"; ?>">

                                                <label id="copyBankdddd1">SKSTAGE ONE INDIA PVT LTD</label> 
                                                 <span onclick="copyBank('copyBank1')" href="javascript:;"
                                                class=" ">

                                                <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3"
                                                    style=" font-size: 15px !important;"></i>
                                            </span>
                                            </div>
                                           
                                        </div>
                                        <div class="field-wrap">
                                            <div>
                                                <strong>
                                                    A/C BANK
                                                </strong>
                                                  <input type="hidden" id="copyBankBranch"  value="<?php echo "CATHOLIC SYRIAN BANK LTD."; ?>">

                                                <label id="copyBankBranch">CATHOLIC SYRIAN BANK LTD.</label>
                                                 <span onclick="copyBankBranch('CATHOLIC SYRIAN BANK LTD.')" href="javascript:;"
                                                class=" ">

                                                <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3"
                                                    style=" font-size: 15px !important;"></i>
                                            </span>
                                            </div>

                                           
                                        </div>
                                        <div class="field-wrap">
                                            <div>
                                                <strong>
                                                    A/C NUMBER
                                                </strong>
                                                 <input type="hidden" id="copyBankAcount"  value="<?php echo "028404960371195001"; ?>">

                                                <label id="copyBankAcount">028404960371195001</label>
                                                  <span onclick="copyBankAcount('028404960371195001')" href="javascript:;"
                                                class=" ">

                                                <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3"
                                                    style=" font-size: 15px !important;"></i>
                                            </span>
                                            </div>
                                          
                                        </div>

                                        <div class="field-wrap">
                                            <div>
                                                <strong>
                                                    IFSC CODE
                                                </strong>
                                                   <input type="hidden" id="copyBankifsc"  value="<?php echo "CSBK0000284"; ?>">

                                                <label id="copyBankifsc">CSBK0000284</label>
                                                  <span onclick="copyBankifsc('CSBK0000284')" href="javascript:;"
                                                class=" ">

                                                <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3"
                                                    style=" font-size: 15px !important;"></i>
                                            </span>
                                            </div>
                                          
                                        </div>
                                        <div class="row">
 <div class="col-md-6">
      <div class="field-wrap" style="display: inline-block;margin-top: 10px;">
                                            <label style="margin-bottom: 5px;display: inline-block;">
                                                Screen Shot of Transaction
                                            </label>
                                            <br>
                                            <input type="file" name='uploadfile' required />
                                        </div>
     </div>
     
      <div class="col-md-6">
      <div class="field-wrap"  >
                                            <label style="margin-bottom: 5px;display: inline-block;">
                                                Amount (INR) 
                                            </label>
                                            <br>
                                            <input id="initial_amount"  placeholder="Amount" min="1" max="50000000"  name="initial_amount" autocomplete="off" class="form-control validate[required,custom[integer]]" type="number"  maxlength="8" required>
					  
                                        </div>
     </div>
     
     
        <div class="col-md-6">
            
             <div class="field-wrap" >
                                            <label style="margin-bottom: 5px;display: inline-block;">
                                                Deposit Date
                                            </label>
                                            <br>
                                            <input id="deposit_date" class="form-control"   name="deposit_date" autocomplete="off" class="validate[required,custom[integer]]" type="date"  required>
					  
                                        </div>
            
            </div>
            
            
     <div class="col-md-6">
            
              <div class="field-wrap" >
                                            <label style="margin-bottom: 5px;display: inline-block;">
                                              UTR Details
                                            </label>
                                            <br>
                                           <input id="trn_hascode"  placeholder="Trn/#code "  name="trn_hascode" autocomplete="off" class="form-control validate[required,custom[integer]]" type="text" required>
					  
                                        </div>
            
            </div>
            
            
     
                        </div>               

                                       
                                        
                                      
                                        <div class="field-wrap remark-content" style="">
                                            <label style="margin-bottom: 5px;display: inline-block;">
                                                Remarks 
                                            </label>
                                            <br>
                                             <textarea name="trns_remark" class="form-control validate[required]" placeholder="Remarks" id="form-field-1"></textarea>
                                        </div>
                                        
                                          <div class="field-wrap" >
                                            <label style="margin-bottom: 5px;display: inline-block;">
                                            User Password 
                                            </label>
                                            <br>
                                           <input name="trns_password" type="password" class="form-control validate[required]" id="trns_password" 
						value="" placeholder="User Password" required>
                                        </div>
                                        
                                         <input type="hidden" name="submitFundRequest" id="submitFundRequest" value="1" />
                                         <br>
                                       <button type="submit" name="buttonRequest" class="btn btn-primary mr-2">
	                                <i class="fa fa-check-square-o"></i> Submit
	                            </button>

                                    </form>
<script>

function copyBank() {
var copyText = document.getElementById("copyBank1");
copyText.type = 'text';
copyText.select();
document.execCommand("copy");
copyText.type = 'hidden';
alert('Bank Copied', 'success');
round_noti('success', 'Successfully copy your Deposite Address.');
}

function copyBankBranch() {
var copyText = document.getElementById("copyBankBranch");
copyText.type = 'text';
copyText.select();
document.execCommand("copy");
copyText.type = 'hidden';
alert('Bank Branch Copied', 'success');
round_noti('success', 'Successfully copy your Deposite Address.');
}
function copyBankAcount() {
var copyText = document.getElementById("copyBankAcount");
copyText.type = 'text';
copyText.select();
document.execCommand("copy");
copyText.type = 'hidden';
alert('Bank Account Copied', 'success');
round_noti('success', 'Successfully copy your Deposite Address.');
}
function copyBankifsc() {
var copyText = document.getElementById("copyBankifsc");
copyText.type = 'text';
copyText.select();
document.execCommand("copy");
copyText.type = 'hidden';
alert('Bank IFSC Copied', 'success');
round_noti('success', 'Successfully copy your Deposite Address.');
}
</script>
                                </div>
                                           	
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						<!-- Modal -->
					
						</div>
     
 </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                     
  
  <script>
          function check_member1(id)
{
//alert(id);
      jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "user/check_user",
data: {mem: id},
success: function(res) {
    //alert(res);
document.getElementById('name').value=res;

}
});
}
  </script>
  <script>
        $('.form').find('input, textarea').on('keyup blur focus', function (e) {

            var $this = $(this),
                label = $this.prev('label');

            if (e.type === 'keyup') {
                if ($this.val() === '') {
                    label.removeClass('active highlight');
                } else {
                    label.addClass('active highlight');
                }
            } else if (e.type === 'blur') {
                if ($this.val() === '') {
                    label.removeClass('active highlight');
                } else {
                    label.removeClass('highlight');
                }
            } else if (e.type === 'focus') {

                if ($this.val() === '') {
                    label.removeClass('highlight');
                }
                else if ($this.val() !== '') {
                    label.addClass('highlight');
                }
            }

        });

        $('.tab a').on('click', function (e) {

            e.preventDefault();

            $(this).parent().addClass('active');
            $(this).parent().siblings().removeClass('active');

            target = $(this).attr('href');

            $('.tab-content > div').not(target).hide();

            $(target).fadeIn(600);

        });
    </script>
  <script>
      $(".dashboard-main>.site-bar>.site-bar-content>.menu-link>ul>li>.drop-down>li").click(function () {
        $(".dashboard-main>.site-bar>.site-bar-content>.menu-link>ul>li>.drop-down>li").toggleClass('active');
       // $(this).addClass('active');
    });

  </script>
  <script>
        function getbenefits(unit)
              { 
              
              
             
     //  alert(unit);

                        if (unit == '1') 
                        { //alert(unit);
                        document.getElementById('ben1').style.display = 'block';
                        document.getElementById('ben2').style.display = 'none';
                         document.getElementById('ben3').style.display = 'none';
                        }else if(unit == '2'){
                              document.getElementById('ben1').style.display = 'none';
                                 document.getElementById('ben2').style.display = 'block';
                         document.getElementById('ben3').style.display = 'none';
                        }else if(unit == '3'){
                           // alert(unit);
                          document.getElementById('ben1').style.display = 'none';
                         document.getElementById('ben2').style.display = 'none';
                          document.getElementById('ben3').style.display = 'block';
                            
                        }
                        
         
              
              }
  </script>
  <script>
        function checksuccess(unit)
              { 
              
              
             
      //  alert(unit);

                        if (unit == 'MINING') 
                        { //alert(unit);
                       document.getElementById('ifYes').style.display = 'block';
                         document.getElementById('ifYes1').style.display = 'none';
                        }else{
                           // alert(unit);
                           document.getElementById('ifYes').style.display = 'block';
                         document.getElementById('ifYes1').style.display = 'block'; 
                            
                        }
                        
         
              
              }
  </script>
  