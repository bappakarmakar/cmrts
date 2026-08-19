<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://test1bulksms.mytoday.com/BulkSms/JsonSingleApi',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"feedid":392951,"username":8972003060,"password":"CmrtsMsg@24","jobname":"Jobname/Messagetag","mobile":7980749055,"messages":"WCD&SW Department, GoWB - OTP to login in CMRTS application is 12345. Do not share it with anyone. Government of West Bengal. This OTP is Valid for 5 minutes.","templateid":"1107171265773350159","entityid":"WBGOVT"}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;