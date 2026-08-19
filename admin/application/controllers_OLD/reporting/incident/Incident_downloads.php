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

    // $start_date = isset($_GET['start_date'])?$_GET['start_date']:'';
    // $end_date = isset($_GET['end_date'])?$_GET['end_date']:'';
    $start_date = isset($_GET['start_date'])?$this->us_date_format($_GET['start_date']):'';
    $end_date = isset($_GET['end_date'])?$this->us_date_format($_GET['end_date']):'';
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
      $data['start_date'] = isset($_GET['start_date'])?$_GET['start_date']:'';
      $data['end_date'] = isset($_GET['end_date'])?$_GET['end_date']:'';


    // $fileName = 'Intervention_Report_'.date('d_m_Y');  
    $fileName = 'Register_Intervention_'.date('Y_m_d');  
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

    // echo"<pre>";print_r($incident_data);die;

    $marriage_details = get_incident_marriage_details();
    $marriage_details_check = array_column($marriage_details,'description', 'cm_marriage_master_id_pk');
    $prevented_details = array_column(get_prevented_master(),'description', 'cm_incident_report_details_master_id_pk');
    $location_description_details = array_column(get_location_description_master(),'description', 'cm_location_master_id_pk');

    $social_category_details = array_column(get_social_category_master(),'description', 'cm_social_category_master_id_pk');

    $religion_details = array_column(get_religion_master(),'description', 'cm_religion_master_id_pk');

    $highest_education_details = array_column(get_highest_educational_attainment_master(),'description', 'cm_highest_educational_attainment_master_id_pk');

    // echo "<pre>";
    // print_r($marriage_details_check);
    // print_r($prevented_details);
    // print_r($location_description_details);
    // print_r($social_category_details);
    // print_r($religion_details);
    // print_r($highest_education_details);


    // die;
    // echo "<br>" ;
    // print_r($marriage_details_check);
    // echo "<br>" ;

    // echo $marriage_details_check[0];die;
    // print_r($incident_data);die;
    // print_r($_SESSION);die;

      $title_line = 1;
      $header_line = $title_line + 1;
      $thead_line = $header_line + 1;
      $tdata = $thead_line + 2;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->getColumnDimension('B')->setWidth(20);
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('D')->setWidth(20);
    $sheet->getColumnDimension('E')->setWidth(20);
    $sheet->getColumnDimension('F')->setWidth(20);
    $sheet->getColumnDimension('G')->setWidth(20);
    $sheet->getColumnDimension('H')->setWidth(20);
    $sheet->getColumnDimension('I')->setWidth(20);
    $sheet->getColumnDimension('J')->setWidth(20);
    $sheet->getColumnDimension('K')->setWidth(20);
    $sheet->getColumnDimension('L')->setWidth(20);
    $sheet->getColumnDimension('M')->setWidth(20);
    $sheet->getColumnDimension('N')->setWidth(20);
    $sheet->getColumnDimension('O')->setWidth(20);
    $sheet->getColumnDimension('P')->setWidth(20);
    $sheet->getColumnDimension('Q')->setWidth(20);
    $sheet->getColumnDimension('R')->setWidth(20);
    $sheet->getColumnDimension('S')->setWidth(20);
    $sheet->getColumnDimension('T')->setWidth(20);
    $sheet->getColumnDimension('U')->setWidth(20);
    $sheet->getColumnDimension('V')->setWidth(20);

    $sheet->getColumnDimension('W')->setWidth(20);
    $sheet->getColumnDimension('X')->setWidth(20);
    $sheet->getColumnDimension('Y')->setWidth(20);
    $sheet->getColumnDimension('Z')->setWidth(20);
    $sheet->getColumnDimension('AA')->setWidth(20);
    $sheet->getColumnDimension('AB')->setWidth(20);
    $sheet->getColumnDimension('AC')->setWidth(20);
    $sheet->getColumnDimension('AD')->setWidth(20);
    $sheet->getColumnDimension('AE')->setWidth(20);
    $sheet->getColumnDimension('AF')->setWidth(20);
    $sheet->getColumnDimension('AG')->setWidth(20);
    $sheet->getColumnDimension('AH')->setWidth(20);
    $sheet->getColumnDimension('AI')->setWidth(20);
    $sheet->getColumnDimension('AJ')->setWidth(20);

    // $sheet->getColumnDimension('L')->setWidth(10);
    // $sheet->getColumnDimension('M')->setWidth(60);
    // $sheet->getColumnDimension('N')->setWidth(30);

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
    $sheet->mergeCells('A'.$title_line.':'.'AJ'.$title_line);    
    // --------------------------------Header line construct --------------------------------------------------------------
    if(!empty($start_date) || !empty($end_date))
    {
      $sheet->setCellValue('A'.$header_line, 'From Date');
      $sheet->setCellValue('B'.$header_line, $data['start_date']);
      $sheet->setCellValue('C'.$header_line, 'To Date');
      $sheet->setCellValue('D'.$header_line, $data['end_date']);
    }
      

    // $sheet->getStyle('A'.$title_line.':'.'N'.$title_line)->applyFromArray($HeaderArray);
    $sheet->getStyle('A'.$thead_line.':'.'AJ'.$thead_line)->applyFromArray($HeaderArray);
    $sheet->getStyle('A' . $thead_line . ':AJ' . ($thead_line + 1))->applyFromArray($HeaderArray);
    $sheet->getStyle('A'.$tdata.':'.'AJ'.$tdata)->applyFromArray($TdataArray);
    // $sheet->mergeCells('A'.$header_line.':'.'N'.$header_line); 
    // $sheet->getStyle('A'.$tdata)->applyFromArray($TdataArray);

    // $sheet->setCellValue('A'.$thead_line, 'Incident');

    //Intervention data header
    $sheet->setCellValue('A'.$thead_line, 'Sl. No');
    $sheet->setCellValue('B'.$thead_line, 'Intervention ID');
    $sheet->setCellValue('C'.$thead_line, 'Intervention Date');
    $sheet->setCellValue('D'.$thead_line, 'Marriage Date');
    $sheet->setCellValue('E'.$thead_line, 'Pre/day/Post');
    $sheet->setCellValue('F'.$thead_line, 'Prevented / Not prevented');
    $sheet->setCellValue('G'.$thead_line, 'District');       
    $sheet->setCellValue('H'.$thead_line, 'Subdivision/block');       
    $sheet->setCellValue('I'.$thead_line, 'Ward / GP'); 
    $sheet->setCellValue('J'.$thead_line, 'Police Station'); 
    $sheet->setCellValue('K'. $thead_line, 'Description of location');

    //CP 1 data header
    $sheet->setCellValue('L'. $thead_line, 'Contracting Party 1');
    $sheet->setCellValue('L' . ($thead_line + 1), 'Name');
    $sheet->setCellValue('M' . ($thead_line + 1), 'State');
    $sheet->setCellValue('N' . ($thead_line + 1), 'District');
    $sheet->setCellValue('O' . ($thead_line + 1), 'Sub-Division/Block');
    $sheet->setCellValue('P' . ($thead_line + 1), 'Ward/GP');
    $sheet->setCellValue('Q' . ($thead_line + 1), 'Gender');
    $sheet->setCellValue('R' . ($thead_line + 1), 'DOB');
    $sheet->setCellValue('S' . ($thead_line + 1), 'Age');
    $sheet->setCellValue('T' . ($thead_line + 1), 'Social Category');
    $sheet->setCellValue('U' . ($thead_line + 1), 'Religion');
    $sheet->setCellValue('V' . ($thead_line + 1), 'Highest Educational attainment');
    $sheet->setCellValue('W' . ($thead_line + 1), 'Status');

    //CP 2 data header
    $sheet->setCellValue('X'. $thead_line, 'Contracting Party 2');
    $sheet->setCellValue('X' . ($thead_line + 1), 'Name');
    $sheet->setCellValue('Y' . ($thead_line + 1), 'State');
    $sheet->setCellValue('Z' . ($thead_line + 1), 'District');
    $sheet->setCellValue('AA' . ($thead_line + 1), 'Sub-Division/Block');
    $sheet->setCellValue('AB' . ($thead_line + 1), 'Ward/GP');
    $sheet->setCellValue('AC' . ($thead_line + 1), 'Gender');
    $sheet->setCellValue('AD' . ($thead_line + 1), 'DOB');
    $sheet->setCellValue('AE' . ($thead_line + 1), 'Age');
    $sheet->setCellValue('AF' . ($thead_line + 1), 'Social Category');
    $sheet->setCellValue('AG' . ($thead_line + 1), 'Religion');
    $sheet->setCellValue('AH' . ($thead_line + 1), 'Highest Educational attainment');
    $sheet->setCellValue('AI' . ($thead_line + 1), 'Last Saved At');
    $sheet->setCellValue('AJ' . ($thead_line + 1), 'Status');
  


    // $sheet->setCellValue('J'. $thead_line, 'CP 2 Name');       
    // $sheet->setCellValue('K'. $thead_line, 'CP 2 Gender');       
    // $sheet->setCellValue('L'. $thead_line, 'CP 2 Age');       
    // $sheet->setCellValue('M'. $thead_line, 'CP 2 Address');    
    // $sheet->setCellValue('N'. $thead_line, 'CP 2 Status');  

    $sheet->mergeCells('A' . $thead_line . ':A' . ($thead_line + 1));           
    $sheet->mergeCells('B' . $thead_line . ':B' . ($thead_line + 1));           
    $sheet->mergeCells('C' . $thead_line . ':C' . ($thead_line + 1));           
    $sheet->mergeCells('D' . $thead_line . ':D' . ($thead_line + 1));           
    $sheet->mergeCells('E' . $thead_line . ':E' . ($thead_line + 1));           
    $sheet->mergeCells('F' . $thead_line . ':F' . ($thead_line + 1));           
    $sheet->mergeCells('G' . $thead_line . ':G' . ($thead_line + 1));           
    $sheet->mergeCells('H' . $thead_line . ':H' . ($thead_line + 1));           
    $sheet->mergeCells('I' . $thead_line . ':I' . ($thead_line + 1));           
    $sheet->mergeCells('J' . $thead_line . ':J' . ($thead_line + 1));           
    $sheet->mergeCells('K' . $thead_line . ':K' . ($thead_line + 1));           
    $sheet->mergeCells('L' . $thead_line . ':W' . $thead_line);           
    $sheet->mergeCells('X' . $thead_line . ':AJ' . $thead_line);           
    $rows = $tdata;
    $tdata = $tdata - 1;  
    $c = 1;
    foreach ($incident_data as $value)
    {


      $created_at = ($value->created_at)?date('d/m/Y',strtotime($value->created_at)):'';
      $incident_block_details = Get_Incident_List_CP_One_Block_Details($value->block);

        // print_r($incident_block_details);die;

        if(!empty($incident_block_details))
        {
          if($incident_block_details->rural_urban == 'U')
          {
            $incident_ward_gp_details = Get_Incident_List_Incident_Ward_Details($value->ward_gp);
          }
          else
          {
            $incident_ward_gp_details = Get_Incident_List_Incident_GP_Details($value->ward_gp);
          }
        }
        else
        {
          $incident_ward_gp_details = array();
        }
        // echo"<pre>";print_r($incident_ward_gp_details);die;
        $incident_ward_gp_name = ($incident_ward_gp_details)?$incident_ward_gp_details->incident_ward_gp:NULL;

        //CP ONE WARD GP DETAILS 
        $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_1_block_id);
        if(!empty($cp_one_block_details))
        {
           if($cp_one_block_details->rural_urban == 'U')
           {
              $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_1_ward_gp);
           }
           else
           {
              $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_1_ward_gp);
           }
        }
        else
        {
           $cp_one_ward_gp_details = array();
        }

        $cp_one_ward_gp_name = ($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:NULL;
        //CP TWO WARD GP DETAILS 
        $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($value->cp_2_block_id);
        if(!empty($cp_two_block_details))
        {
           if($cp_two_block_details->rural_urban == 'U')
           {
              $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($value->cp_2_ward_gp);
           }
           else
           {
              $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($value->cp_2_ward_gp);
           }
        }
        else
        {
           $cp_two_ward_gp_details = array();
        }
        $cp_two_ward_gp_name = ($cp_two_ward_gp_details)?$cp_two_ward_gp_details->cp_two_ward_gp:NULL;

        // echo "<pre>";
        // print_r($cp_one_ward_gp_details);
        // echo $cp_one_ward_gp_name;
        // print_r($cp_two_ward_gp_details);
        // echo "<br>";
        // echo $cp_two_ward_gp_name;
        // die;

        // if($value->incident_district)
        // {
        //   $incident_address = $value->incident_district.' , '.$value->incident_block.' , '.(($incident_ward_gp_details)?  $incident_ward_gp_details->incident_ward_gp:'');

        // }
        // else
        // {
        //    $incident_address = NULL;
        // }
    


        if($value->cp_1_state == 1){
          $cp_one_address = $value->cp_1_district.', '.$value->cp_1_block.', '.$cp_one_ward_gp_name;
        }else{
          $cp_one_address = $value->cp_1_address;
        }
        if($value->cp_2_state == 1){
          $cp_two_address = $value->cp_2_district.', '.$value->cp_2_block.', '.$cp_two_ward_gp_name;
        }else{
          $cp_two_address = $value->cp_2_address;
        }
        $cp_1_current_status = cp_status($value->current_status, $value->cp_1_id_pk, $value->cp_1_age);

        if($value->cp_two_is_available==2 || $value->cp_two_is_available =='')
        {
          $cp_2_current_status = 'CP2 is not available';
        }
        else
        {
          $cp_2_current_status = cp_status($value->current_status, $value->cp_2_id_pk, $value->cp_2_age);
        }

        //check marriage details

        if($value->marriage_date)
        {
          $marriage_date = date('d-m-Y', strtotime($value->marriage_date));
        }
        else
        {
          $marriage_date = NULL;
        }

        $age_cp1 = get_full_for_interv_exc_dwn($value->incident_date, $value->cp_1_dob); 
        $age_cp2 = get_full_for_interv_exc_dwn($value->incident_date, $value->cp_2_dob); 

        //Intervention data 
        $sheet->setCellValue('A' . $rows, $c++);
        $sheet->setCellValue('B' . $rows, $value->reporting_id);
        $sheet->setCellValue('C' . $rows, date('d-m-Y', strtotime($value->incident_date)));
        $sheet->setCellValue('D' . $rows, $marriage_date);
        $sheet->setCellValue('E' . $rows, ($value->marriage_details)?$marriage_details_check[$value->marriage_details]:NULL);
        $sheet->setCellValue('F' . $rows, ($value->prevented_details)?$prevented_details[$value->prevented_details]:NULL);
        $sheet->setCellValue('G' . $rows, $value->incident_district);
        $sheet->setCellValue('H' . $rows, $value->incident_block);
        $sheet->setCellValue('I' . $rows, $incident_ward_gp_name);
        $sheet->setCellValue('J' . $rows, $value->police_station);
        $sheet->setCellValue('K' . $rows, ($value->location_description)?$location_description_details[$value->location_description]:NULL);

        //CP1 data 
        $sheet->setCellValue('L' . $rows, $value->cp_1_name);
        $sheet->setCellValue('M' . $rows, $value->cp_1_state_name);
        $sheet->setCellValue('N' . $rows, $value->cp_1_district);
        $sheet->setCellValue('O' . $rows, $value->cp_1_block);
        $sheet->setCellValue('P' . $rows, $cp_one_ward_gp_name);
        $sheet->setCellValue('Q' . $rows, $value->cp_1_gender_value);
        $sheet->setCellValue('R' . $rows, $value->cp_1_dob);
        $sheet->setCellValue('S' . $rows, $age_cp1);
        $sheet->setCellValue('T' . $rows, ($value->cp_1_social_category)?$social_category_details[$value->cp_1_social_category]:NULL);
        $sheet->setCellValue('U' . $rows, ($value->cp_1_religion)?$religion_details[$value->cp_1_religion]:NULL);
        $sheet->setCellValue('V' . $rows, ($value->cp_1_highest_educational_attainment)?$highest_education_details[$value->cp_1_highest_educational_attainment]:NULL);
        $sheet->setCellValue('W' . $rows, $cp_1_current_status);

        //CP2 data 
        $sheet->setCellValue('X' . $rows, $value->cp_2_name);
        $sheet->setCellValue('Y' . $rows, $value->cp_2_state_name);
        $sheet->setCellValue('Z' . $rows, $value->cp_2_district);
        $sheet->setCellValue('AA' . $rows, $value->cp_2_block);
        $sheet->setCellValue('AB' . $rows, $cp_two_ward_gp_name);
        $sheet->setCellValue('AC' . $rows, $value->cp_2_gender_value);
        $sheet->setCellValue('AD' . $rows, $value->cp_2_dob);
        $sheet->setCellValue('AE' . $rows, $age_cp2);


        $sheet->setCellValue('AF' . $rows, ($value->cp_2_social_category)?$social_category_details[$value->cp_2_social_category]:NULL);

        $sheet->setCellValue('AG' . $rows, ($value->cp_2_religion)?$religion_details[$value->cp_2_religion]:NULL);
        $sheet->setCellValue('AH' . $rows, ($value->cp_2_highest_educational_attainment)?$highest_education_details[$value->cp_2_highest_educational_attainment]:NULL);
        $sheet->setCellValue('AI' . $rows, $created_at);
        $sheet->setCellValue('AJ' . $rows, $cp_2_current_status);
        // $sheet->setCellValue('W' . $rows, $value->location_description);

        // $sheet->setCellValue('K' . $rows, $value->cp_2_gender_value);
        // $sheet->setCellValue('L' . $rows, $value->cp_2_age);
        // $sheet->setCellValue('M' . $rows, $cp_two_address);

        // $sheet->setCellValue('O' . $rows, $cp_2_cp_1_type
        // {                     
        //   $sheet->setCellValue('N' . $rows, $cp_2_current_status);
        // }
        // elseif ($value->cp_two_is_available==2 || $value->cp_two_is_available =='')
        // {
        //   $sheet->setCellValue('N' . $rows, 'CP2 is not available');
        // }
        // else
        // {
        //   $sheet->setCellValue('N' . $rows, ''); 
        // } 

        $rows++;
        $tdata++;
        $sheet->getStyle('A'.$tdata.':'.'AJ'.$tdata)->applyFromArray($TdataArray);


    }

    
    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  
}

  public function download_incident($reporting_id)
  {
    echo "hello";die();

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
      $this->load->view($this->config->item('theme').'reporting/incident/Incident_Generated_Download_View', $data);
      // $html = $this->load->view($this->config->item('theme').'reporting/incident/Incident_Generated_Download_View', $data, true);
      // $dompdf->load_html($html);
      // $dompdf->setPaper('A4', 'portrait');
      // $filename = 'Intervention report - '.$reporting_id.".pdf";
      // $dompdf->render();
      // $dompdf->stream($filename); 
      // sleep(2);
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
