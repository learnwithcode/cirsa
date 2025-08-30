<?php $invoice = $this->uri->segment(3);
$model = new OperationModel();?>
<?php 
$memberId = $this->session->userdata('mem_id');
$modell = new SqlModel();
                $QR_CHECK = "SELECT * from tbl_members where member_id='$memberId' ";
        		$fR = $modell->runQuery($QR_CHECK,TRUE); 
        	
             $AR_TYPE  = $model->getCurrentMemberShip($memberId);
            $date_from = (InsertDate($AR_TYPE['date_from']))? InsertDate($AR_TYPE['date_from']):"Pending";     	
            
            $QR_MSG="SELECT ts.* FROM ".prefix."tbl_support AS ts WHERE ts.from_id='".$memberId."' 	ORDER BY ts.enquiry_id DESC LIMIT 5";
            $MSG  = $this->SqlModel->RunQuery($QR_MSG);
            
            $QR_NOTI="SELECT * FROM `tbl_news` WHERE `news_sts` ='1' ORDER BY `news_id` DESC LIMIT 5";
            $NOTI  = $this->SqlModel->RunQuery($QR_NOTI);
            
          $QR_CHECK = "SELECT tm.*,    tm.member_mobile  AS mobile_number, tmsp.first_name AS spsr_first_name, 
		tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,	tree.nlevel, tree.left_right, tree.nleft, tree.nright,
		tree.date_join, tp.pin_name ,ts.* FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_subscription AS ts ON (tm.member_id=ts.member_id)
		 LEFT JOIN ".prefix."tbl_pintype AS tp ON ts.type_id=tp.type_id
		 WHERE tm.member_id='".$memberId."' 
		 ORDER BY tm.member_id ASC";
		$fetchRow = $this->SqlModel->runQuery($QR_CHECK,true); 
         $LDGR = $model->getCurrentBalance($memberId,'1',$_REQUEST['from_date'],$_REQUEST['to_date']);     
?>
<?php
 $segment = $this->uri->segment(2);
  	$left_right = (_d($segment['left_right']))? _d($segment['left_right']):_d($_REQUEST['left_right']);
 $a2 = $this->uri->segment(2);
$a3 = $this->uri->segment(3); 
 
 if($a2==''){
   $a1 = $this->uri->segment(1);  
     
 }
if($a1=='member'){
    $breadcremp ='Dashboard';
}elseif($a2=='p2p'){
     $breadcremp ='P2P';
}elseif($a3=='my_team'){
     $breadcremp ='My Network';
}elseif($a3=='board'){
     $breadcremp ='MY Board';
}elseif($a3=='treegenealogy'){
     $breadcremp ='Genealogy View';
}elseif($a2=='income-wallet'){
     $breadcremp ='Income Wallet';
}elseif($a2=='activation-wallet'){
     $breadcremp ='A-Wallet History';
}elseif($a2=='withdraw-history'){
     $breadcremp ='Withdraw History';
}elseif($a3=='boardincome'){
     $breadcremp ='Board Income';
}elseif($a3=='directincome'){
     $breadcremp ='Direct Referral Bonus';
}elseif($a3=='boosterInc'){
     $breadcremp ='Reward Bonus';
}elseif($a3=='binaryincome'){
     $breadcremp ='Binary Matching Report';
}elseif($a3=='totalincome'){
     $breadcremp ='Total Bonus';
}elseif($a3=='myprofile'){
     $breadcremp ='My Profile';
}elseif($a3=='updatekyc'){
     $breadcremp ='My Kyc';
}elseif($a3=='banking'){
     $breadcremp ='Bank Details';
}elseif($a3=='requestfund'){
     $breadcremp ='Add Fund';
}elseif($a3=='level_view'){
     $breadcremp ='Level View';
}elseif($a3=='dailyReturn'){
     $breadcremp ='Daily Stacking Report';
}elseif($a3=='LevelIncome'){
     $breadcremp ='Level Bonus';
}elseif($a3=='CommunityIncome'){
     $breadcremp ='NextG Community Bonus';
}
elseif($a3=='crypto'){
     $breadcremp ='Crypto Setting';
}










?>     
<style>
    
    .header .header-content {
    height: 100%;
    padding-left: 5.3125rem;
    padding-right: 2.4rem;
    align-items: center;
    display: flex;
     border-style: outset!important;

}
</style>
  <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_FAVICON"); ?>" alt="">
                <img class="logo-compact" src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_FAVICON"); ?>" alt="">
                <!--<img class="brand-title" src="<?php echo BASE_PATH;?>upload/system/<?php echo $model->getValue("CONFIG_FAVICON"); ?>" alt="">-->
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        
        	<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
								<!--<div class="input-group search-area d-lg-inline-flex d-none">-->
								<!--	<input type="text" class="form-control" placeholder="Search here...">-->
								<!--	<div class="input-group-append">-->
								<!--		<span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>-->
								<!--	</div>-->
								<!--</div>-->
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
							
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0)" role="button" data-bs-toggle="dropdown">
                                    <?php  if($fetchRow['photo'] !=''){ $pic = $fetchRow['photo'];}else{ $pic='error';}
                                            if (file_exists(FCPATH.'upload/member/'.$pic)) { ?>
                                       <img class="profile-pic" src="<?php echo BASE_PATH;?>upload/member/<?php echo $fetchRow['photo'];?>" alt="profile-pic" style="    width: 50px;">
                                        
                                         <?php } else { ?>
 	<img src="<?php echo BASE_PATH; ?>newassets/images/profile/profile.png" class="img-fluid rounded-circle" alt="">
								
                                           
<?php } ?>   
                             
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="<?php  echo generateSeoUrlMember("account","myprofile",array()); ?>" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ms-2">Profile </span>
                                    </a>
                                    <a href="<?php  echo generateSeoUrlMember("support","contactsupport",array()); ?>" class="dropdown-item ai-icon">
                                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                        <span class="ms-2">Inbox </span>
                                    </a>
                                    <a href="<?php  echo generateSeoUrlMember("dashboard","logout",array()); ?>" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->