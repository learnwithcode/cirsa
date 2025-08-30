<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
	$model = new OperationModel();
	$Page = $_GET['page']; if($Page == "" or $Page <=0){$Page=1;}
	$member_id = $this->session->userdata('mem_id');
	$wallet_id = ($_REQUEST['wallet_id']>0)? $_REQUEST['wallet_id']:$model->getWallet(WALLET1);
	
	if($_REQUEST['from_date']!='' && $_REQUEST['to_date']!=''){
		$from_date = InsertDate($_REQUEST['from_date']);
		$to_date = InsertDate($_REQUEST['to_date']);
		$StrWhr .=" AND DATE(twt.trns_date) BETWEEN '$from_date' AND '$to_date'";
		$SrchQ .="&from_date=$from_date&to_date=$to_date";
	}
	
	$LDGR = $model->getCurrentBalance($member_id,$wallet_id,$_REQUEST['from_date'],$_REQUEST['to_date']);

	$QR_PAGES="SELECT twt.* FROM ".prefix."tbl_wallet_trns AS twt 
			   WHERE twt.member_id='".$member_id."' AND twt.wallet_id='".$wallet_id."'
			   $StrWhr 
			   ORDER BY twt.trns_date DESC";
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
            <li class="active">All Commission</li>
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
                                        <h3 class="m-b-none"><i class="fa icon"><b class="bg-danger"></b></i>All Commission List </h3>
                                    </div>

                                <div class="sub-menus">
                                    <ul>
                                            <li><a class="current"  href="<?php  echo generateSeoUrlMember("financial","commission",array()); ?>">All Commission </a></li>
                                           <li><a href="<?php  echo generateSeoUrlMember("financial","depositwallet",array()); ?>">Deposit</a></li>
                                            <li> <a href="<?php  echo generateSeoUrlMember("financial","withdraw",array()); ?>">Withdrawal </a></li>
                                                          
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
 <form id="form-search" name="form-search" method="get" action="<?php echo generateMemberForm("financial","wallet",""); ?>">
      <div class="divSearchItem">
	<select name="wallet_id" id="wallet_id" class="form-control validate[required]">
									<?php echo DisplayCombo($_REQUEST['wallet_id'],"WALLET"); ?>
								</select>
          
             
               
                  <input class=" validate[required] date-picker" name="from_date" id="from_date" value="<?php echo $_GET['from_date']; ?>" type="text" placeholder="From Date"  />
              <input class="validate[required] date-picker" name="to_date" id="to_date" value="<?php echo $_GET['to_date']; ?>" type="text"   placeholder="To Date" />
               	<input type="hidden" name="left_right" id="left_right" value="<?php echo _e($left_right); ?>" />
                
             <div align="left">
           
 
  	<input class="btn btn-success btnSearchGrid btn_search_hei" value=" Search " type="submit">
<a href="<?php  echo generateSeoUrlMember("financial","wallet",array()); ?>"  class="btn btn-warning btnSearchGrid btn_search_hei" value=" Reset ">Reset</a>

            </div> 
            <div align="right"><h4>Available Balance : <strong><?php echo number_format($LDGR['net_balance'],2); ?></strong></h4></div>
            </div>
</form>        

        <div class="divGrid">
            <div id="table-container">
                <table class="grid" id="maintable">
                    <thead>
                        <tr>
                  
                          <th>Sn.</th>
                            <th style="width: 20%;">Date</th>
                            <th style="width: 20%;">Trns No</th>
                            <th style="width: 15%;">Type</th>
                            <th style=" width: 15%;">Amount</th>
                            <th style="width: 30%;">Details</th>
                 
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
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['trns_date']); ?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['trans_ref_no']; ?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['trns_type']; ?></td>
                                      <td class="sorting_1"><?php echo number_format($AR_DT['trns_amount'],2); ?></td>
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
                <?php //echo "<pre>";print_r($PageVal);die;?>
                <div id="bottom_anchor"></div>
            </div>

        </div>

    <div id='divProgress'></div>
   

   



    <script src="assets/js/jquery-1.8.2.min.js"></script>
  

 

                        </div>
                    
	  
	  
	  </div>
        <!--  <div class="col-md-12"> <?php echo get_message(); ?>
          
          
          
          
            <div class="portlet light bordered">
              <div class="panel-body">
                <div class="main pagesize">
                 
                  <div class="main-wrap">
                    <div class="content-box">
                      <div class="box-body">
                        <div class="box-wrap clear">
                          <h2>e-Statement</h2>
                          <br>
                          <div class="actions">
						  	<div class="row">
							 <div class="col-md-4">
                           <form id="form-search" name="form-search" method="get" action="<?php echo generateMemberForm("financial","wallet",""); ?>">
                         	<div class="form-group">
								<select name="wallet_id" id="wallet_id" class="form-control validate[required]">
									<?php echo DisplayCombo($_REQUEST['wallet_id'],"WALLET"); ?>
								</select>
							</div>
							<div class="form-group">
								<div class="input-group">
                                    <input class="form-control validate[required] date-picker" name="from_date" id="from_date" value="<?php echo $_REQUEST['from_date']; ?>" type="text" placeholder="From Date"  />
                                    <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
							</div>
							<div class="form-group">
								<div class="input-group">
                                    <input class="form-control validate[required] date-picker" name="to_date" id="to_date" value="<?php echo $_REQUEST['to_date']; ?>" type="text"   placeholder="To Date" />
                                    <span class="input-group-addon"> <i class="fa fa-calendar bigger-110"></i></span> </div>
							</div>
							
                          	<input class="btn btn-sm btn-primary m-t-n-xs" value=" Search " type="submit">
						       <a href="<?php  echo generateSeoUrlMember("financial","wallet",array()); ?>" 
							   class="btn btn-sm btn-default m-t-n-xs" value=" Reset ">Reset</a>
                        </form>
							  </div>
							</div>
                          </div>
                          <br>
                          <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="wallet_deposit_wrapper">
                            <div class="row">
							  <div class="col-md-12">
							  	<div class="col-md-8">
									&nbsp;
								</div>
								<div class="col-md-4 pull-right">
									<h4>Available Balance : <strong><?php echo number_format($LDGR['net_balance'],2); ?></strong></h4>
								</div>
							  </div>
                              <div class="col-md-12">
                                <table aria-describedby="wallet_deposit_info" role="grid" id="wallet_deposit" class="table table-striped table-bordered table-hover dataTable no-footer">
                                  <thead>
                                    <tr role="row">
                                      <th  class="sorting">Date</th>
                                      <th  class="sorting">Trns No</th>
                                      <th  class="sorting">Type</th>
                                      <th  class="sorting">Amount</th>
                                      <th  class="sorting">Details</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
									if($PageVal['TotalRecords'] > 0){
									$Ctrl=1;
									foreach($PageVal['ResultSet'] as $AR_DT):
								?>
                                    <tr class="odd" role="row">
                                      <td class="sorting_1"><?php echo DisplayDate($AR_DT['trns_date']); ?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['trans_ref_no']; ?></td>
                                      <td class="sorting_1"><?php echo $AR_DT['trns_type']; ?></td>
                                      <td class="sorting_1"><?php echo number_format($AR_DT['trns_amount'],2); ?></td>
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
                              </div>
                            </div>
                            <div class="row">
                              
                              <div class="col-xs-12">
                                <div id="dynamic-table_paginate" class="dataTables_paginate paging_simple_numbers">
                                  <ul class="pagination">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          
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
<?php jquery_validation(); ?>
<script type="text/javascript">
	$(function(){
		$("#form-search").validationEngine();
		$('.date-picker').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
</html>
