<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Address extends Admin_Controller 
{
	
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
			
     $this->load->model('address_model');
     $this->load->library('listing');
     
     $address_data = $this->address_model->get_where(array("created_id" => get_current_user_id()))->result_array();
     //echo "<pre>";
    // print_r($address_data);
     $this->data['address_id'] = (count($address_data)==1)?$address_data[0]['id']:""; 
	} 

    public function add( $edit_id ='')
    {
        try
        {
            if($this->input->post('edit_id'))            
                $edit_id = $this->input->post('edit_id');

            $this->form_validation->set_rules('name','Name','trim|required');
            $this->form_validation->set_rules('first_name','Firstname','trim|required');
            $this->form_validation->set_rules('last_name','Lastname','trim|required'); 
            $this->form_validation->set_rules('company','Company','trim|required'); 
            $this->form_validation->set_rules('address1','Address 1','trim|required');
            $this->form_validation->set_rules('address2','Address 2','trim|required'); 
            $this->form_validation->set_rules('city','City','trim|required'); 
            $this->form_validation->set_rules('state','State','trim|required'); 
            $this->form_validation->set_rules('country','Country','trim|required');
            $this->form_validation->set_rules('zipcode','Zipcode','trim|required');
            $this->form_validation->set_rules('phone','Phonenumber','trim|required'); 
                      
            
            $this->form_validation->set_error_delimiters('', '');
                
            if ($this->form_validation->run()){
                $ins_data = array();
                $ins_data['name']                   = $this->input->post('name');
                $ins_data['first_name']             = $this->input->post('first_name');
                $ins_data['last_name']              = $this->input->post('last_name');
                $ins_data['company']                = $this->input->post('company');
                $ins_data['address1']               = $this->input->post('address1');
                $ins_data['address2']               = $this->input->post('address2');
                $ins_data['city']                   = $this->input->post('city');
                $ins_data['state']                  = $this->input->post('state');
                $ins_data['country']                = $this->input->post('country');
                $ins_data['zipcode']                = $this->input->post('zipcode');
                $ins_data['phone']                  = $this->input->post('phone');
                //echo $edit_id; exit;
                if($edit_id){
                    $ins_data['updated_date'] = date('Y-m-d H:i:s');
                    $ins_data['updated_id']   = get_current_user_id();   
                    $this->address_model->update(array("id" => $edit_id),$ins_data);
                    $msg  = 'Address updated successfully';
                }
                else
                {    
                    $ins_data['created_date'] = date('Y-m-d H:i:s'); 
                    $ins_data['updated_date'] = date('Y-m-d H:i:s');
                    $ins_data['created_id']   = get_current_user_id();  
                    $ins = $this->address_model->insert($ins_data);                  
                    $msg = 'Address added successfully';
                }
                $this->session->set_flashdata('success_msg',$msg,TRUE);
                redirect("address/add/$edit_id");
            }    
            else
            {            
              $edit_data = array();
              $edit_data['id']          = '';
              $edit_data['name']        = '';
              $edit_data['first_name']  = '';
              $edit_data['last_name']   = '';
              $edit_data['company']     = '';
              $edit_data['address1']    = '';
              $edit_data['address2']    = '';
              $edit_data['city']        = '';
              $edit_data['state']       = '';
              $edit_data['country']     = '';
              $edit_data['zipcode']     = '';
              $edit_data['phone']       = '';
              
            }
        }
        catch (Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();
        }

        if($edit_id)
            $edit_data = $this->address_model->get_where(array("id" => $edit_id))->row_array();

        $this->data['editdata']  = $edit_data;
        $this->layout->view('frontend/address/add');
    }
    
    
}
?>
