<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Create_user_form extends NIC_Controller {
  
  public function __construct(){ 
    parent::__construct();
    parent::check_privilege();
    $this->load->library('form_validation');
    $this->load->model('Dashboard_model');
    $this->load->model('user/create_user_form_model');
    $this->load->model('Register_model');
    $this->load->model('common/Master_model');
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
      $this->validate_login(array('6'));
      $subdiv_id = ($this->session->userdata('subdiv'))?$this->session->userdata('subdiv'):0;
      $data['deo_user_check'] = $this->create_user_form_model->total_deo_user_check($subdiv_id);
      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
      $config = array(
        array(
          'field' => 'f_name',
          'label' => 'First name',
          'rules' => 'trim|required|alpha'
        ),
        array(
          'field' => 'l_name',
          'label' => 'Last name',
          'rules' => 'trim|required|alpha'
        ),
        array(
          'field' => 'mobile_no',
          'label' => 'Mobile no',
          'rules' => 'trim|required|numeric|max_length[10]|regex_match[/^[0-9]{10}$/]'
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
          'field' => 'email_id',
          'label' => 'Email ID',
          'rules' => 'trim|valid_email'
        ),
        array(
          'field' => 'username',
          'label' => 'Username',
          'rules' => 'trim|required'
        ),
      );
      $this->form_validation->set_rules($config);
      if ($this->form_validation->run() == FALSE) {
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['deo_user_details'] = $this->create_user_form_model->total_deo_user($this->session->userdata('subdiv'));
        $data['subdiv_details'] = $this->create_user_form_model->subdiv_details($login_id);
        // echo $this->session->userdata('subdiv');die;
        $data['sdo_deo_level_block_name'] = $this->Master_model->get_sdo_deo_level_block($this->session->userdata('subdiv'));
        // echo '<pre>';print_r($data['sdo_deo_level_block_name']);die;

        // echo "<pre>";print_r($data);die;
        $this->load->view($this->config->item('theme').'user_list/create_user_form_view', $data);
      } else {
        $login_id = $this->session->userdata('login_id');
        $data['district_details'] = $this->Dashboard_model->district_details($login_id);
        $data['deo_user_details'] = $this->create_user_form_model->total_deo_user($this->session->userdata('subdiv'));
        $data['subdiv_details'] = $this->create_user_form_model->subdiv_details($login_id);
        // echo $this->session->userdata('subdiv');die;
        $data['sdo_deo_level_block_name'] = $this->Master_model->get_sdo_deo_level_block($this->session->userdata('subdiv'));
          $password = rand('100000', '999999');
          $uploaded = array(
            'stake_id_fk' => 4,
            'name' => $this->input->post('f_name')." ".$this->input->post('l_name'),
            'mobile_no' =>  $this->input->post('mobile_no'),
            'district' =>  $this->input->post('district_id'),
            'block' =>  $this->input->post('block'),
            'subdiv' =>  $this->input->post('suvdiv_id'),
            'login_email' =>  $this->input->post('email_id'),
            'login_id' =>  $this->input->post('username'),
            'login_password' => hash('sha256', $password),
            'active_status' => 0,
            'entry_time' => date('Y-m-d H:i:s'),
            'entry_ip' => $_SERVER['REMOTE_ADDR'],
            'stake_holder_details' => 'DEO',
            'base_password' => $password,
            'base_login_id' => $this->input->post('username'),
            'status' => 0,
            'login_status' => 0,
            'master_password' => hash('sha256', 'cmrts123#')
          );
          $result = $this->create_user_form_model->check_duplicate_mobile_no($this->input->post('mobile_no'));
          $username_check = $this->create_user_form_model->check_duplicate_login_id($this->input->post('username'));
          if($result > 0 || $username_check > 0){
            if($result>0){
              $data['mobile_error_message'] = '<p class="text-danger">This mobile number is already registered with another user, try typing a another mobile number</p>';
            }
            if($username_check>0){
              $data['username_error_message'] = '<p class="text-danger">This user name is already registered with another user, try typing a another user name</p>';
            }
            
            $login_id = $this->session->userdata('login_id');
            $data['district_details'] = $this->Dashboard_model->district_details($login_id);
            $this->load->view($this->config->item('theme').'user_list/create_user_form_view', $data);
          } else {
            $result = $this->create_user_form_model->insert_user_details($uploaded);
            $this->db->trans_begin();
            if($result == 0){
                $this->db->trans_commit();
                $this->session->set_flashdata('success', 'DEO account successfully created.');
                redirect('admin/user_list/user');
            }else{
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', 'DEO account creation failed. Please try again!');
                $this->load->view($this->config->item('theme').'user_list/create_user_form_view', $data);
            }
          }
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
