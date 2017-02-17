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
	  $this->_fields = "c.*,t.total_amount as amount,b.first_name as name";
    $this->db->from('shipment c');
    $this->db->join("sales_order t","c.so_id=t.id");
    $this->db->join("admin_users b","b.id=t.customer_id");
    $this->db->group_by('c.id');
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
          continue;
      switch ($key)
      {
        case 'b.first_name':
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
}
?>