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

    $data['incident_cp_details'] = $this->home_visit_minor_form_model->get_incident_cp_details($cp_id);



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
                }
              }
              elseif($this->input->post('disability_certificate') ==2)
              {
                if($this->input->post('estimated_severity') || $add_edit_status==1 || $submit_status==1)
                {
                  $this->form_validation->set_rules('estimated_severity', 'estimated_severity', 'required|is_not_unique[cm_estimated_severity_master.sl_no]');
                  $final_array['estimated_severity']= $this->input->post('estimated_severity');
                }
              }
            }
          // }


        }
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
      // if($this->input->post('paid_work') || $add_edit_status==1 || $submit_status==1)
      // {
      //   $this->form_validation->set_rules('paid_work', 'paid_work', 'required');
      //   $final_array['paid_work']= $this->input->post('paid_work');
      //   if($this->input->post('paid_work') ==1 )
      //   {
      //     if($this->input->post('paid_work_frequency') || $add_edit_status==1 || $submit_status==1)
      //     {
      //       $this->form_validation->set_rules('paid_work_frequency', 'paid_work_frequency', 'required');
      //       $final_array['paid_work_frequency']= $this->input->post('paid_work_frequency');
      //     }
      //   }
      // }

      // if($this->input->post('paid_work') || $add_edit_status==1 || $submit_status==1)
      // {
      //   $this->form_validation->set_rules('paid_work', 'paid_work', 'required');
      //   $final_array['paid_work']= $this->input->post('paid_work');
      //   if($this->input->post('paid_work') ==1 || $add_edit_status==1 || $submit_status==1)
      //   {
      //     $this->form_validation->set_rules('paid_work_frequency', 'paid_work_frequency', 'required');
      //     $final_array['paid_work_frequency']= $this->input->post('paid_work_frequency');
      //   }
      // }
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
      // if($this->input->post('minor_pregnant') || $add_edit_status==1 || $submit_status==1)
      // {
      //   $this->form_validation->set_rules('minor_pregnant', 'minor_pregnant', 'required');
      //   $final_array['minor_pregnant']= $this->input->post('minor_pregnant');
      // }
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


      if($this->input->post('cp_school_district') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('cp_school_district', 'cp_school_district', 'required');
        $final_array['school_district']= $this->input->post('cp_school_district');
      }
      if($this->input->post('cp_school_block') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('cp_school_block', 'cp_school_block', 'required');
        $final_array['school_district']= $this->input->post('cp_school_block');
      }
      if($this->input->post('bs_school_id') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('bs_school_id', 'bs_school_id', 'required');
        $final_array['bs_school_id_fk']= $this->input->post('bs_school_id');
      }
      if($this->input->post('school_name') || $add_edit_status==1 || $submit_status==1)
      {
        $this->form_validation->set_rules('school_name', 'school_name', 'required');
        $final_array['school_name']= $this->input->post('school_name');
      }

        $filter['school_unavailable']= $this->input->post('school_unavailable');

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
            $siblingsdata[$key]['siblings_sex']=(isset($value['sex']))?$value['sex']:NULL;
            // $siblingsdata[$key]['siblings_occupation']=(isset($value['occupation']))?$value['occupation']:NULL;
            $siblingsdata[$key]['siblings_occupation']=(isset($value['occupation']))?(implode(",",(array)$value['occupation'])):NULL;

            if($siblingsdata[$key]['siblings_name'] || $siblingsdata[$key]['siblings_age'] || $siblingsdata[$key]['siblings_sex'] || $siblingsdata[$key]['siblings_occupation'])
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


          // echo "<pre>";print_r()
        }

        $siblingsdata_where = array();
        $siblingsdata_where['cp_id_fk'] = $cp_id;
        $siblingsdata_where['incident_id_fk'] = $incident_id;
        $siblingsdata_where['cp_type'] = $cp_type;

      }

        // echo "<pre>";print_r($siblingsdata);die;

      // if($siblings || $add_edit_status==1 || $submit_status==1)
      // {
      //   if(!empty($siblings))
      //   {
      //       for($i = 0; $i < count($siblings); $i++)
      //       {
      //           // if($siblings[$i]['name'] != "" && $siblings[$i]['age'] != "" && $siblings[$i]['sex'] != "")
      //           // {
      //               $siblings_occupation = implode(",",(array)$siblings[$i]['occupation']);
      //               $upload_home_visit_minor_siblings_details[$i] = [
      //                   // 'hv_id_fk' => $last_inst_id,
      //                   'cp_id_fk' => $cp_id,
      //                   'incident_id_fk' => $incident_id,
      //                   'cp_type' => $cp_type,
      //                   'siblings_name' => $siblings[$i]['name'],
      //                   'siblings_age' => $siblings[$i]['age'],
      //                   'siblings_sex' => $siblings[$i]['sex'],
      //                   'siblings_occupation' => $siblings_occupation,
      //                   'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
      //                   'entry_time' => date('Y-m-d H:i:s'),
      //                   'entry_ip' => $_SERVER['REMOTE_ADDR']
      //               ];
      //               // $result2 = $this->db->insert('cm_incident_report_home_visit_siblings_details', $upload_home_visit_minor_siblings_details);

      //           // }    

      //               // if()
      //               // {

      //               // }
      //       }
      //   }
      // }


      if($this->input->post('kanyashree_id'))
      {
         // $this->form_validation->set_rules('kanyashree_id', 'kanyashree_id', 'maxlength[20]');
         $this->form_validation->set_rules('kanyashree_id', 'Kanyashree ID', 'maxlength[20]', array('maxlength' => 'The {field} field cannot exceed 20 characters in length.'));
         $final_array['kanyashree_id']= $this->input->post('kanyashree_id');
      }

        // echo"<pre>";print_r($data);die;
      if ($this->form_validation->run() == TRUE && $custom_validate == 0)
      {
        // echo "<pre>";print_r($siblingsdata);die;
      // echo "<pre>";print_r($data['homwvisit_siblings_dtls']);die;
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
      }
      echo validation_errors('<div class="error">', '</div>');


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
    // $schcd_block = $this->input->get('schcd');
    $block_school = $this->home_visit_minor_form_model->get_school_dtls($block_id);
    echo json_encode($block_school);
  }
}
