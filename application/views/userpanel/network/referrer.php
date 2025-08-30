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
//	$StrWhr = " AND tree.nleft BETWEEN '$nleft' AND '$nright'";


	
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

	$QR_PAGE = "SELECT tm.*,  tm.member_mobile  AS mobile_number, 
	     tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
	 ts.subcription_id, ts.date_from, ts.date_expire , 
		 tpt.pin_name, tpt.pin_price
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		
		 LEFT JOIN ".prefix."tbl_subscription AS ts ON ( ts.member_id=tm.member_id )
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=ts.type_id
		 WHERE tm.sponsor_id='".$member_id."'
		 AND tm.delete_sts>0 
		 $StrLeft  $StrWhr 
		 GROUP BY tm.member_id
		 ORDER BY tm.date_join ASC";
	$PageVal = DisplayPages($QR_PAGE, 50, $Page, $SrchQ);
	
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
					<h4>My Referal</h4>
				
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
                            <th>S.No.</th>
                            
                            <th>User Id</th>
                            <th>Name</th>
                           
                            
                            <th>Reg. Date</th>
                            <th>Act. Date</th>
                            <th>Act. Value</th>
                             <!--<th>Team Business</th>-->
						<!--	<th>Position</th>-->
                            <!--<th>Access</th>                           -->
                        </tr>
                                        </thead>
                                        <tbody>
				<?php   if($PageVal['TotalRecords'] > 0){
				$Ctrl=$PageVal['RecordStart']+1;
				foreach($PageVal['ResultSet'] as $AR_DT):  
				$total_investment = $model->getInvestment($AR_DT['member_id']);
				$total_income = $model->getSumDailyReturn($AR_DT['member_id'],"","");
				?>
              <tr   >
                <td class=""><?php echo $Ctrl; ?></td>
              
                <td><?php echo $AR_DT['user_id']; ?></td>
                <td><?php echo $AR_DT['first_name']; ?> <?php echo $AR_DT['last_name']; ?></td>
               
                <td><?php echo DisplayDate($AR_DT['date_join']); ?></td>
                <td><?php echo DisplayDate($AR_DT['date_from']); ?></td>
                <td><?php echo CURRENCY; ?> <?php echo number_format($total_investment); ?></td>
                 <!--<td><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['team_bv'],2); ?></td>-->
               <!--<td><?php echo ($AR_DT['left_right']=='R')?'<span class="badge badge-info">Right</span>':'<span class="badge badge-success">Left</span>';?></td>-->
                <!--<td><a href="<?php echo BASE_PATH;?>member/network/tree?member_id=<?php echo _e($AR_DT['member_id'] );?>"  class="btn btn-info">View</a></td>-->
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
        <!--**********************************
            Content body end
        ***********************************-->


<?php

   $this->load->view(MEMBER_FOLDER.'/layout/footer'); 


?>


