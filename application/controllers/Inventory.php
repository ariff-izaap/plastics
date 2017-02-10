<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Inventory extends Admin_Controller 
{
	
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
			
       $this->load->model('dashboard_model');
	   $this->load->library('listing');    
     
	} 
	
	
	 public function index()
    { 
             
        $this->layout->add_javascripts(array('listing'));  

        $this->load->library('listing');         
    
		$this->layout->view('frontend/inventory/add');	
		

			
    }
    
   
  
    
}
?>
