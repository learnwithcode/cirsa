<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $model = new OperationModel();
     $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
    $segment = $this->uri->uri_to_assoc(2);
    $level = $_GET['level'];
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
        if($_GET['level'] !='')
    {
        $level = $_GET['level'];
        $StrWhr .="  AND tcd.level='$level'";
        
    }
    $QR_PAGES="SELECT tcd.*, tm.user_id , CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name    FROM ".prefix."tbl_cmsn_level AS tcd 
               LEFT JOIN tbl_members AS tm ON tcd.member_id=tm.member_id
              
               WHERE 1   $StrWhr group BY tcd.id DESC";
    $PageVal = DisplayPages($QR_PAGES, 200, $Page, $SrchQ); 
    
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
                           <h4 class="card-title"> Reports <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Level Income List </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                   <table class="table table-striped">
 <thead>
                      <tr>
                          <th>Sn.</th>
                          <th>Date</th><th>level</th>
                          <th>From Member Id </th>
                          <th>Returns %</th>
                         <!-- <th>Admin Charge</th>
                          <th>TDS</th>
                          <th>Repurchase Detection</th>-->
                          <th>Net Income</th>
                        </tr>
                    </thead>
                           
                                  <tbody>
                                   <?php 
                                if($PageVal['TotalRecords'] > 0){
                                $Ctrl=$PageVal['RecordStart']+1;
                            //  echo "<pre>";print_r($PageVal['ResultSet']);die;
                                    foreach($PageVal['ResultSet'] as $AR_DT):
                                            $net_income_sum +=$AR_DT['net_income'];
                                ?>
                                <tr class="odd" role="row">
                                    <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                                      <td class=""><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                         <td><span class="label label-success arrowed">Level - <?php echo $AR_DT['level']; ?></span> </td>
                                      <td><?php echo $AR_DT['user_id']; ?></td>
                                      <td><?php echo number_format($AR_DT['returns'],2); ?></td>
                                      <!--<td><?php echo number_format($AR_DT['admin_charge'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['tds'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['repurchase_detection'],2); ?></td>-->
                                      <td><?php echo number_format($AR_DT['net_income'],2); ?></td>
                                  </tr>
                             
                        
                                    
                                    <?php endforeach; ?>
                                    
                                      <tr class="odd" role="row">
                      <td class="sorting_1">&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    
                      <td><strong>Sum Total </strong></td>
                      <td><strong><?php echo number_format($net_income_sum,2); ?></strong></td>
                    </tr> 
                                    <?php }else{
                                    ?>
                                    <tr class="odd" role="row">
                                        <td colspan="5" align="center">No transaction found</td>
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