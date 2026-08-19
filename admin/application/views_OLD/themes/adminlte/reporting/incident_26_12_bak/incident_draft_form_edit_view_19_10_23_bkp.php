<?php $this->load->view($this->config->item('theme_uri').'layout/header_view'); ?>
<?php $this->load->view($this->config->item('theme_uri').'layout/incident_left_menu_view'); ?>
<?php
   foreach($incident_edit_details as $value){
      $incident_id = $value['incident_id_pk'];
   }
   ?>
<style>
   ::placeholder
   {
   color: #000;
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
   .previous_button {
   background: transparent;
   color: #99a2a8;
   border: 0 none;
   border-radius: 5px;
   cursor: pointer;
   min-width: 130px;
   font: 700 14px/40px "Roboto", sans-serif;
   border: 1px solid #99a2a8;
   margin: 0 5px;
   text-transform: uppercase;
   display: inline-block;
   float: right;
   /*margin-top: 25px; */
   margin-bottom: 30px;
   margin-right: 10px;
   }
   .submit_button {
   background: #5cb85c;
   color: white;
   border: 0 none;
   border-radius: 5px;
   cursor: pointer;
   min-width: 130px;
   font: 700 14px/40px "Roboto", sans-serif;
   border: 1px solid #5cb85c;
   margin: -15 5px;
   text-transform: uppercase;
   display: inline-block;
   float: right;
   /*margin-top: 24px; */
   margin-bottom: 30px;
   margin-right: 10px;
   }
   .submit_button:hover {
   background-color: #337ab7;
   border: 1px solid #337ab7;
   color: #FFFFFF;
   }
   .previous_button:hover {
   background-color: #99a2a8;
   border: 1px solid #FFFFFF;
   color: #FFFFFF;
   }
   .bs-stepper-circle {
   font-size: 16px;
   width: 100%;
   padding: 8px 20px 20px 20px;
   border-radius: 10px;
   }
   .label-div
   {
   display: flex;
   justify-content: end;
   }
   .inp
   {
   width: 20%;
   margin-left: 10px;
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
   .tab-list
   {
   /*display: flex;*/
   list-style: none;
   justify-content: space-between;
   padding-left: 0;
   }
   .tab-list li    
   {
   font-size: 16px;
   padding: 8px 20px 20px 20px;
   border-radius: 10px;
   background-color: #6c757d;
   text-align: center;
   padding: 4px 10px;
   margin: 10px;
   position:relative;
   }   
   .form-btn button
   {
   border:none;
   }
   .tab-list li:last-child:after
   {
   background-color: transparent;
   }
   .tab-list li a  
   {
   color:#fff;
   }
   .tab-list li.active
   {
   background-color:#007bff;
   }
   .skin-green-light .sidebar a
   {
   color: #fff;
   }
   .content-header
   {
   display: flex;
   position: fixed;
   top: 50px;
   z-index: 99;
   width: 81.9%;
   right: 0;
   padding: 17px 15px;
   background-color:#fff !important;
   }
   .form-btn ul li
   {
   list-style: none;
   margin: 0px 5px;
   }
   .form-btn ul
   {
   display: flex;
   margin-left: 0px;
   align-items: center;
   }
   .box
   {
   top:50px;
   margin-bottom: 70px;
   }
   .form-btn
   {
   text-align: center;
   position: fixed;
   top: 65px;
   right: 0;
   z-index:99;
   left: 45%;
   }
   .badge {
   margin-top: 20px;
   margin-left: 10px;
   }
   .fixed-header
   {
   background-color: #fff !important;
   width: 81.9%;
   right: 0 !important;
   left:auto !important;
   top:0!important;
   box-shadow: 0px 2px 5px #0000002b;
   }
   .fixed-header-btn
   {
   position: fixed;
   top:15px;
   z-index: 999;
   }
   .control-btn
   {
   background-color:transparent;
   }
   .content
   {
   min-height:100vh !important;
   }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Incident Draft Report</h1>
      <ol class="breadcrumb">
         <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      </ol>
   </section>
   <section class="content">
      <div class="box bottom-box container">
         <?php echo form_open('admin/reporting/incident/incident_form/update_draft_incident/'.base64_encode($incident_edit_details[0]['incident_id_pk']), array('class' => 'incident_form_edit','name' => 'incident_form_edit', 'id' => 'incident_form_edit')) ?>
         <div class="tab-content">
            <?php if($this->session->flashdata('error') != ""){ ?>
               <div class="alert alert-error" style="margin-top: 10px;">
                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo $this->session->flashdata('error'); unset($_SESSION['error']); ?>
               </div>            
            <?php } ?>
            <div id="home" class="tab-pane fade in active">
               <div class="form-btn">
                  <ul>
                     <li>
                        <button type="button" class="btn btn-danger" onClick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                     </li>
                     <!-- <button class="control-btn"><a data-toggle="tab" id="first_next_step" href="#submenu1" class="btn btn-primary next_step"> Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a></button> -->
                  </ul>
               </div>
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 18rem; font-size:medium;">Prevention Incident</label>
                  </div>
               </div>
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Incident Date&nbsp;(dd/mm/yyyy) <font color="red">*</font></label>
                     <div class="col-sm-3">
                        <input type="text" class="form-control datepicker" data-date-end-date="0d" id="incident_date" placeholder="Incident Date" readonly autocomplete="off" name="incident_date" value="<?php if($incident_edit_details[0]['incident_date']!=null){?><?php echo date('d/m/Y', strtotime($incident_edit_details[0]['incident_date']))?><?php } ?>" <?php if(set_value('incident_date') != ''){?><?php echo set_value('incident_date'); }?> style="background-color: white;" tabindex="7">
                        <?php echo form_error('incident_date');?>
                        <span id="incident_date_error" style="color: red;"></span>
                     </div>
                     <div class="col-sm-6">
                        <?php
                           $mrg_dtl_val= '';
                           if(set_value('marriage_details'))
                           {
                              $mrg_dtl_val= set_value('marriage_details');
                           }
                           elseif($incident_edit_details[0]['marriage_details'])
                           {
                              $mrg_dtl_val= $incident_edit_details[0]['marriage_details'];
                           }
                           else
                           {
                              $mrg_dtl_val= '';
                           }
                           foreach($marriage_details as $key => $value){
                              if($key == 0){
                                 $marriage_details_css = 'margin-left: 280px';
                              }elseif($key == 1){
                                 $marriage_details_css = 'margin-left: 260px';
                              }else{
                                 $marriage_details_css = 'margin-left: 293px';
                              }
                           ?>
                        <span style="<?php echo $marriage_details_css; ?>"><?php echo $value['description']?></span><input type="radio" value="<?php echo $value['cm_marriage_master_id_pk']?>"
                           <?php 
                              if($mrg_dtl_val==$value['cm_marriage_master_id_pk'])
                              {
                                 echo "checked='checked'"; 
                              }
                              else
                              {
                                 echo '';
                              }
                              ?>  
                           name="marriage_details" style="float: right;margin-right: 80px;"><br>
                        <?php } ?>
                        <?php echo form_error('marriage_details');?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Street / Landmark</label>
                     <div class="col-sm-5">
                        <input type="text" placeholder="Street / Landmark" class="form-control" id="street_landmark" autocomplete="off" name="street_landmark" value="<?php if(set_value('street_landmark') != ''){?><?php echo set_value('street_landmark'); ?><?php }else{?><?php echo $incident_edit_details[0]['street_landmark']?><?php } ?>">
                        <?php echo form_error('street_landmark');?>
                        <span id="landmark_error" style="color: red;"></span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">State <font color="red">*</font></label>
                     <div class="col-sm-5">
                        <input type="text" placeholder="State" class="form-control" id="state" autocomplete="off" name="state" value="West Bengal" readonly style="cursor: not-allowed;">
                     </div>
                     <div class="col-sm-4">
                        <?php
                           $prevented_details_value= '';
                           if(set_value('prevented_details'))
                           {
                              $prevented_details_value= set_value('prevented_details');
                           }
                           elseif($incident_edit_details[0]['prevented_details'])
                           {
                              $prevented_details_value= $incident_edit_details[0]['prevented_details'];
                           }
                           else
                           {
                              $prevented_details_value= '';
                           }
                           foreach($prevented_details as $key => $value){
                              if($key == 0){
                              $prevented_details_css = 'margin-left: 132px';
                              }else{
                                 $prevented_details_css = 'margin-left: 106px';
                              }
                           ?>
                        <span style="<?php echo $prevented_details_css; ?>"><?php echo $value['description']?></span><input type="radio" value="<?php echo $value['cm_incident_report_details_master_id_pk']?>"
                           <?php 
                              if($prevented_details_value==$value['cm_incident_report_details_master_id_pk'])
                              {
                                 echo "checked='checked'"; 
                              }
                              else
                              {
                                 echo '';
                              }
                              ?>  
                           class="prevented_details" name="prevented_details" id="prevented_details" style="float: right;margin-right: 87px;"><br>
                        <?php } ?>                                
                        <?php echo form_error('prevented_details');?> 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">District <font color="red">*</font></label>
                     <div class="col-sm-5">
                        <select class="form-control district" name="incident_district" id="incident_district" readonly style="cursor: not-allowed;">
                           <option value="<?php echo $districts_name->district_id_pk; ?>" <?php echo set_select('incident_district', $districts_name->district_id_pk, False); ?>><?php echo $districts_name->district_name; ?></option>
                        </select>
                        <?php echo form_error('incident_district'); ?>   
                        <span id="incident_district_error" style="color: red;"></span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Block / Municipality <font color="red">*</font></label>
                     <div class="col-sm-5">
                        <?php if($this->session->userdata('stake_id_fk') == '4' && $this->session->userdata('subdiv') == '' || $this->session->userdata('stake_id_fk') == '2' && $this->session->userdata('subdiv') == ''){?>
                        <select class="form-control" name="incident_block" id="incident_block" readonly style="cursor: not-allowed;">
                           <option value="<?php echo $block_name->block_id_pk;?>" <?php echo set_select('incident_block', $block_name->block_id_pk); ?>><?php echo $block_name->block_name;?></option>
                        </select>
                        <?php }elseif($this->session->userdata('stake_id_fk') == '3'){?>
                        <select class="form-control" name="incident_block" id="incident_block">
                           <?php foreach($block_details_name as $value){?>
                           <option value="<?php echo $value['block_id_pk']; ?>" <?php if($incident_edit_details[0]['incident_block_id'] == $value['block_id_pk']){ echo "selected"; } ?>><?php echo $value['block_name']; ?></option>
                           <?php } ?>
                        </select>
                        <?php }elseif($this->session->userdata('stake_id_fk') == '4' && $this->session->userdata('subdiv') != ''){?>
                        <select class="form-control" name="incident_block" id="incident_block">
                           <?php foreach($sdo_deo_level_block_name as $value){?>
                           <option value="<?php echo $value['block_id_pk']; ?>" <?php if($incident_edit_details[0]['incident_block_id'] == $value['block_id_pk']){ echo "selected"; } ?>><?php echo $value['block_name']; ?></option> 
                           <?php } ?>
                        </select>
                        <?php } ?>
                        <?php echo form_error('incident_block'); ?>
                        <span id="incident_block_error" style="color: red;"></span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Ward / GP <font color="red">*</font></label>
                     <div class="col-sm-5">
                        <select class="form-control" id="ward_gp" autocomplete="off" name="ward_gp">
                            <option value="" disabled selected>--Select Block / Municipality First--</option>
                            <?php if(!empty($Incident_Ward_Gp_Block)){?>
                               <?php if($Incident_Ward_Gp_Block->rural_urban == 'U'){?>
                                 <?php foreach($Incident_Ward as $Incident_Ward_Value){ ?>
                                   <option value="<?php echo $Incident_Ward_Value['ward_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_Ward_Value['ward_id_pk'], False); ?><?php if($incident_edit_details[0]['ward_gp'] == $Incident_Ward_Value['ward_id_pk']){ echo "selected"; }?>><?php echo $Incident_Ward_Value['ward_no'];?></option> 
                                 <?php } ?>
                               <?php }else{?>
                                 <?php foreach($Incident_Gp as $Incident_GP_Value){ ?>
                                    <option value="<?php echo $Incident_GP_Value['gp_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_GP_Value['gp_id_pk'], False); ?><?php if($incident_edit_details[0]['ward_gp'] == $Incident_GP_Value['gp_id_pk']){ echo "selected"; }?>><?php echo $Incident_GP_Value['gp_name'];?></option> 
                                 <?php } ?>
                            <?php } } ?>
                        </select>
                        <?php echo form_error('ward_gp');?>
                        <span id="ward_error" style="color: red;"></span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Pin Code <font color="red">*</font></label>
                     <div class="col-sm-5">
                        <input type="text" name="pin_code" id="pin_code" class="form-control pin_code_validate" value="<?php if(set_value('pin_code') != ''){?><?php echo set_value('pin_code'); ?><?php }else{?><?php echo $incident_edit_details[0]['pin_code']?><?php } ?>" placeholder="Pin Code" maxlength="6" onpaste="return false">
                        <span id="lbl_error_pin_code" style="color: red;"></span>
                        <?php echo form_error('pin_code'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Police Station <font color="red">*</font></label>
                     <div class="col-sm-5">
                        <input type="text" class="form-control" placeholder="Police Station" name="police_station" id="police_station" autocomplete="off" value="<?php if(set_value('police_station') != ''){?><?php echo set_value('police_station'); ?><?php }else{?><?php echo $incident_edit_details[0]['cmir_police_station']?><?php } ?>">
                        <?php echo form_error('police_station');?> 
                        <span id="police_station_error" style="color: red;"></span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Description of location</label>
                     <div class="col-sm-9">
                        <div class="des-loc">
                           <?php
                              $location_description_value= '';
                              if(set_value('location_description')){
                                 $location_description_value= set_value('location_description');
                              }elseif($incident_edit_details[0]['location_description']){
                                 $location_description_value= $incident_edit_details[0]['location_description'];
                              }else{
                                 $location_description_value= '';
                              }
                              foreach($location_description_details as $value){?>
                           <div class="inp-radio">
                              <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_location_master_id_pk']?>"
                                 <?php 
                                    if($location_description_value==$value['cm_location_master_id_pk']){
                                       echo "checked='checked'"; 
                                    }else{
                                       echo '';
                                    }
                                    ?>  
                                 name="location_description" id="location_description">&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                           </div>
                           <?php } ?>                                     
                           <?php echo form_error('location_description');?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="submenu1" class="tab-pane fade">
               <div class="form-btn">
                  <ul>
                     <li>
                        <button type="button" class="btn btn-danger cancel_incident" onClick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                     </li>
                     <!-- <button><a data-toggle="tab" id="first_prev_step" href="#home" class="btn btn-primary next_step"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</a></button>
                     <button><a data-toggle="tab" id="second_next_step" href="#submenu2" class="btn btn-primary next_step"> Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a></button> -->
                  </ul>
               </div>
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 48rem; font-size:medium;">Information First Received at Block / Municipality office from</label>
                  </div>
               </div>
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Anonymous <font color="red">*</font></label>
                     <div class="col-sm-5">
                        <label class="radio-inline"><input type="radio" name="anonymous" id="anonymous" class="anonymous" value="1" <?php echo set_radio('anonymous', '1'); ?><?php echo ($incident_edit_details[0]['anonymous']== '1') ?  "checked" : "" ;  ?>>&nbsp;Yes</label>&nbsp;&nbsp;
                        <label class="radio-inline"><input type="radio" name="anonymous" id="anonymous" class="anonymous" value="2" <?php echo set_radio('anonymous', '2'); ?><?php echo ($incident_edit_details[0]['anonymous']== '2') ?  "checked" : "" ;  ?>>&nbsp;No</label>&nbsp;&nbsp;
                        <?php echo form_error('anonymous');?>  
                     </div>
                  </div>
               </div>
               <div class="card-body" id="Anonymous_1">
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">If identity known Name <font color="red">*</font></label>
                     <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="If identity known Name" name="identity_known_name" id="identity_known_name" autocomplete="off" value="<?php if(set_value('identity_known_name') != ''){?><?php echo set_value('identity_known_name'); ?><?php }else{?><?php echo $incident_edit_details[0]['identity_known_name']?><?php } ?>" onkeypress="return Identity_Known_Name_Validate(event);">
                        <span id="identity_known_name_lbl_error" style="color: red"></span>
                        <?php echo form_error('identity_known_name');?>    
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Street / Landmark</label>
                     <div class="col-sm-9">
                        <input type="text" placeholder="Street / Landmark" class="form-control" id="identity_street_landmark" autocomplete="off" name="identity_street_landmark" value="<?php if(set_value('identity_street_landmark') != ''){?><?php echo set_value('identity_street_landmark'); ?><?php }else{?><?php echo $incident_edit_details[0]['identity_street_landmark']?><?php } ?>">
                        <?php echo form_error('identity_street_landmark');?>   
                     </div>
                  </div>
               </div>
               <div class="card-body" id="Anonymous_2">
                  <div class="left-form">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">State <font color="red">*</font></label>
                        <div class="col-sm-5">
                           <input type="text" placeholder="State" class="form-control" id="identity_state" autocomplete="off" name="identity_state" value="West Bengal" readonly style="cursor: not-allowed;">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">District <font color="red">*</font></label>
                        <div class="col-sm-5">
                           <select class="form-control district" name="identity_district" id="identity_district">
                              <option disabled="" selected="">--Please Select District--</option>
                              <?php foreach($districts as $district){ ?> 
                              <option value="<?php echo $district['district_id_pk'];?>" <?php echo set_select('identity_district', $district['district_id_pk'], False); ?><?php if($incident_edit_details[0]['identity_district']==$district['district_id_pk']){ echo "selected"; }?>><?php echo $district['district_name'];?></option>
                              <?php } ?>                     
                           </select>
                           <?php echo form_error('identity_district'); ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Block / Municipality <font color="red">*</font></label>
                        <div class="col-sm-5">
                           <select class="form-control" name="identity_block" id="identity_block">
                              <option disabled="" selected="" value="">--Please Select District First--</option>
                              <?php foreach($identityBlock as $incidentBlockValue){ ?>
                              <option value="<?php echo $incidentBlockValue['block_id_pk'];?>" <?php echo set_select('identity_block', $incidentBlockValue['block_id_pk']); ?> <?php if($incidentBlockValue['block_id_pk'] == $incident_edit_details[0]['identity_block']){ echo "selected"; }?>><?php echo $incidentBlockValue['block_name'];?></option>
                              <?php } ?>
                           </select>
                           <?php echo form_error('identity_block'); ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Ward / GP <font color="red">*</font></label>
                        <div class="col-sm-5">
                           <select class="form-control" id="identity_ward_gp" autocomplete="off" name="identity_ward_gp">
                                <option value="0" disabled selected>--Select SD/Block First--</option>
                                <?php if(!empty($Identity_Ward_Gp_Block)){?>
                                   <?php if($Identity_Ward_Gp_Block->rural_urban == 'U'){?>
                                   <?php foreach($Identity_Ward as $Identity_Ward_Value){ ?>
                                   <option value="<?php echo $Identity_Ward_Value['ward_id_pk'];?>" <?php echo set_select('identity_ward_gp', $Identity_Ward_Value['ward_id_pk']); ?> <?php if($incident_edit_details[0]['identity_ward_gp'] == $Identity_Ward_Value['ward_id_pk']){ echo "selected"; } ?>><?php echo $Identity_Ward_Value['ward_no'];?></option> 
                                   <?php } ?>
                                 <?php }else{?>
                                   <?php foreach($Identity_Gp as $Identity_GP_Value){ ?>
                                   <option value="<?php echo $Identity_GP_Value['gp_id_pk'];?>" <?php echo set_select('identity_ward_gp', $Identity_GP_Value['gp_id_pk'], False); ?><?php if($incident_edit_details[0]['identity_ward_gp'] == $Identity_GP_Value['gp_id_pk']){ echo "selected"; }?>><?php echo $Identity_GP_Value['gp_name'];?></option> 
                                   <?php } ?>
                                 <?php } } ?>
                           </select>
                           <?php echo form_error('identity_ward_gp');?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pin Code</label>
                        <div class="col-sm-5">
                           <input type="text" name="identity_pin_code" id="identity_pin_code" class="form-control identity_pin_code_validate" value="<?php if(set_value('identity_pin_code') != ''){?><?php echo set_value('identity_pin_code'); ?><?php }else{?><?php echo $incident_edit_details[0]['identity_pin_code']?><?php } ?>" placeholder="Pin Code" maxlength="6" onpaste="return false">
                           <span id="lbl_error_identity_pin_code" style="color: red;"></span>
                           <?php echo form_error('identity_pin_code'); ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Police Station <font color="red">*</font></label>
                        <div class="col-sm-5">
                           <input type="text" class="form-control" placeholder="Police Station" name="identity_police_station" id="identity_police_station" autocomplete="off"  value="<?php if(set_value('identity_police_station') != ''){?><?php echo set_value('identity_police_station'); ?><?php }else{?><?php echo $incident_edit_details[0]['identity_police_station']?><?php } ?>">
                           <?php echo form_error('identity_police_station');?>  
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone No <font color="red">*</font></label>
                        <div class="col-sm-5">
                           <input type="text" name="identity_phone_no" id="identity_phone_no" class="form-control identity_phone_no_validate" value="<?php if(set_value('identity_phone_no') != ''){?><?php echo set_value('identity_phone_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['identity_phone_no']?><?php } ?>" placeholder="Phone No" maxlength="10" onkeyup="phone_number_validation()" onpaste="return false">
                           <span id="lbl_error_identity_phone_no" style="color: red;"></span>
                           <?php echo form_error('identity_phone_no'); ?>
                        </div>
                     </div>
                     <div class="form-group row Information_Received">
                        <h5 class=""><strong>Information Received by</strong> <font color="red">*</font></h5>
                        <div class="">
                           <?php
                              $information_received_details_value= '';
                              if(set_value('information_received')){
                                $information_received_details_value= set_value('information_received');
                              }elseif($incident_edit_details[0]['information_received']){
                                $information_received_details_value= $incident_edit_details[0]['information_received'];
                              }else{
                                $information_received_details_value= '';
                              }
                              foreach($information_received_details as $value){?>
                           <span style="margin-right: 15px;"><?php echo $value['description']?></span>&nbsp;<input type="radio" value="<?php echo $value['cm_information_received_master_id_pk']?>"
                              <?php if($information_received_details_value==$value['cm_information_received_master_id_pk']){
                                 echo "checked='checked'"; 
                                 }else{
                                 echo '';
                                 }
                                 ?>  
                              name="information_received" style="margin-right: 9px;"><br>
                           <?php } ?>
                           <?php echo form_error('information_received');?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="submenu2" class="tab-pane fade">
               <div class="form-btn">
                  <ul>
                     <li>
                        <button type="button" class="btn btn-danger cancel_incident" onClick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                     </li>
                     <!-- <button><a data-toggle="tab" id="second_prev_step" href="#submenu1" class="btn btn-primary next_step"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</a></button>
                     <button><a data-toggle="tab" id="third_next_step" href="#submenu3" class="btn btn-primary next_step"> Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a></button> -->
                  </ul>
               </div>
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 38rem; font-size:medium;">Local Persons Involved in Prevention Incident</label>
                  </div>
               </div>
               <div class="card-body">
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-12">
                              <table class="table table-bordered" id="Local_Persons_Involved_Table_Field">
                                 <tr style="background-color: gray; color: #FFFFFF;">
                                    <th>Name, if available</th>
                                    <th style="text-align: center;">Male</th>
                                    <th style="text-align: center;">Female</th>
                                    <th>Occupation / Identity</th>
                                    <th>Action</th>
                                 </tr>
                                 <?php
                                    $count = 0;
                                    $query = Get_Local_Person_Edit_Details($incident_id);
                                    $queryArray =($this->input->post('Local_Persons_Involved_Details'))?json_decode(json_encode(set_value('Local_Persons_Involved_Details')), FALSE):$query;
                                    foreach($queryArray as $key => $value){$count ++; 
                                    ?>
                                 <input type="hidden" name="sl_no[<?=$key?>]" value="<?=(isset($value->sl_no))?$value->sl_no:set_value('sl_no['.$key.']')?>">

                                 <input type="hidden" name="Local_Persons_Involved_Details[<?=$key?>][lpi_id]" value="<?=(isset($value->sl_no))?$value->sl_no:set_value('Local_Persons_Involved_Details['.$key.'][lpi_id]')?>">

                                 <tr id="Local_Persons_Involved_Details<?php if($this->input->post('Local_Persons_Involved_Details')){ echo $count++; ?><?php }else{?><?php echo $value->sl_no; ?><?php } ?>">

                                    <td><input type="text" class="form-control" id="local_person_name" name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_name]" value="<?php echo $value->local_person_name; ?>" placeholder="Name, if available" onkeypress="return Local_Person_Name_Validate(event);"></td>

                                    <td><input type="radio" name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_gender]" value="1" <?php if(isset($value->local_person_gender)){if($value->local_person_gender == '1'){ echo "checked"; }}?>></td>

                                    <td><input type="radio" name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_gender]" value="2" <?php if(isset($value->local_person_gender)){if($value->local_person_gender == '2'){ echo "checked"; }}?>></td>

                                    <td><input type="text" class="form-control" name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_occupation_identity]" value="<?php echo $value->local_person_occupation_identity; ?>" placeholder="Occupation / Identity"></td>
                                    <td>
                                       <?php if(isset($value->sl_no)){ ?> 
                                       <button type="button" class="btn btn-danger form-control" onclick="return Local_Persons_Involved_Row_Delete('<?php echo $value->sl_no; ?>')"><i class="fa fa-trash"></i></button>
                                       <?php }else{ ?>
                                       <button type="button" id="Local_Persons_Involved_Remove" class="btn btn-danger form-control"><i class="fa fa-trash"></i></button>
                                       <?php } ?>
                                    </td>
                                 </tr>
                                 <?php } ?>
                              </table>
                              <div class="text-right">
                                 <button type="button" id="Local_Persons_Involved_Add" class="btn btn-warning" style="width: 76px;margin-right: 9px;"><i class="fa fa-plus"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="submenu3" class="tab-pane fade">
               <div class="form-btn">
                  <ul>
                     <li>
                        <button type="button" class="btn btn-danger cancel_incident" onClick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                     </li>
                     <!-- <button><a data-toggle="tab" id="third_prev_step" href="#submenu2" class="btn btn-primary next_step"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</a></button>
                     <button><a data-toggle="tab" id="fourth_next_step" href="#menu1" class="btn btn-primary next_step"> Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a></button> -->
                  </ul>
               </div>
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 34rem; font-size:medium;">Officials Involved in Prevention Incident</label>
                  </div>
               </div>
               <div class="card-body">
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-12">
                              <table class="table table-bordered" id="Officials_Involved_Table_Field">
                                 <tr style="background-color: gray; color: #FFFFFF;">
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Office</th>
                                    <th>Contact No</th>
                                    <th>Action</th>
                                 </tr>
                                 <?php
                                    $count = 0;
                                    $query = Get_Officials_Involved_Edit_Details($incident_id);
                                    if($this->input->post('Officials_Involved_Details')){
                                       $OfficialsQueryArray = json_decode(json_encode(set_value('Officials_Involved_Details')), FALSE);
                                    }else{
                                       $OfficialsQueryArray = $query;
                                    }
                                    foreach($OfficialsQueryArray as $key => $value){$count ++;
                                    ?>
                                 <input type="hidden" name="sl_no_oi[<?=$key?>]" value="<?=(isset($value->sl_no))?$value->sl_no:set_value('sl_no_oi['.$key.']')?>">

                                 <input type="hidden" name="Officials_Involved_Details[<?=$key?>][ol_id]" value="<?=(isset($value->sl_no))?$value->sl_no:set_value('Officials_Involved_Details['.$key.'][ol_id]')?>">

                                 <tr id="delete_officials_involved_row<?php if($this->input->post('Officials_Involved_Details')){ echo $count++; ?><?php }else{?><?php echo $value->sl_no; ?><?php } ?>">

                                    <td><input type="text" class="form-control" id="official_involved_name" name="Officials_Involved_Details[<?php echo $key ?>][official_involved_name]" placeholder="Name" value="<?php echo $value->official_involved_name; ?>" onkeypress="return Official_Involved_Name_Validate(event);"></td>

                                    <td><input type="text" class="form-control" name="Officials_Involved_Details[<?php echo $key ?>][officials_involved_designation]" placeholder="Designation" value="<?php echo $value->officials_involved_designation; ?>"></td>

                                    <td><input type="text" class="form-control" name="Officials_Involved_Details[<?php echo $key ?>][officials_involved_office]" placeholder="Office" value="<?php echo $value->officials_involved_office; ?>"></td>

                                    <td><input type="text" class="form-control officials_involved_contact_no_validate" name="Officials_Involved_Details[<?php echo $key ?>][officials_involved_contact_no]" placeholder="Contact No" onkeyup="phone_number_validation()" maxlength="10" value="<?php echo $value->officials_involved_contact_no; ?>"></td>
                                    <td>
                                       <?php if(isset($value->sl_no)){ ?> 
                                       <button type="button" class="btn btn-danger form-control" onclick="return Officials_Involved_Row_Delete('<?php echo $value->sl_no; ?>')"><i class="fa fa-trash"></i></button>
                                       <?php }else{ ?>
                                       <button type="button" id="Officials_Involved_Remove" class="btn btn-danger form-control" fdprocessedid="ebpxyn"><i class="fa fa-trash"></i></button>
                                       <?php } ?>
                                    </td>
                                 </tr>
                                 <?php } ?>
                              </table>
                              <div class="text-right">
                                 <button type="button" id="Officials_Involved_Add" class="btn btn-warning form-control" style="width: 49px;margin-right: 9px;margin-top: -11px;"><i class="fa fa-plus"></i></button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="menu1" class="tab-pane fade">
               <div class="form-btn">
                  <ul>
                     <li>
                        <button type="button" class="btn btn-danger cancel_incident" onClick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                     </li>
                     <!-- <button><a data-toggle="tab" id="fourth_prev_step" href="#submenu3" class="btn btn-primary next_step"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</a></button>
                     <button><a data-toggle="tab" id="fifth_next_step" href="#menu2" class="btn btn-primary next_step"> Next <i class="fa fa-arrow-right" aria-hidden="true"></i></a></button> -->
                  </ul>
               </div>
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 20rem; font-size:medium;">Contracting Party One</label>
                  </div>
               </div>
               <?php
                  $cp_one_name = $incident_edit_details[0]['cp_one_name'];
                  $cp_one_name_array = explode(" ", $cp_one_name);
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
                     <label class="col-sm-3 col-form-label">Name <font color="red">*</font></label>
                     <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="First Name" name="cp_one_f_name" id="cp_one_f_name" autocomplete="off" value="<?php if(set_value('cp_one_f_name') != ''){?><?php echo set_value('cp_one_f_name'); ?><?php }else{?><?php echo $cp_one_f_name; ?><?php } ?>" onkeypress="return CP_One_First_Name_Validate(event);">  
                        <span id="cp_one_first_name_lbl_error" style="color: red"></span> 
                        <?php echo form_error('cp_one_f_name');?>
                     </div>
                     <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Middle Name" name="cp_one_m_name" id="cp_one_m_name" autocomplete="off" value="<?php if(set_value('cp_one_m_name') != ''){?><?php echo set_value('cp_one_m_name'); ?><?php }else{?><?php echo $cp_one_m_name; ?><?php } ?>" onkeypress="return CP_One_Middle_Name_Validate(event);">  
                        <span id="cp_one_middle_name_lbl_error" style="color: red"></span>
                     </div>
                     <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Last Name" name="cp_one_l_name" id="cp_one_l_name" autocomplete="off" value="<?php if(set_value('cp_one_l_name') != ''){?><?php echo set_value('cp_one_l_name'); ?><?php }else{?><?php echo $cp_one_l_name; ?><?php } ?>" onkeypress="return CP_One_Last_Name_Validate(event);">  
                        <span id="cp_one_last_name_lbl_error" style="color: red"></span> 
                        <?php echo form_error('cp_one_l_name');?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Street / Landmark</label>
                     <div class="col-sm-9">
                        <input type="text" placeholder="Street / Landmark" class="form-control" id="cp_one_street_landmark" autocomplete="off" name="cp_one_street_landmark" value="<?php if(set_value('cp_one_street_landmark') != ''){?><?php echo set_value('cp_one_street_landmark'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_street_landmark']?><?php } ?>">  
                        <?php echo form_error('cp_one_street_landmark');?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">State <font color="red">*</font></label>
                     <div class="col-sm-6">
                        <select class="form-control cp_one_state_box" id="cp_one_state" autocomplete="off" name="cp_one_state">
                            <option value="0" disabled selected>--Select State--</option>
                            <?php foreach($state as $value){?>
                            <option value="<?php echo $value['state_id_pk']; ?>" <?php echo set_select('cp_one_state', $value['state_id_pk'], False); ?> <?php if($incident_edit_details[0]['cp_one_state'] == $value['state_id_pk']){ echo "selected"; }?>><?php echo $value['state_name']; ?></option>
                            <?php } ?>
                            <?php echo form_error('cp_one_state');?> 
                        </select>
                     </div>
                  </div>
                  <div id="cp_one_address_div_one">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">District <font color="red">*</font></label>
                        <div class="col-sm-6">
                           <select class="form-control district" name="cp_one_district" id="cp_one_district">
                              <option disabled="" selected="">--Please Select District--</option>
                              <?php foreach($CP_One_District_Details as $CP_One_District_Value){ ?>
                              <option value="<?php echo $CP_One_District_Value['district_id_pk'];?>" <?php echo set_select('cp_one_district', $CP_One_District_Value['district_id_pk'], False); ?><?php if($incident_edit_details[0]['cp_one_district'] == $CP_One_District_Value['district_id_pk']){ echo "selected"; } ?>><?php echo $CP_One_District_Value['district_name'];?></option> 
                              <?php } ?>
                           </select>
                           <?php echo form_error('cp_one_district'); ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Block / Municipality <font color="red">*</font></label>
                        <div class="col-sm-6">
                           <select class="form-control" name="cp_one_block" id="cp_one_block">
                              <option disabled="" selected="" value="">--Please Select District First--</option>
                              <?php foreach($cponeBlock as $cponeBlockValue){ ?>
                              <option value="<?php echo $cponeBlockValue['block_id_pk'];?>" <?php echo set_select('cp_one_block', $cponeBlockValue['block_id_pk']); ?> <?php if($cponeBlockValue['block_id_pk'] == $incident_edit_details[0]['cp_one_block']){ echo "selected"; }?>><?php echo $cponeBlockValue['block_name'];?></option>
                              <?php } ?>
                           </select>
                           <?php echo form_error('cp_one_block'); ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Ward / GP <font color="red">*</font></label>
                        <div class="col-sm-6">
                           <select class="form-control" id="cp_one_ward_gp" autocomplete="off" name="cp_one_ward_gp">
                             <option value="0" disabled selected>--Select SD/Block First--</option>
                             <?php if(!empty($Cp_One_Ward_Gp_Block)){?>
                             <?php if($Cp_One_Ward_Gp_Block->rural_urban == 'U'){?>
                               <?php foreach($Cp_One_Ward as $Cp_One_Ward_Value){ ?>
                               <option value="<?php echo $Cp_One_Ward_Value['ward_id_pk'];?>" <?php echo set_select('cp_one_ward_gp', $Cp_One_Ward_Value['ward_id_pk']); ?> <?php if($incident_edit_details[0]['cp_one_ward_gp'] == $Cp_One_Ward_Value['ward_id_pk']){ echo "selected"; } ?>><?php echo $Cp_One_Ward_Value['ward_no'];?></option> 
                               <?php } ?>
                             <?php }else{?>
                               <?php foreach($Cp_One_Gp as $Cp_One_GP_Value){ ?>
                               <option value="<?php echo $Cp_One_GP_Value['gp_id_pk'];?>" <?php echo set_select('cp_one_ward_gp', $Cp_One_GP_Value['gp_id_pk']); ?> <?php if($incident_edit_details[0]['cp_one_ward_gp'] == $Cp_One_GP_Value['gp_id_pk']){ echo "selected"; } ?>><?php echo $Cp_One_GP_Value['gp_name'];?></option> 
                               <?php } ?>
                             <?php } } ?>
                           </select>
                           <?php echo form_error('cp_one_ward_gp');?>
                        </div>
                     </div>
                  </div>
                  <div id="cp_one_address_div_two">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label">Address <font color="red">*</font></label>
                      <div class="col-sm-6">
                        <textarea class="form-control" name="cp_one_address" id="cp_one_address" rows="3" placeholder="Address"><?php if(set_value('cp_one_address') != ''){?><?php echo set_value('cp_one_address'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_address']?><?php } ?></textarea>
                        <?php echo form_error('cp_one_address'); ?>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Pin Code <font color="red">*</font></label>
                     <div class="col-sm-6">
                        <input type="text" name="cp_one_pin_code" id="cp_one_pin_code" class="form-control cp_one_pin_code_validate" value="<?php if(set_value('cp_one_pin_code') != ''){?><?php echo set_value('cp_one_pin_code'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_pin_code']?><?php } ?>" placeholder="Pin Code" maxlength="6" onpaste="return false">
                        <span id="lbl_error_cp_one_pin_code" style="color: red;"></span>
                        <?php echo form_error('cp_one_pin_code'); ?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Police Station <font color="red">*</font></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Police Station" name="cp_one_police_station" id="cp_one_police_station" autocomplete="off" value="<?php if(set_value('cp_one_police_station') != ''){?><?php echo set_value('cp_one_police_station'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_police_station']?><?php } ?>">  
                        <?php echo form_error('cp_one_police_station');?> 
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Phone No <font color="red">*</font></label>
                     <div class="col-sm-6">
                        <input type="text" name="cp_one_phone_no" id="cp_one_phone_no" class="form-control cp_one_phone_no_validate" value="<?php if(set_value('cp_one_phone_no') != ''){?><?php echo set_value('cp_one_phone_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_phone_no']?><?php } ?>" placeholder="Phone No" maxlength="10" onpaste="return false">
                        <span id="lbl_error_cp_one_phone_no" style="color: red;"></span>
                        <?php echo form_error('cp_one_phone_no'); ?>
                     </div>
                  </div>
               </div>
               <hr style="border: 1px solid gray;">
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Gender <font color="red">*</font></label>
                     <div class="col-sm-9">
                        <div class="des-loc">
                           <?php
                              $gd= '';
                              $gender_details_value = $incident_edit_details[0]['cp_one_gender'];
                              foreach($gender_details as $value){
                                if((set_radio('cp_one_gender',$value['cm_gender_master_id_pk']))!='')
                                {
                                   $gd = $value['cm_gender_master_id_pk'];
                                }
                              }
                              foreach($gender_details as $value){
                                if(($gender_details_value==$value['cm_gender_master_id_pk']) && $gd=='' )
                                {
                                   $gd = $value['cm_gender_master_id_pk'];
                                }
                                ?>
                           <div class="inp-radio">
                              <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_gender_master_id_pk']?>"
                                 <?php if($gd==$value['cm_gender_master_id_pk']){echo "checked='checked'"; 
                                    }else{
                                       echo '';
                                    }
                                    ?> class="cp_one_gender_val"  name="cp_one_gender" >&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                           </div>
                           <?php } ?>
                           <?php echo form_error('cp_one_gender');?>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Social Category</label>
                     <div class="col-sm-9">
                        <div class="des-loc">
                           <?php
                              $scl_dtl_val= '';
                              if(set_value('cp_one_social_category'))
                              {
                                 $scl_dtl_val= set_value('cp_one_social_category');
                              }
                              elseif($incident_edit_details[0]['cp_one_social_category'])
                              {
                                 $scl_dtl_val= $incident_edit_details[0]['cp_one_social_category'];
                              }
                              else
                              {
                                 $scl_dtl_val= '';
                              }
                              foreach($social_category_details as $value)
                              {
                                 ?>
                           <div class="inp-radio">
                              <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_social_category_master_id_pk']?>"
                                 <?php 
                                    if($scl_dtl_val==$value['cm_social_category_master_id_pk'])
                                    {
                                       echo "checked='checked'"; 
                                    }
                                    else
                                    {
                                       echo '';
                                    }
                                    ?>  
                                 name="cp_one_social_category" >&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                           </div>
                           <?php 
                              } 
                              ?>
                           <?php echo form_error('cp_one_social_category');?>
                        </div>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Religion</label>
                     <div class="col-sm-9">
                        <div class="des-loc">
                           <?php
                              $cp_one_religion_val= '';
                              if(set_value('cp_one_religion'))
                              {
                                 $cp_one_religion_val= set_value('cp_one_religion');
                              }
                              elseif($incident_edit_details[0]['cp_one_religion'])
                              {
                                 $cp_one_religion_val= $incident_edit_details[0]['cp_one_religion'];
                              }
                              else
                              {
                                 $cp_one_religion_val= '';
                              }
                              foreach($religion_details as $value)
                              {
                              ?>
                           <div class="inp-radio">
                              <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_religion_master_id_pk']?>"
                                 <?php 
                                    if($cp_one_religion_val==$value['cm_religion_master_id_pk'])
                                    {
                                       echo "checked='checked'"; 
                                    }
                                    else
                                    {
                                       echo '';
                                    }
                                    ?>  
                                 name="cp_one_religion" >&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                           </div>
                           <?php } ?>
                           <?php echo form_error('cp_one_religion');?>
                        </div>
                     </div>
                  </div>
               </div>
               <hr style="border: 1px solid gray;">
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Date of Birth <font color="red">*</font></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control datepicker" data-date-end-date="0d" id="cp_one_dob" placeholder="Date of Birth" autocomplete="off" name="cp_one_dob" value="<?php if($incident_edit_details[0]['cp_one_dob'] != ''){?><?php echo date('d/m/Y', strtotime($incident_edit_details[0]['cp_one_dob'])); ?><?php } ?><?php if(set_value('cp_one_dob') != ''){?><?php echo set_value('cp_one_dob'); } ?>" style="background-color: white;" readonly tabindex="7">  
                        <small class="notification_msg" id="female_dob_msg" style="color: red;"></small>
                        <?php echo form_error('cp_one_dob');?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Age <font color="red">*</font></label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" name="cp_one_age" id="cp_one_age" placeholder="Age" autocomplete="off" value="<?php if(set_value('cp_one_age') != ''){?><?php echo set_value('cp_one_age'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_age']?><?php } ?>" readonly style="cursor: not-allowed;">
                        <?php echo form_error('cp_one_age');?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">DOB document available?</label>
                     <div class="col-sm-9">
                        <label class="radio-inline"><input type="radio" name="cp_one_dob_document_available" class="dob_document_cp_one" value="1" <?php if(isset($_POST['cp_one_dob_document_available'])){?><?php echo set_radio('cp_one_dob_document_available', '1'); ?><?php }else{?><?php echo ($incident_edit_details[0]['cp_one_dob_document_available']== '1') ?  "checked" : "" ;  ?><?php } ?>>&nbsp;Yes</label>&nbsp;&nbsp;

                        <label class="radio-inline"><input type="radio" name="cp_one_dob_document_available" class="dob_document_cp_one" value="2" <?php if(isset($_POST['cp_one_dob_document_available'])){?><?php echo set_radio('cp_one_dob_document_available', '2'); ?><?php }else{?><?php echo ($incident_edit_details[0]['cp_one_dob_document_available']== '2') ?  "checked" : "" ;  ?><?php } ?>>&nbsp;No</label>&nbsp;&nbsp;
                        <?php echo form_error('cp_one_dob_document_available');?>
                     </div>
                  </div>
               </div>
               <div class="card-body" id="dob_document_available_cp_one">
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Document ID</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Document ID" name="cp_one_dob_document_id" id="cp_one_dob_document_id" autocomplete="off" value="<?php echo $incident_edit_details[0]['cp_one_dob_document_id']; ?>" <?php echo set_value('cp_one_dob_document_id'); ?>>
                        <?php echo form_error('cp_one_dob_document_id');?>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Document Type</label>
                     <div class="col-sm-9">
                        <div class="des-loc">
                           <?php
                              $cp_one_dob_document_type_val= '';
                              if(set_value('cp_one_dob_document_type'))
                              {
                                 $cp_one_dob_document_type_val= set_value('cp_one_dob_document_type');
                              }
                              elseif($incident_edit_details[0]['cp_one_dob_document_type'])
                              {
                                 $cp_one_dob_document_type_val= $incident_edit_details[0]['cp_one_dob_document_type'];
                              }
                              else
                              {
                                 $cp_one_dob_document_type_val= '';
                              }
                              foreach($document_type_details as $value)
                              {
                                 ?>
                           <div class="inp-radio">
                              <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                 <?php 
                                    if($cp_one_dob_document_type_val==$value['cm_document_type_master_master_id_pk'])
                                    {
                                       echo "checked='checked'"; 
                                    }
                                    else
                                    {
                                       echo '';
                                    }
                                    ?>  
                                 name="cp_one_dob_document_type">&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                           </div>
                           <?php } ?>
                           <?php echo form_error('cp_one_dob_document_type');?> 
                        </div>
                     </div>
                  </div>
               </div>
               <hr style="border: 1px solid gray;">
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Identity document available?</label>
                     <div class="col-sm-9">
                        <label class="radio-inline"><input type="radio" name="cp_one_identity_document_available" class="identity_document_cp_one" value="1" <?php echo set_radio('cp_one_identity_document_available', '1'); ?><?php echo ($incident_edit_details[0]['cp_one_identity_document_available']== '1') ?  "checked" : "" ;  ?>>&nbsp;Yes</label>&nbsp;&nbsp;
                        <label class="radio-inline"><input type="radio" name="cp_one_identity_document_available" class="identity_document_cp_one" value="2" <?php echo set_radio('cp_one_identity_document_available', '2'); ?><?php echo ($incident_edit_details[0]['cp_one_identity_document_available']== '2') ?  "checked" : "" ;  ?>>&nbsp;No</label>&nbsp;&nbsp;
                        <?php echo form_error('cp_one_identity_document_available');?>  
                     </div>
                  </div>
               </div>
               <div class="card-body" id="identity_document_available_cp_one" <?php if($incident_edit_details[0]['cp_one_identity_document_available'] == 1){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Document ID</label>
                     <div class="col-sm-6">
                        <input type="text" class="form-control" placeholder="Document ID" name="cp_one_identity_document_id" value="<?php if(set_value('cp_one_identity_document_id') != ''){?><?php echo set_value('cp_one_identity_document_id'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_identity_document_id']?><?php } ?>">
                        <?php echo form_error('cp_one_identity_document_id');?>  
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Document Type</label>
                     <div class="col-sm-9">
                        <div class="des-loc">
                           <?php
                              $cp_one_idty_document_type_val= '';
                              if(set_value('cp_one_identity_document_type'))
                              {
                                 $cp_one_idty_document_type_val= set_value('cp_one_identity_document_type');
                              }
                              elseif($incident_edit_details[0]['cp_one_identity_document_type'])
                              {
                                 $cp_one_idty_document_type_val= $incident_edit_details[0]['cp_one_identity_document_type'];
                              }
                              else
                              {
                                 $cp_one_idty_document_type_val= '';
                              }
                              foreach($document_type_details as $value){
                              ?>
                           <div class="inp-radio">
                              <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                 <?php 
                                    if($cp_one_idty_document_type_val==$value['cm_document_type_master_master_id_pk'])
                                    {
                                       echo "checked='checked'"; 
                                    }
                                    else
                                    {
                                       echo '';
                                    }
                                    ?>  
                                 name="cp_one_identity_document_type">&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                           </div>
                           <?php } ?>
                           <?php echo form_error('cp_one_identity_document_type');?>
                        </div>
                     </div>
                  </div>
               </div>
               <hr style="border: 1px solid gray;">
               <div class="card-body">
                  <div class="form-group row">
                     <label class="col-sm-3 col-form-label">Highest Educational Attainment</label>
                     <div class="col-sm-9">
                        <div class="des-loc">
                           <?php
                              $cp_one_highest_educational_attainment_val= '';
                              if(set_value('cp_one_highest_educational_attainment'))
                              {
                                 $cp_one_highest_educational_attainment_val= set_value('cp_one_highest_educational_attainment');
                              }
                              elseif($incident_edit_details[0]['cp_one_highest_educational_attainment'])
                              {
                                 $cp_one_highest_educational_attainment_val= $incident_edit_details[0]['cp_one_highest_educational_attainment'];
                              }
                              else
                              {
                                 $cp_one_highest_educational_attainment_val= '';
                              }
                              foreach($highest_education_details as $value){
                              ?>
                           <div class="inp-radio">
                              <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_highest_educational_attainment_master_id_pk']?>"
                                 <?php 
                                    if($cp_one_highest_educational_attainment_val==$value['cm_highest_educational_attainment_master_id_pk'])
                                    {
                                        echo "checked='checked'"; 
                                    }
                                    else
                                    {
                                        echo '';
                                    }
                                    ?>  
                                 name="cp_one_highest_educational_attainment">&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                           </div>
                           <?php } ?>                               
                           <?php echo form_error('cp_one_highest_educational_attainment');?>
                        </div>
                     </div>
                  </div>
               </div>
               <hr style="border: 1px solid gray;">
               <div class="form-group">
                  <div class="box-body">
                     <div class="row">
                        <div class="col-sm-12">
                           <table class="table table-bordered" id="documents_collected_table_field">
                              <tr style="background-color: gray; color: #FFFFFF;">
                                 <th colspan="2" style="text-align: center;">Father of Contracting Party 1</th>
                                 <th style="text-align: center;">Mother of Contracting Party 1</th>
                              </tr>
                              <tr>
                                 <td style="text-align: left; font-weight: bold;">Name</td>
                                 <td>
                                    <input type="text" class="form-control" name="cp_one_father_name" value="<?php if(set_value('cp_one_father_name') != ''){?><?php echo set_value('cp_one_father_name'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_father_name']?><?php } ?>" onkeypress="return CP_One_Father_Name_Validate(event);">  
                                    <span id="cp_one_father_name_lbl_error" style="color: red;float: left;"></span> 
                                    <?php echo form_error('cp_one_father_name');?> 
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="cp_one_mother_name" value="<?php if(set_value('cp_one_mother_name') != ''){?><?php echo set_value('cp_one_mother_name'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_mother_name']?><?php } ?>" onkeypress="return CP_One_Mother_Name_Validate(event);">
                                    <span id="cp_one_mother_name_lbl_error" style="color: red;float: left;"></span>  
                                    <?php echo form_error('cp_one_mother_name');?> 
                                 </td>
                              </tr>
                              <tr>
                                 <td style="text-align: left; font-weight: bold;">Phone No</td>
                                 <td>
                                    <input type="text" class="form-control mobile" name="cp_one_father_mobile_no" id="cp_one_father_mobile_no" maxlength="10" value="<?php if(set_value('cp_one_father_mobile_no') != ''){?><?php echo set_value('cp_one_father_mobile_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_father_mobile_no']?><?php } ?>" onkeyup="cp_one_father_mobile_number_validation()" onpaste="return false">  
                                    <span id="cp_one_father_mobile_lbl_error" style="color: red;float: left;"></span> 
                                 </td>
                                 <td>
                                    <input type="text" class="form-control cp_one_mother_mobile_no" name="cp_one_mother_mobile_no" id="cp_one_mother_mobile_no" maxlength="10" value="<?php if(set_value('cp_one_mother_mobile_no') != ''){?><?php echo set_value('cp_one_mother_mobile_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_mother_mobile_no']?><?php } ?>" onkeyup="cp_one_mother_mobile_number_validation()" onpaste="return false">  
                                    <span id="cp_one_mother_mobile_lbl_error" style="color: red;float: left;"></span> 
                                 </td>
                              </tr>
                              <tr>
                                 <td style="text-align: left; font-weight: bold;">ID</td>
                                 <td>
                                    <input type="text" class="form-control" name="cp_one_father_id" value="<?php if(set_value('cp_one_father_id') != ''){?><?php echo set_value('cp_one_father_id'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_father_id']?><?php } ?>">  
                                    <?php echo form_error('cp_one_father_id');?>
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" name="cp_one_mother_id" value="<?php if(set_value('cp_one_mother_id') != ''){?><?php echo set_value('cp_one_mother_id'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_one_mother_id']?><?php } ?>">  
                                    <?php echo form_error('cp_one_mother_id');?>
                                 </td>
                              </tr>
                              <tr>
                                 <td style="text-align: left; font-weight: bold;">ID Type</td>
                                 <td>
                                    <?php
                                       $cp1_father_dtl_val= '';
                                       if(set_value('cp_one_father_id_type'))
                                       {
                                          $cp1_father_dtl_val= set_value('cp_one_father_id_type');
                                       }
                                       elseif($incident_edit_details[0]['cp_one_father_id_type'])
                                       {
                                          $cp1_father_dtl_val= $incident_edit_details[0]['cp_one_father_id_type'];
                                       }
                                       else
                                       {
                                          $cp1_father_dtl_val= '';
                                       }
                                       ?>
                                    <select class="form-control" name="cp_one_father_id_type">
                                       <option value="0" selected="" disabled="">--Select--</option>
                                       <?php 
                                          foreach($document_type_details as $value)
                                          {
                                             ?>
                                       <option value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                          <?php 
                                             if($value['cm_document_type_master_master_id_pk']==$cp1_father_dtl_val) 
                                             {
                                                echo 'selected="selected"';
                                             }
                                             else 
                                             {
                                                echo '';
                                             }
                                             ?>
                                          >
                                          <?php echo $value['description']?>
                                       </option>
                                       <?php 
                                          } 
                                          ?>
                                    </select>
                                    <?php echo form_error('cp_one_father_id_type');?>
                                 </td>
                                 <td>
                                    <?php
                                       $cp1_mother_dtl_val= '';
                                       if(set_value('cp_one_mother_id_type'))
                                       {
                                          $cp1_mother_dtl_val= set_value('cp_one_mother_id_type');
                                       }
                                       elseif($incident_edit_details[0]['cp_one_mother_id_type'])
                                       {
                                          $cp1_mother_dtl_val= $incident_edit_details[0]['cp_one_mother_id_type'];
                                       }
                                       else
                                       {
                                          $cp1_mother_dtl_val= '';
                                       }
                                       ?>
                                    <select class="form-control" name="cp_one_mother_id_type">
                                       <option value="0" selected="" disabled="">--Select--</option>
                                       <?php 
                                          foreach($document_type_details as $value)
                                          {
                                             ?>
                                       <option value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                          <?php 
                                             if($value['cm_document_type_master_master_id_pk']==$cp1_mother_dtl_val) 
                                             {
                                                echo 'selected="selected"';
                                             }
                                             else 
                                             {
                                                echo '';
                                             }
                                             ?>
                                          >
                                          <?php echo $value['description']?>
                                       </option>
                                       <?php 
                                          } 
                                          ?>
                                    </select>
                                    <?php echo form_error('cp_one_mother_id_type');?>
                                 </td>
                              </tr>
                              <tr>
                                 <td style="text-align: left; font-weight: bold;">Alive</td>
                                 <td style="text-align: left;">
                                    <?php
                                       $alive_val= '';
                                       if(set_value('cp_one_father_alive'))
                                       {
                                          $alive_val= set_value('cp_one_father_alive');
                                       }
                                       elseif($incident_edit_details[0]['cp_one_father_alive'])
                                       {
                                          $alive_val= $incident_edit_details[0]['cp_one_father_alive'];
                                       }
                                       else
                                       {
                                          $alive_val= '';
                                       }
                                       ?>
                                    <label class="radio-inline"><input type="radio" value="1" name="cp_one_father_alive"
                                       <?php 
                                          if($alive_val==1) 
                                             {
                                             echo 'checked="checked"';
                                             }
                                             else 
                                             {
                                             echo '';
                                             }
                                          ?>
                                       >&nbsp;Yes</label>&nbsp;&nbsp;
                                    <label class="radio-inline"><input type="radio" value="2" name="cp_one_father_alive"
                                       <?php 
                                          if($alive_val==2) 
                                             {
                                                echo 'checked="checked"';
                                             }
                                             else 
                                             {
                                                echo '';
                                             }
                                          ?>
                                       >&nbsp;No</label>&nbsp;&nbsp;
                                    <?php echo form_error('cp_one_father_alive');?>
                                 </td>
                                 <td style="text-align: left;">
                                    <?php
                                       $cp_one_mother_alive_val = '';
                                       if(set_value('cp_one_mother_alive')!='')
                                       {
                                          $cp_one_mother_alive_val=set_value('cp_one_mother_alive');
                                       }
                                       elseif($incident_edit_details[0]['cp_one_mother_alive'])
                                       {
                                          $cp_one_mother_alive_val=$incident_edit_details[0]['cp_one_mother_alive'];
                                       }
                                       else
                                       {
                                          $cp_one_mother_alive_val= '';
                                       }
                                       ?>
                                    <label class="radio-inline"><input type="radio" value="1" name="cp_one_mother_alive"
                                       <?php 
                                          if($cp_one_mother_alive_val==1) 
                                             {
                                             echo 'checked="checked"';
                                             }
                                             else 
                                             {
                                             echo '';
                                             }
                                          ?>
                                       >&nbsp;Yes</label>&nbsp;&nbsp;
                                    <label class="radio-inline"><input type="radio" value="2" name="cp_one_mother_alive"
                                       <?php 
                                          if($cp_one_mother_alive_val==2) 
                                             {
                                             echo 'checked="checked"';
                                             }
                                             else 
                                             {
                                             echo '';
                                             }
                                          ?>
                                       >&nbsp;No</label>&nbsp;&nbsp;
                                    <?php echo form_error('cp_one_mother_alive');?>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="menu2" class="tab-pane fade">
               <div class="form-btn">
                  <ul>
                     <li>
                        <button type="button" class="btn btn-danger cancel_incident" onClick="Cancel_Incident()"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                     </li>
                     <li>
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Update</button>
                     </li>
                     <!-- <button><a data-toggle="tab" id="fifth_prev_step" href="#menu1" class="btn btn-primary next_step"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</a></button> -->
                  </ul>
               </div>
               <div class="card-body">
                  <div class="form-group row">
                     <div class="col-sm-12">
                        <label class="badge badge-primary text-wrap" style="width: 20rem; font-size:medium;">Contracting Party Two</label>  
                     </div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Is Available? <font color="red">*</font></label>
                  <div class="col-sm-9">
                    <label class="radio-inline"><input type="radio" name="cp_two_is_available" class="cp_two_is_available_button" value="1" <?php if(isset($_POST['cp_two_is_available'])){?><?php echo set_radio('cp_two_is_available', '1'); ?><?php }else{?><?php echo ($incident_edit_details[0]['cp_two_is_available']== '1') ?  "checked" : "" ;  ?><?php } ?>>&nbsp;Yes</label>&nbsp;&nbsp;

                    <label class="radio-inline"><input type="radio" name="cp_two_is_available" class="cp_two_is_available_button" value="2" <?php if(isset($_POST['cp_two_is_available'])){?><?php echo set_radio('cp_two_is_available', '2'); ?><?php }else{?><?php echo ($incident_edit_details[0]['cp_two_is_available']== '2') ?  "checked" : "" ;  ?><?php } ?>>&nbsp;No</label>&nbsp;&nbsp;

                    <?php echo form_error('cp_two_is_available');?> 
                  </div>
                </div>
               <?php
                  $cp_two_name = $incident_edit_details[0]['cp_two_name'];
                  $cp_two_name_array = explode(" ", $cp_two_name);
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
               <div id="cp_two_hide_show_div">
                  <div class="card-body">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Name <font color="red">*</font></label>
                        <div class="col-sm-3">
                           <input type="text" class="form-control" placeholder="First Name" name="cp_two_f_name" id="cp_two_f_name" autocomplete="off" value="<?php if(set_value('cp_two_f_name') != ''){?><?php echo set_value('cp_two_f_name'); ?><?php }if($incident_edit_details[0]['cp_two_name']!=''){?><?php echo $cp_two_f_name; ?><?php } ?>" onkeypress="return CP_Two_First_Name_Validate(event);">  
                           <span id="cp_two_first_name_lbl_error" style="color: red"></span>
                           <?php echo form_error('cp_two_f_name');?>  
                        </div>
                        <div class="col-sm-3">
                           <input type="text" class="form-control" placeholder="Middle Name" id="cp_two_m_name" name="cp_two_m_name" autocomplete="off" value="<?php if(set_value('cp_two_m_name') != ''){?><?php echo set_value('cp_two_m_name'); ?><?php }if($incident_edit_details[0]['cp_two_name']!=''){?><?php echo $cp_two_m_name; ?><?php } ?>" onkeypress="return CP_Two_Middle_Name_Validate(event);">  
                           <span id="cp_two_middle_name_lbl_error" style="color: red"></span>
                        </div>
                        <div class="col-sm-3">
                           <input type="text" class="form-control" placeholder="Last Name" id="cp_two_l_name" name="cp_two_l_name" autocomplete="off" value="<?php if(set_value('cp_two_l_name') != ''){?><?php echo set_value('cp_two_l_name'); ?><?php }if($incident_edit_details[0]['cp_two_name']!=''){?><?php echo $cp_two_l_name; ?><?php } ?>" onkeypress="return CP_Two_Last_Name_Validate(event);"> 
                           <span id="cp_two_last_name_lbl_error" style="color: red"></span> 
                           <?php echo form_error('cp_two_l_name');?>  
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Street / Landmark</label>
                        <div class="col-sm-9">
                           <input type="text" placeholder="Street / Landmark" class="form-control" id="cp_two_street_landmark" autocomplete="off" name="cp_two_street_landmark" value="<?php if($incident_edit_details[0]['cp_two_street_landmark']!=''){?><?php echo $incident_edit_details[0]['cp_two_street_landmark']?><?php } else if(set_value('cp_two_street_landmark') != ''){?><?php echo set_value('cp_two_street_landmark');} ?>" >
                           <?php echo form_error('cp_two_street_landmark');?>  
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">State <font color="red">*</font></label>
                        <div class="col-sm-6">
                           <select class="form-control cp_two_state_box" id="cp_two_state" autocomplete="off" name="cp_two_state">
                             <option value="0" disabled selected>--Select State--</option>
                             <?php foreach($state as $value){?>
                             <option value="<?php echo $value['state_id_pk']; ?>" <?php echo set_select('cp_two_state', $value['state_id_pk'], False); ?> <?php if($incident_edit_details[0]['cp_two_state'] == $value['state_id_pk']){ echo "selected"; }?>><?php echo $value['state_name']; ?></option>
                             <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div id="cp_two_address_div_one">
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">District <font color="red">*</font></label>
                           <div class="col-sm-6">
                              <select class="form-control district" name="cp_two_district" id="cp_two_district">
                                 <option disabled="" selected="">--Please Select District--</option>
                                 <?php foreach($CP_Two_District_Details as $CP_Two_District_Value){ ?>
                                 <option value="<?php echo $CP_Two_District_Value['district_id_pk'];?>" <?php echo set_select('cp_two_district', $CP_Two_District_Value['district_id_pk']); ?> <?php if($incident_edit_details[0]['cp_two_district'] == $CP_Two_District_Value['district_id_pk']){ echo "selected"; } ?>><?php echo $CP_Two_District_Value['district_name'];?></option> 
                                 <?php } ?>
                              </select>
                              <?php echo form_error('cp_two_district'); ?>  
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Block / Municipality <font color="red">*</font></label>
                           <div class="col-sm-6">
                              <select class="form-control" name="cp_two_block" id="cp_two_block">
                                 <option disabled="" selected="" value="">--Please Select District First--</option>
                                 <?php foreach($cptwoBlock as $incidentBlockValue){ ?>
                                 <option value="<?php echo $incidentBlockValue['block_id_pk'];?>" <?php echo set_select('cp_two_block', $incidentBlockValue['block_id_pk']); ?> <?php if($incidentBlockValue['block_id_pk'] == $incident_edit_details[0]['cp_two_block']){ echo "selected"; }?>><?php echo $incidentBlockValue['block_name'];?></option>
                                 <?php } ?>
                              </select>
                              <?php echo form_error('cp_two_block'); ?>  
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 col-form-label">Ward / GP <font color="red">*</font></label>
                           <div class="col-sm-6">
                              <select class="form-control" id="cp_two_ward_gp" autocomplete="off" name="cp_two_ward_gp">
                                <option value="0" disabled selected>--Select SD/Block First--</option>
                                <?php if(!empty($Cp_Two_Ward_Gp_Block)){?>
                                <?php if($Cp_Two_Ward_Gp_Block->rural_urban == 'U'){?>
                                  <?php foreach($Cp_Two_Ward as $Cp_Two_Ward_Value){ ?>
                                  <option value="<?php echo $Cp_Two_Ward_Value['ward_id_pk'];?>" <?php echo set_select('cp_two_ward_gp', $Cp_Two_Ward_Value['ward_id_pk']); ?> <?php if($incident_edit_details[0]['cp_two_ward_gp'] == $Cp_Two_Ward_Value['ward_id_pk']){ echo "selected"; } ?>><?php echo $Cp_Two_Ward_Value['ward_no'];?></option> 
                                  <?php } ?>
                                <?php }else{?>
                                  <?php foreach($Cp_Two_Gp as $Cp_Two_GP_Value){ ?>
                                  <option value="<?php echo $Cp_Two_GP_Value['gp_id_pk'];?>" <?php echo set_select('cp_two_ward_gp', $Cp_Two_GP_Value['gp_id_pk']); ?> <?php if($incident_edit_details[0]['cp_two_ward_gp'] == $Cp_Two_GP_Value['gp_id_pk']){ echo "selected"; } ?>><?php echo $Cp_Two_GP_Value['gp_name'];?></option> 
                                  <?php } ?>
                                <?php } } ?>
                              </select>
                              <?php echo form_error('cp_two_ward_gp');?> 
                           </div>
                        </div>
                     </div>
                     <div id="cp_two_address_div_two">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Address <font color="red">*</font></label>
                          <div class="col-sm-6">
                            <textarea class="form-control" name="cp_two_address" id="cp_two_address" rows="3" placeholder="Address"><?php if(set_value('cp_two_address') != ''){?><?php echo set_value('cp_two_address'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_address']?><?php } ?></textarea>
                            <?php echo form_error('cp_two_address'); ?>
                          </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pin Code <font color="red">*</font></label>
                        <div class="col-sm-6">
                           <input type="text" name="cp_two_pin_code" id="cp_two_pin_code" class="form-control cp_two_pin_code_vaidate" value="<?php if(set_value('cp_two_pin_code') != ''){?><?php echo set_value('cp_two_pin_code'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_pin_code']?><?php } ?>" placeholder="Pin Code" maxlength="6" onpaste="return false">
                           <span id="cp_two_pin_code_lbl_error" style="color: red;"></span>
                           <?php echo form_error('cp_two_pin_code'); ?>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Police Station <font color="red">*</font></label>
                        <div class="col-sm-6">
                           <input type="text" class="form-control" placeholder="Police Station" name="cp_two_police_station" id="cp_two_police_station" autocomplete="off" value="<?php if(set_value('cp_two_police_station') != ''){?><?php echo set_value('cp_two_police_station'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_police_station']?><?php } ?>">
                           <?php echo form_error('cp_two_police_station');?>  
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Phone No <font color="red">*</font></label>
                        <div class="col-sm-6">
                           <input type="text" name="cp_two_phone_no" id="cp_two_phone_no" class="form-control cp_two_phone_no_vaidate" value="<?php if(set_value('cp_two_phone_no') != ''){?><?php echo set_value('cp_two_phone_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_phone_no']?><?php } ?>" placeholder="Phone No" maxlength="10" onpaste="return false">
                           <span id="cp_two_phone_no_lbl_error" style="color: red;"></span>
                           <?php echo form_error('cp_two_phone_no'); ?>
                        </div>
                     </div>
                  </div>
                  <hr style="border: 1px solid gray;">
                  <div class="card-body">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Gender <font color="red">*</font></label>
                        <div class="col-sm-9">
                           <div class="des-loc">
                              <?php
                                 $gender_details_val= '';
                                 if(set_value('cp_two_gender'))
                                 {  
                                    $gender_details_val= set_value('cp_two_gender');
                                 }
                                 elseif($incident_edit_details[0]['cp_two_gender'])
                                 {
                                    $gender_details_val= $incident_edit_details[0]['cp_two_gender'];
                                 }
                                 else
                                 {
                                    $gender_details_val= '';
                                 }
                                 foreach($gender_details as $value)
                                 {
                                 ?>
                              <div class="inp-radio">
                                 <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_gender_master_id_pk']?>"
                                    <?php 
                                       if($gender_details_val==$value['cm_gender_master_id_pk'])
                                       {
                                         echo "checked='checked'"; 
                                       }
                                       else
                                       {
                                         echo '';
                                       }
                                       ?>  
                                    class="cp_two_gender_val" name="cp_two_gender">&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                              </div>
                              <?php } ?>
                              <?php echo form_error('cp_two_gender');?>
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Social Category</label>
                        <div class="col-sm-9">
                           <div class="des-loc">
                              <?php
                                 $sc2_dtl_val= '';
                                 if(set_value('cp_two_social_category'))
                                 {
                                   $sc2_dtl_val= set_value('cp_two_social_category');
                                 }
                                 elseif($incident_edit_details[0]['cp_two_social_category'])
                                 {
                                   $sc2_dtl_val= $incident_edit_details[0]['cp_two_social_category'];
                                 }
                                 else
                                 {
                                   $sc2_dtl_val= '';
                                 }
                                 foreach($social_category_details as $value)
                                 {
                                 ?>
                              <div class="inp-radio">
                                 <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_social_category_master_id_pk']?>"
                                    <?php 
                                       if($sc2_dtl_val==$value['cm_social_category_master_id_pk'])
                                       {
                                          echo "checked='checked'"; 
                                       }
                                       else
                                       {
                                          echo '';
                                       }
                                       ?>  
                                    name="cp_two_social_category" >&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                              </div>
                              <?php } ?>
                              <?php echo form_error('cp_two_social_category');?> 
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Religion</label>
                        <div class="col-sm-9">
                           <div class="des-loc">
                              <?php
                                 $religion_details_val= '';
                                 if(set_value('cp_two_religion'))
                                 {
                                    $religion_details_val= set_value('cp_two_religion');
                                 }
                                 elseif($incident_edit_details[0]['cp_two_religion'])
                                 {
                                    $religion_details_val= $incident_edit_details[0]['cp_two_religion'];
                                 }
                                 else
                                 {
                                    $religion_details_val= '';
                                 }
                                 foreach($religion_details as $value)
                                 {
                                    ?>
                              <div class="inp-radio">
                                 <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_religion_master_id_pk']?>"
                                    <?php 
                                       if($religion_details_val==$value['cm_religion_master_id_pk'])
                                       {
                                          echo "checked='checked'"; 
                                       }
                                       else
                                       {
                                          echo '';
                                       }
                                       ?>  
                                    name="cp_two_religion" >&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                              </div>
                              <?php } ?>
                              <?php echo form_error('cp_two_religion');?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr style="border: 1px solid gray;">
                  <div class="card-body">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Date of Birth <font color="red">*</font></label>
                        <div class="col-sm-6">

                           <input type="text" class="form-control datepicker" data-date-end-date="0d" id="cp_two_dob" placeholder="Date of Birth" autocomplete="off" name="cp_two_dob" value="<?php if($incident_edit_details[0]['cp_two_dob'] != ''){?><?php echo date('d/m/Y', strtotime($incident_edit_details[0]['cp_two_dob'])); ?><?php } ?><?php if(set_value('cp_two_dob') != ''){?><?php echo set_value('cp_two_dob'); }?>" style="background-color: white;" readonly tabindex="7"> 
                           <small class="notification_msg" id="female_dob_msg" style="color: red;"></small>
                           <?php echo form_error('cp_two_dob');?>  
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Age <font color="red">*</font></label>
                        <div class="col-sm-6">
                           <input type="text" class="form-control" name="cp_two_age" id="cp_two_age" placeholder="Age" autocomplete="off" value="<?php if(set_value('cp_two_age') != ''){?><?php echo set_value('cp_two_age'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_age']?><?php } ?>" readonly style="cursor: not-allowed;">
                           <?php echo form_error('cp_two_age');?>  
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">DOB document available?</label>
                        <div class="col-sm-6">
                           <label class="radio-inline"><input type="radio" name="cp_two_dob_document_available" class="dob_document_cp_two" value="1" <?php if(isset($_POST['cp_two_dob_document_available'])){?><?php echo set_radio('cp_two_dob_document_available', '1'); ?><?php }else{?><?php echo ($incident_edit_details[0]['cp_two_dob_document_available']== '1') ?  "checked" : "" ;  ?><?php } ?>>&nbsp;Yes</label>&nbsp;&nbsp;

                           <label class="radio-inline"><input type="radio" name="cp_two_dob_document_available" class="dob_document_cp_two" value="2" <?php if(isset($_POST['cp_two_dob_document_available'])){?><?php echo set_radio('cp_two_dob_document_available', '2'); ?><?php }else{?><?php echo ($incident_edit_details[0]['cp_two_dob_document_available']== '2') ?  "checked" : "" ;  ?><?php } ?>>&nbsp;No</label>&nbsp;&nbsp;
                           <?php echo form_error('cp_two_dob_document_available');?> 
                        </div>
                     </div>
                  </div>
                  <div class="card-body" id="dob_document_available_cp_two" <?php if($incident_edit_details[0]['cp_two_dob_document_available'] == 1){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Document ID</label>
                        <div class="col-sm-6">
                           <input type="text" class="form-control" placeholder="Document ID" name="cp_two_dob_document_id" id="cp_two_dob_document_id" autocomplete="off" maxlength="10" value="<?php echo set_value('cp_two_dob_document_id'); ?> <?php echo $incident_edit_details[0]['cp_two_dob_document_id']; ?>">
                           <?php echo form_error('cp_two_dob_document_id');?>  
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Document Type</label>
                        <div class="col-sm-9">
                           <div class="des-loc">
                              <?php
                                 $document_type_details_val= '';
                                 if(set_value('cp_two_dob_document_type'))
                                 {
                                    $document_type_details_val= set_value('cp_two_dob_document_type');
                                 }
                                 elseif($incident_edit_details[0]['cp_two_dob_document_type'])
                                 {
                                    $document_type_details_val= $incident_edit_details[0]['cp_two_dob_document_type'];
                                 }
                                 else
                                 {
                                    $document_type_details_val= '';
                                 }
                                 foreach($document_type_details as $value)
                                 {
                                    ?>
                              <div class="inp-radio">
                                 <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                    <?php 
                                       if($document_type_details_val==$value['cm_document_type_master_master_id_pk'])
                                       {
                                          echo "checked='checked'"; 
                                       }
                                       else
                                       {
                                          echo '';
                                       }
                                       ?>  
                                    name="cp_two_dob_document_type" >&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                              </div>
                              <?php } ?>
                              <?php echo form_error('cp_two_dob_document_type');?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr style="border: 1px solid gray;">
                  <div class="card-body">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Identity document available?</label>
                        <div class="col-sm-6">
                           <label class="radio-inline"><input type="radio" name="cp_two_identity_document_available" class="identity_document_cp_two" value="1" <?php echo set_radio('cp_two_identity_document_available', '1'); ?> <?php echo ($incident_edit_details[0]['cp_two_identity_document_available']== '1') ?  "checked" : "" ;  ?>>&nbsp;Yes</label>&nbsp;&nbsp;
                           <label class="radio-inline"><input type="radio" name="cp_two_identity_document_available" class="identity_document_cp_two" value="2" <?php echo set_radio('cp_two_identity_document_available', '2'); ?> <?php echo ($incident_edit_details[0]['cp_two_identity_document_available']== '2') ?  "checked" : "" ;  ?>>&nbsp;No</label>&nbsp;&nbsp;
                           <?php echo form_error('cp_two_identity_document_available');?> 
                        </div>
                     </div>
                  </div>
                  <div class="card-body" id="identity_document_available_cp_two" <?php if($incident_edit_details[0]['cp_two_identity_document_available'] == 1){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Document ID</label>
                        <div class="col-sm-6">
                           <input type="text" class="form-control" placeholder="Document ID" name="cp_two_identity_document_id" autocomplete="off" maxlength="10" value="<?php if(set_value('cp_two_identity_document_id') != ''){?><?php echo set_value('cp_two_identity_document_id'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_identity_document_id']?><?php } ?>">
                           <?php echo form_error('cp_two_identity_document_id');?> 
                        </div>
                     </div>
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Document Type</label>
                        <div class="col-sm-9">
                           <div class="des-loc">
                              <?php
                                 $cp_two_identity_document_type_val= '';
                                 if(set_value('cp_two_identity_document_type'))
                                 {
                                    $cp_two_identity_document_type_val= set_value('cp_two_identity_document_type');
                                 }
                                 elseif($incident_edit_details[0]['cp_two_identity_document_type'])
                                 {
                                    $cp_two_identity_document_type_val= $incident_edit_details[0]['cp_two_identity_document_type'];
                                 }
                                 else
                                 {
                                    $cp_two_identity_document_type_val= '';
                                 }
                                 foreach($document_type_details as $value)
                                 {
                                    ?>
                              <div class="inp-radio">
                                 <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                    <?php 
                                       if($cp_two_identity_document_type_val==$value['cm_document_type_master_master_id_pk'])
                                       {
                                          echo "checked='checked'"; 
                                       }
                                       else
                                       {
                                          echo '';
                                       }
                                       ?>  
                                    name="cp_two_identity_document_type">&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                              </div>
                              <?php } ?> 
                              <?php echo form_error('cp_two_identity_document_type');?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr style="border: 1px solid gray;">
                  <div class="card-body">
                     <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Highest Educational Attainment</label>
                        <div class="col-sm-9">
                           <div class="des-loc">
                              <?php
                                 $cp_two_highest_educational_attainment_val= '';
                                 if(set_value('cp_two_highest_educational_attainment'))
                                 {
                                    $cp_two_highest_educational_attainment_val= set_value('cp_two_highest_educational_attainment');
                                 }
                                 elseif($incident_edit_details[0]['cp_two_highest_educational_attainment'])
                                 {
                                    $cp_two_highest_educational_attainment_val= $incident_edit_details[0]['cp_two_highest_educational_attainment'];
                                 }
                                 else
                                 {
                                    $cp_two_highest_educational_attainment_val= '';
                                 }
                                 foreach($highest_education_details as $value)
                                 {
                                 ?>
                              <div class="inp-radio">
                                 <label class="radio-inline"><input type="radio" value="<?php echo $value['cm_highest_educational_attainment_master_id_pk']?>"
                                    <?php 
                                       if($cp_two_highest_educational_attainment_val==$value['cm_highest_educational_attainment_master_id_pk'])
                                       {
                                          echo "checked='checked'"; 
                                       }
                                       else
                                       {
                                          echo '';
                                       }
                                       ?>  
                                    name="cp_two_highest_educational_attainment">&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                              </div>
                              <?php } ?>     
                              <?php echo form_error('cp_two_highest_educational_attainment');?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-sm-12">
                              <table class="table table-bordered" id="documents_collected_table_field">
                                 <tr style="background-color: gray; color: #FFFFFF;">
                                    <th colspan="2" style="text-align: center;">Father of Contracting Party 2</th>
                                    <th style="text-align: center;">Mother of Contracting Party 2</th>
                                 </tr>
                                 <tr>
                                    <td style="text-align: left; font-weight: bold;">Name</td>
                                    <td>
                                       <input type="text" class="form-control" id="cp_two_father_name" name="cp_two_father_name" value="<?php if(set_value ('cp_two_father_name') != ''){?><?php echo set_value('cp_two_father_name'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_father_name']?><?php } ?>" onkeypress="return CP_Two_Father_Name_Validate(event);"> 
                                       <span id="cp_two_father_name_lbl_error" style="color: red;float: left;"></span>
                                       <?php echo form_error('cp_two_father_name');?>   
                                    </td>
                                    <td>
                                       <input type="text" class="form-control" id="cp_two_mother_name" name="cp_two_mother_name" value="<?php if(set_value('cp_two_mother_name') != ''){?><?php echo set_value('cp_two_mother_name'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_mother_name']?><?php } ?>" onkeypress="return CP_Two_Mother_Name_Validate(event);">
                                       <span id="cp_two_mother_name_lbl_error" style="color: red;float: left;"></span> 
                                       <?php echo form_error('cp_two_mother_name');?>   
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="text-align: left; font-weight: bold;">Phone No</td>
                                    <td>
                                       <input type="text" class="form-control" id="cp_two_father_mobile_no" name="cp_two_father_mobile_no" maxlength="10" value="<?php if(set_value('cp_two_father_mobile_no') != ''){?><?php echo set_value('cp_two_father_mobile_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_father_mobile_no']?><?php } ?>" onkeyup="cp_two_father_mobile_number_validation()" onpaste="return false">
                                       <span id="cp_two_father_mobile_lbl_error" style="color: red;float: left;"></span>
                                    </td>
                                    <td>
                                       <input type="text" class="form-control js-input-mobile" id="cp_two_mother_mobile_no" name="cp_two_mother_mobile_no" maxlength="10" value="<?php if(set_value('cp_two_mother_mobile_no') != ''){?><?php echo set_value('cp_two_mother_mobile_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_mother_mobile_no']?><?php } ?>" onkeyup="cp_two_mother_mobile_number_validation()" onpaste="return false">
                                       <span id="cp_two_mother_mobile_lbl_error" style="color: red;float: left;"></span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="text-align: left; font-weight: bold;">ID</td>
                                    <td>
                                       <input type="text" class="form-control" name="cp_two_father_id" value="<?php if(set_value('cp_two_father_id') != ''){?><?php echo set_value('cp_two_father_id'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_father_id']?><?php } ?>">
                                       <?php echo form_error('cp_two_father_id');?>
                                    </td>
                                    <td>
                                       <input type="text" class="form-control" name="cp_two_mother_id" value="<?php if(set_value('cp_two_mother_id') != ''){?><?php echo set_value('cp_two_mother_id'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_mother_id']?><?php } ?>">
                                       <?php echo form_error('cp_two_mother_id');?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="text-align: left; font-weight: bold;">ID Type</td>
                                    <td>
                                       <?php
                                          $cp2_father_dtl_val= '';
                                          if(set_value('cp_two_father_id_type'))
                                          {
                                             $cp2_father_dtl_val= set_value('cp_two_father_id_type');
                                          }
                                          elseif($incident_edit_details[0]['cp_two_father_id_type'])
                                          {
                                             $cp2_father_dtl_val= $incident_edit_details[0]['cp_two_father_id_type'];
                                          }
                                          else
                                          {
                                             $cp2_father_dtl_val= '';
                                          }
                                          ?>
                                       <select class="form-control" name="cp_two_father_id_type">
                                          <option value="0" selected="" disabled="">--Select--</option>
                                          <?php 
                                             foreach($document_type_details as $value)
                                             {
                                                ?>
                                          <option value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                             <?php 
                                                if($value['cm_document_type_master_master_id_pk']==$cp2_father_dtl_val) 
                                                {
                                                   echo 'selected="selected"';
                                                }
                                                else 
                                                {
                                                   echo '';
                                                }
                                                ?>
                                             >
                                             <?php echo $value['description']?>
                                          </option>
                                          <?php 
                                             } 
                                             ?>
                                       </select>
                                       <?php echo form_error('cp_two_father_id_type');?>
                                    </td>
                                    <td>
                                       <?php
                                          $cp2_mother_dtl_val= '';
                                          if(set_value('cp_two_mother_id_type'))
                                          {
                                             $cp2_mother_dtl_val= set_value('cp_two_mother_id_type');
                                          }
                                          elseif($incident_edit_details[0]['cp_two_mother_id_type'])
                                          {
                                             $cp2_mother_dtl_val= $incident_edit_details[0]['cp_two_mother_id_type'];
                                          }
                                          else
                                          {
                                             $cp2_mother_dtl_val= '';
                                          }
                                          ?>
                                       <select class="form-control" name="cp_two_mother_id_type">
                                          <option value="0" selected="" disabled="">--Select--</option>
                                          <?php 
                                             foreach($document_type_details as $value)
                                             {
                                                ?>
                                          <option value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                             <?php 
                                                if($value['cm_document_type_master_master_id_pk']==$cp2_mother_dtl_val) 
                                                {
                                                   echo 'selected="selected"';
                                                }
                                                else 
                                                {
                                                   echo '';
                                                }
                                                ?>
                                             >
                                             <?php echo $value['description']?>
                                          </option>
                                          <?php 
                                             } 
                                             ?>
                                       </select>
                                       <?php echo form_error('cp_two_mother_id_type');?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td style="text-align: left; font-weight: bold;">Alive</td>
                                    <td style="text-align: left;">
                                       <?php
                                          $cp_two_father_alive_val= '';
                                          if(set_value('cp_two_father_alive'))
                                          {
                                             $cp_two_father_alive_val= set_value('cp_two_father_alive');
                                          }
                                          elseif($incident_edit_details[0]['cp_two_father_alive'])
                                          {
                                             $cp_two_father_alive_val= $incident_edit_details[0]['cp_two_father_alive'];
                                          }
                                          else
                                          {
                                             $cp_two_father_alive_val= '';
                                          }
                                          ?>
                                       <label class="radio-inline"><input type="radio" value="1" name="cp_two_father_alive"
                                          <?php 
                                             if($cp_two_father_alive_val==1) 
                                                {
                                                echo 'checked="checked"';
                                                }
                                                else 
                                                {
                                                echo '';
                                                }
                                             ?>
                                          >&nbsp;Yes</label>&nbsp;&nbsp;
                                       <label class="radio-inline"><input type="radio" value="2" name="cp_two_father_alive"
                                          <?php 
                                             if($cp_two_father_alive_val==2) 
                                                {
                                                   echo 'checked="checked"';
                                                }
                                                else 
                                                {
                                                   echo '';
                                                }
                                             ?>
                                          >&nbsp;No</label>&nbsp;&nbsp;
                                       <?php echo form_error('cp_two_father_alive');?>
                                    </td>
                                    <td style="text-align: left;">
                                       <?php
                                          $cp_two_mother_alive_val = '';
                                          if(set_value('cp_two_mother_alive')!='')
                                          {
                                             $cp_two_mother_alive_val=set_value('cp_two_mother_alive');
                                          }
                                          elseif($incident_edit_details[0]['cp_two_mother_alive'])
                                          {
                                             $cp_two_mother_alive_val=$incident_edit_details[0]['cp_two_mother_alive'];
                                          }
                                          else
                                          {
                                             $cp_one_mother_alive_val= '';
                                          }
                                          ?>
                                       <label class="radio-inline"><input type="radio" value="1" name="cp_two_mother_alive"
                                          <?php 
                                             if($cp_two_mother_alive_val==1) 
                                                {
                                                echo 'checked="checked"';
                                                }
                                                else 
                                                {
                                                echo '';
                                                }
                                             ?>
                                          >&nbsp;Yes</label>&nbsp;&nbsp;
                                       <label class="radio-inline"><input type="radio" value="2" name="cp_two_mother_alive"
                                          <?php 
                                             if($cp_two_mother_alive_val==2) 
                                                {
                                                echo 'checked="checked"';
                                                }
                                                else 
                                                {
                                                echo '';
                                                }
                                             ?>
                                          >&nbsp;No</label>&nbsp;&nbsp;
                                       <?php echo form_error('cp_two_mother_alive_val');?>
                                    </td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Modal -->
</div>
<?php $this->load->view($this->config->item('theme_uri').'layout/footer_view'); ?>
<script type="text/javascript">
   $(document).ready(function(){
      var max=50;
      var x=1;
      var rowCount = ($('#Local_Persons_Involved_Table_Field >tbody >tr').length)-1;
      $('#Local_Persons_Involved_Add').click(function(){
         rowCount++;
         if(x <= max)
         {
            var html='<tr class="Local_Persons_Involved_Table_Remove"><td><input type="text" class="form-control" name="Local_Persons_Involved_Details['+rowCount+'][local_person_name]" placeholder="Name, if available"></td><td><input type="radio" name="Local_Persons_Involved_Details['+rowCount+'][local_person_gender]" value="1"></td><td><input type="radio" name="Local_Persons_Involved_Details['+rowCount+'][local_person_gender]" value="2" ></td><td><input type="text" class="form-control" name="Local_Persons_Involved_Details['+rowCount+'][local_person_occupation_identity]" placeholder="Occupation / Identity"></td><td><button type="button" id="Local_Persons_Involved_Remove" class="btn btn-danger form-control"><i class="fa fa-trash"></i></button></td></tr>';
           $('#Local_Persons_Involved_Table_Field').append(html);
           x++;
         }
      });
   
      $('#Local_Persons_Involved_Table_Field').on('click','#Local_Persons_Involved_Remove',function(){
          let text = "Are you sure you want to delete this element?";
          if (confirm(text) == true) {
              $(this).closest('tr').remove();
          }
         x--;
      });
      var cp_two_cwc_minor_sent_div_value = $('input[name="cp_two_cwc_minor_sent_to"]:checked').val();
       if(cp_two_cwc_minor_sent_div_value == '4'){
          $("#cp_two_cwc_first_row").show();
          $("#cp_two_cwc_second_row").show();
          $("#cp_two_cwc_cci_div").show();
          $("#cp_two_cwc_third_row").show();
          $("#cp_two_cwc_address_div").hide();
       }else{
          $("#cp_two_cwc_first_row").hide();
          $("#cp_two_cwc_second_row").show();
          $("#cp_two_cwc_cci_div").hide();
          $("#cp_two_cwc_address_div").show();
          $("#cp_two_cwc_third_row").show();
       }
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
      var rowCount1 = ($('#Officials_Involved_Table_Field >tbody >tr').length)-1;
      
      var max=50;
      var x=1;
      $('#Officials_Involved_Add').click(function(){
         rowCount1++;
         if(x <= max)
         { 
            var html='<tr class="Officials_Involved_Table_Remove"><td><input type="text" class="form-control" name="Officials_Involved_Details['+rowCount1+'][official_involved_name]" placeholder="Name"></td><td><input type="text" class="form-control" name="Officials_Involved_Details['+rowCount1+'][officials_involved_designation]" placeholder="Designation"></td><td><input type="text" class="form-control" name="Officials_Involved_Details['+rowCount1+'][officials_involved_office]" placeholder="Office"></td><td><input type="text" class="form-control js-input-mobile no" name="Officials_Involved_Details['+rowCount1+'][officials_involved_contact_no]" placeholder="Contact No" onkeyup="phone_number_validation()" onkeypress="return validateMobileNumber(event)" maxlength="10"></td><td><button type="button" id="Officials_Involved_Remove" class="btn btn-danger form-control"><i class="fa fa-trash"></i></button></td></tr>';
           $('#Officials_Involved_Table_Field').append(html);
           x++;
         }
      });
   
      $('#Officials_Involved_Table_Field').on('click','#Officials_Involved_Remove',function(){
          let text = "Are you sure you want to delete this element?";
          if (confirm(text) == true) {
              $(this).closest('.Officials_Involved_Table_Remove').remove();
          }
         x--;
      });
   });
</script>
<script type="text/javascript">
   function Local_Persons_Involved_Row_Delete(lpi_id)
   {
      let text = "Are you sure you want to delete this element?";
      if (confirm(text) == true) {
         var lpi_id = lpi_id;
         $.ajax({
            url:"<?php echo base_url()?>admin/reporting/incident/incident_form/Local_Persons_Involved_Row_Delete_Data",
            method:"GET",
            data:{lpi_id:lpi_id},
            dataType:"JSON",
            success:function(response)
            {
               $("#delete_local_person_row" + lpi_id).fadeOut('slow');
            }
         });
      }
   }
</script>
<script type="text/javascript">
   function Officials_Involved_Row_Delete(olpi_id)
   {
      let text = "Are you sure you want to delete this element?";
      if (confirm(text) == true) {
         var olpi_id = olpi_id;
         $.ajax({
            url:"<?php echo base_url()?>admin/reporting/incident/incident_form/Officials_Involved_Row_Delete_Data",
            method:"GET",
            data:{olpi_id:olpi_id},
            dataType:"JSON",
            success:function(response)
            {
              $("#delete_officials_involved_row" + olpi_id).fadeOut('slow');
            }
         });
      }
   }
</script>
<script type="text/javascript">
   $(document).on('click','.next_step',function(){
      $(window).scrollTop(0);
   });
</script>
<script type="text/javascript">
   $(document).ready(function(){
        var cp_one_cwc_minor_sent=$("#cp_one_cwc_minor_sent_to:checked").val();
        if (typeof cp_one_cwc_minor_sent != "undefined") {
              if(cp_one_cwc_minor_sent==4)
              {
                 $("#cp_one_cwc_first_row").show();
                 $("#cp_one_cwc_third_row").show();
                 $("#cp_one_cwc_cci_div").hide();
              }
           }
   });
</script> 
<script type="text/javascript">
   function Cancel_Incident(){
      swal({
      title: "Cancel Incident?",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-success",
      confirmButtonText: "Yes",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: true
    },
    function(isConfirm){
      if(isConfirm){
          swal("Cancelled", "Incident cancel!", "error");
          setTimeout(function(){
             window.location.href = "<?php echo base_url()?>admin/reporting/incident_draft/incident_draft_list";
          }, 1500);
      } 
    });
   }
</script>
<script type="text/javascript">
   $(document).ready(function(){
     $('#first_next_step').click(function(){
       $('#step_two').addClass("active");
       $('#step_one').removeClass("active");
     });
     $('#first_prev_step').click(function(){
       $('#step_two').removeClass("active");
       $('#step_one').addClass("active");
     });
     $('#second_next_step').click(function(){
       $('#step_three').addClass("active");
       $('#step_two').removeClass("active");
       $('#step_one').removeClass("active");
     });
     $('#second_prev_step').click(function(){
       $('#step_two').addClass("active");
       $('#step_three').removeClass("active");
       $('#step_one').removeClass("active");
     });
     $('#third_next_step').click(function(){
       $('#step_four').addClass("active");
       $('#step_one').removeClass("active");
       $('#step_two').removeClass("active");
       $('#step_three').removeClass("active");
     });
     $('#third_prev_step').click(function(){
       $('#step_three').addClass("active");
       $('#step_one').removeClass("active");
       $('#step_two').removeClass("active");
       $('#step_four').removeClass("active");
     });
     $('#fourth_next_step').click(function(){
       $('#step_five').addClass("active");
       $('#step_one').removeClass("active");
       $('#step_two').removeClass("active");
       $('#step_three').removeClass("active");
       $('#step_four').removeClass("active");
     });
     $('#fourth_prev_step').click(function(){
       $('#step_four').addClass("active");
       $('#step_one').removeClass("active");
       $('#step_two').removeClass("active");
       $('#step_three').removeClass("active");
       $('#step_five').removeClass("active");
     });
     $('#fifth_next_step').click(function(){
       $('#step_six').addClass("active");
       $('#step_one').removeClass("active");
       $('#step_two').removeClass("active");
       $('#step_three').removeClass("active");
       $('#step_four').removeClass("active");
       $('#step_five').removeClass("active");
     });
     $('#fifth_prev_step').click(function(){
       $('#step_five').addClass("active");
       $('#step_one').removeClass("active");
       $('#step_two').removeClass("active");
       $('#step_three').removeClass("active");
       $('#step_four').removeClass("active");
       $('#step_six').removeClass("active");
     });
   });
</script>