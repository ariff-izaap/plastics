<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');
class Product_vendor_model extends App_model
{
    protected $_table = 'vendor_price_list';

    public function __construct()
    {
        parent::__construct();
    }
    
    function get_product_vendor_list($where = array())
    {
        $fields = "vendor.name as vendor_name,
                    vendor.order_email,
                    vendor.id as vendor_id,
                    vendor_price_list.*,
                    vendor_price_list.upc as vpl_upc,
                    vendor_price_list.sku as vpl_sku,
                    vendor_price_list.stock_level as qty,
                    vendor_price_list.cost as vpl_cost,
                    vendor_price_list.id as vpl_id,
                    CASE WHEN vendor_price_list.enabled='1' THEN 'Yes' WHEN vendor_price_list.enabled='0' THEN 'No' ELSE '' END as enabled,
                    CASE WHEN vendor_price_list.auto_order='1' THEN 'Yes' WHEN vendor_price_list.auto_order='0' THEN 'No' ELSE '' END as auto_order, 
                    product.id as product_id
                    ";
        $this->db->select($fields,false);
        $this->db->from($this->_table);
        $this->db->join("product", "product.upc = vendor_price_list.upc");
        $this->db->join("vendor", "vendor.id = vendor_price_list.vendor_id");
        $this->db->where($where);
        return $this->db->get();
    }
    
    
    
}

 