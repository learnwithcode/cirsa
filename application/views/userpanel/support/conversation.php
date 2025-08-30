<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$segment = $this->uri->uri_to_assoc(2);
	$enquiry_id = ($form_data['enquiry_id'])? $form_data['enquiry_id']:_d($segment['enquiry_id']);	

	$member_id = $this->session->userdata('mem_id');
	
	$QR_TICK = "SELECT ts.* FROM tbl_support AS ts WHERE enquiry_id='".$enquiry_id."'";
	$AR_TICK = $this->SqlModel->runQuery($QR_TICK,true);

		
	$QR_PAGES="SELECT tsr.* FROM ".prefix."tbl_support_rply AS tsr WHERE  tsr.enquiry_id='".$enquiry_id."' ORDER BY tsr.enquiry_id ASC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
?>
	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	<div class="main-content">
			<div class="container">
				<div class="page-inner">
				
					<div class="row">
					    <div class="col-md-12">
							<div class="card">
							
								<div class="card-body">
								    
								     <div class="widget-main no-padding">
                  <div class="dialogs">
                    <?php 
				if($PageVal['TotalRecords'] > 0){
				$Ctrl=1;
				foreach($PageVal['ResultSet'] as $AR_DT):
				?>
                    <div class="itemdiv dialogdiv">
                     
                      <div class="body">
                        <div class="time"> <i class="ace-icon fa fa-clock-o"></i> <span class="orange"><?php echo getDateFormat($AR_DT['reply_date'],"d M, Y h:i"); ?></span> </div>
                        <div class="name"> 
                          <?php if($AR_DT['member_id']==0){ ?>
                          <a href="#"><?php echo ($AR_DT['first_name'])? $AR_DT['first_name'] .' '.$AR_DT['midle_name'].' '.$AR_DT['last_name'].' ['.$AR_DT['user_id'] .' ]':"Admin"; ?></a>
                          <span class="label label-info arrowed arrowed-in-right">admin</span>
                          <?php } 
                          elseif($AR_DT['member_id']=='-1'){
                          ?>
                          <a href="#"><?php echo ($AR_DT['first_name'])? $AR_DT['first_name'] .' '.$AR_DT['midle_name'].' '.$AR_DT['last_name'].' ['.$AR_DT['user_id'] .' ]':"Accountant"; ?></a>
                           <span class="label label-info arrowed arrowed-in-right">Account</span>
                           <?php }  
                          elseif($AR_DT['member_id']=='-2'){
                          ?>
                          <a href="#"><?php echo ($AR_DT['first_name'])? $AR_DT['first_name'] .' '.$AR_DT['midle_name'].' '.$AR_DT['last_name'].' ['.$AR_DT['user_id'] .' ]':"Courier"; ?></a>
                           <span class="label label-info arrowed arrowed-in-right">Courier</span>
                           <?php } ?>
                           
                        </div>
                        <div class="text"><?php echo $AR_DT['enquiry_reply']; ?></div>
                        
                      </div>
                    </div>
                    <?php endforeach;
				 }
				  ?>
                  </div>
                  <?php if($AR_TICK['enquiry_sts']!="C"){ ?>
                  <form action="<?php echo MEMBER_PATH; ?>support/conversation" method="post" name="form-chat" id="form-chat">
                    <div class="form-actions">
                      <div class="input-group">
                        <input placeholder="Type your message here ..." type="text" class="form-control validate[required]"  name="enquiry_reply" id="enquiry_reply" />
                        <input type="hidden" name="enquiry_id" id="enquiry_id"  value="<?php echo $enquiry_id; ?>">
                        <span class="input-group-btn">
                        <button class="btn btn-sm btn-info no-radius" name="chatSubmit" value="1" type="submit"> <i class="ace-icon fa fa-share"></i> Send </button>
                        <button onClick="window.location.href='<?php echo generateSeoUrlMember("support","contactsupport",""); ?>'" class="btn btn-sm btn-info no-radius" name="back" style="margin-left:6px;"  type="button"> <i class="fa fa-backward"></i> Back </button>
                        </span> </div>
                    </div>
                  </form>
                  <?php } else{?>
				  <div class="form-actions">
				  <div class="input-group">
				   <button onClick="window.location.href='<?php echo generateSeoUrlMember("support","contactsupport",""); ?>'" class="btn btn-sm btn-info no-radius" name="back" style="margin-left:6px;"  type="button"> <i class="fa fa-backward"></i> Back </button>
				  </div> 
				</div>   
				  <?php } ?>
                </div>
								</div>
							</div>
						</div>
						
					</div>
		
				</div>
			</div>
	
		</div>
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>