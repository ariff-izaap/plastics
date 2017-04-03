<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('App_model.php');

class Address_model extends App_model {
    
    function __construct()
    {
        parent::__construct();
        $this->_table = 'address';
    }
   function get_address_by_contact_id($contact_id)
	{
		$this->db->select('a.id as address_id,c.name,c.email,a.*');
		$this->db->from('customer_contact c');
		$this->db->join('address a', 'c.customer_id=a.id and c.id='.$contact_id);
		return $this->db->get()->row_array();
	}
   
   function create_or_update_address($data = array())
	{
	
		//Check if the given address already exists for the user
		$where  = ' WHERE 1=1 ';
		$join = '';
		$where .= isset($data['first_name'])?("AND address.first_name='".$this->db->escape_str($data['first_name'])."' "):('');
		$where .= isset($data['last_name'])?("AND address.last_name='".$this->db->escape_str($data['last_name'])."' "):('');
		$where .= isset($data['address1'])?("AND address.address1='".$this->db->escape_str($data['address1'])."' "):('');
		$where .= isset($data['company'])?("AND address.company='".$this->db->escape_str($data['company'])."' "):('');
		$where .= isset($data['address2'])?("AND (address.address2='".$this->db->escape_str($data['address2'])."' OR address.address2 is NULL) "):('');
		$where .= isset($data['city'])?("AND address.city='".$this->db->escape_str($data['city'])."' "):('');
		$where .= isset($data['state'])?("AND address.state='".$this->db->escape_str($data['state'])."' "):('');
		$where .= isset($data['country'])?("AND address.country='".$this->db->escape_str($data['country'])."' "):('');
		$where .= isset($data['zip'])?("AND address.zip='".$this->db->escape_str($data['zip'])."' "):('');
		$where .= isset($data['created_id'])?("AND address.created_id='{$data['created_id']}' "):('');
	
		$result = $this->db->query("select address.id from address $join $where");
	
		$address_id = 0;
		$contact_id = 0;
		if($result->num_rows()){
			$address_id = $result->row()->id;
		}
			
		if($address_id){
		  
			//if address already exists,get conatct_id
			$result = $this->db->get_where('customer_location',array('user_id' => $data['user_id'], 'address_id' => $address_id, 'type' => $data['type']));
			if($result->num_rows())
				$contact_id = $result->row()->id;
			else
			{
				$contact = array(
						'user_id' 		=> $data['user_id'],
						'name'		 	=> $data['name'],
						'address_id' 	=> $address_id,
						'email'			=> $data['email'],
						'country'		=> $data['country'],
						'phone'			=> $data['phone'],
						'created_id'	=> $data['created_id'],
						'updated_id'	=> $data['updated_id'],
						'created_time'	=> $data['created_time'],
						'updated_time'	=> $data['updated_time']
				);
				if(isset($data['type'])){
					$contact['type'] = $data['type'];
				}
				$this->db->insert('customer_location', $contact);
				$contact_id = $this->db->insert_id();
			}
				
		}
		else{
			//if address does not exists, add it.
			$address = array(
					'first_name'	=> $data['first_name'],
					'last_name'		=> $data['last_name'],
					'company'		=> isset($data['company'])? $data['company'] : '',
					'address1' 		=> $data['address1'],
					'address2' 		=> $data['address2'],
					'city'     		=> $data['city'],
					'state'	   		=> $data['state'],
					'country'		=> $data['country'],
					'zip'			=> $data['zip'],
					'created_id'	=> $data['created_id'],
					'updated_id'	=> $data['updated_id'],
					'created_time'	=> $data['created_time'],
					'updated_time'	=> $data['updated_time']
			);
				
			$this->db->insert('address', $address);
			$address_id = $this->db->insert_id();
				
			$contact = array(
					'user_id' 		=> $data['user_id'],
					'name'		 	=> $data['name'],
					'address_id' 	=> $address_id,
					'email'			=> $data['email'],
					'country'		=> $data['country'],
					'phone'			=> $data['phone'],
					'created_id'	=> $data['created_id'],
					'updated_id'	=> $data['updated_id'],
					'created_time'	=> $data['created_time'],
					'updated_time'	=> $data['updated_time']
			);
			if(isset($data['type'])){
				$contact['type'] = $data['type'];
			}
			$this->db->insert('customer_location', $contact);
			$contact_id = $this->db->insert_id();
		}
	
		return array($contact_id, $address_id);
	}	
}
?>
