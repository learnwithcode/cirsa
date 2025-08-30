<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$Page = $_GET['page']; if($Page=="" || $Page <=0 ){$Page=1;}
$wallet_id = $model->getWallet(WALLET1);
if($_REQUEST['fullname']!=''){
	$fullname = FCrtRplc($_REQUEST['fullname']);
	$StrWhr .=" AND ( tm.first_name LIKE '%$fullname%' OR tm.last_name LIKE '%$fullname%' OR tm.member_email LIKE '%$fullname%' )";
	$SrchQ .="&fullname=$fullname";
}

if($_REQUEST['type_id']!=''){
	$type_id = FCrtRplc($_REQUEST['type_id']);
	$StrWhr .=" AND ( tm.type_id = '$type_id' )";
	$SrchQ .="&type_id=$type_id";
}
if($_REQUEST['country_code']!=''){
	$country_code = FCrtRplc($_REQUEST['country_code']);
	$StrWhr .=" AND ( tm.country_code LIKE '$country_code' )";
	$SrchQ .="&country_code=$country_code";
}
if($_REQUEST['state_name']!=''){
	$state_name = FCrtRplc($_REQUEST['state_name']);
	$StrWhr .=" AND ( tm.state_name LIKE '$state_name' )";
	$SrchQ .="&state_name=$state_name";
}
if($_REQUEST['city_name']!=''){
	$city_name = FCrtRplc($_REQUEST['city_name']);
	$StrWhr .=" AND ( tm.city_name LIKE '$city_name' )";
	$SrchQ .="&city_name=$city_name";
}

if($_REQUEST['member_email']!=''){
	$member_email = FCrtRplc($_REQUEST['member_email']);
	$StrWhr .=" AND ( tm.member_email LIKE '%$member_email%' )";
	$SrchQ .="&member_email=$member_email";
}

if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
	$from_date = InsertDate($_REQUEST['from_date']);
	$to_date = InsertDate($_REQUEST['to_date']);
	$StrWhr .=" AND DATE(tm.date_join) BETWEEN '$from_date' AND '$to_date'";
	$SrchQ .="&from_date=$from_date&to_date=$to_date";
}

