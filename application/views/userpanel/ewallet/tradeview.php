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
        gap: 0 30px;
    }

    .mobile-dashboard table th,
    td {
        font-size: 13px;
    }


    /* -mobile-setting-css-star */

    .mobile-dashboard .heading-content {
        flex-wrap: wrap;
        padding: 20px 0;
    }

    .mobile-dashboard #setting-main {
            padding: 10px 5px;
        border: 1px solid #dadada;
        margin-bottom: 80px;
    }

    .mobile-dashboard #setting-main .accordion-menu {
        width: 100%;
        display: flex;
        align-items: center;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul {
        width: 100%;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #d8d8d8;
        margin-bottom: 5px;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span small {
        display: block;
        margin-bottom: 0 !important;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span img {
        width: 28px;
        border-radius: 5px;
        padding: 5px;
        height: 28px;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .translate-img {
        padding: 0 !important;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .getOtp-img {
        background-color: #64cd6e;
        padding: 5px 9px;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .Tradays-img {
        background-color: #c5342f;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .tradeC-img {
        background-color: #3d69ce;
        padding: 0;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .lines-img {
        background-color: #c0c4d0;
        padding: 5px;
        height: 28px;
        object-fit: contain;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .candale-img {
        background-color: #0e76a8;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .fa {
        padding: 6px;
        border-radius: 5px;
        background-color: #5accf0;
        color: #fff;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .fa-user-plus {
        background-color: #4dc623;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span>.fa-line-chart {
        background-color: #4dc623;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .fa-columns {
        background-color: #f3ad33;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li>a>span .fa-calendar-o {
        background-color: #dd2932;
    }

    .mobile-dashboard #setting-main .accordion-menu>ul>li:last-child a {
        border-bottom: none !important;
    }

    /* -mobile-setting-css-End */

    .footer-bottom-main {
        padding: 20px 0;
    }

    /* mobile-device-end-from-here */
</style>
<style>
    .accordion-menu {
        margin-bottom: 100px;
    }

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

    .accordion-menu {
        margin-bottom: 0;
    }

    @media (max-width:992px) {
        #support-main .bottom-content table thead th {
            padding: 10px;
            width: 150px;
        }
    }
</style>
               <div class="container mobile-dashboard">
                   <div class="row right-main" id="setting-main">
                       <div class="heading-content" style="background: #b5e493;padding: 15px;">
                <div class="left-content">
                    <a href="#"><i class="fa fa-bars" aria-hidden="true"></i>
                    </a>
                    <h5>Setting</h5>
                    <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                </div>
                <!-- <div class="right-content">
                    <a href="#"><input type="search" placeholder="search...."></a>
                </div> -->
            </div>
              <div class="col-12">
                            <div class="accordion-menu">
                                <ul>
                                    <li><a href="#">
                                            <div>
                                                <h3>SKSTAGE ONE INDIA PVT LTD.</h3>
                                                <p>8854534 - SKJGC0-Server <br>
                                                    Access Server 1</p>
                                            </div><i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><i class="fa fa-user-plus" aria-hidden="true"></i>
                                                <p>New Account</p>
                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><i class="fa fa-envelope-o" aria-hidden="true"></i>
                                                <p>mail box <small>You have registered a new account - FXJGC
                                                        Ltd.</small></p>
                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><i class="fa fa-columns" aria-hidden="true"></i>
                                                <p>News</p>
                                            </span></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><img src="<?php echo BASE_PATH; ?>assetsuser/images/newspaper.png" class="Tradays-img" alt="">
                                                <p>Tradays <small>Economic Calendar</small></p>
                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><i class="fa fa-commenting-o" aria-hidden="true"></i>
                                                <p>Chat and Messages
                                                    <small>Sign in to MQL5 Messages</small>
                                                </p>
                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><img src="<?php echo BASE_PATH; ?>assetsuser/images/trad-5-img.png" alt="" class="tradeC-img">
                                                Traders
                                                community
                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth"  class="getOtp-mian"><span><img src="<?php echo BASE_PATH; ?>assetsuser/images/key-img.png" alt=""
                                                    class="getOtp-img">
                                                <p>OTP <small>One-time password generator</small></p>
                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><img src="<?php echo BASE_PATH; ?>assetsuser/images/translate.png" class="translate-img"
                                                    alt="translate">
                                                <p>Enterface <small>English</small></p>

                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><img src="<?php echo BASE_PATH; ?>assetsuser/images/candlestick-chart.png" class="candale-img"
                                                    alt="candale-img">
                                                <p>chart</p>
                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><img src="<?php echo BASE_PATH; ?>assetsuser/images/lines-img.png" class="lines-img" alt="">
                                                journal
                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#" data-toggle="modal" data-target="#auth" ><span><i class="fa fa-cog" aria-hidden="true"></i>Setting
                                            </span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                                <!-- <ul>
                                    <li>
                                        <p>Balance:</p><span>359.3</span>
                                    </li>
                                    <li>
                                        <p>Equity:</p><span>359.3</span>
                                    </li>
                                    <li>
                                        <p>Free Margin:</p><span>359.3</span>
                                    </li>
                                </ul> -->
                            </div>
                        </div>
                   </div>
               </div>
               
            <div class="modal fade" id="auth" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Authorisation Required</h4>
        </div>
     
      </div>
      
    </div>
  </div>    
               
 <footer id="footer-main" >
                   
                    </footer>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>