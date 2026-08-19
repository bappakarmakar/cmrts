<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class User_change extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('user/create_user_form_model');
    $this->load->model('user_change/user_change_model');
    $this->load->model('Register_model');
    $this->load->model('common/Master_model');
    $this->load->model('login_model');
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
    // echo 123;die;
    $login_id = $this->session->userdata('login_id');
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $check1['stake_holder_login_id_fk'] = $this->session->userdata('stake_holder_login_id_pk');
    $request_check = $this->user_change_model->check_request($check1);

    
    if($request_check > 0)
    {
      $msg =  "User Change Request is Already Submitted!";
      $this->session->set_flashdata('error', $msg);
      redirect('admin/user_change/user_change_list/user_change_list_self');
    }
    if($this->input->post('submit') == TRUE)
    {
      // echo "<pre>";print_r($this->input->post());
      $config = array(
          array(
           'field' => 'first_name',
           'label' => 'first Name',
           'rules' => 'trim|required|regex_match[/^[a-zA-Z\s]+$/]'
          ),
          array(
           'field' => 'last_name',
           'label' => 'last Name',
           'rules' => 'trim|required|regex_match[/^[a-zA-Z\s]+$/]'
          ),
          array(
           'field' => 'mobile_no',
           'label' => 'mobile no',
           'rules' => 'trim|required|regex_match[/^[6-9][0-9]{8,9}$/]|callback_check_invalid_mobile'
          ),
          array(
           'field' => 'email_id',
           'label' => 'email id',
           'rules' => 'trim|valid_email'
          ),
          array(
           'field' => 'reason',
           'label' => 'reason',
           'rules' => 'trim|required'
          ),
         );

         $this->form_validation->set_rules($config);
         $this->form_validation->set_error_delimiters('<div class="text-danger" style="float:left">', '</div>');
         if ($this->form_validation->run() == TRUE)
         {
            $check_mobile_no = $this->Register_model->check_duplicate_mobile_no(
                        $this->session->userdata('subdiv'),
                        $this->session->userdata('stake_holder_login_id_pk'), 
                        $this->input->post('mobile_no'),
                        $this->session->userdata('stake_id_fk')
            );

            // $check_mobile_no = 0;
            if($check_mobile_no > 0)
            {
              $msg =  "This mobile number is already registered with another user, try typing a another mobile number";
              $this->session->set_flashdata('error', $msg);
            }
            else
            {
              $data1['name'] = $this->input->post('first_name')." ".$this->input->post('last_name');
              $data1['mobile_no'] = $this->input->post('mobile_no');
              $data1['email_id'] = $this->input->post('email_id');
              $data1['reason'] = $this->input->post('reason');

              $data1['stake_holder_login_id_fk'] = $this->session->userdata('stake_holder_login_id_pk');
              // $data1['stake_holder_login_id_fk'] = $this->session->userdata('stake_holder_login_id');
              $data1['stake_id_fk'] = $this->session->userdata('stake_id_fk');
              $data1['login_id'] = $this->session->userdata('login_id');

              // $data1['requested_by'] = $this->session->userdata('stake_holder_login_id');
              $data1['requested_by'] = $this->session->userdata('stake_holder_login_id_pk');
              $data1['requested_time'] = date('Y-m-d H:i:s');
              $data1['requested_ip'] = $_SERVER['REMOTE_ADDR'];
              $data1['requested_district'] = $this->session->userdata('district');
              $data1['requested_block'] = $this->session->userdata('block');
              $data1['requested_subdiv'] = $this->session->userdata('subdiv');

              // echo "<pre>";print_r($data1);
              $check['stake_holder_login_id_fk'] = $data1['stake_holder_login_id_fk'];

              $request_check = $this->user_change_model->check_request($check);
              if($request_check > 0)
              {
                $msg =  "User Change Request is Already Submitted!";
                $this->session->set_flashdata('error', $msg);
                
              }
              else
              {
                $result = $this->user_change_model->insert_new_user_request($data1);
                if($result > 0)
                {
                  $msg =  "User Change Request has been registered!";
                  $this->session->set_flashdata('success', $msg);

                  $data['is_used_for'] = $this->config->item('user_appv_req');
                  $data['requested_by'] = $data1['login_id'];
                  $this->send_otp($data);
                  redirect('admin/user_change/user_change_list/user_change_list_self');
                }
              }
            }
            // echo "<pre>"; print_r($request_check);
         }
    }
    $this->load->view($this->config->item('theme').'user_change/user_change_form_view', $data);
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


  public function get_higher_authority($data = array())
  {
    $district = $higher_authority['district'] = $this->session->userdata('district');
    $block = $higher_authority['block'] = $this->session->userdata('block');
    $subdiv = $higher_authority['subdiv'] = $this->session->userdata('subdiv');
    $stake_id_fk = $higher_authority['stake_id_fk'] = $this->session->userdata('stake_id_fk');

    #DEO -> BDO/SDO
    if($stake_id_fk == 4)
    {
      #DEO -> BDO
      if($subdiv == '')
      {
        $filter['stake_id_fk'] = 2;
        $filter['block'] = $block;
      }
      else
      {
        $filter['stake_id_fk'] = 6;
        $filter['subdiv'] = $subdiv;
      }
    }

    #BDO/SDO -> CMPO
    elseif ($stake_id_fk == 2 || $stake_id_fk == 6) 
    {
      $filter['stake_id_fk'] = 3;
      $filter['district'] = $district;
    }

    #MIS -> CMPO/SNO
    elseif ($stake_id_fk == 5) 
    {
      if($district == '')
      {
        $filter['stake_id_fk'] = 1;
      }
      else
      {
        $filter['stake_id_fk'] = 3;
        $filter['district'] = $district;
      }
    }

    #CMPO -> MIS
    elseif ($stake_id_fk == 3) 
    {
        $filter['stake_id_fk'] = 1;
    }

      $user = $this->user_change_model->get_higher_authority_personnal($filter);
      return $user;
  }

  public function send_otp($data = array())
  {
    $user = $this->get_higher_authority();

    $request['mobile_no'] = $user['mobile_no'];
    $request['is_used_for'] = $data['is_used_for'];
    $request['requested_by'] = $data['requested_by'];

    // echo "<pre>";print_r($request);die;
    // $this->msg91->sendSMS($mobile_no,$msg);

    $data1 = array(

      'stake_holder_login_id_fk'    =>  $user['stake_holder_login_id_pk'],
      // 'stake_id_fk'          =>  
      'login_id'            =>  $user['login_id'],
      'mobile_no'           =>  $user['mobile_no'],
      'created_on'          =>  date('Y-m-d H:i:s'),
      'is_used_for'         =>  $data['is_used_for']

    );

    // echo "<pre>";print_r($data1);die;


    $insert_otp = $this->login_model->insert_otp_log($data1);


    $this->msgapi->Msg($request);

  }

   private $invalid_numbers = array(
        '9999999999',
        '8888888888',
        '7777777777',
        '6666666666',
        '9898989898',
        '9999988888',
        '6666988888'
    );

public function check_invalid_mobile($mobile_no) 
{
  if (in_array($mobile_no, $this->invalid_numbers)) 
  {
      $this->form_validation->set_message('check_invalid_mobile', 'The {field} is invalid.');
      return false;
  }
  return true;
}
    

  
}
