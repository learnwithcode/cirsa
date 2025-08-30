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
                          <h1> News <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Add / Update </small> </h1>
                        </div>
                        <div class="clearfix">
            
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                 <div class="row">
         
          <div class="col-md-12"  > 
          
     
             <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."operative/news"; ?>" method="post" enctype='multipart/form-data'>
                    <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> News Images </label>
              <div class="col-sm-9">
                <input type="file" name="news_img" accept="image/x-png,image/gif,image/jpeg,image/jpg" <?php if($ROW['news_id'] > 0) { ?> <?php } ?> >
              </div>
            </div>
          
    <div class="form-group" style="display:none;">
      <label for="email">News  Title:</label>
       <input class="form-control" placeholder="Title" name="news_title"   type="text" value="<?php echo $ROW['news_title']; ?>">
    </div>
    <div class="form-group" style="display:none;">
      <label for="pwd">News Date :</label>
         <input class="form-control" name="news_date" id="id-date-picker-1" value="<?php echo $ROW['news_date']; ?>" type="date"  />
    </div>
      <div class="form-group">
      <label for="pwd">News Details :</label>
          <textarea name="news_detail"class="form-control" required id="ckeditor" placeholder="Content"><?php echo $ROW['news_detail']; ?></textarea>
               
    </div>
      <div class="form-group">
      <label for="pwd">Displayed :</label>
         <input name="news_sts"  class="ace ace-switch ace-switch-4 checkStatus" <?php if($ROW['news_sts']>0){ echo 'checked="checked"';} ?>  type="checkbox">
    </div>
   <div class="clearfix form-action">
              <div class="col-md-offset-3 col-md-9">
                <input type="hidden" name="action_request" id="action_request" value="ADD_UPDATE">
                <input type="hidden" name="news_id" id="news_id" value="<?php echo $ROW['news_id']; ?>">
                <button type="submit" name="submitNEWS" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
     
                            </div>
            </div>
  </form>
        
         
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
<?php jquery_validation(); auto_complete(); ?>
<script type="text/javascript">
    
    $(function(){
        $("#form-valid").validationEngine();
    });
</script>
<script type="text/javascript" language="javascript">
new Autocomplete("member_user_id", function(){
    this.setValue = function( id ) {document.getElementsByName("member_id")[0].value = id;}
    if(this.isModified) this.setValue("");
    if(this.value.length < 1 && this.isNotClick ) return;
    return "<?php echo ADMIN_PATH; ?>autocomplete/listing?srch=" + this.value+"&switch_type=MEMBER";
});
</script>
 <script>
       function check_member(id)
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