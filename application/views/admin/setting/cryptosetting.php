<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();



 ?>


     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>  

<style>
   
.table td, .table th {
    padding: 5px;
}
</style>
 <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
                  <!-- row -->
                    <div class="row">
          <?php  get_message(); ?>
          <div class="col-md-12">
            <!-- PAGE CONTENT BEGINS -->
<form class="form-horizontal"  name="form-valid" id="form-valid" action="<?php echo generateAdminForm("setting","crypto"); ?>" method="post" enctype="multipart/form-data">
             <fieldset class="scheduler-border">
<legend class="scheduler-border">Crypto Configuration</legend>
   <div class="row">

<div class="col-md-6">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CRYPTO_BEP20">BEP-20 (USDT) Address *</label>
<input type="text" name="CRYPTO_BEP20"  value="<?php echo $model->getcryptoValue("CRYPTO_BEP20"); ?>" class="form-control tip" id="CRYPTO_BEP20"  data-original-title="" title="" data-bv-field="site_name">
<br><img src="<?php echo BASE_PATH;?>upload/icon/QRNEW/<?php echo $model->getcryptoValue("CRYPTO_BEP20_LOGO"); ?>" style="width:102px;margin-top: -12px;" />
<label class="lab" for="CRYPTO_BEP20">BEP-20 (USDT) QR CODE *</label>
<input type="file" name="CRYPTO_BEP20_LOGO">
</div>
</div>
<div class="col-md-6">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CRYPTO_TRC20">TRC-20 (USDT) Address *</label>
<input type="text" name="CRYPTO_TRC20"  value="<?php echo $model->getcryptoValue("CRYPTO_TRC20"); ?>" class="form-control tip" id="CRYPTO_TRC20"  data-original-title="" title="" data-bv-field="site_name">
<br><img src="<?php echo BASE_PATH;?>upload/icon/QRNEW/<?php echo $model->getcryptoValue("CRYPTO_TRC20_LOGO"); ?>" style="width:102px;margin-top: -12px;" />
<label class="lab" for="CRYPTO_TRC20">TRC-20 (USDT) QR CODE *</label>
<input type="file" name="CRYPTO_TRC20_LOGO">
</div>
</div>
<div class="col-md-6">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CRYPTO_Polygon">Polygon Address *</label>
<input type="text" name="CRYPTO_Polygon"  value="<?php echo $model->getcryptoValue("CRYPTO_Polygon"); ?>" class="form-control tip" id="CRYPTO_Polygon"  data-original-title="" title="" data-bv-field="site_name">
<br><img src="<?php echo BASE_PATH;?>upload/icon/QRNEW/<?php echo $model->getcryptoValue("CRYPTO_Polygon_LOGO"); ?>" style="width:102px;margin-top: -12px;" />
<label class="lab" for="CRYPTO_Polygon">Polygon QR CODE *</label>
<input type="file" name="CRYPTO_Polygon_LOGO">
</div>
</div>
<div class="col-md-6">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CRYPTO_Paypal">Paypal Address *</label>
<input type="text" name="CRYPTO_Paypal"  value="<?php echo $model->getcryptoValue("CRYPTO_Paypal"); ?>" class="form-control tip" id="CRYPTO_Paypal"  data-original-title="" title="" data-bv-field="site_name">
<br><img src="<?php echo BASE_PATH;?>upload/icon/QRNEW/<?php echo $model->getcryptoValue("CRYPTO_Paypal_LOGO"); ?>" style="width:102px;margin-top: -12px;" />
<label class="lab" for="CRYPTO_Paypal">Paypal QR CODE *</label>
<input type="file" name="CRYPTO_Paypal_LOGO">
</div>
</div>
<div class="col-md-6">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CRYPTO_Skrill">Skrill Address *</label>
<input type="text" name="CRYPTO_Skrill"  value="<?php echo $model->getcryptoValue("CRYPTO_Skrill"); ?>" class="form-control tip" id="CRYPTO_Skrill"  data-original-title="" title="" data-bv-field="site_name">
<br><img src="<?php echo BASE_PATH;?>upload/icon/QRNEW/<?php echo $model->getcryptoValue("CRYPTO_Skrill_LOGO"); ?>" style="width:102px;margin-top: -12px;" />
<label class="lab" for="CRYPTO_Skrill">Skrill QR CODE *</label>
<input type="file" name="CRYPTO_Skrill_LOGO">
</div>
</div>

<div class="col-md-6">
<div class="form-group" style="margin-right:0px;">
<label class="lab" for="CRYPTO_NetSuite">NetSuite Address *</label>
<input type="text" name="CRYPTO_NetSuite"  value="<?php echo $model->getcryptoValue("CRYPTO_NetSuite"); ?>" class="form-control tip" id="CRYPTO_NetSuite"  data-original-title="" title="" data-bv-field="site_name">
<br><img src="<?php echo BASE_PATH;?>upload/icon/QRNEW/<?php echo $model->getcryptoValue("NetSuite_LOGO"); ?>" style="width:102px;margin-top: -12px;" />
<label class="lab" for="CRYPTO_NetSuite">NetSuite QR CODE *</label>
<input type="file" name="NetSuite_LOGO">
</div>
</div>


  </div>
 <div class="clearfix form-action" style="float:right;">
                <div class="col-md-12">
                  <button type="submit" name="submitcrypto_setting" value="1" class="btn btn-success"> <i class="ace-icon fa fa-check bigger-110"></i> Save Changes </button>
                  </div>
              </div>
</fieldset>



            </form>
            <!-- PAGE CONTENT ENDS -->
          </div>
          <!-- /.col -->
        </div>
                    <!-- /row -->
            </div>
         </div>
 

 <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
<style>
    fieldset.scheduler-border{
        border:1px solid #dbdee0!important;
        padding:1.4em!important;
        margin:0 0 1.5em!important;
        -webkit-box-shadow:0 0 0 0 #000;
        box-shadow:0 0 0 0 #000;
        
        }
        label.lab{
          font-weight:700;  
        }
        
</style>
<?php jquery_validation(); ?>
<script>
function updatestatus(id)
{

var status = document.getElementById(id).checked;
jQuery.ajax({
type:"POST",
url :"<?php echo BASE_PATH;?>"+"superadmin/setting/onofftatus",
data:{id:id,status:status},
success :function(res){
alert(res);
window.location.reload();
}
});
}
</script>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>