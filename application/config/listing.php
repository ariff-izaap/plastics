<?php
/*
 * view - the path to the listing view that you want to display the data in
 * 
 * base_url - the url on which that pagination occurs. This may have to be modified in the 
 * 			controller if the url is like /product/edit/12
 * 
 * per_page - results per page
 * 
 * order_fields - These are the fields by which you want to allow sorting on. They must match
 * 				the field names in the table exactly. Can prefix with table name if needed
 * 				(EX: products.id)
 * 
 * OPTIONAL
 * 
 * default_order - One of the order fields above
 * 
 * uri_segment - this will have to be increased if you are paginating on a page like 
 * 				/product/edit/12
 * 				otherwise the pagingation will start on page 12 in this case 
 * 
 * 
 */
 

$config['admin_user_setup'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'admin/filter',
	"base_url"	=> 	'/admin/user_setup/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'first_name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'last_name'=>array('name'=>'Last Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'role'=>array('name'=>'Role', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);
/*
$config['purchase_add_edit_purchase'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'purchase/filter',
	"base_url"	=> 	'/purchase/add_edit_purchase/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'business_name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),			
						'contact_name'=>array('name'=>'Contact Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'contact_value'=>array('name'=>'Phone', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'city'=>array('name'=>'City', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						'state'=>array('name'=>'State', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);*/


$config['purchase_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/purchase/filter_purchase',
	"base_url"	=> 	'/purchase/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'id'=>array('name'=>'PO ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'business_name'=>array('name'=>'Vendor', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'pickup_date'=>array('name'=>'Pickup Date', 'data_type' => 'date','sortable' => FALSE, 'default_view'=>1),
						'city'=>array('name'=>'Location', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'order_status'=>array('name'=>'Order Status', 'data_type' => 'colorize', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['warehouse_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/warehouse/filter',
	"base_url"	=> 	'/warehouse/index/',
	"per_page"	=>	"20",
	"fields"	=> array(
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'email'=>array('name'=>'Email', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'city'=>array('name'=>'City', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'state_name'=>array('name'=>'State', 'data_type' => 'date','sortable' => FALSE, 'default_view'=>1),
						'phone'=>array('name'=>'Phone', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'zipcode'=>array('name'=>'Zipcode', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);



$config['salesorder_customer_relation'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/warehouse/filter',
	"base_url"	=> 	'/salesorder/customer_relation/',
	"per_page"	=>	"20",
	"fields"	=> array(
						'business_name'=>array('name'=>'Customer Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'email'=>array('name'=>'Email', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'loc_name'=>array('name'=>'Location', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						/*'state_name'=>array('name'=>'State', 'data_type' => 'date','sortable' => FALSE, 'default_view'=>1),
						'phone'=>array('name'=>'Phone', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'zipcode'=>array('name'=>'Zipcode', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)*/),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);




$config['purchase_add_edit_purchase'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/purchase/filter',
	"base_url"	=> 	'/purchase/add_edit_purchase/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'pid'=>array('name'=>'Product ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'name'=>array('name'=>'Product', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'form_name'=>array('name'=>'Form', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'color_name'=>array('name'=>'Color', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'product_type'=>array('name'=>'Type', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'equivalent'=>array('name'=>'Equivalent', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						'quantity'=>array('name'=>'Quantity', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						'wholesale_price'=>array('name'=>'Wholesale Price', 'data_type' => 'money', 'sortable' => FALSE, 'default_view'=>1),
						'package_name'=>array('name'=>'Package Name','data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);



$config['admin_roles'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'admin/filter',
	"base_url"	=> 	'/admin/roles/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						/*'last_name'=>array('name'=>'Last Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'role'=>array('name'=>'Role', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'email'=>array('name'=>'Email', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1)*/),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['inventory_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'inventory/filter',
	"base_url"	=> 	'/inventory/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),					
						'quantity'=>array('name'=>'Quantity', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),					
						'sku'=> array('name'=>'SKU', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'package_name' => array('name'=>'Package Name', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'color_name' => array('name'=>'Color', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'form_name' => array('name'=>'Form', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
						'created_date'=> array('name'=>'Date', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 

$config['inventorycolor_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'inventorycolor/filter',
	"base_url"	=> 	'/inventorycolor/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'status'=>array('name'=>'Status', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)                            
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 

$config['organization_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'lession/filter',
	"base_url"	=> 	'/organization/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'short_name'=>array('name'=>'Short Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'type'=>array('name'=>'Type', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'web_url'=>array('name'=>'Web address', 'data_type' => 'link', 'sortable' => FALSE, 'default_view'=>1)                             
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);


$config['employee_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'employee/filter',
	"base_url"	=> 	'/employee/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'emp_name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'emp_code'=>array('name'=>'Emp Code', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'short_name'=>array('name'=>'Organization', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'current_status'=>array('name'=>'Status', 'data_type' => 'status', 'sortable' => FALSE, 'default_view'=>1),
						'designation'=>array('name'=>'Designation', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),                             
						'phone1'=>array('name'=>'Phone', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'nationality'=>array('name'=>'Nationality', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)                               
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['history_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	//"advance_search_view" => 'frontend/timesheet/filter',
	"base_url"	=> 	'/history/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'action_id'=>array('name'=>'ID', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'line'=>array('name'=>'Action', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),
						'action'=>array('name'=>'Comments', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),	
						'created_name'=>array('name'=>'Action By', 'data_type' => 'string', 'sortable' => FALSE, 'default_view'=>1),
						'created_date'=>array('name'=>'Date', 'data_type' => 'datetime', 'sortable' => FALSE, 'default_view'=>1)
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

$config['inventorytype_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'inventorytype/filter',
	"base_url"	=> 	'/inventorytype/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'status'=>array('name'=>'Status', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)                            
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 

$config['inventorypackage_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'inventorypackage/filter',
	"base_url"	=> 	'/inventorypackage/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'status'=>array('name'=>'Status', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)                            
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 

$config['inventoryform_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'inventoryform/filter',
	"base_url"	=> 	'/inventoryform/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'status'=>array('name'=>'Status', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)                            
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 



$config['accounting_shipping_orders'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'accounting/filter',
	"base_url"	=> 	'/accounting/shipping_orders/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Customer Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),	
						'amount'=>array('name'=>'Amount', 'data_type' => 'money', 'sortable' => FALSE, 'default_view'=>1),
						'ship_date'=>array('name'=>'Ship Date', 'data_type' => 'date', 'sortable' => FALSE, 'default_view'=>1),
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 


$config['accounting_invoices'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'accounting/filter',
	"base_url"	=> 	'/accounting/invoices/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Customer Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),	
						'invoice_date'=>array('name'=>'Invoice Date', 'data_type' => 'datetime', 'sortable' => FALSE, 'default_view'=>1),
						'due_date'=>array('name'=>'Due Date', 'data_type' => 'datetime', 'sortable' => FALSE, 'default_view'=>1),
						'amount'=>array('name'=>'Amount', 'data_type' => 'money', 'sortable' => FALSE, 'default_view'=>1)),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 




$config['vendor_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'vendor/filter',
	"base_url"	=> 	'/vendor/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'business_name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)				
					//	'status'=>array('name'=>'Status', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)                            
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 

$config['category_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'category/filter',
	"base_url"	=> 	'/category/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)					
						//'description'=>array('name'=>'Description', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)                            
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 

$config['salesproductselection_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/salesproductselection/filter',
	"base_url"	=> 	'/salesproductselection/index/',
	"per_page"	=>	"20",
	"fields"	=> array(  
                        'id'=>array('name'=>'Product No', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),	
                        'form_name' => array('name'=>'Form', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'color_name' => array('name'=>'Color', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'item_type' => array('name'=>'Type', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),									
						'equivalent'=> array('name'=>'Equivalent', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'quantity'=>array('name'=>'Quantity', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'available_qty'=> array('name'=>'Available', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
                        'wholesale_price'=> array('name'=>'Wholesale Price', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
                        'package_name' => array('name'=>'Package Name', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'row' => array('name'=>'Row', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'units' => array('name'=>'Units', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),                        
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
); 


$config['salesorder_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/sales/filter',
	"base_url"	=> 	'/sales/index/',
	"per_page"	=>	"20",
	"fields"	=> array(  
                        //'id'=>array('name'=>'Product No', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
						'name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),	
                        'form_name' => array('name'=>'Form', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'color_name' => array('name'=>'Color', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'item_type' => array('name'=>'Type', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),									
						'equivalent'=> array('name'=>'Equivalent', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'quantity'=>array('name'=>'Quantity', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'available_qty'=> array('name'=>'Available', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
                        'wholesale_price'=> array('name'=>'Wholesale Price', 'data_type' => 'string', 'sortable' => TRUE, 'default_view'=>1),
                        'package_name' => array('name'=>'Package Name', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'row' => array('name'=>'Row', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),
                        'units' => array('name'=>'Units', 'data_type' => 'String', 'sortable' => TRUE, 'default_view'=>1),                       
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);