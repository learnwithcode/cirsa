<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
    $model = new OperationModel();
    $today_date = InsertDate(getLocalTime());
    $segment = $this->uri->uri_to_assoc(2);
    
 
    $member_id = $this->session->userdata('mem_id');
  
    $QR_PAGES="SELECT tft.*  
              FROM ".prefix."tbl_wallet_trns AS tft 
         
              WHERE tft.wallet_id ='5'  and tft.member_id = '$member_id'
               
                
              ORDER BY tft.wallet_trns_id DESC";
        $PageVal = DisplayPages($QR_PAGES, 100, $Page, $SrchQ);
          	$Lastpkg = $model->getLastMemberpackage($member_id);
?>
 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
?>

               <div class="container">
                   <div class="row">
                        <div class="order-statement">
                        <div class="heading-main">
                            <h5>Flushout History </h5>
                           
                            </p>
                        </div>
                        <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;box-shadow: 0 0 4px #c0baba;">
                            <thead style="background-color: #15215a; color:#fff; text-align: left;">
                             <tr>
                  
                          <th class="shrink" >Sn.</th>
                            <th class="shrink"  >Date</th>
                         
                              <th  class="shrink" >Total Amount</th>
                                  
                         
                            <th >Remarks</th>
                          
                 
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
                                    
                                      <td class="sorting_1"><?php echo CURRENCY; ?><?php echo number_format($AR_DT['trns_amount'],2); ?> </td>
                                      <td  class="shrink" ><?php echo $AR_DT['trns_for']; ?></td>
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
 <footer id="footer-main" >
                   
                    </footer>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>