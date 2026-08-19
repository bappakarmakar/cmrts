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
    .btn-danger {
        margin-top: 15px;
        margin-bottom: 20px;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Add Police Case Form</h1>
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
      <?php echo form_open('admin/reporting/incident/incident_list/police_cases/'.base64_encode($incident_id).'/'.base64_encode($cp_id).'/'.base64_encode($cp_type), array('class' => 'PoliceCaseForm','name' => 'PoliceCaseForm', 'id' => 'PoliceCaseForm')) ?>

        <input type="hidden" value="<?php echo date('d-m-Y', strtotime($incident_details['incident_date'])); ?>" name="incident_date" id="incident_date">
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">GD No <font color="red">*</font></label>
                 <div class="col-sm-6">
                   <input type="text" name="gd_no" id="gd_no" class="form-control" autocomplete="off" placeholder="GD No" value="<?php echo set_value('gd_no')?>">
                   <?php echo form_error('gd_no');?>
                    <span class="error" id="gd_noError"></span>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">GD Date <font color="red">*</font></label>
                 <div class="col-sm-6">
                   <input type="text" class="form-control datepicker" data-date-end-date="0d" id="gd_date" placeholder="GD Date" readonly autocomplete="off" name="gd_date" style="background-color: white;" tabindex="7" value="<?php echo set_value('gd_date')?>">
                   <?php echo form_error('gd_date');?>
                   <span id="gdDateError" style="color: red;"></span>
                 </div>
               </div>
            </div>
         </div>
         <div class="box-body">
            <div class="card-body">
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">FIR No <font color="red">*</font></label>
                 <div class="col-sm-6">
                   <input type="text" name="fir_no" id="fir_no" class="form-control" autocomplete="off" placeholder="FIR No" value="<?php echo set_value('fir_no')?>">
                   <?php echo form_error('fir_no');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">FIR Date <font color="red">*</font></label>
                 <div class="col-sm-6">
                   <input type="text" class="form-control datepicker" data-date-end-date="0d" id="fir_date" placeholder="FIR Date" readonly autocomplete="off" name="fir_date" style="background-color: white;" tabindex="7" value="<?php echo set_value('fir_date')?>">
                   <?php echo form_error('fir_date');?>
                   <!-- <span class="error" id="fir_dateError"></span> -->
                   <span id="firDateError" style="color: red;"></span>
                 </div>
               </div>
            </div>
         </div>
         <div class="box-body">
            <div class="card-body">
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">Police Station <font color="red">*</font></label>
                 <div class="col-sm-6">
                   <input type="text" name="police_station" id="police_station" class="form-control" autocomplete="off" placeholder="Police Station" value="<?php echo set_value('police_station')?>">
                   <?php echo form_error('police_station');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">State <font color="red">*</font></label>
                 <div class="col-sm-6">
                   <input type="text" name="pc_state" id="pc_state" class="form-control" value="West Bengal" readonly style="cursor: not-allowed;">
                     <?php echo form_error('pc_state');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">District <font color="red">*</font></label>
                 <div class="col-sm-6">
                   <select class="form-control" name="pc_district" id="pc_district">
                     <option disabled="" selected="" value="">--Please Select District--</option>
                     <?php foreach($districts as $district){ ?> 
                     <option value="<?php echo $district['district_id_pk'];?>"><?php echo $district['district_name'];?></option>
                     <?php } ?>                     
                   </select>
                   <?php echo form_error('pc_district');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">SD/Block <font color="red">*</font></label>
                 <div class="col-sm-6">
                   <select class="form-control" name="pc_block" id="pc_block">
                      <option disabled="" selected="" value="">--Please Select District First--</option>
                   </select>
                   <?php echo form_error('pc_block');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">Reason <font color="red">*</font></label>
                 <div class="col-sm-6">
                   <select class="form-control" name="reason">
                     <option value="">--Select--</option>
                     <?php foreach($reason as $value){?>
                      <option value="<?=$value->sl_no?>" <?php echo set_select('reason', $value->sl_no, False); ?> ><?=$value->description?></option>
                     <?php } ?>
                     
                   </select>
                   <?php echo form_error('reason');?>
                 </div>
               </div>
            </div>
         </div>
         <div class="box bottom-box" style="text-align: center;">
            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
         </div>
      </div>
      <?php echo form_close();?>
   </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
   $('table').DataTable();
</script>
<script type="text/javascript">
$(document).on('change','#pc_district',function(){
   if($( "#pc_district option:selected" ).val()!="")
   {
      var id = $('#pc_district').val()
      $.ajax({
          url:'<?php echo base_url()?>admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             $('#pc_block').html('');
             data.forEach(element =>$("#pc_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v = $( "#pc_block option:selected" ).val();
          }
      });
   }
});
</script>


<script type="text/javascript">
document.getElementById('PoliceCaseForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    
    var firDateError = document.getElementById('firDateError');
    var gdDateError = document.getElementById('gdDateError');

    var incidentDate = new Date($('#incident_date').val().split('-').reverse().join('-'));
  if($('#fir_date').val()!="")
  {
    var firDate = new Date($('#fir_date').val().split('/').reverse().join('-'));
  }
  else
  {
    var firDate = '';

  }

  if($('#gd_date').val()!="")
  {
    var gdDate = new Date($('#gd_date').val().split('/').reverse().join('-'));
  }
  else
  {
    var gdDate = '';

  }

    // alert(firDate);
    // alert(incidentDate);
  if(firDate=='' || firDate<incidentDate)
  {
    if (firDate=='') 
    {
        // alert('Please enter a valid FIR date.');
        firDateError.textContent = 'Please enter a valid FIR date.';
    } 
    else if (firDate <incidentDate && firDate!='')
    {
      // alert(firDate);
        // alert('Please enter a valid FIR date that is not less than the incident date.');
         firDateError.textContent = 'FIR date should not be less than the incident date : '+$('#incident_date').val();
    }

  }
  if(firDate!='' && firDate>=incidentDate)
  {
    firDateError.textContent = '';
  }
  if(gdDate=='' || gdDate<incidentDate)
  {

    if (gdDate=='') 
    {
        // alert('Please enter a valid FIR date.');
        gdDateError.textContent = 'Please enter a valid GD date.';
    } 
    else if (gdDate <incidentDate && gdDate!='')
    {
        // alert('Please enter a valid FIR date that is not less than the incident date.');
         gdDateError.textContent = 'GD date should not be less than the incident date : '+$('#incident_date').val();
    }

  }
  if(gdDate!='' && gdDate>=incidentDate)
  {
    gdDateError.textContent = '';
  }

  if((firDate!='' && firDate>=incidentDate)&&(gdDate!='' && gdDate>=incidentDate))
  {
      this.submit();
  }


});

function formatDate(date) {
    var year = date.getFullYear();
    var month = ('0' + (date.getMonth() + 1)).slice(-2); 
    var day = ('0' + date.getDate()).slice(-2);

    return year + '-' + month + '-' + day;
}


</script>