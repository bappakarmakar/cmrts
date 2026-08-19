<!DOCTYPE html>
<html>
    <head>
        <base href="<?php echo base_url(); ?>admin/" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Forgot Password</title>
        <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>login/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>login/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('theme_uri');?>login/fonts/font-awesome/css/font-awesome.css">
        <script src="<?php echo $this->config->item('theme_uri');?>sha256.js"></script>
        <script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>login/css/toastr.min.css">
        <style type="text/css">
        .m-2 {
        margin: 0.5rem !important;
        }
        .otp_msg {
        text-align: center;
        }
        .rounded {
        border-radius: 0.25rem !important;
        }
        .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 18px;
        line-height: 2.0;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .login-sec {
        width: 45%;
        float: left;
        margin-top: 75px;
        margin-left: 28%;
        border: 1px solid #FFFFFF;
        background: #FFFFFF;
        padding: 14px;
        border-radius: 10px;
        }
        .login_btn {
        background: #0b1b52;
        border: none;
        width: 100%;
        color: #fff;
        padding: 10px 0;
        font-size: 18px;
        border-radius: 8px;
        margin-bottom: 7px;
        cursor: pointer;
        }
        .sign_up_btn:hover {
        color: #000000;
        }
        .login-sec-heading {
        font-size: 45px;
        color: #00376b;
        text-transform: capitalize;
        text-align: center;
        font-weight: 400;
        }
        .custom_login_box {
        display: block;
        width: 100%;
        margin-bottom: 18px;
        border: 1px solid #6c6c6c;
        background: transparent;
        height: 45px;
        font-size: 14px;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-left: 10px;
        border-radius: 8px;
        color: #373737;
        }
        .userid_box:before {
        content: '\f007';
        font-family: FontAwesome;
        position: absolute;
        top: 11px;
        left: 14px;
        font-size: 20px;
        color: #0b1b52;
        }
        .error {
        color: red;
        }
        #resendBtn {
        border: none;
        background-color: #a881af;
        /* color: white; */
        padding: 6px 18px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        /* cursor: pointer; */
        }
        /* .otp-input-fields input {
        height: 40px;
        width: 40px;
        background-color: transparent;
        border-radius: 4px;
        border: 1px solid #0b1b52;
        text-align: center;
        outline: none;
        font-size: 16px;
        }*/
        /* .otp-input-fields input::-webkit-outer-spin-button, .otp-input-fields input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
        .otp-input-fields input[type=number] {
        -moz-appearance: textfield;
        }
        .otp-input-fields input:focus {
        border-width: 2px;
        border-color: #287a1a;
        font-size: 20px;
        }*/
              .error {
         color: red;
      }
        .error-box {
        border: 1px solid red !important; /* Apply red border for failed validations */
        }
        </style>
    </head>
    <body style="background: url('<?php echo $this->config->item('theme_uri');?>login/image/website-admin-background.jpg');">
    </body>
</html>

