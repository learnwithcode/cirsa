<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

$url = $this->uri->segment(1);
if($url == 'superadmin')
{
 $path =    ADMIN_PATH;
}
elseif($url =='courier')
{
    $path = COURIER_PATH;
}
else
{
    $path =    ADMIN_PATH; 
}

?>


     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>  

<style>
   
.table td, .table th {
    padding: 5px;
}
</style>
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

                                    
                                     <!-- tile body -->
                              <div class="row">

          <div class="col-lg-12">
            <div class="row">
                
                          <?php get_message(); ?>
              <div class="col-lg-12">
                  <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Website <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp;Member Dashboard Slider Add </small>  </h4>
                        </div>
                       
                     </div>
                       <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
                         <a  href="<?php echo generateSeoUrlAdmin("website","memberdashbaordadd",""); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class=" btn btn-white btn-primary btn-bold"><span><i class="fa fa-plus bigger-110 blue"></i> <span class="">Add New Popup</span></span></a> 
                  
                    
                     </div>
                </div>
              </div>
                 
        
                
                <div class="clearfix">&nbsp;</div>
                        <form class="form-horizontal" enctype='multipart/form-data'  name="form-page" id="form-page" action="<?php echo $path."website/memberdashbaordadd"; ?>" method="post"> 

            <div class="form-group">
                <code>Images Size Should be 1080 px width * 130px Height Pixel</code> <br>
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Image </label>
              <div class="col-sm-9">
                <input type="file" name="popup" accept="image/x-png,image/gif,image/jpeg,image/jpg" <?php if($ROW['popup_id'] > 0) { ?> <?php } ?>>
              </div>
            </div>
          
                <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>
              <div class="col-sm-9">
                <select class="form-control validate[required]" id="form-field-select-1 " name="status" >
                    <option value="Y">Visible</option>
                    <option value="N">Not Visible</option>
                </select>
              </div>
            </div>
            
            
            <div class="clearfix form-action">
              <div class="col-md-offset-3 col-md-9">
                <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                <input type="hidden" name="popup_id" id="popup_id" value="<?php echo $ROW['popup_id']; ?>">
                <button type="submit" name="submit_data" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
            
                <button onClick="window.location.href='<?php echo ADMIN_PATH."website/popuplist"; ?>'"  class="btn" type="button"> <i class="ace-icon fa fa-undo bigger-110"></i> Cancel </button>
              </div>
            </div>
          </form>
          
              </div>
            </div>
            <!-- PAGE CONTENT ENDS -->
          </div>
          <!-- /.col -->
        </div>
                                    </div>

                                </div>
                                <!-- /tile body -->

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
 <?php jquery_validation(); ?>