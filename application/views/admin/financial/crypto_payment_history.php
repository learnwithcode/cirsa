<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}

if($_GET['user_id']!=''){
	$user_id = FCrtRplc($_GET['user_id']);
	$StrWhr .=" AND ( tmt.user_id = '$user_id' )";
	$SrchQ .="&user_id=$user_id";
}
if($_GET['trns_coin']!=''){
	$trns_coin = FCrtRplc($_GET['trns_coin']);
	$StrWhr .=" AND ( tft.coin = '$trns_coin' )";
	$SrchQ .="&trns_coin=$trns_coin";
}

if($_GET['trns_status']!=''){
	$trns_status = FCrtRplc($_GET['trns_status']);
	$StrWhr .=" AND ( tft.status = '$trns_status' )";
	$SrchQ .="&trns_status=$trns_status";
}
   $QR_PAGES= "SELECT tft.*,tmt.first_name AS first_name, tmt.last_name AS last_name,tmt.midle_name as midle_name, tmt.user_id  AS user_id
			 FROM ".prefix."tbl_cryptofund AS tft 
			
			 LEFT JOIN tbl_members AS tmt ON tmt.member_id=tft.member_id	
			 WHERE  1  $StrWhr  ORDER BY tft.id DESC ";
$PageVal = DisplayPages($QR_PAGES,50,$Page,$SrchQ);

// PrintR($PageVal);die;
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
                           <h4 class="card-title"> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp;  Crypto Deposit History </small>  </h4>
                        </div>
                          <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group">
                    <a  href="<?php echo generateSeoUrlAdmin("excel","cryptopaymenthistory",""); ?>"  aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                    
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
                            <th>UserId</th>
                            <th>Txn Id</th>
                              <th>Date</th>
                           <th>Type</th>
                           
                            
                           
                            <th>USDT</th>
                         
                            <!--<th>Status</th>-->
                            <th>Hash_ID</th>        
                          
                            <th>Status</th>
                           <th>Pay Gasfee</th>
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
                                         <td><?php echo $AR_DT['user_id']; ?></td>
                                        <td><?php echo $AR_DT['txn_id']; ?></td>
                                         <td><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                                    
                                      <td class="sorting_1"><?php echo $AR_DT['symbol']; ?></td>
                                       <td class="sorting_1"> <?php echo CURRENCY;?> <?php echo number_format($AR_DT['amount'],2); ?></td>
                                     
                                      <td>
                                          
                                       <?php if($AR_DT['hash_no']==''){ ?>
                                     
                                      <span class="btn btn-warning arrowed-in arrowed-in-right" style="color: black;">Owner Transer Waiting</span>
                                      <?php }else{ ?>
                                      
                                       <span class=" arrowed-in arrowed-in-right" style="color: black;">
                                           
                                           <input id="copyhashno" type="hidden" class="form-control" style="cursor: no-drop; width: 100%" readonly value="<?php echo $AR_DT['hash_no']; ?>">
                                      
                                           			<span class="value fs-16 " style="font-size: 9px;"><span class="text-black pe-2 " ></span><?php echo $AR_DT['hash_no']; ?> <span> <a id="copyTargetL" onclick="copyhashno()" href="javascript:;"  class="  btn-social-icon mr-1 ">
                                    
                                    <i class="zoom   fa fa-copy mr-3 rtl-mr-0 rtl-ml-3" style="font-size: 25px !important;color: blue;display:none;"></i>
                      </a></span></span>
                                           
                                           
                                           
                                           
                                          </span>
                                      
                                      <?php } ?>   
                                          
                                         </td>
                                     
                                      <td>
                                         <?php if($AR_DT['gasfee']==0){ ?>
                                     
                                      <span class="arrowed-in arrowed-in-right" style="color: black;" >Pending</span>
                                      <?php }else{ ?>
                                      
                                       <span class="arrowed-in arrowed-in-right" style="color: black;" >Deposit Success</span>
                                      
                                      <?php } ?>
                               
                                    
                                      </td>
                                     
                                    <td><a href="#"   data-toggle="modal" data-target="#paygasfee<?php echo $Ctrl;?>">Click Here</a></td>
                                    </tr>
                                    
                                    <?php $Ctrl++; endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="11" align="center">No transaction found</td>
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
									    
								// PrintR($AR_DT);   
									    
							    ?>
  <div class="modal fade" id="paygasfee<?php echo $Ctrll;?>" tabindex="-1" role="dialog" aria-labelledby="paygasfee" aria-hidden="true">
                              <div class="modal-dialog " role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                   
                                         <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","verifygasfee","");  ?>/<?php echo $AR_DT['toaddress']; ?>/<?php echo $AR_DT['symbol']; ?>/<?php echo $AR_DT['txn_id']; ?>" autocomplete="off" method="post">
          <div class="modal-body">
           <h5 class="modal-title" id="exampleModalLongTitle" style="color:red;">Pay Gas Fee If You Not This User ID Fund </h5>
            
                  <div class="table-responsive">

                            <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                       <tr>
                           
                            <th>UserId</th>
                              <th>Date</th>
                                <th>Amount</th>
                           <th>Pay Gasfee</th>
                            <!--<th>Action</th>-->
                        </tr>

                            
</thead>
   <tbody>  
                                    <tr class="odd" role="row">
                                      
                                         <td><?php echo $AR_DT['user_id']; ?></td>
                                         <td><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                                    
                                    
                                       <td class="sorting_1"> <?php echo CURRENCY;?> <?php echo number_format($AR_DT['amount'],2); ?></td>
                                     
                                    
                                     
                                    <td><?php echo $AR_DT['toaddress'];?></td>
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