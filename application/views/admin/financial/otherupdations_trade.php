<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$segment = $this->uri->uri_to_assoc(2);
$user_id = $segment['user_id'];

$segmentqqqq = $this->uri->segment(3, 0);
?>
     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>  
<script type="text/javascript">
    $(function(){
        $(".open_modal").on('click',function(){
            $('#search-modal').modal('show');
            return false;
        });
    });
</script>
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
                        <!-- col -->
                        <div class="col-md-12">

                            <!-- tile -->
                            <section class="tile">
 
                                <!-- tile body -->
                                <div class="tile-body table-custom">

                                    <div class="table-responsive">
                        <div class="col-md-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Trade Member Updations </small>  </h4>
                        </div>
                        <div class="clearfix">
            
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                 <div class="row">
         
          <div class="col-md-12"  > 
          
            <?php if($segmentqqqq=='tradememberpage'){ ?>
            
             <form class="form-horizontal"   name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","tradememberpage","");  ?>" method="post" >
              
           <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Balance: </label>
                <div class="col-md-12">
                 <input   name="Balance" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 validate[required]" type="text" required >
              
                </div>

               <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Equity: </label>
                <div class="col-md-12">
                 <input   name="Equity" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 validate[required]" type="text" required >
              
                </div>
              </div>
                <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Margin: </label>
                <div class="col-md-12">
                 <input   name="Margin" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 validate[required]" type="text" required >
              
                </div>
              </div>
               <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Free Margin: </label>
                <div class="col-md-12">
                 <input   name="FreeMargin" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 validate[required]" type="text" required >
              
                </div>
              </div>
               <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Margin Level: </label>
                <div class="col-md-12">
                 <input   name="MarginLevel" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 validate[required]" type="text" required >
              
                </div>
              </div>
              
              </div>
             
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" name="submitUpgrade" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> Submit </button>
                </div>
              </div>
             
              </div>
            </form>
      
          <table id="dynamic-table" class="table table-striped table-bordered table-hover" style='margin-top: 50px;'>
                  <thead>
                    <tr role="row">
                      <th  class="sorting_desc">Balance</th>
                      <th  class="sorting">Equity </th>
                     <!-- <th  class="sorting">City </th>-->
                      <th  class="sorting">Margin </th>
                      <th  class="sorting"> Free Margin </th>
                      <th  class="sorting">Margin Level </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $QR_PAID_MEM = "SELECT * FROM tbl_tradingview_trade_updation AS sub where 1 ";
                            $AR_PAID_MEMS = $this->SqlModel->runQuery($QR_PAID_MEM);
                            foreach($AR_PAID_MEMS as $AR_PAID_MEM):
                                ?>
                    <tr class="odd" role="row">
                        <td><?php echo $AR_PAID_MEM['Balance'];?> </td>
                          <td><?php echo $AR_PAID_MEM['Equity'];?> </td>
                        <td><?php echo $AR_PAID_MEM['Margin'];?> </td>
                       
                          <td><?php echo $AR_PAID_MEM['FreeMargin'];?> </td>
                            <td><?php echo $AR_PAID_MEM['MarginLevel'];?> </td>
                    </tr>
                    <?php  endforeach;
                                
                                 ?>
                  </tbody>
                </table>
            
            <?php } ?>
          
        
         
          </div>
        </div>   
                                    </div>

                                </div>
                                <!-- /tile body -->

                            </section>
                            <!-- /tile -->
                        </div>
                        <!-- /col -->






                    </div>
                    <!-- /row -->
            </div>
         </div>


         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
<?php jquery_validation(); auto_complete(); ?>
<script type="text/javascript">
    
    $(function(){
        $("#form-valid").validationEngine();
    });
</script>
<script type="text/javascript" language="javascript">
new Autocomplete("member_user_id", function(){
    this.setValue = function( id ) {document.getElementsByName("member_id")[0].value = id;}
    if(this.isModified) this.setValue("");
    if(this.value.length < 1 && this.isNotClick ) return;
    return "<?php echo ADMIN_PATH; ?>autocomplete/listing?srch=" + this.value+"&switch_type=MEMBER";
});
</script>
 <script>
       function check_member(id)
{
//alert(id);
      jQuery.ajax({
type: "POST",
url: "<?php echo BASE_PATH; ?>" + "user/check_user",
data: {mem: id},
success: function(res) {
    //alert(res);
document.getElementById('name').value=res;

}
});
}

       </script>