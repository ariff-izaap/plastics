<?php

function error_found()
{
   header("Location:dashboard");
}

function is_logged_in()
{
  $CI = get_instance();    
  $user_data = get_user_data();    
  if( is_array($user_data) && $user_data )
      return TRUE;
  
  return FALSE;
}

function get_current_user_id()
{
  $CI = & get_instance();
  
  $current_user = get_user_data();
  
  if(!empty($current_user)) {
    return $current_user['id'];
  }
}
function get_user_data()
{
  $CI = get_instance();
  if($CI->session->userdata('user_data'))
  {
    return $CI->session->userdata('user_data');
  }
  else
  {
    return FALSE;
  }
}



function get_vendor_by_id($id='')
{
  $CI = get_instance();
  $CI->load->model('purchase_model');
  $row = $CI->purchase_model->get_vendors(array('a.id' => $id));
  return $row;
}

function get_all_vendors($id='')
{
  $CI = get_instance();
  $CI->load->model('purchase_model');
  $row = $CI->purchase_model->get_vendors();
  return $row;
}

function get_user_role( $user_id='')
{
  $CI= & get_instance();  
  if(!$user_id) 
  {
    $user_data = get_user_data();
    return $user_data['role_id'];
  }   
  $CI->load->model('user_model');
  $row = $CI->user_model->get_where(array('id' => $user_id));
  if( !$row )
    return FALSE;

  return $row['role_id'];
}
function get_all_users_by_role($where='')
{
  $CI= & get_instance();
  $CI->load->model('user_model');
  $row = $CI->user_model->select(array('role_id' => $where),'admin_users');
  return $row;
}

function get_user_access_rights($role_id='')
{
  $CI= & get_instance();  
  if(!$role_id) 
  {
    $user_data = get_user_data();
    return $user_data['role_id'];
  }   
  $CI->load->model('role_model');
  $row = $CI->role_model->get_access_rights(array('role_id' => $role_id));
  if( !$row )
    return FALSE;

  return $row;
}


function get_roles()
{
  $CI = & get_instance();
  $CI->load->model('role_model');
  $records = $CI->role_model->get_roles();

  $roles = array();
  foreach ($records as $id => $val) 
  {
    $roles[$id] = $val;
  }

  return $roles;
}

function get_address_by_contact_id($cid = 0, $output_type = 'both', $address_tag = TRUE)
{
	if(!$cid)
		return FALSE;

	$CI = & get_instance();

	$CI->load->model('address_model');
	$address = $CI->address_model->get_address_by_contact_id($cid);

	if(!count($address))
		return FALSE;
	
	if(strcmp($output_type, 'data') === 0)
		return $address;
	
	$address_format = format_shipping_address($address, $address_tag);
	
	if(strcmp($output_type, 'html') === 0)
		return $address_format;

	return array('data' => $address, 'html' => $address_format);

}

function get_customer_billing_address($cid = 0, $output_type = 'both', $address_tag = TRUE)
{
    if(!$cid)
		return FALSE;

	$CI = & get_instance();

	$CI->load->model('address_model');
	$address = $CI->address_model->get_customer_billing_address($cid);
   
	if(!count($address))
		return FALSE;
	
	if(strcmp($output_type, 'data') === 0)
		return $address;
	
	$address_format = format_address($address, $address_tag);
	
	if(strcmp($output_type, 'html') === 0)
		return $address_format;

	return array('data' => $address, 'html' => $address_format);

}

function format_address($address = array(), $address_tag = TRUE)
{
	if(!count($address))
		return FALSE;

	$address_format = ($address_tag)?"<address>":"<p>";
	$address_format .= "<strong>{$address['first_name']} {$address['last_name']}</strong> <br />";
	if(strcmp(trim($address['company']),'') !== 0)
		$address_format .= "{$address['company']}<br />";
	$address_format .= "{$address['address1']} <br />";
	if(strcmp($address['address2'],'') !== 0)
		$address_format .= "{$address['address2']} <br />";
	$address_format .= "{$address['city']} {$address['state']} {$address['zip']} <br />";
	$address_format .= "{$address['country']} <br />";
	if(strcmp($address['phone'],'') !== 0)
		$address_format .= "<abbr title='Phone'>P:</abbr> {$address['phone']}";
	$address_format .= ($address_tag)?"</address>":"</p>";

	return $address_format;

}

