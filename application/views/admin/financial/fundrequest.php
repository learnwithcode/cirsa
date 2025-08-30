<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}

  
  
  $model = new OperationModel();
  $form_data = $this->input->post();
  
 // PrintR($_GET);die;
  $today_date = getLocalTime();
  $segment = $this->uri->uri_to_assoc(2);
  $action_request = ($form_data['action_request'])? $form_data['action_request']:$segment['action_request'];
  $request_id = ($form_data['request_id'])? $form_data['request_id']:_d($segment['request_id']);
  $Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
  
  $wallet_id = $model->getWallet(WALLET1);


  if($_GET['user_id']!=''){
    $member_id = $model->getMemberId($_GET['user_id']);
    $StrWhr .=" AND tm.member_id='$member_id'";
    $SrchQ .="&user_id=$user_id";
  }
  
  if($_GET['processor_id']>0){
    $processor_id = FCrtRplc($_GET['processor_id']);
    $StrWhr .=" AND tft.processor_id='$processor_id'";
    $SrchQ .="&processor_id=$processor_id";
  }

  if($_GET['from_date']!='' && $_GET['to_date']!=''){
    $from_date = InsertDate($_GET['from_date']);
    $to_date = InsertDate($_GET['to_date']);
    $StrWhr .=" AND DATE(tft.date_time) BETWEEN '$from_date' AND '$to_date'";
    $SrchQ .="&from_date=$from_date&to_date=$to_date";
  }
  
  if($_GET['trns_status']!=''){
    $trns_status = FCrtRplc($_GET['trns_status']);
    $StrWhr .=" AND tft.status='".$trns_status."'";
    $SrchQ .="&trns_status=$trns_status";
  }else{
      
    $trns_status='P';  
      
  }
    
  if($action_request!='') {
 
    $trns_status = _d($segment['status']);
    switch($action_request){
      case "STS":
        switch($trns_status):
          case "S":
          
            $trns_date = InsertDate($today_date);
            $AR_TRF = $model->getFundRequest($request_id);
            $AR_MEM = $model->getMember($AR_TRF['member_id']);
          $wallet_id =  $AR_TRF['wallet_id'];
           $member_id = $AR_TRF['member_id'];
           $amount = $AR_TRF['request_amount'];
           $trns_remark  =AR_TRF['remark']; 
            if($AR_TRF['status']=='P'){
              if($AR_TRF['request_amount']>0){
               $trns_type = 'Cr';
                $trans_no = UniqueId("TRNS_NO");
                 $data = array(
                  "wallet_id"=>$wallet_id, 
                "trans_no"=>$trans_no,
                "from_member_id"=>0,
                "to_member_id"=>$member_id,
                "initial_amount"=>$amount,
                "withdraw_fee"=>0,
                "deposit_fee"=>0,
                "process_fee"=>0,
                "admin_charge"=>0,
                "trns_amount"=>$amount,
                "trns_remark"=>$AR_TRF['remark'],
                "trns_type"=>$trns_type,
                "trns_for"=>'Fund Request',
                "trns_status"=>"C",
                "draw_type"=>'Cr',
                "trns_date"=>$today_date
              );
               
                  
              $this->SqlModel->insertRecord(prefix."tbl_fund_transfer",$data);
                $model->wallet_transaction($wallet_id,$trns_type,$member_id,$amount,$AR_TRF['remark'],$today_date,$trans_no,"1","AM");
              $this->SqlModel->updateRecord(prefix."tbl_fund_request",array("status"=>$trns_status), array("request_id"=>$request_id));
                  
                  set_message("success","Fund transfer successfull");   
                  redirect_page("financial","fundrequest",array());
                }else{
                  set_message("warning","Inavlid process, please check fund request");    
                  redirect_page("financial","fundrequest",array());
                }
            }else{
              set_message("warning","Unable to process your request");    
              redirect_page("financial","fundrequest",array());
            }
          break;
          case "R":
            $trns_date = InsertDate($today_date);
            $AR_TRF = $model->getFundRequest($request_id);
          
            $AR_MEM = $model->getMember($AR_TRF['member_id']);
            if($AR_TRF['request_amount']>0){
              if($AR_TRF['request_id']>0 && $AR_MEM['member_id']>0){
                $this->SqlModel->updateRecord(prefix."tbl_fund_request",array("status"=>$trns_status),array("request_id"=>$request_id));
              //  $model->wallet_transaction($AR_TRF['wallet_id'],"Cr",$AR_MEM['member_id'],$AR_TRF['initial_amount'],"Withdrawal request rejected",$trns_date,$AR_TRF['trans_no'],"1","WITHDRAW");             
                set_message("success","Fund transfer rejected succesfully");    
                redirect_page("financial","fundrequest",array());
              }else{
                set_message("warning","Tranaction failed , please try again");    
                redirect_page("financial","fundrequest",array()); 
              }
            }else{
              set_message("warning","Unable to process your request");    
              redirect_page("financial","fundrequest",array());
            }
          break;
        endswitch;        
      break;
    }
  }
 $QR_PAGES="SELECT tft.*, tm.first_name, tm.last_name, tm.user_id , tm.user_name
       FROM tbl_fund_request AS tft 
       LEFT JOIN tbl_members AS tm ON tft.member_id=tm.member_id 
      
       WHERE  tft.status ='$trns_status' 
       $StrWhr ORDER BY tft.request_id DESC";
