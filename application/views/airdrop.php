<?php $model = new OperationModel();
   session_start();
//PrintR($_SESSION['CAPTCHA_CODE']);
//echo $_SESSION['CAPTCHA_CODE'];
	$segment = $this->uri->uri_to_assoc(1);
//	PrintR($segment['Airdrop']);
$memberid =$segment['Airdrop'];
?> 
	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
 
?>
<div id="app" class="app app-full-height app-without-header">

<style>
* {
  box-sizing: border-box;
}


#regForm {
  
  margin: 100px auto;
  font-family: Raleway;
 
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 5px;
  width: 100%;
  font-size: 12px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
    <?php echo get_message(); ?>
 <center> <img src="<?php echo BASE_PATH;?>upload/logowhite.png" class="img-fluid rounded" alt="" style="width: 100px;"></center>   
<form id="regForm"  action="<?php echo generateSeoUrl("Airdrop","$memberid",array()); ?>" method="post">
 <center> <h1>Congratulations
</h1>

<h2 style="color:yellow;">
    You will Get 100 $ Airdrop on Registration and also Get 10 $ on every successful Referral
</h2>
<h3>Complete the Following Steps to Claim Your Airdrop</h3>
</center>
  <!-- One "tab" for each step in the form: -->
  <div class="tab">
     <center>  <h3 style="color:yellow;">Join Our Telegram Chanel Group</h3> </center>
        
     <p>  <input  id="copytelegram" style="cursor: no-drop; width: 100%" type="hidden" value="https://t.me/profit_plus_technology" readonly> 
     <a href="https://t.me/profit_plus_technology">https://t.me/profit_plus_technology</a>
<span onclick="copytelegramuserid()"  class=" ">
                                    
                                    <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3" style="font-size: 25px !important;margin-top: 2px;float: right;z-index: 99999;position: absolute;margin-left: 22px;"></i>
                                    </span> </p>
   
    <p><input placeholder="Enter Your Telegram User ID" oninput="this.className = ''" name="telegramuserid" autocomplete="off"></p>
  </div>
  <div class="tab">
        <center> <h3 style="color:yellow;">Join Our Whatspp Chanel Group</h3> </center>
    <p>  <input  id="copyWhatspp" style="cursor: no-drop; width: 100%" type="hidden" value="https://whatsapp.com/channel/0029Va7k2lo8qIzoMSOwji2E" readonly>  
     <a href="https://whatsapp.com/channel/0029Va7k2lo8qIzoMSOwji2E">https://whatsapp.com/channel/0029Va7k2lo8qIzoMSOwji2E</a>
    
    
<span onclick="copyWhatspp()"  class=" ">
                                    
                                    <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3" style="font-size: 25px !important;margin-top: 2px;float: right;z-index: 99999;position: absolute;margin-left: 22px;"></i>
                                    </span> </p>
   
    <p><input placeholder="Enter Your Whatsapp Number" oninput="this.className = ''"  type="number" name="Whatsppno" autocomplete="off"></p>
  </div>
  <div class="tab">
    <center>  <h3 style="color:yellow;">Follow us On Instagram</h3> </center>
    <p>  <input  id="copyinstagram" type="hidden" style="cursor: no-drop; width: 100%" value="https://instagram.com/profitplustechnology" readonly>    
    
       <a href="https://instagram.com/profitplustechnology">https://instagram.com/profitplustechnology</a>
<span onclick="copyinstagram()"  class=" ">
                                    
                                    <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3" style="font-size: 25px !important;margin-top: 2px;float: right;z-index: 99999;position: absolute;margin-left: -22px;"></i>
                                    </span> </p>
   
    <p><input placeholder="Enter Your Instagram ID" oninput="this.className = ''"  type="text" name="copyinstagram" autocomplete="off"></p>
    
    <input name="submitRequest" value="1" type="hidden">
      <input name="memberid" value="<?php echo $segment['Airdrop']; ?>" type="hidden">
  </div>
 
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
      <br>
      <a href="<?php echo BASE_PATH;?>">Skip All Steps</a>
    </div>
  </div>
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step"></span>
    <span class="step"></span>
    <span class="step"></span>
   
  </div>
</form>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

<script>
     function copytelegramuserid()
        {
            var link = $("#copytelegram").val();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            console.log("Copied the text:", tempInput.value);
            alert('Telegram Chanel Group Copied', 'success');
            document.body.removeChild(tempInput);
        }
         function copyWhatspp()
        {
            var link = $("#copyWhatspp").val();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            console.log("Copied the text:", tempInput.value);
            alert('Whatsapp Chanel Group Copied', 'success');
            document.body.removeChild(tempInput);
        }
           function copyinstagram()
        {
            var link = $("#copyinstagram").val();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            console.log("Copied the text:", tempInput.value);
            alert('Instagram ID Copied', 'success');
            document.body.removeChild(tempInput);
        }
</script>
<a href="#" data-toggle="scroll-to-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="<?php echo BASE_PATH; ?>newweb/assets/js/vendor.min.js" type="cc919887dad05424d1e07f4b-text/javascript"></script>
<script src="<?php echo BASE_PATH; ?>newweb/assets/js/app.min.js" type="cc919887dad05424d1e07f4b-text/javascript"></script>


<script src="<?php echo BASE_PATH; ?>newweb/assets/plugins/jvectormap-next/jquery-jvectormap.min.js" type="cc919887dad05424d1e07f4b-text/javascript"></script>
<script src="<?php echo BASE_PATH; ?>newweb/assets/plugins/jvectormap-content/world-mill.js" type="cc919887dad05424d1e07f4b-text/javascript"></script>
<script src="<?php echo BASE_PATH; ?>newweb/assets/plugins/apexcharts/dist/apexcharts.min.js" type="cc919887dad05424d1e07f4b-text/javascript"></script>
<script src="<?php echo BASE_PATH; ?>newweb/assets/js/demo/dashboard.demo.js" type="cc919887dad05424d1e07f4b-text/javascript"></script>


<script src="<?php echo BASE_PATH; ?>newweb/assets/rocket-loader.min.js" data-cf-settings="cc919887dad05424d1e07f4b-|49" defer></script>
