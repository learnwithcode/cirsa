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

$Var1 = $member_id;
$Var2 = "";
$Var3 = "";
$Var4 = "";
$Var5 = "";
$Var6 = "";
$Var7 = "";
$Var8 = "";
$Var9 = "";
$Var10 = "";
$Var11 = "";
$Var12 = "";
$Var13 = "";
$Var14 = "";
$Var15 = "";
$Var16 = "";
$Var17 = "";
$Var18 = "";
$Var19 = "";
$Var20 = "";
$Var21 = "";
$Var22 = "";
$Var23 = "";
$Var24 = "";
$Var25 = "";
$Var26 = "";
$Var27 = "";
$Var28 = "";
$Var29 = "";
$Var30 = "";
$Var31 = "";
// echo $Var1;
if($Var1!=""){
	$QR_TREE1 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var1' AND (nleft>0 AND nright>0) ";
	$RS_TREE1 = $this->SqlModel->runQuery($QR_TREE1);

//	echo "<pre>";print_r($RS_TREE1);die;
	foreach($RS_TREE1 as $AR_TREE1):
		if($AR_TREE1['left_right'] == "L"){
			$Var2 = $AR_TREE1['member_id'];
		}
		if($AR_TREE1['left_right'] == "R"){
			$Var3 = $AR_TREE1['member_id'];
		}
	endforeach;

}

if($Var2!=""){
	
	$QR_TREE2 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var2' AND (nleft>0 AND nright>0) ";
	$RS_TREE2 = $this->SqlModel->runQuery($QR_TREE2);
	foreach($RS_TREE2 as $AR_TREE2):
		if($AR_TREE2['left_right'] == "L"){
			$Var4 = $AR_TREE2['member_id'];
		}
		if($AR_TREE2['left_right'] == "R"){
			$Var5 = $AR_TREE2['member_id'];
		}
	
	endforeach;
	
}

if($Var3!=""){
	
	$QR_TREE3 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var3' AND (nleft>0 AND nright>0) ";
	$RS_TREE3 = $this->SqlModel->runQuery($QR_TREE3);
	foreach($RS_TREE3 as $AR_TREE3):
		if($AR_TREE3['left_right'] == "L"){
			$Var6 = $AR_TREE3['member_id'];
		}
		if($AR_TREE3['left_right'] == "R"){
			$Var7 = $AR_TREE3['member_id'];
		}
	endforeach;

}

if($Var4!=""){
	$QR_TREE4= "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var4' AND (nleft>0 AND nright>0) ";
	$RS_TREE4 = $this->SqlModel->runQuery($QR_TREE4);
	foreach($RS_TREE4 as $AR_TREE4):
		if($AR_TREE4['left_right'] == "L"){
			$Var8 = $AR_TREE4['member_id'];
		}
		if($AR_TREE4['left_right'] == "R"){
			$Var9 = $AR_TREE4['member_id'];
		}
	endforeach;
}

if($Var5!=""){
	$QR_TREE5= "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var5' AND (nleft>0 AND nright>0) ";
	$RS_TREE5 = $this->SqlModel->runQuery($QR_TREE5);
	
	foreach($RS_TREE5 as $AR_TREE5):
		if($AR_TREE5['left_right'] == "L"){
			$Var10 = $AR_TREE5['member_id'];
		}
		if($AR_TREE5['left_right'] == "R"){
			$Var11 = $AR_TREE5['member_id'];
		}
	endforeach;
	
}

if($Var6!=""){
	
	$QR_TREE6= "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var6' AND (nleft>0 AND nright>0) ";
	$RS_TREE6 = $this->SqlModel->runQuery($QR_TREE6);
	
	foreach($RS_TREE6 as $AR_TREE6):
		if($AR_TREE6['left_right'] == "L"){
			$Var12 = $AR_TREE6['member_id'];
		}
		if($AR_TREE6['left_right'] == "R"){
			$Var13 = $AR_TREE6['member_id'];
		}
	endforeach;
}

if($Var7!=""){
	
	$QR_TREE7= "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var7' AND (nleft>0 AND nright>0) ";
	$RS_TREE7 = $this->SqlModel->runQuery($QR_TREE7);
	
	foreach($RS_TREE7 as $AR_TREE7):
		if($AR_TREE7['left_right'] == "L"){
			$Var14 = $AR_TREE7['member_id'];
		}
		if($AR_TREE7['left_right'] == "R"){
			$Var15 = $AR_TREE7['member_id'];
		}
	endforeach;

}

