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
      // 2 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
    );
    // $login_id = $this->session->userdata('login_id');
    //echo $login_id;
    // if($login_id=='DEO.Amta-i.Howrah' || $login_id=='DEO.Khanakul-ii.Hooghly')
    // {

    // }else{
    //   //redirect('admin/dashboard', 'location');
    // }
  } 


//  public function test(){
    
//     $sql_query = "select inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp, inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district, block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station, inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details, inc.location_description AS location_description, inc.anonymous, inc.identity_known_name, inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id, inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district, block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code, inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received, inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at, cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark, cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name, district_location_master_description(cp1.cp_district) AS cp_1_district, block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id, cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no, gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender, cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion, cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id, cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available, cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type, cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name, cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive, cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type, cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address, cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark, cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name, district_location_master_description(cp2.cp_district) AS cp_2_district, block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id, cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no, gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender, cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion, cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id, cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available, cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type, cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name, cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive, cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type, cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address 


//     from cm_incident_report inc left join cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk and cp1.cp_type = 1 left join cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk and cp2.cp_type = 2";
//     echo "<pre>";
//     $result = $this->db->query($sql_query)->result_array();

//     //print_r($result);die();
//     foreach($result as $value){
//       //print_r($value);die();
//       $marriage_details = $value['marriage_details'];
//       $incident_date = $value['incident_date'];
//       $marriage_date = $value['marriage_date'];
//       $cp_1_dob = $value['cp_1_dob'];
//       $cp_2_dob = $value['cp_2_dob'];
//       $cp_1_id_pk = $value['cp_1_id_pk'];
//       $cp_2_id_pk = $value['cp_2_id_pk'];

//       echo $marriage_details.'==1<br>'.$incident_date.'==2<br>'.$marriage_date.'==3<br>'.$cp_1_dob.'==4<br>'.$cp_2_dob;

//       if($marriage_details==3){
//         $test_date = $marriage_date;
//       }else{
//         $test_date = $incident_date;
//       }


//       $cp_age_month =  $cp_1_dob;

//     //$cp_age_month = date('Y-m-d',strtotime($cp_age_month));
//     //$test_date = date('Y-m-d',strtotime($test_date));

// if(!empty($test_date)){
//    $dob_date = new DateTime($cp_age_month);
//     $today = new DateTime($test_date);
//     $diff = $today->diff($dob_date);
//     $cp_1_years = $diff->y;
//     $cp_1_months = $diff->m;
//     $cp_1_days = $diff->d;
//   //echo $cp_1_years.'=='.$cp_1_months.'=='.$cp_1_days."<br>";
//    $cp_1_msg = $cp_1_years.' Years, '.$cp_1_months.' Months, '.$cp_1_days.' Days';
// $this->db->where('cp_id_pk',$cp_1_id_pk);
// $this->db->update('cm_incident_report_contracting_parties',array('cp_age_months'=>$cp_1_msg));

// //echo $this->db->last_query();die;
// }else{
//   //echo "not";
// }
   

  
//   if(!empty($cp_2_dob)){

//     $cp_2_dob = new DateTime($cp_2_dob);
//     $today = new DateTime($test_date);
//     $diff2 = $today->diff($cp_2_dob);
//     $cp_2_years = $diff2->y;
//     $cp_2_months = $diff2->m;
//     $cp_2_days = $diff2->d;

//     $cp_2_msg = $cp_2_years.' Years, '.$cp_2_months.' Months, '.$cp_2_days.' Days';
//   $this->db->where('cp_id_pk',$cp_2_id_pk);
//   $this->db->update('cm_incident_report_contracting_parties',array('cp_age_months'=>$cp_2_msg));


