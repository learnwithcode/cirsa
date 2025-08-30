<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$member_id = _d(FCrtRplc($_REQUEST['member_id']));
if($member_id == ""){$member_id="1";}

$Q_GEN =  "SELECT nlevel, nleft, nright FROM ".prefix."tbl_mem_tree WHERE member_id='$member_id'";
$AR_GEN = $this->SqlModel->runQuery($Q_GEN,true);
$nlevel = $AR_GEN['nlevel'];
$nleft = $AR_GEN['nleft'];
$nright = $AR_GEN['nright'];

$StrQuery = "&member_id=$member_id";

$QR_MEM = "SELECT tm.*, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
             tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join FROM ".prefix."tbl_members AS tm 
             LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
             LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
             WHERE tree.nleft BETWEEN '$nleft' AND '$nright' $StrWhr ORDER BY tree.nlevel ASC";
$PageVal = DisplayPages($QR_MEM, 200, $Page, $StrQuery);
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
                           <h4 class="card-title"> Member <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Level View </small>  </h4>
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
                   <table width="100%" border="0" cellpadding="5" cellspacing="1" class="table table-striped table-bordered table-hover">
            
           
            <tr class="">
              <td colspan="2" align="left">Level</td>
              <td width="9%" align="left">Member Id</td>
              <td width="15%" align="left">Full Name</td>
              <td width="11%" align="center">Sponsor Id</td>
              <td width="10%" align="left">Joining Date</td>
              <td width="11%" align="left">Email</td>
              <td width="8%" align="left">Mobile</td>
            </tr>
            <?php 
            if($PageVal['TotalRecords'] > 0){
            $CurrLvl = $PreLvl = 0;
            $Ctrl = $PageVal['RecordStart'];
            foreach($PageVal['ResultSet'] as $AR_Fld){
            $Ctrl++;
            
            $AR_IMG = $model->getCurrentImg($AR_Fld['member_id']);
            
            $CurrLvl = $AR_Fld['nlevel'];
                if(($CurrLvl != $PreLvl)){
                    $LvlCtrl = $CurrLvl - $fldiLevel;
            ?>
            <tr bgcolor="#B8E6FE">
              <td colspan="8" align="left" valign="middle" class="cmntext"><strong>Level <?php echo $LvlCtrl;?></strong></td>
            </tr>
            <?php 
            $PreLvl = $AR_Fld['nlevel'];
            }
?>
            <tr class="" onClick="window.location.href='?user_id=<?php echo $AR_Fld['user_id']?>&member_id=<?php echo $AR_Fld['member_id']?>'" style="cursor:pointer">
              <td width="4%" height="20" align="center" valign="top" class="cmntext"><?php echo $Ctrl;?></td>
              <td width="6%" align="center" valign="top" class="cmntext"></td>
              <td align="left" valign="middle" class="<?php echo $AR_IMG[CssCls];?>"><?php echo strtoupper($AR_Fld['user_id']);?></td>
              <td align="left" valign="middle" class="cmntext"><?php echo $AR_Fld['first_name']." ".$AR_Fld['last_name'];?></td>
              <td align="center" valign="middle" class="cmntext"><?php echo $AR_Fld['spsr_user_id'];?></td>
              <td align="left" valign="middle" class="cmntext"><?php echo DisplayDate($AR_Fld['date_join']);?></td>
              <td align="left" valign="middle" class=""><span class="cmntext"><?php echo $AR_Fld['member_email'];?></span></td>
              <td align="left" valign="middle" class="cmntext"><?php echo $AR_Fld['member_mobile'];?></td>
            </tr>
            <?php }?>
            <?php }else{?>
            <tr>
              <td colspan="8" align="center" class="errMsg">No record found</td>
            </tr>
            <?php } ?>
          </table>
           <ul class="pagination">
                  <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                </ul>
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
                                   
                                        <form class="form-horizontal"  name="form-page" id="form-page"  autocomplete="off"  method="get"  action="<?php echo generateAdminForm("users","level",""); ?>" >
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