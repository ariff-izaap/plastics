<?php if(!defined("BASEPATH")) exit("No direct script access allowed");

require_once(APPPATH."libraries/Admin_controller.php");

class Uploads extends Admin_controller {
    
    public $data = array();

    private $upload_path = './assets/images/';

    function __construct() {
        parent::__construct();

    }

   function do_upload(){

        try
        {
            $form = $this->input->post(NULL, TRUE);
            $field = $form['field'];
          
            if(!isset($form['upload_folder']))
                 throw new Exception("Upload folder is empty!");

            $config['upload_path']   = $this->upload_path.$form['upload_folder'].'/';
            $config['allowed_types'] = (isset($form['types']) && !empty($form['types']))?$form['types']:'gif|jpg|png|jpeg';
            $config['max_size']      = '10000';
            $config['max_width']     = '300';
            $config['max_height']    = '100';

            $this->load->library('upload', $config);

            if(!$this->upload->do_upload("$field"))            
               throw new Exception($this->upload->display_errors());
               
            $files = $this->upload->data();  
           
            $this->data['fileuploaded']   = $files['file_name'];               

        }
        catch(Exception $e)
        {
            $this->data['error'] = $e->getMessage();
            
        }     

        echo json_encode($this->data);
        exit;

   }
}

?>
