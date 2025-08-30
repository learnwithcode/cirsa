<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
$model = new OperationModel();
$today_date = getLocalTime();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
  $QR_PAGES= "SELECT R.*,M.first_name as name , M.user_id as uid , O.operator_name as oname FROM `tbl_recharge` as R LEFT JOIN tbl_recharge_optr as O on R.`opr_id` = O.operator_id LEFT JOIN tbl_members as M on M.member_id = R.member_id WHERE  R.recharge_id > 0 AND R.status='FAILED'  order by  R.recharge_id desc";
$PageVal = DisplayPages($QR_PAGES,50,$Page,$SrchQ); 
 
 ?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/header'); ?>
 
</head>
<body class="skin-2">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
  <div class="main-content">
    <div class="main-content-inner"> 
         <?php get_message(); ?>
      
      <div class="page-content">
        <div class="page-header">
          <h1> Transaction  <small> <i class="ace-icon fa fa-angle-double-right"></i> Recharge Failed   </small> </h1>
            <a    href="<?php  echo generateSeoUrlAdmin("transaction","home",''); ?>"  class="pull-right" >	<button type="button" class="btn btn-danger">Back</button></a>
        </div>
        
        
        <div class="space-12"></div>  <div class="space-12"></div>
         <div class="row">
			   
			
			   
			  
			   
	 <div class="col-xs-12">
	     <div class="table-responsive">
 <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                 <thead>
                    <tr>
                        
                   
                            <th  class="center"> Date </th>
                            <th >User ID </th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Operator</th>
                            <th>Type</th>
                            <th >Amount</th>
                            <th >Remark</th>
                            <th >Status</th>  
                            <!--<th >Action</th>-->
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):   //PrintR($AR_DT);die;
			       ?>
                    <tr <?php if($AR_DT['status']=='SUCCESS'){echo 'class="success"';}else{ echo 'class="danger"';}?>>
                      <td data-title="Date"><?php echo Displaydate($AR_DT['date_time']); ?></td>
                      <td data-title="User Id"><?php echo strtoupper($AR_DT['uid']); ?></td>
                      
                      <td data-title="Name"><?php echo strtoupper($AR_DT['name']); ?> </td>
                        <td data-title="Number"><?php echo $AR_DT['number']; ?> </td>
                    <td data-title="Operator"><?php echo $AR_DT['oname']; ?> </td>
                     <td data-title="Type"><?php echo strtoupper($AR_DT['type']); ?></td>
                       <td data-title="Amount"><?php echo number_format($AR_DT['amount'],2); ?></td>
                         <td data-title="Remark"><?php echo strtoupper($AR_DT['message']); ?></td>
                      <td data-title="Status"> <?php echo strtoupper($AR_DT['status']); ?>  </td>
                        <!--<td data-title="Action"> -->
                        <!--<div class="btn-group">-->
                        <!--    <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>-->
                        <!--    <ul class="dropdown-menu dropdown-default">-->
                        <!--      <li><a href="<?php echo BASE_PATH;?>superadmin/financial/checkStatus/<?php echo  $AR_DT['member_req_id']; ?>" target="_blank">Check Status</a> </li>-->
                             
                        <!--     <?php if($AR_DT['manage_status'] =='N'){ ?>-->
                        <!--      <li><a href="<?php echo BASE_PATH;?>superadmin/financial/manageRecharge/<?php echo  $AR_DT['recharge_id']; ?>" target="_blank">Manage Recharge</a> </li>      -->
                        <!--     <?php } ?>-->
                            
                        <!--    </ul>-->
                        <!--  </div>-->
                        
                        <!--  </td>-->
                    </tr>
                    <?php $Ctrl++; 
						endforeach; 
						}else{ ?>
                    <tr>
                      <td colspan="10" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No transaction found</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div> </div>
              <div class="clearfix">&nbsp;</div>
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
  
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
     </div>
 

  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> 
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
</body>
</html>
