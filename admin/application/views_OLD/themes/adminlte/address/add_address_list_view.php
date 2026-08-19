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
   box-shadow: none; border-color:#12386e; background:#12386e;
   }
   .dropdown-menu>li>a {
   display:block; padding: 3px 12px; clear: both; font-weight: 400; line-height: 1.42857143; color: #fff; white-space: nowrap;
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
   font-size: 17px; font-weight: normal; display: block;
   }
   th {
   font-size: 12px;
   }
   td {
   font-size: 13px;
   }
   .modal_table {
   background: #339933; color: #FFFFFF;
   }
   .modal_incident {
   background: #085876; color: #fff;
   }
   .dataTables_length {
   display: block;
   max-width: 100%;
   margin-bottom: 5px;
   font-weight: 700;
   }
   .table {
   display: table; border-collapse: collapse;
   }
   .table .tr {
   display: table-row;border: 1px solid #ddd;
   }
   .table .tr:nth-child(even) {
   background-color: #f9f9f9;
   }
   .table .tr .td {
   display: table-cell;padding: 8px;border-left: 1px solid #ddd;
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
   .label-div{
   display: flex;
   justify-content: end;
   }
   .inp{
   width: 24%;
   margin-left: 10px;
   }
   .otp-input-fields{
   display: flex;
   }
   .otp-input-fields input[type=number]{
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
   .des-loc{
   display: flex;
   flex-wrap: wrap;
   }
   .inp-radio{
   width: 28%;
   }
   .inp-inf{
   float: right;
   }
   .left-form{
   position: relative;
   }
   .Information_Received{
   position: absolute;
   right: 75px;
   top:0;
   text-align: right;
   }
   .Information_Received h5 {
   text-align: right;
   }
   .con_details {
  border-bottom: 2px solid skyblue;
  margin-bottom: 10px;
}
.form-group{
  margin-bottom: 0;
}
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Address Change Request List</h1>
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
        <!--  <a href="javascript:void()" onclick="expand()" class="btn btn-warning" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Expand</a> -->
         <!-- <a href="<?php echo base_url()?>admin/reporting/incident/incident_list/list_download" id="download_btn" class="btn btn-success" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-download" aria-hidden="true"></i> List Download</a>
         <a href="<?php echo base_url()?>admin/reporting/incident/incident_list/list_print/" id="btnPrint2" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;"><i class="fa fa-print" aria-hidden="true"></i> List Print</a>
         <a href="javascript:void()" id="advanced_search_btn" class="btn btn-info" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-search" aria-hidden="true"></i> Advanced Date Search </a> -->
         
         
         <div class="box-body" id="box-table">
            <table class="table table-bordered table-hover" id="mytable">
               <thead>
                  <tr class="custom_table_head">
                     <th colspan="4">Intervention</th>
                     <th colspan="2">Contracting Party</th>
                     <th colspan="2">Contracting Party Address</th>
                     <th colspan="1">Status</th>
                     <th colspan="1">Action</th>
                  </tr>
                  <tr class="custom_table_head">
                     <th class="text-center">Sl. No</th>
                     <th class="text-center">Intervention ID</th>
                     <th class="text-center">Intervention Date</th>
                     <th class="text-center">Location</th>
                     <th class="text-center">CP Type</th>
                     <th class="text-center">CP Name</th>

                     <th class="text-center">Current Address</th>
                     <th class="text-center">New Address</th>
                     <th class="text-center">CP Address Change Request Status</th>
                                          
                     <th class="text-center">Action</th>
                  </tr>
               </thead>
               <tbody id="childAppend">
                <?php
                  // echo "<pre>";
                  // print_r($this->session->userdata());
                 $c = 1;
                 foreach($incident_details as $value){

                    // echo "<pre>"; print_r($value);die;
                    // Get Intervention Location
                    if(!empty($value->rural_urban)){
                      if($value->rural_urban == 'U'){
                        $incident_word_gp = get_blocl_name($value->incident_ward_gp);
                      }else{
                        $incident_word_gp = get_gp_name($value->incident_ward_gp);
                      }
                    }else{
                      $incident_word_gp = array();
                    }

                    //Get Current address details 
                    if(!empty($value->curren_rural_urban))
                    {
                      if($value->current_rural_urban == 'U'){
                        $current_address_word_gp =get_blocl_name($value->current_word_gp);
                      }else{
                        $current_address_word_gp =get_gp_name($value->current_word_gp);
                      }
                    }else{
                     $current_address_word_gp = array();
                    }
                    
                    // GET Request Address
                    if(!empty($value->new_rural_urban))
                    {
                      if($value->new_rural_urban == 'U'){
                        $new_address_word_gp =get_blocl_name($value->ward_gp);
                      }else{
                        $new_address_word_gp =get_gp_name($value->ward_gp);
                      }
                    }else{
                     $new_address_word_gp = array();
                    }

                   ?>
                  <tr>
                    <td><?php echo $c++; ?></td>
                    <td><?php echo $value->reporting_id; ?></td>
                    <td><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></td>
                    <td>
                      <?php echo $value->incident_district_name;?>,<br>
                      <?php echo $value->incident_block_name; ?>,<br>
                      <?=($incident_word_gp)?$incident_word_gp->incident_word_gp:'';?>
                    </td>
                    <td><?php echo $value->cp_type?$value->cp_type:''; ?></td>
                    <td><?php echo $value->cp_name?$value->cp_name:''; ?></td>
                    <td>
                    <?php if($value->current_state == 1){?>
                      <?php echo $value->current_district_name;?>,<br>
                      <?php echo $value->current_block_name?>,<br>
                      <?=($current_address_word_gp)?$current_address_word_gp->incident_word_gp:'';?>
                    <?php }else{ ?>
                      <?php echo $value->cp_current_address;?>
                    <?php } ?>
                    </td>
                    <td>
                      <?php if($value->state == '1'){?>
                        <?php echo $value->new_district_name; ?>,<br>
                        <?php echo $value->new_block_name; ?>,<br>
                        <?= ($new_address_word_gp)?$new_address_word_gp->incident_word_gp:''; ?>
                      <?php }else{ ?>
                        <?php echo $value->cp_address;?>
                      <?php } ?>
                    </td>
                    <td><?php echo $value->address_change_status?$value->address_change_status:''; ?></td>
                    
                    <td>
                      <div class="dropdown" style="">
                        <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                        
                          <!-- <li role="presentation"><a role="menuitem" tabindex="-1" onclick="View_address_change_data('<?php echo base64_encode($value->address_change_id_pk); ?>') " ><i class="fa fa-eye" aria-hidden="true"></i>View Details</a></li> -->

                          <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#View_details_<?php echo $value->address_change_id_pk; ?>"><i class="fa fa-eye" aria-hidden="true"></i>View History</a></li>
                            
                          <?php 
                            $stake_id_fk = $this->session->userdata('stake_id_fk');
                            $block = $this->session->userdata('block');
                          if($stake_id_fk=='4' && $block==$value->current_block){ ?>

                            <?php if($value->current_status=='1' || $value->current_status=='4'){
                            ?>
                              <li role="presentation"><a role="menuitem" tabindex="-1" onclick="address_change_action('<?php echo base64_encode($value->address_change_id_pk); ?>', '<?php echo base64_encode($value->cp_id_fk); ?>', 'delete') "><i class="fa fa-address-card" aria-hidden="true"></i>Delete</a></li>

                               <li role="presentation">
                                <a role="menuitem" tabindex="-1" onClick="Edit_address_change('<?php echo base64_encode($value->address_change_id_pk); ?>', '<?php echo base64_encode($value->incident_id_fk); ?>', '<?php echo base64_encode($value->cp_id_fk); ?>', '<?php echo base64_encode($value->cp_type); ?>', '<?php echo base64_encode($value->incident_date); ?>', '<?php echo base64_encode($value->reporting_id); ?>', '<?php echo base64_encode($value->cp_name); ?>', '<?php echo base64_encode($value->cp_gender); ?>', '<?php echo base64_encode($value->street_landmark); ?>', '<?php echo base64_encode($value->state); ?>', '<?php echo base64_encode($value->district); ?>', '<?php echo base64_encode($value->cp_address); ?>', '<?php echo base64_encode($value->block); ?>', '<?php echo base64_encode($value->ward_gp); ?>', '<?php echo base64_encode($value->pin_code); ?>', '<?php echo base64_encode($value->police_station); ?>', '<?php echo base64_encode($value->cp_mobile); ?>', '<?php echo base64_encode($value->remarks); ?>' ) ">
                                <i class="fa fa-forward"></i>Edit</a></li>

                            <?php } ?>

                            <?php if($value->current_status=='1' || $value->current_status=='4'){
                            ?>

                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="address_change_action('<?php echo base64_encode($value->address_change_id_pk); ?>', '<?php echo base64_encode($value->cp_id_fk); ?>', 'forward')"><i class="fa fa-forward"></i>Forward</a></li>
                            <?php } ?>

                          <?php } ?>
                          <?php if(($stake_id_fk=='2' || $stake_id_fk=='6') && $block == $value->current_block ){ ?>
                            <?php if($value->current_status=='2' ){ ?>

                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" onClick="Publish_address_change('<?php echo base64_encode($value->address_change_id_pk); ?>', '<?php echo base64_encode($value->incident_id_fk); ?>', '<?php echo base64_encode($value->reporting_id); ?>', '<?php echo base64_encode($value->cp_id_fk); ?>', '<?php echo base64_encode($value->cp_type); ?>', '<?php echo base64_encode($value->incident_date); ?>')">
                              <i class="fa fa-forward"></i>Publish</a></li>

                              <li role="presentation"><a role="menuitem" tabindex="-1" onClick="address_change_action('<?php echo base64_encode($value->address_change_id_pk); ?>', '<?php echo base64_encode($value->cp_id_fk); ?>', 'revert')"><i class="fa fa-forward"></i>Revert</a></li>

                            <?php } ?>
                          <?php } ?>
                            
                          
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
    foreach($incident_details as $value){

      // Get Intervention Location
      if(!empty($value->rural_urban)){
        if($value->rural_urban == 'U'){
          $incident_word_gp = get_blocl_name($value->incident_ward_gp);
        }else{
          $incident_word_gp = get_gp_name($value->incident_ward_gp);
        }
      }else{
        $incident_word_gp = array();
      }
      //Get Current address details 
      if(!empty($value->curren_rural_urban)){
        if($value->current_rural_urban == 'U'){
          $current_address_word_gp =get_blocl_name($value->current_word_gp);
        }else{
          $current_address_word_gp =get_gp_name($value->current_word_gp);
        }
      }else{
       $current_address_word_gp = array();
      }
      // GET Request Address
      if(!empty($value->new_rural_urban)){
        if($value->new_rural_urban == 'U'){
          $new_address_word_gp =get_blocl_name($value->ward_gp);
        }else{
          $new_address_word_gp =get_gp_name($value->ward_gp);
        }
      }else{
       $new_address_word_gp = array();
      }
  ?>

   <div id="View_details_<?php echo $value->address_change_id_pk; ?>" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content" id="mod">
            <div class="modal-header custom-modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title text-center">Address Change Data</h4>
            </div>

            <?php //echo '--->>'.$value->rural_urban; print_r($incident_word_gp);
            //echo "<pre>"; print_r($value); ?>
            <div class="modal-body">
               <div class="div-table">
                  <!-- Prevention Incident -->
                 <div class="table">
                   <div class="tr">
                     <div class="td">Intervention ID :</div>
                     <div class="td"><?php echo $value->reporting_id; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Intervention Date : </div>
                     <div class="td"><?php echo date('d-m-Y', strtotime($value->incident_date)); ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Intervention Location : </div>
                     <div class="td"><?php echo $value->incident_district_name.','.$value->incident_block_name.','.$incident_word_gp->incident_word_gp; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Contracting Party Type : </div>
                     <div class="td"><?php echo $value->cp_type; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Contracting Party Name : </div>
                     <div class="td"><?php echo $value->cp_name; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Contracting Party Current Address : </div>
                     <div class="td"><?php echo $value->current_district_name.','.$value->current_block_name.','.$current_address_word_gp->incident_word_gp; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Contracting Party Request Address : </div>
                     <div class="td"><?php echo $value->new_district_name.','.$value->new_block_name.','.$new_address_word_gp->incident_word_gp ; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">Contracting Party Status : </div>
                     <div class="td"><?php echo $value->address_change_status; ?></div>
                   </div>
                   
                 </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
<?php } ?>
<!-- View End Modal -->

<!-- ---------------- Edit Address Change Data 06-02-2025 Start ----------------- -->
<div id="edit_change_modal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog" style="width: 750px">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title" id="title"></h4>
      </div>
      <div class="modal-body" style="padding: 25px">
        <div class="con_details" style="display: flex;justify-content: space-between;align-items: center;">
          <div>
            <ul style="padding: 0;margin: 0;list-style: none;">
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
              <div class="row">
                <div class="col-sm-12">
                   <label class=" col-form-label">State<font color="red">*</font></label>
                  <select class="form-control" id='state' name='state' onchange="check_state($(this).val())">
                    <option value="0" disabled selected>--Select State--</option>
                      <?php foreach ($state as $value) { ?>
                        <option value="<?php echo $value['state_id_pk'] ?>" <?php echo $selected; ?>><?php echo $value['state_name'] ?></option>
                      <?php } ?>
                  </select>
                  <p id='state_error' style="color:red; display:none;">Please select state</p>
                </div>
              </div>
            </div>
            <div class="col-md-6" id='for_west_bengal'>
              <div class="row">
                <div class="col-sm-12">
                   <label class=" col-form-label">District<font color="red">*</font></label>
                  <select class="form-control" id='district' name='district' onchange="get_block_municipality_by_district($(this).val())">
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
              <div class="row">
                <div class="col-sm-12">
                  <label class="col-form-label">Block/Municipality<font color="red">*</font></label>
                  <select class="form-control" id='block_municipal' name='block_municipal' onchange="get_word_gp_by_block($(this).val())">
                    <option value="0" selected>--Select Block/Municipality--</option>
                  </select>
                  <p id='block_error' style="color:red; display:none;">Please select Block/Municipality</p>
                </div>
              </div>
            </div>
            <div class="col-md-6" id="ward_gp_div">
              <div class="row">
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
          </div>

          <div class="row">
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
              <div class="form-group row">
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
              <div class="form-group row">
                <div class="col-sm-12">
                  <label class="col-form-label">Phone No<font color="red">*</font></label>
                  <input type="text" placeholder="Phone No" class="form-control" id="mobile" autocomplete="off" name="mobile" value="">
                  <p id='mobile_error' style="color:red; display:none;">Enter Phone No</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <div class="col-sm-12">
                  <label class="col-form-label">Remarks<font color="red">*</font></label>
                  <textarea class="form-control" id="remarks" name="remarks" placeholder="Remarks"></textarea>
                  <p id='remarks_error' style="color:red; display:none;">Enter Remarks</p>
                </div>
              </div>
            </div>
          </div>

          <input type="hidden" name="form_type" id="form_type" value="Edit">
          <input type="hidden" name="hidden_address_change_id" id="hidden_address_change_id">

          <div class="modal-footer" style="text-align: right;">
            <button type="button" class="btn btn-primary" id="accept_btn" onclick="save_new_address()">Save</button>
            <button type="button" class="btn btn-danger" id="accept_btn" onclick="cancel_address_change()">Cancel</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>

<!-- ------- Edit Address Change Data 06-02-2025 End ----------- -->

</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>

<script type="text/javascript">
   function expand(){
   document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
   }
</script>

<script type="text/javascript">

  $(document).ready(function() {
   // $('#address_change_modal').modal('show');
    $('#for_west_bengal').show();
    $('#block_div').show();
    $('#ward_gp_div').show();
    $('#for_other_state').hide();
  });

  // Mobile field validation
  $('#mobile').on('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length > 10) {
      this.value = this.value.slice(0, 10); // Keep only the first 10 digits
    }
  });
  // Pin Code field validation
  $('#pin_code').on('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length > 6) {
      this.value = this.value.slice(0, 6); // Keep only the first 10 digits
    }
  });

  function Edit_address_change(address_change_id_pk, incident_id_fk, cp_id_fk, cp_type, incident_date,reporting_id, cp_name, cp_gender, street_landmark, state, district, cp_address, block, ward_gp, pin_code, police, mobile, remarks){

    var address_change_id_pk = atob(address_change_id_pk);
    var incident_id_fk = atob(incident_id_fk);
    var cp_id_fk = atob(cp_id_fk);
    var cp_type = atob(cp_type);
    var incident_date = atob(incident_date);
    var reporting_id = atob(reporting_id);
    var cp_name = atob(cp_name);
    var cp_gender = atob(cp_gender);

    if(cp_type==1){
      var cp='One';
    }else if(cp_type==2){
      var cp='Two';
    }

    if(cp_gender==1){
      var gender='Male';
    }else if(cp_gender==2){
      var gender='Female';
    }
    var dateParts = incident_date.split("-");
    var year = dateParts[0];
    var month = dateParts[1];
    var day = dateParts[2]; 
    $('#title').text('Edit Change Address of Contracting Parties '+cp);
    $('#inter_id').text(reporting_id);
    $('#inter_date').text(day+'-'+month+'-'+year);
    $('#cp_name_level').text('Contracting Parties '+cp+' Name:');
    $('#cp_name_id').text(cp_name);
    $('#cp_gender_lavel').text('Contracting Parties '+cp+' Gender:');
    $('#cp_gender_id').text(gender);
    $('#hidden_address_change_id').val(address_change_id_pk);
    // -------------------------------------------------------------

    var street_landmark = atob(street_landmark);
    $("#street_landmark").val(street_landmark);
    var state = atob(state);
    $("#state").val(state);
    if(state==1){
      $('#for_west_bengal').show();
      $('#block_div').show();
      $('#ward_gp_div').show();
      $('#for_other_state').hide();

      var district = atob(district);
      $("#district").val(district);
      var block = atob(block);
      var ward_gp = atob(ward_gp);
      generate_block_municipal(district,block);
      generate_word_gp(block, ward_gp);
    }
    else if(state==2){
      $('#for_west_bengal').hide();
      $('#block_div').hide();
      $('#ward_gp_div').hide();
      $('#for_other_state').show();

      var cp_address = atob(cp_address);
      $("#other_address").val(cp_address);
    }

    var pin_code = atob(pin_code);
    $('#pin_code').val(pin_code);
    var police = atob(police);
    $('#police_station').val(police);
    var mobile = atob(mobile);
    $('#mobile').val(mobile);
    var remarks = atob(remarks);
    $('#remarks').val(remarks);
    // ------------------------------------------------------------
    $('#edit_change_modal').modal('show');

  }

  // Check WB state or outside WB 
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

  // Generate Block and municipality select by district
  function get_block_municipality_by_district(district_id=null)
  {
    var url = '<?php echo base_url()?>admin/address_change/Address_change/get_block_municipality/';
    $.ajax({
        url: url,
        method: 'get',
        data: {district_id:district_id} ,
        dataType: 'json',
        success: function(result)
        {
          // console.log(result);
          $('#block_municipal').empty();
          $('#block_municipal').append('<option value="0" selected>--Select Block/Municipality--</option>');
          $('#ward_gp').empty();
          $('#ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

          $.each(result, function (index, item) {
            var option = '<option value="'+item.block_id_pk+'">'+item.block_name+'</option>';
            $("#block_municipal").append(option);
          });
        }
    });
  }

  // Generate GP and word select by block/municipality
  function get_word_gp_by_block(block=null){
    
    var url = '<?php echo base_url()?>admin/address_change/Address_list/get_block_data/';
    $.ajax({
        url: url,
        method: 'get',
        data: {block:block},
        dataType: 'json',
        success: function(result)
        {
          // console.log(result.block_rural_urban);
            $('#ward_gp').empty();
            $('#ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

            if(result.block_rural_urban=='R'){
                $.each(result.block_gp_data, function (index, item) {
                  var selected = (item.gp_id_pk == ward_gp) ? 'selected' : '';
                  var option = '<option value="'+item.gp_id_pk+'" '+selected+'>'+item.gp_name+'</option>';
                  $("#ward_gp").append(option);
                });
            }else{
                $.each(result.block_gp_data, function (index, item) {
                  var selected = (item.ward_id_pk == ward_gp) ? '' : '';
                  var option = '<option value="'+item.ward_id_pk+'" '+selected+'>'+item.ward_no+'</option>';
                  $("#ward_gp").append(option);
                });
            }

        }
    });
  }

  // create dynamic block municiplity
  function generate_block_municipal(district,block){

    var url = '<?php echo base_url()?>admin/address_change/Address_change/get_block_municipality/';
    $.ajax({
        url: url,
        method: 'get',
        data: {district_id:district} ,
        dataType: 'json',
        success: function(result)
        {
          //console.log(result);
          $('#block_municipal').empty();
          $('#block_municipal').append('<option value="0" selected>--Select Block/Municipality--</option>');

          $.each(result, function (index, item) {

            var selected = (item.block_id_pk == block) ? 'selected' : ''; 
            console.log(block);
            var option = '<option value="'+item.block_id_pk+':'+item.rural_urban+'" '+selected+'>'+item.block_name+'</option>';
            $("#block_municipal").append(option);
          });
        }
    });
  }

  // Create ward GP dynamick
  function generate_word_gp(block, ward_gp){

    var url = '<?php echo base_url()?>admin/address_change/Address_list/get_block_data/';
    $.ajax({
        url: url,
        method: 'get',
        data: {block:block} ,
        dataType: 'json',
        success: function(result)
        {
          // console.log(result.block_rural_urban);
            $('#ward_gp').empty();
            $('#ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

            if(result.block_rural_urban=='R'){
                $.each(result.block_gp_data, function (index, item) {
                  var selected = (item.gp_id_pk == ward_gp) ? 'selected' : '';
                  var option = '<option value="'+item.gp_id_pk+'" '+selected+'>'+item.gp_name+'</option>';
                  $("#ward_gp").append(option);
                });
            }else{
                $.each(result.block_gp_data, function (index, item) {
                  var selected = (item.ward_id_pk == ward_gp) ? 'selected' : '';
                  var option = '<option value="'+item.ward_id_pk+'" '+selected+'>'+item.ward_no+'</option>';
                  $("#ward_gp").append(option);
                });
            }

        }
    });
  }

  // Cancel Address Change Modal
  function cancel_address_change(){
    $('#street_landmark').val('');    
    $('#district option:selected').prop('selected', false);
    $('#pin_code').val('');
    $('#police_station').val('');
    $('#mobile').val('');
    $('#remarks').val('');
    $('#edit_change_modal').modal('hide');
  }

  // Edit Address Change Data
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

      var hidden_address_change_id = $('#hidden_address_change_id').val();
      
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
                    //alert(result);
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
                    // alert(result);
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

  // Address Change All Action Function
  function address_change_action(address_change_id, cp_id, actionType){

    if(actionType=='delete'){
      var text = "Delete";
      var textEd = "Deleted";
      var textError = "deleting";
    }
    if(actionType=='forward'){
      var text = "Forward";
      var textEd = "Forwarded";
      var textError = "forwarding";
    }
    if(actionType=='revert'){
      var text = "Revert";
      var textEd = "Reverted";
      var textError = "reverting";
    }

    swal({
        title: text+"?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes, "+text+" it",
        cancelButtonClass: "btn-danger",
        cancelButtonText: "No, Cancel",
        closeOnConfirm: false,
        closeOnCancel: false,
        showLoaderOnConfirm: true
    },
    function(isConfirm){
        if(isConfirm) {
            var url = '<?php echo base_url()?>admin/address_change/Address_list/address_change_all_action/';
            $.ajax({
                url: url,
                method: "GET",
                data: {'address_change_id': address_change_id, 'cp_id':cp_id, 'action': actionType},
                dataType: "JSON",
                success: function(response) {
                    swal(text+"!", textEd+" success", "success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    swal("Error", "An error occurred while "+textError, "error");
                    //console.error(xhr.responseText);
                }
            });
        } else {
            swal("Cancelled", text+" cancel!", "error");
            setTimeout(function(){
                window.location.reload();
            }, 1500);
        } 
    });
  }

  function Publish_address_change(address_change_id, incident_id_fk, reporting_id, cp_id_fk, cp_type, incident_date) {
    // alert(cp_id_fk);
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
        if(isConfirm) {
            var url = '<?php echo base_url()?>admin/address_change/Address_list/publish_address_change/';
            $.ajax({
                url: url,
                method: "GET",
                data: {'address_change_id': address_change_id, 'incident_id_fk':incident_id_fk, 'reporting_id':reporting_id, 'cp_id_fk':cp_id_fk, 'cp_type':cp_type, 'incident_date':incident_date},
                dataType: "JSON",
                success: function(response) {
                    swal("Published!", "Publish success", "success");
                    setTimeout(function(){
                        window.location.reload();
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    swal("Error", "An error occurred while publishing", "error");
                    //console.error(xhr.responseText);
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


</script>