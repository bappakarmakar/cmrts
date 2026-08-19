<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pending_status_report_view extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('mis/Pending_status_report_model');
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
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == TRUE) {
       $from_date = $this->us_date_format($this->input->post('from_date'));
       $to_date = $this->us_date_format($this->input->post('to_date'));
       $report_result = $this->Pending_status_report_model->pending_status_report_get_district($from_date, $to_date);
       $data['report_result'] = $report_result;
    }
    $this->load->view($this->config->item('theme').'mis/pending_status_report/pending_status_report_form_view', $data);
  }

  public function sd_block($district_id, $from_date, $to_date)
  {
    $this->validate_login(array('1', '5', '4', '2', '3','6'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $report_result = $this->Pending_status_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
     $data['report_result'] = $report_result;
     $data['from_date'] = $from_date;
     $data['to_date'] = $to_date;
     $data['district_id'] = $district_id;
     $this->load->view($this->config->item('theme').'mis/pending_status_report/pending_status_report_form_view_sd_block', $data);
  }
  
  public function ward_gp($block_id, $from_date, $to_date)
  {
    $this->validate_login(array('1', '5', '4', '2', '3','6'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $report_result = $this->Pending_status_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
     $data['report_result'] = $report_result;
     $data['from_date'] = $from_date;
     $data['to_date'] = $to_date;
     $data['block_id'] = $block_id;
     $this->load->view($this->config->item('theme').'mis/pending_status_report/pending_status_report_form_view_ward_gp', $data);
  }

  public function District_Wise_Download_Excel($from_date, $to_date)
  {
    $this->validate_login(array('1', '5', '4', '2', '3','6'));
    // $from_date = base64_decode($from_date);
    // $to_date = base64_decode($to_date);
    $fileName = 'Pending_Status_Report_District_Wise';
    $report_result = $this->Pending_status_report_model->pending_status_report_get_district($from_date, $to_date);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
     $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('H2:I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J2:K2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C2:D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F2:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('H2:I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('J2:K2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('L2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


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
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('D')->setWidth(30);
    $sheet->getColumnDimension('E')->setWidth(20);
    $sheet->getColumnDimension('F')->setWidth(20);
    $sheet->getColumnDimension('G')->setWidth(30);
    $sheet->getColumnDimension('H')->setWidth(40);
    $sheet->getColumnDimension('I')->setWidth(20);
    $sheet->getColumnDimension('J')->setWidth(20);
    $sheet->getColumnDimension('K')->setWidth(30);
    $sheet->getColumnDimension('L')->setWidth(20);

    $sheet->mergeCells('A1:A2');
    $sheet->mergeCells('B1:B2');
    $sheet->mergeCells('C1:E1');
    $sheet->mergeCells('F1:I1');
    $sheet->mergeCells('J1:L1');

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'Jurisdiction');
    $sheet->setCellValue('C1', 'DEO Level');
    $sheet->setCellValue('C2', 'Pending as Drafts');
    $sheet->setCellValue('D2', 'Completed but not forwarded');
    $sheet->setCellValue('E2', 'Forwarded');
    $sheet->setCellValue('F1', 'BDO/SDO');
    $sheet->setCellValue('F2', 'Pending as Drafts');
    $sheet->setCellValue('G2', 'Completed but not published');
    $sheet->setCellValue('H2', 'Received from DEO but not published');
    $sheet->setCellValue('I2', 'Published');
    $sheet->setCellValue('J1', 'CMPO');
    $sheet->setCellValue('J2', 'Pending as Drafts');
    $sheet->setCellValue('K2', 'Completed but not published');
    $sheet->setCellValue('L2', 'Published');

    $rows = 3;
    $count = 1;
    foreach ($report_result as $value){
      
      if($value['deo_level_draft_pending_count'] != 0){ 
        $deo_level_draft_pending_count = $value['deo_level_draft_pending_count']; 
      } else { 
        $deo_level_draft_pending_count = "0"; 
      }

      if($value['deo_level_not_forwarded_count'] != 0){ 
        $deo_level_not_forwarded_count = $value['deo_level_not_forwarded_count']; 
      } else { 
        $deo_level_not_forwarded_count = "0"; 
      }

      if($value['deo_level_forwarded_count'] != 0){ 
        $deo_level_forwarded_count = $value['deo_level_forwarded_count']; 
      } else { 
        $deo_level_forwarded_count = "0"; 
      }

      if($value['bdo_sdo_level_draft_pending_count'] != 0){ 
        $bdo_sdo_level_draft_pending_count = $value['bdo_sdo_level_draft_pending_count']; 
      } else { 
        $bdo_sdo_level_draft_pending_count = "0"; 
      }

      if($value['bdo_sdo_level_received_deo_not_published_count'] != 0){ 
        $bdo_sdo_level_received_deo_not_published_count = $value['bdo_sdo_level_received_deo_not_published_count']; 
      } else { 
        $bdo_sdo_level_received_deo_not_published_count = "0"; 
      }

      if($value['bdo_sdo_level_published_count'] != 0){ 
        $bdo_sdo_level_published_count = $value['bdo_sdo_level_published_count']; 
      } else { 
        $bdo_sdo_level_published_count = "0"; 
      }

      if($value['cmpo_level_draft_pending_count'] != 0){ 
        $cmpo_level_draft_pending_count = $value['cmpo_level_draft_pending_count']; 
      } else { 
        $cmpo_level_draft_pending_count = "0"; 
      }

      if($value['cmpo_level_published_count'] != 0){ 
        $cmpo_level_published_count = $value['cmpo_level_published_count']; 
      } else { 
        $cmpo_level_published_count = "0"; 
      }

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['district_name']);

      $sheet->setCellValue('C' . $rows, $deo_level_draft_pending_count);
      $sheet->setCellValue('D' . $rows, $deo_level_not_forwarded_count);
      $sheet->setCellValue('E' . $rows, $deo_level_forwarded_count);

      $sheet->setCellValue('F' . $rows, $bdo_sdo_level_draft_pending_count);
      $sheet->setCellValue('G' . $rows, '0');
      $sheet->setCellValue('H' . $rows, $bdo_sdo_level_received_deo_not_published_count);
      $sheet->setCellValue('I' . $rows, $bdo_sdo_level_published_count);

      $sheet->setCellValue('J' . $rows, $cmpo_level_draft_pending_count);
      $sheet->setCellValue('K' . $rows, '0');
      $sheet->setCellValue('L' . $rows, $cmpo_level_published_count);
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
    $report_result = $this->Pending_status_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
    $fileName = 'Pending_Status_Report_Block_Municipality_Wise';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
     $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('H2:I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J2:K2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C2:D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F2:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('H2:I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('J2:K2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('L2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


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
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('D')->setWidth(30);
    $sheet->getColumnDimension('E')->setWidth(20);
    $sheet->getColumnDimension('F')->setWidth(20);
    $sheet->getColumnDimension('G')->setWidth(30);
    $sheet->getColumnDimension('H')->setWidth(40);
    $sheet->getColumnDimension('I')->setWidth(20);
    $sheet->getColumnDimension('J')->setWidth(20);
    $sheet->getColumnDimension('K')->setWidth(30);
    $sheet->getColumnDimension('L')->setWidth(20);

    $sheet->mergeCells('A1:A2');
    $sheet->mergeCells('B1:B2');
    $sheet->mergeCells('C1:E1');
    $sheet->mergeCells('F1:I1');
    $sheet->mergeCells('J1:L1');

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'Block/Municipality');
    $sheet->setCellValue('C1', 'DEO Level');
    $sheet->setCellValue('C2', 'Pending as Drafts');
    $sheet->setCellValue('D2', 'Completed but not forwarded');
    $sheet->setCellValue('E2', 'Forwarded');
    $sheet->setCellValue('F1', 'BDO/SDO');
    $sheet->setCellValue('F2', 'Pending as Drafts');
    $sheet->setCellValue('G2', 'Completed but not published');
    $sheet->setCellValue('H2', 'Received from DEO but not published');
    $sheet->setCellValue('I2', 'Published');
    $sheet->setCellValue('J1', 'CMPO');
    $sheet->setCellValue('J2', 'Pending as Drafts');
    $sheet->setCellValue('K2', 'Completed but not published');
    $sheet->setCellValue('L2', 'Published');

    $rows = 3;
    $count = 1;
    foreach ($report_result as $value){
      
      if($value['deo_level_draft_pending_count'] != 0){ 
        $deo_level_draft_pending_count = $value['deo_level_draft_pending_count']; 
      } else { 
        $deo_level_draft_pending_count = "0"; 
      }

      if($value['deo_level_not_forwarded_count'] != 0){ 
        $deo_level_not_forwarded_count = $value['deo_level_not_forwarded_count']; 
      } else { 
        $deo_level_not_forwarded_count = "0"; 
      }

      if($value['deo_level_forwarded_count'] != 0){ 
        $deo_level_forwarded_count = $value['deo_level_forwarded_count']; 
      } else { 
        $deo_level_forwarded_count = "0"; 
      }

      if($value['bdo_sdo_level_draft_pending_count'] != 0){ 
        $bdo_sdo_level_draft_pending_count = $value['bdo_sdo_level_draft_pending_count']; 
      } else { 
        $bdo_sdo_level_draft_pending_count = "0"; 
      }

      if($value['bdo_sdo_level_received_deo_not_published_count'] != 0){ 
        $bdo_sdo_level_received_deo_not_published_count = $value['bdo_sdo_level_received_deo_not_published_count']; 
      } else { 
        $bdo_sdo_level_received_deo_not_published_count = "0"; 
      }

      if($value['bdo_sdo_level_published_count'] != 0){ 
        $bdo_sdo_level_published_count = $value['bdo_sdo_level_published_count']; 
      } else { 
        $bdo_sdo_level_published_count = "0"; 
      }

      if($value['cmpo_level_draft_pending_count'] != 0){ 
        $cmpo_level_draft_pending_count = $value['cmpo_level_draft_pending_count']; 
      } else { 
        $cmpo_level_draft_pending_count = "0"; 
      }

      if($value['cmpo_level_published_count'] != 0){ 
        $cmpo_level_published_count = $value['cmpo_level_published_count']; 
      } else { 
        $cmpo_level_published_count = "0"; 
      }

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['block_name']);

      $sheet->setCellValue('C' . $rows, $deo_level_draft_pending_count);
      $sheet->setCellValue('D' . $rows, $deo_level_not_forwarded_count);
      $sheet->setCellValue('E' . $rows, $deo_level_forwarded_count);

      $sheet->setCellValue('F' . $rows, $bdo_sdo_level_draft_pending_count);
      $sheet->setCellValue('G' . $rows, '0');
      $sheet->setCellValue('H' . $rows, $bdo_sdo_level_received_deo_not_published_count);
      $sheet->setCellValue('I' . $rows, $bdo_sdo_level_published_count);

      $sheet->setCellValue('J' . $rows, $cmpo_level_draft_pending_count);
      $sheet->setCellValue('K' . $rows, '0');
      $sheet->setCellValue('L' . $rows, $cmpo_level_published_count);
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
    $report_result = $this->Pending_status_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
    $fileName = 'Pending_Status_Report_Warp_GP_Wise';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1:B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2:D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
     $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('H2:I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J2:K2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('L2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C2:D2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F2:G2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('H2:I2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('J2:K2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('L2')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


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
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('D')->setWidth(30);
    $sheet->getColumnDimension('E')->setWidth(20);
    $sheet->getColumnDimension('F')->setWidth(20);
    $sheet->getColumnDimension('G')->setWidth(30);
    $sheet->getColumnDimension('H')->setWidth(40);
    $sheet->getColumnDimension('I')->setWidth(20);
    $sheet->getColumnDimension('J')->setWidth(20);
    $sheet->getColumnDimension('K')->setWidth(30);
    $sheet->getColumnDimension('L')->setWidth(20);

    $sheet->mergeCells('A1:A2');
    $sheet->mergeCells('B1:B2');
    $sheet->mergeCells('C1:E1');
    $sheet->mergeCells('F1:I1');
    $sheet->mergeCells('J1:L1');

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'GP Name / Ward No');
    $sheet->setCellValue('C1', 'DEO Level');
    $sheet->setCellValue('C2', 'Pending as Drafts');
    $sheet->setCellValue('D2', 'Completed but not forwarded');
    $sheet->setCellValue('E2', 'Forwarded');
    $sheet->setCellValue('F1', 'BDO/SDO');
    $sheet->setCellValue('F2', 'Pending as Drafts');
    $sheet->setCellValue('G2', 'Completed but not published');
    $sheet->setCellValue('H2', 'Received from DEO but not published');
    $sheet->setCellValue('I2', 'Published');
    $sheet->setCellValue('J1', 'CMPO');
    $sheet->setCellValue('J2', 'Pending as Drafts');
    $sheet->setCellValue('K2', 'Completed but not published');
    $sheet->setCellValue('L2', 'Published');

    $rows = 3;
    $count = 1;
    foreach ($report_result as $value){
      
      if($value['deo_level_draft_pending_count'] != 0){ 
        $deo_level_draft_pending_count = $value['deo_level_draft_pending_count']; 
      } else { 
        $deo_level_draft_pending_count = "0"; 
      }

      if($value['deo_level_not_forwarded_count'] != 0){ 
        $deo_level_not_forwarded_count = $value['deo_level_not_forwarded_count']; 
      } else { 
        $deo_level_not_forwarded_count = "0"; 
      }

      if($value['deo_level_forwarded_count'] != 0){ 
        $deo_level_forwarded_count = $value['deo_level_forwarded_count']; 
      } else { 
        $deo_level_forwarded_count = "0"; 
      }

      if($value['bdo_sdo_level_draft_pending_count'] != 0){ 
        $bdo_sdo_level_draft_pending_count = $value['bdo_sdo_level_draft_pending_count']; 
      } else { 
        $bdo_sdo_level_draft_pending_count = "0"; 
      }

      if($value['bdo_sdo_level_received_deo_not_published_count'] != 0){ 
        $bdo_sdo_level_received_deo_not_published_count = $value['bdo_sdo_level_received_deo_not_published_count']; 
      } else { 
        $bdo_sdo_level_received_deo_not_published_count = "0"; 
      }

      if($value['bdo_sdo_level_published_count'] != 0){ 
        $bdo_sdo_level_published_count = $value['bdo_sdo_level_published_count']; 
      } else { 
        $bdo_sdo_level_published_count = "0"; 
      }

      if($value['cmpo_level_draft_pending_count'] != 0){ 
        $cmpo_level_draft_pending_count = $value['cmpo_level_draft_pending_count']; 
      } else { 
        $cmpo_level_draft_pending_count = "0"; 
      }

      if($value['cmpo_level_published_count'] != 0){ 
        $cmpo_level_published_count = $value['cmpo_level_published_count']; 
      } else { 
        $cmpo_level_published_count = "0"; 
      }

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['ward_gp_name']);

      $sheet->setCellValue('C' . $rows, $deo_level_draft_pending_count);
      $sheet->setCellValue('D' . $rows, $deo_level_not_forwarded_count);
      $sheet->setCellValue('E' . $rows, $deo_level_forwarded_count);

      $sheet->setCellValue('F' . $rows, $bdo_sdo_level_draft_pending_count);
      $sheet->setCellValue('G' . $rows, '0');
      $sheet->setCellValue('H' . $rows, $bdo_sdo_level_received_deo_not_published_count);
      $sheet->setCellValue('I' . $rows, $bdo_sdo_level_published_count);

      $sheet->setCellValue('J' . $rows, $cmpo_level_draft_pending_count);
      $sheet->setCellValue('K' . $rows, '0');
      $sheet->setCellValue('L' . $rows, $cmpo_level_published_count);
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
