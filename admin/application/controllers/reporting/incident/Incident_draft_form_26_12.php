<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_draft_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->model('incident/incident_form_model');
    // $this->load->library('security');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->load->library('form_validation');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
    );

    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/fetch_district_block.js',
      3 => $this->config->item('theme_uri').'assets/js/hide_show.js',
      4 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      5 => $this->config->item('theme_uri').'assets/js/incident_form_validation.js',
      6 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }


  public function index() 
  {
    echo 123;die;
    $this->validate_login(array('4', '3', '2'));
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $anonymous = $this->input->post('anonymous');
    $cp_one_dob_document_available = $this->input->post('cp_one_dob_document_available');
    $cp_one_identity_document_available = $this->input->post('cp_one_identity_document_available');
    // $cp_one_cwc_minor_sent_to = $this->input->post('cp_one_cwc_minor_sent_to');
    $cp_two_dob_document_available = $this->input->post('cp_two_dob_document_available');
    $cp_two_identity_document_available = $this->input->post('cp_two_identity_document_available');
    // $cp_two_cwc_minor_sent_to = $this->input->post('cp_two_cwc_minor_sent_to');
    $cp_two_is_available = $this->input->post('cp_two_is_available');
    $cp_two_state = $this->input->post('cp_two_state');
    $cp_one_state = $this->input->post('cp_one_state');

    $config_two = array();
    $config_three = array();
    $config_four = array();
    // $config_five = array();
    // $config_six = array();
    $config_seven = array();
    $config_eight = array();
    // $config_nine = array();
    // $config_ten = array();
    $config_eleven = array();
    $config_twelve = array();
    $config_Thirteen = array();

    $config_one = array(
      array(
        'field' => 'incident_date',
        'label' => '<b>Incident Date</b>',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'street_landmark',
        'label' => '<b>Street / Landmark</b>',
        'rules' => 'trim|is_title_validation'
      ),
      array(
        'field' => 'ward_gp',
        'label' => '<b>Ward / GP</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'incident_district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'incident_block',
        'label' => '<b>Block / Municipality</b>',
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
        'field' => 'marriage_details',
        'label' => '<b>Marriage Details</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'prevented_details',
        'label' => '<b>Prevented Details</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'location_description',
        'label' => '<b>Description of location</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'anonymous',
        'label' => '<b>Anonymous</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'cp_one_f_name',
        'label' => '<b>First Name</b>',
        'rules' => 'trim|required|alpha'
      ),
      array(
        'field' => 'cp_one_m_name',
        'label' => '<b>Middle Name</b>',
        'rules' => 'trim|alpha'
      ),
      array(
        'field' => 'cp_one_l_name',
        'label' => '<b>Last Name</b>',
        'rules' => 'trim|required|alpha'
      ),
      array(
        'field' => 'cp_one_street_landmark',
        'label' => '<b>Street / Landmark</b>',
        'rules' => 'trim|is_title_validation'
      ),
      array(
        'field' => 'cp_one_state',
        'label' => '<b>State</b>',
        'rules' => 'trim|required|numeric'
      ),
      // array(
      //   'field' => 'cp_one_ward_gp',
      //   'label' => '<b>Ward / GP</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
      // array(
      //   'field' => 'cp_one_district',
      //   'label' => '<b>District</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
      // array(
      //   'field' => 'cp_one_block',
      //   'label' => '<b>SD/Block</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
      array(
        'field' => 'cp_one_pin_code',
        'label' => '<b>Pin Code</b>',
        'rules' => 'trim|required|max_length[6]|numeric'
      ),
      array(
        'field' => 'cp_one_police_station',
        'label' => '<b>Police Station</b>',
        'rules' => 'trim|required|is_title_validation'
      ),
      array(
        'field' => 'cp_one_phone_no',
        'label' => '<b>Phone No</b>',
        'rules' => 'trim|required|max_length[10]|numeric|is_phone_number_valid'
      ),
      array(
        'field' => 'cp_one_gender',
        'label' => '<b>Gender</b>',
        'rules' => 'trim|required|numeric'
      ),
      array(
        'field' => 'cp_one_social_category',
        'label' => '<b>Social Category</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'cp_one_religion',
        'label' => '<b>Religion</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'cp_one_dob',
        'label' => '<b>Date of Birth</b>',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'cp_one_dob_document_available',
        'label' => '<b>DOB document available</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'cp_one_identity_document_available',
        'label' => '<b>Identity document available</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'cp_one_highest_educational_attainment',
        'label' => '<b>Highest Educational Attainment</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'cp_one_father_name',
        'label' => '<b>Father Name</b>',
        'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
      ),
      array(
        'field' => 'cp_one_mother_name',
        'label' => '<b>Mother Name</b>',
        'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
      ),
      array(
        'field' => 'cp_one_father_mobile_no',
        'label' => '<b>Father Phone No</b>',
        'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
      ),
      array(
        'field' => 'cp_one_mother_mobile_no',
        'label' => '<b>Mother Phone No</b>',
        'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
      ),
      array(
        'field' => 'cp_one_father_id',
        'label' => '<b>Father ID</b>',
        'rules' => 'trim|alpha_numeric'
      ),
      array(
        'field' => 'cp_one_mother_id',
        'label' => '<b>Mother ID</b>',
        'rules' => 'trim|alpha_numeric'
      ),
      array(
        'field' => 'cp_one_father_id_type',
        'label' => '<b>Father ID Type</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'cp_one_mother_id_type',
        'label' => '<b>Mother ID Type</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'cp_one_father_alive',
        'label' => '<b>Father Alive</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'cp_one_mother_alive',
        'label' => '<b>Mother Alive</b>',
        'rules' => 'trim|numeric'
      ),
      array(
        'field' => 'cp_two_is_available',
        'label' => '<b>Is Available</b>',
        'rules' => 'trim|required|numeric'
      ),
    );
    
    if($anonymous == '2'){
      $config_two = array(
        array(
          'field' => 'identity_known_name',
          'label' => '<b>Identity known Name</b>',
          'rules' => 'trim|required|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
        ),
        array(
          'field' => 'identity_street_landmark',
          'label' => '<b>Street / Landmark</b>',
          'rules' => 'trim|is_title_validation'
        ),
        array(
          'field' => 'identity_ward_gp',
          'label' => '<b>Ward / GP</b>',
          'rules' => 'trim|required|numeric'
        ),
        array(
          'field' => 'identity_district',
          'label' => '<b>District</b>',
          'rules' => 'trim|required|numeric'
        ),
        array(
          'field' => 'identity_block',
          'label' => '<b>SD/Block</b>',
          'rules' => 'trim|required|numeric'
        ),
        array(
          'field' => 'identity_pin_code',
          'label' => '<b>Pin Code</b>',
          'rules' => 'trim|max_length[6]|numeric'
        ),
        array(
          'field' => 'identity_police_station',
          'label' => '<b>Police Station</b>',
          'rules' => 'trim|required|is_title_validation'
        ),
        array(
          'field' => 'identity_phone_no',
          'label' => '<b>Phone No</b>',
          'rules' => 'trim|required|max_length[10]|numeric|is_phone_number_valid'
        ),
        array(
          'field' => 'information_received',
          'label' => '<b>Information received</b>',
          'rules' => 'trim|required|numeric'
        ),
      );
    }

    if($cp_one_state == '1'){
      $config_Thirteen = array(
        array(
        'field' => 'cp_one_ward_gp',
        'label' => '<b>Ward / GP</b>',
        'rules' => 'trim|required|numeric'
        ),
        array(
          'field' => 'cp_one_district',
          'label' => '<b>District</b>',
          'rules' => 'trim|required|numeric'
        ),
        array(
          'field' => 'cp_one_block',
          'label' => '<b>SD/Block</b>',
          'rules' => 'trim|required|numeric'
        ),
      );
    }else{
      $config_Thirteen = array(
        array(
          'field' => 'cp_one_address',
          'label' => '<b>Address</b>',
          'rules' => 'trim|required|is_title_validation'
        ),
      );
    }

    if($cp_one_dob_document_available == '1'){
      $config_three = array(
        array(
          'field' => 'cp_one_dob_document_id',
          'label' => '<b>Document ID</b>',
          'rules' => 'trim|alpha_numeric'
        ),
        array(
          'field' => 'cp_one_dob_document_type',
          'label' => '<b>Document Type</b>',
          'rules' => 'trim|numeric'
        ),
      );
    }

    if($cp_one_identity_document_available == '1'){
      $config_four = array(
        array(
          'field' => 'cp_one_identity_document_id',
          'label' => '<b>Document ID</b>',
          'rules' => 'trim|alpha_numeric'
        ),
        array(
          'field' => 'cp_one_identity_document_type',
          'label' => '<b>Document Type</b>',
          'rules' => 'trim|numeric'
        ),
      );
    }

    if($cp_two_is_available == '1'){
      $config_eleven = array(
        array(
        'field' => 'cp_two_f_name',
        'label' => '<b>First Name</b>',
        'rules' => 'trim|required|alpha'
        ),
        array(
          'field' => 'cp_two_m_name',
          'label' => '<b>Middle Name</b>',
          'rules' => 'trim|alpha'
        ),
        array(
          'field' => 'cp_two_l_name',
          'label' => '<b>Last Name</b>',
          'rules' => 'trim|required|alpha'
        ),
        array(
          'field' => 'cp_two_street_landmark',
          'label' => '<b>Street / Landmark</b>',
          'rules' => 'trim|is_title_validation'
        ),
        array(
          'field' => 'cp_two_state',
          'label' => '<b>State</b>',
          'rules' => 'trim|required|numeric'
        ),
        // array(
        //   'field' => 'cp_two_district',
        //   'label' => '<b>District</b>',
        //   'rules' => 'trim|required|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_block',
        //   'label' => '<b>SD/Block</b>',
        //   'rules' => 'trim|required|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_ward_gp',
        //   'label' => '<b>Ward / GP</b>',
        //   'rules' => 'trim|required|numeric'
        // ),
        array(
          'field' => 'cp_two_pin_code',
          'label' => '<b>Pin Code</b>',
          'rules' => 'trim|required|max_length[6]|numeric'
        ),
        array(
          'field' => 'cp_two_police_station',
          'label' => '<b>Police Station</b>',
          'rules' => 'trim|required|is_title_validation'
        ),
        array(
          'field' => 'cp_two_phone_no',
          'label' => '<b>Phone No</b>',
          'rules' => 'trim|required|max_length[10]|numeric|is_phone_number_valid'
        ),
        array(
          'field' => 'cp_two_gender',
          'label' => '<b>Gender</b>',
          'rules' => 'trim|required|numeric'
        ),
        array(
          'field' => 'cp_two_social_category',
          'label' => '<b>Social Category</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'cp_two_religion',
          'label' => '<b>Religion</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'cp_two_dob',
          'label' => '<b>Date of Birth</b>',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'cp_two_dob_document_available',
          'label' => '<b>DOB document available</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'cp_two_identity_document_available',
          'label' => '<b>Identity document available</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'cp_two_highest_educational_attainment',
          'label' => '<b>Highest Educational Attainment</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'cp_two_father_name',
          'label' => '<b>Father Name</b>',
          'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
        ),
        array(
          'field' => 'cp_two_mother_name',
          'label' => '<b>Mother Name</b>',
          'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
        ),
        array(
          'field' => 'cp_two_father_mobile_no',
          'label' => '<b>Father Phone No</b>',
          'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
        ),
        array(
          'field' => 'cp_two_mother_mobile_no',
          'label' => '<b>Mother Phone No</b>',
          'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
        ),
        array(
          'field' => 'cp_two_father_id',
          'label' => '<b>Father ID</b>',
          'rules' => 'trim|alpha_numeric'
        ),
        array(
          'field' => 'cp_two_mother_id',
          'label' => '<b>Mother ID</b>',
          'rules' => 'trim|alpha_numeric'
        ),
        array(
          'field' => 'cp_two_father_id_type',
          'label' => '<b>Father ID Type</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'cp_two_mother_id_type',
          'label' => '<b>Mother ID Type</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'cp_two_father_alive',
          'label' => '<b>Father Alive</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'cp_two_mother_alive',
          'label' => '<b>Mother Alive</b>',
          'rules' => 'trim|numeric'
        ),
      );
      
      if($cp_two_state == '1'){
        $config_twelve = array(
          array(
          'field' => 'cp_two_district',
          'label' => '<b>District</b>',
          'rules' => 'trim|required|numeric'
          ),
          array(
            'field' => 'cp_two_block',
            'label' => '<b>SD/Block</b>',
            'rules' => 'trim|required|numeric'
          ),
          array(
            'field' => 'cp_two_ward_gp',
            'label' => '<b>Ward / GP</b>',
            'rules' => 'trim|required|numeric'
          ),
        );
      }else{
        $config_twelve = array(
          array(
          'field' => 'cp_two_address',
          'label' => '<b>Address</b>',
          'rules' => 'trim|required|is_title_validation'
          ),
        );
      }

      if($cp_two_dob_document_available == '1'){
        $config_seven = array(
          array(
            'field' => 'cp_two_dob_document_id',
            'label' => '<b>Document ID</b>',
            'rules' => 'trim|alpha_numeric'
          ),
          array(
            'field' => 'cp_two_dob_document_type',
            'label' => '<b>Document Type</b>',
            'rules' => 'trim|numeric'
          ),
        );
      }

      if($cp_two_identity_document_available == '1'){
        $config_eight = array(
          array(
            'field' => 'cp_two_identity_document_id',
            'label' => '<b>Document ID</b>',
            'rules' => 'trim|alpha_numeric'
          ),
          array(
            'field' => 'cp_two_identity_document_type',
            'label' => '<b>Document Type</b>',
            'rules' => 'trim|numeric'
          ),
        );
      }
    }
    
    $config = array_merge($config_one, $config_two, $config_three, $config_four, $config_seven, $config_eight, $config_eleven, $config_twelve, $config_Thirteen);
    $this->form_validation->set_rules($config);
    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['state'] = $this->Master_model->get_state_name();
    $data['districts'] = $this->Master_model->get_district();
    $data['districts_name'] = $this->Master_model->get_district_name($this->session->userdata('district'));
    $data['block_name'] = $this->Master_model->get_block_name($this->session->userdata('block'));
    $data['block_details_name'] = $this->Master_model->get_block($this->session->userdata('district'));
    // $incident_block = $this->input->post('incident_block');
    $incident_block = ($this->input->post('incident_block'))?$this->input->post('incident_block'):NULL;
    $data['Incident_Ward_Gp_Block'] = $Incident_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($incident_block);
    if(!empty($Incident_Ward_Gp_Block)){
      if($Incident_Ward_Gp_Block->rural_urban == 'U'){
        $data['Incident_Ward'] = $this->Master_model->get_ward($incident_block);
      }else{
        $data['Incident_Gp'] = $this->Master_model->get_gp($incident_block);
      }
      $data['sdo_deo_level_block_name'] = $this->Master_model->get_sdo_deo_level_block($this->session->userdata('subdiv'));
    $data['ward_gp_details'] = $this->Master_model->BDO_DEO_Get_Ward_GP($this->session->userdata('block'));
    $data['marriage_details'] = $this->Master_model->get_marriage_details();
    $data['prevented_details'] = $this->Master_model->get_prevented_details();
    $data['location_description_details'] = $this->Master_model->get_location_description_details();
    $data['information_received_details'] = $this->Master_model->get_information_received_details();
    $data['gender_details'] = $this->Master_model->get_gender_details();
    $data['social_category_details'] = $this->Master_model->get_social_category_details();
    $data['religion_details'] = $this->Master_model->get_religion_details();
    $data['document_type_details'] = $this->Master_model->get_document_type_details();
    $data['highest_education_details'] = $this->Master_model->get_highest_education_details();
    $data['minor_details'] = $this->Master_model->get_minor_details();
    $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
    $incident_district = $this->input->post('incident_district');
    $data['incidentBlock'] = $this->Master_model->get_block($incident_district);
    $identity_district = $this->input->post('identity_district');
    $data['identityBlock'] = $this->Master_model->get_block($identity_district);
    // $identity_block = $this->input->post('identity_block');
    $identity_block = ($this->input->post('identity_block'))?$this->input->post('identity_block'):NULL;
    $data['Identity_Ward_Gp_Block'] = $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($identity_block);
    if(!empty($Identity_Ward_Gp_Block)){
      if($Identity_Ward_Gp_Block->rural_urban == 'U'){
        $data['Identity_Ward'] = $this->Master_model->get_ward($identity_block);
      }else{
        $data['Identity_Gp'] = $this->Master_model->get_gp($identity_block);
      }
    }

    $cp_one_state = $this->input->post('cp_one_state');
    $data['CP_One_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_one_state);

    $cp_one_district = $this->input->post('cp_one_district');
    $data['cponeBlock'] = $this->Master_model->get_block($cp_one_district);
    // $cp_one_block = $this->input->post('cp_one_block');
    $cp_one_block = ($this->input->post('cp_one_block'))?$this->input->post('cp_one_block'):NULL;
    $data['Cp_One_Ward_Gp_Block'] = $Cp_One_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($cp_one_block);
    if(!empty($Cp_One_Ward_Gp_Block)){
      if($Cp_One_Ward_Gp_Block->rural_urban == 'U'){
        $data['Cp_One_Ward'] = $this->Master_model->get_ward($cp_one_block);
      }else{
        $data['Cp_One_Gp'] = $this->Master_model->get_gp($cp_one_block);
      }
    }
    $cp_one_cwc_district = $this->input->post('cp_one_cwc_district');
    $data['cponecwcBlock'] = $this->Master_model->get_block($cp_one_cwc_district);

    $cp_two_state = $this->input->post('cp_two_state');
    $data['CP_Two_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_two_state);

    $cp_two_district = $this->input->post('cp_two_district');
    $data['cptwoBlock'] = $this->Master_model->get_block($cp_two_district);
    // $cp_two_block = $this->input->post('cp_two_block');
    $cp_two_block = ($this->input->post('cp_two_block'))?$this->input->post('cp_two_block'):NULL;
    $data['Cp_Two_Ward_Gp_Block'] = $Cp_Two_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($cp_two_block);
    if(!empty($Cp_Two_Ward_Gp_Block)){
      if($Cp_Two_Ward_Gp_Block->rural_urban == 'U'){
        $data['Cp_Two_Ward'] = $this->Master_model->get_ward($cp_two_block);
      }else{
        $data['Cp_Two_Gp'] = $this->Master_model->get_gp($cp_two_block);
      }
    }
    $cp_two_cwc_district = $this->input->post('cp_two_cwc_district');
    $data['cptwocwcBlock'] = $this->Master_model->get_block($cp_two_cwc_district);
    $police_case_district = $this->input->post('police_case_district');
    $data['policecaseBlock'] = $this->Master_model->get_block($police_case_district);
    $data['validation_error_count'] = '';
    if(strtoupper($this->input->server("REQUEST_METHOD") == strtoupper('POST'))){
      if($this->form_validation->run() == TRUE) {
          $data['validation_error_count'] = "0";
      }else{
          $error_count = count($this->form_validation->error_array());
          $data['validation_error_count'] = ($error_count)? $error_count: '';
      }
    }
    $this->load->view($this->config->item('theme').'reporting/incident/incident_draft_form_view',$data);
  }



  }

  public function save_incident_details()
  {
    if($this->input->post('is_save') == "YES"){
        if($this->session->userdata('stake_id_fk') == '4' || $this->session->userdata('stake_id_fk') == '2'){
          if($this->session->userdata('block') == '0'){
            $stake_block = $this->session->userdata('subdiv');
          }else{
            $stake_block = $this->session->userdata('block');
          }
        }elseif($this->session->userdata('stake_id_fk') == '3'){
          $stake_block = $this->session->userdata('district');
        }

        $this->db->trans_begin();

        $max_child_id = $this->incident_form_model->get_max_child_id($stake_block,date('y'));

        $result = $this->incident_form_model->insert_incident_reporting_details($max_child_id);
  
        if($result == 0)
        {
          $this->db->trans_commit();
          $this->session->set_flashdata('success', 'Incident report data successfully added.');
        }
        else
        {
          $this->db->trans_rollback();
          $this->session->set_flashdata('warning', 'Incident report data addition failed. Please try again.');
          redirect('admin/reporting/incident/incident_form');
        }
      }
  }
  



}

?>