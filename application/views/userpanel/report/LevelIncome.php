<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
    $model = new OperationModel();
  $Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
  
  $member_id = $this->session->userdata('mem_id');
  
  if($_GET['from_date']!='' && $_GET['to_date']!=''){
    $from_date = InsertDate($_GET['from_date']);
    $to_date = InsertDate($_GET['to_date']);
    $StrWhr .=" AND DATE(tcd.date_time) BETWEEN '$from_date' AND '$to_date'";
    $SrchQ .="&from_date=$from_date&to_date=$to_date";
  }
    
    $QR_PAGES="SELECT tcd.*, tm.user_id,tm.first_name,tm.last_name FROM ".prefix."tbl_cmsn_level AS tcd 
        LEFT JOIN tbl_members AS tm ON tcd.from_member_id =tm.member_id
        WHERE tcd.member_id='".$member_id."' $StrWhr group BY tcd.level order by tcd.level ASC";
  $PageVal = DisplayPages($QR_PAGES, 200, $Page, $SrchQ);
  
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
					<h4>My Level Income</h4>
				
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
                          <th>Sn.</th>
                          <!--<th>Date</th>-->
                         <!-- <th>Level Id</th>-->
                          <th>Level</th>
                           <th>Persentage</th>
                            <th>Team Business</th>
                          <th>View</th>
                           <th>Level Bonus</th>
                        </tr>
                            </thead>
                            <tbody>
                                   <?php 
                                if($PageVal['TotalRecords'] > 0){
                                $Ctrl=$PageVal['RecordStart']+1;
                            //  echo "<pre>";print_r($PageVal['ResultSet']);die;
                                    foreach($PageVal['ResultSet'] as $AR_DT):
                                    //   $total_income += $AR_DT['total_income'];
                                    //   $net_income += $AR_DT['net_income'];
                                      
                                       $llvel = $model->getLevelamountbylevel($member_id,$AR_DT['level']);
                                      
                                      
                                       $level_percentage =   returnLevelPercentagenew($AR_DT['level']); 
                                      
                                      
                                ?> 
                                <tr class="odd" role="row">
                                    <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                                      <!--<td class=""><?php //echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>-->
                                        
                                         <td><span class="label label-success arrowed">Level - <?php echo $AR_DT['level']; ?></span> </td>
                                          <td><?php echo number_format($level_percentage,2); ?> %</td>
                                         <td><?php echo CURRENCY; ?><?php echo number_format($llvel['total_income'],2); ?></td>
                                       <td>
                     
                     
                     <a href="<?php echo BASE_PATH;?>userpanel/report/LevelIncomeList?LEVEL=<?php echo _e($AR_DT['level'] );?>"  ><button class="btn btn-xs btn-primary">
                                                <i class="ace-icon fa fa-eye bigger-110"></i>

                                                View
                                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                            </button></a></td>
                                             <td><?php echo CURRENCY; ?><?php echo number_format($llvel['net_income'],4); ?></td>
                                  </tr>
                             
                        
                                    
                                    <?php endforeach; 
                                    }else{
                                    ?>
                                    <tr class="odd" role="row">
                                        <td colspan="5" align="center">No transaction found</td>
                                    </tr>
                                <?php 
                                    }
                                 ?>
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


