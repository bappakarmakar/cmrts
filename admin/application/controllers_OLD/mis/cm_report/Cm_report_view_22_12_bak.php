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
    $data['from_date_show'] =  '';
    $data['to_date_show'] = '';
      if($this->input->post('from_date')!='' && $this->input->post('to_date')!='')
      {
        $data['from_date_show']= $this->input->post('from_date');
        $data['to_date_show']= $this->input->post('to_date');
        // echo $data['from_date_show'].'----------------- '.$data['to_date_show'];die;
      }
     $this->validate_login(array('1', '5', '4', '2', '3','6'));
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
       $data['force_view'] = 0;
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == TRUE) {
       $from_date = $this->us_date_format($this->input->post('from_date'));
       $to_date = $this->us_date_format($this->input->post('to_date'));
       $report_result = $this->CM_report_model->cm_report($from_date, $to_date);
       $data['report_result'] = $report_result;
    }
    if ($this->input->get('from_date')) {
       $_POST['from_date'] = $data['from_date'] = $from_date = $this->input->get('from_date');
       $_POST['to_date'] = $data['to_date'] = $to_date = $this->input->get('to_date');
       $report_result = $this->CM_report_model->cm_report($from_date, $to_date);
       $data['report_result'] = $report_result;
       $data['force_view'] = 1;
       // echo "<pre>";print_r($data);die;
    }
    $this->load->view($this->config->item('theme').'mis/cm_report/cm_report_form_view_district', $data);
  }

  public function block_wise($district_id, $from_date, $to_date)
  {
     $this->validate_login(array('1', '5', '4', '2', '3','6'));
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

    // echo $from_date."--------".$to_date;echo'<br>';
    // echo $this->convert_date_format($from_date);echo'<br>';
    // echo $this->convert_date_format($to_date);
    // die;
    // echo $this->session->userdata('district');die;
    if($this->session->userdata('district')!='')
    {
      $incident_district = $this->Master_model->get_district_name($this->session->userdata('district'));
      $data['user_dist']="INTERVENTION UNDERTAKEN REPORT DISTRICT NAME - ".$incident_district->district_name;
    }
    else
    {
      $data['user_dist'] = "INTERVENTION UNDERTAKEN REPORT DISTRICT WISE";
    }
    // print_r($data['district']);die;

    $fileName = 'INTERVENTION_UNDERTAKEN_REPORT_DISTRICT';
    $report_result = $this->CM_report_model->cm_report($from_date, $to_date);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

      $sheet->getStyle('A2:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B2:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C4:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G4:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('I3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I4:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('K3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K4:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
       $sheet->getStyle('J2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
          $sheet->getStyle('K2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
       $sheet->getStyle('L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
        $sheet->getStyle('A1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
        $sheet->getStyle('A1:L1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

    $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C3:D3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E3:F3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G3:H3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K3:L3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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

    // $sheet->mergeCells('A1:A3');
    // $sheet->mergeCells('B2:B3');
    $sheet->mergeCells('C3:D3');
    $sheet->mergeCells('E3:F3');
    $sheet->mergeCells('G3:H3');
    $sheet->mergeCells('I3:J3');
    $sheet->mergeCells('K3:L3');

    $sheet->setCellValue('A2', 'From date :');
    $sheet->setCellValue('B2', $this->convert_date_format($from_date));

    $sheet->setCellValue('C2', '-:-');

    $sheet->setCellValue('D2', 'To date :');
    $sheet->setCellValue('E2', $this->convert_date_format($to_date));

    $sheet->mergeCells('A1:L1');
    $sheet->setCellValue('A1', $data['user_dist']);

    // $sheet->setCellValue('K2', 'District Name :');
    // $sheet->setCellValue('L2', 'Nadia');

    $sheet->setCellValue('A4', 'Sl. No');
    $sheet->setCellValue('B4', 'District Name');

    $sheet->setCellValue('C3', 'Before');
    $sheet->setCellValue('C4', 'Prevented');
    $sheet->setCellValue('D4', 'Not Prevented');

    $sheet->setCellValue('E3', 'During');
    $sheet->setCellValue('E4', 'Prevented');
    $sheet->setCellValue('F4', 'Not Prevented');

    $sheet->setCellValue('G3', 'After');
    $sheet->setCellValue('G4', 'Prevented');
    $sheet->setCellValue('H4', 'Not Prevented');

    $sheet->setCellValue('I3', 'Totals');   
    $sheet->setCellValue('I4', 'Prevented');
    $sheet->setCellValue('J4', 'Not Prevented');

    $sheet->setCellValue('K3', 'No. of minor involved');  
    $sheet->setCellValue('K4', 'Female');
    $sheet->setCellValue('L4', 'Male');             
    $rows = 5;
    $count = 1;
    foreach ($report_result as $value){

      $before_marriage_prevented = $value['before_marriage_prevented'];
      $before_marriage_not_prevented = $value['before_marriage_not_prevented'];

      $during_marriage_prevented = $value['during_marriage_prevented'];
      $during_marriage_not_prevented = $value['during_marriage_not_prevented'];

      $after_marriage_prevented = $value['after_marriage_prevented'];
      $after_marriage_not_prevented = $value['after_marriage_not_prevented'];

      $total_prevented = $before_marriage_prevented+$during_marriage_prevented+$after_marriage_prevented;

      $total_not_prevented = $before_marriage_not_prevented+$during_marriage_not_prevented+$after_marriage_not_prevented;

      if($value['before_marriage_prevented'] != 0){ 
        $before_marriage_prevented = $value['before_marriage_prevented']; 
      } else { 
        $before_marriage_prevented = "0"; 
      }

      if($value['before_marriage_not_prevented'] != 0){ 
        $before_marriage_not_prevented = $value['before_marriage_not_prevented']; 
      } else { 
        $before_marriage_not_prevented = "0"; 
      }

      if($value['during_marriage_prevented'] != 0){ 
        $during_marriage_prevented = $value['during_marriage_prevented']; 
      } else { 
        $during_marriage_prevented = "0"; 
      }

      if($value['during_marriage_not_prevented'] != 0){ 
        $during_marriage_not_prevented = $value['during_marriage_not_prevented']; 
      } else { 
        $during_marriage_not_prevented = "0"; 
      }

      if($value['after_marriage_prevented'] != 0){ 
        $after_marriage_prevented = $value['after_marriage_prevented']; 
      } else { 
        $after_marriage_prevented = "0"; 
      }

      if($value['after_marriage_not_prevented'] != 0){ 
        $after_marriage_not_prevented = $value['after_marriage_not_prevented']; 
      } else { 
        $after_marriage_not_prevented = "0"; 
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

      $sheet->setCellValue('C' . $rows, $before_marriage_prevented);
      $sheet->setCellValue('D' . $rows, $before_marriage_not_prevented);

      $sheet->setCellValue('E' . $rows, $during_marriage_prevented);
      $sheet->setCellValue('F' . $rows, $during_marriage_not_prevented);

      $sheet->setCellValue('G' . $rows, $after_marriage_prevented);
      $sheet->setCellValue('H' . $rows, $after_marriage_not_prevented);

      $sheet->setCellValue('I' . $rows, $total_prevented);
      $sheet->setCellValue('J' . $rows, $total_not_prevented);

      $sheet->setCellValue('K' . $rows, $total_female_count_under_18);
      $sheet->setCellValue('L' . $rows, $total_male_count_under_18);
      $rows++;
    }

    //SHOW TOTAL 
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'before_marriage_prevented')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'before_marriage_not_prevented')));
      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'during_marriage_prevented')));
      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'during_marriage_not_prevented')));
      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'after_marriage_prevented')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'after_marriage_not_prevented')));

      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'before_marriage_prevented')) + array_sum(array_column($report_result, 'during_marriage_prevented')) + array_sum(array_column($report_result, 'after_marriage_prevented')));
      $sheet->setCellValue('J' . $total_row,array_sum(array_column($report_result, 'before_marriage_not_prevented')) + array_sum(array_column($report_result, 'during_marriage_not_prevented')) + array_sum(array_column($report_result, 'after_marriage_not_prevented')));

      $sheet->setCellValue('K' . $total_row,array_sum(array_column($report_result, 'total_female_count_under_18')));
      $sheet->setCellValue('L' . $total_row,array_sum(array_column($report_result, 'total_male_count_under_18')));

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
    // $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    // $district_id = $uriSegments[7];
    $data['district'] = $this->Master_model->get_district_name($district_id);
    // $district_id = base64_decode($district_id);
    $report_result = $this->CM_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
    $fileName = 'INTERVENTION_UNDERTAKEN_REPORT_BLOCK_MUCICIPALITY_WISE';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A2:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B2:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C4:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G4:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('I3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I4:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('K3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K4:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
       $sheet->getStyle('J2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
          $sheet->getStyle('K2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
       $sheet->getStyle('L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
        $sheet->getStyle('A1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
        $sheet->getStyle('A1:L1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

    $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C3:D3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E3:F3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G3:H3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K3:L3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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

    // $sheet->mergeCells('A2:A3');
    // $sheet->mergeCells('B2:B3');
    $sheet->mergeCells('C3:D3');
    $sheet->mergeCells('E3:F3');
    $sheet->mergeCells('G3:H3');
    $sheet->mergeCells('I3:J3');
    $sheet->mergeCells('K3:L3');

    $sheet->setCellValue('A2', 'From date :');
    $sheet->setCellValue('B2', $this->convert_date_format($from_date));

    $sheet->setCellValue('C2', '-:-');

    $sheet->setCellValue('D2', 'To date :');
    $sheet->setCellValue('E2', $this->convert_date_format($to_date));

    $sheet->mergeCells('A1:L1');
    $sheet->setCellValue('A1', 'INTERVENTION UNDERTAKEN LIST REPORT (BLOCK/MUNICIPALITY WISE) FOR '.$data['district']->district_name);

    // $sheet->setCellValue('K2', 'District Name');
    // $sheet->setCellValue('L2', $data['district']->district_name);

    $sheet->setCellValue('A4', 'Sl. No');
    $sheet->setCellValue('B4', 'Jurisdiction');

    $sheet->setCellValue('C3', 'Before');
    $sheet->setCellValue('C4', 'Prevented');
    $sheet->setCellValue('D4', 'Not Prevented');

    $sheet->setCellValue('E3', 'During');
    $sheet->setCellValue('E4', 'Prevented');
    $sheet->setCellValue('F4', 'Not Prevented');

    $sheet->setCellValue('G3', 'After');
    $sheet->setCellValue('G4', 'Prevented');
    $sheet->setCellValue('H4', 'Not Prevented');

    $sheet->setCellValue('I3', 'Totals');   
    $sheet->setCellValue('I4', 'Prevented');
    $sheet->setCellValue('J4', 'Not Prevented');

    $sheet->setCellValue('K3', 'No. of minor involved');  
    $sheet->setCellValue('K4', 'Female');
    $sheet->setCellValue('L4', 'Male');             
    $rows = 5;
    $count = 1;
    foreach ($report_result as $value){

      $before_marriage_prevented = $value['before_marriage_prevented'];
      $before_marriage_not_prevented = $value['before_marriage_not_prevented'];

      $during_marriage_prevented = $value['during_marriage_prevented'];
      $during_marriage_not_prevented = $value['during_marriage_not_prevented'];

      $after_marriage_prevented = $value['after_marriage_prevented'];
      $after_marriage_not_prevented = $value['after_marriage_not_prevented'];

      $total_prevented = $before_marriage_prevented+$during_marriage_prevented+$after_marriage_prevented;

      $total_not_prevented = $before_marriage_not_prevented+$during_marriage_not_prevented+$after_marriage_not_prevented;

      if($value['before_marriage_prevented'] != 0){ 
        $before_marriage_prevented = $value['before_marriage_prevented']; 
      } else { 
        $before_marriage_prevented = "0"; 
      }

      if($value['before_marriage_not_prevented'] != 0){ 
        $before_marriage_not_prevented = $value['before_marriage_not_prevented']; 
      } else { 
        $before_marriage_not_prevented = "0"; 
      }

      if($value['during_marriage_prevented'] != 0){ 
        $during_marriage_prevented = $value['during_marriage_prevented']; 
      } else { 
        $during_marriage_prevented = "0"; 
      }

      if($value['during_marriage_not_prevented'] != 0){ 
        $during_marriage_not_prevented = $value['during_marriage_not_prevented']; 
      } else { 
        $during_marriage_not_prevented = "0"; 
      }

      if($value['after_marriage_prevented'] != 0){ 
        $after_marriage_prevented = $value['after_marriage_prevented']; 
      } else { 
        $after_marriage_prevented = "0"; 
      }

      if($value['after_marriage_not_prevented'] != 0){ 
        $after_marriage_not_prevented = $value['after_marriage_not_prevented']; 
      } else { 
        $after_marriage_not_prevented = "0"; 
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

      $sheet->setCellValue('C' . $rows, $before_marriage_prevented);
      $sheet->setCellValue('D' . $rows, $before_marriage_not_prevented);

      $sheet->setCellValue('E' . $rows, $during_marriage_prevented);
      $sheet->setCellValue('F' . $rows, $during_marriage_not_prevented);

      $sheet->setCellValue('G' . $rows, $after_marriage_prevented);
      $sheet->setCellValue('H' . $rows, $after_marriage_not_prevented);

      $sheet->setCellValue('I' . $rows, $total_prevented);
      $sheet->setCellValue('J' . $rows, $total_not_prevented);

      $sheet->setCellValue('K' . $rows, $total_female_count_under_18);
      $sheet->setCellValue('L' . $rows, $total_male_count_under_18);
      $rows++;
    }

    //SHOW TOTAL 
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'before_marriage_prevented')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'before_marriage_not_prevented')));
      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'during_marriage_prevented')));
      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'during_marriage_not_prevented')));
      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'after_marriage_prevented')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'after_marriage_not_prevented')));

      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'before_marriage_prevented')) + array_sum(array_column($report_result, 'during_marriage_prevented')) + array_sum(array_column($report_result, 'after_marriage_prevented')));
      $sheet->setCellValue('J' . $total_row,array_sum(array_column($report_result, 'before_marriage_not_prevented')) + array_sum(array_column($report_result, 'during_marriage_not_prevented')) + array_sum(array_column($report_result, 'after_marriage_not_prevented')));

      $sheet->setCellValue('K' . $total_row,array_sum(array_column($report_result, 'total_female_count_under_18')));
      $sheet->setCellValue('L' . $total_row,array_sum(array_column($report_result, 'total_male_count_under_18')));

    }

    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }


  public function GP_Ward_Wise_Download_Excel($block_id, $from_date, $to_date)
  {
    // echo $block_id;die;
    $data['block_id'] = $block_id; 
    // echo $data['block_id'];die;
    $this->validate_login(array('1', '5', '4', '2', '3','6'));

    // $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    // $data['block_id'] = $uriSegments[7];
    // echo $data['block_id'];
    $result_block_dist = $this->Master_model->get_dist_by_block($data);

    // $block_id = base64_decode($block_id);
        // echo $result_block_dist['district_name'];
        // echo $result_block_dist['block_name'];
        // echo'<pre>';print_r($result_block_dist);die;
    $report_result = $this->CM_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
    $fileName = 'INTERVENTION_UNDERTAKEN_REPORT_WARD_GP_WISE';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

      $sheet->getStyle('A2:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B2:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C4:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E4:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G4:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('I3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I4:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('K3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K4:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
       $sheet->getStyle('J2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
          $sheet->getStyle('K2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
       $sheet->getStyle('L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
        $sheet->getStyle('A1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
        $sheet->getStyle('A1:L1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

    $sheet->getStyle('A2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C3:D3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E3:F3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G3:H3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I3:J3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('K3:L3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1:L1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getStyle('A1:B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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

    // $sheet->getStyle('F2:I2')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

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

    // $sheet->mergeCells('A2:A3');
    // $sheet->mergeCells('B2:B3');
    $sheet->mergeCells('C3:D3');
    $sheet->mergeCells('E3:F3');
    $sheet->mergeCells('G3:H3');
    $sheet->mergeCells('I3:J3');
    $sheet->mergeCells('K3:L3');
    $sheet->mergeCells('K2:L2');

    $sheet->setCellValue('A2', 'From date :');
    $sheet->setCellValue('B2', $this->convert_date_format($from_date));

    $sheet->setCellValue('C2', '-:-');

    $sheet->setCellValue('D2', 'To date :');
    $sheet->setCellValue('E2', $this->convert_date_format($to_date));

    $sheet->mergeCells('A1:I1');
    $sheet->setCellValue('A1', 'INTERVENTION UNDERTAKEN LIST REPORT (GP/WARD WISE) FOR '.$result_block_dist['block_name']);

    $sheet->mergeCells('J1:L1');
    $sheet->setCellValue('J1', 'District Name :'.$result_block_dist['district_name']);
    // $sheet->setCellValue('H2', $result_block_dist['district_name']);

    $sheet->setCellValue('A4', 'Sl. No');
    $sheet->setCellValue('B4', 'Jurisdiction');

    $sheet->setCellValue('C3', 'Before');
    $sheet->setCellValue('C4', 'Prevented');
    $sheet->setCellValue('D4', 'Not Prevented');

    $sheet->setCellValue('E3', 'During');
    $sheet->setCellValue('E4', 'Prevented');
    $sheet->setCellValue('F4', 'Not Prevented');

    $sheet->setCellValue('G3', 'After');
    $sheet->setCellValue('G4', 'Prevented');
    $sheet->setCellValue('H4', 'Not Prevented');

    $sheet->setCellValue('I3', 'Totals');   
    $sheet->setCellValue('I4', 'Prevented');
    $sheet->setCellValue('J4', 'Not Prevented');

    $sheet->setCellValue('K3', 'No. of minor involved');  
    $sheet->setCellValue('K4', 'Female');
    $sheet->setCellValue('L4', 'Male');             
    $rows = 5;
    $count = 1;
    foreach ($report_result as $value){
      
      $before_marriage_prevented = $value['before_marriage_prevented'];
      $before_marriage_not_prevented = $value['before_marriage_not_prevented'];

      $during_marriage_prevented = $value['during_marriage_prevented'];
      $during_marriage_not_prevented = $value['during_marriage_not_prevented'];

      $after_marriage_prevented = $value['after_marriage_prevented'];
      $after_marriage_not_prevented = $value['after_marriage_not_prevented'];

      $total_prevented = $before_marriage_prevented+$during_marriage_prevented+$after_marriage_prevented;

      $total_not_prevented = $before_marriage_not_prevented+$during_marriage_not_prevented+$after_marriage_not_prevented;

      if($value['before_marriage_prevented'] != 0){ 
        $before_marriage_prevented = $value['before_marriage_prevented']; 
      } else { 
        $before_marriage_prevented = "0"; 
      }

      if($value['before_marriage_not_prevented'] != 0){ 
        $before_marriage_not_prevented = $value['before_marriage_not_prevented']; 
      } else { 
        $before_marriage_not_prevented = "0"; 
      }

      if($value['during_marriage_prevented'] != 0){ 
        $during_marriage_prevented = $value['during_marriage_prevented']; 
      } else { 
        $during_marriage_prevented = "0"; 
      }

      if($value['during_marriage_not_prevented'] != 0){ 
        $during_marriage_not_prevented = $value['during_marriage_not_prevented']; 
      } else { 
        $during_marriage_not_prevented = "0"; 
      }

      if($value['after_marriage_prevented'] != 0){ 
        $after_marriage_prevented = $value['after_marriage_prevented']; 
      } else { 
        $after_marriage_prevented = "0"; 
      }

      if($value['after_marriage_not_prevented'] != 0){ 
        $after_marriage_not_prevented = $value['after_marriage_not_prevented']; 
      } else { 
        $after_marriage_not_prevented = "0"; 
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

      $sheet->setCellValue('C' . $rows, $before_marriage_prevented);
      $sheet->setCellValue('D' . $rows, $before_marriage_not_prevented);

      $sheet->setCellValue('E' . $rows, $during_marriage_prevented);
      $sheet->setCellValue('F' . $rows, $during_marriage_not_prevented);

      $sheet->setCellValue('G' . $rows, $after_marriage_prevented);
      $sheet->setCellValue('H' . $rows, $after_marriage_not_prevented);

      $sheet->setCellValue('I' . $rows, $total_prevented);
      $sheet->setCellValue('J' . $rows, $total_not_prevented);

      $sheet->setCellValue('K' . $rows, $total_female_count_under_18);
      $sheet->setCellValue('L' . $rows, $total_male_count_under_18);
      $rows++;
    } 

    //SHOW TOTAL 
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'before_marriage_prevented')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'before_marriage_not_prevented')));
      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'during_marriage_prevented')));
      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'during_marriage_not_prevented')));
      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'after_marriage_prevented')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'after_marriage_not_prevented')));

      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'before_marriage_prevented')) + array_sum(array_column($report_result, 'during_marriage_prevented')) + array_sum(array_column($report_result, 'after_marriage_prevented')));
      $sheet->setCellValue('J' . $total_row,array_sum(array_column($report_result, 'before_marriage_not_prevented')) + array_sum(array_column($report_result, 'during_marriage_not_prevented')) + array_sum(array_column($report_result, 'after_marriage_not_prevented')));

      $sheet->setCellValue('K' . $total_row,array_sum(array_column($report_result, 'total_female_count_under_18')));
      $sheet->setCellValue('L' . $total_row,array_sum(array_column($report_result, 'total_male_count_under_18')));

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
}
