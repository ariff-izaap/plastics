<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Salesorder_model extends App_model
{
 
  function __construct()
  {
    parent::__construct();
    
    $this->_table = "sales_order";
  }
  
  function listing()
  {  
        $this->_fields = "s.id as id,s.salesman_id,cl.zipcode,cl.city,cl.state,ct.business_name,s.total_amount,s.credit_type,cy.name as creditname,s.credit_type as payment_by,s.so_instructions,s.bol_instructions";
        $this->db->from('sales_order s');
        $this->db->join("customer ct","ct.id=s.customer_id");
        $this->db->join("customer_location cl","cl.customer_id=ct.id");
        $this->db->join("credit_type cy","cy.id=s.credit_type");
        $this->db->group_by('s.id');
          
        foreach ($this->criteria as $key => $value) 
        {
            if($value == 'Select')
               continue;
               
            if( !is_array($value) && strcmp($value, '') === 0 )
                continue;

            switch ($key)
            {
                case 'id':
                    $this->db->like("s.id", $value);
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
	
  public function get_vendors($where='')
  {
    if($where)
      $this->db->where($where);
      
    $this->db->select("a.*,b.id as billing_id,l.id as shipping_id,l.name as loc_name,l.address_1 as ship_address1,l.id as shipping_id,l.address_2 as ship_address2,l.city as ship_city,l.state as ship_state,l.zipcode as ship_zipcode,b.state,b.city,b.address1,b.address2,b.zipcode,b.first_name,b.last_name,b.phone,c.name as contact_name,c.contact_value,c.email,b.name as b_name");
    $this->db->from("customer a");
    $this->db->join("address b","a.address_id=b.id");
    $this->db->join("customer_contact c","a.id=c.customer_id");
    $this->db->join("customer_location l","a.id=l.customer_id");
    //$this->db->join("vendor_price_list d","a.id=d.vendor_id");
    $this->db->group_by("a.id");
    $q = $this->db->get();
    return $q->row_array();
  }
  
  public function get_carriers()
  {
    $this->db->select("*");
    $this->db->from("carrier");
    return $this->db->get()->result_array();
  }   
  
  public function get_sales_items($so_id)
  {
    $this->db->select("s.id as id,i.id as sot_id,p.name,pk.name as package,c.name as color,f.name as form,i.qty,i.unit_price as price,p.row,s.order_status");
    $this->db->from('sales_order s');
    $this->db->join("sales_order_item i","i.so_id=s.id");
    $this->db->join("product p","p.id=i.product_id");
    $this->db->join("product_color c","c.id=p.color_id");
    $this->db->join("product_form f","f.id=p.form_id");
    $this->db->join("product_packaging pk","pk.id=p.package_id");
    $this->db->where(array("i.so_id" => $so_id));
    return $this->db->get()->result_array();
  }
  
  function get_product_details_by_sales_order($so_id, $order_details_only = FALSE)
    {
    	$so_ids = is_array($so_id)?$so_id:array($so_id);
    	
    	$fields = ' so.id as so_id,
    				soi.id as so_item_id,
    				soi.product_id,
    				soi.item_status,
    				soi.unit_price,
    				soi.vendor_id,
    				product.sku,
    				product.retail_price,
    				product.name as product_name,
    				address.country,
    				';
    	if($order_details_only)
    	{
    		$fields .= 'sum(soi.quantity) as quantity';
    	}
    	else 
    	{
    		$fields .= 'soi.qty,
    					vendor.business_name as vendor_name,
    					vendor.credit_type as vendor_type,
    					vendor.id as vendor_id,
    					shipment.ship_company,
    					shipment.order_status as shipment_status,
    					vpl.id as vpl_id,
    					vpl.cost,
    					vpl.sku as vendor_sku
    					';
    	}
    	
    	
    	$this->db->select($fields, FALSE);
    	$this->db->from('sales_order so');
    	$this->db->join('sales_order_item soi', 'soi.so_id=so.id');
    	$this->db->join('product', 'product.id=soi.product_id');
        $this->db->join('customer vendor', 'vendor.id=soi.vendor_id');
    	$this->db->join('customer_location contact', 'contact.id=so.shipping_address_id');
    	$this->db->join('address', 'vendor.address_id=address.id');
    	
        
    	if(!$order_details_only){
    	
    		$this->db->join('vendor_price_list vpl', 'vpl.vendor_id=soi.vendor_id');
    		$this->db->join('shipment', 'shipment.so_id=soi.so_id AND shipment.id=soi.shipment_id', 'left');
    	}
    	
    	$this->db->where_in('so.id', $so_ids);
    	
    	if($order_details_only)
    		$this->db->group_by('soi.product_id');
            
    	$this->db->group_by('soi.product_id');
    	return $this->db->get()->result_array();
    }
    
   function get_related_records($so_id = 0, $vendor = null)
    {
    	$this->db->select('so.id as sales_order_id, group_concat(po.id) as purchase_order_id, group_concat(shipment.id) as shipment_id, returns.id as return_id');
    	$this->db->from('sales_order so');
    	$this->db->join('shipment', 'so.id=shipment.so_id', 'left');
    	$this->db->join('returns', 'returns.so_id=so.id', 'left');
    	$this->db->join('purchase_order po', 'po.so_id=shipment.so_id', 'left');
    	$this->db->where('so.id', $so_id);
    	if(!is_null($vendor))
    	{
    		$this->db->where('shipment.vendor_id', $vendor);
    	}
    	return $this->db->get()->row_array();
    	
    } 
    
    
}
?>
