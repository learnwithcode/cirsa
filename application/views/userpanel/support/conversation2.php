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
	
	
   $member = $model->getmembersdetails($member_id);
 
	
	$QR_PAGES="SELECT ts.* FROM ".prefix."tbl_support AS ts WHERE ts.from_id='".$member_id."' 	ORDER BY ts.enquiry_id DESC";
	$PageValue = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
	
	  $QR_CHECK = "SELECT tm.*,    tm.member_mobile  AS mobile_number, tmsp.first_name AS spsr_first_name, 
		tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,	tree.nlevel, tree.left_right, tree.nleft, tree.nright,
		tree.date_join, tp.pin_name ,ts.* FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_subscription AS ts ON (tm.member_id=ts.member_id)
		 LEFT JOIN ".prefix."tbl_pintype AS tp ON ts.type_id=tp.type_id
		 WHERE tm.member_id='".$member_id."' 
		 ORDER BY tm.member_id ASC";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true); 
?>
 
<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

 

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php
        
        $this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
        
        ?>
        
       
        <!--**********************************
            Nav header end
        ***********************************-->
		
		
	

        <!--**********************************
            Sidebar start
        ***********************************-->
     <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu');  ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
	     <!--**********************************
            Content body start
        ***********************************-->
       <div class="content-body">
			<div class="container-fluid">
                 <div class="page-titles">
					<h4>Chat History</h4>
				
                </div>
                <!-- row -->

                <div class="row">
                 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                              <h6 class="mb-1">Chat with Agent</h6>
									<p class="mb-0 text-success">Online</p>
                            </div>
                            <div class="card-body">
                                
							      <?php 
                              	if($PageValue['TotalRecords'] > 0){
								$Ctrl=1;
									foreach($PageValue['ResultSet'] as $AR_DT){
									    
									     $counts = $model->countChat($AR_DT['enquiry_id']);
								?>
								<div class="d-flex justify-content-start">
									<div class="img_cont_msg" style="display:none;">
										<img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" class="rounded-circle user_img_msg" style="width:50px;" alt="JJJ">
									</div>
									<div class="msg_cotainer">
									<?php echo $AR_DT['type']; ?>
										<span class="msg_time"><?php echo getDateFormat($AR_DT['reply_date'],"d M, Y h:i"); ?></span>
									</div>
								</div>
								
								<?php }} ?>
								 <?php 
                                    if($PageVal['TotalRecords'] > 0){
                                    $Ctrl=1;
                                    foreach($PageVal['ResultSet'] as $AR_DT):
                                    if($AR_DT['member_id']==0){
                                    ?>
								<div class="d-flex justify-content-end mb-4">
								
									<div class="img_cont_msg">
								<img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" class="rounded-circle user_img_msg" style="width:50px;" alt="LLLL">
								<!--<h1>PLUSTECH ADMIN</h1>-->
									<div class="msg_cotainer_send"  >
									    	<span class="msg_time_send"><?php echo getDateFormat($AR_DT['reply_date'],"d M, Y h:i"); ?></span>
								 <p>	<?php echo $AR_DT['enquiry_reply']; ?> </p>
									
									</div>
									</div>
								</div>
							        
                                    <?php }else{  ?>
                                    
                                    
                                     <div class="chat">
                                          <div class="chat-user">
                                             <a class="avatar m-0">
                                               
                                                                       <?php  if($fetchRow['photo'] !=''){ $pic = $fetchRow['photo'];}else{ $pic='error';}
                                            if (file_exists(FCPATH.'upload/member/'.$pic)) { ?>
                                       <img class="profile-pic" src="<?php echo BASE_PATH;?>upload/member/<?php echo $fetchRow['photo'];?>" alt="profile-pic" style="    width: 50px;">
                                        
                                         <?php } else { ?>
 	<img src="<?php echo BASE_PATH; ?>newassets/images/profile/profile.png" class="img-fluid rounded-circle" alt="" style="    width: 50px;">
								
                                           
<?php } ?>   
              
                                            
                                            
                                             </a>
                                            
                                          </div>
                                          <div class="chat-detail">
                                             <div class="chat-message">
                                                  <span class="chat-time mt-1"><?php echo getDateFormat($AR_DT['reply_date'],"d M, Y h:i"); ?></span>
                                              <p><?php echo $AR_DT['enquiry_reply']; ?></p>
                                              
                                             </div>
                                          </div>
                                       </div>
                                       
                                       
                                       
                                    <?php } ?>
                                    
                                    <?php endforeach;
                                    }
                                    ?>
							
                            </div>
                            	  <?php if($AR_TICK['enquiry_sts']!="C"){ ?>
							
							<div class="card-footer type_msg">
							    <form class="d-flex align-items-center"  action="<?php echo MEMBER_PATH; ?>support/conversation" method="post"    >
								<div class="input-group">
								      <input type="hidden" name="enquiry_id" id="enquiry_id"  value="<?php echo $enquiry_id; ?>">
								       <input type="text" class="form-control mr-3 rtl-mr-0 rtl-ml-3" placeholder="Type your message"  required name="enquiry_reply" id="enquiry_reply" >
								
									<div class="input-group-append">
										<button  value="1" name="chatSubmit"  type="submit" class="btn btn-info"><i class="fa fa-location-arrow"></i></button>
									</div>
								</div>
								 </form>
							</div>
							  <?php } ?>
                        </div>
                    </div>
                  
                   
                   
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

  <div class="modal fade" id="exampleModalCenter">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                   	<h5 class="modal-title" id="basicmodalLabel">Create new Ticket</h5>
                                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                  	 <form method="post" action="<?php echo MEMBER_PATH."support/contactsupport"; ?>" name="form-page" id="form-page">
                                             
                                                
                                                
           
                <div class="row">
                    <div class="col-md-12">
                       
                          <label><strong  >Query Type</strong></label>
						 
                         <select class="form-control form-control-lg" name="type" tabindex="null">
                                               	<option value="Profile Edit">Profile Edit</option>
								<option value="Sign Up">Sign Up</option>
						
								<option value="Joining Package">Joining Package</option>
								<option value="Commission/Income">Commission/Income</option>
								<option value="Kyc Update">Kyc Update</option>
								<option value="Payment Issue">Payment Issue</option>
								<option value="Others">Others</option>
                                            </select>
                        
                    </div>
                     <div class="col-md-12">
                         <label><strong  >Subject</strong></label>
                         
      <input name="subject" value="" class="form-control input-xlarge form-half " type="text" required>
                      
                    </div>
                     <div class="col-md-12">
                         
                          <label><strong  >Your Query</strong></label>
                         
                           <textarea name="enquiry_detail" class="form-control input-xlarge form-full " required></textarea>
                        
                    </div>
                    
                </div>
                
           
                        
                       
						
		
                  
                                                
                                              
                                                <div class="modal-footer">
                                                  
                                                  	<?php if($totalopen > 0 ) { ?>
	<a href="javascript:void(0);" class="btn btn-info  " onclick="alert('Your previous ticket has been open');" >Sumbit Query </a>		
			<?php  }else {?>
			<br>
<input class="btn btn-info " name="logaTicket" value="Sumbit Query " type="submit" style="float: right;">
						<?php } ?>
                                                </div>
                                                    </form>
					 </div>
                                               
                                            </div>
                                        </div>
                                    </div>
  
<?php

   $this->load->view(MEMBER_FOLDER.'/layout/footer'); 


?>


