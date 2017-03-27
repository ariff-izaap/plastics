<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH."libraries/Admin_controller.php");

class Salesorder extends Admin_Controller 
{	
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
			
    $this->load->model(array('salesorder_model','purchase_model'));
    $this->load->model('admin_model');
	  $this->load->library('listing');
      $this->load->library('cart');    
	} 
	
	 public function index()
     { 
        $this->data['shipping_type'] = $this->db->query("select * from shipping_type where 1=1")->result_array();
        $this->data['credit_type']   = $this->db->query("select * from credit_type where 1=1")->result_array();
        $this->data['cartitems']     = $this->cart->contents();           
        $this->data['customer']      = $this->purchase_model->get_vendors();
        $this->layout->view("frontend/sales/checkout");		
     }
    
    public function add( $edit_id ='')
    {
        try
        {
            if($this->input->post('edit_id'))            
                $edit_id = $this->input->post('edit_id');

            $this->form_validation->set_rules('business_name','Business Name','trim|required');
            $this->form_validation->set_rules('credit_type','Credit Type','trim|required');
           
            $this->form_validation->set_error_delimiters('', '');
                
            if ($this->form_validation->run()){
                $ins_data = array();
                $ins_data['business_name']          = $this->input->post('business_name');
                $ins_data['credit_type']            = $this->input->post('credit_type');
                $ins_data['web_url']                = $this->input->post('web_url');
                $ins_data['ups']                    = $this->input->post('ups');
                $ins_data['address_id']             = $this->input->post('address_id');
                $ins_data['status']                 = $this->input->post('status');
                
                if($edit_id){
                    $ins_data['updated_date'] = date('Y-m-d H:i:s'); 
                    //$ins_data['updated_id']   = get_current_user_id();    
                    $this->salesorder_model->update(array("id" => $edit_id),$ins_data);
                    $msg  = 'Salesorder updated successfully';
                }
                else
                {    
                    $ins_data['created_date'] = date('Y-m-d H:i:s'); 
                    $ins_data['updated_date'] = date('Y-m-d H:i:s');
                   // $ins_data['created_id']   = get_current_user_id();  
                    $this->salesorder_model->insert($ins_data);
                    $msg = 'Salesorder added successfully';
                }
                $this->session->set_flashdata('success_msg',$msg,TRUE);
                redirect('salesorder');
            }    
            else
            {
                $edit_data = array();
                $edit_data['id']                     = '';
                $edit_data['business_name']          = '';
                $edit_data['credit_type']            = '';
                $edit_data['web_url']                = '';
                $edit_data['ups']                    = '';
                $edit_data['address_id']             = '';
                $edit_data['status']                 = '';
            }
        }
        catch (Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();   
        }
        if($edit_id)
            $edit_data =$this->salesorder_model->get_where(array("id" => $edit_id))->row_array();
        
        $edit_data['address']    = $this->salesorder_model->get_where(array('created_id' => get_current_user_id()),"*","address")->result_array();
        
         
        $this->data['editdata']  = $edit_data;
        $this->layout->view('frontend/sales/add');
    }
    
    public function delete($del_id)
    {
        $access_data = $this->salesorder_model->get_where(array("id"=>$del_id),'id')->row_array();
       
        $output=array();

        if(count($access_data) > 0){
            $this->salesorder_model->delete(array("id"=>$del_id));
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
    
  public function delete_customer($del_id)
  {  
    $output['message'] ="Record deleted successfuly.";
    $output['status']  = "success";
    $log = log_history("customer",$del_id,"customer","delete");
    $this->admin_model->delete(array("id"=>$del_id),"customer");
    $this->_ajax_output($output, TRUE);
  }

    public function productselection() 
    {
        try
        {
          
              $this->form_validation->set_rules('product_id','Product Name','trim|required');
              $this->form_validation->set_error_delimiters('', '');
              
               if($this->form_validation->run()){
                    $product_id      = $_POST['product_id']; 
                    $form_id         = $_POST['form_id'];
                    $packaging       = $_POST['packaging'];
                    $customer_no     = $_POST['customer_number'];
                    $customer_na     = $_POST['customer_name'];
                    $color_id        = $_POST['color_id'];
                    $notes           = $_POST['notes'];
                    $prod_on_the_way = $_POST['include_product_on_the_way'];
                    $od_bt_not_shiped= $_POST['ordered_but_not_shipped'];
                    $in_warehouse    = $_POST['in_warehouse'];
                    $type            = $_POST['type'];
                    $equivalent      = $_POST['equivalent'];
                    $quantity        = $_POST['quantity'];
                    $quan_uses       = $_POST['quantity_uses'];
                    $quan_uses_chk   = $_POST['quantity_uses_check'];
                    $row             = $_POST['row'];
                    $row_check       = $_POST['row_uses_check'];
                    $units           = $_POST['units'];
                    $unts_uses_chk   = $_POST['units_uses_check'];
                    $wholesale       = $_POST['wholesale'];
                    $reference       = $_POST['reference'];
                    $internal_lot_no = $_POST['internal_lot_no'];
                    $vendor_lot_no   = $_POST['vendor_lot_no'];
                  
                   
                    $where = '';
                
                    if(!empty($product_id)){
                        $where .= "p.name like '%".$product_id."%'";
                    }
                   // if(!empty($form_id)){
            //            $where .= " or form_id like '%".$form_id."%'";
            //        }
            //        
            //        if(!empty($packaging)){
            //            $where .= " or package_id like '%".$packaging."%'";
            //        }
            //        if(!empty($color_id)){
            //            $where .= " or color_id like '%".$color_id."%'";
            //        }
            //        if(!empty($notes)){
            //            $where .= " or notes like '%".$notes."%'";
            //        }
            //        if(!empty($row)){
            //            $where .= " or row like '%".$row."%'";
            //        }
            //        if(!empty($quantity)){
            //            $where .= " or quantity='".$quantity."'";
            //        }
            //        if(!empty($equivalent)){
            //            $where .= " or equivalent='".$equivalent."'";
            //        }
            //        if(!empty($units)){
            //            $where .= " or units like '%".$units."%'";
            //        }
            //        if(!empty($type)){
            //            $where .= " or item_type like '%".$type."%'";
            //        }
            //        if(!empty($internal_lot_no)){
            //            $where .= " or internal_lot_no='".$internal_lot_no."'";
            //        }
            //        if(!empty($vendor_lot_no)){
            //            $where .= " or vendor_lot_no='".$vendor_lot_no."'";
            //        }
            //        
                      $this->data['product_data'] = $this->db->query("select p.*,pf.name as formname,pc.name as colorname,pa.name as packagename from product p 
                                                                       inner join product_form pf on pf.id=p.form_id
                                                                       inner join product_color pc on pc.id=p.color_id
                                                                       inner join product_packaging pa on pa.id=p.package_id
                                                                       where $where ")->result_array();
                      $this->session->set_flashdata('success_msg',$msg,TRUE);
                      $status  = 'success';
                  }    
                  else
                  {
                    $edit_data = array();
                    $edit_data['product_id']  = '';
                    $status = 'error';
                  }
            }
            catch (Exception $e)
            {
                $this->data['status']   = $status;
                $this->data['message']  = $e->getMessage();
            }

         
          $this->data['products']            = $this->salesorder_model->get_where(array(),"*","product")->result_array();  
          $this->data['colors']              = $this->salesorder_model->get_where(array(),"*","product_color")->result_array();
          $this->data['forms']               = $this->salesorder_model->get_where(array(),"*","product_form")->result_array();
          $this->data['packages']            = $this->salesorder_model->get_where(array(),"*","product_packaging")->result_array();
          $this->data['salestype']           = $this->salesorder_model->get_where(array("status" => 1),"*","sale_type")->result_array();
        
        if($this->input->is_ajax_request()){
           $output = ''; 
          $output  = $this->load->view('frontend/sales/productselection',$this->data,true);
          return    $this->_ajax_output(array('status' => $status ,'output' => $output), TRUE);
        }
        else
        {
          $this->layout->view('frontend/sales/productselection');
        } 
    }
    
    public function shippingorder()
    {
      $this->data['products']            = $this->salesorder_model->get_where(array(),"*","product")->result_array();  
      $this->data['colors']              = $this->salesorder_model->get_where(array(),"*","product_color")->result_array();
      $this->data['forms']               = $this->salesorder_model->get_where(array(),"*","product_form")->result_array();
      $this->data['packages']            = $this->salesorder_model->get_where(array(),"*","product_packaging")->result_array();
          
      $this->layout->view('frontend/sales/shippingorder');  
    }
    
    public function search()
    {
        $this->data['users']  = $this->db->query("select * from customer where 1=1")->result_array();
        $this->data['credit']  = $this->db->query("select * from credit_type where 1=1")->result_array();
        $this->layout->view('frontend/sales/search');
    }
    
    public function calllog()
    {
        try
        {
            if($_POST){
                $ins_data = array();
                $ins_data['call_type']    = (isset($_POST['call_type']))?$_POST['call_type']:"";
                $ins_data['log_date']     = $_POST['call_time'];
                $ins_data['call_log']     = $_POST['call_log'];
                $ins_data['user_id']      = get_current_user_id();
                $ins_data['created_date'] = date("Y-m-d H:i:s");
            }
        }
        catch(Exception $e)
        {
            
        }
        $this->data['users']  = $this->db->query("select * from customer where 1=1")->result_array();
        $this->data['credit']  = $this->db->query("select * from credit_type where 1=1")->result_array();
        $this->layout->view('frontend/sales/calllog');
    }
    
    public function callback()
    {
        try
        {
            if($_POST){
                $ins_data = array();
                $ins_data['user_to_notify']     = $_POST['salesman_to_notify'];
                $ins_data['next_callback_date'] = $_POST['date_time'];
                $ins_data['created_date']       = date("Y-m-d H:i:s");
                $ins_data['cb_message']         = $_POST['callback_message'];
            }
        }
        catch(Exception $e)
        {
            
        }
        
        $this->data['users']  = $this->db->query("select * from customer where 1=1")->result_array();
        $this->data['credit']  = $this->db->query("select * from credit_type where 1=1")->result_array();
        $this->layout->view('frontend/sales/callback');
    }
    
    public function checkout()
    {
        try
        {
          if($this->input->post('edit_id'))            
            $edit_id = $this->input->post('edit_id');
           
          $this->form_validation->set_rules('customer_id','Please select Customer','trim|required');  
          
          $this->form_validation->set_rules('business_name','Business Name','trim|required');
          $this->form_validation->set_rules('first_name','Billing Firstname','trim|required');
          $this->form_validation->set_rules('last_name','Billing Lastname','trim|required');
          $this->form_validation->set_rules('email','Billing Email','trim|required');
          $this->form_validation->set_rules('mobile','Billing Phonenumber','trim|required');
          $this->form_validation->set_rules('address1','Billing Address 1','trim|required');
          $this->form_validation->set_rules('city','Billing City','trim|required');
          $this->form_validation->set_rules('state','Billing State','trim|required');
          $this->form_validation->set_rules('zipcode','Billing Zipcode','trim|required');
          $this->form_validation->set_rules('ship_first_name','Shipping Firstname','trim|required');
          $this->form_validation->set_rules('ship_first_name','Shipping Firstname','trim|required');
          $this->form_validation->set_rules('ship_last_name','Shipping Lastname','trim|required');
          $this->form_validation->set_rules('ship_mobile','Mobile','trim|required');
          $this->form_validation->set_rules('ship_address1','Shipping Address 1','trim|required');
          $this->form_validation->set_rules('ship_city','City','trim|required');
          $this->form_validation->set_rules('ship_state','State','trim|required');
          $this->form_validation->set_rules('ship_zipcode','Zipcode','trim|required');
          $this->form_validation->set_rules('type','Type','trim|required');
          $this->form_validation->set_rules('shipping_type','Shipping Type','trim|required');
          $this->form_validation->set_rules('credit_type','Credit Type','trim|required');
          $this->form_validation->set_rules('order_status','Order Status','trim|required');
          $this->form_validation->set_error_delimiters('', '');
          
          $total = $this->cart->total();
          
          if($this->form_validation->run()){
              $ins_data = array();
              $ins_data['customer_id']            = $this->input->post('customer_id');
              $ins_data['salesman_id']            = get_current_user_id(); 
              $ins_data['shipping_type']          = $this->input->post('shipping_type');
              $ins_data['credit_type']            = $this->input->post('credit_type');  
              $ins_data['so_instructions']        = $this->input->post('so_instructions');
              $ins_data['bol_instructions']       = $this->input->post('bol_instructions');
              $ins_data['shipping_address_id']    = $this->input->post('shipping_address_id');
              $ins_data['billing_address_id']     = $this->input->post('billing_address_id');
              $ins_data['type']                   = $this->input->post('type');
              $ins_data['order_status']           = $this->input->post('order_status');
              $ins_data['total_items']            = $this->cart->total_items();
              $ins_data['total_amount']           = $total;
              
              if($edit_id){
                $ins_data['updated_date'] = date('Y-m-d H:i:s'); 
                $ins_data['updated_id']   = get_current_user_id();    
                $this->salesorder_model->update(array("id" => $edit_id),$ins_data);
                $msg  = 'Order updated successfully';
              }
              else
              {   
                $ins_data['created_date'] = date('Y-m-d H:i:s'); 
                $ins_data['updated_date'] = date('Y-m-d H:i:s');
                $ins_data['created_id']   = get_current_user_id();  
                $new_id  = $this->salesorder_model->insert($ins_data,"sales_order");             
                $msg     = 'Order created successfully';
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
          }
        }
        catch (Exception $e)
        {
            $this->data['status']   = 'error';
            $this->data['message']  = $e->getMessage();
        }

        if($edit_id)
           $edit_data = $this->salesorder_model->get_where(array("id" => $edit_id),"*","sales_order")->row_array();
            
        $this->data['editdata']      = $edit_data;
        $this->data['shipping_type'] = $this->db->query("select * from shipping_type where 1=1")->result_array();
        $this->data['credit_type']   = $this->db->query("select * from credit_type where 1=1")->result_array();
        $this->data['cartitems']     = $this->cart->contents();           
        $this->data['customer']      = $this->purchase_model->get_vendors();
        $this->data['total']         = $total;
        
        if($this->input->is_ajax_request()){
          $output  = $this->load->view('frontend/sales/checkout',$this->data,true);
          return    $this->_ajax_output(array('status' => $status ,'output' => $output, 'edit_id' => $edit_id), TRUE);
        }
        else
        {
          $this->layout->view('frontend/sales/checkout');
        } 
    }
    /* End by Punitha */

    /* By Ram */

    public function customer_relation()
    {
      $this->layout->add_javascripts(array('listing'));  
      $this->load->library('listing');         
      $this->simple_search_fields = array(                                                
                                            'a.business_name'         => 'Customer Name',
                                            'b.email'          => 'Email',
                                            'c.name'     => 'Location',                                            
                                         );
         
        $this->_narrow_search_conditions = array("start_date");
        
        $str = '<a href="javascript:void(0);" data-original-title="Remove" data-toggle="tooltip" data-placement="top" class="table-action" onclick="delete_record(\'salesorder/delete_customer/{id}\',this);"><i class="fa fa-trash-o trash"></i></a>
                ';
 
        $this->listing->initialize(array('listing_action' => $str));

        $listing = $this->listing->get_listings('customer_model', 'listing');

        if($this->input->is_ajax_request())
            $this->_ajax_output(array('listing' => $listing), TRUE);
        
        $this->data['bulk_actions'] = array('' => 'select', 'delete' => 'Delete');
        $this->data['simple_search_fields'] = $this->simple_search_fields;
        $this->data['search_conditions'] = $this->session->userdata($this->namespace.'_search_conditions');
        $this->data['per_page'] = $this->listing->_get_per_page();
        $this->data['per_page_options'] = array_combine($this->listing->_get_per_page_options(), $this->listing->_get_per_page_options());
        
        $this->data['search_bar'] = $this->load->view('listing/search_bar', $this->data, TRUE);        
        $this->data['listing']    = $listing;
        $this->data['grid']       = $this->load->view('listing/view', $this->data, TRUE);
      $this->layout->view('frontend/sales/customer_relation');
    }

    public function add_edit_customer($tab='',$edit_id='')
    {
      if($tab=="tab1primary")
      {
        $this->form_validation->set_rules('name','Customer Name','trim|required');
        $this->form_validation->set_rules('bill_name','Bill To Name','trim|required');
        $this->form_validation->set_rules('address_1','Address 1','trim|required');
        $this->form_validation->set_rules('city','City','trim|required');
        $this->form_validation->set_rules('state','State','trim|required');
        $this->form_validation->set_rules('country','Country','trim|required');
        $this->form_validation->set_rules('credit_type','Credit Type','trim|required');
        $this->form_validation->set_rules('zipcode','Zipcode','trim|required');       
      }
      else if($tab=="tab2primary")
      {
        $this->form_validation->set_rules('contact_name','Contact Name','trim|required');
        $this->form_validation->set_rules('contact_value','Contact Value','trim|required');
        $this->form_validation->set_rules('contact_type','Contact Type','trim|required');
        $this->form_validation->set_rules('contact_email','Contact Email','trim|required|valid_email');
      }
      else if($tab=="tab3primary")
      {
        $this->form_validation->set_rules('loc_name','Location Name','trim|required');
        $this->form_validation->set_rules('loc_address_1','Address 1','trim|required');
        $this->form_validation->set_rules('loc_city','City','trim|required');
        $this->form_validation->set_rules('loc_state','State','trim|required');
        $this->form_validation->set_rules('loc_country','Country','trim|required');
        $this->form_validation->set_rules('loc_zipcode','Zipcode','trim|required');
        $this->form_validation->set_rules('start_time','Start Time','trim|required');
        $this->form_validation->set_rules('end_time','End Time','trim|required');
        $this->form_validation->set_rules('timezone','Timezone','trim|required');
        $this->form_validation->set_rules('weeks','Days of Week','trim|required');
        //$this->form_validation->set_rules('loc_type','Location Type','trim|required');
      }
      try
      {
        if($this->form_validation->run())
        {
          $status = 'success';
          $form = $this->input->post();
          /*Customer Address Table*/
          if($tab=="tab3primary")
          {
            $ins1['name'] = $form['bill_name'];
            $ins1['address1'] = $form['address_1'];
            $ins1['address2'] = $form['address_2'];
            $ins1['city'] = $form['city'];
            $ins1['state'] = $form['state'];
            $ins1['country'] = $form['country'];
            $ins1['zipcode'] = $form['zipcode'];
            $ins1['phone'] = $form['zipcode'];
            $ins1['created_id'] = get_current_user_id();
            $ins1['updated_id'] = get_current_user_id();
            $ins1['created_date'] = date("Y-m-d H:i:s");
            $a_id = $this->admin_model->insert($ins1,"address");
            /*Customer Table*/
            $ins['business_name'] = $form['name'];
            $ins['web_url'] = $form['website'];
            $ins['ups'] = $form['ups'];
            $ins['credit_type'] = $form['credit_type'];
            $ins['address_id'] = $a_id;
            $c_id = $this->admin_model->insert($ins,"customer");
            /*Customer Contact Table*/
            $ins2['customer_id'] = $c_id;
            $ins2['name'] = $form['contact_name'];
            $ins2['contact_value'] = $form['contact_value'];
            $ins2['contact_type'] = $form['contact_type'];
            $ins2['email'] = $form['contact_email'];
            $add = $this->admin_model->insert($ins2,"customer_contact");
            /*Customer Location Table*/
            $ins3['customer_id'] = $c_id;
            $ins3['name'] = $form['loc_name'];
            $ins3['address_1'] = $form['loc_address_1'];
            $ins3['address_2'] = $form['loc_address_2'];
            $ins3['city'] = $form['loc_city'];
            $ins3['state'] = $form['loc_state'];
            $ins3['country'] = $form['loc_country'];
            $ins3['zipcode'] = $form['loc_zipcode'];
            $ins3['start_time'] = date("H:i:s",strtotime($form['start_time']));
            $ins3['end_time'] = date("H:i:s",strtotime($form['end_time']));
            $ins3['timezone_id'] = $form['timezone'];
            $ins3['day_of_week'] = $form['weeks'];
            $ins3['definition'] = implode(",",$form['loc_type']);
            $add1 = $this->admin_model->insert($ins3,"customer_location");
          }
        }
        else
        {
          $status = 'error';
        }
      }
      catch (Exception $e)
      {
          $this->data['status']   = 'error';
          $this->data['message']  = $e->getMessage();
      }

      if($this->input->is_ajax_request())
      {
        $output  = $this->load->view('frontend/sales/add_customer_relation',$this->data,true);
        return    $this->_ajax_output(array('status' => $status ,'output' => $output, 'edit_id' => $edit_id,"msg"=>$ins1), TRUE);
      }
      else
      {
        $this->layout->view('frontend/sales/add_customer_relation');
      }      
    }

    public function add_new_address()
    {
        $output  =  $this->load->view('frontend/sales/ajax_new_address',$this->data,true);
        return $this->_ajax_output(array('status' => 'success' ,'output' => $output), TRUE);
    }

    /*End by Ram*/
}
?>
