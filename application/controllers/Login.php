<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Login extends Admin_controller 
{
    protected $_login_validation_rules =array (
                                        array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email'),
                                        array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required|alpha_dash')
                                      );
    function __construct()
    {
        parent::__construct();  
        
        $this->load->model('login_model');
       
    }  
    public function index()
    {
        if(is_logged_in())
            redirect('dashboard');
        
        $this->login();
    }
    
    public function login()
    {
      $this->form_validation->set_rules($this->_login_validation_rules);
       
        if($this->form_validation->run())
        {
            $form = $this->input->post();
            $chk = $this->login_model->login($form['email'], $form['password']);
            if($chk)
            {
              if($this->input->post('forGot')=="on")
                setcookie("login",json_encode($_POST),time() + (86400 * 30), "/");
              redirect("dashboard");
            }
            else
            { 
                $this->session->set_flashdata("log_fail1","Invalid Username or Password",TRUE);
                redirect("login");
            }
            
        }
        
        $this->layout->view("login/index");
        
    }
    
    public function logout()
	{
	   
		$this->session->sess_destroy();
	
    	$this->service_message->set_flash_message('logout_success');
	
		redirect('login');
	}
    
}
?>