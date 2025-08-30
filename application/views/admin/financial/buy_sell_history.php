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
                           <h4 class="card-title"> Financial <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Buy & Sell </small>  </h4>
                        </div>
                        <div class="clearfix">
            
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                 <div class="row">
         
          <div class="col-md-12"  > 
          
            <?php if($segmentqqqq=='buy_sell_history'){ ?>
            
             <form class="form-horizontal"   name="form-page" id="form-page" action="<?php echo generateAdminForm("financial","buy_sell_history","");  ?>" method="post" >
                <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Buy/Sell: </label>
                <div class="col-md-12">
                    
                  <select class="form-control col-xs-10 col-sm-5 validate[required]" style="width: 429px;" name="buy_sell" id="buy_sell" required>
                    <option value="" selected="selected">---select----</option>
                      <option value="Buy" selected="selected">---Buy----</option>
                         <option value="Sell" selected="selected">---Sell----</option>
                   
                  </select>
                </div>
              </div>
                 <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Time: </label>
                <div class="col-md-12">
                 <input id="timmer"  name="timmer" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 validate[required]" type="datetime-local" required>
              
                </div>
              </div>
 <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Currency Pair: </label>
                <div class="col-md-12">
                  <select class="form-control col-xs-10 col-sm-5 validate[required]" style="width: 429px;" name="pair" id="pair" required>
                        <option value="" selected="selected">---select Currency Pair----</option>
                        <option value="USDEUR">---USDEUR----</option>
                        <option value="USDGBP">---USDGBP----</option>
                        <option value="EURJPY">---EURJPY----</option>
                        <option value="AUDUSD">---AUDUSD----</option>
                        <option value="NZDUSD">---NZDUSD----</option>
                        <option value="GBPEUR">---GBPEUR----</option>
                        <option value="XAUUSD">---XAUUSD----</option>
                        <option value="XAGUSD">---XAGUSD----</option>
                      
                   
                  </select>
                </div>
              </div>
               <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Quantity: </label>
                <div class="col-md-12">
                 <input   name="qty" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 validate[required]" type="number" required >
              
                </div>
              </div>
                <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Price: </label>
                <div class="col-md-12">
                 <input id="Price"  name="price" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 " required type="text" >
              
                </div>
           
              </div>
              <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> P/L Price: </label>
                <div class="col-md-12">
                 <input id="Price"  name="p_price" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 " required type="text" >
              
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
                      <th  class="sorting_desc">Buy/Sell</th>
                      <th  class="sorting">Time </th>
                     <!-- <th  class="sorting">City </th>-->
                      <th  class="sorting">Currency Pair </th>
                      <th  class="sorting">Quantity </th>
                      <th  class="sorting">Price </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $QR_PAID_MEM = "SELECT * FROM tbl_tradingview AS sub where status='N' ";
                            $AR_PAID_MEMS = $this->SqlModel->runQuery($QR_PAID_MEM);
                            foreach($AR_PAID_MEMS as $AR_PAID_MEM):
                                ?>
                    <tr class="odd" role="row">
                        <td><?php echo $AR_PAID_MEM['buy_sell'];?> </td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($AR_PAID_MEM['timmer']));?> </td>
                        <td><?php echo $AR_PAID_MEM['pair'];?> </td>
                       
                          <td><?php echo $AR_PAID_MEM['qty'];?> </td>
                            <td><?php echo $AR_PAID_MEM['price'];?> </td>
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