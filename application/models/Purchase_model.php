<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Purchase_model extends App_model
{
	protected $table = "";
	 
	function __construct()
	{
	  parent::__construct();
	  $this->_table = "purchase_order";
	}

  function listing()
  {
	  $this->_fields = "c.*,t.business_name,f.location";
    $this->db->from('purchase_order c');
    $this->db->join("customer t","c.vendor_id=t.id");
    $this->db->join("warehouse f","c.warehouse_id=f.id");
    $this->db->group_by('c.id');
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
          continue;
      switch ($key)
      {
        case 'c.id':
          $this->db->like($key, $value);
        break;
        case 't.business_name':
          $this->db->like($key, $value);
        break;
        case 'c.pickup_date':
          $this->db->like($key, $value);
        break;
        case 'f.location':
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
    $this->db->select("a.*,b.state,b.city,b.address1,b.address2,b.zipcode,b.first_name,b.last_name,b.phone,c.name as contact_name,c.contact_value,c.email");
    $this->db->from("customer a");
    $this->db->join("address b","a.address_id=b.id");
    $this->db->join("customer_contact c","a.id=c.customer_id");
    $this->db->join("vendor_price_list d","a.id=d.vendor_id");
    $this->db->group_by("a.id");
    $q = $this->db->get();
    return $q->result_array();
  }
	public function get_max_id()
	{
		$this->db->select("COALESCE(MAX(id),0) + 1 as po_id");
		$q = $this->db->get("purchase_order");
		return $q->row_array();
	}
	public function insert($data,$table=NULL)
	{
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	}

	public function update($where,$data,$table=NULL)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function select($where,$table=NULL)
	{
		$this->db->where($where);
		$q = $this->db->get($table);
		if($q->num_rows() > 1)
			return $q->result_array();
		else
			return $q->row_array();
	}

	public function delete($where,$table=NULL)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function get_purchased_products($po_id)
	{
		$this->db->where("a.po_id",$po_id);
		$this->db->select("a.*,a.id as rowid,b.name as p_name,b.sku");
		$this->db->from("purchase_order_item a");
		$this->db->join("product b","a.product_id=b.id");
		$q = $this->db->get();
		return $q->result_array();
	}

}