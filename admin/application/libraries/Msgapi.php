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
      // $data['to'] = urlencode($data['mobile_no']); // Live code 

      //$data['to'] = urlencode('9830023105'); // Vahista madam Mobile for test line
      // $data['to'] = urlencode('964766599'); // soumen Mobile for test line
      $data['to'] = urlencode('837208679'); // Bappa Mobile for test line
      //$data['to'] = urlencode('7908242746'); // Abhijit sir Mobile for test line

      // echo "<pre>";print_r($data);die;
      // echo $data['to'];die;

      if($data['is_used_for'] == 101) //OTP to login
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

      else if($data['is_used_for'] == 201)
      {
        $data['feedid'] = urlencode('392952');
        $data['templateid'] = urlencode('1107171688332733904');
        $data['msg'] = "WCD&SW Department, GoWB - ".$data['requested_by']." has sent a request for change of user in the CMRTS portal for your approval. Government of West Bengal.";

        $data['msg'] = urlencode($data['msg']);
      }

      else if($data['is_used_for'] == 202)
      {
        $data['feedid'] = urlencode('392952');
        $data['templateid'] = urlencode('1107171688338318541');
        $data['msg'] = "WCD&SW Department, GoWB - At your request, your name and contact details have been de-linked on the CMRTS portal. Government of West Bengal.";

        $data['msg'] = urlencode($data['msg']);
      }
      else if($data['is_used_for'] == 203)
      {
        $data['feedid'] = urlencode('392952');
        $data['templateid'] = urlencode('1107171688346586910');
        $data['msg'] = "WCD&SW Department, GoWB - Your CMRTS account has been approved. You can log in at www.cmrts.wb.gov.in with user ID ".$data['login_id']." and password ".$data['new_password']." . Do not share it with anyone. Please change your password after first login. Government of West Bengal.";

        $data['msg'] = urlencode($data['msg']);
      }

      else if($data['is_used_for'] == 204)
      {
        $data['feedid'] = urlencode('392951');
        $data['templateid'] = urlencode('1107171688352183016');
        $data['request'] = urlencode('request');
        $data['req_for'] = 'change of user';
        $data['req_result'] = urlencode('rejected');
        $data['msg'] = "WCD&SW Department, GoWB - Your ".$data['request']." for ".$data['req_for']." in CMRTS has been ".$data['req_result'].". Government of West Bengal.";

        $data['msg'] = urlencode($data['msg']);
      }

      // ---------- Intervention messagge 28-11-20 By Bappa start -----------
      else if($data['is_used_for'] == 301){

        // echo "<pre>"; print_r($data);die;
        $data['feedid'] = urlencode('392952');
        $data['templateid'] = urlencode('1107173226072993532');
        $data['msg'] = "WCDSW-GoWB: CMRTS Intervention ".$data['reporting_id']." conducted on ".$data['incident_date']." in ".$data['incident_district']." ".$data['incident_block_municp']." has been recorded on CMRTS portal.  For monitoring and necessary action.";

        $data['msg'] = urlencode($data['msg']);
      }
      else if($data['is_used_for'] == 302){

        // echo "<pre>"; print_r($data);die;

        // For CP1 SDO/BDO and DEO
        $data['feedid'] = urlencode('392951');
        $data['templateid'] = urlencode('1107173226078256712');
        $data['msg'] = "WCDSW-GoWB: CMRTS Intervention ".$data['reporting_id']." conducted on ".$data['incident_date']." in ".$data['incident_district']." ".$data['incident_block_municp']." has been recorded on CMRTS portal.  Home Enquiry of ".$data['cp1_minor_adult']."  ".$data['cp1_gender']."  contracting party ".$data['cp1_name']." residing in ".$data['cp1_block_municip']." ".$data['cp1_gp_ward']." is due";

        $data['msg'] = urlencode($data['msg']);

      }
      else if($data['is_used_for'] == 303){
        // echo "<pre>"; print_r($data);die;

        // For CP2 SDO/BDO and DEO
        $data['feedid'] = urlencode('392951');
        $data['templateid'] = urlencode('1107173226078256712');
        $data['msg'] = "WCDSW-GoWB: CMRTS Intervention ".$data['reporting_id']." conducted on ".$data['incident_date']." in ".$data['incident_district']." ".$data['incident_block_municp']." has been recorded on CMRTS portal.  Home Enquiry of ".$data['cp2_minor_adult']."  ".$data['cp2_gender']."  contracting party ".$data['cp2_name']." residing in ".$data['cp2_block_municip']." ".$data['cp2_gp_ward']." is due";

        $data['msg'] = urlencode($data['msg']);
      }
      else if($data['is_used_for'] == 401){
        // echo "<pre>";print_r($data);die;

        // for SNO message where CP1 is outside the Westbengal
        $data['feedid'] = urlencode('392951');
        $data['templateid'] = urlencode('1107173226082337190');
        $data['msg'] = "WCDSW-GoWB: CMRTS Intervention ".$data['reporting_id']." conducted on ".$data['incident_date']." in ".$data['incident_district']." ".$data['incident_block_municp']." has been recorded on CMRTS portal.  ".$data['cp1_minor_adult']."  ".$data['cp1_gender']."  contracting party ".$data['cp1_name']." is from outside West Bengal.";

        $data['msg'] = urlencode($data['msg']);

      }
      // ------- Intervention messagge 28-11-20 By Bappa start ---------

      $request = 'feedid='.$data['feedid'].'&username='.$data['username'].'&To='.$data['to'].'&Text='.$data['msg'].'&templateid='.$data['templateid'].'&async='.$data['async'].'&password='.$data['password'];

      $data['request'] = str_replace('+', '%20', $request);
      // echo $data['request'];die;

      $this->callapi($data['request']);
      // return 1;
      return $data;
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
      // echo $response;die;
    }
    else
    {
      return false;
    }
  }
}