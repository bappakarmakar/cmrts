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
    //echo 123;die;
    $login_id = $this->session->userdata('login_id');
    $this->validate_login(array('2', '6'));
    $incident_id = base64_decode($incident_id);
    $data['incident_id_pk'] = $incident_id;
    $data['contracting_parties_details'] = $contracting_parties_details = $this->address_change_model->contracting_parties_details_by_incident_id($incident_id);
    
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);

    $block = ($this->input->post('block'))?$this->input->post('block'):NULL;
    $data['Ward_Gp_Block'] = $Ward_Gp_Block = $this->Master_model->get_ward_gp_block($block);

    if(!empty($Ward_Gp_Block)){
      if($Ward_Gp_Block->rural_urban == 'U'){
        $data['cp_ward'] = $this->Master_model->get_ward($block);
      }else{
        $data['cp_gp'] = $this->Master_model->get_gp($block);
      }
    }

    $data['districts'] = $this->Master_model->get_district();
    $data['minor_details'] = $this->Master_model->get_minor_details();
    $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
    $data['incident_details'] = $this->address_change_model->incident_list_reporting_details($incident_id);
    $district = ($this->input->post('district'))?$this->input->post('district'):NULL;
    $data['block_details'] = $this->Master_model->get_block($district);
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config = array(
      array(
        'field' => 'minor_details',
        'label' => '<b>Minor Details</b>',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'block',
        'label' => '<b>Block / Municipality</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'ward_gp',
        'label' => '<b>Ward / GP</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'pin_code',
        'label' => '<b>Pin Code</b>',
        'rules' => 'trim|required|max_length[6]|numeric'
      ),
      array(
        'field' => 'police_station',
        'label' => '<b>Police Station</b>',
        'rules' => 'trim|required|is_title_validation'
      ),
      array(
        'field' => 'address',
        'label' => '<b>Address</b>',
        'rules' => 'trim|required'
      ),
    );
  
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
        $this->load->view($this->config->item('theme').'reporting/address_change/address_change_form_view', $data);
    } else {
      $minor_details = explode(":",$this->input->post('minor_details'));
      $cp_id_fk = $minor_details[0];
      $cp_type = $minor_details[1];
        $this->db->trans_begin();
        $minor_details = $this->input->post('minor_details');
        $uploaded = array(
          'incident_id_fk' => $incident_id,
          'cp_id_fk' => $cp_id_fk,
          'cp_type' => $cp_type,
          'state' => 19,
          'district' => $this->input->post('district'),
          'block' => $this->input->post('block'),
          'street_landmark' => $this->input->post('street_landmark'),
          'pin_code' => $this->input->post('pin_code'),
          'ward_gp' => $this->input->post('ward_gp'),
          'police_station' => $this->input->post('police_station'),
          'address' => $this->input->post('address'),
          'remarks' => $this->input->post('remarks'),
          'created_at' => date('Y-m-d H:i:s'),
          'created_ip' => $_SERVER['REMOTE_ADDR']
        );
        $result = $this->address_change_model->insert_address_change_details($uploaded, $cp_type);
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

  public function Get_Block_Details()
  {  
      $block_id = $this->input->get('id');
      $block_details = $this->Master_model->get_block_details($block_id);
      echo json_encode($block_details);
  }

  public function Get_Ward_Details()
  {  
      $block_id = $this->input->get('id');
      $ward = $this->Master_model->get_ward_details($block_id);
      echo json_encode($ward);
  }

  public function Get_GP_Details()
  {  
      $block_id = $this->input->get('id');
      $gp = $this->Master_model->get_gp_details($block_id);
      echo json_encode($gp);
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
