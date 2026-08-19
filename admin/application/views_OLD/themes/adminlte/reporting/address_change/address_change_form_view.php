<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/custom_left_menu_bar'); ?>
<?php
$cp_one_cwc_details = cp_one_cwc_details($incident_details[0]->incident_id_pk);
$cp_two_cwc_details = cp_two_cwc_details($incident_details[0]->incident_id_pk);
?>
<style>
   tr{
   background-color: #d9d9d9;
   }
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
   input.hidden {
   position: absolute;
   visibility: hidden;
   }
   input[type="radio"] + .show-when-checked {
   display: none;
   }
   input[type="radio"]:checked + .show-when-checked {
   display: block;
   }
   fieldset > .enable-when-valid {
   background-color : gray;
   }
   fieldset:valid > .enable-when-valid {
   background-color: white;
   }
   .previous_button {
   background: transparent;
   color: #99a2a8;
   border: 0 none;
   border-radius: 5px;
   cursor: pointer;
   min-width: 130px;
   font: 700 14px/40px "Roboto", sans-serif;
   border: 1px solid #99a2a8;
   margin: 0 5px;
   text-transform: uppercase;
   display: inline-block;
   /*float: right;*/
   margin-top: 25px; 
   margin-bottom: 30px;
   margin-right: 10px;
   }
   .btn-primary {
   margin-top: 24px; 
   margin-bottom: 30px;
   margin-right: 10px;
   }
   h2 {
   font-size: 21px !important;
   }
      .fixed-header {
    background-color: #fff !important;
    width: 81.9%;
    right: 0 !important;
    left: auto !important;
    top: 0 !important;
    box-shadow: 0px 2px 5px #0000002b;
}
.content-header {
    display: flex;
    position: fixed;
    top: 50px;
    z-index: 99;
    width: 100%;
    padding-left: 250px;
    right: 0;
    padding-bottom: 10px;
    background-color: #fff !important;
        background: transparent;
    box-shadow: 1px 2px 3px #0005;
   }
   .showSweetAlert h2 {
      font-size: 18px !important;
    }
    .showSweetAlert button {
      font-size: 14px !important;
    }
    .showSweetAlert {
      width: 50% !important;
    }
</style>
<?php //echo '<pre>';print_r($contracting_parties_details); ?>
<?php 
    $addressChangeMsg = ($contracting_parties_details->cp_type==1)?'Contracting Party One':'Contracting Party Two';
    $cp_id_pk = ($contracting_parties_details)?$contracting_parties_details->cp_id_pk:'';
    ?>
<?php echo form_open('admin/reporting/address_change/Address_change_form/'.base64_encode($cp_id_pk), array('class' => 'addressChangeForm','name' => 'addressChangeForm', 'id' => 'addressChangeForm')) ?>
  <input type="hidden" name="cp_id_pk" id="cp_id_pk" value="<?=base64_encode($cp_id_pk)?>">
