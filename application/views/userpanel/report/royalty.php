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
	
 
 
 
 	$QR_PAGES= "SELECT tcd.*,lin.level, tmf.user_name AS to_user_name, tmf.first_name AS to_name
				FROM ".prefix."tbl_cmsn_royalty AS tcd 
			   LEFT JOIN tbl_members AS tmf ON tcd.member_id=tmf.member_id
			    LEFT JOIN tbl_cmsn_levels AS lin ON lin.member_id=tmf.member_id
			   
			  WHERE tcd.member_id='".$member_id."'  $StrWhr group by tcd.net_income  ORDER BY tcd.id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
	//PrintR($PageVal);
?>





<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>								


		 <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
       		
		
<div class="content-body"><!-- Basic Tables start -->
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Royalty Income</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                  		
                <div class="table-responsive">
                    <table class="table table-bordered table-inverse mb-0 .table-inverse">
 <thead>
                    <tr role="row">
                      <th  class="sorting">Sr. No </th>
                      <th  class="sorting">Date</th>
                      <th  class="sorting">Distributor Id </th>
                      <th  class="sorting">Name </th>
                      <th  class="sorting">Level </th>
                
                      <th  class="sorting">Net Income </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
						if($PageVal['TotalRecords'] > 0){
						    
						    
						$Ctrl=$PageVal['RecordStart']+1;
							foreach($PageVal['ResultSet'] as $AR_DT):
						?>
                    <tr class="odd" role="row">
                      <td data-title="Sr. No"><?php echo $Ctrl; ?></td>
                      <td data-title="Date"><?php echo getDateFormat($AR_DT['date_time'],"d M Y"); ?></td>
                      <td data-title="Member Id"><?php echo strtoupper($AR_DT['to_user_name']); ?></td>
                      <td data-title="Member Id"><?php echo strtoupper($AR_DT['to_user_name']); ?></td>
                      <td data-title="Level"><?php echo $AR_DT['level']; ?></td>
                        
                      <td data-title="Net Income"><?php echo number_format($AR_DT['net_income'],2); ?></td>
                    </tr>
                    <?php $Ctrl++; endforeach;
						}
						 ?>
                  </tbody>
    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
<div class="col-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
</div></div>

<div class="col-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul>
								  
								   </div></div>

    </div>					
		
        </div>
      </div>
    </div>
    <!-- END: Content-->	
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>

