<?php 
$model = new OperationModel();

 $url = $this->uri->segment(1);
if($url == 'admin')
{
 $path =    ADMIN_PATH;
}
elseif($url =='courier')
{
    $path = COURIER_PATH;
}
else
{
    $path =    ADMIN_PATH; 
}

?>

      <!-- Wrapper Start -->
    <!-- Wrapper Start -->
      <div class="wrapper">
         <!-- Sidebar  -->
         <div class="iq-sidebar">
            <div class="iq-navbar-logo d-flex justify-content-between">
               <a href="#" class="header-logo">
                <img style="max-width: 190px!important;" src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_LOGO"); ?>" class="img-fluid rounded" alt="">
               </a>
               </a>
               <div class="iq-menu-bt align-self-center">
                  <div class="wrapper-menu">
                     <div class="main-circle"><i class="ri-menu-line"></i></div>
                     <div class="hover-circle"><i class="ri-close-fill"></i></div>
                  </div>
               </div>
            </div>
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li class="active">
                        <a href="<?php echo $path."dashboard"; ?>" class="iq-waves-effect" ><span class="ripple rippleEffect"></span><i class="las la-home iq-arrow-left"></i><span>Dashboard</span></a>
                       
                     </li>
                                                           <?php
    $admin_id  = $this->session->userdata('admin_id');
    $group_id  = $this->session->userdata('group_id');
    $oprt_id  = $this->session->userdata('oprt_id');
    if($admin_id>1){
        $Str_PageId = " AND A.page_id>2";
    }
$i=0;
    $QR_MM="SELECT DISTINCT B.ptype_id, C.type_name, C.icon_id FROM ".prefix."tbl_sys_menu_acs AS A, 
             ".prefix."tbl_sys_menu_sub AS B 
             LEFT OUTER JOIN  ".prefix."tbl_sys_menu_main AS C ON  B.ptype_id=C.ptype_id 
             WHERE B.ptype_id>0 AND (A.group_id='$group_id' OR A.oprt_id='$admin_id') $Str_PageId AND   
             A.page_id=B.page_id ORDER BY C.order_id ASC;";
   $RS_MMS = $this->db->query($QR_MM);
   $AR_MMS = $RS_MMS->result_array();
    $Ctrl=0;
    $Str_PageId = ($oprt_id>1)? " AND B.page_id NOT IN(205,206)":"";
    foreach($AR_MMS as $AR_MM){
        $ptype_id = $AR_MM['ptype_id'];
        $icon_id = $AR_MM['icon_id'];
        
        $Q_SBMN = "SELECT B.* FROM ".prefix."tbl_sys_menu_acs AS A, ".prefix."tbl_sys_menu_sub AS B 
                  WHERE A.page_id=B.page_id AND (A.group_id='$group_id' OR A.oprt_id='$oprt_id') 
                  $Str_PageId AND B.ptype_id='$ptype_id' 
                  GROUP BY B.page_id ORDER BY B.order_id ASC;";
        $RS_SBMNS = $this->db->query($Q_SBMN);
        $AR_SBMNS = $RS_SBMNS->result_array();
        if(is_array($AR_SBMNS) and !empty($AR_SBMNS)){
    ?>
                     <li aria-expanded="true">
                        <a href="#d<?php echo $Ctrl;?>" class="iq-waves-effect" data-toggle="collapse" aria-expanded="true"><i class="fa <?php echo DisplayICon($icon_id); ?> iq-arrow-left"></i><span><?php echo $AR_MM['type_name']; ?> </span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="d<?php echo $Ctrl;?>" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                          
 <?php   
        foreach($AR_SBMNS as $AR_SBMN){ 
        ?>

                           <li ><a href="<?php echo $path.$AR_SBMN['page_name']; ?>"><i class="ri-git-commit-line"></i><?php echo $AR_SBMN['page_title']; ?></a></li>
                           <?php } ?>
                        </ul>
                    </li>
              
                      <?php
        }
       $Ctrl++; } 
    ?>
                  </ul>
               </nav>
               <div class="p-3"></div>
            </div>
         </div>
        
      </div>
      <!-- Wrapper END -->