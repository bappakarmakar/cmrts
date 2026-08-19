<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_draft_list extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('incident/incident_draft_list_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->load->model('Status_model');
    //$this->output->enable_profiler(TRUE);
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
      2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery.ui.datepicker.js',
      2 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      3 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
      4 => $this->config->item('theme_uri').'assets/js/incident_form.js',
    );
  }

  public function index() 
  {
     $this->validate_login(array('4', '3', '2'));
     $login_id = $this->session->userdata('login_id');
     // $data['incident_draft_status_list'] = array_column($this->Status_model->get_incident_draft_status(),NULL,'incident_draft_status_id');
     // echo"<pre>";print_r($data['incident_draft_status_list']);die;  
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $data['districts'] = $this->Master_model->get_district();
     $data['minor_details'] = $this->Master_model->get_minor_details();
     $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
     $data['incident_details'] = $this->incident_draft_list_model->incident_draft_list_reporting_details();
     // echo '<pre>';print_r($data['incident_details']);die;
     // echo'<pre>';print_r($_SESSION);die;
     $this->load->view($this->config->item('theme').'reporting/incident/incident_draft_list_view', $data);
  }

  public function delete_incident_draft()
  {
     $incident_id = $this->input->get('incident_id');
     $result = $this->incident_draft_list_model->delete_incident_draft_list($incident_id);
  }
  
  private function validate_login($access = array())
  {
      if(in_array($this->session->userdata('stake_id_fk'), $access)){
          return 1;
      }else{
          $this->session->set_flashdata('error','Invalid request!');
          redirect('admin/dashboard');die;
      }
  }
}
