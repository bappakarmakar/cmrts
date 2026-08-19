<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home_visits_list extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->model('home_visit/home_visit_list_model');
    $this->load->model('home_visit/home_visit_minor_form_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
      2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery.ui.datepicker.js',
      // 2 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      // 3 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
      // 4 => $this->config->item('theme_uri').'/assets/js/prevention_intervention_form.js',
    );
  }

  public function index() 
  {
     $this->validate_login(array('4'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $final_array['entry_by'] = $this->session->userdata('stake_holder_login_id_pk');
     // $data['home_visits_total_details'] = $this->home_visit_list_model->home_visits_list_details();
     // DISTINCT ON ("A"."cp_id_fk")

     $data['selected_fields'] = ' DISTINCT ON ("A"."cp_id_fk") "A"."hv_status",
                                "A"."cp_type",
                                "A"."cp_id_fk",
                                "A"."incident_id_fk",
                                G.incident_date,
                                G.reporting_id,
                                B.cp_name,
                                B.cp_age,
                                B.cp_gender,
                                B.cp_block,
                                B.cp_ward_gp,
                                F.description as status,
                                H.description as cp_gender_val,
                                 ';

     $data['home_visits_total_details'] = $this->home_visit_minor_form_model->get_homwvisit_dtls(
      array(
        'entry_by'=>$this->session->userdata('stake_holder_login_id_pk'),'party_details'=>1,'incident_details'=>101,'cp_gender_details'=>1,'hv_status_details'=>11,'selected_fields'=>$data['selected_fields'],'get_as_obj'=>101

      ));
     // echo "<pre>";print_r( $data['home_visits_total_details']);die;

     foreach ($data['home_visits_total_details'] as $key => $value) 
     {
       // code...
      if($value->cp_age<18)
      {
        // $data['home_visits_total_details']->$key['minor_adult_status'] = "Home Visit Minor Form";
         $value->minor_adult_status = "Home Visit Minor Form";
         $value->url = base_url()."admin/reporting/incident/incident_list/home_visit_minor_form/";
      }
      else
      {
        $value->minor_adult_status = "Home Visit Adult Form";
        $value->url = base_url()."admin/reporting/incident/incident_list/home_visit_adult_form/";
      }

      if($value->hv_status == 0)
      {
         $value->action = "Edit Draft Form";
      }
      else if($value->hv_status == 1)
      {
         $value->action = "Edit Form";
      }
      else
      {
         $value->action = "";
      }
     }
     $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_list_view', $data);
  }

  public function publish_homevisit()
  {
    // echo 123456;
    // echo "<pre>";print_r($_GET);
    $cp_id_fk = $this->input->get('cp_id_fk');
    $cp_id_fk = base64_decode($cp_id_fk);

    echo $cp_id_fk;

    $update['hv_status'] = 2;
    $where['cp_id_fk'] = $cp_id_fk;

    // echo $cp_id_fk;
    $result = $this->home_visit_list_model->publish_homevisit_details($update,$where);
  }

  public function list_download()
  {
      $fileName = 'Home_Visit_Report'.date('d_m_Y');
      $home_visits_details = $this->home_visit_list_model->home_visits_list_details();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

      $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getColumnDimension('A')->setWidth(10);
      $sheet->getColumnDimension('B')->setWidth(15);
      $sheet->getColumnDimension('C')->setWidth(15);
      $sheet->getColumnDimension('D')->setWidth(15);
      $sheet->getColumnDimension('E')->setWidth(30);
      $sheet->getColumnDimension('F')->setWidth(15);
      $sheet->getColumnDimension('G')->setWidth(10);

      $sheet->setCellValue('A1', 'Sl. No');
      $sheet->setCellValue('B1', 'Incident Date');
      $sheet->setCellValue('C1', 'Incident ID');
      $sheet->setCellValue('D1', 'Ward / GP');
      $sheet->setCellValue('E1', 'Name');
      $sheet->setCellValue('F1', 'Gender');       
      $sheet->setCellValue('G1', 'Age');                 
      $rows = 2;
      $count = 1;
      foreach ($home_visits_details as $value){
        $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_1_block_id);
        if(!empty($cp_one_block_details)){
          if($cp_one_block_details->rural_urban == 'U'){
            $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_1_ward_gp);
          }else{
            $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_1_ward_gp);
          }
        }else{
          $cp_one_ward_gp_details = array();
        }

          $incident_date = date('d-m-Y', strtotime($value->incident_date));
          $ward_gp = ($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';

          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('B' . $rows, $incident_date);
          $sheet->setCellValue('C' . $rows, $value->reporting_id);
          $sheet->setCellValue('D' . $rows, $ward_gp);
          $sheet->setCellValue('E' . $rows, $value->cp_1_name);
          $sheet->setCellValue('F' . $rows, $value->cp_1_gender_value);
          $sheet->setCellValue('G' . $rows, $value->cp_1_age);
          $rows++;
      } 
      $writer = new Xlsx($spreadsheet);
      header("Content-Type: application/vnd.ms-excel");
      header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
  }

  public function list_print()
  {
     $data['home_visits_print_details_data'] = $this->home_visit_list_model->home_visits_list_details();
     $html = $this->load->view($this->config->item('theme').'reporting/home_visit/Home_Visit_Generated_List_Print_View', $data);
     // $this->load->view($this->config->item('theme').'reporting/home_visit/Home_Visit_Generated_List_Print_View', $data);
  }



  public function get_homevist_dtls()
  {
   
    if($this->input->get('incident_id'))
    {
      $incident_id = base64_decode($this->input->get('incident_id'));
    }

    if($this->input->get('cp_type'))
    {
      $cp_type = base64_decode($this->input->get('cp_type'));
    }

    if($this->input->get('cp_id'))
    {
      $cp_id = base64_decode($this->input->get('cp_id'));
    }

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
                                I.description AS mode_of_enquiry_val,
                                J.description AS estimated_severity_val,
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
                        'mode_of_enquiry_details'=>11,
                                                'estimated_severity_details'=>11,
                        'selected_fields'=>$data['selected_fields']
          );

    $data['homwvisit_dtls']=$this->home_visit_minor_form_model->get_homwvisit_dtls($get_dtls);

    $situation_code = $this->config->item('situation_code');

    $engaged_check = $this->config->item('engaged_check');


    (isset($data['homwvisit_dtls']['family_income']))?($data['homwvisit_dtls']['family_income_val']=$situation_code[$data['homwvisit_dtls']['family_income']]):$data['homwvisit_dtls']['family_income_val']=null;

    (isset($data['homwvisit_dtls']['nutritious_meals']))?($data['homwvisit_dtls']['nutritious_meals_val']=$situation_code[$data['homwvisit_dtls']['nutritious_meals']]):$data['homwvisit_dtls']['nutritious_meals_val']=null;

    (isset($data['homwvisit_dtls']['neighbours_community']))?($data['homwvisit_dtls']['neighbours_community_val']=$situation_code[$data['homwvisit_dtls']['neighbours_community']]):$data['homwvisit_dtls']['neighbours_community_val']=null;

    (isset($data['homwvisit_dtls']['emergencies']))?($data['homwvisit_dtls']['emergencies_val']=$situation_code[$data['homwvisit_dtls']['emergencies']]):$data['homwvisit_dtls']['emergencies_val']=null;


    if(isset($data['homwvisit_dtls']['education']))
    {
        $data['homwvisit_dtls']['education_val']= $engaged_check[$data['homwvisit_dtls']['education']];
      if($data['homwvisit_dtls']['education']==1)
      {
        if(isset($data['homwvisit_dtls']['education_frequency']))
        {
          $data['homwvisit_dtls']['education_frequency_val']= $situation_code[$data['homwvisit_dtls']['education_frequency']];
        }
        else
        {
          $data['homwvisit_dtls']['education_frequency_val']= null;
        }
      }
    }
    else
    {
      $data['homwvisit_dtls']['education_val']= null;
    }

    // kishori_group
    if(isset($data['homwvisit_dtls']['kishori_group']))
    {
        $data['homwvisit_dtls']['kishori_group_val']= $engaged_check[$data['homwvisit_dtls']['kishori_group']];
      if($data['homwvisit_dtls']['kishori_group']==1)
      {
        if(isset($data['homwvisit_dtls']['kishori_group_frequency']))
        {
          $data['homwvisit_dtls']['kishori_group_frequency_val']= $situation_code[$data['homwvisit_dtls']['kishori_group_frequency']];
        }
        else
        {
          $data['homwvisit_dtls']['kishori_group_frequency_val']= null;
        }
      }
    }
    else
    {
      $data['homwvisit_dtls']['kishori_group_val']= null;
    }

    // paid_work
    if(isset($data['homwvisit_dtls']['paid_work']))
    {
        $data['homwvisit_dtls']['paid_work_val']= $engaged_check[$data['homwvisit_dtls']['paid_work']];
      if($data['homwvisit_dtls']['paid_work']==1)
      {
        if(isset($data['homwvisit_dtls']['paid_work_frequency']))
        {
          $data['homwvisit_dtls']['paid_work_frequency_val']= $situation_code[$data['homwvisit_dtls']['paid_work_frequency']];
        }
        else
        {
          $data['homwvisit_dtls']['paid_work_frequency_val']= null;
        }
      }
    }
    else
    {
      $data['homwvisit_dtls']['paid_work_val']= null;
    }

   // parents_supported
   (isset($data['homwvisit_dtls']['parents_supported']))?($data['homwvisit_dtls']['parents_supported_val']=$situation_code[$data['homwvisit_dtls']['parents_supported']]):$data['homwvisit_dtls']['parents_supported_val']=null;
   // family_elders_supported
   (isset($data['homwvisit_dtls']['family_elders_supported']))?($data['homwvisit_dtls']['family_elders_supported_val']=$situation_code[$data['homwvisit_dtls']['family_elders_supported']]):$data['homwvisit_dtls']['family_elders_supported_val']=null;
   // peers_supported
   (isset($data['homwvisit_dtls']['peers_supported']))?($data['homwvisit_dtls']['peers_supported_val']=$situation_code[$data['homwvisit_dtls']['peers_supported']]):$data['homwvisit_dtls']['peers_supported_val']=null;
   // neighbours_supported
   (isset($data['homwvisit_dtls']['neighbours_supported']))?($data['homwvisit_dtls']['neighbours_supported_val']=$situation_code[$data['homwvisit_dtls']['neighbours_supported']]):$data['homwvisit_dtls']['neighbours_supported_val']=null;
   // others_supported
   (isset($data['homwvisit_dtls']['others_supported']))?($data['homwvisit_dtls']['others_supported_val']=$situation_code[$data['homwvisit_dtls']['others_supported']]):$data['homwvisit_dtls']['others_supported_val']=null;

   if(isset($data['homwvisit_dtls']['disability']))
   {
    if ($data['homwvisit_dtls']['disability'] == 1) 
    {
      $data['homwvisit_dtls']['disability_val'] = "Yes";
    }
    else if($data['homwvisit_dtls']['disability'] == 2)
    {
      $data['homwvisit_dtls']['disability_val'] = "No" ;
    }
    else
    {
      $data['homwvisit_dtls']['disability_val'] = "" ;
    }
   }

    $Disability_type[1] = "Locomotor";
    $Disability_type[2] = "Hearing";
    $Disability_type[3] = "Speech/Language";
    $Disability_type[4] = "Visual";
    $Disability_type[5] = "Intellectual";
    $Disability_type[6] = "Other"; 

    // type_of_disability

    (isset($data['homwvisit_dtls']['type_of_disability']))?($data['homwvisit_dtls']['type_of_disability_array'] = explode(',', $data['homwvisit_dtls']['type_of_disability'])):'';

    $data['homwvisit_dtls']['type_of_disability_values'] = []; // Initialize an array to store values
    $data['homwvisit_dtls']['type_of_disability_values_final'] = ''; // Initialize an empty string to concatenate values

  foreach ($data['homwvisit_dtls']['type_of_disability_array'] as $key => $value) 
  {
  $disability_value = $Disability_type[$value];
  $data['homwvisit_dtls']['type_of_disability_values'][] = $disability_value; // Store individual values

  // Concatenate values into a string with comma separation, without leading comma
  $data['homwvisit_dtls']['type_of_disability_values_final'] .= ($data['homwvisit_dtls']['type_of_disability_values_final'] ? ',' : '') . $disability_value;
  }


  if(isset($data['homwvisit_dtls']['disability_certificate']))
  {
  if ($data['homwvisit_dtls']['disability_certificate'] == 1) 
  {
    $data['homwvisit_dtls']['disability_certificate_val'] = "Yes";
  }
  else if($data['homwvisit_dtls']['disability_certificate'] == 2)
  {
    $data['homwvisit_dtls']['disability_certificate_val'] = "No" ;
  }
  else
  {
    $data['homwvisit_dtls']['disability_certificate_val'] = "" ;
  }
  }



    // (isset($data['homwvisit_dtls']['neighbours_community']))?($data['homwvisit_dtls']['neighbours_community_val']=$master['situation_code'][$data['homwvisit_dtls']['neighbours_community']]):null;


    // // nutritious_meals 
    // if($data['homwvisit_dtls']['nutritious_meals'] == 1)
    // {
    //   $data['homwvisit_dtls']['nutritious_meals_val'] = 'Rarely';
    // }
    // else if ($data['homwvisit_dtls']['nutritious_meals'] == 2)
    // {
    //   $data['homwvisit_dtls']['nutritious_meals_val'] = 'Sometimes';
    // }
    // else if ($data['homwvisit_dtls']['nutritious_meals'] == 3)
    // {
    //   $data['homwvisit_dtls']['nutritious_meals_val'] = 'Regularly';
    // }
    // else
    // {
    //   $data['homwvisit_dtls']['nutritious_meals_val'] = '';
    // }


    // // neighbours_community
    // if($data['homwvisit_dtls']['neighbours_community'] == 1)
    // {
    //   $data['homwvisit_dtls']['neighbours_community_val'] = 'Rarely';
    // }
    // else if ($data['homwvisit_dtls']['neighbours_community'] == 2)
    // {
    //   $data['homwvisit_dtls']['neighbours_community_val'] = 'Sometimes';
    // }
    // else if ($data['homwvisit_dtls']['neighbours_community'] == 3)
    // {
    //   $data['homwvisit_dtls']['neighbours_community_val'] = 'Regularly';
    // }
    // else
    // {
    //   $data['homwvisit_dtls']['neighbours_community_val'] = '';
    // }

    // emergencies
    // if($data['homwvisit_dtls']['emergencies'] == 1)
    // {
    //   $data['homwvisit_dtls']['emergencies_val'] = 'Rarely';
    // }
    // else if ($data['homwvisit_dtls']['emergencies'] == 2)
    // {
    //   $data['homwvisit_dtls']['emergencies_val'] = 'Sometimes';
    // }
    // else if ($data['homwvisit_dtls']['emergencies'] == 3)
    // {
    //   $data['homwvisit_dtls']['emergencies_val'] = 'Regularly';
    // }
    // else
    // {
    //   $data['homwvisit_dtls']['emergencies_val'] = '';
    // }




    $data1['homwvisit_siblings_dtls']=$this->home_visit_minor_form_model->get_homwvisit_siblings_dtls(
          array('cp_id_fk'=>$cp_id,'cp_type'=>$cp_type,'incident_id_fk'=>$incident_id));

    $data['homwvisit_dtls']['homwvisit_siblings_dtls'] = $data1['homwvisit_siblings_dtls'];

    // $data = array_merge($data['homwvisit_dtls'], $data['homwvisit_siblings_dtls']);

    // echo "<pre>"; print_r($data['homwvisit_dtls']);

    // echo "<pre>";print_r($data['homwvisit_dtls']);die;

    echo json_encode($data['homwvisit_dtls']);





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