<!--login start-->
<section class="login">
    <!-- <div class="login-img">
        <img src="<?php //echo $this->config->item('theme_uri');?>login/image/login-img.png" class="img-responsive" alt="">
    </div> -->
    <div class="login-sec">
        <h2 class="login-sec-heading">CMRTS Online 1.0</h2>
        <div id="respose" class="text-success text-center" style="font-size:18px;"></div>
        <!-- <p style="font-size: 16px;text-align: center;">OTP VERIFICATION</p> -->
        <div class="otp_msg">
            <h4 style="">Please enter the one time password to verify your account <?php echo $this->session->userdata('login_id');?></h4>
            <h4 >A code has been sent to *******<?php echo $mobile_no_last_digits; ?> </h4>
        </div>
        <?php $this->load->view('errors/message'); ?>
        <?php
        $last = $this->uri->total_segments();
        $record_num = $this->uri->segment($last);
        ?>
        <?php echo form_open('admin/forgot_password/check_otp/'.$record_num,array('class' => 'check_otp_form','name' => 'check_otp_form', 'id' => 'check_otp_form','autocomplete'=>'off')); ?>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group mt-3">
                    <div class="text-center">
                        <h4 style="text-center font-size: 16px;">Please enter OTP to verify</h4>
                    </div>
                    
                    <div id="otp" class="otp-input-fields inputs d-flex flex-row justify-content-center mt-2">
                        <input type="text" class="otp__digit otp__field__1 m-2 text-center form-control rounded" name="otp_1" maxlength="1" id="otp1">
                        <input type="text" class="otp__digit otp__field__2 m-2 text-center form-control rounded" name="otp_2" maxlength="1" id="otp2">
                        <input type="text" class="otp__digit otp__field__3 m-2 text-center form-control rounded" name="otp_3" maxlength="1" id="otp3">
                        <input type="text" class="otp__digit otp__field__4 m-2 text-center form-control rounded" name="otp_4" maxlength="1" id="otp4">
                        <input type="text" class="otp__digit otp__field__5 m-2 text-center form-control rounded" name="otp_5" maxlength="1" id="otp5">
                        <input type="text" class="otp__digit otp__field__6 m-2 text-center form-control rounded" name="otp_6" maxlength="1" id="otp6">
                    </div>
                    <?php if(isset($_POST['verify_otp'])){ ?><?php echo $this->session->flashdata('otp_required_error'); ?><?php } ?>
                    <?php if($this->session->flashdata('otp_error') != ""){ ?><?php echo $this->session->flashdata('otp_error'); ?><?php } ?>
                </div>
            </div>
             <div class="col-sm-12">
            <button id="resendBtn" onclick="startCountdown(<?php echo $this->config->item('use_otp_forgotpassword'); ?>)">Resend OTP</button>
            <p id="countdown"></p>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <div class="login_btn_sec">
                        <button type="submit" class="button login_btn" id="otpAuth_btn" name="verify_otp">Verify OTP</button>
                        <a href="<?php echo base_url()?>admin/login/logout" class="sign_up_btn" style="float: left;">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>
<!--login end-->
<!--footer start-->
<div class="footer" style="margin-top: 224px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 copytxt">
                <p>CMRTS Online 1.0 © Copyright 2022, All Right Reserved</p>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 developtxt">
                <span>Designed & Developed By</span>
                <img src="<?php echo $this->config->item('theme_uri');?>login/image/nic-logo.png" alt="">
            </div>
        </div>
    </div>
</div>
<!--footer end-->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>login/login.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>login/js/toastr.min.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>login/js/jquery.validate.min.js"></script>
<!-- <script type="text/javascript">
var otp_inputs = document.querySelectorAll(".otp__digit")
var mykey = "0123456789".split("")
otp_inputs.forEach((_)=>{
_.addEventListener("keyup", handle_next_input)
})
function handle_next_input(event){
let current = event.target
let index = parseInt(current.classList[1].split("__")[2])
current.value = event.key

if(event.keyCode == 8 && index > 1){
current.previousElementSibling.focus()
}
if(index < 6 && mykey.indexOf(""+event.key+"") != -1){
var next = current.nextElementSibling;
next.focus()
}
var _finalKey = ""
for(let {value} of otp_inputs){
_finalKey += value
}
if(_finalKey.length == 6){
document.querySelector("#_otp").classList.replace("_notok", "_ok")
document.querySelector("#_otp").innerText = _finalKey
}else{
document.querySelector("#_otp").classList.replace("_ok", "_notok")
document.querySelector("#_otp").innerText = _finalKey
}
}
</script> -->
<script>
let countdown;
let initialSeconds = <?php echo $this->config->item('resend_otp_time'); ?> ; // Initial value for 10 seconds
let seconds; // Declare seconds globally
function startCountdown(is_used_for) {
    resend_otp(is_used_for);
    seconds = initialSeconds;
    // Disable the button during countdown
    document.getElementById('resendBtn').disabled = true;
    // Display the initial countdown value
    displayCountdown();
    // Start the countdown
    countdown = setInterval(function() {
        seconds--;
        // Display the updated countdown value
        displayCountdown();
        // Check if the countdown has reached zero
        if (seconds <= 0) {
            clearInterval(countdown);
            // Enable the button after the countdown is over
            document.getElementById('resendBtn').disabled = false;
        }
    }, 1000);
}

