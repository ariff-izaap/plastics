<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Note extends Admin_Controller 
{
	
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
			
       $this->load->model('note_model');
       $this->keys = array('shipment', 'vendor', 'purchase_order', 'sales_order', 'refund', 'return', 'exceptional','product');
	} 
	
	 public function save()
  	 {
  		  $output = array();
        $form_data = $this->_get_form_data();
        
        if(!$form_data)
        {
          $output['status'] = 'error';
          $output['message'] = $this->error_message;
        }
        else
        {
          $id = ($form_data['line'] == 'sales_order')?'sales_order_id':($form_data['line'] == 'purchase_order')?'purchase_order_id':"";
            
          $insert_data = array();
          $insert_data[$id]               = $form_data['action_id'];
          $insert_data['message']         = $form_data['message'];
          $insert_data['created']         = date ("Y-m-d H:i:s", local_to_gmt());
          
          $this->note_model->insert($insert_data);
          
          $output['status'] = 'success';
          $output['key']    = $form_data['line'];
          $output['val']    = $form_data['action'];
        }
        
        if($this->input->is_ajax_request())
          $this->_ajax_output($output, TRUE);


        return $output;
  	}
	
   function _get_form_data()
    {

      try
      {
        
            $flag = FALSE;
            if($this->input->post('line') && in_array($this->input->post('line'),$this->keys))
              $flag = TRUE;
    
            if(!$flag)
              throw new Exception("Key is invalid.");
            
            $message = $this->input->post('message');  
            if(!$message || strcmp(trim($message), '') === 0)
              throw new Exception("Your are trying to submit an empty note. Please write your note and submit again");
            
            return array('line' => $this->input->post('line'), 'action' => $this->input->post('action_id'), 'message' => $message);
      }
      catch(Exception $e)
      {
            $this->error_message = $e->getMessage();
            return FALSE;
      }
      

    }
}
?>
