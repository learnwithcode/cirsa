<?php
#Fixed Code Starts-------------------------------------c
function PrintR($StrArr){
	echo "<pre>";print_r($StrArr);echo "</pre>";
}
function FCrtRplc($StrVal){
	return str_replace("'","\"",trim($StrVal));
}
function FCrtAdd($StrVal){
	return str_replace("\"","'",trim($StrVal));
}
function StringReplace($StrVal, $RFrom, $RTo){
	return str_replace($RFrom,$RTo,$StrVal);
}
function StripString($strString, $StrType){
	if(strlen($strString)>1){
		return substr($strString,0,strlen($strString)-strlen($StrType));
	}else{
		return $strString;
	}
}
function null_val($variable){
	if(is_numeric($variable)){
		return ($variable>0)? $variable:0;
	}else{
		return ($variable!='')? $variable:"NULL";
	}
}
function getSwitch($variable){
	if(is_numeric($variable)){
		return ($variable>0)? 1:0;
	}else{
		return ($variable=="on")? 1:0;
	}
}
function match_number($from_number,$to_number,$till){
	if($from_number>=0 && $to_number>=0){
		$first_number_floor =  floor($from_number);
		$first_decimal_number = $from_number-$first_number_floor;
		$match_first_number = substr($first_decimal_number,0,$till);
		
		$second_number_floor =  floor($to_number);
		$second_decimal_number = $to_number-$second_number_floor;
		$match_second_number = substr($second_decimal_number,0,$till);
		if($first_number_floor>=$second_number_floor && $match_first_number==$match_second_number){
			return 1;
		}else{
			return 0;
		}
	}else{
		return 0;
	}
}
function panel_name(){
	return WEBSITE;
}
function title_name(){
	return "Dashboard : ".panel_name();
}
function web_name(){
	return WEBSITE;
}
function word_cleanup ($str)
{
    $pattern = "/<(\w+)>(\s|&nbsp;)*<\/\1>/";
    $str = preg_replace($pattern, '', $str);
    return mb_convert_encoding($str, 'HTML-ENTITIES', 'UTF-8');
}
function currency_convert($from_Currency,$to_Currency,$amount) {
    $amount = urlencode($amount);
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);
    $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";
    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $regularExpression  = '#\<span class=bld\>(.+?)\<\/span\>#s';
    preg_match($regularExpression, $rawdata, $finalData);
    return $finalData[0];
}
function getSubString($strString, $IntLng){
	return substr($strString,0,$IntLng);
}
function ForEachArr($StrArr){
	foreach($StrArr as $Key => $Val){
		global $$Key;
		$$Key = FCrtRplc($Val);
	}
}


function DisplayDate($DateStr){
	if($DateStr<>"" and $DateStr <> "0000-00-00"){
		return date("d-m-Y", strtotime($DateStr));
	}
}
function DisplayTime($TimeStr){
	if($TimeStr<>"" and $TimeStr <> "0000-00-00"){
		return date("h:i A", strtotime($TimeStr));
	}
}
function InsertDateTime($DateStr){
	if($DateStr<>"" and $DateStr <> "0000-00-00 00:00:00"){
		return date("Y-m-d h:i:s", strtotime($DateStr));
	}
}
function InsertDate($DateStr){
	if($DateStr<>"" and $DateStr <> "0000-00-00"){
		return date("Y-m-d", strtotime($DateStr));
	}
}
function getDateFormat($StrDate, $StrFormat){
	if($StrDate<>"" and $StrDate<>"N/A" and $StrDate <> "0000-00-00"){
		return date($StrFormat,strtotime($StrDate));
	}elseif($StrDate=="N/A"){
		return "N/A" ;
	}
}
function AddTime($flddDate, $StrAdd){
	return date("Y-m-d G:i:s",strtotime(date("Y-m-d G:i:s", strtotime($flddDate)) . " $StrAdd"));
}
function getLocalTime(){
	$db = new SqlModel();
	$result = $db->runQuery("SELECT NOW() AS fldiTime;",true);
	return AddTime($result['fldiTime'],"+0 Hour");
	
}
function getDayDiff($from_date,$to_date){
	$db = new SqlModel();
	$result = $db->runQuery("SELECT DATEDIFF('".$from_date."','".$to_date."') AS  fldiTime;",true);
	return ($result['fldiTime']);
}
function getTime(){
	$AR_Time = mysql_fetch_assoc(mysql_query("SELECT CURTIME() AS fldiTime;"));
	$fldiTime = date('G:i:s');
	return AddTime($fldiTime,"+0 Hour");
}
function printDate($flddDate){
	return date("d F Y h:i:s A", $flddDate);
}
function dateandtime()
{
    return date('Y-m-d H:i:s');
}
function AddToDate($flddDate, $StrAdd){
	return date("Y-m-d",strtotime(date("Y-m-d", strtotime($flddDate)) . " $StrAdd"));
}
function AddToDateSQL($flddDate, $StrAdd){
	$Q_DATE = "SELECT DATE_ADD('$flddDate', INTERVAL $StrAdd) AS flddDate";
	$AR_DATE = ExecQ($Q_DATE,1);
	return $AR_DATE[flddDate];
}
function integerVal($fldiInteger){
	if(FCrtRplc($fldiInteger)>0){
		return FCrtRplc($fldiInteger);
	}else{
		return "0";
	}
}
function varcharVal($fldvVachar){
	if(FCrtRplc($fldvVachar)!=""){
		return FCrtRplc($fldvVachar);
	}else{
		return "Null";
	}
}
function dateDiff($dformat, $FromDate, $ToDate){
	$date_parts1=explode($dformat, $FromDate);
	$date_parts2=explode($dformat, $ToDate);
	$start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	$end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	return $end_date - $start_date;
}

function MonthDiff($flddFDate, $flddTDate){
	$flddDate1 = strtotime($flddFDate);
	$flddDate2 = strtotime($flddTDate);
	$fldiYear1 = date('Y', $flddDate1);
	$fldiYear2 = date('Y', $flddDate2);
	$fldiMonth1 = date('n', $flddDate1);
	$fldiMonth2 = date('n', $flddDate2);
	$fldiMonths = ($fldiYear2 - $fldiYear1) * 12 + ($fldiMonth2 - $fldiMonth1);
	return $fldiMonths;
}
function YearDiff($flddFDate, $flddTDate){
$diff = abs(strtotime($flddFDate) - strtotime($flddTDate));
$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
return $years;
}
function getMonthDays($flddDate){
	$db = new SqlModel();
	$Q_DTQRY = " SELECT DAY(LAST_DAY('$flddDate')) AS fldiDays";
	$AR_DTQRY = $db->runQuery($Q_DTQRY,true);
	return $AR_DTQRY['fldiDays'];
} 
function getMonth($Date){
	$db = new SqlModel();
	$strQ_Fetch = "SELECT MONTH('$Date') AS Month";
	$Arr_Fetch = $db->runQuery($strQ_Fetch,true);
	return $Arr_Fetch['Month']; 
}
function getYear($Date){
	$db = new SqlModel();
	$strQ_Fetch = "SELECT YEAR('$Date') AS Year";
	$Arr_Fetch = $db->runQuery($strQ_Fetch,true);
	return $Arr_Fetch['Year']; 
}
function getMonthDates($flddDate){
	$fldiMDays = getMonthDays($flddDate);
	$fldiMonth = getMonth($flddDate);
	$fldiYear = getYear($flddDate);
	$AR_MD[flddFDate] = InsertDate("01"."-".$fldiMonth."-".$fldiYear);
	$AR_MD[flddTDate] = InsertDate($fldiMDays."-".$fldiMonth."-".$fldiYear);
	return $AR_MD;
}
function WriteToFile($ErrorMsg){
	$myFile =  "MySqlErroFile.txt";
	$fh = fopen($myFile, 'a') or die("can't open file");
	fwrite($fh, $ErrorMsg);
	fclose($fh);
}
function ExecQ($Query, $ReturnType){
	$RS_Query = mysql_query($Query);
	if(mysql_errno()){
		WriteToFile(date('Y-m-d H:i:s')."	MySQL error ".mysql_errno().": ".mysql_error()." When executing: $Query\n".$_SERVER['PHP_SELF']."\n");
		echo "MySQL error ".mysql_errno().": ".mysql_error()."\n<br>When executing:<br>\n$Query\n<br>";
		exit;
	}
	switch($ReturnType){
		case 0:
			return $ReturnType;
		break;
		case 1:
			return mysql_fetch_assoc($RS_Query);
		break;
		case 2:
			return $RS_Query;
		break;
	}
}


