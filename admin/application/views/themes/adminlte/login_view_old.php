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
      //alert(sha256(''))
      function encription() {
         if (document.login_form.password.value != '') {
         	var enc2 = sha256(sha256(document.login_form.password.value) + '<?php echo $_SESSION['salt']; ?>') ;
         	document.login_form.password.value = enc2;
         }
      }
      </script>
      <style type="text/css">
      .login-sec {
		    width: 45%;
          float: left;
          margin-top: 75px;
          margin-left: 28%;
          border: 1px solid #FFFFFF;
          background: #FFFFFF;
          padding: 14px;
          border-radius: 10px;
          margin-bottom: 100px;
		}
		.login_btn {
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
      input {
         margin: 0px !important;
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
<section class="login">
   <!-- <div class="login-img">
      <img src="<?php //echo $this->config->item('theme_uri');?>login/image/login-img.png" class="img-responsive" alt="">
   </div> -->
   	<div class="login-sec">
      <h2 class="login-sec-heading">CMRTS Online 1.0</h2>
      <?php if($this->session->flashdata('success') != ""){ ?>
         <p class="text-success text-center" style="font-size:18px;"><?php echo $this->session->flashdata('success'); ?></p>
      <?php } ?>
      <?php echo (isset($error_message)) ? $error_message : "";?>
      <?php echo form_open('admin/',array('class' => 'login_form','name' => 'login_form', 'id' => 'login_form','autocomplete'=>'off','onsubmit'=>'return encription()')); ?>
      <input type="hidden" class="security_code" name="security_code" value="<?php echo hash('sha256',strtoupper($cap['word']).$this->config->item('encryption_key')) ?>">
      <div class="row">
         <div class="col-sm-12">
            <div class="form-group">
               <div class="userid_box">
                  <input type="text" name="login_id" id="login_id" class="custom_login_box" placeholder="Username" value="<?php echo set_value('login_id'); ?>">
                  <?php echo form_error('login_id'); ?>
                  <?php echo (isset($user_error_message)) ? $user_error_message : "";?>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group">
               <div class="password_box">
                  <input type="password" class="custom_login_box" name="password" id="password" placeholder="Password">
                  <?php echo form_error('password'); ?>
                  <?php echo (isset($password_error_message)) ? $password_error_message : "";?>
               </div>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="form-group">
               <div class="login_captcha">
                   <div class="captcha_img" style="border: 0px solid;padding: 0;">
                      <?php echo $cap['image']; ?>
                   </div>
                   <em><i class="fa fa-refresh" aria-hidden="true" id="loadCaptcha" style="margin-left: 30px;"></i></em>
               </div>
            </div>
         </div>
         <div class="col-sm-8">
            <div class="form-group">
               <div class="login_captcha">
                   <input type="text" class="custom_login_box" name="captcha" id="captcha" placeholder="Captcha">
                   <?php echo form_error('captcha'); ?>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group">
                <div class="login_btn_sec">
                  <button type="submit" class="button login_btn"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Sign In</button>
                  <a href="<?php echo base_url()?>admin/forgot_password" class="forgot_password_btn" style="float: left;">Forgot Password?</a>
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
<script type="text/javascript">
$( "#login_form" ).validate({
  rules: {
   login_id: {
      required: true
    },
    password: {
      required: true
    },
    captcha: {
      required: true,
      minlength: 5,
      maxlength: 5
    }
  },
  messages : {
     login_id: {
       required: "Enter username"
     },
     password: {
       required: "Enter password"
     },
     captcha: {
       required: "Enter captcha"
     },
  },
});
</script>
</body>
</html>