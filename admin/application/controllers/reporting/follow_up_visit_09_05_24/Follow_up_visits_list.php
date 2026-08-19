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
    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }

  public function index() 
  {
     $this->validate_login(array('4','2','3','6','5','1'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $data['follow_up_visits_total_details'] = $this->follow_up_visit_list_model->follow_up_visits_list_details();
     $this->load->view($this->config->item('theme').'reporting/follow_up_visit/follow_up_visit_list_view', $data);
  }
  public function view_details(){
    $sl_no = $_GET['sl_no'];
    $sl_no = base64_decode($sl_no);
    $data = array();
    $data['follow_up_visits_details']=$follow_up_visits_details = $this->follow_up_visit_list_model->follow_up_visit_details_by_id($sl_no);
    $this->load->view($this->config->item('theme').'reporting/follow_up_visit/ajax/follow_up_visit_details_view', $data);
  }


  public function forward_followup(){

    
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $sl_no = $this->input->get('sl_no');
    $sl_no = base64_decode($sl_no);

    $update['fv_status'] = 2;
    $update['forward_by'] = $stake_holder_login_id_pk;
    $update['forward_time'] = 'now()';
    $update['forward_ip'] = $_SERVER['REMOTE_ADDR'];

    $where['sl_no'] = $sl_no;
    $default = $this->load->database('default',TRUE);
    $default->trans_start();
    $followUpVisitUpdateStatus = $this->follow_up_visit_list_model->follow_up_visits_details_update($update,$where);
    if($followUpVisitUpdateStatus>0){
      $default->trans_commit();
    }else{
      $default->trans_rollback();
    }
    echo $followUpVisitUpdateStatus;
  }

  public function publish_follow_up(){
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $sl_no = $this->input->get('sl_no');
    $sl_no = base64_decode($sl_no);

    $update['fv_status'] = 3;
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

    echo $followUpVisitUpdateStatus;
  }

  public function list_print()
  {
     // $data['follow_up_visits_print_details_data'] = $this->follow_up_visit_list_model->follow_up_visits_list_details();
    $start_date = $this->us_db_date_format($this->input->get('start_date')); 
    $end_date = $this->us_db_date_format($this->input->get('end_date'));
    
    $home_visits_total_details = array();
    if($start_date!= '' && $end_date != '')
    {
      $data['start_date'] = $this->input->get('start_date');
        $data['end_date'] = $this->input->get('end_date');
      $data['follow_up_visits_total_details'] = $this->follow_up_visit_list_model->follow_up_visits_list_details_btndate($start_date,$end_date);
    }
    else
    {
      $data['follow_up_visits_total_details'] = $this->follow_up_visit_list_model->follow_up_visits_list_details();
    }
     $html = $this->load->view($this->config->item('theme').'reporting/follow_up_visit/Follow_Up_Visit_Generated_List_Print_View', $data);
  }

  public function list_download()
  {
      $fileName = 'Follow_Up_Visit_Report'.date('d_m_Y');
      // $follow_up_visits_details = $this->follow_up_visit_list_model->follow_up_visits_list_details();
      $start_date = $this->us_db_date_format($this->input->get('start_date')); 
      $end_date = $this->us_db_date_format($this->input->get('end_date'));



      $home_visits_total_details = array();
      if($start_date!= '' && $end_date != '')
      {
        
        $follow_up_visits_details = $this->follow_up_visit_list_model->follow_up_visits_list_details_btndate($start_date,$end_date);
      }
      else
      {
        $follow_up_visits_details = $this->follow_up_visit_list_model->follow_up_visits_list_details();
      }

      // echo "<pre>";print_r($follow_up_visits_details);die;
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
      $sheet->getStyle('H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getColumnDimension('A')->setWidth(10);
      $sheet->getColumnDimension('B')->setWidth(18);
      $sheet->getColumnDimension('C')->setWidth(15);
      $sheet->getColumnDimension('D')->setWidth(15);
      $sheet->getColumnDimension('E')->setWidth(30);
      $sheet->getColumnDimension('F')->setWidth(15);
      $sheet->getColumnDimension('G')->setWidth(20);
      $sheet->getColumnDimension('h')->setWidth(18);

      $sheet->setCellValue('A'.$title_line, 'Sl. No');
      $sheet->setCellValue('B'.$title_line, 'Intervention Date');
      $sheet->setCellValue('C'.$title_line, 'Intervention ID');
      $sheet->setCellValue('D'.$title_line, 'Ward/GP');
      $sheet->setCellValue('E'.$title_line, 'Name');
      $sheet->setCellValue('F'.$title_line, 'Gender');       
      $sheet->setCellValue('G'.$title_line, 'Age At Intervention');                 
      $sheet->setCellValue('H'.$title_line, 'Status');                 
      $rows = 1 + $title_line;
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

          $status = null;
          if($value->fv_status==1){$status = 'Saved';}elseif ($value->fv_status==2) {$status = 'Forwarded';}elseif ($value->fv_status==3) {$status = 'Published';}else{$status = 'Saved As Draft';} 

          
         

        

          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('B' . $rows, $incident_date);
          $sheet->setCellValue('C' . $rows, $value->reporting_id);
          $sheet->setCellValue('D' . $rows, $ward_gp);
          $sheet->setCellValue('E' . $rows, $value->cp_1_name);
          $sheet->setCellValue('F' . $rows, $value->cp_1_gender_value);
          $sheet->setCellValue('G' . $rows, $value->cp_1_age);
          $sheet->setCellValue('H' . $rows, $status);
          $rows++;
      } 
      $writer = new Xlsx($spreadsheet);
      header("Content-Type: application/vnd.ms-excel");
      header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
  }

  public function dateSearch()
  {
    $start_date = $this->us_db_date_format($this->input->get('start_date')); 
    $end_date = $this->us_db_date_format($this->input->get('end_date'));


    
    $home_visits_total_details = array();
    if($start_date!= '' && $end_date != '')
    {
      $data['follow_up_visits_total_details'] = $this->follow_up_visit_list_model->follow_up_visits_list_details_btndate($start_date,$end_date);
    }
    else
    {
      $data['follow_up_visits_total_details'] = $this->follow_up_visit_list_model->follow_up_visits_list_details();
    }

    $this->load->view($this->config->item('theme').'reporting/follow_up_visit/ajax/advanced_search_view', $data);
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

  public function us_db_date_format($uk_date=NULL)
   {
       if($uk_date != NULL){
          $date_array = explode('/', $uk_date);
          return $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
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
