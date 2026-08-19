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
      font-size: 11px;
    }
    td {
      font-size: 12px;
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
    .dataTables_filter {
      display: block;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Police Cases List</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
        <a href="javascript:void()" onclick="expand()" class="btn btn-warning" style="margin-top: 8px; float: right;margin-right: 20px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Expand</a>

        <a href="<?php echo base_url()?>admin/reporting/police_case/police_case_list/list_download" class="btn btn-success download" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-download" aria-hidden="true"></i> List Download</a>

        <a href="<?php echo base_url()?>admin/reporting/police_case/police_case_list/list_print" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>

        <div class="box-footer">
            <div class="box-body">
                <table class="table table-bordered table-hover" id="mytable">
                   <thead>
                      <tr class="custom_table_head">
                         <th class="text-center">Sl. No</th>
                         <th class="text-center">Incident ID</th>
                         <th class="text-center">GD No</th>
                         <th class="text-center">GD Date</th>
                         <th class="text-center">FIR No</th>
                         <th class="text-center">FIR Date</th>
                         <th class="text-center">Action</th>
                      </tr>
                   </thead>
                   <tbody id="childAppend">
                      <?php
                      $c = 1;
                      foreach($police_case_details as $value){
                      ?>
                      <tr>
                         <td><?php echo $c++; ?></td>
                         <td><?php echo $value->reporting_id; ?></td>
                         <td><?php echo $value->gd_no; ?></td>
                         <td><?php echo date('d-m-Y', strtotime($value->gd_date)); ?></td>
                         <td><?php echo $value->fir_no; ?></td>
                         <td><?php echo date('d-m-Y', strtotime($value->fir_date)); ?></td>
                         <td>
                            <div class="dropdown">
                              <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                              <span class="caret"></span></button>
                              <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal<?php echo $value->sl_no; ?>"><i class="fa fa-eye" aria-hidden="true"></i>View History</a></li>
                               
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/police_case/police_case_list/edit/<?php echo base64_encode($value->sl_no)?>/<?php echo base64_encode($value->incident_id_fk)?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
                              </ul>
                            </div>
                         </td>
                      </tr>
                      <?php } ?>
                   </tbody>
                </table>
             </div>
         </div>
      </div>
   </section>
   <?php
   foreach($police_case_details as $value){
   ?>
   <div id="viewModal<?php echo $value->sl_no; ?>" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content" id="mod">
            <div class="modal-header custom-modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title text-center">Police Case Data</h4>
            </div>
            <div class="modal-body">
               <div class="div-table">
                  <!-- Prevention Incident -->
                 <div class="table">
                   <div class="tr">
                     <div class="td">GD No :</div>
                     <div class="td"><?php echo $value->gd_no; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">GD Date : </div>
                     <div class="td"><?php echo date('d-m-Y', strtotime($value->gd_date)); ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">FIR No : </div>
                     <div class="td"><?php echo $value->fir_no; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">FIR Date : </div>
                     <div class="td"><?php echo date('d-m-Y', strtotime($value->fir_date)); ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Police Station : </div>
                     <div class="td"><?php echo $value->police_station; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">State : </div>
                     <div class="td"><?php if($value->state == 19){?>West Bengal<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">District : </div>
                     <div class="td"><?php echo ucwords(strtolower($value->district_name)); ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">SD/Block : </div>
                     <div class="td"><?php echo ucwords(strtolower($value->block_name)); ?></div>
                   </div>
                   <?php $reason_name = get_police_cases_reason_name($value->reason);?>
                   <div class="tr">
                     <div class="td">Reason : </div>
                     <div class="td"><?=$reason_name;?></div>
                   </div>
                 </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
   <!-- View End Modal -->
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
$(document).on('change','#pc_district',function(){
   if($( "#pc_district option:selected" ).val()!="")
   {
      var id = $('#pc_district').val()
      // alert(id);
      $.ajax({
          url:'<?php echo base_url()?>admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             // alert(data);
             $('#pc_block').html('');
             data.forEach(element =>$("#pc_block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v = $( "#pc_block option:selected" ).val();
          }
      });
   }
});
</script>
<script type="text/javascript">
$("#PoliceCaseForm").validate({
   rules: {
      gd_no: {
         required: true
      },
      gd_date: {
         required: true
      },
      fir_no: {
         required: true
      },
      fir_date: {
         required: true
      },
      police_station: {
         required: true
      },
      pc_state: {
         required: true
      },
      pc_district: {
         required: true
      },
      pc_block: {
         required: true
      }
   },
});
</script>
<script type="text/javascript">
function Police_Case_ID(pc_id){
   var pc_id = pc_id;
   $('#pc_id').val(pc_id);
}

$(document).on('click','.download',function(){
   var pc_id = $('#pc_id').val();
   if(pc_id != "")
   {
      $.ajax({
          url:'<?php echo base_url()?>admin/reporting/police_case/police_case_form/police_case_download',
          type:'GET',
          data:{'pc_id':pc_id}, 
          success: function(data)
          {
              window.open(data);  
          }
      });
   }
});
</script>
<script type="text/javascript">
function expand(){
document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
}
</script>