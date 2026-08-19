<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Age_wise_minors_involved_view extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('mis/Age_wise_minor_involved_model');
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
       $report_result = $this->Age_wise_minor_involved_model->age_wise_minor_involved_details_district_count($from_date, $to_date);
       $data['report_result'] = $report_result;
     }
     $this->load->view($this->config->item('theme').'mis/age_wise_minors_involved/age_wise_minors_involved_view', $data);
  }

  public function sd_block($district_id, $from_date, $to_date)
  {
      $this->validate_login(array('1','5', '4', '2', '3','6'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $report_result = $this->Age_wise_minor_involved_model->get_sd_block_count_details($district_id, $from_date, $to_date);
     $data['report_result'] = $report_result;
     $data['from_date'] = $from_date;
     $data['to_date'] = $to_date;
     $data['district_id'] = $district_id;
     $this->load->view($this->config->item('theme').'mis/age_wise_minors_involved/age_wise_minors_involved_view_sd_block', $data);
  }
  
  public function ward_gp($block_id, $from_date, $to_date)
  {
      $this->validate_login(array('1','5', '4', '2', '3','6'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $report_result = $this->Age_wise_minor_involved_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
     $data['report_result'] = $report_result;
     $data['from_date'] = $from_date;
     $data['to_date'] = $to_date;
     $data['block_id'] = $block_id;
     $this->load->view($this->config->item('theme').'mis/age_wise_minors_involved/age_wise_minors_involved_view_ward_gp', $data);
  }

  public function District_Wise_Download_Excel($from_date, $to_date)
  {
     $this->validate_login(array('1','5', '4', '2', '3','6'));
    $fileName = 'Age_Wise_Minor_Involved_Report_District_Wise';
    $report_result = $this->Age_wise_minor_involved_model->age_wise_minor_involved_details_district_count($from_date, $to_date);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1:C3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D1:D3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E1:E3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F1:F3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G1:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H1:H3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I1:I3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J1:J3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K1:K3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('L1:L3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('M1:M3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('N1:N3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('O1:O3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('P1:P3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('Q1:Q3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('R1:R3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

    $sheet->getStyle('B1:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C4:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G4:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I4:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K4:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('M4:N4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('O4:P4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('Q1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('Q4:R4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');



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
    $sheet->getStyle('M1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('M2:N2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('O1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('O2:P2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('Q1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('Q2:R2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


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
    $sheet->getStyle('M')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('N')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('O')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('P')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('Q')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('R')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(10);
    $sheet->getColumnDimension('D')->setWidth(10);
    $sheet->getColumnDimension('E')->setWidth(10);
    $sheet->getColumnDimension('F')->setWidth(10);
    $sheet->getColumnDimension('G')->setWidth(10);
    $sheet->getColumnDimension('H')->setWidth(10);
    $sheet->getColumnDimension('I')->setWidth(10);
    $sheet->getColumnDimension('J')->setWidth(10);
    $sheet->getColumnDimension('K')->setWidth(10);
    $sheet->getColumnDimension('L')->setWidth(10);
    $sheet->getColumnDimension('M')->setWidth(10);
    $sheet->getColumnDimension('N')->setWidth(10);
    $sheet->getColumnDimension('O')->setWidth(10);
    $sheet->getColumnDimension('P')->setWidth(10);
    $sheet->getColumnDimension('Q')->setWidth(10);
    $sheet->getColumnDimension('R')->setWidth(10);

    // $sheet->mergeCells('A1:A2');
    // $sheet->mergeCells('B1:B2');
    $sheet->mergeCells('C3:D3');
    $sheet->mergeCells('E3:F3');
    $sheet->mergeCells('G3:H3');
    $sheet->mergeCells('I3:J3');
    $sheet->mergeCells('K3:L3');
    $sheet->mergeCells('M3:N3');
    $sheet->mergeCells('O3:P3');
    $sheet->mergeCells('Q3:R3');
    $sheet->mergeCells('A1:R1');
    $sheet->getStyle('A1:R1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

    $sheet->setCellValue('A1', 'Age Wise Minors Involved Report - District Wise');

    $sheet->setCellValue('A2', 'From date:');
    $sheet->setCellValue('B2', $from_date);
    $sheet->setCellValue('C2', '-');
    $sheet->setCellValue('D2', 'To date:');
    $sheet->setCellValue('E2', $to_date);
    //   $sheet->setCellValue('Q2', 'District name:');
    // $sheet->setCellValue('R2', 'Nadia');
    $sheet->setCellValue('A4', 'Sl. No');
    $sheet->setCellValue('B4', 'Jurisdiction');

    $sheet->setCellValue('C3', '< 12 Yrs');
    $sheet->setCellValue('C4', 'F');
    $sheet->setCellValue('D4', 'M');

    $sheet->setCellValue('E3', '12-13 Yrs');
    $sheet->setCellValue('E4', 'F');
    $sheet->setCellValue('F4', 'M');

    $sheet->setCellValue('G3', '13-14 Yrs');
    $sheet->setCellValue('G4', 'F');
    $sheet->setCellValue('H4', 'M');

    $sheet->setCellValue('I3', '14-15 Yrs');
    $sheet->setCellValue('I4', 'F');
    $sheet->setCellValue('J4', 'M');

    $sheet->setCellValue('K3', '15-16 Yrs');
    $sheet->setCellValue('K4', 'F');
    $sheet->setCellValue('L4', 'M');

    $sheet->setCellValue('M3', '16-17 Yrs');
    $sheet->setCellValue('M4', 'F');
    $sheet->setCellValue('N4', 'M');

    $sheet->setCellValue('O3', '17-18 Yrs');
    $sheet->setCellValue('O4', 'F');
    $sheet->setCellValue('P4', 'M');

    $sheet->setCellValue('Q3', 'Totals');
    $sheet->setCellValue('Q4', 'F');
    $sheet->setCellValue('R4', 'M');

    $rows = 5;
    $count = 1;
    foreach ($report_result as $value){

      if($value['female_count_under_12'] != 0){ 
        $female_count_under_12 = $value['female_count_under_12']; 
      } else { 
        $female_count_under_12 = "0"; 
      }

      if($value['male_count_under_12'] != 0){ 
        $male_count_under_12 = $value['male_count_under_12']; 
      } else { 
        $male_count_under_12 = "0"; 
      }

      if($value['female_count_12_13'] != 0){ 
        $female_count_12_13 = $value['female_count_12_13']; 
      } else { 
        $female_count_12_13 = "0"; 
      }

      if($value['male_count_12_13'] != 0){ 
        $male_count_12_13 = $value['male_count_12_13']; 
      } else { 
        $male_count_12_13 = "0"; 
      }

      if($value['female_count_13_14'] != 0){ 
        $female_count_13_14 = $value['female_count_13_14']; 
      } else { 
        $female_count_13_14 = "0"; 
      }

      if($value['male_count_13_14'] != 0){ 
        $male_count_13_14 = $value['male_count_13_14']; 
      } else { 
        $male_count_13_14 = "0"; 
      }

      if($value['female_count_14_15'] != 0){ 
        $female_count_14_15 = $value['female_count_14_15']; 
      } else { 
        $female_count_14_15 = "0"; 
      }

      if($value['male_count_14_15'] != 0){ 
        $male_count_14_15 = $value['male_count_14_15']; 
      } else { 
        $male_count_14_15 = "0"; 
      }

      if($value['female_count_15_16'] != 0){ 
        $female_count_15_16 = $value['female_count_15_16']; 
      } else { 
        $female_count_15_16 = "0"; 
      }

      if($value['male_count_15_16'] != 0){ 
        $male_count_15_16 = $value['male_count_15_16']; 
      } else { 
        $male_count_15_16 = "0"; 
      }

      if($value['female_count_16_17'] != 0){ 
        $female_count_16_17 = $value['female_count_16_17']; 
      } else { 
        $female_count_16_17 = "0"; 
      }

      if($value['male_count_16_17'] != 0){ 
        $male_count_16_17 = $value['male_count_16_17']; 
      } else { 
        $male_count_16_17 = "0"; 
      }

      if($value['female_count_17_18'] != 0){ 
        $female_count_17_18 = $value['female_count_17_18']; 
      } else { 
        $female_count_17_18 = "0"; 
      }

      if($value['male_count_17_18'] != 0){ 
        $male_count_17_18 = $value['male_count_17_18']; 
      } else { 
        $male_count_17_18 = "0"; 
      }

      $total_female_count = $value['female_count_under_12']+$value['female_count_12_13']+$value['female_count_13_14']+$value['female_count_14_15']+$value['female_count_15_16']+$value['female_count_16_17']+$value['female_count_17_18'];

      $total_male_count = $value['male_count_under_12']+$value['male_count_12_13']+$value['male_count_13_14']+$value['male_count_14_15']+$value['male_count_15_16']+$value['male_count_16_17']+$value['male_count_17_18'];

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['district_name']);

      $sheet->setCellValue('C' . $rows, $female_count_under_12);
      $sheet->setCellValue('D' . $rows, $male_count_under_12);

      $sheet->setCellValue('E' . $rows, $female_count_12_13);
      $sheet->setCellValue('F' . $rows, $male_count_12_13);

      $sheet->setCellValue('G' . $rows, $female_count_13_14);
      $sheet->setCellValue('H' . $rows, $male_count_13_14);

      $sheet->setCellValue('I' . $rows, $female_count_14_15);
      $sheet->setCellValue('J' . $rows, $male_count_14_15);

      $sheet->setCellValue('K' . $rows, $female_count_15_16);
      $sheet->setCellValue('L' . $rows, $male_count_15_16);

      $sheet->setCellValue('M' . $rows, $female_count_16_17);
      $sheet->setCellValue('N' . $rows, $male_count_16_17);

      $sheet->setCellValue('O' . $rows, $female_count_17_18);
      $sheet->setCellValue('P' . $rows, $male_count_17_18);

      $sheet->setCellValue('Q' . $rows, $total_female_count);
      $sheet->setCellValue('R' . $rows, $total_male_count);
      $rows++;
    }
    //SHOW TOTAL 
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'R'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'R'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'female_count_under_12')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'male_count_under_12')));

      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'female_count_12_13')));
      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'male_count_12_13')));

      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'female_count_13_14')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'male_count_13_14')));

      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'female_count_14_15')));
      $sheet->setCellValue('J' . $total_row,array_sum(array_column($report_result, 'male_count_14_15')));

      $sheet->setCellValue('K' . $total_row,array_sum(array_column($report_result, 'female_count_15_16')));
      $sheet->setCellValue('L' . $total_row,array_sum(array_column($report_result, 'male_count_15_16')));

      $sheet->setCellValue('M' . $total_row,array_sum(array_column($report_result, 'female_count_16_17')));
      $sheet->setCellValue('N' . $total_row,array_sum(array_column($report_result, 'male_count_16_17')));

      $sheet->setCellValue('O' . $total_row,array_sum(array_column($report_result, 'female_count_17_18')));
      $sheet->setCellValue('P' . $total_row,array_sum(array_column($report_result, 'male_count_17_18')));

      $sheet->setCellValue('Q' . $total_row,array_sum(array_column($report_result, 'female_count_under_12')) + 
                                            array_sum(array_column($report_result, 'female_count_12_13')) + 
                                            array_sum(array_column($report_result, 'female_count_13_14')) + 
                                            array_sum(array_column($report_result, 'female_count_14_15')) + 
                                            array_sum(array_column($report_result, 'female_count_15_16')) + 
                                            array_sum(array_column($report_result, 'female_count_16_17')) + 
                                            array_sum(array_column($report_result, 'female_count_17_18')));

      $sheet->setCellValue('R' . $total_row,array_sum(array_column($report_result, 'male_count_under_12')) + 
                                            array_sum(array_column($report_result, 'male_count_12_13')) + 
                                            array_sum(array_column($report_result, 'male_count_13_14')) + 
                                            array_sum(array_column($report_result, 'male_count_14_15')) + 
                                            array_sum(array_column($report_result, 'male_count_15_16')) + 
                                            array_sum(array_column($report_result, 'male_count_16_17')) + 
                                            array_sum(array_column($report_result, 'male_count_17_18')));

    }

    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }

  public function SD_Block_Wise_Download_Excel($district_id, $from_date, $to_date)
  {
    $this->validate_login(array('1','5', '4', '2', '3','6'));
    // $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    // $district_id = $uriSegments[7];
    $data['district'] = $this->Master_model->get_district_name($district_id);
    // echo '<pre>';print_r($data);
    // echo  $data['district']->district_name;die;
    
    $report_result = $this->Age_wise_minor_involved_model->get_sd_block_count_details($district_id, $from_date, $to_date);
    $district_result = $this->Age_wise_minor_involved_model->get_sd_block_count_details($district_id, $from_date, $to_date);
    $fileName = 'Age_Wise_Minor_Involved_Report_Block_Municipality_Wise';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1:C3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D1:D3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E1:E3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F1:F3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G1:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H1:H3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I1:I3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J1:J3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K1:K3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('L1:L3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('M1:M3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('N1:N3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('O1:O3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('P1:P3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('Q1:Q3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('R1:R3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

    $sheet->getStyle('B1:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C4:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G4:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I4:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K4:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('M4:N4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('O4:P4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('Q1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('Q4:R4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');



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
    $sheet->getStyle('M1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('M2:N2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('O1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('O2:P2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('Q1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('Q2:R2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


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
    $sheet->getStyle('M')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('N')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('O')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('P')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('Q')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('R')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(10);
    $sheet->getColumnDimension('D')->setWidth(10);
    $sheet->getColumnDimension('E')->setWidth(10);
    $sheet->getColumnDimension('F')->setWidth(10);
    $sheet->getColumnDimension('G')->setWidth(10);
    $sheet->getColumnDimension('H')->setWidth(10);
    $sheet->getColumnDimension('I')->setWidth(10);
    $sheet->getColumnDimension('J')->setWidth(10);
    $sheet->getColumnDimension('K')->setWidth(10);
    $sheet->getColumnDimension('L')->setWidth(10);
    $sheet->getColumnDimension('M')->setWidth(10);
    $sheet->getColumnDimension('N')->setWidth(10);
    $sheet->getColumnDimension('O')->setWidth(10);
    $sheet->getColumnDimension('P')->setWidth(10);
    $sheet->getColumnDimension('Q')->setWidth(10);
    $sheet->getColumnDimension('R')->setWidth(10);

    // $sheet->mergeCells('A1:A2');
    // $sheet->mergeCells('B1:B2');
    $sheet->mergeCells('C3:D3');
    $sheet->mergeCells('E3:F3');
    $sheet->mergeCells('G3:H3');
    $sheet->mergeCells('I3:J3');
    $sheet->mergeCells('K3:L3');
    $sheet->mergeCells('M3:N3');
    $sheet->mergeCells('O3:P3');
    $sheet->mergeCells('Q3:R3');
    $sheet->mergeCells('A1:R1');
    $sheet->mergeCells('Q2:R2');
    $sheet->getStyle('A1:R1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

    $sheet->setCellValue('A1', 'Age Wise Minors Involved Report - District Wise');

    $sheet->setCellValue('A2', 'From date:');
    $sheet->setCellValue('B2', $from_date);
    $sheet->setCellValue('C2', '-');
    $sheet->setCellValue('D2', 'To date:');
    $sheet->setCellValue('E2', $to_date);
    $sheet->setCellValue('P2', 'District name');
    $sheet->setCellValue('Q2', $data['district']->district_name);
    $sheet->setCellValue('A4', 'Sl. No');
    $sheet->setCellValue('B4', 'Jurisdiction');

    $sheet->setCellValue('C3', '< 12 Yrs');
    $sheet->setCellValue('C4', 'F');
    $sheet->setCellValue('D4', 'M');

    $sheet->setCellValue('E3', '12-13 Yrs');
    $sheet->setCellValue('E4', 'F');
    $sheet->setCellValue('F4', 'M');

    $sheet->setCellValue('G3', '13-14 Yrs');
    $sheet->setCellValue('G4', 'F');
    $sheet->setCellValue('H4', 'M');

    $sheet->setCellValue('I3', '14-15 Yrs');
    $sheet->setCellValue('I4', 'F');
    $sheet->setCellValue('J4', 'M');

    $sheet->setCellValue('K3', '15-16 Yrs');
    $sheet->setCellValue('K4', 'F');
    $sheet->setCellValue('L4', 'M');

    $sheet->setCellValue('M3', '16-17 Yrs');
    $sheet->setCellValue('M4', 'F');
    $sheet->setCellValue('N4', 'M');

    $sheet->setCellValue('O3', '17-18 Yrs');
    $sheet->setCellValue('O4', 'F');
    $sheet->setCellValue('P4', 'M');

    $sheet->setCellValue('Q3', 'Totals');
    $sheet->setCellValue('Q4', 'F');
    $sheet->setCellValue('R4', 'M');

    $rows = 5;
    $count = 1;
    foreach ($report_result as $value){

      if($value['female_count_under_12'] != 0){ 
        $female_count_under_12 = $value['female_count_under_12']; 
      } else { 
        $female_count_under_12 = "0"; 
      }

      if($value['male_count_under_12'] != 0){ 
        $male_count_under_12 = $value['male_count_under_12']; 
      } else { 
        $male_count_under_12 = "0"; 
      }

      if($value['female_count_12_13'] != 0){ 
        $female_count_12_13 = $value['female_count_12_13']; 
      } else { 
        $female_count_12_13 = "0"; 
      }

      if($value['male_count_12_13'] != 0){ 
        $male_count_12_13 = $value['male_count_12_13']; 
      } else { 
        $male_count_12_13 = "0"; 
      }

      if($value['female_count_13_14'] != 0){ 
        $female_count_13_14 = $value['female_count_13_14']; 
      } else { 
        $female_count_13_14 = "0"; 
      }

      if($value['male_count_13_14'] != 0){ 
        $male_count_13_14 = $value['male_count_13_14']; 
      } else { 
        $male_count_13_14 = "0"; 
      }

      if($value['female_count_14_15'] != 0){ 
        $female_count_14_15 = $value['female_count_14_15']; 
      } else { 
        $female_count_14_15 = "0"; 
      }

      if($value['male_count_14_15'] != 0){ 
        $male_count_14_15 = $value['male_count_14_15']; 
      } else { 
        $male_count_14_15 = "0"; 
      }

      if($value['female_count_15_16'] != 0){ 
        $female_count_15_16 = $value['female_count_15_16']; 
      } else { 
        $female_count_15_16 = "0"; 
      }

      if($value['male_count_15_16'] != 0){ 
        $male_count_15_16 = $value['male_count_15_16']; 
      } else { 
        $male_count_15_16 = "0"; 
      }

      if($value['female_count_16_17'] != 0){ 
        $female_count_16_17 = $value['female_count_16_17']; 
      } else { 
        $female_count_16_17 = "0"; 
      }

      if($value['male_count_16_17'] != 0){ 
        $male_count_16_17 = $value['male_count_16_17']; 
      } else { 
        $male_count_16_17 = "0"; 
      }

      if($value['female_count_17_18'] != 0){ 
        $female_count_17_18 = $value['female_count_17_18']; 
      } else { 
        $female_count_17_18 = "0"; 
      }

      if($value['male_count_17_18'] != 0){ 
        $male_count_17_18 = $value['male_count_17_18']; 
      } else { 
        $male_count_17_18 = "0"; 
      }

      $total_female_count = $value['female_count_under_12']+$value['female_count_12_13']+$value['female_count_13_14']+$value['female_count_14_15']+$value['female_count_15_16']+$value['female_count_16_17']+$value['female_count_17_18'];

      $total_male_count = $value['male_count_under_12']+$value['male_count_12_13']+$value['male_count_13_14']+$value['male_count_14_15']+$value['male_count_15_16']+$value['male_count_16_17']+$value['male_count_17_18'];

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['block_name']);

      $sheet->setCellValue('C' . $rows, $female_count_under_12);
      $sheet->setCellValue('D' . $rows, $male_count_under_12);

      $sheet->setCellValue('E' . $rows, $female_count_12_13);
      $sheet->setCellValue('F' . $rows, $male_count_12_13);

      $sheet->setCellValue('G' . $rows, $female_count_13_14);
      $sheet->setCellValue('H' . $rows, $male_count_13_14);

      $sheet->setCellValue('I' . $rows, $female_count_14_15);
      $sheet->setCellValue('J' . $rows, $male_count_14_15);

      $sheet->setCellValue('K' . $rows, $female_count_15_16);
      $sheet->setCellValue('L' . $rows, $male_count_15_16);

      $sheet->setCellValue('M' . $rows, $female_count_16_17);
      $sheet->setCellValue('N' . $rows, $male_count_16_17);

      $sheet->setCellValue('O' . $rows, $female_count_17_18);
      $sheet->setCellValue('P' . $rows, $male_count_17_18);

      $sheet->setCellValue('Q' . $rows, $total_female_count);
      $sheet->setCellValue('R' . $rows, $total_male_count);
      $rows++;
    } 

    // TOTAL
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'R'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'R'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'female_count_under_12')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'male_count_under_12')));

      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'female_count_12_13')));
      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'male_count_12_13')));

      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'female_count_13_14')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'male_count_13_14')));

      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'female_count_14_15')));
      $sheet->setCellValue('J' . $total_row,array_sum(array_column($report_result, 'male_count_14_15')));

      $sheet->setCellValue('K' . $total_row,array_sum(array_column($report_result, 'female_count_15_16')));
      $sheet->setCellValue('L' . $total_row,array_sum(array_column($report_result, 'male_count_15_16')));

      $sheet->setCellValue('M' . $total_row,array_sum(array_column($report_result, 'female_count_16_17')));
      $sheet->setCellValue('N' . $total_row,array_sum(array_column($report_result, 'male_count_16_17')));

      $sheet->setCellValue('O' . $total_row,array_sum(array_column($report_result, 'female_count_17_18')));
      $sheet->setCellValue('P' . $total_row,array_sum(array_column($report_result, 'male_count_17_18')));

      $sheet->setCellValue('Q' . $total_row,array_sum(array_column($report_result, 'female_count_under_12')) + 
                                            array_sum(array_column($report_result, 'female_count_12_13')) + 
                                            array_sum(array_column($report_result, 'female_count_13_14')) + 
                                            array_sum(array_column($report_result, 'female_count_14_15')) + 
                                            array_sum(array_column($report_result, 'female_count_15_16')) + 
                                            array_sum(array_column($report_result, 'female_count_16_17')) + 
                                            array_sum(array_column($report_result, 'female_count_17_18')));

      $sheet->setCellValue('R' . $total_row,array_sum(array_column($report_result, 'male_count_under_12')) + 
                                            array_sum(array_column($report_result, 'male_count_12_13')) + 
                                            array_sum(array_column($report_result, 'male_count_13_14')) + 
                                            array_sum(array_column($report_result, 'male_count_14_15')) + 
                                            array_sum(array_column($report_result, 'male_count_15_16')) + 
                                            array_sum(array_column($report_result, 'male_count_16_17')) + 
                                            array_sum(array_column($report_result, 'male_count_17_18')));

    }
    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }

  public function GP_Ward_Wise_Download_Excel($block_id, $from_date, $to_date)
  {
    $this->validate_login(array('1','5', '4', '2', '3','6'));
    $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    $data['block_id'] = $uriSegments[7];
    $result_block_dist = $this->Master_model->get_dist_by_block($data);
    // echo'<pre>';print_r($result_block_dist);die;
    $report_result = $this->Age_wise_minor_involved_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
    $fileName = 'Age_Wise_Minor_Involved_Report_Ward_GP_Wise';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1:C3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D1:D3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E1:E3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F1:F3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G1:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H1:H3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I1:I3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J1:J3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K1:K3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('L1:L3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('M1:M3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('N1:N3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('O1:O3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('P1:P3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('Q1:Q3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('R1:R3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

    $sheet->getStyle('B1:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C4:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G4:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I4:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K4:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('M4:N4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('O1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('O4:P4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('Q1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('Q4:R4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');



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
    $sheet->getStyle('M1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('M2:N2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('O1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('O2:P2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('Q1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('Q2:R2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


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
    $sheet->getStyle('M')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('N')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('O')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('P')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('Q')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('R')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(10);
    $sheet->getColumnDimension('D')->setWidth(10);
    $sheet->getColumnDimension('E')->setWidth(10);
    $sheet->getColumnDimension('F')->setWidth(10);
    $sheet->getColumnDimension('G')->setWidth(10);
    $sheet->getColumnDimension('H')->setWidth(10);
    $sheet->getColumnDimension('I')->setWidth(10);
    $sheet->getColumnDimension('J')->setWidth(10);
    $sheet->getColumnDimension('K')->setWidth(10);
    $sheet->getColumnDimension('L')->setWidth(10);
    $sheet->getColumnDimension('M')->setWidth(10);
    $sheet->getColumnDimension('N')->setWidth(10);
    $sheet->getColumnDimension('O')->setWidth(10);
    $sheet->getColumnDimension('P')->setWidth(10);
    $sheet->getColumnDimension('Q')->setWidth(10);
    $sheet->getColumnDimension('R')->setWidth(10);

    // $sheet->mergeCells('A1:A2');
    // $sheet->mergeCells('B1:B2');
    $sheet->mergeCells('C3:D3');
    $sheet->mergeCells('E3:F3');
    $sheet->mergeCells('G3:H3');
    $sheet->mergeCells('I3:J3');
    $sheet->mergeCells('K3:L3');
    $sheet->mergeCells('M3:N3');
    $sheet->mergeCells('O3:P3');
    $sheet->mergeCells('Q3:R3');
    $sheet->mergeCells('A1:R1');
    $sheet->mergeCells('Q2:R2');
    $sheet->getStyle('A1:R1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

    $sheet->setCellValue('A1', 'Age Wise Minors Involved Report - District Wise');

    $sheet->setCellValue('A2', 'From date:');
    $sheet->setCellValue('B2', $from_date);
    $sheet->setCellValue('C2', '-');
    $sheet->setCellValue('D2', 'To date:');
    $sheet->setCellValue('E2', $to_date);
    $sheet->setCellValue('P2', 'District name');
    $sheet->setCellValue('Q2', $result_block_dist['district_name']);
    $sheet->setCellValue('A4', 'Sl. No');
    $sheet->setCellValue('B4', 'Jurisdiction');

    $sheet->setCellValue('C3', '< 12 Yrs');
    $sheet->setCellValue('C4', 'F');
    $sheet->setCellValue('D4', 'M');

    $sheet->setCellValue('E3', '12-13 Yrs');
    $sheet->setCellValue('E4', 'F');
    $sheet->setCellValue('F4', 'M');

    $sheet->setCellValue('G3', '13-14 Yrs');
    $sheet->setCellValue('G4', 'F');
    $sheet->setCellValue('H4', 'M');

    $sheet->setCellValue('I3', '14-15 Yrs');
    $sheet->setCellValue('I4', 'F');
    $sheet->setCellValue('J4', 'M');

    $sheet->setCellValue('K3', '15-16 Yrs');
    $sheet->setCellValue('K4', 'F');
    $sheet->setCellValue('L4', 'M');

    $sheet->setCellValue('M3', '16-17 Yrs');
    $sheet->setCellValue('M4', 'F');
    $sheet->setCellValue('N4', 'M');

    $sheet->setCellValue('O3', '17-18 Yrs');
    $sheet->setCellValue('O4', 'F');
    $sheet->setCellValue('P4', 'M');

    $sheet->setCellValue('Q3', 'Totals');
    $sheet->setCellValue('Q4', 'F');
    $sheet->setCellValue('R4', 'M');

    $rows = 5;
    $count = 1;
    foreach ($report_result as $value){

      if($value['female_count_under_12'] != 0){ 
        $female_count_under_12 = $value['female_count_under_12']; 
      } else { 
        $female_count_under_12 = "0"; 
      }

      if($value['male_count_under_12'] != 0){ 
        $male_count_under_12 = $value['male_count_under_12']; 
      } else { 
        $male_count_under_12 = "0"; 
      }

      if($value['female_count_12_13'] != 0){ 
        $female_count_12_13 = $value['female_count_12_13']; 
      } else { 
        $female_count_12_13 = "0"; 
      }

      if($value['male_count_12_13'] != 0){ 
        $male_count_12_13 = $value['male_count_12_13']; 
      } else { 
        $male_count_12_13 = "0"; 
      }

      if($value['female_count_13_14'] != 0){ 
        $female_count_13_14 = $value['female_count_13_14']; 
      } else { 
        $female_count_13_14 = "0"; 
      }

      if($value['male_count_13_14'] != 0){ 
        $male_count_13_14 = $value['male_count_13_14']; 
      } else { 
        $male_count_13_14 = "0"; 
      }

      if($value['female_count_14_15'] != 0){ 
        $female_count_14_15 = $value['female_count_14_15']; 
      } else { 
        $female_count_14_15 = "0"; 
      }

      if($value['male_count_14_15'] != 0){ 
        $male_count_14_15 = $value['male_count_14_15']; 
      } else { 
        $male_count_14_15 = "0"; 
      }

      if($value['female_count_15_16'] != 0){ 
        $female_count_15_16 = $value['female_count_15_16']; 
      } else { 
        $female_count_15_16 = "0"; 
      }

      if($value['male_count_15_16'] != 0){ 
        $male_count_15_16 = $value['male_count_15_16']; 
      } else { 
        $male_count_15_16 = "0"; 
      }

      if($value['female_count_16_17'] != 0){ 
        $female_count_16_17 = $value['female_count_16_17']; 
      } else { 
        $female_count_16_17 = "0"; 
      }

      if($value['male_count_16_17'] != 0){ 
        $male_count_16_17 = $value['male_count_16_17']; 
      } else { 
        $male_count_16_17 = "0"; 
      }

      if($value['female_count_17_18'] != 0){ 
        $female_count_17_18 = $value['female_count_17_18']; 
      } else { 
        $female_count_17_18 = "0"; 
      }

      if($value['male_count_17_18'] != 0){ 
        $male_count_17_18 = $value['male_count_17_18']; 
      } else { 
        $male_count_17_18 = "0"; 
      }

      $total_female_count = $value['female_count_under_12']+$value['female_count_12_13']+$value['female_count_13_14']+$value['female_count_14_15']+$value['female_count_15_16']+$value['female_count_16_17']+$value['female_count_17_18'];

      $total_male_count = $value['male_count_under_12']+$value['male_count_12_13']+$value['male_count_13_14']+$value['male_count_14_15']+$value['male_count_15_16']+$value['male_count_16_17']+$value['male_count_17_18'];

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['ward_gp_name']);

      $sheet->setCellValue('C' . $rows, $female_count_under_12);
      $sheet->setCellValue('D' . $rows, $male_count_under_12);

      $sheet->setCellValue('E' . $rows, $female_count_12_13);
      $sheet->setCellValue('F' . $rows, $male_count_12_13);

      $sheet->setCellValue('G' . $rows, $female_count_13_14);
      $sheet->setCellValue('H' . $rows, $male_count_13_14);

      $sheet->setCellValue('I' . $rows, $female_count_14_15);
      $sheet->setCellValue('J' . $rows, $male_count_14_15);

      $sheet->setCellValue('K' . $rows, $female_count_15_16);
      $sheet->setCellValue('L' . $rows, $male_count_15_16);

      $sheet->setCellValue('M' . $rows, $female_count_16_17);
      $sheet->setCellValue('N' . $rows, $male_count_16_17);

      $sheet->setCellValue('O' . $rows, $female_count_17_18);
      $sheet->setCellValue('P' . $rows, $male_count_17_18);

      $sheet->setCellValue('Q' . $rows, $total_female_count);
      $sheet->setCellValue('R' . $rows, $total_male_count);
      $rows++;
    } 

    // TOTAL
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'R'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'R'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'female_count_under_12')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'male_count_under_12')));

      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'female_count_12_13')));
      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'male_count_12_13')));

      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'female_count_13_14')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'male_count_13_14')));

      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'female_count_14_15')));
      $sheet->setCellValue('J' . $total_row,array_sum(array_column($report_result, 'male_count_14_15')));

      $sheet->setCellValue('K' . $total_row,array_sum(array_column($report_result, 'female_count_15_16')));
      $sheet->setCellValue('L' . $total_row,array_sum(array_column($report_result, 'male_count_15_16')));

      $sheet->setCellValue('M' . $total_row,array_sum(array_column($report_result, 'female_count_16_17')));
      $sheet->setCellValue('N' . $total_row,array_sum(array_column($report_result, 'male_count_16_17')));

      $sheet->setCellValue('O' . $total_row,array_sum(array_column($report_result, 'female_count_17_18')));
      $sheet->setCellValue('P' . $total_row,array_sum(array_column($report_result, 'male_count_17_18')));

      $sheet->setCellValue('Q' . $total_row,array_sum(array_column($report_result, 'female_count_under_12')) + 
                                            array_sum(array_column($report_result, 'female_count_12_13')) + 
                                            array_sum(array_column($report_result, 'female_count_13_14')) + 
                                            array_sum(array_column($report_result, 'female_count_14_15')) + 
                                            array_sum(array_column($report_result, 'female_count_15_16')) + 
                                            array_sum(array_column($report_result, 'female_count_16_17')) + 
                                            array_sum(array_column($report_result, 'female_count_17_18')));

      $sheet->setCellValue('R' . $total_row,array_sum(array_column($report_result, 'male_count_under_12')) + 
                                            array_sum(array_column($report_result, 'male_count_12_13')) + 
                                            array_sum(array_column($report_result, 'male_count_13_14')) + 
                                            array_sum(array_column($report_result, 'male_count_14_15')) + 
                                            array_sum(array_column($report_result, 'male_count_15_16')) + 
                                            array_sum(array_column($report_result, 'male_count_16_17')) + 
                                            array_sum(array_column($report_result, 'male_count_17_18')));

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
