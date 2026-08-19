<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<?php
   $cp_one_cwc_details = $this->db->select('cponecwcd.minor_sent, cponecwcd.transfer_status')
   ->from('cm_incident_report_cp_one_cwc_details AS cponecwcd')
   ->where('cponecwcd.incident_id_fk' , $incident_details[0]->incident_id_pk)
   ->order_by("sl_no", "DESC")
   ->limit(1)
   ->get()->row();
   
   $cp_two_cwc_details = $this->db->select('cptwocwcd.minor_sent, cptwocwcd.transfer_status')
   ->from('cm_incident_report_cp_two_cwc_details AS cptwocwcd')
   ->where('cptwocwcd.incident_id_fk' , $incident_details[0]->incident_id_pk)
   ->order_by("sl_no", "DESC")
   ->limit(1)
   ->get()->row();
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
      <h1>CWC Proceedings Form</h1>
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
         <?php echo form_open('admin/reporting/incident/incident_list/child_welfare_committee_proceedings_form/'.$record_num, array('class' => 'AddressChangeForm','name' => 'AddressChangeForm', 'id' => 'AddressChangeForm')) ?>
         <input type="hidden" name="inc_id" id="inc_id">
         <input type="hidden" name="incident_id" id="incident_id" value="<?php echo $record_num; ?>">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-default">
                  <div class="card-body p-0">
                     <div class="box-body">
                        <div class="card-body">
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Minor Sent to <font color="red">*</font></label>
                             <div class="col-sm-9">
                                 <?php foreach($minor_transfer_details as $key => $value){
                                    if($key == 2){
                                 ?>
                                 <label class="radio-inline"><input type="radio" class="cwc_minor_sent_div" name="minor_sent" id="minor_sent" value="<?php echo $value['sl_no']?>" <?php echo set_radio('minor_sent', $value['sl_no']); ?>> <?php echo $value['description']?></label>&nbsp;&nbsp;
                                 <?php } } ?>
                                 <?php echo form_error('minor_sent');?>
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
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">State <font color="red">*</font></label>
                             <div class="col-sm-6">
                                <input type="text" class="form-control" id="state" autocomplete="off" name="state" value="West Bengal" readonly style="cursor: not-allowed;">
                             </div>
                           </div>
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
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">SD/Block <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <select class="form-control" name="block" id="block">
                                    <option disabled="" selected="">--Please Select District First--</option>
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
                                 </select>
                                 <?php echo form_error('cci_details'); ?>
                             </div>
                           </div>
                           <div class="form-group row">
                             <label class="col-sm-2 col-form-label">Remarks <font color="red">*</font></label>
                             <div class="col-sm-6">
                                 <textarea rows="3" name="remarks" class="form-control"><?php echo set_value('remarks'); ?></textarea>
                                 <?php echo form_error('remarks');?>
                             </div>
                           </div>
                        </div>
                     </div>
                     <div class="box bottom-box" style="text-align: center;">
                        <button type="submit" class="btn btn-success" style="margin-top: 16px; margin-bottom: 20px;"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
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
<!-- <script type="text/javascript">
$(document).ready(function(){
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
$(document).ready(function(){
  $('#district').change(function(){
      var district_value = $('#district').find(":selected").val();
      var incident_id = $('#incident_id').val();
      if(district_value != ''){
          $.ajax({
          // url:'<?php //echo base_url()?>admin/reporting/incident/incident_list/Get_Cp_Gender_Details',
          url:'<?php echo base_url()?>admin/reporting/address/Address_list/Get_Cp_One_Gender_Details',
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
</script>