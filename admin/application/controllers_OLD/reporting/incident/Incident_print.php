<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_print extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('incident/Incident_print_model');
    $this->load->model('common/Master_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
      2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
      3 => $this->config->item('theme_uri').'assets/js/incident_form.js',
    );
  }

  public function list_print()
  {
    //echo "hello";die();
    $start_date = isset($_GET['start_date'])?$this->us_date_format($_GET['start_date']):'';
    $end_date = isset($_GET['end_date'])?$this->us_date_format($_GET['end_date']):'';


    // echo $start_date.'----------'.$end_date;die;
    if($this->session->userdata('district')!='')
    {
      $incident_district = $this->Master_model->get_district_name($this->session->userdata('district'));
      $data['user_dist']=" - ".$incident_district->district_name;
    }
    else
    {
      $data['user_dist'] = '';
    }
    // print_r($data['user_dist']);die;
    $data['start_date'] = isset($_GET['start_date'])?$_GET['start_date']:'';
    $data['end_date'] = isset($_GET['end_date'])?$_GET['end_date']:'';

    if(empty($start_date) || empty($end_date)){
      $data['Incident_Print_Data'] = $this->Incident_print_model->incident_list_print_details();
    }else{
      $data['Incident_Print_Data'] = $this->Incident_print_model->incident_list_print_btwndate_details($start_date,$end_date);


    }
    // echo "<pre>";print_r($data);die;
     // $data['Incident_Print_Data'] = array();
      // $data = array();
    // echo"<pre>";print_r($data);die;
     $html = $this->load->view($this->config->item('theme').'reporting/incident/Incident_Generated_List_Print_View', $data);
  }

  public function print_incident($incident_id)
  {
    $login_id = $this->session->userdata('login_id');
    $incident_id = base64_decode($incident_id);
    if($this->session->userdata('district')!='')
    {
      $incident_district = $this->Master_model->get_district_name($this->session->userdata('district'));
      $data['user_dist']=" - ".$incident_district->district_name;
    }
    else
    {
      $data['user_dist'] = '';
    }
    $data['local_persons_involved'] = $this->Incident_print_model->cm_incident_report_local_persons_involved_details($incident_id);
    $data['officials_involved'] = $this->Incident_print_model->cm_incident_report_officials_involved_details($incident_id);
    //$data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['incident_edit_details']=$incident_edit_details= $this->Incident_print_model->incident_print_details($incident_id);
    // echo '<pre>';print_r($incident_edit_details);die();
    $data['state'] = $this->Master_model->get_state_name();
    $data['districts'] = $this->Master_model->get_district();
    $data['districts_name'] = $this->Master_model->get_district_name($this->session->userdata('district'));
    $data['block_name'] = $this->Master_model->get_block_name($this->session->userdata('block'));
    $data['block_details_name'] = $this->Master_model->get_block($this->session->userdata('district'));
    $incident_block = ($incident_edit_details)?$incident_edit_details['block']:NULL;
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
    $data['identityBlock'] = $this->Master_model->get_block($identity_district);
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
    $data['CP_One_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_one_state);
    $cp_one_district = ($incident_edit_details)?$incident_edit_details['cp_1_district_id']:NULL;
    $data['cponeBlock'] = $this->Master_model->get_block($cp_one_district);
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
    $data['cptwoBlock'] = $this->Master_model->get_block($cp_two_district);
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
      $html = $this->load->view($this->config->item('theme').'reporting/incident/Incident_Generated_Print_View', $data);
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
}