<div class="content-wrapper">
   <section class="content-header"style="display:flex;justify-content: space-between;">
    
      <h1 style="width:33%">Address Change(<?=$addressChangeMsg?>)</h1>

    <div class="form-btn" style="width:33%">
               <ul style="display: flex;list-style: none;justify-content: start;padding: 0;margin: 0;">
                  <li style="margin-right: 5px;">
                     <button type="button" class="btn btn-danger" onclick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                  </li>
                  <li>
                     <button type="submit"onclick="" name="Sub_Minor_Form" id="" class="btn btn-success"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                  </li>
               </ul>
            </div>
      <ol class="breadcrumb" style="float: none;position: relative;top: 0;" style="width:33%">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>

   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         
         <div class="row" style="margin-top: 75px;">
            <div class="col-md-12">
               <div class="card card-default">
                  <div class="card-body p-0">
                     <div class="box-body CWC_Second_Row">
                        <div class="card-body CWC_Address_Div">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Street / Landmark</label>
                             <div class="col-sm-6">
                                 <input type="text" class="form-control" id="address" autocomplete="off" name="street_landmark" placeholder="Street / Landmark" value="<?php echo set_value('street_landmark'); ?>">
                                 <?php echo form_error('street_landmark'); ?>
                             </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">State <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <input type="text" class="form-control" id="state" autocomplete="off" name="state" value="West Bengal" readonly style="cursor: not-allowed;"> 
                             </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">District <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <select class="form-control district" name="district" id="district">
                                    <option value="">--Please Select District--</option>
                                    <?php foreach($districts as $district){ ?> 
                                    <option value="<?php echo $district['district_id_pk'];?>"><?php echo $district['district_name'];?></option>
                                    <?php } ?>                     
                                 </select>
                                 <?php echo form_error('district'); ?>
                             </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Block / Municipality <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <select class="form-control" name="block" id="block">
                                    <option disabled="" selected="" value="">--Please Select District First--</option>
                                    <?php foreach($block_details as $block_val){ ?>
                                    <option value="<?php echo $block_val['block_id_pk'];?>"><?php echo $block_val['block_name'];?></option> 
                                    <?php } ?>
                                 </select>
                                 <?php echo form_error('block'); ?>
                             </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Ward / GP <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <select class="form-control" name="ward_gp" id="ward_gp">
                                    <option disabled="" selected="" value="">--Please Select Block / Municipality First--</option>
                                    <?php if(!empty($Ward_Gp_Block)){?>
                                       <?php if($Ward_Gp_Block->rural_urban == 'U'){?>
                                         <?php foreach($cp_ward as $Incident_Ward_Value){ ?>
                                           <option value="<?php echo $Incident_Ward_Value['ward_id_pk'];?>"><?php echo $Incident_Ward_Value['ward_no'];?></option> 
                                         <?php } ?>
                                       <?php }else{?>
                                         <?php foreach($cp_gp as $Incident_GP_Value){ ?>
                                            <option value="<?php echo $Incident_GP_Value['gp_id_pk'];?>"><?php echo $Incident_GP_Value['gp_name'];?></option> 
                                         <?php } ?>
                                    <?php } } ?>
                                 </select>
                                 <?php echo form_error('block'); ?>
                             </div>
                           </div>
                        </div>
                        <div class="card-body CWC_Address_Div">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Pin Code <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <input type="text" class="form-control pin_code_validate" id="pin_code" autocomplete="off" name="pin_code" placeholder="Pin Code" value="<?php echo set_value('pin_code'); ?>">
                                 <?php echo form_error('pin_code'); ?>
                             </div>
                           </div>
                        </div>
                        <div class="card-body CWC_Address_Div">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Police Station <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <input type="text" class="form-control" id="police_station" autocomplete="off" name="police_station" placeholder="Police Station" value="<?php echo set_value('police_station'); ?>">
                                 <?php echo form_error('police_station'); ?>
                             </div>
                           </div>
                        </div>
                        <div class="card-body CWC_Address_Div">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Address <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <textarea rows="3" name="address" id="address" class="form-control" placeholder="Address"><?php echo set_value('address'); ?></textarea>
                                 <?php echo form_error('address'); ?>
                             </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Remarks</label>
                             <div class="col-sm-6">
                                 <textarea rows="3" name="remarks" class="form-control" placeholder="Remarks"><?php echo set_value('remarks'); ?></textarea>
                                 <?php echo form_error('remarks');?>
                             </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
         </div>
         <?php echo form_close(); ?>
      </div>
   </section>
   <!-- Modal -->
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>



