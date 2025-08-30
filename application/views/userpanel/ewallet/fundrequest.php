<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$model = new OperationModel();
$Page = $_REQUEST[page]; if($Page == "" or $Page <=0){$Page=1;}
$today_date = getLocalTime();
  $segment = $this->uri->segment(4);
 
$request_id = _d($segment['request_id']);
$member_id = $this->session->userdata('mem_id');
$wallet_id = 3;//$this->OperationModel->getWallet(WALLET1);
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
	
	$QR_PAGES="SELECT * FROM ".prefix."tbl_fund_request  WHERE member_id='".$member_id."'	ORDER BY request_id DESC";
	$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);	

  if($segment =='BNB')
  {
   $file = "BNBnn.jpeg" ;   
   $address = "#" ;
   $title ="BNB Address";
  }
  elseif($segment =='BTC')
  {
   $file = "BTCnnn.jpeg" ;   
   $address = "#" ;
   $title ="BTC Address";
  }
  elseif($segment =='ETH')
  {
  $file = "ETHnnn.jpeg" ;    
  $address = "#" ;
  $title ="ETH Address";
  }
  elseif($segment =='TRX')
  {
   $file = "TRXnn.jpeg" ;   
   $address = "#" ;
   $title ="TRX Address";
  }
  elseif($segment =='USDT')
  {
   $file = "USDTnnn.jpeg" ;   
   $address = "#" ;
   $title ="USDT Address";
  }
  elseif($segment =='BTT')
  {
   $file = "BTTnnn.jpeg" ;   
   $address = "#" ;
   $title ="BTT Address";
  }
    elseif($segment =='BITRON')
  {
   $file = "BITRONnn.jpeg" ;   
   $address = "#" ;
   $title ="BITRON Address";
  }
   elseif($segment =='QRCODE')
  {
   $file = "QRCODEe.png" ;   
   $address = "#" ;
   $title ="QRCODE Address";
  }
  
  
 $img = BASE_PATH."upload/icon/QR/".$file;  


     

 ?>
 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
$this->load->view(MEMBER_FOLDER.'/layout/leftmenu'); 
?>

         
        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                           
                        </div>
                    </div>
                 
                </div>
                <!-- row -->

                <div class="row">
                 
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Fund Request  History</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                            <tr>
                  
                          <th style="padding: 4px;">Sn.</th>
                          <th  style="padding: 4px;">Mode  </th>
                             <th  style="padding: 4px;">Amount </th>
                              <th style="padding: 4px;">Deposit Date</th>
                          
                                  <th style="padding: 4px;">Remarks </th>
                                    <th style="padding: 4px;">Trn/#code  </th>
                                 <th style="padding: 4px;">File</th>
                                  <th style="padding: 4px;">Date & Time</th>
                                  <th style="padding: 4px;">Status</th>
                                    <th style="padding: 4px;">Reject Remarks</th>
                 
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
                                    
                                         <td class="sorting_1">INR<?php //echo $AR_DT['mode']; ?></td>
                                        <td class="sorting_1"><?php echo CURRENCY; ?> <?php echo $AR_DT['request_amount']; ?></td>
                                         
                                           <td class="sorting_1"><?php echo $AR_DT['deposit_date']; ?></td>
                                             <td><?php echo $AR_DT['remark']; ?></td>
                                               <td><?php echo $AR_DT['trn_hascode']; ?></td>
                                         
                                            <td  data-title="Files"><a href="<?php echo BASE_PATH;?>upload/requestfile/<?php echo $AR_DT['files']; ?>" target="_blank" >View Files</a></td>
                                  <td class="sorting_1"><?php echo getDateFormat($AR_DT['date_time'],"d M Y h:i"); ?></td>
                                  <td><?php if($AR_DT['status'] =='P'){echo '<div class="btn btn-warning">Pending</div>';}elseif($AR_DT['status'] =='S'){echo '<div class="btn btn-success">Success</div>';}else{ echo '<a   <div class="btn btn-danger">Rejected</div>';} ?></td>
                                 <td><?php echo $AR_DT['rejectremarks']; ?></td>
                             
                                    </tr>
                                    
                                    <?php endforeach; 
									}else{
									?>
									<tr class="odd" role="row">
										<td col mb-3span="7" align="center">No transaction found</td>
									</tr>
								<?php 
									}
								 ?>
                                  </tbody>
                                    </table>
                                        <div class="row">
<div class="col-md-6">
<div class="dataTables_info" id="dynamic-table_info" role="status" aria-live="polite">Showing <?php echo $PageVal['RecordStart']+1; ?> to <?php echo  count($PageVal['ResultSet']); ?> of <?php echo $PageVal['TotalRecords']; ?> entries
</div></div>

