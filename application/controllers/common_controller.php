<?php
class Common_controller
{
	private $CI;
	public function __construct()
	{
		$this->CI = & get_instance();
	}

	public function get_view_data($type = null, $id = null)
	{
		if(is_null($id))
			return false;

		switch ($type)
		{
			case 'so':
				return $this->get_so_view_data($id);
				break;
				
			case 'shipment':
				return $this->get_shipment_view_data($id);
				break;

			case 'purchase':
				return $this->get_purchase_view_data($id);
				break;

			case 'return_authorization':
				return $this->get_return_auth_view_data($id);
				break;

			case 'refunds':
				return $this->get_refund_view_data($id);
				break;

			default:
				return false;
				break;
		}

	}

	private function get_so_view_data($so_id = null)
	{
		$this->CI->load->model('salesorder_model');
		
		$result_set = $this->CI->salesorder_model->get_where(array('id' => $so_id));
		 
         //print_r($result_set); exit;
         
		if(!$result_set->num_rows())
			return FALSE;
		$data = array();
		 
		$data['so_id'] = $so_id;
		
		$data['so_details'] = $result_set->row_array();
        
		$payment_term = $this->CI->salesorder_model->get_where(array('id' => $data['so_details']['credit_type']),"name","credit_type")->row_array();
		
        $data['payment_term_name'] = $payment_term['name'];
        
		$customer_id = isset($data['so_details']['customer_id'])?$data['so_details']['customer_id']:0;
		$data['user_details'] = $this->CI->salesorder_model->get_where(array('id' => $customer_id), '*', 'customer')->row_array();
        $contact = $this->CI->salesorder_model->get_where(array('customer_id' => $customer_id),"name,email","customer_contact")->row_array();
        $data['user_details']['email']          = $contact['email'];
        $data['user_details']['customer_name']  = $contact['name'];

		$this->CI->load->model('shipment_model');
		 
		//check if the current SO is having Shipment(s)
		$result_set = $this->CI->shipment_model->get_where(array('so_id' => $so_id));
		
		$data['shipment_count'] = $result_set->num_rows();
		
        $shipment_company = $this->CI->shipment_model->get_where(array("so_id" => $so_id))->row_array();
        
        $data['so_details']['carrier'] = $shipment_company['ship_company'];
        //print_r($data['product_details']); exit;

		$data['product_details'] = $this->CI->_get_products_details($so_id);
        
        $data['carrier'] = $this->CI->db->query("select * from carrier where 1=1")->result_array();

		if($data['shipment_count'] == 0)
		{
			$order = array();
			foreach ($data['product_details'] as $row)
			{
				$order[$row['product_id']]['sku'] 		    = $row['sku'];
				$order[$row['product_id']]['product_name']  = $row['product_name'];
				$order[$row['product_id']]['unit_price']    = $row['unit_price'];
				$order[$row['product_id']]['api_sku'] 		= $row['api_sku'];
				if(isset($order[$row['product_id']]['qty']))
					$order[$row['product_id']]['qty'] += $row['qty'];
				else
					$order[$row['product_id']]['qty'] = $row['qty'];
			}
			
			$data['order'] = $order;
			//$data['manual_process'] = $this->CI->load->view('frontend/sales_orders/_partials/manual_process', $data, TRUE);
		}

		//get reconciled charges
	//	$this->CI->load->model('sales_order_prices_model');
	//	$data['reconcile_charges'] = $this->CI->sales_order_prices_model->get_total_charge_by_so($so_id);
		
		//order total
		$data['order_total']   = ($data['so_details']['total_amount']);
		$data['order_details'] = $this->CI->load->view('frontend/sales/_partials/details', $data, TRUE);
		$data['bulk_actions']  = array('' => 'select', 'issue_ra' => 'Issue RA for selected items', 'refund' => 'Refund selected items');
		 
		//get attachments
		//$data['attachments'] = $this->CI->salesorder_model->get_where(array('so_id' => $so_id), '*', 'sales_order_attachments')->result_array();
		//$general_settings 	 = get_settings($this->CI->sales_channel_id, 'layout');
		
		//$data['so_attachment_url'] = isset($general_settings['so_attachment_url'])?$general_settings['so_attachment_url']:'';

	//	$data['notes'] = $this->CI->get_notes('sales_order', $so_id);
		 
		//get related links
		$data['related_links'] = $this->get_related_links($so_id, array('cur_page' => 'sales_order', 'cur_page_id' => $so_id));
		
		//get order based alert
	//	$data['so_alert'] = $this->get_alert('so_type', array('so_id' => $so_id));
		 
		//check if this orders is involved with vendor that order type is 'web', to show alert message.
	//	$data['vendor_alert'] = $this->get_alert('vendor_type', array('so_id' => $so_id));
        
        //get shipping country
        $shipping_address         = get_address_by_contact_id( $data['so_details']['shipping_address_id'], 'data' );
	  	$data['shipment_country'] = $shipping_address['country'];

		return $data;
	}
	