<script type="text/javascript">
$('table').DataTable();
$(document).ready(function(){
      $(document).off('submit', '#addressChangeForm').on('submit', '#addressChangeForm',function (event) {
         event.preventDefault();
         var csrf_token_value = $('input[name=csrf_cmrts]').val();
         var formName = 'addressChangeForm';
         var formData = new FormData($('form[name="' + formName + '"]')[0]);
         formData.append("csrf_cmrts", csrf_token_value);
         formData.append("action", "submit");
         $.ajax({
            type: 'POST',
             url: '<?php echo base_url()?>admin/reporting/address_change/Address_change_form/create/',
             data: formData,
             processData: false,
             cache: false,
             contentType: false,
             dataType: 'JSON',
             beforeSend: function (xhr, plainObject) {
               //$('#btn_forward').html("working");
               //$('#btn_forward').attr('disabled', 'disabled');
             },
             success: function (data){
               console.log(data);
               $('input[name=csrf_cmrts]').val(data.csrf_token_value);

               if (data.formCompleteStatus) {

                  swal({
                   title: "The Follow Up Report has been saved in the Register",
                   type: "warning",
                   confirmButtonClass: "btn-success",
                   confirmButtonText: "Ok",
                   closeOnConfirm: false
                 }, function(isConfirm) {
                   if (isConfirm) {
                     var formName = 'addressChangeForm';
                        var formData = new FormData($('form[name="' + formName + '"]')[0]);
                        formData.append("csrf_cmrts", csrf_token_value);
                        formData.append("action", "swalSubmit");
                        $.ajax({
                           type: 'POST',
                            url: '<?php echo base_url()?>admin/reporting/address_change/Address_change_form/create/',
                            data: formData,
                            processData: false,
                            cache: false,
                            contentType: false,
                            dataType: 'JSON',
                            beforeSend: function (xhr, plainObject) {
                              //$('#btn_forward').html("working");
                              //$('#btn_forward').attr('disabled', 'disabled');
                            },
                            success: function (data){
                              console.log(data);
                              $('input[name=csrf_cmrts]').val(data.csrf_token_value);
                              if (data.errorFields.length == 0) {
                                 window.location.href = 'reporting/address/address_list/';
                              }else{
                               swal.close();  
                              }
                            }
                        });
                   }
                 });






               }else{
                  swal({
                     title: "All fields are not correctly filled in.What would you like to do?",
                     type: "warning",
                     showCancelButton: true,
                     confirmButtonClass: "btn-success",
                     confirmButtonText: "Save as Draft and return to Follow Up List",
                     cancelButtonClass: "btn-primary",
                     cancelButtonText: "Save as draft and close Follow Up Report",
                     closeOnConfirm: false,
                     closeOnCancel: false
                    }, function(isConfirm) {
                      if (isConfirm) {
                        var formName = 'addressChangeForm';
                        var formData = new FormData($('form[name="' + formName + '"]')[0]);
                        formData.append("csrf_cmrts", csrf_token_value);
                        formData.append("action", "swalSubmit");
                        $.ajax({
                           type: 'POST',
                            url: '<?php echo base_url()?>admin/reporting/address_change/Address_change_form/create/',
                            data: formData,
                            processData: false,
                            cache: false,
                            contentType: false,
                            dataType: 'JSON',
                            beforeSend: function (xhr, plainObject) {
                              //$('#btn_forward').html("working");
                              //$('#btn_forward').attr('disabled', 'disabled');
                            },
                            success: function (data){
                              console.log(data);
                              $('input[name=csrf_cmrts]').val(data.csrf_token_value);
                              swal.close();
                            }
                        });
                        
                      }else {

                        var formName = 'addressChangeForm';
                        var formData = new FormData($('form[name="' + formName + '"]')[0]);
                        formData.append("csrf_cmrts", csrf_token_value);
                        formData.append("action", "swalSubmit");
                        $.ajax({
                           type: 'POST',
                            url: '<?php echo base_url()?>admin/reporting/address_change/Address_change_form/create/',
                            data: formData,
                            processData: false,
                            cache: false,
                            contentType: false,
                            dataType: 'JSON',
                            beforeSend: function (xhr, plainObject) {
                              //$('#btn_forward').html("working");
                              //$('#btn_forward').attr('disabled', 'disabled');
                            },
                            success: function (data){
                              console.log(data);
                              $('input[name=csrf_cmrts]').val(data.csrf_token_value);
                              if (data.draftErrorFields.length == 0) {
                                 window.location.href = 'reporting/address/address_list/';
                              }else{
                               swal.close();  
                              }
                            }
                        });
                     } 
                    });

               }




               if (data.errorFields) {
                  $(document).find('.removeErrorMessage').remove();
                  var squareBracketsRegex = /\[[^\]]+\]/;

                  $.each(data.errorFields, function(key, value) {
                     if (squareBracketsRegex.test(key)) {
                        var fieldName = key.replace(/\]/g, '').replace(/\[/g, '-');
                        console.log(key);
                        $('[name="' + key + '"]').parent().append('<p id="' + fieldName + '-error" class="removeErrorMessage text-danger">' + value + '</p>');
                     }else{
                        var field_name = key.replace(/\[|\]/g, '');
                       $(document).find('#' + field_name).parent().append('<p  id="' + field_name + '-error" class="removeErrorMessage text-danger">' + value + '</p>');
                     }
                  });
               }
               
             }
         });

      });
   });

