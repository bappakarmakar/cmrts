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
    .btn-danger {
        margin-top: 15px;
        margin-bottom: 20px;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Search All Users</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <?php echo form_open('admin/user_list/user/export_all_users', array('class' => 'PoliceCaseForm','name' => 'PoliceCaseForm', 'id' => 'PoliceCaseForm')) ?>
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">User Type <font color="red">*</font></label>
                 <div class="col-sm-10">
                   <select class="form-control all_users" name="user_type" id="user_type">
                     <option value="0" disabled selected>--Select User Type--</option>
                     <option value="3" <?php echo set_select('user_type', '3', False); ?>>CMPO</option>
                     <option value="6" <?php echo set_select('user_type', '6', False); ?>>SDO</option>
                     <option value="2" <?php echo set_select('user_type', '2', False); ?>>BDO</option>
                     <option value="4" <?php echo set_select('user_type', '4', False); ?>>DEO</option>
                   </select>
                   <?php echo form_error('user_type');?>
                 </div>
               </div>
               <div class="form-group row" id="district_div">
                 <label class="col-sm-2 col-form-label">District</label>
                 <div class="col-sm-10">
                   <select class="form-control" name="district" id="district">
                     <option value="0" disabled selected>--Select District--</option>
                     <?php foreach($districts as $value){?>
                      <option value="<?php echo $value['district_id_pk'];?>" <?php echo set_select('district', $value['district_id_pk'], False); ?>><?php echo $value['district_name']?></option>
                     <?php } ?>
                   </select>
                   <?php echo form_error('district');?>
                 </div>
               </div>
               <div class="form-group row" id="block_div">
                 <label class="col-sm-2 col-form-label">Block / Municipality</label>
                 <div class="col-sm-10">
                   <select class="form-control" name="block" id="block">
                     <option value="0" disabled selected>--Select District First--</option>
                     <?php foreach($block as $value){?>
                      <option value="<?php echo $value['block_id_pk']?>" <?php echo set_select('block', $value['block_id_pk'], False); ?>><?php echo $value['block_name']?></option>
                     <?php } ?>
                   </select>
                   <?php echo form_error('block');?>
                 </div>
               </div>
            </div>
         </div>
         <div class="box bottom-box" style="text-align: center;">
            <button type="submit" name="search_users" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
         </div>
      </div>
      <?php echo form_close();?>
      <?php if(isset($_POST['search_users']) && count($this->form_validation->error_array()) == 0){?>
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
               <table class="table table-bordered table-hover">
                  <a href="<?php echo base_url()?>admin/user_list/user/downlod_excel/<?php echo base64_encode($this->input->post('user_type')); ?>/<?php echo base64_encode($this->input->post('district')); ?>/<?php echo base64_encode($this->input->post('block')); ?>" class="btn btn-success" style="margin-bottom: 15px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download Excel</a>
                 <thead>
                    <tr class="custom_table_head">
                       <th class="text-center">Sl. No</th>
                       <th class="text-center">User Type</th>
                       <th class="text-center">District</th>
                       <?php
                       $user_type_array = array(3, 6);
                       if (!in_array($_POST['user_type'], $user_type_array)){ ?>
                        <th class="text-center">Block / Municipality</th>
                       <?php } ?>
                       <th class="text-center">Username</th>
                       <th class="text-center">Password</th>
                    </tr>
                 </thead>
                 <tbody id="childAppend">
                    <?php 
                    $c = 1; 
                    foreach($users_details_result as $value){
                      if($this->input->post('user_type') == 3){
                        $user_type = "CMPO";
                      }elseif($this->input->post('user_type') == 6){
                        $user_type = "SDO";
                      }elseif($this->input->post('user_type') == 2){
                        $user_type = "BDO";
                      }elseif($this->input->post('user_type') == 4){
                        $user_type = "DEO";
                      }
                    ?>
                    <tr>
                       <td><?php echo $c++; ?></td>
                       <td><?php echo $user_type?></td>
                       <td><?php echo $value['district_name']?></td>
                       <?php
                       if (!in_array($_POST['user_type'], $user_type_array)){ ?>
                         <td><?php echo $value['block_name']?></td>
                       <?php } ?>
                       <td><?php echo $value['login_id']?></td>
                       <td><?php echo $value['base_password']?></td>
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
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
   $('table').DataTable();
</script>
<script type="text/javascript">
$(document).on('change','#district',function(){
   if($( "#district option:selected" ).val()!="")
   {
      var id = $('#district').val()
      $.ajax({
          url:'<?php echo base_url()?>admin/reporting/incident/incident_form/getBlockById',
          type:'GET',
          data:{'id':id}, 
          dataType: 'json',
          success: function(data)
          {
             $('#block').html('');
             $('#block').html('<option value="0" disabled selected>--Select Block / Municipality--</option>');
             data.forEach(element =>$("#block").append($('<option></option>').val(element['block_id_pk']).html(element['block_name'])));
             var v = $( "#block option:selected" ).val();
          }
      });
   }
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  var user_type = $('#user_type').val()
   if(user_type == 3){
      $("#district_div").show();
      $("#block_div").hide();
   }else if(user_type == 6){
      $("#district_div").show();
      $("#block_div").hide();
   }else if(user_type == 2){
      $("#district_div").show();
      $("#block_div").show();
   }else if(user_type == 4){
      $("#district_div").show();
      $("#block_div").show();
   }else{
      $("#district_div").show();
      $("#block_div").show();
   }

   $(".all_users").change(function(){
       var user_type = $('#user_type').val()
       if(user_type == 3){
          $("#district_div").show();
          $("#block_div").hide();
       }else if(user_type == 6){
          $("#district_div").show();
          $("#block_div").hide();
       }
       else{
          $("#district_div").show();
          $("#block_div").show();
       }
   });
});
</script>