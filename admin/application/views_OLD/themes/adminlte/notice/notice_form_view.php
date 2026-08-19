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

.select2-selection__choice__display
{
  color: #000;
 
}
.select2
{
  width: 100%!important;
}
.select2-container
{
   display: block;
}
.selection
{
  text-align: left!important;
}

</style>


<div class="content-wrapper">
   <section class="content-header">
      <h1>Outbox</h1>
     <!--  <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol> -->
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
         <?php echo form_open('admin/notice/notice', array('class' => 'user_change_form','name' => 'user_change_form', 'id' => 'user_change_form')) ?>
         <div class="box-body">
            <div class="card-body" style="text-align:center;">
               <div class="form-group row">

                  <label class="col-sm-2 col-form-label" for="reason" style="text-align: left;"> Message Title<font color="red"> *</font></label>
                  <div class="col-sm-6">
                    <input type="text" name="title" id="title" class="form-control" autocomplete="off" placeholder="Message Title" maxlength="60"  value="<?php echo set_value('title'); ?>">
                    <?php echo form_error('title'); ?>
                  </div>
                  <span class="error" id="title-error"></span>
               </div>

               <div class="form-group row">
                  <label class="col-sm-2 col-form-label" for="reason" style="text-align: left;">Message<font color="red"> *</font><span style="font-size: 10px;color: green"><br>(Max 300 characters)</span></label>
                  <div class="col-sm-6">
                     <textarea name="description" id="description" class="form-control" autocomplete="off" placeholder="Message" maxlength="300" style="height: 125px;"><?php echo set_value('description'); ?></textarea>
                     <?php echo form_error('description'); ?>
                  </div>
                  <span class="error" id="description-error"></span>
               </div>
               
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label" style="text-align: left;">Target Users <font color="red"> *</font></label>
                  <div class="col-sm-6">
                  <?php
                    $selected='';
                    if(set_value('user')){
                       $selected=set_value('user', []);
                    }
                  ?>
                  
                    <select class="form-control js-example-basic-multiple" name="user_id[]" id="user_id"  multiple="multiple" style="cursor: not-allowed;width: 300px;">
                      
                        <?php foreach($user as $value){ ?>

                          <?php //if($value['stake_id_pk']!=4){ ?>

                            <option value="<?php echo $value['stake_id_pk']; ?>" <?php echo set_select('user_id', $value['stake_id_pk'],$value['stake_id_pk']==$selected); ?> ><?php echo $value['stake_details']; ?>
                            </option>

                          <?php //} ?>
                        <?php } ?>

                            <!-- <option value="41">DEO (Urban areas)</option>
                            <option value="42">DEO (Rural areas)</option> -->

                    </select>
                    <?php echo form_error('user_id[]'); ?>
                  </div>
                    <span class="error" id="user_id"></span>
               </div>
               
            </div>

            <div class="col-sm-2"></div>

            <div class="col-sm-4">
              <button type="button" class="btn btn-danger" onclick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
              <button type="submit" class="btn btn-primary" name="submit" value="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
            </div>
         </div>
        
        <br>
         <!-- </div> -->
         <?php echo form_close(); ?>

      </div>
   </section>
</div>
   
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

<script>
  $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
      $(".js-example-basic-multiple").select2({
          placeholder: "--Select Target Users--",
          allowClear: true
      });
  });
</script>

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
          window.location.href = "<?php echo base_url()?>admin/dashboard";
       }, 100);
   } 
 });
}

$("#description").on("keydown", function (event) {
    // alert(event.key);
    if (event.key === "Enter") {
        // event.preventDefault(); // Prevent default action
        $(this).val($(this).val() + "\n"); // Manually add a new line
    }
});
</script>



