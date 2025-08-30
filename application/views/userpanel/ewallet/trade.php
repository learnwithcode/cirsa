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
        gap: 0 30px;
    }


    /* mobile-trade-css-start */

    #trad-main .top-content {
        height: 460px;
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

    .footer-bottom-main {
        padding: 20px 0;
    }

    /* mobile-trade-css-end */


    @media (max-width:992px) {
        #support-main .bottom-content table thead th {
            padding: 10px;
            width: 150px;
        }
    }

    /* mobile-device-end-from-here */
</style>

               <div class="container mobile-dashboard">
                   <div class="row right-main" id="setting-main">
                       <div class="top-content-main">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="top-content" style="border: 1px solid #dee2e6;padding: 20px;">
                                    <ul>
                                                <?php 
                        $QR_PAID_MEM = "SELECT * FROM `tbl_tradingview_trade_updation` ORDER BY `tbl_tradingview_trade_updation`.`id` DESC limit 1";
                            $AR_PAID_MEMS = $this->SqlModel->runQuery($QR_PAID_MEM);
                            foreach($AR_PAID_MEMS as $AR_PAID_MEM):
                                ?>
                                        <center style="font-size: 27px;font-weight: 600;display:none;">
                                            
                                            
                                            <?php 
                                            
                                            
                                            
                                            if($AR_PAID_MEM['Balance']>$AR_PAID_MEM['Equity']){
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ?>
                                            
                                            
                                            
                                            <p style="color:red;">
                                                
                                              <?php echo $AR_PAID_MEM['Equity']-$AR_PAID_MEM['Balance']; ?>  
                                                
                                            </p>
                                            
                                            
                                            <?php }else{?>
                                            
                                              <p style="color:green;">
                                                
                                                 <p>
                                                
                                              <?php echo $AR_PAID_MEM['Balance']-$AR_PAID_MEM['Equity']; ?>  
                                                
                                            </p> 
                                                
                                            </p>
                                            
                                            <?php }?>
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            </center>
                                        <li>
                                            <p>Balance:</p><span><?php echo $AR_PAID_MEM['Balance'];?></span>
                                        </li>
                                        <li>
                                            <p>Equity:</p><span><?php echo $AR_PAID_MEM['Equity'];?></span>
                                        </li>
                                        <li>
                                            <p>Margin:</p><span><?php echo $AR_PAID_MEM['Margin'];?></span>
                                        </li>
                                         <li>
                                            <p>Free Margin:</p><span><?php echo $AR_PAID_MEM['FreeMargin'];?></span>
                                        </li>
                                         <li>
                                            <p>Margin Level ( % ):</p><span><?php echo $AR_PAID_MEM['MarginLevel'];?></span>
                                        </li>
                                          <?php  endforeach;
                                
                                 ?>
                                    </ul>
                                    <div class="body-content">
                                        <h4 style="background: aquamarine;padding: 10px;">Positions</h4>
                                        <br>
                                        <ul>
                                               <?php 
                        $QR_PAID_MEM = "SELECT * FROM tbl_tradingview AS sub where status='N' ";
                            $AR_PAID_MEMS = $this->SqlModel->runQuery($QR_PAID_MEM);
                            foreach($AR_PAID_MEMS as $AR_PAID_MEM):
                                
                                if($AR_PAID_MEM['buy_sell']=='Buy'){
                                    
                                    $dddd='blue';
                                }else{
                                    
                                    $dddd='red'; 
                                    
                                }
                                
                                $sub = $model->checkCount('tbl_tradingview','pair',$AR_PAID_MEM['pair']);
                                if($sub==2){
                                    
                                   echo $AR_PAID_MEM['id'] ;
                                   
                                   
                                   $update_data =array("status"=>'Y');
$this->SqlModel->updateRecord(prefix."tbl_tradingview",$update_data,array("id"=>$AR_PAID_MEM['id']));
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                }
                                ?>
                                        <table class="table table-bordered" style="width: 100%;text-align: left;">
                            <thead>

                                <tr>
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
                                    <th style="    padding: 21px;"><strong style="color: <?php echo $dddd;?>;font-size: 18px;"><?php echo $AR_PAID_MEM['qty'];?> </strong><br>
                                        
                                    </th>
                                </tr>
                                </tr>
                            </thead>
                  
                        </table>
                                        <br>
                                        <?php  endforeach;
                                
                                 ?>
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