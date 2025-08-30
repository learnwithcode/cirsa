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
		
		
		 <script>
    function printPageArea(areaID){
    var printContent = document.getElementById(areaID).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
}
</script>
  <style>
    body {
  font-family: Calibri, Segoe, "Segoe UI", "Gill Sans", "Gill Sans MT", sans-serif;
}

/* It's supposed to look like a tree diagram */
.tree, .tree ul, .tree li {
    list-style: none;
    margin: 0;
    padding: 0;
    position: relative;
}

.tree {
    margin: 0 0 1em;
    text-align: center;
}
.tree, .tree ul {
    display: table;
}
.tree ul {
  width: 100%;
}
    .tree li {
        display: table-cell;
        padding: .5em 0;
        vertical-align: top;
    }
        /* _________ */
        .tree li:before {
            outline: solid 1px #666;
            content: "";
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
        }
        .tree li:first-child:before {left: 50%;}
        .tree li:last-child:before {right: 50%;}

        .tree code, .tree span {
                border: solid 0.1em #666;
                /*border-radius: 50%;*/
                display: inline-block;
                margin: 0 0.2em 0.5em;
                /*padding: 1.2em 1.5em;*/
                padding:0px;
                position: relative;
        }
        /* If the tree represents DOM structure */
        .tree code {
            font-family: monaco, Consolas, 'Lucida Console', monospace;
        }

            /* | */
            .tree ul:before,
            .tree code:before,
            .tree span:before {
                outline: solid 1px #666;
                content: "";
                height: .5em;
                left: 50%;
                position: absolute;
            }
            .tree ul:before {
                top: -.5em;
            }
            .tree code:before,
            .tree span:before {
                top: -.55em;
            }

/* The root node doesn't connect upwards */
.tree > li {margin-top: 0;}
    .tree > li:before,
    .tree > li:after,
    .tree > li > code:before,
    .tree > li > span:before {
      outline: none;
    }
    
   .tree .user-content-mainA {
                position: absolute;
                background-color: #ffff;
                z-index: 99;
                padding: 10px;
                top: 0;
                left: -15px;
                overflow: auto;
                /* height: 200px; */
                box-shadow: 0 0 8px #00000059;
                opacity: 0;
                transition: all linear 0.2s;
                visibility: hidden;
                border-radius: 5px;
                width: 300px;
            }

            @media (max-width:576px) {
                .tree .user-content-mainA {
                    width: 300px;
                    max-width: 250px;
                    left: 50% !important;
                    transform: translateX(-50%);
                }
            }

            .tree .user-content-mainA th,
            td {
                padding: 4px !important;
                text-align: left !important;
            }

            /* ul.tree>li span.active .user-content-mainA {
                opacity: 1;
                visibility: visible;
                transition: all linear 0.5s;
            } */

            ul.tree>li span:hover .user-content-mainA {
                opacity: 1;
                visibility: visible;
                transition: all linear 0.5s;
            }
</style>

<style>
        #leve-tree-mainAA {
            overflow: auto !important;
            height: auto !important;
            min-height: 100% !important;
        }

        #leve-tree-mainAA::-webkit-scrollbar {
            /*width: 0;*/
        }

        div#leve-tree-mainAA ul.tree {
            margin: 0 auto;
        }

        .user-content-mainA table#datatable-basic {
            width: 100%;
        }
    </style>   
		
	     <!--**********************************
            Content body start
        ***********************************-->
       <div class="content-body">
			<div class="container-fluid">
                 <div class="page-titles">
					<h4>My Referal</h4>
				
                </div>
                <!-- row -->

                <div class="row">
                   
				
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Details Here</h4>
                            </div>
                            <div class="card-body">
                               <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Genealogy View</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                  <figure> 
      <!--background: #ffffff47; background: #ffffff47;-->
 <ul class="tree">
    <li>
        <span >
            
              <?php if($PAC['total'] > 0){?> 
        
         <img src="<?php echo BASE_PATH;?>assets/images/tree1.png" border="0"  width="90" height="90">
         
         <?php }else{ ?>
         <img src="<?php echo BASE_PATH;?>assets/images/tree2.png" border="0"  width="90" height="90">
         
         
         
         <?php } ?>
          <br>
            <?php echo $RES1['user_id'];?>  <br> <?php echo $RES1['first_name'];?> <br> [<?php echo CURRENCY; ?> <?php echo ($PAC['total'] > 0 )?$PAC['total']:0;?>]
            
            
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
   
        <li> <a href="<?php  echo generateSeoUrlMember("network","treegenealogy".'/member_id/'._e($R2['member_id'])); ?>">
            
             <span>
                 
                 
             <?php if($PAC['total'] > 0){?> 
        
         <img src="<?php echo BASE_PATH;?>assets/images/tree1.png"  border="0"  width="90" height="90">
         
         <?php }else{ ?>
         <img src="<?php echo BASE_PATH;?>assets/images/tree2.png" border="0"  width="90" height="90">
         
         
         
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
            <li><a href="<?php  echo generateSeoUrlMember("network","treegenealogy".'/member_id/'._e($R3['member_id'])); ?>">
                
                
                
                 <span>
                     
                      <?php if($PAC['total'] > 0){?> 
        
         <img src="<?php echo BASE_PATH;?>assets/images/tree1.png" border="0"  width="90" height="90">
         
         <?php }else{ ?>
         <img src="<?php echo BASE_PATH;?>assets/images/tree2.png" border="0"  width="90" height="90">
         
         
         
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
                <li><a href="<?php  echo generateSeoUrlMember("network","treegenealogy".'/member_id/'._e($R4['member_id'])); ?>"> 
                
                
                <span>
                    
                            
             <?php if($PAC['total'] > 0){?> 
        
         <img src="<?php echo BASE_PATH;?>assets/images/tree1.png" border="0"  width="90" height="90">
         
         <?php }else{ ?>
         <img src="<?php echo BASE_PATH;?>assets/images/tree2.png" border="0"  width="90" height="90">
         
         
         
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
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


<?php

   $this->load->view(MEMBER_FOLDER.'/layout/footer'); 


?>


