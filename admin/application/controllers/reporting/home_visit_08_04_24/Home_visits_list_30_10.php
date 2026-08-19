<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home_visits_list extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->model('home_visit/home_visit_list_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
      2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery.ui.datepicker.js',
      2 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      3 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
      4 => $this->config->item('theme_uri').'/assets/js/prevention_intervention_form.js',
    );
  }

  public function index() 
  {
     $this->validate_login(array('4'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     // $data['home_visits_total_details'] = $this->home_visit_list_model->home_visits_list_details();
     // $this->load->view($this->config->item('theme').'reporting/home_visit/home_visit_list_view', $data);
    $this->load->view($this->config->item('theme').'under_maintenance', $data);
  }

  public function list_download()
  {
      $fileName = 'Home_Visit_Report';  
      $home_visits_details = $this->home_visit_list_model->home_visits_list_details();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

      $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getColumnDimension('A')->setWidth(10);
      $sheet->getColumnDimension('B')->setWidth(15);
      $sheet->getColumnDimension('C')->setWidth(15);
      $sheet->getColumnDimension('D')->setWidth(15);
      $sheet->getColumnDimension('E')->setWidth(30);
      $sheet->getColumnDimension('F')->setWidth(15);
      $sheet->getColumnDimension('G')->setWidth(10);

      $sheet->setCellValue('A1', 'Sl. No');
      $sheet->setCellValue('B1', 'Incident Date');
      $sheet->setCellValue('C1', 'Incident ID');
      $sheet->setCellValue('D1', 'Ward / GP');
      $sheet->setCellValue('E1', 'Name');
      $sheet->setCellValue('F1', 'Gender');       
      $sheet->setCellValue('G1', 'Age');                 
      $rows = 2;
      $count = 1;
      foreach ($home_visits_details as $val){
          if($val->gender == '1'){
            $gender = 'Male';
          }else{
            $gender = 'Female';
          }

          if(!empty($val->cp_one_block_id)){
            $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($val->cp_one_block_id);
            if($cp_one_block_details->rural_urban == 'U'){
              $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($val->cp_one_ward_gp);
            }else{
              $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($val->cp_one_ward_gp);
            }
          }

          if(!empty($val->cp_two_block_id)){
            $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($val->cp_two_block_id);
            if($cp_two_block_details->rural_urban == 'U'){
              $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($val->cp_two_ward_gp);
            }else{
              $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($val->cp_two_ward_gp);
            }
          }
          if(!empty($val->cp_one_block_id)){ 
             $ward_gp = $cp_one_ward_gp_details->cp_one_ward_gp;
          }elseif(!empty($val->cp_two_block_id)){
             $ward_gp = $cp_two_ward_gp_details->cp_two_ward_gp;
          }
          $incident_date = date('d-m-Y', strtotime($val->incident_date));

          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('B' . $rows, $incident_date);
          $sheet->setCellValue('C' . $rows, $val->reporting_id);
          $sheet->setCellValue('D' . $rows, $ward_gp);
          $sheet->setCellValue('E' . $rows, $val->name);
          $sheet->setCellValue('F' . $rows, $gender);
          $sheet->setCellValue('G' . $rows, $val->age);
          $rows++;
      } 
      $writer = new Xlsx($spreadsheet);
      header("Content-Type: application/vnd.ms-excel");
      header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
  }

  public function list_print()
  {
     $data['home_visits_print_details_data'] = $this->home_visit_list_model->home_visits_list_details();
     $html = $this->load->view($this->config->item('theme').'reporting/home_visit/Home_Visit_Generated_List_Print_View', $data);
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
}
