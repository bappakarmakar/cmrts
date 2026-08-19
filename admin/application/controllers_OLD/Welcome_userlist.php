<?php
defined('BASEPATH') OR exit('No direct script access allowed' );
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class welcome extends NIC_Controller {


public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('mis/CM_report_model');
    $this->load->model('common/Master_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/css/jquery-ui.css',

    );
    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }

  public function index() 
  {

  	$query = $this->db->select('*')
  						->from('cm_incident_report_publish_track_details')
  						//->where('current_status',3)
  						->get()
  						->result_array();
  	foreach ($query as $key => $value) {
      $incident_id_fk = $value['incident_id_fk'];
      $updateData = $value['created_at'];
     
      /*$this->db->where('incident_id_pk',$incident_id_fk);
      $this->db->update('cm_incident_report', $updateData);
      echo $this->db->last_query();
echo $incident_id_fk.'==='.$updateData;die();*/
  		
  	}					
  }
  public function test(){
    $login_id_array = array();
    $query = $this->db->select('district_name, district_id_pk')
     ->from('rp_location_master_district')
     ->where('LENGTH(schcd) =', 4 )
     ->order_by('district_name','ASC')
     ->get();
     $district_array = $query->result_array();
     foreach ($district_array as $key => $value) {

      $district_id_pk = $value['district_id_pk'];

        $subquery = $this->db->select('*')
       ->from('cm_stake_holder_login')
       ->where(array('district' => $district_id_pk, 'stake_id_fk' => 6,'subdiv is not ' => null))
       ->get();
         $sdo_array = $subquery->result_array();
         foreach ($sdo_array as $key1 => $value1) {
          $subdiv_id = $value1['subdiv'];

          $subdiv_query = $this->db->select('*')
           ->from('rp_location_master_subdiv')
           ->where(array('subdiv_id_pk'=>$subdiv_id ))
           ->get()->row_array();
           $login_id_array[$key][$key1]['district_name'] = $value['district_name'];
           $login_id_array[$key][$key1]['subdiv_name'] = ($subdiv_query)?$subdiv_query['subdiv_name']:'';
           $login_id_array[$key][$key1]['login_id'] = $value1['login_id'];
           $login_id_array[$key][$key1]['subdiv'] = $value1['subdiv'];

         }
         
     }
     $insetUserData = array();
     foreach ($login_id_array as $key3 => $value3) {
      foreach ($value3 as $key4 => $value4) {
          $subdiv_id = $value4['subdiv'];
          $subdiv_login_id_query = $this->db->select("*")
           ->from("rp_location_master_block as block")
           ->join("rp_location_master_district as district", "block.district_id_fk = district.district_id_pk")
           ->join("rp_location_master_subdiv as subdiv", "block.clucd = subdiv.schcd")
           ->where("block.subdiv_id_fk", $subdiv_id)
           ->order_by('block_name', 'asc')
           ->get()->result_array();
           $insetUserData[$key3][$key4]['district_name'] = $value4['district_name'];
            $insetUserData[$key3][$key4]['subdiv_name'] = $value4['subdiv_name'];
            $insetUserData[$key3][$key4]['login_id'] = $value4['login_id'];
            $insetUserData[$key3][$key4]['subdiv'] = $value4['subdiv'];
           foreach ($subdiv_login_id_query as $key => $value) {
              $block_name = $value['block_name'];
              $subdiv_name = $value['subdiv_name'];
              $block_id_pk = $value['block_id_pk'];
              $newString = str_replace(' ', '-', $block_name);
              $user_name = "DEO.".$newString.'.'.$subdiv_name;
              $insetUserData[$key3][$key4]['deo'][$key]['deo_login_id'] = $user_name;
              $insetUserData[$key3][$key4]['deo'][$key]['block_name'] = $value['block_name'];
              $insetUserData[$key3][$key4]['deo'][$key]['district_name'] = $value4['district_name'];
           }
      }
       
     }

     $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


    $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(30);
    $sheet->getColumnDimension('E')->setWidth(21);
    $sheet->getColumnDimension('F')->setWidth(30);

    $sheet->setCellValue('A1','Login credentials for newly registered users');
    $sheet->mergeCells('A1:G1');
    $sheet->getStyle('A1:G1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->setCellValue('A2', 'Sl. No');
    $sheet->setCellValue('C2', 'District');
    $sheet->setCellValue('D2', 'Sub-div');
    $sheet->setCellValue('E2', 'Block / Municipality');
    $sheet->setCellValue('F2', 'Username');
    $rows = 3;
    $count = 1;

     foreach ($insetUserData as $key => $value) {
      foreach ($value as $key1 => $value1) {
          $sheet->setCellValue('A' . $rows, $count++);
          $sheet->setCellValue('C' . $rows, $value1['district_name']);
          $sheet->setCellValue('D' . $rows, $value1['subdiv_name']);
          $sheet->setCellValue('F' . $rows, $value1['login_id']);
          $rows++;
          //echo '<pre>';print_r($value1);die();
          if(isset($value1['deo'])){

            foreach ($value1['deo'] as $key => $value3) {
              $sheet->setCellValue('A' . $rows, $count++);
              $sheet->setCellValue('C' . $rows, $value1['district_name']);
              $sheet->setCellValue('D' . $rows, $value1['subdiv_name']);
              $sheet->setCellValue('E' . $rows, $value3['block_name']);
              $sheet->setCellValue('F' . $rows, $value3['deo_login_id']);
              $rows++;
            }

          }
        
        
      }
       
     }

     $fileName = 'cmrts_new_userlist';
      $writer = new Xlsx($spreadsheet);
      header("Content-Type: application/vnd.ms-excel");
      header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
      header('Cache-Control: max-age=0');
      $writer->save('php://output');

     
     
  }

  public function block_test(){
    $login_id_array = array();
    $query = $this->db->select('district_name, district_id_pk')
     ->from('rp_location_master_district')
     ->where('LENGTH(schcd) =', 4 )
     ->order_by('district_name','ASC')
     ->get();
     $district_array = $query->result_array();

     foreach ($district_array as $key => $value) {

      $district_id_pk = $value['district_id_pk'];

        $subquery = $this->db->select('*')
       ->from('cm_stake_holder_login')
       ->where(array('district' => $district_id_pk, 'stake_id_fk' =>2))
       ->get();
         $bdo_array = $subquery->result_array();
         
         foreach ($bdo_array as $key2 => $value2) {
          $block_id = $value2['block'];
          $block_query =  $this->db->select('*')
           ->from('rp_location_master_block')
           ->where(array('block_id_pk' => $block_id))
           ->get()->row_array();
          $insetUserData[$key][$key2]['district_name'] = $value['district_name'];
          $insetUserData[$key][$key2]['block_name'] = ($block_query)?$block_query['block_name']:'';
          $insetUserData[$key][$key2]['login_id'] = $value2['login_id'];

          $block_id = $value2['block'];
            $bdoquery = $this->db->select('*')
           ->from('cm_stake_holder_login')
           ->where(array('block' => $block_id, 'stake_id_fk' =>4))
           ->get()->row_array();

           if(!empty($bdoquery)){
            $deo_block_id = $bdoquery['block'];
            $deo_block_query =  $this->db->select('*')
           ->from('rp_location_master_block')
           ->where(array('block_id_pk' => $deo_block_id))
           ->get()->row_array(); 
            $insetUserData[$key][$key2]['deo'][$key2]['login_id'] = $bdoquery['login_id'];
            $insetUserData[$key][$key2]['deo'][$key2]['block_name'] = ($deo_block_query)?$deo_block_query['block_name']:'';
           }
           
         }
         
     }

     $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('B2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('C2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('D2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');
    $sheet->getStyle('F2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('33ccff');

    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


    $sheet->getStyle('A')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('C')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('D')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('E')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('F')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->getColumnDimension('A')->setWidth(10);
    $sheet->getColumnDimension('C')->setWidth(25);
    $sheet->getColumnDimension('D')->setWidth(30);
    $sheet->getColumnDimension('E')->setWidth(21);
    $sheet->getColumnDimension('F')->setWidth(30);

    $sheet->setCellValue('A1','Login credentials for newly registered users');
    $sheet->mergeCells('A1:G1');
    $sheet->getStyle('A1:G1')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    $sheet->setCellValue('A2', 'Sl. No');
    $sheet->setCellValue('C2', 'District');
    $sheet->setCellValue('D2', 'Block');
    $sheet->setCellValue('F2', 'Username');
    $rows = 3;
    $count = 1;



     $bdo_deo_data_array = array();
     foreach ($insetUserData as $key => $value) {
      foreach ($value as $key1 => $value1) {
        $sheet->setCellValue('A' . $rows, $count++);
        $sheet->setCellValue('C' . $rows, $value1['district_name']);
        $sheet->setCellValue('D' . $rows, $value1['block_name']);
        $sheet->setCellValue('F' . $rows, $value1['login_id']);
        $rows++;
        if(isset($value1['deo'])){

          foreach ($value1['deo'] as $key => $value3) {
              $sheet->setCellValue('A' . $rows, $count++);
              $sheet->setCellValue('C' . $rows, $value1['district_name']);
              $sheet->setCellValue('D' . $rows, $value3['block_name']);
              $sheet->setCellValue('F' . $rows, $value3['login_id']);
              $rows++;
          }

        }
      }
       
     }

      $fileName = 'cmrts_new_userlist';
      $writer = new Xlsx($spreadsheet);
      header("Content-Type: application/vnd.ms-excel");
      header('Content-Disposition: attachment;filename="'. $fileName .'.xlsx"'); 
      header('Cache-Control: max-age=0');
      $writer->save('php://output');
     

     
     
  }



}
  