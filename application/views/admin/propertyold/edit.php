

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  $QR_SUM = "SELECT * FROM tbl_property  where id = $id";
    $AR_SUM = $this->SqlModel->runQuery($QR_SUM,true);
    
    
// print_r($AR_SUM);die;
   
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
     <link rel="shortcut icon" href="<?php echo BASE_PATH;?>propertyassets/images/favicon.png">

     <!-- Vendor css (Require in all Page) -->
     <link href="<?php echo BASE_PATH;?>propertyassets/css/vendorA.min.css" rel="stylesheet" type="text/css" />

     <!-- Icons css (Require in all Page) -->
     <link href="<?php echo BASE_PATH;?>propertyassets/css/iconsA.min.css" rel="stylesheet" type="text/css" />

     <!-- App css (Require in all Page) -->
     <link href="<?php echo BASE_PATH;?>propertyassets/css/app.minA.css" rel="stylesheet" type="text/css" />

     <!-- Theme Config js (Require in all Page) -->
     <script src="<?php echo BASE_PATH;?>propertyassets/js/config.minA.js"></script>
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
                                 <!--<button class="btn btn-primary"   onclick="history.back()" >Back</button>-->
                                 <button class="btn btn-primary pr-2"  > <a href="<?php echo generateSeoUrlAdmin("Property","propertyList",""); ?>">Property List</a></button>
                                   </div>
                                   
                        <form class="bg-light-subtle"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."property/update"; ?>" enctype="multipart/form-data" method="post" id="myAwesomeDropzone"  data-plugin="dropzone" data-previews-container="#file-previews"  data-upload-preview-template="#uploadPreviewTemplate">
                            
                               <?php echo get_message(); ?>
                                      <p id="error-msg"></p>
                            
                              <div class="card">
                                   <div class="card-body">
                                        <div class="row">
                                            
                                             <div class="col-lg-6">
                                                       <div class="mb-3">
                                                            <label for="property-name" class="form-label">Property
                                                                 Name</label>
                                                            <input type="text" id="property-name"    value="<?php echo $AR_SUM[name]; ?>" name="propertyname" class="form-control"
                                                                 placeholder="Name">
                                                       </div>
                                             </div>
                                             
                                             <div class="col-lg-6" style="display:none">
                                                       <label for="property-categories" class="form-label">Property
                                                            Categories</label>
                                                       <select class="form-control" id="property-categories"    name="propertycat" 
                                                            data-choices data-choices-groups
                                                            data-placeholder="Select Categories"
                                                            ">
                                                            <option value="Plots" <?php echo $AR_SUM[property_type] == "Plots" ? "selected" : "" ; ?> >Plots</option>
                                                            <option value="Villas" <?php echo $AR_SUM[property_type] == "Villas" ? "selected" : "" ; ?> >Villas</option>
                                                            <option value="Residences" <?php echo $AR_SUM[property_type] == "Residences" ? "selected" : "" ; ?> >Residences</option>
                                                            <option value="Bungalow" <?php echo $AR_SUM[property_type] == "Bungalow" ? "selected" : "" ; ?> >Bungalow</option>
                                                            <option value="Apartment" <?php  echo $AR_SUM[property_type] == "Apartment" ? "selected" : "" ; ?> >Apartment</option>
                                                            <option value="Penthouse" <?php echo $AR_SUM[property_type] == "Penthouse" ? "selected" : "" ; ?> >Penthouse</option>
                                                       </select>
                                             </div>
                                          
                                             
                                          
                                             
                                             
                                              <?php if($AR_SUM[property_type] != "Plots"){ ?> 
                                              
                                                 
                                              <div class="col-lg-6">
                                                       <label for="beds" class="form-label">Beds Room</label>
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text fs-20 px-2 py-0"><iconify-icon
                                                                      icon="solar:bed-broken"
                                                                      class="align-middle"></iconify-icon></span>
                                                            <input type="number" id="beds"   value="<?php echo $AR_SUM[bed]; ?>" name="beds" 
                                                                 class="form-control" placeholder="0">
                                                       </div>
                                                
                                             </div>
                                             
                                              <div class="col-lg-6">
                                                 
                                                       <label for="bath" class="form-label">Bath</label>
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text fs-20 px-2 py-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M3.5 4.135a1.635 1.635 0 0 1 3.153-.607l.144.358a4.1 4.1 0 0 0-1.38 1.774a4.18 4.18 0 0 0-.02 3.107a.75.75 0 0 0 .995.413l5.96-2.566a.75.75 0 0 0 .402-.963a3.97 3.97 0 0 0-2.132-2.213a3.84 3.84 0 0 0-2.466-.192l-.11-.275A3.135 3.135 0 0 0 2 4.135V11h-.25a.75.75 0 0 0 0 1.5H2v.355c0 .375 0 .595.016.84c.142 2.237 1.35 4.302 3.102 5.652l-.039.068l-1 2a.75.75 0 0 0 1.342.67l.968-1.935a7.4 7.4 0 0 0 2.58.765c.245.025.394.03.648.04h.007c.74.028 1.464.045 2.126.045s1.386-.017 2.126-.045h.007c.254-.01.404-.015.648-.04a7.4 7.4 0 0 0 2.58-.765l.968 1.936a.75.75 0 0 0 1.342-.671l-1-2l-.038-.068c1.751-1.35 2.96-3.416 3.102-5.652c.015-.245.015-.465.015-.84v-.038c0-.06 0-.123-.004-.18a2 2 0 0 0-.014-.137h.268a.75.75 0 0 0 0-1.5H3.5z"/></svg></span>
                                                            <input type="number" id="bath"   value="<?php echo $AR_SUM[bath]; ?>" name="bath" 
                                                                 class="form-control" placeholder="0">
                                                       </div>
                                                
                                             </div>
                                              
                                               <div class="col-lg-6 Flat_Show" >

                                                      <label for="hall" class="form-label">Hall</label>
                                                      <div class="input-group mb-3">
                                                           <span class="input-group-text fs-20 px-2 py-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M3.5 4.135a1.635 1.635 0 0 1 3.153-.607l.144.358a4.1 4.1 0 0 0-1.38 1.774a4.18 4.18 0 0 0-.02 3.107a.75.75 0 0 0 .995.413l5.96-2.566a.75.75 0 0 0 .402-.963a3.97 3.97 0 0 0-2.132-2.213a3.84 3.84 0 0 0-2.466-.192l-.11-.275A3.135 3.135 0 0 0 2 4.135V11h-.25a.75.75 0 0 0 0 1.5H2v.355c0 .375 0 .595.016.84c.142 2.237 1.35 4.302 3.102 5.652l-.039.068l-1 2a.75.75 0 0 0 1.342.67l.968-1.935a7.4 7.4 0 0 0 2.58.765c.245.025.394.03.648.04h.007c.74.028 1.464.045 2.126.045s1.386-.017 2.126-.045h.007c.254-.01.404-.015.648-.04a7.4 7.4 0 0 0 2.58-.765l.968 1.936a.75.75 0 0 0 1.342-.671l-1-2l-.038-.068c1.751-1.35 2.96-3.416 3.102-5.652c.015-.245.015-.465.015-.84v-.038c0-.06 0-.123-.004-.18a2 2 0 0 0-.014-.137h.268a.75.75 0 0 0 0-1.5H3.5z"/></svg></span>
                                                           <input type="number" id="hall"  name="hall" 
                                                                class="form-control" placeholder="0" value="<?php echo $AR_SUM[hall]; ?>" >
                                                      </div>

                                            </div>
                                            
                                            
                                             <div class="col-lg-6 Flat_Show" >

                                                      <label for="kitchen" class="form-label">Kitchen</label>
                                                      <div class="input-group mb-3">
                                                           <span class="input-group-text fs-20 px-2 py-0"><svg fill="#000000" height="1em" width="1em" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 55 55" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M52,52V29v-5h1.01v-2H51h-6.396l-4.975-9.465C39.457,12.206,39.116,12,38.744,12H33V2c0-0.553-0.448-1-1-1h-9 c-0.552,0-1,0.447-1,1v10h-5.744c-0.372,0-0.712,0.206-0.885,0.535L10.396,22H4H2v2h1v5v23H0v2h4h7h9.994h12.012H44h7h4v-2H52z M24,3h7v9h-7V3z M16.86,14H23h9h6.14l4.205,8H12.655L16.86,14z M11,24h33h6v4h-6H11H5v-4H11z M33.006,47h-0.543 c4.443-5.421,1.496-12.799,1.462-12.881c-0.14-0.338-0.453-0.573-0.816-0.613c-0.369-0.042-0.721,0.123-0.929,0.423 c-0.38,0.546-0.721,1.037-1.027,1.479c-0.485-1.177-1.721-2.922-4.865-3.865c-0.35-0.105-0.733-0.01-0.994,0.251 c-1.087,1.087-1.665,2.229-1.945,3.288c-0.529-0.366-1.185-0.713-1.997-1.018c-0.254-0.095-0.537-0.084-0.781,0.034 c-0.245,0.116-0.432,0.328-0.518,0.585C18.264,40.027,21.127,44.61,23.145,47h-2.151C19.343,47,18,48.348,18,50.005v0.99 c0,0.354,0.072,0.689,0.185,1.005H12V30h31v22h-7.185C35.928,51.684,36,51.349,36,50.995v-0.99C36,48.348,34.657,47,33.006,47z M25.888,47c-1.098-1.046-5.253-5.406-4.225-10.607c0.782,0.425,1.238,0.877,1.502,1.274c0.11,0.994,0.387,1.66,0.416,1.727 c0.172,0.403,0.59,0.649,1.023,0.601c0.435-0.045,0.791-0.368,0.877-0.798c0.015-0.072,0.184-1.003-0.356-2.127 c-0.033-0.944,0.179-2.2,1.176-3.414c1.634,0.61,2.722,1.575,3.089,2.755c0.201,0.645,0.149,1.207,0.022,1.585 c-0.896,1.442-0.702,1.587-0.17,1.983c0.185,0.139,0.841,0.52,1.539-0.354c0.184-0.229,0.334-0.493,0.45-0.78 c0.352-0.524,0.855-1.262,1.406-2.063c0.554,2.543,0.822,7.075-3.002,10.218H25.888z M5,52V30h5v22H5z M20.994,52 C20.446,52,20,51.549,20,50.995v-0.99C20,49.451,20.446,49,20.994,49h12.012C33.554,49,34,49.451,34,50.005v0.99 C34,51.549,33.554,52,33.006,52H20.994z M45,52V30h5v22H45z"></path> </g> </g></svg></span>
                                                           <input type="number" id="kitchen"  name="kitchen" 
                                                                class="form-control" placeholder="0" value="<?php echo $AR_SUM[kitchen]; ?>" >
                                                      </div>

                                            </div>
                                            
                                              <div class="col-lg-6 Flat_Show" >
                                                      <label for="Builder Area" class="form-label">Builder Area</label>
                                                      <div class="input-group mb-3">
                                                           <span class="input-group-text fs-20"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v16a2 2 0 0 0 2 2h16c1.11 0 2-.89 2-2V4a2 2 0 0 0-2-2M4 6l2-2h4.9L4 10.9zm0 7.7L13.7 4h4.9L4 18.6zM20 18l-2 2h-4.9l6.9-6.9zm0-7.7L10.3 20H5.4L20 5.4z"/></svg></span>
                                                           <input type="number" id="BuilderArea"  name="builderarea" 
                                                                class="form-control" placeholder="" value="<?php echo $AR_SUM[builderarea]; ?>" >
                                                      </div>

                                            </div>
                                            
                                             <div class="col-lg-6 Flat_Show" >
                                                      <label for="CarpetArea" class="form-label">Carpet Area</label>
                                                      <div class="input-group mb-3">
                                                           <span class="input-group-text fs-20"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v16a2 2 0 0 0 2 2h16c1.11 0 2-.89 2-2V4a2 2 0 0 0-2-2M4 6l2-2h4.9L4 10.9zm0 7.7L13.7 4h4.9L4 18.6zM20 18l-2 2h-4.9l6.9-6.9zm0-7.7L10.3 20H5.4L20 5.4z"/></svg></span>
                                                           <input type="number" id="CarpetArea"  name="carpetarea" 
                                                                class="form-control" placeholder="" value="<?php echo $AR_SUM[carpetarea]; ?>" >
                                                      </div>

                                            </div>
                                            
                                                <div class="col-lg-6">
                                                 
                                                       <label for="flore" class="form-label">Flore</label>
                                                       <div class="input-group mb-3">
                                                            <span class="input-group-text fs-20 px-2 py-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21.25V7.871m-6.287 5.666l5.226-5.226c.293-.293.677-.44 1.061-.44m6.287 5.666l-5.226-5.226A1.5 1.5 0 0 0 12 7.87M2.75 2.75h18.5"/></svg></span>
                                                            <input type="number" id="flore"   value="<?php echo $AR_SUM[flore]; ?>" name="flore" 
                                                                 class="form-control" placeholder="0">
                                                       </div>
                                             </div>
                                            
                                            
                                              <div class="col-lg-6">
                                            <label for="Accessible-features" class="form-label">Accessible features</label>
                                            <select class="form-control" id="Accessible-features"  name="accessiblefeatures[]" 
                                                    data-choices data-choices-groups data-placeholder="Accessible features" 
                                                    multiple>
                                                <option value="">Choose Accessible features</option>
                                                <optgroup label="Amenities">
                                                    <option <?php echo (strpos($AR_SUM['accessible_features'], "Balcony") !== false) ? "selected" : ""; ?> value="Balcony">Balcony</option>
                                                    <option <?php echo (strpos($AR_SUM['accessible_features'], "Parking") !== false) ? "selected" : ""; ?> value="Parking">Parking</option>
                                                    <option <?php echo (strpos($AR_SUM['accessible_features'], "Spa") !== false) ? "selected" : ""; ?> value="Spa">Spa</option>
                                                    <option <?php echo (strpos($AR_SUM['accessible_features'], "Pool") !== false) ? "selected" : ""; ?> value="Pool">Pool</option>
                                                    <option <?php echo (strpos($AR_SUM['accessible_features'], "Restaurant") !== false) ? "selected" : ""; ?> value="Restaurant">Restaurant</option>
                                                    <option <?php echo (strpos($AR_SUM['accessible_features'], "Fitness-Club") !== false) ? "selected" : ""; ?> value="Fitness-Club">Fitness Club</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                           
                                           
                                           
                                             
                                            
                                              <?php } ?>
                                             
                                             <div class="col-lg-6">
                                                 
                                                       <label for="property-for" class="form-label">Property For</label>
                                                       <select class="form-control" id="property-for"  name="propertyfor"  data-choices 
                                                            data-choices-groups data-placeholder="Select Categories"
                                                          >
                                                            <option value="Sale"  <?php echo $AR_SUM[accessibility_features] == "Sale" ? "selected" : "" ; ?> >Sale</option>
                                                            <option value="Rent"  <?php echo $AR_SUM[accessibility_features] == "Rent" ? "selected" : "" ; ?> >Rent</option>
                                                            <option value="Other"  <?php echo $AR_SUM[accessibility_features] == "Other" ? "selected" : "" ; ?> >Other</option>
                                                       </select>
                                                 
                                             </div>
                                             
                                             
                                             

                                             <!--<div class="col-lg-6">-->
                                                
                                             <!--          <label for="Area" class="form-label">Area</label>-->
                                             <!--          <div class="input-group mb-3">-->
                                             <!--               <span class="input-group-text fs-20"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v16a2 2 0 0 0 2 2h16c1.11 0 2-.89 2-2V4a2 2 0 0 0-2-2M4 6l2-2h4.9L4 10.9zm0 7.7L13.7 4h4.9L4 18.6zM20 18l-2 2h-4.9l6.9-6.9zm0-7.7L10.3 20H5.4L20 5.4z"/></svg></span>-->
                                             <!--               <input type="number" id="Area"   value="<?php // echo $AR_SUM[size]; ?>" name="area" -->
                                             <!--                    class="form-control" placeholder="">-->
                                             <!--          </div>-->
                                                  
                                             <!--</div>-->
                                             
                                             <!--  <div class="col-lg-6">-->
                                             <!--          <label for="area-type" class="form-label">Area Type</label>-->
                                             <!--          <select class="form-control" id="area-type"  name="areatype"  data-choices-->
                                             <!--               data-choices-groups data-placeholder="Area Type">-->
                                             <!--               <option value="">Choose a Area Type</option>-->
                                             <!--               <optgroup label="">-->
                                             <!--                    <option value="foot"  <?php  // echo $AR_SUM[size_type] == "foot" ? "selected" : "" ; ?> >foot</option>-->
                                             <!--                    <option value="meter"  <?php //  echo $AR_SUM[size_type] == "meter" ? "selected" : "" ; ?> >meter</option>-->
                                             <!--                    <option value="inch"  <?php  // echo $AR_SUM[size_type] == "inch" ? "selected" : "" ; ?> >inch</option>-->
                                             <!--                    <option value="ghaz"  <?php  // echo $AR_SUM[size_type] == "ghaz" ? "selected" : "" ; ?> >ghaz</option>-->
                                             <!--               </optgroup>-->
                                             <!--          </select>-->
                                                 
                                             <!--</div>-->
                                             
                                       

                                          <?php if($AR_SUM[property_type] == "Plots"){ ?> 
                                        
                                         <div class="col-lg-6 Plot_Show" >
                                                <label for="block-no" class="form-label">Block No</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20 px-2 py-0"><i
                                                            class="ri-money-dollar-circle-line"></i></span>
                                                    <input type="number" id="block-no"  name="blockno"
                                                        class="form-control" placeholder="0" value="<?php echo $AR_SUM[blockno]; ?>">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 Plot_Show" >
                                                <label for="plot-no" class="form-label">Plot No</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20 px-2 py-0"><i
                                                            class="ri-money-dollar-circle-line"></i></span>
                                                    <input type="number" id="plot-no"  name="plotno"
                                                        class="form-control" placeholder="0" value="<?php echo $AR_SUM[plotno]; ?>">
                                                </div>
                                            </div>
                                          <?php }; ?>
                                            <div class="col-lg-6" >
                                                <label for="property-price" class="form-label">Price (Per Feet)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20 px-2 py-0"><i
                                                            class="ri-money-dollar-circle-line"></i></span>
                                                    <input type="number" id="property-price"  name="propertyprice"
                                                        class="form-control" placeholder="0" value="<?php echo $AR_SUM[price]; ?>">
                                                </div>
                                            </div>
                                           <?php if($AR_SUM[property_type] == "Plots"){ ?> 
                                            <div class="col-lg-6 Plot_Show" >
                                                <label for="area-north" class="form-label">Area North (Feet)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20 px-2 py-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v16a2 2 0 0 0 2 2h16c1.11 0 2-.89 2-2V4a2 2 0 0 0-2-2M4 6l2-2h4.9L4 10.9zm0 7.7L13.7 4h4.9L4 18.6zM20 18l-2 2h-4.9l6.9-6.9zm0-7.7L10.3 20H5.4L20 5.4z" />
                                                        </svg></span>
                                                    <input type="number" id="area-north"  name="areanorth"
                                                        class="form-control" placeholder="0" value="<?php echo $AR_SUM[areanorth]; ?>">
                                                </div>
                                            </div>


                                            <div class="col-lg-6 Plot_Show" >
                                                <label for="area-south" class="form-label">Area South (Feet)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20 px-2 py-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v16a2 2 0 0 0 2 2h16c1.11 0 2-.89 2-2V4a2 2 0 0 0-2-2M4 6l2-2h4.9L4 10.9zm0 7.7L13.7 4h4.9L4 18.6zM20 18l-2 2h-4.9l6.9-6.9zm0-7.7L10.3 20H5.4L20 5.4z" />
                                                        </svg></span>
                                                    <input type="number" id="area-south"  name="areasouth"
                                                        class="form-control" placeholder="0" value="<?php echo $AR_SUM[areasouth]; ?>">
                                                </div>
                                            </div>


                                            <div class="col-lg-6 Plot_Show" >
                                                <label for="area-east" class="form-label">Area East (Feet)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20 px-2 py-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v16a2 2 0 0 0 2 2h16c1.11 0 2-.89 2-2V4a2 2 0 0 0-2-2M4 6l2-2h4.9L4 10.9zm0 7.7L13.7 4h4.9L4 18.6zM20 18l-2 2h-4.9l6.9-6.9zm0-7.7L10.3 20H5.4L20 5.4z" />
                                                        </svg></span>
                                                    <input type="number" id="area-east"  name="areaeast"
                                                        class="form-control" placeholder="0" value="<?php echo $AR_SUM[areaeast]; ?>">
                                                </div>
                                            </div>


                                            <div class="col-lg-6 Plot_Show" >
                                                <label for="area-west" class="form-label">Area West (Feet)</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20 px-2 py-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="currentColor" d="M20 2H4c-1.1 0-2 .9-2 2v16a2 2 0 0 0 2 2h16c1.11 0 2-.89 2-2V4a2 2 0 0 0-2-2M4 6l2-2h4.9L4 10.9zm0 7.7L13.7 4h4.9L4 18.6zM20 18l-2 2h-4.9l6.9-6.9zm0-7.7L10.3 20H5.4L20 5.4z" />
                                                        </svg></span>
                                                    <input type="number" id="area-west"  name="areawest"
                                                        class="form-control" placeholder="0" value="<?php echo $AR_SUM[areawest]; ?>">
                                                </div>
                                            </div>
                                             <?php }; ?>
                                              <div class="col-lg-12" >
                                                <div class="mb-3">
                                                    <label for="property-address" class="form-label">Property
                                                        Near By</label>
                                                    <textarea class="form-control" id="property-near-by"  name="propertynearby"
                                                        rows="3" placeholder="Enter Near By"><?php echo $AR_SUM[propertynearby]; ?></textarea>
                                                </div>
                                            </div>
                           
                                           

                                             <div class="col-lg-12">
                                                
                                                       <div class="mb-3">
                                                            <label for="property-address" class="form-label">Property
                                                                 Address</label>
                                                            <textarea class="form-control" id="property-address"    name="propertyaddress" 
                                                                 rows="3" placeholder="Enter address"><?php echo $AR_SUM[address]; ?></textarea>
                                                       </div>
                                                
                                             </div>
                                             
                                             
                                               <div class="col-lg-12" >
                                                <div class="mb-3">
                                                    <label for="property-description" class="form-label">Description</label>
                                                    <textarea class="form-control" id="property-description"  name="propertydescription"
                                                        rows="3" placeholder="Enter address"><?php echo $AR_SUM[propertydescription]; ?></textarea>
                                                </div>
                                            </div>
                                            
                                            
                                             <!--<div class="col-lg-4">-->
                                                  
                                             <!--          <div class="mb-3">-->
                                             <!--               <label for="property-zipcode"-->
                                             <!--                    class="form-label">Zip-Code</label>-->
                                             <!--               <input type="number" id="property-zipcode"   value="<?php // echo $AR_SUM[property_location_zipcode]; ?>" name="propertyzipcode" -->
                                             <!--                    class="form-control" placeholder="zip-code">-->
                                             <!--          </div>-->
                                                 
                                             <!--</div>-->
                                             <!--<div class="col-lg-4">-->
                                                 
                                             <!--          <label for="choices-city" class="form-label">City</label>-->
                                             <!--          <select class="form-control" id="choices-city"   value="<?php // echo $AR_SUM[property_location_city]; ?>" name="propertycity"  data-choices-->
                                             <!--               data-choices-groups data-placeholder="Select City"-->
                                             <!--            >-->
                                             <!--               <option value="">Choose a city</option>-->
                                                           
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Delhi" ? "selected" : "" ; ?> value="Delhi">Delhi</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Mumbai" ? "selected" : "" ; ?> value="Mumbai">Mumbai</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Bengaluru" ? "selected" : "" ; ?> value="Bengaluru">Bengaluru</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Chennai" ? "selected" : "" ; ?> value="Chennai">Chennai</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Kolkata" ? "selected" : "" ; ?> value="Kolkata">Kolkata</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Hyderabad" ? "selected" : "" ; ?> value="Hyderabad">Hyderabad</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Ahmedabad" ? "selected" : "" ; ?> value="Ahmedabad">Ahmedabad</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Pune" ? "selected" : "" ; ?> value="Pune">Pune</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Jaipur" ? "selected" : "" ; ?> value="Jaipur">Jaipur</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Surat" ? "selected" : "" ; ?> value="Surat">Surat</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Kanpur" ? "selected" : "" ; ?> value="Kanpur">Kanpur</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Nagpur" ? "selected" : "" ; ?> value="Nagpur">Nagpur</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Lucknow" ? "selected" : "" ; ?> value="Lucknow">Lucknow</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Visakhapatnam" ? "selected" : "" ; ?> value="Visakhapatnam">Visakhapatnam</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Thane" ? "selected" : "" ; ?> value="Thane">Thane</option>-->
                                             <!--                   <option   <?php // echo $AR_SUM[property_location_city] == "Bhopal" ? "selected" : "" ; ?> value="Bhopal">Bhopal</option>-->

                                                          
                                             <!--          </select>-->
                                                 
                                             <!--</div>-->
                                             <!--<div class="col-lg-4">-->
                                                
                                             <!--          <label for="choices-country" class="form-label">Country</label>-->
                                             <!--          <select class="form-control" id="choices-country"  name="propertycountry"  data-choices-->
                                             <!--               data-choices-groups data-placeholder="Select Country"-->
                                             <!--            >-->
                                             <!--               <option value="">Choose a country</option>-->
                                             <!--               <optgroup label="">-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "India" ? "selected" : "" ; ?> value="India">India</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "United Kingdom" ? "selected" : "" ; ?> value="United Kingdom">United Kingdom</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "France" ? "selected" : "" ; ?> value="France">France</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "Netherlands" ? "selected" : "" ; ?> value="Netherlands">Netherlands</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "United" ? "selected" : "" ; ?> value="United States">United States</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "Denmark" ? "selected" : "" ; ?> value="Denmark">Denmark</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "Canada" ? "selected" : "" ; ?> value="Canada">Canada</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "Australia" ? "selected" : "" ; ?> value="Australia">Australia</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "India" ? "selected" : "" ; ?> value="India">India</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "Germany" ? "selected" : "" ; ?> value="Germany">Germany</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "Spain" ? "selected" : "" ; ?> value="Spain">Spain</option>-->
                                             <!--                       <option <?php // echo $AR_SUM[property_location_country] == "United Arab Emirates" ? "selected" : "" ; ?> value="United Arab Emirates">United Arab Emirates</option>-->

                                             <!--               </optgroup>-->
                                             <!--          </select>-->
                                                 
                                             <!--</div>-->
                                             
                                             
                                             
                                             
                                            <!--<div class="col-lg-6">-->
                                                 
                                            <!--           <label for="property-price" class="form-label">Total Price</label>-->
                                            <!--           <div class="input-group mb-3">-->
                                            <!--                <span class="input-group-text fs-20 px-2 py-0"><i-->
                                            <!--                          class="ri-money-dollar-circle-line"></i></span>-->
                                            <!--                <input type="number" id="property-price"   value="<?php // echo $AR_SUM[price]; ?>" name="propertyprice" -->
                                            <!--                     class="form-control" placeholder="0">-->
                                            <!--           </div>-->
                                                
                                            <!-- </div>-->
                                             
                                            <div class="col-lg-6">
                                                 
                                                       <label for="property-for" class="form-label">Price Type</label>
                                                       <select class="form-control" id="property-for"  name="propertypricetype"  data-choices 
                                                            data-choices-groups data-placeholder="Select Categories" >
                                                            <option value="Dollar"  <?php echo $AR_SUM[pricetype] == "Dollar" ? "selected" : "" ; ?> >Dollar</option>
                                                            <option value="Lakh"  <?php echo $AR_SUM[pricetype] == "Lakh" ? "selected" : "" ; ?> >Lakh</option>
                                                            <option value="Thoushand" <?php echo $AR_SUM[pricetype] == "Thoushand" ? "selected" : "" ; ?> >Thoushand</option>
                                                            <option value="Rupee" <?php echo $AR_SUM[pricetype] == "Rupee" ? "selected" : "" ; ?> >Rupee</option>
                                                            <option value="Other" <?php echo $AR_SUM[pricetype] == "Other" ? "selected" : "" ; ?> >Other</option>
                                                       </select>
                                                 
                                             </div>
                                             

                                                <div class="col-lg-4">
                                                       <div class="mb-3">
                                                            <label for="property_count"
                                                                 class="form-label">Property Count</label>
                                                            <input type="number" id="property_count"   value="<?php echo $AR_SUM[property_count]; ?>" name="property_count" 
                                                                 class="form-control" placeholder="Property Count">
                                                       </div>
                                             </div>
                                             
                                              <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="link-upload"
                                                        class="form-label">Link Upload</label>
                                                    <input type="text" id="link-upload"  name="propertyuploadLinkMap"
                                                        class="form-control" placeholder="Link Upload" value="<?php echo $AR_SUM[propertyuploadLinkMap]; ?>">
                                                </div>
                                            </div>
                                            
                                              <div class="col-lg-6">
                                              <div class="mb-3">
                                                <label for="link-upload" class="form-label">Upload Image</label>
                                                <input  name="image" type="file" accept="image/*">
                                            </div>
                                            </div>
                                            
                                            
                                            
                                              <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="link-upload" class="form-label">Upload Pdf</label>
                                                    <input  name="uploadpdf" type="file" accept="application/pdf" >
                                            </div>
                                            </div>
                                            
                                                           
                                          
                                                           
                                                      </div>
                                                      
                                        </div>
                                   </div>
                              </div>

                              <div class="mb-3 rounded">
                                   <div class="row justify-content-end g-2">
                                        <div class="col-lg-2">
                                        
                                             <input  name="id" type="text" value="<?php echo $AR_SUM[id]; ?>" hidden >
                                              <button type="submit" name="submitcat" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>

                                        </div>
                                       
                                   </div>
                              </div>

                             </form>
                         </div>
                    </div>

               </div>
               <!-- End Container Fluid -->

               <!-- ========== Footer Start ========== -->
               <footer class="footer">
                    <div class="container-fluid">
                         <div class="row">
                              <div class="col-12 text-center">
                                   <script>document.write(new Date().getFullYear())</script> &copy; All Right Reserved
                                   by <a href="#" class="fw-bold footer-text" target="_blank">Stage Onee India</a>
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

     <!-- Vendor Javascript (Require in all Page) -->
     <script src="<?php echo BASE_PATH;?>propertyassets/js/vendorA.js"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="<?php echo BASE_PATH;?>propertyassets/js/appA.js"></script>

</body>

</html>