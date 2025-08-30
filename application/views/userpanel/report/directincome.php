<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
    $model = new OperationModel();
    $Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
    
    $member_id = $this->session->userdata('mem_id');
    
    if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
        $from_date = InsertDate($_REQUEST['from_date']);
        $to_date = InsertDate($_REQUEST['to_date']);
        $StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
        $SrchQ .="&from_date=$from_date&to_date=$to_date";
    }
    
    $QR_PAGES="SELECT tcd.*, tm.user_id FROM ".prefix."tbl_cmsn_direct AS tcd 
              LEFT JOIN tbl_members AS tm ON tcd.from_member_id =tm.member_id
              WHERE tcd.member_id='".$member_id."' $StrWhr ORDER BY tcd.direct_id DESC";
    $PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);  
    
  
    
    $QR_SUM = "SELECT SUM(tcd.net_income) AS net_income FROM tbl_cmsn_direct AS tcd WHERE tcd.net_income > 0 and  tcd.member_id='".$member_id."' $StrWhr ORDER BY tcd.direct_id DESC";
    $AR_SUM = $this->SqlModel->runQuery($QR_SUM,true);
    
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
					<h4>Referral Bonus</h4>
				
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
                          <th>S.No.</th>
                          <th>Date</th>
                          <th>Trans Id</th>
                          <th>Ref. Id </th>
                            <th>Ref. Volume </th>
                               <th>Percentage </th>
                                 <!--<th>Status </th>-->
                                  <!--<th>Flush Out </th>-->
                          <!--<th>Stacking Value</th>-->
                         
                         <!-- <th>Admin Charge</th>
                          <th>TDS</th>
                          <th>Repurchase Detection</th>-->
                          <th>Referral Bonus ( <?php echo CURRENCY; ?> )</th>
                        </tr>
                            </thead>
                           <tbody>
                                   <?php 
                                if($PageVal['TotalRecords'] > 0){
                                $Ctrl=$PageVal['RecordStart']+1;
                            //  echo "<pre>";print_r($PageVal['ResultSet']);die;
                                    foreach($PageVal['ResultSet'] as $AR_DT):
                                        	$net_income_sum1 +=$AR_DT['net_income'];
                                       $subcription_id= 	$AR_DT['subcription_id'];
                                        //	PrintR($AR_DT);
                                        		 $clubrankde = $model->getstatusbysubsid($subcription_id);
                                        	//	 PrintR($clubrankde['retopup']);
                                       if($AR_DT['total_collection'] >= 20 and $AR_DT['total_collection'] <= 100 ){
                                           $package= 'Starter';
            }elseif($AR_DT['total_collection'] >= 120 and $AR_DT['total_collection'] <= 500 ){
                  $package= 'Silver';
                
            }elseif($AR_DT['total_collection'] >= 520 and $AR_DT['total_collection'] <= 1000 ){
                  $package= 'Gold';
                
            }elseif($AR_DT['total_collection'] >= 1020 and $AR_DT['total_collection'] <= 2500 ){
                  $package= 'Platinum';
                
            }elseif($AR_DT['total_collection'] >= 2520 and $AR_DT['total_collection'] <= 5000 ){
                
                 $package= 'Diamond'; 
            }else{
                
                  $package= 'Package';
            }   	
                                        	
                                        	
                 if($clubrankde['retopup']=='Y'){
                     
                     
                     $currentstatus='Withdrawal Retop-up';
                     
                 } elseif($clubrankde['type']=='U'){
                     
                       $currentstatus='Upgrade';
                     
                 } elseif($clubrankde['type']=='A'){
                     
                       $currentstatus='Topup';
                     
                 }                      	
                                        	
                                        	
                        	 $self = $model->getMemberdetailbyuserid($AR_DT['user_id']);                	
                                        	
                              // PrintR($self['self_bv']);         	
                                        	
                                        	
                                ?>
                                <tr class="odd" role="row">
                                    <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                                      <td class=""><?php echo getDateFormat($AR_DT['date_time'],"d M Y"); ?></td>
                                       <td>#002022<?php echo $AR_DT['direct_id']; ?></td>
                                       <td><?php echo $AR_DT['user_id']; ?></td>
                                             <td><?php echo CURRENCY; ?> <?php echo $AR_DT['total_collection']; ?> [<?php echo $package; ?> - <?php echo CURRENCY; ?> <?php echo $self['self_bv']; ?> ]</td>
                                     <td> <?php echo $AR_DT['percentage']; ?>%</td>
                                       <!--<td> <?php echo $currentstatus; ?></td>-->
                                       <!--<td> <?php echo $AR_DT['flushout']; ?></td>-->
                                      <!--<td><?php echo number_format($AR_DT['admin_charge'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['tds'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['repurchase_detection']); ?></td>-->
                                      <!--<td><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['total_collection']); ?></td>-->
                                     
                                      <td><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['net_income'],4); ?></td>
                                  </tr>
                             
                        
                                    
                                    <?php endforeach;  ?>
                                    
                                     <tr style="font-size: large;font-weight: 800;color: #ebe1e1;background: #764e02;">
                        
                       <td colspan="5">Total</td>
                      
                        <td class="sorting_1">&nbsp;</td>
                      
                     
                    
                    
                    
                      <td ><strong><?php echo CURRENCY; ?> <?php echo number_format($net_income_sum1,4); ?></strong></td>
                              
                                
                    </tr>
                               <?php     }else{
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


