<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Police_case_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('police_case/police_case_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->load->model('incident/incident_form_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
    );

    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }

  public function index($incident_id,$cp_id,$cp_type) 
  {
    $incident_id = base64_decode($incident_id);
    // echo $incident_id;die;
    $cp_id = base64_decode($cp_id);
    $cp_type = base64_decode($cp_type);
    $data['reason'] = $this->police_case_model->cm_police_case_reason();
    $data['incident_id'] = $incident_id;
    $data['cp_id'] =  $cp_id;
    $data['cp_type'] = $cp_type;
    // $date['incident_details'] = $this->incident_form_model->get_incident_details($incident_id);
    $data['incident_details'] = json_decode(json_encode($this->incident_form_model->get_incident_details($incident_id)),true);
    // echo "<pre>";print_r($_POST);die;
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config = array(
      array(
        'field' => 'gd_no',
        'label' => 'GD No',
        'rules' => 'trim|required|callback_custom_Alpha_Check'
      ),
      array(
        'field' => 'gd_date',
        'label' => 'GD Date',
        'rules' => 'trim|required|is_date_valid'
      ),
      array(
        'field' => 'fir_no',
        'label' => 'FIR No',
        'rules' => 'trim|required|callback_custom_Alpha_Check'
      ),
      array(
        'field' => 'fir_date',
        'label' => 'FIR Date',
        'rules' => 'trim|required|is_date_valid|callback_date_less_check'
      ),
      array(
        'field' => 'police_station',
        'label' => 'Police Station',
        'rules' => 'trim|required|callback_custom_Alpha_Check'
      ),
      array(
        'field' => 'pc_district',
        'label' => 'District',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'pc_block',
        'label' => 'SD/Block',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'reason',
        'label' => 'Reason',
        'rules' => 'trim|required|numeric'
      ),
    );
    $this->form_validation->set_rules($config);
    if(strtoupper($this->input->server("REQUEST_METHOD") == strtoupper('POST'))){
      if ($this->form_validation->run() == TRUE) {
        $this->db->trans_begin();
        $result = $this->police_case_model->insert_police_case_details($incident_id,$cp_id,$cp_type);
        if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'Police case details data successful added.');
           redirect('admin/reporting/incident/incident_list');
        }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'Police case details data addition failed. Please try again.');
           redirect('admin/reporting/incident/incident_list');
        }
      }else{
        $this->session->set_flashdata('error', 'Something went wrong. please check errors');
      }
    }

    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['districts'] = $this->Master_model->get_district();
    //$data['incident_details'] = $this->police_case_model->incident_details($incident_id);
    // $data['incident_details'] = array();
    $this->load->view($this->config->item('theme').'reporting/police_case/police_case_form_view', $data);
  }

  public function edit_police_case($sl_no, $incident_id)
  {
      $sl_no = base64_decode($sl_no);
      $incident_id = base64_decode($incident_id);
      $data['incident_details'] = json_decode(json_encode($this->incident_form_model->get_incident_details($incident_id)),true);
      $data['reason'] = $this->police_case_model->cm_police_case_reason();
      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
      $config = array(
        array(
          'field' => 'gd_no',
          'label' => 'GD No',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'gd_date',
          'label' => 'GD Date',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'fir_no',
          'label' => 'FIR No',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'fir_date',
          'label' => 'FIR Date',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'police_station',
          'label' => 'Police Station',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'pc_district',
          'label' => 'District',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'pc_block',
          'label' => 'SD/Block',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'reason',
          'label' => 'Reason',
          'rules' => 'trim|required'
        ),
      );
      $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE) {
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['districts'] = $this->Master_model->get_district();
        $data['police_case_details'] = $this->police_case_model->police_case_edit_details($sl_no);

        $pc_district = $data['police_case_details']->district;
        $data['Block'] = $this->Master_model->get_block($pc_district);
        $this->load->view($this->config->item('theme').'reporting/police_case/police_case_form_edit_view', $data);
      }else{
        $this->db->trans_begin();
        $result = $this->police_case_model->update_police_case_details($sl_no);
        if($result == 0){
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Police case details data successful updated.');
            redirect('admin/reporting/police_case/police_case_list');
        }else{
          $this->db->trans_rollback();
          $this->session->set_flashdata('warning', 'Police case details data updation failed. Please try again.');
           redirect('admin/reporting/police_case/police_case_list');
        }
      }
  }

  public function custom_Alpha_Check($str) 
  {
     if (! preg_match("/^([a-z0-9 ])+$/i", $str)) {
        $this->form_validation->set_message('custom_Alpha_Check', 'The %s field can only be alpha numeric');
        return false;
     } else {
        return true;
     }

     if (! preg_match("/^([a-z0-9 ])+$/i", $str)) {
        $this->form_validation->set_message('custom_Alpha_Check', 'The %s field can only be alpha numeric');
        return false;
     } else {
        return true;
     }

     if (! preg_match("/^([a-z0-9 ])+$/i", $str)) {
        $this->form_validation->set_message('custom_Alpha_Check', 'The %s field can only be alpha numeric');
        return false;
     } else {
        return true;
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

  // public function date_less_check($fir_date)
  // {
  //   // echo $fir_date;die;
  //   $incident_date = $this->input->post('incident_date');

  //   $date_array = explode('-', $incident_date);
  //      $incident_date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

  //    $date_array1 = explode('/', $fir_date);
  //    $fir_date =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];

  //   // echo strtotime($fir_date)."-----".strtotime($incident_date).'<br>' ; 
  //   // echo $fir_date."-----".$incident_date ; die;
  //   if(strtotime($fir_date)<strtotime($incident_date))
  //   {
  //     $this->form_validation->set_message('date_less_check', 'Fir date should not be less then incident date:'.$incident_date);

  //     return false;

  //   }
  //     return true;

  // }

  public function date_less_check($fir_date)
  {

    // echo $fir_date;die;
    $incident_date = $this->input->post('incident_date');
    if(empty($fir_date)){
      $this->form_validation->set_message('date_less_check', 'The FIR Date field is required');

        return false;

    }else{
      $date_array = explode('-', $incident_date);
       $incident_date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

       $date_array1 = explode('/', $fir_date);
       $fir_date =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];

      // echo strtotime($fir_date)."-----".strtotime($incident_date).'<br>' ; 
      // echo $fir_date."-----".$incident_date ; die;
      if(strtotime($fir_date)<strtotime($incident_date))
      {
        $this->form_validation->set_message('date_less_check', 'Fir date should not be less then incident date: '. $this->input->post('incident_date'));
        return false;
      }
        return true;
    }

  }



}
