<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$QUERY=$this->db->query("SELECT COUNT(*) as total FROM `tbl_support` WHERE from_id='$member_id' and `enquiry_sts` !='C'");
	$data = $QUERY->row_array();
	$totalopen = $data['total'];
	
	$QR_PAGES="SELECT ts.* FROM ".prefix."tbl_support AS ts WHERE ts.from_id='".$member_id."' 	ORDER BY ts.enquiry_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
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
					<h4>My Help Center</h4>
				
                </div>
                <!-- row -->
 <div class="header-title">
                       
                         
                      <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">  Generate Ticket</button>   
                         
                      
                               
                     </div>
                      <h4 class="card-title">Total Ticket  Number: <strong><?php echo number_format($PageVal['TotalRecords']); ?></strong></h4>
                 <div class="row">
                 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Support</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                            <tr role="row">
                                  <th  style="width: 255px;" colspan="1" rowspan="1"  tabindex="0" class="">Ticket #</th>
                                  <th  style="width: 180px;" colspan="1" rowspan="1"  tabindex="0">Status</th>
                                  <th  style="width: 526px;" colspan="1" rowspan="1"  tabindex="0">Date</th>
                                  <th  style="width: 526px;" rowspan="1"  tabindex="0">Query Type </th>
                                  <th  style="width: 526px;" rowspan="1"  tabindex="0">Query Subject </th>
                                  <th  style="width: 526px;" rowspan="1"  tabindex="0">Action</th>
                                </tr>
                              </thead>
                              <tbody>
								<?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                <tr class="odd" role="row">
                                  <td><?php echo $AR_DT['ticket_no']; ?></td>
                                  <td><?php echo DisplayText("TICKET_".$AR_DT['enquiry_sts']); ?></td>
                                  <td><?php echo getDateFormat($AR_DT['reply_date'],"d M Y h:i"); ?></td>
                                  <td><?php echo $AR_DT['type']; ?></td>
                                  <td><?php echo $AR_DT['subject']; ?></td>
                                  <td>
								  <a href="<?php echo generateSeoUrlMember("support","conversation",array("enquiry_id"=>_e($AR_DT['enquiry_id']))); ?>" class="btn btn-info" style="margin-left: -7px;">
								  View
								 	  
								  </a>
								  &nbsp;&nbsp;
								  <?php if($AR_DT['enquiry_sts']!='C'){ ?>
								   <a onClick="return confirm('Make sure, you want to close this tickets?')" class="btn btn-info" href="<?php echo generateSeoUrlMember("support","contactsupport",array("enquiry_id"=>_e($AR_DT['enquiry_id']),"action_request"=>"CLOSE")); ?>">
								   	Close Ticket
								   </a>
								   <?php }else{ ?>
									   	<a onClick="alert('This ticket is already closed')" href="javascript:void(0)" class="btn btn-info">Closed</a>
								   <?php } ?>
								  </td>
                                </tr>
                               
                                <?php endforeach;
								} else{ 
								 ?>
								 <tr><td colspan="9" align="center"> No Record found !</td></tr>
							   <?php } ?>	 
                              </tbody>
                                    </table>
                                        <div class="row">
<div class="col-md-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
</div></div>

<div class="col-md-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul> </nav>
								  
								   </div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                   
                   
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

 <!-- Modal -->
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