function NumberFormat($Number){
	if(($Number/10)%10 != 1){
		switch($Number% 10 ){
			case 1: return $Number.'<sup>st</sup>';break;
			case 2: return $Number.'<sup>nd</sup>';break;
			case 3: return $Number.'<sup>rd</sup>';break;
		}
	}
	return $Number.'<sup>th</sup>';
}
function NumberFormat_Txt($Number){
	if(($Number/10)%10 != 1){
		switch($Number% 10 ){
			case 1: return $Number.'st';break;
			case 2: return $Number.'nd';break;
			case 3: return $Number.'rd';break;
		}
	}
	return $Number.'th';
}


#Fixed Code Ends-----------------------------------
function DisplayCombo($SlctVal, $CmbType){
	$db = new SqlModel();
	switch($CmbType){
		case "EXPRNC":
			for($Ctrl=0; $Ctrl < 51; $Ctrl++){
				$CMBTXT = $Ctrl==0?"0": $Ctrl."";
				echo "<option value='".$Ctrl."'"; if($SlctVal == $Ctrl){echo 'selected="selected"';}
				echo ">".$CMBTXT."</option>";
			}
		break;
		case "DAY":
			for($Ctrl=1; $Ctrl < 32; $Ctrl++){
				echo "<option value='".$Ctrl."'"; if($SlctVal == $Ctrl){echo "selected";}
				echo ">".$Ctrl."</option>";
			}
		break;
		case "MONTH":
			$QR_SELECT = "SELECT * ".prefix."FROM tbl_months WHERE month_id>0 ORDER BY month_id ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['month_id']."'";if($SlctVal == $rowSet['month_id']){echo "selected";}
				echo ">".$rowSet['month']."</option>";
			endforeach;
		break;
		case "YEAR":
			$Curr_Yr = date("Y");
			for($Ctrl=$Curr_Yr; $Ctrl >= 1930; $Ctrl--){
				echo "<option value='".$Ctrl."'"; if($SlctVal == $Ctrl){echo "selected";}
				echo ">".$Ctrl."</option>";
			}
		break;
		case "PROCESSOR":
			$QR_SELECT = "SELECT * ".prefix."FROM tbl_payment_processor WHERE isDelete>0 ORDER BY processor_name ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['processor_id']."'";if($SlctVal == $rowSet['processor_id']){echo "selected";}
				echo ">".$rowSet['processor_name']."</option>";
			endforeach;
		break;
		case "PROCESS":
			$QR_SELECT = "SELECT * ".prefix."FROM tbl_process WHERE pair_sts='Y' ORDER BY process_id ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['process_id']."'";if($SlctVal == $rowSet['process_id']){echo "selected";}
				echo ">"."".$rowSet['process_id'].")&nbsp;".DisplayDate($rowSet['start_date'])."&nbsp;- to -&nbsp;".DisplayDate($rowSet['end_date'])."</option>";
			endforeach;
		break;
		case "PACKAGE":
			$QR_SELECT = "SELECT * ".prefix."FROM tbl_package WHERE delete_sts>0 AND package_id>1 ORDER BY package_id ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['package_id']."'";if($SlctVal == $rowSet['package_id']){echo "selected";}
				echo ">".$rowSet['package_name']."&nbsp;(".$rowSet['package_price'].")"."</option>";
			endforeach;
		break;
		case "PIN_TYPE":
			$QR_SELECT = "SELECT * ".prefix."FROM tbl_pintype WHERE 1 ORDER BY type_id ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['type_id']."'";if($SlctVal == $rowSet['type_id']){echo "selected";}
				echo ">".$rowSet['pin_name']."</option>";
			endforeach;
		break;
			case "PIN_TYPE_VALUE":
			$QR_SELECT = "SELECT * ".prefix."FROM tbl_pintype WHERE 1 ORDER BY type_id ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['type_id']."'";if($SlctVal == $rowSet['type_id']){echo "selected";}
				echo ">".$rowSet['pin_name']." [".$rowSet['pin_price']." PV ]"." [ Rs. ".$rowSet['mrp']." ]"."</option>";
			endforeach;
		break;
		case "BANK":
			$QR_SELECT = "SELECT * ".prefix."FROM tbl_banks WHERE 1 ORDER BY bank_id ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['bank_id']."'";if($SlctVal == $rowSet['bank_id']){echo "selected";}
				echo ">".$rowSet['bank_name']."</option>";
			endforeach;
		break;
		case "CITY":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_city WHERE 1 ORDER BY city_name ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['city_name']."'";if($SlctVal == $rowSet['city_name']){echo "selected";}
				echo ">".$rowSet['city_name']."</option>";
			endforeach;
		break;
		case "STATE":
			$QR_SELECT = "SELECT DISTINCT  state_name FROM ".prefix."tbl_city WHERE 1 ORDER BY state_name ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['state_name']."'";if($SlctVal == $rowSet['state_name']){echo "selected";}
				echo ">".$rowSet['state_name']."</option>";
			endforeach;
		break;
		case "COUNTRY":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE country_code!='' ORDER BY country_name ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['country_code']."'";if($SlctVal == $rowSet['country_code']){echo "selected";}
				echo ">".$rowSet['country_name']."</option>";
			endforeach;
		break;
		case "COUNTRY_ISO":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE country_code!='' ORDER BY country_name ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['country_iso']."'";if($SlctVal == $rowSet['country_iso']){echo "selected";}
				echo ">".$rowSet['country_name']."</option>";
			endforeach;
		break;
		case "COUNTRY_PPT":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE country_code!='' 
			AND country_iso IN (SELECT ppt_country FROM tbl_ppt) ORDER BY country_name ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['country_iso']."'";if($SlctVal == $rowSet['country_iso']){echo "selected";}
				echo ">".$rowSet['country_name']."</option>";
			endforeach;
		break;
		case "LANG_PPT":
			$QR_SELECT = "SELECT DISTINCT ppt_lang FROM ".prefix."tbl_ppt WHERE ppt_lang!='' 
			ORDER BY ppt_lang ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['ppt_lang']."'";if($SlctVal == $rowSet['ppt_lang']){echo "selected";}
				echo ">".$rowSet['ppt_lang']."</option>";
			endforeach;
		break;
		case "MOBILE_CODE":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_country WHERE phonecode>0 GROUP BY phonecode ORDER BY phonecode ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['phonecode']."'";if($SlctVal == $rowSet['phonecode']){echo "selected";}
				echo ">+".$rowSet['phonecode']." (".$rowSet['country_code'].")</option>";
			endforeach;
		break;
		case "WALLET":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_wallet WHERE 1 ORDER BY wallet_name ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['wallet_id']."'";if($SlctVal == $rowSet['wallet_id']){echo "selected";}
				echo ">".$rowSet['wallet_name']."</option>";
			endforeach;
		break;
		case "CASH_TRADE":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_wallet WHERE wallet_id IN(1,3) ORDER BY wallet_name ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['wallet_id']."'";if($SlctVal == $rowSet['wallet_id']){echo "selected";}
				echo ">".$rowSet['wallet_name']."</option>";
			endforeach;
		break;
		case "WALLET_CASH":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_wallet WHERE wallet_id IN(1,2) ORDER BY wallet_name ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['wallet_id']."'";if($SlctVal == $rowSet['wallet_id']){echo "selected";}
				echo ">".$rowSet['wallet_name']."</option>";
			endforeach;
		break;
		case "FONT_AWSOME":	
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_font_awsome_icon ORDER BY icon_name ASC;";
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['icon_id']."'";if($SlctVal == $rowSet['icon_id']){echo "selected";}
				echo ">".$rowSet['icon_name']."</option>";
			endforeach;
		break;
		case "MAIN_MENU":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_sys_menu_main ORDER BY order_id ASC;";
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['ptype_id']."'";if($SlctVal == $rowSet['ptype_id']){echo "selected";}
				echo ">".$rowSet['type_name']."</option>";
			endforeach;
		break;
		case "USRGRP":
			$QR_SELECT = "SELECT * FROM ".prefix."tbl_oprtr_grp ORDER BY group_id ASC;";
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['group_id']."'";if($SlctVal == $rowSet['group_id']){echo "selected";}
				echo ">".$rowSet['group_name']."</option>";
			endforeach;
		break;
		case "EMAIL_TEMPLATE":
			$QR_SELECT = "SELECT DISTINCT type FROM tbl_mail_send WHERE 1 ORDER BY type ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['type']."'";if($SlctVal == $rowSet['type']){echo "selected";}
				echo ">".$rowSet['type']."</option>";
			endforeach;
		break;
		case "ACCOUNT_TYPE":
			echo "<option value='USD'"; if($SlctVal == 'USD'){echo "selected";} echo ">USD</option>";
			echo "<option value='EURO'"; if($SlctVal == 'EURO'){echo "selected";} echo ">EURO</option>";
			echo "<option value='GBP'"; if($SlctVal == 'GBP'){echo "selected";} echo ">GBP</option>";
		break;
		case "YN":
			echo "<option value='0'"; if($SlctVal == '0'){echo "selected";} echo ">Yes</option>";
			echo "<option value='1'"; if($SlctVal == '1'){echo "selected";} echo ">No</option>";
		break;
		case "YESNOFLAG":
			echo "<option value='N'"; if($SlctVal == 'N'){echo "selected";} echo ">SET NO</option>";
			echo "<option value='Y'"; if($SlctVal == 'Y'){echo "selected";} echo ">SET YES</option>";
		break;
		case "ACT_INACT":
			echo "<option value='N'"; if($SlctVal == 'N'){echo "selected";} echo ">In Active</option>";
			echo "<option value='Y'"; if($SlctVal == 'Y'){echo "selected";} echo ">Active</option>";
		break;
		case "NOTICE":
			echo "<option value='Na'"; if($SlctVal == 'Na'){echo "selected";} echo ">Any Time</option>";
			echo "<option value='7days'"; if($SlctVal == '7days'){echo "selected";} echo ">7 Days</option>";
			echo "<option value='15days'"; if($SlctVal == '15days'){echo "selected";} echo ">15 Days</option>";
			echo "<option value='1month'"; if($SlctVal == '1month'){echo "selected";} echo ">1 Month</option>";
			echo "<option value='3months'"; if($SlctVal == '3months'){echo "selected";} echo ">3 Months</option>";
		break;
		case "TMPLT":
			echo "<option value='01'"; if($SlctVal == '01'){echo "selected";} echo ">Menu on Left</option>";
			echo "<option value='02'"; if($SlctVal == '02'){echo "selected";} echo ">Menu on Top</option>";
		break;
		case "LOGSTS":
			echo "<option value='N'"; if($SlctVal == 'N'){echo "selected";} echo ">NOT TRACED</option>";
			echo "<option value='F'"; if($SlctVal == 'F'){echo "selected";} echo ">FAILED LOGIN</option>";
			echo "<option value='S'"; if($SlctVal == 'S'){echo "selected";} echo ">SUCCESS LOGIN</option>";
		break;
		case "METHOD":
			echo "<option value='BITCOIN'"; if($SlctVal == 'BITCOIN'){echo "selected";} echo ">Bitcoin</option>";
			echo "<option value='PERFECT'"; if($SlctVal == 'PERFECT'){echo "selected";} echo ">Perfect Money</option>";
			echo "<option value='BANKWIRE'"; if($SlctVal == 'BANKWIRE'){echo "selected";} echo "> Bank Wire</option>";
			echo "<option value='EWALLET'"; if($SlctVal == 'EWALLET'){echo "selected";} echo ">E-Wallet</option>";
		break;
		case "CAPPING_TYPE":
			echo "<option value='Y'"; if($SlctVal == 'Y'){echo "selected";} echo ">Year</option>";
			echo "<option value='M'"; if($SlctVal == 'M'){echo "selected";} echo ">Month</option>";
			echo "<option value='W'"; if($SlctVal == 'W'){echo "selected";} echo ">Week</option>";
			echo "<option value='D'"; if($SlctVal == 'D'){echo "selected";} echo ">Days</option>";
		break;
		case "DATE_TIME":
			$today_date = InsertDate(getLocalTime());
			$QR_SELECT = "SELECT DISTINCT date_time FROM tbl_daily_return WHERE  DATE(date_time)!='".$today_date."' ORDER BY date_time ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			echo '<option value="'.$today_date.'">Date : &nbsp; '.getDateFormat($today_date,"d D m Y").'</option>';
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['date_time']."'";if($SlctVal == $rowSet['date_time']){echo "selected";}
				echo ">Date : &nbsp; ".getDateFormat($rowSet['date_time'],"d D m Y")."</option>";
			endforeach;
		break;
		case "CATEGORY":
			$QR_SELECT = "SELECT * ".prefix."FROM tbl_category WHERE 1 ORDER BY category_id ASC"; 
			$rowSets = $db->runQuery($QR_SELECT);
			foreach($rowSets as $rowSet):
				echo "<option value='".$rowSet['category_id']."'";if($SlctVal == $rowSet['category_id']){echo "selected";}
				echo ">".$rowSet['category_name']."</option>";
			endforeach;
		break;
	}
}


