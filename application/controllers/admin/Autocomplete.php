<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autocomplete extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	}
	
	public function listing(){	
		$switch_type  = $this->input->get('switch_type');
		switch($switch_type){
			case "MEMBER":
				if(trim($_GET['srch']) != ""){
					$srch = str_replace("'", "''", $_GET['srch']);
					$srch = preg_quote($srch);
					//$Q_MEM="SELECT member_id, user_id, first_name, last_name FROM ".prefix."tbl_members WHERE (user_name LIKE '$srch%' OR first_name LIKE '$srch%' OR last_name LIKE '%$srch%' OR member_mobile LIKE '%$srch%')  ORDER BY user_id LIMIT 0,5";
					$Q_MEM="SELECT member_id,plan, user_id, first_name, last_name ,mem.type_id as type,mem.subcription_id as subid ,mem.prod_pv as mrp FROM tbl_members as mem LEFT JOIN tbl_pintype as pin ON mem.type_id=pin.type_id WHERE (user_name LIKE '$srch%' OR first_name LIKE '$srch%' OR last_name LIKE '%$srch%' OR member_mobile LIKE '%$srch%')  ORDER BY member_id LIMIT 0,100";
					$RS_MEM = $this->SqlModel->runQuery($Q_MEM);
					foreach($RS_MEM as $AR_MEM):
					    $member_id = _e($AR_MEM['member_id']);
    					$user_id = $AR_MEM['user_id'];
	    				$mrp = $AR_MEM['mrp'];
		    			$fldvFullName = $AR_MEM['first_name']." ".$AR_MEM['last_name'];
		    			if($AR_MEM['subid'] > 0)
		    			{
		    			    $type='Active';
		    			}
		    			else {
		    			    $type="In-active";
		    			}
		    			
		    				if($AR_MEM['plan']=='A')
		    			{
		    			    $plan='Plan A';
		    			}
		    			else {
		    			    $plan="Plan B";
		    			}
		    			
		    			
		    			if($mrp=="")
						    echo "<li onselect=\"this.setText('$user_id').setValue('$member_id')\"> <span>$user_id</span> $fldvFullName &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Free | <span>$type | $plan</span></li>";
						else
						    echo "<li onselect=\"this.setText('$user_id').setValue('$member_id')\"> <span>$user_id</span> $fldvFullName &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $mrp | <span>$type | $plan</span></li>";
					endforeach;
				}
			break;
				case "MEMBERPOWER":
				if(trim($_GET['srch']) != ""){
					$srch = str_replace("'", "''", $_GET['srch']);
					$srch = preg_quote($srch);
					//$Q_MEM="SELECT member_id, user_id, first_name, last_name FROM ".prefix."tbl_members WHERE (user_name LIKE '$srch%' OR first_name LIKE '$srch%' OR last_name LIKE '%$srch%' OR member_mobile LIKE '%$srch%')  ORDER BY user_id LIMIT 0,5";
					$Q_MEM="SELECT member_id, user_id, first_name, last_name ,mem.type_id as type,mem.subcription_id as subid ,mem.powerbusiness as mrp FROM tbl_members as mem LEFT JOIN tbl_pintype as pin ON mem.type_id=pin.type_id WHERE (user_name LIKE '$srch%' OR first_name LIKE '$srch%' OR last_name LIKE '%$srch%' OR member_mobile LIKE '%$srch%')  ORDER BY member_id LIMIT 0,100";
					$RS_MEM = $this->SqlModel->runQuery($Q_MEM);
					foreach($RS_MEM as $AR_MEM):
					    $member_id = _e($AR_MEM['member_id']);
    					$user_id = $AR_MEM['user_id'];
	    				$mrp = $AR_MEM['mrp'];
		    			$fldvFullName = $AR_MEM['first_name']." ".$AR_MEM['last_name'];
		    			if($AR_MEM['subid'] > 0)
		    			{
		    			    $type='Active';
		    			}
		    			else {
		    			    $type="In-active";
		    			}
		    			if($mrp=="")
						    echo "<li onselect=\"this.setText('$user_id').setValue('$member_id')\"> <span>$user_id</span> $fldvFullName &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Free | <span>$type |</span></li>";
						else
						    echo "<li onselect=\"this.setText('$user_id').setValue('$member_id')\"> <span>$user_id</span> $fldvFullName &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $mrp | <span>$type |</span>   </li>";
					endforeach;
				}
			break;
			case "MEM_DOWNLINE":
				if(trim($_GET['srch']) != ""){
					$srch = str_replace("'", "''", $_GET['srch']);
					$srch = preg_quote($srch);
					$session_member_id = $_GET['member_id'];
					$Q_MEM="SELECT node.member_id, node.user_id, node.first_name, node.last_name FROM ".prefix."tbl_members AS node 
							INNER JOIN ".prefix."tbl_mem_tree AS nodetree ON node.member_id=nodetree.member_id,
							tbl_members AS parent INNER JOIN tbl_mem_tree AS parenttree ON parent.member_id=parenttree.member_id
							WHERE nodetree.nleft BETWEEN parenttree.nleft AND parenttree.nright AND parenttree.member_id='$session_member_id' AND 
							nodetree.member_id!='$session_member_id' AND nodetree.left_right!='' AND 
							(node.user_name LIKE '$srch%' OR node.first_name LIKE '$srch%' OR node.last_name LIKE '$srch%')  
							ORDER BY node.user_id LIMIT 0,5";
					$RS_MEM = $this->SqlModel->runQuery($Q_MEM);
					foreach($RS_MEM as $AR_MEM):
					$member_id = _e($AR_MEM['member_id']);
					$user_id = $AR_MEM['user_id'];
					$fldvFullName = $AR_MEM['first_name']." ".$AR_MEM['last_name'];
						echo "<li onselect=\"this.setText('$user_id').setValue('$member_id')\"> <span>$user_id</span> $fldvFullName</li>";
					endforeach;
				}
			break;
		}
		
		
	}
	
	

	
	
}
