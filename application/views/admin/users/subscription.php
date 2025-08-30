<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
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
    
     $member_id = $model->getMemberId($_GET['user_id']);
    
    $member_id = FCrtRplc($member_id);
    $StrWhr .=" AND ( tm.member_id = '$member_id' )";
     $user_id = $model->getMemberUserId($member_id);
    
    $SrchQ .="&user_id=$user_id";
}
if($_GET['block_sts']!=''){
    $block_sts = FCrtRplc($_GET['block_sts']);
    $StrWhr .=" AND ( tm.block_sts = '$block_sts' )";
    $SrchQ .="&block_sts=$block_sts";
}

if($_GET['active_by']!=''){
    $by_id = FCrtRplc($_GET['active_by']);
    if($by_id =='0')
       {
        $StrWhr .=" AND ( ts.active_by = '$by_id' )";   
       }
else
{
   $StrWhr .=" AND ( ts.active_by > '0' )";    
}

    
    $SrchQ .="&active_by=$by_id";
}
$QR_PAGES = "SELECT ts.*, tp.pin_name , tp.daily_return, tp.no_day, tp.daily_return*tp.no_day AS total_return,
                tm.user_id,tm.member_mobile,
                CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name, 
                tmsp.user_id AS spsr_user_id
                FROM ".prefix."tbl_subscription AS ts 
                LEFT JOIN ".prefix."tbl_pintype AS tp ON tp.type_id=ts.type_id
                LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=ts.member_id
                LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
                WHERE 1 $StrWhr
            
                ORDER BY ts.subcription_id DESC";
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
                           <h4 class="card-title"> Users <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Subscriptions List </small>  </h4>
                        </div>
                        <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
                    <a  style="color:white;"  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold" data-toggle="modal" data-target="#exampleModalLong " ><span><i class="fa fa-search "></i> <span >Search</span></span></a>
                    <a  href="<?php echo generateSeoUrlAdmin("excel","subscription",""); ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">
                                        <table id="" class="table">
                    <thead>
                    </thead>
                    <tbody>
                      <?php 
                    if($PageVal['TotalRecords'] > 0){
                        $Ctrl=$PageVal['RecordStart']+1;
                        foreach($PageVal['ResultSet'] as $AR_DT): 
                            
                               
                            $activeBy = $AR_DT['active_by'];
                            if($activeBy > 0 )
                            {
                                 $activatedBy = $model->getMemberUserId($activeBy);
                                   $membername['full_name'] = $model->getnamebyuserid($activatedBy);
                                
                                 
                            }
                            else
                            {
                                $activatedBy = 'Admin';
                                 $membername['full_name'] = $model->getnamebyuserid('user');
                            }
                   ?>
                   <tr><td colspan="8" class="center" style="background-color: #797979; padding: 0px 0px 4px 0px;"> </td>
                      </tr>
                      <tr>
                        <td width="22" rowspan="3" class="center"><label class="pos-rel"> <?php echo $Ctrl; ?> <span class="lbl"></span> </label>                        </td>
                        <td width="112">Full Name : </td>
                        <td width="148"><a href="javascript:void(0)"><?php echo $AR_DT['full_name']; ?>[<?php echo $AR_DT['user_id']; ?>]</a></td>
                        <td width="126">Mobile No : </td>
                        <td width="120"><?php echo $AR_DT['member_mobile']; ?></td>
                        <td width="140">Date Of Joining : </td>
                        <td width="164"><?php echo DisplayDate($AR_DT['date_from']); ?></td>
                        <td width="90" rowspan="3"><div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action </button>
                            <ul class="dropdown-menu dropdown-default">
                              <li> <a href="<?php echo generateSeoUrlAdmin("bonus","dailyincome",""); ?>?member_id=<?php echo  _e($AR_DT['member_id']); ?>&subcription_id=<?php echo _e($AR_DT['subcription_id']); ?>">View</a> </li>                            
                          <li> 
                              <a onClick="return confirm('Make sure , you want to Deactivate/Delete From subscription?')" 
                              href="<?php echo generateSeoUrlAdmin("users","subscription",array("subcription_id"=>_e($AR_DT['subcription_id']),
                              "status"=>$AR_DT['isActive'],"action_request"=>"STATUS")); ?>"> Delete
                             <!-- <?php //echo ($AR_DT['isActive']=="0")? "Resume":"Suspend"; ?>-->
                              </a> </li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td>Plan or Amount : </td>
                        <td><?php echo $AR_DT['pin_name']; ?>(<?php echo number_format($AR_DT['total_amt']); ?>)</td>
                         <td>Activated By : </td>
                        <td colspan="2"><?php echo strtoupper($activatedBy);?>[<?php echo strtoupper($membername['full_name']);?>]</td>
                        
                      </tr>
                  
                     
                      <tr>
                        <!--<td colspan="8" class="center"><hr class="divider">
                          </hr></td>-->
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
                                   
                                         <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("users","subscription","");  ?>" autocomplete="off" method="get">
          <div class="modal-body">
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> User Id  :</label>
              <div class="col-sm-7">
                <input id="form-field-16" placeholder="User Id" name="user_id"  class="form-control  col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['user_id']; ?>">
              </div>
            </div>
           
                   
                       <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> To Date  :</label>
              <div class="col-sm-7">
    <input class="form-control col-xs-4 col-sm-3 col-md-6 form-control " name="from_date" id="from_date" value="<?php echo $_GET['from_date']; ?>" type="date"  />
              </div>
            </div>
             
               

                       <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> From   :</label>
              <div class="col-sm-7">
 <input class="form-control col-xs-4 col-sm-3 col-md-6  form-control " name="to_date" id="to_date" value="<?php echo $_GET['to_date']; ?>" type="date"  />
              </div>
            </div>
            
            
            
            
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Active By   :</label>
              <div class="col-sm-7">
                <select name="active_by" class="form-control " >
                             <option value="1" <?php if($_GET['active_by']=='0'){ echo "selected"; }?>>Member</option>
                             <option value="0" <?php if($_GET['active_by']=='1'){ echo "selected";} ?>>Admin</option>
                             <option value="" <?php if($_GET['active_by']==''){ echo "selected";} ?>>All</option>
                         </select>  </div>
            </div>
          </div>
          <div class="modal-footer">
            <input class="btn btn-primary m-t-n-xs" value=" Search " type="submit">
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
        
    });
</script>