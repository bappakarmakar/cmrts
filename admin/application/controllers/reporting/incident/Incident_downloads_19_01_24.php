<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Incident_downloads extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('incident/incident_downloads_model');
    $this->load->model('common/Master_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
      2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
      3 => $this->config->item('theme_uri').'assets/js/incident_form.js',
    );
  }

  public function List_Download_Excel()
  {

    $start_date = isset($_GET['start_date'])?$_GET['start_date']:'';
    $end_date = isset($_GET['end_date'])?$_GET['end_date']:'';
      if($this->session->userdata('district')!='')
      {
        $incident_district = $this->Master_model->get_district_name($this->session->userdata('district'));
        $data['user_dist']=" - ".$incident_district->district_name;
      }
      else
      {
        $data['user_dist'] = '';
      }
      // echo $data['user_dist'];die;
    // echo'<pre>'; print_r($data['user_dist']); die;
    // echo $incident_district->district_name;die;
    // echo $start_date.'============='.$end_date;die;


    $fileName = 'Intervention_Report_'.date('d_m_Y');  
    // $incident_data = $this->incident_downloads_model->incident_list_download_excel();
    $cp_two_status = '';
    $cp_one_status = '';

    if(empty($start_date) || empty($end_date))
    {
      // $title_line = 1;
      // $header_line = 0;
      // $thead_line = $header_line + 2;
      // $tdata = $thead_line + 1;
      $incident_data = $this->incident_downloads_model->incident_list_download_excel();
    }
    else
    {
      $incident_data = $this->incident_downloads_model->incident_list_download_btwndate_excel($start_date,$end_date);


    }
    // echo "<pre>";
    // print_r($incident_data);die;
    // print_r($_SESSION);die;

      $title_line = 1;
      $header_line = $title_line + 1;
      $thead_line = $header_line + 1;
      $tdata = $thead_line + 1;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(30);
    $sheet->getColumnDimension('E')->setWidth(30);
    $sheet->getColumnDimension('F')->setWidth(15);
    $sheet->getColumnDimension('G')->setWidth(10);
    $sheet->getColumnDimension('H')->setWidth(60);
    $sheet->getColumnDimension('I')->setWidth(30);
    $sheet->getColumnDimension('J')->setWidth(30);
    $sheet->getColumnDimension('K')->setWidth(15);
    $sheet->getColumnDimension('L')->setWidth(10);
    $sheet->getColumnDimension('M')->setWidth(60);
    $sheet->getColumnDimension('N')->setWidth(30);

    $styleArray = array(
      'font' => array(
      'bold' => true,
      ),
      'alignment' => array(
      'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
      ),
    );

    $titleArray = array(
      'font' => array(
      'bold' => true,
      'size' => 14,
      ),
      'alignment' => array(
      'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      'wrapText' => true,
      ),
      'fill' => array(
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => array(
            'argb' => '33ccff',
      ),
      ),
      'height' => '20',
    );

    $HeaderArray = array(
      'font' => array(
      'bold' => true,
      'size' => 12,
      ),
      'alignment' => array(
      'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
      'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
      'wrapText' => true,
      ),
      'fill' => array(
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => array(
            'argb' => 'F2F2F2',
      ),
      ),
      'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
         'height' => '20',
    );

    $TdataArray = array(
      'font' => array(
        'bold' => true,
        'size' => 11,
      ),
      'alignment' => array(
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'wrapText' => true,
     ),
      'fill' => array(
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => array(
        'argb' => 'FFFFFF',
        ),
      ),
      'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
      // 'width' => '30', // Set cell width (in characters)
      'height' => '20', // Set cell height (in points)
    );

    

    // --------------------------------Title line construct --------------------------------------------------------------

  
    $sheet->setCellValue('A'.$title_line, 'INTERVENTION REPORT LIST'.$data['user_dist']);
    $sheet->getStyle('A'.$title_line)->applyFromArray($titleArray);
    $sheet->mergeCells('A'.$title_line.':'.'N'.$title_line);    
    // --------------------------------Header line construct --------------------------------------------------------------
    if(!empty($start_date) || !empty($end_date))
    {
      $sheet->setCellValue('A'.$header_line, 'From Date');
      $sheet->setCellValue('B'.$header_line, $start_date);
      $sheet->setCellValue('C'.$header_line, 'To Date');
      $sheet->setCellValue('D'.$header_line, $end_date);
    }
      

    // $sheet->getStyle('A'.$title_line.':'.'N'.$title_line)->applyFromArray($HeaderArray);
    $sheet->getStyle('A'.$thead_line.':'.'N'.$thead_line)->applyFromArray($HeaderArray);
    $sheet->getStyle('A'.$tdata.':'.'N'.$tdata)->applyFromArray($TdataArray);
    // $sheet->mergeCells('A'.$header_line.':'.'N'.$header_line); 
    // $sheet->getStyle('A'.$tdata)->applyFromArray($TdataArray);

    // $sheet->setCellValue('A'.$thead_line, 'Incident');
    $sheet->setCellValue('A'.$thead_line, 'Sl. No');
    $sheet->setCellValue('B'.$thead_line, 'Intervention ID');
    $sheet->setCellValue('C'.$thead_line, 'Intervention Date');
    $sheet->setCellValue('D'.$thead_line, 'SD/Block');

    $sheet->setCellValue('E'.$thead_line, 'Contracting Party 1');
    $sheet->setCellValue('E'.$thead_line, 'CP 1 Name');
    $sheet->setCellValue('F'.$thead_line, 'CP 1 Gender');       
    $sheet->setCellValue('G'.$thead_line, 'CP 1 Age');       
    $sheet->setCellValue('H'.$thead_line, 'CP 1 Address'); 
    $sheet->setCellValue('I'.$thead_line, 'CP 1 Status'); 

    $sheet->setCellValue('J'. $thead_line, 'Contracting Party 2');
    $sheet->setCellValue('J'. $thead_line, 'CP 2 Name');       
    $sheet->setCellValue('K'. $thead_line, 'CP 2 Gender');       
    $sheet->setCellValue('L'. $thead_line, 'CP 2 Age');       
    $sheet->setCellValue('M'. $thead_line, 'CP 2 Address');    
    $sheet->setCellValue('N'. $thead_line, 'CP 2 Status');             
    $rows = $tdata;
    $tdata = $tdata - 1;
    $c = 1;
    foreach ($incident_data as $value){
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
        $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($value->cp_2_block_id);
        if(!empty($cp_two_block_details)){
           if($cp_two_block_details->rural_urban == 'U'){
              $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($value->cp_2_ward_gp);
           }else{
              $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($value->cp_2_ward_gp);
           }
        }else{
           $cp_two_ward_gp_details = array();
        }
        $cp_one_ward_gp_name = ($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';
        if($value->cp_1_state == 1){
          $cp_one_address = $value->cp_1_district.', '.$value->cp_1_block.', '.$cp_one_ward_gp_name;
        }else{
          $cp_one_address = $value->cp_1_address;
        }
        $cp_two_ward_gp_name = ($cp_two_ward_gp_details)?$cp_two_ward_gp_details->cp_two_ward_gp:'';
        if($value->cp_2_state == 1){
          $cp_two_address = $value->cp_2_district.', '.$value->cp_2_block.', '.$cp_two_ward_gp_name;
        }else{
          $cp_two_address = $value->cp_2_address;
        }
        $cp_1_current_status = cp_status($value->current_status, $value->cp_1_id_pk, $value->cp_1_age);
        $cp_2_current_status = cp_status($value->current_status, $value->cp_2_id_pk, $value->cp_2_age);

        $sheet->setCellValue('A' . $rows, $c++);
        $sheet->setCellValue('B' . $rows, $value->reporting_id);
        $sheet->setCellValue('C' . $rows, date('d-m-Y', strtotime($value->incident_date)));
        $sheet->setCellValue('D' . $rows, $value->incident_block);

        $sheet->setCellValue('E' . $rows, $value->cp_1_name);
        $sheet->setCellValue('F' . $rows, $value->cp_1_gender_value);
        $sheet->setCellValue('G' . $rows, $value->cp_1_age);
        $sheet->setCellValue('H' . $rows, $cp_one_address);
        $sheet->setCellValue('I' . $rows, $cp_1_current_status);

        $sheet->setCellValue('J' . $rows, $value->cp_2_name);
        $sheet->setCellValue('K' . $rows, $value->cp_2_gender_value);
        $sheet->setCellValue('L' . $rows, $value->cp_2_age);
        $sheet->setCellValue('M' . $rows, $cp_two_address);

        // $sheet->setCellValue('O' . $rows, $cp_2_current_status);
        if($value->cp_two_is_available==1)
        {                     
          $sheet->setCellValue('N' . $rows, $cp_2_current_status);
        }
        elseif ($value->cp_two_is_available==2 || $value->cp_two_is_available =='')
        {
          $sheet->setCellValue('N' . $rows, 'CP2 is not available');
        }
        else
        {
          $sheet->setCellValue('N' . $rows, ''); 
        } 

        $rows++;
        $tdata++;
        $sheet->getStyle('A'.$tdata.':'.'N'.$tdata)->applyFromArray($TdataArray);


      }

    
    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  
}

  public function download_incident($reporting_id)
  {

    $data['doc_availble_type'] = $this->incident_downloads_model->get_document_type_details();

      // echo"<pre>";print_r($data['doc_availble_type']);die;
      if($this->session->userdata('district')!='')
      {
        $incident_district = $this->Master_model->get_district_name($this->session->userdata('district'));
        $data['user_dist']=" - ".$incident_district->district_name;
      }
      else
      {
        $data['user_dist'] = '';
      }
      
      $login_id = $this->session->userdata('login_id');
      $reporting_id = base64_decode($reporting_id);
      $incident_id = $this->incident_downloads_model->cm_incident_id_by_reporting_id($reporting_id);
      $data['incident_id_pk'] = $incident_id;
      // $dompdf = new Dompdf\DOMPDF();
      $dompdf = new Dompdf\Dompdf();
       $data['local_persons_involved'] = $this->incident_downloads_model->cm_incident_report_local_persons_involved_details($incident_id);
    $data['officials_involved'] = $this->incident_downloads_model->cm_incident_report_officials_involved_details($incident_id);
    $data['incident_edit_details']=$incident_edit_details= $this->incident_downloads_model->incident_download_details($incident_id);

    // echo "<pre>";print_r($data['incident_edit_details']);die;
    $data['state'] = $this->Master_model->get_state_name();
    $data['districts'] = $this->Master_model->get_district();
    $data['districts_name'] = $this->Master_model->get_district_name($this->session->userdata('district'));
    $data['block_name'] = $this->Master_model->get_block_name($this->session->userdata('block'));
    $data['block_details_name'] = $this->Master_model->get_block($this->session->userdata('district'));
    $incident_block = ($incident_edit_details)?$incident_edit_details['block']:NULL;
    $data['Incident_Ward_Gp_Block'] = $Incident_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($incident_block);
    if(!empty($Incident_Ward_Gp_Block)){
      if($Incident_Ward_Gp_Block->rural_urban == 'U'){
        $data['Incident_Ward'] = $this->Master_model->get_ward($incident_block);
        $data1['inc_ward'] = $this->Master_model->Get_ward_by_wardid($data['incident_edit_details']['ward_gp']);
        $data['ward_gp_name'] = $data1['inc_ward']['ward_no'];
      }else{
        $data['Incident_Gp'] = $this->Master_model->get_gp($incident_block);
        $data1['inc_gp'] = $this->Master_model->Get_gp_by_gpid($data['incident_edit_details']['ward_gp']);
        $data['ward_gp_name'] = $data1['inc_gp']['gp_name'];
      }
    }
    $data['sdo_deo_level_block_name'] = $this->Master_model->get_sdo_deo_level_block($this->session->userdata('subdiv'));
    $data['ward_gp_details'] = $this->Master_model->BDO_DEO_Get_Ward_GP($this->session->userdata('block'));
    $data['marriage_details'] = $this->Master_model->get_marriage_details();
    $data['prevented_details'] = $this->Master_model->get_prevented_details();
    $data['location_description_details'] = $this->Master_model->get_location_description_details();
    $data['information_received_details'] = $this->Master_model->get_information_received_details();
    $data['gender_details'] = $this->Master_model->get_gender_details();
    $data['social_category_details'] = $this->Master_model->get_social_category_details();
    $data['religion_details'] = $this->Master_model->get_religion_details();
    $data['document_type_details'] = $this->Master_model->get_document_type_details();
    $data['highest_education_details'] = $this->Master_model->get_highest_education_details();
    $data['minor_details'] = $this->Master_model->get_minor_details();
    $data['block_details'] = $this->Master_model->block();
    $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
    $incident_district = $this->input->post('incident_district');
    $data['incidentBlock'] = $this->Master_model->get_block($incident_district);
    $identity_district = ($incident_edit_details)?$incident_edit_details['identity_district_id']:NULL;
    $data['identityBlock'] = $this->Master_model->get_block($identity_district);
    // $identity_block = $this->input->post('identity_block');
    $identity_block = ($incident_edit_details)?$incident_edit_details['identity_block_id']:NULL;
    $data['Identity_Ward_Gp_Block'] = $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($identity_block);
    if(!empty($Identity_Ward_Gp_Block)){
      if($Identity_Ward_Gp_Block->rural_urban == 'U'){
        $data['Identity_Ward'] = $this->Master_model->get_ward($identity_block);
        // $data['inc_ward'] = $this->Master_model->get_ward_details($data['incident_edit_details']['ward_gp']);
      }else{
        $data['Identity_Gp'] = $this->Master_model->get_gp($identity_block);
        $data1['inc_gp'] = $this->Master_model->Get_gp_by_gpid($data['incident_edit_details']['ward_gp']);
        $data['ward_gp_name'] = $data1['inc_gp']['gp_name'];
      }
    }

    $cp_one_state = ($incident_edit_details)?$incident_edit_details['cp_1_state']:NULL;
    $data['CP_One_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_one_state);
    $cp_one_district = ($incident_edit_details)?$incident_edit_details['cp_1_district_id']:NULL;
    $data['cponeBlock'] = $this->Master_model->get_block($cp_one_district);
    // $cp_one_block = $this->input->post('cp_one_block');
    $cp_one_block = ($incident_edit_details)?$incident_edit_details['cp_1_block_id']:NULL;
    $data['Cp_One_Ward_Gp_Block'] = $Cp_One_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($cp_one_block);
    if(!empty($Cp_One_Ward_Gp_Block)){
      if($Cp_One_Ward_Gp_Block->rural_urban == 'U'){
        $data['Cp_One_Ward'] = $this->Master_model->get_ward($cp_one_block);
      }else{
        $data['Cp_One_Gp'] = $this->Master_model->get_gp($cp_one_block);
      }
    }
    $cp_one_cwc_district = $this->input->post('cp_one_cwc_district');
    $data['cponecwcBlock'] = $this->Master_model->get_block($cp_one_cwc_district);

    $cp_two_state = ($incident_edit_details)?$incident_edit_details['cp_2_state']:NULL;
    $data['CP_Two_District_Details'] = $this->Master_model->Get_District_Details_Name($cp_two_state);
    $cp_two_district = ($incident_edit_details)?$incident_edit_details['cp_2_district_id']:NULL;
    $data['cptwoBlock'] = $this->Master_model->get_block($cp_two_district);
    // $cp_two_block = $this->input->post('cp_two_block');
    $cp_two_block = ($incident_edit_details)?$incident_edit_details['cp_2_block_id']:NULL;

    $data['Cp_Two_Ward_Gp_Block'] = $Cp_Two_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($cp_two_block);
    if(!empty($Cp_Two_Ward_Gp_Block)){
      if($Cp_Two_Ward_Gp_Block->rural_urban == 'U'){
        $data['Cp_Two_Ward'] = $this->Master_model->get_ward($cp_two_block);
      }else{
        $data['Cp_Two_Gp'] = $this->Master_model->get_gp($cp_two_block);
      }
    }
    $cp_two_cwc_district = $this->input->post('cp_two_cwc_district');
    $data['cptwocwcBlock'] = $this->Master_model->get_block($cp_two_cwc_district);
    $police_case_district = $this->input->post('police_case_district');
    $data['policecaseBlock'] = $this->Master_model->get_block($police_case_district);


// echo "<pre>";

//             echo $data['incident_edit_details']['ward_gp'];
//             // print_r($data['incident_edit_details']);
// //             // print_r($data['Incident_Ward_Gp_Block']);
// //             // print_r($data['Cp_One_Ward']);
// //             // print_r($data['Cp_One_Gp']);
//             // print_r($data['ward_gp_name']);
//             die;
      // $this->load->view($this->config->item('theme').'reporting/incident/Incident_Generated_Download_View', $data);
      $html = $this->load->view($this->config->item('theme').'reporting/incident/Incident_Generated_Download_View', $data, true);
      $dompdf->load_html($html);
      $dompdf->setPaper('A4', 'portrait');
      $filename = 'Intervention report - '.$reporting_id.".pdf";
      $dompdf->render();
      $dompdf->stream($filename); 
      sleep(2);
  }
}
