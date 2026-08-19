<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Inbox_view extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('notifications/inbox_list_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
      2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery.ui.datepicker.js',
      2 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      3 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
    );
  }

  public function index() 
  {
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $data['inbox_details'] = $this->inbox_list_model->inbox_list();
     $this->load->view($this->config->item('theme').'notifications/inbox_list_view', $data);
  }

  public function view($notification_id)
  {
     $inbox_details = $this->inbox_list_model->inbox_view_list($notification_id);
     redirect($inbox_details->page_link);
  }
}
