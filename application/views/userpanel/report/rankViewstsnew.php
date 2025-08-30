<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcd.cmsn_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	

	$QR_PAGE = "SELECT * from tbl_reward  where 1 ";
	$PageVal = DisplayPages($QR_PAGE, 50, $Page, $SrchQ);	
	
	  $rewardid = $model->uri->segment(4);
	  $rewardid= ($rewardid)? $rewardid:0;
	
 if($rewardid>0){ 	
 $QR_PAGES="SELECT * FROM  ".prefix."tbl_cmsn_reward_2  WHERE reward_id='$rewardid'  and member_id=$member_id";
$PageVal = DisplayPages($QR_PAGES, 200, $Page, $SrchQ); 

	
 }	
	
	
	
	
	
	
	
// PrintR($address);
?>

 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); 
?>

         
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                           
                        </div>
                    </div>
                 
                </div>
                <!-- row -->
<?php if($rewardid>0){ ?>
                <div class="row">
                 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reward Income</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                              <tr>
                          <th class="shrink">S.No.</th>
                                                <th class="shrink">Date</th>
                      <th class="shrink" >Reward Name </th>
                        
                            <th  class="shrink">Net Bonus </th>
                          <!--<th class="shrink" >Remarks</th>-->
                     <!--   <th>Admin Charge</th>-->
                        
                   
                        
                       
                        </tr>
                            </thead>
                          <tbody>
           
                                   <?php 
                                if($PageVal['TotalRecords'] > 0){
                                $Ctrl=$PageVal['RecordStart']+1;
                         
                                    foreach($PageVal['ResultSet'] as $AR_DT):
                                      //PrintR($AR_DT);
                                       $getreward = $model->getreward($rewardid);
                                      // PrintR($getreward['reward_name']);
                                ?>
                                <tr class="odd" role="row">
                                    <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                        
                    
                    
                    
                    
             <td data-title="Process Week" class="shrink"><?php echo date('d-M-Y ',strtotime($AR_DT['date_time'])); ?>  </td>
                
                      
                          <td data-title="Total Sum"   class="shrink" >  <?php echo $getreward['reward_name']; ?></td> 
                              <td data-title="Total Sum"   class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['net_income']); ?></td> 
                            
                     
                                  </tr>
                             
                



                                    
                                    <?php endforeach; ?>
                                    
                                      <tr style="font-size: large;font-weight: 800;color: #ebe1e1;background: green;display:none;">
                        
                       <td colspan="2">Total</td>
                       <td data-title="Total Sum" style="display:none;"><?php echo CURRENCY; ?><?php echo number_format($commuinity1,4); ?></td>
                        <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($residual1,4); ?></td>
                       
                          <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($commuinity1,4); ?></td>
                            <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($direct1,4); ?></td>
                          
                            <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($Level1,4); ?></td>
                            
                            <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($quick2,4); ?></td>
                             <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($quick1,4); ?></td>
                               <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($Boardincome1,4); ?></td>
                            
                            <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($club_income1,4); ?></td>
                             <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($performance_income2,4); ?></td>
                              <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($total_income1,4); ?></td>
                                   <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($flushout1,4); ?></td>
                             <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($tttnet_income1,4); ?></td>
                              
                              
                              <!--<td data-title="Total Sum"><?php echo CURRENCY; ?><?php echo number_format($admin_charge1,4); ?></td>-->
                                <!--<td data-title="Total Sum"><?php echo CURRENCY; ?><?php echo number_format($net_income1,4); ?></td>-->
                              
                                
                    </tr>
                                <?php    }else{
                                    ?>
                                    <tr class="odd" role="row">
                                        <td colspan="9" align="center">No transaction found</td>
                                    </tr>
                                <?php 
                                    }
                                 ?>
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
                
                <?php }else{ ?>
                
                 <div class="row">
                 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Reward Income</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                             <tr>
                           <th>  S.No.</th>
                         
                            <th class="shrink" >Reward Name </th>
                              <th>Team Business</th>
                            <th> Bonus </th>
                             <th> Start Date </th>
                            <th>  Status</th>
                              <th> Close Date </th>
                              <th> View </th>
                        </tr>
                            </thead>
                         <tbody>
				<?php   if($PageVal['TotalRecords'] > 0){
				$Ctrl=$PageVal['RecordStart']+1;
 
				foreach($PageVal['ResultSet'] as $AR_DT):
			    $pkgstatus = $model->getrankstatussss($member_id,$AR_DT['reward_id']);
			// PrintR($status);
				
				?>
              <tr>
              <td class=""><?php echo $Ctrl; ?></td>
 
                <td><?php echo $AR_DT['reward_name']; ?></td>
                 <td><?php echo CURRENCY; ?> <?php echo $AR_DT['matching_pv']; ?></td>
                <td><?php echo CURRENCY; ?> <?php echo $AR_DT['amount1']; ?></td>
                <td>
                    <?php if($pkgstatus['date_time']){ ?>
                    <?php echo date("d-m-Y",strtotime($pkgstatus['date_time']));  ?>
                    <?php }else{ ?>
                    
                    not yet qualified
                    <?php } ?>
                    
                    </td>
               
                
                <td>
                <?php if($pkgstatus['total'] >  0 ) {?>
				<span class="badge badge badge-pill badge-success float-left mr-2">Achieved</span>
				<?php } else { ?>
				<span class="badge badge badge-pill badge-warning float-left mr-2">Pending</span>
				<?php }?>
                
                </td>
                 <td>
                      <?php if($pkgstatus['date_time']){ ?>
                     <?php echo $addDate = date("d-m-Y",strtotime(AddToDate($pkgstatus['date_time'],"910 Day"))); ?>
                     
                      <?php }else{ ?>
                    
                    not yet qualified
                    <?php } ?>
                     </td>
                 <td data-title="Report"><a href="<?php echo generateSeoUrlMember("report","rank_rewards_new",""); ?>/<?php echo $AR_DT['reward_id']; ?>">View</a></td>
                
              </tr>
              <?php $Ctrl++;
			   endforeach;	}else{
									?>
									<tr class="odd" role="row">
										<td colspan="8" align="center">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
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
                <?php }?>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>