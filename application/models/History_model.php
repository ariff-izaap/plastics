<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class History_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'log';
  }
  
  function listing()
  {
	  $this->_fields = "c.*,a.first_name as created_name";
    $this->db->from('log c');
    //$this->db->join("action t","c.action_id=t.id");
    $this->db->join("admin_users a","c.created_id=a.id");
    $this->db->group_by('c.id');
    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
          continue;
      switch ($key)
      {
        case 'c.action_id':
          $this->db->like($key, $value);
        break;
        case 'c.action':
          $this->db->like($key, $value);
        break;
        case 'c.line':
          $this->db->like($key, $value);
        break;
        case 'c.created_id':
          $this->db->like($key, $value);
        break;
        case 'c.created_date':
          $this->db->like($key, $value);
        break;
      }
    }
    return parent::listing();
  }
	public function insert($data,$table=NULL)
	{
		$q =  $this->db->insert($table,$data);
		return $this->db->insert_id();
	}
}
?>