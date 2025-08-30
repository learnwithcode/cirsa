<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$cryptoname='tusdusdt';
// echo $cryptonameprice = $model->getlivecryptoprice($cryptoname);
      
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}


   $trns_status  ='C';
    $StrWhr .=" AND tft.trns_status='".$trns_status."'";


   $QR_PAGES="SELECT tft.*, tm.first_name, tm.stacking_days, tm.last_name, tm.user_id , tm.user_name  
       FROM tbl_fund_transfer AS tft 
       LEFT JOIN tbl_members AS tm ON tft.to_member_id=tm.member_id 
       
       WHERE  tft.trns_for LIKE 'MININGWITHDRAW'
       $StrWhr ORDER BY tft.transfer_id DESC";
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
                           <h4 class="card-title"> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp;  Staking Reports </small>  </h4>
                        </div>
                          <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                       <a  style="color:white;"  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold" data-toggle="modal" data-target="#exampleModalLong " ><span><i class="fa fa-search "></i> <span >Search</span></span></a>
                 
                    
                     </div>
                </div>
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                   
               
                                    <div class="table-responsive">

                            <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                       <tr>
                            <th>S.No.</th>
                            <th> Date</th>
                        <th>User Id </th>
                        <th>User Name </th>
                       
                       
                                   <th >Staking USDT</th> 
                                    <th >Staking Days</th> 
                            <!--<th>Action</th>-->
                        </tr>

                            
</thead>
   <tbody>  <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									    
								//	 PrintR($AR_DT);   
									    
							    ?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $i;$i++;?></td>
                                      
                                         <td><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                                            <td><?php echo $AR_DT['user_id']; ?></td>
                                   
                                     <td class="sorting_1"><?php echo $AR_DT['first_name']; ?></td>
                                      <td class="sorting_1"><?php echo CURRENCY; ?> <?php echo $AR_DT['stacking']; ?></td>
                                        <td class="sorting_1"><?php echo $AR_DT['stacking_days']; ?></td>
                                      
                               
                               
                                    </tr>
                                    
                                    <?php $Ctrl++; endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="4" align="center">No transaction found</td>
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
         <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrll=1;
									
									foreach($PageVal['ResultSet'] as $AR_DT):
									  $member_id=   $AR_DT['member_id'];
								//	 PrintR($AR_DT);   
									    
							    ?>
	  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                              <div class="modal-dialog " role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLongTitle">Search </h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                   
                                         <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","airdroprequest","");  ?>" autocomplete="off" method="get">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-12 control-label  no-padding-right" for="form-field-1-1"> Name / Email Address  :</label>
              <div class="col-sm-12">
                <input id="form-field-17" placeholder="Name / Email" name="fullname"  class="form-control col-xs-12 col-sm-12  " type="text" value="<?php echo $_GET['fullname']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> User Id  :</label>
              <div class="col-sm-12">
                <input id="form-field-16" placeholder="User Id" name="user_id"  class=" form-control col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['user_id']; ?>">
              </div>
            </div>
            
            
                        <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> Mobile No  :</label>
              <div class="col-sm-12">
                <input id="form-field-15" placeholder="Mobile No" name="member_mobile"  class="form-control col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['member_mobile']; ?>">
              </div>
            </div>
            
          
            <div class="form-group">
              <label class="col-sm-12 control-label no-padding-right" for="form-field-1-1"> Status   :</label>
              <div class="col-sm-12">
                <input type="radio" name="status" id="status" <?php if($_GET['status']=="Y"){ echo 'checked="checked"'; } ?>  value="Y">
                Success &nbsp;&nbsp;
                <input type="radio" name="status" id="status" value="N" <?php if($_GET['status']=="N"){ echo 'checked="checked"'; } ?> >
                Pending </div>
            </div>
            
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
            <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
          </div>
        </form>
                                    
                                 </div>
                              </div>
                           </div>
						    
							    
  <div class="modal fade" id="airdrop<?php echo $Ctrll;?>" tabindex="-1" role="dialog" aria-labelledby="airdrop" aria-hidden="true">
                              <div class="modal-dialog " role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                   
                                         <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","sendairdrop","");  ?>/<?php echo $member_id; ?>" autocomplete="off" method="post">
          <div class="modal-body">
          
            
                  <div class="table-responsive">

                            <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                       <tr>
                           
                              
                            <th>UserId</th>
                           
                              <th>Date</th>
                            <!--<th>Type</th>-->
                           
                            
                           
                            <th>Telegram ID</th>
                           <th>Whatsapp No</th>
                             <th>Instagram ID</th>
                        </tr>

                            
</thead>
   <tbody>  
                                    <tr class="odd" role="row">
                                      
                                         <td><?php echo $AR_DT['user_id']; ?></td>
                                   
                                         <td><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                                    
                                      <td class="sorting_1"><?php echo $AR_DT['telegramuserid']; ?></td>
                                        <td class="sorting_1"><?php echo $AR_DT['Whatsppno']; ?></td>
                                         <td class="sorting_1"><?php echo $AR_DT['copyinstagram']; ?></td>
                                    </tr>
                                    
                                   
            </tbody>
            
            </table>
              
                                    </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="ace-icon fa fa-check"></i> Submit </button>
           
          </div>
        </form>
                                    
                                 </div>
                              </div>
                           </div>
                           
                            <?php $Ctrll++; endforeach; 
									}
									?>
									
         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
         <script>
                           function copyhashno()
        {
            var link = $("#copyhashno").val();
            var tempInput = document.createElement("input");
            tempInput.style = "position: absolute; left: -1000px; top: -1000px";
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            console.log("Copied the text:", tempInput.value);
            alert('Hash No Copied', 'success');
            document.body.removeChild(tempInput);
        }
         </script>
         
         
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