<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}


if($_REQUEST['process_id']!=''){
    $process_id = FCrtRplc($_REQUEST['process_id']);
    $StrWhr .=" AND tp.process_id='$process_id'";
    $SrchQ .="&process_id=$process_id";
} 
$QR_PAGES="SELECT tp.*  , SUM(ms.flushout) as flushout, SUM(ms.bonus_2) as bonus_2, SUM(ms.bonus) as bonus, SUM(ms.performance_income) as performance_income, SUM(ms.commuinity) as commuinity  ,   SUM(ms.level) as level ,SUM(ms.direct) as direct ,SUM(ms.residual) as residual ,SUM(ms.pool) as pool ,SUM(ms.quick) as quick  ,SUM(ms.club_income) as club_income ,SUM(ms.total_income) as total_income ,SUM(ms.admin_charge) as admin_charge ,SUM(ms.tds) as tds ,SUM(ms.net_income) as net_income FROM  ".prefix."tbl_process AS tp 
         LEFT JOIN ".prefix."`tbl_cmsn_mstr` as ms  ON ms.process_id=tp.process_id
         WHERE tp.pair_sts='Y' 
         $StrWhr 
         GROUP BY tp.process_id ORDER BY tp.process_id DESC";
         
 
 
      $PageVal = DisplayPages($QR_PAGES, 300, $Page, $SrchQ);    

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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Total Income </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                            <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr role="row">
                           <th>S.No.</th>
                                                <th  class="">Date</th>
                     <th class="shrink" >Rental Income</th>
                     
                       <th class="shrink" >Referral Income</th>
                        <th class="shrink" >Level Income</th>
                     <th class="shrink" style="display:none;" >Royalty Income</th>
                        <th class="shrink" style="display:none;" >Reward Income</th>
                        <th>Total Income</th>
                        <!--<th>Admin Charge</th>-->
                        
                    <!--    <th  class="">Net Amount </th>-->
                        <th  class="">Report </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if($PageVal['TotalRecords'] > 0){
                    $Ctrl=$PageVal['RecordStart']+1; 
                        foreach($PageVal['ResultSet'] as $AR_DT):
                        //  PRintR($AR_DT);
                            
                              $Boardincome = $model->getboardincomeadmin("Pool",$AR_DT['end_date']); 
                             // echo $AR_DT['process_id'];
                             //  $direct       =+ $model->getdirectamountbyprocessid($AR_DT['process_id']);
                              $direct = $model->getdirectincomeadmin("DCA",$AR_DT['end_date']); 
                                $level = $model->getlevelincomeadmin("INCOME_L",$AR_DT['end_date']); 
                             // PrintR($Boardincome);
                               // PRintR($direct);
                                $daily = $model->getroiincomeadmin("Daily",$AR_DT['process_id']); 
                    ?>












                    <tr class="odd" role="row">
                             <td class=""><?php echo $Ctrl;   ?></td>
           <td data-title="Process Week" class=""><?php echo date('d-M-Y ',strtotime($AR_DT['end_date'])); ?>  </td>
            
         
   <td data-title="Total Sum"   class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($daily,2); ?></td> 
               
     <td data-title="Total Sum"  class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['direct'],2); ?></td>
   
          
                    <td data-title="Total Sum"  class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['level'],2); ?></td>
                     <td data-title="Total Sum"  class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['quick'],2); ?></td>
                      <td data-title="Total Sum"  style="display:none;"   class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['bonus'],2); ?></td>
                    
                    <td data-title="Total Sum"  style="display:none;" class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['bonus_2'],2); ?></td>
                   
                          <td data-title="Total Sum" style="display:none;"> <?php echo CURRENCY; ?><?php echo number_format($AR_DT['total_income']+$Boardincome+$level+$direct+$AR_DT['royalty_income'],2); ?></td>
                         <!--<td data-title="Total Sum"> <?php echo CURRENCY; ?><?php echo number_format($AR_DT['admin_charge'],2); ?></td>-->
                       
                         <!-- <td data-title="Total Sum"><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['net_income']+$direct+$Boardincome,2); ?></td>-->
                          
                      <td data-title="Report"><a href="<?php echo generateSeoUrlAdmin("reports","totalincomelist",""); ?>?process_id=<?php echo $AR_DT['process_id']; ?>">View</a></td>
                    </tr>
                    <?php $Ctrl++; 
                    endforeach;
                    }else{ ?>
                    <tr class="odd" role="row">
                      <td colspan="9" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                    </tr>
                    <?php } ?>
                  </tbody>
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