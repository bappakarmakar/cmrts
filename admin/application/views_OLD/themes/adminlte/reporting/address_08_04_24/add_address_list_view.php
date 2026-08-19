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
   .label-div
   {
      display: flex;
      justify-content: end;
   }
   .inp
   {
      width: 24%;
      margin-left: 10px;
   }
   .otp-input-fields
   {
      display: flex;
   }
  .otp-input-fields input[type=number]
  {
    width: 20%;
    background-color: #0000000d;
    margin-right: 5px;
    outline: none;
    border: none;
  }
  .otp-input-fields {
      background-color: white;
      width: auto;
      display: flex;
      justify-content: center;
      gap: 10px;
    }
    .otp-input-fields input {
      height: 34px;
      width: 40px;
      background-color: transparent;
      border-radius: 0px;
      border: 1px solid #0b1b52;
      text-align: center;
      outline: none;
      font-size: 16px;
      border: 1px solid #ccc!important;
    }
    .otp-input-fields input::-webkit-outer-spin-button, .otp-input-fields input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .otp-input-fields input[type=number] {
      -moz-appearance: textfield;
    }
    .otp-input-fields input:focus {
      border-width: 2px;
      border-color: #287a1a;
      font-size: 20px;
    }
    .des-loc
    {
       display: flex;
       flex-wrap: wrap;
    }
    .inp-radio
    {
       width: 28%;
    }
   .inp-inf
   {
    float: right;
   }
   .left-form
   {
    position: relative;
   }
   .Information_Received
   {
    position: absolute;
    right: 75px;
    top:0;
    text-align: right;
   }
   .Information_Received h5 
   {
     text-align: right;
   }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Incident Report List</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <a href="javascript:void()" onclick="expand()" class="btn btn-warning" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Expand</a>
         <div class="box-body" id="box-table">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th colspan="4">Incident</th>
                     <th colspan="4">Contracting Party 1</th>
                     <th colspan="4">Contracting Party 2</th>
                     <th colspan="2">Action</th>
                  </tr>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Incident ID</th>
                     <th class="text-center">Incident Date</th>
                     <th class="text-center">Block / Municipality</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">Address</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">Address</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php
                  if($this->session->userdata('stake_id_fk') == '4'){
                  $c = 1;
                  foreach($incident_details as $value){
                    $cp_one_cwc_details = get_cp_one_cwc_details($value->incident_id_pk);
                    $cp_two_cwc_details = get_cp_two_cwc_details($value->incident_id_pk);

                    $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_one_block_id);
                    if(!empty($cp_one_block_details)){
                      if($cp_one_block_details->rural_urban == 'U'){
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_one_ward_gp);
                      }else{
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_one_ward_gp);
                      }
                    }

                    $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($value->cp_two_block_id);
                    if(!empty($cp_two_block_details)){
                      if($cp_two_block_details->rural_urban == 'U'){
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($value->cp_two_ward_gp);
                      }else{
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($value->cp_two_ward_gp);
                      }
                    }

                    $cp_one_add_address_and_edit_check = Get_CP_One_Current_Address_Count_Check($value->incident_id_pk);

                    $cp_two_add_address_and_edit_check = Get_CP_Two_Current_Address_Count_Check($value->incident_id_pk);
                    
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td><?php echo $value->incident_block; ?></td>
                     <td><?php echo $value->cp_one_name; ?></td>
                     <td><?php echo $value->cp_one_gender_value; ?></td>
                     <td><?php echo $value->cp_one_age; ?></td>
                     <?php if($value->cp_one_state == 1){?>
                     <td><?php echo $value->cp_one_district;?><br><?php echo $value->cp_one_block?><br><?php echo $cp_one_ward_gp_details->cp_one_ward_gp;?></td>
                     <?php }else{ ?>
                     <td><?php echo $value->cp_one_address;?></td>
                     <?php } ?>
                     <td><?php echo $value->cp_two_name; ?></td>
                     <td><?php echo $value->cp_two_gender_value; ?></td>
                     <td><?php echo $value->cp_two_age; ?></td>
                     <?php if($value->cp_two_state == 1){?>
                     <td><?php echo $value->cp_two_district;?><br><?php echo $value->cp_two_block; ?><br><?php echo $cp_two_ward_gp_details->cp_two_ward_gp;?></td>
                     <?php }else{?>
                     <td><?php echo $value->cp_two_address;?></td>
                     <?php } ?>
                    <?php if($value->cp_one_state!=2 AND $value->cp_two_state!=2)
                    {
                      ?>
                       <td>

                        <!-- CP One Address Add & Delete -->
                        <?php if($cp_one_add_address_and_edit_check == 0 && $value->forward_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                        <a class="btn btn-info" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_one_current_address/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Add CP 1 Address</a>

                        <?php }elseif($cp_one_add_address_and_edit_check == 1 && $value->forward_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                        <a class="btn btn-warning" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_one_current_address/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit CP 1 Address</a>
                        <?php } ?>

                        <!-- CP Two Address Add & Delete -->
                        <?php if($cp_two_add_address_and_edit_check == 0 && $value->forward_status == 101 && $value->cp_two_is_available == 1 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                        <a class="btn btn-primary" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_two_current_address/<?php echo base64_encode($value->incident_id_pk); ?>" style="margin-top: 10px;"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Add CP 2 Address</a>

                        <?php }elseif($cp_two_add_address_and_edit_check == 1 && $value->forward_status == 101 && $value->cp_two_is_available == 1 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                        <a class="btn btn-warning" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_two_current_address/edit/<?php echo base64_encode($value->incident_id_pk); ?>" style="margin-top: 10px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit CP 2 Address</a>

                        <?php } ?>
                       </td>
                      <?php }else{echo'<td style= "color:red">CP1 and or CP2 is out of west Bengal</td>';} ?>
                  </tr>
                  <?php } } ?>
                  <?php
                  if($this->session->userdata('stake_id_fk') == '2'){
                  $c = 1;
                  foreach($incident_details as $value){
                    $cp_one_cwc_details = get_cp_one_cwc_details($value->incident_id_pk);
                    $cp_two_cwc_details = get_cp_two_cwc_details($value->incident_id_pk);

                    $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_one_block_id);
                    if(!empty($cp_one_block_details)){
                      if($cp_one_block_details->rural_urban == 'U'){
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_one_ward_gp);
                      }else{
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_one_ward_gp);
                      }
                    }

                    $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($value->cp_two_block_id);
                    if(!empty($cp_two_block_details)){
                      if($cp_two_block_details->rural_urban == 'U'){
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($value->cp_two_ward_gp);
                      }else{
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($value->cp_two_ward_gp);
                      }
                    }

                    $cp_one_add_address_and_edit_check = Get_CP_One_Current_Address_Count_Check($value->incident_id_pk);

                    $cp_two_add_address_and_edit_check = Get_CP_Two_Current_Address_Count_Check($value->incident_id_pk);
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td><?php echo $value->incident_block; ?></td>
                     <td><?php echo $value->cp_one_name; ?></td>
                     <td><?php echo $value->cp_one_gender_value; ?></td>
                     <td><?php echo $value->cp_one_age; ?></td>
                     <?php if($value->cp_one_state == 1){?>
                     <td><?php echo $value->cp_one_district;?><br><?php echo $value->cp_one_block?><br><?php echo $cp_one_ward_gp_details->cp_one_ward_gp;?></td>
                     <?php }else{ ?>
                     <td><?php echo $value->cp_one_address;?></td>
                     <?php } ?>
                     <td><?php echo $value->cp_two_name; ?></td>
                     <td><?php echo $value->cp_two_gender_value; ?></td>
                     <td><?php echo $value->cp_two_age; ?></td>
                     <?php if($value->cp_two_state == 1){?>
                     <td><?php echo $value->cp_two_district;?><br><?php echo $value->cp_two_block; ?><br><?php echo $cp_two_ward_gp_details->cp_two_ward_gp;?></td>
                     <?php }else{?>
                     <td><?php echo $value->cp_two_address;?></td>
                     <?php } ?>
                     <?php if($value->cp_one_state!=2 AND $value->cp_two_state!=2)
                     {
                      ?>
                     <td>
                      <!-- CP One Address Add & Delete -->
                      <?php if($cp_one_add_address_and_edit_check == 0 && $value->forward_status == 102 && $value->publish_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                      <a class="btn btn-info" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_one_current_address/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Add CP 1 Address</a>

                      <?php }elseif($cp_one_add_address_and_edit_check == 1 && $value->forward_status == 102 && $value->publish_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                      <a class="btn btn-warning" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_one_current_address/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit CP 1 Address</a>


                      <?php } ?>

                      <!-- CP Two Address Add & Delete -->
                      <?php if($cp_two_add_address_and_edit_check == 0 && $value->forward_status == 102 && $value->cp_two_is_available == 1 && $value->publish_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                      <a class="btn btn-primary" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_two_current_address/<?php echo base64_encode($value->incident_id_pk); ?>" style="margin-top: 10px;"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Add CP 2 Address</a>

                      <?php }elseif($cp_two_add_address_and_edit_check == 1 && $value->forward_status == 102 && $value->cp_two_is_available == 1 && $value->publish_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                      <a class="btn btn-warning" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_two_current_address/edit/<?php echo base64_encode($value->incident_id_pk); ?>" style="margin-top: 10px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit CP 2 Address</a>

                      <?php } ?>
                     </td>
                     <?php }else{echo'<td style= "color:red">CP1 and or CP2 is out of west Bengal</td>';} ?>
                  </tr>
                  <?php } } ?>
                  <?php
                  if($this->session->userdata('stake_id_fk') == '3'){
                  $c = 1;
                  foreach($incident_details as $value){
                    $cp_one_cwc_details = get_cp_one_cwc_details($value->incident_id_pk);
                    $cp_two_cwc_details = get_cp_two_cwc_details($value->incident_id_pk);

                    $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_one_block_id);
                    if(!empty($cp_one_block_details)){
                      if($cp_one_block_details->rural_urban == 'U'){
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($value->cp_one_ward_gp);
                      }else{
                        $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($value->cp_one_ward_gp);
                      }
                    }

                    $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($value->cp_two_block_id);
                    if(!empty($cp_two_block_details)){
                      if($cp_two_block_details->rural_urban == 'U'){
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($value->cp_two_ward_gp);
                      }else{
                        $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($value->cp_two_ward_gp);
                      }
                    }

                    $cp_one_add_address_and_edit_check = Get_CP_One_Current_Address_Count_Check($value->incident_id_pk);

                    $cp_two_add_address_and_edit_check = Get_CP_Two_Current_Address_Count_Check($value->incident_id_pk);
                  ?>
                  <tr>
                     <td><?php echo $c++; ?></td>
                     <td><?php echo $value->reporting_id; ?></td>
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td><?php echo $value->incident_block; ?></td>
                     <td><?php echo $value->cp_one_name; ?></td>
                     <td><?php echo $value->cp_one_gender_value; ?></td>
                     <td><?php echo $value->cp_one_age; ?></td>
                     <?php if($value->cp_one_state == 1){?>
                     <td><?php echo $value->cp_one_district;?><br><?php echo $value->cp_one_block?><br><?php echo $cp_one_ward_gp_details->cp_one_ward_gp;?></td>
                     <?php }else{ ?>
                     <td><?php echo $value->cp_one_address;?></td>
                     <?php } ?>
                     <td><?php echo $value->cp_two_name; ?></td>
                     <td><?php echo $value->cp_two_gender_value; ?></td>
                     <td><?php echo $value->cp_two_age; ?></td>
                     <?php if($value->cp_two_state == 1){?>
                     <td><?php echo $value->cp_two_district;?><br><?php echo $value->cp_two_block; ?><br><?php echo $cp_two_ward_gp_details->cp_two_ward_gp;?></td>
                     <?php }else{?>
                     <td><?php echo $value->cp_two_address;?></td>
                     <?php } ?>
                     <?php if($value->cp_one_state!=2 AND $value->cp_two_state!=2)
                     {
                      ?>
                     <td>
                      <!-- CP One Address Add & Delete -->
                      <?php if($cp_one_add_address_and_edit_check == 0 && $value->forward_status == 102 && $value->publish_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                      <a class="btn btn-info" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_one_current_address/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Add CP 1 Address</a>

                      <?php }elseif($cp_one_add_address_and_edit_check == 1 && $value->forward_status == 102 && $value->publish_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                      <a class="btn btn-warning" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_one_current_address/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit CP 1 Address</a>

                      <?php } ?>

                      <!-- CP Two Address Add & Delete -->
                      <?php if($cp_two_add_address_and_edit_check == 0 && $value->forward_status == 102 && $value->cp_two_is_available == 1 && $value->publish_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                      <a class="btn btn-primary" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_two_current_address/<?php echo base64_encode($value->incident_id_pk); ?>" style="margin-top: 10px;"><i class="fa fa-address-card" aria-hidden="true"></i>&nbsp;&nbsp;Add CP 2 Address</a>

                      <?php }elseif($cp_two_add_address_and_edit_check == 1 && $value->forward_status == 102 && $value->cp_two_is_available == 1 && $value->publish_status == 101 && $value->stake_holder_id_fk == $this->session->userdata('stake_holder_login_id_pk')){?>

                      <a class="btn btn-warning" href="<?php echo base_url()?>admin/reporting/address/address_list/add_cp_two_current_address/edit/<?php echo base64_encode($value->incident_id_pk); ?>" style="margin-top: 10px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit CP 2 Address</a>
                      
                      <?php } ?>
                     </td>
                      <?php }else{echo'<td style= "color:red">CP1 and or CP2 is out of west Bengal</td>';} ?>
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
function expand(){
document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
}
</script>