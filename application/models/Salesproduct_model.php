<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Salesproduct_model extends App_model {
    
    function __construct()
    {
        parent::__construct();

        $this->_table = 'product';
    }
    
     function listing()
     {  
        $this->_fields = "p.id,p.name,p.sku,p.created_date,p.quantity,p.row,p.form_id,p.units,p.available_qty,p.received_in_warehouse,p.equivalent,p.wholesale_price,p.retail_price,p.available_qty,p.internal_lot_no,p.vendor_lot_no,pk.name as package_name,c.name as color_name,f.name as form_name";
        $this->db->from('product p');
        $this->db->join("vendor_price_list vl","vl.product_id=p.id");
        $this->db->join("product_color c","c.id=p.color_id");
        $this->db->join("product_form f","f.id=p.form_id");
        $this->db->join("product_packaging pk","pk.id=p.package_id");
        $this->db->group_by('p.id');
      // print_r($this->criteria);   
        foreach ($this->criteria as $key => $value) 
        {
            if($value == 'Select')
               continue;
            
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'name':
                    $this->db->like("p.name", $value);
                break;
                case 'sku':
                    $this->db->like("p.sku", $value);
                break;
                case 'p.created_date':
                    $this->db->like("p.created_date", $value);
                break;
                case 'quantity':
                    $this->db->like("p.quantity", $value);
                break;
                case 'row':
                    $this->db->like("p.row", $value);
                break;
                case 'units':
                    $this->db->like("p.units", $value);
                break;
                case 'package_name':
                    $this->db->like("p.package_id", $value);
                break;
                case 'form_name':
                    $this->db->like("p.form_id", $value);
                break;
                case 'color_name':
                    $this->db->like("p.color_id", $value);
                break;
                case 'type':
                    $this->db->like("p.item_type", $value);
                break;
                case 'equivalent':
                    $this->db->like("p.equivalent", $value);
                break;
                case 'wholesale_price':
                    $this->db->like("p.wholesale_price", $value);
                break;
                case 'internal_lot_no':
                    $this->db->like("p.internal_lot_no", $value);
                break;
                case 'vendor_lot_no':
                    $this->db->like("p.vendor_lot_no", $value);
                break;
                case 'received_in_warehouse':
                    $this->db->like("p.vendor_lot_no", $value);
                break;
            }
        }
      //  echo $this->db->last_query();
        return parent::listing();
    }
	
   
}
?>