function displayCountdown() {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = seconds % 60;
    const countdownElement = document.getElementById('countdown');
    // Check if the countdown has reached zero
    if (seconds <= 0) {
        countdownElement.innerHTML = ''; // Clear the content
    } else {
        countdownElement.style.display = 'block'; // Ensure the countdown element is visible
        countdownElement.innerHTML = `Resend OTP in ${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
    }
}
</script>
<script type="text/javascript">
    function resend_otp(is_used_for) {
        $.ajax({
            url: "<?php echo base_url();?>admin/login/resend_otp",
            type: "POST",
            dataType: "json",
            data: {
                'is_used_for': is_used_for,
                // Your other data
                <?php echo $this->security->get_csrf_token_name(); ?> : '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(response) {
                if (response.result == 1) {
                    // OTP reset successful
                    $('#respose').html('OTP resend successful!');
                    // alert('OTP reset successful!');
                } else {
                    // OTP reset failed
                    $('#respose').html('OTP reset failed, Please try again!');
                    // alert('OTP reset failed');
                }
            },
            // error: function(xhr, status, error) {
            //     // Handle errors here
            //     console.log(error);
            // }
        });
    }
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#otp1').focus();
        $("#check_otp_form").validate({
            rules: {
                otp_1: {
                    required: true,
                    digits: true
                },
                otp_2: {
                    required: true,
                    digits: true
                },
                otp_3: {
                    required: true,
                    digits: true
                },
                otp_4: {
                    required: true,
                    digits: true
                },
                otp_5: {
                    required: true,
                    digits: true
                },
                otp_6: {
                    required: true,
                    digits: true
                }
            },
            errorPlacement: function(error, element) {
                // Do not show any error messages
            },
            highlight: function(element) {
                $(element).addClass('error-box');
            },
            unhighlight: function(element) {
                $(element).removeClass('error-box');
            },
            submitHandler: function(form) {
                // Custom validation logic if needed
                form.submit();
            }
        });
    });
</script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event) {
  
   function OTPInput() 
   {
      document.getElementById('otpAuth_btn').style.border = '0px';
      const inputs = document.querySelectorAll('#otp > *[id]');
      for (let i = 0; i < inputs.length; i++) 
      {
         inputs[i].addEventListener('keydown', function(event) 
         {
            // if(event.keyCode > 47 && event.keyCode < 58 && event.key !== 'Backspace') 
            // {
            //    // return false;
            //    event.preventDefault();
            // }
            if (event.key === "Backspace") 
            {
               inputs[i].value = '';
               if (i !== 0) inputs[i - 1].focus();
            }
            if (isNaN(event.key)) 
            {
               inputs[i].value = '';
               event.preventDefault(); // Prevent default behavior
            }  
            else 
            {  
               console.log(event.keyCode);
               if (i === inputs.length - 1 && inputs[i].value !== '') 
               {
                  return true;
               }
               else if ((event.keyCode > 47 && event.keyCode < 58)||(event.keyCode > 95 && event.keyCode < 106)) 
               {
                  inputs[i].value = event.key;
                  if (i !== inputs.length - 1) 
                  {
                     inputs[i + 1].focus();
                  }
                  else if(i == inputs.length - 1)
                  {
                    document.getElementById('otpAuth_btn').focus();
                    document.getElementById('otpAuth_btn').style.border = '4px solid green';
                  }
                  event.preventDefault();
               }
               else {
                    // Remove non-numeric characters
                    inputs[i].value = '';
                } 
               /*else if (event.keyCode > 64 && event.keyCode < 91) 
               {
                  inputs[i].value = String.fromCharCode(event.keyCode);
                  if (i !== inputs.length - 1) inputs[i + 1].focus();
                  event.preventDefault();
               }*/
            }
            
         });
      }
   }
OTPInput();


});

</script>
</body>
</html>