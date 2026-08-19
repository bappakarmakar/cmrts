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

    // echo "<pre>";print_r($data);die;
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

  

    $data['selected_fields'] = "A.sl_no,
                                A.incident_id_fk,
                                A.cp_id_fk,
                                A.cp_type,
                                A.hv_status,
                                A.mode_of_enquiry,
                                A.gender,
                                A.family_income,
                                A.nutritious_meals,
                                A.neighbours_community,
                                A.emergencies,
                                A.education,
                                A.education_frequency,
                                A.paid_work,
                                A.paid_work_frequency,
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
      if($data['homwvisit_dtls']['hv_status']==2)
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
        $data['homwvisit_siblings_dtls'][$key]['siblings_occupation_array']=(isset($value['siblings_occupation']))?(explode(',', $value['siblings_occupation'])):NULL;
      }     
    }


    $data['highest_education_details'] = $this->Master_model->get_highest_education_details();
    $data['error']=array();

    $submit=$this->input->post('submit1');
    if($submit==1)
    {
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

      if($this->input->post('education') || $add_edit_status==1 || $submit_status==1)
      {
        if($this->input->post('education') == 1)
        {
          $this->form_validation->set_rules('education', 'education', 'required');
          $final_array['education']= $this->input->post('education');
          if($this->input->post('education_frequency') || $add_edit_status==1 || $submit_status==1)
          {
            $this->form_validation->set_rules('education_frequency', 'education_frequency', 'required');
            $final_array['education_frequency']= $this->input->post('education_frequency');
          }
        }
        else
        {
          $this->form_validation->set_rules('education', 'education', 'required');
          $final_array['education']= $this->input->post('education');

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



      if ($this->form_validation->run() == TRUE && $custom_validate == 0) 
      {
        // echo "<pre>";print_r($siblingsdata);die;
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
          if(!empty($siblingsdata))
          {
            $result_sibling = $this->home_visit_minor_form_model->insert_home_visit_sibling_dtls($siblingsdata);
          }

        }
        else
        {
          $result_sibling = $this->home_visit_minor_form_model->update_home_visit_sibling_dtls($siblingsdata,$siblingsdata_where);
        }
        redirect('admin/reporting/home_visit/home_visits_list');
      }
    }
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
