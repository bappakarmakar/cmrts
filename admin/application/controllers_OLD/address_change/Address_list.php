<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Address_list extends NIC_Controller {

	public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('address/Address_change_list_model');
    $this->load->model('common/Master_model');
    $this->load->model('Dashboard_model');

  }
 
  public function index() 
  {  
    $login_id = $this->session->userdata('login_id');
    $data['state'] = $this->Master_model->get_state_name();
    $data['districts'] = $this->Master_model->get_district();
    $data['district_details'] =$this->Dashboard_model->district_details($login_id);
    $data['incident_details'] =$this->Address_change_list_model->address_change_details();
    // $this->load->view($this->config->item('theme').'reporting/address/add_address_list_view', $data);
    $this->load->view($this->config->item('theme').'address/add_address_list_view', $data);
  }

  public function get_block_data(){
    $block = $this->input->get('block');
    $block_data = $this->Address_change_list_model->get_ward_gp_block($block);
  
      if($block_data->rural_urban=='R'){
        $word_gp_data = $this->Address_change_list_model->get_gp($block);
      }else if($block_data->rural_urban=='U'){
        $word_gp_data = $this->Address_change_list_model->get_ward($block);
      }
      $block_gp_data = array(
                          'block_rural_urban' => $block_data->rural_urban,
                          'block_gp_data'     => $word_gp_data,
                      );
      // print_r($block_gp_data);
      echo json_encode($block_gp_data);
  }
 
  public function address_change_all_action(){

    date_default_timezone_set('Asia/Kolkata');
    $address_change_id_pk = $this->input->get('address_change_id');
    $address_change_id    = base64_decode($address_change_id_pk);
    $cp_id  = $this->input->get('cp_id');
    $cp_id  = base64_decode($cp_id);
    $action = $this->input->get('action');
    // echo $address_change_id.'--'.$action;die;

    $current_date = date('Y-m-d H:i:s');
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];// Check for client IP
    } else {
        // Fallback to REMOTE_ADDR if no proxy headers are found
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $current_ip  = explode(',', $ip)[0];
    $stake_id_fk = $this->session->userdata('stake_id_fk');
    $login_id    = $this->session->userdata('stake_holder_login_id_pk');
  
      if($action=='forward'){
        $save_data = array(
          'current_status'        => 2,
          'forward_by'            => $login_id,
          'forward_by_stake_id_fk'=> $stake_id_fk,
          'forward_date'          => $current_date,
          'forward_by_ip'         => $current_ip
        );

        $address_status = array('address_change_status' =>2);
      }
      if($action=='delete'){
        $save_data = array(
          'delete_status'      => 1,
          'deleted_by'         => $login_id,
          'deleted_by_stake_id'=> $stake_id_fk,
          'deleted_at'         => $current_date,
          'deleted_ip'         => $current_ip
        );

        $address_status = array(
          'address_change_status' =>null,
          'address_change_created_at' =>null
        );
      }
      if($action=='revert'){
        $save_data = array('current_status'=>4);
        $address_status = array('address_change_status'=>4);
      }
      // print_r($save_data);die;
      $result = $this->db->where('address_change_id_pk', $address_change_id)
                 ->update('cm_cp_address_change_data', $save_data);

      $update_res = $this->db->where('cp_id_pk', $cp_id)
            ->update('cm_incident_report_contracting_parties', $address_status);
      // echo $this->db->last_query();die;
      if ($result) {
          echo json_encode(array('status'=>true, 'message'=>'Address updated successfully.'));
      } else {
          echo json_encode(array('status'=>false, 'message'=>'Failed to update the Address.'));
      }
  }

  public function publish_address_change(){

    date_default_timezone_set('Asia/Kolkata');
    // print_r($this->session->userdata());die;
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $current_ip = explode(',', $ip)[0];

    $decode_address_change_id = $this->input->get('address_change_id');
    $address_change_id = base64_decode($decode_address_change_id);

    $incident_id_fk = $this->input->get('incident_id_fk');
    $incident_id_fk = base64_decode($incident_id_fk);

    $reporting_id = $this->input->get('reporting_id');
    $reporting_id = base64_decode($reporting_id);

    $cp_id_fk = $this->input->get('cp_id_fk');
    $cp_id_fk = base64_decode($cp_id_fk);

    $cp_type = $this->input->get('cp_type');
    $cp_type = base64_decode($cp_type);

    $incident_date = $this->input->get('incident_date');
    $incident_date = base64_decode($incident_date);

    //echo $address_change_id.'--'.$incident_id_fk.'--'.$reporting_id.'--'.$cp_id_fk.'--'.$cp_type.'---'.$incident_date;

    $exist_publish_address =$this->Address_change_list_model->address_exist_cnt($cp_id_fk);
    $address_change_data   =$exist_publish_address->result_array();
    $change_address_cnt =$exist_publish_address->num_rows();

    // Get login data from table
    $get_data =$this->Address_change_list_model->address_data($address_change_id, $incident_id_fk, $cp_id_fk, $change_address_cnt);

    // Get CP current data
    $cp_address =$this->Address_change_list_model->cp_current_address($cp_id_fk);
    // echo "<pre>";
    // print_r($get_data);
    // print_r($cp_address);die;
    $current_date = date('Y-m-d H:i:s');

    $cp_current_address = array(
                      'address_change_id_fk' => $address_change_id,
                      'incident_id_fk' => $incident_id_fk,
                      'reporting_id' => $reporting_id,
                      'cp_id_fk' => $cp_id_fk,
                      'cp_type' => $cp_type,
                      'incident_date' => $incident_date,
                      'street_landmark' => $cp_address['cp_street_landmark'],
                      'state' => $cp_address['cp_state'],
                      'district' => $cp_address['cp_district'],
                      'block' => $cp_address['cp_block'],
                      'ward_gp' => $cp_address['cp_ward_gp'],
                      'cp_address' => $cp_address['cp_address'],
                      'pin_code' =>  $cp_address['cp_pin_code'],
                      'police_station' => $cp_address['cp_police_station'],
                      'cp_mobile' => $cp_address['cp_phone_no'],
                      'address_change_count' => 1,
                      'address_active_from' => $cp_address['created_at'],
                      'address_active_to' => $current_date
                  );


      if($change_address_cnt<2){
          $log_data = array(
                        'first_address_created_by_cmpo' =>  $get_data['created_stakholder'],
                        'first_address_created_at' => $get_data['created_at'],
                        'first_address_created_ip' => $get_data['created_ip'],
                        'first_address_publish_by_cmpo' => $get_data['publish_by_stake_id_fk'],
                        'first_address_publish_at' => $get_data['publish_date'],
                        'first_address_publish_ip' => $get_data['publish_by_ip'] 
                      );
      }else{

          $log_data =array(
                      'address_update_by_deo' =>  $get_data['created_stakholder'],
                      'address_update_at' => $get_data['created_at'],
                      'address_update_ip' => $get_data['created_ip'],
                      'address_publish_by_sdo_bdo' => $get_data['publish_by_stake_id_fk'],
                      'address_publish_at' => $get_data['publish_date'],
                      'address_publish_ip' => $get_data['publish_by_ip']
                    );
      }

      $address_change_history_data = array_merge($cp_current_address, $log_data);
      $inserted = $this->db->insert('cm_cp_address_change_history', $address_change_history_data);
      // echo $this->db->last_query();
      if($inserted){
          $update_publish_data = array(
                          'current_status' => 3,
                          'publish_by' =>$this->session->userdata('stake_holder_login_id_pk'),
                          'publish_by_stake_id_fk' =>$this->session->userdata('stake_id_fk'),
                          'publish_date' =>$current_date,
                          'publish_by_ip' => $current_ip
                        );
          $result = $this->db->where('address_change_id_pk', $address_change_id)
                     ->update('cm_cp_address_change_data', $update_publish_data);

          // Get CP New Address from address change table and update CP Table address 
          $new_address_data = $this->Address_change_list_model->get_new_address($address_change_id);
          $update_cp_address = array(
                          'cp_street_landmark' => $new_address_data['cp_street_landmark'],
                          'cp_state' => $new_address_data['state'],
                          'cp_district' => $new_address_data['district'],
                          'cp_block' => $new_address_data['block'], 
                          'cp_ward_gp' => $new_address_data['ward_gp'],
                          'cp_address' => $new_address_data['cp_address'],
                          'cp_pin_code' => $new_address_data['pin_code'],
                          'cp_police_station' => $new_address_data['police_station']
                        );
          $result = $this->db->where('cp_id_pk', $new_address_data['cp_id_fk'])
                     ->update('cm_incident_report_contracting_parties', $update_cp_address);

           $update_publish_data = array(
                          'publish_by' =>$this->session->userdata('stake_holder_login_id_pk'),
                          'publish_by_stake_id_fk' =>$this->session->userdata('stake_id_fk'),
                          'publish_date' =>$current_date,
                          'publish_by_ip' => $current_ip
                        );
          $result = $this->db->where('address_change_id_pk', $address_change_id)
                     ->update('cm_cp_address_change_data', $update_publish_data);
        echo 1;
      }else{
        echo 2;
      }
  }

}