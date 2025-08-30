<?php defined('BASEPATH') OR exit('No direct script access allowed');
	$model = new OperationModel();
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$segment = $this->uri->uri_to_assoc(2);
	
	$daily_cmsn_id = (_d($segment['daily_cmsn_id'])>0)? _d($segment['daily_cmsn_id']):_d($_REQUEST['daily_cmsn_id']);
	if($daily_cmsn_id>0){
	$AR_CMSN = $model->getCmsnDaily($daily_cmsn_id);
		$cmsn_date = InsertDate($AR_CMSN['cmsn_date']);
		$type_id = ($AR_CMSN['type_id']);
		$StrWhr .=" AND DATE(tcd.cmsn_date)='".$cmsn_date."' AND tcd.type_id='".$type_id."'";
		$SrchQ .="&daily_cmsn_id="._e($daily_cmsn_id)."";
	}
	
	if($_REQUEST['type_id']>0){
		$type_id = FCrtRplc($_REQUEST['type_id']);
		$StrWhr .=" AND tcd.type_id='".$type_id."'";
		$SrchQ .="&type_id=$type_id";
	}
	
	
	if($_REQUEST['cmsn_date']!=''){
		$cmsn_date = InsertDate($_REQUEST['cmsn_date']);
		$StrWhr .=" AND DATE(tcd.cmsn_date)='".$cmsn_date."'";
		$SrchQ .="&cmsn_date=$cmsn_date";
	}
	
	if($_REQUEST['user_id']!=''){
		$member_id = $model->getMemberId($_REQUEST['user_id']);
		$StrWhr .=" AND tcd.member_id='$member_id'";
		$SrchQ .="&user_id=$user_id";
	}
	
	if(_d($_REQUEST['member_id'])>0){
		$member_id = _d($_REQUEST['member_id']);
		$StrWhr .=" AND tcd.member_id='$member_id'";
		$SrchQ .="&member_id=$member_id";
	}
	
	if(_d($_REQUEST['subcription_id'])>0){
		$subcription_id = _d($_REQUEST['subcription_id']);
		$StrWhr .=" AND tcd.subcription_id='$subcription_id'";
		$SrchQ .="&subcription_id=$subcription_id";
	}
 
	$QR_PAGES="SELECT tcd.*,count(tcd.daily_cmsn_id) as total,sum(tcd.net_income) as net, tm.user_id , tpt.pin_name
			   FROM ".prefix."tbl_cmsn_quick AS tcd 
			   LEFT JOIN tbl_members AS tm ON tcd.member_id=tm.member_id
			   LEFT JOIN tbl_pintype AS tpt ON tpt.type_id=tcd.type_id
			   WHERE 1 $StrWhr group by tcd.process_id ORDER BY tcd.daily_cmsn_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
 ?>

     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>  
<script type="text/javascript">
    $(function(){
        $(".open_modal").on('click',function(){
            $('#search-modal').modal('show');
            return false;
        });
    });
</script>
<style>
   
.table td, .table th {
    padding: 5px;
}
</style>
 <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                  <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            <section class="tile">
 
                                <!-- tile body -->
                                <div class="tile-body table-custom">

                                    <div class="table-responsive">
                        <div class="col-sm-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Royalty Bonus </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

              <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                   <thead>
                    <tr role="row">
					<th  class="sorting">Sn</th>
                      <th  class="sorting">Date</th>
                      <th  class="sorting">	Total Distributor Id</th>
                      <th  class="sorting">Amount</th>
                    
                      <th  class="sorting">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
						if($PageVal['TotalRecords'] > 0){
						$Ctrl=1;
							foreach($PageVal['ResultSet'] as $AR_DT):
							$net_income_sum +=$AR_DT['net'];
						?>
                    <tr class="odd" role="row">
					 <td data-title="Sn No"><?php echo $Ctrl;$Ctrl++;?></td>
                      <td data-title="Date"><?php echo getDateFormat($AR_DT['cmsn_date'],"d M Y h:i"); ?></td>
                      <td data-title="Full Name"><?php echo $AR_DT['total']; ?></td>
                      <td data-title="Username"><?php echo CURRENCY; ?><?php echo $AR_DT['net']; ?></td>

                      <td data-title="Net Total"><a href="<?php echo generateSeoUrlAdmin("reports","royalty_bonusList",""); ?>?process_id=<?php echo $AR_DT['process_id']; ?>">View</a><?php //echo number_format($AR_DT['total_income'],2); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr class="odd" role="row">
                      <td class="sorting_1">&nbsp;</td>
                      
                     
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td><strong>Sum Total </strong></td>
                      <td><strong><?php echo number_format($net_income_sum,2); ?></strong></td>
                    </tr>
                    <?php }else{ ?>
                    <tr class="odd" role="row">
                      <td colspan="8" class="text-danger">No record found </td>
                    </tr>
                    <?php
						}
						 ?>
                  </tbody>
                </table>   
                  <div class="row">
                    <div class="col-xs-6">
                      <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries </div>
                    </div>
                    <div class="col-xs-6">
                      <div id="dynamic-table_paginate" class="dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                          <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                        </ul>
                      </div>
                    </div>
                  </div>
                                    </div>
                                    </div>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
                        </div>
                        <!-- /col -->






                    </div>
                    <!-- /row -->
            </div>
         </div>

         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
 <?php jquery_validation(); ?>
<script type="text/javascript">
    $(function(){
        $("#form-valid").validationEngine();
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        
    });
</script>