function format_shipping_address($address = array(), $address_tag = TRUE)
{
	if(!count($address))
		return FALSE;

	$address_format = ($address_tag)?"<address>":"<p>";
	$address_format .= "<strong>{$address['name']}</strong> <br />";
	if(strcmp(trim($address['company']),'') !== 0)
		$address_format .= "{$address['company']}<br />";
	$address_format .= "{$address['address_1']} <br />";
	if(strcmp($address['address2'],'') !== 0)
		$address_format .= "{$address['address_2']} <br />";
	$address_format .= "{$address['city']} {$address['state']} {$address['zipcode']} <br />";
	$address_format .= "{$address['country']} <br />";
	if(strcmp($address['phone'],'') !== 0)
		$address_format .= "<abbr title='Phone'>P:</abbr> {$address['phone']}";
	$address_format .= ($address_tag)?"</address>":"</p>";

	return $address_format;

}

function get_countries( $html = false, $elm_name='country', $elm_id='country', $sel = '',$empty = FALSE )
{

      $CI = & get_instance();
      $results = $CI->db->order_by('name', 'ASC')->get('country')->result_array();

      if(!count($results))
            return FALSE;

      if($html)
      {
            $countries = "<select name='$elm_name' id='$elm_id'>";
            if($empty) {
                $countries .= "<option value=''>All</option>";
            }
            foreach ($results as $row)
            {
                  $selected = ( strcmp($sel, $row['code']) === 0 )? 'selected':'';
                  $countries .= "<option value='{$row['code']}' $selected>{$row['name']}</option>";
            }
            $countries .= '</select>';
            return $countries;
      }

      $countries = array();
      if($empty) {
        $countries[''] = "ALL";
      }
      foreach ($results as $row){
            $countries[$row['code']] = $row['name'];
      }
      return $countries;
    
}


function display_flashmsg($flash)
{

  if(!$flash)
    return FALSE;

  $status = $msg = '';

  if(isset($flash['success_msg']))
  {
    $status = 'success';
    $msg = $flash['success_msg'];
  }

  if(isset($flash['error_msg']))
  {
    $status = 'danger';
    $msg = $flash['error_msg'];
  }

    if($status && $msg)
    {
      $str = '<div id="div_service_message" class="alert alert-'.$status.' alert-dismissible">';
      $str.= '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
      
      if($status == 'danger')
          $status = 'error';
      $str.='<strong>'.ucfirst($status).':&nbsp;</strong> '. strip_tags($msg) .' </div>';

      echo $str;
    }

}


function displayData($data = null, $type = 'string', $row = array(), $wrap_tag_open = '', $wrap_tag_close = '')
{
    $CI = & get_instance();     
    if(is_null($data) || is_array($data) || (strcmp($data, '') === 0 && !count($row)) )
      return $data;
    
    switch ($type)
    {
        case 'string':
            break;
        case 'humanize':
          $CI->load->helper("inflector");
          $data = humanize($data);
          break;
        case 'date':
            $data = str2USDT($data);
            break;
        case 'datetime':
            $data = str2USDate($data);
            break;
        case 'money':
            $data = '$'.number_format((float)$data, 2);
            break;
        case 'mailto':
            $data = '<a href="mailto:'.$data.'">'.$data.'</a>';
            break;
        case 'formated_number':
            $data = number_format((float)$data, 2);
            break;
        case 'link':
            $data = '<a href="'.$data.'">'.$data.'</a>';
            break;
        case 'colorize':
          $data = "<h2 style='font-size:14px;' class='label label-danger'>".$data."</h2>"; 
        break;
        case 'status':
           $labels_array = array(
            'NEW' => 'label-warning',
             'PENDING' => 'label-warning',
             'ACCEPTED' => 'label-success',
             'PROCESSING' => 'label-info',
             'SHIPPED' => 'label-success',
             'COMPLETED' => 'label-success',
             'RECIEVED' => 'label-success',
             'CANCELLED' => 'label-danger',
             'IGNORED' => 'label-danger',
             'HOLD' => 'label-warning',
             'PARTIALLY PAID' => 'label-danger',
             );
           if(isset($labels_array[strtoupper($data)]))
           {
            $label = $labels_array[strtoupper($data)];
            $data = "<span class='label $label'>{$data}</span>";
           }

           break;
        case 'product_name_link':
         // $data = '<a href="'.site_url('inventory/add/').$row['id'].'">'.$data.'</a>'; 
         $data = $data;
        break;  
    }    
    return $wrap_tag_open.$data.$wrap_tag_close;
}

