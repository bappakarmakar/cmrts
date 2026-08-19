<?php 

// echo 1111111;


// $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://202.162.232.200/BulkSms/SingleMsgApi',
  // CURLOPT_RETURNTRANSFER => true,
  // CURLOPT_ENCODING => '',
  // CURLOPT_MAXREDIRS => 10,
  // CURLOPT_TIMEOUT => 0,
  // CURLOPT_FOLLOWLOCATION => true,
  // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  // CURLOPT_SSL_VERIFYPEER => false,
  // CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_POSTFIELDS => 'feedid=392951&username=8972003060&To=7980749055&Text=WCD%26SW%20Department%2C%20GoWB%20-%20OTP%20to%20login%20in%20CMRTS%20application%20is%200.%20Do%20not%20share%20it%20with%20anyone.%20Government%20of%20West%20Bengal.%20This%20OTP%20is%20Valid%20for%2051%20minutes.&templateid=1107171265773350159&async=1&password=CmrtsMsg%4024',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);



if (curl_errno($curl)) 
{
	$error_msg = curl_error($curl);

	echo $error_msg;die;
}

	curl_close($curl);
	echo $response;die;

// curl_close($curl);
// echo $response;


// http://202.162.232.200/BulkSms/SingleMsgApi?feedid=393026&To=7044056134&Text=Your%20OTP%20is%20123%20for%20the%20request%20made%20on%20123%20for%20change%20of%20mobile.%20OTP%20will%20expire%20in%203%20mins.%20DAS%20PAR%20GoWB&Username=9830450164&Password=Xyz@1234







?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>

<p>SMS test</p>
<body>

	<a href="https://202.162.232.200/BulkSms/SingleMsgApi?feedid=392951&To=7797382502&Text=WCD%26SW%20Department%2C%20GoWB%20-%20OTP%20to%20login%20in%20CMRTS%20application%20is%200.%20Do%20not%20share%20it%20with%20anyone.%20Government%20of%20West%20Bengal.%20This%20OTP%20is%20Valid%20for%2051%20minutes.&templateid=1107171265773350159&Username=8972003060&Password=CmrtsMsg%4024">sms</a>

</body>
</html>
