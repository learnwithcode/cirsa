<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

if(_d($_GET['member_id'])>0 && $this->session->userdata('mem_id')>0){ 
	$member_id = _d(FCrtRplc($_GET['member_id']));
}
else
{
	$member_id = $this->session->userdata('mem_id');	
}
if($member_id<=0 || $member_id==''){ set_message("warning","Unable to load tree, please enter valid member"); }
$URI = $this->uri->segment(4) ;
$Var1 = $member_id;
$Var2 = "";
$Var3 = "";
$Var4 = "";
$Var5 = "";
$Var6 = "";
$Var7 = "";
$pool_id =($URI > 0 )?$URI:1; 

 
                $QUERY   = "SELECT id FROM `tbl_level_members` WHERE `member_id` ='$member_id'  and t_count ='$pool_id'";
                $PoolId = $this->SqlModel->runQuery($QUERY,true);  
                
$Var1 = $PoolId['id'] ;               
if($Var1!=""){
	$QR_TREE1 = "SELECT id,position FROM `tbl_level_members` WHERE `spill_id` ='$Var1'   ";
	$RS_TREE1 = $this->SqlModel->runQuery($QR_TREE1);

//  	echo "<pre>";print_r($RS_TREE1);die;
	foreach($RS_TREE1 as $AR_TREE1):
		if($AR_TREE1['position'] == "L"){
			$Var2 = $AR_TREE1['id'];
		}
		if($AR_TREE1['position'] == "R"){
			$Var3 = $AR_TREE1['id'];
		}
	endforeach;

}

if($Var2!=""){
	
	$QR_TREE2 = "SELECT id,position FROM `tbl_level_members` WHERE `spill_id` ='$Var2'   ";
	$RS_TREE2 = $this->SqlModel->runQuery($QR_TREE2);
	foreach($RS_TREE2 as $AR_TREE2):
		if($AR_TREE2['position'] == "L"){
			$Var4 = $AR_TREE2['id'];
		}
		if($AR_TREE2['position'] == "R"){
			$Var5 = $AR_TREE2['id'];
		}
	
	endforeach;
	
}

if($Var3!=""){
	
	$QR_TREE3 = "SELECT id,position FROM `tbl_level_members` WHERE `spill_id` ='$Var3'   ";
	$RS_TREE3 = $this->SqlModel->runQuery($QR_TREE3);
	foreach($RS_TREE3 as $AR_TREE3):
		if($AR_TREE3['position'] == "L"){
			$Var6 = $AR_TREE3['id'];
		}
		if($AR_TREE3['position'] == "R"){
			$Var7 = $AR_TREE3['id'];
		}
	endforeach;

}
 
                $QUERY  = "SELECT * FROM `tbl_level_members` WHERE `member_id` ='$member_id' ORDER BY `tbl_level_members`.`id` ASC";
                $RES   = $this->SqlModel->runQuery($QUERY,false);// PrintR($RES);die;
	
	
 ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	
<div class="content-page rtl-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                   
                
     <div class="row">
	 
	 
	 <div class="col-lg-12 col-md-12">
               <div class="card">
                  <div class="card-header">
                     Elite Pool
                  </div>
                  <div class="card-body">
                        <?php $i= 1; foreach($RES as $R){  ?>
                        
                        <a href="<?php echo BASE_PATH;?>member/network/pool/<?php  echo $R['t_count'];?>" class="btn btn-<?php if($pool_id == $R['t_count']){ echo 'success';} else {echo 'primary';}?> " style="width: 100px;">Pool - <?php echo $i;$i++;?></a>
                        <?php }?>
                  </div>
               </div>
            </div>
	 
					
					
					</div>
	<?php  get_message(); ?>
	
	
	
	
	
	
 
          <div class="table-responsive">
          
      
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0"  style="    background: #1c4043;"  >
              
              <tr>
                <td colspan="17" align="center">&nbsp;</td>
              </tr>
          
              <tr>
                <td colspan="17" align="center">
					  <?php    echo $model->getPooldetails($Var1);   ?>
                </td>
              </tr>
              <tr>
                <td colspan="17" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/line1.png" class="lines"></div></td>
              </tr>
              <tr>
                <td colspan="8" align="center"> <?php    echo $model->getPooldetails($Var2);   ?>     
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
               <!-- <td width="1" rowspan="5" align="center"  style="background-image:url(<?php echo BASE_PATH; ?>assets/setupimages/arrow.gif)">&nbsp;</td>-->
                <td colspan="8" align="center">  <?php    echo $model->getPooldetails($Var3);   ?>   </td>
              </tr>
              <tr>
                <td colspan="8" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/line1.png" style="width:314px;" class="lines"></div></td>
               <td colspan="8" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/line1.png" style="width:314px;" class="lines"></div></td>
              </tr>
              <tr>
                <td  colspan="4" align="center">  <?php    echo $model->getPooldetails($Var4);   ?>         </td>
                <td colspan="4" align="center">  <?php    echo $model->getPooldetails($Var5);   ?>       </td>
                <td colspan="4" align="center">  <?php    echo $model->getPooldetails($Var6);   ?>         </td>
                <td colspan="4" align="center">  <?php    echo $model->getPooldetails($Var7);   ?>         </td>
              </tr>
             
              <tr>
                <td colspan="17" align="center">&nbsp;</td>
              </tr>
              
            </table>
          </div>
      
		 
                                
                   
                   
               </div>
            </div>
         </div>
      </div>
      </div>
	
	
 
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
					
 			

<script src="<?php echo BASE_PATH; ?>assets/javascript/tooltip.js" type="text/javascript"></script>
<script src="<?php echo BASE_PATH; ?>assets/javascript/genvalidator.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo BASE_PATH; ?>assets/javascript/wz_tooltip.js"></script>
		
		
 
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>
 
<script language="javascript" type="text/javascript">
function GoBack(){
	<?php if($member_id != ""){?>window.history.go(-1);<?php } ?>
}
function ViewTop(){
	window.location="?#";
}
function SearchTree(){
	var member_id = document.getElementById("member_id").value;
	
	if(trim(member_id) != ""){moveTree(member_id);}
}
function moveTree(member_id){
	if(member_id != ""){
		document.frmtree.member_id.value=member_id;
		document.frmtree.submit();
	}else{
		return false;
	}
}
</script>
<form name="frmtree" method=get action="?">
  <input type=hidden name="temp" value="<?php echo base64_encode("temp");?>">
  <input type=hidden name="mytree" value="<?php echo base64_encode("mytree");?>">
  <input type=hidden name="member_id">
  <input type=hidden name="view" value="<?php echo base64_encode("myview");?>">
  <input type=hidden name="others" value="<?php echo base64_encode("others".$_REQUEST['member_id']);?>">
</form><?php jquery_validation(); auto_complete(); ?>
<script type="text/javascript">
	
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>
<script type="text/javascript" language="javascript">
new Autocomplete("user_id", function(){  
	this.setValue = function( id ) {document.getElementsByName("member_id")[0].value = id;}
	if(this.isModified) this.setValue("");
	if(this.value.length < 1 && this.isNotClick ) return;
	return "<?php echo ADMIN_PATH; ?>autocomplete/listing?srch=" + this.value+"&switch_type=MEM_DOWNLINE&member_id=<?php echo $this->session->userdata('mem_id');  ?>";
});
</script>
 
