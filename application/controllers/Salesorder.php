<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH."libraries/Admin_controller.php");

class Salesorder extends Admin_Controller 
{	
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
			
      $this->load->model(array('salesorder_model','purchase_model'));
      $this->load->model('admin_model');
	  $this->load->library('listing');
      $this->load->library('cart');    
	} 
	
     public function index()
     { 
        
        $this->layout->add_javascripts(array('listing'));  

        $this->load->library('listing');         
        $this->simple_search_fields      = array();
        $this->_narrow_search_conditions = array("shipping_order","business_name","salesman_id","customer_location","city","state","zipcode","payment_by","credit_type","total_amount","bol_instructions","so_instructions");
        
        $str = '<a href="'.site_url('salesorder/view/{id}').'" class="table-action"><i class="fa fa-eye"></i></a>
                ';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('salesorder_model', 'listing');

        if($this->input->is_ajax_request())
            $this->_ajax_output(array('listing' => $listing), TRUE);
        
        $this->data['bulk_actions']         = array('' => 'select', 'delete' => 'Delete');
        $this->data['simple_search_fields'] = $this->simple_search_fields;
        $this->data['search_conditions']    = $this->session->userdata($this->namespace.'_search_conditions');
        $this->data['per_page']             = $this->listing->_get_per_page();
        $this->data['per_page_options']     = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
        $this->data['search_bar']           = $this->load->view('frontend/sales/search_bar', $this->data, TRUE);        
        $this->data['listing']              = $listing;
        $this->data['grid']                 = $this->load->view('listing/view', $this->data, TRUE);
        $this->layout->view('frontend/sales/index');		
     }
    
    public function add( $edit_id ='')
    {
        $this->layout->add_javascripts(array('salesorder'));
        try
        {
            if($this->input->post('edit_id'))            
                $edit_id = $this->input->post('edit_id');

            $this->form_validation->set_rules('business_name','Business Name','trim|required');
            $this->form_validation->set_rules('credit_type','Credit Type','trim|required');
            $this->form_validation->set_error_delimiters('', '');
                
            if($this->form_validation->run()){
                $ins_data = array();
                $ins_data['business_name']          = $this->input->post('business_name');
                $ins_data['credit_type']            = $this->input->post('credit_type');
                $ins_data['web_url']                = $this->input->post('web_url');
                $ins_data['ups']                    = $this->input->post('ups');
                $ins_data['address_id']             = $this->input->post('address_id');
                $ins_data['status']                 = $this->input->post('status');
                
                if($edit_id){
                    $ins_data['updated_date'] = date('Y-m-d H:i:s'); 
                    //$ins_data['updated_id']   = get_current_user_id();    
                    $this->salesorder_model->update(array("id" => $edit_id),$ins_data);
                    $msg  = 'Salesorder updated successfully';
                }
                else
                {    
                    $ins_data['created_date'] = date('Y-m-d H:i:s'); 
                    $ins_data['updated_date'] = date('Y-m-d H:i:s');
                   // $ins_data['created_id']   = get_current_user_id();  
                    $this->salesorder_model->insert($ins_data);
                    $msg = 'Salesorder added successfully';
                }
                $this->session->set_flashdata('success_msg',$msg,TRUE);
                redirect('salesorder');
            }    
            else
            {
                $edit_data = array();
                $edit_data['id']                     = '';
                $edit_data['business_name']          = '';
                $edit_data['credit_type']            = '';
                $edit_data['web_url']                = '';
                $edit_data['ups']                    = '';
                $edit_data['address_id']             = '';
                $edit_data['status']                 = '';
            }
        }
        catch (Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();   
        }
        if($edit_id)
            $edit_data =$this->salesorder_model->get_where(array("id" => $edit_id))->row_array();
        
        $edit_data['address']    = $this->salesorder_model->get_where(array('created_id' => get_current_user_id()),"*","address")->result_array();
        
         
        $this->data['editdata']  = $edit_data;
        $this->layout->view('frontend/sales/add');
    }
    
    public function delete($del_id)
    {
        $access_data = $this->salesorder_model->get_where(array("id"=>$del_id),'id')->row_array();
        $output      = array();

        if(count($access_data) > 0){
            $this->salesorder_model->delete(array("id"=>$del_id));
            $output['message'] ="Record deleted successfuly.";
            $output['status']  = "success";
        }
        else
        {
           $output['message'] ="This record not matched by Inventory.";
           $output['status']  = "error";
        }
        $this->_ajax_output($output, TRUE);    
    }
    
    public function delete_customer($del_id)
    {  
        $output['message'] ="Record deleted successfuly.";
        $output['status']  = "success";
        $log = log_history("customer",$del_id,"customer","delete");
        $this->admin_model->delete(array("id"=>$del_id),"customer");
        $this->_ajax_output($output, TRUE);
    }

    public function shippingorder()
    {
      $this->data['products']            = $this->salesorder_model->get_where(array(),"*","product")->result_array();  
      $this->data['colors']              = $this->salesorder_model->get_where(array(),"*","product_color")->result_array();
      $this->data['forms']               = $this->salesorder_model->get_where(array(),"*","product_form")->result_array();
      $this->data['packages']            = $this->salesorder_model->get_where(array(),"*","product_packaging")->result_array();
          
      $this->layout->view('frontend/sales/shippingorder');  
    }
    
    public function search()
    {
        $this->data['users']   = $this->db->query("select * from customer where 1=1")->result_array();
        $this->data['credit']  = $this->db->query("select * from credit_type where 1=1")->result_array();
        $this->layout->view('frontend/sales/search');
    }
    
    public function calllog()
    {
        try
        {
            if($_POST){
                $ins_data = array();
                $ins_data['call_type']    = (isset($_POST['call_type']))?$_POST['call_type']:"";
                $ins_data['log_date']     = $_POST['call_time'];
                $ins_data['call_log']     = $_POST['call_log'];
                $ins_data['user_id']      = get_current_user_id();
                $ins_data['created_date'] = date("Y-m-d H:i:s");
            }
        }
        catch(Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();
        }
        $this->data['users']   = $this->db->query("select * from customer where 1=1")->result_array();
        $this->data['credit']  = $this->db->query("select * from credit_type where 1=1")->result_array();
        $this->layout->view('frontend/sales/calllog');
    }
    
    public function callback()
    {
        try
        {
            if($_POST){
                $ins_data = array();
                $ins_data['user_to_notify']     = $_POST['salesman_to_notify'];
                $ins_data['next_callback_date'] = $_POST['date_time'];
                $ins_data['created_date']       = date("Y-m-d H:i:s");
                $ins_data['cb_message']         = $_POST['callback_message'];
             }
        }
        catch(Exception $e)
        {
            
        }
        
        $this->data['users']  = $this->db->query("select * from customer where 1=1")->result_array();
        $this->data['credit']  = $this->db->query("select * from credit_type where 1=1")->result_array();
        $this->layout->view('frontend/sales/callback');
    }
    
    public function checkout($edit_id ='')
    {
        $this->layout->add_javascripts(array('salesorder','checkout'));
        
        try
        {
          if($this->input->post('edit_id'))            
            $edit_id = $this->input->post('edit_id');
           
          $this->form_validation->set_rules('customer_id','Please select Customer','trim|required');  
          $this->form_validation->set_rules('business_name','Business Name','trim|required');
          $this->form_validation->set_rules('first_name','Billing Firstname','trim|required');
          $this->form_validation->set_rules('last_name','Billing Lastname','trim|required');
          $this->form_validation->set_rules('email','Billing Email','trim|required');
          $this->form_validation->set_rules('mobile','Billing Phonenumber','trim|required');
          $this->form_validation->set_rules('address1','Billing Address 1','trim|required');
          $this->form_validation->set_rules('city','Billing City','trim|required');
          $this->form_validation->set_rules('state','Billing State','trim|required');
          $this->form_validation->set_rules('zipcode','Billing Zipcode','trim|required');
          $this->form_validation->set_rules('ship_first_name','Shipping Firstname','trim|required');
          $this->form_validation->set_rules('ship_last_name','Shipping Lastname','trim|required');
          $this->form_validation->set_rules('ship_mobile','Mobile','trim|required');
          $this->form_validation->set_rules('ship_address1','Shipping Address 1','trim|required');
          $this->form_validation->set_rules('ship_city','City','trim|required');
          $this->form_validation->set_rules('ship_state','State','trim|required');
          $this->form_validation->set_rules('ship_zipcode','Zipcode','trim|required');
         // $this->form_validation->set_rules('type','Type','trim|required');
          $this->form_validation->set_rules('shipping_type','Shipping Type','trim|required');
         // $this->form_validation->set_rules('credit_type','Credit Type','trim|required');
         // $this->form_validation->set_rules('order_status','Order Status','trim|required');
         // $this->form_validation->set_rules('carrier','Carrier','trim|required');
          $this->form_validation->set_error_delimiters('', '');
          
          $total = $this->cart->total();
          
          if($this->form_validation->run()){
              $ins_data = array();
              $ins_data['customer_id']            = $this->input->post('customer_id');
              $ins_data['salesman_id']            = get_current_user_id(); 
              $ins_data['shipping_type']          = $this->input->post('shipping_type');
              $ins_data['credit_type']            = $this->input->post('credit_type');  
              $ins_data['so_instructions']        = $this->input->post('so_instructions');
              $ins_data['bol_instructions']       = $this->input->post('bol_instructions');
              $ins_data['shipping_address_id']    = $this->input->post('shipping_address_id');
              $ins_data['billing_address_id']     = $this->input->post('billing_address_id');
             // $ins_data['type']                   = $this->input->post('type');
              $ins_data['order_status']           = "NEW";
              $ins_data['total_items']            = $this->cart->total_items();
              $ins_data['total_amount']           = $total;
              
              if($edit_id){
                $ins_data['updated_date'] = date('Y-m-d H:i:s'); 
                $ins_data['updated_id']   = get_current_user_id();    
                $this->salesorder_model->update(array("id" => $edit_id),$ins_data);
                log_history("sales_order",$edit_id,'Sales Order',"update");
                $msg  = 'Sales Order updated successfully';
                
              }
              else
              {   
                $ins_data['created_date'] = date('Y-m-d H:i:s'); 
                $ins_data['updated_date'] = date('Y-m-d H:i:s');
                $ins_data['created_id']   = get_current_user_id();  
                $so_new_id                = $this->salesorder_model->insert($ins_data,"sales_order");    
                log_history("sales_order",$so_new_id,'Sales Order',"insert");
                
                //add shipment data
                $ship_id       = $this->input->post('shipping_type');
                $get_ship_data = $this->salesorder_model->get_where(array("id" => $ship_id),"*","shipping_type")->row_array();
                
                $ship_data = array();
                $ship_data['so_id']         = $so_new_id;
                $ship_data['shipping_type'] = $get_ship_data['type'];
                $ship_data['order_status']  = $this->input->post('order_status');
                $ship_data['created_date']  = date('Y-m-d H:i:s'); 
                $ship_data['updated_date']  = date('Y-m-d H:i:s');
                $ship_data['created_id']    = get_current_user_id();  
                $ship_new_id                = $this->salesorder_model->insert($ship_data,"shipment");
                log_history("shipment",$ship_new_id,'Create Shipment',"insert");
                
                //items added to sales order item table
                $sale_items = $this->cart->contents();
                $sale_item  = array();
                foreach($sale_items as $skey => $svalue){
                   $get_vendor_data = $this->salesorder_model->get_where(array("product_id" => $svalue['id']),"*","vendor_price_list")->row_array();
                   
                   //create auto po 
                   if($get_vendor_data['stock_level']==0){
                     $form['so_id']              = $so_new_id; 
                     $form['ship_type_id']       = $ship_id;
                     $form['carrier_id']         = $this->input->post('carrier');
                     $form['location_id']        = $this->input->post('shipping_address_id');
                     $form['credit_type_id']     = $this->input->post('credit_type');
                     
                     $product = array();
                     $product[$get_vendor_data['vendor_id']][$svalue['id']] = array("unit_price" => $svalue['price'], "quantity" => $svalue['qty']);
                     $po_create_id = create_auto_po($product,$form);
                     log_history("purchase_order",$po_create_id,'Create Auto PO',"insert");
                   }
                   
                   $sale_item['product_id']   = $svalue['id'];
                   $sale_item['qty']          = $svalue['qty'];
                   $sale_item['item_status']  = "NEW";
                   $sale_item['unit_price']   = $svalue['price'];
                   $sale_item['so_id']        = $so_new_id;  
                   $sale_item['vendor_id']    = (isset($get_vendor_data['vendor_id']) && !empty($get_vendor_data['vendor_id']))?$get_vendor_data['vendor_id']:0;
                   $sale_item['shipment_id']  = $ship_new_id;
                   $sale_item['created_date'] = date('Y-m-d H:i:s'); 
                   $sale_item['updated_date'] = date('Y-m-d H:i:s');
                   $sale_item['created_id']   = get_current_user_id();
                   $sale_order_item_id        = $this->salesorder_model->insert($sale_item,"sales_order_item");
                   
                   log_history("sales_order_item",$sale_order_item_id,'Sales Order Item',"insert");
                }
                
                $this->data['so_id']       = $so_new_id;
                $order_status              = $this->salesorder_model->get_where(array("id" => $so_new_id),"customer_id,order_status","sales_order")->row_array();
                $this->data['order_status']= $order_status['order_status'];
                $this->data['od_items']    = $this->salesorder_model->get_sales_items($so_new_id);
                $this->data['billing']     = $this->salesorder_model->get_where(array("id" => $this->input->post('billing_address_id')),"*","address")->row_array();
                $this->data['shipping']    = $this->salesorder_model->get_where(array("id" => $this->input->post('shipping_address_id')),"*","customer_location")->row_array();
                $email_template            = $this->load->view("frontend/email/sales",$this->data,true);
                $cus_data                  = $this->salesorder_model->get_where(array("id" => $order_status['customer_id']),"email","customer_contact")->row_array();
                
                $sub   = "Order #".$so_new_id." Generated Successfully";  
                $cu_usr= get_user_data();
                // $email = new Email();
                // $email->send($cus_data['email'], $cu_usr['email'],$sub,$email_template,array());
                  
                $msg     = 'Sales Order created successfully';
                $edit_id =  $so_new_id;
                
              }
              $this->session->set_flashdata('success_msg',$msg,TRUE);
              $status  = 'success';
              
              redirect("salesorder/view/".$edit_id);
          }    
          else
          {
            $edit_data = array();
            $edit_data['id']                    = (!empty($edit_id))?$edit_id:'';
            $edit_data['customer_id']           = '';
            $edit_data['carrier']               = '';
            $edit_data['shipping_type']         = '';
            $edit_data['order_status']          = '';
            $edit_data['type']                  = '';
            $edit_data['credit_type']           = '';
            $edit_data['so_instructions']       = '';
            $edit_data['bol_instructions']      = '';
            $customer                           = array(    "business_name" => "",
                                                            "first_name" => "", 
                                                            "last_name" => "",
                                                            "email" => "",
                                                            "web_url" => "",
                                                            "phone" => "",
                                                            "address1" => "", 
                                                            "address2" => "", 
                                                            "city" => "", 
                                                            "state" => "",
                                                            "zipcode"=> "",
                                                            "ship_first_name" => "",
                                                            "ship_last_name" => "",
                                                            "ship_mobile" => "",
                                                            "ship_address1" => "",
                                                            "ship_city" => "",
                                                            "ship_state" => "",
                                                            "ship_zipcode" => ""
                                                        );
            $cartitems                          =  $this->cart->contents();      
            $edit_data['btn']                   = "Create Order";
            $saletype                           = 'create';                   
          }
        }
        catch (Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();
        }

        if($edit_id){
           $edit_data         = $this->salesorder_model->get_where(array("id" => $edit_id),"*","sales_order")->row_array();
           $customer          = $this->salesorder_model->get_vendors(array("a.id" => $edit_data['customer_id']));
           $cartitems         = $this->salesorder_model->get_sales_items($edit_data['id']);
           $saletype          = 'update';     
           $edit_data['btn']  = "Update Order";   
           $total             = $edit_data['total_amount'];
        }    
         
        $this->data['editdata']      = $edit_data;
        $this->data['customer_data'] = $customer;
        $this->data['saletype']      = get_sale_type();
        $this->data['shipping_type'] = get_shipping_type();
        $this->data['credit_type']   = get_credit_type();
        $this->data['cartitems']     = $cartitems;           
        $this->data['customer']      = $this->purchase_model->get_vendors();
        $this->data['carrier']       = get_carrier();
        $this->data['stype']         = $saletype;
        $this->data['total']         = $total;
        
        if($this->input->is_ajax_request()){
          $output  = $this->load->view('frontend/sales/checkout',$this->data,true);
          return    $this->_ajax_output(array('status' => $status ,'output' => $output, 'edit_id' => $edit_id), TRUE);
        }
        else
        {
          $this->layout->view('frontend/sales/checkout');
        } 
    }
    
    function view($so_id = null)
    {
        $this->layout->add_javascripts(array('salesorder','checkout'));
        
    	if(is_null($so_id) || !(int)$so_id)
    		redirect('sales_orders');
    	
    	include('common_controller.php');
    	
    	$obj = new common_controller();
    	$data = $obj->get_view_data('so', $so_id);

    	if($data === false)
    		redirect('salesorders');
    	
    	$this->data += $data;
    	
    	$this->data['content'] = $this->load->view('frontend/sales/_partials/view_content', $this->data, TRUE);
        //$output['content']     = $this->load->view('frontend/sales/view', $this->data, true);	
//    	
//        if($this->input->is_ajax_request())
//            $this->_ajax_output($output, TRUE);
//        else    
    	   $this->layout->view('frontend/sales/view', $this->data);	
    }
    
    function _get_products_details($so_id)
    {
    	$this->load->model('shipment_model');
    	
    	//check if the current SO is having Shipment(s) 
    	$result_set = $this->shipment_model->get_where(array('so_id' => $so_id));
  
    	//if no shipment found, fetch only products vendor-wise products
    	if(!$result_set->num_rows()){
    		$products = $this->salesorder_model->get_product_details_by_sales_order($so_id);
    		return $products;
    	}
    	
    	//fetch product details
    	$products = $this->salesorder_model->get_product_details_by_sales_order($so_id);
      
    	$vendors = array();
    	//if no records found, return empty array
    	if (count($products) == 0)
    		return $vendors;
    
    	//sort the products by vendor
    	foreach ($products as $id => $product)
    		$vendors[(int)$product['vendor_id']][] = $product;
            
    	 if($this->input->is_ajax_request()){
    	     $result_set = $this->CI->shipment_model->get_where(array('so_id' => $so_id));
		     $shipment_count = $result_set->num_rows();
             $this->data['shipment_count'] = $shipment_count;
           
           if($shipment_count == 0){  
        	   foreach($vendors as $row)
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
    			
    			$this->data['order']    = $order;
           }  
           $output['status'] = 'success';
    	   $output['content'] = $this->load->view("frontend/sales/_partials/details",$this->data,true);
    	   $this->_ajax_output($output, TRUE); 
    	 }  
         else
         {
            return $vendors;
         }   
    	   
    }
    
    function invoice($so_id) 
    {
         $so_data                = $this->salesorder_model->get_where(array("id" => $so_id),"salesman_id,shipping_address_id as shipping_id,billing_address_id as billing_id,customer_id,cod_fee,total_amount,credit_type","sales_order")->row_array();
         $ship_data              = $this->salesorder_model->get_where(array("so_id" => $so_id),"id,ship_date","shipment")->row_array();
         $so_data['shipment_id'] = $ship_data['id'];
         $so_data['ship_date']   = $ship_data['ship_date'];
         
         //create invoice
         $inv_id = create_auto_invoice($so_data);
         
         if(empty($inv_id))
            $this->session->set_flashdata('success_msg',"Doesn't create invoice",TRUE);
         else
            $this->session->set_flashdata('error_msg',"Invoice created successfully",TRUE);   
            
         redirect("salesorder/view/".$so_id);   
    }
    
    function change_ship_address($ship_addr_id = null,$so_id = 0, $action)
    {
    
        $this->load->model('address_model');

        try
        { 
            //get vendor_id
            $ship_addr_id = (!is_null($ship_addr_id) && (int)$ship_addr_id)?$ship_addr_id:0;
            
            if(!$ship_addr_id)
                throw new Exception("Please Create shipping address details.");
                
            if(!$so_id)
                throw new Exception("Sales Order is invalid.");
            
            $this->data['ship_addr_id'] = $ship_addr_id;            
                    
            //default values
            $output = array('status' => 'warning', 'message' => '');
            
            //default form values
            $price_list_info = array();
             
            if($this->data['ship_addr_id']){
                $tmp = get_address_by_contact_id($this->data['ship_addr_id'], 'data');
                $price_list_info = array_merge($price_list_info, $tmp);
                $price_list_info['ship_addr_id'] = $ship_addr_id; 
            }
            
            if($action == 'process'){       
                //set validation rules
                $this->form_validation->set_rules($this->get_validation_rules('ship_addr'));
            }
            
            //Need to work on this
            if($this->form_validation->run() == TRUE){
                $data = array();
                $data['name']               = $price_list_info['name']; 
                $data['address_1']          = $this->input->post('address1');
                $data['address_2']          = $this->input->post('address2');
                $data['phone']              = $this->input->post('phone');
                $data['city']               = $this->input->post('city');
                $data['state']              = $this->input->post('state');
                $data['zipcode']            = $this->input->post('zip');
                $data['country']            = $this->input->post('country');
                $data['created_date']       = date('Y-m-d H:i:s', local_to_gmt());
                $data['updated_date']       = date('Y-m-d H:i:s', local_to_gmt());
               
                //get so details
                $so_details = $this->salesorder_model->get_where(array('id' => $so_id))->row_array();
                
                $data['customer_id']        = $so_details['customer_id'];
                                
                if($this->data['ship_addr_id']){
                    $this->address_model->update(array("id" => $this->data['ship_addr_id']),$data,"customer_location");
                    $this->salesorder_model->update( array('id' => $so_details['id']), array("shipping_address_id" => $this->data['ship_addr_id']));
                    $price_list_info['shipping_address_id'] = $this->data['ship_addr_id'];
                    
                    log_history('sales_order',$so_details['id'],'Shipping Address','update');
                }                       
                $output['status']       = 'success';
                $output['message']      = 'Shipping Address has been updated successfully!';
            } 
            $this->data['price_list_info'] = $price_list_info; 
            $output['content'] = $this->load->view('frontend/sales/_partials/shipping_address', $this->data, TRUE);
        }
        catch(Exception $e)
        {
            $output = array('status' => 'error', 'message' => $e->getMessage());
        }
        
        if($this->input->is_ajax_request())
            $this->_ajax_output($output, TRUE);
         
        return $output;
     
  }
  
   function change_billing_address($bill_addr_id = null,$so_id = 0, $action)
    {
    
        $this->load->model('address_model');

        try
        { 
            //get vendor_id
            $bill_addr_id = (!is_null($bill_addr_id) && (int)$bill_addr_id)?$bill_addr_id:0;
            
            if(!$bill_addr_id)
                throw new Exception("Please Create billing address details.");
                
            if(!$so_id)
                throw new Exception("Sales Order is invalid.");
            
            $this->data['bill_addr_id'] = $bill_addr_id;            
                    
            //default values
            $output = array('status' => 'warning', 'message' => '');
            
            //default form values
            $price_list_info = array();
             
            if($this->data['bill_addr_id']){
                $tmp = get_customer_billing_address($this->data['bill_addr_id'], 'data');
                $price_list_info = array_merge($price_list_info, $tmp);
                $price_list_info['bill_addr_id'] = $bill_addr_id; 
            }
            
            if($action == 'process'){       
                //set validation rules
                $this->form_validation->set_rules($this->get_validation_rules('bill_addr'));
            }
            
            //Need to work on this
            if($this->form_validation->run() == TRUE){
                $data = array();
                $data['first_name']         = $this->input->post('first_name');
                $data['last_name']          = $this->input->post('last_name');
                $data['company']            = $this->input->post('company');  
                $data['address1']           = $this->input->post('address1');
                $data['address2']           = $this->input->post('address2');
                $data['phone']              = $this->input->post('phone');
                $data['city']               = $this->input->post('city');
                $data['state']              = $this->input->post('state');
                $data['zipcode']            = $this->input->post('zip');
                $data['country']            = $this->input->post('country');
                $data['created_date']       = date('Y-m-d H:i:s', local_to_gmt());
                $data['updated_date']       = date('Y-m-d H:i:s', local_to_gmt());
                             
                if($this->data['bill_addr_id']){
                    $this->address_model->update(array("id" => $this->data['bill_addr_id']),$data,"address");
                    $this->salesorder_model->update( array('id' => $so_details['id']), array("billing_address_id" => $this->data['bill_addr_id']));
                    $price_list_info['billing_address_id'] = $this->data['bill_addr_id'];
                    
                    log_history('sales_order',$so_details['id'],'Billing Address','update');
                }                       
                $output['status']       = 'success';
                $output['message']      = 'Billing Address has been updated successfully!';
            } 
            $this->data['price_list_info'] = $price_list_info; 
            $output['content'] = $this->load->view('frontend/sales/_partials/billing_address', $this->data, TRUE);
        }
        catch(Exception $e)
        {
            $output = array('status' => 'error', 'message' => $e->getMessage());
        }
        
        if($this->input->is_ajax_request())
            $this->_ajax_output($output, TRUE);
         
        return $output;
     
  }
    
  function get_validation_rules($type, $key = null)
  {
     
    $rules = array();
    if(strcmp($type, 'ship_addr') === 0){
        $rules['ship_addr']['name']        = array('field' => 'name',  'rules' => 'trim|required');
      //  $rules['ship_addr']['last_name']   = array('field' => 'last_name', 'rules' => 'trim|required');
        $rules['ship_addr']['address1']    = array('field' => 'address1', 'rules' => 'trim|required');
        $rules['ship_addr']['address2']    = array('field' => 'address2', 'rules' => 'trim');
        $rules['ship_addr']['city']        = array('field' => 'city', 'rules' => 'trim|required');
        $rules['ship_addr']['state']       = array('field' => 'state', 'rules' => 'trim|required');
        $rules['ship_addr']['zip']         = array('field' => 'zip', 'rules' => 'trim|required');
        $rules['ship_addr']['phone']       = array('field' => 'phone', 'rules' => 'trim|required');
    }
    
      if(strcmp($type, 'bill_addr') === 0){
        $rules['bill_addr']['first_name']  = array('field' => 'first_name',  'rules' => 'trim|required');
        $rules['bill_addr']['last_name']   = array('field' => 'last_name', 'rules' => 'trim|required');
        $rules['bill_addr']['company']     = array('field' => 'company', 'rules' => 'trim|required');
        $rules['bill_addr']['address1']    = array('field' => 'address1', 'rules' => 'trim|required');
        $rules['bill_addr']['address2']    = array('field' => 'address2', 'rules' => 'trim');
        $rules['bill_addr']['city']        = array('field' => 'city', 'rules' => 'trim|required');
        $rules['bill_addr']['state']       = array('field' => 'state', 'rules' => 'trim|required');
        $rules['bill_addr']['zip']         = array('field' => 'zip', 'rules' => 'trim|required');
        $rules['bill_addr']['phone']       = array('field' => 'phone', 'rules' => 'trim|required');
    } 
     
    if(!is_null($key) && isset($rules[$type][$key]))
        return $rules[$type][$key];
     
    return $rules[$type];
     
    }
    
    public function update_salesorder_quantity($action,$so_id)
    {
        try
        { 
            $this->load->library("cart");
            
           if($action == 'process'){
            
            $so_id      = (!empty($so_id))?$so_id:0;
            $itemtype   = $this->input->post("item_type");
            $cart_id    = $this->input->post("cart_id[]");
            $quantity   = $this->input->post('update_qty[]');
            
            if($itemtype == 'cart'){
                
                if(!empty($quantity)){
                    $j = 0;
                    foreach($cart_id as $ct_id){
                        $update_cart = array(  "rowid" => $ct_id,
                                                "qty" => $quantity[$j]
                                             );
                        $this->cart->update($update_cart);
                        $j++;
                     }
                     
                       
                     $this->data['cartitems'] = $this->cart->contents();
                     $output['content']       = $this->load->view("frontend/salesproductselection/cart_items",$this->data,true);
                     
                   }
             }       
            else
            {
                $sales_order_item_id = $this->input->post("sales_order_item_id[]");
                
                $i = 0;
                foreach($sales_order_item_id as $st_id){
                    $this->db->query("update sales_order_item set qty='".$quantity[$i]."' where id='".$st_id."'");
                    $st_data    = $this->db->query("select * from sales_order_item where id='".$st_id."'")->row_array();
                    $total_amt += $st_data['qty']*$st_data['unit_price'];
                    $i++;
                    log_history('sales_order',$st_id,'Quantity','update');
                }
                $this->db->query("update sales_order set total_amount='".$total_amt."' where id='".$so_id."'");
            }
            
            
            $output['message']       = "Item updated successfully";
            $output['status']        = "success";
          }
          else
          { 
            if($so_id == 'cartitem'){
                $cartitems = $this->cart->contents();
                $itemtype  = 'cart';
            }
            else
            {
                $cartitems = $this->salesorder_model->get_sales_items($so_id);
                $itemtype  = 'sales';
            }
            
            $this->data['cartitems'] = $cartitems;
            $this->data['total']     = $total_amt;
            $this->data['so_id']     = $so_id;
            $this->data['itemtype']  = $itemtype;
            $output['status']        = "warning";
            $output['itemtype']      = $itemtype;
            $output['content']       = $this->load->view("frontend/salesproductselection/cart_items",$this->data,true);
          }   
        }
        catch(Exception $e)
        {
            $output = array('status' => 'error', 'message' => $e->getMessage());
        } 
          
        $this->_ajax_output($output, TRUE);
       
    }
    
    public function get_logs($so_id, $value )
    {
        
    	if(!$so_id)
    		return false;
       
    	$this->load->library('Listing');
    	$this->load->model('log_model');

    	$this->data['list']  = $this->log_model->get_logs(array("action_id" => $value));
    	$listing = $this->load->view('listing/logs_listings', $this->data, TRUE);
    	 
    	
    	if($this->input->is_ajax_request())
    		$this->_ajax_output(array('listing' => $listing), TRUE);
    	
    	return $listing;
    }
    
    public function get_notes($so_id)
    {
        
    	if(!$so_id)
    		return false;
       
    	$this->load->library('Listing');
    	$this->load->model('note_model');
    	
    	$this->data['list']  = $this->note_model->get_notes(array("sales_order_id" => $value));
    	$listing = $this->load->view('listing/note_listings', $this->data, TRUE);
    	 
    	
    	if($this->input->is_ajax_request())
    		$this->_ajax_output(array('listing' => $listing), TRUE);
    	
    	return $listing;
    }
    
    /* End by Punitha */

    /* By Ram */

    public function customer_relation()
    {
      $this->layout->add_javascripts(array('listing'));  
      $this->load->library('listing');         
      $this->simple_search_fields = array(                                                
                                            'a.business_name'         => 'Customer Name',
                                            'b.email'          => 'Email',
                                            'c.name'     => 'Location',                                            
                                         );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('salesorder/add_edit_customer/{id}').'"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'salesorder/delete_customer/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>
                ';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('customer_model', 'listing');

        if($this->input->is_ajax_request())
            $this->_ajax_output(array('listing' => $listing), TRUE);
        
        $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
        $this->data['simple_search_fields'] = $this->simple_search_fields;
        $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
        $this->data['per_page'] = $this->listing->_get_per_page();
        $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
        
        $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);        
        $this->data['listing']    = $listing;
        $this->data['grid']       = $this->load->view('listing/view', $this->data, TRUE);
        $this->layout->view('frontend/sales/customer_relation');
    }

    public function add_edit_customer($edit_id='')
    {
      if(isset($_POST['name']))
      {
        $status = 'success';
        $form = $this->input->post();
        /*Customer Address Table*/
        // echo "<pre>"; print_r($form);exit;        
        $ins1['name'] = $form['bill_name'];
        $ins1['address1'] = $form['address_1'];
        $ins1['address2'] = $form['address_2'];
        $ins1['city'] = $form['city'];
        $ins1['state'] = $form['state'];
        $ins1['country'] = $form['country'];
        $ins1['zipcode'] = $form['zipcode'];
        $ins1['phone'] = $form['zipcode'];
        $ins1['created_id'] = get_current_user_id();
        $ins1['updated_id'] = get_current_user_id();
        $ins1['created_date'] = date("Y-m-d H:i:s");
        if($edit_id)
          $up1 = $this->admin_model->update(array("id"=>$form['address_id']),$ins1,"address");
        else
          $a_id = $this->admin_model->insert($ins1,"address");
        /*Customer Table*/
        $ins['business_name'] = $form['name'];
        $ins['web_url'] = $form['website'];
        $ins['ups'] = $form['ups'];
        $ins['credit_type'] = $form['credit_type'];
        $ins['address_id'] = (isset($edit_id) && $edit_id!=0) ? $form['address_id'] : $a_id;
        if($edit_id)
          $up2 = $this->admin_model->update(array("id"=>$form['edit_id']),$ins,"customer");
        else
          $c_id = $this->admin_model->insert($ins,"customer");
        /*Customer Contact Table*/
        $ins2['customer_id'] = (isset($edit_id) && $edit_id!=0) ? $edit_id : $c_id;
        $ins2['name'] = $form['contact_name'];
        $ins2['contact_value'] = $form['contact_value'];
        $ins2['contact_type'] = $form['contact_type'];
        $ins2['email'] = $form['contact_email'];
        $ins2['created_id'] = get_current_user_id();
        $ins2['updated_id'] = get_current_user_id();
        $ins2['created_date'] = date("Y-m-d H:i:s");
        if($edit_id)
        {
          $ins2['updated_date'] = date("Y-m-d H:i:s");
          $up3 = $this->admin_model->update(array("customer_id"=>$form['edit_id']),$ins2,"customer_contact");
        }
        else
          $add = $this->admin_model->insert($ins2,"customer_contact");
        /*Customer Location Table*/
        for ($i=0; $i<count($form['loc_name']);$i++)
        {            
          $ins3['customer_id'] = (isset($edit_id) && $edit_id!=0) ? $edit_id : $c_id;
          $ins3['name'] = $form['loc_name'][$i];
          $ins3['address_1'] = $form['loc_address_1'][$i];
          $ins3['address_2'] = $form['loc_address_2'][$i];
          $ins3['city'] = $form['loc_city'][$i];
          $ins3['state'] = $form['loc_state'][$i];
          $ins3['country'] = $form['loc_country'][$i];
          $ins3['zipcode'] = $form['loc_zipcode'][$i];
          $ins3['start_time'] = date("H:i:s",strtotime($form['start_time'][$i]));
          $ins3['end_time'] = date("H:i:s",strtotime($form['end_time'][$i]));
          $ins3['timezone_id'] = $form['timezone'][$i];
          $ins3['day_of_week'] = $form['weeks'][$i];
          $ins3['definition'] = implode(",",$form['loc_type'][$i]);
          if($edit_id)
            $up4 = $this->admin_model->update(array("id"=>$form['location_id'][$i]),$ins3,"customer_location");
          else
            $add1 = $this->admin_model->insert($ins3,"customer_location");
        }
        if($edit_id)
          $this->session->set_flashdata("success_msg","Customer Updated Successfully.",TRUE);
        else
          $this->session->set_flashdata("success_msg","Customer Added Successfully.",TRUE);
       
        if(isset($_GET['redirect'])){
            $so_id = $_GET['redirect'];
            redirect("salesorder/checkout/$so_id");
        }
        else
        {
          redirect("salesorder/customer_relation");    
        }   
        
      }
      if($edit_id!='')
      {
        $this->data['edit_data'] = $this->admin_model->select("customer",array("id"=>$edit_id));
        $this->data['edit_data1'] = $this->admin_model->select("address",array("id"=>$this->data['edit_data']['address_id']));
        $this->data['edit_data2'] = $this->admin_model->select("customer_contact",array("customer_id"=>$edit_id));
        $this->data['edit_data3'] = $this->admin_model->get_results("customer_location",array("customer_id"=>$edit_id));
        // echo "<pre>";print_r($this->data['edit_data3']);
        // exit;
      }
     $this->layout->view('frontend/sales/add_customer_relation');
    }

    public function add_new_address()
    {
      $this->data['row'] = $this->input->post('len') + 1;
      $output  =  $this->load->view('frontend/sales/ajax_new_address',$this->data,true);
      return $this->_ajax_output(array('status' => 'success' ,'output' => $output), TRUE);
    }
    
    
    /*End by Ram*/
}
?>

