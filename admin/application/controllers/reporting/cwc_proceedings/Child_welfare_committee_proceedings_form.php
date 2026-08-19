<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Child_welfare_committee_proceedings_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('cwc_proceedings/child_welfare_committee_proceedings_form_model');
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
    $incident_id = base64_decode($incident_id);
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config = array(
      array(
        'field' => 'minor_sent',
        'label' => 'Minor Sent to',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'case_no',
        'label' => '<b>Case No</b>',
        'rules' => 'trim|required|alpha_numeric'
      ),
      array(
        'field' => 'case_date',
        'label' => '<b>Date</b>',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'block',
        'label' => '<b>SD/Block</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'cci_details',
        'label' => '<b>CCI</b>',
        'rules' => 'trim|required|numeric'
      ),
    );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['districts'] = $this->Master_model->get_district();
        // $data['minor_details'] = $this->Master_model->get_minor_details();
        $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
        $data['incident_details'] = $this->incident_list_model->incident_list_reporting_details();
        $this->load->view($this->config->item('theme').'reporting/cwc_proceedings/cwc_proceedings_cp_one_form_view', $data);
    } else {
        $this->db->trans_begin();
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
          'remarks' => $this->input->post('remarks'),
          'created_at' => date('Y-m-d H:i:s'),
          'created_ip' => $_SERVER['REMOTE_ADDR'],
          'active_status' => 1,
          'transfer_status' => 102,
          'minor_details' => 1
        );
        $result = $this->child_welfare_committee_proceedings_form_model->insert_cwc_proceedings_cp_one_details($uploaded);
        if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'CWC data successful added.');
           redirect('admin/reporting/incident/incident_list');
        }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'CWC data addition failed. Please try again.');
           redirect('admin/reporting/incident/incident_list');
        }
     }
  }

  public function child_welfare_committee_proceedings_cp_two_form($incident_id)
  {
    $incident_id = base64_decode($incident_id);
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config = array(
      array(
        'field' => 'minor_sent',
        'label' => 'Minor Sent to',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'case_no',
        'label' => '<b>Case No</b>',
        'rules' => 'trim|required|alpha_numeric'
      ),
      array(
        'field' => 'case_date',
        'label' => '<b>Date</b>',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'block',
        'label' => '<b>SD/Block</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'cci_details',
        'label' => '<b>CCI</b>',
        'rules' => 'trim|required|numeric'
      ),
    );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['districts'] = $this->Master_model->get_district();
        // $data['minor_details'] = $this->Master_model->get_minor_details();
        $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
        $data['incident_details'] = $this->incident_list_model->incident_list_reporting_details();
        $this->load->view($this->config->item('theme').'reporting/cwc_proceedings/cwc_proceedings_cp_two_form_view', $data);
    } else {
        $this->db->trans_begin();
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
          'remarks' => $this->input->post('remarks'),
          'created_at' => date('Y-m-d H:i:s'),
          'created_ip' => $_SERVER['REMOTE_ADDR'],
          'active_status' => 1,
          'transfer_status' => 102,
          'minor_details' => 2
        );
        $result = $this->child_welfare_committee_proceedings_form_model->insert_cwc_proceedings_cp_two_details($uploaded);
        if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'CWC data successful added.');
           redirect('admin/reporting/incident/incident_list');
        }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'CWC data addition failed. Please try again.');
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
}
