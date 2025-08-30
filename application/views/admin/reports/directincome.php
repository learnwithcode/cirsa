<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $model = new OperationModel();
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

    
    
    if($_GET['from_date']!='' && $_GET['to_date']!=''){
        $from_date = InsertDate($_GET['from_date']);
        $to_date = InsertDate($_GET['to_date']);
        $StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
        $SrchQ .="&from_date=$from_date&to_date=$to_date";
    }
    
    if($_GET['user_id']!=''){
        $member_id = $model->getMemberId($_GET['user_id']);
        $StrWhr .=" AND tcd.member_id='$member_id'";
        $SrchQ .="&user_id=$user_id";
    }
    if($_GET['process_id'] !='')
    {
        $processId = $_GET['process_id'];
        $StrWhr .="  AND tcd.process_id='$processId'";
        
    }

    
    $QR_PAGES= "SELECT tcd.*, tmf.user_name AS from_user_name, tmt.user_name AS to_user_name, tmt.full_name AS to_name
                FROM ".prefix."tbl_cmsn_direct AS tcd 
               LEFT JOIN tbl_members AS tmf ON tcd.from_member_id=tmf.member_id
               LEFT JOIN tbl_members AS tmt ON tmt.member_id=tcd.member_id
              WHERE 1 $StrWhr  ORDER BY tcd.direct_id DESC";
    $PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);  
    
    $QR_SUM = "SELECT SUM(tcd.net_income) AS net_income FROM tbl_cmsn_direct AS tcd WHERE 1 $StrWhr ORDER BY tcd.direct_id DESC";
    $AR_SUM = $this->SqlModel->runQuery($QR_SUM,true);
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
                         <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Direct Referral Bonus List </small>  </h4>
                        </div>
                        <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                    <a  href="<?php echo generateSeoUrlAdmin("excel","directincome",""); ?>/<?php echo $processId; ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                    <table class="table table-striped">
  <thead>
                    <tr role="row">
                      <th  class="sorting">Sr. No </th>
                      <th  class="sorting">Date</th>
                      <th  class="sorting">Distributor Id </th>
                      <th  class="sorting">Name </th>
                      <th  class="sorting">From Distribituor Id </th>
                      <th  class="sorting">Amount</th>
                      <th  class="sorting">Net Income </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        if($PageVal['TotalRecords'] > 0){
                            if($Page > 1)
                            {
                                $Page = ($Page -1)* 50 +1;
                            }
                            
                        $Ctrl=$Page;
                            foreach($PageVal['ResultSet'] as $AR_DT):
                        ?>
                    <tr class="odd" role="row">
                      <td data-title="Sr. No"><?php echo $Ctrl; ?></td>
                      <td data-title="Date"><?php echo getDateFormat($AR_DT['date_time'],"d M Y"); ?></td>
                      <td data-title="Member Id"><?php echo strtoupper($AR_DT['to_user_name']); ?></td>
                      <td data-title="name"><?php echo strtoupper($AR_DT['to_name']); ?></td>
                      <td data-title="From Member Id"><?php echo strtoupper($AR_DT['from_user_name']); ?></td>
                      <td data-title="Amount"><?php echo number_format($AR_DT['total_collection'],2); ?></td>
                     
                      <td data-title="Net Income"><?php echo number_format($AR_DT['net_income'],2); ?></td>
                    </tr>
                    <?php $Ctrl++; endforeach;
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