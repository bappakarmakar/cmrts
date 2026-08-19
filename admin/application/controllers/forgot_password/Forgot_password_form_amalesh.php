<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Forgot_password_form extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
    $this->load->model('forgot_password/forgot_password_model');  
	}

	public function index() 
  {
  	  $this->load->library('form_validation');
     $this->load->library('email');
     $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
     $config = array(
       array(
        'field' => 'user_name',
        'label' => 'User Name',
        'rules' => 'trim|required'
       ),
     );

    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
       $this->load->view($this->config->item('theme').'forgot_password/forgot_password_view');
    }else{
       $check_result = $this->forgot_password_model->check_user($this->input->post('user_name'));
       if($check_result){
       	  $otp = rand('100000', '999999');
           $email = $check_result[0]['login_email'];
           //debojit
           // $mobile_no = $check_result[0]['mobile_no'];
           //
           $em = explode("@",$email);
           $name = $em[0];
           $len = strlen($name);
           $showLen = floor($len/2);
           $str_arr = str_split($name);
           for($ii=$showLen;$ii<$len;$ii++){
                $str_arr[$ii] = '*';
           }
           $em[0] = implode('',$str_arr); 
           $new_email = implode('@',$em);
       	  $uploaded = array(
	          	'stake_holder_id_fk' => $check_result[0]['stake_holder_login_id_pk'],
	          	'otp' => $otp,
	          	'entry_time' => date('Y-m-d H:i:s'),
	          	'entry_ip' => $_SERVER['REMOTE_ADDR'],
	          	'active_status' => 1,
	          	'status' => 0,
	        );
          $otp_check_user_result = $this->forgot_password_model->check_user_details($check_result[0]['stake_holder_login_id_pk']);
          if($otp_check_user_result){
            $result = $this->forgot_password_model->update_otp_details($uploaded, $check_result[0]['stake_holder_login_id_pk']);
          }else{
            $result = $this->forgot_password_model->insert_otp_details($uploaded);
          }
          $this->db->trans_begin();
          if($result == 0){
              $this->db->trans_commit();
              $this->email->from('amaleshdeveloper@gmail.com', 'CMRTS Team');
              // $this->email->to($email);
              // $this->email->subject('Forgot password');
              // $this->email->message('OTP:'.$otp);
              // if($this->email->send()){
                  $this->session->set_flashdata('success', 'An otp has been sent to '.$new_email);
                  redirect('admin/forgot_password/check_otp/'.base64_encode($check_result[0]['stake_holder_login_id_pk']));
              // }else{
              //     $this->session->set_flashdata('error', 'There was an error in sending the OTP. Please try again!');
              //     redirect('admin/forgot_password');
              // }
          }else{
              $this->db->trans_rollback();
              $this->session->set_flashdata('error', 'OTP updation failed. Please try again!');
              redirect('admin/forgot_password');
          }
       }else{
          $data['username_error_message'] = '<p class="text-danger" style="font-size:16px;">This user does not exist in the system</p>';
					$this->load->view($this->config->item('theme') . 'forgot_password/forgot_password_view',$data);
       }
    }
  }

  public function otp_check($id)
  {
  	 $stake_holder_id = base64_decode($id);
  	 $this->load->library('form_validation');
     $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
     $config = array(
       array(
        'field' => 'otp_1',
        'label' => 'OTP',
        'rules' => 'trim|required'
       ),
       array(
        'field' => 'otp_2',
        'label' => 'OTP',
        'rules' => 'trim|required'
       ),
       array(
        'field' => 'otp_3',
        'label' => 'OTP',
        'rules' => 'trim|required'
       ),
       array(
        'field' => 'otp_4',
        'label' => 'OTP',
        'rules' => 'trim|required'
       ),
       array(
        'field' => 'otp_5',
        'label' => 'OTP',
        'rules' => 'trim|required'
       ),
       array(
        'field' => 'otp_6',
        'label' => 'OTP',
        'rules' => 'trim|required'
       ),
     );

    $this->form_validation->set_rules($config);
    if ($this->form_validation->run() == FALSE) {
    	 $this->session->set_flashdata('otp_required_error', '<p class="text-danger" style="font-size:16px;margin-left:21px;margin-top:6px;">OTP field is required</p>');
       $this->load->view($this->config->item('theme').'forgot_password/otp_check_view');
    }else{
    	 $otp_1 = $this->input->post('otp_1');
    	 $otp_2 = $this->input->post('otp_2');
    	 $otp_3 = $this->input->post('otp_3');
    	 $otp_4 = $this->input->post('otp_4');
    	 $otp_5 = $this->input->post('otp_5');
    	 $otp_6 = $this->input->post('otp_6');
    	 $otp = $otp_1."".$otp_2."".$otp_3."".$otp_4."".$otp_5."".$otp_6;
       $check_result = $this->forgot_password_model->check_otp($otp, $stake_holder_id);
       $EntryTime = strtotime($check_result['entry_time'])+600;
       $CurrentTime = strtotime("now");
       if($otp == $check_result['otp']){
         if($EntryTime >= $CurrentTime){
				redirect('admin/forgot_password/password_reset/'.base64_encode($stake_holder_id).'/'.base64_encode($check_result['sl_no']));
         }else{
            $this->session->set_flashdata('otp_error', '<p class="text-danger" style="font-size:16px;">OTP is expired</p>');
            redirect('admin/forgot_password/check_otp/'.base64_encode($stake_holder_id));
         }
       }else{
            $this->session->set_flashdata('otp_error', '<p class="text-danger" style="font-size:16px;margin-left:22px;margin-top:6px;">Invalid OTP</p>');
				redirect('admin/forgot_password/check_otp/'.base64_encode($stake_holder_id));
       }
    }
  }

  public function password_reset($stale_holder_id, $sl_no)
  {
     $stake_holder_id = base64_decode($stale_holder_id);
     $sl_no = base64_decode($sl_no);
     $this->load->library('form_validation');
     $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
     $config = array(
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
       $this->load->view($this->config->item('theme').'forgot_password/password_reset_view');
    }else{
       $uploaded = array(
         'login_password' => hash('sha256', $this->input->post('new_password')),
         'base_password' => $this->input->post('new_password'),
         'status' => 1
       );
       $result = $this->forgot_password_model->update_password_reset_details($uploaded, $stake_holder_id, $sl_no);
       $this->db->trans_begin();
       if($result == 0){
           $this->db->trans_commit();
           $this->session->set_flashdata('success', 'Your password has been changed successfully');
           redirect('admin');
       }else{
           $this->db->trans_rollback();
           $this->session->set_flashdata('error', 'Your password reset updation failed. Please try again!');
           redirect('admin/forgot_password/password_reset/'.$stake_holder_id.'/'.$sl_no);
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

      if(preg_match_all($regex_uppercase, $password) < 1)
      {
         $this->form_validation->set_message('valid_password', 'Your {field} must contain at least one upper case letter');
         return FALSE;
      }

      if(preg_match_all($regex_lowercase, $password) < 1)
      {
         $this->form_validation->set_message('valid_password', 'The {field} must contain at least one lowercase letter');
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
}
