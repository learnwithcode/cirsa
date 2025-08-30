<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tcd.cmsn_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT tcd.*, tm.user_id FROM ".prefix."tbl_cmsn_daily AS tcd 
			  LEFT JOIN tbl_members AS tm ON tcd.member_id = tm.member_id
				  WHERE tcd.member_id='".$member_id."' $StrWhr ORDER BY tcd.daily_cmsn_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	
	
	
?>
 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
?>
<style>
    body {
        margin: 0;
        font-size: 16px;
        color: #333;
        font-weight: 400;
        font-family: 'Open Sans', sans-serif;
        position: relative;
    }


    * {
        box-sizing: border-box;
        border: none;
        text-decoration: none !important;
        list-style: none !important;
        outline: none !important;
        margin: 0;
        padding: 0;
    }

    ul,
    li {
        padding: 0 !important;
        margin: 0;
    }

    /*:root {*/
    /*    --gar-main-color: radial-gradient(at 20% 20%, #99e069 0%, #99e069 40%, #eceae6 100%);*/
    /*    --main-color: #99e069;*/
    /*    --second-color: #2077e9;*/
    /*}*/

    .container {
        width: 100%;
        max-width: 1280px;
        margin-left: auto;
        margin-right: auto;
        padding-left: 15px;
        padding-right: 15px;
    }

    .row {
        margin: 0 -15px;
    }

    .col-20 {
        width: 20%;
        float: left;
        padding-left: 15px;
        padding-right: 15px;
    }


    .col-25 {
        width: 25%;
        float: left;
        padding: 0 15px;
    }

    .col-33 {
        width: 33.33%;
        float: left;
        padding: 0 15px;
    }

    .col-50 {
        width: 50%;
        float: left;
        padding-left: 15px;
        padding-right: 15px;
    }

    .col-100 {
        width: 100%;
        float: left;
        padding-left: 15px;
        padding-right: 15px;
    }

    .container-fluid {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    h2 {
        font-size: 30px;
        margin: 0 !important;
    }

    h3 {
        font-size: 24px;
        margin: 0 !important;
    }

    h4 {
        font-size: 17px;
        margin: 0 !important;
    }

    h5 {
        font-size: 20px;
        margin: 0 !important;
    }

    p {
        margin: 0;
    }

    a {
        font-size: 16px;
        color: #333;
        font-weight: 400;
        text-transform: capitalize;
        transition: linear all 0.5s;
    }

    button {
        cursor: pointer !important;
    }

    .fa {
        font-size: 15px;
        transition: all linear 0.5s;
    }

    input,
    a,
    small,
    sup,
    sup,
    strong {
        display: inline-block;
    }

    input {
        font-size: 14px;
        text-transform: capitalize;
    }

    small {
        margin-bottom: 5px;
    }

    .btn-main {
        background: var(--gar-main-color) !important;
        color: #fff;
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 16px;
        text-transform: capitalize;
        transition: all linear 0.5s !important;
    }

    .btn-main:hover {
        background: #333 !important;
        color: #fff;
        transition: all linear 0.5s !important;
    }

    /*------- #header-main css start ------*/



    /*------- dashboard right content css end ------*/



    /* mobile-device-start-from-here */


    /* outQoutes-css-start */

    .footer-bottom-main .footer-content ul li a img {
        width: 14px;
        display: block;
        margin: 0 auto;
    }

    .mobile-dashboard .heading-content {
        flex-wrap: wrap;
    }

    .mobile-dashboard .heading-content .left-content {
        width: 100%;
        display: flex;
        justify-content: space-between;
        gap: 20px;
        align-items: center;
    }

    .mobile-dashboard .right-content>.heading-content .right-content {
        width: 100%;
        margin-top: 10px;
    }

    .mobile-dashboard .right-content>.heading-content .right-content input {
        width: 100%;
        padding: 5px 10px;
        height: 100%;
        background-color: #fff;
    }

    .mobile-dashboard .right-content>.heading-content .right-content a {
        width: 100%;
        display: flex;
        align-items: center;
        border-radius: 5px;
        background-color: #fff;
    }

    .mobile-dashboard .footer-bottom-main .footer-content ul {
        flex-wrap: nowrap;
        align-items: center;
    }

    .mobile-dashboard .footer-bottom-main .footer-content ul li a {
        font-size: 12px;
        width: 100% !important;
        display: inline-block;
        text-align: center;
    }

    .mobile-dashboard .footer-bottom-main .footer-content ul li a .fa {
        display: block;
        margin: 0 !important;

    }

    .mobile-dashboard .footer-bottom-main .footer-content ul li a .fa-cog {
        animation: setting-animation 5s infinite linear;
    }

    @keyframes setting-animation {
        0% {
            transform: rotate(0);
        }

        100% {
            transform: rotate(360deg);
            color: #99e069;
        }
    }

    .fa-pencil {
        animation: pencil-animation 1s infinite linear;
        position: relative;
    }

    @keyframes pencil-animation {
        0% {
            transform: translate(0px);
        }

        50% {
            transform: translate(2px);
            color: #99e069;
        }

        75% {
            transform: translate(2px);

        }

        100% {
            transform: translate(0);
            color: #99e069;
        }
    }

    .mobile-dashboard .footer-bottom-main .footer-content ul li:nth-child(3) a span {
        display: inline-block;
        margin-top: 5px;
    }

    .mobile-dashboard .footer-bottom-main .footer-content ul li:nth-child(3) a {
        background: transparent !important;
        width: auto;
        height: auto;
        color: #333;
        border: inherit;
        border-radius: 0;
        top: 0;
    }

    .mobile-dashboard .footer-bottom-main .footer-content ul li a br {
        display: none;
    }

    .mobile-dashboard .footer-bottom-main .footer-content ul {
        display: flex;
        align-items: flex-end;
        gap: 0 30px !important; 
    }

    .mobile-dashboard table th,
    td {
        font-size: 13px;
    }

    div#qoute-content-main table th {
        background-color: var(--main-color);
        color: #fff;
    }

    /* outQoutes-css-End */


    /* mobile-device-end-from-here */
