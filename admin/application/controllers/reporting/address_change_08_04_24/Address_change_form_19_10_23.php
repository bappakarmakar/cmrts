<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Address_change_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('address_change/address_change_model');
    $this->load->model('incident/incident_list_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
    );

    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }

  public function index($incident_id) 
  {
    $this->validate_login(array('2', '6'));
    $incident_id = base64_decode($incident_id);
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $minor_sent = $this->input->post('minor_sent');
    $config_two = array();
    $config_one = array(
      array(
        'field' => 'minor_details',
        'label' => 'Minor Details',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'minor_sent',
        'label' => 'Minor Sent to',
        'rules' => 'trim|required|numeric'
      ),
    );
    if($minor_sent == 1 || $minor_sent == 2 || $minor_sent == 3){
      $config_two = array(
      array(
        'field' => 'district',
        'label' => 'District',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'block',
        'label' => 'Block',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'address',
        'label' => 'Address',
        'rules' => 'trim|required|is_title_validation'
      ),
    );
    }
    $config = array_merge($config_one, $config_two);
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['districts'] = $this->Master_model->get_district();
        $data['minor_details'] = $this->Master_model->get_minor_details();
        $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
        $data['incident_details'] = $this->address_change_model->incident_list_reporting_details($incident_id);
        $this->load->view($this->config->item('theme').'reporting/address_change/address_change_form_view', $data);
    } else {
        $this->db->trans_begin();
        $minor_details = $this->input->post('minor_details');
        $uploaded = array(
          'incident_id_fk' => $incident_id,
          'stake_holder_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
          'minor_sent' => $this->input->post('minor_sent'),
          'case_no' => $this->input->post('case_no'),
          'case_date' => $this->us_date_format($this->input->post('case_date')),
          'state' => 19,
          'district' => $this->input->post('district'),
          'block' => $this->input->post('block'),
          'cci_details' => $this->input->post('cci_details'),
          'address' => $this->input->post('address'),
          'remarks' => $this->input->post('remarks'),
          'created_at' => date('Y-m-d H:i:s'),
          'created_ip' => $_SERVER['REMOTE_ADDR'],
          'active_status' => 1,
          'transfer_status' => 101,
          'minor_details' => $minor_details
        );
        $result = $this->address_change_model->insert_address_change_details($uploaded, $minor_details);
        if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'Address change data successful added.');
           redirect('admin/reporting/incident/incident_list');
        }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'Address change data addition failed. Please try again.');
           redirect('admin/reporting/incident/incident_list');
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
