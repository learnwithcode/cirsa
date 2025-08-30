<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>  


 <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                  <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">
                            <!-- tile -->
                            <section class="tile">
 
                                <!-- tile body -->
                                <div class="tile-body table-custom">

                                    <div class="table-responsive">
                        <div class="col-sm-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Main Menu <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Add / Update  </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                        <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal "  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."operative/pagesadd"; ?>" method="post"> 
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Type Name </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="" name="type_name"  class=" form-control validate[required]" type="text" value="<?php echo $ROW['type_name']; ?>">
              </div>
            </div>

            <div class="form-group">
                                 <label for="exampleFormControlSelect1">Select Input</label>
                                 <select class="form-control col-xs-10 col-sm-9" name="icon_id" >
                                     <?php echo DisplayCombo($ROW['icon_id'],"FONT_AWSOME"); ?>
                                 </select>
                              </div>
          
            <div class="space-4"></div>
            
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right">Display Order</label>
              <div class="col-sm-9"> 
                    <input id="form-field-1" class="form-control" name="order_id" type="text" value="<?php echo $ROW['order_id']; ?>">
         </div>
            </div>
            <div class="space-4"></div>
            
            <div class="clearfix form-action">
              <div class="col-md-offset-3 col-md-9">
          <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
        <input type="hidden" name="ptype_id" id="ptype_id" value="<?php echo $ROW['ptype_id']; ?>">
                <button type="submit" name="submitMenu" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
                     
                <button onClick="window.location.href='<?php echo ADMIN_PATH."operative/pagestype"; ?>'"  class="btn" type="button"> <i class="ace-icon fa fa-undo bigger-110"></i> Cancel </button>
              </div>
            </div>
          </form>
          <!-- PAGE CONTENT ENDS -->
                     </div>
                  </div>
               </div>              
               
                                    </div>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
                        </div>
                        <!-- /col -->






                    </div>
                    <!-- /row -->
            </div>
         </div>


         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
