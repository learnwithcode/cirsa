<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $model = new OperationModel();
   // $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
    // $QR_PAGES= "SELECT * FROM  tbl_property  WHERE 1   ";
    //  print_r($SrchQ);die;
    $PageVal = DisplayPagesProperty($QR_PAGES, 9, $Page, $SrchQ);  
    
  
 ?>
 
 
 
 
<!DOCTYPE html>
<html lang="en">

<head>
     <!-- Title Meta -->
     <meta charset="utf-8" />
     <title>Latest Property | Stage Onee India</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="A fully responsive premium admin dashboard template, Real Estate Management Admin Template" />
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
</head>

<body>

     <!-- START Wrapper -->
     <div class="wrapper">

          <!-- ========== Topbar Start ========== -->
          <header class="">
               <div class="topbar">
                    <div class="container-fluid">
                         <div class="navbar-header">
                              <div class="d-flex align-items-center gap-2">
                                  <a href="<?php echo BASE_PATH;?>userpanel">
                                   <div class="topbar-item">
                                        <button type="button" class="button-toggle-menu topbar-button">
                                             <i class="ri-menu-2-line fs-24"></i>
                                        </button>
                                   </div>
                                        </a>
                                    Property Search
                                   <form action="<?php echo generateSeoUrlMember("report", "property", array()); ?>" method="GET">
                                            <input type="search" name="query" placeholder="Search properties..." value="<?php echo $SrchQ ?>">
                                            <input type="hidden" name="page" value="<?php echo $Page; ?>">
                                            <button type="submit" class="btn btn-primary" >Search</button>
                                        </form>
                              </div>

                              <!--<div class="d-flex align-items-center gap-1">-->
                              <!--      Theme Color (Light/Dark) -->
                              <!--     <div class="topbar-item">-->
                              <!--          <button type="button" class="topbar-button" id="light-dark-mode">-->
                              <!--               <i class="ri-moon-line fs-24 light-mode"></i>-->
                              <!--               <i class="ri-sun-line fs-24 dark-mode"></i>-->
                              <!--          </button>-->
                              <!--     </div>-->

                              <!--      Category -->
                              <!--     <div class="dropdown topbar-item d-none d-lg-flex">-->
                              <!--          <button type="button" class="topbar-button" data-toggle="fullscreen">-->
                              <!--               <i class="ri-fullscreen-line fs-24 fullscreen"></i>-->
                              <!--               <i class="ri-fullscreen-exit-line fs-24 quit-fullscreen"></i>-->
                              <!--          </button>-->
                              <!--     </div>-->

                              <!--      Notification -->


                              <!--      Theme Setting -->
                              <!--     <div class="topbar-item d-none d-md-flex">-->
                              <!--          <button type="button" class="topbar-button" id="theme-settings-btn"-->
                              <!--               data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"-->
                              <!--               aria-controls="theme-settings-offcanvas">-->
                              <!--               <i class="ri-settings-4-line fs-24"></i>-->
                              <!--          </button>-->
                              <!--     </div>-->

                              <!--      User -->
                              <!--     <div class="dropdown topbar-item">-->
                              <!--          <a type="button" class="topbar-button" id="page-header-user-dropdown"-->
                              <!--               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                              <!--               <span class="d-flex align-items-center">-->
                              <!--                    <img class="rounded-circle" width="32"-->
                              <!--                         src="<?php echo BASE_PATH; ?>propertyassets/images/users/avatar-1.jpg" alt="avatar-3">-->
                              <!--               </span>-->
                              <!--          </a>-->
                              <!--          <div class="dropdown-menu dropdown-menu-end">-->
                              <!--                item-->
                              <!--               <h6 class="dropdown-header">Welcome Stage Onee!</h6>-->

                              <!--               <a class="dropdown-item" href="#">-->
                              <!--                    <i class='bx bxs-user-circle align-middle me-2 fs-18'></i>-->
                              <!--                    <span class="align-middle">Profile</span>-->
                              <!--               </a>-->
                              <!--               <a class="dropdown-item" href="messages.html">-->
                              <!--                    <iconify-icon icon="solar:help-broken"-->
                              <!--                         class="align-middle me-2 fs-18"></iconify-icon><span-->
                              <!--                         class="align-middle">Support</span>-->
                              <!--               </a>-->
                              <!--               <div class="dropdown-divider my-1"></div>-->

                              <!--               <a class="dropdown-item text-danger" href="signin.html">-->
                              <!--                    <iconify-icon icon="solar:logout-3-broken"-->
                              <!--                         class="align-middle me-2 fs-18"></iconify-icon><span-->
                              <!--                         class="align-middle">Logout</span>-->
                              <!--               </a>-->
                              <!--          </div>-->
                              <!--     </div>-->
                              <!--</div>-->
                         </div>
                    </div>
               </div>
          </header>
          <!-- Right Sidebar (Theme Settings) -->
          <!--<div>-->
          <!--     <div class="offcanvas offcanvas-end border-0 rounded-start-4 overflow-hidden" tabindex="-1" id="theme-settings-offcanvas">-->
          <!--          <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">-->
          <!--               <h5 class="text-white m-0">Theme Settings</h5>-->
          <!--               <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>-->
          <!--          </div>-->

          <!--          <div class="offcanvas-body p-0">-->
          <!--               <div data-simplebar class="h-100">-->
          <!--                    <div class="p-3 settings-bar">-->

          <!--                         <div>-->
          <!--                              <h5 class="mb-3 font-16 fw-semibold">Color Scheme</h5>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-light" value="light">-->
          <!--                                   <label class="form-check-label" for="layout-color-light">Light</label>-->
          <!--                              </div>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-bs-theme" id="layout-color-dark" value="dark">-->
          <!--                                   <label class="form-check-label" for="layout-color-dark">Dark</label>-->
          <!--                              </div>-->
          <!--                         </div>-->

          <!--                         <div>-->
          <!--                              <h5 class="my-3 font-16 fw-semibold">Topbar Color</h5>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-light" value="light">-->
          <!--                                   <label class="form-check-label" for="topbar-color-light">Light</label>-->
          <!--                              </div>-->
          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-topbar-color" id="topbar-color-dark" value="dark">-->
          <!--                                   <label class="form-check-label" for="topbar-color-dark">Dark</label>-->
          <!--                              </div>-->
          <!--                         </div>-->


          <!--                         <div>-->
          <!--                              <h5 class="my-3 font-16 fw-semibold">Menu Color</h5>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-light" value="light">-->
          <!--                                   <label class="form-check-label" for="leftbar-color-light">-->
          <!--                                        Light-->
          <!--                                   </label>-->
          <!--                              </div>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-menu-color" id="leftbar-color-dark" value="dark">-->
          <!--                                   <label class="form-check-label" for="leftbar-color-dark">-->
          <!--                                        Dark-->
          <!--                                   </label>-->
          <!--                              </div>-->
          <!--                         </div>-->

          <!--                         <div>-->
          <!--                              <h5 class="my-3 font-16 fw-semibold">Sidebar Size</h5>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-default" value="default">-->
          <!--                                   <label class="form-check-label" for="leftbar-size-default">-->
          <!--                                        Default-->
          <!--                                   </label>-->
          <!--                              </div>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small" value="condensed">-->
          <!--                                   <label class="form-check-label" for="leftbar-size-small">-->
          <!--                                        Condensed-->
          <!--                                   </label>-->
          <!--                              </div>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-hidden" value="hidden">-->
          <!--                                   <label class="form-check-label" for="leftbar-hidden">-->
          <!--                                        Hidden-->
          <!--                                   </label>-->
          <!--                              </div>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small-hover-active" value="sm-hover-active">-->
          <!--                                   <label class="form-check-label" for="leftbar-size-small-hover-active">-->
          <!--                                        Small Hover Active-->
          <!--                                   </label>-->
          <!--                              </div>-->

          <!--                              <div class="form-check mb-2">-->
          <!--                                   <input class="form-check-input" type="radio" name="data-menu-size" id="leftbar-size-small-hover" value="sm-hover">-->
          <!--                                   <label class="form-check-label" for="leftbar-size-small-hover">-->
          <!--                                        Small Hover-->
          <!--                                   </label>-->
          <!--                              </div>-->
          <!--                         </div>-->

          <!--                    </div>-->
          <!--               </div>-->
          <!--          </div>-->
          <!--          <div class="offcanvas-footer border-top p-3 text-center">-->
          <!--               <div class="row">-->
          <!--                    <div class="col">-->
          <!--                         <button type="button" class="btn btn-danger w-100" id="reset-layout">Reset</button>-->
          <!--                    </div>-->
          <!--               </div>-->
          <!--          </div>-->
          <!--     </div>-->
          <!--</div>-->
          <!-- ========== Topbar End ========== -->


          <!-- ==================================================== -->
          <!-- Start right Content here -->
          <!-- ==================================================== -->
          <div class="page-content">

               <!-- Start Container Fluid -->
               <div class="container-fluid">

                    <!-- ========== Page Title Start ========== -->
                    <!--<div class="row">-->
                    <!--    <div class="col-12">-->
                    <!--        <div class="page-title-box">-->
                    <!--            <h4 class="mb-0 fw-semibold">Latest Properties</h4>-->
                    <!--            <ol class="breadcrumb mb-0">-->
                    <!--                <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>-->
                    <!--                <li class="breadcrumb-item active">Listing Grid</li>-->
                    <!--            </ol>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                     <!--<div class="row">-->
                    <!--    <div class="col-12">-->
                    <!--        <div class="page-title-box">-->
                    <!--            <h4 class="mb-0 fw-semibold">Latest Properties</h4>-->
                    <!--            <ol class="breadcrumb mb-0">-->
                    <!--                <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>-->
                    <!--                <li class="breadcrumb-item active">Listing Grid</li>-->
                    <!--            </ol>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!-- ========== Page Title End ========== -->

                    <div class="row">
                         <!--<div class="col-xl-3 col-lg-12">-->
                         <!--     <div class="card">-->
                         <!--          <div class="card-header border-bottom">-->
                         <!--               <div>-->
                         <!--                    <h4 class="card-title">Properties</h4>-->
                         <!--                    <p class="mb-0">Show 15,780 Properties</p>-->
                         <!--               </div>-->
                         <!--          </div>-->
                         <!--          <div class="card-body border-light">-->
                         <!--               <form>-->
                         <!--                    <label for="choices-single-groups" class="form-label">Properties Location</label>-->
                         <!--                    <select class="form-control" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select City" name="choices-single-groups">-->
                         <!--                         <option value="">Choose a city</option>-->
                         <!--                         <optgroup label="UK">-->
                         <!--                              <option value="London">London</option>-->
                         <!--                              <option value="Manchester">Manchester</option>-->
                         <!--                              <option value="Liverpool">Liverpool</option>-->
                         <!--                         </optgroup>-->
                         <!--                         <optgroup label="FR">-->
                         <!--                              <option value="Paris">Paris</option>-->
                         <!--                              <option value="Lyon">Lyon</option>-->
                         <!--                              <option value="Marseille">Marseille</option>-->
                         <!--                         </optgroup>-->
                         <!--                         <optgroup label="DE" disabled>-->
                         <!--                              <option value="Hamburg">Hamburg</option>-->
                         <!--                              <option value="Munich">Munich</option>-->
                         <!--                              <option value="Berlin">Berlin</option>-->
                         <!--                         </optgroup>-->
                         <!--                         <optgroup label="US">-->
                         <!--                              <option value="New York">New York</option>-->
                         <!--                              <option value="Washington" disabled>Washington</option>-->
                         <!--                              <option value="Michigan">Michigan</option>-->
                         <!--                         </optgroup>-->
                         <!--                         <optgroup label="SP">-->
                         <!--                              <option value="Madrid">Madrid</option>-->
                         <!--                              <option value="Barcelona">Barcelona</option>-->
                         <!--                              <option value="Malaga">Malaga</option>-->
                         <!--                         </optgroup>-->
                         <!--                         <optgroup label="CA">-->
                         <!--                              <option value="Montreal">Montreal</option>-->
                         <!--                              <option value="Toronto">Toronto</option>-->
                         <!--                              <option value="Vancouver">Vancouver</option>-->
                         <!--                         </optgroup>-->
                         <!--                    </select>-->

                         <!--                    <div class="mb-3">-->
                         <!--                         <label for="typeplace" class="form-label">Type Of Place</label>-->
                         <!--                         <input type="text" id="typeplace" class="form-control">-->
                         <!--                    </div>-->
                         <!--               </form>-->
                         <!--               <h5 class="text-dark fw-medium my-3">Custom Price Range :</h5>-->
                         <!--               <div id="product-price-range" [data-slider-size="md" ] class=""></div>-->
                         <!--               <div class="formCost d-flex gap-2 align-items-center mt-3">-->
                         <!--                    <input class="form-control form-control-sm text-center" type="text" id="minCost" value="0">-->
                         <!--                    <span class="fw-semibold text-muted">to</span>-->
                         <!--                    <input class="form-control form-control-sm text-center" type="text" id="maxCost" value="1000">-->
                         <!--               </div>-->
                         <!--               <h5 class="text-dark fw-medium my-3">Accessibility Features :</h5>-->
                         <!--               <div class="row g-1">-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck11">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck11">-->
                         <!--                                   For Rent-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck12">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck12">-->
                         <!--                                   For Sale-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--               </div>-->
                         <!--               <h5 class="text-dark fw-medium my-3">Properties Type :</h5>-->
                         <!--               <div class="row g-1">-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck" checked>-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck">-->
                         <!--                                   All Properties-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Cottage-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Villas-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Apartment-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Duplex Bungalow-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--               </div>-->
                         <!--               <h5 class="text-dark fw-medium my-3">Bedrooms :</h5>-->
                         <!--               <div class="" role="group" aria-label="Basic checkbox toggle button group">-->
                         <!--                    <input type="checkbox" class="btn-check" id="btncheck1">-->
                         <!--                    <label class="btn btn-outline-primary" for="btncheck1">1 BHK</label>-->

                         <!--                    <input type="checkbox" class="btn-check" id="btncheck2">-->
                         <!--                    <label class="btn btn-outline-primary" for="btncheck2">2 BHK</label>-->

                         <!--                    <input type="checkbox" class="btn-check" id="btncheck3" checked>-->
                         <!--                    <label class="btn btn-outline-primary" for="btncheck3">3 BHK</label>-->

                         <!--                    <input type="checkbox" class="btn-check" id="btncheck4">-->
                         <!--                    <label class="btn btn-outline-primary my-1" for="btncheck4">4 & 5 BHK</label>-->

                         <!--               </div>-->
                         <!--               <h5 class="text-dark fw-medium my-3">Accessibility Features :</h5>-->
                         <!--               <div class="row g-1">-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck5">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Balcony-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck6">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Parking-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck7">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Spa-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck8">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Pool-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck9">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Restaurant-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--                    <div class="col-lg-6">-->
                         <!--                         <div class="mb-2">-->
                         <!--                              <input class="form-check-input" type="checkbox" value="" id="defaultCheck10">-->
                         <!--                              <label class="form-check-label ms-1" for="defaultCheck1">-->
                         <!--                                   Fitness Club-->
                         <!--                              </label>-->
                         <!--                         </div>-->
                         <!--                    </div>-->
                         <!--               </div>-->
                         <!--          </div>-->
                         <!--          <div class="card-footer">-->
                         <!--               <a href="#!" class="btn btn-primary w-100">Apply</a>-->
                         <!--          </div>-->
                         <!--     </div>-->
                         <!--</div>-->

                         <div class="col-xl-12 col-lg-12">
                              <div class="row">
                                   <!--<div class="col-lg-4 col-md-6">-->
                                   <!--     <div class="card overflow-hidden">-->
                                   <!--          <div class="position-relative">-->
                                   <!--               <img src="<?php echo BASE_PATH; ?>propertyassets/images/properties/p-1.jpg" alt="" class="img-fluid rounded-top">-->
                                   <!--               <span class="position-absolute top-0 start-0 p-1">-->
                                   <!--                    <button type="button" class="btn btn-warning avatar-sm d-inline-flex align-items-center justify-content-center fs-20 rounded text-light"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></button>-->
                                   <!--               </span>-->
                                   <!--               <span class="position-absolute top-0 end-0 p-1">-->
                                   <!--                    <span class="badge bg-success text-white fs-13">For Rent</span>-->
                                   <!--               </span>-->
                                   <!--          </div>-->
                                   <!--          <div class="card-body">-->
                                   <!--               <div class="d-flex align-items-center gap-2">-->
                                   <!--                    <div class="avatar bg-light rounded">-->
                                   <!--                         <iconify-icon icon="solar:home-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>-->
                                   <!--                    </div>-->
                                   <!--                    <div>-->
                                   <!--                         <a href="#!" class="text-dark fw-medium fs-16">Dvilla Residences Batu</a>-->
                                   <!--                         <p class="text-muted mb-0">4604 , Philli Lane-->
                                   <!--                              Kiowa</p>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->
                                   <!--               <div class="row mt-2 g-2">-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              5 Beds-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              4 Bath-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1400ft-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              3 Floor-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->

                                   <!--          </div>-->
                                   <!--          <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">-->
                                   <!--               <p class="fw-medium text-dark fs-16 mb-0">$8,930.00 </p>-->
                                   <!--               <div>-->
                                   <!--                    <a href="#!" class="link-primary fw-medium">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                   <!--               </div>-->
                                   <!--          </div>-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                   <!--<div class="col-lg-4 col-md-6">-->
                                   <!--     <div class="card overflow-hidden">-->
                                   <!--          <div class="position-relative">-->
                                   <!--               <img src="<?php echo BASE_PATH; ?>propertyassets/images/properties/p-2.jpg" alt="" class="img-fluid rounded-top">-->
                                   <!--               <span class="position-absolute top-0 end-0 p-1">-->
                                   <!--                    <span class="badge bg-danger text-white fs-13">Sold</span>-->
                                   <!--               </span>-->
                                   <!--          </div>-->
                                   <!--          <div class="card-body">-->
                                   <!--               <div class="d-flex align-items-center gap-2">-->
                                   <!--                    <div class="avatar bg-light rounded">-->
                                   <!--                         <iconify-icon icon="solar:home-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>-->
                                   <!--                    </div>-->
                                   <!--                    <div>-->
                                   <!--                         <a href="#!" class="text-dark fw-medium fs-16">PIK Villa House</a>-->
                                   <!--                         <p class="text-muted mb-0">127, Boulevard Cockeysville</p>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->
                                   <!--               <div class="row mt-2 g-2">-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              6 Beds-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              5 Bath-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1700ft-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              3 Floor-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->

                                   <!--          </div>-->
                                   <!--          <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">-->
                                   <!--               <p class="fw-medium text-muted text-decoration-line-through fs-16 mb-0">$60,691.00 </p>-->
                                   <!--               <div>-->
                                   <!--                    <a href="#!" class="link-primary fw-medium ">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                   <!--               </div>-->
                                   <!--          </div>-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                   <!--<div class="col-lg-4 col-md-6">-->
                                   <!--     <div class="card overflow-hidden">-->
                                   <!--          <div class="position-relative">-->
                                   <!--               <img src="<?php echo BASE_PATH; ?>propertyassets/images/properties/p-3.jpg" alt="" class="img-fluid rounded-top">-->
                                   <!--               <span class="position-absolute top-0 start-0 p-1">-->
                                   <!--                    <button type="button" class="btn btn-warning avatar-sm d-inline-flex align-items-center justify-content-center fs-20 rounded text-light"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></button>-->
                                   <!--               </span>-->
                                   <!--               <span class="position-absolute top-0 end-0 p-1">-->
                                   <!--                    <span class="badge bg-warning text-white fs-13">For Sale</span>-->
                                   <!--               </span>-->
                                   <!--          </div>-->
                                   <!--          <div class="card-body">-->
                                   <!--               <div class="d-flex align-items-center gap-2">-->
                                   <!--                    <div class="avatar bg-light rounded">-->
                                   <!--                         <iconify-icon icon="solar:home-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>-->
                                   <!--                    </div>-->
                                   <!--                    <div>-->
                                   <!--                         <a href="#!" class="text-dark fw-medium fs-16">Tungis Luxury</a>-->
                                   <!--                         <p class="text-muted mb-0">900 , Creside WI 54913</p>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->
                                   <!--               <div class="row mt-2 g-2">-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              4 Beds-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              3 Bath-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1200ft-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              2 Floor-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->

                                   <!--          </div>-->
                                   <!--          <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">-->
                                   <!--               <p class="fw-medium text-dark fs-16 mb-0">$70,245.00 </p>-->
                                   <!--               <div>-->
                                   <!--                    <a href="#!" class="link-primary fw-medium">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                   <!--               </div>-->
                                   <!--          </div>-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                   <!--<div class="col-lg-4 col-md-6">-->
                                   <!--     <div class="card overflow-hidden">-->
                                   <!--          <div class="position-relative">-->
                                   <!--               <img src="<?php echo BASE_PATH; ?>propertyassets/images/properties/p-4.jpg" alt="" class="img-fluid rounded-top">-->
                                   <!--               <span class="position-absolute top-0 start-0 p-1">-->
                                   <!--                    <button type="button" class="btn bg-warning-subtle avatar-sm d-inline-flex align-items-center justify-content-center fs-20 rounded text-warning"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></button>-->
                                   <!--               </span>-->
                                   <!--               <span class="position-absolute top-0 end-0 p-1">-->
                                   <!--                    <span class="badge bg-success text-white fs-13">For Rent</span>-->
                                   <!--               </span>-->
                                   <!--          </div>-->
                                   <!--          <div class="card-body">-->
                                   <!--               <div class="d-flex align-items-center gap-2">-->
                                   <!--                    <div class="avatar bg-light rounded">-->
                                   <!--                         <iconify-icon icon="solar:buildings-3-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>-->
                                   <!--                    </div>-->
                                   <!--                    <div>-->
                                   <!--                         <a href="#!" class="text-dark fw-medium fs-16">Luxury Apartment</a>-->
                                   <!--                         <p class="text-muted mb-0">223 , Creside Santa Maria</p>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->
                                   <!--               <div class="row mt-2 g-2">-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              2 Beds-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              2 Bath-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              900ft-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1 Floor-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->

                                   <!--          </div>-->
                                   <!--          <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">-->
                                   <!--               <p class="fw-medium text-dark fs-16 mb-0">$5,825.00 </p>-->
                                   <!--               <div>-->
                                   <!--                    <a href="#!" class="link-primary fw-medium">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                   <!--               </div>-->
                                   <!--          </div>-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                   <!--<div class="col-lg-4 col-md-6">-->
                                   <!--     <div class="card overflow-hidden">-->
                                   <!--          <div class="position-relative">-->
                                   <!--               <img src="<?php echo BASE_PATH; ?>propertyassets/images/properties/p-5.jpg" alt="" class="img-fluid rounded-top">-->
                                   <!--               <span class="position-absolute top-0 start-0 p-1">-->
                                   <!--                    <button type="button" class="btn bg-warning-subtle avatar-sm d-inline-flex align-items-center justify-content-center fs-20 rounded text-warning"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></button>-->
                                   <!--               </span>-->
                                   <!--               <span class="position-absolute top-0 end-0 p-1">-->
                                   <!--                    <span class="badge bg-warning text-white fs-13">For Sale</span>-->
                                   <!--               </span>-->
                                   <!--          </div>-->
                                   <!--          <div class="card-body">-->
                                   <!--               <div class="d-flex align-items-center gap-2">-->
                                   <!--                    <div class="avatar bg-light rounded">-->
                                   <!--                         <iconify-icon icon="solar:home-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>-->
                                   <!--                    </div>-->
                                   <!--                    <div>-->
                                   <!--                         <a href="#!" class="text-dark fw-medium fs-16">Weekend Villa MBH</a>-->
                                   <!--                         <p class="text-muted mb-0">980, Jim Rosa Lane Dublin</p>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->
                                   <!--               <div class="row mt-2 g-2">-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              5 Beds-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              5 Bath-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1900ft-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              2 Floor-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->

                                   <!--          </div>-->
                                   <!--          <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">-->
                                   <!--               <p class="fw-medium text-dark fs-16 mb-0">$90,674.00 </p>-->
                                   <!--               <div>-->
                                   <!--                    <a href="#!" class="link-primary fw-medium">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                   <!--               </div>-->
                                   <!--          </div>-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                   <!--<div class="col-lg-4 col-md-6">-->
                                   <!--     <div class="card overflow-hidden">-->
                                   <!--          <div class="position-relative">-->
                                   <!--               <img src="<?php echo BASE_PATH; ?>propertyassets/images/properties/p-6.jpg" alt="" class="img-fluid rounded-top">-->
                                   <!--               <span class="position-absolute top-0 start-0 p-1">-->
                                   <!--                    <button type="button" class="btn btn-warning avatar-sm d-inline-flex align-items-center justify-content-center fs-20 rounded text-light"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></button>-->
                                   <!--               </span>-->
                                   <!--               <span class="position-absolute top-0 end-0 p-1">-->
                                   <!--                    <span class="badge bg-success text-white fs-13">For Rent</span>-->
                                   <!--               </span>-->
                                   <!--          </div>-->
                                   <!--          <div class="card-body">-->
                                   <!--               <div class="d-flex align-items-center gap-2">-->
                                   <!--                    <div class="avatar bg-light rounded">-->
                                   <!--                         <iconify-icon icon="solar:home-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>-->
                                   <!--                    </div>-->
                                   <!--                    <div>-->
                                   <!--                         <a href="#!" class="text-dark fw-medium fs-16">Luxury Penthouse</a>-->
                                   <!--                         <p class="text-muted mb-0">Sumner Street Los Angeles</p>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->
                                   <!--               <div class="row mt-2 g-2">-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              7 Beds-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              6 Bath-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              2000ft-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1 Floor-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->

                                   <!--          </div>-->
                                   <!--          <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">-->
                                   <!--               <p class="fw-medium text-dark fs-16 mb-0">$10,500.00 </p>-->
                                   <!--               <div>-->
                                   <!--                    <a href="#!" class="link-primary fw-medium">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                   <!--               </div>-->
                                   <!--          </div>-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                   <!--<div class="col-lg-4 col-md-6">-->
                                   <!--     <div class="card overflow-hidden">-->
                                   <!--          <div class="position-relative">-->
                                   <!--               <img src="<?php echo BASE_PATH; ?>propertyassets/images/properties/p-7.jpg" alt="" class="img-fluid rounded-top">-->
                                   <!--               <span class="position-absolute top-0 end-0 p-1">-->
                                   <!--                    <span class="badge bg-danger text-white fs-13">Sold</span>-->
                                   <!--               </span>-->
                                   <!--          </div>-->
                                   <!--          <div class="card-body">-->
                                   <!--               <div class="d-flex align-items-center gap-2">-->
                                   <!--                    <div class="avatar bg-light rounded">-->
                                   <!--                         <iconify-icon icon="solar:buildings-3-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>-->
                                   <!--                    </div>-->
                                   <!--                    <div>-->
                                   <!--                         <a href="#!" class="text-dark fw-medium fs-16">Ojiag Duplex House</a>-->
                                   <!--                         <p class="text-muted mb-0">24 Hanover, New York</p>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->
                                   <!--               <div class="row mt-2 g-2">-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              3 Beds-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              3 Bath-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1300ft-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              2 Floor-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->

                                   <!--          </div>-->
                                   <!--          <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">-->
                                   <!--               <p class="fw-medium text-muted text-decoration-line-through fs-16 mb-0">$75,341.00 </p>-->
                                   <!--               <div>-->
                                   <!--                    <a href="#!" class="link-primary fw-medium">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                   <!--               </div>-->
                                   <!--          </div>-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                   <!--<div class="col-lg-4 col-md-6">-->
                                   <!--     <div class="card overflow-hidden">-->
                                   <!--          <div class="position-relative">-->
                                   <!--               <img src="<?php echo BASE_PATH; ?>propertyassets/images/properties/p-8.jpg" alt="" class="img-fluid rounded-top">-->
                                   <!--               <span class="position-absolute top-0 start-0 p-1">-->
                                   <!--                    <button type="button" class="btn bg-warning-subtle avatar-sm d-inline-flex align-items-center justify-content-center fs-20 rounded text-warning"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></button>-->
                                   <!--               </span>-->
                                   <!--               <span class="position-absolute top-0 end-0 p-1">-->
                                   <!--                    <span class="badge bg-warning text-white fs-13">For Sale</span>-->
                                   <!--               </span>-->
                                   <!--          </div>-->
                                   <!--          <div class="card-body">-->
                                   <!--               <div class="d-flex align-items-center gap-2">-->
                                   <!--                    <div class="avatar bg-light rounded">-->
                                   <!--                         <iconify-icon icon="solar:home-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>-->
                                   <!--                    </div>-->
                                   <!--                    <div>-->
                                   <!--                         <a href="#!" class="text-dark fw-medium fs-16">Luxury Bungalow Villas</a>-->
                                   <!--                         <p class="text-muted mb-0">Khale Florence, SC 219</p>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->
                                   <!--               <div class="row mt-2 g-2">-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              4 Beds-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              3 Bath-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1200ft-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1 Floor-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->

                                   <!--          </div>-->
                                   <!--          <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">-->
                                   <!--               <p class="fw-medium text-dark fs-16 mb-0">$54,230.00 </p>-->
                                   <!--               <div>-->
                                   <!--                    <a href="#!" class="link-primary fw-medium">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                   <!--               </div>-->
                                   <!--          </div>-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                   <!--<div class="col-lg-4 col-md-6">-->
                                   <!--     <div class="card overflow-hidden">-->
                                   <!--          <div class="position-relative">-->
                                   <!--               <img src="<?php echo BASE_PATH; ?>propertyassets/images/properties/p-9.jpg" alt="" class="img-fluid rounded-top">-->
                                   <!--               <span class="position-absolute top-0 start-0 p-1">-->
                                   <!--                    <button type="button" class="btn bg-warning-subtle avatar-sm d-inline-flex align-items-center justify-content-center fs-20 rounded text-warning"><iconify-icon icon="solar:bookmark-broken"></iconify-icon></button>-->
                                   <!--               </span>-->
                                   <!--               <span class="position-absolute top-0 end-0 p-1">-->
                                   <!--                    <span class="badge bg-success text-white fs-13">For Rent</span>-->
                                   <!--               </span>-->
                                   <!--          </div>-->
                                   <!--          <div class="card-body">-->
                                   <!--               <div class="d-flex align-items-center gap-2">-->
                                   <!--                    <div class="avatar bg-light rounded">-->
                                   <!--                         <iconify-icon icon="solar:home-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>-->
                                   <!--                    </div>-->
                                   <!--                    <div>-->
                                   <!--                         <a href="#!" class="text-dark fw-medium fs-16">Duplex Bungalow</a>-->
                                   <!--                         <p class="text-muted mb-0">25, Willison Street-->
                                   <!--                              Becker</p>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->
                                   <!--               <div class="row mt-2 g-2">-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              3 Beds-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              3 Bath-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              1800ft-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--                    <div class="col-lg-4 col-4">-->
                                   <!--                         <span class="badge bg-light-subtle text-muted border fs-12">-->
                                   <!--                              <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>-->
                                   <!--                              3 Floor-->
                                   <!--                         </span>-->
                                   <!--                    </div>-->
                                   <!--               </div>-->

                                   <!--          </div>-->
                                   <!--          <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">-->
                                   <!--               <p class="fw-medium text-dark fs-16 mb-0">$14,564.00 </p>-->
                                   <!--               <div>-->
                                   <!--                    <a href="#!" class="link-primary fw-medium">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                   <!--               </div>-->
                                   <!--          </div>-->
                                   <!--     </div>-->
                                   <!--</div>-->
                                   
                                   <?php 
                                   
									foreach($PageVal['ResultSet'] as $AR_DT):
									   // 	print_r($AR_DT);
									    	
                                   	// die();
								?>
                                   <div class="col-lg-4 col-md-6">
                                        <div class="card overflow-hidden">
                                             <div class="position-relative">
                                                  <img src="<?php echo BASE_PATH; ?>/upload/property/<?php echo $AR_DT[image]; ?>" alt="" class="img-fluid rounded-top">
                                                  <span class="position-absolute top-0 end-0 p-1">
                                                       <span class="badge bg-danger text-white fs-13"><?php echo $AR_DT[accessibility_features]; ?></span>
                                                  </span>
                                             </div>
                                             <div class="card-body">
                                                  <div class="d-flex align-items-center gap-2">
                                                       <div class="avatar bg-light rounded">
                                                            <iconify-icon icon="solar:buildings-3-bold-duotone" class="fs-24 text-primary avatar-title"></iconify-icon>
                                                       </div>
                                                       <div>
                                                            <a href="#!" class="text-dark fw-medium fs-16"><?php echo $AR_DT[name]; ?></a>
                                                            <p class="text-muted mb-0"><?php echo $AR_DT[address]; ?></p>
                                                       </div>
                                                  </div>
                                                  <div class="row mt-2 g-2">
                                                         <?php if($AR_DT[property_type] != "Plots"){ ?> 
                                                       <div class="col-lg-4 col-4">
                                                            <span class="badge bg-light-subtle text-muted border fs-12">
                                                                 <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>
                                                                 <?php echo $AR_DT[bed]; ?> Beds
                                                            </span>
                                                       </div>
                                                       <div class="col-lg-4 col-4">
                                                            <span class="badge bg-light-subtle text-muted border fs-12">
                                                                 <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>
                                                                  <?php echo $AR_DT[bath]; ?> Bath
                                                            </span>
                                                       </div>
                                                       <div class="col-lg-4 col-4">
                                                            <span class="badge bg-light-subtle text-muted border fs-12">
                                                                 <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>
                                                                 <?php echo $AR_DT[flore]; ?> Floor
                                                            </span>
                                                       </div>
                                                       
                                                       
                                                        <div class="col-lg-4 col-4">
                                                            <span class="badge bg-light-subtle text-muted border fs-12">
                                                                 <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>
                                                                  <?php echo $AR_DT[hall]; ?> Hall
                                                            </span>
                                                       </div>
                                                       <div class="col-lg-4 col-4">
                                                            <span class="badge bg-light-subtle text-muted border fs-12">
                                                                 <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>
                                                                 <?php echo $AR_DT[kitchen]; ?> kitchen
                                                            </span>
                                                       </div>
                                                       
                                                       
                                                         <div class="col-lg-4 col-4">
                                                            <span class="badge bg-light-subtle text-muted border fs-12">
                                                                 <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>
                                                                  <?php echo $AR_DT[builderarea]; ?> Builder Area
                                                            </span>
                                                       </div>
                                                       <div class="col-lg-4 col-4">
                                                            <span class="badge bg-light-subtle text-muted border fs-12">
                                                                 <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>
                                                                 <?php echo $AR_DT[carpetarea]; ?> Carpet Area
                                                            </span>
                                                       </div>
                                                       
                                                       
                                                       <div class="col-lg-4 col-4">
                                                                <span class="badge bg-light-subtle text-muted border fs-12">
                                                                     <span class="fs-16"></span>
                                                                        Total :- <?php echo $AR_DT[pricetype]; ?> 
                                                                        <?php   echo $AR_DT[price]; ?> 
                                                                </span>
                                                        </div>
                                                       
                                                       
                                                       <?php }; ?>
                                                       
                                                       
                                                       
                                                        <?php if($AR_DT[property_type] == "Plots"){ ?> 
                                                           <div class="col-lg-4 col-4">
                                                                <span class="badge bg-light-subtle text-muted border fs-12">
                                                                     <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>
                                                                        <?php echo $AR_DT[blockno]; ?>  Block No
                                                                </span>
                                                           </div>
                                                           
                                                           <div class="col-lg-4 col-4">
                                                                <span class="badge bg-light-subtle text-muted border fs-12">
                                                                     <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>
                                                                     <?php echo $AR_DT[plotno]; ?>  Plot No
                                                                </span>
                                                           </div>
                                                           
                                                           <div class="col-lg-4 col-4">
                                                                <span class="badge bg-light-subtle text-muted border fs-12">
                                                                     <span class="fs-16"></span>
                                                                        Total :- <?php echo $AR_DT[pricetype]; ?> 
                                                                        <?php  
                                                                        
                                                                           $AR_DT_price =  (($AR_DT[areasouth] + $AR_DT[areanorth]) * ($AR_DT[areaeast] + $AR_DT[areawest])) / 2 ;
                                                                       
                                                                            echo $AR_DT[price] * $AR_DT_price;
                                                                        ?> 
                                                                </span>
                                                           </div>
                                                       <?php }; ?>
                                                       
                                                  </div>

                                             </div>
                                             <div class="card-footer bg-light-subtle d-flex justify-content-between align-items-center border-top">
                                                  <!--<p class="fw-medium text-muted text-decoration-line-through fs-16 mb-0"><?php // echo $AR_DT[pricetype]; ?>  <?php // echo $AR_DT[price]; ?> </p>-->
                                                    
                                                   <p class="fw-medium text-muted fs-16 mb-0">Description <?php echo $AR_DT[propertydescription]; ?></p>
                                                   <p class="fw-medium text-muted fs-16 mb-0"><?php echo $AR_DT[propertynearby]; ?></p>
                                                   
                                                   
                                                    <?php if($AR_DT[propertyuploadLinkMap] != "null" && $AR_DT[propertyuploadLinkMap] != "" ){ ?>
                                                   <p class="fw-medium text-muted fs-16 mb-0"><a href="<?php echo $AR_DT[propertyuploadLinkMap]; ?>" target="_blank" >Map Link</a></p>
                                                    <?php }; ?>
                                                    
                                                    <?php if($AR_DT[uploadpdf] != "null" && $AR_DT[uploadpdf] != "" ){ ?>
                                                    <p class="fw-medium text-muted fs-16 mb-0"><a href="<?php echo BASE_PATH; ?>upload/property/<?php echo $AR_DT[uploadpdf]; ?>" target="_blank" >PDF </a></p>
                                                    <?php }; ?>
                                                    
                                                  <!--<div>-->
                                                  <!--     <a href="#!" class="link-primary fw-medium">More Inquiry <i class='ri-arrow-right-line align-middle'></i></a>-->
                                                  <!--</div>-->
                                             </div>
                                        </div>
                                   </div>
                                     <?php ; endforeach; ?>
                              </div>

                              <div class="p-3 border-top">
                                  <div class="row pagination justify-content-end mb-0">
                                    <div class="col-md-6">
                                    <div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
                                    </div></div>
                                    
                                    <div class="col-md-6">
                                    <nav aria-label="Page navigation mb-3">
                                     <ul class="pagination justify-content-center">
                                      <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                              </div>
                         </div>
                    </div>                   
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
     <script src="<?php echo BASE_PATH; ?>propertyassets/js/vendorA.js"></script>

     <!-- App Javascript (Require in all Page) -->
     <script src="<?php echo BASE_PATH; ?>propertyassets/js/appA.js"></script>

     <script src="<?php echo BASE_PATH; ?>propertyassets/js/pages/property-grid.js"></script>

</body>

</html>