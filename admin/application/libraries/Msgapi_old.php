<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Msgapi 
{
  public function Msg($data = array()) 
  {
  	// echo "<pre>";print_r($data);die;
    $ci=& get_instance();
    // echo $ci->config->item('otp_valid_for_templete');die;

    if(!empty($data))
    {
      $data['username'] = urlencode('8972003060');
      $data['password'] = urlencode('CmrtsMsg@24');
      $data['async'] = urlencode('1');
      $data['to'] = urlencode($data['mobile_no']);
      // $data['to'] = urlencode('7980749055');

      // echo "<pre>";print_r($data);die;

      // echo $data['to'];die;


      if($data['is_used_for'] == 101)
      {
          $data['feedid'] = urlencode('392951');
          $data['templateid'] = urlencode('1107171265773350159');
          $data['msg'] = "WCD&SW Department, GoWB - OTP to login in CMRTS application is ".$data['code'].". Do not share it with anyone. Government of West Bengal. This OTP is Valid for ".$ci->config->item('otp_valid_for_templete')." minutes.";
          $data['msg'] = urlencode($data['msg']);
      }
      else if($data['is_used_for'] == 102)
      {
        $data['feedid'] = urlencode('392951');
        $data['templateid'] = urlencode('1107171265782113341');
        $data['msg'] = "WCD&SW Department, GoWB - OTP to change password in CMRTS application is ".$data['code'].". Do not share it with anyone. Government of West Bengal. This OTP is Valid for ".$ci->config->item('otp_valid_for_templete')." minutes.";

        $data['msg'] = urlencode($data['msg']);

      }

      $request = 'feedid='.$data['feedid'].'&username='.$data['username'].'&To='.$data['to'].'&Text='.$data['msg'].'&templateid='.$data['templateid'].'&async='.$data['async'].'&password='.$data['password'];

      $data['request'] = str_replace('+', '%20', $request);

      $this->callapi($data['request']);

    }
    else
    {
      return false;
    }
  }
  protected function callapi($data = null)
  {

    // die;
    // return null;die;
    if(isset($data))
    {
      // echo 11111;die;
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://202.162.232.200/BulkSms/SingleMsgApi',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/x-www-form-urlencoded'
        ),
      ));
      $response = curl_exec($curl);
      curl_close($curl);
      echo $response;
    }
    else
    {
      return false;
    }
  }
}