function UniqueId($Type){
	$db =  new SqlModel();
	switch($Type){
		case "UNIQUE_NO":
			srand((double)microtime()*1000000);
			$data .= "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghigklmnopqrstuvwxyz";
			for($i = 0; $i < 25; $i++){
				$fldvNumber .= substr($data, (rand()%(strlen($data))), 1);
			}
			if($fldvNumber!=""){
				return $fldvNumber;
			}else{ return UniqueId("UNIQUE_NO"); }
		break;
		case "TICKET_NO":
			$data = "123456789";
			for($i = 0; $i < 7; $i++){
				$ticket_no .= substr($data, (rand()%(strlen($data))), 1);
			}
			$Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_support WHERE ticket_no='$ticket_no';";
			$AR_CHK = $db->runQuery($Q_CHK,true);
			if($AR_CHK['fldiCtrl']==0){
				return $ticket_no;
			}else{
				return UniqueId("TICKET_NO");
			}
		break;
		case "SMS_OTP":
			$data = "123456789";
			for($i = 0; $i <= 6; $i++){
				$sms_otp .= substr($data, (rand()%(strlen($data))), 1);
			}
			$Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_sms_otp WHERE sms_otp='$sms_otp';";
			$AR_CHK = $db->runQuery($Q_CHK,true);
			if($AR_CHK['fldiCtrl']==0){
				return $sms_otp;
			}else{
				return UniqueId("SMS_OTP");
			}
		break;
		case "TRNS_NO":
			$data = "123456789";
			for($i = 0; $i < 7; $i++){
				$unique_no .= substr($data, (rand()%(strlen($data))), 1);
			}
			$Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_wallet_trns WHERE trans_ref_no='$unique_no';";
			$AR_CHK = $db->runQuery($Q_CHK,true);
			if($AR_CHK['fldiCtrl']==0){
				return $unique_no;
			}else{
				return UniqueId("TRNS_NO");
			}
		break;
		case "TRNS_PASSWORD":
			$data = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghigklmnopqrstuvwxyz";
			for($i = 0; $i < 10; $i++){
				$trns_password .= substr($data, (rand()%(strlen($data))), 1);
			}
			$Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_members WHERE trns_password='$trns_password';";
			$AR_CHK = $db->runQuery($Q_CHK,true);
			if($AR_CHK['fldiCtrl']==0){
				return $trns_password;
			}else{
				return UniqueId("TRNS_PASSWORD");
			}
		break;
		case "ORDER_NO":
			$data = "123456789";
			for($i = 0; $i < 7; $i++){
				$unique_no .= substr($data, (rand()%(strlen($data))), 1);
			}
			$Q_CHK ="SELECT COUNT(*) AS fldiCtrl FROM ".prefix."tbl_coin_payment WHERE order_no='$unique_no';";
			$AR_CHK = $db->runQuery($Q_CHK,true);
			if($AR_CHK['fldiCtrl']==0){
				return $unique_no;
			}else{
				return UniqueId("ORDER_NO");
			}
		break;
	}
}

