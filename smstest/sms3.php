<?php


$msg  = "WCD&SW Department, GoWB - OTP to login in CMRTS application is 102. Do not share it with anyone. Government of West Bengal. This OTP is Valid for 2 minutes.";
    $msg = urlencode($msg);

    // echo $msg;die;

    $feedid = urlencode('392951');
    $username = urlencode('8972003060');
    $to = urlencode('7980749055');
    $templateid = urlencode('1107171265773350159');
    $async = urlencode('1');
    $password = urlencode('CmrtsMsg@24');

    $request = 'feedid='.$feedid.'&username='.$username.'&To='.$to.'&Text='.$msg.'&templateid='.$templateid.'&async='.$async.'&password='.$password;

    $request = str_replace('+', '%20', $request);


   


    // $msg = 

    $data = 'feedid=392951&username=8972003060&To=7797382502&Text=WCD%26SW%20Department%2C%20GoWB%20-%20OTP%20to%20login%20in%20CMRTS%20application%20is%201111.%20Do%20not%20share%20it%20with%20anyone.%20Government%20of%20West%20Bengal.%20This%20OTP%20is%20Valid%20for%202%20minutes.&templateid=1107171265773350159&async=1&password=CmrtsMsg%4024';


    //  echo $data."<br><br><br>";
    // echo $request;die;

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
        CURLOPT_POSTFIELDS => $request,
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/x-www-form-urlencoded'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      echo $response;





