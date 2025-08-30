<?php defined('BASEPATH') OR exit('No direct script access allowed');
    $model = new OperationModel();
    $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
    
    $QR_PAGES= "SELECT * FROM  tbl_property  WHERE 1    ORDER BY id DESC ";
    $PageVal = DisplayPages($QR_PAGES, 10, $Page, $SrchQ);  
    
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
                           <h4 class="card-title"> Property <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp;  List  </small>  </h4>
                        </div>
                       
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

             <table class="table table-striped">
  <thead>
                    <tr role="row">
					<th  class="sorting">S. No</th>
                      <th  class="sorting">Name</th>
                      <th  class="sorting">address</th>
                      <!--<th  class="sorting">bed</th>-->
                      <!--<th  class="sorting">bath</th>-->
                      <!--<th  class="sorting">size</th>-->
                      <!--<th  class="sorting">size_type</th>-->
                      <!--<th  class="sorting">flore</th>-->
                      <th  class="sorting">property_type</th>
                      <!--<th  class="sorting">property_location_zipcode</th>-->
                      <!--<th  class="sorting">property_location_city</th>-->
                      <!--<th  class="sorting">property_location_country</th>-->
                      <!--<th  class="sorting">price</th>-->
                      <!--<th  class="sorting">pricetype</th>-->
                      <!--<th  class="sorting">accessibility_features</th>-->
                      <!--<th  class="sorting">accessible_features</th>-->
                      <th  class="sorting">Image</th>
                           <th  class="sorting">Date</th>
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
                      <td data-title="Full Name"><?php echo $AR_DT['name']; ?></td>
                      <td data-title="address" > <?php echo $AR_DT['address']; ?></td>
                      <!--<td data-title="bed" > <?php // echo $AR_DT['bed']; ?></td>-->
                      <!--<td data-title="bath" > <?php // echo $AR_DT['bath']; ?></td>-->
                      <!--<td data-title="size" > <?php // echo $AR_DT['size']; ?></td>-->
                      <!--<td data-title="size_type" > <?php // echo $AR_DT['size_type']; ?></td>-->
                      <!--<td data-title="flore" > <?php // echo $AR_DT['flore']; ?></td>-->
                      <td data-title="property_type" > <?php echo $AR_DT['property_type']; ?></td>
                      <!--<td data-title="property_location_zipcode" > <?php // echo $AR_DT['property_location_zipcode']; ?></td>-->
                      <!--<td data-title="property_location_city" > <?php // echo $AR_DT['property_location_city']; ?></td>-->
                      <!--<td data-title="property_location_country" > <?php // echo $AR_DT['property_location_country']; ?></td>-->
                      <!--<td data-title="price" > <?php // echo $AR_DT['price']; ?></td>-->
                      <!--<td data-title="pricetype" > <?php // echo $AR_DT['pricetype']; ?></td>-->
                      <!--<td data-title="accessibility_features" > <?php //  echo $AR_DT['accessibility_features']; ?></td>-->
                      <!--<td data-title="accessible_features" > <?php // echo $AR_DT['accessible_features']; ?></td>-->
                      <td data-title="Username"><img src="https://stageone.ltd/stagetest/upload/property/<?php echo $AR_DT['image']; ?>" heiht="20" width="20" /> </td>
                        <td data-title="Date"><?php echo getDateFormat($AR_DT['created_at'],"d M Y h:i"); ?></td>
                      <td data-title="Net Income"><a href="<?php echo generateSeoUrlAdmin("Property","edit",""); ?><?php echo "/".$AR_DT['id']; ?>">View</a> <a href="<?php echo generateSeoUrlAdmin("Property","delete",""); ?><?php echo "/".$AR_DT['id']; ?>">Delete</a></td>
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