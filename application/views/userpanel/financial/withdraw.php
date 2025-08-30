<?php 
	defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();	
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	$processor_id = $model->getDefaultProcessor();
	$AR_PROC = $model->getProcessor($processor_id);


	$member_id = $this->session->userdata('mem_id');
	$AR_MEM = $model->getMember($member_id);
	
	$bitcoin_ctrl = ($AR_MEM['bitcoin_address']!='')? "1" :0;
	$option_ctrl += $bitcoin_ctrl;
	$perfect_ctrl = ($AR_MEM['prft_account_type']!='' && $AR_MEM['prft_acc_number']!='')? "1" :0;
	$option_ctrl += $perfect_ctrl;
	$bankwire_ctrl = ($AR_MEM['account_number']!='' && $AR_MEM['bank_acct_holder']!='' && $AR_MEM['bank_name']!='' && $AR_MEM['ifc_code']!='')? "1" :0;
	$option_ctrl += $bankwire_ctrl;
	
	
	$wallet_id = $model->getWallet(WALLET1);
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);

	$CONFIG_MIN_WITHDRAWL = $model->getValue("CONFIG_MIN_WITHDRAWL"); 
	$CONFIG_ADMIN_CHARGE = $model->getValue("CONFIG_ADMIN_CHARGE");
	$CONFIG_ADMIN_CHARGE_AMOUNT = $model->getValue("CONFIG_ADMIN_CHARGE_AMOUNT");
	
	$StrWhr .=" AND tft.to_member_id='".$member_id."'";
	$QR_PAGES="SELECT tft.* , tpp.processor_name, tpp.processor_id
			  FROM ".prefix."tbl_fund_transfer AS tft 
			  LEFT JOIN ".prefix."tbl_payment_processor AS tpp ON  tpp.processor_id=tft.processor_id
			  WHERE tft.trns_for LIKE 'WITHDRAW' 
			  $StrWhr 
			  ORDER BY tft.transfer_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
	
	
	$PRO_BTC = $model->getPaymentProcessor("Bitcoin");	
	
?>

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
<h3 class="header smaller lighter blue">Withdrawal Amount</h3>

<div class="clearfix">
<div class="pull-right tableTools-container"></div>
</div>
 <?php  get_message(); ?>
<div class="table-header">
Withdrawal Amount									</div>

<!-- div.table-responsive -->

<!-- div.dataTables_borderWrap -->
<div>
  <form id="form-page" name="form-page" method="post"  action="<?php echo generateMemberForm("financial","withdraw",""); ?>">
      <div class="divSearchItem">
             <select name="wallet_id" id="wallet_id" class="validate[required]" style="display:none;">
								<option value="1" selected>E-wallet</option>
			 </select>
    <select class="validate[required] processor_id" name="processor_id" style="display:none;" id="processor_id" <?php echo ($option_ctrl==0)? "disabled='disabled'":""; ?>>
                                      <option value="">---select----</option>
									<option value="1" selected>Bank A/c</option>                                    </select>
    <input type="text" placeholder="Amount in INR" name="draw_amount" class="validate[required]" id="draw_amount" value="<?php echo $POST['draw_amount']; ?>">
                                  
    <input type="password" placeholder="Transaction Password" name="trns_password" class="validate[required]" id="trns_password" value="<?php echo $POST['trns_password']; ?>">
                             
								 

                             
             <div align="left">
           
 
  	<input class="btn btn-success "  name="requestWithdraw" id="button" style="margin-left: 659px;margin-top: -59px;" value="Submit Request" <?php //echo ($option_ctrl==0)? "disabled='disabled'":""; ?> type="submit">


            </div> 
            </div>
</form> 
<div> 
<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer table-responsive">

<table id="dynamic-table" class="table table-striped table-bordered table-hover">
   <thead>
                        <tr>
                  
                          <th>Sn.</th>
                            <th style="width: 20%;">Date</th>
                            <th style="width: 20%;">Trns No</th>
                            <th style="width: 15%;">Type</th>
                            <th style=" width: 15%;">Amount</th>
                            <th style="width: 30%;">Details</th>
							<th>Status</th>
                 
                        </tr>
                    </thead>
                                                                  <tbody>
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;$i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
									//echo "<pre>";print_r($AR_DT);die;								?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $i;$i++;?></td>
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['trns_date']); ?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['trans_no']; ?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['trns_type']; ?></td>
                                      <td class="sorting_1"><?php echo number_format($AR_DT['trns_amount'],2); ?></td>
                                      <td><?php echo $AR_DT['trns_remark']; ?></td>
									  <td><?php if($AR_DT['trns_status'] =='P'){echo "<span class='label label-warning arrowed-in-right arrowed'>Pending</span>";}elseif($AR_DT['trns_status'] =='C'){echo "<span class='label label-success arrowed-in-right arrowed'>Success</span>";}else{echo "<span class='label label-danger arrowed-in-right arrowed'>Reject</span>";} ?></td>
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="7">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
                                  </tbody>
                </table>
            

   

        
        <!--
    
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
		
		-->
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