function just_clean($string){
	$specialCharacters = array('#' => '','$' => '','%' => '','&' => '','@' => '','.' => '','?' => '','+' => '','=' => '','?' => '','\'' => '','/' => '',);
	while (list($character, $replacement) = each($specialCharacters)) {
		$string = str_replace($character, '-' . $replacement . '-', $string);
	}
	$string = strtr($string,"??????? ??????????????????????????????????????????????","AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn");
	$string = preg_replace('/[^a-zA-Z0-9_]/', ' ', $string);
	$string = preg_replace('/^[-]+/', '', $string);
	$string = preg_replace('/[-]+$/', '', $string);
	$string = preg_replace('/[-]{2,}/', ' ', $string);
	return $string;
}
function RemoveEnter($StrString){
	return trim( preg_replace( '/\s+/', ' ', $StrString));  
	//return nl2br($StrString, false);
}

#Send SMS
function Send_Single_SMS($fldvMobile, $SMS){
	if($_SERVER['HTTP_HOST'] != "localhost:81" && $_SERVER['HTTP_HOST'] != "localhost"){
		/*$userid = "ddddddddd@gmail.com"; 
		$pwd = "674c4"; 
		$msgtype = "s";
		$ctype=1;
		$sender="CTRADE";
		$pno = $fldvMobile; 
		$msgtxt = urlencode($SMS); 
		$alert=1;

		$url = "http://smsc.vianett.no/ActiveServer/MT/";
		$ch = curl_init(); 
		if (!$ch){die("Couldn't initialize a cURL handle");}
		$ret = curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=ddddddddd@gmail.com&password=674c4&destinationaddr=$pno&message=$msgtxt&refno=1&fromAlpha=$sender");
		$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$curlresponse = curl_exec($ch);
		curl_close($ch);*/
		
	}
}
function Send_Single_SMS_Admin($fldvMobile, $fldvEmail, $SMS){
	$CI =& get_instance();
	if($_SERVER['HTTP_HOST'] != "localhost:81" && $_SERVER['HTTP_HOST'] != "localhost"){
		/*$userid = "ddddddddd@gmail.com"; //your username
		$pwd = "674c4"; 
		$msgtype = "s";
		$ctype=1;
		$sender="CTRADE";
		$pno = $fldvMobile; 
		$msgtxt = urlencode($SMS); 
		$alert=1;

		$url = "http://smsc.vianett.no/ActiveServer/MT/";
		$ch = curl_init(); 
		if (!$ch){die("Couldn't initialize a cURL handle");}
		$ret = curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);          
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=ddddddddd@gmail.com&password=674c4&destinationaddr=$pno&message=$msgtxt&refno=1&fromAlpha=$sender");
		$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$curlresponse = curl_exec($ch);
		curl_close($ch);*/
		
		$to = $fldvEmail;
		$subject = WEBSITE. " SMS OTP";
		$message = "Hi ".$to."<br />".$SMS."<br /> Best regards <br />, ".WEBSITE." Team";
		mail($to, $subject, $message);
	}
}



function convert_number($number){ 
    if(($number < 0) || ($number > 99999999999)){ throw new Exception("Number is out of range");}
	$Cn = floor($number / 10000000);  /* Millions (giga) */ 
    $number -= $Cn * 10000000; 
    $Gn = floor($number / 100000);  /* Millions (giga) */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 
	if ($Cn) 
    { 
        $res .= convert_number($Cn) . " Crore "; 
    } 
    
	if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Lakh "; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand "; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
} 
function getHeightWidth($ImagesPath, $reqWidth, $reqHeight){
	$file=trim($ImagesPath);
	if(file_exists($file)) {
		$dimension=getimagesize($file);
		if($dimension){
			$width=$dimension[0];
			$height=$dimension[1];
			if($reqWidth!="" & $reqHeight!=""){
				if($width>$reqWidth) $newWidth=$reqWidth;						
				else $newWidth=$width;
				$newHeight=floor(($newWidth/$width)*$height);
				if($newHeight>$reqHeight) {			
					$newWidth=$newWidth*($reqHeight/$newHeight);
					$newHeight=$reqHeight;
				}
			}else{
				$newWidth=$width;
				$newHeight=$height;
			}
			
			$ARHW["width"]=$newWidth;
			$ARHW["height"]=$newHeight;
			return $ARHW;
		}
	}
}


