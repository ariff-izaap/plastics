<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Purchase_model extends App_model
{
	protected $table = "";
	 
	function __construct()
	{
	  parent::__construct();
	  $this->_table = "purchase_order";
	}

	public function get_max_id()
	{
		$this->db->select("COALESCE(MAX(id),0) + 1 as po_id");
		$q = $this->db->get($this->_table);
		return $q->row_array();
	}

}