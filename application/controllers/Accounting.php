<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Accounting extends Admin_Controller 
{
	// protected $_user_validation_rules = array (
 //                          array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'),
 //                          array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
 //                          array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
 //                          array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim|required|valid_email'));

	function __construct()
  {
  	parent::__construct();
		if(!is_logged_in())
    	redirect('login');
  	$this->load->model('accounting_model');
	  $this->load->library('listing');
  }

  public function index()
  {
  	redirect("accounting/shipping_orders");
  }

  public function shipping_orders()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('b.business_name' => 'Name','c.ship_date' => 'Ship Date');
    $this->_narrow_search_conditions = array("start_date");    
    $str = '<a href="'.site_url('admin/add_edit_user/{id}').'" class="table-action"><i class="fa fa-edit edit"></i></a>
            <a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'admin/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('accounting_model', 'listing');
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
    $this->layout->view("accounting/shipping_orders");
  }

  public function add_edit_invoice($edit_id='')
  {
    if(isset($_POST['save_invoice']))
    {
      $form = $this->input->post();
      $ins['invoice_no']= rand();
      $so_id = explode(",",str_replace("\r\n",",",$form['so_id']));
      $ins['salesman_id'] = $form['salesman_id'];
      $ins['location_id'] = $form['shipping_id'];
      $ins['shipment_id'] = $form['shipment_id'];
      $ins['po_id'] = $form['po_id'];
      $ins['billing_id'] = $form['billing_id'];
      $ins['ship_date'] = str_replace("\r\n",",",$form['ship_date']);
      $ins['customer_id'] = $form['customer_id'];
      $ins['invoice_date'] = date("Y-m-d H:i",strtotime($form['invoice_date']));
      $ins['due_date'] = date("Y-m-d H:i",strtotime($form['due_date']));
      $ins['credit_type'] = $form['credit_type'];
      $ins['amount'] = str_replace(array("$",","),"",$form['amount']);
      $ins['prepaid_cod'] = str_replace(array("$",","),"",$form['cod_fee']);
      $ins['fright_amt'] = str_replace(array("$",","),"",$form['freight']);
      $ins['additional_amt'] = str_replace(array("$",","),"",$form['add_amt']);
      $ins['total_amt'] = str_replace(array("$",","),"",$form['total_amount']);
      $ins['created_id'] = get_current_user_id();
      $ins['updated_id'] = get_current_user_id();
      $ins['created_date'] = date("Y-m-d H:i:s");
      $ins['updated_date'] = date("Y-m-d H:i:s");
      $inv_id = $this->accounting_model->insert($ins,"invoices");
      for ($i=0; $i < count($so_id); $i++)
      { 
        $so = $this->accounting_model->get_ordered_items(array("so_id"=>$so_id[$i]),"sales_order_item");
        // echo "<pre>";print_r($so);echo "</pre>";exit;
        foreach ($so as $key => $value)
        {
          $ins1['invoice_id'] = $inv_id;
          $ins1['so_id'] = $so_id[$i];
          $ins1['product_id'] = $value['product_id'];
          $ins1['quantity'] = $value['qty'];
          $ins1['unit_price'] = $value['unit_price'];
          $ins1['total_amt'] = $value['unit_price'] * $value['qty'];
          $this->accounting_model->insert($ins1,"invoice_items");
        }
      }
      $this->session->set_flashdata("success_msg","Invoice created successfully.",TRUE);
      redirect("accounting/invoices");
    }
    else
    {
      $id = implode(",",$_POST['op_select']);
      $this->data['so_details'] = $this->accounting_model->get_shipping($id);
      foreach ($this->data['so_details'] as $key => $value)
      {
        $ship_id[] = $value['shipping_address_id'];
        $sales_id[] = $value['salesman_id'];
        $ship_date[] = $value['ship_date'];
        $carrier_id[] = $value['carrier_id'];
        $this->data['so_id'][] = $value['so_id'];
      }
      
      if(count(array_unique($ship_date)) > 1 || count(array_unique($ship_id)) > 1 || count(array_unique($sales_id)) > 1 || count(array_unique($carrier_id)) > 1)
      {
        $this->session->set_flashdata("error_msg","Shipping Address or Salesman or Shipping Date or Carrier Service must be same.",TRUE);
        redirect("accounting/shipping_orders");
      }
      // echo "<pre>";print_r($this->data['so_details']);
      // exit;
      $this->layout->view('accounting/add_edit_invoices');
    }
  }

  public function invoices()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array('b.business_name' => 'Name','c.ship_date' => 'Ship Date');
    $this->_narrow_search_conditions = array("start_date");    
    $str = '<a target="_blank" href="'.site_url('accounting/print_invoice/{id}').'" class="table-action"><i class="fa fa-print"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('invoice_model', 'listing');
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
    $this->layout->view('accounting/invoices');
  }

  public function print_invoice($inv_id='')
  {
    if($inv_id!='')
    {
      $this->load->model('invoice_model');
      $this->data['invoices'] = $this->invoice_model->get_invoices(array("a.id"=>$inv_id));
      $this->data['id'] = $inv_id;
      $this->load->view('accounting/print_invoice',$this->data);
    }
    else
    {
      $this->session->set_flashdata("error_msg","Something Error!",TRUE);
      redirect("accounting/invoices");
    }
  }
}
?>