//   }

  
//     //die();
//     }
//     /*echo "<pre>";
//     print_r($result);*/
// }



  public function index($incident_id=null, $cp_type=null, $cp_id=null) 
  {
    //echo "hello";die;
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
     
    $data['incident_cp_details']=$incident_cp_details= $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);

    $cp_district_id = ($incident_cp_details)?$incident_cp_details->cp_district:'';
    $cp_block_id = ($incident_cp_details)?$incident_cp_details->cp_block:'';
    $data['blocks'] = $this->home_visit_minor_form_model->get_block_dtls($cp_district_id);

    // echo '--->>'.$cp_block_id;
    $block_school = $this->home_visit_minor_form_model->get_school_dtls($cp_block_id);
    $other_input_array = array('schcd' => '19','school_name' => 'Other institutes');
    array_push($block_school, $other_input_array);
    $data['block_school'] = $block_school;

    $data['districts'] = $this->Master_model->get_district();
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['gender_details'] = $this->Master_model->get_gender_details();
    $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
    $data['disability_details'] = $this->Master_model->get_disability_details();
    $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
    $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
    $data['highest_education_details'] = $this->Master_model->get_highest_education_details();
    // $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
    
    $data['incident_cp_details']->ward_gp_name = '';
    $data['homwvisit_siblings_dtls_count'] = $this->home_visit_minor_form_model->homwvisit_siblings_dtls_count_by_hvm_id(array('incident_id_fk'=>$incident_id,'cp_id_fk'=>$cp_id,'cp_type'=>$cp_type,'delete_status'=>0));

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
        $this->form_validation->set_rules('home_enquiry_date', '<b>Home Enquiry Date</b>', 'trim|required');
        $this->form_validation_draft->set_rules('home_enquiry_date', '<b>Home Enquiry Date</b>', 'trim');
        $this->form_validation->set_rules('hv_cp_age', '<b>Age</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('hv_cp_age', '<b>Age</b>', 'trim|numeric|max_length[2]');

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

            $this->form_validation->set_rules('school_name', '<b>Institute Name</b>', 'trim|required|max_length[100]');
            $this->form_validation_draft->set_rules('school_name','<b>Institute Name</b>', 'trim|max_length[100]');

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



        // $this->form_validation->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|numeric|max_length[20]');
        // $this->form_validation_draft->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|numeric|max_length[20]');

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
        $kp_availed_value = $this->input->post('kp_availed');
        if($gender==2){
          $this->form_validation->set_rules('minor_pregnant', '<b>Minor Pregnant</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('minor_pregnant', '<b>Minor Pregnant</b>', 'trim|numeric|max_length[2]');

          $this->form_validation->set_rules('kp_availed', '<b>Kanyashree Availed</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('kp_availed', '<b>Kanyashree Availed</b>', 'trim|numeric|max_length[2]');

          $minor_pregnant = $this->input->post('minor_pregnant');
          if($minor_pregnant==1){
            $this->form_validation->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|numeric|max_length[2]');
          }

          if($kp_availed_value==1){
            // $this->form_validation->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|required|numeric|max_length[20]');
           // $this->form_validation_draft->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|numeric|max_length[20]');
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
          // $home_enquiry_date =  isset($_POST['home_enquiry_date']) ? $this->us_date_format($_POST['home_enquiry_date']) : NULL; 
          $home_enquiry_date =  isset($_POST['home_enquiry_date']) ? $this->us_date_format_db($_POST['home_enquiry_date']) : NULL; 
          $hv_cp_age = isset($_POST['hv_cp_age']) ? $_POST['hv_cp_age'] : NULL;

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
          $stage_of_pregnancy_cls = isset($_POST['stage_of_pregnancy']) ? $_POST['stage_of_pregnancy'] : NULL;
          $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : NULL;



          $kp_availed = isset($_POST['kp_availed']) ? $_POST['kp_availed'] : NULL;


           

          
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

          $homeVisitData['parents_supported'] =  $parents_supported;
          $homeVisitData['family_elders_supported'] =  $family_elders_supported;
          $homeVisitData['peers_supported'] =  $peers_supported;
          $homeVisitData['neighbours_supported'] =  $neighbours_supported;
          $homeVisitData['others_supported'] =  $others_supported;
          $homeVisitData['minor_pregnant'] =  $minor_pregnant;
          $homeVisitData['stage_of_pregnancy'] =  $stage_of_pregnancy_cls;
          $homeVisitData['home_enquiry_date'] =  ($home_enquiry_date)?$home_enquiry_date:NULL;
          $homeVisitData['age_of_home_enquiry'] = ($hv_cp_age)?$hv_cp_age:NULL;
          $homeVisitData['remarks'] =  $remarks;
                   
          $homeVisitData['hv_status'] =  $formCompleteStatus;


          if($education==1)
          {
          $homeVisitData['bs_school_id_fk'] =  ($bs_school_id)?$bs_school_id:NULL;
          $homeVisitData['school_name'] =  $school_name;
          $homeVisitData['school_district'] =  ($cp_school_district)?$cp_school_district:NULL;
          $homeVisitData['school_block'] =  ($cp_school_block)?$cp_school_block:NULL;
          }else
          {
            $homeVisitData['bs_school_id_fk'] = NULL;
            $homeVisitData['school_name'] = NULL;
            $homeVisitData['school_district'] = NULL;
            $homeVisitData['school_block'] = NULL;
          }


          $homeVisitData['kp_availed'] =  ($kp_availed)?$kp_availed:NULL;


          if($gender == 2)
          {
            if($kp_availed==1){
              $homeVisitData['kp_availed'] =  ($kp_availed)?$kp_availed:NULL;
              $homeVisitData['kanyashree_id'] =  $kanyashree_id;
            }else{
              $homeVisitData['kp_availed'] =  ($kp_availed)?$kp_availed:NULL;
              $homeVisitData['kanyashree_id'] =  NULL;
            }
          }


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
          $siblingSlNo = isset($_POST['siblingSlNo']) ? $_POST['siblingSlNo'] : array();
          if(empty($Siblings_Details)){
            $sibling_last_id = array();
          }else{
            $sibling_last_id = array_column($Siblings_Details, 'id');
          }

          
          $deleteSiblingSlNo = array_merge(array_diff($sibling_last_id, $siblingSlNo), array_diff($siblingSlNo, $sibling_last_id));

          if(!empty($deleteSiblingSlNo)){
            foreach($deleteSiblingSlNo as $value){
              $deleteSiblingSlNoData[] = array('sl_no'=>$value,'delete_status'=>1,'delete_by'=>$stake_holder_login_id_pk,'delete_time'=>'now()','delete_ip'=>$_SERVER['REMOTE_ADDR']);
            }
            $siblings_update_delete_status = $this->home_visit_minor_form_model->home_visit_siblings_details_update_batch($deleteSiblingSlNoData);
          }else{
            $siblings_update_delete_status = 1;
          }
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
          if($home_visit_minor_insert_status>0 && $siblings_status>0 && $siblings_update_delete_status>0){
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


      // echo "<pre>";print_r($home_visit_details);die;

      // if(!empty($home_visit_details))
      // {
      //   $incident_dtls  = $this->home_visit_minor_form_model->get_incident_details($home_visit_details->['incident_id_fk']);

      // }

      // $home_visit_details['home_enquiry_date'] = $this->us_date_format_ddmmyyyy($home_visit_details['home_enquiry_date']);
      // echo $home_visit_details['home_enquiry_date'];die;
      if(empty($home_visit_details)){
         redirect('admin/reporting/home_visit/home_visits_list/', 'location');
      }else{
        $incident_id =  ($home_visit_details)?$home_visit_details['incident_id_fk']:'';
        $cp_id =  ($home_visit_details)?$home_visit_details['cp_id_fk']:'';
        $cp_type =  ($home_visit_details)?$home_visit_details['cp_type']:'';
        $data['incident_cp_details']=$incident_cp_details= $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);

        $cp_district_id = ($incident_cp_details)?$incident_cp_details->cp_district:'';
        $cp_block_id = ($incident_cp_details)?$incident_cp_details->cp_block:'';

        $school_district_id = ($home_visit_details)?$home_visit_details['school_district']:'';
         $school_block_id = ($home_visit_details)?$home_visit_details['school_block']:'';

         $district_id_pk = ($school_district_id)?$school_district_id:$cp_district_id;
         $school_block = ($school_block_id)?$school_block_id:$cp_block_id;

        $data['blocks'] = $this->home_visit_minor_form_model->get_block_dtls($district_id_pk);

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
        
        $data['incident_cp_details']->ward_gp_name = '';

        $data['homwvisit_siblings_dtls_count'] = $this->home_visit_minor_form_model->homwvisit_siblings_dtls_count_by_hvm_id(array('hv_id_fk'=>$sl_no,'delete_status'=>0));


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
        $this->form_validation->set_rules('home_enquiry_date', '<b>Home Enquiry Date</b>', 'trim|required');
        $this->form_validation_draft->set_rules('home_enquiry_date', '<b>Home Enquiry Date</b>', 'trim');
        $this->form_validation->set_rules('hv_cp_age', '<b>Age</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('hv_cp_age', '<b>Age</b>', 'trim|numeric|max_length[2]');
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

          $this->form_validation->set_rules('cp_school_district', '<b>District</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('cp_school_district', '<b>District</b>', 'trim|numeric|max_length[2]');

          $this->form_validation->set_rules('cp_school_block', '<b>Block</b>', 'trim|required|numeric|max_length[4]');
          $this->form_validation_draft->set_rules('cp_school_block','<b>Block</b>', 'trim|numeric|max_length[4]');

          $this->form_validation->set_rules('bs_school_id', '<b>Institute</b>', 'trim|required|numeric|max_length[11]');
          $this->form_validation_draft->set_rules('bs_school_id','<b>Institute</b>' ,'trim|numeric|max_length[11]');
          $bs_school_id = $this->input->post('bs_school_id');
          if($bs_school_id=='19'){

            $this->form_validation->set_rules('school_name', '<b>Institute Name</b>', 'trim|required|max_length[100]');
            $this->form_validation_draft->set_rules('school_name','<b>Institute Name</b>', 'trim|max_length[100]');

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

        




        // $gender = $this->input->post('gender');
        // $kp_availed_value = $this->input->post('kp_availed');

        // if($gender == 2)
        // {
        //   if($kp_availed_value==1){
        //     $this->form_validation->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|required|numeric|max_length[20]');
        //    $this->form_validation_draft->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|numeric|max_length[20]');
        //   }
        // }

        $kp_availed_value = $this->input->post('kp_availed');
        $gender = $this->input->post('gender');
        if($gender==2){
          $this->form_validation->set_rules('minor_pregnant', '<b>Minor Pregnant</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('minor_pregnant', '<b>Minor Pregnant</b>', 'trim|numeric|max_length[2]');

          $this->form_validation->set_rules('kp_availed', '<b>Kanyashree Availed</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('kp_availed', '<b>Kanyashree Availed</b>', 'trim|numeric|max_length[2]');

          $minor_pregnant = $this->input->post('minor_pregnant');
          if($minor_pregnant==1){
            $this->form_validation->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|numeric|max_length[2]');
          }

          if($kp_availed_value==1){
            // $this->form_validation->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|required|numeric|max_length[20]');
           // $this->form_validation_draft->set_rules('kanyashree_id', '<b>Kanyashree Id</b>', 'trim|numeric|max_length[20]');
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
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
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
          // $home_enquiry_date =  isset($_POST['home_enquiry_date']) ? $this->us_date_format($_POST['home_enquiry_date']) : NULL; 
          $home_enquiry_date =  isset($_POST['home_enquiry_date']) ? $this->us_date_format_db($_POST['home_enquiry_date']) : NULL; 
          $hv_cp_age = isset($_POST['hv_cp_age']) ? $_POST['hv_cp_age'] : NULL; 

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
          $stage_of_pregnancy_cls = isset($_POST['stage_of_pregnancy']) ? $_POST['stage_of_pregnancy'] : NULL;
          $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : NULL;


          $kp_availed = isset($_POST['kp_availed']) ? $_POST['kp_availed'] : NULL;

           

          
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
          
          $homeVisitData['parents_supported'] =  $parents_supported;
          $homeVisitData['family_elders_supported'] =  $family_elders_supported;
          $homeVisitData['peers_supported'] =  $peers_supported;
          $homeVisitData['neighbours_supported'] =  $neighbours_supported;
          $homeVisitData['others_supported'] =  $others_supported;
          $homeVisitData['minor_pregnant'] =  $minor_pregnant;
          $homeVisitData['stage_of_pregnancy'] =  $stage_of_pregnancy_cls;
          $homeVisitData['home_enquiry_date'] =  ($home_enquiry_date)?$home_enquiry_date:NULL;
          $homeVisitData['age_of_home_enquiry'] = ($hv_cp_age)?$hv_cp_age:NULL;
          $homeVisitData['remarks'] =  $remarks;
                   
          $homeVisitData['hv_status'] =  $formCompleteStatus;

          if($education==1)
          {
          $homeVisitData['bs_school_id_fk'] =  ($bs_school_id)?$bs_school_id:NULL;
          $homeVisitData['school_name'] =  $school_name;
          $homeVisitData['school_district'] =  ($cp_school_district)?$cp_school_district:NULL;
          $homeVisitData['school_block'] =  ($cp_school_block)?$cp_school_block:NULL;
          }else
          {
            $homeVisitData['bs_school_id_fk'] = NULL;
            $homeVisitData['school_name'] = NULL;
            $homeVisitData['school_district'] = NULL;
            $homeVisitData['school_block'] = NULL;
          }

          if($gender == 2)
          {
            if($kp_availed==1){
              $homeVisitData['kp_availed'] =  ($kp_availed)?$kp_availed:NULL;
              $homeVisitData['kanyashree_id'] =  $kanyashree_id;
            }else{
              $homeVisitData['kp_availed'] =  ($kp_availed)?$kp_availed:NULL;
              $homeVisitData['kanyashree_id'] =  NULL;
            }
          }


          
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
          $siblings_status = '';
          $SiblingsData = array();
          $Siblings_Details = $this->input->post('Siblings_Details');

          $siblingSlNo = isset($_POST['siblingSlNo']) ? $_POST['siblingSlNo'] : array();

          if(empty($Siblings_Details)){
            $sibling_last_id = array();
          }else{
            $sibling_last_id = array_column($Siblings_Details, 'id');
          }
          $deleteSiblingSlNo = array_merge(array_diff($sibling_last_id, $siblingSlNo), array_diff($siblingSlNo, $sibling_last_id));

          if(!empty($deleteSiblingSlNo)){
            foreach($deleteSiblingSlNo as $value){
              $deleteSiblingSlNoData[] = array('sl_no'=>$value,'delete_status'=>1,'delete_by'=>$stake_holder_login_id_pk,'delete_time'=>'now()','delete_ip'=>$_SERVER['REMOTE_ADDR']);
            }
            $siblings_update_delete_status = $this->home_visit_minor_form_model->home_visit_siblings_details_update_batch($deleteSiblingSlNoData);
          }else{
            $siblings_update_delete_status = 1;
          }

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
          if($home_visit_minor_insert_status>0 && $siblings_status>0 && $siblings_update_delete_status>0){
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


      $homwvisit_delete_count = $this->home_visit_minor_form_model->home_visit_minor_delete_count_by_id($incident_id,$cp_id,$cp_type);
      if($homwvisit_delete_count==0){
        $homwvisit_siblings_dtls = array();
      }else{
        $homwvisit_siblings_dtls = $this->home_visit_minor_form_model->get_homwvisit_siblings_dtls_by_hvm_id(array('B.incident_id_fk'=>$incident_id,'B.cp_id_fk'=>$cp_id,'B.cp_type'=>$cp_type,'delete_status'=>0));
      }






      // $homwvisit_siblings_dtls = $this->home_visit_minor_form_model->get_homwvisit_siblings_dtls_by_hvm_id(array('incident_id_fk'=>$incident_id,'cp_id_fk'=>$cp_id,'cp_type'=>$cp_type,'delete_status'=>0));
    }else{
      $hvm_id_fk = base64_decode($id);
      $homwvisit_siblings_dtls = $this->home_visit_minor_form_model->get_homwvisit_siblings_dtls_by_hvm_id(array('hv_id_fk'=>$hvm_id_fk,'delete_status'=>0));
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

       $html.= '<td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][in_education]" value="1" '.(($value["in_education"]==1) ? "checked" : '').'>Yes</label><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][in_education]" value="2" '.(($value["in_education"]==2) ? "checked" : '').'>No</label></td>';

       $html.= '<td><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][in_paid_work]" value="1" '.(($value["in_paid_work"]==1) ? "checked" : '').'>Yes</label><label class="radio-inline"><input type="radio" name="Siblings_Details['.$key.'][in_paid_work]" value="2" '.(($value["in_paid_work"]==2) ? "checked" : '').'>No</label></td>';

       $html.= '<td><button type="button" id="siblings_Remove" class="btn btn-danger form-control siblings_Remove" data-id="'.$value['sibling_sl_no'].'" fdprocessedid="ebpxyn"><i class="fa fa-trash"></i></button> </td><input type="hidden" name="Siblings_Details['.$key.'][id]" value="'.$value['sibling_sl_no'].'"></tr>';
       $html.= '<input type="hidden" name="siblingSlNo[]" value="'.$value['sibling_sl_no'].'">';
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
  public function us_date_format_db($uk_date=NULL)
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
