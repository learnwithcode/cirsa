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


$QR_PAGES="SELECT s.*,m.user_id,m.first_name FROM `tbl_p2p_sale` as s LEFT JOIN tbl_members as m on m.member_id = s.member_id WHERE 1 ORDER BY s.id DESC";
$PageVal = DisplayPages($QR_PAGES, 25, $Page, $SrchQ);



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
                           <h4 class="card-title"> P2P <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Sell  History </small>  </h4>
                        </div>
                        <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
                    <a  style="color:white;display:none;"  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold" data-toggle="modal" data-target="#exampleModalLong " ><span><i class="fa fa-search "></i> <span >Search</span></span></a>
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">
                                        <table class="table table-custom" id="project-progress">
                                         <thead>
                       <tr>
                            <th>Date</th>
                            <th>OrderId</th>
                            <th>User Id</th>
                            <th>Name</th>   
                            <th>Amount</th>
                            <th>Status</th>                     
                        </tr>

                            
                     </thead>
                      <tbody>  <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									    
                                    // $AR_DT['adjust_amt']
                                    // $AR_DT['amount']   
                                    
                                    $per  = $AR_DT['amount'] /100;
                                    $net  = $AR_DT['adjust_amt'] / $per;
                                    $net1 = ($net > 0 )?$net+2:0;  
                                   
									    
								?>
								
							 
                                      <tr  class="odd" role="row" style="background-image: linear-gradient(to right,#aed6ae <?php echo $net;?>%,#d3d8d3 <?php echo $net1;?>%)">
                                        
                                      <td class="sorting_1"><?php echo date('d-F:Y h:i A',strtotime($AR_DT['date_time'])); ?></td>
                                      <td>#71000<?php echo $AR_DT['id'];?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['user_id']; ?></td>
                                       <td class="sorting_1"><?php echo $AR_DT['first_name']; ?></td>
                                      <td class="sorting_1"><?php echo CURRENCY.' '.  number_format($AR_DT['adjust_amt'],2); ?>/<?php echo CURRENCY.' '.  number_format($AR_DT['amount'],2); ?></td>
                                      
                                      <td>
                                          <?php if($AR_DT['status'] =='Y') { ?>
                                           <span class="btn btn-lg btn-success arrowed-in arrowed-in-right">Success</span>
                                          <?php } elseif($AR_DT['status'] =='N') { ?>
                                         <a href="<?php echo BASE_PATH;?>admin/users/sellHistory/A/<?php echo _e($AR_DT['id']);?>" class="btn btn-success btn-xxs"   >Approve</a>
                                           <!--<span class="btn btn-warning btn-xxs">Pending</span>-->
                                          <?php  } else { ?>
                                           <span class="btn btn-lg btn-danger arrowed-in arrowed-in-right">Reject</span>
                                          <?php } ?>
                                      </td>
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="6" align="center">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
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