<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Shipment_model extends App_model
{
 
  function __construct()
  {
    parent::__construct();
    
    $this->_table = "shipment";
  }
  
  function listing()
  {  
        $this->_fields = "s.id as id,s.salesman_id,cl.zipcode,cl.city,cl.state,ct.business_name,p.name,p.sku,i.qty as quantity,p.row,p.form_id,p.units,s.total_amount as wholesale_price,s.credit_type,s.credit_type as payment_by,pk.name as package_name,c.name as color_name,f.name as form_name,s.so_instructions,s.bol_instructions";
        $this->db->from('sales_order s');
        $this->db->join("sales_order_item i","i.so_id=s.id");
         
        foreach ($this->criteria as $key => $value) 
        {
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'shipping_order':
                    $this->db->like("s.shipping_order", $value);
                break;
                case 'business_name':
                    $this->db->like("ct.business_name", $value);
                break;
                case 'city':
                    $this->db->like("cl.city", $value);
                break;
                case 'state':
                    $this->db->like("cl.state", $value);
                break;
                case 'zipcode':
                    $this->db->like("cl.zipcode", $value);
                break;
                case 'salesman_id':
                    $this->db->like("s.salesman_id", $value);
                break;
                case 'payment_by':
                    $this->db->like("s.credit_type", $value);
                break;
                case 'credit_type':
                    $this->db->like("s.credit_type", $value);
                break;
                case 'total_amount':
                    $this->db->like("s.total_amount", $value);
                break;
                case 'so_instructions':
                    $this->db->like("s.so_instructions", $value);
                break;
                case 'bol_instructions':
                    $this->db->like("s.bol_instructions", $value);
                break;
            }
        }
        
        
        return parent::listing();
    }
	
 
}
?>
