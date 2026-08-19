<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Follow_up_visits_list extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('follow_up_visit/follow_up_visit_list_model');
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
    );
  }

  public function index() 
  {
     $this->validate_login(array('4'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $data['follow_up_visits_total_details'] = $this->follow_up_visit_list_model->follow_up_visits_list_details();
     $this->load->view($this->config->item('theme').'reporting/follow_up_visit/follow_up_visit_list_view', $data);
  }
  public function view_details(){
    $data = array();
    $this->load->view($this->config->item('theme').'reporting/follow_up_visit/ajax/follow_up_visit_details_view', $data);
  }


  public function publish_follow_up(){
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $sl_no = $this->input->get('sl_no');
    $sl_no = base64_decode($sl_no);

    $update['fv_status'] = 2;
    $update['publish_by'] = $stake_holder_login_id_pk;
    $update['publish_time'] = 'now()';
    $update['publish_ip'] = $_SERVER['REMOTE_ADDR'];

    $where['sl_no'] = $sl_no;
    $default = $this->load->database('default',TRUE);
    $default->trans_start();
    $followUpVisitUpdateStatus = $this->follow_up_visit_list_model->follow_up_visits_details_update($update,$where);
    if($followUpVisitUpdateStatus>0){
      $default->trans_commit();
    }else{
      $default->trans_rollback();
    }
  }

  public function list_print()
  {
     $data['follow_up_visits_print_details_data'] = $this->follow_up_visit_list_model->follow_up_visits_list_details();
     $html = $this->load->view($this->config->item('theme').'reporting/follow_up_visit/Follow_Up_Visit_Generated_List_Print_View', $data);
  }

  public function list_download()
  {
      $fileName = 'Follow_Up_Visit_Report'.date('d_m_Y');
      $follow_up_visits_details = $this->follow_up_visit_list_model->follow_up_visits_list_details();
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
      $sheet->setCellValue('D1', 'Ward/GP');
      $sheet->setCellValue('E1', 'Name');
      $sheet->setCellValue('F1', 'Gender');       
      $sheet->setCellValue('G1', 'Age');                 
      $rows = 2;
      $count = 1;
      foreach ($follow_up_visits_details as $value){
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

          $incident_date = date('d-m-Y', strtotime($value->incident_date));
          $ward_gp = ($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';
         

        

          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('B' . $rows, $incident_date);
          $sheet->setCellValue('C' . $rows, $value->reporting_id);
          $sheet->setCellValue('D' . $rows, $ward_gp);
          $sheet->setCellValue('E' . $rows, $value->cp_1_name);
          $sheet->setCellValue('F' . $rows, $value->cp_1_gender_value);
          $sheet->setCellValue('G' . $rows, $value->cp_1_age);
          $rows++;
      } 
      $writer = new Xlsx($spreadsheet);
      header("Content-Type: application/vnd.ms-excel");
      header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
  }

  public function us_date_format($uk_date=NULL)
  {
    if($uk_date != NULL){
        $date_array = explode('/', $uk_date);
        return $date_array[2].'-'.$date_array[0].'-'.$date_array[1];
    }else{
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
