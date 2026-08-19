<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/left_menu_view'); ?>

<style type="text/css">
.toggle-btn{
   position: relative;
  width: 70px;
  height: 35px;
  margin: 10px;
  border-radius: 50px;
  display: inline-block;
  position: relative;
  background : url('<?php echo $this->config->item('theme_uri');?>assets/toggle btn/img/wrong.png') no-repeat 45px center #e74c3c;
  cursor: pointer;
  -webkit-transition: background-color .40s ease-in-out;
  -moz-transition: background-color .40s ease-in-out;
  -o-transition: background-color .40s ease-in-out;
  transition: background-color .40s ease-in-out;
  cursor:pointer; 
  &.active{
    background : url('<?php echo $this->config->item('theme_uri');?>assets/toggle btn/img/right.png') no-repeat 10px center #2ecc71;
    .round-btn{
      left: 38px;
    }
  }
  .round-btn{
    width: 28px;
    height: 28px;
    background-color: #fff;
    border-radius: 50%;
    display: inline-block;
    position: absolute;
    left: 5px;
    top: 50%;
    margin-top: -15px;
    -webkit-transition: all .30s ease-in-out;
  -moz-transition: all .30s ease-in-out;
  -o-transition: all .30s ease-in-out;
  transition: all .30s ease-in-out;
  }
  .cb-value{
    position: absolute;
    left:0;
    right:0;
    width: 100%;
    height: 100%;
    opacity: 0;
    z-index: 9;
    cursor:pointer;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
  }
}
</style>
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
   #box-table
  {
  max-height: 360px;
  scrollbar-color: #3c8dbc8a #d9d9d9;
  scrollbar-width: thin;
  }
  .sweet-alert {
  background-color: #ffffff;
  width: 30%;
  padding: 17px;
  border-radius: 5px;
  text-align: left;
  position: fixed;
  left: 0%;
  top: 50%;
  margin-left: -256px;
  margin-top: -200px;
  overflow: hidden;
  display: none;
  z-index: 2000;
  right: 0%;
  margin: 0 auto;
    margin-top: 0px;
  margin-top: 0px;
  overflow: scroll;
/*  height: 100vh;*/
text-align: center;
}
/*modal 28-01-2025*/
.con_details ul li
{
  list-style: none;
}
.con_details
{
  border-bottom: 2px solid skyblue;
  margin-bottom: 10px;
}
.form-group
{
  margin-bottom: 0;
}

