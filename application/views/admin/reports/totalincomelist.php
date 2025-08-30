<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
//PrintR($_GET);
if($_GET['process_id']>0){
    $process_id  = $_GET['process_id'];
    $StrWhr .=" AND tcm.process_id='".$process_id."'";
    $SrchQ .="&process_id=$process_id";
}

 $QR_PAGES="SELECT tcm.*,tm.pan_no, tm.user_id, tpt.prod_pv, tpt.pin_name , tp.start_date, tp.end_date,tm.first_name,tm.midle_name,tm.last_name,tm.city_name
         FROM ".prefix."tbl_cmsn_mstr AS tcm
         LEFT JOIN ".prefix."tbl_process AS tp ON tp.process_id=tcm.process_id
         LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=tcm.member_id
         LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
         WHERE 1 $StrWhr ORDER BY tm.first_name,tm.midle_name,tm.last_name ASC";
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Total Income List </small>  </h4>
                        </div>
                        <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                    <a  href="<?php echo generateSeoUrlAdmin("excel","totalincome",""); ?>/<?php echo $process_id; ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                         <table id="no-more-tables"  class="table table-striped table-bordered table-hover">
                <thead>
                  <tr role="row">
                      <th>Sn.</th>
                    <th  class="">  Date </th>
                    <th  class="">Distributor Id</th>
                    <th  class="">Name </th>
                      <th class="shrink" >Rental Income</th>
                     
                       <th class="shrink" >Referral Income</th>
                        <th class="shrink" >Level Income</th>
                     <th class="shrink" style="display:none;" >Royalty Income</th>
                      <th class="shrink" style="display:none;" >Reward Income</th>
                        <th>Total Bonus</th>
                        <th>Admin Charge</th>
                        
                        <!--<th  class="">Net Amount </th>-->
                   
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    if($PageVal['TotalRecords'] > 0){
                  
                        $Ctrl=$PageVal['RecordStart']+1;
                        foreach($PageVal['ResultSet'] as $AR_DT):
                            //PrintR($AR_DT);
                          
                $directIncome = $model->getincomesallnewadmin("Direct",$AR_DT['member_id'],$AR_DT['process_id']);
                
                $Level = $model->getincomesallnewadmin("Level",$AR_DT['member_id'],$AR_DT['process_id']);
                $Boardincome = $model->getincomesallnewadmin("Pool",$AR_DT['member_id'],$AR_DT['end_date']);

                         
                         
                    ?>
                  <tr class="odd" role="row">
                      <td data-title="Sn"><?php echo $Ctrl;$Ctrl++;?></td>
            <td data-title="Process Week" class=""><?php echo  date("d-m-Y  ", strtotime($AR_DT['end_date']));   ?>
            
            <!--- To - <?php echo date("d-m-Y H:i:s", strtotime($AR_DT['end_date'])) ; ?>-->
            
            </td>
                      <td data-title="User Id"><?php echo strtoupper($AR_DT['user_id']); ?></td>
                      <td data-title="User Name"><?php echo strtoupper($AR_DT['first_name'].' '.$AR_DT['midle_name'].' '.$AR_DT['last_name']); ?></td>
                       
            
   <td data-title="Total Sum"   class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['residual'],2); ?></td> 
                    
     <td data-title="Total Sum"  class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['direct'],2); ?></td>
   
          
                    <td data-title="Total Sum"  class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['level'],2); ?></td>
                       <td data-title="Total Sum" style="display:none;" class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['quick'],2); ?></td>
                 
                       <td data-title="Total Sum" style="display:none;" class="shrink" ><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['bonus'],2); ?></td>
                 
                    
                     
                      
                         <td data-title="Total Sum"> <?php echo CURRENCY; ?><?php echo number_format($AR_DT['total_income']+$Boardincome,2); ?></td>
                         <td  data-title="Total Sum"><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['admin_charge'],2); ?></td>
                       
                          <!--<td data-title="Total Sum"><?php echo CURRENCY; ?> <?php echo number_format($AR_DT['net_income'],2); ?></td>-->
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
        $("#form-valid").validationEngine();
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        
    });
</script>