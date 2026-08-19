<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Home_visit_adult_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->model('home_visit/home_visit_adult_form_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
    );

    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
      2 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
    );
  }

  public function index($incident_id, $cp_type, $cp_id) 
  {
    $this->validate_login(array('4'));
    $incident_id = base64_decode($incident_id);
    $cp_type = base64_decode($cp_type);
    $cp_id = base64_decode($cp_id);
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config_two = array();
    $config_three = array();
    $config_one = array(
      array(
        'field' => 'mode_of_enquiry',
        'label' => 'Mode of Enquiry',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'family_income',
        'label' => 'Total family income',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'nutritious_meals',
        'label' => 'Every member of the family',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'neighbours_community',
        'label' => 'The family get support',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'emergencies',
        'label' => 'The family has some money',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'education',
        'label' => 'Education',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'paid_work',
        'label' => 'Paid work',
        'rules' => 'trim|required|numeric'
      ),
    );

    if($this->input->post('education') == 1){
      $config_two = array(
        array(
          'field' => 'education_frequency',
          'label' => 'education frequency',
          'rules' => 'trim|required|numeric'
        ),
      );
    }

    if($this->input->post('paid_work') == 1){
      $config_three = array(
        array(
          'field' => 'paid_work_frequency',
          'label' => 'paid work frequency',
          'rules' => 'trim|required|numeric'
        ),
      );
    }
    $config = array_merge($config_one, $config_two, $config_three);
    $this->form_validation->set_rules($config);
    if(strtoupper($this->input->server("REQUEST_METHOD") == strtoupper('POST'))){
      if ($this->form_validation->run() == TRUE) {
        $this->db->trans_begin();
        $result = $this->home_visit_adult_form_model->insert_home_visit_adult_details($incident_id, $cp_type, $cp_id);
        if($result == 0){
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Home visit to adult data successful added.');
            redirect('admin/reporting/incident/incident_list');
        }else{
          $this->db->trans_rollback();
          $this->session->set_flashdata('warning', 'Home visit to adult data addition failed. Please try again.');
           redirect('admin/reporting/incident/incident_list');
        }
      }else{
        $this->session->set_flashdata('error', 'Something went wrong. please check errors');
      }
    }
      
    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['gender_details'] = $this->Master_model->get_gender_details();
    $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
    $data['incident_home_visit_details'] = $this->home_visit_adult_form_model->get_incident_home_visit_details($cp_id);
    $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_adult_form_view', $data);
  }

  public function us_date_format($uk_date=NULL)
  {
    if($uk_date != NULL){
       $date_array = explode('/', $uk_date);
       return $date_array[2].'-'.$date_array[0].'-'.$date_array[1];
    } else {
       return NULL;
    }
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