/*Police case start */
.custom-box
{
  padding: 11px;
  border: ;
  background: #fff;
  box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
  margin: 4px 0;
  min-height: 140px;
}
label 
{
  margin-bottom: 10px;
  margin-top: 15px;
}
p
{
  margin-bottom: 5px;
  font-size: 14px;
}
/*Police case end */
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Intervention Register</h1>
      
      <!-- <input type="text" placeholder="Enter GD Date" class="form-control datepicker" id="gd_date" name="gd_date" value=""> -->

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

         <div class="toggle-btn" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;">
         <input type="checkbox" class="cb-value" id="toggleButton"/>
         <span class="round-btn"></span>
         </div>
         <!-- <a href="javascript:void()" onclick="expand()" class="btn btn-warning" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Expand</a> -->
         <a href="<?php echo base_url()?>admin/reporting/incident/incident_list/list_download" id="download_btn" class="btn btn-success" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-download" aria-hidden="true"></i> List Download</a>
         <a href="<?php echo base_url()?>admin/reporting/incident/incident_list/list_print/" id="btnPrint2" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>
         <a href="javascript:void()" id="advanced_search_btn" class="btn btn-info" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-search" aria-hidden="true"></i> Advanced Date Search </a>
         <?php if($this->session->userdata('stake_id_fk') == '3'){?>
         <a href="<?php echo base_url()?>admin/reporting/incident/incident_form" class="btn btn-primary" style="margin-top: 8px; float: right; margin-right: 10px;margin-bottom: 12px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Intervention</a>
         <?php } ?>
         <?php //echo "<pre>";print_r($incident_details); ?>
         <?php //echo "<pre>";print_r($_SESSION);exit; ?>
         <div class="box-body" id="box-table">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th colspan="5">Intervention</th>
                     <th colspan="6">Contracting Party 1</th>
                     <th colspan="6">Contracting Party 2</th>
                     <th colspan="1">Status</th>
                     <th colspan="1">Action</th>
                  </tr>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Intervention ID</th>
                     <th class="text-center">Intervention Date</th>
                     <th class="text-center">Location</th>
                     <th class="text-center">Police Station</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">Address</th>
                     <th class="text-center">Police Station</th>
                     <th class="text-center">CP 1 Status</th>
                     <th class="text-center">Name</th>
                     <th class="text-center">Gender</th>
                     <th class="text-center">Age</th>
                     <th class="text-center">Address</th>
                     <th class="text-center">Police Station</th>
                     <th class="text-center">CP 2 Status</th>
                     <th class="text-center">Status</th>
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                  <?php
                     $c = 1;
                     foreach($incident_details as $value){

                     // echo '<pre>';print_r($value);die;
                      
                       $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($value->cp_1_block_id);

                       $incident_block_details = Get_Incident_List_CP_One_Block_Details($value->block);

                       // print_r($incident_block_details);die;

                       if(!empty($incident_block_details))
                       {
                         if($incident_block_details->rural_urban == 'U')
                         {
                           $incident_ward_gp_details = Get_Incident_List_Incident_Ward_Details($value->ward_gp);
                         }
                         else
                         {
                           $incident_ward_gp_details = Get_Incident_List_Incident_GP_Details($value->ward_gp);
                         }
                       }
                       else
                       {
                         $incident_ward_gp_details = array();
                       }

                       // echo"<pre>";print_r($incident_ward_gp_details);die;
                       // echo $incident_ward_gp_details->incident_ward_gp;die;
                     
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
                     <td>
                        <?php echo $value->incident_district;?>,<br>
                        <?php echo $value->incident_block; ?>,<br>
                        <?=($incident_ward_gp_details)?$incident_ward_gp_details->incident_ward_gp:'';?>
                     </td>
                     <td><?=($value)?$value->police_station:''?></td>
                     <td><?php echo $value->cp_1_name; ?></td>
                     <td><?php echo $value->cp_1_gender_value; ?></td>

                     <!-- <td><?php echo $value->cp_1_age; ?></td> -->

                     <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_1_dob); ?></td>

                     <?php if($value->cp_1_state == 1){?>
                     <td>
                        <?php echo $value->cp_1_district;?>,<br>
                        <?php echo $value->cp_1_block?>,<br>
                        <?=($cp_one_ward_gp_details)?$cp_one_ward_gp_details->cp_one_ward_gp:'';?>
                     </td>
                     <?php }else{ ?>
                     <td><?php echo $value->cp_1_address;?></td>
                     <?php } ?>
                     <td><?=($value)?$value->cp_1_police_station:''?></td>
                     <td>
                      <?php 
                          //echo $value->current_status.'--->>'.$value->cp_1_id_pk.'--->>'.$value->cp_1_age.'</br>';
                            echo cp_status($value->current_status, $value->cp_1_id_pk, $value->cp_1_age);
                      ?> 
                     </td>
                     <td><?php echo $value->cp_2_name; ?></td>
                     <td><?php echo $value->cp_2_gender_value; ?></td>


                     <!-- <td><?php echo $value->cp_2_age; ?></td> -->
                     <td><?php get_full_for_excel_view_for_he($value->incident_date, $value->cp_2_dob); ?></td>


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
                     <td><?=($value)?$value->cp_2_police_station:''?></td>
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

                              <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal<?php echo $value->incident_id_pk?>"><i class="fa fa-eye" aria-hidden="true"></i>View Details</a></li> -->

                              <li role="presentation"><a class="" onclick="view_details('<?php echo base64_encode($value->incident_id_pk); ?>')">
                                <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;View Details
                              </a></li>

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

                                    <?php if($value->current_status == 3) {

                                      $CP_1_Homevisit = Get_CP_Homevisit_Details_Check($value->cp_1_id_pk); 
                                                    
                                      if($value->cp_1_age < 18 && count($CP_1_Homevisit) > 0){

                                        if(Get_CP_Address_details_Count($value->cp_1_id_pk) > 0){

                                          if(Get_CP_Address_details_block($value->cp_1_id_pk) == $this->session->userdata('block')){

                                              $CP_1_Homevisit_status = ($CP_1_Homevisit)?$CP_1_Homevisit['hv_status']:'';
                                              $CP_1_Not_Followup_published_Count = Get_CP_Not_Followup_published_Count($value->cp_1_id_pk);

                                              if($CP_1_Homevisit_status==3 && $CP_1_Not_Followup_published_Count==0){ ?>

                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 1 Follow-Up Visit(<?=$CP_1_Not_Followup_published_Count?>)</a></li>

                                          <?php } 
                                              } 
                                            } 
                                                        elseif($this->session->userdata('block') == $value->cp_1_block_id){

                                                          $CP_1_Homevisit_status = ($CP_1_Homevisit)?$CP_1_Homevisit['hv_status']:'';
                                                          $CP_1_Not_Followup_published_Count = Get_CP_Not_Followup_published_Count($value->cp_1_id_pk);

                                                          if($CP_1_Homevisit_status==3 && $CP_1_Not_Followup_published_Count==0){ ?>

                                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 1 Follow-Up Visit</a></li>

                                                        <?php }
                                                            } 
                                                          }
                                                        ?>

                                                      <!------For CP 2------>

                                                      <?php 
                                                        $CP_2_Homevisit = Get_CP_Homevisit_Details_Check($value->cp_2_id_pk);

                                                        if($value->cp_2_age < 18 && count($CP_2_Homevisit) > 0){
                                                        
                                                          if(Get_CP_Address_details_Count($value->cp_2_id_pk) > 0){

                                                            if(Get_CP_Address_details_block($value->cp_2_id_pk) == $this->session->userdata('block'))
                                                            {
                                                                
                                                                $CP_2_Homevisit_status = ($CP_2_Homevisit)?$CP_2_Homevisit['hv_status']:'';
                                                                $CP_2_Not_Followup_published_Count = Get_CP_Not_Followup_published_Count($value->cp_2_id_pk);
                                                            
                                                                if($CP_2_Homevisit_status==3 && $CP_2_Not_Followup_published_Count==0){ ?>

                                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 2 Follow-Up Visit</a></li>

                                                          <?php } 

                                                            } 
                                                          }
                                                          elseif($this->session->userdata('block') == $value->cp_2_block_id){

                                                            $CP_2_Homevisit_status = ($CP_2_Homevisit)?$CP_2_Homevisit['hv_status']:'';
                                                            $CP_2_Not_Followup_published_Count = Get_CP_Not_Followup_published_Count($value->cp_2_id_pk);

                                                            if($CP_2_Homevisit_status==3 && $CP_2_Not_Followup_published_Count==0){ ?>

                                                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/follow_up_visit_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-arrow-up" aria-hidden="true"></i>CP 2 Follow-Up Visit</a></li>

                                                        <?php } 
                                                          }  
                                                        }  
                                                      }   ?>

                                      <!---------- Follow-Up Visit End ------------>

                                      <!---------- Home Visit Start ----------->

                                      <?php if($value->current_status == 3){

                                           
                                         //home visit for cp 1
                                          $x = Get_CP_Homevisit_state($value->cp_1_id_pk);

                                          // echo "<pre>"; print_r($x); echo "</pre>"; 
                                          if(empty($x))
                                          {
                                            $x['hv_status'] = null;
                                          }

                                          // echo $this->session->userdata('block').'---'.$value->cp_1_block_id.'----'.$value->cp_1_id_pk.'---'.Get_CP_Homevisit_Count($value->cp_1_id_pk);

                                        if($value->cp_1_age < 18 && $x['hv_status']!=2){

                                          if($this->session->userdata('block') == $value->cp_1_block_id && Get_CP_Homevisit_Count($value->cp_1_id_pk) == 0){ ?>

                                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_minor_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i> CP 1 Home Enquiry Minor</a></li>
        					
                                          <?php } 

                                        }if($value->cp_1_age >= 18){

                                          if($this->session->userdata('block') == $value->cp_1_block_id && Get_CP_Homevisit_Count($value->cp_1_id_pk) == 0){?>

                                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_adult_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_1_type); ?>/<?php echo base64_encode($value->cp_1_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 1 Home Enquiry Adult</a></li>
        					 
                                          <?php } 
                                        }

                                         //home visit for cp 2
                                        if($value->cp_2_age < 18){

                                            if($this->session->userdata('block') == $value->cp_2_block_id && Get_CP_Homevisit_Count($value->cp_2_id_pk) == 0){?>

                                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_minor_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 2 Home Enquiry Minor</a></li>
        						                          <?php 
                                            } 
                                        }else if($value->cp_2_age > 18){

                                            if($this->session->userdata('block') == $value->cp_2_block_id && Get_CP_Homevisit_Count($value->cp_2_id_pk) == 0){  ?>

                                                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/home_visit_adult_form/<?php echo base64_encode($value->incident_id_pk); ?>/<?php echo base64_encode($value->cp_2_type); ?>/<?php echo base64_encode($value->cp_2_id_pk); ?>"><i class="fa fa-home" aria-hidden="true"></i>CP 2 Home Enquiry Adult</a></li>
                                              <?php 
                                            } 
                                        }       
                                      } ?>

                                  <!------------ Home Visit End ------------>

                                <?php 

                                if($value->current_status == 3){
                                if($value->cp_1_age < 18){
                                 if($this->session->userdata('block') == $value->cp_1_block_id){
                                ?>
                                  <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/police_cases/<?=base64_encode($value->incident_id_pk).'/'.base64_encode($value->cp_1_id_pk).'/'.base64_encode($value->cp_1_type);?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>Police Cases</a></li> -->

                                  <li role="presentation">
                                  <a role="menuitem" tabindex="-1" onclick="police_case(<?php echo $value->incident_id_pk ?>,<?php echo $value->cp_1_id_pk ?>,<?php echo $value->cp_1_type ?>, <?php echo $value->reporting_id ?>, '<?php echo $value->incident_date ?>','<?php echo $value->cp_1_name ?>', '<?php echo $value->cp_1_gender_value ?>')" > <i class="fa fa-address-card" aria-hidden="true"></i>CP1 Police Cases</a>
                                </li>


                                <?php } }elseif($value->cp_2_age < 18){
                                if($this->session->userdata('block') == $value->cp_2_block_id){  ?>

                                  <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/police_cases/<?=base64_encode($value->incident_id_pk).'/'.base64_encode($value->cp_2_id_pk).'/'.base64_encode($value->cp_2_type);?>"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>Police Cases</a></li>  -->

                                  <li role="presentation">
                                  <a role="menuitem" tabindex="-1" onclick="police_case(<?php echo $value->incident_id_pk ?>,<?php echo $value->cp_2_id_pk ?>,<?php echo $value->cp_2_type ?>, <?php echo $value->reporting_id ?>, '<?php echo $value->incident_date ?>','<?php echo $value->cp_2_name ?>', '<?php echo $value->cp_1_gender_value ?>')" > <i class="fa fa-address-card" aria-hidden="true"></i>CP2 Police Cases</a>
                                </li>

                                <?php } } } ?>
                                 
                              <?php } ?>
                              <!-- End DEO -->
                              <!-- For BDO-->
                              <?php 

                                if($this->session->userdata('stake_id_fk') == '2'){

                                  if($value->current_status == 1 || $value->current_status == 2){
                                    ?>
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>

                                        <?php if($value->delete_status == 0){?>

                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>
                                          
                                        <?php } ?>

                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Publish_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Publish Intervention</a></li>
                                        <?php 
                                  } 

                                    if($value->current_status == 3){?>
                                      <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/address_change/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>Address Change</a></li> -->
                                      <!-- <li role="presentation"><a role="menuitem" href="javascript:void()" onClick="Transfer_CCI_Details('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-exchange" aria-hidden="true"></i>Transfer to CCI (CMPO)</a></li> -->
                                  <?php } 

                                } ?>
                              <!-- End BDO-->

                              <!-- For SDO -->
                              <?php if($this->session->userdata('stake_id_fk') == '6'){

                                      if($value->rural_urban == 'U'){

                                        if($value->current_status == 1 || $value->current_status == 2){

                                          ?>

                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_form/edit/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a></li>

                                        <?php if($value->delete_status == 0){ ?>

                                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Delete_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-trash" aria-hidden="true"></i>Delete</a></li>

                                        <?php } ?>

                                              <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" onClick="Publish_Incident('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-forward"></i>Publish Intervention</a></li>
                                          <?php 
                                        }

                                        if($value->current_status == 3){  ?>
                                              <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/address_change/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>Address Change</a></li> -->
                                              <!-- <li role="presentation"><a role="menuitem" href="javascript:void()" onClick="Transfer_CCI_Details('<?php echo $value->incident_id_pk; ?>')"><i class="fa fa-exchange" aria-hidden="true"></i>Transfer to CCI (CMPO)</a></li> -->
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
                              <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/child_welfare_committee_proceedings_cp_one_form/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>CP 1 CWC Procedings</a></li> -->
                              <?php } ?>
                              <?php if($value->cp_two_is_available == 1 && $value->cp_2_age < 18){?>
                              <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/child_welfare_committee_proceedings_cp_two_form/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-address-card" aria-hidden="true"></i>CP 2 CWC Procedings</a></li> -->
                              <?php } } } ?>

                              <!-- Address change code by bappa 17-01.2025 Start -->
                              <?php 
                                $session_block = $this->session->userdata('block');
                                $cp1_block = $value->cp_1_block_id;
                                $cp2_block = $value->cp_2_block_id;
                                if($this->session->userdata('stake_id_fk') == '4'){
                                  if($value->current_status == 3){
                                ?>

                                <?php if(isset($value->cp_1_id_pk) && !empty($value->cp_1_id_pk) && $session_block==$cp1_block){
                                ?>
                                  <li role="presentation">
                                    <a role="menuitem" tabindex="-1" onclick="open_address_change_modal(<?php echo $value->incident_id_pk ?>,<?php echo $value->cp_1_id_pk ?>,1, <?php echo $value->reporting_id ?>, '<?php echo $value->incident_date ?>','<?php echo $value->cp_1_name ?>', '<?php echo $value->cp_1_gender_value ?>')"><i class="fa fa-address-card" aria-hidden="true"></i>CP1 Address Change Request</a>
                                  </li>
                                <?php
                                  }if(isset($value->cp_2_id_pk) && !empty($value->cp_2_id_pk) && $session_block==$cp2_block){
                                  ?>
                                  <li role="presentation">
                                    <a role="menuitem" tabindex="-1" onclick="open_address_change_modal(<?php echo $value->incident_id_pk ?>, <?php echo $value->cp_2_id_pk ?>,2, <?php echo $value->reporting_id?>, '<?php echo $value->incident_date ?>','<?php echo $value->cp_2_name ?>', '<?php echo $value->cp_2_gender_value ?>' )" > <i class="fa fa-address-card" aria-hidden="true"></i>CP2 Address Change Request</a>
                                  </li>
                                <?php } ?>
                                
                              <?php } } ?>
                              <!-- Address change code by bappa 17-01.2025 End-->

                              <!-- End CMPO-->
                              <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url()?>admin/reporting/incident/incident_list/print/<?php echo base64_encode($value->incident_id_pk); ?>"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
                              </li>
                              
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
</div>

<div id="myModal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="upload-dynamic"></div>
      
</div>

<!-- Address Change Modal Start 17-01-2025 Start -->
<div id="address_change_modal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog" style="width: 750px">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header"><!-- 
        <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title" id="title"></h4>
      </div>
      <div class="modal-body" style="padding: 25px">
        <div class="con_details" style="display: flex;justify-content: space-between;align-items: center;">
          <div>
            <ul style="padding: 0;margin: 0">
              <li><p>Intervention ID: <span id="inter_id"></span></p></li>
              <li><p>Intervention Date: <span id="inter_date"></span></p></li>
            </ul>
          </div>
          <div style="width: 60%">
            <ul style="padding: 0;margin: 0">
              <li style="display: flex;"><p id="cp_name_level"></p><span id="cp_name_id"></span></li>
              <li style="display: flex;"><p id="cp_gender_lavel"></p><span id="cp_gender_id"></span></li>
            </ul>
          </div>
        </div>

        <div class="alert alert-warning" role="alert" id="exist_error" style="display:none;padding: 4px;max-width: 100%;color: #721c24 !important;background-color: #f8d7da !important;border-color: #f5c6cb !important;">
          A request for an address change has already been generated using these details.
        </div>

        <div class="alert alert-success" role="alert" id="success_msg" style="display:none ;padding: 4px;max-width: 100%;color: #155724!important;background-color: #d4edda!important;border-color: #c3e6cb!important">
          Success! Address change request submited successfully.
        </div>

        <div class="alert alert-warning" role="alert" id="success_error" style="display:none;padding: 4px;max-width: 100%;color: #721c24 !important;background-color: #f8d7da !important;border-color: #f5c6cb !important;">
          Oops! Something went wrong. Please try again.
        </div>

        <form id="address_change_form">
           
          <div class="row">
            <div class="col-sm-12">
              <label class="col-form-label">Street / Landmark</label>
              <input type="text" placeholder="Street / Landmark" class="form-control" id="street_landmark" autocomplete="off" name="street_landmark" value="">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class=" row">
                <div class="col-sm-12">
                    <label class=" col-form-label">State<font color="red">*</font></label>
                    <select class="form-control" id='state' name='state' onchange="check_state($(this).val())">
                      <option value="0" disabled selected>--Select State--</option>
                        <?php foreach ($state as $value) { 
                            if($value['state_id_pk']==1){
                              $selected = 'selected';
                            }else{ 
                              $selected = '';
                            }
                          ?>
                          <option value="<?php echo $value['state_id_pk'] ?>" <?php echo $selected; ?>><?php echo $value['state_name'] ?></option>
                        <?php } ?>
                    </select>
                    <p id='state_error' style="color:red; display:none;">Please select state</p>
                </div>
              </div>
            </div>

            <div class="col-md-6" id='for_west_bengal'>
              <div class=" row">
                <div class="col-sm-12">
                  <label class=" col-form-label">District<font color="red">*</font></label>
                  <select class="form-control" id='district' name='district' onchange="generate_block_municipality($(this).val())">
                    <option value="0" selected>--Select District--</option>
                      <?php foreach ($districts as $value) { ?>
                        <option value="<?php echo $value['district_id_pk'] ?>"><?php echo $value['district_name'] ?></option>
                      <?php } ?>
                  </select>
                  <p id='dis_error' style="color:red; display:none;">Please select district</p>
                </div>
              </div>
            </div>

            <div class="col-md-6" id="block_div">
              <div class=" row">
                <div class="col-sm-12">
                  <label class="col-form-label">Block/Municipality<font color="red">*</font></label>
                  <select class="form-control" id='block_municipal' name='block_municipal' onchange="generate_ward_gp($(this).val())">
                    <option value="0" selected>--Select Block/Municipality--</option>
                  </select>
                  <p id='block_error' style="color:red; display:none;">Please select Block/Municipality</p>
                </div>
              </div>
            </div>
            <div class="col-md-6" id="ward_gp_div">
              <div class=" row">
                <div class="col-sm-12">
                  <label class=" col-form-label">Ward / GP<font color="red">*</font></label>
                    <select class="form-control" id='ward_gp' name='ward_gp'>
                    <option value="0" selected>--Select Ward / GP--</option>
                    </select>
                    <p id='ward_gp_error' style="color:red; display:none;">Please select Ward/GP</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12" id='for_other_state'>
              <div class="row" >
                <div class="col-sm-12">
                  <label class="col-form-label">Address <font color="red">*</font></label>
                  <textarea class="form-control" name="other_address" id="other_address" rows="3" placeholder="Address"></textarea>
                  <p id='other_address_error' style="color:red; display:none;">Please select Ward/GP</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-sm-12">
                  <label class=" col-form-label">Pin Code<font color="red">*</font></label>
                  <input type="text" placeholder="Pin Code" class="form-control" id="pin_code" autocomplete="off" name="pin_code" value="" min="0">
                  <p id='pin_error' style="color:red; display:none;">Enter pin code</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-sm-12">
                  <label class=" col-form-label">Police Station <font color="red">*</font></label>
                  <input type="text" placeholder="Police Station" class="form-control" id="police_station" autocomplete="off" name="police_station" value="">
                  <p id='police_station_error' style="color:red; display:none;">Enter police station</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-sm-12">
                  <label class="col-form-label">Phone No<font color="red">*</font></label>
                  <input type="text" placeholder="Phone No" class="form-control" id="mobile" autocomplete="off" name="mobile" value="">
                  <p id='mobile_error' style="color:red; display:none;">Enter Phone No</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-sm-12">
                  <label class="col-form-label">Remarks<font color="red">*</font></label>
                  <textarea class="form-control" id="remarks" name="remarks" placeholder="Remarks"></textarea>
                  <p id='remarks_error' style="color:red; display:none;">Enter Remarks</p>
                </div>
              </div>
            </div>
          </div>

          <input type="hidden" name="form_type" id="form_type" value="Save">
          <input type="hidden" name="hidden_incident_id" id="hidden_incident_id">
          <input type="hidden" name="hidden_cp_id" id="hidden_cp_id">
          <input type="hidden" name="hidden_cp_type_id" id="hidden_cp_type_id">
          <input type="hidden" name="hidden_reporting_id" id="hidden_reporting_id">
          <input type="hidden" name="hidden_incident_date" id="hidden_incident_date">

          <div class="modal-footer" style="text-align: right;">
            <button type="button" class="btn btn-primary" id="accept_btn" onclick="save_new_address()">Save</button>
            <button type="button" class="btn btn-danger" id="accept_btn" onclick="cancel_address_change_modal()">Cancel</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- Address Change Modal Start 17-01-2025 End -->


<!-- Police Case Modal Start 10-02-2025 Start -->
<div id="police_case_modal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog" style="width: 750px">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="police_modal_title"></h4>
      </div>
      <div class="modal-body" style="padding: 25px;padding-top: 10px">

        <div class="con_details" style="display: flex;justify-content: space-between;align-items: center;">
          <div style="width: 100%">
            <div class="row">
              <div class="col-md-6">
                <div>
                  <p>Intervention ID: </p>
                <h4 id="police_case_inter_id" style="font-weight: bold;"> </h4>
                </div>
              </div>
              <div class="col-md-6">
                <div>
                  <p>Intervention Date: </p>
                  <h4 id="police_inter_date" style="font-weight: bold;"></h4>
                </div>
              </div>
            </div>
          </div>
        </div>

        <label class="col-form-label" style="margin-top: 0">Intervention Address</label>
        <p id='incident_address'></p>
        <div class="row">
          <div class="col-md-6" id="cpone_address_div">
            <div class="custom-box">
              <h5 class="col-form-label" style="color: #5c5cbf; font-weight: bold;margin-top: 0">Contracting Party 1</h5>
              <p><strong id='cp_one_name'></strong></p>
              <div style="display: flex;">
                <p id="cp_one_gender"></p> <p id="cp_one_age"></p>
              </div>
              <p id='cp_one_address'></p>
            </div>
          </div>
          <div class="col-md-6" id="cptwo_address_div">
            <div class="custom-box">
              <h5 class="col-form-label" style="color: #5c5cbf;font-weight: bold;margin-top: 0">Contracting Party 2</h5>
              <p><strong id='cp_two_name'> </strong></p>
              <div style="display: flex;">
                <p id="cp_two_gender"></p> <p id="cp_two_age"></p>
              </div>
              <p id='cp_two_address'></p>
            </div>
          </div>
        </div>
         

        <div class="alert alert-warning" role="alert" id="police_exist_error" style="display:none;padding: 4px;max-width: 100%;color: #721c24 !important;background-color: #f8d7da !important;border-color: #f5c6cb !important;">
          A Police case registerd already been generated using these details.
        </div>

        <div class="alert alert-success" role="alert" id="police_success_msg" style="display:none ;padding: 4px;max-width: 100%;color: #155724!important;background-color: #d4edda!important;border-color: #c3e6cb!important">
          Success! Police case registerd submitted successfully.
        </div>

        <div class="alert alert-warning" role="alert" id="police_success_error" style="display:none;padding: 4px;max-width: 100%;color: #721c24 !important;background-color: #f8d7da !important;border-color: #f5c6cb !important;">
          Oops! Something went wrong. Please try again.
        </div>

        <form id="police_case_form_data">
          <div class="custom-box">
            <div class="row">
              <div class="col-md-6">
                <div class="custom-box">
                  <div>
                    <label class="col-form-label">GD No<font color="red">*</font></label>
                    <input type="text" placeholder="GD No only alphanumeric, slash, hyphen, space, and comma are allowed" class="form-control" id="gd_number" name="gd_number" autocomplete="off" value="" onkeyup="validateInput(1)">
                    <div id="gd_error" style="color: red; display: none;">Invalid GD Number. Only alphanumeric, slash, hyphen, space, and comma are allowed.</div>
                    <p class="error-message" id='gd_no_error' style="color:red; display:none;">Enter GD Number</p>
                  </div>
                  <div>
                    <label class="col-form-label">GD Date<font color="red">*</font></label>
                    <input type="text" placeholder="Enter GD Date" class="form-control datepicker" id="gd_date" name="gd_date" autocomplete="off" value="">
                    <p class="error-message" id='gd_date_error' style="color:red; display:none;">Enter GD Date</p>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="custom-box">
                  <div>
                    <label class="col-form-label">FIR No<font color="red">*</font></label>
                    <input type="text" placeholder="FIR No only alphanumeric, slash, hyphen, space, and comma are allowed" class="form-control" id="fir_no" name="fir_no" autocomplete="off" value="" onkeyup="validateInput(2)">
                    <div id="fir_error" style="color: red; display: none;">Invalid FIR Number. Only alphanumeric, slash, hyphen, space, and comma are allowed.</div>
                    <p class="error-message" id='fir_no_error' style="color:red; display:none;">Enter FIR No</p>
                  </div>
                  <div>
                    <label class="col-form-label">FIR Date<font color="red">*</font></label>
                    <input type="text" placeholder="Enter FIR Date" class="form-control datepicker" id="fir_date" autocomplete="off" name="fir_date" value="">
                    <p class="error-message" id='fir_date_error' style="color:red; display:none;">Enter FIR Date</p>
                  </div>
                </div>
              </div>
            </div>
          <!--  ---------------------------------------------------  -->

            <!-- <div class="row">
              <div class="col-sm-12">
                <label class="col-form-label">Street / Landmark</label>
                <input type="text" placeholder="Street / Landmark" class="form-control" id="police_case_landmark" autocomplete="off" name="police_case_landmark" value="" >
              </div>
            </div> -->

            <div class="row">
              <div class="col-md-6">
                <div class=" row">
                  <div class="col-sm-12">
                      <label class=" col-form-label">State<font color="red">*</font></label>
                      <input type="text" class="form-control" id='fir_state' name="fir_state" value="West Bengal" readonly>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class=" row">
                  <div class="col-sm-12">
                    <label class=" col-form-label">District<font color="red">*</font></label>
                    <select class="form-control" id='fir_district' name='fir_district' onchange="generate_fir_block_municipality($(this).val())">
                      <option value="0" selected>--Select District--</option>
                        <?php foreach ($districts as $value) { ?>
                          <option value="<?php echo $value['district_id_pk'] ?>"><?php echo $value['district_name'] ?></option>
                        <?php } ?>
                    </select>
                    <p class="error-message" id='fir_dis_error' style="color:red; display:none;">Please select district</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class=" row">
                  <div class="col-sm-12">
                    <label class="col-form-label">Block/Municipality<font color="red">*</font></label>
                    <select class="form-control" id='fir_block_municipal' name='fir_block_municipal' onchange="generate_fir_word_gp($(this).val())">
                      <option value="0" selected>--Select Block/Municipality--</option>
                    </select>
                    <p class="error-message" id='fir_block_error' style="color:red; display:none;">Please select Block/Municipality</p>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class=" row">
                  <div class="col-sm-12">
                    <label class=" col-form-label">Ward / GP<font color="red">*</font></label>
                      <select class="form-control" id='fir_ward_gp' name='fir_ward_gp'>
                      <option value="0" selected>--Select Ward / GP--</option>
                      </select>
                      <p class="error-message" id='fir_ward_gp_error' style="color:red; display:none;">Please select Ward/GP</p>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-md-6">
                <div class=" row">
                  <div class="col-sm-12">
                    <label class=" col-form-label">Police District<font color="red">*</font></label>
                    <select class="form-control" id='police_district' name='police_district' onchange="generate_police_station($(this).val())">
                      <option value="0" selected>--Select Police District--</option>
                    </select>
                      <p class="error-message" id='police_district_error' style="color:red; display:none;">Please select Police District</p>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class=" row">
                  <div class="col-sm-12">
                    <label class=" col-form-label">Police Station<font color="red">*</font></label>
                    <select class="form-control" id='police_case_station' name='police_case_station'>
                      <option value="0" selected>--Select Police Station--</option>
                    </select>
                      <p class="error-message" id='police_case_station_error' style="color:red; display:none;">Please select Police Station</p>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="row">
                  <div class="col-sm-12">
                    <label class="col-form-label">Person/s Filing complaint<font color="red">*</font></label>
                    <textarea class="form-control" id="filing_complaint" name="filing_complaint" placeholder="Enter Person/s Filing complaint.."></textarea>
                    <p class="error-message" id='complain_error' style="color:red; display:none;">Enter Person/s Filing complaint</p>
                  </div>
                </div>
              </div>
              
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-sm-12">
                    <label class="col-form-label">Person/s Accused<font color="red">*</font></label>
                    <textarea class="form-control" id="persons_accused" name="persons_accused" placeholder="Enter Person/s Accused.."></textarea>
                    <p class="error-message" id='persons_accused_error' style="color:red; display:none;">Enter Person/s Accused</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-sm-12">
                    <label class="col-form-label">Description of complaint <font color="red">*</font></label>
                    <textarea class="form-control" id="description_complain" name="description_complain" placeholder="Enter Description of complaint.."></textarea>
                    <p class="error-message" id='description_error' style="color:red; display:none;">Enter Description of complaint </p>
                  </div>
                </div>
              </div>
            </div>

            <!-- New add section 02-04-2025 starts -->
            <div class="row">
              <div class="col-sm-12">
              <label class="col-form-label">Name of officer <font color="red">*</font></label>
                <div class="col-sm-12">
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="off_first_name" name="off_first_name" placeholder="First name">
                    <p class="error-message" id='off_firstname_error' style="color:red; display:none;">Enter officer firts name</p>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="off_middle_name" name="off_middle_name" placeholder="Middle name">
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="off_last_name" name="off_last_name" placeholder="Last name">
                    <p class="error-message" id='off_lastname_error' style="color:red; display:none;">Enter officer last name </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="col-sm-12">
                   <label class="col-form-label">Designation<font color="red">*</font></label>
                   <select id="officer_designation" name="officer_designation" class="form-control">
                      <option value="0" selected>--Select Officer Designation--</option>
                      <option value="1">Inspector</option>
                      <option value="2">Sub-Inspector</option>
                      <option value="3">Assistant Sub-Inspector</option>
                   </select>
                   <p class="error-message" id='off_designation_error' style="color:red; display:none;">Enter officer designation </p>
                </div> 
              </div>
              <div class="col-md-6">
                <label class="col-form-label">PCMA 2006 Sections<font color="red">*</font></label>
                <div class="row">
                  <div class="col-md-4">
                    <input class="form-check-input" type="checkbox" id="section_9" name="pcma_section[]" value="9">
                    <label class="form-check-label" for="section_9">Section 9</label>
                  </div>
                  <div class="col-md-4">
                    <input class="form-check-input" type="checkbox" id="section_10" name="pcma_section[]" value="10">
                    <label class="form-check-label" for="section_10">Section 10</label>
                  </div>
                  <div class="col-md-4">
                    <input class="form-check-input" type="checkbox" id="section_11" name="pcma_section[]" value="11">
                    <label class="form-check-label" for="section_11">Section 11</label>
                  </div>
                  <p class="error-message" id='pcm_section_error' style="color:red; display:none;">Please Check PCMA Section</p>
                </div> 
              </div>

            </div>
            <!-- New add section 02-04-2025 END -->

          </div>

          <input type="hidden" name="polish_case_form_type" id="polish_case_form_type" value="save">
          <input type="hidden" name="police_incident_id" id="police_incident_id">
          <input type="hidden" name="police_reporting_id" id="police_reporting_id">
          <input type="hidden" name="police_cp_id" id="police_cp_id">
          <input type="hidden" name="police_cp_type" id="police_cp_type">

          <input type="hidden" name="police_incident_date" id="police_incident_date">

          <div class="modal-footer" style="text-align: right;">
            <button type="button" class="btn btn-primary" id="save_btn" onclick="police_case_register()">Save</button>
            <button type="button" class="btn btn-danger" id="cancel_btn" onclick="police_case_modal_cancel()">Cancel</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- Police Case Modal Start 17-01-2025 End -->

<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<?php
   if($this->session->userdata('subdiv') != '' && $this->session->userdata('stake_id_fk') == '4'){
     $message = "Forward to SDO?";
   }elseif($this->session->userdata('subdiv') == '' && $this->session->userdata('stake_id_fk') == '4'){
     $message = "Forward to BDO?";
   }
?>

<!-- ---------- Police Case Code 10-02-2025 Start -------------- -->
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',         // Date format (customize if needed)
            autoclose: true,              // Close on date selection
            todayHighlight: true,         // Highlight today's date
            orientation: "bottom auto",   // Adjust dropdown position
            startView: 2,                 // Year view by default (0: days, 1: months, 2: years)
            clearBtn: true,               // Add clear button
            endDate: "today"              // Prevent future dates (optional)
        });
    });
