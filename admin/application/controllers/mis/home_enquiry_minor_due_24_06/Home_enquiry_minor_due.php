<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Home_enquiry_minor_due extends NIC_Controller {


  private $district_wise = [
    'field_selection' => "cmir.district as unique_id, cmir.district as district_id_pk, district_master.district_name as name,",
    'group_by' => "cmir.district,district_master.district_name",
    'order_by' => "district_master.district_name"
    // 'order_by' => "cmir.district"
  ];

  private $block_wise = [
      'field_selection' => "cmir.block as unique_id, block_master.block_name as name,",
      'group_by' => "cmir.block,block_master.block_name",
      'order_by' => "block_master.block_name"
      // 'order_by' => "cmir.block"
  ];

  private $ward_wise = [
      'field_selection' => "cmir.ward_gp as unique_id, wmstr.ward_no as name,",
      'group_by' => "cmir.ward_gp, wmstr.ward_no",
      'order_by' => "cmir.ward_gp"
      // 'order_by' => "cmir.ward_gp, wmstr.ward_no"
  ];

  private $gp_wise = [
      'field_selection' => "cmir.ward_gp as unique_id, gpmstr.gp_name as name,",
      'group_by' => "cmir.ward_gp, gpmstr.gp_name",
      'order_by' => "gpmstr.gp_name"
  ];

  // private $ward_wise['order_by'] = "cmir.ward_gp,gpmstr.gp_name";


  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('mis/CM_report_model');
    $this->load->model('mis/Education_wise_mis_model');
    // $this->load->model('mis/Home_enquiry_minor_due_model','homeenqModel');
    $this->load->model('mis/Home_enquiry_due_model','homeenqModel');
    $this->load->model('common/Master_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/css/jquery-ui.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
    if(($this->session->userdata('login_id')!= 'State-MIS1-DWCDSW'))
    {
      redirect('admin/dashboard');
    }
  }

 


  public function index()
  {
    // echo "<pre>";print_r($_SESSION);echo"</pre>";
    $data['for_adult_minor'] = NULL;

    // echo "<pre>";print_r($this->input->get());

    // if($this->input->get('for_adult_minor') =='' || $this->input->post('for_adult_minor') =='')
    // {
    //   redirect('admin');
    // }


    $data['force_view'] = 0;
    $data['delete_status'] = 0;
    $data['current_status'] = 3;
    $data['hide_search'] = 0;
    $data['active_status'] = 1;
    $data['district_details'] = $this->Dashboard_model->district_details($this->session->userdata('login_id'));

    // if($this->input->get('segregate'))
    if($this->input->get())
    {
      // echo "<pre>";print_r($_GET);die;
      $data['force_view'] = 1;
      $data['hide_search'] = 1;
      $data['from_date'] = $this->input->get('from_date');
      $data['to_date'] = $this->input->get('to_date');
      $data['segregate'] = $this->input->get('segregate');
      $data['unique_id'] = $this->input->get('unique_id');
      $data['for_adult_minor'] = $this->input->get('for_adult_minor');
      if(isset($data['for_adult_minor']))
      {
        if($data['for_adult_minor'] == 1)
        {
          $data['cp_age_minor'] = 101;
        }
        else if($data['for_adult_minor'] == 2)
        {
          $data['cp_age_adult'] = 101;
        }
      }

      if($data['segregate'] == 'district')
      {
        $data['field_selection'] = $this->block_wise['field_selection'];
            $data['group_by'] = $this->block_wise['group_by'];
        $data['district'] = $data['unique_id'];
        $data['segregate'] = 'block';
        $data['order_by'] = $this->block_wise['order_by'];
      }
      else if($data['segregate'] == 'block')
      {
        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['unique_id']);
        if(!empty($Identity_Ward_Gp_Block))
        {
          if($Identity_Ward_Gp_Block->rural_urban == 'U')
          {
            $data['is_ward'] = 1;
            $data['field_selection'] = $this->ward_wise['field_selection'];
            $data['group_by'] = $this->ward_wise['group_by'];
            $data['order_by'] = $this->ward_wise['order_by'];
            // $data['field_selection'] = "cmir.ward_gp as unique_id, wmstr.ward_no as name, ward_master_description(cmir.ward_gp),";
            // $data['field_selection'] = "cmir.ward_gp as unique_id, get_ward_gp_no(".$data['unique_id'].",cmir.ward_gp) as name,";
            // $data['group_by'] = 'cmir.block';
          }
          else
          {
            $data['is_gp'] = 1;
            $data['field_selection'] = $this->gp_wise['field_selection'];
            $data['group_by'] = $this->gp_wise['group_by'];
            $data['order_by'] = $this->gp_wise['order_by'];
            // $data['field_selection'] = "cmir.ward_gp as unique_id,gpmstr.gp_name as name,";
            // $data['field_selection'] = "cmir.ward_gp as unique_id, gpmster.gp_name as name, gp_master_description(),";
             // $data['group_by'] = 'cmir.ward_gp,gpmstr.gp_name';
          //   $data['group_by'] = 'cmir.block';
          }
        }
        // $data['field_selection'] = "cmir.ward_gp as unique_id, get_ward_gp_no(".$data['unique_id'].",cmir.ward_gp) as name,";
        $data['block'] = $data['unique_id'];
        $data['segregate'] = 'ward_gp';
      }


    }
    else if($this->input->method(TRUE) == 'POST')
    {

      // echo 123;die;
        $data['for_adult_minor'] = $this->input->post('for_adult_minor');
        if(isset($data['for_adult_minor']))
        {
          if($data['for_adult_minor'] == 1)
          {
            $data['cp_age_minor'] = 101;
          }
          else if($data['for_adult_minor'] == 2)
          {
            $data['cp_age_adult'] = 101;
          }
        }

        $data['force_view'] = 1;
        $data['from_date'] = $from_date = $this->us_date_format($this->input->post('from_date'));
        $data['to_date'] = $to_date = $this->us_date_format($this->input->post('to_date'));

        $data['district'] = $this->session->userdata('district');
        $data['block'] = $this->session->userdata('block');
        $data['subdiv'] = $this->session->userdata('subdiv');

        if(empty($data['district']))
        {
          // $data['segregate'] = 'state';
           $data['segregate'] = 'district';
          $data['field_selection'] = $this->district_wise['field_selection'];
          $data['group_by'] = $this->district_wise['group_by'];
          $data['order_by'] = $this->district_wise['order_by'];
        }
        else if(!empty($data['district']) and empty($data['block']))
        {
          // $data['segregate'] = 'district';
          $data['segregate'] = 'block';
          $data['field_selection'] = $this->block_wise['field_selection'];
          $data['group_by'] = $this->block_wise['group_by'];
          $data['order_by'] = $this->block_wise['order_by'];
          // $data['field_selection'] = "cmir.block as unique_id,cmir.block as block_id_pk,block_location_master_description(cmir.block) as name,";
        }
        elseif (!empty($data['district']) and (!empty($data['block']))) 
        {
          // echo 123;die;
          $data['segregate'] = 'ward_gp';
          // $data['segregate'] = 'ward_gp';
          // $data['field_selection'] = "cmir.ward_gp as unique_id,cmir.ward_gp as ward_id_pk, get_ward_gp_no(".$data['block'].",cmir.ward_gp) as name,";
          // $data['group_by'] = 'cmir.ward_gp,cmir.block';
          // $data['block'] = $data['unique_id'] =  ($data['unique_id'])?($data['unique_id']):$this->session->userdata('block');
          $data['unique_id'] = $data['block'];
          $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['block']);
          if(!empty($Identity_Ward_Gp_Block))
          {
            if($Identity_Ward_Gp_Block->rural_urban == 'U')
            {
              $data['is_ward'] = 1;
              $data['field_selection'] = $this->ward_wise['field_selection'];
              $data['group_by'] = $this->ward_wise['group_by'];
              $data['order_by'] = $this->ward_wise['order_by'];
            }
            else
            {
              $data['is_gp'] = 1;
              $data['field_selection'] = $this->gp_wise['field_selection'];
              $data['group_by'] = $this->gp_wise['group_by'];
              $data['order_by'] = $this->gp_wise['order_by'];
            }
          }

        }
        // elseif (!empty($data['district']) and (!empty($data['block']) and $data['block']==0)) 
        // {
        //   $data['segregate'] = 'subdiv';
        // }
    }
      $data['report_result'] = array();
      if($data['force_view'] == 1)
      {
        $data['report_result'] = $this->homeenqModel->get_home_enquiry_due_dtls($data);
      }
      // echo "<pre>";print_r($data);
      // echo "</pre>";
    // DIE;

    $this->load->view($this->config->item('theme').'mis/home_enquiry_minor_due_report/home_enquiry_minor_due_report_view', $data);
  }


  public function download_excel()
  {
    // echo "<pre>"; print_r($_GET);die;
    $title = "Home_enquiry_due";

    $data['for_adult_minor'] = $this->input->GET('for_adult_minor');
    if(isset($data['for_adult_minor']))
    {
      if($data['for_adult_minor'] == 1)
      {
        $data['cp_age_minor'] = 101;
        $title = "Home_enquiry_minor_due";
      }
      else if($data['for_adult_minor'] == 2)
      {
        $data['cp_age_adult'] = 101;
        $title = "Home_enquiry_adult_due";
      }
    }
    $data['homeenq_due'] = 1;

    $data['delete_status'] = 0;
    $data['current_status'] = 3;
    $data['active_status'] = 1;

    $data['segregate'] = $this->input->get('segregate');

    // echo $data['segregate'];die;
    $data['from_date'] = $from_date = $this->input->get('from_date');
    $data['to_date'] = $to_date = $this->input->get('to_date');

    $data['unique_id'] = $this->input->get('unique_id');
    $list_for_name = null;

      if($data['segregate'] == 'district')
      {
        $data['field_selection'] = $this->district_wise['field_selection'];
        $data['group_by'] = $this->district_wise['group_by'];
        $data['order_by'] = $this->district_wise['order_by'];
        $title.="_Districtwise";
        //title name 
        $list_for_name =  "All district";

      }
      elseif ($data['segregate'] == 'block') 
      {
        // $data['unique_id'] = $this->session->userdata('district');
        $data['district'] = ($data['unique_id'])?($data['unique_id']):$this->session->userdata('district');
        $data['field_selection'] = $this->block_wise['field_selection'];
        $data['group_by'] = $this->block_wise['group_by'];
        $data['order_by'] = $this->block_wise['order_by'];


        $data['list_for_name'] = $this->Master_model->get_district_name($data['district']);
        $list_for_name = $data['list_for_name']->district_name; 
        $title.="_Blockwise";
      }
      elseif ($data['segregate'] == 'ward_gp') 
      {
        $data1['block_id'] = $data['block'] = $data['unique_id'] =  ($data['unique_id'])?($data['unique_id']):$this->session->userdata('block');
        $title.="WardGP_wise";
        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['unique_id']);

        $data['list_for_name'] = $this->Master_model->get_dist_by_block($data1);
        $list_for_name = $data['list_for_name']['block_name']; 

          if(!empty($Identity_Ward_Gp_Block))
          {
            if($Identity_Ward_Gp_Block->rural_urban == 'U')
            {
              $data['is_ward'] = 1;
              $data['field_selection'] = $this->ward_wise['field_selection'];
              $data['group_by'] = $this->ward_wise['group_by'];
              $data['order_by'] = $this->ward_wise['order_by'];
            }
            else
            {
              $data['is_gp'] = 1;
              $data['field_selection'] = $this->gp_wise['field_selection'];
              $data['group_by'] = $this->gp_wise['group_by'];
              $data['order_by'] = $this->gp_wise['order_by'];
            }
          }
      }







      
      $report_result = $data['report_result'] = $this->homeenqModel->get_home_enquiry_due_dtls($data);
        // echo "<pre>";print_r($data);die;
      $title_name = $title." For ".$list_for_name;
      $fileName = $title."_".date('Y-m-d');

      // echo "<pre>"; print_r($data['report_result']);die;
    // $fileName = 'INTERVENTION_UNDERTAKEN_REPORT_DISTRICT';
    // $report_result = $this->CM_report_model->cm_report($from_date, $unique_id);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1:I2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('A3:I4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffcc00');

    $sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('A1:I1')->getFont()->setBold(true)->setName('Calibri')->setSize(14);
    $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getStyle('A3:C3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);


    $sheet->mergeCells('A1:I1');
    $sheet->mergeCells('A3:A4');
    $sheet->mergeCells('B3:B4');

    $sheet->mergeCells('C3:C4');
    $sheet->mergeCells('D3:I3');
    // $sheet->mergeCells('B3:B4');
    // $sheet->mergeCells('C3:D3');
    // $sheet->mergeCells('C3:C4');
    // $sheet->mergeCells('E3:F3');
    // $sheet->mergeCells('A1:I1');
    // $sheet->mergeCells('G3:H3');
    // $sheet->mergeCells('I3:J3');
    // $sheet->mergeCells('K3:L3');
    // $sheet->mergeCells('M3:N3');
    // $sheet->mergeCells('O3:P3');
    // $sheet->mergeCells('Q3:R3');


    $sheet->getColumnDimension('B')->setWidth(30);
    $sheet->getColumnDimension('C')->setWidth(15);
    $sheet->getColumnDimension('D')->setWidth(25);
    $sheet->getColumnDimension('E')->setWidth(23);
    $sheet->getColumnDimension('F')->setWidth(8);

    foreach (range('C', 'I') as $columnID) {
            // $sheet->getColumnDimension($columnID)->setWidth(10);
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
            $sheet->getStyle($columnID)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        }

    // $sheet->getColumnDimension('C:R')->setWidth(10);
    // $sheet->getStyle('C:R')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);



    // $sheet->setCellValue('A2', 'Date as on : '.$this->convert_date_format($to_date));

    $sheet->setCellValue('A2', 'From date :');
    $sheet->setCellValue('B2', $this->convert_date_format($from_date));    
    // $sheet->setCellValue('B2', $this->convert_date_format($from_date));

    $sheet->setCellValue('C2', '-:-');

    $sheet->setCellValue('D2', 'To date :');
    $sheet->setCellValue('E2', $this->convert_date_format($to_date));

    $sheet->setCellValue('A1', $title_name);

    // $sheet->setCellValue('K2', 'District Name :');
    // $sheet->setCellValue('L2', 'Nadia');

    $sheet->setCellValue('A3', 'Sl. No');
    $sheet->setCellValue('B3', 'Jurisdiction');

    $sheet->setCellValue('C3', 'Total Due');
    $sheet->setCellValue('D3', 'No. of days (in no. of days from Date of Intervention)');

    $sheet->setCellValue('D4', '1-7');
    $sheet->setCellValue('E4', '8-15');
    $sheet->setCellValue('F4', '16-30');
    $sheet->setCellValue('G4', '31-60');
    $sheet->setCellValue('H4', '61-89');
    $sheet->setCellValue('I4', '>90');

    // $sheet->setCellValue('G3', 'Up to Class V');
    // $sheet->setCellValue('G4', 'Female');
    // $sheet->setCellValue('H4', 'Male');
   
    $rows = 5;
    $count = 1;
    foreach ($data['report_result'] as $value)
    {
      $sheet->setCellValue('A' . $rows, $count++);
      $sheet->setCellValue('B' . $rows, $value['name']);
      $sheet->setCellValue('C' . $rows, $value['total_due']);

      $sheet->setCellValue('D' . $rows, ($value['pending_1_7_days'] != 0)?($value['pending_1_7_days']):0);
      $sheet->setCellValue('E' . $rows, ($value['pending_8_15_days'] != 0)?($value['pending_8_15_days']):0 );

      $sheet->setCellValue('F' . $rows, ($value['pending_16_30_days'] != 0)?($value['pending_16_30_days']):0 );
      $sheet->setCellValue('G' . $rows, ($value['pending_31_60_days'] != 0)?($value['pending_31_60_days']):0);

      $sheet->setCellValue('H' . $rows, ($value['pending_61_90_days'] != 0)?($value['pending_61_90_days']):0 );
      $sheet->setCellValue('I' . $rows, ($value['pending_above_90_days'] != 0)?($value['pending_above_90_days']):0);

      

      $rows++;



      //SHOW TOTAL 
    $total_row = count($report_result);
    if($total_row>1)
    {
      $total_row = $total_row + 5;

      $sheet->mergeCells('A'.$total_row.':'.'B'.$total_row);
      $sheet->getStyle('A'.$total_row.':'.'I'.$total_row)->getFont()->setBold(true)->setName('Calibri')->setSize(13);
      $sheet->getStyle('A'.$total_row.':'.'I'.$total_row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('DCE6F1');
      $sheet->setCellValue('A' . $total_row,'Total :');

      $sheet->setCellValue('C' . $total_row,array_sum(array_column($report_result, 'total_due')));
      $sheet->setCellValue('D' . $total_row,array_sum(array_column($report_result, 'pending_1_7_days')));

      $sheet->setCellValue('E' . $total_row,array_sum(array_column($report_result, 'pending_8_15_days')));
      $sheet->setCellValue('F' . $total_row,array_sum(array_column($report_result, 'pending_16_30_days')));

      $sheet->setCellValue('G' . $total_row,array_sum(array_column($report_result, 'pending_31_60_days')));
      $sheet->setCellValue('H' . $total_row,array_sum(array_column($report_result, 'pending_61_90_days')));
      $sheet->setCellValue('I' . $total_row,array_sum(array_column($report_result, 'pending_above_90_days')));
 
    }

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

  public function us_date_format($uk_date=NULL)
  {
    if($uk_date != NULL){
       $date_array = explode('/', $uk_date);
       return $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
    } else {
       return NULL;
    }
  }

  public function convert_date_format($date=NULL) 
  {
    if ($date!=NULL) 
    {
      // code...
    // Create DateTime object from the input date string
      $dateTime = DateTime::createFromFormat('d/m/Y', $date);

      // Check if the date is valid in the given format
      if ($dateTime === false) 
      {
          // If not in d/m/Y format, attempt to create DateTime object with other formats
          $dateTime = DateTime::createFromFormat('Y-m-d', $date);
          if ($dateTime === false) {
              return "Invalid date format";
          }
      }

      // Convert the date to "dd/mm/yyyy" format
      $newDate = $dateTime->format('d/m/Y');
      return $newDate;
    }
    else
    {
      return NULL;
    }
  }

  // public function date_check($date)
  // {

  //   // echo $date;die;
  //   $currentDate = date('d/m/Y');
  //   if(empty($date)){
  //     $this->form_validation->set_message('date_check', 'The Date field is required');

  //       return false;

  //   }else{
  //     $date_array = explode('/', $date);
  //      $to_date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

  //      $date_array1 = explode('/', $currentDate);
  //      $currentDate =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];

  //     // echo strtotime($fir_date)."-----".strtotime($incident_date).'<br>' ; 
  //     // echo $to_date."-----".$currentDate ; die;
  //     if(strtotime($to_date)>strtotime($currentDate))
  //     {
  //       $this->form_validation->set_message('date_check', 'The entered date should not be more then current date');
  //       return false;
  //     }
  //       return true;
  //   }

  // }

  public function minor_due_test()
  {
    // echo 22323;
    $data['for_adult_minor'] = 1;
    $data['force_view'] = 0;
    $data['hide_search'] = 0;
    $data['district_details'] = $this->Dashboard_model->district_details($this->session->userdata('login_id'));

    $data1 = $response = $this->get_minor_adult_request();

    if(!empty($data))
    {
      $data['force_view'] = 1;
    }


    echo "<pre>"; print_r($data1);echo"</pre>";
    $this->load->view($this->config->item('theme').'mis/home_enquiry_minor_due_report/home_enquiry_minor_due_report_view', $data);
    // // Load the Redirect_helper controller
    // $this->load->controller('Redirect_helper');
    // // Use the helper function to redirect with POST data
    // $this->Redirect_helper->redirect_with_post('index', $data);
  }

  public function valid_date($str) {
    if(empty($str)){
      $this->form_validation->set_message('valid_date', 'The Date of Birth field is required.');
      return false; // Invalid date
    }else{
      $custom_format = 'd/m/Y';
      $date = DateTime::createFromFormat($custom_format, $str);

      if ($date && $date->format($custom_format) === $str) {
        
        return true; // Invalid date
      } else {
          $this->form_validation->set_message('valid_date', 'The Date of Birth field must be in the format dd/mm/yyyy.');
          return false; // Invalid date
      }

    }
  }

  public function date_check_with_current($str)
  {
    // echo $str;die;
    $currentDate = date('d/m/Y'); 
    if(empty($str))
    {
      $this->form_validation->set_message('date_check_with_current', 'The Date field is required');
        return false;
    }
    else
    {
      $custom_format = 'd/m/Y';
      $date = DateTime::createFromFormat($custom_format, $str);

      if($date && $date->format($custom_format) === $str)
      {
        $date_array = explode('/', $str);
        $to_date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

        $date_array1 = explode('/', $currentDate);
        $currentDate =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];
        if(strtotime($to_date)>strtotime($currentDate))
        {
          $this->form_validation->set_message('date_check_with_current', 'The entered date should not be more then current date');
          return false;
        }
        return true;
      }
      else
      {
        $this->form_validation->set_message('date_check_with_current', 'The Date field must be in the format dd/mm/yyyy.');
        return false;
      }
    }
  }

  public function date_check_with_Todate($str,$to_date)
  {
    // echo $str."--------------------------".$to_date;die;
    $currentDate = date('d/m/Y'); 
    if(empty($str))
    {
      $this->form_validation->set_message('date_check_with_Todate', 'The {field} field is required');
        return false;
    }
    else
    {
      $custom_format = 'd/m/Y';
      $date = DateTime::createFromFormat($custom_format, $str);
      $date1 = DateTime::createFromFormat($custom_format, $to_date);

      if($date && $date1 && $date->format($custom_format) === $str)
      {
        $date_array = explode('/', $str);
        $from_date =  $date_array[2].'-'.$date_array[1].'-'.$date_array[0];

        $date_array1 = explode('/', $to_date);
        $to_date =  $date_array1[2].'-'.$date_array1[1].'-'.$date_array1[0];

        // echo $from_date."----------------".$to_date;die;
        // echo strtotime($from_date)."----------------".strtotime($to_date);die;


        if(strtotime($from_date)>strtotime($to_date))
        {
          $this->form_validation->set_message('date_check_with_Todate', 'The {field} should not be more then To date');
          return false;
        }
        return true;
      }
      else
      {
        $this->form_validation->set_message('date_check_with_Todate', 'The Date field must be in the format dd/mm/yyyy.');
        return false;
      }
    }
  }


  public function get_minor_adult_request()
  {
    $data['for_adult_minor'] = NULL;


    $data['force_view'] = 0;
    $data['delete_status'] = 0;
    $data['current_status'] = 3;
    $data['hide_search'] = 0;
    $data['active_status'] = 1;
    $data['district_details'] = $this->Dashboard_model->district_details($this->session->userdata('login_id'));

    // if($this->input->get('segregate'))
    if($this->input->get())
    {
      // echo "<pre>";print_r($_GET);die;
      $data['force_view'] = 1;
      $data['hide_search'] = 1;
      $data['from_date'] = $this->input->get('from_date');
      $data['to_date'] = $this->input->get('to_date');
      $data['segregate'] = $this->input->get('segregate');
      $data['unique_id'] = $this->input->get('unique_id');
      $data['for_adult_minor'] = $this->input->get('for_adult_minor');
      if(isset($data['for_adult_minor']))
      {
        if($data['for_adult_minor'] == 1)
        {
          $data['cp_age_minor'] = 101;
        }
        else
        {
          $data['cp_age_adult'] = 101;
        }
      }

      if($data['segregate'] == 'district')
      {
        $data['field_selection'] = $this->block_wise['field_selection'];
            $data['group_by'] = $this->block_wise['group_by'];
        $data['district'] = $data['unique_id'];
        $data['segregate'] = 'block';
        $data['order_by'] = $this->block_wise['order_by'];
      }
      else if($data['segregate'] == 'block')
      {
        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['unique_id']);
        if(!empty($Identity_Ward_Gp_Block))
        {
          if($Identity_Ward_Gp_Block->rural_urban == 'U')
          {
            $data['is_ward'] = 1;
            $data['field_selection'] = $this->ward_wise['field_selection'];
            $data['group_by'] = $this->ward_wise['group_by'];
            $data['order_by'] = $this->ward_wise['order_by'];
            // $data['field_selection'] = "cmir.ward_gp as unique_id, wmstr.ward_no as name, ward_master_description(cmir.ward_gp),";
            // $data['field_selection'] = "cmir.ward_gp as unique_id, get_ward_gp_no(".$data['unique_id'].",cmir.ward_gp) as name,";
            // $data['group_by'] = 'cmir.block';
          }
          else
          {
            $data['is_gp'] = 1;
            $data['field_selection'] = $this->gp_wise['field_selection'];
            $data['group_by'] = $this->gp_wise['group_by'];
            $data['order_by'] = $this->gp_wise['order_by'];
            // $data['field_selection'] = "cmir.ward_gp as unique_id,gpmstr.gp_name as name,";
            // $data['field_selection'] = "cmir.ward_gp as unique_id, gpmster.gp_name as name, gp_master_description(),";
             // $data['group_by'] = 'cmir.ward_gp,gpmstr.gp_name';
          //   $data['group_by'] = 'cmir.block';
          }
        }
        // $data['field_selection'] = "cmir.ward_gp as unique_id, get_ward_gp_no(".$data['unique_id'].",cmir.ward_gp) as name,";
        $data['block'] = $data['unique_id'];
        $data['segregate'] = 'ward_gp';
      }


    }
    else if($this->input->method(TRUE) == 'POST')
    {
      // echo 123;die;
        $data['for_adult_minor'] = $this->input->get('for_adult_minor');
        if(isset($data['for_adult_minor']))
        {
          if($data['for_adult_minor'] == 1)
          {
            $data['cp_age_minor'] = 101;
          }
          else
          {
            $data['cp_age_adult'] = 101;
          }
        }

        $data['force_view'] = 1;
        $data['from_date'] = $from_date = $this->us_date_format($this->input->post('from_date'));
        $data['to_date'] = $to_date = $this->us_date_format($this->input->post('to_date'));

        $data['district'] = $this->session->userdata('district');
        $data['block'] = $this->session->userdata('block');
        $data['subdiv'] = $this->session->userdata('subdiv');

        if(empty($data['district']))
        {
          // $data['segregate'] = 'state';
           $data['segregate'] = 'district';
          $data['field_selection'] = $this->district_wise['field_selection'];
          $data['group_by'] = $this->district_wise['group_by'];
          $data['order_by'] = $this->district_wise['order_by'];
        }
        else if(!empty($data['district']) and empty($data['block']))
        {
          // $data['segregate'] = 'district';
          $data['segregate'] = 'block';
          $data['field_selection'] = $this->block_wise['field_selection'];
          $data['group_by'] = $this->block_wise['group_by'];
          $data['order_by'] = $this->block_wise['order_by'];
          // $data['field_selection'] = "cmir.block as unique_id,cmir.block as block_id_pk,block_location_master_description(cmir.block) as name,";
        }
        elseif (!empty($data['district']) and (!empty($data['block']))) 
        {
          // echo 123;die;
          $data['segregate'] = 'ward_gp';
          // $data['segregate'] = 'ward_gp';
          // $data['field_selection'] = "cmir.ward_gp as unique_id,cmir.ward_gp as ward_id_pk, get_ward_gp_no(".$data['block'].",cmir.ward_gp) as name,";
          // $data['group_by'] = 'cmir.ward_gp,cmir.block';
          // $data['block'] = $data['unique_id'] =  ($data['unique_id'])?($data['unique_id']):$this->session->userdata('block');
          $data['unique_id'] = $data['block'];
          $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['block']);
          if(!empty($Identity_Ward_Gp_Block))
          {
            if($Identity_Ward_Gp_Block->rural_urban == 'U')
            {
              $data['is_ward'] = 1;
              $data['field_selection'] = $this->ward_wise['field_selection'];
              $data['group_by'] = $this->ward_wise['group_by'];
              $data['order_by'] = $this->ward_wise['order_by'];
            }
            else
            {
              $data['is_gp'] = 1;
              $data['field_selection'] = $this->gp_wise['field_selection'];
              $data['group_by'] = $this->gp_wise['group_by'];
              $data['order_by'] = $this->gp_wise['order_by'];
            }
          }

        }
        // elseif (!empty($data['district']) and (!empty($data['block']) and $data['block']==0)) 
        // {
        //   $data['segregate'] = 'subdiv';
        // }
    }
      $data['report_result'] = array();
      if($data['force_view'] == 1)
      {
        $data['report_result'] = $this->homeenqModel->get_home_enquiry_due_dtls($data);
      }

      // echo "<pre>";print_r($data);echo"<pre>";

      return $data;

  }

  public function minor_due()
  {
    // echo "<pre>";print_r($_SESSION);echo"</pre>";

    
    $data['for_adult_minor'] = 1;


    $data['force_view'] = 0;
    $data['delete_status'] = 0;
    $data['current_status'] = 3;
    $data['hide_search'] = 0;
    $data['active_status'] = 1;
    $data['district_details'] = $this->Dashboard_model->district_details($this->session->userdata('login_id'));

    // if($this->input->get('segregate'))
    if($this->input->get())
    {
      // echo "<pre>";print_r($_GET);die;
      $data['force_view'] = 1;
      $data['hide_search'] = 1;
      $data['from_date'] = $this->input->get('from_date');
      $data['to_date'] = $this->input->get('to_date');
      $data['segregate'] = $this->input->get('segregate');
      $data['unique_id'] = $this->input->get('unique_id');
      $data['for_adult_minor'] = $this->input->get('for_adult_minor');
      if(isset($data['for_adult_minor']))
      {
        if($data['for_adult_minor'] == 1)
        {
          $data['cp_age_minor'] = 101;
        }
        else if($data['for_adult_minor'] == 2)
        {
          $data['cp_age_adult'] = 101;
        }
      }

      if($data['segregate'] == 'district')
      {
        $data['field_selection'] = $this->block_wise['field_selection'];
            $data['group_by'] = $this->block_wise['group_by'];
        $data['district'] = $data['unique_id'];
        $data['segregate'] = 'block';
        $data['order_by'] = $this->block_wise['order_by'];
      }
      else if($data['segregate'] == 'block')
      {
        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['unique_id']);
        if(!empty($Identity_Ward_Gp_Block))
        {
          if($Identity_Ward_Gp_Block->rural_urban == 'U')
          {
            $data['is_ward'] = 1;
            $data['field_selection'] = $this->ward_wise['field_selection'];
            $data['group_by'] = $this->ward_wise['group_by'];
            $data['order_by'] = $this->ward_wise['order_by'];
            // $data['field_selection'] = "cmir.ward_gp as unique_id, wmstr.ward_no as name, ward_master_description(cmir.ward_gp),";
            // $data['field_selection'] = "cmir.ward_gp as unique_id, get_ward_gp_no(".$data['unique_id'].",cmir.ward_gp) as name,";
            // $data['group_by'] = 'cmir.block';
          }
          else
          {
            $data['is_gp'] = 1;
            $data['field_selection'] = $this->gp_wise['field_selection'];
            $data['group_by'] = $this->gp_wise['group_by'];
            $data['order_by'] = $this->gp_wise['order_by'];
            // $data['field_selection'] = "cmir.ward_gp as unique_id,gpmstr.gp_name as name,";
            // $data['field_selection'] = "cmir.ward_gp as unique_id, gpmster.gp_name as name, gp_master_description(),";
             // $data['group_by'] = 'cmir.ward_gp,gpmstr.gp_name';
          //   $data['group_by'] = 'cmir.block';
          }
        }
        // $data['field_selection'] = "cmir.ward_gp as unique_id, get_ward_gp_no(".$data['unique_id'].",cmir.ward_gp) as name,";
        $data['block'] = $data['unique_id'];
        $data['segregate'] = 'ward_gp';
      }


    }
    else if($this->input->method(TRUE) == 'POST')
    {

      // echo 123;die;
        $data['for_adult_minor'] = $this->input->post('for_adult_minor');
        if(isset($data['for_adult_minor']))
        {
          if($data['for_adult_minor'] == 1)
          {
            $data['cp_age_minor'] = 101;
          }
          else if($data['for_adult_minor'] == 2)
          {
            $data['cp_age_adult'] = 101;
          }
        }

        $data['force_view'] = 1;
        $data['from_date'] = $from_date = $this->us_date_format($this->input->post('from_date'));
        $data['to_date'] = $to_date = $this->us_date_format($this->input->post('to_date'));

        $data['district'] = $this->session->userdata('district');
        $data['block'] = $this->session->userdata('block');
        $data['subdiv'] = $this->session->userdata('subdiv');

        if(empty($data['district']))
        {
          // $data['segregate'] = 'state';
           $data['segregate'] = 'district';
          $data['field_selection'] = $this->district_wise['field_selection'];
          $data['group_by'] = $this->district_wise['group_by'];
          $data['order_by'] = $this->district_wise['order_by'];
        }
        else if(!empty($data['district']) and empty($data['block']))
        {
          // $data['segregate'] = 'district';
          $data['segregate'] = 'block';
          $data['field_selection'] = $this->block_wise['field_selection'];
          $data['group_by'] = $this->block_wise['group_by'];
          $data['order_by'] = $this->block_wise['order_by'];
          // $data['field_selection'] = "cmir.block as unique_id,cmir.block as block_id_pk,block_location_master_description(cmir.block) as name,";
        }
        elseif (!empty($data['district']) and (!empty($data['block']))) 
        {
          // echo 123;die;
          $data['segregate'] = 'ward_gp';
          // $data['segregate'] = 'ward_gp';
          // $data['field_selection'] = "cmir.ward_gp as unique_id,cmir.ward_gp as ward_id_pk, get_ward_gp_no(".$data['block'].",cmir.ward_gp) as name,";
          // $data['group_by'] = 'cmir.ward_gp,cmir.block';
          // $data['block'] = $data['unique_id'] =  ($data['unique_id'])?($data['unique_id']):$this->session->userdata('block');
          $data['unique_id'] = $data['block'];
          $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['block']);
          if(!empty($Identity_Ward_Gp_Block))
          {
            if($Identity_Ward_Gp_Block->rural_urban == 'U')
            {
              $data['is_ward'] = 1;
              $data['field_selection'] = $this->ward_wise['field_selection'];
              $data['group_by'] = $this->ward_wise['group_by'];
              $data['order_by'] = $this->ward_wise['order_by'];
            }
            else
            {
              $data['is_gp'] = 1;
              $data['field_selection'] = $this->gp_wise['field_selection'];
              $data['group_by'] = $this->gp_wise['group_by'];
              $data['order_by'] = $this->gp_wise['order_by'];
            }
          }

        }
        // elseif (!empty($data['district']) and (!empty($data['block']) and $data['block']==0)) 
        // {
        //   $data['segregate'] = 'subdiv';
        // }
    }
      $data['report_result'] = array();
      if($data['force_view'] == 1)
      {
        $data['report_result'] = $this->homeenqModel->get_home_enquiry_due_dtls($data);
      }

      // echo "<pre>";print_r($data);
      // echo "</pre>";
    // DIE;

    $this->load->view($this->config->item('theme').'mis/home_enquiry_minor_due_report/home_enquiry_minor_due_report_view', $data);
  }

  public function adult_due()
  {
    // echo "<pre>";print_r($_SESSION);echo"</pre>";
    $data['for_adult_minor'] = 2;


    $data['force_view'] = 0;
    $data['delete_status'] = 0;
    $data['current_status'] = 3;
    $data['hide_search'] = 0;
    $data['active_status'] = 1;
    $data['district_details'] = $this->Dashboard_model->district_details($this->session->userdata('login_id'));

    // if($this->input->get('segregate'))
    if($this->input->get())
    {
      // echo "<pre>";print_r($_GET);die;
      $data['force_view'] = 1;
      $data['hide_search'] = 1;
      $data['from_date'] = $this->input->get('from_date');
      $data['to_date'] = $this->input->get('to_date');
      $data['segregate'] = $this->input->get('segregate');
      $data['unique_id'] = $this->input->get('unique_id');
      $data['for_adult_minor'] = $this->input->get('for_adult_minor');
      if(isset($data['for_adult_minor']))
      {
        if($data['for_adult_minor'] == 1)
        {
          $data['cp_age_minor'] = 101;
        }
        else if($data['for_adult_minor'] == 2)
        {
          $data['cp_age_adult'] = 101;
        }
      }

      if($data['segregate'] == 'district')
      {
        $data['field_selection'] = $this->block_wise['field_selection'];
            $data['group_by'] = $this->block_wise['group_by'];
        $data['district'] = $data['unique_id'];
        $data['segregate'] = 'block';
        $data['order_by'] = $this->block_wise['order_by'];
      }
      else if($data['segregate'] == 'block')
      {
        $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['unique_id']);
        if(!empty($Identity_Ward_Gp_Block))
        {
          if($Identity_Ward_Gp_Block->rural_urban == 'U')
          {
            $data['is_ward'] = 1;
            $data['field_selection'] = $this->ward_wise['field_selection'];
            $data['group_by'] = $this->ward_wise['group_by'];
            $data['order_by'] = $this->ward_wise['order_by'];
            // $data['field_selection'] = "cmir.ward_gp as unique_id, wmstr.ward_no as name, ward_master_description(cmir.ward_gp),";
            // $data['field_selection'] = "cmir.ward_gp as unique_id, get_ward_gp_no(".$data['unique_id'].",cmir.ward_gp) as name,";
            // $data['group_by'] = 'cmir.block';
          }
          else
          {
            $data['is_gp'] = 1;
            $data['field_selection'] = $this->gp_wise['field_selection'];
            $data['group_by'] = $this->gp_wise['group_by'];
            $data['order_by'] = $this->gp_wise['order_by'];
            // $data['field_selection'] = "cmir.ward_gp as unique_id,gpmstr.gp_name as name,";
            // $data['field_selection'] = "cmir.ward_gp as unique_id, gpmster.gp_name as name, gp_master_description(),";
             // $data['group_by'] = 'cmir.ward_gp,gpmstr.gp_name';
          //   $data['group_by'] = 'cmir.block';
          }
        }
        // $data['field_selection'] = "cmir.ward_gp as unique_id, get_ward_gp_no(".$data['unique_id'].",cmir.ward_gp) as name,";
        $data['block'] = $data['unique_id'];
        $data['segregate'] = 'ward_gp';
      }


    }
    else if($this->input->method(TRUE) == 'POST')
    {

      // echo 123;die;
        $data['for_adult_minor'] = $this->input->post('for_adult_minor');
        if(isset($data['for_adult_minor']))
        {
          if($data['for_adult_minor'] == 1)
          {
            $data['cp_age_minor'] = 101;
          }
          else if($data['for_adult_minor'] == 2)
          {
            $data['cp_age_adult'] = 101;
          }
        }

        $data['force_view'] = 1;
        $data['from_date'] = $from_date = $this->us_date_format($this->input->post('from_date'));
        $data['to_date'] = $to_date = $this->us_date_format($this->input->post('to_date'));

        $data['district'] = $this->session->userdata('district');
        $data['block'] = $this->session->userdata('block');
        $data['subdiv'] = $this->session->userdata('subdiv');

        if(empty($data['district']))
        {
          // $data['segregate'] = 'state';
           $data['segregate'] = 'district';
          $data['field_selection'] = $this->district_wise['field_selection'];
          $data['group_by'] = $this->district_wise['group_by'];
          $data['order_by'] = $this->district_wise['order_by'];
        }
        else if(!empty($data['district']) and empty($data['block']))
        {
          // $data['segregate'] = 'district';
          $data['segregate'] = 'block';
          $data['field_selection'] = $this->block_wise['field_selection'];
          $data['group_by'] = $this->block_wise['group_by'];
          $data['order_by'] = $this->block_wise['order_by'];
          // $data['field_selection'] = "cmir.block as unique_id,cmir.block as block_id_pk,block_location_master_description(cmir.block) as name,";
        }
        elseif (!empty($data['district']) and (!empty($data['block']))) 
        {
          // echo 123;die;
          $data['segregate'] = 'ward_gp';
          // $data['segregate'] = 'ward_gp';
          // $data['field_selection'] = "cmir.ward_gp as unique_id,cmir.ward_gp as ward_id_pk, get_ward_gp_no(".$data['block'].",cmir.ward_gp) as name,";
          // $data['group_by'] = 'cmir.ward_gp,cmir.block';
          // $data['block'] = $data['unique_id'] =  ($data['unique_id'])?($data['unique_id']):$this->session->userdata('block');
          $data['unique_id'] = $data['block'];
          $Identity_Ward_Gp_Block = $this->Master_model->get_ward_gp_block($data['block']);
          if(!empty($Identity_Ward_Gp_Block))
          {
            if($Identity_Ward_Gp_Block->rural_urban == 'U')
            {
              $data['is_ward'] = 1;
              $data['field_selection'] = $this->ward_wise['field_selection'];
              $data['group_by'] = $this->ward_wise['group_by'];
              $data['order_by'] = $this->ward_wise['order_by'];
            }
            else
            {
              $data['is_gp'] = 1;
              $data['field_selection'] = $this->gp_wise['field_selection'];
              $data['group_by'] = $this->gp_wise['group_by'];
              $data['order_by'] = $this->gp_wise['order_by'];
            }
          }

        }
        // elseif (!empty($data['district']) and (!empty($data['block']) and $data['block']==0)) 
        // {
        //   $data['segregate'] = 'subdiv';
        // }
    }
      $data['report_result'] = array();
      if($data['force_view'] == 1)
      {
        $data['report_result'] = $this->homeenqModel->get_home_enquiry_due_dtls($data);
      }
      // echo "<pre>";print_r($data);
      // echo "</pre>";
    // DIE;

    $this->load->view($this->config->item('theme').'mis/home_enquiry_minor_due_report/home_enquiry_minor_due_report_view', $data);
  }


}
