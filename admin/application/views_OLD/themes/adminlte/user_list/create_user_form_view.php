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
    .marq
    {
      margin-bottom: 5px;
      cursor: not-allowed;
      color: red;
    }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Create New User Form</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php
      $deo_user_block_check = array_column($deo_user_check, 'block');
      $total_deo = $deo_user_details[0]->total_deo;
      if($total_deo > 0){
        $total_deo_user = $deo_user_details[0]->total_deo+1;
      }else{
        $total_deo_user = $deo_user_details[0]->total_deo+1;
      }
      $login_id = "SDO"."."."DEO"."-".$total_deo_user.".".$subdiv_details[0]['subdiv_name'].".".$district_details[0]['district_name'];
      ?>
      <?php $this->load->view('errors/message'); ?>
      <?php echo form_open('admin/user_list/user/create_new_user', array('class' => 'PoliceCaseForm','name' => 'PoliceCaseForm', 'id' => 'PoliceCaseForm')) ?>
      <div class="box bottom-box">
         <div class="box-body">
            <div class="card-body">
              <!-- <?php if(!empty($deo_user_check)){ ?>
              <div class="marq">
                 <marquee onMouseOver="this.stop()" onMouseOut="this.start()">User already exists( <b><?=($deo_user_check)?$deo_user_check[0]['login_id']:''?></b> )</marquee>
              </div>
            <?php } ?>
              -->
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">First Name <font color="red">*</font></label>
                 <div class="col-sm-10">
                   <input type="text" name="f_name" class="form-control" autocomplete="off" placeholder="First Name" value="<?php echo set_value('f_name')?>">
                   <?php echo form_error('f_name');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">Last Name <font color="red">*</font></label>
                 <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="Last Name" autocomplete="off" name="l_name" value="<?php echo set_value('l_name')?>">
                   <?php echo form_error('l_name');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">Mobile No <font color="red">*</font></label>
                 <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="Mobile No" autocomplete="off" name="mobile_no" value="<?php echo set_value('mobile_no')?>" maxlength="10" onkeyup="number_validation()">
                   <?php echo form_error('mobile_no');?>
                   <?php if(isset($mobile_error_message)){ echo $mobile_error_message; } else { echo ""; }?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">District <font color="red">*</font></label>
                 <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="District" autocomplete="off" name="district" readonly value="<?php echo $district_details[0]['district_name']; ?>" style="cursor: not-allowed">
                   <input type="hidden" name="district_id" value="<?php echo $district_details[0]['district']; ?>">
                   <input type="hidden" name="suvdiv_id" value="<?php echo $district_details[0]['subdiv']; ?>">
                   <input type="hidden" name="subdiv_name" value="<?php echo $subdiv_details[0]['subdiv_name']; ?>">
                   <?php echo form_error('district');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">Block / Municipality <font color="red">*</font></label>
                 <div class="col-sm-10">
                    <select class="form-control" name="block" id="block">
                       <option value="" disabled selected>--Select Block / Municipality--</option>
                       <?php foreach($sdo_deo_level_block_name as $value){?>
                       <option <?=(in_array($value['block_id_pk'], $deo_user_block_check)) ? "disabled" : ""?> value="<?php echo $value['block_id_pk']; ?>" <?php echo set_select('block', $value['block_id_pk']); ?>><?php echo $value['block_name']; ?></option> 
                       <?php } ?>
                    </select>
                   <?php echo form_error('block');?>
                 </div>
               </div>
               <div class="form-group row">
                 <label class="col-sm-2 col-form-label">Email ID <font color="red">*</font></label>
                 <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="Email ID" autocomplete="off" name="email_id" value="<?php echo set_value('email_id')?>">
                   <?php echo form_error('email_id');?>
                 </div>
               </div>
               <div class="form-group row">

                <?php 
                  $username_val = null;

                  if(set_value('username'))
                  {
                     $username_val = set_value('username');
                  }

                ?>
                 <label class="col-sm-2 col-form-label">Username <font color="red">*</font></label>
                 <div class="col-sm-10">
                   <input type="text" class="form-control" placeholder="Username" autocomplete="off" name="username" value="<?= $username_val; ?>" readonly style="cursor: not-allowed">
                   <?php echo form_error('username');?>
                   <?php if(isset($username_error_message)){ echo $username_error_message; } else { echo ""; }?>
                 </div>
               </div>
            </div>
         </div>
         <div class="box bottom-box" style="text-align: center;">
            <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
         </div>
      </div>
      <?php echo form_close();?>
   </section>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
   $('table').DataTable();
</script>
<script type="text/javascript">
function number_validation() {
  var input = document.getElementById('mobile_no');
  var pattern = /^[6-9][0-9]{0,9}$/;
  var value = input.value;
  !pattern.test(value) && (input.value = value = '');
  input.addEventListener('input', function() {
     var currentValue = this.value;
     if(currentValue && !pattern.test(currentValue)) this.value = value;
     else value = currentValue;
  });
};
</script>


<script type="text/javascript">
function set_username() 
{
        // Get the selected option
        var selectedOption = $('#block').children("option:selected");
        var description = selectedOption.text();

         var description = description.replace(/\s+/g, '-');

        var district = $("input[name='district']").val();
        var subdiv_name = $("input[name='subdiv_name']").val();

        var user = "DEO."+description+"."+subdiv_name;

        console.log("Description:", user);

        $("input[name='username']").val(user);




}

 $('body').on('change','#block',function(){

  set_username();

 });
</script>