<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$Page = $_GET[page]; if($Page == "" or $Page <=0){$Page=1;}
	$model = new OperationModel();
	$today_date = InsertDate(getLocalTime());
	$segment = $this->uri->uri_to_assoc(2);
	
	$from_date = InsertDate($segment['from_date']);
	$to_date = InsertDate($segment['to_date']);
	
	$yester_date = InsertDate(AddToDate($today_date,"-1 Day"));
	$member_id = $this->session->userdata('mem_id');
	
	$AR_SELECT = $model->getMember($member_id);
	
	
	$nleft = $AR_SELECT["nleft"];
	$nright = $AR_SELECT["nright"];
	$StrWhr = " AND tree.nleft BETWEEN '$nleft' AND '$nright'";


	
	if($_GET['country_code']!=''){
		$country_code = FCrtRplc($_GET['country_code']);
		$StrWhr .=" AND tm.country_code='".$country_code."'";
		$SrchQ .="&country_code=$country_code";
	}
	
	if($_GET['from_date']!='' && $_GET['to_date']!=''){
		$from_date = InsertDate($_GET['from_date']);
		$to_date = InsertDate($_GET['to_date']);
		$StrWhr .=" AND DATE(tm.date_join) BETWEEN '".$from_date."' AND '".$to_date."'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	if($_GET['subscription_sts']>0){
		$subscription_sts = FCrtRplc($_GET['subscription_sts']);
		$StrWhr .=" AND ts.subcription_id>0";
		$SrchQ .="&subscription_sts=$subscription_sts";
	}

	$QR_PAGE = "SELECT tm.*,  tm.member_mobile  AS mobile_number, 
	     tmsp.first_name AS spsr_first_name, tmsp.last_name AS spsr_last_name,  tmsp.user_id AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright, ts.subcription_id, ts.date_from, ts.date_expire , 
		 tpt.pin_name, tpt.pin_price
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_subscription AS ts ON ( ts.member_id=tm.member_id )
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=ts.type_id
		 WHERE tm.sponsor_id='".$member_id."'
		 AND tm.delete_sts>0 
		 $StrLeft  $StrWhr 
		 GROUP BY tm.member_id
		 ORDER BY tm.date_join DESC";
	$PageVal = DisplayPages($QR_PAGE, 50, $Page, $SrchQ);
	
?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>

	<?php $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
	

	<?php $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
	
 
      <div class="content-page rtl-page">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12 col-md-12">
               <div class="card card-block card-stretch card-height">
                  <div class="card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="card-title">Topology view</h4>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="basic-tree well">
                        <ul class="tree-box">
                           <li>
                              <span><i class="fa fa-folder-open"></i> Parent</span> 
                              <ul class="tree-box">
                                 <li>
                                    <span><i class="fa fa-minus ic-square"></i> Child 1</span> 
                                    <ul class="tree-box">
                                       <li>
                                          <span><i class="icon-leaf"></i> Grand Child 1</span> 
                                       </li>
                                    </ul>
                                 </li>
                                 <li>
                                    <span><i class="fa fa-minus ic-square"></i> Child 2</span> 
                                    <ul class="tree-box">
                                       <li>
                                          <span><i class="icon-leaf"></i> Grand Child 1</span> 
                                       </li>
                                       <li>
                                          <span><i class="fa fa-minus ic-square"></i> Grand Child 2</span>
                                          <ul class="tree-box">
                                             <li>
                                                <span><i class="fa fa-minus ic-square"></i> Great Grand Child 1</span>
                                                <ul class="tree-box">
                                                   <li>
                                                      <span><i class="icon-leaf"></i> Great Great Grand Child 1</span>                                                         
                                                   </li>
                                                   <li>
                                                      <span><i class="icon-leaf"></i> Great Great Grand Child 2</span>                                                          
                                                   </li>
                                                </ul>
                                             </li>
                                             <li>
                                                <span><i class="icon-leaf"></i> Great Grand Child 2</span> 
                                             </li>
                                             <li>
                                                <span><i class="icon-leaf"></i> Great Grand Child 3</span> 
                                             </li>
                                          </ul>
                                       </li>
                                       <li>
                                          <span><i class="icon-leaf"></i> Grand Child 3</span> 
                                       </li>
                                    </ul>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <span><i class="fa fa-folder-open"></i> Parent2</span> 
                              <ul class="tree-box">
                                 <li>
                                    <span><i class="fa fa-minus ic-square"></i> Child 1</span>
                                    <ul class="tree-box">
                                       <li>
                                          <span><i class="icon-leaf"></i> Great Child 1</span> 
                                       </li>
                                       <li>
                                          <span><i class="icon-leaf"></i> Great Child 2</span> 
                                       </li>
                                    </ul>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            
         </div>
      </div>
      </div>
   
   
	
	
 
	
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>