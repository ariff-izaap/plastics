<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Log_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'log';
  }
  
  function get_logs($where)
  {
    $this->db->select("l.*,a.first_name as admin_user");
    $this->db->from("log l");
    $this->db->join("admin_users a","a.id=l.created_id");
    $this->db->where($where);
    return $this->db->get()->result_array();
  }
  
}
?>