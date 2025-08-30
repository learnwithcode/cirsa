<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 $a = $this->uri->segment(3);
//echo $b = $this->uri->segment(3);
$segment1 = $this->uri->uri_to_assoc(2);



	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	$bankDetail = $model->getBankDetailMember($member_id);
    $account_number =   $bankDetail['account_number'];
    $ifc_code =   $bankDetail['ifc_code'];
    $bank_acct_holder =   $bankDetail['bank_acct_holder'];
    $member_mobile = $bankDetail['member_mobile'];
    $first_name = $bankDetail['first_name'];
        
	
?> 
	
	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	<div class="main-content">
        <section class="section">
          <div class="section-body">
            	<div class="row">
					    <div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Instant Fund Add</div>
								
									</div>
									
								</div>
								<div class="card-body">
								      	<?php echo get_message(); ?>
                    
             <form action="<?php echo BASE_PATH;?>razorpay/pay.php" method="post">
     

 
 

  <input type="hidden" class="form-control" id="ORDER_ID" name="ORDER_ID" size="20" maxlength="20" autocomplete="off"  tabindex="1" value="<?php echo  "ORDER" . rand(10000,99999999)?>">
       <input type="hidden" name="uid" value="<?php echo $this->session->userdata('user_id');;?>">
           
            <input type="hidden" name="mob" value="<?php echo $member_mobile;?>">    
      <div class="form-group has- ">
     <label for="ben_name">Beneficiary Name:</label>
     <input class="form-control" required=""   name="name" placeholder="Please enter Beneficiary Name"   value="<?php echo $first_name;?>" readonly type="text">
     </div>


     
                <div class="form-group ">
     <label for="amount">Amount in USD:</label>
     <input class="form-control" required="" id="TXN_AMOUNT" min='100' max='5000' a name="TXN_AMOUNT"  onkeyup="setusd(this.value);"  placeholder="Please enter   Amount in USD" data-toggle="tooltip" title="Please enter   Amount  in USD" type="number">
     </div>
     
          <div class="form-group  ">
     <label for="amount">Amount in INR:</label>
     <input class="form-control" required="" id="inr"  readonly  placeholder="Please enter Transfer Amount" data-toggle="tooltip" title="Please enter Transfer Amount" type="number">
     </div>
     
     
          <strong style="color:white"> Note : Payment gateway charge  3.54%  <!-- +  18% GST-->    will be applicable on  Amount  !</strong><br><br> 
     
   <input type="hidden" name="submitform" id="submitform" value="1">
        <button type="submit" class="btn btn-primary">Submit</button>

          </form>
                 
								</div>
							</div>
						</div>
						
					</div>
<script>
         function setusd(usd)
         {
              var amt = parseFloat(usd*75);
              var charge = parseFloat(amt*3.54/100);
              var gst = parseFloat(charge*18/100);
              var total = parseFloat(amt+charge+gst);
             document.getElementById("inr").value= total;
         }
     </script>
            
          </div>
        </section>
       
      </div>
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
<script>

        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        function BuyNow() {
            var amt = $("#txtBTCAmount").val();
            var mode = $("#fOption").val();
            if (amt == '') {
                tostalert('Amount is required!', 'warning');
                return;
            }
            if (mode == '') {
                tostalert('Crypto type is required!', 'warning');
                return;
            }
            var od = new FormData();
            od.append("amt", amt);
            od.append("mode", mode);
            $('#btnbuy').html('<i class="fa fa-spin fa-spinner"></i> Wait..').attr('disabled', true);
            $.ajax({
                url: "services/BuyBTC.ashx",
                type: "POST",
                contentType: false,
                processData: false,
                data: od,
                dataType: "json",
                success: function (Response) {
                    if (Response.Success) {
                        tostalert('BTC request is successfully sent.', 'success');
                        $('#btnbuy').html('Purchase Now').attr('disabled', false);
                        window.location.href = "Invoice?Order=" + Response.Message;
                    }
                    else {
                        $('#btnbuy').html('Purchase Now').attr('disabled', false);
                        tostalert(Response.Message, 'warning');
                    }
                },
                error: function (err) {
                    $('#btnbuy').html('Purchase Now').attr('disabled', false);
                    swal(err.statusText, "Buy Notifications !", "error");
                    tostalert(err.statusText, 'danger');
                }
            });
        }
    </script>