<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}


if($_REQUEST['process_id']!=''){
    $process_id = FCrtRplc($_REQUEST['process_id']);
    $StrWhr .=" AND tp.process_id='$process_id'";
    $SrchQ .="&process_id=$process_id";
}
 
 $QR_PAGES="SELECT tp.*, SUM(tcb.pair_match) AS pair_match,count(tcb.binary_id) AS binary_id  ,  SUM(tcb.amount) as amount  
         FROM ".prefix."tbl_cmsn_level_binary AS tcb 
         LEFT JOIN ".prefix."tbl_process AS tp ON tcb.process_id=tp.process_id 
         WHERE 1 
         $StrWhr 
         GROUP BY tp.process_id ORDER BY tp.process_id DESC";
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Binary Income </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

              <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr role="row">
                      <th  class="">Srl No </th>
                      <th  class="">Date</th>
                      <th  class="">Process Week </th>
                      <th  class="">Total Member </th>
                <!--      <th  class="">Capping Amount </th>-->
                    <!--  <th  class="">Net Amount </th>
                       <th  class="">Admin Charge </th>
                        <th  class="">TDS </th>
                         <th  class="">Repurchase </th>-->
                      
                      <th  class="">Total Match  </th>
                      
                      <th  class="">Report </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if($PageVal['TotalRecords'] > 0){
                    $Ctrl=1;
                        foreach($PageVal['ResultSet'] as $AR_DT):
                    ?>
                    <tr class="odd" role="row">
                      <td data-title="Srl No" class=""><?php echo $Ctrl; ?></td>
                      <td data-title="Date" class=""><?php echo DisplayDate($AR_DT['end_date']); ?></td>
                      <td data-title="Process Week" class=""><?php echo DisplayDate($AR_DT['start_date']); ?> - To - <?php echo DisplayDate($AR_DT['end_date']); ?></td>
                      <td data-title="Total Collection "><?php echo number_format($AR_DT['amount']+ $AR_DT['binary_id']); ?></td>
                    <!--  <td data-title="Capping Amount"><?php echo number_format($AR_DT['binary_ceiling'],2); ?></td>
                         <td data-title="Amount "><?php echo number_format($AR_DT['amount'],2); ?> </td>
                        <td data-title="Admin Charge "><?php echo number_format($AR_DT['admin_charge'],2); ?> </td>
                           <td data-title="TDS "><?php echo number_format($AR_DT['tds'],2); ?> </td>
                               <td data-title="Repurchase "><?php echo number_format($AR_DT['repurchase_detection'],2); ?> </td>-->
                      <td data-title="Total Sum"><?php echo number_format($AR_DT['pair_match'],2); ?></td>
                      <td data-title="Report"><a href="<?php echo generateSeoUrlAdmin("reports","binaryincomelist",""); ?>?process_id=<?php echo $AR_DT['process_id']; ?>">View</a></td>
                    </tr>
                    <?php $Ctrl++; 
                    endforeach;
                    }else{ ?>
                    <tr class="odd" role="row">
                      <td colspan="6" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
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
        $("#form-valid").validationEngine();
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        
    });
</script>