<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET['page']; if($Page=="" || $Page <=0 ){$Page=1;}
$wallet_id = $model->getWallet(WALLET1);
if($_GET['fullname']!=''){
	$fullname = FCrtRplc($_GET['fullname']);
	$StrWhr .=" AND ( tm.first_name LIKE '%$fullname%' OR tm.last_name LIKE '%$fullname%' OR tm.member_email LIKE '%$fullname%' )";
	$SrchQ .="&fullname=$fullname";
}

if($_GET['type_id']!=''){
	$type_id = FCrtRplc($_GET['type_id']);
	$StrWhr .=" AND ( tm.type_id = '$type_id' )";
	$SrchQ .="&type_id=$type_id";
}

if($_GET['status']!=''){
	$status = FCrtRplc($_GET['status']);
	$StrWhr .=" AND ( tm.courierstatus = '$status' )";
	$SrchQ .="&courierstatus=$status";
}


if($_GET['country_code']!=''){
	$country_code = FCrtRplc($_GET['country_code']);
	$StrWhr .=" AND ( tm.country_code LIKE '$country_code' )";
	$SrchQ .="&country_code=$country_code";
}
if($_GET['state_name']!=''){
	$state_name = FCrtRplc($_GET['state_name']);
	$StrWhr .=" AND ( tm.state_name LIKE '$state_name' )";
	$SrchQ .="&state_name=$state_name";
}
if($_GET['city_name']!=''){
	$city_name = FCrtRplc($_GET['city_name']);
	$StrWhr .=" AND ( tm.city_name LIKE '$city_name' )";
	$SrchQ .="&city_name=$city_name";
}

if($_GET['member_email']!=''){
	$member_email = FCrtRplc($_GET['member_email']);
	$StrWhr .=" AND ( tm.member_email LIKE '%$member_email%' )";
	$SrchQ .="&member_email=$member_email";
}

if($_GET['from_date']!='' && $_GET['to_date']!=''){
	$from_date = InsertDate($_GET['from_date']);
	$to_date = InsertDate($_GET['to_date']);
	$StrWhr .=" AND DATE(tm.date_join) BETWEEN '$from_date' AND '$to_date'";
	$SrchQ .="&from_date=$from_date&to_date=$to_date";
}

if($_GET['user_id']!=''){
	$user_id = FCrtRplc($_GET['user_id']);
	$StrWhr .=" AND ( tm.user_id = '$user_id' )";
	$SrchQ .="&user_id=$user_id";
}
//echo $StrWhr;die;

	 $url = $this->uri->segment(1);
if($url == 'superadmin')
{
$function = 'generateSeoUrlAdmin';
 $path =    ADMIN_PATH;
}
elseif($url =='courier')
{
    $function = 'generateSeoUrlCourier';
    $path = COURIER_PATH;
}
else
{
    $function = 'generateSeoUrlAdmin';
    $path =    ADMIN_PATH; 
}


if($_GET['block_sts']!=''){
	$block_sts = FCrtRplc($_GET['block_sts']);
	$StrWhr .=" AND ( tm.block_sts = '$block_sts' )";
	$SrchQ .="&block_sts=$block_sts";
}
$QR_PAGES="SELECT tm.* ,sub.date_from,sub.subcription_id as id,  CONCAT_WS('-',tm.mobile_code,tm.member_mobile) AS mobile_number, 
		 tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_name AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join , tpt.pin_name, tpt.mrp,tpt.prod_pv
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tree.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
		 LEFT JOIN ".prefix."tbl_subscription AS sub ON tm.member_id=sub.member_id
		 WHERE tm.delete_sts>0  AND tm.subcription_id>'0' and tm.tripot !='1'
		 $StrWhr GROUP BY tm.member_id   ORDER BY sub.subcription_id ASC";
$PageVal = DisplayPages($QR_PAGES,100, $Page, $SrchQ);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title><?php echo title_name(); ?></title>
<meta name="description" content="Static &amp; Dynamic Tables" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<!-- bootstrap & fontawesome -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datepicker3.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-timepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/daterangepicker.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap-datetimepicker.min.css" />
<!-- page specific plugin styles -->
<!-- text fonts -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/fonts.googleapis.com.css" />
<!-- ace styles -->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-skins.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-rtl.min.css" />
<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
<!-- inline styles related to this page -->
<!-- ace settings handler -->
<script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-extra.min.js"></script>
<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
<script type="text/javascript">
	$(function(){
		$(".open_modal").on('click',function(){
			$('#search-modal').modal('show');
			return false;
		});
	});