	private function get_shipment_view_data($shipment_id = null)
	{

		$this->CI->load->model('shipment_model');
		$this->CI->load->model('vendor_model');
		$this->CI->load->model('salesorder_model');
		$this->CI->load->model('sales_order_item_model');
		$this->CI->load->model('purchase_model');
		
		$so_id = $po_id = '';

		//get shipment details
		$result = $this->CI->shipment_model->get_where(array('id' => $shipment_id));

		if(!$result->num_rows())
			return FALSE;
		
		$data['shipment_details'] = $result->row_array();
		$data['shipment_id']      = $shipment_id;
		$data['so_id'] = $so_id   = $data['shipment_details']['sales_order_id'];
		$data['po_id'] = $po_id   = $data['shipment_details']['purchase_order_id'];

		//get vendor details
		$data['vendor_details']   = $this->CI->vendor_model->get_where(array('id' => $data['shipment_details']['vendor_id']))->row_array();

		$check_qty = 0;
		//get shipment line items
		if(!empty($so_id)){
			$data['line_items'] = $this->CI->shipment_model->get_shipment_items($shipment_id);
		}else{
			$data['line_items'] = $this->CI->purchase_model->get_po_item_details($po_id);
			$check_qty = 1;
		}
		
		$data['check_qty'] = $check_qty;

		if(!count($data['line_items']))
			return FALSE;

		$total = 0;
		foreach ($data['line_items'] as $row)
		{
			//for received qty based total.
			//($check_qty==1)?check_received_qty($row['quantity'],$row['quantity_received']):$row['quantity'];
			$qty = $row['quantity']; 

			$total += ($qty*$row['unit_price']);
		}

		$data['sub_total'] = (float)$total;

		if(!empty($so_id)){

			$data['order_details'] = $so_details = $this->CI->salesorder_model->get_where(array('id' => $so_id))->row_array();

			$customer_id = isset($so_details['customer_id'])?$so_details['customer_id']:0;
			$data['user_details'] = $this->CI->salesorder_model->get_where(array('id' => $customer_id), '*', 'user')->row_array();

			$data['total']  = (float)($total+$so_details['total_shipping']+$so_details['total_tax']-$so_details['total_discount']);


			$show_image = 'N';
			$names = '';

			if($so_details['sales_channel_id'] == 3)
			{
				//Zing Products to display and Template Based on Sales Channel Id.
				$zing_products = array(7765,7762,7763,7764);
				$zing_items = $this->CI->sales_order_item_model->get_zing_products_by_soid($so_id,$zing_products);

				if(count($zing_items)>0)
				{
					foreach($zing_items as $items)
					{
						$names.= $items['name'].',';
					}
					$names = trim($names,',');
					$show_image = 'Y';
				}
			}

			//get sales channel details
			$data['sales_channel_details'] = get_settings($so_details['sales_channel_id'], 'general');
			$data['show_image'] = $show_image;
			$data['names']      = $names;

			//get related links
			$data['related_links'] = $this->get_related_links($so_id, array('cur_page' => 'shipment', 'cur_page_id' => $shipment_id, 'vendor_id' => $data['shipment_details']['vendor_id']));


		}else{

			$this->CI->load->model('purchase_order_prices_model');

			$data['order_details'] = $po_details = $this->CI->purchase_model->get_where(array('id' => $po_id))->row_array();

			//get all extra charges
			//$data['reconciled_charges'] = $this->CI->purchase_order_prices_model->get_total_charge_by_po($po_id);

			//get Invoice fee
			$data['invoice_charges'] = $this->CI->purchase_order_prices_model->get_total_charge_by_po($po_id,array('Drop Ship/Handling','Shipping and Handling','Other'));

			//get drop-ship fee
			$data['dropship_fee'] = $this->CI->purchase_model->get_dropship_fee($po_id);

			$data['total']  = (float)($total+$data['dropship_fee']+$data['invoice_charges']);
			
			//get related links
			$data['related_links'] = $this->get_manualpo_related_links(array('cur_page' => 'shipment', 'cur_page_id' => $shipment_id, 'vendor_id' => $data['shipment_details']['vendor_id']),$po_id);
		}		


		$this->CI->load->config('status_list');
		$data['status_options'] = $this->CI->config->item('shipment', 'status_list');;
		
		//get order based alert
		$data['so_alert'] = $this->get_alert('so_type', array('so_id' => $so_id));
			
		//check if this orders is involved with vendor that order type is 'web', to show alert message.
		$data['vendor_alert'] = $this->get_alert('vendor_type', array('so_id' => $so_id, 'vendor_id' => $data['vendor_details']['id']));
		
		$data['notes'] = $this->CI->get_notes('shipment', $shipment_id);

		//$data['logs'] = $this->CI->get_logs('shipment_id', $shipment_id);

		return $data;

	}

