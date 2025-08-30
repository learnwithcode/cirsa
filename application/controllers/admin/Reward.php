<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reward extends MY_Controller {
	
	public function __construct(){
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	 
	}

	
	public function targetachive(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(ADMIN_FOLDER.'/reward/targetachive',$data);
	}
	
	
	public function targetview(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(ADMIN_FOLDER.'/reward/targetview',$data);
	}
	public function updatetarget(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		if($form_data['submittarget']=='1' && $this->input->post()!='')
		{
			
			
			if($form_data['targetId'] > 0)
			{
			
			}
			else
			{
			   $targetName = $form_data['targetName'];
			   $fdate= $form_data['fdate'];
			   $edate= $form_data['edate'];
			   $cdate = date('Y-m-d H:s:i');
			   $posted_data = array('targetName'=>$targetName,
			                        'fdate'=>$fdate,
									'edate'=>$edate,
									'cdate'=>$cdate,
									'status'=>'1');
				if($edate > $fdate)
				{ 					
			    $lastEndDate = $model->getlastEndDate();
				$ldate = date('Y-m-d',strtotime($lastEndDate));
				
					if($fdate > $ldate || $lastEndDate =='')
					{
					  $this->SqlModel->insertRecord(prefix."tbl_target",$posted_data);
					  set_message("success","Successfully Added New Target...");
				      redirect_page("reward","targetview",array());
					}
					else
					{
					set_message("warning","From Date should be greater last End Date [".$ldate."]...");
				    redirect_page("reward","updatetarget",array());
					}						
			    
				}
				else
				{
				set_message("warning","End Date should be greater than From Date...");
				redirect_page("reward","updatetarget",array());
				}
			}
		}
		$this->load->view(ADMIN_FOLDER.'/reward/addnewtarget',$data);
	}
	
	public function targettype(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(ADMIN_FOLDER.'/reward/targettype',$data);
	}
	
	public function updatetype(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		if($form_data['submittarget']=='1' && $this->input->post()!='')
		{
			//PrintR($form_data);die;
			
			if($form_data['typeId'] > 0)
			{
			
			}
			else
			{
			
			   $target_id = $form_data['targetId'];
			   $type_name = $form_data['type_name'];
			   $type = $form_data['type'];
			   $designation = $form_data['designation'];
			   $point = $form_data['point'];
			   $fdate= $form_data['fdate'];
			   $edate= $form_data['edate'];
			   $cdate = date('Y-m-d H:s:i');
			   $posted_data = array('target_id'=>$target_id,
			                        'type_name'=>$type_name,
									'type'=>$type,
									'designation'=>$designation,
									'point' =>$point,
			                        'fdate'=>$fdate,
									'edate'=>$edate,
									'cdate'=>$cdate,
									'status'=>'1');
				if($edate > $fdate)
				{ 					
			    $lastEndDate = $model->gettargetbyId($target_id);
				$tfdate = date('Y-m-d',strtotime($lastEndDate['fdate']));
				$tedate = date('Y-m-d',strtotime($lastEndDate['edate']));
				
				    if(($fdate >= $tfdate && $fdate <= $tedate)  || ($edate >= $tfdate && $edate <= $tedate))
					{
					  $this->SqlModel->insertRecord(prefix."tbl_target_type",$posted_data);
					  set_message("success","Successfully Added New Target...");
				      redirect_page("reward","targettype/"._e($target_id),array());
					}
					else
					{
					set_message("warning","From Date  & End Dateshould be between [".$tfdate."] & [".$tedate."]...");
				    redirect_page("reward","updatetype/"._e($target_id),array());
					}						
			    
				}
				else
				{
				set_message("warning","End Date should be greater than From Date...");
				redirect_page("reward","updatetype/"._e($target_id),array());
				}
			}
		}
		$this->load->view(ADMIN_FOLDER.'/reward/addnewtype',$data);
	}
	
	public function achivers(){
	
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		
		$this->load->view(ADMIN_FOLDER.'/reward/achivers',$data);
	}
	
	public function checkachivers()
	{
	$model = new OperationModel();
	 
	$QR_PAGES= "SELECT * FROM tbl_target_type where feed_status ='N'";
	$res = $this->SqlModel->runQuery($QR_PAGES);
    $udate = date('Y-m-d H:i:s');
	$curr_date = date('Y-m-d');
	PrintR($res);die;
	foreach($res as $list){
    $fdate = $list['fdate'];
	$edate = $list['edate'];
    $status = $list['feed_status'];
	$type_id = $list['type_id'];
	$type = $list['type'];
	$targetId = $list['target_id'];
	$point = $list['point'];
	if($curr_date > $fdate && $curr_date > $edate)
	{
	    
/*	if($status =='N'){
	
	$QR_PAGES= "SELECT * FROM tbl_members";
	$memres = $this->SqlModel->runQuery($QR_PAGES);
	 foreach($memres as $mem)
	 {	 
	  $member_id = $mem['member_id'];
	  $userId = $mem['user_id'];
	  $left  = $model->getrightleft($member_id,"L",$fdate,$edate);
	  $right = $model->getrightleft($member_id,"R",$fdate,$edate);
							if($left >= $point and $right >= $point)
							{
							$achiversId = $model->checkExistAchivers($member_id,$targetId,$type_id,$type);
							if($achiversId > 0) {
							
//	$this->SqlModel->updateRecord(prefix."tbl_target_achive",array('type_id'=>$type_id,'Tleft'=>$left,'Tright'=>$right,),array("achiver_id"=>$achiversId));
							}
							else
							{
							$posted_data = array('member_id'=>$member_id,
							                     'user_id'=>$userId,
							                     'target_id'=>$targetId,
												 'type_id'=>$type_id,
												 'type'=>$type,
												 'Tleft'=>$left,
												 'Tright'=>$right,
												 'udate'=>$udate
												 

							);

						//	$this->SqlModel->insertRecord(prefix."tbl_target_achive",$posted_data);
							}
							}
	}
	
//	$this->SqlModel->updateRecord(prefix."tbl_target_type",array('feed_status'=>'Y'),array("type_id"=>$type_id));
	die('done');
	}*/
	
//	PrintR($list);
							
	}
	else
	{
	PrintR($list);
	}
	
	}
	PrintR($targetData);
	die;
	}
	
	
}
