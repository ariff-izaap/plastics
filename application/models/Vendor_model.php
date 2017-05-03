<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Vendor_model extends App_model {
    
    function __construct()
    {
        parent::__construct();

        $this->_table = 'customer';
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
                case 'p.business_name':
                    $this->db->like($key, $value);
                break;
            }
        }
        return parent::listing();
    }
	
    function get_vendors($array_format = TRUE, $where = array())
    {
        $this->db->where($where);
    	$this->db->order_by('business_name');
    	$result = $this->db->get('customer')->result_array();
    	
    	if(!$array_format)
    		return $result;
    	
    	$vendors = array();
    	foreach ($result as $row)
    		$vendors[$row['id']] = $row['business_name'];
    	
    	return $vendors;
    }
    
    public function get_customers($where='')
   {
    
    if($where)
      $this->db->where($where);
    $this->db->select("a.*,b.state,b.city,b.address1,b.address2,b.zipcode,b.first_name,b.last_name,b.phone,c.name as contact_name,c.contact_value,c.email,b.name as b_name");
    $this->db->from("customer a");
    $this->db->join("address b","a.address_id=b.id");
    $this->db->join("customer_contact c","a.id=c.customer_id");
    $this->db->group_by("a.id");
    $q = $this->db->get();
    return $q->result_array();
  }
}
?>
