<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$member_id = $this->session->userdata('mem_id');
$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
  
            if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
            $from_date = InsertDate($_REQUEST['from_date']);
            $to_date = InsertDate($_REQUEST['to_date']);
            $StrWhr .=" AND DATE(tcb.date_time) BETWEEN '$from_date' AND '$to_date'";
            $SrchQ .="&from_date=$from_date&to_date=$to_date";
            }
            	$segment = $this->uri->uri_to_assoc(2);
            	//PrintR($segment);
if(_d($segment['member_id'])>0 && $this->session->userdata('mem_id')>0){ 
	$member_id = _d(FCrtRplc($segment['member_id']));
}
else
{
	$member_id = $this->session->userdata('mem_id');	
}
    

 
  
   $RES1 = $this->SqlModel->runQuery("select member_id , user_id,first_name,rank_id,count_directs,team_bv,date_join from tbl_members where member_id = '$member_id'",true);   
    $RES2 = $this->SqlModel->runQuery("select member_id , user_id,first_name,rank_id,count_directs,team_bv,date_join from tbl_members where sponsor_id = '$member_id'");   
      $PAC = $this->SqlModel->runQuery("SELECT member_id , SUM(`prod_pv`) as total FROM `tbl_subscription` WHERE member_id = '$member_id'",true);   
  
 

 ?>
	<?php  //$this->load->view(MEMBER_FOLDER.'/layout/header'); 
//$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
?>

 
               <div class="container">
                   <div class="row">
                        <div class="order-statement" id="leve-tree-mainAA">
                        <div class="heading-main">
                             <a href="<?php echo BASE_PATH;?>userpanel" class="btn btn-primary"  >Back to Home</a>
                             <br>
                           
                        <a href="javascript:void(0);" class="btn btn-primary" onclick="printPageArea('printableArea')">Print</a>
                        </div>
                
