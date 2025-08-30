<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

$url = $this->uri->segment(1);
if($url == 'admin')
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
<script type="text/javascript">
    $(function(){
        $(".open_modal").on('click',function(){
            $('#search-modal').modal('show');
            return false;
        });
    });
</script>
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

                                    <div class="table-responsive">
                        <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Admin <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp;  Profile </small>  </h4>
                        </div>
                        <div class="clearfix">
            
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                 <div class="row">
         
         <?php  get_message(); ?>
        <div class="col-md-12">
          <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo $path."operative/operatoradd"; ?>" method="post"> 
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1">  Name </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="name" name="name"  class="form-control  col-xs-10 col-sm-5 validate[required]" type="text" readonly value="<?php echo $ROW['name']; ?>">
              </div>
            </div>
           <div class="space-4"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Username </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="username" name="user_name"  class="form-control col-xs-10 col-sm-5 validate[required]"   type="text" value="<?php echo $ROW['user_name']; ?>">
              </div>
            </div>
            <div class="space-4"></div>         
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Password </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="password" name="password"  class="form-control col-xs-10 col-sm-5 validate[required]"   type="text" value="<?php echo $ROW['password']; ?>">
              </div>
            </div>
            <div class="space-4"></div>         
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email-ID </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="email address" name="email_address"  class="form-control col-xs-10 col-sm-5 validate[required,custom[email]]" type="text" value="<?php echo $ROW['email_address']; ?>">
              </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Mobile No </label>
              <div class="col-sm-9">
                <input id="form-field-1" placeholder="mobile no" name="mobile"  class="form-control col-xs-10 col-sm-5 validate[required,custom[integer]]" type="text" value="<?php echo $ROW['mobile']; ?>">
              </div>
            </div>
            <div class="space-4"></div>
     <!--       <div class="form-group">-->
     <!--         <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Operator Group </label>-->
     <!--         <div class="col-sm-3">-->
     <!--          <select class="form-control validate[required]" id="form-field-select-1 group_id" name="group_id" >-->
                    <!--<option value="">Select Group</option>-->
     <!--               <?php echo DisplayCombo($ROW['group_id'],"USRGRP"); ?>-->
     <!--           </select>-->
     <!--         </div>-->
     <!--       </div>-->
            <div class="space-4"></div>
            
            
            
            <div class="clearfix form-action">
              <div class="col-md-offset-3 col-md-9">
                <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                <input type="hidden" name="oprt_id" id="oprt_id" value="<?php echo $ROW['oprt_id']; ?>">
                <button type="submit" name="submitOperator" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
               
              </div>
            </div>
          </form>
          <!-- PAGE CONTENT ENDS -->
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
<?php jquery_validation(); ?>
<script type="text/javascript">
    $(function(){
        $("#form-page").validationEngine();
    });
</script>