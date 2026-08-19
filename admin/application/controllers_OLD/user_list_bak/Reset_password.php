<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Reset_password extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->library('upload');
    $this->load->model('user/user_list_model');
    $this->load->model('user/reset_password_model');
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
    );
  }


  public function index() 
  {
    
    // $this->validate_login(array('1', '2', '3', '6'));
    $login_id = $this->session->userdata('login_id');
    // echo'<pre>';print_r($_SESSION);die;
    // echo $login_id;die;
    $data['district_details'] = $this->Dashboard_model->district_details($login_id);
    $data['user_details'] = $this->user_list_model->Get_All_Users_Details();
    $data['login_id'] = $login_id;
    $data['block'] = $this->session->userdata('block');
    $user_role  = $this->session->userdata('stake_id_fk');
    //DEO -> BDO
    if($user_role == 2) 
    {
      $search_array['user_role'] = 4;
      $search_array['block'] = $this->session->userdata('block');
    }
    // BDO -> CMPO
    elseif ($user_role == 3) 
    {
     $search_array['user_role'] = 2;
     $search_array['block'] = $this->session->userdata('block');
    }
    //SDO
    elseif ($user_role == 6) 
    {
     $search_array['user_role'] = 4;
     $search_array['subdiv'] = $this->session->userdata('subdiv');
    }
    // CPMO -> STATE NODAL
    elseif ($user_role == 1) 
    {
     $search_array['user_role_in'] = array(3,5);
    }

    // echo $data['user_role'];die; 
    // $data['stake_id_fk'] = $this->session->userdata('stake_id_fk');
    $search_array['is_active'] = 1;
    $data['pass_change_users'] = $this->reset_password_model->get_change_pass_users($search_array);
    // echo'<pre>';print_r($data['pass_change_users']);die;


    $this->load->view($this->config->item('theme').'user_list/reset_password_list', $data);


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
  public function update_pass()
  {

    // echo $this->input->get('id');die;
    $this->db->trans_begin();
    $data['stake_holder_login_id_fk'] = base64_decode($this->input->get('id'));
    $data['is_active'] = 0;
    $data['update_time']=date('Y-m-d H:i:s');
    $data['updated_by']=$this->session->userdata('stake_id_fk');
    $data['updated_ip']=$_SERVER['REMOTE_ADDR'];
    $data['updated_ip']=$_SERVER['REMOTE_ADDR'];

    $data1['base_password'] = random_int(000000,999999);
    $data1['login_password'] = hash('sha256',$data1['base_password']);
    $data1['stake_holder_login_id_pk'] = $data['stake_holder_login_id_fk'];
    //$data1['active_status'] = 0;
    //$data1['status'] = 0 ;

    // print_r($data); die;

    $reponse1 = $this->reset_password_model->update_pass_track($data);
    $reponse2 = $this->reset_password_model->update_pass($data1);
      // json_encode($reponse2);

    if($reponse1 == 0 && $reponse2 == 0)
    {
      $this->db->trans_commit();

      $this->session->set_flashdata('success','Password has been reset successfully!, Please note the password : '.$data1['base_password'] );
      redirect('admin/user_list/reset_password');
    }
    else
    {
      $this->db->trans_rollback();
      $this->session->set_flashdata('warning', 'Incident report data addition failed. Please try again.');
      // redirect('admin');
      redirect('admin/user_list/reset_password');
    }

    // $data['pass_change_users'] = $this->reset_password_model->update_pass($data);

}

}

