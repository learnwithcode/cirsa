<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$member_id = _d(FCrtRplc($_GET['member_id']));
if($member_id == ""){$member_id="1";}


//$QR_MEM = "SELECT mem.member_id ,mem.user_id,concat(mem.first_name,' ',mem.midle_name,' ',mem.last_name) as name,mem.city_name as city , COUNT(tree.member_id) as total FROM `tbl_members` as mem LEFT JOIN tbl_mem_tree as tree on mem.member_id = tree.sponsor_id where 1 group by mem.member_id HAVING(count(tree.member_id) > 0)";
$QR_MEM ="SELECT mem.member_id ,mem.user_id,mem.full_name as name, COUNT(tsm.member_id) as total FROM `tbl_members` as mem LEFT JOIN tbl_members as tsm on mem.member_id = tsm.sponsor_id and tsm.subcription_id > 0 where 1 group by mem.member_id ORDER BY  COUNT(tsm.member_id) DESC";
$PageVal = DisplayPages($QR_MEM, 200, $Page, $StrQuery);
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
                           <h4 class="card-title"> Users  <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Directs List</small>  </h4>
                        </div>
                        <div class="clearfix">
               
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                       <table width="100%" border="0" cellpadding="5" cellspacing="1" class="table table-striped table-bordered table-hover">
            <tr>
              <td colspan="8" align="lefat" valign="bottom" class="bigtexthdr">Member Directs</td>
            </tr>
        <!--    <form method="get" >
            <tr>
              <td colspan="2" align="left" valign="bottom" class="">
                  <input name="user_id" type="text" class="form-control" id="user_id" value="<?php echo $_GET['user_id']; ?>" style="width:200px;" />
                  <input name="member_id" type="hidden" id="member_id" value="<?php echo $_GET['member_id']; ?>" />
                  &nbsp;
              </td>
              <td colspan="5" align="left" valign="bottom" class=""><input name="input_request" type="submit" class="btn_new_admin blue" id="input_request"  value="Search" />                <input name="Back" type="button" class="btn_new_admin red" id="Back" onClick="window.history.back()" value="&lt;&lt;Back" />               </td>
            </tr>
            </form>-->
            <tr class="">
              <td colspan="2" align="left">Srl N</td>
              <td width="9%" align="left">User Id</td>
              <td width="15%" align="left"> Name</td>
              
              <td width="8%" align="left">Active Direct </td>
              <td width="8%" align="left">Total Direct </td>
               <td width="8%" align="left">Action</td>
            </tr>
            <?php 
            if($PageVal['TotalRecords'] > 0){
            $Ctrl = $PageVal['RecordStart']+1;
            foreach($PageVal['ResultSet'] as $AR_Fld){
            
           // PrintR($AR_Fld);
            $AR_IMG = $model->getCurrentImg($AR_Fld['member_id']);
            $TOTAL_ID = $model->counttotalsponsor($AR_Fld['member_id']);
            ?>
           
            <tr class=""  style="cursor:pointer">
            
              <td width="4%" height="20" align="center" valign="top" class="cmntext"><?php echo $Ctrl;?></td>
          <td width="6%" align="center" valign="top" class="cmntext">   </td>
          <td align="left" valign="middle" class="<?php echo $AR_IMG['CssCls'];?>"><?php echo strtoupper($AR_Fld['user_id']);?></td>
              <td align="left" valign="middle" class="<?php echo $AR_IMG['CssCls'];?>"><?php echo strtoupper($AR_Fld['name']);?></td>

<td align="left" valign="middle" class=""><span class="cmntext"><?php echo $AR_Fld['total'];?></span></td>
<td align="left" valign="middle" class=""><span class="cmntext"><?php echo $TOTAL_ID;?></span></td>
              <td align="left" valign="middle" class="cmntext"><a href="<?php echo BASE_PATH;?>admin/users/direct?user_id=<?php echo $AR_Fld['user_id'];?>&member_id=<?php echo _e($AR_Fld['member_id']);?>" target="_blank">View</a></td>
            </tr>
            <?php  $Ctrl++; }?>
            <?php }else{?>
            <tr>
              <td colspan="8" align="center" class="errMsg">No record found</td>
            </tr>
            <?php } ?>
          </table>
           <ul class="pagination">
                  <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                </ul>
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
