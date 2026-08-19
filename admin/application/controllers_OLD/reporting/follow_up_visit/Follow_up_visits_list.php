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
    //echo "abc";die();
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

  public function delete_followup()
  {
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $sl_no = $this->input->get('sl_no');
    $sl_no = base64_decode($sl_no);

    $where['sl_no'] = $sl_no;
    $update['delete_by'] = $stake_holder_login_id_pk;
    $update['delete_time'] = 'now()';
    $update['delete_ip'] = $_SERVER['REMOTE_ADDR'];
    $update['active_status'] = 0;
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

  public function revert_back_follow_up_visit()
  {
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $cp_id_fk = $this->input->get('cp_id_fk');
    $reason = $this->input->get('reason');
    $cp_id_fk = base64_decode($cp_id_fk);
    $where['sl_no'] = $cp_id_fk;

    $update['fv_status'] = 4;
    $update['revert_reason'] = $reason;
    $update['revert_by'] = $stake_holder_login_id_pk;
    $update['revert_time'] = 'now()';
    $update['revert_ip'] = $_SERVER['REMOTE_ADDR'];

    $default = $this->load->database('default',TRUE);
    $default->trans_start();
    $homeVisitUpdateStatus = $this->follow_up_visit_list_model->revertback_follow_up_isit_details($update,$where);
    if($homeVisitUpdateStatus>0){
      $default->trans_commit();
    }else{
      $default->trans_rollback();
    }
    echo $homeVisitUpdateStatus;
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

 public function list_download() //excel download for follow up visit
  {
    $this->load->model('common/Master_model');
      //echo "hello";die;
      $fileName = 'Follow_Up_Visit_Report'.date('d_m_Y');

      // echo $fileName."--------".date('d-m-Y');die;

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

      //echo "<pre>";print_r($follow_up_visits_details);die;

      $mode_of_enquiry = $this->Master_model->get_mode_of_enquiry_details();
      $mode_of_enquiry_check = array_column($mode_of_enquiry,'description', 'sl_no'); 


      $stage_of_pregnancy = $this->Master_model->get_stage_of_pregnancy_details();
      $stage_of_pregnancy_check = array_column($stage_of_pregnancy,'description', 'sl_no');
      //print_r($stage_of_pregnancy_check);die;

      $situation_code = $this->config->item('situation_code');
      $yes_no_val = $this->config->item('engaged_check');
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

      
      $sheet->getStyle('A'.$title_line.':AC'.$title_line)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('A'.$title_line.':AC'.$title_line)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


      foreach (range('A','Z') as $columnID) {
            // $sheet->getColumnDimension($columnID)->setWidth(10);
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
            $sheet->getStyle($columnID)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

        $sheet->getColumnDimension('AA')->setAutoSize(true);
        $sheet->getStyle('AA')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getColumnDimension('AB')->setAutoSize(true);
        $sheet->getStyle('AB')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $sheet->getColumnDimension('AC')->setAutoSize(true);
        $sheet->getStyle('AC')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      
      $sheet->setCellValue('A'.$title_line, 'Sl. No');
      $sheet->setCellValue('B'.$title_line, 'Intervention Date');
      $sheet->setCellValue('C'.$title_line, 'Intervention ID');
      $sheet->setCellValue('D'.$title_line, 'Age At Intervention');                 
      $sheet->setCellValue('E'.$title_line, 'Follow-up Date');
      $sheet->setCellValue('F'.$title_line, 'Age at Follow-up');
      $sheet->setCellValue('G'.$title_line, 'District');
      $sheet->setCellValue('H'.$title_line, 'Block/Municipality');
      $sheet->setCellValue('I'.$title_line, 'GP/Ward ');

      $sheet->setCellValue('J'.$title_line, 'Name ');
      $sheet->setCellValue('K'.$title_line, 'Gender ');
      $sheet->setCellValue('L'.$title_line, 'FU Publish');
      $sheet->setCellValue('M'.$title_line, 'Enrolled in Education ');
      $sheet->setCellValue('N'.$title_line, 'Education - Frequency ');
      $sheet->setCellValue('O'.$title_line, 'Enrolled in Kishori Group ');
      $sheet->setCellValue('P'.$title_line, 'Kishori Group - Frequency');

      $sheet->setCellValue('Q'.$title_line, 'Enrolled in Paid work');
      $sheet->setCellValue('R'.$title_line, 'Paid work - Frequency');

      $sheet->setCellValue('S'.$title_line, 'supported by parent');
      $sheet->setCellValue('T'.$title_line, 'supported by Family elders');
      $sheet->setCellValue('U'.$title_line, 'supported by Peer');
      $sheet->setCellValue('V'.$title_line, 'supported by Neighbours');
      $sheet->setCellValue('W'.$title_line, 'supported by Others');

      $sheet->setCellValue('X'.$title_line, 'Minor pregnant' );
      $sheet->setCellValue('Y'.$title_line, 'Stage of pregnancy (Trimester)');
      $sheet->setCellValue('Z'.$title_line, 'Remark (if any)');
      $sheet->setCellValue('AA'.$title_line, 'Status');       
      $sheet->setCellValue('AB'.$title_line, 'Updated On');
      $sheet->setCellValue('AC'.$title_line, 'Contracting Party Type');                 
      $rows = 1 + $title_line;
      $count = 1;

      foreach ($follow_up_visits_details as $value){
        //echo "<pre>";
        //print_r($value);die;

        $age_folllow_up = get_full_year_HE_FUV_excel_view($value->followup_date, $value->cp_1_dob);
        $age_at_interv = get_full_for_excel_dwn_for_he($value->incident_date, $value->cp_1_dob);

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

        $fv_date = '';
        if($value->followup_date != '')
        {
          $fv_date = date('d-m-Y', strtotime($value->followup_date));
        }

          $incident_date = date('d-m-Y', strtotime($value->incident_date));
          $ward_gp = ($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';

          $Location = $value->cp_district_name."-".$value->cp_block_name."-".(($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''); 

          $status = null;
          if($value->fv_status==1){$status = 'Saved';}
          elseif ($value->fv_status==2) {$status = 'Forwarded';}
          elseif ($value->fv_status==3) {$status = 'Published';}
          elseif($value->fv_status==4) {$status = 'Reverted';}
          else{$status = 'Saved As Draft';} 

          $cp_type = null;
          if($value->cp_type==1){$cp_type = 'Contracting Party one';}
          elseif ($value->cp_type==2) {$cp_type = 'Contracting Party Two';}
          else{$cp_type = '';}

          $updated_on = NULL;
          if($value->fv_status==0)
          {
            if($value->update_time)
            {
              $updated_on = $this->extractDate($value->update_time);
            }
            else
            {
              $updated_on = $this->extractDate($value->entry_time);
            }
          }
          elseif ($value->fv_status==1) 
          {
             $updated_on = $this->extractDate($value->update_time);
          }
          elseif ($value->fv_status==2) 
          {
             $updated_on = $this->extractDate($value->forward_time);
          }
          elseif ($value->fv_status==3) 
          {
            $updated_on = $this->extractDate($value->publish_time);
          }
          elseif ($value->fv_status==4) 
          {
            $updated_on = $this->extractDate($value->revert_time);
          }

        



          
          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('B' . $rows, $incident_date);
          $sheet->setCellValue('C' . $rows, $value->reporting_id);
          $sheet->setCellValue('D' . $rows, $age_at_interv);
          $sheet->setCellValue('E' . $rows, $fv_date);
          $sheet->setCellValue('F' . $rows, $age_folllow_up);
          $sheet->setCellValue('G' . $rows, $value->cp_district_name);
          $sheet->setCellValue('H' . $rows, $value->cp_block_name);
          $sheet->setCellValue('I' . $rows, (($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''));


          $sheet->setCellValue('J' . $rows, $value->cp_1_name);
          $sheet->setCellValue('K' . $rows, $value->cp_1_gender_value);
          $sheet->setCellValue('L' .$rows, date('d-m-Y',strtotime($value->publish_time)));
          $sheet->setCellValue('M' . $rows, ($value->follow_education)?$yes_no_val[$value->follow_education]:NULL); 
          $sheet->setCellValue('N' . $rows, ($value->education_frequency)?$situation_code[$value->education_frequency]:NULL);
          $sheet->setCellValue('O' . $rows, ($value->kishori_group)?$yes_no_val[$value->kishori_group]:NULL); 
          $sheet->setCellValue('P' . $rows, ($value->kishori_group_frequency)?$situation_code[$value->kishori_group_frequency]:NULL);

          $sheet->setCellValue('Q' . $rows, ($value->paid_work)?$yes_no_val[$value->paid_work]:NULL); 
          $sheet->setCellValue('R' . $rows, ($value->paid_work_frequency)?$situation_code[$value->paid_work_frequency]:NULL);


          $sheet->setCellValue('S' . $rows, ($value->parents_supported)?$situation_code[$value->parents_supported]:NULL);
          $sheet->setCellValue('T' . $rows, ($value->family_elders_supported)?$situation_code[$value->family_elders_supported]:NULL);
          $sheet->setCellValue('U' . $rows, ($value->peers_supported)?$situation_code[$value->peers_supported]:NULL);

          $sheet->setCellValue('V' . $rows, ($value->neighbours_supported)?$situation_code[$value->neighbours_supported]:NULL);
          $sheet->setCellValue('W' . $rows, ($value->others_supported)?$situation_code[$value->others_supported]:NULL);
          $sheet->setCellValue('X' . $rows, ($value->minor_pregnant)?$yes_no_val[$value->minor_pregnant]:NULL);

          $sheet->setCellValue('Y' . $rows, ($value->stage_of_pregnancy)?$stage_of_pregnancy_check[$value->stage_of_pregnancy]:NULL);
          $sheet->setCellValue('Z' . $rows, ($value->remarks)?$value->remarks:NULL);
          $sheet->setCellValue('AA' . $rows, $status);
          $sheet->setCellValue('AB' . $rows, $updated_on);
          $sheet->setCellValue('AC' . $rows, $cp_type);

          $rows++;
      } 

      // echo $fileName;die;
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

  public function extractDate($date=null) {
    // Create a DateTime object
    $dateTime = new DateTime($date);

    // Format and return the date part
    return $dateTime->format('d-m-Y');
}
}
