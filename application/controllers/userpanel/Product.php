<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {
	
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isMemberLoggedIn()){
			 redirect(BASE_PATH);		
		}
	}

	
	 
	public function invoice(){
		$model = new OperationModel();
		
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT mem.*,sub.subcription_id as sub_id , sub.order_no as orderId , sub.date_from as subdate , pin.mrp as price , pin.product as product_name,pin.unit as unit,pin.product_id as productId,pin.prod_pv as pv from tbl_members as mem left join tbl_subscription as sub on mem.member_id = sub.member_id left join tbl_pintype as pin on sub.type_id = pin.type_id WHERE mem.member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['Mem']=$fR;

		//echo "<pre>";print_r($data);die;
		$this->load->view(MEMBER_FOLDER.'/product/invoice',$data);
	}
		public function product_invoice(){
		$model = new OperationModel();
	 
		$this->load->view(MEMBER_FOLDER.'/product/product_invoice',$data);
	}

	public function joining_product(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		//echo "<pre>";print_r($data);die;
		$this->load->view(MEMBER_FOLDER.'/product/joiningProduct',$data);
	}
		 public function delivery_detail()
	{
		$this->load->view(MEMBER_FOLDER."/product/courier_status", $data);
		
	}		 
	 
		
    public function product_purchase()
	{
		$this->load->view(MEMBER_FOLDER."/product/product_purchase", $data);
		
	}
	public function purchase_history()
	{
		$this->load->view(MEMBER_FOLDER."/product/purchase_history", $data);
		
	}
	 
 /*        public function cart(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/product/cart',$data);
		
		}
		 public function checkout(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/product/checkout',$data);
		
		} 
		 public function orderRequestList(){
		$model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/product/orderRequestList',$data);
		
		} 
		 public function confirm() {
	    $model = new OperationModel();
		
		$form_data = $this->input->post();
		$member_id = $this->session->userdata('mem_id');
			if($form_data['ConfirmPayment']==1 && $this->input->post()!=''){
			   $total = $this->getcartdata();
			   $total_amount  = $total['total'];
			   $trns_date = InsertDate(getLocalTime());
			   $trans_no = UniqueId("TRNS_NO");
		       if($form_data['type']=='R')
			   {  
			    $Rwallet = $model->getCurrentBalancewal($member_id,'2',"","");
				$available = $Rwallet['net_balance'];
			    if($available >= $total_amount)
				{
				$this->add_customer_order('R');
				$model->wallet_transaction('2',"Dr",$member_id,$total_amount,'Repurchase',$trns_date,$trans_no,"1","ORDER");
				set_message("success","You have successfully placed your order");
				redirect_member("product","repurchase_history",array());
				}
				else
				{
				set_message("warning","You Have low balance in your R-wallet");
				redirect_member("product","checkout",array());
				}
			   }
			   elseif($form_data['type']=='E')
			   { 
			    $Ewallet = $model->getCurrentBalancewal($member_id,'1',"","");
				$available = $Ewallet['net_balance'];
				if($available >= $total_amount)
				{
			 	$this->add_customer_order('E');
				 $model->wallet_transaction('1',"Dr",$member_id,$total_amount,'Repurchase',$trns_date,$trans_no,"1","ORDER");
			 
			 
				 
				set_message("success","You have successfully placed your order");
				redirect_member("product","repurchase_history",array());
				
				}
				else
				{
				set_message("warning","You Have low balance in your E-wallet");
				redirect_member("product","checkout",array());
				}
			   }
			   elseif($form_data['type']=='P')
			   { 
			    $Ewallet = $model->getCurrentBalancewal($member_id,'4',"","");
				$available = $Ewallet['net_balance'];
				if($available >= $total_amount)
				{
			 	$this->add_customer_order('P');
				 $model->wallet_transaction('4',"Dr",$member_id,$total_amount,'Repurchase',$trns_date,$trans_no,"1","ORDER");
			 
			 
				 
				set_message("success","You have successfully placed your order");
				redirect_member("product","repurchase_history",array());
				
				}
				else
				{
				set_message("warning","You Have low balance in your P-wallet");
				redirect_member("product","checkout",array());
				}
			   }
			   elseif($form_data['type']=='O')
			   {
			   
			   }
			   else 
			   {
			   	set_message("warning","Something goes to wrong, please try again");
				redirect_member("product","cart",array());
			   }
			  
			
			}
		}
	     public function add_customer_order($type) {
		if( $this->cart->total_items() > 0 )
		{
		$today_date = InsertDate(getLocalTime());	
		 $member_id = $this->session->userdata('mem_id');
            $data_order = 
				   array(
				   'member_id'  => $member_id,
				   'type'    => $type,
				   'date_time' => $today_date,
				  'order_date'=>$today_date
				 
				);
				
	 
				$orderId = $this->SqlModel->insertRecord(prefix."tbl_order",$data_order);	
	 			
				
				foreach($this->cart->contents() as $items)
				{
		 
						$data = array(
							'order_id'      => $orderId,							
							'products_id'    => $items['id'],
							'product_name'   => $items['origname'],						 
						 	'total_price'    =>$items['subtotal'],				
							'product_price'  => $items['price'],						
							'quantity'       => $items['qty'],
							'added_date_time'=>$today_date
						);
				 	$this->SqlModel->insertRecord(prefix."tbl_orders_products",$data);
						
			 
				
					
				}
				
			  
				$this->cart->destroy();
		 
					
		}
		
	}
	     public function joining_product(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

	 
		$this->load->view(MEMBER_FOLDER.'/product/joiningProduct',$data);
	}
	     public function repurchase_product(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		 
		$this->load->view(MEMBER_FOLDER.'/product/repurchase_product',$data);
	}
		 public function purchase(){
		$model = new OperationModel();
	
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$productId = _d($segment['productId']);
        $product = $model->getproductbyid($productId);
		
	
		  $exist = $model->checkProductExist($member_id,$productId);
		 
		if($exist <= 0)
		{
		
		$today_date = getLocalTime();
		$trans_no = UniqueId("TRNS_NO");
		$orderData = array('product_id'=>$productId,
		                   'trns_no'=>$trans_no,
						   'member_id'=>$member_id,
		                   'mrp'=>$product['product_mrp'],
						   'dmrp'=>$product['product_dmrp'],
						   'product_name'=>$product['product_name'],
						   'product_bv'=>$product['product_bv'],
						   'status'=>'P',
						   'date_time'=>$today_date);
            
		$this->SqlModel->insertRecord(prefix."tbl_order",$orderData);
	//	$model->wallet_transaction('1','Dr',$member_id,$productdp,'REPURCHASE PRODUCT',$today_date,$trans_no,"1","REPURCHASE");
		set_message("success","successfully added a product.");
		redirect_member("product","repurchase_product",array());
		}
		else
		{
		set_message("warning","This product already added your order history.");
		redirect_member("product","repurchase_product",array());
		} 
		set_message("warning","unauthorised access.");
		redirect_member("product","repurchase_product",array());
	}
	     public function AddOrder() {
	$model = new OperationModel();
	$today_date = getLocalTime();
	$trans_no = UniqueId("TRNS_NO");
	$ordId = $this->input->post('ordId');
	$qua = $this->input->post('qua');
	$member_id = $this->session->userdata('mem_id');
	$LDGR = $model->getCurrentBalance($member_id,'1','','');
    $netamount = (int)$LDGR['net_balance'];
	
	$OrderDetail = $model->getOrderById($ordId);
	$DP  =  $OrderDetail['dmrp']* $qua;
	$MRP = $OrderDetail['mrp']* $qua;
	$PV  =  $OrderDetail['product_bv']* $qua;

	if($netamount >=  $DP)
	{
	 $updated_Data = array('mrp'=>$MRP,'dmrp' => $DP,'quantity'=>$qua,'product_bv'=>$PV,'status'=>'S','order_date'=>$today_date);
	 $this->SqlModel->updateRecord(prefix."tbl_order",$updated_Data,array("order_id"=>$ordId));
	
	  $model->wallet_transaction('1','Dr',$member_id,$DP,'REPURCHASE PRODUCT',$today_date,$trans_no,"1","REPURCHASE");
	 echo '1';
	}
	else
	{
	echo '2';
	}
	
	}
         public function repurchase_history(){
		$model = new OperationModel();
		$form_data = $this->input->post();
		$segment = $this->uri->uri_to_assoc(2);
		$member_id = $this->session->userdata('mem_id');
		$QR_CHECK = "SELECT first_name AS fn from tbl_members WHERE member_id='".$member_id."'";
		$fR = $this->SqlModel->runQuery($QR_CHECK,true); 
		$data['first_name']=$fR;

		//echo "<pre>";print_r($data);die;
		$this->load->view(MEMBER_FOLDER.'/product/repurchase_history',$data);
	}
	     public function add_to_cartAjax() {
	$product_id = $this->input->post('pid');
	$model = new OperationModel();	
    $pres       =  $model->get_product($product_id);
		 
 	if( is_array($pres) && !empty($pres))
		{
			
			$qty         = applyFilter('NUMERIC_GT_ZERO',$this->input->post('qty'));		
			$qty         = ($qty > 0) ? $qty: 1;		
			$cart_price  = ( $pres['product_dmrp']!= '0.0000') ? $pres['product_dmrp'] : $pres['product_mrp'];
							
			$is_exits_inot_cart = $this->check_product_exits_into_cart($pres);
		
			$cart_total      = $this->cart->total();
			if( $is_exits_inot_cart)
			{	 
				$this->session->set_userdata(array('msg_type'=>'warning'));
				$this->session->set_flashdata('warning',$this->config->item('cart_product_exist'));								
	 
				$data['msg']= 'already added to your cart ';
				$data['price'] = 'Rs. '.number_format($cart_total,2);
				$data['total'] = count($this->cart->contents());
				$data['name'] = url_title($pres['product_name']);
				echo json_encode($data);
				
			}else
			{					 						
				 
				$img = $model->get_img($pres['product_id']); 
				$cart_data  = array(
				'id'             => $pres['product_id'],		   
				'qty'            => $qty,
			 
				'price'          => $cart_price,
				'product_price'  => $pres['product_mrp']*$qty,
				'discount_price' => $pres['product_dmrp']*$qty,
				'name'           => $pres['product_name'],
				'origname'       => $pres['product_name'],												
                'bv' => $pres['product_bv'], 
				'pid'            => $pres['product_id'],												
				'img'            => $img												
			 
				);
						
				$this->cart->insert($cart_data);
			 
				$this->session->set_userdata(array('msg_type'=>'success'));
				$this->session->set_flashdata('success',$this->config->item('cart_add'));
		 
				$cart_total      = $this->cart->total();
				$data['msg'] = 'Successfully added to your cart ';
				$data['price'] = 'Rs. '.number_format($cart_total,2);
				$data['list']=$this->getcartitem();
				$data['total'] = count($this->cart->contents());
				$data['name'] = url_title($pres['product_name']);
				echo json_encode($data);
			}	
			
			
		} 
	}
         public function check_product_exits_into_cart($pres) {	
        $cart_array =  $this->cart->contents(); 
	  	$insert_flag = FALSE;
		
 
	  if( is_array($cart_array) && !empty($cart_array))
	  {  
 	   	foreach($this->cart->contents() as $item )
		{
				if(array_key_exists('pid' ,$item ))
				{								
						if( $item['pid']==$pres['product_id'] )
						{
								 						
							 $insert_flag=TRUE;					
						
						} 
						
						
				}else
					{
						
						$insert_flag=FALSE;	
								
					}	
						
		       }
	  }
	  
	  
		 
		return $insert_flag;
   }
      	 public function Ajax_empty_cart() {
		$this->cart->destroy();
	     echo true;
		
	}
	
	public function getcartitem()
	{
	 if($this->cart->total_items() > 0 ) { 
             foreach($this->cart->contents() as $items)
            {  
		 $data .= '<li><a href="javascipt:void(0);"><div class="clearfix"><span class="pull-left"><img src="'.BASE_PATH.'upload/product/'.$items['img'].'" class="msg-photo" alt="'.$items['name'].'">&nbsp;&nbsp;'.$items['name'].'</span><span class="pull-right badge badge-info">&#8377; &nbsp;'.$items['price'].' </span></div></a></li>';
										
			  }
			  }else
			   { 
							 $data .= '<img src="'.BASE_PATH.'assets/shopping.gif" class="editable img-responsive" alt="Empty">';
			   }
										
		return $data;						 
	}
	
	public function updatecartajax()
	{
	$qty = $this->input->post('qty');
	$rowid =  $this->input->post('rowid');
	$data = array(
				'rowid' => $rowid,
				'qty' => $qty
			);
	
			$this->cart->update($data);
			
			foreach($this->cart->contents() as $items)
            {
			if($items['rowid']==$rowid)
			{
			$datacart['price'] = 'Rs. '.$items['subtotal'];
			}
			}
			 $cart_total      = $this->cart->total();
		 
			$datacart['totalprice'] = 'Rs. '.number_format($cart_total,2);
			$datacart['check'] =$cart_total;
			$total = $this->getcartdata();
			$datacart['net_imt']=$total['total'];
	        $datacart['items']=$total['items'];
			echo json_encode($datacart);
	}
	
	
    public function remove_item()
	{
		$data = array(
		 'rowid' =>$this->input->post('id'),
		 'qty' => 0
		);
	 
		
		$this->cart->update($data);	
		 
 
			    $cart_total      = $this->cart->total();
				$data['msg'] = 'Successfully remove from your cart ';
				$data['price'] = 'Rs. '.number_format($cart_total,2);
				$data['total'] = count($this->cart->contents());
				$data['check'] =$cart_total;
				$data['list']  =$this->getcartitem();
				$total = $this->getcartdata();
				$data['net_imt']=$total['total'];
	            $data['items']=$total['items'];
				echo json_encode($data); 
		
	}
	
	public function getcartdata()
	{
	 $data['total']='';
	 $data['items']='';
	 	if($this->cart->total_items() > 0 ) { 
            foreach($this->cart->contents() as $items)
            {
			 $total   += ($items['price'] * $items['qty']);
			 $items1 += $items['qty'];
			 }
			 	 $data['total']=$total;
	              $data['items']=$items1;
		   }
		   
	     return $data;
	}
	*/ 
	public function getwalletBalUser()
	{
		$model = new OperationModel();
		
	 $user_id =  $this->input->post('user_id');
	 
		 
      if($user_id !='' && $this->input->post()!=''){
		$memberId = $model->getMemberId($user_id);
		$wallet_id = $this->OperationModel->getWallet(WALLET1);
	 
	$LDGR = $model->getCurrentBalancewal($memberId,$wallet_id,"","");
	$LDGR1 = $model->getCurrentBalancewal($memberId,'2',"",""); 
    $LDGR2 = $model->getCurrentBalancewal($memberId,'3',"",""); 
	$Data['Ewallet']  =  number_format($LDGR['net_balance'],2);
	$Data['Pwallet']  =  number_format($LDGR1['net_balance'],2);
    $Data['Rwallet']  =  number_format($LDGR2['net_balance'],2);
	$Data['Ewal']  =   $LDGR['net_balance'];
	$Data['Pwal']  =  $LDGR1['net_balance'];
    $Data['Rwal']  =  $LDGR2['net_balance'];
	 echo json_encode($Data);
		 }
		 
	
	}
	
	public function getselectedProduct()
	{
	    $model = new OperationModel();
	    $data =  $this->input->post('data');
		$status =  $this->input->post('status');
	 	$Echeck =  $this->input->post('Echeck');
		$Pcheck =  $this->input->post('Pcheck');
		$Rcheck =  $this->input->post('Rcheck');		
		$franchise_id = $this->session->userdata('franchise_id'); 
	    $k =1;
	 
	    $product_data = explode(',',$data);
	
	 
 
      if($status==1 && $this->input->post()!=''){
	   foreach( $product_data as $product)
	 {
	 if($k==1)
	 $StrWhr .= 'product_id='.$product;
	 else
	  $StrWhr .= ' or product_id='.$product;
	 $k++;
	 }  
	  $QR_PAGES ="SELECT * FROM `tbl_product`  WHERE   $StrWhr ";
	 $PageVal = DisplayPages($QR_PAGES, 500, $Page, $SrchQ);
	 echo "<msg>"; 
	 ?>
	 
	 <div class="panel-body list">
<div class="table-responsive project-list">
<table class="table table-striped">

			<thead>
			<tr>
		 
			<th class="text-center" width="15%">Image</th>
			<th class="text-center" width="25%">Product Name</th>
			<th class="text-center" width="15%">Unit Price</th>
			<th class="text-center" width="15%">Quantity</th>
		    <th class="text-center" width="15%">Total BV</th>
			<th class="text-center" width="15%">Total</th>
		 
			
			</tr>
	 
										
			</thead>
			<tbody>
			 
					<?php	
					$i=1;   
           	if($PageVal['TotalRecords'] > 0){
			 $Ctrl=$PageVal['RecordStart']+1;
			 foreach($PageVal['ResultSet'] as $AR_DT) 
            {
			   if($Rcheck =='true')
			   {
			     $TotalMrp += $AR_DT['r_mrp'] ;
				 $mrp = $AR_DT['r_mrp'] ;
				 
				 $TotalBV +=$AR_DT['r_bv'];
				  $product_bv = $AR_DT['r_bv'];
			   }
			   
			   else
			   {
			     $TotalMrp += $AR_DT['p_mrp'] ;
				 $mrp = $AR_DT['p_mrp'] ;
				 
				 $TotalBV +=$AR_DT['p_bv'];
				 $product_bv = $AR_DT['p_bv'];
			   }
			   
			   
             
            ?> 
				
				   <input   type="hidden"  name="hsn_code[]" value="<?php echo $AR_DT['hsn_code'];?>"   />  
						<input   type="hidden"  name="mrp[]" value="<?php echo $mrp;?>"   />  
					<!-- 	<input   type="hidden"  name="base_price[]" value="<?php echo $AR_DT['base_amt'];?>"   />  
						<input   type="hidden"  name="tax[]" value="<?php echo $AR_DT['tax'];?>"   />  
						<input   type="hidden"  name="tax_amt[]" value="<?php echo $AR_DT['tax_amt'];?>"   />  -->
						<input   type="hidden"  name="Product_name[]" value="<?php echo $AR_DT['product_name'];?>"   />  
						<input   type="hidden" id="product_bv<?php echo $i;?>" name="product_bv[]" value="<?php echo $product_bv;?>"   />  
						<input   type="hidden"  name="Product_Id[]" id="Product_Id[]" value="<?php echo $AR_DT['product_id'];?>"   />  
						<input type='hidden' id="MRP_<?php echo $i;?>" name="prod_mrp[]" value="<?php  echo $mrp;?>">
						
						
			<tr id="<?php echo $i;?>">
                    <td class="text-center"><a href="#"><img width="70px" src="<?php echo BASE_PATH.'upload/product/'.$AR_DT['image'];?>" alt="<?php echo $AR_DT['product_name'];?>" title="<?php echo $AR_DT['product_name'];?>" class="img-thumbnail" /></a></td>
                    <td class="text-center"><a href="javascript:void(0);"><?php echo $AR_DT['product_name'];?></a><br />
                     </td>
                    <td class="text-center">&#8377; <?php echo $mrp;?> /-</td>
                    <td class="text-center" width="200px">
				 
				 
		 	     <div class="left-content-product">
						     <div id="product">
						     <div class="form-group box-info-product">
					                          <div class="option quantity">
                                                  
                                                    <div class="input-group quantity-control" unselectable="on" style="-webkit-user-select: none;">
                                                     
                <input class="form-control" type="text" min='1'   name="qty[]" id="qty<?php echo $i;?>" value="1" style="float: left;height: 40px;  line-height: 40px; margin: 0; width: 100px; border: 1px solid #bdc2c9; border-radius: 0; z-index: 0;padding: 0 35px; text-align: center;">
                                                        
  <span class="input-group-addon"   style="position: absolute; display: block; overflow: hidden;line-height: 40px; background: none; border: none; width: 40px;padding: 0; cursor: pointer;"  onclick="getnum('qty<?php echo $i;?>','A','<?php echo $mrp;?>','subtotal<?php echo $i;?>','tproduct_bv<?php echo $i;?>','<?php echo  $product_bv;?>');">-</span>
   <span class="input-group-addon "  style="position: absolute;display: block;overflow: hidden;line-height: 40px;background: none;border: none;width: 40px;padding: 0;cursor: pointer; margin-left: 59px;"  onclick="getnum('qty<?php echo $i;?>','B','<?php echo $mrp;?>','subtotal<?php echo $i;?>','tproduct_bv<?php echo $i;?>','<?php echo  $product_bv;?>');">+</span>
    
                                   
                           
                                                    </div>
                                                    
                                                   
                                                </div>
                                      </div>
                             </div>
                             </div>   
							 
							 
                             
					</td>
					 <td class="text-center" id="tproduct_bv<?php echo $i;?>"> <?php echo $product_bv;?> /-</td>
                    <td class="text-center" id="subtotal<?php echo $i;?>">&#8377; <?php echo $mrp;?> /-</td>
					
           </tr>
            <?php $i++;}}?>
			
			
			 <tr id="grand-total" style="background-color: antiquewhite;">
                   <td class="text-right" colspan="3" ><strong>Total </strong></td>
                    <td class="text-center"> <strong ><span id="items"><?php echo $i-1;?></span> </strong></td>
                     <td class="text-center"><strong><span id="totalBVV"><?php echo $TotalBV;?></span> /- </strong></td>
                     <td class="text-center"><strong>&#8377;<span id="net_imt"><?php echo $TotalMrp;?></span> /- </strong></td>
					 <input type='hidden' id="AR_PRODUCT" value="<?php echo $i-1;?>">
					   
                    <input type="hidden" id="product_dmrp_Total" value="<?php echo $TotalMrp;?>"  />
             </tr>
			
		 
			       
						</tbody>
 </table>
 
  <hr />
		<div class="wizard-actions">
 <button class="btn btn-danger " type="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"  >
	<i class="ace-icon fa fa-angle-double-left icon-on-right"></i>	 	Back
													</button>
		
		<button class="btn btn-success " type="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" > <!--onclick="getWalletBal();"-->
		Next
		<i class="ace-icon fa fa-angle-double-right icon-on-right"></i>												</button>
		</div>
			</div>
			</div>

	 <?php  
	  
	  echo "</msg>";
	  } 
		
	}
	
    public function confirmSale()
		 {
		$model = new OperationModel();	 
		 
		        $data = $this->input->post();
		         $del_type     = $data['del_type'];
		        $user_id      = $data['user_id'];
				$Echeck       = $data['Echeck'];
				$Pcheck       = $data['Pcheck'];
			    $Rcheck       = $data['Rcheck'];
				$qty          = $data['qty'];
				$Prod_id      = $data['Prod_id'];
				$Product_name = $data['Product_name'];
				$prod_mrp     = $data['prod_mrp'];
				$product_bv   = $data['product_bv'];
				$Ewal         = $data['Ewal'];
				$Pwal         = $data['Pwal'];
				$Rwal         = $data['Rwal'];
				$name         = $data['name'];
				$address      = $data['address'];
				$city         = $data['city'];
				$state       = $data['state'];
				$pin         = $data['pin'];
				$submitSale  = $data['submitSale'];
				$franchise_id = $data['franchise_id'];
				$product_dmrp_Total = $data['product_dmrp_Total'];
				$member_id= $model->getMemberId($user_id);
				
				$hsn_code = $data['hsn_code'];
							 
		$pv='';$k=0;
		foreach($product_bv as $val)
		{
		 $pv +=$val*$qty[$k];
		 $k++;
		}			
		$unit='';
		foreach($qty as $val)
		{
		 $unit +=$val;
		}	
		$Tmrp='';
	//	$Franchise  = $model->getFranchise($franchise_id);
// 			if(strtoupper($Franchise['state'])==strtoupper($state) or (strtoupper($state) =='DELHI'))
	 
// 		{
// 		$flag ='C';
// 		}
// 		else
// 		{
// 		$flag ='I';
// 		}

	    $flag ='I';
		if($Echeck=='true')
		{
		$wallet ='E';
		}
		if($Rcheck=='true')
		{
		$wallet ='R';
		}
		else
		{
		$wallet ='P';
		}
		
// 		if($del_type=='true')
//  		{
//  		$del_type ='S';
//   		}
//  		else
//   		{
//   		$del_type ='C';
//  		} 

            $del_type ='C';
		 $today_date    = InsertDate(getLocalTime());	
		  
            $data_order =array(
					//	'franchise_id' => $franchise_id,
						'member_id'    => $member_id,
						'user_id'      => $user_id,
						'name'         => $name,
						'address'      => $address,
						'city'         => $city, 
						'flag'         => $flag, 
						'delivery_type'     => $del_type,
						'state'        => $state,
						'payment_by'   => $wallet,
						'pin'          => $pin,
						'total_pv'     => $pv,
						'total_price'  => $product_dmrp_Total,
						'total_unit'   => $unit,
						'status'       => 'N',
						'order_by'       => 'U',
 						'date_time'    => $today_date
	  		           );
				
	 
			 	$sale_id = $this->SqlModel->insertRecord(prefix."tbl_sale",$data_order);	
	 			
				
		 	for($i=0; $i< count($Prod_id);$i++)
				{ 
			    $data = array( 
							'sale_id'        => $sale_id,							
							'products_id'    => $Prod_id[$i],
							'product_name'   => $Product_name[$i],						 
						 	'total_price'    => $prod_mrp[$i]*$qty[$i],	
							'hsn_code'       => $hsn_code[$i],	
							'product_price'  => $prod_mrp[$i],						
							'quantity'       => $qty[$i],
							'added_date_time'=> $today_date
						   );
				 
					 
					$this->SqlModel->insertRecord(prefix."tbl_sale_product",$data);
					$product_id = $Prod_id[$i];
					//$A_quantity = $model->get_available_quantity($franchise_id,$product_id);
					//$quantity = $A_quantity	- $qty[$i];
					
			       // $this->SqlModel->updateRecord(prefix."tbl_product_franchise",array("quantity"=>$quantity),array("franchise_id"=>$franchise_id,"product_id"=>$product_id));
				
					
				}  
				
			    $trans_no = UniqueId("TRNS_NO");
				if($Echeck =='true')
				{
			$model->wallet_transaction('1',"Dr",$member_id,$product_dmrp_Total,'Product Purchase[Company]',$today_date,$trans_no,"1","PURCHASE");
				}
							   
				elseif($Rcheck =='true')
				{
			$model->wallet_transaction('3',"Dr",$member_id,$product_dmrp_Total,'Product Purchase[Company]',$today_date,$trans_no,"1","PURCHASE");
				} 
				else
				{
				 $model->wallet_transaction('2',"Dr",$member_id,$product_dmrp_Total,'Product Purchase[Company]',$today_date,$trans_no,"1","PURCHASE");	 
				}
		// $trans_no = UniqueId("TRNS_F_NO");
		// $model->wallet_transaction_franchise('1',"Cr",$franchise_id,$product_dmrp_Total,'Product Sale['.$user_id.']',$today_date,$trans_no,"1","SALE");		
		 echo "true";

		 }
		 public function view_purchase_product()
		 {
	    $model = new OperationModel();
		$this->load->view(MEMBER_FOLDER.'/product/view_purchase_product',$data);
		 }


}
