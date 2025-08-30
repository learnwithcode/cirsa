<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$Page = $_GET['page']; if($Page=="" || $Page <=0 ){$Page=1;}

 $wallet_id = $model->getWallet(WALLET1);///$wallet_id=1;
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



if($_GET['member_mobile']!=''){
    $member_mobile = FCrtRplc($_GET['member_mobile']);
    $StrWhr .=" AND ( tm.member_mobile = '$member_mobile' )";
    $SrchQ .="&member_mobile=member_mobile";
}

if($_GET['pan_no']!=''){
    $pan_no = FCrtRplc($_GET['pan_no']);
    $StrWhr .=" AND ( tm.pan_no = '$pan_no' )";
    $SrchQ .="&pan_no=pan_no";
}
if($_GET['user_id']!=''){
    $user_id = FCrtRplc($_GET['user_id']);
    $StrWhr .=" AND ( tm.user_id = '$user_id' )";
    $SrchQ .="&user_id=$user_id";
}
if($_GET['block_sts']!=''){
    $block_sts = FCrtRplc($_GET['block_sts']);
    $StrWhr .=" AND ( tm.block_sts = '$block_sts' )";
    $SrchQ .="&block_sts=$block_sts";
}


if($_GET['rank_id']!=''){
    $rank_id = FCrtRplc($_GET['rank_id']);
    $StrWhr .=" AND ( tm.rank_id = '$rank_id' )";
    $SrchQ .="&rank_id=$rank_id";
}


$QR_PAGES="SELECT tm.activation_sts,tm.member_id,tm.offroi,tm.allincome,tm.rank_id,tm.plan , tm.user_name,tm.user_password, tm.photo, tm.first_name, tm.midle_name, tm.last_name, tm.member_email, tm.pan_no, tm.current_address, tm.city_name, tm.state_name, tm.date_join, tm.block_sts,  CONCAT('', tm.member_phone) AS mobile_number,    CONCAT(tmsp.first_name, ' ',tmsp.midle_name,' ',tmsp.last_name) AS sname,
      tmsp.user_name AS spsr_user_id  FROM ".prefix."tbl_members AS tm  
     
         LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
          
         WHERE tm.delete_sts>0  $StrWhr GROUP BY tm.member_id   ORDER BY tm.member_id ASC";
