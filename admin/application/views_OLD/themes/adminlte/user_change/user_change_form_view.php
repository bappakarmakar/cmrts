<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
/*   input[type="radio"] {
   cursor: not-allowed;
   }*/
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
   .ttext {
   text-align: left !important;
   }
   .action_menu {
   box-shadow: none;
   border-color: #12386e;
   background: #12386e;
   }
   .dropdown-menu>li>a {
   display: block;
   padding: 3px 12px;
   clear: both;
   font-weight: 400;
   line-height: 1.42857143;
   color: #fff;
   white-space: nowrap;
   }
   .btn-action {
   color: #fff;
   background-color: #12386e;
   border-color: #12386e;
   }
   .btn-action:hover {
   color: #fff;
   }
   .count_one {
   width: 22.5%;
   display: inline-block;
   border-radius: 6px;
   background: #00ccff;
   padding: 20px 10px;
   margin: 0 12px;
   vertical-align: middle;
   }
   .count_two {
   width: 22.5%;
   display: inline-block;
   border-radius: 6px;
   background: #339933;
   padding: 20px 10px;
   margin: 0 12px;
   vertical-align: middle;
   }
   .count_three {
   width: 22.5%;
   display: inline-block;
   border-radius: 6px;
   background: #e6b800;
   padding: 7px 10px;
   margin: 0 12px;
   vertical-align: middle;
   }
   .count_four {
   width: 22.5%;
   display: inline-block;
   border-radius: 6px;
   background: #dd4b39;
   padding: 20px 10px;
   margin: 0 12px;
   vertical-align: middle;
   }
   .count_content .title {
   font-size: 17px;
   font-weight: normal;
   display: block;
   }
   th {
   font-size: 12px;
   }
   td {
   font-size: 13px;
   }
   .modal_table {
   background: #339933;
   color: #FFFFFF;
   }
   .modal_incident {
   background: #085876;
   color: #fff;
   }
   .dataTables_length {
   display: block;
   max-width: 100%;
   margin-bottom: 5px;
   font-weight: 700;
   }
   .table {
   display: table;
   border-collapse: collapse;
   }
   .table .tr {
   display: table-row;
   border: 1px solid #ddd;
   }
   .table .tr:nth-child(even) {
   background-color: #f9f9f9;
   }
   .table .tr .td {
   display: table-cell;
   padding: 8px;
   border-left: 1px solid #ddd;
   }
   .table .tr .td:first-child {
   border-left: 0;
   }
   .div-table .title,
   .table-tag .title {
   text-align: center;
   padding-bottom: 0.5em;
   font-size: 20px;
   font-weight: bold;
   }
   .datepicker {
   background: #fff;
   }
   .error {
   color: #a94442;
   }
   .fa-arrow-down {
   margin-left: 430px;
   }
   .custom-modal-header {
   background: #12386e;
   }
   .close {
   border-radius: 50px;
   background: #ffffff !important;
   width: 28px;
   height: 27px;
   color: red;
   }
   .label-div
   {
   display: flex;
   justify-content: end;
   }
   .inp
   {
   width: 24%;
   margin-left: 10px;
   }
   .otp-input-fields
   {
   display: flex;
   }
   .otp-input-fields input[type=number]
   {
   width: 20%;
   background-color: #0000000d;
   margin-right: 5px;
   outline: none;
   border: none;
   }
   .otp-input-fields {
   background-color: white;
   width: auto;
   display: flex;
   justify-content: center;
   gap: 10px;
   }
   .otp-input-fields input {
   height: 34px;
   width: 40px;
   background-color: transparent;
   border-radius: 0px;
   border: 1px solid #0b1b52;
   text-align: center;
   outline: none;
   font-size: 16px;
   border: 1px solid #ccc!important;
   }
   .otp-input-fields input::-webkit-outer-spin-button, .otp-input-fields input::-webkit-inner-spin-button {
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
   }
   .des-loc
   {
   display: flex;
   flex-wrap: wrap;
   }
   .inp-radio
   {
   width: 28%;
   }
   .inp-inf
   {
   float: right;
   }
   .left-form
   {
   position: relative;
   }
   .Information_Received
   {
   position: absolute;
   right: 75px;
   top:0;
   text-align: right;
   }
   .Information_Received h5 
   {
   text-align: right;
   }
   #box-table
  {
  max-height: 360px;
  scrollbar-color: #3c8dbc8a #d9d9d9;
  scrollbar-width: thin;
  }
  .error{
   color: red;
   float: left;
  }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>User Change Request form</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <?php if($this->session->flashdata('success') != "")
         { 
            ?>
            <p class="text-success text-center" style="font-size:18px;"><?php echo $this->session->flashdata('success'); ?></p>
            <?php 
         } 
          else if($this->session->flashdata('error') != "") 
         {
            ?>
            <p class="text-error error text-center" style="font-size:18px;"><?php echo $this->session->flashdata('error'); ?></p>
            <?php 
         }
         ?>
         <?php echo form_open('admin/user_change/user_change', array('class' => 'user_change_form','name' => 'user_change_form', 'id' => 'user_change_form')) ?>
         <div class="box-body">
            <div class="card-body" style="text-align:center;">
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">First Name<font color="red"> *</font></label>
                 <div class="col-sm-6">
                   <input type="text" name="first_name" id="first_name" class="form-control" autocomplete="off" placeholder="First Name" value="<?php echo set_value('first_name')?>">
                   <?php echo form_error('first_name');?>
                 </div>
                    <span class="error" id="first_name"></span>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">Last Name<font color="red"> *</font></label>
                 <div class="col-sm-6">
                   <input type="text" name="last_name" id="last_name" class="form-control" autocomplete="off" placeholder="Last Name" value="<?php echo set_value('last_name')?>">
                   <?php echo form_error('last_name');?>
                 </div>
                    <span class="error" id="last_name"></span>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">Mobile No<font color="red"> *</font></label>
                 <div class="col-sm-6">
                   <input type="text" name="mobile_no" id="mobile_no" class="form-control" oninput="mobile_no_validation(this)" autocomplete="off" placeholder="Mobile No" maxlength="10" value="<?php echo set_value('mobile_no')?>">
                   <?php echo form_error('mobile_no');?>
                 </div>
                    <span class="error" id="mobile_no"></span>
               </div>
                <div class="form-group row">
                 <label class="col-sm-2 col-form-label">Email Id</label>
                 <div class="col-sm-6">
                   <input type="text" name="email_id" id="email_id" class="form-control" autocomplete="off" placeholder="Email Id" value="<?php echo set_value('email_id')?>">
                   <?php echo form_error('email_id');?>
                 </div>
                    <span class="error" id="email_id"></span>
               </div>
               <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="reason">Reason For Change<font color="red"> *</font><span ><br>(Max 100 characters)</span></label>
                  <div class="col-sm-6">
                     <textarea name="reason" id="reason" class="form-control" autocomplete="off" placeholder="Reason For Change" maxlength="100"><?php echo set_value('reason'); ?></textarea>
                     <?php echo form_error('reason'); ?>
                  </div>
                     <span class="error" id="reason-error"></span>
               </div>

               
            </div>
             <div class="col-sm-2">
              
            </div>
             <div class="col-sm-4">
            <!-- <button type="cancel" class="btn btn-danger" name="cancel" value="cancel"><i class="fa fa-paper-plane" aria-hidden="true"></i> cancel</button> -->
            <button type="button" class="btn btn-danger" onclick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
             <button type="submit" class="btn btn-primary" name="submit" value="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Request</button>
            </div>
         </div>

          <!-- <div class="box bottom-box row" style="text-align: center;"> -->
            <!-- <br> -->
           
           
            <br>
         <!-- </div> -->

         <?php echo form_close(); ?>



        <!--  <div class="box-footer">
         </div> -->
      </div>
   </section>
