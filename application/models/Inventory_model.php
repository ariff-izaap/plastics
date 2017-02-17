<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Inventory_model extends App_model {
    
    function __construct()
    {
        parent::__construct();

        $this->_table = 'product';
    }
    
     function listing()
     {  
        $this->_fields = "p.id,p.name,p.sku,p.created_date,p.quantity,pk.name as package_name,c.name as color_name,f.name as form_name";
        $this->db->from('product p');
        $this->db->join("product_color c","c.id=p.color_id");
        $this->db->join("product_form f","f.id=p.form_id");
        $this->db->join("product_packaging pk","pk.id=p.package_id");
        
        $this->db->group_by('p.id');
          
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'p.name':
                    $this->db->like($key, $value);
                break;
                case 'p.sku':
                    $this->db->like($key, $value);
                break;
                case 'p.created_date':
                    $this->db->like($key, $value);
                break;
                case 'p.quantity':
                    $this->db->like($key, $value);
                break;
                case 'pk.name':
                    $this->db->like($key, $value);
                break;
                case 'c.name':
                    $this->db->like($key, $value);
                break;
                case 'f.name':
                    $this->db->like($key, $value);
                break;
            }
        }
        
        
        return parent::listing();
    }
	
    
}
?>
