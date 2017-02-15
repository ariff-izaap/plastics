<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class History extends Admin_Controller 
{

	function __construct()
  {
  	parent::__construct();
		if(!is_logged_in())
    	redirect('login');
  	$this->load->model('history_model');
	  $this->load->library('listing');
  }

  public function index()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');    
    $this->simple_search_fields = array(                                                
                                'c.action' => 'Action',
                                't.line'       => 'Comments',
                                'c.created_id' => 'Action By',
                                'c.created_date' => 'Date');
    $this->_narrow_search_conditions = array("start_date");    
    $str = '';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('History_model', 'listing');
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
  	$this->layout->view("history/index");
  }

}