if($Var8!=""){
	
	$QR_TREE8 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var8' AND (nleft>0 AND nright>0) ";
	$RS_TREE8  = $this->SqlModel->runQuery($QR_TREE8);
	
	foreach($RS_TREE8 as $AR_TREE8):
		if($AR_TREE8['left_right'] == "L"){
			$Var16 = $AR_TREE8['member_id'];
		}
		if($AR_TREE8['left_right'] == "R"){
			$Var17 = $AR_TREE8['member_id'];
		}
	endforeach;
	
}

if($Var9!=""){
	
	$QR_TREE9 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var9' AND (nleft>0 AND nright>0) ";
	$RS_TREE9  = $this->SqlModel->runQuery($QR_TREE9);
	
	foreach($RS_TREE9 as $AR_TREE9):
		if($AR_TREE9['left_right'] == "L"){
			$Var18 = $AR_TREE9['member_id'];
		}
		if($AR_TREE9['left_right'] == "R"){
			$Var19 = $AR_TREE9['member_id'];
		}
	endforeach;
	
}

if($Var10!=""){

	$QR_TREE10 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var10' AND (nleft>0 AND nright>0) ";
	$RS_TREE10  = $this->SqlModel->runQuery($QR_TREE10);
	
	foreach($RS_TREE10 as $AR_TREE10):
		if($AR_TREE10['left_right'] == "L"){
			$Var20 = $AR_TREE10['member_id'];
		}
		if($AR_TREE10['left_right'] == "R"){
			$Var21 = $AR_TREE10['member_id'];
		}
	endforeach;
	
}

if($Var11!=""){
	
	$QR_TREE11 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var11' AND (nleft>0 AND nright>0) ";
	$RS_TREE11  = $this->SqlModel->runQuery($QR_TREE11,true);
	
	foreach($RS_TREE11 as $AR_TREE11):
		if($AR_TREE11['left_right'] == "L"){
			$Var22 = $AR_TREE11['member_id'];
		}
		if($AR_TREE11['left_right'] == "R"){
			$Var23 = $AR_TREE11['member_id'];
		}
	endforeach;
	
}

if($Var12!=""){
	
	$QR_TREE12 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var12' AND (nleft>0 AND nright>0) ";
	$RS_TREE12  = $this->SqlModel->runQuery($QR_TREE12);
	
	foreach($RS_TREE12 as $AR_TREE12):
		if($AR_TREE12['left_right'] == "L"){
			$Var24 = $AR_TREE12['member_id'];
		}
		if($AR_TREE12['left_right'] == "R"){
			$Var25 = $AR_TREE12['member_id'];
		}
	endforeach;
	
}

if($Var13!=""){
	
	$QR_TREE13 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var13' AND (nleft>0 AND nright>0) ";
	$RS_TREE13  = $this->SqlModel->runQuery($QR_TREE13);
	
	foreach($RS_TREE13 as $AR_TREE13):
		if($AR_TREE13['left_right'] == "L"){
			$Var26 = $AR_TREE13['member_id'];
		}
		if($AR_TREE12['left_right'] == "R"){
			$Var27 = $AR_TREE13['member_id'];
		}
	endforeach;
	
}

if($Var14!=""){
	
	$QR_TREE14 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var14' AND (nleft>0 AND nright>0) ";
	$RS_TREE14  = $this->SqlModel->runQuery($QR_TREE14);
	
	foreach($RS_TREE14 as $AR_TREE14):
		if($AR_TREE14['left_right'] == "L"){
			$Var28 = $AR_TREE14['member_id'];
		}
		if($AR_TREE14['left_right'] == "R"){
			$Var29 = $AR_TREE14['member_id'];
		}
	endforeach;
	
}

if($Var15!=""){
	
	$QR_TREE15 = "SELECT * FROM ".prefix."tbl_mem_tree WHERE spil_id = '$Var15' AND (nleft>0 AND nright>0) ";
	$RS_TREE15  = $this->SqlModel->runQuery($QR_TREE15);
	
	foreach($RS_TREE15 as $AR_TREE15):
		if($AR_TREE15['left_right'] == "L"){
			$Var30 = $AR_TREE15['member_id'];
		}
		if($AR_TREE15['left_right'] == "R"){
			$Var31 = $AR_TREE15['member_id'];
		}
	endforeach;

}
 ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	
 <!--**********************************
            Content body start
        ***********************************-->
       <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
            	
               <div class="row">
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">  Genealogy View</h4>
                           </div>
                        </div>
                        <div class="iq-card-body">
                          
                           <div class="row">
            <div class="col-sm-12">
               <div class="card">
                
                <div class="card-body">
                <div class="row">
		 	<div class="col-md-8">
		
			 </div>
			 	<div class="col-md-4">
			 <div class="row visible-lg">
				 
