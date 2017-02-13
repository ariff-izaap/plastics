<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Inventorycolor_model extends App_model {
    
    function __construct()
    {
        parent::__construct();

        $this->_table = 'product_color';
    }
    
     function listing()
     {  
        $this->_fields = "name";
       // $this->db->from('product');
          
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'name':
                    $this->db->like($key, $value);
                break;
                case 'sku':
                    $this->db->like($key, $value);
                break;
                case 'created_date':
                    $this->db->like($key, $value);
                break;
                case 'quantity':
                    $this->db->like($key, $value);
                break;
                
            }
        }
        
        
        return parent::listing();
    }
	
    
}
?>
