<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
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

                                    
                                     <!-- tile body -->
                              <div class="row">

          <div class="col-lg-12">
            <div class="row">
                
                          <?php get_message(); ?>
              <div class="col-lg-12">
                  <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Member <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Genealogy</small>  </h4>
                        </div>
                       
                     </div>
                       <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
                    <a  style="color:white;"  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold" data-toggle="modal" data-target="#exampleModalLong " ><span><i class="fa fa-search "></i> <span >Search</span></span></a>
                  
                    
                     </div>
                </div>
              </div>
                  <div class="header-title">
                        <!--<h4 class="card-title">  <code> TRX Price : <?php echo $price;?>   || Available TRX <?php echo number_format($model->getValue("VIRTUAL_WALLET_CRYPTO")   ); ?>/-</code></h4>-->
                     </div>
              
        
                
                <div class="clearfix">&nbsp;</div>
                <div class="table-responsive-row">
                    <table width="100%" border="0" cellpadding="5" cellspacing="0">
            
            <?php
            $member_id = _d(FCrtRplc($_REQUEST['member_id']));
            $user_id = FCrtRplc($_REQUEST['user_id']);
            if($member_id == ""){$member_id="1";}

            
            $QR_TREE = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$member_id' AND (nleft>0 AND nright>0)";
            $RS_TREE = $this->SqlModel->runQuery($QR_TREE);
            foreach($RS_TREE as $AR_TREE):
                if($AR_TREE['left_right'] == "L"){
                    $Left_Lft = $AR_TREE['nleft'];
                    $Left_Rgt = $AR_TREE['nright'];
                }
                if($AR_TREE['left_right'] == "R"){
                    $Right_Lft = $AR_TREE['nleft'];
                    $Right_Rgt = $AR_TREE['nright'];
                }
            endforeach;
            


        // Count All Left Memebers
        $Q_Left = "SELECT COUNT(A.member_id) AS fldiCtrl FROM ".prefix."tbl_members AS A LEFT JOIN  tbl_mem_tree AS B ON A.member_id=B.member_id WHERE 
        B.nleft BETWEEN '$Left_Lft' AND '$Left_Rgt'  $StrWhr";
        $AR_Left = $this->SqlModel->runQuery($Q_Left,true);
        
        // Count All Right Members
        $Q_Right = "SELECT COUNT(A.member_id) AS fldiCtrl FROM ".prefix."tbl_members AS A LEFT JOIN tbl_mem_tree AS B ON A.member_id=B.member_id  WHERE 
        B.nleft BETWEEN '$Right_Lft' AND '$Right_Rgt'  $StrWhr";
        $Ar_Right = $this->SqlModel->runQuery($Q_Right,true);
?>
            <tr class="header">
              <td align="left">
                <form method="get" name="frmSrch" id="frmSrch" autocomplete="off" action="<?php echo ADMIN_PATH."users/genealogy"; ?>">
                <div class="col-xs-12 col-sm-6">
                    <div class="clearfix">
                    <input name="user_id" type="text" class="form-control" id="user_id" value="<?php echo $_REQUEST['user_id']; ?>" style="width:250px;" />
                    <input name="member_id" type="hidden" id="member_id" value="<?php echo $_REQUEST['member_id']; ?>" /> &nbsp;
                    </div>
                </div>
                <label class="control-label col-xs-12 col-sm-6" for="email">
                    <input name="input_request" type="submit" class="btn btn-success  btn-sm" id="input_request"  value="Search" />
                    <input name="Back" type="button" class="btn btn-danger btn-sm" id="Back" onClick="window.history.back()" value="&lt;&lt;Back" />    
                </label>
                </form>
                </td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr class="header">
              <td width="35%" align="center">Left Member : <?php echo $AR_Left['fldiCtrl']; ?></td>
              <td width="35%" align="center">Right Member : <?php echo $Ar_Right['fldiCtrl']; ?></td>
            </tr>
            <?php
            $Q_LeftMem = "SELECT tm.*, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
                     tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join FROM ".prefix."tbl_members AS tm 
                     LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
                     LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
                     WHERE tree.nleft BETWEEN '$Left_Lft' AND '$Left_Rgt' $StrWhr ORDER BY tm.member_id ASC;";
            $RS_LftMem = $this->SqlModel->runQuery($Q_LeftMem);

            $Q_RightMem = "SELECT tm.*, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
                 tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join FROM ".prefix."tbl_members AS tm 
                 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
                 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
                 WHERE tree.nleft BETWEEN '$Right_Lft' AND '$Right_Rgt' $StrWhr ORDER BY tm.member_id ASC;";
            $RS_RgtMem = $this->SqlModel->runQuery($Q_RightMem);