$PageVal = DisplayPages($QR_PAGES, 10, $Page, $SrchQ);
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
                           <h4 class="card-title"> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Fund Request</small>  </h4>
                        </div>
                       
                     </div>
                       <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
                    <a  style="color:white;"  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold" data-toggle="modal" data-target="#exampleModalLong " ><span><i class="fa fa-search "></i> <span >Search</span></span></a>
                   <a  href="<?php echo generateSeoUrlAdmin("excel","funrequestconfirmed",""); ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV Confirm Record</span></span></a> 
                   
                    
                     </div>
                </div>
              </div>
                  <div class="header-title">
                        <!--<h4 class="card-title">  <code> TRX Price : <?php echo $price;?>   || Available TRX <?php echo number_format($model->getValue("VIRTUAL_WALLET_CRYPTO")   ); ?>/-</code></h4>-->
                     </div>
              
        
                
                <div class="clearfix">&nbsp;</div>
                <div class="table-responsive-row">
                  <table  class="table table-striped table-bordered table-hover" id="no-more-tables">
                    <thead>
                      <tr>
                        <!--<th>Action</th>-->
                        <th>Sr No</th>
                           <th  style="padding: 4px;">User Name  </th>
                        <th  style="padding: 4px;">Mode  </th>
                             <th  style="padding: 4px;">Amount </th>
                              <th style="padding: 4px;">Deposit Date</th>
                          
                                  <th style="padding: 4px;">Remarks </th>
                                    <th style="padding: 4px;">Trn/#code  </th>
                                 <th style="padding: 4px;">File</th>
                                  <th style="padding: 4px;">Date & Time</th>
                                    <th style="padding: 4px;">Reject Remarks </th>
                        <th>Action / Status</th>
                        <!--<th>Update Date </th>-->
                        <!--<th>Bank</th>-->
                      </tr>
                    </thead>
                      <tbody>
                        <?php 
          if($PageVal['TotalRecords'] > 0){
              $Ctrl=$PageVal['RecordStart']+1;
            foreach($PageVal['ResultSet'] as $AR_DT):
             ?>
                        <tr>
                          <!--<td data-title="Action" class=""><?php if($AR_DT['status']=="P"){ ?>-->
                          <!--  <input type="checkbox"  name="trns_status[]" id="" value="<?php echo $AR_DT['request_id']; ?>">-->
                          <!--  <?php } ?>-->
                          <!--</td>-->
                          <td data-title="Srl No" class=""><?php echo $Ctrl; ?></td>
                           <td  data-title="Username"><?php echo $AR_DT['user_name']; ?></td>
                              <td class="sorting_1">INR <?php //echo $AR_DT['mode']; ?></td>
                                 <td class="sorting_1"><?php echo CURRENCY; ?> <?php echo $AR_DT['request_amount']; ?></td>
                           <td  data-title="Date"><?php echo DisplayDate($AR_DT['deposit_date']); ?></td>
                            <td><?php echo $AR_DT['remark']; ?></td>
                             <td><a target="_blank" href="https://bscscan.com/tx/<?php echo $AR_DT['trn_hascode']; ?>"><?php echo $AR_DT['trn_hascode']; ?></a></td>
                           <form method="post" name="form-valid" id="form-valid" onSubmit="return confirm('Make sure , want to changes transaction statuddds?')" action="<?php echo generateAdminForm("financial","fundrequest",""); ?>">
                  
                         
                               <td  data-title="Files"><a href="<?php echo BASE_PATH;?>upload/requestfile/<?php echo $AR_DT['files']; ?>" target="_blank" >View Files</a></td>
                                  <td  data-title="Date"><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                                         <td> <input  placeholder="Update Remarks"  name="rejectremarks" autocomplete="off" class="form-control" value="<?php echo $AR_DT['rejectremarks']; ?>" type="text" >
					  </td>
                          <td  data-title="Status"><?php if($AR_DT['status']=="S"){ ?>
                            <a href="javascript:void(0)" onClick="alert('Already confirmed')" class="btn btn-success arrowed-in arrowed-in-right">Confirmed</a>
                            <?php }elseif($AR_DT['status']=="R"){ ?>
                            <a  href="javascript:void(0)" onClick="alert('Already rejected')"   class="btn btn-warning">Rejected</a>
                            <?php }else{ ?>
                            <a href="<?php echo generateSeoUrlAdmin("financial","fundrequest",array("request_id"=>_e($AR_DT['request_id']),"status"=>_e("S"),"action_request"=>"STS")); ?>" onClick="return confirm('Make sure want to approved this  fund request')" class="btn btn-success arrowed-in arrowed-in-right">Confirm</a> &nbsp;&nbsp;
                         
                         <input id="request_id"  placeholder="Update Remarks"  name="request_id" autocomplete="off" value='<?php echo _e($AR_DT['request_id']);?>' class="form-control validate[required,custom[integer]]" type="hidden" >
                         <input id="status"  placeholder="Update Remarks"  name="status" autocomplete="off" value='<?php echo _e("R");?>' class="form-control validate[required,custom[integer]]" type="hidden" >
                         <input id="action_request"  placeholder="Update Remarks"  name="action_request" value='STS' autocomplete="off" class="form-control validate[required,custom[integer]]" type="hidden" >
                         
                         
                         
                            <button type="submit" class="btn btn-danger" name="submitTransaction" value='1' >Reject</button>
                            <?php } ?>
                          </td>
                            </form>
                          <!--<td data-title="Update Date"><?php echo DisplayDate($AR_DT['status_up_date']); ?></td>-->
                          <!--<td  data-title="Bank" align="center"><a href="javascript:void(0)" transfer_id="<?php echo _e($AR_DT['transfer_id']); ?>" class="label label-info open_bank_detail">Bank Detail</a></td>-->
                        </tr>
                        <?php $Ctrl++; endforeach; ?>
                        <!--<tr>-->
                        <!--  <td colspan="11"><button type="submit" class="btn btn-success" name="confirmWithdraw" value="1" >Confirm</button>-->

                        <!--    <button type="submit" class="btn btn-danger" name="rejectWithdraw" value="1" >Reject</button></td>-->
                        <!--</tr>-->
                        <?php  }else{ ?>
                        <tr>
                          <td colspan="11" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No withdrawals requests found</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                  
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
                                   
                                        <form class="form-horizontal"  name="form-page" id="form-page"  autocomplete="off"  method="get"  action="<?php echo generateAdminForm("financial","fundrequest",""); ?>" >
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
                          <input type="radio" name="trns_status" id="trns_status" <?php echo $c;   ?> value="S">
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
            
 <input class="form-control col-xs-12 col-sm-12  date-picker" name="from_date" id="from_date" value="<?php echo $ROW['from_date']; ?>" type="date"  />
              </div>
            </div>
            
            
                        <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">To Date :</label>
              <div class="col-sm-7">
              
 <input class="form-control col-xs-12 col-sm-12  date-picker" name="to_date" id="to_date" value="<?php echo $ROW['to_date']; ?>" type="date"  />
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