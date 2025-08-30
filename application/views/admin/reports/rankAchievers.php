<?php defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$model = new OperationModel();
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcd.cmsn_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	
	$QR_PAGES= "SELECT * from tbl_eligibility  where 1    ";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
	// 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title><?php echo title_name(); ?></title>
<meta name="description" content="Static &amp; Dynamic Tables" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datetimepicker.min.css" />
<!-- page specific plugin styles -->
<!-- text fonts -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/fonts.googleapis.com.css" />
<!-- ace styles -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-skins.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-rtl.min.css" />
<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
<!-- inline styles related to this page -->
<!-- ace settings handler -->
<script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-extra.min.js"></script>
<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
<script type="text/javascript">
	$(function(){
		$(".open_modal").on('click',function(){
			$('#search-modal').modal('show');
			return false;
		});
	});
</script>
</head>
<body class="skin-2">
<?php $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
<div class="main-content">
  <div class="main-content-inner">
    <?php $this->load->view(ADMIN_FOLDER.'/layout/breadcumb'); ?>
    <div class="page-content">
     
      <div class="row">
        <?php get_message(); ?>
        <div class="col-xs-12">
          <div class="row">
            <div class="col-xs-12">
          <div class="page-header">
        <h1> Bonus <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp;Rank Achievers   </small> </h1>
      </div> </div></div>
<div class="widget-body">
                <div class="panel-body list">
                  <div class="table-responsive project-list">
                    <table class="table table-striped">
               <thead>
                    <tr role="row">
                      <th  class="sorting">Sr. No </th>                      
                    
                      <th  class="sorting">Rank Name   </th>
                      <th  class="sorting">Condition  </th>
                      <!--<th  class="sorting">Month BV   </th>-->
                      <!--<th  class="sorting">Weekly Amount   </th>-->
                      <th  class="sorting">Total Achiver</th>
					  <th  class="sorting">Action </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
						if($PageVal['TotalRecords'] > 0){
						  
						    
						$Ctrl=$PageVal['RecordStart']+1;
							foreach($PageVal['ResultSet'] as $AR_DT):
							    
							    $total = $model->getTotalRankAchievers($AR_DT['rank_id']);
						?>
                    <tr class="odd" role="row">
                      <td data-title="Sr. No"><?php echo $Ctrl; ?></td>
                    
                     
                      <td data-title="Rank Name"> <span class="label label-success arrowed">  <?php echo $AR_DT['eligibility'];?></span> </td>
                      <td data-title="Total Achiver"><?php echo strtoupper($AR_DT['criteria']); ?></td>
                       <!--<td data-title="Total Achiver"><?php echo strtoupper($AR_DT['target']); ?></td>-->
                       <!--<td data-title="Total Achiver"><?php echo strtoupper($AR_DT['amount']); ?></td>-->
					  <td data-title="Total Achiver"><?php echo  ($total >0 )?$total:0 ?></td>
                     
                     
                      <td data-title="View"><?php if($total > 0) { ?><a target="_blank" href="<?php echo generateSeoUrlAdmin("bonus","rankAchieversList",""); ?>?rankId=<?php echo _e($AR_DT['rank_id']); ?>">View</a><?php } else { ?> <a href="javascript:void(0);" onClick="alert('There is no Rank Achiver`s!');">View</a><?php } ?></td>
					   
                    </tr>
                    <?php $Ctrl++; endforeach;
						}
						 ?>
                  </tbody>
                    </table>
                  </div>
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
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.page-content -->
  
 
<?php $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?></div></div>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a>
</div>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<?php jquery_validation();  auto_complete();  ?>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		
	});
</script>
<script type="text/javascript" language="javascript">
new Autocomplete("user_id", function(){
	this.setValue = function( id ) {document.getElementsByName("member_id")[0].value = id;}
	if(this.isModified) this.setValue("");
	if(this.value.length < 1 && this.isNotClick ) return;
	return "<?php echo ADMIN_PATH; ?>autocomplete/listing?srch=" + this.value+"&switch_type=MEMBER";
});
</script>
</body>
</html>
