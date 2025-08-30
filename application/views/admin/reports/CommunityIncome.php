<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $model = new OperationModel();
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

    
    
    if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
        $from_date = InsertDate($_REQUEST['from_date']);
        $to_date = InsertDate($_REQUEST['to_date']);
        $StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
        $SrchQ .="&from_date=$from_date&to_date=$to_date";
    }
    
    if($_REQUEST['user_id']!=''){
        $member_id = $model->getMemberId($_REQUEST['user_id']);
        $StrWhr .=" AND tcd.member_id='$member_id'";
        $SrchQ .="&user_id=$user_id";
    }

    
    $QR_PAGES= "SELECT tcd.*,count(tcd.id) as total,sum(tcd.net_income) as net, tm.user_id    FROM  tbl_cmsn_community AS tcd 
			   LEFT JOIN tbl_members AS tm ON tcd.member_id=tm.member_id
			   WHERE 1   $StrWhr group by tcd.process_id ORDER BY tcd.id DESC ";
    $PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);  
    
    // $QR_SUM = "SELECT SUM(tcd.net_income) AS net_income FROM tbl_cmsn_community AS tcd WHERE 1 $StrWhr ORDER BY tcd.id DESC";
    // $AR_SUM = $this->SqlModel->runQuery($QR_SUM,true);
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Community Income  </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

             <table class="table table-striped">
  <thead>
                    <tr role="row">
					<th  class="sorting">S. No</th>
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
					?>
                 <tr class="odd" role="row">
					 <td data-title="Sn No"><?php echo $Ctrl;$Ctrl++;?></td>
                      <td data-title="Date"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                      <td data-title="Full Name"><?php echo $AR_DT['total']; ?></td>
                      <td data-title="Username"><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['net'],4); ?></td>
                      <td data-title="Net Income"><a href="<?php echo generateSeoUrlAdmin("reports","CommunityIncomeList",""); ?>?process_id=<?php echo $AR_DT['process_id']; ?>">View</a><?php //echo number_format($AR_DT['total_income'],2); ?></td>
           
                 
                        </tr>
                    <?php $Ctrl++; 
				  	endforeach;
					}else{ ?>
                    <tr class="odd" role="row">
                      <td colspan="5" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                    </tr>
                    <?php } ?>
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
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $("#form-valid").validationEngine();
        $("#form-valid").validationEngine();
        $(".getStateList").on('blur',getStateList);
        $(".getCityList").on('blur',getCityList);
        function getStateList(){
            var country_code = $("#country_code").val();
            var URL_STATE = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=STATE_LIST&country_code="+country_code;
            $("#state_name").load(URL_STATE);
        }
        function getCityList(){
            var state_name = $("#state_name").val();
            var URL_CITY = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=CITY_LIST&state_name="+state_name;
            $("#city_name").load(URL_CITY);
        }
    });
</script>