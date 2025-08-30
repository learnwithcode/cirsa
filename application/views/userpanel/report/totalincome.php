<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
    $model = new OperationModel();
  $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
  
  $member_id = $this->session->userdata('mem_id');
  
  if($_GET['from_date']!='' && $_GET['to_date']!=''){
    $from_date = InsertDate($_GET['from_date']);
    $to_date = InsertDate($_GET['to_date']);
    $StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
    $SrchQ .="&from_date=$from_date&to_date=$to_date";
  }
    
$QR_PAGES="SELECT tp.* ,ms.member_id,ms.remarks, SUM(ms.flushout) as flushout, SUM(ms.bonus_2) as bonus_2, SUM(ms.bonus) as bonus, SUM(ms.performance_income) as performance_income, SUM(ms.commuinity) as commuinity  ,   SUM(ms.level) as level ,SUM(ms.direct) as direct ,SUM(ms.residual) as residual ,SUM(ms.pool) as pool ,SUM(ms.quick) as quick  ,SUM(ms.club_income) as club_income ,SUM(ms.total_income) as total_income ,SUM(ms.admin_charge) as admin_charge ,SUM(ms.tds) as tds ,SUM(ms.net_income) as net_income  FROM  ".prefix."tbl_process AS tp 
         LEFT JOIN  `tbl_cmsn_mstr` as ms  ON ms.process_id=tp.process_id
         WHERE tp.pair_sts='Y' 
         $StrWhr and ms.member_id=$member_id
         GROUP BY tp.process_id ORDER BY tp.process_id DESC";
    $PageVal = DisplayPages($QR_PAGES, 200, $Page, $SrchQ); 
     	$QR_CHECK = "SELECT * FROM tbl_members WHERE member_id='".$member_id."'";
		$memdata = $this->SqlModel->runQuery($QR_CHECK,true); 
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
					<h4>My Total Income</h4>
				
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
                          <th class="shrink">S.No.</th>
                                                <th class="shrink">Date</th>
                       <!-- <th  class="">Process Week </th>-->
                         <!--<th  class="">Board </th> -->
                          <th class="shrink" >Roi Income</th>
                     
                       <th class="shrink" >Referral Income</th>
                        <th class="shrink" >Level Income</th>
                         <?php if(false){ ?>

                     <th class="shrink" >Royalty Income</th>
                          <th class="shrink" >Reward Income</th>
                          <?php } ?>
                        <th class="shrink" >Total Income</th>
                          <th class="shrink" style="display:none;" >Flush Out</th>
                          <!--  <th  class="shrink">Net Bonus </th>-->
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
                                         $directIncome = $model->getincomesallnewadmin("Direct",$AR_DT['member_id'],$AR_DT['process_id']);
                
                $Level = $model->getincomesallnewadmin("Level",$AR_DT['member_id'],$AR_DT['process_id']);
                $Boardincome = $model->getincomesallnewadmin("Pool",$AR_DT['member_id'],$AR_DT['end_date']);
 //$residual = $model->getincomesallnewadmin("DAILY_I",$AR_DT['member_id'],$AR_DT['end_date']);
  $residual = $model->getincomesallnewadmin("Daily",$AR_DT['member_id'],$AR_DT['process_id']);
  $directIncome1 += $model->getincomesallnewadmin("Direct",$AR_DT['member_id'],$AR_DT['process_id']);
                
                $Level1 += $model->getincomesallnewadmin("Level",$AR_DT['member_id'],$AR_DT['process_id']);
                $residual1 += $model->getincomesallnewadmin("Daily",$AR_DT['member_id'],$AR_DT['process_id']);

                   if($AR_DT['net_income']>0){ 
                                      // PrintR($Boardincome); 
                                        
               $level1 += $AR_DT['level'];
               $direct1 += $AR_DT['direct'];
               $commuinity1 += $AR_DT['commuinity'];
               $quick1 += $AR_DT['quick'];
                $quick2 += $AR_DT['bonus'];
                 $club_income1 += $AR_DT['club_income'];
                $performance_income2 += $AR_DT['performance_income'];
              
               $admin_charge1 += $AR_DT['admin_charge'];
                 $flushout1 += $AR_DT['flushout'];
              
               
               
               $tttnet_income1 += $AR_DT['net_income'];
                     $total_income1 += $AR_DT['total_income'];
               
               
            
               
                                ?>
                                <tr class="odd" role="row">
                                    <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                        
                    
                    
                    
                    
             <td data-title="Process Week" class="shrink"><?php echo date('d-M-Y ',strtotime($AR_DT['end_date'])); ?>  </td>
                
                      
                          <td data-title="Total Sum"   class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($residual,4); ?></td> 
                           <td data-title="Total Sum"  style="display:none;"  class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['commuinity'],4); ?></td> 
     <td data-title="Total Sum"  class="shrink" ><?php echo CURRENCY; ?>  <?php echo number_format($AR_DT['direct'],4); ?></td>
   
          
                    <td data-title="Total Sum"  class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['level'],4); ?></td>
                      
                     
                     
                      <td style="display:none;" data-title="Total Sum"   class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['bonus_2'],4); ?></td> 
                     <?php if(false){ ?>

                       <td data-title="Total Sum"   class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['quick'],4); ?></td> 
                         <td   data-title="Total Sum"  class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['bonus'],4); ?></td> 
                          <?php } ?>
                   
                     
                         <td data-title="Total Sum"  class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['total_income'],4); ?></td>
                         
                       
                        <td data-title="Total Sum"  style="display:none;" class="shrink" ><?php echo CURRENCY; ?><?php echo $AR_DT['flushout']; ?></td> 
                        
                        
                         
                         <td data-title="Total Sum"  class="shrink" style="display:none;" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['net_income'],4); ?></td>
                         
                        
                        
                        
                        
                        
                        
                          
                           <!--<td data-title="Total Sum"  class="shrink" ><?php echo $AR_DT['remarks']; ?></td> -->
                         
                         
                         <!--<td data-title="Total Sum"><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['admin_charge'],4); ?></td>-->
                       
                     
                                  </tr>
                             
                



                                    
                                    <?php } endforeach; ?>
                                    
                                      <tr style="font-size: large;font-weight: 800;color: #ebe1e1;background: green;">
                        
                       <td colspan="2">Total</td>
                       <td data-title="Total Sum" style="display:none;"><?php echo CURRENCY; ?><?php echo number_format($commuinity1,4); ?></td>
                        <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($residual1,4); ?></td>
                       
                          <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($commuinity1,4); ?></td>
                            <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($direct1,4); ?></td>
                          
                            <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($Level1,4); ?></td>
                              <td data-title="Total Sum" style="font-size: 11px; display:none"><?php echo CURRENCY; ?><?php echo number_format($quick1,4); ?></td>
                              <td data-title="Total Sum" style="font-size: 11px; display:none"><?php echo CURRENCY; ?><?php echo number_format($quick2,4); ?></td>
                         
                               <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($Boardincome1,4); ?></td>
                            
                            <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($club_income1,4); ?></td>
                             <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($performance_income2,4); ?></td>
                              <td data-title="Total Sum" style="font-size: 11px;"><?php echo CURRENCY; ?><?php echo number_format($total_income1,4); ?></td>
                                   <td data-title="Total Sum" style="font-size: 11px;display:none"><?php echo CURRENCY; ?><?php echo number_format($flushout1,4); ?></td>
                             <td data-title="Total Sum" style="font-size: 11px;display:none;"><?php echo CURRENCY; ?><?php echo number_format($tttnet_income1,4); ?></td>
                              
                              
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
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


<?php

   $this->load->view(MEMBER_FOLDER.'/layout/footer'); 


?>


