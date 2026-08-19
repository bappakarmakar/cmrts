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
  }
  
  public function index($incident_id, $cp_type, $cp_id) 
  {
    echo $incident_id."<br>";
    // echo "<pre>";print_r($_REQUEST);die;
    $this->validate_login(array('4'));
    $incident_id = base64_decode($incident_id);
    $cp_type = base64_decode($cp_type);
    $cp_id = base64_decode($cp_id);
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    $config_two = array();
    $config_three = array();
    $config_four = array();
    $config_five = array();
    $config_six = array();
    $config_seven = array();
    $config_eight = array();
    // $config_one = array(
    //   array(
    //     'field' => 'mode_of_enquiry',
    //     'label' => 'Mode of Enquiry',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'gender',
    //     'label' => 'Gender',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'family_income',
    //     'label' => 'Total Family Income',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'nutritious_meals',
    //     'label' => 'Nutritious meals a day',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'neighbours_community',
    //     'label' => 'Neighbours and Community',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'emergencies',
    //     'label' => 'Emergencies',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'disability',
    //     'label' => 'Has a disability',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'education',
    //     'label' => 'education',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'kishori_group',
    //     'label' => 'kishori group',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'paid_work',
    //     'label' => 'paid work',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'kanyashree_id',
    //     'label' => 'Kanyashree ID',
    //     'rules' => 'trim|numeric'
    //   ),
    //   array(
    //     'field' => 'parents_supported',
    //     'label' => 'parents',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'family_elders_supported',
    //     'label' => 'family elders',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'peers_supported',
    //     'label' => 'peers',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'neighbours_supported',
    //     'label' => 'neighbours',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'others_supported',
    //     'label' => 'others',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'minor_pregnant',
    //     'label' => 'minor pregnant',
    //     'rules' => 'trim|required|numeric'
    //   ),
    //   array(
    //     'field' => 'remarks',
    //     'label' => 'Remarks',
    //     'rules' => 'trim|is_script_validate'
    //   ),
    // );

    // if($this->input->post('disability') == 1){
    //   $config_two = array(
    //     array(
    //       'field' => 'type_of_disability[]',
    //       'label' => 'type of disability',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //     array(
    //       'field' => 'disability_certificate',
    //       'label' => 'Has a disability certificate',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //   );
    // }

    // if($this->input->post('disability_certificate') == 1){
    //   $config_three = array(
    //     array(
    //       'field' => 'disability_percent',
    //       'label' => 'disability percent',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //   );
    // }elseif($this->input->post('disability_certificate') == 2){
    //   $config_four = array(
    //     array(
    //       'field' => 'estimated_severity',
    //       'label' => 'estimated severity',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //   );
    // }

    // if($this->input->post('education') == 1){
    //   $config_five = array(
    //     array(
    //       'field' => 'education_frequency',
    //       'label' => 'education frequency',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //   );
    // }

    // if($this->input->post('kishori_group') == 1){
    //   $config_six = array(
    //     array(
    //       'field' => 'kishori_group_frequency',
    //       'label' => 'kishori group frequency',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //   );
    // }

    // if($this->input->post('paid_work') == 1){
    //   $config_seven = array(
    //     array(
    //       'field' => 'paid_work_frequency',
    //       'label' => 'paid work frequency',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //   );
    // }

    // if($this->input->post('minor_pregnant') == 1){
    //   $config_eight = array(
    //     array(
    //       'field' => 'stage_of_pregnancy',
    //       'label' => 'stage of pregnancy',
    //       'rules' => 'trim|required|numeric'
    //     ),
    //   );
    // }
    // $config = array_merge($config_one, $config_two, $config_three, $config_four, $config_five, $config_six, $config_seven, $config_eight);
    // $this->form_validation->set_rules($config);
    if(strtoupper($this->input->server("REQUEST_METHOD") == strtoupper('POST')))
    {

      // Home Visit Minor Details

      if($this->input->post('mode_of_enquiry'))
      {
        $this->form_validation->set_rules('mode_of_enquiry', 'mode of enquiry', 'required');
        $data['mode_of_enquiry']= $this->input->post('mode_of_enquiry');
      }    
      if($this->input->post('gender'))
      {
        $this->form_validation->set_rules('gender', 'gender', 'required');
        $data['gender']= $this->input->post('gender');
      }    
      if($this->input->post('family_income'))
      {
        $this->form_validation->set_rules('family_income', 'family income', 'required');
        $data['family_income']= $this->input->post('family_income');
      }    
      if($this->input->post('nutritious_meals'))
      {
        $this->form_validation->set_rules('nutritious_meals', 'nutritious meals', 'required');
        $data['nutritious_meals']= $this->input->post('nutritious_meals');
      }    
      if($this->input->post('neighbours_community'))
      {
        $this->form_validation->set_rules('neighbours_community', 'neighbours community', 'required');
        $data['neighbours_community']= $this->input->post('neighbours_community');
      }    
      if($this->input->post('emergencies'))
      {
        $this->form_validation->set_rules('emergencies', 'emergencies', 'required');
        $data['emergencies']= $this->input->post('emergencies');
      }

      if($this->input->post('disability'))
      {
        $this->form_validation->set_rules('disability', 'disability', 'required');
        $data['disability']= $this->input->post('disability');
        if($this->input->post('disability')==1)
        {
          if($this->input->post('type_of_disability'))
          {
            $this->form_validation->set_rules('type_of_disability', 'type_of_disability', 'required');
            $data['type_of_disability']= $this->input->post('type_of_disability');
          }      
          if($this->input->post('disability_certificate'))
          {
            $this->form_validation->set_rules('disability_certificate', 'disability_certificate', 'required');
            $data['disability_certificate']= $this->input->post('disability_certificate');
            if($this->input->post('disability_certificate') ==1)
            {
              if($this->input->post('disability_percent'))
              {
                $this->form_validation->set_rules('disability_percent', 'disability_percent', 'required');
                $data['disability_percent']= $this->input->post('disability_percent');
              }
            }
            elseif($this->input->post('disability_certificate') ==2)
            {
              if($this->input->post('estimated_severity'))
              {
                $this->form_validation->set_rules('estimated_severity', 'estimated_severity', 'required');
                $data['estimated_severity']= $this->input->post('estimated_severity');
              }
            }
          }
        }
      }
      if($this->input->post('education'))
      {
        $this->form_validation->set_rules('education', 'education', 'required');
        $data['education']= $this->input->post('education');
        if($this->input->post('education') ==1)
        {
          $this->form_validation->set_rules('education_frequency', 'education_frequency', 'required');
          $data['education_frequency']= $this->input->post('education_frequency');
        }
      }      
      if($this->input->post('kishori_group'))
      {
        $this->form_validation->set_rules('kishori_group', 'kishori_group', 'required');
        $data['kishori_group']= $this->input->post('kishori_group');
        if($this->input->post('kishori_group') ==1)
        {
          $this->form_validation->set_rules('kishori_group_frequency', 'kishori_group_frequency', 'required');
          $data['kishori_group_frequency']= $this->input->post('kishori_group_frequency');
        }
      }
      if($this->input->post('paid_work'))
      {
        $this->form_validation->set_rules('paid_work', 'paid_work', 'required');
        $data['paid_work']= $this->input->post('paid_work');
        if($this->input->post('paid_work') ==1)
        {
          $this->form_validation->set_rules('paid_work_frequency', 'paid_work_frequency', 'required');
          $data['paid_work_frequency']= $this->input->post('paid_work_frequency');
        }
      }
      if($this->input->post('paid_work'))
      {
        $this->form_validation->set_rules('paid_work', 'paid_work', 'required');
        $data['paid_work']= $this->input->post('paid_work');
        if($this->input->post('paid_work') ==1)
        {
          $this->form_validation->set_rules('paid_work_frequency', 'paid_work_frequency', 'required');
          $data['paid_work_frequency']= $this->input->post('paid_work_frequency');
        }
      }

      if($this->input->post('paid_work'))
      {
        $this->form_validation->set_rules('paid_work', 'paid_work', 'required');
        $data['paid_work']= $this->input->post('paid_work');
        if($this->input->post('paid_work') ==1)
        {
          $this->form_validation->set_rules('paid_work_frequency', 'paid_work_frequency', 'required');
          $data['paid_work_frequency']= $this->input->post('paid_work_frequency');
        }
      }
      if($this->input->post('parents_supported'))
      {
        $this->form_validation->set_rules('parents_supported', 'parents_supported', 'required');
        $data['parents_supported']= $this->input->post('parents_supported');
      }
      if($this->input->post('family_elders_supported'))
      {
        $this->form_validation->set_rules('family_elders_supported', 'family_elders_supported', 'required');
        $data['family_elders_supported']= $this->input->post('family_elders_supported');
      }
      if($this->input->post('peers_supported'))
      {
        $this->form_validation->set_rules('peers_supported', 'peers_supported', 'required');
        $data['peers_supported']= $this->input->post('peers_supported');
      }
      if($this->input->post('neighbours_supported'))
      {
        $this->form_validation->set_rules('neighbours_supported', 'neighbours_supported', 'required');
        $data['neighbours_supported']= $this->input->post('neighbours_supported');
      }
      if($this->input->post('others_supported'))
      {
        $this->form_validation->set_rules('others_supported', 'others_supported', 'required');
        $data['others_supported']= $this->input->post('others_supported');
      }
      if($this->input->post('minor_pregnant'))
      {
        $this->form_validation->set_rules('minor_pregnant', 'minor_pregnant', 'required');
        $data['minor_pregnant']= $this->input->post('minor_pregnant');
      }
      if($this->input->post('minor_pregnant'))
      {
        $this->form_validation->set_rules('minor_pregnant', 'minor_pregnant', 'required');
        $data['minor_pregnant']= $this->input->post('minor_pregnant');
        if($this->input->post('minor_pregnant') ==1)
        {
          $this->form_validation->set_rules('stage_of_pregnancy', 'stage_of_pregnancy', 'required');
          $data['stage_of_pregnancy']= $this->input->post('stage_of_pregnancy');
        }
      }

      if ($this->form_validation->run() == FALSE)
      {
          // $this->load->view('myform');
         $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_minor_form_view', $data);
      }
      // else
      // {
      //     $this->load->view('formsuccess');
      // }







        // $upload_home_visit_minor_details = array(
        //     // 'incident_id_fk' => $incident_id,
        //     // 'cp_id_fk' => $cp_id,
        //     // 'cp_type' => $cp_type,
        //     'mode_of_enquiry' => $this->input->post('mode_of_enquiry'),
        //     'gender' => $this->input->post('gender'),
        //     'family_income' => $this->input->post('family_income'),
        //     'nutritious_meals' => $this->input->post('nutritious_meals'),
        //     'neighbours_community' => $this->input->post('neighbours_community'),
        //     'emergencies' => $this->input->post('emergencies'),
        //     'disability' => $this->input->post('disability'),
        //     'type_of_disability' => implode(",",(array) $this->input->post('type_of_disability')) ,
        //     'disability_certificate' => $this->input->post('disability_certificate'),
        //     'disability_percent' => $this->input->post('disability_percent'),
        //     'estimated_severity' => $this->input->post('estimated_severity'),
        //     'education' => $this->input->post('education'),
        //     'education_frequency' => $this->input->post('education_frequency'),
        //     'kishori_group' => $this->input->post('kishori_group'),
        //     'kishori_group_frequency' => $this->input->post('kishori_group_frequency'),
        //     'paid_work' => $this->input->post('paid_work'),
        //     'paid_work_frequency' => $this->input->post('paid_work_frequency'),
        //     'kanyashree_id' => $this->input->post('kanyashree_id'),
        //     'parents_supported' => $this->input->post('parents_supported'),
        //     'family_elders_supported' => $this->input->post('family_elders_supported'),
        //     'peers_supported' => $this->input->post('peers_supported'),
        //     'neighbours_supported' => $this->input->post('neighbours_supported'),
        //     'others_supported' => $this->input->post('others_supported'),
        //     'minor_pregnant' => $this->input->post('minor_pregnant'),
        //     'stage_of_pregnancy' => $this->input->post('stage_of_pregnancy'),
        //     'remarks' => $this->input->post('remarks'),
        //     'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
        //     'entry_time' => date('Y-m-d H:i:s'),
        //     'entry_ip' => $_SERVER['REMOTE_ADDR']
        // );

      // echo "<pre>";print_r($_POST);die;
      // echo "<pre>";print_r($data);die;

      //  $validatedData = array();

      //   // // Get all form fields and check if they passed validation
      //   // foreach ($upload_home_visit_minor_details as $field => $value) {
      //   //   // echo "<pre>";print_r($field)."<br>"; die;
      //   //     if ($this->form_validation->run($config) == TRUE) {
      //   //         // Field passed validation, add it to the array
      //   //         $validatedData[$field] = $value;
      //   //     }
      //   // }


      //           // Loop through each field and set validation rules
      //   foreach ($upload_home_visit_minor_details as $field_name => $field_label) {
      //     // echo $field_name."---------".$field_label."<br>";


      //       $this->form_validation->set_rules($field_name, $field_name, 'required');
      //       if ($this->form_validation->run($field_name) == false) {
      //           // Validation failed for the current field
      //           echo 'Validation failed for ' . $field_name . ': ' . validation_errors();
      //       } else {
      //           // Validation passed for the current field
      //           echo 'Validation passed for ' . $field_name . '!';
      //       }

      //   }

        // // Run form validation for each field
        // foreach ($upload_home_visit_minor_details as $field_name => $field_label) {
        //     if ($this->form_validation->run($field_name) == false) {
        //         // Validation failed for the current field
        //         echo 'Validation failed for ' . $field_label . ': ' . validation_errors();
        //     } else {
        //         // Validation passed for the current field
        //         echo 'Validation passed for ' . $field_label . '!';
        //     }
        // }


        // echo"<pre>";print_r($validatedData);die;

    //   if($this->form_validation->run() == TRUE) 
    //   {
    //     $this->db->trans_begin();
    //     $result = $this->home_visit_minor_form_model->insert_home_visit_minor_details($incident_id, $cp_type, $cp_id);
    //     if($result == 0)
    //     {
    //        $this->db->trans_commit();
    //        $this->session->set_flashdata('success', 'Home visit to minor data successful added.');
    //        redirect('admin/reporting/incident/incident_list');
    //     }else
    //     {
    //        $this->db->trans_rollback();
    //        $this->session->set_flashdata('warning', 'Home visit to minor data addition failed. Please try again.');
    //        redirect('admin/reporting/incident/incident_list');
    //     }
    //   }
    //   else
    //   {
    //     $this->session->set_flashdata('error', 'Something went wrong. please check errors');
    //   }
    }
    
    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['gender_details'] = $this->Master_model->get_gender_details();
    $data['mode_of_enquiry_details'] = $this->Master_model->get_mode_of_enquiry_details();
    $data['disability_details'] = $this->Master_model->get_disability_details();
    $data['estimated_severity_details'] = $this->Master_model->get_estimated_severity_details();
    $data['pregnancy_details'] = $this->Master_model->get_pregnancy_details();
    $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);
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
}
