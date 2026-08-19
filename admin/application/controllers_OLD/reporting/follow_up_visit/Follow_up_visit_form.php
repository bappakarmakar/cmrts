<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Follow_up_visit_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('upload');
    $this->load->model('follow_up_visit/follow_up_visit_form_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
    );

    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
      // 2 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
    );
  }

  public function index($incident_id, $cp_type, $cp_id) 
  {
    //$this->validate_login(array('4'));fresh_follow_up_visit_count_by_id
    $incident_id = base64_decode($incident_id);
    $cp_type = base64_decode($cp_type);
    $cp_id = base64_decode($cp_id);
    $follow_up_visit_check_status = $this->follow_up_visit_form_model->fresh_follow_up_visit_count_by_id($incident_id,$cp_id,$cp_type);
    // echo $this->db->last_query();die;
    if(!empty($follow_up_visit_check_status)){
      $sl_no = $follow_up_visit_check_status['sl_no'];
      //echo '<pre>'; print_r($follow_up_visit_check_status);
      redirect('admin/reporting/follow_up_visit/Follow_up_visit_form/edit/'.base64_encode($sl_no), 'location');
    }

    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['gender_details'] = $this->Master_model->get_gender_details();
    $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
    $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
    $data['incident_cp_details'] = $this->follow_up_visit_form_model->get_incident_cp_details($cp_id);
    // $data['incident_cp_details'] = $this->follow_up_visit_form_model->get_incident_cp_details($cp_id);
      // $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
    $data['incident_cp_details']->ward_gp_name = '';
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
    $this->load->view($this->config->item('theme').'reporting/follow_up_visit/follow_up_visit_form_view', $data);
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

        $this->form_validation->set_rules('followup_date', '<b>Followup Date</b>', 'trim|required');
        $this->form_validation_draft->set_rules('followup_date', '<b>Followup Date</b>', 'trim');

        $this->form_validation->set_rules('age_on_folllowup', '<b>Followup Age</b>', 'trim|required');
        $this->form_validation_draft->set_rules('age_on_folllowup', '<b>Followup Age</b>', 'trim');

        $this->form_validation->set_rules('mode_of_enquiry', '<b>Mode Of Enquiry</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('mode_of_enquiry', '<b>Mode Of Enquiry</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('gender', '<b>Gender</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('gender', '<b>Gender</b>', 'trim|numeric|max_length[2]');


        $this->form_validation->set_rules('education', '<b>Education</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('education', '<b>Education</b>', 'trim|numeric|max_length[2]');
        $education = $this->input->post('education');
        if($education==1){
          $this->form_validation->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|numeric|max_length[2]');
        }
        $this->form_validation->set_rules('kishori_group', '<b>Kishori Group</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('kishori_group', '<b>Kishori Group</b>', 'trim|numeric|max_length[2]');
        $kishori_group = $this->input->post('kishori_group');
        if($kishori_group==1){
          $this->form_validation->set_rules('kishori_group_frequency', '<b>Kishori Group Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('kishori_group_frequency', '<b>Kishori Group Frequency</b>', 'trim|numeric|max_length[2]');
        }

        $this->form_validation->set_rules('paid_work', '<b>Paid work</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('paid_work', '<b>Paid work</b>', 'trim|numeric|max_length[2]');

        $paid_work = $this->input->post('paid_work');
        if($paid_work==1){
          $this->form_validation->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|numeric|max_length[2]');
        }

        $this->form_validation->set_rules('parents_supported', '<b>Parents</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('parents_supported', '<b>Parents</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('family_elders_supported', '<b>Family elders</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('family_elders_supported', '<b>Family elders</b>', 'trim|numeric|max_length[2]');

        
        $this->form_validation->set_rules('peers_supported', '<b>Peers</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('peers_supported', '<b>Peers</b>', 'trim|numeric|max_length[2]');
        

        $this->form_validation->set_rules('neighbours_supported', '<b>Neighbours</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('neighbours_supported', '<b>Neighbours</b>', 'trim|numeric|max_length[2]');

        

        $this->form_validation->set_rules('others_supported', '<b>Others</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('others_supported', '<b>Others</b>', 'trim|numeric|max_length[2]');
        


        $gender_value = $this->input->post('gender');
        if($gender_value==2){
          $this->form_validation->set_rules('minor_pregnant', '<b>Minor is pregnant</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('minor_pregnant', '<b>Minor is pregnant</b>', 'trim|numeric|max_length[2]');
          $minor_pregnant = $this->input->post('minor_pregnant');
          if($minor_pregnant==1){
            $this->form_validation->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|numeric|max_length[2]');
          }

        }
        

        $this->form_validation->set_rules('remarks', '<b>Remarks</b>', 'trim');
        $this->form_validation_draft->set_rules('remarks', '<b>Remarks</b>', 'trim');
        
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

          $follow_up_visit_check_status = $this->follow_up_visit_form_model->fresh_follow_up_visit_count_by_id($incident_id,$cp_id,$cp_type);

          $followup_date =  isset($_POST['followup_date']) ? $this->us_date_format_db($_POST['followup_date']) : NULL; 
          $age_on_folllowup =  isset($_POST['age_on_folllowup']) ?$_POST['age_on_folllowup'] : NULL; 

          $mode_of_enquiry = isset($_POST['mode_of_enquiry']) ? $_POST['mode_of_enquiry'] : NULL;
          $gender = isset($_POST['gender']) ? $_POST['gender'] : NULL;
          $education = isset($_POST['education']) ? $_POST['education'] : NULL;
          $education_frequency = isset($_POST['education_frequency']) ? $_POST['education_frequency'] : NULL;
          $kishori_group = isset($_POST['kishori_group']) ? $_POST['kishori_group'] : NULL;
          $kishori_group_frequency = isset($_POST['kishori_group_frequency']) ? $_POST['kishori_group_frequency'] : NULL;

         
          $paid_work = isset($_POST['paid_work']) ? $_POST['paid_work'] : NULL;
          $paid_work_frequency = isset($_POST['paid_work_frequency']) ? $_POST['paid_work_frequency'] : NULL;
          $parents_supported = isset($_POST['parents_supported']) ? $_POST['parents_supported'] : NULL;
          $family_elders_supported = isset($_POST['family_elders_supported']) ? $_POST['family_elders_supported'] : NULL;
          $peers_supported = isset($_POST['peers_supported']) ? $_POST['peers_supported'] : NULL;
          $neighbours_supported = isset($_POST['neighbours_supported']) ? $_POST['neighbours_supported'] : NULL;
          $others_supported = isset($_POST['others_supported']) ? $_POST['others_supported'] : NULL;
          $minor_pregnant = isset($_POST['minor_pregnant']) ? $_POST['minor_pregnant'] : NULL;
          $stage_of_pregnancy = isset($_POST['stage_of_pregnancy']) ? $_POST['stage_of_pregnancy'] : NULL;
          $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : NULL;


          $followUpVisitData['incident_id_fk'] =  $incident_id;
          $followUpVisitData['cp_id_fk'] =  $cp_id;
          $followUpVisitData['cp_type'] =  $cp_type;
          $followUpVisitData['mode_of_enquiry'] =  $mode_of_enquiry;

          $followUpVisitData['followup_date'] =  ($followup_date)?$followup_date:NULL;
            $followUpVisitData['age_on_folllowup'] =  ($age_on_folllowup)?$age_on_folllowup:NULL;

          $followUpVisitData['gender'] =  $gender;
          $followUpVisitData['education'] =  $education;
          $followUpVisitData['education_frequency'] =  $education_frequency;
          $followUpVisitData['kishori_group'] =  $kishori_group;
          $followUpVisitData['kishori_group_frequency'] =  $kishori_group_frequency;
          $followUpVisitData['paid_work'] =  $paid_work;
          $followUpVisitData['paid_work_frequency'] =  $paid_work_frequency;
          $followUpVisitData['parents_supported'] =  $parents_supported;
          $followUpVisitData['family_elders_supported'] =  $family_elders_supported;
          $followUpVisitData['peers_supported'] =  $peers_supported;
          $followUpVisitData['neighbours_supported'] =  $neighbours_supported;
          $followUpVisitData['others_supported'] =  $others_supported;
          $followUpVisitData['minor_pregnant'] =  $minor_pregnant;
          $followUpVisitData['stage_of_pregnancy'] =  $stage_of_pregnancy;
          $followUpVisitData['remarks'] =  $remarks;
          
          
          $followUpVisitData['fv_status'] =  $formCompleteStatus;
                   
          
          $default = $this->load->database('default',TRUE);
          $default->trans_start();

          if(count($follow_up_visit_check_status)>0){

            $follow_up_sl_no = $follow_up_visit_check_status['sl_no'];
            $followUpVisitData['update_by'] =  $stake_holder_login_id_pk;
            $followUpVisitData['update_time'] =  'now()';
            $followUpVisitData['update_ip'] =  $_SERVER['REMOTE_ADDR'];

            $followUpVisitInsertstatus = $this->follow_up_visit_form_model->follow_up_visit_update_by_sl_no($followUpVisitData,$follow_up_sl_no);
          }else{
            $followUpVisitData['entry_by'] =  $stake_holder_login_id_pk;
            $followUpVisitData['entry_time'] =  'now()';
            $followUpVisitData['entry_ip'] =  $_SERVER['REMOTE_ADDR'];
            $followUpVisitInsertstatus = $this->follow_up_visit_form_model->follow_up_visit_details_insert($followUpVisitData);
          }

          if($followUpVisitInsertstatus>0){
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
  public function edit($follow_up_id=null){
    $follow_up_id = base64_decode($follow_up_id);
    if(empty($follow_up_id)){
      redirect('admin/reporting/follow_up_visit/follow_up_visits_list/', 'location');
    }else{
      $data['follow_up_details']=$follow_up_details = $this->follow_up_visit_form_model->get_follow_up_visit_edit_details($follow_up_id);
      $incident_id = ($follow_up_details)?$follow_up_details->incident_id_fk:'';
      $cp_type = ($follow_up_details)?$follow_up_details->cp_type:'';
      $cp_id = ($follow_up_details)?$follow_up_details->cp_id_fk:'';
      $login_id = $this->session->userdata('login_id');
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);
      $data['gender_details'] = $this->Master_model->get_gender_details();
      $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
      $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
      $data['incident_cp_details'] = $this->follow_up_visit_form_model->get_incident_cp_details($cp_id);
      $data['incident_cp_details']->ward_gp_name = '';

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

      $this->load->view($this->config->item('theme').'reporting/follow_up_visit/follow_up_visit_edit_form_view', $data);
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

        $this->form_validation->set_rules('followup_date', '<b>Followup Date</b>', 'trim|required');
        $this->form_validation_draft->set_rules('followup_date', '<b>Followup Date</b>', 'trim');

        $this->form_validation->set_rules('age_on_folllowup', '<b>Followup Age</b>', 'trim|required');
        $this->form_validation_draft->set_rules('age_on_folllowup', '<b>Followup Age</b>', 'trim');

        $this->form_validation->set_rules('mode_of_enquiry', '<b>Mode Of Enquiry</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('mode_of_enquiry', '<b>Mode Of Enquiry</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('gender', '<b>Gender</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('gender', '<b>Gender</b>', 'trim|numeric|max_length[2]');


        $this->form_validation->set_rules('education', '<b>Education</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('education', '<b>Education</b>', 'trim|numeric|max_length[2]');
        $education = $this->input->post('education');
        if($education==1){
          $this->form_validation->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('education_frequency', '<b>Education Frequency</b>', 'trim|numeric|max_length[2]');
        }
        $this->form_validation->set_rules('kishori_group', '<b>Kishori Group</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('kishori_group', '<b>Kishori Group</b>', 'trim|numeric|max_length[2]');
        $kishori_group = $this->input->post('kishori_group');
        if($kishori_group==1){
          $this->form_validation->set_rules('kishori_group_frequency', '<b>Kishori Group Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('kishori_group_frequency', '<b>Kishori Group Frequency</b>', 'trim|numeric|max_length[2]');
        }

        $this->form_validation->set_rules('paid_work', '<b>Paid work</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('paid_work', '<b>Paid work</b>', 'trim|numeric|max_length[2]');

        $paid_work = $this->input->post('paid_work');
        if($paid_work==1){
          $this->form_validation->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('paid_work_frequency', '<b>Paid Work Frequency</b>', 'trim|numeric|max_length[2]');
        }

        $this->form_validation->set_rules('parents_supported', '<b>Parents</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('parents_supported', '<b>Parents</b>', 'trim|numeric|max_length[2]');

        $this->form_validation->set_rules('family_elders_supported', '<b>Family elders</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('family_elders_supported', '<b>Family elders</b>', 'trim|numeric|max_length[2]');

        
        $this->form_validation->set_rules('peers_supported', '<b>Peers</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('peers_supported', '<b>Peers</b>', 'trim|numeric|max_length[2]');
        

        $this->form_validation->set_rules('neighbours_supported', '<b>Neighbours</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('neighbours_supported', '<b>Neighbours</b>', 'trim|numeric|max_length[2]');

        

        $this->form_validation->set_rules('others_supported', '<b>Others</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('others_supported', '<b>Others</b>', 'trim|numeric|max_length[2]');
        



        $gender_value = $this->input->post('gender');
        if($gender_value==2){
          $this->form_validation->set_rules('minor_pregnant', '<b>Minor is pregnant</b>', 'trim|required|numeric|max_length[2]');
          $this->form_validation_draft->set_rules('minor_pregnant', '<b>Minor is pregnant</b>', 'trim|numeric|max_length[2]');
          $minor_pregnant = $this->input->post('minor_pregnant');
          if($minor_pregnant==1){
            $this->form_validation->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|required|numeric|max_length[2]');
            $this->form_validation_draft->set_rules('stage_of_pregnancy', '<b>Stage Of Pregnancy</b>', 'trim|numeric|max_length[2]');
          }

        }

        $this->form_validation->set_rules('remarks', '<b>Remarks</b>', 'trim');
        $this->form_validation_draft->set_rules('remarks', '<b>Remarks</b>', 'trim');
        
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
          $follow_up_sl_no = $this->input->post('follow_up_sl_no');
          $follow_up_sl_no = base64_decode($follow_up_sl_no);
          $follow_up_details = $this->follow_up_visit_form_model->get_follow_up_visit_edit_details($follow_up_sl_no);
          if(empty($follow_up_details)){
            $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
          }else{

            $action = isset($_POST['action']) ? $_POST['action'] : NULL;
          if($action=='swalSubmit'){

            $followup_date =  isset($_POST['followup_date']) ? $this->us_date_format_db($_POST['followup_date']) : NULL; 
            $age_on_folllowup =  isset($_POST['age_on_folllowup']) ?$_POST['age_on_folllowup'] : NULL; 



            // echo $age_on_folllowup;die;

            $mode_of_enquiry = isset($_POST['mode_of_enquiry']) ? $_POST['mode_of_enquiry'] : NULL;
            $gender = isset($_POST['gender']) ? $_POST['gender'] : NULL;
            $education = isset($_POST['education']) ? $_POST['education'] : NULL;
            $education_frequency = isset($_POST['education_frequency']) ? $_POST['education_frequency'] : NULL;
            $kishori_group = isset($_POST['kishori_group']) ? $_POST['kishori_group'] : NULL;
            $kishori_group_frequency = isset($_POST['kishori_group_frequency']) ? $_POST['kishori_group_frequency'] : NULL;

         
            $paid_work = isset($_POST['paid_work']) ? $_POST['paid_work'] : NULL;
            $paid_work_frequency = isset($_POST['paid_work_frequency']) ? $_POST['paid_work_frequency'] : NULL;
            $parents_supported = isset($_POST['parents_supported']) ? $_POST['parents_supported'] : NULL;
            $family_elders_supported = isset($_POST['family_elders_supported']) ? $_POST['family_elders_supported'] : NULL;
            $peers_supported = isset($_POST['peers_supported']) ? $_POST['peers_supported'] : NULL;
            $neighbours_supported = isset($_POST['neighbours_supported']) ? $_POST['neighbours_supported'] : NULL;
            $others_supported = isset($_POST['others_supported']) ? $_POST['others_supported'] : NULL;
            $minor_pregnant = isset($_POST['minor_pregnant']) ? $_POST['minor_pregnant'] : NULL;
            $stage_of_pregnancy = isset($_POST['stage_of_pregnancy']) ? $_POST['stage_of_pregnancy'] : NULL;
            $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : NULL;
            $followUpVisitData['mode_of_enquiry'] =  $mode_of_enquiry;

            $followUpVisitData['followup_date'] =  ($followup_date)?$followup_date:NULL;
            $followUpVisitData['age_on_folllowup'] =  ($age_on_folllowup)?$age_on_folllowup:NULL;
            $followUpVisitData['gender'] =  $gender;
            $followUpVisitData['education'] =  $education;
            $followUpVisitData['education_frequency'] =  $education_frequency;
            $followUpVisitData['kishori_group'] =  $kishori_group;
            $followUpVisitData['kishori_group_frequency'] =  $kishori_group_frequency;
            $followUpVisitData['paid_work'] =  $paid_work;
            $followUpVisitData['paid_work_frequency'] =  $paid_work_frequency;
            $followUpVisitData['parents_supported'] =  $parents_supported;
            $followUpVisitData['family_elders_supported'] =  $family_elders_supported;
            $followUpVisitData['peers_supported'] =  $peers_supported;
            $followUpVisitData['neighbours_supported'] =  $neighbours_supported;
            $followUpVisitData['others_supported'] =  $others_supported;
            $followUpVisitData['minor_pregnant'] =  $minor_pregnant;
            $followUpVisitData['stage_of_pregnancy'] =  $stage_of_pregnancy;
            $followUpVisitData['remarks'] =  $remarks;
            $followUpVisitData['fv_status'] =  $formCompleteStatus;
            $followUpVisitData['update_by'] =  $stake_holder_login_id_pk;
            $followUpVisitData['update_time'] =  'now()';
            $followUpVisitData['update_ip'] =  $_SERVER['REMOTE_ADDR'];
            $default = $this->load->database('default',TRUE);
            $default->trans_start();
            $followUpVisitInsertstatus = $this->follow_up_visit_form_model->follow_up_visit_update_by_sl_no($followUpVisitData,$follow_up_sl_no);
            if($followUpVisitInsertstatus>0){
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
}
