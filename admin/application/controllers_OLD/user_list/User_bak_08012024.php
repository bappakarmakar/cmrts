<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class User extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('user/user_list_model');
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
     $this->validate_login(array('1', '2', '3', '6'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $data['user_details'] = $this->user_list_model->Get_All_Users_Details();
     $this->load->view($this->config->item('theme').'user_list/user_list_view', $data);
  }

  public function Activate_User()
  {
     $stake_holder_id = $this->input->get('stake_holder_id');
     $result = $this->user_list_model->activated_user_update($stake_holder_id);
     json_encode($result);
  }

  public function Deactivate_User()
  {
     $stake_holder_id = $this->input->get('stake_holder_id');
     $result = $this->user_list_model->deactivated_user_update($stake_holder_id);
     json_encode($result);
  }
  // State Nodal Officers
  public function export_all_users()
  {
     $this->validate_login(array('1'));
     $login_id = $this->session->userdata('login_id');
     $data['district_details'] = $this->Dashboard_model->district_details($login_id);
     $data['districts'] = $this->Master_model->get_district();
     $district = $this->input->post('district');
     $data['block'] = $this->Master_model->get_block($district);
     $this->validate_login(array('1'));
     $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
     $config = array(
       array(
        'field' => 'user_type',
        'label' => 'User Type',
        'rules' => 'trim|required|numeric'
       ),
       array(
        'field' => 'district',
        'label' => 'District',
        'rules' => 'trim|numeric'
       ),
       array(
        'field' => 'block',
        'label' => 'Block / Municipality',
        'rules' => 'trim|numeric'
       ),
     );
    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == TRUE) {
       $users_details_result = $this->user_list_model->Search_All_Type_Users($this->input->post('user_type'), $this->input->post('district'), $this->input->post('block'));
       $data['users_details_result'] = $users_details_result;
    }
    $this->load->view($this->config->item('theme').'user_list/export_all_users_form_view', $data);
  }
  // State Nodal Officers
  public function downlod_excel($user_type = '', $district = '', $block = '')
  {
    $this->validate_login(array('1'));
    $user_type = base64_decode($user_type);
    $district = base64_decode($district);
    $block = base64_decode($block);
    $user_type_array = array(3, 6);
    if($user_type == 3){
      $fileName = 'CMPO_Details';
      $user_type_name = "CMPO";
    }elseif($user_type == 6){
      $fileName = 'SDO_Details';
      $user_type_name = "SDO";
    }elseif($user_type == 2){
      $fileName = 'BDO_Details';
      $user_type_name = "BDO";
    }elseif($user_type == 4){
      $fileName = 'DEO_Details';
      $user_type_name = "DEO";
    }
    $users_details_result = $this->user_list_model->Search_All_Type_Users($user_type, $district, $block);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    if (!in_array($user_type, $user_type_array)){
      $sheet->getStyle('D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    }
    $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    if (!in_array($user_type, $user_type_array)){
      $sheet->getStyle('D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }
    $sheet->getStyle('E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


    $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    if (!in_array($user_type, $user_type_array)){
      $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    }
    $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->getColumnDimension('B')->setWidth(25);
    $sheet->getColumnDimension('C')->setWidth(25);
    if (!in_array($user_type, $user_type_array)){
      $sheet->getColumnDimension('D')->setWidth(40);
    }
    $sheet->getColumnDimension('E')->setWidth(40);
    $sheet->getColumnDimension('F')->setWidth(20);

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'User Type');
    $sheet->setCellValue('C1', 'District');
    if (!in_array($user_type, $user_type_array)){
      $sheet->setCellValue('D1', 'Block / Municipality');
    }
    $sheet->setCellValue('E1', 'Username');
    $sheet->setCellValue('F1', 'Password');            
    $rows = 2;
    $count = 1;
    foreach ($users_details_result as $value){

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $user_type_name);
      $sheet->setCellValue('C' . $rows, $value['district_name']);
      if (!in_array($user_type, $user_type_array)){
        $sheet->setCellValue('D' . $rows, $value['block_name']);
      }
      $sheet->setCellValue('E' . $rows, $value['login_id']);
      $sheet->setCellValue('F' . $rows, $value['base_password']);
      $rows++;
    } 
    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
  }

  // SDO Section
  public function downlod_excel_sdo_level_deo()
  {
    $this->validate_login(array('6'));
    $users_details_result = $this->user_list_model->Download_Excel_SDO_Level_DEO();
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


    $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->getColumnDimension('B')->setWidth(25);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(40);
    $sheet->getColumnDimension('E')->setWidth(40);
    $sheet->getColumnDimension('F')->setWidth(20);

    $sheet->setCellValue('A1', 'Sl. No');
    $sheet->setCellValue('B1', 'User Type');
    $sheet->setCellValue('C1', 'District');
    $sheet->setCellValue('D1', 'Municipality');
    $sheet->setCellValue('E1', 'Username');
    $sheet->setCellValue('F1', 'Password');            
    $rows = 2;
    $count = 1;
    foreach ($users_details_result as $value){
      $fileName = "DEO_details_for_".$value['subdiv_name'];

      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['stake_holder_details']);
      $sheet->setCellValue('C' . $rows, $value['district_name']);
      $sheet->setCellValue('D' . $rows, $value['subdiv_name']);
      $sheet->setCellValue('E' . $rows, $value['login_id']);
      $sheet->setCellValue('F' . $rows, $value['base_password']);
      $rows++;
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
}
