<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Product_model extends App_model
{
	 function __construct()
  {
    parent::__construct();
    $this->_table = 'product';
  }
  
  function listing()
  {
	  $this->_fields = "a.*,a.id as pid,b.name as form_name,c.name as color_name,d.name as product_type,e.name as package_name,f.vendor_id,(select max(id)+1 from purchase_order) as po_id";
    $this->db->from('product a');
    $this->db->join("product_form b","a.form_id=b.id");
    $this->db->join("product_color c","a.color_id=c.id");
    $this->db->join("product_type d","a.product=d.id");
    $this->db->join("product_packaging e","a.package_id=e.id");
    $this->db->join("vendor_price_list f","a.id=f.product_id");
    $this->db->group_by('a.id');
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
        continue;
      switch ($key)
      {
        case 'vendor':
          $this->db->where_in("f.vendor_id", $value);
        break;
        case 'product':
          $this->db->where_in("a.name", $value);
        break;
        case 'form':
          $this->db->where_in("b.name", $value);
        break;
        case 'color':
          $this->db->where_in("c.name", $value);
        break;
        case 'type':
          $this->db->where_in("d.name", $value);
        break;
        case 'package':
          $this->db->where_in("e.name", $value);
        break;
        case 'note':
          $this->db->where_in("a.notes", $value);
        break;
      }
    }        
    return parent::listing();
  }
}
?>