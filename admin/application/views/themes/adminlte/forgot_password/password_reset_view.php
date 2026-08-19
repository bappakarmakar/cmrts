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
      .password_box:before {
          content: '\f023';
          font-family: FontAwesome;
          position: absolute;
          top: 12px;
          left: 14px;
          font-size: 20px;
          color: #ea1e63;
      }
      .strength0{
           padding: 6px;
           width:40%;
           background:#ff0000;
           color:#FFFFFF;
           border-radius: 6px;
           font-size: 16px;
        }
        .strength1{
           padding: 6px;
           width:50%;
           background:#ff0000;
           color:#FFFFFF;
           border-radius: 6px;
           font-size: 16px;
        }
        .strength2{
           padding: 6px;
           width:60%;
           background:#ff5f5f;
           color:#FFFFFF;
           border-radius: 6px;
           font-size: 16px;
        }
        .strength3{
           padding: 6px;
           width:70%;
           background:orange;
           color:#FFFFFF;
           border-radius: 6px;
           font-size: 16px;
        }
        .strength4{
           padding: 6px;
           background:#4dcd00;
           width:90%;
           color:#FFFFFF;
           border-radius: 6px;
           font-size: 16px;
        }
        .strength5 {
           padding: 6px;
           background: #399800;
           width: 100%;
           color: #FFFFFF;
           border-radius: 6px;
           font-size: 16px;
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
      <p style="font-size: 16px;text-align: center;">Enter New Password</p>
      <?php $this->load->view('errors/message'); ?>
      <?php
      $last = $this->uri->total_segments();
      $third_num = $this->uri->segment(3);
      $record_num = $this->uri->segment($last);
      ?>
      <!-- <?php //echo form_open('admin/forgot_password/password_reset/'.$third_num.'/'.$record_num,array('class' => 'password_reset_form','name' => 'password_reset_form', 'id' => 'password_reset_form','autocomplete'=>'off')); ?> -->
      <?php echo form_open('admin/forgot_password/password_reset',array('class' => 'password_reset_form','name' => 'password_reset_form', 'id' => 'password_reset_form','autocomplete'=>'off')); ?>
      <div class="row">
         <div class="col-sm-12">
            <div class="form-group">
               <div class="password_box">
                  <input type="password" class="custom_login_box" name="new_password" id="new_password" placeholder="New Password" value="<?php echo set_value('new_password'); ?>" onkeyup="return checkPassword(this.value);">
                  <?php echo form_error('new_password'); ?>
                  <?php echo (isset($password_error_message)) ? $password_error_message : "";?>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group">
               <div class="password_box">
                  <input type="password" class="custom_login_box" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?php echo set_value('confirm_password'); ?>">
                  <?php echo form_error('confirm_password'); ?>
                  <?php echo (isset($password_error_message)) ? $password_error_message : "";?>
               </div>
            </div>
         </div>
         <div class="col-sm-12">
            <div class="form-group">
               <div id="passwordStrength" class=""></div>
            </div>
            <div class="form-group">
                <div class="login_btn_sec">
                  <button type="submit" class="button login_btn">Continue</button>
                  <a href="<?php echo base_url()?>admin" class="sign_up_btn" style="float: left;">Go Back</a>
                </div>
            </div>
         </div>
         <div class="col-sm-12">
            <p style="color: #AE0000;">Rules:- <br>
               <span><i class="fa fa-exclamation-triangle"> Please note the following:-</i></span><br><span><i class="fa fa-hand-o-right"> Be between 8 to 15 characters in length.</i></span>
               <br>
               <span><i class="fa fa-hand-o-right"> Contain at least 1 capital letter, 1 small letter, 1 number and one special character.</i></span>
            </p>
         </div>
      </div>
    </div>
   <div class="clearfix"></div>
</section>
<!--login end-->
<!--footer start-->
<div class="footer" style="margin-top: 70px;">
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
<script src="<?php echo $this->config->item('theme_uri');?>login/register_validation.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>login/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$( "#password_reset_form" ).validate({
  rules: {
   new_password: {
      required: true,
      minlength: 8,
      maxlength: 15
    },
    confirm_password: {
      required: true,
      equalTo: "#new_password"
    }
  },
  messages : {
     new_password: {
       required: "New password field is required",
       minlength: "Your password should be between 8 to 15 characters in length",
       maxlength: "Your password should be between 8 to 15 characters in length",
     },
     confirm_password: {
       required: "Confirm password field is required",
       equalTo: "Both passwords are not identical"
     },
  },
});
</script>
</body>
</html>