<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
    th {
      font-size: 13px;
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
    .blink_me {
      animation: blinker 1s linear infinite;
    }
    @keyframes blinker {
      50% {
        opacity: 0;
      }
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Inbox List</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <div class="box-body">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">From</th>
                     <th class="text-center">District</th>
                     <th class="text-center">Block / Municipality</th>
                     <th class="text-center">Message</th>
                     <th class="text-center">Date & Time</th>
                     <th class="text-center">Status</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php $c = 1; 
                  foreach($inbox_details as $value){?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo $value['stake_holder_details'] ?></td>
                     <td><?php echo $value['district_name'] ?></td>
                     <td><?php echo $value['block_name'] ?></td>
                     <td><?php echo $value['message'] ?></td>
                     <td><?php echo date('d-m-Y | h:i A', strtotime($value['sending_time'])) ?></td>
                     <td><?php if($value['status'] == 0){?><span style="color: red;" class="blink_me">New</span><?php }else{ ?><span style="color: green;">Viewed</span><?php } ?></td>
                     <td><a href="<?php echo base_url()?>admin/notifications/inbox_view/view/<?php echo MD5($value['sl_no'])?>" class="btn btn-primary"><i class="fa fa-eye" aria-hidden="true"></i> View</a></td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
         <div class="box-footer">
         </div>
      </div>
   </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
$('table').DataTable();
</script>
