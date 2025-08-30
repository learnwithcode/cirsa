<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$QR_PAGES="SELECT tsmm.*, tfai.icon_name FROM ".prefix."tbl_sys_menu_main AS tsmm 
           LEFT JOIN tbl_font_awsome_icon AS tfai ON tsmm.icon_id=tfai.icon_id 
           WHERE 1 ORDER BY tsmm.order_id ASC";
$PageVal = DisplayPages($QR_PAGES, 100, $Page, $SrchQ);
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
                           <h4 class="card-title"> Main Menu <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Pages </small>  </h4>
                        </div>
                         <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> <a href="<?php echo generateSeoUrlAdmin("operative","pagesadd",array("ptype_id"=>$AR_DT['ptype_id'],"action_request"=>"ADD")); ?>" title="" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold"><span><i class="fa fa-plus bigger-110 blue"></i></span></a> 
                   
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                        <div class="table-responsive">
                           <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th width="55" class="center"> <label class="pos-rel"> ID <span class="lbl"></span> </label>
                      </th>
                      <th width="99">Main Menu </th>
                      <th width="104">Icon</th>
                      <th width="118" class="hidden-480">Display Order </th>
                      <th width="85">Action</th>
                    </tr>
                  </thead>
                  <form method="post" autocomplete="off" action="<?php echo ADMIN_PATH."operative/pagesadd"; ?>">
                  <tbody>
                    <?php 
                    if($PageVal['TotalRecords'] > 0){
                        $Ctrl=1;
                        foreach($PageVal['ResultSet'] as $AR_DT):
                   ?>
                    <tr>
                      <td class="center"><label class="pos-rel"> <?php echo $AR_DT['ptype_id']; ?> <span class="lbl"></span> </label>
                      </td>
                      <td><a href="#"><?php echo $AR_DT['type_name']; ?></a> </td>
                      <td><?php echo $AR_DT['icon_name']; ?></td>
                      <td class="hidden-480"><input type="hidden" name="ptype_id[]" value="<?php echo $AR_DT['ptype_id'];?>" />
                        <input name="order_id[]" type="text" class="cmnfld" id="order_id[]" size="3" value="<?php echo $AR_DT['order_id'];?>" style="text-align:center; width:60px;" onBlur="extractNumber(this,0,true);" onKeyPress="return blockNonNumbers(this, event, true, false);" onKeyDown="javascript: EnterKey();" onKeyUp="extractNumber(this,0,true);" maxlength="2"  tabindex="<?php echo $Ctrl; ?>" />
                      </td>
                       <td>
                                       <div class="flex align-items-center list-user-action">
                                          
                                          <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="<?php echo generateSeoUrlAdmin("operative","pagesadd",array("ptype_id"=>$AR_DT['ptype_id'],"action_request"=>"EDIT")); ?>"><i class="ri-pencil-line"></i></a>
                                          <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onClick="return confirm('Make sure want to delete this record?')" href="<?php echo generateSeoUrlAdmin("operative","pagesadd",array("ptype_id"=>$AR_DT['ptype_id'],"action_request"=>"DELETE")); ?>"><i class="ri-delete-bin-line"></i></a>
                                       </div>
                                    </td>
                    </tr>
                    <?php $Ctrl++; endforeach; } ?>
                    <tr>
                      <td class="center">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td class="hidden-480">
                      <input type="hidden" name="action_request" id="action_request" value="POSITION">
                      <button type="submit" class="btn btn-white btn-info btn-bold"> <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i> Update</button></td>
                      <td>&nbsp;</td>
                    </tr>
                  </tbody>
                  </form>
                </table>
                          
                        </div>
                     </div>
                  </div>
               </div>              
                <div class="row">
                    <div class="col-xs-6">
                        <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info">
                            Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
                        </div>
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
