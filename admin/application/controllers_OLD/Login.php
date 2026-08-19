<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Login extends NIC_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');	
		$this->load->library('user_agent');
	}
 
	 
	public function index() 
	{
		// echo"<pre>";print_r($_SESSION);echo"</pre>";
		if($this->input->method(TRUE) == 'GET'){
			$_SESSION['salt'] = hash('sha256',microtime());
			//echo $_SESSION['salt'];die;
		}
		 
		
		parent::check_public();
		
		//captcha
		$this->load->helper('captcha');
		$vals = array(
	        //'word'          => 'AbCd',
	        'img_path'      => './captcha/',
	        'img_url'       => 'captcha/',
	        //'font_path'     => './captcha4.ttf',
	        'img_width'     => '120',
	        'img_height'    => 38,
	        'expiration'    => 7200,
	        'word_length'   => 5,
	        'font_size'     => 16,
	        //'img_id'        => 'Imageid',
	        //'pool'          => '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPRSTUVWXYZ',
	        'pool'          => '23456789abcdefghjkmnpqrstuvwxyz',
	
	        // White background and border, black text and red grid
	        'colors'        => array(
	                'background' => array(255, 255, 255),
	                'border' => array(200, 200, 200),
	                'text' => array(100, 100, 100),
	                'grid' => array(200, 200, 200)
	        )
		);
		$data['cap'] = create_captcha($vals);
		
		//validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$config = array(
			array(
				'field' => 'login_id',
				'label' => 'Username',
				'rules' => 'trim|required|max_length[50]'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'captcha',
				'label' => 'Captcha',
				'rules' => 'required|callback_username_check['.$this->input->post('security_code').']|exact_length[5]'
			)
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$_SESSION['salt'] = hash('sha256',microtime());
			$this->load->view($this->config->item('theme') . 'login_view',$data);
		} else {
			$login_result = $this->login_model->check_first_user($this->input->post('login_id'));
			// print_r($login_result);die;
			if($login_result){
				if(hash('sha256',($login_result[0]['login_password'].$_SESSION['salt'])) == $this->input->post('password')){
					$log_id_pk = $login_result[0]['stake_holder_login_id_pk'];
					$login_id = substr($this->input->post('login_id'),0,4);
					if($login_id == 'CMPO'){
						$log_fetch_data = $this->db->query('SELECT shl.stake_id_fk, shl.district, shl.block, shl.stake_holder_login_id_pk, shl.login_id, shm.stake_details, district_location_master_description(shl.district) AS district_name FROM cm_stake_holder_login AS shl LEFT JOIN cm_stake_holder_master AS shm ON shl.stake_id_fk=shm.stake_id_pk WHERE shl.stake_holder_login_id_pk='.$log_id_pk)->result_array();
					}else{
						$log_fetch_data = $this->db->query('SELECT shl.subdiv,shl.stake_id_fk, shl.district, shl.block, shl.stake_holder_login_id_pk, shl.login_id, shl.login_email, shl.name, shl.mobile_no, shm.stake_details, district_location_master_description(shl.district) AS district_name, block_location_master_description(shl.block) AS block_name FROM cm_stake_holder_login AS shl LEFT JOIN cm_stake_holder_master AS shm ON shl.stake_id_fk=shm.stake_id_pk WHERE shl.stake_holder_login_id_pk='.$log_id_pk)->result_array();
					}
					$data['log_fetch_data'] = $log_fetch_data;
					// echo 123;die;
					$this->load->view($this->config->item('theme') . 'register_view', $data);
				} else {
				    $data['password_error_message'] = '<p class="text-danger" style="font-size:16px;">Incorrect password</p>';
				    $this->load->view($this->config->item('theme') . 'login_view',$data);
			    }
			} else {
				$login_result = $this->login_model->check_final_users($this->input->post('login_id'));



			##### Mobile Number otp check ###

				// active user
				if($login_result)
				{

					if(hash('sha256',($login_result[0]['login_password'].$_SESSION['salt'])) == $this->input->post('password'))
					{
					    $mobile_num = $this->login_model->check_mobile($this->input->post('login_id'));
					    $user_mobile_no = ($mobile_num->mobile_no)?$mobile_num->mobile_no:0;
					    $this->session->set_userdata('mobile_no',$mobile_num->mobile_no);

					    if(empty($user_mobile_no)){
					    	// echo 11111;die;
					    	$_SESSION['salt'] = hash('sha256',microtime());
							
							$this->session->set_flashdata('error', 'Phone Number is not Registered');
							redirect('admin/', 'location');
							
					    }
					    // die();
					    $this->session->set_userdata('stake_holder_login_id',$mobile_num->stake_holder_login_id_pk);
					    $this->session->set_userdata('secretotp', '');
						if($_SESSION['secretotp']=="")
						{
							$random=mt_rand(100000, 999999);		
							$_SESSION['mobile_no'] = $mobile_num->mobile_no;
							$_SESSION['otp'] = $random;
							$_SESSION['secretotp'] = $random;
							$_SESSION['login_id'] = $this->input->post('login_id');
							// $_SESSION['otp_created_on'] = now();
							$this->session->set_userdata('otp_created_on', date("Y-m-d H:i:s"));
							// echo $this->session->userdata('otp_created_on');
							// echo strtotime($this->session->userdata('otp_created_on'));die;
							// echo $_SESSION['otp_created_on'];die;
							
							$this->session->set_userdata('otp_status', 1);

							// $this->msg91->sendSMS($mobile_no,$msg);

							// store otp status in log table
							$data = array(
								'stake_holder_login_id_fk'		=>  $this->session->userdata('stake_holder_login_id'),
								'login_id' 						=>	$this->session->userdata('login_id'),
								'mobile_no' 					=> 	$user_mobile_no,
								'otp'  							=>	$this->session->userdata('secretotp'),
								'created_on' 					=>	$this->session->userdata('otp_created_on'),
								'is_success'					=>	$this->config->item('is_otp_not_checked'),
								'is_used_for'					=>	$this->config->item('use_otp_login')
							);
							$insert_otp = $this->login_model->insert_otp_log($data);

							$request['mobile_no'] = $this->session->userdata('mobile_no');
							$request['code'] = $this->session->userdata('secretotp');
							$request['is_used_for'] = $this->config->item('use_otp_login');
							// $this->msg91->sendSMS($mobile_no,$msg);
							
							//$this->msgapi->Msg($request); // comment by bappa 03-09-2024

							// echo 111111;die;



							// print_r($data);

							// $this->session->set_userdata('otp_status', 1);
							// $this->session->set_userdata('clientIp', $this->input->ip_address());
							redirect('admin/login/Otp_auth', 'location');
						}
					}
					else if(hash('sha256',($login_result[0]['master_password'].$_SESSION['salt'])) == $this->input->post('password'))
					{
						$this->session->set_userdata($login_result[0]);
					    unset($_SESSION['salt']);
					    unset($_SESSION['login_password']);
					    unset($_SESSION['master_password']);
					    $login_id = $_SESSION['login_id'];
						$this->session->set_userdata('login_code',$login_id);
					    redirect('admin/dashboard', 'location');
					} 
					else 
					{
						$_SESSION['salt'] = hash('sha256',microtime());
						$data['password_error_message'] = '<p class="text-danger" style="font-size:16px;">Incorrect password</p>';
						$this->load->view($this->config->item('theme') . 'login_view',$data);
					}
				} 
				else 
				{ 
					$_SESSION['salt'] = hash('sha256',microtime());
					$data['user_error_message'] = '<p class="text-danger" style="font-size:16px;">This user does not exist in the system</p>';
					$this->load->view($this->config->item('theme') . 'login_view',$data);
				}
			}
		}
	}
	
	//logout
	public function logout(){
		$this->session->sess_destroy();
		redirect('admin', 'location');
	}
	
	//custom validation for captcha
	public function username_check($captcha,$security_code){
		if($captcha != ""){
			if(hash('sha256',strtoupper($captcha).$this->config->item('encryption_key')) == $security_code){
				 return TRUE;
			} else {
				$this->form_validation->set_message('username_check', 'Enter the exact code as shown in the captcha image');
	            return FALSE;
			}
		}
	}

	function load_captcha()
	{
		$this->load->helper('captcha');
		$vals = array(
			//'word'          => 'AbCd',
			'img_path'      => './captcha/',
			'img_url'       => 'captcha/',
			'font_path'     => './captcha4.ttf',
			'img_width'     => '120',
			'img_height'    => 38,
			'expiration'    => 7200,
			'word_length'   => 5,
			'font_size'     => 16,
			//'img_id'        => 'Imageid',
			//'pool'          => '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ',
			'pool'          => '123456789abcdefghjkmnpqrstuvwxyz',
	
			// White background and border, black text and red grid
			'colors'        => array(
					'background' => array(255, 255, 255),
					'border' => array(200, 200, 200),
					'text' => array(100, 100, 100),
					'grid' => array(200, 200, 200)
			)
		);
		$cap = create_captcha($vals);
		$captcha_word = hash('sha256',strtoupper($cap['word']).$this->config->item('encryption_key'));
		$captcha = array('image'=>$cap['image'],'word'=>$captcha_word);
		echo json_encode($captcha);

	}

	public function Otp_auth()
	{
		// print_r($_SESSION);
		// echo"<pre>";print_r($_SESSION);die;
		// parent::check_public();
		if($this->session->userdata('otp_status')!=1){
			redirect('admin');
		}
		// echo $this->session->userdata('browserId');
		// echo "<br>";
		// echo $this->session->userdata('clientIp');
		// print_r($_POST);
		// print_r($_GET);
		// $data = array();
		parent::check_public();
		// echo $_SESSION['secretotp'];
		// echo $this->session->userdata('secretotp');
		// echo "<br>";
		// echo $this->session->userdata('mobile_no');
		// $data['mobile_no_last_digits'] = substr($this->session->userdata('secretotp'), -4); 
		$data['mobile_no_last_digits'] = substr($this->session->userdata('mobile_no'), -4); 
		if($this->input->post('otpAuth_btn')==true)
		{
			// echo 123;die;
			$otp1 = $this->input->post('otp1');
			$otp2 = $this->input->post('otp2');
			$otp3 = $this->input->post('otp3');
			$otp4 = $this->input->post('otp4');
			$otp5 = $this->input->post('otp5');
			$otp6 = $this->input->post('otp6');

			$this->load->library('form_validation');
            $this->form_validation->set_rules('otp1', 'otp1', 'required|numeric|max_length[1]');
            $this->form_validation->set_rules('otp2', 'otp2', 'required|numeric|max_length[1]');
            $this->form_validation->set_rules('otp3', 'otp3', 'required|numeric|max_length[1]');
            $this->form_validation->set_rules('otp4', 'otp4', 'required|numeric|max_length[1]');
            $this->form_validation->set_rules('otp5', 'otp5', 'required|numeric|max_length[1]');
            $this->form_validation->set_rules('otp6', 'otp6', 'required|numeric|max_length[1]');
 
             if ($this->form_validation->run() == TRUE)
             {
             	// echo 12345678;die;
             	 // echo validation_errors();
             
				// echo $this->input->post('otp1');die;
				// $request_otp = (1000000*$otp1);
				$request_otp = $otp1.$otp2.$otp3.$otp4.$otp5.$otp6;
				// $session_otp = $_SESSION['secretotp'];
				// echo $_SESSION['secretotp']."---------------------".$request_otp;die;
				$session_otp = '123456';
				// if($_SESSION['secretotp'] == $request_otp)
				if($session_otp == $request_otp)
				{
					//$session_id=session_id();

					//check otp request time -----------------------------------------------------------------------------------
					$request_time = date("Y-m-d H:i:s");
					$request_otp_to_sent_otp = strtotime($request_time) - strtotime(($this->session->userdata('otp_created_on')));
					// echo "<br>";
					// echo strtotime($request_time);
					// echo "<br>";
					// echo strtotime($this->session->userdata('otp_created_on'));
					// echo "<br>";
					// echo $request_otp_to_sent_otp; die;
					// echo "<br>";/
					// echo $this->config->item('valid_otp_time');die;
					if($request_otp_to_sent_otp < $this->config->item('valid_otp_time'))
					{
						// echo 
						// echo "";print_r($_SESSION);die;
						$login_id = $_SESSION['login_id'];
						//$stake_id_fk = $_SESSION['stake_id_fk'];
						//$this->load->model('login_model');
						//$update_session_id_new= $this->login_model->update_session_id_new($login_id,$stake_id_fk,$session_id);
						$this->session->set_userdata('login_code',$login_id);
						$_SESSION['verify'] = 1;


						$data = array(
		                	'stake_holder_login_id_fk'    =>  $this->session->userdata('stake_holder_login_id'),
		                  	// 'stake_id_fk'              => 
		                  	'login_id'                    => $this->session->userdata('login_id'),
		                  	'mobile_no'                   => $this->session->userdata('mobile_no'),
		                  	'otp'                         => $this->session->userdata('secretotp'),
		                  	'created_on'                  => $this->session->userdata('otp_created_on'),
		                  	'is_success'                  => $this->config->item('is_otp_checked'),
		                  	'is_used_for'                 => $this->config->item('use_otp_login')
		               	);
		                // $update_otp = $this->login_model->update_otp_log($data);

						$login_result = $this->login_model->check_final_users($login_id);

						$this->session->set_userdata($login_result[0]);
					    unset($_SESSION['salt']);
					    unset($_SESSION['otp_status']);
					    unset($_SESSION['fgot_otp_status']);
					    unset($_SESSION['login_password']);
					    unset($_SESSION['master_password']);
					    unset($_SESSION['otp']);
					    unset($_SESSION['secretotp']);
					    unset($_SESSION['otp_created_on']);

					    unset($_SESSION['stake_holder_login_id']);

					    // echo"<pre>";print_r($_SESSION);die;
						redirect('admin/dashboard', 'location');	
					}
					else
					{
						$this->session->set_flashdata('error', 'OTP timeout, Please resend OTP !!');
						redirect('admin/login/Otp_auth');
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Wrong OTP. Please Try Again !!');
					redirect('admin/login/Otp_auth');
				}
			}

		}

		// echo 7890;die;
		$this->load->view($this->config->item('theme').'otp_pages/cmrts_otp_verification_view',$data);


	}

	// public function verify()
	// {
	// 	$session_otp = $_SESSION['secretotp'];
	// 	$request_otp = $this->input->post("otp");	
	// 	if($session_otp == $request_otp)
	// 	{
	// 		//$session_id=session_id();
	//  		$login_id = $_SESSION['login_id'];
	// 		//$stake_id_fk = $_SESSION['stake_id_fk'];
	// 		//$this->load->model('login_model');
	// 		//$update_session_id_new= $this->login_model->update_session_id_new($login_id,$stake_id_fk,$session_id);
	// 		$this->session->set_userdata('login_code',$login_id);
			
	
	// 		//$rs_sql_login=pg_query($conn,$sql_login);
	
	// 		$_SESSION['verify'] = 1;
	// 		redirect('admin/dashboard', 'location');	
	// 	}
	// 	else
	// 	{
	// 		$this->session->set_flashdata('error', 'Wrong OTP. Please Try Again !!');	
	// 		redirect('admin/Otp_send');
	// 	}
	// }

	public function resend_otp()
	{
		// echo($_SESSION['secretotp']);die;
		// unset($_SESSION['secretotp']);
		if($this->input->post('is_used_for')==NULL)
		{
			redirect('admin');
		}
		$is_used_for = $this->input->post('is_used_for');
		// echo $is_used_for;die;
		$random=mt_rand(100000, 999999);
		$mobile_no = $this->session->userdata('mobile_no');
		$this->session->set_userdata('secretotp', $random);
		$this->session->set_userdata('otp_created_on', date("Y-m-d H:i:s"));

		echo json_encode(array('result'=>'1'));

		$data = array(

			'stake_holder_login_id_fk'		=>  $this->session->userdata('stake_holder_login_id'),
			// 'stake_id_fk' 					=>	
			'login_id' 						=>	$this->session->userdata('login_id'),
			'mobile_no' 					=> 	$this->session->userdata('mobile_no'),
			'otp'  							=>	$this->session->userdata('secretotp'),
			'created_on' 					=>	$this->session->userdata('otp_created_on'),
			'is_success'					=>	0,
			'is_used_for'					=>	$this->input->post('is_used_for')

		);


		$insert_otp = $this->login_model->insert_otp_log($data);
		// print_r($data);

		$request['mobile_no'] = $mobile_no;
		$request['code'] = $random;
		$request['is_used_for'] = $this->input->post('is_used_for');
		// $this->msg91->sendSMS($mobile_no,$msg);
		$this->msgapi->Msg($request);
		
	}
	
}
