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
        justify-content: center;
    }

    .mobile-dashboard table th,
    td {
        font-size: 13px;
    }
    .top-content-main .top-content ul li {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .top-content-main .top-content .body-content img {
        width: 80px;
    }

    .top-content-main .top-content .body-content {
        width: 100%;
        text-align: center;
        height: 100vh;
        display: inline-block;
        padding: 100px 0 0 0;
    }


    #history-main .heading-content ul {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    #history-main .heading-content ul a.btn {
        background: var(--gar-main-color);
        color: #fff;
        border-radius: 5px !important;
        border: 1px solid transparent;
    }

    #history-main .heading-content ul a:hover {
        transition: all linear 0.5s;
        background: #333;
        color: #fff;
    }

    #history-content-main table th {
        background-color: var(--main-color);
        color: #fff;
    }


    .modal.show .modal-dialog {
        transform: none;
        top: 90px;
    }


    .mobile-dashboard #accordion {
        min-height: 540px;
    }

    .mobile-dashboard #quote-table-main {
        min-height: 500px;
    }

    #history-content-main table>tbody>tr td:first-child {
        border-right: 1px solid #dad7d7 !important;
    }

    #history-content-main table>tbody>tr {
        border: none !important;
    }



    /* history-css-End */

    /* mobile-device-end-from-here */
</style>
<style>
    #history-content-main table thead {
        position: sticky;
        top: -1px;
        left: 0;
        z-index: 11;
    }
