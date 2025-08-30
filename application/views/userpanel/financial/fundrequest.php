<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$today_date = getLocalTime();
$segment = $this->uri->uri_to_assoc(2);

$request_id = _d($segment['request_id']);
$member_id = $this->session->userdata('mem_id');
$wallet_id = $this->OperationModel->getWallet(WALLET1);
$AR_MEM = $model->getMember($member_id);

$LDGR = $model->getCurrentBalancewal($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);



	$wallet_id = $model->getWallet(WALLET1);
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	


	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tft.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT * FROM ".prefix."tbl_fund_request  
						WHERE member_id='".$member_id."'	ORDER BY date_time DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); ?>
<style type="text/css">
	span.title {
		display: block;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
		font-weight: 600;
		font-size: 12px;
		color: #fff;
		letter-spacing: 12px;
		padding-left: 10px;
	}
	.minheight{
		min-height:1200px;
	}
	.img-circle {
    border-radius: 50%;
}
.item-pic{
	width:30px;
}

</style>
<link href="<?php echo BASE_PATH; ?>memassets/css/app.v1.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_PATH; ?>memassets/css/CommonStyleSheet.css" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_PATH; ?>memassets/css/admin-software-style.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="site-holder">
  <!-- .navbar -->
  <?php  $this->load->view(MEMBER_FOLDER.'/layout/pagehead'); ?>
  <!-- /.navbar -->
  <div class="box-holder">
    <!-- .left-sidebar -->
    <?php  $this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); ?>
    <!-- /.left-sidebar -->
    <!-- .content -->
    <div class="content">
      <div class="row" style="margin-bottom:30px;">
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>"> Home </a></li>
            <li class="active"> Trasnfer Fund </li>
          </ul>
        </div>
      </div>
	  <?php if($request_id=='' || $request_id==0){ ?>
	 <h3>Available amount on your cash  wallet: Rs. <?php //echo CURRENCY; ?> <?php echo $LDGR['net_balance']; ?> </h3>
      <div class="row">
	  	<?php echo get_message(); ?>
	  	 <div class="top-menu-nav">
                                    <div>
                                        <h3 class="m-b-none"><i class="fa icon"><b class="bg-danger"></b></i>Fund Request </h3>
                                    </div>

                                <div class="sub-menus">
                                    <ul>
                                            
                                          
                                            
                                      
                                            <li><a  class="current" href="<?php  echo generateSeoUrlMember("financial","requestfund",array()); ?>"> Fund Request</a></li> 
                                            <li><a  href="<?php  echo generateSeoUrlMember("financial","transferfund",array()); ?>">Fund Transfer </a></li>
                                            <li><a  href="<?php  echo generateSeoUrlMember("financial","wallet",array()); ?>">Fund Detail</a></li>
                                    </ul>
                                </div>
                                <div class="clear"></div>
                            </div>

                            

    

   

        <div class="col-md-6">
          <div class="panel panel-primary ">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-money"></i> New Fund Transfer </h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <form action="<?php  echo  generateMemberForm("financial","requestfund"); ?>" id="form-valid" enctype="multipart/form-data" name="form-valid" autocomplete="off" method="post">	
				   <div class="form-group">
				   		<label for="" class="col-md-12 control-label">Wallet  Type  :</label>
                     	<select name="wallet_id" class="form-control validate[required]" id="wallet_id">
						<option value="1">E-wallet</option>
						</select>
                    </div>
				
				  
				   
                    <div class="form-group">
                      <label for="" class="col-md-12 control-label">Amount :</label>
                      <input id="initial_amount"  placeholder="Amount"  name="initial_amount" autocomplete="off" class="form-control validate[required,custom[integer]]" type="text" value="" maxlength="5">
					  
                    </div>                   
					
					<div class="form-group">
                      <label for="" class="col-md-12 control-label">Note:</label>
                      
                       <textarea name="trns_remark" class="form-control validate[required]" placeholder="Your note" id="form-field-1"></textarea>
                    </div>
					<div class="form-group">
                      <label for="new_again_password" class="col-md-12 control-label">User Password :</label>
                     
                        <input name="trns_password" type="password" class="form-control validate[required]" id="trns_password" 
						value="" placeholder="User Password">
                    </div>
						<div class="form-group">
                      <label for="" class="col-md-12 control-label">Upload File :</label>
						<input type='file'  class="validate[required]" name="uploadfile" />
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="submitFundRequest" id="submitFundRequest" value="1" />
                      <input name="buttonRequest" value="Submit" class="btn  btn-primary" id="buttonRequest" type="submit">
                    </div>
                  </form>
                </div>
                <br>
                <br>
              </div>
            </div>
          </div>
        </div>
       <div class="col-md-6">
			<h4>Notes:</h4>
			<ul style="list-style-type:decimal;"> 
				<li>Minimum fund Request : <?php echo number_format($model->getValue("CONFIG_MIN_FUND_TRANSFER")); ?> Rs</li>
			</ul>
	   </div>
        <br>
      </div>
	  <?php  }else{ ?>
	  	<div class="row">
	  	<?php echo get_message(); ?>
        <div class="col-md-6">
          <div class="panel panel-primary ">
            <div class="panel-heading">
              <h3 class="panel-title text-white"> <i class="fa fa-adjust"></i> Verfiy Otp  </h3>
            </div>
            <div class="panel-body">
              	<div class="row">
			  <?php echo display_message(); ?>
                <div class="col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
           			
                  <form action="<?php echo  generateMemberForm("financial","transferfund",array("request_id"=>$segment['request_id'])); ?>" id="otpForm" name="otpForm" method="post">	
				  	
                    <div class="form-group">
                      <label for="transaction_password">OTP</label>
                      <input type="password" name="sms_otp" id="sms_otp" placeholder="Check your registered  email address" value="" class="form-control validate[required,minSize[6],custom[integer]]" maxlength="7"/>
                      <div class="clear">&nbsp;</div>
                    </div>
                    
                    <div class="form-group">
					  <input type="hidden" name="request_id" id="request_id" value="<?php echo $segment['request_id']; ?>" />
                      <input type="submit" name="verifyOTP" value="Verify OTP" class="btn btn-primary btn-submit" id="updateOTP"/>
					  </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
       
        <br>
      </div>
	  <?php } ?>
	  
	      <style type="text/css">
        .Unpaid td {
            background-color: #c7f9e3 !important;
            color: black;
        }

        .deactive {
            color: red !important;
        }

        .updateempTable {
            width: 675px;
            border: 1px solid #CCC5C5;
        }

            .updateempTable .tdl {
                width: 30%;
                padding: 1px 10px;
                border-top: 1px solid #CCC5C5;
                font-size: 11px !important;
                font-weight: bold;
            }

            .updateempTable .tdc {
                width: 60%;
                padding: 1px;
                padding: 1px;
                border-left: 1px solid #CCC5C5;
                border-top: 1px solid #CCC5C5;
                font-size: 11px !important;
            }

        .tdc input[type=text], input[type=password] {
            height: 23px;
        }
    </style>
    <style type="text/css">
        .grid a {
            text-decoration: none;
        }

        #div_EpinList {
            border: 1px solid #BEBEBE;
        }

        .Nominee {
            display: none;
        }

        .Free {
            cursor: pointer;
        }

        .showpopup td {
            vertical-align: top;
            color: #666666;
        }

        #tblmemeberdetails th {
            height: 30px;
            text-align: left;
            padding: 1px;
            background-color: rgb(236, 244, 244);
        }

        .tdtitle {
            width: 18%;
            padding: 2px;
            margin-left: 4px !important;
            text-align: left;
        }

        .tdcontnt {
            width: 30%;
            padding: 2px;
            text-align: left;
        }

        .showpopup {
            display: none;
            position: fixed;
            top: 3%;
            left: 27%;
            padding-left: 1px;
            padding-right: 1px;
            border: 1px solid #FFB5AD;
            background: #E4E1E1;
            z-index: 1002;
            overflow: visible;
        }

        .progressAddCommon {
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgba(11,11,11,0.1)), to(rgba(11,11,11,0.6))) repeat-x rgba(11,11,11,0.2);
        }


        .showpopupChSp {
            opacity: 1;
            position: fixed;
            left: 33%;
            top: 30%;
            margin-left: -310px;
            margin-top: -130px;
            box-shadow: 0 0 80px rgba(0, 0, 0, 0.32);
            font-family: sans-serif;
            height: auto;
            width: 30% !important;
            z-index: 99999999999;
            background-color: #fff;
            border: 1px solid #fff;
            border-radius: 3px;
            text-align: center;
            display: none;
            padding: 10px 20px 20px 20px;
        }

        .AncUnverifiedPanno {
            padding-right: 5px;
            padding-left: 5px;
            padding-top: 2px;
            padding-bottom: 2px;
            background-color: red !important;
            color: white !important;
        }

        .AncVerifiedPanno {
            padding-right: 5px;
            padding-left: 5px;
            padding-top: 2px;
            padding-bottom: 2px;
            background-color: #1dbf52 !important;
            color: white !important;
        }
    </style>
      <div class="scrollable padder">
    
     <div class="clear"></div>
    <div class="child-page-content">
 <form id="form-search" name="form-search" method="get" action="<?php echo generateMemberForm("financial","transferfund",""); ?>">
      <div class="divSearchItem">

          
             
               
                  <input class=" validate[required] date-picker" name="from_date" id="from_date" value="<?php echo $_GET['from_date']; ?>" type="text" placeholder="From Date"  />
              <input class="validate[required] date-picker" name="to_date" id="to_date" value="<?php echo $_GET['to_date']; ?>" type="text"   placeholder="To Date" />
               	<input type="hidden" name="left_right" id="left_right" value="<?php echo _e($left_right); ?>" />
                
             <div align="left">
           
 
  	<input class="btn btn-success btnSearchGrid btn_search_hei" value=" Search " type="submit">
