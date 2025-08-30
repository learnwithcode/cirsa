<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

if($_REQUEST['news_title']!=''){
	$news_title = FCrtRplc($_REQUEST['news_title']);
	$StrWhr .=" AND ( tn.news_title LIKE '%$news_title%' OR  tn.news_detail LIKE '%$news_title%' )";
	$SrchQ .="&news_title=$news_title";
}

$QR_PAGES="SELECT tn.* FROM ".prefix."tbl_zoomeeting  AS tn   WHERE isDelete>0 $StrWhr ORDER BY tn.news_id DESC";
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
                        <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Updates <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp;  Zoomeeting </small>  </h4>
                        </div>
                        <div class="clearfix">
             <div class="pull-right tableTools-container">
                    <div class="dt-buttons btn-overlap btn-group">
                         <a href="<?php echo generateSeoUrlAdmin("operative","zoomeetings",""); ?>" title="" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold"><span><i class="fa fa-plus bigger-110 blue"></i> <span class="hidden">Add</span></span></a> 
                       
                     
                     
                      </div>
                  </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                 <div class="row">
         
        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                    
                        <th width="103" align="center" >Zoom Title</th>
                        <th width="103" align="center">Events  Name</th>
                        <th width="103" align="center">Events Date</th>
                        <th width="103" align="center">Start Time</th>
                        <th width="103" align="center">End Time</th>
                         <th width="90" align="center">URL/ links</th>
                          <th width="90" align="center">Password</th>
                           <th width="71" align="center">Status</th>
                         
                              <th width="71" align="center">Action</th>
                      </tr>
                    </thead>
                    <form method="post" autocomplete="off" action="<?php echo ADMIN_PATH."operative/zoomeetings"; ?>">
                      <tbody>
                        <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
                        <tr>
                         
                          <td align="left"><a href="javascript:void(0)"><?php echo $AR_DT['zoomtitle']; ?></a> </td>
                          <td align="left" ><?php echo ($AR_DT['events_title']); ?></td>
                          <td align="left" ><?php echo DisplayDate($AR_DT['edate']); ?></td>
                           <td align="left" ><?php echo $newDateTime = date('h:i A', strtotime($AR_DT['starttime'])); ?></td>
                            <td align="left" ><?php echo $newDateTime = date('h:i A', strtotime($AR_DT['endtime'])); ?></td>
                              <td align="left" ><?php echo $AR_DT['links']; ?></td>
                                <td align="left" ><?php echo $AR_DT['password']; ?></td>
                                  <td align="left" ><?php echo $AR_DT['status']; ?></td>
                         
                          <td align="center"><div class="btn-group">
                              <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action </button>
                              <ul class="dropdown-menu dropdown-default">
                                <li> <a href="<?php echo generateSeoUrlAdmin("operative","zoomeetings",array("news_id"=>$AR_DT['news_id'],"action_request"=>"EDIT")); ?>">Edit</a> </li>
                                <li> <a onClick="return confirm('Make sure want to delete this record?')" href="<?php echo generateSeoUrlAdmin("operative","news",array("news_id"=>$AR_DT['news_id'],"action_request"=>"DELETE")); ?>">Delete</a> </li>
                              </ul>
                            </div></td>
                        </tr>
                        <?php $Ctrl++; endforeach; ?>
                        <?php  }else{ ?>
                        <tr>
                          <td colspan="6" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </form>
                  </table>
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
        $("#form-page").validationEngine();
    });
</script>