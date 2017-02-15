<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Admin extends Admin_Controller 
{
	protected $_user_validation_rules = array (
                          array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'),
                          array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
                          array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
                          array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim|required|valid_email'));

	function __construct()
  {
  	parent::__construct();
		if(!is_logged_in())
    	redirect('login');
  	$this->load->model('admin_model');
	  $this->load->library('listing');
  }

  public function index()
  {
  	redirect("admin/user_setup");
  }
	
	public function general_dropdowns()
  {
  	$this->layout->view("admin/general_dropdowns");
	}

	public function user_setup()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array(                                                
                                'c.first_name' => 'Name',
                                't.name'       => 'Role',
                                'c.last_name' => 'Last Name',
                                'c.email'      => 'Email');
    $this->_narrow_search_conditions = array("start_date");    
    $str = '<a href="'.site_url('admin/add_edit_user/{id}').'" class="table-action"><i class="fa fa-edit edit"></i></a>
            <a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'admin/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('admin_model', 'listing');
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
  	$this->layout->view("admin/user_list");
	}

	public function add_edit_user($edit_id='')
	{
    if($edit_id)
      $edit_data = $this->admin_model->get_where(array("id" => $edit_id))->row_array();
    else
      $edit_data = array("id"=>"","first_name"=>"","last_name"=>"","username"=>"","user_code"=>"","email"=>"","password"=>"","role_id"=>"","status"=>"");
    
    $this->data['editdata']  = $edit_data;
		$this->data['roles'] = get_roles();
		$this->form_validation->set_rules($this->_user_validation_rules);
		if($this->form_validation->run())
    {
    	$form = $this->input->post();
    	$ins['first_name'] = $form['firstname'];
    	$ins['last_name'] = $form['lastname'];
      $ins['username'] = $form['username'];
      $ins['user_code'] = $form['user_code'];
    	$ins['email'] = $form['email'];
    	$ins['password'] = md5("password");
    	$ins['role_id'] = $form['role'];
    	$ins['status'] = $form['is_active'];
    	$ins['created_id'] = get_current_user_id();
    	$ins['created_date'] = date("Y-m-d H:i:s");
      if($edit_id)
      {
        $ins['updated_date'] = date("Y-m-d H:i:s");
        $ins['updated_id'] = get_current_user_id();
        $ins_user = $this->admin_model->update(array("id"=>$edit_id),$ins);
      }
      else
        $ins_user = $this->admin_model->insert($ins);
      redirect("admin/user_setup");
    }    
    $this->layout->view("admin/add_user");
	}

  public function delete($del_id)
  {
    $this->admin_model->delete(array("id"=>$del_id));  
    $output['message'] ="Record deleted successfuly.";
    $output['status']  = "success";
    $this->_ajax_output($output, TRUE);          
  }

  public function add_edit_dropdowns($edit_id='')
  {
    $this->form_validation->set_rules("table_value","Table Type Value","required");
    $this->form_validation->set_rules("status","Active","required");
    if ($this->form_validation->run() == FALSE)
    {
      $this->layout->view("admin/general_dropdowns");
    }
    else
    {
      $form = $this->input->post();
      $ins['status'] = $form['status'];
      $edit_id = $form['edit_id'];
      $ins['name'] = $form['table_value'];

      if(!$edit_id)
        $add = $this->admin_model->insert($ins,$this->get_table($form['table_type']));
      else
      {
        $up['name'] = $form['table_value'];
        $up['status'] = $form['status'];
        $up = $this->admin_model->update(array("id"=>$edit_id),$up,$this->get_table($form['table_type']));
      }
      $this->session->set_flashdata("success_msg","Dropdown Value Added Successfully",TRUE);
      redirect("admin/general_dropdowns");
    }
  }

  public function get_table_value()
  {
    $val = trim($this->input->post("val"));
    $data['tb'] = $this->admin_model->select($this->get_table($val));    
    $this->load->view("admin/dropdown_list",$data);
  }
  public function del_table_value()
  {
    $table = trim($this->input->post("table"));
    $id = trim($this->input->post("id"));
    $this->admin_model->delete(array("id"=>$id),$this->get_table($table));
    $this->session->set_flashdata("success_msg","Dropdown deleted successfully",TRUE);
  }

  function get_table($val)
  {
     switch ($val)
      {
        case '1':
          $table = "product_packaging";
          break;
        case '2':
          $table = "product_form";
          break;
        case '3':
          $table = "product";
          break;
        case '4':
          $table = "credit_type";
          break;
        case '5':
          $table = "carrier";
          break;
        case '6':
          $table = "timezone";
          break;
        case '7':
          $table = "state";
          break;
        case '8':
          $table = "contact_type";
          break;
        case '9':
          $table = "call_type";
          break;
        case '10':
          $table = "sale_type";
          break;
        case '11':
          $table = "product_packaging";
          break;
        case '12':
          $table = "credit_type";
          break;
      }
    return $table;
  }
}
?>

