<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	$left_right = (_d($segment['left_right']))? _d($segment['left_right']):_d($_REQUEST['left_right']);
	$from_date = InsertDate($segment['from_date']);
	$to_date = InsertDate($segment['to_date']);
	
	$yester_date = InsertDate(AddToDate($today_date,"-1 Day"));
	
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	

	
	$StrPlace .= ($left_right!='')? " AND spil_id='".$member_id."' AND  left_right='".$left_right."'":"";
	$StrPlace .= ($left_right=='')? " AND member_id='".$member_id."'":"";
	
// 	$all_left = $model->getDownlineMemberId($member_id,"L");
// 	$all_left_array = array_unique(array_filter($all_left));
	
	
// 	$all_right = $model->getDownlineMemberId($member_id,"R");
// 	$all_right_array = array_unique(array_filter($all_right));
	
 	
	$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE 1 $StrPlace ORDER BY member_id ASC LIMIT 1";
	$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
	
	$nleft = $AR_SELECT["nleft"];																																													
	$nright = $AR_SELECT["nright"];
	$StrWhr = " AND tree.nleft BETWEEN '$nleft' AND '$nright'";
	
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tm.date_join) BETWEEN '".$from_date."' AND '".$to_date."'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	if($_REQUEST['type_id']>0){
		$type_id = FCrtRplc($_REQUEST['type_id']);
		$StrWhr .=" AND tm.type_id='".$type_id."'";
		$SrchQ .="&type_id=$type_id";
	}
	
	if($_REQUEST['country_code']!=''){
		$country_code = FCrtRplc($_REQUEST['country_code']);
		$StrWhr .=" AND tm.country_code='".$country_code."'";
		$SrchQ .="&country_code=$country_code";
	}
	
	if($_REQUEST['subscription_sts']>0){
		$subscription_sts = FCrtRplc($_REQUEST['subscription_sts']);
		$StrWhr .=" AND ts.subcription_id>0";
		$SrchQ .="&subscription_sts=$subscription_sts";
	}
	
	$totalVolume = $model->getMemberCollection($member_id,$left_right,$from_date,$to_date);
 
	$QR_PAGE = "SELECT tm.member_id,tm.user_id,tm.first_name,tm.date_join, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, ts.date_from, ts.date_expire, ts.package_price, ts.subcription_id, 
		 tpt.pin_name
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_subscription AS ts ON ( ts.subcription_id=tm.subcription_id )
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=ts.type_id
		 WHERE tm.member_id!='".$member_id."' 
		 AND tm.delete_sts>0 
		 $StrWhr 
		 GROUP BY tm.member_id
		 ORDER BY tm.date_join DESC";
	$PageVal = DisplayPages($QR_PAGE, 200, $Page, $SrchQ);
?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	
<div class="content-page rtl-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">My Structure   <?php echo ($left_right =='L') ? 'Left':'Right';?></h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="datatable" class="table  table-striped table-bordered" >
                          <thead>
<tr>
<th>S.No.</th>
 
<th>User Id</th>
<th>Name</th>
 
<th>Registered</th>
<th>Activate Date</th>
<th>Activation</th>
<th>View Tree</th>
</tr>

                            
</thead>
<tbody>
<?php     	if($PageVal['TotalRecords'] > 0){
				$Ctrl=$PageVal['RecordStart']+1;
				foreach($PageVal['ResultSet'] as $AR_DT):
				$total_investment = $model->getInvestment($AR_DT['member_id']);
				$total_income = $model->getSumDailyReturn($AR_DT['member_id'],"","");
				?>
                 <tr  >
                <td class=""><?php echo $Ctrl; ?></td>
               
                <td><?php echo $AR_DT['user_id']; ?></td>
                <td><?php echo $AR_DT['first_name']; ?> <?php echo $AR_DT['last_name']; ?></td>
                
                <td><?php echo DisplayDate($AR_DT['date_join']); ?></td>
                <td><?php echo DisplayDate($AR_DT['date_from']); ?></td>
                <td><?php echo CURRENCY; ?> <?php echo number_format($total_investment); ?></td>
               <!-- <td><?php echo number_format($total_income,2); ?></td>-->
                 <td><a href="<?php echo BASE_PATH;?>member/network/tree?member_id=<?php echo _e($AR_DT['member_id'] );?>"  class="btn btn-info">View</a></td>
              </tr>
              
              <?php $Ctrl++;
			   endforeach;	}else{
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
	
	
 
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>