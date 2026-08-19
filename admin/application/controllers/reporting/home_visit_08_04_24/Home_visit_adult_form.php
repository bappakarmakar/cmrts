<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Home_visit_adult_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->model('home_visit/home_visit_adult_form_model');
    $this->load->model('home_visit/home_visit_minor_form_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
    );

    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
      2 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
    );
  }
  public function index($incident_id=null, $cp_type=null, $cp_id=null) 
  {
    $cp_id = base64_decode($cp_id);
    $incident_id = base64_decode($incident_id);
    $cp_type = base64_decode($cp_type);

    $home_visit_adult_check_status = $this->home_visit_minor_form_model->home_visit_minor_count_by_id($incident_id,$cp_id,$cp_type);
    if(!empty($home_visit_adult_check_status)){
      $sl_no = $home_visit_adult_check_status['sl_no'];
      //echo '<pre>'; print_r($home_visit_minor_check_status);
      redirect('admin/reporting/home_visit/home_visit_adult_form/edit/'.base64_encode($sl_no), 'location');
    }

    $login_id = $this->session->userdata('login_id');
    $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
    $ward_list = $this->Master_model->get_all_ward();
     foreach ($ward_list as $key => $value) {
       $data['ward_list'][$value['block_id_fk']][$value['ward_id_pk']]=$value['name'];
     }
     $gp_list = $this->Master_model->get_all_gp();
     foreach ($gp_list as $key => $value) {
       $data['gp_list'][$value['block_id_fk']][$value['gp_id_pk']]=$value['name'];
     }
     $wd_gp_list=array();
     $wd_gp_list=(array)($data['ward_list'] + $data['gp_list']);

    $data['incident_cp_details']->ward_gp_name = $wd_gp_list[$data['incident_cp_details']->cp_block][$data['incident_cp_details']->cp_ward_gp];
        $login_id = $this->session->userdata('login_id');
        $data['districts'] = array_column($this->Master_model->get_district(), 'district_name', 'district_id_pk');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['gender_details'] = $this->Master_model->get_gender_details();
        $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
        $data['disability_details'] = $this->Master_model->get_disability_details();
        $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
        $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
        // $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
        $data['incident_home_visit_details'] = $this->home_visit_adult_form_model->get_incident_home_visit_details($cp_id);

    
    $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_adult_form_view', $data);

  }

  public function create() {
        $data = array();
        $errors_save = array();
        $errors_save_draft = array();
        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');

        $csrf_hash = $this->security->get_csrf_hash();
        $this->load->library('form_validation');
        $this->form_validation_draft = clone $this->form_validation;
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        ################### Save Start ####################

        $this->form_validation->set_rules('mode_of_enquiry', '<b>Mode Of Enquiry</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('mode_of_enquiry', '<b>Mode Of Enquiry</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('gender', '<b>Gender</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('gender', '<b>Gender</b>', 'trim|numeric|max_length[2]');


        $this->form_validation->set_rules('family_income', '<b>Family Income</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('family_income', '<b>Family Income</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('nutritious_meals', '<b>Nutritious Meals</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('nutritious_meals', '<b>Nutritious Meals</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('neighbours_community', '<b>Neighbours Community</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('neighbours_community', '<b>Neighbours Community</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('emergencies', '<b>Emergencies</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('emergencies', '<b>Emergencies</b>', 'trim|numeric|max_length[2]');

        
        $this->form_validation->set_rules('education', '<b>Education</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('education', '<b>Education</b>', 'trim|numeric|max_length[2]');
        $education = $this->input->post('education');
        if($education==1){
          $this->form_validation->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|numeric|max_length[2]');  
        }

        $this->form_validation->set_rules('paid_work', '<b>Paid Work</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('paid_work', '<b>Paid Work</b>', 'trim|numeric|max_length[2]');
        $paid_work = $this->input->post('paid_work');
        if($paid_work==1){
          $this->form_validation->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|numeric|max_length[2]');
        }

        $Siblings_Details = $this->input->post('Siblings_Details');
          if(!empty($Siblings_Details)){
            foreach($Siblings_Details as $key => $value){
              $this->form_validation->set_rules('Siblings_Details['.$key.'][name]', '<b>Name</b>', 'trim|max_length[50]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][name]', '<b>Name</b>', 'trim|max_length[50]');

              $this->form_validation->set_rules('Siblings_Details['.$key.'][age]', '<b>Age</b>', 'trim|numeric|max_length[2]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][age]', '<b>Age</b>', 'trim|numeric|max_length[2]');

              $this->form_validation->set_rules('Siblings_Details['.$key.'][sex]', '<b>Gender</b>', 'trim|numeric|max_length[2]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][sex]', '<b>Gender</b>', 'trim|numeric|max_length[2]');

              $this->form_validation->set_rules('Siblings_Details['.$key.'][marriage]', '<b>Sibling Married</b>', 'trim|numeric|max_length[2]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][marriage]', '<b>Sibling Married</b>', 'trim|numeric|max_length[2]');

              $this->form_validation->set_rules('Siblings_Details['.$key.'][in_education]', '<b>In Education</b>', 'trim|numeric|max_length[2]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][in_education]', '<b>In Education</b>', 'trim|numeric|max_length[2]');

              $this->form_validation->set_rules('Siblings_Details['.$key.'][in_paid_work]', '<b>In paid work</b>', 'trim|numeric|max_length[2]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][in_paid_work]', '<b>In paid work</b>', 'trim|numeric|max_length[2]');

            }

          }
        
        ################### Save End ####################


        // Run form validation
        if ($this->form_validation->run() == FALSE) {
            $errors_save = $this->form_validation->error_array();
        }

        if ($this->form_validation_draft->run() == FALSE) {
          $errors_save_draft = $this->form_validation_draft->error_array();
           //echo '<pre>';print_r($errors_save_draft);die();
          if($errors_save==$errors_save_draft){
            $formCompleteStatus = 1;
          }else{
            $formCompleteStatus = 0;
          }
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
        }else{
          

          if($errors_save==$errors_save_draft){
            $formCompleteStatus = 1;
          }else{
            $formCompleteStatus = 0;
          }
          $all_post_data = $this->input->post();
        if(empty($all_post_data)){
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
        }else{
          $incidentDetailsId = $this->input->post('incidentDetailsId');
          $incidentDetailsIdArray = explode("/", $incidentDetailsId);
          if(count($incidentDetailsIdArray)==3){
            $incident_id = base64_decode($incidentDetailsIdArray[0]);
            $cp_type = base64_decode($incidentDetailsIdArray[1]);
            $cp_id = base64_decode($incidentDetailsIdArray[2]);
          }else{
            $incident_id = null;
            $cp_type =  null;
            $cp_id = null;
          }
          $action = isset($_POST['action']) ? $_POST['action'] : NULL;
          if($action=='swalSubmit'){

          $home_visit_adult_check_status = $this->home_visit_minor_form_model->home_visit_minor_count_by_id($incident_id,$cp_id,$cp_type);
          
          $mode_of_enquiry = isset($_POST['mode_of_enquiry']) ? $_POST['mode_of_enquiry'] : NULL;
          $gender = isset($_POST['gender']) ? $_POST['gender'] : NULL;
          $family_income = isset($_POST['family_income']) ? $_POST['family_income'] : NULL;
          $nutritious_meals = isset($_POST['nutritious_meals']) ? $_POST['nutritious_meals'] : NULL;
          $neighbours_community = isset($_POST['neighbours_community']) ? $_POST['neighbours_community'] : NULL;
          $emergencies = isset($_POST['emergencies']) ? $_POST['emergencies'] : NULL;
          $education = isset($_POST['education']) ? $_POST['education'] : NULL;
          $education_frequency = isset($_POST['education_frequency']) ? $_POST['education_frequency'] : NULL;
          $paid_work = isset($_POST['paid_work']) ? $_POST['paid_work'] : NULL;
          $paid_work_frequency = isset($_POST['paid_work_frequency']) ? $_POST['paid_work_frequency'] : NULL;
          
          $homeVisitData['incident_id_fk'] =  $incident_id;
          $homeVisitData['cp_id_fk'] =  $cp_id;
          $homeVisitData['cp_type'] =  $cp_type;
          $homeVisitData['mode_of_enquiry'] =  $mode_of_enquiry;
          $homeVisitData['gender'] =  $gender;
          $homeVisitData['family_income'] =  $family_income;
          $homeVisitData['nutritious_meals'] =  $nutritious_meals;
          $homeVisitData['neighbours_community'] =  $neighbours_community;
          $homeVisitData['emergencies'] =  $emergencies;
          $homeVisitData['education'] =  $education;
          $homeVisitData['education_frequency'] =  $education_frequency;
          $homeVisitData['paid_work'] =  $paid_work;
          $homeVisitData['paid_work_frequency'] =  $paid_work_frequency;
          $homeVisitData['hv_status'] =  $formCompleteStatus;
          $default = $this->load->database('default',TRUE);
          $default->trans_start();

          if(count($home_visit_adult_check_status)>0){
            $home_visit_adult_sl_no = $home_visit_adult_check_status['sl_no'];
            $homeVisitData['update_by'] =  $stake_holder_login_id_pk;
            $homeVisitData['update_time'] =  'now()';
            $homeVisitData['update_ip'] =  $_SERVER['REMOTE_ADDR'];
            $home_visit_adult_insert_status = $this->home_visit_minor_form_model->home_visit_minor_update($homeVisitData,$home_visit_adult_sl_no);
            $hv_id_fk = $home_visit_adult_sl_no;
          }else{
            $homeVisitData['entry_by'] =  $stake_holder_login_id_pk;
            $homeVisitData['entry_time'] =  'now()';
            $homeVisitData['entry_ip'] =  $_SERVER['REMOTE_ADDR']; 
            $home_visit_adult_insert_status = $this->home_visit_minor_form_model->home_visit_minor_insert($homeVisitData);
            $hv_id_fk = $home_visit_adult_insert_status;
          }

          $SiblingsData = array();
          $Siblings_Details = $this->input->post('Siblings_Details');
          if(!empty($Siblings_Details)){
            foreach($Siblings_Details as $key => $value){
              if ( !empty(array_filter($value))) {
                $name = isset($value['name']) ? $value['name'] : NULL;
                $age = isset($value['age']) ? $value['age'] : NULL;
                $sex = isset($value['sex']) ? $value['sex'] : NULL;
                $marriage = isset($value['marriage']) ? $value['marriage'] : NULL;
                $siblings_occupation = isset($value['occupation']) ? implode(",",(array) $value['occupation']) : NULL;

                $SiblingsData['siblings_name'] = $name;
                $SiblingsData['siblings_age'] = $age;
                $SiblingsData['siblings_sex'] = $sex;
                $SiblingsData['siblings_occupation'] = $siblings_occupation;
                $SiblingsData['siblings_married'] = $marriage;
                
                $SiblingsData['incident_id_fk'] =  $incident_id;
                $SiblingsData['cp_id_fk'] =  $cp_id;
                $SiblingsData['cp_type'] =  $cp_type;
                
                if(isset($value['id'])){

                $SiblingsData['update_by'] = $stake_holder_login_id_pk;
                $SiblingsData['update_time'] = 'now()';
                $SiblingsData['update_ip'] = $_SERVER['REMOTE_ADDR'];
                $siblings_status = $this->home_visit_minor_form_model->homwvisit_siblings_update_by_sl_no($SiblingsData,$value['id']);
                }else{
                  $SiblingsData['hv_id_fk'] = $hv_id_fk;
                  $SiblingsData['entry_by'] = $stake_holder_login_id_pk;
                  $SiblingsData['entry_time'] = 'now()';
                  $SiblingsData['entry_ip'] = $_SERVER['REMOTE_ADDR'];
                  $siblings_status = $this->home_visit_minor_form_model->home_visit_siblings_details_insert($SiblingsData);

                }
                
                if ($siblings_status > 0) {
                  continue; // Skip 
                } else {
                    break; // Exit the loop
                }

              }else{
                $siblings_status = 1;
              }
            }

          }else{
            $siblings_status = 1;
          }
          if(empty($Siblings_Details)){
            $siblings_status = 1;
          }
          if($home_visit_adult_insert_status>0 && $siblings_status>0){
            $default->trans_commit();
          }else{
            $default->trans_rollback();
          }
         
        }
        }
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');

        }
        echo json_encode($data);
        
  }
  public function edit($id=null){
    if(empty($id)){
      redirect('admin/reporting/home_visit/home_visits_list/', 'location');
    }else{
      $sl_no = base64_decode($id);
      $home_visit_details = $this->home_visit_minor_form_model->home_visit_minor_details_by_id($sl_no);
      if(empty($home_visit_details)){
         redirect('admin/reporting/home_visit/home_visits_list/', 'location');
      }else{
        $incident_id =  ($home_visit_details)?$home_visit_details['incident_id_fk']:'';
        $cp_id =  ($home_visit_details)?$home_visit_details['cp_id_fk']:'';
        $cp_type =  ($home_visit_details)?$home_visit_details['cp_type']:'';
        $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
        $ward_list = $this->Master_model->get_all_ward();
     foreach ($ward_list as $key => $value) {
       $data['ward_list'][$value['block_id_fk']][$value['ward_id_pk']]=$value['name'];
     }
     $gp_list = $this->Master_model->get_all_gp();
     foreach ($gp_list as $key => $value) {
       $data['gp_list'][$value['block_id_fk']][$value['gp_id_pk']]=$value['name'];
     }
     $wd_gp_list=array();
     $wd_gp_list=(array)($data['ward_list'] + $data['gp_list']);

    $data['incident_cp_details']->ward_gp_name = $wd_gp_list[$data['incident_cp_details']->cp_block][$data['incident_cp_details']->cp_ward_gp];
        $login_id = $this->session->userdata('login_id');
        $data['districts'] = array_column($this->Master_model->get_district(), 'district_name', 'district_id_pk');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['gender_details'] = $this->Master_model->get_gender_details();
        $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
        $data['disability_details'] = $this->Master_model->get_disability_details();
        $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
        $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
        // $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
        $data['incident_home_visit_details'] = $this->home_visit_adult_form_model->get_incident_home_visit_details($cp_id);
        $data['home_visit_details'] = $home_visit_details;
        $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_adult_edit_form_view', $data);


      }

    }

  }
  public function edit_from_update() {
        $data = array();
        $errors_save = array();
        $errors_save_draft = array();
        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');

        $csrf_hash = $this->security->get_csrf_hash();
        $this->load->library('form_validation');
        $this->form_validation_draft = clone $this->form_validation;
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        ################### Save Start ####################

        $this->form_validation->set_rules('mode_of_enquiry', '<b>Mode Of Enquiry</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('mode_of_enquiry', '<b>Mode Of Enquiry</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('gender', '<b>Gender</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('gender', '<b>Gender</b>', 'trim|numeric|max_length[2]');


        $this->form_validation->set_rules('family_income', '<b>Family Income</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('family_income', '<b>Family Income</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('nutritious_meals', '<b>Nutritious Meals</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('nutritious_meals', '<b>Nutritious Meals</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('neighbours_community', '<b>Neighbours Community</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('neighbours_community', '<b>Neighbours Community</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('emergencies', '<b>Emergencies</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('emergencies', '<b>Emergencies</b>', 'trim|numeric|max_length[2]');

        
        $this->form_validation->set_rules('education', '<b>Education</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('education', '<b>Education</b>', 'trim|numeric|max_length[2]');
        $education = $this->input->post('education');
        if($education==1){
          $this->form_validation->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|numeric|max_length[2]');  
        }

        $this->form_validation->set_rules('paid_work', '<b>Paid Work</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('paid_work', '<b>Paid Work</b>', 'trim|numeric|max_length[2]');
        $paid_work = $this->input->post('paid_work');
        if($paid_work==1){
          $this->form_validation->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|numeric|max_length[2]');
        }

        $Siblings_Details = $this->input->post('Siblings_Details');
          if(!empty($Siblings_Details)){
            foreach($Siblings_Details as $key => $value){
              $this->form_validation->set_rules('Siblings_Details['.$key.'][name]', '<b>Name</b>', 'trim|max_length[50]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][name]', '<b>Name</b>', 'trim|max_length[50]');

              $this->form_validation->set_rules('Siblings_Details['.$key.'][age]', '<b>Age</b>', 'trim|numeric|max_length[2]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][age]', '<b>Age</b>', 'trim|numeric|max_length[2]');

              $this->form_validation->set_rules('Siblings_Details['.$key.'][sex]', '<b>Gender</b>', 'trim|numeric|max_length[2]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][sex]', '<b>Gender</b>', 'trim|numeric|max_length[2]');

              $this->form_validation->set_rules('Siblings_Details['.$key.'][marriage]', '<b>Sibling Married</b>', 'trim|numeric|max_length[2]');
              $this->form_validation_draft->set_rules('Siblings_Details['.$key.'][marriage]', '<b>Sibling Married</b>', 'trim|numeric|max_length[2]');
            }

          }
        
        ################### Save End ####################


        // Run form validation
        if ($this->form_validation->run() == FALSE) {
            $errors_save = $this->form_validation->error_array();
        }

        if ($this->form_validation_draft->run() == FALSE) {
          $errors_save_draft = $this->form_validation_draft->error_array();
           //echo '<pre>';print_r($errors_save_draft);die();
          if($errors_save==$errors_save_draft){
            $formCompleteStatus = 1;
          }else{
            $formCompleteStatus = 0;
          }
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
        }else{
          

          if($errors_save==$errors_save_draft){
            $formCompleteStatus = 1;
          }else{
            $formCompleteStatus = 0;
          }
          $all_post_data = $this->input->post();
        if(empty($all_post_data)){
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
        }else{
          $home_visit_sl_no = $this->input->post('home_visit_sl_no');
          $home_visit_sl_no = base64_decode($home_visit_sl_no);
          $home_visit_adult_check_status = $this->home_visit_minor_form_model->home_visit_minor_details_by_id($home_visit_sl_no);

          if(empty($home_visit_adult_check_status)){
             $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
          }else{
            $incident_id = ($home_visit_adult_check_status)?$home_visit_adult_check_status['incident_id_fk']:'';
            $cp_id =  ($home_visit_adult_check_status)?$home_visit_adult_check_status['cp_id_fk']:'';
            $cp_type =  ($home_visit_adult_check_status)?$home_visit_adult_check_status['cp_type']:'';
            $action = isset($_POST['action']) ? $_POST['action'] : NULL;
            if($action=='swalSubmit'){
                $mode_of_enquiry = isset($_POST['mode_of_enquiry']) ? $_POST['mode_of_enquiry'] : NULL;
                $gender = isset($_POST['gender']) ? $_POST['gender'] : NULL;
                $family_income = isset($_POST['family_income']) ? $_POST['family_income'] : NULL;
                $nutritious_meals = isset($_POST['nutritious_meals']) ? $_POST['nutritious_meals'] : NULL;
                $neighbours_community = isset($_POST['neighbours_community']) ? $_POST['neighbours_community'] : NULL;
                $emergencies = isset($_POST['emergencies']) ? $_POST['emergencies'] : NULL;
                $education = isset($_POST['education']) ? $_POST['education'] : NULL;
                $education_frequency = isset($_POST['education_frequency']) ? $_POST['education_frequency'] : NULL;
                $paid_work = isset($_POST['paid_work']) ? $_POST['paid_work'] : NULL;
                $paid_work_frequency = isset($_POST['paid_work_frequency']) ? $_POST['paid_work_frequency'] : NULL;
                
                $homeVisitData['mode_of_enquiry'] =  $mode_of_enquiry;
                $homeVisitData['gender'] =  $gender;
                $homeVisitData['family_income'] =  $family_income;
                $homeVisitData['nutritious_meals'] =  $nutritious_meals;
                $homeVisitData['neighbours_community'] =  $neighbours_community;
                $homeVisitData['emergencies'] =  $emergencies;
                $homeVisitData['education'] =  $education;
                $homeVisitData['education_frequency'] =  $education_frequency;
                $homeVisitData['paid_work'] =  $paid_work;
                $homeVisitData['paid_work_frequency'] =  $paid_work_frequency;
                $homeVisitData['hv_status'] =  $formCompleteStatus;
                $default = $this->load->database('default',TRUE);
                $default->trans_start();

                $home_visit_adult_sl_no = $home_visit_adult_check_status['sl_no'];
                $homeVisitData['update_by'] =  $stake_holder_login_id_pk;
                $homeVisitData['update_time'] =  'now()';
                $homeVisitData['update_ip'] =  $_SERVER['REMOTE_ADDR'];
                $home_visit_adult_insert_status = $this->home_visit_minor_form_model->home_visit_minor_update($homeVisitData,$home_visit_adult_sl_no);
                $hv_id_fk = $home_visit_adult_sl_no;
                $SiblingsData = array();
                $Siblings_Details = $this->input->post('Siblings_Details');
                if(!empty($Siblings_Details)){
                  foreach($Siblings_Details as $key => $value){

                    if ( !empty(array_filter($value))) {
                      $name = isset($value['name']) ? $value['name'] : NULL;
                      $age = isset($value['age']) ? $value['age'] : NULL;
                      $sex = isset($value['sex']) ? $value['sex'] : NULL;
                      $marriage = isset($value['marriage']) ? $value['marriage'] : NULL;
                      $siblings_occupation = isset($value['occupation']) ? implode(",",(array) $value['occupation']) : NULL;

                      $SiblingsData['siblings_name'] = $name;
                      $SiblingsData['siblings_age'] = $age;
                      $SiblingsData['siblings_sex'] = $sex;
                      $SiblingsData['siblings_occupation'] = $siblings_occupation;
                      $SiblingsData['siblings_married'] = $marriage;
                      
                      $SiblingsData['incident_id_fk'] =  $incident_id;
                      $SiblingsData['cp_id_fk'] =  $cp_id;
                      $SiblingsData['cp_type'] =  $cp_type;
                      
                      if(isset($value['id'])){

                      $SiblingsData['update_by'] = $stake_holder_login_id_pk;
                      $SiblingsData['update_time'] = 'now()';
                      $SiblingsData['update_ip'] = $_SERVER['REMOTE_ADDR'];
                      $siblings_status = $this->home_visit_minor_form_model->homwvisit_siblings_update_by_sl_no($SiblingsData,$value['id']);
                      }else{
                        $SiblingsData['hv_id_fk'] = $hv_id_fk;
                        $SiblingsData['entry_by'] = $stake_holder_login_id_pk;
                        $SiblingsData['entry_time'] = 'now()';
                        $SiblingsData['entry_ip'] = $_SERVER['REMOTE_ADDR'];
                        $siblings_status = $this->home_visit_minor_form_model->home_visit_siblings_details_insert($SiblingsData);

                      }
                      
                      if ($siblings_status > 0) {
                        continue; // Skip 
                      } else {
                          break; // Exit the loop
                      }

                    }else{
                      $siblings_status = 1;
                    }
                  }

                }else{
                  $siblings_status = 1;
                }


                if(empty($Siblings_Details)){
                  $siblings_status = 1;
                }
                if($home_visit_adult_insert_status>0 && $siblings_status>0){
                  $default->trans_commit();
                }else{
                  $default->trans_rollback();
                }
            }
          }
        }
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');

        }
        echo json_encode($data);
        
  }
  public function siblings_table_record_loade(){
    $id = $_GET['id'];
    $idArray = explode("/", $id);
    if(count($idArray)>1){
      $incident_id = base64_decode($idArray[0]);
      $cp_type = base64_decode($idArray[1]);
      $cp_id = base64_decode($idArray[2]);
      $homwvisit_siblings_dtls = $this->home_visit_minor_form_model->get_homwvisit_siblings_dtls_by_hvm_id(array('incident_id_fk'=>$incident_id,'cp_id_fk'=>$cp_id,'cp_type'=>$cp_type));
    }else{
      $hvm_id_fk = base64_decode($id);
      $homwvisit_siblings_dtls = $this->home_visit_minor_form_model->get_homwvisit_siblings_dtls_by_hvm_id(array('hv_id_fk'=>$hvm_id_fk));
    }
      $html = '';
    if(!empty($homwvisit_siblings_dtls)){  
      foreach ($homwvisit_siblings_dtls as $key => $value) {
       $siblings_occupation = $value['siblings_occupation'];
       $siblings_occupation_explode = explode(',', $siblings_occupation);
       $style = ($key+1)!=count($homwvisit_siblings_dtls)?'display:none;':'display:block';
       $html.='<tr class="Siblings_Table_Field_Remove">';

       $html.='<td><input type="text" class="form-control" name="Siblings_Details['.$key.'][name]" placeholder="Name" autocomplete="off" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return Siblings_Name_Validate(event);" value="'.$value['siblings_name'].'"></td>';

       $html.='<td><input type="text" class="form-control" name="Siblings_Details['.$key.'][age]" placeholder="Age" maxlength="2" autocomplete="off" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return onlyNumbers(event, this);" value="'.$value['siblings_age'].'"></td>';

       $html.='<td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][sex]" id="siblings_sex" value="1" '.(($value["siblings_sex"]==1) ? "checked" : '').'>&nbsp;Male</label></td><td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][sex]" id="siblings_sex" value="2" '.(($value["siblings_sex"]==2) ? "checked" : '').'>&nbsp;Female</label></td>';

       $html.='<td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][marriage]" id="siblings_marriage" value="1" '.(($value["siblings_married"]==1) ? "checked" : '').'>&nbsp;Yes</label></td>';

       $html.='<td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][marriage]" id="siblings_marriage" value="2" '.(($value["siblings_married"]==2) ? "checked" : '').'>&nbsp;No</label></td>';

       $html.='<td><label class="radio-inline"><input type="checkbox" name="Siblings_Details['.$key.'][occupation][]" value="1" '.(in_array(1,$siblings_occupation_explode)?'checked':'').'>&nbsp;In education</label></td><td><label class="radio-inline"><input type="checkbox" name="Siblings_Details['.$key.'][occupation][]" value="2" '.(in_array(2,$siblings_occupation_explode)?'checked':'').'>&nbsp;In Paid work</label></td>';

       $html.= '<td><button type="button" id="siblings_Remove" class="btn btn-danger form-control siblings_Remove'.$key.'" style="'.$style.'" fdprocessedid="ebpxyn" onclick="remove_row('.$key.')"><i class="fa fa-trash"></i></button> </td><input type="hidden" name="Siblings_Details['.$key.'][id]" value="'.$value['sl_no'].'"></tr>';

      }
      echo $html;

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
