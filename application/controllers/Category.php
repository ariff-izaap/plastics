<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Category extends Admin_Controller 
{
	
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
			
     $this->load->model('category_model');
     $this->load->model('history_model');
	   $this->load->library('listing');
     
	} 
	
	
 	public function index()
    { 
             
        $this->layout->add_javascripts(array('listing'));  

        $this->load->library('listing');         
        
        $this->simple_search_fields = array('name'=> 'Name');
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('category/add/{id}').'" class="table-action"><i class="fa fa-edit edit"></i></a>
                <a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'category/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>
                ';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('category_model', 'listing');

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
        
        $this->layout->view("frontend/category/index");

			
    }
    
    public function add( $edit_id ='')
    {

        try
        {
          
            if($this->input->post('edit_id'))            
                $edit_id = $this->input->post('edit_id');

            $this->form_validation->set_rules('name','Category Name','trim|required');
            $this->form_validation->set_rules('description','Description','trim|required');         
            
            $this->form_validation->set_error_delimiters('', '');
                
            if ($this->form_validation->run())
            {
                $ins_data = array();
                $ins_data['name']                   = $this->input->post('name');
                $ins_data['description']            = $this->input->post('description');
                $ins_data['enabled']                = $this->input->post('enabled');
                
                if($edit_id){
                    $ins_data['updated_date'] = date('Y-m-d H:i:s');  
                    $this->category_model->update(array("id" => $edit_id),$ins_data);
                    $msg  = 'Category updated successfully';
                    log_history($edit_id,'category'," Category <b>".$ins_data['name']."</b> has been updated.");
                }
                else
                {    
                    $ins_data['created_date'] = date('Y-m-d H:i:s'); 
                    $ins_data['updated_date'] = date('Y-m-d H:i:s');
                    $ins = $this->category_model->insert($ins_data);  
                    log_history($ins,'category'," Category <b>".$ins_data['name']."</b> has been inserted.");
                    $msg = 'Category added successfully';
                }
                $this->session->set_flashdata('success_msg',$msg,TRUE);
                redirect('category');
            }    
            else
            {            
              $edit_data = array();
              $edit_data['id']              = '';
              $edit_data['name']            = '';
              $edit_data['description']     = '';
              $edit_data['enabled']         = '1';
            }
        }
        catch (Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();
        }

        if($edit_id)
            $edit_data =$this->category_model->get_where(array("id" => $edit_id))->row_array();

        $this->data['editdata']  = $edit_data;
        $this->layout->view('frontend/category/add');
    }
    
    public function delete($del_id)
    {
        $access_data = $this->category_model->get_where(array("id"=>$del_id),'id')->row_array();
        $output=array();

        if(count($access_data) > 0){
            $this->category_model->delete(array("id"=>$del_id));
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
