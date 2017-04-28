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
     array('field' => 'credit_type', 'label' => 'Payment Term', 'rules' => 'trim|required'),
     array('field' => 'wname', 'label' => 'Warehouse Name', 'rules' => 'trim|required'),
     array('field' => 'address1', 'label' => 'Address 1', 'rules' => 'trim|required'),
     array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
     array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'),
     array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required'),
     array('field' => 'phone', 'label' => 'Phone Number', 'rules' => 'trim|required|numeric'),
     array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|numeric|max_length[5]'),
     array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
     array('field' => 'pickup_date', 'label' => 'Pickup Date', 'rules' => 'trim|required'),
     array('field' => 'delivery_date', 'label' => 'Delivery Date', 'rules' => 'trim|required'),);

   protected $_minlevel_validation_rules = array(
     array('field' => 'name', 'label' => 'Warning Name', 'rules' => 'trim|required'),
     array('field' => 'product', 'label' => 'Product', 'rules' => 'trim|required'),
     array('field' => 'message', 'label' => 'Message', 'rules' => 'trim|required'),
     array('field' => 'quantity', 'label' => 'Quantity', 'rules' => 'trim|required'),
     array('field' => 'form', 'label' => 'Product Form', 'rules' => 'trim|required'),
     array('field' => 'packaging', 'label' => 'Product Packaging', 'rules' => 'trim|required'),
     array('field' => 'color', 'label' => 'Product Color', 'rules' => 'trim|required'));

	function __construct()
  {
  	parent::__construct();
		if(!is_logged_in())
    	redirect('login');
  	$this->load->model('purchase_model');
    $this->load->model('admin_model');
    $this->load->library('cart');
	  $this->load->library('listing');
     $userdata = $this->session->userdata('user_data'); 
    $rights = get_user_access_rights($userdata['role_id']);
    $this->action =  json_decode($rights['access_level']);
  }
  public function index()
  {
    $str ='&nbsp;';
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array();
    $this->_narrow_search_conditions = array("vendor_id","so_id","date_range");
    if($this->action->edit==1)
      // $str .='<a href="'.site_url('purchase/add_edit_purchase/{id}').'"><i class="fa fa-edit"></i></a>';
    if($this->action->delete==1)
    // $str .='&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'purchase/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    if($this->action->view==1)
      $str .='&nbsp;&nbsp;&nbsp;&nbsp;<a href="'.site_url('purchase/view/{id}').'"><i class="fa fa-eye"></i></a>';
      $str .= '&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href='.site_url('purchase/print_purchase/{id}').'><i class="fa fa-print"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('purchase_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['vendors'] = $this->purchase_model->get_vendors();
    $this->data['search_bar'] = $this->load->view('frontend/purchase/purchase_search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);    
  	$this->layout->view('frontend/purchase/index');
  }

   public function add($edit_id='')
  {
    if($edit_id)
    {
      $this->data['po_id'] = $edit_id;
      $this->data['edit_data'] = $this->purchase_model->get_purchased_order($edit_id);
      $_SESSION['edit_data'] = $this->data['edit_data'];
      $items = $this->purchase_model->get_purchased_products($edit_id);
      // echo "<pre>";print_r($items);exit;
      $this->cart->destroy();
      foreach ($items as $value)
      {
        $data = array("id"=>$value['id'],"sku"=>$value['sku'],"qty"=>$value['qty'],"name"=>$value['name'],"price"=>$value['unit_price']);
        // if(!$value['id'])
        $this->cart->insert($data);
      }
    }
    else
      $this->data['po_id'] = $this->purchase_model->get_max_id()['po_id'];
    $this->data['new_data'] = "sadsa";
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array(
                                'a.name' => 'Product Name',
                                'b.name' => 'Form Name',
                                'c.name' => 'Color',
                                'd.name' => 'Product Type',
                                'e.name' => 'Package');
    $this->_narrow_search_conditions = array("vendor","product","form","color","type","package","note");
    // $str = '<a href="'.site_url('admin/add_edit_user/{id}').'" class="table-action"><i class="fa fa-edit edit"></i></a>
    //         <a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'admin/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    // $this->listing->initialize(array('listing_action' => $str));
    $this->data['vendor'] = $this->purchase_model->get_vendors();
    $listing = $this->listing->get_listings('product_model', 'listing');
    if($this->input->is_ajax_request())
      $this->_ajax_output(array('listing' => $listing), TRUE);
    $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
    $this->data['simple_search_fields'] = $this->simple_search_fields;
    $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
    $this->data['per_page'] = $this->listing->_get_per_page();
    $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
    $this->data['search_bar'] = $this->load->view('frontend/purchase/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
    if(isset($_POST['save_product']))
    {
      if(count($this->cart->contents()) > 0)
      {
        $_SESSION['po_id'] = $_POST['po_id'];
        // $_SESSION['first_vendor'] = $_POST['vendor_id'];
        redirect("purchase/checkout/$edit_id");
      }
      else
      {
        $this->session->set_flashdata("error_msg","Your Cart is empty.",TRUE);
        redirect("purchase/add");
      }
    }
    /*if(!$this->action->create==1)
    {
      $this->session->set_flashdata("error_msg","Don't have rights to create purchase order.",TRUE);
      redirect('purchase');
    }
    $this->form_validation->set_rules($this->_purchase_validation_rules);
    if($edit_id)
    {
      $this->data['edit_data'] = $this->purchase_model->get_purchased_order($edit_id);
      $this->data['po_id'] = $edit_id;
    }
    else
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
      if(!$edit_id)
      {
        if(is_dir("assets/uploads/purchase/tmp/".$form['rand']))
        {
          if($form['rand'])
          {
            $files = glob("assets/uploads/purchase/tmp/".$form['rand']."/*.*");
            mkdir("assets/uploads/purchase/".$form['po_id'],0777,true);
            $a = array_map("copyFile",$files,array('rand'=>$_POST['rand']),array('po_id'=>$form['po_id']));
            array_map('unlink', glob("assets/uploads/purchase/tmp/".$form['rand']."/*.*"));
            rmdir("assets/uploads/purchase/tmp/".$form['rand']."");
          }
        }
      }

      /*Update Vendor Details*
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
      if($edit_id)
      {
        $ins['updated_id'] = get_current_user_id();
        $ins['updated_date'] = date("Y-m-d H:i:s");
        $this->purchase_model->update(array("id"=>$edit_id),$ins,"purchase_order");
      }
      else
      {
        $up['status']              = "INCOMPLETE";
        $ins['created_id']          = get_current_user_id();
        $ins['created_date']        = date("Y-m-d H:i:s");
        $this->purchase_model->insert($ins,"purchase_order");
      }
      $this->session->set_userdata('form_purchase',$form);
      redirect("purchase/add_product");
    }*/
    
    $this->layout->view('frontend/purchase/add_purchase');
  }

  public function delete($del_id)
  {
    $output['message'] = "Record deleted successfuly.";
    $output['status']  = "success";
    $log = log_history($del_id,"purchase","<b>#".$del_id." purchase order has been deleted.");
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
    $this->_narrow_search_conditions = array("product","form","color","type","package","note");
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
    $this->data['search_bar'] = $this->load->view('frontend/purchase/search_bar', $this->data, TRUE);
    $this->data['listing'] = $listing;
    $this->data['grid'] = $this->load->view('listing/view', $this->data, TRUE);
    $this->data['form_product'] = $form;
    $this->data['products'] = $this->purchase_model->get_purchased_products($form['po_id']);
    $this->layout->view('frontend/purchase/add_product');
  }
  
  public function get_vendor_details($id)
  {
    $vendor = $this->purchase_model->get_vendors(array("c.id"=>$id));
    echo json_encode($vendor[0]);
  }
  public function add_cart($product_id,$po_id,$qty,$vendor_id)
  {
    if($_SESSION['first_vendor']==$vendor_id || $_SESSION['first_vendor']=='')
    {
      $product_details = $this->purchase_model->select(array("id"=>$product_id),"product");
      $chk_warning = $this->purchase_model->select(array("product"=>$product_id,"form"=>$product_details['form_id'],"color"=>$product_details['color_id'],"packaging"=>$product_details['package_id']),"min_level");
      if($chk_warning)
        {
          $dropdown = get_operator( "where id=".$chk_warning['dropdown']);
          $exp = $qty." ".$dropdown[0]['operator']." ".$chk_warning['quantity'];
          $c = eval(" return ($exp);");
        }
        if(!$c)
        {
          $data = array(
            'id'      => $product_id,
            'sku'      => get_product_name($product_id)['sku'],
            'qty'     => $qty,
            'price'   => get_product_price($product_id),
            'name'    => get_product_name($product_id)['name'],
          );
          $this->cart->insert($data);
          $_SESSION['first_vendor'] = $vendor_id;
          $this->data['products'] = $this->cart->contents();
          $output['status'] = "success";
          $output['message'] = "Product Added Successfully.";
          $output['content'] = $this->load->view('/frontend/purchase/view_cart', $this->data, TRUE);    
          $output['count'] = count($this->cart->contents());
        }
         else
        {
          $this->_ajax_output(array('status'=>'warning','name'=>$chk_warning['warning_name'],'message' => $chk_warning['message']), TRUE);
        }
    }
    else
    {
      $output['status'] = "success";
      $output['message'] = "Product must add with same vendor only.";
      $output['content'] = $this->load->view('/frontend/purchase/view_cart', $this->data, TRUE);    
    }

    $this->_ajax_output($output, TRUE);
   /* $c = false;
   // $ins['id']          = $product_id;
    $ins['qty']         = $qty;
  //  $ins['price']       = get_product_price($product_id);
    $product_details = $this->purchase_model->select(array("id"=>$product_id),"product");
    $chk_warning = $this->purchase_model->select(array("product"=>$product_id,"form"=>$product_details['form_id'],"color"=>$product_details['color_id'],"packaging"=>$product_details['package_id']),"min_level");
    if($chk_warning)
    {
      $dropdown = get_operator( "where id=".$chk_warning['dropdown']);
      $exp = $qty." ".$dropdown[0]['operator']." ".$chk_warning['quantity'];
      $c = eval(" return ($exp);");
    }
    $ins['name']        = get_product_name($product_id)['name'];
    $ins['product_id']    = $product_id;
    $ins['po_id']    = $po_id;
    $ins['item_status']   = "New";
    //$ins['qty']           = $qty;
    $ins['created_id']    = get_current_user_id();
    $ins['updated_id']    = get_current_user_id();
    $ins['created_date']  = date("Y-m-d H:i:s");
    $ins['unit_price']    = get_product_price($product_id);
    $chk_product = $this->purchase_model->select(array("product_id"=>$product_id,"po_id"=>$po_id),"purchase_order_item");
    $get_vendor = $this->purchase_model->select(array("id"=>$po_id),"purchase_order");
    if(!$c)
    {
      if($chk_product)
      {
        $up['qty'] = $chk_product['qty'] + $qty;
        $up['updated_date'] = date("Y-m-d H:i:s");
        $update = $this->purchase_model->update(array("product_id"=>$product_id,"po_id"=>$po_id),$up,"purchase_order_item");

        $products = $this->purchase_model->get_purchased_products($po_id);
        $this->data['products']  = $products;
        $output['status'] = "success";
        $output['message'] = "Product Added Successfully.";
        $output['content'] = $this->load->view('/frontend/purchase/view_cart', $this->data, TRUE);    
        $output['count'] = count($products);

        $this->_ajax_output($output, TRUE);
      }
      else
      {
        if($get_vendor['vendor_id']==$vendor_id || $get_vendor['vendor_id']=='')
        {
          $add = $this->purchase_model->insert($ins,"purchase_order_item");
          $products = $this->purchase_model->get_purchased_products($po_id);
          $this->data['products']  = $products;
          $output['status'] = "success";
          $output['message'] = "Product Added Successfully.";
          $output['content'] = $this->load->view('/frontend/purchase/view_cart', $this->data, TRUE);    
          $output['count'] = count($products);

          $this->_ajax_output($output, TRUE);
        }
        else
          $this->_ajax_output(array('status'=>'success','message' => "Product must add with same vendor only."), TRUE);
      }
    }
    else
    {
      $this->_ajax_output(array('status'=>'warning','name'=>$chk_warning['warning_name'],'message' => $chk_warning['message']), TRUE);
    }*/
     //$this->_ajax_output(array('message' => $chk_warning,"valid"=>$c,"condition"=>$exp), TRUE);
  }

  public function form_add_to_cart($product_id, $po_id, $elm_id,$vendor_id)
  {
    $content = '<div id="div_add_to_cart" >
    <div class="menu_action pull-right nowrap m_bot_10">
    <input type="number" name="qty" id="qty" value="1" class="form-control input-sm" placeholder="Enter Quantity" onkeypress="return numbersonly(event);" style="margin-bottom:5px" min="1" max="10" />
    <input type="hidden" name="pid" id="pid" value="'.$product_id.'" class="input-small" />
    <input type="hidden" name="vid" id="vid" value="'.$po_id.'" class="input-small" />
    <input type="hidden" name="elm_id" id="elm_id" value="'.$elm_id.'" class="input-small" />
    <a class="btn btn-warning" href="javascript:;"  title="" onclick="add_to_cart('.$product_id.','.$po_id.', \'process\', this,'.$vendor_id.')">Add</a>
    </div>
    </div>';  
    // if($this->input->is_ajax())
   
      $this->_ajax_output(array('content' => $content),TRUE);
   
  }

  public function update_cart()
  {    
    try
    {
      $rowid  = $this->input->post('rowid');
      $qty  = $this->input->post('qty');
       foreach($rowid as $v)
      {
        $data = array(
        'rowid' => $v,
        'qty'   => $qty[$v]);
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

    $this->data['products'] = $this->cart->contents();
    $output['cart'] = $this->cart->contents();
    $output['cart_total'] = displayData($this->cart->total(),'money');
    $output['content']    = $this->load->view('/frontend/purchase/view_cart', $this->data, TRUE);
    $this->_ajax_output($output, TRUE);
  }

  public function remove_cart($row_id,$po_id)
  {  
    try
    {
      $this->cart->remove($row_id);     
      $output = array('status' => 'success', 'message' => 'Item removed successfully.');
    }
    catch(Exception $e)
    {
      $output = array('status' => 'failed', 'message' => $e->getMessage());
    }
    if(count($this->cart->contents()) <= 0)
    {
      unset($_SESSION['first_vendor']);
    }
    $products = $this->cart->contents();
    $this->data['products']  = $products;
    $output['content']       = $this->load->view('/frontend/purchase/view_cart', $this->data, TRUE);    
    $output['count'] = count($this->cart->contents());
    $this->_ajax_output($output, TRUE);  
  }

  public function checkout($po_id='')
  {
    // echo "<pre>";print_r($this->cart->contents());exit;
    $po_id = $_SESSION['po_id'];
    $this->data['po_id'] = $po_id;
    $this->data['edit_data'] = $this->purchase_model->get_purchased_order($po_id);
    $this->data['products'] = $this->purchase_model->get_purchased_products($po_id);
    $this->form_validation->set_rules($this->_checkout_validation_rules);
    $this->data['edit_data'] = $_SESSION['edit_data'];
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $rand = $form['rand'];
      /*Start Warehouse Shipping Info*/
      $house['name'] = $form['wname'];
      $house['address1'] = $form['address1'];
      $house['address2'] = $form['address2'];
      $house['city'] = $form['city'];
      $house['state'] = $form['state'];
      $house['country'] = $form['country'];
      $house['phone'] = $form['phone'];
      $house['email'] = $form['email'];
      $vendor_id = $_SESSION['first_vendor'];
      /*End Warehouse Shipping Info*/
      $this->purchase_model->update(array("id"=>$form['warehouse']),$house,"warehouse");
      $address_id = $this->purchase_model->insert($house,"ordered_address");
      $up['ordered_address_id'] = $address_id;
      $up['id'] = $po_id;
      $up['ship_type_id'] = $form['ship_type'];
      $up['carrier_id'] = $form['carrier'];
      $up['credit_type_id'] = $form['credit_type'];
      $up['pickup_date'] = $form['pickup_date'];
      $up['estimated_delivery'] = $form['delivery_date'];
      $up['total_amount'] = $form['total'];
      $up['status']              = "COMPLETED";
      $up['is_paid']              = "NOT PAID";
      $up['po_message'] = $form['po_message'];
      $up['vendor_id'] = $vendor_id;
      $up['note'] = $form['po_notes'];
      $up['created_id'] = get_current_user_id();
      $up['updated_id'] = get_current_user_id();
      $up['created_date'] = date("Y-m-d H:i:s");
      $up['updated_date'] = date("Y-m-d H:i:s");
      $ins_id = $this->purchase_model->insert($up,"purchase_order");
      /*Documents Attach File*/
      if(is_dir("assets/uploads/purchase/tmp/".$form['rand']))
        {
          if($form['rand'])
          {
            $files = glob("assets/uploads/purchase/tmp/".$form['rand']."/*.*");
            mkdir("assets/uploads/purchase/".$ins_id,0777,true);
            $a = array_map("copyFile",$files,array('rand'=>$form['rand']),array('po_id'=>$ins_id));
            array_map('unlink', glob("assets/uploads/purchase/tmp/".$form['rand']."/*.*"));
            rmdir("assets/uploads/purchase/tmp/".$form['rand']."");
          }
        }
      foreach ($this->cart->contents() as $value)
      {
        $ins['po_id'] = $ins_id;
        $ins['product_id'] =$value['id'];
        $ins['code'] =$value['sku'];
        $ins['name'] =$value['name'];
        $ins['unit_price'] =$value['price'];
        $ins['qty'] =$value['qty'];
        $ins['created_id'] = get_current_user_id();
        $ins['updated_id'] = get_current_user_id();
        $ins['created_date'] = date("Y-m-d H:i:s");
        // $this->purchase_model->delete(array("po_id"=>$ins_id),"purchase_order_item");
        $ins_id1 = $this->purchase_model->insert($ins,"purchase_order_item");
      }
      $this->cart->destroy();
      unset($_SESSION['first_vendor']);
      unset($_SESSION['po_id']);
      $log = log_history($ins_id,"purchase_order","#".$ins_id." Purchase Order has been created.");
      $this->session->set_flashdata("success_msg","Purchase Order Created Successfully",TRUE);
      redirect('purchase/view/'.$ins_id);
    }
    $this->layout->view('frontend/purchase/checkout');
  }

  public function min_level()
  {
    
    $this->form_validation->set_rules($this->_minlevel_validation_rules);
    $this->data['data'] = array("edit_id"=>"","form"=>"","packaging"=>"","color"=>"","name"=>"","message"=>"","product"=>"","quantity"=>"","dropdown"=>"");
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $ins['warning_name'] = $form['name'];
      $ins['message'] = $form['message'];
      $ins['product'] = $form['product'];
      $ins['quantity'] = $form['quantity'];
      $ins['form'] = $form['form'];
      $ins['packaging'] = $form['packaging'];
      $ins['color'] = $form['color'];
      $ins['dropdown'] = $form['dropdown'];
      $ins['created_id'] = get_current_user_id();
      $ins['created_date'] = date("Y-m-d H:i:s");
      if($form['edit_id'])
      {
        if(!$this->action->create==1)
        {
          $this->session->set_flashdata("error_msg","Don't have rights to edit min level.",TRUE);
          redirect('purchase/min_level');
        }
        $ins['updated_id'] = get_current_user_id();
        $ins['updated_date'] = date("Y-m-d H:i:s");
        $update =  $this->purchase_model->update(array("id"=>$form['edit_id']),$ins,"min_level");
        $log = log_history($form['edit_id'],"warning",$form['name']." warning has been updated");
        $this->session->set_flashdata("success_msg","Warning Updated Successfully",TRUE);
      }
      else
      {
        if(!$this->action->create==1)
        {
          $this->session->set_flashdata("error_msg","Don't have rights to set min level.",TRUE);
          redirect('purchase/min_level');
        }
        $add =  $this->purchase_model->insert($ins,"min_level");
        $log = log_history($add,"warning",$form['name']." warning has been created");
        $this->session->set_flashdata("success_msg","Warning Created Successfully",TRUE);
      }
      redirect('purchase/min_level');
    }
   $this->data['data'] = $this->input->post();
    // $this->data['data'] = array("edit_id"=>"","form"=>"","packaging"=>"","color"=>"","name"=>"","message"=>"","product"=>"","quantity"=>"","dropdown"=>"");
    $this->layout->view('frontend/purchase/min_level');
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
    $val = $this->purchase_model->select(array("id"=>$id),"min_level");
    $this->purchase_model->delete(array("id"=>$id),"min_level");
    $log = log_history($id,"warning","<b>".$val['warning_name']."</b> warning has been deleted.");
    $this->session->set_flashdata("success_msg","Warning deleted successfully",TRUE);
  }
  public function do_upload()
  {
    $form  = $_FILES['file'];
    $rand = $_POST['rand'];
    $edit_id = $_POST['edit_id'];
    if($rand=='')
      $rand = rand();
    if(!is_dir("assets/uploads/purchase/tmp/".$rand))
    {
      mkdir("assets/uploads/purchase/tmp/".$rand, 0777, true);
    }
    $config['upload_path']   = "./assets/uploads/purchase/tmp/".$rand;
    $config['allowed_types'] = 'doc|docx|pdf|xls|xlsx';
  
    $this->load->library('upload', $config);
    if($this->upload->do_upload('file'))
    {
      $this->_ajax_output(array('po_id'=>$edit_id,'rand'=>$rand,'status'=>'success','message'=>"Upload Successfully","docs"=>scandir($config['upload_path'])), TRUE);
    }
    else
      $this->_ajax_output(array('rand'=>$rand,'status'=>'fail','message'=>$this->upload->display_errors(),"files"=>$form), TRUE);

  }
  public function del_upload()
  {
    $rand = $this->input->post('rand');
    $name = $this->input->post('name');
    $file = "./assets/uploads/purchase/tmp/".$rand."/".$name;
    unlink($file);
    $this->_ajax_output(array('status'=>'success','message'=>"Removed Successfully",'vale'=>$_POST), TRUE);
  }
  public function get_cart_count()
  {
    // $po_id = $this->input->post('po_id');
    // $count = $this->purchase_model->select(array("po_id"=>$po_id),"purchase_order_item");
    $this->_ajax_output(array("count"=>count($this->cart->contents())),TRUE);
  }

  public function get_purchase_order()
  {
    $data['po'] = "";
    $id = $this->input->post('id');
    $data['po'] = $this->purchase_model->get_purchased_order($id);
    // print_r($data['po']);exit;
    $data['products'] = $this->purchase_model->get_purchased_products($id);
    $this->load->view('frontend/purchase/ajax_purchase_order',$data);
  }
   public function change_order_status()
  {
    $form = $this->input->post();
    $up['carrier_id'] = $form['shipment_service'];
    $up['ship_type_id'] = $form['delivery'];
    $up['credit_type_id'] = $form['payment_term'];
    $up['order_status'] = $form['po_status'];
    $up['release_to_sold'] = $form['release_to_sold'];
    $output['message'] = "Order Updated successfuly.";
    $output['status']  = "success";
    $this->purchase_model->update(array("id"=>$form['po_id']),$up,"purchase_order");      
    $log = log_history($form['po_id'],"purchase_order","<b>#".$form['po_id']."</b> purchase order has been updated.");
    redirect("purchase/view/".$form['po_id']);
  }

  public function create_auto_po($form,$product)
  {   
    $product = array("2"=>array("1"=>array("unit_price"=>"19","quantity"=>"2"),
                                "17"=>array("unit_price"=>"59","quantity"=>"2")),
                      "3"=>array("18"=>array("unit_price"=>"99","quantity"=>"2")));
    $form = array("so_id"=>"1","pickup_date"=>"2017-03-04","delivery_date"=>"2017-03-25","release_to_sold"=>"Yes","paid"=>"NOT PAID","status"=>"INCOMPLETE","ship_type_id"=>"1","carrier_id"=>"1","location_id"=>"1","credit_type_id"=>"1");
    $a = create_auto_po($product,$form);
    print_r($a);
  }

  public function print_purchase($id='')
  {
    $data['po'] = $this->purchase_model->get_purchased_order($id);
    $data['products'] = $this->purchase_model->get_purchased_products($id);
    $this->load->view('frontend/purchase/print_purchase',$data);
  }
  public function view($po_id='')
  {
    if($po_id=='')
    {
      $this->session->set_flashdata("error_msg","Something went wrong",TRUE);
      redirect("purchase");
    }
    $this->data['po'] = $this->purchase_model->get_purchased_order($po_id);
    $this->data['products'] = $this->purchase_model->get_purchased_products($po_id);
    $this->layout->view('frontend/purchase/view');
  }
  public function purchase_modal_save()
  {
    $id = $_POST['row'];
    $product = $_POST['product'];
    foreach ($id as $key => $value)
    {
      if($value!='0')
      {
        $get = $this->purchase_model->select(array("id"=>$key),"purchase_order_item");
        $qty = $get['qty'];
        $qty_received = $get['qty_received'];
        // $new_qty = $value + $qty_received;
        $up['qty_received'] = $value;
        if($value <= $qty && $qty_received!=$value)
        {
          $up = $this->purchase_model->update(array("id"=>$key),$up,"purchase_order_item");
          $log = log_history($get['po_id'],"purchase_order","Quantity #<b>".$value."</b> received for ".get_product_name($product[$key])['name']);
        }
      }
    }
    $output['status'] = "success";
    $output['message'] = "Received Quantity has been updated";
    $this->_ajax_output($output,TRUE);
  }

  public function product_modal_ajax()
  {
    $this->data['po_id'] = $_POST['po_id'];
    $this->data['products'] = get_products_by_vendor($_POST['vendor_id']);
    $this->load->view('frontend/purchase/product_modal_ajax',$this->data);
  }
  public function add_product_modal_ajax()
  {
    $form = $this->input->post();
    $ins['po_id'] = $form['po_id'];
    $ins['product_id'] = $form['product_id'];
    $ins['qty'] = $form['qty'];
    $ins['unit_price'] = get_product_price($ins['product_id']);
    $ins['name'] = get_product_name($ins['product_id'])['name'];
    $ins['code'] = get_product_name($ins['product_id'])['sku'];
    $ins['item_status'] = "NEW";
    $ins['created_id'] = get_current_user_id();
    $ins['updated_id'] = get_current_user_id();
    $ins['created_date'] = date("Y-m-d H:i:s");
    $ins['updated_date'] = date("Y-m-d H:i:s");
    $chk = $this->purchase_model->select(array("product_id"=>$form['product_id'],"po_id"=>$form['po_id']),"purchase_order_item");
    if($chk)
    {
      $old_qty = $chk['qty'];
      $up['qty'] = $old_qty + $form['qty'];
      $up['updated_id'] = get_current_user_id();
      $up['updated_date'] = date("Y-m-d H:i:s");
     $update = $this->purchase_model->update(array("product_id"=>$form['product_id'],"po_id"=>$form['po_id']),$up,"purchase_order_item");
     $log = log_history($form['po_id'],"purchase_order","Quantity #<b>".$ins['qty']."</b> updated for ".get_product_name($form['product_id'])['name']);
    }
    else
    {
     $add_id = $this->purchase_model->insert($ins,"purchase_order_item");
     $log = log_history($form['po_id'],"purchase_order","Product <b>".get_product_name($form['product_id'])['name']."</b> added with quantity #<b>".$ins['qty']."</b>");
    }
    $po = $this->purchase_model->select_multiple(array("po_id"=>$form['po_id']),"purchase_order_item");
    foreach ($po as $value)
    {
      $tot[] = $value['unit_price'] * $value['qty'];
    }
    $up1['total_amount'] = array_sum($tot);
    $up_id = $this->purchase_model->update(array("id"=>$form['po_id']),$up1,"purchase_order");
    $output['status'] = "success";
    $output['message'] = "Product Added Successfully.";
    $this->_ajax_output($output,TRUE);
  }
  public function remove_product()
  {
    $id = $this->input->post('id');
    $del = $this->purchase_model->delete(array("id"=>$id),"purchase_order_item");
    $output['status'] = "success";
    $output['message'] = "Product removed Successfully.";
    $this->_ajax_output($output,TRUE);
  }
}
?>