	private function get_purchase_view_data($po_id)
	{
		$this->CI->load->model('purchase_model');
		$this->CI->load->model('vendor_model');
		$this->CI->load->model('purchase_order_prices_model');

		//get po details
		$data['po_details']   = $this->CI->purchase_model->get_where(array('id' => $po_id))->row_array();

		if(!count($data['po_details']))
			return FALSE;

		$data['po_id'] = $po_id;

		//get vendor details
		$data['vendor_details'] = $this->CI->vendor_model->get_where(array('id' => $data['po_details']['vendor_id']))->row_array();

		if(!count($data['vendor_details']))
			return FALSE;

		//get product details
		$data['product_details'] = $this->CI->purchase_model->get_po_item_details($po_id);

		$data['general'] = current($data['product_details']);

		$total_ship_weight = 0;
		$total = 0;
		foreach ($data['product_details'] as $row)
		{
			//for quantity received based total
			//check_received_qty($row['quantity'],$row['quantity_received']);
			$qty = $row['quantity']; 

			$total_ship_weight += ($row['quantity'] * $row['shipping_weight']);

			$total += ($qty*$row['unit_price']);
		}

		$data['sub_total'] = (float)$total;

		//get both additional and Invoice charges
		$data['reconciled_charges'] = $this->CI->purchase_order_prices_model->get_total_charge_by_po($po_id);

		//get Invoice fee
		$data['invoice_charges'] = $this->CI->purchase_order_prices_model->get_total_charge_by_po($po_id,array('Drop Ship/Handling','Shipping and Handling','Other'));

		//get additional fee
		$data['additional_charges'] = $this->CI->purchase_order_prices_model->get_total_charge_by_po($po_id,array("Inbound 3rd party UPS","Inbound 3rd party Fedex","Outbound to FBA","Other Charge"));
		
		//get drop-ship fee
		$data['dropship_fee'] = $this->CI->purchase_model->get_dropship_fee($po_id);

		$data['order_total'] = ($data['sub_total']+$data['invoice_charges']+$data['dropship_fee']);

		$data['other_charges'] = ($data['invoice_charges']+$data['additional_charges']);

		//get additional charges list
		$data['additional_charges_info'] = $this->CI->purchase_order_prices_model->get_all_charges($po_id,array("Inbound 3rd party UPS","Inbound 3rd party Fedex","Outbound to FBA","Other Charge"));
		
		//calculating shipping calc
		$data['total_weight'] = $total_ship_weight;

		$shipping_calc = $this->shipping_calc($data['product_details'],$data['other_charges'],$total_ship_weight);

		$data['shipping_calc'] = $shipping_calc;

		//get po attachments
		$data['attachments']  = $this->CI->purchase_model->get_attachments($po_id);
		$general_settings 	  = get_settings($this->CI->sales_channel_id, 'layout');
		
		$data['po_attachment_url'] = isset($general_settings['po_attachment_url'])?$general_settings['po_attachment_url']:'';
		
		//get related links
		if(!empty($data['po_details']['sales_order_id'])){
			$data['related_links'] = $this->get_related_links($data['po_details']['sales_order_id'], array('cur_page' => 'purchase_order', 'cur_page_id' => $po_id, 'vendor_id' => $data['po_details']['vendor_id']));
		}else{
			$data['related_links'] = $this->get_manualpo_related_links(array('cur_page' => 'purchase_order', 'cur_page_id' => $po_id, 'vendor_id' => $data['po_details']['vendor_id']),$po_id);
		}
	
		$this->CI->load->config('status_list');
		$data['status_options'] = $this->CI->config->item('po', 'status_list');;
		
		//get order based alert
		$data['so_alert'] = $this->get_alert('so_type', array('so_id' => $data['po_details']['sales_order_id']));
			
		//check if this orders is involved with vendor that order type is 'web', to show alert message.
		$data['vendor_alert'] = $this->get_alert('vendor_type', array('so_id' => $data['po_details']['sales_order_id'], 'vendor_id' => $data['po_details']['vendor_id']));
		

		$data['notes'] = $this->CI->get_notes('purchase_order', $po_id);

		//$data['logs'] = $this->CI->get_logs('purchase_order_id', $po_id);

		return $data;
	}

