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
	
	$QR_PAGES="SELECT tcd.*, tm.user_id FROM ".prefix."tbl_cmsn_daily AS tcd 
			  LEFT JOIN tbl_members AS tm ON tcd.member_id = tm.member_id
				  WHERE tcd.member_id='".$member_id."' $StrWhr ORDER BY tcd.daily_cmsn_id DESC";
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
					<h4>Daily Bonus </h4>
				
                </div>
                <!-- row -->

                <div class="row">
                   
				
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Details Here</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                          <thead>
                                              <tr>
                                      <th  class="sorting">S.No. </th>
                                      <th  class="sorting">Trading Date</th>
                                      <!--<th  class="sorting">Transaction No </th>-->
                                      <th  class="sorting">Trading Volume
</th>
                                     <th  class="sorting">Profit %</th>
                                      <th  class="sorting">Trading Bonus ( <?php echo CURRENCY; ?> )</th>
                                     <th  class="sorting">Booster Status</th>
                                    </tr>
                            </thead>
                            <tbody>
                                   
                    
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl= $PageVal['RecordStart']+1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									    	$net_income_sum1 +=$AR_DT['net_income'];
								?>
                                    <tr class="odd" role="row">
                                      <td class="sorting_1"><?php echo $Ctrl; ?></td>
                                      <td class="sorting_1"><?php echo getDateFormat($AR_DT['date_time'],"d M Y"); ?></td>
                                      <!--<td ><?php echo $AR_DT['trans_no']; ?></td>-->
                                      <td><?php echo CURRENCY; ?><?php echo number_format($AR_DT['trans_amount'],4); ?></td>
                                     <td><?php echo number_format($AR_DT['daily_return'],2); ?> %</td>
                                      <td><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['net_income'],4); ?></td>
                                      <td>
                                          <?php if($AR_DT['is_booster']=='Y'){ ?>
                                          
                                          Yes
                                          <?php }else{ ?>
                                          
                                          No
                                          
                                          <?php } ?>
                                          
                                          </td>
                                    </tr>
                                    <?php $Ctrl++; endforeach; ?>
                                    
                                     <tr style="font-size: large;font-weight: 800;color: #ebe1e1;background: #764e02;">
                        
                       <td colspan="3">Total</td>
                      
                        <td class="sorting_1">&nbsp;</td>
                      
                     
                    
                    
                    
                      <td colspan="2"><strong><?php echo CURRENCY; ?><?php echo number_format($net_income_sum1,2); ?></strong></td>
                              
                                
                    </tr>
								<?php	}else{
									?>
                                    <tr class="odd" role="row">
                                      <td colspan="7"   align="center">No transaction found</td>
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
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


<?php

   $this->load->view(MEMBER_FOLDER.'/layout/footer'); 


?>


