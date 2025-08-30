<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
  
    $member_id = $this->session->userdata('mem_id');
	 
	
	$QR_LINE="SELECT * FROM `tbl_sale`   WHERE     member_id='$member_id' order by sale_id desc ";
    $PageVal = DisplayPages($QR_LINE, 10, $Page, $SrchQ);
	$MEM_RES = $model-> getMemberdetail($member_id);
  
    
?>

		 		  
<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/select2.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/bootstrap-datepicker3.min.css" />
	
<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
			<link rel="stylesheet" href="<?php echo BASE_PATH;?>assets/css/chosen.min.css" />

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

           <div class="main-content">
				<div class="main-content-inner">
					 <div class="page-content">
						
                         	<div class="row">
							<div class="col-xs-12">
							 
							<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>

							
								
							</div> 
						</div> 
	 <div class="row">
		<div class="col-xs-12">
		
	   
		
		<div class="widget-box">
		   <div class="widget-header widget-header-blue widget-header-flat">
		<h4 class="widget-title blue">Product Purchase Panel  </h4>
		
	 
		</div>
		
		<div class="widget-body">
		   <div class="widget-main">
		
		       
		
		
		
		
		
		 	 <div class="panel-body list">
<div class="table-responsive project-list">
<table class="table table-striped">

			<thead>
			<tr>
		    <th class="text-center">Date</th>
			<th class="text-center">User Id</th>
			<th class="text-center">User Name</th>
			<th class="text-center">Total Quantity</th>
			<th class="text-center">Total Price</th>
			<th class="text-center">Status</th>
		    <th class="text-center">Action</th>
			</tr>
	  						
			</thead>
			<tbody>
   <?php 					if($PageVal['TotalRecords'] > 0){
						    $Ctrl=$PageVal['RecordStart']+1;
					        foreach($PageVal['ResultSet'] as $AR_DT):  ?>
		<tr>
		<td class="text-center"><?php echo DisplayDate($AR_DT['date_time']);?></td>
		<td class="text-center"><?php echo $AR_DT['user_id'];?></td>
		<td class="text-center"><?php echo $AR_DT['name'];?></td>
		<td class="text-center"><?php echo $AR_DT['total_unit'];?></td>
		<td class="text-center"><?php echo $AR_DT['total_price'];?></td>
		<td class="text-center">  <?php if($AR_DT['status'] =='Y'){?> <span class="label label-lg label-success arrowed-in arrowed-in-right">Success</span><?php }  elseif($AR_DT['status'] =='N'){ ?><span class="label label-lg label-warning arrowed-in arrowed-in-right">Pending</span> <?php } else{?><span class="label label-lg label-danger arrowed-in arrowed-in-right">Reject</span>  <?php }?>  </td>
		<td class="text-center"> <a  target="_blank" href="<?php echo generateMemberForm("product","view_purchase_product",array("sale_id"=>_e($AR_DT['sale_id']))); ?>"> <span class="label label-lg label-primary arrowed-in arrowed-in-right">View <i class="ace-icon fa fa-eye bigger-110"></i></span>  </a>   
 <?php if($AR_DT['status'] =='Y'){?> 	<a  target="_blank" href="<?php echo generateMemberForm("product","product_invoice",array("sale_id"=>_e($AR_DT['sale_id']))); ?>"> 	<span class="label label-lg label-info arrowed-in arrowed-in-right">Invoice <i class="ace-icon fa fa-file bigger-110"></i></span> </a> <?php } ?> 
	 <?php if($AR_DT['delivery_type'] =='C' and $AR_DT['status'] =='Y'){?> 
	 	<a  target="_blank" href="<?php echo generateMemberForm("product","delivery_detail",array("sale_id"=>_e($AR_DT['sale_id']))); ?>"> 	<span class="label label-lg label-danger arrowed-in arrowed-in-right">Courier Status <i class="ace-icon fa fa-file bigger-110"></i></span> </a> 
	 
	 <?php } 	 ?>
	</td>
		</tr>
		
		  <?php $Ctrl++;
						   endforeach;	}else{
												?>
											<tr>	<td colspan="6" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No data found</td></tr>
											<?php 
												}?>
		</tbody>
		</table>
		<div class="row"><div class="col-xs-6"><div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries</div></div>

<div class="col-xs-6">
<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
  <ul class="pagination">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul>  
								  
								  </div></div>




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
			
			
         
 
		 	  
	 


<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>

  
	
	    
  
	    		
		
 