	public function shipping_calc($products,$shipping_charge,$total_ship_weight){

		$items_array = array();

		foreach ($products as $row)
		{
			$total_weight = $row['quantity'] * $row['shipping_weight'];
			$percent_weight = ($total_ship_weight!=0)?round((($total_weight/$total_ship_weight)*100),2):0;
			$total_ship_price = round((($percent_weight*$shipping_charge)/100),2);
			$unit_ship_price = round(($total_ship_price/$row['quantity']),2);

			$actual_price = ($row['unit_price'] + $unit_ship_price);

			$items_array[] = array('product_id'=>$row['product_id'],'sku' => $row['sku'],'qty'=> $row['quantity'],'product_weight' => $row['shipping_weight'],'total_weight' => $total_weight,'percent_weight' => $percent_weight, 'total_ship_price' => $total_ship_price, 'unit_ship_price' => $unit_ship_price, 'actual_price' => $actual_price); 

		}

		return $items_array;
	}

	private function get_return_auth_view_data($return_auth_id = null)
	{

		$this->CI->load->model('return_product_model');
		$this->CI->load->model('return_model');

		//get line-item(s)
		$products = $this->CI->return_product_model->getProductsByReturnOrders(array($return_auth_id));

		//get user details
		$result = $this->CI->return_model->get_return_with_user_details($return_auth_id);

		$data = array(
				'line_items' 		=> $products,
				'return_auth_id' 	=> $return_auth_id,
				'customer_name'   => $result['first_name'].' '.$result['last_name'],
				'status'  		=> $result['status']
		);

		//get related links
		$data['related_links'] = $this->get_related_links($result['sales_order_id'], array('cur_page' => 'return', 'cur_page_id' => $return_auth_id));

		$data['notes'] = $this->CI->get_notes('return', $return_auth_id);

		//$data['logs'] = $this->CI->get_logs('returns', $return_auth_id);

		return $data;

	}

