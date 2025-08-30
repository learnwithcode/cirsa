<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	$from_date = InsertDate($segment['from_date']);
	$to_date = InsertDate($segment['to_date']);
	 
	$member_id = $this->session->userdata('mem_id');
    $ID = _d($this->uri->segment(4));
    $user_id = $model->getMemberUserId($member_id);
    
    $POOL = $this->SqlModel->runQuery("SELECT * FROM `tbl_level_members_2` WHERE `member_id` =  '$member_id' AND `ref_id` ='$ID' ORDER BY  id  ASC");       
     //PrintR($POOL);die;
?>

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
                border-radius: 0.2em;
                display: inline-block;
                margin: 0 0.2em 0.5em;
                padding: 1.2em 1.5em;
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
</style>


	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu');?>
	

		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
			
	
              <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">My Re-Top Up Poo View</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                             <?php if($POOL) { 
                          foreach($POOL as $P) { 
                          
                          $S1 = $model->getPoolUserId($P['id'] , 1);
                          $S2 = $model->getPoolUserId($P['id'] , 2);
                             $S1 = $model->getMemberUserId($S1);
                              $S2 = $model->getMemberUserId($S2);
                          ?>
                            
               	
                	
                
    <div class="header-title">
                            <h5 class="card-title">Slot - <?php echo $P['t_count'];?></h5>
                            </div>
                           <div class="row">
    <div class="table-responsive">
                           <div class = "table-responsive">
        
 
<figure> 
      <!--background: #c01f1f47; background: #1fc02747;-->
  <ul class="tree">
    <li><span style="color: white;background:#008069;" ><?php echo $RES1->user_id;?> <br> [  <?php echo $user_id;?> ]</span>
      <ul>
          
           <li><span style="color: white;background:#<?php echo ($S1)?'008069':'0e0e0e';?>" >  [   <?php echo ($S1)?$S1:'Empty';?>  ]</span>
            <li><span style="color: white;background:#<?php echo ($S2)?'008069':'0e0e0e';?>" >  [  <?php echo ($S1)?$S2:'Empty';?>  ]</span>
            
          


      
         
      </ul>
    </li>
  </ul>
</figure>
   </div>
                    </div>   
     
 </div> 
                          
                          <?php }} ?>
                           
                               
                        </div>
                     </div>
                  </div>
               </div>
        	</div>
		
		</div>		
        <!--**********************************
            Content body end
        ***********************************-->
		
	
	

</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>