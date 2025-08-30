<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
$model = new OperationModel();
$today_date = getLocalTime();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
   $QR_PAGES= "SELECT tft.*,tmt.first_name AS first_name, tmt.last_name AS last_name,tmt.midle_name as midle_name, tmt.user_id  AS user_id
			 FROM ".prefix."tbl_wallet_trns AS tft 
			
			 LEFT JOIN tbl_members AS tmt ON tmt.member_id=tft.member_id	
			 WHERE tft.wallet_id ='50' and  tft.trns_type='Cr'   and  ( trns_for  ='MASTER'  or trns_for  ='TRX')
			 $StrWhr ORDER BY tft.wallet_trns_id DESC ";
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
          <h1> Transaction  <small> <i class="ace-icon fa fa-angle-double-right"></i> Wallet Credits   </small> </h1>
            <a    href="<?php  echo generateSeoUrlAdmin("transaction","home",''); ?>"  class="pull-right" >	<button type="button" class="btn btn-danger">Back</button></a>
        </div>
        
        
        <div class="space-12"></div>  <div class="space-12"></div>
         <div class="row">
			   
			
			   
			  
			   
	 <div class="col-xs-12">
	     <div class="table-responsive">
 <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                        <th  class="center"> S.no </th>
                     <th  class="center"> Date </th>
                     <!--<th >Member </th>-->
                     <!--<th>Name</th>-->
                     <th >Description</th>
                     <th >Trans Type </th>
                     <th >Amount</th>
                     <th >Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=$PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):
						  $ffff += $AR_DT['trns_amount'];
						    
			       ?>
                    <tr <?php if($AR_DT['trns_type']=='Cr'){echo 'class="success"';}else{ echo 'class="warning"';}?>>
                         <td data-title="Date"><?php echo $Ctrl; ?></td>
                      <td data-title="Date"><?php echo Displaydate($AR_DT['trns_date']); ?></td>
                      <!--<td data-title="Member Id"><?php echo strtoupper($AR_DT['user_id']); ?></td>-->
                      
                      <!--<td data-title="Name"><?php echo strtoupper($AR_DT['first_name'].' '.$AR_DT['midle_name'].' '.$AR_DT['last_name']); ?> </td>-->
                      <td data-title="Description"><?php echo strtoupper($AR_DT['trns_remark']); ?></td>
                      <td data-title="Trans Type"><!--<?php if($AR_DT['trns_for'] == 'BYC'){echo 'COMMISION';}else{ echo $AR_DT['trns_for'];} ?>--><?php echo $AR_DT['trns_type'];?></td>
                       <td data-title="Amount"><?php echo $AR_DT['trns_amount']; ?> &nbsp;&nbsp;TRX</td>
                      <td data-title="Status">
                        Confirmed
                       
                      </td>
                    </tr>
                   <?php $Ctrl++; endforeach;
						
						 ?>
					
						 <?php }	else{ ?>
                    <tr>
                      <td colspan="6" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No transaction found</td>
                    </tr>
                    <?php } ?>
                    	 <!--<tr>
						     <th colspan="4" align='center'>Total </th>
						     <th data-title="Total Income">$&nbsp;<?php echo number_format($ffff,2); ?></th>
			            	 
						 </tr>-->
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
