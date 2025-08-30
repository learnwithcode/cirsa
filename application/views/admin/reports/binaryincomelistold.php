<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}

if($_GET['process_id']>0){
    $process_id  = $_GET['process_id'];
    $StrWhr .=" AND tcb.process_id='".$process_id."'";
    $SrchQ .="&process_id=$process_id";
}else{ set_message("warning","unable to load binary detail"); redirect_page("bonus","binaryincome",""); }

$QR_PAGES="SELECT tcb.*, tm.user_id, tpt.prod_pv, tpt.pin_name , tp.start_date, tp.end_date,tm.first_name,tm.last_name,tm.city_name
         FROM ".prefix."tbl_cmsn_binary AS tcb 
         LEFT JOIN ".prefix."tbl_process AS tp ON tp.process_id=tcb.process_id
         LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcb.member_id
         LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
         WHERE 1 $StrWhr   ORDER BY tcb.binary_id DESC";
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Binary Income List </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                      <table id="no-more-tables"  class="table table-striped table-bordered table-hover">
                <thead>
                  <tr role="row">
                      <th>Sn.</th>
                    <th  class="">Week Date </th>
                    <th  class="">Distributor Id</th>
                    <th  class="">Name </th>
                   <th  class="">Binary Id </th> 
                       <th  class="">Pv Details </th>
                      <th  class="">Amount Detail </th>
                     
                    <th  class="">Net Income </th>
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
                        $package_ceiling = ($AR_DT['prod_pv']*7);
                        $ceiling_max_limit = 35000;
                        $binary_ceiling = ($package_ceiling<=$ceiling_max_limit)? $package_ceiling:$ceiling_max_limit;
                    ?>
                  <tr class="odd" role="row">
                      <td data-title="Sn"><?php echo $Ctrl;$Ctrl++;?></td>
                    <td  data-title="Week Date"><?php echo DisplayDate($AR_DT['start_date']); ?> - To - <?php echo DisplayDate($AR_DT['end_date']); ?></td>
                    <td data-title="User Id"><?php echo strtoupper($AR_DT['user_id']); ?></td>
                    <td data-title="User Name"><?php echo strtoupper($AR_DT['first_name'].' '.$AR_DT['last_name']); ?></td>
                    <td data-title="City Name">ELD-<?php echo strtoupper($AR_DT['binary_id']); ?></td> 
                                  <td data-title="Details">
                           <strong>CF LPV :-             <?php echo $AR_DT['leftCrf']; ?>
                             <br> <strong>CF RPV :-       <?php echo $AR_DT['rightCrf']; ?>
                              <br> <strong>New L PV :-   <?php echo $AR_DT['newLft']; ?>
                              <br> <strong>New RPV :-    <?php echo $AR_DT['newRgt']; ?>
                              <br> <strong>Left PV :-      <?php echo $AR_DT['totalLft']; ?>
                             <br> <strong>Right PV :-      <?php echo $AR_DT['totalRgt']; ?>
                           <br> <strong>Pair match :- </strong>  <?php echo $AR_DT['pair_match']; ?>
                                      
                                      
                                      
                                    </td>
                                    
                                     <td data-title="Amount Details">
                        <!--    <strong>Total Collection :-             <?php echo $AR_DT['amount']+ $AR_DT['binary_ceiling']; ?>-->
                       <!--   <br> <strong>Capping :-    <?php echo $AR_DT['binary_ceiling']; ?>-->
                           <br><strong>Amount :-    </strong>         <?php echo $AR_DT['amount']; ?>
                        <!--     <br> <strong>Admin Charge :-       <?php echo $AR_DT['admin_charge']; ?>
                              <br> <strong>TDS :-   <?php echo $AR_DT['tds']; ?>
                              <br> <strong>Repurchase :-   <?php echo $AR_DT['repurchase_detection']; ?>-->
                            
                                      
                                      
                                      
                                    </td>
                                  
                   
                    <td data-title="Amount"><?php echo $AR_DT['net_cmsn']; ?></td>
                  </tr>
                  <?php 
                        endforeach;
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