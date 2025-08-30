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
                          <h3> Zoomeetings <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Add / Update Zoomeetings </small> </h3>
                        </div>
                        <div class="clearfix">
            
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                 <div class="row">
         
          <div class="col-md-12"  > 
          
     
             <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."operative/zoomeetings"; ?>" method="post" enctype='multipart/form-data'>
              
          
    <div class="form-group" >
      <label for="email">Zoom  Title:</label>
       <input class="form-control" placeholder="Zoom Title" name="zoomtitle"   type="text" value="<?php echo $ROW['zoomtitle']; ?>">
    </div>
      <div class="form-group" >
      <label for="email">Events  Name:</label>
       <input class="form-control" placeholder="Events" name="events_title"   type="text" value="<?php echo $ROW['events_title']; ?>">
    </div>
      <div class="form-group">
      <label for="pwd">Events Date :</label>
         <input class="form-control" name="edate" id="id-date-picker-1" value="<?php echo $ROW['edate']; ?>" type="date"  />
    </div>
    <div class="form-group">
      <label for="pwd">Start Time :</label>
         <input class="form-control" name="starttime" id="id-date-picker-1" value="<?php echo $ROW['starttime']; ?>" type="time"  />
    </div>
        <div class="form-group">
      <label for="pwd">End Time :</label>
         <input class="form-control" name="endtime" id="id-date-picker-1" value="<?php echo $ROW['endtime']; ?>" type="time"  />
    </div>
      <div class="form-group">
      <label for="pwd">URL/ links :</label>
          <textarea name="links"class="form-control" required id="ckeditor" placeholder="URL/ links"><?php echo $ROW['links']; ?></textarea>
               
    </div>
      <div class="form-group" >
      <label for="email">Password:</label>
       <input class="form-control" placeholder="Zoom Password" name="password"   type="text" value="<?php echo $ROW['password']; ?>">
    </div>
     <div class="form-group" >
      <label for="email">Status:</label>
      <div><input type="radio" value="Open" name="status"><label for="Open"> &nbsp Open</label> 
                                        <input type="radio" value="Close" name="status"><label for="Close">&nbsp Close</label>
                                        </div>
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