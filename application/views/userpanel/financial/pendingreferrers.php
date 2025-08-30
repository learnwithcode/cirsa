<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();	
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}

	$member_id = $this->session->userdata('mem_id');
	$StrWhr .=" AND tm.sponsor_id='".$member_id."' AND tm.package_id='1'";
	
	$QR_PAGES="SELECT tm.*, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 WHERE 1 $StrWhr ORDER BY tm.member_id ASC";
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
			<li><span class="active">Referrals</span></li>
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
                        <h2>Pending Referrals </h2>
                        <br>
                        <div class="actions">
                          <div class="row">
                            <div class="col-sm-12">
                              <table aria-describedby="pending_referrers_info" role="grid" id="pending_referrers" class="table table-striped table-bordered table-hover">
                                <thead>
                                  <tr role="row">
                                    <th  style="width: 240px;" colspan="1" rowspan="1"  tabindex="0" class="">Registration Date</th>
                                    <th  style="width: 256px;" colspan="1" rowspan="1"  tabindex="0" class="">Username (ID)</th>
                                    <th  style="width: 141px;" colspan="1" rowspan="1" tabindex="0" class="">Name</th>
                                    <th  style="width: 107px;" colspan="1" rowspan="1"  tabindex="0" class="">Status</th>
                                    <th  style="width: 139px;" colspan="1" rowspan="1"  tabindex="0" class="">City</th>
                                  </tr>
                                </thead>
                                <tbody>
								<?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                  <tr class="odd" role="row">
                                    <td class="sorting_1">&nbsp;<?php echo getDateFormat($AR_DT['date_join'],"d M Y h:i"); ?></td>
                                    <td>&nbsp;<?php echo $AR_DT['user_name']; ?>&nbsp;(<?php echo $AR_DT['user_id']; ?>)</td>
                                    <td>&nbsp;<?php echo $AR_DT['first_name']; ?> <?php echo $AR_DT['last_name']; ?></td>
                                    <td>&nbsp;Unpaid</td>
                                    <td>&nbsp;<?php echo $AR_DT['city_name']; ?></td>
                                  </tr>
								<?php 
									endforeach;
									}
								?>		  
                                </tbody>
                              </table>
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
		
	});
</script>
</html>
