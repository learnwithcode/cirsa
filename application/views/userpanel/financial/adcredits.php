<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();	
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

	$member_id = $this->session->userdata('mem_id');
	$AR_AD = $model->getAvailableAds($member_id);
	
	
	$StrWhr .=" AND tar.member_id='".$member_id."'";
	$QR_PAGES="SELECT tar.* FROM tbl_ad_request AS tar WHERE 1 $StrWhr ORDER BY tar.request_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
<div class="clearfix"> </div>
<div class="page-container">
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
  <div class="page-content-wrapper">
    <div class="page-content">
     	<ul class="page-breadcrumb breadcrumb">
			<li><a href="javascript:void(0)">Financial</a><i class="fa fa-circle"></i></li>
			<li><span class="active">Buy Ads Credits</span></li>
		</ul>
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
					  	 <h2>Buy Ads Credits  </h2>
                        <br>
						<p>Available Ad Credits:  &nbsp;<strong><?php echo $AR_AD['ad_credit_bal']; ?></strong></p>
						
                        <form name="form-page" id="form-page" method="post" onSubmit="return confirm('Make sure , you want to buy ads?')" action="<?php echo generateMemberForm("financial","adcredits",""); ?>">
                          <p>Purchase Ad Credits : </p>
                          <select class="form-control form-half validate[required]" name="ad_id" id="checkAdsBalance">
						  		<option value="">---select ads----</option>
                            	<?php echo  DisplayCombo($ad_id,"AD_CREDIT"); ?>
                          </select>
                          <br>
                         <button  class="btn btn-sm btn-primary m-t-n-xs"  name="submitAdsForm" id="submitAdsForm" value="1" type="submit">Pay</button>
                        </form>
                        <br>
                        <p>Ads Transaction</p>
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="ad_credits_wrapper">
                          
                          <div class="row">
                            <div class="col-sm-12">
                              <table aria-describedby="ad_credits_info" role="grid" id="ad_credits" class="table table-striped table-bordered table-hover dataTable no-footer">
                                <thead>
                                  <tr role="row">
                                    <th style="width: 65px;" colspan="1" rowspan="1"  tabindex="0" class="">#</th>
                                    <th  style="width: 168px;" colspan="1" rowspan="1"  tabindex="0" class="">Ads</th>
                                    <th  style="width: 436px;" rowspan="1"  tabindex="0" class="">Amount</th>
                                    <th  style="width: 436px;" colspan="1" rowspan="1"  tabindex="0" class="">Status</th>
                                    <th  style="width: 253px;" colspan="1" rowspan="1" tabindex="0" class="">Date</th>
                                  </tr>
                                </thead>
                                <tbody>
								<?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                  <tr class="odd" role="row">
                                    <td class="sorting_1"><?php echo $AR_DT['request_id']; ?></td>
                                    <td><?php echo $AR_DT['no_of_ads']; ?></td>
                                    <td><?php echo btc_val($AR_DT['ads_price']); ?>&nbsp;<?php echo CURRENCY; ?></td>
                                    <td><?php echo DisplayText("ADVERT_".$AR_DT['ads_status']); ?></td>
                                    <td><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                  </tr>
                                 <?php endforeach;
								}
								 ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
</body>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
		$("#checkAdsBalance").on('change',function(){
			var ad_id = $("#checkAdsBalance").val();
			var URL_LOAD = "<?php echo BASE_PATH; ?>json/jsonhandler?switch_type=CHECK_BALANCE&ad_id="+ad_id;
		});
	});
</script>
</html>
