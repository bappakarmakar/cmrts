<?php
   $incident_id = ($incident_id_pk)?$incident_id_pk:'';
?>
<base href="<?php echo base_url(); ?>admin/" />
<!-- <link rel="stylesheet" href="<?php echo $this->config->item('theme_uri');?>bower_components/bootstrap/dist/css/bootstrap.min.css"> -->
<script src="<?php echo $this->config->item('theme_uri');?>bower_components/jquery/dist/jquery.min.js"></script>
<style>
   /* input {
    height: 20px !important;
}

select {
    height: 20px !important;
} */

   /* body {
    width: 6.5in;
    margin: 0;
}

@media print {
    input {
        height: 10px !important;
    }
    @media print {
        select {
            position: relative;
            width: fit-content;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            padding: 8px 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: white;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        select::after {
            content: '';
            position: absolute;
            top: calc(50% - 2px);
            right: 8px;
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 4px solid #555;
            pointer-events: none;
            z-index: 2;
        }

        .left-form {
            position: relative;
        }

        .new {
            position: absolute;
            right: 75px;
            top: 0;
            text-align: right;
        }

        .new h5 {
            text-align: right;
        }

        .label-div {
            display: flex;
            justify-content: end;
        }

        .inp {
            width: 20%;
            margin-left: 10px;
        }

        .des-loc {
            display: flex;
            flex-wrap: wrap;
        }

        .inp-radio {
            width: 28%;
        }

        .mar-det {
            margin-right: 80px;
        }

        .badge {
            width: auto !important;
        }

        .des-loc {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between !important;
            font-size: 13px;
        }

        .font {
            font-size: 12px;
        }

        .label-div {
            display: flex;
            justify-content: space-around;
        }

        .inp {
            width: 30%;
            padding: 0;
        }

        input {
            height: 10px !important;
        }

        input[type=radio] {
            margin-right: 0;
        }

        .mar-det {
            margin-right: 0;
        }

        footer {
            page-break-after: always;
            margin-bottom: 5px;
        }

        .container {
            margin: 0 auto;
            max-width: 100%;
            padding: 20px;
        }
    }
   }
    @page {
        size: auto;
        margin: 20px 30px;
    } */

   /* custom-css */
   body {
      width: 100%;
      padding: 0;
      margin: 0;
   }

   .container {
      width: 1140px;
      margin: 0 auto;
   }

   .col-md-12,
   .col-sm-12,
   .col-xl-12 {
      width: 100%;
   }

   .col-xs-3 {
      width: 30%;
   }

   .row {
      width: 100%;
      display: flex;
      justify-content: left;
      align-items: center;
      margin-bottom: 5px;
   }

   .col-xs-5 {
      width: 50%;
   }

   .col-xs-9 {
      width: 90%;
   }

   .col-sm-6 {
      width: 60%;
   }

   .form-control {
      display: block;
      width: 100%;
      height: 34px;
      padding: 6px 12px;
      font-size: 14px;
      line-height: 1.42857143;
      color: #555;
      background-color: #fff;
      background-image: none;
      border: 1px solid #ccc;
      border-radius: 4px;
      -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
      box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
      -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
      -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
      transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
   }

   .card-body {
      width: 100%;
   }

   .table {
      width: 100%;
   }

   .des-loc {
      display: flex;
   }
   .trash-icon
{
margin-left: 10px;
}
 .prevented_detailsl
 {
      float: right;
      padding-right: 5px;
          padding-bottom: 8px;
 }
