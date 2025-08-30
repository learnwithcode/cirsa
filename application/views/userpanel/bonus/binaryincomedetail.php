<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$segment = $this->uri->uri_to_assoc(2);
	
	$member_id = $this->session->userdata('mem_id');
	$process_id = _d($segment['process_id']);
	
	$AR_PRES = $model->getProcess($process_id);
	$start_date = InsertDate($AR_PRES['start_date']);
	$end_date = InsertDate($AR_PRES['end_date']);
	
	
	$QR_COL_L = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='L';";
	$AR_COL_L = $this->SqlModel->runQuery($QR_COL_L,true);
	$nleft_L = $AR_COL_L["nleft"];
	$nright_L = $AR_COL_L["nright"];
	

	$QR_LEFT = "SELECT ts.*, tm.user_id, tm.date_join, tpt.pin_name
		  FROM ".prefix."tbl_subscription AS ts
		  LEFT JOIN ".prefix."tbl_members AS tm ON  tm.member_id=ts.member_id
		  LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tree.member_id=tm.member_id
		  LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=ts.type_id
		  WHERE ts.subcription_id =(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
		  AND tree.nleft BETWEEN '".$nleft_L."'  AND '".$nright_L."'  AND 
		  DATE(ts.date_from) BETWEEN '".$start_date."' AND '".$end_date."'
		  AND tm.delete_sts>0";
	$RS_LEFT = $this->SqlModel->runQuery($QR_LEFT);
	
	
	
	$QR_COL_R = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='R';";
	$AR_COL_R = $this->SqlModel->runQuery($QR_COL_R,true);
	$nleft_R = $AR_COL_R["nleft"];
	$nright_R = $AR_COL_R["nright"];
	
	$QR_RIGHT = "SELECT ts.*, tm.user_id, tm.date_join, tpt.pin_name
		  FROM ".prefix."tbl_subscription AS ts
		  LEFT JOIN ".prefix."tbl_members AS tm ON  tm.member_id=ts.member_id
		  LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tree.member_id=tm.member_id
		  LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=ts.type_id
		  WHERE ts.subcription_id =(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
		  AND tree.nleft BETWEEN '".$nleft_R."'  AND '".$nright_R."'  AND 
		  DATE(ts.date_from) BETWEEN '".$start_date."' AND '".$end_date."'
		  AND tm.delete_sts>0";
	$RS_RIGHT = $this->SqlModel->runQuery($QR_RIGHT);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
</head>
<body>
<div class="site-holder">
  <!-- .navbar -->
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
  <!-- /.navbar -->
  <div class="box-holder">
    <!-- .left-sidebar -->
    <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    <!-- /.left-sidebar -->
    <!-- .content -->
    <div class="content">
      <div class="row">
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>"> Home </a></li>
            <li class="active"> Binary Income Detail</li>
          </ul>
        </div>
      </div>
      <div class="price-list row">
        <!-- Accordians -->
        <div class="row">
          <div class="col-md-12"> <?php echo get_message(); ?>
            <div class="portlet light bordered">
              <div class="panel-body">
                <div class="main pagesize">
                  <!-- *** mainpage layout *** -->
                  <div class="main-wrap">
                    <div class="content-box">
                      <div class="box-body">
                        <div class="box-wrap clear">
                          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="wallet_deposit_wrapper">
                            <div class="row">
                              <div class="col-sm-12">
                                <table width="100%" border="0" cellpadding="5" cellspacing="0" class="table">
                                  
                                  <tr class="">
                                    <td width="35%" align="center"><strong>Left Member</strong></td>
                                    <td width="35%" align="center"><strong>Right Member  </strong></td>
                                  </tr>
                                  
                                  <tr>
                                    <td height="82" align="center" valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="4" style="border-collapse:collapse">
                                        <tr class="lightbg">
                                          <td align="center" class="cmntext" scope="col"><strong>Srl # </strong></td>
                                          <td align="center" class="cmntext" scope="col"><strong>Member     Id</strong></td>
                                          <td align="center" class="cmntext" scope="col"><strong>Date Activated </strong></td>
                                          <td align="center" class="cmntext" scope="col"><strong>Plan</strong></td>
                                          <td align="right" class="cmntext" scope="col"><strong>Amount</strong></td>
                                        </tr>
										<?php
										$i = 1;
										foreach($RS_LEFT as $AR_LEFT):
										$left_total_collection +=$AR_LEFT['net_amount'];
										?>
                                        <tr>
                                          <td width="8%" align="center" class="cmntext" scope="col"><?php echo $i;?></td>
                                          <td width="19%" align="center" class="" scope="col"><?php echo $AR_LEFT['user_id']; ?></td>
                                          <td width="18%" scope="col" class="cmntext" align="center"><?php echo DisplayDate($AR_LEFT['date_from']);?></td>
                                          <td width="35%" scope="col" class="cmntext" align="center"><?php echo $AR_LEFT['pin_name']; ?></td>
                                          <td width="20%" scope="col" class="cmntext" align="right"><?php echo number_format($AR_LEFT['net_amount'],2); ?></td>
                                        </tr>
                                        
										<?php $i++;
										endforeach;
										?>
										<tr>
                                          <td colspan="4" align="right" class="cmntext" scope="col"><strong>Total Left Collection : </strong></td>
                                          <td scope="col" class="cmntext" align="right"><strong><?php echo number_format($left_total_collection,2); ?></strong></td>
                                        </tr>
                                      </table></td>
                                    <td align="center" valign="top"><table width="100%" border="1" cellspacing="0" cellpadding="4" style="border-collapse:collapse;">
                                        <tr class="lightbg">
                                          <td width="8%" align="center" class="cmntext" scope="col"><strong>Srl # </strong></td>
                                          <td width="21%" align="center" class="cmntext" scope="col"><strong>Member     Id </strong></td>
                                          <td width="20%" align="center" class="cmntext" scope="col"><strong>Date Activated </strong></td>
                                          <td width="33%" align="center" class="cmntext" scope="col"><strong>Plan</strong></td>
                                          <td width="18%" align="right" class="cmntext" scope="col"><strong>Amount</strong></td>
                                        </tr>
											<?php
										$j = 1;
										foreach($RS_RIGHT as $AR_RIGHT):
										$right_total_collection +=$AR_RIGHT['net_amount'];
										?>
                                        <tr>
                                          <td align="center" class="cmntext" scope="col"><?php echo $j;?></td>
                                          <td align="center" class="" scope="col"><?php echo $AR_RIGHT['user_id']; ?></td>
                                          <td scope="col" class="cmntext" align="center"><?php echo DisplayDate($AR_RIGHT['date_from']);?></td>
                                          <td scope="col" class="cmntext" align="center"><?php echo $AR_RIGHT['pin_name']; ?></td>
                                          <td scope="col" class="cmntext" align="right"><?php echo number_format($AR_RIGHT['net_amount'],2); ?></td>
                                        </tr>
                                       
										<?php $j++;
										endforeach; ?>
									    <tr>
                                          <td colspan="4" align="right" class="cmntext" scope="col"><strong>Total Right Collection : </strong></td>
                                          <td scope="col" class="cmntext" align="right"><strong><?php echo number_format($right_total_collection,2); ?></strong></td>
                                        </tr>
                                      </table></td>
                                  </tr>
								   <tr class="">
                                    <td colspan="2" align="center"><a href="javascript:void(0)" onclick="window.history.back()"><i class="fa fa-arrow-left"></i> Back</a></td>
                                  </tr>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- end of box-wrap -->
                    </div>
                    <!-- end of box-body -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
      <!-- /.content -->
    </div>
  </div>
</div>
</body>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
</html>
