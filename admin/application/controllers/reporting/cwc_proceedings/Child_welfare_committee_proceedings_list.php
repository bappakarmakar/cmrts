<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Child_welfare_committee_proceedings_list extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('cwc_proceedings/child_welfare_committee_proceedings_list_model');
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
      4 => $this->config->item('theme_uri').'assets/js/incident_form.js',
    );
  }

  public function index() 
  {
      $this->validate_login(array('3'));
      $login_id = $this->session->userdata('login_id');
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);
      $data['cwc_proceedings_details'] = $this->child_welfare_committee_proceedings_list_model->cwc_proceedings_list_details();
      $this->load->view($this->config->item('theme').'reporting/cwc_proceedings/child_welfare_committee_proceedings_list_view', $data);
  }

  public function cwc_edit($cwc_proceedings_id, $minor_details)
  {
      $cwc_proceedings_id = base64_decode($cwc_proceedings_id);
      $minor_details = base64_decode($minor_details);
      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
      $config = array(
        array(
          'field' => 'case_no',
          'label' => 'Case No',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'case_date',
          'label' => 'Case Date',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'district',
          'label' => 'District',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'block',
          'label' => 'Block',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'cci_details',
          'label' => 'CCI',
          'rules' => 'trim|required'
        ),
      );
      $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE) {
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['districts'] = $this->Master_model->get_district();
        $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
        $data['cwc_proceedings_edit_details'] = $this->child_welfare_committee_proceedings_list_model->cwc_proceedings_edit_details($cwc_proceedings_id, $minor_details);
        $district = $data['cwc_proceedings_edit_details']->district;
        $data['Block_Value'] = $this->Master_model->get_block($district);
       if($minor_details == '1'){
         $cp_gender = $this->child_welfare_committee_proceedings_list_model->cp_one_gender_value($data['cwc_proceedings_edit_details']->incident_id_fk);

         $data['CCI_Value'] = $this->child_welfare_committee_proceedings_list_model->cp_cci_value($district, $cp_gender);
       }else{
         $cp_gender = $this->child_welfare_committee_proceedings_list_model->cp_two_gender_value($data['cwc_proceedings_edit_details']->incident_id_fk);

         $data['CCI_Value'] = $this->child_welfare_committee_proceedings_list_model->cp_cci_value($district, $cp_gender);
       }
        $this->load->view($this->config->item('theme').'reporting/cwc_proceedings/child_welfare_committee_proceedings_form_edit_view', $data);
      }else{
        $this->db->trans_begin();
        $result = $this->child_welfare_committee_proceedings_list_model->update_cwc_proceedings_details($cwc_proceedings_id, $minor_details);
        if($result == 0){
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'CWC Proceedings data successful updated.');
            redirect('admin/reporting/cwc_proceedings/child_welfare_committee_proceedings_list');
        }else{
          $this->db->trans_rollback();
          $this->session->set_flashdata('warning', 'CWC Proceedings data updation failed. Please try again.');
           redirect('admin/reporting/cwc_proceedings/child_welfare_committee_proceedings_list');
        }
      } 
  }

  public function list_print()
  {
     $data['cwc_proceedings_details_data'] = $this->child_welfare_committee_proceedings_list_model->cwc_proceedings_list_details();
     $html = $this->load->view($this->config->item('theme').'reporting/cwc_proceedings/Child_Welfare_Committee_Proceedings_Generated_List_Print_View', $data);
  }

  public function list_download()
  {
      $fileName = 'CWC_Proceedings_Report';  
      $cwc_proceedings_details = $this->child_welfare_committee_proceedings_list_model->cwc_proceedings_list_details();
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('C1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('D1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('F1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('H1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
      $sheet->getStyle('I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

      $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('I')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('B')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('G')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('H')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
      $sheet->getStyle('I')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

      $sheet->getColumnDimension('A')->setWidth(10);
      $sheet->getColumnDimension('B')->setWidth(15);
      $sheet->getColumnDimension('C')->setWidth(30);
      $sheet->getColumnDimension('D')->setWidth(20);
      $sheet->getColumnDimension('E')->setWidth(15);
      $sheet->getColumnDimension('F')->setWidth(15);
      $sheet->getColumnDimension('G')->setWidth(25);
      $sheet->getColumnDimension('H')->setWidth(25);
      $sheet->getColumnDimension('I')->setWidth(60);

      $sheet->setCellValue('A1', 'Sl. No');
      $sheet->setCellValue('B1', 'Incident ID');
      $sheet->setCellValue('C1', 'Minor Details');
      $sheet->setCellValue('D1', 'Minor Sent to');
      $sheet->setCellValue('E1', 'Case No');
      $sheet->setCellValue('F1', 'Case Date');                    
      $sheet->setCellValue('G1', 'District');                    
      $sheet->setCellValue('H1', 'SD/Block');                    
      $sheet->setCellValue('I1', 'CCI Name');                    
      $rows = 2;
      $count = 1;
      foreach ($cwc_proceedings_details as $val){
          if($val->minor_details == '1'){
           $minor_details = 'Contracting Party One';
          }else{
             $minor_details = 'Contracting Party Two';
          } 

          if($val->minor_sent == '4'){
             $minor_sent = 'Institutional Care';
          }

          $case_date = date('d-m-Y', strtotime($val->case_date));
          $district_name = ucwords(strtolower($val->district_name));
          $block_name = ucwords(strtolower($val->block_name));

          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('B' . $rows, $val->reporting_id);
          $sheet->setCellValue('C' . $rows, $minor_details);
          $sheet->setCellValue('D' . $rows, $minor_sent);
          $sheet->setCellValue('E' . $rows, $val->case_no);
          $sheet->setCellValue('F' . $rows, $case_date);
          $sheet->setCellValue('G' . $rows, $district_name);
          $sheet->setCellValue('H' . $rows, $block_name);
          $sheet->setCellValue('I' . $rows, $val->cci_name);
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
