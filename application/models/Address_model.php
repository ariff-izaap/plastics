<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Address_model extends App_model {
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'address';
    }
   
}
?>