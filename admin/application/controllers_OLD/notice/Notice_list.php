<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet; // Use for download excel
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; // Use for download excel

class Notice_list extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('notice/Notice_model');
 
  } 
   
  public function index(){ 
      $login_id = $this->session->userdata('login_id');
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);

      $data['messages'] = $this->Notice_model->get_all_message_date();
      $data['user_id']  = $this->Notice_model->user_type();
      $this->load->view($this->config->item('theme').'notice/notice_list_view', $data);
  }
 
  public function publish_message(){
    $notice_id = $_GET['notice_id'];
    $result    = $this->Notice_model->publish_message_model($notice_id);
    if($result==1){
      echo 1;
    }else{
      echo 0;
    }
  }

  public function get_message(){
    $notice_id = $_GET['notice_id'];
    $result    = $this->Notice_model->get_message_model($notice_id);
    $msg_data  = $result[0];
    echo json_encode($msg_data);
  }

  public function get_edit_message_data(){
    $notice_id = $_GET['notice_id'];
    $result    = $this->Notice_model->get_edit_message_model($notice_id);
    echo json_encode($result);
  }

  public function inactive_message(){
    $notice_id = $_GET['notice_id'];
    $result    = $this->Notice_model->inactive_message_modal($notice_id);
    if($result==1){
      echo 1;
    }else{
      echo 0;
    }
  }

  public function update_message(){
    $title       = $_GET['title'];
    $description = $_GET['description'];
    $notice_id   = $_GET['notice_id'];
    $user_id     = $_GET['user_id'];
    $result = $this->Notice_model->update_message_modal($title,$description,$notice_id,$user_id);
    if($result==1){
      echo 1;
    }else{
      echo 0;
    }
  }

  // Create by soumen 24_09_2024 for Download Excel
  public function download_excel(){ 

      $report_result = $data['report_result'] = $this->Notice_model->get_all_message_date();

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->getStyle('A1:F1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);
      $sheet->getStyle('A1:F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');
      $sheet->getStyle('A1:F1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);

      $sheet->getColumnDimension('A')->setWidth(20);
      $sheet->getColumnDimension('B')->setWidth(30);
      $sheet->getColumnDimension('C')->setWidth(30);
      $sheet->getColumnDimension('D')->setWidth(30);
      $sheet->getColumnDimension('E')->setWidth(100);
      $sheet->getColumnDimension('F')->setWidth(20);

        $sheet->setCellValue('A1','Sl. No.');
        $sheet->setCellValue('B1','Date Added / Edited');
        $sheet->setCellValue('C1','Date Published');
        $sheet->setCellValue('D1','Title');
        $sheet->setCellValue('E1','Content');
        $sheet->setCellValue('F1','Target User');

        $rows = 2; 
        $count = 1;
        foreach ($data['report_result'] as $value) {

          $notice_id= $value['notice_id_pk'];
          $stake_holder_details= $this->Notice_model->get_stake_holder_name($notice_id);
          $user_data = implode(', ', $stake_holder_details);

          if($value['published_date']==null){
            $publish = "Not Published";
          }else{
            $publish = date('d-m-Y', strtotime($value['published_date']));
          }

          $sheet->setCellValue('A'.$rows, $count++);
          $sheet->setCellValue('B'.$rows, date('d-m-Y', strtotime($value['created_date'])));
          $sheet->setCellValue('C'.$rows, $publish);                  
          $sheet->setCellValue('D'.$rows, $value['title']);          
          $sheet->setCellValue('E'.$rows, $value['description']);                  
          $sheet->setCellValue('F'.$rows, $user_data);//TARGET USER
          $rows++;
        }
         
        $writer   = new Xlsx($spreadsheet);
        $fileName = 'Message_register_'.date('Y_m_d');

        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
  }


  // Create by soumen 24_09_2024 for print download
  public function message_pdf_download(){

    $login_id = $this->session->userdata('login_id');

    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['messages'] = $this->Notice_model->get_all_message_date();
    $data['user_id']  = $this->Notice_model->user_type();

    // echo "<pre>";
    // print_r($data);die;

    $this->load->view($this->config->item('theme').'message_view_pdf_download',$data);
  }

}
