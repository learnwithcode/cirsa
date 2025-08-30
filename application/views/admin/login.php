<?php

$model = new OperationModel();
 ?>



<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

        <!-- Sign in Start -->
        <section class="sign-in-page">
          <div id="container-inside">
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
              <div class="cube"></div>
          </div>
            <div class="container p-0">
                <div class="row no-gutters height-self-center">
                  <div class="col-sm-12 align-self-center bg-primary rounded">
                    <div class="row m-0">
                      <div class="col-md-8 bg-white sign-in-page-data">
                          <div class="sign-in-from">
                           <center><img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" style="width: 200px;height: 150px;" /></center>
                              <h1 class="mb-0 text-center"><?php echo ADMIN_Name; ?></h1>
                               <?php echo get_message(); ?>
                              <form action="<?php echo  ADMIN_PATH; ?>login/loginhandler" method="post" name="form-login" id="form-login">

                        <div class="form-group">
                           <input type="text" class="form-control" placeholder="Admin Username" name="user_name" id="user_name" / required>
                        </div>

                        <div class="form-group">
                           <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Admin Password" / required>
                        </div>

                        <div class="form-group text-left mt-20" style="float: right;">
                           <button type="submit"  name="loginSubmit" value="1" class="width-35 pull-right btn btn-sm btn-primary">
                                                            <i class="ace-icon fa fa-key"></i>
                                                            <span class="bigger-110"><strong>Login</strong></span>
                                                        </button>
                           
                        </div>

                    </form>
                           </p>
                          </div>
                      </div>
                      <div class="col-md-4 text-center sign-in-page-image">
                          <div class="sign-in-detail text-white">
                         
                              <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                  <div class="item">
                                      <img src="<?php echo BASE_PATH; ?>assets/images/page-img/p1.jpg" class="img-fluid mb-4" alt="logo">
                                      
                                  </div>
                                  <div class="item">
                                      <img src="<?php echo BASE_PATH; ?>assets/images/page-img/p1.jpg" class="img-fluid mb-4" alt="logo"> 
                                     
                                  </div>
                                  <div class="item">
                                      <img src="<?php echo BASE_PATH; ?>assets/images/page-img/p1.jpg" class="img-fluid mb-4" alt="logo">
                                     
                                  </div>
                              </div>
                          </div>
                      </div> 
                    </div>
                  </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->
         <!-- color-customizer -->
       <div class="iq-colorbox color-fix">
           <div class="buy-button"> <a class="color-full" href="#"><i class="fa fa-spinner fa-spin"></i></a> </div>
           <div class="clearfix color-picker">
               <h3 class="iq-font-black">FinDash Awesome Color</h3>
               <p>This color combo available inside whole template. You can change on your wish, Even you can create your own with limitless possibilities! </p>
               <ul class="iq-colorselect clearfix">
                   <li class="color-1 iq-colormark" data-style="color-1"></li>
                   <li class="color-2" data-style="iq-color-2"></li>
                   <li class="color-3" data-style="iq-color-3"></li>
                   <li class="color-4" data-style="iq-color-4"></li>
                   <li class="color-5" data-style="iq-color-5"></li>
                   <li class="color-6" data-style="iq-color-6"></li>
                   <li class="color-7" data-style="iq-color-7"></li>
                   <li class="color-8" data-style="iq-color-8"></li>
                   <li class="color-9" data-style="iq-color-9"></li>
                   <li class="color-10" data-style="iq-color-10"></li>
                   <li class="color-11" data-style="iq-color-11"></li>
                   <li class="color-12" data-style="iq-color-12"></li>
                   <li class="color-13" data-style="iq-color-13"></li>
                   <li class="color-14" data-style="iq-color-14"></li>
                   <li class="color-15" data-style="iq-color-15"></li>
                   <li class="color-16" data-style="iq-color-16"></li>
                   <li class="color-17" data-style="iq-color-17"></li>
                   <li class="color-18" data-style="iq-color-18"></li>
                   <li class="color-19" data-style="iq-color-19"></li>
                   <li class="color-20" data-style="iq-color-20"></li>
               </ul>
               <a target="_blank" class="btn btn-primary d-block mt-3" href="#">Purchase Now</a>
           </div>
       </div>




  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>            
