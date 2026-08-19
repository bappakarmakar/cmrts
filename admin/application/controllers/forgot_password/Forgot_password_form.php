<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Forgot_password_form extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
      parent::check_public();
      $this->load->model('forgot_password/forgot_password_model');
      $this->load->model('login_model');
      $this->load->library('form_validation');  
      $this->load->library('email');
	}

	public function index()
   {
  	  // $this->load->library('form_validation');
      // echo"<pre>";print_r($_SESSION);echo"</pre>";
      if($this->session->userdata('fgot_otp_status'))
      {
         $this->session->unset_userdata('fgot_otp_status');
      }
      $data = array();
     $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

     if($this->input->method(TRUE) == 'POST')
     {
         $config = array(
          array(
           'field' => 'user_name',
           'label' => 'User Name',
           'rules' => 'trim|required'
          ),
         );

         $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == TRUE)
         {
            $check_result = $this->forgot_password_model->check_user($this->input->post('user_name'));
            if($check_result)
            {
               if($check_result[0]['mobile_no'])
               {
                  $random=(int)(mt_rand(100000, 999999));
                  $this->session->set_userdata('mobile_no', $check_result[0]['mobile_no']);
                  $this->session->set_userdata('login_id', $check_result[0]['login_id']);
                  $this->session->set_userdata('stake_holder_login_id', $check_result[0]['stake_holder_login_id_pk']);
                  $this->session->set_userdata('secretotp', $random);
                  $this->session->set_userdata('otp_created_on', date("Y-m-d H:i:s"));
                  $this->session->set_userdata('fgot_otp_status', 1);
                  $data = array(
                     'stake_holder_login_id_fk'    =>  $this->session->userdata('stake_holder_login_id'),
                     // 'stake_id_fk'              => 
                     'login_id'                    => $this->session->userdata('login_id'),
                     'mobile_no'                   => $this->session->userdata('mobile_no'),
                     'otp'                         => $this->session->userdata('secretotp'),
                     'created_on'                  => $this->session->userdata('otp_created_on'),
                     'is_success'                  => $this->config->item('is_otp_not_checked'),
                     'is_used_for'                 => $this->config->item('use_otp_forgotpassword')
                  );
                     
                  $insert_otp = $this->login_model->insert_otp_log($data);

                  $request['mobile_no'] = $this->session->userdata('mobile_no');
                  $request['code'] = $this->session->userdata('secretotp');
                  $request['is_used_for'] = $this->config->item('use_otp_forgotpassword');
                     // $this->msg91->sendSMS($mobile_no,$msg);
                  $this->msgapi->Msg($request);


                  // $this->session->set_flashdata('success', 'An otp has been sent to '.$new_email);
                  // redirect('admin/forgot_password/check_otp/'.base64_encode($check_result[0]['stake_holder_login_id_pk']));
                  redirect('admin/forgot_password/check_otp');

               }
               else
               {
                  echo "mobile No does not exist!";
               }


            }
            else
            {
               // $data['username_error_message'] = '<p class="text-danger" style="font-size:16px;">This user does not exist in the system</p>';
               // $this->load->view($this->config->item('theme') . 'forgot_password/forgot_password_view',$data);
               $this->session->set_flashdata('error', 'This user does not exist in the system');
               redirect('admin/forgot_password');
            }
         }
      }

      $this->load->view($this->config->item('theme') . 'forgot_password/forgot_password_view',$data);
   }

  public function otp_check()
  {
   // echo 123;die;
    // echo "<pre>"; print_r($_SESSION);
    unset($_SESSION['otp_status']);
      if($this->session->userdata('fgot_otp_status')!=1)
      {
         redirect('admin');
      }if($this->session->userdata('login_code') != NULL)
      {
         redirect('admin/dashboard');
      }
      // print_r($_SESSION);
      parent::check_public();
      // echo $this->session->userdata('secretotp');
      $data['mobile_no_last_digits'] = substr($this->session->userdata('mobile_no'), -4); 
      if($this->input->method(TRUE) == 'POST' && $this->session->userdata('fgot_otp_status')==1)
      { 
        // echo 11111;die;
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
         if($this->form_validation->run() == TRUE)
         {
            $otp_1 = $this->input->post('otp_1');
            $otp_2 = $this->input->post('otp_2');
            $otp_3 = $this->input->post('otp_3');
            $otp_4 = $this->input->post('otp_4');
            $otp_5 = $this->input->post('otp_5');
            $otp_6 = $this->input->post('otp_6');
            $request_otp = $otp_1."".$otp_2."".$otp_3."".$otp_4."".$otp_5."".$otp_6;
            $request_time = date("Y-m-d H:i:s");
            if($request_otp == $this->session->userdata('secretotp')) 
            {
               // echo 1111111111111111111111111111111111;die;
               $request_otp_to_sent_otp = strtotime($request_time) - strtotime(($this->session->userdata('otp_created_on')));
               if($request_otp_to_sent_otp < $this->config->item('valid_otp_time'))
               {

                  // $this->session->set_flashdata('success', 'your otp match successfull! please submit new password!');
                  redirect('admin/forgot_password/password_reset');
               }
               else
               {
                  $this->session->set_flashdata('error', 'OTP timeout, Please resend OTP !!');
                  redirect('admin/forgot_password/check_otp/'.base64_encode($this->session->userdata('stake_holder_login_id')));
               }
            }
            else
            {
               $this->session->set_flashdata('error', 'Wrong OTP. Please Try Again !!');
               redirect('admin/forgot_password/check_otp');
            }


         }
      }

      $this->load->view($this->config->item('theme') . 'forgot_password/otp_check_view',$data);

  }

  public function password_reset($stale_holder_id=null, $sl_no=null)
  {
     // $stake_holder_id = base64_decode($stale_holder_id);
     // $sl_no = base64_decode($sl_no);
      $stake_holder_id = $this->session->userdata('stake_holder_login_id');
      if($this->session->userdata('fgot_otp_status')!=1)
      {
         redirect('admin');
      }
      // echo"<pre>";print_r($_SESSION);echo"</pre>";


     if($this->input->method(TRUE) == 'POST')
     {
         // echo 123;die;
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

         if($this->form_validation->run() == TRUE)
         {
            $uploaded = array(
            'login_password' => hash('sha256', $this->input->post('new_password')),
            'base_password' => $this->input->post('new_password'),
            // 'status' => 1
            );
            $sl_no = null;
            $result = $this->forgot_password_model->update_password_reset_details($uploaded, $stake_holder_id, $sl_no);
            // print_r($result);die;
            $this->db->trans_begin();
            if($result == 0)
            {
               $this->db->trans_commit();
               $this->session->set_flashdata('success', 'Your password has been changed successfully');


               $data = array(
                  'stake_holder_login_id_fk'    =>  $this->session->userdata('stake_holder_login_id'),
                  // 'stake_id_fk'              => 
                  'login_id'                    => $this->session->userdata('login_id'),
                  'mobile_no'                   => $this->session->userdata('mobile_no'),
                  'otp'                         => $this->session->userdata('secretotp'),
                  'created_on'                  => $this->session->userdata('otp_created_on'),
                  'is_success'                  => $this->config->item('is_otp_checked'),
                  'is_used_for'                 => $this->config->item('use_otp_forgotpassword')
               );
                // $update_otp = $this->login_model->update_otp_log($data);


               unset($_SESSION['salt']);
               unset($_SESSION['login_id']);
               unset($_SESSION['mobile_no']);
               unset($_SESSION['stake_holder_login_id']);
               unset($_SESSION['secretotp']);
               unset($_SESSION['otp_created_on']);
               unset($_SESSION['fgot_otp_status']);
               unset($_SESSION['success']);
               unset($_SESSION['stake_holder_login_id']);

               $this->session->set_flashdata('success', 'Your password reset successful! Please login with new password');
               redirect('admin');
            }
            else
            {
               $this->db->trans_rollback();
               $this->session->set_flashdata('error', 'Your password reset updation failed. Please try again!');
               // redirect('admin/forgot_password/password_reset/'.$stake_holder_id.'/'.$sl_no);
               redirect('admin');
            }
         }
      }

      $this->load->view($this->config->item('theme').'forgot_password/password_reset_view');
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
