<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Welcome extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('welcome_model');
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$data['data'] ='';
		redirect('admin');
		// $this->load->view($this->config->item('theme').'welcome_view',$data);
	}


	public function sms_test()
	{


		// $curl = curl_init();

		// curl_setopt_array($curl, array(
		//   CURLOPT_URL => 'https://202.162.232.200/BulkSms/SingleMsgApi',
		//   CURLOPT_RETURNTRANSFER => true,
		//   CURLOPT_ENCODING => '',
		//   CURLOPT_MAXREDIRS => 10,
		//   CURLOPT_TIMEOUT => 0,
		//   CURLOPT_FOLLOWLOCATION => true,
		//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		//   CURLOPT_CUSTOMREQUEST => 'GET',
		//   CURLOPT_POSTFIELDS => 'feedid=392951&username=8972003060&password=CmrtsMsg%4024&To=9734436010&Text=WCD%26SW%20Department%2C%20GoWB%20-%20OTP%20to%20login%20in%20CMRTS%20application%20is%20123456.%20Do%20not%20share%20it%20with%20anyone.%20Government%20of%20West%20Bengal.%20This%20OTP%20is%20Valid%20for%205%20minutes.&templateid=1107171265773350159&async=1',
		//   CURLOPT_HTTPHEADER => array(
		//     'Content-Type: application/x-www-form-urlencoded'
		//   ),
		// ));

		// $response = curl_exec($curl);
		// // echo 1234;die;

		// if (curl_errno($curl)) {
    	// $error_msg = curl_error($curl);

    	// echo $error_msg;die;
		// }

		// curl_close($curl);
		// echo $response;die;


			$curl = curl_init();

			curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://202.162.232.200/BulkSms/SingleMsgApi',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => 'feedid=392952&username=8972003060&password=CmrtsMsg%4024&To=9734436010&Text=WCD%26SW%20Department%2C%20GoWB%20-%20OTP%20to%20login%20in%20CMRTS%20application%20is%200001.%20Do%20not%20share%20it%20with%20anyone.%20Government%20of%20West%20Bengal.%20This%20OTP%20is%20Valid%20for%205%20minutes.&templateid=1107171265773350159&async=1',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded'
			),
			));

			$response = curl_exec($curl);

			if (curl_errno($curl)) {
				$error_msg = curl_error($curl);
		
				echo $error_msg;die;
				}
		
				

			curl_close($curl);
			// echo $response;
			print_r($response);







	}



	
}
