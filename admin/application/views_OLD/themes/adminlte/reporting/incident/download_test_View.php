 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
  <?php
foreach($incident_edit_details as $value){
    $incident_id = $value['incident_id_pk'];
}
?>
<style>
   
</style>
<body>
   <div class="container">
   <div class="content-wrapper">
      <section class="content-header">
         <h2 class="text-center"><u>Incident Report</u></h2>
      </section>
      <section class="content">
         <div class="box bottom-box">
            <div class="row">
               <div class="col-md-12">
                  <div class="card card-default">
                     <div class="card-body p-0">
                        <div class="bs-stepper">
                           <div class="bs-stepper-header" role="tablist">
                              <div class="bs-stepper-content">
                                 <!-- your steps content here -->
                                 <div id="step-one" class="content" role="tabpanel" aria-labelledby="step-one-trigger">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 18rem; font-size:medium;">Prevention Incident&nbsp;<font color="red">*</font></label>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-lg-3 col-md-3 col-xs-3 col-xs-3 col-form-label">Incident Date&nbsp;(dd/mm/yyyy) <font color="red">*</font></label>
                                          <div class="col-lg-3 col-md-3 col-xs-3 col-xs-3">
                                             <input type="text" class="form-control date-picker" data-date-end-date="0d" id="incident_date" placeholder="Incident Date" readonly autocomplete="off" name="incident_date" value="<?php echo date('d/m/y', strtotime($value['incident_date'])); ?>" tabindex="7">
                                          </div>
                                          <div class="col-lg-3 col-md-2 col-sm-4 col-xs-3"></div>
                                          <div class="col-lg-3 col-md-2 col-sm-4 col-xs-3">
                                             <?php
                                                $mrg_dtl_val= '';
                                                if(set_value('marriage_details')){
                                                   $mrg_dtl_val= set_value('marriage_details');
                                                }elseif($incident_edit_details[0]['marriage_details']){
                                                   $mrg_dtl_val= $incident_edit_details[0]['marriage_details'];
                                                }else{
                                                   $mrg_dtl_val= '';
                                                }
                                                foreach($marriage_details as $key => $value){
                                                   if($key == 0){
                                                      $marriage_details_css = '';
                                                   }elseif($key == 1){
                                                      $marriage_details_css = '';
                                                   }else{
                                                      $marriage_details_css = '';
                                                   }
                                                ?>
                                             <span style="<?php echo $marriage_details_css; ?>"><?php echo $value['description']?></span><input type="radio" value="<?php echo $value['cm_marriage_master_id_pk']?>"
                                                <?php if($mrg_dtl_val==$value['cm_marriage_master_id_pk']){
                                                   echo "checked='checked'"; 
                                                   }else{
                                                   echo '';
                                                   }
                                                   ?>  
                                                name="marriage_details" class="mar-det" style="float: right;"><br>
                                             <?php } ?>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <div class="col-xs-3 col-xs-3">
                                             <label class=" col-form-label">Street / Landmark <font color="red">*</font></label>
                                          </div>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text" placeholder="Street / Landmark" class="form-control" id="street_landmark" autocomplete="off" name="street_landmark" value="<?php echo $incident_edit_details[0]['street_landmark']?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <div class="col-xs-3 col-xs-3">
                                             <label class="col-form-label">Ward / GP <font color="red">*</font></label>
                                          </div>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text" placeholder="Ward / GP" class="form-control" id="ward_gp" autocomplete="off" name="ward_gp" value="<?php echo $incident_edit_details[0]['ward_gp']?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <div class="col-xs-3 col-xs-3">
                                             <label class=" col-form-label">State <font color="red">*</font></label>
                                          </div>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text" placeholder="Ward / GP" class="form-control" id="state" autocomplete="off" name="state" value="West Bengal" readonly style="cursor: not-allowed;">
                                          </div>
                                          <div class="col-xs-1"></div>
                                          <div class="col-xs-3 col-xs-3">
                                             <div class="label-div">
                                                <label class="col-form-label font">Age of CP One <font color="red">*</font></label>
                                                <div class="inp">
                                                   <input type="text" class="form-control" placeholder="Age of Female" name="cp_one_age" id="cp_one_age" autocomplete="off" value="<?php echo $incident_edit_details[0]['cp_one_age']?>" readonly style="cursor: not-allowed;">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-xs-3 col-form-label">District <font color="red">*</font></label>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text" class="form-control" value="<?php echo $incident_edit_details[0]['incident_district']; ?>">
                                          </div>
                                          <div class="col-xs-1"></div>
                                          <div class="col-xs-3 col-xs-3">
                                             <div class="label-div">
                                                <label class="col-form-label label-div font">Age of CP Two&nbsp;<font color="red">*</font></label>
                                                <div class="inp">
                                                   <input type="text" class="form-control" placeholder="Age of Male" name="cp_two_age" id="cp_two_age" autocomplete="off" value="<?php echo $incident_edit_details[0]['cp_two_age']?>" readonly style="cursor: not-allowed;">
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-xs-3 col-form-label">SD/Block <font color="red">*</font></label>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text" class="form-control" value="<?php echo $incident_edit_details[0]['incident_block']; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-xs-3 col-form-label">Pin Code <font color="red">*</font></label>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text" class="form-control js-input-mobile" placeholder="Pin Code" name="pin_code" id="pin_code" autocomplete="off" maxlength="6" value="<?php echo $incident_edit_details[0]['pin_code']?>">
                                          </div>
                                          <div class="col-sm-2 col-xs-1"></div>
                                          <div class=" col-sm-2 col-xs-3 ">
                                             <?php
                                                $prevented_details_value= '';
                                                if(set_value('prevented_details')){
                                                   $prevented_details_value= set_value('prevented_details');
                                                }elseif($incident_edit_details[0]['prevented_details']){
                                                   $prevented_details_value= $incident_edit_details[0]['prevented_details'];
                                                }else{
                                                   $prevented_details_value= '';
                                                }
                                                foreach($prevented_details as $key => $value){
                                                   if($key == 0){
                                                   $prevented_details_css = '';
                                                   }else{
                                                      $prevented_details_css = '';
                                                   }
                                                ?>
                                             <span style="<?php echo $prevented_details_css; ?>"><?php echo $value['description']?></span><input type="radio" value="<?php echo $value['cm_incident_report_details_master_id_pk']?>"
                                                <?php if($prevented_details_value==$value['cm_incident_report_details_master_id_pk']){
                                                   echo "checked='checked'"; 
                                                   }else{
                                                   echo '';
                                                   }
                                                   ?>  
                                                class="prevented_details" name="prevented_details" id="prevented_details" style="float: right;"><br>
                                             <?php } ?>                                
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Police Station <font color="red">*</font></label>
                                          <div class="col-xs-5 col-xs-5">
                                             <input type="text" class="form-control" placeholder="Police Station" name="police_station" id="police_station" autocomplete="off" value="<?php echo $incident_edit_details[0]['cmir_police_station']?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Description of location <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   foreach($location_description_details as $key => $value){?>
                                                <div class="inp-radio">
                                                   <input type="radio" value="<?php echo $value['cm_location_master_id_pk']?>"
                                                      <?php 
                                                         if($location_description_value==$value['cm_location_master_id_pk']){
                                                            echo "checked='checked'"; 
                                                         }else{
                                                            echo '';
                                                         }
                                                         ?> 
                                                      name="location_description" id="location_description">&nbsp;<?php echo $value['description']?>
                                                </div>
                                                <?php } ?>   
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 42rem; font-size:medium;">Information First Received at SD/Block office from&nbsp;<font color="red">*</font></label>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Anonymous <font color="red">*</font></label>
                                          <div class="col-xs-5">
                                             <input type="radio" name="anonymous" id="anonymous" class="anonymous" value="1" <?php echo ($incident_edit_details[0]['anonymous']== '1') ?  "checked" : "" ;  ?>>&nbsp;Yes&nbsp;&nbsp;
                                             <input type="radio" name="anonymous" id="anonymous" class="anonymous" value="2" <?php echo ($incident_edit_details[0]['anonymous']== '2') ?  "checked" : "" ;  ?>>&nbsp;No&nbsp;&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <?php if($incident_edit_details[0]['anonymous']== '2'){?>
                                    <div class="card-body" id="Anonymous_1">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">If identity known Name <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
                                             <input type="text" class="form-control" placeholder="If identity known Name" name="identity_known_name" id="identity_known_name" autocomplete="off" value="<?php echo $incident_edit_details[0]['identity_known_name']?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Street / Landmark <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
                                             <input type="text" placeholder="Street / Landmark" class="form-control" id="identity_street_landmark" autocomplete="off" name="identity_street_landmark" value="<?php echo $incident_edit_details[0]['identity_street_landmark']?>">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="Anonymous_2">
                                       <div class="left-form">
                                          <div class="form-group row">
                                             <label class="col-xs-3 col-form-label">Ward / GP <font color="red">*</font></label>
                                             <div class="col-xs-5">
                                                <input type="text" placeholder="Ward / GP" class="form-control" id="identity_ward_gp" autocomplete="off" name="identity_ward_gp" value="<?php echo $incident_edit_details[0]['identity_ward_gp']?>">
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                             <label class="col-xs-3 col-form-label">State <font color="red">*</font></label>
                                             <div class="col-xs-5">
                                                <input type="text" placeholder="Ward / GP" class="form-control" id="identity_state" autocomplete="off" name="identity_state" value="West Bengal" readonly style="cursor: not-allowed;">
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                             <label class="col-xs-3 col-form-label">District <font color="red">*</font></label>
                                             <div class="col-xs-5">
                                                <select class="form-control district" name="identity_district" id="identity_district">
                                                   <?php foreach($districts as $district){ ?> 
                                                   <option value="<?php echo $district['district_id_pk'];?>" <?php echo set_select('identity_district', $district['district_id_pk'], False); ?><?php if($incident_edit_details[0]['identity_district']==$district['district_id_pk']){ echo "selected"; }?>><?php echo $district['district_name'];?></option>
                                                   <?php } ?>                     
                                                </select>
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                             <label class="col-xs-3 col-form-label">SD/Block <font color="red">*</font></label>
                                             <div class="col-xs-5">
                                                <select class="form-control" name="identity_block" id="identity_block">
                                                   <?php foreach($identityBlock as $incidentBlockValue){ ?>
                                                   <option value="<?php echo $incidentBlockValue['block_id_pk'];?>" <?php echo set_select('identity_block', $incidentBlockValue['block_id_pk']); ?> <?php if($incidentBlockValue['block_id_pk'] == $incident_edit_details[0]['identity_block']){ echo "selected"; }?>><?php echo $incidentBlockValue['block_name'];?></option>
                                                   <?php } ?>
                                                </select>
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                             <label class="col-xs-3 col-form-label">Pin Code <font color="red">*</font></label>
                                             <div class="col-xs-5">
                                                <input type="text" class="form-control js-input-mobile" placeholder="Pin Code" name="identity_pin_code" id="identity_pin_code" autocomplete="off" maxlength="6" value="<?php echo $incident_edit_details[0]['identity_pin_code']?>">
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                             <label class="col-xs-3 col-form-label">Police Station <font color="red">*</font></label>
                                             <div class="col-xs-5">
                                                <input type="text" class="form-control" placeholder="Police Station" name="identity_police_station" id="identity_police_station" autocomplete="off"  value="<?php echo $incident_edit_details[0]['identity_police_station']?>">
                                             </div>
                                          </div>
                                          <div class="form-group row">
                                             <label class="col-xs-3 col-form-label">Phone No <font color="red">*</font></label>
                                             <div class="col-xs-5">
                                                <input type="text" class="form-control js-input-mobile" placeholder="Phone No" name="identity_phone_no" id="identity_phone_no" autocomplete="off" maxlength="10" value="<?php echo $incident_edit_details[0]['identity_phone_no']?>">
                                             </div>
                                          </div>
                                          <div class="form-group row new">
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
                                                   $count = 0;
                                                   $query = Get_Print_Local_Person_Details($incident_id);
                                                   $queryArray =($this->input->post('Local_Persons_Involved_Details'))?set_value('Local_Persons_Involved_Details'):$query;
                                                   foreach($queryArray as $key => $value){$count ++;
                                                   ?>
                                                <input type="hidden" name="sl_no[<?=$key?>]" value="<?=(isset($value['sl_no']))?$value['sl_no']:set_value('sl_no['.$key.']')?>">
                                                <input type="hidden" name="Local_Persons_Involved_Details[<?=$key?>][lpi_id]" value="<?=(isset($value['sl_no']))?$value['sl_no']:set_value('Local_Persons_Involved_Details['.$key.'][lpi_id]')?>">
                                                <tr id="delete_local_person_row<?php if($this->input->post('Local_Persons_Involved_Details')){ echo $count++; ?><?php }else{?><?php echo $value['sl_no']; ?><?php } ?>">
                                                   <td><input type="text" class="form-control" name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_name]" value="<?php echo $value['local_person_name']; ?>" placeholder="Name, if available"></td>
                                                   <td><input type="radio" name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_gender]" value="1" <?php if(isset($value['local_person_gender'])){if($value['local_person_gender'] == '1'){ echo "checked"; }}?>></td>
                                                   <td><input type="radio" name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_gender]" value="2" <?php if(isset($value['local_person_gender'])){if($value['local_person_gender'] == '2'){ echo "checked"; }}?>></td>
                                                   <td><input type="text" class="form-control" name="Local_Persons_Involved_Details[<?php echo $key ?>][local_person_occupation_identity]" value="<?php echo $value['local_person_occupation_identity']; ?>" placeholder="Occupation / Identity"></td>
                                                </tr>
                                                <?php } ?>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                    <footer></footer>
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
                                                   $count = 0;
                                                   $query = Get_Print_Officials_Involved_Details($incident_id);
                                                   if($this->input->post('Officials_Involved_Details')){
                                                      $OfficialsQueryArray = set_value('Officials_Involved_Details');
                                                   }else{
                                                      $OfficialsQueryArray = $query;
                                                   }
                                                   foreach($OfficialsQueryArray as $key => $value){$count ++;
                                                   ?>
                                                <input type="hidden" name="sl_no_oi[<?=$key?>]" value="<?=(isset($value['sl_no']))?$value['sl_no']:set_value('sl_no_oi['.$key.']')?>">
                                                <input type="hidden" name="Officials_Involved_Details[<?=$key?>][ol_id]" value="<?=(isset($value['sl_no']))?$value['sl_no']:set_value('Officials_Involved_Details['.$key.'][ol_id]')?>">
                                                <tr id="delete_officials_involved_row<?php if($this->input->post('Officials_Involved_Details')){ echo $count++; ?><?php }else{?><?php echo $value['sl_no']; ?><?php } ?>">
                                                   <td><input type="text" class="form-control" name="Officials_Involved_Details[<?php echo $key ?>][official_involved_name]" placeholder="Name" value="<?php echo $value['official_involved_name']; ?>"></td>
                                                   <td><input type="text" class="form-control" name="Officials_Involved_Details[<?php echo $key ?>][officials_involved_designation]" placeholder="Designation" value="<?php echo $value['officials_involved_designation']; ?>"></td>
                                                   <td><input type="text" class="form-control" name="Officials_Involved_Details[<?php echo $key ?>][officials_involved_office]" placeholder="Office" value="<?php echo $value['officials_involved_office']; ?>"></td>
                                                   <td><input type="text" class="form-control js-input-mobile" name="Officials_Involved_Details[<?php echo $key ?>][officials_involved_contact_no]" placeholder="Contact No" maxlength="10" value="<?php echo $value['officials_involved_contact_no']; ?>"></td>
                                                </tr>
                                                <?php } ?>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div id="step-two" class="content" role="tabpanel" aria-labelledby="step-two-trigger">
                                    <div class="card-body" style="margin-top: 20px;margin-bottom: 20px ">
                                       <div class="form-group row">
                                          <label class="col-sm-12 col-form-label badge badge-Primary text-wrap " style="width: 24rem; font-size:medium;">Contracting Party One&nbsp;<font color="red">*</font></label>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Name <font color="red">*</font></label>
                                          <div class="  col-xs-9">
                                             <input type="text" class="form-control" placeholder="Name" name="cp_one_name" id="cp_one_name" autocomplete="off" value="<?php echo $incident_edit_details[0]['cp_one_name']?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Street / Landmark <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
                                             <input type="text" placeholder="Street / Landmark" class="form-control" id="cp_one_street_landmark" autocomplete="off" name="cp_one_street_landmark" value="<?php echo $incident_edit_details[0]['cp_one_street_landmark']?>">  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Ward / GP <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" placeholder="Ward / GP" class="form-control" id="cp_one_ward_gp" autocomplete="off" name="cp_one_ward_gp" value="<?php echo $incident_edit_details[0]['cp_one_ward_gp']?>">  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">State <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" placeholder="Ward / GP" class="form-control" id="cp_one_state" autocomplete="off" name="cp_one_state" value="West Bengal" readonly style="cursor: not-allowed;">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">District <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control district" name="cp_one_district" id="cp_one_district">
                                                <?php foreach($districts as $district){ ?> 
                                                <option value="<?php echo $district['district_id_pk'];?>" <?php echo set_select('cp_one_district', $district['district_id_pk'], False); ?> <?php if($incident_edit_details[0]['cp_one_district']==$district['district_id_pk']){ echo "selected"; }?>><?php echo $district['district_name'];?></option>
                                                <?php } ?>                     
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">SD/Block <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control" name="cp_one_block" id="cp_one_block">
                                                <?php foreach($cponeBlock as $cponeBlockValue){ ?>
                                                <option value="<?php echo $cponeBlockValue['block_id_pk'];?>" <?php echo set_select('cp_one_block', $cponeBlockValue['block_id_pk']); ?> <?php if($cponeBlockValue['block_id_pk'] == $incident_edit_details[0]['cp_one_block']){ echo "selected"; }?>><?php echo $cponeBlockValue['block_name'];?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Pin Code <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control js-input-mobile" placeholder="Pin Code" name="cp_one_pin_code" id="cp_one_pin_code" autocomplete="off" maxlength="6" value="<?php echo $incident_edit_details[0]['cp_one_pin_code']?>">  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Police Station <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" placeholder="Police Station" name="cp_one_police_station" id="cp_one_police_station" autocomplete="off" value="<?php echo $incident_edit_details[0]['cp_one_police_station']?>">  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Phone No <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control js-input-mobile" placeholder="Phone No" name="cp_one_phone_no" id="cp_one_phone_no" autocomplete="off" maxlength="10" value="<?php echo $incident_edit_details[0]['cp_one_phone_no']?>"> 
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Gender <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
                                             <div class="des-loc">
                                                <?php
                                                   $gd= '';
                                                   $gender_details_value = $incident_edit_details[0]['cp_one_gender'];
                                                   foreach($gender_details as $value){
                                                    if((set_radio('cp_one_gender',$value['cm_gender_master_id_pk']))!=''){
                                                       $gd = $value['cm_gender_master_id_pk'];
                                                     }
                                                   }
                                                   foreach($gender_details as $value){
                                                    if(($gender_details_value==$value['cm_gender_master_id_pk']) && $gd=='' ){
                                                       $gd = $value['cm_gender_master_id_pk'];
                                                    }
                                                    ?>
                                                <div class="inp-radio">
                                                   <input type="radio" value="<?php echo $value['cm_gender_master_id_pk']?>"
                                                      <?php 
                                                         if($gd==$value['cm_gender_master_id_pk']){echo "checked='checked'"; 
                                                         }else{
                                                            echo '';
                                                         }
                                                         ?> class="cp_one_gender_val"  name="cp_one_gender" >&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Social Category <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   foreach($social_category_details as $value){?>
                                                <div class="inp-radio">
                                                   <input type="radio" value="<?php echo $value['cm_social_category_master_id_pk']?>"
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
                                                      name="cp_one_social_category" >&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Religion <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   foreach($religion_details as $value){
                                                   ?>
                                                <div class="inp-radio">
                                                   <input type="radio" value="<?php echo $value['cm_religion_master_id_pk']?>"
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
                                                      name="cp_one_religion" >&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Date of Birth (dd/mm/yyyy) <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control date-picker" data-date-end-date="0d" id="cp_one_dob" placeholder="DATE OF BIRTH" autocomplete="off" name="cp_one_dob" value="<?php echo date('d/m/Y', strtotime($incident_edit_details[0]['cp_one_dob'])); ?>" tabindex="7">  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">DOB document available? <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
                                             <input type="radio" name="cp_one_dob_document_available" class="dob_document_cp_one" value="1" <?php echo set_radio('cp_one_dob_document_available', '1'); ?><?php echo ($incident_edit_details[0]['cp_one_dob_document_available']== '1') ?  "checked" : "" ;  ?>>&nbsp;Yes&nbsp;&nbsp;
                                             <input type="radio" name="cp_one_dob_document_available" class="dob_document_cp_one" value="2" <?php echo set_radio('cp_one_dob_document_available', '2'); ?><?php echo ($incident_edit_details[0]['cp_one_dob_document_available']== '2') ?  "checked" : "" ;  ?>>&nbsp;No&nbsp;&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="dob_document_available_cp_one" <?php if($incident_edit_details[0]['cp_one_dob_document_available'] == 1){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Document ID <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" placeholder="Document ID" name="cp_one_dob_document_id" id="cp_one_dob_document_id" autocomplete="off" value="<?php echo $incident_edit_details[0]['cp_one_dob_document_id']; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Document Type <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   foreach($document_type_details as $value){?>
                                                <div class="inp-radio">
                                                   <input type="radio" value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
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
                                                      name="cp_one_dob_document_type">&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Identity document available? <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
                                             <input type="radio" name="cp_one_identity_document_available" class="identity_document_cp_one" value="1" <?php echo set_radio('cp_one_identity_document_available', '1'); ?><?php echo ($incident_edit_details[0]['cp_one_identity_document_available']== '1') ?  "checked" : "" ;  ?>>&nbsp;Yes&nbsp;&nbsp;
                                             <input type="radio" name="cp_one_identity_document_available" class="identity_document_cp_one" value="2" <?php echo set_radio('cp_one_identity_document_available', '2'); ?><?php echo ($incident_edit_details[0]['cp_one_identity_document_available']== '2') ?  "checked" : "" ;  ?>>&nbsp;No&nbsp;&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="identity_document_available_cp_one" <?php if($incident_edit_details[0]['cp_one_identity_document_available'] == 1){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Document ID <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" placeholder="Document ID" name="cp_one_identity_document_id" value="<?php echo $incident_edit_details[0]['cp_one_identity_document_id']?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Document Type <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   <input type="radio" value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
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
                                                      name="cp_one_identity_document_type">&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Highest Educational Attainment <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   <input type="radio" value="<?php echo $value['cm_highest_educational_attainment_master_id_pk']?>"
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
                                                      name="cp_one_highest_educational_attainment">&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
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
                                                   <th colspan="2" style="text-align: center;">Father of Contracting Party 1</th>
                                                   <th style="text-align: center;">Mother of Contracting Party 1</th>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">Name <font color="red">*</font></td>
                                                   <td>
                                                      <input type="text" class="form-control" name="cp_one_father_name" value="<?php echo $incident_edit_details[0]['cp_one_father_name']?>">                                             
                                                   </td>
                                                   <td>
                                                      <input type="text" class="form-control" name="cp_one_mother_name" value="<?php echo $incident_edit_details[0]['cp_one_mother_name']?>"> 
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">Phone No <font color="red">*</font></td>
                                                   <td>
                                                      <input type="text" class="form-control js-input-mobile" name="cp_one_father_mobile_no" maxlength="10" value="<?php echo $incident_edit_details[0]['cp_one_father_mobile_no']?>">  
                                                   </td>
                                                   <td>
                                                      <input type="text" class="form-control js-input-mobile" name="cp_one_mother_mobile_no" maxlength="10" value="<?php echo $incident_edit_details[0]['cp_one_mother_mobile_no']?>">  
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">ID <font color="red">*</font></td>
                                                   <td>
                                                      <input type="text" class="form-control" name="cp_one_father_id" value="<?php echo $incident_edit_details[0]['cp_one_father_id']?>"> 
                                                   </td>
                                                   <td>
                                                      <input type="text" class="form-control" name="cp_one_mother_id" value="<?php echo $incident_edit_details[0]['cp_one_mother_id']?>"> 
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">ID Type <font color="red">*</font></td>
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
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">Alive<font color="red">*</font></td>
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
                                                      <input type="radio" value="1" name="cp_one_father_alive"
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
                                                         >&nbsp;Yes&nbsp;&nbsp;
                                                      <input type="radio" value="2" name="cp_one_father_alive"
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
                                                         >&nbsp;No&nbsp;&nbsp;
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
                                                      <input type="radio" value="1" name="cp_one_mother_alive"
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
                                                         >&nbsp;Yes&nbsp;&nbsp;
                                                      <input type="radio" value="2" name="cp_one_mother_alive"
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
                                                         >&nbsp;No&nbsp;&nbsp;
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
                                             <label class="badge badge-primary text-wrap" style=" font-size:medium;">Contracting Party One Current Address</label>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label cp_one_minor_sent">Minor Sent to <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-9">
                                             <?php
                                                $cp_one_cwc_minor_sent_to_val= '';
                                                if(set_value('cp_one_cwc_minor_sent_to'))
                                                {
                                                   $cp_one_cwc_minor_sent_to_val= set_value('cp_one_cwc_minor_sent_to');
                                                }
                                                elseif($incident_edit_details[0]['minor_sent'])
                                                {
                                                   $cp_one_cwc_minor_sent_to_val= $incident_edit_details[0]['minor_sent'];
                                                }
                                                else
                                                {
                                                   $cp_one_cwc_minor_sent_to_val= '';
                                                }
                                                foreach($minor_transfer_details as $value)
                                                {
                                                   ?>
                                             <span id="span<?php echo $value['sl_no']?>">
                                             <input type="radio" value="<?php echo $value['sl_no']?>"
                                                <?php 
                                                   if($cp_one_cwc_minor_sent_to_val==$value['sl_no'])
                                                   {
                                                      echo "checked ='checked'"; 
                                                   }
                                                   else
                                                   {
                                                      echo '';
                                                   }
                                                   ?>  
                                                class="cp_one_cwc_minor_sent_div" name="cp_one_cwc_minor_sent_to" id="cp_one_cwc_minor_sent_to">&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                             <?php } ?> 
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="cp_one_cwc_first_row" <?php if($incident_edit_details[0]['minor_sent'] == 4){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Case No <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" placeholder="Case No" class="form-control" id="cp_one_cwc_case_no" autocomplete="off" name="cp_one_cwc_case_no" value="<?php if(set_value('cp_one_cwc_case_no') != ''){?><?php echo set_value('cp_one_cwc_case_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['case_no']?><?php } ?>">  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Date <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control date-picker" data-date-end-date="0d" id="cp_one_cwc_case_date" placeholder="Date" readonly autocomplete="off" name="cp_one_cwc_case_date"  value="<?php if(set_value('cp_one_cwc_case_date') != ''){?><?php echo set_value('cp_one_cwc_case_date'); ?><?php }else{?><?php echo date('d/m/Y', strtotime($incident_edit_details[0]['case_date']))?><?php } ?>" tabindex="7">             
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="cp_one_cwc_second_row">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">State <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" id="cp_one_cwc_state" autocomplete="off" name="cp_one_cwc_state" value="West Bengal" readonly style="cursor: not-allowed;">  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">District <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control district" name="cp_one_cwc_district" id="cp_one_cwc_district">
                                                <?php foreach($districts as $district){ ?> 
                                                <option value="<?php echo $district['district_id_pk'];?>" <?php echo set_select('cp_one_cwc_district', $district['district_id_pk'], False); ?> <?php if($incident_edit_details[0]['cwc_district']==$district['district_id_pk']){ echo "selected"; }?>><?php echo $district['district_name'];?></option>
                                                <?php } ?>                     
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">SD/Block <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control" name="cp_one_cwc_block" id="cp_one_cwc_block">
                                                <?php foreach($cponecwcBlock as $incidentBlockValue){ ?>
                                                <option value="<?php echo $incidentBlockValue['block_id_pk'];?>" <?php echo set_select('cp_one_cwc_block', $incidentBlockValue['block_id_pk']); ?> <?php if($incidentBlockValue['block_id_pk'] == $incident_edit_details[0]['cp_one_cwc_block']){ echo "selected"; }?>><?php echo $incidentBlockValue['block_name'];?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="cp_one_cwc_third_row">
                                       <div class="form-group row" id="cp_one_cwc_cci_div" <?php if($incident_edit_details[0]['minor_sent'] == 4){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                          <label class="col-xs-3 col-form-label">CCI <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control district" name="cp_one_cwc_cci" id="cp_one_cwc_cci">
                                                <?php
                                                   $cp_one_cwc_cci_val= '';
                                                      if(set_value('cp_one_cwc_cci'))
                                                      {
                                                         $cp_one_cwc_cci_val= set_value('cp_one_cwc_cci');
                                                      }
                                                      elseif($incident_edit_details[0]['cci_details'])
                                                      {
                                                         $cp_one_cwc_cci_val= $incident_edit_details[0]['cci_details'];
                                                      }
                                                      else
                                                      {
                                                         $cp_one_cwc_cci_val= '';
                                                      }
                                                      ?>
                                                <?php foreach($cponecwcCCI as $value){
                                                   if($value['sl_no'] == $cp_one_cwc_cci_val){
                                                      $cci_one_sel='selected="selected"';
                                                   }
                                                   else{
                                                      $cci_one_sel='';
                                                   }
                                                   ?>
                                                <option value="<?php echo $value['sl_no']; ?>" <?php echo $cci_one_sel;?>><?php echo $value['cci_name']; ?></option>
                                                <?php  } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row" id="cp_one_cwc_address_div" <?php if($incident_edit_details[0]['minor_sent'] == 1 || $incident_edit_details[0]['minor_sent'] == 2 || $incident_edit_details[0]['minor_sent'] == 3){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                          <label class="col-xs-3 col-form-label">Address <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" id="cp_one_cwc_address" autocomplete="off" name="cp_one_cwc_address"  value="<?php if(set_value('cp_one_cwc_address') != ''){?><?php echo set_value('cp_one_cwc_address'); ?><?php }else{?><?php echo $incident_edit_details[0]['address']?><?php } ?>">
                                          </div>
                                       </div>
                                       <?php if($incident_edit_details[0]['remarks'] != ''){?>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Remarks <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <textarea rows="3" name="cp_one_cwc_remarks" class="form-control"><?php echo $incident_edit_details[0]['remarks']?></textarea>
                                          </div>
                                       </div>
                                       <?php } ?>
                                    </div>
                                 </div>
                                 <div id="step-three" class="content" role="tabpanel" aria-labelledby="step-three-trigger">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <div class="">
                                             <label class="badge badge-primary text-wrap" style=" font-size:medium;">Contracting Party Two <sup style="color: #FF0000">*</sup></label>  
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Name <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
                                             <input type="text" class="form-control" placeholder="Name" name="cp_two_name" id="cp_two_name" autocomplete="off" value="<?php if(set_value('cp_two_name') != ''){?><?php echo set_value('cp_two_name'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_name']?><?php } ?>">  
                                             <span id="male_name_error" style="color: red;"></span>  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Street / Landmark <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
                                             <input type="text" placeholder="Street / Landmark" class="form-control" id="cp_two_street_landmark" autocomplete="off" name="cp_two_street_landmark" value="<?php if(set_value('cp_two_street_landmark') != ''){?><?php echo set_value('cp_two_street_landmark'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_street_landmark']?><?php } ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Ward / GP <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" placeholder="Ward / GP" class="form-control" id="cp_two_ward_gp" autocomplete="off" name="cp_two_ward_gp" value="<?php if(set_value('cp_two_ward_gp') != ''){?><?php echo set_value('cp_two_ward_gp'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_ward_gp']?><?php } ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">State <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" placeholder="Ward / GP" class="form-control" id="cp_two_state" autocomplete="off" name="cp_two_state" value="West Bengal" readonly style="cursor: not-allowed;">  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">District <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control district" name="cp_two_district" id="cp_two_district">
                                                <?php foreach($districts as $district){ ?> 
                                                <option value="<?php echo $district['district_id_pk'];?>" <?php echo set_select('cp_two_district', $district['district_id_pk'], False); ?> <?php if($incident_edit_details[0]['cp_two_district']==$district['district_id_pk']){ echo "selected"; }?>><?php echo $district['district_name'];?></option>
                                                <?php } ?>                     
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">SD/Block <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control" name="cp_two_block" id="cp_two_block">
                                                <?php foreach($cptwoBlock as $incidentBlockValue){ ?>
                                                <option value="<?php echo $incidentBlockValue['block_id_pk'];?>" <?php echo set_select('cp_two_block', $incidentBlockValue['block_id_pk']); ?> <?php if($incidentBlockValue['block_id_pk'] == $incident_edit_details[0]['cp_two_block']){ echo "selected"; }?>><?php echo $incidentBlockValue['block_name'];?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Pin Code <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control js-input-mobile" placeholder="Pin Code" name="cp_two_pin_code" id="cp_two_pin_code" autocomplete="off" maxlength="6" value="<?php if(set_value('cp_two_pin_code') != ''){?><?php echo set_value('cp_two_pin_code'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_pin_code']?><?php } ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Police Station <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" placeholder="Police Station" name="cp_two_police_station" id="cp_two_police_station" autocomplete="off" value="<?php if(set_value('cp_two_police_station') != ''){?><?php echo set_value('cp_two_police_station'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_police_station']?><?php } ?>">
                                          </div>
                                       </div>
                                       <footer></footer>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Phone No <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control js-input-mobile" placeholder="Phone No" name="cp_two_phone_no" id="cp_two_phone_no" autocomplete="off" maxlength="10" value="<?php if(set_value('cp_two_phone_no') != ''){?><?php echo set_value('cp_two_phone_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_phone_no']?><?php } ?>">
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Gender <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   <input type="radio" value="<?php echo $value['cm_gender_master_id_pk']?>"
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
                                                      class="cp_two_gender_val" name="cp_two_gender">&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Social Category <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   <input type="radio" value="<?php echo $value['cm_social_category_master_id_pk']?>"
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
                                                      name="cp_two_social_category" >&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Religion <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   <input type="radio" value="<?php echo $value['cm_religion_master_id_pk']?>"
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
                                                      name="cp_two_religion" >&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Date of Birth (dd/mm/yyyy) <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control date-picker" data-date-end-date="0d" id="cp_two_dob" placeholder="DATE OF BIRTH" autocomplete="off" name="cp_two_dob" value="<?php if(set_value('cp_two_dob') != ''){?><?php echo set_value('cp_two_dob'); ?><?php }else{?><?php echo date('d/m/Y', strtotime($incident_edit_details[0]['cp_two_dob'])); ?><?php } ?>" readonly tabindex="7" onchange="ValidatefemaleDOB()">  
                                             <small class="notification_msg" id="female_dob_msg" style="color: red;"></small>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">DOB document available? <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="radio" name="cp_two_dob_document_available" class="dob_document_cp_two" value="1" <?php echo set_radio('cp_two_dob_document_available', '1'); ?><?php echo ($incident_edit_details[0]['cp_two_dob_document_available']== '1') ?  "checked" : "" ;  ?>>&nbsp;Yes&nbsp;&nbsp;
                                             <input type="radio" name="cp_two_dob_document_available" class="dob_document_cp_two" value="2" <?php echo set_radio('cp_two_dob_document_available', '2'); ?><?php echo ($incident_edit_details[0]['cp_two_dob_document_available']== '2') ?  "checked" : "" ;  ?>>&nbsp;No&nbsp;&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="dob_document_available_cp_two" <?php if($incident_edit_details[0]['cp_two_dob_document_available'] == 1){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Document ID <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" placeholder="Document ID" name="cp_two_dob_document_id" id="cp_two_dob_document_id" autocomplete="off" maxlength="10" value="<?php echo set_value('cp_two_dob_document_id'); ?> <?php echo $incident_edit_details[0]['cp_two_dob_document_id']; ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Document Type <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   <input type="radio" value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
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
                                                      name="cp_two_dob_document_type" >&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Identity document available? <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="radio" name="cp_two_identity_document_available" class="identity_document_cp_two" value="1" <?php echo set_radio('cp_two_identity_document_available', '1'); ?> <?php echo ($incident_edit_details[0]['cp_two_identity_document_available']== '1') ?  "checked" : "" ;  ?>>&nbsp;Yes&nbsp;&nbsp;
                                             <input type="radio" name="cp_two_identity_document_available" class="identity_document_cp_two" value="2" <?php echo set_radio('cp_two_identity_document_available', '2'); ?> <?php echo ($incident_edit_details[0]['cp_two_identity_document_available']== '2') ?  "checked" : "" ;  ?>>&nbsp;No&nbsp;&nbsp;
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="identity_document_available_cp_two" <?php if($incident_edit_details[0]['cp_two_identity_document_available'] == 1){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Document ID <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" placeholder="Document ID" name="cp_two_identity_document_id" autocomplete="off" maxlength="10" value="<?php if(set_value('cp_two_identity_document_id') != ''){?><?php echo set_value('cp_two_identity_document_id'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_identity_document_id']?><?php } ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Document Type <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   <input type="radio" value="<?php echo $value['cm_document_type_master_master_id_pk']?>"
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
                                                      name="cp_two_identity_document_type">&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                                </div>
                                                <?php } ?> 
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Highest Educational Attainment <font color="red">*</font></label>
                                          <div class="col-sm-9  col-xs-9">
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
                                                   <input type="radio" value="<?php echo $value['cm_highest_educational_attainment_master_id_pk']?>"
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
                                                      name="cp_two_highest_educational_attainment">&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
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
                                                   <td style="text-align: left; font-weight: bold;">Name <font color="red">*</font></td>
                                                   <td>
                                                      <input type="text" class="form-control" name="cp_two_father_name" value="<?php if(set_value ('cp_two_father_name') != ''){?><?php echo set_value('cp_two_father_name'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_father_name']?><?php } ?>"> 
                                                   </td>
                                                   <td>
                                                      <input type="text" class="form-control" name="cp_two_mother_name" value="<?php if(set_value('cp_two_mother_name') != ''){?><?php echo set_value('cp_two_mother_name'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_mother_name']?><?php } ?>"> 
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">Phone No <font color="red">*</font></td>
                                                   <td>
                                                      <input type="text" class="form-control js-input-mobile" name="cp_two_father_mobile_no" maxlength="10" value="<?php if(set_value('cp_two_father_mobile_no') != ''){?><?php echo set_value('cp_two_father_mobile_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_father_mobile_no']?><?php } ?>">
                                                   </td>
                                                   <td>
                                                      <input type="text" class="form-control js-input-mobile" name="cp_two_mother_mobile_no" maxlength="10" value="<?php if(set_value('cp_two_mother_mobile_no') != ''){?><?php echo set_value('cp_two_mother_mobile_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_mother_mobile_no']?><?php } ?>">
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">ID <font color="red">*</font></td>
                                                   <td>
                                                      <input type="text" class="form-control" name="cp_two_father_id" value="<?php if(set_value('cp_two_father_id') != ''){?><?php echo set_value('cp_two_father_id'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_father_id']?><?php } ?>">
                                                   </td>
                                                   <td>
                                                      <input type="text" class="form-control" name="cp_two_mother_id" value="<?php if(set_value('cp_two_mother_id') != ''){?><?php echo set_value('cp_two_mother_id'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_mother_id']?><?php } ?>">
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">ID Type <font color="red">*</font></td>
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
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td style="text-align: left; font-weight: bold;">Alive <font color="red">*</font></td>
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
                                                      <input type="radio" value="1" name="cp_two_father_alive"
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
                                                         >&nbsp;Yes&nbsp;&nbsp;
                                                      <input type="radio" value="2" name="cp_two_father_alive"
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
                                                         >&nbsp;No&nbsp;&nbsp;
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
                                                      <input type="radio" value="1" name="cp_two_mother_alive"
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
                                                         >&nbsp;Yes&nbsp;&nbsp;
                                                      <input type="radio" value="2" name="cp_two_mother_alive"
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
                                                         >&nbsp;No&nbsp;&nbsp;
                                                   </td>
                                                </tr>
                                             </table>
                                          </div>
                                       </div>
                                    </div>
                                    <hr style="border: 1px solid gray;">
                                    <footer></footer>
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <div class="">
                                             <label class="badge badge-primary text-wrap" style=" font-size:medium;">Contracting Party Two Current Address</label>  
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Minor Sent to <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <?php
                                                $cp_two_cwc_minor_sent_to_val= '';
                                                if(set_value('cp_two_cwc_minor_sent_to'))
                                                {
                                                   $cp_two_cwc_minor_sent_to_val= set_value('cp_two_cwc_minor_sent_to');
                                                }
                                                elseif($incident_edit_details[0]['cp_two_cwc_minor_sent'])
                                                {
                                                   $cp_two_cwc_minor_sent_to_val= $incident_edit_details[0]['cp_two_cwc_minor_sent'];
                                                }
                                                else
                                                {
                                                   $cp_two_cwc_minor_sent_to_val= '';
                                                }
                                                foreach($minor_transfer_details as $value)
                                                {
                                                   ?>
                                             <span id="span_1<?php echo $value['sl_no']?>">
                                             <input type="radio" value="<?php echo $value['sl_no']?>"
                                                <?php 
                                                   if($cp_two_cwc_minor_sent_to_val==$value['sl_no'])
                                                   {
                                                      echo "checked='checked'"; 
                                                   }
                                                   else
                                                   {
                                                      echo '';
                                                   }
                                                   ?>  
                                                class="cp_two_cwc_minor_sent_div" name="cp_two_cwc_minor_sent_to" id="cp_two_cwc_minor_sent_to">&nbsp;<?php echo $value['description']?>&nbsp;&nbsp;
                                             <?php } ?> 
                                             </span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="cp_two_cwc_first_row" <?php if($incident_edit_details[0]['cp_two_cwc_minor_sent'] == 4){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Case No <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" placeholder="Case No" class="form-control" id="cp_two_cwc_case_no" autocomplete="off" name="cp_two_cwc_case_no" value="<?php if(set_value('cp_two_cwc_case_no') != ''){?><?php echo set_value('cp_two_cwc_case_no'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_cwc_case_no']?><?php } ?>">
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Date <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control date-picker" data-date-end-date="0d" id="cp_two_cwc_case_date" placeholder="Date" readonly autocomplete="off" name="cp_two_cwc_case_date" value="<?php if(set_value('cp_two_cwc_case_date') != ''){?><?php echo set_value('cp_two_cwc_case_date'); ?><?php }else{?><?php echo date('d/m/Y', strtotime($incident_edit_details[0]['cp_two_cwc_case_date']))?><?php } ?>" tabindex="7">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="cp_two_cwc_second_row">
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">State <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" id="cp_two_cwc_state" autocomplete="off" name="cp_two_cwc_state" value="West Bengal" readonly style="cursor: not-allowed;">  
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">District <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control district" name="cp_two_cwc_district" id="cp_two_cwc_district">
                                                <?php foreach($districts as $district){ ?> 
                                                <option value="<?php echo $district['district_id_pk'];?>" <?php echo set_select('cp_two_cwc_district', $district['district_id_pk'], False); ?> <?php if($incident_edit_details[0]['cp_two_cwc_district']==$district['district_id_pk']){ echo "selected"; }?>><?php echo $district['district_name'];?></option>
                                                <?php } ?>                     
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">SD/Block <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control" name="cp_two_cwc_block" id="cp_two_cwc_block">
                                                <?php foreach($cptwocwcBlock as $incidentBlockValue){ ?>
                                                <option value="<?php echo $incidentBlockValue['block_id_pk'];?>" <?php echo set_select('cp_two_cwc_block', $incidentBlockValue['block_id_pk']); ?> <?php if($incidentBlockValue['block_id_pk'] == $incident_edit_details[0]['cp_two_cwc_block']){ echo "selected"; }?>><?php echo $incidentBlockValue['block_name'];?></option>
                                                <?php } ?>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="card-body" id="cp_two_cwc_third_row">
                                       <div class="form-group row" id="cp_two_cwc_cci_div" <?php if($incident_edit_details[0]['cp_two_cwc_minor_sent'] == 4){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                          <label class="col-xs-3 col-form-label">CCI <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <select class="form-control district" name="cp_two_cwc_cci" id="cp_two_cwc_cci">
                                                <?php
                                                   $cp_two_cwc_cci_val= '';
                                                      if(set_value('cp_two_cwc_cci'))
                                                      {
                                                         $cp_two_cwc_cci_val= set_value('cp_two_cwc_cci');
                                                      }
                                                      elseif($incident_edit_details[0]['cp_two_cwc_cci_details'])
                                                      {
                                                         $cp_two_cwc_cci_val= $incident_edit_details[0]['cp_two_cwc_cci_details'];
                                                      }
                                                      else
                                                      {
                                                         $cp_two_cwc_cci_val= '';
                                                      }
                                                      ?>
                                                <?php foreach($cptwocwcCCI as $value){
                                                   if($value['sl_no'] == $cp_two_cwc_cci_val){
                                                      $cci_two_sel='selected="selected"';
                                                   }
                                                   else{
                                                      $cci_two_sel='';
                                                   }
                                                   ?>
                                                <option value="<?php echo $value['sl_no']; ?>" <?php echo $cci_two_sel;?>><?php echo $value['cci_name']; ?></option>
                                                <?php  } ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="form-group row" id="cp_two_cwc_address_div" <?php if($incident_edit_details[0]['cp_two_cwc_minor_sent'] == 1 || $incident_edit_details[0]['cp_two_cwc_minor_sent'] == 2 || $incident_edit_details[0]['cp_two_cwc_minor_sent'] == 3){?>style="display: block;"<?php }else{ ?>style="display: none;"<?php } ?>>
                                          <label class="col-xs-3 col-form-label">Address <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <input type="text" class="form-control" id="cp_two_cwc_address" autocomplete="off" name="cp_two_cwc_address" value="<?php if(set_value('cp_two_cwc_address') != ''){?><?php echo set_value('cp_two_cwc_address'); ?><?php }else{?><?php echo $incident_edit_details[0]['cp_two_cwc_address']?><?php } ?>"  tabindex="7">    
                                          </div>
                                       </div>
                                       <?php if($incident_edit_details[0]['cp_two_cwc_remarks'] != ''){?>
                                       <div class="form-group row">
                                          <label class="col-xs-3 col-form-label">Remarks <font color="red">*</font></label>
                                          <div class="col-sm-6 col-xs-6">
                                             <textarea rows="3" name="cp_two_cwc_remarks" class="form-control"><?php echo $incident_edit_details[0]['cp_two_cwc_remarks']?></textarea>
                                          </div>
                                       </div>
                                       <?php } ?>
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
      <!-- Modal -->
      </div>
   </div>
</body>
   
</style>