function DisplayMessage($fldvSwitch,$fldvMessage){
	echo '<script>$(function(){ setInterval(function(){$("#jsCallId").slideUp(600);}, 6000); });</script>';
	if($fldvSwitch){
		switch($fldvSwitch){
			case "success":
				$print="<div id='jsCallId' style='margin:3px;' class='success cmntext'>!! $fldvMessage !!</div>";
			break;
			case "warning":
				$print="<div id='jsCallId' style='margin:3px;' class='warning cmntext'>!! $fldvMessage !!</div>";
			break;
			case "failed":
				$print="<div id='jsCallId' style='margin:3px;' class='attention cmntext'>!! $fldvMessage !!</div>";
			break;
			
		}
		echo $print;
	}
}
function getWebPageName($PAGEURL){
	$this_page = basename($PAGEURL);
	if(strpos($this_page, "?") !== false) $this_page = reset(explode("?", $this_page));
	return $this_page;
}
function _e($string){
  $key = "MAL_979805"; //key to encrypt and decrypts.
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }

   return urlencode(base64_encode($result));
}
function _d($string){
	 $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }
   return $result;
}
function SelectTableWithOption($tblname,$field,$strwhr){
	$config = new SqlModel();
    if($strwhr!=""){
		$QryWher="AND $strwhr";
	}
	$result = $config->runQuery("SELECT ".prefix."$field FROM $tblname WHERE 1 $QryWher;",true);
	return $result[$field];
}
function SelectTable($tblname,$field,$strwhr){
	$config = new SqlModel();
	if($strwhr!=""){
		$QryWher="AND $strwhr";
	}
	$QR_SELECT = "SELECT ".prefix."$field FROM $tblname WHERE 1 $QryWher;";
	$result = $config->runQuery($QR_SELECT,true);
	return $result;
}
function DeleteTableRow($tblname,$strwhr){
	$CI =& get_instance();
	if($strwhr!=""){
		$Del_Table="DELETE  FROM ".prefix."$tblname WHERE   $strwhr";
		$CI->db->query($Del_Table);
		return $CI->db->affected_rows();
	}
}
function UpdateTable($tblname,$field,$strwhr){
	$CI =& get_instance();
	if($strwhr!=""){
		$Up_Table="UPDATE ".prefix."$tblname SET $field WHERE $strwhr";
		$CI->db->query($Up_Table);
		return $CI->db->affected_rows();
	}
}
function InsertTable($tblname,$field){
	$CI =& get_instance();
	if($field!=""){
		$In_Table="INSERT INTO  ".prefix."$tblname SET $field";
		$CI->db->query($In_Table);
		return $CI->db->insert_id();
	}
}
function GetTableInArray($tableName,$fieldName,$strWhere){
	 if($strWhere!=""){
		$queryWhere="AND $strWhere";
	}
	$QR_SELECT_TABLE="SELECT $fieldName FROM ".prefix."$tableName WHERE 1 $queryWhere";
	$QR_RESULT_TABLE =ExecQ($QR_SELECT_TABLE,2);
	$AR_RT = array();
	$i=0;
	while($QR_ARRAY_TABLE=mysql_fetch_array($QR_RESULT_TABLE)){
		$AR_RT[$i]=$QR_ARRAY_TABLE[$fieldName];
		$i++;
	}
	return $AR_RT;
}
function pop_loader($fldvPath){
	$fldvUrl = BASE_PATH;
	echo '<link rel="stylesheet" type="text/css" href="'.$fldvUrl.'popups/jquery_popupbox.css" />
	<script type="text/javascript" src="'.$fldvUrl.'popups/popups.js"></script>';
}
function javascript_alert($fldvMessage){
	echo '<script language="javascript" type="text/javascript">
	alert("'.$fldvMessage.'");
	</script>';
}

function jquery_validation(){
	echo '<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'validator/validationEngine.jquery.css" />
	<script type="text/javascript" src="'.BASE_PATH.'validator/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="'.BASE_PATH.'validator/jquery.validationEngine-en.js"></script>';
}
function auto_complete(){
	echo '<link rel="stylesheet" type="text/css" href="'.BASE_PATH.'autocomplete/autocomplete.css" />
	<script type="text/javascript" src="'.BASE_PATH.'/autocomplete/autocomplete.js"></script>';
}
function jquery_file($fldvFile){
	$fldvUrl = BASE_PATH;
	if($fldvFile!=""){
		$fldvFileArr = explode(",",$fldvFile);
		foreach($fldvFileArr as $key=>$fldvNewFile){
			echo '<script type="text/javascript" src="'.$fldvUrl.$fldvNewFile.'"></script>';
		}
		
	}
}
function web_css($fldvFile){
	$fldvUrl =GetMISCCharges("fldvURL");
	if($fldvFile!=""){
		$fldvFileArr = explode(",",$fldvFile);
		foreach($fldvFileArr as $key=>$fldvNewFile){
			echo '<link rel="stylesheet" type="text/css" href="'.$fldvUrl.$fldvNewFile.'" />';
		}
		
	}
}
function jquery_open(){
	echo '<script type="text/javascript">';
}
function jquery_close(){	
	echo '</script>';
}
function page_redirect($fldvPath){
	if($fldvPath!=""){
		header("Location: $fldvPath");
	}else{
		header("Location: ?");
	}
}
function Number($table){
	$Q_Ctrl = "SELECT COUNT(fldiNumber) AS fldiCtrl FROM $table";
	$AR_Ctrl = ExecQ($Q_Ctrl,1);
	$fldiNumber = (100000 + 100000*$AR_Ctrl[fldiCtrl]);
	return $fldiNumber;
}

function currency($from_Currency,$to_Currency,$amount) {
	$amount = urlencode($amount);
	$from_Currency = urlencode($from_Currency);
	$to_Currency = urlencode($to_Currency);
	$url = "http://www.google.com/ig/calculator?hl=en&q=$amount$from_Currency=?$to_Currency";
	$ch = curl_init();
	$timeout = 0;
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$rawdata = curl_exec($ch);
	curl_close($ch);
	$data = explode('"', $rawdata);
	$data = explode(' ', $data['3']);
	$var = $data['0'];
	return round($var,3);
}

function highlightWords($content, $search){
    if(is_array($search)){
        foreach ( $search as $word ){   
		    if($word!="" and $word!="0" and $word!="on" and $word!="." and $word!=";" and $word!="name" and $word!="off" and $word!=$search[fldiJbSkrId] and $word!="IN"and $word!="yes" and $word!="AnyKey")
			{ 
			if(!is_numeric($word)){
				$neword=explode(",",$word);
				foreach($neword as $key=>$values){
           			 $content = str_ireplace(strtolower($values), '<span class="label label-success">'.$values.'</span>', strtolower($content));
				 }
			 } 
			}
        }
    } else {
		if($search!="" and $search!="0"){
        	$content = str_ireplace(strtolower($search), '<span class="abel label-success">'.$search.'</span>', strtolower($content));
		}        
    }
    return $content;
} 

function DisplayStar($fldiRating){
	$fldvURL = GetMISCCharges("fldvURL");
	$fldvLink = $fldvURL."setupimages/star.png";
	
	switch($fldiRating){
		case "1":
			echo '<span style="float:right;"><img  src="'.$fldvLink.'"></span>';
		break;
		case "2":
			echo '<span style="float:right;"><img src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"></span>';
		break;
		case "3":
			echo '<span style="float:right;"><img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"></span>';
		break;
		case "4":
			echo '<span style="float:right;"><img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img " src="'.$fldvLink.'"></span>';
		break;
		case "5":
			echo '<span style="float:right;"><img src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"> <img  src="'.$fldvLink.'"></span>';
		break;
	}
}
function DsplyCurrPrice($fldiPrice){
	if($fldiPrice){
		return "$&nbsp;".number_format($fldiPrice,2);
	}	
}
function CountWord($fldvName){	
	if($fldvName!=""){
		$fldiWord = strlen($fldvName);
		if($fldiWord<=60){
			return $fldvName;
		}else{
			return substr($fldvName,0,60)."...";
		}
	}
}
function setWord($fldvName,$fldvNumber){	
	if($fldvName!=""){
		$fldiWord = strlen($fldvName);
		if($fldiWord<=$fldvNumber){
			return $fldvName;
		}else{
			return substr($fldvName,0,$fldvNumber)."...";
		}
	}
}

function checkRadio($fldvField,$fldvMatch,$fldvDefault){
	if( ($fldvField!="" && $fldvField==$fldvMatch) or ( $fldvDefault=="true" and $fldvField=="") ){
	 echo 'checked="checked"';
	}
}