function employee_status()
{

  $status = array('Joined'=>'Joined','resigned'=>'resigned','vacation'=>'vacation','unpaid leave'=>'unpaid leave','Absconding'=>'Absconding');
  return $status;
}

function get_employee_types()
{
  $CI = & get_instance();
  $result = $CI->db->get('org_type')->result_array();
  $types = array();
  foreach ($result as $row) 
  {
    $types[$row['id']] = $row['name'];
  }
  return $types;
}

function get_organizations()
{
  $CI = & get_instance();
  $CI->db->select('o.id,o.name,t.name as type');
  $CI->db->join('org_type t','o.org_type=t.id');
  $CI->db->group_by('o.id');
  $result = $CI->db->get('organization o')->result_array();
  $types = array();
  foreach ($result as $row) 
  {
    $types[$row['id']] = $row['name']. ' ('.$row['type'].')';
  }
  return $types;
}

function get_projects()
{
  $CI = & get_instance();
  $result = $CI->db->get('projects')->result_array();
  $proj = array();
  foreach ($result as $row) 
  {
    $proj[$row['id']] = $row['name'];
  }
  return $proj;
}

function get_employees($org = '')
{
  $CI = & get_instance();
  $CI->db->select('id,emp_code,emp_name');
  if($org)
    $CI->db->where('org_id',$org);
  $result = $CI->db->get('employee')->result_array();
  $emp = array();
  foreach ($result as $row) 
  {
    $emp[$row['emp_code']] = $row['emp_name'];
  }
  return $emp;
}

function check_is_working_day($date)
{
  $day = date('l',strtotime($date));
  $CI = & get_instance();
  $CI->db->where('status',1);
  $result = $CI->db->get('working_days')->result_array();
  foreach ($result as $row) 
  {
    if(strtolower($row['name']) == strtolower($day))
      return TRUE;
  }
  return FALSE;
}

function str2USDate($str)
{
  $intTime = strtotime($str);
  if ($intTime === false)
    return NULL;
  return date("m/d/Y H:i:s", $intTime);
}

function str2USDT($str)
{
  $intTime = strtotime($str);
  if ($intTime === false)
    return NULL;
   return date("m/d/Y", strtotime($str));
}

    // no logic for server time to local time.
function str2DBDT($str=null)
{
  $intTime = (!empty($str))?strtotime($str):time();
  if ($intTime === false)
    return NULL;
  return date("Y-m-d H:i:s", $intTime);
}

function str2DBDate($str)
{
  $intTime = strtotime($str);
  if ($intTime === false)
    return NULL;
  return date("Y-m-d",$intTime);
}

function addDayswithdate($date,$days)
{
  $date = strtotime("+".$days." days", strtotime($date));
  return  date("m/d/Y", $date);
}

function day_to_text($date)
{
  $day_no = date("N",strtotime($date));
  $day_array = array(1 => "Monday" , 2 => "Tuesday" , 3 => "Wednesday" , 4 => "Thursday" , 5 => "Friday" , 6 => "Saturday" , 7 => "Sunday"  );
  return $day_array[$day_no];
}