	private function get_refund_view_data($refund_id = null)
	{
		$this->CI->load->model('refund_product_model');
		$this->CI->load->model('refund_model');
		$this->CI->load->model('salesorder_model');

		$products = $this->CI->refund_product_model->get_refund_products_by_refund_id($refund_id);

		$result = $this->CI->refund_model->get_refund_with_user_details($refund_id);

		$details = current($products);

		$sub_total = 0;
		foreach ($products as $row)
		{
			$sub_total += ($row['refunded_quantity']*$row['unit_price']);
		}


		$data = array(
				'line_items' => $products,
				'refund_id' => $refund_id,
				'customer_name'   => $result['first_name'].' '.$result['last_name'],
				'refunded_amount' => $result['refunded_amount'],
				'status'  => $result['order_status'],
				'sales_channel_id' => $result['sales_channel_id'],
				'sub_total' => $sub_total,
				'total_shipping' => $details['total_shipping'],
				'total_tax' => $details['total_tax'],
				'total_discount' => $details['total_discount'],
				'return_id'	=> $result['return_id']
		);

		//get related links
		$data['related_links'] = $this->get_related_links($result['sales_order_id'], array('cur_page' => 'refund', 'cur_page_id' => $refund_id));

		$data['notes'] = $this->CI->get_notes('refund', $refund_id);

		$data['so_details'] = $this->CI->salesorder_model->get_where( array('id' => $result['sales_order_id']) )->row_array();
		//$data['logs'] = $this->CI->get_logs('refunds', $refund_id);

		return $data;
	}

	function get_manualpo_related_links($args = array(),$po_id){

		$menu_items = array();

		$links  = '<ul class="nav nav-list bs-docs-sidenav affix-top" data-spy="affix" data-offset-top="443">';
		$links .= '<li class="header greenbg_title">Related Links</li>';
		$part1 = '';
		$part2 = '';
		$part3 = '';

		$vendor_id = isset($args['vendor_id']) ?$args['vendor_id']:null;
		//Manual PO shipment 
		$this->CI->load->model('purchase_model');
		$poship = $this->CI->purchase_model->get_manual_po_related_records($po_id, $vendor_id);
		
		if(is_null($vendor_id))
			return FALSE;

		if((int)$poship['purchase_order_id']){
			
			$part1  = '<li><a href="'.site_url("purchase").'"><i class="icon-chevron-right-small"></i> Back to Purchase Order list</a></li>';

			$part2 .='<li class="submenu">
						<a href="javascript:;"><i class="icon-chevron-right-small"></i>Puchase Order </a>
						<ul>';
							$part2 .= '<li><a href="'.site_url("purchase/view/{$poship['purchase_order_id']}").'">PO#'.$poship['purchase_order_id'].'</a></li>';
				$part2.=	'</ul>
					</li>';

		}

		if($poship['shipment_id'])
		{				
			$shipment_ids = explode(',', $poship['shipment_id']);
			$shipment_ids = array_unique($shipment_ids);
			$part2 .= '	<li class="submenu">
							<a href="javascript:;"><i class="icon-chevron-right-small"></i>Shipment </a>
							<ul>';
							foreach ($shipment_ids as $id)
								$part2 .= '<li><a href="'.site_url("shipment/view/{$id}").'">Shipment#'.$id.'</a></li>';
					$part2.=	'</ul>
						</li>';				
		}


		$links .= $part1.$part2;

		if( isset($args['cur_page']) && isset($args['cur_page_id']) )
		{			
			$links .= " <li><a href='javascript:;' onclick='add_note(\"{$args['cur_page']}\", {$args['cur_page_id']})'><i class='icon-chevron-right-small'></i> Add Note</a></li>";

			$args['cur_page'] .= '_id';
			$links .= "<li><a href='javascript:;' onclick='show_logs(\"{$args['cur_page']}\", {$args['cur_page_id']})'><i class='icon-chevron-right-small'></i> Show Log History</a></li>
						";			
		}
		$links .= '</ul>';
		
		return $links;


	}

