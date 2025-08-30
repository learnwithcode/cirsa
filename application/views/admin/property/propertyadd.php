<?php
defined('BASEPATH') or exit('No direct script access allowed');

$model = new OperationModel();
$getpropertytype = $model->getpropertytype();



//PrintR($ROW);die;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Meta -->
    <meta charset="utf-8" />
    <title>Add Property | Stage Onee India</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="A fully responsive premium admin dashboard template, Real Estate Management Admin Template" />
    <meta name="author" content="Techzaa" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo BASE_PATH; ?>propertyassets/images/favicon.png">

    <!-- Vendor css (Require in all Page) -->
    <link href="<?php echo BASE_PATH; ?>propertyassets/css/vendorA.min.css" rel="stylesheet" type="text/css" />

    <!-- Icons css (Require in all Page) -->
    <link href="<?php echo BASE_PATH; ?>propertyassets/css/iconsA.min.css" rel="stylesheet" type="text/css" />

    <!-- App css (Require in all Page) -->
    <link href="<?php echo BASE_PATH; ?>propertyassets/css/app.minA.css" rel="stylesheet" type="text/css" />

    <!-- Theme Config js (Require in all Page) -->
    <script src="<?php echo BASE_PATH; ?>propertyassets/js/config.minA.js"></script>
    <style>
        .dropzoneeee {}

        .dropzoneeee .card-body {}

        .dropzoneeee .card-body input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
        }

        .dropzoneeee .card-body .dz-message.needsclick {
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- START Wrapper -->
    <div class="wrapper">



        <!-- ==================================================== -->
        <!-- Start right Content here -->
        <!-- ==================================================== -->
        <div class="page-content">

            <!-- Start Container Fluid -->
            <div class="container-fluid">

                <!-- ========== Page Title Start ========== -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <h4 class="mb-0 fw-semibold">Add Property</h4>
                            <!--<ol class="breadcrumb mb-0">-->
                            <!--     <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>-->
                            <!--     <li class="breadcrumb-item active">Add Property</li>-->
                            <!--</ol>-->
                        </div>
                    </div>
                </div>
                <!-- ========== Page Title End ========== -->

                <div class="row">
                    <div class="col-xl-12 col-lg-12">
                        <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Property Information</h4>
                                        </br>
                                        <!--<button class="btn btn-primary "  onclick="history.back()" >Back</button>-->
                                        <button class="btn btn-primary pr-2"> <a style="color: white;" href="<?php echo generateSeoUrlAdmin("Property", "propertyList", ""); ?>">Property List</a></button>
                                    </div>
                                    
                       <form class="bg-light-subtle" action="<?php echo ADMIN_PATH . 'property/indexproperty'; ?>"  method="POST" enctype="multipart/form-data">
                                <?php echo get_message(); ?>
                                <p id="error-msg"></p>

                                <div class="card">
                                    

                                    <div class="card-body">
                                        <div class="row">
                                              <div class="col-lg-6" >
                                                <div class="mb-3">
                                                    <label for="property-name" class="form-label">Booked User Name</label>
                                                    <input type="text" id="property-name"  name="username" class="form-control"
                                                        placeholder="User Name">
                                                </div>

                                            </div>
                                            
                                             <div class="col-lg-6" >
                                                <div class="mb-3">
                                                    <label for="property-name" class="form-label">Mobile Number</label>
                                                     <input minlength="10" maxlength="10" required class="form-control" name="mobileno" id="mobileno"  onKeyPress="return isNumber(event)" placeholder="Aadhaar Number" type="text">
                 
                                                </div>

                                            </div>
                                            
                                         <div class="col-lg-6" >
                                                <div class="mb-3">
                                                    <label for="property-name" class="form-label">Email ID</label>
                                                    <input type="email" id="emailid"  name="emailid" class="form-control" placeholder="Enter Email ID">
                                                </div>

                                            </div>
                                            
                                             <div class="col-lg-6" >
                                                <div class="mb-3">
                                                    <label for="property-name" class="form-label">Pan Card No</label>
                                                  <div id="message" class="message"></div>
                                    <input style="text-transform:uppercase" required class="form-control" name="pan_no" id="PanNum" minlength="10" maxlength="10" onKeyUp="checkPanFormat()" placeholder="Pan Card No" type="text">
                   
                                   
                                                </div>

                                            </div>
                                            
                                             <div class="col-lg-6" >
                                                <div class="mb-3">
                                                    <label for="property-name" class="form-label">Aadhar No</label>
                                                  <input minlength="12" maxlength="12" required class="form-control" name="useradhar" id="useradhar" onKeyPress="return isNumber(event)" placeholder="Aadhaar Number" type="text" <?php echo ($ROW['adhar']!='')?'readonly':'';?>>
                 
                                                </div>

                                            </div>
                                             <div class="col-lg-6" >
                                                <div class="mb-3">
                                                    <label for="property-name" class="form-label">Plot Amount</label>
                                                     <input  required class="form-control" name="pamount" id="amount"  onKeyPress="return isNumber(event)" placeholder="Plot Amount" type="text" <?php echo ($ROW['adhar']!='')?'readonly':'';?>>
                 
                                                </div>

                                            </div>
                                            
                                              <div class="col-lg-12" >
                                                <div class="mb-3">
                                                    <label for="property-address" class="form-label">User
                                                        Address</label>
                                                    <textarea class="form-control" id="useraddress"  name="propertyaddress"
                                                        rows="3" placeholder="Enter address"></textarea>
                                                </div>
                                            </div>
                                            
                                              
                                          
                                            <div class="col-lg-6" >

                                                <label for="property-categories" class="form-label">Property
                                                    Categories</label>
                                                <select class="form-control"  id="property" name="propertycat"
                                                    data-choices data-choices-groups
                                                    data-placeholder="Select Categories" required onchange="GetPropertyData111(this.value)">
                                                    
                                                    <option value="1">Shree Radha Rani Township</option>
                                                    <option value="2">Shree Ghirona Dham City</option>
                                                </select>

                                            </div>

  <div class="col-lg-6" >

                                                <label for="property-categories" class="form-label">Property
                                                    Type</label>
                                                    
                                                    <?php if(false){ ?>
                                                <select class="form-control"  data-choices data-choices-groups
                                                    data-placeholder="Select Categories" required id="type" name="propertytype" onchange="GetPropertyData(this.value)" required>
                                                    <?php foreach ($getpropertytype as $key => $val) { ?>
                <option value="<?php echo $val['type_id']; ?>" 
                    <?php if (!empty($ROW['type_name']) && $ROW['type_name'] == $val['type_name']) { echo 'selected'; } ?>>
                    <?php echo htmlspecialchars($val['type_name']); ?>
                </option>
            <?php } ?>
                                                </select>
                       <?php } ?>                            
                                               <?php if(true){ ?>  
                                          <select  class="form-control"  id="type" name="propertytype" required onchange="GetPropertyData(this.value)">
            <option value="">--- Select Type ---</option>
        </select>        
                                                
                                                
                               <?php } ?>                       
                                                
                                                

                                            </div>
                                            
                <div class="col-lg-6" >
                
                <label for="property-categories" class="form-label">Property
                Blocks</label>
                <select class="form-control"    id="blockk" name="propertyblock" required  onchange="GetPropertyPilotData(this.value)" >
                <option value="">--- Select Blocks ---</option>
                </select>
                
                </div>
                                               <div class="col-lg-6" >
                
                <label for="property-categories" class="form-label">Plots No</label>
                <select class="form-control"    id="blockkpilots" name="propertypolotno" required  onchange="GetPropertyPilotdimension(this.value)"   >
                <option value="">--- Select Blocks ---</option>
                </select>
                
                </div>

 <div class="col-lg-6" >
                                                <div class="mb-3">
                                                    <label for="property-name" class="form-label">Property Dimensional and Size</label>
                                                    <div id="pilotsdimension">
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                            
                                         
                                          

                                            <div class="col-lg-6">

                                                <label for="property-for" class="form-label">Property Status</label>
                                                <select class="form-control" id="property-for"  name="propertystatus" data-choices
                                                    data-choices-groups data-placeholder="Select Status">
                                                   
                                                    <option value="Booked">Booked</option>
                                                    <option value="Agreement">Agreement</option>
                                                    <option value="Registry">Registry</option>
                                                </select>

                                            </div>




                                          
                                            
                                        
                                            
                                              <div class="col-lg-6">
                                              <div class="mb-3">
                                                <label for="link-upload" class="form-label">Property Image</label>
                                                <br>
                                                <input  name="propertyimage" type="file" accept="image/*">
                                            </div>
                                            </div>
                                            
                                               <div class="col-lg-6">
                                              <div class="mb-3">
                                                <label for="link-upload" class="form-label">Complete Aadhar Photo </label>
                                                <br>
                                                <input  name="aadharimage" type="file" accept="image/*">
                                            </div>
                                            </div>
                                               <div class="col-lg-6">
                                              <div class="mb-3">
                                                <label for="link-upload" class="form-label">Pan Card Image</label>
                                                <br>
                                                <input  name="pannoimage" type="file" accept="image/*">
                                            </div>
                                            </div>
                                            
                                            
                                              <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="link-upload" class="form-label">Agreement Pdf</label>
                                                    <br>
                                                    <input  name="aggreementpdf" type="file" accept="application/pdf" >
                                            </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 rounded">
                                    <div class="row justify-content-end g-2">
                                        <div class="col-lg-2">

                                            <button type="submit" name="submitMemberSave1" value="1" class="btn btn-info">
                                                    <i class="ace-icon fa fa-check bigger-110"></i> Submit
                                                </button>

                                        </div>

                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
                <!-- End Container Fluid -->
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
                <!-- ========== Footer Start ========== -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 text-center">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> &copy; All Right Reserved
                                by <a href="#" class="fw-bold footer-text" target="_blank">Stage One India</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- ========== Footer End ========== -->

            </div>
            <!-- ==================================================== -->
            <!-- End Page Content -->
            <!-- ==================================================== -->

        </div>
        <!-- END Wrapper -->
        </div>
        <!-- Vendor Javascript (Require in all Page) -->
        <script src="<?php echo BASE_PATH; ?>propertyassets/js/vendorA.js"></script>

        <!-- App Javascript (Require in all Page) -->
        <script src="<?php echo BASE_PATH; ?>propertyassets/js/appA.js"></script>
        
     

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    function GetPropertyData111(property) {
      
   // alert(property);
    if (!property) {
        alert("Please select a valid type.");
        return;
    }

    jQuery.ajax({
    type: "POST",
    url: "<?php echo BASE_PATH; ?>admin/property/GetPropertyData111",
    data: { id: property },
    success: function (res) {
        console.log(res); // Log the response to ensure it's valid
        $("#type").html(res);
    },
    error: function () {
        alert("Failed to fetch property data. Please try again.");
    }
});
}
    function GetPropertyData(typeId) {
      
    
    if (!typeId) {
        alert("Please select a valid type.");
        return;
    }

    jQuery.ajax({
    type: "POST",
    url: "<?php echo BASE_PATH; ?>admin/property/GetPropertyData",
    data: { id: typeId },
    success: function (res) {
        //alert(res);
        console.log(res); // Log the response to ensure it's valid
        $("#blockk").html(res);
    },
    error: function () {
        alert("Failed to fetch property data. Please try again.");
    }
});
}

 function GetPropertyPilotData(typeId) {
     
    
    if (!typeId) {
        alert("Please select a valid type.");
        return;
    }

    jQuery.ajax({
    type: "POST",
    url: "<?php echo BASE_PATH; ?>admin/property/GetPropertyPilotData",
    data: { id: typeId },
    success: function (res) {
       // alert(res);
        console.log(res); // Log the response to ensure it's valid
        $("#blockkpilots").html(res);
    },
    error: function () {
        alert("Failed to fetch property data. Please try again.");
    }
});
}

  function GetPropertyPilotdimension(typeId) {
     
    
    if (!typeId) {
        alert("Please select a valid type.");
        return;
    }

    jQuery.ajax({
    type: "POST",
    url: "<?php echo BASE_PATH; ?>admin/property/GetPropertyPilotdimension",
    data: { id: typeId },
    success: function (res) {
       // alert(res);
        console.log(res); // Log the response to ensure it's valid
        $("#pilotsdimension").html(res);
    },
    error: function () {
        alert("Failed to fetch property data. Please try again.");
    }
});
} 

</script>


</body>

</html>