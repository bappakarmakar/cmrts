
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
    /*.btn-primary {
        margin-top: 15px;
        margin-bottom: 20px;
    }*/
    .dataTables_filter {
      display: block;
    }

    /*Police case start */
    .custom-box
    {
      padding: 6px;
      border: ;
      background: #fff;
      box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;
      margin: 4px 0;
      min-height: 140px;
    }
    label 
    {
      margin-bottom: 5px;
      margin-top: 5px;
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
    <?php 
     // echo '-->>'.$stake_id_fk = $this->session->userdata('stake_id_fk').'</br>';
     // echo '-->>'.$block = $this->session->userdata('block'); 
    ?>
      <h1>Registerd Police Case List</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <?php $this->load->view('errors/message'); ?>
      <div class="box bottom-box">
        <!-- <a href="javascript:void()" onclick="expand()" class="btn btn-warning" style="margin-top: 8px; float: right;margin-right: 20px;"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Expand</a>

        <a href="<?php echo base_url()?>admin/reporting/police_case/police_case_list/list_download" class="btn btn-success download" style="margin-top: 8px; float: right; margin-right: 10px; margin-bottom: 10px;"><i class="fa fa-download" aria-hidden="true"></i> List Download</a>

        <a href="<?php echo base_url()?>admin/reporting/police_case/police_case_list/list_print" class="btn btn-danger" style="margin-top: 8px; float: right; margin-right: 10px;" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> List Print</a> -->

        <div class="box-footer">
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" id="mytable">
                   <thead>
                      <tr class="custom_table_head">
                        <th colspan="4">Intervention</th>
                        <th colspan="3">Contracting Party</th>
                        <th colspan="4">Case Details</th>
                        <th colspan="2">Status</th>
                        <th colspan="1">Action</th>
                      </tr>
                      <tr class="custom_table_head">
                         <th class="text-center">Sl. No</th>
                         <th class="text-center">Intervention ID</th>
                         <th class="text-center">Intervention Date</th>
                         <th class="text-center">Intervention Jurisdiction</th>
                         <th class="text-center"  width="2%">CP Type</th>
                         <th class="text-center">CP Name</th>
                         <th class="text-center">CP Jurisdiction</th>
                         <th class="text-center">GD No</th>
                         <th class="text-center">GD Date</th>
                         <th class="text-center">FIR No</th>
                         <th class="text-center">FIR Date</th>
                         <th class="text-center">Status</th>
                         <th class="text-center">Entry By</th>
                         <th class="text-center">Action</th>
                      </tr>
                   </thead>
                   <tbody id="childAppend">
                      <?php
                      $c = 1;
                      foreach($police_case_details as $value){
                        // echo "<pre>";print_r($value);
                        // die;
                        // Get Intervention Full Details
                        if(!empty($value->incident_id_fk)){
                          $incident_address = Get_Intervention_Full_Address($value->incident_id_fk);
                        }else{
                          $incident_address = array();
                        }
                        // Get CP Full Address
                        if(!empty($value->cp_id_fk)){
                          $cp_address = Get_CP_Full_Address($value->cp_id_fk);
                        }else{
                          $cp_address = array();
                        }
                      ?>
                      <tr>
                         <td><?php echo $c++; ?></td>
                         <td><?php echo $value->reporting_id; ?></td>
                         <td><?php echo $value->incident_date; ?></td>
                         <td>
                          <?= ($incident_address)?$incident_address['ward_gp_name']:''; ?>,<br>
                          <?= ($incident_address)?$incident_address['block_name']:''; ?>,<br>
                          <?= ($incident_address)?$incident_address['district_name']:'';?>
                         </td>
                         <td><?php echo $value->cp_type; ?></td>
                         <td><?php echo $value->cp_name; ?></td>
                         <td>
                            <?php if($cp_address['cp_state']==1){  ?>
                              <?= ($cp_address)?$cp_address['ward_gp_name']:''; ?>,<br>
                              <?= ($cp_address)?$cp_address['block_name']:''; ?>,<br>
                              <?= ($cp_address)?$cp_address['district_name']:'';?>
                            <?php }else{ ?>
                              <?= ($cp_address)?$cp_address['cp_address']:'';?>
                            <?php } ?>
                         </td>
                         <td><?php echo $value->gd_no; ?></td>
                         <td>
                          <?php 
                              echo !empty($value->gd_date)
                                    ?date('Y-m-d', strtotime($value->gd_date)) : ''; 
                          ?>
                         </td>
                         <td><?php echo $value->fir_no; ?></td>
                         <td>
                          <?php echo !empty($value->fir_date) 
                                      ?date('Y-m-d', strtotime($value->fir_date)) : ''; 
                          ?>
                         </td>
                         <td>
                            <?php echo $value->status; ?>
                            <?php if(!empty($value->revert_reason) && $value->current_status==23){ ?>

                            <a class="btn btn-success btn-xs" role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#view_revert_msg<?php echo $value->police_case_id_pk; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <?php } ?>
                         </td>
                         <td><?php echo $value->login_id; ?></td>
                         <td>
                          <div class="dropdown">
                            <button class="btn btn-action dropdown-toggle" type="button" id="menu1" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu action_menu" role="menu" aria-labelledby="menu1" style="margin-left: -83px;">
                              

                            <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void()" data-toggle="modal" data-target="#viewModal<?php echo $value->police_case_id_pk; ?>"><i class="fa fa-eye" aria-hidden="true"></i>View History</a></li> -->
                            <?php
                              $data = (array) $value; //Convert stdClass object to an array
                              // Encode to JSON
                              $jsonPolieCaseData = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
                            ?>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick='editPoliceCase(<?php echo $jsonPolieCaseData ?>,"view_history")' ><i class="fa fa-eye"></i>View History</a></li>
                            
                              <?php 
                                $stake_id_fk = $this->session->userdata('stake_id_fk');
                                $block       = $this->session->userdata('block');
                                $login_district = $this->session->userdata('district');
                                // ------------------ DEO User Start -----------------------
                                if($stake_id_fk=='4' && $block==$value->fir_block_municipality){ 

                                  if($value->current_status=='19' || $value->current_status=='20' || $value->current_status=='23'){ 
                                ?>

                                <li role="presentation"><a role="menuitem" tabindex="-1" onClick="police_case_action('<?php echo base64_encode($value->police_case_id_pk); ?>','<?php echo base64_encode($value->incident_id_fk); ?>','<?php echo base64_encode($value->cp_id_fk); ?>','delete')"><i class="fa fa-trash"></i>Delete</a></li>

                                <?php
                                  $data = (array) $value; //Convert stdClass object to an array (optional)
                                  // Encode to JSON
                                  $jsonPolieCaseData = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
                                ?>
                                <li role="presentation"><a role="menuitem" tabindex="-1" onclick='editPoliceCase(<?php echo $jsonPolieCaseData ?>,"edit")' ><i class="fa fa-forward"></i>Edit</a></li>

                                <?php if($value->current_status=='20' || $value->current_status=='23'){ ?>

                                  <li role="presentation"><a role="menuitem" tabindex="-1" onClick="police_case_action('<?php echo base64_encode($value->police_case_id_pk); ?>','<?php echo base64_encode($value->incident_id_fk); ?>','<?php echo base64_encode($value->cp_id_fk); ?>','forward')"><i class="fa fa-forward"></i>Forward</a></li>

                                <?php } } }?>
                                <!-- ----------------- DEO User End ------------------ -->

                                <!-- ------------- BDO and SDO user Start ------------ -->
                                <?php if(($stake_id_fk=='2' || $stake_id_fk=='6') && $block == $value->fir_block_municipality){ ?>
                                  <?php if($value->current_status=='21' ){ ?>

                                  <li role="presentation"><a role="menuitem" tabindex="-1" onClick="police_case_action('<?php echo base64_encode($value->police_case_id_pk); ?>','<?php echo base64_encode($value->incident_id_fk); ?>','<?php echo base64_encode($value->cp_id_fk); ?>', 'publish')"><i class="fa fa-forward"></i>Publish</a></li>

                                  <li role="presentation"><a role="menuitem" tabindex="-1" onClick="police_case_action_revert('<?php echo base64_encode($value->police_case_id_pk); ?>','<?php echo base64_encode($value->incident_id_fk); ?>','<?php echo base64_encode($value->cp_id_fk); ?>', 'revert')"><i class="fa fa-forward"></i>Revert</a></li>

                                  <?php } ?>
                                <?php } ?>
                                <!-- ------------- BDO and SDO user End ------------ -->

                                <!-- ---------------- CMPO User Start -------------- -->
                                <?php if($stake_id_fk=='3' && $login_district==$value->fir_district && $value->fir_block_municipality=='0' ){ ?>

                                  <?php if($value->current_status=='19' || $value->current_status=='20'){ ?>

                                    <li role="presentation"><a role="menuitem" tabindex="-1" onClick="police_case_action('<?php echo base64_encode($value->police_case_id_pk); ?>','<?php echo base64_encode($value->incident_id_fk); ?>','<?php echo base64_encode($value->cp_id_fk); ?>','delete')"><i class="fa fa-trash"></i>Delete</a></li>

                                    <?php
                                      $data = (array) $value; //Convert stdClass object to an array
                                      // Encode to JSON
                                      $jsonPolieCaseData = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
                                    ?>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick='editPoliceCase(<?php echo $jsonPolieCaseData ?>,"edit")' ><i class="fa fa-pencil-square-o"></i>Edit</a></li>

                                  <?php } ?>
                                  <?php if($value->current_status=='20'){ ?>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" onClick="police_case_action('<?php echo base64_encode($value->police_case_id_pk); ?>','<?php echo base64_encode($value->incident_id_fk); ?>','<?php echo base64_encode($value->cp_id_fk); ?>', 'publish')"><i class="fa fa-forward"></i>Publish</a></li>
                                  <?php } ?>
                                <?php } ?>
                                <!-- ----------------- CMPO User End --------------- -->

                              </ul>
                            </div>
                         </td>
                      </tr>
                      <?php } ?>
                   </tbody>
                </table>
              </div>
            </div>
         </div>
      </div>
   </section>
   <?php
   foreach($police_case_details as $value){
   ?>
   <div id="view_revert_msg<?php echo $value->police_case_id_pk; ?>" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-md">
         <!-- Modal content-->
         <div class="modal-content" id="mod">
            <div class="modal-header custom-modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title text-center">Police Case Revert Reason</h4>
            </div>
            <div class="modal-body">
              <div class="div-table">
                  <!-- Prevention Incident -->
                <div class="table">
                   <div class="tr">
                     <div class="td" style="display: flex;align-items: center; width: 125px;"><strong>Revert Reason :</strong> </div>
                     <div class="td"><?php echo $value->revert_reason; ?></div>
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

   <?php
   foreach($police_case_details as $value){
   ?>
   <div id="viewModal<?php echo $value->police_case_id_pk; ?>" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg">
         <!-- Modal content-->
         <div class="modal-content" id="mod">
            <div class="modal-header custom-modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title text-center">Police Case Data</h4>
            </div>
            <div class="modal-body">
              <div class="div-table">
                  <!-- Prevention Incident -->
                <div class="table">
                   <div class="tr">
                     <div class="td">GD No :</div>
                     <div class="td"><?php echo $value->gd_no; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">GD Date : </div>
                     <div class="td"><?php echo date('d-m-Y', strtotime($value->gd_date)); ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">FIR No : </div>
                     <div class="td"><?php echo $value->fir_no; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">FIR Date : </div>
                     <div class="td"><?php echo date('d-m-Y', strtotime($value->fir_date)); ?></div>
                   </div>
                   <!-- <div class="tr">
                     <div class="td">Police District : </div>
                     <div class="td"><?= ($value->police_district_name)?$value->police_district_name:''; ?></div>
                   </div> -->
                   <div class="tr">
                     <div class="td">Police Station : </div>
                     <div class="td"><?php echo $value->police_station_name; ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">State : </div>
                     <div class="td"><?php if($value->fir_state == 19){?>West Bengal<?php } ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">District : </div>
                     <div class="td"><?php echo ucwords($value->district_name); ?></div>
                   </div>
                   <div class="tr">
                     <div class="td">SD/Block : </div>
                     <div class="td"><?php echo ucwords($value->block_name); ?></div>
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

   <!-- Police Case Modal Start 10-02-2025 Start -->
<div id="police_case_modal" class="modal fade" role="dialog" data-backdrop="static">
  <div class="modal-dialog" style="width: 750px">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="padding: 10px">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="police_modal_title"></h4>
      </div>
      <div class="modal-body" style="padding: 15px">

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
          Success! Police case edit successfully.
        </div>

        <div class="alert alert-warning" role="alert" id="police_success_error" style="display:none;padding: 4px;max-width: 100%;color: #721c24 !important;background-color: #f8d7da !important;border-color: #f5c6cb !important;">
          Oops! Something went wrong. Please try again.
        </div>

        <form id="police_case_form_data">
           <div class="custom-box">

            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-sm-12">
                    <label class="col-form-label">GD No<font color="red">*</font></label>
                    <input type="text" class="form-control" id="gd_number" name="gd_number" autocomplete="off" value="" placeholder="Enter GD No (letters, numbers, / - , and spaces allowed)" onkeyup="validateInput(1)" >
                    <div id="gd_error" style="color: red; display: none;">Invalid GD Number. Only letters, numbers, / - , and spaces allowed.</div>
                    <p class="error-message" id='gd_no_error' style="color:red; display:none;">Enter GD Number</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-sm-12">
                    <label class="col-form-label">FIR No</label>
                    <input type="text" class="form-control" id="fir_no" name="fir_no" autocomplete="off" value="" placeholder="Enter FIR No (letters, numbers, / - , and spaces allowed)" onkeyup="validateInput(2)">
                    <div id="fir_error" style="color: red; display: none;">Invalid FIR Number. Only letters, numbers, / - , and spaces allowed.</div>
                    <!-- <p class="error-message" id='fir_no_error' style="color:red; display:none;">Enter FIR No</p> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="col-sm-12">
                    <label class="col-form-label">GD Date<font color="red">*</font></label>
                    <input type="text" placeholder="Enter GD Date" class="form-control datepicker" id="gd_date" name="gd_date" value="">
                    <p class="error-message" id='gd_date_error' style="color:red; display:none;">Enter GD Date</p>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="row">
                  <div class="col-sm-12">
                    <label class="col-form-label">FIR Date</label>
                    <input type="text" placeholder="Enter FIR Date" class="form-control datepicker" id="fir_date" autocomplete="off" name="fir_date" value="">
                    <p class="error-message" id='fir_date_error' style="color:red; display:none;">Enter FIR Date</p>
                  </div>
                </div>
              </div>
            </div>
         
          <div class="row">
          
            <!-- <div class="col-md-6">
              <div class=" row">
                <div class="col-sm-12">
                  <label class="col-form-label">Block/Municipality<font color="red">*</font></label>
                  <select class="form-control" id='fir_block_municipal' name='fir_block_municipal' onchange="generate_fir_word_gp($(this).val())">
                    <option value="0" selected>--Select Block/Municipality--</option>
                  </select>
                  <p class="error-message" id='fir_block_error' style="color:red; display:none;">Please select Block/Municipality</p>
                </div>
              </div>
            </div> -->

            <!-- <div class="col-md-6">
              <div class=" row">
                <div class="col-sm-12">
                  <label class=" col-form-label">Ward / GP<font color="red">*</font></label>
                    <select class="form-control" id='fir_ward_gp' name='fir_ward_gp'>
                    <option value="0" selected>--Select Ward / GP--</option>
                    </select>
                    <p class="error-message" id='fir_ward_gp_error' style="color:red; display:none;">Please select Ward/GP</p>
                </div>
              </div>
            </div> -->
          </div>

          <div class="row">

            <!-- <div class="col-md-6">
              <div class=" row">
                <div class="col-sm-12">
                  <label class=" col-form-label">Police District<font color="red">*</font></label>
                  <select class="form-control" id='police_district' name='police_district' onchange="generate_police_station($(this).val())">
                    <option value="0" selected>--Select Police District--</option>
                  </select>
                    <p class="error-message" id='police_district_error' style="color:red; display:none;">Please select Police District</p>
                </div>
              </div>
            </div> -->

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
                  <textarea class="form-control press_enter" id="filing_complaint" name="filing_complaint" placeholder="Enter complaint (letters, numbers, / - , and spaces allowed)" onkeyup="validateTextField(this)"></textarea>
                  <div class="char-count">0 / 300</div>
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
                  <textarea class="form-control press_enter" id="persons_accused" name="persons_accused" placeholder="Enter Person/s Accused (letters, numbers, / - , and spaces allowed)" onkeyup="validateTextField(this)"></textarea>
                  <div class="char-count">0 / 300</div>
                  <p class="error-message" id='persons_accused_error' style="color:red; display:none;">Enter Person/s Accused</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-sm-12">
                  <label class="col-form-label">Description of complaint <font color="red">*</font></label>
                  <textarea class="form-control press_enter" id="description_complain" name="description_complain" placeholder="Enter Description of complaint (letters, numbers, / - , and spaces allowed)" onkeyup="validateTextField(this)"></textarea>
                  <div class="char-count">0 / 300</div>
                  <p class="error-message" id='description_error' style="color:red; display:none;">Enter Description of complaint </p>
                </div>
              </div>
            </div>
          </div>


          <!-- New add section 02-04-2025 starts -->
            <div class="row">
              <div class="col-sm-12">
                <label class="col-form-label">Name of officer <font color="red">*</font></label>
                <div class="row">
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="off_first_name" name="off_first_name" placeholder="First name" oninput="validateName(this)">
                    <p class="error-message" id='off_firstname_error' style="color:red; display:none;">Enter officer firts name</p>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="off_middle_name" name="off_middle_name" placeholder="Middle name" oninput="validateName(this)">
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="off_last_name" name="off_last_name" placeholder="Last name" oninput="validateName(this)">
                    <p class="error-message" id='off_lastname_error' style="color:red; display:none;">Enter officer last name </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
              
                   <label class="col-form-label">Designation<font color="red">*</font></label>
                   <select id="officer_designation" name="officer_designation" class="form-control">
                      <option value="0" selected>--Select Officer Designation--</option>
                      <option value="1">Inspector</option>
                      <option value="2">Sub-Inspector</option>
                      <option value="3">Assistant Sub-Inspector</option>
                   </select>
                   <p class="error-message" id='off_designation_error' style="color:red; display:none;">Enter officer designation </p>
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

          <input type="hidden" name="polish_case_form_type" id="polish_case_form_type" value="edit">
          <input type="hidden" name="police_register_id" id="police_register_id">
          <input type="hidden" name="police_incident_id" id="police_incident_id">
          <input type="hidden" name="police_reporting_id" id="police_reporting_id">
          <input type="hidden" name="police_cp_id" id="police_cp_id">
          <input type="hidden" name="police_cp_type" id="police_cp_type">

          <input type="hidden" name="police_incident_date" id="police_incident_date">

         
          </div>

           <div class="modal-footer" style="text-align: right;padding: 5px">
            <button type="button" class="btn btn-primary" id="save_btn" onclick="police_case_register()">Save</button>
            <button type="button" class="btn btn-danger" id="cancel_btn" onclick="police_case_modal_cancel()">Cancel</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
<!-- Police Case Modal Start 17-01-2025 End -->

</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
   $(document).ready(function() {
      $('#gd_date').datepicker({
          dateFormat: 'dd/mm/yy',
          changeMonth: true,
          changeYear: true
      });
  });

  // User Enter Key for new line for all textarea
  $(".press_enter").on("keydown", function (event) {
      // alert(event.key);
      if (event.key === "Enter") {
          // event.preventDefault(); // Prevent default action
          $(this).val($(this).val() + "\n"); // Manually add a new line
      }
  });

  // Strict All Key for GD Date and FIR Date Field
  $(document).ready(function(){
      $("#gd_date, #fir_date").on("paste copy cut drag drop input keydown keypress",function(event){
          event.preventDefault(); // Block all user interactions
      });
  });

  // GD Date and FIR Date Validation Check
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

  function validateTextField(el) {
    let $this = $(el);
    let value = $this.val();
    // Allow only: letters, numbers, comma, hyphen, slash, space, and newline
    let filtered = value.replace(/[^a-zA-Z0-9,\-\/ \n]/g, '');
    // Limit to 300 characters
    if (filtered.length > 300) {
      filtered = filtered.substring(0, 300);
    }
    $this.val(filtered);
    // Update the character counter next to the textarea
    $this.next(".char-count").text(filtered.length + " / 300");
  }

  function validateName(input){
    // Allow only alphabetic characters and dot
    input.value = input.value.replace(/[^a-zA-Z.]/g, '');
  }
</script>

<script type="text/javascript">
  function police_case_register(){

      var gd_number = $('#gd_number').val().trim();
      var gd_date   = $('#gd_date').val().trim();
      var fir_no    = $('#fir_no').val().trim();
      var fir_date  = $('#fir_date').val().trim();

      var police_case_station = $('#police_case_station').val();
      var filing_complaint    = $('#filing_complaint').val().trim();
      var persons_accused     = $('#persons_accused').val().trim();
      var description_complain= $('#description_complain').val().trim();

      var off_first_name      = $('#off_first_name').val().trim();
      var off_middle_name     = $('#off_middle_name').val().trim();
      var off_last_name       = $('#off_last_name').val().trim();
      var officer_designation = $('#officer_designation').val();
  
      var section_9   = $('#section_9').is(':checked') ? $('#section_9').val() : '';
      var section_10  = $('#section_10').is(':checked') ? $('#section_10').val() : '';
      var section_11  = $('#section_11').is(':checked') ? $('#section_11').val() : '';
      
      var polish_case_form_type= $('#polish_case_form_type').val();
      var police_register_id   = $('#police_register_id').val();
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
        else if (incident_date > gd_date_validate) {
            $("#gd_date_error").text("GD date must be greater than or equal to the incident date.").fadeIn(1000);
            isValid = false;
        } 
        else if (incident_date > fir_date_validate) {
            $("#fir_date_error").text("FIR date must be greater than or equal to the incident date.").fadeIn(1000);
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
              console.log(result);
                if (result == 1) {
                    $('#police_exist_error').fadeIn();
                    setTimeout(() => { $('#police_exist_error').fadeOut(); }, 3000);
                } else if (result == 2) {
                    $('#save_btn').text('Loading....');
                    $('#save_btn').prop('disabled', true);
                    // $('#police_case_modal').modal('show');
                    $('#police_success_msg').css('opacity', '1').fadeIn().delay(3000).slideUp(500);
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

<script type="text/javascript">
 
  function editPoliceCase(data,flag){
    // console.log(data);
    // console.log(flag);
    if(flag=='view_history'){
      $('#police_case_modal').find('input,select,textarea').prop('disabled',true);
      $('#save_btn').hide();
    }else if(flag=='edit'){
      $('#police_case_modal').find('input,select,textarea').prop('disabled',false);
      $('#save_btn').show();
    }

    if(data.cp_type==1){
      var cp='One';
    }else if(data.cp_type==2){
      var cp='Two';
    }
    var dateParts = data.incident_date.split("-");
    var year = dateParts[0];
    var month = dateParts[1];
    var day = dateParts[2]; 

    if(data.cp_gender==1){
      var gender='Male';
    }else if(data.cp_gender==2){
      var gender='Female';
    }

    $('#police_modal_title').text('Edit Police Case of Contracting Parties '+cp);
    $('#police_case_inter_id').text(data.reporting_id);
    $('#police_inter_date').text(day+'-'+month+'-'+year);

    var gd_date = data.gd_date ? data.gd_date.split(" ")[0] : null;
    var gd_date_parts = gd_date ? gd_date.split("-") : [];
    var gd_year   = gd_date_parts[0] || '';
    var gd_month  = gd_date_parts[1] || '';
    var gd_day    = gd_date_parts[2] || '';

    var fir_date = data.fir_date ? data.fir_date.split(" ")[0] : null;
    var fir_date_Parts = fir_date ? fir_date.split("-") : [];
    var fir_year = fir_date_Parts[0] || '';
    var fir_month = fir_date_Parts[1] || '';
    var fir_day = fir_date_Parts[2] || '';

    // Set GD Date & GD Number in html field
    $('#gd_number').val(data.gd_no);
    if (gd_day && gd_month && gd_year) {
        $('#gd_date').val(gd_day + '/' + gd_month + '/' + gd_year);
    } else {
        $('#gd_date').val(''); // or set a placeholder like 'N/A'
    }

    // Set FIR Date & FIR Number in html field
    $('#fir_no').val(data.fir_no);
    if (fir_day && fir_month && fir_year) {
        $('#fir_date').val(fir_day + '/' + fir_month + '/' + fir_year);
    } else {
        $('#fir_date').val(''); // or set a placeholder like 'N/A'
    }
   
   
   
    $('#filing_complaint').val(data.person_filing_complain);
    $('#persons_accused').val(data.person_accused);
    $('#description_complain').val(data.description_complaint);

    $('#off_first_name').val(data.officer_first_name);
    $('#off_middle_name').val(data.officer_middle_name);
    $('#off_last_name').val(data.officer_last_name);
    $('#officer_designation').val(data.officer_designation);

    $('#police_register_id').val(data.police_case_id_pk);
    $('#police_incident_id').val(data.incident_id_fk);
    $('#police_reporting_id').val(data.reporting_id);
    $('#police_cp_id').val(data.cp_id_fk);
    $('#police_cp_type').val(data.cp_type);
    $('#police_incident_date').val(data.incident_date);

    //generate_block_municipal(data.fir_district,data.fir_block_municipality);
    //generate_word_gp(data.fir_block_municipality, data.fir_ward_gp);
    //generate_police_district(data.fir_district, data.police_district);
    generate_police_station(data.fir_district, data.police_station);

    get_intervention_address(data.incident_id_fk);
    get_cp_address(data.incident_id_fk,data.incident_date);
    get_pcma_sectin(data.police_case_id_pk, data.incident_id_fk);

    $("#police_case_modal").modal('show');
    
  }

  // Get PCMA Section data by police case register id
  function get_pcma_sectin(police_case_id_pk, incident_id_fk){
    var url ='<?php echo base_url()?>admin/police_case/Police_case/pcma_section/';
      $.ajax({
        url: url,
        method: 'get',
        data: {police_case_id_pk:police_case_id_pk, incident_id_fk:incident_id_fk},
        dataType: 'json',
        success: function(result)
        {
          // console.log(result);
          $.each(result, function(index, value){
            var section = value.pcma_section;
            // Check the checkbox with the corresponding ID
            $('#section_' + section).prop('checked', true);
          });
        }
      });
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

   /*function generate_fir_word_gp(block){
    // alert(block);
    var url = '<?php echo base_url()?>admin/police_case/Police_case/get_block_data/';
    $.ajax({
        url: url,
        method: 'get',
        data: {block:block} ,
        dataType: 'json',
        success: function(result)
        {
          // console.log(result);
            $('#fir_ward_gp').empty();
            $('#fir_ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

            if(result.block_rural_urban=='R'){
                $.each(result.block_gp_data, function (index, item) {
                  var option = '<option value="'+item.gp_id_pk+'">'+item.gp_name+'</option>';
                  $("#fir_ward_gp").append(option);
                });
            }else{
                $.each(result.block_gp_data, function (index, item) {
                  var option = '<option value="'+item.ward_id_pk+'">'+item.ward_no+'</option>';
                  $("#fir_ward_gp").append(option);
                });
            }

        }
    });

  }*/

  // Generate FIR Block and municipality select by district
  /*function generate_fir_block_municipality(district_id)
  {
      //Create block and municipality dynamically
      var url = '<?php echo base_url()?>admin/police_case/Police_case/get_block_municipality/';
      $.ajax({
          url: url,
          method: 'get',
          data: {district_id:district_id} ,
          dataType: 'json',
          success: function(result)
          {
            console.log(result);
            $('#fir_block_municipal').empty();
            $('#fir_block_municipal').append('<option value="0" selected>--Select Block/Municipality--</option>');
            $('#fir_ward_gp').empty();
            $('#fir_ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');
            $('#police_case_station').empty();
            $('#police_case_station').append('<option value="0" selected>--Select Police Station--</option>');

            $.each(result, function (index, item) {
              var option = '<option value="'+item.block_id_pk+'">'+item.block_name+'</option>';
              $("#fir_block_municipal").append(option);
            });
          }
      });

      //Create Police District dynamically
      var url = '<?php echo base_url()?>admin/police_case/Police_case/get_police_district/';
      $.ajax({
          url: url,
          method: 'get',
          data: {district_id:district_id} ,
          dataType: 'json',
          success: function(result)
          {
            console.log(result);
            $('#police_district').empty();
            $('#police_district').append('<option value="0" selected>--Select Police District--</option>');
            
            $.each(result, function (index, item) {
              var option = '<option value="'+item.police_district_id_pk+'">'+item.police_district_name+'</option>';
              $("#police_district").append(option);
            });
          }
      });
  }*/

  // Get Police Station Data
  function generate_police_station(login_district_id, police_station){
      var url = '<?php echo base_url()?>admin/police_case/Police_case/get_police_station/';
      $.ajax({
          url: url,
          method: 'get',
          data: {login_district_id:login_district_id},
          dataType: 'json',
          success: function(result)
          {
            // console.log(result);
            $('#police_case_station').empty();
            $('#police_case_station').append('<option value="0" selected>--Select Police Station--</option>');
            $.each(result, function (index, item) {
              var selected = (item.police_station_id_pk == police_station) ? 'selected' : '';
              var option = '<option value="'+item.police_station_id_pk+'" '+selected+'>'+item.police_station_name+'</option>';
              $("#police_case_station").append(option);
            });

          }
      });
  }
  // Get Police District Data
 /* function generate_police_district(district_id, police_district){
      //Create Police District dynamically
      var url = '<?php echo base_url()?>admin/police_case/Police_case/get_police_district/';
      $.ajax({
          url: url,
          method: 'get',
          data: {district_id:district_id} ,
          dataType: 'json',
          success: function(result)
          {
            // console.log(result);
            $('#police_district').empty();
            $('#police_district').append('<option value="0" selected>--Select Police District--</option>');
            $.each(result, function (index, item) {
              var selected = (item.police_district_id_pk == police_district) ? 'selected' : '';
              var option = '<option value="'+item.police_district_id_pk+'" '+selected+'>'+item.police_district_name+'</option>';
              $("#police_district").append(option);
            });

          }
      });
  }*/

  // create dynamic block municiplity
  /*function generate_block_municipal(district,block){
    
    var url = '<?php echo base_url()?>admin/police_case/Police_case/get_block_municipality/';
    $.ajax({
        url: url,
        method: 'get',
        data: {district_id:district} ,
        dataType: 'json',
        success: function(result)
        {
          console.log(result);
          $('#fir_block_municipal').empty();
          $('#fir_block_municipal').append('<option value="0" selected>--Select Block/Municipality--</option>');
          $.each(result, function (index, item) {
            var selected = (item.block_id_pk == block) ? 'selected' : ''; 
            var option = '<option value="'+item.block_id_pk+'" '+selected+'>'+item.block_name+'</option>';
            $("#fir_block_municipal").append(option);
          });

        }
    });
  }*/

  /*function generate_word_gp(block, ward_gp){

    var url = '<?php echo base_url()?>admin/police_case/Police_case/get_block_data/';
    $.ajax({
        url: url,
        method: 'get',
        data: {block:block} ,
        dataType: 'json',
        success: function(result)
        {
          // console.log(result.block_rural_urban);
            $('#fir_ward_gp').empty();
            $('#fir_ward_gp').append('<option value="0" selected>--Select Ward/GP--</option>');

            if(result.block_rural_urban=='R'){
                $.each(result.block_gp_data, function (index, item) {
                  var selected = (item.gp_id_pk == ward_gp) ? 'selected' : '';
                  var option = '<option value="'+item.gp_id_pk+'" '+selected+'>'+item.gp_name+'</option>';
                  $("#fir_ward_gp").append(option);
                });
            }else{
                $.each(result.block_gp_data, function (index, item) {
                  var selected = (item.ward_id_pk == ward_gp) ? 'selected' : '';
                  var option = '<option value="'+item.ward_id_pk+'" '+selected+'>'+item.ward_no+'</option>';
                  $("#fir_ward_gp").append(option);
                });
            }

        }
    });
  }*/

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

   
    $('#police_case_station option:selected').prop('selected', false);

    $('#police_case_modal').modal('hide');
  }

  // Police Case All Action Function
  function police_case_action(police_case_id_pk, incident_id, cp_id, actionType){
    // alert(police_case_id_pk+'--'+incident_id+'--'+cp_id+'--'+actionType);
    if(actionType=='publish'){
      var text = "Publish";
      var textEd = "Published";
      var textError = "publishing";
    }
    if(actionType=='delete'){
      var text = "Delete";
      var textEd = "Deleted";
      var textError = "deleting";
    }
    if(actionType=='revert'){
      var text = "Revert";
      var textEd = "Reverted";
      var textError = "reverting";
    }
    if(actionType=='forward'){
      var text = "Forward";
      var textEd = "Forwarded";
      var textError = "forwarding";
    }

    swal({
        title: text+'?',
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
            var url = '<?php echo base_url()?>admin/police_case/Police_case/police_case_all_action/';
            $.ajax({
                url: url,
                method: "GET",
                data: {'police_case_id_pk':police_case_id_pk,'incident_id':incident_id,'cp_id':cp_id,'action':actionType},
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
            swal("Cancelled", textEd+" cancel!", "error");
            setTimeout(function(){
              window.location.reload();
            }, 1500);
        } 
    });
  }

  function police_case_action_revert(police_case_id_pk, incident_id, cp_id, actionType){

    // First SweetAlert for confirmation
    swal({
        title: "Revert Home Enquiry?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes, Revert",
        cancelButtonClass: "btn-danger",
        cancelButtonText: "No, Cancel",
        closeOnConfirm: false,
        closeOnCancel: true,
        }, function(isConfirmed) {
            if (isConfirmed) {
                // If user clicks "Yes, Revertback", open second SweetAlert for reason input
                swal({
                    title: "provide a revert reason (max 200 characters)",
                    text: '<textarea id="revert" class="form-control" maxlength="200" style="width:100%;height:60px;"></textarea>' +'<div id="revert-error" style="color:red;display:none;margin-top:5px;">You need to provide a reason!</div>',
                    type: "warning",
                    customClass: 'swal-custom-width',
                    html:true,
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Confirm",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                    closeOnCancel: true,
                    showLoaderOnConfirm: false
                }, function(inputValue) {
                    var reason = $('#revert').val().trim();
                    if (!reason) {
                        $('#revert-error').show(); // manually show error
                        return false;
                    }
                    $('#revert-error').hide(); // hide error if input is valid

                    var url='<?php echo base_url()?>admin/police_case/Police_case/police_case_revert/';
                    $.ajax({
                        url: url,
                        method: "GET",
                        data: {
                            'police_case_id': police_case_id_pk,
                            'reason': reason
                        },
                        dataType: "JSON",
                        success: function(response) {
                            swal("Reverted!", "Revert success", "success");
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            swal("Error", "An error occurred while reverting", "error");
                            console.error(xhr.responseText);
                        }
                    });
                });
            }
        });
  }

 

</script>

<script type="text/javascript">
$(document).on('click','.download',function(){
   var pc_id = $('#pc_id').val();
   if(pc_id != "")
   {
      $.ajax({
          url:'<?php echo base_url()?>admin/reporting/police_case/police_case_form/police_case_download',
          type:'GET',
          data:{'pc_id':pc_id}, 
          success: function(data)
          {
              window.open(data);  
          }
      });
   }
});
</script>
<script type="text/javascript">
function expand(){
document.getElementById('box-table').style.cssText = "overflow: auto; width: 100%; max-width: 100%;"
}
</script>