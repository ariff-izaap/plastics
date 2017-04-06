<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH."libraries/Admin_controller.php");

class Reports extends Admin_Controller 
{
	function __construct()
  {
      parent::__construct();  

      if(!is_logged_in())
          redirect('login');
		
   $this->load->model('reports_model');
   $this->load->library('listing');
  }

  public function index()
  {
    $this->layout->view('frontend/reports/index');
  }
  public function report_print()
  {
    $form = $this->input->post();
    $start_date = date("Y-m-d",strtotime($form['start_date']));
    $end_date = date("Y-m-d",strtotime($form['end_date']));
    $this->data['date'] = array("start_date"=>$start_date,"end_date"=>$end_date);
    if(in_array('cleading',$form['report']))
    {
      $this->data['cleading'] = $this->reports_model->get_cleading($start_date,$end_date);
      $this->load->view('frontend/reports/cleading',$this->data); 
    }
  }
}
?>