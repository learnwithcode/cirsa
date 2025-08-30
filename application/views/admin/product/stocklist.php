<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
$model = new OperationModel();
	    
		$segment = $this->uri->uri_to_assoc(2);
 $product_id = $segment['product_id'];
 $QR_PAGES="SELECT prd.* FROM ".prefix."tbl_product_stock AS prd   WHERE product_id ='$product_id' and  status !='2' $StrWhr ORDER BY prd.stock_id ASC"; 
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
$product = $model-> getrow('tbl_product','product_id',$product_id);

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
<script src="<?php echo BASE_PATH; ?>assets/js/ace-extra.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/jquery-2.1.4.min.js"></script>
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
		
		$(".checkStatus").on('click',function(){
			var id_cms = $(this).attr("id_cms");
			var URL_LOAD = "<?php echo ADMIN_PATH."json/jsonhandler"; ?>?switch_type=CMS&id_cms="+id_cms;
			$.getJSON(URL_LOAD,function(JVal){});
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
        <h1> Product Stock   <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; <?php echo $product['product_name'];?> </small> </h1>
      </div>
      
      <div class="row">
       
        <div class="col-xs-12">
		 <?php get_message(); ?>
		</div>
		</div>
          <div class="row">
            <div class="col-xs-12">
     <div class="clearfix">
                <div class="pull-right tableTools-container">
                  <div class="dt-buttons btn-overlap btn-group"> 
                    <a  href="<?php echo generateSeoUrlAdmin("product","stock_add",array('product_id'=>$product_id,'action_request'=>'ADD_UPDATE')); ?>" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-csv buttons-html5 btn btn-white btn-primary btn-bold"><span><i class="fa fa-plus bigger-110 orange"></i> <span class="hidden">Add New Banner</span></span></a> </div>
                </div>
              </div> 
              <div>
                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                   <th  class="center" width="10%"> <label class="pos-rel"> Sl No. <span class="lbl"></span> </label>                      </th>
                      <th  align="center" width="20%">Product MRP</th>
                      <th  align="center" width="20%">Product DP</th>
				      <th  align="center" width="20%">Purchase Price</th>
				      <th  align="center" width="10%">Quantity</th>
					  <th  align="center" width="20%">Added Date Time</th>
                    </tr>
                  </thead>
                  <form method="post" autocomplete="off" action="<?php echo ADMIN_PATH."operation/cms"; ?>">
                    <tbody>
                      <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl= $PageVal['RecordStart']+1;
						foreach($PageVal['ResultSet'] as $AR_DT):
						 
						
			       ?>
                      <tr>
                        <td class="center"><label class="pos-rel"> <?php echo $Ctrl; ?> <span class="lbl"></span> </label>                        </td>
                    
                        <td align="left"><a href="javascript:void(0)"><?php echo $AR_DT['mrp']; ?>/-</a></td>
						<td align="left"><a href="javascript:void(0)"><?php echo $AR_DT['dp']; ?>/-</a></td>
						<td align="left"><a href="javascript:void(0)"><?php echo $AR_DT['purchase_price']; ?>/- </a></td>
						<td align="left"><a href="javascript:void(0)"><?php echo $AR_DT['quantity']; ?> </a></td>
					 	<td align="left"><a href="javascript:void(0)"><?php echo $AR_DT['added_date_time']; ?> </a></td>
                      </tr>
                      <?php $Ctrl++; endforeach; ?>
                      
                      <?php  }else{ ?>
                      <tr>
                        <td colspan="8" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </form>
                </table>
                <div class="row">
                  <div class="col-xs-6">
                    <div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> Stock </div>
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
      <form class="form-horizontal"  name="form-page" id="form-page" action="<?php echo ADMIN_PATH."operation/cmslist"; ?>" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"> Title </label>
            <div class="col-sm-6">
              <input id="form-field-1" placeholder="Title" name="cms_title"  class="col-xs-10 col-sm-12 validate[required]" type="text" value="<?php echo $_GET['cms_title']; ?>">
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-success"> <i class="ace-icon fa fa-check"></i> Search </button>
          <button type="button" class="btn btn-warning" onClick="window.location.href='?'"> <i class="ace-icon fa fa-refresh"></i> Reset </button>
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"> <i class="ace-icon fa fa-times"></i> Close </button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script>
function updatestatus(id)
{

var status = document.getElementById(id).checked;
jQuery.ajax({
type:"POST",
url :"<?php echo BASE_PATH;?>"+"superadmin/product/productstatus",
data:{productId:id,status:status},
success :function(res){
//alert(res);
}
});
}
</script>
 <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a> </div>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
</body>
</html>
