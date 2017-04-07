<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Shipment extends Admin_Controller 
{
	
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
			
       $this->load->model('shipment_model');
	   $this->load->library('listing');    
	} 
    
    function view($ship_id)
    {
        try
        {
            if(!$ship_id)
                throw new Exception("Invalid Shipment Id");
            
            $this->data['ship_data'] = $this->shipment_model->get_where(array("id"=>$ship_id),'*')->row_array();
            $this->data['carrier']   = get_carrier();
            $this->data['status']    = array(array("name" => "NEW"),array("name" => "PENDING"),array("name" => "HOLD"),array("name" => "COMPLETED"),array("name" => "CANCELED"));
            $this->layout->view("frontend/shipment/view", $this->data);         
        }
        catch(Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();   
        }
    }
    
    public function delete($del_id)
    {
        $access_data = $this->vendor_model->get_where(array("id"=>$del_id),'id')->row_array();
       
        $output=array();

        if(count($access_data) > 0){

            $this->vendor_model->delete(array("id"=>$del_id));

            $output['message'] ="Record deleted successfuly.";
            $output['status']  = "success";
        }
        else
        {
           $output['message'] ="This record not matched by Inventory.";
           $output['status']  = "error";
        }
        
        $this->_ajax_output($output, TRUE);
            
    }
    
}
?>
