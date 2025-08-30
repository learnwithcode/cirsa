<?php defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
    
if($_GET['member_name']!=''){
	$member_name = FCrtRplc($_GET['member_name']);
	$StrWhr .=" AND ( tm.first_name LIKE '%$member_name%' OR tm.last_name LIKE '%$member_name%' OR tm.user_id LIKE '%$member_name%')";
	$SrchQ .="&member_name=$member_name";
}

//PrintR($_GET);die;
if($_GET['ticket_no']!=''){
	$ticket_no = FCrtRplc($_GET['ticket_no']);
	$StrWhr .=" AND   s.ticket_no = '$ticket_no'  ";
	$SrchQ .="&ticket_no=$ticket_no";
}
//$_GET['enquiry_sts'] = 'O';
if($_GET['enquiry_sts']!=''){
	$enquiry_sts = FCrtRplc($_GET['enquiry_sts']);
	$StrWhr .=" AND   s.enquiry_sts = '$enquiry_sts'  ";
	$SrchQ .="&enquiry_sts=$enquiry_sts";
}


if($_GET['from_date']!='' && $_GET['to_date']!=''){
	$from_date = InsertDate($_GET['from_date']);
	$to_date = InsertDate($_GET['to_date']);
	$StrWhr .=" AND DATE(ts.enquiry_date) BETWEEN '$from_date' AND '$to_date'";
	$SrchQ .="&from_date=$from_date&to_date=$to_date";
}
$QR_PAGES = "SELECT s.* ,tm.first_name,tm.midle_name,tm.user_id, tm.last_name FROM tbl_support as s LEFT JOIN tbl_members AS tm ON s.from_id=tm.member_id WHERE s.enquiry_id > '0' $StrWhr  ORDER BY `s`.`enquiry_sts` ASC";
//$QR_PAGES="SELECT s.* ,tm.first_name,tm.midle_name,tm.user_id, tm.last_name FROM tbl_support_rply as r1 LEFT JOIN tbl_support_rply as r2 on (r1.enquiry_id = r2.enquiry_id and r1.reply_id < r2.reply_id) LEFT JOIN tbl_support as s on r1.enquiry_id = s.enquiry_id LEFT JOIN tbl_members AS tm ON s.from_id=tm.member_id WHERE r2.reply_id IS NULL ORDER BY r1.reply_id DESC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
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
                           <h4 class="card-title"> Member <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Support </small>  </h4>
                        </div>
                
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">
                                         <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
<tr role="row">
    <th colspan="1" rowspan="1" tabindex="0" class="" style="width: 7%;">S.No</th>
<th colspan="1" rowspan="1" tabindex="0" class="" style="width: 7%;">Ticket</th>
<th style="width: 10%;">User Id</th>
<th rowspan="1" tabindex="0" style="width: 10%;">Name</th>

<th colspan="1" rowspan="1" tabindex="0" style="width: 23%;">Date</th>
<th rowspan="1" tabindex="0" style="width: 0%;">Type </th>
<th rowspan="1" tabindex="0" style="width: 26%;">Subject </th>
<th colspan="1" rowspan="1" tabindex="0" style="width: 10%;">Status</th>
<th rowspan="1" tabindex="0" style="width: 17%;">Action</th>
</tr>
                    </thead>
                    <tbody>
                      <?php 
					if($PageVal['TotalRecords'] > 0){
					    	$Ctrl= $PageVal['RecordStart']+1;
					 
					foreach($PageVal['ResultSet'] as $AR_DT):
				
					?>
                      <tr class="odd" role="row">
                           <td><?php echo $Ctrl; ?></td>
                        <td><?php echo $AR_DT['ticket_no']; ?></td>
                        <td><?php echo strtoupper($AR_DT['user_id']);?></td>
                        <td><?php echo strtoupper($AR_DT['first_name']." ".$AR_DT['midle_name']." ".$AR_DT['last_name']); ?></td>
                       
                        <td><?php echo getDateFormat($AR_DT['reply_date'],"d M Y h:i"); ?></td>
                        <td><?php echo $AR_DT['type']; ?></td>
                        <td><?php echo $AR_DT['subject']; ?></td>
                         <td><?php echo DisplayText("TICKET_".$AR_DT['enquiry_sts']); ?></td>
                        <td>
						
						<a href="<?php echo generateSeoUrlAdmin("users","conversation",array("enquiry_id"=>_e($AR_DT['enquiry_id']))); ?>"  class="btn btn-sm btn-primary m-t-n-xs" style="border-width: 4px;font-size: 14px;margin: 2px;line-height: 1.38;"> View<!--<img src="<?php echo BASE_PATH; ?>assets/img/policyicon.gif" id="<?php echo $AR_DT['enquiry_id']; ?>" class="viewChat pointer">--> </a>     
						
						
						<?php if($AR_DT['enquiry_sts']!='C'){ ?>
								   <a onClick="return confirm('Make sure, you want to close this tickets?')" class="btn btn-sm btn-danger m-t-n-xs" style="border-width: 4px;font-size: 14px;padding: 0px 0px;line-height: 1.38;" href="<?php echo generateSeoUrlAdmin("users","membersupport",array("enquiry_id"=>_e($AR_DT['enquiry_id']),"action_request"=>"CLOSE","page"=>$_GET['page'])); ?>">
								   	Close Ticket
								   </a>
								   <?php } ?> </td>
                      </tr>
                      <?php $Ctrl++; endforeach; 
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