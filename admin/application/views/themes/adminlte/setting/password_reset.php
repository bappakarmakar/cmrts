<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
   .star {
   color: red;
   font-size: 14px;
   }
   .mtop20 {
   margin-top: 20px;
   }
   .mbottom20 {
   margin-bottom: 20px;
   }
   .mright20 {
   margin-right: 20px;
   }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Password Reset</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <?php echo form_open('admin/setting/change_password',array('class' => 'change_password_form','name' => 'change_password_form', 'id' => 'change_password_form',"enctype"=> "multipart/form-data")) ?>
      <!-- Default box -->
      <div class="box box-success">
         <div class="box-header custom_box_header with-border">
            <h3 class="box-title" style="font-size: 20px; ">Change Password</h3>
         </div>
         <div class="box-body">
            <div class="col-md-6">
               <div class="box-body">
                  <!-- text input -->
                  <div class="col-sm-12">
                    <label for="exampleInputPassword1">Current password <sup style="color: #FF0000">*</sup></label>
                     <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password"  autocomplete="off" value="<?php echo set_value('current_password')?>">
                     <?php echo form_error('current_password'); ?>
                  </div>
               </div>
               <div class="box-body">
                  <div class="col-sm-12">
                    <label for="exampleInputPassword1">New Password <sup style="color: #FF0000">*</sup></label>
                     <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password"  autocomplete="off">
                     <?php echo form_error('new_password'); ?>
                  </div>
               </div>
               <div class="box-body">
                  <div class="col-sm-12">
                    <label for="exampleInputPassword1">Confirm New Password <sup style="color: #FF0000">*</sup></label>
                     <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password"  autocomplete="off">
                     <?php echo form_error('confirm_password'); ?>
                     <!-- <span id="confirm_pwd" class="help-block" style="color: #a94442;">The passwords entered do not match</span> -->
                  </div>
               </div>
               <div class="box-body">
                  <div class="col-sm-12">
                    <button type="submit" id="Change_Pass" style="text-align: center;margin: 15px 0; background: #12386e;border: 1px solid #12386e;" class="btn btn-info">Save Changes</button>
                    <button type="button" id="Cancel_Change_Pass" onClick="Cancel_Password_Reset()" style="text-align: center;margin: 15px 0;" class="btn btn-danger">Cancel Changes</button>
                  </div>
               </div>
            </div>
            <!-- text input -->
            <div class="col-md-6">
               <div class="box-body">
                  <div class="col-sm-12">
                     <div class="password_policy">
                        <h3 style="font-weight: 600; font-family: Comic Sans MS, cursive, sans-serif; color: #d90026"><u>Password Policy</u></h3>
                        <p class="password_special" style="font-family: Comic Sans MS, cursive, sans-serif; font-size: 13px; color: darkblue;"  >Password must contain a minimum of 1 special character: ! @ # $ % &   <img src="themes/adminlte/dist/img/icon_remove.png" class="wrong">
                           <img src="themes/adminlte/dist/img/right-sign.png" class="correct">
                        </p>
                        <p class="password_upper" style="font-family: Comic Sans MS, cursive, sans-serif; font-size: 13px; color: darkblue;" >Password must contain a minimum of 1 upper case letter [A-Z]
                           <img src="themes/adminlte/dist/img/icon_remove.png" class="wrong">
                           <img src="themes/adminlte/dist/img/right-sign.png" class="correct">
                        </p>
                        <p class="password_lower" style="font-family: Comic Sans MS, cursive, sans-serif; font-size: 13px; color: darkblue;" >Password must contain a minimum of 1 lower case letter [a-z]
                           <img src="themes/adminlte/dist/img/icon_remove.png" class="wrong">
                           <img src="themes/adminlte/dist/img/right-sign.png" class="correct">
                        </p>
                        <p class="password_number" style="font-family: Comic Sans MS, cursive, sans-serif; font-size: 13px; color: darkblue;" >Password must contain a minimum of 1 numeric character [0-9]
                           <img src="themes/adminlte/dist/img/icon_remove.png" class="wrong">
                           <img src="themes/adminlte/dist/img/right-sign.png" class="correct">
                        </p>
                        <p class="password_length" style="font-family: Comic Sans MS, cursive, sans-serif; font-size: 13px; color: darkblue;" >Password should be between 8 to 15 characters in length
                           <img src="themes/adminlte/dist/img/icon_remove.png" class="wrong">
                           <img src="themes/adminlte/dist/img/right-sign.png" class="correct">
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Modal -->
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
   jQuery( document ).ready(function() {
       jQuery(".wrong").hide();
       jQuery(".correct").hide();
       // jQuery("#confirm_pwd").hide();
   });
   jQuery( "#new_password" ).keyup(function() {
       var password=jQuery( "#new_password" ).val();
   
   
       if (password.length >= 8)
       {
           jQuery(".password_length .wrong").hide('slow');
           jQuery(".password_length .correct").show('slow');
       }
       else
       {
           jQuery(".password_length .correct").hide('slow');
           jQuery(".password_length .wrong").show('slow');
       }
   
       //if password has both lower and uppercase characters give 1 point
       if (( password.match(/[A-Z]/) ) )
       {
   
           jQuery(".password_upper .wrong").hide('slow');
           jQuery(".password_upper .correct").show('slow');
       }
       else
       {
           jQuery(".password_upper .correct").hide('slow');
           jQuery(".password_upper .wrong").show('slow');
       }
       if (( password.match(/[a-z]/) ) )
       {
   
           jQuery(".password_lower .wrong").hide('slow');
           jQuery(".password_lower .correct").show('slow');
       }
       else
       {
           jQuery(".password_lower .correct").hide('slow');
           jQuery(".password_lower .wrong").show('slow');
       }
   
       //if password has at least one number give 1 point
       if (password.match(/\d+/))
       {
   
           jQuery(".password_number .wrong").hide('slow');
           jQuery(".password_number .correct").show('slow');
       }
       else
       {
           jQuery(".password_number .correct").hide('slow');
           jQuery(".password_number .wrong").show('slow');
       }
   
       //if password has at least one special caracther give 1 point
       if (password.match(/[.*~!@#$%&]/))
       {
           jQuery(".password_special .wrong").hide('slow');
           jQuery(".password_special .correct").show('slow');
       }
       else
       {
           jQuery(".password_special .correct").hide('slow');
           jQuery(".password_special .wrong").show('slow');
       }
   
   });
   
   // jQuery("#confirm_password").keyup(function() {
   //     var password = jQuery("#new_password").val();
   //     var confirm_password = jQuery("#confirm_password").val();
   //     if(password != confirm_password){
   //         jQuery("#confirm_pwd").show();
   //         $('#Change_Pass').attr('disabled',true);
   //         $('#confirm_password').css('borderColor','red');
   //     }else{
   //         jQuery("#confirm_pwd").hide();
   //         $('#Change_Pass').attr('disabled',false);
   //         $('#confirm_password').css('borderColor','#d2d6de');
   //     }
   // });
</script>
<script type="text/javascript">
function Cancel_Password_Reset(){
   swal({
   title: "Are you sure?",
   type: "warning",
   showCancelButton: true,
   confirmButtonClass: "btn-success",
   confirmButtonText: "Yes",
   cancelButtonClass: "btn-danger",
   cancelButtonText: "No",
   closeOnConfirm: true,
   closeOnCancel: false
 },
 function(isConfirm){
   if(isConfirm){
       setTimeout(function(){
          window.location.href = "<?php echo base_url()?>admin/dashboard";
       }, 100);
   }else{
      swal.close();
   } 
 });
}
</script>