<a href="<?php  echo generateSeoUrlMember("financial","wallet",array()); ?>"  class="btn btn-warning btnSearchGrid btn_search_hei" value=" Reset ">Reset</a>

            </div> 
            <!--<div align="right"><h4>Available Balance : <strong><?php echo number_format($LDGR['net_balance'],2); ?></strong></h4></div>-->
            </div>
</form>        

        <div class="divGrid">
            <div id="table-container">
                <table class="grid" id="maintable">
                    <thead>
                        <tr>
                  
                          <th>Sn.</th>
                            <th >Amount </th>
                                  <th>Note</th>
                                 
                                  <th>Date & Time</th>
                                  <th>Status</th>
                 
                        </tr>
                    </thead>
                                                                  <tbody>
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									$i=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                    <tr class="odd" role="row">
                                        <td><?php echo $i;$i++;?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['request_amount']; ?></td>
                                           <td><?php echo $AR_DT['remark']; ?></td>
                                  <td class="sorting_1"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                  <td><?php echo ($AR_DT['from_user_id'] ='P')?'Pending':'Success'; ?></td>
                               
                             
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="7">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
                                  </tbody>
                </table>
                <div id="bottom_anchor"></div>
            </div>

        </div>

    <div id='divProgress'></div>
   

   



    <script src="assets/js/jquery-1.8.2.min.js"></script>
  </div>

 

                        </div>
      <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
      <!-- /.content -->
    </div>
  </div>
</div>
</body>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/ace.min.js"></script>
<?php jquery_validation();  ?>
<script type="text/javascript">
	$(function(){
		$("#form-valid").validationEngine();
	});
</script>
</html>
