<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}


$QR_PAGES="SELECT pop.* FROM ".prefix."tbl_memberdashbaord_data AS pop   WHERE 1  ORDER BY pop.popup_id ASC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);


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
        
        $(".checkStatus").on('click',function(){
            var id_cms = $(this).attr("id_cms");
            var URL_LOAD = "<?php echo ADMIN_PATH."json/jsonhandler"; ?>?switch_type=CMS&id_cms="+id_cms;
            $.getJSON(URL_LOAD,function(JVal){});
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

                                    
                                     <!-- tile body -->
                              <div class="row">

          <div class="col-lg-12">
            <div class="row">
                
                          <?php get_message(); ?>
              <div class="col-lg-12">
                  <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Website <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp;Member Dashboard Slider List </small>  </h4>
                        </div>
                       
                     </div>
                       <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
                         <a  href="<?php echo generateSeoUrlAdmin("website","memberdashbaordadd",""); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class=" btn btn-white btn-primary btn-bold"><span><i class="fa fa-plus bigger-110 blue"></i> <span class="">Add New Slider</span></span></a> 
                  
                    
                     </div>
                </div>
              </div>
                 
        
                
                <div class="clearfix">&nbsp;</div>
                <div class="table-responsive-row">
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                   <th  class="center"> <label class="pos-rel"> ID <span class="lbl"></span> </label>                      </th>
                     
                      <th align="center">Image</th>
                      <!--<th  align="center">Website</th>-->
                      <th  align="center">Software</th>
                      <th  align="center">Action</th>
                    </tr>
                  </thead>
                  <form method="post" autocomplete="off" action="<?php echo ADMIN_PATH."operation/cms"; ?>">
                    <tbody>
                      <?php 
                    if($PageVal['TotalRecords'] > 0){
                        $Ctrl=1;
                        foreach($PageVal['ResultSet'] as $AR_DT):
                   ?>
                      <tr>
                        <td class="center"><label class="pos-rel"> <?php echo $Ctrl; ?> <span class="lbl"></span> </label>                        </td>
                       
                        <td><img src="<?php echo BASE_PATH.'upload/popup/'.$AR_DT['file'];?>" width="240px" height="120px"><?php //echo $AR_DT['banner'];?></td>
              <!--          <td align="left">   <label>
                            <input name="switch-field-1" onclick="return updateweb('w'+<?php echo $AR_DT['popup_id'];?>,<?php echo $AR_DT['popup_id'];?>);" class="ace ace-switch ace-switch-4 checkStatus" <?php if($AR_DT['web_status']=='Y'){ echo 'checked="checked"';} ?>  type="checkbox" id="w<?php echo $AR_DT['popup_id'];?>">
                            <span class="lbl"></span>                           </label></td>-->
                            
                             <td align="center">
                            <label> <?php if($AR_DT['soft_status']=='Y'){ ?><span class="btn btn-success">Visible </span> <?php }else{ ?>   <span class="btn btn-danger">Not-Visible </span>                <?php } ?>      </label></td>
                        
   
                        <td align="center"><div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-white "> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>
                            <ul class="dropdown-menu dropdown-default">
                              <li> <a href="<?php echo generateSeoUrlAdmin("website","memberdashbaordadd",array("popup_id"=>$AR_DT['popup_id'],"action_request"=>"EDIT")); ?>">Edit</a> </li>
                            <li> <a onClick="return confirm('Make sure want to delete this Image ?')" href="<?php echo generateSeoUrlAdmin("website","memberdashbaordadd",array("popup_id"=>$AR_DT['popup_id'],"action_request"=>"DELETE")); ?>">Delete</a> </li>
                            </ul>
                          </div></td>
                      </tr>
                      <?php $Ctrl++; endforeach; ?>
                      
                      <?php  }else{ ?>
                      <tr>
                        <td colspan="5" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </form>
                </table>
                <div class="row">
                  <div class="col-xs-6">
                    <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> operator </div>
                  </div>
                  <div class="col-xs-6">
                    <div id="dynamic-table_paginate" class="dataTables_paginate paging_simple_numbers">
                      <ul class="pagination">
                        <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
               
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
  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog " role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle">Search </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                   
                                   <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."operation/cmslist"; ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Title </label>
            <div class="col-sm-6">
              <input id="form-field-1" placeholder="Title" name="cms_title"  class="col-xs-10 col-sm-12 validate[required]" type="text" value="<?php echo $_REQUEST['cms_title']; ?>">
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
          <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
        </div>
      </form>
                                    
                                 </div>
                              </div>
                           </div>
<script>
function updateweb(check,id)
{

var status = document.getElementById(check).checked;

jQuery.ajax({
type:"POST",
url :"<?php echo BASE_PATH;?>"+"superadmin/website/popupwebstatus",
data:{popupId:id,status:status},
success :function(res){
    if(res > 0 )
    {
window.location.reload();

    }
    }
});
 }
 
 function updatesoft(check,id)
{

var status = document.getElementById(check).checked;
//alert(status);
jQuery.ajax({
type:"POST",
url :"<?php echo BASE_PATH;?>"+"superadmin/website/popupsoftstatus",
data:{popupId:id,status:status},
success :function(res){
    alert(res);
    if(res > 0 )
    {
        
window.location.reload();

    }
    }
});
 }
 
    
        $(".checkStatus").on('click',function(){
            var popup_id = $(this).attr("popup_id");
            var URL_LOAD = "<?php echo ADMIN_PATH."json/jsonhandler"; ?>?switch_type=POPUP&popup_id="+popup_id;
            $.getJSON(URL_LOAD,function(JVal){});
        });
 
</script>

 <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
 <?php jquery_validation(); ?>