<?php
      //echo '<pre>';print_r($incident_details);die();
      $block = ($incident_details)?$incident_details->block:0;
      $ward_gp = ($incident_details)?$incident_details->ward_gp:0;
      $identity_block_id = ($incident_details)?$incident_details->identity_block_id:0;
      $identity_ward_gp = ($incident_details)?$incident_details->identity_ward_gp:0;
      $cp_1_block_id = ($incident_details)?$incident_details->cp_1_block_id:0;
      $cp_1_ward_gp = ($incident_details)?$incident_details->cp_1_ward_gp:0;
      $cp_2_block_id = ($incident_details)?$incident_details->cp_2_block_id:0;
      $cp_2_ward_gp = ($incident_details)?$incident_details->cp_2_ward_gp:0;

      
        $incident_block_details = Get_Incident_List_Block_Details($block);
        if(!empty($incident_block_details)){
          if($incident_block_details->rural_urban == 'U'){
            $incident_ward_gp_details = Get_Incident_List_Ward_Details($ward_gp);
          }else{
            $incident_ward_gp_details = Get_Incident_List_GP_Details($ward_gp);
          }
        }else{
          $incident_ward_gp_details = array();
        }
      
        $incident_identity_block_details = Get_Incident_List_Identity_Block_Details($identity_block_id);
        if(!empty($incident_identity_block_details)){
           if($incident_identity_block_details->rural_urban == 'U'){
             $incident_identity_ward_gp_details = Get_Incident_List_Identity_Ward_Details($identity_ward_gp);
           }else{
             $incident_identity_ward_gp_details = Get_Incident_List_Identity_GP_Details($identity_ward_gp);
           }
        }else{
           $incident_identity_ward_gp_details = array();
        }
       
        $cp_one_block_details = Get_Incident_List_CP_One_Block_Details($cp_1_block_id);
        if(!empty($cp_one_block_details)){
           if($cp_one_block_details->rural_urban == 'U'){
             $cp_one_ward_gp_details = Get_Incident_List_CP_One_Ward_Details($cp_1_ward_gp);
           }else{
             $cp_one_ward_gp_details = Get_Incident_List_CP_One_GP_Details($cp_1_ward_gp);
           }
        }else{
           $cp_one_ward_gp_details = array();
        }
      
        $cp_two_block_details = Get_Incident_List_CP_Two_Block_Details($incident_details->cp_2_block_id);
        if(!empty($cp_two_block_details)){
          if($cp_two_block_details->rural_urban == 'U'){
            $cp_two_ward_gp_details = Get_Incident_List_CP_Two_Ward_Details($cp_2_ward_gp);
          }else{
            $cp_two_ward_gp_details = Get_Incident_List_CP_Two_GP_Details($cp_2_ward_gp);
          }
        }else{
          $cp_two_ward_gp_details = array();
        }
      ?>
   
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
                              <?php $incident_date = ($incident_details)?$incident_details->incident_date:'';?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Intervention Date&nbsp;(dd/mm/yyyy)</label>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?=($incident_date)?date('d-m-Y', strtotime($incident_date)):''; ?>" disabled>
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
                                       <span style="<?php echo $marriage_details_css; ?>"><?php echo $value1['description']?></span><input type="radio" <?php if($incident_details->marriage_details == $value1['cm_marriage_master_id_pk']){ echo "checked"; } ?> style="float: right;margin-right: 80px;"><br>
                                       <?php } ?>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date of marriage&nbsp;(dd/mm/yyyy)</label>
                                    <div class="col-sm-3">
                                       <input type="text" class="form-control" value="<?php echo !empty($incident_details->marriage_date) ? date('d-m-Y', strtotime($incident_details->marriage_date)) : ''; ?>" disabled>
                                    </div>

                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Street / Landmark</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->street_landmark; ?>" disabled>
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
                                       <input type="text" class="form-control" value="<?php echo $incident_details->incident_district; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Block / Municipality</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->incident_block; ?>" disabled>
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
                                       <input type="text"  class="form-control" value="<?php echo $incident_details->pin_code; ?>" disabled>
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
                                       <span style="<?php echo $prevented_details_css; ?>"><?php echo $value1['description']?></span><input type="radio" class="prevented_details" <?php if($incident_details->prevented_details == $value1['cm_incident_report_details_master_id_pk']){ echo "checked"; } ?> style="float: right;margin-right: 79px;"><br>
                                       <?php } ?>                                
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Police Station</label>
                                    <div class="col-sm-5">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->police_station; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description of location</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($location_description_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($incident_details->location_description == $value1['cm_location_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>
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
                                       <input type="radio" <?php if($incident_details->anonymous == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($incident_details->anonymous == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($incident_details->anonymous == 2){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">If identity known Name</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->identity_known_name; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Street / Landmark</label>
                                    <div class="col-sm-9">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->identity_street_landmark; ?>" disabled>
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
                                          <input type="text" class="form-control" value="<?php echo $incident_details->identity_district; ?>" disabled>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Block / Municipality</label>
                                       <div class="col-sm-5">
                                          <input type="text" class="form-control" value="<?php echo $incident_details->identity_block; ?>" disabled>
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
                                          <input type="text" class="form-control" value="<?php echo $incident_details->identity_pin_code; ?>" disabled>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Police Station</label>
                                       <div class="col-sm-5">
                                          <input type="text" class="form-control" value="<?php echo $incident_details->identity_police_station; ?>" disabled> 
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label class="col-sm-3 col-form-label">Phone No</label>
                                       <div class="col-sm-5">
                                          <input type="number" class="form-control" value="<?php echo $incident_details->identity_phone_no; ?>" disabled>
                                       </div>
                                    </div>
                                    <div class="form-group row Information_Received">
                                       <h5 class=""><strong>Information Received by</strong></h5>
                                       <div class="">
                                          <?php
                                             foreach($information_received_details as $value1){?>
                                          <span style="margin-right: 15px;"><?php echo $value1['description']?></span>&nbsp;<input type="radio" <?php if($incident_details->information_received == $value1['cm_information_received_master_id_pk']){ echo "checked"; } ?> style="margin-right: 9px;"><br>
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
                                             $Local_Person_Details_Query = Get_Local_Person_Details($incident_details->incident_id_pk);
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
                                             $Official_Involved_Details_Query = Get_Official_Involved_Details($incident_details->incident_id_pk);
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
                                 $cp_1_name = $incident_details->cp_1_name;
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
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_street_landmark; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-6">
                                       <input type="text" value="<?php echo $incident_details->cp_1_state_name; ?>" class="form-control" disabled>
                                    </div>
                                 </div>
                                 <?php if($incident_details->cp_1_state == 1){?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">District</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_district; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Block / Municipality</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_block; ?>" disabled>
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
                                       <textarea class="form-control" rows="3" disabled><?php echo $incident_details->cp_1_address; ?></textarea>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Pin Code</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_pin_code; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Police Station</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_police_station; ?>" disabled> 
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Phone No</label>
                                    <div class="col-sm-6">
                                       <input type="number" class="form-control" value="<?php echo $incident_details->cp_1_phone_no; ?>" disabled>
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
                                             <input type="radio" <?php if($incident_details->cp_1_gender == $value1['cm_gender_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                             <input type="radio" <?php if($incident_details->cp_1_social_category == $value1['cm_social_category_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                             <input type="radio" <?php if($incident_details->cp_1_religion == $value1['cm_religion_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                       <!-- <input type="text" class="form-control" value="<?php echo date('d/m/Y', strtotime($incident_details->cp_1_dob)); ?>" disabled>  -->
                                       <input type="text" class="form-control" value="<?php echo !empty($incident_details->cp_1_dob) ? date('d-m-Y', strtotime($incident_details->cp_1_dob)) : ''; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Age</label>
                                    <div class="col-sm-6">
                                       <!-- <input type="text" class="form-control" value="<?php echo $incident_details->cp1_age; ?>" disabled> -->
                                       <input type="text" class="form-control" value="<?php full_age_view($incident_details->incident_date, $incident_details->cp_1_dob); ?>" disabled> 
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">DOB document available?</label>
                                    <div class="col-sm-9">
                                       <input type="radio" <?php if($incident_details->cp_1_dob_document_available == '1'){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($incident_details->cp_1_dob_document_available == '2'){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($incident_details->cp_1_dob_document_available == '1'){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_dob_document_id; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($document_type_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($incident_details->cp_1_dob_document_type == $value1['cm_document_type_master_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                       <input type="radio" <?php if($incident_details->cp_1_identity_document_available == '1'){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($incident_details->cp_1_identity_document_available == '2'){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($incident_details->cp_1_identity_document_available == '1'){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_identity_document_id; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php
                                             foreach($document_type_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($incident_details->cp_1_identity_document_type == $value1['cm_document_type_master_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                             <input type="radio" <?php if($incident_details->cp_1_highest_educational_attainment == $value1['cm_highest_educational_attainment_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_father_name; ?>" disabled> 
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_mother_name; ?>" disabled> 
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Phone No</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_father_mobile_no; ?>" disabled>  
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_mother_mobile_no; ?>" disabled>  
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_father_id; ?>" disabled>  
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_1_mother_id; ?>" disabled>  
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID Type</td>
                                             <td>
                                                <?php
                                                   if($incident_details->cp_1_father_id_type == 1){
                                                     $cp_1_father_id_type = "Birth Certificate";
                                                   }elseif($incident_details->cp_1_father_id_type == 2){
                                                     $cp_1_father_id_type = "School Certificate";
                                                   }elseif($incident_details->cp_1_father_id_type == 3){
                                                     $cp_1_father_id_type = "Driving Licence";
                                                   }elseif($incident_details->cp_1_father_id_type == 4){
                                                     $cp_1_father_id_type = "PAN Card";
                                                   }elseif($incident_details->cp_1_father_id_type == 5){
                                                     $cp_1_father_id_type = "Voter ID Card";
                                                   }elseif($incident_details->cp_1_father_id_type == 6){
                                                      $cp_1_father_id_type = "Passport";
                                                   }else{
                                                      $cp_1_father_id_type = "N/A";
                                                   }
                                                   ?>
                                                <input type="text" class="form-control" value="<?php echo $cp_1_father_id_type; ?>" disabled>
                                             </td>
                                             <td>
                                                <?php
                                                   if($incident_details->cp_mother_id_type == 1){
                                                     $cp_mother_id_type = "Birth Certificate";
                                                   }elseif($incident_details->cp_mother_id_type == 2){
                                                     $cp_mother_id_type = "School Certificate";
                                                   }elseif($incident_details->cp_mother_id_type == 3){
                                                     $cp_mother_id_type = "Driving Licence";
                                                   }elseif($incident_details->cp_mother_id_type == 4){
                                                     $cp_mother_id_type = "PAN Card";
                                                   }elseif($incident_details->cp_mother_id_type == 5){
                                                     $cp_mother_id_type = "Voter ID Card";
                                                   }elseif($incident_details->cp_mother_id_type == 6){
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
                                                <input type="radio" value="1" <?php if($incident_details->cp_1_father_alive == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                                <input type="radio" value="2" <?php if($incident_details->cp_1_father_alive == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                             </td>
                                             <td style="text-align: left;">
                                                <input type="radio" value="1" <?php if($incident_details->cp_1_mother_alive == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                                <input type="radio" value="2" <?php if($incident_details->cp_1_mother_alive == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <?php if(count(Get_Cp_One_Address($incident_details->incident_id_pk)) > 0){?>
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
                               $Cp_One_Address_Query = Get_Cp_One_Address($incident_details->incident_id_pk);
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
                                 $cp_2_name = $incident_details->cp_2_name;
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
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_street_landmark; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_state_name; ?>" readonly style="cursor: not-allowed;">  
                                    </div>
                                 </div>
                                 <?php if($incident_details->cp_2_state == 1){?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">District</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_district; ?>" disabled>  
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Block / Municipality</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_block; ?>" disabled>  
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
                                       <textarea class="form-control" rows="3" disabled><?php echo $incident_details->cp_2_address; ?></textarea>
                                    </div>
                                 </div>
                                 <?php } ?>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Pin Code</label>
                                    <div class="col-sm-6">
                                       <input type="number" class="form-control" value="<?php echo $incident_details->cp_2_pin_code; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Police Station</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_police_station; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Phone No</label>
                                    <div class="col-sm-6">
                                       <input type="number" class="form-control" value="<?php echo $incident_details->cp_2_phone_no ?>" disabled>
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
                                             <input type="radio" <?php if($incident_details->cp_2_gender == $value1['cm_gender_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                             <input type="radio" <?php if($incident_details->cp_2_social_category == $value1['cm_social_category_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                             <input type="radio" <?php if($incident_details->cp_2_religion == $value1['cm_religion_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                       <input type="text" class="form-control" value="<?php echo !empty($incident_details->cp_2_dob) ? date('d-m-Y', strtotime($incident_details->cp_2_dob)) : ''; ?>" disabled>  
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Age</label>
                                    <div class="col-sm-6">
                                       <!-- <input type="text" class="form-control" value="<?php echo $incident_details->cp2_age; ?>" disabled>   -->
                                       <input type="text" class="form-control" value="<?php full_age_view($incident_details->incident_date, $incident_details->cp_2_dob); ?>" disabled>  

                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">DOB document available?</label>
                                    <div class="col-sm-6">
                                       <input type="radio" <?php if($incident_details->cp_2_dob_document_available == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($incident_details->cp_2_dob_document_available == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($incident_details->cp_2_dob_document_available == 1){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_dob_document_id; ?>">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($document_type_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio"  <?php if($incident_details->cp_2_dob_document_type == $value1['cm_document_type_master_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                       <input type="radio" <?php if($incident_details->cp_2_identity_document_available == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                       <input type="radio" <?php if($incident_details->cp_2_identity_document_available == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                    </div>
                                 </div>
                              </div>
                              <?php if($incident_details->cp_2_identity_document_available == 1){?>
                              <div class="card-body">
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document ID</label>
                                    <div class="col-sm-6">
                                       <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_identity_document_id; ?>" disabled>
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Document Type</label>
                                    <div class="col-sm-9">
                                       <div class="des-loc">
                                          <?php foreach($document_type_details as $value1){?>
                                          <div class="inp-radio">
                                             <input type="radio" <?php if($incident_details->cp_2_identity_document_type == $value1['cm_document_type_master_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                             <input type="radio" <?php if($incident_details->cp_2_highest_educational_attainment == $value1['cm_highest_educational_attainment_master_id_pk']){ echo "checked"; } ?>>&nbsp;<?php echo $value1['description']?>&nbsp;&nbsp;
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
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_father_name; ?>" disabled> 
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_mother_name; ?>" disabled>   
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">Phone No</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_father_mobile_no; ?>" disabled> 
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_mother_mobile_no; ?>" disabled>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID</td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_father_id; ?>" disabled>
                                             </td>
                                             <td>
                                                <input type="text" class="form-control" value="<?php echo $incident_details->cp_2_mother_id; ?>" disabled>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td style="text-align: left; font-weight: bold;">ID Type</td>
                                             <td>
                                                <?php
                                                   if($incident_details->cp_2_father_id_type == 1){
                                                     $cp_2_father_id_type = "Birth Certificate";
                                                   }elseif($incident_details->cp_2_father_id_type == 2){
                                                     $cp_2_father_id_type = "School Certificate";
                                                   }elseif($incident_details->cp_2_father_id_type == 3){
                                                     $cp_2_father_id_type = "Driving Licence";
                                                   }elseif($incident_details->cp_2_father_id_type == 4){
                                                     $cp_2_father_id_type = "PAN Card";
                                                   }elseif($incident_details->cp_2_father_id_type == 5){
                                                     $cp_2_father_id_type = "Voter ID Card";
                                                   }elseif($incident_details->cp_2_father_id_type == 6){
                                                      $cp_2_father_id_type = "Passport";
                                                   }else{
                                                      $cp_2_father_id_type = "N/A";
                                                   }
                                                   ?>
                                                <input type="text" class="form-control" value="<?php echo $cp_2_father_id_type; ?>" disabled>
                                             </td>
                                             <td>
                                                <?php
                                                   if($incident_details->cp_2_mother_id_type == 1){
                                                     $cp_2_mother_id_type = "Birth Certificate";
                                                   }elseif($incident_details->cp_2_mother_id_type == 2){
                                                     $cp_2_mother_id_type = "School Certificate";
                                                   }elseif($incident_details->cp_2_mother_id_type == 3){
                                                     $cp_2_mother_id_type = "Driving Licence";
                                                   }elseif($incident_details->cp_2_mother_id_type == 4){
                                                     $cp_2_mother_id_type = "PAN Card";
                                                   }elseif($incident_details->cp_2_mother_id_type == 5){
                                                     $cp_2_mother_id_type = "Voter ID Card";
                                                   }elseif($incident_details->cp_2_mother_id_type == 6){
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
                                                <input type="radio" <?php if($incident_details->cp_2_father_alive == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                                <input type="radio" <?php if($incident_details->cp_2_father_alive == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                             </td>
                                             <td style="text-align: left;">
                                                <input type="radio" <?php if($incident_details->cp_2_mother_id_type == 1){ echo "checked"; } ?>>&nbsp;Yes&nbsp;&nbsp;
                                                <input type="radio" <?php if($incident_details->cp_2_mother_id_type == 2){ echo "checked"; } ?>>&nbsp;No&nbsp;&nbsp;
                                             </td>
                                          </tr>
                                       </table>
                                    </div>
                                 </div>
                              </div>
                              <?php if(count(Get_Cp_Two_Address($incident_details->incident_id_pk)) > 0){?>
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
                               $Cp_Two_Address_Query = Get_Cp_Two_Address($incident_details->incident_id_pk);
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
?>