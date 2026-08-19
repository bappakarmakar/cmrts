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
  
  public function index($incident_id=null, $cp_type=null, $cp_id=null) 
  {
    // echo "<pre>";print_r($_REQUEST);die;
    $this->validate_login(array('4'));
    $data=array();
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

    // echo $incident_id."<br>";

    $data['hv_status'] = 0;
    $data['sl_no']=$sl_no= 0 ;
    $data['add_edit_status']= 0 ;
    $data['homwvisit_dtls']=$this->home_visit_minor_form_model->get_homwvisit_dtls(
          array('cp_id_fk'=>$cp_id,'cp_type'=>$cp_type,'get'=>1,'incident_id_fk'=>$incident_id));
    
    if(count($data['homwvisit_dtls']))
    {
      $data['sl_no'] = $data['homwvisit_dtls']['sl_no'];
      $data['hv_status'] = $data['homwvisit_dtls']['hv_status'];
      if($data['homwvisit_dtls']['hv_status']==2)
      {
        $data['add_edit_status']= 1;
      }
    }
    $data['error']=array();

    $submit=$this->input->post('submit1');
    if($submit==1)
    {
      // echo "<pre>"; print_r($_POST);die;
      $add_edit_status=$this->input->post('add_edit_status');
      $submit_status=$this->input->post('submit_status');
      $this->load->library('form_validation');
      $total_mand_field=10;
      $final_array=array();
      if($this->input->post('mode_of_enquiry') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('mode_of_enquiry', 'mode of enquiry', 'required|is_not_unique[cm_mode_of_enquiry_master.sl_no]');
        $final_array['mode_of_enquiry']= $this->input->post('mode_of_enquiry');
      }    
      if($this->input->post('gender') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('gender', 'gender', 'required');
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
        if($this->input->post('disability')==1 || $add_edit_status==1 || $submit_status==1)
        {
          if($this->input->post('type_of_disability') || $add_edit_status==1 || $submit_status==1)
          {
            $this->form_validation->set_rules('type_of_disability', 'type_of_disability', 'required');
            $final_array['type_of_disability']= $this->input->post('type_of_disability');
          }      
          if($this->input->post('disability_certificate') || $add_edit_status==1 || $submit_status==1)
          {
            $this->form_validation->set_rules('disability_certificate', 'disability_certificate', 'required');
            $final_array['disability_certificate']= $this->input->post('disability_certificate');
            if($this->input->post('disability_certificate') ==1 || $add_edit_status==1 || $submit_status==1)
            {
              if($this->input->post('disability_percent') || $add_edit_status==1 || $submit_status==1)
              {
                $this->form_validation->set_rules('disability_percent', 'disability_percent', 'required');
                $final_array['disability_percent']= $this->input->post('disability_percent');
              }
            }
            elseif($this->input->post('disability_certificate') ==2 || $add_edit_status==1 || $submit_status==1)
            {
              if($this->input->post('estimated_severity') || $add_edit_status==1 || $submit_status==1)
              {
                $this->form_validation->set_rules('estimated_severity', 'estimated_severity', 'required');
                $final_array['estimated_severity']= $this->input->post('estimated_severity');
              }
            }
          }
        }
      }
      if($this->input->post('education'))
      {
        $this->form_validation->set_rules('education', 'education', 'required');
        $final_array['education']= $this->input->post('education');
        if($this->input->post('education') ==1)
        {
          $this->form_validation->set_rules('education_frequency', 'education_frequency', 'required');
          $final_array['education_frequency']= $this->input->post('education_frequency');
        }
      }      
      if($this->input->post('kishori_group'))
      {
        $this->form_validation->set_rules('kishori_group', 'kishori_group', 'required');
        $final_array['kishori_group']= $this->input->post('kishori_group');
        if($this->input->post('kishori_group') ==1)
        {
          $this->form_validation->set_rules('kishori_group_frequency', 'kishori_group_frequency', 'required');
          $final_array['kishori_group_frequency']= $this->input->post('kishori_group_frequency');
        }
      }
      if($this->input->post('paid_work'))
      {
        $this->form_validation->set_rules('paid_work', 'paid_work', 'required');
        $final_array['paid_work']= $this->input->post('paid_work');
        if($this->input->post('paid_work') ==1)
        {
          $this->form_validation->set_rules('paid_work_frequency', 'paid_work_frequency', 'required');
          $final_array['paid_work_frequency']= $this->input->post('paid_work_frequency');
        }
      }
      if($this->input->post('paid_work'))
      {
        $this->form_validation->set_rules('paid_work', 'paid_work', 'required');
        $final_array['paid_work']= $this->input->post('paid_work');
        if($this->input->post('paid_work') ==1)
        {
          $this->form_validation->set_rules('paid_work_frequency', 'paid_work_frequency', 'required');
          $final_array['paid_work_frequency']= $this->input->post('paid_work_frequency');
        }
      }

      if($this->input->post('paid_work'))
      {
        $this->form_validation->set_rules('paid_work', 'paid_work', 'required');
        $final_array['paid_work']= $this->input->post('paid_work');
        if($this->input->post('paid_work') ==1)
        {
          $this->form_validation->set_rules('paid_work_frequency', 'paid_work_frequency', 'required');
          $final_array['paid_work_frequency']= $this->input->post('paid_work_frequency');
        }
      }
      if($this->input->post('parents_supported'))
      {
        $this->form_validation->set_rules('parents_supported', 'parents_supported', 'required');
        $final_array['parents_supported']= $this->input->post('parents_supported');
      }
      if($this->input->post('family_elders_supported'))
      {
        $this->form_validation->set_rules('family_elders_supported', 'family_elders_supported', 'required');
        $final_array['family_elders_supported']= $this->input->post('family_elders_supported');
      }
      if($this->input->post('peers_supported'))
      {
        $this->form_validation->set_rules('peers_supported', 'peers_supported', 'required');
        $final_array['peers_supported']= $this->input->post('peers_supported');
      }
      if($this->input->post('neighbours_supported'))
      {
        $this->form_validation->set_rules('neighbours_supported', 'neighbours_supported', 'required');
        $final_array['neighbours_supported']= $this->input->post('neighbours_supported');
      }
      if($this->input->post('others_supported'))
      {
        $this->form_validation->set_rules('others_supported', 'others_supported', 'required');
        $final_array['others_supported']= $this->input->post('others_supported');
      }
      if($this->input->post('minor_pregnant'))
      {
        $this->form_validation->set_rules('minor_pregnant', 'minor_pregnant', 'required');
        $final_array['minor_pregnant']= $this->input->post('minor_pregnant');
      }
      if($this->input->post('minor_pregnant'))
      {
        $this->form_validation->set_rules('minor_pregnant', 'minor_pregnant', 'required');
        $final_array['minor_pregnant']= $this->input->post('minor_pregnant');
        if($this->input->post('minor_pregnant') ==1)
        {
          $this->form_validation->set_rules('stage_of_pregnancy', 'stage_of_pregnancy', 'required');
          $final_array['stage_of_pregnancy']= $this->input->post('stage_of_pregnancy');
        }
      }

      if ($this->form_validation->run() == TRUE)
      {
        // echo"<pre>";print_r($data);die;
      }
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
