<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
//$form_data = $this->input->post();
//$segment = $this->uri->uri_to_assoc(2);
//$member_id = ($form_data['member_id'])? $form_data['member_id']:_d($segment['member_id']);

//$AR_MEM = $model->getMember($member_id);
  $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

if($_GET['user_id']!=''){
    $user_id = FCrtRplc($_GET['user_id']);
    $StrWhr .=" AND ( user_id = '$user_id' )";
    $SrchQ .="&user_id=$user_id";
}
if($_GET['status']!=''){
    $status = (FCrtRplc($_GET['status']) =='A')?1:0;   
    $StrWhr .=" AND ( pan_card = '$status' AND adhaar_front = '$status' AND adhaar_back = '$status' )"; 
    $SrchQ .="&status=$_GET[status]";
}





$QR_MEM = "SELECT * FROM `tbl_kyc_status` where id > 0 $StrWhr ORDER BY `tbl_kyc_status`.`date_time` DESC";
$PageVal = DisplayPages($QR_MEM, 100, $Page, $SrchQ);
//  echo $this->db->last_query();
 
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
                           <h4 class="card-title"> Users <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Kyc List </small>  </h4>
                        </div>
                        <div class="clearfix">

              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">
                                       <table width="100%" border="0" cellpadding="5" cellspacing="1" class="table table-striped table-bordered table-hover">
         
            <tr class="">
              <td align="left">Srl N</td>
             <td align="left">Update Date </td>
              <td align="left">User ID </td>
              <td align="left">User Name</td>
              
              <td align="left">PAN Card </td>
              <td  align="left">Adhar Front </td>
              <td  align="left">Adhar Back</td>
               <td  align="left">Cheque</td>
               <td  align="left">International id/Passport</td>
              <td  align="left">Action</td>
            </tr> 
           
            <?php 
            if($PageVal['TotalRecords'] > 0){
            $Ctrl = $PageVal['RecordStart']+1;
            foreach($PageVal['ResultSet'] as $AR_DT){   
         
            ?>
           
             <tr class=""  style="cursor:pointer">
              <td  align="center" valign="top" class="cmntext"><?php echo $Ctrl;?></td>
               <td align="left" valign="middle" class="cmntext"><?php echo date('d-M-Y',strtotime($AR_DT['date_time']));?></td>  
               <td align="left" valign="middle" class="cmntext"><?php echo $AR_DT['user_id'];?></td>
              <td align="left" valign="middle" class="cmntext"><?php echo $AR_DT['name'];?> </td>
              <td align="left" valign="middle" class=""><?php   if($AR_DT['pan_card']=='0'){echo '<i class="fa fa-clock-o " aria-hidden="true" style="color: #c3c30d;"></i>';} elseif($AR_DT['pan_card']=='1'){echo '<i class="fa fa-check green" aria-hidden="true"></i>';} elseif($AR_DT['pan_card']=='-1'){echo '<i class="fa fa-ban red" aria-hidden="true"></i>';} else{echo '<i class="fa fa-upload blue" aria-hidden="true"></i>';}?></td>
            <td align="left" valign="middle" class=""><?php   if($AR_DT['adhaar_front']=='0'){echo '<i class="fa fa-clock-o " aria-hidden="true" style="color: #c3c30d;"></i>';} elseif($AR_DT['adhaar_front']=='1'){echo '<i class="fa fa-check green" aria-hidden="true"></i>';} elseif($AR_DT['adhaar_front']=='-1'){echo '<i class="fa fa-ban red" aria-hidden="true"></i>';} else{echo '<i class="fa fa-upload blue" aria-hidden="true"></i>';}?></td>
            <td align="left" valign="middle" class=""><?php   if($AR_DT['adhaar_back']=='0'){echo '<i class="fa fa-clock-o " aria-hidden="true" style="color: #c3c30d;"></i>';} elseif($AR_DT['adhaar_back']=='1'){echo '<i class="fa fa-check green" aria-hidden="true"></i>';} elseif($AR_DT['adhaar_back']=='-1'){echo '<i class="fa fa-ban red" aria-hidden="true"></i>';} else{echo '<i class="fa fa-upload blue" aria-hidden="true"></i>';}?></td>
            <td align="left" valign="middle" class=""><?php   if($AR_DT['cheque']=='0'){echo '<i class="fa fa-clock-o " aria-hidden="true" style="color: #c3c30d;"></i>';} elseif($AR_DT['cheque']=='1'){echo '<i class="fa fa-check green" aria-hidden="true"></i>';} elseif($AR_DT['cheque']=='-1'){echo '<i class="fa fa-ban red" aria-hidden="true"></i>';} else{echo '<i class="fa fa-upload blue" aria-hidden="true"></i>';}?></td>
         
         <td align="left" valign="middle" class=""><?php   if($AR_DT['internationid']=='0'){echo '<i class="fa fa-clock-o " aria-hidden="true" style="color: #c3c30d;"></i>';} elseif($AR_DT['internationid']=='1'){echo '<i class="fa fa-check green" aria-hidden="true"></i>';} elseif($AR_DT['internationid']=='-1'){echo '<i class="fa fa-ban red" aria-hidden="true"></i>';} else{echo '<i class="fa fa-upload blue" aria-hidden="true"></i>';}?></td>

         
            <td align="left" valign="middle" class="cmntext"><a  target="_blank"   href="<?php echo generateSeoUrlAdmin("users","kyc",array("member_id"=>_e($AR_DT['member_id']))); ?>"><i class="fa fa-eye"></i> View</a>
             
         
              </td>
            </tr>
            <?php  $Ctrl++; }?>
            <?php }else{?>
            <tr>
              <td colspan="7" align="center" class="errMsg">No Data found <a href="<?php echo generateSeoUrlAdmin("users","kyc_list",""); ?>">&lt; &lt; Back</a></td>
            </tr>
            <?php } ?>
          </table>
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
        $("#form-valid").validationEngine();
    });
</script>