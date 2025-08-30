<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$segment = $this->uri->uri_to_assoc(2);
$typeId = _d($segment['type_id']);
$packageType = _d($segment['type']);
$QR_SELECT ="SELECT product_id FROM ".prefix."tbl_pintype where type_id='$typeId'";
						$RS_SELECT = $this->db->query($QR_SELECT);
						$AR_ROWS = $RS_SELECT->row_array();
						$totalProduct = $AR_ROWS['product_id'];
						$totalProduct = explode(',',$totalProduct);
					

$QR_PAGES="Select * from tbl_product ";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta charset="utf-8" />
<title><?php echo title_name(); ?></title>
<meta name="description" content="Static &amp; Dynamic Tables" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/font-awesome/4.5.0/css/font-awesome.min.css" />

<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/fonts.googleapis.com.css" />

<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-skins.min.css" />
<link rel="stylesheet" href="<?php echo BASE_PATH; ?>assets/css/ace-rtl.min.css" />

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
        <h1> Package <small> <i class="ace-icon fa fa-angle-double-right"></i> &nbsp; Product </small> </h1>
      </div>
      <!-- /.page-header -->
      <div class="row">
	  	<?php get_message(); ?>
        <div class="col-xs-12">
		                <div class="clearfix">
                  <div class="pull-right tableTools-container">
                    <div class="dt-buttons btn-overlap btn-group">
					<a href="<?php echo generateSeoUrlAdmin("package","packagelist",array("type"=>_e($packageType))); ?>" title="" data-original-title="" aria-controls="dynamic-table" tabindex="0" class="dt-button buttons-collection buttons-colvis btn btn-white btn-danger btn-bold"><span><i class="fa fa-arrow-left bigger-110 blue"></i> <span class="">Back</span></span></a> 
					
					 </div>
                  </div>
                </div>
          <!-- PAGE CONTENT BEGINS -->
          <form class="form-horizontal" method="post" name="frmMenus" id="frmMenus" autocomplete="off" action="<?php echo generateAdminForm("package","addpacageproduct",array("type_id"=>_e($typeId),"type"=>_e($packageType)));  ?>">
            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                      <tr>
                        <th class="center"> Select                </th>
                        <th>Product Name</th>
						<th>HSN Code </th>
						<th>Unit</th>
						<th>TAX </th>
                        <th>MRP </th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):
						if(@in_array($AR_DT['product_id'],$totalProduct))
					{
						$checked='checked="checked"';
					}
					else
					{
						$checked="";
					}
			       ?>
                      <tr <?php if($checked !=''){ ?>class="success" <?php }else {  ?>class="warning" <?php } ?>>
  <td class="center"><label class="pos-rel"> <input type="checkbox" name="productid[]" <?php echo $checked;?>value="<?php echo $AR_DT['product_id'];?>" <span class="lbl"></span> </label></td>
	<td><?php echo $AR_DT['product_name']; ?>   </td>
	<td><?php echo $AR_DT['hsn_code']; ?></td>
	<td><?php echo $AR_DT['unit']; ?></td>
	<td><?php echo $AR_DT['tax'];  ?> %</td>
	<td>&nbsp;&#8377; <?php echo $AR_DT['product_mrp'];  ?> /-</td>
    
						  
                      </tr>
                      <?php $Ctrl++; endforeach; 
					  ?>
					<tr> <td colspan="6"><button type="submit" name="submitForm" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button></td></tr>  
					  <?php 
					  
					  }else{ ?>
                      <tr>
                        <td colspan="5" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
          </form>
          <!-- PAGE CONTENT ENDS -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.page-content -->
  </div>
</div>
 <?php $this->load->view(ADMIN_FOLDER.'/layout/footer'); ?>
  <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse"> <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i> </a>
</div>
<?php $this->load->view(ADMIN_FOLDER.'/layout/footerbottom'); ?>
</body>
<?php jquery_validation(); ?>
<script>
JsURLPath = "<?php echo BASE_PATH; ?>";
$(function() { 
	
	$("#frmMenus").validationEngine(
		{onValidationComplete: function(form, valid){
            $("#fldvTList > option").each(function(){
				$('#fldvTList option').attr("selected", "selected");
			});
			return true;
        }}
	);
	
	$(".ViewList").change(function(){
		var group_id = $(this).val();
		window.location.href='?group_id='+group_id;
	})
	
	$(".AddMenus").click(function(){
		$("#fldvFList > option:selected").each(function(){
			$(this).remove().appendTo("#fldvTList");
		});
	});

	$(".RemoveMenus").click(function(){
		$("#fldvTList > option:selected").each(function(){
			$(this).remove().appendTo("#fldvFList");
		});
	});
});
</script>
</html>
