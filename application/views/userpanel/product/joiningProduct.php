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

$QR_LINE="SELECT tm.* ,  CONCAT_WS('-',tm.mobile_code,tm.member_mobile) AS mobile_number, 
		 tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_name AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join , tpt.pin_name, tpt.mrp , sub.order_no as orderId,sub.date_from as fdate
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tree.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
		 LEFT JOIN ".prefix."tbl_subscription AS sub ON tm.member_id=sub.member_id
		 WHERE tm.delete_sts>0  AND tm.type_id>'0' and tm.member_id='".$member_id."'
		 $StrWhr GROUP BY tm.member_id   ORDER BY tm.member_id ASC";


/*	$QR_LINE = "SELECT tm.*, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name, 
		 tmsp.user_id AS spsr_user_id ,	 tree.nlevel, tree.left_right, tree.nleft, tree.nright , tpt.pin_name
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
		 WHERE  tm.delete_sts>0 AND tm.member_id!='".$member_id."'
		 $StrLeft  $StrWhr 
		 ORDER BY tm.member_id ASC";*/
	$PageVal = DisplayPages($QR_LINE, 50, $Page, $SrchQ);
	
	//echo_sql();
	//echo "<pre>";print_r($PageVal);die;

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
                <h4 class="card-title">My Joining Detail			</h4>
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
<tr>
<th>S.No.</th>
<th>Date</th>
<th>Activation Date</th>
<th>Name</th>
<th>Package</th>
<th>Amount</th>
<th>Order Id</th>

 <th>A/c. Status</th> 

</tr>

                            
</thead>
<tbody>
<?php 
				$Ctrl=$PageVal['RecordStart']+1;
				foreach($PageVal['ResultSet'] as $AR_DT):
				$total_investment = $model->getInvestment($AR_DT['member_id']);
				$total_income = $model->getSumDailyReturn($AR_DT['member_id'],"","");
				?>
              <tr >
                <td class=""><?php echo $Ctrl; ?></td>
                <td class=""><?php echo $AR_DT['date_join']; ?> </td>
                 <td class=""><?php echo $AR_DT['fdate']; ?> </td>
                <td><?php echo $AR_DT['first_name']; ?> <?php echo $AR_DT['last_name']; ?></td>
                <td><?php echo ($AR_DT['pin_name']!='')? $AR_DT['pin_name']:"Free"; ?></td>
                <td><?php echo ($AR_DT['mrp']>0)? number_format($AR_DT['mrp'],2):"---"; ?></td>
                <td><?php echo $AR_DT['orderId']; ?></td>
  
                <td><?php
                        
                			$AR_TYPE  = $model->getCurrentMemberShip($AR_DT['member_id']);
                			$pain_name = ($AR_TYPE['pin_name'])? $AR_TYPE['pin_name']:"Free";
                			
                		    if($AR_TYPE['package_price'] >0){
		                      echo '<span class="label label-lg label-success arrowed-in arrowed-in-right">Active</span>'; 
		                    }
		                    
                		    else{
                		        echo '<span class="label label-lg label-yellow arrowed-in arrowed-in-right">In-Active</span>'; 
                		    }
                            ?></td>
     
              </tr>
              
              <?php $Ctrl++;
			   endforeach;	?>
            </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="row">
<div class="col-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
</div></div>

<div class="col-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul>
								  
								   </div></div>
-->
    </div>					
		
        </div>
      </div>
    </div>
    <!-- END: Content-->	
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>