function javascript_close(){
	echo '<script language="javascript" type="text/javascript">
	window.opener.location.reload();
	window.opener.focus();
	window.close();
	</script>';
}
function garbage_param(){
	$fldvSSS=session_id();
	$fldvRemote = $_SERVER[REMOTE_ADDR];
	$flddTime = $_SERVER[REQUEST_TIME];
	return "&fldvRemote=$fldvRemote&flddTime=$flddTime&fldvSSS=$fldvSSS";
}
function javascript_redirect($fldvPageName){
  if($fldvPageName!=""){
	echo '<script language="javascript" type="text/javascript">
		window.location.href="'.$fldvPageName.'";
	</script>';
  }	
}

function echoo($fldvFiled){	
	if(!is_numeric($fldvFiled)){
		echo ($fldvFiled!="")? $fldvFiled:"N/A";
	}else{
		echo ($fldvFiled>0)? $fldvFiled:"N/A";
	}	
}
function getSumOrder($fldvSwitch,$fldvFiled){
	switch($fldvSwitch){
		case "MEMBER":
			return SelectTableWithOption("tbl_order_food","SUM(fldiAmount)","fldiMemId='$fldvFiled' AND fldcAprSts='Y'");
		break;
	}
}
function DisplayCurrency($fldiPrice){
	return "$".number_format($fldiPrice,2);
}

function date_picker(){
	$fldvUrl =GetMISCCharges("fldvURL");
	echo '<link rel="stylesheet" type="text/css" href="'.$fldvUrl.'datepicker/date_input.css" />
	<script type="text/javascript" src="'.$fldvUrl.'datepicker/jquery.date_input.pack.js"></script>';
}

$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
function getOS() { 
    global $user_agent;
    $os_platform    =   "Unknown OS Platform";
    $os_array       =   array(
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function getBrowser(){
		$u_agent = isset($_SERVER['HTTP_USER_AGENT'])? $_SERVER['HTTP_USER_AGENT']:$_SERVER['HTTP_USER_AGENT'];
		$bname=$platform=$version=$ub="Unknown";
		$os_array = array('/windows nt 6.2/i'=>'Windows 8', '/windows nt 6.1/i'=>'Windows 7', '/windows nt 6.0/i'=>'Windows Vista', '/windows nt 5.2/i'=>'Windows Server 2003/XP x64',
					'/windows nt 5.1/i'=>'Windows XP', '/windows xp/i'=>'Windows XP','/windows nt 5.0/i'=>'Windows 2000','/windows me/i'=>'Windows ME','/win98/i'=>'Windows 98',
					'/win95/i'=>'Windows 95', '/win16/i'=>'Windows 3.11','/macintosh|mac os x/i'=>'Mac OS X','/mac_powerpc/i'=>'Mac OS 9','/linux/i'=>'Linux','/ubuntu/i'=>
					'Ubuntu', '/iphone/i'=>'iPhone','/ipod/i'=>'iPod','/ipad/i'=>'iPad','/android/i'=>'Android','/blackberry/i'=>'BlackBerry','/webos/i'=>'Mobile');
		foreach ($os_array as $regex => $value) { 
			if(preg_match($regex, $u_agent)){$platform=$value;}
		}  
		if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)){
			$bname = 'Internet Explorer';
			$ub = "MSIE";
		}elseif(preg_match('/Firefox/i',$u_agent)){
			$bname = 'Mozilla Firefox';
			$ub = "Firefox";
		}elseif(preg_match('/Chrome/i',$u_agent)){
			$bname = 'Google Chrome';
			$ub = "Chrome";
		}elseif(preg_match('/Safari/i',$u_agent)){
			$bname = 'Apple Safari';
			$ub = "Safari";
		}elseif(preg_match('/Opera/i',$u_agent)){
			$bname = 'Opera';
			$ub = "Opera";
		}elseif(preg_match('/Netscape/i',$u_agent)){
			$bname = 'Netscape';
			$ub = "Netscape";
		}
		// finally get the correct version number
		$known = array('Version', $ub, 'other');
		$pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
		if(!preg_match_all($pattern, $u_agent, $matches)){
			// we have no matching number just continue
		}
		// see how many we have
		$i=count($matches['browser']);
		if ($i != 1){
			if(strripos($u_agent,"Version") < strripos($u_agent,$ub)){
				$version= $matches['version'][0];
			}else{
				$version= isset($matches['version'][1])?$matches['version'][1]:'';
			}
		}else{
			$version= $matches['version'][0];
		}
		// check if we have a number
		if($version==null || $version==""){
			$version="?";
		}
		return array(
				'userAgent' => $u_agent,
				'name'      => $bname,
				'browser'   => $ub,
				'version'   => $version,
				'platform'  => $platform,
				'pattern'    => $pattern
		);
}
function static_message($type,$message){
	$CI = & get_instance();
	if($type!="" and $message!=""){		
	 	$CI->session->unset_userdata('type');
	    $CI->session->unset_userdata('message');

		$CI->session->set_userdata('type',$type);
		$CI->session->set_userdata('message',$message);
	}
}
function display_message(){
	$CI = & get_instance();
	echo '<script>$(function(){ setInterval(function(){$("#jsCallId").slideUp(600);}, 10000); });</script>';
	$message = $CI->session->userdata('message');
	$type = $CI->session->userdata('type');
	if($message!=''){
		switch($type){
			case "success":
				$print="<div class='alert alert-block alert-success' id='jsCallId'><i class='ace-icon fa fa-check green'></i>&nbsp;".$message."</div>";
			break;
			case "failed":
			case "warning":
			default:
				$print="<div class='alert alert-block alert-danger' id='jsCallId'><i class='ace-icon fa fa-times red'></i>&nbsp;".$message."</div>";
			break;	
			
		}
		$CI->session->unset_userdata('type');
	    $CI->session->unset_userdata('message');
		echo $print;
	}
}
function set_message($fldcType,$fldvMessage){
	$CI = & get_instance();
	if($fldcType!="" and $fldvMessage!=""){		
	 	$CI->session->unset_userdata('fldcType');
	    $CI->session->unset_userdata('fldvMessage');

		$CI->session->set_userdata('fldcType',$fldcType);
		$CI->session->set_userdata('fldvMessage',$fldvMessage);
	}
}
function get_message(){
	$CI = & get_instance();
	echo '<script>$(function(){ setInterval(function(){$("#jsCallId").slideUp(600);}, 10000); });</script>';
	$fldvMessage = $CI->session->userdata('fldvMessage');
	$fldcType = $CI->session->userdata('fldcType');
	if($fldvMessage!=''){
		switch($fldcType){
			case "success":
				$print="<div class='alert alert-block alert-success' id='jsCallId'><i class='ace-icon fa fa-check green'></i>&nbsp;".$fldvMessage."</div>";
			break;
			case "failed":
			case "warning":
			default:
				$print="<div class='alert alert-block alert-danger' id='jsCallId'><i class='ace-icon fa fa-times red'></i>&nbsp;".$fldvMessage."</div>";
			break;	
			
		}
		$CI->session->unset_userdata('fldcType');
	    $CI->session->unset_userdata('fldvMessage');
		echo $print;
	}
}

