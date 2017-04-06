<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once('App_model.php');
class Note_model extends App_model
{
  function __construct()
  {
    parent::__construct();
    $this->_table = 'note';
  }
  
   function get_notes($where)
  {
    $this->db->select("*");
    $this->db->from($this->_table);
    $this->db->where($where);
    $this->db->order_by("id","desc");
    return $this->db->get()->result_array();
  }
}
?>