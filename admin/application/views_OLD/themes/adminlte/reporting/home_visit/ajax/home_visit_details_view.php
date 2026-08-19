<?php
$asessmentArray = array(1=>'Rarely',2=>'Sometimes',3=>'Regularly');
$siblingsSexArray = array(1=>'Male',2=>'Female');
$frequencyAttendanceArray =  array(1=>'Rarely',2=>'Sometimes',3=>'Regularly');
$homeEnquirySupportArray =  array(1=>'Low',2=>'Medium',3=>'High');
$mode_of_enquiry = ($home_visit_details)?$home_visit_details['mode_of_enquiry']:'';
$gender_id = ($home_visit_details)?$home_visit_details['gender']:'';
$family_income_id = ($home_visit_details)?$home_visit_details['family_income']:'';
$nutritious_meals_id = ($home_visit_details)?$home_visit_details['nutritious_meals']:'';
$neighbours_community_id = ($home_visit_details)?$home_visit_details['neighbours_community']:'';
$emergencies_id = ($home_visit_details)?$home_visit_details['emergencies']:'';
$disability_certificate_value = ($home_visit_details)?$home_visit_details['disability_certificate']:'';
$estimated_severity_value = ($home_visit_details)?$home_visit_details['estimated_severity']:'';
$cp_id_fk = ($home_visit_details)?$home_visit_details['cp_id_fk']:'';
$cp_age = contracting_parties_details_by_cp_id($cp_id_fk);
$form_type = ($cp_age>=18)?'Adult':'Minor';
$adult_status = ($cp_age>=18)?1:2;
?>
<div class="modal-dialog modal-lg">
   <!-- Modal content-->
   <div class="modal-content" id="mod">
      <div class="modal-header custom-modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <h4 class="modal-title text-center">Home Enquiry (<?=$form_type?>) Data</h4>
      </div>
      <div class="modal-body">
        
         <div class="div-table">

            <!-- Prevention Incident -->
           <div class="table">
             <div class="tr">
               <div class="td">Mode of Enquiry :</div>
               <div class="td">
                <p class="mode_of_enquiry"><?=get_mode_of_enquiry_details_by_id($mode_of_enquiry);?></p>
               </div>
             </div>
             <div class="tr">
               <div class="td">Gender :</div>
               <div class="td gender">
                 <p><?=get_gender_details_by_id($gender_id);?></p>
               </div>
             </div>
           </div>

           <div class="title">Assessment of Family Situation</div>
           <div class="table">
             <div class="tr">
               <div class="td">Total family income is at least Rs.10,000 /- every month :</div>
               <div class="td family_income">
                 <p><?=($family_income_id)?$asessmentArray[$family_income_id]:''?></p>
               </div>
             </div>
             <div class="tr">
               <div class="td">Every member of the family has at least two nutritious meals a day :</div>
               <div class="td nutritious_meals">
                 <p><?=($nutritious_meals_id)?$asessmentArray[$nutritious_meals_id]:''?></p>
               </div>                    
             </div>
             <div class="tr">
               <div class="td">The family get support from neighbours and community in time of need :</div>
               <div class="td neighbours_community">
                <p><?=($neighbours_community_id)?$asessmentArray[$neighbours_community_id]:''?></p>
               </div>
             </div>
             <div class="tr">
               <div class="td">The family has some money kept aside for emergencies :</div>
               <div class="td emergencies">
                <p><?=($emergencies_id)?$asessmentArray[$emergencies_id]:''?></p>
               </div>
             </div>
           </div>

           <div class="title">Siblings</div>
            <!-- Siblings -->
            <div id="siblings_container">
              <table class="table table-bordered" id="Siblings_Table_Field">
                 <thead>
                    <tr style="background-color: #508de2; color: #FFFFFF;">
                       <th rowspan="2">Name</th>
                       <th rowspan="2">Age</th>
                       <th rowspan="2" colspan="1" style="text-align: center;">Gender</th>
                       <th rowspan="2" colspan="1" style="text-align: center;">Married</th>
                       <th colspan="2" style="text-align: center;">Occupation</th>
                    </tr>
                    <tr style="background-color: #508de2; color: #FFFFFF;">
                      <th style="text-align: center;">In Education</th>
                      <th style="text-align: center;">In paid work</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php 
                    if(!empty($homwvisit_siblings_dtls)){ 
                      foreach ($homwvisit_siblings_dtls as $key => $value) {
                        $siblings_sex_value = ($value['siblings_sex'])?$value['siblings_sex']:'';
                        $siblings_married_value = ($value['siblings_married'])?$value['siblings_married']:'';
                        $in_education_value = ($value['in_education'])?$value['in_education']:'';
                        $in_paid_work_value = ($value['in_paid_work'])?$value['in_paid_work']:'';
                  ?>
                    <tr>
                      <td><p><?=$value['siblings_name']?></p></td>
                      <td><p><?=$value['siblings_age']?></p></td>
                      <td><p><?=($siblings_sex_value)?$siblingsSexArray[$siblings_sex_value]:''?></p></td>
                      <td><p><?=($siblings_married_value)?($siblings_married_value==1)?'Yes':'No':''?></p></td>
                      <td><p><?=($in_education_value)?($in_education_value==1)?'Yes':'No':''?></p></td>
                      <td><p><?=($in_paid_work_value)?($in_paid_work_value==1)?'Yes':'No':''?></p></td>
                    </tr>
                  <?php } }else{ ?>
                    <tr><td colspan="5">No Data Found</td></tr>
                  <?php } ?>
                </tbody>
              </table>
               
            </div><br>
            <?php if($adult_status==2){ ?>
            <div class="minor_assessment">
              <div class="title">Assessment of Minor</div>

              <div class="table">
                <div class="tr">
                  <div class="td">Has a disability? :</div>
                  <div class="td disability">
                    <p><?=($home_visit_details['disability'])?($home_visit_details['disability']==1)?'Yes':'No':''?></p>
                  </div>
                </div>
              </div>
            </div>
            <?php if($home_visit_details['disability']==1){ ?>
            <div class="table">
              <div class="tr">
                <div class="td">Type Of Disability :</div>
                <div class="td type_of_disability">
                   <?php 
                    $type_of_disability = ($home_visit_details)?$home_visit_details['type_of_disability']:0;
                    if(!empty($type_of_disability)){
                      $type_of_disability_explode = explode(',', $type_of_disability);
                      $disability_explode = array_column(get_disability_details_by_id($type_of_disability_explode), 'description');
                    }else{
                      $disability_explode = array();
                    } 
                    
                   ?>
                   <p><?=implode(',', $disability_explode)?></p>
                </div>
              </div>
            </div>

            <div class="table">
              <div class="tr">
                <div class="td">Has a disability certificate? :</div>
                <div class="td disability_certificate">
                  <p><?=($disability_certificate_value)?($disability_certificate_value==1)?'Yes':'No':''?></p>
                </div>
              </div>
            </div>
            <?php if($disability_certificate_value==1){ ?>
              <div class="table">
                <div class="tr">
                  <div class="td">disability percent(%) :</div>
                  <div class="td disability_percent">
                    <p><?=($home_visit_details)?$home_visit_details['disability_percent']:''?></p>
                  </div>
                </div>
              </div>
            <?php } ?>

            <div class="table">
              <div class="tr">
                <div class="td">If certificate not available estimated severity</div>
                <div class="td estimated_severity">
                  <p><?=($estimated_severity_value)?get_estimated_severity_details_by_id($estimated_severity_value):''?></p>
                </div>
              </div>
            </div>
          <?php } ?>
             
            
          <table class="table table-bordered">
           <tr style="background-color: gray; color: #FFFFFF;">
              <th colspan="2" style="text-align: center;">engaged in</th>
              <th colspan="2" style="text-align: center;">engagement frequency</th>
           </tr>
            <tr>
              <td>Education</td>
              <td class="education_val">
                <p><?=($home_visit_details['education'])?($home_visit_details['education']==1)?'Yes':'No':''?></p>
              </td>
              <td>Education Frequency</td>
              <td class="education_frequency_val">
                <?php $education_frequency_value = ($home_visit_details['education_frequency'])?$home_visit_details['education_frequency']:0;?>
                <p><?=($home_visit_details['education_frequency'])?$frequencyAttendanceArray[$education_frequency_value]:''?></p>
                
              </td>
            </tr>
            <tr>
              <td>Kishori Group</td>
              <td class="kishori_group_val">
                <p><?=($home_visit_details['kishori_group'])?($home_visit_details['kishori_group']==1)?'Yes':'No':''?></p>
              </td>
              <td>Kishori Group Frequency</td>
              <td class="kishori_group_frequency_val">
                <?php $kishori_group_frequency_value = ($home_visit_details['kishori_group_frequency'])?$home_visit_details['kishori_group_frequency']:0;?>
                <p><?=($home_visit_details['kishori_group_frequency'])?$frequencyAttendanceArray[$kishori_group_frequency_value]:''?></p>
              </td>
            </tr>

            <tr>
              <td>Paid work</td>
              <td class="paid_work_val">
                <p><?=($home_visit_details['paid_work'])?($home_visit_details['paid_work']==1)?'Yes':'No':''?></p>
              </td>
              <td>Paid work Frequency</td>
              <td class="paid_work_frequency_val">
                <?php $paid_work_frequency_value = ($home_visit_details['paid_work_frequency'])?$home_visit_details['paid_work_frequency']:0;?>
                <p><?=($home_visit_details['paid_work_frequency'])?$frequencyAttendanceArray[$paid_work_frequency_value]:''?></p>
              </td>
            </tr>
           </table>
           </div>
           <?php if($home_visit_details['education']==1){ ?>
           <div class="table">
              <div class="tr">
               <div class="td">District Name</div>
               <div class="td">Block Name</div>
               <div class="td">School Name</div>
             </div>
             <div class="tr">
               <div class="td">
                <?php 
                 $school_district_id = ($home_visit_details['school_district'])?$home_visit_details['school_district']:0;
                ?>
                 <p><?=get_district_name_by_id($school_district_id)?></p>
               </div> 
               <div class="td">
                 <?php 
                 $school_block_id = ($home_visit_details['school_block'])?$home_visit_details['school_block']:0;
                ?>
                <?php //echo '------>>'.$school_block_id; ?>

                 <p><?=get_block_name_by_id($school_block_id)?></p>
               </div>
               <div class="td">
                 <?php 
                 $bs_school_id_fk = ($home_visit_details['bs_school_id_fk'])?$home_visit_details['bs_school_id_fk']:0;
                ?>
                 <p>
                  <?php if($bs_school_id_fk==19){
                    echo $home_visit_details['school_name'];
                  }else{
                    if(empty($bs_school_id_fk)){
                    }else{
                      echo get_school_name_by_id($bs_school_id_fk);
                    }
                    
                  } ?>
                    
                  </p>
               </div>
             </div>
           </div>
         <?php } ?>

           <div class="table">
              <div class="tr">
               <div class="td">Kanyashree ID, if any :</div>
               <div class="td kanyashree_id">
                 <p><?=$home_visit_details['kanyashree_id']?></p>
               </div> 
             </div>
           </div>

           <div class="title">At time of incident, did the minor feel supported by</div>
           <div class="table">
             <div class="tr">
               <div class="td">Parents :</div>
               <div class="td parents_supported">
                <?php
                  $parents_supported_value = ($home_visit_details['parents_supported'])?$home_visit_details['parents_supported']:'';
                ?>
                 <p><?=($parents_supported_value)?$homeEnquirySupportArray[$parents_supported_value]:''?></p>
               </div> 
             </div>
             <div class="tr">
               <div class="td">Family elders :</div>
               <div class="td family_elders_supported">
                 <?php
                  $family_elders_supported_value = ($home_visit_details['family_elders_supported'])?$home_visit_details['family_elders_supported']:'';
                ?>
                 <p><?=($family_elders_supported_value)?$homeEnquirySupportArray[$family_elders_supported_value]:''?></p>
               </div> 
             </div>
             <div class="tr">
               <div class="td">Peers :</div>
               <div class="td peers_supported">
                  <?php
                  $peers_supported_value = ($home_visit_details['peers_supported'])?$home_visit_details['peers_supported']:'';
                ?>
                 <p><?=($peers_supported_value)?$homeEnquirySupportArray[$peers_supported_value]:''?></p>
               </div> 
             </div>
             <div class="tr">
               <div class="td">Neighbours :</div>
               <div class="td neighbours_supported">
                 <?php
                  $neighbours_supported_value = ($home_visit_details['neighbours_supported'])?$home_visit_details['neighbours_supported']:'';
                ?>
                 <p><?=($neighbours_supported_value)?$homeEnquirySupportArray[$neighbours_supported_value]:''?></p>
               </div> 
             </div>
             <div class="tr">
               <div class="td">Others :</div>
               <div class="td others_supported">
                 <?php
                  $others_supported_value = ($home_visit_details['others_supported'])?$home_visit_details['others_supported']:'';
                ?>
                 <p><?=($others_supported_value)?$homeEnquirySupportArray[$others_supported_value]:''?></p>
               </div> 
             </div>
           </div>

           <div class="table">
              <div class="tr">
                <div class="td">Minor is pregnant :</div>
                <div class="td disability_certificate">
                  <?php 
                    $minor_pregnant_value = ($home_visit_details)?$home_visit_details['minor_pregnant']:'';
                  ?>

                  <p><?=($minor_pregnant_value)?($minor_pregnant_value==1)?'Yes':'No':''?></p>
                </div>
              </div>
            </div>

            <div class="table">
              <div class="tr">
                <div class="td">Remarks :</div>
                <div class="td disability_certificate">
                  <p><?=$home_visit_details['remarks']?></p>
                </div>
              </div>
            </div>
          <?php }else{ ?>

            <table class="table table-bordered">
               <tr style="background-color: gray; color: #FFFFFF;">
                  <th colspan="2" style="text-align: center;">Engaged In</th>
                  <th colspan="2" style="text-align: center;">Engagement Frequency</th>
               </tr>
                <tr>
                  <td>Education</td>
                  <td class="education_val">
                    <p><?=($home_visit_details['education'])?($home_visit_details['education']==1)?'Yes':'No':''?></p>
                  </td>
                  <td>Education Frequency</td>
                  <td class="education_frequency_val">
                    <?php $education_frequency_value = ($home_visit_details['education_frequency'])?$home_visit_details['education_frequency']:0;?>
                    <p><?=($home_visit_details['education_frequency'])?$frequencyAttendanceArray[$education_frequency_value]:''?></p>
                    
                  </td>
                </tr>
                
                <tr>
                  <td>Paid work</td>
                  <td class="paid_work_val">
                    <p><?=($home_visit_details['paid_work'])?($home_visit_details['paid_work']==1)?'Yes':'No':''?></p>
                  </td>
                  <td>Paid work Frequency</td>
                  <td class="paid_work_frequency_val">
                    <?php $paid_work_frequency_value = ($home_visit_details['paid_work_frequency'])?$home_visit_details['paid_work_frequency']:0;?>
                    <p><?=($home_visit_details['paid_work_frequency'])?$frequencyAttendanceArray[$paid_work_frequency_value]:''?></p>
                  </td>
                </tr>
           </table>

          <?php } ?>


         </div>
         
      </div>
      <div class="modal-footer" style="background-color: white;">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
   </div>
</div>
