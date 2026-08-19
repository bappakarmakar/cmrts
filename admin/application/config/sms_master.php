<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| OTP VALID DURATION - 5 Minutes = 300 sec
|--------------------------------------------------------------------------
|
*/
$config['valid_otp_time'] = 300;   
$config['otp_valid_for_templete'] = 10;   
/*
|--------------------------------------------------------------------------
| RESEND OTP DELAY - 1 Minute = 60 sec
|--------------------------------------------------------------------------
|
*/
$config['resend_otp_time'] = 60;
/*
|--------------------------------------------------------------------------
| OTP USED FOR STATUS
|--------------------------------------------------------------------------
|
*/
$config['use_otp_login'] = 101;
$config['use_otp_forgotpassword'] = 102;

$config['is_otp_checked'] = 1;
$config['is_otp_not_checked'] = 0;

/*
|--------------------------------------------------------------------------
| USER CHANGE 
|--------------------------------------------------------------------------
|
*/

$config['user_appv_req'] = 201;
$config['user_delinked'] = 202;
$config['user_appvd'] = 203;
$config['user_req_rej'] = 204;





?>
