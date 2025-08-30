<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
$model = new OperationModel();
$today_date = getLocalTime();
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}



if($_GET['user_id']!=''){
	$user_id = FCrtRplc($_GET['user_id']);
	$StrWhr .=" AND ( M.user_id = '$user_id' )";
	$SrchQ .="&user_id=$user_id";
}
if($_GET['rank_id']!=''){
	$rank_id = FCrtRplc($_GET['rank_id']);
	$StrWhr .=" AND ( M.rank_id = '$rank_id' )";
	$SrchQ .="&rank_id=$rank_id";
}
if($_GET['order_id']!=''){
	$order_id = FCrtRplc($_GET['order_id']);
	$StrWhr .=" AND ( R.orderid = '$order_id' )";
	$SrchQ .="&order_id=$order_id";
}
if($_GET['trns_id']!=''){
	$trns_id = FCrtRplc($_GET['trns_id']);
	$StrWhr .=" AND ( R.txid = '$trns_id' )";
	$SrchQ .="&trns_id=$trns_id";
}

if($_GET['from_date']!='' && $_GET['to_date']!=''){
	$from_date = InsertDate($_GET['from_date']);
	$to_date = InsertDate($_GET['to_date']);
	$StrWhr .=" AND DATE(R.date) BETWEEN '$from_date' AND '$to_date'";
	$SrchQ .="&from_date=$from_date&to_date=$to_date";
}
  $QR_PAGES= "SELECT R.*,M.first_name as name , M.user_id as uid   FROM `tbl_money_transfer` as R LEFT JOIN tbl_members as M on M.member_id = R.member_id WHERE  R.sender_id > 0  and R.`sub_req` ='N'  and R.isDisplay = 'Y'  $StrWhr  order by  R.sender_id asc";
$PageVal = DisplayPages($QR_PAGES,50,$Page,$SrchQ); 
 
 ?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/header'); ?>
 
</head>
<body class="skin-2">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
  <div class="main-content">
    <div class="main-content-inner"> 
         <?php get_message(); ?>
      
      <div class="page-content">
        <div class="page-header">
          <h1> Transaction  <small> <i class="ace-icon fa fa-angle-double-right"></i> DMT Pending Transaction   </small> </h1>
          <a       class="pull-right " >	<button type="button" class="btn btn-info open_modal">Search</button></a> 
           <a    href="<?php  echo generateSeoUrlAdmin("transaction","home",''); ?>"  class="pull-right" >	<button type="button" class="btn btn-danger">Back</button></a>
        </div>
        
        
        <div class="space-12"></div>  <div class="space-12"></div>
         <div class="row">
			   
			
			   
			  
			   
	 <div class="col-xs-12">
	     <div class="table-responsive">
 <table id="no-more-tables" class="table table-striped table-bordered table-hover">
                 <thead>
                    <tr>
                        
                             <th  class="center"> S.no </th>
                            <th  class="center"> Date </th>
                            <th >User ID </th>
                            
                            <th>Name</th>
                            <th>Number/A/c</th>
                            <th>Beneficiary Id/IFSC</th>
                            
                            <!--<th >Amount</th>-->
                            <!-- <th >Charge</th>-->
                              <th >Total</th>
                            <th >Status</th>  
                            <!--<th >Action</th>-->
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=$PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):   //
						
			       ?>
                    <tr <?php if($AR_DT['status']=='Success'){echo 'class="success"';}else{ echo 'class="danger"';}?>>
                        <td data-title="Date"><?php echo $Ctrl; ?></td>
                      <td data-title="Date"><?php echo date('d-M-Y H:i:s',strtotime($AR_DT['date'])); ?></td>
 
                           <td data-title="User Id"> <a href="javascript:void(0);"   data-toggle="modal" data-target="#myModal<?php echo $Ctrl;?>" ><?php echo strtoupper($AR_DT['uid']); ?></a></td>
                      <td data-title="Name"><?php echo ($AR_DT['type'] =='1')?strtoupper($AR_DT['name']):strtoupper($AR_DT['ben_name']); ?> </td>
                       
                      
                      
                      
                        <td data-title="Number"><?php echo ($AR_DT['type'] =='1')? ($AR_DT['mobile']): ($AR_DT['account_number']);?> </td>
                    <td data-title="Beneficiary Id"><?php echo ($AR_DT['type'] =='1')? ($AR_DT['ben_id']):strtoupper($AR_DT['ifsc_code']); ?> </td>
                    
                       <!--<td data-title="Amount"><?php echo number_format($AR_DT['amount'],2); ?></td>-->
                       <!--<td data-title="Charge"><?php echo number_format($AR_DT['charge'],2); ?></td>-->
                       <td data-title="Total"><?php echo number_format($AR_DT['total'],2); ?></td>
                      
                      <td data-title="Status">  
                      <div id ="btn21<?php echo  $AR_DT['sender_id']; ?>">
                        <a onclick="hidebtn('btn21<?php echo  $AR_DT['sender_id']; ?>','btn22<?php echo  $AR_DT['sender_id']; ?>');" href="<?php echo BASE_PATH;?>superadmin/transaction/dmtPending/<?php echo  $AR_DT['sender_id']; ?>/APP"   class="btn btn-success   ">Approve</a> 
                        <a onclick="hidebtn('btn21<?php echo  $AR_DT['sender_id']; ?>','btn22<?php echo  $AR_DT['sender_id']; ?>');" href="<?php echo BASE_PATH;?>superadmin/transaction/dmtPending/<?php echo  $AR_DT['sender_id']; ?>/REJ"  class="btn btn-danger   " >Reject</a> 
                      </div>   
                      <div id="btn22<?php echo  $AR_DT['sender_id']; ?>" style="display:none;  text-align: center;"> <i class="fa fa-spinner fa-spin" style="font-size:20px ;   "></i> </div>
                         
                         </td>
                
                         
                       
                         
                         
                    </tr>
                    <?php $Ctrl++; 
						endforeach; 
						}else{ ?>
                    <tr>
                      <td colspan="11" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No transaction found</td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
                
                
                                <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=$PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):   //
						$member = $model->getmembersDetailss($AR_DT['member_id']);
						
					 
			       ?>
                <div class="modal fade " id="myModal<?php echo $Ctrl;?>" role="dialog">
