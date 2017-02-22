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
    
}
?>
