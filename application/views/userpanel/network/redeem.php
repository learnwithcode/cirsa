<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	
	$from_date = InsertDate($segment['from_date']);
	$to_date = InsertDate($segment['to_date']);
	
	$yester_date = InsertDate(AddToDate($today_date,"-1 Day"));
	$member_id = $this->session->userdata('mem_id');
	
	$AR_SELECT = $model->getMember($member_id);
	$member_mobile  =  $AR_SELECT['member_mobile'];

// 	$QR_PAGE = "SELECT tm.member_id,tm.user_id,tm.first_name, CONCAT_WS('',tm.mobile_code,tm.member_mobile) AS mobile_number, 
// 	     tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
// 		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, ts.subcription_id, ts.date_from, ts.date_expire , 
// 		 tpt.pin_name, tpt.pin_price
// 		 FROM ".prefix."tbl_members AS tm	
// 		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
// 		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
// 		 LEFT JOIN ".prefix."tbl_subscription AS ts ON ( ts.member_id=tm.member_id )
// 		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=ts.type_id
// 		 WHERE tm.sponsor_id='".$member_id."' and tm.member_id in (select member_id from tbl_subscription where active_type_id > 1 ) and tm.sponsor_id in (select member_id from tbl_subscription where active_type_id > 1 )
// 		 AND tm.delete_sts>0 
// 		 $StrLeft  $StrWhr 
// 		 GROUP BY tm.member_id
// 		 ORDER BY tm.date_join DESC";


//   $QR_PAGE = "SELECT m.member_id , m.`user_id`,m.`first_name`, s.date_from FROM `tbl_members` as m LEFT JOIN tbl_subscription as s on s.member_id = m.member_id WHERE m.member_mobile ='$member_mobile' AND m.sponsor_id ='$member_id'";
//   $PageVal = DisplayPages($QR_PAGE, 50, $Page, $SrchQ);


	$QR_PAGE = "select s.member_id,m.user_id , m.first_name ,m.last_name ,s.date_from from tbl_subscription as s LEFT JOIN tbl_members as m on m.member_id = s.member_id where s.`bulk_by` ='$member_id'";
	$PageVal = DisplayPages($QR_PAGE, 50, $Page, $SrchQ);
	
?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	
	<style>
	    .apx-toolbar {
    position: absolute;
    z-index: 11;
    top: 0px;
    right: 3px;
    max-width: 240px;
    text-align: right;
    border-radius: 3px;
    padding: 0px 6px 2px 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
	</style>
<div class="content-page rtl-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="card">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Super Referral &nbsp;||&nbsp;</h4>
                        	<div class="form-actions apx-toolbar">
									 <button type="submit" name="buttonRequest" class="  btn btn-primary" onclick="redeemwallet('<?php echo $AR_DT['user_id'];?>','All');">
	                                <i class="fa fa-check-square-o"></i> Retrieve Pocket All
	                            </button>
	                            
	                        
									</div>
                     </div>
                  </div>
                  <div class="card-body">
                     <p class="card-text"> 
 Available USD : $ <?php echo number_format($LDGR['net_balance'],2); ?></code> </p>
                     <div class="table-responsive">
                        <table id="datatable" class="table  table-striped table-bordered" >
     <thead>
                       <tr>
                            <th>S.No.</th>
                            
                            <th>User Id</th>
                            <th>Name</th>
                           
                            
                           
                            <th>Activate Date</th>
                            <th>Elite Global Wallet</th>
						 
                            <th>Retrieve</th>                           
                        </tr>

                            
</thead>
                                       <tbody>
				<?php   if($PageVal['TotalRecords'] > 0){
				$Ctrl=$PageVal['RecordStart']+1;
				foreach($PageVal['ResultSet'] as $AR_DT):  
			 	$LDGR = $model->getCurrentBalance($AR_DT['member_id'],'1',$_REQUEST['from_date'],$_REQUEST['to_date']);
				?>
              <tr   >
                <td class=""><?php echo $Ctrl; ?></td>
              
                <td><?php echo $AR_DT['user_id']; ?></td>
                <td><?php echo $AR_DT['first_name']; ?> <?php echo $AR_DT['last_name']; ?></td>
               
               
                <td><?php echo DisplayDate($AR_DT['date_from']); ?></td>
                <td>$ <?php echo number_format($LDGR['net_balance'],2); ?></td>
               <td>  <button type="submit" name="buttonRequest" class="btn btn-primary" onclick="redeemwallet('<?php echo $AR_DT['user_id'];?>','Single');">
	                                <i class="fa fa-check-square-o"></i> Retrieve Now
	                            </button></td>
                
              </tr>
              <?php $Ctrl++;
			   endforeach;	}else{
									?>
									<tr class="odd" role="row">
										<td colspan="10" align="center">No transaction found</td>
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
	
	
 
	
	
                                    <input type="hidden" id="btnval" value="1">
               <script>
	   
    
    
    function redeemwallet(userId,type)
    {
        
        var btn = document.getElementById("btnval").value;
        if(btn =='1')
        {
            btn = document.getElementById("btnval").value=2;
         $(document).ready(function() {
 
    
    
    jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "member/network/redeemWallet",
data: {userId:userId, type:type},
success: function(res) {
//  alert(res);
<?php sleep(5);?>
 window.location.href='<?php echo BASE_PATH; ?>member/retrieve-pocket';
 

} });  

    
});
        }
        else
        {
            alert("You have already click the Redeem button. Please wait ...");
        }
    }
    
    
    

	</script>
               
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>