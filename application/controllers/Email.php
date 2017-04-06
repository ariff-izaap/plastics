<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Email extends Admin_Controller 
{
	
    function __construct()
    {
        parent::__construct();  

        if(!is_logged_in())
            redirect('login');
        
        $this->load->library('email');   
         
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'iso-8859-1';
        $config['mailtype'] = 'html';
        $config['wordwrap'] = TRUE;
        
        $this->email->initialize($config);
	} 
	
	 public function send($to,$from,$subject,$message,$attachment)
  	 {
        try
        {
            $this->email->clear();
            
            $this->email->from("$from", 'Your Name');
            $this->email->to("$to");
            $this->email->subject("$subject");
            $this->email->message("$message");
            
            $this->email->send();

        }
        catch(Exception $e)
        {
             $this->error_message = $e->getMessage();
             return FALSE;
        }
  	}
	
   
}
?>