<div class="col-4"><img src="<?php echo BASE_PATH; ?>assets/images/black1.png" alt="Empty" width="60px"><br>Empty</div>
<div class="col-4"><img src="<?php echo BASE_PATH; ?>assets/images/yellow1.png" alt="Register" width="60px"><br>Register</div>
<!--<div class="col-3"><img src="<?php echo BASE_PATH; ?>assets/images/red1.png" alt="Block" width="40px"><br>Block</div>-->
<div class="col-4"><img src="<?php echo BASE_PATH; ?>assets/images/green1.png" alt="Activate" width="60px"><br>Activate </div>
 
					</div></div>
					
					
					</div>
	<?php  get_message(); ?>
 
          <div class="table-responsive">
          
      
            <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" >
              
              <tr>
                <td colspan="17" align="center">&nbsp;</td>
              </tr>
           
              <tr>
                <td colspan="17" align="center">
					
						<?php $model->getNameStatus($Var1, $Var1, "");?>
					
                </td>
              </tr>
              <tr>
                <td colspan="17" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/images/line1.png" class="lines"></div></td>
              </tr>
              <tr>
                <td colspan="8" align="center"><?php $model->getNameStatus($Var2, $Var1, "L");?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
               <!-- <td width="1" rowspan="5" align="center"  style="background-image:url(<?php echo BASE_PATH; ?>assets/setupimages/arrow.gif)">&nbsp;</td>-->
                <td colspan="8" align="center"><?php $model->getNameStatus($Var3, $Var1, "R");?></td>
              </tr>
              <tr>
                <td colspan="8" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/images/line1.png" style="width:314px;" class="lines"></div></td>
               <td colspan="8" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/images/line1.png" style="width:314px;" class="lines"></div></td>
              </tr>
              <tr>
                <td  colspan="4" align="center"><?php $model->getNameStatus($Var4, $Var2, "L"); ?></td>
                <td colspan="4" align="center"><?php $model->getNameStatus($Var5, $Var2, "R"); ?></td>
                <td colspan="4" align="center"><?php $model->getNameStatus($Var6, $Var3, "L");?></td>
                <td colspan="4" align="center"><?php $model->getNameStatus($Var7, $Var3, "R");?></td>
              </tr>
              <tr class="treh">
               
                
                
                <td colspan="4" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/images/line1.png" style="width:130px;" class="lines"></div></td>
                <td colspan="4" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/images/line1.png" style="width:130px;" class="lines"></div></td>
               <td colspan="4" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/images/line1.png" style="width:130px;" class="lines"></div></td>
                <td colspan="4" align="center"><div><img id="Line1" src="<?php echo BASE_PATH; ?>assets/images/line1.png" style="width:130px;" class="lines"></div></td>
                
                
              </tr>
              <tr class="treh">
                <td  height="" colspan="2" align="center" valign="top"><?php $model->getNameStatus($Var8, $Var4, "L");?></td>
                <td colspan="2" align="center" valign="top"><?php $model->getNameStatus($Var9, $Var4, "R");?></td>
                <td colspan="2" align="center" valign="top"><?php $model->getNameStatus($Var10, $Var5, "L");?></td>
                <td  colspan="2" align="center" valign="top"><?php $model->getNameStatus($Var11, $Var5, "R");?></td>
                <td  colspan="2" align="center" valign="top"><?php $model->getNameStatus($Var12, $Var6, "L");?></td>
                <td  colspan="2" align="center" valign="top"><?php $model->getNameStatus($Var13, $Var6, "R");?></td>
                <td  colspan="2" align="center" valign="top"><?php $model->getNameStatus($Var14, $Var7, "L");?></td>
                <td  colspan="2" align="center" valign="top"><?php $model->getNameStatus($Var15, $Var7, "R");?></td>
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
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <!--**********************************
            Content body end
        ***********************************-->

	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>

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