</script>

<script>
$(document).ready(function(){
    // $("#police_case_modal").modal('show');
    $("#gd_date, #fir_date").on("paste copy cut drag drop input",function(event){
        event.preventDefault(); // Block all user interactions
    });
});

function validateInput(flag) {
    // Define regex pattern to allow alphanumeric, slash, hyphen, space, and comma
    var regex = /^[A-Za-z0-9\s,\/-]*$/;
    
    var value = '';  // Initialize the value variable
    var errorMessage = '';
    // Determine which input field to use based on the flag value
    if (flag == 1) {
      value = $('#gd_number').val();
      errorMessage = 'Invalid GD Number. Only alphanumeric, slash, hyphen, space, and comma are allowed.';
    } else if (flag == 2) {
      value = $('#fir_no').val();
      errorMessage = 'Invalid FIR Number. Only alphanumeric, slash, hyphen, space, and comma are allowed.';
    }

    // Check if the input matches the allowed pattern
    if (!regex.test(value)) {
      // Show error message
      if (flag == 1) {
        $('#gd_error').text(errorMessage).show();  // Show error for GD Number
      } else if (flag == 2) {
        $('#fir_error').text(errorMessage).show();  // Show error for FIR Number
      }

      // Clean the invalid characters from the input
      if (flag == 1) {
        $('#gd_number').val(value.replace(/[^A-Za-z0-9\s,\/-]/g, ''));
      } else if (flag == 2) {
        $('#fir_no').val(value.replace(/[^A-Za-z0-9\s,\/-]/g, ''));
      }
    }else {
        // Hide error message if input is valid
        if (flag == 1) {
          $('#gd_error').hide();
        } else if (flag == 2) {
          $('#fir_error').hide();
        }
    }
}

