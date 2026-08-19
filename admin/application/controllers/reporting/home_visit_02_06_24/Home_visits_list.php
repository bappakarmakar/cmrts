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
    // echo "<pre>";print_r($_SESSION);die;
    $this->validate_login(array(1,2,3,4,5,6));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $data['home_visits_total_details'] = $this->home_visit_list_model->home_enquiry_visits_list_details();
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
    $cp_id_fk = base64_decode($cp_id_fk);
    $update['hv_status'] = 4;
    $where['sl_no'] = $cp_id_fk;
    // $update['publish_by'] = $stake_holder_login_id_pk;
    // $update['publish_time'] = 'now()';
    // $update['publish_ip'] = $_SERVER['REMOTE_ADDR'];
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

  public function list_download()
  {
      $fileName = 'Home_Visit_Report_'.date('d_m_Y');
      $start_date = $this->us_date_format_db($this->input->get('start_date'));
      $end_date = $this->us_date_format_db($this->input->get('end_date'));
      if($start_date!= '' && $end_date != ''){
        $home_visits_details = $this->home_visit_list_model->home_enquiry_visits_list_details_by_date($start_date,$end_date);
      }else{
        $home_visits_details = $this->home_visit_list_model->home_enquiry_visits_list_details();
      }
      // echo "<pre>";print_r($home_visits_details);die;



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

      $sheet->getColumnDimension('A')->setWidth(10);
      $sheet->getColumnDimension('B')->setWidth(17);
      $sheet->getColumnDimension('C')->setWidth(15);

      $sheet->getColumnDimension('D')->setWidth(19);

      $sheet->getColumnDimension('E')->setWidth(19);
      $sheet->getColumnDimension('F')->setWidth(25);
      $sheet->getColumnDimension('G')->setWidth(45);
      $sheet->getColumnDimension('H')->setWidth(25);
      $sheet->getColumnDimension('I')->setWidth(17);
      $sheet->getColumnDimension('J')->setWidth(15);
      $sheet->getColumnDimension('K')->setWidth(15);

      $sheet->setCellValue('A'.$title_line, 'Sl. No');
      $sheet->setCellValue('B'.$title_line, 'Intervention Date');
      $sheet->setCellValue('C'.$title_line, 'Intervention ID');

      $sheet->setCellValue('D'.$title_line, 'Age at Intervention');         

      $sheet->setCellValue('E'.$title_line, 'Home Enquiry Date');
      $sheet->setCellValue('F'.$title_line, 'Age at Home Enquiry');
      $sheet->setCellValue('G'.$title_line, 'Location');
      $sheet->setCellValue('H'.$title_line, 'Name');
      $sheet->setCellValue('I'.$title_line, 'Gender');       
      $sheet->setCellValue('J'.$title_line, 'Minor/Adult');                 
      $sheet->setCellValue('K'.$title_line, 'Status');                 
      $rows = 1 + $title_line;
      $count = 1;

      if(!empty($home_visits_details))
      {
      foreach ($home_visits_details as $value){

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

       $Location = $value->cp_district_name."-".$value->cp_block_name."-".(($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''); 
        

          $incident_date = date('d-m-Y', strtotime($value->incident_date));
          $ward_gp = ($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';
    
          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('B' . $rows, $incident_date);
          $sheet->setCellValue('C' . $rows, $value->reporting_id);

          $sheet->setCellValue('D' . $rows, $value->cp_age);

          $sheet->setCellValue('E' . $rows, $hv_date);
          $sheet->setCellValue('F' . $rows, $value->age_of_home_enquiry);
          $sheet->setCellValue('G' . $rows, $Location);
          $sheet->setCellValue('H' . $rows, $value->cp_name);
          $sheet->setCellValue('I' . $rows, $value->cp_gender_val);
          $sheet->setCellValue('J' . $rows, $value->minor_adult_status);
          $sheet->setCellValue('K' . $rows, $value->status);
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
