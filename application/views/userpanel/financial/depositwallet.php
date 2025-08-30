<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
	
	$member_id = $this->session->userdata('mem_id');
	$AR_DT = $model->getMember($member_id);
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(tft.date_time) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$QR_PAGES="SELECT tft.* FROM ".prefix."tbl_fund_transfer AS tft WHERE tft.to_member_id='".$member_id."' 
				AND tft.trns_for LIKE 'Deposit' $StrWhr ORDER BY tft.transfer_id DESC";
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
      <div class="row">
        <div class="col-mod-12">
          <ul class="breadcrumb">
            <li><a href="<?php echo MEMBER_PATH; ?>"> Home </a></li>
            <li class="active"> Deposit Money </li>
          </ul>
        </div>
      </div>
      <div class="price-list row">
        <!-- Accordians -->
        <div class="row">
            
               <?php echo get_message(); ?>  
        <div class="scrollable padder">
                            <div class="top-menu-nav">
                                    <div>
                                        <h3 class="m-b-none"><i class="fa icon"><b class="bg-danger"></b></i>Deposit Money </h3>
                                    </div>

                                <div class="sub-menus">
                                    <ul>
                                            <li><a href="<?php  echo generateSeoUrlMember("financial","commission",array()); ?>">All Commission</a></li>
                                            <li><a class="current" href="<?php  echo generateSeoUrlMember("financial","depositwallet",array()); ?>">Deposit</a></li>
                                            <li><a href="<?php  echo generateSeoUrlMember("financial","withdraw",array()); ?>">Withdrawal </a></li>
                                            <!--<li><a href="<?php  echo generateSeoUrlMember("financial","viewtransaction",array()); ?>">Fund Transfer </a></li>
                                            <li><a href="<?php  echo generateSeoUrlMember("financial","cashaccount",array()); ?>"> Cash Wallet</a></li>
                                            <li><a href="<?php  echo generateSeoUrlMember("financial","paymenthistory",array()); ?>"> Payment History</a></li>    -->        
                                    </ul>
                                </div>
                                <div class="clear"></div>
                            </div>

                            

    

   
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

    <div class="clear"></div>
    <div class="child-page-content">
        
		<div class="col-md-6"><h3>Deposit Money</h3>
						 <form method="post"   action="<?php echo generateMemberForm("payment","processpayment",""); ?>" name="form-page" id="form-page">
						 <?php if($AR_PROC['deposit_fee']>0){ ?>  <p>Deposit Fee : <?php echo $AR_PROC['deposit_fee']; ?>  (Rs)</p> <?php } ?>
                         <div class="divSearchItem">

<input name="deposit_amount" value="" placeholder="Amount In (Rs<?php //echo CURRENCY; ?>)" class="validate[required]" type="text"  id="deposit_amount">               

							  <select name="processor_id" id="processor_id" class="validate[required]">
									<?php echo DisplayCombo($processor_id,"PROCESSOR"); ?>
							  </select>
			                
             <div align="left">
           				<input class="btn btn-success btnSearchGrid btn_search_hei" name="depositMoney" value="Deposit " type="submit">
            </div> 
            </div>
                         </form>        
                         </div>
        <div class="col-md-6"><h3>Deposit History</h3>
						 <form id="form-search" name="form-search" method="get" action="<?php echo generateMemberForm("financial","depositwallet",""); ?>">
						 
                         <div class="divSearchItem">
<input class="validate[required] date-picker" name="from_date" id="from_date" value="<?php echo $_GET['from_date']; ?>" type="text"  placeholder="From Date" />
<input class="validate[required] date-picker" name="to_date" id="to_date" value="<?php echo $_GET['to_date']; ?>" type="text"placeholder="To Date"   />    
             <div align="left">
           		
           				<input class="btn btn-success btnSearchGrid btn_search_hei" name="depositMoney" value="Search " type="submit">
            </div> 
            </div>
                         </form>        
                         </div>
                         
        <div class="divGrid">
            <div id="table-container">
                <table class="grid" id="maintable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                                                                  <tbody>
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                    <tr class="odd" role="row">
                                        
                                  <td class="sorting_1"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                  <td><?php echo $AR_DT['initial_amount']; ?>  &nbsp;USD</td>
                                  <td><?php echo $AR_DT['trns_remark']; ?></td>
                                  
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td colspan="5">No transaction found</td>
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
    
    </div>
    	<div class="row">
						<div class="col-xs-6">
						<div aria-live="polite" role="status" id="dynamic-table_info" class="dataTables_info"> Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries </div>
						</div>
						<div class="col-xs-6">
						<div id="dynamic-table_paginate" class="dataTables_paginate paging_simple_numbers">
						<ul class="pagination">
						<?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
						</ul>
						</div>
						</div>
						</div>
						
						
						
   </div>
        <?php  $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>
    
    </div>
  </div>
</div>
</body>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/moment.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/daterangepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-page").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
</html>
