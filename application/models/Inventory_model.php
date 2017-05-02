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
        $this->_fields = "p.id,p.name,p.sku,p.created_date,p.quantity,p.row,p.form_id,p.units,p.available_qty,p.received_in_warehouse,p.equivalent,p.wholesale_price,p.retail_price,p.available_qty,p.internal_lot_no,p.vendor_lot_no,pk.name as package_name,c.name as color_name,f.name as form_name";
        $this->db->from('product p');
      //  $this->db->join("vendor_price_list vl","vl.product_id=p.id");
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
                case 'name':
                    $this->db->like("p.name", $value);
                break;
                case 'p.sku':
                    $this->db->like("p.sku", $value);
                break;
                case 'p.created_date':
                    $this->db->like("p.created_date", $value);
                break;
                case 'p.quantity':
                    $this->db->like("p.quantity", $value);
                break;
                case 'package_name':
                    $this->db->like("pk.name", $value);
                break;
                case 'form_name':
                    $this->db->like("f.name", $value);
                break;
                case 'color_name':
                    $this->db->like("c.name", $value);
                break;
            }
        }
        return parent::listing();
    }
	
    public function get_product_details($product_id)
    {
        $this->db->select("p.id,p.name,p.equivalent,p.quantity,p.row,p.item_type,p.wholesale_price,p.retail_price,f.name as form_name,pk.name as package_name,c.name as color_name"); 
        $this->db->from('product p');
        $this->db->join("product_color c","c.id=p.color_id");
        $this->db->join("product_form f","f.id=p.form_id");
        $this->db->join("product_packaging pk","pk.id=p.package_id");
      //  $this->db->join("vendor_price_list v","v.product_id=p.id");
        $this->db->where("p.id",$product_id);
        return $this->db->get()->row_array();
    }
}
?>
