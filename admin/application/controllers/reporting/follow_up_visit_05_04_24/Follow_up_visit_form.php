<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Follow_up_visit_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('upload');
    $this->load->model('follow_up_visit/follow_up_visit_form_model');
    $this->load->model('common/Master_model');
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

  public function index($incident_id, $cp_type, $cp_id) 
  {
    $this->validate_login(array('4'));
    $incident_id = base64_decode($incident_id);
    $cp_type = base64_decode($cp_type);
    $cp_id = base64_decode($cp_id);
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config = array(
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
        'field' => 'education',
        'label' => 'Education',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'kishori_group',
        'label' => 'Kishori Group',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'paid_work',
        'label' => 'Paid work',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'parents_supported',
        'label' => 'Parents',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'family_elders_supported',
        'label' => 'Family elders',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'peers_supported',
        'label' => 'Peers',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'neighbours_supported',
        'label' => 'Neighbours',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'others_supported',
        'label' => 'Others',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'minor_pregnant',
        'label' => 'Minor is pregnant',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'remarks',
        'label' => 'Remarks',
        'rules' => 'trim|is_script_validate'
      ),
    );
    $this->form_validation->set_rules($config);
    if(strtoupper($this->input->server("REQUEST_METHOD") == strtoupper('POST'))){
      if($this->form_validation->run() == TRUE) {
        $this->db->trans_begin();
        $result = $this->follow_up_visit_form_model->insert_follow_up_visit_details($incident_id, $cp_type, $cp_id);
        if($result == 0){
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Follow up of minor data successful added.');
            redirect('admin/reporting/incident/incident_list');
        }else{
          $this->db->trans_rollback();
          $this->session->set_flashdata('warning', 'Follow up of minor data addition failed. Please try again.');
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
    $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
    // $data['incident_details_new'] = $this->follow_up_visit_form_model->get_incident_details_new($cp_id);
    $data['incident_cp_details'] = $this->follow_up_visit_form_model->get_incident_cp_details($cp_id);
    $this->load->view($this->config->item('theme').'reporting/follow_up_visit/follow_up_visit_form_view', $data);
  }

  public function follow_up_visit_form_edit($follow_up_id)
  {
    $follow_up_id = base64_decode($follow_up_id);
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config = array(
      array(
        'field' => 'mode_of_enquiry',
        'label' => 'Mode of Enquiry',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'gender',
        'label' => 'Gender',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'education',
        'label' => 'Education',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'kishori_group',
        'label' => 'Kishori Group',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'paid_work',
        'label' => 'Paid work',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'parents_supported',
        'label' => 'Parents',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'family_elders_supported',
        'label' => 'Family elders',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'peers_supported',
        'label' => 'Peers',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'neighbours_supported',
        'label' => 'Neighbours',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'others_supported',
        'label' => 'Others',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'minor_pregnant',
        'label' => 'Minor is pregnant',
        'rules' => 'trim|required'
      ),
    );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
      $login_id = $this->session->userdata('login_id');
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);
      $data['gender_details'] = $this->Master_model->get_gender_details();
      $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
      $data['follow_up_details'] = $this->follow_up_visit_form_model->get_follow_up_visit_edit_details($follow_up_id);
      $this->load->view($this->config->item('theme').'reporting/follow_up_visit/follow_up_visit_edit_form_view', $data);
    }else{
      $this->db->trans_begin();
      $result = $this->follow_up_visit_form_model->update_follow_up_visit_details($follow_up_id);
      if($result == 0){
          $this->db->trans_commit();
          $this->session->set_flashdata('success', 'Follow up of minor data successful updated.');
          redirect('admin/reporting/follow_up_visit/follow_up_visits_list');
      }else{
        $this->db->trans_rollback();
        $this->session->set_flashdata('warning', 'Follow up of minor data updation failed. Please try again.');
         redirect('admin/reporting/follow_up_visit/follow_up_visits_list');
      }
    }
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
