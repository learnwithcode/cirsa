<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	$from_date = InsertDate($segment['from_date']);
	$to_date = InsertDate($segment['to_date']);
	 
	$member_id = $this->session->userdata('mem_id');
 $data = returnLevel($member_id,'');  	 //PrintR($data);die;

?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>								


		 <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
       		
		
<div class="content-body"><!-- Basic Tables start -->
 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">My DownLine		</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="card-content collapse show">
                 
                <div class="table-responsive">
                    <table class="table table-bordered table-inverse mb-0 .table-inverse">
 <thead>
<tr>
<th>Sn</th>
<th>Level</th>
<th>User Id</th>
<th>Name</th>
<th>Sponsor Name</th>
<th>Date of Join</th> 
<th>Date of Activation</th> <th>Price</th> 
</tr>

                            
</thead>
<tbody>
<?php 
			 $i=1;
				foreach($data  as $AR_DT1):
			  	foreach($AR_DT1['data'] as $AR_DT):
				?>
              <tr  >
            
                <td><?php echo $i;$i++; ?>  </td>
                <td><span class="label label-success label-white middle">Level - <?php echo $AR_DT1['level']; ?> </span></td>
                <td><?php echo $AR_DT['user_id']; ?>  </td>
    <td><?php echo $AR_DT['first_name']; ?>  </td>
     <td><?php echo $AR_DT['s_name']; ?>  </td>
   <td><?php echo date('d-M-Y',strtotime($AR_DT['date_join'])); ?>  </td>

           <td><?php if($AR_DT['date_from'] !=''){echo date('d-M-Y',strtotime($AR_DT['date_from']));}else{echo 'N/A';} ?>  </td> <td><span class="label label-lg label-success arrowed-in arrowed-in-right"><?php echo ($AR_DT['prod_pv'] !='')?$AR_DT['prod_pv']:0; ?> BV</span>  </td>
              </tr>
              
              <?php 
			   endforeach; endforeach;	?>
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
    <!-- END: Content-->	
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
