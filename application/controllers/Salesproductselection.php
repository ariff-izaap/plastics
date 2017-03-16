<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Salesproductselection extends Admin_Controller 
{
	public  $data = array();

    private $upload_path     = './assets/images/';
    private $upload_doc_path = './assets/uploads/product/';
    
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
			
       $this->load->model(array('inventory_model','salesorder_model'));
	   $this->load->library('listing');    
       $this->load->library('cart');
	} 
	
	
	 public function index()
     {         
        $this->layout->add_javascripts(array('listing'));  

        $this->load->library('listing');         
           
        $this->simple_search_fields = array();
         
        $this->_narrow_search_conditions = array("name","quantity","package_id","form_id","color_id","type","equivalent","row","units","wholesale","internal_lot_no","vendor_lot_no","received_in_warehouse");
        
        $str = '';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('inventory_model', 'listing');

        if($this->input->is_ajax_request())
            $this->_ajax_output(array('listing' => $listing), TRUE);
        
        $this->data['bulk_actions']         = array('' => 'select', 'delete' => 'Delete');
        $this->data['simple_search_fields'] = $this->simple_search_fields;
        $this->data['search_conditions']    = $this->session->userdata($this->namespace.'_search_conditions');
        $this->data['per_page']             = $this->listing->_get_per_page();
        $this->data['per_page_options']     = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
        
        $this->data['search_bar'] = $this->load->view('frontend/salesproductselection/search_bar', $this->data, TRUE);        
        $this->data['listing']    = $listing;
        $this->data['salestype']  = $this->salesorder_model->get_where(array("status" => 1),"*","sale_type")->result_array();
        $this->data['grid']       = $this->load->view('listing/view', $this->data, TRUE);
        
        $this->layout->view("frontend/salesproductselection/index");
	
    }
    
    public function add( $edit_id ='')
    {
        $this->layout->add_javascripts(array('fileinput.min','fileinput','product'));
        $this->layout->add_stylesheets(array('fileinput.min','fileinput'));
        try
        {
           
          $this->form_validation->set_error_delimiters('', '');
          if($this->form_validation->run()){

              $this->session->set_flashdata('success_msg',$msg,TRUE);
              $status  = 'success';
          }    
          else
          {
            
          }
        }
        catch (Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();
        }

        if($edit_id)
        {
          $edit_data = $this->inventory_model->get_where(array("id" => $edit_id))->row_array();
          $images    = $this->inventory_model->get_where(array("product_id" => $edit_id),'*','product_images')->result_array();
          $pricelists= $this->inventory_model->get_where(array("product_id" => $edit_id),'*','vendor_price_list')->result_array();
        }    

        
        if($this->input->is_ajax_request()){
          $output  = $this->load->view('frontend/inventory/add',$this->data,true);
          return    $this->_ajax_output(array('status' => $status ,'output' => $output, 'edit_id' => $edit_id), TRUE);
        }
        else
        {
          $this->layout->view('frontend/inventory/add');
        }    
    }
    
    public function delete($del_id)
    {
        $access_data = $this->inventory_model->get_where(array("id"=>$del_id),'id')->row_array();
        $output      =  array();

        if(count($access_data) > 0){
            $this->inventory_model->delete(array("id"=>$del_id));
            $output['message'] = "Record deleted successfuly.";
            $output['status']  = "success";
        }
        else
        {
           $output['message'] = "This record not matched by Inventory.";
           $output['status']  = "error";
        }
        $this->_ajax_output($output, TRUE);   
    }
    
    public function do_upload()
    {
        try
        {
            $form  = $this->input->post(NULL, TRUE);
            $field = $form['field'];

            if(!isset($form['upload_folder']))
                 throw new Exception("Upload folder is empty!");

            $config['upload_path']   = $this->upload_path.$form['upload_folder'].'/';
            $config['allowed_types'] = (isset($form['types']) && !empty($form['types']))?$form['types']:'gif|jpg|png|jpeg';
            $config['max_size']      = '10000';
           
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload("$field"))            
               throw new Exception($this->upload->display_errors());
               
            $files = $this->upload->data();  
            
            $ins_data = array();
            $ins_data['file_name']      = $files['file_name'];
            $new_id = $this->inventory_model->insert($ins_data,'product_images');

            $this->data['fileuploaded']   = $files['file_name'];
            $this->data['image_id']       = $new_id;                 
        }
        catch(Exception $e)
        {
            $this->data['error'] = $e->getMessage();    
        }     

        echo json_encode($this->data);
        exit;
    }
    
    
    public function update_image_title()
    {
        $form     = $this->input->post(NULL, TRUE);
        $ins_data = array();
        
        $ins_data['image_title'] = $form['image_title'];
        $ins_data['product_id']  = $form['product_id'];
        $upldid                  = $form['uploaded_id'];
        
        $new_id = $this->inventory_model->update(array("id" => $upldid),$ins_data,'product_images');
        
        $output['message'] ="Image Uploaded Successfully.";
        $output['status']  = "success";
            
        $this->_ajax_output($output, TRUE); 
    }
    
   public function add_to_cart()
   {
    
    
      $data = array(
            'id'      => 'sku_123ABC',
            'qty'     => 1,
            'price'   => 39.95,
            'name'    => 'T-Shirt',
            'options' => array('Size' => 'L', 'Color' => 'Red')
        );
   } 
   	
}
?>
