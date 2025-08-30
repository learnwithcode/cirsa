<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
    $model = new OperationModel();
    $today_date = InsertDate(getLocalTime());
    $segment = $this->uri->uri_to_assoc(2);
    
 
    $member_id = $this->session->userdata('mem_id');
  
    $QR_PAGES="SELECT tft.*  
              FROM ".prefix."tbl_fund_transfer AS tft 
         
              WHERE tft.trns_for LIKE 'WITHDRAW'  and tft.to_member_id = '$member_id'
               
                
              ORDER BY tft.transfer_id DESC";
        $PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
          echo	$Lastpkg = $model->getLastMemberpackage($member_id);
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
					<h4>Withdrawal History</h4>
				
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
                  
                          <th class="shrink" >Sn.</th>
                            <th class="shrink"  >Date</th>
                            <!--<th style="width: 20%;">Trns No</th>-->
                           <th  class="shrink" style="width: 15%;">Type</th>
                                  <!--<th style="width: 15%;">Bank Name</th>-->
                              <th  class="shrink" >Gross Amount</th>
                                   <th  class="shrink"  style="display:none;">Retop-up </th> 
                                      <th  class="shrink" style="display:none;" >Liquidity </th> 
                                        <th class="shrink"  >Admin Charge</th>
                           <th  class="shrink" >Net Amount</th>
                            <th >TRN</th>
                            <th class="shrink" >Status</th>
                 
                        </tr>
                            </thead>
                                 <tbody>
                                    <?php 
                                    if($PageVal['TotalRecords'] > 0){
                                    $Ctrl=1;$i=1;
                                    foreach($PageVal['ResultSet'] as $AR_DT):  
                                    //echo "<pre>";print_r($AR_DT);die;                             ?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $i;$i++;?></td>
                                      <td  class="shrink" ><?php echo DisplayDate($AR_DT['trns_date']); ?></td>
                                      <!--<td class="sorting_1"><?php echo $AR_DT['trans_no']; ?></td>-->
                                      <td class="sorting_1"><?php echo $AR_DT['cryptoname']; ?></td>
                                       <!--<td class="sorting_1"><?php echo $AR_DT['bank_name']; ?></td>-->
                                   <td class="sorting_1"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['initial_amount'],2); ?> </td>
                                           <td class="sorting_1"  style="display:none;"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['stacking'],2); ?>  </td>
                                             <td class="sorting_1"  style="display:none;"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['liquidity'],2); ?>  </td>
                                               <td class="sorting_1"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['admin_charge'],2); ?>  </td>
                                      <td class="sorting_1"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['trns_amount'],2); ?> </td>
                                      <td  class="shrink" ><?php echo $AR_DT['remarks']; ?></td>
                                      <td> <?php if($AR_DT['trns_status']=='P'){  ?><div class="badge badge-warning">Pending</div> <?php }elseif($AR_DT['trns_status'] =='C'){?> <div class="badge badge-success">Success</div>  <?php }else{?><div class="badge badge-danger">Reject</div> <?php }?> </td>
                                         </tr>
                                    
                                    <?php endforeach; 
                                    }else{
                                    ?>
                                    <tr class="odd" role="row">
                                        <td colspan="10"align="center">No transaction found</td>
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


