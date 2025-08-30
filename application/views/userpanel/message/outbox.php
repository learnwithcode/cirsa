<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	
	
	$QR_PAGES = "SELECT ts.*
				FROM ".prefix."tbl_message AS ts 
				LEFT JOIN ".prefix."tbl_members AS tm ON tm.member_id=ts.to_member_id
				WHERE ts.from_member_id='".$member_id."' 
				ORDER BY ts.message_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 20, $Page, $SrchQ);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
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
            <li class="active"> Outbox </li>
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
                          <h2>Outbox </h2>
                         
                          <br>
                          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" >
                            <div class="row">
                              <div class="col-sm-12">
                                <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                  <thead>
                                    <tr>
                                      <th>Sr. # </th>
                                      <th>Date</th>
                                      <th>Subject </th>
                                      <th>Message  </th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
	    								if($PageVal['TotalRecords'] > 0){
		     							$Ctrl=$PageVal['RecordStart']+1;
									    foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                    <tr>
                                      <td><?php echo $Ctrl; ?></td>
                                      <td><?php echo DisplayDate($AR_DT['date_time']); ?></td>
                                      <td><?php echo $AR_DT['subject']; ?></td>
                                      <td><?php echo $AR_DT['message']; ?></td>
                                      <td><div class="btn-group">
                          <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>
                          <ul class="dropdown-menu dropdown-default">
						  	
							
							<li> <a href="<?php echo generateSeoUrlMember("message","view",array("message_id"=>_e($AR_DT['message_id']))); ?>">View</a> </li>
							<li> <a onClick="return confirm('Make sure, want to delete this message')" href="<?php echo generateSeoUrlMember("message","inbox",array("action_request"=>"DELETE","message_id"=>_e($AR_DT['message_id']))); ?>">Delete</a> </li>
							
                          </ul>
                        </div></td>
                                    </tr>
                                    <?php 
										$Ctrl++; 
										endforeach; 
									}else{ ?>
                                    <tr>
                                      <td colspan="5" class="text-danger">No message found </td>
                                    </tr>
                                    <?php } ?>
                                  </tbody>
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