	function get_related_links($so_id, $args = array())
	{
		$menu_items = array();

		$links  = '<ul class="nav nav-list " >';
		$links .= '<li class="header greenbg_title">Related Links</li>';
		$part1 = '';
		$part2 = '';
		$part3 = '';

		$this->CI->load->model('salesorder_model');
		$vendor_id = isset($args['vendor_id']) ?$args['vendor_id']:null;
		$row = $this->CI->salesorder_model->get_related_records($so_id, $vendor_id);
		
		if(!count($row))
		{
			if(is_null($vendor_id))
				return FALSE;
			
			//Manual PO section goes here
			$part1  = '<li><a href="'.site_url("purchase").'"><i class="icon-chevron-right-small"></i> Back to Purchase Order list</a></li>';
			
		}
		else 
		{
			if((int)$row['sales_order_id'])
			{
				$part1  = '<li><a href="'.site_url("salesorder").'"><i class="icon-chevron-right-small"></i> Back to Sales Order list</a></li>';
				
				$part2 .= '	<li class="submenu">
								<a href="javascript:;"><i class="icon-chevron-right-small"></i>Sales Order </a>
								<ul>
									<li><a href="'.site_url("salesorder/view/{$row['sales_order_id']}").'">SO#'.$row['sales_order_id'].'</a></li>
								</ul>
							</li>';
				
			}
			
			if($row['shipment_id']){
				//$part1  = '<li><a href="'.site_url("shipment").'"><i class="icon-chevron-right-small"></i> Back to Shipment list</a></li>';
				
			//	$shipment_ids = explode(',', $row['shipment_id']);
			//	$shipment_ids = array_unique($shipment_ids);
			//	$part2 .= '	<li class="submenu">
					//			<a href="javascript:;"><i class="icon-chevron-right-small"></i>Shipment </a>
					//			<ul>';
					//			foreach ($shipment_ids as $id)
								//	$part2 .= '<li><a href="'.site_url("shipment/view/{$id}").'">Shipment#'.$id.'</a></li>';
					//	$part2.=	'</ul>
					//		</li>';

				
			}
			
			if($row['purchase_order_id'])
			{
				$part1  = '<li><a href="'.site_url("purchase").'"><i class="icon-chevron-right-small"></i> Back to Purchase Order list</a></li>';
				
				$po_ids = explode(',', $row['purchase_order_id']);
				$po_ids = array_unique($po_ids);
				$part2 .= '	<li class="submenu">
								<a href="javascript:;"><i class="icon-chevron-right-small"></i>Puchase Order </a>
								<ul>';
								foreach ($po_ids as $id)
									$part2 .= '<li><a href="'.site_url("purchase/view/{$id}").'">PO#'.$id.'</a></li>';
						$part2.=	'</ul>
							</li>';

				
			}
			
			if((int)$row['return_id'])
			{
				$part1  = '<li><a href="'.site_url("return_authorization").'"><i class="icon-chevron-right-small"></i> Back to Return Auth list</a></li>';
				
				$part2 .= '	<li class="submenu">
								<a href="javascript:;"><i class="icon-chevron-right-small"></i>Return Authorization </a>
								<ul>
									<li><a href="'.site_url("return_authorization/view/{$row['return_id']}").'">RA#'.$row['return_id'].'</a></li>
								</ul>
							</li>';

				
			}
			
			if((int)$row['refund_id'])
			{
				$part1  = '<li><a href="'.site_url("refunds").'"><i class="icon-chevron-right-small"></i> Back to Refunds list</a></li>';
				
				$part2 .= '	<li class="submenu">
								<a href="javascript:;"><i class="icon-chevron-right-small"></i>Refunds </a>
								<ul>
									<li><a href="'.site_url("refunds/view/{$row['refund_id']}").'">Refund#'.$row['refund_id'].'</a></li>
								</ul>
							</li>';

				
			}
			
		}
		
		$links .= $part1.$part2;

		if( isset($args['cur_page']) && isset($args['cur_page_id']) )
		{
			
			if((int)$row['sales_order_id'])
			{
				$links .= " <li><a href='javascript:void(0);' onclick='add_note(\"sales_order\", {$row['sales_order_id']})'><i class='icon-chevron-right-small'></i> Add Note</a></li>
							<li><a href='javascript:;' onclick='show_logs(\"sales_order_id\", {$row['sales_order_id']})'><i class='icon-chevron-right-small'></i> Show Log History</a></li>
							";
			}
			else
			{
				
				$links .= " <li><a  onclick='add_note(\"{$args['cur_page']}\", {$args['cur_page_id']})'><i class='icon-chevron-right-small'></i> Add Note</a></li>";
				
				$args['cur_page'] .= '_id';

				$links .= "<li><a href='javascript:void(0);' onclick='show_logs(\"{$args['cur_page']}\", {$args['cur_page_id']})'><i class='icon-chevron-right-small'></i> Show Log History</a></li>
							";
			}
		}
		$links .= '</ul>';
		
		return $links;
	}

	
	function get_alert($type = 'so_type', $args = array())
	{
		if(strcmp($type, '') === 0 || !count($args) || !isset($args['so_id']))
			return FALSE;
		
		$this->CI->load->model('salesorder_model');
		
		switch ($type)
		{
			case 'so_type':
				$query = $this->CI->salesorder_model->get_where(array('id' => $args['so_id'], 'type' => 'I'));
				if(!$query->num_rows())
					return FALSE;				
				return show_alert("International Order");
				
				break;
				
			case 'vendor_type':
				$where = array();
				if(isset($args['vendor_id']))
					$where = array('vendor.id' => $args['vendor_id']);
				$result = $this->CI->salesorder_model->get_external_vendors($args['so_id'], $where, TRUE);
				if(!count($result))
					return FALSE;
				
				$message = '';
				foreach ($result as $row)
				{
					if(strcmp($row['order_type'], 'web') === 0)
					{
						$message .= strcmp($message, '') === 0?'':'<br/>';
						$message .= "PO#{$row['po_id']}: You must place this order on the vendor's ";
						$message .= strcmp(trim($row['web_url']), '') === 0?'website':"<a target='_blank' href='".(strstr($row['web_url'],'http')?$row['web_url']:'http://'.$row['web_url'])."'>website</a>";
					}
					elseif(strcmp($row['order_type'], 'phone') === 0)
					{
						$message .= strcmp($message, '') === 0?'':'<br/>';
						$message .= "PO#{$row['po_id']}: You must place this order By calling vendor \"{$row['vendor_name']}\" over Phone ";
						$message .= strcmp(trim($row['order_phone']), '') === 0?'.':" : {$row['order_phone']}.";
					}
					elseif(strcmp($row['order_type'], 'fax') === 0)
					{
						$message .= strcmp($message, '') === 0?'':'<br/>';
						$message .= "PO#{$row['po_id']}: You must place this order By contacting vendor \"{$row['vendor_name']}\" over Fax";
						$message .= strcmp(trim($row['order_fax']), '') === 0?'.':" : {$row['order_fax']}.";
					}							
				}
				
				if(strcmp($message, '') === 0)
					return FALSE;
				
				return show_alert($message);
		}
	}

}

