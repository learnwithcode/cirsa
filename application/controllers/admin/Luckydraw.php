<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Luckydraw extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	

	public function select()
	{
	    $model = new OperationModel();
		$form_data = $this->input->post();
		$i=0;
		if($form_data['submitdata']=='1' && $this->input->post()!=''){
		 $exp = $form_data['arr_ids'];//implode(',',$form_data['arr_ids']);
		
		 $date = $form_data['date'];
		 $insertdate = date('Y-m-d H:i:s');
		 foreach($exp as $id)
		 {
		 $countexist = $model->checkCount('tbl_lucky_drow','member_id',$id);
		if($countexist <= 0)
		{
		 $inserted_data = array(
		 'member_id'=>$id,
		 'amount'=>'2000',
		 'date_time'=>$date,
		 'insert_date'=>$insertdate,
		 'status'=>'Y');
		$this->SqlModel->insertRecord(prefix."tbl_lucky_drow",$inserted_data);
		$trans_no = UniqueId("TRNS_NO");
		$walletData = array(
							'trans_ref_no'=>$trans_no,
							'wallet_id'=>'2',
							'member_id'=>$id,	
							'trns_type'=>'Cr',	
							'trns_amount'=>2000,
							'isActive' =>'1',	
							'trns_remark'=>'Lucky Draw Dips',	
							'trns_for'=>'LCD',	
							'trns_date'=>$date
							
							);
		$this->SqlModel->insertRecord(prefix."tbl_wallet_trns",$walletData);
		$i++;
		}
		 }
			set_message("success","Lucky Draw has been done $i Members...");
			redirect_page("luckydraw","select",array());
		}
		$this->load->view(ADMIN_FOLDER.'/luckydraw/select',$data);	
	}
	public function winner()
	{
	    $model = new OperationModel();
		$form_data = $this->input->post();
		
		
		$this->load->view(ADMIN_FOLDER.'/luckydraw/winner',$data);	
	}
	public function pending()
	{
	    $model = new OperationModel();
		$form_data = $this->input->post();
		
		
		$this->load->view(ADMIN_FOLDER.'/luckydraw/pending',$data);	
	}
	
	
	
	
	
	
}
?>