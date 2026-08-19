    
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
         <?php echo form_open('admin/reporting/address/address_list/add_cp_one_current_address/edit/'.$record_num, array('class' => 'AddressChangeForm','name' => 'AddressChangeForm', 'id' => 'AddressChangeForm')) ?>
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
                                      if($cp_one_current_age->cp_one_age < 18){
                                 ?>
                                 <label class="radio-inline"><input type="radio" class="cwc_minor_sent_div" name="minor_sent" id="minor_sent" value="<?php echo $value['sl_no']?>" <?php echo set_radio('minor_sent', $value['sl_no']); ?>> <?php echo $value['description']?></label>&nbsp;&nbsp;
                                 <?php } }else{ ?>
                                 <label class="radio-inline"><input type="radio" class="cwc_minor_sent_div" name="minor_sent" id="minor_sent" value="<?php echo $value['sl_no']?>" <?php echo set_radio('minor_sent', $value['sl_no']); ?>> <?php echo $value['description']?></label>&nbsp;&nbsp;
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
                                 <input type="text" placeholder="Case No" class="form-control" id="case_no" autocomplete="off" name="case_no" value="<?php echo set_value('case_no'); ?>">
                                 <?php echo form_error('case_no'); ?> 
                             </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Date <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <input type="text" class="form-control datepicker" data-date-end-date="0d" id="case_date" placeholder="Date" readonly autocomplete="off" name="case_date" value="<?php echo set_value('case_date'); ?>" style="background-color: white;" tabindex="7">
                                 <?php echo form_error('case_date'); ?>
                             </div>
                           </div>
                        </div>
                     </div>
                     <div class="box-body CWC_Second_Row">
                        <div class="card-body">
                            <!-- added -->
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Street / Landmark</label>
                             <div class="col-sm-6">
                                <input type="text" placeholder="Street / Landmark" class="form-control" id="street_landmark" autocomplete="off" name="street_landmark" value="<?php echo set_value('street_landmark'); ?>">
                                <?php echo form_error('street_landmark');?>
                                <span id="landmark_error" style="color: red;"></span> 
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
                                        <option disabled="" selected="" value="">--Please Select District--</option>
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
                                 </select>
                                 <?php echo form_error('block'); ?>
                             </div>
                           </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Ward / GP <font color="red">*</font></label>
                        <div class="col-sm-6">
                            <?php 
                                if($this->session->userdata('block') != '' && $this->session->userdata('subdiv') != '')
                            {
                                ?>
                                <select class="form-control" id="ward_gp" autocomplete="off" name="ward_gp">
                                    <option value="" disabled selected>--Select Block / Municipality First--</option>
                                    <?php if(!empty($Incident_Ward_Gp_Block))
                                    {
                                        ?>
                                        <?php if($Incident_Ward_Gp_Block->rural_urban == 'U')
                                        {
                                            ?>
                                            <?php foreach($Incident_Ward as $Incident_Ward_Value)
                                            {
                                                ?>
                                                <option value="<?php echo $Incident_Ward_Value['ward_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_Ward_Value['ward_id_pk']); ?>><?php echo $Incident_Ward_Value['ward_no'];?></option> 
                                                <?php 
                                            }
                                                ?>
                                            <?php 
                                        }
                                        else
                                        {   
                                            ?>
                                            <?php foreach($Incident_Gp as $Incident_GP_Value)
                                            {  
                                                ?>
                                            <option value="<?php echo $Incident_GP_Value['gp_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_GP_Value['gp_id_pk']); ?>><?php echo $Incident_GP_Value['gp_name'];?></option> 
                                                <?php 
                                            }  
                                                ?>
                                            <?php 
                                        } 
                                    } ?>
                                </select>
                                <?php
                            }
                            elseif($this->session->userdata('block') == '0' && $this->session->userdata('subdiv') == '')
                            {
                                ?>
                                <select class="form-control" id="ward_gp" autocomplete="off" name="ward_gp">
                                <option value="" disabled selected>--Select Block / Municipality First--</option>
                                <?php if(!empty($Incident_Ward_Gp_Block))
                                {   
                                    ?>
                                    <?php if($Incident_Ward_Gp_Block->rural_urban == 'U')
                                    {
                                        ?>
                                        <?php foreach($Incident_Ward as $Incident_Ward_Value)
                                        {
                                            ?>
                                            <option value="<?php echo $Incident_Ward_Value['ward_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_Ward_Value['ward_id_pk']); ?>><?php echo $Incident_Ward_Value['ward_no'];?></option> 
                                            <?php 
                                        } 
                                            ?>
                                        <?php 
                                    }
                                        else
                                    {
                                        ?>
                                        <?php foreach($Incident_Gp as $Incident_GP_Value)
                                        {
                                            ?>
                                            <option value="<?php echo $Incident_GP_Value['gp_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_GP_Value['gp_id_pk']); ?>><?php echo $Incident_GP_Value['gp_name'];?></option> 
                                            <?php 
                                        } 
                                            ?>
                                        <?php 
                                    } 
                                } 
                                    ?>
                                </select>
                                <?php 
                            }
                            elseif($this->session->userdata('block') != '' && $this->session->userdata('subdiv') == '')
                            {
                                ?>
                                <select class="form-control" id="ward_gp" autocomplete="off" name="ward_gp">
                                    <option value="" disabled selected>--Select Ward / GP--</option>
                                    <?php foreach($ward_gp_details as $value)
                                    {
                                        ?>
                                        <option value="<?php echo $value['gp_id_pk'];?>" <?php echo set_select('ward_gp', $value['gp_id_pk']); ?>><?php echo $value['gp_name'];?></option>
                                        <?php 
                                    } 
                                        ?>
                                </select>
                                <?php 
                            } 
                                ?>
                            <?php echo form_error('ward_gp');?>
                            <span id="ward_error" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Pin Code <font color="red">*</font></label>
                    <div class="col-sm-6">
                        <input type="text" name="cp_one_pin_code" id="cp_one_pin_code" class="form-control cp_one_pin_code_validate pin_code_validate" value="<?php echo set_value('cp_one_pin_code'); ?>" placeholder="Pin Code" maxlength="6" onpaste="return false">
                         <span id="lbl_error_cp_one_pin_code" style="color: red;"></span>
                        <?php echo form_error('cp_one_pin_code'); ?>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Police Station <font color="red">*</font></label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" placeholder="Police Station" name="cp_one_police_station" id="cp_one_police_station" autocomplete="off" value="<?php echo set_value('cp_one_police_station'); ?>">
                      <?php echo form_error('cp_one_police_station');?>
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
                                 </select>
                                 <?php echo form_error('cci_details'); ?> 
                             </div>
                           </div>
                        </div>
                        <div class="card-body CWC_Address_Div">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Address <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <input type="text" class="form-control" id="address" autocomplete="off" name="address" placeholder="Address" value="<?php echo set_value('address'); ?>">
                                 <?php echo form_error('address'); ?>
                             </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Remarks</label>
                             <div class="col-sm-6">
                                 <textarea rows="3" name="remarks" class="form-control" placeholder="Remarks" id = "remarks"><?php echo set_value('remarks'); ?></textarea>
                                 <?php echo form_error('remarks');?>
                             </div>
                           </div>
                        </div>
                     </div>
                     <div class="box bottom-box" style="text-align: center;">
                        <button type="submit" class="btn btn-success" style="margin-top: 16px; margin-bottom: 20px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Add Now</button>
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
 $(".Already_Fetch_Entered_Address_Row").hide();
 $(".CWC_First_Row").hide();
 $(".CWC_Second_Row").hide();
 $(".CWC_Address_Div").hide();
 $(".CWC_Third_Row").hide();
 $(".CWC_CCI_Div").hide();
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
      var district_value = $('#district').find(":selected").val();
      var incident_id = $('#incident_id').val()
      if(district_value != ''){
          $.ajax({
          url:'<?php echo base_url()?>admin/reporting/incident/incident_list/Get_Cp_Gender_Details',
          type:'GET',
          data:{'incident_id':incident_id, 'district_value':district_value}, 
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
    // alert("hello");
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
                //console.log(response);
                $('#district').html('');
                $('#district').attr("readonly", false).css({"cursor":"pointer"});
                 $('#district').html('<option value="0" disabled selected>--Please Select District--</option>');
                 response.forEach(element =>$("#district").append($('<option></option>').val(element['district_id_pk']).html(element['district_name'])));
                 var v=$( "#district option:selected" ).val();
                 $('#block').html('');
                 $('#ward_gp').attr("readonly", false).css({"cursor":"pointer"});
                 $('#ward_gp').html('').prop("readonly", false);
                $("#street_landmark").val('').prop("readonly", false);
                $("#address").val('').prop("readonly", false);
                $("#cp_one_police_station").val('').prop("readonly", false);
                $("#cp_one_pin_code").val('').prop("readonly", false);
                $("#remarks").val('').prop("readonly", false);
                 $('#block').attr("readonly", false).css({"cursor":"pointer"});
                 $('#block').html('<option value="0" disabled selected>--Please Select District First--</option>');
              }
            });
        }else{
            $.ajax({
              url:'<?php echo base_url()?>admin/reporting/address/Address_list/Fetch_Edit_CP_One_Entered_Address',
              type:'GET',
              data:{'fetch_entered_address':fetch_entered_address, 'incident_id':incident_id}, 
              dataType: 'json',
              success: function(response)
              {
                // console.log(response);
                // alert(response);
                var district_id = response.district_id;
                var block_id = response.block_id;
                var cp_one_block = response.block;
                var cp_one_district = response.district;
                var cp_one_age = response.age;
                var cp_one_ward_gp = response.ward_gp;

                var street_landmark = response.street_landmark;
                var cp_one_police_station = response.police_station;
                var cp_one_pin_code = response.pin_code;
                var cp_one_ward_gp = response.ward_gp;
                var cp_one_ward_gp_id = response.cp_one_ward_gp_id;
                var cp_one_ward_gp_name = response.cp_one_ward_gp_name;
                var address = response.address;
                var remarks = response.remarks;

                // alert(cp_one_ward_gp);
                 // alert(remarks);
                $("#street_landmark").val(street_landmark).prop("readonly", true); 
                $("#cp_one_police_station").val(cp_one_police_station).prop("readonly", true); 
                $("#cp_one_pin_code").val(cp_one_pin_code).prop("readonly", true);
                $("#address").val(address).prop("readonly", true);
                $("#remarks").val(remarks).prop("readonly", true);

                // var nameTextBox = $('#street_landmark');  
                // var street_landmark = nameTextBox.val(); 

                $('#district').html(`<option value="${district_id}">${cp_one_district}</option>`).css({"cursor":"not-allowed"}).attr("readonly", true);
                $('#block').html(`<option value="${block_id}">${cp_one_block}</option>`).css({"cursor":"not-allowed"}).attr("readonly", true);
                $('#word').html(`<option value="${block_id}">${cp_one_block}</option>`).css({"cursor":"not-allowed"}).attr("readonly", true);
                $('#ward_gp').html(`<option value="${cp_one_ward_gp_id}">${cp_one_ward_gp_name}</option>`).css({"cursor":"not-allowed"}).attr("readonly", true);
                // if(cp_one_age >= 18 ){
                //    $('input[name=minor_sent]:last').attr("disabled", true);
                // }
                var minor_sent = $('input[name=minor_sent]:checked').val();
                var district_value = $('#district').find(":selected").val();
                //console.log(district_value);
                if(district_value != null && district_id==district_value )
                {
                  //alert(`incident_id=${incident_id} and district_value=${district_value} and district_id=${district_id} `);
                  if(minor_sent != '' && district_value != ''){
                    if(minor_sent == 4)
                    {
                      //console.log("right");
                      $.ajax({
                          url:'<?php echo base_url()?>admin/reporting/address/Address_list/Get_Cp_One_Gender_Details',
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

                }
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
              url:'<?php echo base_url()?>admin/reporting/address/Address_list/Get_Cp_One_Gender_Details',
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

<script type="text/javascript">
// Get CP One Ward / GP Details
$(document).on('change','#block',function(){
    var base_url = $('body').data('base_url');
   if($( "#block option:selected" ).val()!="")
   {
      var id = $('#block').val()
      // alert(id);
      $.ajax({
          url:base_url+'admin/reporting/incident/incident_form/Get_Block_Details',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
            // alert(data);
            if(data.rural_urban == 'U'){
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_Ward_Details',
                   type:'GET',
                   data:{'id':id}, 
                   dataType: 'json',
                   success: function(data)
                   { 
                    // alert(data);
                     $('#ward_gp').html('');
                     $('#ward_gp').html('<option value="0" disabled selected>--Select Ward/GP--</option>');
                     data.forEach(element =>$("#ward_gp").append($('<option></option>').val(element['ward_id_pk']).html(element['ward_no'])));
                     var v = $("#ward_gp option:selected").val();
                   }
               });
            }else{
               $.ajax({
                   url:base_url+'admin/reporting/incident/incident_form/Get_GP_Details',
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