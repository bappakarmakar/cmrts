<!DOCTYPE html>
<html>
   <head>
      <base href="<?php echo base_url(); ?>admin/" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Login Panel</title>
      <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>login/css/bootstrap.css">
      <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>login/css/style.css">
      <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('theme_uri');?>login/fonts/font-awesome/css/font-awesome.css">
      <script src="<?php echo $this->config->item('theme_uri');?>sha256.js"></script>
      <script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
      <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>login/css/toastr.min.css">
      <script>
      </script>
      <style type="text/css">
      .login-sec {
		    width: 45%;
          float: left;
          margin-top: 40px;
          margin-left: 28%;
          border: 1px solid #FFFFFF;
          background: #FFFFFF;
          padding: 14px;
          border-radius: 10px;
          margin-bottom: 100px;
		}
		.otpAuth_btn {
		    background: #0b1b52;
		    border: none;
		    width: 100%;
		    color: #fff;
		    padding: 10px 0;
		    font-size: 18px;
		    border-radius: 8px;
		    /*padding: 12px;*/
		    /*margin-top: 25px;*/
          margin-bottom: 7px;
          cursor: pointer;
		}
      .captcha_input {
         /*display: inline-block;
         width: 71%;
         margin-bottom: 2px;
         border: 1px solid #6c6c6c;
         background: transparent;
         height: 45px;
         position: relative;
         font-size: 14px;
         margin-left: 12px;
         border-radius: 8px;
         color: #373737;*/
         display: inline-block;
         margin-bottom: 2px;
         border: 1px solid #6c6c6c;
         background: transparent;
         height: 45px;
         position: relative;
         font-size: 14px;
         margin-left: -123px;
         border-radius: 8px;
         color: #373737;
         width: 397px;
      }
      .forgot_password_btn {
         color: #000000;
      }
      .forgot_password_btn:hover {
         color: #007bff;
      }
      .login-sec-heading {
         font-size: 30px;
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
      .password_box:before {
         content: '\f023';
         font-family: FontAwesome;
         position: absolute;
         top: 12px;
         left: 14px;
         font-size: 20px;
         color: #0b1b52;
      }
      .error {
         color: red;
      }

    .error-box {
        border: 1px solid red !important; /* Apply red border for failed validations */
    }
      input {
         margin: 0px !important;
      }
      .otp_msg {
         text-align: center;
      }
      </style>

   <style type="text/css">
   #resendBtn
   {

     border: none;
     background-color: #a881af;
/*     color: white;*/
     padding: 6px 18px;
     text-align: center;
     text-decoration: none;
     display: inline-block;
     font-size: 16px;
     margin: 4px 2px;
/*     cursor: pointer;*/

   }

   </style>
   </head>
   <body style="background: url('<?php echo $this->config->item('theme_uri');?>login/image/website-admin-background.jpg');">
   </body>
</html>
<!--header start-->
<!-- <section class="header">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <img src="<?php echo $this->config->item('theme_uri');?>login/image/snehachaya-logo.png" class="img-responsive" alt="">
         </div>
         <div class="col-md-3 text-center">
            <div class="helpline"><img src="<?php echo $this->config->item('theme_uri');?>login/image/helpline.png" class="img-responsive" alt="">Helpline No:XXXXXXXXXX</div>
         </div>
         <div class="col-md-3 text-right">
            <img src="<?php echo $this->config->item('theme_uri');?>login/image/bb-logo.png" class="img-responsive" alt="">
         </div>
      </div>
   </div>
</section> --> 
<!--header end-->
<!--login start-->
<section>
   <div>
      <h2 class="text-center" style="color: #fff;
      font-size: 40px;
    margin-top: 35px;
    text-shadow: 1px 1px 2px #000;
    font-weight: 600;
    letter-spacing: 1px;">Child Marriage Reporting and Tracking System V 1.0</h2>
   </div>
</section>
<section class="login">

   	<div class="login-sec">
      <h2 class="login-sec-heading">CMRTS Online 1.0</h2>
      <div id="respose" class="text-success text-center" style="font-size:18px;">
         <?php if($this->session->flashdata('success') != "")
         {
          ?>
            <p class="text-success text-center" style="font-size:18px;"><?php echo $this->session->flashdata('success'); ?></p>
            <?php 
         }
         else if($this->session->flashdata('error') != "")
         { 
            ?>
            <p class="text-error text-center" style="font-size:18px; color: red;"><?php echo $this->session->flashdata('error'); ?></p>
            <?php
         }
            ?>
      </div>
      <!-- <?php echo (isset($error_message)) ? $error_message : "";?> -->
      <?php echo form_open('admin/login/Otp_auth',array('class' => 'login_otpAuth','name' => 'login_otpAuth', 'id' => 'login_otpAuth','autocomplete'=>'off','onsubmit'=>'return encription()')); ?>
      <!-- <input type="hidden" class="security_code" name="security_code" value="<?php echo hash('sha256',strtoupper($cap['word']).$this->config->item('encryption_key')) ?>"> -->
      <div class="otp container">
         <div class="otp_msg">
            <h4 style="">Please enter the one time password to verify your account</h4>
            <h6 >A code has been sent to *******<?php echo $mobile_no_last_digits; ?> </h6>
         </div>
         <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> 
            <input class="m-2 text-center form-control rounded" type="text" id="otp1" maxlength="1"  name="otp1"/> 
            <input class="m-2 text-center form-control rounded" type="text" id="otp2" maxlength="1" name="otp2"/> 
            <input class="m-2 text-center form-control rounded" type="text" id="otp3" maxlength="1"  name="otp3"/> 
            <input class="m-2 text-center form-control rounded" type="text" id="otp4" maxlength="1" name="otp4"/> 
            <input class="m-2 text-center form-control rounded" type="text" id="otp5" maxlength="1"  name="otp5"/> 
            <input class="m-2 text-center form-control rounded" type="text" id="otp6" maxlength="1"  name="otp6"/>
         </div>
         <div >
            <?php echo form_error('otp1'); ?>
            <?php echo form_error('otp2'); ?>
            <?php echo form_error('otp3'); ?>
            <?php echo form_error('otp4'); ?>
            <?php echo form_error('otp5'); ?>
            <?php echo form_error('otp6'); ?>
         </div>
      </div>
<button id="resendBtn" onclick="startCountdown(<?php echo $this->config->item('use_otp_login'); ?>)">Resend OTP</button>   
<p id="countdown"></p>
      <div class="row">    
         <div class="col-sm-12">
            <div class="form-group">
                <div class="login_btn_sec">
                  <input type="submit" id="otpAuth_btn" class="otpAuth_btn" value="Enter OTP" name="otpAuth_btn">
                  <!-- <a href="<?php echo base_url()?>admin/forgot_password" class="forgot_password_btn" style="float: left;">Forgot Password?</a> -->
                </div>
            </div>
         </div>
      </div>
    </div>
   <div class="clearfix"></div>
</section>
<!--login end-->
<!--footer start-->
<div class="footer">
   <div class="container">
      <div class="row">
         <div class="col-md-6 col-sm-12 col-xs-12 copytxt">
            <p>CMRTS Online 1.0 © Copyright 2023-24, All Right Reserved</p>
         </div>
         <div class="col-md-6 col-sm-12 col-xs-12 developtxt">
            <span>Designed & Developed By</span>
            <img src="<?php echo $this->config->item('theme_uri');?>login/image/nic-logo.png" alt="">
         </div>
      </div>
   </div>
   <div class="bottom-footer py-2">
      <p class="text-center text-white m-0">
Disclaimer Contents, data and process owned and maintained by Department of <a href="#" style="color:#78d5fc">Women & Child Development and Social Welfare</a> , Government of West Bengal.</p>
   </div>
   
</div>
<!--footer end-->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>login/login.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>login/js/toastr.min.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>login/js/jquery.validate.min.js"></script>
<!-- <script type="text/javascript">
$( "#login_otpAuth" ).validate({
  rules: {
   otp1: {
      required: true
    },
    otp2: {
      required: true
    },
    otp3: {
      required: true
    }
  },
  messages : {
     otp1: {
       required: ""
     },
     otp2: {
       required: ""
     },
     otp3: {
       required: ""
     },
  },
});
</script> -->

<script type="text/javascript">
    $(document).ready(function() {
      $('#otp1').focus();
        $("#login_otpAuth").validate({
            rules: {
               otp1: {
                    required: true,
                    digits: true
                },
                otp2: {
                    required: true,
                    digits: true
                },
                otp3: {
                    required: true,
                    digits: true
                },
                otp4: {
                    required: true,
                    digits: true
                },
                otp5: {
                    required: true,
                    digits: true
                },
                otp6: {
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
               // console.log(event.keyCode);
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

<script>
    let countdown;
    let initialSeconds = <?php echo $this->config->item('resend_otp_time');?>; // Initial value for 10 seconds
    let seconds; // Declare seconds globally

    function startCountdown(is_used_for) {
      // alert(is_used_for);

      resend_otp(is_used_for);
        seconds = initialSeconds;

        // Disable the button during countdown
        document.getElementById('resendBtn').disabled = true;

        // Display the initial countdown value
        displayCountdown();

        // Start the countdown
        countdown = setInterval(function () {
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
   // alert(is_used_for)
    $.ajax({
        url: "<?php echo base_url();?>admin/login/resend_otp",
        type: "POST",
        dataType: "json",
            data: { 
               'is_used_for':is_used_for,
        // Your other data
        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
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

</body>
</html>