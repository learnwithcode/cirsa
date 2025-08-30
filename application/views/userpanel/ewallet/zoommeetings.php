<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$wallet_id = 1;
	
if($_REQUEST['news_title']!=''){
	$news_title = FCrtRplc($_REQUEST['news_title']);
	$StrWhr .=" AND ( tn.news_title LIKE '%$news_title%' OR  tn.news_detail LIKE '%$news_title%' )";
	$SrchQ .="&news_title=$news_title";
}
	
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
$QR_PAGES="SELECT tn.* FROM ".prefix."tbl_zoomeeting  AS tn   WHERE status='Open' and isDelete>0 $StrWhr ORDER BY tn.news_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
?>

 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
?>

               <div class="container">
                   <div class="row">
                        <div class="order-statement">
                        <div class="heading-main">
                            <h5>Zoom Meetings </h5>
                           
                            </p>
                        </div>
                        <table class="table" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;box-shadow: 0 0 4px #c0baba;">
                            <thead style="background-color: #15215a; color:#fff; text-align: left;">
                            <tr>
                    
                        <th width="103" align="center" >Zoom Title</th>
                        <th width="103" align="center">Events  Name</th>
                        <th width="103" align="center">Events Date</th>
                        <th width="103" align="center">Start Time</th>
                        <th width="103" align="center">End Time</th>
                         <th width="90" align="center">URL/ links</th>
                          <th width="90" align="center">Password</th>
                           <th width="71" align="center">Status</th>
                         
                      </tr>
                            </thead>
                           <tbody id="myTable">  <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=$PageVal['RecordStart']+1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									   // PrintR($AR_DT);
								if($AR_DT['trns_type']=='Cr'){
								 	$CR	  += $AR_DT['trns_amount'];   
								    
								}else{
								    
								 	$Dr	  += $AR_DT['trns_amount'];   
								    
								}	   
									   
							
								?>
                                    <tr class="odd" role="row">
                                       <td align="left"><a href="javascript:void(0)"><?php echo $AR_DT['zoomtitle']; ?></a> </td>
                          <td align="left" ><?php echo ($AR_DT['events_title']); ?></td>
                          <td align="left" ><?php echo DisplayDate($AR_DT['edate']); ?></td>
                           <td align="left" ><?php echo $newDateTime = date('h:i A', strtotime($AR_DT['starttime'])); ?></td>
                            <td align="left" ><?php echo $newDateTime = date('h:i A', strtotime($AR_DT['endtime'])); ?></td>
                              <td align="left" ><?php echo $AR_DT['links']; ?></td>
                                <td align="left" ><?php echo $AR_DT['password']; ?></td>
                                  <td align="left" ><?php echo $AR_DT['status']; ?></td>
                                    </tr>
                                    
                                    <?php endforeach; ?>
                                           
								<?php	}else{
									?>
								
									<tr class="odd" role="row">
										<td colspan="6" align="center">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
            </tbody> 
                        </table>
                        <div class="row" style="display:none;">
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