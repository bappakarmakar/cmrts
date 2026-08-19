<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Address_list extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('address/Address_list_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
      2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
      3 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/incident_form_validation.js',
    );
  }

  public function index() 
  {
     $this->validate_login(array('2', '3', '4'));
    //  $data['Incident_Ward_Gp_Block'] = $Incident_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($incident_block);
    // if(!empty($Incident_Ward_Gp_Block))
    // {
    //   if($Incident_Ward_Gp_Block->rural_urban == 'U')
    //   {
    //   $data['Incident_Ward'] = $this->Master_model->get_ward($incident_block);
    //   }else{
    //   $data['Incident_Gp'] = $this->Master_model->get_gp($incident_block);
    //   }
    // }


     $login_id = $this->session->userdata('login_id');
     $data['marriage_details'] = $this->Master_model->get_marriage_details();
     $data['location_description_details'] = $this->Master_model->get_location_description_details();
     $data['prevented_details'] = $this->Master_model->get_prevented_details();
     $data['information_received_details'] = $this->Master_model->get_information_received_details();
     $data['gender_details'] = $this->Master_model->get_gender_details();
     $data['social_category_details'] = $this->Master_model->get_social_category_details();
     $data['religion_details'] = $this->Master_model->get_religion_details();
     $data['document_type_details'] = $this->Master_model->get_document_type_details();
     $data['highest_education_details'] = $this->Master_model->get_highest_education_details();
     $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $data['districts'] = $this->Master_model->get_district();
     $data['minor_details'] = $this->Master_model->get_minor_details();
     $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
     $data['incident_details'] = $this->Address_list_model->incident_list_reporting_details();
     $this->load->view($this->config->item('theme').'reporting/address/add_address_list_view', $data);
  }

  public function add_cp_one_current_address($incident_id)
  {
    $this->validate_login(array('2', '3', '4'));
    $data['ward_gp_details'] = $this->Master_model->BDO_DEO_Get_Ward_GP($this->session->userdata('block'));
    $incident_id = base64_decode($incident_id);
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $minor_sent = $this->input->post('minor_sent');
    $config_two = array();
    $config_one = array(
      array(
        'field' => 'minor_sent',
        'label' => 'Minor Sent to',
        'rules' => 'trim|required|numeric'
      ),
    );
    if($minor_sent == 1 || $minor_sent == 3){
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
      // array(
      //   'field' => 'ward_gp',
      //   'label' => 'ward gp',
      //   'rules' => 'trim|required|is_title_validation'
      // ),      
      array(
        'field' => 'cp_one_pin_code',
        'label' => 'pin code',
        'rules' => 'trim|required|is_title_validation'
      ),      
      array(
        'field' => 'cp_one_police_station',
        'label' => 'police station',
        'rules' => 'trim|required|is_title_validation'
      ),
    );
    }elseif($minor_sent == 4){
      $config_two = array(
      array(
        'field' => 'case_no',
        'label' => 'Case No',
        'rules' => 'trim|required|alpha_numeric'
      ),
      array(
        'field' => 'case_date',
        'label' => 'Date',
        'rules' => 'trim|required'
      ),
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
    );
    }
    $config = array_merge($config_one, $config_two);
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
      // echo'<pre>';print_r($_SESSION);die;
      echo validation_errors(); 
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['districts'] = $this->Master_model->get_district();
        $data['minor_details'] = $this->Master_model->get_minor_details();
        $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
        $data['cp_one_current_age'] = $this->Address_list_model->CP_One_Age($incident_id);
        $this->load->view($this->config->item('theme').'reporting/address/add_cp_one_current_address_form_view', $data);
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
        $uploaded['street_landmark'] =  $this->input->post('street_landmark');
        $uploaded['pin_code'] =  $this->input->post('cp_one_pin_code');
        $uploaded['ward_gp'] =  $this->input->post('ward_gp');
        $uploaded['police_station'] =  $this->input->post('cp_one_police_station');

        // echo'<pre>';print_r($uploaded);die();
        $result = $this->Address_list_model->insert_cp_one_current_address_details($uploaded);
        if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'Address data successful added.');
           redirect('admin/reporting/address/address_list');
        }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'Address data addition failed. Please try again.');
           redirect('admin/reporting/address/address_list');
        }
     }
  }

  public function add_cp_two_current_address($incident_id)
  {
    $this->validate_login(array('2', '3', '4'));
    $incident_id = base64_decode($incident_id);
    $data['ward_gp_details'] = $this->Master_model->BDO_DEO_Get_Ward_GP($this->session->userdata('block'));
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $minor_sent = $this->input->post('minor_sent');
    $config_two = array();
    $config_one = array(
      array(
        'field' => 'minor_sent',
        'label' => 'Minor Sent to',
        'rules' => 'trim|required|numeric'
      ),
    );
    if($minor_sent == 1 || $minor_sent == 3){
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
      array(
        'field' => 'ward_gp',
        'label' => 'ward gp',
        'rules' => 'trim|required|is_title_validation'
      ),      
      array(
        'field' => 'cp_two_pin_code',
        'label' => 'pin code',
        'rules' => 'trim|required|is_title_validation'
      ),      
      array(
        'field' => 'cp_two_police_station',
        'label' => 'police station',
        'rules' => 'trim|required|is_title_validation'
      ),
    );
    }elseif($minor_sent == 4){
      $config_two = array(
      array(
        'field' => 'case_no',
        'label' => 'Case No',
        'rules' => 'trim|required|alpha_numeric'
      ),
      array(
        'field' => 'case_date',
        'label' => 'Date',
        'rules' => 'trim|required'
      ),
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
        'field' => 'ward_gp',
        'label' => 'ward gp',
        'rules' => 'trim|required|is_title_validation'
      ),      
      array(
        'field' => 'cp_two_pin_code',
        'label' => 'pin code',
        'rules' => 'trim|required|is_title_validation'
      ),      
      array(
        'field' => 'cp_two_police_station',
        'label' => 'police station',
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
        $data['cp_two_current_age'] = $this->Address_list_model->CP_Two_Age($incident_id);
        $this->load->view($this->config->item('theme').'reporting/address/add_cp_two_current_address_form_view', $data);
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
        $uploaded['street_landmark'] =  $this->input->post('street_landmark');
        $uploaded['pin_code'] =  $this->input->post('cp_two_pin_code');
        $uploaded['ward_gp'] =  $this->input->post('ward_gp');
        $uploaded['police_station'] =  $this->input->post('cp_two_police_station');
        $result = $this->Address_list_model->insert_cp_two_current_address_details($uploaded);
        if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'Address data successful added.');
           redirect('admin/reporting/address/address_list');
        }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'Address data addition failed. Please try again.');
           redirect('admin/reporting/address/address_list');
        }
     }
  }

  public function Fetch_CP_One_Entered_Address()
  {
    // echo 123;die;
    $fetch_entered_address = $this->input->get('fetch_entered_address');
    $incident_id = base64_decode($this->input->get('incident_id'));
    $result = $this->Address_list_model->CP_One_Current_Address_Fetch($incident_id);
    echo json_encode($result);
    
  }

  public function Fetch_Edit_CP_One_Entered_Address()
  {
    $fetch_entered_address = $this->input->get('fetch_entered_address');
    $incident_id = base64_decode($this->input->get('incident_id'));
    $result = $this->Address_list_model->Edit_CP_One_Current_Address_Fetch($incident_id);
    echo json_encode($result);
    
  }

  public function Fetch_CP_Two_Entered_Address()
  {
    $fetch_entered_address = $this->input->get('fetch_entered_address');
    $incident_id = base64_decode($this->input->get('incident_id'));
    $result = $this->Address_list_model->CP_Two_Current_Address_Fetch($incident_id);
    echo json_encode($result);
    
  }

    public function Fetch_Edit_CP_Two_Entered_Address()
  {
    $fetch_entered_address = $this->input->get('fetch_entered_address');
    $incident_id = base64_decode($this->input->get('incident_id'));
    $result = $this->Address_list_model->Edit_CP_Two_Current_Address_Fetch($incident_id);
    echo json_encode($result);
    
  }

  public function Fetch_District_Details()
  {
    $result = $this->Master_model->get_district();
    echo json_encode($result);
  }

  public function Get_Cp_One_Gender_Details()
  {
    $district_value = $this->input->get('district_value');
    $incident_id = base64_decode($this->input->get('incident_id'));
    $cp_gender = $this->Address_list_model->cp_one_gender_value($incident_id);
    $cci_result = $this->Address_list_model->cp_cci_value($district_value, $cp_gender);
    echo json_encode($cci_result);
  }

  public function Get_Cp_Two_Gender_Details()
  {
    $district_value = $this->input->get('district_value');
    $incident_id = base64_decode($this->input->get('incident_id'));
    $cp_gender = $this->Address_list_model->cp_two_gender_value($incident_id);
    $cci_result = $this->Address_list_model->cp_cci_value($district_value, $cp_gender);
    echo json_encode($cci_result);
  }

  public function edit_cp_one_current_address($incident_id)
  {
    $this->validate_login(array('2', '3', '4'));
    $incident_id = base64_decode($incident_id);
    $data['ward_gp_details'] = $this->Master_model->BDO_DEO_Get_Ward_GP($this->session->userdata('block'));
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $minor_sent = $this->input->post('minor_sent');
    $config_two = array();
    $config_one = array(
      array(
        'field' => 'minor_sent',
        'label' => 'Minor Sent to',
        'rules' => 'trim|required|numeric'
      ),
    );
    if($minor_sent == 1 || $minor_sent == 3){
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

      array(
        'field' => 'ward_gp',
        'label' => 'ward gp',
        'rules' => 'trim|required|is_title_validation'
      ),      
      array(
        'field' => 'cp_one_pin_code',
        'label' => 'pin code',
        'rules' => 'trim|required|is_title_validation'
      ),      
      array(
        'field' => 'cp_one_police_station',
        'label' => 'police station',
        'rules' => 'trim|required|is_title_validation'
      ),

    );
    }elseif($minor_sent == 4){
      $config_two = array(
      array(
        'field' => 'case_no',
        'label' => 'Case No',
        'rules' => 'trim|required|alpha_numeric'
      ),
      array(
        'field' => 'case_date',
        'label' => 'Date',
        'rules' => 'trim|required'
      ),
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
        $data['cp_one_current_age'] = $this->Address_list_model->CP_One_Age($incident_id);
        $data['edit_cp_one_address'] = $this->Address_list_model->CP_One_Edit_Details($incident_id);
        $district = $data['edit_cp_one_address']->district;
        $data['Block_Details'] = $this->Master_model->get_block($district);
        $cp_one_gender = $data['edit_cp_one_address']->cp_one_gender;
        $data['CP_One_CWC_CCI'] = $this->Master_model->Get_Cp_One_CCI_Details($cp_one_gender, $district);
        $this->load->view($this->config->item('theme').'reporting/address/edit_cp_one_current_address_form_view', $data);
        // $this->load->view($this->config->item('theme').'reporting/address/add_cp_one_current_address_form_view', $data);
    } else {
        $this->db->trans_begin();
        $minor_details = $this->input->post('minor_details');
        if($this->input->post('minor_sent') == 1 || $this->input->post('minor_sent') == 3){
          $uploaded = array(
            'minor_sent' => $this->input->post('minor_sent'),
            'case_no' => NULL,
            'case_date' => NULL,
            'state' => 19,
            'district' => $this->input->post('district'),
            'block' => $this->input->post('block'),
            'cci_details' => NULL,
            'address' => $this->input->post('address'),
            'remarks' => $this->input->post('remarks'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR'],
            'minor_details' => empty($this->input->post('minor_details'))? NULL : $this->input->post('minor_details')
          );
            $uploaded['street_landmark'] =  $this->input->post('street_landmark');
            $uploaded['pin_code'] =  $this->input->post('cp_one_pin_code');
            $uploaded['ward_gp'] =  $this->input->post('ward_gp');
            $uploaded['police_station'] =  $this->input->post('cp_one_police_station');
        }elseif($this->input->post('minor_sent') == 4){
          $uploaded = array(
            'minor_sent' => $this->input->post('minor_sent'),
            'case_no' => $this->input->post('case_no'),
            'case_date' => $this->us_date_format($this->input->post('case_date')),
            'state' => 19,
            'district' => $this->input->post('district'),
            'block' => $this->input->post('block'),
            'cci_details' => $this->input->post('cci_details'),
            'address' => NULL,
            'remarks' => $this->input->post('remarks'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR'],
            'minor_details' => empty($this->input->post('minor_details'))? NULL : $this->input->post('minor_details')
          );

            // $uploaded['street_landmark'] =  $this->input->post('street_landmark');
            // $uploaded['pin_code'] =  $this->input->post('cp_one_pin_code');
            // $uploaded['ward_gp'] =  $this->input->post('ward_gp');
            // $uploaded['police_station'] =  $this->input->post('cp_one_police_station');

        }
        // echo'<pre>';print_r($uploaded);die;
        $result = $this->Address_list_model->update_cp_one_current_address_details($uploaded, $incident_id);
        if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'Address data successful updated.');
           redirect('admin/reporting/address/address_list');
        }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'Address data updation failed. Please try again.');
           redirect('admin/reporting/address/address_list');
        }
     }
  }

  public function edit_cp_two_current_address($incident_id)
  {
    $this->validate_login(array('2', '3', '4'));
    $incident_id = base64_decode($incident_id);
    $data['ward_gp_details'] = $this->Master_model->BDO_DEO_Get_Ward_GP($this->session->userdata('block'));
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $minor_sent = $this->input->post('minor_sent');
    $config_two = array();
    $config_one = array(
      array(
        'field' => 'minor_sent',
        'label' => 'Minor Sent to',
        'rules' => 'trim|required|numeric'
      ),
    );
    if($minor_sent == 1 || $minor_sent == 3){
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
      array(
        'field' => 'ward_gp',
        'label' => 'ward gp',
        'rules' => 'trim|required|is_title_validation'
      ),      
      array(
        'field' => 'cp_two_pin_code',
        'label' => 'pin code',
        'rules' => 'trim|required|is_title_validation'
      ),      
      array(
        'field' => 'cp_two_police_station',
        'label' => 'police station',
        'rules' => 'trim|required|is_title_validation'
      ),
    );
    }elseif($minor_sent == 4){
      $config_two = array(
      array(
        'field' => 'case_no',
        'label' => 'Case No',
        'rules' => 'trim|required|alpha_numeric'
      ),
      array(
        'field' => 'case_date',
        'label' => 'Date',
        'rules' => 'trim|required'
      ),
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
        $data['cp_two_current_age'] = $this->Address_list_model->CP_Two_Age($incident_id);
        $data['edit_cp_two_address'] = $this->Address_list_model->CP_Two_Edit_Details($incident_id);
        $district = $data['edit_cp_two_address']->district;
        $data['Block_Details'] = $this->Master_model->get_block($district);
        $cp_two_gender = $data['edit_cp_two_address']->cp_two_gender;
        $data['CP_Two_CWC_CCI'] = $this->Master_model->Get_Cp_One_CCI_Details($cp_two_gender, $district);
        $this->load->view($this->config->item('theme').'reporting/address/edit_cp_two_current_address_form_view', $data);
        // $this->load->view($this->config->item('theme').'reporting/address/add_cp_two_current_address_form_view', $data);
    } else {
        $this->db->trans_begin();
        $minor_details = $this->input->post('minor_details');
        if($this->input->post('minor_sent') == 1 || $this->input->post('minor_sent') == 3){
          $uploaded = array(
            'minor_sent' => $this->input->post('minor_sent'),
            'case_no' => NULL,
            'case_date' => NULL,
            'state' => 19,
            'district' => $this->input->post('district'),
            'block' => $this->input->post('block'),
            'cci_details' => NULL,
            'address' => $this->input->post('address'),
            'remarks' => $this->input->post('remarks'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR'],
            'minor_details' => empty($this->input->post('minor_details'))? NULL : $this->input->post('minor_details')
          );
        $uploaded['street_landmark'] =  $this->input->post('street_landmark');
        $uploaded['pin_code'] =  $this->input->post('cp_two_pin_code');
        $uploaded['ward_gp'] =  $this->input->post('ward_gp');
        $uploaded['police_station'] =  $this->input->post('cp_two_police_station');
        }elseif($this->input->post('minor_sent') == 4){
          $uploaded = array(
            'minor_sent' => $this->input->post('minor_sent'),
            'case_no' => $this->input->post('case_no'),
            'case_date' => $this->us_date_format($this->input->post('case_date')),
            'state' => 19,
            'district' => $this->input->post('district'),
            'block' => $this->input->post('block'),
            'cci_details' => $this->input->post('cci_details'),
            'address' => NULL,
            'remarks' => $this->input->post('remarks'),
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_ip' => $_SERVER['REMOTE_ADDR'],
            'minor_details' => empty($this->input->post('minor_details'))? NULL : $this->input->post('minor_details')
          );
        // $uploaded['street_landmark'] =  $this->input->post('street_landmark');
        // $uploaded['pin_code'] =  $this->input->post('cp_two_pin_code');
        // $uploaded['ward_gp'] =  $this->input->post('ward_gp');
        // $uploaded['police_station'] =  $this->input->post('cp_two_police_station');
        }
        $result = $this->Address_list_model->update_cp_two_current_address_details($uploaded, $incident_id);
        if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'Address data successful updated.');
           redirect('admin/reporting/address/address_list');
        }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'Address data updation failed. Please try again.');
           redirect('admin/reporting/address/address_list');
        }
     }
  }

  public function us_date_format($uk_date=NULL)
  {
    if($uk_date != NULL){
       $date_array = explode('/', $uk_date);
       return $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
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
