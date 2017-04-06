<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Invoice_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'invoices';
  }
  
  function listing()
  {
    // $where = "NOT IN(SELECT so_id from invoices)";
    $this->_fields = "c.*,b.business_name as name";
    $this->db->from('invoices c');
    // $this->db->join("sales_order t","c.so_id=t.id");
     $this->db->join("customer b","b.id=c.customer_id");
    // $this->db->where("c.so_id NOT IN(SELECT so_id from invoices)");
    $this->db->group_by('c.id');
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
          continue;
      switch ($key)
      {
        case 'b.business_name':
          $this->db->like($key, $value);
        break;
        case 'c.ship_date':
          $this->db->like($key, $value);
        break;
      }
    }
    return parent::listing();
  }
  public function get_invoices($inv_id='')
  { 
    $this->db->select("a.*,b.business_name,c.name credit_type,d.name as carrier,e.name,e.address_1,e.address_2,e.city,e.zipcode,f.name as state,g.name as country,h.first_name as salesman,j.product_id,j.quantity,j.unit_price,a.id as item_id,k.name as b_name,k.address1 as b_address1,k.address2 as b_address2,k.city as b_city,k.state as b_state,k.country as b_country,k.zipcode as b_zipcode");
    $this->db->from("invoices a");
    $this->db->join("customer b","a.customer_id=b.id");
    $this->db->join("credit_type c","a.credit_type=c.id");
    $this->db->join("carrier d","a.shipment_id=d.id");
    $this->db->join("customer_location e","a.location_id=e.id");
    $this->db->join("state f","e.state=f.id");
    $this->db->join("country g","e.country=g.id");
    $this->db->join("admin_users h","a.salesman_id=h.id");
    $this->db->join("invoice_items j","j.invoice_id=a.id");
    $this->db->join("address k","a.billing_id=k.id");
    $this->db->group_by("a.id");
    $this->db->order_by("j.so_id","asc");
    $this->db->where($inv_id);
    $q = $this->db->get();
    // echo $this->db->last_query();
    // exit;
    return $q->result_array();
  }
}
?>
