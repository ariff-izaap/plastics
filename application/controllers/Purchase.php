<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Purchase extends Admin_Controller 
{
  protected $_purchase_validation_rules = array(
     array('field' => 'vendor_id', 'label' => 'Vendor List', 'rules' => 'required','errors'=>array('required'=>'Please Select anyone vendor from above list.')),
     array('field' => 'vendor_name', 'label' => 'Vendor Name', 'rules' => 'trim|required'),
     array('field' => 'bill_name', 'label' => 'Bill To Name', 'rules' => 'trim|required'),
     array('field' => 'address_1', 'label' => 'Address 1', 'rules' => 'trim|required'),
     array('field' => 'address_2', 'label' => 'Address 2', 'rules' => 'trim|required'),
     array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
     array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'),
     array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|numeric'),
     array('field' => 'firstname', 'label' => 'Firstname', 'rules' => 'trim|required'),
     array('field' => 'lastname', 'label' => 'Lastname', 'rules' => 'trim|required'),
     array('field' => 'mobile', 'label' => 'Mobile', 'rules' => 'trim|required'),
     array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required'),
     array('field' => 'pickup_date', 'label' => 'Pickup Date', 'rules' => 'trim|required'),
     array('field' => 'delivery_date', 'label' => 'Delivery Date', 'rules' => 'trim|required'));


  protected $_checkout_validation_rules = array(
     array('field' => 'warehouse', 'label' => 'Warehouse', 'rules' => 'trim|required'),
     array('field' => 'ship_type', 'label' => 'Ship Method', 'rules' => 'trim|required'),
     array('field' => 'carrier', 'label' => 'Ship Service', 'rules' => 'trim|required'),
     array('field' => 'credit_type', 'label' => 'Payment Term', 'rules' => 'trim|required'));

   protected $_minlevel_validation_rules = array(
     array('field' => 'name', 'label' => 'Warning Name', 'rules' => 'trim|required'),
     array('field' => 'product', 'label' => 'Product', 'rules' => 'trim|required'),
     array('field' => 'quantity', 'label' => 'Quantity', 'rules' => 'trim|required'));

	function __construct()
  {
  	parent::__construct();
		if(!is_logged_in())
    	redirect('login');
  	$this->load->model('purchase_model');
    $this->load->model('admin_model');
	  $this->load->library('listing');
  }
  public function index()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array(                                                
                                'c.id'            => 'PO ID',
                                't.business_name' => 'Vendor',
                                'c.pickup_date'   => 'Pickup Date',
                                'f.location'      => 'Location',
                                'c.order_status'  => 'Order Status');
    $this->_narrow_search_conditions = array("start_date");    
    $str='<a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'purchase/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('purchase_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
  	$this->layout->view('frontend/Purchase/index');
  }
  public function add_edit_purchase()
  {
    $this->data['vendor'] = $this->purchase_model->get_vendors();
    $this->form_validation->set_rules($this->_purchase_validation_rules);
  	$this->data['po_id'] = $this->purchase_model->get_max_id();
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $ins['id']                  = $form['po_id'];
      $ins['vendor_id']           = $form['vendor_id'];
      $ins['order_status']        = "NEW";
      $ins['pickup_date']         = $form['pickup_date'];
      $ins['estimated_delivery']  = $form['delivery_date'];
      $ins['release_to_sold']     = isset($form['to_sold']) ? $form['to_sold'] : "No";
      $ins['is_paid']             = "NOT PAID";
      $ins['created_id']          = get_current_user_id();
      $ins['updated_id']          = get_current_user_id();
      $ins['created_date']        = date("Y-m-d H:i:s");

      /*Update Vendor Details*/
      $up['first_name'] = $form['firstname'];
      $up['last_name'] = $form['lastname'];
      $up['phone'] = $form['mobile'];
      $up2['email'] = $form['email'];
      $up1['web_url'] = $form['website'];
      $vendor = $this->purchase_model->get_vendors(array("a.id"=>$form['vendor_id']));
      $address_id = $vendor[0]['address_id'];
      $this->purchase_model->update(array("id"=>$address_id),$up,"address");
      $this->purchase_model->update(array("id"=>$form['vendor_id']),$up1,"customer");
      $this->purchase_model->update(array("customer_id"=>$form['vendor_id']),$up2,"customer_contact");
      $this->purchase_model->insert($ins,"purchase_order");
      $this->session->set_userdata('form_purchase',$form);
      redirect("purchase/add_product");
  	}
    $this->layout->view('frontend/Purchase/add_purchase');
  }

  public function delete($del_id)
  {  
    $output['message'] = "Record deleted successfuly.";
    $output['status']  = "success";
    $log = log_history("purchase_order",$del_id,"purchase","delete");
    $this->purchase_model->delete(array("id"=>$del_id),"purchase_order");
    $this->purchase_model->delete(array("po_id"=>$del_id),"purchase_order_item");
    $this->_ajax_output($output, TRUE);
  }

  public function add_product()
  {
    $form = $this->session->userdata['form_purchase'];
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array(                                                
                                'a.name' => 'Product Name',
                                'b.name' => 'Form Name',
                                'c.name' => 'Color',
                                'd.name' => 'Product Type',
                                'e.name' => 'Package');
    $this->_narrow_search_conditions = array("start_date");    
    // $str = '<a href="'.site_url('admin/add_edit_user/{id}').'" class="table-action"><i class="fa fa-edit edit"></i></a>
    //         <a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'admin/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    // $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('product_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
    $this->data['form_product'] = $form;
    $this->data['products'] = $this->purchase_model->get_purchased_products($form['po_id']);
    $this->layout->view('frontend/Purchase/add_product');
  }
  
  public function get_vendor_details($id)
  {
    $vendor = $this->purchase_model->get_vendors(array("c.id"=>$id));
    echo json_encode($vendor[0]);
  }
  public function add_cart($product_id,$po_id,$qty,$vendor_id)
  {
    $ins['po_id']         = $po_id;
    $ins['product_id']    = $product_id;
    $ins['item_status']   = "New";
    $ins['qty']           = $qty;
    $ins['created_id']    = get_current_user_id();
    $ins['updated_id']    = get_current_user_id();
    $ins['created_date']  = date("Y-m-d H:i:s");
    $ins['unit_price']    = get_product_price($product_id);
    $chk_product = $this->purchase_model->select(array("product_id"=>$product_id,"po_id"=>$po_id),"purchase_order_item");
    $get_vendor = $this->purchase_model->select(array("id"=>$po_id),"purchase_order");     
    if($chk_product)
    {
      $up['qty'] = $chk_product['qty'] + $qty;
      $up['updated_date'] = date("Y-m-d H:i:s");
      $update = $this->purchase_model->update(array("product_id"=>$product_id,"po_id"=>$po_id),$up,"purchase_order_item");
       $this->_ajax_output(array('message' => "Product Added Successfully"), TRUE);
    }
    else
    {
      if($get_vendor['vendor_id']==$vendor_id || $get_vendor['vendor_id']=='')
      {
        $add = $this->purchase_model->insert($ins,"purchase_order_item");
        $this->_ajax_output(array('message' => "Product Added Successfully"), TRUE);
      }
      else
        $this->_ajax_output(array('message' => "Product Added with same vendor only."), TRUE);
    }        
  }

  public function form_add_to_cart($product_id, $po_id, $elm_id,$vendor_id)
  {
    $content = '<div id="div_add_to_cart" >
    <div class="menu_action pull-right nowrap m_bot_10">
    <input type="number" name="qty" id="qty" value="1" class="form-control input-sm" placeholder="Enter Quantity" onkeypress="return numbersonly(event);" style="margin-bottom:5px" min="1" max="10" />
    <input type="hidden" name="pid" id="pid" value="'.$product_id.'" class="input-small" />
    <input type="hidden" name="vid" id="vid" value="'.$po_id.'" class="input-small" />
    <input type="hidden" name="elm_id" id="elm_id" value="'.$elm_id.'" class="input-small" />
    <a class="btn" href="javascript:;"  title="" onclick="add_to_cart('.$product_id.','.$po_id.', \'process\', this,'.$vendor_id.')">submit</a>
    </div>
    </div>';  
    // if($this->input->is_ajax())
    $this->_ajax_output(array('content' => $content),TRUE);
  }

  public function update_cart()
  {     
    try
    {
      $qty_array  = $this->input->post('qty');
      $po_id  = $this->input->post('po_id');
      foreach($qty_array as $k => $v)
      {
        $data = array('qty' => $v);
        $this->purchase_model->update(array("id"=>$k),$data,"purchase_order_item");
      }
      $output = array('status' => 'success', 'message' => 'Cart updated successfully!.');
    }
    catch(Exception $e)
    {
      $output = array('status' => 'failed', 'message' => $e->getMessage());
    }

    $this->data['products'] = $this->purchase_model->get_purchased_products($po_id);
    $output['content']    = $this->load->view('/frontend/Purchase/view_cart', $this->data, TRUE);
    $this->_ajax_output($output, TRUE);
  }

  public function remove_cart($row_id,$po_id)
  {  
    try
    {
      $this->purchase_model->delete(array("id"=>$row_id),"purchase_order_item");     
      $output = array('status' => 'success', 'message' => 'Item removed successfully.');
    }
    catch(Exception $e)
    {
      $output = array('status' => 'failed', 'message' => $e->getMessage());
    }
    
    $products = $this->purchase_model->get_purchased_products($po_id);
    $this->data['products']  = $products;
    $output['content']       = $this->load->view('/frontend/Purchase/view_cart', $this->data, TRUE);    
    $output['count'] = count($products);
    $this->_ajax_output($output, TRUE);      
  }

  public function checkout($po_id)
  {
    $this->data['po_id'] = $po_id;
    $this->data['products'] = $this->purchase_model->get_purchased_products($po_id);
    $this->form_validation->set_rules($this->_checkout_validation_rules);
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $up['warehouse_id'] = $form['warehouse'];
      $up['ship_type_id'] = $form['ship_type'];
      $up['carrier_id'] = $form['carrier'];
      $up['credit_type_id'] = $form['credit_type'];
      $up['total_amount'] = $form['total'];
      $up['po_message'] = $form['po_message'];
      $up['note'] = $form['po_notes'];
      $up['updated_id'] = get_current_user_id();
      $up['updated_date'] = date("Y-m-d H:i:s");
      $this->purchase_model->update(array("id"=>$form['po_id']),$up,"purchase_order");
      $log = log_history("purchase_order",$form['po_id'],"purchase","insert");
      $this->session->set_flashdata("success_msg","Purchase Order Created Successfully",TRUE);
      redirect('purchase');
    }
    $this->layout->view('frontend/Purchase/checkout');
  }

  public function min_level()
  {
    
    $this->form_validation->set_rules($this->_minlevel_validation_rules);
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $ins['warning_name'] = $form['name'];
      $ins['product'] = $form['product'];
      $ins['quantity'] = $form['quantity'];
      $ins['dropdown'] = $form['dropdown'];      
      $ins['created_id'] = get_current_user_id();
      $ins['created_date'] = date("Y-m-d H:i:s");
      if($form['edit_id'])
      {
        $ins['updated_id'] = get_current_user_id();
        $ins['updated_date'] = date("Y-m-d H:i:s");
        $update =  $this->purchase_model->update(array("id"=>$form['edit_id']),$ins,"min_level");
        $log = log_history("min_level",$form['edit_id'],"warning","update");
        $this->session->set_flashdata("success_msg","Warning Updated Successfully",TRUE);
      }
      else
      {
        $add =  $this->purchase_model->insert($ins,"min_level");
        $log = log_history("min_level",$add,"warning","insert");
        $this->session->set_flashdata("success_msg","Warning Created Successfully",TRUE);
      }      
    }
    $this->layout->view('frontend/Purchase/min_level');
  }
  public function get_min_level()
  {
    $id = $this->input->post('val');
    $get_data = $this->purchase_model->select(array("id"=>$id),"min_level");
    $this->_ajax_output($get_data, TRUE);
  }
  public function del_min_level()
  {
    $id = trim($this->input->post("id"));
    $this->purchase_model->delete(array("id"=>$id),"min_level");
    $log = log_history("min_level",$id,"warning","delete");
    $this->session->set_flashdata("success_msg","Warning deleted successfully",TRUE);
  }
}
?>