fieldset.scheduler-border {
border: 2px groove #ffffff9c !important;
padding: 2px 2px 2px;
background: #c7c7c70a;
-webkit-box-shadow:  0px 0px 0px 0px #000;
box-shadow:  0px 0px 0px 0px #000;
margin-left: 30px;
}
.right_marriage_details
{
padding-right: 5px;
padding-bottom: 5px;
}
.trash-icon
{
margin-left: 10px;
margin-right: -35px;
}
.prevented_details
{
float: right;
padding-right: 5px;
padding-bottom: 5px;
}
legend.scheduler-border {
font-size: 1.2em !important;
font-weight: bold !important;
text-align: left !important;
}
legend {
display: block;
width: auto;
padding: 0;
margin-bottom: 0px;
font-size: 21px;
line-height: inherit;
color: #333;
border: 0;
border-bottom: 1px solid #e5e5e5;}

</style>

<body>
   <div class="container">
      <div class="content-wrapper">
         <section class="content-header">
            <!-- <?php //echo "<pre>";print_r($incident_edit_details);die;?> -->
            <h3 style="text-transform: uppercase; text-align: center;"><u>Intervention Report Data <span style="font-size:23px"><?php echo $user_dist?></span></u></h3>
         </section>
         <section class="content">
            <?php $this->load->view('errors/message'); ?>
            <input type="hidden"
                   id="base"
                   value="<?php echo base_url(); ?>">
      </div>
      <div class="box bottom-box">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-default">
                  <div class="card-body p-0">
                     <div class="bs-stepper">
                        <div class="bs-stepper-header"
                             role="tablist">
                           <div class="bs-stepper-content">
                              <!-- your steps content here -->
                              <div class="print-page">
                                 <div id="step-one"
                                      class="content"
                                      role="tabpanel"
                                      aria-labelledby="step-one-trigger">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-sm-12 col-form-label badge badge-Primary text-wrap "
                                                 style="width: 18rem; font-size:medium;">Prevention Intervention&nbsp;</label>
                                       </div>
                                    </div>

                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-lg-3 col-md-3 col-xs-3 col-xs-3 col-form-label">Intervention Date&nbsp;(dd/mm/yyyy)</label>
                                          <div class="col-lg-5 col-md-5 col-xs-5 col-xs-5">
                                             <input type="text"
                                                    class="form-control date-picker"
                                                    data-date-end-date="0d"
                                                    id="incident_date"
                                                    placeholder="Incident Date"
                                                    readonly
                                                    autocomplete="off"
                                                    name="incident_date"
                                                    value="<?=($incident_edit_details)?date('d/m/y',strtotime($incident_edit_details['incident_date'])):''; ?>"
                                                    tabindex="7">
                                          </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                                          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                              <fieldset class="scheduler-border"tyle="border: 2px groove #ddd !important;">
                                             <legend class="scheduler-border"><font color="red" size="5px">*</font></legend>
                                              <div class="right_marriage_details" style="text-align: right; ">
                                             <?php
                                            $mrg_dtl_val= '';
                                            foreach($marriage_details as $key => $value){
                                               if($key == 0){
                                                  $marriage_details_css = '';
                                               }elseif($key == 1){
                                                  $marriage_details_css = '';
                                               }else{
                                                  $marriage_details_css = '';
                                               }
                                            ?>
                                             <span style="<?php echo $marriage_details_css; ?>"><?php echo $value['description']?></span><input type="radio"
                                                    value="<?php echo $value['cm_marriage_master_id_pk']?>"
                                                    name="marriage_details"
                                                    <?=($incident_edit_details)?($incident_edit_details['marriage_details']==$value['cm_marriage_master_id_pk'])?'checked':'':''?>
                                                    class="mar-det"
                                                    style=""><br>
                                             <?php } ?>
                                          </div>
                                          </fieldset>
                                          </div>
                                       </div>

                                       <div class="form-group row">
                                          <label class="col-lg-3 col-md-3 col-xs-3 col-xs-3 col-form-label">Marriage Date&nbsp;(dd/mm/yyyy)</label>
                                          <div class="col-lg-5 col-md-5 col-xs-5 col-xs-5">
                                             <input type="text"
                                                    class="form-control date-picker"
                                                    data-date-end-date="0d"
                                                    id="marriage_date"
                                                    readonly
                                                    autocomplete="off"
                                                    name="marriage_date"
                                                    value="<?php echo !empty($incident_edit_details['marriage_date']) ? date('d-m-Y', strtotime($incident_edit_details['marriage_date'])) : ''; ?>"
                                                    tabindex="7">
                                          </div>
                                       </div>

                                       <div class="form-group row">
                                          <div class="col-xs-3 col-xs-3">
                                             <label class=" col-form-label">Street / Landmark</label>
                                          </div>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text"
                                                    placeholder="Street / Landmark"
                                                    class="form-control"
                                                    id="street_landmark"
                                                    autocomplete="off"
                                                    name="street_landmark"
                                                    value="<?=($incident_edit_details)?$incident_edit_details['street_landmark']:""; ?>">
                                          </div>
                                         
                                       </div>

                                       <div class=" row">
                                          <div class="col-lg-3 col-md-3 col-xs-3 col-xs-3">
                                             <label class=" col-form-label">State</label>
                                          </div>
                                          <div class="col-lg-5 col-md-5 col-xs-5 col-xs-5">
                                             <input type="text"
                                                    placeholder="Ward / GP"
                                                    class="form-control"
                                                    id="state"
                                                    autocomplete="off"
                                                    name="state"
                                                    value="West Bengal"
                                                    readonly
                                                    style="cursor: not-allowed;">
                                          </div>
                                    <div class="col-lg-1 col-md-1 col-xs-1 col-xs-1"></div>
                                          <div class="col-lg-4 col-md-4 col-xs-4 col-xs-4">
                                           
                                          <fieldset class="scheduler-border"tyle="border: 2px groove #ddd !important;">
                        <legend class="scheduler-border"><font color="red" size="5px">*</font></legend>
                          <div class="prevented_detailsl">
                                                <?php foreach($prevented_details as $key => $value){
                                                              if($key == 0){
                                                                 $prevented_details_css = 'margin-left: 0px';
                                                              }else{
                                                                 $prevented_details_css = 'margin-left: 0px';
                                                              }
                                                           ?>
                                                <span style="<?php echo $prevented_details_css; ?>"><?php echo $value['description']?>&nbsp;&nbsp;</span>
                                                <input type="radio"
                                                       name="prevented_details"
                                                       id="prevented_details_<?=$key?>"
                                                       value="<?php echo $value['cm_incident_report_details_master_id_pk']?>"
                                                       <?php echo set_radio('prevented_details', $value['cm_incident_report_details_master_id_pk']); ?>
                                                       <?=($incident_edit_details)?($incident_edit_details['prevented_details']==$value['cm_incident_report_details_master_id_pk'])?'checked':'':''?>
                                                       style="float: right;margin-right: 0px;"><br>
                                                <?php } ?>
                                                <?php echo form_error('prevented_details');?>
                                                 </div>
                                             </fieldset>
                                            
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-xs-3 col-form-label">District</label>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text"
                                                    class="form-control"
                                                    value="<?=($incident_edit_details)?$incident_edit_details['incident_district']:""; ?>">
                                          </div>
                                          <div class="col-xs-1"></div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-xs-3 col-form-label">Block / Municipality</label>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text"
                                                    class="form-control"
                                                    value="<?=($incident_edit_details)?$incident_edit_details['incident_block']:""; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-xs-3 col-form-labell">Ward / GP <font color="red">*</font></label>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text"
                                                    class="form-control "
                                                    value="<?=$ward_gp_name?>">
                                          </div>
                                          <!-- <div class="col-sm-5"> -->
                                          <!-- <?php if($this->session->userdata('block') != '' && $this->session->userdata('subdiv') != ''){?> -->
                                          <!-- <select class="form-control" id="ward_gp" autocomplete="off" name="ward_gp"> -->
                                          <!-- <option value="" disabled selected>--Select Block / Municipality First--</option> -->
                                          <!-- <?php if(!empty($Incident_Ward_Gp_Block)){?> -->
                                          <!-- <?php if($Incident_Ward_Gp_Block->rural_urban == 'U'){?> -->
                                          <!-- <?php foreach($Incident_Ward as $Incident_Ward_Value){ ?> -->
                                          <!-- <option value="<?php echo $Incident_Ward_Value['ward_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_Ward_Value['ward_id_pk']); ?> <?=($incident_edit_details)?($incident_edit_details['ward_gp']==$Incident_Ward_Value['ward_id_pk'])?'selected':'':''?>><?php echo $Incident_Ward_Value['ward_no'];?></option>  -->

                                          <!-- <?php } ?> -->
                                          <!-- <?php }else{?> -->
                                          <!-- <?php foreach($Incident_Gp as $Incident_GP_Value){ ?> -->
                                          <!-- <option value="<?php echo $Incident_GP_Value['gp_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_GP_Value['gp_id_pk']); ?> <?=($incident_edit_details)?($incident_edit_details['ward_gp']==$Incident_GP_Value['gp_id_pk'])?'selected':'':''?>><?php echo $Incident_GP_Value['gp_name'];?></option>  -->
                                          <!-- <?php } ?> -->
                                          <!-- <?php } } ?> -->


                                          <!-- </select> -->
                                          <!-- <?php }elseif($this->session->userdata('block') == '0' && $this->session->userdata('subdiv') == ''){?> -->
                                          <!-- <select class="form-control" id="ward_gp" autocomplete="off" name="ward_gp"> -->
                                          <!-- <option value="" disabled selected>--Select Block / Municipality First--</option> -->
                                          <!-- <?php if(!empty($Incident_Ward_Gp_Block)){?> -->
                                          <!-- <?php if($Incident_Ward_Gp_Block->rural_urban == 'U'){?> -->
                                          <!-- <?php foreach($Incident_Ward as $Incident_Ward_Value){ ?> -->
                                          <!-- <option value="<?php echo $Incident_Ward_Value['ward_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_Ward_Value['ward_id_pk']); ?> <?=($incident_edit_details)?($incident_edit_details['ward_gp']==$Incident_Ward_Value['ward_id_pk'])?'selected':'':''?>><?php echo $Incident_Ward_Value['ward_no'];?></option>  -->
                                          <!-- <?php } ?> -->
                                          <!-- <?php }else{?> -->
                                          <!-- <?php foreach($Incident_Gp as $Incident_GP_Value){ ?> -->
                                          <!-- <option value="<?php echo $Incident_GP_Value['gp_id_pk'];?>" <?php echo set_select('ward_gp', $Incident_GP_Value['gp_id_pk']); ?> <?=($incident_edit_details)?($incident_edit_details['ward_gp']==$Incident_GP_Value['gp_id_pk'])?'selected':'':''?>><?php echo $Incident_GP_Value['gp_name'];?></option>  -->
                                          <!-- <?php } ?> -->
                                          <!-- <?php } } ?> -->
                                          <!-- </select> -->
                                          <!-- <?php }elseif($this->session->userdata('block') != '' && $this->session->userdata('subdiv') == ''){?> -->
                                          <!-- <select class="form-control" id="ward_gp" autocomplete="off" name="ward_gp"> -->
                                          <!-- <option value="" disabled selected>--Select Ward / GP--</option> -->
                                          <!-- <?php foreach($ward_gp_details as $value){?> -->
                                          <!-- <option value="<?php echo $value['gp_id_pk'];?>" <?php echo set_select('ward_gp', $value['gp_id_pk']); ?> <?=($incident_edit_details)?($incident_edit_details['ward_gp']==$value['gp_id_pk'])?'selected':'':''?>><?php echo $value['gp_name'];?></option> -->
                                          <!-- <?php } ?> -->
                                          <!-- </select> -->
                                          <!-- <?php } ?> -->
                                          <!-- <?php echo form_error('ward_gp');?> -->
                                          <!-- <span id="ward_error" style="color: red;"></span> -->
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Police Station</label>
                                       <div class="col-xs-5 col-xs-5">
                                          <input type="text"
                                                 class="form-control"
                                                 placeholder="Police Station"
                                                 name="police_station"
                                                 id="police_station"
                                                 autocomplete="off"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['police_station']:""; ?>">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Description of location</label>
                                       <div class="col-sm-9">
                                          <div class="des-loc">
                                             <?php foreach($location_description_details as $value){?>
                                             <div class="inp-radio">
                                                <label class="radio-inline"><input type="radio"
                                                          name="location_description"
                                                          id="location_description"
                                                          value="<?php echo $value['cm_location_master_id_pk']?>"
                                                          <?php echo set_radio('location_description', $value['cm_location_master_id_pk']); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['location_description']==$value['cm_location_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                                             </div>
                                             <?php } ?>
                                             <?php echo form_error('location_description');?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <hr style="border: 1px solid gray;">
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label class="col-sm-12 col-form-label badge badge-Primary text-wrap "
                                              style="width: 42rem; font-size:medium;">Information First Received at Block / Municipality office from</label>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Anonymous <font color="red">*</font></label>
                                       <div class="col-sm-5">
                                          <label class="radio-inline"><input type="radio"
                                                    name="anonymous"
                                                    class="anonymous"
                                                    id="anonymous"
                                                    value="1"
                                                    <?php echo set_radio('anonymous', '1'); ?>
                                                    <?=($incident_edit_details)?($incident_edit_details['anonymous']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;
                                          <label class="radio-inline"><input type="radio"
                                                    name="anonymous"
                                                    class="anonymous"
                                                    id="anonymous"
                                                    value="2"
                                                    <?php echo set_radio('anonymous', '2'); ?>
                                                    <?=($incident_edit_details)?($incident_edit_details['anonymous']==2)?'checked':'':''?>>&nbsp;No</label>&nbsp;&nbsp;
                                          <?php echo form_error('anonymous');?>
                                       </div>
                                    </div>
                                 </div>
                                 <?php if($incident_edit_details['anonymous']== '2'){?>
                                 <div class="card-body"
                                      id="Anonymous_1">
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">If identity known Name</label>
                                       <div class="col-sm-9  col-xs-9">
                                          <input type="text"
                                                 class="form-control"
                                                 placeholder="If identity known Name"
                                                 name="identity_known_name"
                                                 id="identity_known_name"
                                                 autocomplete="off"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['identity_known_name']:""; ?>">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-lg-3 col-md-3 col-xs-3 col-xs-3 col-form-label">Street / Landmark</label>
                                       <div class="col-lg-9 col-md-9 col-xs-9 col-xs-9">
                                          <input type="text"
                                                 placeholder="Street / Landmark"
                                                 class="form-control"
                                                 id="identity_street_landmark"
                                                 autocomplete="off"
                                                 name="identity_street_landmark"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['identity_street_landmark']:""; ?>">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="card-body"
                                      id="Anonymous_2">
                                    <div class="left-form">
                                       <div class="form-group row">
                                          <label class="col-lg-3 col-md-3 col-xs-3 col-xs-3 col-form-label">State</label>
                                          <div class="col-lg-9 col-md-9 col-xs-9 col-xs-9">
                                             <input type="text"
                                                    placeholder="Ward / GP"
                                                    class="form-control"
                                                    id="identity_state"
                                                    autocomplete="off"
                                                    name="identity_state"
                                                    value="West Bengal"
                                                    readonly
                                                    style="cursor: not-allowed;">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">District <font color="red">*</font></label>
                                          <div class="col-sm-5">
                                             <select class="form-control district"
                                                     name="identity_district"
                                                     id="identity_district">
                                                <!-- <option disabled="" selected="" value="">--Please Select District--</option> -->
                                                <?php foreach($districts as $district){ ?>
                                                <option value="<?php echo $district['district_id_pk'];?>"
                                                        <?php echo set_select('identity_district', $district['district_id_pk'], False); ?>
                                                        <?=($incident_edit_details)?($incident_edit_details['identity_district_id']==$district['district_id_pk'])?'selected':'':''?>>
                                                   <?php echo $district['district_name'];?></option>
                                                <?php } ?>
                                             </select>
                                             <?php echo form_error('identity_district'); ?>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Block / Municipality <font color="red">*</font></label>
                                          <div class="col-sm-5">
                                             <select class="form-control"
                                                     name="identity_block"
                                                     id="identity_block">
                                                <!-- <option disabled="" selected="" value="">--Please Select District First--</option> -->
                                                <?php foreach($identityBlock as $incidentBlockValue){ ?>
                                                <option value="<?php echo $incidentBlockValue['block_id_pk'];?>"
                                                        <?php echo set_select('identity_block', $incidentBlockValue['block_id_pk']); ?>
                                                        <?=($incident_edit_details)?($incident_edit_details['identity_block_id']==$incidentBlockValue['block_id_pk'])?'selected':'':''?>>
                                                   <?php echo $incidentBlockValue['block_name'];?></option>
                                                <?php } ?>
                                             </select>
                                             <?php echo form_error('identity_block'); ?>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-sm-3 col-form-label">Ward / GP <font color="red">*</font></label>
                                          <div class="col-sm-5">
                                             <select class="form-control"
                                                     id="identity_ward_gp"
                                                     autocomplete="off"
                                                     name="identity_ward_gp">
                                                <!-- <option value="0" disabled selected>--Select Block / Municipality First--</option> -->
                                                <?php if(!empty($Identity_Ward_Gp_Block)){?>
                                                <?php if($Identity_Ward_Gp_Block->rural_urban == 'U'){?>
                                                <?php foreach($Identity_Ward as $Identity_Ward_Value){ ?>
                                                <option value="<?php echo $Identity_Ward_Value['ward_id_pk'];?>"
                                                        <?php echo set_select('identity_ward_gp', $Identity_Ward_Value['ward_id_pk']); ?>
                                                        <?=($incident_edit_details)?($incident_edit_details['identity_ward_gp']==$Identity_Ward_Value['ward_id_pk'])?'selected':'':''?>>
                                                   <?php echo $Identity_Ward_Value['ward_no'];?></option>
                                                <?php } ?>
                                                <?php }else{?>
                                                <?php foreach($Identity_Gp as $Identity_GP_Value){ ?>
                                                <option value="<?php echo $Identity_GP_Value['gp_id_pk'];?>"
                                                        <?php echo set_select('identity_ward_gp', $Identity_GP_Value['gp_id_pk']); ?>
                                                        <?=($incident_edit_details)?($incident_edit_details['identity_ward_gp']==$Identity_GP_Value['gp_id_pk'])?'selected':'':''?>>
                                                   <?php echo $Identity_GP_Value['gp_name'];?></option>
                                                <?php } ?>
                                                <?php } } ?>
                                             </select>
                                             <?php echo form_error('identity_ward_gp');?>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Pin Code</label>
                                          <div class="col-xs-5">
                                             <input type="text"
                                                    class="form-control js-input-mobile"
                                                    placeholder="Pin Code"
                                                    name="identity_pin_code"
                                                    id="identity_pin_code"
                                                    autocomplete="off"
                                                    maxlength="6"
                                                    value="<?=($incident_edit_details)?$incident_edit_details['identity_pin_code']:""; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Police Station</label>
                                          <div class="col-xs-5">
                                             <input type="text"
                                                    class="form-control"
                                                    placeholder="Police Station"
                                                    name="identity_police_station"
                                                    id="identity_police_station"
                                                    autocomplete="off"
                                                    value="<?=($incident_edit_details)?$incident_edit_details['identity_police_station']:""; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Phone No</label>
                                          <div class="col-xs-5">
                                             <input type="text"
                                                    class="form-control js-input-mobile"
                                                    placeholder="Phone No"
                                                    name="identity_phone_no"
                                                    id="identity_phone_no"
                                                    autocomplete="off"
                                                    maxlength="10"
                                                    value="<?=($incident_edit_details)?$incident_edit_details['identity_phone_no']:""; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row new">
                                          <h5 class=""><strong>Information Received by</strong>
                                             <font color="red">*</font>
                                          </h5>
                                          <div class="">
                                             <?php foreach($information_received_details as $value){?>
                                             <div>
                                                <?php echo $value['description']?>
                                                &nbsp;&nbsp;&nbsp;
                                                <input type="radio"
                                                       class="inp-inf"
                                                       name="information_received"
                                                       id="information_received"
                                                       value="<?php echo $value['cm_information_received_master_id_pk']?>"
                                                       <?php echo set_radio('information_received', $value['cm_information_received_master_id_pk']); ?>
                                                       <?=($incident_edit_details)?($incident_edit_details['information_received']==$value['cm_information_received_master_id_pk'])?'checked':'':''?>>
                                             </div>
                                             <?php } ?>
                                             <?php echo form_error('information_received');?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <hr style="border: 1px solid gray;">
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label class="col-sm-12 col-form-label badge badge-Primary text-wrap "
                                              style="width: 38rem; font-size:medium;">Local Persons Involved in Prevention Incident</label>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <div class="col-sm-12">
                                          <table class="table table-bordered"
                                                 id="Local_Persons_Involved_Table_Field">
                                             <tr style="background-color: gray; color: #FFFFFF;">
                                                <th>Name, if available</th>
                                                <th style="text-align: center;">Male</th>
                                                <th style="text-align: center;">Female</th>
                                                <th>Occupation / Identity</th>
                                             </tr>
                                             <?php
                                               $count = 0;
                                               $queryArray = $local_persons_involved;
                                               foreach($queryArray as $key => $value){
                                                   if (!empty(array_filter($value))) {
                                                    
                                               ?>
                                             <tr
                                                 id="Local_Persons_Involved_Details<?php if($this->input->post('Local_Persons_Involved_Details')){ echo $key; ?><?php }else{?><?php echo $key; ?><?php } ?>">
                                                <td><input type="text"
                                                          class="form-control"
                                                          id="local_person_name"
                                                          name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_name]"
                                                          value="<?php echo $value['local_person_name']; ?>"
                                                          placeholder="Name, if available"
                                                          onkeypress="return Local_Person_Name_Validate(event);"
                                                          onpaste="return false"></td>
                                                <td><input type="radio"
                                                          name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_gender]"
                                                          value="1"
                                                          <?php if(isset($value['local_person_gender'])) { if($value['local_person_gender'] == 1){ echo "checked"; } } ?>></td>
                                                <td><input type="radio"
                                                          name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_gender]"
                                                          value="2"
                                                          <?php if(isset($value['local_person_gender'])) { if($value['local_person_gender'] == 2){ echo "checked"; } } ?>></td>
                                                <td><input type="text"
                                                          class="form-control"
                                                          name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_occupation_identity]"
                                                          value="<?php echo $value['local_person_occupation_identity']; ?>"
                                                          placeholder="Occupation / Identity"></td>

                                                <?php } } ?>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                                 <footer></footer>
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label class="col-sm-12 col-form-label badge badge-Primary text-wrap "
                                              style="width: 34rem; font-size:medium;">Officials Involved in Prevention Incident</label>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <div class="col-sm-12">
                                          <table class="table table-bordered"
                                                 id="Officials_Involved_Table_Field">
                                             <tr style="background-color: gray; color: #FFFFFF;">
                                                <th>Name</th>
                                                <th>Designation</th>
                                                <th>Office</th>
                                                <th>Contact No</th>
                                             </tr>
                                             <?php
                                               $count = 0;
                                               $OfficialsQueryArray = $officials_involved;
                                               foreach($OfficialsQueryArray as $key => $value){$count ++;
                                                if (!empty(array_filter($value))) {
                                               ?>
                                             <tr class="Officials_Involved_Table_Remove"
                                                 id="delete_officials_involved_row<?php if($this->input->post('Officials_Involved_Details')){ echo $key; ?><?php }else{?><?php echo $key; ?><?php } ?>">
                                                <td><input type="text"
                                                          class="form-control"
                                                          id="official_involved_name"
                                                          name="Officials_Involved_Details[<?php echo $key ?>][official_involved_name]"
                                                          placeholder="Name"
                                                          value="<?php echo $value['official_involved_name']; ?>"
                                                          onkeypress="return Official_Involved_Name_Validate(event);"
                                                          onpaste="return false"></td>

                                                <td><input type="text"
                                                          class="form-control"
                                                          name="Officials_Involved_Details[<?php echo $key ?>][officials_involved_designation]"
                                                          placeholder="Designation"
                                                          value="<?php echo $value['officials_involved_designation']; ?>"></td>

                                                <td><input type="text"
                                                          class="form-control"
                                                          name="Officials_Involved_Details[<?php echo $key ?>][officials_involved_office]"
                                                          placeholder="Office"
                                                          value="<?php echo $value['officials_involved_office']; ?>"></td>

                                                <td><input type="text"
                                                          id="no"
                                                          class="form-control officials_involved_contact_no_validate"
                                                          name="Officials_Involved_Details[<?php echo $key ?>][officials_involved_contact_no]"
                                                          placeholder="Contact No"
                                                          onkeyup="phone_number_validation()"
                                                          maxlength="10"
                                                          value="<?php echo $value['officials_involved_contact_no']; ?>"
                                                          onpaste="return false"></td>



                                             </tr>

                                             <?php } } ?>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div id="step-two"
                                class="content"
                                role="tabpanel"
                                aria-labelledby="step-two-trigger">
                              <div class="card-body"
                                   style="margin-top: 20px;margin-bottom: 20px ">
                                 <div class="form-group row">
                                    <label class="col-sm-12 col-form-label badge badge-Primary text-wrap "
                                           style="width: 24rem; font-size:medium;">Contracting Party One</label>
                                 </div>
                              </div>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-xs-3 col-form-label">Name</label>
                                    <div class="  col-xs-5">
                                       <input type="text"
                                              class="form-control"
                                              placeholder="Name"
                                              name="cp_one_name"
                                              id="cp_one_name"
                                              autocomplete="off"
                                              value="<?=($incident_edit_details)?$incident_edit_details['cp_1_name']:''?>">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-xs-3 col-form-label">Street / Landmark</label>
                                    <div class="col-xs-5">
                                       <input type="text"
                                              placeholder="Street / Landmark"
                                              class="form-control"
                                              id="cp_one_street_landmark"
                                              autocomplete="off"
                                              name="cp_one_street_landmark"
                                              value="<?=($incident_edit_details)?$incident_edit_details['cp_1_street_landmark']:""; ?>">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-xs-3 col-form-label">State <font color="red">*</font></label>
                                    <div class="col-xs-5">
                                       <select class="form-control cp_one_state_box"
                                               id="cp_one_state"
                                               autocomplete="off"
                                               name="cp_one_state">
                                          <!-- <option value="0" disabled selected>--Select State--</option> -->
                                          <?php foreach($state as $value){?>
                                          <option value="<?php echo $value['state_id_pk']; ?>"
                                                  <?php echo set_select('cp_one_state', $value['state_id_pk']); ?>
                                                  <?=($incident_edit_details)?($incident_edit_details['cp_1_state']==$value['state_id_pk'])?'selected':'':''?>>
                                             <?php echo $value['state_name']; ?></option>
                                          <?php } ?>
                                          <?php echo form_error('cp_1_state');?>
                                       </select>
                                    </div>
                                 </div>
                                 <div id="cp_one_address_div_one">
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">District <font color="red">*</font></label>
                                       <div class="col-xs-5">
                                          <select class="form-control"
                                                  name="cp_one_district"
                                                  id="cp_one_district">
                                             <!-- <option disabled="" selected="" value="">--Select State First--</option> -->
                                             <?php foreach($CP_One_District_Details as $CP_One_District_Value){ ?>
                                             <option value="<?php echo $CP_One_District_Value['district_id_pk'];?>"
                                                     <?php echo set_select('cp_one_district', $CP_One_District_Value['district_id_pk']); ?>
                                                     <?=($incident_edit_details)?($incident_edit_details['cp_1_district_id']==$CP_One_District_Value['district_id_pk'])?'selected':'':''?>>
                                                <?php echo $CP_One_District_Value['district_name'];?></option>
                                             <?php } ?>
                                          </select>
                                          <?php echo form_error('cp_one_district'); ?>
                                       </div>
                                    </div>
                                    <?php if($incident_edit_details['cp_1_state']!=1){ ?>
                                    <div id="cp_1_address_div_two">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Address <font color="red">*</font></label>
                                          <div class="col-xs-5">
                                             <textarea class="form-control"
                                                       name="cp_two_address"
                                                       id="cp_1_address"
                                                       rows="3"
                                                       placeholder="Address"><?=($incident_edit_details)?$incident_edit_details['cp_1_address']:set_value('cp_1_address'); ?></textarea>
                                             <?php echo form_error('cp_1_address'); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <?php } ?>
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Block / Municipality <font color="red">*</font></label>
                                       <div class="col-xs-5">
                                          <select class="form-control"
                                                  name="cp_one_block"
                                                  id="cp_one_block">
                                             <!-- <option disabled="" selected="" value="">--Select District First--</option> -->
                                             <?php foreach($cponeBlock as $incidentBlockValue){ ?>
                                             <option value="<?php echo $incidentBlockValue['block_id_pk'];?>"
                                                     <?php echo set_select('cp_one_block', $incidentBlockValue['block_id_pk']); ?>
                                                     <?=($incident_edit_details)?($incident_edit_details['cp_1_block_id']==$incidentBlockValue['block_id_pk'])?'selected':'':''?>>
                                                <?php echo $incidentBlockValue['block_name'];?></option>
                                             <?php } ?>
                                          </select>
                                          <?php echo form_error('cp_one_block'); ?>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Ward / GP <font color="red">*</font></label>
                                       <div class="col-xs-5">
                                          <select class="form-control"
                                                  id="cp_one_ward_gp"
                                                  autocomplete="off"
                                                  name="cp_one_ward_gp">
                                             <!-- <option value="0" disabled selected>--Select Block / Municipality First--</option> -->
                                             <?php if(!empty($Cp_One_Ward_Gp_Block)){?>
                                             <?php if($Cp_One_Ward_Gp_Block->rural_urban == 'U'){?>
                                             <?php foreach($Cp_One_Ward as $Cp_One_Ward_Value){ ?>
                                             <option value="<?php echo $Cp_One_Ward_Value['ward_id_pk'];?>"
                                                     <?php echo set_select('cp_one_ward_gp', $Cp_One_Ward_Value['ward_id_pk']); ?>
                                                     <?=($incident_edit_details)?($incident_edit_details['cp_1_ward_gp']==$Cp_One_Ward_Value['ward_id_pk'])?'selected':'':''?>>
                                                <?php echo $Cp_One_Ward_Value['ward_no'];?></option>
                                             <?php } ?>
                                             <?php }else{?>
                                             <?php foreach($Cp_One_Gp as $Cp_One_GP_Value){ ?>
                                             <option value="<?php echo $Cp_One_GP_Value['gp_id_pk'];?>"
                                                     <?php echo set_select('cp_one_ward_gp', $Cp_One_GP_Value['gp_id_pk']); ?>
                                                     <?=($incident_edit_details)?($incident_edit_details['cp_1_ward_gp']==$Cp_One_GP_Value['gp_id_pk'])?'selected':'':''?>>
                                                <?php echo $Cp_One_GP_Value['gp_name'];?></option>
                                             <?php } ?>
                                             <?php } } ?>
                                          </select>
                                          <?php echo form_error('cp_one_ward_gp');?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-xs-3 col-form-label">Pin Code</label>
                                    <div class="col-sm-6 col-xs-6">
                                       <input type="text"
                                              class="form-control js-input-mobile"
                                              placeholder="Pin Code"
                                              name="cp_one_pin_code"
                                              id="cp_one_pin_code"
                                              autocomplete="off"
                                              maxlength="6"
                                              value="<?=($incident_edit_details)?$incident_edit_details['cp_1_pin_code']:""; ?>">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-xs-3 col-form-label">Police Station</label>
                                    <div class="col-sm-6 col-xs-6">
                                       <input type="text"
                                              class="form-control"
                                              placeholder="Police Station"
                                              name="cp_one_police_station"
                                              id="cp_one_police_station"
                                              autocomplete="off"
                                              value="<?=($incident_edit_details)?$incident_edit_details['cp_1_police_station']:""; ?>">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-xs-3 col-form-label">Phone No</label>
                                    <div class="col-sm-6 col-xs-6">
                                       <input type="text"
                                              class="form-control js-input-mobile"
                                              placeholder="Phone No"
                                              name="cp_one_phone_no"
                                              id="cp_one_phone_no"
                                              autocomplete="off"
                                              maxlength="10"
                                              value="<?=($incident_edit_details)?$incident_edit_details['cp_1_phone_no']:""; ?>">
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Gender <font color="red">*</font></label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($gender_details as $value){?>
                                          <div class="inp-radio">
                                             <label class="radio-inline"><input type="radio"
                                                       class="cp_one_gender_val"
                                                       name="cp_one_gender"
                                                       value="<?php echo $value['cm_gender_master_id_pk']?>"
                                                       <?php echo set_radio('cp_one_gender', $value['cm_gender_master_id_pk']); ?>
                                                       <?=($incident_edit_details)?($incident_edit_details['cp_1_gender']==$value['cm_gender_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
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
                                          <?php foreach($social_category_details as $value){?>
                                          <div class="inp-radio">
                                             <label class="radio-inline"><input type="radio"
                                                       name="cp_one_social_category"
                                                       value="<?php echo $value['cm_social_category_master_id_pk']?>"
                                                       <?php echo set_radio('cp_one_social_category', $value['cm_social_category_master_id_pk']); ?>
                                                       <?=($incident_edit_details)?($incident_edit_details['cp_1_social_category']==$value['cm_social_category_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                          <?php echo form_error('cp_one_social_category');?>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Religion</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($religion_details as $value){?>
                                          <div class="inp-radio">
                                             <label class="radio-inline"><input type="radio"
                                                       name="cp_one_religion"
                                                       value="<?php echo $value['cm_religion_master_id_pk']?>"
                                                       <?php echo set_radio('cp_one_religion', $value['cm_religion_master_id_pk']); ?>
                                                       <?=($incident_edit_details)?($incident_edit_details['cp_1_religion']==$value['cm_religion_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
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
                                    <label class="col-xs-3 col-form-label">Date of Birth (dd/mm/yyyy) <font color="red">*</font></label>
                                    <div class="col-xs-5">
                                       <input type="text"
                                              class="form-control datepicker"
                                              data-date-end-date="0d"
                                              id="cp_one_dob"
                                              placeholder="Date of Birth"
                                              autocomplete="off"
                                              name="cp_one_dob"
                                              value="<?=($incident_edit_details)?date('d/m/Y',strtotime($incident_edit_details['cp_1_dob'])):set_value('cp_one_dob'); ?>"
                                              style="background-color: white;"
                                              readonly
                                              tabindex="7">
                                       <?php echo form_error('cp_one_dob');?>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-xs-3 col-form-label">Age <font color="red">*</font></label>
                                    <div class="col-xs-5">
                                       <input type="text"
                                              class="form-control js-input-mobile"
                                              name="cp_one_age"
                                              id="cp_one_age"
                                              autocomplete="off"
                                              placeholder="Age"
                                              value="<?=($incident_edit_details)?$incident_edit_details['cp_1_age']:set_value('cp_one_age'); ?>"
                                              maxlength="2"
                                              readonly
                                              style="cursor: not-allowed;">
                                       <?php echo form_error('cp_one_age');?>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">DOB document available?</label>
                                    <div class="col-sm-6">
                                       <label class="radio-inline"><input type="radio"
                                                 name="cp_one_dob_document_available"
                                                 class="dob_document_cp_one"
                                                 value="1"
                                                 <?php echo set_radio('cp_one_dob_document_available', '1'); ?>
                                                 <?=($incident_edit_details)?($incident_edit_details['cp_1_dob_document_available']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;
                                       <label class="radio-inline"><input type="radio"
                                                 name="cp_one_dob_document_available"
                                                 class="dob_document_cp_one"
                                                 value="2"
                                                 <?php echo set_radio('cp_one_dob_document_available', '2'); ?>
                                                 <?=($incident_edit_details)?($incident_edit_details['cp_1_dob_document_available']==2)?'checked':'':''?>>&nbsp;No</label>&nbsp;&nbsp;
                                       <?php echo form_error('cp_one_dob_document_available');?>
                                    </div>
                                 </div>
                              </div>



                              <div class="card-body"
                                   id="dob_document_available_cp_one"
                                   <?php if($incident_edit_details['cp_1_dob_document_available'] == 1){?>style="display: block;"
                                   <?php }else{ ?>style="display: none;"
                                   <?php } ?>>
                                 <div class="form-group row">
                                    <label class="col-xs-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6 col-xs-6">
                                       <input type="text"
                                              class="form-control"
                                              placeholder="Document ID"
                                              name="cp_one_dob_document_id"
                                              id="cp_one_dob_document_id"
                                              autocomplete="off"
                                              value="<?=($incident_edit_details)?$incident_edit_details['cp_1_dob_document_id']:""; ?>">
                                       <?php echo form_error('cp_one_dob_document_id');?>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type </label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($document_type_details as $value){?>
                                          <div class="inp-radio">
                                             <label class="radio-inline"><input type="radio"
                                                       name="cp_one_dob_document_type"
                                                       value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                                       <?php echo set_radio('cp_one_dob_document_type', $value['cm_document_type_master_master_id_pk']); ?>
                                                       <?=($incident_edit_details)?($incident_edit_details['cp_1_dob_document_type']==$value['cm_document_type_master_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
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
                                    <div class="col-sm-6">
                                       <label class="radio-inline"><input type="radio"
                                                 name="cp_one_identity_document_available"
                                                 class="identity_document_cp_one"
                                                 value="1"
                                                 <?php echo set_radio('cp_one_identity_document_available', '1'); ?>
                                                 <?=($incident_edit_details)?($incident_edit_details['cp_1_identity_document_available']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;
                                       <label class="radio-inline"><input type="radio"
                                                 name="cp_one_identity_document_available"
                                                 class="identity_document_cp_one"
                                                 value="2"
                                                 <?php echo set_radio('cp_one_identity_document_available', '2'); ?>
                                                 <?=($incident_edit_details)?($incident_edit_details['cp_1_identity_document_available']==2)?'checked':'':''?>>&nbsp;No</label>&nbsp;&nbsp;
                                       <?php echo form_error('cp_one_identity_document_available');?>
                                    </div>
                                 </div>
                              </div>
                              <div class="card-body"
                                   id="identity_document_available_cp_one"
                                   <?php if($incident_edit_details['cp_1_identity_document_available'] == 1){?>style="display: block;"
                                   <?php }else{ ?>style="display: none;"
                                   <?php } ?>>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6">
                                       <input type="text"
                                              class="form-control"
                                              placeholder="Document ID"
                                              name="cp_one_identity_document_id"
                                              id="cp_one_identity_document_id"
                                              autocomplete="off"
                                              value="<?=($incident_edit_details)?$incident_edit_details['cp_1_identity_document_id']:set_value('cp_one_identity_document_id'); ?>">
                                       <?php echo form_error('cp_one_identity_document_id');?>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($document_type_details as $value){?>
                                          <div class="inp-radio">
                                             <label class="radio-inline"><input type="radio"
                                                       name="cp_one_identity_document_type"
                                                       value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                                       <?php echo set_radio('cp_one_identity_document_type', $value['cm_document_type_master_master_id_pk']); ?>
                                                       <?=($incident_edit_details)?($incident_edit_details['cp_1_identity_document_type']==$value['cm_document_type_master_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                                          </div>
                                          <?php } ?>
                                          <?php echo form_error('cp_one_identity_document_type');?>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Highest Educational Attainment</label>
                                       <div class="col-sm-9">
                                          <div class="des-loc">
                                             <?php foreach($highest_education_details as $value){?>
                                             <div class="inp-radio">
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_one_highest_educational_attainment"
                                                          value="<?php echo $value['cm_highest_educational_attainment_master_id_pk']?>"
                                                          <?php echo set_radio('cp_one_highest_educational_attainment', $value['cm_highest_educational_attainment_master_id_pk']); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_1_highest_educational_attainment']==$value['cm_highest_educational_attainment_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                                             </div>
                                             <?php } ?>
                                             <?php echo form_error('cp_one_highest_educational_attainment');?>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <div class="col-sm-12">
                                       <table class="table table-bordered"
                                              id="documents_collected_table_field">
                                          <tr style="background-color: gray; color: #FFFFFF;">
                                             <th colspan="2"
                                                 style="text-align: center;">Father of Contracting Party 1</th>
                                             <th style="text-align: center;">Mother of Contracting Party 1</th>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Name</td>
                                             <td>
                                                <input type="text"
                                                       class="form-control"
                                                       name="cp_one_father_name"
                                                       value="<?=($incident_edit_details)?$incident_edit_details['cp_1_father_name']:""; ?>">
                                             </td>
                                             <td>
                                                <input type="text"
                                                       class="form-control"
                                                       name="cp_one_mother_name"
                                                       value="<?=($incident_edit_details)?$incident_edit_details['cp_1_mother_name']:""; ?>">
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Phone No</td>
                                             <td>
                                                <input type="text"
                                                       class="form-control js-input-mobile"
                                                       name="cp_one_father_mobile_no"
                                                       maxlength="10"
                                                       value="<?=($incident_edit_details)?$incident_edit_details['cp_1_father_mobile_no']:""; ?>">
                                             </td>
                                             <td>
                                                <input type="text"
                                                       class="form-control js-input-mobile"
                                                       name="cp_one_mother_mobile_no"
                                                       maxlength="10"
                                                       value="<?=($incident_edit_details)?$incident_edit_details['cp_1_mother_mobile_no']:""; ?>">
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID</td>
                                             <td>
                                                <input type="text"
                                                       class="form-control"
                                                       name="cp_one_father_id"
                                                       value="<?=($incident_edit_details)?$incident_edit_details['cp_1_father_id']:""; ?>">
                                             </td>
                                             <td>
                                                <input type="text"
                                                       class="form-control"
                                                       name="cp_one_mother_id"
                                                       value="<?=($incident_edit_details)?$incident_edit_details['cp_1_mother_id']:""; ?>">
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID Type</td>
                                             <td>
                                                <?php //echo "<pre>";//print_r($doc_availble_type);
                                                   // echo($incident_edit_details['cp_1_father_id_type']);
                                                  $doc_available = array_column($doc_availble_type, 'description','cm_document_type_master_master_id_pk');


                                                      // foreach ($doc_availble_type as $document) {
                                                      //     $id = $document->cm_document_type_master_master_id_pk;
                                                      //     $description = $document->description;
                                                      //     $newArray[$id]['description'] = $description;
                                                      // }
                                                   // print_r($doc_available);
                                                   if($incident_edit_details['cp_1_father_id_type']!='')
                                                   {
                                                      echo $doc_available[$incident_edit_details['cp_1_father_id_type']];
                                                   }
                                                   else
                                                   {
                                                      echo "nil";
                                                   }
                                                   ?>
                                                <!-- <select class="form-control" name="cp_one_father_id_type"> -->
                                                <!-- <option value="" selected="" disabled="">--Select--</option> -->
                                                <!-- <?php foreach($document_type_details as $value){?> -->
                                                <!-- <option value="<?php echo $value['cm_document_type_master_master_id_pk']?>"<?php echo set_select('cp_one_father_id_type', $value['cm_document_type_master_master_id_pk'], False); ?> <?=($incident_edit_details['cp_1_father_id_type']==$value['cm_document_type_master_master_id_pk'])?'selected':''?>><?php echo $value['description']?></option> -->
                                                <!-- <?php } ?> -->
                                                <!-- </select> -->
                                             </td>
                                             <td>
                                                <!-- <select class="form-control" name="cp_one_mother_id_type"> -->
                                                <!-- <option value="" selected="" disabled="">--Select--</option> -->
                                                <!-- <?php foreach($document_type_details as $value){?> -->
                                                <!-- <option value="<?php echo $value['cm_document_type_master_master_id_pk']?>"<?php echo set_select('cp_one_mother_id_type', $value['cm_document_type_master_master_id_pk']); ?> <?=($incident_edit_details['cp_1_mother_id_type']==$value['cm_document_type_master_master_id_pk'])?'selected':''?> ><?php echo $value['description']?></option> -->
                                                <!-- <?php } ?> -->
                                                <!-- </select> -->
                                                <?php
                                                   if($incident_edit_details['cp_1_mother_id_type']!='')
                                                   {
                                                      echo $doc_available[$incident_edit_details['cp_1_mother_id_type']];
                                                   }
                                                   else
                                                   {
                                                      echo "nil";
                                                   }
                                                ?>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Alive<font color="red">*</font>
                                             </td>
                                             <td style="text-align: left;">
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_one_father_alive"
                                                          value="1"
                                                          <?php echo set_radio('cp_one_father_alive', '1'); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_1_father_alive']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_one_father_alive"
                                                          value="2"
                                                          <?php echo set_radio('cp_one_father_alive', '2'); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_1_father_alive']==2)?'checked':'':''?>>&nbsp;No</label>
                                             </td>
                                             <td style="text-align: left;">
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_one_mother_alive"
                                                          value="1"
                                                          <?php echo set_radio('cp_one_mother_alive', '1'); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_1_mother_alive']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_one_mother_alive"
                                                          value="2"
                                                          <?php echo set_radio('cp_one_mother_alive', '2'); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_1_mother_alive']==2)?'checked':'':''?>>&nbsp;No</label>
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <hr style="border: 1px solid gray;">
                              <div class="card-body">
                                 <div class="form-group row">
                                    <div class="">
                                       <label class="badge badge-primary text-wrap"
                                              style=" font-size:medium;">Contracting Party Two Current Address</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group row">
                                 <label class="col-sm-3 col-form-label">Is Available? <font color="red">*</font></label>
                                 <div class="col-sm-5">
                                    <label class="radio-inline"><input type="radio"
                                              name="cp_two_is_available"
                                              class="cp_two_is_available_button"
                                              value="1"
                                              <?php echo set_radio('cp_two_is_available', '1'); ?>
                                              <?=($incident_edit_details)?($incident_edit_details['cp_two_is_available']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;

                                    <label class="radio-inline"><input type="radio"
                                              name="cp_two_is_available"
                                              class="cp_two_is_available_button"
                                              value="2"
                                              <?php echo set_radio('cp_two_is_available', '2'); ?>
                                              <?=($incident_edit_details)?($incident_edit_details['cp_two_is_available']==2)?'checked':'':''?>>&nbsp;No</label>&nbsp;&nbsp;
                                    <?php echo form_error('cp_two_is_available');?>
                                 </div>
                              </div>


                              <div id="cp_two_hide_show_div">
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Name</label>
                                       <div class="  col-xs-5">
                                          <input type="text"
                                                 class="form-control"
                                                 placeholder="Name"
                                                 name="cp_one_name"
                                                 id="cp_one_name"
                                                 autocomplete="off"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['cp_2_name']:''?>">
                                       </div>
                                    </div>

                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Street / Landmark</label>
                                       <div class="col-xs-5">
                                          <input type="text"
                                                 placeholder="Street / Landmark"
                                                 class="form-control"
                                                 id="cp_two_street_landmark"
                                                 autocomplete="off"
                                                 name="cp_two_street_landmark"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['cp_2_street_landmark']:set_value('cp_two_street_landmark'); ?>">
                                          <?php echo form_error('cp_two_street_landmark');?>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">State <font color="red">*</font></label>
                                       <div class="col-xs-5">
                                          <select class="form-control cp_two_state_box"
                                                  id="cp_two_state"
                                                  autocomplete="off"
                                                  name="cp_two_state">
                                             <!-- <option value="0" disabled selected>--Select State--</option> -->
                                             <?php foreach($state as $value){?>
                                             <option value="<?php echo $value['state_id_pk']; ?>"
                                                     <?php echo set_select('cp_two_state', $value['state_id_pk']); ?>
                                                     <?=($incident_edit_details)?($incident_edit_details['cp_2_state']==$value['state_id_pk'])?'selected':'':''?>>
                                                <?php echo $value['state_name']; ?></option>
                                             <?php } ?>
                                          </select>
                                       </div>
                                    </div>
                                    <?php if($incident_edit_details['cp_2_state']!=1){ ?>
                                    <div id="cp_two_address_div_two">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Address <font color="red">*</font></label>
                                          <div class="col-xs-5">
                                             <textarea class="form-control"
                                                       name="cp_two_address"
                                                       id="cp_two_address"
                                                       rows="3"
                                                       placeholder="Address"><?=($incident_edit_details)?$incident_edit_details['cp_2_address']:set_value('cp_two_address'); ?></textarea>
                                             <?php echo form_error('cp_two_address'); ?>
                                          </div>
                                       </div>
                                    </div>
                                    <?php } ?>
                                    <div id="cp_two_address_div_one">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">District <font color="red">*</font></label>
                                          <div class="col-xs-5">
                                             <select class="form-control district"
                                                     name="cp_two_district"
                                                     id="cp_two_district">
                                                <!-- <option disabled="" selected="" value="">--Please Select District--</option> -->
                                                <?php foreach($CP_Two_District_Details as $CP_Two_District_Value){ ?>
                                                <option value="<?php echo $CP_Two_District_Value['district_id_pk'];?>"
                                                        <?php echo set_select('cp_two_district', $CP_Two_District_Value['district_id_pk']); ?>
                                                        <?=($incident_edit_details)?($incident_edit_details['cp_2_district_id']==$CP_Two_District_Value['district_id_pk'])?'selected':'':''?>>
                                                   <?php echo $CP_Two_District_Value['district_name'];?></option>
                                                <?php } ?>
                                             </select>
                                             <?php echo form_error('cp_two_district'); ?>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Block / Municipality <font color="red">*</font></label>
                                          <div class="col-xs-5">
                                             <select class="form-control"
                                                     name="cp_two_block"
                                                     id="cp_two_block">
                                                <!-- <option disabled="" selected="" value="">--Please Select District First--</option> -->
                                                <?php foreach($cptwoBlock as $incidentBlockValue){ ?>
                                                <option value="<?php echo $incidentBlockValue['block_id_pk'];?>"
                                                        <?php echo set_select('cp_two_block', $incidentBlockValue['block_id_pk']); ?>
                                                        <?=($incident_edit_details)?($incident_edit_details['cp_2_block_id']==$incidentBlockValue['block_id_pk'])?'selected':'':''?>>
                                                   <?php echo $incidentBlockValue['block_name'];?></option>
                                                <?php } ?>
                                             </select>
                                             <?php echo form_error('cp_two_block'); ?>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Ward / GP <font color="red">*</font></label>
                                          <div class="col-xs-5">
                                             <select class="form-control"
                                                     id="cp_two_ward_gp"
                                                     autocomplete="off"
                                                     name="cp_two_ward_gp">
                                                <!-- <option value="0" disabled selected>--Select Block / Municipality First--</option> -->
                                                <?php if(!empty($Cp_Two_Ward_Gp_Block)){?>
                                                <?php if($Cp_Two_Ward_Gp_Block->rural_urban == 'U'){?>
                                                <?php foreach($Cp_Two_Ward as $Cp_Two_Ward_Value){ ?>
                                                <option value="<?php echo $Cp_Two_Ward_Value['ward_id_pk'];?>"
                                                        <?php echo set_select('cp_two_ward_gp', $Cp_Two_Ward_Value['ward_id_pk']); ?>
                                                        <?=($incident_edit_details)?($incident_edit_details['cp_2_ward_gp']==$Cp_Two_Ward_Value['ward_id_pk'])?'selected':'':''?>>
                                                   <?php echo $Cp_Two_Ward_Value['ward_no'];?></option>
                                                <?php } ?>
                                                <?php }else{?>
                                                <?php foreach($Cp_Two_Gp as $Cp_Two_GP_Value){ ?>
                                                <option value="<?php echo $Cp_Two_GP_Value['gp_id_pk'];?>"
                                                        <?php echo set_select('cp_two_ward_gp', $Cp_Two_GP_Value['gp_id_pk']); ?>
                                                        <?=($incident_edit_details)?($incident_edit_details['cp_2_ward_gp']==$Cp_Two_GP_Value['gp_id_pk'])?'selected':'':''?>>
                                                   <?php echo $Cp_Two_GP_Value['gp_name'];?></option>
                                                <?php } ?>
                                                <?php } } ?>
                                             </select>
                                             <?php echo form_error('cp_two_ward_gp');?>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Pin Code <font color="red">*</font></label>
                                       <div class="col-xs-5">
                                          <input type="text"
                                                 name="cp_two_pin_code"
                                                 id="cp_two_pin_code"
                                                 class="form-control cp_two_pin_code_vaidate"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['cp_2_pin_code']:set_value('cp_two_pin_code'); ?>"
                                                 placeholder="Pin Code"
                                                 maxlength="6"
                                                 onpaste="return false">
                                          <span id="cp_two_pin_code_lbl_error"
                                                style="color: red;"></span>
                                          <?php echo form_error('cp_two_pin_code'); ?>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Police Station <font color="red">*</font></label>
                                       <div class="col-xs-5">
                                          <input type="text"
                                                 class="form-control"
                                                 placeholder="Police Station"
                                                 name="cp_two_police_station"
                                                 id="cp_two_police_station"
                                                 autocomplete="off"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['cp_2_police_station']:set_value('cp_two_police_station'); ?>">
                                          <?php echo form_error('cp_two_police_station');?>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Phone No <font color="red">*</font></label>
                                       <div class="col-xs-5">
                                          <input type="text"
                                                 name="cp_two_phone_no"
                                                 id="cp_two_phone_no"
                                                 class="form-control cp_two_phone_no_vaidate"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['cp_2_phone_no']:set_value('cp_two_phone_no'); ?>"
                                                 placeholder="Phone No"
                                                 maxlength="10"
                                                 onpaste="return false">
                                          <span id="cp_two_phone_no_lbl_error"
                                                style="color: red;"></span>
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
                                             <?php foreach($gender_details as $value){?>
                                             <div class="inp-radio">
                                                <label class="radio-inline"><input type="radio"
                                                          class="cp_two_gender_val"
                                                          name="cp_two_gender"
                                                          value="<?php echo $value['cm_gender_master_id_pk']?>"
                                                          <?php echo set_radio('cp_two_gender', $value['cm_gender_master_id_pk']); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_2_gender']==$value['cm_gender_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
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
                                             <?php foreach($social_category_details as $value){?>
                                             <div class="inp-radio">
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_two_social_category"
                                                          value="<?php echo $value['cm_social_category_master_id_pk']?>"
                                                          <?php echo set_radio('cp_two_social_category', $value['cm_social_category_master_id_pk']); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_2_social_category']==$value['cm_social_category_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
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
                                             <?php foreach($religion_details as $value){?>
                                             <div class="inp-radio">
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_two_religion"
                                                          value="<?php echo $value['cm_religion_master_id_pk']?>"
                                                          <?php echo set_radio('cp_two_religion', $value['cm_religion_master_id_pk']); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_2_religion']==$value['cm_religion_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
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
                                       <label class="col-xs-3 col-form-label">Date of Birth (dd/mm/yyyy) <font color="red">*</font></label>
                                       <div class="col-xs-5">
                                          <input type="text"
                                                 class="form-control datepicker"
                                                 data-date-end-date="0d"
                                                 id="cp_two_dob"
                                                 placeholder="Date of Birth"
                                                 autocomplete="off"
                                                 name="cp_two_dob"
                                                 value="<?php echo !empty($incident_edit_details['cp_2_dob']) ? date('d-m-Y', strtotime($incident_edit_details['cp_2_dob'])) : ''; ?>"
                                                 style="background-color: white;"
                                                 readonly
                                                 tabindex="7">
                                          <?php echo form_error('cp_two_dob');?>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Age <font color="red">*</font></label>
                                       <div class="col-xs-5">
                                          <input type="text"
                                                 class="form-control js-input-mobile"
                                                 name="cp_two_age"
                                                 id="cp_two_age"
                                                 autocomplete="off"
                                                 placeholder="Age"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['cp_2_age']:set_value('cp_two_age'); ?>"
                                                 maxlength="2"
                                                 readonly
                                                 style="cursor: not-allowed;">
                                          <?php echo form_error('cp_two_age');?>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">DOB document available?</label>
                                       <div class="col-sm-6">
                                          <label class="radio-inline"><input type="radio"
                                                    name="cp_two_dob_document_available"
                                                    class="dob_document_cp_two"
                                                    value="1"
                                                    <?php echo set_radio('cp_two_dob_document_available', '1'); ?>
                                                    <?=($incident_edit_details)?($incident_edit_details['cp_2_dob_document_available']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;
                                          <label class="radio-inline"><input type="radio"
                                                    name="cp_two_dob_document_available"
                                                    class="dob_document_cp_two"
                                                    value="2"
                                                    <?php echo set_radio('cp_two_dob_document_available', '2'); ?>
                                                    <?=($incident_edit_details)?($incident_edit_details['cp_2_dob_document_available']==2)?'checked':'':''?>>&nbsp;No</label>&nbsp;&nbsp;
                                          <?php echo form_error('cp_two_dob_document_available');?>
                                       </div>
                                    </div>
                                 </div>
                                 <?php if($incident_edit_details['cp_2_dob_document_available']==1){ ?>
                                 <div class="card-body"
                                      id="dob_document_available_cp_two">
                                    <div class="form-group row">
                                       <label class="col-xs-3 col-form-label">Document ID</label>
                                       <div class="col-xs-5">
                                          <input type="text"
                                                 class="form-control"
                                                 placeholder="Document ID"
                                                 name="cp_two_dob_document_id"
                                                 id="cp_two_dob_document_id"
                                                 autocomplete="off"
                                                 maxlength="10"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['cp_2_dob_document_id']:set_value('cp_two_dob_document_id'); ?>">
                                          <?php echo form_error('cp_two_dob_document_id');?>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Document Type</label>
                                       <div class="col-sm-9">
                                          <div class="des-loc">
                                             <?php foreach($document_type_details as $value){?>
                                             <div class="inp-radio">
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_two_dob_document_type"
                                                          value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                                          <?php echo set_radio('cp_two_dob_document_type', $value['cm_document_type_master_master_id_pk']); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_2_dob_document_type']==$value['cm_document_type_master_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                                             </div>
                                             <?php } ?>
                                             <?php echo form_error('cp_two_dob_document_type');?>
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
                                          <label class="radio-inline"><input type="radio"
                                                    name="cp_two_identity_document_available"
                                                    class="identity_document_cp_two"
                                                    value="1"
                                                    <?php echo set_radio('cp_two_identity_document_available', '1'); ?>
                                                    <?=($incident_edit_details)?($incident_edit_details['cp_2_identity_document_available']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;
                                          <label class="radio-inline"><input type="radio"
                                                    name="cp_two_identity_document_available"
                                                    class="identity_document_cp_two"
                                                    value="2"
                                                    <?php echo set_radio('cp_two_identity_document_available', '2'); ?>
                                                    <?=($incident_edit_details)?($incident_edit_details['cp_2_identity_document_available']==2)?'checked':'':''?>>&nbsp;No</label>&nbsp;&nbsp;
                                          <?php echo form_error('cp_two_identity_document_available');?>
                                       </div>
                                    </div>
                                 </div>
                                 <?php if($incident_edit_details['cp_2_identity_document_available']==1){ ?>
                                 <div class="card-body"
                                      id="identity_document_available_cp_two">
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Document ID</label>
                                       <div class="col-sm-6">
                                          <input type="text"
                                                 class="form-control"
                                                 placeholder="Document ID"
                                                 name="cp_two_identity_document_id"
                                                 id="cp_two_identity_document_id"
                                                 autocomplete="off"
                                                 maxlength="10"
                                                 value="<?=($incident_edit_details)?$incident_edit_details['cp_2_identity_document_id']:set_value('cp_two_identity_document_id'); ?>">
                                          <?php echo form_error('cp_two_identity_document_id');?>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Document Type</label>
                                       <div class="col-sm-9">
                                          <div class="des-loc">
                                             <?php foreach($document_type_details as $value){?>
                                             <div class="inp-radio">
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_two_identity_document_type"
                                                          value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                                          <?php echo set_radio('cp_two_identity_document_type', $value['cm_document_type_master_master_id_pk']); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_2_identity_document_type']==$value['cm_document_type_master_master_id_pk'])?'checked':'':''?>>&nbsp;<?php echo $value['description']?></label>&nbsp;&nbsp;
                                             </div>
                                             <?php } ?>
                                             <?php echo form_error('cp_two_identity_document_type');?>
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
                                             <?php foreach($highest_education_details as $value){?>
                                             <div class="inp-radio">
                                                <label class="radio-inline"><input type="radio"
                                                          name="cp_two_highest_educational_attainment"
                                                          value="<?php echo $value['cm_highest_educational_attainment_master_id_pk']?>"
                                                          <?php echo set_radio('cp_two_highest_educational_attainment', $value['cm_highest_educational_attainment_master_id_pk']); ?>
                                                          <?=($incident_edit_details)?($incident_edit_details['cp_2_highest_educational_attainment']==$value['cm_highest_educational_attainment_master_id_pk'])?'checked':'':''?>>&nbsp;
                                                   <?php echo $value['description']?></label>&nbsp;&nbsp;
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
                                             <table class="table table-bordered"
                                                    id="documents_collected_table_field">
                                                <tr style="background-color: gray; color: #FFFFFF;">
                                                   <th colspan="2"
                                                       style="text-align: center;">Father of Contracting Party</th>
                                                   <th style="text-align: center;">Mother of Contracting Party</th>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">Name</td>
                                                   <td>
                                                      <input type="text"
                                                             class="form-control"
                                                             id="cp_two_father_name"
                                                             name="cp_two_father_name"
                                                             value="<?=($incident_edit_details)?$incident_edit_details['cp_2_father_name']:set_value('cp_two_father_name'); ?>"
                                                             onkeypress="return CP_Two_Father_Name_Validate(event);">
                                                      <span id="cp_two_father_name_lbl_error"
                                                            style="color: red;float: left;"></span>
                                                      <?php echo form_error('cp_two_father_name');?>
                                                   </td>
                                                   <td>
                                                      <input type="text"
                                                             class="form-control"
                                                             id="cp_two_mother_name"
                                                             name="cp_two_mother_name"
                                                             value="<?=($incident_edit_details)?$incident_edit_details['cp_2_mother_name']:set_value('cp_two_mother_name'); ?>"
                                                             onkeypress="return CP_Two_Mother_Name_Validate(event);">
                                                      <span id="cp_two_mother_name_lbl_error"
                                                            style="color: red;float: left;"></span>
                                                      <?php echo form_error('cp_two_mother_name');?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">Phone No</td>
                                                   <td>
                                                      <input type="text"
                                                             class="form-control"
                                                             name="cp_two_father_mobile_no"
                                                             id="cp_two_father_mobile_no"
                                                             onkeyup="cp_two_father_mobile_number_validation()"
                                                             maxlength="10"
                                                             value="<?=($incident_edit_details)?$incident_edit_details['cp_2_father_mobile_no']:set_value('cp_two_father_mobile_no'); ?>"
                                                             onpaste="return false">
                                                      <span id="cp_two_father_mobile_lbl_error"
                                                            style="color: red;float: left;"></span>
                                                      <?php echo form_error('cp_two_father_mobile_no');?>
                                                   </td>
                                                   <td>
                                                      <input type="text"
                                                             class="form-control"
                                                             name="cp_two_mother_mobile_no"
                                                             id="cp_two_mother_mobile_no"
                                                             onkeyup="cp_two_mother_mobile_number_validation()"
                                                             maxlength="10"
                                                             value="<?=($incident_edit_details)?$incident_edit_details['cp_2_mother_mobile_no']:set_value('cp_two_mother_mobile_no'); ?>"
                                                             onpaste="return false">
                                                      <span id="cp_two_mother_mobile_lbl_error"
                                                            style="color: red;float: left;"></span>
                                                      <?php echo form_error('cp_two_mother_mobile_no');?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">ID</td>
                                                   <td>
                                                      <input type="text"
                                                             class="form-control"
                                                             name="cp_two_father_id"
                                                             value="<?=($incident_edit_details)?$incident_edit_details['cp_2_father_id']:set_value('cp_two_father_id'); ?>">
                                                      <?php echo form_error('cp_two_father_id');?>
                                                   </td>
                                                   <td>
                                                      <input type="text"
                                                             class="form-control"
                                                             name="cp_two_mother_id"
                                                             value="<?=($incident_edit_details)?$incident_edit_details['cp_2_mother_id']:set_value('cp_two_mother_id'); ?>">
                                                      <?php echo form_error('cp_two_mother_id');?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">ID Type</td>
                                                   <td>
                                                      <select class="form-control"
                                                              name="cp_two_father_id_type">
                                                         <!-- <option value="0" selected="" disabled="">--Select--</option> -->
                                                         <?php foreach($document_type_details as $value){?>
                                                         <option value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                                                 <?php echo set_select('cp_two_father_id_type', $value['cm_document_type_master_master_id_pk']); ?>
                                                                 <?=($incident_edit_details['cp_2_father_id_type']==$value['cm_document_type_master_master_id_pk'])?'selected':''?>>
                                                            <?php echo $value['description']?></option>
                                                         <?php } ?>
                                                      </select>
                                                      <?php echo form_error('cp_two_father_id_type');?>
                                                   </td>
                                                   <td>
                                                      <select class="form-control"
                                                              name="cp_two_mother_id_type">
                                                         <!-- <option value="0" selected="" disabled="">--Select--</option> -->
                                                         <?php foreach($document_type_details as $value){?>
                                                         <option value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
                                                                 <?php echo set_select('cp_two_mother_id_type', $value['cm_document_type_master_master_id_pk']); ?>
                                                                 <?=($incident_edit_details['cp_2_mother_id_type']==$value['cm_document_type_master_master_id_pk'])?'selected':''?>>
                                                            <?php echo $value['description']?></option>
                                                         <?php } ?>
                                                      </select>
                                                      <?php echo form_error('cp_two_mother_id_type');?>
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">Alive</td>
                                                   <td style="text-align: left;">
                                                      <label class="radio-inline"><input type="radio"
                                                                name="cp_two_father_alive"
                                                                value="1"
                                                                <?php echo set_radio('cp_two_father_alive', '1'); ?>
                                                                <?=($incident_edit_details)?($incident_edit_details['cp_2_father_alive']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;
                                                      <label class="radio-inline"><input type="radio"
                                                                name="cp_two_father_alive"
                                                                value="2"
                                                                <?php echo set_radio('cp_two_father_alive', '2'); ?>
                                                                <?=($incident_edit_details)?($incident_edit_details['cp_2_father_alive']==2)?'checked':'':''?>>&nbsp;No</label>
                                                      <?php echo form_error('cp_two_father_alive');?>
                                                   </td>
                                                   <td style="text-align: left;">
                                                      <label class="radio-inline"><input type="radio"
                                                                name="cp_two_mother_alive"
                                                                value="1"
                                                                <?php echo set_radio('cp_two_mother_alive', '1'); ?>
                                                                <?=($incident_edit_details)?($incident_edit_details['cp_2_mother_alive']==1)?'checked':'':''?>>&nbsp;Yes</label>&nbsp;&nbsp;
                                                      <label class="radio-inline"><input type="radio"
                                                                name="cp_two_mother_alive"
                                                                value="2"
                                                                <?php echo set_radio('cp_two_mother_alive', '1'); ?>
                                                                <?=($incident_edit_details)?($incident_edit_details['cp_2_mother_alive']==2)?'checked':'':''?>>&nbsp;No</label>
                                                      <?php echo form_error('cp_two_mother_alive');?>
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
                     <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
               </div>
            </div>
         </div>
         </section>
      </div>
   </div>
   </div>
   <script type="text/javascript">
  $('input[type="radio"]').on('click', function(event) {
    event.preventDefault(); // Prevent the default click action for radio buttons
    // Optionally, add other actions or leave this empty to prevent the click
});
  $('input[type="text"]').prop('disabled', true);
  $('select').prop('disabled', true);
   </script>

<script type="text/javascript">
setTimeout(window.close, 15000);
</script>

</body>