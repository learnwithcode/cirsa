<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(3);
	$level =  _d($_GET['LEVEL']); 
	
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
   $data = returnLevel($member_id,$level);  
	
	

?> 
<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

 

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php
        
        $this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
        
        ?>
        
       
        <!--**********************************
            Nav header end
        ***********************************-->
		
		
	

        <!--**********************************
            Sidebar start
        ***********************************-->
     <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu');  ?>
        <!--**********************************
            Sidebar end
        ***********************************-->
		
	     <!--**********************************
            Content body start
        ***********************************-->
       <div class="content-body">
			<div class="container-fluid">
                 <div class="page-titles">
					<h4>My Level View List</h4>
				
                </div>
                <!-- row -->

                <div class="row">
                   
				
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Details Here</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                          <thead>
                                                <tr>

<th>Level</th>
<th>User Id</th>
<th>Name</th>
<th>Sponsor Id</th>
<th>Sponsor Name</th>
<th>Reg. Date</th> 
<th>Act. Date</th>
<th>Act. Value</th> 
</tr>
                            </thead>
                        <tbody>
<?php 
			 
				foreach($data['data']  as $AR_DT):
			  $spo_name=$model->getSponsorname($AR_DT['sponsor_id']);
			 // PrintR($spo_name);die;
				?>
              <tr  >
            
               
                <td><span class="label label-success label-white middle">Level - <?php echo $data['level']; ?> </span></td>
                <td><?php echo $AR_DT['user_id']; ?>  </td>
    <td><?php echo $AR_DT['first_name']; ?>  </td> 
     <td><?php echo $spo_name['user_id']; ?>  </td>
    <td><?php echo $spo_name['full_name']; ?>  </td>
   <td><?php echo date('d-M-Y',strtotime($AR_DT['date_join'])); ?>  </td>

           <td><?php if($AR_DT['date_from'] !=''){echo date('d-M-Y',strtotime($AR_DT['date_from']));}else{echo 'N/A';} ?>  </td> <td><span class="label label-lg label-success arrowed-in arrowed-in-right"><?php echo CURRENCY; ?> <?php echo ($AR_DT['prod_pv'] !='')?$AR_DT['prod_pv']:0; ?>  </span>  </td>
              </tr>
              
              <?php $Ctrl++;
			   endforeach;	?>
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
        <!--**********************************
            Content body end
        ***********************************-->


<?php

   $this->load->view(MEMBER_FOLDER.'/layout/footer'); 


?>