if($_REQUEST['user_id']!=''){
	$user_id = FCrtRplc($_REQUEST['user_id']);
	$StrWhr .=" AND ( tm.user_id = '$user_id' )";
	$SrchQ .="&user_id=$user_id";
}
if($_REQUEST['block_sts']!=''){
	$block_sts = FCrtRplc($_REQUEST['block_sts']);
	$StrWhr .=" AND ( tm.block_sts = '$block_sts' )";
	$SrchQ .="&block_sts=$block_sts";
}
$QR_PAGES="SELECT tm.* ,  CONCAT_WS('-',tm.mobile_code,tm.member_mobile) AS mobile_number, 
		 tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_name AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join , tpt.pin_name, tpt.mrp
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tree.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
		 WHERE tm.delete_sts>0  AND tm.type_id>'0'
		 $StrWhr GROUP BY tm.member_id   ORDER BY tm.member_id ASC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);

 ?>
 
 <?php get_message(); ?>
          
                  <table id="" class="table">
                    <thead>
                    </thead>
                    <tbody>
                      <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):
						
						$AR_BAL = $model->getCurrentBalance($AR_DT['member_id'],$wallet_id,"","");
			       ?>
                      <tr>
                        <td width="22" rowspan="4" class="center"><label class="pos-rel"> <?php echo $AR_DT['member_id']; ?> <span class="lbl"></span> </label>
                        </td>
                        <td width="112">Full Name : </td>
                        <td width="148"><a href="javascript:void(0)"><?php echo $AR_DT['first_name']." ".$AR_DT['last_name']; ?></a></td>
                        <td width="126">Sponsor ID : </td>
                        <td width="120"><?php echo ($AR_DT['spsr_user_id']!='bitcoinwealth')? $AR_DT['spsr_user_id']:"Admin"; ?></td>
                        <td width="140">Password : </td>
                        <td width="164"><?php echo $AR_DT['user_password']; ?></td>
                        <td width="90" rowspan="3"><div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-primary btn-white dropdown-toggle"> Action <span class="ace-icon fa fa-caret-down icon-on-right"></span> </button>
                            <ul class="dropdown-menu dropdown-default">
                              <li> <a href="<?php echo generateSeoUrlAdmin("member","profile",array("member_id"=>_e($AR_DT['member_id']))); ?>">View</a> </li>
                              <li> <a href="<?php echo generateSeoUrlAdmin("member","updatemember",array("member_id"=>_e($AR_DT['member_id']))); ?>">Edit</a> </li>
                              <li> <a target="_blank" href="<?php echo generateSeoUrlAdmin("member","directaccesspanel",array("user_id"=>$AR_DT['user_id'])); ?>">Access Panel</a> </li>
                              <li> <a target="_blank" href="<?php echo generateSeoUrlAdmin("member","kyc",array("member_id"=>_e($AR_DT['member_id']))); ?>">KYC</a> </li>
                              <li> <a onClick="return confirm('Make sure , you want to change this R.O.I status?')" href="<?php echo generateSeoUrlAdmin("member","profile",array("member_id"=>_e($AR_DT['member_id']),"action_request"=>"BLOCK_UNBLOCK_ROI","roi_sts"=>$AR_DT['roi_sts'])); ?>"><?php echo ($AR_DT['roi_sts']=="N")? "Block R.O.I":"Un-Block R.O.I"; ?></a> </li>
                              <li> <a onClick="return confirm('Make sure , you want to change this member status?')" href="<?php echo generateSeoUrlAdmin("member","profile",array("member_id"=>_e($AR_DT['member_id']),"action_request"=>"BLOCK_UNBLOCK","block_sts"=>$AR_DT['block_sts'])); ?>"><?php echo ($AR_DT['block_sts']=="N")? "Block":"Un-block"; ?></a> </li>
                              <li> <a onClick="return confirm('Make sure , you want to change this member status?')" href="<?php echo generateSeoUrlAdmin("member","profile",array("member_id"=>_e($AR_DT['member_id']),"action_request"=>"STATUS")); ?>"><?php echo ($AR_DT['status']=="N")? "Resume":"Suspend"; ?></a> </li>
                              <!--<li> <a onClick="return confirm('Make sure, want to delete this member')" href="<?php echo generateSeoUrlAdmin("member","deletemember",array("member_id"=>$AR_DT['member_id'])); ?>">Delete</a> </li>-->
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td>UserName : </td>
                        <td><?php echo $AR_DT['user_name']; ?></td>
                        <td>Email Address : </td>
                        <td><?php echo $AR_DT['member_email']; ?></td>
                        <td>Status : </td>
                        <td><?php 
                        
                			$AR_TYPE  = $model->getCurrentMemberShip($AR_DT['member_id']);
                			$pain_name = ($AR_TYPE['pin_name'])? $AR_TYPE['pin_name']:"Free";
                			
                		    if($pain_name == 'FREE'){
		                        echo "In-Active"; 
		                    }
		                    elseif($pain_name =='Silver' || $pain_name =='Gold' || $pain_name=='Diamond'){
    		                    echo "Active"; 
                    	    }
                		    else{
                		        echo "In-Active"; 
                		    }
                            ?></td>
                      </tr>
                      <tr>
                        <td>Mobile : </td>
                        <td><?php echo $AR_DT['mobile_number']; ?></td>
                        <td>Location : </td>
                        <td><?php echo $AR_DT['current_address']." ".$AR_DT['city_name']." ".$AR_DT['state_name']; ?></td>
                        <td>Plan Detail : </td>
                        <td><?php echo ($AR_DT['pin_name']!='')? $AR_DT['pin_name']:"Free"; ?></td>
                      </tr>
                      <tr>
                        <td>D.O.J : </td>
                        <td><?php echo $AR_DT['date_join']; ?></td>
                        <td>Total Earning : </td>
                        <td><?php echo number_format($AR_BAL['net_balance'],2); ?></td>
                        <td>Pacakage Name : </td>
                        <td><?php echo ($AR_DT['mrp']>0)? $AR_DT['mrp']:"---"; ?></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="8" class="center"><hr class="divider">
                          </hr></td>
                      </tr>
                      <?php $Ctrl++; endforeach; }else{ ?>
                      <tr>
                        <td colspan="8" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
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




<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>


<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>

<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>

<div class="main-content">
<div class="main-content-inner">


<div class="page-content">

<div class="row">
<div class="col-xs-12">
<?php $this->load->view(MEMBER_FOLDER.'/layout/headermenu'); ?>								

<div class="row">
<div class="col-xs-12">
<h3 class="header smaller lighter blue">Income Report</h3>

<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">
Turbo Income									</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer table-responsive">

<table id="dynamic-table" class="table table-striped table-bordered table-hover">
 <thead>
                      <tr>
                          <th>Sn.</th>
                          <th>Date</th>
                          <th>From Member Id </th>
                          <th>Amount</th>
                         <!-- <th>Admin Charge</th>
                          <th>TDS</th>
                          <th>Repurchase Detection</th>-->
                          <th>Net Income</th>
                        </tr>
                    </thead>
                           
                                  <tbody>
						           <?php 
								if($PageVal['TotalRecords'] > 0){
								$Ctrl=$PageVal['RecordStart']+1;
							//	echo "<pre>";print_r($PageVal['ResultSet']);die;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                <tr class="odd" role="row">
                                    <td class=""><?php echo $Ctrl;$Ctrl++; ?></td>
                                      <td class=""><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                      <td><?php echo $AR_DT['user_id']; ?></td>
                                      <td><?php echo number_format($AR_DT['total_income'],2); ?></td>
                                      <!--<td><?php echo number_format($AR_DT['admin_charge'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['tds'],2); ?></td>
                                      <td><?php echo number_format($AR_DT['repurchase_detection'],2); ?></td>-->
                                      <td><?php echo number_format($AR_DT['net_income'],2); ?></td>
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

<div class="row"><div class="col-xs-6"><div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries</div></div>

<div class="col-xs-6">
<div class="dataTables_paginate paging_simple_numbers" id="dynamic-table_paginate">
 <ul class="pagination">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul>
								  
								  </div></div></div>




</div>
<!-- PAGE CONTENT ENDS -->
</div><!-- /.col -->
</div><!-- /.row -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
<script src="<?php echo BASE_PATH;?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/dataTables.buttons.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.flash.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.html5.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.print.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/buttons.colVis.min.js"></script>
<script src="<?php echo BASE_PATH;?>assets/js/dataTables.select.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
jQuery(function($) {
//initiate dataTables plugin
var myTable = 
$('#dynamic-table')
//.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
.DataTable( {
bAutoWidth: false,
"aoColumns": [
{ "bSortable": false },
null, null,null, null, null,
{ "bSortable": false }
],
"aaSorting": [],


select: {
style: 'multi'
}
} );



$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

new $.fn.dataTable.Buttons( myTable, {
buttons: [

{
"extend": "colvis",
"text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
"className": "btn btn-white btn-primary btn-bold",
columns: ':not(:first):not(:last)'
},
{
"extend": "copy",
"text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
"className": "btn btn-white btn-primary btn-bold"
},
{
"extend": "csv",
"text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
"className": "btn btn-white btn-primary btn-bold"
},
{
"extend": "excel",
"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
"className": "btn btn-white btn-primary btn-bold"
},
{
"extend": "pdf",
"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
"className": "btn btn-white btn-primary btn-bold"
},
{
"extend": "print",
"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
"className": "btn btn-white btn-primary btn-bold",
autoPrint: false,
message: 'This print was produced using the Print button for DataTables'
}		  
]
} );
myTable.buttons().container().appendTo( $('.tableTools-container') );

//style the message box
var defaultCopyAction = myTable.button(1).action();
myTable.button(1).action(function (e, dt, button, config) {
defaultCopyAction(e, dt, button, config);
$('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
});


var defaultColvisAction = myTable.button(0).action();
myTable.button(0).action(function (e, dt, button, config) {

defaultColvisAction(e, dt, button, config);


if($('.dt-button-collection > .dropdown-menu').length == 0) {
$('.dt-button-collection')
.wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
.find('a').attr('href', '#').wrap("<li />")
}
$('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
});

////

setTimeout(function() {
$($('.tableTools-container')).find('a.dt-button').each(function() {
var div = $(this).find(' > div').first();
if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
else $(this).tooltip({container: 'body', title: $(this).text()});
});
}, 500);





myTable.on( 'select', function ( e, dt, type, index ) {
if ( type === 'row' ) {
$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
}
} );
myTable.on( 'deselect', function ( e, dt, type, index ) {
if ( type === 'row' ) {
$( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
}
} );




/////////////////////////////////
//table checkboxes
$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

//select/deselect all rows according to table header checkbox
$('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
var th_checked = this.checked;//checkbox inside "TH" table header

$('#dynamic-table').find('tbody > tr').each(function(){
var row = this;
if(th_checked) myTable.row(row).select();
else  myTable.row(row).deselect();
});
});

//select/deselect a row when the checkbox is checked/unchecked
$('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
var row = $(this).closest('tr').get(0);
if(this.checked) myTable.row(row).deselect();
else myTable.row(row).select();
});



$(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
e.stopImmediatePropagation();
e.stopPropagation();
e.preventDefault();
});



//And for the first simple table, which doesn't have TableTools or dataTables
//select/deselect all rows according to table header checkbox
var active_class = 'active';
$('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
var th_checked = this.checked;//checkbox inside "TH" table header

$(this).closest('table').find('tbody > tr').each(function(){
var row = this;
if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
});
});

//select/deselect a row when the checkbox is checked/unchecked
$('#simple-table').on('click', 'td input[type=checkbox]' , function(){
var $row = $(this).closest('tr');
if($row.is('.detail-row ')) return;
if(this.checked) $row.addClass(active_class);
else $row.removeClass(active_class);
});



/********************************/
//add tooltip for small view action buttons in dropdown menu
$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

//tooltip placement on right or left
function tooltip_placement(context, source) {
var $source = $(source);
var $parent = $source.closest('table')
var off1 = $parent.offset();
var w1 = $parent.width();

var off2 = $source.offset();


if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
return 'left';
}

$('.show-details-btn').on('click', function(e) {
e.preventDefault();
$(this).closest('tr').next().toggleClass('open');
$(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
});

})
</script>
</body>
</html>                