</script>
</head>
<body class="skin-2">
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu'); ?>
<div class="main-container ace-save-state" id="main-container">
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu'); ?>
  <div class="main-content">
    <div class="main-content-inner">
      <?php  $this->load->view(ADMIN_FOLDER.'/layout/breadcumb'); ?>
      <div class="page-content">
        <div class="page-header">
          <h1> SMS <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Setting </small> </h1>
          
          
          
           <div class="pull-right tableTools-container">
                      <div class="dt-buttons btn-overlap btn-group"> 
                                  <a href="javascript:void(0);" class="dt-button buttons-print btn btn-white btn-primary btn-bold" onClick="return validcheckstatus('arr_ids[]','Send SMS','Id');">SMS <i class="fa fa-envelope" aria-hidden="true"></i></a>
                      <!--<a href="<?php echo generateSeoUrlAdmin("member","addmember",array("")); ?>" title="" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-collection buttons-colvis btn btn-white btn-primary btn-bold"><span><i class="fa fa-plus bigger-110 blue"></i> <span class="hidden">Show/hide columns</span></span></a> -->
                      <a  class="dt-button buttons-copy buttons-html5 btn btn-white btn-primary btn-bold open_modal"><span><i class="fa fa-search bigger-110 pink"></i> <span class="hidden">Search</span></span></a> 
                      <!--<a  href="<?php echo generateSeoUrlAdmin("excel","member",""); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-database bigger-110 orange"></i> <span class="hidden">Export to CSV</span></span></a> 
                      <a aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-pdf buttons-flash btn btn-white btn-primary btn-bold"><span><i class="fa fa-file-pdf-o bigger-110 red"></i> <span class="hidden">Export to PDF</span></span> </a> -->
                      <a  onClick="window.print()" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-print btn btn-white btn-primary btn-bold"><span><i class="fa fa-print bigger-110 grey"></i> <span class="hidden">Print</span></span></a> </div>
                    </div>
          
          
          
        </div>
        <!-- /.page-header -->
        
        <div class="row">
             
              <a href="javascript:void(0);" data-toggle="modal" data-target="#update-modal" id="clickButton" style="display: none;" >SMS Message </a>

        </div>
        
        <div class="row">
          <?php get_message(); ?>
          <div class="col-xs-12">
            <div class="row">
              <div class="col-xs-12">
                <div class="clearfix">

                  
                </div>
                <div class="clearfix">&nbsp;</div>
                <div>
                    
                      <form action="<?php echo generateAdminForm("setting","smssetting","");  ?>" method="post">
                  <table id="" class="table">
                    <thead>
                         
                        <th>		
                        <!--<div class="checkbox">-->
													<label>
														<input name="form-field-checkbox" id="select-all" type="checkbox" class="ace">
														<span class="lbl"></span>
													</label>
												<!--</div>-->
												
												</th>
                        
                        <th>User Id</th>
                        <th>Name</th>
                      <th>Mobile No.</th>
                        <th>Package Price</th>
                       
                      
                        <!--<th>Action</th>-->
                    </thead>
                    <tbody>
                      <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  							    if($Page > 1)
						    {
						        $Page = ($Page -1)* 50 +1;
						    }
						    
						$Ctrl=$Page;
						foreach($PageVal['ResultSet'] as $AR_DT):
					
						
						
						//$AR_BAL = $model->getCurrentBalance($AR_DT['member_id'],$wallet_id,"","");
			       ?>
			       <tr class="success" style="font-size: 18px;">
			        
			       <td>
			 <!--<div class="checkbox">-->
													<label>
														<input name="arr_ids[]" value="<?php echo $AR_DT['member_mobile'];?>" type="checkbox" class="ace">
														<span class="lbl"></span>
													</label>
												<!--</div>-->
												
												</td>
			       
			       <td><?php echo $AR_DT['user_name']; ?></td>
			       <td><a href="javascript:void(0)"><?php echo $AR_DT['first_name']." ".$AR_DT['midle_name']." ".$AR_DT['last_name']; ?></a></td>
			       <td><?php echo $AR_DT['member_mobile']; ?></td>
			       <td><?php echo ($AR_DT['mrp']>0)? $AR_DT['mrp']:"---"; ?></td>
			
			       
			      
	<!--		       <td>-->
			       
			       
	<!--		       <div class="btn-group">-->
 <!--                           <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>-->
 <!--                           <ul class="dropdown-menu dropdown-default">-->
 <!--                               <li><a href="javascript:void(0);" data-toggle="modal" data-target="#update-modal<?php echo $AR_DT['id']; ?>">Update</a></li>-->
 <!--                            <?php    if($AR_DT['courierstatus'] =='H'){?>-->
 <!--                           <li> <a  onclick="alert('This Product has been hold ');" href="javascript:void(0);">Invoice</a> </li>-->
 <!--                            <li> <a  onclick="alert('This Product has been hold ');" href="javascript:void(0);">Courier</a> </li>-->
 <!--                           <?php } else { ?>-->
 <!--                           <li> <a  target="_blank" href="<?php echo $function("member","invoice",array("member_id"=>_e($AR_DT['member_id']))); ?>">Invoice</a> </li>-->
 <!--                           <li> <a  target="_blank" href="<?php echo $function("member","courier",array("member_id"=>_e($AR_DT['member_id']))); ?>">Courier</a> </li>	-->
                            
 <!--                           <?php } ?>-->
 <!--</ul>-->
 <!--                         </div>-->
			       
			       
	<!--		       </td>-->
			        </tr>
			        <div class="clearfix"></div>
      
                
                      <?php $Ctrl++; endforeach; }else{ ?>
                      <tr>
                        <td colspan="6" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                  
                      <div class="modal fade" id="update-modal" role="dialog">
    <div class="modal-dialog modal-sm">
      
      <div class="modal-content">
        <div class="modal-header" style="background-color: #438EB9; color: white;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Message Box </h4>
        </div>
        <div class="modal-body">
            <input type="hidden" name="page" value="<?php echo $_GET['page'];?>">
                        <input type="hidden" name="memid"value="<?php echo $AR_DT['member_id'];?>">
						
	        <label>Message</label><textarea class="form-control" name="textmsg" placeholder="Write your Message Here..."></textarea>
								
       
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" value="1" name="submitdata">Send Message</button>
        </div>
      </div>
    
    
    </div>
  </div>
  
  </form>
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
            <!-- PAGE CONTENT ENDS -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.page-content -->
    </div>
  </div>
  <div id="search-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h3 class="smaller lighter blue no-margin">Search</h3>
        </div>
        <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo generateAdminForm("setting","smssetting","");  ?>" method="get">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Name / Email Address  :</label>
              <div class="col-sm-7">
                <input id="form-field-1" placeholder="Name / Email" name="fullname"  class="col-xs-10 col-sm-12 validate[required]" type="text" value="<?php echo $_GET['fullname']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> User Id  :</label>
              <div class="col-sm-7">
                <input id="form-field-1" placeholder="User Id" name="user_id"  class="col-xs-10 col-sm-12 validate[required]" type="text" value="<?php echo $_GET['user_id']; ?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Member Status   :</label>
              <div class="col-sm-7">
                <input type="radio" name="block_sts" id="block_sts" <?php if($_GET['block_sts']=="Y"){ echo 'checked="checked"'; } ?>  value="Y">
                Block &nbsp;&nbsp;
                <input type="radio" name="block_sts" id="block_sts" value="N" <?php if($_GET['block_sts']=="N"){ echo 'checked="checked"'; } ?> >
                Un-Block </div>
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
  <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true
		});
		$("#form-valid").validationEngine();
		$("#form-valid").validationEngine();
		$(".getStateList").on('blur',getStateList);
		$(".getCityList").on('blur',getCityList);
		function getStateList(){
			var country_code = $("#country_code").val();
			var URL_STATE = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=STATE_LIST&country_code="+country_code;
			$("#state_name").load(URL_STATE);
		}
		function getCityList(){
			var state_name = $("#state_name").val();
			var URL_CITY = "<?php echo ADMIN_PATH; ?>json/jsonhandler?switch_type=CITY_LIST&state_name="+state_name;
			$("#city_name").load(URL_CITY);
		}
	});
	
	$('#select-all').click(function(event) {   
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;                       
        });
    }
});





function validcheckstatus(name,action,text)
{
	var chObj	=	document.getElementsByName(name);
	var result	=	false;	
	for(var i=0;i<chObj.length;i++){
	
		if(chObj[i].checked){
		  result=true;
		  break;
		}
	}
 
	if(!result){
		 alert("Please select atleast one "+text+" to "+action+".");
		 return false;
	}
    else{
 
 document.getElementById('clickButton').click();
            
    
	}
}
</script>
</body>
</html>



