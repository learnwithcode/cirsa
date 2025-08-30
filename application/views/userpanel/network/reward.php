<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	
	$from_date = InsertDate($segment['from_date']);
	$to_date = InsertDate($segment['to_date']);
	
	$yester_date = InsertDate(AddToDate($today_date,"-1 Day"));
	$member_id = $this->session->userdata('mem_id');
	
	$AR_SELECT = $model->getMember($member_id);
	
	
	$nleft = $AR_SELECT["nleft"];
	$nright = $AR_SELECT["nright"];
	$StrWhr = " AND tree.nleft BETWEEN '$nleft' AND '$nright'";


	
	if($_GET['country_code']!=''){
		$country_code = FCrtRplc($_GET['country_code']);
		$StrWhr .=" AND tm.country_code='".$country_code."'";
		$SrchQ .="&country_code=$country_code";
	}
	
	if($_GET['from_date']!='' && $_GET['to_date']!=''){
		$from_date = InsertDate($_GET['from_date']);
		$to_date = InsertDate($_GET['to_date']);
		$StrWhr .=" AND DATE(tm.date_join) BETWEEN '".$from_date."' AND '".$to_date."'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	if($_GET['subscription_sts']>0){
		$subscription_sts = FCrtRplc($_GET['subscription_sts']);
		$StrWhr .=" AND ts.subcription_id>0";
		$SrchQ .="&subscription_sts=$subscription_sts";
	}

// 	$QR_PAGE = "SELECT tm.*,  tm.member_mobile  AS mobile_number, 
// 	     tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
// 		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, ts.subcription_id, ts.date_from, ts.date_expire , 
// 		 tpt.pin_name, tpt.pin_price
// 		 FROM ".prefix."tbl_members AS tm	
// 		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
// 		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
// 		 LEFT JOIN ".prefix."tbl_subscription AS ts ON ( ts.member_id=tm.member_id )
// 		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=ts.type_id
// 		 WHERE tm.sponsor_id='".$member_id."'
// 		 AND tm.delete_sts>0 
// 		 $StrLeft  $StrWhr 
// 		 GROUP BY tm.member_id
// 		 ORDER BY tm.team_bv DESC";
		 
		 $QR_PAGE   = $this->SqlModel->runQuery("SELECT user_id, count_directs , SUM(self_bv+team_bv) as total, SUM(r_self_bv+r_team_bv) as total1 FROM `tbl_members` WHERE sponsor_id =  '$member_id'  and subcription_id > 0 GROUP BY member_id ORDER BY `total` DESC  ");   
          
		 
		 
//	$PageVal = DisplayPages($QR_PAGE, 50, $Page, $SrchQ);
	
?>
 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); 
?>

         
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                           
                        </div>
                    </div>
                 
                </div>
                <!-- row -->

                <div class="row">
                 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Team Business</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                              <tr>
                            <th>S.No.</th>
                            
                            <th>User Id</th>
                           
                            <th>Team Business</th>
                               <th>Retoup Business</th>
                                    <th>Total Business</th>
						<!--	<th>Position</th>-->
                            <!--<th>Access</th>                           -->
                        </tr>
                            </thead>
                           <tbody>
				<?php   $Ctrl=1;
				$k1 = 1;
				foreach($QR_PAGE as $AR_DT):  
				// $total_investment = $model->getInvestment($AR_DT['member_id']);
				// $total_income = $model->getSumDailyReturn($AR_DT['member_id'],"","");
				
				
				//  if($k1 == 1)
    //                  {
    //                     $A1 =  $AR_DT['total']*40/100;
    //                  }elseif($k1 == 2)
    //                  {
    //                     $A2 =  $AR_DT['total']*40/100;
    //                  }
    //                  else
    //                  {
    //                     $B1 +=  $AR_DT['total']*20/100;
    //                  }
                     
    //                  $k1++;
				
				
				
				
				
				
				?>
              <tr   >
                <td class=""><?php echo $Ctrl; ?></td>
              
                <td><?php echo $AR_DT['user_id']; ?></td>
               
                
                <td><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['total'],2); ?></td>
                  <td><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['total1'],2); ?></td>
                    <td><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['total']+$AR_DT['total1'],2); ?></td>
               <!--<td><?php echo ($AR_DT['left_right']=='R')?'<span class="badge badge-info">Right</span>':'<span class="badge badge-success">Left</span>';?></td>-->
                <!--<td><a href="<?php echo BASE_PATH;?>member/network/tree?member_id=<?php echo _e($AR_DT['member_id'] );?>"  class="btn btn-info">View</a></td>-->
              </tr>
              <?php $Ctrl++;
			   endforeach;	?>
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