<?php $this->load->view($this->config->item('theme_uri') . 'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri') . 'layout/left_menu_view'); ?>
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


<script type="text/javascript">
   function previous() {
      window.history.back();
   }
</script>

<div class="content-wrapper">
   <section class="content-header">
      <?php
      $title = "Follow Up Visits OverDue";
      $form_action = 'admin/mis/follow_up_visit_due/Follow_up_visit_due_report/follow_ups_due';
      echo "<h1>" . $title . "</h1>";
      ?>

      <ol class="breadcrumb">
         <?php $current_url = current_url(); ?>
         <li><a href="javascript:void(0)" onclick="previous()"><i class="fa fa-backward faico"></i>&nbsp;Back</a></li>

         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <?php echo form_open($form_action, array('class' => 'EducationReportForm', 'name' => 'EducationReportForm', 'id' => 'EducationReportForm')) ?>
      <?php
      $currentDate = date('d/m/Y');
      $currentDate_conv = date('Y/m/d');
      ?>
      <?php if ($hide_search == 0) { ?>
         <div class="box bottom-box">
            <div class="box-body">
               <div class="card-body">

                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label">From Intervention Date<font color="red">*</font></label>
                     <div class="col-sm-4">
                        <input type="text" name="from_date" class="form-control datepicker" data-date-end-date="0d" autocomplete="off" readonly placeholder="From Date" value="<?php if ($this->input->post('from_date')) { echo set_value('from_date'); } else { echo date('d/m/Y', strtotime($currentDate_conv . ' - 30 days')); } ?>" style="background-color: white;">
                        <?php echo form_error('from_date'); ?>
                     </div>
                  </div></center>
                  <div class="form-group row">
                     <label class="col-sm-2 col-form-label">To Intervention Date <font color="red">*</font></label>
                     <div class="col-sm-4">
                        <input type="text" class="form-control datepicker" data-date-end-date="0d" placeholder="To Date" autocomplete="off" readonly name="to_date" value="<?php if ($this->input->post('to_date')) { echo set_value('to_date'); } else { echo $currentDate; } ?>" style="background-color: white;">
                        <?php echo form_error('to_date'); ?>
                     </div>
                  </div>
               </div>
            </div>
            <button type="submit" name="date_submit" class="btn btn-primary" style="margin-left: 8px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
         </div>
      <?php
      } ?>
      <?php echo form_close(); ?>


      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
               <table id="table" class="table table-bordered table-striped">
                  <thead>
                     <tr class="custom_table_head">
                        <th class="text-center" rowspan="2">Sl. No</th>
                        <th class="text-center" rowspan="2">Jurisdiction</th>
                        <th class="text-center" rowspan="2">Total Due</th>
                        <th class="text-center" colspan="7">No. of days (in no. of days from Date of Intervention)</th>
                     </tr>
                     <tr class="custom_table_head">
                        <th class="text-center">Due Today</th>
                        <th class="text-center">1-7 days</th>
                        <th class="text-center">8-15 days</th>
                        <th class="text-center">16-30 days</th>
                        <th class="text-center">31-60 days</th>
                        <th class="text-center">61-90 days</th>
                        <th class="text-center">>90 days</th>
                     </tr>
                  </thead>
                  <tbody id="childAppend">
                     <?php
                     $c = 1;
                     if ($force_view == 1) {

                        $segregate_val = isset($_GET['segregate']) ? $_GET['segregate'] : $segregate; // check this one
                        $from_date_val = isset($_GET['from_date']) ? $_GET['from_date'] : $from_date;
                        $to_date_val = isset($_GET['to_date']) ? $_GET['to_date'] : $to_date;
                        $unique_id_val = isset($_GET['unique_id']) ? $_GET['unique_id'] : (isset($unique_id) ? $unique_id : null);
                        // URL for excel download
                        $url_download = base_url() . "admin/mis/follow_up_visit_due/Follow_up_visit_due_report/download_excel?segregate=" . $segregate . "&from_date=" . $from_date_val . "&to_date=" . $to_date_val . "&unique_id=" . $unique_id_val;

                        echo '<a href="' . $url_download . '" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>';


                        if (isset($report_result) && count($report_result) > 0) {
                     ?>
                           <?php foreach ($report_result as $value) {

                              $url = "";
                              if ($segregate != "ward_gp") {
                                 // echo "hello";
                                 $url = base_url() . "admin/mis/follow_up_visit_due/Follow_up_visit_due_report/follow_ups_due?segregate=" . $segregate . "&from_date=" . $from_date . "&to_date=" . $to_date . "&unique_id=" . $value['unique_id'];
                              }
                           ?>

                              <?php
                              if ($segregate == "ward_gp") {
                                 if (isset($is_ward)) {
                                    $gp_ward = 1; //WARD

                                 } elseif (isset($is_gp)) {
                                    $gp_ward = 2; //GP
                                 }
                              } else {
                                 $gp_ward = 0;
                              }

                              if ($segregate == "ward_gp") {
                                 $block_id = $block;
                              } else {
                                 $block_id = NULL;
                              }
                              // THIS BELOW LINK FOR VIEW COUNT DETAILS
                              $url_count = base_url() . "admin/mis/follow_up_visit_due/Follow_up_visit_due_report/follow_up_count_details?segregate=" . $segregate . "&from_date=" . $from_date . "&to_date=" . $to_date . "&unique_id=" . $value['unique_id'] . "&block_id=" . $block_id . "&check_ward_gp=" . $gp_ward . "&flag=" . " ";
                              ?>
                              <tr>
                                 <td><?php echo $c++; ?></td>

                                 <td style="text-align: left;">
                                    <?= (!empty($url) ? '<a href="' . $url . '">' : '') ?>
                                    <?php echo $value['name']; ?>
                                    <?= (!empty($url) ? '</a>' : '') ?>
                                 </td>
                                 <!-- 1,2,3,4,5,6,7 parameter passes for click on count details by days column -->
                                 <td style="text-align: right;">
                                    <center><a href="<?php echo $url_count . '1'; ?>"><?= ($value['total_due'] != 0) ? ($value['total_due']) : 0; ?></a></center>
                                 </td>

                                 <td style="text-align: right;">
                                    <center><a href="<?php echo $url_count . '0'; ?>"><?= ($value['due_today'] != 0) ? ($value['due_today']) : 0; ?></a></center>
                                 </td>

                                 <td style="text-align: right;">
                                    <center><a href="<?php echo $url_count . '2'; ?>"><?= ($value['pending_1_7_days'] != 0) ? ($value['pending_1_7_days']) : 0; ?></a></center>
                                 </td>

                                 <td style="text-align: right;">
                                    <center><a href="<?php echo $url_count . '3'; ?>"><?= ($value['pending_8_15_days'] != 0) ? ($value['pending_8_15_days']) : 0; ?></a></center>
                                 </td>

                                 <td style="text-align: right;">
                                    <center><a href="<?php echo $url_count . '4'; ?>"><?= ($value['pending_16_30_days'] != 0) ? ($value['pending_16_30_days']) : 0; ?></a></center>
                                 </td>

                                 <td style="text-align: right;">
                                    <center><a href="<?php echo $url_count . '5'; ?>"><?= ($value['pending_31_60_days'] != 0) ? ($value['pending_31_60_days']) : 0; ?></a></center>
                                 </td>

                                 <td style="text-align: right;">
                                    <center><a href="<?php echo $url_count . '6'; ?>"><?= ($value['pending_61_90_days'] != 0) ? ($value['pending_61_90_days']) : 0; ?></a></center>
                                 </td>

                                 <td style="text-align: right;">
                                    <center><a href="<?php echo $url_count . '7'; ?>"><?= ($value['pending_above_90_days'] != 0) ? ($value['pending_above_90_days']) : 0; ?></a></center>
                                 </td>
                              </tr>
                           <?php
                           } ?>
                           <?php
                           if (count($report_result) > 1) {
                           ?>
                  </tbody>
                  <tfoot>
                     <tr class="custom_table_head">
                        <td colspan="2"><center><b> Total </b> </center></td>
                        <td style="text-align: right;"><center><?php echo array_sum(array_column($report_result, 'total_due')); ?></center></td>
                        <td style="text-align: right;"><center><?php echo array_sum(array_column($report_result, 'due_today')); ?></center></td>
                        <td style="text-align: right;"><center><?php echo array_sum(array_column($report_result, 'pending_1_7_days')); ?></center></td>
                        <td style="text-align: right;"><center><?php echo array_sum(array_column($report_result, 'pending_8_15_days')); ?></center></td>
                        <td style="text-align: right;"><center><?php echo array_sum(array_column($report_result, 'pending_16_30_days')); ?></center></td>
                        <td style="text-align: right;"><center><?php echo array_sum(array_column($report_result, 'pending_31_60_days')); ?></center></td>
                        <td style="text-align: right;"><center><?php echo array_sum(array_column($report_result, 'pending_61_90_days')); ?></center></td>
                        <td style="text-align: right;"><center><?php echo array_sum(array_column($report_result, 'pending_above_90_days')); ?></center></td>

                     </tr>
                  </tfoot>
               <?php
                           }
                        } else { ?>
               <tr>
                  <td colspan="14" align="center">
                     <font color="#990000"> No Data Found !!! </font>
                  </td>
               </tr>
         <?php
                        }
                     }
         ?>
               </table>

            </div>
         </div>
         <div class="box-footer">
            <div class="panel-body">
               <?php if (isset($report_result) && count($report_result) > 0) { ?>
                  <h4 style="float: right;"><strong><span style="color: #040c52;">Generated On: </span><?php echo date("d-m-Y h:i:s A"); ?></strong></h4>
               <?php } ?>
            </div>
         </div>
      </div>


   </section>
</div>
<script type="text/javascript">
   $(document).ready(function() {
      $('#table').dataTable({
         "bDestroy": true
      }).fnDestroy();
   });
</script>

<?php $this->load->view($this->config->item('theme_uri') . 'layout/footer_view'); ?>
<script type="text/javascript">
   $(document).ready(function() {

      $('.toDateDatepicker').datepicker({
         changeMonth: true,
         changeYear: true,
         yearRange: '1900:+0',
         dateFormat: 'dd/mm/yy',
      });
      $('.fromDateDatepicker').datepicker({
         changeMonth: true,
         changeYear: true,
         yearRange: '1900:+0',
         dateFormat: 'dd/mm/yy',
      });

   });
</script>