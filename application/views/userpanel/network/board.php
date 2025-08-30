<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	$from_date = InsertDate($segment['from_date']);
	$to_date = InsertDate($segment['to_date']);
	 
	$member_id = $this->session->userdata('mem_id');
    
  

?>



	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu');?>
	
<div id="content" class="app-content">

<div class="container-fluid">

<div class="row justify-content-center">

<div class="col-xl-12">

<div class="row">

<div class="col-xl-12">

<h1 class="page-header">
My Pool View</h1>

<hr class="mb-4">



<div id="responsiveTables" class="mb-5">
<div class="card">
<div class="card-body">
<div class="table-responsive  table-bordered mb-0">
<table class="table mb-0">
  <thead>
                                <tr>
                                    <th scope="col">#Sn</th>
                                    <th scope="col">Package</th> 
                                    <th>Date</th>
                                    <th scope="col">Action</th>
                                   </tr>
                            </thead>
                            <tbody>
                          
                                <?php 
                                  $activation = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members` WHERE `member_id` =  '$member_id' AND `entry_type` ='A' ORDER BY  id  ASC");       
                                if(count($activation) > 0 ){
                                    $i=1;$TotalPackages=0;
                                    foreach($activation as $r) { 
                                      
                                ?>
                                <tr>
                                    <td><?php echo $i;?></td>
                                  
                                    <td><?php echo number_format($r['amount'],2);?></td> 
                                    <td><?php echo date('d-M-Y',strtotime($r['date_time']));?></td>
                                    <td><a href="<?php echo BASE_PATH;?>userpanel/network/poolView/<?php echo _e($r['ref_id']);?>"  target="_blank" class="btn btn-success mt-0">View</a></td>
                                </tr>
                                <?php  $i++; } ?>
                                
                                
                                
                                <?php } else{ ?>
                                <tr>
                                    <td colspan="5" class="text-center text-danger">No Data found !</td>
                                   
                                </tr>
                                <?php } ?>
                            </tbody>
</table>
 <div class="row">
<div class="col-md-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
</div></div>

<div class="col-md-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul> </nav>
								  
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
      
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>