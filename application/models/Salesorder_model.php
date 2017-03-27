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
       $this->_fields = "*";
        
          
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'id':
                    $this->db->like($key, $value);
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
}
?>
