<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Admin extends Admin_Controller 
{
	protected $_user_validation_rules = array (
                          array('field' => 'username', 'label' => 'Username', 'rules' => 'trim|required'),
                          array('field' => 'firstname', 'label' => 'First Name', 'rules' => 'trim|required'),
                          array('field' => 'lastname', 'label' => 'Last Name', 'rules' => 'trim|required'),
                          array('field' => 'email', 'label' => 'Email Address', 'rules' => 'trim|required|valid_email'));

  protected $_access_level_validation_rules = array (
                          array('field' => 'role_id', 'label' => 'Role', 'rules' => 'trim|required'),
                          array('field' => 'menu[]', 'label' => 'Menu', 'rules' => 'trim|required','errors'=>array('required'=>'Please Select atleast one menu')),
                          array('field' => 'rights[]', 'label' => 'Rights', 'rules' => 'trim|required','errors'=>array('required'=>'Please Select atleast one rights')));

	function __construct()
  {
  	parent::__construct();
		if(!is_logged_in())
    	redirect('login');
  	$this->load->model('admin_model');
    $this->load->model('role_model');
    $this->load->model('history_model');
	  $this->load->library('listing');
    $rights = get_user_access_rights($this->session->userdata('user_data')['role_id']);
    $this->action =  json_decode($rights['access_level']);
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
    $str = '&nbsp;';
    if($this->action->edit==1)
      $str .='<a href="'.site_url('admin/add_edit_user/{id}').'" class="table-action"><i class="fa fa-edit edit"></i></a>';
    if($this->action->delete==1)
      $str .'<a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'admin/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
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
    if(!$this->action->create==1)
    {
      $this->session->set_flashdata("error_msg","Don't have rights to create new user",TRUE);
      redirect('admin/user_setup');
    }
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
        $ins_user = $this->admin_model->update(array("id"=>$edit_id),$ins,"admin_users");
        $log = log_history("admin_users",$edit_id,"user","update");
      }
      else
      {
        $ins_user = $this->admin_model->insert($ins,"admin_users");
        $log = log_history("admin_users",$ins_user,"user","insert");
      }
      redirect("admin/user_setup");
    }    
    $this->layout->view("admin/add_user");
	}

  public function delete($del_id)
  {  
    $output['message'] ="Record deleted successfuly.";
    $output['status']  = "success";
    $log = log_history("admin_users",$del_id,"user","delete");
    $this->admin_model->delete(array("id"=>$del_id),"admin_users");
    $this->_ajax_output($output, TRUE);
  }

  public function add_edit_dropdowns($edit_id='')
  {
    $this->form_validation->set_rules("table_value","Table Type Value","required");
    $this->form_validation->set_rules("table_type","Table Type","required");
    $this->form_validation->set_rules("status","Active","required");
    if ($this->form_validation->run() == FALSE)
    {
      $this->layout->view("admin/general_dropdowns");
    }
    else
    {
      $form = $this->input->post();
      $ins['status'] = $form['status'];
      $edit_id       = $form['edit_id'];
      $ins['name']   = $form['table_value'];
      $ins['created_id'] = get_current_user_id();
      $ins['updated_id'] = get_current_user_id();
      $ins['updated_date'] = date("Y-m-d H:i:s");
      $ins['created_date'] = date("Y-m-d H:i:s");
      if(!$edit_id)
      {
        if(!$this->action->create==1)
          {
            $this->session->set_flashdata("error_msg","Don't have rights to create dropdowns.",TRUE);
            redirect("admin/add_edit_dropdowns");
          }
        $ins['updated_id'] = get_current_user_id();
        $ins['updated_date'] = date("Y-m-d H:i:s");
        $add = $this->admin_model->insert($ins,$this->get_table($form['table_type']));
        $log = log_history($this->get_table($form['table_type']),$add,"dropdown","insert");
      }
      else
      {
        if(!$this->action->update==1)
          {
            $this->session->set_flashdata("error_msg","Don't have rights to update dropdowns.",TRUE);
            redirect("admin/add_edit_dropdowns");
          }
        $up['name'] = $form['table_value'];
        $up['status'] = $form['status'];
        $up = $this->admin_model->update(array("id"=>$edit_id),$up,$this->get_table($form['table_type']));
        $log = log_history($this->get_table($form['table_type']),$edit_id,"dropdown","update");
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
    $log = log_history($this->get_table($table),$id,"dropdown","delete");
    $this->session->set_flashdata("success_msg","Dropdown deleted successfully",TRUE);
  }

  public function roles()
  {
    $this->layout->add_javascripts(array('listing'));
    $this->load->library('listing');
    $this->simple_search_fields = array(                                                
                                'c.name' => 'Name',
                                /*'t.name'       => 'Role',
                                'c.last_name' => 'Last Name',
                                'c.email'      => 'Email'*/);
    $this->_narrow_search_conditions = array("start_date");
    $str ='&nbsp;';
    if($this->action->edit==1)
      $str .='<a href="'.site_url('admin/add_edit_role/{id}').'" class="table-action"><i class="fa fa-edit edit"></i></a>';
    if($this->action->delete==1)
      $str.='<a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'admin/delete_role/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>';
    $this->listing->initialize(array('listing_action' => $str));
    $listing = $this->listing->get_listings('role_model', 'listing');
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
    $this->layout->view("admin/roles");
  }

  public function add_edit_role($edit_id='')
  {
    if(!$this->action->create==1)
    {
      $this->session->set_flashdata("error_msg","Don't have rights to create role.",TRUE);
      redirect("admin/roles");
    }
    if($edit_id)
      $edit_data = $this->admin_model->get_where(array("id" => $edit_id),"","role")->row_array();
    else
      $edit_data = array("id"=>"","name"=>"");

    $this->data['editdata']  = $edit_data;
    $this->form_validation->set_rules("name","Role Name","required");
    if ($this->form_validation->run() == FALSE)
    {
      $this->layout->view("admin/add_role");
    }
    else
    {
      $form = $this->input->post();
      $ins['name'] = $form['name'];
      $edit_id = $form['edit_id'];
      //$ins['name'] = $form['table_value'];

      if(!$edit_id)
      {
        $add = $this->admin_model->insert($ins,"role");
        $log = log_history("role",$add,"role","insert");
      }
      else
      {
        $up['name'] = $form['name'];
        $up = $this->admin_model->update(array("id"=>$edit_id),$up,"role");
        $log = log_history("role",$edit_id,"role","update");
      }
      $this->session->set_flashdata("success_msg","Role Added Successfully",TRUE);
      redirect("admin/roles");
    }
  }
  public function delete_role($del_id)
  {    
    $this->admin_model->delete(array("id"=>$del_id),"role");
    $output['message'] ="Record deleted successfuly.";
    $output['status']  = "success";
    $output['log'] = log_history("role",$del_id,"role","delete");
    $this->_ajax_output($output, TRUE);
  }

  public function access_level()
  {
    $this->form_validation->set_rules($this->_access_level_validation_rules);
    if($this->form_validation->run())
    {
      $form = $this->input->post();
      $ins['role_id'] = $form['role_id'];
      $ins['menu_id'] = json_encode($form['menu']);
      $ins['access_level'] = json_encode($form['rights']);
      $chk = $this->admin_model->select("role_access",array("role_id"=>$form['role_id']));
      if($chk)
      {
        if(!$this->action->edit==1)
        {
          $this->session->set_flashdata("error_msg","Don't have rights to update access level.",TRUE);
          redirect("admin/access_level");
        }
        $ins['updated_date'] = date("Y-m-d H:i:s");
        $add = $this->admin_model->update(array("role_id"=>$form['role_id']),$ins,"role_access");
        $this->session->set_flashdata("success_msg","Access Level updated Successfully",TRUE);
      }
      else
      {
         if(!$this->action->create==1)
          {
            $this->session->set_flashdata("error_msg","Don't have rights to create access level.",TRUE);
            redirect("admin/access_level");
          }
        $ins['created_date'] = date("Y-m-d H:i:s");
        $add = $this->admin_model->insert($ins,"role_access");
        $this->session->set_flashdata("success_msg","Access Level created Successfully",TRUE);
      }
    }
    $this->layout->view('admin/access_level');
  }

  public function get_access_level()
  {
    $id = $this->input->post('id');
    $this->data['access'] = $this->admin_model->select("role_access",array("role_id"=>$id));
    $this->load->view('admin/ajax_access_level',$this->data);
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
        $table = "product_type";
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
      case '13':
        $table = "product_color";
        break;
    }
    return $table;
  }
}

?>