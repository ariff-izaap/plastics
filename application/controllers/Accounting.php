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
    $this->simple_search_fields = array(                                                
                                'b.first_name' => 'Name',
                                'c.ship_date'       => 'Ship Date');
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
}