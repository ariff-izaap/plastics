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
	
	 public function send($to,$from,$subject,$message,$attachment = array())
  	 {
        try
        {
            $this->email->clear();
            
            $this->email->from("$from", 'Independent Plastics');
            $this->email->to("$to");
            $this->email->subject("$subject");
            $this->email->message("$message");
            
            if(Count($attachment) > 0){
                foreach($attachment as $attach)
                {
                    $this->email->attach($attach);
                }    
            }
            
            if($this->email->send()) 
             $this->session->set_flashdata("email_sent","Email sent successfully."); 
             else 
             $this->session->set_flashdata("email_sent","Error in sending Email."); 
             
             $this->load->view('email_form');
        }
        catch(Exception $e)
        {
             $this->error_message = $e->getMessage();
             return FALSE;
        }
  	}
	
   
}
?>
