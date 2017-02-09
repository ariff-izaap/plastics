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

$config['timesheet_index'] = array(
	"view"		=> 	'listing/listing',
	"init_scripts" => 'listing/init_scripts',
	"advance_search_view" => 'frontend/timesheet/filter',
	"base_url"	=> 	'/timesheet/index/',
	"per_page"	=>	"20",
	"fields"	=> array(   
						'emp_name'=>array('name'=>'Name', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'emp_code'=>array('name'=>'Emp Code', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),					
						'date'=>array('name'=>'Date', 'data_type' => 'date', 'sortable' => FALSE, 'default_view'=>1),
						'hour'=>array('name'=>'Hours', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1),                             
						'project'=>array('name'=>'Project', 'data_type' => 'String', 'sortable' => FALSE, 'default_view'=>1)
						),
	"default_order"	=> "id",
	"default_direction" => "DESC"
);

