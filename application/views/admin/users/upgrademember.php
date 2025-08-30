<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();
$segment = $this->uri->uri_to_assoc(2);
$user_id = $segment['user_id'];

$segmentqqqq = $this->uri->segment(3, 0);

  $group_id  = $this->session->userdata('group_id');


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
   <?php if($group_id =='6'){ ?>
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
                           <h4 class="card-title"> Users <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Upgrade </small>  </h4>
                        </div>
                        <div class="clearfix">
            
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                                 <div class="row">
         
          <div class="col-md-12"  > 
          
            <?php if($segmentqqqq=='upgrademember'){ ?>
            
             <form class="form-horizontal"   name="form-page" id="form-page" action="<?php echo generateAdminForm("users","upgrademember","");  ?>" method="post" onSubmit="return confirm('Make sure, want to upgrade this member')">
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User ID : </label>
                <div class="col-md-12">
                  <input id="form-field-1" placeholder="Users ID" name="member_user_id" style="width: 429px;"  onchange="check_member(this.value);" required class="form-control col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $user_id; ?>">
                  <input type="hidden" name="member_id" id="member_id" >
                </div>
              </div>
                 <div class="space-4"></div>
                 <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Member Name: </label>
                <div class="col-md-12">
                 <input id="name" placeholder="Member Name" name="member_user_id" style="width: 429px;" readonly  class="form-control col-xs-10 col-sm-5 validate[required]" type="text" value="">
              
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Package: </label>
                <div class="col-md-12">
                    
                  <select class="form-control col-xs-10 col-sm-5 validate[required]" style="width: 429px;" name="type_id" id="type_id" onchange="checkValue()">
                    <option value="" selected="selected">---select----</option>
                   
                    <?php echo DisplayCombo($type_id,"PIN_TYPE_VALUE"); ?>
                  </select>
                </div>
              </div>
              
              
          <!--     <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Select Plan </label>
                <div class="col-sm-9">
                    
                  <select class="form-control col-xs-12 col-sm-5 validate[required]" style="width: 429px;" name="roi_stacking">
                    <option value="R">Plan A</option>
                            <option value="S">Plan B</option>
                  </select>
                </div>
              </div> -->
              
              
              
              
            <div class="space-4"></div>
            
              <?php if(true){ ?>
              <div class="form-group" id="inputBox" style="display: none;">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Invesntment: </label>
                <div class="col-md-12">
                    
                  <input id="form-field-1" placeholder="Invesntment Price"  name="package_price" style="width: 429px;"   class="form-control col-xs-10 col-sm-5 validate[required]" type="text" >
                </div>
              </div> 
              
              <?php } ?>
              <?php if(false){ ?>
              <div class="form-group"  >
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Invesntment: </label>
                <div class="col-md-12">
                    
                  <input id="form-field-1" placeholder="Invesntment Price"  name="package_price" style="width: 429px;" required  class="form-control col-xs-10 col-sm-5 validate[required]" type="text" >
                </div>
              </div> 
              
              <?php } ?>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" name="submitUpgrade" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> UPGRADE MEMBER </button>
                </div>
              </div>
            </form>
      
          <table id="dynamic-table" class="table table-striped table-bordered table-hover" style='margin-top: 50px;'>
                  <thead>
                    <tr role="row">
                      <th  class="sorting_desc">User Id</th>
                      <th  class="sorting">Name </th>
                     <!-- <th  class="sorting">City </th>-->
                      <th  class="sorting">Package </th>
                          <th  class="sorting">Plan </th>
                      <th  class="sorting">Date & Time </th>
                      <th  class="sorting">Acitvate By Admin/User </th>
                        <th  class="sorting">IP|Location </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $QR_PAID_MEM = "SELECT tm.*,sub.ip,sub.city,sub.date_from as sdate,pin.mrp as mrp,sub.package_price as price,sub.active_by FROM tbl_subscription AS sub LEFT JOIN tbl_members AS tm ON sub.member_id=tm.member_id LEFT JOIN tbl_pintype AS pin ON sub.type_id=pin.type_id WHERE tm.subcription_id>0 ORDER BY sub.subcription_id DESC ";
                            $AR_PAID_MEMS = $this->SqlModel->runQuery($QR_PAID_MEM);
                            foreach($AR_PAID_MEMS as $AR_PAID_MEM):
                                ?>
                    <tr class="odd" role="row">
                        <td><?php echo strtoupper($AR_PAID_MEM['user_id']);?> </td>
                        <td><?php echo strtoupper($AR_PAID_MEM['first_name'].' '.$AR_PAID_MEM['middle_name'].' '.$AR_PAID_MEM['last_name']);?> </td>
                       <!-- <td><?php echo strtoupper($AR_PAID_MEM['city_name']);?> </td>-->
                        <td><?php echo CURRENCY; ?> <?php echo $AR_PAID_MEM['price'];?> </td>
                         <td>  <?php echo $AR_PAID_MEM['plan'];?> </td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($AR_PAID_MEM['sdate']));?> </td>
                         <td><?php if($AR_PAID_MEM['active_by']=='0'){ echo "Admin"; }else{ echo $res = $model->getMemberUserId($AR_PAID_MEM['active_by']);}?> </td>
                           <td><?php echo strtoupper($AR_PAID_MEM['ip']);?> | <?php echo strtoupper($AR_PAID_MEM['city']);?> </td>
                    </tr>
                    <?php  endforeach;
                                
                                 ?>
                  </tbody>
                </table>
            
            <?php } ?>
          
         <?php if($segmentqqqq=='manualupgradememberassaswewee'){ ?>  
           <form class="form-horizontal"   name="form-page" id="form-page" action="<?php echo generateAdminForm("member","manualupgrademember","");  ?>" method="post" onSubmit="return confirm('Make sure, want to upgrade this member')">
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> User ID : </label>
                <div class="col-sm-9">
                  <input id="form-field-1" placeholder="Users ID" name="member_user_id" style="width: 429px;"  required class="col-xs-10 col-sm-5 validate[required]" type="text" value="<?php echo $user_id; ?>">
                  <input type="hidden" name="member_id" id="member_id" >
                </div>
              </div>
              <div class="space-4"></div>
              <div class="form-group">
                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Package: </label>
                <div class="col-sm-9">
                   <input id="form-field-1" placeholder="Package Price"  name="package_price" style="width: 429px;" required  class="col-xs-10 col-sm-5 validate[required]" type="text" >
                  <input type="hidden" name="type_id" id="type_id" value="0" >
                </div>
              </div>
              <div class="clearfix form-action">
                <div class="col-md-offset-3 col-md-9">
                  <button type="submit" name="submitUpgradeee" value="1" class="btn btn-info"> <i class="ace-icon fa fa-check bigger-110"></i> UPGRADE MEMBER </button>
                </div>
              </div>
            </form>
      
          <table id="dynamic-table" class="table table-striped table-bordered table-hover" style='margin-top: 50px;'>
                  <thead>
                    <tr role="row">
                      <th  class="sorting_desc">User Id</th>
                      <th  class="sorting">Name </th>
                     <!-- <th  class="sorting">City </th>-->
                      <th  class="sorting">Package </th>
                      <th  class="sorting">Date & Time </th>
                     
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                        $QR_PAID_MEM = "SELECT tm.*,sub.date_from as sdate,sub.package_price as mrp FROM tbl_subscription AS sub LEFT JOIN tbl_members AS tm ON sub.member_id=tm.member_id  WHERE tm.subcription_id>0  ORDER BY sub.subcription_id DESC LIMIT 100";
                            $AR_PAID_MEMS = $this->SqlModel->runQuery($QR_PAID_MEM);
                            foreach($AR_PAID_MEMS as $AR_PAID_MEM):
                                ?>
                    <tr class="odd" role="row">
                        <td><?php echo strtoupper($AR_PAID_MEM['user_id']);?> </td>
                        <td><?php echo strtoupper($AR_PAID_MEM['first_name'].' '.$AR_PAID_MEM['middle_name'].' '.$AR_PAID_MEM['last_name']);?> </td>
                       <!-- <td><?php echo strtoupper($AR_PAID_MEM['city_name']);?> </td>-->
                        <td><?php echo $AR_PAID_MEM['mrp'];?> </td>
                        <td><?php echo date('d-m-Y H:i:s',strtotime($AR_PAID_MEM['sdate']));?> </td>
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

                           
                            <!-- /tile -->
                        </div>
                        <!-- /col -->






                    </div>
                    <!-- /row -->
            </div>
             </section>
           
         </div>
         
         </div>
         
         
         </div>
         
         
         </div>

   <?php } ?>
         <?php  $this->load->view(ADMIN_FOLDER.'/layout/footer');  ?>
<?php jquery_validation(); auto_complete(); ?>

<script>
  function checkValue() {
    const selectedValue = document.getElementById("type_id").value;
    const inputBox = document.getElementById("inputBox");

    if (selectedValue === "3") {
      inputBox.style.display = "block";
    } else {
      inputBox.style.display = "none";
    }
  }
</script>
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