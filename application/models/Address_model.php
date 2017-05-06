<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Address_model extends App_model {
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'address';
    }
   
    function get_address_by_contact_id($contact_id)
	{
		$this->db->select('c.*,s.name as state,ct.name as country');
		$this->db->from('customer_location c');
        $this->db->join("country ct","ct.id=c.country");
		$this->db->join('state s', 's.id=c.state');
		return $this->db->get()->row_array();
	}
   
   	function get_customer_billing_address($contact_id)
    {
        $this->db->select('a.id as address_id,c.business_name,cc.email,a.*');
		$this->db->from('customer c');
        $this->db->join("customer_contact cc","cc.customer_id=c.id");
		$this->db->join('address a', 'c.address_id=a.id');
        $this->db->where('a.id',$contact_id);
		return $this->db->get()->row_array();
    }
   	
}
?>
