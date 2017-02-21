<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Role_model extends App_model {
    
    
    function __construct()
    {
      //$this->_table = 'role';
      parent::__construct();
    }
    
    function listing()
	  {  
	   $this->_fields = "c.*";
      $this->db->from('role c');
      //$this->db->join("role_access t",".role_id=t.id");
      $this->db->group_by('c.id');
      foreach ($this->criteria as $key => $value)
      {
        if( !is_array($value) && strcmp($value, '') === 0 )
            continue;
        switch ($key)
        {
          case 'c.name':
            $this->db->like($key, $value);
          break;
          /*case 't.name':
            $this->db->like($key, $value);
          break;
          case 'c.last_name':
            $this->db->like($key, $value);
          break;
          case 'c.email':
            $this->db->like($key, $value);
          break;*/
        }
      }  
      return parent::listing();
  	}
  	public function get_roles()
  	{
  		return $this->db->get("role")->result_array();
  	}
}
?>