?>
            <tr>
              <td height="82" align="center" valign="top"><table width="80%" border="1" cellspacing="0" cellpadding="4" style="border-collapse:collapse">
                  <tr class="lightbg">
                    <td align="center" class="cmntext" scope="col"><strong>SLN</strong></td>
                    <td align="center" class="cmntext" scope="col"><strong>Member     </strong></td>
                    <td align="center" class="cmntext" scope="col"><strong> Name</strong></td>
                    <td align="center" class="cmntext" scope="col"><strong>D.O.J</strong></td>
                  </tr>
                <?php
                    $Ctrl = 1;
                    foreach($RS_LftMem as $AR_LftMem):
                ?>
                  <tr>
                    <td width="7%" align="center" class="cmntext" scope="col"><?php echo $Ctrl;?></td>
                    <td width="26%" align="center" class="" scope="col"><?php echo $AR_LftMem['user_name']; ?></td>
                    <td width="41%" scope="col" class="cmntext" align="center"><?php echo $AR_LftMem['first_name']." ".$AR_LftMem['last_name'];?></td>
                    <td width="26%" scope="col" class="cmntext" align="center"><?php echo DisplayDate($AR_LftMem['date_join']);?></td>
                  </tr>
                  <?php $Ctrl++;
                  endforeach;
                  ?>
                </table></td>
              <td align="center" valign="top"><table width="80%" border="1" cellspacing="0" cellpadding="4" style="border-collapse:collapse;">
                  <tr class="lightbg">
                    <td width="8%" align="center" class="cmntext" scope="col"><strong>SLN</strong></td>
                    <td width="26%" align="center" class="cmntext" scope="col"><strong>Member     Id </strong></td>
                    <td width="43%" align="center" class="cmntext" scope="col"><strong> Name</strong></td>
                    <td width="23%" align="center" class="cmntext" scope="col"><strong>D.O.J</strong></td>
                  </tr>
                    <?php
                    $Ctrl = 1;
                    foreach($RS_RgtMem as $AR_RgtMem):
                    ?>
                  <tr>
                    <td align="center" class="cmntext" scope="col"><?php echo $Ctrl;?></td>
                    <td align="center" class="" scope="col"><?php echo $AR_RgtMem['user_name'];?></td>
                    <td scope="col" class="cmntext" align="center"><?php echo $AR_RgtMem['first_name']." ".$AR_RgtMem['last_name'];?></td>
                    <td scope="col" class="cmntext" align="center"><?php echo DisplayDate($AR_RgtMem['date_join']);?></td>
                  </tr>
                  <?php $Ctrl++;
                  endforeach; ?>
                </table></td>
            </tr>
          </table>
                </div>
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
                                   
                                        <form class="form-horizontal"  name="form-page" id="form-page"  autocomplete="off"  method="get"  action="<?php echo generateAdminForm("users","genealogy",""); ?>" >
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> User Name  :</label>
              <div class="col-sm-7">
              
  <input id="form-field-1" placeholder="Member ID" name="user_id" class="col-xs-10 col-sm-12  " value="<?php echo $_GET['user_id']; ?>" type="text">
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="crypto_address"> Address  :</label>
              <div class="col-sm-7">
              
  <input id="crypto_address" placeholder="Crypto Address" name="crypto_address" class="col-xs-10 col-sm-12  " value="<?php echo $_GET['crypto_address']; ?>" type="text">
              </div>
            </div>
            
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Status  :</label>
              <div class="col-sm-7">
                <div class="clearfix">
                            <!--echo  checkRadio($_GET['trns_status'],"C");-->
                          <input type="radio" name="trns_status" id="trns_status" <?php echo $c;   ?> value="C">
                          Confirm 
                          &nbsp;&nbsp;
                          <input type="radio" name="trns_status" id="trns_status" <?php  echo $r;   ?> value="R">
                          Reject 
                          &nbsp;&nbsp;
                          <input type="radio" name="trns_status" id="trns_status" <?php  echo $p;   ?>    value="P">
                          Pending 
                          &nbsp;&nbsp; </div>
              </div>
            </div>
            
            
                        <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">  From Date  :</label>
              <div class="col-sm-7">
            
 <input class="form-control col-xs-12 col-sm-12  date-picker" name="from_date" id="from_date" value="<?php echo $ROW['from_date']; ?>" type="text"  />
              </div>
            </div>
            
            
                        <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">To Date :</label>
              <div class="col-sm-7">
              
 <input class="form-control col-xs-12 col-sm-12  date-picker" name="to_date" id="to_date" value="<?php echo $ROW['to_date']; ?>" type="text"  />
              </div>
            </div>
            
            
            
            
            
             
             
               
            
            
            
        
            
            
        
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
            <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
          </div>
        </form>
                                    
                                 </div>
                              </div>
                           </div>

         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
 <?php jquery_validation(); ?>
<script type="text/javascript">
    $(function(){
        $("#form-page").validationEngine();
    });
</script>