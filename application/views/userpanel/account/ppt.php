<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	
	if($_REQUEST['ppt_lang']!=''){
		$ppt_lang = FCrtRplc($_REQUEST['ppt_lang']);
		$StrWhr .=" AND ppt_lang LIKE '%$ppt_lang%'";
		$SrchQ .="&ppt_lang=$ppt_lang";
	}
	
	$QR_PAGES="SELECT tp.*, tc.country_name 
			FROM ".prefix."tbl_ppt AS tp  
		   LEFT JOIN ".prefix."tbl_country AS tc on tp.ppt_country=tc.country_iso
		   WHERE tp.ppt_delete>0 AND tp.ppt_status>0 $StrWhr ORDER BY tp.ppt_country ASC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>flags/flags.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>flags/flags.min.css" />
<style type="text/css">
	span.title {
		display: block;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
		font-weight: 600;
		font-size: 12px;
		color: #fff;
		letter-spacing: 12px;
		padding-left: 10px;
	}
	.minheight{
		min-height:1200px;
	}
</style>
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
            <li class="active"> CoinxTrading Presentaion</li>
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
                          <h2>CoinxTrading Presentaion</h2>
                          <br>
                          <div class="actions">
						  	<div class="row">
							 <div class="col-md-12">
							   <form id="form-search" name="form-search" method="get" action="<?php echo generateMemberForm("account","ppt",""); ?>">
								<div class="form-group">
									<div class="col-md-4">
									<select name="ppt_country" id="ppt_country" class="form-control">
										<option value="">----select country-----</option>
										<?php echo DisplayCombo($_REQUEST['ppt_country'],"COUNTRY_PPT"); ?>
									</select>
									</div>
									<div class="col-md-4">
										<select name="ppt_lang" id="ppt_lang" class="form-control">
										<option value="">----select language-----</option>
										<?php echo DisplayCombo($_REQUEST['ppt_lang'],"LANG_PPT"); ?>
									</select>
									</div>
									<div class="col-md-2">
									<input class="btn btn-sm btn-primary m-t-n-xs" value=" Search " type="submit">
									</div>
								</div>
	
							</form>
							  </div>
							</div>
                          </div>
                          <br>
                          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="wallet_deposit_wrapper">
                            <div class="row">
							 
                              <div class="col-md-12">
                                <table aria-describedby="wallet_deposit_info" role="grid" id="wallet_deposit" class="table table-striped table-bordered table-hover dataTable no-footer">
                                  <thead>
                                    <tr role="row">
                                      <th  class="">Srl No</th>
                                      <th  class="">Presenation Type </th>
                                      <th  class="">Country</th>
                                      <th  class="">Language</th>
                                      <th  class="">Download</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=$PageVal['RecordStart']+1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									$ppt_file_src = $model->getPptFile($AR_DT['ppt_id']);
								?>
                                    <tr>
                                      <td class=""><?php echo $Ctrl; ?></td>
                                      <td class=""><?php echo $AR_DT['ppt_name']; ?></td>
                                      <td class=""><span class="flag flag-<?php echo strtolower($AR_DT['ppt_country']); ?>"></span> &nbsp;<?php echo $AR_DT['country_name']; ?></td>
                                      <td class=""><?php echo $AR_DT['ppt_lang']; ?></td>
                                      <td class=""><a target="_blank" href="<?php echo $ppt_file_src; ?>"><i class="fa fa-download"></i></a></td>
                                    </tr>
                                    
                                    <?php $ctrl++; endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="5">No presenation  found</td>
									</tr>
								<?php 
									}
								 ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="row">
                              
                              <div class="col-xs-12">
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
		$("#form-search").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
</html>
