<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Warehouse_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'warehouse';
  }

  function listing()
  {
	  $this->_fields = "a.*,b.name as state_name,c.name as country_name";
	  //$this->db->select($this->_fields);
    $this->db->from('warehouse a');
    $this->db->join("state b","a.state=b.id");
    $this->db->join("country c","a.country=c.id");
    $this->db->group_by('a.id');
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
          continue;
      switch ($key)
      {
        case 'a.name':
          $this->db->like($key, $value);
        break;
        case 'a.email':
          $this->db->like($key, $value);
        break;
        case 'a.city':
          $this->db->like($key, $value);
        break;
        case 'a.phone':
          $this->db->like($key, $value);
        break;
        case 'a.zipcode':
          $this->db->like($key, $value);
        break;
      }
    }
    return parent::listing();

  }
 }
?>