<?php defined('BASEPATH') OR exit('No direct script access allowed');
$model = new OperationModel();

$member_id = _d(FCrtRplc($_GET['member_id']));
if($member_id == ""){$member_id="1";}

$Q_GEN =  "SELECT nlevel, nleft, nright FROM ".prefix."tbl_mem_tree WHERE member_id='$member_id'";
$AR_GEN = $this->SqlModel->runQuery($Q_GEN,true);
$nlevel = $AR_GEN['nlevel'];
$nleft = $AR_GEN['nleft'];
$nright = $AR_GEN['nright'];

$StrQuery = "&member_id=$member_id";

$QR_MEM = "SELECT tm.*, tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
			 tree.nlevel, tree.left_right, tree.nleft, tree.nright, tree.date_join FROM ".prefix."tbl_members AS tm	
			 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
			 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
			 WHERE tm.sponsor_id='$member_id' $StrWhr ORDER BY tree.nlevel ASC";
$PageVal = DisplayPages($QR_MEM, 200, $Page, $StrQuery);
?>
     <?php  $this->load->view(ADMIN_FOLDER.'/layout/header');  ?>

<?php  $this->load->view(ADMIN_FOLDER.'/layout/leftmenu');  ?>
<?php  $this->load->view(ADMIN_FOLDER.'/layout/topmenu');  ?>  


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
                        <div class="col-sm-12">
                  <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                     <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                           <h4 class="card-title"> Users  <small> <i class="ace-icon fa fa-angle-double-right"></i>&nbsp; Directs List</small>  </h4>
                        </div>
                        <div class="clearfix">
               
              </div>
                     </div>
                     <?php  get_message(); ?>
                     <div class="iq-card-body">
                     <table width="100%" border="0" cellpadding="5" cellspacing="1" class="table table-striped table-bordered table-hover">
            <tr>
              <td colspan="9" align="left" valign="bottom" class="bigtexthdr">Member Directs</td>
            </tr>
	
            <tr class="">
              <td width="9%"align="left">Srl N</td>
              <td width="9%" align="left">Member Id</td>
              <td width="15%" align="left">Full Name</td>
              <td width="11%" align="center">Sponsor Id</td>
              <td width="10%" align="left">Joining Date</td>
              <td width="11%" align="left">Email</td>
              <td width="8%" align="left">Mobile</td>
             
            </tr>
            <?php 
			if($PageVal['TotalRecords'] > 0){
			$Ctrl = $PageVal['RecordStart']+1;
			foreach($PageVal['ResultSet'] as $AR_Fld){
			
			
			$AR_IMG = $model->getCurrentImg($AR_Fld['member_id']);
			
			
			?>
           
            <tr class="">
             
               <td align="left" valign="middle" class="<?php echo $AR_IMG['CssCls'];?>"><?php echo $Ctrl;?></td>
              <td align="left" valign="middle" class="<?php echo $AR_IMG['CssCls'];?>"><?php echo strtoupper($AR_Fld['user_id']);?></td>
              <td align="left" valign="middle" class="cmntext"><?php echo $AR_Fld['first_name']." ".$AR_Fld['last_name'];?></td>
              <td align="center" valign="middle" class="cmntext"><?php echo $AR_Fld['spsr_user_id'];?></td>
              <td align="left" valign="middle" class="cmntext"><?php echo DisplayDate($AR_Fld['date_join']);?></td>
              <td align="left" valign="middle" class=""><span class="cmntext"><?php echo $AR_Fld['member_email'];?></span></td>
              <td align="left" valign="middle" class="cmntext"><?php echo $AR_Fld['member_mobile'];?></td>
                    </tr>
            <?php  $Ctrl++; }?>
            <?php }else{?>
            <tr>
              <td colspan="9" align="center" class="errMsg">No record found</td>
            </tr>
            <?php } ?>
          </table>
           <ul class="pagination">
                  <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                </ul>
          <!-- PAGE CONTENT ENDS -->

                     </div>
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
