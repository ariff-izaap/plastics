<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class User_model extends App_model
{
  protected $table = "";
  
  function __construct()
  {
    parent::__construct();
  }
  
   function listing()
  {  
	
	}
	public function get_where($where='',$fields='*',$table='',$order_by='')
	{
		$this->db->where($where);
		$this->db->from('admin_users');
		$q = $this->db->get()->row_array();
		return $q;
	}
	public function select($where='',$table='')
	{
		$this->db->where($where);
		$this->db->from($table);
		$q = $this->db->get()->result_array();
		return $q;
	}      
}
?>
