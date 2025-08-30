<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$Page = $_GET['page']; if($Page=="" || $Page <=0 ){$Page=1;}
$wallet_id = $model->getWallet(WALLET1);
if($_GET['fullname']!=''){
    $fullname = FCrtRplc($_GET['fullname']);
    $StrWhr .=" AND ( tm.first_name LIKE '%$fullname%' OR tm.last_name LIKE '%$fullname%' OR tm.member_email LIKE '%$fullname%' )";
    $SrchQ .="&fullname=$fullname";
}

if($_GET['type_id']!=''){
    $type_id = FCrtRplc($_GET['type_id']);
    $StrWhr .=" AND ( tm.type_id = '$type_id' )";
    $SrchQ .="&type_id=$type_id";
}
if($_GET['country_code']!=''){
    $country_code = FCrtRplc($_GET['country_code']);
    $StrWhr .=" AND ( tm.country_code LIKE '$country_code' )";
    $SrchQ .="&country_code=$country_code";
}
if($_GET['state_name']!=''){
    $state_name = FCrtRplc($_GET['state_name']);
    $StrWhr .=" AND ( tm.state_name LIKE '$state_name' )";
    $SrchQ .="&state_name=$state_name";
}
if($_GET['city_name']!=''){
    $city_name = FCrtRplc($_GET['city_name']);
    $StrWhr .=" AND ( tm.city_name LIKE '$city_name' )";
    $SrchQ .="&city_name=$city_name";
}

if($_GET['member_email']!=''){
    $member_email = FCrtRplc($_GET['member_email']);
    $StrWhr .=" AND ( tm.member_email LIKE '%$member_email%' )";
    $SrchQ .="&member_email=$member_email";
}

if($_GET['from_date']!='' && $_GET['to_date']!=''){
    $from_date = InsertDate($_GET['from_date']);
    $to_date = InsertDate($_GET['to_date']);
    $StrWhr .=" AND DATE(tm.date_join) BETWEEN '$from_date' AND '$to_date'";
    $SrchQ .="&from_date=$from_date&to_date=$to_date";
}

if($_GET['user_id']!=''){
    $user_id = FCrtRplc($_GET['user_id']);
    $StrWhr .=" AND ( tm.user_id = '$user_id' )";
    $SrchQ .="&user_id=$user_id";
}
//echo $StrWhr;die;
if($_GET['block_sts']!=''){
    $block_sts = FCrtRplc($_GET['block_sts']);
    $StrWhr .=" AND ( tm.block_sts = '$block_sts' )";
    $SrchQ .="&block_sts=$block_sts";
}
 $QR_PAGES="SELECT tm.* ,sub.date_from,sub.subcription_id as id,sub.package_price,  tm.member_mobile  AS mobile_number, 
         tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_name AS spsr_user_id ,
         tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join , tpt.pin_name, tpt.mrp,tpt.prod_pv
         FROM ".prefix."tbl_members AS tm   
         LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
         LEFT JOIN ".prefix."tbl_members AS tmsp  ON tree.sponsor_id=tmsp.member_id
         LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
         LEFT JOIN ".prefix."tbl_subscription AS sub ON tm.member_id=sub.member_id
         WHERE tm.delete_sts>0  AND tm.subcription_id>'0'
         $StrWhr GROUP BY tm.member_id   ORDER BY sub.subcription_id ASC";