function date_ranges($case = '')
{
  $dt = date('Y-m-d');
  if(empty($case))
  {
    return false;
  }
  switch($case)
  {
    case 'today':
      $highdateval = $dt;
      $lowdateval = $dt;
    break;
    case 'thisweek':
        $highdateval = date('Y-m-d', strtotime('saturday this week'));
            $lowdateval  = date('Y-m-d', strtotime('sunday last week'));
        break;
        case 'thisweektodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('sunday last week'));
        break;
        case 'thismonth':
            $highdateval = date('Y-m-d', strtotime('last day of this month'));
            $lowdateval  = date('Y-m-d', strtotime('first day of this month'));
        break;
        case 'thismonthtodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('first day of this month'));
        break;
        case 'thisyear':
            $highdateval = date('Y-m-d', strtotime('1/1 next year -1 day'));
            $lowdateval  = date('Y-m-d ', strtotime('1/1 this year'));
        break;
        case 'thisyeartodate':
            $highdateval = date('Y-m-d', strtotime($dt));
            $lowdateval  = date('Y-m-d', strtotime('1/1 this year'));
        break;
        case 'thisquarter':
        $quarters = array();
        $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
        $quarters[01] = $quarters[02] = $quarters[03] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
        $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
        $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('10/1 this year - 1 day')));
        $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('10/1 this year')),'end_date' =>  date('Y-m-d', strtotime('1/1 next year -1 day')));
        $cur_month = (int) date("m",strtotime($dt));
       
        
        $date_range = $quarters[$cur_month];
        $highdateval = $date_range['end_date'];
        $lowdateval  = $date_range['start_date'];
        break;
        case 'yesterday':
            $highdateval = date('Y-m-d', strtotime('yesterday'));
            $lowdateval  = date('Y-m-d', strtotime('yesterday'));
        break;
        case 'recent':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-4,date("Y")));
        break;
        case 'lastweek':
            $highdateval = date('Y-m-d', strtotime('saturday last week'));
            $lowdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
        break;
        case 'lastweektodate':
            if(date('l')=="Sunday")
            {
                $highdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
            }
            else
            {
                //$lastweek = date('l').' last week';
                $highdateval = date('Y-m-d');
            }
            
            $lowdateval  = date( 'Y-m-d', strtotime( 'last Sunday', strtotime( 'last Sunday' ) ) );
        break;
        case 'lastmonth':
            $lowdateval  = date('Y-m-d', strtotime('first day of last month'));
            $highdateval = date('Y-m-d', strtotime('last day of last month'));
        break;
        case 'lastmonthtodate';
            $lowdateval  = date('Y-m-d', strtotime('first day of last month'));
            $highdateval = date('Y-m-d', strtotime('last month'));
        break;
        case 'lastquater':
            $quarters = array();
            $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
            $quarters[01] = $quarters[02] = $quarters[03] =  array('start_date' => date('Y-m-d', strtotime('10/1 last year')),'end_date' =>  date('Y-m-d', strtotime('1/1 this year -1 day')));
            $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
            $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
            
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
            break;
        case 'lastquatertodate':
            $quarters = array();
            $todaydate = date('d',strtotime($dt));
            $first_day_year = date('Y-m-d', strtotime('1/1 this year'));
            $quarters[01] = $quarters[02] = $quarters[03] =  array('start_date' => date('Y-m-d', strtotime('10/1 last year')),'end_date' =>  date('Y-m-d', strtotime('10/'.$todaydate.' last year')));
            $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('1/'.$todaydate.' this year')));
            $quarters[07] = $quarters[08] = $quarters[09] = array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('4/'.$todaydate.' this year')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('7/'.$todaydate.' this year')));
            
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
        break;
        case 'lastyear':
            $lowdateval  = date('Y-m-d', strtotime('1/1 last year'));
            $highdateval = date('Y-m-d', strtotime('1/1 this year -1 day'));
        break;
        case 'lastyeartodate':
            $lowdateval  = date('Y-m-d', strtotime('1/1 last year'));
            $highdateval = date('Y-m-d');
        break;
        case 'since30days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-31,date("Y")));
        break;
        case 'since60days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-61,date("Y")));
        break;
        case 'since90days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-91,date("Y")));
        break;
        case 'since350days':
            $highdateval =  date('Y-m-d', strtotime($dt));
            $lowdateval = date('Y-m-d',mktime(0,0,0,date("m"),date("d")-351,date("Y")));
        break;
        case 'nextweek':
            $lowdateval  = date('Y-m-d', strtotime('this sunday'));
            $highdateval = date('Y-m-d', strtotime('next week saturday'));
        break;
        case 'nextfourweeks':
            $lowdateval  = date('Y-m-d', strtotime('this sunday'));
            $highdateval = date('Y-m-d', strtotime('+4 weeks Saturday'));
        break;
        case 'nextmonth':
            $lowdateval  = date('Y-m-d', strtotime('first day of next month'));
            $highdateval = date('Y-m-d', strtotime('last day of next month'));
        break;
        case 'nextquater':
            $quarters = array();
            $first_day_year = date('Y-m-d', strtotime('1/1 next year'));
            //$quarters[01] = $quarters[02] = $quarters[03] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 this year - 1 day')));
             $quarters[01] = $quarters[02] = $quarters[03]= array('start_date' => date('Y-m-d', strtotime('4/1 this year')),'end_date' => date('Y-m-d', strtotime('7/1 this year - 1 day')));
             $quarters[04] = $quarters[05] = $quarters[06] = array('start_date' => date('Y-m-d', strtotime('7/1 this year')),'end_date' => date('Y-m-d', strtotime('10/1 this year - 1 day')));
            $quarters[07] = $quarters[08] = $quarters[09]  = array('start_date' => date('Y-m-d', strtotime('10/1 this year')),'end_date' =>  date('Y-m-d', strtotime('1/1 next year -1 day')));
            $quarters[10] = $quarters[11] = $quarters[12] = array('start_date' => $first_day_year,'end_date' => date('Y-m-d', strtotime('4/1 next year - 1 day')));
            $cur_month = (int) date("m",strtotime($dt));
       
        
            $date_range = $quarters[$cur_month];
            $highdateval = $date_range['end_date'];
            $lowdateval  = $date_range['start_date'];
        break;
        case 'nextyear':
            $lowdateval  = date('Y-m-d', strtotime('1/1 next year'));
            $highdateval = date('Y-m-d', strtotime('12/31 next year'));
        break;
        }

        return array('highdateval' => $highdateval, 'lowdateval' => $lowdateval);
   }
   
   