</style>
<style>
    #support-main .bottom-content table tbody tr td:last-child {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    #support-main .bottom-content table tbody tr td {
        vertical-align: middle;
    }

    #support-main .bottom-content table tbody tr td .btn-main {
        width: 70px;
        text-align: center;
        padding: 5px 10px;
        border-radius: 5px;
    }

    #support-main .bottom-content table {
        table-layout: fixed;
    }

    #support-main .bottom-content table thead th:last-child {
        width: 200px;
    }

    @media (max-width:992px) {
        #support-main .bottom-content table thead th {
            padding: 10px;
            width: 150px;
        }
    }
</style>
<?php

 $curl = curl_init();
    
    curl_setopt_array( $curl, array(
        CURLOPT_PORT => "443",
        CURLOPT_URL => "https://marketdata.tradermade.com/api/v1/live?currency=USDEUR,USDGBP,EURJPY,AUDUSD,NZDUSD,GBPEUR,XAUUSD,XAGUSD&api_key=5fL231yqKuk9Twd_kWYJ",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
     $response1 = json_decode($response, true);
  //  PrintR($response1[quotes]);



?>
               <div class="container mobile-dashboard">
                   <div class="row right-main" id="setting-main">
                       <div class="heading-content" style="background: #ffffff;padding: 15px;">
                  <div id="quote-table-main">
                        <table class="table table-bordered" style="width: 100%;text-align: left;">
                            <tbody>
                                <tr style="font-weight: bold;">
                                    <td>
                                        <p style="font-size: 18px;"><?php echo $response1[quotes][0][base_currency]; ?>/<?php echo $response1[quotes][0][quote_currency]; ?></p>
                                      
                                      
                                    </td>
                                    <td style="text-align: end;"><strong style="color: #0554ff;font-size: 18px;"><?php echo $response1[quotes][0][ask]; ?></strong><br>
                                        
                                    </td>
                                </tr>
                                   <tr style="font-weight: bold;">
                                    <td>
                                        <p style="font-size: 18px;"><?php echo $response1[quotes][1][base_currency]; ?>/<?php echo $response1[quotes][1][quote_currency]; ?></p>
                                      
                                      
                                    </td>
                                    <td style="text-align: end;"><strong style="color: #0554ff;font-size: 18px;"><?php echo $response1[quotes][1][ask]; ?></strong><br>
                                        
                                    </td>
                                </tr>
                                     <tr style="font-weight: bold;">
                                    <td>
                                        <p style="font-size: 18px;"><?php echo $response1[quotes][2][base_currency]; ?>/<?php echo $response1[quotes][2][quote_currency]; ?></p>
                                      
                                      
                                    </td>
                                    <td style="text-align: end;"><strong style="color: #0554ff;font-size: 18px;"><?php echo $response1[quotes][2][ask]; ?></strong><br>
                                        
                                    </td>
                                </tr>
                                     <tr style="font-weight: bold;">
                                    <td>
                                        <p style="font-size: 18px;"><?php echo $response1[quotes][3][base_currency]; ?>/<?php echo $response1[quotes][3][quote_currency]; ?></p>
                                      
                                      
                                    </td>
                                    <td style="text-align: end;"> <strong style="color: #0554ff;font-size: 18px;"><?php echo $response1[quotes][3][ask]; ?></strong><br>
                                        
                                    </td>
                                </tr>
                                     <tr style="font-weight: bold;">
                                    <td>
                                        <p style="font-size: 18px;"><?php echo $response1[quotes][4][base_currency]; ?>/<?php echo $response1[quotes][4][quote_currency]; ?></p>
                                      
                                      
                                    </td>
                                    <td style="text-align: end;"><strong style="color: #0554ff;font-size: 18px;"><?php echo $response1[quotes][4][ask]; ?></strong><br>
                                        
                                    </td>
                                </tr>
                                     <tr style="font-weight: bold;">
                                    <td>
                                        <p style="font-size: 18px;"><?php echo $response1[quotes][5][base_currency]; ?>/<?php echo $response1[quotes][5][quote_currency]; ?></p>
                                      
                                      
                                    </td>
                                    <td style="text-align: end;"><strong style="color: #0554ff;font-size: 18px;"><?php echo $response1[quotes][5][ask]; ?></strong><br>
                                        
                                    </td>
                                </tr>
                                     <tr style="font-weight: bold;">
                                    <td>
                                        <p style="font-size: 18px;"><?php echo $response1[quotes][6][base_currency]; ?>/<?php echo $response1[quotes][6][quote_currency]; ?></p>
                                      
                                      
                                    </td>
                                    <td style="text-align: end;"><strong style="color: #0554ff;font-size: 18px;"><?php echo $response1[quotes][6][ask]; ?></strong><br>
                                        
                                    </td>
                                </tr>
                                     <tr style="font-weight: bold;">
                                    <td>
                                        <p style="font-size: 18px;"><?php echo $response1[quotes][7][base_currency]; ?>/<?php echo $response1[quotes][7][quote_currency]; ?></p>
                                      
                                      
                                    </td>
                                    <td style="text-align: end;"><strong style="color: #0554ff;font-size: 18px;"><?php echo $response1[quotes][7][ask]; ?></strong><br>
                                        
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
                    </div>
                <!-- <div class="right-content">
                    <a href="#"><input type="search" placeholder="search...."></a>
                </div> -->
            </div>
           
                   </div>
               </div>
 <footer id="footer-main" >
                   
                    </footer>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>