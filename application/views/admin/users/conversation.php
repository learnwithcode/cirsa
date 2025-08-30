<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$segment = $this->uri->uri_to_assoc(2);
	$enquiry_id = ($form_data['enquiry_id'])? $form_data['enquiry_id']:_d($segment['enquiry_id']);


	$member_id = $this->session->userdata('mem_id');
	
	$QR_TICK = "SELECT ts.* FROM tbl_support AS ts WHERE enquiry_id='".$enquiry_id."'";
	$AR_TICK = $this->SqlModel->runQuery($QR_TICK,true);
		
	$QR_PAGES="SELECT tsr.*, tm.first_name,tm.midle_name,tm.user_id, tm.last_name FROM ".prefix."tbl_support_rply AS tsr LEFT JOIN tbl_members AS tm ON tsr.member_id=tm.member_id WHERE  
				tsr.enquiry_id='".$enquiry_id."' ORDER BY tsr.enquiry_id ASC";
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
                                   
               
                                      <div class="widget-box">
              <div class="widget-body">
                <div class="widget-main no-padding">
                  <div class="dialogs">
                    <?php 
				if($PageVal['TotalRecords'] > 0){
				$Ctrl=1;
				foreach($PageVal['ResultSet'] as $AR_DT):
				?>
                    <div class="itemdiv dialogdiv">
                      <div class="user"> <img alt="Bob's Avatar" src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" style="width:100px;"/> </div>
                      <div class="body">
                        <div class="time"> <i class="ace-icon fa fa-clock-o"></i> <span class="orange"><?php echo getDateFormat($AR_DT['reply_date'],"d M, Y h:i"); ?></span> </div>
                        <div class="name"> <a target="_blank" href="<?php echo generateSeoUrlAdmin("users","directaccesspanel",array("user_id"=>$AR_DT['user_id'])); ?>"><?php echo ($AR_DT['first_name'])? $AR_DT['first_name'] .' '.$AR_DT['midle_name'].' '.$AR_DT['last_name'].' ['.$AR_DT['user_id'] .' ]':"Technical Support"; ?></a>
                         <a target="_blank" style="color:red;" href="<?php echo generateSeoUrlAdmin("users","updatemember",array("member_id"=>_e($AR_DT['member_id']))); ?>">Profile Edit </a>
                          <?php if($AR_DT['member_id']==0){ ?>
                          <span class="label label-info arrowed arrowed-in-right"><!--Technical Support--></span>
                          <?php } ?>
                        </div>
                        <div class="text"><?php echo $AR_DT['enquiry_reply']; ?></div>
                        <div class="tools"> <a href="javascript:void(0)" class="btn btn-minier btn-info"> <i class="icon-only ace-icon fa fa-share"></i> </a> </div>
                      </div>
                    </div>
                    <?php endforeach;
				 }
				  ?>
                  </div>
                  <?php if($AR_TICK['enquiry_sts']!="C"){ ?>
                  <form action="<?php echo ADMIN_PATH; ?>users/conversation" method="post" name="form-chat" id="form-chat">
                    <div class="form-actions">
                      <div class="input-group">
                        <input placeholder="Type your message here ..." type="text" class="form-control validate[required]"  name="enquiry_reply" id="enquiry_reply" />
                        <input type="hidden" name="enquiry_id" id="enquiry_id"  value="<?php echo $enquiry_id; ?>">
                        <span class="input-group-btn">
                        <button class="btn btn-sm btn-info no-radius" name="chatSubmit" value="1" type="submit"> <i class="ace-icon fa fa-share"></i> Send </button>
                         <a href="<?php echo ADMIN_PATH; ?>users/membersupport"  class="btn btn-sm btn-danger no-radius"> <i class="fa fa-backward"></i> Back </a>
                        </span> </div>
                    </div>
                  </form>
                  <?php }else{ ?>
				  
				  <div class="form-actions">
				  <div class="input-group">
				   <a href="javascript:void(0);"onclick="window.history.back();" class="btn btn-sm btn-danger no-radius"> <i class="fa fa-backward"></i> Back </a>
				  </div> 
				</div>  
				  <?php } ?>
                </div>
                <!-- /.widget-main -->
              </div>
              <!-- /.widget-body -->
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
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
		$("#form-chat").validationEngine();
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		
	});
</script>