<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Change_password extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		parent::check_privilege();
    $this->load->model('Dashboard_model');
    $this->load->model('login_model');  
	}

	public function index() 
  {
     $this->load->library('form_validation');
     $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
     $config = array(
       array(
        'field' => 'current_password',
        'label' => 'Current Password',
        'rules' => 'trim|required'
       ),
       array(
        'field' => 'new_password',
        'label' => 'New Password',
        'rules' => 'trim|callback_valid_password'
       ),
       array(
        'field' => 'confirm_password',
        'label' => 'Confirm Password',
        'rules' => 'trim|required|matches[new_password]'
       ),
     );

    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
       $login_id = $this->session->userdata('login_id');
       $data['district_details'] = $this->Dashboard_model->district_details($login_id);
       $this->load->view($this->config->item('theme').'setting/password_reset', $data);
    }else{
       $login_result = $this->login_model->check_final_users($this->session->userdata('login_id'));
       $stake_id = $this->session->userdata('stake_id_fk');
       $login_id = $this->session->userdata('login_id');
       $current_pass= hash('sha256',($this->input->post('current_password')));
       $exis_pass = $login_result[0]['login_password'];
       if($current_pass == $exis_pass){
           $new_pass= hash('sha256',($this->input->post('new_password')));    
           $this->db->trans_begin();
           $result = $this->db->query("UPDATE cm_stake_holder_login SET login_password = '".$new_pass."', base_password = '".$this->input->post('new_password')."' WHERE stake_id_fk='".$stake_id."' AND login_id='".$login_id."'");
           if($result > 0 ){
              $this->db->trans_commit();
              $this->session->set_flashdata('success', 'Password change successfully');
              redirect('admin/dashboard');
            }else{
              $this->session->set_flashdata('warning', 'Failed to change password');
              redirect('admin/setting/change_password');
            }
        }else{
            $this->session->set_flashdata('warning', 'Current Password is wrong');
            redirect('admin/setting/change_password');
        }
      }
    }

   public function valid_password($password = '')
   {
      $password = trim($password);
      $regex_lowercase = '/[a-z]/';
      $regex_uppercase = '/[A-Z]/';
      $regex_number = '/[0-9]/';
      $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>ยง~]/';

      if (empty($password))
      {
        $this->form_validation->set_message('valid_password', 'The {field} field is required');

        return FALSE;
      }

      if (strlen($password) < 8)
      {
        $this->form_validation->set_message('valid_password', 'The {field} must contain at least 8 characters in length');

        return FALSE;
      }

      if (strlen($password) > 15)
      {
        $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 15 characters in length');
        return FALSE;
      }

      if (preg_match_all($regex_lowercase, $password) < 1)
      {
        $this->form_validation->set_message('valid_password', 'The {field} must contain at least one lowercase letter');

        return FALSE;
      }

      if (preg_match_all($regex_uppercase, $password) < 1)
      {
        $this->form_validation->set_message('valid_password', 'The {field} must contain at least one uppercase letter');

        return FALSE;
      }

      if (preg_match_all($regex_number, $password) < 1)
      {
        $this->form_validation->set_message('valid_password', 'The {field} must contain at least one number');

        return FALSE;
      }

      if (preg_match_all($regex_special, $password) < 1)
      {
        $this->form_validation->set_message('valid_password', 'The {field} must contain at least one special character');

        return FALSE;
      }
      return TRUE;
   }
}
