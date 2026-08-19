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
<script>
  function previous() {
    window.history.back();
  }
</script>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Pending Drafts Report</h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo base_url();?>admin/mis/pending_status_report/pending_status_report_view"><i class="fa fa-backward faico"></i>&nbsp;Back</a></li>
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
                  <a href="<?php echo base_url()?>admin/mis/pending_status_report/pending_status_report_view/SD_Block_Wise_Download_Excel/<?php echo $district_id; ?>/<?php echo $from_date; ?>/<?php echo $to_date; ?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
                 <thead>
                    <tr class="custom_table_head">
                       <th class="text-center" rowspan="2">Sl. No</th>
                       <th class="text-center" rowspan="2">Block/Municipality</th>
                       <th class="text-center" colspan="3">DEO Level</th>
                       <th class="text-center" colspan="4">BDO/SDO</th>
                       <th class="text-center" colspan="3">CMPO</th>
                    </tr>
                    <tr class="custom_table_head">
                      <th class="text-center">Pending as Drafts</th>
                      <th class="text-center">Completed but not forwarded</th>
                      <th class="text-center">Forwarded</th>

                      <th class="text-center">Pending as Drafts</th>
                      <th class="text-center">Completed but not published</th>
                      <th class="text-center">Received from DEO but not published</th>
                      <th class="text-center">Published</th>

                      <th class="text-center">Pending as Drafts</th>
                      <th class="text-center">Completed but not published</th>
                      <th class="text-center">Published</th>
                    </tr>
                 </thead>
                 <tbody id="childAppend">
                  <!-- <?php echo '<pre>'; print_r($report_result); ?> -->
                    <?php if(isset($report_result)){
                      $c = 1;
                      foreach($report_result as $value){
                    ?>
                    <tr>
                       <td><?php echo $c++; ?></td>
                       <td><a href="<?php echo base_url()?>admin/mis/pending_status_report/pending_status_report_view/ward_gp/<?php echo $value['block_id_pk']; ?>/<?php echo $from_date; ?>/<?php echo $to_date; ?>"><?php echo $value['block_name']?></a></td>

                       <td><?php if($value['deo_level_draft_pending_count'] != 0){ echo $value['deo_level_draft_pending_count']; } else { echo "0"; } ?></td>
                       <td><?php if($value['deo_level_not_forwarded_count'] != 0){ echo $value['deo_level_not_forwarded_count']; } else { echo "0"; } ?></td>
                       <td><?php if($value['deo_level_forwarded_count'] != 0){ echo $value['deo_level_forwarded_count']; } else { echo "0"; } ?></td>


                       <td><?php if($value['bdo_sdo_level_draft_pending_count'] != 0){ echo $value['bdo_sdo_level_draft_pending_count']; } else { echo "0"; } ?></td>
                       <td><?php if($value['bdo_sdo_level_not_publish_count'] != 0){ echo $value['bdo_sdo_level_draft_pending_count']; } else { echo "0"; } ?></td>

                       <!-- <td>0</td> -->
                       <td><?php if($value['bdo_sdo_level_received_deo_not_published_count'] != 0){ echo $value['bdo_sdo_level_received_deo_not_published_count']; } else { echo "0"; } ?></td>
                       <td><?php if($value['bdo_sdo_level_published_count'] != 0){ echo $value['bdo_sdo_level_published_count']; } else { echo "0"; } ?></td>
                      
                      
                      <td><?php if($value['cmpo_level_draft_pending_count'] != 0){ echo $value['cmpo_level_draft_pending_count']; } else { echo "0"; } ?></td>
                      <td><?php if($value['cmpo_level_draft_forward_pending_count'] != 0){ echo $value['cmpo_level_draft_forward_pending_count']; } else { echo "0"; } ?></td>
                      <td><?php if($value['cmpo_level_published_count'] != 0){ echo $value['cmpo_level_published_count']; } else { echo "0"; } ?></td>
                    </tr>
                    <?php } } ?>
                 </tbody>
                 <?php 
                    if(count($report_result)>1)
                    {
                      ?>
                      <tfoot>
                        <tr class="custom_table_head">
                          <td colspan="2">Total</td>
                          <td><?php echo array_sum(array_column($report_result, 'deo_level_draft_pending_count'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'deo_level_not_forwarded_count'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'deo_level_forwarded_count'));?></td>


                          <td><?php echo array_sum(array_column($report_result, 'bdo_sdo_level_draft_pending_count'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'bdo_sdo_level_not_publish_count'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'bdo_sdo_level_received_deo_not_published_count'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'bdo_sdo_level_published_count'));?></td>

                          <td><?php echo array_sum(array_column($report_result, 'cmpo_level_draft_pending_count'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'cmpo_level_draft_forward_pending_count'));?></td>
                          <td><?php echo array_sum(array_column($report_result, 'cmpo_level_published_count'));?></td>


                        </tr>
                      </tfoot>
                      <?php 
                    }  
                    ?>
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