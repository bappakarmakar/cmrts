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
      <p style="font-size: 16px;text-align: center;">Forgot Password</p>
      <?php $this->load->view('errors/message'); ?>
      <?php echo form_open('admin/forgot_password/',array('class' => 'forgot_password_form','name' => 'forgot_password_form', 'id' => 'forgot_password_form','autocomplete'=>'off')); ?>
      <div class="row">
         <div class="col-sm-12">
            <div class="form-group">
               <div class="userid_box">
                  <!-- <input type="text" name="user_name" id="user_name" class="custom_login_box" placeholder="Enter Username" value="<?php echo set_value('user_name'); ?>"> -->
                  <input type="text" name="user_name" id="user_name" class="custom_login_box" placeholder="Enter Username" value="">
                  <?php echo form_error('user_name'); ?>
                  <?php echo (isset($username_error_message)) ? $username_error_message : "";?>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group">
                <div class="login_btn_sec">
                  <button type="submit" class="button login_btn">Generate OTP</button>
                  <a href="<?php echo base_url()?>admin" class="sign_up_btn" style="float: left;">Go Back</a>
                </div>
            </div>
         </div>
      </div>
    </div>
   <div class="clearfix"></div>
</section>
<!--login end-->
<!--footer start-->
<div class="footer" style="margin-top: 231px;">
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
$( "#forgot_password_form" ).validate({
  rules: {
   user_name: {
      required: true
    }
  },
  messages : {
     user_name: {
       required: "Enter username"
     },
  },
});
</script>
</body>
</html>