<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$wallet_id = 3;
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(twt.trns_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	$member = $model->getmemberContact($member_id);
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);
	$QR_PAGES="SELECT * FROM `tbl_subscription` WHERE `member_id` = '$member_id' ORDER BY `subcription_id` DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
	    $LDGR = $model->getCurrentBalance($member_id,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
	$LDGR2 = $model->getCurrentBalance($member_id,'2',$_REQUEST['from_date'],$_REQUEST['to_date']);
	$LDGR3 = $model->getCurrentBalance($member_id,'3',$_REQUEST['from_date'],$_REQUEST['to_date']);
	
?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	<style>
	    .centerimg {
  display: block;
  margin-left: auto;
  margin-right: auto; 
  width: 60%;
}
	</style>
<div class="content-page rtl-page">
      <div class="container-fluid">
          
           
                     
          <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Upgrade Your User ID</h4>
                     </div>
                  </div>
                  <div class="card-body">
                    
                    
                      <div class="col-lg-12">
                	<?php echo get_message(); ?>
                	</div>
                    <form action="<?php  echo  generateMemberForm("account","retopupId"); ?>"   method="post">
        <div class="modal-body">
  
	                        <div class="mb-3">
                            <label class="mb-1"><strong>Package</strong></label>
                                <select  name="type_id" id="type_idEG" class="form-control" required  onchange="setPocketUse();" >
                                <option value="">Select Subscription </option>
                                <?php echo DisplayCombo($_GET['type_id'],"RPIN_TYPE"); ?>
                                </select>
                            </div>     
                            
                            <div class="mb-3">
                            <label class="mb-1"><strong>Elite Global Pocket (EGP <?php echo number_format($LDGR['net_balance'],2);?>)</strong></label>
                            <input  autocomplete="off" id="GP_MU_TEXT" name="GP_MU_TEXT" class="form-control" type="text" placeholder="Maximum 50%" onKeyUp="setPockets('GPS');"   >
                            <code id="GPMU_ID"></code>
                            </div> 
                            
                            <div class="mb-3">
                            <label class="mb-1"><strong>Elite Static Pocket (ESP <?php echo number_format($LDGR3['net_balance'],2);?>)</strong></label>
                            <input  autocomplete="off" id="SP_MU_TEXT"  name="SP_MU_TEXT" class="form-control" type="text"  placeholder="Minimum 50%" onKeyUp="setPockets('SPS');" >
                             <code id="SPMU_ID"></code>
                            </div> 
                            
                            
                            
						    <div class="mb-3">
                            <label class="mb-1"><strong>Member Id</strong></label>
                                <input  placeholder="Member Id" id="mem_id" name="member_id" autocomplete="off" onchange="check_members(this.value);" class="form-control" type="text" value="" required>
                            </div>  
	 	 	 
						    <div class="mb-3">
                            <label class="mb-1"><strong>Member Name</strong></label>
                                <input  placeholder="Member Name" id="user_name" name="member_name"   style=" border-color:#38383a!important;"  readonly class="form-control" type="text" value="">
                            </div> 
						   
                            <div class="mb-3">
                            <label class="mb-1"><strong>Login Password</strong></label>
                            <input class="form-control" name="trns_password" id="" type="password" placeholder="Login Password" required>
                            </div> 
     
      
     
 </div>
    <div class="modal-footer"> 
    
    	<?php if($model->getValue("member_activation_on_off")=='Y' or   $sts =='N'){ ?>
	 
		
	        	<input type="hidden" name="upgradeMemberShip" value="1" />
		
	                            <button type="reset" class="btn btn-warning mr-1">
	                            	<i class="ft-reset"></i> Reset
	                            </button>
	                            <button type="submit" name="buttonRequest" class="btn btn-primary">
	                              	<i class="ace-icon fa fa-cloud-upload icon-on-right"></i>Upgrade
	                            </button>
	                       
	                        <?php }?> 
  </div>

          </form>
                  <script>
     function setPocketUse()
     {
       
            var val = document.getElementById("type_idEG").value;
            if(val == 15)
            {
             var total = 100;   
            }
            if(val ==16)
            {
             var total = 300;   
            }
            if(val ==17)
            {
             var total = 700;   
            }
            if(val ==18)
            {
             var total = 1500;   
            }
            if(val ==19)
            {
             var total = 3100;   
            }
            if(val ==20)
            {
             var total = 6300;   
            }
            if(val ==21)
            {
             var total = 12700;   
            }
            var GP = total/2;
            var SP = total;
            
            document.getElementById("GP_MU_TEXT").placeholder ="Maximum use "+GP+" EGP";
            document.getElementById("SP_MU_TEXT").placeholder ="Maximum use "+SP+" ESP";
             
      
                          
     }
     
     function setPockets(types)
     {
               var mu =  document.getElementById("mu").value; 
               
               if(mu > 0 )
               {
                   
                    var GP_MU_TEXT =  document.getElementById("GP_MU_TEXT").value;    
                    var SP_MU_TEXT =  document.getElementById("SP_MU_TEXT").value;     
                    
                     var GP_V  = '<?php echo $LDGR['net_balance'];?>';
                     var SP_V  = '<?php echo $LDGR['net_balance'];?>';
                     
                    if(types =='GPS')
                    {
                    //   if((parseInt(GP_MU_TEXT + SP_MU_TEXT)  ) > parseInt(mu)
                    //   {
                    //     document.getElementById("GPMU_ID").innerHTML ="invalid enter MU";  
                    //     document.getElementById("GP_MU_TEXT").value = ''; 
                    //   }
                    //   else
                    //   {
                    //     document.getElementById("GPMU_ID").innerHTML ="";     
                    //   }
                    }
                    
                    
                    if(types =='SPS')
                    {
                     
                    }
                    
                    let GP = mu;
                    let SP = mu/2; 
               }
               else
               {
                        document.getElementById("GP_MU_TEXT").value = ''; 
                        document.getElementById("SP_MU_TEXT").value = ''; 
                        document.getElementById("errorShow").innerHTML = '<div class="alert alert-danger mg-b-0" role="alert"> <strong>Please Enter subcription amount ! </strong>   </div>';   
               }
               
               
     }
 </script> 
                     
                      <script>
                                function check_member(id)
                                {
                                
                                jQuery.ajax({
                                type: "POST",
                                url: "<?php echo BASE_PATH; ?>" + "member/account/check_user",
                                data: {mem: id},
                                success: function(res) {
                                document.getElementById("name").value=res;
                                
                                }
                                });
                                }
                                
                                </script>
                      <script>
	   function check_members(id)
{

	  jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/account/check_user",
data: {mem: id},
success: function(res) {
document.getElementById("user_name").value=res;

}
});
}

	   </script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Activation / Upgrade History</h4>
                     </div>
                  </div>
                  <div class="card-body">
                  
                     <div class="table-responsive">
                        <table id="datatable" class="table  table-striped table-bordered" >
 
		  
   <thead>
                       <tr>
                            <th>S.No.</th>
                            <th>Txn Id</th>
                            <th>Type</th>
                             <th>Package</th>
                            
                           
                                
                            <th>Date</th>
                           
                        </tr>

                            
</thead>
   <tbody>  <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl= $PageVal['RecordStart']+1; 
								 
									foreach($PageVal['ResultSet'] as $AR_DT):
									    
									   $mrp = $model->getMRPofPackage($AR_DT['active_type_id']); 
									   
									 ?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $Ctrl;$Ctrl++;?></td>
                                        <td><?php echo $AR_DT['order_no']; ?></td>
                                      <td class="sorting_1">  <?php echo    ($AR_DT['type'] =='A') ? 'Activate':'Upgrade' ; ?></td>
                                       <td class="sorting_1">$&nbsp;<?php echo number_format($AR_DT['package_price']); ?>/$&nbsp;<?php echo number_format($mrp); ?></td>
                                      
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['date_from']); ?></td>
                                     
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="6" align="center">No transaction found</td>
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

               
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>