function update_usermeta($key = '',$value = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
    
    $data = $return_data = array();
    $data['meta_value'] = $value;
    $data['updated_id'] = getAdminUserId();
    $data['updated_time'] = date('Y-m-d', local_to_gmt());
    
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
        $return_data['prev_value'] = $meta_row_data['meta_value'];
        $CI->user_model->update(array('umeta_id' => $meta_row_data['umeta_id']),$data,'usermeta');
        $return_data['id'] = $meta_row_data['umeta_id'];
        $return_data['status'] =  "update";
        
    }
    else
    {
        $data['meta_key'] = $key;
        $data['user_id'] = $user_id;
        $data['created_id'] = getAdminUserId();
        $data['created_time'] = date('Y-m-d', local_to_gmt());
        $umeta_id = $CI->user_model->insert($data,'usermeta');
        $return_data['id'] = $umeta_id;
        $return_data['status'] =  "add";
    }
    
    return $return_data;
    
}


function get_usermeta($key = '',$user_id = '') {
    
    if(!$key || !$user_id)
        return false;
        
    $CI = & get_instance();    
    $CI->load->model('user_model');
    $meta_row = $CI->user_model->get_where(array('meta_key' => $key, 'user_id' => $user_id),"*",'usermeta');
      
    if($meta_row->num_rows() > 0){
        $meta_row_data = $meta_row->row_array();
    
        return $meta_row_data['meta_value'];
    }
    else
    {
        return false;
    }
}



function xml_obj_to_array($xml_obj) {
        
            $json = json_encode($xml_obj,TRUE);
            $arr = json_decode($json,TRUE);
        
        return $arr;                     
}



function site_traffic()
{
    $CI = & get_instance();    
}


function actionLogAdd($type,$id = NULL, $action)
{
    $CI = & get_instance();
    $CI->load->model('log_model');
    $CI->log_model->add($type,$id,$action);
}

function is_valid_product($product_id = 0)
{
    $CI->db->load->model('product_model');

    $result = $CI->db->product_model->get_where(array('id' => $product_id));

    return $result->num_rows()?TRUE:FALSE;
}

function is_valid_user($user_id = 0)
{
    $CI->db->load->model('user_model');
    $result = $CI->db->user_model->get_where(array('id' => $user_id));
    return $result->num_rows()?TRUE:FALSE;
}

function log_history($id='',$cat='',$action='')
{
  $CI = get_instance();
  
  $data['line'] = $cat;
  $CI->load->model('history_model');
  $data['action_id'] = $id;
  $data['action']=$action;
  $data['created_id']   = get_current_user_id();
  $data['created_date'] = date("Y-m-d H:i:s");
  return $CI->history_model->insert($data,"log");
  exit;
}

function get_state()
{
   $CI = get_instance();
   $q = $CI->db->query("select * from state where status=1")->result_array();
   return $q;
}




function get_timezone()
{
   $CI = get_instance();
   $q = $CI->db->query("select * from timezone where status=1")->result_array();
   return $q;
}


function get_weeks_operate()
{
   $CI = get_instance();
   $q = $CI->db->query("select * from week_days_operate where status=1")->result_array();
   return $q;
}