function DisplayText($fldvField){
	switch($fldvField){
		case "MEM_L":
			return "Left";
		break;
		case "MEM_R":
			return "Right";
		break;
		case "ADVERT_P":
			return "Pending";
		break;
		case "ADVERT_C":
			return "Confirmed";
		break;
		case "ADVERT_R":
			return "Rejected";
		break;
		case "LOG_S":
			return "Success";
		break;
		case "LOG_F":
			return "Failed";
		break;
		case "TIME_Y":
			return "Year";
		break;
		case "TIME_M":
			return "Month";
		break;
		case "TIME_W":	
			return "Week";
		break;
		case "TIME_D":
			return "Days";
		break;
		case "GENDER_":
		case "GENDER_M":
			return "Male";
		break;
		case "GENDER_F":
			return "Female";
		break;
		case "TICKET_O":
			return "Customer Reply";
		break;
		case "TICKET_P":
			return "Ticket Open";
		break;
		case "TICKET_R":
			return "Admin Reply";
		break;
		case "TICKET_H":
			return "Admin Reply";
		break;
		case "TICKET_C":
			return "Close";
		break;
		case "LOG_N":
			return "N/A";
		break;
		case "WITHDRAW_P":
			return "Pending";
		break;
		case "WITHDRAW_C":
			return "Completed";
		break;
		case "WITHDRAW_R":
			return "Rejected";
		break;
		case "DEPOSIT_P":
			return "Pending";
		break;
		case "DEPOSIT_C":
			return "Approved";
		break;
		case "DEPOSIT_R":
			return "Rejected";
		break;
		case "INCOME_Y":
			return "Paid";
		break;
		case "PIN_N":
			return "Pending";
		break;
		case "PIN_Y":
			return "Approved";
		break;
		case "PIN_C":
			return "Rejected";
		break;
		case "N":
			return "Pending";
		break;
		
	}
}
function DisplayMonth($fldvValue){
	if($fldvValue!=""){
		$fldvValueArr = array_filter(explode(",",$fldvValue));
		echo '<ul class="holder" style="width:95%">';
		foreach($fldvValueArr as $key=>$value){
			$monthName = date('F', mktime(0, 0, 0, $value, 10));
			echo '<li  class="bit-box" rel="103">'.$monthName.'</li>';
		}
		echo '</ul>';
		
	}
}
function setSession($fldvField,$fldvValue){
	return $_SESSION[$fldvField]=$fldvValue;
}
function getSession($fldvFiled){
	return $_SESSION[$fldvFiled];
}
function generateSeoUrl($controller,$action='',$params='') {
	$controllerName = ($controller!="")? $controller:"index";		
	$actionName = ($action == '') ? "": $action;
	$baseUrl = base_url();
	$paramString = '';
	foreach ($params as $key => $para) {
		$paramString .= "/" . $key . "/" . $para;
	}
	$generatedUrl = BASE_PATH.$controllerName . "/" . $actionName . $paramString;
	return $generatedUrl;
}
function generateSeoUrlAdmin($controller,$action='',$params=''){
	$controllerName = ($controller!="")? $controller:"index";		
	$actionName = ($action == '') ? "": $action;
	$paramString = '';
	foreach ($params as $key => $para) {
		$paramString .= "/" . $key . "/" . $para;
	}
	$generatedUrl = ADMIN_PATH.$controllerName . "/" . $actionName . $paramString;
	return $generatedUrl;
}
function generateSeoUrlMember($controller,$action='',$params=''){
	$controllerName = ($controller!="")? $controller:"index";		
	$actionName = ($action == '') ? "": $action;
	$paramString = '';
	foreach ($params as $key => $para) {
		$paramString .= "/" . $key . "/" . $para;
	}
	$generatedUrl = MEMBER_PATH.$controllerName . "/" . $actionName . $paramString;
	return $generatedUrl;
}
function generateMemberForm($controller,$action='',$params=''){
	$controllerName = ($controller!="")? $controller:"index";		
	$actionName = ($action == '') ? "": $action;
	$paramString = '';
	foreach ($params as $key => $para) {
		$paramString .= "/" . $key . "/" . $para;
	}
	$generatedUrl = MEMBER_PATH.$controllerName . "/" . $actionName . $paramString;
	return $generatedUrl;	
}
function generateAdminForm($controller,$action='',$params=''){
	$controllerName = ($controller!="")? $controller:"index";		
	$actionName = ($action == '') ? "": $action;
	$paramString = '';
	foreach ($params as $key => $para) {
		$paramString .= "/" . $key . "/" . $para;
	}
	$generatedUrl = ADMIN_PATH.$controllerName . "/" . $actionName . $paramString;
	return $generatedUrl;	
}
function generateForm($controller,$action='',$params=''){
	$controllerName = ($controller!="")? $controller:"index";		
	$actionName = ($action == '') ? "": $action;
	$paramString = '';
	foreach ($params as $key => $para) {
		$paramString .= "/" . $key . "/" . $para;
	}
	$generatedUrl = BASE_PATH.$controllerName . "/" . $actionName . $paramString;
	return $generatedUrl;	
}
function redirect_page($controller,$action,$params=''){
	$controllerName = ($controller!="")? $controller:"index";		
	$actionName = ($action == '') ? "": $action;
	$paramString = '';
	foreach ($params as $key => $para) {
		$paramString .= "/" . $key . "/" . $para;
	}
	$generatedUrl = ADMIN_PATH.$controllerName . "/" . $actionName . $paramString;
	redirect($generatedUrl); exit;
}
function redirect_member($controller,$action,$params=''){
	$controllerName = ($controller!="")? $controller:"index";		
	$actionName = ($action == '') ? "": $action;
	$paramString = '';
	foreach ($params as $key => $para) {
		$paramString .= "/" . $key . "/" . $para;
	}
	$generatedUrl = MEMBER_PATH.$controllerName . "/" . $actionName . $paramString;
	redirect($generatedUrl); exit;
}
function redirect_front($controller,$action,$params=''){
	$controllerName = ($controller!="")? $controller:"index";		
	$actionName = ($action == '') ? "": $action;
	$paramString = '';
	foreach ($params as $key => $para) {
		$paramString .= "/" . $key . "/" . $para;
	}
	$generatedUrl = BASE_PATH.$controllerName . "/" . $actionName . $paramString;
	redirect($generatedUrl); exit;
}
function getMemberImage($member_id){
	$db = new SqlModel();
	$QR_MEM = "SELECT tm.member_id, tm.photo, tm.gender FROM ".prefix."tbl_members AS tm WHERE tm.member_id='$member_id'";
	$AR_MEM = $db->runQuery($QR_MEM,true);
	$image_path = BASE_PATH."upload/member/".$AR_MEM['photo'];
	$fldvImageArr= @getimagesize($image_path);
	switch($AR_MEM['gender']):
		case "F":
			if($fldvImageArr['mime']=="") { 
				$image_path = BASE_PATH."assets/images/avatars/avatar03.png";
			}			
		break;
		case "M":
		default:
			if($fldvImageArr['mime']=="") { 
				$image_path = BASE_PATH."assets/img/default_profile.png";
			}
		break;
	endswitch;
	return $image_path;
}
function Send_Mail($ARRAY,$fldvTemplate){
	$model = new OperationModel();
	if($_SERVER['HTTP_HOST']!=''){
		switch($fldvTemplate){
			case "INVITATION":
				$fldvEmail  = FCrtRplc($ARRAY['mail_email']);
				$fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
				$fldvSubject  = FCrtRplc($ARRAY['email_subject']);
				$fldvMessage  = FCrtRplc($ARRAY['email_body']);
			break;
			case "REGISTER":
				$member_id  = FCrtRplc($ARRAY['member_id']);
				$fldvSubject = WEBSITE." Registration";
				$fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
				$PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"option_name"=>"welcome_template"));
			break;
			case "EMAIL_VERIFY":
				$member_id  = FCrtRplc($ARRAY['member_id']);
				$fldvSubject =  WEBSITE." Email verifcation";
				$AR_MEM = $model->getMember($member_id);
				$fldvEmail = $AR_MEM['member_email'];
				$fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
				$PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"option_name"=>"email_verify"));
			break;
			case "FUND_SENDER":
				$member_id  = FCrtRplc($ARRAY['member_id']);
				$amount = FCrtRplc($ARRAY['amount']);
				$fldvSubject =  WEBSITE." Fund Transaction Notification";
				$AR_MEM = $model->getMember($member_id);
				$fldvEmail = $AR_MEM['member_email'];
				$fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
				$PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"amount"=>$amount,"option_name"=>"fund_sender"));
			break;
			case "FUND_RECIVER":
				$member_id  = FCrtRplc($ARRAY['member_id']);
				$amount = FCrtRplc($ARRAY['amount']);
				$fldvSubject =  WEBSITE." Fund Transaction Notification";
				$AR_MEM = $model->getMember($member_id);
				$fldvEmail = $AR_MEM['member_email'];
				$fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
				$PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"amount"=>$amount,"option_name"=>"fund_receiver"));
			break;
			case "RESET_TRNS":
				$member_id = FCrtRplc($ARRAY['member_id']);
				$AR_MEM = $model->getMember($member_id);
				$fldvEmail = $AR_MEM['member_email'];
				$trns_password = UniqueId("TRNS_PASSWORD");
				$model->updateTransactionPassword($member_id,$trns_password);
				$fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
				$fldvSubject  =  WEBSITE." Transaction  Password Reset";
				$PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"trns_password"=>$trns_password,"option_name"=>"reset_transaction_password"));
			break;
			case "FORGOT_PASSWORD":
				$member_id = FCrtRplc($ARRAY['member_id']);
				$AR_MEM = $model->getMember($member_id);
				$fldvEmail = $AR_MEM['member_email'];
				$fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
				$fldvSubject  =  WEBSITE." Password Recovery";
				$PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"option_name"=>"forgot_password"));
			break;
			case "ADMIN_CHANGE_PASSWORD":
				$email_rq_id = FCrtRplc($ARRAY['email_rq_id']);
				$member_id = FCrtRplc($ARRAY['member_id']);
				$AR_REQ = $model->getEMAILOTP($request_id);
				$fldvEmail = $AR_REQ['email_id'];
				$fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
				$fldvSubject  =  WEBSITE." Admin Password Reset";
				$PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"email_rq_id"=>$email_rq_id,"option_name"=>"admin_password_reset"));
			break;
		}
		if($fldvEmail!="" && $_SERVER['HTTP_HOST']!="localhost"){
			$fldvServerMail = $model->getValue("CONFIG_MASS_LOGIN");
			$fldvComName = $model->getValue("CONFIG_COMPANY_NAME");
			
			$mail   = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = $model->getValue("CONFIG_MASS_HOST");
			$mail->SMTPAuth = true;
			$mail->Username = $model->getValue("CONFIG_MASS_LOGIN");
			$mail->Password = $model->getValue("CONFIG_MASS_PASSWORD");
		
			$body   = ($PARAM)? getHttpContent($PARAM):$fldvMessage;
			
			$mail->AddReplyTo($fldvServerMail,$fldvComName);
			$mail->SetFrom($fldvServerMail, $fldvComName);
			$mail->AddReplyTo($fldvServerMail,$fldvComName);	
			if($fldvAttachment==true){
				$mail->AddAttachment($fldiLink,$fileName);
			}
			$fldvEmail = '';
			foreach($fldvEmailArr as $fldvEmail){
				$mail->AddAddress($fldvEmail,$fldvSubject);
				$mail->Subject    = $fldvSubject;
				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
				$mail->MsgHTML($body);
				$mail->Send();
				#if($_SERVER['REMOTE_ADDR']=="114.79.169.107"){if(!$mail->Send()) { echo 'Mailer Error: ' . $mail->ErrorInfo;exit;}}
				$mail->ClearAddresses();
			}
		}	
	}
}