<div id="responsiveTables" class="mb-5">
<div class="card">
  <div class="card-body">
                                <div class="table-responsive" id="printableArea">
                                  <figure> 
      <!--background: #ffffff47; background: #ffffff47;-->
 <ul class="tree">
    <li>
        <span >
            
              <?php if($PAC['total'] > 0){?> 
        
         <img src="<?php echo BASE_PATH;?>assets/images/green1.png" border="0"  width="50" height="50">
         
         <?php }else{ ?>
         <img src="<?php echo BASE_PATH;?>assets/images/red-img.png" border="0"  width="50" height="50">
         
         
         
         <?php } ?>
          <br>
            <?php echo $RES1['user_id'];?>  <br> <?php echo $RES1['first_name'];?> <br> [$ <?php echo ($PAC['total'] > 0 )?$PAC['total']:0;?>]
            
            
            <?php  $AR_TYPE  = $model->getCurrentMemberShip($RES1['member_id']);
    $date_from =  (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";  
    
    
    
       $rewardname = $model->getreward($RES1['rank_id']);
                                        
                                        if($rewardname['reward_name']==''){
                                            
                                            $rewardname ='Not Yet';
                                        }else{
                                            
                                            
                                     $rewardname    =  $rewardname['reward_name']; 
                                        }
    
    
    
    
    
    
    ?>
            
                <div class="user-content-mainA">
        <div class="table-responsive">
        <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
        <tbody>
        <!-- <tr class="odd" role="row"> -->
        <tr>
        <th>Name</th>
        <td align="center"> <?php echo $RES1['first_name'];?></td>
        </tr>
        
        <tr>
        <th>Id No.</th>
        <td align="center"> <?php echo $RES1['user_id'];?></td>
        </tr>
        
        <tr>
        <th>DOR</th>
        <td align="center"><?php echo DisplayDate($RES1['date_join']);?></td>
        </tr>
        
        <tr>
        <th>DOA</th>
        <td align="center"><?php echo DisplayDate($date_from);?></td>
        </tr>
        
        <tr>
        <th>Rank</th>
        <td align="center"><?php echo $rewardname;?></td>
        </tr>
        
        <tr>
        <th>Total Direct </th>
        <td align="center"><?php echo $RES1['count_directs'];?></td>
        </tr>
        
        <tr>
        <th>Level Open </th>
        <td align="center"> <?php echo ($model->getLastLevel($RES1['member_id']) > 0 )? $model->getLastLevel($RES1['member_id']): 0 ; ?></td>
        </tr>
        <tr>
        <th>Total Business</th>
        <td align="center"><?php echo CURRENCY; ?> <?php echo $RES1['team_bv'];?></td>
        </tr>
        <!-- </tr> -->
        </tbody>
        </table>
        </div>
        </div>
            
        </span>
      <ul>
        <?php if(count($RES2) > 0 ) { foreach($RES2 as $R2) {  $mid = $R2['member_id'];  $RES3 = $this->SqlModel->runQuery("select member_id , user_id,first_name from tbl_members where sponsor_id = '$mid'");  $PAC  = $this->SqlModel->runQuery("SELECT member_id , SUM(`prod_pv`) as total FROM `tbl_subscription` WHERE member_id = '$mid'" ,true);?>
   
        <li> <a href="<?php  echo generateSeoUrlMember("network","treegenealogynew".'/member_id/'._e($R2['member_id'])); ?>">
            
             <span>
                 
                 
             <?php if($PAC['total'] > 0){?> 
        
         <img src="<?php echo BASE_PATH;?>assets/images/green1.png"  border="0"  width="50" height="50">
         
         <?php }else{ ?>
         <img src="<?php echo BASE_PATH;?>assets/images/red-img.png" border="0"  width="50" height="50">
         
         
         
         <?php } ?>       
                 
                    <br>
                 <?php echo $R2['user_id'];?> 
             
             <br> <?php echo $R2['first_name'];?> <br> [<?php echo CURRENCY; ?>  <?php echo ($PAC['total'] > 0 )?$PAC['total']:0;?>]
             
               <?php  $AR_TYPE  = $model->getCurrentMemberShip($R2['member_id']);
    $date_from =  (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";  
    
    
    
       $rewardname = $model->getreward($R2['rank_id']);
                                        
                                        if($rewardname['reward_name']==''){
                                            
                                            $rewardname ='Not Yet';
                                        }else{
                                            
                                            
                                     $rewardname    =  $rewardname['reward_name']; 
                                        }
    
    
    
    
    
    
    ?>
            
                <div class="user-content-mainA">
        <div class="table-responsive">
        <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
        <tbody>
        <!-- <tr class="odd" role="row"> -->
        <tr>
        <th>Name</th>
        <td align="center"> <?php echo $R2['first_name'];?></td>
        </tr>
        
        <tr>
        <th>Id No.</th>
        <td align="center"> <?php echo $R2['user_id'];?></td>
        </tr>
         <tr>
        <th>DOR</th>
        <td align="center"><?php echo DisplayDate($R2['date_join']);?></td>
        </tr>
        
        <tr>
        <th>DOA</th>
        <td align="center"><?php echo DisplayDate($date_from);?></td>
        </tr>
        <tr>
        <th>Rank</th>
        <td align="center"><?php echo $rewardname;?></td>
        </tr>
        
        <tr>
        <th>Total Direct </th>
        <td align="center"><?php echo $R2['count_directs'];?></td>
        </tr>
        
        <tr>
        <th>Level Open </th>
        <td align="center"> <?php echo ($model->getLastLevel($R2['member_id']) > 0 )? $model->getLastLevel($R2['member_id']): 0 ; ?></td>
        </tr>
        <tr>
        <th>Total Business</th>
        <td align="center"><?php echo CURRENCY; ?> <?php echo $R2['team_bv'];?></td>
        </tr>
        <!-- </tr> -->
        </tbody>
        </table>
        </div>
        </div>  
                
             </span></a>
          
          <ul>
            <?php if(count($RES3) > 0 ) { foreach($RES3 as $R3) {  $mid = $R3['member_id'];  $RES4 = $this->SqlModel->runQuery("select member_id , user_id,first_name from tbl_members where sponsor_id = '$mid'");  $PAC  = $this->SqlModel->runQuery("SELECT member_id , SUM(`prod_pv`) as total FROM `tbl_subscription` WHERE member_id = '$mid'" ,true);?>  
            <li><a href="<?php  echo generateSeoUrlMember("network","treegenealogynew".'/member_id/'._e($R3['member_id'])); ?>">
                
                
                
                 <span>
                     
                      <?php if($PAC['total'] > 0){?> 
        
         <img src="<?php echo BASE_PATH;?>assets/images/green1.png" border="0"  width="50" height="50">
         
         <?php }else{ ?>
         <img src="<?php echo BASE_PATH;?>assets/images/red-img.png" border="0"  width="50" height="50">
         
         
         
         <?php } ?>  
                        <br>
                     
                     <?php echo $R3['user_id'];?> <br> <?php echo $R3['first_name'];?>
                     
                     <br> [<?php echo CURRENCY; ?>  <?php echo ($PAC['total'] > 0 )?$PAC['total']:0;?>]
                     
                       <?php  $AR_TYPE  = $model->getCurrentMemberShip($R3['member_id']);
    $date_from =  (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";  
    
    
    
       $rewardname = $model->getreward($R3['rank_id']);
                                        
                                        if($rewardname['reward_name']==''){
                                            
                                            $rewardname ='Not Yet';
                                        }else{
                                            
                                            
                                     $rewardname    =  $rewardname['reward_name']; 
                                        }
    
    
    
    
    
    
    ?>
            
                <div class="user-content-mainA">
        <div class="table-responsive">
        <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
        <tbody>
        <!-- <tr class="odd" role="row"> -->
        <tr>
        <th>Name</th>
        <td align="center"> <?php echo $R3['first_name'];?></td>
        </tr>
        
        <tr>
        <th>Id No.</th>
        <td align="center"> <?php echo $R3['user_id'];?></td>
        </tr>
        
         <tr>
        <th>DOR</th>
        <td align="center"><?php echo DisplayDate($R3['date_join']);?></td>
        </tr>
        
        <tr>
        <th>DOA</th>
        <td align="center"><?php echo DisplayDate($date_from);?></td>
        </tr>
        
        <tr>
        <th>Rank</th>
        <td align="center"><?php echo $rewardname;?></td>
        </tr>
        
        <tr>
        <th>Total Direct </th>
        <td align="center"><?php echo $R3['count_directs'];?></td>
        </tr>
        
        <tr>
        <th>Level Open </th>
        <td align="center"> <?php echo ($model->getLastLevel($R3['member_id']) > 0 )? $model->getLastLevel($R3['member_id']): 0 ; ?></td>
        </tr>
        <tr>
        <th>Total Business</th>
        <td align="center"><?php echo CURRENCY; ?> <?php echo $R3['team_bv'];?></td>
        </tr>
        <!-- </tr> -->
        </tbody>
        </table>
        </div>
        </div>
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     </span></a>
           
              <ul>
                <?php if(count($RES4) > 0 ) { foreach($RES4 as $R4) {  $mid = $R4['member_id'];$PAC  = $this->SqlModel->runQuery("SELECT member_id , SUM(`prod_pv`) as total FROM `tbl_subscription` WHERE member_id = '$mid'" ,true);?>
                <li><a href="<?php  echo generateSeoUrlMember("network","treegenealogynew".'/member_id/'._e($R4['member_id'])); ?>"> 
                
                
                <span>
                    
                            
             <?php if($PAC['total'] > 0){?> 
        
         <img src="<?php echo BASE_PATH;?>assets/images/green1.png" border="0"  width="50" height="50">
         
         <?php }else{ ?>
         <img src="<?php echo BASE_PATH;?>assets/images/red-img.png" border="0"  width="50" height="50">
         
         
         
         <?php } ?>     
            <br>
         
                    <?php echo $R4['user_id'];?> <br> <?php echo $R4['first_name'];?> <br> [<?php echo CURRENCY; ?>  <?php echo ($PAC['total'] > 0 )?$PAC['total']:0;?>]
                    
                    <?php  $AR_TYPE  = $model->getCurrentMemberShip($R4['member_id']);
    $date_from =  (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";  
    
    
    
       $rewardname = $model->getreward($R4['rank_id']);
                                        
                                        if($rewardname['reward_name']==''){
                                            
                                            $rewardname ='Not Yet';
                                        }else{
                                            
                                            
                                     $rewardname    =  $rewardname['reward_name']; 
                                        }
    
    
    
    
    
    
    ?>
            
                <div class="user-content-mainA">
        <div class="table-responsive">
        <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
        <tbody>
        <!-- <tr class="odd" role="row"> -->
        <tr>
        <th>Name</th>
        <td align="center"> <?php echo $R4['first_name'];?></td>
        </tr>
        
        <tr>
        <th>Id No.</th>
        <td align="center"> <?php echo $R4['user_id'];?></td>
        </tr>
        
        <tr>
        <th>DOR</th>
        <td align="center"><?php echo DisplayDate($R4['date_join']);?></td>
        </tr>
        
        <tr>
        <th>DOA</th>
        <td align="center"><?php echo DisplayDate($date_from);?></td>
        </tr>
        
        <tr>
        <th>Rank</th>
        <td align="center"><?php echo $rewardname;?></td>
        </tr>
        
        <tr>
        <th>Total Direct </th>
        <td align="center"><?php echo $R4['count_directs'];?></td>
        </tr>
        
        <tr>
        <th>Level Open </th>
        <td align="center"> <?php echo ($model->getLastLevel($R4['member_id']) > 0 )? $model->getLastLevel($R4['member_id']): 0 ; ?></td>
        </tr>
        <tr>
        <th>Total Business</th>
        <td align="center"><?php echo CURRENCY; ?> <?php echo $R4['team_bv'];?></td>
        </tr>
        <!-- </tr> -->
        </tbody>
        </table>
        </div>
        </div>
                
                    
                    </span></a>
                <?php } } ?>
              </ul>
            </li>
            <?php } } ?>
          </ul>
          
        </li>
         <?php  }} ?>
      </ul>
    </li>
  </ul>
</figure>
                                </div>
                            </div>


</div>
</div>
                    </div>
                   </div>
               </div>
 <footer id="footer-main" >
                   
                    </footer>
			<?php //$this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>