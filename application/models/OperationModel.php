<?php

class OperationModel extends CI_Model {

    private $table;

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
     function get_propertytypes($typeId) {
    // Sanitize input to prevent SQL injection
    $typeId = $this->db->escape($typeId);

    $query = "SELECT * FROM " . prefix . "tbl_propertynew_type WHERE property_id = $typeId  order by type_id " ;
    $result = $this->db->query($query);

    return $result->result_array();
} 
    
         public function gettotalLevforteamnew($member_id) {
    $member_array = [];

//  $QR_SELECT = 'SELECT   m.member_id,  m.user_id,    m.first_name,  m.sponsor_id,  m.date_join,
//  MAX(s.subcription_id) AS subcription_id,  -- Get latest subscription SUM(s.prod_pv) AS total_prod_pv,
//  -- Sum PV if multiple subscriptions MAX(s.date_from) AS date_from, MAX(s.date_time) AS date_time,
//  MAX(s.type_id) AS type_id FROM tbl_members AS m LEFT JOIN tbl_subscription AS s 
//  ON s.member_id = m.member_id  WHERE m.sponsor_id IN (' . implode(',', array_map('intval', $member_id)) . ') GROUP BY m.member_id';

 $QR_SELECT = 'SELECT m.member_id, m.user_id, m.first_name, m.sponsor_id, m.date_join,s.subcription_id, s.prod_pv, s.date_from, s.date_time ,s.type_id  FROM tbl_members AS m LEFT JOIN tbl_subscription AS s 
 ON s.member_id = m.member_id  WHERE m.sponsor_id IN (' . implode(',', array_map('intval', $member_id)) . ') GROUP BY m.member_id';


$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->result_array();

$count = 1;
$member_array = [];

foreach ($AR_SELECT as $val) {
    $member_array[] = $val['member_id']; // Collect unique member IDs
}
$count++;

$data = [
    'total' => count($AR_SELECT),  
    'data_list' => $member_array,  
    'level' => $count,  
    'data' => $AR_SELECT  // Complete grouped result set
];

return $data;
}
    	function getMemberpropertyhistorydetail($id){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_purchaseproperty WHERE id = '".$id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
      function get_propertyblocksnew($typeId,$block) {
    // Sanitize input to prevent SQL injection
    $typeId = $this->db->escape($typeId);

    $query = "SELECT * FROM " . prefix . "tbl_propertynew_blocks WHERE type_id = $typeId and block ='$block'  order by block_id " ;
    $result = $this->db->query($query);

    return $result->result_array();
}
   function get_propertypilots($block) {
    // Sanitize input to prevent SQL injection
    $typeId = $this->db->escape($typeId);

    $query = "SELECT * FROM " . prefix . "tbl_propertynew_blocks WHERE block = '$block' and status='Available'  order by block_id " ;
    $result = $this->db->query($query);

    return $result->result_array();
} 
    function get_propertypilotsdimenstion($plots) {
    // Sanitize input to prevent SQL injection
    $typeId = $this->db->escape($typeId);

    $query = "SELECT * FROM " . prefix . "tbl_propertynew_blocks WHERE block_name = '$plots' order by block_id " ;
    $result = $this->db->query($query);

    return $result->result_array();
} 
    function get_propertyblocks($typeId) {
    // Sanitize input to prevent SQL injection
    $typeId = $this->db->escape($typeId);

    $query = "SELECT * FROM " . prefix . "tbl_propertynew_blocks WHERE type_id = $typeId group by block order by block " ;
    $result = $this->db->query($query);

    return $result->result_array();
}
    
    function getpropertytype(){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_propertynew_type where type_status='Y' GROUP BY type_name order by type_id";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		return $AR_SELECT;
	}
    	function checkCountPlan($table_name,$field,$primary_id){
		$QR_SELECT = "SELECT plan FROM $table_name WHERE $field = '$primary_id' "; 
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
	//	return $AR_SELECT['plan'];
			return ($AR_SELECT['plan']=='A')? "A":"B"; 
	}
    function getSecondLastsubscription($member_id,$subcription_id)
	{
	$QR_SELECT = "SELECT subcription_id,prod_pv,type_id FROM tbl_subscription WHERE   member_id = '$member_id' and subcription_id < $subcription_id  ORDER BY subcription_id DESC LIMIT 1";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT;
	}
    	function getMemberdetailbysubscriptionid($subcription_id){
		$QR_SELECT = "SELECT member_id FROM ".prefix."tbl_subscription WHERE subcription_id = '".$subcription_id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['member_id'];
	}
     function getLastLevel($member_id)
	{
	$QR_SELECT = "SELECT `level` FROM tbl_cmsn_level WHERE   member_id ='$member_id'  ORDER BY level DESC LIMIT 1    ";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT['level'];
	}
    	function getfirstrewarddate($member_id,$rank_id){
		$QR_PLAN = "SELECT ts.date_time as date_time    FROM   tbl_cmsn_reward AS ts  WHERE    ts.member_id='".$member_id."' and ts.reward_id = '$rank_id' ";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['date_time'];
		
	}  
    	function getfirstpackagedate($member_id){
		$QR_PLAN = "SELECT ts.date_from as date_from    FROM   tbl_subscription AS ts  WHERE    ts.member_id='".$member_id."'  and type='A' ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['date_from'];
	}  
    
      function GtcountReward($member_id,$reward_id)
{
         $QR_SELECT = "SELECT count(*) as total  FROM   tbl_cmsn_reward   WHERE 	member_id	 ='$member_id' and reward_id = '$reward_id'";
      
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();
                return	 ($AR_SELECT['total'])? $AR_SELECT['total']:0;
}	
 function GtExistRewardmonthly($member_id,$reward_id,$first_day_this_month,$last_day_this_month)
{
        $QR_SELECT = "SELECT count(*) as total  FROM   tbl_cmsn_reward_2   WHERE 	member_id	 ='$member_id' and reward_id = '$reward_id'  and Date(date_time) BETWEEN '".$first_day_this_month."' AND '".$last_day_this_month."'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();
        return	 ($AR_SELECT['total'])? $AR_SELECT['total']:0;
}   
    function GtcountRewardmonthly($member_id,$reward_id)
{
         $QR_SELECT = "SELECT count(*) as total  FROM   tbl_cmsn_reward_2   WHERE 	member_id	 ='$member_id' and reward_id = '$reward_id'";
      
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();
                return	 ($AR_SELECT['total'])? $AR_SELECT['total']:1;
}	
    
    
    
     function getreward($rank_id)
    {
           $QR_SELECT = "SELECT *  from tbl_reward  where  reward_id ='$rank_id'";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT; 
    }
    function checkpendinghashcode($table_name,$member_id){
	     $QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM tbl_fund_request WHERE member_id ='$member_id' and trn_hascode = '$table_name' and status='P'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
    function checksuccesshashcode($table_name,$member_id){
	     $QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM tbl_fund_request WHERE member_id ='$member_id' and trn_hascode = '$table_name' and status='S'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
    
     function getSubcriptionsxincomedata($member_id)
{
    
            $QR_SELECT = "SELECT sum(x_income) as total FROM `tbl_subscription` where member_id ='$member_id' group by member_id";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total'];
}
       function getlevelPostingCount1($from_member_id,$member_id,$level,$pakage){
		$QR_SEL = "SELECT COUNT(id) AS ctrl_count FROM ".prefix."tbl_cmsn_level  WHERE  from_member_id = '".$from_member_id."'  AND member_id='".$member_id."' AND level ='".$level."' AND total_income ='".$pakage."'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count'];
	}
    	function getCountryName1(){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		return $AR_SELECT;
	}
    
    	function getCountryName($country_code){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE country_code='$country_code'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}

    	function getMobileCodebyname($country_code){
	    $QR_SELECT = "SELECT country_name FROM ".prefix."tbl_country WHERE phonecode = '$country_code'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['country_name'];
	}
     function checkdepositeaddress($table_name){
		 $QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM tbl_members WHERE ownaddress = '$table_name' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	
	function checkotheraddress($table_name,$table_value){
		 $QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM tbl_members WHERE $table_name = '$table_value' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
    	function getsponsortotalroiincome($member_id,$process_idddd){
		$QR_PLAN = "SELECT sum(`net_income`) as total FROM `tbl_cmsn_daily` WHERE  member_id='$member_id' and process_id= '$process_idddd' group by member_id;";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
    	function getsponsortotalincome($member_id){
		$QR_PLAN = "SELECT sum(`trns_amount`) as total FROM `tbl_wallet_trns` WHERE `trns_for`='INCOME' and member_id='$member_id' group by member_id;";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
    
    
    	function getTotalWithdrawal($member_id){
		$QR_PLAN = "SELECT sum(stacking) as total  FROM tbl_fund_transfer as tft    WHERE  (tft.trns_for = 'WITHDRAW' OR  tft.trns_for =  'MININGWITHDRAW') AND  ( tft.wallet_id='1' or  tft.wallet_id='2')
       and tft.trns_status='C' and from_member_id ='$member_id' ORDER BY tft.transfer_id DESC";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
    function checkhastatus($from_address){
		 $QR_SELECT = "SELECT transaction_hash AS ctrl_count FROM transactions_s WHERE from_address='$from_address' ORDER BY `transactions_s`.`id` DESC limit 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
     function getkeyus($member_id){
		 $QR_SELECT = "SELECT c_address_new AS ctrl_count FROM tbl_user_wallet_address WHERE member_id='$member_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
     function checkgasstatus($member_id){
		 $QR_SELECT = "SELECT gasfee AS ctrl_count FROM tbl_cryptofund WHERE gasfee = '0' and member_id='$member_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
      public function gettotalLevnew($member_id,$count=1)
	{
	    
	    $member_array = [];
	    $QR_SELECT = 'SELECT  m.member_id,m.user_id,m.self_bv,m.team_bv,m.club_id,m.first_name,m.sponsor_id,m.date_join ,s.subcription_id, s.prod_pv ,s.date_from  FROM `tbl_members`  as m  left join tbl_subscription as s on s.member_id=m.member_id  WHERE m.`sponsor_id` IN (' . implode(',', array_map('intval', $member_id)) . ')  group by m.`member_id` order by m.team_bv DESC  ';
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		foreach($AR_SELECT as $val)
		{
		$member_array[] = $val['member_id'];$i++;
		}
		$count++;
		$data['total'] = count($AR_SELECT);
		$data['level'] = $count;
		$data['data_list'] = $member_array;
		$data['data'] = $AR_SELECT;
		 
	
	    return $data;
	
		
	 	 
	}
     function	getsubsid($member_id)
	{
	    
	    
	    	$QR_SELECT = "SELECT subcription_id FROM  tbl_subscription as m  WHERE m.member_id ='$member_id' and retopup='N'  and pool='N' and type='A'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['subcription_id'];
	}
    
    function	GetcurrentBussinessTotal($member_id)
	{
	    
	    
	    $QR_SELECT = "SELECT self_bv,team_bv,direct_bv  FROM  tbl_members as m  WHERE m.member_id ='$member_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
    
    
    function checkgasfeee($table_name,$field,$primary_id,$type){
		 $QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM $table_name WHERE $field = '$primary_id' and gasfee = '$type'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
             function openticket()
    {
        $QR_SELECT = "SELECT COUNT(*) as total FROM `tbl_support` WHERE `enquiry_sts` =  'O'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        return $AR_SELECT['total'];
    }
    
        	function getallCurrentBalance($member_id,$wallet_id,$from_date='',$to_date=''){	
		if($from_date!='' && $to_date!=''){
			$StrWhr .=" AND DATE(trns_date) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
		}
		$QR_TRNS_CR = "SELECT SUM(trns_amount) AS total_amount_cr  
					   FROM tbl_wallet_trns WHERE trns_type LIKE 'Cr'    AND wallet_id IN(".$wallet_id.") $StrWhr ORDER BY wallet_trns_id DESC";
		$RS_TRNS_CR = $this->db->query($QR_TRNS_CR);
		$AR_TRNS_CR = $RS_TRNS_CR->row_array();
		$total_amount_cr = $AR_TRNS_CR['total_amount_cr'];

		$QR_TRNS_DR = "SELECT SUM(trns_amount) AS total_amount_dr  
					   FROM tbl_wallet_trns WHERE trns_type LIKE 'Dr' AND wallet_id IN(".$wallet_id.")	$StrWhr ORDER BY wallet_trns_id DESC";
		$RS_TRNS_DR = $this->db->query($QR_TRNS_DR);
		$AR_TRNS_DR = $RS_TRNS_DR->row_array();
		$total_amount_dr = $AR_TRNS_DR['total_amount_dr'];
		
		$net_balance = $total_amount_cr-$total_amount_dr;
		
		$AR_RT['total_amount_cr']=$total_amount_cr;
		$AR_RT['total_amount_dr']=$total_amount_dr;
		$AR_RT['net_balance']=$net_balance;
		
		return $AR_RT;
	}
     function netwithdrawal()
       {
           $QR_SELECT = "SELECT sum(trns_amount) as total  FROM ".prefix."tbl_fund_transfer AS tft  WHERE tft.trns_for LIKE 'WITHDRAW'  and trns_status='C'  ORDER BY tft.transfer_id DESC";
           $RS_SELECT = $this->db->query($QR_SELECT);
		   $AR_SELECT = $RS_SELECT->row_array();
		   return $AR_SELECT['total'];
       }
       
    function pendingwithdrawal($date)
       {
           $QR_SELECT = "SELECT sum(trns_amount) as total  FROM ".prefix."tbl_fund_transfer AS tft  WHERE tft.trns_for LIKE 'WITHDRAW'  and trns_status='P' /*and trns_date ='$date'*/ ORDER BY tft.transfer_id DESC";
           $RS_SELECT = $this->db->query($QR_SELECT);
		   $AR_SELECT = $RS_SELECT->row_array();
		   return $AR_SELECT['total'];
       }
    
    	function checkCountcrypto($table_name,$field,$primary_id,$type){
		 $QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM $table_name WHERE $field = '$primary_id' and symbol = '$type'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
    	function getclubrank($member_id){
		$QR_SELECT = "SELECT rank_id FROM ".prefix."tbl_cmsn_quick_club WHERE member_id = '".$member_id."' order by daily_cmsn_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['rank_id'];
	}
	
		function getstatusbysubsid($subcription_id){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_subscription WHERE subcription_id = '".$subcription_id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
    	function getTotalMemberShipValueFirstpackage($member_id){
		$QR_PLAN = "SELECT sum(ts.package_price) as total    FROM   tbl_subscription AS ts  WHERE ts.pool='N' and type='A' and ts.member_id='".$member_id."'  ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
		function getTotalMemberShipValuesecondpackage($member_id){
		$QR_PLAN = "SELECT sum(ts.package_price) as total    FROM   tbl_subscription AS ts  WHERE ts.pool='Y' and type='U' and ts.member_id='".$member_id."'  ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
      function getairdropamount($sponsor_id){
		$QR_MEM = "SELECT sum(`amount`) as total FROM `tbl_airdrop` WHERE `sponsor_id`='$sponsor_id' and status='Y'; ";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['total'];
	}
	
	 function getairdropamountself($member_id){
		$QR_MEM = "SELECT sum(`trns_amount`) as total FROM `tbl_wallet_trns` WHERE `member_id`='$member_id' and trns_remark='Air Drop Self'; ";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['total'];
	}
	   function getairdropcountverify($sponsor_id){
		$QR_MEM = "SELECT count(`sponsor_id`) as total FROM `tbl_airdrop` WHERE `sponsor_id`='$sponsor_id' and status='Y'; ";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['total'];
	}
	function getairdropcount($sponsor_id){
		$QR_MEM = "SELECT count(`sponsor_id`) as total FROM `tbl_airdrop` WHERE `sponsor_id`='$sponsor_id'";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['total'];
	}
    	function getcomPostingCountnew($member_id,$trans_amount,$frommember_id,$level){
		$QR_SEL = "SELECT COUNT(id) AS ctrl_count FROM ".prefix."tbl_cmsn_community 
				  WHERE  member_id = '".$member_id."'   AND  total_income = '".$trans_amount."'  AND  from_member_id = '".$frommember_id."'   AND  level = '".$level."'    ";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count']+1;
	}
    function getsubscriptionbypackage($member_id,$amount){
		$QR_MEM = "SELECT package_price FROM ".prefix."tbl_subscription WHERE member_id='".$member_id."' and pool='Y' and package_price='$amount'";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['package_price'];
	}
    function getdirectcount($member_id){
		$QR_MEM = "SELECT count_directs FROM ".prefix."tbl_members WHERE member_id='".$member_id."'";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['count_directs'];
	}
    	function gettotalminingamount($member_id)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_daily WHERE member_id='$member_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
		function gettotalminingamount1($member_id,$package)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_daily WHERE member_id='$member_id' and trans_amount ='$package'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
	return ($AR_SELECT['ctrl_count'] > 0 )? $AR_SELECT['ctrl_count']: 0 ; 
	 
	}
    	function gettotaldirectamount($member_id)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_direct WHERE member_id='$member_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
    
     function packagecount($member_id)
    {
        $QR_SELECT = "SELECT count(*) as total FROM `tbl_subscription` WHERE `member_id`='$member_id' and `pool`='N'; ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT['total'];   
    } 
    function getTotdaymining($member_id,$date)
    {
        $QR_SELECT = "SELECT COUNT(*) as total  FROM `tbl_cmsn_daily` WHERE member_id ='$member_id' AND date(`date_time`) = date('$date')  ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT['total'];   
    } 
     function getLastMemberpackagetypeid($member_id){
		 $QR_GET = "SELECT type_id FROM ".prefix."tbl_subscription AS tm WHERE 1  and tm.member_id = '$member_id' and tm.pool='N' ORDER BY tm.subcription_id  DESC LIMIT 1"; 
		 $AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		 return $AR_GET['type_id'];
	}
	
		function getTotalMemberShipValueTP($member_id){
		$QR_PLAN = "SELECT sum(ts.package_price) as total    FROM   tbl_subscription AS ts  WHERE ts.pool='Y' and  ts.member_id='".$member_id."'  ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
	
		function getTotalMemberShipValueRTP($member_id){
		$QR_PLAN = "SELECT sum(ts.package_price) as total    FROM   tbl_subscription AS ts  WHERE retopup='Y' and  ts.member_id='".$member_id."'  ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
		function getTotalMemberShipValueTLevel($member_id){
		 $QR_PLAN = "SELECT sum(ts.package_price) as total    FROM   tbl_subscription AS ts  WHERE  ts.retopup='N' and ts.member_id='".$member_id."'  group BY ts.member_id ";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
		function getTotalMemberShipValueTLevelretopup($member_id){
		$QR_PLAN = "SELECT sum(ts.package_price) as total    FROM   tbl_subscription AS ts  WHERE  ts.retopup='Y' and ts.member_id='".$member_id."'  group BY ts.member_id ";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
    	function getTotalMemberShipValueT($member_id){
		$QR_PLAN = "SELECT sum(ts.package_price) as total    FROM   tbl_subscription AS ts  WHERE  retopup='N'  and ts.member_id='".$member_id."'  ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
     function getLastMembertypeidretopup($member_id,$type_id){
		 $QR_GET = "SELECT  type_id  FROM ".prefix."tbl_subscription AS tm WHERE 1  and tm.member_id = '$member_id' and type_id='$type_id' and pool ='Y' ORDER BY tm.subcription_id  DESC LIMIT 1"; 
		 $AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		 return $AR_GET['type_id'];
	}
    	function checkCountretopup($table_name,$field,$primary_id,$retopup){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM $table_name WHERE $field = '$primary_id' and pool = '$retopup' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
		function checkCounttopupmining($table_name,$field,$primary_id,$retopup,$type){
		 $QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM $table_name WHERE $field = '$primary_id' and pool = '$retopup' and type='$type'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	function checkCounttopup($table_name,$field,$primary_id,$retopup){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM $table_name WHERE $field = '$primary_id' and pool = '$retopup' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
     function getLastMembertypeid($member_id){
		 $QR_GET = "SELECT  type_id  FROM ".prefix."tbl_subscription AS tm WHERE 1  and tm.member_id = '$member_id' ORDER BY tm.subcription_id  DESC LIMIT 1"; 
		 $AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		 return $AR_GET['type_id'];
	}
    function getLastMemberpackage($member_id){
		 $QR_GET = "SELECT prod_pv FROM ".prefix."tbl_subscription AS tm WHERE 1  and tm.member_id = '$member_id' ORDER BY tm.prod_pv  DESC LIMIT 1"; 
		 $AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		 return $AR_GET['prod_pv'];
	}
    	function getlifetimeCount($matching_pv,$member_id){
	echo	$QR_SEL = "SELECT COUNT(id) AS ctrl_count FROM ".prefix."tbl_cmsn_reward 
				  WHERE  matching_pv = '".$matching_pv."'  AND member_id='".$member_id."'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count']+1;
	}
      public function gettotalLevMatrix22($member_id,$count=1)
	{
	    
        $member_array =array();
        $QR_SELECT = 'SELECT  m.id  FROM `tbl_level_members`  as m      WHERE m.`spill_id` IN (' . implode(',', array_map('intval', $member_id)) . ')    ';
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->result_array();
		foreach($AR_SELECT as $val)
		{
		$member_array[] = $val['id'];$i++;
		}
		$count++;
		$data['total'] = count($AR_SELECT);
		$data['level'] = $count;
		$data['data_list'] = $member_array;
	//	$data['data'] = $AR_SELECT;
		 
	
	    return $data;
	
		
	 	 
	}
     function getPoolCountByLevel($spill_id,$level)
        {
        $QR_SEL = "SELECT count(*) as total  FROM `tbl_level_members` WHERE `level` =  '$level'  and spill_id ='$spill_id'  ";
        $AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
        return $AR_SEL['total'];
        
        
        }
        function CheckCountsPool2($subscription_id,$member_id,$type,$level)
    {
        
        
            $QR_SELECT = "SELECT count(*) as total FROM `tbl_cmsn_pool` WHERE subcription_id = '$subscription_id' and  member_id ='$member_id' and type = '$type' and level ='$level' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 

    }  
       function getPoolSpillByLevel($level)
        {
        $QR_SEL = "SELECT * FROM `tbl_level_members` WHERE `level` =  '$level' ORDER BY id DESC LIMIT 1  ";
        $AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
      
        if($AR_SEL['spill_id'] > 0 )
        {
           $spill_id =  $AR_SEL['spill_id'];
        }
        else
        {
           $spill_id =  $AR_SEL['id']; 
        }
          $count = $this->getPoolCountByLevel($spill_id,$level);
       
        if($count < 2 )
        {  
             $AR_DT['count']    = $count;
             $AR_DT['spill_id'] = $spill_id;
        }
        else
        {  
                $QR_SEL = "SELECT * FROM `tbl_level_members` WHERE `level` =  '$level'  and id > $spill_id  ORDER BY id ASC LIMIT 1  ";
                $AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
               
             
                        $AR_DT['count']    = 0;
                        $AR_DT['spill_id'] = $AR_SEL['id'];
        }
      
        return $AR_DT;
        
        
        }
        function getcountsPoolEntry($level)
    {
         $QR_SELECT = "SELECT count(*) as total  FROM `tbl_level_members`   WHERE  level = '$level'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();
        return $AR_SELECT['total'];
    } 
    	function getMemberwallet_adress($member_id)
	{
		$QR_SELECT = "SELECT c_address AS address FROM ".prefix."tbl_user_wallet_address WHERE member_id='$member_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['address'];
	 
	}
    	function getboostermemberbypercentage($per)
	{
		$QR_SELECT = "SELECT count(member_id) AS total FROM ".prefix."tbl_cmsn_quick WHERE daily_return='$per'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['total'];
	 
	}
    	function getLevelamountbylevel($member_id,$level)
	{
		$QR_SELECT = "SELECT sum(net_income) AS net_income,sum(total_income) AS total_income FROM ".prefix."tbl_cmsn_level WHERE member_id='$member_id' and level='$level'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	 
	}
     function getStakingFigur($member_id)
    {
    $Q_CTRL = "SELECT * FROM `tbl_subscription` WHERE `member_id` =  '$member_id' ";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
    $PerDay = 0;
    if(count($A_CTRL) > 0 )
    {
       foreach($A_CTRL as $R)
       { // PrintR($A_CTRL); die;
                 if($R['type_id'] == 1)     {  $PerDay1 =  $R['package_price']*8/100/24/60/60;  }
                elseif($R['type_id'] == 2) {  $PerDay1 =  $R['package_price']*10/100/24;  }
                elseif($R['type_id'] == 3) {  $PerDay1 =   $R['package_price']*12/100/24;  }
                // elseif($R['type_id'] == 4) {  $PerDay1 =  $R['package_price']*2/100/24;  }
                // elseif($R['type_id'] == 5) {  $PerDay1 =  $R['package_price']*2/100/24;  }
                else {$PerDay1 =  0 ;}
                
                $PerDay += $PerDay1;
       }
       return $PerDay;
    }
    else
    {
        return 0;
    }
  
        
    }  
    
    
    	function getPostingCountboard($boardno,$slotno,$amount,$member_id){
		$QR_SEL = "SELECT COUNT(id) AS ctrl_count FROM ".prefix."tbl_board_return 
				  WHERE  board_no = '".$boardno."'  AND slot_no='".$slotno."'  AND amount='".$amount."'  AND member_id='".$member_id."' ";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count']+1;
	}
    
     function getboardincomeadmin($type,$date)
{
       
if($type=='Pool'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
 $QR_SELECT = "SELECT SUM(`trns_amount`) as net_income FROM `tbl_wallet_trns` WHERE trns_for ='Pool' and trns_date = '$date' ";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();

return ($AR_SELECT['net_income'] > 0 )? $AR_SELECT['net_income']: 0 ;   
    
    
} 
}
    function getdirectincomeadmin($type,$date)
{
       
if($type=='DCA'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
 $QR_SELECT = "SELECT SUM(`trns_amount`) as net_income FROM `tbl_wallet_trns` WHERE trns_for ='DCA' and trns_date = '$date' ";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();

return ($AR_SELECT['net_income'] > 0 )? $AR_SELECT['net_income']: 0 ;   
    
    
} 
}
    function getlevelincomeadmin($type,$date)
{
       
if($type=='INCOME_L'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
 $QR_SELECT = "SELECT SUM(`trns_amount`) as net_income FROM `tbl_wallet_trns` WHERE trns_for ='INCOME_L' and trns_date = '$date' ";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();

return ($AR_SELECT['net_income'] > 0 )? $AR_SELECT['net_income']: 0 ;   
    
    
} 
}

    function getroiincomeadmin($type,$process_id)
{
       
if($type=='Daily'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
 $QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_daily` WHERE   process_id = '$process_id' ";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();

return ($AR_SELECT['net_income'] > 0 )? $AR_SELECT['net_income']: 0 ;   
    
    
} 
}
  function getboardincome($type,$member_id,$date)
{
       
if($type=='Baord'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
 $QR_SELECT = "SELECT SUM(`trns_amount`) as net_income FROM `tbl_wallet_trns` WHERE  member_id ='$member_id' and trns_for ='Baord' and trns_date = '$date' ";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();

return ($AR_SELECT['net_income'] > 0 )? $AR_SELECT['net_income']: 0 ;   
    
    
} 
}   


function getincomesallnewadmin($type,$member_id,$process_id)
{
if($type=='Direct'){
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_direct` WHERE  member_id ='$member_id' and process_id='$process_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];    
    
    
} if($type=='Daily'){
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_daily` WHERE  member_id ='$member_id' and process_id='$process_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];    
    
    
}   
 if($type=='Booster'){
    
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_quick` WHERE  member_id ='$member_id' and process_id='$process_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];    
    
    
}    
if($type=='Community'){
    
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_community` WHERE  member_id ='$member_id' and process_id='$process_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
}    
if($type=='Level'){
    
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM tbl_cmsn_level WHERE  member_id= '$member_id' and process_id='$process_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
}         
 if($type=='Pool'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
$QR_SELECT = "SELECT SUM(`trns_amount`) as net_income FROM `tbl_wallet_trns` WHERE  member_id ='$member_id' and trns_for ='Pool' and trns_date='$process_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
} 
 if($type=='DAILY_I'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
$QR_SELECT = "SELECT SUM(`trns_amount`) as net_income FROM `tbl_wallet_trns` WHERE  member_id ='$member_id' and trns_for ='ROI' and trns_date='$process_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
} 
if($type=='Reward_1'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_reward WHERE member_id='$member_id'  ";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
} 
if($type=='Reward_2'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_reward_2 WHERE member_id='$member_id'  ";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
} 
} 
function getincomesallnew($type,$member_id)
{
if($type=='Direct'){
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_direct` WHERE  member_id ='$member_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];    
    
    
} if($type=='Daily'){
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_daily` WHERE  member_id ='$member_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];    
    
    
}   
 if($type=='Booster'){
    
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_quick` WHERE  member_id ='$member_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];    
    
    
} 
if($type=='Club'){
    
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_quick_club` WHERE  member_id ='$member_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];    
    
    
} 
if($type=='Performance'){
    
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_quick_performance` WHERE  member_id ='$member_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];    
    
    
} 
if($type=='Community'){
    
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM `tbl_cmsn_community` WHERE  member_id ='$member_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
}    
if($type=='Level'){
    
    
    
$QR_SELECT = "SELECT SUM(`net_income`) as net_income FROM tbl_cmsn_level WHERE  member_id= '$member_id'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
}         
 if($type=='Pool'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
$QR_SELECT = "SELECT SUM(`trns_amount`) as net_income FROM `tbl_wallet_trns` WHERE  member_id ='$member_id' and trns_for ='Pool'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
} 
 if($type=='Re_Pool'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
$QR_SELECT = "SELECT SUM(`trns_amount`) as net_income FROM `tbl_wallet_trns` WHERE  member_id ='$member_id' and trns_for ='Re_Pool'";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
}
if($type=='Reward_1'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
 $QR_SELECT = "SELECT sum(net_income) AS net_income FROM ".prefix."tbl_cmsn_reward WHERE member_id='$member_id'  ";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
} 
if($type=='Reward_2'){
    
    // SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			 //  WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."' and trns_for ='Baord'
			 //  $StrWhr 
			 //  ORDER BY twt.wallet_trns_id DESC
    
 $QR_SELECT = "SELECT sum(net_income) AS net_income FROM ".prefix."tbl_cmsn_reward_2 WHERE member_id='$member_id'  ";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->row_array();
return $AR_SELECT['net_income'];   
    
    
} 
} 
    	function getCurrentMemberShipRetopup($member_id){
		$QR_PLAN = "SELECT ts.*, tp.pin_name, tp.type_id, tp.avtar 
					FROM   ".prefix."tbl_subscription AS ts
					LEFT JOIN  ".prefix."tbl_pintype AS tp  ON tp.type_id=ts.type_id 
					WHERE ts.subcription_id = (SELECT MAX(subcription_id) FROM tbl_subscription WHERE ts.subcription_id=subcription_id)
					AND ts.member_id='".$member_id."' and type ='A' ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN;
	}
       function getretopupPoolUserId($spill_id , $position){
		$QR_SELECT = "SELECT M.member_id FROM `tbl_level_members_2` AS L LEFT JOIN tbl_members as M ON M.member_id = L.member_id WHERE L.`spill_id` =  '$spill_id' AND L.`position` = '$position'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['member_id'];
	}
	 function getPoolUserIdnew($spill_id , $position){
	     if($spill_id>0){
	     
		$QR_SELECT = "SELECT M.member_id FROM `tbl_level_members` AS L LEFT JOIN tbl_members as M ON M.member_id = L.member_id WHERE L.`spill_id` =  '$spill_id' AND L.`position` = '$position'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['member_id'];
		
	     }
	}
	
	
	
    function getPoolUserId($spill_id , $position){
		$QR_SELECT = "SELECT M.member_id FROM `tbl_level_members` AS L LEFT JOIN tbl_members as M ON M.member_id = L.member_id WHERE L.`spill_id` =  '$spill_id' AND L.`position` = '$position'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['member_id'];
	}
     function getCountPackage($member_id)
    {
        $QR_SELECT = "SELECT  COUNT(*) AS total FROM  tbl_subscription   WHERE  member_id='".$member_id."'  and type_id !='6'"; 
		$RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();
       return  $total     =  $AR_SELECT['total']; 
        
    }
    

    	function getpboardcount($price){
	 	$QR_SEL = "SELECT count(member_id) as total FROM `tbl_wallet_trns` WHERE  `trns_amount`='$price' and trns_for ='Baord' group by trns_amount ";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		 
		return $AR_SEL['total'];
	}
    
    	function getpboardsubsdate($price,$type){
	 	$QR_SEL = "SELECT date_time as date FROM `tbl_subscription` WHERE `prod_pv`='$price' and type='$type'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		 
		return $AR_SEL['date'];
	}
    
    	function getLastMemberold($member_id){
		 $QR_GET = "SELECT member_id FROM ".prefix."tbl_members AS tm WHERE 1  and tm.member_id < '$member_id' ORDER BY tm.member_id DESC LIMIT 1"; 
		 $AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		 return $AR_GET['member_id'];
	}
	
		function getLastMemberNew($member_id){
		 $QR_GET = "SELECT member_id FROM ".prefix."tbl_members AS tm WHERE 1  and tm.member_id > '$member_id' ORDER BY tm.member_id ASC LIMIT 1"; 
		 $AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		 return $AR_GET['member_id'];
	}
		function getLastMemberNew3($member_id){
		 $QR_GET = "SELECT member_id FROM ".prefix."tbl_members AS tm WHERE 1  and tm.member_id > '$member_id' ORDER BY tm.member_id DESC LIMIT 1"; 
		 $AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		 return $AR_GET['member_id'];
	}
	function p2pwithdral($member_id){
	 	$QR_SEL = "SELECT sum(p.trns_amount) as total  FROM `tbl_wallet_trns` as p  WHERE p.trns_remark='Sold By P2P'  and p.member_id='$member_id'";
	        $RS_SELECT = $this->db->query($QR_SEL);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 

		 
		return $AR_SEL['fldiCtrl'];
	}
    		function getPostingCount3($member_id,$cmsn_date){
	 	$QR_SEL = "SELECT COUNT(member_id) AS fldiCtrl FROM tbl_members  WHERE sponsor_id='$member_id' AND member_id IN (SELECT member_id FROM tbl_subscription WHERE date_from <='$cmsn_date')";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		 
		return $AR_SEL['fldiCtrl'];
	}
    
       function memberParentLevelList($member_id)
        {
        $QR_SELECT = "SELECT member_id ,sponsor_id  FROM (SELECT member_id ,sponsor_id,  CASE WHEN member_id = '$member_id' THEN @id := sponsor_id WHEN member_id = @id THEN @id := sponsor_id END as checkId FROM tbl_members ORDER BY member_id DESC) as T WHERE checkId IS NOT NULL";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->result_array();
        return $AR_SELECT;   
        }  
        
 function memberParentLevelListssssssssssssss($member_id)
        {
        $QR_SELECT = "SELECT member_id ,sponsor_id,count_directs,rank_id,subcription_id  FROM (SELECT member_id ,sponsor_id,count_directs,rank_id,subcription_id,  CASE WHEN member_id = '$member_id' THEN @id := sponsor_id WHEN member_id = @id THEN @id := sponsor_id END as checkId FROM tbl_members ORDER BY member_id DESC) as T WHERE checkId IS NOT NULL";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->result_array();
        return $AR_SELECT;   
        }        
        function clubmemberParentLevelLists($member_id)
        {

        $QR_SELECT = "SELECT member_id ,sponsor_id,count_directs,team_bv,direct_bv,rank_id,subcription_id  FROM (SELECT member_id ,sponsor_id,count_directs,team_bv,direct_bv,rank_id,subcription_id,  CASE WHEN member_id = '$member_id' THEN @id := sponsor_id WHEN member_id = @id THEN @id := sponsor_id END as checkId FROM tbl_members ORDER BY member_id DESC) as T WHERE checkId IS NOT NULL";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->result_array();
        return $AR_SELECT;   
        }  
      
  	    function memberParentLevelLists($member_id)
        {

        $QR_SELECT = "SELECT member_id ,sponsor_id,count_directs,team_bv,direct_bv,rank_id,subcription_id  FROM (SELECT member_id ,sponsor_id,count_directs,team_bv,direct_bv,rank_id,subcription_id,  CASE WHEN member_id = '$member_id' THEN @id := sponsor_id WHEN member_id = @id THEN @id := sponsor_id END as checkId FROM tbl_members ORDER BY member_id DESC) as T WHERE checkId IS NOT NULL";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->result_array();
        return $AR_SELECT;   
        }       

function memberParentLevelLists2old($member_id)
{

$QR_SELECT = "SELECT member_id ,sponsor_id,rank_id,count_directs,subcription_id   FROM (SELECT member_id ,sponsor_id,rank_id,count_directs,subcription_id,  CASE WHEN member_id = '$member_id' THEN @id := sponsor_id WHEN member_id = @id THEN @id := sponsor_id END as checkId FROM tbl_members ORDER BY member_id DESC) as T WHERE checkId IS NOT NULL";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->result_array();
return $AR_SELECT;   
}
function memberParentLevelLists2($member_id)
{

 $QR_SELECT = "SELECT member_id ,sponsor_id,rank_id,count_directs,subcription_id   FROM (SELECT member_id ,sponsor_id,rank_id,count_directs,subcription_id,  CASE WHEN member_id = '$member_id' THEN @id := sponsor_id WHEN member_id = @id THEN @id := sponsor_id END as checkId FROM tbl_members ORDER BY member_id DESC) as T WHERE checkId IS NOT NULL";
$RS_SELECT = $this->db->query($QR_SELECT);
$AR_SELECT = $RS_SELECT->result_array();
return $AR_SELECT;   
}
    function checkliability($member_id)
    {
        
        
         $QR_SELECT = "SELECT sum(prod_pv) as total FROM `tbl_subscription` WHERE `prod_pv` ='0' AND member_id ='$member_id' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 

    }
    function getrankstatus($member_id,$rank_id)
    {
           $QR_SELECT = "SELECT count(*) as total  from tbl_members  where  rank_id >='$rank_id' and member_id ='$member_id' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
    }  
        function getrankstatussss($member_id,$rank_id)
    {
           $QR_SELECT = "SELECT count(*) as total,date_time as date_time  from tbl_cmsn_reward  where  reward_id >='$rank_id' and member_id ='$member_id'  GROUP by reward_id ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT; 
    } 
      function getrankstatussss_2($member_id,$rank_id)
    {
           $QR_SELECT = "SELECT count(*) as total,date_time as date_time  from tbl_cmsn_reward_2  where  reward_id >='$rank_id' and member_id ='$member_id'  GROUP by reward_id ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT; 
    } 
     function getWithdrawStsCrypto($member_id)
    {
        $QR_SELECT = "SELECT Withdrawal_status_C as total  FROM `tbl_members` WHERE member_id = '$member_id' ";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        return $AR_SELECT['total'];
     }
    function getMRPofPackage($type_id)
    {
        
        $QR_SELECT = "SELECT pin_price as total FROM `tbl_pintype`   WHERE  type_id  = '$type_id'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        return   ($AR_SELECT['total'] > 0 )? $AR_SELECT['total']: 0 ; 
    }
    function totalGlobalPackage($member_id)
    {
        // echo $member_id;
        $QR_SELECT = "SELECT SUM(s2.prod_pv) as total FROM `tbl_subscription` as s1 LEFT JOIN tbl_subscription as s2 on s1.member_id = s2.member_id WHERE s1.bulk_by = '$member_id' AND s2.type ='A'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        $CHiLD_A    = ($AR_SELECT['total'] > 0 )? $AR_SELECT['total']: 0 ; 
        
        
        
        $QR_SELECT = "SELECT SUM(s2.prod_pv) as total FROM `tbl_subscription` as s1 LEFT JOIN tbl_subscription as s2 on s1.member_id = s2.member_id WHERE s1.bulk_by = '$member_id' AND s2.type ='U'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        $CHiLD_U    = ($AR_SELECT['total'] > 0 )? $AR_SELECT['total']: 0 ; 

        
        $QR_SELECT = "SELECT SUM(s1.prod_pv) as total FROM `tbl_subscription` as s1   WHERE s1.member_id = '$member_id'  AND s1.type ='A'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
         $PAReNT_A    = ($AR_SELECT['total'] > 0 )? $AR_SELECT['total']: 0 ; 
        
        $QR_SELECT = "SELECT SUM(s1.prod_pv) as total FROM `tbl_subscription` as s1   WHERE s1.member_id = '$member_id'  AND s1.type ='U'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        $PAReNT_U    = ($AR_SELECT['total'] > 0 )? $AR_SELECT['total']: 0 ; 
        
        
          $_300 = ($CHiLD_U + $PAReNT_U) * 150 /100;
          $_200 = ($CHiLD_A + $PAReNT_A) * 150 /100;
        $ToTAL = $_300 + $_200 ;
        return $ToTAL;
        
        
    }
    
    function checkPrentsIdorNot($member_id)
    {
        $QR_SELECT = "SELECT bulk_by FROM `tbl_subscription` WHERE `member_id` = '$member_id' ORDER BY `subcription_id` ASC LIMIT 1";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        $return    = ($AR_SELECT['bulk_by'] > 0 )? $AR_SELECT['bulk_by']: 0 ; 
        return $return;
    }
    
    
    
function getlivecryptoprice($cryptoname) {
        
        $url = "https://api.wazirx.com/sapi/v1/ticker/24hr?symbol=$cryptoname";
        $json = file_get_contents($url);
        $jo = json_decode($json);
        $price= $jo->lastPrice;
        return $price;
        
    }
    function checkManualSubscriber($member_id)
    {
        $QR_SELECT = "SELECT COUNT(*) as total FROM `tbl_subscription` WHERE `type_id` = '8' AND package_price > '0' AND member_id ='$member_id'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        return $AR_SELECT['total'];
    }
      function checkPendingReqCoinPayment($member_id)
    {
        $QR_SELECT = "SELECT COUNT(*) as total FROM `tbl_coinpayment` WHERE member_id = '$member_id' AND status ='N'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        return $AR_SELECT['total'];
    }
   
    function countChat($enquiry_id)
    {
        $QR_SELECT = "SELECT COUNT(*) as total FROM `tbl_support_rply` WHERE `enquiry_id` =  '$enquiry_id'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();		
        return $AR_SELECT['total'];
    }
    function getPooldetails($id)
    {
                if($id > 0 )
                {
                        $QR_SELECT = "SELECT m.user_id FROM `tbl_level_members` as p LEFT JOIN tbl_members as m on m.member_id = p.member_id WHERE p.id = $id";
                        $RS_SELECT = $this->db->query($QR_SELECT);
                        $AR_SELECT = $RS_SELECT->row_array();	 
                        if($AR_SELECT['user_id'] !='')
                        {
                        return ' <img src="'.BASE_PATH.'assets/images/green1.png" border="0"           class="pointer img-circle" width="60" height="60"> <br>   <b>'. $AR_SELECT['user_id'].'<b>';
                        }  
                        else
                        {
                        return ' <img src="'.BASE_PATH.'assets/images/black1.png" border="0"           class="pointer img-circle" width="60" height="60">    ';    
                        }
                }
                else
                { 
                  return ' <img src="'.BASE_PATH.'assets/images/black1.png" border="0"           class="pointer img-circle" width="60" height="60">    ';    
                }
                
               
    }
    
    function checkcountsTotalDReturns($id)
    {
                $QR_SELECT = "SELECT   count(*) as total FROM tbl_cmsn_direct_R    WHERE direct_id ='$id'   ";
                $RS_SELECT = $this->db->query($QR_SELECT);
                $AR_SELECT = $RS_SELECT->row_array();		
                return $AR_SELECT['total']+1; 
    }
    
    
    function checkcountsTotalBReturns($id)
    {
                $QR_SELECT = "SELECT   count(*) as total FROM tbl_cmsn_binary_R    WHERE binary_id ='$id'   ";
                $RS_SELECT = $this->db->query($QR_SELECT);
                $AR_SELECT = $RS_SELECT->row_array();		
                return $AR_SELECT['total']+1; 
    }
    
    
        function checkCount25($member_id)
        {
                $QR_SELECT = "SELECT   count(*) as total FROM tbl_members    WHERE member_id ='$member_id' and block_sts ='N' ";
                $RS_SELECT = $this->db->query($QR_SELECT);
                $AR_SELECT = $RS_SELECT->row_array();		
                return $AR_SELECT['total'];   
        }
     function getreferrals($member_id)
       {
        $QR_SELECT = " SELECT subcription_id FROM `tbl_members` WHERE `sponsor_id`= '$member_id' AND subcription_id > '0' ORDER BY `tbl_members`.`subcription_id` ASC LIMIT 2";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		return $AR_SELECT;   
       } 
       
function getPoolMemberIdspilid1($member_id,$i)
{

// echo "$i";
//  echo "<br>";

if($i==1){
$from=0;  
$to =1 ; 
}elseif($i==2){
$from=1;  
$to =2 ;

}elseif($i==3){
$from=2;  
$to =3 ;
}elseif($i==4){
$from=3;  
$to =4 ;
}
elseif($i==5){
$from=4;  
$to =5 ;
}
elseif($i==6){
$from=5;  
$to =6 ;
}
elseif($i==7){
$from=6;  
$to =7 ;
}




//   echo $QR_BNRY = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id'  ORDER BY `tbl_level_members`.`id`  limit $i, 8 ";
//     $RS_BNRY = $this->db->query($QR_BNRY);
//     $AR_BNRY = $RS_BNRY->row_array();  

$QR_COL = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id' and amount = '10'  ORDER BY `tbl_level_members`.`id`  limit $from,$to ";
$AR_COL = $this->SqlModel->runQuery($QR_COL,true);
//PrintR($AR_COL);
return $AR_COL['id'];

// return $AR_BNRY['id']; 
}
function getPoolMemberIdspilid2($member_id,$i)
{

// echo "$i";
//  echo "<br>";

if($i==1){
$from=0;  
$to =1 ; 
}elseif($i==2){
$from=1;  
$to =2 ;

}elseif($i==3){
$from=2;  
$to =3 ;
}elseif($i==4){
$from=3;  
$to =4 ;
}
elseif($i==5){
$from=4;  
$to =5 ;
}
elseif($i==6){
$from=5;  
$to =6 ;
}
elseif($i==7){
$from=6;  
$to =7 ;
}




//   echo $QR_BNRY = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id'  ORDER BY `tbl_level_members`.`id`  limit $i, 8 ";
//     $RS_BNRY = $this->db->query($QR_BNRY);
//     $AR_BNRY = $RS_BNRY->row_array();  

$QR_COL = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id' and amount = '20'  ORDER BY `tbl_level_members`.`id`  limit $from,$to ";
$AR_COL = $this->SqlModel->runQuery($QR_COL,true);
//PrintR($AR_COL);
return $AR_COL['id'];

// return $AR_BNRY['id']; 
}
function getPoolMemberIdspilid3($member_id,$i)
{

// echo "$i";
//  echo "<br>";

if($i==1){
$from=0;  
$to =1 ; 
}elseif($i==2){
$from=1;  
$to =2 ;

}elseif($i==3){
$from=2;  
$to =3 ;
}elseif($i==4){
$from=3;  
$to =4 ;
}
elseif($i==5){
$from=4;  
$to =5 ;
}
elseif($i==6){
$from=5;  
$to =6 ;
}
elseif($i==7){
$from=6;  
$to =7 ;
}




//   echo $QR_BNRY = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id'  ORDER BY `tbl_level_members`.`id`  limit $i, 8 ";
//     $RS_BNRY = $this->db->query($QR_BNRY);
//     $AR_BNRY = $RS_BNRY->row_array();  

$QR_COL = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id' and amount = '30'  ORDER BY `tbl_level_members`.`id`  limit $from,$to ";
$AR_COL = $this->SqlModel->runQuery($QR_COL,true);
//PrintR($AR_COL);
return $AR_COL['id'];

// return $AR_BNRY['id']; 
}
function getPoolMemberIdspilid4($member_id,$i)
{

// echo "$i";
//  echo "<br>";

if($i==1){
$from=0;  
$to =1 ; 
}elseif($i==2){
$from=1;  
$to =2 ;

}elseif($i==3){
$from=2;  
$to =3 ;
}elseif($i==4){
$from=3;  
$to =4 ;
}
elseif($i==5){
$from=4;  
$to =5 ;
}
elseif($i==6){
$from=5;  
$to =6 ;
}
elseif($i==7){
$from=6;  
$to =7 ;
}




//   echo $QR_BNRY = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id'  ORDER BY `tbl_level_members`.`id`  limit $i, 8 ";
//     $RS_BNRY = $this->db->query($QR_BNRY);
//     $AR_BNRY = $RS_BNRY->row_array();  

$QR_COL = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id' and amount = '40'  ORDER BY `tbl_level_members`.`id`  limit $from,$to ";
$AR_COL = $this->SqlModel->runQuery($QR_COL,true);
//PrintR($AR_COL);
return $AR_COL['id'];

// return $AR_BNRY['id']; 
}
function getPoolMemberIdspilid5($member_id,$i)
{

// echo "$i";
//  echo "<br>";

if($i==1){
$from=0;  
$to =1 ; 
}elseif($i==2){
$from=1;  
$to =2 ;

}elseif($i==3){
$from=2;  
$to =3 ;
}elseif($i==4){
$from=3;  
$to =4 ;
}
elseif($i==5){
$from=4;  
$to =5 ;
}
elseif($i==6){
$from=5;  
$to =6 ;
}
elseif($i==7){
$from=6;  
$to =7 ;
}




//   echo $QR_BNRY = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id'  ORDER BY `tbl_level_members`.`id`  limit $i, 8 ";
//     $RS_BNRY = $this->db->query($QR_BNRY);
//     $AR_BNRY = $RS_BNRY->row_array();  

$QR_COL = "SELECT id   FROM `tbl_level_members` WHERE `member_id`  ='$member_id' and amount = '50'  ORDER BY `tbl_level_members`.`id`  limit $from,$to ";
$AR_COL = $this->SqlModel->runQuery($QR_COL,true);
//PrintR($AR_COL);
return $AR_COL['id'];

// return $AR_BNRY['id']; 
}
   
   function getPoolMemberId($member_id)
   {
            $QR_BNRY = "SELECT member_id   FROM `tbl_level_members` WHERE `id`  ='$member_id' ";
            $RS_BNRY = $this->db->query($QR_BNRY);
            $AR_BNRY = $RS_BNRY->row_array();  
            
            return $AR_BNRY['member_id']; 
   }
   function countParentPoolSpill($id)
   {
       
             $QR_BNRY = "SELECT id FROM `tbl_level_members` WHERE `spill_id` =  '$id'";
            $RS_BNRY = $this->db->query($QR_BNRY);
            $AR_BNRY = $RS_BNRY->result_array();    
            foreach($AR_BNRY as $val)
            {
            $member_array[] = $val['id'];$i++;
            }
            
            $dd = implode(',',$member_array);
            
              $QR_BNRY = "SELECT count(*) as total   FROM `tbl_level_members` WHERE `spill_id` IN ($dd)";
            $RS_BNRY = $this->db->query($QR_BNRY);
            $AR_BNRY = $RS_BNRY->row_array();  
            
            return $AR_BNRY['total']; 
   }
   
   function getParentPoolTotalId($id)
   {
       
              $QR_BNRY = "SELECT t_count  as total FROM `tbl_level_members` as a1   WHERE a1.`id` =  '$id'";
            $RS_BNRY = $this->db->query($QR_BNRY);
            $AR_BNRY = $RS_BNRY->row_array();    
            return $AR_BNRY['total']; 
   }
   
   
   function getParentPoolSpill($id)
   {
       
              $QR_BNRY = "SELECT a1.spill_id  as spillId FROM `tbl_level_members` as a1   WHERE a1.`id` =  '$id'";
            $RS_BNRY = $this->db->query($QR_BNRY);
            $AR_BNRY = $RS_BNRY->row_array();    
            return $AR_BNRY['spillId']; 
   }
   function getLevelSpillId($id)
   {
            $QR_BNRY = "SELECT  level  FROM `tbl_level_members` where  id = '$id'   LIMIT 1";
            $RS_BNRY = $this->db->query($QR_BNRY);
            $AR_BNRY = $RS_BNRY->row_array();    
             return $AR_BNRY['level'] + 1; 
   }
   function getLastPoolSpillId()
	{
	    
            $QR_BNRY = "SELECT `id`,`spill_id`,`position` FROM `tbl_level_members` ORDER BY `tbl_level_members`.`id` DESC LIMIT 1";
            $RS_BNRY = $this->db->query($QR_BNRY);
            $AR_BNRY = $RS_BNRY->row_array(); 
            if($AR_BNRY['spill_id'] <= '0')
            {
                $return['position'] = 'L';
                $return['spill_id'] =  1;
            }
            else
            {
               
                    if($AR_BNRY['position']  == 'L')
                    {
                        $return['position'] = 'R';
                        $return['spill_id'] = $AR_BNRY['spill_id'];
                    }
                    else
                    {
                        $return['position'] = 'L';
                        $return['spill_id'] = $AR_BNRY['spill_id']+1;   
                    }
            }
            return $return; 
	} 
    
    
    	function getSpillcounts($spil_id)
	{
	    
            $QR_BNRY = "	SELECT count(*) as total  FROM `tbl_members` WHERE  `spil_id` ='$spil_id'";
            $RS_BNRY = $this->db->query($QR_BNRY);
            $AR_BNRY = $RS_BNRY->row_array();
            return $AR_BNRY['total']; 
	}
    
    	function checkMemberIdexists($user_id){
		$QR_SELECT = "SELECT m.first_name,p.prod_pv,s.date_from FROM ".prefix."tbl_members  as m left join tbl_subscription as s on s.member_id = m.member_id left join tbl_pintype as p on p.type_id = s.active_type_id WHERE  m.user_id = '".$user_id."' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT;
	}
	
    function getTotalResidualIncomes($member_id)
    {
            $QR_SELECT = "SELECT SUM(`net_income`) as total FROM `tbl_cmsn_daily` WHERE `member_id` =  '$member_id' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
    }
    
    
         function gettotIncs($member_id )
    {
            $QR_SELECT = "SELECT SUM(`total_income`)  as total FROM `tbl_cmsn_mstr` WHERE   member_id  = '$member_id'    ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
    }
    
     function gettotInc($member_id )
    {
            $QR_SELECT = "SELECT SUM(`net_income`)  as total FROM `tbl_cmsn_mstr` WHERE   member_id  = '$member_id'    ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
    }
    function getBulkByCount($member_id )
    {
            $QR_SELECT = "SELECT  count(*) as total  FROM `tbl_subscription` WHERE  member_id  = '$member_id'  AND  `bulk_by` ='0'  ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
    }
    
    
    
      function memberParentList($member_id)
        {
        $QR_SELECT = "SELECT member_id ,spil_id,left_right,break_sts FROM (SELECT member_id ,spil_id,left_right,break_sts, CASE WHEN member_id = '$member_id' THEN @id := spil_id WHEN member_id = @id THEN @id := spil_id END as checkId FROM tbl_members ORDER BY member_id DESC) as T WHERE checkId IS NOT NULL";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->result_array();
        return $AR_SELECT;   
        }
    		public function superreferal($member_id)
	{
	    	$QR_SELECT = "SELECT tm.member_id,tm.user_id FROM ".prefix."tbl_members AS tm	
		    WHERE tm.member_id in (select member_id from tbl_subscription where  `bulk_by` ='$member_id' ) ";
		 	$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		return $AR_SELECT ;
	}
    	function getAccountdetailByOrderID($order_id)
	{
	    
	    $QR_SELECT = "SELECT * FROM `tbl_money_transfer` WHERE `orderid` = '$order_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
        function getprodpack($member_id)
    {
            $QR_GET = "SELECT p.pin_letter as val FROM `tbl_subscription` as s LEFT JOIN tbl_pintype as p on s.type_id= p.type_id WHERE s.member_id = '$member_id' "; 
            $RS_GET = $this->db->query($QR_GET);
            $AR_GET = $RS_GET->row_array();
            return $AR_GET['val'];
    }
    function getSetofPackage($member_id)
    {
            $QR_SELECT = "SELECT COUNT(*) as total ,`active_type_id` as typeId FROM `tbl_subscription` WHERE `bulk_by` ='$member_id'";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            if($AR_SELECT['total'] > 0 and $AR_SELECT['typeId'] > 0 )
            {
                $typeId = $AR_SELECT['typeId'];
                $QR_SELECT = "SELECT `mrp` FROM `tbl_pintype` WHERE `type_id` ='$typeId'";
                $RS_SELECT = $this->db->query($QR_SELECT);
                $AR_SELECT = $RS_SELECT->row_array();
                $AR_DT['price'] = $AR_SELECT['mrp'];
                $AR_DT['status'] = '1';
            }
            else
            {
                $AR_DT['status'] = '2';
                
            }
            
            return $AR_DT; 
    }


 function getactivationSts($member_id)
    {
           $QR_SELECT = "SELECT  activation_sts  as sts  from tbl_members  where  member_id ='$member_id' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['sts']; 
    }
    function getTotalRankAchievers($rank_id)
    {
           $QR_SELECT = "SELECT count(*) as total  from tbl_members  where  rank_id ='$rank_id' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
    }
   function getMemberIdKYC($kyc_id)
    {
        $QR_SELECT = "SELECT  member_id   FROM tbl_mem_kyc        where   kyc_id  =  '$kyc_id'   ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT['member_id'];   
    }  
     function getKycdetails($member_id)
    {
        $QR_SELECT = "SELECT m.member_id,m.user_id,m.first_name,m.midle_name,m.last_name,k1.approved_sts as pan,k2.approved_sts as AF,k3.approved_sts as AB,k4.approved_sts as C FROM tbl_members as m LEFT JOIN `tbl_mem_kyc` as k1 on m.member_id = k1.member_id and k1.file_type ='PAN CARD' and k1.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='PAN CARD') LEFT JOIN `tbl_mem_kyc` as k2 on m.member_id = k2.member_id and k2.file_type ='ADHAR CARD FRONT' and k2.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='ADHAR CARD FRONT') LEFT JOIN `tbl_mem_kyc` as k3 on m.member_id = k3.member_id and k3.file_type ='ADHAR CARD BACK' and k3.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='ADHAR CARD BACK' ) LEFT JOIN `tbl_mem_kyc` as k4 on m.member_id = k4.member_id and k4.file_type ='CHEQUE' and k4.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='CHEQUE')  where  m.member_id  =  '$member_id'  GROUP by m.member_id";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT;   
    } 
    
   function updatekyc($member_id)
    {
           
                $AR_MEM = $this->getKycdetails($member_id);  
                $member_id = $AR_MEM['member_id'];
                $user_id = strtoupper($AR_MEM['user_id']);
                $name = strtoupper($AR_MEM['first_name'].' '.$AR_MEM['midle_name'].' '.$AR_MEM['last_name']);
             $pan_card =    ($AR_MEM['pan'] !='')? $AR_MEM['pan']:'2'; 
             $adhaar_front =    ($AR_MEM['AF'] !='')? $AR_MEM['AF']:'2'; 
             $adhaar_back =    ($AR_MEM['AB'] !='')? $AR_MEM['AB']:'2'; 
             $cheque =    ($AR_MEM['C'] !='')? $AR_MEM['C']:'2'; 
               $international =    ($AR_MEM['I'] !='')? $AR_MEM['I']:'2'; 
 	 
            if($this->checkCount(prefix."tbl_kyc_status","member_id",$member_id)>0){
                $updated_data = array(
                               
                                "user_id"  => $user_id , 
                                "name"  => $name , 
                                "pan_card"  => $pan_card , 
                                "adhaar_front"  =>  $adhaar_front, 
                                "adhaar_back"  => $adhaar_back , 
                                "cheque"  => $cheque , 
                                 "internationid"  => $international ,
                    
                    );
                $this->SqlModel->updateRecord(prefix."tbl_kyc_status",$updated_data,array("member_id"=>$member_id));
            }
            else
            {
                  $updated_data = array(
                                "member_id"  =>  $member_id, 
                                "user_id"  => $user_id , 
                                "name"  => $name , 
                                "pan_card"  => $pan_card , 
                                "adhaar_front"  =>  $adhaar_front, 
                                "adhaar_back"  => $adhaar_back , 
                                "cheque"  => $cheque , 
                                 "internationid"  => $international ,
                    
                    );
                  $this->SqlModel->insertRecord(prefix."tbl_kyc_status",$updated_data);    
            }
    }
    	function getcryptoValue($fldvFiled){
		$QR_CONFIG="SELECT value FROM ".prefix."tbl_cryto_config  WHERE name='$fldvFiled'  LIMIT 1";
		$RS_CONFIG = $this->db->query($QR_CONFIG);
		$AR_CONFIG = $RS_CONFIG->row_array();
		if(is_numeric($AR_CONFIG['value'])){
			$returnVar = ($AR_CONFIG['value']==NULL)? "0":$AR_CONFIG['value'];	
		}else{
			$returnVar = ($AR_CONFIG['value']==NULL)? "":$AR_CONFIG['value'];
		}
		return $returnVar;
	}
		function setcryptoConfig($fldvFields,$fldvValue){
		$date_upd = $date_upd = getLocalTime();
		if($this->checkCount(prefix."tbl_cryto_config","name",$fldvFields)>0){
			$this->db->query("UPDATE ".prefix."tbl_cryto_config SET value='$fldvValue', date_upd='$date_upd' WHERE name='$fldvFields'");
		}else{
			$this->db->query("INSERT INTO  ".prefix."tbl_cryto_config SET value='$fldvValue' , name='$fldvFields', date_add='$date_add', 
			date_upd='$date_upd'");
		}
	}
    public function setWallet($initial_amount,$trns_type) {
	
	 if($trns_type == 'Cr')
      {
          $sql = " UPDATE tbl_configuration SET value = value + $initial_amount  WHERE name ='VIRTUAL_WALLET'"; 
      }
      else
      {
         $sql = " UPDATE tbl_configuration SET value = value - $initial_amount  WHERE name ='VIRTUAL_WALLET'";  
      }
        $RS_SELECT = $this->db->query($sql);
     	return true;
	}
	
	public function setWalletTRX($initial_amount,$trns_type) {
	
	 if($trns_type == 'Cr')
      {
          $sql = " UPDATE tbl_configuration SET value = value + $initial_amount  WHERE name ='VIRTUAL_WALLET_CRYPTO'"; 
      }
      else
      {
         $sql = " UPDATE tbl_configuration SET value = value - $initial_amount  WHERE name ='VIRTUAL_WALLET_CRYPTO'";  
      }
        $RS_SELECT = $this->db->query($sql);
     	return true;
	}
        function getSenderDetail($sender_id )
    {
     $QR_SELECT = "SELECT *  FROM `tbl_money_transfer` WHERE sender_id ='$sender_id' and sub_req ='N'  ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT;   
    } 
    function getTotdayTransfers($member_id,$date)
    {
     $QR_SELECT = "SELECT COUNT(*) as total  FROM `tbl_money_transfer` WHERE member_id ='$member_id' AND date(`date`) = date('$date')  ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT['total'];   
    } 
function dmtsuccess()
{
 
            $QR_SELECT = "SELECT sum(`amount`) as amount,sum(`charge`) as charge,sum(`total`) as total  FROM `tbl_money_transfer` WHERE  `status` ='Success';  ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT; 
 }
 
function dmtFailed()
{
 
            $QR_SELECT = "SELECT sum(`amount`) as total  FROM `tbl_money_transfer` WHERE  `status` ='Failure' and `isDisplay` ='Y'; ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
 }
function dmtPending()
{
 
            $QR_SELECT = "SELECT sum(`total`) as total  FROM `tbl_money_transfer` WHERE  `sub_req` ='N' and `isDisplay` ='Y'; ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
 } 
 
 function getRechargedata($status)
{
            if($status =='SUCCESS')
            {
             $QR_SELECT = "SELECT SUM(`amount`) as total FROM `tbl_recharge` WHERE  `status`='SUCCESS'; ";   
            }
            else
            {
             $QR_SELECT = "SELECT SUM(`amount`) as total FROM `tbl_recharge` WHERE  `status`='FAILED'; ";       
            }
            
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
 } 
 
  function getCreditAmount()
{
            
            $QR_SELECT = "SELECT SUM(`trns_amount`) as amount FROM `tbl_wallet_trns` WHERE `trns_type` ='Cr' AND `trns_for` ='MASTER' and wallet_id='20'; ";   
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['amount']; 
 } 

 
  function getCreditCryptoAmount()
{
            
            $QR_SELECT = "SELECT SUM(`trns_amount`) as amount FROM `tbl_wallet_trns` WHERE `trns_type` ='Cr' AND `trns_for` ='MASTER' and wallet_id='50'; ";   
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['amount']; 
 } 
 
 function getcryptoPending()
{
            
            $QR_SELECT = "SELECT SUM(`initial_amount`) as total FROM `tbl_fund_transfer` WHERE `trns_for` ='WITHDRAW' AND `draw_type` ='MANUAL' AND `trns_status` = 'P'; ";   
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['total']; 
 } 
function checkTransactionLogin($t_id,$t_pass,$t_key,$t_ans  )
{
    
$t_id = _e($t_id);
$t_pass = _e($t_pass);
$t_key = _e($t_key);
$t_ans = _e($t_ans);
            $QR_SELECT = "SELECT count(*) as total  FROM `tbl_operator` where t_id = '$t_id'  and t_pass = '$t_pass'  and t_key = '$t_key'  and t_ans = '$t_ans'    ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            if($AR_SELECT['total'] > 0 )
            {
                 $this->session->set_userdata($t_id);
                 $this->session->set_userdata($t_pass);
             return true;   
            }
            else
            {
               return false; 
            }
            
}



    function getDmtcountsbymobAc($account_number,$member_mobile,$date)
    {
        $QR_SELECT = "SELECT COUNT(*) as total  FROM `tbl_money_transfer` WHERE   date(`date`) = date('$date') AND status !='Failure' AND   (account_number ='$account_number' or mobile ='$member_mobile' ) ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT['total'];   
    } 
    
    
     function smswallet_transaction($wallet_id,$trns_type,$member_id,$trns_amount,$trns_remark,$trns_date,$trans_ref_no='',$isactive='',$user_id){
	
	$date = date('Y-m-d');
		$data = array("wallet_id"=>($wallet_id>0)? $wallet_id:0,
			"trns_type"=>$trns_type,
			"member_id"=>($member_id>0)? $member_id:0,
			"trns_amount"=>$trns_amount,
			"trns_remark"=>($trns_remark)? $trns_remark:' ',
			"isActive"=>($isactive==0)? 0:1,
			"trans_ref_no"=>($trans_ref_no)? $trans_ref_no:0,
			"user_id"=>$user_id,
			"trns_for"=>($trns_for)? $trns_for:"NA",
			"trns_date"=>$date
		);
  
		if($trns_amount>0 && $member_id>0){
			$this->SqlModel->insertRecord(prefix."tbl_sms_trns",$data);
		}
	}  
     public function sendDynamicSMS($mobile,$message)
    {
    
      $sms = $this->getValue("SMS_API");
    if($sms =='Quick Smart'){     
$domain="quicksmart.in";
$method="POST";
$message=urlencode($message);
 
$parameters="user=500795&authkey=92lsCaKOUXc&sender=IROMPL&mobile=$mobile&text=$message&rpt=1";

	$url="http://$domain/api/pushsms?";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
    }
    elseif($sms =='Fast SMS'){    
    
    /************************************************New OTP SMS ********/
    
 
 

 
$username="vertoindia";
$api_password="123456";
$sender="WEBSMS";
$domain="fastsms.vertoindia.com";
$method="POST";
 

	$username=urlencode($username);
	$password=urlencode($api_password);
	$sender=urlencode($sender);
	$message=urlencode($message);
 
$parameters="username=$username&password=$password&senderid=$sender&route=2&number=$mobile&message=$message";

	$url="http://$domain/http-api.php?";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);
}
    elseif($sms =='JET SMS'){    
    
    /************************************************New OTP SMS ********/
    
//  1201159135788241662
 //https://app.jetmsg.in/api/v1/otp/?AuthKey=1b6303-7aa01e-039d1a-41a74b-08f4e9&SenderId=YOFLIC&Mobile=7070300613&len=10&otp=012100&message=Your OTP is @OTP@, dont share with anyone.&etime=300&tempid=DLT approved template id
     $message=urlencode($message);
    $member_mobile=$mobile ;
    
 
       
    $parameters="AuthKey=ee3d77-afc3b3-0b2dc4-e1a463-a8470f&SenderId=ATOKEN&MobileNo=$member_mobile&Message=$message&route=1&type=text&tempid=1207162090106270239"; 
    	$url="https://app.jetmsg.in/api/v1/sendsms.php/";
   // $parameters="AuthKey=ee3d77-afc3b3-0b2dc4-e1a463-a8470f&SenderId=ATOKEN&Mobile=$member_mobile&len=10&otp=012100&message=$message&etime=300&tempid=1207162090106270239"; 
	//$url="https://app.jetmsg.in/api/v1/otp/";
//	echo $url.$parameters;
 
    $ch = curl_init($url);
    $ch = curl_init($url);
    $method ='POST';
	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;
		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);  
}
   ob_flush();
    flush();
    sleep(1);
}

 function getSubcriptionsdatanew($member_id)
{
    
            $QR_SELECT = "SELECT * FROM `tbl_subscription` where member_id ='$member_id' and type='A'";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT;
}

 function getSubcriptionsdata($member_id)
{
    
            $QR_SELECT = "SELECT * FROM `tbl_subscription` where member_id ='$member_id' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT;
}
    
         function getCircleCode()
{
    
    	$QR_SELECT = "SELECT * FROM `tbl_recharge_circle` ORDER BY `tbl_recharge_circle`.`circle_name` ASC";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->result_array();
				return $AR_SELECT;
}      function getOperatorCode($type)
	{  

	$QR_SELECT = "SELECT  * FROM `tbl_recharge_optr` WHERE  service_type= '$type'";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->result_array();
				return $AR_SELECT;
	}
        function getRechargeStatus($status)
	{
	$Q_CTRL = "SELECT SUM(`amount`) as total   FROM `tbl_recharge` WHERE   `status` ='$status';";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['total'];   
	}
    function getRechargeStatusNull()
	{
	$Q_CTRL = "SELECT SUM(`amount`) as total   FROM `tbl_recharge` WHERE  `status` IS NULL;";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['total'];   
	}
     function getDMTStatus($status)
	{
	$Q_CTRL = "SELECT SUM(`total`) as total   FROM `tbl_money_transfer` WHERE   `status` ='$status';";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['total'];   
	}
	   function getDMTStatuscharge($status)
	{
	$Q_CTRL = "SELECT SUM(`charge`) as charge   FROM `tbl_money_transfer` WHERE   `status` ='$status';";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['charge'];   
	}     
    function getmembersdetails($member_id)
       {      
        
            $QR_SELECT = " SELECT title,member_mobile,state_name,user_id ,concat(first_name,' ' , midle_name,' ', last_name) as name ,city_name,bank_name,ifc_code,pan_no    FROM `tbl_members` WHERE  member_id ='$member_id' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();		
            return $AR_SELECT; 
       }  
      function getmembersDetailss($member_id)
       {      
        
            $QR_SELECT = "SELECT m.user_id,m.first_name,m.date_join ,m.member_mobile , m.bank_acct_holder , m.account_number ,m.ifc_code ,m.pan_no , m.adhar ,s.package_price ,s.date_from,sm.user_id as sid ,sm.first_name as sname FROM tbl_members as m LEFT JOIN tbl_subscription as s on m.member_id = s.member_id LEFT JOIN tbl_members as sm on sm.member_id = m.sponsor_id WHERE m.member_id ='$member_id' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();		
            return $AR_SELECT; 
       }  
       
             function BankDetails($member_id)
       {      
        
            $QR_SELECT = "SELECT  bank_name, bank_acct_holder, account_number, ifc_code, branch, pan_no, adhar  FROM tbl_members      WHERE  member_id ='$member_id' ";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();		
            return $AR_SELECT; 
       }  
       
       
       
    public function getSpillLevel($table)
    {
        
    $QR_SELECT = "SELECT `spill_id` FROM $table WHERE 1 ORDER BY `id` DESC LIMIT 1";
    $RS_SELECT = $this->db->query($QR_SELECT);
    $AR_SELECT = $RS_SELECT->row_array();
    $spill = ($AR_SELECT['spill_id'] > 0 )?$AR_SELECT['spill_id']:1;
    return $spill;
    }
    public function getIDbyMemberLevel($table,$member_id)
    {
        
    $QR_SELECT = "SELECT `id` FROM $table WHERE member_id ='$member_id' ";
    $RS_SELECT = $this->db->query($QR_SELECT);
    $AR_SELECT = $RS_SELECT->row_array();
   
    return $AR_SELECT['id'];
    }
    public function getLevelIncomeCount($member_id,$level,$type)
    {
    $QR_SELECT = "SELECT count(*) AS ctrl_count FROM ".prefix."tbl_cmsn_level  WHERE member_id='$member_id' and level='$level'  and   type='$type'";
    $RS_SELECT = $this->db->query($QR_SELECT);
    $AR_SELECT = $RS_SELECT->row_array();
    return $AR_SELECT['ctrl_count'];
    }
    public function gettotalLevMatrix($member_id,$count=1)
	{
	    
	    $member_array =array();
	      $QR_SELECT = 'SELECT  m.member_id  FROM `tbl_level_members`  as m      WHERE m.`spill_id` IN (' . implode(',', array_map('intval', $member_id)) . ')    ';
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		foreach($AR_SELECT as $val)
		{
		$member_array[] = $val['member_id'];$i++;
		}
		$count++;
		$data['total'] = count($AR_SELECT);
		$data['level'] = $count;
		$data['data_list'] = $member_array;
	//	$data['data'] = $AR_SELECT;
		 
	
	    return $data;
	
		
	 	 
	}
	
    		
	public function gettotalLevMatrix2($member_id,$count=1)
	{
	    
	    $member_array =array();
	      $QR_SELECT = 'SELECT  m.member_id  FROM `tbl_level_members2`  as m      WHERE m.`spill_id` IN (' . implode(',', array_map('intval', $member_id)) . ')    ';
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		foreach($AR_SELECT as $val)
		{
		$member_array[] = $val['member_id'];$i++;
		}
		$count++;
		$data['total'] = count($AR_SELECT);
		$data['level'] = $count;
		$data['data_list'] = $member_array;
	//	$data['data'] = $AR_SELECT;
		 
	
	    return $data;
	
		
	 	 
	}
	
	public function gettotalLevMatrix3($member_id,$count=1)
	{
	    
	    $member_array =array();
	      $QR_SELECT = 'SELECT  m.member_id  FROM `tbl_level_members3`  as m      WHERE m.`spill_id` IN (' . implode(',', array_map('intval', $member_id)) . ')    ';
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		foreach($AR_SELECT as $val)
		{
		$member_array[] = $val['member_id'];$i++;
		}
		$count++;
		$data['total'] = count($AR_SELECT);
		$data['level'] = $count;
		$data['data_list'] = $member_array;
	//	$data['data'] = $AR_SELECT;
		 
	
	    return $data;
	
		
	 	 
	}
	public function gettotalLevMatrix4($member_id,$count=1)
	{
	    
	    $member_array =array();
	      $QR_SELECT = 'SELECT  m.member_id  FROM `tbl_level_members4`  as m      WHERE m.`spill_id` IN (' . implode(',', array_map('intval', $member_id)) . ')    ';
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		foreach($AR_SELECT as $val)
		{
		$member_array[] = $val['member_id'];$i++;
		}
		$count++;
		$data['total'] = count($AR_SELECT);
		$data['level'] = $count;
		$data['data_list'] = $member_array;
	//	$data['data'] = $AR_SELECT;
		 
	
	    return $data;
	
		
	 	 
	}	
    	function Totalpayoutdetail()
	{
	$QR_SELECT = "SELECT SUM(`total_income`) as payout FROM `tbl_cmsn_mstr` WHERE 1  ";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT['payout'];
				}
		
		
       	function Totalpayoutdetail1($fdate,$edate)
	    {
                $QR_SELECT = "SELECT SUM(`total_income`) as payout FROM `tbl_cmsn_mstr` WHERE pay_sts_date  between '$fdate' AND '$edate' ";
                $RS_SELECT = $this->db->query($QR_SELECT);
                $AR_SELECT = $RS_SELECT->row_array();
                return $AR_SELECT['payout'];
	    }
			
    
    
     function getBankDetailMember($member_id)
	{
	$Q_CTRL = "SELECT user_id,account_number, ifc_code , bank_acct_holder,member_mobile,first_name FROM tbl_members where member_id ='$member_id'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL;   
	}
    function getdirectTotal($sponsor_id)
    {
        
        $QR_SELECT = "SELECT COUNT(tm.sponsor_id) AS total FROM tbl_members  as tm   LEFT JOIN tbl_subscription AS ts  ON tm.sponsor_id=ts.member_id WHERE tm.sponsor_id ='$sponsor_id';";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['total'];
        
    }
        function getTotalMembers($end_date)
    {
        
        $QR_SELECT = " Select count(*) as total from tbl_subscription where Date(date_from)  <='". ($end_date)."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['total'];
        
    }
    
            function getdateFromActive($member_id)
    {
        
        $QR_SELECT = " Select date_from  from tbl_subscription where  member_id ='$member_id'  order by subcription_id asc limit 1 ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['date_from'];
        
    }
    
    
	        function getCountPoolMember($member_id,$type)
    {
        
        $QR_SELECT = " Select count(*) as total from tbl_set_pool where member_id ='".$member_id."' and type='".$type."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['total'];
        
    }
	
	
    
    function countunusedPin($member_id,$type_id)
	{
	
 	$QR_SELECT= "SELECT count(tpd.pin_id) as total 
			FROM ".prefix."tbl_pinsdetails AS tpd 
			LEFT JOIN ".prefix."tbl_pinsmaster AS tpm ON tpd.mstr_id=tpm.mstr_id
			LEFT JOIN ".prefix."tbl_members AS tm ON tpd.member_id=tm.member_id
			LEFT JOIN ".prefix."tbl_pintype AS tpy ON tpd.type_id=tpy.type_id WHERE tpd.pin_sts='N' 
			AND tpd.member_id>0 AND tpd.member_id='".$member_id."' AND  tpd.type_id='".$type_id."' ";
			
			
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				
					return $AR_SELECT['total'];
	
	}
    	function getMemberCollection1($member_id,$left_right,$start_date,$end_date){
			if($start_date!='' && $end_date!=''){
				$StrWhr .= " AND DATE(ts.date_from) BETWEEN '".$start_date."' AND '".$end_date."'";
			}elseif($end_date!=''){
				$StrWhr .= " AND DATE(ts.date_from) <= '".$end_date."'";
			}
			   
			if($left_right!=""){
				$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='".$left_right."';";
			}else{
				$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE member_id='".$member_id."';";
			}
			$AR_COL = $this->SqlModel->runQuery($QR_COL,true);
			$nleft = $AR_COL["nleft"];
			$nright = $AR_COL["nright"];
			
		  	$Q_CTRL = "SELECT SUM(ts.prod_pv) AS net_amount 
					  FROM ".prefix."tbl_subscription AS ts
					  LEFT JOIN ".prefix."tbl_members AS tm ON  tm.member_id=ts.member_id
					  LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tree.member_id=tm.member_id
					 WHERE  tree.nleft BETWEEN '".$nleft."'  AND '".$nright."' AND tm.member_id!='".$member_id."' 
					 $StrWhr AND tm.delete_sts>0";  
			$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
			return $A_CTRL['net_amount'];
			
	}
	
	   function getMemberCollection2($member_id,$left_right,$start_date,$end_date){
			if($start_date!='' && $end_date!=''){
				$StrWhr .= " AND DATE(ts.date_from) BETWEEN '".$start_date."' AND '".$end_date."'";
			}elseif($end_date!=''){
				$StrWhr .= " AND DATE(ts.date_from) <= '".$end_date."'";
			}
			   
			if($left_right!=""){
				$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='".$left_right."';";
			}else{
				$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE member_id='".$member_id."';";
			}
			$AR_COL = $this->SqlModel->runQuery($QR_COL,true);
			$nleft = $AR_COL["nleft"];
			$nright = $AR_COL["nright"];
			
		  	$Q_CTRL = "SELECT SUM(ts.prod_pv) AS net_amount 
					  FROM ".prefix."tbl_subscription AS ts
					  LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tree.member_id=ts.member_id
					 WHERE  tree.nleft BETWEEN '".$nleft."'  AND '".$nright."' AND tree.member_id!='".$member_id."' 
					 $StrWhr  ";  
			$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
			return $A_CTRL['net_amount'];
			
	}
	  	function getmemberContact($member_id)
	{
		$QR_SELECT = "SELECT first_name,user_id , member_mobile,user_password,member_email  FROM ".prefix."tbl_members  WHERE member_id='$member_id'  ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	 
 
	}
	
    	function cashbackIncomes($member_id)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_cashback WHERE member_id='$member_id'  ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
    	
			function cashbackIncome($member_id)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_daily WHERE member_id='$member_id'  ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
		function rewardIncome($member_id)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_reward WHERE member_id='$member_id'  ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
    	function gettotalmatchingReward($memberId,$process_id)
	{
	$Q_CTRL = "SELECT COALESCE(SUM(`pair_match`),0) as total  FROM `tbl_cmsn_binary` WHERE member_id='$memberId' and process_id <='$process_id'  GROUP BY member_id";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['total'];
	}
	
	function getRewards($member_id,$process_id)
	{
	    
    $Q_CTRL = "SELECT sum(net_income) as net_income  FROM `tbl_cmsn_reward` WHERE member_id='$member_id' and process_id='$process_id'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	 
	return $A_CTRL['net_income'];  
	}
		function getRewards_2($member_id,$process_id)
	{
	    
    $Q_CTRL = "SELECT sum(net_income) as net_income  FROM `tbl_cmsn_reward_2` WHERE member_id='$member_id' and process_id='$process_id'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	 
	return $A_CTRL['net_income'];  
	}
		function checkrewardmembernew($rewardId,$memberId)
	{
 
 	$Q_CTRL = "SELECT COALESCE(COUNT(*),0) as total  FROM `tbl_cmsn_reward` WHERE member_id='$memberId' and reward_id='$rewardId'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	 
	return $A_CTRL['total'];  
	}
     function getorderDetail($sale_id){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_sale WHERE  sale_id = '".$sale_id."' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT;
	}
	function getorderProductDetail($sale_id)
	{
	    $QR_SELECT = "SELECT * FROM ".prefix."tbl_sale_product WHERE  sale_id = '".$sale_id."' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();		
		return $AR_SELECT;
	}
		function getdownlinelisting($member_id)
	{
	    
	    $QR_GET ="SELECT first_name, user_id ,member_id
		 
		 FROM ".prefix."tbl_members 
		 WHERE sponsor_id='".$member_id."'
		 AND delete_sts>0 
		 
		 GROUP BY member_id
		 ORDER BY date_join DESC";
		 	$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->result_array();
	
		return $AR_GET;
	}
	  public function gettotalLev123($member_id,$count=1)
	{
	    
	    $member_array =[];
	    $QR_SELECT = 'SELECT  m.member_id,m.user_id,m.first_name,m.sponsor_id,m.date_join ,SUM(s.prod_pv) as prod_pv,s.date_from  FROM `tbl_members`  as m  left join tbl_subscription as s on s.member_id=m.member_id  WHERE m.`sponsor_id` IN (' . implode(',', array_map('intval', $member_id)) . ')   group by member_id   ';
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		foreach($AR_SELECT as $val)
		{
		$member_array[] = $val['member_id'];$i++;
		}
		$count++;
		$data['total'] = count($AR_SELECT);
		$data['level'] = $count;
		$data['data_list'] = $member_array;
		$data['data'] = $AR_SELECT;
		 
	
	    return $data;
	
		
	 	 
	}
     public function gettotalLev($member_id,$count=1)
	{
	    
	    $member_array = [];
	    $QR_SELECT = 'SELECT  m.member_id,m.user_id,m.first_name,m.sponsor_id,m.date_join ,s.subcription_id, s.prod_pv ,s.date_from  FROM `tbl_members`  as m  left join tbl_subscription as s on s.member_id=m.member_id  WHERE m.`sponsor_id` IN (' . implode(',', array_map('intval', $member_id)) . ')    ';
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		foreach($AR_SELECT as $val)
		{
		$member_array[] = $val['member_id'];$i++;
		}
		$count++;
		$data['total'] = count($AR_SELECT);
		$data['level'] = $count;
		$data['data_list'] = $member_array;
		$data['data'] = $AR_SELECT;
		 
	
	    return $data;
	
		
	 	 
	}
   public function gettotalLevtoday($member_id,$count=1,$today_datee)
	{
	    
	    $member_array = [];
	    $QR_SELECT = 'SELECT  m.member_id,m.user_id,m.first_name,m.sponsor_id,m.date_join ,s.subcription_id, s.prod_pv ,s.date_from  FROM `tbl_members`  as m  left join tbl_subscription as s on s.member_id=m.member_id  WHERE m.`sponsor_id` IN (' . implode(',', array_map('intval', $member_id)) . ')    ';
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		foreach($AR_SELECT as $val)
		{
		$member_array[] = $val['member_id'];$i++;
		}
		$count++;
		$data['total'] = count($AR_SELECT);
		$data['level'] = $count;
		$data['data_list'] = $member_array;
		$data['data'] = $AR_SELECT;
		 
	
	    return $data;
	
		
	 	 
	}
		
	
	function checkKYC($member_id)
	{
	    $QR_SELECT = "SELECT m.member_id,m.user_id,m.first_name,k1.approved_sts as pan,k2.approved_sts as AF,k3.approved_sts as AB,k4.approved_sts as C FROM tbl_members as m LEFT JOIN `tbl_mem_kyc` as k1 on m.member_id = k1.member_id and k1.file_type ='PAN CARD' and k1.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='PAN CARD') LEFT JOIN `tbl_mem_kyc` as k2 on m.member_id = k2.member_id and k2.file_type ='ADHAR CARD FRONT' and k2.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='ADHAR CARD FRONT') LEFT JOIN `tbl_mem_kyc` as k3 on m.member_id = k3.member_id and k3.file_type ='ADHAR CARD BACK' and k3.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='ADHAR CARD BACK' ) LEFT JOIN `tbl_mem_kyc` as k4 on m.member_id = k4.member_id and k4.file_type ='CHEQUE' and k4.kyc_id IN (select max(kyc_id) from tbl_mem_kyc where member_id = m.member_id and file_type ='CHEQUE') where m.member_id IN (SELECT member_id FROM tbl_subscription) AND ( m.member_id = '$member_id' ) AND ( k1.approved_sts = '1' AND k2.approved_sts = '1' AND k3.approved_sts = '1' AND k4.approved_sts = '1') GROUP by m.member_id";
	    $RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	    
	}
	function getrewardachivers($memberId,$lid)
	{
	       $QR_SELECT = "SELECT count(id) as total FROM ".prefix."tbl_cmsn_reward WHERE member_id = '$memberId' and reward_id='$lid'";
           $RS_SELECT = $this->db->query($QR_SELECT);
		   $AR_SELECT = $RS_SELECT->row_array();
		   return $AR_SELECT['total']; 
	
	}
	function getdirectroiamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_singleline WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	
	function checkBanckDetail($member_id)
	{
		$QR_SELECT = "SELECT count(member_id) as total FROM `tbl_members` WHERE member_id='$member_id' and bank_name !='' and account_number !='' and ifc_code !=''";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['total'];
	 
	}
		function checkCmsnDailyDIR($member_id,$from_member_id,$cmsn_date){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."tbl_cmsn_daily_dir WHERE member_id = '".$member_id."' 
					AND DATE(cmsn_date)='".$cmsn_date."' AND 	from_member_id='".$from_member_id."'";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		return $AR_SELECT['ctrl_count'];
	}
		function getPostingCountDirect($member_id,$from_member_id,$cmsn_date){
		$QR_SEL = "SELECT COUNT(daily_cmsn_id) AS ctrl_count FROM ".prefix."tbl_cmsn_daily_dir 
				  WHERE member_id='".$member_id."' AND from_member_id='".$from_member_id."' AND DATE(cmsn_date)<='".$cmsn_date."'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count']+1;
	}
	
	function checklevelmember($member_id)
	{
	$Q_COUNT = "SELECT (case when (m1.subcription_id > 0) THEN 1 ELSE 0 END) as m1, (case when (m2.subcription_id > 0) THEN 1 ELSE 0 END) as m2, (case when (m3.subcription_id > 0) THEN 1 ELSE 0 END) as m3, (case when (m4.subcription_id > 0) THEN 1 ELSE 0 END) as m4, (case when (m5.subcription_id > 0) THEN 1 ELSE 0 END) as m5,(case when (m6.subcription_id > 0) THEN 1 ELSE 0 END) as m6 FROM `tbl_members` as m LEFT JOIN tbl_members as m1 on m.member_id = m1.spil_id and m1.left_right ='L' LEFT JOIN tbl_members as m2 on m.member_id = m2.spil_id and m2.left_right ='R' LEFT JOIN tbl_members as m3 on m1.member_id = m3.spil_id and m3.left_right ='L' LEFT JOIN tbl_members as m4 on m1.member_id = m4.spil_id and m4.left_right ='R' LEFT JOIN tbl_members as m5 on m2.member_id = m5.spil_id and m5.left_right ='L' LEFT JOIN tbl_members as m6 on m2.member_id = m6.spil_id and m6.left_right ='R' WHERE m.member_id='$member_id'";
		$R_COUNT = $this->db->query($Q_COUNT);
		$A_COUNT  = $R_COUNT->row_array();
		return $A_COUNT;
	
	}
    function checkUserPassword($member_id,$trns_password){
		$Q_COUNT = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE member_id='".$member_id."' AND user_password='".$trns_password."'
		 ORDER BY member_id DESC LIMIT 1";
		$R_COUNT = $this->db->query($Q_COUNT);
		$A_COUNT  = $R_COUNT->row_array();
		return $A_COUNT['fldiCtrl'];
	}
	
		function getFundRequest($request_id){
		$QR_TRNS = "SELECT tft.* FROM tbl_fund_request AS tft  WHERE tft.request_id='".$request_id."'";
		$RS_TRNS = $this->db->query($QR_TRNS);
		$AR_TRNS = $RS_TRNS->row_array();
		return $AR_TRNS;
	}
	
	
    function SendOTP($member_id,$type,$bal)
{
    
    $Q_CTRL = "SELECT first_name as name ,user_id as id , member_mobile as mobile FROM tbl_members WHERE member_id='$member_id'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
    $name =  $A_CTRL['name'];
    $mobile =  $A_CTRL['mobile'];
    $id = $A_CTRL['id'];
$username="MLMMLM";
$api_password="12345";
$sender="MLMMLM";
$domain="sms.vertoindia.com";
$priority="1";
$method="POST";
//---------------------------------
	if($type=='Cr')
	{
	$message="Dear ".$name.", Your A/c credited Rs. $bal /- successfully done. Thank You, Regard elegantdig & Team";
	}
	elseif($type =='Dr')
	{
	$message="Dear ".$name.", Your A/c  Rs. $bal /- has been withdrawal successfully done. Thank You, Regard elegantdig & Team";   
	}
	else
	{
	    $message="Dear ".$name.", Your User Id :- $id  Topup from  Rs. $bal /- has been  successfully done. Thank You, Regard elegantdig & Team";   
	}
	$username=urlencode($username);
	$password=urlencode($api_password);
	$sender=urlencode($sender);
	$message=urlencode($message);

$parameters="user=$username&pass=$password&sender=$sender&phone=$member_mobile&text=$message&priority=ndnd&stype=normal";

	$url="http://$domain/api/sendmsg.php?";

	$ch = curl_init($url);

	if($method=="POST")
	{
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
	}
	else
	{
		$get_url=$url."?".$parameters;

		curl_setopt($ch, CURLOPT_POST,0);
		curl_setopt($ch, CURLOPT_URL, $get_url);
	}

	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
	$return_val = curl_exec($ch);

	 
}



function getCountsToken($member_id,$trns_for)
    {
        
    $Q_CTRL = "SELECT COUNT(*) as total FROM `tbl_wallet_trns` WHERE `trns_for` ='$trns_for' and `member_id` ='$member_id'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['total'];  
    }
    
    
    function checkexistPin($name,$price)
    {
        
    $Q_CTRL = "SELECT count(*) as total FROM `tbl_pintype` WHERE pin_name='$name' and `mrp` ='$price'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['total'];  
    }
    function counttotalactivesponsor($mem)
    {
        
    $Q_CTRL = "SELECT COUNT(member_id) as activeid FROM tbl_members WHERE subcription_id >0 and sponsor_id ='$mem'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['activeid'];  
    }
	
	function checkidactive($memberId)
    {
        
    $Q_CTRL = "SELECT COUNT(*) as activeid FROM tbl_subscription WHERE  member_id ='$memberId'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['activeid'];  
    }
	function checkisExist($member_id)
	{
	 $Q_CTRL = "SELECT count(member_id) as total FROM tbl_cmsn_singleline WHERE  member_id ='$member_id' ";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['total'];  
	}
	
	function checkisExistcash($member_id)
	{
	 $Q_CTRL = "SELECT count(member_id) as total FROM tbl_cmsn_cashback WHERE  member_id ='$member_id' ";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['total'];  
	}
	
    function counttotalsponsor($mem)
    {
    $Q_CTRL = "SELECT COUNT(member_id) as total FROM tbl_members WHERE  sponsor_id ='$mem'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['total'];  
        
    }
    function countpendingwithstatus($mem)
    {
            $date = date("Y-m-d");
            $Q_CTRL = "SELECT count(transfer_id) as total FROM  tbl_fund_transfer WHERE from_member_id='$mem' and trns_status='P' and date(trns_date) ='$date' ";
            $R_CTRL = $this->db->query($Q_CTRL);
            $A_CTRL = $R_CTRL->row_array();
            return $A_CTRL['total'];  
    }
	function checkExistAchivers($member_id,$targetId,$type_id,$type)
	{
	$Q_CTRL = "SELECT achiver_id FROM  tbl_target_achive WHERE member_id='$member_id' and target_id='$targetId' and type_id < '$type_id' and type='$type'  ";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['achiver_id'];
	
	}
	function gettargetdata($tid)
	{
		$Q_CTRL = "SELECT * FROM tbl_target_type WHERE type_id='$tid' ORDER BY target_id DESC limit 1";
		$R_CTRL = $this->db->query($Q_CTRL);
		$A_CTRL = $R_CTRL->row_array();
		return $A_CTRL;
	}
	
	
	function getlastEndDate()
	{
	$Q_CTRL = "SELECT edate FROM tbl_target WHERE 1 ORDER BY target_id DESC limit 1";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL['edate'];
	}
	function gettargetbyId($tid)
	{
	$Q_CTRL = "SELECT * FROM tbl_target WHERE target_id='$tid'";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL;
	}
	
	///Reward****************
	//Statrt Closing  
	
	
	function getdirectbetweendate($memberId,$fdate,$edate)
	{
	$QR_SELECT = "SELECT count(member_id) as total FROM tbl_members WHERE sponsor_id='$memberId' AND member_id IN(SELECT member_id from tbl_subscription where date_from BETWEEN '$fdate' and '$edate')";
	       $RS_SELECT = $this->db->query($QR_SELECT);
		   $AR_SELECT = $RS_SELECT->row_array();
		   return $AR_SELECT['total']; 
	}

function getrightleftpv($member_id,$side,$edate){
		if($member_id != ""){
		    $fdate = '2018-04-25';
		    $l=substr($side,0,1);
		$QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='$l';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT SUM(mem.package_type ) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0 and ";
      if($fdate !='' && $edate !=''){
		    
			if($side=="L"){
			    $Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription where date_from BETWEEN '$fdate' and '$edate') ";
			}else if($side=="R"){
				$Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription where date_from BETWEEN '$fdate' and '$edate') ";
			}
			}
		
			$R_CTRL = $this->db->query($Q_CTRL);
			$A_CTRL = $R_CTRL->row_array();
			return $A_CTRL['fldiCtrl'];
		}	
	}	
	
function getrightleft($member_id,$side,$fdate,$edate){
		if($member_id != ""){
		    
		    $l=substr($side,0,1);
		$QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='$l';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0 and ";
      if($fdate !='' && $edate !=''){
		    
			if($side=="L"){
			    $Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription where date_from BETWEEN '$fdate' and '$edate') ";
			}else if($side=="R"){
				$Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription where date_from BETWEEN '$fdate' and '$edate') ";
			}
			}
			else
			{
			if($side=="L"){
			    $Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="R"){
				$Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription ) ";
			}
			}
			$R_CTRL = $this->db->query($Q_CTRL);
			$A_CTRL = $R_CTRL->row_array();
			return $A_CTRL['fldiCtrl'];
		}	
	}
			function getleadershipachivers($memberId,$lid)
	{
	       $QR_SELECT = "SELECT count(id) as total FROM ".prefix."tbl_cmsn_leadership WHERE member_id = '$memberId' and leadership_id='$lid'";
           $RS_SELECT = $this->db->query($QR_SELECT);
		   $AR_SELECT = $RS_SELECT->row_array();
		   return $AR_SELECT['total']; 
	
	}
	function gettotaltdsamount($member_id)
	{
		$QR_SELECT = "SELECT sum(tds) AS ctrl_count FROM ".prefix."tbl_cmsn_mstr WHERE member_id='$member_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	
	
	function counttotalrightpv($member_id,$end_date)
	{
	$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT SUM(ts.net_amount) AS net_amount 
						  FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id=(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id and date_from <= '$end_date' )
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['net_amount'];
	}
	function counttotalleftpv($member_id,$end_date)
	{
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT SUM(ts.net_amount) AS net_amount FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm  ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id =(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id  and date_from <= '$end_date')
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['net_amount'];
	}
	    function gettotalrefpaid($member_id ,$sdate,$edate)
	{
	$QR_SELECT = "SELECT count(tm.member_id) as total FROM `tbl_members` as tm WHERE tm.member_id in (Select member_id from tbl_subscription WHERE date_from <= '$edate') and tm.sponsor_id =$member_id and tm.tripot !='1' and tm.subcription_id > 0";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT['total'];
	}
	
	function counttotalred($member_id,$leadership_id)
	{
	$QR_SELECT = "SELECT count(red_id) as total from ".prefix."tbl_cmsn_red WHERE member_id = '$member_id' and leadership_type = '$leadership_id' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['total'];
	}
	
	function checkexistredremuneration($member_id)
	{
	
	    $year = date('Y');
		$month = date('m');
		$QR_SELECT = "SELECT count(red_id) as total  from ".prefix."tbl_cmsn_red WHERE member_id = '$member_id' and year = '$year' and month = '$month'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['total']; 
	}
	
	function getparentId($memberId)
	{
	       $QR_SELECT = "SELECT member_id as id,spil_id FROM ".prefix."tbl_members WHERE member_id = '$memberId'";
           $RS_SELECT = $this->db->query($QR_SELECT);
		   $AR_SELECT = $RS_SELECT->row_array();
		   return $AR_SELECT; 
	
	}
	function getbinaryexistornot($memberId,$processId)
	{
	  $QR_SELECT = "SELECT SUM(net_cmsn) as net FROM ".prefix."tbl_cmsn_binary WHERE member_id='$memberId' and process_id <='$processId'";
	  $RS_SELECT = $this->db->query($QR_SELECT);
	  $AR_SELECT = $RS_SELECT->row_array();
	  return $AR_SELECT['net'];
	  
	}
	
	
	function getbonusamount($memberId)
	{
	  $QR_SELECT = "SELECT SUM(net_income) as net FROM ".prefix."tbl_cmsn_bonus WHERE member_id='$memberId' and status ='0'";
	  $RS_SELECT = $this->db->query($QR_SELECT);
	  $AR_SELECT = $RS_SELECT->row_array();
	  return $AR_SELECT['net'];
	  
	}
	
	// End Closing
	
	
	
    function returnproductdetail($productId)
    {
           $QR_SELECT = "SELECT * FROM ".prefix."tbl_product WHERE product_id = '$productId'";
           $RS_SELECT = $this->db->query($QR_SELECT);
		   $AR_SELECT = $RS_SELECT->row_array();
		   return $AR_SELECT; 
    }
       
      function gettodaypaidusers($dateFrom)
       {
           $QR_SELECT = "SELECT COUNT(`subcription_id`) as total FROM `tbl_subscription` WHERE `date_from`='$dateFrom'";
           $RS_SELECT = $this->db->query($QR_SELECT);
		   $AR_SELECT = $RS_SELECT->row_array();
		   return $AR_SELECT['total'];
       }
       
       
           function lastcollectiondetail($processId)
       {
            $QR_SELECT = "SELECT SUM(sub.reinvest_amt) as total FROM `tbl_process` as prs LEFT JOIN tbl_subscription as sub on date(sub.date_from) BETWEEN date(prs.start_date) and date(prs.end_date) LEFT JOIN tbl_pintype as pin on sub.type_id = pin.type_id WHERE sub.package_price > '0' and prs.process_id='$processId'";
           	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT['total'];
       }
    function lastpayoutdetail()
	{
        $QR_SELECT = "SELECT SUM(`net_income`) as payout FROM `tbl_cmsn_mstr` WHERE 1 GROUP BY `process_id` ORDER BY `process_id` DESC LIMIT 1";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();
        return $AR_SELECT['payout'];
	}
				
				
    
   
      function gettotalincome()
	{
	$QR_SELECT = "SELECT sum(pin.mrp) as totalIncome FROM `tbl_process` as prs LEFT JOIN tbl_subscription as sub on sub.date_from BETWEEN prs.start_date and prs.end_date LEFT JOIN tbl_pintype as pin on sub.type_id = pin.type_id where sub.package_price > 0";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT['totalIncome'];
	}
	
	      function getincomesall($member_id)
	{
	$QR_SELECT = "SELECT SUM(`binary`) as binaryIncome ,SUM(`level`) as level,  SUM(`club_income`) as royalty_income ,    SUM(`residual`) as roiIncome  ,SUM(`direct`) as directIncome ,SUM(`commuinity`) as commuinity ,SUM(`quick`) as quick  , SUM(`total_income`) as totalPayout  ,SUM(`net_income`) as netIncome FROM `tbl_cmsn_mstr` WHERE  member_id ='$member_id'";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT;
	}
 

	
		      function getincomestotal($member_id)
	{
	$QR_SELECT = "SELECT  SUM(`total_income`) as totalPayout    FROM `tbl_cmsn_mstr` WHERE  member_id ='$member_id'";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT['totalPayout'];
	}
      function getturnoverpayouttotal($processId)
	{
	$QR_SELECT = "SELECT   SUM(ms.binary) as binr ,SUM(ms.direct) as direct ,SUM(ms.residual) as residual ,SUM(ms.pool) as pool ,SUM(ms.quick) as quick  ,SUM(ms.total_income) as total_income ,SUM(ms.admin_charge) as admin_charge ,SUM(ms.tds) as tds ,SUM(ms.net_income) as net_income FROM `tbl_cmsn_mstr` as ms  WHERE 1";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT;
	}
	
	
       function getturnoverpayout($processId)
	{
	$QR_SELECT = "SELECT   SUM(ms.binary) as binr ,SUM(ms.direct) as direct ,SUM(ms.residual) as residual ,SUM(ms.pool) as pool ,SUM(ms.quick) as quick  ,SUM(ms.total_income) as total_income ,SUM(ms.admin_charge) as admin_charge ,SUM(ms.tds) as tds ,SUM(ms.net_income) as net_income FROM `tbl_cmsn_mstr` as ms WHERE ms.process_id='$processId'";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT;
	}
	
	
   /* function gettotalrefpaid($member_id)
	{
	$QR_SELECT = "SELECT count(member_id) as total FROM `tbl_members` WHERE `sponsor_id`=$member_id and tripot !='1' and subcription_id > 0";
	$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				return $AR_SELECT['total'];
	} */
    
    	function getbinaryamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT SUM(net_cmsn) AS ctrl_count FROM ".prefix."tbl_cmsn_binary WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	
	function pkgceiling($member_id)
	{
            $QR_SELECT = "SELECT p.daily_binary_limit as ctrl_count FROM `tbl_subscription` as s LEFT JOIN tbl_pintype as p on p.type_id = s.type_id WHERE s.member_id ='$member_id' ORDER BY s.`subcription_id` DESC LIMIT 1";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['ctrl_count'];
	}
	
	


            function getdirectReturnsamount($member_id,$processId)
            {
            $QR_SELECT = "SELECT SUM(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_direct_R WHERE member_id='$member_id' and process_id='$processId'";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['ctrl_count'];
            
            }
            
            function getBinaryReturnsamount($member_id,$processId)
            {
            $QR_SELECT = "SELECT SUM(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_binary_R WHERE member_id='$member_id' and process_id='$processId'";
            $RS_SELECT = $this->db->query($QR_SELECT);
            $AR_SELECT = $RS_SELECT->row_array();
            return $AR_SELECT['ctrl_count'];
            
            }

	  function getdirectamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT SUM(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_direct WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
		  function getPoolamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT SUM(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_pool WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	
	 function getdirectamounts($member_id)
	{
		$QR_SELECT = "SELECT SUM(total_income) AS ctrl_count FROM ".prefix."tbl_cmsn_direct WHERE member_id='$member_id'  ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	
function	getTotalPoolsIncome($member_id,$process_id,$type)
	{
	      $QR_SELECT = "SELECT SUM(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_income WHERE member_id='$member_id' and process_id='$process_id' and type ='$type'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	
	function	getTotalPoolsIncomes($member_id,$type)
	{
	      $QR_SELECT = "SELECT SUM(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_income WHERE member_id='$member_id'   and type ='$type'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	
		function getcashbackamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_cashback WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
		function getroiamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_daily WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	

		function getquickamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_quick WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	
		function getclubquickamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_quick_club WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
		function getperformancequickamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_quick_performance  WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
		function getRoyaltyamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_royalty WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
function	GetBussinessTotal($member_id)
	{
	    
	    
	    	$QR_SELECT = "SELECT SUM(s.package_price) as total  FROM  tbl_members as m LEFT JOIN tbl_subscription as s on s.member_id = m.member_id WHERE m.sponsor_id ='$member_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['total'];
	}
	
function GtExistReward($member_id,$reward_id,$process_id)
{
        $QR_SELECT = "SELECT count(*) as total  FROM   tbl_cmsn_reward   WHERE 	member_id	 ='$member_id' and reward_id = '$reward_id'  AND process_id='$process_id'";
        $RS_SELECT = $this->db->query($QR_SELECT);
        $AR_SELECT = $RS_SELECT->row_array();
        return $AR_SELECT['total']+1;  
}
	function getLevelamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_level WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	function getLeveldailyamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_level_daily WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	function getcommunityamount($member_id,$processId)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_community WHERE member_id='$member_id' and process_id='$processId'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
		
	    	function getredremamount($member_id)
	{
		$QR_SELECT = "SELECT sum(net_income) AS ctrl_count FROM ".prefix."tbl_cmsn_red WHERE member_id='$member_id' and status='N' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	
  
	
	 function gettotalamount($member_id)
	{
		$QR_SELECT = "SELECT sum(total_income) AS ctrl_count FROM ".prefix."tbl_cmsn_mstr WHERE member_id='$member_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}
	
			function getMemberPaidCountLast($from_date='',$to_date=''){
		
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_subscription WHERE date_from between '$from_date' and '$to_date';";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}	function countcourierstatus($status)
	{
	    
	    $QR_GET = "SELECT COUNT(*) as fldiCtrl FROM `tbl_members` WHERE member_id IN (SELECT member_id FROM tbl_subscription) and tripot ='0' AND courierstatus='$status'";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}
   function getcurrentamount($start_date,$end_date)
   { 
    $QR_GET ="SELECT sum(sub.reinvest_amt) as total  FROM tbl_pintype AS pin LEFT JOIN tbl_subscription AS sub ON (date(sub.date_from) >= '".$start_date."' AND date(sub.date_from) <='".$end_date."') where sub.type_id = pin.type_id and sub.package_price > 0";
    $RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->result_array();
		return $AR_GET[0]['total'];
   }
 function getcurrentamountbypkg($start_date,$end_date)
   { 
    $QR_GET ="SELECT sum(sub.reinvest_amt) as total  FROM tbl_subscription AS sub  where sub.type_id < '7' and sub.package_price > 0";
    $RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->result_array();
		return $AR_GET[0]['total'];
   }
    function getcurrentamountbypowerpkg($start_date,$end_date)
   { 
    $QR_GET ="SELECT sum(sub.reinvest_amt) as total  FROM tbl_subscription AS sub  where sub.type_id = '9' or sub.type_id = '10' and sub.package_price > 0";
    $RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->result_array();
		return $AR_GET[0]['total'];
   }
    function getcurrentamountbymanualpkg($start_date,$end_date)
   { 
     $QR_GET ="SELECT sum(sub.package_price) as total  FROM tbl_subscription AS sub  where sub.type_id = '8'  and sub.package_price > 0";
    $RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->result_array();
		return $AR_GET[0]['total'];
   }
	function getlastprocessId()
	{	
	 $this->db->select('process_id');
	 $this->db->order_by("process_id", "DESC");
	 $this->db->limit(1, 1);
	 $this->db->from('tbl_process');
	 $query = $this->db->get();
	 $res =$query->result_array();
	 return $res[0]['process_id'];
	
	}
	function getlastprocessdate()
	{	
	 $this->db->select('start_date , end_date');
	 $this->db->order_by("process_id", "DESC");
	 $this->db->limit(1, 0);
	 $this->db->from('tbl_process');
	 $query = $this->db->get();
	 $res =$query->result_array();
	 return $res[0];
	
	}
	function getlastpayout($getprocessId){
	    
		$this->db->select('sum(net_cmsn) as net');
		$this->db->where('process_id',$getprocessId);
		$this->db->from('tbl_cmsn_binary');
		$query = $this->db->get();
		$res = $query->result_array();
		return $res[0]['net'];

	}
	
	
	function getState(){
		$QR_SELECT = "SELECT * FROM ".prefix."statelist GROUP BY state";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		return $AR_SELECT;
	}
		function get_cities($name){
		$QR_SELECT = "SELECT * FROM ".prefix."statelist where state = '$name'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->result_array();
		return $AR_SELECT;
	}
	function getWallet($wallet_name){
		$QR_SELECT = "SELECT wallet_id FROM ".prefix."tbl_wallet WHERE wallet_name LIKE '$wallet_name'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['wallet_id'];
	}
	
	function getBigcoins(){
		$QR_SELECT = "SELECT bigcoin_value FROM ".prefix."tbl_bigcoins ORDER BY bigcoin_id DESC LIMIT 1";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		return $AR_SELECT['bigcoin_value'];
	}
	
	function getCMS($id_cms){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_cms WHERE id_cms = '".$id_cms."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	function getGroupWallet($wallet_name){
		$count_array = count($wallet_name);
		$i=1;
		foreach ($wallet_name as $key => $value):
			$prefix = ($i==1)? " AND ( ":" OR";
			$sufix = ($i==$count_array)? " ) ":"";
			$StrWhr .=  $prefix." tw.wallet_name LIKE '".$value."' ".$sufix."";
		$i++; 
		endforeach;
		$QR_SELECT = "SELECT GROUP_CONCAT(wallet_id) AS wallet_id_in 
					  FROM ".prefix."tbl_wallet AS tw 
					  WHERE  tw.wallet_id>0 $StrWhr
					  ORDER BY tw.wallet_id ASC";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		return $AR_SELECT['wallet_id_in'];
	}
	
	function getCompanyId(){
		$QR_SELECT = "SELECT user_id FROM ".prefix."tbl_members WHERE member_id='1'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['user_id'];
	}
	
	function getFirstId(){
		$QR_SELECT = "SELECT member_id FROM ".prefix."tbl_members WHERE member_id='1'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['member_id'];
	}
	

	function checkUserExist($user_name){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."tbl_operator WHERE user_name LIKE '$user_name'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	function checkGroupExist($group_name){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."tbl_oprtr_grp WHERE group_name LIKE '$group_name'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	function getOperator($oprt_id){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_operator WHERE oprt_id = '".$oprt_id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	function checkCmsnDaily($subcription_id,$member_id,$cmsn_date){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."tbl_cmsn_daily WHERE subcription_id = '".$subcription_id."' 
					AND DATE(cmsn_date)='".$cmsn_date."' AND member_id='".$member_id."'";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		return $AR_SELECT['ctrl_count'];
	}

		function checkCmsnlevelDaily($from_member_id,$member_id,$level){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."tbl_cmsn_level WHERE from_member_id = '".$from_member_id."' 
					AND level='".$level."' AND member_id='".$member_id."'";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		return $AR_SELECT['ctrl_count'];
	}
	function getCmsnDaily($daily_cmsn_id){
		$QR_SELECT = "SELECT tcd.* FROM ".prefix."tbl_cmsn_daily AS tcd WHERE tcd.daily_cmsn_id = '".$daily_cmsn_id."'";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		return $AR_SELECT;
	}
	
	function checkEmailExist($member_email){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."tbl_members WHERE member_email LIKE '".$member_email."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	
		function checkCount21($member_id,$type){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM tbl_cmsn_level  WHERE member_id ='$member_id' and type ='$type'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	
	
	function checkCount($table_name,$field,$primary_id){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM $table_name WHERE $field = '$primary_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	
		function getrow($table_name,$field,$primary_id){
		$QR_SELECT = "SELECT * FROM $table_name WHERE $field = '$primary_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	function checkMemberUsernameExist($user_name,$member_id=''){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."tbl_members WHERE user_name LIKE '$user_name'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		if($member_id>0){	
			return 0;
		}else{
			return $AR_SELECT['ctrl_count'];
		}
	}
	
	function getPinDetail($pin_no,$pin_key){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_pinsdetails WHERE pin_no = '".$pin_no."' AND pin_key = '".$pin_key."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	function checkPinActivation($mstr_id,$type_id){
		if($type_id>0){
			return 0;
		}else{
			$QR_MSTR = "SELECT COUNT(tpm.mstr_id) AS row_ctrl FROM ".prefix."tbl_pinsmaster AS tpm 
			WHERE tpm.mstr_id='".$mstr_id."' 
			AND tpm.pin_activation>0";
			$AR_MSTR = $this->SqlModel->runQuery($QR_MSTR,1);
			return ($AR_MSTR['row_ctrl']>0)? "0":1;
			
		}
	}
	
	function updatePinDetail($pin_id,$use_member_id){
		$today_date = InsertDate(getLocalTime());
		if($pin_id>0 && $use_member_id>0){
			$data = array("use_member_id"=>$use_member_id,
				"used_date"=>$today_date,
				"pin_sts"=>"Y"
			);
			$this->SqlModel->updateRecord(prefix."tbl_pinsdetails",$data,array("pin_id"=>$pin_id));
		}
	}
	
	function updateTransactionPassword($member_id,$trns_password){
		$data = array("trns_password"=>$trns_password);
		$this->SqlModel->updateRecord(prefix."tbl_members",$data,array("member_id"=>$member_id));
	}
	
	
	function deleteTable($table_name,$where_condition){
		if ($this->db->delete($table_name, $where_condition)) {
            return true;
        } else {
            return false;
        }
	}
	
	function getGroupType($group_id){
		$QR_SELECT = "SELECT group_type FROM ".prefix."tbl_oprtr_grp WHERE group_id = '$group_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['group_type'];
	}
	
	function getValue($fldvFiled){
		$QR_CONFIG="SELECT value FROM ".prefix."tbl_configuration WHERE name='$fldvFiled'  LIMIT 1";
		$RS_CONFIG = $this->db->query($QR_CONFIG);
		$AR_CONFIG = $RS_CONFIG->row_array();
		if(is_numeric($AR_CONFIG['value'])){
			$returnVar = ($AR_CONFIG['value']==NULL)? "0":$AR_CONFIG['value'];	
		}else{
			$returnVar = ($AR_CONFIG['value']==NULL)? "":$AR_CONFIG['value'];
		}
		return $returnVar;
	}
	
	function getAll($fldvFiled){	
		$QR_CONFIG="SELECT * FROM ".prefix."tbl_configuration WHERE name='$fldvFiled' LIMIT 1";
		$RS_CONFIG = $this->db->query($QR_CONFIG);
		$AR_CONFIG = $RS_CONFIG->row_array();
		return $AR_CONFIG;
	}
	
	function updateConfig($fldvFields,$whereClause){
		$this->db->query("UPDATE ".prefix."tbl_configuration SET $fldvFields WHERE $whereClause");
	}
	
	function setConfig($fldvFields,$fldvValue){
		$date_upd = $date_upd = getLocalTime();
		if($this->checkCount(prefix."tbl_configuration","name",$fldvFields)>0){
			$this->db->query("UPDATE ".prefix."tbl_configuration SET value='$fldvValue', date_upd='$date_upd' WHERE name='$fldvFields'");
		}else{
			$this->db->query("INSERT INTO  ".prefix."tbl_configuration SET value='$fldvValue' , name='$fldvFields', date_add='$date_add', 
			date_upd='$date_upd'");
		}
	}
	
	function getConfig($wherclause){	
		$StrWhr .=($wherclause!="")? "AND $wherclause":"AND id_configuration<0";
		$QR_CONFIG="SELECT value FRgOM ".prefix."tbl_configuration WHERE id_configuration>0  $StrWhr  LIMIT 1";
		$RS_CONFIG = $this->db->query($QR_CONFIG);
		$AR_CONFIG = $RS_CONFIG->row_array();
		$returnVar = ($AR_CONFIG['value']==NULL)? "0":$AR_CONFIG['value'];
		return $returnVar;
	}
	
	function getPinType($type_id){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_pintype WHERE type_id = '".$type_id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
		
	function getPackageId($package_name){
		$QR_SELECT = "SELECT package_id FROM ".prefix."tbl_package WHERE package_name LIKE '$package_name'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['package_id'];
	}
	
	function getPackageName($package_id){
		$QR_SELECT = "SELECT package_name FROM ".prefix."tbl_package WHERE package_id = '$package_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['package_name'];
	}
	
	function deleteReferralSetup(){
		if ($this->db->delete(prefix."tbl_setup_mem_referal_cmsn",array("package_id_from > "=>"0"))) {
            return true;
        } else {
            return false;
        }
	}
	
	public function superreferalType($member_id)
	{
	    	$QR_SELECT = "select count(*) as total  from tbl_subscription where member_id ='".$member_id."' and  active_type_id > '1'    ";
		 	$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['total'] ;
	}
 		 
		public function superreferal2($member_id)
	{
	    
                    $AR_SELECT = $this->getMember($member_id);
                    $member_mobile  =  $AR_SELECT['member_mobile'];
                    $QR_SELECT = "SELECT m.member_id , m.`user_id`,m.`first_name`, s.date_from FROM `tbl_members` as m LEFT JOIN tbl_subscription as s on s.member_id = m.member_id WHERE m.member_mobile ='$member_mobile' AND m.sponsor_id ='$member_id'";
                    $RS_SELECT = $this->db->query($QR_SELECT);
                    $AR_SELECT = $RS_SELECT->result_array();
		return $AR_SELECT ;
	}
	function getRefferalCmsn($package_id_from,$package_id_to){
		$QR_SELECT = "SELECT cmsn_amount FROM ".prefix."tbl_setup_mem_referal_cmsn WHERE package_id_from = '".$package_id_from."' 
		AND package_id_to = '".$package_id_to."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['cmsn_amount'];
	}
		function getMemberIdnew($user_name){
		$QR_SELECT = "SELECT id FROM ".prefix."dummydata WHERE  ( Member_Id = '".$user_name."')";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
	//	return $AR_SELECT['id'];
		return ($AR_SELECT['id'] > 0 )? $AR_SELECT['id']: 0 ;   
		
		
	}
	function getMemberId($user_name){
		$QR_SELECT = "SELECT member_id FROM ".prefix."tbl_members WHERE  ( user_name = '".$user_name."' OR user_id = '".$user_name."' )";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['member_id'];
	}
		function checkMemberIdexist($user_id){
		$QR_SELECT = "SELECT first_name FROM ".prefix."tbl_members WHERE  user_id = '".$user_id."' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT['first_name'];
	}
			function getMemberIdexist($user_id){
		$QR_SELECT = "SELECT member_id FROM ".prefix."tbl_members WHERE  user_id = '".$user_id."' ";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		
		return $AR_SELECT['member_id'];
	}

	
	function getDefaultProcessor(){
		$QR_SELECT = "SELECT processor_id FROM ".prefix."tbl_payment_processor WHERE 1 ORDER BY processor_id ASC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['processor_id'];
	}
	function getProcessor($processor_id){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_payment_processor WHERE processor_id='$processor_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	function getPaymentProcessor($processor_name){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_payment_processor WHERE processor_name='".$processor_name."'";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		return $AR_SELECT;
	}
	
	function getCycleNo($process_id){
		$StrWhr .= ($process_id>0)? " AND process_id='".$process_id."'":"";
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_process WHERE 1 $StrWhr ORDER BY process_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	function getPerfectMoney($order_no){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_perfect_money WHERE order_no='".$order_no."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	
	function uploadBannerImg($FILES,$ARRAY){
		$fldvFileName= $FILES['banner_image']['name'];
		$fldvFileTemp = $FILES['banner_image']['tmp_name'];
		$fldvFileType = $FILES['banner_image']['type'];
		$fldvFileError = $FILES['banner_image']['error'];
		$banner_id = $ARRAY['banner_id'];
		if($fldvFileError=="0" && $banner_id>0){
			$ext = explode(".",$fldvFileName);
			$fExtn = strtolower(end($ext));
			$fldvUniqueNo = UniqueId("UNIQUE_NO");
			$banner_image = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
			$target_path = $fldvPath."upload/banner/".$banner_image;
			if(move_uploaded_file($fldvFileTemp, $target_path)){
				$data_file = array("banner_image"=>$banner_image);
				$this->SqlModel->updateRecord(prefix."tbl_banner",$data_file,array("banner_id"=>$banner_id));						
			}	
		}
	}
	
	
	function uploadPptFile($FILES,$ARRAY,$fldvPath){
		$fldvFileName= $FILES['ppt_file']['name'];
		$fldvFileTemp = $FILES['ppt_file']['tmp_name'];
		$fldvFileType = $FILES['ppt_file']['type'];
		$fldvFileError = $FILES['ppt_file']['error'];
		$ppt_id = $ARRAY['ppt_id'];
		if($fldvFileError=="0" && $ppt_id>0){
			$ext = explode(".",$fldvFileName);
			$fExtn = strtolower(end($ext));
			$fldvUniqueNo = UniqueId("UNIQUE_NO");
			$ppt_file = $fldvUniqueNo.rand(100,999)."_". str_replace(" ","",rand(100,999).".".$fExtn);
			$target_path = $fldvPath."upload/ppt/".$ppt_file;
			if(move_uploaded_file($fldvFileTemp, $target_path)){
				$data_file = array("ppt_file"=>$ppt_file,"ppt_type"=>$fldvFileType);
				$this->SqlModel->updateRecord(prefix."tbl_ppt",$data_file,array("ppt_id"=>$ppt_id));						
			}	
		}
	}
	
	function getPptFile($ppt_id){
		$Q_CHK ="SELECT ppt_file FROM ".prefix."tbl_ppt WHERE ppt_id='$ppt_id';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		if($AR_CHK['ppt_file']!=''){
			return BASE_PATH."upload/ppt/".$AR_CHK['ppt_file'];
		}else{
			return "javascript:void(0)";
		}
	}
	
	
	
	
	function setMemberCoinBase($member_id,$coinbase_name,$coinbase_address,$deposit_amount,$processor_id,$trns_type){
		
		if($member_id>0 && $coinbase_name!='' && $coinbase_address!=''){
			$trsn_no = UniqueId("TRNS_NO");
			$data = array("member_id"=>$member_id,
				"coinbase_name"=>$coinbase_name,
				"coinbase_address"=>$coinbase_address,
				"deposit_amount"=>$deposit_amount,
				"trsn_no"=>$trsn_no,
				"processor_id"=>$processor_id,
				"trns_type"=>$trns_type,
				"coinbase_sts"=>"P"
			);
			
			$coinbase_id  = $this->SqlModel->insertRecord(prefix."tbl_coinbase",$data);
			return $coinbase_id;
		}
	}
	function setMemberPerfectMoney($member_id,$deposit_amount,$order_no,$trns_type,$type_id){
		if($member_id>0 && $deposit_amount>0){
			$data = array("member_id"=>$member_id,
				"order_no"=>$order_no,
				"type_id"=>($type_id>0)? $type_id:0,
				"deposit_amount"=>$deposit_amount,
				"trns_amount"=>0,
				"pmoney_sts"=>"P",
				"trns_type"=>$trns_type
			);
			$pmoney_id  = $this->SqlModel->insertRecord(prefix."tbl_perfect_money",$data);
		}
	}
	
	function setMemberCoinPayment($member_id,$deposit_amount,$order_no,$trns_type,$type_id){
		if($member_id>0 && $deposit_amount>0){
			$data = array("member_id"=>$member_id,
				"order_no"=>$order_no,
				"type_id"=>($type_id>0)? $type_id:0,
				"deposit_amount"=>$deposit_amount,
				"trns_amount"=>0,
				"coinpay_sts"=>"P",
				"trns_type"=>$trns_type
			);
			$coinpay_id  = $this->SqlModel->insertRecord(prefix."tbl_coin_payment",$data);
		}
	}
	
	function deleteOldCoinBase($member_id,$trns_type){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_coinbase WHERE member_id = '".$member_id."' 
					  AND coinbase_sts='P' AND 	 trns_type='".$trns_type."' AND DATE(date_time)=CURDATE()";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		$url_get = "http://btc.blockr.io/api/v1/address/info/".$AR_SELECT['coinbase_address']."";
		$response = get_web_page($url_get);
		$AR_RES = json_decode($response,true);	
		
		$totalreceived = $AR_RES['data']['totalreceived'];
		$confirmation = $AR_RES['data']['first_tx']['confirmations'];
		if( ( $totalreceived<=0 && $confirmation<=0 ) || ($totalreceived=='' && $confirmation=='') ){
			$this->SqlModel->deleteRecord(prefix."tbl_coinbase",array("coinbase_id"=>$AR_SELECT['coinbase_id']));
		}
	}
	
	function getMemberCoinBase($member_id,$trns_type){
		$QR_SELECT = "SELECT tmc.* FROM ".prefix."tbl_coinbase AS tmc WHERE tmc.member_id = '".$member_id."' AND coinbase_sts='P'  
		AND trns_type='".$trns_type."'	ORDER BY coinbase_id DESC LIMIT 1";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		$url_get = "http://btc.blockr.io/api/v1/address/info/".$AR_SELECT['coinbase_address']."";
		$response = get_web_page($url_get);
		$AR_RES = json_decode($response,true);	
		$totalreceived = $AR_RES['data']['totalreceived'];
		$confirmation = $AR_RES['data']['first_tx']['confirmations'];
		if( ( $totalreceived<=0 && $confirmation<=0 ) || ($totalreceived=='' && $confirmation=='') ){
			return $AR_SELECT;
		}
		
	}
	
	function setBitcoinProcessUrl($coinbase_id,$type_id,$trns_type,$process_action){
		if($coinbase_id>0){
			$bitcoin_process_url = generateSeoUrl("cronjob",$process_action,array("coinbase_id"=>_e($coinbase_id),"type_id"=>$type_id,"trns_type"=>$trns_type));
			$this->SqlModel->updateRecord(prefix."tbl_coinbase",array("bitcoin_process_url"=>$bitcoin_process_url),array("coinbase_id"=>$coinbase_id));
		}
	}
	
	function checkOldCoinbase($member_id,$deposit_amount,$trns_type){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."tbl_coinbase WHERE member_id = '".$member_id."' AND coinbase_sts='P' AND 
		deposit_amount!='".$deposit_amount."' AND trns_type='".$trns_type."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	
	function getOrderId($orderid){
	 
		$Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_money_transfer WHERE orderid='".$orderid."';";
		$AR_CHK = $this->SqlModel->runQuery($Q_CHK,true);
		if($AR_CHK['fldiCtrl']==0){
			return $orderid;
		}else{
		    $order_idd  =time().rand('1111',9999);
            $substr = substr($order_idd, 4, 14);
            $orderid =    'AIGX'.$substr;
			return $this->getOrderId($orderid);
		}
	}
	function getSpillId($member_id)
	{
                $QR_BNRY = "	SELECT spil_id  FROM `tbl_members` WHERE  `member_id` ='$member_id'";
                $RS_BNRY = $this->db->query($QR_BNRY);
                $AR_BNRY = $RS_BNRY->row_array();
                
                return $AR_BNRY['spil_id']; 
	}
		function getbulkUser($member_id)
	{
	    
            $QR_BNRY = "SELECT * FROM `tbl_subscription` WHERE `bulk_by` ='$member_id'";
            $RS_BNRY = $this->db->query($QR_BNRY);
            $AR_BNRY = $RS_BNRY->result_array();
             
            return $AR_BNRY; 
	} 
	function generateUserId(){
		$data = "1234567890";
		for($i = 0; $i < 6; $i++){
			$unique_no .= substr($data, (rand()%(strlen($data))), 1);
		}
		$user_id = "RG".$unique_no;
	    //$user_id =$unique_no;
		$Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE user_id='".$user_id."';";
		$AR_CHK = $this->SqlModel->runQuery($Q_CHK,true);
		if($AR_CHK['fldiCtrl']==0){
			return $user_id;
		}else{
			return $this->generateUserId();
		}
	}
	
	function checkPrevMember($member_id){
		$Q_COUNT = "SELECT member_id FROM ".prefix."tbl_members WHERE member_id<'".$member_id."' ORDER BY member_id DESC LIMIT 1";
		$R_COUNT = $this->db->query($Q_COUNT);
		$A_COUNT  = $R_COUNT->row_array();
		return $A_COUNT['member_id'];
	}
	
	function checkNextMember($member_id){
		$Q_COUNT = "SELECT member_id FROM ".prefix."tbl_members WHERE member_id>'".$member_id."' ORDER BY member_id ASC LIMIT 1";
		$R_COUNT = $this->db->query($Q_COUNT);
		$A_COUNT  = $R_COUNT->row_array();
		return $A_COUNT['member_id'];
	}
	
	function checkMemberId($member_id){
		
		$Q_COUNT = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE member_id='".$member_id."' ORDER BY member_id DESC LIMIT 1";
		$R_COUNT = $this->db->query($Q_COUNT);
		$A_COUNT  = $R_COUNT->row_array();
		if($A_COUNT['fldiCtrl']==0){
			set_message("warning","Direct access not allowed , unable to load");
			redirect_page("member","profilelist",array()); exit;
		}
	}
	
	function checkOldPassword($member_id,$user_password){
		$Q_COUNT = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE member_id='".$member_id."' AND user_password='".$user_password."'
		 ORDER BY member_id DESC LIMIT 1";
		$R_COUNT = $this->db->query($Q_COUNT);
		$A_COUNT  = $R_COUNT->row_array();
		return $A_COUNT['fldiCtrl'];
	}
	
	function checkTrnsPassword($member_id,$trns_password){
		$Q_COUNT = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE member_id='".$member_id."' AND trns_password='".$trns_password."'
		 ORDER BY member_id DESC LIMIT 1";
		$R_COUNT = $this->db->query($Q_COUNT);
		$A_COUNT  = $R_COUNT->row_array();
		return $A_COUNT['fldiCtrl'];
	}
	
	function ExtrmLftRgt($member_id, $left_right){
		$QR_GET  = "SELECT member_id FROM ".prefix."tbl_mem_tree WHERE spil_id='$member_id' AND left_right='$left_right';";
		$AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		if($AR_GET['member_id'] == ""){return $member_id;}
		else{return $this->ExtrmLftRgt($AR_GET['member_id'],$left_right);}
	}
	
	function CheckOpenPlace($spil_id, $left_right){
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_mem_tree WHERE spil_id='$spil_id' AND left_right='$left_right'; ";
		$AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		return $AR_GET['fldiCtrl'];
	}

	
	function updateTree($spil_id,$member_id){
		
		$LockTbl = "LOCK TABLE ".prefix."tbl_mem_tree WRITE;";
		
		$SpLeft = "SELECT @myLeft := nleft FROM  ".prefix."tbl_mem_tree WHERE member_id='".$spil_id."';";
		$UpdtRight = "UPDATE  ".prefix."tbl_mem_tree SET nright = nright + 2 WHERE nright > @myLeft;";
		$UpdateLeft = "UPDATE  ".prefix."tbl_mem_tree SET nleft = nleft + 2 WHERE nleft > @myLeft;";
		$UpdateAll ="UPDATE  ".prefix."tbl_mem_tree SET nleft=@myLeft + 1, nright=@myLeft + 2 WHERE member_id='".$member_id."';";
		$UnLockTbl = "UNLOCK TABLES;";
		$this->db->query($LockTbl);
		$this->db->query($SpLeft);
		$this->db->query($UpdtRight);
		$this->db->query($UpdateLeft);
		$this->db->query($UpdateAll);
		$this->db->query($UnLockTbl);
		
		$Q_LVL ="SELECT COUNT(parent.member_id) AS nlevel FROM ".prefix."tbl_mem_tree AS node, ".prefix."tbl_mem_tree AS parent WHERE node.nleft
			 BETWEEN parent.nleft AND parent.nright AND node.member_id='".$member_id."' GROUP BY node.member_id ORDER BY node.nleft";
		$R_LVL = $this->db->query($Q_LVL);
		$AR_LVL = $R_LVL->row_array();


		$Q_UpLvl="UPDATE tbl_mem_tree SET nlevel='$AR_LVL[nlevel]' WHERE member_id='".$member_id."'";
		$this->db->query($Q_UpLvl);
	}
	
	
	function UpdateMemberTree($sponsor_id, $spil_id, $member_id,$left_right,$date_join){
		$date_join = InsertDate($date_join);
		$LockTbl = "LOCK TABLE tbl_mem_tree WRITE;";
		$SpLeft = "SELECT @myLeft := nleft, @iLevel:=nlevel FROM tbl_mem_tree WHERE member_id='$spil_id';";
		$UpdtRight = "UPDATE tbl_mem_tree SET nright = nright + 2 WHERE nright > @myLeft;";
		$UpdateLeft = "UPDATE tbl_mem_tree SET nleft = nleft + 2 WHERE nleft > @myLeft;";
		$StrQ_Insert="INSERT INTO tbl_mem_tree SET member_id='$member_id', sponsor_id='$sponsor_id', spil_id='$spil_id',
					 nlevel=@iLevel+1, nleft=@myLeft+1, nright=@myLeft+2, left_right='$left_right', date_join='$date_join';";
		$UnLockTbl = "UNLOCK TABLES;";
		$this->db->query($LockTbl);
		$this->db->query($SpLeft);
		$this->db->query($UpdtRight);
		$this->db->query($UpdateLeft);
		$this->db->query($StrQ_Insert);
		$this->db->query($UnLockTbl);
		
	}
	
	function advertClickCount($advert_id){
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_advert_trns WHERE advert_id='$advert_id';";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}
	
	function getCurrentImg($member_id){
		if($member_id>0){
		$AR_GV = $this->getMember($member_id);
			if($AR_GV['photo']=="" && $AR_GV['gender']=="M"){ 
				$fldvMemPhoto= BASE_PATH."assets/images/photo.jpg"; 
			}elseif($AR_GV['photo']=="" && $AR_GV['gender']=="F"){ 
				$fldvMemPhoto= BASE_PATH."assets/images/female.jpg"; 
			}elseif($AR_GV['photo']){
				$fldvMemPhoto = BASE_PATH."upload/member/".$AR_GV['photo']; 
			}else{
				$fldvMemPhoto= BASE_PATH."assets/images/photo.jpg"; 
			}
			
			$AR_RT['IMG_SRC']=$fldvMemPhoto;
			return $AR_RT;
		}
	}
	
	function getMember($member_id){
		 $QR_GET = "SELECT tm.*,  ( tm.member_mobile) AS mobile_number, 
		 CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name, tmsp.first_name AS spsr_first_name,
		 tmsp.last_name AS spsr_last_name, CONCAT_WS(' ',tmsp.first_name,tmsp.last_name) AS spsr_full_name, 
		 tmsp.user_id AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright , tpt.pin_name, tpt.avtar
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
		 WHERE tm.member_id='$member_id'";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET;
	}
	
	function getLastMember(){
		 $QR_GET = "SELECT tm.*, CONCAT_WS('',tm.mobile_code,tm.member_mobile) AS mobile_number, 
		 CONCAT_WS(' ',tm.first_name,tm.last_name) AS full_name, tmsp.first_name AS spsr_first_name,
		 tmsp.last_name AS spsr_last_name, CONCAT_WS(' ',tmsp.first_name,tmsp.last_name) AS spsr_full_name, 
		 tmsp.user_id AS spsr_user_id ,
		 tree.nlevel, tree.left_right, tree.nleft, tree.nright , tpt.pin_name, tpt.avtar
		 FROM ".prefix."tbl_members AS tm	
		 LEFT JOIN ".prefix."tbl_members AS tmsp  ON tm.sponsor_id=tmsp.member_id
		 LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tm.member_id=tree.member_id
		 LEFT JOIN ".prefix."tbl_pintype AS tpt ON tpt.type_id=tm.type_id
		 WHERE 1 ORDER BY tm.member_id DESC LIMIT 1";
		 $AR_GET = $this->SqlModel->runQuery($QR_GET,true);
		 return $AR_GET;
	}
	  function	getReferalIncome($processId,$memberId)
	{
	    
	    	$QR_WALLET = "SELECT SUM(cash_account) AS total_amount  FROM tbl_cmsn_direct WHERE member_id='".$memberId."' and process_id='".$processId."' ";
			$RS_WALLET = $this->db->query($QR_WALLET);
			$AR_WALLET = $RS_WALLET->row_array();
			return $AR_WALLET['total_amount'];
	}
	 function	getReferalIncomeUnclear($memberId)
	{
	    
	    	$QR_WALLET = "SELECT SUM(cash_account) AS total_amount  FROM tbl_cmsn_direct WHERE member_id='".$memberId."' and status='0' ";
			$RS_WALLET = $this->db->query($QR_WALLET);
			$AR_WALLET = $RS_WALLET->row_array();
			
			return $AR_WALLET['total_amount'];
	}
	function getReferalIncomeUnclearBonus($memberId)
	{
	    
	    	$QR_WALLET = "SELECT SUM(cash_account) AS total_amount  FROM tbl_cmsn_bonus WHERE member_id='".$memberId."' and status='0' ";
			$RS_WALLET = $this->db->query($QR_WALLET);
			$AR_WALLET = $RS_WALLET->row_array();
			
			return $AR_WALLET['total_amount'];
	}
  function getLeadershipIncomeUnclearBonus($memberId)
  {
  $QR_WALLET = "SELECT SUM(net_income) AS total_amount  FROM tbl_cmsn_leadership WHERE member_id='".$memberId."' and status='0' ";
			$RS_WALLET = $this->db->query($QR_WALLET);
			$AR_WALLET = $RS_WALLET->row_array();
			
			return $AR_WALLET['total_amount'];
  }
	
	function getMemberUserId($member_id){
		$QR_SELECT = "SELECT user_id FROM ".prefix."tbl_members WHERE member_id = '".$member_id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['user_id'];
	}
	
		function getMemberdetail($member_id){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_members WHERE member_id = '".$member_id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
		function getMemberdetailbyuserid($member_id){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_members WHERE user_id = '".$member_id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}	
		function getnamebyuserid($user_id){
		$QR_SELECT = "SELECT 	CONCAT_WS(' ',first_name,last_name) AS full_name FROM ".prefix."tbl_members WHERE user_id = '".$user_id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['full_name'];
	}
	function getsprillId($member_id,$side)
	{
	    $QR_SELECT = "SELECT member_id FROM ".prefix."tbl_members WHERE spil_id = '".$member_id."'and left_right ='".$side."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['member_id'];
	}
	function getMemberJoining($member_id,$from_date,$till_date){
		$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE member_id='".$member_id."';";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		$nleft = $AR_SELECT["nleft"];
		$nright = $AR_SELECT["nright"];
		
		$Q_CTRL="SELECT COUNT(member_id) AS fldiCtrl FROM tbl_mem_tree WHERE nleft BETWEEN '".$nleft."' AND '".$nright."' 
		AND member_id!='".$member_id."' AND DATE(date_join) BETWEEN '".$from_date."' AND '".$till_date."'";
		$R_CTRL = $this->db->query($Q_CTRL);
		$A_CTRL = $R_CTRL->row_array();
		return $A_CTRL['fldiCtrl'];
	}
	
	function getDownlineMemberId($member_id,$left_right){
		$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='".$left_right."';";
		$AR_SELECT = $this->SqlModel->runQuery($QR_SELECT,true);
		$nleft = $AR_SELECT["nleft"];
		$nright = $AR_SELECT["nright"];
		
		$Q_CTRL = "SELECT tm.member_id
				  FROM  tbl_members AS  tm
				  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=tm.member_id
				  WHERE  tree.nleft BETWEEN '".$nleft."'  AND '".$nright."' AND tm.delete_sts>0";
		$R_CTRL = $this->SqlModel->runQuery($Q_CTRL);
		$AR_RT = array();
		foreach($R_CTRL as $A_CTRL):
			$AR_RT[]=$A_CTRL['member_id'];
		endforeach;
		return $AR_RT;
	}
	function getpaidcount($member_id,$switch)
	{
	$QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='$switch';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright' and mem.turbosale != '1' AND mem.tripot != '1'  and mem.type_id>0 and tree.member_id in (SELECT member_id from tbl_subscription) ";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
				
	}
	function getbussiness($member_id, $switch)	
	{
                $QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='$switch';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'  and mem.subcription_id > 0 ";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
				
    }
	
	function BinaryCount($member_id, $switch){
		switch($switch){
			case "LeftPaidCount":
			    $QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0 and tree.member_id in (SELECT member_id from tbl_subscription) ";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
			case "LeftTurboCount":
			    $QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0    and tree.member_id in (SELECT member_id from tbl_subscription)";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
			case "LeftCount":
			    $QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   ";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
			case "LeftPoint":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT SUM(ts.net_amount) AS net_amount
						  FROM  tbl_subscription AS  ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
						  WHERE  tree.nleft BETWEEN '$nleft'  AND '$nright' AND tm.delete_sts>0   ";
				$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
				$net_amount = $A_CTRL['net_amount'];
				return $net_amount;
			break;
				case "LeftPoints":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT SUM(ts.prod_pv) AS net_amount
						  FROM  tbl_subscription AS  ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
						  WHERE  tree.nleft BETWEEN '$nleft'  AND '$nright' AND tm.delete_sts>0   ";
				$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
				$net_amount = $A_CTRL['net_amount'];
				return $net_amount;
			break;
			case "LeftPaid":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT SUM(ts.net_amount) AS net_amount FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm  ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id =(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['net_amount'];
			break;
				case "LeftActive":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT count(ts.subcription_id) AS total FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm  ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id =(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['total'];
			break;
				case "LeftCountDirectActive":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT count(ts.subcription_id) AS total FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm  ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id =(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0 AND tree.sponsor_id='$member_id'";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['total'];
			break;
			case "LeftCountDirect":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(member_id) AS fldiCtrl FROM tbl_mem_tree WHERE nleft BETWEEN '$nleft' AND '$nright' AND sponsor_id='$member_id'";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
			case "RightPaidCount":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0 and tree.member_id in (SELECT member_id from tbl_subscription) ";
				//$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
			case "RightTurboCount":
			    $QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0    and tree.member_id in (SELECT member_id from tbl_subscription)";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
			case "RightCount":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'  ";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
			case "RightPoint":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT SUM(ts.net_amount) AS net_amount
						  FROM  tbl_subscription AS  ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
						  WHERE  tree.nleft BETWEEN '$nleft'  AND '$nright' AND tm.delete_sts>0   ";
				$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
				$net_amount = $A_CTRL['net_amount'];
				return $net_amount;
			break;
				case "RightPoints":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT SUM(ts.prod_pv) AS net_amount
						  FROM  tbl_subscription AS  ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
						  WHERE  tree.nleft BETWEEN '$nleft'  AND '$nright' AND tm.delete_sts>0   ";
				$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
				$net_amount = $A_CTRL['net_amount'];
				return $net_amount;
			break;
			case "RightPaid":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT SUM(ts.net_amount) AS net_amount 
						  FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id=(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['net_amount'];
			break;
			case "RightActive":  
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT count(ts.subcription_id) AS total 
						  FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id=(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['total'];
			break;
			case "RightCountDirectActive":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
			$Q_CTRL = "SELECT count(ts.subcription_id) AS total 
						  FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id=(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0 AND tree.sponsor_id='$member_id'";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['total'];
			break;
			case "RightCountDirect":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(member_id) AS fldiCtrl FROM tbl_mem_tree WHERE nleft BETWEEN '$nleft' AND '$nright'  AND sponsor_id='$member_id'";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
			case "TotalCount":
				$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE member_id='".$member_id."';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				
				$Q_CTRL="SELECT COUNT(member_id) AS fldiCtrl FROM tbl_mem_tree WHERE nleft BETWEEN '".$nleft."' AND '".$nright."' 
				AND member_id!='".$member_id."'";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
			case "DirectCount":
				$Q_CTRL = "SELECT COUNT(member_id) AS fldiCtrl FROM tbl_members WHERE sponsor_id='$member_id'";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['fldiCtrl'];
			break;
		}
	}
	
	/*function getCount($member_id,$side){
		if($member_id != ""){
		    
		    $l=substr($side,0,1);
			    $QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='$l';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0 and ";

		    
			if($side=="L"){
			    $Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="R"){
				$Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="LT"){
				$Q_CTRL .= "mem.turbosale = 2 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription)";
			}else if($side=="RT"){
				$Q_CTRL .= "mem.turbosale = 2 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription)";
			}else if($side=="Lhalf"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 1 and 5 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rhalf"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 1 and 5 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Lfull"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 6 and 8 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rfull"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 6 and 8 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Ldouble"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 9 and 10 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rdouble"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 9 and 10 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="LhalfT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 1 and 5 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="RhalfT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 1 and 5 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="LfullT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 6 and 8 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="RfullT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 6 and 8 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="LdoubleT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 9 and 10 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="RdoubleT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 9 and 10 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}
			
			$R_CTRL = $this->db->query($Q_CTRL);
			$A_CTRL = $R_CTRL->row_array();
			return $A_CTRL['fldiCtrl'];

		}
	}
	function getCount1($member_id,$side){
		if($member_id != ""){
		    
		    $l=substr($side,0,1);
			    $QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='$l';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0 and ";

		    
			if($side=="L"){
			    $Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="R"){
				$Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="LT"){
				$Q_CTRL .= "mem.turbosale = 2 and tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="RT"){
				$Q_CTRL .= "mem.turbosale = 2 and tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="Lhalf"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 1 and 5 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rhalf"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 1 and 5 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Lfull"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 6 and 8 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rfull"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 6 and 8 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Ldouble"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 9 and 10 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rdouble"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.type_id BETWEEN 9 and 10 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="LhalfT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 1 and 5 and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}else if($side=="RhalfT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 1 and 5 and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}else if($side=="LfullT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 6 and 8 and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}else if($side=="RfullT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 6 and 8 and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}else if($side=="LdoubleT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 9 and 10 and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="RdoubleT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.type_id BETWEEN 9 and 10 and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}
			
			$R_CTRL = $this->db->query($Q_CTRL);
			$A_CTRL = $R_CTRL->row_array();
			return $A_CTRL['fldiCtrl'];

		}
	}*/
	
	
	function getCount($member_id,$side){
		if($member_id != ""){
		    
		    $l=substr($side,0,1);
			    $QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='$l';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0 and ";

		    
			if($side=="L"){
			    $Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="R"){
				$Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="LT"){
				$Q_CTRL .= "mem.turbosale = 2 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription)";
			}else if($side=="RT"){
				$Q_CTRL .= "mem.turbosale = 2 and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription)";
			}else if($side=="Lhalf"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='1000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rhalf"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='1000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Lfull"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='2000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rfull"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='2000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Ldouble"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='4000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rdouble"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='4000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="LhalfT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='1000' and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="RhalfT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='1000' and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="LfullT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='2000' and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="RfullT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='2000' and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="LdoubleT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='4000' and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="RdoubleT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='4000' and tree.member_id in (SELECT member_id from tbl_subscription) and mem.sponsor_id in (SELECT member_id from tbl_subscription);";
			}
			
			$R_CTRL = $this->db->query($Q_CTRL);
			$A_CTRL = $R_CTRL->row_array();
			return $A_CTRL['fldiCtrl'];

		}
	}
    function getCount1($member_id,$side){
		if($member_id != ""){
		    
		    $l=substr($side,0,1);
			    $QR_SELECT = "SELECT nleft,nright FROM tbl_mem_tree WHERE spil_id='$member_id' AND left_right='$l';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT COUNT(tree.member_id) AS fldiCtrl FROM tbl_mem_tree  as tree   LEFT JOIN tbl_members AS mem  ON tree.member_id=mem.member_id WHERE tree.nleft BETWEEN '$nleft' AND '$nright'   and mem.type_id>0 and ";

		    
			if($side=="L"){
			    $Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="R"){
				$Q_CTRL .= "tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="LT"){
				$Q_CTRL .= "mem.turbosale = 2 and tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="RT"){
				$Q_CTRL .= "mem.turbosale = 2 and tree.member_id in (SELECT member_id from tbl_subscription) ";
			}else if($side=="Lhalf"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='1000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rhalf"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='1000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Lfull"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='2000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rfull"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='2000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Ldouble"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='4000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="Rdouble"){
				$Q_CTRL .= "mem.turbosale = 1 and mem.prod_pv ='4000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="LhalfT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='1000' and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}else if($side=="RhalfT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='1000' and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}else if($side=="LfullT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='2000' and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}else if($side=="RfullT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='2000' and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}else if($side=="LdoubleT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='4000' and tree.member_id in (SELECT member_id from tbl_subscription);";
			}else if($side=="RdoubleT"){
				$Q_CTRL .= "mem.turbosale = 2 and mem.prod_pv ='4000' and tree.member_id in (SELECT member_id from tbl_subscription) ;";
			}
			
			$R_CTRL = $this->db->query($Q_CTRL);
			$A_CTRL = $R_CTRL->row_array();
			return $A_CTRL['fldiCtrl'];

		}
	}
		function getNameStatusnew($member_id, $spil_id, $left_right){
	if($member_id != ""){
			$fldiDirects = $this->BinaryCount($member_id, "DirectCount");
			$fldiLeftCtrl = $this->BinaryCount($member_id, "LeftCount");  if($fldiLeftCtrl==""){ $fldiLeftCtrl = 0;}
			$fldiRightCtrl = $this->BinaryCount($member_id, "RightCount"); if($fldiRightCtrl=="") { $fldiRightCtrl = 0; }
// 			#$fldiTotalCtrl = $this->BinaryCount($member_id, "TotalCount");
			
// 			$fldiInvestment = $this->getInvestment($member_id);
			
// 			$fldiLeftPoint = $this->BinaryCount($member_id, "LeftPoints");
// 			$fldiRightPoint = $this->BinaryCount($member_id, "RightPoints");
// 		    $LeftPaidCount =$this->BinaryCount($member_id,"LeftPaidCount");
// 		    $RightPaidCount =$this->BinaryCount($member_id,"RightPaidCount");
			
			
			$AR_GV = $this->getMember($member_id);
		     
		     if($AR_GV['rank_id'] > 0 )
		     {
		       $CssCls = '' ;// 'background-color: #00b8f1;';  
		     }
		     else
		     {
		       $CssCls = '';  
		     }
		     
		     	
			
			
			if($AR_GV['photo']=="" && $AR_GV['gender']=="M"){ 
				$fldvMemPhoto= BASE_PATH."assets/images/photo.jpg"; 
			}elseif($AR_GV['photo']=="" && $AR_GV['gender']=="F"){ 
				$fldvMemPhoto= BASE_PATH."assets/images/female.jpg"; 
			}elseif($AR_GV['photo']!=''){
				$fldvMemPhoto = BASE_PATH."upload/member/".$AR_GV['photo']; 
			}else{
				$fldvMemPhoto = BASE_PATH."assets/images/photo.jpg"; 
			}
			$AR_TYPE  = $this->getCurrentMemberShip($member_id); 
			$pain_name = ($AR_TYPE['pin_name'])? $AR_TYPE['pin_name']:"Free";
			$date_from = InsertDate($AR_TYPE['date_from']);
			$date_expire = InsertDate($AR_TYPE['date_expire']);
			
			$Message ="<table width=400 border=0 cellspacing=3 cellpadding=1><tr><td valign=top>Sponsor Id:</td><td valign=top>".$AR_GV['spsr_user_id']."</td></tr><tr><td width=100 valign=top>Member Id:</td><td colspan=2>".$AR_GV['user_id']."</td></tr><tr><td width=100 valign=top>Name:</td><td colspan=2>".getSubString($AR_GV['first_name'],16)."</td></tr><tr><td valign=top>Type:</td><td colspan=2 valign=top>".$pain_name."</td></tr><tr><td valign=top>Active Date: </td><td colspan=2 valign=top>".$date_from."</td></tr><tr><td valign=top>Left Paid Id:</td><td colspan=2 valign=top>".number_format($LeftPaidCount)."</td></tr><tr><td valign=top>Right Paid Id :</td> <td colspan=2 valign=top>".number_format($RightPaidCount)."</td>    </tr><tr><td valign=top>Left BV :</td> <td colspan=2 valign=top>".number_format($fldiLeftPoint)."</td> </tr><tr><td valign=top>Right BV :</td> <td colspan=2 valign=top>".number_format($fldiRightPoint)."</td> </tr><td width=210 rowspan=5 valign=top align=left><img src=".$fldvMemPhoto." width=75 height=92 /></td></tr><tr><td valign=top>Total Paid Id :</td><td valign=top>".($LeftPaidCount+$RightPaidCount)."</td></tr><tr><td valign=top>Direct Count:</td><td width=113 valign=top>".$fldiDirects."</td></tr><tr><td valign=top>Left Count:</td><td valign=top>".$fldiLeftCtrl."</td></tr><tr><td valign=top>Right Count:</td><td valign=top>".$fldiRightCtrl."</td></tr><tr><td valign=top>Total Count :</td><td valign=top>".($fldiLeftCtrl+$fldiRightCtrl)."</td></tr></table>";
			echo '<table border="0" cellpadding="0" cellspacing="0" align=center><tr><td align=center>';
			
			$border_color = ($AR_TYPE['avtar']!='')? $AR_TYPE['avtar']:"default_pic";
			
			$ImgSrc = BASE_PATH."assets/images/red_m.png";
			
			$fldvImageArr = @getimagesize($ImgSrc);
			if($fldvImageArr['mime']=="" && $AR_GV['photo']=="") { 
			//	$ImgSrc = BASE_PATH."assets/images/cm-advisor-nopic.jpg";
			$ImgSrc = BASE_PATH."assets/images/red_m.png";
			    
			    
			}	
		  if($pain_name == 'FREE')
		  {
		 
		    $src =BASE_PATH.'assets/images/yellow1.png';
		  }
		  elseif($AR_TYPE['package_price'] > '0' || $pain_name =='Activation Package'  )
		  {
    	 
    		 $src =BASE_PATH.'assets/images/green1.png';
    	  }
    	   
		  else{
		     //$col = 'color: red;';
		    // $src =BASE_PATH.'assets/tree/red.png';
		    // $src =BASE_PATH.'assets/images/red.png';
		    
		    $src =BASE_PATH.'assets/images/yellow1.png';
		  }
		  
		
		//	$ImgSrc ="<i class='fa fa-user fa-4x' aria-hidden='true' style='".$col."' border=0 onMouseover=\"Tip('".$Message."', SHADOW, true, TITLE, 'Statistics', PADDING, 2)\" onclick='moveTree(\""._e($member_id)."\")' class='pointer img-circle' width=100 height=100></i>"; 
		
			$ImgSrc ="<img  src='".$src."' border=0 lllonMouseover=\"Tip('".$Message."', SHADOW, true, TITLE, 'Statistics', PADDING, 2)\" onclick='moveTree(\""._e($member_id)."\")' class='pointer img-circle' width=90 height=90>"; 
			echo "<div class=''>".$ImgSrc."</div>";
			echo '</td></tr><tr><td align=center><a class="'.$CssCls.'" style="text-decoration:underline;cursor:pointer" onclick="moveTree(\''._e($member_id).'\')"></a></td></tr><tr><td align=center><font style="'.$CssCls.'">'.$AR_GV['member_id'].'<br /> '.getSubString($AR_GV['first_name'],16).'  </font></td></tr>';
			
			if($left_right==""){
				echo '<tr><td align=center class="bluetext">'.
					  "<b>Total Left User: ".number_format($fldiLeftCtrl,0,"","").
					  "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;".
					  "Total Right User: ".number_format($fldiRightCtrl,0,"","").
					  "</b></td></tr>";
			}
			echo '</table>';
		}else{
			echo '<table border="0" cellpadding="0" cellspacing="0"><tr><td align="center">';
			if($fldiSpLId!=""){
				echo '<i class="fa fa-user fa-4x" aria-hidden="true" style="color: gray;"></i>';
				
			}else{ 
			$ImgSrc = BASE_PATH."assets/images/black1.png";
			if($spil_id !='')
			{
			    $uid = $this->session->userdata('user_id');
			     $src =BASE_PATH.'assets/images/black1.png';
			   // echo '<a href="'.BASE_PATH.'member/account/newUser/'._e($spil_id).'/'._e($left_right).'" ><img  src="'.$src.'"  border=0  class="pointer img-circle" width=100 height=100></a>'; 
			     echo '<a  href="'.BASE_PATH.'sign-up/'.$uid.'" target="_blank" ><img  src="'.$src.'"  border=0  class="pointer img-circle" width=100 height=100></a>'; 
		//	echo '<a href="'.BASE_PATH.'member/account/newUser/'._e($spil_id).'/'._e($left_right).'" ><i class="fa fa-user fa-4x" aria-hidden="true" style="color: black;"></i></a>'; 
			//echo '<i class="fa fa-user fa-4x" aria-hidden="true" style="color: gray;"></i>'; 
			}
			else
			{
			    $src =BASE_PATH.'assets/images/black1.png';
			   echo  '<img  src="'.$src.'"  border=0  class="pointer img-circle" width=100 height=100>';
		//	echo '<i class="fa fa-user fa-4x" aria-hidden="true" style="color:black;"></i></span>'; 
			}
			}
			echo '</td></tr></table>';
		}
	}
		function getNameStatus($member_id, $spil_id, $left_right){
	if($member_id != ""){
			$fldiDirects = $this->BinaryCount($member_id, "DirectCount");
			$fldiLeftCtrl = $this->BinaryCount($member_id, "LeftCount");  if($fldiLeftCtrl==""){ $fldiLeftCtrl = 0;}
			$fldiRightCtrl = $this->BinaryCount($member_id, "RightCount"); if($fldiRightCtrl=="") { $fldiRightCtrl = 0; }
// 			#$fldiTotalCtrl = $this->BinaryCount($member_id, "TotalCount");
			
// 			$fldiInvestment = $this->getInvestment($member_id);
			
// 			$fldiLeftPoint = $this->BinaryCount($member_id, "LeftPoints");
// 			$fldiRightPoint = $this->BinaryCount($member_id, "RightPoints");
// 		    $LeftPaidCount =$this->BinaryCount($member_id,"LeftPaidCount");
// 		    $RightPaidCount =$this->BinaryCount($member_id,"RightPaidCount");
			
			
			$AR_GV = $this->getMember($member_id);
		     
		     if($AR_GV['rank_id'] > 0 )
		     {
		       $CssCls = '' ;// 'background-color: #00b8f1;';  
		     }
		     else
		     {
		       $CssCls = '';  
		     }
		     
		     	
			
			
			if($AR_GV['photo']=="" && $AR_GV['gender']=="M"){ 
				$fldvMemPhoto= BASE_PATH."assets/images/photo.jpg"; 
			}elseif($AR_GV['photo']=="" && $AR_GV['gender']=="F"){ 
				$fldvMemPhoto= BASE_PATH."assets/images/female.jpg"; 
			}elseif($AR_GV['photo']!=''){
				$fldvMemPhoto = BASE_PATH."upload/member/".$AR_GV['photo']; 
			}else{
				$fldvMemPhoto = BASE_PATH."assets/images/photo.jpg"; 
			}
			$AR_TYPE  = $this->getCurrentMemberShip($member_id); 
			$pain_name = ($AR_TYPE['pin_name'])? $AR_TYPE['pin_name']:"Free";
			$date_from = InsertDate($AR_TYPE['date_from']);
			$date_expire = InsertDate($AR_TYPE['date_expire']);
			
			$Message ="<table width=400 border=0 cellspacing=3 cellpadding=1><tr><td valign=top>Sponsor Id:</td><td valign=top>".$AR_GV['spsr_user_id']."</td></tr><tr><td width=100 valign=top>Member Id:</td><td colspan=2>".$AR_GV['user_id']."</td></tr><tr><td width=100 valign=top>Name:</td><td colspan=2>".getSubString($AR_GV['first_name'],16)."</td></tr><tr><td valign=top>Type:</td><td colspan=2 valign=top>".$pain_name."</td></tr><tr><td valign=top>Active Date: </td><td colspan=2 valign=top>".$date_from."</td></tr><tr><td valign=top>Left Paid Id:</td><td colspan=2 valign=top>".number_format($LeftPaidCount)."</td></tr><tr><td valign=top>Right Paid Id :</td> <td colspan=2 valign=top>".number_format($RightPaidCount)."</td>    </tr><tr><td valign=top>Left BV :</td> <td colspan=2 valign=top>".number_format($fldiLeftPoint)."</td> </tr><tr><td valign=top>Right BV :</td> <td colspan=2 valign=top>".number_format($fldiRightPoint)."</td> </tr><td width=210 rowspan=5 valign=top align=left><img src=".$fldvMemPhoto." width=75 height=92 /></td></tr><tr><td valign=top>Total Paid Id :</td><td valign=top>".($LeftPaidCount+$RightPaidCount)."</td></tr><tr><td valign=top>Direct Count:</td><td width=113 valign=top>".$fldiDirects."</td></tr><tr><td valign=top>Left Count:</td><td valign=top>".$fldiLeftCtrl."</td></tr><tr><td valign=top>Right Count:</td><td valign=top>".$fldiRightCtrl."</td></tr><tr><td valign=top>Total Count :</td><td valign=top>".($fldiLeftCtrl+$fldiRightCtrl)."</td></tr></table>";
			echo '<table border="0" cellpadding="0" cellspacing="0" align=center><tr><td align=center>';
			
			$border_color = ($AR_TYPE['avtar']!='')? $AR_TYPE['avtar']:"default_pic";
			
			$ImgSrc = BASE_PATH."assets/images/red_m.png";
			
			$fldvImageArr = @getimagesize($ImgSrc);
			if($fldvImageArr['mime']=="" && $AR_GV['photo']=="") { 
			//	$ImgSrc = BASE_PATH."assets/images/cm-advisor-nopic.jpg";
			$ImgSrc = BASE_PATH."assets/images/red_m.png";
			    
			    
			}	
		  if($pain_name == 'FREE')
		  {
		 
		    $src =BASE_PATH.'assets/images/yellow1.png';
		  }
		  elseif($AR_TYPE['package_price'] > '0' || $pain_name =='Activation Package'  )
		  {
    	 
    		 $src =BASE_PATH.'assets/images/green1.png';
    	  }
    	   
		  else{
		     //$col = 'color: red;';
		    // $src =BASE_PATH.'assets/tree/red.png';
		    // $src =BASE_PATH.'assets/images/red.png';
		    
		    $src =BASE_PATH.'assets/images/yellow1.png';
		  }
		  
		
		//	$ImgSrc ="<i class='fa fa-user fa-4x' aria-hidden='true' style='".$col."' border=0 onMouseover=\"Tip('".$Message."', SHADOW, true, TITLE, 'Statistics', PADDING, 2)\" onclick='moveTree(\""._e($member_id)."\")' class='pointer img-circle' width=100 height=100></i>"; 
		
			$ImgSrc ="<img  src='".$src."' border=0 lllonMouseover=\"Tip('".$Message."', SHADOW, true, TITLE, 'Statistics', PADDING, 2)\" onclick='moveTree(\""._e($member_id)."\")' class='pointer img-circle' width=90 height=90>"; 
			echo "<div class=''>".$ImgSrc."</div>";
			echo '</td></tr><tr><td align=center><a class="'.$CssCls.'" style="text-decoration:underline;cursor:pointer" onclick="moveTree(\''._e($member_id).'\')"></a></td></tr><tr><td align=center><font style="'.$CssCls.'">'.$AR_GV['user_name'].'<br /> '.getSubString($AR_GV['first_name'],16).'  </font></td></tr>';
			
			if($left_right==""){
				echo '<tr><td align=center class="bluetext">'.
					  "<b>Total Left User: ".number_format($fldiLeftCtrl,0,"","").
					  "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;".
					  "Total Right User: ".number_format($fldiRightCtrl,0,"","").
					  "</b></td></tr>";
			}
			echo '</table>';
		}else{
			echo '<table border="0" cellpadding="0" cellspacing="0"><tr><td align="center">';
			if($fldiSpLId!=""){
				echo '<i class="fa fa-user fa-4x" aria-hidden="true" style="color: gray;"></i>';
				
			}else{ 
			$ImgSrc = BASE_PATH."assets/images/black1.png";
			if($spil_id !='')
			{
			    $uid = $this->session->userdata('user_id');
			     $src =BASE_PATH.'assets/images/black1.png';
			   // echo '<a href="'.BASE_PATH.'member/account/newUser/'._e($spil_id).'/'._e($left_right).'" ><img  src="'.$src.'"  border=0  class="pointer img-circle" width=100 height=100></a>'; 
			     echo '<a  href="'.BASE_PATH.'sign-up/'.$uid.'" target="_blank" ><img  src="'.$src.'"  border=0  class="pointer img-circle" width=100 height=100></a>'; 
		//	echo '<a href="'.BASE_PATH.'member/account/newUser/'._e($spil_id).'/'._e($left_right).'" ><i class="fa fa-user fa-4x" aria-hidden="true" style="color: black;"></i></a>'; 
			//echo '<i class="fa fa-user fa-4x" aria-hidden="true" style="color: gray;"></i>'; 
			}
			else
			{
			    $src =BASE_PATH.'assets/images/black1.png';
			   echo  '<img  src="'.$src.'"  border=0  class="pointer img-circle" width=100 height=100>';
		//	echo '<i class="fa fa-user fa-4x" aria-hidden="true" style="color:black;"></i></span>'; 
			}
			}
			echo '</td></tr></table>';
		}
	}
	function getNameStatusAdmin($member_id, $spil_id, $left_right){
	if($member_id != ""){
			$fldiDirects = $this->BinaryCount($member_id, "DirectCount");
			$fldiLeftCtrl = $this->BinaryCount($member_id, "LeftCount");  if($fldiLeftCtrl==""){ $fldiLeftCtrl = 0;}
			$fldiRightCtrl = $this->BinaryCount($member_id, "RightCount"); if($fldiRightCtrl=="") { $fldiRightCtrl = 0; }
			#$fldiTotalCtrl = $this->BinaryCount($member_id, "TotalCount");
			
			$fldiInvestment = $this->getInvestment($member_id);
			
			$fldiLeftPoint = $this->BinaryCount($member_id, "LeftPoints");
			$fldiRightPoint = $this->BinaryCount($member_id, "RightPoints");
		    $LeftPaidCount =$this->BinaryCount($member_id,"LeftPaidCount");
		    $RightPaidCount =$this->BinaryCount($member_id,"RightPaidCount");
			
			
			$AR_GV = $this->getMember($member_id);
			
			
			
			if($AR_GV['photo']=="" && $AR_GV['gender']=="M"){ 
				$fldvMemPhoto= BASE_PATH."assets/images/photo.jpg"; 
			}elseif($AR_GV['photo']=="" && $AR_GV['gender']=="F"){ 
				$fldvMemPhoto= BASE_PATH."assets/images/female.jpg"; 
			}elseif($AR_GV['photo']!=''){
				$fldvMemPhoto = BASE_PATH."upload/member/".$AR_GV['photo']; 
			}else{
				$fldvMemPhoto = BASE_PATH."assets/images/photo.jpg"; 
			}
			$AR_TYPE  = $this->getCurrentMemberShip($member_id);
			$pain_name = ($AR_TYPE['pin_name'])? $AR_TYPE['pin_name']:"Free";
			$date_from = InsertDate($AR_TYPE['date_from']);
			$date_expire = InsertDate($AR_TYPE['date_expire']);
			
			$Message ="<table width=400 border=0 cellspacing=3 cellpadding=1><tr><td valign=top>Sponsor Id:</td><td valign=top>".$AR_GV['spsr_user_id']."</td></tr><tr><td width=100 valign=top>Member Id:</td><td colspan=2>".$AR_GV['user_id']."</td></tr><tr><td width=100 valign=top>Name:</td><td colspan=2>".$AR_GV['first_name']."</td></tr><tr><td valign=top>Type:</td><td colspan=2 valign=top>".$pain_name."</td></tr><tr><td valign=top>Active Date: </td><td colspan=2 valign=top>".$date_from."</td></tr><tr><td valign=top>Left Paid Id:</td><td colspan=2 valign=top>".number_format($LeftPaidCount)."</td></tr><tr><td valign=top>Right Paid Id :</td><td colspan=2 valign=top>".number_format($RightPaidCount)."</td><td width=210 rowspan=5 valign=top align=left><img src=".$fldvMemPhoto." width=75 height=92 /></td></tr><tr><td valign=top>Direct Count:</td><td width=113 valign=top>".$fldiDirects."</td></tr><tr><td valign=top>Left Count:</td><td valign=top>".$fldiLeftCtrl."</td></tr><tr><td valign=top>Right Count:</td><td valign=top>".$fldiRightCtrl."</td></tr><tr><td valign=top>Total Paid Id :</td><td valign=top>".($LeftPaidCount+$RightPaidCount)."</td></tr></table>";
			echo '<table border="0" cellpadding="0" cellspacing="0" align=center><tr><td align=center>';
			
			$border_color = ($AR_TYPE['avtar']!='')? $AR_TYPE['avtar']:"default_pic";
			
			$ImgSrc = BASE_PATH."assets/images/red_m.png";
			
			$fldvImageArr = @getimagesize($ImgSrc);
			if($fldvImageArr['mime']=="" && $AR_GV['photo']=="") { 
			//	$ImgSrc = BASE_PATH."assets/images/cm-advisor-nopic.jpg";
			$ImgSrc = BASE_PATH."assets/images/red_m.png";
			    
			    
			}	
// 		if($AR_TYPE['pin_name'] =='FREE' )
// 		  {
		  
//     		  $src =BASE_PATH.'assets/images/green1.png';
//     	  }
// 		  else{
// 		     //$col = 'color: red;';
// 		     $src =BASE_PATH.'assets/images/red1.png';
// 		  }
		  
		  
		  
		  
		  		if($pain_name == 'FREE')
		  {
		   //   $col = 'color: red;';
		    $src =BASE_PATH.'assets/images/yellow1.png';
		  } 
 elseif($pain_name   !='Free' )
		  {
    	  //	 $col = 'color: green;';
    		  $src =BASE_PATH.'assets/images/green1.png';
    	  }
		  else{
		     //$col = 'color: red;';
		     $src =BASE_PATH.'assets/images/yellow1.png';
		  }
		  
		  
		  
		
		//	$ImgSrc ="<i class='fa fa-user fa-4x' aria-hidden='true' style='".$col."' border=0 onMouseover=\"Tip('".$Message."', SHADOW, true, TITLE, 'Statistics', PADDING, 2)\" onclick='moveTree(\""._e($member_id)."\")' class='pointer img-circle' width=60 height=60></i>"; 
			$ImgSrc ="<img  src='".$src."' border=0 onMouseover=\"Tip('".$Message."', SHADOW, true, TITLE, 'Statistics', PADDING, 2)\" onclick='moveTree(\""._e($member_id)."\")' class='pointer img-circle' width=60 height=60>"; 
			echo "<div class=''>".$ImgSrc."</div>";
			echo '</td></tr><tr><td align=center><a class="'.$CssCls.'" style="text-decoration:underline;cursor:pointer" onclick="moveTree(\''._e($member_id).'\')"></a></td></tr><tr><td align=center><font class="'.$CssCls.'">'.$AR_GV['user_name'].'<br /> '.$AR_GV['full_name'].' </font></td></tr>';
			
			if($left_right==""){
				echo '<tr><td align=center class="bluetext">'.
					  "<b>Total Left User: ".number_format($fldiLeftCtrl,0,"","").
					  "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;".
					  "Total Right User: ".number_format($fldiRightCtrl,0,"","").
					  "</b></td></tr>";
			}
			echo '</table>';
		    }else{
			echo '<table border="0" cellpadding="0" cellspacing="0"><tr><td align="center">';
			if($fldiSpLId!=""){
		//		echo '<i class="fa fa-user fa-4x" aria-hidden="true" style="color: gray;"></i>';
	 $src =BASE_PATH.'assets/images/black1.png';
			   echo  '<img  src="'.$src.'"  border=0   width=60 height=60>';		
			}
			else{ 
			     $src =BASE_PATH.'assets/images/black1.png';
			   echo  '<img  src="'.$src.'"  border=0   width=60 height=60>';	
			$ImgSrc = BASE_PATH."assets/images/black1.png";
			if($spil_id !='')
			{
			
			// echo '<i class="fa fa-user fa-4x" aria-hidden="true" style="color: black;"></i>'; 
			}
			else
			{
			    
			// echo '<i class="fa fa-user fa-4x" aria-hidden="true" style="color:black;"></i></span>'; 
			}
			}
			echo '</td></tr></table>';
		}
	}	
	function getVisitorCount($from_date='',$to_date=''){
		if($from_date!='' && $to_date!=''){
			$StrWhr .=" AND DATE(date_time) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
		}
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_visitor WHERE 1 $StrWhr;";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}
	
	function addVisitor(){
		$visitor_ip = $_SERVER['REMOTE_ADDR'];
		$date_time = InsertDate(getLocalTime());
		
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_visitor WHERE visitor_ip='".$visitor_ip."' AND DATE(date_time)='".$date_time."';";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		if($AR_GET['fldiCtrl']==0){	
		
			$data = array("visitor_ip"=>$visitor_ip);
			$this->SqlModel->insertRecord(prefix."tbl_visitor",$data);
		}

	}
	
	function getMemberCount($from_date='',$to_date=''){
		if($from_date!='' && $to_date!=''){
			$StrWhr .=" AND DATE(date_join) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
		}
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE 1 $StrWhr;";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}
	
	function getMemberPaidCount($from_date='',$to_date=''){
		if($from_date!='' && $to_date!=''){
			$StrWhr .=" AND DATE(date_join) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
		}
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE    type_id>0 and member_id in (SELECT member_id from tbl_subscription) $StrWhr;";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}
	
		function getMemberPaidCountYester($from_date='',$to_date=''){
		if($from_date!='' && $to_date!=''){
			$StrWhr .="  DATE(date_from) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
		}
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE    type_id>0 and member_id in (SELECT member_id from tbl_subscription where $StrWhr) ;";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}
	
	function getMemberCountPackage($package_id){
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE package_id='$package_id' $StrWhr;";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}
	function countMemberCollection($member_id,$left_right,$start_date,$end_date){
			if($start_date!='' && $end_date!=''){
				$StrWhr .= " AND DATE(ts.date_from) BETWEEN '".$start_date."' AND '".$end_date."'";
			}elseif($end_date!=''){
				$StrWhr .= " AND DATE(ts.date_from) <= '".$end_date."'";
			}
			
			if($left_right!=""){
				$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='".$left_right."';";
			}else{
				$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE member_id='".$member_id."';";
			}
			$AR_COL = $this->SqlModel->runQuery($QR_COL,true);
			$nleft = $AR_COL["nleft"];
			$nright = $AR_COL["nright"];
			
			$Q_CTRL = "SELECT SUM(ts.prod_pv) AS net_amount 
					  FROM ".prefix."tbl_subscription AS ts
					  LEFT JOIN ".prefix."tbl_members AS tm ON  tm.member_id=ts.member_id
					  LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tree.member_id=tm.member_id
					 WHERE ts.subcription_id =(SELECT MAX(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
					 AND tree.nleft BETWEEN '".$nleft."'  AND '".$nright."' AND tm.member_id!='".$member_id."' 
					 $StrWhr AND tm.delete_sts>0";
			$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
			return $A_CTRL['net_amount'];
			
	}
	
	function getPackage($type_id){
		$QR_GET = "SELECT tp.* FROM ".prefix."tbl_pintype AS tp WHERE tp.type_id='$type_id';";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET;
	}
		function getPackagebyid($type_id,$member_id){
		$QR_GET = "SELECT prod_pv FROM ".prefix."tbl_subscription AS tp WHERE tp.type_id='$type_id' and tp.member_id='$member_id';";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['prod_pv'];
	}
	
		function getRePackage($type_id){
		$QR_GET = "SELECT tp.* FROM ".prefix."tbl_retopup_pin AS tp WHERE tp.type_id='$type_id';";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET;
	}
	
	
	function getMemberCountPinType($type_id){
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE type_id='$type_id' and    member_id in (SELECT member_id from tbl_subscription) ";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}
	
	function getSponsorSpill($member_id,$left_right){
		$Q_SPR = "SELECT tm.member_id FROM ".prefix."tbl_members AS tm WHERE tm.member_id='".$member_id."'";
		$A_SPR = $this->SqlModel->runQuery($Q_SPR,true);
		if($A_SPR['member_id']>0 && ($left_right=='L' || $left_right=="R")){
			$spil_id = $this->ExtrmLftRgt($A_SPR['member_id'],$left_right);
			$AR_RT['spil_id'] = $spil_id;
			$AR_RT['sponsor_id'] = $A_SPR['member_id'];
			return $AR_RT;
			
		}
	}
		function getSponsorSpillnew($member_id,$left_right){
		$Q_SPR = "SELECT tm.id FROM ".prefix."dummydata AS tm WHERE tm.id='".$member_id."'";
		$A_SPR = $this->SqlModel->runQuery($Q_SPR,true);
		if($A_SPR['id']>0 && ($left_right=='L' || $left_right=="R")){
			$spil_id = $this->ExtrmLftRgt($A_SPR['id'],$left_right);
			$AR_RT['spil_id'] = $spil_id;
			$AR_RT['sponsor_id'] = $A_SPR['id'];
			return $AR_RT;
			
		}
	}
	function display_downline_direct_member($id_parent,$selectval,$nlevel){
		$QR_LEVEL = "SELECT tm.* FROM  tbl_members AS tm LEFT JOIN tbl_mem_tree AS tree ON tm.member_id=tree.member_id WHERE 
		tm.sponsor_id='".$id_parent."' AND tm.delete_sts>0";
		$RS_LEVEL = $this->db->query($QR_LEVEL);
		$AR_LEVELS = $RS_LEVEL->result_array();
		foreach($AR_LEVELS as $AR_LEVEL):
		
			$fldiLeftCtrl = $this->BinaryCount($AR_LEVEL['member_id'], "LeftCountDirect");  
			$fldiRightCtrl = $this->BinaryCount($AR_LEVEL['member_id'], "RightCountDirect");
			
			$QR_CHILD = "SELECT tm.* FROM  tbl_members AS tm LEFT JOIN tbl_mem_tree AS tree ON tm.member_id=tree.member_id WHERE 
			tm.sponsor_id='".$AR_LEVEL['member_id']."' AND tm.delete_sts>0";
			$RS_CHILD = $this->db->query($QR_CHILD);
			$AR_CHILDS = $RS_CHILD->result_array();
			echo '<li ><a href="'.ADMIN_PATH.'member/tree?member_id='._e($AR_LEVEL['member_id']).'">'.$AR_LEVEL['first_name']." ".$AR_LEVEL['last_name'].'
			&nbsp;[L:&nbsp;'.$fldiLeftCtrl.'&nbsp;,&nbsp;R:&nbsp;'.$fldiRightCtrl.']</a>';
			echo '<ul>';
						foreach($AR_CHILDS as $AR_CHILD):
						
							$fldiLeftCtrl = $this->BinaryCount($AR_CHILD['member_id'], "LeftCountDirect");  
							$fldiRightCtrl = $this->BinaryCount($AR_CHILD['member_id'], "RightCountDirect");
			
							echo '<li ><a href="'.ADMIN_PATH.'member/tree?member_id='._e($AR_CHILD['member_id']).'">'.$AR_CHILD['first_name']." ".$AR_CHILD['last_name'].'
			&nbsp;[L:&nbsp;'.$fldiLeftCtrl.'&nbsp;,&nbsp;R:&nbsp;'.$fldiRightCtrl.']</a>';
							$this->display_downline_direct_member($AR_CHILD['member_id'],$selectval,$nlevel+1);
							echo '<li>';
							unset($fldiLeftCtrl,$fldiRightCtrl);
						endforeach;
             echo  '</ul>';
			echo '<li>';
			unset($fldiLeftCtrl,$fldiRightCtrl);
		endforeach;
		
	}
	
	function display_downline_unilevel($id_parent,$selectval,$nlevel=''){
		$QR_LEVEL = "SELECT tm.* FROM  tbl_members AS tm LEFT JOIN tbl_mem_tree AS tree ON tm.member_id=tree.member_id WHERE 
		tm.sponsor_id='".$id_parent."' AND tm.delete_sts>0";
		$RS_LEVEL = $this->db->query($QR_LEVEL);
		$AR_LEVELS = $RS_LEVEL->result_array();
		foreach($AR_LEVELS as $AR_LEVEL):
		
			$fldiLeftCtrl = $this->BinaryCount($AR_LEVEL['member_id'], "LeftCountDirect");  
			$fldiRightCtrl = $this->BinaryCount($AR_LEVEL['member_id'], "RightCountDirect");
			
			$QR_CHILD = "SELECT tm.* FROM  tbl_members AS tm LEFT JOIN tbl_mem_tree AS tree ON tm.member_id=tree.member_id WHERE 
			tm.sponsor_id='".$AR_LEVEL['member_id']."' AND tm.delete_sts>0";
			$RS_CHILD = $this->db->query($QR_CHILD);
			$AR_CHILDS = $RS_CHILD->result_array();
			echo '<li ><a href="javascript:void(0)">'.$AR_LEVEL['first_name']." ".$AR_LEVEL['last_name'].'
			&nbsp;[L:&nbsp;'.$fldiLeftCtrl.'&nbsp;,&nbsp;R:&nbsp;'.$fldiRightCtrl.']</a>';
			echo '<ul>';
						foreach($AR_CHILDS as $AR_CHILD):
						
							$fldiLeftCtrl = $this->BinaryCount($AR_CHILD['member_id'], "LeftCountDirect");  
							$fldiRightCtrl = $this->BinaryCount($AR_CHILD['member_id'], "RightCountDirect");
			
							echo '<li ><a href="javascript:void(0)">'.$AR_CHILD['first_name']." ".$AR_CHILD['last_name'].'
			&nbsp;[L:&nbsp;'.$fldiLeftCtrl.'&nbsp;,&nbsp;R:&nbsp;'.$fldiRightCtrl.']</a>';
							$this->display_downline_direct_member($AR_CHILD['member_id'],$selectval,$nlevel+1);
							echo '<li>';
							unset($fldiLeftCtrl,$fldiRightCtrl);
						endforeach;
             echo  '</ul>';
			echo '<li>';
			unset($fldiLeftCtrl,$fldiRightCtrl);
		endforeach;
		
	}
	
	function getWalletTrns($trns_type,$member_id='',$where_clause){
		if($trns_type!=''){
			$StrWhr .=($where_clause!='')? " AND $where_clause":"";
			$StrWhr .= ($member_id>0)? " AND member_id='".$member_id."'":"";
			$QR_WALLET = "SELECT SUM(trns_amount) AS total_amount  FROM tbl_wallet_trns WHERE trns_type='".$trns_type."' $StrWhr 
			ORDER BY wallet_trns_id DESC";
			$RS_WALLET = $this->db->query($QR_WALLET);
			$AR_WALLET = $RS_WALLET->row_array();
			return $AR_WALLET['total_amount'];
		}
	}
	
	function getValueConfig($fldvFiled){
		$member_id = $this->session->userdata('mem_id');
		$QR_CONFIG="SELECT value FROM ".prefix."tbl_mem_config WHERE name='".$fldvFiled."' AND member_id='".$member_id."'  LIMIT 1";
		$RS_CONFIG = $this->db->query($QR_CONFIG);
		$AR_CONFIG = $RS_CONFIG->row_array();
		if(is_numeric($AR_CONFIG['value'])){
			$returnVar = ($AR_CONFIG['value']==NULL)? "0":$AR_CONFIG['value'];	
		}else{
			$returnVar = ($AR_CONFIG['value']==NULL)? "":$AR_CONFIG['value'];
		}
		return $returnVar;
	}
	
	function getAllConfig($fldvFiled){	
		$member_id = $this->session->userdata('mem_id');
		$QR_CONFIG="SELECT * FROM ".prefix."tbl_mem_config WHERE name='".$fldvFiled."' AND member_id='".$member_id."' LIMIT 1";
		$RS_CONFIG = $this->db->query($QR_CONFIG);
		$AR_CONFIG = $RS_CONFIG->row_array();
		return $AR_CONFIG;
	}
	
	function updateConfigMember($fldvFields,$whereClause){
		$this->db->query("UPDATE ".prefix."tbl_mem_config SET $fldvFields WHERE $whereClause");
	}
	
	function setConfigMember($fldvFields,$fldvValue){
		$member_id = $this->session->userdata('mem_id');
		$date_upd = $date_upd = getLocalTime();
		$QR_CONFIG="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_mem_config WHERE member_id='".$member_id."' AND name LIKE '$fldvFields'  LIMIT 1";
		$RS_CONFIG = $this->db->query($QR_CONFIG);
		$AR_CONFIG = $RS_CONFIG->row_array();
		if($AR_CONFIG['fldiCtrl']>0){
			$this->db->query("UPDATE ".prefix."tbl_mem_config SET value='$fldvValue', date_upd='$date_upd' WHERE name='$fldvFields' 
			AND member_id='".$member_id."'");
		}else{
			$this->db->query("INSERT INTO  ".prefix."tbl_mem_config SET value='$fldvValue' , member_id='".$member_id."', 
			name='$fldvFields', date_add='$date_add', 	date_upd='$date_upd'");
		}
	}
	
	function getConfigMember($wherclause){	
		$member_id = $this->session->userdata('mem_id');
		$StrWhr .=($wherclause!="")? "AND $wherclause":"AND id_config<0";
		$QR_CONFIG="SELECT value FROM ".prefix."tbl_mem_config WHERE member_id='".$member_id."'  $StrWhr  LIMIT 1";
		$RS_CONFIG = $this->db->query($QR_CONFIG);
		$AR_CONFIG = $RS_CONFIG->row_array();
		$returnVar = ($AR_CONFIG['value']==NULL)? "0":$AR_CONFIG['value'];
		return $returnVar;
	}
	
	function getAllMemberConfig($member_id){
		$QR_CONFIG="SELECT name,value FROM ".prefix."tbl_mem_config WHERE member_id='".$member_id."'  $StrWhr  LIMIT 1";
		$RS_CONFIG = $this->db->query($QR_CONFIG);
		$AR_CONFIGS = $RS_CONFIG->result_array();
		$AR_RT = array();
		foreach($AR_CONFIGS as $AR_CONFIG){
			$AR_RT[$AR_CONFIG['name']]=$AR_CONFIG['value'];
		}
		return $AR_RT;
	}
	
	function getReferrerCount($member_id,$from_date='',$to_date=''){
		if($from_date!='' && $to_date!=''){
			$StrWhr .=" AND DATE(date_join) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
		}
		$QR_GET = "SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE sponsor_id='".$member_id."' $StrWhr;";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['fldiCtrl'];
	}
	
	function getCurrentBalance($member_id,$wallet_id,$from_date='',$to_date=''){	
		if($from_date!='' && $to_date!=''){
			$StrWhr .=" AND DATE(trns_date) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
		}
		$QR_TRNS_CR = "SELECT SUM(trns_amount) AS total_amount_cr  
					   FROM tbl_wallet_trns WHERE trns_type LIKE 'Cr' AND  member_id='".$member_id."'
					   AND wallet_id IN(".$wallet_id.") $StrWhr ORDER BY wallet_trns_id DESC";
		$RS_TRNS_CR = $this->db->query($QR_TRNS_CR);
		$AR_TRNS_CR = $RS_TRNS_CR->row_array();
		$total_amount_cr = $AR_TRNS_CR['total_amount_cr'];

		$QR_TRNS_DR = "SELECT SUM(trns_amount) AS total_amount_dr  
					   FROM tbl_wallet_trns WHERE trns_type LIKE 'Dr' AND  member_id='".$member_id."'
					   AND wallet_id IN(".$wallet_id.")	$StrWhr ORDER BY wallet_trns_id DESC";
		$RS_TRNS_DR = $this->db->query($QR_TRNS_DR);
		$AR_TRNS_DR = $RS_TRNS_DR->row_array();
		$total_amount_dr = $AR_TRNS_DR['total_amount_dr'];
		
		$net_balance = $total_amount_cr-$total_amount_dr;
		
		$AR_RT['total_amount_cr']=$total_amount_cr;
		$AR_RT['total_amount_dr']=$total_amount_dr;
		$AR_RT['net_balance']=$net_balance;
		
		return $AR_RT;
	}
		function getCurrentBalancewal($member_id,$wallet_id,$from_date='',$to_date=''){	
		if($from_date!='' && $to_date!=''){
			$StrWhr .=" AND DATE(trns_date) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
		}
		$QR_TRNS_CR = "SELECT SUM(trns_amount) AS total_amount_cr  
					   FROM tbl_wallet_trns WHERE trns_type LIKE 'Cr' AND  member_id='".$member_id."'
					   AND wallet_id IN(".$wallet_id.") $StrWhr ORDER BY wallet_trns_id DESC";
		$RS_TRNS_CR = $this->db->query($QR_TRNS_CR);
		$AR_TRNS_CR = $RS_TRNS_CR->row_array();
		$total_amount_cr = $AR_TRNS_CR['total_amount_cr'];

		$QR_TRNS_DR = "SELECT SUM(trns_amount) AS total_amount_dr  
					   FROM tbl_wallet_trns WHERE trns_type LIKE 'Dr' AND  member_id='".$member_id."'
					   AND wallet_id IN(".$wallet_id.")	$StrWhr ORDER BY wallet_trns_id DESC";
		$RS_TRNS_DR = $this->db->query($QR_TRNS_DR);
		$AR_TRNS_DR = $RS_TRNS_DR->row_array();
		$total_amount_dr = $AR_TRNS_DR['total_amount_dr'];
		
		$net_balance = $total_amount_cr-$total_amount_dr;
		
		$AR_RT['total_amount_cr']=$total_amount_cr;
		$AR_RT['total_amount_dr']=$total_amount_dr;
		$AR_RT['net_balance']=$net_balance;
		
		return $AR_RT;
	}
	
	function gettotalbinarypairincome($member_id){	
	
		$QR_TRNS_CR = "SELECT SUM(amount) AS total_binary  
					   FROM tbl_cmsn_binary WHERE   member_id='".$member_id."'
					   ORDER BY binary_id DESC";
		$RS_TRNS_CR = $this->db->query($QR_TRNS_CR);
		$AR_TRNS_CR = $RS_TRNS_CR->row_array();
		$total_amount_cr = $AR_TRNS_CR['total_binary'];

	
		
		return $total_amount_cr;
	}
	
	function gettotalbinaryincome($member_id){	
	
		$QR_TRNS_CR = "SELECT SUM(net_cmsn) AS total_binary  
					   FROM tbl_cmsn_binary WHERE   member_id='".$member_id."'
					   ORDER BY binary_id DESC";
		$RS_TRNS_CR = $this->db->query($QR_TRNS_CR);
		$AR_TRNS_CR = $RS_TRNS_CR->row_array();
		$total_amount_cr = $AR_TRNS_CR['total_binary'];

	
		
		return $total_amount_cr;
	}
	
		function gettotalbinarymatchincome($member_id){	
	
		$QR_TRNS_CR = "SELECT SUM(pair_match) AS total_binary  
					   FROM tbl_cmsn_binary WHERE   member_id='".$member_id."'
					   ORDER BY binary_id DESC";
		$RS_TRNS_CR = $this->db->query($QR_TRNS_CR);
		$AR_TRNS_CR = $RS_TRNS_CR->row_array();
		$total_amount_cr = $AR_TRNS_CR['total_binary'];

	
		
		return $total_amount_cr;
	}
	
	
	function getWalletBalance($member_id,$trns_for,$from_date='',$to_date=''){	
		if($from_date!='' && $to_date!=''){
			$StrWhr .=" AND DATE(trns_date) BETWEEN '".InsertDate($from_date)."' AND '".InsertDate($to_date)."'";
		}
		$QR_TRNS_CR = "SELECT SUM(trns_amount) AS total_amount_cr  FROM tbl_wallet_trns WHERE trns_type LIKE 'Cr' AND  member_id='".$member_id."'
		AND trns_for='".$trns_for."' $StrWhr ORDER BY wallet_trns_id DESC";
		$RS_TRNS_CR = $this->db->query($QR_TRNS_CR);
		$AR_TRNS_CR = $RS_TRNS_CR->row_array();
		$total_amount_cr = $AR_TRNS_CR['total_amount_cr'];
		
		$QR_TRNS_DR = "SELECT SUM(trns_amount) AS total_amount_dr  FROM tbl_wallet_trns WHERE trns_type LIKE 'Dr' AND  member_id='".$member_id."'
		AND trns_for='".$trns_for."'	$StrWhr ORDER BY wallet_trns_id DESC";
		$RS_TRNS_DR = $this->db->query($QR_TRNS_DR);
		$AR_TRNS_DR = $RS_TRNS_DR->row_array();
		$total_amount_dr = $AR_TRNS_DR['total_amount_dr'];
		
		$net_balance = $total_amount_cr-$total_amount_dr;
		
		$AR_RT['total_amount_cr']=$total_amount_cr;
		$AR_RT['total_amount_dr']=$total_amount_dr;
		$AR_RT['net_balance']=$net_balance;
		
		return $AR_RT;
	}
	
	function wallet_combo($member_id){
		$db = new SqlModel();
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_wallet WHERE 1 ORDER BY wallet_name ASC"; 
		$rowSets = $db->runQuery($QR_SELECT);
		foreach($rowSets as $rowSet):
			$LDGR = $this->getCurrentBalance($member_id,$rowSet['wallet_id'],"","");
			echo "<option value='".$rowSet['wallet_id']."'";if($SlctVal == $rowSet['wallet_id']){echo "selected";}
			echo ">".$rowSet['wallet_name']."&nbsp;(".$LDGR['net_balance'].")"."</option>";
		endforeach;
	}
	
	function getDepositWallet($wallet_name){
		$QR_GET = "SELECT wallet_id FROM ".prefix."tbl_wallet AS tw WHERE tw.wallet_name LIKE '".$wallet_name."';";
		$RS_GET = $this->db->query($QR_GET);
		$AR_GET = $RS_GET->row_array();
		return $AR_GET['wallet_id'];
	}
	
	function getAvailableAds($member_id){
		$QR_TRNS_CR = "SELECT SUM(ad_credit) AS ad_credit_cr  FROM ".prefix."tbl_ad_credit_trns WHERE ad_type LIKE 'Cr' AND  member_id='".$member_id."'
		 ORDER BY ad_trns_id DESC";
		$RS_TRNS_CR = $this->db->query($QR_TRNS_CR);
		$AR_TRNS_CR = $RS_TRNS_CR->row_array();
		$ad_credit_cr = $AR_TRNS_CR['ad_credit_cr'];
		
		$QR_TRNS_DR = "SELECT SUM(ad_credit) AS ad_credit_dr  FROM ".prefix."tbl_ad_credit_trns WHERE ad_type LIKE 'Dr' AND  member_id='".$member_id."'
		 ORDER BY ad_trns_id DESC";
		$RS_TRNS_DR = $this->db->query($QR_TRNS_DR);
		$AR_TRNS_DR = $RS_TRNS_DR->row_array();
		$ad_credit_dr = $AR_TRNS_CR['ad_credit_dr'];
		
		$ad_credit_bal = $ad_credit_cr-$ad_credit_dr;
		
		$AR_RT['ad_credit_cr']=$ad_credit_cr;
		$AR_RT['ad_credit_dr']=$ad_credit_dr;
		$AR_RT['ad_credit_bal']=$ad_credit_bal;
		
		return $AR_RT;
	}
	
	
	function kycDocument($kyc_id){
		$Q_CHK ="SELECT file_name FROM ".prefix."tbl_mem_kyc WHERE kyc_id='$kyc_id';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		if($AR_CHK['file_name']!=''){
			return BASE_PATH."upload/kyc/".$AR_CHK['file_name'];
		}else{
			return "javascript:void(0)";
		}
	}
	    
        function getTrnscharge($amount) {
	$Q_CTRL = " SELECT * FROM `tbl_set_cmsn` WHERE '$amount' between `f_amount` and `t_amount` ";
	$R_CTRL = $this->db->query($Q_CTRL);
    $A_CTRL = $R_CTRL->row_array();
	return $A_CTRL;   
	}
     
    function getTotdayTransfer($member_id,$date)
    {
     $QR_SELECT = "SELECT COUNT(*) as total  FROM `tbl_money_transfer` WHERE member_id ='$member_id' AND date(`date`) = date('$date') AND `status` = 'Success'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();		
		return $AR_SELECT['total'];   
    }
	function memberKycDoucment($member_id,$file_type){
		$Q_CHK ="SELECT * FROM ".prefix."tbl_mem_kyc WHERE member_id='".$member_id."' AND file_type='".$file_type."' ORDER BY kyc_id DESC LIMIT 1;";
		$AR_CHK = $this->SqlModel->runQuery($Q_CHK,true);
		return $AR_CHK;
	}
	
	function getMemberWithdrawal($member_id){
		$QR_TRNS = "SELECT SUM(initial_amount) AS draw_amount  
					FROM ".prefix."tbl_fund_transfer WHERE 	trns_for LIKE 'WITHDRAW' 
					AND  to_member_id='".$member_id."' and draw_type !='DMT'  and trns_status ='C' ORDER BY transfer_id ASC";
		$RS_TRNS = $this->db->query($QR_TRNS);
		$AR_TRNS = $RS_TRNS->row_array();
		$draw_amount1 = $AR_TRNS['draw_amount'];
		
			$QR_TRNS = "SELECT SUM(initial_amount) AS draw_amount  
					FROM ".prefix."tbl_fund_transfer WHERE 	trns_for LIKE 'WITHDRAW' 
					AND  to_member_id='".$member_id."' and  draw_type ='DMT' and trns_status ='C' ORDER BY transfer_id ASC";
		$RS_TRNS = $this->db->query($QR_TRNS);
		$AR_TRNS = $RS_TRNS->row_array();
		$draw_amount2= $AR_TRNS['draw_amount'];
		
		
		
		
		
		return $draw_amount1 + $draw_amount2;
	}
		function getMemberminingWithdrawal($member_id){
		$QR_TRNS = "SELECT SUM(initial_amount) AS draw_amount  
					FROM ".prefix."tbl_fund_transfer WHERE 	trns_for LIKE 'MININGWITHDRAW' 
					AND  to_member_id='".$member_id."' and draw_type !='DMT'  and trns_status ='C' ORDER BY transfer_id ASC";
		$RS_TRNS = $this->db->query($QR_TRNS);
		$AR_TRNS = $RS_TRNS->row_array();
		$draw_amount1 = $AR_TRNS['draw_amount'];
		
			$QR_TRNS = "SELECT SUM(initial_amount) AS draw_amount  
					FROM ".prefix."tbl_fund_transfer WHERE 	trns_for LIKE 'MININGWITHDRAW' 
					AND  to_member_id='".$member_id."' and  draw_type ='DMT' and trns_status ='C' ORDER BY transfer_id ASC";
		$RS_TRNS = $this->db->query($QR_TRNS);
		$AR_TRNS = $RS_TRNS->row_array();
		$draw_amount2= $AR_TRNS['draw_amount'];
		
		
		
		
		
		return $draw_amount1 + $draw_amount2;
	}
	function generatePinDetail($mstr_id){
		if($mstr_id>0){
			$QR_MSTR = "SELECT tpm.*, tpy.pin_name, tpy.pin_letter, tm.user_id FROM ".prefix."tbl_pinsmaster AS tpm 
			LEFT  JOIN ".prefix."tbl_pintype AS tpy ON tpm.type_id=tpy.type_id
			LEFT JOIN ".prefix."tbl_members AS tm ON tpm.member_id=tm.member_id
			WHERE tpm.mstr_id='$mstr_id' ORDER BY tpm.mstr_id DESC";
			$RS_MSTR = $this->db->query($QR_MSTR);
			$AR_MSTR = $RS_MSTR->row_array();
			$no_pin = $AR_MSTR['no_pin'];
			$pin_letter = ($AR_MSTR['pin_letter'])? $AR_MSTR['pin_letter']:"EM";
			for($i=1; $i<=$no_pin; $i++):
				$data = array("type_id"=>$AR_MSTR['type_id'],
					"mstr_id"=>$AR_MSTR['mstr_id'],
					"pin_price"=>$AR_MSTR['pin_price'],
					"prod_pv"=>$AR_MSTR['prod_pv'],
					"transfer_by"=>$this->session->userdata('oprt_id'),
					"member_id"=>$AR_MSTR['member_id'],
					"pin_no"=>$this->getPinNo(),
					"pin_key"=>$this->getPinKey($pin_letter)
				);
				$this->SqlModel->insertRecord(prefix."tbl_pinsdetails",$data);
			endfor;
		}
	}
	
	
	function getPinNo(){
		$data = "123456789";
		for($i = 0; $i < 7; $i++){
			$pin_no .= substr($data, (rand()%(strlen($data))), 1);
		}
		$Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_pinsdetails WHERE pin_no='$pin_no';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		if($AR_CHK['fldiCtrl']==0){
			return $pin_no;
		}else{
			return $this->getPinNo();
		}
	}
	
	
	function getPinKey($pin_letter){
		$data = "123456789";
		for($i = 0; $i < 12; $i++){
			$pin_key_no .= substr($data, (rand()%(strlen($data))), 1);
		}
		$pin_key = $pin_letter.$pin_key_no;
		$Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_pinsdetails WHERE pin_key='$pin_key';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		if($AR_CHK['fldiCtrl']==0){
			return $pin_key;
		}else{
			return $this->getPinKey($pin_letter);
		}
	}
	
	
	function getOpenPlace($member_id){
		$AR_SPR = $this->getMember($member_id);
		$QR_OPEN = "SELECT A.member_id, A.nlevel, COUNT(B.member_id) AS fldiCtrl FROM ".prefix."tbl_mem_tree AS A 
					LEFT OUTER JOIN ".prefix."tbl_mem_tree AS B ON B.spil_id=A.member_id 
					WHERE A.nleft BETWEEN '$AR_SPR[nleft]' AND '$AR_SPR[nright]'    and  A.nleft  > '0'
					GROUP BY A.member_id HAVING fldiCtrl < 2 
					ORDER BY fldiCtrl DESC, A.nlevel ASC, A.member_id ASC LIMIT 1;";
		$AR_DOWNL = $this->SqlModel->runQuery($QR_OPEN,true);
		$leftCtrl = $this->CheckOpenPlace($AR_DOWNL['member_id'],"L");
		$rightCtrl = $this->CheckOpenPlace($AR_DOWNL['member_id'],"R");
		if($rightCtrl==0){
			$AR_RT['left_right']="R";
		}
		if($leftCtrl==0){
			$AR_RT['left_right']="L";
		}
		$AR_RT['sponsor_id']=$AR_SPR['member_id'];
		$AR_RT['spil_id']=$AR_DOWNL['member_id'];
		return $AR_RT;
		
	}
	
	function sendTransactionSMS($mobile_number){
		if(is_numeric($mobile_number)){
			$sms_otp = UniqueId("SMS_OTP");
			$website = $this->getValue("CONFIG_WEBSITE");
			$message = "Hello, ".$sms_otp." is your OTP for change of  transaction password, info: ".$website."";
			Send_Single_SMS($mobile_number,$message);
			return $sms_otp;
		}
	}
	
	function sendEpinRequestSMS($mobile_number){
		if(is_numeric($mobile_number)){
			$sms_otp = UniqueId("SMS_OTP");
			$website = $this->getValue("CONFIG_WEBSITE");
			$message = "Hello, ".$sms_otp." is your OTP for E-pin purchase, info: ".$website."";
			Send_Single_SMS($mobile_number,$message);
			return $sms_otp;
		}
	}
	
	function sendFundtransferRequestSMS($mobile_number,$amount){
		if(is_numeric($mobile_number)){
			$sms_otp = UniqueId("SMS_OTP");
			$website = $this->getValue("CONFIG_WEBSITE");
			$message = "Hello, ".$sms_otp." is your OTP for fund transfer of ".$amount.", info: ".$website."";
			Send_Single_SMS($mobile_number,$message);
			return $sms_otp;
		}
	}
	
	function sendFundtransferRequestSMSAdmin($mobile_number,$email_address,$amount){
		if(is_numeric($mobile_number)){
			$sms_otp = UniqueId("SMS_OTP");
			$website = $this->getValue("CONFIG_WEBSITE");
			$message = "Hello, ".$sms_otp." is your OTP for fund transfer of ".$amount.", info: ".$website."";
			Send_Single_SMS_Admin($mobile_number,$email_address,$message);
			return $sms_otp;
		}
	}
	
	function sendWithdrawalSMS($mobile_number,$trans_amount){
		if(is_numeric($mobile_number)){
			$sms_otp = UniqueId("SMS_OTP");
			$website = $this->getValue("CONFIG_WEBSITE");
			$message = "Hello, ".$sms_otp." is your OTP for your withdrawal request amount $ ".$trans_amount.", info: ".$website."";
			Send_Single_SMS($mobile_number,$message);
			return $sms_otp;
		}
	}
	
	function sendMobileVerifySMS($mobile_number){
		if(is_numeric($mobile_number)){
			$sms_otp = UniqueId("SMS_OTP");
			$website = $this->getValue("CONFIG_WEBSITE");
			$message = "Hello, ".$sms_otp." is your mobile verifcation code, info: ".$website."";
			Send_Single_SMS($mobile_number,$message);
			return $sms_otp;
		}
	}
	
	function sendEmailSMS($mobile_number){
		if(is_numeric($mobile_number)){
			$sms_otp = UniqueId("SMS_OTP");
			$website = $this->getValue("CONFIG_WEBSITE");
			$message = "Hello, ".$sms_otp." is your OTP for change of  email address, info: ".$website."";
			Send_Single_SMS($mobile_number,$message);
			return $sms_otp;
		}
	}
	
	function sendPasswordSMS($mobile_number){
		if(is_numeric($mobile_number)){
			$sms_otp = UniqueId("SMS_OTP");
			$website = $this->getValue("CONFIG_WEBSITE");
			$message = "Hello, ".$sms_otp." is your OTP for change of  password, info: ".$website."";
			Send_Single_SMS($mobile_number,$message);
			return $sms_otp;
		}
	}
	
	function sendTransPasswordSMS($mobile_number){
		if(is_numeric($mobile_number)){
			$sms_otp = UniqueId("SMS_OTP");
			$website = $this->getValue("CONFIG_WEBSITE");
			$message = "Hello, ".$sms_otp." is your OTP for change of  transaction password, info: ".$website."";
			Send_Single_SMS($mobile_number,$message);
			return $sms_otp;
		}
	}
	
	function verifySMSOTP($request_id,$sms_otp){
		$Q_CHK ="SELECT * FROM ".prefix."tbl_sms_otp WHERE request_id='".$request_id."' AND sms_otp='".$sms_otp."';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		return $AR_CHK;
	}
	
	function getOpt($request_id){
		$Q_CHK ="SELECT * FROM ".prefix."tbl_sms_otp WHERE request_id='".$request_id."';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		return $AR_CHK['sms_otp'];
	}
	
	function getOptDetail($request_id){
		$Q_CHK ="SELECT * FROM ".prefix."tbl_sms_otp WHERE request_id='".$request_id."';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		return $AR_CHK;
	}
	
	function checkMemberSms($member_id,$sms_otp){
		$Q_CHK ="SELECT COUNT(request_id) AS row_count FROM ".prefix."tbl_sms_otp WHERE 
			member_id='".$member_id."' AND sms_otp='".$sms_otp."' AND sms_type LIKE 'MOBILE';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		return $AR_CHK['row_count'];
	}
	
	function getSMSOTP($request_id){
		$Q_CHK ="SELECT * FROM ".prefix."tbl_sms_otp WHERE request_id='".$request_id."';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		return $AR_CHK;
	}
	
	function updateOTPSts($request_id){
		if($request_id>0){
			$this->SqlModel->updateRecord(prefix."tbl_sms_otp",array("otp_sts"=>1),array("request_id"=>$request_id));
		}
	}
	
	function getEMAILOTP($email_rq_id){
		$Q_CHK ="SELECT * FROM ".prefix."tbl_email_otp WHERE email_rq_id='".$email_rq_id."';";
		$R_CHK = $this->db->query($Q_CHK);
		$AR_CHK = $R_CHK->row_array();
		return $AR_CHK;
	}
	
	function getMobileCode($country_code){
		$QR_SELECT = "SELECT phonecode FROM ".prefix."tbl_country WHERE country_code = '$country_code'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['phonecode'];
	}
	
	function getDailyReturn($type_id,$date_time){
		$QR_SELECT = "SELECT daily_return FROM ".prefix."tbl_daily_return WHERE type_id='".$type_id."' AND DATE(date_time)='".$date_time."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return ($AR_SELECT['daily_return']>0)? $AR_SELECT['daily_return']:0;
	}
	
	function getDailyReturnType($type_id){
		$QR_SELECT = "SELECT daily_return FROM ".prefix."tbl_daily_return WHERE type_id='".$type_id."'  ORDER BY daily_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return ($AR_SELECT['daily_return']>0)? $AR_SELECT['daily_return']:0;
	}
	
	function wallet_transaction($wallet_id,$trns_type,$member_id,$trns_amount,$trns_remark,$trns_date,$trans_ref_no='',$isactive='',$trns_for=''){
	
		$data = array("wallet_id"=>($wallet_id>0)? $wallet_id:0,
			"trns_type"=>$trns_type,
			"member_id"=>($member_id>0)? $member_id:0,
			"trns_amount"=>$trns_amount,
			"trns_remark"=>($trns_remark)? $trns_remark:' ',
			"isActive"=>($isactive==0)? 0:1,
			"trans_ref_no"=>($trans_ref_no)? $trans_ref_no:$member_id,
			"trns_for"=>($trns_for)? $trns_for:"NA",
			"trns_date"=>$trns_date,
		//	"date_time"=>$trns_date
		);
	
		if($trns_amount>0 && $member_id>0){
			$this->SqlModel->insertRecord(prefix."tbl_wallet_trns",$data);
		}
	}
	function ewallet_transaction($wallet_id,$trns_type,$member_id,$trns_amount,$trns_remark,$trns_date,$trans_ref_no='',$isactive='',$trns_for=''){
		$data = array("wallet_id"=>($wallet_id>0)? $wallet_id:0,
			"trns_type"=>$trns_type,
			"member_id"=>($member_id>0)? $member_id:0,
			"trns_amount"=>$trns_amount,
			"trns_remark"=>($trns_remark)? $trns_remark:' ',
			"isActive"=>($isactive==0)? 0:1,
			"trans_ref_no"=>($trans_ref_no)? $trans_ref_no:$member_id,
			"trns_for"=>($trns_for)? $trns_for:"NA",
			"trns_date"=>$trns_date
		);
		
		if($trns_amount>0 && $member_id>0){
			$this->SqlModel->insertRecord(prefix."tbl_ewallet_trns",$data);
		}
	}
	function dollar_to_btc($usd_price){
		$url = "https://bitpay.com/api/rates";
		$json = getHttpContent($url);
		$data = json_decode($json, TRUE);
		
		$rate = $data[1]["rate"];
		$bitcoin_price = round( $usd_price / $rate ,8);
		return $bitcoin_price;
	}
	
	function btc_to_dollar($btc){
		$url = "https://bitpay.com/api/rates";
		$json = file_get_contents($url);
		$data = json_decode($json, TRUE);
		$rate = $data[1]["rate"];
		$usd_price = round( $btc * $rate ,8);
		return $usd_price;
	}
	
	function getLastBinaryCmsn($member_id){
		$QR_SELECT = "SELECT amount FROM ".prefix."tbl_cmsn_binary WHERE member_id='".$member_id."' ORDER BY binary_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['amount'];
	}
	
	function getTotalBinaryCmsn($member_id){
		$QR_SELECT = "SELECT SUM(amount)  AS amount FROM ".prefix."tbl_cmsn_binary WHERE member_id='".$member_id."' ORDER BY binary_id ASC";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['amount'];
	}
	
	function getTotalDirectCmsn($member_id){
		$QR_SELECT = "SELECT SUM(net_income)  AS net_income FROM ".prefix."tbl_cmsn_direct WHERE member_id='".$member_id."' ORDER BY direct_id ASC";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['net_income'];
	}
	
	
	function getCurrentmonthIncome($member_id){
	    $month = date('m');
		$QR_PLAN = "SELECT SUM(amount)  AS net_income FROM `tbl_cmsn_binary` WHERE MONTH(`date_time`) ='".$month."' and member_id='".$member_id."' ";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		$getbal= ($AR_PLAN['net_income'])?$AR_PLAN['net_income']:0;
		return $getbal;
	}
	function getTotalMemberShipValue1($member_id){
		$QR_PLAN = "SELECT SUM(ts.package_price) as total    FROM   tbl_subscription AS ts  WHERE ts.member_id='".$member_id."'  ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
	function getTotalMemberShipValue($member_id){
		$QR_PLAN = "SELECT SUM(ts.package_price) as total    FROM   tbl_subscription AS ts  WHERE  ts.member_id='".$member_id."'  ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
	
	function getTotalMemberShipValuere($member_id){
		$QR_PLAN = "SELECT SUM(ts.package_price) as total    FROM   tbl_subscription_2 AS ts  WHERE    ts.member_id='".$member_id."' and retopup ='Y'  ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['total'];
	}
	function getCurrentMemberShip($member_id){
		$QR_PLAN = "SELECT ts.*, tp.pin_name, tp.type_id, tp.avtar 
					FROM   ".prefix."tbl_subscription AS ts
					LEFT JOIN  ".prefix."tbl_pintype AS tp  ON tp.type_id=ts.type_id 
					WHERE ts.subcription_id = (SELECT MAX(subcription_id) FROM tbl_subscription WHERE ts.subcription_id=subcription_id)
					AND ts.member_id='".$member_id."'  ORDER BY ts.subcription_id DESC LIMIT 1";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN;
	}
	function getInvestment($member_id){
		$QR_PLAN = "SELECT SUM(ts.net_amount) AS net_amount
		FROM  tbl_subscription AS  ts
		LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
		LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
		WHERE  tm.member_id='".$member_id."' AND tm.delete_sts>0";
		$AR_PLAN = $this->SqlModel->runQuery($QR_PLAN,true);
		return $AR_PLAN['net_amount'];
	}
	
	function getLastProcess(){
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_process WHERE pair_sts='N' ORDER BY process_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	function getMemberCollection($member_id,$left_right,$start_date,$end_date){
			if($start_date!='' && $end_date!=''){
				$StrWhr .= " AND DATE(ts.date_from) BETWEEN '".$start_date."' AND '".$end_date."'";
			}elseif($end_date!=''){
				$StrWhr .= " AND DATE(ts.date_from) <= '".$end_date."'";
			}
			
			if($left_right!=""){
				$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='".$left_right."';";
			}else{
				$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE member_id='".$member_id."';";
			}
			$AR_COL = $this->SqlModel->runQuery($QR_COL,true);
			$nleft = $AR_COL["nleft"];
			$nright = $AR_COL["nright"];
			
			$Q_CTRL = "SELECT SUM(ts.net_amount) AS net_amount 
					  FROM ".prefix."tbl_subscription AS ts
					  LEFT JOIN ".prefix."tbl_members AS tm ON  tm.member_id=ts.member_id
					  LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tree.member_id=tm.member_id
					 WHERE ts.subcription_id =(SELECT MAX(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
					 AND tree.nleft BETWEEN '".$nleft."'  AND '".$nright."' AND tm.member_id!='".$member_id."' 
					 $StrWhr AND tm.delete_sts>0  ";
			$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
			return $A_CTRL['net_amount'];
			
	}
	

	function getProcessturbo($process_id=''){
		$today_date = InsertDate(getLocalTime());
		$StrWhr .=($process_id>0)? " AND process_id='".$process_id."'":" AND  pair_sts='N'";
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_process_turbo WHERE 1 $StrWhr ORDER BY process_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	function getProcessRoi($process_id=''){
		$today_date = InsertDate(getLocalTime());
		$StrWhr .=($process_id>0)? " AND process_id='".$process_id."'":" AND  pair_sts='N'";
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_process_roi WHERE 1 $StrWhr ORDER BY process_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}


	function getProcessMaster($process_id=''){
		$today_date = InsertDate(getLocalTime());
		$StrWhr .=($process_id>0)? " AND process_id='".$process_id."'":" AND  pair_sts='N'";
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_process_master WHERE 1 $StrWhr ORDER BY process_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	function getProcesssys($process_id=''){
		$today_date = InsertDate(getLocalTime());
		$StrWhr .=($process_id>0)? " AND process_id='".$process_id."'":" AND  pair_sts='N'";
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_process_sys WHERE 1 $StrWhr ORDER BY process_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	
	function getProcess($process_id=''){
		$today_date = InsertDate(getLocalTime());
		$StrWhr .=($process_id>0)? " AND process_id='".$process_id."'":" AND  pair_sts='N'";
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_process WHERE 1 $StrWhr ORDER BY process_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
	
	function getProcessLship($process_id=''){
		$today_date = InsertDate(getLocalTime());
		$StrWhr .=($process_id>0)? " AND process_id='".$process_id."'":" AND  pair_sts='N'";
		$QR_SELECT = "SELECT * FROM ".prefix."tbl_process_lship WHERE 1 $StrWhr ORDER BY process_id DESC LIMIT 1";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	}
			function binaryroiexist($binary_id,$member_id,$process_id){ 
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM tbl_binary_roi WHERE binary_id = '$binary_id' and member_id ='$member_id' and  process_id ='$process_id'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	

// 	function getOldBinary($process_id,$member_id){
// 		$QR_BNRY = "SELECT tcb.* FROM tbl_cmsn_binary AS tcb  WHERE member_id='".$member_id."' AND process_id<'".$process_id."' ORDER BY process_id DESC LIMIT 1";
// 		$AR_BNRY = $this->SqlModel->runQuery($QR_BNRY,true);
// 		return $AR_BNRY;
// 	}
	
		function getOldBinary($process_id,$member_id){
		//$QR_BNRY = "SELECT tcb.* FROM tbl_cmsn_binary AS tcb  WHERE member_id='".$member_id."' AND process_id<'".$process_id."' ORDER BY process_id DESC LIMIT 1";
		
	$QR_BNRY = 	"SELECT tcb.*,p.start_date as sdates FROM tbl_cmsn_binary AS tcb LEFT JOIN tbl_process as p on p.process_id > tcb.process_id WHERE member_id='$member_id' AND tcb.process_id<'$process_id'   ORDER BY tcb.process_id DESC LIMIT 1";
		
		$AR_BNRY = $this->SqlModel->runQuery($QR_BNRY,true);
		return $AR_BNRY;
	} 
	function getMemberDirectCount($member_id,$left_right){
			$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='".$left_right."';";
			$RS_COL = $this->db->query($QR_COL);
			$AR_COL = $RS_COL->row_array();
			$nleft = $AR_COL["nleft"];
			$nright = $AR_COL["nright"];
			
			$Q_CTRL = "SELECT COUNT(tm.member_id) AS count_row 
					  FROM  ".prefix."tbl_members AS tm
					  LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tree.member_id=tm.member_id
					  WHERE    tree.nleft BETWEEN '".$nleft."'  AND '".$nright."'  
					  AND tm.sponsor_id='".$member_id."'   and tm.member_id in (SELECT member_id from tbl_subscription)";
			$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
			return $A_CTRL['count_row'];
	}
	
	function getMemberDownCount($member_id,$left_right){
			$QR_COL = "SELECT nleft, nright, member_id FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='".$left_right."' ;";
			$RS_COL = $this->db->query($QR_COL);
			$AR_COL = $RS_COL->row_array();
			$nleft = $AR_COL["nleft"];
			$nright = $AR_COL["nright"];
			
			$Q_CTRL = "SELECT COUNT(tm.member_id) AS count_row 
					  FROM  ".prefix."tbl_members AS tm
					  LEFT JOIN ".prefix."tbl_mem_tree AS tree ON tree.member_id=tm.member_id
					  WHERE    tree.nleft BETWEEN '".$nleft."'  AND '".$nright."'  
					  AND tm.rank_id > '0' AND tm.member_id!='$member_id' ";
			$A_CTRL = $this->SqlModel->runQuery($Q_CTRL,true);
			return $A_CTRL['count_row'];
	}
    
	
	
		function getRankName($rank_id){
		$QR_BNRY = "SELECT eligibility FROM tbl_eligibility  WHERE rank_id='".$rank_id."'  LIMIT 1";
		$RS_BNRY = $this->db->query($QR_BNRY);
		$AR_BNRY = $RS_BNRY->row_array();
		return $AR_BNRY['eligibility'];
	}
	
	
	function getOldCollection($member_id,$filed){
		$QR_BNRY = "SELECT * FROM tbl_cmsn_binary WHERE member_id='".$member_id."' ORDER BY binary_id DESC LIMIT 1";
		$RS_BNRY = $this->db->query($QR_BNRY);
		$AR_BNRY = $RS_BNRY->row_array();
		return $AR_BNRY[$filed];
	}
	
	function getFundTransfer($transfer_id){
		$QR_TRNS = "SELECT tft.* FROM tbl_fund_transfer AS tft  WHERE tft.transfer_id='".$transfer_id."'";
		$RS_TRNS = $this->db->query($QR_TRNS);
		$AR_TRNS = $RS_TRNS->row_array();
		return $AR_TRNS;
	}
	
	
	function checkPairRecord($member_id,$process_id){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."tbl_cmsn_binary WHERE member_id = '".$member_id."' AND process_id='".$process_id."'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	
	function getRanks($member_id)
	{
	    $QR_SEL = "SELECT rank_id FROM ".prefix."tbl_members where   member_id='".$member_id."' ";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['rank_id']; 
	}
	function getcountquick($member_id,$rank_id)
	{
	    
	   $QR_SEL = "SELECT COUNT(id) AS ctrl_count FROM ".prefix."tbl_quick_rank 
				  WHERE rank_id='".$rank_id."' AND member_id='".$member_id."' ";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count']; 
	}
	function getPostingCount($subcription_id,$member_id,$cmsn_date){
		$QR_SEL = "SELECT COUNT(daily_cmsn_id) AS ctrl_count FROM ".prefix."tbl_cmsn_daily 
				  WHERE  subcription_id = '".$subcription_id."'  AND member_id='".$member_id."' AND DATE(cmsn_date)<='".$cmsn_date."'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count']+1;
	}
		function getlevelPostingCount($from_member_id,$member_id,$level){
		$QR_SEL = "SELECT COUNT(id) AS ctrl_count FROM ".prefix."tbl_cmsn_level_daily 
				  WHERE  from_member_id = '".$from_member_id."'  AND member_id='".$member_id."' AND level ='".$level."'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count']+1;
	}
		function getcomPostingCount($subcription_id,$cmsn_date){
		$QR_SEL = "SELECT COUNT(id) AS ctrl_count FROM ".prefix."tbl_cmsn_community 
				  WHERE  subcription_id = '".$subcription_id."'   AND DATE(date_time)<='".$cmsn_date."'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count']+1;
	}
	function getlastrank($member_id){
		$QR_SEL = "SELECT  type_id  FROM ".prefix."tbl_cmsn_quick 
				  WHERE   member_id='".$member_id."' order by type_id desc limit 1   ";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true); 
		$return = ($AR_SEL['type_id'] > 0 )? $AR_SEL['type_id']:1;
		return $return;
	}
	function getPostingCountQuick2($type_id,$member_id,$cmsn_date){
		$QR_SEL = "SELECT COUNT(daily_cmsn_id) AS ctrl_count FROM ".prefix."tbl_cmsn_quick 
				  WHERE type_id='".$type_id."' AND member_id='".$member_id."' AND DATE(cmsn_date)<='".$cmsn_date."' and process_id <='169' ";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count'];
	}
	function getPostingCountQuick3($type_id,$member_id,$cmsn_date){
		$QR_SEL = "SELECT COUNT(daily_cmsn_id) AS ctrl_count FROM ".prefix."tbl_cmsn_quick 
				  WHERE type_id='".$type_id."' AND member_id='".$member_id."' AND DATE(cmsn_date)<='".$cmsn_date."'   and process_id  > '169'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count'];
	}
		function getPostingCountQuick($type_id,$member_id,$cmsn_date){
		$QR_SEL = "SELECT COUNT(daily_cmsn_id) AS ctrl_count FROM ".prefix."tbl_cmsn_quick 
				  WHERE type_id='".$type_id."' AND member_id='".$member_id."' AND DATE(cmsn_date)<='".$cmsn_date."'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['ctrl_count']+1;
	}
	function getReturnMining($type_id,$no_day){
		$QR_MNG = "SELECT * FROM ".prefix."tbl_pin_mining WHERE type_id='".$type_id."' AND end_day>='".$no_day."'";
		$AR_MNG = $this->SqlModel->runQuery($QR_MNG,true);
		return $AR_MNG;
	}
	function getSponsorIdVVV($member_id){
		$QR_MEM = "SELECT sponsor_id FROM ".prefix."tbl_members WHERE member_id='".$member_id."' and member_id NOT IN(select member_id from tbl_subscription where manual_p > 0 )";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['sponsor_id'];
	}
	
	
	function getSponsorId($member_id){
		$QR_MEM = "SELECT sponsor_id FROM ".prefix."tbl_members WHERE member_id='".$member_id."'";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['sponsor_id'];
	}

	function getSponsorname($member_id){
		$QR_MEM = "SELECT full_name,user_id FROM ".prefix."tbl_members WHERE member_id='".$member_id."'";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM;
	}


	function countActiveId($sponsorId)
	{
		$QR_MEM = "SELECT count(member_id) as total FROM ".prefix."tbl_members WHERE sponsor_id='".$sponsorId."' and subcription_id > 0 and tripot='0'";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['total'];
	}
	function getMemberEmail($member_id){
		$QR_MEM = "SELECT member_email FROM ".prefix."tbl_members WHERE member_id='".$member_id."'";
		$AR_MEM = $this->SqlModel->runQuery($QR_MEM,true);
		return $AR_MEM['member_email'];
	}
	
	function getSumDailyReturn($member_id,$from_date='',$to_date=''){
		if($from_date!='' && $to_date!=''){
			$from_date = InsertDate($from_date);
			$to_date = InsertDate($to_date);
			$StrWhr .=" AND DATE(tcd.cmsn_date) BETWEEN '".$from_date."' AND '".$to_date."'";
		}
		
		$QR_RTN = "SELECT SUM(tcd.net_income) AS sub_net_income FROM tbl_cmsn_daily AS tcd 
				  WHERE tcd.member_id='".$member_id."' $StrWhr";
		$AR_RTN = $this->SqlModel->runQuery($QR_RTN,true);
		return $AR_RTN['sub_net_income'];
	}
	
	function getSubscription($subcription_id){
		$QR_SUB = "SELECT subcription_id,order_no,type_id,package_price,prod_pv,net_amount,reinvest_amt,
				  total_amt,date_from,date_expire,isActive	
				  FROM ".prefix."tbl_subscription WHERE subcription_id='".$subcription_id."'";
		$AR_SUB = $this->SqlModel->runQuery($QR_SUB,true);
		return $AR_SUB;
	}
	
	function getNetBalance($wallet_trns_id,$member_id,$wallet_id){
		$QR_BAL = "SELECT 
				   SUM(COALESCE(CASE WHEN twt.trns_type = 'Dr' THEN twt.trns_amount END,0)) total_debits,
				   SUM(COALESCE(CASE WHEN twt.trns_type = 'Cr' THEN twt.trns_amount END,0)) total_credits,
				   SUM(COALESCE(CASE WHEN twt.trns_type = 'Cr' THEN twt.trns_amount END,0))
				   - SUM(COALESCE(CASE WHEN twt.trns_type = 'Dr' THEN twt.trns_amount END,0)) balance 
				   FROM ".prefix."tbl_wallet_trns AS twt 
				   WHERE twt.wallet_trns_id<='".$wallet_trns_id."' AND twt.member_id='".$member_id."' 
				   AND twt.wallet_id='".$wallet_id."'
				   GROUP BY twt.member_id
				   HAVING balance <> 0
				   ORDER BY twt.wallet_trns_id ASC";
		$AR_BAL = $this->SqlModel->runQuery($QR_BAL,true);
		return $AR_BAL['balance'];
	}
	
	function setReferralIncome($from_member_id,$subcription_id){
		$today_date = InsertDate(getLocalTime());
		$order_no_dca = UniqueId("TRNS_NO");
		#$order_no_dta = UniqueId("TRNS_NO");
		$member_id = $this->getSponsorId($from_member_id);
		$AR_SPR = $this->getMember($member_id);
		
	//	$income_percent = $this->getValue("CONFIG_DIRECT_REFFERAL");
		$AR_SUB = $this->getSubscription($subcription_id);
		$net_amount = $AR_SUB['net_amount'];
		$wallet_id = $this->getWallet(WALLET1);
		
		$total_income = ($net_amount*50)/100;
		$cash_account = 0;
		$trading_account = 0;
		if($subcription_id>0 && $member_id>0 && $net_amount>0 && $AR_SPR['subcription_id']>0){
			$data = array("subcription_id"=>$subcription_id,
				"member_id"=>$member_id,
				"from_member_id"=>$from_member_id,
				"total_collection"=>$net_amount,
			//	"income_percent"=>50,
				"total_income"=>$total_income,
				"admin_charge"=>0,
				"net_income"=>$total_income,
				"cash_account"=>$cash_account,
				"trading_account"=>$trading_account,
				"date_time"=>$AR_SUB['date_from']
			);
			$this->SqlModel->insertRecord(prefix."tbl_cmsn_direct",$data);
			$user_id = $this->getMemberUserId($from_member_id);
			$remark = "DIRECT REFERRAL FROM [".$user_id."]";
			$this->wallet_transaction($wallet_id,"Cr",$member_id,$total_income,$remark,$AR_SUB['date_from'],$order_no_dca,"1","DCA");

		}
		
	} 
	
function setDailyReturnIncome($subcription_id,$type_id,$member_id,$trans_no,$trans_amount,$daily_return,$net_income,$trns_remark,$cmsn_date,$process_id){
		$wallet_id = $this->getWallet(WALLET1);
		$date_time = ($cmsn_date!='')? $cmsn_date:getLocalTime();
		if($member_id>0 && $trans_amount>0){
			$data = array("member_id"=>$member_id,
				"subcription_id"=>$subcription_id,
				"type_id"=>$type_id,
				"trans_no"=>$trans_no,
				"trans_amount"=>$trans_amount,
				"daily_return"=>$daily_return,
				"net_income"=>$net_income,
				"trns_remark"=>$trns_remark,
				"process_id"=>$process_id,
				"cmsn_date"=>$date_time
			);
			$this->SqlModel->insertRecord(prefix."tbl_cmsn_daily",$data);
		 	//	$this->wallet_transaction($wallet_id,"Cr",$member_id,$net_income,$trns_remark,$date_time,$trans_no,1,"ROI");
		}
	}
function setDailyReturnIncomeQuick($subcription_id,$type_id,$member_id,$trans_no,$trans_amount,$daily_return,$net_income,$trns_remark,$cmsn_date,$process_id){
		$wallet_id = $this->getWallet(WALLET1);
// 		 PrintR($member_id);die('dddd');
		$date_time = ($cmsn_date!='')? $cmsn_date:getLocalTime();
		if($member_id>0 && $trans_amount>0){
			$data = array("member_id"=>$member_id,
				"subcription_id"=>$subcription_id,
				"type_id"=>$type_id,
				"trans_no"=>$trans_no,
				"trans_amount"=>$trans_amount,
				"daily_return"=>$daily_return,
				"net_income"=>$net_income,
				"trns_remark"=>$trns_remark,
				"process_id"=>$process_id,
				"cmsn_date"=>$date_time
			); 
 	$this->SqlModel->insertRecord(prefix."tbl_cmsn_quick",$data);
		 	//	$this->wallet_transaction($wallet_id,"Cr",$member_id,$net_income,$trns_remark,$date_time,$trans_no,1,"ROI");
		}
	}	
	function setPairIncome($process_id,$member_id){
		$model = new OperationModel($process_id);
		$today_date = InsertDate(getLocalTime());
		$AR_PRSS = $this->getCycleNo($process_id);
		

		$CONFIG_BINARY_INCOME = $this->getValue("CONFIG_BINARY_INCOME");
		
	
		$newLft = $this->getMemberCollection($member_id,"L",$AR_PRSS['start_date'],$AR_PRSS['end_date']);
		$newRgt = $this->getMemberCollection($member_id,"R",$AR_PRSS['start_date'],$AR_PRSS['end_date']);
		
		
		$preLcrf = $this->getOldCollection($member_id,"leftCrf");
		$preRcrf = $this->getOldCollection($member_id,"rightCrf");
		
		$totalLft = $preLcrf+$newLft;
		$totalRgt = $preRcrf+$newRgt;
		
		if($totalLft>0 || $$totalRgt>0){
			$pair_match = min($totalLft,$totalRgt);
			$leftCrf = $totalLft-$pair_match;
			$rightCrf = $totalRgt-$pair_match;
			
			$amount = $net_cmsn = ($pair_match*$CONFIG_BINARY_INCOME/100);
			if($amount>0 && $member_id>0 && $pair_match>0){
				if($model->checkPairRecord($member_id,$process_id)==0){
					$data = array("member_id"=>$member_id,
						"process_id"=>$process_id,
						"preLcrf"=>($preLcrf>0)? $preLcrf:0,
						"preRcrf"=>($preRcrf>0)? $preRcrf:0,
						"newLft"=>($newLft>0)? $newLft:0,
						"newRgt"=>($newRgt>0)? $newRgt:0,
						"totalLft"=>($totalLft>0)? $totalLft:0,
						"totalRgt"=>($totalRgt>0)? $totalRgt:0,
						"pair_match"=>($pair_match>0)? $pair_match:0,
						"leftCrf"=>($leftCrf>0)? $leftCrf:0,
						"rightCrf"=>($rightCrf>0)? $rightCrf:0,
						"amount"=>($amount>0)? $amount:0,
						"net_cmsn"=>($net_cmsn>0)? $net_cmsn:0,
						"date_time"=>$today_date
					);
					$this->SqlModel->insertRecord(prefix."tbl_cmsn_binary",$data);
				}
			}
		}

	}
	
	
	function getMemberFiledId($fields,$match){
		$QR_SEL = "SELECT * FROM ".prefix."tbl_members WHERE $fields='".$match."' AND $fields!=''";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL['member_id'];
	}
	
	function getMemberPackage($pin_price){
		$QR_SEL = "SELECT * FROM tbl_pintype WHERE pin_price<='".$pin_price."' AND pin_price_limit>='".$pin_price."' ORDER BY type_id ASC LIMIT 1";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL;
	}
	
	function getMailTemplate($option_name){
		$QR_SEL = "SELECT * FROM tbl_mail_template WHERE option_name='".$option_name."'";
		$AR_SEL = $this->SqlModel->runQuery($QR_SEL,true);
		return $AR_SEL;
	}
	
	function checkUserRecord($username){
		$QR_FROM = "SELECT COUNT(*) AS row_ctrl FROM member_list WHERE username='".$username."'";	
		$AR_FROM = $this->SqlModel->runQuery($QR_FROM,true);
		return $AR_FROM['row_ctrl'];
	}
	
	function checkUserName($user_name){
		$QR_FROM = "SELECT COUNT(*) AS row_ctrl FROM tbl_members WHERE user_name='".$user_name."'";	
		$AR_FROM = $this->SqlModel->runQuery($QR_FROM,true);
		return $AR_FROM['row_ctrl'];
	}
	
	function InsertMemberData($username){
		$QR_FROM = "SELECT * FROM member_list WHERE username='".$username."'";	
		$AR_FROM = $this->SqlModel->runQuery($QR_FROM,true);
			ForEachArr($AR_FROM);
			$user_id  = $AR_FROM['username'];
			$left_right = (strtolower($AR_FROM['left_right'])==strtolower("L"))? "L":"R";
			
			$AR_PACK = $this->getMemberPackage($AR_FROM['topup_pack']);
			$type_id = $AR_PACK['type_id'];
			
			$date_join = InsertDateTime($AR_FROM['doj']);
			$user_name = $AR_FROM['username'];
			$first_name = $AR_FROM['full_name'];
			$last_name = '';
			$full_name = $first_name." ".$last_name;
			$father_name = '';
			$spil_user_id = $AR_FROM['spill_id'];
			$spor_user_id = $AR_FROM['sponsor_id'];
			$current_address = $AR_FROM['address'];
			$city_name =  $district = $AR_FROM['city'];
			$state_name = $AR_FROM['state_name'];
			$block_sts = ($AR_FROM['status']=="block")? "Y":"N";
			$member_phone = $member_mobile = $AR_FROM['mobile'];
			$country_name = "IND";
			$pin_code = '';
			$title = '';
			$member_email = $AR_FROM['email'];
			$bitcoin_address = $AR_FROM['btc_address'];
			$user_password = $trns_password = $AR_FROM['password'];
			$upgrade_date = InsertDateTime($AR_FROM['topup_date']);
			
			$data = array(
				"user_id"=>$user_id,
				"sponsor_id"=>($sponsor_id>0)? $sponsor_id:0,
				"spil_id"=>($spil_id>0)? $spil_id:0,
				"spil_user_id"=>$spil_user_id,
				"spor_user_id"=>$spor_user_id,
				"rank_id"=>0,
				"ref_no"=>'',
				"date_join"=>($date_join!='')? $date_join:'',
				"title"=>$title,
				"first_name"=>$first_name,
				"last_name"=>($last_name)? $last_name:'',
				"full_name"=>$full_name,
				"father_name"=>($father_name)? $father_name:'',
				"current_address"=>($current_address)? $current_address:'',
				"city_name"=>($city_name)? $city_name:'',
				"state_name"=>($state_name)? $state_name:'',
				"country_name"=>($country_name)? $country_name:'',
				"pin_code"=>($pin_code)? $pin_code:'',
				"district"=>($district)? $district:'',
				"mobile_code"=>0,
				"member_phone"=>($member_phone)? $member_phone:'',
				"member_mobile"=>($member_mobile)? $member_mobile:'',
				"member_email"=>($member_email)? $member_email:'',
				"bitcoin_address"=>($bitcoin_address)? $bitcoin_address:'',
				"type_id"=>($type_id>0)? $type_id:0,
				"subcription_id"=>0,
				"user_name"=>$user_name,
				"user_password"=>$user_password,
				"trns_password"=>$trns_password,
				"status"=>"Y",
				"upgrade_date"=>($upgrade_date!='')? $upgrade_date:'',
				"block_sts"=>$block_sts,
				"left_right"=>$left_right
			);
			
			$member_id = $this->SqlModel->insertRecord("tbl_members",$data);
			return $member_id;
											
	}
	
	
	
	function checkvalueExist($table,$where,$value){
		$QR_SELECT = "SELECT COUNT(*) AS ctrl_count FROM ".prefix."$table WHERE $where LIKE '$value'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	}
	
	function targetcount($member_id, $switch){
	
	if($switch == "LeftPaid")
	{
	$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='L';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT count(ts.subcription_id) AS total  FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm  ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id =(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0 and ts.date_from < '2018-05-26 00:00:00'";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['total'];


 //and ts.date_from <= '2018-05-25 00:00:00'
				
			}
			
	if( $switch ==  "RightPaid")
	{
	$QR_SELECT = "SELECT nleft, nright FROM tbl_mem_tree WHERE spil_id='".$member_id."' AND left_right='R';";
				$RS_SELECT = $this->db->query($QR_SELECT);
				$AR_SELECT = $RS_SELECT->row_array();
				$nleft = $AR_SELECT["nleft"];
				$nright = $AR_SELECT["nright"];
				$Q_CTRL = "SELECT count(ts.subcription_id) AS total 
						  FROM tbl_subscription AS ts
						  LEFT JOIN tbl_mem_tree AS tree ON tree.member_id=ts.member_id
						  LEFT JOIN tbl_members AS tm ON tm.member_id=tree.member_id
						  WHERE ts.subcription_id=(SELECT MIN(subcription_id) FROM tbl_subscription WHERE member_id=tree.member_id)
						  AND tree.nleft BETWEEN '$nleft'  AND '$nright'  AND tm.delete_sts>0 and ts.date_from < '2018-05-26 00:00:00'";
				$R_CTRL = $this->db->query($Q_CTRL);
				$A_CTRL = $R_CTRL->row_array();
				return $A_CTRL['total'];
	}
			
	}
	
	function getleadership($member_id,$leader)
	{
		$QR_SELECT = "SELECT COUNT(id) AS ctrl_count FROM ".prefix."tbl_cmsn_leadership WHERE member_id='$member_id' and leadership_id='$leader'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT['ctrl_count'];
	 
	}

    
	function getleadershipLR($member_id,$leader)
	{
		$QR_SELECT = "SELECT left_pv , right_pv FROM ".prefix."tbl_cmsn_leadership WHERE member_id='$member_id' and leadership_id='$leader'";
		$RS_SELECT = $this->db->query($QR_SELECT);
		$AR_SELECT = $RS_SELECT->row_array();
		return $AR_SELECT;
	 
	}
	
	 public function getProperties($SrchQ, $Page) {
        $limit = 9; // Items per page
        $offset = ($Page - 1) * $limit;

        $this->db->like('address', $SrchQ); // Use the address column for searching
        $query = $this->db->get('tbl_property', $limit, $offset);
        
        return [
            'ResultSet' => $query->result_array(),
            'total' => $query->num_rows() // Total results
        ];
    }
}

?>