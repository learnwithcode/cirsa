<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	$from_date = InsertDate($segment['from_date']);
	$to_date = InsertDate($segment['to_date']);
	
	$yester_date = InsertDate(AddToDate($today_date,"-1 Day"));
	
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	
	$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE member_id='".$member_id."';";
	$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
	
	$nleft = $AR_SELECT["nleft"];
	$nright = $AR_SELECT["nright"];
	$StrLeft = " AND tree.nleft BETWEEN '$nleft' AND '$nright'";

	if($from_date!='' && $to_date!=''){
		$StrWhr .=" AND DATE(tm.date_join) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
	}

  	$QR_LINE = "SELECT  tm.member_id,tm.user_id,tm.first_name,tm.date_join,tm.left_right, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name, 
		 tmsp.user_id AS spsr_user_id ,	 tree.nlevel, tree.left_right, tree.nleft, ts.date_from, tree.nright , tpt.pin_name
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
	
		  LEFT JOIN ".prefix."tbl_subscription AS ts ON ( ts.subcription_id=tm.subcription_id )
		  	 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=ts.type_id
		 WHERE  tm.delete_sts>0 AND tm.member_id!='".$member_id."'
		 $StrLeft  $StrWhr 
		 ORDER BY tm.member_id ASC";
	$PageVal = DisplayPages($QR_LINE, 50, $Page, $SrchQ);
 

?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	
 <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Network</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">My Downline List</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->


                <div class="row">
                    
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                               
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example2" class="display" style="width:100%">
                                                               <thead>
<tr>
<th width="5%">S.No.</th>
<!--<th width="15%">Profile</th>-->
<th width="10%">User Id</th>
<th width="15%">Name</th>
<th width="10%">Package</th>

<th width="10%">Registered</th>
<th width="10%">Activate date</th>
<th width="7%">Activation BV</th>
<!--<th width="8%">Position</th>-->
<th width="10%">Access</th>
</tr>

                            
</thead>
<tbody>
<?php   if($PageVal['TotalRecords'] > 0){
				$Ctrl=$PageVal['RecordStart']+1;
				foreach($PageVal['ResultSet'] as $AR_DT):
				$total_investment = $model->getInvestment($AR_DT['member_id']);
				$total_income = $model->getSumDailyReturn($AR_DT['member_id'],"","");
				?>
                   <tr <?php if($total_investment > 0 ){?>style="background: #44814e!important;color:white;" <?php } ?> >
                <td class=""><?php echo $Ctrl; ?></td>
                <!--<td class=""><img alt="<?php echo $AR_DT['first_name']; ?>" class="table-img" src="<?php echo getMemberImage($AR_DT['member_id']); ?>" style="width: 50px;"> </td>-->
                <td><?php echo $AR_DT['user_id']; ?></td>
                <td><?php echo $AR_DT['first_name']; ?> <?php echo $AR_DT['last_name']; ?></td>
                <td><?php echo ($AR_DT['pin_name'])? $AR_DT['pin_name']:"Free"; ?></td>
                
                <td><?php echo DisplayDate($AR_DT['date_join']); ?></td>
                <td><?php echo DisplayDate($AR_DT['date_from']); ?></td>
                <td><?php echo number_format($total_investment,2); ?></td>
       <!-- <td><?php echo ($AR_DT['left_right']=='R')?'<span class="label label-lg label-yellow arrowed-in arrowed-in-right">Right</span>':'<span class="label label-lg label-success arrowed-in arrowed-in-right">Left</span>';?></td>
       -->       
      <!-- <td><a href="#"  class="btn btn-info">View</a></td>-->
                 
                 <td><a href="<?php echo BASE_PATH;?>member/network/tree?member_id=<?php echo _e($AR_DT['member_id'] );?>"  class="btn btn-info">View</a></td>
                 
                 
              </tr>
              
              <?php $Ctrl++;
			   endforeach;		}else{
									?>
									<tr class="odd" role="row">
										<td colspan="10" align="center">No transaction found</td>
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

	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>