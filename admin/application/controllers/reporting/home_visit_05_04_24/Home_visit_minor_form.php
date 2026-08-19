<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Home_visit_minor_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
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
    // $login_id = $this->session->userdata('login_id');
    // //echo $login_id;
    // if($login_id=='DEO.Amta-i.Howrah' || $login_id=='DEO.Khanakul-ii.Hooghly')
    // {

    // }else{
    //   redirect('admin/dashboard', 'location');
    // }
  }
  public function index($incident_id=null, $cp_type=null, $cp_id=null) 
  {
    $cp_id = base64_decode($cp_id);
    $incident_id = base64_decode($incident_id);
    $cp_type = base64_decode($cp_type);
    $login_id = $this->session->userdata('login_id');

    $home_visit_minor_check_status = $this->home_visit_minor_form_model->home_visit_minor_count_by_id($incident_id,$cp_id,$cp_type);
    if(!empty($home_visit_minor_check_status)){
      $sl_no = $home_visit_minor_check_status['sl_no'];
      //echo '<pre>'; print_r($home_visit_minor_check_status);
      redirect('admin/reporting/home_visit/Home_visit_minor_form/edit/'.base64_encode($sl_no), 'location');
    }
     

    $data['districts'] = $this->Master_model->get_district();
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['gender_details'] = $this->Master_model->get_gender_details();
    $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
    $data['disability_details'] = $this->Master_model->get_disability_details();
    $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
    $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
    $data['highest_education_details'] = $this->Master_model->get_highest_education_details();
    // $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
    $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
    $data['incident_cp_details']->ward_gp_name = '';
    $data['homwvisit_siblings_dtls']=$this->home_visit_minor_form_model->get_homwvisit_siblings_dtls(
          array('cp_id_fk'=>$cp_id,'cp_type'=>$cp_type,'incident_id_fk'=>$incident_id));


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
    $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_minor_form_view', $data);
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

        $this->form_validation->set_rules('disability', '<b>Disability</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('disability', '<b>Disability</b>', 'trim|numeric|max_length[2]');

        $disability = $this->input->post('disability');
        if($disability==1){
          $this->form_validation->set_rules('type_of_disability[]', 'Type of Disability', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('type_of_disability[]', 'Type of Disability', 'trim|numeric|max_length[2]');

          $this->form_validation->set_rules('disability_certificate', 'Disability Certificate',  'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('disability_certificate', 'Disability Certificate',  'trim|numeric|max_length[2]');

          $disability_certificate = $this->input->post('disability_certificate');
          if($disability_certificate==1){
            $this->form_validation->set_rules('disability_percent', '<b>Disability Percent</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('disability_percent', '<b>Disability Percent</b>', 'trim|numeric|max_length[2]');
          }else{
            $this->form_validation->set_rules('estimated_severity', '<b>Estimated Severity</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('estimated_severity', '<b>Estimated Severity</b>', 'trim|numeric|max_length[2]');
          }
        }
        $this->form_validation->set_rules('education', '<b>Education</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('education', '<b>Education</b>', 'trim|numeric|max_length[2]');
        $education = $this->input->post('education');
        if($education==1){
          $this->form_validation->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|numeric|max_length[2]');

          $this->form_validation->set_rules('cp_school_district', '<b>District</b>', 'trim|numeric|required|max_length[2]');
          $this->form_validation_draft->set_rules('cp_school_district', '<b>District</b>', 'trim|numeric|max_length[2]');

          $this->form_validation->set_rules('cp_school_block', '<b>Block</b>', 'trim|required|numeric|max_length[4]');
          $this->form_validation_draft->set_rules('cp_school_block','<b>Block</b>', 'trim|numeric|max_length[4]');

          $this->form_validation->set_rules('bs_school_id', '<b>Institute</b>', 'trim|required|numeric|max_length[11]');
          $this->form_validation_draft->set_rules('bs_school_id','<b>Institute</b>' ,'trim|numeric|max_length[11]');
          $bs_school_id = $this->input->post('bs_school_id');
          if($bs_school_id=='19'){

            $this->form_validation->set_rules('school_name', '<b>Institute Name</b>', 'trim|numeric|max_length[100]');
            $this->form_validation_draft->set_rules('school_name','<b>Institute Name</b>', 'trim|numeric|max_length[100]');

          }



          
          
        }

        $this->form_validation->set_rules('kishori_group', '<b>Kishori Group</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('kishori_group', '<b>Kishori Group</b>', 'trim|numeric|max_length[2]');

        $kishori_group = $this->input->post('kishori_group');
        if($kishori_group==1){
          $this->form_validation->set_rules('kishori_group_frequency', '<b>Kishori Group Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('kishori_group_frequency', '<b>Kishori Group Frequency</b>', 'trim|numeric|max_length[2]');

        }

        $this->form_validation->set_rules('paid_work', '<b>Paid Work</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('paid_work', '<b>Paid Work</b>', 'trim|numeric|max_length[2]');
        $paid_work = $this->input->post('paid_work');
        if($paid_work==1){
          $this->form_validation->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|numeric|max_length[2]');
        }



        $this->form_validation->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|numeric|max_length[20]');
        $this->form_validation_draft->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|numeric|max_length[20]');

        $this->form_validation->set_rules('parents_supported', '<b>Parents Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('parents_supported', '<b>Parents Supported</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('family_elders_supported', '<b>Family Elders Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('family_elders_supported', '<b>Family Elders Supported</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('peers_supported', '<b>Peers Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('peers_supported', '<b>Peers Supported</b>', 'trim|numeric|max_length[2]');


        $this->form_validation->set_rules('neighbours_supported', '<b>Neighbours Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('neighbours_supported', '<b>Neighbours Supported</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('others_supported', '<b>Others Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('others_supported', '<b>Others Supported</b>', 'trim|numeric|max_length[2]');

        $gender = $this->input->post('gender');
        if($gender==2){
          $this->form_validation->set_rules('minor_pregnant', '<b>Minor Pregnant</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('minor_pregnant', '<b>Minor Pregnant</b>', 'trim|numeric|max_length[2]');

          $minor_pregnant = $this->input->post('minor_pregnant');
          if($minor_pregnant==1){
            $this->form_validation->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|numeric|max_length[2]');
          }
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
          $incidentDetailsId = $this->input->post('incidentDetailsId');
          unset($all_post_data['incidentDetailsId']);

          function remove_empty_arrays($array) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = remove_empty_arrays($value);
                }
            }
            return array_filter($array);
        }
        $filtered_data = remove_empty_arrays($all_post_data);
        if(empty($filtered_data)){

        }else{
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

          $home_visit_minor_check_status = $this->home_visit_minor_form_model->home_visit_minor_count_by_id($incident_id,$cp_id,$cp_type);
          if(count($home_visit_minor_check_status)>0){
            $home_visit_minor_sl_no = $home_visit_minor_check_status['sl_no'];
            $siblings_details_count_status = $this->home_visit_minor_form_model->home_visit_siblings_details_count_by_id($home_visit_minor_sl_no);
          }else{
            $siblings_details_count_status = 0;
          }
          $mode_of_enquiry = isset($_POST['mode_of_enquiry']) ? $_POST['mode_of_enquiry'] : NULL;
          $gender = isset($_POST['gender']) ? $_POST['gender'] : NULL;
          $family_income = isset($_POST['family_income']) ? $_POST['family_income'] : NULL;
          $nutritious_meals = isset($_POST['nutritious_meals']) ? $_POST['nutritious_meals'] : NULL;
          $neighbours_community = isset($_POST['neighbours_community']) ? $_POST['neighbours_community'] : NULL;
          $emergencies = isset($_POST['emergencies']) ? $_POST['emergencies'] : NULL;
          $disability = isset($_POST['disability']) ? $_POST['disability'] : NULL;
          $type_of_disability = isset($_POST['type_of_disability']) ? implode(",",(array) $_POST['type_of_disability']) : NULL;
          $disability_certificate = isset($_POST['disability_certificate']) ? $_POST['disability_certificate'] : NULL;
          $disability_percent = isset($_POST['disability_percent']) ? $_POST['disability_percent'] : NULL;
          $estimated_severity = isset($_POST['estimated_severity']) ? $_POST['estimated_severity'] : NULL;
          $education = isset($_POST['education']) ? $_POST['education'] : NULL;
          $education_frequency = isset($_POST['education_frequency']) ? $_POST['education_frequency'] : NULL;
          $kishori_group = isset($_POST['kishori_group']) ? $_POST['kishori_group'] : NULL;
          $kishori_group_frequency = isset($_POST['kishori_group_frequency']) ? $_POST['kishori_group_frequency'] : NULL;
          $paid_work = isset($_POST['paid_work']) ? $_POST['paid_work'] : NULL;
          $paid_work_frequency = isset($_POST['paid_work_frequency']) ? $_POST['paid_work_frequency'] : NULL;

          $cp_highest_educational_attainment = isset($_POST['cp_highest_educational_attainment']) ? $_POST['cp_highest_educational_attainment'] : NULL;

          $cp_school_district = isset($_POST['cp_school_district']) ? $_POST['cp_school_district'] : NULL;
          $cp_school_block = isset($_POST['cp_school_block']) ? $_POST['cp_school_block'] : NULL;
          $bs_school_id = isset($_POST['bs_school_id']) ? $_POST['bs_school_id'] : NULL;
          $school_name = isset($_POST['school_name']) ? $_POST['school_name'] : NULL;
          $kanyashree_id = isset($_POST['kanyashree_id']) ? $_POST['kanyashree_id'] : NULL;
          $parents_supported = isset($_POST['parents_supported']) ? $_POST['parents_supported'] : NULL;
          $family_elders_supported = isset($_POST['family_elders_supported']) ? $_POST['family_elders_supported'] : NULL;
          $peers_supported = isset($_POST['peers_supported']) ? $_POST['peers_supported'] : NULL;
          $neighbours_supported = isset($_POST['neighbours_supported']) ? $_POST['neighbours_supported'] : NULL;
          $others_supported = isset($_POST['others_supported']) ? $_POST['others_supported'] : NULL;
          $minor_pregnant = isset($_POST['minor_pregnant']) ? $_POST['minor_pregnant'] : NULL;
          $stage_of_pregnancy_cls = isset($_POST['stage_of_pregnancy_cls']) ? $_POST['stage_of_pregnancy_cls'] : NULL;
          $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : NULL;

           

          
          $homeVisitData['incident_id_fk'] =  $incident_id;
          $homeVisitData['cp_id_fk'] =  $cp_id;
          $homeVisitData['cp_type'] =  $cp_type;
          $homeVisitData['mode_of_enquiry'] =  $mode_of_enquiry;
          $homeVisitData['gender'] =  $gender;
          $homeVisitData['family_income'] =  $family_income;
          $homeVisitData['nutritious_meals'] =  $nutritious_meals;
          $homeVisitData['neighbours_community'] =  $neighbours_community;
          $homeVisitData['emergencies'] =  $emergencies;
          $homeVisitData['disability'] =  $disability;
          $homeVisitData['type_of_disability'] =  $type_of_disability;
          $homeVisitData['disability_certificate'] =  $disability_certificate;
          $homeVisitData['disability_percent'] =  $disability_percent;
          $homeVisitData['estimated_severity'] =  $estimated_severity;
          $homeVisitData['education'] =  $education;
          $homeVisitData['education_frequency'] =  $education_frequency;
          $homeVisitData['kishori_group'] =  $kishori_group;
          $homeVisitData['kishori_group_frequency'] =  $kishori_group_frequency;
          $homeVisitData['paid_work'] =  $paid_work;
          $homeVisitData['paid_work_frequency'] =  $paid_work_frequency;
          $homeVisitData['kanyashree_id'] =  $kanyashree_id;
          $homeVisitData['parents_supported'] =  $parents_supported;
          $homeVisitData['family_elders_supported'] =  $family_elders_supported;
          $homeVisitData['peers_supported'] =  $peers_supported;
          $homeVisitData['neighbours_supported'] =  $neighbours_supported;
          $homeVisitData['others_supported'] =  $others_supported;
          $homeVisitData['minor_pregnant'] =  $minor_pregnant;
          $homeVisitData['stage_of_pregnancy'] =  $stage_of_pregnancy_cls;
          $homeVisitData['remarks'] =  $remarks;
                   
          $homeVisitData['hv_status'] =  $formCompleteStatus;
          $homeVisitData['bs_school_id_fk'] =  ($bs_school_id)?$bs_school_id:NULL;
          $homeVisitData['school_name'] =  $school_name;
          $homeVisitData['school_district'] =  ($cp_school_district)?$cp_school_district:NULL;
          $homeVisitData['school_block'] =  ($cp_school_block)?$cp_school_block:NULL;
          $default = $this->load->database('default',TRUE);
          $default->trans_start();

          if(count($home_visit_minor_check_status)>0){
            $home_visit_minor_sl_no = $home_visit_minor_check_status['sl_no'];
            $homeVisitData['update_by'] =  $stake_holder_login_id_pk;
            $homeVisitData['update_time'] =  'now()';
            $homeVisitData['update_ip'] =  $_SERVER['REMOTE_ADDR'];
            $home_visit_minor_insert_status = $this->home_visit_minor_form_model->home_visit_minor_update($homeVisitData,$home_visit_minor_sl_no);
            $hv_id_fk = $home_visit_minor_sl_no;
          }else{
            $homeVisitData['entry_by'] =  $stake_holder_login_id_pk;
            $homeVisitData['entry_time'] =  'now()';
            $homeVisitData['entry_ip'] =  $_SERVER['REMOTE_ADDR']; 
            $home_visit_minor_insert_status = $this->home_visit_minor_form_model->home_visit_minor_insert($homeVisitData);
            $hv_id_fk = $home_visit_minor_insert_status;
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
                $in_education = isset($value['in_education']) ? $value['in_education'] : NULL;
                $in_paid_work = isset($value['in_paid_work']) ? $value['in_paid_work'] : NULL;
                
                
                $SiblingsData['siblings_name'] = $name;
                $SiblingsData['siblings_age'] = $age;
                $SiblingsData['siblings_sex'] = $sex;
                $SiblingsData['siblings_occupation'] = '';
                $SiblingsData['siblings_married'] = $marriage;
                $SiblingsData['in_education'] = $in_education;
                $SiblingsData['in_paid_work'] = $in_paid_work;
                
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

              }
            }

          }
          if(empty($Siblings_Details)){
            $siblings_status = 1;
          }
          if($home_visit_minor_insert_status>0 && $siblings_status>0){
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

        $district_id_pk =  ($home_visit_details)?$home_visit_details['school_district']:0;
        $data['blocks'] = $this->home_visit_minor_form_model->get_block_dtls($district_id_pk);
        $school_block =  ($home_visit_details)?$home_visit_details['school_block']:0;
        $block_school = $this->home_visit_minor_form_model->get_school_dtls($school_block);
        $other_input_array = array('schcd' => '19','school_name' => 'Other institutes');
        array_push($block_school, $other_input_array);
        $data['block_school'] = $block_school;

        $login_id = $this->session->userdata('login_id');
        $data['home_visit_details'] = $home_visit_details;
        $data['districts'] = $this->Master_model->get_district();
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['gender_details'] = $this->Master_model->get_gender_details();
        $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
        $data['disability_details'] = $this->Master_model->get_disability_details();
        $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
        $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
        $data['highest_education_details'] = $this->Master_model->get_highest_education_details();
        // $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
        $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
        $data['incident_cp_details']->ward_gp_name = '';
        $data['homwvisit_siblings_dtls']=$this->home_visit_minor_form_model->get_homwvisit_siblings_dtls(
              array('cp_id_fk'=>$cp_id,'cp_type'=>$cp_type,'incident_id_fk'=>$incident_id));

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
        $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_minor_edit_form_view', $data);


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

        $this->form_validation->set_rules('disability', '<b>Disability</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('disability', '<b>Disability</b>', 'trim|numeric|max_length[2]');

        $disability = $this->input->post('disability');
        if($disability==1){
          $this->form_validation->set_rules('type_of_disability[]', 'Type of Disability', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('type_of_disability[]', 'Type of Disability', 'trim|numeric|max_length[2]');

          $this->form_validation->set_rules('disability_certificate', 'Disability Certificate',  'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('disability_certificate', 'Disability Certificate',  'trim|numeric|max_length[2]');

          $disability_certificate = $this->input->post('disability_certificate');
          if($disability_certificate==1){
            $this->form_validation->set_rules('disability_percent', '<b>Disability Percent</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('disability_percent', '<b>Disability Percent</b>', 'trim|numeric|max_length[2]');
          }else{
            $this->form_validation->set_rules('estimated_severity', '<b>Estimated Severity</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('estimated_severity', '<b>Estimated Severity</b>', 'trim|numeric|max_length[2]');
          }
        }
        $this->form_validation->set_rules('education', '<b>Education</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('education', '<b>Education</b>', 'trim|numeric|max_length[2]');
        $education = $this->input->post('education');
        if($education==1){
          $this->form_validation->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|numeric|max_length[2]');

          $this->form_validation->set_rules('cp_school_district', '<b>District</b>', 'trim|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('cp_school_district', '<b>District</b>', 'trim|numeric|max_length[2]');

          $this->form_validation->set_rules('cp_school_block', '<b>Block</b>', 'trim|numeric|max_length[4]');
          $this->form_validation_draft->set_rules('cp_school_block','<b>Block</b>', 'trim|numeric|max_length[4]');

          $this->form_validation->set_rules('bs_school_id', '<b>Institute</b>', 'trim|numeric|max_length[11]');
          $this->form_validation_draft->set_rules('bs_school_id','<b>Institute</b>' ,'trim|numeric|max_length[11]');
          $bs_school_id = $this->input->post('bs_school_id');
          if($bs_school_id=='19'){

            $this->form_validation->set_rules('school_name', '<b>Institute Name</b>', 'trim|numeric|max_length[100]');
            $this->form_validation_draft->set_rules('school_name','<b>Institute Name</b>', 'trim|numeric|max_length[100]');

          }



          
          
        }

        $this->form_validation->set_rules('kishori_group', '<b>Kishori Group</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('kishori_group', '<b>Kishori Group</b>', 'trim|numeric|max_length[2]');

        $kishori_group = $this->input->post('kishori_group');
        if($kishori_group==1){
          $this->form_validation->set_rules('kishori_group_frequency', '<b>Kishori Group Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('kishori_group_frequency', '<b>Kishori Group Frequency</b>', 'trim|numeric|max_length[2]');

        }

        $this->form_validation->set_rules('paid_work', '<b>Paid Work</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('paid_work', '<b>Paid Work</b>', 'trim|numeric|max_length[2]');
        $paid_work = $this->input->post('paid_work');
        if($paid_work==1){
          $this->form_validation->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|numeric|max_length[2]');
        }



        $this->form_validation->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|numeric|max_length[20]');
        $this->form_validation_draft->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|numeric|max_length[20]');

        $this->form_validation->set_rules('parents_supported', '<b>Parents Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('parents_supported', '<b>Parents Supported</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('family_elders_supported', '<b>Family Elders Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('family_elders_supported', '<b>Family Elders Supported</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('peers_supported', '<b>Peers Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('peers_supported', '<b>Peers Supported</b>', 'trim|numeric|max_length[2]');


        $this->form_validation->set_rules('neighbours_supported', '<b>Neighbours Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('neighbours_supported', '<b>Neighbours Supported</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('others_supported', '<b>Others Supported</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('others_supported', '<b>Others Supported</b>', 'trim|numeric|max_length[2]');

        $gender = $this->input->post('gender');
        if($gender==2){
          $this->form_validation->set_rules('minor_pregnant', '<b>Minor Pregnant</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('minor_pregnant', '<b>Minor Pregnant</b>', 'trim|numeric|max_length[2]');

          $minor_pregnant = $this->input->post('minor_pregnant');
          if($minor_pregnant==1){
            $this->form_validation->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|numeric|max_length[2]');
          }
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
          $home_visit_sl_no = $this->input->post('home_visit_sl_no');
          unset($all_post_data['home_visit_sl_no']);

          function remove_empty_arrays($array) {
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $array[$key] = remove_empty_arrays($value);
                }
            }
            return array_filter($array);
        }
        $filtered_data = remove_empty_arrays($all_post_data);
        if(empty($filtered_data)){

        }else{
          $home_visit_sl_no = base64_decode($home_visit_sl_no);
          $home_visit_minor_check_status = $this->home_visit_minor_form_model->home_visit_minor_details_by_id($home_visit_sl_no);
          //echo '<pre>';print_r($home_visit_minor_check_status);die();
          if(count($home_visit_minor_check_status)>0){
            $home_visit_minor_sl_no = $home_visit_minor_check_status['sl_no'];
            $siblings_details_count_status = $this->home_visit_minor_form_model->home_visit_siblings_details_count_by_id($home_visit_minor_sl_no);

            $incident_id = ($home_visit_minor_check_status)?$home_visit_minor_check_status['incident_id_fk']:'';
            $cp_id =  ($home_visit_minor_check_status)?$home_visit_minor_check_status['cp_id_fk']:'';
            $cp_type =  ($home_visit_minor_check_status)?$home_visit_minor_check_status['cp_type']:'';

          }else{
            $siblings_details_count_status = 0;
            $incident_id = '';
            $cp_id = '';
            $cp_type = '';
          }
          $action = isset($_POST['action']) ? $_POST['action'] : NULL;
          if($action=='swalSubmit'){
          $mode_of_enquiry = isset($_POST['mode_of_enquiry']) ? $_POST['mode_of_enquiry'] : NULL;
          $gender = isset($_POST['gender']) ? $_POST['gender'] : NULL;
          $family_income = isset($_POST['family_income']) ? $_POST['family_income'] : NULL;
          $nutritious_meals = isset($_POST['nutritious_meals']) ? $_POST['nutritious_meals'] : NULL;
          $neighbours_community = isset($_POST['neighbours_community']) ? $_POST['neighbours_community'] : NULL;
          $emergencies = isset($_POST['emergencies']) ? $_POST['emergencies'] : NULL;
          $disability = isset($_POST['disability']) ? $_POST['disability'] : NULL;
          $type_of_disability = isset($_POST['type_of_disability']) ? implode(",",(array) $_POST['type_of_disability']) : NULL;
          $disability_certificate = isset($_POST['disability_certificate']) ? $_POST['disability_certificate'] : NULL;
          $disability_percent = isset($_POST['disability_percent']) ? $_POST['disability_percent'] : NULL;
          $estimated_severity = isset($_POST['estimated_severity']) ? $_POST['estimated_severity'] : NULL;
          $education = isset($_POST['education']) ? $_POST['education'] : NULL;
          $education_frequency = isset($_POST['education_frequency']) ? $_POST['education_frequency'] : NULL;
          $kishori_group = isset($_POST['kishori_group']) ? $_POST['kishori_group'] : NULL;
          $kishori_group_frequency = isset($_POST['kishori_group_frequency']) ? $_POST['kishori_group_frequency'] : NULL;
          $paid_work = isset($_POST['paid_work']) ? $_POST['paid_work'] : NULL;
          $paid_work_frequency = isset($_POST['paid_work_frequency']) ? $_POST['paid_work_frequency'] : NULL;

          $cp_highest_educational_attainment = isset($_POST['cp_highest_educational_attainment']) ? $_POST['cp_highest_educational_attainment'] : NULL;

          $cp_school_district = isset($_POST['cp_school_district']) ? $_POST['cp_school_district'] : NULL;
          $cp_school_block = isset($_POST['cp_school_block']) ? $_POST['cp_school_block'] : NULL;
          $bs_school_id = isset($_POST['bs_school_id']) ? $_POST['bs_school_id'] : NULL;
          $school_name = isset($_POST['school_name']) ? $_POST['school_name'] : NULL;
          $kanyashree_id = isset($_POST['kanyashree_id']) ? $_POST['kanyashree_id'] : NULL;
          $parents_supported = isset($_POST['parents_supported']) ? $_POST['parents_supported'] : NULL;
          $family_elders_supported = isset($_POST['family_elders_supported']) ? $_POST['family_elders_supported'] : NULL;
          $peers_supported = isset($_POST['peers_supported']) ? $_POST['peers_supported'] : NULL;
          $neighbours_supported = isset($_POST['neighbours_supported']) ? $_POST['neighbours_supported'] : NULL;
          $others_supported = isset($_POST['others_supported']) ? $_POST['others_supported'] : NULL;
          $minor_pregnant = isset($_POST['minor_pregnant']) ? $_POST['minor_pregnant'] : NULL;
          $stage_of_pregnancy_cls = isset($_POST['stage_of_pregnancy_cls']) ? $_POST['stage_of_pregnancy_cls'] : NULL;
          $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : NULL;

           

          
          $homeVisitData['incident_id_fk'] =  $incident_id;
          $homeVisitData['cp_id_fk'] =  $cp_id;
          $homeVisitData['cp_type'] =  $cp_type;
          $homeVisitData['mode_of_enquiry'] =  $mode_of_enquiry;
          $homeVisitData['gender'] =  $gender;
          $homeVisitData['family_income'] =  $family_income;
          $homeVisitData['nutritious_meals'] =  $nutritious_meals;
          $homeVisitData['neighbours_community'] =  $neighbours_community;
          $homeVisitData['emergencies'] =  $emergencies;
          $homeVisitData['disability'] =  $disability;
          $homeVisitData['type_of_disability'] =  $type_of_disability;
          $homeVisitData['disability_certificate'] =  $disability_certificate;
          $homeVisitData['disability_percent'] =  $disability_percent;
          $homeVisitData['estimated_severity'] =  $estimated_severity;
          $homeVisitData['education'] =  $education;
          $homeVisitData['education_frequency'] =  $education_frequency;
          $homeVisitData['kishori_group'] =  $kishori_group;
          $homeVisitData['kishori_group_frequency'] =  $kishori_group_frequency;
          $homeVisitData['paid_work'] =  $paid_work;
          $homeVisitData['paid_work_frequency'] =  $paid_work_frequency;
          $homeVisitData['kanyashree_id'] =  $kanyashree_id;
          $homeVisitData['parents_supported'] =  $parents_supported;
          $homeVisitData['family_elders_supported'] =  $family_elders_supported;
          $homeVisitData['peers_supported'] =  $peers_supported;
          $homeVisitData['neighbours_supported'] =  $neighbours_supported;
          $homeVisitData['others_supported'] =  $others_supported;
          $homeVisitData['minor_pregnant'] =  $minor_pregnant;
          $homeVisitData['stage_of_pregnancy'] =  $stage_of_pregnancy_cls;
          $homeVisitData['remarks'] =  $remarks;
                   
          $homeVisitData['hv_status'] =  $formCompleteStatus;
          $homeVisitData['bs_school_id_fk'] =  ($bs_school_id)?$bs_school_id:NULL;
          $homeVisitData['school_name'] =  $school_name;
          $homeVisitData['school_district'] =  ($cp_school_district)?$cp_school_district:NULL;
          $homeVisitData['school_block'] =  ($cp_school_block)?$cp_school_block:NULL;
          $default = $this->load->database('default',TRUE);
          $default->trans_start();
          if(count($home_visit_minor_check_status)>0){
            $home_visit_minor_sl_no = $home_visit_minor_check_status['sl_no'];
            $homeVisitData['update_by'] =  $stake_holder_login_id_pk;
            $homeVisitData['update_time'] =  'now()';
            $homeVisitData['update_ip'] =  $_SERVER['REMOTE_ADDR'];
            $home_visit_minor_insert_status = $this->home_visit_minor_form_model->home_visit_minor_update($homeVisitData,$home_visit_minor_sl_no);
            $hv_id_fk = $home_visit_minor_sl_no;
          }else{
            $homeVisitData['entry_by'] =  $stake_holder_login_id_pk;
            $homeVisitData['entry_time'] =  'now()';
            $homeVisitData['entry_ip'] =  $_SERVER['REMOTE_ADDR']; 
            $home_visit_minor_insert_status = $this->home_visit_minor_form_model->home_visit_minor_insert($homeVisitData);
            $hv_id_fk = $home_visit_minor_insert_status;
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
                $in_education = isset($value['in_education']) ? $value['in_education'] : NULL;
                $in_paid_work = isset($value['in_paid_work']) ? $value['in_paid_work'] : NULL;
                
                
                $SiblingsData['siblings_name'] = $name;
                $SiblingsData['siblings_age'] = $age;
                $SiblingsData['siblings_sex'] = $sex;
                $SiblingsData['siblings_occupation'] = '';
                $SiblingsData['siblings_married'] = $marriage;
                $SiblingsData['in_education'] = $in_education;
                $SiblingsData['in_paid_work'] = $in_paid_work;
                
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

              }
            }

          }
          if(empty($Siblings_Details)){
            $siblings_status = 1;
          }
          if($home_visit_minor_insert_status>0 && $siblings_status>0){
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
       $style = ($key+1)!=count($homwvisit_siblings_dtls)?'display:none;':'display:block';
       $html.= '<tr class="Siblings_Table_Field_Remove">';
       $html.= '<td><input type="text" class="form-control" name="Siblings_Details['.$key.'][name]" placeholder="Name" autocomplete="off" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return Siblings_Name_Validate(event);" value="'.$value['siblings_name'].'"></td>';
       $html.= '<td><input type="text" class="form-control" name="Siblings_Details['.$key.'][age]" placeholder="Age" maxlength="2" autocomplete="off" oncut="return false" oncopy="return false" onpaste="return false" onkeypress="return onlyNumbers(event, this);" value="'.$value['siblings_age'].'"></td>';

       $html .= '<td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][sex]"  value="1" '.(($value["siblings_sex"]==1) ? "checked" : '').'>&nbsp;Male</label><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][sex]" value="2" '.(($value["siblings_sex"]==2) ? "checked" : '').'>&nbsp;Female</label></td>';

       $html.= '<td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][marriage]" value="1" '.(($value["siblings_married"]==1) ? "checked" : '').'>&nbsp;Yes</label><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][marriage]"  value="2" '.(($value["siblings_married"]==2) ? "checked" : '').'>&nbsp;No</label></td>';

       $html.= '<td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][in_education]" value="1" '.(($value["in_education"]==1) ? "checked" : '').'>Yes</label><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][in_education]" value="0" '.(($value["in_education"]==2) ? "checked" : '').'>No</label></td>';

       $html.= '<td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][in_paid_work]" value="1" '.(($value["in_paid_work"]==1) ? "checked" : '').'>Yes</label><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][in_paid_work]" value="0" '.(($value["in_paid_work"]==2) ? "checked" : '').'>No</label></td>';

       $html.= '<td><button type="button" id="siblings_Remove" class="btn btn-danger form-control siblings_Remove'.$key.'" style="'.$style.'" fdprocessedid="ebpxyn" onclick="remove_row('.$key.')"><i class="fa fa-trash"></i></button> </td><input type="hidden" name="Siblings_Details['.$key.'][id]" value="'.$value['sl_no'].'"></tr>';
      }
      echo $html;

    }
    
  }






  
  public function index_old($incident_id=null, $cp_type=null, $cp_id=null) 
  {
    // echo "<pre>";print_r($_REQUEST);die;
    // if($this->input->post('type_of_disability'))
    //   {echo "data achay!"; die;}

    // print_r($this->input->post('type_of_disability'));die;
    $login_id = $this->session->userdata('login_id');
    $data['districts'] = array_column($this->Master_model->get_district(), 'district_name', 'district_id_pk');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['gender_details'] = $this->Master_model->get_gender_details();
    $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
    $data['disability_details'] = $this->Master_model->get_disability_details();
    $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
    $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
    // $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
    $this->validate_login(array('4'));
    // $data=array();
    if($incident_id)
    {
      $data['incident_id'] = $incident_id;
      $incident_id = base64_decode($incident_id);
    }
    else if($this->input->post('incident_id'))
    {
      $data['incident_id'] = $this->input->post('incident_id');
      $incident_id = base64_decode($incident_id);
    }
    else
    {
      $incident_id = null;
    }

    if($cp_type)
    {
      $data['cp_type'] = $cp_type;
      $cp_type = base64_decode($cp_type);
    }
    else if($this->input->post('cp_type'))
    {
      $data['cp_type'] = $this->input->post('cp_type');
      $cp_type = base64_decode($cp_type);
    }
    else
    {
      $cp_type = null;
    }

    if($cp_id)
    {
      $data['cp_id'] = $cp_id;
      $cp_id = base64_decode($cp_id);
    }
    else if($this->input->post('cp_id'))
    {
      $data['cp_id'] = $this->input->post('cp_id');
      $cp_id = base64_decode($cp_id);
    }
    else
    {
      $cp_id = null;
    }

    //CP name & address 

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

     

    // echo "<pre>";print_r($data['incident_cp_details']);die;



    // echo $incident_id."<br>";
    // $data['selected_fields'] = "A.*,
    //                             E.sl_no AS sl_no_sibling, 
    //                             E.hv_id_fk ,
    //                             E.siblings_name ,
    //                             E.siblings_age ,
    //                             E.siblings_sex ,
    //                             E.siblings_occupation ,
    //                             E.incident_id_fk AS cp_incident_id_siblings ,
    //                             E.cp_id_fk AS cp_id_siblings ,
    //                             E.cp_type AS cp_type_siblings ";


    $data['selected_fields'] = "A.*,
                                G.incident_date,
                                G.reporting_id,
                                B.cp_name,
                                B.cp_age,
                                B.cp_gender,
                                B.cp_block,
                                B.cp_ward_gp,
                                B.cp_highest_educational_attainment,
                                F.description as status,
                                H.description as cp_gender_val,
                                 ";



    $get_dtls = array(
                        'cp_id_fk'=>$cp_id,
                        'cp_type'=>$cp_type,
                        'get'=>1,
                        'incident_id_fk'=>$incident_id,
                        'party_details'=>1,
                        'incident_details'=>101,
                        'cp_gender_details'=>1,
                        'hv_status_details'=>11,
                        'selected_fields'=>$data['selected_fields']
          );

    $data['hv_status'] = 0;
    $data['sl_no']=$sl_no= 0 ;
    $data['add_edit_status']= 0 ;
    // $data['homwvisit_dtls']=$this->home_visit_minor_form_model->get_homwvisit_dtls(
    //       array('cp_id_fk'=>$cp_id,'cp_type'=>$cp_type,'get'=>1,'incident_id_fk'=>$incident_id));

    $data['homwvisit_dtls']=$this->home_visit_minor_form_model->get_homwvisit_dtls($get_dtls);

    (isset($data['homwvisit_dtls']['type_of_disability']))?($data['homwvisit_dtls']['type_of_disability_array'] = explode(',', $data['homwvisit_dtls']['type_of_disability'])):'';
    
    // if(count($data['homwvisit_dtls']))

    // $data['homwvisit_siblings_dtls']=$this->home_visit_minor_form_model->get_homwvisit_siblings_dtls(
    //       array('cp_id_fk'=>$cp_id,'cp_type'=>$cp_type,'get'=>1,'incident_id_fk'=>$incident_id));
    $data['homwvisit_siblings_dtls']=$this->home_visit_minor_form_model->get_homwvisit_siblings_dtls(
          array('cp_id_fk'=>$cp_id,'cp_type'=>$cp_type,'incident_id_fk'=>$incident_id));

    // (isset($data['homwvisit_siblings_dtls']['siblings_occupation']))?($data['homwvisit_siblings_dtls']['siblings_occupation_array'] = explode(',', $data['homwvisit_siblings_dtls']['siblings_occupation'])):'';

    // echo"<pre>";print_r($data['homwvisit_dtls']);echo"</pre>";
    // echo "<br>";
    // echo"<pre>";print_r($data['homwvisit_siblings_dtls']);echo"</pre>";
    $insert_update_state = 0;
    if(!empty($data['homwvisit_dtls']))
    {
      $data['sl_no'] = $data['homwvisit_dtls']['sl_no'];
      $data['hv_status'] = $data['homwvisit_dtls']['hv_status'];
      if($data['homwvisit_dtls']['hv_status']==1)
      {
        $data['add_edit_status']= 1;
      }

      $insert_update_state = 1;
      $final_array_where['cp_id_fk'] = $cp_id;
      $final_array_where['incident_id_fk'] = $incident_id;
      $final_array_where['cp_type'] = $cp_type;
    }

    $insert_update_sibling_state = 0;     
    if(!empty($data['homwvisit_siblings_dtls']))
    {
      $insert_update_sibling_state = 1;
      foreach ($data['homwvisit_siblings_dtls'] as $key => $value) 
      {
        $data['homwvisit_siblings_dtls'][$key]['siblings_occupation_array']=(isset($value['siblings_occupation']))?(explode(',', $value['siblings_occupation'])):$data['homwvisit_siblings_dtls'][$key]['siblings_occupation_array']=NULL;

        // $data1['homwvisit_siblings_dtls'][$key]['siblings_occupation_array']=(isset($value['siblings_occupation']))?(explode(',', $value['siblings_occupation'])):$data1['homwvisit_siblings_dtls'][$key]['siblings_occupation_array']=NULL;
      }     
    }

    // echo "<pre>";print_r($data['homwvisit_siblings_dtls']);die; 
    $data['highest_education_details'] = $this->Master_model->get_highest_education_details();
    $data['error']=array();

    $submit=$this->input->post('submit1');
    if($submit==1)
    {
      // echo "<pre>";print_r($this->input->post('gender'));die;
      $this->load->library('form_validation');
      $this->form_validation->set_error_delimiters('<span class=error>', '</span>');
      $add_edit_status=$this->input->post('add_edit_status');
      $submit_status=$this->input->post('submit_status');

      // save as draft | final submit 

      $final_array=array();
      $final_array['cp_id_fk'] = $cp_id;
      $final_array['incident_id_fk'] = $incident_id;
      $final_array['cp_type'] = $cp_type;
      $final_array['entry_by'] = $this->session->userdata('stake_holder_login_id_pk');
      $final_array['entry_time'] = date('Y-m-d H:i:s');
      $final_array['entry_ip'] = $_SERVER['REMOTE_ADDR'];

      // echo "<pre>";print_r($final_array);die;

      
      if($submit_status == 0)
      {
        $final_array['hv_status'] = 0;
      }
      else if($submit_status == 1)
      {
        $final_array['hv_status'] = 1;
      }
      // $total_mand_field=10;
      if($this->input->post('mode_of_enquiry') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('mode_of_enquiry', 'mode of enquiry', 'required|is_not_unique[cm_mode_of_enquiry_master.sl_no]');
        $final_array['mode_of_enquiry']= $this->input->post('mode_of_enquiry');
      }    
      if($this->input->post('gender') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('gender', 'gender', 'required|is_not_unique[cm_gender_master.cm_gender_master_id_pk]');
        $final_array['gender']= $this->input->post('gender');
      }    
      if($this->input->post('family_income') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('family_income', 'family income', 'required');
        $final_array['family_income']= $this->input->post('family_income');
      }    
      if($this->input->post('nutritious_meals') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('nutritious_meals', 'nutritious meals', 'required');
        $final_array['nutritious_meals']= $this->input->post('nutritious_meals');
      }    
      if($this->input->post('neighbours_community') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('neighbours_community', 'neighbours community', 'required');
        $final_array['neighbours_community']= $this->input->post('neighbours_community');
      }    
      if($this->input->post('emergencies') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('emergencies', 'emergencies', 'required');
        $final_array['emergencies']= $this->input->post('emergencies');
      }

      if($this->input->post('disability') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('disability', 'disability', 'required');
        $final_array['disability']= $this->input->post('disability');
        if($this->input->post('disability')==1)
        {
          // if($add_edit_status==1 || $submit_status==1)
          // {

            if(!empty($this->input->post('type_of_disability'))|| $add_edit_status==1 || $submit_status==1)
            {
              $this->form_validation->set_rules('type_of_disability[]', 'type_of_disability', 'callback_check_checkbox');
              $final_array['type_of_disability']= implode(",",(array) $this->input->post('type_of_disability'));
              // echo $final_array['type_of_disability'];die;
            }      
            if($this->input->post('disability_certificate')|| $add_edit_status==1 || $submit_status==1)
            {
              $this->form_validation->set_rules('disability_certificate', 'disability_certificate', 'required');
              $final_array['disability_certificate']= $this->input->post('disability_certificate');
              if($this->input->post('disability_certificate') ==1)
              {
                if($this->input->post('disability_percent') || $add_edit_status==1 || $submit_status==1)
                {
                  $this->form_validation->set_rules('disability_percent', 'disability_percent', 'required');
                  $final_array['disability_percent']= $this->input->post('disability_percent');
                  $final_array['estimated_severity'] = null;
                }
              }
              elseif($this->input->post('disability_certificate') ==2)
              {
                if($this->input->post('estimated_severity') || $add_edit_status==1 || $submit_status==1)
                {
                  $this->form_validation->set_rules('estimated_severity', 'estimated_severity', 'required|is_not_unique[cm_estimated_severity_master.sl_no]');
                  $final_array['estimated_severity']= $this->input->post('estimated_severity');
                  $final_array['disability_percent'] = null;
                }
              }
            }
          // }


        }
      }
      if($this->input->post('education') || $add_edit_status==1 || $submit_status==1)
      {

        $this->form_validation->set_rules('education', 'education', 'required');
        $final_array['education']= $this->input->post('education');
        if($this->input->post('education') == 1)
        {
          // $this->form_validation->set_rules('education', 'education', 'required');
          // $final_array['education']= $this->input->post('education');
          if($this->input->post('education_frequency') || $add_edit_status==1 || $submit_status==1)
          {
            $this->form_validation->set_rules('education_frequency', 'education_frequency', 'required');
            $final_array['education_frequency']= $this->input->post('education_frequency');
          }

          // // Highest Educational Attainment
          // if($this->input->post('cp_highest_educational_attainment') || $add_edit_status==1 || $submit_status==1)
          // {
          //   $this->form_validation->set_rules('cp_highest_educational_attainment', 'cp_highest_educational_attainment', 'required');
          //   $cp_data['cp_highest_educational_attainment']= $this->input->post('cp_highest_educational_attainment');
          //   $cp_where['incident_id_fk'] = $incident_id;
          //   $cp_where['cp_type'] = $cp_type;
          // }


          if($this->input->post('cp_school_district') || $add_edit_status==1 || $submit_status==1)
          {
            $this->form_validation->set_rules('cp_school_district', 'cp_school_district', 'required');
            $final_array['school_district']= $this->input->post('cp_school_district');
          }
          if($this->input->post('cp_school_block') || $add_edit_status==1 || $submit_status==1)
          {
            $this->form_validation->set_rules('cp_school_block', 'cp_school_block', 'required');
            $final_array['school_block']= $this->input->post('cp_school_block');
          }

          if($this->input->post('school_unavailable'))
          {
            if($this->input->post('school_name') || $add_edit_status==1 || $submit_status==1)
            {
              $this->form_validation->set_rules('school_name', 'school_name', 'required');
              $final_array['school_name']= $this->input->post('school_name');
              $final_array['bs_school_id_fk'] = null;
            }
          }
          else
          {
            if($this->input->post('bs_school_id') || $add_edit_status==1 || $submit_status==1)
            {
              $this->form_validation->set_rules('bs_school_id', 'bs_school_id', 'required');
              $final_array['bs_school_id_fk']= $this->input->post('bs_school_id');
              $final_array['school_name'] = null;
            }
          }
        }
        else
        {
          $final_array['education_frequency'] = null;
        }

        
      }
      //   if($this->input->post('education') ==1)
      //   {
      //     if($this->input->post('education_frequency') || $add_edit_status==1 || $submit_status==1)
      //     {
      //       $this->form_validation->set_rules('education_frequency', 'education_frequency', 'required');
      //       $final_array['education_frequency']= $this->input->post('education_frequency');
      //     }
      //   }
      // }      
      if($this->input->post('kishori_group') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('kishori_group', 'kishori_group', 'required');
        $final_array['kishori_group']= $this->input->post('kishori_group');
        if($this->input->post('kishori_group') ==1)
        {
          if($this->input->post('kishori_group_frequency') || $add_edit_status==1 || $submit_status==1)
          {
            $this->form_validation->set_rules('kishori_group_frequency', 'kishori_group_frequency', 'required');
            $final_array['kishori_group_frequency']= $this->input->post('kishori_group_frequency');
          }
        }
      }
      if($this->input->post('paid_work') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('paid_work', 'paid_work', 'required');
        $final_array['paid_work']= $this->input->post('paid_work');
        if($this->input->post('paid_work') ==1 )
        {
          if($this->input->post('paid_work_frequency') || $add_edit_status==1 || $submit_status==1)
          {
            $this->form_validation->set_rules('paid_work_frequency', 'paid_work_frequency', 'required');
            $final_array['paid_work_frequency']= $this->input->post('paid_work_frequency');
          }
        }
      }
      if($this->input->post('parents_supported') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('parents_supported', 'parents_supported', 'required');
        $final_array['parents_supported']= $this->input->post('parents_supported');
      }
      if($this->input->post('family_elders_supported') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('family_elders_supported', 'family_elders_supported', 'required');
        $final_array['family_elders_supported']= $this->input->post('family_elders_supported');
      }
      if($this->input->post('peers_supported') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('peers_supported', 'peers_supported', 'required');
        $final_array['peers_supported']= $this->input->post('peers_supported');
      }
      if($this->input->post('neighbours_supported') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('neighbours_supported', 'neighbours_supported', 'required');
        $final_array['neighbours_supported']= $this->input->post('neighbours_supported');
      }
      if($this->input->post('others_supported') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('others_supported', 'others_supported', 'required');
        $final_array['others_supported']= $this->input->post('others_supported');
      }

      $final_array['minor_pregnant'] = $final_array['stage_of_pregnancy'] = null;
      if ($this->input->post('gender')==2) 
      {
        if($this->input->post('minor_pregnant') || $add_edit_status==1 || $submit_status==1)
        {
          $this->form_validation->set_rules('minor_pregnant', 'minor_pregnant', 'required');
          $final_array['minor_pregnant']= $this->input->post('minor_pregnant');
          if($this->input->post('minor_pregnant') ==1)
          {
            if($this->input->post('stage_of_pregnancy') || $add_edit_status==1 || $submit_status==1)
            {
              $this->form_validation->set_rules('stage_of_pregnancy', 'stage_of_pregnancy', 'required');
              $final_array['stage_of_pregnancy']= $this->input->post('stage_of_pregnancy');
            }
          }
        }
      }
     
        // echo "<pre>";print_r($final_array['school_unavailable']);die;

      $custom_validate = 0;
      if($this->input->post('Siblings_Details') || $add_edit_status==1 || $submit_status==1)
      {
        //$this->form_validation->set_rules('Siblings_Details[]', 'Siblings_Details', 'required');
        
      // add more field
        // $siblings = array();
        $siblings=$this->input->post('Siblings_Details');
        // echo "<pre>";print_r($siblings);echo"</pre>";die;


        // $siblingsdata = array();
        if(!empty($siblings))
        {
          foreach ($siblings as $key => $value)
          {
            // $key -=1;
            $siblingsdata[$key]['siblings_name']=(isset($value['name']))?$value['name']:NULL;
            $siblingsdata[$key]['siblings_age']=(isset($value['age']))?$value['age']:NULL;
            $siblingsdata[$key]['siblings_married']=(isset($value['marriage']))?$value['marriage']:NULL;

            $siblingsdata[$key]['siblings_sex']=(isset($value['sex']))?$value['sex']:NULL;
            // $siblingsdata[$key]['siblings_occupation']=(isset($value['occupation']))?$value['occupation']:NULL;
            $siblingsdata[$key]['siblings_occupation']=(isset($value['occupation']))?(implode(",",(array)$value['occupation'])):NULL;

            if($siblingsdata[$key]['siblings_name'] || $siblingsdata[$key]['siblings_age'] || $siblingsdata[$key]['siblings_sex'] || $siblingsdata[$key]['siblings_occupation']|| $siblingsdata[$key]['siblings_married'])
            {
              if($siblingsdata[$key]['siblings_name'] =='')
              {
                $custom_validate = 1;
                $data['Siblings_Details_error'][$key]['name'] = "Please enter valid name" ;
              }
              if($siblingsdata[$key]['siblings_age'] =='')
              {
                $custom_validate += 1;
                $data['Siblings_Details_error_age'][$key]['age'] = "Please enter valid age" ;
              }
              if($siblingsdata[$key]['siblings_sex'] =='')
              {
                $custom_validate += 1;
                $data['Siblings_Details_error_sex'][$key]['sex'] = "Please enter gender" ;
              }
              if($siblingsdata[$key]['siblings_married'] =='')
              {
                $custom_validate += 1;
                $data['Siblings_Details_error_marriage'][$key]['marriage'] = "Please enter sibling marriage field" ;
              }
              if($siblingsdata[$key]['siblings_occupation'] =='')
              {
                $custom_validate += 1;
                $data['Siblings_Details_error_occupation'][$key]['occupation'] = "Please enter occupation" ;
              }
            }


            if(isset($value['occupation']))
            {
              $siblingsdata[$key]['siblings_occupation_array']=$value['occupation'];
            }
            else
            {
              $siblingsdata[$key]['siblings_occupation_array'] = array();
            }

            // $siblingsdata[$key]['siblings_occupation_array']=(isset($value['occupation'])?($value['occupation']):array();

            $siblingsdata[$key]['cp_id_fk'] = $cp_id;
            $siblingsdata[$key]['incident_id_fk'] = $incident_id;
            $siblingsdata[$key]['cp_type'] = $cp_type;
          }


          $data['homwvisit_siblings_dtls']=$siblingsdata;

          foreach ($siblingsdata as $key =>$value) 
          {
            unset($siblingsdata[$key]['siblings_occupation_array']);
            // unset($value['siblings_occupation_array']);
          }

            // echo "<pre>";
            // print_r($siblingsdata);
            // die;
        }

        $siblingsdata_where = array();
        $siblingsdata_where['cp_id_fk'] = $cp_id;
        $siblingsdata_where['incident_id_fk'] = $incident_id;
        $siblingsdata_where['cp_type'] = $cp_type;

      }

        // echo "<pre>";print_r($siblingsdata);die;

      if($this->input->post('kanyashree_id'))
      {
         // $this->form_validation->set_rules('kanyashree_id', 'kanyashree_id', 'maxlength[20]');
         $this->form_validation->set_rules('kanyashree_id', 'Kanyashree ID', 'maxlength[20]', array('maxlength' => 'The {field} field cannot exceed 20 characters in length.'));
         $final_array['kanyashree_id']= $this->input->post('kanyashree_id');
      }

      if ($this->form_validation->run() == TRUE && $custom_validate == 0)
      {
        // if(isset($cp_data) && isset($cp_type))
        // {
        //   $cp_details =  $this->home_visit_minor_form_model->update_cp_dtls($cp_data,$cp_where);
        // }

        if($insert_update_state ==0)
        {
          //insert
          $result = $this->home_visit_minor_form_model->insert_home_visit_dtls($final_array);
        }
        else
        {
          //update
          $result = $this->home_visit_minor_form_model->update_home_visit_dtls($final_array,$final_array_where);
        }
        if($insert_update_sibling_state==0)
        {
          // echo "working?";
          if(isset($siblingsdata))
          {
            $result_sibling = $this->home_visit_minor_form_model->insert_home_visit_sibling_dtls($siblingsdata);
          }
        }
        else
        {
          if(isset($siblingsdata))
          {
            $result_sibling = $this->home_visit_minor_form_model->update_home_visit_sibling_dtls($siblingsdata,$siblingsdata_where);
          }
        }

        // $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_minor_form_view', $data);

        // echo "<pre>";print_r($data);die;
         // $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_list_view', $data);
        // echo $add_edit_status;die;
        redirect('admin/reporting/home_visit/home_visits_list');
      }
      // echo validation_errors('<div class="error">', '</div>');


    }

    
    // $login_id = $this->session->userdata('login_id');
    // $data['districts'] = array_column($this->Master_model->get_district(), 'district_name', 'district_id_pk');
    // $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    // $data['gender_details'] = $this->Master_model->get_gender_details();
    // $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
    // $data['disability_details'] = $this->Master_model->get_disability_details();
    // $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
    // $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
    // $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);

    // echo "<pre>";print_r($data);die;
    // $data['Siblings_Details_error'][]['name'] = array();

    // $Siblings_Details_error[$key]['name']
    $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_minor_form_view', $data);
  }

  // public function home_visit_minor_form_edit($home_visit_id)
  // {
  //     $home_visit_id = base64_decode($home_visit_id);
  //     $login_id = $this->session->userdata('login_id');
  //     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
  //     $data['gender_details'] = $this->Master_model->get_gender_details();
  //     $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
  //     $data['disability_details'] = $this->Master_model->get_disability_details();
  //     $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
  //     $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
  //     $data['home_visit_minor_details'] = $this->home_visit_minor_form_model->get_home_visit_minor_details($home_visit_id);
  //     $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_minor_form_edit_view', $data);
  // }

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

  public function implodeArray($data = array()) 
  {
    // echo"<pre>";print_r($data);echo"</pre>";   
      return implode(",", $data);
  }
  public function check_checkbox($input)
  {
    // echo "<pre>";print_r($input);die;
    if (empty($input))
    {
        $this->form_validation->set_message('check_checkbox', 'Please select at least one checkbox.');
        return FALSE;
    } 
    else 
    {
        return TRUE;
    }
  }

  public function getBlockDtlsByDistId()
  {
    $district_id = $this->input->get('id');
    $block = $this->home_visit_minor_form_model->get_block_dtls($district_id);
    echo json_encode($block);
  }
  public function getSchoolDtlsByDistId()
  {
    $block_id = $this->input->get('id');
    $block_school = $this->home_visit_minor_form_model->get_school_dtls($block_id);
    $other_input_array = array('schcd' => '19','school_name' => 'Other institutes');
    array_push($block_school, $other_input_array);

    echo json_encode($block_school);
  }
}
