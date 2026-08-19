<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cm_report_view extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('mis/CM_report_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/css/jquery-ui.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }

  public function index() 
  {
     $this->validate_login(array('1','5', '4', '2', '3','6'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
     $config = array(
       array(
        'field' => 'from_date',
        'label' => 'From Date',
        'rules' => 'trim|required|is_date_valid'
       ),
       array(
        'field' => 'to_date',
        'label' => 'To Date',
        'rules' => 'trim|required|is_date_valid'
       ),
     );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == TRUE) {
       $from_date = $this->us_date_format($this->input->post('from_date'));
       $to_date = $this->us_date_format($this->input->post('to_date'));
       $report_result = $this->CM_report_model->cm_report($from_date, $to_date);
       $data['report_result'] = $report_result;
    }
    $this->load->view($this->config->item('theme').'mis/cm_report/cm_report_form_view_district', $data);
  }

  public function block_wise($district_id, $from_date, $to_date)
  {
     $this->validate_login(array('1','5', '4', '2', '3','6'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $report_result = $this->CM_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
     $data['report_result'] = $report_result;
     $data['from_date'] = $from_date;
     $data['to_date'] = $to_date;
     $data['district_id'] = $district_id;
     $this->load->view($this->config->item('theme').'mis/cm_report/cm_report_form_view_sd_block', $data);
  }

  public function ward_gp($block_id, $from_date, $to_date)
  {
     $this->validate_login(array('1', '5', '4', '2', '3','6'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $report_result = $this->CM_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
     $data['report_result'] = $report_result;
     $data['from_date'] = $from_date;
     $data['to_date'] = $to_date;
     $data['block_id'] = $block_id;
     $this->load->view($this->config->item('theme').'mis/cm_report/cm_report_form_view_ward_gp', $data);
  }

  public function District_Wise_Download_Excel($from_date, $to_date)
  {
    $this->validate_login(array('1', '5', '4', '2', '3','6'));
    $fileName = 'CM_Report_District_Wise';
    $report_result = $this->CM_report_model->cm_report($from_date, $to_date);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2:F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G2:H2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I2:J2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K2:L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C2:D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E2:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G2:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I2:J2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K2:L2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


    $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('J')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('L')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('B')->setWidth(23);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(15);
    $sheet->getColumnDimension('E')->setWidth(15);
    $sheet->getColumnDimension('F')->setWidth(15);
    $sheet->getColumnDimension('G')->setWidth(15);
    $sheet->getColumnDimension('H')->setWidth(15);
    $sheet->getColumnDimension('I')->setWidth(15);
    $sheet->getColumnDimension('J')->setWidth(15);
    $sheet->getColumnDimension('K')->setWidth(15);
    $sheet->getColumnDimension('L')->setWidth(15);

    $sheet->mergeCells('A1:A2');
    $sheet->mergeCells('B1:B2');
    $sheet->mergeCells('C1:D1');
    $sheet->mergeCells('E1:F1');
    $sheet->mergeCells('G1:H1');
    $sheet->mergeCells('I1:J1');
    $sheet->mergeCells('K1:L1');

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'Jurisdiction');

    $sheet->setCellValue('C1', 'Before');
    $sheet->setCellValue('C2', 'Reported');
    $sheet->setCellValue('D2', 'Prevented');

    $sheet->setCellValue('E1', 'During');
    $sheet->setCellValue('E2', 'Reported');
    $sheet->setCellValue('F2', 'Prevented');

    $sheet->setCellValue('G1', 'After');
    $sheet->setCellValue('G2', 'Reported');
    $sheet->setCellValue('H2', 'Prevented');

    $sheet->setCellValue('I1', 'Totals');   
    $sheet->setCellValue('I2', 'Reported');
    $sheet->setCellValue('J2', 'Prevented');

    $sheet->setCellValue('K1', 'No. of minor involved');  
    $sheet->setCellValue('K2', 'Female');
    $sheet->setCellValue('L2', 'Male');             
    $rows = 3;
    $count = 1;
    foreach ($report_result as $value){
      $before_marriage_reported = $value['before_marriage_reported'];
      $before_marriage_prevented = $value['before_marriage_prevented'];

      $during_marriage_reported = $value['during_marriage_reported'];
      $during_marriage_prevented = $value['during_marriage_prevented'];

      $after_marriage_reported = $value['after_marriage_reported'];
      $after_marriage_prevented = $value['after_marriage_prevented'];

      $total_reported = $before_marriage_reported+$during_marriage_reported+$after_marriage_reported;

      $total_prevented = $before_marriage_prevented+$during_marriage_prevented+$after_marriage_prevented;

      if($value['before_marriage_reported'] != 0){ 
        $before_marriage_reported = $value['before_marriage_reported']; 
      } else { 
        $before_marriage_reported = "0"; 
      }

      if($value['before_marriage_prevented'] != 0){ 
        $before_marriage_prevented = $value['before_marriage_prevented']; 
      } else { 
        $before_marriage_prevented = "0"; 
      }

      if($value['during_marriage_reported'] != 0){ 
        $during_marriage_reported = $value['during_marriage_reported']; 
      } else { 
        $during_marriage_reported = "0"; 
      }

      if($value['during_marriage_prevented'] != 0){ 
        $during_marriage_prevented = $value['during_marriage_prevented']; 
      } else { 
        $during_marriage_prevented = "0"; 
      }

      if($value['after_marriage_reported'] != 0){ 
        $after_marriage_reported = $value['after_marriage_reported']; 
      } else { 
        $after_marriage_reported = "0"; 
      }

      if($value['after_marriage_prevented'] != 0){ 
        $after_marriage_prevented = $value['after_marriage_prevented']; 
      } else { 
        $after_marriage_prevented = "0"; 
      }

      if($value['total_female_count_under_18'] != 0){ 
        $total_female_count_under_18 = $value['total_female_count_under_18']; 
      } else { 
        $total_female_count_under_18 = "0"; 
      }

      if($value['total_male_count_under_18'] != 0){ 
        $total_male_count_under_18 = $value['total_male_count_under_18']; 
      } else { 
        $total_male_count_under_18 = "0"; 
      }

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['district_name']);

      $sheet->setCellValue('C' . $rows, $before_marriage_reported);
      $sheet->setCellValue('D' . $rows, $before_marriage_prevented);

      $sheet->setCellValue('E' . $rows, $during_marriage_reported);
      $sheet->setCellValue('F' . $rows, $during_marriage_prevented);

      $sheet->setCellValue('G' . $rows, $after_marriage_reported);
      $sheet->setCellValue('H' . $rows, $after_marriage_prevented);

      $sheet->setCellValue('I' . $rows, $total_reported);
      $sheet->setCellValue('J' . $rows, $total_prevented);

      $sheet->setCellValue('K' . $rows, $total_female_count_under_18);
      $sheet->setCellValue('L' . $rows, $total_male_count_under_18);
      $rows++;
    } 
    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    
  }

  public function SD_Block_Wise_Download_Excel($district_id, $from_date, $to_date)
  {
    $this->validate_login(array('1', '5', '4', '2', '3','6'));
    // $district_id = base64_decode($district_id);
    $report_result = $this->CM_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
    $fileName = 'CM_Report_Block_Municipality_Wise';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2:F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G2:H2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I2:J2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K2:L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C2:D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E2:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G2:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I2:J2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K2:L2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


    $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('J')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('L')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(15);
    $sheet->getColumnDimension('E')->setWidth(15);
    $sheet->getColumnDimension('F')->setWidth(15);
    $sheet->getColumnDimension('G')->setWidth(15);
    $sheet->getColumnDimension('H')->setWidth(15);
    $sheet->getColumnDimension('I')->setWidth(15);
    $sheet->getColumnDimension('J')->setWidth(15);
    $sheet->getColumnDimension('K')->setWidth(15);
    $sheet->getColumnDimension('L')->setWidth(15);

    $sheet->mergeCells('A1:A2');
    $sheet->mergeCells('B1:B2');
    $sheet->mergeCells('C1:D1');
    $sheet->mergeCells('E1:F1');
    $sheet->mergeCells('G1:H1');
    $sheet->mergeCells('I1:J1');
    $sheet->mergeCells('K1:L1');

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'Block / Municipality');

    $sheet->setCellValue('C1', 'Before');
    $sheet->setCellValue('C2', 'Reported');
    $sheet->setCellValue('D2', 'Prevented');

    $sheet->setCellValue('E1', 'During');
    $sheet->setCellValue('E2', 'Reported');
    $sheet->setCellValue('F2', 'Prevented');

    $sheet->setCellValue('G1', 'After');
    $sheet->setCellValue('G2', 'Reported');
    $sheet->setCellValue('H2', 'Prevented');

    $sheet->setCellValue('I1', 'Totals');   
    $sheet->setCellValue('I2', 'Reported');
    $sheet->setCellValue('J2', 'Prevented');

    $sheet->setCellValue('K1', 'No. of minor involved');  
    $sheet->setCellValue('K2', 'Female');
    $sheet->setCellValue('L2', 'Male');             
    $rows = 3;
    $count = 1;
    foreach ($report_result as $value){
      $before_marriage_reported = $value['before_marriage_reported'];
      $before_marriage_prevented = $value['before_marriage_prevented'];

      $during_marriage_reported = $value['during_marriage_reported'];
      $during_marriage_prevented = $value['during_marriage_prevented'];

      $after_marriage_reported = $value['after_marriage_reported'];
      $after_marriage_prevented = $value['after_marriage_prevented'];

      $total_reported = $before_marriage_reported+$during_marriage_reported+$after_marriage_reported;

      $total_prevented = $before_marriage_prevented+$during_marriage_prevented+$after_marriage_prevented;

      if($value['before_marriage_reported'] != 0){ 
        $before_marriage_reported = $value['before_marriage_reported']; 
      } else { 
        $before_marriage_reported = "0"; 
      }

      if($value['before_marriage_prevented'] != 0){ 
        $before_marriage_prevented = $value['before_marriage_prevented']; 
      } else { 
        $before_marriage_prevented = "0"; 
      }

      if($value['during_marriage_reported'] != 0){ 
        $during_marriage_reported = $value['during_marriage_reported']; 
      } else { 
        $during_marriage_reported = "0"; 
      }

      if($value['during_marriage_prevented'] != 0){ 
        $during_marriage_prevented = $value['during_marriage_prevented']; 
      } else { 
        $during_marriage_prevented = "0"; 
      }

      if($value['after_marriage_reported'] != 0){ 
        $after_marriage_reported = $value['after_marriage_reported']; 
      } else { 
        $after_marriage_reported = "0"; 
      }

      if($value['after_marriage_prevented'] != 0){ 
        $after_marriage_prevented = $value['after_marriage_prevented']; 
      } else { 
        $after_marriage_prevented = "0"; 
      }

      if($value['total_female_count_under_18'] != 0){ 
        $total_female_count_under_18 = $value['total_female_count_under_18']; 
      } else { 
        $total_female_count_under_18 = "0"; 
      }

      if($value['total_male_count_under_18'] != 0){ 
        $total_male_count_under_18 = $value['total_male_count_under_18']; 
      } else { 
        $total_male_count_under_18 = "0"; 
      }

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['block_name']);

      $sheet->setCellValue('C' . $rows, $before_marriage_reported);
      $sheet->setCellValue('D' . $rows, $before_marriage_prevented);

      $sheet->setCellValue('E' . $rows, $during_marriage_reported);
      $sheet->setCellValue('F' . $rows, $during_marriage_prevented);

      $sheet->setCellValue('G' . $rows, $after_marriage_reported);
      $sheet->setCellValue('H' . $rows, $after_marriage_prevented);

      $sheet->setCellValue('I' . $rows, $total_reported);
      $sheet->setCellValue('J' . $rows, $total_prevented);

      $sheet->setCellValue('K' . $rows, $total_female_count_under_18);
      $sheet->setCellValue('L' . $rows, $total_male_count_under_18);
      $rows++;
    } 
    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }

  public function GP_Ward_Wise_Download_Excel($block_id, $from_date, $to_date)
  {
    $this->validate_login(array('1', '5', '4', '2', '3','6'));
    // $block_id = base64_decode($block_id);
    $report_result = $this->CM_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
    $fileName = 'CM_Report_Ward_GP_Wise';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2:F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G2:H2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I2:J2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K2:L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C2:D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E2:F2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G2:H2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I2:J2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K2:L2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


    $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('J')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('L')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(15);
    $sheet->getColumnDimension('E')->setWidth(15);
    $sheet->getColumnDimension('F')->setWidth(15);
    $sheet->getColumnDimension('G')->setWidth(15);
    $sheet->getColumnDimension('H')->setWidth(15);
    $sheet->getColumnDimension('I')->setWidth(15);
    $sheet->getColumnDimension('J')->setWidth(15);
    $sheet->getColumnDimension('K')->setWidth(15);
    $sheet->getColumnDimension('L')->setWidth(15);

    $sheet->mergeCells('A1:A2');
    $sheet->mergeCells('B1:B2');
    $sheet->mergeCells('C1:D1');
    $sheet->mergeCells('E1:F1');
    $sheet->mergeCells('G1:H1');
    $sheet->mergeCells('I1:J1');
    $sheet->mergeCells('K1:L1');

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'GP Name / Ward No');

    $sheet->setCellValue('C1', 'Before');
    $sheet->setCellValue('C2', 'Reported');
    $sheet->setCellValue('D2', 'Prevented');

    $sheet->setCellValue('E1', 'During');
    $sheet->setCellValue('E2', 'Reported');
    $sheet->setCellValue('F2', 'Prevented');

    $sheet->setCellValue('G1', 'After');
    $sheet->setCellValue('G2', 'Reported');
    $sheet->setCellValue('H2', 'Prevented');

    $sheet->setCellValue('I1', 'Totals');   
    $sheet->setCellValue('I2', 'Reported');
    $sheet->setCellValue('J2', 'Prevented');

    $sheet->setCellValue('K1', 'No. of minor involved');  
    $sheet->setCellValue('K2', 'Female');
    $sheet->setCellValue('L2', 'Male');             
    $rows = 3;
    $count = 1;
    foreach ($report_result as $value){
      $before_marriage_reported = $value['before_marriage_reported'];
      $before_marriage_prevented = $value['before_marriage_prevented'];

      $during_marriage_reported = $value['during_marriage_reported'];
      $during_marriage_prevented = $value['during_marriage_prevented'];

      $after_marriage_reported = $value['after_marriage_reported'];
      $after_marriage_prevented = $value['after_marriage_prevented'];

      $total_reported = $before_marriage_reported+$during_marriage_reported+$after_marriage_reported;

      $total_prevented = $before_marriage_prevented+$during_marriage_prevented+$after_marriage_prevented;

      if($value['before_marriage_reported'] != 0){ 
        $before_marriage_reported = $value['before_marriage_reported']; 
      } else { 
        $before_marriage_reported = "0"; 
      }

      if($value['before_marriage_prevented'] != 0){ 
        $before_marriage_prevented = $value['before_marriage_prevented']; 
      } else { 
        $before_marriage_prevented = "0"; 
      }

      if($value['during_marriage_reported'] != 0){ 
        $during_marriage_reported = $value['during_marriage_reported']; 
      } else { 
        $during_marriage_reported = "0"; 
      }

      if($value['during_marriage_prevented'] != 0){ 
        $during_marriage_prevented = $value['during_marriage_prevented']; 
      } else { 
        $during_marriage_prevented = "0"; 
      }

      if($value['after_marriage_reported'] != 0){ 
        $after_marriage_reported = $value['after_marriage_reported']; 
      } else { 
        $after_marriage_reported = "0"; 
      }

      if($value['after_marriage_prevented'] != 0){ 
        $after_marriage_prevented = $value['after_marriage_prevented']; 
      } else { 
        $after_marriage_prevented = "0"; 
      }

      if($value['total_female_count_under_18'] != 0){ 
        $total_female_count_under_18 = $value['total_female_count_under_18']; 
      } else { 
        $total_female_count_under_18 = "0"; 
      }

      if($value['total_male_count_under_18'] != 0){ 
        $total_male_count_under_18 = $value['total_male_count_under_18']; 
      } else { 
        $total_male_count_under_18 = "0"; 
      }

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['ward_gp_name']);

      $sheet->setCellValue('C' . $rows, $before_marriage_reported);
      $sheet->setCellValue('D' . $rows, $before_marriage_prevented);

      $sheet->setCellValue('E' . $rows, $during_marriage_reported);
      $sheet->setCellValue('F' . $rows, $during_marriage_prevented);

      $sheet->setCellValue('G' . $rows, $after_marriage_reported);
      $sheet->setCellValue('H' . $rows, $after_marriage_prevented);

      $sheet->setCellValue('I' . $rows, $total_reported);
      $sheet->setCellValue('J' . $rows, $total_prevented);

      $sheet->setCellValue('K' . $rows, $total_female_count_under_18);
      $sheet->setCellValue('L' . $rows, $total_male_count_under_18);
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
}
