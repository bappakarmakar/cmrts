<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home_visits_list extends NIC_Controller {
   
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->model('home_visit/home_visit_list_model');
    $this->load->model('home_visit/home_visit_minor_form_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }
  public function index() 
  { 
     //echo "----->>>";die();
    //print_r($_SESSION);die;
    $this->validate_login(array(1,2,3,4,5,6));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $data['home_visits_total_details'] = $this->home_visit_list_model->home_enquiry_visits_list_details();
      //echo "<pre>";
      //print_r($data['home_visits_total_details']);die;
     $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_list_view', $data);
  }   
 
  public function publish_homevisit()
  {
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $cp_id_fk = $this->input->get('cp_id_fk');
    $cp_id_fk = base64_decode($cp_id_fk);
    $update['hv_status'] = 3;
    $where['sl_no'] = $cp_id_fk;
    $update['publish_by'] = $stake_holder_login_id_pk;
    $update['publish_time'] = 'now()';
    $update['publish_ip'] = $_SERVER['REMOTE_ADDR'];
    $default = $this->load->database('default',TRUE);
    $default->trans_start();
    $homeVisitUpdateStatus = $this->home_visit_list_model->publish_homevisit_details($update,$where);
    if($homeVisitUpdateStatus>0){
      $default->trans_commit();
    }else{
      $default->trans_rollback();
    }
    echo $homeVisitUpdateStatus;
  }


  public function revertback_homevisit()
  {
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $cp_id_fk = $this->input->get('cp_id_fk');
    $reason = $this->input->get('reason');
    // echo $reason;die;
    $cp_id_fk = base64_decode($cp_id_fk);
    $where['sl_no'] = $cp_id_fk;

    $update['hv_status'] = 4;
    $update['revert_reason'] = $reason;
    $update['revert_by'] = $stake_holder_login_id_pk;
    $update['revert_time'] = 'now()';
    $update['revert_ip'] = $_SERVER['REMOTE_ADDR'];

    $default = $this->load->database('default',TRUE);
    $default->trans_start();
    $homeVisitUpdateStatus = $this->home_visit_list_model->revertback_homevisit_details($update,$where);
    if($homeVisitUpdateStatus>0){
      $default->trans_commit();
    }else{
      $default->trans_rollback();
    }
    echo $homeVisitUpdateStatus;
  }

  public function forward_homevisit()
  {
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $cp_id_fk = $this->input->get('cp_id_fk');
    $cp_id_fk = base64_decode($cp_id_fk);

    $update['hv_status'] = 2;
    $where['sl_no'] = $cp_id_fk;
    $update['forward_by'] = $stake_holder_login_id_pk;
    $update['forward_time'] = 'now()';
    $update['forward_ip'] = $_SERVER['REMOTE_ADDR'];
    $default = $this->load->database('default',TRUE);
    $default->trans_start();
    $homeVisitUpdateStatus = $this->home_visit_list_model->publish_homevisit_details($update,$where);
    if($homeVisitUpdateStatus>0){
      $default->trans_commit();
    }else{
      $default->trans_rollback();
    }
    echo $homeVisitUpdateStatus;
  }

  public function delete_homevisit()
  {
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $cp_id_fk = $this->input->get('cp_id_fk');
    $cp_id_fk = base64_decode($cp_id_fk);
    // $update['hv_status'] = 2;
    $where['sl_no'] = $cp_id_fk;
    $update['delete_by'] = $stake_holder_login_id_pk;
    $update['delete_time'] = 'now()';
    $update['delete_ip'] = $_SERVER['REMOTE_ADDR'];
    $update['active_status'] = 0;
    $default = $this->load->database('default',TRUE);
    $default->trans_start();
    $homeVisitUpdateStatus = $this->home_visit_list_model->delete_homevisit_details($update,$where);
    if($homeVisitUpdateStatus>0){
      $default->trans_commit();
    }else{
      $default->trans_rollback();
    }
    echo $homeVisitUpdateStatus;
  }


  public function dateSearch()
  {
    
    $start_date = $this->us_date_format_db($this->input->get('start_date'));
    $end_date = $this->us_date_format_db($this->input->get('end_date'));
    if(!empty($start_date) && !empty($end_date)){
      $data['home_visits_total_details']= $this->home_visit_list_model->home_enquiry_visits_list_details_by_date($start_date,$end_date);
    }else{
      $data['home_visits_total_details']= array();
    }
    $this->load->view($this->config->item('theme').'reporting/home_visit/advanced_search_view', $data);
  }

  public function list_download() //excel download
  {
    //echo "hello";die;
      $fileName = 'Home_Visit_Report_'.date('d_m_Y');
      $start_date = $this->us_date_format_db($this->input->get('start_date'));
      $end_date = $this->us_date_format_db($this->input->get('end_date'));
      if($start_date!= '' && $end_date != ''){
        $home_visits_details = $this->home_visit_list_model->home_enquiry_visits_list_details_by_date($start_date,$end_date);
      }else{
        $home_visits_details = $this->home_visit_list_model->home_enquiry_visits_list_details();
      }
       //echo "<pre>";print_r($home_visits_details);die;



      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $title_line = 1;
      if($start_date!= '' && $end_date != '')
      {
        $title_line = 2;
        $dateSearch = "From Date :".$this->input->get('start_date'). "    --------    "."To Date :".$this->input->get('end_date');
        $sheet->setCellValue('A1',$dateSearch);
        $sheet->mergeCells('A1:D1'); 
      }
      
      $sheet->getStyle('A'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('B'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('C'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('D'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('E'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('F'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('G'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('H'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('I'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('J'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('K'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('L'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('M'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('N'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('O'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

      $sheet->getStyle('P'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('Q'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('R'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('S'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('T'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('U'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('V'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('W'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('X'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('Y'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('Z'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AA'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AB'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AC'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AD'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AE'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AF'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AG'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AH'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AI'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AJ'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AK'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('AL'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
////////////////////////////////////////////////////////////////////////////////
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
///////////////////////////////////////////////////////////////////////////////////
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
      $sheet->getStyle('M')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('N')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('O')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getStyle('P')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('Q')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('R')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('S')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('T')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('U')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('V')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('W')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('X')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('Y')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('Z')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AA')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AB')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AC')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AD')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AE')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AF')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AG')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AH')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AI')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AJ')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AK')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('AL')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


      $sheet->getColumnDimension('A')->setWidth(10);
      $sheet->getColumnDimension('B')->setWidth(17);
      $sheet->getColumnDimension('C')->setWidth(15);
      $sheet->getColumnDimension('D')->setWidth(19);
      $sheet->getColumnDimension('E')->setWidth(19);
      $sheet->getColumnDimension('F')->setWidth(25);
      $sheet->getColumnDimension('G')->setWidth(30);
      $sheet->getColumnDimension('H')->setWidth(25);
      $sheet->getColumnDimension('I')->setWidth(17);
      $sheet->getColumnDimension('J')->setWidth(15);
      $sheet->getColumnDimension('K')->setWidth(15);
      $sheet->getColumnDimension('L')->setWidth(30);
      $sheet->getColumnDimension('M')->setWidth(30);
      $sheet->getColumnDimension('N')->setWidth(30);
      $sheet->getColumnDimension('O')->setWidth(30);

      $sheet->getColumnDimension('P')->setWidth(15);
      $sheet->getColumnDimension('Q')->setWidth(15);
      $sheet->getColumnDimension('R')->setWidth(30);
      $sheet->getColumnDimension('S')->setWidth(15);
      $sheet->getColumnDimension('T')->setWidth(15);
      $sheet->getColumnDimension('U')->setWidth(15);
      $sheet->getColumnDimension('V')->setWidth(30);
      $sheet->getColumnDimension('W')->setWidth(25);
      $sheet->getColumnDimension('X')->setWidth(20);
      $sheet->getColumnDimension('Y')->setWidth(25);
      $sheet->getColumnDimension('Z')->setWidth(20);
      $sheet->getColumnDimension('AA')->setWidth(25);
      $sheet->getColumnDimension('AB')->setWidth(20);
      $sheet->getColumnDimension('AC')->setWidth(25);
      $sheet->getColumnDimension('AD')->setWidth(25);
      $sheet->getColumnDimension('AE')->setWidth(25);
      $sheet->getColumnDimension('AF')->setWidth(25);
      $sheet->getColumnDimension('AG')->setWidth(25);
      $sheet->getColumnDimension('AH')->setWidth(25);
      $sheet->getColumnDimension('AI')->setWidth(25);
      $sheet->getColumnDimension('AJ')->setWidth(25);
      $sheet->getColumnDimension('AK')->setWidth(90);
      $sheet->getColumnDimension('AL')->setWidth(40);


      $sheet->setCellValue('A'.$title_line, 'Sl. No');
      $sheet->setCellValue('B'.$title_line, 'Intervention Date');
      $sheet->setCellValue('C'.$title_line, 'Intervention ID');
      $sheet->setCellValue('D'.$title_line, 'Age at Intervention');         
      $sheet->setCellValue('E'.$title_line, 'Home Enquiry Date');
      $sheet->setCellValue('F'.$title_line, 'Age at Home Enquiry');
      $sheet->setCellValue('G'.$title_line, 'Mode of Home Enquiry');
      $sheet->setCellValue('H'.$title_line, 'Name');
      $sheet->setCellValue('I'.$title_line, 'Gender');       
      $sheet->setCellValue('J'.$title_line, 'Minor/Adult');                 
      $sheet->setCellValue('K'.$title_line, 'Status'); 
      $sheet->setCellValue('L'.$title_line, 'Home Enquiry Publish');
      $sheet->setCellValue('M'.$title_line, 'District');
      $sheet->setCellValue('N'.$title_line, 'Block/SD');
      $sheet->setCellValue('O'.$title_line, 'GP/Ward');

      $sheet->setCellValue('P'.$title_line, 'Family Income');                 
      $sheet->setCellValue('Q'.$title_line, 'Disability Type');
      $sheet->setCellValue('R'.$title_line, 'Neighbours Community');
      $sheet->setCellValue('S'.$title_line, 'Emergency');
      $sheet->setCellValue('T'.$title_line, 'Disability');
      $sheet->setCellValue('U'.$title_line, 'Disability Type');
      $sheet->setCellValue('V'.$title_line, 'Kanyashree Available');
      $sheet->setCellValue('W'.$title_line, 'Kanyashree Id');
      $sheet->setCellValue('X'.$title_line, 'Education');
      $sheet->setCellValue('Y'.$title_line, 'Education Frequency');
      $sheet->setCellValue('Z'.$title_line, 'Kishori Group'); //DONE
      $sheet->setCellValue('AA'.$title_line, 'Kishori Group Frequency');
      $sheet->setCellValue('AB'.$title_line, 'Paid Work');
      $sheet->setCellValue('AC'.$title_line, 'Paid Work Frequency');
      $sheet->setCellValue('AD'.$title_line, 'Parents Supported');
      $sheet->setCellValue('AE'.$title_line, 'Family Elders Supported');
      $sheet->setCellValue('AF'.$title_line, 'Peers Supported');
      $sheet->setCellValue('AG'.$title_line, 'Neighbours Supported');
      $sheet->setCellValue('AH'.$title_line, 'Others Supported');
      $sheet->setCellValue('AI'.$title_line, 'Minor Pregnant');
      $sheet->setCellValue('AJ'.$title_line, 'Stage Of Pregnancy');
      $sheet->setCellValue('AK'.$title_line, 'Remarks');
      $sheet->setCellValue('AL'.$title_line, 'Contracting Party Type');
                
      $rows = 1 + $title_line;
      $count = 1;

      if(!empty($home_visits_details))
      {
      foreach ($home_visits_details as $value){
         // echo "<pre>";
         // print_r($value);die;

// CODE START BY SOUMEN 10/12/2024
        $age_at_home_enq = get_full_year_HE_FUV_excel_view_for_he($value->home_enquiry_date, $value->cp_dob);
        $age_at_interv = get_full_for_excel_dwn_for_he($value->incident_date, $value->cp_dob);


        $mode_he = null;
          if($value->mode_of_enquiry==1){$mode_he = 'Phone Call';}
          elseif ($value->mode_of_enquiry==2) {$mode_he = 'Video Call';}
          else{$mode_he = 'In Person';}       
        $fam_income = null;
          if($value->family_income==1){$fam_income = 'Rarely';}
          elseif ($value->family_income==2) {$fam_income = 'Sometimes';}
          else{$fam_income = 'Regularly';}
        $nut_meal = null;
          if($value->nutritious_meals==1){$nut_meal = 'Rarely';}
          elseif ($value->nutritious_meals==2) {$nut_meal = 'Sometimes';}
          else{$nut_meal = 'Regularly';}
        $nei_comm = null;
          if($value->neighbours_community==1){$nei_comm = 'Rarely';}
          elseif ($value->neighbours_community==2) {$nei_comm = 'Sometimes';}
          else{$nei_comm = 'Regularly';}
        $emer = null;
          if($value->emergencies==1){$emer = 'Rarely';}
          elseif ($value->emergencies==2) {$emer = 'Sometimes';}
          else{$emer = 'Regularly';}
        $disability = null;
          if($value->disability==1)
            {$disability = 'Yes';}
          else{$disability = 'No';}
        $type_of_dis = null;
          if($value->type_of_disability==1){$type_of_dis = 'Locomotor';}
          elseif ($value->type_of_disability==2) {$type_of_dis = 'Hearing';}
          elseif ($value->type_of_disability==3) {$type_of_dis = 'Speech/Language';}
          elseif ($value->type_of_disability==4) {$type_of_dis = 'Visual';}
          elseif ($value->type_of_disability==5) {$type_of_dis = 'Intellectual';}
          elseif ($value->type_of_disability==6) {$type_of_dis = 'Others';}
          else{$type_of_dis = '';}
        $kp_avail = null;
          if($value->kp_availed==1)
            {$kp_avail = 'Yes';}
          else{$kp_avail = 'No';}          
        $edu = null;
          if($value->education==1)
            {$edu = 'Yes';}
          else{$edu = 'No';}                    
        $edu_freq = null;
          if($value->education_frequency==1){$edu_freq = 'Rarely';}
          elseif ($value->education_frequency==2) {$edu_freq = 'Sometimes';}
          elseif ($value->education_frequency==3) {$edu_freq = 'Regularly';}
          else{$edu_freq = '';}
        $kishori_group = null;
          if($value->kishori_group==1)
            {$kishori_group = 'Yes';}
          else{$kishori_group = 'No';}          
        $ki_gr_frq = null;
          if($value->kishori_group_frequency==1){$ki_gr_frq = 'Rarely';}
          elseif ($value->kishori_group_frequency==2) {$ki_gr_frq = 'Sometimes';}
          elseif ($value->kishori_group_frequency==3) {$ki_gr_frq = 'Regularly';}
          else{$ki_gr_frq = '';}            
        $paid_work = null;
          if($value->paid_work==1)
            {$paid_work = 'Yes';}
          else{$paid_work = 'No';} 
        $paid_work_freq = null;
          if($value->paid_work_frequency==1){$paid_work_freq = 'Rarely';}
          elseif ($value->paid_work_frequency==2) {$paid_work_freq = 'Sometimes';}
          elseif ($value->paid_work_frequency==3) {$paid_work_freq = 'Regularly';}
          else{$paid_work_freq = '';}
        $parent_supp = null;
          if($value->parents_supported==1){$parent_supp = 'Low';}
          elseif ($value->parents_supported==2) {$parent_supp = 'Medium';}
          elseif ($value->parents_supported==3) {$parent_supp = 'High';}
          else{$parent_supp = '';} 
        $fam_eld_supp = null;
          if($value->family_elders_supported==1){$fam_eld_supp = 'Low';}
          elseif ($value->family_elders_supported==2) {$fam_eld_supp = 'Medium';}
          elseif ($value->family_elders_supported==3) {$fam_eld_supp = 'High';}
          else{$fam_eld_supp = '';}
        $peers_supp = null;
          if($value->peers_supported==1){$peers_supp = 'Low';}
          elseif ($value->peers_supported==2) {$peers_supp = 'Medium';}
          elseif ($value->peers_supported==3) {$peers_supp = 'High';}
          else{$peers_supp = '';}
        $neighbour_supp = null;
          if($value->neighbours_supported==1){$neighbour_supp = 'Low';}
          elseif ($value->neighbours_supported==2) {$neighbour_supp = 'Medium';}
          elseif ($value->neighbours_supported==3) {$neighbour_supp = 'High';}
          else{$neighbour_supp = '';}
        $others_supp = null;
          if($value->others_supported==1){$others_supp = 'Low';}
          elseif ($value->others_supported==2) {$others_supp = 'Medium';}
          elseif ($value->others_supported==3) {$others_supp = 'High';}
          else{$others_supp = '';}
        $minor_preg = null;
          if($value->minor_pregnant==1)
            {$minor_preg = 'Yes';}
          else{$minor_preg = 'No';}
        $stage_preg = null;
          if($value->stage_of_pregnancy==1){$stage_preg = 'First';}
          elseif ($value->stage_of_pregnancy==2) {$stage_preg = 'Second';}
          elseif ($value->stage_of_pregnancy==3) {$stage_preg = 'Third';}
          else{$stage_preg = '';}
        $cp_type = null;
          if($value->cp_type==1){$cp_type = 'Contracting Party one';}
          elseif ($value->cp_type==2) {$cp_type = 'Contracting Party Two';}
          else{$cp_type = '';}
//CODE END BY SOUMEN

        if($value->cp_age<18){                    
          $value->minor_adult_status = "Minor";
        }else{
          $value->minor_adult_status = "Adult";
        }
        $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_block);
        if(!empty($cp_one_block_details)){
          if($cp_one_block_details->rural_urban == 'U'){
            $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_ward_gp);
          }else{
            $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_ward_gp);
          }
        }else{
          $cp_one_ward_gp_details = array();
        }

        $hv_date = '';
        if($value->home_enquiry_date != '')
        {
          $hv_date = date('d-m-Y', strtotime($value->home_enquiry_date));
        }
       // $Location = $value->cp_district_name."-".$value->cp_block_name."-".
       // (($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''); 
       //print_r($Location);die;
       $gp = (($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'');
        

          $incident_date = date('d-m-Y', strtotime($value->incident_date));
          $ward_gp = ($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';

         
    
          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('B' . $rows, $incident_date);
          $sheet->setCellValue('C' . $rows, $value->reporting_id);
          $sheet->setCellValue('D' . $rows, $age_at_interv);
          $sheet->setCellValue('E' . $rows, $hv_date);
          $sheet->setCellValue('F' . $rows, $age_at_home_enq);
          $sheet->setCellValue('G' . $rows, $mode_he);
          $sheet->setCellValue('H' . $rows, $value->cp_name);
          $sheet->setCellValue('I' . $rows, $value->cp_gender_val);
          $sheet->setCellValue('J' . $rows, $value->minor_adult_status);
          $sheet->setCellValue('K' . $rows, $value->status);
          $sheet->setCellValue('L' . $rows, date('d-m-Y',strtotime($value->publish_time)));
          $sheet->setCellValue('M' . $rows, $value->cp_district_name);
          $sheet->setCellValue('N' . $rows, $value->cp_block_name);
          $sheet->setCellValue('O' . $rows, $gp);

          $sheet->setCellValue('P' . $rows, $fam_income);
          $sheet->setCellValue('Q' . $rows, $nut_meal);
          $sheet->setCellValue('R' . $rows, $nei_comm);
          $sheet->setCellValue('S' . $rows, $emer);
          $sheet->setCellValue('T' . $rows, $disability);
          $sheet->setCellValue('U' . $rows, $type_of_dis);
          $sheet->setCellValue('V' . $rows, $kp_avail);
          $sheet->setCellValue('W' . $rows, $value->kanyashree_id);
          $sheet->setCellValue('X' . $rows, $edu);
          $sheet->setCellValue('Y' . $rows, $edu_freq);
          $sheet->setCellValue('Z' . $rows, $kishori_group);
          $sheet->setCellValue('AA' . $rows, $ki_gr_frq);
          $sheet->setCellValue('AB' . $rows, $paid_work);
          $sheet->setCellValue('AC' . $rows, $paid_work_freq);
          $sheet->setCellValue('AD' . $rows, $parent_supp);
          $sheet->setCellValue('AE' . $rows, $fam_eld_supp);
          $sheet->setCellValue('AF' . $rows, $peers_supp);
          $sheet->setCellValue('AG' . $rows, $neighbour_supp);
          $sheet->setCellValue('AH' . $rows, $others_supp);
          $sheet->setCellValue('AI' . $rows, $minor_preg);
          $sheet->setCellValue('AJ' . $rows, $stage_preg);
          $sheet->setCellValue('AK' . $rows, $value->remarks);
          $sheet->setCellValue('AL' . $rows, $cp_type);



          $rows++;
      }
      } 
      $writer = new Xlsx($spreadsheet);
      header("Content-Type: application/vnd.ms-excel");
      header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
  }

  public function list_print()
  {

    $start_date = $this->us_date_format_db($this->input->get('start_date'));
    $end_date = $this->us_date_format_db($this->input->get('end_date'));
    if($start_date!= '' && $end_date != ''){
      $data['start_date'] = $this->input->get('start_date');
        $data['end_date'] = $this->input->get('end_date');
      $data['home_visits_print_details_data'] = $this->home_visit_list_model->home_enquiry_visits_list_details_by_date($start_date,$end_date);
    }else{
      $data['home_visits_print_details_data'] = $this->home_visit_list_model->home_enquiry_visits_list_details();
    }
     

     $html = $this->load->view($this->config->item('theme').'reporting/home_visit/Home_Visit_Generated_List_Print_View', $data);
   }



  public function get_homevist_dtls()
  {
    $sl_no = $_GET['sl_no'];
    $sl_no = base64_decode($sl_no);
    $data = array();
    $data['home_visit_details']=$home_visit_details= $this->home_visit_minor_form_model->home_visit_minor_details_by_id($sl_no);
    $data['homwvisit_siblings_dtls'] = $this->home_visit_minor_form_model->get_homwvisit_siblings_dtls_by_hvm_id(array('hv_id_fk'=>$sl_no,'delete_status'=>0));

    $this->load->view($this->config->item('theme').'reporting/home_visit/ajax/home_visit_details_view', $data);
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

  public function us_date_format_db($uk_date=NULL)
  {
    if($uk_date != NULL){
       $date_array = explode('/', $uk_date);
       return $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
    } else {
       return NULL;
    }
  }
}