$PageVal = DisplayPages($QR_PAGES, 400, $Page, $SrchQ);
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
                           <h4 class="card-title"> Users <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Profile List </small>  </h4>
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
                        
                      <?php 
                    if($PageVal['TotalRecords'] > 0){
                        $Ctrl= $PageVal['RecordStart']+1;
                        //echo "<pre>";
                        //print_r($PageVal);
                        foreach($PageVal['ResultSet'] as $AR_DT):                            
                                // PrintR($AR_DT);
                    //  $AR_BAL = $model->getCurrentBalance($AR_DT['member_id'],$wallet_id,"","");
$id  =$AR_DT['member_id'];
                   ?><td colspan="8" class="center" style="background-color: #797979; padding: 0px 0px 4px 0px;"> </td>
                      <tr>
                        <td width="22" rowspan="4" class="center"><label class="pos-rel"> <?php echo $Ctrl; ?> <span class="lbl"></span> </label>
                        </td>
                        
                        
                      <td>Login ID : </td>
                        <td>
                        
                         <?php 
                        
                            $AR_TYPE  = $model->getCurrentMemberShip($AR_DT['member_id']);
                            $date_from = (InsertDate($AR_TYPE['date_from']));
                            $pain_name = ($AR_TYPE['pin_name'])? $AR_TYPE['pin_name']:"Free";
                    
                            if($pain_name == 'FREE' || $AR_TYPE['prod_pv']<0){  ?>
                                   <span  onclick="copylinkuserid('<?php echo $AR_DT['user_name'];?>')" class="btn label-lg btn-danger arrowed-in arrowed-in-right"><?php echo strtoupper($AR_DT['user_name']); ?> </span> 
                          <?php  } 
                            elseif($pain_name =='Activation Package'|| $AR_TYPE['prod_pv']>0){ ?>
                                        <span   onclick="copylinkuserid('<?php echo $AR_DT['user_name'];?>')" class="btn label-lg btn-success arrowed-in arrowed-in-right"><?php echo strtoupper($AR_DT['user_name']); ?> </span> 
                        <?php     }
                            else{   ?>
                                        <span   onclick="copylinkuserid('<?php echo $AR_DT['user_name'];?>')" class="btn label-lg btn-danger arrowed-in arrowed-in-right"><?php echo strtoupper($AR_DT['user_name']); ?> </span> 
                          <?php     }   ?>
                           
                             <input type="hidden" id="cpluserid<?php echo $Ctrl; ?>"  class="form-control" style="cursor: no-drop; width: 100%" readonly value="<?php echo $AR_DT['user_name'];?>">
                        </td>
                       
                         <td width="140">Password : </td>
                        <td width="164"><?php echo $AR_DT['user_password']; ?></td>
                        
                        <td width="126">Sponsor ID : </td>
                        <td width="120"><?php echo strtoupper(($AR_DT['spsr_user_id']!='')? $AR_DT['sname'] .'[ '. $AR_DT['spsr_user_id'].' ]':"Admin"); ?></td>
                       
                        <td width="90" rowspan="4"  style="text-align: center;">
                            
                            
                          <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action  </button>
                            <ul class="dropdown-menu dropdown-default">
                                
                            
                                <?php if($group_id =='6'){?>
                               <li> <a href="<?php echo generateSeoUrlAdmin("users","updatemember",array("member_id"=>_e($AR_DT['member_id']))); ?>">Edit</a> </li>
                              <li> <a target="_blank" href="<?php echo generateSeoUrlAdmin("users","directaccesspanel",array("user_id"=>$AR_DT['user_name'])); ?>">Access Panel</a> </li>
                             
                           
                                <?php } ?>
                          
                                
                                
                                
                             
                            </ul>
                          </div>
                          <div class="space-6"></div>
                         
                          </td>
                      </tr>
                      <tr>
                        <td width="112">Full Name : </td> 
                        <td width="148"><a href="<?php echo generateSeoUrlAdmin("users","directaccesspanel",array("user_id"=>$AR_DT['user_name'])); ?>"><?php echo strtoupper($AR_DT['first_name']." ".$AR_DT['midle_name']." ".$AR_DT['last_name']); ?></a></td>
                        <td>Email Address : </td>
                        <td><?php echo $AR_DT['member_email']; ?></td>
                        <td>Plan : </td>
                        <td><strong><?php echo $pain_name; ?></strong></td>
                      </tr>
                      <tr>
                        <td>Mobile : </td>
                        <td><?php echo $AR_DT['mobile_number']; ?></td>
                        <?php if(true){ ?>
                         <td>Withdrawal : </td>
                        <td>      <?php 
                        
                           if($AR_DT['Withdrawal_status'] == '1'){
                               echo "<span class='label label-success arrowed-in arrowed-in-right'>";
                               echo strtoupper('Enable');
                               echo "</span>"; 
                            }
                            else{
                                echo "<span class='label label-danger arrowed-in arrowed-in-right'>";
                                echo strtoupper('Disable');
                               echo "</span>";  
                            }
                            ?></td>
                            <?php } ?>
                            
                        <!--<td>Plan Detail : </td>-->
                        <!--<td><?php echo ($AR_DT['pin_name']!='')? $AR_DT['pin_name']:"Free"; ?></td>-->
                        
                            <td>D.O.J[A.O.J] : </td>
                        <td><?php echo DisplayDate($AR_DT['date_join']); ?>[<?php echo DisplayDate($date_from);?>]</td>
                        
                        
                      </tr>
                      <tr>
                        
                        
                        <td  style="display:none; ">Plan Status : </td>
                        <td style="display:none; ><?php  if($AR_DT['plan']=='A'){
                        
                         ?> <span   class="btn label-lg btn-success arrowed-in arrowed-in-right"><?php echo "Plan A"; ?></span> 
                                  
                          <?php  } 
                            else{ ?>
                                        <span  class="btn label-lg btn-danger arrowed-in arrowed-in-right"><?php echo "Plan B"; ?> </span> 
                        <?php     }
                             ?>
                        
                        
                        
                        
                        
                        
                        
                        
                        </td>
                        <td>ROI Status : </td>
                        <td><?php  if($AR_DT['offroi']=='N'){
                        
                         ?> <span   class="btn label-lg btn-success arrowed-in arrowed-in-right"><?php echo "ON"; ?></span> 
                                  
                          <?php  } 
                            else{ ?>
                                        <span  class="btn label-lg btn-danger arrowed-in arrowed-in-right"><?php echo "OFF"; ?> </span> 
                        <?php     }
                             ?>
                        
                        
                        
                        
                        
                        
                        
                        
                        </td>
                         <td>All Income Status : </td>
                        <td><?php  if($AR_DT['allincome']=='N'){
                        
                         ?> <span   class="btn label-lg btn-success arrowed-in arrowed-in-right"><?php echo "ON"; ?></span> 
                                  
                          <?php  } 
                            else{ ?>
                                        <span  class="btn label-lg btn-danger arrowed-in arrowed-in-right"><?php echo "OFF"; ?> </span> 
                        <?php     }
                             ?>
                        
                        
                        
                        
                        
                        
                        
                        
                        </td>
                      </tr>
                     <tr>
                        
                        
                        
                     
                     
                        
                        
                      </tr>
                      <?php $Ctrl++; endforeach; }else{ ?>
                      <tr>
                        <td colspan="8" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                    <script>
             function copylinkuserid(id)
        {
         //alert(id);
            var link = $("#cpluserid").val(id);
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = id;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            console.log("Copied the text:", tempInput.value);
            alert('User ID Copied', 'success');
            document.body.removeChild(tempInput);
        }
         </script>
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