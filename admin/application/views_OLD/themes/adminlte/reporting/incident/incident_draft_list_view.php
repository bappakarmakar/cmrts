<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
   @media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  .modal-body {
     width: auto;
     height: auto;
     overflow: visible !important;  
   }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
    width:100%;
    height:100%;
  }
  .modal-content * {
      visibility: visible;
      overflow: visible;
    }
    .main-page * {
      display: none;
    }
    .modal {
      position: absolute;
      left: 0;
      top: 0;
      margin: 0;
      padding: 0;
      min-height: 550px;
      visibility: visible;
      overflow: visible !important; 
    }
    .modal-dialog {
      visibility: visible !important;
      overflow: visible !important; 
    }
  }
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
      font-size: 20px;
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
      <h1>Intervention Report Draft List</h1>
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
                     <th colspan="4">Intervention</th>
                     <th colspan="4">Contracting Party 1</th>
                     <th colspan="4">Contracting Party 2</th>
                     <th colspan="2">Action</th>
                  </tr>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Intervention ID</th>
                     <th class="text-center">Intervention Date</th>
                     <th class="text-center">SD/Block</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">Ward/GP</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">Ward/GP</th>
                     <th class="text-center">Status</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php
                  if($this->session->userdata('stake_id_fk') == '4' || $this->session->userdata('stake_id_fk') == '2'){
                  $c = 1;
                  foreach($incident_details as $value){
                    // echo "<pre>";
                    // print_r($value);die();

                    $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_1_block_id);

                    if(!empty($cp_one_block_details)){    
                      if($cp_one_block_details->rural_urban == 'U'){
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_1_ward_gp);
                      }else{
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_1_ward_gp);
                      }
                    }else{
                      $cp_one_ward_gp_details = array();
                    }
                    
                    $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($value->cp_2_block_id);
                    if(!empty($cp_two_block_details)){
                      if($cp_two_block_details->rural_urban == 'U'){
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($value->cp_2_ward_gp);
                      }else{
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($value->cp_2_ward_gp);
                      }
                    }else{
                      $cp_two_ward_gp_details = array();
                    }
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php if($value->incident_date != ''){?><?php echo date('d-m-Y', strtotime($value->incident_date)); ?><?php } ?></td>
                     <td><?php echo $value->incident_block; ?></td>
                     <td><?php echo $value->cp_1_name; ?></td>
                     <td><?php echo $value->cp_1_gender_value; ?></td>
                     <!-- <td><?php echo $value->cp_1_age; ?></td> -->

                     <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_1_dob);?></td>


                     <td><?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?></td>
                     <td><?php echo $value->cp_2_name; ?></td>
                     <td><?php echo $value->cp_2_gender_value; ?></td>
                     <!-- <td><?php echo $value->cp_2_age; ?></td> -->

                     <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_2_dob);?></td>

                     <td><?=($cp_two_ward_gp_details)?$cp_two_ward_gp_details->cp_two_ward_gp:'';?></td>
                     <td><?php if($value->current_status == '1'){?><p style="color: red;">Draft Pending</p><?php }else{?><p style="color: green;">Draft Completed</p><?php } ?></td>
                     <td>
                        <div class="dropdown">
                          <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                            
                            <?php if($value->current_status == '1'){?>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_draft_form/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
                            <?php } ?>
                            <?php if($value->delete_status == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                              <?php } ?>
                          </ul>
                        </div>
                     </td>
                  </tr>
                  <?php } } ?>
                  <?php
                  if($this->session->userdata('stake_id_fk') == '3'){
                  $c = 1;
                  // echo"<pre>";print_r($incident_details);die;
                  foreach($incident_details as $value){

                    $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_1_block_id);

                    if(!empty($cp_one_block_details)){    
                      if($cp_one_block_details->rural_urban == 'U'){
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_1_ward_gp);
                      }else{
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_1_ward_gp);
                      }
                    }else{
                      $cp_one_ward_gp_details = array();
                    }
                    
                    $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($value->cp_2_block_id);
                    if(!empty($cp_two_block_details)){
                      if($cp_two_block_details->rural_urban == 'U'){
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($value->cp_2_ward_gp);
                      }else{
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($value->cp_2_ward_gp);
                      }
                    }else{
                      $cp_two_ward_gp_details = array();
                    }
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php if($value->incident_date != ''){?><?php echo date('d-m-Y', strtotime($value->incident_date)); ?><?php } ?></td>
                     <td><?php echo $value->incident_block; ?></td>
                     <td><?php echo $value->cp_1_name; ?></td>
                     <td><?php echo $value->cp_1_gender_value; ?></td>
                     <!-- <td><?php echo $value->cp_1_age; ?></td> -->

                     <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_1_dob);?></td>

                     <td><?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?></td>
                     <td><?php echo $value->cp_2_name; ?></td>
                     <td><?php echo $value->cp_2_gender_value; ?></td>
                     <!-- <td><?php echo $value->cp_2_age; ?></td> -->

                     <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_2_dob);?></td>

                     <td><?=($cp_two_ward_gp_details)?$cp_two_ward_gp_details->cp_two_ward_gp:'';?></td>
                     <td><?php if($value->current_status == '1'){?><p style="color: red;">Draft Pending</p><?php }else{?><p style="color: green;">Draft Completed</p><?php } ?></td>
                     <td>
                        <div class="dropdown">
                          <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                          <span class="caret"></span></button>
                          <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                            
                            <?php if($value->current_status == '1'){?>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/incident_draft_form/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
                            <?php } ?>

                            <!-- Delete Draft  -->
                            <?php if($value->delete_status == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                              <?php } ?>
                          </ul>
                        </div>
                     </td>
                  </tr>
                  <?php } } ?>
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

<script type="text/javascript">
  // Delete Incident List
   function Delete_Incident(rr_id){
      swal({
      title: "Are you sure delete this item?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Yes",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false,
      showLoaderOnConfirm: true
    },
    function(isConfirm){
      if(isConfirm){
          var incident_id = rr_id;
          $.ajax({
              url:"reporting/incident/incident_list/delete_incident",
              method:"GET",
              data:{incident_id:incident_id},
              dataType:"JSON",
              success:function(response)
              {
                  swal("Deleted!", "Deleted success", "success");
                  setTimeout(function(){
                     window.location.reload();
                  }, 2000);
              }
          });
      } else {
          swal("Cancelled", "Deleted cancel!", "error");
          setTimeout(function(){
             window.location.reload();
          }, 1500);
      } 
    });
   }

</script>