</div>

      
</div>

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>


<script type="text/javascript">
function Cancel_Incident(){
   swal({
   title: "Cancel The Change Request",
   type: "warning",
   showCancelButton: true,
   confirmButtonClass: "btn-success",
   confirmButtonText: "Return to Change Request Form",
   cancelButtonClass: "btn-danger",
   cancelButtonText: "Cancel",
   closeOnConfirm: true,
   closeOnCancel: false
 },
 function(isConfirm){
   if(!isConfirm){
       setTimeout(function(){
          window.location.href = "<?php echo base_url()?>admin/user_change/user_change_list/user_change_list_self";
       }, 100);
   } 
 });
}

</script>


<script type="text/javascript">
    function mobile_no_validation(inputField) {
        let inputValue = inputField.value;

        // Clear any existing error messages
        // console.clear();

        if (inputValue.length === 0) {
            return; // No need to check if the input isempty
         }

        // Log ASCII values to the console
        for (let i = 0; i < inputValue.length; i++) {
            let char = inputValue.charAt(i);
            let asciiValue = char.charCodeAt(0);
            // console.log(`Character: ${char}, ASCII Value: ${asciiValue}`);

            if (i === 0 && (asciiValue < 54 || asciiValue > 57)) {
                // console.log("Invalid first digit. Must be between 6 and 9.");
                inputField.value = ''; // Clear the input field if the first digit is not between 6 and 9
                return;
            }

            if (i !== 0 && (asciiValue < 48 || asciiValue > 57)) {
                // console.log("Invalid non-first digit. Must be between 0 and 9.");
                inputField.value = ''; // Clear the input field if any non-first digit is not between 0 and 9
                return;
            }
        }

        // // Check if the total length is not 10
        // if (inputValue.length !== 10) {
        //     console.log("Invalid length. Must be 10 digits.");
        //     inputField.value = ''; // Clear the input field if the length is not 10
        //     return;
        // }
    }



</script>

<script type="text/javascript">
$(document).ready(function() {
    $("#user_change_form").validate({
        rules: {
            first_name: {
                required: true,
                lettersOnly: true
            },
            last_name: {
                required: true,
                lettersOnly: true
            },
            mobile_no: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10,
                mobileNumber: true // Custom rule for mobile number validation
            },
            email_id: {
                required: false,
                email: true 
            },
            reason: {
                required: true
                
            }
        },
        messages: {
            first_name: {
                required: "Please enter your first name.",
                lettersOnly: "First name should only contain letters."
            },
            last_name: {
                required: "Please enter your last name.",
                lettersOnly: "Last name should only contain letters."
            },
            mobile_no: {
                required: "Please enter your mobile number.",
                digits: "Mobile number should only contain digits.",
                minlength: "Mobile number must be exactly 10 digits.",
                maxlength: "Mobile number must be exactly 10 digits."
            },
            email_id: {
                email: "Please enter a valid email address."
            },
            reason: {
                required: "Please enter your reason for change."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    // Custom method to validate letters only (no special characters or digits)
    $.validator.addMethod("lettersOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
    }, "Please enter only letters.");

    // Custom method for mobile number validation
    $.validator.addMethod("mobileNumber", function(value, element) {
        // Check if the value is numeric and starts with 6, 7, 8, or 9
        return this.optional(element) || /^([6-9])[0-9]{9}$/.test(value);
    }, "Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.");
});
</script>

