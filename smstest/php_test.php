<?php

// echo 111;die;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://202.162.232.200/BulkSms/SingleMsgApi',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'feedid=392952&username=8972003060&password=CmrtsMsg%4024&To=9432334024&Text=WCD%26SW%20Department%2C%20GoWB%20-%20OTP%20to%20login%20in%20CMRTS%20application%20is%2001.%20Do%20not%20share%20it%20with%20anyone.%20Government%20of%20West%20Bengal.%20This%20OTP%20is%20Valid%20for%2010%20minutes.&templateid=1107171265773350159&async=1',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
