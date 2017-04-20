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
    $form       = $this->input->post();
    $valid = true;
    $this->form_validation->set_rules('report[]','Report Name','trim|required');
    if(in_array('cogfind',$form['report']))
      $this->form_validation->set_rules('inventory','Inventory','trim|required');
    if(in_array('frnka',$form['report']))
      $this->form_validation->set_rules('customer','Customer','trim|required');
    if($this->form_validation->run() == FALSE)
    {
    $start_date = date("Y-m-d",strtotime($form['start_date']));
    $end_date = date("Y-m-d",strtotime($form['end_date']));
    $this->data['date'] = array("start_date"=>$start_date,"end_date"=>$end_date);
    if(in_array('cleading',$form['report']))
    {
    $start_date = date("Y-m-d",strtotime($form['start_date']));
    $end_date   = date("Y-m-d",strtotime($form['end_date']));
    
    $this->data['date'] = array("start_date"=>$start_date,"end_date"=>$end_date);
    
    if(in_array('cleading',$form['report'])){
      $valid = false;
      $this->layout->view('frontend/reports/index');
    }
    if($valid)
    {
      $this->data['btn'] = isset($_POST['print']) ? "print" : "view";
      $start_date = date("Y-m-d",strtotime($form['start_date']));
      $end_date   = date("Y-m-d",strtotime($form['end_date']));
      $this->data['date'] = array("start_date"=>$start_date,"end_date"=>$end_date,"inventory"=>$form['inventory'],"customer"=>$form['customer']);
      if(in_array('cleading',$form['report']))
      {
        $this->data['cleading'] = $this->reports_model->get_cleading($start_date,$end_date);
        $this->load->view('frontend/reports/cleading',$this->data);
      }
      else if(in_array('cogfind',$form['report']))
      {
        $this->data['cogfind'] = $this->reports_model->get_cogfind($start_date,$end_date,$_POST['inventory']);
        $this->load->view('frontend/reports/cogfind',$this->data);
      }
      else if(in_array('frnka',$form['report']))
      {
        $this->data['frnka'] = $this->reports_model->get_frnka($start_date,$end_date,$_POST['customer']);
        $this->load->view('frontend/reports/frnka',$this->data); 
      }
    }
    if(in_array("invchk",$form['report'])){
        $this->data['shipping_order'] = $this->reports_model->get_shipping_order($start_date,$end_date);
        $this->load->view('frontend/reports/sales_order',$this->data); 
    }
    
    if(in_array("incott",$form['report'])){
        $shipping_order               = $this->reports_model->get_warehouse_inventory($start_date,$end_date);
        $this->data['shipping_order'] = $shipping_order;
        $this->load->view('frontend/reports/inventory_all_warehouse',$this->data); 
    }
    
    if(in_array("sales18d",$form['report'])){
        $so_order               = $this->reports_model->sales_gross_profit($start_date,$end_date);
        $this->data['so_order'] = $so_order;
        $this->load->view('frontend/reports/sales_gross_profit',$this->data); 
    }
    if(in_array("mike1",$form['report'])){
        $so_order               = $this->reports_model->sales_gross_profit($start_date,$end_date);
        $this->data['so_order'] = $so_order;
        $this->load->view('frontend/reports/sales_mike_gross_profit',$this->data); 
    }
  }
}
?>