function get_contact_type()
{
   $CI = get_instance();
   $q = $CI->db->query("select * from contact_type where status=1")->result_array();
   return $q;
}



function get_country()
{
   $CI = get_instance();
   $q = $CI->db->query("select * from country where status=1")->result_array();
   return $q;
}

function get_warehouse()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from warehouse")->result_array();
  return $q;
}

function get_shipping_type($where='')
{
  $CI = get_instance();
  if($where)
    $where = "and id='".$where."'";
  $q = $CI->db->query("select * from shipping_type where status=1 $where")->result_array();
  return $q;
}

function get_carrier($where='')
{
  $CI = get_instance();
  if($where)
    $where = "and id='".$where."'";
  $CI = get_instance();
  $q = $CI->db->query("select * from carrier where status=1 $where")->result_array();
  return $q;
}
function get_credit_type()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from credit_type where status=1")->result_array();
  return $q;
}

function get_sale_type()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from sale_type where status=1")->result_array();
  return $q;
}

function get_address()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from address")->result_array();
  return $q;
}

function get_products_by_vendor($id='')
{
   $CI = get_instance();
  $q = $CI->db->query("select a.*,b.vendor_id from product a,vendor_price_list b where b.product_id=a.id and b.vendor_id='".$id."'")->result_array();
  return $q;
}

function get_prodcut_type()
{
  $CI = get_instance();
  if($where)
    $where = "and id='".$where."'";
  $q = $CI->db->query("select * from product_type where status=1 $where")->result_array();
  return $q;
}

function get_products()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from product")->result_array();
  return $q;
}


function get_operator($where='')
{
  if($where)
    $where = $where;
  $CI = get_instance();
  $q = $CI->db->query("select * from operator_selection $where")->result_array();
  return $q;
}

function get_minlevel()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from min_level")->result_array();
  return $q;
}



function get_product_price($id)
{
  $CI = get_instance();
  $q = $CI->db->query("select wholesale_price from product where id=$id")->row_array();
  return $q['wholesale_price'];
}



function get_product_name($id)
{
  $CI = get_instance();
  $q = $CI->db->query("select name,sku from product where id=$id")->row_array();
  return $q;
}

function get_forms()
{
  $CI = get_instance();
  if($where)
    $where = "and id='".$where."'";
  $q = $CI->db->query("select * from product_form where status=1 $where")->result_array();
  return $q;
}

function get_packages()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from product_packaging where status=1")->result_array();
  return $q;
}

function get_colors($where='')
{
  $CI = get_instance();
  if($where)
    $where = "and id='".$where."'";
  $q = $CI->db->query("select * from product_color where status=1 $where")->result_array();
  return $q;
}


function get_product_notes()
{
  $CI = get_instance();
  $q = $CI->db->query("select notes from product")->result_array();
  return $q;
}

function get_salesman()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from admin_users u inner join role r on r.id=u.role_id where r.name='Sales'")->result_array();
  return $q;
}

function get_customer_location()
{
  $CI = get_instance();
  $q = $CI->db->query("select * from customer_location l inner join customer c on c.id=l.customer_id where 1=1")->result_array();
  return $q;
}



function copyFile($file,$rand,$po_id)
{
   echo $file_to_go = str_replace("assets/uploads/purchase/tmp/".$rand."/","assets/uploads/purchase/".$po_id."/",$file);
   copy($file, $file_to_go);
}


