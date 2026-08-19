<!DOCTYPE html>
<html>
   <head>
      <base href="<?php echo base_url(); ?>admin/" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Sign Up</title>
      <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>login/css/bootstrap.css">
      <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>login/css/style.css">
      <link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('theme_uri');?>login/fonts/font-awesome/css/font-awesome.css">
      <script src="<?php echo $this->config->item('theme_uri');?>sha256.js"></script>
      <script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
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
           display: inline-block;
           width: 64%;
           margin-bottom: 2px;
           border: 1px solid #6c6c6c;
           background: transparent;
           height: 55px;
           position: relative;
           font-size: 14px;
           margin-left: 11px;
           border-radius: 8px;
           color: #373737;
        }
        .sign_up_btn {
           margin-top: 20px;
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
        .login-sec-heading {
           font-size: 40px;
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
        .text-danger {
           margin-top: -9px;
        }
        .is-invalid {
           color: #dc3545;
           border-color: #dc3545;
           padding-right: 2.25rem!important;
        }
        select.is-invalid {
           color: #373737;
        }
        input.is-invalid {
           color: #373737;
        }
        .invalid-feedback {
             display: none;
             width: 100%;
             margin-top: 0.25rem;
             font-size: 100%;
             color: #dc3545;
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
</section>  -->
<!--header end-->
<!--login start-->
<section class="login">
    <!-- <div class="login-img">
      <img src="<?php echo $this->config->item('theme_uri');?>login/image/website-admin-background.jpg" class="img-responsive" alt="">
   </div> --> 
   <div class="login-sec">
      <h2 class="login-sec-heading">Update Your CMRTS Account</h2>
      <p style="text-align: center;color: red;">( All fields are mandatory )</p>
      <?php echo (isset($error_message)) ? $error_message : "";?>
      <?php echo form_open('admin/user_creation/Register',array('class' => 'register_form','name' => 'register_form', 'id' => 'register_form','autocomplete'=>'off')); ?>
      <?php
      $stake_holder_login_id = (!empty($log_fetch_data))?$log_fetch_data[0]['stake_holder_login_id_pk']:set_value('stake_holder_login_id_pk');
      ?>
      <input type="hidden" name="stake_holder_login_id_pk" value="<?php echo $stake_holder_login_id; ?>">
      <?php
      $user_full_name = (!empty($log_fetch_data))?$log_fetch_data[0]['name']:'';
      // print_r($user_full_name);die;
      $name = explode(" ", $user_full_name);
      $f_name = $name[0];
      $l_name = (count($name) > 1)?$name[1]:'';
      ?>
      <div class="form-group">
         <input type="text" name="first_name" id="first_name" class="custom_login_box" placeholder="First Name" value="<?php if(empty($f_name)){?><?php echo set_value('first_name'); ?><?php }else{ echo $f_name; } ?>" >
         <?php echo form_error('first_name'); ?>
      </div>
      <div class="form-group">
         <input type="text" name="last_name" id="last_name" class="custom_login_box" placeholder="Last Name" value="<?php if(empty($l_name)){?><?php echo set_value('last_name'); ?><?php }else{ echo $l_name; } ?>" >
         <?php echo form_error('last_name'); ?>
      </div>
      <?php
      $mobile_no = (!empty($log_fetch_data))?$log_fetch_data[0]['mobile_no']:set_value('mobile_no');
      ?>
      <div class="form-group">
         <input type="text" name="mobile_no" id="mobile_no" class="custom_login_box js-input-mobile" placeholder="Mobile Number" maxlength="10" value="<?php echo $mobile_no; ?>" onkeyup="number_validation()">
         <?php echo form_error('mobile_no'); ?>
         <?php echo (isset($mobile_error_message)) ? $mobile_error_message : "";?>
      </div>
      <?php
      $designation = (!empty($log_fetch_data))?$log_fetch_data[0]['stake_details']:set_value('designation');
      $stake_id = (!empty($log_fetch_data))?$log_fetch_data[0]['stake_id_fk']:set_value('stake_id');
      ?>
      <div class="form-group">
         <input type="hidden" name="stake_id" value="<?php echo $stake_id; ?>">
         <input type="text" name="designation" id="designation" class="custom_login_box" value="<?php echo $designation; ?>" readonly style="cursor: not-allowed;background: #dddddd;">
         <?php echo form_error('designation'); ?>
      </div>
      <?php
      $district_name = (!empty($log_fetch_data))?$log_fetch_data[0]['district_name']:set_value('district');
      $district_id = (!empty($log_fetch_data))?$log_fetch_data[0]['district']:set_value('block_hidden_id');
      ?>
      <div class="form-group">
         <input type="hidden" name="district_id_fk" value="<?php echo $district_id; ?>">
         <input type="text" name="district" id="district" class="custom_login_box" value="<?php echo $district_name; ?>" readonly style="cursor: not-allowed;background: #dddddd;">
         <?php echo form_error('district'); ?>
      </div>
      <?php
      $block_name = (!empty($log_fetch_data[0]['block_name']))?$log_fetch_data[0]['block_name']:set_value('block');
      $block_id = (!empty($log_fetch_data))?$log_fetch_data[0]['block']:set_value('block_hidden_id');
      if(!empty($block_name)){
      ?>
      <div class="form-group">
         <input type="hidden" name="block_id_fk" value="<?php echo $block_id; ?>">
         <input type="text" name="block" id="block" class="custom_login_box" value="<?php echo $block_name; ?>" readonly style="cursor: not-allowed;background: #dddddd;">
         <?php echo form_error('block'); ?>
      </div>
      <?php } ?>
      <?php
      $email_id = (!empty($log_fetch_data))?$log_fetch_data[0]['login_email']:set_value('email_id');
      ?>
      <div class="form-group">
         <input type="text" name="email_id" id="email_id" class="custom_login_box" placeholder="E-MAIL ID" value="<?php echo $email_id; ?>">
         <?php echo form_error('email_id'); ?>
      </div>
      <?php
      $username = (!empty($log_fetch_data))?$log_fetch_data[0]['login_id']:set_value('username');
      ?>
      <div class="form-group">
          <input type="text" name="username" id="username" class="custom_login_box" placeholder="Username" value="<?php echo $username; ?>" readonly style="cursor: not-allowed;background: #dddddd;">
         <?php echo form_error('username'); ?>
      </div>
      <div class="form-group">
         <input type="password" name="password" id="password" class="custom_login_box" placeholder="Password" onkeyup="return checkPassword(this.value);">
         <?php echo form_error('password'); ?>
      </div>
      <div class="form-group">
         <input type="password" name="retype_password" id="retype_password" class="custom_login_box" placeholder="Re-type Password">
         <?php echo form_error('retype_password'); ?>
         <span id="con_pass" style="color: red;"></span>
      </div>
      <!-- <div class="form-group">
         <input type="checkbox" id="showPassword" />
         <label for="showPassword">Show password</label>
      </div> -->
      <div class="form-group">
         <div id="passwordStrength" class=""></div>
      </div>
      <div class="login_btn_sec">
         <button type="submit" class="button login_btn" id="Submit">Update</button>
         <!-- <a href="<?php echo base_url()?>admin" class="sign_up_btn">Sign In</a> -->
      </div>
      <p style="color: #AE0000;">Rules:- <br>
         <span><i class="fa fa-exclamation-triangle"> Please note the following:-</i></span><br><span><i class="fa fa-hand-o-right"> Be between 8 to 15 characters in length.</i></span>
         <br>
         <span><i class="fa fa-hand-o-right"> Contain at least 1 capital letter, 1 small letter, 1 number and one special character.</i></span>
      </p>
    </div>
   <div class="clearfix"></div>
</section>
<!--login end-->
<!--footer start-->
<div class="footer" style="margin-top: 193px;">
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
<!-- <script src="<?php// echo $this->config->item('theme_uri');?>login/js/main.js"></script> -->
<script src="<?php echo $this->config->item('theme_uri');?>login/register_validation.js"></script>
<script src="<?php echo $this->config->item('theme_uri');?>login/js/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).on('click','#block',function(){
   if($( "#district option:selected" ).val()!="")
   {
      var id=$('#district').val()
      $.ajax({
          url:'<?php echo base_url()?>admin/Register/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             $('#block').html('');
             console.log(data.length);
             if(data.length==1){
               $('#block').append('<option value="">Please Select SD/Block</option>');
             }
             data.forEach(element =>$("#block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v=$( "#block option:selected" ).val();
          }
      });
   }
});

$(document).on('change','#district',function(){
   $('#block').html('');
   if($('#block').val()!=""){
       $('#block').append('<option value="">Please Select SD/Block</option>');
   }
});

$(document).on('change','#district',function(){
   var designation = $('#designation').val();
   if(designation ==null){
       $('#Submit').attr('disabled',true);
       $('.form_error_district').html('Please select designation first.');
       $('#district').val($('#district option:first').val()).attr('selected', true);
   }else{
       $('.form_error_district').html('').show();
       $('#Submit').attr('disabled',false);
   }
});
</script>
<script type="text/javascript">
$( "#register_form" ).validate({
  rules: {
   first_name: {
      required: true
    },
    last_name: {
      required: true
    },
    mobile_no: {
      required: true,
      minlength:10,
      maxlength:10
    },
    designation: {
      required: true
    },
    district: {
      required: true
    },
    block: {
      required: true
    },
    email_id: {
      required: true,
      email: true
    },
    username: {
      required: true
    },
    password: {
      required: true,
      minlength: 8,
      maxlength: 15
    },
    retype_password: {
      required: true,
      equalTo: "#password"
    }
  },
  messages : {
     first_name: {
       required: "First name field is required"
     },
     last_name: {
       required: "Last name field is required"
     },
     mobile_no: {
       required: "Mobile number field is required",
       minlength: "Enter at least 10 characters",
       maxlength: "Enter no more than 10 characters"
     },
     designation: {
       required: "Designation field is required"
     },
     district: {
       required: "District field is required"
     },
     block: {
       required: "SD/Block field is required"
     },
     email_id: {
      required: "E-Mail ID field is required",
      email: "Enter a valid email address"
     },
     username: {
       required: "Username field is required"
     },
     password: {
       required: "Password field is required",
       minlength: "Your password should be between 8 to 15 characters in length",
       maxlength: "Your password should be between 8 to 15 characters in length",
     },
     retype_password: {
       required: "Re-type password field is required",
       equalTo: "Both passwords are not identical"
     },
  },
  errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
});
</script>
<script type="text/javascript">
document.getElementById('showPassword').onclick = function() {
    if ( this.checked ) {
       document.getElementById('password').type = "text";
       document.getElementById('retype_password').type = "text";
    } else {
       document.getElementById('password').type = "password";
       document.getElementById('retype_password').type = "password";
    }
};
</script>
<script type="text/javascript">
function number_validation() {
  var input = document.getElementById('mobile_no');
  var pattern = /^[6-9][0-9]{0,9}$/;
  var value = input.value;
  !pattern.test(value) && (input.value = value = '');
  input.addEventListener('input', function() {
     var currentValue = this.value;
     if(currentValue && !pattern.test(currentValue)) this.value = value;
     else value = currentValue;
  });
};
</script>
</body>
</html>