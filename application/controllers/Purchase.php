<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Purchase extends Admin_Controller 
{
  protected $_purchase_validation_rules = array(
     array('field' => 'vendor_id', 'label' => 'Vendor List', 'rules' => 'trim|required'),
     array('field' => 'vendor_name', 'label' => 'Vendor Name', 'rules' => 'trim|required'),
     array('field' => 'bill_name', 'label' => 'Bill To Name', 'rules' => 'trim|required'),
     array('field' => 'salesman', 'label' => 'Salesman', 'rules' => 'trim|required'),
     array('field' => 'address_1', 'label' => 'Address 1', 'rules' => 'trim|required'),
     array('field' => 'address_2', 'label' => 'Address 2', 'rules' => 'trim|required'),
     array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
     array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'),
     array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required'),
     array('field' => 'firstname', 'label' => 'Firstname', 'rules' => 'trim|required'),
     array('field' => 'lastname', 'label' => 'Lastname', 'rules' => 'trim|required'),
     array('field' => 'mobile', 'label' => 'Mobile', 'rules' => 'trim|required'),
     array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required'),
     array('field' => 'website', 'label' => 'Website', 'rules' => 'trim|required'),
     array('field' => 'pickup_date', 'label' => 'Pickup Date', 'rules' => 'trim|required'),
     array('field' => 'delivery_date', 'label' => 'Delivery Date', 'rules' => 'trim|required'));
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
  	$this->layout->view('frontend/Purchase/index');
  }
  public function add_edit_purchase()
  {
    $this->data['vendor'] = $this->purchase_model->get_vendors();
    $this->form_validation->set_rules($this->_purchase_validation_rules);
  	$this->data['po_id'] = $this->purchase_model->get_max_id();
    if($this->form_validation->run())
    {
  	}
    $this->layout->view('frontend/Purchase/add_purchase');
  }
  public function get_vendor_details($id)
  {
    $vendor = $this->purchase_model->get_vendors(array("c.id"=>$id));
    echo json_encode($vendor[0]);
  }
}