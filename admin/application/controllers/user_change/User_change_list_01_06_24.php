<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class User_change_list extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('user/create_user_form_model');
    $this->load->model('Register_model');
    $this->load->model('common/Master_model');
    $this->load->model('user_change/user_change_model');
     $this->load->model('login_model');
    $this->css_head = array(
      1 => $this->config->item('theme_uri').'/assets/datepicker/css/jquery-ui.css',
      2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',

    );
    $this->js_foot = array(
      // 1 => $this->config->item('theme_uri').'/assets/datepicker/js/jquery-1.8.2.js',
      2 => $this->config->item('theme_uri').'assets/js/jquery-ui.js',
      // 3 => $this->config->item('theme_uri').'assets/js/incident_form.js',
      3 => $this->config->item('theme_uri').'assets/js/incident_form_updated1.js',
    );
  }

  public function index() 
  {
    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);

    $data1['requested_district'] = $this->session->userdata('district');
    $data1['requested_block'] = $this->session->userdata('block');
    $data1['requested_subdiv'] = $this->session->userdata('subdiv');

    $stake_id_fk = $this->session->userdata('stake_id_fk');

    // $stake_id_fk = 3;
    $stake_id = NULL;
    $where = array();
    #BDO List Requested by DEO
    if($stake_id_fk == 2)
    {
      $stake = "stake_id_fk in(4)";
      $where['requested_subdiv'] = NULL;
      $where['requested_block'] = $this->session->userdata('block');
    }
    #CMPO List Requested by BDO/MIS/SDO
    elseif ($stake_id_fk == 3) 
    {
      // $where['stake_id_fk'] = array('2','5','6');
      // $where['stake_id_fk'] = "(2,5,6)";
      $stake = "stake_id_fk in(2,5,6)";
      // $where['requested_subdiv'] = NULL;
      $where['requested_district'] = $this->session->userdata('district');
    }
    #SDO List Requested by DEO
    elseif ($stake_id_fk == 6) 
    {
      $stake = "stake_id_fk in(4)";
      $where['requested_subdiv'] = $this->session->userdata('subdiv');
    }
    #SNO List Requested by MIS State/CMPO
    elseif ($stake_id_fk == 1) 
    {
      $stake = "stake_id_fk in(3)";
      $where= "(stake_id_fk in(5) and requested_district is null)";
      $stake_id = 101;
      // $where['requested_district'] = NULL;
    }


  


    // $stake = "stake_id_fk in(0)";

    // echo "<pre>";print_r($where);
    $data['requested_data'] = $this->user_change_model->get_request_list($where,$stake,$stake_id);

    foreach ($data['requested_data'] as $key => $value) 
    {
      if($value['status']==1)
      {
        $data['requested_data'][$key]['musk_unmusk_mobile_no'] = $this->mask_mobile_no($value['mobile_no']);
      }
      else
      {
        $data['requested_data'][$key]['musk_unmusk_mobile_no'] = $value['mobile_no'];
      }
    }

    // echo "<pre>";print_r($data);echo "</pre>";
    $this->load->view($this->config->item('theme').'user_change/user_change_list_view', $data);
  }

  public function approve_request()
  {
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $sl_no = $this->input->get('sl_no');
    $sl_no = base64_decode($sl_no);    
    $id = $this->input->get('stake_holder_login_id_fk');
    $id = base64_decode($id);

    // echo $id."----".$stake_holder_login_id_pk;die;

    $update['status'] = 1;
    $update['approved_by'] = $stake_holder_login_id_pk;
    $update['approved_time'] = date('Y-m-d H:i:s');
    $update['approved_ip'] = $_SERVER['REMOTE_ADDR'];
    $update['archive_status'] = 1;

    $where['sl_no'] = $sl_no;
    $default = $this->load->database('default',TRUE);
    $default->trans_start();

    #Step 1 - update request log table 
    $RequestUpdateStatus = $this->user_change_model->update_request_log($update,$where);


    #Step 2 - insert old user details from login table to archive table
    if($RequestUpdateStatus>0){
      $insert_old_record = $this->user_change_model->get_old_login($id);
      $insert_old_record['stake_holder_login_id_fk'] = $insert_old_record['stake_holder_login_id_pk'];

      $insert_old_record['archived_by'] = $update['approved_by'];
      // $insert_old_record['service_from'] = $insert_old_record['entry_time'];
      $insert_old_record['service_to'] = $update['approved_time'];

      unset($insert_old_record['entry_time']);
      unset($insert_old_record['stake_holder_login_id_pk']);
      // echo "<pre>";print_r($insert_old_record);die;
      $archive_logins = $this->user_change_model->archive_old_login($insert_old_record);

    #Step 3 - update user details in login table
      if($archive_logins >0){

        $new_details = $this->user_change_model->new_user_dtls_by_id($sl_no);

        $update_login['name'] = $new_details['name'];
        $update_login['mobile_no'] = $new_details['mobile_no'];
        $update_login['login_email'] = $new_details['email_id'];
        $update_login['service_from'] = $new_details['approved_time'];


        $password =  generateRandomPassword(6);
        $password_hash = hash('sha256',$password);

        $update_login['base_password'] = $password;
        $update_login['login_password']= $password_hash;

        $update_where['stake_holder_login_id_pk'] = $new_details['stake_holder_login_id_fk'];



        // echo "<pre>"; print_r($update_login);die;
        // echo "<pre>"; print_r($update_login,$update_where);die;
        $archive_logins = $this->user_change_model->update_stake_holder_login($update_login,$update_where);
      }



      $default->trans_commit();


      $sms_old_user['stake_holder_login_id_fk'] = $insert_old_record['stake_holder_login_id_fk'];
      $sms_old_user['login_id'] = $insert_old_record['login_id'];
      $sms_old_user['mobile_no'] = $insert_old_record['mobile_no'];
      $sms_old_user['is_used_for'] = $this->config->item('user_delinked');
      $this->send_otp($sms_old_user);

      $sms_new_user['stake_holder_login_id_fk'] = $new_details['stake_holder_login_id_fk'];
      $sms_new_user['mobile_no'] = $new_details['mobile_no'];
      $sms_new_user['new_password'] = $update_login['base_password'];
      $sms_new_user['login_id'] = $new_details['login_id'];
      $sms_new_user['is_used_for'] = $this->config->item('user_appvd');
      $this->send_otp($sms_new_user);




      // $data['approved_by'] = $stake_holder_login_id_pk;
      // $data['service_to'] = $stake_holder_login_id_pk;
      // // $data['approved_by'] = $stake_holder_login_id_pk;
      // $login_old = $this->user_change_model->archive_old_login($data,$id);
      // $result = $this->user_change_model->get_request_by_id($where);
      // echo "<pre>"; print_r($result);die;
    }else{
      $default->trans_rollback();
    }
    echo $RequestUpdateStatus;

  }

  public function revert_request()
  {
    $stake_holder_login_id_pk = $this->session->userdata('stake_holder_login_id_pk');
    $sl_no = $this->input->get('sl_no');
    $reason = $this->input->get('reason');
    $sl_no = base64_decode($sl_no);    
    $id = $this->input->get('stake_holder_login_id_fk');
    $id = base64_decode($id);

    // echo $id."----".$stake_holder_login_id_pk;die;

    $update['rejected_reason'] = $reason;
    $update['status'] = 2;
    $update['rejected_by'] = $stake_holder_login_id_pk;
    $update['rejected_time'] = date('Y-m-d H:i:s');
    $update['rejected_ip'] = $_SERVER['REMOTE_ADDR'];

    $where['sl_no'] = $sl_no;
    $default = $this->load->database('default',TRUE);
    $default->trans_start();
    $RequestUpdateStatus = $this->user_change_model->update_request_log($update,$where);
    if($RequestUpdateStatus>0){

      $data['is_used_for'] = $this->config->item('user_req_rej');
      $stake_id['stake_holder_login_id_fk'] = $id;

      $requested_user = $this->user_change_model->get_old_login($id);
      if(!empty($requested_user))
      {
        if(!empty($requested_user['mobile_no']))
        {
          $data['mobile_no'] = $requested_user['mobile_no'];
        }
      }
      // echo "<pre>"; print_r($requested_user);die;


// echo json_encode(['status' => 'success', 'message' => 'Request rejected successfully']);
       // $this->msgapi->Msg($data);

      $data['stake_holder_login_id_fk'] = $requested_user['stake_holder_login_id_pk'];
      $data['login_id'] = $requested_user['login_id'];

      $default->trans_commit();


      $x = $this->send_otp($data);
      if($x !='')
      {
        echo json_encode(['status' => 'success', 'message' => 'Request rejected successfully']);
      }
    }else{
      $default->trans_rollback();
    }
    // echo json_encode(2);

  }


  public function user_change_list_self() 
  {
    // echo "<pre>";print_r($_SESSION);echo "</pre>";
    $login_id = $this->session->userdata('login_id');
    $stake_id_fk = $this->session->userdata('stake_id_fk');
    $mobile_no = $this->session->userdata('mobile_no');

    // $where['stake_id_fk'] = $this->session->userdata('stake_id_fk');
    $where['stake_holder_login_id_fk'] = $this->session->userdata('stake_holder_login_id_pk');
    $where['requested_by'] = $this->session->userdata('stake_holder_login_id_pk');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    // $where['archive_status'] = 0;

    $stake = "stake_id_fk =".$stake_id_fk;
    $data['requested_data'] = $this->user_change_model->get_request_list($where,$stake,NULL);
    // echo "<pre>";print_r($data['requested_data']);die;

    foreach ($data['requested_data'] as $key => $value) 
    {
      if($value['status']==1)
      {
        $data['requested_data'][$key]['musk_unmusk_mobile_no'] = $this->mask_mobile_no($value['mobile_no']);
      }
      else
      {
        $data['requested_data'][$key]['musk_unmusk_mobile_no'] = $value['mobile_no'];
      }
    }

    // echo "<pre>";print_r($data);echo "</pre>";die;
    $this->load->view($this->config->item('theme').'user_change/user_change_list_view_self', $data);
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

  public function send_otp($data = array())
  {
    // echo "<pre>";print_r($data);die;
    // $request['mobile_no'] = $data['mobile_no'];
    // $request['is_used_for'] = $data['is_used_for'];

    // echo "<pre>";print_r($request);die;
    // $this->msg91->sendSMS($mobile_no,$msg);
     $data1 = array(

      'stake_holder_login_id_fk'    =>  $data['stake_holder_login_id_fk'],
      // 'stake_id_fk'          =>  
      'login_id'            =>  $data['login_id'],
      'mobile_no'           =>  $data['mobile_no'],
      'created_on'          =>  date('Y-m-d H:i:s'),
      'is_used_for'         =>  $data['is_used_for']

    );

    // echo "<pre>";print_r($data1);die;


    $insert_otp = $this->login_model->insert_otp_log($data1);
    if($insert_otp == TRUE)
    {
      $x = $this->msgapi->Msg($data);

      if($x !='')
      {
        return 11;
      }
      else
      {
        return 01;
      }
    }
    return false;

  }

  public function mask_mobile_no($mobile_no)
  {

    if($mobile_no)
    {
      $first_three_digit = substr($mobile_no,0,3); 
      $last_three_digit = substr($mobile_no,-3); 
      $musked_mobile_no = $first_three_digit."****".$last_three_digit;
      return $musked_mobile_no;
    }
    else
    {
      return false;
    }
  }
}
