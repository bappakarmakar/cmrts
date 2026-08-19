<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Generate_scheduler_for_legacy_data extends NIC_Controller {
  

  public function __construct(){ 
      parent::__construct();
      parent::check_privilege();
      $this->load->model('Dashboard_model');
      $this->load->model('incident/incident_list_model');
      $this->load->model('Generate_scheduler_for_legacy_data_model');
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
 
    public function scheduler_generate_till_21_years() //NEW
    {
      $login_id = $this->session->userdata('login_id');
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);
      $district = $this->session->userdata('district');
      $data['dist_data'] = $this->Generate_scheduler_for_legacy_data_model->get_dist_wise_records($district);
      $data['incident_data'] = $this->Generate_scheduler_for_legacy_data_model->get_dist_wise_records($district);

      // echo "<pre>";print_r($data['dist_data']);die;
      $this->load->view($this->config->item('theme').'reporting/incident/scheduler_generate_table_view',$data);
    }


    public function scheduler_generate_by_dist() //DONE
    {
      $login_id = $this->session->userdata('login_id');
      $data['district_details'] = $this->Dashboard_model->district_details($login_id);
      $district = $this->session->userdata('district');
      $data['dist_data'] = $this->Generate_scheduler_for_legacy_data_model->get_scheduler_generate_data_district_view($district);
      $data['incident_data'] = $this->Generate_scheduler_for_legacy_data_model->get_scheduler_generate_data_by_district($district);
      // echo "<pre>";print_r($dist_data);die;
      $this->load->view($this->config->item('theme').'reporting/incident/scheduler_generate_table_view',$data);
    }
   
    public function legacy_data_schd_generate() //DONE
    {
        $district = $this->session->userdata('district');
        $incident_data =  $this->Generate_scheduler_for_legacy_data_model->get_dist_wise_records($district);
        $inc_id = $incident_data[0]->incident_id_pk;
  
        echo "<pre>";print_r($incident_data);die;
  
        foreach ($incident_data as $row) { //Generate scheduler of contracting parties

          if(isset($row->cp_1_id_pk) && !empty($row->cp_1_id_pk)){
            $fu_result  = $this->Generate_scheduler_for_legacy_data_model->insert_date_cp1($row);
          }
          if(isset($row->cp_2_id_pk) && !empty($row->cp_2_id_pk)){
            $fu_result1 = $this->Generate_scheduler_for_legacy_data_model->insert_date_cp2($row);
          }
          //die;


          $update_inc_table = $this->Generate_scheduler_for_legacy_data_model->update_schd_status_inc_table($row->incident_id_pk);

          // print_r($update_inc_table);die;
  
              // ------------------- CP1 Home Enquiry Mapping Code --------------------
              /*if(isset($row->cp_1_id_pk) && !empty($row->cp_1_id_pk)){
                // Get Home Enquiry data-----------------------------------------------
                $exist_home_enq =$this->Generate_scheduler_for_legacy_data_model->get_existing_he_data($row->incident_id_pk, $row->cp_1_id_pk, $row->cp_1_type);
                $home_enq_data = $exist_home_enq->result_array();
  
                if(isset($home_enq_data) && is_array($home_enq_data) && !empty($home_enq_data)){
                $HE_data = $home_enq_data[0];
                  
                  $update_home_enq = $this->Generate_scheduler_for_legacy_data_model->update_scheduler_he_data($HE_data['incident_id_fk'], $HE_data['cp_id_fk'], $HE_data['cp_type'], $HE_data['hv_status']);
  
                  $homenq_slr_id = $HE_data['sl_no'];
                  $updated_scheduler_id = $update_home_enq[0]->scheduler_id;
                  $update_he_schd = $this->Generate_scheduler_for_legacy_data_model->update_home_enquiry_data($homenq_slr_id, $updated_scheduler_id);
                }
              }*/
              
              // ----------------- CP2 Home Enquiry Mapping Code ----------------------
              /*if(isset($row->cp_2_id_pk) && !empty($row->cp_2_id_pk)){
               
                // Get Home Enquiry data-----------------------------------------------
                $exist_home_enq =$this->Generate_scheduler_for_legacy_data_model->get_existing_he_data($row->incident_id_pk, $row->cp_2_id_pk, $row->cp_2_type);
                $home_enq_data = $exist_home_enq->result_array();
                // echo "<pre>";print_r($HE_data);
  
                if(isset($home_enq_data) && is_array($home_enq_data) && !empty($home_enq_data)){
                $HE_data = $home_enq_data[0];
                  
                  $update_home_enq = $this->Generate_scheduler_for_legacy_data_model->update_scheduler_he_data($HE_data['incident_id_fk'], $HE_data['cp_id_fk'], $HE_data['cp_type'], $HE_data['hv_status']);
                  $homenq_slr_id = $HE_data['sl_no'];
                  $updated_scheduler_id = $update_home_enq[0]->scheduler_id;
                  $update_he_schd = $this->Generate_scheduler_for_legacy_data_model->update_home_enquiry_data($homenq_slr_id, $updated_scheduler_id);
                }
              }*/
  
              // CP1 Follow-up Section
              if(isset($row->cp_1_id_pk) && !empty($row->cp_1_id_pk)){
  
                // Get CP1 Follow-up data---------------------------------------------------
                $exist_followup =$this->Generate_scheduler_for_legacy_data_model->get_existing_followup_data($row->incident_id_pk, $row->cp_1_id_pk, $row->cp_1_type);
                $count = $exist_followup->num_rows();
                $followup_data = $exist_followup->result_array();
                // echo "<pre>"; print_r($followup_data);die;
  
                if(isset($followup_data) && is_array($followup_data) && !empty($followup_data)){
                  // update Scheduler Status
                  $counter = 1;
                  foreach ($followup_data as $key => $fv_data) {
                    $key = $counter;
                    $last_update_scheduler =$this->Generate_scheduler_for_legacy_data_model->update_fuv_scheduler_status($key, $fv_data['incident_id_fk'],$fv_data['cp_id_fk'], $fv_data['cp_type'], $fv_data['fv_status']);
                    
                    if (is_array($last_update_scheduler) && !empty($last_update_scheduler) && isset($last_update_scheduler[0]->scheduler_id)) {
                      $followup_slr_id = $fv_data['sl_no'];
                      $last_updated_scheduler_id = $last_update_scheduler[0]->scheduler_id;
                      $update_followup = $this->Generate_scheduler_for_legacy_data_model->update_followup_by_scheduler($followup_slr_id, $last_updated_scheduler_id);
                    }
                    $counter++; 
                  }
                }
              }
  
              // CP2 Follow-up Section
              if(isset($row->cp_2_id_pk) && !empty($row->cp_2_id_pk)){
                // Get CP2 Follow-up data---------------------------------------------------
                $exist_followup =$this->Generate_scheduler_for_legacy_data_model->get_existing_followup_data($row->incident_id_pk, $row->cp_2_id_pk, $row->cp_2_type);
                $count = $exist_followup->num_rows();
                $followup_data = $exist_followup->result_array();
  
                // echo "<pre>"; print_r($followup_data);
                
                if(isset($followup_data) && is_array($followup_data) && !empty($followup_data)){
                  // update Scheduler Status
                  $counter = 1;
                  foreach ($followup_data as $key => $fv_data) {
                    $key = $counter;
                    $last_update_scheduler =$this->Generate_scheduler_for_legacy_data_model->update_fuv_scheduler_status($key, $fv_data['incident_id_fk'],$fv_data['cp_id_fk'], $fv_data['cp_type'], $fv_data['fv_status']);
                    
                    if (is_array($last_update_scheduler) && !empty($last_update_scheduler) && isset($last_update_scheduler[0]->scheduler_id)) {
                      $followup_slr_id = $fv_data['sl_no'];
                      $last_updated_scheduler_id = $last_update_scheduler[0]->scheduler_id;
                      $update_followup = $this->Generate_scheduler_for_legacy_data_model->update_followup_by_scheduler($followup_slr_id, $last_updated_scheduler_id);
                    }
                    $counter++;
                  }
                }
              }
        }

       // redirect('admin/Generate_scheduler_for_legacy_data/scheduler_generate_by_dist');
    }
  
        
  }
  
      
  