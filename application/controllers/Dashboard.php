<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Dashboard extends Admin_Controller 
{
   function __construct()
   {
  	 parent::__construct();  
		if(!is_logged_in())
    	redirect('login');
			
  	$this->load->model('onepage_model');
    $this->load->model('purchase_model');
	  $this->load->library('listing');
    $this->load->library('cart');
    $this->layout->add_javascripts(array('onepage'));
    } 
    public function index()
    {  
      $this->layout->view('frontend/dashboard/index');			
    }
    public function get_customer_salesman()
    {
      $salesman_id = $this->input->post('sale');
      $customer = $this->input->post('customer');
      $this->data['vendors'] = $this->onepage_model->get_vendor_by_salesman($salesman_id,$customer);
      $output['content'] = $this->load->view('frontend/onepage/table_list',$this->data,true);
      $output['status'] = "success";
      // $output['msg'] = $this->data['vendors'];
      $this->_ajax_output($output,TRUE);
    }

    public function get_customer_by_id()
    {
      $id = $this->input->post('id');
      $this->data['vendor'] = $this->onepage_model->get_customer_by_id($id);
      $this->data['calls'] = $this->onepage_model->get_calls($id);
      $output['status'] = "success";
      $output['message'] = $this->data['vendor'];
      if($this->data['calls']!='')
        $output['call'] = $this->data['calls'];
      else
        $output['call'] = array("log_date"=>'');
      $this->_ajax_output($output,TRUE);
    }

    public function get_products()
    {
      $form = $this->input->post();
      $this->data['product'] = $this->onepage_model->get_products($form['product'],$form['sku'],$form['form'],$form['color'],$form['type'],$form['package'],$form['row']);
      $output['content'] = $this->load->view('frontend/onepage/product_table',$this->data,true);
      $output['status'] = "success";
      $output['message'] = $this->data['product'];
      $this->_ajax_output($output,TRUE);
    }
    public function get_product_by_id()
    {
      $id = $this->input->post('id');
      $this->data['product'] = $this->onepage_model->get_product_by_id($id);
      $output['status'] = "success";
      // $output['cost'] = $this->onepage_model->get_inventory_cost($id);
      $output['message'] = $this->data['product'];
      $this->_ajax_output($output,TRUE);
    }

    public function get_po_history()
    {
      $c_id = $this->input->post('c_id');
      $this->data['po'] = $this->onepage_model->get_po_history($c_id);
      $output['content'] = $this->load->view('frontend/onepage/po_history',$this->data,true);
      $output['msg'] = $this->data['po'];
      $this->_ajax_output($output,TRUE);
    }

    public function get_po_details($id)
    {
      $po_id = $this->input->post('po_id');
      $this->data['po_details'] = $this->onepage_model->get_po_details($po_id);
      $this->data['po'] = $this->purchase_model->get_purchased_order($po_id);
      $output['content'] = $this->load->view('frontend/onepage/po_details',$this->data,true);
      $output['msg'] = $this->data['po_details'];
      $this->_ajax_output($output,TRUE);
    }

    public function add_po_product($id)
    {
      $this->data['vendor_id'] = $this->input->post('vendor_id');
      $this->data['po_id'] = $this->input->post('po_id');
      $output['content'] = $this->load->view('frontend/onepage/add_po_product',$this->data,true);
      // $output['msg'] = $this->data['po_details'];
      $this->_ajax_output($output,TRUE);
    }
     public function add_so_product($id)
    {
      $this->data['vendor_id'] = $this->input->post('vendor_id');
      $this->data['so_id'] = $this->input->post('so_id');
      $output['content'] = $this->load->view('frontend/onepage/add_so_product',$this->data,true);
      // $output['msg'] = $this->data['po_details'];
      $this->_ajax_output($output,TRUE);
    }
    public function add_to_product_po()
    {
      $form = $this->input->post();
      $ins['product_id'] = $form['product'];
      $ins['qty'] = $form['quantity'];
      $ins['po_id'] = $form['po_id'];
      $ins['name'] = get_product_name($form['product'])['name'];
      $ins['code'] = get_product_name($form['product'])['sku'];
      $ins['unit_price'] = get_product_price($form['product']);
      $ins['item_status'] = "NEW";
      $ins['qty_received'] = '0';
      $ins['created_id'] = get_current_user_id();
      $ins['updated_id'] = get_current_user_id();
      $ins['created_date'] = date("Y-m-d H:i:s");
      $ins['updated_date'] = date("Y-m-d H:i:s");
      $chk = $this->purchase_model->select(array("product_id"=>$form['product'],"po_id"=>$form['po_id']),"purchase_order_item");
      if($chk)
      {
        $old_qty = $chk['qty'];
        $up['qty'] = $old_qty + $form['quantity'];
        $up['updated_id'] = get_current_user_id();
        $up['updated_date'] = date("Y-m-d H:i:s");
        $update = $this->purchase_model->update(array("product_id"=>$form['product'],"po_id"=>$form['po_id']),$up,"purchase_order_item");
      }
      else
      {
        $add = $this->onepage_model->insert($ins,"purchase_order_item");
      }
      $this->data['products'] = $this->onepage_model->get_po_details($form['po_id']);
      $po = $this->purchase_model->select_multiple(array("po_id"=>$form['po_id']),"purchase_order_item");
      foreach ($po as $value)
      {
        $tot[] = $value['unit_price'] * $value['qty'];
      }
      $up1['total_amount'] = array_sum($tot);
      $up_id = $this->purchase_model->update(array("id"=>$form['po_id']),$up1,"purchase_order");

      $output['cart'] = $this->load->view('frontend/onepage/view_cart',$this->data,true);
      $output['cart_total'] = displayData(array_sum($tot),'money');
      $output['status'] = "success";
      $output['message'] = "Product Added Successfully.";
      $this->_ajax_output($output,TRUE);
    }
    public function add_to_product_so()
    {
      $form = $this->input->post();
      $ins['product_id'] = $form['product'];
      $ins['qty'] = $form['quantity'];
      $ins['so_id'] = $form['so_id'];
      $ins['vendor_id'] = $form['vendor_id'];
      $ins['unit_price'] = get_product_price($form['product']);
      $ins['item_status'] = "NEW";
      $ins['created_id'] = get_current_user_id();
      $ins['updated_id'] = get_current_user_id();
      $ins['created_date'] = date("Y-m-d H:i:s");
      $ins['updated_date'] = date("Y-m-d H:i:s");
      $chk = $this->purchase_model->select(array("product_id"=>$form['product'],"so_id"=>$form['so_id']),"sales_order_item");
      if($chk)
      {
        $old_qty = $chk['qty'];
        $up['qty'] = $old_qty + $form['quantity'];
        $up['updated_id'] = get_current_user_id();
        $up['updated_date'] = date("Y-m-d H:i:s");
        $update = $this->purchase_model->update(array("product_id"=>$form['product'],"so_id"=>$form['so_id']),$up,"sales_order_item");
      }
      else
      {
        $add = $this->onepage_model->insert($ins,"sales_order_item");
      }
      $po = $this->purchase_model->select_multiple(array("so_id"=>$form['so_id']),"sales_order_item");
      foreach ($po as $value)
      {
        $tot[] = $value['unit_price'] * $value['qty'];
      }
      $up1['total_amount'] = array_sum($tot);
      $this->data['products'] = $this->onepage_model->get_so_details($form['so_id']);
      $up_id = $this->purchase_model->update(array("id"=>$form['so_id']),$up1,"sales_order");
      $output['cart'] = $this->load->view('frontend/onepage/view_cart',$this->data,true);
      $output['cart_total'] = displayData(array_sum($tot),'money');
      // $output['content']= $form['quantity'];
      $output['status'] = "success";
      $output['message'] = "Product Added Successfully.";
      $this->_ajax_output($output,TRUE);
    }
    public function update_po_qty()
    {
      $form = $this->input->post();
      $qty = $form['qty'];
      foreach ($qty as $key => $value)
      {
        $up['qty'] = $value;
        $id = $key;
        $up_id = $this->purchase_model->update(array("id"=>$id),$up,"purchase_order_item");
      }
      $po = $this->purchase_model->select_multiple(array("po_id"=>$form['po_id']),"purchase_order_item");
      foreach ($po as $value)
      {
        $tot[] = $value['unit_price'] * $value['qty'];
      }
      $up1['total_amount'] = array_sum($tot);
      $this->data['products'] = $this->onepage_model->get_po_details($form['po_id']);
      $up_id = $this->purchase_model->update(array("id"=>$form['po_id']),$up1,"purchase_order");
      $output['cart'] = $this->load->view('frontend/onepage/view_cart',$this->data,true);
      $output['cart_total'] = displayData(array_sum($tot),'money');
      $output['form'] = $form;
      $output['status'] = "success";
      $this->_ajax_output($output,TRUE);
    }

    

    public function get_so_history()
    {
      $c_id = $this->input->post('c_id');
      $this->data['so'] = $this->onepage_model->get_so_history($c_id);
      $output['content'] = $this->load->view('frontend/onepage/so_history',$this->data,true);
      $output['msg'] = $this->data['so'];
      $this->_ajax_output($output,TRUE);
    }
    public function get_so_details($so_id)
    {
      $so_id = $this->input->post('so_id');
      $this->data['so_details'] = $this->onepage_model->get_so_details($so_id);
      $this->data['so'] = $this->onepage_model->get_sales_order($so_id);
      // echo "<pre>";print_r($this->data['so']);exit;
      $output['content'] = $this->load->view('frontend/onepage/so_details',$this->data,true);
      $output['msg'] = $this->data['so_details'];
      $this->_ajax_output($output,TRUE);
    }
    
    public function update_so_qty()
    {
      $form = $this->input->post();
      $qty = $form['qty'];
      foreach ($qty as $key => $value)
      {
        $up['qty'] = $value;
        $id = $key;
        $up_id = $this->purchase_model->update(array("id"=>$id),$up,"sales_order_item");
      }
      $po = $this->purchase_model->select_multiple(array("so_id"=>$form['so_id']),"sales_order_item");
      foreach ($po as $value)
      {
        $tot[] = $value['unit_price'] * $value['qty'];
      }
      $up1['total_amount'] = array_sum($tot);
      $this->data['products'] = $this->onepage_model->get_so_details($form['so_id']);
      $up_id = $this->purchase_model->update(array("id"=>$form['so_id']),$up1,"sales_order");
      $output['cart'] = $this->load->view('frontend/onepage/view_cart',$this->data,true);
      $output['cart_total'] = displayData(array_sum($tot),'money');
      $output['form'] = $form;
      $output['status'] = "success";
      $this->_ajax_output($output,TRUE);
    }
    function _get_products_details($so_id)
    {
      $this->load->model('shipment_model');
      
      //check if the current SO is having Shipment(s)
      $result_set = $this->shipment_model->get_where(array('so_id' => $so_id));
  
      //if no shipment found, fetch only products vendor-wise products
      if(!$result_set->num_rows())
      {
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
           $result_set     = $this->CI->shipment_model->get_where(array('so_id' => $so_id));
         $shipment_count = $result_set->num_rows();
             $this->data['shipment_count'] = $shipment_count;
           
           if($shipment_count == 0){  
             foreach($vendors as $row)
          {
            $order[$row['product_id']]['sku']         = $row['sku'];
            $order[$row['product_id']]['product_name']  = $row['product_name'];
            $order[$row['product_id']]['unit_price']    = $row['unit_price'];
            $order[$row['product_id']]['api_sku']     = $row['api_sku'];
                    $order[$row['product_id']]['soi_id']        = $row['so_item_id'];
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

    public function create_new_po()
    {
      $c_id = $this->input->post('c_id');
      $this->data['vendor_id'] = $c_id;
      $this->data['products'] = $this->onepage_model->get_products_by_vendor($c_id);
      $output['content'] = $this->load->view('frontend/onepage/create_new_po',$this->data,true);
      $output['status'] = "success";
      $this->data['cart'] = $this->cart->contents();
      $this->data['total'] = $this->cart->total();
      $output['cart'] = $this->load->view('frontend/onepage/cart_po_content',$this->data,true);
      $this->_ajax_output($output,true);
    }

    public function add_po_cart()
    {
      $form = $this->input->post();
      $data = array(
        'id'      => $form['sku'],
        'product_id' => $form['p_id'],
        'qty'     => $form['qty'],
        'price'   => $form['price'],
        'name'    => $form['p_name']);
      $this->cart->insert($data);
      $this->data['cart'] = $this->cart->contents();
      $this->data['total'] = $this->cart->total();
      $output['cart'] = $this->load->view('frontend/onepage/cart_po_content',$this->data,true);
      $output['status'] = "success";
      $output['msg'] = $this->cart->contents();
      $this->_ajax_output($output,TRUE);
    }
    public function remove_po_cart()
    {
      $rowid = $this->input->post('rowid');
      $this->cart->remove($rowid);
      $this->data['cart'] = $this->cart->contents();
      $this->data['total'] = $this->cart->total();
      $output['cart'] = $this->load->view('frontend/onepage/cart_po_content',$this->data,true);
      $output['status'] = "success";
      $output['msg'] = $this->cart->contents();
      $this->_ajax_output($output,TRUE);
    }
    // public function update_po_cart()
    // {
    //   $rowid = $this->input->post('rowid');
    //   $qty = $this->input->post('qty');
    //   $data = array(
    //     'rowid'  => $rowid,
    //     'qty'    => $qty);
    //   $this->cart->update($data);
    //   $this->data['cart'] = $this->cart->contents();
    //   $this->data['total'] = $this->cart->total();
    //   $output['cart'] = $this->load->view('frontend/onepage/cart_po_content',$this->data,true);
    //   $output['status'] = "success";
    //   $output['msg'] = $this->cart->contents();
    //   $this->_ajax_output($output,TRUE);
    // }
    public function update_po_cart()
    {    
      try
      {
        $qty  = $this->input->post('qty');
         foreach($qty as $key => $v)
        {
          $data = array(
          'rowid' => $key,
          'qty'   => $v);
           //$data = array('qty' => $v);
           //$this->purchase_model->update(array("id"=>$k),$data,"purchase_order_item");
          $this->cart->update($data);
        }
        $output = array('status' => 'success', 'message' => 'Cart updated successfully!.');
      }
      catch(Exception $e)
      {
        $output = array('status' => 'failed', 'message' => $e->getMessage());
      }

      $this->data['cart'] = $this->cart->contents();
      $this->data['total'] = $this->cart->total();
      $output['cart'] = $this->load->view('frontend/onepage/cart_po_content',$this->data,true);
      $output['status'] = "success";
      $output['msg'] = $this->cart->contents();
      $this->_ajax_output($output,TRUE);
    }

    public function checkout_po()
    {
      $vendor_id = $this->input->post('vendor_id');
      $this->data['vendor_id'] = $vendor_id;
      $output['status'] = "success";
      $output['content'] = $this->load->view('frontend/onepage/checkout_po',$this->data,true);
      $this->_ajax_output($output,TRUE);
    }

    public function order_po()
    {
      $form = $this->input->post();
      $ins['vendor_id'] = $form['vendor_id'];
      $ins['total_amount'] = $this->cart->total();
      $ins['order_status'] = "NEW";
      $ins['pickup_date'] = $form['pickup_date'];
      $ins['release_to_sold'] = "No";
      $ins['is_paid'] = "NOT PAID";
      $ins['ship_type_id'] = $form['ship_method'];
      $ins['carrier_id'] = $form['ship_service'];
      $ins['credit_type_id'] = $form['credit_type'];
      $ins['status'] = "COMPLETED";
      $ins['note'] = $form['po_notes'];
      $ins['po_message'] = $form['po_message'];
      $ins['estimated_delivery'] = $form['delivery_date'];
      $ins['updated_date'] = date("Y-m-d H:i:s");
      $ins['created_date'] = date("Y-m-d H:i:s");
      $ins['created_id'] = get_current_user_id();
      $ins['updated_id'] = get_current_user_id();
      $po_id = $this->onepage_model->insert($ins,"purchase_order");
      foreach ($this->cart->contents() as $key => $value)
      {
        $ins1['po_id'] = $po_id;
        $ins1['product_id'] = $value['product_id'];
        $ins1['code'] = get_product_name($value['product_id'])['sku'];
        $ins1['name'] = get_product_name($value['product_id'])['name'];
        $ins1['unit_price'] = get_product_price($value['product_id']);
        $ins1['qty'] = $value['qty'];
        $ins['updated_date'] = date("Y-m-d H:i:s");
        $ins['created_date'] = date("Y-m-d H:i:s");
        $ins['created_id'] = get_current_user_id();
        $ins['updated_id'] = get_current_user_id();
        $ins_id = $this->onepage_model->insert($ins1,"purchase_order_item");
      }
      /* Shipping Address to Store in ordered_address table*/
      $ins2['name'] = $form['wname'];
      $ins2['address1'] = $form['address1'];
      $ins2['address2'] = $form['address2'];
      $ins2['city'] = $form['city'];
      $ins2['state'] = $form['state'];
      $ins2['country'] = $form['country'];
      $ins2['zipcode'] = $form['zipcode'];
      $ins2['phone'] = $form['phone'];
      $ins2['email'] = $form['email'];
      $address_id = $this->onepage_model->insert($ins2,"ordered_address");
      $up['ordered_address_id'] = $address_id;
      $up_order = $this->onepage_model->update(array('id'=>$po_id),$up,"purchase_order");
      $this->data['order_st'] = "created";
      $this->data['po'] = $this->onepage_model->get_po_history($form['vendor_id']);
      $output['content'] = $this->load->view('frontend/onepage/po_history',$this->data,true);
      $output['msg'] = $ins;
      $this->cart->destroy();
      $this->_ajax_output($output,TRUE);
    }

    public function create_new_so()
    {
      $vendor_id = $this->input->post('c_id');
      $this->data['products'] = $this->onepage_model->get_products();
      $this->data['vendor_id'] = $vendor_id;
      $output['content'] = $this->load->view('frontend/onepage/create_new_so',$this->data,true);
      $output['product'] = $this->data['products'];
      $output['status'] = "success";
      $this->data['cart'] = $this->cart->contents();
      $this->data['total'] = $this->cart->total();
      $output['cart'] = $this->load->view('frontend/onepage/cart_po_content',$this->data,true);
      $this->_ajax_output($output,TRUE);
    }
     public function add_so_cart()
    {
      $form = $this->input->post();
      $data = array(
        'id'      => $form['sku'],
        'product_id' => $form['p_id'],
        'qty'     => $form['qty'],
        'price'   => $form['price'],
        'name'    => $form['p_name']);
      $this->cart->insert($data);
      $this->data['cart'] = $this->cart->contents();
      $this->data['total'] = $this->cart->total();
      $output['cart'] = $this->load->view('frontend/onepage/cart_so_content',$this->data,true);
      $output['status'] = "success";
      $output['msg'] = $this->cart->contents();
      $this->_ajax_output($output,TRUE);
    }
    public function remove_so_cart()
    {
      $rowid = $this->input->post('rowid');
      $this->cart->remove($rowid);
      $this->data['cart'] = $this->cart->contents();
      $this->data['total'] = $this->cart->total();
      $output['cart'] = $this->load->view('frontend/onepage/cart_so_content',$this->data,true);
      $output['status'] = "success";
      $output['msg'] = $this->cart->contents();
      $this->_ajax_output($output,TRUE);
    }
    // public function update_so_cart()
    // {
    //   $rowid = $this->input->post('rowid');
    //   $qty = $this->input->post('qty');
    //   $data = array(
    //     'rowid'  => $rowid,
    //     'qty'    => $qty);
    //   $this->cart->update($data);
    //   $this->data['cart'] = $this->cart->contents();
    //   $this->data['total'] = $this->cart->total();
    //   $output['cart'] = $this->load->view('frontend/onepage/cart_so_content',$this->data,true);
    //   $output['status'] = "success";
    //   $output['msg'] = $this->cart->contents();
    //   $this->_ajax_output($output,TRUE);
    // }
    public function update_so_cart()
    {    
      try
      {
        $qty  = $this->input->post('qty');
         foreach($qty as $key => $v)
        {
          $data = array(
          'rowid' => $key,
          'qty'   => $v);
           //$data = array('qty' => $v);
           //$this->purchase_model->update(array("id"=>$k),$data,"purchase_order_item");
          $this->cart->update($data);
        }
        $output = array('status' => 'success', 'message' => 'Cart updated successfully!.');
      }
      catch(Exception $e)
      {
        $output = array('status' => 'failed', 'message' => $e->getMessage());
      }

      $this->data['cart'] = $this->cart->contents();
      $this->data['total'] = $this->cart->total();
      $output['cart'] = $this->load->view('frontend/onepage/cart_so_content',$this->data,true);
      $output['status'] = "success";
      $output['msg'] = $this->cart->contents();
      $this->_ajax_output($output,TRUE);
    }

    public function checkout_so()
    {
      $vendor_id = $this->input->post('vendor_id');
      $this->data['vendor_id'] = $vendor_id;
      $output['status'] = "success";
      $output['content'] = $this->load->view('frontend/onepage/checkout_so',$this->data,true);
      $this->_ajax_output($output,TRUE);
    }

    public function get_customer_info()
    {
      $c_id = $this->input->post('val');
      $this->data['vendor_id'] = $this->input->post('v_id');
      $this->data['customer'] = $this->onepage_model->get_customer_info($c_id);
      $output['status'] = "success";
      $output['content'] = $this->load->view('frontend/onepage/checkout_so',$this->data,true);
      $output['msg'] = $this->data['customer'];
      $this->_ajax_output($output,TRUE);
    }
    public function order_so()
    {
      $form = $this->input->post();
      $ins['customer_id'] = $form['vendor_id'];
      $ins['total_amount'] = $this->cart->total();
      $ins['order_status'] = "NEW";
      $ins['shipping_type'] = $form['ship_method'];
      $ins['carrier_id'] = $form['ship_service'];
      $ins['credit_type'] = $form['credit_type'];
      $ins['bol_instructions'] = $form['bol_instructions'];
      $ins['so_instructions'] = $form['so_instructions'];
      $ins['billing_address_id'] = $form['billing_id'];
      $ins['shipping_address_id'] = $form['ship_id'];
      $ins['updated_date'] = date("Y-m-d H:i:s");
      $ins['created_date'] = date("Y-m-d H:i:s");
      $ins['created_id'] = get_current_user_id();
      $ins['updated_id'] = get_current_user_id();
      $so_id = $this->onepage_model->insert($ins,"sales_order");
      foreach ($this->cart->contents() as $key => $value)
      {
        $ins1['so_id'] = $so_id;
        $ins1['product_id'] = $value['product_id'];
        $ins1['vendor_id'] = $form['vendor_id'];
        $ins1['item_status'] = "NEW";
        $ins1['unit_price'] = get_product_price($value['product_id']);
        $ins1['qty'] = $value['qty'];
        $ins1['updated_date'] = date("Y-m-d H:i:s");
        $ins1['created_date'] = date("Y-m-d H:i:s");
        $ins1['created_id'] = get_current_user_id();
        $ins1['updated_id'] = get_current_user_id();
        $ins_id = $this->onepage_model->insert($ins1,"sales_order_item");
      }
      $ins2['so_id'] = $so_id;
      $ins2['shipping_type'] = $form['ship_method'];
      $ins2['ship_company'] = $form['ship_service'];
      $ins2['order_status'] = "NEW";
      $ins2['updated_date'] = date("Y-m-d H:i:s");
      $ins2['created_date'] = date("Y-m-d H:i:s");
      $ins2['ship_date'] = date("Y-m-d H:i:s");
      $ins2['created_id'] = get_current_user_id();
      $ins2['updated_id'] = get_current_user_id();
      $ins2['total_items'] = $this->cart->total_items();
      $shipment_id = $this->onepage_model->insert($ins2,"shipment");
      $up['shipment_id'] = $shipment_id;
      $update = $this->onepage_model->update(array("so_id"=>$so_id),$up,"sales_order_item");
      $this->data['order_st'] = "created";
      $this->data['so'] = $this->onepage_model->get_so_history($form['vendor_id']);
      $output['content'] = $this->load->view('frontend/onepage/so_history',$this->data,true);
      // $output['msg'] = $ins1;
      $this->cart->destroy();
      $this->_ajax_output($output,TRUE);
    }

    public function customer_comments()
    {
      $c_id = $this->input->post('c_id');
      $this->data['comments'] = $this->onepage_model->get_comments(array('id'=>$c_id),"customer");
      $this->data['status'] = "success";
      $output['content'] = $this->load->view('frontend/onepage/customer_comments',$this->data,true);
      $this->_ajax_output($output,TRUE);
    }

    public function add_comments()
    {
      $c_id = $this->input->post('c_id');
      $comment = $this->input->post('comment');
      $get = $this->onepage_model->get_comments(array('id'=>$c_id),"customer");
      $up['comments'] =$get['comments'].$comment.";";
      $ins_id = $this->onepage_model->update(array('id'=>$c_id),$up,"customer");
      $this->data['comments'] = $this->onepage_model->get_comments(array('id'=>$c_id),"customer");
      $this->data['status'] = "success";
      $this->data['cmt_st'] = "created";
      $output['content'] = $this->load->view('frontend/onepage/customer_comments',$this->data,true);
      $this->_ajax_output($output,TRUE);
    }

    public function log_call()
    {
      $c_id = $this->input->post('c_id');
      $this->data['status'] = "success";
      $this->data['cmt_st'] = "created";
      $this->data['action'] = "saved";
      $this->data['customer_id'] = $c_id;
      $output['content'] = $this->load->view('frontend/onepage/call_log',$this->data,true);
      $this->_ajax_output($output,TRUE);
    }

    public function add_call_log()
    {
      $form = $this->input->post();
      $action = $form['action'];
      $ins['user_id'] = $form['salesman'];
      $ins['customer_id'] = $form['customer_id'];
      $ins['call_type'] = $form['call_type'];
      $ins['call_log'] = $form['comments'];
      $ins['log_date'] = $form['log_date'];
      $ins['created_date'] = date('Y-m-d H:i:s');
      $ins['updated_date'] = date('Y-m-d H:i:s');
      if($action=="saved")
        $ins_id = $this->onepage_model->insert($ins,"call_logs");
      else
      {
        $id = $form['log_id'];
        $up = $this->onepage_model->update(array("id"=>$id),$ins,"call_logs");
      }
      $output['status'] = "success";
      $output['form'] = $ins;
      $this->_ajax_output($output,TRUE);
    }

    public function view_log()
    {
      $c_id = $this->input->post('c_id');
      $this->data['logs'] = $this->onepage_model->get_call_log(array('customer_id'=>$c_id));
      $output['content'] = $this->load->view('frontend/onepage/view_log',$this->data,true);
      $this->_ajax_output($output,TRUE);
    }

    public function update_customer()
    {
      $form = $this->input->post();      
      $c_id = $form['customer_id'];
      $ins['business_name'] = $form['business_name'];
      $ins['credit_type'] = $form['credit_type'];
      $up1 = $this->onepage_model->update(array("id"=>$c_id),$ins,"customer");
      $ins1['phone'] = $form['phone'];
      $ins1['address1'] = $form['address1'];
      $ins1['city'] = $form['city'];
      $ins1['state'] = $form['state'];
      $ins1['zipcode'] = $form['zipcode'];
      $up2 = $this->onepage_model->update(array("id"=>$form['address_id']),$ins1,"address");
      $ins3['name'] = $form['contact_name'];
      $ins3['contact_value'] = $form['fax'];
      $ins3['contact_type'] = $form['contact_type'];
      $up3 = $this->onepage_model->update(array("customer_id"=>$c_id),$ins3,"customer_contact");
      $output['status'] = "success";
      $this->_ajax_output($output,true);
    }

    public function update_product()
    {
      $form = $this->input->post();
      $ins['name'] = $form['name'];
      $product_id = $form['product_id'];
      $ins['sku'] = $form['sku'];
      $ins['quantity'] = $form['qty'];
      $ins['form_id'] = $form['form'];
      $ins['color_id'] = $form['color'];
      $ins['row'] = $form['row'];
      $ins['product'] = $form['type'];
      $ins['equivalent'] = $form['equivalent'];
      $ins['units'] = $form['units'];
      $ins['package_id'] = $form['package'];
      $ins['ref_no'] = $form['reference'];
      $ins['notes'] = $form['notes'];
      $ins['wholesale_price'] = $form['wholesale'];
      $ins['retail_price'] = $form['retail'];
      $up = $this->onepage_model->update(array("id"=>$product_id),$ins,"product");
      $output['status'] = "success";
      $output['msg'] = $ins;
      $this->_ajax_output($output,true);
    }

    public function update_logs()
    {
      $id = $this->input->post('id');
      $this->data['action'] = "updated";
      $this->data['logs'] = $this->onepage_model->get_logs_by_id(array('id'=>$id));
      $output['content'] = $this->load->view('frontend/onepage/call_log',$this->data,true);
      $this->_ajax_output($output,TRUE);
    }

    public function save_po_changes()
    {
      $po_id = $this->input->post('id');
      $up['carrier_id'] = $this->input->post('ship');
      $up['is_paid'] = $this->input->post('paid');
      $up['credit_type_id'] = $this->input->post('payment');
      $up['ship_type_id'] = $this->input->post('delivery');
      $up['release_to_sold'] = $this->input->post('release');
      $update = $this->onepage_model->update(array("id"=>$po_id),$up,"purchase_order");
      $output['status'] = "success";
      $this->data['po_details'] = $this->onepage_model->get_po_details($po_id);
      $this->data['po'] = $this->purchase_model->get_purchased_order($po_id);
      $output['content'] = $this->load->view('frontend/onepage/po_details',$this->data,true);
      $this->_ajax_output($output,true);
      
    }
    public function update_so_changes()
    {
      $so_id = $this->input->post('id');
      $up['credit_type'] = $this->input->post('payment');
      $up['carrier_id'] = $this->input->post('ship');
      $up['shipping_type'] = $this->input->post('delivery');
      $update = $this->onepage_model->update(array("id"=>$so_id),$up,"sales_order");
      $this->data['so_details'] = $this->onepage_model->get_so_details($so_id);
      $this->data['so']  = $this->onepage_model->get_sales_order($so_id);
      $output['status']  = "success";
      $output['content'] = $this->load->view('frontend/onepage/so_details',$this->data,true);
      $this->_ajax_output($output,true);
    }
}
?>