function Send_Otp_Mail($member_id,$request_id){
	$model = new OperationModel();
	$fldvSubject =  WEBSITE." OTP verifcation";
	$AR_MEM = $model->getMember($member_id);
	$fldvEmail = $AR_MEM['member_email'];
	$fldvEmailArr = array_filter(array_unique(explode(",",$fldvEmail)));
	$PARAM = generateSeoUrl("user","email",array("member_id"=>$member_id,"request_id"=>$request_id,"option_name"=>"otp_mail"));
	
	if($fldvEmail!=""){
			$fldvServerMail = $model->getValue("CONFIG_MASS_LOGIN");
			$fldvComName = $model->getValue("CONFIG_COMPANY_NAME");
			
			$mail   = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = $model->getValue("CONFIG_MASS_HOST");
			$mail->SMTPAuth = true;
			$mail->Username = $model->getValue("CONFIG_MASS_LOGIN");
			$mail->Password = $model->getValue("CONFIG_MASS_PASSWORD");
		
			$body   = ($PARAM)? getHttpContent($PARAM):$fldvMessage;
			
			$mail->AddReplyTo($fldvServerMail,$fldvComName);
			$mail->SetFrom($fldvServerMail, $fldvComName);
			$mail->AddReplyTo($fldvServerMail,$fldvComName);	
			if($fldvAttachment==true){
				$mail->AddAttachment($fldiLink,$fileName);
			}
			$fldvEmail = '';
			foreach($fldvEmailArr as $fldvEmail):
				$mail->AddAddress($fldvEmail,$fldvSubject);
				$mail->Subject    = $fldvSubject;
				$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
				$mail->MsgHTML($body);
				$mail->Send();
				#if($_SERVER['REMOTE_ADDR']=="114.79.169.107"){if(!$mail->Send()) { echo 'Mailer Error: ' . $mail->ErrorInfo;exit;}}
				$mail->ClearAddresses();
			endforeach;
	}		
}


function getHttpContent($url){						
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);				
	$html .= curl_exec($curl);
	curl_close ($curl);
	return $html;
}
function DisplayICon($icon_id){
		return SelectTableWithOption("tbl_font_awsome_icon","icon_name","icon_id='$icon_id'");
}
function validate($address){
       $decoded = decodeBase58($address);
 
       $d1 = hash("sha256", substr($decoded,0,21), true);
       $d2 = hash("sha256", $d1, true);
 
       if(substr_compare($decoded, $d2, 21, 4)){
               throw new \Exception("bad digest");
       }
       return true;
}
function get_web_page($url) {
	$ch = curl_init();
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);
	
	// Will dump a beauty json :3
	return $result;
}
function decodeBase58($input) {
       $alphabet = "123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz";
 
       $out = array_fill(0, 25, 0);
       for($i=0;$i<strlen($input);$i++){
               if(($p=strpos($alphabet, $input[$i]))===false){
                       throw new \Exception("invalid character found");
               }
               $c = $p;
               for ($j = 25; $j--; ) {
                       $c += (int)(58 * $out[$j]);
                       $out[$j] = (int)($c % 256);
                       $c /= 256;
                       $c = (int)$c;
               }
               if($c != 0){
                   throw new \Exception("address too long");
               }
       }
 
       $result = "";
       foreach($out as $val){
               $result .= chr($val);
       }
 
       return $result;
}
function btc_encode($amount){
	if(is_numeric($amount)){
		return  ($amount*100000000);
	}
}
function btc_decode($amount){
	if(is_numeric($amount)){
		return  ($amount/100000000);
	}
}

function btc_val($amount,$decimal=''){
	if(is_numeric($amount)){
		return number_format($amount,($decimal)? $decimal:BTC);
	}else{	
		return 0;
	}
}
function cal_btc($amount){
	if(is_numeric($amount)){
		return number_format($amount,BTC,".",""); 
	}else{	
		return 0;
	}
}
?>