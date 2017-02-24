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
  
  public function get_vendors($where='')
  {
    if($where)
      $this->db->where($where);
    $this->db->select("a.*,b.state,b.city,b.address1,b.address2,b.zipcode,b.first_name,b.last_name,b.phone,c.name as contact_name,c.contact_value,c.email");
    $this->db->from("customer a");
    $this->db->join("address b","a.address_id=b.id");
    $this->db->join("customer_contact c","a.id=c.customer_id");
    $this->db->join("vendor_price_list d","a.id=d.vendor_id");
    $q = $this->db->get();
    return $q->result_array();
  }
	public function get_max_id()
	{
		$this->db->select("COALESCE(MAX(id),0) + 1 as po_id");
		$q = $this->db->get("purchase_order");
		return $q->row_array();
	}

}