<div class="col-md-6">
<nav aria-label="Page navigation mb-3">
 <ul class="pagination justify-content-center">
                                    <?php echo $PageVal['FirstPage'].$PageVal['Prev10Page'].$PageVal['PrevPage'].$PageVal['NumString'].$PageVal['NextPage'].$PageVal['Next10Page'].$PageVal['LastPage'];?>
                                  </ul> </nav>
								  
								   </div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                   
                   
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
          
                    <script>
                    
                    
                    
               function selectmode(val)
              {
                  if(val == 'BEP20')
                  { // alert(val);
                    document.getElementById("trxShow1").style.display = "block";   
                    document.getElementById("trxShow2").style.display = "none";
                    document.getElementById("trxShow3").style.display = "none";
                    document.getElementById("trxShow4").style.display = "none";
                    document.getElementById("trxShow5").style.display = "none";
                    document.getElementById("trxShow6").style.display = "none";
                   
                  }else if(val == 'TRC20')
                  {
                    
                   document.getElementById("trxShow1").style.display = "none";   
                    document.getElementById("trxShow2").style.display = "block";
                    document.getElementById("trxShow3").style.display = "none";
                    document.getElementById("trxShow4").style.display = "none";
                    document.getElementById("trxShow5").style.display = "none";
                    document.getElementById("trxShow6").style.display = "none";
                  }else if(val == 'Polygon')
                  {
                    
                    document.getElementById("trxShow1").style.display = "none";   
                    document.getElementById("trxShow2").style.display = "none";
                    document.getElementById("trxShow3").style.display = "block";
                    document.getElementById("trxShow4").style.display = "none";
                    document.getElementById("trxShow5").style.display = "none";
                    document.getElementById("trxShow6").style.display = "none";
                  }else if(val == 'Paypal')
                  {
                    
                   document.getElementById("trxShow1").style.display = "none";   
                    document.getElementById("trxShow2").style.display = "none";
                    document.getElementById("trxShow3").style.display = "none";
                    document.getElementById("trxShow4").style.display = "block";
                    document.getElementById("trxShow5").style.display = "none";
                    document.getElementById("trxShow6").style.display = "none";
                  }else if(val == 'Skrill')
                  {
                    
                    document.getElementById("trxShow1").style.display = "none";   
                    document.getElementById("trxShow2").style.display = "none";
                    document.getElementById("trxShow3").style.display = "none";
                    document.getElementById("trxShow4").style.display = "none";
                    document.getElementById("trxShow5").style.display = "block";
                    document.getElementById("trxShow6").style.display = "none";
                  }else if(val == 'NetSuite')
                  {
                    
                     document.getElementById("trxShow1").style.display = "none";   
                    document.getElementById("trxShow2").style.display = "none";
                    document.getElementById("trxShow3").style.display = "none";
                    document.getElementById("trxShow4").style.display = "none";
                    document.getElementById("trxShow5").style.display = "none";
                    document.getElementById("trxShow6").style.display = "block";
                  }
                //   else
                //   {  //alert(val);
                //       //  document.getElementById("trxShow").style.display = "none";
                //       document.getElementById("trxShow1").style.display = "none";
                //       document.getElementById("trxShow2").style.display = "none";
                //       document.getElementById("trxShow3").style.display = "none";
                //       document.getElementById("trxShow4").style.display = "none";
                //       document.getElementById("trxShow5").style.display = "none";
                   
                //   }
              }
                     
                     
                     
</script>
<script>
        function copylink1()
        {
        var link = $("#cplink1").val();
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        console.log("Copied the text:", tempInput.value);
        alert('BEP20 Address Copied', 'success');
        document.body.removeChild(tempInput);
        }
        function copylink2()
        {
        var link = $("#cplink2").val();
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        console.log("Copied the text:", tempInput.value);
        alert('TRC20 Address Copied', 'success');
        document.body.removeChild(tempInput);
        }
        function copylink3()
        {
        var link = $("#cplink3").val();
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        console.log("Copied the text:", tempInput.value);
        alert('Polygon Address Copied', 'success');
        document.body.removeChild(tempInput);
        }
        function copylink4()
        {
        var link = $("#cplink4").val();
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        console.log("Copied the text:", tempInput.value);
        alert('Paypal Address Copied', 'success');
        document.body.removeChild(tempInput);
        }
        function copylink5()
        {
        var link = $("#cplink5").val();
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        console.log("Copied the text:", tempInput.value);
        alert('Skrill Address Copied', 'success');
        document.body.removeChild(tempInput);
        }
        function copylink6()
        {
        var link = $("#cplink6").val();
        var tempInput = document.createElement("input");
        tempInput.style = "position: absolute; left: -1000px; top: -1000px";
        tempInput.value = link;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        console.log("Copied the text:", tempInput.value);
        alert('NetSuite Address Copied', 'success');
        document.body.removeChild(tempInput);
        }
</script>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>