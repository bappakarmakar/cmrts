<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Incident_list extends NIC_Controller {
        
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('incident/incident_list_model');
    $this->load->model('incident/incident_form_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->load->model('Intervention_message_model');
    $this->load->model('police_case/Police_case_model');
 
    $this->css_head = array(
     1 => $this->config->item('theme_uri').'assets/datepicker/css/jquery-ui.css',
     //2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
 
    );
    $this->js_foot = array(
      // 1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
      // 3 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/incident_form_updated1.js',
    ); 
  }

  public function index() 
  {
      //echo "hello";die;
     set_time_limit(0);
     ini_set('memory_limit', '-1');
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
     $data['state'] = $this->Master_model->get_state_name();
     $data['districts'] = $this->Master_model->get_district();
     $data['minor_details'] = $this->Master_model->get_minor_details();
     $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
     $data['reason'] = $this->incident_list_model->cm_police_case_reason();
     $data['incident_details'] = $this->incident_list_model->incident_list_reporting_details();  
 
     $data['police_station'] = $this->Police_case_model->police_station(); 
     // echo '<pre>';print_r($data['incident_details']);die;
     $this->load->view($this->config->item('theme').'reporting/incident/incident_list_view', $data);  
  } 
   
  // Get Police district Data against by District Data
  public function get_police_district(){
    $district_id = $this->input->get('district_id');
    $police_data = $this->incident_list_model->get_police_district($district_id);
    echo json_encode($police_data);
  }

  // Get Police Station Data 
  public function get_police_station(){
    $police_district_id = $this->input->get('police_district_id');
    $police_station_data = $this->incident_list_model->get_police_station_data($police_district_id);
    // print_r($police_station_data);die;
    echo json_encode($police_station_data);
  }

  // Get Block and municipality by selected district
  public function get_block_municipality(){
      $district_id = $this->input->get('district_id');
      $block = $this->Master_model->get_block($district_id);
      echo json_encode($block);
  }

  // Get ward by selected block/municipality
  public function get_ward_data(){
    $block_id  = $this->input->get('block_id');
    $word_data = $this->Master_model->get_ward($block_id);
    echo json_encode($word_data);
  }
  // Get ward by selected block/municipality
  public function get_gp_data(){
    $block_id = $this->input->get('block_id');
    $gp_data  = $this->Master_model->get_gp($block_id);
    echo json_encode($gp_data);
  }

  public function verify_intervention_id(){
    $intervention_id = $this->input->get('intervention_id');
    $is_verifyed = $this->incident_list_model->intervention_verified($intervention_id);
  }

  // public function forward_bdo()
  // {
  //    $incident_id = $this->input->get('incident_id');
  //    $result = $this->incident_list_model->forward_reporting_details_update($incident_id);
  //    print_r($result);
  // }  

  public function publish_deo()
  {
    $incident_id = $this->input->get('incident_id');
    $result = $this->incident_list_model->publish_incident_reporting_details_update($incident_id);
    // 15-01-2025 get district id for piloting
    $district = $this->Intervention_message_model->get_district_id($incident_id);
     
    $result = array(
      "status" => $result,
      "incident_id" => $incident_id,
      "district_id" => $district
    );
    echo json_encode($result);
  }

  public function Get_Cp_Gender_Details()
  {
    $minor_details_gender_value = $this->input->get('minor_details_gender_value');
    $district_value = $this->input->get('district_value');
    $incident_id = base64_decode($this->input->get('incident_id'));
    // $incident_id = base64_decode($this->input->get('incident_id'));
    // echo $incident_id; die;
    if($minor_details_gender_value == '1'){
      $cp_gender = $this->incident_list_model->cp_one_gender_value($incident_id);
      $cci_result = $this->incident_list_model->cp_cci_value($district_value, $cp_gender);
    }else{
      $cp_gender = $this->incident_list_model->cp_two_gender_value($incident_id);
      $cci_result = $this->incident_list_model->cp_cci_value($district_value, $cp_gender);
    }
    echo json_encode($cci_result);
  }

  public function Transfer_CCI_To_CMPO()
  {
    $incident_id = $this->input->get('incident_id');
    $result = $this->incident_list_model->Update_Transfer_CCI_Details($incident_id);
  }

  public function getBlockById()
  {
      $district_id=$this->input->get('id');
      $block = $this->Master_model->get_block($district_id);
      echo json_encode($block);
  }

  public function Get_Address_Change($incident_id)
  {
    $incident_id = base64_decode($incident_id);
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config = array(
      array(
        'field' => 'minor_details',
        'label' => 'Minor Details',
        'rules' => 'trim|required'
      ),
      array(
        'field' => 'minor_sent',
        'label' => 'Minor Sent to',
        'rules' => 'trim|required'
      ),
    );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['districts'] = $this->Master_model->get_district();
        $data['minor_details'] = $this->Master_model->get_minor_details();
        $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
        $data['incident_details'] = $this->incident_list_model->incident_list_reporting_details();
        $this->load->view($this->config->item('theme').'reporting/incident/address_change_form_view', $data);
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
          'transfer_status' => 101
        );
        $result = $this->incident_list_model->insert_address_change_details($uploaded, $minor_details);
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

   public function incident_view_details(){
     $incident_id_pk = $_GET['incident_id_pk'];
     $incident_id_pk = base64_decode($incident_id_pk);
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

    $data['incident_details']=$incident_details= $this->incident_list_model->incident_list_reporting_details_by_incident_id($incident_id_pk);

    $this->load->view($this->config->item('theme').'reporting/incident/ajax/incident_details_view', $data);
  }

  public function dateSearch()
  {
    $start_date = $this->us_date_format($this->input->get('start_date'));
    $end_date = $this->us_date_format($this->input->get('end_date'));
    if($start_date!= '' && $end_date != '')
    {
      $data['incident_details'] = $this->incident_list_model->dateSearchBetweenDates($start_date, $end_date);
      $this->load->view($this->config->item('theme').'reporting/incident/advanced_search_view', $data);
    }
  }

  public function delete_incident()
  {
     $incident_id = $this->input->get('incident_id');
     $result = $this->incident_list_model->delete_incident_list($incident_id);
     echo json_encode($result);
     
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

  // Intervention Publish Message Send 
  public function intervention_message(){

    $incident_id = $this->input->get('incident_id');

    $intcident_data = $this->Intervention_message_model->get_incident_details($incident_id);

    $cp1_data = $this->Intervention_message_model->cp1_data($incident_id);
    $cp2_data = $this->Intervention_message_model->cp2_data($incident_id);

    // $intcident = $intcident_data[0];
    // $cp1 = $cp1_data[0];
    // $cp2 = $cp2_data[0];

    $intcident = !empty($intcident_data) ? $intcident_data[0] : null;
    $cp1 = !empty($cp1_data) ? $cp1_data[0] : null;
    $cp2 = !empty($cp2_data) ? $cp2_data[0] : null;


    //echo "<pre>";
    // print_r($intcident);
    //print_r($cp1);
    // print_r($cp2);

    // Intervention district name
    $int_district = $this->Intervention_message_model->district_name($intcident['district']);
    $incident_district = $int_district['district_name'];

    // Intervention Block/Municipality Name
    $int_block_municipality = $this->Intervention_message_model->block_municipal($intcident['district'], $intcident['block']);
    $int_block_munici_name = $int_block_municipality['block_name'];

    // CP1 District name
    $cp1_district =$this->Intervention_message_model->district_name($cp1['cp_district']);
    // CP1 Block/Municipality Name
    $cp1_block_municipality = $this->Intervention_message_model->block_municipal($cp1['cp_district'], $cp1['cp_block']);

    if (!empty($cp1_block_municipality) && isset($cp1_block_municipality['block_name']))
    {
      $cp1_block_muni = $cp1_block_municipality['block_name'];
    }

    //CP2 District Name
    if (isset($cp2['cp_district'])) {
      $cp2_district_name = $this->Intervention_message_model->district_name($cp2['cp_district']);
    }

    // CP1 Block/Municipality Name
    if(isset($cp2['cp_district']) && isset($cp2['cp_block'])){
      $cp2_block_municipality = $this->Intervention_message_model->block_municipal($cp2['cp_district'], $cp2['cp_block']);
      $cp2_block_muni = $cp2_block_municipality['block_name'];
    }

    // CP1 GP and ward Name
    $cp1_gp_ward =$this->Intervention_message_model->cp_gp_ward($cp1['cp_district'], $cp1['cp_block'], $cp1['cp_ward_gp']);

    // CP2 GP and ward Name
    if(isset($cp2['cp_district']) && isset($cp2['cp_block']) && isset($cp2['cp_ward_gp']) )
    {
      $cp2_gp_ward =$this->Intervention_message_model->cp_gp_ward($cp2['cp_district'], $cp2['cp_block'], $cp2['cp_ward_gp']);
    }

    // echo "<pre>";
    // print_r($cp1_gp_ward);
    // print_r($cp2_gp_ward);

    // CP1 Minor/Adult
    if($cp1['cp_age']<'18'){
      $cp1_age = 'minor';
    }else if($cp1['cp_age']>='18'){
      $cp1_age = 'adult';
    }
    // CP1 Male/Female
    if($cp1['cp_gender']=='1'){
      $cp1_gender = 'male';
    }else{
      $cp1_gender = 'female';
    }

    // CP2 Minor/Adult
    if (isset($cp2['cp_age']) && $cp2['cp_age'] !== '') {
      if($cp2['cp_age']<'18'){
        $cp2_age = 'minor';
      }else if($cp2['cp_age']>='18'){
        $cp2_age = 'adult';
      }
    } 

    if (isset($cp2['cp_gender']) && $cp2['cp_gender'] !== '') {
        // CP2 Male/Female
        if($cp2['cp_gender']=='1'){
          $cp2_gender = 'male';
        }else{
          $cp2_gender = 'female';
        }
    }
    //echo $cp2_age.'---'.$cp2_gender;die;

    if($intcident['state']=='19'){
      $incident_state = 1;
    }else{
      $incident_state = 2;
    }

      // Intervention Data
      $incident_sdo_bdo_deo_data = $this->Intervention_message_model->Incident_Sdo_Bdo_Deo_details($incident_id);
      $incident_sdo_bdo = $incident_sdo_bdo_deo_data['sdo_bdo_query'];
      $incident_deo = $incident_sdo_bdo_deo_data['deo_query'];

      //echo "<pre>";
      // print_r($incident_sdo_bdo);
      //print_r($incident_deo);
      
      // Intervention CP1 data 
      $cp1_cmpo_data = $this->Intervention_message_model->cp1_cmpo($cp1['cp_district']);
      
      // Intervention CP2 data 
      if( isset($cp2['cp_district']) ){
        $cp2_cmpo_data = $this->Intervention_message_model->cp2_cmpo($cp2['cp_district']);
      }

      // CP1 SDO/BDO and DEO Data
      $cp1_sdo_bdo_deo = $this->Intervention_message_model->cp1_Sdo_Bdo_Deo_details($incident_id);
      
      // CP2 SDO/BDO and DEO Data
      $cp2_sdo_bdo_deo = $this->Intervention_message_model->cp2_Sdo_Bdo_Deo_details($incident_id);

      // echo "<pre>";
      // print_r($cp2_cmpo_data);

      if(!empty($incident_sdo_bdo)){
          $incident_sdo_bdo = array(
                    'reporting_id'  => $intcident['reporting_id'],
                    'incident_date' => $intcident['incident_date'],
                    'incident_district' => $incident_district,
                    'incident_block_municp' => $int_block_munici_name,
                    'login_id' => $incident_sdo_bdo->login_id,
                    'mobile_no'=> $incident_sdo_bdo->mobile_no
                  );
      }

      if(!empty($incident_deo)){
          $incident_deo = array(
                    'reporting_id'  => $intcident['reporting_id'],
                    'incident_date' => $intcident['incident_date'],
                    'incident_district' => $incident_district,
                    'incident_block_municp' => $int_block_munici_name,
                    'login_id' => $incident_deo->login_id,
                    'mobile_no'=> $incident_deo->mobile_no
                  );
      }

      if(!empty($cp1_cmpo_data)){
          $cp1_cmpo = array(
                    'reporting_id'  => $intcident['reporting_id'],
                    'incident_date' => $intcident['incident_date'],
                    'incident_district' => $incident_district,
                    'incident_block_municp' => $int_block_munici_name,
                    'login_id' => $cp1_cmpo_data->login_id,
                    'mobile_no'=> $cp1_cmpo_data->mobile_no
                  );
      }

      if(!empty($cp2_cmpo_data)){
        $cp2_cmpo = array(
                    'reporting_id'  => $intcident['reporting_id'],
                    'incident_date' => $intcident['incident_date'],
                    'incident_district' => $incident_district,
                    'incident_block_municp' => $int_block_munici_name,
                    'login_id' => $cp2_cmpo_data->login_id,
                    'mobile_no'=> $cp2_cmpo_data->mobile_no
                  );
      }
      
      
      if(isset($cp1_gp_ward['block_location_data']['rural_urban']) && !empty($cp1_gp_ward['block_location_data']['rural_urban'])){

          if($cp1_gp_ward['block_location_data']['rural_urban']=='R'){
            $cp1_gp_word = $cp1_gp_ward['gp_ward_query']['gp_name'];
          }else{
            $cp1_gp_word = $cp1_gp_ward['gp_ward_query']['ward_no'];
          }
      }

      if(isset($cp2_gp_ward['block_location_data']['rural_urban']) && !empty($cp2_gp_ward['block_location_data']['rural_urban'])){

          if($cp2_gp_ward['block_location_data']['rural_urban']=='R'){
            $cp2_gp_word = $cp2_gp_ward['gp_ward_query']['gp_name'];
          }else{
            $cp2_gp_word = $cp2_gp_ward['gp_ward_query']['ward_no'];
          }
      }

      if(!empty($cp1_sdo_bdo_deo['cp1_sdo_bdo_query']->mobile_no)){
        $cp1_sdo_bdo = array(
                    'reporting_id'  => $intcident['reporting_id'],
                    'incident_date' => $intcident['incident_date'],
                    'incident_district' => $incident_district,
                    'incident_block_municp' => $int_block_munici_name,
                    'cp1_minor_adult' => $cp1_age,
                    'cp1_gender' => $cp1_gender,
                    'cp1_name' => $cp1['cp_name'],
                    'cp1_block_municip' => $cp1_block_muni,
                    'cp1_gp_ward' => $cp1_gp_word,
                    'login_id' =>$cp1_sdo_bdo_deo['cp1_sdo_bdo_query']->login_id,
                    'mobile_no'=>$cp1_sdo_bdo_deo['cp1_sdo_bdo_query']->mobile_no
                  );
      }else{
        $cp1_sdo_bdo = array();
      }

      if(!empty($cp1_sdo_bdo_deo['cp1_deo_query']->mobile_no)){

        $cp1_deo = array(
                    'reporting_id'  => $intcident['reporting_id'],
                    'incident_date' => $intcident['incident_date'],
                    'incident_district' => $incident_district,
                    'incident_block_municp' => $int_block_munici_name,
                    'cp1_minor_adult' => $cp1_age,
                    'cp1_gender' => $cp1_gender,
                    'cp1_name' => $cp1['cp_name'],
                    'cp1_block_municip' => $cp1_block_muni,
                    'cp1_gp_ward' => $cp1_gp_word,
                    'login_id' =>$cp1_sdo_bdo_deo['cp1_deo_query']->login_id,
                    'mobile_no'=>$cp1_sdo_bdo_deo['cp1_deo_query']->mobile_no
                  );
      }else{
        $cp1_deo = array();
      }

      // echo '~~~~'.$cp2_sdo_bdo_deo['cp2_sdo_bdo_query']->mobile_no;die;

      if(!empty($cp2_sdo_bdo_deo['cp2_sdo_bdo_query']->mobile_no)){

        $cp2_sdo_bdo = array(
                    'reporting_id'  => $intcident['reporting_id'],
                    'incident_date' => $intcident['incident_date'],
                    'incident_district' => $incident_district,
                    'incident_block_municp' => $int_block_munici_name,
                    'cp2_minor_adult' => $cp2_age,
                    'cp2_gender' => $cp2_gender,
                    'cp2_name' => $cp2['cp_name'],
                    'cp2_block_municip' => $cp2_block_muni,
                    'cp2_gp_ward' => $cp2_gp_word,
                    'login_id' =>$cp2_sdo_bdo_deo['cp2_sdo_bdo_query']->login_id, 
                    'mobile_no'=>$cp2_sdo_bdo_deo['cp2_sdo_bdo_query']->mobile_no
                  );
      }else {
        $cp2_sdo_bdo = array(); // Define as an empty array
      }

      if(!empty($cp2_sdo_bdo_deo['cp2_deo_query']->mobile_no)){

          $cp2_deo = array(
                  'reporting_id'  => $intcident['reporting_id'],
                  'incident_date' => $intcident['incident_date'],
                  'incident_district' => $incident_district,
                  'incident_block_municp' => $int_block_munici_name,
                  'cp2_minor_adult' => $cp2_age,
                  'cp2_gender' => $cp2_gender,
                  'cp2_name' => $cp2['cp_name'],
                  'cp2_block_municip' => $cp2_block_muni,
                  'cp2_gp_ward' => $cp2_gp_word,
                  'login_id' =>$cp2_sdo_bdo_deo['cp2_deo_query']->login_id,
                  'mobile_no'=>$cp2_sdo_bdo_deo['cp2_deo_query']->mobile_no
                );
        }else{
          $cp2_deo = array();
        }

        $sno_msg = array(
                    'reporting_id'  => $intcident['reporting_id'],
                    'incident_date' => $intcident['incident_date'],
                    'incident_district' => $incident_district,
                    'incident_block_municp' => $int_block_munici_name,
                    'cp1_minor_adult' => $cp1_age,
                    'cp1_gender' => $cp1_gender,
                    'cp1_name' => $cp1['cp_name']
                  );

      // echo "<pre>";
      // print_r($cp2_sdo_bdo);
      
      // print_r($cp2_deo);
        // die;

    // Message Section 
    //CASE 1: Intervention, CP1, and CP2 are three different addresses.
    if( 
        isset($cp1) && is_array($cp1) && 
        isset($cp2) && is_array($cp2) && 
        isset($cp1['cp_district']) && !empty($cp1['cp_district']) && 
        isset($cp2['cp_district']) && !empty($cp2['cp_district']) && 
        $intcident['district']!=$cp1['cp_district'] && 
        $intcident['district']!=$cp2['cp_district'] && 
        $cp1['cp_district']!=$cp2['cp_district']
      ){

      // echo "CASE 1";die;

        // Intervention Location SDO/BDO and DEO msg sent
        if(!empty($incident_sdo_bdo)){

          $incident_sdo_bdo['is_used_for'] = 301; 
          $data['msg_response'] = $this->msgapi->Msg($incident_sdo_bdo);

          $incident_sdo_bdo_msg_detaisl = array(
            'incident_sdo_bdo_user'=> $incident_sdo_bdo,
            'incident_sdo_bdo_msg_body' => $data['msg_response']
          );
        }else{
          $incident_sdo_bdo_msg_detaisl = array();
        }

        if(!empty($incident_deo)){

          $incident_deo['is_used_for'] = 301; 
          $data['msg_response'] = $this->msgapi->Msg($incident_deo);

          $incident_deo_msg_detaisl = array(
            'incident_deo_user'=> $incident_deo,
            'incident_deo_msg_body' => $data['msg_response']
          );
        }else{
          $incident_deo_msg_detaisl = array();
        }

        if(!empty($cp1_cmpo)){
          // CP1 CMPO msg sent 
          $cp1_cmpo['is_used_for'] = 301; 
          $data['msg_response'] = $this->msgapi->Msg($cp1_cmpo);

          $cp1_cmpo_msg_detaisl = array(
            'cp1_cmpo_send_user'=> $cp1_cmpo,
            'cp1_cmpo_msg_body' => $data['msg_response']
          );
        }else{
          $cp1_cmpo_msg_detaisl = array();
        }

        if(!empty($cp2_cmpo)){
          // CP2 CMPO msg sent
          $cp2_cmpo['is_used_for'] = 301; 
          $data['msg_response'] = $this->msgapi->Msg($cp2_cmpo);

          $cp2_cmpo_msg_detaisl = array(
            'cp2_cmpo_user'=> $cp2_cmpo,
            'cp2_cmpo_msg_body' => $data['msg_response']
          );
        }else{
          $cp2_cmpo_msg_detaisl = array();
        }

        if(!empty($cp1_sdo_bdo)){
          // CP1 SDO/BDO msg sent
          $cp1_sdo_bdo['is_used_for'] = 302;
          $data['msg_response'] = $this->msgapi->Msg($cp1_sdo_bdo);

          $cp1_sdo_bdo_msg_detaisl = array(
            'cp1_sdo_bdo_send_user'=> $cp1_sdo_bdo,
            'cp1_sdo_bdo_msg_body' => $data['msg_response']
          );
        }else{
          $cp1_sdo_bdo_msg_detaisl = array();
        }

        if(!empty($cp1_deo)){
          // CP1 DEO msg sent
          $cp1_deo['is_used_for'] = 302;
          $data['msg_response'] = $this->msgapi->Msg($cp1_deo);

          $cp1_deo_msg_detaisl = array(
            'cp1_deo_send_user'=> $cp1_deo,
            'cp1_deo_msg_body' => $data['msg_response']
          );
        }else{
          $cp1_deo_msg_detaisl = array();
        }

        if(!empty($cp2_sdo_bdo)){
          // CP2 SDO/BDO msg sent
          $cp2_sdo_bdo['is_used_for'] = 303;
          $data['msg_response'] = $this->msgapi->Msg($cp2_sdo_bdo);

          $cp2_sdo_bdo_msg_detaisl = array(
            'cp2_sdo_bdo_user'=> $cp2_sdo_bdo,
            'cp2_sdo_bdo_msg_body' => $data['msg_response']
          );
        }else{
          $cp2_sdo_bdo_msg_detaisl = array();
        }

        if(!empty($cp2_deo)){
          // CP2 DEO msg sent
          $cp2_deo['is_used_for'] = 303;
          $data['msg_response'] = $this->msgapi->Msg($cp2_deo);

          $cp2_deo_msg_detaisl = array(
            'cp2_deo_user'=> $cp2_deo,
            'cp2_deo_msg_body' => $data['msg_response']
          );
        }else{
          $cp2_deo_msg_detaisl = array();
        }

        
        $response = [
            'incident_sdo_bdo_msg_details' => $incident_sdo_bdo_msg_detaisl,
            'incident_deo_msg_details' => $incident_deo_msg_detaisl,
            'cp1_cmpo_msg_details' => $cp1_cmpo_msg_detaisl,
            'cp2_cmpo_msg_details' => $cp2_cmpo_msg_detaisl,
            'cp1_sdo_bdo_msg_details' => $cp1_sdo_bdo_msg_detaisl,
            'cp1_deo_msg_details' => $cp1_deo_msg_detaisl,
            'cp2_sdo_bdo_msg_details' => $cp2_sdo_bdo_msg_detaisl,
            'cp2_deo_msg_details' => $cp2_deo_msg_detaisl
        ];

        echo json_encode($response);

    }

    //CASE 2 : Intervention and CP1 home address are the same, but CP2 home address is different.
    if( 
        isset($cp1) && is_array($cp1) &&
        isset($cp2) && is_array($cp2) &&
        isset($cp1['cp_district']) && !empty($cp1['cp_district']) && 
        isset($cp2['cp_district']) && !empty($cp2['cp_district']) && 
        ($intcident['district']==$cp1['cp_district']) && 
        ($intcident['district']!=$cp2['cp_district']) && 
        ($cp1['cp_district']!=$cp2['cp_district']) 
      ){

    // echo "CASE 2";die;
      

      if(!empty($incident_sdo_bdo)){
        // Intervention Location SDO/BDO msg sent
        $incident_sdo_bdo['is_used_for'] = 301; 
        $data['msg_response'] = $this->msgapi->Msg($incident_sdo_bdo);

        $incident_sdo_bdo_msg_detaisl = array(
            'incident_sdo_bdo_user'=> $incident_sdo_bdo,
            'incident_sdo_bdo_msg_body' => $data['msg_response']
          );
      }else{
        $incident_sdo_bdo_msg_detaisl = array();
      }

      if(!empty($incident_deo)){
        // Intervention Location DEO msg sent
        $incident_deo['is_used_for'] = 301; 
        $data['msg_response'] = $this->msgapi->Msg($incident_deo);

        $incident_deo_msg_detaisl = array(
            'incident_deo_user'=> $incident_deo,
            'incident_deo_msg_body' => $data['msg_response']
          );
      }else{
        $incident_deo_msg_detaisl = array();
      }

      if(!empty($cp2_cmpo)){
        // CP2 CMPO msg sent
        $cp2_cmpo['is_used_for'] = 301; 
        $data['msg_response'] =$this->msgapi->Msg($cp2_cmpo);

         $cp2_cmpo_msg_detaisl = array(
            'cp2_cmpo_user'=> $cp2_cmpo,
            'cp2_cmpo_msg_body' => $data['msg_response']
          );
      }else{
        $cp2_cmpo_msg_detaisl = array();
      }

      if(!empty($cp1_sdo_bdo)){
        // CP1 SDO/BDO msg sent
        $cp1_sdo_bdo['is_used_for'] = 302;
        $data['msg_response'] = $this->msgapi->Msg($cp1_sdo_bdo);

        $cp1_sdo_bdo_msg_detaisl = array(
            'cp1_sdo_bdo_send_user'=> $cp1_sdo_bdo,
            'cp1_sdo_bdo_msg_body' => $data['msg_response']
          );
      }else{
        $cp1_sdo_bdo_msg_detaisl = array();
      }

      if(!empty($cp1_deo)){
        // CP1 DEO msg sent
        $cp1_deo['is_used_for'] = 302;
        $data['msg_response'] = $this->msgapi->Msg($cp1_deo);

        $cp1_deo_msg_detaisl = array(
            'cp1_deo_send_user'=> $cp1_deo,
            'cp1_deo_msg_body' => $data['msg_response']
          );
      }else{
        $cp1_deo_msg_detaisl = array();
      }

      
      if(!empty($cp2_sdo_bdo)){
        // CP2 SDO/BDO msg sent
        $cp2_sdo_bdo['is_used_for'] = 303;
        $data['msg_response'] = $this->msgapi->Msg($cp2_sdo_bdo);

        $cp2_sdo_bdo_msg_detaisl = array(
            'cp2_sdo_bdo_user'=> $cp2_sdo_bdo,
            'cp2_sdo_bdo_msg_body' => $data['msg_response']
          );
      }else{
        $cp2_sdo_bdo_msg_detaisl = array();
      }

      if(!empty($cp2_deo)){
        // CP2 DEO msg sent
        $cp2_deo['is_used_for'] = 303;
        $data['msg_response'] = $this->msgapi->Msg($cp2_deo);

        $cp2_deo_msg_detaisl = array(
            'cp2_deo_user'=> $cp2_deo,
            'cp2_deo_msg_body' => $data['msg_response']
          );
      }else{
        $cp2_deo_msg_detaisl = array();
      }

        $response = [
            'incident_sdo_bdo_msg_details' => $incident_sdo_bdo_msg_detaisl,
            'incident_deo_msg_details' => $incident_deo_msg_detaisl,
            'cp2_cmpo_msg_details' => $cp2_cmpo_msg_detaisl,
            'cp1_sdo_bdo_msg_details' => $cp1_sdo_bdo_msg_detaisl,
            'cp1_deo_msg_details' => $cp1_deo_msg_detaisl,
            'cp2_sdo_bdo_msg_details' => $cp2_sdo_bdo_msg_detaisl,
            'cp2_deo_msg_details' => $cp2_deo_msg_detaisl
        ];

        echo json_encode($response);
        
    }

    // CASE 3 : Intervention and CP2 home address are the same, but CP1 home address is different.
    if( 
        isset($cp1) && is_array($cp1) && 
        isset($cp2) && is_array($cp2) && 
        isset($cp1['cp_district']) && !empty($cp1['cp_district']) && 
        isset($cp2['cp_district']) && !empty($cp2['cp_district']) && 
        isset($intcident['district']) &&
        $intcident['district']!=$cp1['cp_district'] && 
        $intcident['district']==$cp2['cp_district'] && 
        $cp1['cp_district']!=$cp2['cp_district']  
      ){

      // echo "CASE 3";die;

          if(!empty($incident_sdo_bdo)){
            // Intervention Location SDO/BDO msg sent
            $incident_sdo_bdo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($incident_sdo_bdo);

            $incident_sdo_bdo_msg_detaisl = array(
                'incident_sdo_bdo_user'=> $incident_sdo_bdo,
                'incident_sdo_bdo_msg_body' => $data['msg_response']
              );
          }else{
            $incident_sdo_bdo_msg_detaisl = array();
          }


          if(!empty($incident_deo)){
            // Intervention Location DEO msg sent
            $incident_deo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($incident_deo);

            $incident_deo_msg_detaisl = array(
                'incident_deo_user'=> $incident_deo,
                'incident_deo_msg_body' => $data['msg_response']
              );
          }else{
            $incident_deo_msg_detaisl = array();
          }

          if(!empty($cp1_cmpo)){
            // CP1 CMPO msg sent
            $cp1_cmpo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($cp1_cmpo);

            $cp1_cmpo_msg_detaisl = array(
                'cp1_cmpo_send_user'=> $cp1_cmpo,
                'cp1_cmpo_msg_body' => $data['msg_response']
              );
          }else{
            $cp1_cmpo_msg_detaisl = array();
          }

          if(!empty($cp1_sdo_bdo)){
            // CP1 SDO/BDO msg sent
            $cp1_sdo_bdo['is_used_for'] = 302;
            $data['msg_response'] = $this->msgapi->Msg($cp1_sdo_bdo);

            $cp1_sdo_bdo_msg_detaisl = array(
                'cp1_sdo_bdo_send_user'=> $cp1_sdo_bdo,
                'cp1_sdo_bdo_msg_body' => $data['msg_response']
            );
          }else{
            $cp1_sdo_bdo_msg_detaisl = array();
          }

          if(!empty($cp1_deo)){
            // CP1 DEO msg sent
            $cp1_deo['is_used_for'] = 302;
            $data['msg_response'] = $this->msgapi->Msg($cp1_deo);

            $cp1_deo_msg_detaisl = array(
                'cp1_deo_send_user'=> $cp1_deo,
                'cp1_deo_msg_body' => $data['msg_response']
            );
          }else{
            $cp1_deo_msg_detaisl = array();
          }

          if(!empty($cp2_sdo_bdo)){
            // CP2 SDO/BDO msg sent
            $cp2_sdo_bdo['is_used_for'] = 303;
            $data['msg_response'] = $this->msgapi->Msg($cp2_sdo_bdo);

            $cp2_sdo_bdo_msg_detaisl = array(
                'cp2_sdo_bdo_user'=> $cp2_sdo_bdo,
                'cp2_sdo_bdo_msg_body' => $data['msg_response']
            );
          }else{
            $cp2_sdo_bdo_msg_detaisl = array();
          }

          if(!empty($cp2_deo)){
            // CP2 DEO msg sent
            $cp2_deo['is_used_for'] = 303;
            $data['msg_response'] = $this->msgapi->Msg($cp2_deo);

            $cp2_deo_msg_detaisl = array(
                'cp2_deo_user'=> $cp2_deo,
                'cp2_deo_msg_body' => $data['msg_response']
            );
          }else{
            $cp2_deo_msg_detaisl = array();
          }


        $response = [
            'incident_sdo_bdo_msg_details' => $incident_sdo_bdo_msg_detaisl,
            'incident_deo_msg_details' => $incident_deo_msg_detaisl,
            'cp1_cmpo_msg_details' => $cp1_cmpo_msg_detaisl,
            'cp1_sdo_bdo_msg_details' => $cp1_sdo_bdo_msg_detaisl,
            'cp1_deo_msg_details' => $cp1_deo_msg_detaisl,
            'cp2_sdo_bdo_msg_details' => $cp2_sdo_bdo_msg_detaisl,
            'cp2_deo_msg_details' => $cp2_deo_msg_detaisl
        ];

        echo json_encode($response);

    }
    // CASE 4 : Intervention, CP1 and CP2 three home address are the same.
    if( 
        isset($cp1) && is_array($cp1) && 
        isset($cp2) && is_array($cp2) && 
        isset($cp1['cp_district']) && !empty($cp1['cp_district']) && 
        isset($cp2['cp_district']) && !empty($cp2['cp_district']) && 
        ($intcident['district']==$cp1['cp_district']) && 
        ($intcident['district']==$cp2['cp_district']) && 
        ($cp1['cp_district']==$cp2['cp_district']) 
      ){

      // echo "CASE 4";die;

          if(!empty($incident_sdo_bdo)){
            // Intervention Location SDO/BDO msg sent
            $incident_sdo_bdo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($incident_sdo_bdo);

            $incident_sdo_bdo_msg_detaisl = array(
                'incident_sdo_bdo_user'=> $incident_sdo_bdo,
                'incident_sdo_bdo_msg_body' => $data['msg_response']
              );
          }else{
            $incident_sdo_bdo_msg_detaisl = array();
          }

          if(!empty($incident_deo)){
            // Intervention Location DEO msg sent
            $incident_deo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($incident_deo);

            $incident_deo_msg_detaisl = array(
                'incident_deo_user'=> $incident_deo,
                'incident_deo_msg_body' => $data['msg_response']
              );
          }else{
            $incident_deo_msg_detaisl = array();
          }

          if(!empty($cp1_sdo_bdo)){
            // CP1 SDO/BDO msg sent
            $cp1_sdo_bdo['is_used_for'] = 302;
            $data['msg_response'] = $this->msgapi->Msg($cp1_sdo_bdo);

            $cp1_sdo_bdo_msg_detaisl = array(
                'cp1_sdo_bdo_send_user'=> $cp1_sdo_bdo,
                'cp1_sdo_bdo_msg_body' => $data['msg_response']
            );
          }else{
            $cp1_sdo_bdo_msg_detaisl = array();
          }

          if(!empty($cp1_deo)){
            // CP1 DEO msg sent
            $cp1_deo['is_used_for'] = 302;
            $data['msg_response'] = $this->msgapi->Msg($cp1_deo);

            $cp1_deo_msg_detaisl = array(
                'cp1_deo_send_user'=> $cp1_deo,
                'cp1_deo_msg_body' => $data['msg_response']
            );
          }else{
            $cp1_deo_msg_detaisl = array();
          }

          if(!empty($cp2_sdo_bdo)){
            // CP2 SDO/BDO msg sent
            $cp2_sdo_bdo['is_used_for'] = 303;
            $data['msg_response'] = $this->msgapi->Msg($cp2_sdo_bdo);

            $cp2_sdo_bdo_msg_detaisl = array(
                'cp2_sdo_bdo_user'=> $cp2_sdo_bdo,
                'cp2_sdo_bdo_msg_body' => $data['msg_response']
            );
          }else{
            $cp2_sdo_bdo_msg_detaisl = array();
          }

          if(!empty($cp2_deo)){
            // CP2 DEO msg sent
            $cp2_deo['is_used_for'] = 303;
            $data['msg_response'] = $this->msgapi->Msg($cp2_deo);

            $cp2_deo_msg_detaisl = array(
                'cp2_deo_user'=> $cp2_deo,
                'cp2_deo_msg_body' => $data['msg_response']
            );
          }else{
            $cp2_deo_msg_detaisl = array();
          }

        $response = [
            'incident_sdo_bdo_msg_details' => $incident_sdo_bdo_msg_detaisl,
            'incident_deo_msg_details' => $incident_deo_msg_detaisl,
            'cp1_sdo_bdo_msg_details' => $cp1_sdo_bdo_msg_detaisl,
            'cp1_deo_msg_details' => $cp1_deo_msg_detaisl,
            'cp2_sdo_bdo_msg_details' => $cp2_sdo_bdo_msg_detaisl,
            'cp2_deo_msg_details' => $cp2_deo_msg_detaisl
        ];

        echo json_encode($response);

    }
    // CASE 5 : Intervention and CP1 home address are different, but CP2 is not present.
    if( 
        isset($intcident) && is_array($intcident) &&
        isset($cp1) && is_array($cp1) &&
        !isset($cp2) && empty($cp2['cp_state']) &&
        isset($intcident['district']) && !empty($intcident['district']) && 
        isset($cp1['cp_district']) && !empty($cp1['cp_district']) && 
        ( ($intcident['district']!=$cp1['cp_district']) || 
          ($intcident['district']==$cp1['cp_district'])
        ) &&
        $incident_state==1 &&
        $cp1['cp_state']==1 
      ){

      // echo "CASE 5";die;

          if(!empty($incident_sdo_bdo)){
            // Intervention Location SDO/BDO msg sent
            $incident_sdo_bdo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($incident_sdo_bdo);

            $incident_sdo_bdo_msg_detaisl = array(
                'incident_sdo_bdo_user'=> $incident_sdo_bdo,
                'incident_sdo_bdo_msg_body' => $data['msg_response']
            );
          }else{
            $incident_sdo_bdo_msg_detaisl = array();
          }

          if(!empty($incident_deo)){  
            // Intervention Location DEO msg sent
            $incident_deo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($incident_deo);

            $incident_deo_msg_detaisl = array(
                'incident_deo_user'=> $incident_deo,
                'incident_deo_msg_body' => $data['msg_response']
            );
          }else{
            $incident_deo_msg_detaisl = array();
          }

          if(!empty($cp1_cmpo)){  
            // CP1 CMPO msg sent 
            $cp1_cmpo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($cp1_cmpo);

            $cp1_cmpo_msg_detaisl = array(
                'cp1_cmpo_send_user'=> $cp1_cmpo,
                'cp1_cmpo_msg_body' => $data['msg_response']
            );
          }else{
            $cp1_cmpo_msg_detaisl = array();
          }

          if(!empty($cp1_sdo_bdo)){  
            // CP1 SDO/BDO msg sent
            $cp1_sdo_bdo['is_used_for'] = 302;
            $data['msg_response'] = $this->msgapi->Msg($cp1_sdo_bdo);

            $cp1_sdo_bdo_msg_detaisl = array(
                'cp1_sdo_bdo_send_user'=> $cp1_sdo_bdo,
                'cp1_sdo_bdo_msg_body' => $data['msg_response']
            );
          }else{
            $cp1_sdo_bdo_msg_detaisl = array();
          }

          if(!empty($cp1_deo)){  
            // CP1 DEO msg sent
            $cp1_deo['is_used_for'] = 302;
            $data['msg_response'] = $this->msgapi->Msg($cp1_deo);

            $cp1_deo_msg_detaisl = array(
                'cp1_deo_send_user'=> $cp1_deo,
                'cp1_deo_msg_body' => $data['msg_response']
            );
          }else{
            $cp1_deo_msg_detaisl = array();
          }

        $response = [
            'incident_sdo_bdo_msg_details' => $incident_sdo_bdo_msg_detaisl,
            'incident_deo_msg_details' => $incident_deo_msg_detaisl,
            'cp1_cmpo_msg_details' => $cp1_cmpo_msg_detaisl,
            'cp1_sdo_bdo_msg_details' => $cp1_sdo_bdo_msg_detaisl,
            'cp1_deo_msg_details' => $cp1_deo_msg_detaisl
          ];

        echo json_encode($response);

    }
    // $cp1['cp_state']=2;
    // CASE 6 : The intervention address belongs to West Bengal, but the CP1 address is from not in West Bengal.
     if( 
        isset($intcident) && is_array($intcident) &&
        empty($cp1['cp_district']) &&
        isset($cp1['cp_state']) && !empty($cp1['cp_state']) &&
        $incident_state==1 && $cp1['cp_state']==2 
      ){

      // echo "CASE 6";die;

        if(!empty($incident_sdo_bdo)){ 
          // Intervention Location SDO/BDO msg sent
          $incident_sdo_bdo['is_used_for'] = 301; 
          $data['msg_response'] = $this->msgapi->Msg($incident_sdo_bdo);

          $incident_sdo_bdo_msg_detaisl = array(
              'incident_sdo_bdo_user'=> $incident_sdo_bdo,
              'incident_sdo_bdo_msg_body' => $data['msg_response']
          );
        }else{
          $incident_sdo_bdo_msg_detaisl = array();
        }

        if(!empty($incident_deo)){ 
          // Intervention Location DEO msg sent
          $incident_deo['is_used_for'] = 301; 
          $data['msg_response'] = $this->msgapi->Msg($incident_deo);

          $incident_deo_msg_detaisl = array(
              'incident_deo_user'=> $incident_deo,
              'incident_deo_msg_body' => $data['msg_response']
          );
        }else{
          $incident_deo_msg_detaisl = array();
        }

          // SNO get a message when CP1 is outside from Westbengal
          $sno_data = $this->Intervention_message_model->get_sno_data();
          if(!empty($sno_msg)){ 
            $sno_msg['login_id'] = $sno_data->login_id;
            $sno_msg['mobile_no'] = $sno_data->mobile_no;
            $sno_msg['is_used_for'] =401;
            $data['msg_response'] = $this->msgapi->Msg($sno_msg);

            $sno_msg_detaisl = array(
              'sno_user'=> $sno_data->login_id,
              'sno_msg_body' => $data['msg_response']
            );
          }else{
            $sno_msg_detaisl = array();
          }

        $response = [
            'incident_sdo_bdo_msg_details' => $incident_sdo_bdo_msg_detaisl,
            'incident_deo_msg_details' => $incident_deo_msg_detaisl,
            'sno_msg_details' => $sno_msg_detaisl
        ];

        echo json_encode($response);

     } 

     // CASE 7 : The intervention address belongs to West Bengal, but the CP2 address is out side West Bengal.
    if( 
        isset($intcident) && is_array($intcident) && 
        isset($cp2['cp_state']) && !empty($cp2['cp_state']) &&
        $incident_state==1 && $cp2['cp_state']==2 
      ){

      // echo "case 7 testing";die;

          if(!empty($incident_sdo_bdo)){ 
            // Intervention Location SDO/BDO msg sent
            $incident_sdo_bdo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($incident_sdo_bdo);

            $incident_sdo_bdo_msg_detaisl = array(
                'incident_sdo_bdo_user'=> $incident_sdo_bdo,
                'incident_sdo_bdo_msg_body' => $data['msg_response']
            );
          }else{
            $incident_sdo_bdo_msg_detaisl = array();
          }

          if(!empty($incident_deo)){ 
            // Intervention Location DEO msg sent
            $incident_deo['is_used_for'] = 301; 
            $data['msg_response'] = $this->msgapi->Msg($incident_deo);

            $incident_deo_msg_detaisl = array(
                'incident_deo_user'=> $incident_deo,
                'incident_deo_msg_body' => $data['msg_response']
            );
          }else{
            $incident_deo_msg_detaisl = array();
          }
            // SNO get a message when CP1 is outside from Westbengal
            $sno_data = $this->Intervention_message_model->get_sno_data();
            if(!empty($sno_msg)){ 
              $sno_msg['login_id'] = $sno_data->login_id;
              $sno_msg['mobile_no'] = $sno_data->mobile_no;
              $sno_msg['is_used_for'] =401;
              $data['msg_response'] = $this->msgapi->Msg($sno_msg);

              $sno_msg_detaisl = array(
                'sno_user'=> $sno_data->login_id,
                'sno_msg_body' => $data['msg_response']
              );
            }else{
              $sno_msg_detaisl = array();
            }
          $response = [
              'incident_sdo_bdo_msg_details' => $incident_sdo_bdo_msg_detaisl,
              'incident_deo_msg_details' => $incident_deo_msg_detaisl,
              'sno_msg_details' => $sno_msg_detaisl
          ];
          echo json_encode($response);

      }


  }

}
