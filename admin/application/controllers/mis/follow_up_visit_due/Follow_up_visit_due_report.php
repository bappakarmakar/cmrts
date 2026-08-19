<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Follow_up_visit_due_report extends NIC_Controller
{

  private $district_wise = [
    'field_selection' => "cp.cp_district as unique_id, cp.cp_district as district_id_pk, district_master.district_name as name,",
    'group_by' => "cp.cp_district,district_master.district_name",
    'order_by' => "district_master.district_name"

  ];

  private $block_wise = [
    'field_selection' => "cp.cp_block as unique_id, block_master.block_name as name,",
    'group_by' => "cp.cp_block,block_master.block_name",
    'order_by' => "block_master.block_name"
  ];

  private $ward_wise = [
    'field_selection' => "cp.cp_ward_gp as unique_id, wmstr.ward_no as name,",
    'group_by' => "cp.cp_ward_gp, wmstr.ward_no",
    'order_by' => "wmstr.ward_no"
  ];

  private $gp_wise = [
    'field_selection' => "cp.cp_ward_gp as unique_id, gpmstr.gp_name as name,",
    'group_by' => "cp.cp_ward_gp, gpmstr.gp_name",
    'order_by' => "gpmstr.gp_name"
  ];



  // MIS count details view
  private $district_wise_count = [
    'field_selection' => "cp.cp_district as unique_id, cp.cp_district as district_id_pk, district_master.district_name as name,schd.reporting_id,cp.cp_name,cmir.incident_date,schd.active_status,schd.calculated_date,schd.fu_names,cp.cp_gender,cp.cp_dob,",
    'group_by' => "cp.cp_district,district_master.district_name,schd.reporting_id,cp.cp_name,cmir.incident_date,schd.active_status,schd.calculated_date,schd.fu_names,cp.cp_gender,cp.cp_dob",
    'order_by' => "district_master.district_name"
  ];

  private $block_wise_count = [
    'field_selection' => "cp.cp_block as unique_id, block_master.block_name as name,schd.reporting_id,cp.cp_name,cmir.incident_date,schd.active_status,schd.calculated_date,schd.fu_names,cp.cp_gender,cp.cp_dob,",
    'group_by' => "cp.cp_block,block_master.block_name,schd.reporting_id,cp.cp_name,cmir.incident_date,schd.active_status,schd.calculated_date,schd.fu_names,cp.cp_gender,cp.cp_dob",
    'order_by' => "block_master.block_name"
  ];

  private $ward_wise_count = [
    'field_selection' => "cp.cp_ward_gp as unique_id, wmstr.ward_no as name,schd.reporting_id,cp.cp_name,cmir.incident_date,schd.active_status,schd.calculated_date,schd.fu_names,cp.cp_gender,cp.cp_dob,",
    'group_by' => "cp.cp_ward_gp, wmstr.ward_no,schd.reporting_id,cp.cp_name,cmir.incident_date,schd.active_status,schd.calculated_date,schd.fu_names,cp.cp_gender,cp.cp_dob",
    'order_by' => "wmstr.ward_no"
  ];

  private $gp_wise_count = [
    'field_selection' => "cp.cp_ward_gp as unique_id, gpmstr.gp_name as name,schd.reporting_id,cp.cp_name,cmir.incident_date,schd.active_status,schd.calculated_date,schd.fu_names,cp.cp_gender,cp.cp_dob,",
    'group_by' => "cp.cp_ward_gp, gpmstr.gp_name,schd.reporting_id,cp.cp_name,cmir.incident_date,schd.active_status,schd.calculated_date,schd.fu_names,cp.cp_gender,cp.cp_dob",
    'order_by' => "gpmstr.gp_name"
  ];

  public function __construct()
  {
    parent::__construct();
    parent::check_privilege();

    //Below line used for confirm form resubmission problem, removed('no-store') ,, if use 'no-store' then "confirm form resubmission?" will show.
    $this->output->set_header('Cache-Control: no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0'); // Cache for 1 hour (3600 seconds)

    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('mis/CM_report_model');
    $this->load->model('mis/Education_wise_mis_model');
    $this->load->model('mis/Follow_up_visit_due_report_model');
    $this->load->model('common/Master_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri') . 'assets/datepicker/css/jquery-ui.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri') . 'assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri') . 'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri') . 'assets/js/jquery-ui.js',
    );
  }

  public function index()
  {
    $district = $this->session->userdata('district');
    $login_id = $this->session->userdata('login_id');

    $fuv_due_report['data'] = $this->Follow_up_visit_due_report_model->get_fuv_due_details($district);

    $this->load->view($this->config->item('theme') . 'mis/follow_up_visit_due/follow_up_visit_due_view', $fuv_due_report);
  }


  public function us_date_format($uk_date = NULL)
  {
    if ($uk_date != NULL) {
      $date_array = explode('/', $uk_date);
      return $date_array[2] . '-' . $date_array[1] . '-' . $date_array[0];
    } else {
      return NULL;
    }
  }
  public function convert_date_format($date = NULL)
  {
    if ($date != NULL) {
      // Create DateTime object from the input date string
      $dateTime = DateTime::createFromFormat('d/m/Y', $date);

      // Check if the date is valid in the given format
      if ($dateTime === false) {
        // If not in d/m/Y format, attempt to create DateTime object with other formats
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);
        if ($dateTime === false) {
          return "Invalid date format";
        }
      }
      // Convert the date to "dd/mm/yyyy" format
      $newDate = $dateTime->format('d/m/Y');
      return $newDate;
    } else {
      return NULL;
    }
  }


  public function follow_ups_due() // Follow-ups report view 
  {
    $data['force_view'] = 0;
    $data['delete_status'] = 0;
    $data['current_status'] = 3;
    $data['hide_search'] = 0;
    $data['active_status'] = 1;
    $data['district_details'] = $this->Dashboard_model->district_details($this->session->userdata('login_id'));

    // ----- Default date MIS loading START -----
      $data['force_view'] = 1;
      $from_date = date('d/m/Y', strtotime('-30 days')); // 30 days ago, in UK format (dd/mm/yyyy)
      $to_date = date('d/m/Y'); // current date, in UK format (dd/mm/yyyy)

      $data['from_date'] = $this->us_date_format($from_date);
      $data['to_date'] = $this->us_date_format($to_date);

      $data['district'] = $this->session->userdata('district');
      $data['block'] = $this->session->userdata('block');
      $data['subdiv'] = $this->session->userdata('subdiv');

      if (empty($data['district'])) {
        $data['segregate'] = 'district';
        $data['field_selection'] = $this->district_wise['field_selection'];
        $data['group_by'] = $this->district_wise['group_by'];
        $data['order_by'] = $this->district_wise['order_by'];
      } else if (!empty($data['district']) and empty($data['block'])) {
        $data['segregate'] = 'block';
        $data['field_selection'] = $this->block_wise['field_selection'];
        $data['group_by'] = $this->block_wise['group_by'];
        $data['order_by'] = $this->block_wise['order_by'];
      } elseif (!empty($data['district']) and (!empty($data['block']))) {

        $data['segregate'] = 'ward_gp';

        $data['unique_id'] = $data['block'];
        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['block']);
        if (!empty($Identity_Ward_Gp_Block)) {
          if ($Identity_Ward_Gp_Block->rural_urban == 'U') {
            $data['is_ward'] = 1;
            $data['field_selection'] = $this->ward_wise['field_selection'];
            $data['group_by'] = $this->ward_wise['group_by'];
            $data['order_by'] = $this->ward_wise['order_by'];
          } else {
            $data['is_gp'] = 1;
            $data['field_selection'] = $this->gp_wise['field_selection'];
            $data['group_by'] = $this->gp_wise['group_by'];
            $data['order_by'] = $this->gp_wise['order_by'];
          }
        }
      }
    // ----- Default date MIS loading START -----
      
    if ($this->input->get()) {
      $data['force_view'] = 1;
      $data['hide_search'] = 1;
      $data['from_date'] = $this->input->get('from_date');
      $data['to_date'] = $this->input->get('to_date');
      $data['segregate'] = $this->input->get('segregate');
      $data['unique_id'] = $this->input->get('unique_id');
      $data['for_adult_minor'] = $this->input->get('for_adult_minor');


      if ($data['segregate'] == 'district') {
        $data['field_selection'] = $this->block_wise['field_selection'];
        $data['group_by'] = $this->block_wise['group_by'];
        $data['district'] = $data['unique_id'];
        $data['segregate'] = 'block';
        $data['order_by'] = $this->block_wise['order_by'];
      } else if ($data['segregate'] == 'block') {
        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['unique_id']);
        if (!empty($Identity_Ward_Gp_Block)) {
          if ($Identity_Ward_Gp_Block->rural_urban == 'U') {
            $data['is_ward'] = 1;
            $data['field_selection'] = $this->ward_wise['field_selection'];
            $data['group_by'] = $this->ward_wise['group_by'];
            $data['order_by'] = $this->ward_wise['order_by'];
          } else {
            $data['is_gp'] = 1;
            $data['field_selection'] = $this->gp_wise['field_selection'];
            $data['group_by'] = $this->gp_wise['group_by'];
            $data['order_by'] = $this->gp_wise['order_by'];
          }
        }

        $data['block'] = $data['unique_id'];
        $data['segregate'] = 'ward_gp';
      }
    } else if ($this->input->method(TRUE) == 'POST') {

      $data['force_view'] = 1;
      $data['from_date'] = $from_date = $this->us_date_format($this->input->post('from_date'));
      $data['to_date'] = $to_date = $this->us_date_format($this->input->post('to_date'));

      $data['district'] = $this->session->userdata('district');
      $data['block'] = $this->session->userdata('block');
      $data['subdiv'] = $this->session->userdata('subdiv');

      if (empty($data['district'])) {
        $data['segregate'] = 'district';
        $data['field_selection'] = $this->district_wise['field_selection'];
        $data['group_by'] = $this->district_wise['group_by'];
        $data['order_by'] = $this->district_wise['order_by'];
      } else if (!empty($data['district']) and empty($data['block'])) {
        $data['segregate'] = 'block';
        $data['field_selection'] = $this->block_wise['field_selection'];
        $data['group_by'] = $this->block_wise['group_by'];
        $data['order_by'] = $this->block_wise['order_by'];
      } elseif (!empty($data['district']) and (!empty($data['block']))) {

        $data['segregate'] = 'ward_gp';

        $data['unique_id'] = $data['block'];
        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['block']);
        if (!empty($Identity_Ward_Gp_Block)) {
          if ($Identity_Ward_Gp_Block->rural_urban == 'U') {
            $data['is_ward'] = 1;
            $data['field_selection'] = $this->ward_wise['field_selection'];
            $data['group_by'] = $this->ward_wise['group_by'];
            $data['order_by'] = $this->ward_wise['order_by'];
          } else {
            $data['is_gp'] = 1;
            $data['field_selection'] = $this->gp_wise['field_selection'];
            $data['group_by'] = $this->gp_wise['group_by'];
            $data['order_by'] = $this->gp_wise['order_by'];
          }
        }
      }
    }

    $data['report_result'] = array();
    if ($data['force_view'] == 1) {
      $data['report_result'] = $this->Follow_up_visit_due_report_model->get_follow_up_overdue_dtls($data);
    }


    $this->load->view($this->config->item('theme') . 'mis/follow_up_visit_due/follow_up_visit_due_view', $data);
  }


  public function follow_up_count_details()
  { // Counts details view function
    $data['district_details'] = $this->Dashboard_model->district_details($this->session->userdata('login_id'));
    if ($this->input->get()) {

      $data['force_view'] = 1;
      $data['hide_search'] = 1;
      $data['from_date'] = $this->input->get('from_date');
      $data['to_date'] = $this->input->get('to_date');
      $data['segregate'] = $this->input->get('segregate');
      $data['unique_id'] = $this->input->get('unique_id');
      $data['block_id'] = $this->input->get('block_id'); //block_id pass to ward/gp level
      $data['check_ward_gp'] = $this->input->get('check_ward_gp'); // ward/gp counts show
      $data['flag'] = $this->input->get('flag');

      if ($data['segregate'] == 'district') {
        $data['field_selection'] = $this->block_wise_count['field_selection'];
        $data['group_by'] = $this->block_wise_count['group_by'];
        $data['district'] = $data['unique_id'];
        $data['segregate'] = 'district';
        $data['order_by'] = $this->block_wise_count['order_by'];

        $data['list_for_name'] = $this->Master_model->get_district_name($data['district']); //get district name
        $data['title'] = $data['list_for_name']->district_name;
      } else if ($data['segregate'] == 'block') {

        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['unique_id']);

        if (!empty($Identity_Ward_Gp_Block)) {
          if ($Identity_Ward_Gp_Block->rural_urban == 'U') {
            $data['is_ward'] = 1;
            $data['field_selection'] = $this->ward_wise_count['field_selection'];
            $data['group_by'] = $this->ward_wise_count['group_by'];
            $data['order_by'] = $this->ward_wise_count['order_by'];
          } else {
            $data['is_gp'] = 1;
            $data['field_selection'] = $this->gp_wise_count['field_selection'];
            $data['group_by'] = $this->gp_wise_count['group_by'];
            $data['order_by'] = $this->gp_wise_count['order_by'];
          }
        }

        $data['block'] = $data['unique_id'];
        $data['segregate'] = 'block';

        $data1['block_id'] = $data['block'] = $data['unique_id'] =  ($data['unique_id']) ? ($data['unique_id']) : $this->session->userdata('block');
        $data['list_for_name'] = $this->Master_model->get_dist_name_by_block($data1); //get block name
        $data['title'] = $data['list_for_name']['block_name'];
      } else if ($data['segregate'] == 'ward_gp') {

        if ($data['check_ward_gp'] == 1) {
          $data['is_ward'] = 2;
          $data['field_selection'] = $this->ward_wise_count['field_selection'];
          $data['group_by'] = $this->ward_wise_count['group_by'];
          $data['order_by'] = $this->ward_wise_count['order_by'];

          $data['ward_name'] = $this->Master_model->Get_ward_name_by_wardid($data['unique_id']);
          $ward_dist_name = $data['ward_name']['ulb_name'];
          $data['title'] = $ward_dist_name . "-" . $data['ward_name']['ward_no'];
        } elseif ($data['check_ward_gp'] == 2) {
          $data['is_gp'] = 2;
          $data['field_selection'] = $this->gp_wise_count['field_selection'];
          $data['group_by'] = $this->gp_wise_count['group_by'];
          $data['order_by'] = $this->gp_wise_count['order_by'];

          $data['gp_name'] = $this->Master_model->Get_gp_name_by_gpid($data['unique_id']);
          $data['title'] = $data['gp_name']['gp_name'];
        }



        $data['block'] = $data['block_id'];
        $data['segregate'] = 'ward_gp';
      }
    }

    $data['report_result'] = array();

    if ($data['force_view'] == 1) {
      $data['report_result'] = $this->Follow_up_visit_due_report_model->get_follow_up_visits_overdue_dtls_by_counts($data);
    }

    $this->load->view($this->config->item('theme') . 'mis/follow_up_visit_due/follow_up_visit_due_count_view', $data);
  }



  public function download_excel()
  {

    $title = "Follow-up visit Overdue";
    $filename = '';

    $data['delete_status'] = 0;
    $data['current_status'] = 3;
    $data['active_status'] = 1;

    $data['segregate'] = $this->input->get('segregate');

    $data['from_date'] = $from_date = $this->input->get('from_date');
    $data['to_date'] = $to_date = $this->input->get('to_date');
    $data['unique_id'] = $this->input->get('unique_id');

    $list_for_name = null;

    if ($data['segregate'] == 'district') //DISTRICT
    {
      $data['field_selection'] = $this->district_wise['field_selection'];
      $data['group_by'] = $this->district_wise['group_by'];
      $data['order_by'] = $this->district_wise['order_by'];
      //title name 
      $list_for_name =  " District-Wise";
      $filename .= 'District_Wise';
    } elseif ($data['segregate'] == 'block') //BLOCK
    {
      $data['district'] = ($data['unique_id']) ? ($data['unique_id']) : $this->session->userdata('district');
      $data['field_selection'] = $this->block_wise['field_selection'];
      $data['group_by'] = $this->block_wise['group_by'];
      $data['order_by'] = $this->block_wise['order_by'];


      $data['list_for_name'] = $this->Master_model->get_district_name($data['district']);
      $list_for_name = $data['list_for_name']->district_name;

      $filename .= $list_for_name;
    } elseif ($data['segregate'] == 'ward_gp') //WARD-GP
    {
      $data1['block_id'] = $data['block'] = $data['unique_id'] =  ($data['unique_id']) ? ($data['unique_id']) : $this->session->userdata('block');
      $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['unique_id']);

      $data['list_for_name'] = $this->Master_model->get_dist_name_by_block($data1);
      $list_for_name = $data['list_for_name']['block_name'];

      $filename .= $list_for_name;

      if (!empty($Identity_Ward_Gp_Block)) {
        if ($Identity_Ward_Gp_Block->rural_urban == 'U') {
          $data['is_ward'] = 1;
          $data['field_selection'] = $this->ward_wise['field_selection'];
          $data['group_by'] = $this->ward_wise['group_by'];
          $data['order_by'] = $this->ward_wise['order_by'];
        } else {
          $data['is_gp'] = 1;
          $data['field_selection'] = $this->gp_wise['field_selection'];
          $data['group_by'] = $this->gp_wise['group_by'];
          $data['order_by'] = $this->gp_wise['order_by'];
        }
      }
    }


    $data['report_result'] = $this->Follow_up_visit_due_report_model->get_follow_up_overdue_dtls($data);
    date_default_timezone_set("Asia/Kolkata");
    $title_name = $title . " ( " . $list_for_name . " ) as on " . date('d-m-Y');
    $filename = $filename . "_" . date('d-m-Y');

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:J2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('A3:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('A1:J1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);
    $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getStyle('A3:C3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);


    $sheet->mergeCells('A1:J1');
    $sheet->mergeCells('A3:A4');
    $sheet->mergeCells('B3:B4');

    $sheet->mergeCells('C3:C4');
    $sheet->mergeCells('D3:J3');


    $sheet->getColumnDimension('B')->setWidth(30);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(25);
    $sheet->getColumnDimension('E')->setWidth(23);
    $sheet->getColumnDimension('F')->setWidth(8);

    foreach (range('C', 'J') as $columnID) {
      $sheet->getColumnDimension($columnID)->setAutoSize(true);
      $sheet->getStyle($columnID)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }


    $from = $this->convert_date_format($from_date);
    $to = $this->convert_date_format($to_date);
    $date_range_text = "From date: $from  -:-  To date: $to";

    $sheet->mergeCells('A2:I2');
    $sheet->setCellValue('A2', $date_range_text);

    // Optional: Center align the text
    $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

    $sheet->setCellValue('A1', $title_name);

    $sheet->setCellValue('A3', 'Sl. No');
    $sheet->setCellValue('B3', 'Jurisdiction');

    $sheet->setCellValue('C3', 'Total Due');
    $sheet->setCellValue('D3', 'No. of days (in no. of days from Date of Intervention)');

    $sheet->setCellValue('D4', 'Due Today');
    $sheet->setCellValue('E4', '1-7');
    $sheet->setCellValue('F4', '8-15');
    $sheet->setCellValue('G4', '16-30');
    $sheet->setCellValue('H4', '31-60');
    $sheet->setCellValue('I4', '61-90');
    $sheet->setCellValue('J4', '>90');


    $rows = 5;
    $count = 1;
    foreach ($data['report_result'] as $value) {
      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['name']);
      $sheet->setCellValue('C' . $rows, $value['total_due']);
      $sheet->setCellValue('D' . $rows, $value['due_today']);

      $sheet->setCellValue('E' . $rows, ($value['pending_1_7_days'] != 0) ? ($value['pending_1_7_days']) : 0);
      $sheet->setCellValue('F' . $rows, ($value['pending_8_15_days'] != 0) ? ($value['pending_8_15_days']) : 0);

      $sheet->setCellValue('G' . $rows, ($value['pending_16_30_days'] != 0) ? ($value['pending_16_30_days']) : 0);
      $sheet->setCellValue('H' . $rows, ($value['pending_31_60_days'] != 0) ? ($value['pending_31_60_days']) : 0);

      $sheet->setCellValue('I' . $rows, ($value['pending_61_90_days'] != 0) ? ($value['pending_61_90_days']) : 0);
      $sheet->setCellValue('J' . $rows, ($value['pending_above_90_days'] != 0) ? ($value['pending_above_90_days']) : 0);


      $rows++;

      //SHOW TOTAL 
      $total_row = count($data['report_result']);

      if ($total_row > 1) {
        $total_row = $total_row + 5;

        $sheet->mergeCells('A' . $total_row . ':' . 'B' . $total_row);
        $sheet->getStyle('A' . $total_row . ':' . 'J' . $total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
        $sheet->getStyle('A' . $total_row . ':' . 'J' . $total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
        $sheet->setCellValue('A' . $total_row, 'Total :');

        $sheet->setCellValue('C' . $total_row, array_sum(array_column($data['report_result'], 'total_due')));
        $sheet->setCellValue('D' . $total_row, array_sum(array_column($data['report_result'], 'due_today')));
        $sheet->setCellValue('E' . $total_row, array_sum(array_column($data['report_result'], 'pending_1_7_days')));

        $sheet->setCellValue('F' . $total_row, array_sum(array_column($data['report_result'], 'pending_8_15_days')));
        $sheet->setCellValue('G' . $total_row, array_sum(array_column($data['report_result'], 'pending_16_30_days')));

        $sheet->setCellValue('H' . $total_row, array_sum(array_column($data['report_result'], 'pending_31_60_days')));
        $sheet->setCellValue('I' . $total_row, array_sum(array_column($data['report_result'], 'pending_61_90_days')));
        $sheet->setCellValue('J' . $total_row, array_sum(array_column($data['report_result'], 'pending_above_90_days')));
      }
    }

    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }

  public function excel_download_for_count_details()
  {
    if ($this->input->get()) {

      $data['force_view'] = 1;
      $data['hide_search'] = 1;
      $data['from_date'] = $this->input->get('from_date');
      $data['to_date'] = $this->input->get('to_date');
      $data['segregate'] = $this->input->get('segregate');
      $data['unique_id'] = $this->input->get('unique_id');
      $data['block_id'] = $this->input->get('block_id');
      $data['check_ward_gp'] = $this->input->get('check_ward_gp'); // ward/gp counts show
      $data['flag'] = $this->input->get('flag');

      if ($data['segregate'] == 'district') {
        $data['field_selection'] = $this->block_wise_count['field_selection'];
        $data['group_by'] = $this->block_wise_count['group_by'];
        $data['district'] = $data['unique_id'];
        $data['segregate'] = 'block';
        $data['order_by'] = $this->block_wise_count['order_by'];

        $data['list_for_name'] = $this->Master_model->get_district_name($data['district']); //get district name
        $title = $data['list_for_name']->district_name;
      } else if ($data['segregate'] == 'block') {
        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['unique_id']);

        if (!empty($Identity_Ward_Gp_Block)) {
          if ($Identity_Ward_Gp_Block->rural_urban == 'U') {
            $data['is_ward'] = 1;
            $data['field_selection'] = $this->ward_wise_count['field_selection'];
            $data['group_by'] = $this->ward_wise_count['group_by'];
            $data['order_by'] = $this->ward_wise_count['order_by'];
          } else {
            $data['is_gp'] = 1;
            $data['field_selection'] = $this->gp_wise_count['field_selection'];
            $data['group_by'] = $this->gp_wise_count['group_by'];
            $data['order_by'] = $this->gp_wise_count['order_by'];
          }
        }

        $data['block'] = $data['unique_id'];
        $data['segregate'] = 'ward_gp';

        $data1['block_id'] = $data['block'] = $data['unique_id'] =  ($data['unique_id']) ? ($data['unique_id']) : $this->session->userdata('block');
        $data['list_for_name'] = $this->Master_model->get_dist_name_by_block($data1); //get block name
        $title = $data['list_for_name']['block_name'];

      } else if ($data['segregate'] == 'ward_gp') {

        if ($data['check_ward_gp'] == 1) {
          $data['is_ward'] = 2;
          $data['field_selection'] = $this->ward_wise_count['field_selection'];
          $data['group_by'] = $this->ward_wise_count['group_by'];
          $data['order_by'] = $this->ward_wise_count['order_by'];

          $data['ward_name'] = $this->Master_model->Get_ward_name_by_wardid($data['unique_id']);
          $ward_dist_name = $data['ward_name']['ulb_name'];
          $title = $ward_dist_name . "-" . $data['ward_name']['ward_no'];
        } elseif ($data['check_ward_gp'] == 2) {
          $data['is_gp'] = 2;
          $data['field_selection'] = $this->gp_wise_count['field_selection'];
          $data['group_by'] = $this->gp_wise_count['group_by'];
          $data['order_by'] = $this->gp_wise_count['order_by'];

          $data['gp_name'] = $this->Master_model->Get_gp_name_by_gpid($data['unique_id']);
          $title = $data['gp_name']['gp_name'];
        }
        $data['block'] = $data['block_id'];
        $data['segregate'] = 'ward_gp_count';
      }
    }

    $data['report_result'] = array();

    if ($data['force_view'] == 1) {
      $data['report_result'] = $this->Follow_up_visit_due_report_model->get_follow_up_visits_overdue_dtls_by_counts($data);
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    if ($data['flag'] == 0) {
      $column_name = "Due Today";
    } elseif ($data['flag'] == 1) {
      $column_name = "Total Due";
    } elseif ($data['flag'] == 2) {
      $column_name = "No. of days(1 - 7)";
    } elseif ($data['flag'] == 3) {
      $column_name = "No. of days(8 - 15)";
    } elseif ($data['flag'] == 4) {
      $column_name = "No. of days(16 - 30)";
    } elseif ($data['flag'] == 5) {
      $column_name = "No. of days(31 - 60)";
    } elseif ($data['flag'] == 6) {
      $column_name = "No. of days(61 - 90)";
    } elseif ($data['flag'] == 7) {
      $column_name = "No. of days(>90)";
    }

    $title_line = 1;
    date_default_timezone_set("Asia/Kolkata");
    if ($data['from_date'] != '' && $data['to_date'] != '') {
      $title_line = 2;
      $dateSearch = "From Date :" . $this->input->get('from_date') . "    --------    " . "To Date :" . $this->input->get('to_date') . "            " . $title . " ( " . $column_name . " ) as on " . date('d-m-Y');;
      $sheet->setCellValue('A1', $dateSearch);
      $sheet->mergeCells('A1:I1');
    }

    $filename = "Follow-Up_Visits_OverDue_" . $column_name . " " . $title;

    $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('A1:I1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

    $sheet->getStyle('A' . $title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B' . $title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C' . $title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D' . $title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E' . $title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F' . $title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G' . $title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H' . $title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I' . $title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');


    $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    foreach (range('A', 'I') as $columnID) {
      $sheet->getColumnDimension($columnID)->setAutoSize(true);
      $sheet->getStyle($columnID)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }

    $sheet->setCellValue('A' . $title_line, 'Sl. No');
    $sheet->setCellValue('B' . $title_line, 'Intervention ID');
    $sheet->setCellValue('C' . $title_line, 'Intervention Date');
    $sheet->setCellValue('D' . $title_line, 'Contracting Party Name');
    $sheet->setCellValue('E' . $title_line, 'Male/Female');
    $sheet->setCellValue('F' . $title_line, 'Scheduled Date');
    $sheet->setCellValue('G' . $title_line, 'Visits Due');
    $sheet->setCellValue('H' . $title_line, 'Age at Scheduled Date');
    $sheet->setCellValue('I' . $title_line, 'No. of Days Overdue');

    $rows = 3;
    $count = 1;

    foreach ($data['report_result'] as $value) {
      if ($value->cp_gender == 1) {
        $gender = "M";
      } elseif ($value->cp_gender == 2) {
        $gender = "F";
      }

      $age_at_scheduled_date = age_diff_return($value->cp_dob, $value->calculated_date);
      $no_of_days_overdue = scheduler_days_overdue_return_for_excl($value->calculated_date);

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value->reporting_id);
      $sheet->setCellValue('C' . $rows, date('d-m-Y', strtotime($value->incident_date)));
      $sheet->setCellValue('D' . $rows, $value->cp_name);
      $sheet->setCellValue('E' . $rows, $gender);
      $sheet->setCellValue('F' . $rows, date('d-m-Y', strtotime($value->calculated_date)));
      $sheet->setCellValue('G' . $rows, "Follow-up " . $value->fu_names);
      $sheet->setCellValue('H' . $rows, $age_at_scheduled_date);
      $sheet->setCellValue('I' . $rows, $no_of_days_overdue);


      $rows++;
    }


    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }
}
