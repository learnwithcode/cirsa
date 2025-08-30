<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
$QR_PAGES="SELECT * FROM `tbl_coin_rate` ORDER BY `id` DESC";
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
                           <h4 class="card-title"> Setting <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Dizi Coin Price </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                            <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                      <th width="55" class="center"> <label class="pos-rel"> # <span class="lbl"></span> </label>
                      </th>
                            <th  >Old Price </th>
                            <th >New Price</th>
                            <th  >Added Date Time </th>
                            
                    </tr>
                  </thead>
				 
                  <tbody>
                    <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl= $PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
                    <tr>
                      <td class="center"><label class="pos-rel"> <?php echo$Ctrl; ?> <span class="lbl"></span> </label>
                      </td>
                      <td><?php echo $AR_DT['old_rate']; ?> </td>
                      <td><a href="#"><?php echo $AR_DT['new_rate']; ?></a></td> 
                      <td><?php echo date('d-F-Y h:i:s A',strtotime($AR_DT['added_date_time'])); ?></td>
                    </tr>
                    <?php $Ctrl++; endforeach; } ?>
                    
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