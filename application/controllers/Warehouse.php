<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Warehouse extends Admin_Controller 
{

	 protected $_warehouse_validation_rules = array(
     array('field' => 'wname', 'label' => 'Warehouse Name', 'rules' => 'trim|required'),
     array('field' => 'address1', 'label' => 'Address 1', 'rules' => 'trim|required'),
     array('field' => 'city', 'label' => 'City', 'rules' => 'trim|required'),
     array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'),
     array('field' => 'country', 'label' => 'Country', 'rules' => 'trim|required'),
     array('field' => 'phone', 'label' => 'Phone Number', 'rules' => 'trim|required|numeric'),
     array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim|required|valid_email'),
     array('field' => 'zipcode', 'label' => 'Zipcode', 'rules' => 'trim|required|numeric|max_length[5]'),);

	function __construct()
  {
  	parent::__construct();
		if(!is_logged_in())
    	redirect('login');
  	$this->load->model('warehouse_model');
	  $this->load->library('listing');
    $rights = get_user_access_rights($this->session->userdata('user_data')['role_id']);
    $this->action =  json_decode($rights['access_level']);
  }

  public function index()
  {
  	$this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array(                                                
                                'a.name'  => 'Warehouse Name',
                                'a.email' => 'Email',
                                'a.city'   => 'City',
                                'a.phone'      => 'Phone',
                                'a.zipcode'  => 'Zipcode');
    $this->_narrow_search_conditions = array("start_date");
    $str = '&nbsp;';
    if($this->action->edit==1)
    $str='<a href="'.site_url('warehouse/add_edit_warehouse/{id}').'" class="table-action"><i class="fa fa-edit"></i></a>';
    if($this->action->delete==1)
      $str .='<a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'warehouse/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('warehouse_model', 'listing');
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
  	$this->layout->view('frontend/warehouse/index');
  }

  public function add_edit_warehouse($edit_id='')
  {
    if(!$this->action->create==1)
    {
      $this->session->set_flashdata("error_msg","Don't have rights to create warehouse.",TRUE);
      redirect("warehouse");
    }
  	if($edit_id)
  		$this->data['edit_data'] = $this->warehouse_model->get_where(array("id"=>$edit_id))->row_array();
 	  $this->form_validation->set_rules($this->_warehouse_validation_rules);
    if($this->form_validation->run())
    {
    	$form = $this->input->post();
    	$ins['name'] = $form['wname'];
    	$ins['address1'] = $form['address1'];
    	$ins['address2'] = $form['address1'];
    	$ins['city'] = $form['city'];
    	$ins['state'] = $form['state'];
    	$ins['country'] = $form['country'];
    	$ins['phone'] = $form['phone'];
    	$ins['zipcode'] = $form['zipcode'];
    	$ins['email'] = $form['email'];
    	$ins['status'] = $form['status'];
    	$ins['created_date'] = date("Y-m-d H:i:s");
    	if(!$edit_id)
    		$add = $this->warehouse_model->insert($ins);
    	else
    	{
    		$ins['updated_date'] = date("Y-m-d H:i:s");
    		$add = $this->warehouse_model->update(array("id"=>$edit_id),$ins);
    	}
    	redirect("warehouse");
    }
  	$this->layout->view('frontend/warehouse/add_edit_warehouse');
  }
  public function delete($del_id)
  {  
    $output['message'] ="Record deleted successfuly.";
    $output['status']  = "success";
   // $log = log_history("admin_users",$del_id,"user","delete");
    $this->warehouse_model->delete(array("id"=>$del_id));
    $this->_ajax_output($output, TRUE);
  }

  public function get_warehouse_details()
  {
    $id = $this->input->post('val');
    $output = $this->warehouse_model->get_where(array("id"=>$id))->row_array();
    $this->_ajax_output($output,TRUE);
  }
}