function police_case(incident_id, cp_id, cp_type, reporting_id, incident_date, cp_name, cp_gender){
  
    if(cp_type==1){
      var cp='One';
    }else if(cp_type==2){
      var cp='Two';
    }
    var dateParts = incident_date.split("-");
    var year = dateParts[0];
    var month = dateParts[1];
    var day = dateParts[2]; 

    $('#police_incident_id').val(incident_id);
    $('#police_cp_id').val(cp_id);
    $('#police_cp_type').val(cp_type);
    $('#police_reporting_id').val(reporting_id);
    $('#police_incident_date').val(incident_date);
    
    $('#cp_id').val(cp_id);
    $('#police_case_inter_id').text(reporting_id);
    $('#police_inter_date').text(day+'-'+month+'-'+year);
    $('#police_modal_title').text('Police Case of Contracting Parties '+cp);

    get_intervention_address(incident_id);
    get_cp_address(incident_id,incident_date);

    $("#police_case_modal").modal('show');
}
  // Get Intervention Full Address
  function get_intervention_address(incident_id){
    //alert(incident_id);
    var url ='<?php echo base_url()?>admin/police_case/Police_case/intervention_address/';
      $.ajax({
        url: url,
        method: 'get',
        data: {incident_id:incident_id},
        dataType: 'json',
        success: function(result)
        {
          //console.log(result); 
          let addressParts = [
              result.street_landmark,
              result.ward_gp_name,
              result.block_name,
              result.police_station,
              result.district_name,
              result.pin_code
          ];
          // Filter out empty or null values
          let filteredAddress=addressParts.filter(part =>part && part.trim() !=='').join(', ');

          // Convert the address so that the first letter of each word is uppercase and the rest is lowercase
          let formattedAddress_one = filteredAddress.replace(/\b\w/g, function(char) {
            return char.toUpperCase(); // Capitalize first letter
          }).replace(/\B\w/g, function(char) {
            return char.toLowerCase(); // Lowercase remaining letters
          });
          // Set the text only if there's a valid address
          if (formattedAddress_one) {
            $("#incident_address").text(formattedAddress_one);
          }

        }
      });
  }

  // Get CP Full Address
  function get_cp_address(incident_id,incident_date){

    var url = '<?php echo base_url()?>admin/police_case/Police_case/cps_address/';
      $.ajax({
        url: url,
        method: 'get',
        data: {incident_id:incident_id, incident_date:incident_date} ,
        dataType: 'json',
        success: function(result)
        {
          // alert(result.length);
          console.log(result); 
          // Clear the text of cp_one_address and cp_two_address before filling with new values
          $("#cp_one_name").text('');
          $("#cp_one_address").text('');
          $("#cp_two_name").text('');
          $("#cp_two_address").text('');

          if(result && result.length===1){

              $("#cptwo_address_div").hide();
              let cp_one_address_fill = [];
              if(result[0] && result[0].cp_type==1 && result[0].cp_state==1){
                  cp_one_address_fill = [
                    result[0].cp_street_landmark,
                    result[0].district_name,
                    result[0].block_name,
                    result[0].ward_gp_name,
                    result[0].cp_police_station,
                    result[0].cp_pin_code
                  ];
              }else if(result[0] && result[0].cp_type==1 && result[0].cp_state==2){
                  cp_one_address_fill = [
                    result[0].cp_street_landmark,
                    result[0].cp_address,
                    result[0].cp_police_station,
                    result[0].cp_pin_code
                  ];
              }
              // Filter out empty or null values
              let filtere_cp1_dAddress=cp_one_address_fill.filter(part=>part && part.trim()!=='').join(', ');

              // Convert the address so that the first letter of each word is uppercase and the rest is lowercase
              let formattedAddress_one = filtere_cp1_dAddress.replace(/\b\w/g, function(char) {
                return char.toUpperCase(); // Capitalize first letter
              }).replace(/\B\w/g, function(char) {
                return char.toLowerCase(); // Lowercase remaining letters
              });

              // Set the text only if there's a valid address
              if (formattedAddress_one) {
                $("#cp_one_name").text(result[0].cp_name);
                $("#cp_one_gender").text(result[0].gender+', ');
                $("#cp_one_age").text(result[0].age_years+' year, '+result[0].age_months+' months, '+result[0].age_days+' days');
                $("#cp_one_address").text(formattedAddress_one);
              }

          }else if(result && result.length===2){

              $("#cptwo_address_div").show();
              let cp_one_address_fill = [];
              if(result[0] && result[0].cp_type==1 && result[0].cp_state==1){
                  cp_one_address_fill = [
                    result[0].cp_street_landmark,
                    result[0].district_name,
                    result[0].block_name,
                    result[0].ward_gp_name,
                    result[0].cp_police_station,
                    result[0].cp_pin_code
                  ];
              }else if(result[0] && result[0].cp_type==1 && result[0].cp_state==2){
                  cp_one_address_fill = [
                    result[0].cp_street_landmark,
                    result[0].cp_address,
                    result[0].cp_police_station,
                    result[0].cp_pin_code
                  ];
              }
              // Filter out empty or null values
              let filtere_cp1_dAddress=cp_one_address_fill.filter(part=>part && part.trim()!=='').join(', ');

              // Convert the address so that the first letter of each word is uppercase and the rest is lowercase
              let formattedAddress_one = filtere_cp1_dAddress.replace(/\b\w/g, function(char) {
                return char.toUpperCase(); // Capitalize first letter
              }).replace(/\B\w/g, function(char) {
                return char.toLowerCase(); // Lowercase remaining letters
              });

              // Set the text only if there's a valid address
              if (formattedAddress_one) {
                $("#cp_one_name").text(result[0].cp_name);
                $("#cp_one_gender").text(result[0].gender+', ');
                $("#cp_one_age").text(result[0].age_years+' year, '+result[0].age_months+' months, '+result[0].age_days+' days');
                $("#cp_one_address").text(formattedAddress_one);
              }
              
              let cp_two_address_fill = [];
              if(result[1] && result[1].cp_type==2 && result[1].cp_state==1){
                  cp_two_address_fill = [
                    result[1].cp_street_landmark,
                    result[1].district_name,
                    result[1].block_name,
                    result[1].ward_gp_name,
                    result[1].cp_police_station,
                    result[1].cp_pin_code
                  ];
              }else if(result[1] && result[1].cp_type==2 && result[1].cp_state==2){
                  cp_two_address_fill = [
                    result[1].cp_street_landmark,
                    result[1].cp_address,
                    result[1].cp_police_station,
                    result[1].cp_pin_code
                  ];
              }
              // Filter out empty or null values
              let filtere_cp2_dAddress=cp_two_address_fill.filter(part=>part && part.trim()!=='').join(', ');

              // Convert the address so that the first letter of each word is uppercase and the rest is lowercase
              let formattedAddress_two = filtere_cp2_dAddress.replace(/\b\w/g, function(char) {
                return char.toUpperCase(); // Capitalize first letter
              }).replace(/\B\w/g, function(char) {
                return char.toLowerCase(); // Lowercase remaining letters
              });

              // Set the text only if there's a valid address
              if (formattedAddress_two) {
                $("#cp_two_name").text(result[1].cp_name);
                $("#cp_two_gender").text(result[1].gender+', ');
                $("#cp_two_age").text(result[1].age_years+' year, '+result[1].age_months+' months, '+result[1].age_days+' days');
                $("#cp_two_address").text(formattedAddress_two);
              }
          }

        } // Success Function END
      });
  }

  // Generate FIR Block and municipality select by district
  function generate_fir_block_municipality(district_id)
  {
      //Create block and municipality dynamically
      var url = '<?php echo base_url()?>admin/reporting/incident/Incident_list/get_block_municipality/';
      $.ajax({
          url: url,
          method: 'get',
          data: {district_id:district_id} ,
          dataType: 'json',
          success: function(result)
          {
            //console.log(result);
            $('#fir_block_municipal').empty();
            $('#fir_ward_gp').empty();
            $('#fir_block_municipal').append('<option value="0" selected>--Select Block/Municipality--</option>');
            $('#fir_ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

            $.each(result, function (index, item) {
              var option = '<option value="'+item.block_id_pk+':'+item.rural_urban+'">'+item.block_name+'</option>';
              $("#fir_block_municipal").append(option);
            });
          }
      });

      //Create Police District dynamically
      var url = '<?php echo base_url()?>admin/reporting/incident/Incident_list/get_police_district/';
      $.ajax({
          url: url,
          method: 'get',
          data: {district_id:district_id} ,
          dataType: 'json',
          success: function(result)
          {
            //console.log(result);
            $('#police_district').empty();
            $('#police_district').append('<option value="0" selected>--Select Police District--</option>');
            
            $.each(result, function (index, item) {
              var option = '<option value="'+item.police_district_id_pk+'">'+item.police_district_name+'</option>';
              $("#police_district").append(option);
            });
          }
      });
  }

  // Generate police station dynamic selected by district id
  function generate_police_station(police_district_id){

      var url = '<?php echo base_url()?>admin/reporting/incident/Incident_list/get_police_station/';
      $.ajax({
          url: url,
          method: 'get',
          data: {police_district_id:police_district_id} ,
          dataType: 'json',
          success: function(result)
          {
            console.log(result);
            $('#police_case_station').empty();
            $('#police_case_station').append('<option value="0" selected>--Select Police Station--</option>');
            
            $.each(result, function (index, item) {
              var option = '<option value="'+item.police_station_id_pk+'">'+item.police_station_name+'</option>';
              $("#police_case_station").append(option);
            });
          }
      });
  }

  function generate_fir_word_gp(block_municipal_id){
    
    var result = block_municipal_id.split(':');
    var block_municipal_id = result[0];
    var ruralurban_flag = result[1];
    
      if(ruralurban_flag=='U'){
        // Get Ward data
          var url = '<?php echo base_url()?>admin/reporting/incident/Incident_list/get_ward_data/';
          $.ajax({
              url: url,
              method: 'get',
              data: {block_id:block_municipal_id} ,
              dataType: 'json',
              success: function(result)
              {
                console.log(result);
                $('#fir_ward_gp').empty();
                $('#fir_ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

                $.each(result, function (index, item) {
                  var option = '<option value="'+item.ward_id_pk+'">'+item.ward_no+'</option>';
                  $("#fir_ward_gp").append(option);
                });
              }
          });

      }else{
        // Get GP data
          var url = '<?php echo base_url()?>admin/reporting/incident/Incident_list/get_gp_data/';
          $.ajax({
              url: url,
              method: 'get',
              data: {block_id:block_municipal_id} ,
              dataType: 'json',
              success: function(result)
              {
                console.log(result);
                $('#fir_ward_gp').empty();
                $('#fir_ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

                $.each(result, function (index, item) {
                  var option = '<option value="'+item.gp_id_pk+'">'+item.gp_name+'</option>';
                  $("#fir_ward_gp").append(option);
                });
              }
          });
      }

  }

  function police_case_modal_cancel(){
    $('#cp_id').val('');
    $('#gd_number').val('');
    $('#gd_date').val('');
    $('#fir_no').val('');
    $('#fir_date').val('');
    // $('#police_case_landmark').val('');
    $('#filing_complaint').val('');
    $('#persons_accused').val('');
    $('#description_complain').val('');

    $('#off_first_name').val('');
    $('#off_middle_name').val('');
    $('#off_last_name').val('');
    $('#officer_designation option:selected').prop('selected', false);
    $('#section_9').prop('checked', false);
    $('#section_10').prop('checked', false);
    $('#section_11').prop('checked', false);

    $('#fir_district option:selected').prop('selected', false);
    $('#fir_block_municipal option:selected').prop('selected', false);
    $('#fir_ward_gp option:selected').prop('selected', false);
    $('#police_district option:selected').prop('selected', false);
    $('#police_case_station option:selected').prop('selected', false);

    $('#police_case_modal').modal('hide');
  }

  function police_case_register(){

      var gd_number = $('#gd_number').val().trim();
      var gd_date   = $('#gd_date').val().trim();
      var fir_no    = $('#fir_no').val().trim();
      var fir_date  = $('#fir_date').val().trim();

      // var police_case_landmark= $('#police_case_landmark').val();
      var fir_state           = $('#fir_state').val();
      var fir_district        = $('#fir_district').val();
      var fir_block_municipal = $('#fir_block_municipal').val();
      var fir_ward_gp         = $('#fir_ward_gp').val();
      var police_district     = $('#police_district').val();
      var police_case_station = $('#police_case_station').val();
     
      var filing_complaint    = $('#filing_complaint').val().trim();
      var persons_accused     = $('#persons_accused').val().trim();
      var description_complain= $('#description_complain').val().trim();

      var off_first_name      = $('#off_first_name').val();
      var off_middle_name     = $('#off_middle_name').val();
      var off_last_name       = $('#off_last_name').val();
      var officer_designation = $('#officer_designation').val();
  
      var section_9   = $('#section_9').is(':checked') ? $('#section_9').val() : '';
      var section_10  = $('#section_10').is(':checked') ? $('#section_10').val() : '';
      var section_11  = $('#section_11').is(':checked') ? $('#section_11').val() : '';
      
      var polish_case_form_type= $('#polish_case_form_type').val();
      var police_incident_id   = $('#police_incident_id').val();
      var police_cp_id         = $('#police_cp_id').val();
      var police_cp_type       = $('#police_cp_type').val();
      var police_reporting_id  = $('#police_reporting_id').val();
      var hidden_incident_date = $('#police_incident_date').val().trim();

      // Formated Incident date 
      var dateParts = hidden_incident_date.split("-");
      var day = dateParts[0];
      var month = dateParts[1];
      var year = dateParts[2]; 
      var incident_date = day+'/'+month+'/'+year;

      // Formated GD date
      var gd_date_formate = gd_date.split("/");
      var month = gd_date_formate[0];
      var day = gd_date_formate[1];
      var year = gd_date_formate[2];
      var gd_date_dmy = day+'/'+month+'/'+year;

      // Formated FIR Date
      var fir_date_formate = fir_date.split("/");
      var month = fir_date_formate[0];
      var day = fir_date_formate[1];
      var year = fir_date_formate[2];
      var fir_date_dmy = day+'/'+month+'/'+year;

      var incident_date     = new Date(incident_date);  // YYYY-MM-DD format
      var gd_date_validate  = new Date(gd_date_dmy);  // MM/DD/YYYY format
      var fir_date_validate = new Date(fir_date_dmy);  // MM/DD/YYYY format

      $(".error-message").fadeOut(500); // Hide all error messages initially
      var isValid = true; // Flag to track form validity
      
      // Validation checks
        if (gd_number === '') {
            showError("#gd_no_error");
            isValid = false;
        } 
        else if (gd_date === '' || gd_date === null) {
            showError("#gd_date_error");
            isValid = false;
        } 
        else if (fir_no === '') {
            showError("#fir_no_error");
            isValid = false;
        } 
        else if (fir_date === '' || gd_date === null) {
            showError("#fir_date_error");
            isValid = false;
        } 
        else if (incident_date > gd_date_validate) {
            $("#gd_date_error").text("GD Date should be greater than the incident date").fadeIn(1000);
            isValid = false;
        } 
        else if (incident_date > fir_date_validate) {
            $("#fir_date_error").text("FIR Date should be greater than the incident date").fadeIn(1000);
            isValid = false;
        } 
        else if (fir_district === '0') {
            showError("#fir_dis_error");
            isValid = false;
        } 
        else if (fir_block_municipal === '0') {
            showError("#fir_block_error");
            isValid = false;
        } 
        else if (fir_ward_gp === '0') {
            showError("#fir_ward_gp_error");
            isValid = false;
        } 
        else if (police_district === '0') {
            showError("#police_district_error");
            isValid = false;
        } 
        else if (police_case_station === '0') {
            showError("#police_case_station_error");
            isValid = false;
        } 
        else if (filing_complaint === '') {
            showError("#complain_error");
            isValid = false;
        } 
        else if (persons_accused === '') {
            showError("#persons_accused_error");
            isValid = false;
        } 
        else if (description_complain === '') {
            showError("#description_error");
            isValid = false;
        }
        else if (off_first_name == '') {
            showError("#off_firstname_error");
            isValid = false;
        }else if (off_last_name == '') {
            showError("#off_lastname_error");
            isValid = false;
        }else if (officer_designation === '0') {
            showError("#off_designation_error");
            isValid = false;
        }else if (!$('#section_9').is(':checked') && !$('#section_10').is(':checked') && !$('#section_11').is(':checked')) {
            showError("#pcm_section_error");
            isValid = false;
        }
        // If validation fails, stop form submission
        if (!isValid) return;
        $(".error-message").fadeOut(500); // Hide all errors if everything is correct

        // Serialize form data
        var formData = $('#police_case_form_data').serialize();
        var url = "<?php echo base_url()?>admin/police_case/Police_case/police_case_register/";
        // AJAX Request for Form Submission
        $.ajax({
            url: url, 
            method: 'GET',
            data: formData,
            // dataType: 'json',
            success: function(result) {
                if (result == 1) {
                    $('#police_exist_error').fadeIn();
                    setTimeout(() => { $('#police_exist_error').fadeOut(); }, 3000);
                } else if (result == 2) {
                    $('#save_btn').text('Loading....');
                    $('#save_btn').prop('disabled', true);
                    $('#police_success_msg').fadeIn();
                    setTimeout(() => { $('#police_success_msg').fadeOut(); }, 3000);
                    setTimeout(() => {
                        window.location.href = "<?php echo base_url()?>admin/police_case/Police_case/police_case_register_data/";
                    }, 4000);
                } else if (result == 3) {
                    $('#police_success_error').fadeIn();
                    setTimeout(() => { $('#police_success_error').fadeOut(); }, 3000);
                }
            }
        });

        // Function to Show Error Messages
        function showError(selector) {
            $(".error-message").fadeOut(500); // Hide all errors first
            $(selector).fadeIn(1000); // Show only the relevant error
        }

  }

</script>

<!-- ----------  Police Case Code 10-02-2025 End -------------- -->


<!-- ---------- Address Change code 17-01-2025 start ----------- -->
<script>
  $(document).ready(function() {
    $('#for_west_bengal').show();
    $('#block_div').show();
    $('#ward_gp_div').show();
    $('#for_other_state').hide();

  });

  $('#mobile').on('input', function() {
    // Remove anything that is not a number
    this.value = this.value.replace(/[^0-9]/g, '');
    // Ensure the length of the input is exactly 10 digits
    if (this.value.length > 10) {
      this.value = this.value.slice(0, 10); // Keep only the first 10 digits
    }
  });

  $('#pin_code').on('input', function() {
    // Remove anything that is not a number
    this.value = this.value.replace(/[^0-9]/g, '');
    // Ensure the length of the input is exactly 10 digits
    if (this.value.length > 6) {
      this.value = this.value.slice(0, 6); // Keep only the first 10 digits
    }
  });
  
  function open_address_change_modal(incident_id, cp_id, cp_type, reporting_id, incident_date, cp_name, cp_gender){

    if(cp_type==1){
      var cp='One';
    }else if(cp_type==2){
      var cp='Two';
    }
    var dateParts = incident_date.split("-");
    var year = dateParts[0];
    var month = dateParts[1];
    var day = dateParts[2]; 

    $('#hidden_incident_id').val(incident_id);
    $('#hidden_cp_id').val(cp_id);
    $('#hidden_cp_type_id').val(cp_type);
    $('#hidden_reporting_id').val(reporting_id);
    $('#hidden_incident_date').val(incident_date);

    $('#inter_id').text(reporting_id);
    $('#inter_date').text(day+'-'+month+'-'+year);
    $('#cp_name_level').text('Contracting Parties '+cp+' Name:');
    $('#cp_name_id').text(cp_name);
    $('#cp_gender_lavel').text('Contracting Parties '+cp+' Gender:');
    $('#cp_gender_id').text(cp_gender);
    $('#title').text('Change Address of Contracting Parties '+cp);
    $('#street_landmark').val('');
    
    $('#district option:selected').prop('selected', false);
    $('#block_municipal option:selected').prop('selected', false);
    $('#ward_gp option:selected').prop('selected', false);
    $('#address_change_modal').modal('show');
  }

  // Chech WB State or Outside WB State for Address Change Module
  function check_state(state_id){
    if(state_id==1){
      $('#for_west_bengal').show();
      $('#block_div').show();
      $('#ward_gp_div').show();
      $('#for_other_state').hide();
      $('#other_address').val('');
    }else if(state_id==2){
      $('#for_west_bengal').hide();
      $('#block_div').hide();
      $('#ward_gp_div').hide();
      $('#for_other_state').show();

      $('#district option:selected').prop('selected', false);
      $('#block_municipal option:selected').prop('selected', false);
      $('#ward_gp option:selected').prop('selected', false);
    }
  }

  // Generate Block and municipality select by district of Address Change Module
  function generate_block_municipality(district_id=null)
  {
    var url = '<?php echo base_url()?>admin/address_change/Address_change/get_block_municipality/';
    $.ajax({ 
        url: url,
        method: 'get',
        data: {district_id:district_id} ,
        dataType: 'json',
        success: function(result)
        {
          //console.log(result);
          $('#block_municipal').empty();
          $('#block_municipal').append('<option value="0" selected>--Select Block/Municipality--</option>');
          $('#ward_gp').empty();
          $('#ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

          $.each(result, function (index, item) {
            var option = '<option value="'+item.block_id_pk+':'+item.rural_urban+'">'+item.block_name+'</option>';
            $("#block_municipal").append(option);
          });
        }
    });
  }

  // Generate GP and word select by block/municipality of Address Change Module
  function generate_ward_gp(block_municipal_id=null){

    var result = block_municipal_id.split(':');
    var block_municipal_id = result[0];
    var ruralurban_flag = result[1];
    
      if(ruralurban_flag=='U'){
        // Get Ward data
          var url ='<?php echo base_url()?>admin/address_change/Address_change/get_ward_data/';
            $.ajax({
                url: url,
                method: 'get',
                data: {block_id:block_municipal_id} ,
                dataType: 'json',
                success: function(result)
                {
                  //console.log(result);
                  $('#ward_gp').empty();
                  $('#ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

                  $.each(result, function (index, item) {
                    var option = '<option value="'+item.ward_id_pk+'">'+item.ward_no+'</option>';
                    $("#ward_gp").append(option);
                  });
                }
            });
      }else{
        // Get GP data
          var url = '<?php echo base_url()?>admin/address_change/Address_change/get_gp_data/';
            $.ajax({
                url: url,
                method: 'get',
                data: {block_id:block_municipal_id} ,
                dataType: 'json',
                success: function(result)
                {
                  //console.log(result);
                  $('#ward_gp').empty();
                  $('#ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

                  $.each(result, function (index, item) {
                    var option = '<option value="'+item.gp_id_pk+'">'+item.gp_name+'</option>';
                    $("#ward_gp").append(option);
                  });
                }
            });
      }
        
  }

  // Save the New Requested Address for Address Change Module
  function save_new_address(){
    
      var street_landmark = $('#street_landmark').val();
      var state           = $('#state').val();
      var district        = $('#district').val();
      var block_municipal = $('#block_municipal').val();
      var ward_gp         = $('#ward_gp').val();
      var other_address   = $('#other_address').val();
      var pin_code        = $('#pin_code').val();
      var police_station  = $('#police_station').val();
      var mobile          = $('#mobile').val();
      var remarks         = $('#remarks').val();

      var hidden_incident_id   = $('#hidden_incident_id').val();
      var hidden_cp_id         = $('#hidden_cp_id').val();
      var hidden_cp_type       = $('#hidden_cp_type_id').val();
      var hidden_reporting_id  = $('#hidden_reporting_id').val();
      var hidden_incident_date = $('#hidden_incident_date').val();

      if(state==='1'){
        
          if(state==''){
            $('#state_error').fadeIn(1000); 
            $('#dis_error, #block_error, #ward_gp_error').fadeOut(500); // Hide others
          }
          else if (district === '0') {
            // Hide all error messages except district
            $('#dis_error').fadeIn(1000);
            $('#state_error, #block_error, #ward_gp_error').fadeOut(500); // Hide others
          }
          else if (block_municipal === '0') {
            $('#block_error').fadeIn(1000);
            $('#state_error, #dis_error, #ward_gp_error').fadeOut(500); // Hide others
          }
          else if (ward_gp === '0') {
            $('#ward_gp_error').fadeIn(1000);
            $('#state_error, #dis_error, #block_error').fadeOut(500); // Hide others
          }
          else if (pin_code == '') {
            $('#pin_error').fadeIn(1000);
            $('#state_error, #dis_error, #block_error, #ward_gp_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (!/^\d{6}$/.test(pin_code)) {
              // Check if pin code is exactly 6 digits
              $('#pin_error').text('Please enter a valid 6-digit pin code').fadeIn(1000);
              $('#state_error, #dis_error, #block_error, #ward_gp_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (police_station == '') {
            $('#police_station_error').fadeIn(1000);
            $('#state_error, #dis_error, #block_error, #pin_error, #ward_gp_error, #mobile_error').fadeOut(500); // Hide others
          }
          else if (mobile == '') {
            $('#mobile_error').fadeIn(1000);
            $('#state_error, #dis_error, #block_error, #pin_error, #ward_gp_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (!/^\d{10}$/.test(mobile)) {
              // Check if mobile number is exactly 10 digits
              $('#mobile_error').text('Please enter a valid 10-digit mobile number').fadeIn(1000);
              $('#state_error, #dis_error, #block_error, #pin_error, #ward_gp_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (remarks == '') {
            $('#remarks_error').fadeIn(1000);
            $('#state_error, #dis_error, #block_error, #pin_error, #ward_gp_error, #police_station_error, #mobile_error').fadeOut(500); // Hide others
          }else{

            $('#state_error, #dis_error, #block_error, #pin_error, #ward_gp_error, #police_station_error, #mobile_error, #remarks_error').fadeOut(500); // Hide others

              var formData = $('#address_change_form').serialize();
              // alert(formData);
              var url = '<?php echo base_url()?>admin/address_change/Address_change/save_address_changed_data/';
              $.ajax({
                  url: url,
                  method: 'get',
                  data: {formData} ,
                  // dataType: 'json',
                  success: function(result)
                  {
                    // console.log(result);
                    if(result==1){
                        $('#exist_error').fadeIn();
                        setTimeout(function() {
                          $('#exist_error').fadeOut();
                        }, 3000);
                         
                    }else if(result==2){

                        $('#success_msg').fadeIn();
                          setTimeout(function() {
                            $('#success_msg').fadeOut();
                          }, 3000);

                        setTimeout(function() {
                          var redirect_url = "<?php echo base_url()?>admin/address_change/Address_list/";
                          window.location.href = redirect_url;
                        }, 4000); 

                    }else if(result==3){
                        $('#success_error').fadeIn();
                        setTimeout(function() {
                          $('#success_error').fadeOut();
                        }, 3000);
                    }

                  }
              });
             
          }
      }else if(state==='2'){  // CHECK FOR OTHER STATE
      
          if(state==''){
            $('#state_error').fadeIn(1000); 
            $('#pin_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (other_address == '') {
            $('#other_address_error').fadeIn(1000);
            $('#state_error, #pin_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (pin_code == '') {
            $('#pin_error').fadeIn(1000);
            $('#state_error, #other_address_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (!/^\d{6}$/.test(pin_code)) {
              // Check if pin code is exactly 6 digits
              $('#pin_error').text('Please enter a valid 6-digit pin code').fadeIn(1000);
              $('#state_error, #dis_error, #block_error, #ward_gp_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (police_station == '') {
            $('#police_station_error').fadeIn(1000);
            $('#state_error, #other_address_error, #pin_error, #mobile_error').fadeOut(500); // Hide others
          }
          else if (mobile == '') {
            $('#mobile_error').fadeIn(1000);
            $('#state_error, #other_address_error, #pin_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (!/^\d{10}$/.test(mobile)) {
              // Check if mobile number is exactly 10 digits
              $('#mobile_error').text('Please enter a valid 10-digit mobile number').fadeIn(1000);
              $('#state_error, #dis_error, #block_error, #pin_error, #ward_gp_error, #police_station_error').fadeOut(500); // Hide others
          }
          else if (remarks == '') {
            $('#remarks_error').fadeIn(1000);
            $('#state_error, #other_address_error, #pin_error, #police_station_error, #mobile_error').fadeOut(500); // Hide others
          }else{

            $('#state_error, #other_address_error, #pin_error, #police_station_error, #mobile_error, #remarks_error').fadeOut(500); // Hide others

              var formData = $('#address_change_form').serialize();
              // alert(formData);
              var url = '<?php echo base_url()?>admin/address_change/Address_change/save_address_changed_data/';
              $.ajax({
                  url: url,
                  method: 'get',
                  data: {formData} ,
                  dataType: 'json',
                  success: function(result)
                  {
                      if(result==1){
                          $('#exist_error').fadeIn();
                          setTimeout(function() {
                            $('#exist_error').fadeOut();
                          }, 3000);
                            
                      }else if(result==2){
                          $('#success_msg').fadeIn();
                          setTimeout(function() {
                            $('#success_msg').fadeOut();
                          }, 3000);

                          setTimeout(function() {
                            var redirect_url = "<?php echo base_url()?>admin/address_change/Address_list/";
                            window.location.href = redirect_url;
                          }, 4000); 

                      }else if(result==3){
                          $('#success_error').fadeIn();
                          setTimeout(function() {
                            $('#success_error').fadeOut();
                          }, 3000);
                      }
                  }
              });
          }

      }

  }

  // Cancel Address Change 
  function cancel_address_change_modal(){
    $('#street_landmark').val('');
    $('#pin_code').val('');
    $('#police_station').val('');
    $('#mobile').val('');
    $('#remarks').val('');
    $('#address_change_modal').modal('hide');
  }
</script>
<!-- ---------- Address Change code 17-01-2025 End ----------- -->

<script type="text/javascript">
   function close_address_modal()
   {
     location.reload();
   }
   
   // Reset Date Search
   $('#reset_btn').click(function() {
       location.reload();
   });
  function view_details(incident_id=null)
  {
    var url = '<?php echo base_url()?>admin/reporting/incident/Incident_list/incident_view_details/';
        // alert(csrf_token); 
        $.ajax({
              url: url,
              method: 'get',
              data: {incident_id_pk:incident_id} ,
              //dataType: 'json',
              success: function(result)
              {
                // console.log(result);
                $('.upload-dynamic').html(result);
                $('#myModal').modal('show');

              }
            });
  }
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

      // Send_Intervention_message(rr_id);

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
                  var status = response.status;
                  var incident_id = response.incident_id;
                  var district_id = response.district_id;

                  // alert(district_id);
                  if(status==1){
                      swal("Published!", "Publish success", "success");
                      setTimeout(function(){
                           window.location.reload();
                      }, 2000);

                      if(district_id=='2'){
                           Send_Intervention_message(incident_id);
                      }
                  }

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

   // ---------- 26-11-2024 Send Message During Intervention Start ----------
   // Send Message When Intervention Published
   function Send_Intervention_message(incident_id){

      // alert('ID ----'+incident_id);
      $.ajax({
              url:"reporting/incident/incident_list/intervention_message",
              method:"GET",
              data:{incident_id:incident_id},
              dataType:"JSON",
              success:function(response)
              {

               // console.log(response);
               // alert('SNO->>'+response.sno_msg_details.sno_user.length+'----'+response.sno_msg_details.sno_msg_body.msg.length);

               let loginId, msg;
               let inc_deo_loginId, inc_deo_msg;
               let cp1_cmpo_loginId, cp1_cmpo_msg;
               let cp2_cmpo_loginId, cp2_cmpo_msg;

               if(response.incident_sdo_bdo_msg_details?.incident_sdo_bdo_user?.login_id?.length > 0 && response.incident_sdo_bdo_msg_details?.incident_sdo_bdo_msg_body?.msg?.length > 0) {

                  loginId=response.incident_sdo_bdo_msg_details.incident_sdo_bdo_user.login_id;
                  msg=response.incident_sdo_bdo_msg_details.incident_sdo_bdo_msg_body.msg.replace(/(\+|%3A)/g, ' ');

               }else{
                  loginId="LoginId Not exist";
                  msg = "SMS Not Send";
               }
                  
               if(response.incident_deo_msg_details?.incident_deo_user?.login_id?.length > 0 && response.incident_deo_msg_details?.incident_deo_msg_body?.msg?.length > 0){

                  inc_deo_loginId=response.incident_deo_msg_details.incident_deo_user.login_id;
                  inc_deo_msg=response.incident_deo_msg_details.incident_deo_msg_body.msg.replace(/(\+|%3A)/g, ' ');

               }else{

                  inc_deo_loginId='LoginId Not exist';
                  inc_deo_msg='SMS Not Send';
               }

               if(response.cp1_cmpo_msg_details?.cp1_cmpo_send_user?.login_id?.length > 0 && response.cp1_cmpo_msg_details?.cp1_cmpo_msg_body?.msg?.length > 0) {

                  cp1_cmpo_loginId=response.cp1_cmpo_msg_details.cp1_cmpo_send_user.login_id;
                  cp1_cmpo_msg=response.cp1_cmpo_msg_details.cp1_cmpo_msg_body.msg.replace(/(\+|%3A)/g, ' ');
               }else{
                  cp1_cmpo_loginId ='LoginId Not exist';
                  cp1_cmpo_msg='SMS Not Send';
               }

               
               if(response.cp2_cmpo_msg_details?.cp2_cmpo_user?.login_id?.length > 0 &&
                  response.cp2_cmpo_msg_details?.cp2_cmpo_msg_body?.msg?.length > 0) {

                  cp2_cmpo_loginId=response.cp2_cmpo_msg_details.cp2_cmpo_user.login_id;
                  cp2_cmpo_msg=response.cp2_cmpo_msg_details.cp2_cmpo_msg_body.msg.replace(/(\+|%3A)/g, ' ');
               }else{
                  cp2_cmpo_loginId='LoginId Not exist';
                  cp2_cmpo_msg='SMS Not Send';
               }

               let cp1_sdo_bdo_loginId, cp1_sdo_bdo_msg;

               if(response.cp1_sdo_bdo_msg_details?.cp1_sdo_bdo_send_user?.login_id?.length > 0 && response.cp1_sdo_bdo_msg_details?.cp1_sdo_bdo_msg_body?.msg?.length > 0) {


                  cp1_sdo_bdo_loginId=response.cp1_sdo_bdo_msg_details.cp1_sdo_bdo_send_user.login_id;
                  cp1_sdo_bdo_msg=response.cp1_sdo_bdo_msg_details.cp1_sdo_bdo_msg_body.msg.replace(/(\+|%3A)/g, ' ');
               
               }else{
                  cp1_sdo_bdo_loginId='LoginId Not exist';
                  cp1_sdo_bdo_msg='SMS Not Send';
               }


               let cp1_deo_loginId, cp1_deo_msg;
               if(response.cp1_deo_msg_details?.cp1_deo_send_user?.login_id?.length > 0 &&
                  response.cp1_deo_msg_details?.cp1_deo_msg_body?.msg?.length > 0)
               {

                  cp1_deo_loginId=response.cp1_deo_msg_details.cp1_deo_send_user.login_id;
                  cp1_deo_msg=response.cp1_deo_msg_details.cp1_deo_msg_body.msg.replace(/(\+|%3A)/g, ' ');

               }else{
                  cp1_deo_loginId='LoginId Not exist';
                  cp1_deo_msg='SMS Not Send';
               }

               let cp2_sdo_bdo_loginId, cp2_sdo_bdo_msg;
               if(response.cp2_sdo_bdo_msg_details?.cp2_sdo_bdo_user?.login_id?.length > 0 &&
                  response.cp2_sdo_bdo_msg_details?.cp2_sdo_bdo_msg_body?.msg?.length > 0)
               {

                  cp2_sdo_bdo_loginId=response.cp2_sdo_bdo_msg_details.cp2_sdo_bdo_user.login_id;
                  cp2_sdo_bdo_msg=response.cp2_sdo_bdo_msg_details.cp2_sdo_bdo_msg_body.msg.replace(/(\+|%3A)/g, ' ');

               }else{
                  cp2_sdo_bdo_loginId='LoginId Not exist';
                  cp2_sdo_bdo_msg='SMS Not Send';
               }


               let cp2_deo_loginId, cp2_deo_msg;
               if(response.cp2_deo_msg_details?.cp2_deo_user?.login_id?.length > 0 &&
                  response.cp2_deo_msg_details?.cp2_deo_msg_body?.msg?.length > 0)
               {
                  cp2_deo_loginId=response.cp2_deo_msg_details.cp2_deo_user.login_id;
                  cp2_deo_msg=response.cp2_deo_msg_details.cp2_deo_msg_body.msg.replace(/(\+|%3A)/g, ' ');
               }else{
                  cp2_deo_loginId='LoginId Not exist';
                  cp2_deo_msg='SMS Not Send';
               } 


               
               // alert('test ok working');
               if(response.sno_msg_details?.sno_user?.length > 0 &&
                  response.sno_msg_details?.sno_msg_body?.msg?.length > 0)
               {
                  // alert('test working.....');
                  var sno_loginId=response.sno_msg_details.sno_user;
                  var sno_msg=response.sno_msg_details.sno_msg_body.msg.replace(/(\+|%3A)/g, ' ');
               }else{
                  // alert('test not working....');
                  var sno_loginId='LoginId Not exist';
                  var sno_msg='SMS Not Send';
               } 

               // alert(sno_loginId+'---'+cp2_deo_msg);
               var sms_view = "Intervention SDO/BDO Login ID :"+loginId+'\n \n Message : '+msg+'\n \n Intervention DEO Login ID : '+inc_deo_loginId+'\n \nIntervention DEO MSG : '+inc_deo_msg+'\n \n CP1 CMPO loginId : '+cp1_cmpo_loginId+'\n \n CP1 CMPO MSG :'+cp1_cmpo_msg+'\n \n CP2 CMPO loginId : '+cp2_cmpo_loginId+'\n \n CP2 CMPO MSG:'+cp2_cmpo_msg+'\n \n CP1 SDO/BDO LoginId : '+cp1_sdo_bdo_loginId+'\n \n CP1 SDO/BDO MSG : '+cp1_sdo_bdo_msg+'\n \n CP1 DEO loginId :'+cp1_deo_loginId+'\n \n CP1 DEO MSG : '+cp1_deo_msg+'\n \n CP2 SDO/BDO LoginId :'+cp2_sdo_bdo_loginId+'\n \n CP2 SDO/BDO MSG : '+cp2_sdo_bdo_msg+'\n \n CP2 DEO LoginId : '+cp2_deo_loginId+'\n \n CP2 DEO MSG : '+cp2_deo_msg+'\n \n SNO LoginID : '+sno_loginId+'\n \n SNO MSG : '+sno_msg;
               
               /*swal({
                   title: "SMS sent alert!",
                   text: sms_view,
                   icon: "success",
                   customClass: {
                       popup: 'my-custom-popup' // Apply custom class
                   }
               });*/

               // alert(sms_view);

              
              }
               
          });

   }
   // ---------- 26-11-2024 Send Message During Intervention End ----------


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
            var table = $('#mytable').DataTable();
              if ($.fn.DataTable.isDataTable('#mytable')) {
                            table.destroy();
                        }
                        // Clear the table body
                        $("#childAppend").empty();

                        // Populate the table with the new data
                        if (response != "") {
                            $("#childAppend").html(response);
                        } else {
                            $("#childAppend").html("<td colspan='14' style='color:red;'><b>No matching record found!</b></td>");
                        }

                        // Re-initialize DataTable
                        // table = $('#mytable').DataTable();
                            table = $('#mytable').DataTable({
                              "columnDefs": [{
                                 "targets": 2,
                                 "render": function(data, type, row, meta) {
                                    if(type === 'sort') {
                                       return data.replace(/(\d{2})-(\d{2})-(\d{4})/, '$3-$2-$1');
                                    }
                                    return data;
                                 }
                              }],
                              "paging": true,
                              "scrollX": false,
                              "info": false,
                              "ordering": true,
                              "searching": true
                            });
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

<script type="text/javascript">
    function toggleExpand() {
      var boxTable = document.getElementById('box-table');
      if (boxTable.style.width === "100%") {
        boxTable.style.cssText = "";
      } else {
        boxTable.style.cssText = "overflow: auto; width: 100%; max-width: 100%;";
      }
    }

    $(document).ready(function(){
      $("#toggleButton").click(function(){
        toggleExpand();
      });
    });
  </script>

<script type="text/javascript">

   $('.cb-value').click(function() {
  var mainParent = $(this).parent('.toggle-btn');
  if($(mainParent).find('input.cb-value').is(':checked')) {
    $(mainParent).addClass('active');
  } else {
    $(mainParent).removeClass('active');
  }

})
</script>
