<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Register extends NIC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Register_model');
		$this->load->library('form_validation');
	}

	public function index() 
	{
		if($this->input->method(TRUE) == 'GET'){
			redirect('admin');
		}
		$result = $this->Register_model->check_duplicate_mobile_no($this->input->post('stake_holder_login_id_pk'), $this->input->post('mobile_no'));
		if($result > 0){
         $data['mobile_error_message'] = '<p class="text-danger">This mobile number is already registered with another user, try typing a another mobile number</p>';
         $this->load->view($this->config->item('theme') . 'register_view', $data);
         return false; 
      }else{
      	$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
      	if($this->input->post('designation') == 'CMPO' || $this->input->post('designation') == 'SDO'){
      		$config = array(
			      array(
			        'field' => 'first_name',
			        'label' => 'first name',
			        'rules' => 'trim|required'
			      ),
			      array(
			        'field' => 'last_name',
			        'label' => 'last name',
			        'rules' => 'trim|required'
			      ),
			      array(
			        'field' => 'mobile_no',
			        'label' => 'mobile number',
			        'rules' => 'trim|required|numeric|max_length[10]|regex_match[/^[0-9]{10}$/]'
			      ),
			      array(
			        'field' => 'designation',
			        'label' => 'designation',
			        'rules' => 'trim|required'
			      ),
			      array(
			        'field' => 'district',
			        'label' => 'district',
			        'rules' => 'trim|required'
			      ),
			      array(
			        'field' => 'email_id',
			        'label' => 'E-Mail ID',
			        'rules' => 'trim|valid_email'
			      ),
			      array(
			        'field' => 'username',
			        'label' => 'username',
			        'rules' => 'trim|required'
			      ),
			      array(
			        'field' => 'password',
			        'label' => 'password',
			        'rules' => 'trim|callback_valid_password'
			      ),
			      array(
			        'field' => 'retype_password',
			        'label' => 're-type password',
			        'rules' => 'trim|required|matches[password]'
			      )
			   );
      	}else{
      		$config = array(
			      array(
			        'field' => 'first_name',
			        'label' => 'first name',
			        'rules' => 'trim|required'
			      ),
			      array(
			        'field' => 'last_name',
			        'label' => 'last name',
			        'rules' => 'trim|required'
			      ),
			      array(
			        'field' => 'mobile_no',
			        'label' => 'mobile number',
			        'rules' => 'trim|required|numeric|max_length[10]|regex_match[/^[0-9]{10}$/]'
			      ),
			      array(
			        'field' => 'designation',
			        'label' => 'designation',
			        'rules' => 'trim|required'
			      ),
			      array(
			        'field' => 'district',
			        'label' => 'district',
			        'rules' => 'trim|required'
			      ),
			      // array(
			      //   'field' => 'block',
			      //   'label' => 'sd/block',
			      //   'rules' => 'trim|required'
			      // ),
			      array(
			        'field' => 'email_id',
			        'label' => 'E-Mail ID',
			        'rules' => 'trim|valid_email'
			      ),
			      array(
			        'field' => 'username',
			        'label' => 'username',
			        'rules' => 'trim|required'
			      ),
			      array(
			        'field' => 'password',
			        'label' => 'password',
			        'rules' => 'trim|callback_valid_password'
			      ),
			      array(
			        'field' => 'retype_password',
			        'label' => 're-type password',
			        'rules' => 'trim|required|matches[password]'
			      )
			   );
      	}
		   $this->form_validation->set_rules($config);
		   if ($this->form_validation->run() == FALSE) {
		       $data['success'] = '0';
		       
		       $this->load->view($this->config->item('theme') . 'register_view', $data);
		   }else{
	          $uploaded = array(
	          	'update_time' => date('Y-m-d H:i:s'),
	          	'update_ip' => $_SERVER['REMOTE_ADDR'],
	          	'login_email' => $this->input->post('email_id'),
	          	'name' => $this->input->post('first_name')." ".$this->input->post('last_name'),
	          	'mobile_no' => $this->input->post('mobile_no'),
	          	'login_password' => hash('sha256', $this->input->post('password')),
	          	'base_password' => $this->input->post('password'),
	          	'status' => 1,
	          );
	          $result = $this->Register_model->update_user_details($uploaded, $stake_id = $this->input->post('stake_holder_login_id_pk'));
	          $this->db->trans_begin();
	          if($result == 0){
	              $this->db->trans_commit();
	              $this->session->set_flashdata('success', 'Your CMRTS profile has been successfully updated.');
	              redirect('admin');
	          }else{
	              $this->db->trans_rollback();
	              $data['error_message'] = '<p class="text-warning text-center" style="font-size:18px">Your CMRTS profile updation failed. Please try again!</p>';
	              $this->load->view($this->config->item('theme') . 'register_view', $data);
	          }
		   }
      }
	}

   public function valid_password($password = '')
   {
		$password = trim($password);
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

		if(empty($password))
		{
			$this->form_validation->set_message('valid_password', 'The {field} field is required');
			return FALSE;
		}

		if(preg_match_all($regex_lowercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} must contain at least one lowercase letter');
			return FALSE;
		}

		if(preg_match_all($regex_uppercase, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'Your {field} must contain at least one upper case letter');
			return FALSE;
		}

		if(preg_match_all($regex_number, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'The {field} must contain at least one number');
			return FALSE;
		}

		if(preg_match_all($regex_special, $password) < 1)
		{
			$this->form_validation->set_message('valid_password', 'Your {field} must contain at least one special character');
			return FALSE;
		}

		if(strlen($password) < 8)
		{
			$this->form_validation->set_message('valid_password', 'The {field} must contain at least 8 characters in length');
			return FALSE;
		}

		if(strlen($password) > 15)
		{
			$this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 15 characters in length');
			return FALSE;
		}

		return TRUE;
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
}
