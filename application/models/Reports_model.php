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
    return $q->result_array();
  }
  
  function get_shipping_order($st_date, $ed_date)
  {
    $this->db->select("a.id,c.business_name,sp.ship_date,a.total_amount,sum(st.qty) as quantity,u.first_name");
    $this->db->from("shipment sp");
    $this->db->join("customer c","a.customer_id=c.id");
    $this->db->join("admin_users u","u.id=a.salesman_id");
    $this->db->join("sales_order_item st","st.so_id=a.id");
    $this->db->join("product p","p.id=st.product_id");
    $this->db->where('sp.ship_date >=', $st_date);
    $this->db->where('sp.ship_date <=', $ed_date);
    return $this->db->get('sales_order a')->result_array();
  }
  
  function get_warehouse_inventory($st_date, $ed_date)
  {
    $this->db->select("p.name");
    $this->db->from("product p");
    $this->db->join("warehouse w","w.id=p.warehouse_id");
    $this->db->group_by("p.name");
    $result = $this->db->get()->result_array();
    
    foreach($result as $rkey => $rvalue)
    {
      //Comp
      $qty        = $this->db->query("select sum(p.quantity) as qty from product p where p.name='".$rvalue['name']."'")->row_array();
      $cmp_ct     = $this->db->query("select count(p.form_id) as ct from product p join product_form f on f.id=p.form_id where f.name='Comp'  and p.name='".$rvalue['name']."'")->row_array();   
      $powd_ct    = $this->db->query("select count(p.form_id) as ct from product p join product_form f on f.id=p.form_id where f.name='Powder' and p.name='".$rvalue['name']."'")->row_array(); 
      $parts_ct   = $this->db->query("select count(p.form_id) as ct from product p join product_form f on f.id=p.form_id where f.name='Parts' and p.name='".$rvalue['name']."'")->row_array(); 
      $regrind_ct = $this->db->query("select count(p.form_id) as ct from product p join product_form f on f.id=p.form_id where f.name='Regrind' and p.name='".$rvalue['name']."'")->row_array();
      
      $result[$rkey]['Comp_count']    =  $cmp_ct['ct'];
      $result[$rkey]['Powder_count']  =  $powd_ct['ct'];
      $result[$rkey]['Parts_count']   =  $parts_ct['ct'];
      $result[$rkey]['Regrind_count'] =  $regrind_ct['ct'];
      $result[$rkey]['qty']           =  $qty['qty'];
    }
    return $result;
  }
  
  function sales_gross_profit($st_date, $ed_date)
  {
    $this->db->select("a.id,c.business_name,sp.ship_date,a.total_amount,u.first_name,p.name as pname,p.item_type as type");
    $this->db->from("shipment sp");
    $this->db->join("customer c","a.customer_id=c.id");
    $this->db->join("admin_users u","u.id=a.salesman_id");
    $this->db->join("sales_order_item st","st.so_id=a.id");
    $this->db->join("product p","p.id=st.product_id");
    $this->db->where('sp.ship_date >=', $st_date);
    $this->db->where('sp.ship_date <=', $ed_date);
    $this->db->where("sp.order_status","COMPLETED");
    $result = $this->db->get('sales_order a')->result_array();
  }
  
  
}
?>
