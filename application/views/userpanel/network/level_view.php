<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	 
	
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
   $data = returnLevel($member_id,'');  
	
//	PrintR($data);die;

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
					<h4>My Level View</h4>
				
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
<th>Total Member</th>
<th>Total Volume</th>
<th>View</th>
 
</tr>
                            </thead>
                          <tbody>
<?php 
			 
				foreach($data  as $AR_DT):
			 if($AR_DT['total'] > 0){
			     $bv =0;
			  if($AR_DT['level']>0){
			     	foreach($AR_DT['data']  as $AR_DT1):
			     	$bv += ($AR_DT1['prod_pv'] !='')?$AR_DT1['prod_pv']:0;
			     	
			     	 endforeach;    
			     	    	$teambusiness += $bv;
				?>
              <tr  >
            
               
                <td><span class="label label-lg label-success arrowed-in arrowed-in-right">Level-<?php echo $AR_DT['level']; ?> </span> </td>
             <td> <span class="label label-lg label-info arrowed-in arrowed-in-right">  <?php echo $AR_DT['total']; ?></span> </td>
     <td>              <span class="label label-lg label-warning arrowed-in arrowed-in-right"><?php echo CURRENCY; ?> <?php echo $bv; ?></span> </td>
                 <td>
                     
                     
                     <a href="<?php echo BASE_PATH;?>userpanel/network/level_view_list?LEVEL=<?php echo _e($AR_DT['level']);?>"  ><button class="btn btn-xs btn-primary">
												<i class="ace-icon fa fa-eye bigger-110"></i>

												View
												<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
											</button></a></td>
              </tr>
              
              <?php $Ctrl++; }
              }
			   endforeach; 			   ?>
			   
			   <strong style="color: red;font-size: 20px;">Team Business => <?php  echo $teambusiness; ?></strong>
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


