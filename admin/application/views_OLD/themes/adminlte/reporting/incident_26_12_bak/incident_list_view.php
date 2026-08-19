<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>
<style>
/*   input[type="radio"] {
   cursor: not-allowed;
   }*/
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
      <h1>Intervention Report List</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
         <div id="date_div" style="display:none">
            <form id="advanced_search_form">
               <div class="box-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-sm-4">
                           <label>From Date (dd/mm/yyyy) <font color="red">*</font></label>
                           <input type="text" class="form-control datepicker" data-date-end-date="0d" id="start_date" placeholder="Start Date" readonly autocomplete="off" name="incident_date" value="<?php echo set_value('incident_date'); ?>" style="background-color: white;" tabindex="7">
                        </div>
                        <div class="col-sm-4">
                           <label>To Date (dd/mm/yyyy) <font color="red">*</font></label>
                           <input type="text" class="form-control datepicker" data-date-end-date="0d" id="end_date" placeholder="End Date" readonly autocomplete="off" name="incident_date" value="<?php echo set_value('incident_date'); ?>" style="background-color: white;" tabindex="7">
                        </div>
                        <div class="col-sm-4">
                           <button type="submit" id="search_btn" class="btn btn-info" style="margin-top: 25px;"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                           <button type="button" id="reset_btn" class="btn btn-danger" style="margin-top: 25px;"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <a href="javascript:void()" onclick="expand()" class="btn btn-warning" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Expand</a>
         <a href="<?php echo base_url()?>admin/reporting/incident/incident_list/list_download" id="download_btn" class="btn btn-success" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-download" aria-hidden="true"></i> List Download</a>
         <a href="<?php echo base_url()?>admin/reporting/incident/incident_list/list_print/" id="btnPrint2" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>
         <a href="javascript:void()" id="advanced_search_btn" class="btn btn-info" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-search" aria-hidden="true"></i> Advanced Date Search </a>
         <?php if($this->session->userdata('stake_id_fk') == '4' || $this->session->userdata('stake_id_fk') == '3' || $this->session->userdata('stake_id_fk') == '2'){?>
         <a href="<?php echo base_url()?>admin/reporting/incident/incident_form" class="btn btn-primary" style="margin-top: 8px; float: right; margin-right: 10px;margin-bottom: 12px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Intervention</a>
         <?php } ?>
         <?php //echo "<pre>";print_r($incident_details); ?>
         <?php //echo "<pre>";print_r($_SESSION);exit; ?>
         <div class="box-body" id="box-table">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th colspan="4">Intervention</th>
                     <th colspan="5">Contracting Party 1</th>
                     <th colspan="5">Contracting Party 2</th>
                     <th colspan="1">Status</th>
                     <th colspan="1">Action</th>
                  </tr>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Intervention ID</th>
                     <th class="text-center">Intervention Date</th>
                     <th class="text-center">Block / Municipality</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">Address</th>
                     <th class="text-center">CP 1 Status</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">Address</th>
                     <th class="text-center">CP 2 Status</th>
                     <th class="text-center">Status</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php
                     // echo '<pre>';print_r($incident_details);
                     $c = 1;
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
                     <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                     <td><?php echo $value->incident_block; ?></td>
                     <td><?php echo $value->cp_1_name; ?></td>
                     <td><?php echo $value->cp_1_gender_value; ?></td>
                     <td><?php echo $value->cp_1_age; ?></td>

                     <?php if($value->cp_1_state == 1){?>
                     <td>
                        <?php echo $value->cp_1_district;?>,<br>
                        <?php echo $value->cp_1_block?>,<br>
                        <?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?>
                     </td>
                     <?php }else{ ?>
                     <td><?php echo $value->cp_1_address;?></td>
                     <?php } ?>

                     <td><?php echo cp_status($value->current_status, $value->cp_1_id_pk, $value->cp_1_age);?> </td>
                     <td><?php echo $value->cp_2_name; ?></td>
                     <td><?php echo $value->cp_2_gender_value; ?></td>
                     <td><?php echo $value->cp_2_age; ?></td>
                     <?php if($value->cp_2_state == 1){?>
                     <td>
                        <?php echo $value->cp_2_district;?>,<br>
                        <?php echo $value->cp_2_block; ?>,<br>
                        <?=($cp_two_ward_gp_details)?$cp_two_ward_gp_details->cp_two_ward_gp:'';?>
                     </td>
                     <?php }else{?>
                     <td><?php echo $value->cp_2_address;?></td>
                     <?php } ?>
                     <!-- <td><?php echo $value->cp_two_is_available; ?></td> -->

                   <?php if($value->cp_two_is_available==1)
                   { 
                     ?>  
                     <td><?php echo cp_status($value->current_status, $value->cp_2_id_pk, $value->cp_2_age);?></td>
                     <?php
                   }elseif ($value->cp_two_is_available==2 || $value->cp_two_is_available =='') 
                   {
                     echo '<td>CP2 is not available</td>';
                   }else
                   {
                     echo '<td></td>';
                   }
                  ?>
                  


                     <td>
                        <?php
                        $created_at = $value->created_at;
                        $current_status = $value->current_status;
                        if($current_status==1 && !empty($created_at)){
                           echo 'Saved';
                        }else{
                           echo Get_CP_Current_Status($value->current_status);
                        }

                         ?>
                      </td>
                     
                     <td>
                        <div class="dropdown" style="">
                           <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                           <span class="caret"></span></button>
                           <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal<?php echo $value->incident_id_pk?>"><i class="fa fa-eye" aria-hidden="true"></i>View Details</a></li>
                              <!-- For DEO -->
                              <?php if($this->session->userdata('stake_id_fk') == '4'){
                                 if($value->current_status == 1 && $value->created_at != ''){
                                 ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
                              <?php if($value->delete_status == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                              <?php } ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Forward_Details('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Forward</a></li>
                              <?php } ?> 

                              <!--------- Follow-Up Visit Start ---------->

                              <?php if($value->current_status == 3) {?>    
                              <?php if($value->cp_1_age < 18 && Get_CP_Homevisit_Count($value->cp_1_id_pk) > 0){?>
                              <?php if(Get_CP_Address_details_Count($value->cp_1_id_pk) > 0){
                                 if(Get_CP_Address_details_block($value->cp_1_id_pk) == $this->session->userdata('block')){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 1 Follow-Up Visit</a></li>
                              <?php }
                                 }elseif($this->session->userdata('block') == $value->cp_1_block_id){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 1 Follow-Up Visit</a></li>
                              <?php } ?>  
                              <?php } ?>

                              <!------For CP 2------>

                              <?php if($value->cp_2_age < 18 && Get_CP_Homevisit_Count($value->cp_2_id_pk) > 0){?>
                              <?php if(Get_CP_Address_details_Count($value->cp_2_id_pk) > 0){?>
                              <?php if(Get_CP_Address_details_block($value->cp_2_id_pk) == $this->session->userdata('block')){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 2 Follow-Up Visit</a></li>
                              <?php } ?>
                              <?php }elseif($this->session->userdata('block') == $value->cp_2_block_id){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 2 Follow-Up Visit</a></li>
                              <?php } ?>
                              <?php } ?>
                              <?php } ?>

                              <!---------- Follow-Up Visit End ------------>

                              <!---------- Home Visit Start ----------->

                              <?php if($value->current_status == 3){
                                 //home visit for cp 1
                                 if($value->cp_1_age < 18){
                                   
                                   if($this->session->userdata('block') == $value->cp_1_block_id && Get_CP_Homevisit_Count($value->cp_1_id_pk) == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_minor_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 1 Home Visit Minor</a></li>
                              <?php } ?> 
                              <?php }else if($value->cp_1_age >= 18){
                                 if($this->session->userdata('block') == $value->cp_1_block_id && Get_CP_Homevisit_Count($value->cp_1_id_pk) == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_adult_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 1 Home Visit Adult</a></li>
                              <?php } ?>
                              <?php }
                                 //home visit for cp 2
                                 if($value->cp_2_age < 18){
                                   if($this->session->userdata('block') == $value->cp_2_block_id && Get_CP_Homevisit_Count($value->cp_2_id_pk) == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_minor_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 2 Home Visit Minor</a></li>
                              <?php } ?> 
                              <?php }else if($value->cp_2_age > 18){
                                 if($this->session->userdata('block') == $value->cp_2_block_id && Get_CP_Homevisit_Count($value->cp_2_id_pk) == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_adult_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 2 Home Visit Adult</a></li>
                              <?php } ?>
                              <?php } ?>      
                              <?php } ?>

                              <!------------ Home Visit End ------------>

                              <?php if($value->current_status == 3){
                                 if($value->cp_1_age < 18){
                                   if($this->session->userdata('block') == $value->cp_1_block_id){
                                 ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/police_cases/<?=base64_encode($value->incident_id_pk).'/'.base64_encode($value->cp_1_id_pk).'/'.base64_encode($value->cp_1_type);?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>Police Cases</a></li>
                              <?php } }elseif($value->cp_2_age < 18){
                                 if($this->session->userdata('block') == $value->cp_2_block_id){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/police_cases/<?=base64_encode($value->incident_id_pk).'/'.base64_encode($value->cp_2_id_pk).'/'.base64_encode($value->cp_2_type);?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>Police Cases</a></li>
                              <?php } } ?>
                              <?php } ?>
                              <?php } ?>
                              <!-- End DEO -->
                              <!-- For BDO-->
                              <?php if($this->session->userdata('stake_id_fk') == '2'){
                                 if($value->current_status == 1 || $value->current_status == 2){
                                 ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
                              <?php if($value->delete_status == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                              <?php } ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Publish_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Publish Intervention</a></li>
                              <?php } ?>
                              <?php if($value->current_status == 3){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/address_change/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>Address Change</a></li>
                              <li role="presentation"><a role="menuitem" href="javascript:void()" onClick="Transfer_CCI_Details('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-exchange" aria-hidden="true"></i>Transfer to CCI (CMPO)</a></li>
                              <?php } } ?>
                              <!-- End BDO-->

                              <!-- For SDO -->
                              <?php if($this->session->userdata('stake_id_fk') == '6'){
                                 if($value->rural_urban == 'U'){
                                 if($value->current_status == 1 || $value->current_status == 2){
                                 ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
                              <?php if($value->delete_status == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                              <?php } ?>
                                 <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Publish_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Publish Intervention</a></li>
                              <?php } ?>
                              <?php if($value->current_status == 3){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/address_change/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>Address Change</a></li>
                              <li role="presentation"><a role="menuitem" href="javascript:void()" onClick="Transfer_CCI_Details('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-exchange" aria-hidden="true"></i>Transfer to CCI (CMPO)</a></li>
                              <?php } } }?>
                              <!-- End SDO -->

                              <!-- For CMPO-->
                              <?php if($this->session->userdata('stake_id_fk') == '3'){
                                 if($value->current_status == 1 || $value->current_status == 2){
                                 
                                 ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>
                              <?php if($value->delete_status == 0){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                              <?php } ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Publish_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Publish Intervention</a></li>
                              <?php } ?>
                              <?php if($value->current_status == 4){
                                 if($value->cp_1_age < 18){
                                 ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/child_welfare_committee_proceedings_cp_one_form/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>CP 1 CWC Procedings</a></li>
                              <?php } ?>
                              <?php if($value->cp_two_is_available == 1 && $value->cp_2_age < 18){?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/child_welfare_committee_proceedings_cp_two_form/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>CP 2 CWC Procedings</a></li>
                              <?php } } } ?>
                              <!-- End CMPO-->
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/print/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-print" aria-hidden="true"></i>Print</a></li>
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/download/<?php echo base64_encode($value->reporting_id); ?>"><i class="fa fa-download" aria-hidden="true"></i>Download</a></li>
                           </ul>
                        </div>
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
         <div class="box-footer">
         </div>
      </div>
   </section>
   <?php
      $c = 1;

      foreach($incident_details as $value){
        $incident_block_details = Get_Incident_List_Block_Details($value->block);
        if(!empty($incident_block_details)){
          if($incident_block_details->rural_urban == 'U'){
            $incident_ward_gp_details = Get_Incident_List_Ward_Details($value->ward_gp);
          }else{
            $incident_ward_gp_details = Get_Incident_List_GP_Details($value->ward_gp);
          }
        }else{
          $incident_ward_gp_details = array();
        }
      
        $incident_identity_block_details = Get_Incident_List_Identity_Block_Details($value->identity_block_id);
        if(!empty($incident_identity_block_details)){
           if($incident_identity_block_details->rural_urban == 'U'){
             $incident_identity_ward_gp_details = Get_Incident_List_Identity_Ward_Details($value->identity_ward_gp);
           }else{
             $incident_identity_ward_gp_details = Get_Incident_List_Identity_GP_Details($value->identity_ward_gp);
           }
        }else{
           $incident_identity_ward_gp_details = array();
        }
       
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
   <div id="viewModal<?php echo $value->incident_id_pk?>" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content" id="mod">
            <div class="modal-header custom-modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title text-center">CMRTS Intervention Report Data</h4>
            </div>
            <div class="modal-body">
               <section class="content">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card card-default">
                           <div class="card-body p-0">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 18rem; font-size:medium;">Prevention Intervention</label>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Intervention Date&nbsp;(dd/mm/yyyy)</label>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($value->incident_date)); ?>" disabled>
                                    </div>
                                    <div class="col-sm-6">
                                       <?php
                                          foreach($marriage_details as $key => $value1){
                                          if($key == 0){
                                             $marriage_details_css = 'margin-left: 198px';
                                          }elseif($key == 1){
                                             $marriage_details_css = 'margin-left: 178px';
                                          }else{
                                             $marriage_details_css = 'margin-left: 211px';
                                          }
                                          ?>
                                       <span style="<?php echo $marriage_details_css; ?>"><?php echo $value1['description']?></span><input type="radio" <?php if($value->marriage_details == $value1['cm_marriage_master_id_pk']){ echo "checked"; } ?> style="float: right;margin-right: 80px;"><br>
                                       <?php } ?>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date of marriage&nbsp;(dd/mm/yyyy)</label>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?php echo !empty($value->marriage_date) ? date('d-m-Y', strtotime($value->marriage_date)) : ''; ?>" disabled>
                                    </div>

                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Street / Landmark</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" value="<?php echo $value->street_landmark; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" value="West Bengal" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">District</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" value="<?php echo $value->incident_district; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Block / Municipality</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" value="<?php echo $value->incident_block; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ward / GP</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" value="<?=($incident_ward_gp_details)?$incident_ward_gp_details->ward_gp:''; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Pin Code</label>
                                    <div class="col-sm-5">
                                       <input type="text"  class="form-control" value="<?php echo $value->pin_code; ?>" disabled>
                                    </div>
                                    <div class="col-sm-4">
                                       <?php
                                          foreach($prevented_details as $key => $value1){
                                             if($key == 0){
                                             $prevented_details_css = 'margin-left: 88px';
                                             }else{
                                                $prevented_details_css = 'margin-left: 62px';
                                             }
                                          ?>
                                       <span style="<?php echo $prevented_details_css; ?>"><?php echo $value1['description']?></span><input type="radio" class="prevented_details" <?php if($value->prevented_details == $value1['cm_incident_report_details_master_id_pk']){ echo "checked"; } ?> style="float: right;margin-right: 79px;"><br>
                                       <?php } ?>                                
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Police Station</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" value="<?php echo $value->police_station; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description of location</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($location_description_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->location_description == $value1['cm_location_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>
                                          </div>
                                          <?php } ?>   
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 42rem; font-size:medium;">Information First Received at Block / Municipality office from</label>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Anonymous</label>
                                    <div class="col-sm-5">
                                       <input type="radio" <?php if($value->anonymous == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($value->anonymous == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($value->anonymous == 2){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">If identity known Name</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" value="<?php echo $value->identity_known_name; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Street / Landmark</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" value="<?php echo $value->identity_street_landmark; ?>" disabled>
                                    </div>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="left-form">
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">State</label>
                                       <div class="col-sm-5">
                                          <input type="text" class="form-control" value="West Bengal" disabled>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">District</label>
                                       <div class="col-sm-5">
                                          <input type="text" class="form-control" value="<?php echo $value->identity_district; ?>" disabled>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Block / Municipality</label>
                                       <div class="col-sm-5">
                                          <input type="text" class="form-control" value="<?php echo $value->identity_block; ?>" disabled>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Ward / GP</label>
                                       <div class="col-sm-5">
                                          <input type="text" class="form-control" value="<?php echo $incident_identity_ward_gp_details->identity_ward_gp; ?>" disabled>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Pin Code</label>
                                       <div class="col-sm-5">
                                          <input type="text" class="form-control" value="<?php echo $value->identity_pin_code; ?>" disabled>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Police Station</label>
                                       <div class="col-sm-5">
                                          <input type="text" class="form-control" value="<?php echo $value->identity_police_station; ?>" disabled> 
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Phone No</label>
                                       <div class="col-sm-5">
                                          <input type="number" class="form-control" value="<?php echo $value->identity_phone_no; ?>" disabled>
                                       </div>
                                    </div>
                                    <div class="form-group row Information_Received">
                                       <h5 class=""><strong>Information Received by</strong></h5>
                                       <div class="">
                                          <?php
                                             foreach($information_received_details as $value1){?>
                                          <span style="margin-right: 15px;"><?php echo $value1['description']?></span>&nbsp;<input type="radio" <?php if($value->information_received == $value1['cm_information_received_master_id_pk']){ echo "checked"; } ?> style="margin-right: 9px;"><br>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 38rem; font-size:medium;">Local Persons Involved in Prevention Incident</label>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <div class="col-sm-12">
                                       <table class="table table-bordered" id="Local_Persons_Involved_Table_Field">
                                          <tr style="background-color: gray; color: #FFFFFF;">
                                             <th>Name, if available</th>
                                             <th style="text-align: center;">Male</th>
                                             <th style="text-align: center;">Female</th>
                                             <th>Occupation / Identity</th>
                                          </tr>
                                          <?php
                                             $Local_Person_Details_Query = Get_Local_Person_Details($value->incident_id_pk);
                                             foreach($Local_Person_Details_Query as $value1){
                                             ?>
                                          <tr>
                                             <td><input type="text" class="form-control" value="<?php echo $value1->local_person_name; ?>" disabled></td>
                                             <td><input type="radio" <?php if($value1->local_person_gender == 1){ echo "checked"; } ?>></td>
                                             <td><input type="radio" <?php if($value1->local_person_gender == 2){ echo "checked"; } ?>></td>
                                             <td><input type="text" class="form-control" value="<?php echo $value1->local_person_occupation_identity; ?>" disabled></td>
                                          </tr>
                                          <?php } ?>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 34rem; font-size:medium;">Officials Involved in Prevention Incident</label>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <div class="col-sm-12">
                                       <table class="table table-bordered" id="Officials_Involved_Table_Field">
                                          <tr style="background-color: gray; color: #FFFFFF;">
                                             <th>Name</th>
                                             <th>Designation</th>
                                             <th>Office</th>
                                             <th>Contact No</th>
                                          </tr>
                                          <?php
                                             $Official_Involved_Details_Query = Get_Official_Involved_Details($value->incident_id_pk);
                                             foreach($Official_Involved_Details_Query as $value1){
                                             ?>
                                          <tr>
                                             <td><input type="text" class="form-control" value="<?php echo $value1->official_involved_name; ?>" disabled></td>
                                             <td><input type="text" class="form-control" value="<?php echo $value1->officials_involved_designation; ?>" disabled></td>
                                             <td><input type="text" class="form-control"value="<?php echo $value1->officials_involved_office; ?>" disabled></td>
                                             <td><input type="text" class="form-control" value="<?php echo $value1->officials_involved_contact_no; ?>" disabled></td>
                                          </tr>
                                          <?php } ?>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 24rem; font-size:medium;">Contracting Party One&nbsp;</label>
                                 </div>
                              </div>
                              <?php
                                 $cp_1_name = $value->cp_1_name;
                                 $cp_one_name_array = explode(" ", $cp_1_name);
                                 $cp_one_name_array_count = count($cp_one_name_array);
                                 if($cp_one_name_array_count == 1){
                                    $cp_one_f_name = $cp_one_name_array[0];
                                    $cp_one_m_name = "";
                                    $cp_one_l_name = "";
                                 }elseif($cp_one_name_array_count == 2){
                                    $cp_one_f_name = $cp_one_name_array[0];
                                    $cp_one_l_name = $cp_one_name_array[1];
                                    $cp_one_m_name = "";
                                 }elseif($cp_one_name_array_count == 3){
                                    $cp_one_f_name = $cp_one_name_array[0];
                                    $cp_one_m_name = $cp_one_name_array[1];
                                    $cp_one_l_name = $cp_one_name_array[2];
                                 }
                                 ?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?php echo $cp_one_f_name; ?>" disabled> 
                                    </div>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?php echo $cp_one_m_name; ?>" disabled> 
                                    </div>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?php echo $cp_one_l_name; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Street / Landmark</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_1_street_landmark; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-6">
                                       <input type="text" value="<?php echo $value->cp_1_state_name; ?>" class="form-control" disabled>
                                    </div>
                                 </div>
                                 <?php if($value->cp_1_state == 1){?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">District</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_1_district; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Block / Municipality</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_1_block; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ward / GP</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:''; ?>" disabled>
                                    </div>
                                 </div>
                                 <?php }else{?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                       <textarea class="form-control" rows="3" disabled><?php echo $value->cp_1_address; ?></textarea>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Pin Code</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_1_pin_code; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Police Station</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_1_police_station; ?>" disabled> 
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Phone No</label>
                                    <div class="col-sm-6">
                                       <input type="number" class="form-control" value="<?php echo $value->cp_1_phone_no; ?>" disabled>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Gender</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($gender_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_1_gender == $value1['cm_gender_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Social Category</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($social_category_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_1_social_category == $value1['cm_social_category_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Religion</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($religion_details as $value1){
                                             ?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_1_religion == $value1['cm_religion_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date of Birth (dd/mm/yyyy)</label>
                                    <div class="col-sm-6">
                                       <!-- <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($value->cp_1_dob)); ?>" disabled>  -->
                                       <input type="text" class="form-control" value="<?php echo !empty($value->cp_1_dob) ? date('d-m-Y', strtotime($value->cp_1_dob)) : ''; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Age</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_1_age; ?>" disabled> 
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">DOB document available?</label>
                                    <div class="col-sm-9">
                                       <input type="radio" <?php if($value->cp_1_dob_document_available == '1'){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($value->cp_1_dob_document_available == '2'){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($value->cp_1_dob_document_available == '1'){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_1_dob_document_id; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($document_type_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_1_dob_document_type == $value1['cm_document_type_master_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Identity document available?</label>
                                    <div class="col-sm-9">
                                       <input type="radio" <?php if($value->cp_1_identity_document_available == '1'){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($value->cp_1_identity_document_available == '2'){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($value->cp_1_identity_document_available == '1'){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_1_identity_document_id; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($document_type_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_1_identity_document_type == $value1['cm_document_type_master_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Highest Educational Attainment</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($highest_education_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_1_highest_educational_attainment == $value1['cm_highest_educational_attainment_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>                               
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <div class="col-sm-12">
                                       <table class="table table-bordered">
                                          <tr style="background-color: gray; color: #FFFFFF;">
                                             <th colspan="2" style="text-align: center;">Father of Contracting Party 1</th>
                                             <th style="text-align: center;">Mother of Contracting Party 1</th>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Name</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_1_father_name; ?>" disabled> 
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_1_mother_name; ?>" disabled> 
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Phone No</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_1_father_mobile_no; ?>" disabled>  
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_1_mother_mobile_no; ?>" disabled>  
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_1_father_id; ?>" disabled>  
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_1_mother_id; ?>" disabled>  
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID Type</td>
                                             <td>
                                                <?php
                                                   if($value->cp_1_father_id_type == 1){
                                                     $cp_1_father_id_type = "Birth Certificate";
                                                   }elseif($value->cp_1_father_id_type == 2){
                                                     $cp_1_father_id_type = "School Certificate";
                                                   }elseif($value->cp_1_father_id_type == 3){
                                                     $cp_1_father_id_type = "Driving Licence";
                                                   }elseif($value->cp_1_father_id_type == 4){
                                                     $cp_1_father_id_type = "PAN Card";
                                                   }elseif($value->cp_1_father_id_type == 5){
                                                     $cp_1_father_id_type = "Voter ID Card";
                                                   }elseif($value->cp_1_father_id_type == 6){
                                                      $cp_1_father_id_type = "Passport";
                                                   }else{
                                                      $cp_1_father_id_type = "N/A";
                                                   }
                                                   ?>
                                                <input type="text" class="form-control" value="<?php echo $cp_1_father_id_type; ?>" disabled>
                                             </td>
                                             <td>
                                                <?php
                                                   if($value->cp_mother_id_type == 1){
                                                     $cp_mother_id_type = "Birth Certificate";
                                                   }elseif($value->cp_mother_id_type == 2){
                                                     $cp_mother_id_type = "School Certificate";
                                                   }elseif($value->cp_mother_id_type == 3){
                                                     $cp_mother_id_type = "Driving Licence";
                                                   }elseif($value->cp_mother_id_type == 4){
                                                     $cp_mother_id_type = "PAN Card";
                                                   }elseif($value->cp_mother_id_type == 5){
                                                     $cp_mother_id_type = "Voter ID Card";
                                                   }elseif($value->cp_mother_id_type == 6){
                                                      $cp_mother_id_type = "Passport";
                                                   }else{
                                                      $cp_mother_id_type = "N/A";
                                                   }
                                                   ?>
                                                <input type="text" class="form-control" value="<?php echo $cp_mother_id_type; ?>" disabled>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Alive</td>
                                             <td style="text-align: left;">
                                                <input type="radio" value="1" <?php if($value->cp_1_father_alive == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                                <input type="radio" value="2" <?php if($value->cp_1_father_alive == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                             </td>
                                             <td style="text-align: left;">
                                                <input type="radio" value="1" <?php if($value->cp_1_mother_alive == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                                <input type="radio" value="2" <?php if($value->cp_1_mother_alive == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <?php if(count(Get_Cp_One_Address($value->incident_id_pk)) > 0){?>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                   <div class="col-sm-12">
                                      <label class="badge badge-primary text-wrap" style="width: 20rem; font-size:medium;">CP 1 Current Address</label>
                                   </div>
                                 </div>
                              </div>
                              <i class="fa fa-arrow-down" aria-hidden="true"></i>
                              <div class="row">
                               <?php
                               $i = 0;
                               $Cp_One_Address_Query = Get_Cp_One_Address($value->incident_id_pk);
                               foreach($Cp_One_Address_Query as $cp_1_address_value){ $i++;
                                 $cp_1_address_block_details = Get_Incident_List_CP_One_Block_Details($cp_1_address_value->cp_1_address_block_id);
                     
                                 if(!empty($cp_1_address_block_details)){
                                    if($cp_1_address_block_details->rural_urban == 'U'){
                                       $cp_1_address_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($cp_1_address_value->ward_gp);
                                    }else{
                                       $cp_1_address_ward_gp_details = Get_Incident_List_CP_One_GP_Details($cp_1_address_value->ward_gp);
                                    }
                                 }else{
                                     $cp_1_address_ward_gp_details = array();
                                 }
                               ?>
                               <div class="col-sm-12" style="margin-bottom: 3%;">
                                 <div class="table">
                                   <div class="tr">
                                     <div class="td">State :</div>
                                     <div class="td"><?php if($cp_1_address_value->state == '19'){?>West Bengal<?php } ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Street / Landmark :</div>
                                     <div class="td"><?php echo $cp_1_address_value->street_landmark; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">District :</div>
                                     <div class="td"><?php echo $cp_1_address_value->district_name; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Block / Municipality :</div>
                                     <div class="td"><?php echo $cp_1_address_value->block_name; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Ward / GP :</div>
                                     <div class="td"><?=($cp_1_address_ward_gp_details)?$cp_1_address_ward_gp_details->cp_one_ward_gp:'';?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Pin Code :</div>
                                     <div class="td"><?php echo $cp_1_address_value->pin_code; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Police Station :</div>
                                     <div class="td"><?php echo $cp_1_address_value->police_station; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Address :</div>
                                     <div class="td"><?php echo $cp_1_address_value->address; ?></div>
                                   </div>
                                   <?php if($cp_1_address_value->remarks != ''){?>
                                   <div class="tr">
                                     <div class="td">Remarks :</div>
                                     <div class="td"><?php echo $cp_1_address_value->remarks; ?></div>
                                   </div>
                                   <?php } ?>
                                 </div>
                               </div>
                               <?php } ?>
                              </div>
                              <?php } ?>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <div class="col-sm-12">
                                       <label class="badge badge-primary text-wrap" style="width: 19rem; font-size:medium;">Contracting Party Two</label>  
                                    </div>
                                 </div>
                              </div>
                              <?php
                                 $cp_2_name = $value->cp_2_name;
                                 $cp_two_name_array = explode(" ", $cp_2_name);
                                 $cp_two_name_array_count = count($cp_two_name_array);
                                 if($cp_two_name_array_count == 1){
                                    $cp_two_f_name = $cp_two_name_array[0];
                                    $cp_two_m_name = "";
                                    $cp_two_l_name = "";
                                 }elseif($cp_two_name_array_count == 2){
                                    $cp_two_f_name = $cp_two_name_array[0];
                                    $cp_two_l_name = $cp_two_name_array[1];
                                    $cp_two_m_name = "";
                                 }elseif($cp_two_name_array_count == 3){
                                    $cp_two_f_name = $cp_two_name_array[0];
                                    $cp_two_m_name = $cp_two_name_array[1];
                                    $cp_two_l_name = $cp_two_name_array[2];
                                 }
                                 ?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?php echo $cp_two_f_name; ?>" disabled>  
                                    </div>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?php echo $cp_two_m_name; ?>" disabled>  
                                    </div>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?php echo $cp_two_l_name; ?>" disabled>  
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Street / Landmark</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_2_street_landmark; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_2_state_name; ?>" readonly style="cursor: not-allowed;">  
                                    </div>
                                 </div>
                                 <?php if($value->cp_2_state == 1){?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">District</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_2_district; ?>" disabled>  
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Block / Municipality</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_2_block; ?>" disabled>  
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ward / GP</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?=($cp_two_ward_gp_details)?$cp_two_ward_gp_details->cp_two_ward_gp:''; ?>" disabled>
                                    </div>
                                 </div>
                                 <?php }else{?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                       <textarea class="form-control" rows="3" disabled><?php echo $value->cp_2_address; ?></textarea>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Pin Code</label>
                                    <div class="col-sm-6">
                                       <input type="number" class="form-control" value="<?php echo $value->cp_2_pin_code; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Police Station</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_2_police_station; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Phone No</label>
                                    <div class="col-sm-6">
                                       <input type="number" class="form-control" value="<?php echo $value->cp_2_phone_no ?>" disabled>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Gender</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($gender_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_2_gender == $value1['cm_gender_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Social Category</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($social_category_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_2_social_category == $value1['cm_social_category_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Religion</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($religion_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_2_religion == $value1['cm_religion_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date of Birth (dd/mm/yyyy)</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo !empty($value->cp_2_dob) ? date('d-m-Y', strtotime($value->cp_2_dob)) : ''; ?>" disabled>  
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Age</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_2_age; ?>" disabled>  
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">DOB document available?</label>
                                    <div class="col-sm-6">
                                       <input type="radio" <?php if($value->cp_2_dob_document_available == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($value->cp_2_dob_document_available == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($value->cp_2_dob_document_available == 1){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_2_dob_document_id; ?>">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($document_type_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio"  <?php if($value->cp_2_dob_document_type == $value1['cm_document_type_master_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Identity document available?</label>
                                    <div class="col-sm-6">
                                       <input type="radio" <?php if($value->cp_2_identity_document_available == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($value->cp_2_identity_document_available == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($value->cp_2_identity_document_available == 1){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $value->cp_2_identity_document_id; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($document_type_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_2_identity_document_type == $value1['cm_document_type_master_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?> 
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Highest Educational Attainment</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($highest_education_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($value->cp_2_highest_educational_attainment == $value1['cm_highest_educational_attainment_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>     
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <div class="col-sm-12">
                                       <table class="table table-bordered" id="documents_collected_table_field">
                                          <tr style="background-color: gray; color: #FFFFFF;">
                                             <th colspan="2" style="text-align: center;">Father of Contracting Party 2</th>
                                             <th style="text-align: center;">Mother of Contracting Party 2</th>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Name</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_2_father_name; ?>" disabled> 
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_2_mother_name; ?>" disabled>   
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Phone No</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_2_father_mobile_no; ?>" disabled> 
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_2_mother_mobile_no; ?>" disabled>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_2_father_id; ?>" disabled>
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $value->cp_2_mother_id; ?>" disabled>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID Type</td>
                                             <td>
                                                <?php
                                                   if($value->cp_2_father_id_type == 1){
                                                     $cp_2_father_id_type = "Birth Certificate";
                                                   }elseif($value->cp_2_father_id_type == 2){
                                                     $cp_2_father_id_type = "School Certificate";
                                                   }elseif($value->cp_2_father_id_type == 3){
                                                     $cp_2_father_id_type = "Driving Licence";
                                                   }elseif($value->cp_2_father_id_type == 4){
                                                     $cp_2_father_id_type = "PAN Card";
                                                   }elseif($value->cp_2_father_id_type == 5){
                                                     $cp_2_father_id_type = "Voter ID Card";
                                                   }elseif($value->cp_2_father_id_type == 6){
                                                      $cp_2_father_id_type = "Passport";
                                                   }else{
                                                      $cp_2_father_id_type = "N/A";
                                                   }
                                                   ?>
                                                <input type="text" class="form-control" value="<?php echo $cp_2_father_id_type; ?>" disabled>
                                             </td>
                                             <td>
                                                <?php
                                                   if($value->cp_2_mother_id_type == 1){
                                                     $cp_2_mother_id_type = "Birth Certificate";
                                                   }elseif($value->cp_2_mother_id_type == 2){
                                                     $cp_2_mother_id_type = "School Certificate";
                                                   }elseif($value->cp_2_mother_id_type == 3){
                                                     $cp_2_mother_id_type = "Driving Licence";
                                                   }elseif($value->cp_2_mother_id_type == 4){
                                                     $cp_2_mother_id_type = "PAN Card";
                                                   }elseif($value->cp_2_mother_id_type == 5){
                                                     $cp_2_mother_id_type = "Voter ID Card";
                                                   }elseif($value->cp_2_mother_id_type == 6){
                                                      $cp_2_mother_id_type = "Passport";
                                                   }else{
                                                      $cp_2_mother_id_type = "N/A";
                                                   }
                                                   ?>
                                                <input type="text" class="form-control" value="<?php echo $cp_2_mother_id_type; ?>" disabled>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Alive</td>
                                             <td style="text-align: left;">
                                                <input type="radio" <?php if($value->cp_2_father_alive == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                                <input type="radio" <?php if($value->cp_2_father_alive == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                             </td>
                                             <td style="text-align: left;">
                                                <input type="radio" <?php if($value->cp_2_mother_id_type == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                                <input type="radio" <?php if($value->cp_2_mother_id_type == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <?php if(count(Get_Cp_Two_Address($value->incident_id_pk)) > 0){?>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                   <div class="col-sm-12">
                                      <label class="badge badge-primary text-wrap" style="width: 20rem; font-size:medium;">CP 2 Current Address</label>
                                   </div>
                                 </div>
                              </div>
                              <i class="fa fa-arrow-down" aria-hidden="true"></i>
                              <div class="row">
                               <?php
                               $i = 0;
                               $Cp_Two_Address_Query = Get_Cp_Two_Address($value->incident_id_pk);
                               foreach($Cp_Two_Address_Query as $cp_2_address_value){ $i++;

                                 $cp_2_address_block_details = Get_Incident_List_CP_Two_Block_Details($cp_2_address_value->cp_2_address_block_id);

                                 if(!empty($cp_2_address_block_details)){
                                    if($cp_2_address_block_details->rural_urban == 'U'){
                                       $cp_2_address_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($cp_2_address_value->ward_gp);
                                    }else{
                                       $cp_2_address_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($cp_2_address_value->ward_gp);
                                    }
                                 }else{
                                  $cp_2_address_ward_gp_details = array();
                                 }
                               ?>
                               <div class="col-sm-12" style="margin-bottom: 3%;">
                                 <div class="table">
                                   <div class="tr">
                                     <div class="td">State :</div>
                                     <div class="td"><?php if($cp_2_address_value->state == '19'){?>West Bengal<?php } ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Street / Landmark :</div>
                                     <div class="td"><?php echo $cp_2_address_value->street_landmark; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">District :</div>
                                     <div class="td"><?php echo $cp_2_address_value->district_name; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Block / Municipality :</div>
                                     <div class="td"><?php echo $cp_2_address_value->block_name; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Ward / GP :</div>
                                     <div class="td"><?=($cp_2_address_ward_gp_details)?$cp_2_address_ward_gp_details->cp_two_ward_gp:'';?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Pin Code :</div>
                                     <div class="td"><?php echo $cp_2_address_value->pin_code; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Police Station :</div>
                                     <div class="td"><?php echo $cp_2_address_value->police_station; ?></div>
                                   </div>
                                   <div class="tr">
                                     <div class="td">Address :</div>
                                     <div class="td"><?php echo $cp_2_address_value->address; ?></div>
                                   </div>
                                   <?php if($cp_2_address_value->remarks != ''){?>
                                   <div class="tr">
                                     <div class="td">Remarks :</div>
                                     <div class="td"><?php echo $cp_2_address_value->remarks; ?></div>
                                   </div>
                                   <?php } ?>
                                 </div>
                               </div>
                               <?php } ?>
                              </div>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<?php
   if($this->session->userdata('subdiv') != '' && $this->session->userdata('stake_id_fk') == '4'){
     $message = "Forward to SDO?";
   }elseif($this->session->userdata('subdiv') == '' && $this->session->userdata('stake_id_fk') == '4'){
     $message = "Forward to BDO?";
   }
   ?>
<script type="text/javascript">
   function close_address_modal()
   {
     location.reload();
   }
   
   // Reset Date Search
   $('#reset_btn').click(function() {
       location.reload();
   });
</script>
<script type="text/javascript">
   // Forward Section
   <?php
      if($this->session->userdata('subdiv') != '' && $this->session->userdata('stake_id_fk') == '4'){?>
     var title = "Forward to SDO?";
     var success_msg = "Forward success to SDO";
     var cancel_msg = "Forward cancel to SDO!";
   <?php }elseif($this->session->userdata('subdiv') == '' && $this->session->userdata('stake_id_fk') == '4'){?>
     var title = "Forward to BDO?";
     var success_msg = "Forward success to BDO";
     var cancel_msg = "Forward cancel to BDO!";
   <?php } ?>
   function Forward_Details(rr_id){
      swal({
      title: title,
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Yes, Forward it",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "No, Cancel",
      closeOnConfirm: false,
      closeOnCancel: false,
      showLoaderOnConfirm: true
    },
    function(isConfirm){
      if(isConfirm){
          var incident_id = rr_id;
          $.ajax({
             url:"reporting/incident/incident_list/forward_bdo",
             method:"GET",
             data:{incident_id:incident_id},
             dataType:"JSON",
             success:function(response)
             {
               // alert(response);
               swal("Forwarded!", success_msg, "success");
               setTimeout(function(){
                 window.location.reload();
               },2000);
             }
          });
      } else {
          swal("Cancelled", cancel_msg, "error");
          setTimeout(function(){
             window.location.reload();
          }, 1500);
      } 
    });
   }
   // Publish Section
   function Publish_Incident(rr_id){
      swal({
      title: "Publish?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Yes, Publish it",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "No, Cancel",
      closeOnConfirm: false,
      closeOnCancel: false,
      showLoaderOnConfirm: true
    },
    function(isConfirm){
      if(isConfirm){
          var incident_id = rr_id;
          $.ajax({
              url:"reporting/incident/incident_list/publish_deo",
              method:"GET",
              data:{incident_id:incident_id},
              dataType:"JSON",
              success:function(response)
              {
                  swal("Published!", "Publish success", "success");
                  setTimeout(function(){
                     window.location.reload();
                  }, 2000);
              }
          });
      } else {
          swal("Cancelled", "Publish cancel!", "error");
          setTimeout(function(){
             window.location.reload();
          }, 1500);
      } 
    });
   }
   // Transfer CCI to CMPO Details
   function Transfer_CCI_Details(rr_id){
      swal({
      title: "Transfer to CCI?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Yes, Transfer it",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "No, Cancel",
      closeOnConfirm: false,
      closeOnCancel: false,
      showLoaderOnConfirm: true
    },
    function(isConfirm){
      if(isConfirm){
          var incident_id = rr_id;
          $.ajax({
              url:"reporting/incident/incident_list/Transfer_CCI_To_CMPO",
              method:"GET",
              data:{incident_id:incident_id},
              dataType:"JSON",
              success:function(response)
              {
                  swal("Transfered!", "Transfer to CCI success", "success");
                  setTimeout(function(){
                     window.location.reload();
                  }, 2000);
              }
          });
      } else {
          swal("Cancelled", "Transfer to CCI cancel!", "error");
          setTimeout(function(){
             window.location.reload();
          }, 1500);
      } 
    });
   }
   
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
<script type="text/javascript">
   $(document).on("click","#search_btn",function(e){
      var btnPrintUrl = '<?php echo base_url()?>admin/reporting/incident/incident_list/list_print/';
     e.preventDefault();
     var start_date = $("#start_date").val();
     var end_date = $("#end_date").val();
     if(start_date != '' && end_date != ''){
      var btnPrintUrl = '<?php echo base_url()?>admin/reporting/incident/incident_list/list_print/?start_date='+start_date+'&end_date='+end_date;
      var downloadBtnUrl = '<?php echo base_url()?>admin/reporting/incident/incident_list/list_download/?start_date='+start_date+'&end_date='+end_date;
      $('#btnPrint2').attr('href',btnPrintUrl);
      $('#download_btn').attr('href',downloadBtnUrl);
       $.ajax({
           url:"reporting/incident/incident_list/dateSearch",
           method:"GET",
           data:{"start_date":start_date,"end_date":end_date},
           success:function(response)
           {
               // alert(response);
               if(response != ""){
                  $("#childAppend").html(response);
               }else{
                 $("#childAppend").html("<td colspan='14' style='color:red;'><b>No matching record found!</b></td>");
               } 
           }
       });
      }else{
        alert("Both date is required");
      }  
   });
</script>
<script type="text/javascript">
   $(document).on("click","#advanced_search_btn",function(e){
      e.preventDefault();
      $("#date_div").toggle('swing');
    });
</script>
<script type="text/javascript">
   function expand(){
   document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
   }
</script>
<script type="text/javascript">
$(document).ready(function() {
   $('#mod input[type="radio"]').prop('disabled', true);
});

</script>