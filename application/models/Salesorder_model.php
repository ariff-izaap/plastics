<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Salesorder_model extends App_model
{
 
  function __construct()
  {
    parent::__construct();
    
    $this->_table = "sales_order";
  }
  
  function listing()
  {  
       $this->_fields = "s.id as id,s.salesman_id,cl.zipcode,cl.city,cl.state,ct.business_name,p.name,p.sku,i.qty as quantity,p.row,p.form_id,p.units,s.total_amount as wholesale_price,s.credit_type,s.credit_type as payment_by,pk.name as package_name,c.name as color_name,f.name as form_name,s.so_instructions,s.bol_instructions";
        $this->db->from('sales_order s');
        $this->db->join("sales_order_item i","i.so_id=s.id");
        $this->db->join("customer ct","ct.id=s.customer_id");
        $this->db->join("customer_location cl","cl.customer_id=ct.id");
        $this->db->join("product p","p.id=i.product_id");
        $this->db->join("product_color c","c.id=p.color_id");
        $this->db->join("product_form f","f.id=p.form_id");
        $this->db->join("product_packaging pk","pk.id=p.package_id");
        $this->db->group_by('i.so_id');
          
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'shipping_order':
                    $this->db->like("s.shipping_order", $value);
                break;
                case 'business_name':
                    $this->db->like("ct.business_name", $value);
                break;
                case 'city':
                    $this->db->like("cl.city", $value);
                break;
                case 'state':
                    $this->db->like("cl.state", $value);
                break;
                case 'zipcode':
                    $this->db->like("cl.zipcode", $value);
                break;
                case 'salesman_id':
                    $this->db->like("s.salesman_id", $value);
                break;
                case 'payment_by':
                    $this->db->like("s.credit_type", $value);
                break;
                case 'credit_type':
                    $this->db->like("s.credit_type", $value);
                break;
                case 'total_amount':
                    $this->db->like("s.total_amount", $value);
                break;
                case 'so_instructions':
                    $this->db->like("s.so_instructions", $value);
                break;
                case 'bol_instructions':
                    $this->db->like("s.bol_instructions", $value);
                break;
            }
        }
        
        
        return parent::listing();
    }
	
  public function get_vendors($where='')
  {
    if($where)
      $this->db->where($where);
      
    $this->db->select("a.*,b.id as billing_id,l.id as shipping_id,l.name as loc_name,l.address_1 as ship_address1,l.id as shipping_id,l.address_2 as ship_address2,l.city as ship_city,l.state as ship_state,l.zipcode as ship_zipcode,b.state,b.city,b.address1,b.address2,b.zipcode,b.first_name,b.last_name,b.phone,c.name as contact_name,c.contact_value,c.email,b.name as b_name");
    $this->db->from("customer a");
    $this->db->join("address b","a.address_id=b.id");
    $this->db->join("customer_contact c","a.id=c.customer_id");
    $this->db->join("customer_location l","a.id=l.customer_id");
    $this->db->join("vendor_price_list d","a.id=d.vendor_id");
    $this->db->group_by("b.id");
    $q = $this->db->get();
    return $q->row_array();
  }
  
  public function get_carriers()
  {
    $this->db->select("*");
    $this->db->from("carrier");
    return $this->db->get()->result_array();
  }   
  
  public function get_sales_items($so_id)
  {
        $this->db->select("s.id as id,i.id as sot_id,p.name,pk.name as package,c.name as color,f.name as form,i.qty,i.unit_price as price,p.row");
        $this->db->from('sales_order s');
        $this->db->join("sales_order_item i","i.so_id=s.id");
        $this->db->join("product p","p.id=i.product_id");
        $this->db->join("product_color c","c.id=p.color_id");
        $this->db->join("product_form f","f.id=p.form_id");
        $this->db->join("product_packaging pk","pk.id=p.package_id");
        return $this->db->get()->result_array();
  }
}
?>
