<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Address_change_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('address_change/address_change_model');
    $this->load->model('incident/incident_list_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
    );

    $this->js_foot = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
    );
  }

  public function index($cp_id_pk) 
  {
    //echo 123;die;
    $data['left_menu_bar'] = 'address_change';
    $login_id = $this->session->userdata('login_id');
    $this->validate_login(array('2', '6'));
    $cp_id_pk = base64_decode($cp_id_pk);
    $contracting_parties_details = $this->address_change_model->contracting_parties_details_by_cp_id_pk($cp_id_pk);
    if(empty($contracting_parties_details)){
     redirect('admin/reporting/address/address_list/'.base64_encode($sl_no), 'location');
    }else{
      $incident_id_fk = ($contracting_parties_details)?$contracting_parties_details->incident_id_fk:'';
      $cp_id_fk = ($contracting_parties_details)?$contracting_parties_details->cp_id_pk:'';
      $cp_type = ($contracting_parties_details)?$contracting_parties_details->cp_type:'';

      $address_changes_details = $this->address_change_model->address_changes_details_by_id(array('incident_id_fk'=>$incident_id_fk,'cp_id_fk'=>$cp_id_fk,'cp_type'=>$cp_type,'ac_status!='=>2));
      if(!empty($address_changes_details)){
        //print_r($address_changes_details);
        redirect('admin/reporting/address_change/address_change_form/edit/'.base64_encode($address_changes_details->sl_no), 'location');
      }
      
      $incident_id = ($contracting_parties_details)?$contracting_parties_details->incident_id_fk:'';
      $data['contracting_parties_details'] = $contracting_parties_details;
    }
    
    $data['incident_id_pk'] = $incident_id;
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $block = ($this->input->post('block'))?$this->input->post('block'):NULL;
    $data['Ward_Gp_Block'] = $Ward_Gp_Block = $this->Master_model->get_ward_gp_block($block);

    if(!empty($Ward_Gp_Block)){
      if($Ward_Gp_Block->rural_urban == 'U'){
        $data['cp_ward'] = $this->Master_model->get_ward($block);
      }else{
        $data['cp_gp'] = $this->Master_model->get_gp($block);
      }
    }

    $data['districts'] = $this->Master_model->get_district();
    $data['minor_details'] = $this->Master_model->get_minor_details();
    $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
    $data['incident_details'] = $this->address_change_model->incident_list_reporting_details($incident_id);
    $district = ($this->input->post('district'))?$this->input->post('district'):NULL;
    $data['block_details'] = $this->Master_model->get_block($district);
    $this->load->view($this->config->item('theme').'reporting/address_change/address_change_form_view', $data);
  }

  public function create() {
        $data = array();
        $errors_save = array();
        $errors_save_draft = array();
        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');

        $csrf_hash = $this->security->get_csrf_hash();
        $this->load->library('form_validation');
        $this->form_validation_draft = clone $this->form_validation;
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        ################### Save Start ####################

        $this->form_validation->set_rules('district', '<b>District</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('district', '<b>District</b>', 'trim|numeric|max_length[2]');


        $this->form_validation->set_rules('block', '<b>Block / Municipality</b>', 'trim|required|numeric');
        $this->form_validation_draft->set_rules('block', '<b>Block / Municipality</b>', 'trim|numeric');
        
        $this->form_validation->set_rules('ward_gp', '<b>Ward / GP</b>', 'trim|required|numeric');
        $this->form_validation_draft->set_rules('ward_gp', '<b>Ward / GP</b>', 'trim|numeric');
        

        $this->form_validation->set_rules('pin_code', '<b>Pin Code</b>', 'trim|required|numeric|max_length[6]');
        $this->form_validation_draft->set_rules('pin_code', '<b>Pin Code</b>', 'trim|numeric|max_length[6]');


        $this->form_validation->set_rules('police_station', '<b>Police Station</b>', 'trim|required');
        $this->form_validation_draft->set_rules('police_station', '<b>Police Station</b>', 'trim');

        $this->form_validation->set_rules('address', '<b>Address</b>', 'trim|required');
        $this->form_validation_draft->set_rules('address', '<b>Address</b>', 'trim');

        $this->form_validation->set_rules('remarks', '<b>Remarks</b>', 'trim');
        $this->form_validation_draft->set_rules('remarks', '<b>Remarks</b>', 'trim');
        
        ################### Save End ####################


        // Run form validation
        if ($this->form_validation->run() == FALSE) {
            $errors_save = $this->form_validation->error_array();
        }

        if ($this->form_validation_draft->run() == FALSE) {
          $errors_save_draft = $this->form_validation_draft->error_array();
           //echo '<pre>';print_r($errors_save_draft);die();
          if($errors_save==$errors_save_draft){
            $formCompleteStatus = 1;
          }else{
            $formCompleteStatus = 0;
          }
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
        }else{
          

          if($errors_save==$errors_save_draft){
            $formCompleteStatus = 1;
          }else{
            $formCompleteStatus = 0;
          }
          $all_post_data = $this->input->post();
          //echo '<pre>';print_r($all_post_data);die();
        if(empty($all_post_data)){
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
        }else{
          $cp_id_pk = $this->input->post('cp_id_pk');
          $cp_id_pk = base64_decode($cp_id_pk);
          //echo $cp_id_pk;die();
          $action = isset($_POST['action']) ? $_POST['action'] : NULL;
          if($action=='swalSubmit'){
          $contracting_parties_details = $this->address_change_model->contracting_parties_details_by_cp_id_pk($cp_id_pk);

          $incident_id_fk = ($contracting_parties_details)?$contracting_parties_details->incident_id_fk:'';
          $cp_id_fk = ($contracting_parties_details)?$contracting_parties_details->cp_id_pk:'';
          $cp_type = ($contracting_parties_details)?$contracting_parties_details->cp_type:'';

          $address_change_check_status = $this->address_change_model->address_changes_details_by_id(array('incident_id_fk'=>$incident_id_fk,'cp_id_fk'=>$cp_id_fk,'cp_type'=>$cp_type,'ac_status'=>0));
          
          $street_landmark = isset($_POST['street_landmark']) ? $_POST['street_landmark'] : NULL;
          $district = isset($_POST['district']) ? $_POST['district'] : NULL;
          $block = isset($_POST['block']) ? $_POST['block'] : NULL;
          $ward_gp = isset($_POST['ward_gp']) ? $_POST['ward_gp'] : NULL;
          $pin_code = isset($_POST['pin_code']) ? $_POST['pin_code'] : NULL;
          $police_station = isset($_POST['police_station']) ? $_POST['police_station'] : NULL;
          $address = isset($_POST['address']) ? $_POST['address'] : NULL;
          $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : NULL;

          $addressChangeData['incident_id_fk'] =  $incident_id_fk;
          $addressChangeData['cp_id_fk'] =  $cp_id_fk;
          $addressChangeData['cp_type'] = $cp_type;
          $addressChangeData['state'] = 19;
          $addressChangeData['district'] = ($district)?$district:null;
          $addressChangeData['block'] = ($block)?$block:null;
          $addressChangeData['street_landmark'] = $street_landmark;
          $addressChangeData['pin_code'] = ($pin_code)?$pin_code:null;
          $addressChangeData['ward_gp'] = ($ward_gp)?$ward_gp:null;
          $addressChangeData['police_station'] = $police_station;
          $addressChangeData['address'] = $address;
          $addressChangeData['remarks'] = $remarks;
          $addressChangeData['ac_status'] =  $formCompleteStatus;
                    
          $default = $this->load->database('default',TRUE);
          $default->trans_start();
          if(empty($address_change_check_status)){
            $addressChangeData['created_by'] = $stake_holder_login_id_pk;
            $addressChangeData['created_at'] = 'now()';
            $addressChangeData['created_ip'] = $_SERVER['REMOTE_ADDR'];
            $addressChangeInsertstatus = $this->address_change_model->insert_address_change_details($addressChangeData);
          }else{
            $sl_no = $address_change_check_status->sl_no;
            $addressChangeData['updated_by'] = $stake_holder_login_id_pk;
            $addressChangeData['updated_at'] = 'now()';
            $addressChangeData['updated_ip'] = $_SERVER['REMOTE_ADDR'];
            $addressChangeInsertstatus = $this->address_change_model->update_address_change_details($addressChangeData,$sl_no);
          } 

          

          if($addressChangeInsertstatus>0){
            $default->trans_commit();
          }else{
            $default->trans_rollback();
          }
         
        }
        }
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');

        }
        echo json_encode($data);
        
  }
   public function edit($sl_no) 
  {
    //echo 123;die;
    $data['left_menu_bar'] = 'address_change';
    $login_id = $this->session->userdata('login_id');
    $this->validate_login(array('2', '6'));
    $sl_no = base64_decode($sl_no);
    $address_changes_details = address_changes_details_by_id(array('sl_no'=>$sl_no));
    if(empty($address_changes_details)){

    }else{
      $incident_id = ($address_changes_details)?$address_changes_details->incident_id_fk:'';
      $data['address_changes_details'] = $address_changes_details;
      $data['incident_id_pk'] = $incident_id;
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);
      $district = ($address_changes_details)?$address_changes_details->district:'';
      $data['block_details'] = $this->Master_model->get_block($district);

      $block = ($address_changes_details)?$address_changes_details->block:'';
      $data['Ward_Gp_Block'] = $Ward_Gp_Block = $this->Master_model->get_ward_gp_block($block);
      if(!empty($Ward_Gp_Block)){
        if($Ward_Gp_Block->rural_urban == 'U'){
          $data['cp_ward'] = $this->Master_model->get_ward($block);
        }else{
          $data['cp_gp'] = $this->Master_model->get_gp($block);
        }
      }

    }
    
    





    
    

    

    $data['districts'] = $this->Master_model->get_district();
    $data['minor_details'] = $this->Master_model->get_minor_details();
    $data['minor_transfer_details'] = $this->Master_model->get_minor_transfer_details();
    $data['incident_details'] = $this->address_change_model->incident_list_reporting_details($incident_id);
    
    $this->load->view($this->config->item('theme').'reporting/address_change/address_change_edit_form_view', $data);
  }
  public function edit_from_update() {
        $data = array();
        $errors_save = array();
        $errors_save_draft = array();
        $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');

        $csrf_hash = $this->security->get_csrf_hash();
        $this->load->library('form_validation');
        $this->form_validation_draft = clone $this->form_validation;
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        ################### Save Start ####################

        $this->form_validation->set_rules('district', '<b>District</b>', 'trim|required|numeric|max_length[2]');
        $this->form_validation_draft->set_rules('district', '<b>District</b>', 'trim|numeric|max_length[2]');


        $this->form_validation->set_rules('block', '<b>Block / Municipality</b>', 'trim|required|numeric');
        $this->form_validation_draft->set_rules('block', '<b>Block / Municipality</b>', 'trim|numeric');
        
        $this->form_validation->set_rules('ward_gp', '<b>Ward / GP</b>', 'trim|required|numeric');
        $this->form_validation_draft->set_rules('ward_gp', '<b>Ward / GP</b>', 'trim|numeric');
        

        $this->form_validation->set_rules('pin_code', '<b>Pin Code</b>', 'trim|required|numeric|max_length[6]');
        $this->form_validation_draft->set_rules('pin_code', '<b>Pin Code</b>', 'trim|numeric|max_length[6]');


        $this->form_validation->set_rules('police_station', '<b>Police Station</b>', 'trim|required');
        $this->form_validation_draft->set_rules('police_station', '<b>Police Station</b>', 'trim');

        $this->form_validation->set_rules('address', '<b>Address</b>', 'trim|required');
        $this->form_validation_draft->set_rules('address', '<b>Address</b>', 'trim');

        $this->form_validation->set_rules('remarks', '<b>Remarks</b>', 'trim');
        $this->form_validation_draft->set_rules('remarks', '<b>Remarks</b>', 'trim');
        
        ################### Save End ####################


        // Run form validation
        if ($this->form_validation->run() == FALSE) {
            $errors_save = $this->form_validation->error_array();
        }

        if ($this->form_validation_draft->run() == FALSE) {
          $errors_save_draft = $this->form_validation_draft->error_array();
           //echo '<pre>';print_r($errors_save_draft);die();
          if($errors_save==$errors_save_draft){
            $formCompleteStatus = 1;
          }else{
            $formCompleteStatus = 0;
          }
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
        }else{
          

          if($errors_save==$errors_save_draft){
            $formCompleteStatus = 1;
          }else{
            $formCompleteStatus = 0;
          }
          $all_post_data = $this->input->post();
        if(empty($all_post_data)){
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
        }else{
          $address_change_sl_no = $this->input->post('sl_no');
          $address_change_sl_no = base64_decode($address_change_sl_no);

          $action = isset($_POST['action']) ? $_POST['action'] : NULL;
          if($action=='swalSubmit'){
            $address_change_check_status = $this->address_change_model->address_changes_details_by_id(array('sl_no'=>$address_change_sl_no));
            if(empty($address_change_check_status)){
              $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');
            }else{

              $incident_id_fk = ($address_change_check_status)?$address_change_check_status->incident_id_fk:'';
              $cp_id_fk = ($address_change_check_status)?$address_change_check_status->cp_id_fk:'';
              $cp_type = ($address_change_check_status)?$address_change_check_status->cp_type:'';
              $street_landmark = isset($_POST['street_landmark']) ? $_POST['street_landmark'] : NULL;
              $district = isset($_POST['district']) ? $_POST['district'] : NULL;
              $block = isset($_POST['block']) ? $_POST['block'] : NULL;
              $ward_gp = isset($_POST['ward_gp']) ? $_POST['ward_gp'] : NULL;
              $pin_code = isset($_POST['pin_code']) ? $_POST['pin_code'] : NULL;
              $police_station = isset($_POST['police_station']) ? $_POST['police_station'] : NULL;
              $address = isset($_POST['address']) ? $_POST['address'] : NULL;
              $remarks = isset($_POST['remarks']) ? $_POST['remarks'] : NULL;
              $addressChangeData['incident_id_fk'] =  $incident_id_fk;
              $addressChangeData['cp_id_fk'] =  $cp_id_fk;
              $addressChangeData['cp_type'] = $cp_type;
              $addressChangeData['state'] = 19;
              $addressChangeData['district'] = ($district)?$district:null;
              $addressChangeData['block'] = ($block)?$block:null;
              $addressChangeData['street_landmark'] = $street_landmark;
              $addressChangeData['pin_code'] = ($pin_code)?$pin_code:null;
              $addressChangeData['ward_gp'] = ($ward_gp)?$ward_gp:null;
              $addressChangeData['police_station'] = $police_station;
              $addressChangeData['address'] = $address;
              $addressChangeData['remarks'] = $remarks;
              $addressChangeData['ac_status'] =  $formCompleteStatus;
              $default = $this->load->database('default',TRUE);
              $default->trans_start();
              if(empty($address_change_check_status)){
                $addressChangeData['created_by'] = $stake_holder_login_id_pk;
                $addressChangeData['created_at'] = 'now()';
                $addressChangeData['created_ip'] = $_SERVER['REMOTE_ADDR'];
                $addressChangeInsertstatus = $this->address_change_model->insert_address_change_details($addressChangeData);
              }else{
                $sl_no = $address_change_check_status->sl_no;
                $addressChangeData['updated_by'] = $stake_holder_login_id_pk;
                $addressChangeData['updated_at'] = 'now()';
                $addressChangeData['updated_ip'] = $_SERVER['REMOTE_ADDR'];
                $addressChangeInsertstatus = $this->address_change_model->update_address_change_details($addressChangeData,$sl_no);
              }
              if($addressChangeInsertstatus>0){
                $default->trans_commit();
              }else{
                $default->trans_rollback();
              } 

            }          
         
        }
        }
          $data = array('csrf_token_value'=>$csrf_hash,'success'=>false,'draftErrorFields'=>$errors_save_draft,'errorFields'=>$errors_save,'formCompleteStatus'=>$formCompleteStatus,'message'=>'Something Went Wrong. Please check errors.');

        }
        echo json_encode($data);
        
  }

  public function Get_Block_Details()
  {  
      $block_id = $this->input->get('id');
      $block_details = $this->Master_model->get_block_details($block_id);
      echo json_encode($block_details);
  }

  public function Get_Ward_Details()
  {  
      $block_id = $this->input->get('id');
      $ward = $this->Master_model->get_ward_details($block_id);
      echo json_encode($ward);
  }

  public function Get_GP_Details()
  {  
      $block_id = $this->input->get('id');
      $gp = $this->Master_model->get_gp_details($block_id);
      echo json_encode($gp);
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
