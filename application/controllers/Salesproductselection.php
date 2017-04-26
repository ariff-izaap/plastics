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
			
       $this->load->model(array('inventory_model','salesorder_model','purchase_model'));
	   $this->load->library('listing');    
       $this->load->library('cart');
	} 
	
	
	 public function index()
     {         
        $this->layout->add_javascripts(array('listing','salesorder'));  

        $this->load->library('listing');         
           
        $this->simple_search_fields = array();
         
        $this->_narrow_search_conditions = array("name","quantity","package_id","form_id","color_id","type","equivalent","row","units","wholesale","internal_lot_no","vendor_lot_no","received_in_warehouse");
        
        $str = '<button type="button" id="addcart{id}" name="add_to_cart" onclick="product_add_to_shipment({id})" data-price="{wholesale_price}" data-qty="{quantity}" class="btn btn-info"><i class="fa fa-plus"></i> Add To Cart</button>';
 
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
        $this->data['cartitems']  = $this->cart->contents();
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
    
     $type               = $this->input->post("type");
     if($type == 'single'){
         //post data
         $available_quantity = $this->input->post("quantity_available");
         $order_quantity     = $this->input->post("quantity_to_order");
         $product_id         = $this->input->post("product_id");
        // $type_of_sale       = $this->input->post("type_of_sale");
         //$product_from       = $this->input->post("product_from");
         $price              = $this->input->post("price");
        // $type               = $this->input->post("type");
         
         //getting data from db
         $result             = $this->inventory_model->get_product_details($product_id);
         $sale_type          = $this->inventory_model->get_where(array("id" => $type_of_sale),'*','sale_type')->row_array();
         
         $cart_data          = array(
                                    'id'           => $product_id,
                                    'qty'          => $order_quantity,
                                    'price'        => $price,
                                    'name'         => $result['name'],
                                    'form'         => $result['form_name'],
                                    'color'        => $result['color_name'],
                                    'package'      => $result['package_name'],
                                    'type'         => $result['item_type'],
                                    'row'          => $result['row'],
                                    'equivalent'   => $result['equivalent'],
                                    'vendor_id'    => $result['vendor_id'],
                               );
                               
    }
    else
    {
         $product_ids = $this->input->post("ids");
         
         $product_ids = explode(",",$product_ids);
         
         $i = 0; $cart_data = array();
         foreach($product_ids as $pvalue){
            
            $result = $this->inventory_model->get_product_details($pvalue);;
            
            $cart_data[$i] = array(
                                    'id'           => $product_id,
                                    'qty'          => 1,
                                    'price'        => $result['retail_price'],
                                    'name'         => $result['name'],
                                    'form'         => $result['form_name'],
                                    'color'        => $result['color_name'],
                                    'package'      => $result['package_name'],
                                    'type'         => $result['item_type'],
                                    'row'          => $result['row'],
                                    'equivalent'   => $result['equivalent'],
                                    'vendor_id'    => $result['vendor_id'],
                               );
                               
           $i++;                               
         }
    } 
    
     $row_id                  = $this->cart->insert($cart_data);
     $this->data['cartitems'] = $this->cart->contents(); 
     $output['viewlist']      = $this->load->view("frontend/salesproductselection/cart_items",$this->data,true);
     
     $output['message']       = "Product added to cart successfully";
     $output['status']        = "success";   
     $this->_ajax_output($output, TRUE);
   }
   
   
   public function delete_cart()
   {
        $cart_id  = $this->input->post("id");
        $result   = $this->cart->remove($cart_id);
        
        $output['message']       = "Item removed from cart successfully";
        $output['status']        = "success";   
        
        $this->data['cartitems'] = $this->cart->contents(); 
        $output['viewlist']      = $this->load->view("frontend/salesproductselection/cart_items",$this->data,true);
     
        $this->_ajax_output($output, TRUE);
   }
   
   public function update_cart()
   {
        $this->load->library('cart');
        
        $cart_id  = $this->input->post("id");
        $quantity = $this->input->post('quantity');
        
        if(!empty($quantity)){
        $update_cart = array(  "rowid" => $cart_id,
                                "qty" => $quantity
                             );
        $result      = $this->cart->update($update_cart);
        $output['message']       = "Item updated successfully";
        $output['status']        = "success";   
        $this->data['cartitems'] = $this->cart->contents();
        $output['viewlist']      = $this->load->view("frontend/salesproductselection/cart_items",$this->data,true);
      
        $this->_ajax_output($output, TRUE);
      }  
   }
   
   function get_customer_information($so_id = '')
   {
         $cust_id  = $this->input->post("id");
         $customer = $this->salesorder_model->get_vendors(array("a.id" => $cust_id));
       
         $this->data['custome_data'] = '';
         if(count($customer)>0){
            $this->data['customer_data'] = $customer;
            $output['status']            = "success";
         }
         else
         {
           $this->data['customer_data']['status']  = "new";  
           $output['status']                       = "error"; 
         }
          
         $output['customer_view']= $this->load->view("frontend/sales/customer_details",$this->data,true);
         $this->_ajax_output($output, TRUE);
   }
}
?>
