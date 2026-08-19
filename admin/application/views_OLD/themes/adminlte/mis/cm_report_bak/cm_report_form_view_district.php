<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
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
    .btn-primary {
        margin-top: 15px;
        margin-bottom: 20px;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>CM Report</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <?php echo form_open('admin/mis/cm_report/cm_report_view', array('class' => 'CMReportForm','name' => 'CMReportForm', 'id' => 'CMReportForm')) ?>
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
               <!-- <div class="form-group row">
                 <label class="col-sm-12 col-form-label" style="color: red;">From Date and To Date should match each other.</label>
               </div> -->
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">From Date <font color="red">*</font></label>
                 <div class="col-sm-4">
                   <input type="text" name="from_date" class="form-control datepicker" data-date-end-date="0d" autocomplete="off" readonly placeholder="From Date" value="<?php echo set_value('from_date')?>" style="background-color: white;">
                   <?php echo form_error('from_date');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">To Date <font color="red">*</font></label>
                 <div class="col-sm-4">
                   <input type="text" class="form-control datepicker" data-date-end-date="0d" placeholder="To Date" autocomplete="off" readonly name="to_date" value="<?php echo set_value('to_date')?>" style="background-color: white;">
                   <?php echo form_error('to_date');?>
                 </div>
               </div>
            </div>
         </div>
         <button type="submit" name="cm_report_sub" class="btn btn-primary" style="margin-left: 8px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
      </div>
      <?php echo form_close();?>
      <?php if(isset($_POST['cm_report_sub']) && count($this->form_validation->error_array()) == 0){?>
      <?php
      $date_from = explode('/', $_POST['from_date']);
      $date_raw_from = $date_from['2']."-".$date_from['1']."-".$date_from['0'];
          
      $date_to = explode('/', $_POST['to_date']);
      $date_raw_to = $date_to['2']."-".$date_to['1']."-".$date_to['0'];
      ?>
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
               <table id="table" class="table table-bordered table-striped">
                  <a href="<?php echo base_url()?>admin/mis/cm_report/cm_report_view/District_Wise_Download_Excel/<?php echo $date_raw_from; ?>/<?php echo $date_raw_to; ?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
                 <thead>
                    <tr class="custom_table_head">
                       <th class="text-center" rowspan="2">Sl. No</th>
                       <th class="text-center" rowspan="2">Jurisdiction</th>
                       <th class="text-center" colspan="2">Before</th>
                       <th class="text-center" colspan="2">During</th>
                       <th class="text-center" colspan="2">After</th>
                       <th class="text-center" colspan="2">Totals</th>
                       <th class="text-center" colspan="2">No. of minor involved</th>
                    </tr>
                    <tr class="custom_table_head">
                      <th class="text-center">Reported</th>
                      <th class="text-center">Prevented</th>

                      <th class="text-center">Reported</th>
                      <th class="text-center">Prevented</th>

                      <th class="text-center">Reported</th>
                      <th class="text-center">Prevented</th>

                      <th class="text-center">Reported</th>
                      <th class="text-center">Prevented</th>

                      <th class="text-center">Female</th>
                      <th class="text-center">Male</th>
                    </tr>
                 </thead>
                 <tbody id="childAppend">
                    <?php 
                    if(count((array)$report_result) > 0){
                      if(isset($report_result)){
                        $c = 1;
                        foreach($report_result as $value){ 

                          $date_from = explode('/', $_POST['from_date']);
                          $date_raw_from = $date_from['2']."-".$date_from['1']."-".$date_from['0'];
                              
                          $date_to = explode('/', $_POST['to_date']);
                          $date_raw_to = $date_to['2']."-".$date_to['1']."-".$date_to['0'];

                          $before_marriage_reported = $value['before_marriage_reported'];
                          $before_marriage_prevented = $value['before_marriage_prevented'];

                          $during_marriage_reported = $value['during_marriage_reported'];
                          $during_marriage_prevented = $value['during_marriage_prevented'];

                          $after_marriage_reported = $value['after_marriage_reported'];
                          $after_marriage_prevented = $value['after_marriage_prevented'];

                          $total_reported = $before_marriage_reported+$during_marriage_reported+$after_marriage_reported;

                          $total_prevented = $before_marriage_prevented+$during_marriage_prevented+$after_marriage_prevented;
                    ?>
                    <tr>
                       <td><?php echo $c++;?></td>
                       <td style="text-align: left;"><a href="<?php echo base_url()?>admin/mis/cm_report/cm_report_view/block_wise/<?php echo $value['district_id_pk']; ?>/<?php echo $date_raw_from;?>/<?php echo $date_raw_to;?>"><?php echo $value['district_name']; ?></a></td>
                       <td><?php if($value['before_marriage_reported'] != 0){ echo $value['before_marriage_reported']; } else { echo "0"; } ?></td>
                       <td><?php if($value['before_marriage_prevented'] != 0){ echo $value['before_marriage_prevented']; } else{ echo "0"; } ?></td>

                       <td><?php if($value['during_marriage_reported'] != 0){ echo $value['during_marriage_reported']; } else { echo "0"; } ?></td>
                       <td><?php if($value['during_marriage_prevented'] != 0){ echo $value['during_marriage_prevented']; } else { echo "0"; } ?></td>

                       <td><?php if($value['after_marriage_reported'] != 0){ echo $value['after_marriage_reported']; } else { echo "0"; } ?></td>
                       <td><?php if($value['after_marriage_prevented'] != 0){ echo $value['after_marriage_prevented']; } else { echo "0"; } ?></td>

                       <td><?php echo $total_reported; ?></td>
                       <td><?php echo $total_prevented; ?></td>

                       <td><?php if($value['total_female_count_under_18'] != 0){ echo $value['total_female_count_under_18']; } else { echo "0"; } ?></td>
                       <td><?php if($value['total_male_count_under_18'] != 0){ echo $value['total_male_count_under_18']; } else { echo "0"; } ?></td>
                    </tr>
                    <?php } } } else { ?>
                    <tr>
                         <td colspan="14" align="center"><font color="#990000" >  No Data Found !!! </font></td>
                    </tr>
                    <?php } ?>
                 </tbody>
              </table>
            </div>
         </div>
          <div class="box-footer"></div>
      </div>
    <?php } ?>
   </section>
</div>
<script type="text/javascript">
$(document).ready(function () {
  $('#table').dataTable({
    "bDestroy": true
  }).fnDestroy();  
});
</script>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
