<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Inventory extends Admin_Controller 
{
	public  $data = array();

    private $upload_path     = './assets/images/';
    private $upload_doc_path = './assets/uploads/product/';
    
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
        //echo "coming"; exit;
        $this->layout->add_javascripts(array('fileinput.min','fileinput','product'));
        $this->layout->add_stylesheets(array('fileinput.min','fileinput'));
        try
        {
          if($this->input->post('edit_id'))            
            $edit_id = $this->input->post('edit_id');
          $this->form_validation->set_rules('name','Product Name','trim|required');
          $this->form_validation->set_rules('sku','Sku','trim|required');
          $this->form_validation->set_rules('quantity','Quantity','trim|required');
          $this->form_validation->set_rules('product','Product Type','trim|required');
          // $this->form_validation->set_rules('internal_lot_no','Internal lot no','trim|required');
          // $this->form_validation->set_rules('vendor_lot_no','Vendor lot no','trim|required');
          // $this->form_validation->set_rules('shipping_cost','Shipping Cost','trim|required');
          $this->form_validation->set_rules('color_id','Color','trim|required');
          $this->form_validation->set_rules('form_id','Form','trim|required');
          $this->form_validation->set_rules('package_id','Package','trim|required');
          $this->form_validation->set_rules('category_id','Color','trim|required');
          $this->form_validation->set_rules('row','Row','trim|required');
          $this->form_validation->set_rules('units','Units','trim|required');
          $this->form_validation->set_rules('weight','Weight','trim|required');
          
          // $this->form_validation->set_rules('in_stock','In Stock','trim|required');
          // $this->form_validation->set_rules('purchase_order_number','Purchase Order Number','trim|required');
          // $this->form_validation->set_rules('purchase_transportation_identifier','Purchase Transportation Identifier','trim|required');
          // $this->form_validation->set_rules('sales_transportation_identifier','Sales Transportation Identifier','trim|required');
          // $this->form_validation->set_rules('warehouse_id','Please select warehouse','trim|required');
          // $this->form_validation->set_rules('intransit_to_warehouse','Intransit to warehouse','trim|required');
          // $this->form_validation->set_rules('intransit_to_customer','Intransit to Customer','trim|required');
          //if(empty($_FILES['certificate_file_name']['name']) && empty($_POST['certification_files']))
          // {
          //		$this->form_validation->set_rules('certificate_file_name', 'Certificate', 'required');
          //}
          
          $this->form_validation->set_error_delimiters('', '');
          if ($this->form_validation->run())
          {
              // echo $this->input->post('sku'); exit;
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
          
              // $ins_data['shipping_cost']          = $this->input->post('shipping_cost');
          
              $ins_data['ref_no']                 = $this->input->post('ref_no');
              $ins_data['internal_lot_no']        = $this->input->post('internal_lot_no');
              $ins_data['vendor_lot_no']          = $this->input->post('vendor_lot_no');
              $ins_data['received_at_customer']   = $this->input->post('received_at_customer');
              $ins_data['received_in_warehouse']  = $this->input->post('received_in_warehouse');
              $ins_data['purchase_order_number']  = $this->input->post('purchase_order_number');
              $ins_data['weight']                 = $this->input->post('weight');
              $ins_data['row']                    = $this->input->post('row');
              $ins_data['notes']                  = $this->input->post('notes');
              $ins_data['product']                = $this->input->post('product');
              $ins_data['units']                  = $this->input->post('units');
              $ins_data['item_type']              = $this->input->post('item_type');
              $ins_data['in_stock']               = $this->input->post('in_stock');
              $ins_data['equivalent']             = $this->input->post('equivalent');
              $ins_data['warehouse_id']           = $this->input->post('warehouse_id');
              $ins_data['intransit_to_warehouse'] = $this->input->post('intransit_to_warehouse');
              $ins_data['intransit_to_customer']  = $this->input->post('intransit_to_customer');
              $ins_data['purchase_transportation_identifier']= $this->input->post('purchase_transportation_identifier');
              $ins_data['sales_transportation_identifier']   = $this->input->post('sales_transportation_identifier');
              $ins_data['certification_files']    = (isset($_POST['certification_files']))?$_POST['certification_files']:''; 
              
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
                $new_id  = $this->inventory_model->insert($ins_data);             
                $msg     = 'Product added successfully';
                $edit_id =  $new_id;
              }
              
              $this->session->set_flashdata('success_msg',$msg,TRUE);
              $status  = 'success';
          }    
          else
          {
            $edit_data = array();
            $edit_data['id']                    = (!empty($edit_id))?$edit_id:'';
            $edit_data['sku']                   = '';
            $edit_data['name']                  = '';
            $edit_data['color_id']              = '';
            $edit_data['form_id']               = '';
            $edit_data['package_id']            = '';
            $edit_data['category_id']           = '';
            $edit_data['quantity']              = '';
            $edit_data['retail_price']          = '';
            $edit_data['wholesale_price']       = '';
            $edit_data['shipping_cost']         = '';
            $edit_data['ref_no']                = '';
            $edit_data['internal_lot_no']       = '';
            $edit_data['vendor_lot_no']         = '';
            $edit_data['received_at_customer']  = '';
            $edit_data['received_in_warehouse'] = '';
            $edit_data['row']                   = '';
            $edit_data['notes']                 = '';
            $edit_data['product']               = '';
            $edit_data['units']                 = '';
            $edit_data['item_type']             = '';
            $edit_data['weight']                = '';
            $edit_data['in_stock']              = '';
            $edit_data['image_title']           = '';
            $edit_data['file_name']             = '';
            $edit_data['purchase_order_number'] = '';
            $edit_data['equivalent']             = '';
            $edit_data['warehouse_id']           = '';
            $edit_data['intransit_to_warehouse'] = '';
            $edit_data['intransit_to_customer']  = '';
            $edit_data['certification_files']    = '';
            $edit_data['purchase_transportation_identifier']= '';
            $edit_data['sales_transportation_identifier']   = '';
            $status = 'error';
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

        $this->data['editdata'] = $edit_data;
        $this->data['editdata']['images'] = (!empty($images))?$images:array();
        $this->data['editdata']['pricelts'] = (!empty($pricelists))?$pricelists:array();
        $this->data['colors'] = $this->inventory_model->get_where(array(),"*","product_color")->result_array();
        $this->data['forms'] = $this->inventory_model->get_where(array(),"*","product_form")->result_array();
        $this->data['packages'] = $this->inventory_model->get_where(array(),"*","product_packaging")->result_array();
        $this->data['categories'] = $this->inventory_model->get_where(array(),"*","category")->result_array();
        $this->data['warehouse'] = $this->inventory_model->get_where(array(),"*","warehouse")->result_array();
        if($this->input->is_ajax_request())
        {
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
           // $config['max_width']     = '300';
          //  $config['max_height']    = '100';

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
    
    public function certificate_upload()
    {
        
        try
        {
            $form  = $this->input->post(NULL, TRUE);
            $field = $form['field'];

            if(!isset($form['upload_folder']))
                 throw new Exception("Upload folder is empty!");

            $config['upload_path']   = $this->upload_doc_path.$form['upload_folder'].'/';
            $config['allowed_types'] = (isset($form['types']) && !empty($form['types']))?$form['types']:'doc|docx';
          
            $this->load->library('upload', $config);

            if(!$this->upload->do_upload("$field"))            
               throw new Exception($this->upload->display_errors());
               
            $files = $this->upload->data();  
            $this->data['fileuploaded']   = $files['file_name'];
                          
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
    
    public function product_image_delete($del_id,$table_name)
    {
        $access_data = $this->inventory_model->get_where(array("id"=>$del_id),'id',$table_name)->row_array();
        
        $output  = array();
        if(count($access_data) > 0){
            $this->inventory_model->delete(array("id"=>$del_id),$table_name);
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
    
    function vendor_add($product_id = 0, $edit_id = 0)
	{
		$this->load->model("product_vendor_model");
		$this->load->model("vendor_model");
      
		$ajax_return_data = array();
       
       if($_POST){
       
		if($this->input->post('edit_id'))
			$edit_id = $this->input->post('edit_id');

		if($this->input->post('product_id'))
			$product_id = $this->input->post('product_id');

		$vendor_id = $this->input->post('vendor_id');

		$rules = $this->get_price_list_rules($edit_id);

		$this->form_validation->set_rules($rules);

		if($this->form_validation->run())
		{
			$data = array();
			$data['vendor_id'] 			= $this->input->post("vendor_id", TRUE);
			$data['sku'] 				= $this->input->post("sku", TRUE);
		//	$data['ups'] 				= $this->input->post("ups", TRUE);
		//	$data['lead_time'] 			= $this->input->post("lead_time", TRUE);
			$data['cost'] 				= $this->input->post("cost", TRUE);
			$data['stock_level'] 		= $this->input->post("stock_level", TRUE);
			$data['enabled'] 			= $this->input->post("enabled", TRUE);
		//	$data['vendor_product_name']= $this->input->post("vendor_product_name", TRUE);
		//	$data['vendor_strict_map'] 	= $this->input->post("vendor_strict_map", TRUE);
			$data['priority'] 			= $this->input->post("priority", TRUE);
			$data['updated_id'] 		= getAdminUserId();
			$data['in_stock'] 			= $this->input->post("in_stock", TRUE);
			$data['in_bound'] 		    = $this->input->post("in_bound", TRUE);
			$data['dropship_fee'] 		= $this->input->post("dropship_fee", TRUE);
            $data['shipping_cost'] 	    = $this->input->post("shipping_cost", TRUE);
			$data['shipping_service'] 	= $this->input->post("shipping_service", TRUE);
            

			 
			//$product_sku = get_product_sku($product_id);
			//$vendor_name = get_vendor_name($vendor_id);

			if($edit_id)
			{
				//product vendor price list details update
				$this->product_vendor_model->update(array("id" => $edit_id),$data);
				$message = "Price list updated Successfully.";
			}
			else
			{
				$data['created_id'] 	= getAdminUserId();
				$data['created_date'] 	= date('Y-m-d H:i:s', local_to_gmt());
				$data['product_id'] 	= $product_id;
				 
				//product vendor price list  details add
				$insert_id = $this->product_vendor_model->insert($data);
				 
				$message = "Price list created successfully.";
				
			}
			$ajax_return_data['status']     = "success";
			$ajax_return_data['message']    = $message;
            $ajax_return_data['product_id'] = $product_id;

			$this->_ajax_output($ajax_return_data, TRUE);
		 }
       }
		if($edit_id){
			$edit_data =$this->product_vendor_model->get_where(array("id" => $edit_id))->row_array();
			$data['edit_data']= $edit_data;
		}
		else
		{
			$edit_data = array();
			$edit_data['id'] = '';
			$edit_data['product_id'] = '';
			$edit_data['vendor_id'] = '';
			$edit_data['sku'] = '';
		//	$edit_data['ups'] = '';
		//	$edit_data['lead_time'] = '';
			$edit_data['cost'] = '';
			$edit_data['stock_level'] = '';
			$edit_data['enabled'] = '1';
		//	$edit_data['vendor_product_name'] = '';
		//	$edit_data['vendor_strict_map'] = '';
			$edit_data['priority'] = '';
			$edit_data['in_stock'] = 'Yes';
			$edit_data['in_bound'] = '';
			$edit_data['dropship_fee'] = '';
			$edit_data['shipping_service'] = '';
            $edit_data['shipping_cost'] = '';

			$product_details = $this->inventory_model->get_where(array("id" => $product_id))->row_array();
			$edit_data['upc'] = (isset($product_details['upc']))?$product_details['upc']:"";

		}

		$data['product_id'] 	= $product_id;
		$data['edit_data'] 		= $edit_data;
		$data['vendor_list'] 	= $this->vendor_model->get_vendors( TRUE, array("status" => 1));
		$output = $this->load->view('/frontend/inventory/vendor/add_vendor',$data,TRUE);

		$ajax_return_data['status']    = "error";
		$ajax_return_data['form_view'] = $output;
		$this->_ajax_output($ajax_return_data, TRUE);
	}
    
   	function get_price_list_rules($edit_id = 0)
	{
		$rules = array(
				array('field' => 'vendor_id','label' => 'Vendor Id', 'rules' => 'required'),
				array('field' => 'sku','label' => 'SKU', 'rules' => 'trim|required'),
			//	array('field' => 'ups','label' => 'UPS', 'rules' => 'trim|required'),
				array('field' => 'cost','label' => 'Cost', 'rules' => 'trim|required|numeric|greater_than[0]'),
			//	array('field' => 'lead_time','label' => 'Lead Time', 'rules' => 'trim|required|integer'),
			//	array('field' => 'vendor_product_name','label' => 'Product Name', 'rules' => 'trim|required'),
			//	array('field' => 'vendor_strict_map','label' => 'Strict Map', 'rules' => "trim"), //|valid_map[".$this->input->post("cost")."]"
				array('field' => 'stock_level','label' => 'Stock Level', 'rules' => 'trim|required|is_natural'),
			//	array('field' => 'vendor_product_name','label' => 'Product Name', 'rules' => 'trim|required'),
				array('field' => 'priority','label' => 'Priority', 'rules' => 'trim|required|integer'),
				array('field' => 'in_stock','label' => 'In Stock', 'rules' => 'trim'),
			//	array('field' => 'auto_order','label' => 'Auto Order', 'rules' => 'trim|integer'),
				array('field' => 'enabled','label' => 'Enabled', 'rules' => 'trim|integer')
				 
		);
		 
		return $rules;
	}
    
   function getproduct($product_id)
   {
        $result = $this->inventory_model->get_where(array("id" => $product_id))->row_array();
        
        $output['product'] = $result;
        $output['status']  = "success";
            
        $this->_ajax_output($output, TRUE); 
   } 
}
?>
