<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$member_id = $this->session->userdata('mem_id');
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}


if($_GET['from_date']!='' && $_GET['to_date']!=''){
	$from_date = InsertDate($_GET['from_date']);
	$to_date = InsertDate($_GET['to_date']);
	$StrWhr .=" AND DATE(tpd.date_time) BETWEEN '".$from_date."' AND '".$to_date."'";
	$SrchQ .="&from_date=$from_date&to_date=$to_date";
}
if($_GET['type_id']>0){
	$type_id = FCrtRplc($_GET['type_id']);
	$StrWhr .=" AND tpd.type_id='".$type_id."'";
	$SrchQ .="&type_id=$type_id";
}
if($_GET['pin_no']>0){
	$pin_no = FCrtRplc($_GET['pin_no']);
	$StrWhr .=" AND ( tpd.pin_no LIKE '%$pin_no%' OR tpd.pin_key LIKE '%$pin_no%' )";
	$SrchQ .="&pin_no=$pin_no";
}
$QR_PAGES= "SELECT tpd.*, tm.user_id, tm.first_name, tm.last_name, tpy.pin_name, SUM(tpd.pin_price+tpm.pin_activation) AS net_pin_price
			FROM ".prefix."tbl_pinsdetails AS tpd 
			LEFT JOIN ".prefix."tbl_pinsmaster AS tpm ON tpd.mstr_id=tpm.mstr_id
			LEFT JOIN ".prefix."tbl_members AS tm ON tpd.member_id=tm.member_id
			LEFT JOIN ".prefix."tbl_pintype AS tpy ON tpd.type_id=tpy.type_id WHERE tpd.pin_sts='N' 
			AND tpd.member_id>0 AND tpd.member_id='".$member_id."' $StrWhr 
			GROUP BY tpd.pin_id
			ORDER BY tpd.pin_id ASC	";
$PageVal = DisplayPages($QR_PAGES, 25, $Page, $SrchQ);
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
                <h4 class="card-title">My Epin</h4>
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

<table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    
					<thead>
                      <tr>
                        <th>Srl # </th>
                        <th>Transfer Date </th>
                        <th>Used Date </th>
                        <th>Used By </th>
                        <th>E-Pin Type </th>
                        <th>E-Pin Number </th>
                        <th>E-Pin Key </th>
                        <th>E-Pin Value </th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
					if($PageVal['TotalRecords'] > 0){
					$Ctrl=1;
					foreach($PageVal['ResultSet'] as $AR_DT):
					?>
                      <tr>
                        <td><?php echo $Ctrl; ?></td>
                        <td><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                        <td><?php echo ($AR_DT['used_date']=="0000-00-00")? "N/A":DisplayDate($AR_DT['used_date']); ?></td>
                        <td><?php echo $AR_DT['use_first_name']."(".$AR_DT['use_user_id'].")"; ?></td>
                        <td><?php echo $AR_DT['pin_name']; ?></td>
                        <td><?php echo highlightWords($AR_DT['pin_no'],$_GET['pin_no']); ?></td>
                        <td><?php echo highlightWords($AR_DT['pin_key'],$_GET['pin_no']); ?></td>
                        <td><?php echo $AR_DT['net_pin_price']; ?></td>
                      </tr>
                      <?php $Ctrl++; endforeach; }else{ ?>
                    <tr>
                      <td colspan="8" align="center" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                    </tr>
                    <?php } ?>
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

 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul>
								  
								  
								   </div>
								   </div>

    </div>					
		
        </div>
      </div>
   
    <!-- END: Content-->	
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>

