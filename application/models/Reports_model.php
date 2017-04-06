<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Reports_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'reports';
  }
  
  // function listing()
  // {
  //   // $where = "NOT IN(SELECT so_id from invoices)";
	 //  $this->_fields = "c.*,t.total_amount as amount,b.business_name as name";
  //   $this->db->from('shipment c');
  //   $this->db->join("sales_order t","c.so_id=t.id");
  //   $this->db->join("customer b","b.id=t.customer_id");
  //   $this->db->where("c.so_id NOT IN(SELECT so_id from invoice_items)");
  //   $this->db->group_by('c.id');
  //   foreach ($this->criteria as $key => $value)
  //   {
  //     if( !is_array($value) && strcmp($value, '') === 0 )
  //         continue;
  //     switch ($key)
  //     {
  //       case 'b.business_name':
  //         $this->db->like($key, $value);
  //       break;
  //       case 'c.ship_date':
  //         $this->db->like($key, $value);
  //       break;
  //     }
  //   }
  //   return parent::listing();
  // }
	public function insert($data,$table=NULL)
	{
		$q =  $this->db->insert($table,$data);
		return $this->db->insert_id();
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

  public function get_cleading($start_date,$end_date)
  {
    $this->db->select("SUM(c.qty * d.retail_price) as price,SUM(c.qty * d.wholesale_price) as w_price,b.business_name,a.total_items");
    $this->db->from("sales_order a");
    $this->db->join("customer b","a.customer_id=b.id");
    $this->db->join("sales_order_item c","a.id=c.so_id");
    $this->db->join("product d","c.product_id=d.id");    
    $this->db->group_by("a.customer_id");
    $q = $this->db->get();
    // echo $this->db->last_query();echo exit;
    return $q->result_array();
  }

}
?>
