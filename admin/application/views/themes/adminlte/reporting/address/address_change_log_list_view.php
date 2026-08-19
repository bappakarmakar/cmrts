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
    .dataTables_filter {
      display: block;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Address Change Log List</h1>
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
                     <th class="text-center">Intervention Date</th>
                     <th class="text-center">Intervention ID</th>
                     <!-- <th class="text-center">Contracting party</th> -->
                     <th class="text-center">Ward/GP</th>
                     <th class="text-center">Name</th>
                     
                     <th class="text-center">Age at Intervention</th>
                     <!-- <th class="text-center">status</th> -->
                     <th class="text-center">Minor/Adult</th>
                     
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php 
                  $c = 1;
                  //echo "<pre>";print_r($home_visits_total_details);
                  foreach($home_visits_total_details as $value){
                     if($value->cp_age<18)
                    {
                       $value->minor_adult_status = "Minor";
                    }
                    else
                    {
                      $value->minor_adult_status = "Adult";
                    }

                

                    $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_block);
                    if(!empty($cp_one_block_details)){
                      if($cp_one_block_details->rural_urban == 'U'){
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_ward_gp);
                      }else{
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_ward_gp);
                      }
                    }else{
                      $cp_one_ward_gp_details = array();
                    }
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <!-- <td><?php echo $value->cp_type; ?></td> -->
                     <td><?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?></td>
                     <td><?php echo $value->cp_name; ?></td>
                     
                     <td><?php echo $value->cp_age; ?></td>
                     <!-- <td><?php //echo $value->hv_status; ?></td> -->
                     <td><?php echo $value->minor_adult_status; ?></td>
                     
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
function expand(){
document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
}
</script>

<script type="text/javascript">

   $('#reset_btn').click(function() {
       location.reload();
   });
</script>