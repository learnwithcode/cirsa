<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {
	
	public function __construct(){
	   parent::__construct();
	  $this->OperationModel->addVisitor();
	}
	
 
  	
	function aboutus(){
		$AR_META['page_title']="About-Us";
		$data['META'] = $AR_META;
		$this->load->view('aboutus',$data);
	}
	
	function plans(){
		$AR_META['page_title']="Business-Plan";
		$data['META'] = $AR_META;
		$this->load->view('plans',$data);
	}
	
	function debitcards(){
		$this->load->view('debitcards',$data);
	}
	
	function features(){
		$this->load->view('features',$data);
	}
	
	function howitworks(){
		$AR_META['page_title']="How-it-Works";
		$data['META'] = $AR_META;
		$this->load->view('howitworks',$data);
	}
	
	function referral(){
		$AR_META['page_title']= WEBSITE."|| Refferal";
		$data['META'] = $AR_META;
		$this->load->view('home',$data);
	}
	
	function support(){
		$this->load->view('support',$data);
	}
	
	function faq(){
		$AR_META['page_title']="F.A.Q";
		$data['META'] = $AR_META;
		$this->load->view('faq',$data);
	}
	
	function contact(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(1);
		if($form_data['submitContactUs']!='' && $this->input->post()!=''){
			$name = FCrtRplc($form_data['name']);
						
			$email = FCrtRplc($form_data['email']);
			$phone = FCrtRplc($form_data['phone']);
			$subject = FCrtRplc($form_data['subject']);
			$message = FCrtRplc($form_data['message']);
			if($name!='' && $email!=''){
				$data = array("member_id"=>($member_id>0)? $member_id:0,
					"name"=>$name,
					"email"=>$email,
					"mobile"=>($phone)? $phone:" ",
					"subject"=>$subject,
					"message"=>$message,
					"visitor_ip"=>$_SERVER['REMOTE_ADDR']
				);
				$contact_id = $this->SqlModel->insertRecord(prefix."tbl_contacts",$data);
				if($contact_id>0){
					set_message("success","Thank you for contacting us, our customer support team contact you shortly");
					header("Location: ".BASE_PATH.""); exit;
				}else{
					set_message("warning","Unable to send your request , please try again");
					header("Location: ".BASE_PATH.""); exit;
				}
			}else{
				set_message("warning","Invalid details , Please enter valid details");
				header("Location: ".BASE_PATH.""); exit;
			}
		}
	}
	
	function privacy(){
		$this->load->view('privacy',$data);
	}
	
	function testimonial(){
		$AR_META['page_title']="Testimonials";
		$data['META'] = $AR_META;
		$this->load->view('testimonial',$data);
	}
	
	function bitcoin(){
		$AR_META['page_title']="Whai is Bitcoin";
		$data['META'] = $AR_META;
		$this->load->view('bitcoin',$data);
	}
	
}
?>