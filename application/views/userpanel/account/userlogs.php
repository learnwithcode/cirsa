<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	
	
	$QR_PAGES="SELECT tml.* FROM ".prefix."tbl_mem_logs AS tml WHERE tml.login_id>0 AND  tml.member_id='".$member_id."'  ORDER BY tml.login_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datetimepicker.min.css" />
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
<div class="clearfix"> </div>
<div class="page-container">
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
  <div class="page-content-wrapper">
    <div class="page-content">
      <ul class="page-breadcrumb breadcrumb">
			<li><a href="javascript:void(0)">My Account</a><i class="fa fa-circle"></i></li>
			<li><span class="active">Logs</span></li>
		</ul>
      <div class="row">
        <div class="col-md-12">
		<?php echo get_message(); ?>
          <div class="portlet light bordered">
            <div class="panel-body"> 
            <div class="main pagesize">
              <!-- *** mainpage layout *** -->
              <div class="main-wrap">
                <div class="content-box">
                  <div class="box-body">
                    <div class="box-wrap clear">
                      
                      <br>
                      <h2>Login History:</h2>
                      <br>
                      <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="">
                        
                        <div class="row">
                          <div class="col-sm-12">
                            <table aria-describedby="wallet_deposit_info" role="grid" id="wallet_deposit" class="table table-striped table-bordered table-hover dataTable no-footer">
                              <thead>
                                <tr role="row">
                                  <th   style="width: 255px;" colspan="1" rowspan="1" >Date</th>
                                  <th  style="width: 180px;" colspan="1" rowspan="1" >User Name</th>
                                  <th  style="width: 526px;" colspan="1" rowspan="1"  tabindex="0">Operating System </th>
                                  <th  style="width: 526px;" rowspan="1"  tabindex="0">Browser</th>
                                  <th  style="width: 526px;" rowspan="1"  tabindex="0">Login IP </th>
                                  <th  style="width: 526px;" rowspan="1"  tabindex="0">Status</th>
                                </tr>
                              </thead>
                              <tbody>
								<?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                <tr class="odd" role="row">
                                  <td class="sorting_1"><?php echo getDateFormat($AR_DT['login_time'],"d M Y h:i"); ?></td>
                                  <td><?php echo $AR_DT['user_name']; ?></td>
                                  <td><?php echo $AR_DT['operate_system']; ?></td>
                                  <td><?php echo $AR_DT['browser']; ?></td>
                                  <td><?php echo $AR_DT['member_ip']; ?></td>
                                  <td><?php echo DisplayText("LOG_".$AR_DT['log_sts']); ?></td>
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
  </div>
</div>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
</body>
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
