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

      $this->validate_login(array('1', '5', '4', '2', '3','6'));

      if (strtoupper($this->input->server("REQUEST_METHOD")) == strtoupper('GET')){
        
        $from_date = date('Y-m-d', strtotime('-30 days'));;
        $to_date = date('Y-m-d');

          $date_frm = explode('-', $from_date);
          $updated_from_date = $date_frm['2'].'/'.$date_frm['1']."/".$date_frm['0'];

          $date_to = explode('-', $to_date);
          $updated_date_to = $date_to['2']."/".$date_to['1']."/".$date_to['0'];

          $_POST['from_date'] = $data['from_date'] = $updated_from_date;
          $_POST['to_date'] = $data['to_date'] = $updated_date_to;

          $login_id = $this->session->userdata('login_id');
          $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
          $stake_id_fk = $this->session->userdata('stake_id_fk');
          $district_id = $this->session->userdata('district');
          $block_id = $this->session->userdata('block');
          $subdiv = $this->session->userdata('subdiv');

          if($stake_id_fk==4){
            $report_result = $this->Pending_status_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
          }elseif($stake_id_fk == '6'){
            $report_result = $this->Pending_status_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
          }elseif($stake_id_fk == '1' || $stake_id_fk == '5'){
            $report_result = $this->Pending_status_report_model->pending_status_report_get_district($from_date, $to_date);
          }elseif($stake_id_fk == '2'){
            $report_result = $this->Pending_status_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
          }elseif($stake_id_fk == '3'){
            $report_result = $this->Pending_status_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
          }else{
            $report_result = $this->Pending_status_report_model->pending_status_report_get_district($from_date, $to_date);
          }  
         $data['report_result'] = $report_result;

      }else{

          $login_id = $this->session->userdata('login_id');
          $stake_holder_id_fk = $this->session->userdata('stake_holder_login_id_pk');
          $stake_id_fk = $this->session->userdata('stake_id_fk');
          $district_id = $this->session->userdata('district');
          $block_id = $this->session->userdata('block');
          $subdiv = $this->session->userdata('subdiv');

           $data['district_details'] = $this->Dashboard_model->district_details($login_id);
           $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
           $config = array(
             array(
              'field' => 'from_date',
              'label' => 'From Date',
              'rules' => 'trim|required|is_date_valid|callback_date_check_with_Todate['.$this->input->post('to_date').']'
             ),
             array(
              'field' => 'to_date',
              'label' => 'To Date',
              'rules' => 'trim|required|is_date_valid|callback_date_check_with_current'
             ),
           );
          $this->form_validation->set_rules($config);
          if ($this->form_validation->run() == TRUE) {
             $from_date = $this->us_date_format($this->input->post('from_date'));
             $to_date = $this->us_date_format($this->input->post('to_date'));

             if($stake_id_fk==4){
                $report_result = $this->Pending_status_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
              }elseif($stake_id_fk == '6'){
                $report_result = $this->Pending_status_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
              }elseif($stake_id_fk == '1' || $stake_id_fk == '5'){
                $report_result = $this->Pending_status_report_model->pending_status_report_get_district($from_date, $to_date);
              }elseif($stake_id_fk == '2'){
                $report_result = $this->Pending_status_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
              }elseif($stake_id_fk == '3'){
                $report_result = $this->Pending_status_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
              }else{
                $report_result = $this->Pending_status_report_model->pending_status_report_get_district($from_date, $to_date);
              }  

             //$report_result = $this->Pending_status_report_model->pending_status_report_get_district($from_date, $to_date);
             $data['report_result'] = $report_result;
          }
          
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
    if($this->session->userdata('district')!='')
    {
      $incident_district = $this->Master_model->get_district_name($this->session->userdata('district'));
      $data['user_dist']="PENDING DRAFTS REPORT DISTRICT NAME - ".$incident_district->district_name;
    }
    else
    {
      $data['user_dist'] = "PENDING DRAFTS REPORT DISTRICT WISE";
    }
    $fileName = 'Pending_Drafts_Report_District';
    $report_result = $this->Pending_status_report_model->pending_status_report_get_district($from_date, $to_date);
     // echo '<pre>'; print_r($report_result);die;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:L1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);
    $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1:C4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D1:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E1:E4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F1:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G1:G4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H1:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I1:I4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J1:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K1:K4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('L1:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C4:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
     $sheet->getStyle('E4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F4:G4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('H4:I4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J4:K4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

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

    // $sheet->mergeCells('A2:A3');
    // $sheet->mergeCells('B2:B3');
    $sheet->mergeCells('C3:E3');
    $sheet->mergeCells('F3:I3');
    $sheet->mergeCells('J3:L3');;
    $sheet->mergeCells('J2:K2');;


    $sheet->setCellValue('F1',  $data['user_dist']);
    $sheet->setCellValue('A2', 'From date :');
    $sheet->setCellValue('B2', $this->convert_date_format($from_date));
    $sheet->setCellValue('C2', '-');
    $sheet->setCellValue('D2', 'To date :');
    $sheet->setCellValue('E2', $this->convert_date_format($to_date));
    // $sheet->setCellValue('J2', 'District Name :');
    // $sheet->setCellValue('K2', $data['district']->district_name);

   
    $sheet->setCellValue('A4', 'Sl. No');
    $sheet->setCellValue('B4', 'Jurisdiction');
    $sheet->setCellValue('C3', 'DEO Level');
    $sheet->setCellValue('C4', 'Pending as Drafts');
    $sheet->setCellValue('D4', 'Completed but not forwarded');
    $sheet->setCellValue('E4', 'Forwarded');
    $sheet->setCellValue('F3', 'BDO/SDO');
    $sheet->setCellValue('F4', 'Pending as Drafts');
    $sheet->setCellValue('G4', 'Completed but not published');
    $sheet->setCellValue('H4', 'Received from DEO but not published');
    $sheet->setCellValue('I4', 'Published');
    $sheet->setCellValue('J3', 'CMPO');
    $sheet->setCellValue('J4', 'Pending as Drafts');
    $sheet->setCellValue('K4', 'Completed but not published');
    $sheet->setCellValue('L4', 'Published');

    $rows = 5;
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
      $sheet->setCellValue('G' . $rows, $value['bdo_sdo_level_not_publish_count']!=''?$value['bdo_sdo_level_not_publish_count']:0);
      // $sheet->setCellValue('G' . $rows, $value['bdo_sdo_level_not_publish_count']);
      $sheet->setCellValue('H' . $rows, $bdo_sdo_level_received_deo_not_published_count);
      $sheet->setCellValue('I' . $rows, $bdo_sdo_level_published_count);

      $sheet->setCellValue('J' . $rows, $cmpo_level_draft_pending_count);
      $sheet->setCellValue('K' . $rows,  $value['cmpo_level_draft_forward_pending_count']!=''?$value['cmpo_level_draft_forward_pending_count']:0);
      $sheet->setCellValue('L' . $rows, $cmpo_level_published_count);
      $rows++;
    }
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'deo_level_draft_pending_count')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'deo_level_not_forwarded_count')));
      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'deo_level_forwarded_count')));

      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_draft_pending_count')));
      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_not_publish_count')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_received_deo_not_published_count')));
      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_published_count')));

      $sheet->setCellValue('J' . $total_row,array_sum(array_column($report_result, 'cmpo_level_draft_pending_count')));
      $sheet->setCellValue('K' . $total_row,array_sum(array_column($report_result, 'cmpo_level_draft_forward_pending_count')));
      $sheet->setCellValue('L' . $total_row,array_sum(array_column($report_result, 'cmpo_level_published_count')));

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
    $data['district'] = $this->Master_model->get_district_name($district_id);

    $report_result = $this->Pending_status_report_model->get_sd_block_count_details($district_id, $from_date, $to_date);
    $fileName = 'Pending_Drafts_Report_Block_Municipality_Wise';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();


    $sheet->getStyle('A1:L1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);
    $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1:C4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D1:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E1:E4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F1:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G1:G4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H1:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I1:I4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J1:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K1:K4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('L1:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C4:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F4:G4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('H4:I4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J4:K4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

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

    $sheet->mergeCells('C3:E3');
    $sheet->mergeCells('F3:I3');
    $sheet->mergeCells('J3:L3');
    // $sheet->mergeCells('A1:L1');
    $sheet->getStyle('A1:L1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);


    $sheet->mergeCells('A1:I1');
    $sheet->setCellValue('A1', 'PENDING DRAFTS LIST REPORT (BLOCK/MUNICIPALITY WISE) FOR '.$data['district']->district_name);
    $sheet->setCellValue('A2', 'From date :');
    $sheet->setCellValue('B2',  $this->convert_date_format($from_date));
    $sheet->setCellValue('C2', '-');
    $sheet->setCellValue('D2', 'To date :');
    $sheet->setCellValue('E2', $this->convert_date_format($to_date));
    // $sheet->setCellValue('K2', 'District Name');
    // $sheet->setCellValue('L2',  $data['district']->district_name);

   
    $sheet->setCellValue('A4', 'Sl. No');
    $sheet->setCellValue('B4', 'Jurisdiction');
    $sheet->setCellValue('C3', 'DEO Level');
    $sheet->setCellValue('C4', 'Pending as Drafts');
    $sheet->setCellValue('D4', 'Completed but not forwarded');
    $sheet->setCellValue('E4', 'Forwarded');
    $sheet->setCellValue('F3', 'BDO/SDO');
    $sheet->setCellValue('F4', 'Pending as Drafts');
    $sheet->setCellValue('G4', 'Completed but not published');
    $sheet->setCellValue('H4', 'Received from DEO but not published');
    $sheet->setCellValue('I4', 'Published');
    $sheet->setCellValue('J3', 'CMPO');
    $sheet->setCellValue('J4', 'Pending as Drafts');
    $sheet->setCellValue('K4', 'Completed but not published');
    $sheet->setCellValue('L4', 'Published');

    $rows = 5;
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
      $sheet->setCellValue('G' . $rows, $value['bdo_sdo_level_not_publish_count']!=''?$value['bdo_sdo_level_not_publish_count']:0);
      // $sheet->setCellValue('G' . $rows, $value['bdo_sdo_level_not_publish_count']);
      $sheet->setCellValue('H' . $rows, $bdo_sdo_level_received_deo_not_published_count);
      $sheet->setCellValue('I' . $rows, $bdo_sdo_level_published_count);

      $sheet->setCellValue('J' . $rows, $cmpo_level_draft_pending_count);
      $sheet->setCellValue('K' . $rows,  $value['cmpo_level_draft_forward_pending_count']!=''?$value['cmpo_level_draft_forward_pending_count']:0);
      $sheet->setCellValue('L' . $rows, $cmpo_level_published_count);
      $rows++;
    }
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'deo_level_draft_pending_count')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'deo_level_not_forwarded_count')));
      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'deo_level_forwarded_count')));

      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_draft_pending_count')));
      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_not_publish_count')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_received_deo_not_published_count')));
      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_published_count')));

      $sheet->setCellValue('J' . $total_row,array_sum(array_column($report_result, 'cmpo_level_draft_pending_count')));
      $sheet->setCellValue('K' . $total_row,array_sum(array_column($report_result, 'cmpo_level_draft_forward_pending_count')));
      $sheet->setCellValue('L' . $total_row,array_sum(array_column($report_result, 'cmpo_level_published_count')));

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
    $data['block_id'] = $block_id;
    $result_block_dist = $this->Master_model->get_dist_by_block($data);
    $report_result = $this->Pending_status_report_model->get_ward_gp_count_details($block_id, $from_date, $to_date);
    $fileName = 'Pending_Drafts_Report_Warp_GP_Wise';
    // print_r($report_result); die();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

   
    $sheet->getStyle('A1:L1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);
    $sheet->getStyle('A1:A4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1:C4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D1:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E1:E4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F1:F4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G1:G4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('H1:H4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('I1:I4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J1:J4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('K1:K4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('L1:L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1:B4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C4:D4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('E4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F4:G4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('H4:I4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('J4:K4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
    $sheet->getStyle('L4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

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

    $sheet->mergeCells('C3:E3');
    $sheet->mergeCells('F3:I3');
    $sheet->mergeCells('J3:L3');
    // $sheet->mergeCells('A1:L1');
    $sheet->mergeCells('K2:L2');
    $sheet->getStyle('A1:L1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

    // $sheet->setCellValue('B4', 'GP Name / Ward No');
    $sheet->mergeCells('A1:I1');
    $sheet->setCellValue('A1', 'PENDING DRAFTS LIST REPORT (GP/WARD WISE) FOR '.$result_block_dist['block_name']);


    $sheet->mergeCells('J1:L1');
    $sheet->setCellValue('J1', 'District Name :'.$result_block_dist['district_name']);
    $sheet->setCellValue('A2', 'From date :');
    $sheet->setCellValue('B2', $this->convert_date_format($from_date));
    $sheet->setCellValue('C2', '-');
    $sheet->setCellValue('D2', 'To date :');
    $sheet->setCellValue('E2', $this->convert_date_format($to_date));

    $sheet->setCellValue('A4', 'Sl. No');
    $sheet->setCellValue('B1', 'GP Name / Ward No');
    $sheet->setCellValue('C3', 'DEO Level');
    $sheet->setCellValue('C4', 'Pending as Drafts');
    $sheet->setCellValue('D4', 'Completed but not forwarded');
    $sheet->setCellValue('E4', 'Forwarded');
    $sheet->setCellValue('F3', 'BDO/SDO');
    $sheet->setCellValue('F4', 'Pending as Drafts');
    $sheet->setCellValue('G4', 'Completed but not published');
    $sheet->setCellValue('H4', 'Received from DEO but not published');
    $sheet->setCellValue('I4', 'Published');
    $sheet->setCellValue('J3', 'CMPO');
    $sheet->setCellValue('J4', 'Pending as Drafts');
    $sheet->setCellValue('K4', 'Completed but not published');
    $sheet->setCellValue('L4', 'Published');


    $rows = 5;
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
      $sheet->setCellValue('G' . $rows, $value['bdo_sdo_level_not_publish_count']!=''?$value['bdo_sdo_level_not_publish_count']:0);
      // $sheet->setCellValue('G' . $rows, $value['bdo_sdo_level_not_publish_count']);
      $sheet->setCellValue('H' . $rows, $bdo_sdo_level_received_deo_not_published_count);
      $sheet->setCellValue('I' . $rows, $bdo_sdo_level_published_count);

      $sheet->setCellValue('J' . $rows, $cmpo_level_draft_pending_count);
      $sheet->setCellValue('K' . $rows,  $value['cmpo_level_draft_forward_pending_count']!=''?$value['cmpo_level_draft_forward_pending_count']:0);
      $sheet->setCellValue('L' . $rows, $cmpo_level_published_count);
      $rows++;
    }
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'L'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'deo_level_draft_pending_count')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'deo_level_not_forwarded_count')));
      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'deo_level_forwarded_count')));

      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_draft_pending_count')));
      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_not_publish_count')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_received_deo_not_published_count')));
      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'bdo_sdo_level_published_count')));

      $sheet->setCellValue('J' . $total_row,array_sum(array_column($report_result, 'cmpo_level_draft_pending_count')));
      $sheet->setCellValue('K' . $total_row,array_sum(array_column($report_result, 'cmpo_level_draft_forward_pending_count')));
      $sheet->setCellValue('L' . $total_row,array_sum(array_column($report_result, 'cmpo_level_published_count')));

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