function create_auto_po($product,$form)
{
  $CI = get_instance();
  $CI->load->model('purchase_model');
  if(is_array($product))
  {
    
    foreach ($product as $vendor_id => $ploop)
    {

       /*Start Ordered Address Info*/
      $ship = $CI->purchase_model->select(array("id"=>$form['location_id']),"customer_location");
      $address['name'] = $ship['name'];
      $address['address1'] = $ship['address_1'];
      $address['address2'] = $ship['address_2'];
      $address['city'] = $ship['city'];
      $address['state'] = $ship['state'];
      $address['country'] = $ship['country'];
      $address['zipcode'] = $ship['zipcode'];
      $address_id = $CI->purchase_model->insert($address,"ordered_address");
      /*End Ordered Address Info*/

      $tot='';
      $ins['vendor_id']           = $vendor_id;
      $ins['order_status']        = "NEW";
      $ins['pickup_date']         = '';// $form['pickup_date'];
      $ins['estimated_delivery']  = ''; //$form['delivery_date'];
      $ins['release_to_sold']     = '';//$form['release_to_sold'];
      $ins['is_paid']             = 'NOT PAID';//$form['paid'];
      $up['status']               = 'COMPLETED';
      $ins['created_id']          = get_current_user_id();
      $ins['created_date']        = date("Y-m-d H:i:s");
      $ins['updated_id']          = get_current_user_id();
      $ins['updated_date']        = date("Y-m-d H:i:s");
      $ins['so_id']               = $form['so_id'];
      $ins['ordered_address_id']  = $address_id;
      $ins['ship_type_id']        = $form['ship_type_id'];
      $ins['carrier_id']          = $form['carrier_id'];
      $ins['credit_type_id']      = $form['credit_type_id'];

      $po_id = $CI->purchase_model->insert($ins,"purchase_order");
      foreach ($ploop as $key => $pvalue)
      {
        $ins1['po_id']               = $po_id;
        $ins1['unit_price']          = $pvalue['unit_price'];
        $ins1['qty']                 = $pvalue['quantity'];
        $ins1['product_id']          = $key;
        $ins1['item_status']         = "NEW";
        $ins1['created_id']          = get_current_user_id();
        $ins1['created_date']        = date("Y-m-d H:i:s");
        $ins1['updated_id']          = get_current_user_id();
        $ins1['updated_date']        = date("Y-m-d H:i:s");
        $add = $CI->purchase_model->insert($ins1,"purchase_order_item");
        $tot[] = $pvalue['unit_price'] * $pvalue['quantity'];
      }
      $up['total_amount'] = array_sum($tot);
      $update = $CI->purchase_model->update(array("id"=>$po_id),$up,"purchase_order");
    }
    $status = "success";
     //$output = array("status"=>"success","message"=>"PO Created successfully.");
  }
  else
  {
    $status = "error";
    //$output = array("status"=>"error","message"=>"Wrong Input Parameter");
  }
   return $po_id;
}

function create_auto_invoice($form)
{
  $CI = get_instance();
  $CI->load->model('accounting_model');
  $ins['invoice_no']= rand();
  $so_id = $form['so_id'];
  $ins['salesman_id'] = $form['salesman_id'];
  $ins['location_id'] = $form['shipping_id'];
  $ins['shipment_id'] = $form['shipment_id'];
  $ins['billing_id'] = $form['billing_id'];
  $ins['ship_date'] = $form['ship_date'];
  $ins['customer_id'] = $form['customer_id'];
  $ins['invoice_date'] = date("Y-m-d H:i:s");
  $ins['due_date'] = date("Y-m-d H:i:s");
  $ins['credit_type'] = $form['credit_type'];
  $ins['amount'] = str_replace(array("$",","),"",$form['amount']);
  $ins['prepaid_cod'] = str_replace(array("$",","),"",$form['cod_fee']);
  $ins['fright_amt'] = str_replace(array("$",","),"",$form['freight']);
  $ins['additional_amt'] = str_replace(array("$",","),"",$form['add_amt']);
  $ins['total_amt'] = str_replace(array("$",","),"",$form['total_amount']);
  $ins['created_id'] = get_current_user_id();
  $ins['updated_id'] = get_current_user_id();
  $ins['created_date'] = date("Y-m-d H:i:s");
  $ins['updated_date'] = date("Y-m-d H:i:s");
  $inv_id = $CI->accounting_model->insert($ins,"invoices");
  $so = $CI->accounting_model->get_ordered_items(array("so_id"=>$so_id[$i]),"sales_order_item");
  foreach ($so as $key => $value)
  {
    $ins1['invoice_id'] = $inv_id;
    $ins1['so_id'] = $so_id;
    $ins1['product_id'] = $value['product_id'];
    $ins1['quantity'] = $value['qty'];
    $ins1['unit_price'] = $value['unit_price'];
    $ins1['total_amt'] = $value['unit_price'] * $value['qty'];
    $CI->accounting_model->insert($ins1,"invoice_items");
  }
  return $inv_id;
}
function get_logs($cat='',$id='')
{
   $CI = get_instance();
   $q = $CI->db->query("select a.*,b.first_name as created_name from log a,admin_users b where a.line like '%".$cat."%' and a.action_id='".$id."' and a.created_id=b.id order by a.created_date desc")->result_array();
  return $q;
}

?>