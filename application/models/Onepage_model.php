<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Onepage_model extends App_model
{
	public function get_vendor_by_salesman($id='',$customer='')
	{
		if($id!='')
			$this->db->where("a.salesman_id",$id);
		if($customer!='')
			$this->db->like("b.business_name",$customer);
		$this->db->select("b.*,c.name,c.contact_value,d.city,c.email,b.id as customer_id");
		$this->db->from("sales_order a");
		$this->db->join("customer b","b.id=a.customer_id");
		$this->db->join("customer_contact c","a.customer_id=c.customer_id");
		$this->db->join("address d","d.id=b.address_id");
		$this->db->group_by('b.id');
		$q = $this->db->get();
		return $q->result_array();
	}
	public function get_customer_by_id($id)
	{
		$this->db->where("b.id",$id);
		$this->db->select("b.*,c.name,c.contact_value,d.city,c.email,b.id as customer_id,c.name as customer_contact,d.address1,d.state,d.zipcode,b.credit_type,c.contact_type,d.phone");
		$this->db->from("customer b");
		$this->db->join("customer_contact c","b.id=c.customer_id");
		$this->db->join("address d","d.id=b.address_id");
		$this->db->group_by('b.id');
		$q = $this->db->get();
		return $q->row_array();
	}
	public function get_calls($id)
	{
		$this->db->where("customer_id",$id);
		$this->db->select("*");
		$this->db->from("call_logs");
		$this->db->order_by("created_date");
		$this->db->limit(1);
		$q = $this->db->get();
		return $q->row_array();
	}
	public function get_products($id='',$sku='',$form='',$color='',$type='',$package='',$row='')
	{
		if($id!='')
			$this->db->like('a.name',$id);
		if($sku!='')
			$this->db->like('a.sku',$sku);
		if($form!='')
			$this->db->like('a.form_id',$form);
		if($color!='')
			$this->db->like('a.color_id',$color);
		if($type!='')
			$this->db->like('a.product',$type);
		if($package!='')
			$this->db->like('a.package_id',$package);
		if($row!='')
			$this->db->like('a.row',$row);
		$this->db->select('a.*,b.name as form,c.name as color,d.name as type,e.name as packaging,a.id as product_id');
		$this->db->from('product a');
		$this->db->join('product_form b','b.id=a.form_id','left');
		$this->db->join('product_color c','b.id=a.color_id','left');
		$this->db->join('product_type d','a.product=d.id','left');
		$this->db->join('product_packaging e','a.package_id=e.id','left');
		$this->db->group_by('a.id');
		$q = $this->db->get();
		return $q->result_array();
		// return $this->db->last_query();
	}
	public function get_product_by_id($id)
	{
		$this->db->where('a.id',$id);
		$this->db->select('a.*,b.id as form,c.id as color,d.id as type,e.id as packaging,a.id as product_id,a.name as product_name');
		$this->db->from('product a');
		$this->db->join('product_form b','b.id=a.form_id','left');
		$this->db->join('product_color c','b.id=a.color_id','left');
		$this->db->join('product_type d','a.product=d.id','left');
		$this->db->join('product_packaging e','a.package_id=e.id','left');
		$this->db->group_by('a.id');
		$q = $this->db->get();
		return $q->row_array();
		// return $this->db->last_query();
	}

	public function get_po_history($id)
	{
		$this->db->where('vendor_id',$id);
		$this->db->order_by('created_date','desc');
		$q = $this->db->get('purchase_order');
		return $q->result_array();
	}

	public function get_so_history($id)
	{
		$this->db->where('customer_id',$id);
		$this->db->order_by('created_date','desc');
		$q = $this->db->get('sales_order');
		return $q->result_array();
	}
	public function get_po_details($id)
	{
		$this->db->where('a.po_id',$id);
		$this->db->select('a.*,c.name as form,d.name as color,e.name as package,f.vendor_id,a.id as rowid,b.name as p_name,f.order_status');
		$this->db->from('purchase_order_item a');
		$this->db->join('product b','b.id=a.product_id');
		$this->db->join('product_form c','c.id=b.form_id');
		$this->db->join('product_color d','d.id=b.color_id');
		$this->db->join('product_packaging e','e.id=b.package_id');
		$this->db->join('purchase_order f','f.id=a.po_id');
		$q = $this->db->get();
		return $q->result_array();
	}
	public function get_so_details($id)
	{
		$this->db->where('a.so_id',$id);
		$this->db->select('a.*,c.name as form,d.name as color,e.name as package,f.customer_id,a.id as rowid,b.name as p_name');
		$this->db->from('sales_order_item a');
		$this->db->join('product b','b.id=a.product_id');
		$this->db->join('product_form c','c.id=b.form_id');
		$this->db->join('product_color d','d.id=b.color_id');
		$this->db->join('product_packaging e','e.id=b.package_id');
		$this->db->join('sales_order f','f.id=a.so_id');
		$q = $this->db->get();
		return $q->result_array();
	}

	public function insert($data,$table)
	{
		$q = $this->db->insert($table,$data);
		return $this->db->insert_id();
	}

	public function delete($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function update($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
		return $this->db->last_query();
	}

	public function get_sales_order($id)
	{
		$this->db->where('a.id',$id);
		$this->db->select('a.*,b.name as credit,c.name as carrier,d.type as ship_type,e.first_name as salesman,f.name,f.address1,f.address2,f.city,f.state,f.country,f.zipcode,f.phone,g.name as s_name,g.address1 as s_address1,g.address2 as s_address2,g.city as s_city,h.name as s_state,j.name as s_country,g.zipcode as s_zipcode,g.phone as s_phone');
		$this->db->from('sales_order a');
		$this->db->join('credit_type b','a.credit_type=b.id');
		$this->db->join('carrier c','a.carrier_id=c.id');
		$this->db->join('shipping_type d','a.shipping_type=d.id');
		$this->db->join('admin_users e','a.salesman_id=e.id');
		$this->db->join('address f','a.billing_address_id=f.id');
		$this->db->join('ordered_address g','a.shipping_address_id=g.id');
		$this->db->join('state h','g.state=h.id');
		$this->db->join('country j','g.country=j.id');
		$q = $this->db->get();
		return $q->row_array();
		// echo $this->db->last_query();exit;
	}
	public function get_products_by_vendor($id)
	{
		$this->db->where('a.vendor_id',$id);
		$this->db->select('b.*,c.name as form,d.name as color,e.name as type,f.name as package,b.id as p_id');
		$this->db->from('vendor_price_list a');
		$this->db->join('product b','a.product_id=b.id');
		$this->db->join('product_form c','b.form_id=c.id');
		$this->db->join('product_color d','b.color_id=d.id');
		$this->db->join('product_type e','b.product=e.id');
		$this->db->join('product_packaging f','b.package_id=f.id');
		$q = $this->db->get();
		return $q->result_array();
	}

	public function get_customer_info($id)
	{
		$this->db->where('a.id',$id);
		$this->db->select('a.*,b.id as b_id,b.name as b_name,b.first_name as b_fname,b.last_name as b_lname,b.address1 as b_address1,
			b.address2 as b_address2,b.city as b_city,b.state as b_state,b.country as b_country,b.zipcode as b_zipcode,c.email as b_email,c.contact_value as b_mobile,d.name as s_name,d.address_1 as s_address1,d.address_2 as s_address2,d.city as s_city,d.state as s_state,d.zipcode as s_zipcode,d.phone as s_phone,d.country as s_country,d.id as s_id');
		$this->db->from('customer a');
		$this->db->join('address b','a.address_id=b.id');
		$this->db->join('customer_contact c','a.id=c.customer_id');
		$this->db->join('customer_location d','a.id=d.customer_id');
		$q = $this->db->get();
		return $q->row_array();
		// return $this->db->last_query();
	}

	public function get_comments($id,$table)
	{
		$this->db->where($id);
		$this->db->select('comments');
		$q = $this->db->get($table);
		return $q->row_array();
	}

	public function get_call_log($id)
	{
		$this->db->where($id);
		$this->db->select("a.*,b.first_name as salesman,c.name as call_type");
		$this->db->from("call_logs a");
		$this->db->join("admin_users b","b.id=a.user_id");
		$this->db->join("call_type c","c.id=a.call_type");
		$q = $this->db->get();
		return $q->result_array();
	}
	public function get_logs_by_id($where)
	{
		$this->db->where($where);
		$q = $this->db->get('call_logs');
		return $q->row_array();
	}
	// public function get_inventory_cost($id)
	// {
	// 	$this->db->where('id',$where);
	// 	$this->db->select('wholesale_price,retail_price,shipping_cost');
	// 	$q = $this->db->get('product');
	// 	return $q->row_array();	
	// }

	public function get_so_total($id)
	{
		$this->db->where($id);
		$this->db->select('sum(unit_price * qty) as total_amt,count(id) as items');
		$q = $this->db->get('sales_order_item');
		return $q->row_array();
	}
	public function get_po_total($id)
	{
		$this->db->where($id);
		$this->db->select('sum(unit_price * qty) as total_amt,count(id) as items');
		$q = $this->db->get('purchase_order_item');
		return $q->row_array();
	}

	public function select($where,$table)
	{
		$this->db->where($where);
		$q = $this->db->get($table);
		return $q->row_array();
	}
}
?>