$PageVal = DisplayPages($QR_PAGES, 100, $Page, $SrchQ);
  $group_id  = $this->session->userdata('group_id');
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
                        <div class="col-sm-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Users <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Paid List </small>  </h4>
                        </div>
                        <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                    <a  style="color:white;"  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold" data-toggle="modal" data-target="#exampleModalLong " ><span><i class="fa fa-search "></i> <span >Search</span></span></a>
                    <a  href="<?php echo generateSeoUrlAdmin("excel","member",""); ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">
                                        <table class="table table-custom" id="project-progress">
                                           
                                          <tbody>
                         <td colspan="8" class="center" style="background-color: #797979; padding: 0px 0px 4px 0px;"> </td>
                      <?php 
                    if($PageVal['TotalRecords'] > 0){
                        $Ctrl=1;
                        foreach($PageVal['ResultSet'] as $AR_DT):
                        
                        $AR_BAL = $model->getCurrentBalance($AR_DT['member_id'],1,"","");
                         $RETOPUP = $model->getCurrentBalance($AR_DT['member_id'],6,"","");
                         $getTotalMemberShipValue = $model->getTotalMemberShipValueT($AR_DT['member_id']); 
                         //PrintR($AR_BAL['net_balance']);
                   ?>
                   
                  
                      <tr>
                        <td width="22" rowspan="4" class="center"><label class="pos-rel"> <?php echo $AR_DT['id']; ?> <span class="lbl"></span> </label>
                        </td>
                        <td width="112">Full Name  : </td>
                        <td width="148"><a href="javascript:void(0)"><?php echo strtoupper($AR_DT['first_name']." ".$AR_DT['midle_name']." ".$AR_DT['last_name']); ?></a></td>
                        <td width="126">Sponsor ID : </td>
                        <td width="120"><?php echo ($AR_DT['spsr_user_id']!='bitcoinwealth')? $AR_DT['spsr_user_id']:"Admin"; ?></td>
                        <td width="140">Password : </td>
                        <td width="164"><?php echo $AR_DT['user_password']; ?></td>
                        <td width="90" rowspan="3"><div class="btn-group">
                           <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action  </button>
                            <ul class="dropdown-menu dropdown-default">
                            
                                <?php if($group_id =='6'){?>
                               <li> <a href="<?php echo generateSeoUrlAdmin("users","updatemember",array("member_id"=>_e($AR_DT['member_id']))); ?>">Edit</a> </li>
                              <li> <a target="_blank" href="<?php echo generateSeoUrlAdmin("users","directaccesspanel",array("user_id"=>$AR_DT['user_name'])); ?>">Access Panel</a> </li>
                            
                           
                                <?php } ?>
                          
                              
                          
                            
                           
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td>UserName : </td>
                        <td><?php echo strtoupper($AR_DT['user_name']); ?></td>
                        <td>Email Address : </td>
                        <td><?php echo $AR_DT['member_email']; ?></td>
                        <td>Status : </td>
                      <td><?php 
                        
                            $AR_TYPE  = $model->getCurrentMemberShip($AR_DT['member_id']);
                          //PrintR($AR_TYPE);
                            $pain_name = ($AR_TYPE['pin_name'])? $AR_TYPE['pin_name']:"Free";
                            
                            if($pain_name == 'FREE' || $AR_DT['prod_pv'] < 0){
                               echo "<span class='btn btn-danger arrowed-in arrowed-in-right'>In-Active</span>"; 
                            }
                          
                            else{
                                echo "<span class='btn btn-success arrowed-in arrowed-in-right'>Active</span>"; 
                            }
                            ?></td>
                      </tr>
                      <tr>  <?php  $member_mobile = strlen($AR_DT['mobile_number']); 
                                                 $member_phone =strlen($AR_DT['member_phone']);
                                        
                                       $ttppp = $member_phone-$member_mobile;
                                        
                                        $countrycode = substr($AR_DT['member_phone'],1,$ttppp-1);
                                        
                                        
                                      $countryname =  $model->getMobileCodebyname($countrycode);
                                        
                                        
                                        ?>
                        <td>Mobile : </td>
                        <td><?php echo $AR_DT['mobile_number']; ?></td>
                        <td>Country : </td>
                         <td><?php echo $countryname; ?></td>
                        <td>Plan Detail : </td>
                        <td><?php echo ($AR_DT['self_bv']>0)? $AR_DT['self_bv'].'[PV]':"---"; ?></td>
                      </tr>
                      <tr>
                          
                        <td>D.O.J : </td>
                        <td><?php echo DisplayDate($AR_DT['date_join']) ; ?></td>
                        <td>I- Wallet : </td>
                        <td><?php echo CURRENCY; ?><?php echo number_format($AR_BAL['net_balance'],2); ?></td>
                        <td>Pacakage Name : </td>
                        <td><?php echo ($AR_DT['pin_name']!='')? $AR_DT['pin_name']:"Free"; ?></td>
                       
                      </tr>
                      <tr>
                          <td></td>
                        <td>D.O.A : </td>
                        <td><?php echo DisplayDate($AR_DT['date_from']); ?></td>
                        <td>Balance : </td>
                        <td><?php echo CURRENCY; ?><?php echo $AR_BAL['net_balance'];?> </td>
                        <td>Pacakage Price : </td>
                        <td><?php echo ($getTotalMemberShipValue>0)? $getTotalMemberShipValue:"---"; ?></td>
                         <td>&nbsp;</td>
                      </tr>
                   
                      <tr>
                        <!--<td colspan="8" class="center"><hr class="divider">-->
                        <!--  </hr></td>-->
                        
                        <td colspan="8" class="center" style="background-color: #797979; padding: 0px 0px 4px 0px;"> </td>
                      </tr>
                      <?php $Ctrl++; endforeach; }else{ ?>
                      <tr>
                        <td colspan="8" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
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
                              <div class="modal-dialog " role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle">Search </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                   
                                         <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("users","profilelist","");  ?>" autocomplete="off" method="get">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-12 control-label  no-padding-right" for="form-field-1-1"> Name / Email Address  :</label>
              <div class="col-sm-12">
                <input id="form-field-17" placeholder="Name / Email" name="fullname"  class="form-control col-xs-12 col-sm-12  " type="text" value="<?php echo $_GET['fullname']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> User Id  :</label>
              <div class="col-sm-12">
                <input id="form-field-16" placeholder="User Id" name="user_id"  class=" form-control col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['user_id']; ?>">
              </div>
            </div>
            
            
                        <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> Mobile No  :</label>
              <div class="col-sm-12">
                <input id="form-field-15" placeholder="Mobile No" name="member_mobile"  class="form-control col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['member_mobile']; ?>">
              </div>
            </div>
            
            <!-- 
                        <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> Pan Card  :</label>
              <div class="col-sm-12">
                <input id="form-field-14" placeholder="Pan Card" name="pan_no"  class="form-control col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['pan_no']; ?>">
              </div>
            </div>
             -->
            
            
            
            
            
                       <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> From Date  :</label>
              <div class="col-sm-12">
 <input class="form-control col-xs-12 col-sm-12 col-md-12  " name="from_date" id="from_date" value="<?php echo $_GET['from_date']; ?>" type="date"  />
              </div>
            </div>
             
            
                     
            
            
            
            
                       <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> To Date  :</label>
              <div class="col-sm-12">
    <input class="form-control col-xs-12 col-sm-12 col-md-12 date-picker" name="to_date" id="to_date" value="<?php echo $_GET['to_date']; ?>" type="date"  />
              </div>
            </div>
             
               
            
            
            
            <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> Member Status   :</label>
              <div class="col-sm-12">
                <input type="radio" name="block_sts" id="block_sts" <?php if($_GET['block_sts']=="Y"){ echo 'checked="checked"'; } ?>  value="Y">
                Block &nbsp;&nbsp;
                <input type="radio" name="block_sts" id="block_sts" value="N" <?php if($_GET['block_sts']=="N"){ echo 'checked="checked"'; } ?> >
                Un-Block </div>
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
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $("#form-valid").validationEngine();
        $("#form-valid").validationEngine();
        $(".getStateList").on('blur',getStateList);
        $(".getCityList").on('blur',getCityList);
        function getStateList(){
            var country_code = $("#country_code").val();
            var URL_STATE = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=STATE_LIST&country_code="+country_code;
            $("#state_name").load(URL_STATE);
        }
        function getCityList(){
            var state_name = $("#state_name").val();
            var URL_CITY = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=CITY_LIST&state_name="+state_name;
            $("#city_name").load(URL_CITY);
        }
    });
</script>