<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<?php
$cp_one_cwc_details = cp_one_cwc_details($incident_details[0]->incident_id_pk);
$cp_two_cwc_details = cp_two_cwc_details($incident_details[0]->incident_id_pk);
?>
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
      display: none;
      max-width: 100%;
      margin-bottom: 5px;
      font-weight: 700;
    }
    .dataTables_info {
      display: none;
    }
    .dataTables_paginate {
      display: block;
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
      font-size: 19px;
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
    .btn-primary {
        margin-top: 15px;
        margin-bottom: 20px;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Address Change</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <?php echo form_open('admin/reporting/incident/incident_list/address_change/'.base64_encode($incident_id_pk), array('class' => 'AddressChangeForm','name' => 'AddressChangeForm', 'id' => 'AddressChangeForm')) ?>
         <input type="hidden" name="inc_id" id="inc_id">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-default">
                  <div class="card-body p-0">
                     <div class="box-body">
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Minor Details <font color="red">*</font></label>
                             <div class="col-sm-9">
                                 <?php if($this->session->userdata('stake_id_fk') == '2' || $this->session->userdata('stake_id_fk') == '6'){?> <?php 
                                    foreach($contracting_parties_details as $value){
                                        if($value->cp_type==1){
                                    ?>
                                    <label class="radio-inline"><input type="radio" class="minor_details_div" name="minor_details" id="minor_details" data-id="<?php echo $incident_id_pk?>" value="<?php echo $value->cp_id_pk.':1';?>" <?php echo set_radio('minor_details', 1); ?>>&nbsp;Contracting Party One</label>&nbsp;&nbsp;

                                    <?php
                                        }elseif($value->cp_type==2){
                                    ?>
                                    <label class="radio-inline"><input type="radio" class="minor_details_div" name="minor_details" id="minor_details" data-id="<?php echo $incident_id_pk?>" value="<?php echo $value->cp_id_pk.':2';?>" <?php echo set_radio('minor_details', 2); ?>>&nbsp;Contracting Party Two</label>&nbsp;&nbsp;

                                    <?php
                                        }else{

                                        }
                                  ?> 
                                 <?php } ?>
                                 
                                
                                 
                                 <?php } ?>
                                 <?php echo form_error('minor_details');?>
                             </div>
                           </div>
                        </div>
                     </div>
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
                                    <option disabled="" value="">--Please Select District--</option>
                                    <?php foreach($districts as $district){ ?> 
                                    <option value="<?php echo $district['district_id_pk'];?>" <?php echo set_select('district', $district['district_id_pk'], False); ?>><?php echo $district['district_name'];?></option>
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
                                    <option value="<?php echo $block_val['block_id_pk'];?>" <?php echo set_select('block', $block_val['block_id_pk']); ?>><?php echo $block_val['block_name'];?></option> 
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
                                           <option value="<?php echo $Incident_Ward_Value['ward_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_Ward_Value['ward_id_pk']); ?>><?php echo $Incident_Ward_Value['ward_no'];?></option> 
                                         <?php } ?>
                                       <?php }else{?>
                                         <?php foreach($cp_gp as $Incident_GP_Value){ ?>
                                            <option value="<?php echo $Incident_GP_Value['gp_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_GP_Value['gp_id_pk']); ?>><?php echo $Incident_GP_Value['gp_name'];?></option> 
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
                                 <textarea rows="3" name="address" class="form-control" placeholder="Address"><?php echo set_value('address'); ?></textarea>
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
                     <div class="box bottom-box" style="text-align: center;">
                        <button type="submit" class="btn btn-success" style="margin-top: 16px; margin-bottom: 20px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Change Now</button>
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
<!-- <script type="text/javascript">
$(document).ready(function(){
 $(".CWC_First_Row").hide();
 $(".CWC_Second_Row").hide();
 $(".CWC_Address_Div").hide();
 $(".CWC_Third_Row").hide();
 $(".CWC_CCI_Div").hide();
  $(".minor_details_div").change(function(){
     var cwc_minor_sent_div = [];
     $(".cwc_minor_sent_div").each(function(){
        if($(this).is(":checked"))
        {
           cwc_minor_sent_div.push($(this).val());
        }
     });
     CWC_Minor_Sent_Div_Value = cwc_minor_sent_div.toString();
     var CWC_minor_details_value = $('input[name="minor_details"]:checked').val();
     if(CWC_minor_details_value != '' && CWC_Minor_Sent_Div_Value != ''){
       if(CWC_Minor_Sent_Div_Value == '4'){
          $(".CWC_First_Row").show();
          $(".CWC_Second_Row").show();
          $(".CWC_CCI_Div").show();
          $(".CWC_Third_Row").show();
          $(".CWC_Address_Div").hide();
       }else{
          $(".CWC_First_Row").hide();
          $(".CWC_Second_Row").show();
          $(".CWC_CCI_Div").hide();
          $(".CWC_Address_Div").show();
          $(".CWC_Third_Row").show();
       }
     }
 });
});
</script> -->
<!-- <script type="text/javascript">
   $("#AddressChangeForm").validate({
      rules: {
         minor_details: {
            required: true
         },
         minor_sent: {
            required: true
         },
         district: {
            required: true
         },
         block: {
            required: true
         }
      },
   });
</script> -->
<script type="text/javascript">
function Get_Incident(inci_id)
{
  $('#inc_id').val(inci_id);
}
// $(document).ready(function(){
//   $('.minor_details_div, #district').change(function(){
//       var minor_details_gender_value = $('input[name=minor_details]:checked').val();
//       var district_value = $('#district').find(":selected").val();
//       var incident_id = $('#inc_id').val();
//       if(district_value != ''){
//           $.ajax({
//           url:'<?php //echo base_url()?>admin/reporting/incident/incident_list/Get_Cp_Gender_Details',
//           type:'GET',
//           data:{'incident_id':incident_id, 'minor_details_gender_value':minor_details_gender_value, 'district_value':district_value}, 
//           dataType: 'json',
//           success: function(data)
//           {
//             $('#cci_details').html('');
//             data.forEach(element =>$("#cci_details").append($('<option></option>').val(element['sl_no']).html(element['cci_name'])));
//           }
//         });
//       }
//   });
// });
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