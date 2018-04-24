<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Customer_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'customer';
  }
  
  function listing()
  {
	  $this->_fields = "a.*,c.city as loc_name";
    $this->db->from('customer a');
    // $this->db->join("customer_contact b","b.customer_id=a.id");
    $this->db->join("customer_location c","c.customer_id=a.id");
    $this->db->group_by('a.id');

    foreach ($this->criteria as $key => $value)
    {
      if( !is_array($value) && strcmp($value, '') === 0 )
          continue;
      switch ($key)
      {
        case 'a.business_name':
          $this->db->like($key, $value);
        break;
        case 'b.email':
          $this->db->like($key, $value);
        break;
        case 'c.name':
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
  public function select($table='',$where='')
  {
    if($where)
      $this->db->where($where);
    $q =  $this->db->get($table);
    if($q->num_rows() > 1)
      return $q->result_array();
    else
      return $q->row_array();
  }
  public function update($where,$data,$table=NULL)
  {
    $this->db->where($where);
    $this->db->update($table,$data);
  }
  public function delete($where='',$table=NULL)
  {
    $this->db->where($where);
    $this->db->delete($table);
  }
  public function get_access_level($where)
  {
    $this->db->where($where);
    $q =  $this->db->get("role_access");
    return $q->result_array();
  }
}
?>