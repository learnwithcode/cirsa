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
	
$QR_PAGES="SELECT tn.* FROM ".prefix."tbl_news AS tn   WHERE isDelete>0 $StrWhr ORDER BY tn.news_id DESC";
$PageVal = DisplayPages($QR_PAGES, 50, $Page, $SrchQ);
	
?>
 

	<?php  $this->load->view(MEMBER_FOLDER.'/layout/header'); 
$this->load->view(MEMBER_FOLDER.'/layout/pagehead',$d['web_title']='Dashboard'); 
?>
<style>
  section#news-main {
    padding: 0 0 100px 0;
    display: inline-block;
    overflow: hidden;
    width: 100%;
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    list-style: none;
    text-decoration: none;
    outline: none;
  }

  body {
    margin: 0;
    padding: 0;
    font-size: 16px;
    font-weight: 400;
    color: #333;
    background-color: #fff;
  }

  section#news-main .heading-main {
    background-image: url(<?php echo BASE_PATH; ?>assetsuser/images/lake-between-mountains.jpg);
    background-repeat: no-repeat;
    background-position: center;
    width: 100%;
    height: 100%;
    display: inline-block;
    background-size: cover;
    color: #fff;
    padding: 50px 0;
    background-attachment: fixed;
    position: sticky;
    top: 0;
    left: 0;
    z-index: 99;
  }

  section#news-main .img-content-main {
    margin-top: 50px;
  }

  @media (max-width:768px) {
      section#news-main .card {
      width: 100%;
      max-width: 100%;
      margin-bottom: 30px !important;
    }

      section#news-main .card img {
      width: 100%;
      max-width: 100%;
    }

    section#news-main .discription-main {
      width: 100%;
      max-width: 100%;
    }
  }
   section#news-main p{
      text-align: left;
      margin-bottom:10px;
  }
</style>

      <section id="news-main">
    <div class="row">
      <div class="col-sm-12">
        <div class="heading-main">
          <h2 style=" font-size: 80px;text-align: center;">Latest News</h2>
        </div>
      </div>
    </div>
    <div class="container mt-3">
           <?php 
			 	 	if($PageVal['TotalRecords'] > 0){
				  		$Ctrl=1;
						foreach($PageVal['ResultSet'] as $AR_DT):
			       ?>
      <div class="img-content-main">
        <div class="row" style="align-items: center;">
          <div class="col-sm-12 col-md-6">
            <div class="card" style="width: 100%; max-width: 800px; margin: 0 auto;">
              <img class="card-img-top" src="<?php echo BASE_PATH.'upload/news/'.$AR_DT['news_img'];?>" alt="Card image"
                style="width:100%;object-fit: cover;height: 240px;">
            </div>

          </div>
          <div class="col-sm-12 col-md-6">
            <div class="discription-main"
              style="width: 100%;max-width: 800px; margin: 0 auto 0  auto; padding: 15px; box-shadow: 0 0 4px #bbbaba;">
                
              <p><?php echo $AR_DT['news_detail'];?>
              
               </p>
               
             
            </div>
          </div>
        </div>
      </div>
       <?php $Ctrl++; endforeach; ?>
                        <?php  }else{ ?>
                        <tr>
                          <td colspan="6" class="center text-danger"><i class="ace-icon fa fa-times bigger-110 red"></i> &nbsp; No record found</td>
                        </tr>
                        <?php } ?>
    </div>
  </section>
 <footer id="footer-main" >
                   
                    </footer>
			<?php $this->load->view(MEMBER_FOLDER.'/layout/footer'); ?>