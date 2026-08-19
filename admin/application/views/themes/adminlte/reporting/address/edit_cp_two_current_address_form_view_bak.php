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
      <h1>Add Current Address of contracting parties</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <?php
      $last = $this->uri->total_segments();
      $record_num = $this->uri->segment($last);
      ?>
      <div class="box bottom-box">
         <?php echo form_open('admin/reporting/address/address_list/add_cp_two_current_address/edit/'.$record_num, array('class' => 'AddressChangeForm','name' => 'AddressChangeForm', 'id' => 'AddressChangeForm')) ?>
         <input type="hidden" name="inc_id" id="inc_id">
         <input type="hidden" name="incident_id" id="incident_id" value="<?php echo $record_num; ?>">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-default">
                  <div class="card-body p-0">
                     <div class="box-body">
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Current Address <font color="red">*</font></label>
                             <div class="col-sm-9">
                                 <?php 
                                 foreach($minor_transfer_details as $key => $value){
                                    if($key == 2){
                                      if($cp_two_current_age->cp_two_age < 18){
                                ?>
                                 <label class="radio-inline"><input type="radio" class="cwc_minor_sent_div" name="minor_sent" id="minor_sent" value="<?php echo $value['sl_no']?>" <?php echo set_radio('minor_sent', $value['sl_no']); ?><?php echo ($edit_cp_two_address->minor_sent == $value['sl_no']) ?  "checked" : "" ;  ?>><?php echo $value['description']?></label>&nbsp;&nbsp;
                                 <?php } }else{ ?>
                                 <label class="radio-inline"><input type="radio" class="cwc_minor_sent_div" name="minor_sent" id="minor_sent" value="<?php echo $value['sl_no']?>" <?php echo set_radio('minor_sent', $value['sl_no']); ?><?php echo ($edit_cp_two_address->minor_sent == $value['sl_no']) ?  "checked" : "" ;  ?>><?php echo $value['description']?></label>&nbsp;&nbsp;
                                 <?php } } ?>
                                 <?php echo form_error('minor_sent');?>
                             </div>
                           </div>
                        </div>
                     </div>
                     <div class="box-body Already_Fetch_Entered_Address_Row">
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Fetch already entered address?</label>
                             <div class="col-sm-9">
                                 <input type="checkbox" class="entered_address" name="fetch_entered_address" value="1">
                             </div>
                           </div>
                        </div>
                     </div>
                     <div class="box-body CWC_First_Row">
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Case No <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <input type="text" placeholder="Case No" class="form-control" id="case_no" autocomplete="off" name="case_no" value="<?php if(set_value('case_no') != ''){?><?php echo set_value('case_no'); ?><?php }else{?><?php echo $edit_cp_two_address->case_no?><?php } ?>">
                                 <?php echo form_error('case_no'); ?> 
                             </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Date <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <input type="text" class="form-control datepicker" data-date-end-date="0d" id="case_date" placeholder="Date" readonly autocomplete="off" name="case_date" value="<?php if(set_value('case_date') != ''){?><?php echo set_value('case_date'); ?><?php }else{?><?php echo date('d/m/Y', strtotime($edit_cp_two_address->case_date)); ?><?php } ?>" style="background-color: white;" tabindex="7">
                                 <?php echo form_error('case_date'); ?>
                             </div>
                           </div>
                        </div>
                     </div>
                     <div class="box-body CWC_Second_Row">
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
                                    <option disabled="" selected="" value="">--Please Select District--</option>
                                    <?php foreach($districts as $district){ ?> 
                                    <option value="<?php echo $district['district_id_pk'];?>" <?php echo set_select('district', $district['district_id_pk'], False); ?><?php if($edit_cp_two_address->district == $district['district_id_pk']){ echo "selected"; }?>><?php echo $district['district_name'];?></option>
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
                                    <option disabled="" selected="" value="">--Please Select District First--</option>
                                    <?php foreach($Block_Details as $value){ ?>
                                    <option value="<?php echo $value['block_id_pk'];?>" <?php echo set_select('block', $value['block_id_pk']); ?> <?php if($value['block_id_pk'] == $edit_cp_two_address->block){ echo "selected"; }?>><?php echo $value['block_name'];?></option>
                                    <?php } ?>
                                 </select>
                                 <?php echo form_error('block'); ?>
                             </div>
                           </div>
                        </div>
                     </div>
                     <div class="box-body CWC_Third_Row">
                        <div class="card-body CWC_CCI_Div">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">CCI <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <select class="form-control" name="cci_details" id="cci_details">
                                    <option disabled="" selected="">--Please Select District First--</option>
                                    <?php foreach($CP_Two_CWC_CCI as $value){ ?>
                                    <option value="<?php echo $value['sl_no'];?>" <?php echo set_select('cci_details', $value['sl_no']); ?> <?php if($value['sl_no'] == $edit_cp_two_address->cci_details){ echo "selected"; }?>><?php echo $value['cci_name'];?></option>
                                    <?php } ?>
                                 </select>
                                 <?php echo form_error('cci_details'); ?> 
                             </div>
                           </div>
                        </div>
                        <div class="card-body CWC_Address_Div">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Address <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <input type="text" class="form-control" id="address" autocomplete="off" name="address" placeholder="Address" value="<?php if(set_value('address') != ''){?><?php echo set_value('address'); ?><?php }else{?><?php echo $edit_cp_two_address->address; ?><?php } ?>">
                                 <?php echo form_error('address'); ?>
                             </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Remarks</label>
                             <div class="col-sm-6">
                                 <textarea rows="3" name="remarks" class="form-control" placeholder="Remarks"><?php if(set_value('remarks') != ''){?><?php echo set_value('remarks'); ?><?php }else{?><?php echo $edit_cp_two_address->remarks; ?><?php } ?></textarea>
                                 <?php echo form_error('remarks');?>
                             </div>
                           </div>
                        </div>
                     </div>
                     <div class="box bottom-box" style="text-align: center;">
                        <button type="submit" class="btn btn-primary" style="margin-top: 16px; margin-bottom: 20px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Update</button>
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
            data.forEach(element =>$("#block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
            var v=$( "#block option:selected" ).val();
         }
     });
  }
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    var cp_one_cwc_minor_sent_to = $('input[name="minor_sent"]:checked').val();
    if(cp_one_cwc_minor_sent_to == 1 || cp_one_cwc_minor_sent_to == 3){
        $(".CWC_First_Row").hide();
        $(".CWC_Second_Row").show();
        $(".CWC_CCI_Div").hide();
        $(".CWC_Address_Div").show();
        $(".CWC_Third_Row").show();
        $(".Already_Fetch_Entered_Address_Row").show();
    }else if(cp_one_cwc_minor_sent_to == 4){
        $(".CWC_First_Row").show();
        $(".CWC_Second_Row").show();
        $(".CWC_CCI_Div").show();
        $(".CWC_Third_Row").show();
        $(".CWC_Address_Div").hide();
        $(".Already_Fetch_Entered_Address_Row").show();
    }else{
        $(".CWC_First_Row").hide();
        $(".CWC_Second_Row").hide();
        $(".CWC_CCI_Div").hide();
        $(".CWC_Address_Div").hide();
        $(".CWC_Third_Row").hide();
        $(".Already_Fetch_Entered_Address_Row").hide();
    }

    $(".cwc_minor_sent_div, .minor_details_div").change(function(){
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
             $(".Already_Fetch_Entered_Address_Row").show();
          }else{
             $(".CWC_First_Row").hide();
             $(".CWC_Second_Row").show();
             $(".CWC_CCI_Div").hide();
             $(".CWC_Address_Div").show();
             $(".CWC_Third_Row").show();
             $(".Already_Fetch_Entered_Address_Row").show();
          }
        }
    });
});
</script>
<script type="text/javascript">
function Get_Incident(inci_id)
{
  $('#inc_id').val(inci_id);
}
$(document).ready(function(){
  $('.minor_details_div, #district').change(function(){
      var minor_details_gender_value = $('input[name=minor_details]:checked').val();
      var district_value = $('#district').find(":selected").val();
      var incident_id = $('#inc_id').val();
      if(district_value != ''){
          $.ajax({
          url:'<?php echo base_url()?>admin/reporting/incident/incident_list/Get_Cp_Gender_Details',
          type:'GET',
          data:{'incident_id':incident_id, 'minor_details_gender_value':minor_details_gender_value, 'district_value':district_value}, 
          dataType: 'json',
          success: function(data)
          {
            $('#cci_details').html('');
            data.forEach(element =>$("#cci_details").append($('<option></option>').val(element['sl_no']).html(element['cci_name'])));
          }
        });
      }
  });
});
// Fetch Entered Address
$(document).ready(function(){
  $('.entered_address').change(function(){
      var fetch_entered_address = $('input[name=fetch_entered_address]:checked').val();
      var incident_id = $('#incident_id').val()
      if(fetch_entered_address != ''){
        if(fetch_entered_address == undefined){
            $.ajax({
              url:'<?php echo base_url()?>admin/reporting/address/Address_list/Fetch_District_Details',
              type:'GET',
              dataType: 'json',
              success: function(response)
              {
                $('#district').html('');
                $('#district').attr("readonly", false).css({"cursor":"pointer"});
                 $('#district').html('<option value="0" disabled selected>--Please Select District--</option>');
                 response.forEach(element =>$("#district").append($('<option></option>').val(element['district_id_pk']).html(element['district_name'])));
                 var v=$( "#district option:selected" ).val();
                 $('#block').html('');
                 $('#block').attr("readonly", false).css({"cursor":"pointer"});
                 $('#block').html('<option value="0" disabled selected>--Please Select District First--</option>');
              }
            });
        }else{
            $.ajax({
              url:'<?php echo base_url()?>admin/reporting/address/Address_list/Fetch_CP_Two_Entered_Address',
              type:'GET',
              data:{'fetch_entered_address':fetch_entered_address, 'incident_id':incident_id}, 
              dataType: 'json',
              success: function(response)
              {
                var district_id = response.district_id;
                var block_id = response.block_id;
                var cp_two_block = response.cp_two_block;
                var cp_two_district = response.cp_two_district;
                var cp_two_age = response.cp_two_age;

                $('#district').html(`<option value="${district_id}">${cp_two_district}</option>`).css({"cursor":"not-allowed"}).attr("readonly", true);
                $('#block').html(`<option value="${block_id}">${cp_two_block}</option>`).css({"cursor":"not-allowed"}).attr("readonly", true);
                // if(cp_two_age >= 18 ){
                //    $('input[name=minor_sent]:last').attr("disabled", true);
                // }
              }
            });
        }   
      }
  });
});
// Fetch CCI Details
$(document).ready(function(){
  $('.cwc_minor_sent_div, #district').change(function(){
      var minor_sent = $('input[name=minor_sent]:checked').val();
      var district_value = $('#district').find(":selected").val();
      var incident_id = $('#incident_id').val()
      if(minor_sent != '' && district_value != ''){
        if(minor_sent == 4){
          $.ajax({
              url:'<?php echo base_url()?>admin/reporting/address/Address_list/Get_Cp_Two_Gender_Details',
              type:'GET',
              data:{'incident_id':incident_id, 'district_value':district_value}, 
              dataType: 'json',
              success: function(response)
              {
                 var cp_one_cwc_cci_data = '<option disabled="" selected="">--Please Select CCI--</option>';
                for(var count = 0; count < response.length; count++){
                   cp_one_cwc_cci_data += '<option value="'+response[count].sl_no+'">'+response[count].cci_name+'</option>';
                }
                $('#cci_details').html(cp_one_cwc_cci_data);
              }
          });
        } 
      }
  });
});
</script>