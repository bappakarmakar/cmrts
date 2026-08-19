<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_form extends NIC_Controller {
  
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

    $incident_block =$this->input->post('incident_block');


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

     // $incident_block =$this->input->post('incident_block');

    $config_cp_age = array();
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
        'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('incident_block') . ']'
      ),
      array(
        'field' => 'incident_district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
      ),
      array(
        'field' => 'incident_block',
        'label' => '<b>Block / Municipality</b>',
        'rules' => 'trim|required|numeric|max_length[4]|callback_validate_block'
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
        // 'rules' => 'trim|required|numeric|max_length[1]|is_not_unique[rp_location_master_state.state_id_pk]'
        'rules' => 'trim|required|numeric|max_length[1]|callback_validate_state'
      ),
      array(
        'field' => 'cp_one_ward_gp',
        'label' => '<b>Ward / GP</b>',
        'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('cp_one_ward_gp'). ']'
      ),
      array(
        'field' => 'cp_one_district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
      ),
      array(
        'field' => 'cp_one_block',
        'label' => '<b>SD/Block</b>',
        'rules' => 'trim|required|numeric|callback_validate_block'
      ),
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
          'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('identity_block'). ']'
        ),
        array(
          'field' => 'identity_district',
          'label' => '<b>District</b>',
          'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
        ),
        array(
          'field' => 'identity_block',
          'label' => '<b>SD/Block</b>',
          'rules' => 'trim|required|numeric|callback_validate_block'
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
         'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('cp_one_block') . ']'
        ),
        array(
          'field' => 'cp_one_district',
          'label' => '<b>District</b>',
          'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
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

    if($cp_two_is_available != '2'){
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
          'rules' => 'trim|required|numeric|max_length[1]|callback_validate_state'
        ),
        array(
          'field' => 'cp_two_district',
          'label' => '<b>District</b>',
          'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
        ),
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
          'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
          ),
          array(
            'field' => 'cp_two_block',
            'label' => '<b>SD/Block</b>',
            'rules' => 'trim|required|numeric'
          ),
          array(
            'field' => 'cp_two_ward_gp',
            'label' => '<b>Ward / GP</b>',
            'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('cp_two_block') . ']'
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

    if($cp_two_is_available ==''|| $cp_two_is_available =='2')
    {
      $config_cp_age = array(
      array(
          'field' => 'cp_one_age',
          'label' => '<b>Age</b>',
          'rules' => 'trim|required|callback_check_cp1_age'
        )
        );
    }
    else if($cp_two_is_available =='1')
    {
      $config_cp_age = array(
      array(
          'field' => 'cp_one_age',
          'label' => '<b>Age</b>',
          'rules' => 'trim|required|callback_validate_below_either_18'
        ), 
      array(
          'field' => 'cp_two_age',
          'label' => '<b>Age</b>',
          'rules' => 'trim|required|callback_validate_below_either_18'
        )
      );
    }
    
    $config = array_merge($config_one, $config_two, $config_three, $config_four, $config_seven, $config_eight, $config_eleven, $config_twelve, $config_Thirteen,$config_cp_age);
    $this->form_validation->set_rules($config);
    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['state'] = $this->Master_model->get_state_name();
    $data['districts'] = $this->Master_model->get_district();
    $data['districts_name'] = $this->Master_model->get_district_name($this->session->userdata('district'));
    $data['block_name'] = $this->Master_model->get_block_name($this->session->userdata('block'));
    // echo $this->session->userdata('block');die;
    // print_r($data['block_name']);die;
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
    $data['identityBlock'] = ($this->Master_model->get_block($identity_district))?$this->Master_model->get_block($identity_district):array();
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
    if($this->input->post('cp_one_state')!='')
    {
      $cp_one_state = $this->input->post('cp_one_state');
      $data['CP_One_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_one_state);
    }
    else
    {
      $data['CP_One_District_Details'] = array();
    }
    // print_r($data['CP_One_District_Details']);die;

    if($this->input->post('cp_one_district')!='')
    {
      $cp_one_district = $this->input->post('cp_one_district');
      $data['cponeBlock'] = $this->Master_model->get_block($cp_one_district);
    }
    else
    {
      $data['cponeBlock'] = array();
    }
    // $cp_one_district = $this->input->post('cp_one_district');
    // $data['cponeBlock'] = $this->Master_model->get_block($cp_one_district);
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

    if($this->input->post('cp_two_state')!='')
    {
      $cp_two_state = $this->input->post('cp_two_state');
      $data['CP_Two_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_two_state);
    }
    else
    {
       $data['CP_Two_District_Details'] = array();
    }
    if($this->input->post('cp_two_district')!='')
    {
      $cp_two_district = $this->input->post('cp_two_district');
      $data['cptwoBlock'] = $this->Master_model->get_block($cp_two_district);
    }
    else
    {
      $data['cptwoBlock'] = array();
    }
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
          // echo"<pre>";print_r($this->form_validation->error_array());die;
          $data['validation_error_count'] = ($error_count)? $error_count: '';
      }
    }
    $this->load->view($this->config->item('theme').'reporting/incident/incident_form_view',$data);
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
  
  public function save_as_draft()
  {
      if($this->input->post('is_save_as_draft') == "YES"){
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
            'rules' => 'trim'
          ),
          array(
            'field' => 'street_landmark',
            'label' => '<b>Street / Landmark</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'ward_gp',
            'label' => '<b>Ward / GP</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'incident_district',
            'label' => '<b>District</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'incident_block',
            'label' => '<b>Block / Municipality</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'pin_code',
            'label' => '<b>Pin Code</b>',
            'rules' => 'trim|max_length[6]|numeric'
          ),
          array(
            'field' => 'police_station',
            'label' => '<b>Police Station</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'marriage_details',
            'label' => '<b>Marriage Details</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'prevented_details',
            'label' => '<b>Prevented Details</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'location_description',
            'label' => '<b>Description of location</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'anonymous',
            'label' => '<b>Anonymous</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'cp_one_f_name',
            'label' => '<b>First Name</b>',
            'rules' => 'trim|alpha'
          ),
          array(
            'field' => 'cp_one_m_name',
            'label' => '<b>Middle Name</b>',
            'rules' => 'trim|alpha'
          ),
          array(
            'field' => 'cp_one_l_name',
            'label' => '<b>Last Name</b>',
            'rules' => 'trim|alpha'
          ),
          array(
            'field' => 'cp_one_street_landmark',
            'label' => '<b>Street / Landmark</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'cp_one_state',
            'label' => '<b>State</b>',
            'rules' => 'trim|numeric'
          ),
          // array(
          //   'field' => 'cp_one_ward_gp',
          //   'label' => '<b>Ward / GP</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_one_district',
          //   'label' => '<b>District</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_one_block',
          //   'label' => '<b>SD/Block</b>',
          //   'rules' => 'trim|numeric'
          // ),
          array(
            'field' => 'cp_one_pin_code',
            'label' => '<b>Pin Code</b>',
            'rules' => 'trim|max_length[6]|numeric'
          ),
          array(
            'field' => 'cp_one_police_station',
            'label' => '<b>Police Station</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'cp_one_phone_no',
            'label' => '<b>Phone No</b>',
            'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
          ),
          array(
            'field' => 'cp_one_gender',
            'label' => '<b>Gender</b>',
            'rules' => 'trim|numeric'
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
            'rules' => 'trim'
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
          // array(
          //   'field' => 'cp_one_cwc_minor_sent_to',
          //   'label' => '<b>Minor Sent to</b>',
          //   'rules' => 'trim|numeric'
          // ),
          array(
            'field' => 'cp_two_is_available',
            'label' => '<b>Is Available</b>',
            'rules' => 'trim|numeric'
          ),
          // array(
          //   'field' => 'cp_two_f_name',
          //   'label' => '<b>First Name</b>',
          //   'rules' => 'trim|alpha'
          // ),
          // array(
          //   'field' => 'cp_two_m_name',
          //   'label' => '<b>Middle Name</b>',
          //   'rules' => 'trim|alpha'
          // ),
          // array(
          //   'field' => 'cp_two_l_name',
          //   'label' => '<b>Last Name</b>',
          //   'rules' => 'trim|alpha'
          // ),
          // array(
          //   'field' => 'cp_two_street_landmark',
          //   'label' => '<b>Street / Landmark</b>',
          //   'rules' => 'trim|is_title_validation'
          // ),
          // array(
          //   'field' => 'cp_two_ward_gp',
          //   'label' => '<b>Ward / GP</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_district',
          //   'label' => '<b>District</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_block',
          //   'label' => '<b>SD/Block</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_pin_code',
          //   'label' => '<b>Pin Code</b>',
          //   'rules' => 'trim|max_length[6]|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_police_station',
          //   'label' => '<b>Police Station</b>',
          //   'rules' => 'trim|is_title_validation'
          // ),
          // array(
          //   'field' => 'cp_two_phone_no',
          //   'label' => '<b>Phone No</b>',
          //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
          // ),
          // array(
          //   'field' => 'cp_two_gender',
          //   'label' => '<b>Gender</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_social_category',
          //   'label' => '<b>Social Category</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_religion',
          //   'label' => '<b>Religion</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_dob',
          //   'label' => '<b>Date of Birth</b>',
          //   'rules' => 'trim'
          // ),
          // array(
          //   'field' => 'cp_two_dob_document_available',
          //   'label' => '<b>DOB document available</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_identity_document_available',
          //   'label' => '<b>Identity document available</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_highest_educational_attainment',
          //   'label' => '<b>Highest Educational Attainment</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_father_name',
          //   'label' => '<b>Father Name</b>',
          //   'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
          // ),
          // array(
          //   'field' => 'cp_two_mother_name',
          //   'label' => '<b>Mother Name</b>',
          //   'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
          // ),
          // array(
          //   'field' => 'cp_two_father_mobile_no',
          //   'label' => '<b>Father Phone No</b>',
          //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
          // ),
          // array(
          //   'field' => 'cp_two_mother_mobile_no',
          //   'label' => '<b>Mother Phone No</b>',
          //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
          // ),
          // array(
          //   'field' => 'cp_two_father_id',
          //   'label' => '<b>Father ID</b>',
          //   'rules' => 'trim|alpha_numeric'
          // ),
          // array(
          //   'field' => 'cp_two_mother_id',
          //   'label' => '<b>Mother ID</b>',
          //   'rules' => 'trim|alpha_numeric'
          // ),
          // array(
          //   'field' => 'cp_two_father_id_type',
          //   'label' => '<b>Father ID Type</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_mother_id_type',
          //   'label' => '<b>Mother ID Type</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_father_alive',
          //   'label' => '<b>Father Alive</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_mother_alive',
          //   'label' => '<b>Mother Alive</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_cwc_minor_sent_to',
          //   'label' => '<b>Minor Sent to</b>',
          //   'rules' => 'trim|numeric'
          // ),
        );

        if($anonymous == '2'){
          $config_two = array(
            array(
              'field' => 'identity_known_name',
              'label' => '<b>Identity known Name</b>',
              'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
            ),
            array(
              'field' => 'identity_street_landmark',
              'label' => '<b>Street / Landmark</b>',
              'rules' => 'trim|is_title_validation'
            ),
            array(
            'field' => 'identity_ward_gp',
            'label' => '<b>Ward / GP</b>',
            'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('identity_block'). ']'
            ),
            array(
              'field' => 'identity_district',
              'label' => '<b>District</b>',
              'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
            ),
            array(
              'field' => 'identity_block',
              'label' => '<b>SD/Block</b>',
              'rules' => 'trim|required|numeric|callback_validate_block'
            ),
            array(
              'field' => 'identity_pin_code',
              'label' => '<b>Pin Code</b>',
              'rules' => 'trim|max_length[6]|numeric'
            ),
            array(
              'field' => 'identity_police_station',
              'label' => '<b>Police Station</b>',
              'rules' => 'trim|is_title_validation'
            ),
            array(
              'field' => 'identity_phone_no',
              'label' => '<b>Phone No</b>',
              'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
            ),
            array(
              'field' => 'information_received',
              'label' => '<b>Information received</b>',
              'rules' => 'trim|numeric'
            ),
          );
        }

        if($cp_one_state == '1'){
          $config_Thirteen = array(
            array(
              'field' => 'cp_one_ward_gp',
              'label' => '<b>Ward / GP</b>',
              'rules' => 'trim|numeric'
            ),
            array(
              'field' => 'cp_one_district',
              'label' => '<b>District</b>',
              'rules' => 'trim|numeric'
            ),
            array(
              'field' => 'cp_one_block',
              'label' => '<b>SD/Block</b>',
              'rules' => 'trim|numeric'
            ),
          );
        }else{
          $config_Thirteen = array(
            array(
              'field' => 'cp_one_address',
              'label' => '<b>Address</b>',
              'rules' => 'trim|is_title_validation'
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

        // if($cp_one_cwc_minor_sent_to == '1' || $cp_one_cwc_minor_sent_to == '2' || $cp_one_cwc_minor_sent_to == '3'){
        //   $config_five = array(
        //     array(
        //       'field' => 'cp_one_cwc_district',
        //       'label' => '<b>District</b>',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_one_cwc_block',
        //       'label' => '<b>SD/Block</b>',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_one_cwc_address',
        //       'label' => '<b>Address</b>',
        //       'rules' => 'trim|is_title_validation'
        //     ),
        //     array(
        //       'field' => 'cp_one_cwc_remarks',
        //       'label' => '<b>Remarks</b>',
        //       'rules' => 'trim|is_script_validate'
        //     ),
        //   );
        // }

        // if($cp_one_cwc_minor_sent_to == '4'){
        //   $config_six = array(
        //     array(
        //       'field' => 'cp_one_cwc_case_no',
        //       'label' => '<b>Case No</b>',
        //       'rules' => 'trim|alpha_numeric'
        //     ),
        //     array(
        //       'field' => 'cp_one_cwc_case_date',
        //       'label' => '<b>Date</b>',
        //       'rules' => 'trim'
        //     ),
        //     array(
        //       'field' => 'cp_one_cwc_district',
        //       'label' => '<b>District</b>',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_one_cwc_block',
        //       'label' => '<b>SD/Block</b>',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_one_cwc_cci',
        //       'label' => '<b>CCI</b>',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_one_cwc_remarks',
        //       'label' => '<b>Remarks</b>',
        //       'rules' => 'trim|is_script_validate'
        //     ),
        //   );
        // }

        if($cp_two_is_available == '1'){
          $config_eleven = array(
            array(
            'field' => 'cp_two_f_name',
            'label' => '<b>First Name</b>',
            'rules' => 'trim|alpha'
            ),
            array(
              'field' => 'cp_two_m_name',
              'label' => '<b>Middle Name</b>',
              'rules' => 'trim|alpha'
            ),
            array(
              'field' => 'cp_two_l_name',
              'label' => '<b>Last Name</b>',
              'rules' => 'trim|alpha'
            ),
            array(
              'field' => 'cp_two_street_landmark',
              'label' => '<b>Street / Landmark</b>',
              'rules' => 'trim|is_title_validation'
            ),
            array(
              'field' => 'cp_two_state',
              'label' => '<b>State</b>',
              'rules' => 'trim|numeric'
            ),
            // array(
            //   'field' => 'cp_two_district',
            //   'label' => '<b>District</b>',
            //   'rules' => 'trim|numeric'
            // ),
            // array(
            //   'field' => 'cp_two_block',
            //   'label' => '<b>SD/Block</b>',
            //   'rules' => 'trim|numeric'
            // ),
            // array(
            //   'field' => 'cp_two_ward_gp',
            //   'label' => '<b>Ward / GP</b>',
            //   'rules' => 'trim|numeric'
            // ),
            array(
              'field' => 'cp_two_pin_code',
              'label' => '<b>Pin Code</b>',
              'rules' => 'trim|max_length[6]|numeric'
            ),
            array(
              'field' => 'cp_two_police_station',
              'label' => '<b>Police Station</b>',
              'rules' => 'trim|is_title_validation'
            ),
            array(
              'field' => 'cp_two_phone_no',
              'label' => '<b>Phone No</b>',
              'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
            ),
            array(
              'field' => 'cp_two_gender',
              'label' => '<b>Gender</b>',
              'rules' => 'trim|numeric'
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
              'rules' => 'trim'
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
            // array(
            //   'field' => 'cp_two_cwc_minor_sent_to',
            //   'label' => '<b>Minor Sent to</b>',
            //   'rules' => 'trim|numeric'
            // ),
          );
          
          if($cp_two_state == '1'){
            $config_twelve = array(
              array(
              'field' => 'cp_two_district',
              'label' => '<b>District</b>',
              'rules' => 'trim|numeric'
              ),
              array(
                'field' => 'cp_two_block',
                'label' => '<b>SD/Block</b>',
                'rules' => 'trim|numeric'
              ),
              array(
                'field' => 'cp_two_ward_gp',
                'label' => '<b>Ward / GP</b>',
                'rules' => 'trim|numeric'
              ),
            );
          }else{
            $config_twelve = array(
              array(
              'field' => 'cp_two_address',
              'label' => '<b>Address</b>',
              'rules' => 'trim|is_title_validation'
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

          // if($cp_two_cwc_minor_sent_to == '1' || $cp_two_cwc_minor_sent_to == '2' || $cp_two_cwc_minor_sent_to == '3'){
          //   $config_nine = array(
          //     array(
          //       'field' => 'cp_two_cwc_district',
          //       'label' => '<b>District</b>',
          //       'rules' => 'trim|numeric'
          //     ),
          //     array(
          //       'field' => 'cp_two_cwc_block',
          //       'label' => '<b>SD/Block</b>',
          //       'rules' => 'trim|numeric'
          //     ),
          //     array(
          //       'field' => 'cp_two_cwc_address',
          //       'label' => '<b>Address</b>',
          //       'rules' => 'trim|is_title_validation'
          //     ),
          //     array(
          //       'field' => 'cp_two_cwc_remarks',
          //       'label' => '<b>Remarks</b>',
          //       'rules' => 'trim|is_script_validate'
          //     ),
          //   );
          // }

          // if($cp_two_cwc_minor_sent_to == '4'){
          //   $config_ten = array(
          //     array(
          //       'field' => 'cp_two_cwc_case_no',
          //       'label' => '<b>Case No</b>',
          //       'rules' => 'trim|alpha_numeric'
          //     ),
          //     array(
          //       'field' => 'cp_two_cwc_case_date',
          //       'label' => '<b>Date</b>',
          //       'rules' => 'trim'
          //     ),
          //     array(
          //       'field' => 'cp_two_cwc_district',
          //       'label' => '<b>District</b>',
          //       'rules' => 'trim|numeric'
          //     ),
          //     array(
          //       'field' => 'cp_two_cwc_block',
          //       'label' => '<b>SD/Block</b>',
          //       'rules' => 'trim|numeric'
          //     ),
          //     array(
          //       'field' => 'cp_two_cwc_cci',
          //       'label' => '<b>CCI',
          //       'rules' => 'trim|numeric'
          //     ),
          //     array(
          //       'field' => 'cp_two_cwc_remarks',
          //       'label' => '<b>Remarks</b>',
          //       'rules' => 'trim|is_script_validate'
          //     ),
          //   );
          // }
        }


        
        $config = array_merge($config_one, $config_two, $config_three, $config_four, $config_seven, $config_eight, $config_eleven, $config_twelve, $config_Thirteen);
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == TRUE) {
            $data['error'] = TRUE;
            $data['input_field_error'] = '';
            echo json_encode($data);
            $this->db->trans_begin();
            if($this->session->userdata('stake_id_fk') == '4' || $this->session->userdata('stake_id_fk') == '2'){
              if($this->session->userdata('block') == '0'){
                $stake_block = $this->session->userdata('subdiv');
              }else{
                $stake_block = $this->session->userdata('block');
              }
            }elseif($this->session->userdata('stake_id_fk') == '3'){
              $stake_block = $this->session->userdata('district');
            }
            $max_child_id = $this->incident_form_model->get_max_child_id($stake_block,date('y'));
            $result = $this->incident_form_model->insert_draft_incident_reporting_details_first($max_child_id);
            if($result == 0){
              $this->db->trans_commit();
              $this->session->set_flashdata('success', 'Incident report draft data successfully added.');
            }else{
              $this->db->trans_rollback();
              $this->session->set_flashdata('warning', 'Incident report data addition failed. Please try again.');
              redirect('admin/reporting/incident/incident_form');
            }
        }else{
          $data['error'] = FALSE;
          // $data['input_field_error']['pin_code'] = form_error('pin_code');
          // $data['input_field_error']['ward_gp'] = form_error('ward_gp');
          // $data['input_field_error'] = validation_errors();
          echo json_encode($data);

        }
      }elseif($this->input->post('is_save_as_draft') == "NO"){
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
            'rules' => 'trim'
          ),
          array(
            'field' => 'street_landmark',
            'label' => '<b>Street / Landmark</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'ward_gp',
            'label' => '<b>Ward / GP</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'incident_district',
            'label' => '<b>District</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'incident_block',
            'label' => '<b>Block / Municipality</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'pin_code',
            'label' => '<b>Pin Code</b>',
            'rules' => 'trim|max_length[6]|numeric'
          ),
          array(
            'field' => 'police_station',
            'label' => '<b>Police Station</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'marriage_details',
            'label' => '<b>Marriage Details</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'prevented_details',
            'label' => '<b>Prevented Details</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'location_description',
            'label' => '<b>Description of location</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'anonymous',
            'label' => '<b>Anonymous</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'cp_one_f_name',
            'label' => '<b>First Name</b>',
            'rules' => 'trim|alpha'
          ),
          array(
            'field' => 'cp_one_m_name',
            'label' => '<b>Middle Name</b>',
            'rules' => 'trim|alpha'
          ),
          array(
            'field' => 'cp_one_l_name',
            'label' => '<b>Last Name</b>',
            'rules' => 'trim|alpha'
          ),
          array(
            'field' => 'cp_one_street_landmark',
            'label' => '<b>Street / Landmark</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'cp_one_state',
            'label' => '<b>State</b>',
            'rules' => 'trim|numeric'
          ),
          // array(
          //   'field' => 'cp_one_ward_gp',
          //   'label' => '<b>Ward / GP</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_one_district',
          //   'label' => '<b>District</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_one_block',
          //   'label' => '<b>SD/Block</b>',
          //   'rules' => 'trim|numeric'
          // ),
          array(
            'field' => 'cp_one_ward_gp',
            'label' => '<b>Ward / GP</b>',
            'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('cp_one_ward_gp'). ']'
          ),
          array(
            'field' => 'cp_one_district',
            'label' => '<b>District</b>',
            'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
          ),
          array(
            'field' => 'cp_one_block',
            'label' => '<b>SD/Block</b>',
            'rules' => 'trim|required|numeric|callback_validate_block'
          ),
          array(
            'field' => 'cp_one_pin_code',
            'label' => '<b>Pin Code</b>',
            'rules' => 'trim|max_length[6]|numeric'
          ),
          array(
            'field' => 'cp_one_police_station',
            'label' => '<b>Police Station</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'cp_one_phone_no',
            'label' => '<b>Phone No</b>',
            'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
          ),
          array(
            'field' => 'cp_one_gender',
            'label' => '<b>Gender</b>',
            'rules' => 'trim|numeric'
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
            'rules' => 'trim'
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
            'rules' => 'trim|numeric'
          ),
        );

        if($anonymous == '2'){
          $config_two = array(
            array(
              'field' => 'identity_known_name',
              'label' => '<b>Identity known Name</b>',
              'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
            ),
            array(
              'field' => 'identity_street_landmark',
              'label' => '<b>Street / Landmark</b>',
              'rules' => 'trim|is_title_validation'
            ),
            array(
              'field' => 'identity_ward_gp',
              'label' => '<b>Ward / GP</b>',
              'rules' => 'trim|numeric'
            ),
            array(
              'field' => 'identity_district',
              'label' => '<b>District</b>',
              'rules' => 'trim|numeric'
            ),
            array(
              'field' => 'identity_block',
              'label' => '<b>SD/Block</b>',
              'rules' => 'trim|numeric'
            ),
            array(
              'field' => 'identity_pin_code',
              'label' => '<b>Pin Code</b>',
              'rules' => 'trim|max_length[6]|numeric'
            ),
            array(
              'field' => 'identity_police_station',
              'label' => '<b>Police Station</b>',
              'rules' => 'trim|is_title_validation'
            ),
            array(
              'field' => 'identity_phone_no',
              'label' => '<b>Phone No</b>',
              'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
            ),
            array(
              'field' => 'information_received',
              'label' => '<b>Information received</b>',
              'rules' => 'trim|numeric'
            ),
          );
        }

        if($cp_one_state == '1'){
          $config_Thirteen = array(
            array(
              'field' => 'cp_one_ward_gp',
              'label' => '<b>Ward / GP</b>',
              'rules' => 'trim|numeric'
            ),
            array(
              'field' => 'cp_one_district',
              'label' => '<b>District</b>',
              'rules' => 'trim|numeric'
            ),
            array(
              'field' => 'cp_one_block',
              'label' => '<b>SD/Block</b>',
              'rules' => 'trim|numeric'
            ),
          );
        }else{
          $config_Thirteen = array(
            array(
              'field' => 'cp_one_address',
              'label' => '<b>Address</b>',
              'rules' => 'trim|is_title_validation'
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
            'rules' => 'trim|alpha'
            ),
            array(
              'field' => 'cp_two_m_name',
              'label' => '<b>Middle Name</b>',
              'rules' => 'trim|alpha'
            ),
            array(
              'field' => 'cp_two_l_name',
              'label' => '<b>Last Name</b>',
              'rules' => 'trim|alpha'
            ),
            array(
              'field' => 'cp_two_street_landmark',
              'label' => '<b>Street / Landmark</b>',
              'rules' => 'trim|is_title_validation'
            ),
            array(
              'field' => 'cp_two_state',
              'label' => '<b>State</b>',
              'rules' => 'trim|numeric'
            ),
            // array(
            //   'field' => 'cp_two_district',
            //   'label' => '<b>District</b>',
            //   'rules' => 'trim|numeric'
            // ),
            // array(
            //   'field' => 'cp_two_block',
            //   'label' => '<b>SD/Block</b>',
            //   'rules' => 'trim|numeric'
            // ),
            // array(
            //   'field' => 'cp_two_ward_gp',
            //   'label' => '<b>Ward / GP</b>',
            //   'rules' => 'trim|numeric'
            // ),
            array(
              'field' => 'cp_two_pin_code',
              'label' => '<b>Pin Code</b>',
              'rules' => 'trim|max_length[6]|numeric'
            ),
            array(
              'field' => 'cp_two_police_station',
              'label' => '<b>Police Station</b>',
              'rules' => 'trim|is_title_validation'
            ),
            array(
              'field' => 'cp_two_phone_no',
              'label' => '<b>Phone No</b>',
              'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
            ),
            array(
              'field' => 'cp_two_gender',
              'label' => '<b>Gender</b>',
              'rules' => 'trim|numeric'
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
              'rules' => 'trim'
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
              'rules' => 'trim|numeric'
              ),
              array(
                'field' => 'cp_two_block',
                'label' => '<b>SD/Block</b>',
                'rules' => 'trim|numeric'
              ),
              array(
                'field' => 'cp_two_ward_gp',
                'label' => '<b>Ward / GP</b>',
                'rules' => 'trim|numeric'
              ),
            );
          }else{
            $config_twelve = array(
              array(
              'field' => 'cp_two_address',
              'label' => '<b>Address</b>',
              'rules' => 'trim|is_title_validation'
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
         if ($this->form_validation->run() == TRUE) {
            // echo json_encode($data);
            $this->db->trans_begin();
            if($this->session->userdata('stake_id_fk') == '4' || $this->session->userdata('stake_id_fk') == '2'){
              if($this->session->userdata('block') == '0'){
                $stake_block = $this->session->userdata('subdiv');
              }else{
                $stake_block = $this->session->userdata('block');
              }
            }elseif($this->session->userdata('stake_id_fk') == '3'){
              $stake_block = $this->session->userdata('district');
            }
            $max_child_id = $this->incident_form_model->get_max_child_id($stake_block,date('y'));
            $result = $this->incident_form_model->insert_draft_incident_reporting_details_second($max_child_id);
            if($result == 0){
              ### Start Local Persons Involved in Prevention Incident#
              $Local_ersons_involved_id = $this->incident_form_model->cm_incident_report_local_persons_involved_details_by_incident_id(strval($max_child_id));
              $Local_Persons_Involved_Details=$this->input->post('Local_Persons_Involved_Details');
              $Local_Persons_Involved_Details_array_keys = array_keys($Local_Persons_Involved_Details);
              ### End Local Persons Involved in Prevention Incident#

              ### Start Officials Involved in Prevention Incident#
              $officials_involved_id = $this->incident_form_model->cm_incident_report_officials_involved_details_by_incident_id(strval($max_child_id));
              $Officials_Involved_Details = $this->input->post('Officials_Involved_Details');
              $Officials_Involved_Details_array_keys = array_keys($Officials_Involved_Details);
              ### End Officials Involved in Prevention Incident#

              $this->db->trans_commit();
              $data['error'] = TRUE;
              $data['max_child_id'] = $max_child_id;
              $data['local_persons_involved_id'] = $Local_ersons_involved_id;
              $data['local_persons_involved_array_keys'] = $Local_Persons_Involved_Details_array_keys;
              $data['Officials_involved_id'] = $officials_involved_id;
              $data['Officials_involved_array_keys'] = $Officials_Involved_Details_array_keys;
              echo json_encode($data);
              // $_SESSION['max_child_id'] = $max_child_id;
            }else{
              $this->db->trans_rollback();
              $this->session->set_flashdata('warning', 'Incident report data addition failed. Please try again.');
              redirect('admin/reporting/incident/incident_form');
            }
         }else{
            $data['error'] = FALSE;
            echo json_encode($data);
         }
      }
  }

  public function save_as_draft_update()
  {
    if($this->input->post('is_save_as_draft_update') == "YES"){
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
          'rules' => 'trim'
        ),
        array(
          'field' => 'street_landmark',
          'label' => '<b>Street / Landmark</b>',
          'rules' => 'trim|is_title_validation'
        ),
        array(
          'field' => 'ward_gp',
          'label' => '<b>Ward / GP</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'incident_district',
          'label' => '<b>District</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'incident_block',
          'label' => '<b>Block / Municipality</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'pin_code',
          'label' => '<b>Pin Code</b>',
          'rules' => 'trim|max_length[6]|numeric'
        ),
        array(
          'field' => 'police_station',
          'label' => '<b>Police Station</b>',
          'rules' => 'trim|is_title_validation'
        ),
        array(
          'field' => 'marriage_details',
          'label' => '<b>Marriage Details</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'prevented_details',
          'label' => '<b>Prevented Details</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'location_description',
          'label' => '<b>Description of location</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'anonymous',
          'label' => '<b>Anonymous</b>',
          'rules' => 'trim|numeric'
        ),
        array(
          'field' => 'cp_one_f_name',
          'label' => '<b>First Name</b>',
          'rules' => 'trim|alpha'
        ),
        array(
          'field' => 'cp_one_m_name',
          'label' => '<b>Middle Name</b>',
          'rules' => 'trim|alpha'
        ),
        array(
          'field' => 'cp_one_l_name',
          'label' => '<b>Last Name</b>',
          'rules' => 'trim|alpha'
        ),
        array(
          'field' => 'cp_one_street_landmark',
          'label' => '<b>Street / Landmark</b>',
          'rules' => 'trim|is_title_validation'
        ),
        array(
          'field' => 'cp_one_state',
          'label' => '<b>State</b>',
          'rules' => 'trim|numeric'
        ),
        // array(
        //   'field' => 'cp_one_ward_gp',
        //   'label' => '<b>Ward / GP</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_one_district',
        //   'label' => '<b>District</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_one_block',
        //   'label' => '<b>SD/Block</b>',
        //   'rules' => 'trim|numeric'
        // ),
        array(
          'field' => 'cp_one_pin_code',
          'label' => '<b>Pin Code</b>',
          'rules' => 'trim|max_length[6]|numeric'
        ),
        array(
          'field' => 'cp_one_police_station',
          'label' => '<b>Police Station</b>',
          'rules' => 'trim|is_title_validation'
        ),
        array(
          'field' => 'cp_one_phone_no',
          'label' => '<b>Phone No</b>',
          'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
        ),
        array(
          'field' => 'cp_one_gender',
          'label' => '<b>Gender</b>',
          'rules' => 'trim|numeric'
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
          'rules' => 'trim'
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
        // array(
        //   'field' => 'cp_one_cwc_minor_sent_to',
        //   'label' => '<b>Minor Sent to</b>',
        //   'rules' => 'trim|numeric'
        // ),
        array(
          'field' => 'cp_two_is_available',
          'label' => '<b>Is Available</b>',
          'rules' => 'trim|numeric'
        ),
        // array(
        //   'field' => 'cp_two_f_name',
        //   'label' => '<b>First Name</b>',
        //   'rules' => 'trim|alpha'
        // ),
        // array(
        //   'field' => 'cp_two_m_name',
        //   'label' => '<b>Middle Name</b>',
        //   'rules' => 'trim|alpha'
        // ),
        // array(
        //   'field' => 'cp_two_l_name',
        //   'label' => '<b>Last Name</b>',
        //   'rules' => 'trim|alpha'
        // ),
        // array(
        //   'field' => 'cp_two_street_landmark',
        //   'label' => '<b>Street / Landmark</b>',
        //   'rules' => 'trim|is_title_validation'
        // ),
        // array(
        //   'field' => 'cp_two_ward_gp',
        //   'label' => '<b>Ward / GP</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_district',
        //   'label' => '<b>District</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_block',
        //   'label' => '<b>SD/Block</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_pin_code',
        //   'label' => '<b>Pin Code</b>',
        //   'rules' => 'trim|max_length[6]|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_police_station',
        //   'label' => '<b>Police Station</b>',
        //   'rules' => 'trim|is_title_validation'
        // ),
        // array(
        //   'field' => 'cp_two_phone_no',
        //   'label' => '<b>Phone No</b>',
        //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
        // ),
        // array(
        //   'field' => 'cp_two_gender',
        //   'label' => '<b>Gender</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_social_category',
        //   'label' => '<b>Social Category</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_religion',
        //   'label' => '<b>Religion</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_dob',
        //   'label' => '<b>Date of Birth</b>',
        //   'rules' => 'trim'
        // ),
        // array(
        //   'field' => 'cp_two_dob_document_available',
        //   'label' => '<b>DOB document available</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_identity_document_available',
        //   'label' => '<b>Identity document available</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_highest_educational_attainment',
        //   'label' => '<b>Highest Educational Attainment</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_father_name',
        //   'label' => '<b>Father Name</b>',
        //   'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
        // ),
        // array(
        //   'field' => 'cp_two_mother_name',
        //   'label' => '<b>Mother Name</b>',
        //   'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
        // ),
        // array(
        //   'field' => 'cp_two_father_mobile_no',
        //   'label' => '<b>Father Phone No</b>',
        //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
        // ),
        // array(
        //   'field' => 'cp_two_mother_mobile_no',
        //   'label' => '<b>Mother Phone No</b>',
        //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
        // ),
        // array(
        //   'field' => 'cp_two_father_id',
        //   'label' => '<b>Father ID</b>',
        //   'rules' => 'trim|alpha_numeric'
        // ),
        // array(
        //   'field' => 'cp_two_mother_id',
        //   'label' => '<b>Mother ID</b>',
        //   'rules' => 'trim|alpha_numeric'
        // ),
        // array(
        //   'field' => 'cp_two_father_id_type',
        //   'label' => '<b>Father ID Type</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_mother_id_type',
        //   'label' => '<b>Mother ID Type</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_father_alive',
        //   'label' => '<b>Father Alive</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_mother_alive',
        //   'label' => '<b>Mother Alive</b>',
        //   'rules' => 'trim|numeric'
        // ),
        // array(
        //   'field' => 'cp_two_cwc_minor_sent_to',
        //   'label' => '<b>Minor Sent to</b>',
        //   'rules' => 'trim|numeric'
        // ),
      );

      if($anonymous == '2'){
        $config_two = array(
          array(
            'field' => 'identity_known_name',
            'label' => '<b>Identity known Name</b>',
            'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
          ),
          array(
            'field' => 'identity_street_landmark',
            'label' => '<b>Street / Landmark</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'identity_ward_gp',
            'label' => '<b>Ward / GP</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'identity_district',
            'label' => '<b>District</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'identity_block',
            'label' => '<b>SD/Block</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'identity_pin_code',
            'label' => '<b>Pin Code</b>',
            'rules' => 'trim|max_length[6]|numeric'
          ),
          array(
            'field' => 'identity_police_station',
            'label' => '<b>Police Station</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'identity_phone_no',
            'label' => '<b>Phone No</b>',
            'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
          ),
          array(
            'field' => 'information_received',
            'label' => '<b>Information received</b>',
            'rules' => 'trim|numeric'
          ),
        );
      }

      if($cp_one_state == '1'){
        $config_Thirteen = array(
          array(
            'field' => 'cp_one_ward_gp',
            'label' => '<b>Ward / GP</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'cp_one_district',
            'label' => '<b>District</b>',
            'rules' => 'trim|numeric'
          ),
          array(
            'field' => 'cp_one_block',
            'label' => '<b>SD/Block</b>',
            'rules' => 'trim|numeric'
          ),
        );
      }else{
        $config_Thirteen = array(
          array(
            'field' => 'cp_one_address',
            'label' => '<b>Address</b>',
            'rules' => 'trim|is_title_validation'
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

      // if($cp_one_cwc_minor_sent_to == '1' || $cp_one_cwc_minor_sent_to == '2' || $cp_one_cwc_minor_sent_to == '3'){
      //   $config_five = array(
      //     array(
      //       'field' => 'cp_one_cwc_district',
      //       'label' => '<b>District</b>',
      //       'rules' => 'trim|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_one_cwc_block',
      //       'label' => '<b>SD/Block</b>',
      //       'rules' => 'trim|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_one_cwc_address',
      //       'label' => '<b>Address</b>',
      //       'rules' => 'trim|is_title_validation'
      //     ),
      //     array(
      //       'field' => 'cp_one_cwc_remarks',
      //       'label' => '<b>Remarks</b>',
      //       'rules' => 'trim|is_script_validate'
      //     ),
      //   );
      // }

      // if($cp_one_cwc_minor_sent_to == '4'){
      //   $config_six = array(
      //     array(
      //       'field' => 'cp_one_cwc_case_no',
      //       'label' => '<b>Case No</b>',
      //       'rules' => 'trim|alpha_numeric'
      //     ),
      //     array(
      //       'field' => 'cp_one_cwc_case_date',
      //       'label' => '<b>Date</b>',
      //       'rules' => 'trim'
      //     ),
      //     array(
      //       'field' => 'cp_one_cwc_district',
      //       'label' => '<b>District</b>',
      //       'rules' => 'trim|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_one_cwc_block',
      //       'label' => '<b>SD/Block</b>',
      //       'rules' => 'trim|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_one_cwc_cci',
      //       'label' => '<b>CCI</b>',
      //       'rules' => 'trim|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_one_cwc_remarks',
      //       'label' => '<b>Remarks</b>',
      //       'rules' => 'trim|is_script_validate'
      //     ),
      //   );
      // }

      if($cp_two_is_available == '1'){
        $config_eleven = array(
          array(
          'field' => 'cp_two_f_name',
          'label' => '<b>First Name</b>',
          'rules' => 'trim|alpha'
          ),
          array(
            'field' => 'cp_two_m_name',
            'label' => '<b>Middle Name</b>',
            'rules' => 'trim|alpha'
          ),
          array(
            'field' => 'cp_two_l_name',
            'label' => '<b>Last Name</b>',
            'rules' => 'trim|alpha'
          ),
          array(
            'field' => 'cp_two_street_landmark',
            'label' => '<b>Street / Landmark</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'cp_two_state',
            'label' => '<b>State</b>',
            'rules' => 'trim|numeric'
          ),
          // array(
          //   'field' => 'cp_two_district',
          //   'label' => '<b>District</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_block',
          //   'label' => '<b>SD/Block</b>',
          //   'rules' => 'trim|numeric'
          // ),
          // array(
          //   'field' => 'cp_two_ward_gp',
          //   'label' => '<b>Ward / GP</b>',
          //   'rules' => 'trim|numeric'
          // ),
          array(
            'field' => 'cp_two_pin_code',
            'label' => '<b>Pin Code</b>',
            'rules' => 'trim|max_length[6]|numeric'
          ),
          array(
            'field' => 'cp_two_police_station',
            'label' => '<b>Police Station</b>',
            'rules' => 'trim|is_title_validation'
          ),
          array(
            'field' => 'cp_two_phone_no',
            'label' => '<b>Phone No</b>',
            'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
          ),
          array(
            'field' => 'cp_two_gender',
            'label' => '<b>Gender</b>',
            'rules' => 'trim|numeric'
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
            'rules' => 'trim'
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
          // array(
          //   'field' => 'cp_two_cwc_minor_sent_to',
          //   'label' => '<b>Minor Sent to</b>',
          //   'rules' => 'trim|numeric'
          // ),
        );
        
        if($cp_two_state == '1'){
          $config_twelve = array(
            array(
            'field' => 'cp_two_district',
            'label' => '<b>District</b>',
            'rules' => 'trim|numeric'
            ),
            array(
              'field' => 'cp_two_block',
              'label' => '<b>SD/Block</b>',
              'rules' => 'trim|numeric'
            ),
            array(
              'field' => 'cp_two_ward_gp',
              'label' => '<b>Ward / GP</b>',
              'rules' => 'trim|numeric'
            ),
          );
        }else{
          $config_twelve = array(
            array(
            'field' => 'cp_two_address',
            'label' => '<b>Address</b>',
            'rules' => 'trim|is_title_validation'
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

        // if($cp_two_cwc_minor_sent_to == '1' || $cp_two_cwc_minor_sent_to == '2' || $cp_two_cwc_minor_sent_to == '3'){
        //   $config_nine = array(
        //     array(
        //       'field' => 'cp_two_cwc_district',
        //       'label' => '<b>District</b>',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_two_cwc_block',
        //       'label' => '<b>SD/Block</b>',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_two_cwc_address',
        //       'label' => '<b>Address</b>',
        //       'rules' => 'trim|is_title_validation'
        //     ),
        //     array(
        //       'field' => 'cp_two_cwc_remarks',
        //       'label' => '<b>Remarks</b>',
        //       'rules' => 'trim|is_script_validate'
        //     ),
        //   );
        // }

        // if($cp_two_cwc_minor_sent_to == '4'){
        //   $config_ten = array(
        //     array(
        //       'field' => 'cp_two_cwc_case_no',
        //       'label' => '<b>Case No</b>',
        //       'rules' => 'trim|alpha_numeric'
        //     ),
        //     array(
        //       'field' => 'cp_two_cwc_case_date',
        //       'label' => '<b>Date</b>',
        //       'rules' => 'trim'
        //     ),
        //     array(
        //       'field' => 'cp_two_cwc_district',
        //       'label' => '<b>District</b>',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_two_cwc_block',
        //       'label' => '<b>SD/Block</b>',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_two_cwc_cci',
        //       'label' => '<b>CCI',
        //       'rules' => 'trim|numeric'
        //     ),
        //     array(
        //       'field' => 'cp_two_cwc_remarks',
        //       'label' => '<b>Remarks</b>',
        //       'rules' => 'trim|is_script_validate'
        //     ),
        //   );
        // }
      }
      
      $config = array_merge($config_one, $config_two, $config_three, $config_four, $config_seven, $config_eight, $config_eleven, $config_twelve, $config_Thirteen);
      $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == TRUE) {
          $incident_update_id = $this->input->post('incident_update_id');
          $result = $this->incident_form_model->update_incident_reporting_draft_details($incident_update_id);
          if($result == 0){
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Incident report draft data successfully added.');
            $Local_ersons_involved_id = $this->incident_form_model->cm_incident_report_local_persons_involved_details_by_incident_id($incident_update_id);
            $Local_Persons_Involved_Details=$this->input->post('Local_Persons_Involved_Details');
            $Local_Persons_Involved_Details_array_keys = array_keys($Local_Persons_Involved_Details);


            $officials_involved_id = $this->incident_form_model->cm_incident_report_officials_involved_details_by_incident_id(strval($incident_update_id));
            $Officials_Involved_Details = $this->input->post('Officials_Involved_Details');
            $Officials_Involved_Details_array_keys = array_keys($Officials_Involved_Details);



            $data['error'] = TRUE;
            $data['incident_update_id'] = $incident_update_id;
            $data['local_persons_involved_id'] = $Local_ersons_involved_id;
            $data['local_persons_involved_array_keys'] = $Local_Persons_Involved_Details_array_keys;
            $data['Officials_involved_id'] = $officials_involved_id;
            $data['Officials_involved_array_keys'] = $Officials_Involved_Details_array_keys;
            echo json_encode($data);
          }else{
            $this->db->trans_rollback();
            $this->session->set_flashdata('warning', 'Incident report draft data addition failed. Please try again.');
            echo $incident_update_id;
            redirect('admin/reporting/incident/incident_form');
          }
      }else{
          $data['error'] = FALSE;
          echo json_encode($data);
      }
    }
  }

  public function save_as_draft_final_update()
  {
    if($this->input->post('is_save_as_draft_update') == "YES"){
      $incident_update_id = $this->input->post('incident_update_id');
      $this->db->trans_begin();
      $result = $this->incident_form_model->update_incident_reporting_draft_final_details($incident_update_id);
      if($result == 0)
      {
        $this->db->trans_commit();
        $this->session->set_flashdata('success', 'Incident report data successfully added.');
        echo $incident_update_id;
      }
      else
      {
        $this->db->trans_rollback();
        $this->session->set_flashdata('warning', 'Incident report draft data addition failed. Please try again.');
        echo $incident_update_id;
        redirect('admin/reporting/incident/incident_form');
      }
    }
  }

  public function incident_form_edit($incident_id=NULL)
  {
    if($this->session->userdata('stake_id_fk')==2)
    {
      $current_status = 2;
    }
    elseif($this->session->userdata('stake_id_fk')==4)
    {
      $current_status = 1;
    }
    else
    {
      $current_status = '';
    }
    // echo $this->session->userdata('stake_id_fk');die;
    $incient_exist = $this->check_incident_id($incident_id,$current_status);
    if (!empty($incient_exist))
    {
      $login_id = $this->session->userdata('login_id');
      $incident_id = base64_decode($incident_id);
      $data['local_persons_involved'] = $this->incident_form_model->cm_incident_report_local_persons_involved_details($incident_id);
      $data['officials_involved'] = $this->incident_form_model->cm_incident_report_officials_involved_details($incident_id);
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);
      $data['incident_edit_details']=$incident_edit_details= $this->incident_form_model->edit_incident_reporting_details($incident_id);
      // echo '<pre>';print_r($incident_edit_details);die();
      $data['state'] = $this->Master_model->get_state_name();
      $data['districts'] = $this->Master_model->get_district();
      $data['districts_name'] = $this->Master_model->get_district_name($this->session->userdata('district'));

      $data['block_name'] = $this->Master_model->get_block_name($this->session->userdata('block'));


      $data['block_details_name'] = $this->Master_model->get_block($this->session->userdata('district'));


      $data['incident_block'] = $incident_block = ($incident_edit_details)?$incident_edit_details['block']:NULL;
      $data['Incident_Ward_Gp_Block'] = $Incident_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($incident_block);
      if(!empty($Incident_Ward_Gp_Block)){
        if($Incident_Ward_Gp_Block->rural_urban == 'U'){
          $data['Incident_Ward'] = $this->Master_model->get_ward($incident_block);
        }else{
          $data['Incident_Gp'] = $this->Master_model->get_gp($incident_block);
        }
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
      $data['block_details'] = $this->Master_model->block();
      $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
      $incident_district = $this->input->post('incident_district');
      $data['incidentBlock'] = $this->Master_model->get_block($incident_district);
      $identity_district = ($incident_edit_details)?$incident_edit_details['identity_district_id']:NULL;
       $data['identityBlock'] = ($this->Master_model->get_block($identity_district))?$this->Master_model->get_block($identity_district):array();
      // $identity_block = $this->input->post('identity_block');
      $identity_block = ($incident_edit_details)?$incident_edit_details['identity_block_id']:NULL;
      $data['Identity_Ward_Gp_Block'] = $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($identity_block);
      if(!empty($Identity_Ward_Gp_Block)){
        if($Identity_Ward_Gp_Block->rural_urban == 'U'){
          $data['Identity_Ward'] = $this->Master_model->get_ward($identity_block);
        }else{
          $data['Identity_Gp'] = $this->Master_model->get_gp($identity_block);
        }
      }

      $cp_one_state = ($incident_edit_details)?$incident_edit_details['cp_1_state']:NULL;
      if($this->input->post('cp_one_state')!='')
      {
        $cp_one_state = $this->input->post('cp_one_state');
        $data['CP_One_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_one_state);
      }
      else
      {
        $data['CP_One_District_Details'] = array();
      }
      $cp_one_district = ($incident_edit_details)?$incident_edit_details['cp_1_district_id']:NULL;
      $data['cponeBlock'] = ($this->Master_model->get_block($cp_one_district))?$this->Master_model->get_block($cp_one_district):array();
      // $cp_one_block = $this->input->post('cp_one_block');
      $cp_one_block = ($incident_edit_details)?$incident_edit_details['cp_1_block_id']:NULL;
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

      $cp_two_state = ($incident_edit_details)?$incident_edit_details['cp_2_state']:NULL;

      $data['CP_Two_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_two_state);

      // print_r($data['CP_Two_District_Details']);die;
      $cp_two_district = ($incident_edit_details)?$incident_edit_details['cp_2_district_id']:NULL;
      $data['cptwoBlock'] = ($this->Master_model->get_block($cp_two_district))?$this->Master_model->get_block($cp_two_district):array();
      // $cp_two_block = $this->input->post('cp_two_block');
      $cp_two_block = ($incident_edit_details)?$incident_edit_details['cp_2_block_id']:NULL;

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
       
        $this->load->view($this->config->item('theme').'reporting/incident/incident_form_edit_view', $data);
      }
      else
      {
        $this->session->set_flashdata('error', 'Invalid URL provided. Please enter a valid URL!');
        redirect('admin/dashboard');
      }

  }

  public function update_incident($incident_id=NULL)
  { 
    // echo $incident_id;die;
    $current_status = 1;
    $incient_exist = $this->check_incident_id($incident_id,$current_status);
    if (!empty($incient_exist))
    {
    $incident_id = base64_decode($incident_id);
    $data['local_persons_involved'] = $this->incident_form_model->cm_incident_report_local_persons_involved_details($incident_id);
    $data['officials_involved'] = $this->incident_form_model->cm_incident_report_officials_involved_details($incident_id);
    $data['incident_edit_details']=$incident_edit_details= $this->incident_form_model->edit_incident_reporting_details($incident_id);
    $district_id = ($incident_edit_details)?$incident_edit_details['district']:NULL;
    $this->load->library('form_validation');
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
    $config_cp_age = array();

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
        'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('incident_block') . ']'
      ),
      array(
        'field' => 'incident_district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
      ),
      array(
        'field' => 'incident_block',
        'label' => '<b>Block / Municipality</b>',
        'rules' => 'trim|required|numeric|max_length[4]|callback_validate_block'
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
        'rules' => 'trim|required|numeric|max_length[1]|callback_validate_state'
      ),
      array(
        'field' => 'cp_one_ward_gp',
        'label' => '<b>Ward / GP</b>',
        'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('cp_one_ward_gp'). ']'
      ),
      array(
        'field' => 'cp_one_district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
      ),
      array(
        'field' => 'cp_one_block',
        'label' => '<b>SD/Block</b>',
        'rules' => 'trim|required|numeric|callback_validate_block'
      ),
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
      // array(
      //   'field' => 'cp_one_cwc_minor_sent_to',
      //   'label' => '<b>Minor Sent to</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
      array(
        'field' => 'cp_two_is_available',
        'label' => '<b>Is Available</b>',
        'rules' => 'trim|required|numeric'
      ),
      // array(
      //   'field' => 'cp_two_f_name',
      //   'label' => '<b>First Name</b>',
      //   'rules' => 'trim|required|alpha'
      // ),
      // array(
      //   'field' => 'cp_two_m_name',
      //   'label' => '<b>Middle Name</b>',
      //   'rules' => 'trim|alpha'
      // ),
      // array(
      //   'field' => 'cp_two_l_name',
      //   'label' => '<b>Last Name</b>',
      //   'rules' => 'trim|required|alpha'
      // ),
      // array(
      //   'field' => 'cp_two_street_landmark',
      //   'label' => '<b>Street / Landmark</b>',
      //   'rules' => 'trim|is_title_validation'
      // ),
      // array(
      //   'field' => 'cp_two_ward_gp',
      //   'label' => '<b>Ward / GP</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
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
      //   'field' => 'cp_two_pin_code',
      //   'label' => '<b>Pin Code</b>',
      //   'rules' => 'trim|required|max_length[6]|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_police_station',
      //   'label' => '<b>Police Station</b>',
      //   'rules' => 'trim|required|is_title_validation'
      // ),
      // array(
      //   'field' => 'cp_two_phone_no',
      //   'label' => '<b>Phone No</b>',
      //   'rules' => 'trim|required|max_length[10]|numeric|is_phone_number_valid'
      // ),
      // array(
      //   'field' => 'cp_two_gender',
      //   'label' => '<b>Gender</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_social_category',
      //   'label' => '<b>Social Category</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_religion',
      //   'label' => '<b>Religion</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_dob',
      //   'label' => '<b>Date of Birth</b>',
      //   'rules' => 'trim|required'
      // ),
      // array(
      //   'field' => 'cp_two_dob_document_available',
      //   'label' => '<b>DOB document available</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_identity_document_available',
      //   'label' => '<b>Identity document available</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_highest_educational_attainment',
      //   'label' => '<b>Highest Educational Attainment</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_father_name',
      //   'label' => '<b>Father Name</b>',
      //   'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
      // ),
      // array(
      //   'field' => 'cp_two_mother_name',
      //   'label' => '<b>Mother Name</b>',
      //   'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
      // ),
      // array(
      //   'field' => 'cp_two_father_mobile_no',
      //   'label' => '<b>Father Phone No</b>',
      //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
      // ),
      // array(
      //   'field' => 'cp_two_mother_mobile_no',
      //   'label' => '<b>Mother Phone No</b>',
      //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
      // ),
      // array(
      //   'field' => 'cp_two_father_id',
      //   'label' => '<b>Father ID</b>',
      //   'rules' => 'trim|alpha_numeric'
      // ),
      // array(
      //   'field' => 'cp_two_mother_id',
      //   'label' => '<b>Mother ID</b>',
      //   'rules' => 'trim|alpha_numeric'
      // ),
      // array(
      //   'field' => 'cp_two_father_id_type',
      //   'label' => '<b>Father ID Type</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_mother_id_type',
      //   'label' => '<b>Mother ID Type</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_father_alive',
      //   'label' => '<b>Father Alive</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_mother_alive',
      //   'label' => '<b>Mother Alive</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_cwc_minor_sent_to',
      //   'label' => '<b>Minor Sent to</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
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

    // if($cp_one_cwc_minor_sent_to == '1' || $cp_one_cwc_minor_sent_to == '2' || $cp_one_cwc_minor_sent_to == '3'){
    //   $config_five = array(
    //     array(
    //       'field' => 'cp_one_cwc_district',
    //       'label' => '<b>District</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_block',
    //       'label' => '<b>SD/Block</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_address',
    //       'label' => '<b>Address</b>',
    //       'rules' => 'trim|required|is_title_validation'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_remarks',
    //       'label' => '<b>Remarks</b>',
    //       'rules' => 'trim|is_script_validate'
    //     ),
    //   );
    // }

    // if($cp_one_cwc_minor_sent_to == '4'){
    //   $config_six = array(
    //     array(
    //       'field' => 'cp_one_cwc_case_no',
    //       'label' => '<b>Case No</b>',
    //       'rules' => 'trim|required|alpha_numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_case_date',
    //       'label' => '<b>Date</b>',
    //       'rules' => 'trim|required'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_district',
    //       'label' => '<b>District</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_block',
    //       'label' => '<b>SD/Block</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_cci',
    //       'label' => '<b>CCI</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_remarks',
    //       'label' => '<b>Remarks</b>',
    //       'rules' => 'trim|is_script_validate'
    //     ),
    //   );
    // }

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
          'rules' => 'trim|required|numeric|max_length[1]|callback_validate_state'
        ),
        array(
          'field' => 'cp_two_district',
          'label' => '<b>District</b>',
          'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
        ),
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
        // array(
        //   'field' => 'cp_two_cwc_minor_sent_to',
        //   'label' => '<b>Minor Sent to</b>',
        //   'rules' => 'trim|required|numeric'
        // ),
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

      // if($cp_two_cwc_minor_sent_to == '1' || $cp_two_cwc_minor_sent_to == '2' || $cp_two_cwc_minor_sent_to == '3'){
      //   $config_nine = array(
      //     array(
      //       'field' => 'cp_two_cwc_district',
      //       'label' => '<b>District</b>',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_block',
      //       'label' => '<b>SD/Block</b>',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_address',
      //       'label' => '<b>Address</b>',
      //       'rules' => 'trim|required|is_title_validation'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_remarks',
      //       'label' => '<b>Remarks</b>',
      //       'rules' => 'trim|is_script_validate'
      //     ),
      //   );
      // }

      // if($cp_two_cwc_minor_sent_to == '4'){
      //   $config_ten = array(
      //     array(
      //       'field' => 'cp_two_cwc_case_no',
      //       'label' => '<b>Case No</b>',
      //       'rules' => 'trim|required|alpha_numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_case_date',
      //       'label' => '<b>Date</b>',
      //       'rules' => 'trim|required'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_district',
      //       'label' => '<b>District</b>',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_block',
      //       'label' => '<b>SD/Block</b>',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_cci',
      //       'label' => '<b>CCI',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_remarks',
      //       'label' => '<b>Remarks</b>',
      //       'rules' => 'trim|is_script_validate'
      //     ),
      //   );
      // }
    }
    if($cp_two_is_available ==''|| $cp_two_is_available =='2')
    {
      $config_cp_age = array(
      array(
          'field' => 'cp_one_age',
          'label' => '<b>Age</b>',
          'rules' => 'trim|required|callback_check_cp1_age'
        )
        );
    }
    else if($cp_two_is_available =='1')
    {
      $config_cp_age = array(
      array(
          'field' => 'cp_one_age',
          'label' => '<b>Age</b>',
          'rules' => 'trim|required|callback_validate_below_either_18'
        ), 
      array(
          'field' => 'cp_two_age',
          'label' => '<b>Age</b>',
          'rules' => 'trim|required|callback_validate_below_either_18'
        )
      );
    }
    

    $config = array_merge($config_one, $config_two, $config_three, $config_four, $config_seven, $config_eight, $config_eleven, $config_twelve, $config_Thirteen,$config_cp_age);
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == TRUE) {
        $result = $this->incident_form_model->update_incident_reporting_details($incident_id);
        if($result == 0)
        {
          $this->db->trans_commit();
          $this->session->set_flashdata('success', 'Incident report data successful updated.');
          redirect('admin/reporting/incident/incident_list');
        }
        else
        {
          $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'Incident report data updation failed. Please try again.');
          redirect('admin/reporting/incident/incident_list');
        }
    }else{
        $this->session->set_flashdata('error', 'Something went wrong. please check errors');
    } 

    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);

    //echo '<pre>';print_r($incident_edit_details);die();
    $data['state'] = $this->Master_model->get_state_name();
    $data['districts'] = $this->Master_model->get_district();
    $data['districts_name'] = $this->Master_model->get_district_name($this->session->userdata('district'));
    $data['block_name'] = $this->Master_model->get_block_name($this->session->userdata('block'));
    $data['block_details_name'] = $this->Master_model->get_block($this->session->userdata('district'));
    $data['incident_block'] = $incident_block = ($incident_edit_details)?$incident_edit_details['block']:NULL;
    $data['Incident_Ward_Gp_Block'] = $Incident_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($incident_block);
    if(!empty($Incident_Ward_Gp_Block)){
      if($Incident_Ward_Gp_Block->rural_urban == 'U'){
        $data['Incident_Ward'] = $this->Master_model->get_ward($incident_block);
      }else{
        $data['Incident_Gp'] = $this->Master_model->get_gp($incident_block);
      }
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
    $data['block_details'] = $this->Master_model->block();
    $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
    $incident_district = $this->input->post('incident_district');
    $data['incidentBlock'] = $this->Master_model->get_block($incident_district);
    $identity_district = ($incident_edit_details)?$incident_edit_details['identity_district_id']:NULL;
    // $data['identityBlock'] = $this->Master_model->get_block($identity_district);
    $data['identityBlock'] = ($this->Master_model->get_block($identity_district))?$this->Master_model->get_block($identity_district):array();
    // $identity_block = $this->input->post('identity_block');
    $identity_block = ($incident_edit_details)?$incident_edit_details['identity_block_id']:NULL;
    $data['Identity_Ward_Gp_Block'] = $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($identity_block);
    if(!empty($Identity_Ward_Gp_Block)){
      if($Identity_Ward_Gp_Block->rural_urban == 'U'){
        $data['Identity_Ward'] = $this->Master_model->get_ward($identity_block);
      }else{
        $data['Identity_Gp'] = $this->Master_model->get_gp($identity_block);
      }
    }

    $cp_one_state = ($incident_edit_details)?$incident_edit_details['cp_1_state']:NULL;
    $data['CP_One_District_Details'] = ($this->Master_model->Get_District_Details_Name($cp_one_state))?$this->Master_model->Get_District_Details_Name($cp_one_state):array();
    $cp_one_district = ($incident_edit_details)?$incident_edit_details['cp_1_district_id']:NULL;
    $data['cponeBlock'] = ($this->Master_model->get_block($cp_one_district))?$this->Master_model->get_block($cp_one_district):array();
    // $cp_one_block = $this->input->post('cp_one_block');
    $cp_one_block = ($incident_edit_details)?$incident_edit_details['cp_1_block_id']:NULL;
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

    $cp_two_state = ($incident_edit_details)?$incident_edit_details['cp_2_state']:NULL;
    if($cp_two_state!='')
    {
      $data['CP_Two_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_two_state);
    }
    else
    {
      $data['CP_Two_District_Details'] = array();

    }
    // print_r($data['CP_Two_District_Details']);die;
    $cp_two_district = ($incident_edit_details)?$incident_edit_details['cp_2_district_id']:NULL;
    $data['cptwoBlock'] = ($this->Master_model->get_block($cp_two_district))?$this->Master_model->get_block($cp_two_district):array();
    // $cp_two_block = $this->input->post('cp_two_block');
    $cp_two_block = ($incident_edit_details)?$incident_edit_details['cp_2_block_id']:NULL;

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
    $this->load->view($this->config->item('theme').'reporting/incident/incident_form_edit_view', $data);
    }
    else
    { 
      $this->session->set_flashdata('error', 'Invalid URL provided. Please enter a valid URL!');
      redirect('admin/dashboard');
    }
  }

  public function Local_Persons_Involved_Row_Delete_Data()
  {
      $sl_no = $this->input->get('param');
      $result = $this->db->delete('cm_incident_report_local_persons_involved_details', array('sl_no' =>$sl_no)); 
      //echo $this->db->last_query();
      return TRUE;
  }

  public function Officials_Involved_Row_Delete_Data()
  {
      $sl_no = $this->input->get('param');
      $result = $this->db->delete('cm_incident_report_officials_involved_details', array('sl_no' => $sl_no));
      return TRUE;
  }

  public function Get_District_By_Id()
  {
      $state_id = $this->input->get('id');
      $district = $this->Master_model->Get_District_Details_Name($state_id);
      echo json_encode($district);
  }

  public function getBlockById()
  {
      $district_id = $this->input->get('id');
      $block = $this->Master_model->get_block($district_id);
      echo json_encode($block);
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

  public function Get_Cp_One_CCI_Details()
  {
     $cp_one_gender = $this->input->get('cp_one_gender_value');
     $cp_one_cwc_district = $this->input->get('cp_one_cwc_district');
     $cci_details = $this->Master_model->Get_Cp_One_CCI_Details($cp_one_gender, $cp_one_cwc_district);
     echo json_encode($cci_details);
  }

  public function Get_Cp_Two_CCI_Details()
  {
     $cp_two_gender = $this->input->get('cp_two_gender_value');
     $cp_two_cwc_district = $this->input->get('cp_two_cwc_district');
     $cci_details = $this->Master_model->Get_Cp_Two_CCI_Details($cp_two_gender, $cp_two_cwc_district);
     echo json_encode($cci_details);
  }

  public function Get_Fetch_CP_One_CWC_District()
  {
     $districts_data = $this->Master_model->get_district();
     echo json_encode($districts_data);
  }

  public function Get_Fetch_CP_Two_CWC_District()
  {
     $districts_data = $this->Master_model->get_district();
     echo json_encode($districts_data);
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

  public function incident_draft_form($incident_id=NULL)
  {

    $current_status = 1;
    $incient_exist = $this->check_incident_id($incident_id,$current_status);
    if (!empty($incient_exist))
    {

      $login_id = $this->session->userdata('login_id');
      $incident_id = base64_decode($incident_id);
      $data['local_persons_involved'] = $this->incident_form_model->cm_incident_report_local_persons_involved_details($incident_id);
      $data['officials_involved'] = $this->incident_form_model->cm_incident_report_officials_involved_details($incident_id);
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);
      $data['incident_edit_details']=$incident_edit_details= $this->incident_form_model->edit_incident_reporting_details($incident_id);
      //echo '<pre>';print_r($incident_edit_details);die();
      $data['state'] = $this->Master_model->get_state_name();
      $data['districts'] = $this->Master_model->get_district();
      $data['districts_name'] = $this->Master_model->get_district_name($this->session->userdata('district'));
      $data['block_name'] = $this->Master_model->get_block_name($this->session->userdata('block'));
      $data['block_details_name'] = $this->Master_model->get_block($this->session->userdata('district'));
      $data['incident_block'] = $incident_block = ($incident_edit_details)?$incident_edit_details['block']:NULL;
      $data['Incident_Ward_Gp_Block'] = $Incident_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($incident_block);
      if(!empty($Incident_Ward_Gp_Block)){
        if($Incident_Ward_Gp_Block->rural_urban == 'U'){
          $data['Incident_Ward'] = $this->Master_model->get_ward($incident_block);
        }else{
          $data['Incident_Gp'] = $this->Master_model->get_gp($incident_block);
        }
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
      $data['block_details'] = $this->Master_model->block();
      $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
      $incident_district = $this->input->post('incident_district');
      $data['incidentBlock'] = $this->Master_model->get_block($incident_district);
      $identity_district = ($incident_edit_details)?$incident_edit_details['identity_district_id']:NULL;
      // $data['identityBlock'] = $this->Master_model->get_block($identity_district);
      $data['identityBlock'] = ($this->Master_model->get_block($identity_district))?$this->Master_model->get_block($identity_district):array();
      // $identity_block = $this->input->post('identity_block');
      $identity_block = ($incident_edit_details)?$incident_edit_details['identity_block_id']:NULL;
      $data['Identity_Ward_Gp_Block'] = $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($identity_block);
      if(!empty($Identity_Ward_Gp_Block)){
        if($Identity_Ward_Gp_Block->rural_urban == 'U'){
          $data['Identity_Ward'] = $this->Master_model->get_ward($identity_block);
        }else{
          $data['Identity_Gp'] = $this->Master_model->get_gp($identity_block);
        }
      }

      $cp_one_state = ($incident_edit_details)?$incident_edit_details['cp_1_state']:NULL;
      $data['CP_One_District_Details'] = ($this->Master_model->Get_District_Details_Name($cp_one_state))?$this->Master_model->Get_District_Details_Name($cp_one_state):array();
      $cp_one_district = ($incident_edit_details)?$incident_edit_details['cp_1_district_id']:NULL;
      // echo  $cp_one_district;die;
      $data['cponeBlock'] = ($this->Master_model->get_block($cp_one_district))?$this->Master_model->get_block($cp_one_district):array();
      // print_r($data['cponeBlock']);die;
      // $cp_one_block = $this->input->post('cp_one_block');
      $cp_one_block = ($incident_edit_details)?$incident_edit_details['cp_1_block_id']:NULL;
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

      $cp_two_state = ($incident_edit_details)?$incident_edit_details['cp_2_state']:NULL;
      $data['CP_Two_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_two_state);
      $cp_two_district = ($incident_edit_details)?$incident_edit_details['cp_2_district_id']:NULL;
      $data['cptwoBlock'] = ($this->Master_model->get_block($cp_two_district))?$this->Master_model->get_block($cp_two_district):array();
      // $cp_two_block = $this->input->post('cp_two_block');
      $cp_two_block = ($incident_edit_details)?$incident_edit_details['cp_2_block_id']:NULL;

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
      $this->load->view($this->config->item('theme').'reporting/incident/incident_draft_form_edit_view', $data);
    }
    else
    { 
      $this->session->set_flashdata('error', 'Invalid URL provided. Please enter a valid URL!');
      redirect('admin/dashboard');
    }
  }

  public function update_draft_incident($incident_id)
  { 
    $this->validate_login(array('4', '3','2'));

    $incident_id = base64_decode($incident_id);
    $data['local_persons_involved'] = $this->incident_form_model->cm_incident_report_local_persons_involved_details($incident_id);
    $data['officials_involved'] = $this->incident_form_model->cm_incident_report_officials_involved_details($incident_id);
    $data['incident_edit_details']=$incident_edit_details= $this->incident_form_model->edit_incident_reporting_details($incident_id);
    $district_id = ($incident_edit_details)?$incident_edit_details['district']:NULL;
    $this->load->library('form_validation');
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
        'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('incident_block') . ']'
      ),
      array(
        'field' => 'incident_district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
      ),
      array(
        'field' => 'incident_block',
        'label' => '<b>Block / Municipality</b>',
        'rules' => 'trim|required|numeric|max_length[4]|callback_validate_block'
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
      array(
        'field' => 'cp_one_state',
        'label' => '<b>State</b>',
        'rules' => 'trim|required|numeric|max_length[1]|callback_validate_state'
      ),
      array(
        'field' => 'cp_one_ward_gp',
        'label' => '<b>Ward / GP</b>',
        'rules' => 'trim|required|numeric|callback_validate_ward_gp[' .$this->input->post('cp_one_ward_gp'). ']'
      ),
      array(
        'field' => 'cp_one_district',
        'label' => '<b>District</b>',
        'rules' => 'trim|required|numeric|max_length[2]|callback_validate_district'
      ),
      array(
        'field' => 'cp_one_block',
        'label' => '<b>SD/Block</b>',
        'rules' => 'trim|required|numeric|callback_validate_block'
      ),
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
      // array(
      //   'field' => 'cp_one_cwc_minor_sent_to',
      //   'label' => '<b>Minor Sent to</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
      array(
        'field' => 'cp_two_is_available',
        'label' => '<b>Is Available</b>',
        'rules' => 'trim|required|numeric'
      ),
      // array(
      //   'field' => 'cp_two_f_name',
      //   'label' => '<b>First Name</b>',
      //   'rules' => 'trim|required|alpha'
      // ),
      // array(
      //   'field' => 'cp_two_m_name',
      //   'label' => '<b>Middle Name</b>',
      //   'rules' => 'trim|alpha'
      // ),
      // array(
      //   'field' => 'cp_two_l_name',
      //   'label' => '<b>Last Name</b>',
      //   'rules' => 'trim|required|alpha'
      // ),
      // array(
      //   'field' => 'cp_two_street_landmark',
      //   'label' => '<b>Street / Landmark</b>',
      //   'rules' => 'trim|is_title_validation'
      // ),
      // array(
      //   'field' => 'cp_two_ward_gp',
      //   'label' => '<b>Ward / GP</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
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
      //   'field' => 'cp_two_pin_code',
      //   'label' => '<b>Pin Code</b>',
      //   'rules' => 'trim|required|max_length[6]|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_police_station',
      //   'label' => '<b>Police Station</b>',
      //   'rules' => 'trim|required|is_title_validation'
      // ),
      // array(
      //   'field' => 'cp_two_phone_no',
      //   'label' => '<b>Phone No</b>',
      //   'rules' => 'trim|required|max_length[10]|numeric|is_phone_number_valid'
      // ),
      // array(
      //   'field' => 'cp_two_gender',
      //   'label' => '<b>Gender</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_social_category',
      //   'label' => '<b>Social Category</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_religion',
      //   'label' => '<b>Religion</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_dob',
      //   'label' => '<b>Date of Birth</b>',
      //   'rules' => 'trim|required'
      // ),
      // array(
      //   'field' => 'cp_two_dob_document_available',
      //   'label' => '<b>DOB document available</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_identity_document_available',
      //   'label' => '<b>Identity document available</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_highest_educational_attainment',
      //   'label' => '<b>Highest Educational Attainment</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_father_name',
      //   'label' => '<b>Father Name</b>',
      //   'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
      // ),
      // array(
      //   'field' => 'cp_two_mother_name',
      //   'label' => '<b>Mother Name</b>',
      //   'rules' => 'trim|min_length[2]|max_length[50]|regex_match[/^[a-zA-Z ]+$/]'
      // ),
      // array(
      //   'field' => 'cp_two_father_mobile_no',
      //   'label' => '<b>Father Phone No</b>',
      //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
      // ),
      // array(
      //   'field' => 'cp_two_mother_mobile_no',
      //   'label' => '<b>Mother Phone No</b>',
      //   'rules' => 'trim|max_length[10]|numeric|is_phone_number_valid'
      // ),
      // array(
      //   'field' => 'cp_two_father_id',
      //   'label' => '<b>Father ID</b>',
      //   'rules' => 'trim|alpha_numeric'
      // ),
      // array(
      //   'field' => 'cp_two_mother_id',
      //   'label' => '<b>Mother ID</b>',
      //   'rules' => 'trim|alpha_numeric'
      // ),
      // array(
      //   'field' => 'cp_two_father_id_type',
      //   'label' => '<b>Father ID Type</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_mother_id_type',
      //   'label' => '<b>Mother ID Type</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_father_alive',
      //   'label' => '<b>Father Alive</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_mother_alive',
      //   'label' => '<b>Mother Alive</b>',
      //   'rules' => 'trim|numeric'
      // ),
      // array(
      //   'field' => 'cp_two_cwc_minor_sent_to',
      //   'label' => '<b>Minor Sent to</b>',
      //   'rules' => 'trim|required|numeric'
      // ),
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

    // if($cp_one_cwc_minor_sent_to == '1' || $cp_one_cwc_minor_sent_to == '2' || $cp_one_cwc_minor_sent_to == '3'){
    //   $config_five = array(
    //     array(
    //       'field' => 'cp_one_cwc_district',
    //       'label' => '<b>District</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_block',
    //       'label' => '<b>SD/Block</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_address',
    //       'label' => '<b>Address</b>',
    //       'rules' => 'trim|required|is_title_validation'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_remarks',
    //       'label' => '<b>Remarks</b>',
    //       'rules' => 'trim|is_script_validate'
    //     ),
    //   );
    // }

    // if($cp_one_cwc_minor_sent_to == '4'){
    //   $config_six = array(
    //     array(
    //       'field' => 'cp_one_cwc_case_no',
    //       'label' => '<b>Case No</b>',
    //       'rules' => 'trim|required|alpha_numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_case_date',
    //       'label' => '<b>Date</b>',
    //       'rules' => 'trim|required'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_district',
    //       'label' => '<b>District</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_block',
    //       'label' => '<b>SD/Block</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_cci',
    //       'label' => '<b>CCI</b>',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'cp_one_cwc_remarks',
    //       'label' => '<b>Remarks</b>',
    //       'rules' => 'trim|is_script_validate'
    //     ),
    //   );
    // }

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
        // array(
        //   'field' => 'cp_two_cwc_minor_sent_to',
        //   'label' => '<b>Minor Sent to</b>',
        //   'rules' => 'trim|required|numeric'
        // ),
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

      // if($cp_two_cwc_minor_sent_to == '1' || $cp_two_cwc_minor_sent_to == '2' || $cp_two_cwc_minor_sent_to == '3'){
      //   $config_nine = array(
      //     array(
      //       'field' => 'cp_two_cwc_district',
      //       'label' => '<b>District</b>',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_block',
      //       'label' => '<b>SD/Block</b>',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_address',
      //       'label' => '<b>Address</b>',
      //       'rules' => 'trim|required|is_title_validation'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_remarks',
      //       'label' => '<b>Remarks</b>',
      //       'rules' => 'trim|is_script_validate'
      //     ),
      //   );
      // }

      // if($cp_two_cwc_minor_sent_to == '4'){
      //   $config_ten = array(
      //     array(
      //       'field' => 'cp_two_cwc_case_no',
      //       'label' => '<b>Case No</b>',
      //       'rules' => 'trim|required|alpha_numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_case_date',
      //       'label' => '<b>Date</b>',
      //       'rules' => 'trim|required'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_district',
      //       'label' => '<b>District</b>',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_block',
      //       'label' => '<b>SD/Block</b>',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_cci',
      //       'label' => '<b>CCI',
      //       'rules' => 'trim|required|numeric'
      //     ),
      //     array(
      //       'field' => 'cp_two_cwc_remarks',
      //       'label' => '<b>Remarks</b>',
      //       'rules' => 'trim|is_script_validate'
      //     ),
      //   );
      // }
    }
    $config_cp_age = array();
     if($cp_two_is_available ==''|| $cp_two_is_available =='2')
    {
      $config_cp_age = array(
      array(
          'field' => 'cp_one_age',
          'label' => '<b>Age</b>',
          'rules' => 'trim|required|callback_check_cp1_age'
        )
        );
    }
    else if($cp_two_is_available =='1')
    {
      $config_cp_age = array(
      array(
          'field' => 'cp_one_age',
          'label' => '<b>Age</b>',
          'rules' => 'trim|required|callback_validate_below_either_18'
        ), 
      array(
          'field' => 'cp_two_age',
          'label' => '<b>Age</b>',
          'rules' => 'trim|required|callback_validate_below_either_18'
        )
      );
    }

    $config = array_merge($config_one, $config_two, $config_three, $config_four, $config_seven, $config_eight, $config_eleven, $config_twelve, $config_Thirteen,$config_cp_age);
    $this->form_validation->set_rules($config);

    if ($this->form_validation->run() == TRUE) {
        $data['validation_error_count'] = "0";
        $result = $this->incident_form_model->update_incident_draft_reporting_details($incident_id);
        if($result == 0)
        {
          $this->db->trans_commit();
          $this->session->set_flashdata('success', 'Incident report data successful updated.');
          redirect('admin/reporting/incident/incident_list');
        }
        else
        {
          $this->db->trans_rollback();
           $this->session->set_flashdata('warning', 'Incident report data updation failed. Please try again.');
          redirect('admin/reporting/incident/incident_list');
        }
    }else{
        $error_count = count($this->form_validation->error_array());
        $data['validation_error_count'] = ($error_count)? $error_count: '';
        $this->session->set_flashdata('error', 'Something went wrong. please check errors');
    }

    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);

    //echo '<pre>';print_r($incident_edit_details);die();
    $data['state'] = $this->Master_model->get_state_name();
    $data['districts'] = $this->Master_model->get_district();
    $data['districts_name'] = $this->Master_model->get_district_name($this->session->userdata('district'));
    $data['block_name'] = $this->Master_model->get_block_name($this->session->userdata('block'));
    $data['block_details_name'] = $this->Master_model->get_block($this->session->userdata('district'));




   $data['incident_block'] = $incident_block = ($incident_edit_details)?$incident_edit_details['block']:NULL;
    $data['Incident_Ward_Gp_Block'] = $Incident_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($incident_block);
    if(!empty($Incident_Ward_Gp_Block)){
      if($Incident_Ward_Gp_Block->rural_urban == 'U'){
        $data['Incident_Ward'] = $this->Master_model->get_ward($incident_block);
      }else{
        $data['Incident_Gp'] = $this->Master_model->get_gp($incident_block);
      }
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
    $data['block_details'] = $this->Master_model->block();
    $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
    $incident_district = $this->input->post('incident_district');
    $data['incidentBlock'] = $this->Master_model->get_block($incident_district);
    $identity_district = $this->input->post('identity_district');


    // $data['identityBlock'] = $this->Master_model->get_block($identity_district);
    $data['identityBlock'] = ($this->Master_model->get_block($identity_district))?$this->Master_model->get_block($identity_district):array();
    $identity_block = $this->input->post('identity_block');
    $data['Identity_Ward_Gp_Block'] = $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($identity_block);
    if(!empty($Identity_Ward_Gp_Block)){
      if($Identity_Ward_Gp_Block->rural_urban == 'U'){
        $data['Identity_Ward'] = $this->Master_model->get_ward($identity_block);
      }else{
        $data['Identity_Gp'] = $this->Master_model->get_gp($identity_block);
      }
    }

    if($this->input->post('cp_one_state')!='')
    {
      $cp_one_state = $this->input->post('cp_one_state');
      $data['CP_One_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_one_state);
    }
    else
    {
      $data['CP_One_District_Details'] = array();

    }
    $cp_one_district = $this->input->post('cp_one_district');
    $data['cponeBlock'] = ($this->Master_model->get_block($cp_one_district))?$this->Master_model->get_block($cp_one_district):array();
    // $data['cponeBlock'] = $this->Master_model->get_block($cp_one_district);
    $cp_one_block = $this->input->post('cp_one_block');
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

    if($this->input->post('cp_two_state')!='')
    {
      $cp_two_state = $this->input->post('cp_two_state');
      $data['CP_Two_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_two_state);
    }
    else
    {
      $data['CP_Two_District_Details'] = array();

    }
    if($this->input->post('cp_two_district')!='')
    {
      $cp_two_district = $this->input->post('cp_two_district');
      $data['cptwoBlock'] = $this->Master_model->get_block($cp_two_district);
    }
    {
      $data['cptwoBlock'] = array();

    }
    // $cp_two_block = $this->input->post('cp_two_block');
    $cp_two_block = $this->input->post('cp_two_block');

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
    $this->load->view($this->config->item('theme').'reporting/incident/incident_draft_form_edit_view', $data);
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
  public function check_cp1_age($age) {
        
        if ($age >= 18) {
            $this->form_validation->set_message('check_cp1_age', 'The age of contracting party one should be less then 18 if the contracting party two in not available');
            return FALSE;
        } else {
            return TRUE;
        }
    }

  public function validate_below_either_18($cp_two_age, $cp_one_age)
  {
    $cp_one_age = $this->input->post('cp_one_age');
    $cp_two_age = $this->input->post('cp_two_age');
    if (($cp_one_age >= 18 && $cp_two_age >= 18)) 
    {
      $this->form_validation->set_message('validate_below_either_18', 'The age of contracting party one or contracting party two should be less then 18');
      return FALSE;
    }
      return TRUE;
  }


//Validate state field
  public function validate_state($state)
  {
     // echo $state;die; 
      // echo $block."------------".strlen($block);die;
    $max_length = 2;
    if(empty($state))
    {
      $this->form_validation->set_message('validate_state', 'The {field} field is required.');
      return FALSE;
    }
    else if(!is_numeric($state))
    {
      $this->form_validation->set_message('validate_state', 'The {field} field is non-numeric.');
      return FALSE;
    }
    else if($state > $max_length)
    {
      $this->form_validation->set_message('validate_state', 'The {field} no cannot exceed '.$max_length.' characters.');
        return FALSE;
    }
    else
    {
        return TRUE;
     
    }
  }

//Validate district field
  public function validate_district($district)
  {
      // echo $district."------------".strlen($district);die;
    $max_length = 2;
    if(empty($district))
    {
      $this->form_validation->set_message('validate_district', 'The {field} field is required.');
      return FALSE;
    }
    else if(!is_numeric($district))
    {
      $this->form_validation->set_message('validate_district', 'The {field} field is non-numeric.');
      return FALSE;
    }
    else if(strlen($district) > $max_length)
    {
      $this->form_validation->set_message('validate_district', 'The {field} no cannot exceed '.$max_length.' characters.');
        return FALSE;
    }
    else
    {
      // echo $block."------------".strlen($block);die; 
      $result = $this->Master_model->get_district_name($district);
      // echo "<pre>"; print_r($result);die;
      if(empty($result))
      {
        $this->form_validation->set_message('validate_district', 'The {field} field is invalid');
        return FALSE;
      }
      else
      {
        return TRUE;
      }      
    }
  }

//Validate block field
  public function validate_block($block)
  {
    // echo $block."------------".strlen($block);die;
    $max_length = 4;
    if(empty($block))
    {
      $this->form_validation->set_message('validate_block', 'The <b>Block Name</b> field is required.');
      return FALSE;
    }
    else if(!is_numeric($block))
    {
      $this->form_validation->set_message('validate_block', 'The <b>Block Name</b> field is non-numeric.');
      return FALSE;
    }
    else if(strlen($block) > $max_length)
    {
      $this->form_validation->set_message('validate_block', 'The {field} no cannot exceed '.$max_length.' characters.');
        return FALSE;
    }
    else
    {
      // echo $block."------------".strlen($block);die; 
      $result = $this->Master_model->get_block_name($block);
      if(empty($result))
      {
        $this->form_validation->set_message('validate_block', 'The <b>Block Name</b> field is invalid');
        return FALSE;
      }
      else
      {
        return TRUE;
      }      
    }
  }


//Validate ward field
  public function validate_ward_gp($ward_gp,$block)
  {
    // echo $block_id; die;
    // echo "<pre>";print_r($data);die;
    // echo $ward_gp."-------------".$block_id; die;
    // echo $ward_gp."------------".strlen($ward_gp);die;
    $max_length = 4;
    if(empty($ward_gp))
    {
      $this->form_validation->set_message('validate_ward_gp', 'The {field} field is required.');
      return FALSE;
    }
    else if(!is_numeric($ward_gp))
    {
      $this->form_validation->set_message('validate_ward_gp', 'The {field} field is non-numeric.');
      return FALSE;
    }
    else if(strlen($ward_gp) > $max_length)
    {
      $this->form_validation->set_message('validate_ward_gp', 'The {field} no cannot exceed '.$max_length.' characters.');
        return FALSE;
    }
    else
    {
      // echo $ward_gp."------------".strlen($ward_gp);die; 
      // $block_id1 =  validate_block($block_id);
      // echo  $block_id1; die;
      if(!empty($block) && is_numeric($block) && (strlen($block) < 5))
      {
        $block_id = $block;
      }
      else
      {
        $block_id = 0;
      }
        $result = $this->Master_model->get_ward_gp_block($block_id);
        if(empty($result)){
          $this->form_validation->set_message('validate_ward_gp', 'The {field} field is invalid');
           return FALSE;
        }else{
          $rural_urban = $result->rural_urban;
        // $result_ward_gp = '';
        if($rural_urban =='U')
        {
          $result_ward_gp = $this->Master_model->Get_ward_by_wardid($ward_gp);
        }
        else
        {
          $result_ward_gp = $this->Master_model->Get_gp_by_gpid($ward_gp);
        }
        // echo "<pre>";print_r($result_ward_gp);die;      
        // $block_id = $this->input->post();
        // $result = $this->Master_model->get_ward_gp_name($ward_gp);
      if(empty($result_ward_gp))
      {
        $this->form_validation->set_message('validate_ward_gp', 'The {field} field is invalid');
        return FALSE;
      }
    
      else
      {
        return TRUE;
      } 
        }


             
    }
  }

  //check whether incident id exist or not
  public function check_incident_id($incident_id=NULL,$current_status=NULL)
  {
    $incident_id = base64_decode($incident_id);
    // echo $incident_id."....................".$current_status;die;
    if($incident_id!='' && is_numeric($incident_id))
    { 
      $incident_info = get_incident_info($incident_id,$current_status);
      return $incident_info;
    }
    return FALSE;
  }

}
