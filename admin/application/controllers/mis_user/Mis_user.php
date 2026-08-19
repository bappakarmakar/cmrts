<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Mis_user extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('mis/CM_report_model');
    // echo 123;die;
    $this->load->model('mis_user/mis_user_model');
    $this->load->model('common/Master_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/css/jquery-ui.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }

  public function user_list() 
  {

    $login_id = $this->session->userdata('login_id');
    $district = $this->session->userdata('district');
    if($login_id=='State-Nodal-Officer' OR $login_id=='support_cmrts' OR $login_id=='State-MIS1-DWCDSW' OR $district !='')
    {
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $this->load->model('mis_user/mis_user_model');
    $data['sdo'] = $this->mis_user_model->get_sdo();
    $data['bdo'] = $this->mis_user_model->get_bdo();
    $data['sdo_deo'] = $this->mis_user_model->get_sdo_deo();
    $data['bdo_deo'] = $this->mis_user_model->get_bdo_deo();
    $data['mis_dist'] = $this->mis_user_model->get_mis_dist();

    // echo "<pre>";print_r($data);
    $this->load->view($this->config->item('theme').'mis_user/mis_user_view', $data);
    }
    else
    {
      $this->session->set_flashdata('error','Invalid request!');
      redirect('admin/dashboard', 'location');
    }
  }

  public function download_sdo()
  {
    $fileName = 'active_inactive_sdo_'.date('d_m_Y');
    // echo 123;die;
    $data['sdo'] = $this->mis_user_model->get_sdo();
    // echo "<pre>";print_r($data['sdo']);die;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(40);
    $sheet->getColumnDimension('E')->setWidth(15);

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'District Name');
    $sheet->setCellValue('C1', 'Subdivision Name');
    $sheet->setCellValue('D1', 'Username');
    $sheet->setCellValue('E1', 'Status');

    $rows = 2;
    $count = 1;
    foreach ($data['sdo'] as $value)
    {
      if($value->active_status == 1 && $value->status == 1)
      {
        $status =  "Active";
      }
      else
      {
        $status =  "Inactive";
      }
      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value->district_name);
      $sheet->setCellValue('C' . $rows, $value->subdiv_name);
      $sheet->setCellValue('D' . $rows, $value->login_id);
      $sheet->setCellValue('E' . $rows, $status);
      $rows++;
    }

     $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');


  }

  public function download_bdo()
  {
    $fileName = 'active_inactive_bdo_'.date('d_m_Y');
    $data['bdo'] = $this->mis_user_model->get_bdo();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(40);
    $sheet->getColumnDimension('E')->setWidth(15);

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'District Name');
    $sheet->setCellValue('C1', 'Block Name');
    $sheet->setCellValue('D1', 'Username');
    $sheet->setCellValue('E1', 'Status');

    $rows = 2;
    $count = 1;
    foreach ($data['bdo'] as $value)
    {
      if($value->active_status == 1 && $value->status == 1)
      {
        $status =  "Active";
      }
      else
      {
        $status =  "Inactive";
      }
      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value->district_name);
      $sheet->setCellValue('C' . $rows, $value->block_name);
      $sheet->setCellValue('D' . $rows, $value->login_id);
      $sheet->setCellValue('E' . $rows, $status);
      $rows++;
    }

     $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');


  }

  public function download_sdo_deo()
  {
    $fileName = 'active_inactive_deo_urban_'.date('d_m_Y');
    $data['sdo_deo'] = $this->mis_user_model->get_sdo_deo();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(25);
    $sheet->getColumnDimension('E')->setWidth(50);
    $sheet->getColumnDimension('F')->setWidth(15);

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'District Name');
    $sheet->setCellValue('C1', 'Subdivision Name');
    $sheet->setCellValue('D1', 'Municipality Name');
    $sheet->setCellValue('E1', 'Username');
    $sheet->setCellValue('F1', 'Status');

    $rows = 2;
    $count = 1;
    foreach ($data['sdo_deo'] as $value)
    {
      if($value->active_status == 1 && $value->status == 1)
      {
        $status =  "Active";
      }
      else
      {
        $status =  "Inactive";
      }
      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value->district_name);
      $sheet->setCellValue('C' . $rows, $value->subdiv_name);
      $sheet->setCellValue('D' . $rows, $value->block_name);
      $sheet->setCellValue('E' . $rows, $value->deo_login_id);
      $sheet->setCellValue('F' . $rows, $status);
      $rows++;
    }

     $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');


  }

  public function download_bdo_deo()
  {
    $fileName = 'active_inactive_deo_rural_'.date('d_m_Y');
    $data['bdo_deo'] = $this->mis_user_model->get_bdo_deo();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(40);
    $sheet->getColumnDimension('E')->setWidth(15);

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'District Name');
    $sheet->setCellValue('C1', 'Block Name');
    $sheet->setCellValue('D1', 'Username');
    $sheet->setCellValue('E1', 'Status');

    $rows = 2;
    $count = 1;
    foreach ($data['bdo_deo'] as $value)
    {
      if($value->active_status == 1 && $value->status == 1)
      {
        $status =  "Active";
      }
      else
      {
        $status =  "Inactive";
      }
      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value->district_name);
      $sheet->setCellValue('C' . $rows, $value->block_name);
      $sheet->setCellValue('D' . $rows, $value->deo_login_id);
      $sheet->setCellValue('E' . $rows, $status);
      $rows++;
    }

     $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');


  }

  public function download_mis_dist()
  {
    $fileName = 'active_inactive_mis_district_user_'.date('d_m_Y');
    $data['mis_dist'] = $this->mis_user_model->get_mis_dist();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(40);

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'District Name');
    $sheet->setCellValue('C1', 'MIS user Name');
    $sheet->setCellValue('D1', 'Status');

    $rows = 2;
    $count = 1;
    foreach ($data['mis_dist'] as $value)
    {
      if($value->active_status == 1 && $value->status == 1)
      {
        $status =  "Active";
      }
      else
      {
        $status =  "Inactive";
      }
      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value->district_name);
      $sheet->setCellValue('C' . $rows, $value->mis_login_id);
      $sheet->setCellValue('D' . $rows, $status);
      $rows++;
    }

     $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');


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

  public function us_date_format($uk_date=NULL)
  {
    if($uk_date != NULL){
       $date_array = explode('/', $uk_date);
       return $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
    } else {
       return NULL;
    }
  }

  public function convert_date_format($date=NULL) 
  {
    if ($date!=NULL) 
    {
      // code...
    // Create DateTime object from the input date string
      $dateTime = DateTime::createFromFormat('d/m/Y', $date);

      // Check if the date is valid in the given format
      if ($dateTime === false) 
      {
          // If not in d/m/Y format, attempt to create DateTime object with other formats
          $dateTime = DateTime::createFromFormat('Y-m-d', $date);
          if ($dateTime === false) {
              return "Invalid date format";
          }
      }

      // Convert the date to "dd/mm/yyyy" format
      $newDate = $dateTime->format('d/m/Y');
      return $newDate;
    }
    else
    {
      return NULL;
    }
  }

  // public function date_check($date)
  // {

  //   // echo $date;die;
  //   $currentDate = date('d/m/Y');
  //   if(empty($date)){
  //     $this->form_validation->set_message('date_check', 'The Date field is required');

  //       return false;

  //   }else{
  //     $date_array = explode('/', $date);
  //      $to_date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

  //      $date_array1 = explode('/', $currentDate);
  //      $currentDate =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];

  //     // echo strtotime($fir_date)."-----".strtotime($incident_date).'<br>' ; 
  //     // echo $to_date."-----".$currentDate ; die;
  //     if(strtotime($to_date)>strtotime($currentDate))
  //     {
  //       $this->form_validation->set_message('date_check', 'The entered date should not be more then current date');
  //       return false;
  //     }
  //       return true;
  //   }

  // }

  public function valid_date($str) {
    if(empty($str)){
      $this->form_validation->set_message('valid_date', 'The Date of Birth field is required.');
      return false; // Invalid date
    }else{
      $custom_format = 'd/m/Y';
      $date = DateTime::createFromFormat($custom_format, $str);

      if ($date && $date->format($custom_format) === $str) {
        
        return true; // Invalid date
      } else {
          $this->form_validation->set_message('valid_date', 'The Date of Birth field must be in the format dd/mm/yyyy.');
          return false; // Invalid date
      }

    }
  }

  public function date_check_with_current($str)
  {
    // echo $str;die;
    $currentDate = date('d/m/Y'); 
    if(empty($str))
    {
      $this->form_validation->set_message('date_check_with_current', 'The Date field is required');
        return false;
    }
    else
    {
      $custom_format = 'd/m/Y';
      $date = DateTime::createFromFormat($custom_format, $str);

      if($date && $date->format($custom_format) === $str)
      {
        $date_array = explode('/', $str);
        $to_date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

        $date_array1 = explode('/', $currentDate);
        $currentDate =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];
        if(strtotime($to_date)>strtotime($currentDate))
        {
          $this->form_validation->set_message('date_check_with_current', 'The entered date should not be more then current date');
          return false;
        }
        return true;
      }
      else
      {
        $this->form_validation->set_message('date_check_with_current', 'The Date field must be in the format dd/mm/yyyy.');
        return false;
      }
    }
  }

  public function date_check_with_Todate($str,$to_date)
  {
    // echo $str."--------------------------".$to_date;die;
    $currentDate = date('d/m/Y'); 
    if(empty($str))
    {
      $this->form_validation->set_message('date_check_with_Todate', 'The {field} field is required');
        return false;
    }
    else
    {
      $custom_format = 'd/m/Y';
      $date = DateTime::createFromFormat($custom_format, $str);
      $date1 = DateTime::createFromFormat($custom_format, $to_date);

      if($date && $date1 && $date->format($custom_format) === $str)
      {
        $date_array = explode('/', $str);
        $from_date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

        $date_array1 = explode('/', $to_date);
        $to_date =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];

        // echo $from_date."----------------".$to_date;die;
        // echo strtotime($from_date)."----------------".strtotime($to_date);die;


        if(strtotime($from_date)>strtotime($to_date))
        {
          $this->form_validation->set_message('date_check_with_Todate', 'The {field} should not be more then To date');
          return false;
        }
        return true;
      }
      else
      {
        $this->form_validation->set_message('date_check_with_Todate', 'The Date field must be in the format dd/mm/yyyy.');
        return false;
      }
    }
  }


}