</style>


               <div class="container mobile-dashboard">
                  <div class="right-content" id="history-main">
            <div class="heading-content">
                <div class="left-content">
                    <a href="#"><i class="fa fa-bars" aria-hidden="true"></i>
                    </a>
                    <ul>
                        <li><a class="btn" data-bs-toggle="collapse" href="#collapseOne">Position</a></li>
                        <li><a class="collapsed btn" data-bs-toggle="collapse" href="#ggggcollapseTwo">Order</a></li>
                        <li><a class="collapsed btn" data-bs-toggle="collapse" href="#ggggcollapseThree">Deal</a></li>
                    </ul>
                    <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <div class="container">
                <div class="right-main" id="history-content-main">
                    <div id="accordion">

                        <div id="collapseOne" class="collapse show" data-bs-parent="#accordion">
                            <table class="table table-bordered" style="width: 100%;text-align: left;">
                                <thead>
  <?php 
                        $QR_PAID_MEM = "SELECT * FROM tbl_tradingview AS sub where status='Y' ";
                            $AR_PAID_MEMS = $this->SqlModel->runQuery($QR_PAID_MEM);
                            foreach($AR_PAID_MEMS as $AR_PAID_MEM):
                                
                                if($AR_PAID_MEM['buy_sell']=='Buy'){
                                    
                                    $dddd='blue';
                                }else{
                                    
                                    $dddd='red'; 
                                    
                                }
                                
                                $sub = $model->checkCount('tbl_tradingview','pair',$AR_PAID_MEM['pair']);
                                if($sub==2){
                                    
                                  // echo $AR_PAID_MEM['id'] ;
                                   
                                   
                                   $update_data =array("status"=>'Y');
$this->SqlModel->updateRecord(prefix."tbl_tradingview",$update_data,array("id"=>$AR_PAID_MEM['id']));
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                }
                                ?>
                              
                                <tr style="font-weight: bold;">
                                    <th style="padding: 5px;width: 70%;">
                                        <p style="font-size: 18px;"><?php echo $AR_PAID_MEM['pair'];?> <sup style="color:<?php echo $dddd;?>;"><?php echo $AR_PAID_MEM['buy_sell'];?></sup></p>
                                       
                                        <small style="display: flex;align-items: center;"><span
                                                style="color: black;"><?php echo $AR_PAID_MEM['price'];?> </span><i class="fa fa-long-arrow-right"
                                                aria-hidden="true"
                                                style="font-weight: 400;font-size: 14px;margin: 0 5px; color: #fff;"></i>
                                        </small>
                                        <strong>
                                             <small style="display: flex;align-items: center;"><span
                                                style="color: black;"><?php echo date('d-m-Y H:i',strtotime($AR_PAID_MEM['timmer']));?> </span><i class="fa fa-long-arrow-right"
                                                aria-hidden="true"
                                                style="font-weight: 400;font-size: 14px;margin: 0 5px; color: #fff;"></i>
                                        </small>
                                        </strong>
                                    </th>
                                    <th style="    padding: 21px;"><strong style="color: <?php echo $dddd;?>;font-size: 18px;"><?php echo $AR_PAID_MEM['p_price'];?> </strong><br>
                                        
                                    </th>
                                </tr>
                               <?php  endforeach;
                                
                                 ?>
                            </thead>
                                <tbody>
                               
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <p>Deposit</p>
                                            <p>profit</p>
                                            <p>Swap</p>
                                            <p>commission</p>
                                            <p>Balance</p>
                                        </td>
                                        
                                           <?php 
                        $QR_PAID_MEM = "SELECT * FROM `tbl_tradingview_updation` ORDER BY `tbl_tradingview_updation`.`id` DESC limit 1";
                            $AR_PAID_MEMS = $this->SqlModel->runQuery($QR_PAID_MEM);
                            foreach($AR_PAID_MEMS as $AR_PAID_MEM):
                                ?>
                                        <td>
                                            <p><?php echo $AR_PAID_MEM['Deposit'];?></p>
                                            <p><?php echo $AR_PAID_MEM['Profit'];?></p>
                                            <p><?php echo $AR_PAID_MEM['Swap'];?></p>
                                            <p><?php echo $AR_PAID_MEM['Commission'];?></p>
                                            <p><?php echo $AR_PAID_MEM['Balance'];?></p>
                                        </td>
                                         <?php  endforeach;
                                
                                 ?>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div id="collapseTwo" class="collapse" data-bs-parent="#accordion">
                             <table class="table table-bordered" style="width: 100%;text-align: left;">
                                <thead>

                                    <tr>
                                        <th style="    padding: 10px;"><strong style="color: #000;">AUD.s</strong><span style="font-weight: 400;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </th>
                                        <th style="    padding: 10px;"><strong style="color: #000;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <p>Deposit</p>
                                            <p>profit</p>
                                            <p>Swap</p>
                                            <p>commission</p>
                                            <p>Balance</p>
                                        </td>
                                        <td>
                                            <p>25000.00</p>
                                            <p>-24 136.47</p>
                                            <p>0.0</p>
                                            <p>-504.00</p>
                                            <p>359.53</p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div id="collapseThree" class="collapse" data-bs-parent="#accordion">
                          <table class="table table-bordered" style="width: 100%;text-align: left;">
                                <thead>

                                    <tr>
                                        <th style="    padding: 10px;"><strong style="color: #000;">AUD.s</strong><span style="font-weight: 400;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </th>
                                        <th style="    padding: 10px;"><strong style="color: #000;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong style="color: #000;">AUD.s</strong><span
                                                style="font-weight: 400;color: #1f87f6;">
                                                buy 4</span><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="margin-right: 5px;font-weight: 400;">65.633</span><i
                                                    class="fa fa-long-arrow-right" aria-hidden="true"
                                                    style="font-weight: 400;font-size: 14px;"></i><span
                                                    style="margin-left: 5px;font-weight: 400;">63.566</span>
                                            </small>
                                        </td>
                                        <td><strong style="color: #1f87f6;">289.53</strong><br>
                                            <small style="display: flex;align-items: center;"><span
                                                    style="font-weight: 400;">2023.11.07 21:45:04</span>
                                            </small>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <p>Deposit</p>
                                            <p>profit</p>
                                            <p>Swap</p>
                                            <p>commission</p>
                                            <p>Balance</p>
                                        </td>
                                        <td>
                                            <p>25000.00</p>
                                            <p>-24 136.47</p>
                                            <p>0.0</p>
                                            <p>-504.00</p>
                                            <p>359.53</p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <div class="footer-bottom-main">
                        <div class="container">
                            <div class="footer-content">
                                <ul>
                                    <li><a href="out-quetes.html"><img src="images/qoute-img.png" alt=""><br>qoutes
                                        </a></li>
                                    <li class="trade-poup-main"><a href="trade.html"><i class="fa fa-line-chart"
                                                aria-hidden="true"></i>
                                            <span>Trade</span></a></li>
                                    <li><a href="history.html"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                            <br>
                                            History</a></li>
                                    <li><a href="setting.html"><i class="fa fa-cog" aria-hidden="true"></i>
                                            <br>
                                            Setting</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
               </div>
 <footer id="footer-main" >
                   
                    </footer>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>