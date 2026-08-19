<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Home_visit_minor_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->model('home_visit/home_visit_minor_form_model');
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
  
  public function index($incident_id) 
  {
    $this->validate_login(array('4'));
    $incident_id = base64_decode($incident_id);
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config_two = array();
    $config_three = array();
    $config_four = array();
    $config_five = array();
    $config_six = array();
    $config_seven = array();
    $config_eight = array();
    $config_one = array(
      array(
        'field' => 'mode_of_enquiry',
        'label' => 'Mode of Enquiry',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'gender',
        'label' => 'Gender',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'family_income',
        'label' => 'Total Family Income',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'nutritious_meals',
        'label' => 'Nutritious meals a day',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'neighbours_community',
        'label' => 'Neighbours and Community',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'emergencies',
        'label' => 'Emergencies',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'disability',
        'label' => 'Has a disability',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'education',
        'label' => 'education',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'kishori_group',
        'label' => 'kishori group',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'paid_work',
        'label' => 'paid work',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'kanyashree_id',
        'label' => 'Kanyashree ID',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'parents_supported',
        'label' => 'parents',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'family_elders_supported',
        'label' => 'family elders',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'peers_supported',
        'label' => 'peers',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'neighbours_supported',
        'label' => 'neighbours',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'others_supported',
        'label' => 'others',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'minor_pregnant',
        'label' => 'minor pregnant',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'remarks',
        'label' => 'Remarks',
        'rules' => 'trim|is_script_validate'
      ),
    );

    if($this->input->post('disability') == 1){
      $config_two = array(
        array(
          'field' => 'type_of_disability[]',
          'label' => 'type of disability',
          'rules' => 'trim|required|numeric'
        ),
        array(
          'field' => 'disability_certificate',
          'label' => 'Has a disability certificate',
          'rules' => 'trim|required|numeric'
        ),
      );
    }

    if($this->input->post('disability_certificate') == 1){
      $config_three = array(
        array(
          'field' => 'disability_percent',
          'label' => 'disability percent',
          'rules' => 'trim|required|numeric'
        ),
      );
    }elseif($this->input->post('disability_certificate') == 2){
      $config_four = array(
        array(
          'field' => 'estimated_severity',
          'label' => 'estimated severity',
          'rules' => 'trim|required|numeric'
        ),
      );
    }

    if($this->input->post('education') == 1){
      $config_five = array(
        array(
          'field' => 'education_frequency',
          'label' => 'education frequency',
          'rules' => 'trim|required|numeric'
        ),
      );
    }

    if($this->input->post('kishori_group') == 1){
      $config_six = array(
        array(
          'field' => 'kishori_group_frequency',
          'label' => 'kishori group frequency',
          'rules' => 'trim|required|numeric'
        ),
      );
    }

    if($this->input->post('paid_work') == 1){
      $config_seven = array(
        array(
          'field' => 'paid_work_frequency',
          'label' => 'paid work frequency',
          'rules' => 'trim|required|numeric'
        ),
      );
    }

    if($this->input->post('minor_pregnant') == 1){
      $config_eight = array(
        array(
          'field' => 'stage_of_pregnancy',
          'label' => 'stage of pregnancy',
          'rules' => 'trim|required|numeric'
        ),
      );
    }
    $config = array_merge($config_one, $config_two, $config_three, $config_four, $config_five, $config_six, $config_seven, $config_eight);
    $this->form_validation->set_rules($config);
    if(strtoupper($this->input->server("REQUEST_METHOD") == strtoupper('POST'))){
      if ($this->form_validation->run() == TRUE) {
        $this->db->trans_begin();
        $result = $this->home_visit_minor_form_model->insert_home_visit_minor_details($incident_id);
        if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'Home visit to minor data successful added.');
           redirect('admin/reporting/incident/incident_list');
        }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'Home visit to minor data addition failed. Please try again.');
           redirect('admin/reporting/incident/incident_list');
        }
      }
      else{
        $this->session->set_flashdata('error', 'Something went wrong. please check errors');
      }
    }
    
    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['gender_details'] = $this->Master_model->get_gender_details();
    $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
    $data['disability_details'] = $this->Master_model->get_disability_details();
    $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
    $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
    $data['incident_details'] = $this->home_visit_minor_form_model->get_incident_details($incident_id);
    $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_minor_form_view', $data);
  }

  // public function home_visit_minor_form_edit($home_visit_id)
  // {
  //     $home_visit_id = base64_decode($home_visit_id);
  //     $login_id = $this->session->userdata('login_id');
  //     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
  //     $data['gender_details'] = $this->Master_model->get_gender_details();
  //     $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
  //     $data['disability_details'] = $this->Master_model->get_disability_details();
  //     $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
  //     $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
  //     $data['home_visit_minor_details'] = $this->home_visit_minor_form_model->get_home_visit_minor_details($home_visit_id);
  //     $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_minor_form_edit_view', $data);
  // }

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