function Cancel_Incident(){
   swal({
   title: "Any information you may have entered will not be saved. Do you want to cancel, or return to the Follow Up List",
   type: "warning",
   showCancelButton: true,
   confirmButtonClass: "btn-success",
   confirmButtonText: "Return to Address Change",
   cancelButtonClass: "btn-danger",
   cancelButtonText: "Cancel",
   closeOnConfirm: true,
   closeOnCancel: false
 },
 function(isConfirm){
   if(!isConfirm){
       setTimeout(function(){
          window.location.href = "<?php echo base_url()?>admin/reporting/address/address_list/";
       }, 100);
   } 
 });
}
$(document).on('change','#district',function(){
  if($( "#district option:selected" ).val()!="")
  {
     var id=$('#district').val()
     $.ajax({
         url:'<?php echo base_url()?>admin/reporting/incident/incident_form/getBlockById',
         type:'GET',
         data:{'id':id}, 
         dataType: 'json',
         success: function(data)
         {
            $('#block').html('');
            $('#block').html('<option value="0" disabled selected>--Select Block / Municipality--</option>');
            data.forEach(element =>$("#block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
            var v=$( "#block option:selected" ).val();
         }
     });
  }
});

$(document).on('change','#block',function(){
   if($( "#block option:selected" ).val()!="")
   {
      var id = $('#block').val()
      $.ajax({
          url:'<?php echo base_url()?>admin/reporting/address_change/Address_change_form/Get_Block_Details',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
            if(data.rural_urban == 'U'){
               $.ajax({
                   url:'<?php echo base_url()?>admin/reporting/address_change/Address_change_form/Get_Ward_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#ward_gp').html('');
                     $('#ward_gp').html('<option value="0" disabled selected>--Select Ward/GP--</option>');
                     data.forEach(element =>$("#ward_gp").append($('<option></option>').val(element['ward_id_pk']).html(element['ward_no'])));
                     var v = $("#ward_gp option:selected").val();
                   }
               });
            }else{
               $.ajax({
                   url:'<?php echo base_url()?>admin/reporting/address_change/Address_change_form/Get_GP_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   {
                     $('#ward_gp').html('');
                     $('#ward_gp').html('<option value="0" disabled selected>--Select Ward/GP--</option>');
                     data.forEach(element =>$("#ward_gp").append($('<option></option>').val(element['gp_id_pk']).html(element['gp_name'])));
                     var v = $("#ward_gp option:selected").val();
                   }
               });
            }
          }
      });
   }
});
</script>

<script type="text/javascript">

// Pincode Validation
$(function () {
    $(".pin_code_validate").keypress(function (e) {
        var keyCode = e.keyCode || e.which;
        $("#lbl_error_pin_code").html("");
        var regex = /^[0-9]+$/;
        var isValid = regex.test(String.fromCharCode(keyCode));
        if (!isValid) {
            $("#lbl_error_pin_code").html("Only Numbers allowed.");
        }
        return isValid;
    });
});


</script>