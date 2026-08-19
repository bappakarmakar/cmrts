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
    $this->load->model('user/create_user_form_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->load->model('common/Master_model');
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
     $this->validate_login(array('1', '2', '3','5','6'));
     $stake_id_fk = $this->session->userdata('stake_id_fk');
     // echo '--->>'.$stake_id_fk;die;
     if($stake_id_fk==6){
        $district_id = $this->session->userdata('district');
        $block_id = $this->session->userdata('block');
        $subdiv_id = ($this->session->userdata('subdiv'))?$this->session->userdata('subdiv'):0;
        $deo_user_details = $this->Master_model->get_sdo_deo_level_block($this->session->userdata('subdiv'));
  
        // echo "<pre>"; print_r($deo_user_details);die;
        $insetUserData = array();
        foreach ($deo_user_details as $key => $value) {
          $block_name = $value['block_name'];
          $subdiv_name = $value['subdiv_name'];
          $block_id_pk = $value['block_id_pk'];

          $newString = str_replace(' ', '-', $block_name);
          $user_name = "DEO.".$newString.'.'.$subdiv_name;
          // echo $user_name;die;
          // $username_check = $this->create_user_form_model->check_duplicate_login_id($user_name);
          $username_check = $this->create_user_form_model->check_duplicate_login_id_block($user_name,$block_id_pk);
          // echo "<pre>";print_r($username_check);die;
          if($username_check>0){
 
          }else{
            $password =  generateRandomPassword(6);
            $password_hash = hash('sha256',$password);
            $insetUserData[$key]['stake_id_fk'] = 4;
            $insetUserData[$key]['login_id'] = $user_name;
            $insetUserData[$key]['login_password'] = $password_hash;
            $insetUserData[$key]['active_status'] = 0;
            $insetUserData[$key]['entry_time'] = 'now()';
            $insetUserData[$key]['entry_ip'] = $_SERVER['REMOTE_ADDR'];
            $insetUserData[$key]['stake_holder_details'] = 'DEO';
            $insetUserData[$key]['stake_details_id_fk'] = 4;
            $insetUserData[$key]['base_password'] = $password;
            $insetUserData[$key]['base_login_id']= $user_name;
            $insetUserData[$key]['district'] = $district_id;
            $insetUserData[$key]['block']=$block_id_pk;
            $insetUserData[$key]['status']=0;
            $insetUserData[$key]['subdiv']=$subdiv_id;
            $insetUserData[$key]['login_status']=0;
            $insetUserData[$key]['master_password'] = hash('sha256','cmrts123#');
          }
          
        }

        if(count($insetUserData)>0){
          $default = $this->load->database('default',TRUE);
          $default->trans_start();
          $insert_user_status = $this->create_user_form_model->stake_holder_login_insert_batch($insetUserData);
          if($insert_user_status>0){
              $default->trans_commit();
            }else{
              $default->trans_rollback();
            }
        } 
     }
     
 
      

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
  public function download_excel_list()
  {
    $users_details_result = $this->user_list_model->downlod_excel();

    $login_id = $_SESSION['login_id'];
    $subdiv = explode('.', $login_id);
    $subdiv_name = $subdiv[1];


    // 
    // echo $subdiv_name;die;

    // $users_details_result = $this->user_list_model->Download_Excel_SDO_Level_DEO();
    // echo "<pre>";print_r($users_details_result);die;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


    $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->getColumnDimension('B')->setWidth(25);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(30);
    $sheet->getColumnDimension('E')->setWidth(21);
    $sheet->getColumnDimension('F')->setWidth(30);
    $sheet->getColumnDimension('G')->setWidth(20);

    $sheet->setCellValue('A1','Login credentials for newly registered users');
    $sheet->mergeCells('A1:G1');
    $sheet->getStyle('A1:G1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->setCellValue('A2', 'Sl. No');
    $sheet->setCellValue('B2', 'User Type');
    $sheet->setCellValue('C2', 'District');
    $sheet->setCellValue('D2', 'Sub-div');
    $sheet->setCellValue('E2', 'Block / Municipality');
    $sheet->setCellValue('F2', 'Username');
    $sheet->setCellValue('G2', 'Password');            
    $rows = 3;
    $count = 1;

    // echo '<pre>';print_r($users_details_result);die;
    if(!empty($users_details_result))
    {
      foreach ($users_details_result as $value){
        // $fileName = "DEO_details_for_".$value['subdiv_name'];

        $sheet->setCellValue('A' . $rows, $count++);
        $sheet->setCellValue('B' . $rows, $value['stake_holder_details']);
        $sheet->setCellValue('C' . $rows, $value['district_name']);
        $sheet->setCellValue('D' . $rows, $value['subdiv_name']);
        $sheet->setCellValue('E' . $rows, $value['block_municipality_name']);
        $sheet->setCellValue('F' . $rows, $value['login_id']);
        $sheet->setCellValue('G' . $rows, $value['base_password']);
        $rows++;
      }
    }
    else
    {
      // $fileName = "DEO_details_for_".$subdiv_name;
    } 

    $fileName = 'cmrts_new_userlist';
    $writer = new Xlsx($spreadsheet);
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    $writer->save('php://output');

    // echo "<pre>";print_r($users_details_result);
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
    // echo $_SESSION['login_id'];die;
    $this->validate_login(array('6'));
    $login_id = $_SESSION['login_id'];
    $subdiv = explode('.', $login_id);
    $subdiv_name = $subdiv[1];
    // echo $subdiv_name;die;

    $users_details_result = $this->user_list_model->Download_Excel_SDO_Level_DEO();
    // echo "<pre>";print_r($users_details_result);die;
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('A2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

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

    $sheet->setCellValue('A1','Login credentials for newly registered DEO(s)');
    $sheet->mergeCells('A1:F1');
    $sheet->getStyle('A1:F1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->setCellValue('A2', 'Sl. No');
    $sheet->setCellValue('B2', 'User Type');
    $sheet->setCellValue('C2', 'District');
    $sheet->setCellValue('D2', 'Sub div');
    $sheet->setCellValue('E2', 'Username');
    $sheet->setCellValue('F2', 'Password');            
    $rows = 3;
    $count = 1;
    if(!empty($users_details_result))
    {
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
    }
    else
    {
      $fileName = "DEO_details_for_".$subdiv_name;
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