<div class="modal-dialog">
<style>
    .centertable{width: 90%;
    margin-left: auto;
    margin-right: auto;}
    
    .namehdr{text-align: left;
    margin-left: 5px;
    font-weight: bolder;
    font-size: medium;
    color: #a66d4d;}
    .colnew{color: #a66d4d;}
     .trcol{ background-image: linear-gradient(to bottom,#575e82 0,#939fb9a3 100%)!important;}
    .aliceblue{color: aliceblue;}
    
    .modal-header .close {
    font-size: 22px;
}
</style>
<!--Report Modal content   rand3.jpg -->
<div class="modal-content"  >
 <div class="modal-header">
         <img src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>"  style="width: 27%;" alt="company logo" class="">
         <tag1 class="namehdr">      <?php echo strtoupper($member['first_name']);?>    [<?php echo strtoupper($member['user_id']);?>] </tag1>
        <button type="button" class="close amclose" data-dismiss="modal">&times;</button>
      </div>
<div class="modal-body am-body">
 
<!--<h4 class="header colnew bolder smaller"  style=" text-align:center;    margin-right: 5px;">      Member Details </h4>-->
 
 
 
 		<table class="table table-bordered centertable aliceblue">
 
    <tbody>
            <tr class="trcol" >
        <td><strong>Sponsor Id</strong></td>
        <td><?php echo  ($member['sid']);?>  </td>
      </tr> 
            <tr  class="trcol" >
            <td><strong>Sponsor Name</strong></td>
            <td><?php echo  ($member['sname']);?>  </td>
            </tr> 
            
            <tr  class="trcol" >
            <td><strong>Joining Date</strong></td>
            <td><?php echo  ($member['date_join']);?>  </td>
            </tr> 
            <tr  class="trcol" >
            <td><strong>Mobile Number</strong></td>
            <td><?php echo  ($member['member_mobile']);?>  </td>
            </tr> 

            <tr  class="trcol" >
            <td><strong>Active Date</strong></td>
            <td><?php echo  ($member['date_from']);?>  </td>
            </tr> 
            
            <tr  class="trcol" >
            <td><strong>Package Price</strong></td>
            <td><?php echo  ($member['package_price']);?>  </td>
            </tr> 
            
            <tr  class="trcol" >
            <td><strong>A/c Name</strong></td>
            <td><?php echo  ($member['bank_acct_holder']);?>  </td>
            </tr> 
              <tr  class="trcol" >
            <td><strong>A/c Number</strong></td>
            <td><?php echo  ($member['account_number'] );?>  </td>
            </tr> 
              <tr  class="trcol" >
            <td><strong>IFSC</strong></td>
            <td><?php echo  ($member['ifc_code']);?>  </td>
            </tr> 
              <tr  class="trcol" >
            <td><strong>PAN Number</strong></td>
            <td><?php echo  ($member['pan_no']);?>  </td>
            </tr> 
             <tr  class="trcol" >
            <td><strong>Aadhar Number</strong></td>
            <td><?php echo  ($member['adhar']);?>  </td>
            </tr> 
            
            </tbody>
            </table>
</div>

</div>

</div>
</div>
 <?php $Ctrl++; 
						endforeach; 
						} ?>
              </div> </div>
              <div class="clearfix">&nbsp;</div>
              <div class="row">
                <div class="col-xs-6">
                  <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries </div>
                </div>
                <div class="col-xs-6">
                  <div id="dynamic-table_paginate" class="dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                      <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                    </ul>
                  </div>
                </div>
              </div>
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    
      </div>
        
         
      
       
    </div>
  </div>
    </div>
    <div id="search-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="smaller lighter blue no-margin">Search</h3>
        </div>
        <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("transaction","dmtPending","");  ?>" autocomplete="off" method="get">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> User Id  :</label>
              <div class="col-sm-7">
                <input id="form-field-17" placeholder="User Id" name="user_id"  class="col-xs-10 col-sm-12  " type="text" value="<?php echo $_GET['user_id']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Rank Name  :</label>
              <div class="col-sm-7">
                  
                  <select  name="rank_id"  class="col-xs-10 col-sm-12 ">
                       <option value="" selected >Select Rank</option>
                      <option value="1" <?php if($_GET['rank_id']=='1'){echo "selected";} ?>>EAGLE</option>
                      <option value="2" <?php if($_GET['rank_id']=='2'){echo "selected";} ?>>LEADER</option>
                      <option value="3" <?php if($_GET['rank_id']=='3'){echo "selected";} ?>>TEAM LEADER</option>
                      <option value="4" <?php if($_GET['rank_id']=='4'){echo "selected";} ?>>MANAGER</option>
                      <option value="5" <?php if($_GET['rank_id']=='5'){echo "selected";} ?>>GENERAL MANAGER</option>
                      <option value="6" <?php if($_GET['rank_id']=='6'){echo "selected";} ?>>ZONAL MANAGER</option>
                      <option value="7" <?php if($_GET['rank_id']=='7'){echo "selected";} ?>>REGIONAL MANAGER</option>
                      <option value="8" <?php if($_GET['rank_id']=='8'){echo "selected";} ?>>NATIONAL MANAGER</option>
                      <option value="9" <?php if($_GET['rank_id']=='9'){echo "selected";} ?>>DIRECTOR</option>
                      <option value="10" <?php if($_GET['rank_id']=='10'){echo "selected";} ?>>ZONAL DIRECTOR</option>
                      <option value="11" <?php if($_GET['rank_id']=='11'){echo "selected";} ?>>REGIONAL DIRECTOR</option>
                      <option value="12" <?php if($_GET['rank_id']=='12'){echo "selected";} ?>>NATIONAL DIRECTOR</option>
                      <option value="13" <?php if($_GET['rank_id']=='13'){echo "selected";} ?>>GLOBAL DIRECTOR</option>
                      <option value="14" <?php if($_GET['rank_id']=='14'){echo "selected";} ?>>FOUNDER</option>
                     
                      
                      
                      
                  </select>
                  
                  
               
              </div>
            </div>
            
            <!--<div class="form-group">-->
            <!--  <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Transaction  Id  :</label>-->
            <!--  <div class="col-sm-7">-->
            <!--    <input id="form-field-16" placeholder="Transaction Id" name="trns_id"  class="col-xs-10 col-sm-12 " type="text" value="<?php echo $_GET['trns_id']; ?>">-->
            <!--  </div>-->
            <!--</div>-->
            
            
             
            
            
            
            
            
            
                       <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> From Date  :</label>
              <div class="col-sm-7">
 <input class="form-control col-xs-4 col-sm-3 col-md-6  date-picker" name="from_date" id="from_date" value="<?php echo $_GET['from_date']; ?>" type="date"  />
              </div>
            </div>
             
            
                     
            
            
            
            
                       <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> To Date  :</label>
              <div class="col-sm-7">
    <input class="form-control col-xs-4 col-sm-3 col-md-6 date-picker" name="to_date" id="to_date" value="<?php echo $_GET['to_date']; ?>" type="date"  />
              </div>
            </div>
             
               
     
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
            <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  
    <script type="text/javascript">
	$(function(){
		$(".open_modal").on('click',function(){
			$('#search-modal').modal('show');
			return false;
		});
	});
	
	function hidebtn(btnId,btnId2)
	{
	    document.getElementById(btnId).style.display = "none";
	    document.getElementById(btnId2).style.display = "block";
	}
</script>
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
     </div>
 

  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> 
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
</body>
</html>
