<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Inventory extends Admin_Controller 
{
	
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
			
       $this->load->model('inventory_model');
	   $this->load->library('listing');    
     
	} 
	
	
	 public function index()
    { 
             
        $this->layout->add_javascripts(array('listing'));  

        $this->load->library('listing');         
        
        $this->simple_search_fields = array(                                                
                                    'p.name'         => 'Name',
                                    'p.sku'          => 'Sku',
                                    'p.quantity'     => 'Quantity',
                                    'p.created_date' => 'Created Date',
                                    'pk.name' => 'Package Name',
                                    'f.name' => 'Form Name',
                                    'c.name' => 'Color Name'
                                    //'c.email'      => 'Email'                                            
        );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="'.site_url('inventory/add/{id}').'" class="table-action"><i class="fa fa-edit edit"></i></a>
                <a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'inventory/delete/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>
                ';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('inventory_model', 'listing');

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
        
        $this->layout->view("frontend/inventory/index");

			
    }
    
    public function add( $edit_id ='')
    {

        try
        {
            if($this->input->post('edit_id'))            
                $edit_id = $this->input->post('edit_id');

            $this->form_validation->set_rules('name','Product Name','trim|required');
            $this->form_validation->set_rules('sku','Sku','trim|required');
            $this->form_validation->set_rules('quantity','Quantity','trim|required');
            $this->form_validation->set_rules('internal_lot_no','Internal lot no','trim|required');
            $this->form_validation->set_rules('vendor_lot_no','Vendor lot no','trim|required');
            $this->form_validation->set_rules('shipping_cost','Shipping Cost','trim|required');
            $this->form_validation->set_rules('color_id','Color','trim|required');
            $this->form_validation->set_rules('form_id','Form','trim|required');
            $this->form_validation->set_rules('package_id','Package','trim|required');
            $this->form_validation->set_rules('category_id','Color','trim|required');
          
//            $this->form_validation->set_rules('fax','Fax','trim');
//            $this->form_validation->set_rules('address','Address','trim|required');
//            $this->form_validation->set_rules('note','Note','trim');

            $this->form_validation->set_error_delimiters('', '');
                
            if ($this->form_validation->run())
            {
                $ins_data = array();
                $ins_data['sku']                    = $this->input->post('sku');
                $ins_data['name']                   = $this->input->post('name');
                $ins_data['quantity']               = $this->input->post('quantity');
                $ins_data['category_id']            = $this->input->post('category_id');
                $ins_data['color_id']               = $this->input->post('color_id');
                $ins_data['form_id']                = $this->input->post('form_id');
                $ins_data['package_id']             = $this->input->post('package_id');
                $ins_data['retail_price']           = $this->input->post('retail_price');
                $ins_data['wholesale_price']        = $this->input->post('wholesale_price');
                $ins_data['shipping_cost']          = $this->input->post('shipping_cost');
                $ins_data['ref_no']                 = $this->input->post('ref_no');
                $ins_data['internal_lot_no']        = $this->input->post('internal_lot_no');
                $ins_data['vendor_lot_no']          = $this->input->post('vendor_lot_no');
                $ins_data['received_at_customer']   = $this->input->post('received_at_customer');
                $ins_data['received_in_warehouse']  = $this->input->post('received_in_warehouse');
                
                

                if($edit_id)
                {
                    $ins_data['updated_date'] = date('Y-m-d H:i:s'); 
                    $ins_data['updated_id']   = get_current_user_id();    
                    $this->inventory_model->update(array("id" => $edit_id),$ins_data);

                    $msg  = 'Product updated successfully';
                }
                else
                {    
                    $ins_data['created_date'] = date('Y-m-d H:i:s'); 
                    $ins_data['updated_date'] = date('Y-m-d H:i:s');
                    $ins_data['created_id']   = get_current_user_id();  

                    $this->inventory_model->insert($ins_data);

                    $msg = 'Product added successfully';
                }

                $this->session->set_flashdata('success_msg',$msg,TRUE);

                redirect('inventory');
            }    
            else
            {
            
                $edit_data = array();
                $edit_data['id']                    = '';
                $edit_data['sku']                   = '';
                $edit_data['name']                  = '';
                $edit_data['color_id']              = '';
                $edit_data['form_id']               = '';
                $edit_data['package_id']            = '';
                $edit_data['quantity']              = '';
                $edit_data['retail_price']          = '';
                $edit_data['wholesale_price']       = '';
                $edit_data['shipping_cost']         = '';
                $edit_data['ref_no']                = '';
                $edit_data['internal_lot_no']       = '';
                $edit_data['vendor_lot_no']         = '';
                $edit_data['received_at_customer']  = '';
                $edit_data['received_in_warehouse'] = '';
            }

        }
        catch (Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();
                
        }

        if($edit_id)
            $edit_data =$this->inventory_model->get_where(array("id" => $edit_id))->row_array();

        $this->data['editdata']   = $edit_data;
        $this->data['colors']     = $this->inventory_model->get_where(array(),"*","product_color")->result_array();
        $this->data['forms']      = $this->inventory_model->get_where(array(),"*","product_form")->result_array();
        $this->data['packages']   = $this->inventory_model->get_where(array(),"*","product_packaging")->result_array();
        $this->data['categories'] = $this->inventory_model->get_where(array(),"*","category")->result_array();

        $this->layout->view('frontend/inventory/add');

    }
    
    public function delete($del_id)
    {
        $access_data = $this->inventory_model->get_where(array("id"=>$del_id),'id')->row_array();
       
        $output=array();

        if(count($access_data) > 0){

            $this->inventory_model->delete(array("id"=>$del_id));

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
