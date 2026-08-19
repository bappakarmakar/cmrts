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
    .btn-success {
        margin-bottom: 15px;
    }
</style>
<script>
  function previous() {
    window.history.back();
  }
</script>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Interventions Undertaken Report</h1>
      <ol class="breadcrumb">
        <li><a href="javascript:void(0)" onclick="previous()"><i class="fa fa-backward faico"></i>&nbsp;Back</a></li>
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
         <div class="box-body">
            <div class="card-body">
               <table id="table" class="table table-bordered table-striped">
                  <a href="<?php echo base_url()?>admin/mis/cm_report/cm_report_view/GP_Ward_Wise_Download_Excel/<?php echo $block_id; ?>/<?php echo $from_date; ?>/<?php echo $to_date; ?>" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
                 <thead>
                    <tr class="custom_table_head">
                       <th class="text-center" rowspan="2">Sl. No</th>
                       <th class="text-center" rowspan="2">Jurisdiction</th>
                       <th class="text-center" colspan="2">Before</th>
                       <th class="text-center" colspan="2">On Day of Marriage</th>
                       <th class="text-center" colspan="2">After</th>
                       <th class="text-center" colspan="2">Totals</th>
                       <th class="text-center" colspan="2">No. of minor involved</th>
                    </tr>
                    <tr class="custom_table_head">
                      <th class="text-center">Prevented</th>
                      <th class="text-center">Not Prevented</th>

                      <th class="text-center">Prevented</th>
                      <th class="text-center">Not Prevented</th>

                      <th class="text-center">Prevented</th>
                      <th class="text-center">Not Prevented</th>

                      <th class="text-center">Prevented</th>
                      <th class="text-center">Not Prevented</th>

                      <th class="text-center">Female</th>
                      <th class="text-center">Male</th>
                    </tr>
                 </thead>
                 <tbody id="childAppend">
                    <?php 
                    if(isset($report_result)){
                    $c = 1;
                    foreach($report_result as $value){ 
                      
                    $before_marriage_prevented = $value['before_marriage_prevented'];
                    $before_marriage_not_prevented = $value['before_marriage_not_prevented'];

                    $during_marriage_prevented = $value['during_marriage_prevented'];
                    $during_marriage_not_prevented = $value['during_marriage_not_prevented'];

                    $after_marriage_prevented = $value['after_marriage_prevented'];
                    $after_marriage_not_prevented = $value['after_marriage_not_prevented'];

                    $total_prevented = $before_marriage_prevented+$during_marriage_prevented+$after_marriage_prevented;

                    $total_not_prevented = $before_marriage_not_prevented+$during_marriage_not_prevented+$after_marriage_not_prevented;
                    ?>
                    <tr>
                       <td><?php echo $c++;?></td>
                       <td style="text-align: center;"><?php echo $value['ward_gp_name']; ?></td>

                       <td><?php if($value['before_marriage_prevented'] != 0){ echo $value['before_marriage_prevented']; } else{ echo "0"; } ?></td>
                       <td><?php if($value['before_marriage_not_prevented'] != 0){ echo $value['before_marriage_not_prevented']; } else { echo "0"; } ?></td>

                       <td><?php if($value['during_marriage_prevented'] != 0){ echo $value['during_marriage_prevented']; } else { echo "0"; } ?></td>
                       <td><?php if($value['during_marriage_not_prevented'] != 0){ echo $value['during_marriage_not_prevented']; } else { echo "0"; } ?></td>

                       <td><?php if($value['after_marriage_prevented'] != 0){ echo $value['after_marriage_prevented']; } else { echo "0"; } ?></td>
                       <td><?php if($value['after_marriage_not_prevented'] != 0){ echo $value['after_marriage_not_prevented']; } else { echo "0"; } ?></td>

                       <td><?php echo $total_prevented; ?></td>
                       <td><?php echo $total_not_prevented; ?></td>

                       <td><?php if($value['total_female_count_under_18'] != 0){ echo $value['total_female_count_under_18']; } else { echo "0"; } ?></td>
                       <td><?php if($value['total_male_count_under_18'] != 0){ echo $value['total_male_count_under_18']; } else { echo "0"; } ?></td>
                    </tr>
                    <?php } } ?>


                    <?php 
                    if(count($report_result)>1)
                    {
                      ?>
                      <tfoot>
                        <tr class="custom_table_head">
                          <td colspan="2">Total</td>
                          <td><?php echo array_sum(array_column($report_result, 'before_marriage_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'before_marriage_not_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'during_marriage_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'during_marriage_not_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'after_marriage_prevented'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'after_marriage_not_prevented'));?></td>


                          <td><?php echo (array_sum(array_column($report_result, 'before_marriage_prevented')) + array_sum(array_column($report_result, 'during_marriage_prevented')) + array_sum(array_column($report_result, 'after_marriage_prevented')))
                              ?>
                          </td>
                          <td><?php echo (array_sum(array_column($report_result, 'before_marriage_not_prevented')) + array_sum(array_column($report_result, 'during_marriage_not_prevented')) + array_sum(array_column($report_result, 'after_marriage_not_prevented')))
                              ?>
                          </td>

                          <td><?php echo array_sum(array_column($report_result, 'total_female_count_under_18'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'total_male_count_under_18'));?></td>



                        </tr>
                      </tfoot>
                      <?php 
                    }  
                    ?>
                 </tbody>
              </table>
            </div>
         </div>
          <div class="box-footer"></div>
      </div>
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