<?php
defined('BASEPATH') OR exit('No direct script access allowed');
PrintR($_GET);
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
$QR_PAGES="SELECT tsms.*, tsmm.type_name FROM ".prefix."tbl_sys_menu_sub AS tsms 
           LEFT JOIN tbl_sys_menu_main AS tsmm ON tsms.ptype_id=tsmm.ptype_id  
           WHERE 1 ORDER BY tsms.order_id ASC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
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
                           <h4 class="card-title"> Menu <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Permission </small>  </h4>
                        </div>
                     
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                       
                        <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal" method="post" name="frmMenus" id="frmMenus" autocomplete="off" action="<?php echo generateAdminForm("operative","systempermission","");  ?>">
            
            
            <div class="space-6"></div>
            <div class="form-group">
              <label class="control-label col-xs-12 col-sm-6 no-padding-right" for="food">Group Name</label>
              <div class="col-sm-3">
                <select class="form-control validate[required] ViewList" id="form-field-select-1 group_id" name="group_id" >
                    <option value="">Select Group</option>
                    <?php echo DisplayCombo($_GET['group_id'],"USRGRP"); ?>
                </select>
                
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-top" for="duallist"> Available Menu Listing    </label>
              <div class="col-sm-12">
                <div class="bootstrap-duallistbox-container row moveonselect">
                  <div class="box1 col-md-6">
                    
                  
                    <div class="btn-group buttons">
                   
                      <button title="Move selected" type="button" class="btn move btn-white btn-bold btn-info AddMenus"> <i class="fa fa-arrow-right"></i> </button>
                    </div>
                    <select style="height: 270px;" name="fldvFList[]" class="form-control" id="fldvFList" multiple="multiple">
                        <?php
                        $QR_SELECT ="SELECT A.page_id, A.page_title, B.type_name FROM ".prefix."tbl_sys_menu_sub AS A, ".prefix."tbl_sys_menu_main AS B 
                        WHERE A.ptype_id=B.ptype_id   AND A.page_id NOT IN (SELECT page_id FROM ".prefix."tbl_sys_menu_acs AS C WHERE 
                        C.group_id='$_GET[group_id]')   AND A.order_id>0 AND B.order_id>0 ORDER BY B.order_id ASC, A.order_id ASC";
                        $RS_SELECT = $this->db->query($QR_SELECT);
                        $AR_ROWS = $RS_SELECT->result_array();
                        foreach($AR_ROWS as $AR_ROW):
                        ?>
                        <option value="<?php echo $AR_ROW['page_id']; ?>"><?php echo $AR_ROW['type_name']."=>".$AR_ROW['page_title'];?></option>
                        <?php   
                        endforeach;
                        ?>
                    </select>
                  </div>
                  
                  <div class="box2 col-md-6">
                   
                    <div class="btn-group buttons">
                      <button title="Remove selected" type="button" class="btn remove btn-white btn-bold btn-info RemoveMenus"> <i class="fa fa-arrow-left"></i> </button>
                     
                    </div>
                    <select style="height: 270px;" name="fldvTList[]" class="form-control" id="fldvTList" multiple="multiple">
                    <?php
                        $QR_SELECT ="SELECT A.page_id, A.page_title, B.type_name FROM ".prefix."tbl_sys_menu_sub AS A, ".prefix."tbl_sys_menu_main AS B WHERE 
                        A.ptype_id=B.ptype_id   AND A.page_id IN (SELECT page_id FROM ".prefix."tbl_sys_menu_acs AS C WHERE 
                        C.group_id='$_GET[group_id]') ORDER BY B.order_id ASC, A.order_id ASC";
                        $RS_SELECT = $this->db->query($QR_SELECT);
                        $AR_ROWS = $RS_SELECT->result_array();
                        foreach($AR_ROWS as $AR_ROW):
                        ?>
                            <option value="<?php echo $AR_ROW['page_id']; ?>"><?php echo $AR_ROW['type_name']."=>".$AR_ROW['page_title'];?></option>
                        <?php   
                        endforeach;
                        ?>
                    </select>
                  </div>
                </div>
               
                <div class="hr hr-16 hr-dotted"></div>
              </div>
            </div>
            <div class="form-action">
              <div class="col-md-offset-3 col-md-9">
                <button type="submit" name="submitForm" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
                     
                <button onClick="window.parent.frames.location.reload();"  class="btn" type="button"> <i class="ace-icon fa fa-undo bigger-110"></i> Load Menu </button>
              </div>
            </div>
          </form>
         
                                    
                                 </div>
                              </div>
                           </div>

         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>

<?php jquery_validation(); ?>
<script>
JsURLPath = "<?php echo BASE_PATH; ?>";
$(function() { 
    
    $("#frmMenus").validationEngine(
        {onValidationComplete: function(form, valid){
            $("#fldvTList > option").each(function(){
                $('#fldvTList option').attr("selected", "selected");
            });
            return true;
        }}
    );
    
    $(".ViewList").change(function(){
        var group_id = $(this).val();
        window.location.href='?group_id='+group_id;
    })
    
    $(".AddMenus").click(function(){
        $("#fldvFList > option:selected").each(function(){
            $(this).remove().appendTo("#fldvTList");
        });
    });

    $(".RemoveMenus").click(function(){
        $("#fldvTList > option:selected").each(function(){
            $(this).remove().appendTo("#fldvFList");
        });
    });
});
</script>