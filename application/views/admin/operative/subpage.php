<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
if($_REQUEST['ptype_id']!=''){
    $ptype_id = FCrtRplc($_REQUEST['ptype_id']);
    $StrWhr .=" AND tsms.ptype_id='$ptype_id'";
    $SrchQ .="&ptype_id=$ptype_id";
}
$QR_PAGES="SELECT tsms.*, tsmm.type_name FROM ".prefix."tbl_sys_menu_sub AS tsms 
           LEFT JOIN tbl_sys_menu_main AS tsmm ON tsms.ptype_id=tsmm.ptype_id  
           WHERE 1 $StrWhr ORDER BY tsms.order_id ASC";
$PageVal = DisplayPages($QR_PAGES, 200, $Page, $SrchQ);
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
                           <h4 class="card-title"> Main Menu <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Sub-Menu </small>  </h4>
                        </div>
                        <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> <a href="<?php echo generateSeoUrlAdmin("operative","submenuadd",array("page_id"=>$AR_DT['page_id'],"action_request"=>"ADD")); ?>" title="" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold"><span><i class="fa fa-plus bigger-110 blue"></i></span></a> 
                    <a  style="color:white;"  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold" data-toggle="modal" data-target="#exampleModalLong"><span><i class="fa fa-search "></i> <span >Search</span></span></a>
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="22" class="center"> <label class="pos-rel"> ID <span class="lbl"></span> </label>
                      </th>
                      <th width="150">Sub-Menu Title </th>
                      <th width="100">File Name</th>
                      <th width="158">Main Menu</th>
                      <th width="134">Display Order </th>
                      <th width="90">Action</th>
                    </tr>
                  </thead>
                  <form method="post" autocomplete="off" action="<?php echo ADMIN_PATH."operative/submenuadd"; ?>">
                    <tbody>
                      <?php 
                    if($PageVal['TotalRecords'] > 0){
                        $Ctrl=1;
                        foreach($PageVal['ResultSet'] as $AR_DT):
                   ?>
                      <tr>
                        <td class="center"><label class="pos-rel"> <?php echo $AR_DT['page_id']; ?> <span class="lbl"></span> </label>
                        </td>
                        <td><a href="#"><?php echo $AR_DT['page_title']; ?></a> </td>
                        <td><?php echo $AR_DT['page_name']; ?></td>
                        <td><?php echo $AR_DT['type_name']; ?></td>
                        <td><input type="hidden" name="page_id[]" value="<?php echo $AR_DT['page_id'];?>" />
                          <input name="order_id[]" type="text" class="cmnfld" id="order_id[]" size="3" value="<?php echo $AR_DT['order_id'];?>" style="text-align:center; width:60px;" onBlur="extractNumber(this,0,true);" onKeyPress="return blockNonNumbers(this, event, true, false);" onKeyDown="javascript: EnterKey();" onKeyUp="extractNumber(this,0,true);" maxlength="2"  tabindex="<?php echo $Ctrl; ?>" />
                        </td>
                        <td>
                                       <div class="flex align-items-center list-user-action">
                                          
                                          <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="<?php echo generateSeoUrlAdmin("operative","submenuadd",array("page_id"=>$AR_DT['page_id'],"action_request"=>"EDIT")); ?>"><i class="ri-pencil-line"></i></a>
                                          <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onClick="return confirm('Make sure want to delete this record?')" href="<?php echo generateSeoUrlAdmin("operative","submenuadd",array("page_id"=>$AR_DT['page_id'],"action_request"=>"DELETE")); ?>"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                      </tr>
                      <?php $Ctrl++; endforeach; } ?>
                      <tr>
                        <td class="center">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="hidden-480">&nbsp;</td>
                        <td class="hidden-480"><input type="hidden" name="action_request" id="action_request" value="POSITION">
                          <button type="submit" class="btn btn-white btn-info btn-bold"> <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i> Update</button></td>
                        <td>&nbsp;</td>
                      </tr>
                    </tbody>
                  </form>
                </table>
                <div class="row">
                  <div class="col-xs-6">
                    <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries </div>
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
<!-- Modal -->
                           <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle">Search </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                   
                                   <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."operative/subpage"; ?>" method="post"> 
      <div class="modal-body"> 
            
              <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Main Menu </label>
                  <div class="col-sm-6">
                    <select class="form-control validate[required]" id="form-field-select-1" name="ptype_id" >
                        <option value="">----select all-----</option>
                        <?php echo DisplayCombo($ROW['ptype_id'],"MAIN_MENU"); ?>
                    </select>
                  </div>
                </div>
            
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-success"> <i class="ace-icon fa fa-check"></i> Submit </button>
        <button type="button" class="btn btn-sm btn-warning"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
        <button type="button" class="btn btn-sm btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
      </div>
      </form>
                                    
                                 </div>
                              </div>
                           </div>

         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
