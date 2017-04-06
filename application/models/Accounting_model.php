<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Accounting_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'log';
  }
  
  function listing()
  {
    // $where = "NOT IN(SELECT so_id from invoices)";
	  $this->_fields = "c.*,t.total_amount as amount,b.business_name as name";
    $this->db->from('shipment c');
    $this->db->join("sales_order t","c.so_id=t.id");
    $this->db->join("customer b","b.id=t.customer_id");
    $this->db->where("c.so_id NOT IN(SELECT so_id from invoice_items)");
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
	public function insert($data,$table=NULL)
	{
		$q =  $this->db->insert($table,$data);
		return $this->db->insert_id();
	}

  public function get_shipping($where='')
  {
    if($where)
      $this->db->where("a.id IN($where)");
    $this->db->select("b.*,b.id as so_id,a.ship_date,c.business_name as cname,d.address_1,d.address_2,d.city,e.name as state_name,f.name as country_name,d.zipcode,g.first_name,g.last_name,c.id as c_id");
    $this->db->from("shipment a");
    $this->db->join("sales_order b","a.so_id=b.id");
    $this->db->join("customer c","b.customer_id=c.id");
    $this->db->join("customer_location d","b.shipping_address_id=d.id");
    $this->db->join("state e","d.state=e.id");
    $this->db->join("country f","d.country=f.id");
    $this->db->join("admin_users g","b.salesman_id=g.id");
    $q = $this->db->get();

    // echo $this->db->last_query();exit;
    return $q->result_array();
  }

  public function select($where='',$table='')
  {
    if($where)
      $this->db->where($where);
    $q = $this->db->get($table);
    if($q->num_rows() > 1)
      return $q->result_array();
    else
      return $q->row_array();

  }
  public function get_ordered_items($where='',$table='')
  {
    if($where)
      $this->db->where($where);
    $q = $this->db->get($table);
    return $q->result_array();

  }
}
?>
