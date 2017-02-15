<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Role_model extends App_model {
    
    
    function __construct()
    {
      parent::__construct();
    }
    
    function listing()
	  {  
	
  	}
  	public function get_roles()
  	{
  		return $this->db->get("role")->result_array();
  	}
}
?>
