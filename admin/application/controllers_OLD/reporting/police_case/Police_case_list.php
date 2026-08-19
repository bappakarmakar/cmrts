<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Police_case_list extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('police_case/police_case_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->load->model('incident/incident_form_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
      2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
      3 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
    );

    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery.ui.datepicker.js',
      2 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      3 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
      4 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      5 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }

  public function index() 
  {
      $this->validate_login(array('4'));
      $login_id = $this->session->userdata('login_id');
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);
      $data['police_case_details'] = $this->police_case_model->police_case_list_details();
      $this->load->view($this->config->item('theme').'reporting/police_case/police_case_list_view', $data); 
  }

  public function edit_police_case($sl_no, $incident_id)
  {
      $this->validate_login(array('4'));
      $sl_no = base64_decode($sl_no);
      $incident_id = base64_decode($incident_id);
      $data['incident_details'] = json_decode(json_encode($this->incident_form_model->get_incident_details($incident_id)),true);
      $data['reason'] = $this->police_case_model->cm_police_case_reason();
      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        $config = array(
        array(
          'field' => 'gd_no',
          'label' => 'GD No',
          'rules' => 'trim|required|callback_custom_Alpha_Check'
        ),
        array(
          'field' => 'gd_date',
          'label' => 'GD Date',
          'rules' => 'trim|required|is_date_valid|callback_date_check_with_incident'
        ),
        array(
          'field' => 'fir_no',
          'label' => 'FIR No',
          'rules' => 'trim|required|callback_custom_Alpha_Check'
        ),
        array(
          'field' => 'fir_date',
          'label' => 'FIR Date',
          'rules' => 'trim|required|is_date_valid|callback_date_check_with_incident'
        ),
        array(
          'field' => 'police_station',
          'label' => 'Police Station',
          'rules' => 'trim|required|callback_custom_Alpha_Check'
        ),
        array(
          'field' => 'pc_district',
          'label' => 'District',
          'rules' => 'trim|required|numeric'
        ),
        array(
          'field' => 'pc_block',
          'label' => 'SD/Block',
          'rules' => 'trim|required|numeric'
        ),
        array(
          'field' => 'reason',
          'label' => 'Reason',
          'rules' => 'trim|required|numeric'
        ),
      );
      $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE) {
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['districts'] = $this->Master_model->get_district();
        $data['police_case_details'] = $this->police_case_model->police_case_edit_details($sl_no);

        $pc_district = $data['police_case_details']->district;
        $data['Block'] = $this->Master_model->get_block($pc_district);
        $this->load->view($this->config->item('theme').'reporting/police_case/police_case_form_edit_view', $data);
      }else{
        $this->db->trans_begin();
        $result = $this->police_case_model->update_police_case_details($sl_no);
        if($result == 0){
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Police case details data successful updated.');
            redirect('admin/reporting/police_case/police_case_list');
        }else{
          $this->db->trans_rollback();
          $this->session->set_flashdata('warning', 'Police case details data updation failed. Please try again.');
           redirect('admin/reporting/police_case/police_case_list');
        }
      }
  }

  public function list_print()
  {
     $data['police_case_print_details_data'] = $this->police_case_model->police_case_list_details();
     $html = $this->load->view($this->config->item('theme').'reporting/police_case/Police_Case_Generated_List_Print_View', $data);
  }

  public function list_download()
  {
      $fileName = 'Police_Case_Report'.date('d_m_Y');  
      $police_case_details = $this->police_case_model->police_case_list_details();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

      $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      
      $sheet->getColumnDimension('A')->setWidth(10);
      $sheet->getColumnDimension('B')->setWidth(15);
      $sheet->getColumnDimension('C')->setWidth(15);
      $sheet->getColumnDimension('D')->setWidth(15);
      $sheet->getColumnDimension('E')->setWidth(15);
      $sheet->getColumnDimension('F')->setWidth(15);

      $sheet->setCellValue('A1', 'Sl. No');
      $sheet->setCellValue('B1', 'Incident ID');
      $sheet->setCellValue('C1', 'GD No');
      $sheet->setCellValue('D1', 'GD Date');
      $sheet->setCellValue('E1', 'FIR No');
      $sheet->setCellValue('F1', 'FIR Date');                    
      $rows = 2;
      $count = 1;
      foreach ($police_case_details as $val){
          $gd_date = date('d-m-Y', strtotime($val->gd_date));  
          $fir_date = date('d-m-Y', strtotime($val->fir_date));

          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('B' . $rows, $val->reporting_id);
          $sheet->setCellValue('C' . $rows, $val->gd_no);
          $sheet->setCellValue('D' . $rows, $gd_date);
          $sheet->setCellValue('E' . $rows, $val->fir_no);
          $sheet->setCellValue('F' . $rows, $fir_date);
          $rows++;
      } 
      $writer = new Xlsx($spreadsheet);
      header("Content-Type: application/vnd.ms-excel");
      header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
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

  public function date_less_check($fir_date)
  {

    // echo $fir_date;die;
    $incident_date = $this->input->post('incident_date');
    if(empty($fir_date)){
      $this->form_validation->set_message('date_less_check', 'The FIR Date field is required');

        return false;

    }else{
      $date_array = explode('-', $incident_date);
       $incident_date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

       $date_array1 = explode('/', $fir_date);
       $fir_date =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];

      // echo strtotime($fir_date)."-----".strtotime($incident_date).'<br>' ; 
      // echo $fir_date."-----".$incident_date ; die;
      if(strtotime($fir_date)<strtotime($incident_date))
      {
        $this->form_validation->set_message('date_less_check', 'Fir date should not be less then incident date: '. $this->input->post('incident_date'));
        return false;
      }
        return true;
    }

  }

  public function date_check_with_incident($str)
  {
    // echo $str;die;
    $incident_date = $this->input->post('incident_date');
    if(empty($str))
    {
      $this->form_validation->set_message('date_check_with_incident', 'The Date field is required');
        return false;
    }
    else
    {
      $custom_format = 'd/m/Y';
      $date = DateTime::createFromFormat($custom_format, $str);

      if($date && $date->format($custom_format) === $str)
      {
        $date_array = explode('/', $str);
        $date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

        $date_array1 = explode('-', $incident_date);
        $incident_date =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];
        if(strtotime($date)<strtotime($incident_date))
        {
          $this->form_validation->set_message('date_check_with_incident', 'The date should not be less then incident date: '. $this->input->post('incident_date'));
          return false;
        }
        return true;
      }
      else
      {
        $this->form_validation->set_message('date_check_with_incident', 'The Date of Birth field must be in the format dd/mm/yyyy.');
        return false;
      }
    }
  }
  public function custom_Alpha_Check($str) 
  {
     if (! preg_match("/^([a-z0-9 ])+$/i", $str)) {
        $this->form_validation->set_message('custom_Alpha_Check', 'The %s field can only be alpha numeric');
        return false;
     } else {
        return true;
     }

     if (! preg_match("/^([a-z0-9 ])+$/i", $str)) {
        $this->form_validation->set_message('custom_Alpha_Check', 'The %s field can only be alpha numeric');
        return false;
     } else {
        return true;
     }

     if (! preg_match("/^([a-z0-9 ])+$/i", $str)) {
        $this->form_validation->set_message('custom_Alpha_Check', 'The %s field can only be alpha numeric');
        return false;
     } else {
        return true;
     }
  }
}
