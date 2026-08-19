<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends NIC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege();
		$this->load->model('incident/incident_list_model');
        $this->load->model('common/Master_model');
		$this->load->model('Dashboard_model');
		$this->load->model('notice/Notice_model');
  
		$this->css_head = array(
           1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
        );
        $this->js_foot = array(
            //1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
		    2 => $this->config->item('theme_uri').'assets/js/fetch_district_block.js',
		    3 => $this->config->item('theme_uri').'assets/js/hide_show.js',
		    // 4 => $this->config->item('theme_uri').'assets/js/incident_form.js',
		    4 => $this->config->item('theme_uri').'assets/js/incident_form_updated1.js',
		    5 => $this->config->item('theme_uri').'assets/js/incident_form_validation.js',
		    6 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
		    //7 => $this->config->item('theme_uri').'/assets/js/jquery.min.js'

        );
	} 
	   
	public function index()
	{
		$login_id = $this->session->userdata('login_id');
      	$data['district_details'] = $this->Dashboard_model->district_details($login_id);
      	$data['Complaints_Received_Count'] = $this->Dashboard_model->Complaints_Received_Count_Details();
      	$data['Child_Marriage_Prevented_Count'] = $this->Dashboard_model->Child_Marriage_Prevented_Count_Details();
      	$data['Child_Marriage_Cannot_Prevented_Count'] = $this->Dashboard_model->Child_Marriage_Cannot_Prevented_Count_Details();

      	$data['user_notice']= $user = $this->Notice_model->get_notice();
 
 		$data['cp_minor_adult_count'] = $this->Dashboard_model->get_year_wise_cp_minor_adults_count();
		$data['year'] = array_column($data['cp_minor_adult_count'], "year");
		// First extract the column, then apply floatval
		$data['cp_minor_count'] = array_map('floatval', array_column($data['cp_minor_adult_count'], "cp_minor_count"));
		$data['cp_adult_count'] = array_map('floatval', array_column($data['cp_minor_adult_count'], "cp_adult_count"));

		// echo "<pre>";print_r($data['cp_minor_adult_count']);
    
		$this->load->view($this->config->item('theme').'cmrts_dashboard_view', $data);
		// $this->load->view($this->config->item('theme').'cmrts_dashboard_view_test', $data);
	}  
}
?>