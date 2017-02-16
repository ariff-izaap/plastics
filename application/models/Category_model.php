<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Category_model extends App_model {
    
    function __construct()
    {
        parent::__construct();

        $this->_table = 'category';
    }
    
     function listing()
     {  
        $this->_fields = "id,name";
        //$this->db->from();
        
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'name':
                    $this->db->like($key, $value);
                break;
            }
        }
        
        
        return parent::listing();
    }
	
    
}
?>
